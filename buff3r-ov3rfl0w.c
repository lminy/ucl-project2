#include <stdio.h>
#include <string.h>
#include "bcrypt/bcrypt.h"

// Before compiling :
// Disable ASLR: sudo bash -c 'echo 0 > /proc/sys/kernel/randomize_va_space'
// Compile bcrypt with make clean && make

// To compile :
// Disable canaries: gcc ... -fno-stack-protector
// Disable non-executable stack: gcc -z execstack ...
// Disable optimization: -O0 -g
// gcc -O0 -g -z execstack -c buff3r-ov3rfl0w.c -fno-stack-protector && gcc -o buff3r-ov3rfl0w buff3r-ov3rfl0w.o bcrypt/*.a

// To execute buffer overflow :
// ./buff3r-ov3rfl0w hhhhhhhhhhhhhhhhhhhhhhhhhhhhh

int main(int argc, char* argv[]){
  char password[15];
  int pwd_matches = 0;

  strcpy(password, argv[1]); // Where the overflow begins

  if(bcrypt_checkpw(password, "$2a$12$ZcbUh31Mkh0B6QCRScIRQOoB3UfG/IyvVNY/9azLGwALtHv0p9kfi") == 0){ // hash = 'thepassword'
    pwd_matches = 1;
  } // If not => use the "default" value of pwd_matches ! ;)

  if(pwd_matches) { // if pwd_matches > 0 => match !
    // The password matches
    printf("True\n");
  } else {
    // The password does NOT match
    printf("False\n");
  }

  return 0;
}
