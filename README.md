bigprimes.net
======

PHP 7 compatible www.bigprimes.net codebase written using the Silex microframework. 

Install
===

Apache instructions: Copy htdocs/.htaccesssample to htdocs/.htaccess and provide it with the variables needed for mysql. Run schema.sql on your chosen mysql server and populate tables such as `primeNumbers` if required.

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
