<?php

@include 'config.php';

if(isset($_POST['submit'])){


   $name = mysqli_real_escape_string($conn,$_POST["name"]);
   $email = mysqli_real_escape_string($conn,$_POST["email"]);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exist!';

   }else{

      if($pass != $cpass){
         $error[] = 'password not matched!';
      }else{
         $insert = "INSERT INTO user_form(name, email, password, user_type) VALUES('$name','$email','$pass','$user_type')";
         mysqli_query($conn, $insert);
         header('location:login_form.php');
      }
   }

};


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register form</title>

   
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
   <link rel="stylesheet" href="../css-style.css">

</head>
<body>
   <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #d3d3d3;">
    <a class="navbar-brand" href="#">
      <img src="../logo.png" alt="Logo" width="80" height="40"> <!-- Adjust width and height as needed -->
      Sponsorship Management Software System
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="../index.html">Home </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../aboutUs.html">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../contact.html">Contact</a>
        </li>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                  <a class="nav-link" href="login_form.php">Login</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="register_form.php">Signup</a>
              </li>
          </ul>
      </div>
      </ul>
    </div>
  </nav>

   
<div class="form-container">

   <form action="" method="post">
      <h3>register now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="name" required placeholder="enter Sponsor/Club name">
      <input type="email" name="email" required placeholder="enter your email">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="password" name="cpassword" required placeholder="confirm your password">
      <select name="user_type">
         <option value="sponsor">Sponsor</option>
         <option value="club">Club</option>
      </select>
      <input type="submit" name="submit" value="register now" class="form-btn">
      <p>already have an account? <a href="login_form.php">login now</a></p>
   </form>

</div>
<footer>
        <!-- Footer with social media links -->
        <ul>
          <li><a href="#">Facebook</a></li>
          <li><a href="#">Twitter</a></li>
          <li><a href="#">Instagram</a></li>
        </ul>
        <div class="copyright">
          &copy; All Rights Reserved.
      </div>
      </footer>

</body>
</html>