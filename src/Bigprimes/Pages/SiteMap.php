<?php
namespace Bigprimes\Pages;

class SiteMap extends \Bigprimes\Pages
{

    public function getContent($num = 0)
    {
        $return =
            '<?xml version="1.0" encoding="UTF-8" ?>' .
            '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' .
            '<url>
        <loc>http://www.bigprimes.net/</loc> 
        <priority>1.00</priority> 
        <changefreq>weekly</changefreq> 
    </url>
    <url>
        <loc>http://www.bigprimes.net/links/</loc> 
        <priority>0.8</priority> 
        <changefreq>monthly</changefreq> 
    </url>
    <url>
        <loc>http://www.bigprimes.net/contact_us/</loc> 
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
        <loc>http://www.bigprimes.net/primality_test/</loc> 
        <priority>0.5</priority> 
        <changefreq>yearly</changefreq> 
    </url>
    <url>
        <loc>http://www.bigprimes.net/archive/prime/</loc> 
        <priority>0.5</priority> 
        <changefreq>yearly</changefreq> 
    </url>
    <url>
        <loc>http://www.bigprimes.net/biggest_primes/</loc> 
        <priority>0.5</priority> 
        <changefreq>monthly</changefreq> 
    </url>' .
            '<url>
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
    <url>
        <loc>http://www.bigprimes.net/archive_info/</loc> 
        <priority>0.5</priority> 
        <changefreq>monthly</changefreq> 
    </url>';

        $sql = 'SELECT number FROM primeNumbers WHERE id < ?';
        $rows = $this->app['dbs']['mysql_read']->fetchAll($sql, array(10000));
        foreach ($rows as $row) {
            $return .=
                '<url>' .
                '<loc>http://www.bigprimes.net/cruncher/' . $row['number'] . '</loc>' .
                '<priority>0.8</priority>' .
                '<changefreq>yearly</changefreq>' .
                '</url>';
        }
        $return .= '</urlset>';
    }
}
