<?php


/**
 * *************  Код и шаблон страницы  ************
*/
?>

<html><body>
<h1>Последние новости:</h1>

<?php for ($i = 1;  $i <= 5; $i++) {?>
  <li><?=$i?>-я новость: контент <?=$i?>
<?php } ?>
</body></html>