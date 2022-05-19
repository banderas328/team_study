<?php
	function myecho(...$planets) //or func_get_args() at foreach
	{
		foreach($planets as $v) {
			echo "$v<br/>\n";
		}
	}
	myecho("Mercury","Venera","Earth","Mars");