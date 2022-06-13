<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Страница с формой</title>
</head>
<body>
    <h1>Формы</h1>
    *****************************************************************
    <form action="action.php" method="post">
        <label>Самая простая форма</label><br>
        Логин: <input type="text" name="login" value=""><br>
        Пароль: <input type="password" name="password" value=""><br>
        <input type="submit" name="form-1" value="Нажмите!">
    </form>
    <br>
    <hr>
    <br>
    <form action="action.php" method="post">
        <label>Если все поля пустые, перенаправит обратно</label><br>
        Логин: <input type="text" name="login" value=""><br>
        Пароль: <input type="password" name="password" value=""><br>
        <input type="submit" name="form-2" value="Нажмите!">
    </form>
    <br>
    <hr>
    <br>
    Ваш IP-адрес: <?= $_SERVER['REMOTE_ADDR'] ?><br>
    Ваш браузер: <?= $_SERVER['HTTP_USER_AGENT'] ?><br>
<?php
    //cookie. Сколько раз пользователь поситил страницу
    $count = 0;
    if (isset($_COOKIE['count'])) $count = $_COOKIE['count'];
    $count++;
    setcookie('count', $count, time() + 5, '/');
    echo 'Количество раз: ' . $count;
?>

    <h1>Обработка списков</h1>
    *****************************************************************
    <form action="action.php" method="post">
        <select name="Sel[]" multiple="multiple">
            <option>First</option>
            <option>Second</option>
            <option>Third</option>
        </select><br>
        <input type="submit" name="form-3" value="Нажмите!">
    </form>

    <h1>Обработка массивов</h1>
    *****************************************************************
    <form action="action.php" method="post">
        <label>Если все поля пустые, перенаправит обратно</label><br>
        Имя: <input type="text" name="Data[name]" value=""><br>
        Адрес: <input type="text" name="Data[address]" value=""><br>
        Город:<br>
        <input type="radio" name="Data[city]" value="Moscow">Москва<br>
        <input type="radio" name="Data[city]" value="Peter">Санкт-Петербург<br>
        <input type="radio" name="Data[city]" value="Minsk">Минск<br>
        <input type="submit" name="form-4" value="Нажмите!">
    </form>
<!--
    [Data] => Array
        (
            [name] => dima
            [address] => nemiga
            [city] => Minsk
        )
-->

    <h1>Особонности флажка checkbox</h1>
    *****************************************************************
    <!--
     При добавлении скрытого поля (hidden), пара "имя_флажка=значение"
     будет доступно даже если они пустые.
      -->
    <form action="action.php">
        Какие языки программирования вы знаете? <br>
        <input type="hidden" name="know[PHP]" value="0">
        <input type="checkbox" name="know[PHP]" value="1">PHP <br>
        <input type="hidden" name="know[Perl]" value="0">
        <input type="checkbox" name="know[Perl]" value="1">Perl <br>
        <input type="submit" name="form-5" value="Нажмите!">
    </form>
</body>
</html>