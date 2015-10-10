function createRequestObject()
{
	var tmpXmlHttpObject;

	if (window.XMLHttpRequest) 
	{ 
		tmpXmlHttpObject = new XMLHttpRequest();
	} 
	
	else if (window.ActiveXObject) 
	{
		tmpXmlHttpObject = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	return tmpXmlHttpObject;
}

var http = createRequestObject();

function makeGetRequest()
{
	var request = "retrieve_winners.php";
	console.log("HELP");
	http.open('get', request);
	http.onreadystatechange = processResponse;
	http.send(null);
}

function processResponse()
{
	if (http.readyState == 4)
	{
		var response = http.responseText;
		document.getElementById("winners").innerHTML = response;
	}
}
