function anim(num)
{
	document.getElementById("overlay"+prev_tile).classList.add("hide");	
	document.getElementById("overlay"+num).classList.remove("hide");
	prev_tile = num;
}

var prev_tile = 0;

window.onload = function(){
	window.item = document.getElementById("overlay");

	var tile1 = document.getElementById("tile1");
	var tile2 = document.getElementById("tile2");
	var tile3 = document.getElementById("tile3");
	var tile4 = document.getElementById("tile4");
	var tile5 = document.getElementById("tile5");
	var tile6 = document.getElementById("tile6");
	
	var vdot = document.getElementById("tiles");
	var rect = vdot.getBoundingClientRect();

	tile1.onmouseover = function() {anim(1)};
	tile2.onmouseover = function() {anim(2)};
	tile3.onmouseover = function() {anim(3)};
	tile4.onmouseover = function() {anim(4)};
	tile5.onmouseover = function() {anim(5)};
	tile6.onmouseover = function() {anim(6)};
	
	vdot.onmouseout = function() {
		var x = event.clientX;
		var y = event.clientY;
		
		if ((x > rect.right) || (x < rect.left) || (y < rect.top) || (y > rect.bottom))
		{
			anim(0);
		}
	};	
};