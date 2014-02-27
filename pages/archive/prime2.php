<?php

function is_prime($n){
	//this function return true or false if a number is prime or not
	if ($n == 2 OR $n == 3){
		return TRUE;
	}else{
		$sqrt = ceil(sqrt($n))+1;
		//check the serious way
		$j=2;
		if (bcmod($n,2) == 0){return FALSE;end;}
		if (bcmod($n,3) == 0){return FALSE;end;}
		for($i=5; $i<$sqrt; $i+=$j, $j=6-$j) {
			if (bcmod($n,$i) == 0)
				{return FALSE;end;}
		}
		//else it must be prime
		return TRUE;
	}
}
function nth_prime_100gap($n){
	$gapsize = 100;//can be modified depending on database gaps
	$rounded = round($n,-(strlen($gapsize)-1));
	
	if ($rounded <= $gapsize){
		$c=0;
		for ($i=2; $c!=$n; $i++){
			if (is_prime($i)){
				$c++;
				if ($c == $n){
					$stop = true;
					return $i;
				}
			}
		}
	}elseif ($n%$gapsize == 0){
		$prime = mysql_result(mysql_query("SELECT prime FROM prime_numbers_100gap WHERE n=".$n),0);
		return $prime;
	}else{
		//work out if its quicker to work our way backwards or forwards
		if (($n - $rounded) < ($gapsize/2)){
			$prime_before = mysql_result(mysql_query("SELECT prime FROM prime_numbers_100gap WHERE n=".($rounded-$gapsize)),0);
			//loop
			$c=$rounded;
			for ($i=$prime_before; $stop == false; $i+=2){
				if (is_prime($i)){
					$c++;
					if ($c == $n){
						$stop = true;
						return $i;
					}
				}
			}
		}else{
			$prime_after  = mysql_result(mysql_query("SELECT prime FROM prime_numbers_100gap WHERE n=".($rounded+$gapsize)),0);
			//loop
			$c=$rounded;
			for ($i=$prime_before; $stop == false; $i-=2){
				if (is_prime($i)){
					$c++;
					if ($c == $n){
						$stop = true;
						return $i;
					}
				}
			}
		}
		
	}
}

if ($num < 1){$num = 1;}

$count = mysql_result(mysql_query("SELECT n FROM prime_numbers_100gap ORDER BY n DESC LIMIT 1"),0);

echo "<br><br>";

if ($count >= $num){
	echo
	"This page shows prime numbers ".$num." to ".($num+99).".<br><br>";
	
	$start = nth_prime_100gap($num);
	
	$c=$num;
	for ($i=$start; $c<$num+100; $i++){
		if (is_prime($i)){
			$c++;
			echo
			"<a class=\"link\" href=\"../cruncher.php?number=".$i."\">".$i."</a><br>";
		}
	}
	
	
	echo 
	"<br><br>".
	"<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\">".
		"<tr>".
			"<td align=\"left\" width=\"120\">";
				if (($num-100) >= 0){
					echo
					"<a class=\"link\" href=\"prime.php?num=".($num-100)."\">previous 100 primes</a>";
				}
			echo
			"</td>".
			"<td align=\"right\" width=\"120\">";
				if (($num+100) <= $count){
					echo
					"<a class=\"link\" href=\"prime.php?num=".($num+100)."\">next 100 primes</a>";
				}
			echo
			"</td>".
		"</tr>".
	"</table>";
}else{
	echo "We haven't discovered the ".th($num)." prime number yet.";
}

echo 
"<br><br><br>".
"<form action='prime.php' method='get' target='_top'>Display the <input name=\"num\" type=\"text\" value=\"\"> prime number <input type=\"submit\" value=\"Go\"></form>".
"<br><br><br>".
"<a class=\"link\" href=\"?num=100\">100th Prime</a><br>".
"<a class=\"link\" href=\"?num=1000\">1000th Prime</a><br>".
"<a class=\"link\" href=\"?num=10000\">10000th Prime</a><br>".
"<a class=\"link\" href=\"?num=100000\">100000th Prime</a><br>".
"<a class=\"link\" href=\"?num=1000000\">1000000th Prime</a><br>".
"<a class=\"link\" href=\"?num=10000000\">10000000th Prime</a><br>";

//there are 1.4*10<sup>297</sup> primes smaller than 300 digits
//
//there is// always a prime between n^2 and (n+1)^2.
//
//$x=10000;
//echo log($x);
?>