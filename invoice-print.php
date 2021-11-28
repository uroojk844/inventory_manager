<!DOCTYPE html>
<html lang="en">

<head>
    <div id="links"></div>
    <title>Print receipt</title>
    <link rel="stylesheet" href="includes/w3.css">
    <style>
        #receipt {
            position: relative;
            left: 50%;
            transform: translateX(-50%);
            font-family: "cambria";
        }

        pre {
            margin: 0 8px;
        }
    </style>
</head>

<body>
    <?php
    error_reporting(0);
    $items = json_decode($_POST['items']);
    $barcodes = json_decode($_POST['barcodes']);
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $mode = $_POST['mode'];
    $total = $_POST['total'];
    ?>
    <div class="w3-hide">
    <?php
    $rows = count($items)/10;
    ?>
    </div>
    <?php
    $date = $_POST['date'];
    $amount = $_POST['amount'];
    include("includes/db-config.php");
    $sql = "SELECT * FROM customer where phone='$phone'";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($res);
    if(count($row)>3){
        $sql2 = "UPDATE customer SET lastVisit='$date' where phone='$phone'";
        $conn->query($sql2);
    }else{
        $sql1 = "INSERT into customer(lastVisit,name,phone,email,mode) values('$date','$name','$phone','$email','$mode')";
        $conn->query($sql1);
    }
    ?>
    <div class="w3-bar w3-card w3-margin-bottom">
        <div class="w3-bar-item w3-padding-16 w3-large">Print invoice</div>
        <div class="w3-bar-item w3-padding-16 w3-large w3-button w3-right w3-border-left" id="printBtn" accesskey="p">Print now</div>
    </div>
    <?php
    $sql5 = "SELECT phone from customer where name='receiptno'";
    $res = $conn->query($sql5);
    $row1 = mysqli_fetch_array($res);
    $conn->query("UPDATE customer set phone=phone+1 where name='receiptno'");
    ?>
    <div class="" id="receipt" style="width:80mm">
        <div class="w3-wide w3-center"><b class="w3-large">INDIA NEW MART</b><br>INVOICE <br></div>
        <div class="w3-center"><b>Phone:</b> +918686404037</div>
        <div class="w3-center"><b>Email:</b> indianewmart@gmail.com</div>
        <div class="w3-center"><b>Address:</b><span style="font-size:13px"> KAKHRAHWA ROAD MOHANA
                MADHUBANSI SIDDHARTH NAGAR</span></div>
        <div class="w3-center w3-margin-bottom">GST No. : 09CPMPR7741LIZY</div>
        <div class="w3-row" style="margin-bottom: 8px">
            <div class="w3-col s7">Bill No. : INM<?php echo $row1[0]; ?> </div>
            <div class="w3-col s5">Date : <?php echo $date; ?> </div>
            <div class="w3-col s7">Payment Mode : <?php echo $mode; ?></div>
            <div class="w3-col s5">Time : <span id="time"></span></div>
        </div>
        <table class="w3-table w3-margin-bottom w3-border-top w3-border-bottom">
            <tr>
                <td>S.No.</td>
                <td>Name</td>
                <td>Qty</td>
                <td>MRP</td>
                <td>RATE</td>
                <td>TOTAL</td>
            </tr>
            <?php
            $totalDisc = 0;
            $totalQty = 0;
            $diff = 0;
            for($r=1; $r<=$rows; $r++){
                $iname = $items[$r*10-10];
                $iqty = $items[$r*10-9];
                $iprice = $items[$r*10-1];
                $idisc = $items[$r*10-6];
                $sell = $items[$r*10-8];
                $gst = $items[$r*10-4]*2;
                $totalQty += $iqty; 
                $diff = $sell-$items[$r*10-5];
                $totalDisc += ($diff*$iqty);
            ?>
            <tr>
                <td><?php echo $r."."; ?></td>
                <td><?php echo $iname; ?></td>
                <td><?php echo $iqty; ?></td>
                <td><?php echo $sell; ?></td>
                <td><?php echo $items[$r*10-5]; ?></td>
                <td><?php echo $items[$r*10-2]; ?></td>
            </tr>
            <?php
            $index = $r-1;
            $sql3 = "INSERT into cart(barcode,name,price,units,discount,sellprice,date,gst) values('$barcodes[$index]','$iname', $iprice,'$iqty','$idisc','$sell','$date','$gst')";
            $conn->query($sql3);
            $sql4 = "UPDATE items SET units=units-'$iqty' where barcode='$barcodes[$index]'";
            $conn->query($sql4);
            }
            ?>
        </table>
            <div class="w3-row w3-border-bottom">
            <div class="w3-col s6"><b> Total Qty: </b><?php echo $totalQty; ?> </div>
            <div class="w3-col s6"><b> Total disc: </b><?php echo $totalDisc; ?> Rs</div>
            <div class="w3-col s6"><b> Amt rcvd: </b><?php echo $amount; ?> Rs</div>
            <div class="w3-col s6" style="font-size:18px"><b> Grand-Total:</b><b><?php echo $total; ?> Rs</b></div>
            <?php
            if($amount>$total){
                ?>
            <div class="w3-col s6"><b> Amt return:</b><?php echo $amount-$total; ?> Rs</div>
            <?php
            }
            ?>
            <?php
            if($amount<$total){
                ?>
            <div class="w3-col s6"><b> Balance amt:</b><?php echo $total-$amount; ?> Rs</b></div>
            <?php
            }
            ?>
            <div class="w3-col s12 w3-center"><b>Total Disc. included in this bill is <?php echo $totalDisc; ?>.</b></div>
        </div>
        <div class="w3-center" style="margin-bottom: 4px"><b>Phone:</b> <?php echo $phone; ?></div>
        <div class="w3-center"><b>***THANKS FOR SHOPPING!!***</b></div>
        <div class="w3-center"><b>Return & Exchange Policy</b></div>
        <div class="w3-center">Exchange & Return is allowed within <b>2 days</b> of <i>cloth</i> items 
            and <b>no</b> <i> Plastic</i> items, any <i>food</i> items and any <i>cosmetic</i> items.
        </div>
    </div>
    <script src="js/jquery-3.4.1.js"></script>
    <script>
        var d = new Date();
        h = d.getHours();
        m = d.getMinutes();
        s = d.getSeconds();
        $('#time').text(h+":"+m+":"+s);
        $('#printBtn').click(function (e) {
            $('.w3-bar').hide();
            window.print();
            $('.w3-bar').show();
        });
    </script>
</body>

</html>