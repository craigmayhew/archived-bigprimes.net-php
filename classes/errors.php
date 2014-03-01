<?php
/**
 * The errors class is used to catch php or database query errors.
 * It can display a complete backtrace, alert site admin, add a log entry
 */
class errors{
    /**
    * $debug Flag
    * @var bool
    */
    var $debug = false;
    /**
    * 
    * @var int
    */
    var $errno = '';
    /**
    * Error Message
    * @var string
    */
    var $errstr = '';
    /**
    * Filename where the error occured
    * @var string
    */
    var $errfile = '';
    /**
    * Line number of the error
    * @var int
    */
    var $errline = '';
    /**
    * 
    * @var string
    */
    var $errcontext = '';
    /**
    * Error Message
    * @var string
    */
    var $errMessage = '';
    /**
    * Data dump
    * @var string
    */
    var $errVarDumps = '';
    /**
    * Error id that corresponds to database table row number
    * @var string
    */
    var $errId = 0;
    var $mailOnce = true;
    /**
    * Sets up php error handling and debug level.
    * @param bool $debug Flag 
    * @return NULL
    */
    public function __construct($classes,$debug=false){
      $this->config = $classes['config'];
      $this->database = $classes['database'];
        //Set delbug level.
        $this->debug = $debug;
        //Take over php error handerling.
        set_error_handler(array($this,'callError'));
        if(isset($config['errors']['mailOnce'])){
            $this->mailOnce = (boolean)$config['errors']['mailOnce'];
        }
    }
    /**
    * Get errors and format for database entry
    * @param string $errno 
    * @param string $errstr The error message
    * @param string $errfile The file the error occured in
    * @param string $errline The line number the error occured on
    * @param string $errcontext 
    * @return NULL
    */
    public function callError($errno,$errstr,$errfile,$errline,$errcontext){
        //If the error is not on a level of error loggin dont do anything.
        if (($errno & error_reporting())){
            //Formating of error message.
            $message = 'PHP Error %s: %s in %s at line %s';
            $message = sprintf($message,$errno,$errstr,$errfile,$errline,$errcontext);
            //Sets all error var for use in other functions.
            $this->errno = $errno;
            $this->errstr = $errstr;
            $this->errfile = $errfile;
            $this->errline = $errline;
            $this->errcontext = $errcontext;
            $this->errMessage = $message;
            //If debug is set to true prints debug information in the source.
            $this->errVarDumps=
            'File: '.print_r($errfile,true)."\r\n".
            'Line: '.print_r($errline,true)."\r\n".
            'Message: '.print_r($errstr,true)."\r\n".
            'Context: '.print_r($errcontext,true)."\r\n".
            'Backtrace: '.print_r(debug_backtrace(),true);
            //Add the error to database.
            $this->errId = $this->addErrorToDatabase();
            //Error debug out put
            $errors=array();
            $files = array();
            $bt = debug_backtrace();
            $error = isset($bt[2])?$bt[2]:'';
            $out= 
            '<div id="errorTableContainer">'.
                '<h1>Error: PHP Error</h1>'
                .$errstr
                .'<br /><br />'
                //.'Error Reference: '.$log_id.'<br />'
                .'Error Number: '.$errno.'<br />'
                .'File: '.$errfile.'<br />'
                .'Line: '.$errline.'<br /><br />'.
                '<table id="errorTable" cellpadding="2" cellspacing="0" border="1" style="border:solid 1px #333333; border-colapse: colapse;">'
                .'<tr>'
                    .'<td style="border:solid 1px #333333;"><b>Source</b></td>'
                    .'<td style="border:solid 1px #333333;"><b>Actual Values</b></td>'.
                '</tr>';
                unset($bt[0]);
                foreach($bt as $error)
                {   if(!isset($files[$error['file']]))
                    {    $files[$error['file']] = file($error["file"]);
                    }
                    $code = $files[$error['file']][($error['line']-1)];
                    $out .=
                        '<tr>'
                            .'<td colspan=2 style="border:solid 1px #333333; background-color: #EFEFEF;" nowrap="nowrap">'
                                .'File: '.$error['file'].'&nbsp;Line: '.$error['line']
                            .'</td>'
                        .'</tr>'
                        .'<tr>'
                            .'<td style="border:solid 1px #333333; padding-right:10px;" nowrap="nowrap">'
                                .$this->phpHighlight(trim($code,"\n\t "))
                            .'</td>'
                            .'<td style="border:solid 1px #333333; padding-right:10px;" nowrap="nowrap">'
                                .$this->phpHighlight($error["function"].'('.print_r($error["args"],1)).')&nbsp;'
                            .'</td>'
                        .'</tr>';
                }
                $out .=
                '</table>'
            .'</div>';
            if($this->debug){
                echo
                $out
                .'<br /><br /><br />'
                .'To return to the previous page click <a href="'.(isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'').'">here</a>.';
                //Mail error to admin.
                $this->mailError($out,$this->errId[1]);
                exit(1);
            }else{
                //Mail error to admin.
                $this->mailError($out,$this->errId[1]);
                //If debug is set to false just guve generic error message..
                /*echo 
                '<script type="text/javascript">
                    <!--
                        window.location = "',buildUrl(array('page'=>'error','errorCode'=>$this->errId)),'"
                    //-->
                </script>';*/
            }
        }
    }
    /**
    * Highlight and colours the php $source code
    * @param string $source The code to be highlighted
    * @param string $classes
    * @return NULL
    */
    private function phpHighlight($source, $classes = false){
      if (version_compare( phpversion(), "5.0.0", "<")) return "PHP 5 required";

      $r1 = $r2 = '##';

      // adds required PHP tags (with version 5.0.5 this is required)
      if ( strpos($source,' ?>') === false )
      {
       $source = "<?php ".$source." ?>";
       $r1 = '#&lt;\?.*?(php)?.*?&nbsp;#s';
       $r2 = '#\?&gt;#s';
      }
      //replace short php tags with long tags
      elseif (strpos($source,'<? ') !== false)
      {
       $r1 = '--';
       $source = str_replace('<? ','<?php ',$source);
      }
      
      //use phps default source highlighter
      $source = highlight_string($source,true);
      
      //
      if ($r1 =='--'){
            //find "<?php" 
            $source = preg_replace('#(&lt;\?.*?)(php)?(.*?&nbsp;)#s','\\1\\3',$source);
      }
      
      $source = preg_replace (array ( '/.*<code>\s*<span style="color: #000000">/',  //
                                     '#</span>\s*</code>#',                          //  <code><span black>
                                     $r1, $r2,                // php tags
                                     '/<span[^>]*><\/span>/'  // empty spans
                                   ),'',$source);

      if ($classes) $source = str_replace( array('style="color: #0000BB"','style="color: #007700"',
                                             'style="color: #DD0000"','style="color: #FF8000"'),
                                       array('class="phpdefault"','class="phpkeyword"',
                                             'class="phpstring"','class="phpcomment"',),$source);

      return $source;
    }
    /**
    * Add error to database error log
    * @return int Database table row id
    */
    private function addErrorToDatabase(){
        $backtraceSerialized    = serialize(debug_backtrace());
        $backtraceSHA           = sha1($backtraceSerialized);
        $errorMessageSHA        = sha1($this->errMessage);
        $url                    = isset($_SERVER['REQUEST_URI'])?$_SERVER['REQUEST_URI']:'';
        $urlSHA                 = sha1($url);
        
        //Check to see if the error message has occured in the database already...
        $c = $this->database->count('errorLogMessage','sha="'.$errorMessageSHA.'"');
        if ($c == 0){//add the message to the message lookup table if its not already in there
            $this->database->insert('errorLogMessage',array('message','sha'),array($this->errMessage,$errorMessageSHA));
            $messageId = $this->database->lastId;
        }else{
            $messageId = $this->database->fetchRow('errorLogMessage',array('id'),'sha="'.$errorMessageSHA.'"');
        }
        //Check to see if the error backtrace has occured in the database already...
        $c = $this->database->count('errorLogBacktrace','sha="'.$backtraceSHA.'"');
        if ($c == 0){//add the backtrace to the backtrace lookup table if its not already in there
            $this->database->insert('errorLogBacktrace',array('backtrace','sha'),array($backtraceSerialized,$backtraceSHA));
            $backtraceId = $this->database->lastId;
        }else{
            $backtraceId = $this->database->fetchRow('errorLogBacktrace',array('id'),'sha="'.$backtraceSHA.'"');
        }
        //Check to see if the url has occured in the database already...
        $c = $this->database->count('errorLogUrl','sha="'.$urlSHA.'"');
        if ($c == 0){//add the backtrace to the backtrace lookup table if its not already in there
            $this->database->insert('errorLogUrl',array('url','sha'),array($url,$urlSHA));
            $urlId = $this->database->lastId;
        }else{
            $urlId = $this->database->fetchRow('errorLogUrl',array('id'),'sha="'.$urlSHA.'"');
        }
        
        //add the error to the errorLog table
        $this->database->insert('errorLog',array('messageId','backtraceId','ip','url'),array($messageId,$backtraceId,$_SERVER['REMOTE_ADDR'],$urlId));
        $unqueErrorCode = $this->database->lastId;
        return array($unqueErrorCode,$messageId);
    }
    /**
    * Mails the error information to the admin email address.
    * @return 
    */
    private function mailError($message,$messageId){
        $c = $this->database->count('errorLogMessage',"id=$messageId AND DATE_SUB(CURRENT_TIMESTAMP,INTERVAL 1 HOUR)>lastEmailed");
        if($this->mailOnce==false){
            $c=1;
        }
        if($c){
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            //Send mail
            $emails = array('primes@bigprimes.net');
            foreach($emails as $email){
                mail($email,'Error(ID:'.$this->errId.') on '.$config['site']['name'],$message,$headers);
            }
            $this->database->update(array('lastEmailed'=>'CURRENT_TIMESTAMP'),'errorLogMessage',"id=$messageId");
        }
        
    }
    /**
    * Creates all the tables needed for the error logging.
    * @return bool True on success
    */
    public function install(){
        //Querys for creating the tables.
        $tables=array(//errorLog table
                          'errorLog'=>"CREATE TABLE IF NOT EXISTS `errorLog` (
                                      `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                                      `messageId` bigint(20) unsigned NOT NULL DEFAULT '0',
                                      `backtraceId` bigint(20) unsigned NOT NULL DEFAULT '0',
                                      `ip` char(39) NOT NULL DEFAULT '',
                                      `url` bigint(20) unsigned NOT NULL DEFAULT '0',
                                      `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                      PRIMARY KEY (`id`),
                                      KEY `timestamp` (`timestamp`),
                                      KEY `bactraceId` (`backtraceId`),
                                      KEY `ip` (`ip`),
                                      KEY `errorId` (`messageId`),
                                      KEY `url` (`url`)
                                    ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1299 ;",
                          //errorLogBacktrace table.
                          'errorLogBacktrace'=>"CREATE TABLE IF NOT EXISTS `errorLogBacktrace` (
                                                  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                                                  `backtrace` mediumtext NOT NULL,
                                                  `sha` varchar(40) NOT NULL DEFAULT '' COMMENT 'SHA-1 of Backtrace',
                                                  `firstRecorded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                                  PRIMARY KEY (`id`),
                                                  UNIQUE KEY `sha` (`sha`)
                                                ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=719 ;",
                          //errorLogMessage table                    
                          'errorLogMessage'=>"CREATE TABLE IF NOT EXISTS `errorLogMessage` (
                                                  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                                                  `message` mediumtext NOT NULL,
                                                  `sha` varchar(40) NOT NULL DEFAULT '' COMMENT 'SHA-1 of Message',
                                                  `firstRecorded` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                                                  PRIMARY KEY (`id`),
                                                  UNIQUE KEY `sha` (`sha`),
                                                  KEY `timestamp` (`firstRecorded`)
                                                ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=323 ;",
                          //errorLogUrl table
                          'errorLogUrl'=>"CREATE TABLE IF NOT EXISTS `errorLogUrl` (
                                              `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                                              `url` longtext NOT NULL,
                                              `sha` varchar(40) NOT NULL DEFAULT '' COMMENT 'SHA-1 of URL',
                                              `firstRecorded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                              PRIMARY KEY (`id`),
                                              UNIQUE KEY `sha` (`sha`)
                                            ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=147 ;");
        //Adds tables if they do not already exists
        foreach($tables as $table=>$sql){
            if(!$this->database->tableExists($table)){
                $this->database->createTable($sql);
            }
        }
        return true;
    }
}
?>
