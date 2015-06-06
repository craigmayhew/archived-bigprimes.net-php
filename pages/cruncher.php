<?php require_once 'header.php';

//variables
require_once 'variables.php';
$number = isset($_GET['number'])?(int)$_GET['number']:false;
if ($number > 0){
	function prob_prime ($num){
		if ($num == 2 OR $num == 3){
			return true;
		}
		
		$numToCheck = explode('-',chunk_split($num.'.00000000',1,'-'));
		$divideBy = 9;//currently only for dividing by 9!
		
		$setting['decimals only'] = true;
		
		$answer = array(); // to hold the answer
        $working = false;// for working out
		$working = false;// for working out
		
		foreach ($numToCheck as $nthDigit => $digit){
			if ($digit == '.'){
				$donePoint = true;
				$answer[] = '.';
			}else{
				if ($working != false){
					$working = $digit+($working*10);
					if ($working > $divideBy){
						$temp = ($working % $divideBy);
						if ($donePoint == true){
							$answer[$nthDigit-1] = ($working - $temp) / $divideBy;
						}
						if ($temp == 0){
							$working = false;
						}else{
							$working = $temp;
						}
					}
				}elseif($digit > $divideBy){
					$temp = ($digit % $divideBy);
					if ($donePoint == true){
						$answer[$nthDigit-1] = $digit - $temp;
					}
				}else{
					$working = $digit;
				}
			}
		}
		
		$answer = implode('',$answer);
		$answer = trim($answer,'.');
		$answer = substr($answer,0,5);
		if ($answer == '11111' OR $answer == '22222' OR $answer == '44444' OR $answer == '55555' OR $answer == '77777' OR $answer == '88888'){
			return true;
		}else{
			return false;
		}
	}
	//convert a decimal/denery number to a base of your choosing (max = base 16)
	function dec2base($n,$base)
		{
		$values = array('0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','+','/');
		$val = '';
		while (($n != '0') && ($n != 0))
			{
			$val = $values[bcmod($n,$base)].$val;
			$n = bcdiv($n,$base,0);
			}
		return $val;
		}
	function dec2bab($n)//decimal to babylonian numerals (base 60)
		{
			$values = array(' &nbsp; &nbsp; &nbsp; ');
			for($i=1;$i<60;$i++){
				$values[] = '<img src="/imgs/babnumbers/bab_'.$i.'.gif" alt="'.$i.'">';
			}	
		$val = '';
		while (($n != '0') && ($n != 0))
			{
			$val = $values[bcmod($n,60)]." &nbsp; ".$val;
			$n = bcdiv($n,60,0);
			}
		return $val;
		}
	function is_even($n){
		$last_digit = substr($n,(strlen($n)-1),1);
		switch ($last_digit){
		case '0':
			return TRUE;
		case '2':
			return TRUE;
		case '4':
			return TRUE;
		case '6':
			return TRUE;
		case '8':
			return TRUE;
		default:
			return FALSE;
		}
	}
	function is_number($n){
		//this makes sure $n is a number without any decimal points .. and that it is made up of the digits 0123456789
		for ($i=0; $i<256; $i++){
			if (($i < 48) OR ($i > 57)){
				if (strstr($n,chr($i))){
					return FALSE;
					end;
				}
			}
		}
		return TRUE;
	}
	//check if a number is a triangle number or not. if not then return false.
	//if true return which triangle number it is
	function is_triangle($num)
		{
		$n = 2;
		$n_too_small = 1;
		$n_too_big = $num;
		$j=0;
		while (!(((($n*($n+1))/2)<$num) AND ($num<((($n-1)*$n)/2))))
			{
			$formula = (($n*($n+1))/2);
			if ($formula < $num) //if its too small
				{
				if ((($n+1*($n+2))/2) > $num){return FALSE;end;}
				$n_too_small = $n;
				$n = round(abs(mt_rand($n_too_small,$n_too_big)),0);
				}
			elseif ($formula > $num) //if its too big
				{
				if (((($n-1)*$n)/2) < $num){return FALSE;end;}
				$n_too_big = $n;
				$n = round(abs(mt_rand($n_too_small,$n_too_big)),0);
				}
			else // its a triangle number!!!
				{return $n;end;}
			}
		return FALSE;
		}
	function is_perfect($n,$array_perfect){
		//if the number is found in the fermat array then this function returns which term it is
		//e.g. 496 is the 3rd term
		$last_digit = substr($n,(strlen($n)-1),1);
		//check to make sure that the number ends in 6 or 8 because all perfect numbers end in 6 or 8
		if (($last_digit == 8) OR ($last_digit == 6)){
			$c = 1;
			$a = count($array_perfect);
			while ($c <= $a){
				if ($array_perfect[($c-1)] == $n){
					return $c;
					end;
				}
				$c++;
			}
		}
		return FALSE;
	}
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
			mysql_query('INSERT (\''.$n.'\',1) INTO numberCache');
			return TRUE;
		}
	}
	function is_mersenne_prime($n,$array_mersenne){
		//if the number is found in the mersenne array then this function returns which term it is
		//e.g. 31 is the 3rd term
		$c = 1;
		$a = count($array_mersenne);
		while ($c <= $a){
			if ($array_mersenne[($c-1)] == $n){
				return $c;
				end;
			}
			$c++;
		}
		return FALSE;
	}
	function is_fermat($n,$array_fermat){
		//if the number is found in the fermat array then this function returns which term it is
		//e.g. 5 is the 2nd term
		$c = 1;
		$a = count($array_fermat);
		while ($c <= $a){
			if ($array_fermat[($c-1)] == $n){
				return $c;
				end;
			}
			$c++;
		}
		return FALSE;
	}
	function is_factorial($n,$array_factorial){
		//if the number is found in the factorial array then this function returns which term it is
		//e.g. 6 is the 3rd term
		$c = 1;
		$a = count($array_factorial);
		while ($c < $a){
			if ($array_factorial[($c)] == $n){
				return $c;
				end;
			}
			$c++;
		}
		return FALSE;
	}
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
	function factors($n){
		$cacheCheck = mysql_result(mysql_query('SELECT count(*) FROM numberCache WHERE number='.$n),0);
		if ($cacheCheck == 1){
			$factors = mysql_result(mysql_query('SELECT factors FROM numberCache WHERE number='.$n),0);
			if ($factors != ''){
				$factors = explode(',',$factors);
				$factors = implode('<br />',$factors);
				return $factors;
			}
		}
		
		$array_factors[0]=0;
		$array_factors[1]=0;
		$woo = 0;
		for ($i=1; $i<=$n; $i++){
			if (bcmod($n,$i) == 0){
				if (!(array_search($i,$array_factors))){
					$array_factors[$woo]=$i;
					$woo++;
					$array_factors[$woo]=($n/$i);
					$woo++;
				}else{
					break 1;
				}
			}
		}
		sort($array_factors);
		$count = count($array_factors);
                $factorslist = '';
		for ($i=0; $i<$count; $i++){
			$insertArray[] = $array_factors[$i];
			$factorslist .= $array_factors[$i].'<br />';
		}
		$insertString = implode($insertArray,',');
		if ($cacheCheck == 1){
			mysql_query('UPDATE numberCache SET factors=\''.$insertString.'\' WHERE number='.$n);
		}else{
			mysql_query('INSERT INTO numberCache (number,factors) VALUES ('.$n.',\''.$insertString.'\')');
		}
		
		return $factorslist;
	}
	function den2romannumerals($n){
		//this function converts a number in the form of a string to roman numerals
		// I=1 V=5 X=10 L=50 C=100 D=500 M=1000
		$numerals = "";
		$length = strlen($n);
		$array[0] = array('I','II','III','IV','V','VI','VII','VIII','IX','X');//units
		$array[1] = array('X','XX','XXX','XL','L','LX','LXX','LXXX','XC','C');//tens
		$array[2] = array('C','CC','CCC','CD','D','DC','DCC','DCCC','CM','M');//hundreds
		$array[3] = array('M','MM','MMM',"M<span class='u'>V</span>","<span class='u'>V</span>","<span class='u'>V</span>M","<span class='u'>V</span>MM","<span class='u'>V</span>MMM","M<span class='u'>X</span>","<span class='u'>X</span>");//THOUSANDS
		$array[4] = array("<span class='u'>X</span>","<span class='u'>X</span><span class='u'>X</span>","<span class='u'>X</span><span class='u'>X</span><span class='u'>X</span>","<span class='u'>X</span><span class='u'>L</span>","<span class='u'>L</span>","<span class='u'>L</span><span class='u'>X</span>","<span class='u'>L</span><span class='u'>X</span><span class='u'>X</span>","<span class='u'>L</span><span class='u'>X</span><span class='u'>X</span><span class='u'>X</span>","<span class='u'>X</span><span class='u'>C</span>","<span class='u'>C</span>");//TEN THOUSANDS
		$array[5] = array("<span class='u'>C</span>","<span class='u'>C</span><span class='u'>C</span>","<span class='u'>C</span><span class='u'>C</span><span class='u'>C</span>","<span class='u'>C</span><span class='u'>D</span>","<span class='u'>D</span>","<span class='u'>D</span><span class='u'>C</span>","<span class='u'>D</span><span class='u'>C</span><span class='u'>C</span>","<span class='u'>D</span><span class='u'>C</span><span class='u'>D</span><span class='u'>C</span>","<span class='u'>C</span><span class='u'>M</span>","<span class='u'>M</span>");//HUNDRED THOUSANDS
		for ($i=0; $i<$length; $i++){
                    if(isset($array[$i][(substr($n,-($i+1),1)-1)])){
			$numerals = $array[$i][(substr($n,-($i+1),1)-1)].$numerals;
                    }
		}
	
		return $numerals;
	}
	function den2egyptiannumerals($n){
		//this function converts a number in the form of a string to egyptian numerals
		$numerals = "";
		$length = strlen($n);
		$array = array();
		for($i=1;$i<10;$i++){
			$array[0][] = '<img src="/imgs/egyptnumbers/'.$i.'.gif" alt="'.$i.'" />';
			$array[1][] = '<img src="/imgs/egyptnumbers/'.$i.'0.gif" alt="'.$i.'0" />';
			$array[2][] = '<img src="/imgs/egyptnumbers/'.$i.'00.gif" alt="'.$i.'00" />';
			$array[3][] = '<img src="/imgs/egyptnumbers/'.$i.'000.gif" alt="'.$i.'000" />';
			$array[4][] = '<img src="/imgs/egyptnumbers/'.$i.'0000.gif" alt="'.$i.'0000" />';
			$array[5][] = '<img src="/imgs/egyptnumbers/'.$i.'00000.gif" alt="'.$i.'00000" />';
			$array[6][] = '<img src="/imgs/egyptnumbers/'.$i.'000000.gif" alt="'.$i.'000000" />';
		}
		for ($i=0; $i<$length; $i++){
                    if(isset($array[$i][(substr($n,-($i+1),1)-1)])){
			$numerals = $array[$i][(substr($n,-($i+1),1)-1)].$numerals;
                    }
		}
	
		return $numerals;
	}
	function den2chinesenumerals($n){
		//this function converts a number in the form of a string to egyptian numerals
		$numerals = "";
		$length = strlen($n);
		$array[0] = array("&#22777;","&#36019;","&#21444;","&#32902;","&#20237;","&#38520;","&#26578;","&#25420;","&#29590;");//units
		$array[1] = array("&#22777;&#25342;","&#36019;&#25342;","&#21444;&#25342;","&#32902;&#25342;","&#20237;&#25342;","&#38520;&#25342;","&#26578;&#25342;","&#25420;&#25342;","&#29590;&#25342;");//tens
		$array[2] = array("&#22777;&#20336;","&#36019;&#20336;","&#21444;&#20336;","&#32902;&#20336;","&#20237;&#20336;","&#38520;&#20336;","&#26578;&#20336;","&#25420;&#20336;","&#29590;&#20336;");//hundreds
		$array[3] = array("&#22777;&#20191;","&#36019;&#20191;","&#21444;&#20191;","&#32902;&#20191;","&#20237;&#20191;","&#38520;&#20191;","&#26578;&#20191;","&#25420;&#20191;","&#29590;&#20191;");//thousands
		$array[4] = array("&#22777;&#33836;","&#36019;&#33836;","&#21444;&#33836;","&#32902;&#33836;","&#20237;&#33836;","&#38520;&#33836;","&#26578;&#33836;","&#25420;&#33836;","&#29590;&#33836;");//tenthousands
		$array[5] = array("&#22777;&#25342;&#33836;","&#36019;&#25342;&#33836;","&#21444;&#25342;&#33836;","&#32902;&#25342;&#33836;","&#20237;&#25342;&#33836;","&#38520;&#25342;&#33836;","&#26578;&#25342;&#33836;","&#25420;&#25342;&#33836;","&#29590;&#25342;&#33836;");//hundred thousands
	
		for ($i=0; $i<$length; $i++){
                    if(isset($array[$i][(substr($n,-($i+1),1)-1)])){
			$numerals = $array[$i][(substr($n,-($i+1),1)-1)].$numerals;
                    }
		}
	
		return $numerals;
	}

	echo "<div align='center'><table class=\"text\" width='75%' border='0' cellspacing='0' cellpadding='3'><tr><td align='left' class='text'><br />";
	
	//make sure there are no spaces or commas in the number
	if (strstr($number," ")){
		$number = str_replace(' ','',$number);
	}
	if (strstr($number,',')){
		$number = str_replace(',','',$number);
	}
	if (strstr($number,chr(13)) OR strstr($number,chr(10))){
		$number = str_replace(chr(13),'',$number);
		$number = str_replace(chr(10),'',$number);
	}
	//done!!
	
	//variables
	require_once 'variables.php';
	$num_len = strlen($number);
	$is_even = is_even($number);
	$is_number = is_number($number);
	
	if ($is_number && $number != 0){
		echo '<b>The number you submitted to be crunched was:</b><h1>',strrev(wordwrap(strrev($number),3," ",1)),' - ',numbers::convertNum($_REQUEST['number'], $ones, $tens, $triplets),'</h1>';
	
		echo "<table class=\"text\" width='100%' border='1' cellspacing='0' cellpadding='2' bgcolor='$table_color'><tr><td>";//begin table
			//odd or even?
			if ($is_even){
				echo 'It is an even number.<br />';
			}else{
				echo 'It is an odd number.<br />';
			}
			//palindrome or not?
			if ($num_len > 1){ //if its got more than 1 digit
				if (is_palindrome($number)){
					echo 'It is a palindrome.<br />';
				}else{
					echo 'It is not a palindrome.<br />';
				}
			}
			//prime ?
            $is_prime = $primes->checkPrime($number);
            if($is_prime===null){
                echo 'This number is not in our database (Therfore I\'m unable to check for primality).<br />';
            }elseif ($is_prime !== false){
                echo 'It is the '.numbers::stndrd($is_prime).' prime number.<br />';
            }else{
                echo 'It is not a prime number.<br />';
            }
			//mersenne prime or not?
			if ($num_len <= strlen($array_mersenne[(count($array_mersenne)-1)])){
				$mersenne = is_mersenne_prime($number,$array_mersenne);
				if ($mersenne){
					echo 'It is the ',numbers::stndrd($mersenne)," <a href='http://en.wikipedia.org/wiki/Mersenne_prime' class='link'>mersenne prime</a> number.<br />";
				}else{
					echo "It is not a <a href='http://en.wikipedia.org/wiki/Mersenne_prime' class='link'>mersenne prime</a> number.<br />";
				}
			}
			else{
				echo 'Numbers larger than ',strlen($array_mersenne[(count($array_mersenne)-1)])." digits are not checked to see if they are a <a href='http://www.mersenne.org/' class='mlink' >mersenne prime</a>.<br />";
			}
			//fermat number or not?
			if ($num_len <= strlen($array_fermat[(count($array_fermat)-1)])){
				$fermat = is_fermat($number,$array_fermat);
				if ($fermat){
					echo 'It is the ',numbers::stndrd($fermat)," <a href='http://en.wikipedia.org/wiki/Fermat_number'>fermat number</a>.<br />";
				}else{
					echo "It is not a <a class=\"link\" href='http://en.wikipedia.org/wiki/Fermat_number'>fermat number</a>.<br />";
				}
			}else{
				echo 'Numbers larger than ',strlen($array_fermat[(count($array_fermat)-1)])." digits are not checked to see if they are a fermat number.<br />";
			}
			//perfect number or not?
			if ($num_len <= strlen($array_perfect[(count($array_perfect)-1)])){
				$perfect = is_perfect($number,$array_perfect);
				if ($perfect){
					echo 'It is the ',numbers::stndrd($perfect)," <a href='http://en.wikipedia.org/wiki/Perfect_number' class='link'>perfect number</a>.<br />";
				}else{
					echo "It is not a <a href='http://en.wikipedia.org/wiki/Perfect_number' class='link'>perfect number</a>.<br />";
				}
			}else{
				echo 'Numbers larger than ',strlen($array_perfect[(count($array_perfect)-1)])." digits are not checked to see if they are perfect.<br />";
			}
	
		echo '</td></tr></table><br /><br />';//end table
		
		
		echo "<table class=\"text\" width='100%' border='1' cellspacing='0' cellpadding='2' bgcolor='$table_color'><tr><td>";//begin table
			//triangle number or not?
			if ($num_len<=$max_len_triangle){
				$triangle_num = is_triangle($number);
				if ($triangle_num){
					echo 'It is the ',numbers::stndrd($triangle_num),' triangle number.<br />';
				}else{
					echo 'It is not a triangle number.<br />';
				}
			}else{
				echo 'Numbers larger than ',$max_len_triangle,' digits are not checked to see if they are triangle numbers.<br />';
			}
			//square number or not?
			if ($num_len<=$max_len_square){
				$sqrt = sqrt($number);
				if (!stristr($sqrt,'.'))
					{echo 'It is the ',numbers::stndrd(number_format($sqrt,0,'.','')),' square number.<br />';}
				else
					{echo 'It is not a square number.<br />';}
			}else{
				echo 'Numbers larger than ',$max_len_square,' digits are not checked to see if they are square numbers.<br />';
			}
			//cube number or not?
			if ($num_len <= $max_len_cube){
				$cbrt = pow($number,(1/3));
				if (!stristr($cbrt,'.'))
					{echo 'It is the ',numbers::stndrd(number_format($cbrt,0,'.','')),' cube number.<br />';}
				else
					{echo 'It is not a cube number.<br />';}
			}else{
				echo 'Numbers larger than ',$max_len_cube,' digits are not checked to see if they are cube numbers.<br />';
			}
			//pentagon number or not? //comming soon
			
			echo "<br />";
			//factorial number or not?
			if ($num_len <= strlen($array_factorial[(count($array_factorial)-1)])){
				$factorial = is_factorial($number,$array_factorial);
				if ($factorial){
					echo "It is the ".numbers::stndrd($factorial)." factorial number (".$factorial."!).<br />";
				}else{
					echo 'It is not a factorial number.<br />';
				}
			}else{
				echo 'Numbers larger than ',strlen($array_factorial[(count($array_factorial)-1)])." digits are not checked to see if they are a factorial.<br />";
			}
		echo '</td></tr></table><br /><br />';//end table
		
		echo "<table class=\"text\" width='100%' border='1' cellspacing='0' cellpadding='2' bgcolor='$table_color'><tr><td>";//begin table
		if ($is_prime == FALSE){
			if ($num_len <= $max_len_factorization){
				if ($is_prime == FALSE){
					echo 'It has the following factors:<br /><br />';
					echo factors($number);
				}else{
					echo 'It it has no factors except itself and 1.';
				}
			}else{
				echo 'Numbers larger than ',$max_len_factorization,' digits are not factored.';
			}
		}else{
			echo 'It it has no factors except itself and 1.';
		}
		echo '</td></tr></table><br /><br />';//end table
		
		echo "<table class=\"text\" width='100%' border='1' cellspacing='0' cellpadding='2' bgcolor='$table_color'><tr><td>";//begin table
			//converting to different bases
			if ($num_len <= $max_len_convertion){
				echo "<table class=\"text\" width='100%' border='0' cellspacing='0' cellpadding='2' bgcolor='$table_color'>";
					//explanation
					echo "<tr>".
							"<td colspan='2'>",
								"Characters used to assign values for the digits 0 to 63",
								"<table class=\"text\" width='100%' border='0' cellspacing='0' cellpadding='2' bgcolor='$table_color'>",
									"<tr>";
                                        $values = array('0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','+','/');
                                        foreach ($values as $k=>$v){
                                            echo '<td>'.$k.'='.$v.'</td>';
                                            if (($k+1)%13 == 0 && $k!=0){
                                                echo '</tr><tr>';
                                            }
                                        }
									echo
									'</tr>',
								'</table>',
								'<br /><br />',
							'</td>',
						 '</tr>';
					//base 2
					echo "<tr><td width='200'>Base 2 (Binary):</td><td>".strrev(wordwrap(strrev(dec2base($number,2)),4," ",1))."</td></tr>";
					//base 3
					echo "<tr><td>Base 3 (Ternary):</td><td>".strrev(wordwrap(strrev(dec2base($number,3)),6," ",1))."</td></tr>";
					//base 4
					echo "<tr><td>Base 4 (Quaternary):</td><td>".strrev(wordwrap(strrev(dec2base($number,4)),4," ",1))."</td></tr>";
					//base 5
					echo "<tr><td>Base 5 (Quintal):</td><td>".strrev(wordwrap(strrev(dec2base($number,5)),5," ",1))."</td></tr>";
					//base 8
					echo "<tr><td>Base 8 (Octal):</td><td>".strrev(wordwrap(strrev(dec2base($number,8)),8," ",1))."</td></tr>";
					//base 10
					echo "<tr><td>Base 10 (Denary):</td><td>".strrev(wordwrap(strrev($number),3," ",1))."</td></tr>";
					//base 16
					echo "<tr><td>Base 16 (Hexadecimal):</td><td>".strrev(wordwrap(strrev(dec2base($number,16)),4," ",1))."</td></tr>";
					//base 32
					echo "<tr><td>Base 32:</td><td>".strrev(wordwrap(strrev(dec2base($number,32)),4," ",1))."</td></tr>";
					//base 64
					echo "<tr><td>Base 64:</td><td>".strrev(wordwrap(strrev(dec2base($number,64)),4," ",1))."</td></tr>";
				echo '</table>';
			}else{
				echo 'Numbers larger than ',$max_len_convertion,' digits in length are not converted to different bases.';
			}
		echo '</td></tr></table><br /><br />';//end table
	
		//roman, egyptian, chinese and babylonian numerals
		if ($num_len <= $max_len_babylonian_numerals){
				echo "<table class=\"text\" width='100%'  border='1' cellspacing='0' cellpadding='2' bgcolor='$table_color'>";//begin table
			if ($num_len <= $max_len_roman_numerals){
				echo "<tr><td width='200'>Roman Numerals:</td><td>".den2romannumerals($number)."</td></tr>";
			}
			if ($num_len <= $max_len_egypt_numerals){
				echo "<tr><td width='200'>Egyptian Numerals:</td><td valign='middle' bgcolor='#FFFFFF'>".den2egyptiannumerals($number)."</td></tr>";
			}
			if ($num_len <= $max_len_chinese_numerals){
				echo "<tr><td width='200'>Chinese Numerals:</td><td valign='middle' bgcolor='#FFFFFF'>".den2chinesenumerals($number)."</td></tr>";
			}
			echo "<tr><td>Babylonian Numerals:</td><td valign='middle' bgcolor='#FFFFFF'>".dec2bab($number)."</td></tr>";
			echo '</table><br /><br />';//end table
		}	
	}else{
		echo '<b>\'',$number,'\' is not a positive integer.<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />';
	
	}
	echo '</td></tr></table></div>';
}else{
	echo " 
	<div align='center'><table width='75%' border='0' cellspacing='0' cellpadding='3'><tr><td align='left' class='text'>
    <h1>Number Cruncher</h1>
	Welcome to the number cruncher.
	Type in a number in the box below and we will crunch it for you.<br /><br />
	You will be taken to a page that tells you the following information about your number:
    <ul>
	<li>Is it odd or even?</li>
	<li>Is it a palindrome?</li>
	<li>Is it a prime number? (Checks numbers upto ".$max_len_prime." digits in length)</li>
	<li>Is it a <a class=\"link mlink\" href='http://en.wikipedia.org/wiki/Mersenne_prime'>mersenne prime</a>? (Checks numbers upto ".strlen($array_mersenne[(count($array_mersenne)-1)])." digits in length)</li>
	<li>Is it a <a class=\"link mlink\" href='http://www.fermatsearch.org/'>fermat prime</a>? (Checks numbers upto ".strlen($array_fermat[(count($array_fermat)-1)])." digits in length)</li>
	<li>Is it a <a class=\"link mlink\" href='http://en.wikipedia.org/wiki/Perfect_number'>perfect number</a>? (Checks numbers upto ".strlen($array_perfect[(count($array_perfect)-1)])." digits in length)</li>
	<li>Is it a triangle number? (Checks numbers upto ".$max_len_triangle." digits in length)</li>
	<li>Is it a square number? (Checks numbers upto ".$max_len_square." digits in length)</li>
	<li>Is it a cube number? (Checks numbers upto ".$max_len_cube." digits in length)</li>
	<li>Is it a factorial number? (Checks numbers upto ".strlen($array_factorial[(count($array_factorial)-1)])." digits in length)<br /><br /></li>
	<li>All factors of the number will be listed (for numbers upto ".$max_len_factorization." digits)</li>
	<li>The page will also show a list of base conversions. e.g. binary, octal and hexadecimal (Numbers upto ".$max_len_convertion ." digits in length)</li>
	<li>The number will be converted to roman numerals (Upto ".$max_len_roman_numerals." digits in length)</li>
	<li>The number will be converted to egyptian numerals (Upto ".$max_len_egypt_numerals." digits in length)</li>
	<li>The number will be converted to chinese numerals (Upto ".$max_len_chinese_numerals." digits in length)</li>
	<li>The number will be converted to babylonian numerals (Upto ".$max_len_babylonian_numerals." digits in length)</li>
    </ul>
	
	<br /><br />
	
	Please type your number here:
	<form name=\"crunchy\" action='".buildUrl($_GET,0,$config)."' method='get' target='_top'>
	<table width='200' border='0' cellspacing='0' cellpadding='2'>
	  <tr>
		<td><textarea name='number' cols='85' rows='10' onkeydown=\"if (event.keyCode == 13){document.location='".$url->cruncher()."'+crunchy.number.value+'/'}\">".$number."</textarea></td>
	  </tr>
	  <tr>
		<td align='center'><input type='button' value='Crunch' onclick=\"document.location='".$url->cruncher()."'+crunchy.number.value+'/'\" /></td>
	  </tr>
	</table>
    <input type='hidden' name='page' value='",$_GET['page'],"' />
	</form>
	</td></tr></table></div>";
}
