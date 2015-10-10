<?php
	$xml = simplexml_load_file('events.xml');
	
	$path = "/event_data/event";
	$result2 = $xml->xpath($path);

	for ($i=0; $i < sizeof($result2); $i++)
	{
		echo "`".$result2[$i]->name . "` tinyint(1) not null default 0,";
		echo "<br>";
	}
	
?>