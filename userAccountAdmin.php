<?php

//---------------------------------------------
// CONNECT TO DB
//---------------------------------------

    $servername = getenv('IP');
    $username = getenv('C9_USER');
    $password = "";
    $database = "c9";
    $dbport = 3306;
    
   $db = new mysqli($servername, $username, $password, $database, $dbport);
   $cdb = mysqli_select_db($db,$database);
//---------------------------------------------------------------
session_start();
$fname = $form = $lname = $email = "";
$accupdated = $emailErr = "";
$sid=$noclass="";


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

if(isset($_POST["admin"]))
{
            $user = $_SESSION["username"];
            $pass = $_SESSION["password"];
            $add_email = $_POST["add_admin"]; 
            $edit_query = mysqli_query($db,"Select * from student where email = '$add_email' ");
            $fchange = false;
            $lchange = false;
            $echange = false;
            $val = true;
                                
            $ad_val = 1;

           if($val){
           if(mysqli_num_rows($edit_query) > 0)
           {
              while($row = mysqli_fetch_assoc($edit_query)){
                 $id = $row["ID"];
                 
                 
                 if(!empty($_POST["admin"])){
                     $adupdate = "update student set admin = '$ad_val' WHERE id  = $id";
                     $adchange = mysqli_query($db,$adupdate);
                     echo "<p align='center'> <font color=black  size='10pt'>Account flagged as admin.</font> </p>";
                     //print "Account flagged as admin.";
                 }
                 }
              }
           }
}

			//------------------------------------
			// Insert Event in the Database
			//-----------------------------------
           include ("connect.php");
           
           if(isset($_POST["addE"]))
           {
           	
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
           	// This part just gets the number of student ids
           	//----------------------------------------------------
           	$numid;	
           	 $getstudentid = mysqli_query($c9db,"Select * from student where
           	 id=( select max(id) from student) ");
                 
                            if(mysqli_num_rows($getstudentid) > 0){
                              while($row = mysqli_fetch_assoc($getstudentid)){
                                 $numid = $row["ID"];
                               // echo "<script type='text/javascript'>alert('$numid');</script>";
                              }
                            }	
           	//echo "<script type='text/javascript'>alert('$numid');</script>";
           		for ($x = 1; $x <= $numid; $x++) {
           	//	echo "<script type='text/javascript'>alert('$date');</script>";
           		
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
           	
           
           
           //------------------------------------
           // Insert into tablename (each column name in the database, excatly as there are)
           // then the values.
           //----------------------------------
           
           $addevent = mysqli_query($db, "INSERT INTO events (id,description,evdate,sid)
           VALUES ($eid, '$desc','$date',$x)");
           
           
           
           		}
           
           
           
           }
           
         
           
           		
           
         //  }
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



<body onLoad="initialCalendar();" style="font-family:<?php echo $textF ?>">



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
    

	<div align="center">
		<button id = "add" onclick = "addEvent('Event', 'add')"> Add Event </button>
		</div>
		<br><br>
		<div style='margin-left: 37%;'>
		<!--form id = "Event" method = "post" action = "userAccountCalendar.php" style = "display: none">-->
		<form id = "Event" method = "post" action = "userAccountAdmin.php" style = "display: none">
			<fieldset>
				<legend>Add an Event</legend>
				<p><label class="field" for="date">Date:</label><input type="date" name="date" class="textbox-size"/></p>
				<p></p>
				<p><label class="field" for="details">Details:</label><input type="text" name="details" class="textbox-size"/></p>
			</p>
		<p><left><input type="submit" name="addE" style="height:22px; width:153px" value="Add" ></center></p>
			</fieldset>
		</form>
		</div>


<div id="showCalendar"></div>
<div id="overlay">
<div id ="events" ></div>
</div>



<br>
<br>
<br>
       
 <div style='margin-left: 37%;'>
<form name="form1" method="post" action="userAccountAdmin.php">
	<fieldset>
		<legend>Admin Addition</legend>
		<p><label class="field" for="add_admin">Account Email</label><input type="text" name="add_admin" 
		                                                class="textbox-size"/></p>
			<p></p>
		<p><center><input type="submit" name="admin" style="height:22px; width:153px" value="Add Admin"></center></p>
	</fieldset>
</form>
</div>

<br/>
<br/>
</div>
<br/>

</body>
</html>
