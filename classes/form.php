<?php
/**
 * Renders forms
 */
class form{
    /**
    * Returns the HTML for a dropdown menu
    * @param string $name Name attribute of the <select> tag
    * @param array $array The available options on the <select>
    * @param string $currently Currently selected value
    * @param string $extras Additional HTML to be put after the name attribute
    * @return string HTML for the entire <select> tag
    */
	public function dropdown($name,$array,$currently = '',$extras = ''){
		if($extras != ''){
			$string = '<select name="'.$name.'"'.$extras.'>';
		}else{
			$string = '<select name="'.$name.'">';
		}
		$count = count($array);
		if (is_array($array[0])){
			for ($i=0;$i<$count;$i++){
				if ($array[$i][0] == $currently){
					$string .= '<option value="'.$array[$i][0].'" selected>'.$array[$i][1].'</option>';
				}else{
					$string .= '<option value="'.$array[$i][0].'">'.$array[$i][1].'</option>';
				}
			}
		}else{
			for ($i=0;$i<$count;$i++){
				if ($array[$i] == $currently){
					$string .= '<option value="'.$array[$i].'" selected>'.$array[$i].'</option>';
				}else{
					$string .= '<option value="'.$array[$i].'">'.$array[$i].'</option>';
				}
			}
		}
		$string .= '</select>';
		return $string;
	}
    /**
    * Returns the HTML for a radio button
    * @param string $name Name attribute of the <input> tag
    * @param array $aOptions The available radio options
    * @param string $currently Currently selected value
    * @return string HTML for the radio buttons
    */
    public function radio($name,$aOptions,$currently = ''){
        $string = '';
        foreach($aOptions as $option){
            if(is_array($aOptions) == true){
                if($option[0] == $currently){
                    $string .= '<input type="radio" name="'.$name.'" value="'.$option[0].'" checked />'.$option[1];
                }else{
                    $string .= '<input type="radio" name="'.$name.'" value="'.$option[0].'" />'.$option[1];
                }
            }else{
                if($option[0] == $currently){
                    $string .= '<input type="radio" name="'.$name.'" value="'.$option.'" checked />'.$option;
                }else{
                    $string .= '<input type="radio" name="'.$name.'" value="'.$option.'" />'.$option;
                }
            }
        }
        return $string;
    }
    /**
    * Returns the HTML for a tickbox
    * @param string $name Name attribute of the <input> tag
    * @param string $text Text to go right of the tickbox
    * @param mixed $value If the tickbox is currently ticked. e.g. 1, 0 or 'on'
    * @param string $extras Additional HTML to be put after the name attribute
    * @return string HTML for the entire <input> tickbox tag
    */
    public function tickBox($name,$text,$value=0,$extras=''){
        $tickBox =
        '<input type="checkbox" name="'.$name.'"';
        $tickBox .=($extras!=''?' '.$extras:'').(($value==1 || $value==='on' || $value===true)?' checked':'').' /> '.($text!=''?'<span class="curser" onclick="tickBox(\''.$name.'\')">'.$text.'</span>':'');        
        return $tickBox;
    }
	
}

?>