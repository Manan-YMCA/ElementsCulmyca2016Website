// Jquery with no conflict
jQuery(document).ready(function($) {
	
	// UI Accordion ------------------------------------------------------ //
	
	$( ".accordion" ).accordion({
		collapsible: true, active: false
		});
	
	
	// Toggle box Milind version -------------------------------------------- //
	
	$(".toggle-container").hide(); 
	$(".toggle-trigger").click(function(){
		$(this).toggleClass("active").next().slideToggle("slow");
		return false;
	});
	
	$(".toggle-expand-all").click(function(){
		$(".toggle-container").addClass("active");
		$(".toggle-container").slideDown("slow");
		return false;
	});
	
	$(".toggle-collapse-all").click(function(){
		$(".toggle-container").removeClass("active");
		$(".toggle-container").slideUp("slow");
		return false;
	});
	

		
//close			
});
	




