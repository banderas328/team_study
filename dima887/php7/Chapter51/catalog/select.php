<?php


/**
 * Формирование пунктов второго выпадающего списка
 */
try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=test',
        'root',
        '',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
}
catch (PDOException $e) {
    echo "Невозможно установить соединение с базой данных";
}

$query = "SELECT * 
            FROM catalogs
            WHERE
              parent_id = :id AND
              is_active = 1
            ORDER BY pos";
$cat = $pdo->prepare($query);
$cat->execute(['id' => $_GET['id']]);
echo "<option value='0'>Выберите подраздел</option>";
while($catalog = $cat->fetch()) {
    echo "<option value='{$catalog['id']}'>{$catalog['name']}</option>";
}