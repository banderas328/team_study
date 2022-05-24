<?php
	$from = ["{TITLE}", "{BODY}"];
	$to = ["Philosophy", "Quote"];
	$template =<<MARKER
<!DOCTYPE html>
<html>
<head>
	<title>{TITLE}</title>
	<meta charset='utf-8'>
</head>
<body>{BODY}</body>
</html>
MARKER;
	echo str_replace($from, $to, $template);
?>