<?php
	include('db_config.php');
	
	$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
	$start = $_GET['start'];
	$query = 'SELECT email, firstname, lastname, mobile, id FROM usernames WHERE mobile!="" LIMIT ' . $start . ',10';

	$result = mysqli_query($link, $query);
	
	echo "<table>";
	echo "<tr><td><b>Email</b></td><td><b>Name</b></td><td><b>Mobile Number</b></td><td><b>Pravega ID</b></td></tr>";
	while ($row = mysqli_fetch_row($result))
	{
		echo "<tr><td>";
		echo $row[0];
		echo "</td><td>";
		echo $row[1] . " " . $row[2];
		echo "</td><td>";
		echo $row[3];
		echo "</td><td>";
		echo $row[4];
		echo "</td></tr>";
	}
	echo "</table>";

?>