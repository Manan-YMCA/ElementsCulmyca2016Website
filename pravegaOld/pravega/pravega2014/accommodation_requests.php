<style>
table
{
	border: 1px solid black;
}

td
{
	padding: 5px 10px 5px 10px;
	border-bottom: 1px solid black;
}
</style>

<?php
	include('db_config.php');
	
	$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
	
	$query = 'SELECT email, city, gender FROM `usernames` WHERE accommodation = 1';
	$result = mysqli_query($link, $query);
	
	echo "<b>Number of requests:</b> " . mysqli_num_rows($result);
	echo "<br><br><b><u>Request Details</u></b><br><br>";
	echo "<table><tr><td><b>Name</b></td><td><b>City</b></td><td><b>Gender</b></td></tr>";
	
	while ($row = mysqli_fetch_row($result))
	{
		echo "<tr><td>";
		echo $row[0];
		echo "</td><td>";
		echo $row[1];
		echo "</td><td>";
		echo $row[2];
		echo  "</td></tr>";
	}
	
	echo "</table>";
	
	mysqli_free_result($result);		
	mysqli_close($link);
?>