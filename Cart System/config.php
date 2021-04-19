<?php

$conn = mysqli_connect("localhost","root","","mobile_bazar");
if($conn->connect_error)
{
    die("connection failed!".$conn->connect_error);
}

?>