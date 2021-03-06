<?php


/**
 * *********  Загрузка файлов на сервер   ************
*/


// PHP автоматически создает переменные при закачке.
if (@$_REQUEST['do1Upload'])
    echo '<pre>Содержимое $_FILES: '.print_r($_FILES, true)."</pre><hr />";
?>
Выберите какой-нибудь файл в форме ниже:
<form action="<?=$_SERVER['SCRIPT_NAME']?>" method="POST" enctype="multipart/form-data">
    <input type="file" name="myFile">
    <input type="submit" name="do1Upload" value="Закачать">
</form>

<hr>

<?php
/**
 * Простейший фотоальбом с возможностью закачки.
 */
$imgDir = "img";        // каталог для хранения изображений
@mkdir($imgDir, 0777);  // создаем, если его еще нет

// Проверяем, нажата ли кнопка добавления фотографии.
if (@$_REQUEST['doUpload']) {
    $data = $_FILES['file'];
    $tmp = $data['tmp_name'];
    // Проверяем, принят ли файл.
    if (is_uploaded_file($tmp)) {
        $info = @getimagesize($tmp);
        // Проверяем, является ли файл изображением.
        if (preg_match('{image/(.*)}is', $info['mime'], $p)) {
            // Имя берем равным текущему времени в секундах, а
            // расширение - как часть MIME-типа после "image/".
            $name = "$imgDir/".time().".".$p[1];
            // Добавляем файл в каталог с фотографиями.
            move_uploaded_file($tmp, $name);
        } else {
            echo "<h2>Попытка добавить файл недопустимого формата!</h2>";
        }
    } else {
        echo "<h2>Ошибка закачки #{$data['error']}!</h2>";
    }
}

// Теперь считываем в массив наш фотоальбом.
$photos = array();
foreach (glob("$imgDir/*") as $path) {
    $sz = getimagesize($path); // размер
    $tm = filemtime($path);    // время добавления
    // Вставляем изображение в массив $photos.
    $photos[$tm] = [
        'time' => $tm,              // время добавления
        'name' => basename($path),  // имя файла
        'url'  => $path,            // его URI
        'w'    => $sz[0],           // ширина картинки
        'h'    => $sz[1],           // ее высота
        'wh'   => $sz[3]            // "width=xxx height=yyy"
    ];
}
// Ключи массива $photos - время в секундах, когда была добавлена
// та или иная фотография. Сортируем массив: наиболее "свежие"
// фотографии располагаем ближе к его началу.
krsort($photos);
// Данные для вывода готовы. Дело за малым - оформить страницу.
?>
<!DOCTYPE html>
<html lang='ru'>
<head>
    <title>Простейший фотоальбом с возможностью закачки</title>
    <meta charset='utf-8'>
</head>
<body>
<form action="<?=$_SERVER['SCRIPT_NAME']?>" method="POST" enctype="multipart/form-data">
    <input type="file" name="file"><br>
    <input type="submit" name="doUpload" value="Закачать новую фотографию">
    <hr>
</form>
<?php foreach($photos as $n=>$img) {?>
<p><img style="width: 300px; height: 180px"
        src="<?=$img['url']?>"
        <?=$img['wh']?>
        alt="Добавлена <?=date("d.m.Y H:i:s", $img['time'])?>"
    >
    <?php } ?>
</body>
</html>





<!DOCTYPE html>
<html lang='ru'>
<head>
    <title>PHP автоматически создает переменные при закачке</title>
    <meta charset='utf-8'>
</head>
<body>
<?php ## PHP обрабатывает и сложные имена полей закачки.
if (@$_REQUEST['do2Upload'])
    echo '<pre>Содержимое $_FILES: '.print_r($_FILES, true)."</pre><hr />";
?>
<form action="<?=$_SERVER['SCRIPT_NAME']?>" method="POST" enctype="multipart/form-data">
    <h3>Выберите тип файлов в вашей системе:</h3>
    Текстовый файл: <input type="file" name="input[a][text]"><br />
    Бинарный файл: <input type="file" name="input[a][bin]"><br />
    <input type="submit" name="do2Upload" value="Отправить файлы">
</form>
</body>
</html>