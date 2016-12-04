<?php
if(isset($_POST['action']) && !empty($_POST['action'])) {
	
	$nill = $_POST['empty'];
	
	/* Include file that sends messege */
	include ("sendResponse.php");

	/*function send($recipient, $class, $time, $when){*/
	function free(){
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
			//5 => "@vmobl.com", //For Virgin Mobile
			//6 => "@mmst5.tracfone.com", //For Tracfone
			//7 => "@mymetropcs.com", //For Metro PCS
			//8 => "@myboostmobile.com", //For Boost Mobile
		);
		
		for($i = 1; $i <= 4; $i++)
		{
			//Pear Mail Library
			require_once "/usr/share/php/Mail.php";
			
			//Fills in the from field
			$from = '<austinpi2195@gmail.com>';
			
			//Fills in the to field
			$recipient = $_POST['number'];
			$to = $recipient . $carrier[$i];
			
			//Fills in the subject field
			$subject = "";
			
			//Fills in the body field
			$version = $_POST['timeframe'];
			switch($version){
				case "now":
					$body = "I have nothing for this hour";
					break;
				case "later":
					$body = "I have nothing in the next hour";
					break;
				case "today":
					$body = "I have nothing for today";
					break;
				default:
					echo "error";
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

	if($nill = "true"){
		//echo("Test");
		free();
	}
}
?>