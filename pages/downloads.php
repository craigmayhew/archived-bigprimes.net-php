<?php require_once("header.php");

$downloads_area_array[] = array(
	'title' => 'All 44 known Mersenne primes',
	'description' => 'This contains the first 44 Mersenne prime numbers.',
	'link' => '/pages/archive/mersenne/Mersenne Primes'
);
$downloads_area_array[] = array(
	'title' => 'All 12 factored Fermat numbers',
	'description' => 'This contains the first 12 Fermat numbers.',
	'link' => '/pages/archive/fermat/Fermat Numbers'
);
$downloads_area_array[] = array(
	'title' => 'All 44 known perfect numbers',
	'description' => 'This contains the first 44 perfect numbers.',
	'link' => '/pages/archive/perfect/Perfect Numbers'
);

function dl_file_size($file){
	$bytes = filesize($file);
	if ($bytes > 1000000){
		$size = round(($bytes/1000000),2).' Mb';
	}elseif ($bytes > 1000){
		$size = round(($bytes/1000),2).' Kb';
	}else{
		$size = $bytes.' b';
	}
	return $size;
}

echo
"<h1>Downloads</h1>".
"<table cellpadding=\"2\" cellspacing=\"0\" class=\"text table\" bgcolor=\"#e0faed\">".
 "<tr>".
  "<td width=\"200\">&nbsp;</td>".
  "<td width=\"200\">&nbsp;</td>".
  "<td width=\"70\">Zip</td>".
  "<td width=\"70\">Rar</td>".
 "</tr>";
 foreach ($downloads_area_array as $key => $value){
	 echo
	 '<tr>',
	  '<td align="left">',$value['title'],'</td>',
	  '<td align="left">',$value['description'],'</td>',
	  '<td style="white-space: nowrap;">';
	  $localLink = $_SERVER['DOCUMENT_ROOT'].$value['link'].'.zip';
	  if (file_exists($localLink)){
	  	echo
	  	'<a href="',$value['link'],'.zip',"\" class=\"link\"><img src=\"/imgs/file_types/zip_20.gif\" alt=\"\" />&nbsp;(".dl_file_size($localLink).")</a>";
	  }
	  echo
	  '</td>',
	  '<td style="white-space: nowrap;">';
	  $localLink = $_SERVER['DOCUMENT_ROOT'].$value['link'].'.rar';
	  if (file_exists($localLink)){
	  	echo
	  	'<a href="',$value['link'],'.rar',"\" class=\"link\"><img src=\"/imgs/file_types/rar_20.gif\" alt=\"\" />&nbsp;(".dl_file_size($localLink).")</a>";
	  }
	  echo
	  "</td>".
	 "</tr>";
 }
echo
'</table>',
'<br /><br />';

require_once('footer.php');?>