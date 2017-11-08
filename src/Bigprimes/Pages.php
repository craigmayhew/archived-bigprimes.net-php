<?php
namespace Bigprimes;

class Pages
{
    protected $app;

    function __construct($app)
    {
        $this->app = $app;
    }

    // add st nd rd th to a number
    public function stndrd($n)
    {
        switch ($n) {
            case 1:
                return $n . 'st';
            case 2:
                return $n . 'nd';
            case 3:
                return $n . 'rd';
            case 11:
            case 12:
            case 13:
                return $n . 'th';
            default:
                $substr = substr($n, (strlen($n) - 1), 1);
                switch ($substr) {
                    case 1:
                        return $n . 'st';
                    case 2:
                        return $n . 'nd';
                    case 3:
                        return $n . 'rd';
                    default:
                        return $n . 'th';
                }
                break;
        }
    }


    public function getHeader($title, $metaTagDescription, $metaTagKeywords)
    {
        return
        '<!DOCTYPE html>'.
        '<html>'.
          '<head>'.
            '<meta charset="UTF-8">'.
            '<title>' . $title . '</title>' .
            '<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />' .
            '<meta name="keywords" content="' . $metaTagKeywords . '" />' .
            '<meta name="description" content="' . $metaTagDescription . '" />' .
            '<link rel="alternate" type="application/rss+xml" title="Big Primes RSS Feed" href="/rss/news/" />' .
            '<link href="//static.bigprimes.net/css/css.css" rel="stylesheet" type="text/css" />' .
            '<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>' .
          '</head>' .
          '<body>' .
            '<header>'.
              '<a href="/"><img src="//static.bigprimes.net/imgs/title.gif" alt="BigPrimes.net" /></a>'.
            '</header>'.
            '<nav>'.
              '<div>'.
                '<a href="/">Home</a>'.
                '<a href="/contactus/">Contact Us</a>'.
                '<a href="/faq/">FAQ</a>'.
              '</div>'.
              '<div>'.
                '<a href="/downloads/">Downloads</a>'.
                '<a href="/status/">Status</a>'.
              '</div>'.
              '<div>'.
                '<a href="/cruncher/">Number Cruncher</a>'.
                '<a href="/primalitytest/">Primality Checker</a>'.
              '</div>'.
              '<div>'.
                '<a href="/archive/prime/">Prime Numbers Archive</a>'.
                '<a href="/archive/mersenne/">Mersenne Prime Archive</a>'.
                '<a href="/archive/fermat/">Fermat Archive</a>'.
                '<a href="/archive/perfect/">Perfect Archive</a>'.
                '<a href="/archive/fibonacci/">Fibonacci Archive</a>'.
              '</div>'.
            '</nav>'.
            '<div id="content">';
    }

    public function getFooter()
    {
        return
            '</div>' .
            '<footer>' .
            '</footer>' .
          '</body>' .
        '</html>';
    }
}
