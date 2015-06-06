<?php
namespace pages;

class faq extends \pages{
  function getContent(){
?>
<h1>FAQ</h1>

<br /><br /><br />
<b>Is x prime?</b>
<p>Please try our <a href="/cruncher/">number cruncher</a>. If your question is more complex then try using the <a href="/contact_us/">contact form</a>. I can't promise a quick response though.</p>

<br /><br />
<b>Can I have a copy of all 1.4 billion prime numbers that are on this site?</b>
<p>Yes, but due to it's size it is only available as a bit torrent. The file is in the format of 1 prime number per line and can be downloaded here: <a href="/pages/archive/hostingaccounts-bigprimes.net-1400000000-primes.7z.torrent">Torrent</a>. We have also compressed it using 7zip, if you don't have this fantastic open source software then it can be downloaded from <a href="http://www.7-zip.org/">http://www.7-zip.org/</a></p>

<br /><br />
<b>I've taken the time to send you an email. Why haven't you responded?!</b>
<p>I apologise, I run this site in what little spare time I have. I read every email and do intend to respond to all emails. I have a backlog of about 6 months at the moment.</p>

<br /><br />
<b>I've found a bug/mistake on bigprimes.net!</b>
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
</p>
<?php
  }
}
