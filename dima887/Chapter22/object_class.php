<?php

/**
 * *********  Объекты и классы  **********
 */


/**
 * Деструктор.
 */

// Класс, упрощающий ведение разного рода журналов.
class FileLogger
{
    public $f;          // открытый файл
    public $name;       // имя журнала
    public $lines = []; // накапливаемые строки
    public $t;
    // Создает новый файл журнала или открывает дозапись в конец
    // существующего. Параметр $name - логическое имя журнала.
    public function __construct($name, $fname)
    {
        $this->name = $name;
        $this->f = fopen($fname, "a+");
        $this->log("### __construct() called!");
    }
    // Гарантировано вызывается при уничтожении объекта.
    // Закрывает файл журнала.
    public function __destruct()
    {
        $this->log("### __destruct() called!");
        // Вначале выводим все накопленные данные.
        fputs($this->f, join("", $this->lines));
        // Затем закрываем файл.
        fclose($this->f);
    }
    // Добавляет в журнал одну строку. Она не попадает в файл сразу
    // же, а записывается в буфер и остается там до вызова __destruct().
    public function log($str)
    {
        // Каждая строка предваряется текущей датой и именем журнала.
        $prefix = "[".date("Y-m-d_h:i:s ")."{$this->name}] ";
        $str = preg_replace('/^/m', $prefix, rtrim($str));
        // Сохраняем строку.
        $this->lines[] = $str."\n";
    }
}
//for ($n = 0; $n < 10; $n++) {
//    $logger = new FileLogger("test$n", "test.log");
//    $logger->log("Hello!");
//    // Теперь нет необходимости заботиться о корректном
//    // уничтожении объекта - PHP делает все сам!
//}

// Класс, обозначающий отца семьи.
class Father
{
    // Список детей, сразу после создания объекта - пустой.
    public $children = [];
    // Выводит сообщения в момент уничтожения объекта.
    function __destruct() { echo "Father умер.<br />"; }
}
// Ребенок некоторого отца.
class Child
{
    // Кто отец этого ребенка?
    public $father;
    // Создает нового ребенка (с указанием его отца).
    function __construct(Father $father) { $this->father = $father; }
    function __destruct() { echo "Child умер.<br />"; }
}
// Жил да был Авраам.
$father = new Father;
// Авраам родил Исаака.
$child = new Child($father);
// ...и прописал его на своей жилплощади.
//$father->children[] = $child;
echo "Пока что все живы... Убиваем всех.<br />";
// Прошло время, и все умерли.
$father = $child = null;
echo "Все умерли, конец программы.<br />";
// Но программа говорит, что остались зомби!


//Отключить сборщик мусора в php.ini zend.enable_gc off

echo "<hr>";
/**
 * ******   self
 */
//Использование статических членов класса.
class Counter
{
    // Скрытый статический член класса - общий для всех объектов.
    private static $count = 0;
    // Конструктор увеличивает счетчик на 1. Обратите внимание
    // на синтаксис доступа к статическим переменным класса!
    public function __construct() { self::$count++; }
    // Деструктор же - уменьшает.
    public function __destruct() { self::$count--; }
    // Статическая функция, возвращает счетчик объектов.
    public static function getCount() { return self::$count; }
    // Как видите, установить счетчик в произвольное значение
    // извне нельзя, можно только получить его значение. Вот он,
    // модификатор private "в действии".
}
// Создаем 6 объектов.
for ($objs = [], $i = 0; $i < 6; $i++)
    $objs[] = new Counter();
// Статические функции можно вызывать точно так же, как будто
// бы это - обычный метод объекта. При этом $this все равно
// не передается, он просто игнорируется.
echo "Сейчас существует {$objs[0]->getCount()} объектов.<br />";
// Удаляем один объект.
$objs[5] = null;
// Счетчик объектов уменьшится!
echo "А теперь - {$objs[0]->getCount()} объектов.<br />";
// Удаляем все объекты.
$objs = [];
// Другой способ вызова статического метода - с указанием класса.
// Это очень похоже на вызов функции из библиотеки.
echo "Под конец осталось - ".Counter::getCount()." объектов.<br />";



echo "<hr>";
//Локальное кэширование ресурса по идентификатору.
class FileLoggerCache
{
    // Массив всех созданных объектов-журналов.
    static public $loggers = [];
    // Время создания объекта.
    private $time;
    // Закрытый конструктор: создание объектов извне запрещено!
    private function __construct($fname)
    {
        // Запоминаем время создания этого объекта.
        $this->time = microtime(true);
    }
    // Открытый метод, предназначенный для создания объектов класса.
    // Создать новый объект можно только с его помощью!
    public static function create($fname)
    {
        // Вначале проверяем: возможно, объект для указанного имени
        // файла уже существует? Тогда его и возвращаем.
        if (isset(self::$loggers[$fname]))
            return self::$loggers[$fname];
        // А иначе создаем полностью новый объект и сохраняем ссылку
        // на него в статическом массиве.
        return self::$loggers[$fname] = new self($fname);
    }
    // Возвращает время создания объекта.
    public function getTime() { return $this->time; }
    // Дальше могут идти остальные методы класса.
}
// Пример использования класса.
//$logger = new FileLoggerCache("a"); // Нельзя! Доступ закрыт!
$logger1 = FileLoggerCache::create("file.log"); // ОК!
sleep(1); // как будто бы программа немного поработала
$logger2 = FileLoggerCache::create("file.log"); // ОК!
// Выводим времена создания обоих объектов.
echo "{$logger1->getTime()}, {$logger2->getTime()} ";




echo "<hr>";
/**
 * ****** Клонирование объектов
 * если private function __clone(), тогда клонирование запрещено
 */

//$a = new MathComplex2(314, 101);
//$x = new MathComplex2(0, 0);
//// Создаем КОПИЮ объекта $x.
//$y = clone $x;
//// Теперь $x и $y полностью различны.
//$y->add($a);
//// При этом $x не изменяется!
//echo "x=", $x, ", y=", $y;
//// Попробуйте убрать clone - вы увидите, что $x и $y имеют
//// одинаковые значения, ибо ссылаются на один и тот же объект.

//Переопределение функции клонирования.
class Human
{
    private static $i = 25550690;
    // Идентификатор объекта.
    public $dna;
    public $text;
    // Конструктор. Присваивает очередной идентификатор.
    public function __construct()
    {
        $this->dna = self::$i++;
        $this->text = "There is no spoon?";
    }
    // При клонировании идентификатор модифицируется.
    public function __clone()
    {
        $this->dna = $this->dna."(cloned)";
    }
}
// Создаем новый объект...
$neo = new Human;
// ...и его клон.
$virtual = clone $neo;
// Убеждаемся в том, что их идентификаторы различаются.
echo "Neo DNA id: {$neo->dna}, text: {$neo->text}<br />";
echo "Virtual twin id: {$virtual->dna}, text: {$virtual->text}<br />";


echo "<hr>";
/**
 * ********  __sleep(), __wakeup()
 */
class User
{
    public $name;
    public $password;
    public $referer;
    public $time;

    public function __construct($name, $password)
    {
        $this->name = $name;
        $this->password = $password;
        $this->referer = $_SERVER['PHP_SELF'];
        $this->time = time();
    }

    public function __sleep(): array
    {
        return ['name', 'referer', 'time'];
    }

    public function __wakeup(): void
    {
        $this->time = time();
    }
}

$obj = new User('dima', 'password777');

echo "<pre>";
print_r($obj);
echo "</pre>";
$object = serialize($obj);
sleep(2);
$obj = unserialize($object);
echo $object;
echo "<pre>";
print_r($obj);
echo "</pre>";
