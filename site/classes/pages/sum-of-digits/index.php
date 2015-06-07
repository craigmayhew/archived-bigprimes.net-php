<?php
namespace pages\sumofdigits;

class index extends \pages{
  function getContent(){
    for($i=2;$i<=9;$i++){
      $sums = $sumOfDigits->get($i);
      $return .=
      '<h1>Sum of '.$i.' digit primes</h1>'.
      '<table class="sumOfDigits">'.
        '<thead>'.
          '<tr>'.
            '<td>Sum</td>'.
            '<td>count</td>'.
          '</tr>'.
        '</thead>'.
        '<tbody>';
        foreach($sums as &$s){
          $return .=
          '<tr>'.
              '<td>'.$s['sum'].'</td>'.
              '<td>'.$s['count'].'</td>'.
          '</tr>';
        }
        $return .=
        '</tbody>'.
      '</table>'.
      '<br />';
    }
  }
}
