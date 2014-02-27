<?php

if(stristr($_SERVER['REQUEST_URI'],'archive/')){
	$fixer = '../';
}else{
	$fixer = '';
}

/*//compression script :)
if (strstr($HTTP_SERVER_VARS['HTTP_ACCEPT_ENCODING'], 'gzip')) {
	function compress_output($output){
		return gzencode($output,9);
	}
	ob_start('compress_output');
	header('Content-Encoding: gzip');
}*/
//end compression
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
'<html>',
'<head>';
/*
'<title>Big Primes: large prime & perfect number archive';
if ($_SERVER['PHP_SELF'] == '/archive.php'){
	if (isset($num)){
		if (substr($num,-1,1) == 1){
			echo " - ".$num."st prime";
		}elseif (substr($num,-1,1) == 2){
			echo " - ".$num."nd prime";
		}elseif (substr($num,-1,1) == 3){
			echo " - ".$num."rd prime";
		}else{
			echo " - ".$num."th prime";
		}
	}
}
echo
'</title>';
*/

//meta data!!
$title              = '';
$metaTagDescription = '';
$metaTagKeywords    = '';
if ($_SERVER['PHP_SELF'] == '/archive/prime.php'){
    $title              .= stndrd((int)$_REQUEST['num']).' to '.stndrd((int)($_REQUEST['num']+100)).' prime number';
    $metaTagDescription .= stndrd((int)$_REQUEST['num']).' to '.stndrd((int)($_REQUEST['num']+100)).' prime number';
    $metaTagKeywords    .= 'prime, primes, numbers, list';
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
    $title              = 'Big Primes: large prime & perfect number archive';
    $metaTagDescription = 'Home of the large primes archive and the number cruncher...';
    $metaTagKeywords    = 'prime, primes, perfect, fermat, numbers, list, number cruncher, archive';
}

?>
<title><?php echo $title;?></title>
<meta name="keywords" content="<?php echo $metaTagKeywords;?>">
<meta name="description" content="<?php echo $metaTagDescription;?>">
<link href="http://www.bigprimes.net/fonts.css" rel="stylesheet" type="text/css">
</head>
<body class="text">
<table cellpadding="0" cellspacing="0" border="0" width="100%" height="500" class="text">
 <tr>
  <td align="left" valign="top" colspan="2">
	<a href="http://www.bigprimes.net/index.php"><img src="http://www.bigprimes.net/title.gif" alt="BigPrimes.net"></a>
  </td>
 </tr>
 <tr>
  <td valign="top" width="160">
    <br>
	<table bgcolor="#e0faed" border="1" cellpadding="10" cellspacing="0" class="sidebarlink" width="160" bordercolor="#444444">
		<tr>
			<td valign="top">
				<a class="sidebarlink" href="<?php echo buildUrl(array('page'=>''))?>">Home</a><br>
                <?php
				//<a class="sidebarlink" href="/stats.php">Site Statistics</a><br>
				//<a class="sidebarlink" href="donate.php">Donate</a><br>
                ?>
				<a class="sidebarlink" href="/forum/">Forum</a><br>
				<a class="sidebarlink" href="<?php echo buildUrl(array('page'=>'links'))?>">Links</a><br>
				<a class="sidebarlink" href="<?php echo buildUrl(array('page'=>'contact_us'))?>">Contact Us</a><br>
			</td>
		</tr>
	</table>
		<br>
	<table bgcolor="#e0faed" border="1" cellpadding="10" cellspacing="0" class="sidebarlink" width="160" bordercolor="#444444">
		<tr>
			<td valign="top">
				<a class="sidebarlink" href="<?php echo buildUrl(array('page'=>'downloads'))?>">Downloads</a><br>
			</td>
		</tr>
	</table>
	    <br>
	<table bgcolor="#e0faed" border="1" cellpadding="10" cellspacing="0" class="sidebarlink" width="160" bordercolor="#444444">
		<tr>
			<td valign="top">
				<div align="center" class="sidebartitle">Crunchers</div><br>
				<a class="sidebarlink" href="<?php echo buildUrl(array('page'=>'cruncher'))?>">Number Cruncher</a><br>
				<a class="sidebarlink" href="<?php echo buildUrl(array('page'=>'primality_test'))?>">Primality Checker</a><br>
			</td>
		</tr>
	</table>
	    <br>
	<table bgcolor="#e0faed" border="1" cellpadding="10" cellspacing="0" class="sidebarlink" width="160" bordercolor="#444444">
		<tr>
			<td valign="top">
				<div align="center" class="sidebartitle">Archives</div><br>
				<a class="sidebarlink" href="<?php echo buildUrl(array('page'=>'archive/prime'))?>">Small Primes Archive</a><br>
				<a class="sidebarlink" href="<?php echo buildUrl(array('page'=>'biggest_primes'))?>">Largest Primes Archive</a><br>
				<a class="sidebarlink" href="<?php echo buildUrl(array('page'=>'archive/mersenne'))?>">Mersenne Prime Archive</a><br>
				<a class="sidebarlink" href="<?php echo buildUrl(array('page'=>'archive/fermat'))?>">Fermat Archive</a><br>
				<a class="sidebarlink" href="<?php echo buildUrl(array('page'=>'archive/perfect'))?>">Perfect Archive</a><br>
				<a class="sidebarlink" href="<?php echo buildUrl(array('page'=>'archive/fibonacci'))?>">Fibonacci Archive</a><br>
				<a class="sidebarlink" href="<?php echo buildUrl(array('page'=>'archive/archive_info'))?>">Other Archives</a><br>
			</td>
		</tr>
	</table>
	<br>
<script type="text/javascript"><!--
google_ad_client = "pub-9286138628337172";
google_alternate_color = "e0faed";
google_ad_width = 160;
google_ad_height = 600;
google_ad_format = "160x600_as";
google_ad_type = "text_image";
google_ad_channel ="2794112223";
google_color_border = "444444";
google_color_bg = "E0FAED";
google_color_link = "111111";
google_color_url = "777777";
google_color_text = "000000";
//--></script>
<script type="text/javascript"
  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
  </td>
  <td align="center" valign="top">