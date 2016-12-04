<?php
/* Include file that sends messege */
include ("sendResponse.php");

if(isset($_POST['action']) && !empty($_POST['action'])) {
    $action = $_POST['action']; //echo $action;
	
	$phoneNumber = $_POST['number'];
	$numOfThings = $_POST['size'];
	$scheduleU = $_POST['sched'];
	$when = $_POST['timeframe'];
	
	//echo "I am in " . $className . " " . $description . " and I am sending this to " . $phoneNumber;
	
	$scheduleD = explode("-", $scheduleU); //var_dump($scheduleD);
	
	$arraySize = sizeof($scheduleD); //echo $arraySize;
	
	$message = "My schedule for today is: ";
	
	for($i = 0; $i <= ($arraySize - 2); $i++){
		if($i == 0 || ($i % 2) == 0){
			//echo "class: " . $scheduleD[$i] . " ";
			$message .= $scheduleD[$i];
		}else{
			//echo "time: " . $scheduleD[$i] . " ";
			if($i == ($arraySize - 2)){
				$message .= " " . $scheduleD[$i];
			}else{
				$message .= " " . $scheduleD[$i] . ", ";
			}
		}
	}
	
	//echo $message;
	
	
	//Test switch statement
	switch($action) {
        case 'reply': 
			//echo $message . " send to " . $phoneNumber;
			//testInc();
			sendT($phoneNumber, $message);
			break;
        default:
			echo "error";
    }
	
	/*
	//Decides what to do based on the time period being asked about is
	switch($when){
		case 'today':
			echo "Going to answer concerning " . $when;
			break;
		default:
			echo "Error";
	}
	*/
	
}
?>