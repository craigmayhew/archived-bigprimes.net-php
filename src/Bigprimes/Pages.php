<?php
namespace Bigprimes;

class Pages{
  protected $app;
  function __construct($app){
    $this->app = $app;
  }
 
  // add st nd rd th to a number
protected function stndrd($n)
{
    switch ($n) {
        case 1:
          return $n.'st';
        case 2:
          return $n.'nd';
        case 3:
          return $n.'rd';
        case 11:
        case 12:
        case 13:
          return $n.'th';
        default:
          $substr = substr($n,(strlen($n)-1),1);
          switch ($substr) {
            case 1:
              return $n.'st';
            case 2:
              return $n.'nd';
            case 3:
              return $n.'rd';
            default:
              return $n.'th';
          }
          break;
    }
}


  public function getHeader($title, $metaTagDescription, $metaTagKeywords){
        //meta data
/*        $title              = '';
        $metaTagDescription = '';
        $metaTagKeywords    = '';
        if ($_SERVER['PHP_SELF'] == '/archive/prime.php'){
            $title              .= stndrd((int)$_REQUEST['num']).' to '.stndrd((int)($_REQUEST['num']+100)).' prime number';
            $metaTagDescription .= stndrd((int)$_REQUEST['num']).' to '.stndrd((int)($_REQUEST['num']+100)).' prime number';
            $metaTagKeywords    .= 'prime, primes, numbers, prime list';
        }elseif ($_SERVER['PHP_SELF'] == '/lists/squarenumbers.php'){
            $title              .= 'Square numbers less than 10000';
            $metaTagDescription .= 'square numbers';
            $metaTagKeywords    .= 'square numbers';
        }elseif (isset($_REQUEST['number']) && stristr($_SERVER['REQUEST_URI'],'cruncher')){
            $title .= (int)$_REQUEST['number'].' - '.convertNum((int)$_REQUEST['number'], $ones, $tens, $triplets).' - Big Primes';
        }elseif ($_SERVER['PHP_SELF'] == '/cruncher.php'){
            $number = (int)$_REQUEST['number'];
            if ($number == 0){
                $title              .= 'Number Cruncher';
                $metaTagDescription .= 'Check primality, have a number converted into other base systems';
                $metaTagKeywords    .= 'Number cruncher, primality, fermat';
            }else{
               $title              .= 'Number '.(int)$_REQUEST['number'].' - '.convertNum((int)$_REQUEST['number']);
               $metaTagDescription .= 'All about number '.(int)$_REQUEST['number'];
               $metaTagKeywords    .= (int)$_REQUEST['number'];
            }
        }else{
            $title              = 'Big Primes: large list of prime numbers';
            $metaTagDescription = 'Home of the large primes numbers archive and the number cruncher...';
            $metaTagKeywords    = 'prime, primes, perfect, fermat, numbers, number cruncher, archive';
        }
*/
    return 
    '<html xmlns="http://www.w3.org/1999/xhtml">'.
      '<head>'.
        '<title>'.$title.'</title>'.
        '<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />'.
        '<meta name="keywords" content="'.$metaTagKeywords.'" />'.
        '<meta name="description" content="'.$metaTagDescription.'" />'.
        '<link rel="alternate" type="application/rss+xml" title="Big Primes RSS Feed" href="/rss/news/" />'.
        '<link href="//static.bigprimes.net/css/css.css" rel="stylesheet" type="text/css" />'.
        '<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>'.
      '</head>'.
      '<body class="text">'.



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
  public function getFooter(){
    return
            '</td>'.
          '</tr>'.
        '</table>'.
        '<div align="center"><br /><br /><a href="http://www.adire.co.uk/" class="sidebarlink">Hosted by the Adire Cloud Engine</a></div>'.
      '</body>'.
    '</html>';
  }
}
