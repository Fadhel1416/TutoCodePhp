<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../style.css" />
</head>
<body>
<?php
require('../config.php');
session_start();
// Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
if($_SESSION["type"]=="admin"){


if (isset($_REQUEST['username'], $_REQUEST['email'], $_REQUEST['type'], $_REQUEST['password'])){
  // récupérer le nom d'utilisateur 
  $username = stripslashes($_REQUEST['username']);
  $username = mysqli_real_escape_string($conn, $username); 
  // récupérer l'email 
  $email = stripslashes($_REQUEST['email']);
  $email = mysqli_real_escape_string($conn, $email);
  // récupérer le mot de passe 
  $password = stripslashes($_REQUEST['password']);
  $password = mysqli_real_escape_string($conn, $password);
  // récupérer le type (user | admin)
  $type = stripslashes($_REQUEST['type']);
  $type = mysqli_real_escape_string($conn, $type);
  
    $query = "INSERT into `users` (username, email,password,type)
          VALUES ('$username', '$email', '".hash('sha256', $password)."', '$type')";
    $res = mysqli_query($conn, $query);

    if($res){
       echo "<div class='sucess'>
             <h3>L'utilisateur a été créée avec succés.</h3>
             <p>Cliquez <a href='home.php'>ici</a> pour retourner à la page d'accueil</p>
       </div>";
    }
}else{
?>
<form class="box" action="" method="post">
  <h1 class="box-logo box-title">
    <a href="https://waytolearnx.com/">WayToLearnX.com</a>
  </h1>
    <h1 class="box-title">Add user</h1>
  <input type="text" class="box-input" name="username" 
  placeholder="Nom d'utilisateur" required />
  
    <input type="text" class="box-input" name="email" 
  placeholder="Email" required />
  
  <div>
      <select class="box-input" name="type" id="type" >
        <option value="" disabled selected>Type</option>
        <option value="admin">Admin</option>
        <option value="user">User</option>
      </select>
  </div>
  
    <input type="password" class="box-input" name="password" 
  placeholder="Mot de passe" required />
  
    <input type="submit" name="submit" value="+ Add" class="box-button" />
</form>
<?php } ?>
<?php } else {
    echo "<div class=' box1 '>
    <h1 class='box-logo box-title'><a href='https://waytolearnx.com/'>WayToLearnX.com</a></h1>

             <p class='errorMessage'>vous n'ete pas authoriseé d'accéeder a cette espace.</p>
             <img width ='1500' height='500' src='https://img-0.journaldunet.com/KMg1Yx36CnIT8g7QM-QHF_NIZfg=/1500x/smart/67f08fc7bfa04fedbb78badd1df132b5/ccmcms-jdn/11048473.jpg'/>
       </div>";
} ?>

</body>
</html>