<?php
namespace pages\archive;

class prime extends \pages{
  function getContent(){
    $num = isset($_GET['num'])?(int)$_GET['num']:0;
    $num = ($num < 1 ? $num = 1 : $num);

    $number = ($num*100) - 99;

    $count = primes::count();

    $num_left = $count - $num;

    if ($count >= $num){
      echo
      '<h1>Prime numbers archive</h1>',
      'This page shows the ',numbers::stndrd($number),' prime number followed by the next 99.<br /><br />';

      $primesList = primes::primeSet($num);
    
      $i=0;
      echo '<table cellpadding="5" cellspacing="0" border="0" class="text">';
      foreach($primesList as $n=>$temp){
        $i++;
        echo
        '<tr>'
        ,'<td class="primeTableCell"><a class="link" href="/cruncher/'.$primesList[$n].'/">'.$primesList[$n],'</a></td>'
        ,'<td class="primeTableCell"><a class="link" href="/cruncher/'.$primesList[$n+25].'/">'.$primesList[$n+25],'</a></td>'
        ,'<td class="primeTableCell"><a class="link" href="/cruncher/'.$primesList[$n+50].'/">'.$primesList[$n+50],'</a></td>'
        ,'<td class="primeTableCell"><a class="link" href="/cruncher/'.$primesList[$n+75].'/">'.$primesList[$n+75],'</a></td>'
        ,'</tr>';
        if ($i >= 25){
          break 1;
        }
      }
      echo '</table>';
      if($num <= 1){
        $previousPrime = 0;
      }else{
        $numPrimes = (($num-1) * 100);
        $previousPrime = true;
      }
      echo
      '<br /><br />',($previousPrime==0?'0': round((100/$primesList[0]) * $numPrimes,3)),'% of the natural numbers below ',$primesList[0],' are prime.',
      '<br /><br />',
      '<table cellpadding="0" cellspacing="0" border="0">',
        '<tr>',
          '<td align="left" width="120">';
            if ($num >= 2){
              echo
              '<a class="link" href="/archive/prime/',($num-1),'/">previous 100 primes</a>';
            }
            echo
          '</td>',
          '<td align="right" width="120">';
            if ($num < $count){
              echo
              '<a class="link" href="/archive/prime/',($num+1),'/">next 100 primes</a>';
            }
            echo
          '</td>',
        '</tr>',
      '</table>';
    }else{
      echo 'We haven\'t discovered the ',numbers::stndrd($num),' prime number yet.';
    }

    echo 
    '<br /><br /><br />',
    '<form action="prime.php" method="post" target="_top" onsubmit="window.location=\'/archive/prime/\'+Math.ceil(document.getElementById(\'numPrime\').value/100);return false">
    Display the <input name="numPrime" id="numPrime" type="text" value="" /> prime number <input type="submit" value="Go" /></form>',
    '<br /><br /><br />',
    '<a class="link" href="/archive/prime/1/">1st Prime</a><br />',
    '<a class="link" href="/archive/prime/2/">101st Prime</a><br />',
    '<a class="link" href="/archive/prime/11/">1001st Prime</a><br />',
    '<a class="link" href="/archive/prime/101/">10001st Prime</a><br />',
    '<a class="link" href="/archive/prime/1001/">100001st Prime</a><br />',
    '<a class="link" href="/archive/prime/10001/">1000001st Prime</a><br />',
    '<a class="link" href="/archive/prime/100001/">10000001st Prime</a><br />',
    '<a class="link" href="/archive/prime/',$count,'/">Our Biggest Prime</a><br />';
  }
}
