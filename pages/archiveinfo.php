<?php require_once("header.php");

echo
"<h1>Other Archives</h1>".
"<table border='0' cellspacing='0' cellpadding='2' class=\"text\">".
  "<tr>".
	"<td>".
		"Here are lists of various types of numbers:<br />".
        "<ul>".
		"<li><a class=\"link\" href='".$url->u(array('lists/cubenumbers'))."'>The first 5000 cube numbers</a></li>".
		"<li><a class=\"link\" href='/pages/lists/10000%20cube%20numbers.zip'>The first 10000 cube numbers</a> (zipped)</li>".
		"<li><a class=\"link\" href='".$url->u(array('lists/squarenumbers'))."'>The first 10000 square numbers</a></li>".
		"<li><a class=\"link\" href='/pages/lists/50000%20square%20numbers.zip'>The first 50000 square numbers</a> (zipped)</li>".
		"<li><a class=\"link\" href='".$url->u(array('lists/palindromenumbers'))."'>The first 2000 palindrome numbers</a></li>".
        "</ul>".
		
		"<br />".
        
		"Here are the universal constants:<br />".
        "<ul>".
		"<li><a class=\"link\" href='".$url->u(array('constants/pi'))."'>The first million decimal places of PI</a></li>".
		"<li><a class=\"link\" href='".$url->u(array('constants/phi'))."'>The first 2000 decimal places of phi</a></li>".
		"<li><a class=\"link\" href='".$url->u(array('constants/g'))."'>The gravitational constant g to 6 S.F.</a></li>".
		"<li><a class=\"link\" href='".$url->u(array('constants/c'))."'>The velocity of light c to 9 S.F.</a></li>".
        "</ul>".
	"</td>".
  "</tr>".
"</table>";
require_once("footer.php");?>