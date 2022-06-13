<?php


/**
 * **********   XML   **********
*/


/**
 * Чтение XML-файла
 */
$content = file_get_contents('rss.xml');
$rss = new SimpleXMLElement($content);
echo $rss->channel->title."<br />"; // PHP
echo $rss->channel->description."<br />"; // Портал, посвященный PHP


/**
 * Коллекция тегов
 */
foreach($rss->channel->item as $item) {
    echo date("Y.m.d H:i", strtotime($item->pubDate)) . " xml.php";
    echo $item->title."<br />";
}


/**
 * Количество элементов в коллекции
 */
echo $rss->channel->item->count()."<br />"; // 3


/**
 * Список атрибутов
 */
foreach($rss->channel->item[0]->enclosure->attributes() as $name => $value) {
    echo "{$name} = {$value}<br />";
}


/**
 * Доступ к атрибутам тегов
 */
foreach($rss->channel->item as $item) {
    echo $item->enclosure['url']."<br />";
}


/**
 * Извлечение тегов <enclosure>
 */
foreach($rss->xpath('//enclosure') as $enclosure) {
    echo $enclosure['url'].'<br />';
}


/**
 * Новый список атрибутов
 */
foreach($rss->xpath('//item[1]/enclosure/@*') as $attr) {
    echo "{$attr}<br />";
}


/**
 * Формирование XML-файла *************************
 */

try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=test',
        'root',
        '',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
}
catch (PDOException $e) {
    echo "Невозможно установить соединение с базой данных";
}

$content = '<?xml version="1.0" encoding="UTF-8"?><rss version="2.0"></rss>';
$xml = new SimpleXMLElement($content);
$rss = $xml->addChild('channel');

$rss->addChild('title', 'PHP');
$rss->addChild('link', 'http://exmaple.com/');
$rss->addChild('description', 'Портал, посвященный PHP');
$rss->addChild('language', 'ru');
$rss->addChild('pubDate', date('r'));

try {
    $query = "SELECT * 
              FROM news
              ORDER BY putdate DESC
              LIMIT 20";
    $itm = $pdo->query($query);

    while($news = $itm->fetch()) {
        $item = $rss->addChild('item');
        $item->addChild('title', $news['name']);
        $item->addChild('description', $news['content']);
        $item->addChild('link', "http://example.com/news/{$news['id']}");
        $item->addChild('guid', "news/{$news['id']}");
        $item->addChild('pubDate', date('r', strtotime($news['putdate'])));
        if(!empty($news['media'])) {
            $enclosure = $item->addChild('enclosure');
            $url = "http://example.com/images/{$news['id']}/{$news['media']}";
            $enclosure->addAttribute('url', $url);
            $enclosure->addAttribute('type', 'image/jpeg');
        }
    }
} catch (PDOException $e) {
    echo "Ошибка выполнения запроса: " . $e->getMessage();
}

$xml->asXML('build.xml');