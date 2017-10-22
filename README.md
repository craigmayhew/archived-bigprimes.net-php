bigprimes.net
======

PHP 7 codebase written using the [Silex micro-framework](https://github.com/silexphp/Silex).

[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.0-8892BF.svg?style=flat-square)](https://php.net/)
[![Dependency Status](https://www.versioneye.com/user/projects/5932825c22f278006540a1f0/badge.svg?style=flat-square)](https://www.versioneye.com/user/projects/5932825c22f278006540a1f0)
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
- terraform apply

make sure you have your aws credentials in your home directory and you have terraform installed (or referenced in the bin directory, or the repo directory)

Related projects
===

- https://github.com/craigmayhew/primes
- https://github.com/craigmayhew/static.bigprimes.net

Goals
===

- ~~Remove redundent code.~~
- ~~Organise code into logical folders.~~
- Get code to the point where we can run unit tests.
- 100% test coverage.

Fun Facts
===

- there are 1.4\*10<sup>297</sup> primes smaller than 300 digits
- there is always a prime between n^2 and (n+1)^2.
