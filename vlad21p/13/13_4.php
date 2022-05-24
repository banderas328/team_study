<?php
	$str = "привет, мир!";
	echo "в строке &quot;$str&quot; ".strlen($str)." байт<br/>";
	echo "в строке &quot;$str&quot; ".mb_strlen($str)." символов<br/>";