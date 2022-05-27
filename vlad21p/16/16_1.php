<?php
	function makeHex($st)
	{
		for ($i = 0; $i < strlen($st); $i++)
			$hex[] = sprintf("%02X", ord($st[$i]));
		return join(" ", $hex);
	}
	$f = fopen(__FILE__, "rb");
	echo makeHex(fgets($f, 100)), "</br>\n";
	$f = fopen(__FILE__, "rt");
	echo makeHex(fgets($f, 100)), "</br>\n";