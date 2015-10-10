jQuery(document).ready(function(){
	
	jQuery("#edit_patient").validate({
		rules: {
			admission: "required",
			name: "required",
			email: {
				required: true,
				email: true,
			},
			age: "required",
			gender: "required"
		},
		messages: {
			admission: "Please enter the admission number",
			name: "Please enter the name",
			email: "Please enter a valid email address",
			age: "Please enter the age",
			gender: "Please enter the gender"
		},
		highlight: function(label) {
			jQuery(label).closest('.control-group').addClass('error');
	    },
	    success: function(label) {
	    	label
	    		.text('').addClass('valid')
	    		.closest('.control-group').addClass('success');
	    },
		showErrors: function(errorMap, errorList) {
			this.defaultShowErrors();
			jQuery.colorbox.resize();
		},
		submitHandler: function(form){
			form.submit();
			jQuery.colorbox.close();
		}
	});
	
	jQuery("#edit_doctor").validate({
		rules: {
			name: "required",
			mobile: {
				required: true,
				number: true,
			},
			username: "required",
			password: {
				required: true,
				minlength: 5
			},
			cpassword: {
				required: true,
				minlength: 5,
				equalTo: "#password"
			},	
		},
		messages: {
			name: "Please enter the name",
			mobile: {
				required: "Please enter your mobile number",
				number: "Please enter a valid mobile number"
			},
			username: "Please enter the username",
			password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long"
			},
			cpassword: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long",
				equalTo: "Please enter the same password as above"
			},
		},
		highlight: function(label) {
			jQuery(label).closest('.control-group').addClass('error');
	    },
	    success: function(label) {
	    	label
	    		.text('').addClass('valid')
	    		.closest('.control-group').addClass('success');
	    },
		showErrors: function(errorMap, errorList) {
			this.defaultShowErrors();
			jQuery.colorbox.resize();
		},
		submitHandler: function(form){
			form.submit();
			jQuery.colorbox.close();
		}
	});
	
	jQuery("#edit_case").validate({
		rules: {
			doctor: "required",
			patient: "required",
			/*diseas: "required",*/
		},
		messages: {
			doctor: "Please enter the doctor name",
			patient: "Please enter the patient admission no.",
			/*diseas: "Please enter the diseas name"*/
		},
		highlight: function(label) {
			jQuery(label).closest('.control-group').addClass('error');
	    },
	    success: function(label) {
	    	label
	    		.text('').addClass('valid')
	    		.closest('.control-group').addClass('success');
	    },
		showErrors: function(errorMap, errorList) {
			this.defaultShowErrors();
			jQuery.colorbox.resize();
		},
		submitHandler: function(form){
			form.submit();
			jQuery.colorbox.close();
		}
	});
	
	jQuery("#edit_products").validate({
		rules: {
			name: "required",
			stock_type: "required",
			stock_count: "required",
			min_count: "required",
			price: "required"
		},
		messages: {
			name: "Please enter the product name",
			stock_type: "Please enter the stock type",
			stock_count: "Please enter the stock count",
			min_count: "Please enter the minimum stock count needed",
			price: "Please enter the price"
		},
		highlight: function(label) {
			jQuery(label).closest('.control-group').addClass('error');
	    },
	    success: function(label) {
	    	label
	    		.text('').addClass('valid')
	    		.closest('.control-group').addClass('success');
	    },
		showErrors: function(errorMap, errorList) {
			this.defaultShowErrors();
			jQuery.colorbox.resize();
		},
		submitHandler: function(form){
			form.submit();
			jQuery.colorbox.close();
		}
	});
	
	jQuery(".chzn-select").chosen();
	
	$('#medicine_add').click(function(){
		var next_product_id = $("#new_product_id").val();
		next_product_id = parseInt(next_product_id) + 1;
		$("#new_product_id").val(next_product_id);
		var params = "next_product_id="+next_product_id;
		$.ajax({
			type: "POST",
			url: "pravega_action.php",
			data: params,
			dataType: "html",
			success: function(data) {
				if($.trim(data) != '') {
					$('#order_edit_add tbody').append(data);
					$('#select_'+next_product_id).chosen();
					$('#select_'+next_product_id+'_chzn').css("width", "254px");
					$( ".admin_product_remove" ).unbind('click');
					$( ".admin_product_remove" ).bind({		
						click: function() {			
							var row_id = $(this).attr('row_id');
							admin_product_remove(row_id);
						}
					});	
					$( ".get_price" ).unbind('keyup');
					$( ".get_price" ).bind({		
						keyup: function() {			
							var product_id = $(this).attr('product_id_val');
							get_price(product_id);
						}
					});
					$(".chzn-select").unbind('change');
					$(".chzn-select").bind({
						change: function(event){
							if(event.target == this){
								var availability = $(this).find("option:selected").attr('availability');
								var rack  = $(this).find("option:selected").attr('rack');
								var product_val  = $(this).attr('product_val');
								$("#available_"+product_val).html("Stock Availability - "+availability+"<br>"+"Product Rack - "+rack);
							}
						}
					});	
				}		
			},
			error: function(data) {
			
			}
		});		
	});
	
	$(".chzn-select").change(function(event){
		if(event.target == this){
			var availability = $(this).find("option:selected").attr('availability');
			var rack  = $(this).find("option:selected").attr('rack');
			var product_val  = $(this).attr('product_val');
			$("#available_"+product_val).html("Stock Availability - "+availability+"<br>"+"Product Rack - "+rack);
		}
	});
	
	$("#password_edit").validate({
		rules:{
			current_pass:"required",
			password:{
				required:true,
				minlength:5
			},
			cpassword:{
				required:true,
				equalTo:"#password"
			}
		},
		messages:{
			current_pass:"Please enter your current password",
			password:{
				required:"Please enter new password",
				minlength:"Please enter atleast 5 digits"
			},
			cpassword:{
				required:"Confirm the password",
				equalTo:"Enter the same password as above"
			}
		}
	});
		
	$('.admin_product_remove').click(function(){
		row_id = $(this).attr('row_id');
		admin_product_remove(row_id);
	});
	
	$('.get_price').keyup(function(){
		var product_id = $(this).attr('product_id_val');
		get_price(product_id);
	});
	
});
 
function get_price(product_id){	
	/*var tot_quantity = parseInt($('#total_quantity_'+dish_id).val());
	var tot_quantity = (isNaN(tot_quantity)) ? 0 : tot_quantity;
	var price_per = parseFloat($('#price_per_'+dish_id).val());
	var price_per = (isNaN(price_per)) ? 0 : price_per;
	var tot_quality_ = $('#total_quality_'+dish_id);
	var dish_tot = 0;
	var total = 0;
	if(!$(this).hasClass('tot_qual')){
		dish_tot = tot_quantity * price_per;
		$('#total_quality_'+dish_id).val(dish_tot);
	}*/
	var total = 0;
	$('.get_price').each(function(){
		total += (isNaN(parseFloat(this.value))) ? 0 : parseFloat(this.value);
	});
	//$('.total_price').val(total);
	$('.total_price').html(total);
}

function admin_product_remove(row_id){
	$('#'+row_id).remove();
	var total = 0;
	$('.tot_qual').each(function(){
		total += (isNaN(parseFloat(this.value))) ? 0 : parseFloat(this.value);
	});
	$('#order_total_val').val(total);
	$( ".admin_product_remove" ).unbind('click');
	$( ".admin_product_remove" ).bind({		
		click: function() {			
			var row_id = $(this).attr('row_id');
			admin_product_remove(row_id);
		}
	});	
}