<?php

/**
 * ********   Запуск внешних программ   **********
 */

//Выполнить внешнюю программу и отобразить вывод
system('php -v', $result_code);
echo "<br>";
echo $result_code;
echo "<br>";

//Выполнить внешнюю программу
exec('php -v', $output, $retval);
echo "Вернёт статус $retval и значение:<br>";
echo "<pre>";
print_r($output);
echo "</pre>";


/**
 * *********  Терминальные команды из браузера  **********
 */

//открыть файл
if (isset($_POST['open'])) {
$str = `"C:\Users\Пользователь\Pictures\avatar1727352735-0.jpg"`;
}

//скопировать файлы
if (isset($_POST['copy'])) {
    exec('ls C:\Users\Пользователь\Pictures', $files);

    for ($i = 0; $i < 4; $i++) {
        exec("cp C:\Users\Пользователь\Pictures\{$files[$i]} C:\Users\Пользователь\Downloads");
    }
}

//удалить файлы
if (isset($_POST['delete'])) {
    exec('rm C:\Users\Пользователь\Downloads\123.png');
    exec('rm C:\Users\Пользователь\Downloads\223434.png');
    exec('rm C:\Users\Пользователь\Downloads\30_nezamenimykh_telegram_botov_dlya_marketologa.jpg');
    exec('rm C:\Users\Пользователь\Downloads\CV_model_english.pdf');
}
?>

<form action="launching_external_programs.php" method="post">
    <input type="hidden" name="open">
    <button>Открыть</button>
</form>
<form action="launching_external_programs.php" method="post">
    <input type="hidden" name="copy">
    <button>Скопировать</button>
</form>
<form action="launching_external_programs.php" method="post">
    <input type="hidden" name="delete">
    <button>Удалить</button>
</form>

<?php
//обратные опостровы. выполнят команду
$str = `php -v`;
echo $str;

//экранирование командной строки
//escapeshellcmd();


//Открытие канала

//// Запускаем процесс (параллельно работе сценария) в режиме чтения.
//$fp = popen("/usr/sbin/sendmail -t -i", "wb");
//// Передаем процессу тело письма в стандартный входной поток.
//fwrite($fp, "From: our script <script@mail.ru>\n");
//fwrite($fp, "To: someuser@mail.ru\n");
//fwrite($fp, "Subject: here is myself\n");
//fwrite($fp, "\n");
//fwrite($fp, file_get_contents(__FILE__));
//// Не забудем также закрыть канал.
//pclose($fp);

