<?php
/*
$connection = @mysql_connect('localhost', 'bigprime', 'cassie');
mysql_select_db('bigprime_db', $connection);

$query = mysql_query("SELECT id,number FROM prime_numbers WHERE id>98867000 AND MOD(id,100)=0");

while ($row = mysql_fetch_array($query,MYSQL_ASSOC)){
	//echo $row['id']." ".$row['number']."<br />";
	mysql_query("INSERT INTO prime_numbers_100gap (n,prime) VALUES (".$row['id'].",".$row['number'].")");
}


*/
?>