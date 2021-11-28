<?php
include("../includes/db-config.php");
$bar = $_GET['bar'];
$query="SELECT * from items where barcode=$bar";
$result=mysqli_query($conn,$query);
$row = mysqli_fetch_assoc($result);
foreach($row as $r)
echo $r.",";
?>