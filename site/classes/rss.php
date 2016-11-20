<?php
class rss{
  private $dateFormat = '%a, %d %b %Y %T';
  function __construct(){
  }

  //used to make invalid xml into valid xml .. e.g. sanitize data from database
  private function safeXML($str){
    $search = array('&','<','>',"'",'"','<br>');
    $replace = array('&amp;','&lt;','&gt;','&#39;','&quot;','<br />');
    $str = str_replace($search,$replace,$str);
    return $str;
  }

  //Creat and output the xml for the rss feed.
  public function buildXML($rows=array(),$title='',$link='',$description='',$img=''){
    if(is_array($rows) && $title && $link){
      header ("content-type: text/xml");
      echo
      '<?xml version="1.0"?>
      <rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
      <channel>
        <title>',self::safeXML($title),'</title>
        <link>',self::safeXML($link),'</link>
        <description>',self::safeXML($description),'</description>
        <language>en-uk</language>
        <generator>BigPrimes.net RSS Generator v1.0</generator>
        <lastBuildDate>',date('D, j M Y H:i:s'),' GMT</lastBuildDate>
        <atom:link href="/" rel="self" type="application/rss+xml" />'."\r";
        if($img){
            echo
            '<image>
              <url>',self::safeXML($img),'</url>
              <title>',self::safeXML($title),'</title>
              <link>',self::safeXML($link),'</link>
            </image>';
        }
        foreach($rows as $row){
            if($row['title']==''){
                $row['title'] = substr(strip_tags($row['description']),0,35);
            }
            echo'
            <item>
                <title>',self::safeXML($row['title']),'</title>
                <pubDate>',self::safeXML($row['date']),' GMT</pubDate>
                <link>',self::safeXML($row['link']),'</link>
                <guid>',self::safeXML($row['link']),'</guid>
                <description>',self::safeXML($row['description']),'</description>
                ',(isset($row['author'])&&$row['author']!=''?'<author>'.self::safeXML($row['author']).'</author>':''),'
            </item>'."\r";
        }
        echo
      '</channel>
      </rss>';
    }
  }
}
