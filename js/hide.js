$(window).on('load', function() {
   $("#cover").hide();
});
 
$(document).ready(function(){	
	setTimeout(function() {
		$('#form_msg').slideUp();
	}, 5000);
	
	$('.remove_event').click(function () {	
		var remove_event_id = $(this).attr('remove_id');
		remove_event(remove_event_id);		
	});
	
	$(".pop_up").colorbox({
		onComplete:function(){
			$(".group_events").validate({
				submitHandler: function(form){
					form.submit();
					$.colorbox.close();
				}
			});
		}
	});
	$('.menu_check').click(function(){
		if($(this).prop('checked') == true){
			$('.menu_check').prop('checked', false);
			$(this).prop('checked', true);
		}else{
			$('.menu_check').prop('checked', false);
			$(this).prop('checked', false);
		}
	});
});

function remove_event(remove_event_id){
	var params = "remove_event="+remove_event_id;
	$.ajax({
		type: "POST",
		url: "pravega_action.php",
		data: params,
		dataType: "json",
		success: function(data) {
			window.location.reload();
		},
		error: function(data) {
			window.location.reload();
		}
	});
}