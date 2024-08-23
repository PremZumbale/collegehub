<?php
$showAlert = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){

  include 'partials/_dbconnect.php';
  $username = $_POST["username"];
  $password = $_POST["password"];
  $cpassowrd = $_POST["cpassword"];
  //$exists=false;

  $existSql = "SELECT * FROM `users` WHERE username = '$username'";  
  $result = mysqli_query($conn, $existSql);
  $numExistRows = mysqli_num_rows($result);
  if($numExistRows > 0){
    //$exists = true;
    $showError = "Username Already Exists";

  }
  else{
    //$exists = false;
    if(($password == $cpassowrd)){
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `users` (`username`, `password`, `dt`) VALUES ('$username', '$hash', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        if ($result){
            $showAlert = true;
        }

    }
    else{
        $showError = "Passwords Do Not Match";
    }
  } 
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SignUp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Teko:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    
    <style> 
      body {
        background: linear-gradient(90deg, #C7C5F4, #776BCC);
        font-family: Hind;
        
      }
      .container {
        background: linear-gradient(135deg, rgba(0, 0, 0, 0.9), rgba(30, 30, 30, 0.7)), url('https://www.transparenttextures.com/patterns/dark-fabric.png');
        background-blend-mode: overlay;
        border-radius: 50px;
        padding: 100px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.6);
        color: #fff;
        max-width: 100%;
        width: 50%;
        max-height: 100%;
        height: 80%;
        margin: 0 auto;
        margin-top: 120px;
      }

        .h1 {
          font-family: 'Teko', sans-serif;
        }
        .mb-3{
          margin-top: 10px;
          margin-bottom: 10px;
          font-family: Garamond;
        }
        .form-label{
          margin-top : 20px;
          font-family: Garamond;
        }
    </style>
  </head>
  <body>

   <?php require 'partials/_nav.php' ?>
   <?php
   if($showAlert){
   echo '<div class="alert alert-success aler-dismissible fade show" role="alert">
    <strong>Success!</strong>  Your account is created and now you can Login.
    <button type="button" class="close" data-dismiss="alert" area-label="close">
      <span aria-hidden="true">&times;</span>
    </button>
   </div> ';
   }
   if($showError){
    echo '<div class="alert alert-danger aler-dismissible fade show" role="alert">
     <strong>Error!</strong>'. $showError.'
     <button type="button" class="close" data-dismiss="alert" area-label="close">
       <span aria-hidden="true">&times;</span>
     </button>
    </div> ';
    }
   ?>
   <div class="container" style="dispaly: flex">
    <h1 class="text-center">Please Fill Your Details Bellow</h1>
    <form action="/loginsystem/signup.php" method="post">
       <div class="form-group">
           <label for="username" class="form-label">Username</label>
           <input type="text" maxlength="50" class="form-control" id="username" name="username" aria-describedby="emailHelp">
           
       </div>
       <div class="mb-3">
           <label for="password" class="form-label">Password</label>
           <input type="password" maxlength="60" class="form-control" id="password" name="password">
       </div>
       <div class="mb-3">
           <label for="cpassword" class="form-label">Confirm Password</label>
           <input type="password" class="form-control" id="cpassword" name="cpassword">
           <div id="emailHelp" maxlength="60" class="form-text"   style="color: #ffffff"  >Make sure to type same password.<p style="color: #ffffff" style="margin-top: 10px">Have an account? <a href="/loginsystem/login.php">LogIn From Here.</a><p></div>
       </div>
       
       <button type="submit" class="btn btn-primary">SignUp</button>
    </form>

   </div>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>