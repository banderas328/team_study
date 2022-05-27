<?php

require_once('connect_db.php');

/**
 * @var $pdo;
 */

/**
 * ************  Работа с СУБД MySQL  **************
*/


/**
 * CREATE DATABASE wet; - Создание БД wet
 * SHOW DATABASES; - Показать список БД
 * DROP DATABASE wet; - удалить БД wet
 * CREATE DATABASE wet DEFAULT CHARACTER SET utf8; - указание кодировки
 * use wet; - выбрать БД wet
 * CREATE TABLE users; создание таблицы users
 * DROP TABLE users; - удалить таблицу users;
 * TRUNCATE TABLE users; - удалить все записи в таблице users;
*/


/**
CREATE TABLE authors (
    id INT(11) NOT NULL AUTO_INCREMENT,
    name TINYTEXT,
    passw TINYTEXT,
    email TINYTEXT,
    url TEXT,
    iсq TINYTEXT,
    about TEXT,
    photo TINYTEXT,
    putdate DATETIME DEFAULT NULL,
    last_time DATETIME DEFAULT NULL,
    themes INT(10) DEFAULT NULL,
    statususer ENUM('user','moderator','admin') NOT NULL default 'user',
    PRIMARY KEY (id)
);
*/


/**
CREATE TABLE forums (
    id INT(11) NOT NULL AUTO_INCREMENT,
    name TINYTEXT,
    rule TEXT,
    logo TINYTEXT,
    pos INT(11) DEFAULT NULL,
    hide ENUM('show','hide') NOT NULL DEFAULT 'show',
    PRIMARY KEY (id)
);
 */


/**
CREATE TABLE themes (
    id INT(11) NOT NULL AUTO_INCREMENT,
    name TINYTEXT,
    author TINYTEXT,
    id_author INT(11) DEFAULT NULL,
    hide ENUM('show','hide') NOT NULL DEFAULT 'show',
    putdate DATETIME DEFAULT NULL,
    forum_id INT(11) default NULL,
    PRIMARY KEY (id)
);
*/


/**
CREATE TABLE posts (
    id INT(11) NOT NULL AUTO_INCREMENT,
    name TINYTEXT,
    url TEXT,
    file TINYTEXT,
    author TINYTEXT,
    author_id INT(11) DEFAULT NULL,
    hide ENUM('show','hide') NOT NULL DEFAULT 'show',
    putdate DATETIME DEFAULT NULL,
    parent_post INT(11) DEFAULT NULL,
    theme_id INT(11) DEFAULT NULL,
    PRIMARY KEY (id)
);
*/


/**
 * Посмотреть стуктуру таблицы forums
 *
 * DESCRIBE forums;
 */


/**
 * Изменить структуру таблицы
 *
 * ALTER TABLE table_name alter_spec
 *
 * добавим столбец test
 * ALTER TABLE forums ADD test int(10) AFTER name;
 *
 * переименуем столбец test в new_test
 * ALTER TABLE forums CHANGE test new_test TEXT;
 *
 * удалим столбец new_test
 * ALTER TABLE forums DROP new_test;
 */


/**
CREATE TABLE tbl (
    id INT(11) NOT NULL AUTO_INCREMENT,
    name TINYTEXT NOT NULL,
    PRIMARY KEY (id)
);
INSERT INTO tbl VALUES (NULL, 'Процессоры');
INSERT INTO tbl VALUES (NULL, 'Материнские платы');
INSERT INTO tbl VALUES (NULL, 'Видеоадаптеры');
SELECT * FROM tbl;
*/


/**
INSERT INTO tbl VALUES (10, 20);
INSERT INTO tbl (id_cat, id) VALUES (10, 20);
INSERT INTO tbl (id) VALUES (30);
INSERT INTO tbl () VALUES ();
*/


/**
CREATE TABLE catalogs (
    catalog_id INT(11) NOT NULL,
    name TINYTEXT NOT NULL
);

INSERT INTO `catalogs`(`catalog_id`, `name`) VALUES ('1','Процессоры');
INSERT INTO `catalogs`(`catalog_id`, `name`) VALUES ('2','Память');
INSERT INTO `catalogs`(`catalog_id`, `name`) VALUES ('3',"Память \"DDR\"");
*/

/**
INSERT INTO `tbl` VALUES ('1','2022-05-17 0:00:00', '2022-05-17');
*/

/**
CREATE TABLE news (
    news_id INT(11) NOT NULL AUTO_INCREMENT,
    name TINYTEXT NOT NULL,
    putdate DATETIME NOT NULL,
    PRIMARY KEY (news_id)
);
CREATE TABLE news_contents (
content_id INT(11) NOT NULL AUTO_INCREMENT,
    content TEXT NOT NULL,
    news_id INT(11) NOT NULL,
    PRIMARY KEY (content_id)
);
*/


/**
 * Соединение с базой данных
 */



// Выполняем запрос
$query = "SELECT VERSION() AS version";
$ver = $pdo->query($query);
// Извлекаем результат
$version = $ver->fetch();
echo $version['version']; //10.4.22-MariaDB

echo "<hr>";
/**
 * Использование метода PDO::exec()
 */

// Формируем и выполняем SQL-запрос
$query = "CREATE TABLE catalogs (
             id_catalog INT(11) NOT NULL AUTO_INCREMENT,
             name TINYTEXT NOT NULL,
             PRIMARY KEY (id_catalog))";
//$count = $pdo->exec($query);
//if ($count !== false)
//    echo "Таблица создана успешно";
//else {
//    echo "Не удалось создать таблицу";
//    echo "<pre>";
//    print_r($pdo->errorInfo());
//    echo "<pre>";
//}


/**
 * Обработка ошибок
 */

//Ошибочный запрос
try {
    $query = "SELECT VERSION1() AS version";
    $ver = $pdo->query($query);
    echo $ver->fetch()['version'];
} catch (PDOException $e) {
    echo "Ошибка выполнения запроса: " . $e->getMessage();
}


echo "<hr>";
/**
 * Извлечение данных
 */
$query = "SELECT * FROM catalogs";
$cat = $pdo->query($query);

try {
    while($catalog = $cat->fetch())
        echo $catalog['name']."<br />";
} catch (PDOException $e) {
    echo "Ошибка выполнения запроса: " . $e->getMessage();
}


echo "<hr>";
/**
 * Использование метода fetchAll
 */

try {
    $query = "SELECT * FROM catalogs";
    $cat = $pdo->query($query);

    $catalogs = $cat->fetchAll();
    foreach($catalogs as $catalog)
        echo $catalog['name']."<br />";
} catch (PDOException $e) {
    echo "Ошибка выполнения запроса: " . $e->getMessage();
}


echo "<hr>";
/**
 * Параметризованный запрос
 */
try {
    $query = "SELECT * 
              FROM catalogs
              WHERE catalog_id = :catalog_id";
    $cat = $pdo->prepare($query);
    $cat->execute(['catalog_id' => 1]);
    echo $cat->fetch()['name']; // Процессоры
} catch (PDOException $e) {
    echo "Ошибка выполнения запроса: " . $e->getMessage();
}