<?php



/**
 * ************   Администрирование MySQL   *************
 *
 * sudo apt-get install mysql-server
 * sudo mysql_secure_installation
 *
 * Конф. файл
 * /etc/mysql/my.cnf
 *
 * Пользовательский конф.файл
 * /etc/mysql/.my.cnf
*/

/**
 * Создание MySQL-пользователя
 * CREATE USER ' username'@'localhost' IDENTIFIED BY 'password';
 *
 * GRANT - назначает привилегии
 * GRANT ALL ON *.* TO 'wet'@'localhost' IDENTIFIED BY 'pass';
 *
 * Просмотр привилегий
 * SHOW GRANT;
 *
 * REVOKE - удаляет привилегии
 * REVOKE DELETE, UPDATE ON shop.* FROM 'wet'@'localhost';
 *
 * DROP - удаляет пользователя
 *
 * Восстановление утерянного пароля
 * SET PASSWORD FOR user = PASSWORD('password')
*/



/**
 * Перенос баз данных с одного сервера на другой
*/

/**
 * Копирование бинарных файлов
 *
 * fpm - структура таблицы, имена полей, типы, параметры
 * MYD - данные таблицы
 * MYI - индексная информация
 *
 * Блокировка таблиц
 * FLUSH TABLES;
 *
 * Снять блокировку
 * UNLOCK TABLES;
 *
 * Скрипт горячего копирования
 * mysqlhotcopy base /to/new/path
 * работает только с таблицами MyISAM
*/

/**
 * Создание SQL-дампа
 *
 * mysqldump test > base.sql
 *
 * Развернуть SQL-дамп
 * mysql test < base.sql
*/