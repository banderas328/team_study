<?php

require_once(__DIR__ . '/vendor/autoload.php');

try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=development_db',
        'root',
        '',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
}
catch (PDOException $e) {
    echo "Невозможно установить соединение с базой данных";
}


/**
 * **********   Компоненты   *********
 */


/**
 * Теперь можно использовать компонент Monolog
 */
$log = new Monolog\Logger('name');
$handler = new Monolog\Handler\StreamHandler('app.log', Monolog\Logger::WARNING);
$log->pushHandler($handler);
$log->addWarning('Предупреждение');


/**
 * Интерактивный отладчик
 */
$log->pushHandler($handler);
//Вызываем интерактивный отладчик
eval(\Psy\sh());
$log->addWarning('Предупреждение');



/**
 * Компонент phinx https://book.cakephp.org/phinx/0/en/index.html
 * //инициализация нового проекта
 * ./vendor/bin/phinx init
 *
 * //создание миграции
 * ./vendor/bin/phinx create CreateUserTable
 *
 * //выполнение миграции
 * ./vendor/bin/phinx migrate -e development
 *
 * //откат миграций
 * ./vendor/bin/phinx rollback -e development
 *
 * //создание тестовых данных
 * ./vendor/bin/phinx seed:create UsersSeeder
 *
 * сохранение тестовых данных
 * ./vendor/bin/phinx seed:run -e development
 *
 * //выполнение конкретного seed-файла
 * ./vendor/bin/phinx seed:run -s UsersSeeder -e development
 */