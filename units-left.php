<?php
include('includes/db-config.php');

$products="SELECT * from items where units<10";
$product_query=mysqli_query($conn,$products);
$number_of_products=mysqli_num_rows($product_query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <div id="links"></div>
    <title>Low stock items</title>
</head>

<body>
    <div class="w3-container w3-padding w3-xlarge w3-padding-16">Low stock products</div>
        <div class="w3-padding">
        <input type="text" class="w3-input w3-border w3-margin-bottom" id="search"
            Placeholder="Search for a product" oninput="search()">
            <div class="w3-responsive">
            <table class="w3-table-all w3-centered" id="myTable">
            <tr>
                <th>Product name</th>
                <th>Units left</th>
            </tr>

            <?php

            while($row=mysqli_fetch_array($product_query)){
                $pname=$row['name'];
                $punits=$row['units'];
                echo"
                    <tr>
                        <td>$pname</td>
                        <td>$punits</td>
                    </tr>

                ";
            }
            ?>
        </table>
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