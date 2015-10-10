<?php
//Loads event data of the event with name $name, which is defined externally (in the file including this one)
//$oneline_desc, $desc, $image, $rules, $subject_name, $file_name are the variables which hold the corresponding data of the event.

$xml = simplexml_load_file('events.xml');

$path = "/event_data/event[name='".$name."']";
$result = $xml->xpath($path);

$oneline_desc = $result[0]->oneline_desc;
$desc = $result[0]->desc->para;
$image = $result[0]->image;
$rules = $result[0]->rules_list->rule;
$subject_name = $result[0]->subject;
$file_name = $result[0]->file_name;

$path = "/event_data/event[subject='".$subject_name."']";
$result2 = $xml->xpath($path);

for ($i=0; $i < sizeof($result2); $i++)
{
	$subject_events[$i] = $result2[$i]->name;
	$event_links[$i] = $result2[$i]->file_name;
}

//checking if already registered for the event
$registered = 0;

if (isset($_COOKIE['email']) && $db_event_name != "")
{
	$query = 'SELECT `'. $db_event_name . '` FROM events WHERE email="'.$_COOKIE["email"].'"';
	$result = mysqli_query($link, $query);
	$result = mysqli_fetch_row($result);
	
	if ($result[0])
		$registered = 1;
}
?>