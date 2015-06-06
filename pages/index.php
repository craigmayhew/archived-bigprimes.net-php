<?php

echo
'<h1>Prime Numbers</h1>',
'We currently have ',
numbers::illion($primes->maxPrime,1),
' Prime numbers available for you.';

//news
?>
<body>
  <br />
  <br />

  <table cellpadding="3" cellspacing="0" border="1" class="text" bgcolor="#E0FAED" style="width:80%;">
    <tr>
      <td width="100">Date</td>
      <td width="300">News</td>
    </tr>
    <?php
$news = array(
  array('news'=>'You can now find the websites php source code here <a class="link" href="https://github.com/craigmayhew/bigprimes.net/">https://github.com/craigmayhew/bigprimes.net/</a>','date'=>'28th February 2014'),
  array('news'=>'I\'ve moved the database torrent to Amazons S3 to ensure the file always has peers available for download.','date'=>'26th January 2014'),
  array('news'=>'The complete database is now available for download as a torrent, please see the <a class="link" href="/faq/">FAQ</a> for details.','date'=>'3rd September 2012'),
  array('news'=>'Thank you to Yu Kwong Yiu Wilson for the donation!','date'=>'19th November 2011'),
  array('news'=>'We are retiring the distributed computing client. Thank you all for your help and processing cycles.

Watch this space for an open source GPU client coming soon...','date'=>'13th July 2011'),
  array('news'=>'We have added a page that shows the sum of the digits of prime numbers. <a class="link" href="/sum-of-digits">Click here</a>','date'=>'10th February 2010'),
  array('news'=>'Thanks to everyone for donating computer time, we are now upto 1.4 billion primes. We now also have a facebook group where you get news updates and show your support for the project!','date'=>'1st February 2010'),
  array('news'=>'Thanks for all your help! We made it to one billion prime numbers! Please keep on donating processor time as we still have plenty of storage for the prime numbers. <a class="link" rel="nofollow" href="/pages/grid/index.php">here</a>. Our database is now more than double the size (<a class="link" href="/archive/prime/3000000/">300 million primes</a>) and we\'ve put in the capacity to keep growing. To view our current progress please visit the <a class="link" href="/status/">status</a> page.','date'=>'28th September 2009'),
  array('news'=>'It\'s been a while but we have been very busy. We\'ve put together a distributed computing client written in javascript. If you wish to donate computing time and process some primes then please go <a class="link" rel="nofollow" href="/pages/grid/index.php">here</a>. Our database is now more than double the size (<a class="link" href="/archive/prime/3000000/">300 million primes</a>) and we\'ve put in the capacity to keep growing. To view our current progress please visit the <a class="link" href="/status/">status</a> page.','date'=>'18th August 2009'),
  array('news'=>'We\'ve now added a <a class="link" href="/forum/">Forum</a> which can be found on the navigation links on the left.','date'=>'17th July 2008'),
  array('news'=>'Someone named Kirk just emailed me to say the download links wern\'t working. I\'ve now fixed this. Thanks Kirk!','date'=>'14th July 2008'),
  array('news'=>'Added much faster code to the cruncher so that we can handle more of your page loads! Lots of little updates and some reorganizing of the site.','date'=>'4th July 2008'),
  array('news'=>'Added the <a class="link" href="/downloads/">Downloads</a> section.','date'=>'23rd June 2007'),
  array('news'=>'Added the Fibonacci number archive containing the first 70331 Fibonacci numbers.','date'=>'11th February 2007'),
  array('news'=>'Added the 44th Mersenne Prime number to the archive.','date'=>'16th January 2007'),
  array('news'=>'The Archives are now more organized.','date'=>'12th January 2007'),
  array('news'=>'We have managed to archive the first 100 million prime numbers.','date'=>'28th September 2005'),
  array('news'=>'We have managed to archive the first 75 million prime numbers.','date'=>'20th May 2005'),
  array('news'=>'We have managed to archive the first 50 million prime numbers.','date'=>'16th May 2005'),
  array('news'=>'We have managed to archive the first 10 million prime numbers.','date'=>'14th May 2005'),
  array('news'=>'We have managed to archive the first 1 million prime numbers.','date'=>'13th May 2005')
);

    foreach($news as $item){
        echo
        '<tr>',
          '<td>',$item['date'],'</td>',
          '<td>',$item['news'],'</td>',
        '</tr>';
    }
  echo
  '</table>';
