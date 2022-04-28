<?php

/**
  UTF-8 самая популярная кодировка
  совместимость с ASCII
  код от 0 до 127 - 1 байт, остальные 2 и более байт
 */
echo "\u{0410}" . "<br>";//А
$str = 'hello world';
$str2 = 'привет мир';
echo $str[1] . "<br>";//h
echo $str2[1] . "<br>";//�

/**
 * *******  Строковые функции  **********
 */
// кол-во символов
echo mb_strlen($str2) . "<br>"; //10

$str = "<?";
if (strpos($str, "<?") !== false) {
    echo "это PHP-программа". "<br>";
}

//удаление пробельных символов в начале и в конце
$str = '   hello world  ';
echo trim($str). "<br>";//hello world
$str = 'hello world';

//позиция символа
echo strpos($str, 'l');//2

//последняя позиция
echo strrpos($str, 'l');//9

//strcmp — Бинарно-безопасное сравнение строк
$var1 = "Hello";
$var2 = "hello";
if (strcmp($var1, $var2) !== 0) {
    echo '$var1 не равно $var2 при регистрозависимом сравнении';
}
//substr — Возвращает подстроку
$rest = substr("abcdef", -1);           // возвращает "f"
$rest = substr("abcdef", -2);           // возвращает "ef"
$rest = substr("abcdef", -3, 1); // возвращает "d"

//str_replace — Заменяет все вхождения строки поиска на строку замены //nl2br
$st = '';
$st = str_replace("\n", "<br />\n", $st);

echo "<br>";

//Транслитерация строк.
function transliterate($st) {
    $st = strtr($st,
        "абвгдежзийклмнопрстуфыэАБВГДЕЖЗИЙКЛМНОПРСТУФЫЭ",
        "abvgdegziyklmnoprstufyeABVGDEGZIYKLMNOPRSTUFYE"
    );
    $st = strtr($st, array(
        'ё'=>"yo",    'х'=>"h",  'ц'=>"ts",  'ч'=>"ch", 'ш'=>"sh",
        'щ'=>"shch",  'ъ'=>'',   'ь'=>'',    'ю'=>"yu", 'я'=>"ya",
        'Ё'=>"Yo",    'Х'=>"H",  'Ц'=>"Ts",  'Ч'=>"Ch", 'Ш'=>"Sh",
        'Щ'=>"Shch",  'Ъ'=>'',   'Ь'=>'',    'Ю'=>"Yu", 'Я'=>"Ya",
    ));
    return $st;
}
echo transliterate("У попа была собака, он ее любил.");

echo "<br>";

//функция превода текста с русского языка в транслит
function transliterate_utf_8($st)
{
    $pattern = ['а', 'б', 'в', 'г', 'д', 'е', 'ё',
        'ж', 'з', 'и', 'й', 'к', 'л', 'м',
        'н', 'о', 'п', 'р', 'с', 'т', 'у',
        'ф', 'х', 'ч', 'ц', 'ш', 'щ', 'ъ',
        'ы', 'ь', 'э', 'ю', 'я',
        'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё',
        'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М',
        'Н', 'О', 'П', 'Р', 'С', 'Т', 'У',
        'Ф', 'Х', 'Ч', 'Ц', 'Ш', 'Щ', 'Ъ',
        'Ы', 'Ь', 'Э', 'Ю', 'Я'];
    $replace = ['a', 'b', 'v', 'g', 'd', 'e', 'yo',
        'zh', 'z', 'i', 'y', 'k', 'l', 'm',
        'n', 'o', 'p', 'r', 's', 't', 'u',
        'f', 'h', 'ch', 'ts', 'sh', 'shch', '\'',
        'y', '', 'e', 'yu', 'ya',
        'A', 'B', 'V', 'G', 'D', 'E', 'Yo',
        'Zh', 'Z', 'I', 'Y', 'K', 'L', 'M',
        'N', 'O', 'P', 'R', 'S', 'T', 'U',
        'F', 'H', 'CH', 'Ts', 'Sh', 'Shch', '\'',
        'Y', '', 'E', 'Yu', 'Ya'];

    return str_replace($pattern, $replace, $st);
}
echo transliterate_utf_8("У попа была собака, он ее любил.");

/**
 * *******  Преобразование символов  ***********
 */

echo "<a href=' /script .php?param•". urlencode('=&cde,cs') . "' >ссылка</a>";


/**
 * ********  Установка локали   *********

    LC_ALL - все нижеперечисленное
    LC_CTYPE - верхний/нижний регистр
    LC_NUMERIC - задаёт символ десятичного разделения (смотрите также localeconv())
    LC_TIME - форматирование даты/времени функцией strftime()
 */
//setlocale(LC_CTYPE, 'ru_RU.UTF-8');
echo "<br>";
/**
 * *********   Функциии форматных преобразований *******
 */

$money1 = 68.75;
$money2 = 54.35;
$money = $money1 + $money2;
echo $money . "<br>";                               //123.1
echo sprintf("%01.2f<br>", $money) . "<br>"; //123.10

echo "<br>";
/**
 * ********  Форматирование текста   *********
 */

//Использование wordwrap().
function cite($ourText, $maxlen = 20, $prefix = "> ") {
    $st = wordwrap($ourText, $maxlen - strlen($prefix), "\n");
    $st = $prefix.str_replace("\n", "\n$prefix", $st);
    return $st;
}
echo "<pre>";
echo cite("The first Matrix I designed was quite naturally 
perfect, it was a work of art - flawless, sublime. A triumph 
equalled only by its monumental failure. The inevitability 
of its doom is apparent to me now as a consequence of the 
imperfection inherent in every human being. Thus, I 
redesigned it based on your history to more accurately reflect 
the varying grotesqueries of your nature. However, I was again 
frustrated by failure.", 20);
echo "</pre>";

echo "<br>";
/**
 * ********  Работа с бинарными данными   *********

 pack(), unpack()
 */

$bindata = pack("nvc*", "Oxl234", "Ox5678", 65, 66);


//сброс буфера
flush();
