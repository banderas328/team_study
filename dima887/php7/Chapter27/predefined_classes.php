<?php

/**
 * *******   Предопределенные классы PHP  **********
*/

/**
 * Directory
 */
//Чтение содержимого каталога.

// Открываем каталог
$cat = dir("../");
// Читаем содержимое каталога
while(($file = $cat->read()) !== false) {
    echo $file."<br />";
}
// Закрываем каталог
$cat->close();


echo "<hr>";


// Открываем текущий каталог
$dirname = "./";
$cat = dir($dirname);

// Устанавливаем счетчики файлов и подкаталогов в нулевое значение
$file_count = 0;
$dir_count = 0;

// Подсчитываем количество файлов и подкаталогов
while(($file = $cat->read()) !== false) {
    if (is_file($dirname.$file)) $file_count++;
    else $dir_count++;
}
// Не учитываем
$dir_count = $dir_count - 2;
// Выводим количество файлов и подкаталогов
echo "Каталог $dirname содержит $file_count файлов
        и $dir_count подкаталогов<br />";

// Устанавливаем указатель каталога в начало
$cat->rewind();

// Читаем содержимое каталога
while(($file = $cat->read()) !== false) {
    if ($file != "." && $file != "..") {
        echo $file."<br />";
    }
}
// Закрываем каталог
$cat->close();

echo "<hr>";

/**
 * Generator
 */

//Использование генератора без foreach

function simple($from = 0, $to = 100)
{
    for($i = $from; $i < $to; $i++) {
        yield $i;
    }
}

$obj = simple(1, 5);
// Выполняем цикл, пока итератор не достигнет конца
while($obj->valid()) {
    echo ($obj->current() * $obj->current())." ";
    // К следующему элементу
    $obj->next();
}

echo "<hr>";

/**
 * Closure
 */

//Захваченные замыканием переменные хранятся в объекте Closure.

$message = "Работа не может быть продолжена из-за ошибок:<br />";
$check = function(array $errors) use ($message) {
    if (isset($errors) && count($errors) > 0) {
        echo $message;
        foreach($errors as $error) {
            echo "$error<br />";
        }
    }
};

echo "<pre>";
print_r($check);
echo "</pre>";


//Использование метода bindTo()
class View
{
    protected $pages = [];
    protected $title = 'Контакты';
    protected $body = 'Содержимое страницы Контакты';

    public function addPage($page, $pageCallback)
    {
        $this->pages[$page] = $pageCallback->bindTo($this, __CLASS__);
    }

    public function render($page)
    {
        $this->pages[$page]();

        $content = <<<HTML
<!DOCTYPE html>
<html lang='ru'>
<head>
<title>{$this->title()}</title>
<meta charset='utf-8'>
</head>
<body>
  <p>{$this->body()}</p>
</body>
</html>
HTML;
        echo $content;

    }

    public function title()
    {
        return htmlspecialchars($this->title);
    }

    public function body()
    {
        return nl2br(htmlspecialchars($this->title));
    }
}

$view = new View();
$view->addPage('about', function() {
    $this->title = 'О нас';
    $this->body = 'Содержимое страницы О нас';
});
$view->render('about'); // О нас

echo "<hr>";

/**
 * IntlChar
 *
 * Нужно в php.ini: extension=php_intl.dll
 */

//числовой код для UTF-8
echo IntlChar::ord("A");  //65
echo IntlChar::chr(65);  //A

//преобразовать в верхний регистр
echo IntlChar::toupper('a'); //A

//проверка принадлежит ли классу цифр
echo IntlChar::isalnum('5'); //true

//проверка принадлежит ли классу алфавитных символов
echo IntlChar::isalnum('h');  //true

//проверка принадлежит ли классу алфавитных символов
echo IntlChar::isspace(' ');  //true

//и т.д.