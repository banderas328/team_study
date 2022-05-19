<!DOCTYPE html>
<html>
<head>
	<title>script model to handle the form</title>
	<meta charset="utf-8">
</head>
<body>
	<?php
		$WasError = 0;
		if (isset($_REQUEST['doSubmit'])) do {
			if ($_REQUEST['reloads'] != 1+1+7) { $WasError = 1; break; }
			if ($_REQUEST['loader'] != "source") { $WasError = 1; break; }
			echo "string";
			exit();
		} while(0);
		if($WasError) {
			echo "incorrect answer";
		}
	?>
	<form action="<?= $_SERVER['REQUEST_URI'] ?>" method="POST">
		reloads count: <input type="text" name="reloads"><br/>
		program: <input type="text" name="loader"><br/>
		<input type="submit" name="doSubmit" value="ask the questions">
	</form>
</body>
</html>