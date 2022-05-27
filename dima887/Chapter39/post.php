<?php


/**
 * Отправка данных методом POST
 */

// Задаем адрес удаленного сервера
$curl = curl_init("http://127.0.0.1/php7/team_study/dima887/Chapter39/handler.php");

// Передача данных осуществляется методом POST
curl_setopt($curl, CURLOPT_POST, 1);
// Задаем POST-данные
$data = "name=".urlencode("Дима").
    "&pass=".urlencode("пароль")."\r\n\r\n";
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

// Выполняем запрос
curl_exec($curl);
// Закрываем CURL соединение
curl_close($curl);