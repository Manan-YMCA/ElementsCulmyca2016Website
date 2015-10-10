<style>
	table
	{
		padding: 10px;
	}
	
	td
	{
		padding: 7px;
		border-bottom: 1px solid black;
	}

</style>
<?php
	include('db_config.php');
	
	$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
	$query = "SELECT * FROM accommodation";
	$result = mysqli_query($link, $query);
	
	echo "<table>";
	echo "<tr><td><b>Email</b></td><td><b>Name</b></td><td><b>Gender</b></td><td><b>Arrival</b></td><td><b>Departure</b></td><td><b>Event Registered</b></td><td><b>City</b></td><td><b>Explara No.</b></td></tr>";
	while ($row = mysqli_fetch_row($result))
	{
		echo "<tr><td>";
		echo $row[0];
		echo "</td><td>";
		echo $row[1];
		echo "</td><td>";
		echo $row[2];
		echo "</td><td>";
		echo $row[3];
		echo "</td><td>";
		echo $row[4];
		echo "</td><td>";
		echo $row[5];
		echo "</td><td>";
		echo $row[6];
		echo "</td><td>";
		echo $row[7];
		echo "</td></tr>";
	}
	echo "</table>";
	mysqli_free_result($result);
?>
	