
// RequestAnimFrame: a browser API for getting smooth animations
window.requestAnimFrame = (function(){
	return  window.requestAnimationFrame       || 
		window.webkitRequestAnimationFrame || 
		window.mozRequestAnimationFrame    || 
		window.oRequestAnimationFrame      || 
		window.msRequestAnimationFrame     ||  
		function( callback ){
			return window.setTimeout(callback, 1000 / 60);
		};
})();

window.cancelRequestAnimFrame = ( function() {
	return window.cancelAnimationFrame          ||
		window.webkitCancelRequestAnimationFrame    ||
		window.mozCancelRequestAnimationFrame       ||
		window.oCancelRequestAnimationFrame     ||
		window.msCancelRequestAnimationFrame        ||
		clearTimeout
} )();


// Initialize canvas and required variables
var canvas = document.getElementById("canvas"),
		W = document.getElementById("header-wrapper").offsetWidth, // Window's width
		ctx = canvas.getContext("2d"), // Create canvas context
		H = window.innerHeight, // Window's height
		ball = {}, // Ball object
		paddles = [2], // Array containing two paddles
		mouse = {}, // Mouse object to store it's current position
		points = 0, // Varialbe to store points
		fps = 60, // Max FPS (frames per second)
		particlesCount = 20, // Number of sparks when ball strikes the paddle
		flag = 0, // Flag variable which is changed on collision
		startBtn = {}, // Start button object
		restartBtn = {}, // Restart button object
		over = 0, // flag varialbe, cahnged when the game is over
		init, // variable to initialize animation
		paddleHit,
		code = "",
		init_x = Math.round(W*0.5)+34,
		init_y = document.getElementById("pravega_logo").getBoundingClientRect().bottom-103.2;

		
// Add mousemove and mousedown events to the canvas
document.addEventListener("mousemove", trackPosition, true);
document.addEventListener("mousedown", btnClick, true);
document.addEventListener("keypress", secretCode, true);


// Initialise the collision sound
collision = document.getElementById("collide");

// Set the canvas's height and width to full screen
canvas.width = W;
canvas.height = H;


// Function to paint canvas
function paintCanvas() {
	ctx.fillStyle = "rgba(100, 0, 0, 0)";
	ctx.fillRect(0, 0, W, H);
}

// Function for creating paddles
function Paddle(pos) {
	// Height and width
	this.w = 5;
	this.h = 125;
	
	// Paddle's position
	this.y = H/2 - this.h/2;
	this.x = (pos == "left") ? 0 : W - this.w;
	
}

// Push two new paddles into the paddles[] array
paddles.push(new Paddle("right"));

paddles.push(new Paddle("left"));

// Ball object
ball = {
	x: init_x,
	y: init_y,
	r: 5,
	c: "#07a0d7",
	vx: ball_hor_vel(),
	vy: 0,
	prev_x: 50,
	prev_y: 50,
	
	// Function for drawing ball on canvas
	draw: function() {
		ctx.beginPath();
		ctx.fillStyle = this.c;
		ctx.arc(this.x, this.y, this.r, 0, Math.PI*2, false);
		ctx.fill();
	}
};


// Start Button object
startBtn = {
	w: 100,
	h: 50,
	x: W/2 - 50,
	y: H/2,
	
	draw: function() {
		ctx.strokeStyle = "white";
		ctx.lineWidth = "2";
		ctx.strokeRect(this.x, this.y, this.w, this.h);
		
		ctx.font = "18px Arial, sans-serif";
		ctx.textAlign = "center";
		ctx.textBaseline = "middle";
		ctx.fillStlye = "white";
		ctx.fillText("Start", W/2, H/2+25 );
	}
};

// Restart Button object
restartBtn = {
	w: 100,
	h: 50,
	x: W/2 - 50,
	y: H/2 - 50,
	
	draw: function() {
		ctx.strokeStyle = "white";
		ctx.lineWidth = "2";
		ctx.strokeRect(this.x, this.y+45, this.w, this.h);
		
		ctx.font = "18px Arial, sans-serif";
		ctx.textAlign = "center";
		ctx.textBaseline = "middle";
		ctx.fillStlye = "white";
		ctx.fillText("Restart", W/2, H/2+20 );
	}
};



// Draw everything on canvas
function draw() {
	paintCanvas();
	
	ctx.clearRect(0,0,6,H); //clear first paddle
	ctx.clearRect(W-6,0,6,H); //clear first paddle
	
	for(var i = 0; i < paddles.length; i++) {
		p = paddles[i];
		ctx.fillStyle = "white";
		ctx.fillRect(p.x, p.y, p.w, p.h);
	}
	
	ctx.clearRect(ball.prev_x-ball.r-0.3,ball.prev_y-ball.r-0.3,2*(ball.r+0.4),2*(ball.r+0.4));
	ball.draw();
	update();
}

// Function to increase speed after every 5 points
function increaseSpd() {
	if(points % 4 == 0) {
		if(Math.abs(ball.vx) < 15) {
			ball.vx += (ball.vx < 0) ? -1 : 1;
			ball.vy += (ball.vy < 0) ? -2 : 2;
		}
	}
}

// Track the position of mouse cursor
function trackPosition(e) {
	mouse.x = e.pageX;
	mouse.y = e.pageY;
}

// Function to update positions, score and everything.
// Basically, the main game logic is defined here
function update() {
	
	// Update scores
	updateScore(); 
	
	// Move the paddles on mouse move
	if(mouse.x && mouse.y) {
		for(var i = 1; i < paddles.length; i++) {
			p = paddles[i];
			p.y = mouse.y - p.w/2;
		}		
	}
	
	// Move the ball
	
	ball.prev_x = ball.x;
	ball.prev_y = ball.y;
	ball.x += ball.vx;
	ball.y += ball.vy;

	
	// Collision with paddles
	p1 = paddles[1];
	p2 = paddles[2];
	
	// If the ball strikes with paddles,
	// invert the y-velocity vector of ball,
	// increment the points, play the collision sound,
	// save collision's position so that sparks can be
	// emitted from that position, set the flag variable,
	// and change the multiplier
	if(collides(ball, p1)) {
		collideAction(ball, p1);
	}
	
	else if(collides(ball, p2)) {
		collideAction(ball, p2);
	} 
	
	else {
		// Collide with walls, If the ball hits the top/bottom,
		// walls, run gameOver() function
		if(ball.x + ball.r > W) {
			ball.y = H - ball.r;
			gameOver();
		} 
		
		else if(ball.x < 0) {
			ball.y = ball.r;
			gameOver();
		}
		
		// If ball strikes the top/bottom walls, invert the 
		// y-velocity vector of ball
		if(ball.y + ball.r > H) {
			ball.vy = -ball.vy;
			ball.y = H - ball.r;
		}
		
		else if(ball.y -ball.r < 0) {
			ball.vy = -ball.vy;
			ball.y = ball.r;
		}
	}
}

//Function to check collision between ball and one of
//the paddles
function collides(b, p) {
	if(b.y + ball.r >= p.y && b.y - ball.r <=p.y + p.h) {
		if(b.x >= (p.x - p.w) && p.x > 0){
			paddleHit = 1;
			return true;
		}
		
		else if(b.x <= p.w && p.x == 0) {
			paddleHit = 2;
			return true;
		}
		
		else return false;
	}
}

//Do this when collides == true
function collideAction(ball, p) {
	ball.vx = -ball.vx;
	
	if(paddleHit == 1) {
		ball.x = p.x - p.w;
	}
	
	else if(paddleHit == 2) {
		ball.x = p.w + ball.r;
	}
	
	points++;
	increaseSpd();
	
	if(collision) {
		if(points > 0) 
			collision.pause();
		
		collision.currentTime = 0;
		collision.play();
	}
	
	flag = 1;
}


// Function for updating score
function updateScore() {
	ctx.clearRect(20,20,70,20);
	ctx.fillStlye = "white";
	ctx.font = "16px Arial, sans-serif";
	ctx.textAlign = "left";
	ctx.textBaseline = "top";
	ctx.fillText("Score: " + points, 20, 20 );
}

// Function to run when the game overs
function gameOver() {
	ctx.fillStlye = "white";
	ctx.font = "20px Arial, sans-serif";
	ctx.textAlign = "center";
	ctx.textBaseline = "middle";
	ctx.fillText("Game Over - You scored "+points+" points!", W/2, H/2 + 70 );
	
	// Stop the Animation
	cancelRequestAnimFrame(init);
	
	// Set the over flag
	over = 1;
	document.getElementById("canvas").style.cursor = "default";
	ctx.clearRect(ball.prev_x-ball.r-0.1,ball.prev_y-ball.r-0.1,2*(ball.r+0.2),2*(ball.r+0.2));
	
	ball.x = init_x;
	ball.y = init_y;
	ball.draw();
	
	// Show the restart button
	restartBtn.draw();
}

// Function for running the whole animation
function animloop() {
	init = requestAnimFrame(animloop);
	draw();
}

// Function to execute at startup
function startScreen() {
	draw();
	startBtn.draw();
}

// On button click (Restart and start)
function btnClick(e) {
	
	// Variables for storing mouse position on click
	var mx = e.pageX,
			my = e.pageY;
	
	// Click start button
	if(mx >= startBtn.x && mx <= startBtn.x + startBtn.w) {
		ball.vy = ball_ver_vel();
		
		if(code == "pravega")
		{
			document.getElementById("pravega_logo_nodot").style.display="inline-block";
			document.getElementById("pravega_logo").style.display="none";
		}
		animloop();
		document.getElementById("canvas").style.cursor = "none";
		
		ctx.clearRect(startBtn.x-2, startBtn.y-2, startBtn.w+4, startBtn.h+4);
		// Delete the start button after clicking it
		startBtn = {};
	}
	
	// If the game is over, and the restart button is clicked
	if(over == 1) {
		
		if(mx >= restartBtn.x && mx <= restartBtn.x + restartBtn.w) {
			document.getElementById("canvas").style.cursor = "none";
			ball.prev_x= init_x;
			ball.prev_y= init_y;
			ball.x= init_x;
			ball.y= init_y; 
			points = 0;
			ball.vx = ball_hor_vel();
			ball.vy = ball_ver_vel();
			animloop();
			ctx.clearRect(0, 0, W, H);
			over = 0;
		}
	}
}

function secretCode(e)
{
	code += String.fromCharCode(e.charCode);
	if (code == "pravega")
	{
		document.getElementById("canvas").style.display="inherit";
		document.getElementById("byline").style.display="none";
		document.getElementById("date").style.display="none";
		if (document.getElementById("news_holder") != null) document.getElementById("news_holder").style.display="none";
		document.getElementById("presenters").style.background="rgba(0,0,0,0)";
		//document.getElementById("pravega_logo_nodot").style.display="inline-block";
		//document.getElementById("pravega_logo").style.display="none";
		startScreen();
	}
}

function ball_hor_vel()
{
	var vel = 4+Math.round(Math.random()*5);
	
	if (Math.random() < 0.5)
		;
	else vel = -1*vel;
	
	return vel;
}

function ball_ver_vel()
{
	return Math.round(Math.sqrt(81-ball.vx*ball.vx));
}