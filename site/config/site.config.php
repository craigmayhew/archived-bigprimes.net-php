<?php
//Site
$config['site']['url'] = 'http://www.bigprimes.net/';
$config['site']['name'] = 'BigPrimes';
//SQL vars
$config['db']['user'] = 'bigprime_user';
$config['db']['host'] = 'localhost';
$config['db']['pass'] = getenv('bigprimesDBPass');
$config['db']['db']   = 'bigprime_db';

$config['email'] = 'primes@bigprimes.net';
//Constants
define('SALT','LIME' );
define('NEWLINE',"\r\n" );
//Misc
$table_color = '#e0faed';
$max_len_prime = 11;
$max_len_cube = 17;
$max_len_square = 19;
$max_len_triangle = 17;
$max_len_convertion = 500; //converting the number to binary and hex ...
$max_len_factorization = 6;
$max_len_roman_numerals = 6;
$max_len_egypt_numerals = 7;
$max_len_chinese_numerals = 6;
$max_len_babylonian_numerals = 13;
