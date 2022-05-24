<?php
	$one = 1;
	$zero = 0;
	if ($one == "") echo 1;
	if ($zero == "") echo 2; // +
	if ("" == $zero) echo 3; // +
	if ("$zero" == "") echo 4;
	if (strval($zero) == "") echo 5;
	if($zero === "") echo 6;