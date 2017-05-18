<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>hack.me</title>
<link rel="shortcut icon" href="skull.ico">
</head>
<?php
/*
SCENARIO :
- Alice send a mail to Bob : "Hey I've found a bug in your website at the page + link". In fact the link contains the XSS injection on the login page
- Bob opens the link and sees that he is not connected
- Bob connect to the website
- His username and password has been transmitted by the script to Alice
*/
$connected = false;
if(isset($_GET['username']) && isset($_GET['password'])) {
  if($_GET['username'] != 'admin' || $_GET['password'] != 'admin'){
    // Here is an Reflected XSS Attacks. The input 'username' from the client side isn't sanitized
    echo '<p style="color:red">The username ' . $_GET['username'] . ' or password is incorrect</p>';
    // e.g. : <script>alert('You got hacked!');</script> as username => the script is interpreted
  }else{
    $connected = true;
    echo 'You are connected! Here are some sensitive information : <a href="https://github.com/misterch0c/shadowbroker">Shadow Brokers leaks</a>';
  }
}

if(!$connected) :
?>


<body>
  <form name="login" action="/cgi-bin/check-login.cgi" method="get" accept-charset="utf-8">
      <label for="username">Username</label>
      <input type="text" name="username" placeholder="username" required>
      <label for="password">Password</label>
      <input type="password" name="password" placeholder="password" required>
      <input type="submit" value="Login">
    </ul>
  </form>
</body>

<?php
endif
?>

</html>
