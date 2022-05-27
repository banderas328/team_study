<?php 
	$native = ["green", "red", "blue"];
	$colors = ["red", "yellow", "green", "cyan", "black"];
	$inter = array_intersect($colors, $native);
	print_r($inter);