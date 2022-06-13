<?php

/**
 *  ********   Переменное число пераметров   ***********
*/

function myEcho1()
{
    for ($i = 0; $i < func_num_args(); $i++) {
        echo func_get_arg($i) . "<br>";//выводим элемент
    }
}
myEcho1('Меркурий', 'Венера', 'Земля', 'Марс');

echo "<he>";

function myEcho2()
{
    foreach (func_get_args() as $v) {
        echo "$v<br>";//выводим элемент
    }
}
myEcho2('Меркурий', 'Венера', 'Земля', 'Марс');

echo "<hr>";

function myEcho3(...$planets)
{
    foreach ($planets as $v) {
        echo "$v<br>";//выводим элемент
    }
}
myEcho3('Меркурий', 'Венера', 'Земля', 'Марс');

/**
 * ******  Глобальная переменная  **********
 */

global $a;
unset($a); //удалит ссылку
unset($GLOBALS['a']); //удалит глобальную переменную

/**
 * *********  Статаческая переменная  *********
 */
//сколько раз вызывалась фунеция
function selfCount()
{
    static $count = 0;
    $count++;
    echo $count;
}
for ($i = 0; $i < 5; $i++) selfCount(); //12345

/**
 * ******* Рекурсия  *******
*/

function factor($n)
{
    if ($n <= 0) return 1;
    else return $n * factor($n - 1);
}
//echo factor(20);

//вывод всего что только есть
function dumper($obj)
{
    echo "<pre>",
    htmlspecialchars(dumperGet($obj)),
    "</pre>";
}

function dumperGet(&$obj, $leftSp = "")
{
    if (is_array($obj)) {
        $type = "Array[" . count($obj) . "]";
    }elseif (is_object($obj)) {
        $type = "Object";
    }elseif (gettype($obj) == "boolean") {
        return $obj? "true" : "false";
    }else {
        return "\"$obj\"";
    }
    $buf = $type;
    $leftSp .= "    ";
//    for (Reset($obj); list($k, $v) = each($obj);) {
//        if ($k === "GLOBALS") continue;
//        $buf .= "\n$leftSp$k => " . dumperGet($v, $leftSp);
//    }
    return $buf;
}
//dumper($GLOBALS);

/**
 * *******  Условно определяемые функции  ********
 */

if (PHP_OS == "WINNT") {
    function myChown($fname, $attr) {
        return 1;
    }
}else {
    function myChown($fname, $attr) {
        return chown($fname, $attr);
    }
}
echo "<hr>";
/**
 * ********   Анонимная функция   ********
 */
$myEcho = function (...$str)
{
    foreach ($str as $v) {
        echo "$v<br>";
    }
};

$myEcho('Меркурий', 'Венера', 'Земля', 'Марс');
echo "<hr>";
//анонимная функция в качестве параметра
function tabber($spaces, $echo, ...$planets)
{
    $new = [];
    foreach ($planets as $planet) {
        $new[] = functions_and_scopes . phpstr_repeat("&nbsp;", $spaces);
    }
    $echo(...$new);
}
$planets = ['Меркурий', 'Венера', 'Земля', 'Марс'];
tabber(10, function (...$str) {
    foreach ($str as $v) {
        echo "$v<br>";
    }
}, ...$planets);


/**
 * ********  Замыкание  **********
 */

$message = "Работа не может быть продолжена из-за ошибок<br>";
$check = function (array $errors) use ($message)
{
    if (isset($errors) && count($errors) > 0) {
        echo $message;
        foreach ($errors as $error) {
            echo "$error<br>";
        }
    }
};
$check([]);
$errors[] = "Заполните имя пользователя";
$check($errors);
$message = "Список требований"; //Уже не изменить
$errors = ["PHP", "MySQL", "memcache"];
$check($errors);

//функция возвращает ссылку
$a = 100;
function &r()
{
    global $a;
    return $a;
}
$b =& r();
$b = 0;
echo $a;//0

//скорость работы
function takeVal($a) { $x = $a[1234]; }
function takeRef(&$a) { $x = $a[1234]; }
function takeValAndModif($a) { $a[1234]++; }
function takeRefAndModif(&$a) { $a[1234]++; }

test("takeVal");//0takeVal took 5979151 itr/sec
test("takeRef");//takeRef took 6164748 itr/sec
test("takeValAndModif");//takeValAndModif took 825 itr/sec
test("takeRefAndModif");//takeRefAndModif took 5530275 itr/sec

function test($func)
{
    $a = [];
    for ($i = 1; $i <= 100000; $i++) $a[$i] = $i;
    for ($t = time(); $t == time(););
    for ($N = 0, $t = time(); time() == $t; $N++) $func($a);
    printf("<tt>$func</tt> took %d itr/sec<br>", $N);

}