<?php

/**
 * ************  Работа с сетью   ************
*/


/**
 * Использование CURL.
 */
// Задаем адрес удаленного сервера
$curl = curl_init("https://www.php.net/");
// Получаем содержимое страницы
//echo curl_exec($curl);
// Закрываем CURL-соединение
curl_close($curl);


/**
 * Получение HTTP-заголовков.
 */

function get_content($hostname)
{
    // Задаем адрес удаленного сервера
    $curl = curl_init($hostname);

    // Вернуть результат в виде строки
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    // Включить в результат HTTP-заголовки
    curl_setopt($curl, CURLOPT_HEADER, 1);
    // Исключить тело HTTP-документа
    curl_setopt($curl, CURLOPT_NOBODY, 1);

    // Получаем HTTP-заголовки
    $content = curl_exec($curl);
    // Закрываем CURL соединение
    curl_close($curl);

    // Преобразуем строку $content в массив
    return explode("\r\n", $content);
}

$hostname = "https://www.php.net/";
$out = get_content($hostname);

echo "<pre>";
print_r($out);
echo "</pre>";


/**
 * Передача пользовательского агента.
 */

// Задаем адрес удаленного сервера
$curl = curl_init("http://127.0.0.1/php7/team_study/Chapter39/handler.php");

// Устанавливаем реферер
$useragent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1";
curl_setopt($curl, CURLOPT_USERAGENT, $useragent);

// Выполняем запрос
curl_exec($curl);
// Закрываем CURL соединение
curl_close($curl);