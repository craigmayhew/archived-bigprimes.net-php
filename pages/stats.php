<?php require_once("header.php");

//work out database size in GB
  $result = mysql_query("show table status");
  $db_size = 0;
  $db_primes_size = 0;
  $db_webstats_size = 0;
  while($row = mysql_fetch_array($result)) {
	  if ($row['Name'] == "prime_numbers"){
		$db_primes_size = $row["Data_length"]+$row["Index_length"];
	  }
      $db_size += $row["Data_length"]+$row["Index_length"];
  }
  $db_primes_size = round(((($db_primes_size/1024)/1024)/1024), 1);
  $db_size = round(((($db_size/1024)/1024)/1024), 1);
//done working out database size

//stats
echo
"<br><br>".
"<span class=\"title\">Database Stats</span>".
"<br><br>".
"<table cellpadding=\"2\" cellspacing=\"0\" border=\"1\" class=\"text\" bgcolor=\"#e0faed\" bordercolor=\"#444444\">".
 "<tr>".
  "<td align=\"left\" width=\"200\">Number of Primes in Database</td>".
  "<td align=\"right\" width=\"200\">".mysql_result(mysql_query("SELECT COUNT(*) FROM prime_numbers"),0)."</td>".
 "</tr>".
 "<tr>".
  "<td align=\"left\">Primes Database Size</td>".
  "<td align=\"right\">".$db_primes_size." GB</td>".
 "</tr>".
 "<tr>".
  "<td align=\"left\">Overall Database Size</td>".
  "<td align=\"right\">".$db_size." GB</td>".
 "</tr>".
"</table>".
"<br><br>";

require_once("footer.php");?>
