<?php

	if (isset($_POST['event_name']))
	{
		include('db_config.php');
		
		$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
		
		if (!$link) {
			die('Connect Error (' . mysqli_connect_errno() . ') '
				. mysqli_connect_error());
		}
		
		function get_post_var($var) //safe post data collection
		{
			$val = $_POST[$var];
			if (get_magic_quotes_gpc())
				$val = stripslashes($val);
			return $val;
		}

		$event_name = get_post_var('event_name');
		//$event_name = "Mobile Making Workshop";
		
		$query = 'SELECT `'. $event_name. '` FROM `teams` WHERE `'. $event_name .'` != ""';
		$result = mysqli_query($link, $query);
		
		$num_participants = mysqli_num_rows($result);
		
		$emails;
		$i = 0;
		
		while ($row = mysqli_fetch_row($result))
		{
			$emails[$i] = $row[0];
			$i++;
		}
		
		$teams;
		$num_teams = 0;
		
		for ($i=0; $i < $num_participants; $i++)
		{
			$temp = $emails[$i];
			$flag = 0;
			
			for ($j=0; $j < $num_teams; $j++)
			{
				if ($temp == $teams[$j])
				{
					$flag = 1;
					break;
				}
			}
			
			if ($flag == 0)
			{
				$teams[$num_teams] = $temp;
				$num_teams++;
			}
		}
		echo "<table><tr>";
		echo "<td>Event Name: </td><td>".$event_name . "</td></tr>";
		echo "<tr><td>Number of participants: </td><td>".$num_participants . "</td></tr>";
		echo "<tr><td>Number of teams: </td><td>".$num_teams . "</td></tr></table><br><br>";
		
		for ($i = 0; $i<$num_teams; $i++)
		{
			$temp = explode(",", $teams[$i]);
			echo "<b><u>Team " . ($i+1);
			echo "</u></b><br>";
			for ($j=0; $j < sizeof($temp); $j++)
			{
				echo $temp[$j];
				echo "<br>";
			}
			
			echo "<br>";
		}
		
		mysqli_free_result($result);		
		mysqli_close($link);
	}

	else
	{
		$xml = simplexml_load_file('events.xml');
	
		$path = "/event_data/event";
		$result = $xml->xpath($path);
?>
	<form method="POST" action='check_event'>
	Select the name of the event:<br>
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
	</select>
	<input type="submit">
<?php	
	}
?>