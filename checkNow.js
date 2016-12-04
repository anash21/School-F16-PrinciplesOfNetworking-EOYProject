/*
function test(){
	alert("Test pass");
}

function internalTest(){
	tr = "test";
	return tr;
}
*/

//-----------------------------------------------------------------------------------------------------------------------------	
//-----------------------------------------------------------------------------------------------------------------------------	
//-----------------------------------------------------------------------------------------------------------------------------	
//-----------------------------------------------------------------------------------------------------------------------------

var check;

function time(set){
	//Local hour in military time (0-23)
	if(set == 1){
		var d = new Date();
		var Shour = d.getHours(); //alert(Shour);
		var Ehour = Shour + 1; /*alert(Ehour);*/ //alert("Check between " + Shour + " and " + Ehour);
	}
	if(set == 2){
		var d = new Date();
		var hour = d.getHours();
		var Shour = hour + 1; //alert(typeof(Shour)); //alert(Shour);
		var Ehour = Shour + 1; //alert(Ehour); //alert("Check between " + Shour + " and " + Ehour);
	}
	if(set == 3){ //alert("Test");
		var d = new Date();
		var hour = d.getHours(); //alert(hour);
		var Shour = (hour - hour) + 8; /*alert(typeof(Shour));*/ //alert(Shour);
		var Ehour = Shour + 12; //alert(Ehour);
	}
	
	//Get timezone offset
	var z = new Date()
	var n = d.getTimezoneOffset(); //alert(n); //Is given in minutes
	var offset = n/60; //alert(offset); //Converted to hours
	
	//Create current date
	var dateObj = new Date();
	var month = dateObj.getUTCMonth() + 1; //alert(month);//months from 1-12
	var day = dateObj.getDate(); //alert(day);
	var year = dateObj.getUTCFullYear(); //alert(year);
	var newdate = year + "-" + month + "-" + day; //alert(newdate);
	
	//Create beginning and ending time parameters for current hour
	var start = newdate + "T" + Shour + ":00:00-0" + offset + ":00"; //alert(start);
	var end = newdate + "T" + Ehour + ":00:00-0" + offset + ":00"; //alert(end);
	//alert("check between " + start + " and " + end);
	
	var time = start + "w" + end;
	return time;
}

	//Phone number
	var num = 0;

//-----------------------------------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------------------	
//-----------------------------------------------------------------------------------------------------------------------------	
//-----------------------------------------------------------------------------------------------------------------------------	

function appendResults(text){
	//var results = document.getElementById("results");//
	//results.appendChild(document.createElement('P'));
	//results.appendChild(document.createTextNode(text));
}

function makeRequest(){	
	//alert(check);
	var intrvl = time(check);
	
	var interval = intrvl.split("w"); //alert("check between " + interval[0] + " and " + interval[1]);
	
	var strt = interval[0];
	var nd = interval[1]; //alert("check between " + strt + " and " + nd);
	
	var request = gapi.client.calendar.events.list({'calendarId' : 'pk9ubvqhu6hsrp59g4io5db5ek@group.calendar.google.com', 'timeMax' : nd, 'timeMin' : strt});
	
	var answer = "";
	
	//alert(num + " make request");
	
	request.then(function(response){
		//appendResults(response.result.items.summary);
		//var something = appendResults(response.result.items.summary);
		//var numOfThings = response.result.items.length; 
		document.getElementById("size").innerHTML=response.result.items.length;
		
		var itemSize = response.result.items.length; //alert(itemSize);
		
		for(i = 0; i < itemSize; i++){
			//appendResults(response.result.items[i].summary);//
			
			document.getElementById("results").innerHTML=response.result.items[i].summary;
			document.getElementById("desc").innerHTML=response.result.items[i].description;
			
			var summary = response.result.items[i].summary;
			var description = response.result.items[i].description;
			
			answer += summary + "-" + description + "-";//Possible to make this an array? Else pass the whole thing as one long string instead of in parts
			
			//alert(answer);	
		}
		
		if(itemSize > 0){
			//alert("The check found something");
			
			if(check == 3){/* For when I have more than one thing to do in a day */ //alert("More than one");			
				
				$.ajax({ url: 'RespondT.php',
					data: {action: 'reply',
							size: itemSize,
							number: num,
							sched: answer,
							timeframe: "today"},
							
					type: 'post',
					success: function(output) {
							//alert(output);
					}
				});
				
			}else{/* For when the check is for only one hour; either this hour or the next hour */ //alert("Only one");
				
				var when = "";
				if(check == 1){
					when = "now";
				}
				if(check == 2){
					when = "later";
				}
				
				$.ajax({ url: 'Respond.php',
					data: {action: 'reply',
						number: num,
						name: summary,
						desc: description,
						timeframe: when},
								
					type: 'post',
					success: function(output) {
							//alert(output);
					}
				});
					
			}
			
		}
		if(itemSize == 0){
			//alert("The check found nothing and check is " + check);
			
			var frm = "";
			if(check == 1){
				frm = "now";
			}
			if(check == 2){
				frm = "later";
			} 
			if(check == 3){
				frm = "today";
			} //alert(frm);
			
			
			$.ajax({ url: 'sendFree.php',
				data: {action: 'reply',
					empty: "true",
					number: num,
					timeframe: frm},
				
				type: 'post',
				success: function(output) {
					alert(output);
				}
			});
			
		}		

	}, function(reason){
		console.log('Error: ' + reason.result.error.message);
	});

}

function init() {
	gapi.client.setApiKey('AIzaSyCafmjGOKunPiFZmC7NqUNoUfzi_6kw5VM');
	gapi.client.load('calendar', 'v3').then(makeRequest);
}

function bsy(number, when){
	num = number; //alert(num);
	check = when; //alert(check); /*alert(when);*/
	
	//check();
	
	//alert(number + "Check now");
	//var test = internalTest();
	//alert(test + " call request");
}