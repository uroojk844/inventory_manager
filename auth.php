<?php
include("includes/db-config.php");
$user = $_POST['user'];
$pass = bin2hex($_POST['pass']);
$sql = "SELECT * from users where username='$user' and password='$pass'";
$res = $conn->query($sql);
$row = count(mysqli_fetch_array($res));
if($row>2){
    header("location: home.htm");
}else{
    header("location: index.htm");
}
?>