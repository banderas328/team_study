<!DOCTYPE html>
<html lang='ru'>
<head>
    <title>Двойной выпадающий список</title>
    <meta charset='utf-8'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">
        $(function(){
            $("#fst").on("change", function(){
                // AJAX-запрос
                $.ajax({
                    url: "select.php?id=" + $('#fst').val()
                })
                    .done(function(data){
                        $('#snd').html(data);
                        $("#snd").prop("disabled", false);
                    });
            });
        });
    </script>
</head>
<body>
<?php
// Устанавливаем соединение с базой данных
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
// Формируем выпадающий список корневых разделов
$query = "SELECT * FROM catalogs
              WHERE parent_id = 0 AND is_active = 1
              ORDER BY pos";
echo "<select id='fst'>";
echo "<option value='0'>Выберите раздел</option>";
$com = $pdo->query($query);
while($catalog = $com->fetch()) {
    echo "<option value='{$catalog['id']}'>{$catalog['name']}</option>";
}
echo "</select>";
?>
<select id='snd' disabled='disabled'>
    <option value='0'>Выберите подраздел</option>
</select>
</body>
</html>