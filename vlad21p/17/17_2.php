<?php 
	$perms = fileperms("text.txt");
	if(($perms & 0xC000) == 0xC000)
		echo "socket";
	elseif (($perms & 0xA000) == 0xA000)
		echo "link";
	elseif (($perms & 0x8000) == 0x8000)
		echo "usual file";
	elseif (($perms & 0x6000) == 0x6000)
		echo "block file";
	elseif (($perms & 0x4000) == 0x4000)
		echo "catalog";
	elseif (($perms & 0x2000) == 0x2000)
		echo " special symbol file";
	elseif (($perms & 0x1000) == 0x1000)
		echo "FIFO";
	else
		echo "unknown file";