#include <iostream>
#include <string>
#include <stdio.h>
#include <algorithm>
#include <ctgmath>
//g++ -std=gnu++11 -o factors factors.cpp

using namespace std;

// a thread
void crunch(unsigned long long n) 
{
  int counter = 0;
  unsigned long long i = 0;
  unsigned long long factors [1000];
  
  std::fill(std::begin(factors), std::end(factors), 0);
  counter = 0;
  
  for (i=1; i<=n; i++) {
    if (n % i == 0){
      auto result = std::find(std::begin(factors), std::end(factors), i);
      if (std::end(factors) == result){
         factors[counter] = i;
         counter++;
         factors[counter] = (n/i);
         counter++;
      }else{
         break;
      }
    }
  }

  sort(begin(factors),end(factors),std::greater<int>());

  for (i=0; i<counter; i++){
    cout << factors[i] << "\n";
  }

}

// main () is where program execution begins
int main(int argc, char *argv[])
{
  std::string::size_type sz = 0;   // alias of size_t
  unsigned long long n = std::stoull(argv[1],&sz,10);
  crunch(n);
}
