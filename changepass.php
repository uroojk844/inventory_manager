<?php
include("includes/db-config.php");
$tab = $_POST['tab'];
$pass = bin2hex($_POST['pass']);
$loc = "";
if($tab=='login'){
    $sql = "UPDATE users set password='$pass' where id='1'";
    $loc = 'index.htm';
}else{
    $sql = "UPDATE users set password='$pass' where id='2'";
    $loc = 'home.htm';
}
if($conn->query($sql)){
    header('location: '.$loc);
}
?>