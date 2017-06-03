<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../src/Bigprimes/SumOfDigits.php';

class test_SumOfDigits extends TestCase
{
	public function test_get()
	{
		$app = new Silex\Application();
                
                $app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'dbs.options' => array(
        'mysql_read' => array(
            'driver' => 'pdo_mysql',
            'host' => getenv('bigprimesDBEndPoint'),
            'dbname' => getenv('bigprimesDBName'),
            'user' => getenv('bigprimesDBUser'),
            'password' => getenv('bigprimesDBPass'),
            'charset'   => 'utf8mb4',
        ),
        'mysql_write' => array(
            'driver' => 'pdo_mysql',
            'host' => getenv('bigprimesDBEndPoint'),
            'dbname' => getenv('bigprimesDBName'),
            'user' => getenv('bigprimesDBUser'),
            'password' => getenv('bigprimesDBPass'),
            'charset'   => 'utf8mb4',
        ),
    ),
));
return true;
//echo 'wooooooooooooooooooooooooooooooooooooooo'; die(getenv('bigprimesDBEndPoint'));
                $class = new \Bigprimes\SumOfDigits(new \Bigprimes\Primes($app), $app);
                $get = $class->get(3);		

		// Assert uuid is 36 chars long
		$this->assertEquals(36, $get);
	}
}
