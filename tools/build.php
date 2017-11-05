<?php
date_default_timezone_set("Europe/London");

class builder{
  /*CONFIG START*/
  private static $zipName = 'lambda';
  private static $workingdirectory = '/tmp';
  /*CONFIG END*/

  public function build(){
    $scriptPath = getcwd();
    
    if (file_exists(self::$workingdirectory.'/php-71-bin/bin/php')) {
      echo '**PHP already compiled to '.self::$workingdirectory.'/php-71-bin/**';
    } else {
      
      exec('sudo yum -y update');
      exec('sudo yum -y install gcc gcc-c++ libxml2-devel libmcrypt-devel');
      //#download php
      $phpVersionString = 'php-7.1.11';
      $php = file_get_contents('http://ie1.php.net/get/'.$phpVersionString.'.tar.xz/from/this/mirror');
      file_put_contents(self::$workingdirectory.'/'.$phpVersionString.'.tar.xz', $php);
      exec('cd '.self::$workingdirectory.' && tar xvfJ '.self::$workingdirectory.'/'.$phpVersionString.'.tar.xz');
      #compile php
      exec('mkdir -p '.self::$workingdirectory.'/php-71-bin');
      exec('cd '.self::$workingdirectory.'/'.$phpVersionString.' && ./configure --prefix='.self::$workingdirectory.'/php-71-bin/ --enable-bcmath --enable-mysqlnd --with-mysql-sock=/var/lib/mysql/mysql.sock --with-mysqli=mysqlnd --with-zlib-dir --with-pdo-mysql=mysqlnd');
      exec('cd '.self::$workingdirectory.'/'.$phpVersionString.' && make -j$((`cat /proc/cpuinfo | grep processor | wc -l` + 1)) install');
      #strip out files we dont need
      exec('cd '.self::$workingdirectory.' && rm php-71-bin/bin/phpdbg');
    }
    #create the lambda package
    //exec('cd '.self::$workingdirectory.' && tar -zcvf php-71-bin.tar.gz php-71-bin/');
    #compress into zip file for deploy to aws lambda 
    exec('cd '.self::$workingdirectory.' && zip -9 '.self::$workingdirectory.'/'.self::$zipName.'.zip -r php-71-bin');
    exec('cd '.$scriptPath.'/../ && zip -9 '.self::$workingdirectory.'/'.self::$zipName.'.zip php.ini php-71-bin/php.ini');
    exec('cd '.$scriptPath.'/../ && zip -9 '.self::$workingdirectory.'/'.self::$zipName.'.zip php.js htdocs/index-silex.php');
    exec('cd '.$scriptPath.'/../ && zip -9 '.self::$workingdirectory.'/'.self::$zipName.'.zip -r src');
    exec('cd '.$scriptPath.'/../ && zip -9 '.self::$workingdirectory.'/'.self::$zipName.'.zip -r vendor');
  }
}

//go build stuff!
$builder = new builder();
$builder->build();
