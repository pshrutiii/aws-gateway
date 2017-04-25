function calc_total(price){
    var sum = 0;
    $('.input-amount').each(function(){
        sum += parseFloat($(this).text());
    });
    $(".preview-total").text(sum.toFixed(2));    
}

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

$(document).on('click', '.input-remove-row', function(){ 
    var tr = $(this).closest('tr');
    tr.fadeOut(200, function(){
        tr.remove();
        calc_total()
    });
});

//adding items to the purchase list
$('.add-item').submit(function(){
    var form_data = {};
    form_data["quantity"] = parseFloat($('.payment-form input[name="quantity"]').val());
    form_data["name"] = $('.payment-form #name option:selected').text();
    form_data["milk"] = $('.payment-form #milk option:selected').text();
    form_data["size"] = $('.payment-form #size option:selected').text();
    form_data["location"] = $('.payment-form #location option:selected').text();
    form_data["amount"] = parseFloat(form_data["quantity"] * get_price($('.payment-form #size option:selected').text())).toFixed(2);
    form_data["remove-row"] = '<span class="glyphicon glyphicon-remove"></span>';
    form_data["edit-row"] = '<span class="glyphicon glyphicon-pencil"></span>';
    var row = $('<tr></tr>');
    $.each(form_data, function( type, value ) {
        $('<td class="input-'+type+'"></td>').html(value).appendTo(row);
    });
    $('.preview-table > tbody:last').append(row); 
    calc_total();
    return false;
});  
