<?php
date_default_timezone_set("Europe/London");

class builder{
  /*CONFIG START*/
  private $zipName = 'lambda';
  /*CONFIG END*/

  public function build(){
    exec('sudo yum update –y');
    exec('sudo yum install gcc gcc-c++ libxml2-devel');
    //#download php
    $php = file_get_contents('http://ie1.php.net/get/php-7.1.10.tar.xz/from/this/mirror');
    file_put_contents('~/php-7.1.10.tar.xz', $php);
    exec('tar xvfJ php-7.1.10.tar.xz');
    #compile php
    exec('mkdir ~/php-71-bin');
    exec('cd ~/php-7.1.10');
    exec('./configure --prefix=/home/ec2-user/php-71-bin/');
    exec('make install');
    #strip out files we dont need
    exec('rm php-71-bin/bin/phpdbg');
    #create the lambda package
    exec('cd ~');
    exec('tar -zcvf php-71-bin.tar.gz php-71-bin/');
    
      
    $zip = new ZipArchive();
    $filename = '../'.self::$zipname.'.zip';
    $zip->addFile('../php.js');
    $zip->addFile('../php-71-bin.tar.gz');
  }
}

//go build stuff!
$builder = new builder();
$builder->build();
