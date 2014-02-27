<?php

if ($possible_prime < 0){
	$possible_prime = 63;
}

$sqrt = ceil(sqrt($possible_prime));

/*$_GRIDCOMP['total'] = $sqrt;*/

/*$_GRIDCOMP['loooper_start']*/
	/*$_GRIDCOMP['answer'] = true;*/
	for ($i=/*$_GRIDCOMP['start']*/; ($i</*$_GRIDCOMP['end']*/); $i+=2){
		if (bcmod($i,5) != 0){
			if (bcmod($possible_prime,$i) == 0){
				/*$_GRIDCOMP['answer'] = false;*/
				break;
			}
		}
	}
/*$_GRIDCOMP['loooper_end']*/

if ($answer == true){
	echo $possible_prime." is prime";
}else{
	echo $possible_prime." is not prime";
}

















/*





$p3 = array(3,5,7,11,13,17,19,23,29,31,37,41,43,47);
$c3 = count($p3);

function is_prime($a,$primelist){
	//this function return true or false if a number is prime or not
	
	$sqrt = ceil(sqrt($a))+1;
	for($i=0; $primelist[$i]<$sqrt; $i++) {
		if (bcmod($a,$primelist[$i]) == 0){
			return FALSE;end;
		}
	}
	//else it must be prime
	return TRUE;
}

$largest_prime = mysql_result(mysql_query("SELECT number FROM prime_numbers ORDER BY id DESC LIMIT 1"),0);

$query = mysql_query("SELECT number FROM prime_numbers WHERE number<=".(2*ceil(sqrt($largest_prime))));
while ($row = mysql_fetch_array($query,MYSQL_NUM)){
	$primelist[] = $row[0];
}

$builder = 0;
$build = "";

for ($b=($largest_prime+2); $b<($largest_prime+2000); $b+=2){
	if (is_prime($b,$primelist) == true){
		if ($builder != 0){
			$build .= ",";
		}
		$build .= "(".$b.")";
		$builder++;
	}
}
if ($builder > 0){
	mysql_query("INSERT INTO prime_numbers (number) VALUES ".$build);
	$build = "";
	$builder = 0;
}
echo
"<script language=\"javascript\">".
	"window.location = 'test.php';".
"</script>";
*/?>