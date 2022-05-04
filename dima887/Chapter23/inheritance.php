<?php


/**
 * ********   Наследование   **********
 */

/**
 *  self::, static::
 */

//self не позволяет переопределить метод.
class Base
{
    public static function title()
    {
        echo __CLASS__;
    }
    public static function test()
    {
        self::title();
        //static::title();
    }
}

class Child extends Base
{
    public static function title()
    {
        echo __CLASS__;
    }
}
Child::test(); // Base


echo "<hr>";
/**
 * Анонимные классы
 */

//Использование анонимных классов
//Анонимные классы могут также наследоваться
class Dumper
{
    public static function print($obj)
    {
        print_r($obj);
    }
}
Dumper::print( new class {
    public $title;
    public function __construct(){
        $this->title = "Hello world!";
    }
}); //class@anonymous Object ( [title] => Hello world! )



echo "<hr>";
require_once "page/StaticPage.php";
function echoPage($obj)
{
    $class = "Page";
    if (!($obj instanceof $class))
        die("Argument 1 must be an instance of $class.<br />");
    $obj->render();
}
$page = new StaticPage(3);
echoPage($page);