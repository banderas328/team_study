<?php

/**
 * *******  Математические функции  ********
 */

//Извлечение строки со случайным номером
$ourFile = fopen("large.txt", "r");
for ($i= 0; $s = fgets($ourFile, 10000); $i++)
    if (mt_rand(0, $i) == 0) $line = $s;
echo $line;
echo "<br />";

//Последовательность случайных чисел
mt_srand(1);
for ($i = 0; $i < 5; $i++) echo mt_rand() . " mathematical_functions.php";
echo "<br />";
mt_srand(1);
for ($i = 0; $i < 5; $i++) echo mt_rand() . " mathematical_functions.php";

echo "<br />";
echo pow(0 ,-1);//INF


echo "<br />";
//deg2rad — Преобразует значение из градусов в радианы
echo deg2rad(234);


