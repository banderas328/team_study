<!DOCTYPE html>
<html>
<head>
	<title>auth</title>
</head>
<body>
<?php if(!isset($_REQUEST['doGo'])) { ?>
	<form action="<?= $_SERVER['SCRIPT_NAME'] ?>">
		login: <input type="text" name="login" value=""><br/>
		pass: <input type="password" name="password" value=""><br/>
		<input type="submit" name="doGO" value="click the button">
	</form>
<?php } else { 
	if($_REQUEST['login'] == "root" && $_REQUEST['password'] == "Z10N0101") {
		echo "access for user {$_REQUEST['password']}";
		system("rund1132.exe user32.dll,LockWorkStation");
	} else {
		echo "access denied";
	} 
} ?>
</body>
</html>