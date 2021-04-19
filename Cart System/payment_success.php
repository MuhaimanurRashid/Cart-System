<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        footer{
          text-align: center;
        }

    </style>
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
        <a class="nav-link active" href="checkout.php">Checkout</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="cart.php">Cart <span id="cart-item" class="badge badge-danger"></span></a>
      </li>
    </ul>
  </div>
</nav> 

<p><br></p>
   <p><br></p>
   

      <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-8">
          <div class="panel-panel-default">
           <div class="panel-heading"></div> 
           <div class="panel-body">
               <h1>Thankyou </h1>
               <hr>
               <p>Hello 

               <?php 
                session_start();
                
                    echo $_SESSION['email'];

                ?>
                 
                 ,Your payment is successfully completed. <br>You can continue your shopping <br></p>
               <a href="index.php" class="btn btn-success btn-lg">Continue Shopping</a>
           <div class="panel-footer"></div>  
          </div>
      </div>

       <div class="col-md-2"></div>

           
     </body>
 </html>