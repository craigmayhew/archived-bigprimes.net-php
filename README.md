bigprimes.net
======

PHP 7 codebase for bigprimes.net written using the [Silex micro-framework](https://github.com/silexphp/Silex).

[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.0-8892BF.svg?style=flat-square)](https://php.net/)
[![Codecov branch](https://img.shields.io/codecov/c/github/craigmayhew/bigprimes.net/master.svg)](https://codecov.io/gh/craigmayhew/bigprimes.net)
[![Build Status](https://travis-ci.org/craigmayhew/bigprimes.net.svg?branch=master)](https://travis-ci.org/craigmayhew/bigprimes.net)

Install
===

 1. Apache instructions: Copy htdocs/.htaccesssample to htdocs/.htaccess and provide it with the variables needed for mysql.
 2. Run schema.sql on your chosen mysql server and populate tables such as `primeNumbers` if required.
 3. php composer.phar install
 
AWS Lambda
===
To host bigprimes.net via AWS Lambda we need to; build a package, copy the bigprimes codebase into it, deploy it to lambda.

All of that has been wrapped up into:

- terraform init
- terraform apply -var 'rdsuser=user' -var 'rdspass=pass' -var 'rdshost=host' -var 'rdsdb=bigprimes'  -var 'subnetA="subnet-aaaaaaaa"' -var 'subnetB="subnet-bbbbbbbb"' -var 'subnetC="subnet-cccccccc"' -var 'securityGroup=sg-gggggggg'

make sure you have your aws credentials in your home directory and you have terraform installed (or referenced in the bin directory, or the repo directory)

Related projects
===

- https://github.com/craigmayhew/primes
- https://github.com/craigmayhew/static.bigprimes.net

Goals
===

- ~~Remove redundent code.~~
- ~~Organise code into logical folders.~~
- ~~Get code to the point where we can run unit tests.~~
- 100% test coverage.

Fun Facts
===

- there are 1.4\*10<sup>297</sup> primes smaller than 300 digits
- there is always a prime between n^2 and (n+1)^2.
