<?php


/**
 * ************   AJAX    ***************
*/

?>
<!--Использование библиотеки jQuery-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">
    $(function() {
        $("p").css("color", "blue");
        $(".green").css("color", "green");
        $("#id-p").css("color", "red");
    });
</script>

<p>Текст будет окрашен в синий цвет.</p>
<p class='green'>Текст будет окрашен в зеленый цвет.</p>
<div class='green'>Текст будет окрашен в зеленый цвет.</div>
<p id='id-p'>Текст будет окрашен в красный цвет.</p>
<p>Текст будет окрашен в синий цвет.</p>


<hr>



<!--Назначение обработчика средствами jQuery.-->
<script type="text/javascript">
    $(function() {
        // Меняем указатель курсора
        $("#id_text").css("cursor", "pointer");
        // Назначаем обработчик события click
        $("#id_text").on("click", function(){
            if($("#id_text").css("color") == "rgb(0, 0, 255)")
                // Если цвет синий - меняем на красный
                $("#id_text").css("color", "rgb(255, 0, 0)");
            else
                // В противном случае назначаем синий цвет
                $("#id_text").css("color", "rgb(0, 0, 255)");
        });
    });
</script>

<p id="id_text">Текст меняет цвет.</p>


<hr>



<!--Использование метода html() для изменения текста.-->
<script type="text/javascript">
    $(function change_text() {
        $(".html").html("Доступно после регистрации");
    });
</script>

<p class="html">Текст будет изменен.</p>
<div>Текст останется без изменений.</div>
<p class="html">Текст будет изменен.</p>


<hr>



<!--Форма для загрузки произвольного количества файлов-->
<?php
if(!empty($_FILES))
{
    echo "<pre>";
    print_r($_FILES);
    echo "</pre>";
    exit();
}
?>

<script type="text/javascript">
    // Назначить обработчики события click
    // после загрузки документа
    $(function() {
        $(document).on("click", "input[type='button'][value='-']", remove_field);
        $(document).on("click", "input[type='button'][value='+']", add_field);
    });
    // Обработчик для кнопки +
    function add_field(){
        // Добавляем новое поле в конец
        $(".file:last").clone().insertAfter(".file:last");
    }
    // Обработчик для кнопки -
    function remove_field(){
        console.log($(this));
        // Удаляем последнее поле
        $(".file:last").remove();
    }
</script>

<form enctype='multipart/form-data' method="post">
    <p class="file"><input type="file" name="filename[]" />
        <input type="button" value="+">
        <input type="button" value="-"></p>
    <div><input type="submit" value="Загрузить"></div>
</form>


<hr>



<!--Использование метода load()-->
<script type="text/javascript">
    // Назначить обработчики события click
    // после загрузки документа
    $(function(){
        $("#id").on("click", function(){
            $('#info-load').load("time.php");
        })
    });
</script>

<div><a href='#' id='id'>Получить время</a></div>
<div id='info-load'></div>


<hr>



<!--Список пользователей. ajax-->
<script type="text/javascript">
    // Назначить обработчики события click
    // после загрузки документа
    $(function(){
        $(".jumbotron > div > a").on("click", function(){
            // Формируем ссылку для AJAX-обращения
            var url = "user.php?id=" + $(this).data('id');
            // Отправляем AJAX-запрос и выводим результат
            $.ajax({
                url: encodeURI(url)
            }).done(function(data){
                $('#info').html(data).removeClass("hidden");
            });
        })
    });
</script>

<style> .hidden { display: none; }</style>

<div id="list">
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

    $query = "SELECT * FROM users
                  ORDER BY name";
    $usr = $pdo->query($query);

    try {
        echo "<div class='jumbotron'>";
        while($user = $usr->fetch()) {
            echo "<div><a href='#' ".
                "data-id='".$user['id']."'>".
                htmlspecialchars($user['name'])."</a></div>";
        }
        echo "</div>";
    } catch (PDOException $e) {
        echo "Ошибка выполнения запроса: " . $e->getMessage();
    }
    ?>
</div>
<div id='info' class='hidden'></div>


<hr>






