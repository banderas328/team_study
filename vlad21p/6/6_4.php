<?php
$index = mt_rand(1,10);
$name = "VALUE{$index";
define($name, 1);
echo constant($name);