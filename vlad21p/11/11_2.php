<?php 
	function silly()
	{
		return [1,2,3];
	}
	$arr = Silly();
	var_dump($arr);
	list($a, $b, $c) = Silly();
	echo Silly()[2];