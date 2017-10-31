<?php
date_default_timezone_set("Europe/London");

class builder{
  /*CONFIG START*/
  private static $zipName = 'lambda';
  private static $workingdirectory = '/tmp';
  /*CONFIG END*/

  public function build(){
    $scriptPath = getcwd();

    exec('sudo yum -y update');
    exec('sudo yum -y install gcc gcc-c++ libxml2-devel');
    //#download php
    $php = file_get_contents('http://ie1.php.net/get/php-7.1.10.tar.xz/from/this/mirror');
    file_put_contents(self::$workingdirectory.'/php-7.1.10.tar.xz', $php);
    exec('cd '.self::$workingdirectory.' && tar xvfJ '.self::$workingdirectory.'/php-7.1.10.tar.xz');
    #compile php
    exec('mkdir -p '.self::$workingdirectory.'/php-71-bin');
    exec('cd '.self::$workingdirectory.'/php-7.1.10 && ./configure --prefix='.self::$workingdirectory.'/php-71-bin/ --enable-bcmath --with-mysqli=/usr/bin/mysql_config --with-mcrypt');
    exec('cd '.self::$workingdirectory.'/php-7.1.10 && make -j$((`cat /proc/cpuinfo | grep processor | wc -l` + 1)) install');
    #strip out files we dont need
    exec('cd '.self::$workingdirectory.' && rm php-71-bin/bin/phpdbg');
    #create the lambda package
    //exec('cd '.self::$workingdirectory.' && tar -zcvf php-71-bin.tar.gz php-71-bin/');
    #compress into zip file for deploy to aws lambda 
    exec('cd '.self::$workingdirectory.' && zip -9 '.self::$workingdirectory.'/'.self::$zipName.'.zip -r php-71-bin');
    exec('cd '.$scriptPath.'/../ && zip -9 '.self::$workingdirectory.'/'.self::$zipName.'.zip php.js htdocs/index-silex.php');
    exec('cd '.$scriptPath.'/../ && zip -9 '.self::$workingdirectory.'/'.self::$zipName.'.zip -r src');
    exec('cd '.$scriptPath.'/../ && zip -9 '.self::$workingdirectory.'/'.self::$zipName.'.zip -r vendor');
  }
}

//go build stuff!
$builder = new builder();
$builder->build();
