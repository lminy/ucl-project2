# ucl-project2

## Injection SQL
**User way** - The user enter the 'admin' username and enter his password 'thepassword' to login

**Hacker way** - The injection can be done by entering any password and the following username :
```
admin' or '1'='1' #
```

## Buffer Overflow
**User way** - The user enter the 'admin' username and enter his password 'thepassword' to login

**Hacker way** - The buffer overflow is done by rewriting the variable 'int pwd_matches' with garbage. And everything different over value 0 means "Password valid". So we can enter the username 'admin' (guessed) and the following as password (29 * 'h') :
```
hhhhhhhhhhhhhhhhhhhhhhhhhhhhh
```

**Remarks** :
- the file 'check-login' and 'buff3r-ov3rfl0w' must have the correct rights
- the file 'buff3r-ov3rfl0w' has to be compile for your system (more info in the source file 'buff3r-ov3rfl0w.c')

## XSS
