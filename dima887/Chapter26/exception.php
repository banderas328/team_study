<?php

require_once "PHPExceptionizer/PHP_Exceptionizer.php";

/**
 * *********   Исключения   *********
*/

//Простой пример использования исключений.
echo "Начало программы.<br />";
try {
    // Код, в котором перехватываются исключения.
    echo "Все, что имеет начало...<br />";
    // Генерируем ("выбрасываем") исключение.
    throw new Exception("Hello!");
    echo "...имеет и конец.<br>";
} catch (Exception $e) {
    // Код обработчика.
    echo " Исключение: {$e->getMessage()}<br />";
}
echo "Конец программы.<br />";

echo "<hr>";


/**
 * Раскрутка стека
 */

//Инструкция try во вложенных функциях.
echo "Начало программы.<br />";
try {
    echo "Начало try-блока.<br />";
    outer();
    echo "Конец try-блока.<br />";
} catch (Exception $e) {
    echo " Исключение: {$e->getMessage()}<br />";
}
echo "Конец программы.<br />";
function outer() {
    echo "Вошли в функцию ".__METHOD__."<br />";
    inner();
    echo "Вышли из функции ".__METHOD__."<br />";
}
function inner() {
    echo "Вошли в функцию ".__METHOD__."<br />";
    throw new Exception("Hello!");
    echo "Вышли из функции ".__METHOD__."<br />";
}


echo "<hr>";


/**
 * Наследование исключений.
 */

// Исключение - ошибка файловых операций.
class FilesystemException extends Exception
{
    private $name;
    public function __construct($name)
    {
        parent::__construct($name);
        $this->name = $name;
    }
    public function getName() { return $this->name; }
}
// Исключение - файл не найден.
class FileNotFoundException extends FilesystemException {}
// Исключение - Ошибка записи в файл.
class FileWriteException extends FilesystemException {}

try {
    // Генерируем исключение типа FileNotFoundException.
    if (!file_exists("spoon"))
        throw new FileNotFoundException("spoon");
} catch (FilesystemException $e) {
    // Ловим ЛЮБОЕ файловое исключение!
    echo "Ошибка при работе с файлом '{$e->getName()}'.<br />";
} catch (Exception $e) {
    // Ловим все остальные исключения, которые еще не поймали.
    echo "Другое исключение: {$e->getDirName()}.<br />";
}

echo "<hr>";

/**
 * Синтаксические ошибки
 */

try {
    $str = "Hello world!";
    $str[] = 4;
} catch (Error $e) {
    echo "Обнаружена ошибка приведения типа";
}


echo "<hr>";

/**
 * Использование блока finally
 */

function inverse($x) {
    if (!$x) {
        throw new Exception('Деление на ноль.');
    }
    return 1/$x;
}

try {
    echo inverse(0) . "\n";
    echo 'Продолжение работы программы.' , "\n";
} catch (Exception $e) {
    echo 'Поймано исключение: ',  $e->getMessage(), "\n";
} finally {
    echo "Блок finally.\n";
}

echo "<hr>";


/**
 * Перехват несерьезных ошибок
 * Библиотека PHP_Exceptionizer
*/

// Для большей наглядности поместим основной проверочный код в функцию.
suffer();

// Убеждаемся, что перехват действительно был отключен.
echo "<b>Дальше должно идти обычное сообщение PHP.</b>";
fopen("fork", "r");

function suffer()
{
    // Создаем новый объект-преобразователь. Начиная с этого момента
    // и до уничтожения переменной $w2e все перехватываемые ошибки
    // превращаются в одноименные исключения.
    $w2e = new PHP_Exceptionizer(E_ALL);
    try {
        // Открываем несуществующий файл. Здесь будет ошибка E_WARNING.
        fopen("spoon", "r");
    } catch (E_WARNING $e) {
        // Перехватываем исключение класса E_WARNING.
        echo "<pre><b>Перехвачена ошибка!</b>\n", $e, "</pre>";
    }
    // В конце можно явно удалить преобразователь командой:
     unset($w2e);
    // Но можно этого и не делать - переменная и так удалится при
    // выходе из функции (при этом вызовется деструктор объекта $w2e,
    // отключающий слежение за ошибками).
}
