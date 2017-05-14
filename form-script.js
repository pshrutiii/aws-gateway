//Calculate total cost for an order
function calc_total(price){
    var sum = 0;
    $('.input-amount').each(function(){
        sum += parseFloat($(this).text());
    });
    $(".preview-total").text(sum.toFixed(2));    
}

//Calculate price for each drink
function get_price(size){
    var price = 0;
    if (size==="Short"){
        price = 1.85;
    }else if(size === "Tall"){
        price = 2.95;
    }else if(size === "Grande"){
        price = 3.65;
    }else{
        price = 4.15;
    }
    return price;
}

//Getting order info
$('.order-now').submit(function(){
    order = {}
    order['location'] = $('#location').val();
    order['items'] = [];
    var totalCost;
    $('.preview-table tr').each(function(i, row) {
      o = {}
      o['qty'] = $(row).find('.input-quantity').html();
      o['name'] = $(row).find('.input-name').html();
      o['milk'] = $(row).find('.input-milk').html();
      o['size'] = $(row).find('.input-size').html();
      totalCost = parseFloat($('.preview-total').text());
      if (o['qty'] != undefined) {
        order['amount'] = totalCost;
        order['items'].push(o);
      }
    });

    //console.log(JSON.stringify(order));
    var data = JSON.stringify(order);
    $.post( "post.php", {Orderdata: data}, function(response) {
      $(".result" ).html(response);
    });
    alert("Your order has been PLACED!");
    return false;
});


//Remove items from the order
$(document).on('click', '.input-remove-row', function(){ 
    var tr = $(this).closest('tr');
    tr.fadeOut(200, function(){
        tr.remove();
        calc_total()
    });
});

//adding items to the order
$('.add-item').submit(function(){
    var form_data = {};
    form_data["quantity"] = parseFloat($('.payment-form input[name="quantity"]').val());
    form_data["name"] = $('.payment-form #name option:selected').text();
    form_data["milk"] = $('.payment-form #milk option:selected').text();
    form_data["size"] = $('.payment-form #size option:selected').text();
    form_data["amount"] = parseFloat(form_data["quantity"] * get_price($('.payment-form #size option:selected').text())).toFixed(2);
    form_data["remove-row"] = '<span class="glyphicon glyphicon-remove"></span>';
    var row = $('<tr></tr>');
    $.each(form_data, function( type, value ) {
        $('<td class="input-'+type+'"></td>').html(value).appendTo(row);
    });
    $('.preview-table > tbody:last').append(row); 
    calc_total();

    return false;
}); 