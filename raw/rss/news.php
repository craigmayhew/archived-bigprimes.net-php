<?php
    $news = $database->queryFetchRows("
    SELECT
        `news` AS `description`,
        `title`,
        DATE_FORMAT(`timestamp`,'%a, %d %b %Y %T') AS `date`,
        '".$url->u(array(),'index',true)."' AS `link`
    FROM
        `news`
    ORDER BY
        `timestamp` DESC
    ");
    echo $rss->buildXML($news,'Big Primes News',$url->u(array('rss','news'),'index',true),'Big Prime news updates.');
?>
