document.addEventListener("keypress", twitter, true);
document.addEventListener("load", tune, true);

var counter = 0;

function twitter(event)
{
	counter++;
	//console.log(counter);
	
	if (counter == 140)
	{	
		document.getElementById("twitter").className += " twitter_egg";
		var link = document.createElement('audio');
		link.setAttribute('src', 'tweet.mp3');
		link.play();
	}
}

function tune()
{
	date = new Date();
	if (date.getHours() == 6)
	{
		var link = document.createElement('audio');
		link.setAttribute('src', 'venkatesha_suprabhata.mp3');
		link.setAttribute('autoplay', 'true');
	}
	
}