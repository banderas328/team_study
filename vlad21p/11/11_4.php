<?php 
	function increment($a) //function ... (&$a)
	{
		echo "current val: $a<br/>";
		$a++;
		echo "after increment: $a<br/>";
	}
	$num = 10;
	echo "initial value: $num<br/>";
	increment($num);
	echo "after function call: $num<br/>";