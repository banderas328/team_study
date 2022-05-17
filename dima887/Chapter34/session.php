<?php


/**
 * **********   Управление сессиями   ***********
*/

/**
 * Пример работы с сессиями.
 */

session_start();
// Если на сайт только-только зашли, обнуляем счетчик.
if (!isset($_SESSION['count'])) $_SESSION['count'] = 0;
// Увеличиваем счетчик в сессии.
$_SESSION['count'] = $_SESSION['count'] + 1;
?>
<h2>Счетчик</h2>
В текущей сессии работы с браузером Вы открыли эту страницу
<?= $_SESSION['count'] ?> раз(а).<br />
Закройте браузер, чтобы обнулить счетчик.<br />
<a href="<?= $_SERVER['SCRIPT_NAME'] ?>" target="_blank">Открыть дочернее окно браузера</a>.

<hr>
<?php

/**
 * Уничтожение сессии
 */

//Очистить данные сессии для текущего сценария
//$_SESSION = [];
//Удвлить cookie, соответствующую SID
//unset($_COOKIE[session_name()]);
//Уничтожить хранилище сессии
//session_destroy();


/**
 * Имя группы сессий
 */

//session_start(['session.name' => 'PHPSESSID']);

//Идентификатор сессии
echo session_id() . "<br>";

//Путь к временному каталогу
echo session_save_path() . "<br>";;


/**
 * Вместо изменения имени группы, лучше хранить данные в подмассиве.
 */

$forum_session =& $_SESSION['forum_subsystem'];

$forum_session['count'] += 2;

$auth_session =& $_SESSION['auth_subsystem'];

$auth_session['count'] += 1;

$auth_session['is_authorized'] = true;

echo $forum_session['count'] . "<br>";
echo $auth_session['count'] . "<br>";


/**
 * Устанавливает пользовательские обработчики хранения сессии
 */

//session_set_save_handler();