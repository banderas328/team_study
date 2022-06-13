<?php

require_once "lib/FS.php";

/**
 * *********   Итераторы    **********
 */


// Для примера - открываем директорию, в которой много картинок.
$d = new FSDirectory(".");
foreach ($d as $path => $entry) {
    if ($entry instanceof FSFile) {
        // Если это - файл, а не поддиректория...
        echo "<tt>$path</tt>: ".$entry->getSize()."<br>";
    }
}

echo "<hr>";

//Использование виртуальных массивов.
/*
  * Класс представляет собой массив, ключи которого нечувствительны
  * к регистру символов. Например, ключи "key", "kEy" и "KEY" с точки
  * зрения данного класса выглядят идентичными (в отличие от стандартных
  * массивов PHP, в которых они различаются).
  */
class InsensitiveArray implements ArrayAccess
{
    // Здесь будем хранить массив элементов в нижнем регистре.
    private $a = [];
    // Возвращает true, если элемент $offset существует.
    public function offsetExists($offset)
    {
        $offset = strtolower($offset);  // переводим в нижний регистр
        $this->log("offsetExists('$offset')");
        return isset($this->a[$offset]);
    }
    // Возвращает элемент по его ключу.
    public function offsetGet($offset)
    {
        $offset = strtolower($offset);
        $this->log("offsetGet('$offset')");
        return $this->a[$offset];
    }
    // Устанавливает новое значение элемента по его ключу.
    public function offsetSet($offset, $data)
    {
        $offset = strtolower($offset);
        $this->log("offsetSet('$offset', '$data')");
        $this->a[$offset] = $data;
    }
    // Удаляет элемент с указанным ключом.
    public function offsetUnset($offset)
    {
        $offset = strtolower($offset);
        $this->log("offsetUnset('$offset')");
        unset($this->array[$offset]);
    }
    // Служебная функция для демонстрации возможностей.
    public function log($str)
    {
        echo "$str<br>";
    }
}
// Проверка.
$a = new InsensitiveArray();
$a->log("## Устанавливаем значения (оператор =).");
$a['php'] = 'There is more than one way to do it.';
$a['php'] = 'Это значение должно переписаться поверх предыдущего.';
$a->log("## Получаем значение элемента (оператор []).");
$a->log("<b>значение:</b> '{$a['php']}'");
$a->log("## Проверяем существование элемента (оператор isset()).");
$a->log("<b>exists:</b> ".(isset($a['php'])? "true" : "false"));
$a->log("## Уничтожаем элемент (оператор unset()).");
unset($a['php']);



/**
 * ********     SPL      **********
 */


/**
 * DirectoryIterator
 */

//Использование класса DirectoryIterator.
$dir = new DirectoryIterator('.');
foreach($dir as $file) {
    echo $file."<br />";
}
//Использование методов класса DirectoryIterator.
$dir = new DirectoryIterator('.');
foreach($dir as $file) {
    // Выводим только файлы
    if ($file->isFile()) {
        // Имя файла и его размер
        echo $file." ".$file->getSize()."<br />";
    }
}


/**
 * FileIterator
 */

//Создание фильтра ExtensionFilter.
class ExtensionFilter extends FilterIterator
{
    // Фильтруемое расширение
    private $ext;
    // Итератор DirectoryIterator
    private $it;

    // Конструктор
    public function __construct(DirectoryIterator $it, $ext)
    {
        parent::__construct($it);
        $this->it = $it;
        $this->ext = $ext;
    }

    // Метод, определяющий, удовлетворяет текущий элемент
    // фильтру или нет
    public function accept()
    {
        if (!$this->it->isDir()) {
            $ext = pathinfo($this->current(), PATHINFO_EXTENSION);
            return $ext != $this->ext;
        }
        return true;
    }
}

$filter = new ExtensionFilter(
    new DirectoryIterator('.'),
    'php'
);

foreach($filter as $file) {
    echo $file."<br />";
}

/**
 * LimitIterator
 */
//Использование класса LimitIterator
$limit =  new LimitIterator(
    new ExtensionFilter(new DirectoryIterator('.'), "php"),
    0, 5);

foreach($limit as $file) {
    echo $file."<br />";
}

/**
 * ****  Рекурсивные итераторы   **********
 */

//Рекурсивная функция для вывода содержимого каталога
function recursion_dir($path)
{
    static $depth = 0;

    $dir = opendir($path);
    while(($file = readdir($dir)) !== false) {
        if ($file == '.' || $file == '..' ) continue;
        echo str_repeat("-", $depth)." $file<br />";

        if (is_dir("$path/$file")) {
            $depth++;
            recursion_dir("$path/$file");
            $depth--;
        }
    }
    closedir($dir);
}

recursion_dir('.');

//Рекурсивный обход каталога при помощи итераторов
$dir = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator('.'),
    true);

foreach ($dir as $file)
{
    echo str_repeat("-", $dir->getDepth())." $file<br />";
}