<?php

/**
* Создание картинки "на лету"
*/

// Получаем строку, которую нам передали в параметрах
$string = $_SERVER['QUERY_STRING'] ?? "Hello, world!";
// Загружаем рисунок фона с диска.
$im = imageCreateFromGif("image/button.gif");
// Создаем в палитре новый цвет - черный.
$txtcolor = "FFFF00";
sscanf($txtcolor, '%2x%2x%2x', $red, $green, $blue);
//$txtcolor = sprintf('%2x%2x%2x', $red, $green, $blue);
$color = imageColorAllocate($im, $red, $green, $blue);
//$color = imageColorAllocate($im, 0, 0, 0);
// Вычисляем размеры текста, который будет выведен.
$px = (imageSX($im)-6.5*strlen($string))/2;
// Выводим строку поверх того, что было в загруженном изображении.
imageString($im, 3, $px, 1, $string, $color);
// Сообщаем о том, что далее следует рисунок PNG.
header("Content-type: image/png");
// Теперь - самое главное: отправляем данные картинки в
// стандартный выходной поток, т. е. в браузер.
imagePng($im);
// В конце освобождаем память, занятую картинкой.
imageDestroy($im);