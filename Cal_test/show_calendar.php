<!DOCTYPE html>
<html>
<?php
  session_start();
	$dateErr=$descERR="";
	
	
	
if(isset($_SESSION["username"]) && isset($_SESSION["password"])){
     
     $user = $_SESSION["username"];
    $pass = $_SESSION["password"];
    
   
}
			//------------------------------------
			// Insert Event in the Database
			//-----------------------------------
           include ("connect.php");
           
           if(isset($_POST["addE"])){
           	
           	$date = $_POST["date"];
           	$desc = $_POST["details"];
           	$val = true;
           	
           	if(empty($_POST["date"])){
           	
           	$dateErr = "Please Enter a Date";
           	$val = false;
           	}
           	
           	if(empty($_POST["details"])){
           	
           	$dateErr = "Please Enter Detials about the Event";
           	$val = false;
           	}
           	
           	if($val)
           	{
           		
           		
           	//----------------------------------------------------
           	// This part just gets the student id
           	//----------------------------------------------------
           		
           	 $getstudentid = mysqli_query($c9db,"Select * from student where
           	 username = '$user' and password = '$pass' ");
                 
                            if(mysqli_num_rows($getstudentid) > 0){
                              while($row = mysqli_fetch_assoc($getstudentid)){
                                 $sid = $row["ID"];
                                
                              }
                            }	
           		
           		
           	//--------------------------------------	
           	// Makes a unqiue Id for each event.  
           	//----------------------------------------
           	
           	 $eid = mysqli_query($db,"SELECT max(id) FROM events"); 
           	 // Gets the Max or biggest id in the events table
                                     
                      if(mysqli_num_rows($eid) > 0)
                           {
                             while($row = mysqli_fetch_assoc($eid)){
                                 $eid =  $row["max(id)"];
                                   }
                           }
                                       
                       // If there is no id in the events table yet, it will return NULL
                       // so make the first id 1.
                       // Else if the is an id, it will add 1 to the max, or the biggest one.
                                       if($eid == NULL)
                                       {
                                           $eid = 1;
                                       }
                                       else
                                       {
                                           $eid++; 
                                       }
           	
           }
           
           //------------------------------------
           // Insert into tablename (each column name in the database, excatly as there are)
           // then the values.
           //----------------------------------
           
           $addevent = mysqli_query($db, "INSERT INTO events (id,description,evdate,sid)
           VALUES ($eid, '$desc','$date',$sid)");
           
           
           
         
           
           
           
           }


?>




<head>
<link href="calCss.css" rel="stylesheet" type="text/css" media="all"/>	
<script language="JavaScript" type="text/javascript">
function initialCalendar(){
	var hr = new XMLHttpRequest();
	var url = "calendar_start.php";
	var currentTime = new Date();
	var month = currentTime.getMonth() + 1;
	var year = currentTime.getFullYear();
	showmonth = month;
	showyear = year;
	var vars = "showmonth="+showmonth+"&showyear="+showyear;
	hr.open("POST", url, true);
	hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	hr.onreadystatechange = function() {
		if(hr.readyState == 4 && hr.status == 200) {
			var return_data = hr.responseText;
			 document.getElementById("showCalendar").innerHTML = return_data;
		}
	}
	hr.send(vars);
	document.getElementById("showCalendar").innerHTML = "processing...";
}
</script>

<script language="JavaScript" type="text/javascript">
function next_month(){
	var nextmonth = showmonth + 1;
	if(nextmonth > 12) {
		nextmonth = 1;
		showyear = showyear + 1;
	}
	showmonth = nextmonth;
	
	var hr = new XMLHttpRequest();
	var url = "calendar_start.php";
	var vars = "showmonth="+showmonth+"&showyear="+showyear;
	hr.open("POST", url, true);
	hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	hr.onreadystatechange = function() {
		if(hr.readyState == 4 && hr.status == 200) {
			var return_data = hr.responseText;
			 document.getElementById("showCalendar").innerHTML = return_data;
		}
	}
	hr.send(vars);
	document.getElementById("showCalendar").innerHTML = "processing...";
}
</script>

<script language="JavaScript" type="text/javascript">
function last_month(){
	var lastmonth = showmonth - 1;
	if(lastmonth < 1) {
		lastmonth = 12;
		showyear = showyear - 1;
	}
	showmonth = lastmonth;
	
	var hr = new XMLHttpRequest();
	var url = "calendar_start.php";
	var vars = "showmonth="+showmonth+"&showyear="+showyear;
	hr.open("POST", url, true);
	hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	hr.onreadystatechange = function() {
		if(hr.readyState == 4 && hr.status == 200) {
			var return_data = hr.responseText;
			 document.getElementById("showCalendar").innerHTML = return_data;
		}
	}
	hr.send(vars);
	document.getElementById("showCalendar").innerHTML = "processing...";
}
</script>

<script type="text/javascript">
function overlay() {
    el = document.getElementById("overlay");
	el.style.display = (el.style.display == "block") ? "none" : "block";
	el = document.getElementById("events");
	el.style.display = (el.style.display == "block") ? "none" : "block";
	el = document.getElementById("eventsBody");
	el.style.display = (el.style.display == "block") ? "none" : "block";
}
</script>

<script language="JavaScript" type="text/javascript">
function show_details(theId) {
	var deets = (theId.id);
	el = document.getElementById("overlay");
	el.style.display = (el.style.display == "block") ? "none" : "block";
	el = document.getElementById("events");
	el.style.display = (el.style.display == "block") ? "none" : "block";
	var hr = new XMLHttpRequest();
	var url = "events.php";
	var vars = "deets="+deets;
	hr.open("POST", url, true);
	hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	hr.onreadystatechange = function() {
		if(hr.readyState == 4 && hr.status == 200) {
			var return_data = hr.responseText;
			 document.getElementById("events").innerHTML = return_data;
		}
	}
	hr.send(vars);
	document.getElementById("events").innerHTML = "processing...";
}
</script>

</head>
	<button id = "add" onclick = "addEvent('Event', 'add')"> Add Event </button>
		<form id = "Event" method = "post" action = "show_calendar.php" style = "display: none">
			<fieldset>
				<legend>Add an Event</legend>
				<p><label class="field" for="date">Date:</label><input type="date" name="date" class="textbox-size"/></p>
				<p></p>
				<p><label class="field" for="details">Details:</label><input type="text" name="details" class="textbox-size"/></p>
			</p>
		<p><left><input type="submit" name="addE" style="height:22px; width:153px" value="Add" ></center></p>
			</fieldset>
		</form>
<script>
	function addEvent(id, id2){
		var p = document.getElementById(id);
	     if( p.style.display == 'none') 
		 {
			document.getElementById(id).style.display = 'block';
			document.getElementById(id2).innerHTML = "Hide Form";
		}else{
		document.getElementById(id).style.display = 'none';
		document.getElementById(id2).innerHTML = "Add Event";
		}
	}
</script>
<script>
	function editEvent(){
		
	}
	
</script>
<script>
	function deleteEvent(){
		var del = (theId.id);
		el = document.getElementById("overlay");
		el.style.display = (el.style.display == "block") ? "none" : "block";
		el = document.getElementById("events");
		el.style.display = (el.style.display == "block") ? "none" : "block";
		var hr = new XMLHttpRequest();
		var url = "events.php";
		var vars = "del="+del;
		hr.open("POST", url, true);
		hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		hr.onreadystatechange = function() {
			if(hr.readyState == 4 && hr.status == 200) {
				var return_data = hr.responseText;
				document.getElementById("events").innerHTML = return_data;
			}
		}
		hr.send(vars);
		document.getElementById("events").innerHTML = "processing...";
}

</script>
<body onLoad="initialCalendar();">
<div id="showCalendar"></div>
<div id="overlay">
<div id ="events" ></div>
</div>

 



</body>
</html>