<?php
$count = 0;
if (isset($_COOKIE['count'])) $count = $_COOKIE['count'];
$count++;
setcookie("cookie", $count, 0x7FFFFFFF, "/");
echo "count";