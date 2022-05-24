<?php
 function generator()
 {
 	echo "before 1st yield<br/>";
 	yield 1;
 	echo "before 2nd yield<br/>";
 	yield 2;
 	echo "before 3rd yield<br/>";
 	yield 3;
 	echo "after 3rd yield</br>";
 }
 foreach (generator() as $i) {
 	echo "$i<br/>";
 }