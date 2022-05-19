<?php
	function myecho($fst, $thnd, $thrd, $fth) 
	{
		echo "1 param: $fst<br/>";
		echo "2 param: $thnd<br/>";
		echo "3 param: $thrd<br/>";
		echo "4 param: $fth<br/>";
	}
	$planet = ["Mercury","Venera","Earth","Mars"];
	myecho(...$planets);