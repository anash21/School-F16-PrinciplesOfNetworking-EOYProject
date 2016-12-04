<?php
/* include file that has username and password */
include("Secrets.php");

function testInc(){
	include("Secrets.php");
	echo "Test incldue good";
	//echo "I will be using the username " . $use . " and the password " . $pass;
}

function send($recipient, $class, $time, $when){
	//echo "I will send a message to " . $recipient . " telling them that I am in " . $class . " from " . $time;
	
	include("Secrets.php");	
	
	/* email addresses for sending texts to different cell carriers */
	$carrier = array(
		1 => "@txt.att.net", //For AT&T
		2 => "@tmomail.net", //For T-Mobile
		3 => "@vtext.com", //For Verizon
		/* Alternative for Sprint */
		/*    @pm.sprint.com      */
		4 => "@messaging.sprintpcs.com", //For Sprint 
		5 => "@vmobl.com", //For Virgin Mobile
		6 => "@mmst5.tracfone.com", //For Tracfone
		7 => "@mymetropcs.com", //For Metro PCS
		8 => "@myboostmobile.com", //For Boost Mobile
	);
	
	for($i = 1; $i < 8; $i++)
	{
		//Pear Mail Library
		require_once "/usr/share/php/Mail.php"; //get from pi
		
		//Fills in the from field
		$from = '<austinpi2195@gmail.com>';
		
		//Fills in the to field
		//$to = $recipient . $carrier[2];
		$to = $recipient . $carrier[$i];
		
		//Fills in the subject field
		$subject = "";
		
		//Fills in the body field
		if($when == 'now'){
			$body = "I am in " . $class . " " . $time;
		}
		if($when == 'later'){
			$body = "I will be in " . $class . " " . $time;
		}
		
		//var_dump($to); //echo "Will send " . $body . " to " . $to . " with the subject " . $subject;
		
		//Create header for message
		$headers = array(
			'From' => $from,
			'To' => $to,
			'Subject' => $subject
		);
		
		//Connect to gmail
		$smtp = Mail::factory('smtp', array(
				'host' => 'ssl://smtp.gmail.com',
				'port' => '465',
				'auth' => true,
				'username' => $use,
				'password' => $pass
			));
			
		//Construct message that will be sent
		$mail = $smtp->send($to, $headers, $body);
		
		//Send message
		if(PEAR::isError($mail)){
			echo('<p>' . $mail->getMessage() . '</p>');
		}else{
			echo('<p>Message successfully sent!</p>');
		}
	}
}

function sendT($recipient, $message){
	include("Secrets.php");
	//echo "I will send a message to " . $recipient . " telling them that I am in " . $class . " from " . $time;
	
	/* email addresses for sending texts to different cell carriers */
	/*--------------------------------------------------------------*/
	$carrier = array(
		1 => "@txt.att.net", //For AT&T
		2 => "@tmomail.net", //For T-Mobile
		3 => "@vtext.com", //For Verizon
		/* Alternative for Sprint */
		/*    @pm.sprint.com      */
		4 => "@messaging.sprintpcs.com", //For Sprint 
		5 => "@vmobl.com", //For Virgin Mobile
		6 => "@mmst5.tracfone.com", //For Tracfone
		7 => "@mymetropcs.com", //For Metro PCS
		8 => "@myboostmobile.com", //For Boost Mobile
	);
	/*--------------------------------------------------------------*/
	
	for($i = 1; $i < 8; $i++)
	{
		//Pear Mail Library
		require_once "/usr/share/php/Mail.php"; //get from pi
		
		/* Variables necessary for email header */
		/*--------------------------------------*/	
		//Fills in the from field
		$from = '<austinpi2195@gmail.com>';
		
		//Fills in the to field
		//$to = $recipient . $carrier[2];
		$to = $recipient . $carrier[$i];
		
		//Fills in the subject field
		$subject = "";
		/*--------------------------------------*/
		
		/* Contains the actual message */
		/*-----------------------------*/
		$body = $message;
		/*-----------------------------*/
		
		//var_dump($to); //echo "Will send " . $body . " to " . $to . " with the subject " . $subject;
		
		/* Create header for message */
		/*---------------------------*/
		$headers = array(
			'From' => $from,
			'To' => $to,
			'Subject' => $subject
		);
		/*---------------------------*/
		
		/* Connect to gmail */
		$smtp = Mail::factory('smtp', array(
				'host' => 'ssl://smtp.gmail.com',
				'port' => '465',
				'auth' => true,
				'username' => $use,
				'password' => $pass
				));
			
		/* Construct message that will be sent */
		$mail = $smtp->send($to, $headers, $body);
		
		/* Send message */
		if(PEAR::isError($mail)){
			echo('<p>' . $mail->getMessage() . '</p>');
		}else{
			echo('<p>Message successfully sent!</p>');
		}
	}
}

?>