<?php

//try {
//    $pdo = new PDO('mysql:host=localhost;dbname=forum', 'root', '');
//}
//catch (PDOException $e) {
//    echo "Невозможно установить соединение с базой данных";
//}


/**
 * Обработка ошибки соединения с базой данных
 */

try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=forum',
        'root',
        '',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
}
catch (PDOException $e) {
    echo "Невозможно установить соединение с базой данных";
}