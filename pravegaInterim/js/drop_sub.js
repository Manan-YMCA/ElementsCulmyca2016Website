(function($){
	$(document).ready(function(){
		$('ul.dropdown-menu [data-toggle=dropdown]').on('mouseenter', function(event) {
			event.preventDefault(); 
			event.stopPropagation(); 
			$(this).parent().siblings().removeClass('open');
			$(this).parent().toggleClass('open');
		});
		/*$('ul.dropdown-menu [data-toggle=dropdown]').on('mouseleave', function(event) {
			event.preventDefault(); 
			event.stopPropagation(); 
			$(this).parent().siblings().removeClass('open');
			$(this).parent().toggleClass('open');
		});*/
		$('ul.dropdown-submenu').on('mouseenter', function(event) {
			event.preventDefault(); 
			event.stopPropagation(); 
			$(this).parent().siblings().removeClass('open');
			$(this).parent().toggleClass('open');
		});
		$('ul.dropdown-submenu').on('mouseleave', function(event) {
			event.preventDefault(); 
			event.stopPropagation(); 
			$(this).parent().siblings().removeClass('open');
			$(this).parent().toggleClass('open');
		});
	});
	/*('ul.dropdown-menu [data-toggle=dropdown]').on({
						mouseenter: function (event) {
							event.preventDefault(); 
							event.stopPropagation(); 
							$(this).parent().siblings().removeClass('open');
							$(this).parent().toggleClass('open');
						},
						mouseleave: function (event) {
							event.preventDefault(); 
							event.stopPropagation(); 
							$(this).parent().siblings().removeClass('open');
							$(this).parent().toggleClass('open');
						}
		});*/
})(jQuery);