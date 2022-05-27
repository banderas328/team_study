<?php
	$A = [
		"a" => "zero",
		"b" => "weapon",
		"c" => "alpha",
		"d" => "processor"
	];
	asort($A);
	$A = array_reverse($A);
	print_r($A);