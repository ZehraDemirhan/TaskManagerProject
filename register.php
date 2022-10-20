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
    <style>
    .center {
  margin: auto;
  width: 50%;
 
  padding: 10px;
}


   </style>
  </head>
<body>
<?php 
  session_start();
  require "db.php";

 //var_dump($_FILES);
 //extract($_FILES);
  if(!empty($_POST))
  {
    $file= $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['name'];
    $fileSize = $_FILES['file']['name'];
    $fileError = $_FILES['file']['name'];
    $fileType= $_FILES['file']['name'];

    $fileExt = explode('.',$fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    if (in_array($fileActualExt, $allowed ))
    {
        if($file === 0)
        {
            if($fileSize < 1000000)
            {
                //Create random unique id to distinguish the files
                $fileNameNew = uniqid('', true ).".".$fileActualExt;

                $fileDestination = 'images/'.$fileNameNew;

                move_uploaded_file($fileTmpName, $fileDestination);





            }
            else{
                $fileTypeError = 1;
            }


        }
        else{
            $fileTypeError = 1;
        }


    }

    else
    {
        $fileTypeError = 1;

    }







    $_SESSION['user']['image']=$file;
    var_dump($_SESSION);
    extract($_POST);
    registerUser($name,$email,$pass,$file);


    //header("Location: index.php");
  }

  
  ?>
<nav class="light blue lighten-2">
    <div class="nav-wrapper">
        <div style="text-align:center;"><a href="#" class="brand-logo">TaskMan</a></div>
      
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        
     
      </ul>
    </div>
  </nav>
  
  <div class="center">
  <div class="row" >
    <form class="" method="post"  enctype="multipart/form-data" >
      <div class="row" >
        <div class="input-field " >
          <input placeholder="Name" id="first_name" type="text" class="validate" name="name"  value=<?= $name ?? '' ?>>
         
        </div>
        
      </div>

      <div class="row">
        <div class="input-field ">
          <input placeholder="Email" id="email" type="email" class="validate" name="email"  value=<?= $email ?? '' ?>>
      
        </div>
      </div>
     
      <div class="row">
        <div class="input-field ">
          <input placeholder="Password" id="password" type="password" class="validate" name="pass"  value=<?= $pass ?? '' ?>>
          
        </div>
      </div>
     
 
   <div class="row">
    <div class="file-field input-field ">
      <div class="btn">
        <span>Image</span>
        <input type="file" name="file">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text"  value=<?= $file ?? '' ?> >
      </div>
    </div>
    </div>

    <div class="row" >
        
    <div class="" style="text-align:center;"><button class="btn waves-effect waves-light" type="submit" name="action">Register
    <i class="material-icons right">send</i>
  </button></div> </div>

        <div class="row" style="text-align:center;">
            <div class=<?= isset($fileTypeError) && $fileTypeError==1 ? "elementToFadeInAndOut":"hide" ?>>
                Wrong file type!
            </div>
        </div>
    

  </div>
  </form>
  </div>
</body>
</html>