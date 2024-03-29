<?php
namespace Bigprimes\Pages;

class Faq extends \Bigprimes\Pages
{
    public function getContent()
    {
        return
            '<h1>FAQ</h1>

<br /><br /><br />
<b>Is x prime?</b>
<p>Please try our <a href="/cruncher/">number cruncher</a>. If your question is more complex then try using the <a href="/contact_us/">contact form</a>. I can\'t promise a quick response though.</p>

<br /><br />
<b>I\'ve taken the time to send you an email. Why haven\'t you responded?!</b>
<p>I apologise, I run this site in what little spare time I have. You will get a response.</p>

<br /><br />
<b>I\'ve found a bug/mistake on bigprimes.net!</b>
<p>Please send me an email using the <a href="/contact_us/">contact form</a>.</p>

<br /><br />
<b>What is the first set of 100 numbers (e.g. 100-199, 1300-1399, 312300-312399) that does not contain a prime number?</b>
<p>The first occurrence is between the prime numbers 1671781 and 1671907 on <a href="/archive/prime/1262/">this</a> page (near bottom of 3rd column).</p>

<br /><br />
<b>What is the smallest prime number that contains all digits 0 to 9 in sequence?</b>
<p>100123456789<p>

<br /><br />
<b>What percentage of prime numbers end in 1,3,7 and 9?</b>
<p>
  25% of prime numbers end in a 1<br>
  25% of prime numbers end in a 3<br>
  25% of prime numbers end in a 7<br>
  25% of prime numbers end in a 9<br>
</p>';

    }
}
