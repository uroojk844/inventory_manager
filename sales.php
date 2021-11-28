<!DOCTYPE html>
<html lang="en">

<head>
    <div id="links"></div>
    <title>Sales report</title>
    <style>
        .w3-xlarge,
        .w3-jumbo {
            font-family: cambria;
        }

        .w3-card {
            overflow: hidden;
        }
    </style>
</head>

<body>
    <div class="w3-container w3-padding w3-xlarge w3-padding-16 w3-card w3-margin-bottom">Sales report</div>
    <div class="w3-padding">
        <div class="w3-bar w3-border w3-margin-bottom">
            <div class="w3-padding w3-large w3-left">Select a date to statistics </div>
            <input type="date" class="w3-button w3-right w3-hover-none" id="date">
        </div>
        <?php
        
        ?>

        <div class="w3-row-padding">
            <div class="w3-col w3-third w3-margin-bottom">
                <div class=" w3-center w3-card w3-round">
                    <div class="w3-jumbo w3-padding-24"><i class="fas fa-rupee-sign"></i> <span id="buy">0</span>
                    </div>
                    <div class="w3-padding w3-xlarge w3-black">
                        Total Buy
                    </div>
                </div>
            </div>
            <div class="w3-col w3-third w3-margin-bottom">
                <div class=" w3-center w3-card w3-round">
                    <div class="w3-jumbo w3-padding-24"><i class="fas fa-rupee-sign"></i> <span id="sell">0</span>
                    </div>
                    <div class="w3-padding w3-xlarge w3-black">
                        Total Sell
                    </div>
                </div>
            </div>
            <div class="w3-col w3-third w3-margin-bottom">
                <div class=" w3-center w3-card w3-round">
                    <div class="w3-jumbo w3-padding-24"><i class="fas fa-rupee-sign"></i> <span id="discount">0</span>
                    </div>
                    <div class="w3-padding w3-xlarge w3-black">
                        Total Discount
                    </div>
                </div>
            </div>
            <div class="w3-col w3-third w3-margin-bottom">
                <div class=" w3-center w3-card w3-round">
                    <div class="w3-jumbo w3-padding-24"><i class="fas fa-rupee-sign"></i> <span id="profit">0</span>
                    </div>
                    <div class="w3-padding w3-xlarge w3-green">
                        Total Profit
                    </div>
                </div>
            </div>
            <div class="w3-col w3-third w3-margin-bottom">
                <div class=" w3-center w3-card w3-round">
                    <div class="w3-jumbo w3-padding-24"><i class="fas fa-rupee-sign"></i> <span id="loss">0</span>
                    </div>
                    <div class="w3-padding w3-xlarge w3-red">
                        Total Loss
                    </div>
                </div>
            </div>
            <div class="w3-col w3-third w3-margin-bottom">
                <div class=" w3-center w3-card w3-round">
                    <div class="w3-jumbo w3-padding-24"><i class="fas fa-rupee-sign"></i> <span id="cgst">0</span>
                    </div>
                    <div class="w3-padding w3-xlarge w3-yellow">
                        Total CGST
                    </div>
                </div>
            </div>
            <div class="w3-col w3-third w3-margin-bottom">
                <div class=" w3-center w3-card w3-round">
                    <div class="w3-jumbo w3-padding-24"><i class="fas fa-rupee-sign"></i> <span id="sgst">0</span>
                    </div>
                    <div class="w3-padding w3-xlarge w3-yellow">
                        Total SGST
                    </div>
                </div>
            </div>
            <div class="w3-col w3-third w3-margin-bottom">
                <div class=" w3-center w3-card w3-round">
                    <div class="w3-jumbo w3-padding-24"><i class="fas fa-rupee-sign"></i> <span id="gst">0</span>
                    </div>
                    <div class="w3-padding w3-xlarge w3-blue">
                        Total GST
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery-3.4.1.js"></script>
    <script>
        $('#links').load("includes/front-config.htm");

        let date = new Date();
        let d = date.getDate();
        var m = date.getMonth();
        let y = date.getFullYear();
        m += 1;
        if (m.toString().length < 2) {
            m = '0' + m;
        }
        if (d.toString().length < 2) {
            d = '0' + d;
        }
        $('#date').val(y + "-" + m + "-" + d);
        $('#date').change(function (e) {
            getValue();
        });

        function getValue() {
            $.ajax({
                url: "salesreport.php?date=" + $('#date').val(),
                dataType: "text",
                success: function (response) {
                    var arr = response.split(",");
                    $('#buy').text(arr[0]);
                    $('#sell').text(arr[1]);
                    $('#profit').text(arr[2]);
                    $('#loss').text(arr[3]);
                    $('#discount').text(arr[4]);
                    $('#cgst').text(arr[5]/2);
                    $('#sgst').text(arr[5]/2);
                    $('#gst').text(arr[5]);
                }
            });
        }

        getValue();
    </script>
</body>

</html>