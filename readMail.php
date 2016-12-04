<?php

function textreceived(){
	
	/* include file that has username and password */
	include("Secrets.php");
	
	/* Connect to gmail */
	$hostname = '{imap.gmail.com:993/imap/ssl}INBOX'; //echo $use; echo $pass;
		
	/* Try  to connect */
	$inbox = imap_open($hostname,$use,$pass,NULL,1) or die('Cannot connect to Gmail: ' . print_r(imap_errors()));

	/*Grab unread emails */
	$emails = imap_search($inbox,'UNSEEN');

	$output = '';

	$message = '';

	foreach($emails as $mail){

		$headerInfo = imap_headerinfo($inbox,$mail);

		//$output .= $headerInfo->subject.'<br/>';
		//$output .= $headerInfo->toaddress.'<br/>';
		//$output .= $headerInfo->date.'<br/>';
		//$output .= $headerInfo->fromaddress.'<br/>';
		$from = $headerInfo->fromaddress;
		//$output .= $headerInfo->reply_toaddress.'<br/>';

		$emailStructure = imap_fetchstructure($inbox,$mail);

		//if(!isset($emailStructure->parts)) {
			$output .= imap_body($inbox, $mail);
		//}else{
			//
		//}

		if(strpos($from,"(321) 439-4837") !== false){
			//echo $output;
			$auth = 0;
			$message = $from . "|-|" . $output . "|-|" . $auth . "<br/>";
			$command = $output;
		}else{
			//echo "Fail test";
			$auth = 1;
			$message = $from . "|-|" . $output . "|-|" . $auth . "<br/>";
			$command = $output;
		}
		$output = ''; echo $output;
		
		return $message;

	}

	//return $message;

	// close the connection
	imap_expunge($inbox);
	imap_close($inbox);
}

//$msg = textreceived(); //echo $msg;

?>