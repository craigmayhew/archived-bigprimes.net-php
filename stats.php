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
//"<br><br>".
//"<span class=\"title\">Web Traffic Stats</span>".
"<br><br>";
/*
mysql_select_db('stats', $connection);
$domain_id = mysql_result(mysql_query("SELECT id FROM stats_lookup_domain WHERE domain='www.bigprimes.net'"),0);
echo
"<table cellpadding=\"2\" cellspacing=\"0\" border=\"1\" class=\"text\" bgcolor=\"#e0faed\" bordercolor=\"#444444\">".
 "<tr>".
  "<td align=\"left\" width=\"200\">Number of Page Views</td>".
  "<td align=\"right\" width=\"200\">".mysql_result(mysql_query("SELECT count(*) FROM stats WHERE domain=".$domain_id),0)."</td>".
 "</tr>".
 "<tr>".
  "<td align=\"left\">Number of Visitors</td>".
  "<td align=\"right\">".mysql_result(mysql_query("SELECT count(DISTINCT(ip)) FROM stats WHERE domain=".$domain_id),0)."</td>".
 "</tr>".
"</table>";
mysql_select_db('prime_research', $connection);
*/
require_once("footer.php");?>