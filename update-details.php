<?php
include('includes/db-config.php');
if(isset($_GET['id'])){
    session_start();
    $_SESSION['id']=$_GET['id'];
    $id=$_SESSION['id'];
}

$sql="SELECT * from items where id='$id'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);

$name=$row['name'];
$price=$row['price'];
$sellprice=$row['sellprice'];
$expiry=$row['expiry'];
$manufacture=$row['manufacture'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <div id="links"></div>
    <title>Update detail</title>
</head>

<body>
    <div class="w3-container w3-padding w3-xlarge w3-padding-16 w3-card">Update product details</div>
    <div class="w3-row">
        <div class="w3-col l4">&nbsp;</div>
        <div class="w3-col l4 w3-padding">
            <div class="w3-padding-16 w3-xlarge">Change the product details</div>
            <form action="update-process.php">
                <p class="w3-margin-top">
                    <label for="">Product name</label>
                    <input type="text" class="w3-input w3-border" name="name" value='<?php echo $name;?>'>
                </p>
                <p class="w3-margin-top">
                    <label for="">Product buying price</label>
                    <input type="text" class="w3-input w3-border" name="price" value='<?php echo $price;?>'>
                </p>
                <p class="w3-margin-top">
                    <label for="">Product selling price</label>
                    <input type="text" class="w3-input w3-border" name="sellprice" value='<?php echo $sellprice;?>'>
                </p>
                <p class="w3-margin-top">
                    <label for="">Product expiration date</label>
                    <input type="date" class="w3-input w3-border" name="expiry" value='<?php echo $expiry;?>'>
                </p>
                <p class="w3-margin-top">
                    <label for="">Product manufacturing date</label>
                    <input type="date" class="w3-input w3-border" name="manufacture"  value='<?php echo $manufacture;?>'>
                </p>
                <button class="w3-button w3-blue w3-margin-top" name="update">Update</button>
            </form>
        </div>
        <div class="w3-col l4">&nbsp;</div>
    </div>
    <script src="js/jquery-3.4.1.js"></script>
    <script>
        $(document).ready(function () {
            $('#links').load("includes/front-config.htm");
        });
    </script>
</body>

</html>
