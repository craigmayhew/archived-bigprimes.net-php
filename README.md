bigprimes.net
======

PHP 7 compatible www.bigprimes.net codebase written using the Silex microframework.

[![Dependency Status](https://www.versioneye.com/user/projects/5932825c22f278006540a1f0/badge.svg?style=flat-square)](https://www.versioneye.com/user/projects/5932825c22f278006540a1f0)

Install
===

 1. Apache instructions: Copy htdocs/.htaccesssample to htdocs/.htaccess and provide it with the variables needed for mysql.
 2. Run schema.sql on your chosen mysql server and populate tables such as `primeNumbers` if required.
 3. php composer.phar install

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
