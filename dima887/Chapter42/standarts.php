<?php



/**
 * **********   Стандарты PSR   ************
*/


/**
 * Стандарт PSR-1
 *
 * //именование классов
 * CamelCase-стиль
 *
 * //именнование методов
 * camelCase-стиль
 *
 * //именование констант
 * HELLO_WORLD
 */

namespace Vendor\Storage;

class Storage
{
    const VERSION = '1.0';

    public function getVersion()
    {
        return Storage::VERSION;
    }
}


/**
 * Стандарт PSR-2
 *
 * 4 пробела вместо tab
 * ?> не использовать в конце
 * длина строки не более 80 символов
 * 1 пробел после ключевых слов управляющих структур
 */
//Отступы - 4 пробела
function tabber($spaces, $echo, ...$planets)
{
    // Подготавливаем аргументы для myecho()
    $new = [];
    foreach ($planets as $planet)
    {
        $new[] = standarts . phpstr_repeat("&nbsp;", $spaces);
    }
    // Пользовательский вывод задается из вне
    $echo(...$new);
}

//Управляющие структуры
if (isset($_GET['number'])) {
    for ($i = 0; $i < $_GET['number']; $i++) {
        echo "PSR<br />";
    }
} else {
    echo "Не передан GET-параметр number<br />";
}

/**
 * Стадарт PSR-3
 *
 * плейсхолдеры
 */

function interpolate($message, array $context = [])
{
    // Построение массива подстановки с фигурными скобками
    // вокруг значений ключей массива context.
    $replace = [];
    foreach ($context as $key => $val) {
        $replace['{' . $key . '}'] = $val;
    }

    // Подстановка значений в сообщение и возврат результата.
    return strtr($message, $replace);
}

// Сообщение с плейсхолдером, имя которого обрамлено
// фигурными скобками.
$message = "User {username} created";

// Массив context с данными для замены плейсхолдера на
// итоговое значение.
$context = ['username' => 'bolivar'];

// Результат: "User bolivar created"
echo interpolate($message, $context);

/**
 * Стандарт PSR-4
 *
 * Автозагрузка классов
 */


/**
 * Стандарт PSR-6
 *
 * Кэширование
 */


/**
 * Стандарт PSR-7
 *
 * HTTP-сообщения
 */