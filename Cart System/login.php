<?php
  include "config.php";
  session_start();
  if(isset($_POST['submit']))
  {
    
    $email=$_POST['email'];
    $password=$_POST['password'];
    $sql="SELECT * FROM signup WHERE email='$email' AND password='$password'";
    $verify=mysqli_query($conn, $sql);

    if(mysqli_num_rows($verify) == 1)
    {
      $row=mysqli_fetch_array($verify);
      $_SESSION['uid']=$row['id'];
      $_SESSION['name']=$row['name'];
        header('location:profile.php');
    }
    else
    {
        echo "Invalid email/password combination";
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <!-- Brand -->
        <a class="navbar-brand" href="index.php"><i class="fas fa-mobile-alt"></i> &nbsp;&nbsp; Mobile Bazar</a>
      
        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link " href="index.php">Products</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="signup.php">Signup</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="login.php">Login</a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link" href="cart.php">Cart<span id="cart-item" class="badge badge-danger"></span></a>
            </li>
          </ul>
        </div>
    </nav> 

    

    <form action="login.php" method="POST" id="login" name="login" onsubmit="return validateForm()">
        <div class="container">
          <h1>Login</h1>
          <p>Please fill in this form to logged in.</p>
          <hr>

          <label for="email"><b>Email</b></label>
          <input type="email" placeholder="Enter Email" name="email" id="email" width="50" >

          <label for="password"><b>Password</b></label>
          <input type="password" placeholder="Enter Password" name="password" id="password" width="50" >

          <button type="submit" name="submit" class="registerbtn">Login</button>
        </div>


        <script>
                document.getElementById('login').addEventListener('submit',submit);

                function submit(pd)
                {
                  pd.preventdefault();
                  var email =document.getElementById('email').value;
                  var password =document.getElementById('password').value;
                  var se="email="+email;
                  var pass="password="+password;

                  var req =new XMLHttpRequest();
                  req.open('POST','login.php',true);
                  req.setRequestHeader('content-type','application/x-www-form-urlencoded');
                  req.onload =function (){

                  }
                   req.send(se,pass);
                }

                function validateForm() {
                var x = document.forms["login"]["email"].value;
                var y = document.forms["login"]["password"].value;
                if (x == "" || y=="") {
                alert("Email or Password must be filled out");
               return false;
                 }
                } 
             </script>
      </form>
    
</body>
</html>