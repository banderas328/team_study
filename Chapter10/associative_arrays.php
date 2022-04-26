<?php
/**
 *  *******  Ассоциативные массивы ********
 */

$dossier = [
    'Anderson' => ['name' => 'Thomas', 'born' => '1962-03-11'],
    'Reeves' => ['name' => 'Keanu', 'born' => '1962-09-02'],
];


/**
 *  **********  Массивы-константы   **********
*/

const DOSSIER = [
    'Anderson' => ['name' => 'Thomas', 'born' => '1962-03-11'],
    'Reeves' => ['name' => 'Keanu', 'born' => '1962-09-02'],
];

//echo DOSSIER['Anderson']['name'];

$names["Davis"] = "Don"; //присваеваем элементу массива строку "Don"
$ref = &$dossier["Reeves"]["name"]; //$ref - синорим элемента массива
$namesList[] = "Paul Doyle"; //добавляем новый элемент


/**
 * **********  Слияние массивов   ***********
*/

$good = ['Arahanga' => 'Julian ', 'Doran' => 'Matt'];
$bad = ['Goddard' => 'Paul', 'Taylor' => 'Robert'];
$all = $good + $bad;

//echo "<pre>"; print_r($all); echo "</pre>";

/**
 *  ********   Обновление элементов   ***********
*/

$a = ['a'=> 10, 'b' => 20];
$b = ['b' => 'new?'];
$a += $b;

//echo "<pre>"; print_r($a); echo "</pre>"; // [a] => 10, [b] => 20

$a = array_merge($a, $b);
//или
//foreach ($b as $k => $v) $a[$k] = $v;
//echo "<pre>"; print_r($a); echo "</pre>"; // [a] => 10, [b] => 'new?'

/**
 * *********  Перебрать массив с конца   ************
 */

$age = [25, 18, 30, 10, 45];
$birth = [
    'Thomas Anderson' => '1962-03-11',
    'Keanu Reeves' => '1962-09-02',
];

for (end($age); ($k = key($age)); prev($age)) {
    echo "Элемент $k  значение {$age[$k]}<br>";
}
echo "<hr>";
for ($i = count($age) - 1; $i >= 0; $i--) {
    echo 'Элемент ' . $i . ' значение ' . $age[$i] . "<br>";
}
//for (reset($birth); ($k = key($birth)) !== false; next($birth)) {
//    echo "Элемент $k  значение {$birth[$k]}<br>";
//}
//for ($i = 0; $i < count($dossier); $i++) {
//    echo "{$dossier[$i]['name']} was born {$dossier[$i]['born']}<br/>";
//}

$a = ['a' => 'aa', 'b' => 'bb', 'c' => ['x' => 'xx']];
$st = serialize($a);
//echo $st;//a:3:{s:1:"a";s:2:"aa";s:1:"b";s:2:"bb";s:1:"c";a:1:{s:1:"x";s:2:"xx";}}
//print_r(unserialize($st));