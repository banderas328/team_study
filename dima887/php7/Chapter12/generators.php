<?php

/**
 * *********  Генераторы   **********

 yield
 yield from - доступ внутри генератора к другому генератору.
 as - Доступ к ключа как у массивов
 Генераторы возвращают объект.
 */

function simple($from = 0, $to = 100)
{
    for($i = $from; $i < $to; $i++) {
        echo "значение = $i<br />";
        yield $i;
    }
}

foreach(simple() as $val) {
    echo "квадрат = ".($val * $val)."<br />";
    if ($val >= 5) break;
}

echo "<hr>";

//Обработка каждого элемента массива.
function collect($arr, $callback)
{
    foreach($arr as $value) {
        yield $callback($value);
    }
}

$arr = [1, 2, 3, 4, 5, 6];
$collect = collect($arr, function($e){ return $e * $e; });
foreach($collect as $val) echo "$val ";//1 4 9 16 25 36

echo "<hr>";

//Извлекаем только четные элементы.
function select($arr, $callback)
{
    foreach($arr as $value) {
      if($callback($value)) yield $value;
    }
}

$arr = [1, 2, 3, 4, 5, 6];
$select = select($arr, function($e){ return $e % 2 == 0 ? true : false; });
foreach($select as $val) echo "$val ";//2 4 6

echo "<hr>";

/**
 * *****  Комбинирование генераторов  ******
*/
//Квадраты четных элементов.
$arr = [1, 2, 3, 4, 5, 6];
$select = select($arr, function($e){ return $e % 2 == 0 ? true : false; });
$collect = collect($select, function($e){ return $e * $e; });
foreach($collect as $val) echo "$val ";//4 16 36

echo "<hr>";

/**
 * ********  Делегирование генераторов   ***********

  Один генератор внутри другого, при помощи yield from
*/
//Использование yield from.
function square($value)
{
    yield $value * $value;
}
function even_square($arr)
{
    foreach($arr as $value) {
        if($value % 2 == 0) yield from square($value);
    }
}
$arr = [1, 2, 3, 4, 5, 6];
foreach(even_square($arr) as $val) echo "$val ";//4 16 36

echo "<hr>";

//Использование массивов.
function generator()
{
    yield 1;
    yield from [2, 3];
}

foreach(generator() as $i) echo "$i ";//1 2 3

echo "<hr>";
/**
 * **********  Экономия ресурсов  ***********
*/
//Не экономное расходование памяти
function crange_bad($size)
{
    $arr = [];
    for($i = 0; $i < $size; $i++) {
        $arr[] = $i;
    }
    return $arr;
}
$range = crange_bad(1024000);
//foreach($range as $i) echo "$i ";
echo memory_get_usage()."<br />";//36060344 - кол-во потребляемой памяти
function crange_good($size)
{
    for($i = 0; $i < $size; $i++) {
        yield $i;
    }
}

$range = crange_good(1024000);
//foreach($range as $i) echo "$i ";
echo memory_get_usage()."<br />";//413584 - кол-во потребляемой памяти

echo "<hr>";

/**
 * ******** Возврат значения по ссылке  **********
 */
function &reference()
{
    $value = 3;
    while ($value > 0) {
        yield $value;
    }
}

foreach (reference() as &$number) {
    echo (--$number).' ';//2 1 0
}

echo "<br>";

/**
 * ******** Каждый генератор - это объект *************
 */
//
function simple_new($from = 0, $to = 100)
{
    for($i = $from; $i < $to; $i++) {
        echo "значение = $i<br />";
        yield $i;
    }
}
$generator = simple_new();
echo gettype($generator); // object

echo "<br>";

//Отправка данных генератору методом send()
function block()
{
    while(true) {
        $string = yield;
        echo $string;
    }
}

$block = block();
$block->send("Hello, world!<br />");
$block->send("Hello, PHP!<br />");

echo "<br>";

/**
 * *******  Использование return в генераторе *********
 */

function generator_new()
{
    yield 1;
    return yield from two_three();
    yield 5;
}

function two_three()
{
    yield 2;
    yield 3;
    return 4;
}

$generator = generator_new();

foreach($generator as $i) {
    echo "$i ";
}
echo "return = ".$generator->getReturn();//1 2 3 return = 4