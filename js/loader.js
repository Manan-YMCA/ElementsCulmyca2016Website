$(window).load(function() {
	//$(".loader").fadeTo(1000,0).fadeOut(0);
	$(".loader").animate({
		opacity:0
	},1000,"linear",function(){$(".loader").fadeOut();});
})