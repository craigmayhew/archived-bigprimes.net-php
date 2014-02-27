<?php require_once("header.php");

if ($num < 1){
	$num = 1;
}

$count = mysql_result(mysql_query("SELECT count(*) FROM perfect_numbers"),0);

echo "<br><br>";

if ($count >= $num){
	echo
	"This page shows the ".th($num)." perfect number.<br><br>";
	
	$number = mysql_result(mysql_query("SELECT perfect FROM perfect_numbers WHERE id=".addslashes($num)),0);
	
	echo
	"<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"text\" width=\"560\">".
		"<tr>".
			"<td aign=\"left\">".
				"<a class=\"link\" href=\"cruncher.php?number=".$number."\">".$number."</a><br>".
			"</td>".
		"</tr>".
	"</table>".
	"<br><br>".
	"<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\">".
		"<tr>".
			"<td align=\"left\" width=\"120\">";
				if ($num > 1){
					echo
					"<a class=\"link\" href=\"archive_perfect.php?num=".($num-1)."\">previous</a>";
				}
			echo
			"</td>".
			"<td align=\"right\" width=\"120\">";
				if (($num+1) <= $count){
					echo
					"<a class=\"link\" href=\"archive_perfect.php?num=".($num+1)."\">next</a>";
				}
			echo
			"</td>".
		"</tr>".
	"</table>";
}else{
	echo "We haven't discovered the ".th($num)." perfect number yet.";
}

echo 
"<br><br><br>";
require_once("footer.php");?>