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
                return '1st';
            case 2:
                return '2nd';
            case 3:
                return '3rd';
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
            '<script async src="https://www.googletagmanager.com/gtag/js?id=UA-6215762-7"></script>'.
            '<script>'.
              'window.dataLayer = window.dataLayer || [];'.
              'function gtag(){dataLayer.push(arguments);}'.
              'gtag(\'js\', new Date());'.
              'gtag(\'config\', \'UA-6215762-7\');'.
            '</script>'.
            '<meta charset="UTF-8">'.
            '<title>' . $title . '</title>' .
            '<meta name="keywords" content="' . $metaTagKeywords . '" />' .
            '<meta name="description" content="' . $metaTagDescription . '" />' .
            '<link rel="alternate" type="application/rss+xml" title="Big Primes RSS Feed" href="/rss/news/" />' .
            '<link href="//static.bigprimes.net/css/css.css" rel="stylesheet" type="text/css" />' .
            '<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>' .
          '</head>' .
          '<body>' .
            '<header>'.
                '<a href="/" id="logolink">'.
                    '<svg height="60" width="38" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" '.
                    'x="0px" y="0px" viewBox="268 381 50 38" xml:space="preserve">'.
                        '<style type="text/css">'.
                            '.st0{fill:#71B291;} '.
                            '.st1{fill:#A4D3BB;} '.
                            '#igprimes{font-size:51px; vertical-align:top; font-family: monospace;} '.
                            '#logolink{font-size:8px; color:#000; text-decoration:none;}'.
                        '</style>'.
                        '<g>'.
                            '<g>'.
                                '<polygon class="st0" points="288.4,379 307.5,390.9 300.2,396.8 292.5,392.1 310.4,403.1 317.6,397.1" />'.
                                '<polygon class="st1" points="317.6,397.1 317.6,382.6 288.4,364.5 288.4,379" />'.
                                '<polygon class="st0" points="288.4,364.5 277.2,373.5 277.2,431.3 288.4,440.3 288.4,425.8 288.4,379" />'.
                                '<path class="st0" d="M310.4,403.1L310.4,403.1l-17.8-11c0,2.4,0,4.8,0,7.2c0,2.4,0,4.8,0,7.2l13.4,8.3l11.7-7.3L310.4,403.1z" />'.
                                '<polygon class="st1" points="305.9,414.9 305.9,414.9 288.4,425.8 288.4,440.3 317.6,422.2 317.6,407.6" />'.
                            '</g>'.
                        '</g>'.
                    '</svg>'.
                    '<span id="igprimes">igprimes</span>'.
                '</a>'.
            '</header>'.
            '<nav>'.
              '<br><br>'.
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
