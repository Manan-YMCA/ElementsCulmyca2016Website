window.onload = function(){
	var tile1 = document.getElementById("sub_tile1");
	var tile2 = document.getElementById("sub_tile2");
	var tile3 = document.getElementById("sub_tile3");
	var tile4 = document.getElementById("sub_tile4");
	var tile5 = document.getElementById("sub_tile5");
	var tile6 = document.getElementById("sub_tile6");
	
	tile1.onmouseover = function() {blur(1)};
	tile2.onmouseover = function() {blur(2)};
	tile3.onmouseover = function() {blur(3)};
	tile4.onmouseover = function() {blur(4)};
	tile5.onmouseover = function() {blur(5)};
	tile6.onmouseover = function() {blur(6)};

	document.getElementById("all_subj_tiles").onmouseout = function() {
		var left = tile1.getBoundingClientRect().left;
		var right = tile3.getBoundingClientRect().right;
		var top = tile1.getBoundingClientRect().top;
		var bottom = tile4.getBoundingClientRect().bottom;
		
		var x = event.pageX;
		var y = event.pageY;
		
		if (x < left || x > right || y < top || y > bottom)
			focus();
	};
}

function blur(num)
{
	var i;

	for (i=1; i<=6; i++)
	{
		if (i != num)
			document.getElementById("sub_tile"+i).classList.add("blur_out");
		else document.getElementById("sub_tile"+i).classList.remove("blur_out");
	}
}

function focus()
{
	var i;
	
	for (i=1; i<=6; i++)
	{
		document.getElementById("sub_tile"+i).classList.remove("blur_out");
	}
}