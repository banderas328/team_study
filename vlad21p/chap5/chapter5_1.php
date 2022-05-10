
<!DOCTYPE html>
<html>
<head>
	<title>1</title>
	<meta charset="utf-8">
</head>
<body>
	<h1>hello</h1>
	<p>
		<?php

		$dat = date("d.m y");
		$tm = date("h:i:s");
		echo "current date $dat </br>\n";
		echo "current time $tm </br>\n";
		echo "squares and cubes for 1-5 numbers </br>\n";
		echo "<ul>\n";
		for ($i = 1; $i <= 5; $i++) {
			echo "<li>squared $i = ".($i * $i);
			echo ", cubed $i = ".($i * $i * $i)."</li>\n";
		}
		</ul>
	</p>
</body>
</html>