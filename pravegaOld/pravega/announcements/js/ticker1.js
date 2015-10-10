news = document.getElementsByName("news");
winners = document.getElementsByName("winners");
current = 0;
				
function update_news()
	{	
		news[current % news.length].classList.remove("ticker1_visible");
		winners[current % winners.length].classList.remove("ticker2_visible");
		
		news[current % news.length].classList.add("ticker1_top");
		winners[current % winners.length].classList.add("ticker2_top");
		
		news[(current+1)%news.length].classList.remove("ticker1_bottom");
		winners[(current+1)%winners.length].classList.remove("ticker2_bottom");
		
		news[(current+1)%news.length].classList.add("ticker1_visible");
		winners[(current+1)%winners.length].classList.add("ticker2_visible");
		
		setTimeout(function(){news[current % news.length].classList.remove("ticker1_top"); news[current % news.length].classList.add('ticker1_bottom'); }, 1000);
		setTimeout(function(){winners[current % winners.length].classList.remove("ticker2_top"); winners[current % winners.length].classList.add('ticker2_bottom'); current = (current + 1);},1000);
	}
											
	var the_timeout = setInterval(function() {update_news()}, 4000);
									
	document.getElementById("news_holder").onmouseover = function(){console.log("hi");clearInterval(the_timeout)};
	document.getElementById("news_holder").onmouseout = function(){the_timeout = setInterval(function() {update_news()}, 4000)};
	document.getElementById("winners_holder").onmouseover = function(){console.log("hi");clearInterval(the_timeout)};
	document.getElementById("winners_holder").onmouseout = function(){the_timeout = setInterval(function() {update_news()}, 4000)};
	
	
