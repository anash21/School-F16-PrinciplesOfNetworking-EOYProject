<?php
/* Include file that sends messege */
include ("sendResponse.php");

if(isset($_POST['action']) && !empty($_POST['action'])) {
    $action = $_POST['action']; //echo $action;
	
	$phoneNumber = $_POST['number'];
	$className = $_POST['name'];
	$description = $_POST['desc'];
	$when = $_POST['timeframe'];
	
	//echo "I am in " . $className . " " . $description . " and I am sending this to " . $phoneNumber;
    
	//Test switch statement
	/*
	switch($action) {
        case 'reply': 
			//echo "I am in " . $className . " from " . $description . " send to " . $phoneNumber; //testInc();
			break;
        default:
			echo "error";
    }
	*/
		
	//Decides what to do based on the time period being asked about is
	switch($when){
		case 'now':
			//echo "Going to answer concerning " . $when; testInc();
			//echo "The following will be sent to the function " . $phoneNumber . " and " . $className . " and " . $description;
			send($phoneNumber, $className, $description, $when);
			break;
		case 'later':
			//echo "Going to answer concerning " . $when;
			send($phoneNumber, $className, $description, $when);
			break;
		default:
			echo "Error";
	}
	
}
?>