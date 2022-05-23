<?php


/**
 * **********   Сервер memcached   ***********
 *
 * logfile -m - сколько оперативной памяти в мегабайтах может потреблять сервер
 * -l 127.0.0.1 - только для локального использования
 * -l 0.0.0.0 - доступ для внешних обращений
*/


/**
 * Хранение сессий в memcached
 *
 * в php.ini
 *
 * //хранение сессий в memcached
 * session.save_handler='memcached'
 *
 * //сервер memcached находится локально
 * session.save_path='localhost:11211'
 *
 * //несколько отдельных серверов memcached
 * session.save_path='mem00.domain.com:11211, mem01.domain.com:11211'
*/




/**
 * Помещение данных в memcached
*/


//Соединение с memcached
$m = new Memcached();
$m->addServer('localhost', 11211);


//Добавление значения в memcached
if($m->add("key", "value")){
    echo "Значение успешно установлено: ". $m->get("key");//Значение успешно установлено: value
}

if($m->add("key", "123")){
    echo "Значение успешно установлено: ". $m->get("key");//Значение успешно установлено: value123
}


/**
 * Обработка ошибок
*/

//Обработка ошибок выполнения запросов
if(!$m->add("key", "value")) echo $m->getResultMessage()."<br />";
if(!$m->add("key", "value")) echo $m->getResultMessage()."<br />"; // NOT STORED


//Использование метода getResultCode(), возвращает код ошибки
if (!($key = $m->get('key'))) {
    if ($m->getResultCode() == Memcached::RES_NOTFOUND) {
        $key = 'value';
        $m->add('key', $key);
    }
}
echo $key;


/**
 * Замена данных в memcached
*/

//Переустановка значений методом set()
if(!$m->set("key", "value1")) echo $m->getResultMessage()."<br />";
if(!$m->set("key", "value2")) echo $m->getResultMessage()."<br />";
echo $m->get("key"); // value2


//Установка сразу нескольких значений
$values = [
    "key1" => "value1",
    "key2" => "value2",
    "key3" => "value3"
];

$m->setMulti($values);
// Извлечение значений
foreach(array_keys($values) as $key)
    echo $m->get($key)."<br />";


//Использование метода increment()
// Включаем режим бинарного протокола
$m->setOption(Memcached::OPT_BINARY_PROTOCOL, true);

echo $m->increment("number", 1, 0);


/**
 * Извлечение данных из memcached
*/

//Извлечение сразу нескольких значений
$values2 = [
    "key1" => "value1",
    "key2" => "value2",
    "key3" => "value3"
];

// Установка значений
$m->setMulti($values2);
// Извлечение значений
$results = $m->getMulti(array_keys($values2));
echo "<pre>";
print_r($results);
echo "</pre>";





//Извлечение сразу нескольких значений
$values3 = [
    "key1" => "value1",
    "key2" => "value2",
    "key3" => "value3"
];

// Установка значений
$m->setMulti($values3);
// Извлечение значений
$m->getDelayed(array_keys($values3));
while ($result = $m->fetch()) {
    echo $result['value']."<br />";
}


/**
 * Работа с несколькими серверами
*/

//Соединение с memcached-серверами
$m = new Memcached();
$m->addServers([
    ['localhost', 11211, 10],
    ['localhost', 11212, 10],
]);

//Установка значений методом setByKey()
$arr = ["first", "second", "third", "fourth", "fifth",
    "sixth", "seventh", "eighth", "ninth", "tenth"];
// Размещаем значение на одном из двух сереверов
foreach($arr as $value) {
    if($m->setByKey($value, $value, $value)) {
        echo "Успешно размещено на сервере $value<br />";
    }
}



//Какие сервера выбраны для каждого ключа?
$arr = ["first", "second", "third", "fourth", "fifth",
    "sixth", "seventh", "eighth", "ninth", "tenth"];
// Определяем местоположение ключа
foreach($arr as $key) {
    $server = $m->getServerByKey($key);
    echo "$key => {$server['host']}:{$server['port']}<br />";
}


//Извлечение ключей из нескольких серверов
$arr = ["first", "second", "third", "fourth", "fifth",
    "sixth", "seventh", "eighth", "ninth", "tenth"];

// Извлекаем значения с их серверов
foreach($arr as $key) {
    echo $m->getByKey($key, $key)."<br />";
}



//Группировка ключей
$arr = ["first", "second", "third", "fourth", "fifth",
    "sixth", "seventh", "eighth", "ninth", "tenth"];

// Подготавливаем массив серверов
$keys = [];
foreach($m->getServerList() as $server) {
    $keys["{$server['host']}:{$server['port']}"] = [];
}
// Распределяем ключи по их серверам
foreach($arr as $key) {
    $server = $m->getServerByKey($key);
    $keys["{$server['host']}:{$server['port']}"][] = $key;
}
echo "<pre>";
print_r($keys);
echo "</pre>";



//Удаление ключей из нескольких серверов
$arr = ["first", "second", "third", "fourth", "fifth",
    "sixth", "seventh", "eighth", "ninth", "tenth"];

// Подготавливаем массив серверов
$keys = [];
foreach($m->getServerList() as $server) {
    $keys["{$server['host']}:{$server['port']}"] = [];
}
// Распределяем ключи по их серверам
foreach($arr as $key) {
    $server = $m->getServerByKey($key);
    $keys["{$server['host']}:{$server['port']}"][] = $key;
}
// Удаляем группы ключей с их сервера
foreach($keys as $server => $group) {
    $m->deleteMultiByKey($group[0], $group);
}