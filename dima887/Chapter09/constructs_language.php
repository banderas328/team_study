<?php

/**
 *  ********   PHP конструкции в HTML   *********
 */

/**
 * ******* if-else
 */
$state = true;
?>

<?php if ($state === true): ?>
 <h3>Привет. if-else в HTML</h3>
<?php elseif ($state === false): ?>
 <h3>Пока</h3>
<?php else: ?>
 <h3>Что?</h3>
<?php endif; ?>
    <hr>
<?php

/**
 * ******** while
 */
$n = 1;
?>
<?php while ($n <= 3): ?>
    <p>while: <?= $n?></p>
    <?php $n++ ?>
<?php endwhile; ?>
    <hr>
<?php

/**
 * ******** for
 */
?>

<?php for ($i = 1; $i <= 5; $i++): ?>
   <p>for: <?= $i ?></p>
<?php endfor; ?>
    <hr>
<?php
/**
 * break; - выход из цикла
 * continue; - пропуск оставшейся части текущей итерации цикла
 */

/**
 * ******* foreach
 */
?>

<?php foreach ($_SERVER as $key => $value): ?>
    <p><?=$key?> => <?=$value?></p>
<?php endforeach; ?>
    <hr>
<?php
/**
 * ******* switch-case
 */
$color = 'blue';
?>
<?php switch ($color):
        case 'red': ?>
    switch red
        <?php break; ?>
 <?php case 'blue': ?>
    switch blue
        <?php break; ?>
<?php endswitch; ?>
    <hr>
<?php
/**
 * ******** goto

 Позволяет переходить в другую часть программы
*/
//код ниже выведет Bar
goto a;
echo 'Foo';
a:
echo 'Bar';

/**
 *  Подключают и выполняют файл.
 *  include "test.html" -  выдаст только предупреждение (E_WARNING) и сценарий продолжится
 *  require "test.html" - выдаст фатальную ошибку (E_COMPILE_ERROR) и остановит скрипт
 *  include_once "test.html" - подключает данный файл во всей программе только один раз.
 *  require_once "test.html" - подключает данный файл во всей программе только один раз.
 */

/**
 *  *********    Другие инструкции   ************
 *
 * function - объявление функции
 * return -возврат из функции
 * yield - передача управления из генератора
 * class - объявление класса
 * new - создание объекта
 * var, private, static, public - определение свойства класса
 * throw - генерация исключения
 * try-catch - перехват исключения
 */