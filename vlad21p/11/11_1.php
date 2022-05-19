<!DOCTYPE html>
<html>
<head>
	<title>func example</title>
	<meta charset="utf-8">
</head>
<body>
<?php
	function selectedItems($items, $selected = 0)
	{
		$text = "";
		foreach ($items as $k => $v) {
			if ($k === $selected) {
				$ch = " selected";
			} else {
				$ch = "";
			}
			$text .= "<option$ch value='$k'>$v</option>\n";
		}
		return $text;
	}
	$names = [
		"Weaving" => "Hugo",
		"Goddard" => "Paul",
		"Taylor" => "Robert",
	];
	if (isset($_REQUEST['surname'])) {
		$name = $names[$_REQUEST['surname']];
		echo "you choose: {$_REQUEST['surname']}, {$name} ";
	}
?>
	<form action="<?= $_SERVER['SCRIPT_NAME'] ?>" method="POST">
		choose name:
		<select>
			<?= selectedItems($names, $_REQUEST['surname']) ?>
		</select><br/>
		<input type="submit" name="to know surname">
	</form>
</body>
</html>