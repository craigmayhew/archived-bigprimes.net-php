<?php

// Hugh Bothwell  hugh_bothwell@hotmail.com
// August 31 2001
// Number-to-word converter

$ones = array(
 "",
 " one",
 " two",
 " three",
 " four",
 " five",
 " six",
 " seven",
 " eight",
 " nine",
 " ten",
 " eleven",
 " twelve",
 " thirteen",
 " fourteen",
 " fifteen",
 " sixteen",
 " seventeen",
 " eighteen",
 " nineteen"
);

$tens = array(
 "",
 "",
 " twenty",
 " thirty",
 " forty",
 " fifty",
 " sixty",
 " seventy",
 " eighty",
 " ninety"
);

$triplets = array(
 "",
 " thousand",
 " million",
 " billion",
 " trillion",
 " quadrillion",
 " quintillion",
 " sextillion",
 " septillion",
 " octillion",
 " nonillion"
);

 // recursive fn, converts three digits per pass
 function convertTri($num, $tri) {
  global $ones, $tens, $triplets;

  // chunk the number, ...rxyy
  //$r = (int) bcdiv($num,1000);
  $r = bcdiv($num,1000);

  $x = bcmod(bcdiv($num,100),10);
  $y = bcmod($num,100);

  // init the output string
  $str = '';

  // do hundreds
  if ($x > 0)
   $str = $ones[$x] . " hundred";

  // do ones and tens
  if ($y < 20){
   $str .= $ones[$y];
  }else{
   $str .= $tens[(int) bcdiv($y,10)] . $ones[bcmod($y,10)];
  }
  // add triplet modifier only if there
  // is some output to be modified...
  if ($str != '' && isset($triplets[$tri])){
   $str .= $triplets[$tri];
  }
  
  // continue recursing?
  if ($r > 0){
   return convertTri($r, bcadd($tri,1)).$str;
  }else{
   return $str;
  }
 }

// returns the number as an anglicized string
function convertNum($num) {
 //$num = (int) $num;    // make sure it's an integer

 //if ($num < 0)
  //return "negative".convertTri(-$num, 0);

 if (!bccomp($num,0)){//same as $num==0
    return 'zero';
 }

 return convertTri($num, 0);
}

function randThousand() {
   return mt_rand(0,999);
}

// Returns an integer in -10^9 .. 10^9
// with log distribution
/*// example of usage
for ($i = 0; $i < 20; $i++) {
 $num = makeLogRand();
 echo "<br>$num: ".convertNum($num);
}*/
function makeLogRand() {
  $sign = mt_rand(0,1)*2 - 1;
  $val = randThousand() * 1000000
   + randThousand() * 1000
   + randThousand();
  $scale = mt_rand(-9,0);

  return $sign * (int) ($val * pow(10.0, $scale));
}

function illion($number,$dp=0){
    $len = strlen($number);
    if ($len <= 6){
        $return = $number;
    }elseif ($len == 7){
        $decStart = 1;
        $number = substr($number,0,($decStart+$dp)).'.'.substr($number,1,1);
        $end = ' million';
    }elseif ($len == 8){
        $decStart = 2;
        $number = substr($number,0,($decStart+$dp)).'.'.substr($number,2,1);
        $end = ' million';
    }elseif ($len == 9){
        $decStart = 3;
        $number = substr($number,0,($decStart+$dp));
        $end = ' million';
    }elseif ($len < 12){
        $decStart = ($len-9);
        $number = substr($number,0,($decStart+$dp));
        $end = ' billion';
    }elseif ($len < 15){
        $decStart = ($len-12);
        $number = substr($number,0,($decStart+$dp));
        $end = ' trillion';
    }
    $number = substr($number,0,$decStart).'.'.substr($number,$decStart).$end;
    return $number;
}
?>
