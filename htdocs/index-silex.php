<?php
$loader = require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Response;

$app = new Silex\Application();

//create a read connection and a write connection
//they are using the same mysql url currently, so this is for easy future scaling
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'dbs.options' => array(
        'mysql_read' => array(
            'driver' => 'pdo_mysql',
            'host' => getenv('bigprimesDBEndPoint'),
            'dbname' => getenv('bigprimesDBName'),
            'user' => getenv('bigprimesDBUser'),
            'password' => getenv('bigprimesDBPass'),
            'charset'   => 'utf8mb4',
        ),
        'mysql_write' => array(
            'driver' => 'pdo_mysql',
            'host' => getenv('bigprimesDBEndPoint'),
            'dbname' => getenv('bigprimesDBName'),
            'user' => getenv('bigprimesDBUser'),
            'password' => getenv('bigprimesDBPass'),
            'charset'   => 'utf8mb4',
        ),
    ),
));

$app->get('/archive/{type}/', function ($type) use ($app) {
    $type = ucfirst($type).'s';
    $pageName = '\\Bigprimes\\Pages\\'.$type;
    $page = new $pageName($app);
    
    $title              = 'Big Primes: '.$type;
    $metaTagDescription = 'Home of the large primes numbers archive and the number cruncher...';
    $metaTagKeywords    = 'prime, primes, perfect, fermat, numbers, number cruncher, archive';

    return
    $page->getHeader($title, $metaTagDescription, $metaTagKeywords).
    $page->getContent().
    $page->getFooter();
})->assert('type', 'fermat|fibonacci|mersenne|perfect|prime');

$app->get('/archive/{type}/{num}/', function ($type, $num) use ($app) {
    $type = ucfirst($type);
    $pageName = '\\Bigprimes\\Pages\\'.$type.'s';
    $page = new $pageName($app);

    $title              = 'Big Primes: '.$type;
    $metaTagDescription = 'Home of the large primes numbers archive and the number cruncher...';
    $metaTagKeywords    = 'prime, primes, perfect, fermat, numbers, number cruncher, archive';

    return
    $page->getHeader($title, $metaTagDescription, $metaTagKeywords).
    $page->getContent($num).
    $page->getFooter();
})->assert('type', 'fibonacci|prime')
->assert('num', '[0-9]+');

$app->get('/contactus/{stuff}', function ($stuff) use ($app) {
    $pageName = '\\Bigprimes\\Pages\\Contact';
    $page = new $pageName($app);
    
    $title              = 'Big Primes: Contact Us';
    $metaTagDescription = 'Home of the large primes numbers archive and the number cruncher...';
    $metaTagKeywords    = 'prime, primes, perfect, fermat, numbers, number cruncher, archive';

    return
    $page->getHeader($title, $metaTagDescription, $metaTagKeywords).
    $page->getContent().
    $page->getFooter();
})->assert('stuff', '.*');

$cruncher = function ($n='') use ($app) {
    $pageName = '\\Bigprimes\\Pages\\Cruncher';
    $page = new $pageName($app);

    $title              = 'Big Primes: Cruncher';
    $metaTagDescription = 'Home of the large primes numbers archive and the number cruncher...';
    $metaTagKeywords    = 'prime, primes, perfect, fermat, numbers, number cruncher, archive';

    return
    $page->getHeader($title, $metaTagDescription, $metaTagKeywords).
    $page->getContent($n).
    $page->getFooter();
};

$app->get('/cruncher/',$cruncher);
$app->get('/cruncher/{n}/',$cruncher)->assert('n', '[0-9]+');


$app->get('/downloads/', function () use ($app) {
    $pageName = '\\Bigprimes\\Pages\\Downloads';
    $page = new $pageName($app);

    $title              = 'Big Primes: Downloads';
    $metaTagDescription = 'Home of the large primes numbers archive and the number cruncher...';
    $metaTagKeywords    = 'prime, primes, perfect, fermat, numbers, number cruncher, archive';

    return
    $page->getHeader($title, $metaTagDescription, $metaTagKeywords).
    $page->getContent().
    $page->getFooter();
});

$app->get('/faq/', function () use ($app) {
    $pageName = '\\Bigprimes\\Pages\\Faq';
    $page = new $pageName($app);

    $title              = 'Big Primes: Frequently asked questions';
    $metaTagDescription = 'Home of the large primes numbers archive and the number cruncher...';
    $metaTagKeywords    = 'prime, primes, perfect, fermat, numbers, number cruncher, archive';

    return
    $page->getHeader($title, $metaTagDescription, $metaTagKeywords).
    $page->getContent().
    $page->getFooter();
});

$app->get('/primalitytest/', function () use ($app) {
    $pageName = '\\Bigprimes\\Pages\\Primalitytest';
    $page = new $pageName($app);

    $title              = 'Big Primes: Browser Powered Primality Test';
    $metaTagDescription = 'Home of the large primes numbers archive and the number cruncher...';
    $metaTagKeywords    = 'prime, primes, perfect, fermat, numbers, number cruncher, archive';

    return
    $page->getHeader($title, $metaTagDescription, $metaTagKeywords).
    $page->getContent().
    $page->getFooter();
});

$app->get('/status/', function () use ($app) {
    $pageName = '\\Bigprimes\\Pages\\Status';
    $page = new $pageName($app);

    $title              = 'Big Primes: Status';
    $metaTagDescription = 'Home of the large primes numbers archive and the number cruncher...';
    $metaTagKeywords    = 'prime, primes, perfect, fermat, numbers, number cruncher, archive';

    return
    $page->getHeader($title, $metaTagDescription, $metaTagKeywords).
    $page->getContent().
    $page->getFooter();
});


$app->get('/sum-of-digits/', function () use ($app) {
    $pageName = '\\Bigprimes\\Pages\\SumOfDigits';
    $page = new $pageName($app);

    $title              = 'Big Primes: Sum of Digits';
    $metaTagDescription = 'Home of the large primes numbers archive and the number cruncher...';
    $metaTagKeywords    = 'prime, primes, sum';

    return
    $page->getHeader($title, $metaTagDescription, $metaTagKeywords).
    $page->getContent().
    $page->getFooter();
});


$app->get('/', function () use ($app) {
    $pageName = '\\Bigprimes\\Pages\\Home';
    $page = new $pageName($app);
    
    $title              = 'Big Primes: large list of prime numbers';
    $metaTagDescription = 'Home of the large primes numbers archive and the number cruncher...';
    $metaTagKeywords    = 'prime, primes, perfect, fermat, numbers, number cruncher, archive';

    return
    $page->getHeader($title, $metaTagDescription, $metaTagKeywords).
    $page->getContent().
    $page->getFooter();
});

$app->get('/rss/{name}/', function ($name) use ($app) {
    //we only have one rss feed at the moment, so direct everything to that one class
    $pageName = '\\Bigprimes\\Rss\\News';
    $page = new $pageName($app);

    return new Response(
            $page->getContent(),
            200,
            ['Content-Type' => 'application/xml']
    );
})->assert('name', '[a-z0-9]+');

$app->get('/sitemap/', function ($name) use ($app) {
    //we only have one rss feed at the moment, so direct everything to that one class
    $pageName = '\\Bigprimes\\Pages\\SiteMap';
    $page = new $pageName($app);

    return new Response(
            $page->getContent(),
            200,
            ['Content-Type' => 'application/xml']
    );
});

$app->get('{url}', function ($url) use ($app) {
    $app->abort(404, "Endpoint does not exist.");
})->assert('url', '.*');

$app->run();
