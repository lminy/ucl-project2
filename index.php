<?php
  $connected = false;
  $message = null;
  if(isset($_POST["email"]) && isset($_POST["password"])){
      if(($_POST["email"] == "admin") && ($_POST["password"]== "admin")){
        $connected = true;
      }else{
      $message = "L'email '".htmlspecialchars($_POST["email"])."' avec le mot de passe '".htmlspecialchars($_POST["password"])."' ne sont pas corrects.";
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Le site de ta vie</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
  </head>

  <body>

    <div class="container">
      <?php
        if($connected != true){
      ?>
          <div class="alert alert-error"><?php echo $message; ?></div>
      <form action="index.php" method="post">
        <h2>Se connecter</h2>
        <input type="text" name="email" placeholder="Adresse email">
        <input type="password" name="password" placeholder="Mot de passe">
        <button type="submit">Envoyer</button>
      </form>

      <?php
        }else{
          echo 'You are connected! Here are some sensitive information : <a href="https://github.com/misterch0c/shadowbroker">Shadow Brokers leaks</a>';
            echo '<a type="button" href="check-login.cgi">GO BACK</a>';
        }
      ?>

</body></html>
