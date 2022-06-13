<?php

/**
 * *************   Регулярные выражения   *************
 */


// Проверить, что в строке есть число (одна или более цифра).
preg_match('/(\d+)/s', "article_123.html", $matches);
echo $matches[1]; //123


echo "<hr>";
// Найти в тексте адрес E-mail. \S означает "не пробел", а [a-z0-9.]+ -
// "любое число букв, цифр или точек". Модификатор 'i' после '/'
// заставляет PHP не учитывать регистр букв при поиске совпадений.
// Модификатор 's', стоящий рядом с 'i', говорит, что мы работаем
// в "однострочном режиме" (см. ниже в этой главе).
preg_match('/(\S+)@([a-z0-9.]+)/is', "Привет от somebody@mail.ru!", $m);
// Имя хоста будет в $m[2], а имя ящика (до @) - в $m[1].
echo "В тексте найдено: ящик - $m[1], хост - $m[2]";


echo "<hr>";
//Преобразования e-mail в HTML-ссылку.
$text = "Привет от somebody@mail.ru, а также от other@mail.ru!";
$html = preg_replace(
    '[(\S+)@([a-z0-9.]+)]is',            // найти все E-mail
    '<a href="mailto:$0">$0</a>', // заменить их по шаблону
    $text                                    // искать в $text
);
echo $html;



echo "<hr>";
//Простейший разбор даты.
$str = " 15-16/2000       "; // к примеру
$re = '{
    ^\s*(                  # начало строки
      (\d+)                  # день
        \s* [[:punct:]] \s*  # разделитель
      (\d+)                  # месяц
        \s* [[:punct:]] \s*  # разделитель
      (\d+)                  # год
    )\s*$                  # конец строки
  }xs';
// Разбиваем строку на куски при помощи preg_match().
preg_match($re, $str, $matches) or die("Not a date: $str");
// Теперь разбираемся с карманами.
echo "Дата без пробелов: '$matches[1]' <br />";
echo "День: $matches[2] <br />";
echo "Месяц: $matches[3] <br />";
echo "Год: $matches[4]";


//echo "<hr>";
//Замена по шаблону.
$text = htmlspecialchars(file_get_contents(__FILE__));
$html = preg_replace('/(\$[a-z]\w*)/is', '<b>$1</b>', $text);
//echo "<pre>$html</pre>";



echo "<hr>";
//Обратные ссылки. (\w+) \1
$str = "Hello, this <b>word</b> is bold!";
$re = '|<(\w+) [^>]* > (.*?) </\1>|xs';
preg_match($re, $str, $matches) or die("Нет тэгов.");
echo htmlspecialchars("'$matches[2]' обрамлено тэгом '$matches[1]'");



echo "<hr>";
//Игнорирование карманов. ?:
$str = "2015-12-15";
$re = '|^(?:\d{4})-(?:\d{2})-(\d{2})$|';
preg_match($re, $str, $matches) or die("Соответствие не найдено");
echo htmlspecialchars("День: ".$matches[1]);



echo "<hr>";
//Именование карманов. (?<name>)
$str = "2015-12-15";
$re = "|^(?<year>\d{4})-(?<month>\d{2})-(?'day'\d{2})$|";
preg_match($re, $str, $matches) or die("Соответствие не найдено");
echo "День: "  . $matches['day']   . "<br />";
echo "Месяц: " . $matches['month'] . "<br />";
echo "Год: "   . $matches['year']  . "<br />";



echo "<hr>";
// "Жадные" квантификаторы. *?, +?, ??, {}?
$str = "Hello, this <b>word</b> is <b>bold</b>!";
$re = '|<(\w+) [^>]* > (.*?) </\1>|xs';
preg_match($re, $str, $matches) or die("Нет тэгов.");
echo htmlspecialchars("'$matches[2]' обрамлено тэгом '$matches[1]'");


echo "<hr>";
//Сравнение "жадных" и "ленивых" квантификаторов. Вложенные элементы - регулярки бессильны.
$str = '[b]жирный текст [b]а тут - еще жирнее[/b] вернулись[/b]';
$to  = '<b>$1</b>';
$re1 = '|\[b\] (.*)  \[/b\]|ixs';
$re2 = '|\[b\] (.*?) \[/b\]|ixs';
$result = preg_replace($re1, $to, $str);
echo "Жадная версия: ".htmlspecialchars($result)."<br />";
$result = preg_replace($re2, $to, $str);
echo "Ленивая версия: ".htmlspecialchars($result)."<br />";


//echo "<hr>";
//Многострочность.
$str = file_get_contents(__FILE__);
$str = preg_replace('/^/m', "\t", $str);
//echo "<pre>".htmlspecialchars($str)."</pre>";



echo "<hr>";
//Использование PREG_OFFSET_CAPTURE.
$st = '<b>жирный текст</b>';
$re = '|<(\w+).*?>(.*?)</\1>|s';
preg_match($re, $st, $p, PREG_OFFSET_CAPTURE);
echo "<pre>"; print_r($p); echo "</pre>";



echo "<hr>";
//Различные флаги preg_match_all().
//header("Content-type: text/plain");
$flags = [
    "PREG_PATTERN_ORDER",
    "PREG_SET_ORDER",
    "PREG_SET_ORDER|PREG_OFFSET_CAPTURE",
];
$re   = '|<(\w+).*?>(.*?)</\1>|s';
$text = "<b>текст</b>  и еще <i>другой текст</i>";
echo "Строка: $text . <br>";
echo "Выражение: $re\n\n";
foreach ($flags as $name) {
    preg_match_all($re, $text, $mathces, eval("return $name;"));
    echo "Флаг $name:\n";
    echo "<pre>";
    print_r($mathces);
    echo "</pre>";
    echo "\n";
}


echo "<hr>";
//Функция preg_replace_callback() в действии.
$str = '<hTmL><bOdY style="background: white;">Hello world!</bOdY></html>';
$str = preg_replace_callback(
    '{(?<btag></?)(?<content>\w+)(?<etag>.*?>)}s',
    function ($m) { return $m['btag'].strtoupper($m['content']).$m['etag']; },
    $str);
echo htmlspecialchars($str);


echo "<hr>";
//Функция preg_replace_callback_array().
$str = '<hTmL><bOdY>Hello world!</bOdY></html>';
$str = preg_replace_callback_array(
    [
        '{(?<btag></?)(?<content>\w+)(?<etag>.*?>)}s' => function($m) {
            return $m['btag'].strtoupper($m['content']).$m['etag'];
        },
        '{(?<=>)([^<>]+?)(?=<)}s' => function($m){ return "<strong>$m[1]</strong>"; }
    ],
    $str);
echo htmlspecialchars($str);



echo "<hr>";
//Выделение уникальных слов в тексте.
// Эта функция выделяет из текста в $text все уникальные слова и
// возвращает их список. В необязательный параметр $nOrigWords
// помещается исходное число слов в тексте, которое было до
// "фильтрации" дубликатов.
function getUniques($text, &$nOrigWords = false)
{
    // Сначала получаем все слова в тексте.
    $words = preg_split("/([^[:alnum:]]|['-])+/s", $text);
    $nOrigWords = count($words);
    // Затем приводим слова к нижнему регистру.
    $words = array_map("strtolower", $words);
    // Получаем уникальные значения.
    $words = array_unique($words);
    return $words;
}
// Пример применения функции.
setlocale(LC_ALL, 'ru_RU.UTF-8');
$fname = 'text.txt';
$text = file_get_contents($fname);
$uniq = getUniques($text, $nOrig);
echo "Было слов: $nOrig<br />";
echo "Стало слов: ".count($uniq)."<hr />";
echo join(" ", $uniq);


echo "<hr>";
//Применение preg_grep().
foreach (preg_grep('/^re.*/s', glob("*")) as $fn)
    echo "Файл примера: $fn<br />";


/**
 * **************     Примеры    ****************
*/


echo "<hr>";
//"Активизация" адесов E-mail.
$text = "Адреса: user-first@mail.ru, second.user@mail.ru.";
$html = preg_replace(
    '{
      [\w\-.]+             # имя ящика
      @
      [\w\-]+(\.[\w-]+)*   # имя хоста
    }xs',
    '<a href="mailto:$0">$0</a>',
    $text
);
echo $html;



echo "<hr>";
//"Активизация" HTML-ссылок.
$text = 'Ссылка: (http://thematrix.com), www.ru?"a"=b, http://lozhki.net.';
echo hrefActivate($text);

// Заменяет ссылки на их HTML-эквиваленты ("подчеркивает ссылки").
function hrefActivate($text)
{
    return preg_replace_callback(
        '{
        (?:
          (\w+://)          # протокол с двумя слэшами
          |                 # - или -
          www\.             # просто начинается на www
        )
        [\w-]+(\.[\w-]+)*   # имя хоста
        (?: : \d+)?         # порт (не обязателен)
        [^<>"\'()\[\]\s]*   # URI (но БЕЗ кавычек и скобок)
        (?:                 # последний символ должен быть...
            (?<! [[:punct:]] )  # НЕ пунктуацией
          | (?<= [-/&+*]     )  # но допустимо окончание на -/&+*
        )
      }xis',
        function ($p) {
            // Преобразуем спецсимволы в HTML-представление.
            $name = htmlspecialchars($p[0]);
            // Если нет протокола, добавляем его в начало строки.
            $href = !empty($p[1])? $name : "http://$name";
            // Формируем ссылку.
            return "<a href=\"$href\">$name</a>";
        },
        $text
    );
}