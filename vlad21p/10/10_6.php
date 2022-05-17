<?php 
	$nums = [100, 313, 605];
	foreach($nums as &$v) $v++;
	echo "array elems: ";
	foreach($nums as $elt) echo "$elt ";