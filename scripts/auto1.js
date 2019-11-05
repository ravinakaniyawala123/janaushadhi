/**
 * Site : http:www.smarttutorials.net
 * @author muni
 */
	      
//adds extra table rows
var i=$('table tr').length;

$(".addmore").on('click',function(){
	html = '<tr>';
	html += '<td><input class="case" type="checkbox"/></td>';
	html += '<td><select data-type="productName" name="itemName[]" id="itemName_'+i+'" data-row='+i+' class="js-data-example-ajax form-control "  required></select></td>';
	html += '<td><select data-type="productDis" name="productDis[]" id="productDis_'+i+'"  data-row='+i+' class="productDis form-control " autocomplete="off" required></select></td>';
	html += '<td><input type="number" min="0" step="0.01" name="amount[]" id="amount_'+i+'" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" required></td>';
	html += '<td><input type="number" min="0" step="1" name="discount[]" value="0" id="discount_'+i+'" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>';
	html += '<td><input type="number" min="0" step="1" name="quantity[]" id="quantity_'+i+'" class="form-control changesNo" oninvalid="setCustomValidity("Out of Stock Please Add Quantity in Medicine")" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" value="1" required></td>';
	html += '<td><input type="number" min="0" step="0.01" readonly name="total[]" id="total_'+i+'"  class="form-control totalLinePrice" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" required></td>';
	html += '</tr>';
	$('table').append(html);
  	i++;
  	
  	jQuery(".js-data-example-ajax").select2({
          ajax: {
           // url: "https://api.github.com/search/repositories",
            url: "process.php?get_medicine=true",
            dataType: 'json',
            data: function (params) {
            	var ids=[];
			  	jQuery( ".js-data-example-ajax" ).not(this).each(function() {
			        ids.push(jQuery(this).val());
			    });
			    //ids.splice(-1,1);
				return {
	                q: params.term, // search term
	                id: ids, // search term
	                page: params.page
              	};
            },
            processResults: function (data) {
                return {
                    results: $.map(data.items, function(obj) {
                        return { id: obj.id, text: obj.name };
                    })
                };
            }
        },
    });
      jQuery(".productDis").select2({
          ajax: {
            url: "process.php?get_desc=true",
            dataType: 'json',
            data: function (params) {
              var ids=[];
              jQuery( ".productDis" ).not(this).each(function() {
                ids.push(jQuery(this).val());
              });
              return {
                q: params.term, // search term
                page: params.page,
                id: ids,
              };
            },
            processResults: function (data) {
                return {
                    results: $.map(data.items, function(obj) {

                        return { id: obj.id, text: obj.discription };
                    })
                };
            }
        },
    });
});

//to check all checkboxes
$(document).on('change','#check_all',function(){
	$('input[class=case]:checkbox').prop("checked", $(this).is(':checked'));
});

//deletes the selected table rows
$(".delete").on('click', function() {
	$('.case:checkbox:checked').parents("tr").remove();
	$('#check_all').prop("checked", false); 
	calculateTotal();
});

//autocomplete script
$(document).on('focus','.autocomplete_txt',function(){
	type = $(this).data('type');
	
	if(type =='productCode' )autoTypeNo=0;
	if(type =='productName' )autoTypeNo=1; 	
	
	$(this).autocomplete({
		source: function( request, response ) {
			$.ajax({
				url : 'ajax.php',
				dataType: "json",
				method: 'post',
				data: {
				   name_startsWith: request.term,
				   type: type
				},
				 success: function( data ) {
					 response( $.map( data, function( item ) {
					 	var code = item.split("|");
						return {
							label: code[autoTypeNo],
							value: code[autoTypeNo],
							data : item
						}
					}));
				}
			});
		},
		autoFocus: true,	      	
		minLength: 0,
		select: function( event, ui ) {
			var names = ui.item.data.split("|");						
			id_arr = $(this).attr('id');
	  		id = id_arr.split("_");
			$('#itemNo_'+id[1]).val(names[0]);
			$('#itemName_'+id[1]).val(names[1]);
			$('#quantity_'+id[1]).val(1);
			$('#price_'+id[1]).val(names[2]);
			$('#total_'+id[1]).val( 1*names[2] );
			calculateTotal();
		}		      	
	});
});

//price change
$(document).on('change keyup blur','.changesNo',function(){
	
	id_arr = $(this).attr('id');
	id = id_arr.split("_");
	quantity = $('#quantity_'+id[1]).val();
	price = $('#amount_'+id[1]).val();
	dicount = $('#discount_'+id[1]).val();
	if( quantity!='' && price !='' ){
		var temp =  (parseFloat(price)*parseFloat(quantity)).toFixed(2);
		var with_discount = temp - ( temp *(dicount/100));
	 	$('#total_'+id[1]).val(with_discount);
	}	
	calculateTotal();
});

$(document).on('change keyup blur','#tax,#dicount',function(){
	calculateTotal();
});

//total price calculation 
function calculateTotal(){
	subTotal = 0 ; total = 0; 
	$('.totalLinePrice').each(function(){
		if($(this).val() != '' )subTotal += parseFloat( $(this).val() );
	});
	$('#subTotal').val( subTotal.toFixed(2) );
	tax = $('#tax').val();
	if(tax != '' && typeof(tax) != "undefined" ){
		taxAmount = subTotal * ( parseFloat(tax) /100 );
		$('#taxAmount').val(taxAmount.toFixed(2));
		total = subTotal + taxAmount;
	}else{
		$('#taxAmount').val(0);
		total = subTotal;
	}
	// dicount = $('#dicount').val();
	// if(dicount != '' && typeof(dicount) != "undefined" ){
	// 	total = total - (total*(dicount/100));
	// }
	$('#totalAftertax').val(total.toFixed(2));
	calculateAmountDue();
}

$(document).on('change keyup blur','#amountPaid',function(){
	calculateAmountDue();
});

//due amount calculation
function calculateAmountDue(){
	amountPaid = $('#amountPaid').val();
	total = $('#totalAftertax').val();
	if(amountPaid != '' && typeof(amountPaid) != "undefined" ){
		amountDue = parseFloat(total) - parseFloat( amountPaid );
		$('.amountDue').val( amountDue.toFixed(2) );
	}else{
		total = parseFloat(total).toFixed(2);
		$('.amountDue').val( total );
	}
}


//It restrict the non-numbers
var specialKeys = new Array();
specialKeys.push(8,46); //Backspace
function IsNumeric(e) {
    var keyCode = e.which ? e.which : e.keyCode;
    //console.log( keyCode );
    var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
    return ret;
}

//datepicker
$(function () {
   // $('#invoiceDate').datepicker({});
});