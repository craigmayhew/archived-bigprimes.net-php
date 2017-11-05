<?php
namespace Bigprimes\Pages;

class Primes extends \Bigprimes\Pages
{

    public function getContent($num = 0)
    {

        if ($num < 1) {
            $num = 1;
        }

        $number = ($num * 100) - 99;

        $primes = new \Bigprimes\Primes($this->app);
        $count = $primes->numRows();

        $return = '';

        if ($count >= $num) {
            $return .=
                '<h1>Prime numbers archive</h1>' .
                'This page shows the ' . $this->stndrd($number) . ' prime number';
            $num_left = $count - $num;

            $return .=
                ' followed by the next 99' .
                '.<br /><br />';

            $primesList = $primes->primeSet($num);

            $i = 0;

            $return .=
                '<table cellpadding="5" cellspacing="0" border="0" class="text">';
            foreach ($primesList as $n => $temp) {
                $i++;
                $return .=
                    '<tr>'
                    . '<td class="primeTableCell"><a class="link" href="/cruncher/' . ($primesList[$n]) . '/">' . $primesList[$n] . '</a></td>'
                    . '<td class="primeTableCell"><a class="link" href="/cruncher/' . ($primesList[$n + 25]) . '/">' . $primesList[$n + 25] . '</a></td>'
                    . '<td class="primeTableCell"><a class="link" href="/cruncher/' . ($primesList[$n + 50]) . '/">' . $primesList[$n + 50] . '</a></td>'
                    . '<td class="primeTableCell"><a class="link" href="/cruncher/' . ($primesList[$n + 75]) . '/">' . $primesList[$n + 75] . '</a></td>'
                    . '</tr>';
                if ($i >= 25) {
                    break 1;
                }
            }
            $return .= '</table>';
            if ($num <= 1) {
                $previousPrime = 0;
            } else {
                $numPrimes = (($num - 1) * 100);
                $previousPrime = true;
            }

            if (isset($primesList[0]) && $primesList[0] > 0) {
                $return .=
                    '<br /><br />' .
                    ($previousPrime == 0 ? '0' : round((100 / $primesList[0]) * $numPrimes,
                        3)) . '% of the natural numbers below ' . $primesList[0] . ' are prime.';
            }

            $return .=
                '<br /><br />' .
                '<table cellpadding="0" cellspacing="0" border="0">' .
                '<tr>' .
                '<td align="left" width="120">';
            if ($num >= 2) {
                $return .=
                    '<a class="link" href="/archive/prime/' . ($num - 1) . '/">previous 100 primes</a>';
            }
            $return .=
                '</td>' .
                '<td align="right" width="120">';
            if ($num < $count) {
                $return .=
                    '<a class="link" href="/archive/prime/' . ($num + 1) . '/">next 100 primes</a>';
            }
            $return .=
                '</td>' .
                '</tr>' .
                '</table>';
        } else {
            $return .= 'We haven\'t discovered the ' . $this->stndrd($num) . ' prime number yet.';
        }


        $return .=
            '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px"
     data-ad-client="ca-pub-9286138628337172"
     data-ad-slot="8513669215"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>' .
            '<br /><br /><br />' .
            'Display the <input id="num" type="text" value="" /> prime number <button type="button" onclick="window.location.href=\'https://www.bigprimes.net/archive/prime/\'+Math.ceil($(\'#num\').val()/100)+\'/\'">Go</button>' .
            '<br /><br /><br />' .
            '<a class="link" href="/archive/prime/1/">1st Prime</a><br />' .
            '<a class="link" href="/archive/prime/2/">101st Prime</a><br />' .
            '<a class="link" href="/archive/prime/11/">1001st Prime</a><br />' .
            '<a class="link" href="/archive/prime/101/">10001st Prime</a><br />' .
            '<a class="link" href="/archive/prime/1001/">100001st Prime</a><br />' .
            '<a class="link" href="/archive/prime/10001/">1000001st Prime</a><br />' .
            '<a class="link" href="/archive/prime/100001/">10000001st Prime</a><br />' .
            '<a class="link" href="/archive/prime/' . $count . '/">Our Biggest Prime</a><br />';

        return $return;
//there are 1.4*10<sup>297</sup> primes smaller than 300 digits
//
//there is// always a prime between n^2 and (n+1)^2.
    }
}
