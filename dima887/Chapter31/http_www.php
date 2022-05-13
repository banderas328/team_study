<?php

/**
 * *******   Работа с HTTP и WWW   ********
*/

//Перенаправляет браузер на другой сайт
//header("Location: https://php.net");
//exit();


/**
 * Функция для запрета кэширования страницы браузером.
 */
function nocache() {
    header("Expires: Thu, 19 Feb 1998 13:24:18 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-cache, must-revalidate");
    header("Cache-Control: post-check=0,pre-check=0");
    header("Cache-Control: max-age=0");
    header("Pragma: no-cache");
}

/**
 * Получение заголовков запроса.
 */
//$headers = getallheaders();
//Header("Content-type: text/plain");
//print_r($headers);


/**
 * ******* Cookie
 */

//Счетчик посещения страницы одним пользователем.
$counter = $_COOKIE['counter'] ?? 0;
$counter++;
setcookie("counter", $counter, time() + 10);
# Внимание! $_COOKIE['counter'] этот вызов не обновляет!
# Новое значение будет доступно только при следующем посещении.
echo "Вы запустили этот сценарий $counter раз(а).";

echo "<hr>";

/**
 * Ручной разбор QUERY_STRING.
 */
$str = "sullivan=paul&names[roy]=noni&names[read]=tom";
parse_str($str, $out);
echo "<pre>"; print_r($out); echo "</pre>";

/**
 * Пример разбора URL.
 */
$url = "http://username:password@host.com:80/path?arg=value#anchor";
echo "<pre>"; print_r(parse_url($url)); echo "</pre>";


/**
 * В PHP нет функции, обратной к parse_url()
 * Ниже пример реализации такой функции
 */

//Составление URL по массиву параметров.
// Составляет URL по частям из массива $parsed.
// Функция обратна к parse_url().
function http_build_url($parsed)
{
    if (!is_array($parsed)) return false;
    // Задан протокол?
    if (isset($parsed['scheme'])) {
        $sep = (strtolower($parsed['scheme']) == 'mailto' ? ':' : '://');
        $url = $parsed['scheme'] . $sep;
    } else {
        $url = '';
    }
    // Задан пароль или имя пользователя?
    if (isset($parsed['pass'])) {
        $url .= "$parsed[user]:$parsed[pass]@";
    } elseif (isset($parsed['user'])) {
        $url .= "$parsed[user]@";
    }
    // QUERY_STRING представлена в виде массива?
    if (@!is_scalar($parsed['query'])) {
        // Преобразуем в строку.
        $parsed['query'] = http_build_query($parsed['query']);
    }
    // Дальше составляем URL.
    if (isset($parsed['host']))     $url .= $parsed['host'];
    if (isset($parsed['port']))     $url .= ":".$parsed['port'];
    if (isset($parsed['path']))     $url .= $parsed['path'];
    if (isset($parsed['query']))    $url .= "?".$parsed['query'];
    if (isset($parsed['fragment'])) $url .= "#".$parsed['fragment'];
    return $url;
}

// URL, с которым будем работать.
$url = "http://user@example.com:80/path?arg=value#anchor";
// Другие примеры, которые вы можете испробовать.
//   $url = "/path?arg=value#anchor";
//   $url = "thematrix.com";
//   $url = "http://thematrix.com/#top"; # без '/' перед '#' не работает!
// Разбираем URL на части.
$parsed = parse_url($url);
// Разбираем одну из частей, QUERY_STRING, на элементы массива.
parse_str(@$parsed['query'], $query);
// Добавляем новый элемент в массив QUERY_STRING.
$query['names']['read'] = 'tom';
// Собираем QUERY_STRING назад из массива.
$parsed['query'] = http_build_query($query);
// Создаем результирующий URL.
$newurl = http_build_url($parsed);
// Выводим результаты работы.
echo "Старый URL: $url<br>";
echo "Новый: $newurl";