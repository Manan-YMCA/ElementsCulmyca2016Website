<?php

	//MAILGUN
	require 'php/vendor/autoload.php';
	use Mailgun\Mailgun;

	# Instantiate the client.
	$mgClient = new Mailgun('key-3qzkjwywk-67fwlke64w99s6cxpwo2z8');
	$domain = "pravega.org";
	//END MAILGUN
	
	$email_ids = array("pavankumarkaushik1993@gmail.com","hannah.athaide@gmail.com","prachitha7@gmail.com","jagath.iceburn@gmail.com","anirudhkaja@gmail.com","karthikshankershanker@gmail.com","nick041995@gmail.com","bhoomika10@gmail.com","prasanthnori@gmail.com","emm.nair@gmail.com","kvk1293@gmail.com","priyankapikachu@gmail.com","pkundu46@gmail.com","asknuts14021992@gmail.com","akhila.r96@gmail.com","akshatha.n96@gmail.com","deepthicm1995@gmail.com","purabipdeshpande@hotmail.com","davidjns333@gmail.com","kruthika.95@gmail.com","loveviolinvarsha@gmail.com","vishnuhaveri@gmail.com","svidya99@gmail.com","rupsaban90@gmail.com","nawazahid@gmail.com","smitha1075@iiserkol.ac.in","onamiiserk@gmail.com","praveen1080@iiserkol.ac.in");
	
	foreach ($email_ids as $email)
	{
		$subject = 'Pravega Prize Payment Details';

		// message
		$message = '
		<html>
		<head>
		  <title>'.$subject.'</title>
		</head>
		<body>
			<p>Greetings from Pravega!</p>

			<p>Congratulations on winning events at Pravega held from January 31 - February 2nd!</p>

			<p>To complete your prize money transfer, we require some details from your side:<br>
			1. Complete home address<br>
			2. Beneficiary Name (to be used on cheque)<br>
			3. Bank branch name and IFSC Code (at which your account is)<br>
			4. Account number</p>

			<p>Please furnish all these details as soon as possible. It will not be possible for us to wait very long before starting transfers.</p>

			<p><b>Please send the above details for only one team member per team.</b> The money will be transferred/cheque will be sent to this single person to avoid confusion. Mention the event(s) for which this person is representing his/her team. If you have won multiple events with different teams, please still ensure that one person is mentioned per team along with event name(s).</p>

			<p>Further details about payment method, etc. will be sent shortly.</p>
			
			<p>If you are receiving this mail a second time, we apologize.

			<p>Thank you and congratulations again!</p>

			<p>Team Pravega</p>
		</body>
		</html>
		';
		
		// Mail it
		$mail_result = $mgClient->sendMessage("$domain",
			  array('from'    => 'Pravega Team <prizes@pravega.org>',
					'to'      => $email,
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
?>