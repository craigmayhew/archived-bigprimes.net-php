<?php
class url{
	private $config;
	var $url = '';
	public function __construct($classes){
		$this->config = $classes['config'];
		//Add the url of the current page to the $url var.
        $this->url = isset($_SERVER['REQUEST_URI'])?$_SERVER['REQUEST_URI']:'';
        if(substr($this->url,0,1)=='/'){
            $this->url = substr($this->url,1);
        }
    }
    /**
    * generats generics links
    * 
    * @param array|string $vars Array of get vars. 'this' If you want to load the same page.
    * @param mixed $gateway The gateway file. defaults to index.
    */
    public function u($vars=array(),$gateway='index',$full=false){
        //Checks to se if the url should be the same as the current page.
        if($vars=='this'){
            //If it is then get the last page clicked on.
            $url = $this->url;
        }else{
            //Set the gateway page.
            if($gateway=='index'){
                $url = '';
            }else{
                $url = $gateway.'/';
            }
            //Loop through vars array and add them to the url.
            foreach($vars as $name=>$value){
                if($value){
                    if(!is_numeric($name)){
                        $url.= $name.'/'.$value.'/';
                    }else{
                        $url.= $value.'/';
                    }
                }
            }
        }
        //Return teh url.
        if($full){
            return $this->config['site']['url'].$url;
        }else{
            return '/'.$url;
        }
    }
    /**
    * Gets the link for the number cruncher
    * 
    * @param int $no The number to be crunched.
    * @param boolean $full add the full url to the front.
    * @return the cruncher url.
    */
    public function cruncher($no=0,$full=false){
        $no = (int)$no;
        if($no==0){
            $url = 'cruncher/';
        }else{
            $url = 'cruncher/'.$no.'/';
        }
        if($full){
            $url = $this->config['site']['url'].$url;
        }else{
            $url = '/'.$url;
        }
        return $url;
    }
    /**
    * Gets the links of a prime archive page.
    * 
    * @param mixed $no
    * @param mixed $full
    */
    public function primeArchive($no=0,$full=false){
        $no = (int)$no;
        if($no==0){
            $url = 'archive/prime/';
        }else{
            $url = 'archive/prime/'.$no.'/';
        }
        if($full){
            $url = $this->config['site']['url'].$url;
        }else{
            $url = '/'.$url;
        }
        return $url;
    }
    public function fibonacciArchive($no=0,$full=false){
        $no = (int)$no;
        if($no==0){
            $url = 'archive/fibonacci/';
        }else{
            $url = 'archive/fibonacci/'.$no.'/';
        }
        if($full){
            $url = $this->config['site']['url'].$url;
        }else{
            $url = '/'.$url;
        }
        return $url;
    }
}
?>
