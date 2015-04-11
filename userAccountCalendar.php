
<?php

include ("connect.php");
  session_start();
	$dateErr=$descERR="";

$pageFont = $_SESSION["pagefont"];
$pageStyle = $_SESSION["pagestyle"];	
$textF="";
if($pageFont){
    if($pageFont=="font1"){$textF="Trebuchet MS";}
    if($pageFont=="font2"){$textF="Georgia";}
    if($pageFont=="font3"){$textF="Arial";}
    if($pageFont=="font4"){$textF="Courier";}
}else{
    $textF="Trebuchet MS";
}
	
if(isset($_SESSION["username"]) && isset($_SESSION["password"])){
     
     $user = $_SESSION["username"];
    $pass = $_SESSION["password"];
   
   $getstudentid = mysqli_query($c9db,"Select * from student where
           	 username = '$user' and password = '$pass' ");
                 
                            if(mysqli_num_rows($getstudentid) > 0){
                              while($row = mysqli_fetch_assoc($getstudentid)){
                                 $sid = $row["ID"];
                                
                              }
                            }
   

   
   
   
} else echo " Your are not Loged in - Session test";
			//------------------------------------
			// Insert Event in the Database
			//-----------------------------------
           
           
           if(isset($_POST["addE"])){
          
           	
              $stime = $_POST["stime"];
			  $etime = $_POST["etime"];
			  $scompare = DATE("g:i a", STRTOTIME($stime));
			  $ecompare = DATE("g:i a", STRTOTIME($etime));
	        $date = $_POST["date"];
           	$desc = $_POST["details"];
			  if(empty($_POST["evtype"])){
			  $evtype = $_POST["other"];
			  }
			  else
			  {
			  	$evtype = $_POST["evtype"];
			  }
			 
        		$strday =  strtotime($date);
        		$day = date("l",$strday);
        		$dayc = $day;
        		if($dayc == "Monday")
        		{
        			$dayc = "Mo";
        		}
        		if($dayc == "Tuesday")
        		{
        			$dayc = "Tu";
        		}
        		if($dayc == "Wednesday")
        		{
        			$dayc = "We";
        		}
        		if($dayc == "Thursday")
        		{
        			$dayc = "Th";
        		}
        		if($dayc == "Friday")
        		{
        			$dayc = "Fr";
        		}
        		if($dayc == "Saturday")
        		{
        			$dayc = "Sa";
        		}
        		 
			  
			  
           
           	$val = true;
           	$that = true;
           	if(empty($_POST["date"])){
           	
           	$dateErr = "Please Enter a Date";
           	$val = false;
           	$that = false;
           	}
           	
           	if(empty($_POST["details"])){
           	
           	$detErr = "Please Enter Detials about the Event";
           	$val = false;
           	$that = false;
           	}
           	if(empty($evtype)){
           	
           	$typErr = "Please select or enter an event type";
           	$val = false;
           	$that = false;
           	}
           	if(empty($_POST["stime"])){
        	        
        	       $stimeErr = "Please enter a Course Start Time <br>";
        	        $val = false;
        	        $that = false;
        	
        	}
        	
        	   if(empty($_POST["etime"]) && ($that) ){
        	 
	      $conflict = mysqli_query($c9db,"SELECT * FROM course, linkid WHERE linkid.sid = $sid 
                   AND linkid.cid = course.cid");
                   
        
                           if(mysqli_num_rows($conflict) > 0){
                              while($row = mysqli_fetch_assoc($conflict)){
                                   $sttime  = DATE("g:i a", STRTOTIME($row["stime"]));
                                   $entime  = DATE("g:i a", STRTOTIME($row["etime"]));
                         
                               
                                   if (strpos($row["cdays"], $dayc) !== FALSE && ($scompare >= $sttime && $scompare < $entime)) 
                                 {
                                     
                                     $contime .= "Your event conflicts with your course ". $row["cname"]. " on ".$row["cdays"].
		                                   " at ".$sttime. " to ".$entime. " you should reschedule this event". "<br>"."<hr>";
		                                   $val = false;
                          
                                 }
                                   
                              }
                           }
        	            
        	         $evconflict = mysqli_query($db,"SELECT * FROM  events WHERE sid = $sid ");  
        	          if(mysqli_num_rows($evconflict) > 0){
                              while($row = mysqli_fetch_assoc($evconflict)){
                
        					$strevday =  strtotime($row["evdate"]);
        					$evday = date("l",$strevday);
        					 
        					 

                   
                                   $sttime  = DATE("g:i a", STRTOTIME($row["stime"]));
                                   $entime  = DATE("g:i a", STRTOTIME($row["etime"]));
                 
                                   if($row["etime"] != NULL){
                                   if (strpos($evday, $day) !== FALSE && ($scompare >= $sttime && $scompare < $entime)) 
                                 {
                                     $contime .= "Your event conflicts with your  ".$row["evtype"]. " on ".$evday.
		                                   " at ".$sttime. " to ".$entime. " (".$row["evdate"].")"." you should reschedule this event". "<br>"."<hr>";
		                                   $val = false;
                          
                                 }
                                   }else if($scompare == $sttime && $row["evdate"] == $date){
                                   	
                                   $contime .= "You have two events scheduled on the same date at the same time. ". 
                                   $row["evtype"] . "  " . $row["description"] . " on ". $day ."  at ".$sttime."   ". $row["evdate"]."<br>"."<hr>";	
                                   $val = false;
                                   }
                              }
                           }
                           
        	
        	}else if(!empty($_POST["etime"]) && ($that))
        	{
        		
             $conflict2 = mysqli_query($c9db,"SELECT * FROM course, linkid WHERE linkid.sid = $sid 
            AND linkid.cid = course.cid");
               
                           if(mysqli_num_rows($conflict2) > 0){
                              while($row = mysqli_fetch_assoc($conflict2)){
                                   $sttime  = DATE("g:i a", STRTOTIME($row["stime"]));
                                   $entime  = DATE("g:i a", STRTOTIME($row["etime"]));
                                     
                                 
                            
                                   
                                 
                                if(strpos($row["cdays"], $dayc) !== FALSE && ($ecompare >= $sttime && $scompare < $entime))
                                 {
                                 
		                                   $contime.= "There is a time conflict between your course ". $row["cname"]. " on ".$row["cdays"].
		                                   " at ".$sttime. " to ".$entime. "<br>" . "<hr>";
		                                   $val = false;
		                      }
                                   
                              }
                           }
        		
        		$evconflict2 = mysqli_query($db,"SELECT * FROM  events WHERE sid = $sid ");  
        	          if(mysqli_num_rows($evconflict2) > 0){
                              while($row = mysqli_fetch_assoc($evconflict2)){
                     
        					$strevday =  strtotime($row["evdate"]);
        					$evday = date("l",$strevday);
        				
                                   $sttime  = DATE("g:i a", STRTOTIME($row["stime"]));
                                   $entime  = DATE("g:i a", STRTOTIME($row["etime"]));
                 
                                 if($row["etime"] != NULL){
                                 if(strpos($evday, $day) !== FALSE  && ($ecompare >= $sttime && $scompare < $entime))
                                 {
                                
		                                  $contime .= "You have a conflict between events ". $row["evtpe"]."   ".$row["description"]. " on ".$evday.
		                                   " at ".$sttime. " to ".$entime. " you should reschedule this event". "<br>"."<hr>";
		                                   $val = false;
		                                  
		                                
                                 }
                                   }else if($scompare == $sttime && $row["evdate"] ==$date){
                                   	
                                   $contime .= "You have two events scheduled on the same date at the same time. ". 
                                   $row["evtype"] . "  " . $row["description"] . " on ". $day ." at ".$sttime."   ". $row["evdate"]."<br>"."<hr>";	
                                 
                                   }
                              
                           }
        		
        		
        		
        		
        		
        	}
           	
          
           	
           	
           	
           	
        	}
           	
           	
           	if($val)
           	{
           		
  
           		
           		
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
           if(!empty($_POST["etime"])){
           $addevent = mysqli_query($db, "INSERT INTO events (id,description,evdate,stime,etime,evtype,sid)
           VALUES ($eid, '$desc','$date','$stime','$etime','$evtype',$sid)");
           } 
           else
           {
        
           	$addevent = mysqli_query($db, "INSERT INTO events (id,description,evdate,stime,evtype,sid)
              VALUES ($eid, '$desc','$date','$stime','$evtype',$sid)");
           	
           }
           
           
         
           
           
           
           }


?>




<head>
	
	<title>SPS: Calendar</title>
	<link href="menu2.css" rel="stylesheet" type="text/css" media="all"/>
<?php if ($pageStyle == "style1"){ ?>
    <link href='styleC3.css' rel='stylesheet' type='text/css' media='all'/>
<?php } ?>

<?php if ($pageStyle == "style2"){ ?>
    <link href="styleR2.css" rel="stylesheet" type="text/css" media="all"/>
<?php } ?>

<?php if ($pageStyle == "style3"){ ?>
    <link href="styleY2.css" rel="stylesheet" type="text/css" media="all"/>
<?php } ?>

<?php if ($pageStyle == "style4"){ ?>
    <link href="styleG2.css" rel="stylesheet" type="text/css" media="all"/>
<?php } ?>

<style type="text/css">

    label{ 
        float: left;
        margin: 0;
    }

</style>
	
<link href="calCss1.css" rel="stylesheet" type="text/css" media="all"/>	
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
<!--
	<button id = "add" onclick = "addEvent('Event', 'add')"> Add Event </button>
		<form id = "Event" method = "post" action = "userAccountCalendar.php" style = "display: none">
			<fieldset>
				<legend>Add an Event</legend>
				<p><label class="field" for="date">Date:</label><input type="date" name="date" class="textbox-size"/></p>
				<p></p>
				<p><label class="field" for="details">Details:</label><input type="text" name="details" class="textbox-size"/></p>
			</p>
		<p><left><input type="submit" name="addE" style="height:22px; width:153px" value="Add" ></center></p>
			</fieldset>
		</form>
-->
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

	<br/>
	<div id="head">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <img src="logo.png" alt="SPS" style="width: 68px; hight: 68px; vertical-align: middle;">
        <font face="Impact" size="5" style="width: 68px; hight: 68px; vertical-align: middle;">
            Student Planner SPS
        </font>
    </div>
    <br/>
    <br/>
    
	<div id=main>
		
	<center>
    <div class="container">
    <nav>
        <ul style="list-style-type: none; border-width: 0px;">
            <li><a href="userAccountHome.php">Home</a></li>
            <li><a href="userAccountCalendar.php">Calendar</a></li>
            <li><a href="userAccountCourses.php">Course</a></li>
            <li><a href="userAccountContacts.php">Contact</a></li>
            <li><a href="userAccountOptions.php">Options</a></li>
            <?php
            if ($_SESSION["admin"] == 1){
            echo "<li><a href='userAccountAdmin.php'>Admin</a></li>"; 
            } ?>
            <li><a href="userAccountLogout.php">Logout</a></li>
        </ul>
    </nav>
    </div>
    </center>
    
    <p><span class="error"> <?php echo $detErr;?></span></p>
     <p><span class="error"> <?php echo $dateErr;?></span></p>
     <p><span class="error"> <?php echo $stimeErr;?></span></p> 
     <p><span class="error"> <?php echo $typErr;?></span></p>
 <p><span class="error"> <?php echo $contime;?></span></p>
 

	<center><button id = "add" onclick = "addEvent('Event', 'add')"> Add Event </button>
			<form id = "Event" method = "post" action = "userAccountCalendar.php" style="display: none">
			<fieldset>
				<legend>Add an Event</legend>
				<p><label for="date">Date:</label><br/><input type="date" name="date" class="textbox-size"/></p>
				<p><label for="stime">Start Time of Event:</label><br/><input type="time" name="stime" class="textbox-size"/></p>
				<p><label for="etime">Estimated End Time (Optional):</label><br/><input type="time" name="etime" class="textbox-size"/></p>
				<p><label for="CDays">Type of Event:</label>
		                        <p align="left">
		                        <input type="radio" name="evtype" value="Meeting" />Meeting<br/>
								<input type="radio" name="evtype" value="Travel" />Travel<br/>
								<input type="radio" name="evtype" value="Birthday" />Birthday<br/>
								</p>
				<p><label for="others">Other Event type:</label><br/><input type="text" name="other" class="textbox-size"/></p>				
				<p></p>
				<p><label for="details">Details</label><br /><textarea rows="2" cols="25" name="details" style='float: left;'></textarea></p>
			</p>
			
			<p align="left"><input type="submit" name="addE" style="height:22px; width:153px" value="Add" ></p>
			</fieldset>
		</form>
	</center>
    <br />

<body onLoad="initialCalendar();" style="font-family:<?php echo $textF ?>">	
<div id="showCalendar"></div>
<div id="overlay">
<div id ="events" ></div>
</div>

 
<br/>
<br/>
</div>
<br/>


</body>
</html>