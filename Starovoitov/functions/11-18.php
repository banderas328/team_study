<?php ## Вложенные функции.
  function father($a)
  { 
    echo $a, "<br />";
    function child($b) { 
      echo $b + 1, "<br />";
      return $b * $b;
    }
    return $a * $a * child($a); 
    // фактически возвращает $a * $a * ($a+1) * ($a+1)
  }
  // Вызываем функции.
  father(10);
  child(30);
  // Попробуйте теперь ВМЕСТО этих двух вызовов поставить такие 
  // же, но только в обратном порядке. Что, выдает ошибку? 
  // Почему, спрашиваете? Читайте дальше!
?>