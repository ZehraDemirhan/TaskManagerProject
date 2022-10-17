<!DOCTYPE html>
<html lang="en">
<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
   
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css"> 
   
  </head>
  
<body>
<?php 
  session_start();
  require "db.php";
 
  if(!empty($_POST))
  {

   
    extract($_POST);
    //var_dump($_POST);
    if (checkUser($email,$pass)!=false)
    {
        
        
        $_SESSION["user"]=getUser($email);
        header("Location: main.php");
        exit;


    }
    
    //var_dump($_SESSION);

 
    
  
}
  
  ?>
<nav class="light blue lighten-2">
    <div class="nav-wrapper">
        <div style="text-align:center;"><a href="#" class="brand-logo">TaskMan</a></div>
      
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><i class="material-icons prefix">group_add</i>
      </li>
      <li>  <a href="register.php">Register</a></li>
        
      </ul>
    </div>
  </nav>


 
    <form class="" method="post">
        <div style="width:800px; margin:150px auto;"> 
      <div class="row">
        <div class="input-field ">
          <i class="material-icons prefix">account_circle</i>
          <input id="icon_prefix" type="text" class="validate" name="email" placeholder="Email" value=<?= $email ?? '' ?> >
         
        </div>
        </div>
        <div class="row" >
        <div class="input-field  " >
          <i class="material-icons prefix">lock</i>
          <input id="icon_telephone" type="password" class="validate" name="pass" placeholder="Password"  value=<?= $pass ?? '' ?>>
         
        </div>
        </div>

        <div class="row" style="text-align:center;">
        <button class="btn waves-effect waves-light" type="submit" name="login">LOGIN
    
        
        </button>
        
        </div>
        <div class="row" style="text-align:center;">
        <div class=<?= isset($email) && isset($pass) && !checkUser($email,$pass) ? "elementToFadeInAndOut":"hide" ?>>
        Login Failed!
         </div>
        </div>
</div>
      
    </form>
 

</body>
</html>