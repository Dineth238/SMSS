<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      if($row['user_type'] == 'club'){

         $_SESSION['admin_name'] = $row['name'];
         header('location:../Clubview/home.html');

      }elseif($row['user_type'] == 'sponsor'){

         $_SESSION['user_name'] = $row['name'];
         header('location:../Sponsorview/home.html');

      }
     
   }else{
      $error[] = 'incorrect email or password!';
   }

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login form</title>

  
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
      <h3>login now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="email" name="email" required placeholder="enter your email">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="submit" name="submit" value="login now" class="form-btn">
      <p>don't have an account? <a href="register_form.php">register now</a></p>
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