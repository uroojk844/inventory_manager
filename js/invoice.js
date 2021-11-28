var x = 0;
var barcodes = [];
$("#addBtn").click(function (e) {
  var items = [];
  $.ajax({
    url: "js/product.php?bar=" + $('#barcode').val(),
    method: "post",
    success: function (response) {
      items = response.split(",");
      let price = items[10];
      let quatity = 1;
      let mrp = items[5];
      let disc = items[9];
      let discAmt = (price * disc) / 100;
      let netAmt = price - discAmt;
      let cgst = items[7];
      let sgst = items[8];
      let tr = $("<tr class='tr" + x + "'></tr>");
      let td1 = $("<td></td>").html($("<input class='w3-input w3-border' type='text' />").val(items[2]));
      let td2 = $("<td></td>").html($("<input class='w3-input w3-border qty' type='number' />").val(quatity));
      let td3 = $("<td></td>").html($("<input class='w3-input w3-border mrp' type='number' />").val(price));
      let td4 = $("<td></td>").html($("<input class='w3-input w3-border desc' type='number' />").val(disc));
      let td5 = $("<td></td>").html($("<input class='w3-input w3-border descAmt' type='number' />").val(discAmt));
      let td6 = $("<td></td>").html($("<input class='w3-input w3-border netAmt' type='number' />").val(netAmt));
      let td7 = $("<td></td>").html($("<input class='w3-input w3-border cgst' type='number' />").val(cgst));
      let td8 = $("<td></td>").html($("<input class='w3-input w3-border sgst' type='number' />").val(sgst));
      let td9 = $("<td></td>").html($("<input class='w3-input w3-border total' type='number' />").val(quatity * netAmt));
      let td10 = $("<td></td>").html($("<div class='w3-button w3-red deleteBtn'><i class='fas fa-trash'></i></div>"));
      let td11 = $("<td class='w3-hide'></td>").html($("<input class='w3-input w3-border orgmrp' type='hidden' />").val(mrp));
      tr.append(td1, td2, td3, td4, td5, td6, td7, td8, td9, td10, td11);
      $('#table tbody').append(tr);
      x++;
      barcodes.push($('#barcode').val());
      subtotol();
      $('#barcode').val("");
    }
  });
});

$("#table").on('click', '.deleteBtn', function () {
  $(this).closest('tr').remove();
  barcodes.pop();
  subtotol();
});

$("#table").on('change', 'input', function () {
  let qty = $("." + $(this).closest('tr').attr('class') + " td .qty").val();
  let desc = $("." + $(this).closest('tr').attr('class') + " td .desc").val();
  let price = $("." + $(this).closest('tr').attr('class') + " td .mrp").val();
  let descAmt = $("." + $(this).closest('tr').attr('class') + " td .descAmt").val();
  descAmt = (price * desc)/100;
  netAmt = price-descAmt;
  descAmt *= qty; 
  let total = qty*netAmt;
  $("." + $(this).closest('tr').attr('class') + " td .total").val(total.toFixed(2));
  $("." + $(this).closest('tr').attr('class') + " td .descAmt").val(descAmt.toFixed(2));
  $("." + $(this).closest('tr').attr('class') + " td .netAmt").val(netAmt.toFixed(2));
  subtotol();
});

function subtotol(){
  let gtotal = 0;
  $('#table tr td .total').each(function(){
    gtotal+=Number($(this).val());
  });
  $('#totalInput').val(gtotal);
  $('#gtotal').text(gtotal.toFixed(2));
  $('#barcodes').val(JSON.stringify(barcodes));
}
