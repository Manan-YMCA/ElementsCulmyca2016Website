<?php

	if (isset($_POST['event_name']))
	{
		include('db_config.php');
		
		$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
		
		$event_name = $_POST['event_name'];
		$old_team = explode(",", $_POST['old_team']);
		$new_team = explode(",", $_POST['new_team']);
		
		for($i = 0; $i < sizeof($old_team); $i++)
			$old_team[$i] = '"' . $old_team[$i] .'"';
			
		for($i = 0; $i < sizeof($new_team); $i++)
			$new_team[$i] = '"' . $new_team[$i] .'"';
			
		$old_team = implode(",", $old_team);
		$new_team = implode(",", $new_team);
		$success = 0;
		
		$query = 'UPDATE `events` SET `'. $event_name. '`=0 WHERE `email` IN (' . $old_team . ')';
		if(mysqli_query($link, $query)) $success++;
		
		$query = 'UPDATE `events` SET `'. $event_name. '`=1 WHERE `email` IN (' . $new_team . ')';
		if(mysqli_query($link, $query)) $success++;
		
		$query = 'UPDATE `teams` SET `'. $event_name. '`="" WHERE `email` IN (' . $old_team . ')';
		if(mysqli_query($link, $query)) $success++;
		
		$query = 'UPDATE `teams` SET `'. $event_name. '`="'.$_POST["new_team"].'" WHERE `email` IN (' . $new_team . ')';
		if(mysqli_query($link, $query)) $success++;
		
		if ($success == 4)
			echo "Team successfully updated from ".$_POST['old_team']." to ".$_POST['new_team']." for event ".$event_name.".";
		else echo "Error encountered.";
		
		mysqli_close($link);
	}

	else
	{
		$xml = simplexml_load_file('events.xml');
	
		$path = "/event_data/event";
		$result = $xml->xpath($path);
?>
	<form action="update_team.php" method="post">
		Old Team: <input type="text" name="old_team" size="50" /><br>
		New Team: <input type="text" name="new_team" size="50" /><br>
		
		<select name="event_name" value="">
		<option selected disabled>Event Name</option>
		<?php
			for ($i=0; $i < sizeof($result); $i++)
			{
				if ($result[$i]->name != "L&#257;sya" && $result[$i]->name != "Carl Zeiss Pratik&#7771;ti" && $result[$i]->name != "Aerocarnival 2014 Finale" && $result[$i]->name != "Crossword Contests" && $result[$i]->name != "The Fourth R &ndash; Re-Envision" && $result[$i]->name != "EI Systems Mechfest" && $result[$i]->name != "Cloud Computing & Google App Engine Workshop")
				{
					echo '<option value="'. $result[$i]->name .'">'. $result[$i]->name .'</option>';
					echo PHP_EOL;
				}
				
				else if ($result[$i]->name == "L&#257;sya")
					echo '<option value="Lasya">L&#257;sya</option>', PHP_EOL;
				
				else if ($result[$i]->name == "Carl Zeiss Pratik&#7771;ti")
					echo '<option value="Carl Zeiss Pratikriti">Carl Zeiss Pratik&#7771;ti</option>', PHP_EOL;
					
				else if ($result[$i]->name == "Cloud Computing & Google App Engine Workshop")
					echo '<option value="Cloud Computing and Google App Engine Workshop">Cloud Computing & Google App Engine Workshop</option>', PHP_EOL;
					
				else if ($result[$i]->name == "The Fourth R &ndash; Re-Envision")
					echo '<option value="The Fourth R - Re-envision">The Fourth R &ndash; Re-Envision</option>', PHP_EOL;
			}
		?>
	</select><br>
	<input type="submit">
	</form>
<?php	
	}
?>