var intro_button = document.getElementById("intro_button");
var instructions_button = document.getElementById("instructions_button");
var reaching_button = document.getElementById("reaching_button");
var alt_acco_button = document.getElementById("alt_acco_button");
var request_button = document.getElementById("request_button");

var intro = document.getElementById("intro").innerHTML;
var instructions = document.getElementById("instructions_content").innerHTML;
var reaching = document.getElementById("reaching_content").innerHTML;
var alt_acco = document.getElementById("alt_acco_content").innerHTML;
var request = document.getElementById("request_content").innerHTML;
var content = document.getElementById("content_dynamic");

var current = null;

intro_button.onclick = function(){
	if (current != "#intro")
	{
		content.innerHTML = intro;
		history.pushState(null, "", "#intro");
		current = "#intro";
		intro_button.classList.add("selected");
		
		instructions_button.classList.remove("selected");
		reaching_button.classList.remove("selected");
		alt_acco_button.classList.remove("selected");
		request_button.classList.remove("selected");
	}
};

instructions_button.onclick = function(){
	if (current != "#instructions")
	{
		content.innerHTML = instructions;
		history.pushState(null, "", "#instructions");
		current = "#instructions";
		instructions_button.classList.add("selected");
		
		intro_button.classList.remove("selected");
		reaching_button.classList.remove("selected");
		alt_acco_button.classList.remove("selected");
		request_button.classList.remove("selected");
	}
};

reaching_button.onclick = function(){
	if (current != "#reaching")
	{
		content.innerHTML = reaching;
		history.pushState(null, "", "#reaching");
		current = "#reaching";
		reaching_button.classList.add("selected");
		
		intro_button.classList.remove("selected");
		instructions_button.classList.remove("selected");
		alt_acco_button.classList.remove("selected");
		request_button.classList.remove("selected");
	}
};

alt_acco_button.onclick = function(){
	if (current != "#alt_acco")
	{
		content.innerHTML = alt_acco;
		history.pushState(null, "", "#alt_acco");
		current = "#alt_acco";
		alt_acco_button.classList.add("selected");
		
		intro_button.classList.remove("selected");
		instructions_button.classList.remove("selected");
		reaching_button.classList.remove("selected");
		request_button.classList.remove("selected");
	}
};

request_button.onclick = function(){
	if (current != "#request")
	{
		content.innerHTML = request;
		history.pushState(null, "", "#request");
		current = "#request";
		request_button.classList.add("selected");
		
		intro_button.classList.remove("selected");
		instructions_button.classList.remove("selected");
		reaching_button.classList.remove("selected");
		alt_acco_button.classList.remove("selected");
	}
};

window.onpopstate = function(event) {load_content()};

function load_content(hash)
{
	
	if (hash == null)
	{
		hash = location.hash;
	}
	
	else hash = "#" + hash;

	if (hash != current)
	{
		switch(hash)
		{
			case '#intro':
				content.innerHTML = intro;
				current = "#intro";
				
				intro_button.classList.add("selected");
				instructions_button.classList.remove("selected");
				reaching_button.classList.remove("selected");
				alt_acco_button.classList.remove("selected");
				request_button.classList.remove("selected");
				break;
			
			case '#instructions':
				content.innerHTML = instructions;
				current = "#instructions";
				
				intro_button.classList.remove("selected");
				instructions_button.classList.add("selected");
				reaching_button.classList.remove("selected");
				alt_acco_button.classList.remove("selected");
				request_button.classList.remove("selected");
				break;
			
			case '#reaching':
				content.innerHTML = reaching;
				current = "#reaching";
				
				intro_button.classList.remove("selected");
				instructions_button.classList.remove("selected");
				reaching_button.classList.add("selected");
				alt_acco_button.classList.remove("selected");
				request_button.classList.remove("selected");
				break;
				
			case '#alt_acco':
				content.innerHTML = alt_acco;
				current = "#alt_acco";
				
				intro_button.classList.remove("selected");
				instructions_button.classList.remove("selected");
				reaching_button.classList.remove("selected");
				alt_acco_button.classList.add("selected");
				request_button.classList.remove("selected");
				break;
				
			case '#request':
				content.innerHTML = request;
				current = "#request";
				
				intro_button.classList.remove("selected");
				instructions_button.classList.remove("selected");
				reaching_button.classList.remove("selected");
				alt_acco_button.classList.remove("selected");
				request_button.classList.add("selected");
				break;
				
			case '#login-box':
				if (current == null)
				{
					content.innerHTML = intro;
					current = "#intro";
					
					intro_button.classList.add("selected");
					instructions_button.classList.remove("selected");
					request_button.classList.remove("selected");
				}
				break;
				
			default:
				content.innerHTML = intro;
				current = "#intro";
				
				intro_button.classList.add("selected");
				instructions_button.classList.remove("selected");
				reaching_button.classList.remove("selected");
				alt_acco_button.classList.remove("selected");
				request_button.classList.remove("selected");
				break;
		}
	}
}
