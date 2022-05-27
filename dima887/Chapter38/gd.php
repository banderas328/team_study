<?php


/**
 * ***************  Работа с изображениями  *************
 *
 * Библиотеки
 * https://imagemagick.org/index.php
 * https://pear.php.net/user/boutell
 *
 * Встроенная библиотека GD
 * https://www.php.net/manual/ru/book.image.php
 * php.ini - extension=gd
*/


/**
 * Автоопределение MIME-типа изображения.
 */

// Выбираем случайное изображение любого формата.
//$fnames = glob("image/*.{gif,jpg,png}", GLOB_BRACE);
//$fname = $fnames[mt_rand(0, count($fnames)-1)];
// Определяем формат.
//$size = getimagesize($fname);
// Выводим изображение.
//header("Content-type: {$size['mime']}");
//echo file_get_contents($fname);


//получение ближайшего в палитре цвета
//imagecolorallocate();

//эффект прозрачности
//imagecolortransparent();

?>

<!-- Текст в картинке. Создание на лету. -->
<img src="button.php?Hello+world!">

<hr>

<!-- Работа с полупрозрачными цветами. -->
<img src="semitransp.php">

<hr>

<!-- Изменение пера. -->
<img src="pen.php">

<hr>

<!-- Увеличение картинки со сглаживанием. -->
<img src="tile.php">

<hr>

<!-- Пример работы с TTF-шрифтом. -->
<img src="ttf.php">

