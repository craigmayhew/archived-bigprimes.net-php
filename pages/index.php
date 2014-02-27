<?php require_once('header.php');

function illion($number,$dp=0){
    $len = strlen($number);
    if ($len <= 6){
        $return = $number;
    }elseif ($len == 7){
        $decStart = 1;
        $number = substr($number,0,($decStart+$dp)).'.'.substr($number,1,1);
        $end = ' million';
    }elseif ($len == 8){
        $decStart = 2;
        $number = substr($number,0,($decStart+$dp)).'.'.substr($number,2,1);
        $end = ' million';
    }elseif ($len == 9){
        $decStart = 3;
        $number = substr($number,0,($decStart+$dp));
        $end = ' million';
    }elseif ($len < 12){
        $decStart = ($len-9);
        $number = substr($number,0,($decStart+$dp));
        $end = ' billion';
    }elseif ($len < 15){
        $decStart = ($len-12);
        $number = substr($number,0,($decStart+$dp));
        $end = ' trillion';
    }
    $number = substr($number,0,$decStart).'.'.substr($number,$decStart).$end;
    return $number;
}

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
