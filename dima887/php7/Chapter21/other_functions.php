<?php


/**
 * **********  Разные функции   ***********
 */


//Выводит информацию о текущей конфигурации PHP
//phpinfo()

//Получает время последней модификации страницы
//getlastmod()
echo "Последнее изменение: ".date("d.m.Y H:i.s.", getlastmod());

echo "<hr>";

//Выполняет код PHP, содержащейся в строке
//eval("echo 'hello world';");
//Генерация 1000 функций.
for ($i = 1; $i <= 1000; $i++)
    eval("function printSquare$i() { echo $i * $i; }");
printSquare303();

echo "<hr>";

//Генерация квази-анонимных функций.
$squarers = [];
for ($i = 0; $i <= 1000; $i++) {
    // Создаем строку, содержимое которой каждый раз будет разным.
    $id = uniqid("F");
    // Создаем функцию.
    eval("function $id() { echo $i * $i; }");
    $squarers[] = $id;
}
// Так можно вызвать функцию, чье имя берется из массива.
$squarers[303]();

echo "<hr>";
//Создание анонимных функций.
//Использование оператора <=>.
$fruits = ["orange", "apple", "apricot", "lemon"];
usort($fruits, function($a, $b) { return $b <=> $a; });
foreach ($fruits as $key => $value) echo "$key: $value<br />\n";

