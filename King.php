<html>
<head>
<title>Sits on top of all commands</title>
<META HTTP-EQUIV="refresh" CONTENT="30">

<script src="https://apis.google.com/js/client.js?onload=init"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="/js/jquery.min.js"></script>
<script src="/avesi/jquery.paulund_modal_box.js"></script>
<script type="text/javascript" src="checkNow.js"></script>

<script>
/*
function appendResults(text){
	var results = document.getElementById("results");
	results.appendChild(document.createElement('P'));
	results.appendChild(document.createTextNode(text));
}

function makeRequest(start, end){
	//var request = gapi.client.calendar.events.list({'calendarId' : 'pk9ubvqhu6hsrp59g4io5db5ek@group.calendar.google.com', 'timeMax' : '2016-10-20T11:00:00-04:00', 'timeMin' : '2016-10-20T10:00:00-04:00'});
	
	//alert("Check between " + start + " and " + end + "!");
	
	//var start = '2016-10-20T10:00:00-04:00';
	//var end = '2016-10-20T11:00:00-04:00';
	
	var request = gapi.client.calendar.events.list({'calendarId' : 'pk9ubvqhu6hsrp59g4io5db5ek@group.calendar.google.com', 'timeMax' : end, 'timeMin' : start});
	
	request.then(function(response){
		appendResults(response.result.items.summary);
		var something = appendResults(response.result.items.summary);
		document.getElementById("size").innerHTML=response.result.items.length;
		
		var itemSize = response.result.items.length;
		
		for(i = 0; i < itemSize; i++){
			appendResults(response.result.items[i].summary);
		}
		
	}, function(reason){
		console.log('Error: ' + reason.result.error.message);
	});
}

function init() {
  gapi.client.setApiKey('AIzaSyCafmjGOKunPiFZmC7NqUNoUfzi_6kw5VM');
  gapi.client.load('calendar', 'v3').then(makeRequest);
}
*/
</script>

<script>
function now(number){
	//test();
	
	var num = number; /*alert(num); alert(number);*/
	
	bsy(num, 1);
	
	//Logic check
	/*
	if(Shour >= 8 && Ehour <= 17){
		//I might be busy after 8 am and before 5 pm 
		//Check if I'm busy this hour
	} else {
		//It's too early or too late to be busy
		//Auto response
	}
	*/
}

function later(number){
	var d = new Date();
	var hour = d.getHours(); //alert(Shour);
	var Shour = hour + 1;
	var Ehour = Shour + 1; //alert("Check between " + Shour + " and " + Ehour);
	
	var num = number; //alert(number);
	
	//alert("hello2");
	
	bsy(num, 2);
	
	if(Shour > 8){
		//Check if I'm busy this hour
	} else {
		//It's too early to be busy
	}
}

function today(number){
	var busy = "today"; //alert(busy);
	
	var num = number; //alert(number);
	
	bsy(num, 3);
}

/*
function test(number){
	alert(number);
}
*/
</script>

<script src="https://apis.google.com/js/client.js?onload=init"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</head>

<body>

<?php
/* Connect to gmail and retreive unread messages + sender's number */
include 'readMail.php';

/* Message + number seperated by "-" symbol */
$textMssg = textreceived(); //echo $textMssg;

/* Parse message + number */
$text = explode("|-|", $textMssg); //print ("The message is " . $text[1] . " and it came from " . $text[0]);

/* Create number variable */
$num = substr($text[0], 1, 14); //echo $number;
$number = preg_replace('/[^0-9.]+/', '', $num);

/* Create command variable */
$command =  explode("-", $text[1]); //var_dump($command);

/* Core command variable */
$basecommand = $command[0]; //echo $basecommand;

/* Core command type */
$secondarycommand = strip_tags($command[1]); 
$secondarycommand = trim($secondarycommand); //echo $secondarycommand; var_dump($secondarycommand);

/*
$number = 1234567890;

echo '<script type="text/javascript">',
		'now('.$number.');',
		'</script>'
		;
*/

switch($secondarycommand){
	case "now":
		//echo "Want to check if I'm busy now.";
		//echo $number
		
		echo '<script type="text/javascript">',
		'now('.$number.');',
		'</script>'
		;
		
		break;
	case "later":
		//echo "Want to check if I'm busy later.";
		
		echo '<script type="text/javascript">',
			 'later('.$number.');',
			 '</script>'
			 ;
		
		break;
	case "today":
		//echo "Want to check my schedule for today.";
		
		echo '<script type="text/javascript">',
			 'today('.$number.');',
			 '</script>'
			 ;
		
		break;
	case "help":
		//echo "I need help";
		
		break;
	default:
		echo "Error";
}

?>

<div id='results'></div>
<br>
<div id='desc'></div>
<br>
<div id='size'></div>

</body>
</html>