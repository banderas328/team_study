<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Данные из формы</title>
</head>
<body>


<?php

if (isset($_REQUEST['form-1'])) {
    echo 'Форма 1' . "<br>";
    if ($_REQUEST['login'] == 'user' && $_REQUEST['password'] == 'root') {
        echo 'Доступ открыт для пользователя: ' . $_REQUEST['login'];
    } else {
        echo 'Доступ закрыт!';
    }
} elseif (isset($_REQUEST['form-2'])) {
    if ($_REQUEST['login'] == '' && $_REQUEST['password'] == '') {
        //перенаправить обратно к форме
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        echo 'Форма 2' . "<br>";
        echo 'Доступ открыт!';
    }
} elseif (isset($_REQUEST['form-3'])) {
    echo 'Форма со список 1'. "<br>";
    echo $_REQUEST['Sel'][0] ?? ''; // первый элемент
    echo $_REQUEST['Sel'][1] ?? ''; // второй элемент
    echo $_REQUEST['Sel'][2] ?? ''; // третий элемент
} elseif (isset($_REQUEST['form-4'])) {
    echo "<pre>";
    print_r($_REQUEST);
    echo "</pre>";
} elseif (isset($_REQUEST['form-5'])) {
    echo "<pre>";
    print_r($_REQUEST);
    echo "</pre>";
}


?>
</body>
</html>