<?php 
define('RECTANGLE', 2);
define('GREEN', 8);
$angle = 45 << 5;
$height = 15 << 14;
$width = 15 << 23;
echo RECTANGLE | GREEN | $angle | $height | $width;

