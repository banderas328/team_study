<!-- MVC. Шаблон гостевой книги (пассивный). -->
<html><head><title>Гостевая книга</title></head>
<body>
<h1>Добавьте свое сообщение:</h1>
<form action="controller.php" method="post">
    ...
</form>
<h2>Гостевая книга:</h2>
<!-- BEGIN book_element -->
    Имя человека: {NAME}<br />
    Его комментарий:<br />{TEXT}<hr />
<!-- END book_element -->
</body></html>