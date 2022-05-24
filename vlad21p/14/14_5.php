<?php
	$files = [
		"img10.gif",
		"img1.gif",
		"img2.gif",
		"img20.gif"
	]
	natsort($files);
	echo "<pre>";
	print_r($files);