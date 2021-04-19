<?php
  require 'config.php';

  $grand_total =0;
  $allItems='';
  $items =array();

  $sql ="SELECT CONCAT(product_name,'(',quantity,')') AS itemqty,total_price FROM cart ";

  $stmt =$conn->prepare($sql);
  $stmt->execute();
  $result =$stmt->get_result();

  while($row =$result->fetch_assoc())
  {
      $grand_total +=$row['total_price'];
      $items[] =$row['itemqty'];
  }


  $allItems = implode(",",$items);


  require 'config.php';

if(isset($_POST['checkout']))  
{
    session_start();

    $mode=$_POST['payment_mode'];
    
     if($mode=='')
     {
      echo "Please Select payment method";
     }

    elseif($mode=='cod')
    {
        $name=$_POST['name'];
        $email=$_POST['email'];
        $phone=$_POST['phone'];
        $address=$_POST['address'];
        
        $sql="INSERT INTO checkout (name,email,phone,address,card_name,card_number) VALUES ('$name','$email','$phone','$address','NULL','NULL')";
        mysqli_query($conn,$sql);
        $_SESSION['name']=$name;
        $_SESSION['email']=$email;
        $_SESSION['phone']=$phone;
        $_SESSION['address']=$address;
        
        $_SESSION['card_name']=NULL;
        $_SESSION['card_number']=NULL;
        header('location:payment_success.php');
    }
    elseif($mode=='card')
    {
        header("location:card_payment.php");
    }

}
  

?>


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
        <a class="nav-link" href="signup.php">Signup</a>
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

 <div class="container">
     <div class="row justify-content-center">
         <div class="col-lg-6 px-4 pb-4">
             <h4 class="text-center text-info p-2">Complete your order</h4>
             <div class="jumbotron p-3 mb-2 text-center">
                 <h6 class="lead"><b>Product(s):</b><?= $allItems;?> </h6>
                 <h6 class="lead"><b>Delivery Charge: </b>Free</h6> 
                 <h5><b>Total Amount Payable : </b><?= number_format($grand_total,2) ?>/-</h5>
             </div>
             <form action="checkout.php" method="post" id="placeorder" name="placeorder" onsubmit="return validateForm()">
                 <input type="hidden" name="products" value="<?= $allItems;?>">
                 <input type="hidden" name="grand_total" value="<?= $grand_total;?>">
                <div class="form-group">
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name" >
                </div> 

                <div class="form-group">
                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email" >
                </div> 

                <div class="form-group">
                    <input type="tel" name="phone" id="phone" class="form-control" pattern="[0]{1}[1]{1}[0-9]{3}-[0-9]{6}" placeholder="Enter phone Number" >
                </div>

                <div class="form-group">
                    <textarea name="address" id="form-control" rows="3" cols="55" placeholder="Enter Address"></textarea>
                </div>
                <h6 class="text-center lead"> Select Payment Mode</h6>
                 <div class="form-group">
                     <select name="payment_mode" id="payment_method" class="form-control">
                         <option value=" " selected disabled>Select Payment Mode</option>
                         <option value="cod">Cash on Delivery</option>
                         <option value="card">Card Payment</option>

                     </select> 
                 </div>
                  <div class="form-group">
                      <input type="submit" name="checkout" value="place order" class="btn btn-danger btn-block"  >
                     
                      
                  </div>
             </form>
             <script>
                document.getElementById('placeorder').addEventListener('checkout',checkout);

                function checkout(pd)
                {
                  pd.preventdefault();
                  var name =document.getElementById('name').value;
                  var email =document.getElementById('email').value;
                  var phone =document.getElementById('phone').value;
                  var address =document.getElementById('form-control').value;
                  

                  var sn="name="+name;
                  var se="email="+email;
                  var sp="phone="+phone;
                  var sa="address="+address;
                  

                  var req =new XMLHttpRequest();
                  req.open('POST','checkout.php',true);
                  req.setRequestHeader('content-type','application/x-www-form-urlencoded');
                  req.onload =function (){

                  }
                   req.send(sn,se,sp,sa);
                }

                function validateForm() {
                  
                var x = document.forms["placeorder"]["email"].value;
                
                
                if (x == "") {
                alert("Email must be filled out");
               return false;
                 }
                }
                
             </script>
         </div>
     </div>

     
 </div>
  
   <!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
<script type="text/javascript">
  $(document).ready(function(){
      
      load_cart_item_number();
   
      function load_cart_item_number()
      {
          $.ajax(
              {
                  url: 'action.php',
                  method: 'get',
                  data: {cartItem: "cart_item"},
                  success:function(response)
                  {
                    $('#cart-item').html(response);
                  }
              });
      }
  

  });
</script>
</body>
</html>