<?php require_once("header.php");

echo "
<h1>The Largest Known Primes</h1>
<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"text\">
<tr>
 <td width=\"70\"><b>Position</b></td>	
 <td width=\"130\"><b>Prime</b></td>
 <td width=\"90\"><b>Digits</b></td>
 <td width=\"130\"><b>Year of Discovery</b></td>
 <td></td>
</tr>";

$i=1;
$biggest_primes[$i]['prime']='2<sup>32582657</sup>-1';
$biggest_primes[$i]['digits']=9808358;
$biggest_primes[$i]['date']='Sep. 4, 2006';
$biggest_primes[$i]['description']='Mersenne 44?';
$i++;
$biggest_primes[$i]['prime']='2<sup>30402457</sup>-1';
$biggest_primes[$i]['digits']=9152052;
$biggest_primes[$i]['date']='2005';
$biggest_primes[$i]['description']='Mersenne 43?';
$i++;
$biggest_primes[$i]['prime']='2<sup>25964951</sup>-1';
$biggest_primes[$i]['digits']=7816230;
$biggest_primes[$i]['date']='2005';
$biggest_primes[$i]['description']='Mersenne 42?';
$i++;
$biggest_primes[$i]['prime']='2<sup>24036583</sup>-1';
$biggest_primes[$i]['digits']=7235733;
$biggest_primes[$i]['date']='2004';
$biggest_primes[$i]['description']='Mersenne 41?';
$i++;
$biggest_primes[$i]['prime']='2<sup>20996011</sup>-1';
$biggest_primes[$i]['digits']=6320430;
$biggest_primes[$i]['date']='2003';
$biggest_primes[$i]['description']='Mersenne 40?';
$i++;
$biggest_primes[$i]['prime']='2<sup>13466917</sup>-1';
$biggest_primes[$i]['digits']=4053946;
$biggest_primes[$i]['date']='2001';
$biggest_primes[$i]['description']='Mersenne 39';
$i++;
$biggest_primes[$i]['prime']='19249·2<sup>213018586</sup>+1';
$biggest_primes[$i]['digits']=3918990;
$biggest_primes[$i]['date']='2007';
$biggest_primes[$i]['description']='';$i++;
$biggest_primes[$i]['prime']='27653·2<sup>2759677</sup>+1';
$biggest_primes[$i]['digits']=2759677;
$biggest_primes[$i]['date']='2005';
$biggest_primes[$i]['description']='';
$i++;
$biggest_primes[$i]['prime']='28433·2<sup>7830457</sup>+1';
$biggest_primes[$i]['digits']=2357207;
$biggest_primes[$i]['date']='2004';
$biggest_primes[$i]['description']='';
$i++;
$biggest_primes[$i]['prime']='33661·2<sup>27031232</sup>+1';
$biggest_primes[$i]['digits']=2116617;
$biggest_primes[$i]['date']='2007';
$biggest_primes[$i]['description']='';
$i++;
$biggest_primes[$i]['prime']='2<sup>6972593</sup>-1';
$biggest_primes[$i]['digits']=2098960;
$biggest_primes[$i]['date']='1999';
$biggest_primes[$i]['description']='Mersenne 38';
$i++;
$biggest_primes[$i]['prime']='5359.2<sup>5054502</sup>+1';
$biggest_primes[$i]['digits']=1521561;
$biggest_primes[$i]['date']='2003';
$biggest_primes[$i]['description']='';
$i++;
$biggest_primes[$i]['prime']='2<sup>3021377</sup>-1';
$biggest_primes[$i]['digits']=909526;
$biggest_primes[$i]['date']='1998';
$biggest_primes[$i]['description']='Mersenne 37';
$i++;
$biggest_primes[$i]['prime']='2<sup>2976221</sup>-1';
$biggest_primes[$i]['digits']=895932;
$biggest_primes[$i]['date']='1997';
$biggest_primes[$i]['description']='Mersenne 36';
$i++;
$biggest_primes[$i]['prime']='1372930<sup>131072</sup>+1';
$biggest_primes[$i]['digits']=804474;
$biggest_primes[$i]['date']='2003';
$biggest_primes[$i]['description']='Generalized Fermat';

foreach ($biggest_primes as $position => $prime)
{	echo
	'<tr>
	 <td width="70">'.$position.'</td>	
	 <td width="130">'.$biggest_primes[$position]['prime'].'</td>
	 <td width="90">'.$biggest_primes[$position]['digits'].'</td>
	 <td width="130">'.$biggest_primes[$position]['date'].'</td>
	 <td>'.$biggest_primes[$position]['description'].'</td>
	</tr>';
}


echo '</table>';

require_once("footer.php");?>
