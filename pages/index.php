<?php require_once('header.php');

echo
'<h1>Prime Numbers</h1>',
'We currently have ',
illion($primes->maxPrime,1),
' Prime numbers available for you.';

//news
?>
<body>
  <br />
  <br />

  <table cellpadding="3" cellspacing="0" border="1" class="text"
  bgcolor="#E0FAED" style="width:80%;">
    <tr>
      <td width="100">Date</td>

      <td width="300">News</td>
    </tr>
    
    
    <?php
    $news = $database->queryFetchRows("
        SELECT
            `news`,
            DATE_FORMAT(`timestamp`,'%D %M %Y') AS `date`
        FROM
            `news`
        ORDER BY
            `timestamp` DESC
    ");
    foreach($news as &$item){
        echo
        '<tr>',
          '<td>',$item['date'],'</td>',
          '<td>',$item['news'],'</td>',
        '</tr>';
    }
  echo
  '</table>';
