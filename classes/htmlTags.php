<?php
/**
 * Get tags and attributes from HTML strings
 */
class HTMLTags{
    /**
    * Returns an array of a paricluar tag, e.g. <img> from the specified html string
    * @param string $string HTML to be searched
    * @param string $tag To search for e.g. img
    * @return array Containing information about the location of the specified tags, e.g. $tags[] = array('string'=>tagString,'start'=>tagStartPosition,'end'=>tagEndPosition)
    */
    public function getTags($string='',$tag='img'){
        $string=strtolower($string);
        if($string!=''){
            $oriString = $string;
            //find next tag in string code
            $string = stristr($string,'<'.$tag);
            $safetyLimit = 10000;
            $i=0;
            $tags=array();
            while($string && $i<$safetyLimit){
                //find end of tag
                $tagEndPos = strpos($string,'>')+1;
                //get tag string
                $tagString = substr($string,0,$tagEndPos);
                //get tag start.
                $tagStartPos = strpos($oriString,$tagString);
                //Put tag information into array.
                $tags[] = array('string'=>$tagString,'start'=>$tagStartPos,'end'=>$tagStartPos+strlen($tagString));
                //gets the next tag from string
                $string = stristr(substr($string,1),'<'.$tag);
                $i++;
            }
        }else{
            $tags = array();
        }
        return $tags;
    }
    /**
    * Returns an array of attributes for the specified tag
    * @param string $tagString HTML string containing a single HTML tag
    * @return array Containing specified attributes
    */
    public function getAttributes($tagString=''){
        if($tagString!=''){
            //get rid of quotes.
            $tagString = str_replace('\'','',$tagString);
            $tagString = str_replace('"','',$tagString);
            //explodes string on space.
            $tagEx = explode(' ',$tagString);
            //loop throughs exploded tagstring
            foreach($tagEx as $tagBit){
                //Checks to see if tag bit has a = in it.
                if(stristr($tagBit,'=')){
                    //pulls attribute from string and puts it into array.
                    $tagBitEx = explode('=',$tagBit);
                    $attributes[$tagBitEx[0]] = $tagBitEx[1];
                }
            }
        }else{
            $attributes=array();
        }
        return $attributes;
    }
}
?>