<?php
	include('db_config.php');
	
	//MAILGUN
	require 'php/vendor/autoload.php';
	use Mailgun\Mailgun;

	# Instantiate the client.
	$mgClient = new Mailgun('key-3qzkjwywk-67fwlke64w99s6cxpwo2z8');
	$domain = "pravega.org";
	//END MAILGUN
	
	$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
	
	//$events = array("CAN Sat Workshop", "Mobile Making Workshop", "RC Cars Workshop", "Flying Machine Nano Workshop", "Gesture Game Development Workshop", "Cloud Computing and Google App Engine Workshop");
	$event_name = "Treasure Hunt";
	
	//foreach ($events as $event_name)
	//{
		$query = 'SELECT `'. $event_name. '` FROM `teams` WHERE `'. $event_name .'` != ""';
		$result = mysqli_query($link, $query);
		
		$emails = null;
		$i = 0;
		
		while ($row = mysqli_fetch_row($result))
		{
			$emails[$i] = $row[0];
			$i++;
		}
		
		$teams = null;
		$num_teams = 0;	
		
		for ($i=0; $i < sizeof($emails); $i++)
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
		
		for ($i = 0; $i<$num_teams; $i++)
		{
			$subject = 'Pravega Treasure Hunt: Important Information';

			$team_list = '';
			$team_emails = explode(",", $teams[$i]);
			
			for ($j=0; $j < sizeof($team_emails); $j++)
			{
				$team_list = $team_list . $team_emails[$j] . '<br>';
			}
			
			$extra_info = '';
			
			if (strcmp($event_name, 'CAN Sat Workshop') == 0)
				$extra_info = 'Please choose the ticket "Design And Launching Of CAN Satellite (Individual Entry)" and purchase one ticket for each team member. Teams will be taken care of at Pravega.<br><br>';
			
			$event_name2 = $event_name;
			
			if (strcmp($event_name, 'Flying Machine Nano Workshop') == 0)
				$event_name2 = 'Quadcopter Workshop';
			
			// message
			$message = '
			<html>
			<head>
			  <title>'.$subject.'</title>
			</head>
			<body>
				<p>Dear Participants,</p>

				<p>You have registered for Pravega Treasure Hunt. This is some important information needed for prelims:</p>
				
				<p>Prelims clue will be sent by mail and text message between 11:15 - 11:30 on Saturday, February 1st. If not yet received by 11:30, contact the following at the main building.<br>Hemaa S - 9448173998</p>

				<p>Sriram C.<br>
				Treasure Hunt Coordinator<br>
				Pravega 2014</p>
			</body>
			</html>
			';
			
			// Mail it
			$mail_result = $mgClient->sendMessage("$domain",
				  array('from'    => 'Sriram C. <sriramc@pravega.org>',
						'to'      => $teams[$i],
						'subject' => $subject,
						'text'    => '',
						'html' => $message));
			
			echo $mail_result->http_response_body->message;
			echo " ID: " . $mail_result->http_response_body->id;
			echo "<br>";
		}
		echo "<br>";
		echo $message;
		echo "<br><br>";
	//}
	
	mysqli_free_result($result);		
	mysqli_close($link);

?>