<?php require_once("header.php");

echo "

So you want to find some primes? Excellent this page has got a few things to get you started.
<br><br><br>

<SCRIPT type=\"text/javascript\">
// The largest integer Java natively supports is 2^53-1, so these
// routines are designed to work for *positive* integers up to that.

// trial_divide(N,max) uses trial division to seek the smallest
// prime divisor of N, returns 0 if none found.

function trial_divide(N,max) {
  // Trial divides the positive integer N by the primes from 2 to max
  // Returns the first prime divisor found, or 0 if none found
  // Note: if N < max^2 is a prime, then N will be returned. 
  if (N%2 == 0) return 2;
  if (N%3 == 0) return 3;
  // No need to go past the square root of our number
  var Stop = Math.min(Math.sqrt(N),max);
  // Okay, lets \"wheel factor\" alternately adding 2 and 4
  var di=2;
  for(i=5; i<=Stop; i+=di, di=6-di) {
    if (N%i == 0) return i;
  };
  if (N >= max*max) return 0; 
  return N;
}


// modmult(a,b,N) finds a*b (mod N) where a, b, and N can be 
// up to (2^53-1)/2.  Might up this to 2^53-1 eventually...

function modadd(a,b,N) {
// When the integers a, b satisfy a+b > 2^53-1, then (a+b)%N is wrong
// so we add this routine to allow us to reach a, b = 2^53-1.
  if (a+b > 9007199254740991) {
    // Could reduce a and b (mod N) here, but assuming that has already been done
    // won't hurt if not... subtract 2^52 from one, 2^52-1 from the other and the
    // add it back modulo N (MaxInt+1)  
    var t = ( (a-4503599627370496) + (b-4503599627370495) )%N;
    return ( t + (9007199254740991 % N) );
  }
  // Usual case: a + b is not too large:
  return ( (a+b)%N );
}

function modmult(a,b,N) {
  if (a > N) a = a%N;
  if (b > N) b = b%N;
  if (a*b <= 9007199254740991) {
    return ((a*b)%N);
  } else {
    if (b > a) return modmult(b,a,N);

    // Right to left binary multiplication
    var t = 0;
    var f = a;
    while (b > 1) {
      if ((b & 1) == 1) t = modadd(t,f,N);
      b = Math.floor(b/2);
      f = modadd(f,f,N);
    };
    t = modadd(t,f,N);
    return t;
  }
}

// modpow(a,exp,N) finds a^exp (mod N) where a, b, and N are 
// limited by modmult

function modpow(a,exp,N) {
  if (exp == 0) return 1;

  // Right to left binary exponentiation
  var t = 1;
  var f = a;
  while (exp > 1) {
    if ((exp & 1) == 1) {  // if exponent is odd
      t = modmult(t,f,N);
    }
    exp = Math.floor(exp/2);
    f = modmult(f,f,N);
  };
  t = modmult(t,f,N);
  return t;
}

// SPRP(N,a) checks if N (odd!) is a strong probable prime base a 
// (returns true or false)

function SPRP(N,a) {
  var d = N-1; s = 1;  			// Assumes N is odd!
  while ( ((d=d/2) & 1) == 0) s++;	// Using d>>1 changed the sign of d!
  // Now N-1 = d*2^s with d odd
  var b = modpow(a,d,N);
  if (b == 1) return true;
  if (b+1 == N) return true;
  while (s-- > 1) {
    b = modmult(b,b,N);
    if (b+1 == N) return true;
  }
  return false;
}

// The idiot proofing, answer returning script

function check(list,offset){
  var answer = false; // returns boolean yes no for the list
  var TrialLimit = 1300; // Should be bigger, like 10000
  if (list == true){
	var N = (document.primelist.start.value*1) + (offset*1);
  }else{
	var N = document.primetest.input.value;
  }
  var Result = \"Unknow error\";
  var a;
    
  if (N > 9007199254740991) {
    Result = \"Sorry, this routine will only handle integers below 9007199254740991 \";
  } else if (N == 1) {
    Result = \"The number 1 is neither prime or composite (it the multiplicative identity).\";
  } else if (N < 1) {
    Result = \"We usually restrict the terms prime and composite to positive integers\";
  } else if (N != Math.floor(N)) {
    Result = \"We usually restrict the terms prime and composite to positive integers\";
  } else {
    // Okay, N is of a resonable size, lets trial divide
    window.status = \"Trial dividing \" + N + \" to \" + TrialLimit + \".\";
    i = trial_divide(N,TrialLimit);
    if (i > 0 && i != N) { 
      Result = N+\" is not a prime! It is \"+i+\" * \"+N/i;
	  answer = false;
    } else if (N < TrialLimit*TrialLimit) {
      Result = N+\" is a (proven) prime!\";
	  answer = true;
    } else if ( SPRP(N,a=2) && SPRP(N,a=3) && SPRP(N,a=5) && SPRP(N,a=7) 
    		&& SPRP(N,a=11) && SPRP(N,a=13) && SPRP(N,a=17)) {
      // Some of these tests are unnecessary for small numbers, but for
      // small numbers they are quick anyway.
      if (N < 341550071728321) {
        Result = N + \" is a (proven) prime.\";
		answer = true;
      } else if (N == 341550071728321) {
        Result = N+\" is not a prime! It is 10670053 * 32010157.\";
		answer = false;
      } else {
        Result = N + \" is probably a prime (it is a sprp bases 2, 3, 5, 7, 11, 13 and  17).\";
		answer = true;
      };
    } else {
      Result = N+\" is (proven) composite (failed sprp test base \"+a+\").\";
	  answer = false;
    };
  };
  
  if (list == true){
	if (answer == true){
		primelist.javascriptlistoutput.value += Result + String.fromCharCode(13); // here so says done when present alert box
	}
	return answer;
  }else{
  	primetest.javascriptoutput.value = Result; // here so says done when present alert box
  }
}

function listy(){
  var i=0;
  var j=1;
  while (i<document.primelist.primes.value){
	if (check(true,j) == true){
	  i++;
	}
	j++;
  }
}
</SCRIPT>

<table bgcolor=\"#e0faed\" border=\"1\" cellpadding=\"10\" cellspacing=\"0\" class=\"text\" width=\"200\" bordercolor=\"#444444\"><tr><td>

<FORM name=\"primetest\" onsubmit=\"return false\">
 This test uses javascript and is limited to checking numbers upto 16 digits.<br><br>
 Is <INPUT size=\"16\" name=\"input\" maxlength=\"16\"> prime? 
 <INPUT onclick=\"check(false,0)\" type=\"button\" value=\"Check!\">
 <br><br>
 <textarea readonly=\"true\" name=\"javascriptoutput\" cols=\"40\"></textarea>
</FORM>

</td></tr></table>

<br><br>

<table bgcolor=\"#e0faed\" border=\"1\" cellpadding=\"10\" cellspacing=\"0\" class=\"text\" width=\"200\" bordercolor=\"#444444\"><tr><td>

<FORM name=\"primelist\" onsubmit=\"return false\">
 This uses javascript and is limited to checking numbers upto 15 digits.<br><br>
 This will show <INPUT size=\"4\" name=\"primes\" maxlength=\"2\" value=\"1\">
 prime numbers after <INPUT size=\"16\" name=\"start\" maxlength=\"15\" value=\"0\">
 <INPUT onclick=\"primelist.javascriptlistoutput.value='';listy();\" type=\"button\" value=\"Go!\">
 <br><br>
 <textarea readonly=\"true\" id=\"javascriptlistoutput\" cols=\"60\" rows=\"10\"></textarea>
</FORM>

</td></tr></table>
";

/*
public void primalityCheck()
{
Integer nx = new Integer(n.getText());
int n = nx.intValue(); 
int p = 0;
textArea1.setText("Primes from 2 to n:\n\n");

for (int i = 0; i < n; i++)

if(isPrime(i)) 
{ p++;
if(p%10 == 0)textArea1.appendText("\n ");
textArea1.appendText(i + " ");
} 

}
static boolean isPrime(int n)
{if (n < 2) return false;
if (n == 2) return true;
if (n%2 == 0) return false;
for (int d = 3; d <= Math.sqrt(n); d += 2)
if (n%d == 0) return false;
return true;
}
*/
require_once("footer.php");?>