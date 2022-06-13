<?php


/**
 * **********   Посылка писем через PHP   *********
*/

/**
 * Отправка почты по шаблону (плохой вариант).
 */
// Этот текст может быть получен, например, из базы данных,
// или являться сообщением форума или гостевой книги.
$text = "Cookies need love like everything does.";
// Получатели письма.
$tos = ["movchan.1997@inbox.ru", "habr.paddle@mail.ru"];
// Считываем шаблон.
$tpl = file_get_contents("mail.eml");
// Отправляем письма в цикле по получателям.
foreach ($tos as $to) {
    // Заменяем элементы шаблона.
    $mail = $tpl;
    $mail = strtr($mail, [
        "{TO}"   => $to,
        "{TEXT}" => $text,
    ]);
    // Разделяем тело сообщения и заголовки.
    list ($head, $body) = preg_split("/\r?\n\r?\n/s", $mail, 2);
    // Отправляем почту. Внимание! Опасный прием!
    //mail("", "", $body, $head);
}


/**
 * Отправка почты по шаблону (без кодирования).
 */
// Подключаем функцию mailx() (см. ниже).
include_once "lib/mailx.php";
// Этот текст может быть получен, например, из базы данных,
// или являться сообщением форума или гостевой книги.
$text = "Cookies need love like everything does.";
// Получатели письма.
$tos = ["test@gmail.com", "test@mail.ru"];
// Считываем шаблон.
$tpl = file_get_contents("mail.eml");
// Отправляем письма в цикле по получателям.
foreach ($tos as $to) {
    // Заменяем элементы шаблона.
    $mail = $tpl;
    $mail = strtr($mail, [
        "{TO}"   => $to,
        "{TEXT}" => $text,
    ]);
    // Вызываем mailx(), включенную из файла.
    //mailx($mail);
}


/**
 * Отправка почты по шаблону (наилучший способ).
 */

// Подключаем функции.
include_once "lib/mailenc.php";
$text = "Well, now, ain't this a surprise?";
$tos = ["Пупкин Василий <poupkinne@mail.ru>, Иванов <b@mail.ru>"];
$tpl = file_get_contents("mail.eml");
foreach ($tos as $to) {
    $mail = $tpl;
    $mail = strtr($mail, [
        "{TO}"   => $to,
        "{TEXT}" => $text,
    ]);
    $mail = mailenc($mail);
    //mailx($mail);
}


/**
 * Отправка почты с использованием активного шаблона.(PHP)
 */

// Подключаем функции.
include_once "lib/template.php";
$text = "Well, now, ain't this a surprise?";
$tos = ["Пупкин Василий <poupkinne@mail.ru>"];
$a = 1;
foreach ($tos as $to) {
    // "Разворачиваем" шаблон, передавая ему $to и $text.
    $mail = template("mail.php.eml", [
        "to"   => $to,
        "text" => $text,
    ]);
    // Дальше как обычно: кодируем и отправляем.
    $mail = mailenc($mail);
    //mailx($mail);
}

/**
 * Отправка встроенных изображений.
 */
include "lib/attach.php";
// Отправляем почтовое сообщение
$picture[0] = "s_20040815135808.jpg";
$picture[1] = "s_20040815135939.jpg";
$mail_to = "sombody@somewhere.ru";
$thm     = "Тема сообщения";
$html = "<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML ".
    "4.01 Transitional//EN\">
           <html>
             <head><title>Почтовая рассылка</title></head>
             <body><img src='cid:".md5($picture[0])."' border='0'>Тело сообщения<br /><br /><img src='cid:".md5($picture[1])."' border='0'></body>
           </html>";
//if(send_mail($mail_to, $thm, $html, $picture)) {
//    echo "Успех ".date("d.m.Y H:i");
//} else {
//    echo "Не отправлено";
//}