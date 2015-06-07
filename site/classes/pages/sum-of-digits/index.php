<?php
for($i=2;$i<=9;$i++){
    $sums = $sumOfDigits->get($i);
    echo
    '<h1>Sum of '.$i.' digit primes</h1>
    <table class="sumOfDigits">
    <thead>
    <tr>
        <td>Sum</td>
        <td>count</td>
    </tr>
    </thead>
    <tbod>';
    foreach($sums as &$s){
        echo
        '<tr>
            <td>',$s['sum'],'</td>
            <td>',$s['count'],'</td>
        </tr>';
    }
    echo
    '</tbody>
    </table><br />';
}
?>
