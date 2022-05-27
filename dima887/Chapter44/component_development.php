<?php


/**
 * **************  Разработка собственного компонента  ***************
 *
 * Загрузить компонент на git-хостинг
 * Зарегистрироваться на https://packagist.org/
 * Раздел Submit -> Repository URL -> Check
*/



// Временная автозагрузка классов
spl_autoload_register(function($class){
    require_once("src/{$class}.php");
});


/**
 * Постраничная навигация по директории
 */

$obj = new ISPager\DirPager(
    new ISPager\PagesList(),
    'photos',
    3,
    2);
// Содержимое текущей страницы
foreach($obj->getItems() as $img) {
    echo "<img src='$img' /> ";
}
// Постраничная навигация
echo "<p>$obj</p>";


/**
 * Постраничная навигация по содержимому файла
 */

$obj = new ISPager\FilePager(
    new ISPager\PagesList(),
    'component_development.php');
// Содержимое текущей страницы
foreach($obj->getItems() as $line) {
    echo htmlspecialchars($line)."<br /> ";
}
// Постраничная навигация
echo "<p>$obj</p>";


/**
 * Постраничная навигация по содержимому базы данных
 */

try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=test',
        'root',
        '',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $obj = new ISPager\PdoPager(
        new ISPager\PagesList(),
        $pdo,
        'languages');
    // Содержимое текущей страницы
    foreach($obj->getItems() as $language) {
        echo htmlspecialchars($language['name'])."<br /> ";
    }
    // Постраничная навигация
    echo "<p>$obj</p>";
}
catch (PDOException $e) {
    echo "Невозможно установить соединение с базой данных";
}


/**
 * Использование представления ItemsRange
 */

try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=test',
        'root',
        '',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $obj = new ISPager\PdoPager(
        new ISPager\ItemsRange(),
        $pdo,
        'languages');
    // Содержимое текущей страницы
    foreach($obj->getItems() as $language) {
        echo htmlspecialchars($language['name'])."<br /> ";
    }
    // Постраничная навигация
    echo "<p>$obj</p>";
}
catch (PDOException $e) {
    echo "Невозможно установить соединение с базой данных";
}