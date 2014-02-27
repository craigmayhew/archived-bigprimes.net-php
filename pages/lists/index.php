<?php
/*
function is_palindrome($number){
	$len = strlen($number);
	if (is_int($len/2) == true){
		$i=1;
		while ($i <= $len/2){
			if (substr($number,($i-1),1) != substr($number,-$i,1)){
				return FALSE;
				end;
			}
			$i++;
		}
	}else{
		$i=1;
		while ($i <= ($len/2)){
			if (substr($number,($i-1),1) != substr($number,-$i,1)){
				return FALSE;
				end;
			}
			$i++;
		}
	}
	return TRUE;
}


$n = 10;
for ($i=1; $i<=10000; $i++){
	while (TRUE){
		$n++;
		if (is_palindrome($n)){
			echo $n."<br>";
			break 1;
		}
	}
}

*/
?>