<?php
	include('db_config.php');
	
	$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
	
	$query = "SELECT event_name, 1st, 2nd, 3rd, comments FROM winners ORDER BY event_name ASC";
	$result = mysqli_query($link, $query);
	
	echo "<table><tr style='border-bottom: black solid 1px;'><td><b>Event Name</b></td><td><b>Place</b></td><td><b>Names</b></td><td><b>Email</b></td><td><b>College</b></td><td><b>Comments</b></td></tr>";
	
	while ($row = mysqli_fetch_row($result))
	{
		echo "<tr><td rowspan='3'>".$row[0]."</td><td>1st</td><td>";
		
		$emails = explode(",", $row[1]);
		$emails = '"' . implode('","', $emails) . '"';
		$query2 = "SELECT firstname, lastname FROM usernames WHERE email IN (".$emails.")";
		$result_names = mysqli_query($link, $query2);
		
		echo "<ol>";
		while ($row_names = mysqli_fetch_row($result_names))
		{
			echo "<li>" . $row_names[0] . " " . $row_names[1] . "</li>";
		}
		echo "</ol>";
		
		echo "</td><td>";
		echo implode("<br>", explode(",", $row[1]));
		echo "</td><td>";
		
		mysqli_free_result($result_names);
	
		$query2 = "SELECT college FROM usernames WHERE email IN (".$emails.")";
		$result_college = mysqli_query($link, $query2);
		
		while ($row_college = mysqli_fetch_row($result_college))
		{
			echo $row_college[0] . "<br>";
		}
		
		echo "</td><td rowspan='3'>";
		echo $row[4];
		echo "</td></tr>";
		
		mysqli_free_result($result_college);
		
		//2nd Place
		
		echo "<tr><td>2nd</td><td>";
		
		$emails = explode(",", $row[2]);
		$emails = '"' . implode('","', $emails) . '"';
		$query2 = "SELECT firstname, lastname FROM usernames WHERE email IN (".$emails.")";
		$result_names = mysqli_query($link, $query2);
		
		echo "<ol>";
		while ($row_names = mysqli_fetch_row($result_names))
		{
			echo "<li>" . $row_names[0] . " " . $row_names[1] . "</li>";
		}
		echo "</ol>";
		
		echo "</td><td>";
		echo implode("<br>", explode(",", $row[2]));
		echo "</td><td>";
		
		mysqli_free_result($result_names);
	
		$query2 = "SELECT college FROM usernames WHERE email IN (".$emails.")";
		$result_college = mysqli_query($link, $query2);
		
		while ($row_college = mysqli_fetch_row($result_college))
		{
			echo $row_college[0] . "<br>";
		}
		
		echo "</td></tr>";
		
		mysqli_free_result($result_college);
		
		//3rd Place
		
		echo "<tr style='border-bottom: black solid 1px;'><td>3rd</td><td>";
		
		$emails = explode(",", $row[3]);
		$emails = '"' . implode('","', $emails) . '"';
		$query2 = "SELECT firstname, lastname FROM usernames WHERE email IN (".$emails.")";
		$result_names = mysqli_query($link, $query2);
		
		echo "<ol>";
		while ($row_names = mysqli_fetch_row($result_names))
		{
			echo "<li>" . $row_names[0] . " " . $row_names[1] . "</li>";
		}
		echo "</ol>";
		
		echo "</td><td>";
		echo implode("<br>", explode(",", $row[3]));
		echo "</td><td>";
		
		mysqli_free_result($result_names);
	
		$query2 = "SELECT college FROM usernames WHERE email IN (".$emails.")";
		$result_college = mysqli_query($link, $query2);
		
		while ($row_college = mysqli_fetch_row($result_college))
		{
			echo $row_college[0] . "<br>";
		}
		
		echo "</td></tr>";
		
		mysqli_free_result($result_college);
	}
	
	echo "<tr><td></td><td></td><td></td><td></td><td></td></tr></table>";
?>