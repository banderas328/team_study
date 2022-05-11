<?php
define('LINE', 0);
define('CURVE', 1);
define('RECTANGLE', 2);
define('ELLIPSE', 3);

define('BLACK', 0);
define('BLUE', 4);
define('GREEN', 8);
define('YELLOW', 12);
define('ORANGE', 16);
define('RED', 20);
define('WHITE', 24);

echo "желтый прямоугольник в 10 формате: ";
echo RECTANGLE | GREEN;
echo "<br/>";
echo "желтый прямоугольник в 2 формате: ";
echo decbin(RECTANGLE | GREEN);
echo "<br/>";


