<?php
include('includes/db-config.php');
$date = $_GET['date'];
$date = date_create($date);
$date = date_format($date,"j/n/Y");
$sql="SELECT * from cart where date='$date'";
$res=mysqli_query($conn,$sql);
$price = 0;
$sell = 0;
$profit = 0;
$loss = 0;
$discount = 0;
$totalGst = 0;
while($row=mysqli_fetch_assoc($res)){
    $price += $row['price']*$row['units'];
    $total = $row['sellprice']*$row['units']; 
    $sell += $total-$row['discount'];
    $discount += $row['discount'];
    $totalGst += (($price*$row['gst'])/100);
    if($price>$sell){
        $loss = $price-$sell;
    }
    if($price<$sell){
        $profit = $sell-$price;
    }
}
$arr = "$price,$sell,$profit,$loss,$discount,$totalGst";
    echo $arr;
?>