<?php
namespace Bigprimes;

class Primes
{
    private $app;
    private $primes;
    private $numbersPerRow = 100;
    private $maxPrime = 1400000000;

    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * Gets largest prime in database.
     *
     * @return int The largest prime number we have in the db.
     */
    public function largestNthPrime()
    {
      /*$sql = 'SELECT n FROM primeNumbers ORDER BY n LIMIT 1';
      $row = $this->app['dbs']['mysql_read']->fetchAssoc($sql, array());
      return $this->getPrime($row['n']+99);*/
      return $this->maxPrime;
    }

     /**
     * CPU intensive primality check.
     *
     * @param int The number to be checked for primality
     * @return bool
     */
    public function cpuCheckNthPrime($num)
    {
      if ($num > 2147483647) {
        $error = 'cpuCheckPrime() cannot handle number larger than 2147483647';
        throw new Exception($error);
      }

      //1 is not prime
      if($num == 1) {
        return false;
      }

      //2 is the first prime and is the only even number that is also prime
      if($num == 2) {
        return '1';
      }

      /**
       * if the number is even (and not exactly equal to 2), then it's not prime
       */
      if(bcmod($num, 2) == 0) {
          return false;
      }

      /**
       * Checks the odd numbers. If any of them is a factor, then return false.
       */
      $ceil = ceil(sqrt($num));
      for($i = 3; $i <= $ceil; $i = $i + 2) {
        if(bcmod($num, $i) == 0) {
          return false;
        }
      }

      
      $nth = 1;
      //for every odd number starting at 3
      for ($n=3; $n<=$num; $n+=2) {
        $ceil = ceil(sqrt($n));
        //check if
        $add = 1;
        for($i = 3; $i <= $ceil; $i = $i + 2) {
          if(bcmod($n, $i) == 0) {
            $add = 0;
            break 1;
          }
        }
        $nth += $add; 
      }

      return $nth; 
    }

    /**
     * Gets nth prime.
     *
     * @param int $nth The nth prime you wish to get.
     * @return int The prime number.
     */
    public function getPrime($nth)
    {
        $prime = false;
        if ($nth > $this->maxPrime) {
            return null;
        }
        //Works out what row to pull from the database.
        $rowNo = ceil($nth / $this->numbersPerRow);
        //Calculats column that is needed.
        $col = $nth % $this->numbersPerRow;
        if ($col == 1) {
            $col = 'n';
        } elseif ($col == 0) {
            $col = $this->numbersPerRow;
        }
        //Creates colunm array for database query.
        $cols[] = 'n';
        if ($col != 'n') {
            $cols += range(2, $col);
        }
        //Fetch row
        $sql = 'SELECT `' . implode('`,`', $cols) . '` FROM primeNumbers WHERE id = ?';
        $row = $this->app['dbs']['mysql_read']->fetchAssoc($sql, array($rowNo));

        if (!is_array($row)) {
            return false;
        }

        if (is_array($row)) {
            //Times each delta col by two.
            $i = ($rowNo == 1) ? 3 : 2;
            while ($i <= count($row)) {
                $row[$i] = $row[$i] << 1;
                $i++;
            }
        }
        //Calulate prime.
        $prime = array_sum($row);

        return $prime;
    }

    /**
     * Checks to see if a given number is a prime.
     *
     * @param mixed $num The number you wish to check for primality.
     * @return boolean Flase if given number is not a prime. What number prime it is if is a prime.
     */
    public function checkIfNthPrime($num)
    {
        $num = (int)$num;
        if ($num === 1) {
            return false;
        }

        //Fetch first row that n is bigger than or equal to given number.
        $sql = 'SELECT id FROM primeNumbers WHERE n > ? LIMIT 1';
        $row = $this->app['dbs']['mysql_read']->fetchAssoc($sql, array((int)$num));
        $id = $row['id'];
        $id--;

        $sql = 'SELECT * FROM primeNumbers WHERE id = ? LIMIT 1';
        if (!is_int($id)) {
            //$id = $this->database->count('primeNumbers');
            return false;
        }
        $row = $this->app['dbs']['mysql_read']->fetchAssoc($sql, array((int)$id));
        //Checks to see if prime is within the verified primes.
        if ($row == false) {
            return null;
        } elseif (($row['id'] * 100) <= $this->maxPrime && $id) {
            //Loop through each number of the row until given number is found.
            $n = 0;
            $haveNumber = false;
            foreach ($row as $k => $col) {
                if ($row['id'] == 1 && $k == '2') {
                    //Do nothing.
                } else {
                    if ($k != 'n') {
                        //Times by two.
                        $col = $col << 1;
                    }
                }
                if ($k != 'id') {
                    //Add current col to $n.
                    $n += $col;
                    //If n is equal to given number
                    if ($n == $num) {
                        //Save the columns and break from loop.
                        $haveNumber = true;
                        $whatCol = $k;
                        break;
                    }
                }
            }
            //Check to see if we have found the number.
            if ($haveNumber) {
                //If they we have then calulate what number prime it is.
                if ($whatCol == 'n') {
                    $numPrime = (($row['id'] - 1) * $this->numbersPerRow) + 1;
                } else {
                    $numPrime = (($row['id'] - 1) * $this->numbersPerRow) + $whatCol;
                }
                return $numPrime;
            } else {
                //If we havnt then return false.
                return false;
            }
        }
        return null;
    }

    /**
     * Return a 100 set of primes.
     *
     * @param mixed $id The id of the row to pull.
     */
    public function primeSet($id)
    {
        $id = (int)$id;
        $sql = 'SELECT * FROM primeNumbers WHERE id = ? LIMIT 1';
        $row = $this->app['dbs']['mysql_read']->fetchAssoc($sql, array($id));

        if (!is_array($row)) {
            return [];
        }
        //Loop through each number and add them together.
        $n = 0;
        $haveNumber = false;
        $last = 0;
        $numbers = [];
        foreach ($row as $k => $col) {
            if ($k != 'id') {
                if ($row['id'] == 1 && $k == '2') {
                    //Do nothing.
                } else {
                    if ($k != 'n') {
                        //Times by two.
                        $col = $col << 1;
                    }
                }
                $thisNumber = $col + $last;
                $numbers[] = $thisNumber;
                $last = $thisNumber;
            }
        }
        return $numbers;
    }

    /**
     * Returns the number of rows
     *
     */
    public function numRows()
    {
        return ($this->maxPrime / 100);
    }

    public function prob_prime($num)
    {
        if ($num == 2 OR $num == 3) {
            return true;
        }

        $numToCheck = explode('-', chunk_split($num . '.00000000', 1, '-'));
        $divideBy = 9; //currently only for dividing by 9!

        $answer = []; // to hold the answer
        $working = false; // for working out

        $donePoint = false;
        foreach ($numToCheck as $nthDigit => $digit) {
            if ($digit === '.') {
                $donePoint = true;
                $answer[] = '.';
            } else {
                $digit = (int)$digit;
                if ($working !== false) {
                    $working = $digit + ($working * 10);
                    if ($working > $divideBy) {
                        $temp = ($working % $divideBy);
                        if ($donePoint == true) {
                            $answer[$nthDigit - 1] = ($working - $temp) / $divideBy;
                        }
                        if ($temp == 0) {
                            $working = false;
                        } else {
                            $working = $temp;
                        }
                    }
                } elseif ($digit > $divideBy) {
                    $temp = ($digit % $divideBy);
                    if ($donePoint == true) {
                        $answer[$nthDigit - 1] = $digit - $temp;
                    }
                } else {
                    $working = $digit;
                }
            }
        }

        $answer = substr(trim(implode('', $answer), '.'), 0, 5);
        if ($answer === '11111' OR $answer === '22222' OR $answer === '44444' OR $answer
            === '55555' OR $answer === '77777' OR $answer === '88888'
        ) {
            return true;
        } else {
            return false;
        }
    }
}
