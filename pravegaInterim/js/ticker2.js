winners = document.getElementsByName("winners");
current = 0;
				
function update_winners()
	{	
		winners[current].classList.remove("ticker2_visible");
		winners[current].classList.add("ticker2_top");
		winners[(current+1)%winners.length].classList.remove("ticker2_bottom");
		winners[(current+1)%winners.length].classList.add("ticker2_visible");
		setTimeout(function(){winners[current].classList.remove("ticker2_top"); winners[current].classList.add('ticker2_bottom'); current = (current + 1) % winners.length;},1000);
	}
											
	var the_timeout = setInterval(function() {update_winners()}, 4000);
									
	document.getElementById("winners_holder").onmouseover = function(){console.log("hi");clearInterval(the_timeout)};
	document.getElementById("winners_holder").onmouseout = function(){the_timeout = setInterval(function() {update_winners()}, 4000)};