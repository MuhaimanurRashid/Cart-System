<?php
 include "config.php";

 if(isset($_POST['submit']))

 {
   session_start();
   $name=$_POST['name'];
   $email=$_POST['email'];
   $password=$_POST['password'];
   $phone=$_POST['phone'];
   $address=$_POST['address'];
   
   $cname=$_POST['cardname'];
   $cnumber=$_POST['cardnumber'];

   $sql="INSERT INTO signup (name,email,password,phone,address,card_name,card_number) VALUES ('$name','$email','$password','$phone','$address','$cname','$cnumber')";
   mysqli_query($conn,$sql);

   $_SESSION['name']=$name;
   $_SESSION['email']=$email;
   $_SESSION['password']=$password;
   $_SESSION['phone']=$phone;
   $_SESSION['address']=$address;
   $_SESSION['card_name']=$cname;
   $_SESSION['card_number']=$cnumber;
   header("location: index.php");
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
    <title>Signup</title>
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
              <a class="nav-link active" href="signup.php">Signup</a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link" href="cart.php">Cart <span id="cart-item" class="badge badge-danger"></span></a>
            </li>
          </ul>
        </div>
      </nav> 



    <form action="signup.php" method="POST" id="signup" name="signup" onsubmit="return validateForm()">
        <div class="container">
          <h1>Signup</h1>
          <p>Please fill in this form to create an account.</p>
          <hr>

          <label for="name"><b>Name</b></label>
          <input type="text" placeholder="Enter Name" name="name" id="name" required >
      
          <label for="email"><b>Email</b></label>
          <input type="email" placeholder="Enter Email" name="email" id="email" >
      
          <label for="password"><b>Password</b></label>
          <input type="password" placeholder="Enter Password" name="password" id="password" >

          <label for="phone"><b>Phone</b></label>
          <input type="tel" placeholder="Enter Phone Number(01XXX-XXXXXX)" pattern="[0]{1}[1]{1}[0-9]{3}-[0-9]{6}" name="phone" id="phone" required>

          <label for="address"><b>Address</b></label>
          <textarea name="address" id="form-control" rows="3" cols="55" placeholder="Enter Address"></textarea>

          <label for="card_name"><b>Card Name</b></label>
          <input type="text" placeholder="Enter Card Name" name="cardname" id="cardname" >

          <label for="card_number"><b>Card Number</b></label>
          <input type="text" placeholder="Enter Card Number(XX-XX-XX)" pattern="[0-9]{2}-[0-9]{2}-[0-9]{2}" name="cardnumber" id="cardnumber" >
      
          
      
          <button type="submit" name="submit" class="registerbtn">Submit</button>
        </div>

        <script>
                document.getElementById('signup').addEventListener('submit',submit);

                function submit(pd)
                {
                  pd.preventdefault();
                  var name =document.getElementById('name').value;
                  var email =document.getElementById('email').value;
                  var password =document.getElementById('password').value;
                  var phone =document.getElementById('phone').value;
                  var address =document.getElementById('form-control').value;
                  
                  var card_name =document.getElementById('cardname').value;
                  var card_number=document.getElementById('cardnumber').value;

                  var sn="name="+name;
                  var se="email="+email;
                  var pass="password="+password
                  var sp="phone="+phone;
                  var sa="address="+address;
                  
                  var cn ="card_name="+card_name;
                  var cnum="card_number="+card_number;

                  var req =new XMLHttpRequest();
                  req.open('POST','signup.php',true);
                  req.setRequestHeader('content-type','application/x-www-form-urlencoded');
                  req.onload =function (){

                  }
                   req.send(sn,se,pass,sp,sa,cn,cnum);
                }

                function validateForm() {
                var x = document.forms["signup"]["email"].value;
                var y = document.forms["signup"]["password"].value;
                var z = document.forms["signup"]["cardname"].value;
                var a = document.forms["signup"]["cardnumber"].value;
                if (x == "" || y=="" || z=="" || a=="")
                 {
                  alert("Email,Password,cardname,cardnumber  must be filled out");
                  return false;
                 }
                 
                }
             </script>
      
        <div class="container signin">
          <p>Already have an account? <a href="login.php">Sign in</a>.</p>
        </div>
      </form> 
    
</body>
</html>
