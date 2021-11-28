<?php
    include('includes/db-config.php');
    if($_POST['barcode']==''){
        $productData =  mt_rand(10000000,99999999);
    }else{
        $productData = $_POST['barcode'];
    }
    $ProductName = $_POST["name"];
    $MRP = $_POST["price"];
    $manu=$_POST['manufacture'];
    $EXPDate = $_POST["expiry"];
    $unit = $_POST['unit'];
    $cgst = $_POST['cgst'];
    $sgst = $_POST['sgst'];
    $sellprice = $_POST['sellprice'];
    $sql="INSERT into items(barcode,name,expiry,manufacture,price,units,sgst,cgst,discount,sellprice) values('$productData','$ProductName','$EXPDate','$manu','$MRP','$unit','$sgst','$cgst',0,'$sellprice')";
    $conn->query($sql); 
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <div id="links"></div>
        <title>New product detail</title>
    </head>
    <body>
        <div class="w3-padding-32 w3-xlarge w3-center w3-blue">Product added</div>
        <div class="w3-row">
            <div class="w3-col l4">&nbsp;</div>
            <div class="w3-col l4 w3-center">
                <div class='w3-center w3-xlarge w3-padding-16'>Name: <?php echo $ProductName;?></div>
                <div class='w3-center w3-xlarge w3-padding-16'>Price: <?php echo number_format($sellprice);?> Rs</div>
                <div class='w3-center w3-xlarge w3-padding-16'>Expires on: <?php echo $EXPDate;?></div>
                <div class='w3-center w3-xlarge w3-padding-16'>SGST: <?php echo $sgst;?>%</div>
                <div class='w3-center w3-xlarge w3-padding-16'>CGST: <?php echo $cgst;?>%</div>
                <div class='w3-center w3-xlarge w3-padding-16'><img id="bar"></div>
                <div class='w3-center w3-padding-16'><a href="add-to-shop.htm">
                    <button class='w3-green w3-button w3-margin-right'>Add another product</button></a>
                    <a href="home.htm"><button class='w3-blue w3-button'>Return home</button></a></div>
            </div>
            <div class="w3-col l4">&nbsp;</div>
        </div>
        <script src="js/JsBarcode.all.min.js"></script>
        <script src="js/jquery-3.4.1.js"></script>
    <script>
        $(document).ready(function () {
            $('#links').load("includes/front-config.htm");
        });

        JsBarcode('#bar','<?php echo $productData; ?>');
    </script>
    </body>
    </html>
