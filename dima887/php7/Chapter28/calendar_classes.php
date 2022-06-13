<?php

/**
 * ******  Календарные классы PHP   *******
 */

/**
 * DateTime
 */

//Использование DateTime.
$date = new DateTime();
echo $date->format("d-m-Y H:i:s"); // 11-05-2022 18:18:46

//Явная установка даты.
$date = new DateTime("2016-01-01 00:00:00");
echo $date->format("d-m-Y H:i:s"); // 01-01-2016 00:00:00

// константы DateTime https://www.php.net/manual/ru/class.datetime.php
//Использование констант класса DateTime.
$date = new DateTime("2016-01-01 00:00:00");
echo $date->format(DateTime::RSS); // Fri, 01 Jan 2016 00:00:00 +0000

echo "<hr>";

/**
 * DateTimeZone
 */
//Использование класса DateTimeZone.
$date = new DateTime("2016-01-01 00:00:00",
    new DateTimeZone("Europe/Moscow"));
echo $date->format("d-m-Y H:i:s"); // 01-01-2016 00:00:00

echo "<hr>";

/**
 * DateInterval
 */

//Разница во времени
//Использование метода diff()
$date = new DateTime('2015-01-01 0:0:0');
$nowdate = new DateTime();
$interval = $nowdate->diff($date);
// Выводим результаты
echo $date->format("d-m-Y H:i:s")."<br />";
echo $nowdate->format("d-m-Y H:i:s")."<br />";
// Выводим разницу
echo $interval->format("%Y-%m-%d %H:%S")."<br />";
// Выводим дамп интервала
echo "<pre>";
print_r($interval);
echo "</pre>";

//Создание интервала DateInterval при помощи конструктора.
$nowdate = new DateTime();
$date = $nowdate->sub(new DateInterval("P3Y1M14DT12H19M2S"));
echo $date->format("Y-m-d H:i:s")."<br />";

echo "<hr>";

/**
 * DatePeriod
 */

//Использование DatePeriod
$now = new DateTime();
$step = new DateInterval('P1W');
$period = new DatePeriod($now, $step, 5);

foreach($period as $datetime) {
    echo $datetime->format("Y-m-d")."<br />";
}