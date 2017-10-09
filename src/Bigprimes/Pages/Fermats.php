<?php
namespace Bigprimes\Pages;

class Fermats extends \Bigprimes\Pages
{

    public function getContent()
    {

        $return =
            '<h1>The Fermat Numbers</h1>
<table cellpadding="3" cellspacing="0" border="0" class="text">
<tr>
 <td width="28">&nbsp;</td>
 <td width="70"><b>No.</b></td>	
 <td width="70"><b>Fermat</b></td>	
 <td width="90"><b>Digits</b></td>
 <td width="130"><b>Prime / Factors</b></td>
 <td colspan="4" align="center"><b>Download</b></td>
</tr>
<tr>
 <td>&nbsp;</td>
 <td>11</td>	
 <td>2<sup>2048</sup>+1</td>
 <td></td>
 <td><a href="/cruncher/319489/">P27567</a> &times; 974849 &times; 167988556341760475137 &times; 3560841906445833920513 &times; <a href="/cruncher/4093/">P564</a></td>
 <td width="30"></td>
 <td width="30"></td>
 <td width="30"></td>
 <td width="30"></td>
</tr>
<tr>
 <td>&nbsp;</td>
 <td>10</td>	
 <td>2<sup>1024</sup>+1</td>
 <td></td>
 <td>45592577 &times; 6487031809 &times; 4659775785220018543264560743076778192897 &times; <a href="/cruncher/1601/">P252</a></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td>&nbsp;</td>
 <td>9</td>
 <td>2<sup>512</sup>+1</td>
 <td></td>
 <td>2424833 &times; 7455602825647884208337395736200454918783366342657 &times; <a href="/cruncher/523/">P99</a></td>
 <td><a href="//static.bigprimes.net/archive/fermat/F9.txt">TXT</a></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td>&nbsp;</td>
 <td>8</td>
 <td>2<sup>256</sup>+1</td>
 <td></td>
 <td>1238926361552897 &times; <a href="/cruncher/293/">P62</a></td>
 <td><a href="//static.bigprimes.net/archive/fermat/F8.txt">TXT</a></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td>&nbsp;</td>
 <td>7</td>
 <td>2<sup>128</sup>+1</td>
 <td>39</td>
 <td>59649589127497217 &times; 5704689200685129054721</td>
 <td><a href="//static.bigprimes.net/archive/fermat/F7.txt">TXT</a></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td>&nbsp;</td>
 <td>6</td>
 <td>2<sup>64</sup>+1</td>
 <td>20</td>
 <td>274177 &times; 67280421310721</td>
 <td><a href="//static.bigprimes.net/archive/fermat/F6.txt">TXT</a></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td>&nbsp;</td>
 <td>5</td>
 <td>2<sup>32</sup>+1</td>
 <td>10</td>
 <td>641 &times; 6700417</td>
 <td><a href="//static.bigprimes.net/archive/fermat/F5.txt">TXT</a></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td>&nbsp;</td>
 <td>4</td>	
 <td>2<sup>16</sup>+1</td>
 <td>5</td>
 <td>6543rd Prime</td>
 <td><a href="//static.bigprimes.net/archive/fermat/F4.txt">TXT</a></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td>&nbsp;</td>
 <td>3</td>	
 <td>2<sup>8</sup>+1</td>
 <td>3</td>
 <td>55th Prime</td>
 <td><a href="//static.bigprimes.net/archive/fermat/F3.txt">TXT</a></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td>&nbsp;</td>
 <td>2</td>	
 <td>2<sup>4</sup>+1</td>
 <td>2</td>
 <td>7th Prime</td>
 <td><a href="//static.bigprimes.net/archive/fermat/F2.txt">TXT</a></td>
 <td></td>
 <td></td>
 <td></td>
</tr> 
<tr>
 <td>&nbsp;</td>
 <td>1</td>	
 <td>2<sup>2</sup>+1</td>
 <td>1</td>
 <td>3rd Prime</td>
 <td><a href="//static.bigprimes.net/archive/fermat/F1.txt">TXT</a></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
<tr>
 <td>&nbsp;</td>
 <td>0</td>	
 <td>2<sup>1</sup>+1</td>
 <td>1</td>
 <td>2nd Prime</td>
 <td><a href="//static.bigprimes.net/archive/fermat/F0.txt">TXT</a></td>
 <td></td>
 <td></td>
 <td></td>
</tr>
</table>
';
        return $return;
    }
}

