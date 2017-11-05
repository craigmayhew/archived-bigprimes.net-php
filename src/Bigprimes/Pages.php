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
            '<html xmlns="http://www.w3.org/1999/xhtml">' .
            '<head>' .
            '<title>' . $title . '</title>' .
            '<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />' .
            '<meta name="keywords" content="' . $metaTagKeywords . '" />' .
            '<meta name="description" content="' . $metaTagDescription . '" />' .
            '<link rel="alternate" type="application/rss+xml" title="Big Primes RSS Feed" href="/rss/news/" />' .
            '<link href="//static.bigprimes.net/css/css.css" rel="stylesheet" type="text/css" />' .
            '<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>' .
            '</head>' .
            '<body class="text">' .


            '<table cellpadding="0" cellspacing="0" border="0" width="100%" class="text">
 <tr>
  <td align="left" valign="top" colspan="2">
        <a href="/index.php"><img src="//static.bigprimes.net/imgs/title.gif" alt="BigPrimes.net" /></a>
  </td>
 </tr>
 <tr>
  <td valign="top" width="160">
    <br />
        <table bgcolor="#e0faed" border="1" cellpadding="10" cellspacing="0" class="sidebarlink" width="180">
                <tr>
                        <td valign="top">
                                <a class="sidebarlink" href="/">Home</a><br />
                                <a class="sidebarlink" href="/contactus/">Contact Us</a><br />
                                <a class="sidebarlink" href="/faq/">FAQ</a><br />
                        </td>
                </tr>
        </table>
                <br />
        <table bgcolor="#e0faed" border="1" cellpadding="10" cellspacing="0" class="sidebarlink" width="180">
                <tr>
                        <td valign="top">
                <a class="sidebarlink" href="/downloads/">Downloads</a><br />
                                <a class="sidebarlink" href="/status/">Status</a><br />
                        </td>
                </tr>
        </table>
            <br />
        <table bgcolor="#e0faed" border="1" cellpadding="10" cellspacing="0" class="sidebarlink" width="180">
                <tr>
                        <td valign="top">
                                <div align="center" class="sidebartitle">Crunchers</div><br />
                                <a class="sidebarlink" href="/cruncher/">Number Cruncher</a><br />
                                <a class="sidebarlink" href="/primalitytest/">Primality Checker</a><br />
                        </td>
                </tr>
        </table>
            <br />
        <table bgcolor="#e0faed" border="1" cellpadding="10" cellspacing="0" class="sidebarlink" width="180">
                <tr>
                        <td valign="top">
                                <div align="center" class="sidebartitle">Archives</div><br />
                                <a class="sidebarlink" href="/archive/prime/">Prime Numbers Archive</a><br />
                                <a class="sidebarlink" href="/archive/mersenne/">Mersenne Prime Archive</a><br />
                                <a class="sidebarlink" href="/archive/fermat/">Fermat Archive</a><br />
                                <a class="sidebarlink" href="/archive/perfect/">Perfect Archive</a><br />
                                <a class="sidebarlink" href="/archive/fibonacci/">Fibonacci Archive</a><br />
                        </td>
                </tr>
        </table>
  </td>
  <td align="center" valign="top">
';


    }

    public function getFooter()
    {
        return
            '</td>' .
            '</tr>' .
            '</table>' .
            '<div align="center"><br /><br /><a href="https://www.adire.co.uk/" class="sidebarlink">Hosted by Adire</a></div>' .
            '</body>' .
            '</html>';
    }
}
