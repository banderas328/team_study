<?php

/**
 * *********** Константы   ********

 Нельзя переопеределить.

*** Предопереленные константы

 __FILE - имя текущего файла,
 __LINE - номер текущей строки
 __FUNCTION - имя текущей функции
 __CLASS - имя текущего класса
 PHP_VERSION - версия интерпритатора PHP
 PHP_OS - операционная система
 PHP_EOL - символ конца строки. Linux: \n. Windows \r\n. Mac OS X \n\r.
 true или TRUE
 false или FALSE
 null или NULL

*** Определение новых констант

 void define(string $name, string $value, bool $case_sen = true);
 define("PI", 3.14);
 define("STR", "Test string");
 echo PI;  //3.14
 echo STR; //Test string

*** Проверка существования константы

 bool define(string $name); // true, если константа $name была ранее определена.

*** Константы с динамическими именами

 mixed constant(string $name);

 $index = mt_rand(1, 10);
 $name = "VALUE{$index}";
 define($name, 10);
 echo constant($name); //10
*/


/**
 *  *********   Отладочные функции   **********

 Позволяют распечатать значение любого типа данных

 print_r() - выводит значения любого типа данных
 var_dump() - дополнительно выводит тип даннных
 var_export() - как и print_r, может выводить "кусок" PHP-программы
*/