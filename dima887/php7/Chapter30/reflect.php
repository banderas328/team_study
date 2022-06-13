<?php

require_once "lib/MathComplex2.php";

/**
 * *********   Отражения   **********
 *
 * Позволяет получить данные о данных
 * сведения о структуре классов, методов, свойств и т.д.
*/

/**
 * Неявный список аргументов
 */

//Неявный вызов метода.
$addMethod = "add";
$a = new MathComplex2(101, 303);
$b = new MathComplex2(0, 6);
// Вызываем метод add() неявным способом.
call_user_func([$a, $addMethod], $b);
echo $a; // (101, 309)

echo "<hr>";

$args = [101, 6];
function test() { echo __FUNCTION__; };
class TestA { public function test() { echo __METHOD__; } public static function test2() { echo __METHOD__; } };
$obj = new TestA();
//вызываем функцию test() с аргументами в массиве
$result = call_user_func_array("test", $args); echo "<br>";
//вызываем метод test() у объекта
$result = call_user_func_array([$obj, "test"], $args); echo "<br>";
//вызываем статический метод
$result = call_user_func_array(['TestA', 'test2'], $args);

echo "<hr>";

/**
 * Инстанцирование классов
 */

//Создание объекта неизвестного класса.
$className = "MathComplex2";
// Создаем новый объект.
$obj = new $className(6, 1);
echo "Созданный объект: $obj"; echo "<hr>";

/**
 * Использование неявных аргументов
 */

//Создание объекта неизвестного класса (reflection API).
$args = [1, 2];
// Создаем объект, хранящий всю информацию о классе.
// Фактически, ReflectionClass является "классом, хранящим
// сведения о другом классе".
$class = new ReflectionClass($className);
// Создаем объект класса явным способом.
$obj = $class->newInstance(101, 303);
echo "Первый объект: $obj<br />";
// Но мы не смогли использовать $args, а вынуждены были указать
// параметры явным образом. Теперь создаем объект класса НЕЯВНО.
$obj = call_user_func_array([$class, "newInstance"], $args);
echo "Второй объект: $obj<br />";


/**
 * Аппарат отражений
 */

function throughTheDoor($which) { echo "(get through the $which door)"; }
$func = new ReflectionFunction('throughTheDoor');
$func->invoke("left"); //(get through the left door)
echo "<hr>";

/**
 * ReflectionFunction
 */

try {
    $obj = new ReflectionFunction("spoon");
} catch (ReflectionException $e) {
    echo "Исключение: ", $e->getMessage();
}

//Документирование
/**
 * Документация для следующей ниже
 * функции (после "/**" не должно быть пробелов!)
 */
function func() {}
$obj = new ReflectionFunction("func");
echo "<pre>".$obj->getDocComment()."</pre>";

echo "<hr>";

//Наследования и модификаторы доступа.
// Класс с единственным ЗАКРЫТЫМ свойством.
class Base
{
    private $prop = 0;
    function getBase() { return $this->prop; }
}
// Класс с открытым свойством, имеющим такое же имя, как и в базовом.
// Это свойство будет полностью обособленным.
class Derive extends Base
{
    public $prop = 1;
    function getDerive() { return $this->prop; }
}

echo "<pre>";
$cls = new ReflectionClass('Derive');
$obj = $cls->newInstance();
$obj->prop = 2;
// Распечатываем значения свойств и убеждаемся, что они не пересекаются.
echo "Base: {$obj->getBase()}, Derive: {$obj->getDerive()}<br />";
// Распечатываем свойства производного класса.
var_dump($cls->getProperties());
// Распечатываем методы производного класса.
var_dump($cls->getMethods());