<?php
namespace Bigprimes\Pages;

class SumOfDigits extends \Bigprimes\Pages{

    public function getContent(){
        $return = '';

        $sumOfDigits = new \Bigprimes\SumOfDigits(new \Bigprimes\Primes, $this->app);

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
	    '<tbod>';
	    foreach($sums as $s){
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

        return $return;
    }
}
