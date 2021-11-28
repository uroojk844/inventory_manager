<?php
$conn=mysqli_connect("localhost","root","","billing");
    if(!$conn){
        echo "Cannot connect to the database";
    }
?>