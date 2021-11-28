<?php
include('includes/db-config.php');
$pass = bin2hex($_GET['pass']);
$sql = "SELECT password from users where username='database' and password='$pass'";
$res = $conn->query($sql);
if($res->num_rows>0){
    echo True;
}
?>