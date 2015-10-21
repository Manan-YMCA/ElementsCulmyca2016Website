var desc_button = document.getElementById("desc_button");
var rules_button = document.getElementById("rules_button");
var register_button = document.getElementById("register_button");

var desc = document.getElementById("desc").innerHTML;
var rules = document.getElementById("rules_content").innerHTML;
var register = document.getElementById("register_content").innerHTML;
var content = document.getElementById("content_dynamic");

var current = null;

desc_button.onclick = function(){
	if (current != "#desc")
	{
		content.innerHTML = desc;
		history.pushState(null, "", "#desc");
		current = "#desc";
		desc_button.classList.add("selected");
		
		rules_button.classList.remove("selected");
		register_button.classList.remove("selected");
	}
};

rules_button.onclick = function(){
	if (current != "#rules")
	{
		content.innerHTML = rules;
		history.pushState(null, "", "#rules");
		current = "#rules";
		rules_button.classList.add("selected");
		
		desc_button.classList.remove("selected");
		register_button.classList.remove("selected");
	}
};

register_button.onclick = function(){
	if (current != "#register")
	{
		content.innerHTML = register;
		history.pushState(null, "", "#register");
		current = "#register";
		register_button.classList.add("selected");
		
		desc_button.classList.remove("selected");
		rules_button.classList.remove("selected");
	}
};

window.onpopstate = function(event) {load_content()};

function big_reg_button()
{
		content.innerHTML = register;
		history.pushState(null, "", "#register");
		current = "#rules";
		
		register_button.classList.add("selected");
		desc_button.classList.remove("selected");
		return false;
}

function load_content(hash)
{
	
	if (hash == null)
	{
		console.log("hi");
		hash = location.hash;
	}
	
	else hash = "#" + hash;

	if (hash != current)
	{
		switch(hash)
		{
			case '#desc':
				content.innerHTML = desc;
				current = "#desc";
				
				desc_button.classList.add("selected");
				rules_button.classList.remove("selected");
				register_button.classList.remove("selected");
				break;
			
			case '#rules':
				content.innerHTML = rules;
				current = "#rules";
				
				desc_button.classList.remove("selected");
				rules_button.classList.add("selected");
				register_button.classList.remove("selected");
				break;
				
			case '#register':
				content.innerHTML = register;
				current = "#register";
				
				desc_button.classList.remove("selected");
				rules_button.classList.remove("selected");
				register_button.classList.add("selected");
				break;
				
			case '#login-box':
				if (current == null)
				{
					content.innerHTML = desc;
					current = "#desc";
					
					desc_button.classList.add("selected");
					rules_button.classList.remove("selected");
					register_button.classList.remove("selected");
				}
				break;
				
			default:
				content.innerHTML = desc;
				current = "#desc";
				
				desc_button.classList.add("selected");
				rules_button.classList.remove("selected");
				register_button.classList.remove("selected");
				break;
		}
	}
}
