<?php
	session_start();
	$errors = 0;
	$error_team1 = 0;
	$error_team2 = 0;
	$error_team3 = 0;

	if (isset($_POST['event_name']))
	{
		include('db_config.php');
		
		$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
		
		$event_name = $_POST['event_name'];
		$team1 = explode(",", $_POST['team1']);
		$team2 = explode(",", $_POST['team2']);
		$team3 = explode(",", $_POST['team3']);
		
		$size1 = sizeof($team1);
		$size2 = sizeof($team2);
		$size3 = sizeof($team3);
		
		$team1 = '"' . implode('","', $team1) . '"';
		$team2 = '"' . implode('","', $team2) . '"';
		$team3 = '"' . implode('","', $team3) . '"';
		
		$query1 = "SELECT email, firstname, lastname, college FROM usernames WHERE email IN (".$team1.")";
		$query2 = "SELECT email, firstname, lastname, college FROM usernames WHERE email IN (".$team2.")";
		$query3 = "SELECT email, firstname, lastname, college FROM usernames WHERE email IN (".$team3.")";

		$result1 = mysqli_query($link, $query1);
		$result2 = mysqli_query($link, $query2);
		$result3 = mysqli_query($link, $query3);
		
		if (mysqli_num_rows($result1) != $size1 && $_POST['team1'] != "")
		{
			$errors = 1;
			$error_team1 = 1;
		}
		
		if (mysqli_num_rows($result2) != $size2 && $_POST['team2'] != "")
		{
			$errors = 1;
			$error_team2 = 1;
		}
		
		if (mysqli_num_rows($result3) != $size3 && $_POST['team3'] != "")
		{
			$errors = 1;
			$error_team = 1;
		}

			$file = fopen("winners.csv","ab");
			
			while ($row = mysqli_fetch_row($result1))
			{
				$data = '"' . $row[1] . ' ' . $row[2] . '","' . $row[3] . '",1st,"' . $event_name . '"'. PHP_EOL;
				fwrite($file, $data);
			}
			
			while ($row = mysqli_fetch_row($result2))
			{
				$data = '"' . $row[1] . ' ' . $row[2] . '","' . $row[3] . '",2nd,"' . $event_name . '"'. PHP_EOL;
				fwrite($file, $data);
			}
			
			while ($row = mysqli_fetch_row($result3))
			{
				$data = '"' . $row[1] . ' ' . $row[2] . '","' . $row[3] . '",3rd,"' . $event_name . '"'. PHP_EOL;
				fwrite($file, $data);
			}
			
			fclose($file);
			
			$query = "INSERT INTO winners (event_name, 1st, 2nd, 3rd, comments) VALUES (?, ?, ?, ?, ?)";
			$stmt = mysqli_prepare($link, $query);
			mysqli_stmt_bind_param($stmt, "sssss", $event_name, $_POST['team1'], $_POST['team2'], $_POST['team3'], $_POST['comments']);
			mysqli_stmt_execute($stmt);
			
			//DELETING event from event list
				$xml = simplexml_load_file('prize_events.xml');
				$path = "/event_data/event[name='".$event_name."']";
				$result = $xml->xpath($path);
				$temp = $result[0];
				unset($temp[0]);
				if ($xml->asxml('prize_events.xml'));
			//END
			
			echo "Successfully recorded winners for event " . $event_name . " (Even if there are errors below they have been recorded. But please look into the errors.)<br>";
		
		if ($errors)
		{
			echo "<span style='color: red; font-weight: 700;'>";
			if ($error_team1)
			{
				echo "At least one of the email addresses of Team 1 is not registered as given. They have been added to the winner's list but please check it up personally.<br>";
			}
			
			if ($error_team2)
			{
				echo "At least one of the email addresses of Team 2 is not registered as given. They have been added to the winner's list but please check it up personally.<br>";
			}
			
			if ($error_team3)
			{
				echo "At least one of the email addresses of Team 3 is not registered as given. They have been added to the winner's list but please check it up personally.<br>";
			}
		}
	}

	else
	{
		$xml = simplexml_load_file('prize_events.xml');
	
		$path = "/event_data/event";
		$result = $xml->xpath($path);
		if (isset($_SESSION['errors']))
		{
			echo "<span style='color: red; font-weight: 700;'>";
			if (isset($_SESSION['error_team1']))
				echo "At least one of the email addresses of Team 1 is not registered as given.<br>";
			if (isset($_SESSION['error_team2']))
				echo "At least one of the email addresses of Team 2 is not registered as given.<br>";
			if (isset($_SESSION['error_team3']))
				echo "At least one of the email addresses of Team 3 is not registered as given.<br>";
			echo "</span>";
		}
?>
	<br>
	<form method="post" action='submit_winners'>
	<b>Select the name of the event:</b><br>
	<select name="event_name" value="">
		<option selected disabled>Event Name</option>
		<?php
			for ($i=0; $i < sizeof($result); $i++)
			{
				echo '<option value="'. $result[$i]->name .'">'. $result[$i]->name .'</option>';
				echo PHP_EOL;
			}
		?>
	</select>
	<br><br>
	<b>Enter email addresses of winning teams separated by commas (eg. a@abc.com,b@abc.com,c@abc.com) [WITHOUT SPACES AFTER COMMAS]:</b><br>
	<table>
		<tr>
			<td style="text-align: right;">First Place: </td>
			<td style="padding-left: 20px;"><input type="text" name="team1" size="50" value="<?php echo $_SESSION['team1']; ?>"></td>
		</tr>
		<tr>
			<td style="text-align: right;">Second Place:</td>
			<td style="padding-left: 20px;"><input type="text" name="team2" size="50" value="<?php echo $_SESSION['team2']; ?>"></td>
		</tr>
		<tr>
			<td style="text-align: right;">Third Place:</td>
			<td style="padding-left: 20px;"><input type="text" name="team3" size="50" value="<?php echo $_SESSION['team3']; ?>"></td>
		</tr>
		<tr>
			<td style="text-align: right;">Extra Comments:</td>
			<td style="padding-left: 20px;"><textarea name="comments" style="width: 335px;"><?php echo $_SESSION['comments']; ?></textarea></td>
		</tr>
		<tr>
			<td colspan="2" style="text-align: center;"><input type="submit"></td>
		</tr>
	</table>
<?php	
	session_destroy();
	}
?>