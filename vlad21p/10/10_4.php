<?php
	 $birth = [
	 	"Thomas" => "1962-03-11",
	 	"Keanu" => "1962-09-02",
	 ];
	 for(reset($birth); ($k = key($birth)); next($birth))
	 	echo "$k was born at {$birth[$k]}<br/>";