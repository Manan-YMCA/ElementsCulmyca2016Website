news = document.getElementsByName("news");
current = 0;
				
function update_news()
	{	
		news[current].classList.remove("ticker1_visible");
		news[current].classList.add("ticker1_top");
		news[(current+1)%news.length].classList.remove("ticker1_bottom");
		news[(current+1)%news.length].classList.add("ticker1_visible");
		setTimeout(function(){news[current].classList.remove("ticker1_top"); news[current].classList.add('ticker1_bottom'); current = (current + 1) % news.length;}, 1000);
	}
											
	var the_timeout = setInterval(function() {update_news()}, 4000);
									
	document.getElementById("news_holder").onmouseover = function(){console.log("hi");clearInterval(the_timeout)};
	document.getElementById("news_holder").onmouseout = function(){the_timeout = setInterval(function() {update_news()}, 4000)};
	
	
