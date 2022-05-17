<!DOCTYPE html>
<html>
<head>
	<title>if-else</title>
	<meta charset="utf-8">
</head>
<body>
	<?php if(isset($_REQUEST['go'])): ?>
		Hello, <?= $_REQUEST['name'] ?>!
	<?php else: ?>
		<form action="<?= $_SERVER['REQUEST_URI'] ?>" method="POST">
			Your name:<input type="text" name="name"><br/>
			<input type="submit" name="go" value="send!">
		</form>
	<?php endif ?>
</body>
</html>