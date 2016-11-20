<?php
//load the config array
require_once('config/site.config.php');

//load the generic functions
require_once('functions/include_functions.php');
require_once('functions/generic.php');
require_once('includes.php');
header ("content-type: text/xml");
echo '<?xml version="1.0" encoding="UTF-8" ?> ';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"> 
    <url>
        <loc>http://www.bigprimes.net/</loc> 
        <priority>1.00</priority> 
        <changefreq>weekly</changefreq> 
    </url>
    <url>
        <loc>http://www.bigprimes.net/contactus/</loc> 
        <priority>0.2</priority> 
        <changefreq>yearly</changefreq> 
    </url>
    <url>
        <loc>http://www.bigprimes.net/downloads/</loc> 
        <priority>0.5</priority> 
        <changefreq>monthly</changefreq> 
    </url>
    <url>
        <loc>http://www.bigprimes.net/cruncher/</loc> 
        <priority>0.5</priority> 
        <changefreq>yearly</changefreq> 
    </url>
    <url>
        <loc>http://www.bigprimes.net/primalitytest/</loc> 
        <priority>0.5</priority> 
        <changefreq>yearly</changefreq> 
    </url>
    <url>
        <loc>http://www.bigprimes.net/archive/prime/</loc> 
        <priority>0.5</priority> 
        <changefreq>yearly</changefreq> 
    </url>
    <url>
        <loc>http://www.bigprimes.net/archive/mersenne/</loc> 
        <priority>0.5</priority> 
        <changefreq>monthly</changefreq> 
    </url>
    <url>
        <loc>http://www.bigprimes.net/archive/fermat/</loc> 
        <priority>0.5</priority> 
        <changefreq>monthly</changefreq> 
    </url>
    <url>
        <loc>http://www.bigprimes.net/archive/perfect/</loc> 
        <priority>0.5</priority> 
        <changefreq>monthly</changefreq> 
    </url>
    <url>
        <loc>http://www.bigprimes.net/archive/fibonacci/</loc> 
        <priority>0.5</priority> 
        <changefreq>monthly</changefreq> 
    </url>
    <?php
        $query = mysql_query('SELECT number FROM prime_numbers WHERE id < 10000');
        while ($row = mysql_fetch_array($query,MYSQL_ASSOC)){
            $primesList[] = $row['number'];
        }
        foreach($primesList as &$num){
            echo
            '<url>
                <loc>',$url->cruncher($num,true),'</loc> 
                <priority>0.8</priority> 
                <changefreq>yearly</changefreq> 
            </url>';
        }
    ?>
</urlset>
