<?php

/**
 * *********   Дата и время   ***********
 */


date_default_timezone_set("Europe/Moscow");
echo date_default_timezone_get();

//echo microtime();

echo "<br>";

list($frac, $sec) = explode(" " , microtime());
$time = $frac + $sec;
//echo $time;
//или
define("START_TIME", microtime(true));
echo START_TIME;

echo "<br>";

$time = microtime(true);
printf("С начала эпохи Unix: %f секунд.<br />", $time);
echo "С начала эпохи Unix: $time секунд.<br />";

echo "<br>";

echo date("l dS of F Y h:i:s A") . "<br/>";
echo date("Сегодня d.m.Y") . "<br/>";
echo date("Этот файл датирован d.m.Y", filectime(__FILE__)) . "<br/>";


// Активизируем текущую локаль (иначе дата будет на английском).
setlocale(LC_ALL, 'ru_RU.UTF-8');
// Выводим 2 предложения.
echo strftime("%B %Y года, %d число. Был %A, часы показывали %H:%M.");

echo "<br>";

echo date ("M-d-Y", mktime (0, 0, 0, 1,  1,2005));

echo "<br>";

$check = [
    "now",
    "10 September 2015",
    "+1 day",
    "+1 week",
    "+1 week 2 days 4 hours 2 seconds",
    "next Thursday",
    "last Monday",
];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Использование функции strtotime()</title>
    <meta charset='utf-8'>
</head>
<body>
<table width="100%">
    <tr align="left">
        <th>Входная строка</th>
        <th>Timestamp</th>
        <th>Получившаяся дата</th>
        <th>Сегодня</th>
    </tr>
    <?php foreach ($check as $str) {?>
        <tr>
            <td><?=$str?></td>
            <td><?=$stamp = strtotime($str)?></td>
            <td><?=date("Y-m-d H:i:s", $stamp)?></td>
            <td><?=date("Y-m-d H:i:s", time())?></td>
        </tr>
    <?php } ?>
</table>
</body>
</html>
<?php

echo "<pre>";
print_r(getdate());
echo "<pre>";



$jd = gregoriantojd(10, 11, 1970);
echo $jd . "<br>";
$gregorian = jdtogregorian($jd);
echo $gregorian . "<br>";

echo "<br>";
printf("Время работы скрипта: %.5f c", microtime(true) - START_TIME);