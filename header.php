<?php

//to prevent being run directly without index.php
if(!isset($url)){
  exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php

if(isset($_SERVER['REQUEST_URI']) && stristr($_SERVER['REQUEST_URI'],'archive/')){
	$fixer = '../';
}else{
	$fixer = '';
}

function th($n){
	$sub = substr($n,-1);
	if ($n < 4){
		if($n == 1){
			return $n.'st';
		}elseif($n == 2){
			return $n.'nd';
		}elseif($n == 3){
			return $n.'rd';
		}
	}elseif($n < 20){
		return $n.'th';
	}else{
		if($sub == 1){
			return $n.'st';
		}elseif($sub == 2){
			return $n.'nd';
		}elseif($sub == 3){
			return $n.'rd';
		}else{
			return $n.'th';
		}
	}
}
echo
'<head>';

//meta data!!
$title              = '';
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
    $title .= (int)$_REQUEST['number'].' - '.convertNum((int)$_REQUEST['number']).' - Big Primes';
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

?>
<title><?php echo $title;?></title>
<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />
<link rel="alternate" type="application/rss+xml" title="Big Primes RSS Feed" href="<?php echo $url->u(array('rss','news'))?>" />
<meta name="keywords" content="<?php echo $metaTagKeywords;?>" />
<meta name="description" content="<?php echo $metaTagDescription;?>" />
<link href="/css/css.css" rel="stylesheet" type="text/css" />
</head>
<body class="text">
<table cellpadding="0" cellspacing="0" border="0" width="100%" class="text">
 <tr>
  <td align="left" valign="top" colspan="2">
	<a href="/index.php"><img src="/imgs/title.gif" alt="BigPrimes.net" /></a>
  </td>
 </tr>
 <tr>
  <td valign="top" width="160">
    <br />
	<table bgcolor="#e0faed" border="1" cellpadding="10" cellspacing="0" class="sidebarlink" width="160">
		<tr>
			<td valign="top">
				<a class="sidebarlink" href="<?php echo $url->u()?>">Home</a><br />
                <a class="sidebarlink" href="<?php echo $url->u(array('contactus'))?>">Contact Us</a><br />
                                <a class="sidebarlink" href="<?php echo $url->u(array('faq'))?>">FAQ</a><br />
			</td>
		</tr>
	</table>
		<br />
	<table bgcolor="#e0faed" border="1" cellpadding="10" cellspacing="0" class="sidebarlink" width="160">
		<tr>
			<td valign="top">
                <a class="sidebarlink" href="<?php echo $url->u(array('downloads'))?>">Downloads</a><br />
				<a class="sidebarlink" href="<?php echo $url->u(array('status'))?>">Status</a><br />
			</td>
		</tr>
	</table>
	    <br />
	<table bgcolor="#e0faed" border="1" cellpadding="10" cellspacing="0" class="sidebarlink" width="160">
		<tr>
			<td valign="top">
				<div align="center" class="sidebartitle">Crunchers</div><br />
				<a class="sidebarlink" href="<?php echo $url->cruncher()?>">Number Cruncher</a><br />
				<a class="sidebarlink" href="<?php echo $url->u(array('primality_test'))?>">Primality Checker</a><br />
			</td>
		</tr>
	</table>
	    <br />
	<table bgcolor="#e0faed" border="1" cellpadding="10" cellspacing="0" class="sidebarlink" width="160">
		<tr>
			<td valign="top">
				<div align="center" class="sidebartitle">Archives</div><br />
				<a class="sidebarlink" href="<?php echo $url->u(array('archive/prime'))?>">Prime Numbers Archive</a><br />
				<a class="sidebarlink" href="<?php echo $url->u(array('archive/mersenne'))?>">Mersenne Prime Archive</a><br />
				<a class="sidebarlink" href="<?php echo $url->u(array('archive/fermat'))?>">Fermat Archive</a><br />
				<a class="sidebarlink" href="<?php echo $url->u(array('archive/perfect'))?>">Perfect Archive</a><br />
				<a class="sidebarlink" href="<?php echo $url->u(array('archive/fibonacci'))?>">Fibonacci Archive</a><br />
				<a class="sidebarlink" href="<?php echo $url->u(array('archiveinfo'))?>">Other Archives</a><br />
			</td>
		</tr>
	</table>
    <div align="center" style="padding-top: 10px;padding-bottom: 10px;">
    <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
    <input type="hidden" name="business" value="admin@adire.co.uk">
    <input type="hidden" name="cmd" value="_donations">
    <input type="hidden" name="item_name" value="Big Primes Donation"> 
    <input type="hidden" name="item_number" value="Big Primes Donation">
    <input type="hidden" name="currency_code" value="GBP">
    <input type="image" name="submit" border="0" src="https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" alt="PayPal - The safer, easier way to pay online">
    <img alt="Make donation" border="0" width="1" height="1" src="https://www.paypal.com/en_US/i/scr/pixel.gif" >
    </form>
  </td>
  <td align="center" valign="top">
