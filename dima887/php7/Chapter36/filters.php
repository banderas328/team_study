<?php


/**
 * **********  Фильтрация и проверка данных  ***********
*/


/**
 * Проверка электронного адреса.
 */

$email_correct = 'igorsimdyanov@gmail.com';
$email_wrong   = 'igorsimdyanov@//gmail.com';
echo "correct=" . filter_var($email_correct, FILTER_VALIDATE_EMAIL)."<br />";
echo "wrong=  " . filter_var($email_wrong, FILTER_VALIDATE_EMAIL)."<br />";


echo "<hr>";
/**
 * Фильтрация электронного адреса.
 */

echo filter_var($email_correct, FILTER_SANITIZE_EMAIL)."<br />";
echo filter_var($email_wrong, FILTER_SANITIZE_EMAIL)."<br />";


echo "<hr>";
/**
 * Проверка данных.
 */

$boolean = "yes";
if(filter_var($boolean, FILTER_VALIDATE_BOOLEAN))
    echo "$boolean корректное булевое значение<br />";
else
    echo "$boolean некорректное булевое значение<br />";

$float = "3.14";
if(filter_var($float, FILTER_VALIDATE_FLOAT))
    echo "$float корректное значение с плавающей точкой<br />";
else
    echo "$float некорректное значение с плавающей точкой<br />";

$url = "http://github.com";
if(filter_var($url, FILTER_VALIDATE_URL))
    echo "$url корректный адрес<br />";
else
    echo "$url некорректный адрес<br />";



echo "<hr>";
/**
 * Проверка IP-адреса.
 */

echo filter_var(
        '37.29.74.55',
        FILTER_VALIDATE_IP,
        FILTER_FLAG_NO_PRIV_RANGE)."<br />"; // 37.29.74.55
echo filter_var(
        '192.168.0.1',
        FILTER_VALIDATE_IP,
        FILTER_FLAG_NO_PRIV_RANGE)."<br />"; // false
echo filter_var(
        '127.0.0.1',
        FILTER_VALIDATE_IP,
        FILTER_FLAG_NO_PRIV_RANGE)."<br />"; // 127.0.0.1?
echo filter_var('37.29.74.55',
        FILTER_VALIDATE_IP,
        FILTER_FLAG_NO_RES_RANGE)."<br />"; // 37.29.74.55
echo filter_var(
        '192.168.0.1',
        FILTER_VALIDATE_IP,
        FILTER_FLAG_NO_RES_RANGE)."<br />"; // 192.168.0.1
echo filter_var(
        '127.0.0.1',
        FILTER_VALIDATE_IP,
        FILTER_FLAG_NO_RES_RANGE)."<br />"; // false

echo filter_var(
        '37.29.74.55',
        FILTER_VALIDATE_IP,
        FILTER_FLAG_IPV4)."<br />"; // 37.29.74.55
echo filter_var(
        '37.29.74.55',
        FILTER_VALIDATE_IP,
        FILTER_FLAG_IPV6)."<br />"; // false

echo filter_var(
        '2a03:f480:1:23::ca',
        FILTER_VALIDATE_IP,
        FILTER_FLAG_IPV4)."<br />"; // false
echo filter_var(
        '2a03:f480:1:23::ca',
        FILTER_VALIDATE_IP,
        FILTER_FLAG_IPV6)."<br />"; // 2a03:f480:1:23::ca



echo "<hr>";
/**
 * Проверка вхождения числа в диапазон.
 */


$first = 100;
$second = 5;

$options = [
    'options' => [
        'min_range' => -10,
        'max_range' => 10,
    ]
];

if(filter_var($first, FILTER_VALIDATE_INT, $options))
    echo "$first входит в диапазон -10 .. 10<br />";
else
    echo "$first не входит в диапазон -10 .. 10<br />";

if(filter_var($second, FILTER_VALIDATE_INT, $options))
    echo "$second входит в диапазон -10 .. 10<br />";
else
    echo "$second не входит в диапазон -10 .. 10<br />";




echo "<hr>";
/**
 * Проверка регулярным выражением.
 */

$first = "chapter01";
$second = "ch02";

// Соответствие строкам вида "ch01", "ch15"
$options = [
    'options' => [
        'regexp' => "/^ch\d+$/"
    ]
];

if(filter_var($first, FILTER_VALIDATE_REGEXP, $options))
    echo "$first корректный идентификатор главы<br />";
else
    echo "$first некорректный идентификатор главы<br />";

if(filter_var($second, FILTER_VALIDATE_REGEXP, $options))
    echo "$second корректный идентификатор главы<br />";
else
    echo "$second некорректный идентификатор главы<br />";



echo "<hr>";
/**
 * Использование функции filter_var_array().
 */


// Проверяемые значения
$data = [
    'number' => 5,
    'first'  => 'chapter01',
    'second' => 'ch02',
    'id'     => 2
];
// Фильтры
$definition = [
    'number' => [
        'filter'  => FILTER_VALIDATE_INT,
        'options' => ['min_range' => -10, 'max_range' => 10]
    ],
    'first' => [
        'filter'  => FILTER_VALIDATE_REGEXP,
        'options' => ['regexp' => '/^ch\d+$/']
    ],
    'second' => [
        'filter'  => FILTER_VALIDATE_REGEXP,
        'options' => ['regexp' => '/^ch\d+$/']
    ],
    'id' => FILTER_VALIDATE_INT
];
// Осуществляем проверку
$result = filter_var_array($data, $definition);
echo "<pre>";
print_r($result);
echo "<pre>";



echo "<hr>";
/**
 *  Значение по умолчанию.
 */

$options = [
    'options' => [
        'min_range' => -10,
        'max_range' => 10,
        'default' => 10
    ]
];

echo filter_var(1000, FILTER_VALIDATE_INT, $options); // 10


echo "<hr>";
/**
 * Фильтры очистки   *********************
 */


/**
 * Фильтрация URL-адреса.
 */

$url = 'params=Привет мир!';
echo filter_var($url, FILTER_SANITIZE_ENCODED);
// params%3D%D0%9F%D1%80%D0%B8%D0%B2%D0%B5%D1%82%20%D0%BC%D0%B8%D1%80%21



echo "<hr>";
/**
 * Экранирование.
 */

$arr = [
    'Deb\'s files',
    'Symbol \\',
    'print "Hello world!"'
];
echo "<pre>";
print_r($arr);
echo "<pre>";
$result = filter_var_array($arr, FILTER_SANITIZE_ADD_SLASHES);
echo "<pre>";
print_r($result);
echo "<pre>";



echo "<hr>";
/**
 * Очистка целого числа.
 */

$number = "4342hello";
echo filter_var($number, FILTER_SANITIZE_NUMBER_INT)."<br />"; // 4342
echo intval($number)."<br />";                                       // 4342

$number = "3.14";
echo filter_var($number, FILTER_SANITIZE_NUMBER_INT)."<br />"; // 314
echo intval($number);                                                // 3



echo "<hr>";
/**
/**
 * Обработка текста.
 */

$str = <<<MARKER
<h1>Заголовок</h1>
<p>Первый параграф, посвященный "проверке"</p>
MARKER;
echo "<pre>";
echo filter_var($str, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
echo "</pre>";


echo "<hr>";
/**
 * Пользовательская фильтрация данных   *********************
*/


/**
 * Пользовательская фильтрация данных.
 */

function filterTags($value) {
    return strip_tags($value);
}
$str = <<<MARKER
<h1>Заголовок</h1>
<p>Первый параграф, посвященный "проверке"</p>
MARKER;
echo "<pre>";
echo filter_var($str, FILTER_CALLBACK, ['options' => 'filterTags']);
echo "</pre>";



echo "<hr>";
/**
 * Фильтрация внешних данных   *********************
*/

$value = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$result = filter_input(
    INPUT_POST,
    'search',
    FILTER_CALLBACK,
    [
        'options' => function ($value) {
            // Фильтруем слова меньше 3-х символов
            $value = preg_replace_callback(
                "/\b([^\s]+?)\b/u",
                function($match) {
                    if(mb_strlen($match[1]) > 3)
                        return $match[1];
                    else
                        return '';
                },
                $value);
            // Удаляем тэги
            return strip_tags($value);
        }
    ]
);

?>
<form method="POST">
    <input type="text" name="search" value="<?= $value?>"><br />
    <input type="submit" value="Фильтровать">
</form>
<?= $result; ?>
