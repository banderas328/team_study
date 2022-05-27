<?php
	$file = "file.txt";
	fclose(fopen($file, "a+b"));
	$f = fopen($file, "r+b") or die("could not open file");
	flock($f, LOCK_EX);
	// ...
	fclose($f);