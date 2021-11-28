<?php
session_start();
$id=$_SESSION['id'];
include('includes/db-config.php');
$pname=$_GET['name'];
$pprice=$_GET['price'];
$pprice=$_GET['price'];
$sellprice=$_GET['sellprice'];
$pexpire=$_GET['expiry'];
$pmanu=$_GET['manufacture'];

$sqll="UPDATE items set name='$pname',price='$pprice',manufacture='$pmanu',expiry='$pexpire',sellprice='$sellprice' where id='$id'";
if($conn->query($sqll)){
    header("Location:update-product.php");
}

?>