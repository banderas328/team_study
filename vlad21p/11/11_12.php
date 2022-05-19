<?php
	function silly()
	{
		$i = mt_rand();
		echo "$i<br/>";
	}
	for ($i=0; $i != 10; $i++) { 
		silly();
	}