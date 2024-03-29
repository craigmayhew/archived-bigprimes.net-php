<?php
namespace Bigprimes\Pages;

class Mersennes extends \Bigprimes\Pages
{

    public function getContent()
    {

        $return =
            '<h1>The Mersenne Primes</h1>
<table cellpadding="0" cellspacing="0" border="0" class="mersennetable text">
<tr>
 <td width="70"><b>No.</b></td>	
 <td width="130"><b>Prime</b></td>
 <td width="90"><b>Digits</b></td>
 <td width="130"><b>Discovered</b></td>
 <td colspan="3" align="center"><b>Download</b></td>
</tr>
<tr>
 <td>50</td>
 <td>2<sup>77232917</sup>-1</td>
 <td>23249425</td>
 <td>26-Dec-2017</td>
 <td width="30"></td>
 <td width="30"></td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M50.zip">ZIP</a></td>
</tr>
<tr>
 <td>49</td>
 <td>2<sup>74207281</sup>-1</td>
 <td>22338618</td>
 <td>07-Jan-2016</td>
 <td width="30"></td>
 <td width="30"></td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M49.zip">ZIP</a></td>
</tr>
<tr>
 <td>48</td>
 <td>2<sup>57885161</sup>-1</td>
 <td>17425170</td>
 <td>25-Jan-2013</td>
 <td width="30"></td>
 <td width="30"></td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M48.zip">ZIP</a></td>
</tr>
<tr>
 <td>47</td>    
 <td>2<sup>43112609</sup>-1</td>
 <td>12978189</td>
 <td>12-Apr-2008</td>
 <td width="30"></td>
 <td width="30"></td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M47.zip">ZIP</a></td>
</tr>
<tr>
 <td>46</td>    
 <td>2<sup>42643801</sup>-1</td>
 <td>12837064</td>
 <td>06-Sep-2009</td>
 <td width="30"></td>
 <td width="30"></td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M46.zip">ZIP</a></td>
</tr>
<tr>
 <td>45</td>    
 <td>2<sup>37156667</sup>-1</td>
 <td>11185272</td>
 <td>23-Aug-2008</td>
 <td width="30"></td>
 <td width="30"></td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M45.zip">ZIP</a></td>
</tr>
<tr>
 <td>44</td>	
 <td>2<sup>32582657</sup>-1</td>
 <td>9808358</td>
 <td>4-Sep-2006</td>
 <td width="30"></td>
 <td width="30"></td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M44.zip">ZIP</a></td>
</tr>
<tr>
 <td>43</td>
 <td>2<sup>30402457</sup>-1</td>
 <td>9152052</td>
 <td>15-Dec-2005</td>
 <td width="30"></td>
 <td width="30"></td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M43.zip">ZIP</a></td>
</tr>
<tr>
 <td>42</td>
 <td>2<sup>25964951</sup>-1</td>
 <td>7816230</td>
 <td>26-Feb-2005</td>
 <td width="30"></td>
 <td width="30"></td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M42.zip">ZIP</a></td>
</tr>
<tr>
 <td>41</td>
 <td>2<sup>24036583</sup>-1</td>
 <td>7235733</td>
 <td>28-May-2004</td>
 <td width="30"></td>
 <td width="30"></td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M41.zip">ZIP</a></td>
</tr>
<tr>
 <td>40</td>
 <td>2<sup>20996011</sup>-1</td>
 <td>6320430</td>
 <td>17-Nov-2003</td>
 <td width="30"></td>
 <td width="30"></td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M40.zip">ZIP</a></td>
</tr>
<tr>
 <td>39</td>
 <td>2<sup>13466917</sup>-1</td>
 <td>4053946</td>
 <td>14-Nov-2001</td>
 <td width="30"></td>
 <td width="30"></td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M39.zip">ZIP</a></td>
</tr>
<tr>
 <td>38</td>
 <td>2<sup>6972593</sup>-1</td>
 <td>2098960</td>
 <td>1-Jun-1999</td>
 <td width="30"></td>
 <td width="30"></td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M38.zip">ZIP</a></td>
</tr>
<tr>
 <td>37</td>
 <td>2<sup>3021377</sup>-1</td>
 <td>909526</td>
 <td>27-Jan-1998</td>
 <td width="30"></td>
 <td width="30"></td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M37.zip">ZIP</a></td>
</tr>
<tr>
 <td>36</td>
 <td>2<sup>2976221</sup>-1</td>
 <td>895832</td>
 <td>24-Aug-1997</td>
 <td width="30"></td>
 <td width="30"></td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M36.zip">ZIP</a></td>
</tr>
<tr>
 <td>35</td>
 <td>2<sup>1398269</sup>-1</td>
 <td>420921</td>
 <td>12-Nov-1996</td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M35.txt">TXT</a></td>
 <td width="30"></td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M35.zip">ZIP</a></td>
</tr>
<tr>
 <td>34</td>
 <td>2<sup>1257787</sup>-1</td>
 <td>378632</td>
 <td>3-Sep-1996</td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M34.txt">TXT</a></td>
 <td width="30"></td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M34.zip">ZIP</a></td>
</tr>
<tr>
 <td>33</td>
 <td>2<sup>859433</sup>-1</td>
 <td>258716</td>
 <td>10-Jan-1994</td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M33.txt">TXT</a></td>
 <td width="30"></td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M33.zip">ZIP</a></td>
</tr>
<tr>
 <td>32</td>
 <td>2<sup>756839</sup>-1</td>
 <td>227832</td>
 <td>19-Feb-1992</td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M32.txt">TXT</a></td>
 <td width="30"></td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M32.zip">ZIP</a></td>
</tr>
<tr>
 <td>31</td>
 <td>2<sup>216091</sup>-1</td>
 <td>65050</td>
 <td>6-Sep-1985</td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M31.txt">TXT</a></td>
 <td width="30"></td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M31.zip">ZIP</a></td>
</tr>
<tr>
 <td>30</td>
 <td>2<sup>132049</sup>-1</td>
 <td>39751</td>
 <td>20-Sep-1983</td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M30.txt">TXT</a></td>
 <td width="30"></td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M30.zip">ZIP</a></td>
</tr>
<tr>
 <td>29</td>
 <td>2<sup>110503</sup>-1</td>
 <td>33265</td>
 <td>28-Jan-1988</td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M29.txt">TXT</a></td>
 <td width="30"></td>
 <td width="30"></td>
</tr>
<tr>
 <td>28</td>
 <td>2<sup>86243</sup>-1</td>
 <td>25962</td>
 <td>25-Sep-1982</td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M28.txt">TXT</a></td>
 <td width="30"></td>
 <td width="30"></td>
</tr>
<tr>
 <td>27</td>
 <td>2<sup>44497</sup>-1</td>
 <td>13395</td>
 <td>8-Apr-1979</td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M27.txt">TXT</a></td>
 <td width="30"></td>
 <td width="30"></td>
</tr>
<tr>
 <td>26</td>
 <td>2<sup>23209</sup>-1</td>
 <td>6987</td>
 <td>9-Feb-1979</td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M26.txt">TXT</a></td>
 <td width="30"></td>
 <td width="30"></td>
</tr>
<tr>
 <td>25</td>
 <td>2<sup>21701</sup>-1</td>
 <td>6533</td>
 <td>30-Oct-1978</td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M25.txt">TXT</a></td>
 <td width="30"></td>
 <td width="30"></td>
</tr>
<tr>
 <td>24</td>
 <td>2<sup>19937</sup>-1</td>
 <td>6002</td>
 <td>4-Mar-1971</td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M24.txt">TXT</a></td>
 <td width="30"></td>
 <td width="30"></td>
</tr>
<tr>
 <td>23</td>
 <td>2<sup>11213</sup>-1</td>
 <td>3376</td>
 <td>2-Jun-1963</td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M23.txt">TXT</a></td>
 <td width="30"></td>
 <td width="30"></td>
</tr>
<tr>
 <td>22</td>
 <td>2<sup>9941</sup>-1</td>
 <td>2993</td>
 <td>16-May-1963</td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M22.txt">TXT</a></td>
 <td width="30"></td>
 <td width="30"></td>
</tr>
<tr>
 <td>21</td>
 <td>2<sup>9689</sup>-1</td>
 <td>2917</td>
 <td>11-May-1963</td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M21.txt">TXT</a></td>
 <td width="30"></td>
 <td width="30"></td>
</tr>
<tr>
 <td>20</td>
 <td>2<sup>4423</sup>-1</td>
 <td>1332</td>
 <td>3-Nov-1961</td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M20.txt">TXT</a></td>
 <td width="30"></td>
 <td width="30"></td>
</tr>
<tr>
<tr>
 <td>19</td>
 <td>2<sup>4253</sup>-1</td>
 <td>1281</td>
 <td>3-Nov-1961</td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M19.txt">TXT</a></td>
 <td width="30"></td>
 <td width="30"></td>
</tr>
<tr>
 <td>18</td>
 <td>2<sup>3217</sup>-1</td>
 <td>969</td>
 <td>8-Sep-1957</td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M18.txt">TXT</a></td>
 <td width="30"></td>
 <td width="30"></td>
</tr>
<tr>
 <td>17</td>
 <td>2<sup>2281</sup>-1</td>
 <td>687</td>
 <td>9-Oct-1952</td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M17.txt">TXT</a></td>
 <td width="30"></td>
 <td width="30"></td>
</tr>
<tr>
 <td>16</td>
 <td>2<sup>2203</sup>-1</td>
 <td>664</td>
 <td>7-Oct-1952</td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M16.txt">TXT</a></td>
 <td width="30"></td>
 <td width="30"></td>
</tr>
<tr>
 <td>15</td>
 <td>2<sup>1279</sup>-1</td>
 <td>386</td>
 <td>26-Jun-1952</td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M15.txt">TXT</a></td>
 <td width="30"></td>
 <td width="30"></td>
</tr>
<tr>
 <td>14</td>
 <td>2<sup>607</sup>-1</td>
 <td>183</td>
 <td>30-Jan-1952</td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M14.txt">TXT</a></td>
 <td width="30"></td>
 <td width="30"></td>
</tr>
<tr>
 <td>13</td>
 <td>2<sup>521</sup>-1</td>
 <td>157</td>
 <td>30-Jan-1952</td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M13.txt">TXT</a></td>
 <td width="30"></td>
 <td width="30"></td>
</tr>
<tr>
 <td>12</td>
 <td>2<sup>127</sup>-1</td>
 <td>39</td>
 <td>1876</td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M12.txt">TXT</a></td>
 <td width="30"></td>
 <td width="30"></td>
</tr>
<tr>
 <td>11</td>
 <td>2<sup>107</sup>-1</td>
 <td>33</td>
 <td>1914</td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M11.txt">TXT</a></td>
 <td width="30"></td>
 <td width="30"></td>
</tr>
<tr>
 <td>10</td>
 <td>2<sup>89</sup>-1</td>
 <td>27</td>
 <td>1911</td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M10.txt">TXT</a></td>
 <td width="30"></td>
 <td width="30"></td>
</tr>
<tr>
 <td>9</td>
 <td>2<sup>61</sup>-1</td>
 <td>19</td>
 <td>1883</td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M9.txt">TXT</a></td>
 <td width="30"></td>
 <td width="30"></td>
</tr>
<tr>
 <td>8</td>
 <td>2<sup>31</sup>-1</td>
 <td>10</td>
 <td>1772</td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M8.txt">TXT</a></td>
 <td width="30"></td>
 <td width="30"></td>
</tr>
<tr>
 <td>7</td>
 <td>2<sup>19</sup>-1</td>
 <td>6</td>
 <td>1588</td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M7.txt">TXT</a></td>
 <td width="30"></td>
 <td width="30"></td>
</tr>
<tr>
 <td>6</td>
 <td>2<sup>17</sup>-1</td>
 <td>6</td>
 <td>1588</td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M6.txt">TXT</a></td>
 <td width="30"></td>
 <td width="30"></td>
</tr>
<tr>
 <td>5</td>
 <td>2<sup>13</sup>-1</td>
 <td>4</td>
 <td>1456</td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M5.txt">TXT</a></td>
 <td width="30"></td>
 <td width="30"></td>
</tr>
<tr>
 <td>4</td>
 <td>2<sup>7</sup>-1</td>
 <td>3</td>
 <td>275BC</td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M4.txt">TXT</a></td>
 <td width="30"></td>
 <td width="30"></td>
</tr>
<tr>
 <td>3</td>
 <td>2<sup>5</sup>-1</td>
 <td>2</td>
 <td>275BC</td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M3.txt">TXT</a></td>
 <td width="30"></td>
 <td width="30"></td>
</tr>
<tr>
 <td>2</td>
 <td>2<sup>3</sup>-1</td>
 <td>1</td>
 <td>500BC</td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M2.txt">TXT</a></td>
 <td width="30"></td>
 <td width="30"></td>
</tr>
<tr>
 <td>1</td>
 <td>2<sup>2</sup>-1</td>
 <td>1</td>
 <td>500BC</td>
 <td width="30"><a href="//static.bigprimes.net/archive/mersenne/M1.txt">TXT</a></td>
 <td width="30"></td>
 <td width="30"></td>
</tr>
</table>';

        return
            $return;
    }
}
