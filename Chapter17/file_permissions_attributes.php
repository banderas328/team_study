<?php

/**
 * ********  Права доступа и атрибуты файлов  *********
Права
r - read
w - write
x - execute

Атрибуты
id владельца файла (UID)
id владельца группы (GID)

user | group | other
rwx  | rwx   | rwx

rwxrwxrwx
rwxrwxr-x

d - каталог
drwxrwxr-x


Числовое представление прав доступа
https://acm.bsu.by/wiki/Unix2017b/%D0%9F%D0%BE%D0%BB%D1%8C%D0%B7%D0%BE%D0%B2%D0%B0%D1%82%D0%B5%D0%BB%D0%B8_%D0%B8_%D0%BF%D1%80%D0%B0%D0%B2%D0%B0#:~:text=%D0%A2%D1%80%D0%B8%20%D0%B2%D0%B0%D1%80%D0%B8%D0%B0%D0%BD%D1%82%D0%B0%20%D0%B7%D0%B0%D0%BF%D0%B8%D1%81%D0%B8%20%D0%BF%D1%80%D0%B0%D0%B2%20%D0%BF%D0%BE%D0%BB%D1%8C%D0%B7%D0%BE%D0%B2%D0%B0%D1%82%D0%B5%D0%BB%D1%8F
 */

// Защтщенный от записи файл
//-r--r--r--

//права доступа UID
echo fileowner('file_permissions_attributes.php');

echo "<br>";

//права доступа GID
echo filegroup('file_permissions_attributes.php');

echo "<br>";

//Использование функции fileperms()

// Получаем права доступа и тип файла
$perms = fileperms("file.txt");
// Преобразуем результат в восьмеричную систему счисления
echo decoct($perms) . "<br>"; // 100664
// Преобразуем результат в двоичную систему счисления
echo decbin($perms); // 1000000110100100


echo "<br>";

/**
 * ***********   Определение типа файла.    ************
 */

// Получаем права доступа и тип файла
$perms = fileperms("file.txt");

// Определяем тип файла
if (($perms & 0xC000) == 0xC000)
    echo "Сокет";
elseif (($perms & 0xA000) == 0xA000)
    echo "Символическая ссылка";
elseif (($perms & 0x8000) == 0x8000)
    echo "Обычный файл";
elseif (($perms & 0x6000) == 0x6000)
    echo "Специальный блочный файл";
elseif (($perms & 0x4000) == 0x4000)
    echo "Каталог";
elseif (($perms & 0x2000) == 0x2000)
    echo "Специальный символьный файл";
elseif (($perms & 0x1000) == 0x1000)
    echo "FIFO-канал";
else
    echo "Неизвестный файл";

echo "<br>";

echo filetype('file.txt');

echo "<pre>";
print_r(stat('file.txt'));
echo "</pre>";

echo filectime('file.txt');

