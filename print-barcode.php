<?php
include('includes/db-config.php');
$products="SELECT * from items";
$product_query=mysqli_query($conn,$products);
$number_of_products=mysqli_num_rows($product_query);


if(isset($_GET['delete'])){
    $del=$_GET['delete'];
    $del_query="DELETE from items where id='$del'";
    if($conn->query($del_query)){
        header("location:remove.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <div id="links"></div>
    <title>Print barcode</title>
</head>

<body>
    <div class="w3-container w3-padding w3-xlarge w3-padding-16 w3-card w3-margin-bottom">Print barcodes</div>
    <div>
        <div class="w3-padding">
        <input type="text" class="w3-input w3-border w3-margin-bottom" id="search"
            Placeholder="Search for a product" oninput="search()">

        <div class="w3-responsive">
        <table class="w3-table-all w3-centered" id="myTable">
            <tr>
                <th>Product name</th>
                <th>Price</th>
                <th>Expiry date</th>
                <th>Operation</th>
            </tr>

            <?php

            while($row=mysqli_fetch_array($product_query)){
                $pname=$row['name'];
                $pprice=$row['sellprice'];
                $pexpire=$row['expiry'];
                $bid=$row['id'];
                $bcode=$row['barcode'];
                echo"
                    <tr>
                        <td>$pname</td>
                        <td>₹$pprice</td>
                        <td>$pexpire</td>
                        <td><a href='print-page.php?print=$bid'><button class='w3-button w3-blue'>Print barcodes</button></a></td>
                    </tr>

                ";
            }
            ?>
        </table>
        </div>
        </div>
    </div>
    <script src="js/jquery-3.4.1.js"></script>
    <script>
        $(document).ready(function () {
            $('#links').load("includes/front-config.htm");
        });
    
        function search() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("search");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
</body>

</html>