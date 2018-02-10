<?php
date_default_timezone_set("Europe/London");

class builder{
  /*CONFIG START*/
  private static $zipName = 'lambda';
  private static $workingdirectory = '/tmp';
  /*CONFIG END*/

  public function build(){
    $scriptPath = getcwd();
    
    if (file_exists(self::$workingdirectory.'/php-72-bin/bin/php')) {
      echo '**PHP already compiled to '.self::$workingdirectory.'/php-72-bin/**';
    } else {
      
      exec('sudo yum -y update');
      exec('sudo yum -y install gcc gcc-c++ libxml2-devel libmcrypt-devel re2c bison php-pear');
      exec('sudo pear install channel://pear.php.net/PHP_ARCHIVE-0.12.0');
      //#download php
      $phpVersionString = 'php-7.2.2';
      $php = file_get_contents('http://ie1.php.net/get/'.$phpVersionString.'.tar.xz/from/this/mirror');
      file_put_contents(self::$workingdirectory.'/'.$phpVersionString.'.tar.xz', $php);
      exec('cd '.self::$workingdirectory.' && tar xvfJ '.self::$workingdirectory.'/'.$phpVersionString.'.tar.xz');
      #compile php
      exec('mkdir -p '.self::$workingdirectory.'/php-72-bin');
      exec('cd '.self::$workingdirectory.'/'.$phpVersionString.' && ./configure --prefix='.self::$workingdirectory.'/php-72-bin/ --enable-bcmath --enable-mysqlnd --with-mysql-sock=/var/lib/mysql/mysql.sock --with-mysqli=mysqlnd --with-zlib-dir --with-pdo-mysql=mysqlnd');
      exec('cd '.self::$workingdirectory.'/'.$phpVersionString.' && make -j$((`cat /proc/cpuinfo | grep processor | wc -l` + 1)) install');
      #strip out files we dont need
      exec('cd '.self::$workingdirectory.' && rm php-72-bin/bin/phpdbg');
    }
    #create the lambda package
    //exec('cd '.self::$workingdirectory.' && tar -zcvf php-72-bin.tar.gz php-72-bin/');
    #compress into zip file for deploy to aws lambda 
    if (file_exists(self::$workingdirectory.'/'.self::$zipName.'.zip')){
      exec('rm '.self::$workingdirectory.'/'.self::$zipName.'.zip');
    }
    exec('cd '.self::$workingdirectory.' && zip -9 '.self::$workingdirectory.'/'.self::$zipName.'.zip -r php-72-bin');
    exec('cd '.$scriptPath.'/../ && zip -9 '.self::$workingdirectory.'/'.self::$zipName.'.zip php.ini php-72-bin/php.ini');
    exec('cd '.$scriptPath.'/../ && zip -9 '.self::$workingdirectory.'/'.self::$zipName.'.zip php.js htdocs/index-silex.php');
    exec('cd '.$scriptPath.'/../ && zip -9 '.self::$workingdirectory.'/'.self::$zipName.'.zip -r src');
    exec('cd '.$scriptPath.'/../ && zip -9 '.self::$workingdirectory.'/'.self::$zipName.'.zip -r vendor');
  }
}

//go build stuff!
$builder = new builder();
$builder->build();
