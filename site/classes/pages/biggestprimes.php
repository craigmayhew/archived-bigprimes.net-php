<?php
namespace pages;

class contactus extends \pages{
  function getContent(){
    $return = 
    '<h1>The Largest Known Primes</h1>'.
      '<table cellpadding="0" cellspacing="0" border="0" class="text">'.
        '<tr>'.
          '<td width="70"><b>Position</b></td>'.	
          '<td width="130"><b>Prime</b></td>'.
          '<td width="90"><b>Digits</b></td>'.
          '<td width="130"><b>Year of Discovery</b></td>'.
          '<td>'.
        '</td>'.
      '</tr>';

    $bigPrimes = 
    array(
      array('prime'=>'2<sup>32582657</sup>-1',       'digits'=>9808358,'date'=>'2006','description'=>'Mersenne 44?'),
      array('prime'=>'2<sup>30402457</sup>-1',       'digits'=>9152052,'date'=>'2005','description'=>'Mersenne 43?'),
      array('prime'=>'2<sup>25964951</sup>-1',       'digits'=>7816230,'date'=>'2005','description'=>'Mersenne 42?'),
      array('prime'=>'2<sup>24036583</sup>-1',       'digits'=>7235733,'date'=>'2004','description'=>'Mersenne 41?'),
      array('prime'=>'2<sup>20996011</sup>-1',       'digits'=>6320430,'date'=>'2003','description'=>'Mersenne 40?'),
      array('prime'=>'2<sup>13466917</sup>-1',       'digits'=>4053946,'date'=>'2001','description'=>'Mersenne 39'),
      array('prime'=>'19249·2<sup>213018586</sup>+1','digits'=>3918990,'date'=>'2007','description'=>''),
      array('prime'=>'27653·2<sup>2759677</sup>+1',  'digits'=>2759677,'date'=>'2005','description'=>''),
      array('prime'=>'28433·2<sup>7830457</sup>+1',  'digits'=>2357207,'date'=>'2004','description'=>''),
      array('prime'=>'33661·2<sup>27031232</sup>+1', 'digits'=>2116617,'date'=>'2007','description'=>''),
      array('prime'=>'2<sup>6972593</sup>-1',        'digits'=>2098960,'date'=>'1999','description'=>'Mersenne 38'),
      array('prime'=>'5359.2<sup>5054502</sup>+1',   'digits'=>1521561,'date'=>'2003','description'=>''),
      array('prime'=>'2<sup>3021377</sup>-1',        'digits'=>909526, 'date'=>'1998','description'=>'Mersenne 37'),
      array('prime'=>'2<sup>2976221</sup>-1',        'digits'=>895932, 'date'=>'1997','description'=>'Mersenne 36'),
      array('prime'=>'1372930<sup>131072</sup>+1',   'digits'=>804474, 'date'=>'2003','description'=>'Generalized Fermat')
    );

    foreach ($bigPrimes as $i => $prime){
      $position = $i+1;
    	$return .=
      '<tr>'.
        '<td width="70">'. $position.'</td>'.
        '<td width="130">'.$bigPrimes[$i]['prime'].'</td>'.
        '<td width="90">'. $bigPrimes[$i]['digits'].'</td>'.
        '<td width="130">'.$bigPrimes[$i]['date'].'</td>'.
        '<td>'.$biPrimes[$i]['description'].'</td>'.
      '</tr>';
    }

    $return .=
    '</table>';
  }
}
