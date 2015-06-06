<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
$num = (int)$_REQUEST['num'];
//meta data!!
$title              = '';
$metaTagDescription = '';
$metaTagKeywords    = '';
if ($_SERVER['PHP_SELF'] == '/archive/prime.php'){
    $title              .= numbers::stndrd($num).' to '.numbers::stndrd($num+100).' prime number';
    $metaTagDescription .= numbers::stndrd($num).' to '.numbers::stndrd($num+100).' prime number';
    $metaTagKeywords    .= 'prime, primes, numbers, prime list';
}elseif ($_SERVER['PHP_SELF'] == '/lists/squarenumbers.php'){
    $title              .= 'Square numbers less than 10000';
    $metaTagDescription .= 'square numbers';
    $metaTagKeywords    .= 'square numbers';
}elseif (isset($_REQUEST['number']) && stristr($_SERVER['REQUEST_URI'],'cruncher')){
    $title .= (int)$_REQUEST['number'].' - '.numbers::convertNum((int)$_REQUEST['number']).' - Big Primes';
}elseif ($_SERVER['PHP_SELF'] == '/cruncher.php'){
    $number = (int)$_REQUEST['number'];
    if ($number == 0){
        $title              .= 'Number Cruncher';
        $metaTagDescription .= 'Check primality, have a number converted into other base systems';
        $metaTagKeywords    .= 'Number cruncher, primality, fermat';
    }else{
        $title              .= 'Number '.(int)$_REQUEST['number'].' - '.numbers::convertNum((int)$_REQUEST['number']);
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
<link rel="alternate" type="application/rss+xml" title="Big Primes RSS Feed" href="/rss/news/" />
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
				<a class="sidebarlink" href="/">Home</a><br />
                <a class="sidebarlink" href="/contactus/">Contact Us</a><br />
                                <a class="sidebarlink" href="/faq/">FAQ</a><br />
			</td>
		</tr>
	</table>
		<br />
	<table bgcolor="#e0faed" border="1" cellpadding="10" cellspacing="0" class="sidebarlink" width="160">
		<tr>
			<td valign="top">
                <a class="sidebarlink" href="/downloads/">Downloads</a><br />
				<a class="sidebarlink" href="/status/>">Status</a><br />
			</td>
		</tr>
	</table>
	    <br />
	<table bgcolor="#e0faed" border="1" cellpadding="10" cellspacing="0" class="sidebarlink" width="160">
		<tr>
			<td valign="top">
				<div align="center" class="sidebartitle">Crunchers</div><br />
				<a class="sidebarlink" href="/cruncher/">Number Cruncher</a><br />
				<a class="sidebarlink" href="/primalitytest/">Primality Checker</a><br />
			</td>
		</tr>
	</table>
	    <br />
	<table bgcolor="#e0faed" border="1" cellpadding="10" cellspacing="0" class="sidebarlink" width="160">
		<tr>
			<td valign="top">
				<div align="center" class="sidebartitle">Archives</div><br />
				<a class="sidebarlink" href="/archive/prime/>">Prime Numbers Archive</a><br />
				<a class="sidebarlink" href="/archive/mersenne/">Mersenne Prime Archive</a><br />
				<a class="sidebarlink" href="/archive/fermat/">Fermat Archive</a><br />
				<a class="sidebarlink" href="/archive/perfect/">Perfect Archive</a><br />
				<a class="sidebarlink" href="/archive/fibonacci/">Fibonacci Archive</a><br />
				<a class="sidebarlink" href="/archiveinfo/">Other Archives</a><br />
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
