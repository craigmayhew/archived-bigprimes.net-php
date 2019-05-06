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

All of that has been wrapped up into running the following on an Amazon linux box to compile php.

- touch /tmp/lambda.zip
- terraform init
- terraform apply -var 'rdsuser=user' -var 'rdspass=pass' -var 'rdshost=host' -var 'rdsdb=bigprimes'  -var 'subnetA="subnet-aaaaaaaa"' -var 'subnetB="subnet-bbbbbbbb"' -var 'subnetC="subnet-cccccccc"' -var 'securityGroup=sg-gggggggg'

make sure you have your aws credentials in your home directory and you have terraform installed (or referenced in the bin directory, or the repo directory)

Developing & Running Tests
===
run tests and/or build project in docker
`docker build -t bigprimestest .`
`docker run bigprimestest`

Project Roadmap
===
Convert to serverless, reactjs and rust.
- Use serverless to deploy reactjs to an s3 bucket.
- Use serverless to deploy a basic rust lambda with a unit test.
- Deploy a reactjs html/css theme for the site
- Write a replacement for the home page and repoint cloudfront just for the home page using distribution "behaviours".
- Repeat for each page type, choosing pure reactjs or supplement with rust as needed.

Related projects
===
- https://github.com/craigmayhew/primes
- https://github.com/craigmayhew/static.bigprimes.net

Fun Facts
===
- there are 1.4\*10<sup>297</sup> primes smaller than 300 digits
- there is always a prime between n^2 and (n+1)^2.
