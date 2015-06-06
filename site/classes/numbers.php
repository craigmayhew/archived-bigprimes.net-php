<?php

class numbers{
  public $ones = array(
    '',' one',' two',' three',' four',' five',' six',' seven',' eight',' nine',' ten',
    ' eleven',' twelve',' thirteen',' fourteen',' fifteen',' sixteen',' seventeen',' eighteen',' nineteen'
   );

  public $tens = array(
     '','',' twenty',' thirty',' forty',' fifty',' sixty',' seventy',' eighty',' ninety'
   );

  public $triplets = array(
    '',' thousand',' million',' billion',' trillion',' quadrillion',
    ' quintillion',' sextillion',' septillion',' octillion',' nonillion'
  );

  // recursive fn, converts three digits per pass
  public function convertTri($num, $tri) {
    // chunk the number, ...rxyy
    //$r = (int) bcdiv($num,1000);
    $r = bcdiv($num,1000);

    $x = bcmod(bcdiv($num,100),10);
    $y = bcmod($num,100);

    // init the output string
    $str = '';

    // do hundreds
    if ($x > 0){
      $str = self::$ones[$x] . " hundred";
    }

    // do ones and tens
    if ($y < 20){
      $str .= self::$ones[$y];
    }else{
      $str .= self::$tens[(int) bcdiv($y,10)] . self::$ones[bcmod($y,10)];
    }
    // add triplet modifier only if there
    // is some output to be modified...
    if ($str != '' && isset($triplets[$tri])){
      $str .= $triplets[$tri];
    }
    
    // continue recursing?
    if ($r > 0){
      return self::convertTri($r, bcadd($tri,1)).$str;
    }else{
      return $str;
    }
  }

  // returns the number as an anglicized string
  public function convertNum($num) {
    if (!bccomp($num,0)){//same as $num==0
      return 'zero';
    }

    return self::convertTri($num, 0);
  }

  public function randThousand() {
    return mt_rand(0,999);
  }

  public function illion($number,$dp=0){
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
  public function stndrd($n){
    if ($n == 1)
        {return '1st';}
    elseif ($n == 2)
        {return '2nd';}
    elseif ($n == 3)
        {return '3rd';}
    elseif ($n == 11) 
        {return '11th';}
    elseif ($n == 12) 
        {return '12th';}
    elseif ($n == 13) 
        {return '13th';}
    elseif (substr($n,(strlen($n)-1),1) == '1')
        {return $n.'st';}
    elseif (substr($n,(strlen($n)-1),1) == '2')
        {return $n.'nd';}
    elseif (substr($n,(strlen($n)-1),1) == '3')
        {return $n.'rd';}
    else
        {return $n.'th';}
  }
}
