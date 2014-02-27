The first 2000 prime numbers<br><br>
1<br>2<br>
<?php
$array_primes[  0] =  2;
$array_primes[  1] =  3;
$array_primes[  2] =  5;
$array_primes[  3] =  7;
$array_primes[  4] = 11;

$a=5;
$n=13;
while ($a <= 2000){
	$sqrt = ceil(sqrt($n));
	//check the serious way
	$i = 0;
	$is_prime = TRUE;
	while ($array_primes[$i] <= $sqrt){
		if (bcmod($n,$array_primes[$i]) == 0){
			$is_prime = FALSE;
			break 1;
		}
		$i++;
	}
	//dun checking
	if ($is_prime == TRUE){
		$array_primes[$a] = $n;
		$a++;
	}
	$n+=2;
}

//echo all our primes
$count = count($array_primes);
for ($i=0; $i<$count; $i++){
	echo $array_primes[$i]."<br>";
}
?>