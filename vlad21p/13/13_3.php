<!DOCTYPE html>
<html lang="ru">
<head>
	<title>utf-8 handling problems</title>
	<meta charset="utf-8">
</head>
<body>
<?php
	$str = "Hello world";
	echo "{$str[2]}<br/>"
	$str = "Привет мир!";
	echo "{$str[2]}<br/>";
?>
</body>
</html>