$(document).ready(function() {
	$('a.login-window').click(function() {
		
		// Getting the variable's value from a link 
		var loginBox = $(this).attr('href');

		//Fade in the Popup and add close button
		$(loginBox).fadeIn(300);
		
		//Set the center alignment padding + border
		var popMargTop = ($(loginBox).height() + 24) / 2; 
		var popMargLeft = ($(loginBox).width() + 24) / 2; 
		
		$(loginBox).css({ 
			'margin-top' : -popMargTop,
			'margin-left' : -popMargLeft
		});
		
		$('#mask').css("height", $(document).height());
		$('#mask').fadeIn(300);
		
		
		return false;
	});
	
	// When clicking on the button close or the mask layer the popup closed
	$('a.close, #mask').on('click', function() { 
	  $('#mask, .login-popup').fadeOut(300 , function() {
 
	}); 
	return false;
	});
});

function load_modal(the_source)
{		
	// Getting the variable's value from a link 
	var loginBox = $(the_source).attr('href');

	//Fade in the Popup and add close button
	$(loginBox).fadeIn(300);
	
	//Set the center alignment padding + border
	var popMargTop = ($(loginBox).height() + 24) / 2; 
	var popMargLeft = ($(loginBox).width() + 24) / 2; 
	
	$(loginBox).css({ 
		'margin-top' : -popMargTop,
		'margin-left' : -popMargLeft
	});
	
	$('#mask').css("height", $(document).height());
	$('#mask').fadeIn(300);
	
	
	return false;
}

function load_image(the_source)
{		
	$.scrollTo(0, 400, {offset:50}, {easing:'swing'});
	// Getting the variable's value from a link 
	var imageSource = $(the_source).attr('src');

	document.getElementById("full-size-image").src = imageSource;
	
	//Fade in the Popup and add close button
	$("#full-picture").fadeIn(300);
	
	//Set the center alignment padding + border
	
	if ($(window).height() < ($("#full-picture").height() + 64))
		document.getElementById("full-size-image").style.height = $(window).height() - 100 + "px";
	
	var popMargTop = ($("#full-picture").height() + 64) / 2;
	var popMargLeft = ($("#full-picture").width() + 64) / 2; 
	
	/*else
	{
		$("#full-picture").css({"top" : 20});
		var popMargTop = 0;
	}*/
	
	$("#full-picture").css({ 
		'margin-top' : -popMargTop,
		'margin-left' : -popMargLeft
	});
	
	$('#mask').css("height", $(document).height());
	$('#mask').fadeIn(300);
	
	return false;
}