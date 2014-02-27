<?php
class rss{
    var $dateFormat = '%a, %d %b %Y %T';
    //Creat and output the xml for the rss feed.
    public function buildXML($rows=array(),$title='',$link='',$description='',$img=''){
        global $url;
        if(is_array($rows) && $title && $link){
            header ("content-type: text/xml");
            echo
            '<?xml version="1.0"?>
            <rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
            <channel>
                <title>',safeXML($title),'</title>
                <link>',safeXML($link),'</link>
                <description>',safeXML($description),'</description>
                <language>en-uk</language>
                <generator>Meeqi RSS Generator v1.0</generator>
                <lastBuildDate>',date('D, j M Y H:i:s'),' GMT</lastBuildDate>
                <atom:link href="',safeXML($url->u('this')),'" rel="self" type="application/rss+xml" />'."\r";
                if($img){
                    echo
                    '<image>
                        <url>',safeXML($img),'</url>
                        <title>',safeXML($title),'</title>
                        <link>',safeXML($link),'</link>
                    </image>';
                }
                foreach($rows as $row){
                    if($row['title']==''){
                        $row['title'] = substr(strip_tags($row['description']),0,35);
                    }
                    echo'
                    <item>
                        <title>',safeXML($row['title']),'</title>
                        <pubDate>',safeXML($row['date']),' GMT</pubDate>
                        <link>',safeXML($row['link']),'</link>
                        <guid>',safeXML($row['link']),'</guid>
                        <description>',safeXML($row['description']),'</description>
                        ',(isset($row['author'])&&$row['author']!=''?'<author>'.safeXML($row['author']).'</author>':''),'
                    </item>'."\r";
                }
            echo
            '</channel>
            </rss>';
        }
    }
}
?>
