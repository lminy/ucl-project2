<?php
$dbname = 'uclprojet2';
$host = 'localhost';
$db_user = 'root';
$db_password = '';

/*
SCENARIO :
- Alice send a mail to Bob : "Hey I've found a bug in your website at the page + link". In fact the link contains the XSS injection on the login page
- Bob opens the link and sees that he is not connected
- Bob connect to the website
- His username and password has been transmitted by the script to Alice
*/

$connected = false;
$message='';
$db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $db_user, $db_password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if(isset($_GET['username']) && isset($_GET['password'])) {
  $is_valid = file_get_contents("http://$host/cgi-bin/check-login.cgi?" . $_GET['password']);
  $stmt = $db->query("SELECT * FROM administrateur WHERE Mail = '".$_GET['username']."' AND $is_valid"); // Username is checked in the DB and the password with the C file

  if($connected = ($stmt->rowCount() > 0)){
    $message = '<p>You are connected! Here are some sensitive information : <a href="https://github.com/misterch0c/shadowbroker">Shadow Brokers leaks</a></p>';
  }else{
    // Here is a Reflected XSS Attacks. The input 'username' from the client side isn't sanitized
    $message = '<p style="color:red">The username ' . $_GET['username'] . ' or password is incorrect</p>';
    // e.g. : <script>alert('You got hacked!');</script> as username => the script is interpreted
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>hack.me</title>
  <link rel="shortcut icon" href="skull.ico">
</head>
<body>
<?php
echo $message;
if($connected == False) :
?>
  <form name="login" action="<?=$_SERVER['REQUEST_URI']?>" method="get" accept-charset="utf-8">
    <label for="username">Username</label>
    <input type="text" name="username" placeholder="username" required>
    <label for="password">Password</label>
    <input type="password" name="password" placeholder="password" required>
    <input type="submit" value="Login">
  </form>
<?php
endif
?>
</html>
