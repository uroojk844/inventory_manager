<?php
include('includes/db-config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <div id="links"></div>
    <title>Print barcode</title>
</head>

<body>
    <?php
    if(isset($_GET['print'])){
        $id=$_GET['print'];
        $sql="SELECT * from items where id='$id'";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_array($result);

        $barcode=$row['barcode'];
        $name=$row['name'];
        $sellprice = $row['sellprice'];
    }
    ?>
    <div class="w3-bar w3-xlarge w3-margin-bottom w3-card">
        <div class="w3-bar-item">Print barcode</div>
        <div class="w3-bar-item w3-button w3-ripple w3-right w3-border-left" id="printBtn">Print now</div>
    </div>

    <div class="w3-bar w3-large">
        <div class="w3-bar-item">Amount</div>
        <input type="number" id="printAmount" value="1" class="w3-input w3-border w3-right w3-margin-right"
            style="width:80px;">
    </div>

    <div class='w3-row-padding w3-section' id="container">
        <div class='w3-col l3 s12 m3 w3-margin-bottom'>
            <div class='w3-center w3-padding w3-border'>
            <div >INM - <?php echo $name; ?></div>    
            <img id='bar' class='w3-image'>
                <div>MRP. <?php echo $sellprice; ?></div>
            </div>
        </div>
    </div>
    <script src="js/jquery-3.4.1.js"></script>
    <script src="js/JsBarcode.all.min.js"></script>
    <script>
        JsBarcode('#bar', '<?php echo $barcode; ?>', {
            width: 4,
            fontSize: 28
        });

        $(document).ready(function () {
            $('#links').load("includes/front-config.htm");

            let amount = document.querySelector('#printAmount');
            amount.addEventListener("change", function () {
                document.querySelector('#container').innerHTML = "";
                for (let i = 0; i < amount.value; i++) {
                    let d1 = document.createElement("div");
                    let d2 = document.createElement("div");
                    let d3 = document.createElement("div");
                    let i1 = document.createElement("img");
                    d1.setAttribute('class', 'w3-col l3 s12 m3');
                    d2.setAttribute('class', 'w3-center w3-padding w3-border w3-margin-bottom');
                    i1.setAttribute('class', 'w3-image');
                    i1.id = 'bar';
                    d3.innerHTML = '<?php echo $name; ?>';
                    d2.append(i1);
                    d2.append(d3);
                    d1.append(d2);
                    document.querySelector('#container').append(d1);
                    JsBarcode('#bar', '<?php echo $barcode; ?>', {
                        width:4,
                        fontSize: 28
                    });
                }
            });

            $('#printBtn').click(()=> {
                $('.w3-bar').hide();
                window.print();
                $('.w3-bar').show();
            });

        });
    </script>
</body>

</html>