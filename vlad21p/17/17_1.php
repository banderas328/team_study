<?php 
	$perms = fileperms("text.txt");
	echo decoct($perms);
	echo decbin($perms);