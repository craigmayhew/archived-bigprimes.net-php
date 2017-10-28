<?php

namespace Bigprimes\Pages;

class Speedtests extends \Bigprimes\Pages
{
    public function getContent()
    {
        $utils = new \Bigprimes\Utils();
        $return = '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <ins class="adsbygoogle"
             style="display:inline-block;width:728px;height:90px"
             data-ad-client="ca-pub-9286138628337172"
             data-ad-slot="8513669215"></ins>
        <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
        </script>';

        $return .= 
        '<div align="center">'.
          '<table class="text" width="75%" border="0" cellspacing="0" cellpadding="3">'.
            '<tr>'.
              '<td align="left" class="text">'.
                '<br />';

                $primes = new \Bigprimes\Primes($this->app);
               
                $crunchTime = 0;
                $waitTime = 1; 
                $number = 99;//start number
                while($crunchTime < $waitTime){
                  $startTime = microtime(true);
                  $n1 = $primes->checkIfNthPrime($number);
                  $waitTime = microtime(true) - $startTime;
                  
                  $startTime = microtime(true);
                  $n2 = $primes->cpuCheckNthPrime($number);
                  $crunchTime = microtime(true) - $startTime;

                  if ($n1 !== $n2) {
                    $return .= '$primes->checkIfNthPrime('.$number.')='.$n1.' and $primes->cpuCheckNthPrime('.$number.')='.$n2.' do not return the same value <br>';
                  }

                  $number +=2;
                }
                $return .= 'Crunch rather than read cache, for prime numbers up to the '.$this->stndrd($number).' prime. Crunch time: '.substr($crunchTime,0,6).' seconds<br>';

              $return .= 
              '</td>'.
            '</tr>'.
          '</table>'.
        '</div>';

        return $return;
    }
}
