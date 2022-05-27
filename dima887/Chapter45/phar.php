<?php


/**
 * ********    PHAR-архивы    **********
 *
 * php.ini
 * phar.readonly = 0 или off
*/

//require_once 'phar://phpinfo.phar/phpinfo.php';

/**
 * Создание PHAR-архива.
 */
try {
    $phar = new Phar('./ispager.phar', 0, 'ispager.phar');
    // Для записи директив phar.readonly конфигурационного
    // файла php.ini должна быть установлена в 0 или Off
    if (!Phar::canWrite()) {
        throw new Exception('PHAR-архив не может быть бы записан');
    }
    // Буферизация записи, ничего не записывается, до
    // тех пор, пока не будет вызван метод stopBuffering()
    $phar->startBuffering();
    // Добавление всех файлов из компонента ISPager
    $phar->buildFromIterator(
        new DirectoryIterator(realpath('../Chapter44/src/ISPager')),
        '../Chapter44/src');
    // Сохранение результатов на жесткий диск
    $phar->stopBuffering();
} catch (Exception $e) {
    echo 'Невозможно открыть PHAR-архив: ', $e;
}


/**
 * Класс Phar реализует интерфейс ArrayAccess.
 */
try {
    $phar = new Phar('./phpinfo.phar', 0, 'phpinfo.phar');
    // Для записи директив phar.readonly конфигурационного
    // файла php.ini должна быть установлена в 0 или Off
    if (Phar::canWrite()) {
        // Буферизация записи, ничего не записывается, до
        // тех пор, пока не будет вызван метод stopBuffering()
        $phar->startBuffering();
        // Формируем файл phpinfo.php
        $phar['phpinfo.php'] = '<?php phpinfo();';
        // Сохранение результатов на жесткий диск
        $phar->stopBuffering();
    } else {
        echo 'PHAR-архив не может быть бы записан';
    }
} catch (Exception $e) {
    echo 'Невозможно открыть PHAR-архив: ', $e;
}


/**
 * Перебор свойств при помощи метода foreach.
 */
try {
    $dir = opendir('phar://ispager.phar/ISPager');
    while(($file = readdir($dir)) !== false) {
        echo "{$file}<br />";
    }
    closedir($dir);
} catch (Exception $e) {
    echo 'Невозможно открыть PHAR-архив: ', $e;
}


/**
 * Создание PHAR-архива с заглушкой.
 */
try {
    $phar = new Phar('./autopager.phar', 0, 'autopager.phar');
    // Для записи директив phar.readonly конфигурационного
    // файла php.ini должна быть установлена в 0 или Off
    if (Phar::canWrite()) {
        // Буферизация записи, ничего не записывается, до
        // тех пор, пока не будет вызван метод stopBuffering()
        $phar->startBuffering();
        // Добавление всех файлов из компонента ISPager
        $phar->buildFromIterator(
            new DirectoryIterator(realpath('../Chapter44/src/ISPager')),
            '../Chapter44/src');
        // Добавляем автозагрузчик в архив
        $phar->addFromString('autoloader.php', file_get_contents('autoloader.php'));
        // Назначаем автозагрузчик в качестве файла-заглушки
        $phar->setDefaultStub('autoloader.php', 'autoloader.php');
        // Сохранение результатов на жесткий диск
        $phar->stopBuffering();
    } else {
        echo 'PHAR-архив не может быть бы записан';
    }
} catch (Exception $e) {
    echo 'Невозможно открыть PHAR-архив: ', $e;
}


/**
 * Использование phar-ахива
 */
require_once('autopager.phar');

$obj = new ISPager\FilePager(
    new ISPager\PagesList(),
    'phar.php');
// Содержимое текущей страницы
foreach($obj->getItems() as $line) {
    echo htmlspecialchars($line)."<br /> ";
}
// Постраничная навигация
echo "<p>$obj</p>";



/**
 * Извлечение содержимого PHAR-архива.
*/
try {
    $phar = new Phar('autopager.phar');
    $phar->extractTo('extract');
} catch (Exception $e) {
    echo 'Невозможно открыть PHAR-архив: ', $e;
}
echo "<hr>";

/**
 * Упаковка произвольных файлов
 */
// Формируем PHAR-архив
$phar = new Phar('text.phar');
$phar->startBuffering();
$phar['text.txt'] = file_get_contents('text.txt');
$phar->stopBuffering();

// Читаем содержимое PHAR-архива
echo nl2br(file_get_contents('phar://text.phar/text.txt'));


/**
 * Хранение бинарных файлов.
 */
try {
    $phar = new Phar('./gallery.phar', 0, 'gallery.phar');
    // Для записи директив phar.readonly конфигурационного
    // файла php.ini должна быть установлена в 0 или Off
    if (Phar::canWrite()) {
        // Буферизация записи, ничего не записывается, до
        // тех пор, пока не будет вызван метод stopBuffering()
        $phar->startBuffering();
        // Добавление всех файлов из папки photos
        foreach(glob('../Chapter44/photos/*') as $jpg) {
            $phar[basename($jpg)] = file_get_contents($jpg);
        }
        // Назначаем файл-заглушку
        $phar['show.php'] = file_get_contents('show.php');
        $phar->setDefaultStub('show.php', 'show.php');
        // Сохранение результатов на жесткий диск
        $phar->stopBuffering();
    } else {
        echo 'PHAR-архив не может быть бы записан';
    }
} catch (Exception $e) {
    echo 'Невозможно открыть PHAR-архив: ', $e;
}

//Использование архива с бинарными данными.
//http://127.0.0.1/php7/team_study/Chapter45/phar.php?image=s_20040815135939.jpg
//require_once('gallery.phar');

echo "<hr>";

//Сжатие архива.
try {
    $phar = new Phar('compress.phar', 0, 'compress.phar');
    if (Phar::canWrite() && Phar::canCompress()) {
        $phar->startBuffering();

        foreach(glob('../Chapter44/photos/*') as $jpg) {
            $phar[basename($jpg)] = file_get_contents($jpg);
        }
        // Назначаем файл-заглушку
        $phar['show.php'] = file_get_contents('show.php');
        $phar->setDefaultStub('show.php', 'show.php');
        // Сжимаем файл
        $phar->compress(Phar::GZ);

        $phar->stopBuffering();
    } else {
        echo 'PHAR-архив не может быть бы записан';
    }
} catch (Exception $e) {
    echo 'Невозможно открыть PHAR-архив: ', $e;
}