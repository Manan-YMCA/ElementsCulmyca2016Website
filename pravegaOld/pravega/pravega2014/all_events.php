<?php
$xml = simplexml_load_file('events.xml');

$path = "/event_data/event";
$result = $xml->xpath($path);

for ($j=0; $j < sizeof($result); $j++)
{
	$name =$result[$j]->name;
	$oneline_desc = $result[$j]->oneline_desc;
	$desc = $result[$j]->desc->para;

	echo "<u><h3>";
	echo $name;
	echo "</h3></u>";
	echo $oneline_desc;
	for ($i=0; $i < sizeof($desc); $i++)
	{
		echo "<p>";
		echo $desc[$i];
		echo "</p>\r\n";
	}
	
	echo "<br><br>";
}
?>