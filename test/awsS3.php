<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../src/Bigprimes/awsS3.php';

class test_awsS3 extends TestCase
{

  public function test_LoadFileDataFromS3()
  {
    // Create the AWS service builder, providing the config array
    $awsConfig = [
          'credentials' => ['key' => getenv('bigprimesawskey'), 'secret' => getenv('bigprimesawssecret')],
          'region' => 'eu-west-1',
          'version' => '2006-03-01'
    ];

    //real one looks like this $this->client = new \Aws\S3\S3Client($awsConfig); but we mock instead
    $client = $this->getMockBuilder('\Aws\S3\S3Client')->disableOriginalConstructor()->setMethods(['doesObjectExist','getObject'])->getMock();

    $client->expects($this->once())
           ->method('doesObjectExist')
           ->will($this->returnValue(true));

    $client->expects($this->once())
           ->method('getObject')
           ->will($this->returnValue(['Body' => 'testFileContent']));

    $awsS3 = new \Bigprimes\awsS3($client);
   
    $fileName = 'someNonExistantFile';

    $fileData = $awsS3->LoadFileFromS3($fileName); 

    $this->assertEquals('/tmp/'.sha1($fileName).'_', substr($fileData, 0, 46));
  }

  public function test_saveDataToS3()
  {
    //real one looks like this $this->client = new \Aws\S3\S3Client($awsConfig); but we mock instead
    $client = $this->getMockBuilder('\Aws\S3\S3Client')->disableOriginalConstructor()->setMethods(['doesObjectExist','putObject'])->getMock();
    $fileName = 'someNonExistantFile';
    $testData = sha1(time().rand());

    //test for a file upload, that won't overwrite an existing file
    $client->expects($this->once())
           ->method('putObject')
           ->will($this->returnValue(['Body' => 'testFileContent']));
    $awsS3 = new \Bigprimes\awsS3($client);
    $fileData = $awsS3->saveDataToS3($testData,$fileName, true); 
    $this->assertEquals(sha1($testData), $fileData);
    
    //test for a file upload, that will overwrite an existing file
    $client->expects($this->once())
           ->method('doesObjectExist')
           ->will($this->returnValue(true));
    $awsS3 = new \Bigprimes\awsS3($client);
    $fileData = $awsS3->saveDataToS3($testData,$fileName, false); 
    $this->assertEquals(sha1($testData), $fileData);

  }
}
