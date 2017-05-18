#include <stdio.h>
#include "bcrypt/bcrypt.h"

// To compile :
// gcc -c buff3r-ov3rfl0w.c && gcc -o buff3r-ov3rfl0w buff3r-ov3rfl0w.o bcrypt/*.a

int main(int argc, char* argv[]){
  char* password = argv[1];
  int pwd_matches;
  char hash[BCRYPT_HASHSIZE];

  printf("Password : %s\n", password);

  FILE* file = NULL;
  file = fopen("my_secure_password.txt", "r");

  if(file != NULL){
    fgets(hash, BCRYPT_HASHSIZE, file);
    fclose(file);
  }else{
    printf("The file my_secure_password.txt doesn't exists\n");
  }

  pwd_matches = bcrypt_checkpw(password, hash);
  if(pwd_matches == 0) {
    // The password matches
    printf("The password matches\n");
  } else {
    // The password does NOT match
    printf("The password does NOT match\n");
  }

  return 0;
}

/*
// Create the hash

int main(int argc, char* argv[]){
  char hash[BCRYPT_HASHSIZE];
  char salt[BCRYPT_HASHSIZE];

  bcrypt_gensalt(12, salt);
  bcrypt_hashpw("thepassword", salt, hash);

  printf("Hash : %s", hash);

  FILE* file = NULL;
  file = fopen("my_secure_password.txt", "w");

  if(file != NULL){
    fputs(hash, file);
    fclose(file);
  }else{
    printf("The file my_secure_password.txt doesn't exists\n");
  }

  //create_hash();
  return 0;
}


*/
