<?php
	$st =<<<HTML
		<b>abc</b>
		<tt>abc</tt>
		<a href="index.html">link</a>
		a<x && y>d
	HTML;
	echo "original text: $st";
	echo "<hr>after stripping tags: ",strip_tags($st, "<tt><b>");
