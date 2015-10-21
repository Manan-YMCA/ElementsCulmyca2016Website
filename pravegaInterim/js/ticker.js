news = document.getElementsByName("news");
current = 0;
				
function update_news()
	{	
		news[current].classList.remove("ticker_visible");
		news[current].classList.add("ticker_top");
		news[(current+1)%news.length].classList.remove("ticker_bottom");
		news[(current+1)%news.length].classList.add("ticker_visible");
		setTimeout(function(){news[current].classList.remove("ticker_top"); news[current].classList.add('ticker_bottom'); current = (current + 1) % news.length;},1000);
	}
											
	var the_timeout = setInterval(function() {update_news()}, 3000);
									
	document.getElementById("news_holder").onmouseover = function(){console.log("hi");clearInterval(the_timeout)};
	document.getElementById("news_holder").onmouseout = function(){the_timeout = setInterval(function() {update_news()}, 3000)};
