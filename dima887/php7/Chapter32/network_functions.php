<?php

/**
 * ********   Сетевые функции   *********
*/

//Пример работы с потоками.
//echo file_get_contents("https://php.net");

//если нужно для входа указать логин и пароль
//echo file_get_contents("https://user:password@php.net");

//echo file_get_contents('file:///etc/hosts');
echo file_get_contents('file:///C:/Windows/system32/drivers/etc/hosts');

/**
 * Потоки
 * https://www.php.net/manual/ru/ref.stream.php
 */

$opts = [
    'http' => [
        'method' => 'GET',
        'user_agent' => 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:42.0)',
        'header' => 'Content-type: text/html; charset=UTF-8'
    ]
];

//echo file_get_contents(
//    'https://php.net',
//    false,
//    stream_context_create($opts)
//);


/**
 * ********* Работа с сокетами
 */

/**
 * "Эмуляция" браузера.
 */
// Соединяемся с Web-сервером localhost. Обратите внимание,
// что префикс "http://" не используется - информация о протоколе
// и так содержится в номере порта (80).
$fp = fsockopen("localhost", 80);
// Посылаем запрос главной страницы сервера. Конец строки
// в виде "\r\n" соответствует стандарту протокола HTTP.
fputs($fp, "GET / HTTP/1.1\r\n");
// Посылаем обязательный для HTTP 1.1 заголовок Host.
fputs($fp, "Host: localhost\r\n");
// Отключаем режим Keep-alive, что заставляет сервер СРАЗУ ЖЕ закрыть
// соединение после посылки ответа, а не ожидать следующего запроса.
// Попробуйте убрать эту строчку - и работа скрипта сильно замедлится.
fputs($fp, "Connection: close\r\n");
// Конец заголовков.
fputs($fp, "\r\n");
// Теперь читаем по одной строке и выводим ответ.
echo "<pre>";
while (!feof($fp))
    echo htmlspecialchars(fgets($fp, 1000));
echo "</pre>";
// Отключаемся от сервера.
fclose($fp);