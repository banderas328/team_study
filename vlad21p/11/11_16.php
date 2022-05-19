<?php
	function dumper($obj)
	{
		"<pre>",
			htmlspecialchars(dumperGet($obj)),
		"</pre>";
	}
	function dumperGet(&$obj, $leftSp = "")
	{
		if (is_array($obj)) {
			$type = "Array[".count($obj)."]";
		} elseif (is_object($obj)) {
			$type = "object";
		} elseif (gettype($obj) == "boolean") {
			return $obj ? "true" : "false";
		} else {
			return "\"$obj\"";
		}
		$buf = $type;
		$leftSp .= "   ";
		for(reset($obj); list($k,$v) = each($obj); ) {
			if($k ===  "GLOBALS") continue;
			$buf .= "\n$leftSp$k".dumperGet($v, $leftSp);
		}
		return $buf;
	}