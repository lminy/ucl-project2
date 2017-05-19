<?php
  $connected = false;
  $message = null;
  include("connectDB.php");
  if(isset($_POST["username"]) && isset($_POST["password"])){
      //$query = mysql_query("SELECT * FROM administateur WHERE Mail = :mail AND Password = :password ");
      $query = mysql_query("SELECT * FROM administateur WHERE Mail ='".$_POST["username"]."' AND Password='".$_POST["password"]."'");
			if(mysql_num_rows($query) > 0){
        $connected = true;
      }else{
      $message = "L'identifiant '".htmlspecialchars($_POST["username"])."' avec le mot de passe '".htmlspecialchars($_POST["password"])."' ne sont pas corrects.";
    }
  }
  if(isset($_POST["personName"]))
    $message = "La personne '".$_POST["personName"]."' n'a pas été trouvée.";
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
        <input type="text" name="username" placeholder="Identifiant">
        <input type="password" name="password" placeholder="Mot de passe">
        <button type="submit">Envoyer</button>
      </form>

      <?php
        }else{?>
          You are connected! Here are some sensitive information : <a href="https://github.com/misterch0c/shadowbroker">Shadow Brokers leaks</a></br></br>
          <h1>Rechercher une personne</h1>
          <?php
            if($message != null):
          ?>
              <div class="alert alert-error"><?php echo $message; ?></div>
          <?php
            endif;
          ?>

    	  <form action="index.php" method="post">
            <input type="text" name="personName" placeholder="Entrer le nom d'une personne">
            <br><br>
            <button type="submit">Rechercher</button>
          </form>
          <a type="button" href="check-login.cgi">GO BACK</a>


        <?php }  ?>

</body></html>
