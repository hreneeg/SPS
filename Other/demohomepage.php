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



if(isset($_POST["edit"]))
{
            $user = $_SESSION["username"];
            $pass = $_SESSION["password"];
            $edit_fname = $_POST["edit_fname"];
            $edit_lname = $_POST["edit_lname"];
            $edit_email = $_POST["edit_email"];

            $edit_query = mysqli_query($db,"Select * from student where username = '$user' and 
            password = '$pass' ");
            $fchange = false;
            $lchange = false;
            $echange = false;
            $val = true;
            
            if(!filter_var($_POST["edit_email"], FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email. Update was not made.(Eg.joe@example.com) <br> ";
                  $val = false;
               }
            
                
           if($val){
           if(mysqli_num_rows($edit_query) > 0)
           {
              while($row = mysqli_fetch_assoc($edit_query)){
                 $id = $row["ID"];
                 
                 
                 if(!empty($_POST["edit_fname"])){
                 if($edit_fname != $row["firstname"])
                 {
                     $fnameupdate = "update student set firstname ='$edit_fname' WHERE id = $id";
                     $fchange = mysqli_query($db,$fnameupdate);
                     
                 }
                 }
                 
                 if(!empty($_POST["edit_lname"])){
                 if($edit_lname != $row["lastname"]){
                    $lnameupdate = "update student set lastname = '$edit_lname' WHERE id = $id";
                     $lchange= mysqli_query($db,$lnameupdate);
                 }
                 }
                 
                 
                 if(!empty($_POST["edit_email"])){
                 if($edit_email != $row["email"]){     
                     $emailupdate ="update student set email ='$edit_email' WHERE id = $id";
                     $echange= mysqli_query($db,$emailupdate);
                 }
                 }
              }
           }
           else echo "no rows";
           }
    
                    if(($fchange) || ($lchange) || ($echange)){
                         $accupdated = "Your Personal Information has been updated.";
    
                     }
}







if(isset($_SESSION["username"]) && isset($_SESSION["password"]))
{
    $form = true;
    $user = $_SESSION["username"];
    $pass = $_SESSION["password"];
    $noclass = true;
     // Query to Database
       $query = mysqli_query($db,"Select * from student where username = '$user' and 
       password = '$pass' ");
       
   // if any rows are selected. Just copy this code.
   if(mysqli_num_rows($query) > 0)
   {
      while($row = mysqli_fetch_assoc($query)){
          // Select the information by row name.
          $sid = $row["ID"];
          $fname =  $row["firstname"];
          $lname = $row["lastname"];
          $email = $row["email"];
      }
   }else echo "no rows";
    
    
    $linksid = mysqli_query($db,"Select * from linkid where sid = $sid")
                                           or $test6 = "LINKID FAIL";
     
                if(mysqli_num_rows($linksid) > 0){
                    $noclass  = false;
                             
                            }
    
    
    
    
}


?>

<!DOCTYPE html>
<html>
<head>
<title>SPS: Home</title>
<?php
if ($pageStyle == "style1")
{
?>
<style>
    body {
        font-size: 16px;
        background-color: #DADAFF; 
		margin: 0px;
        color: black;
        padding: 3px;
    }
	#main {
		background-color: white;
		margin-left:2.5%;
		margin-right:2.5%;
	}
    table {
        padding: 5px;
        padding-left:  15px;
        padding-right: 15px;
        background-color:	#DADAFF ;
        border-radius: 0 0 5px 5px;
        color: black;
    }
    form{
    
        border-bottom: 0px solid #cc9900;
        font-size: 12px;
    }
    h1{
        font: arial;
        font-size: 180%;
        text-align: center;
    }

fieldset{
	width: 37%;
}

legend{
	font-size: 30px;
}

.field{
	text-align: right;
	width: 100px;
	float: left;
	font-weight: bold;
}

.textbox-size{
	width: 200px;
	float: left;
}

fieldset p{
	clear: both;
	padding: 3px;
}
    
</style>
<?php 
}
?>

<?php
if ($pageStyle == "style2")
{
?>
<style>
    body {
        font-size: 16px;
        background-color: #FF6633; 
		margin: 0px;
        color: black;
        padding: 3px;
    }
	#main {
		background-color: #CC3300;
		margin-left:2.5%;
		margin-right:2.5%;
	}
    table {
        padding: 5px;
        padding-left:  15px;
        padding-right: 15px;
        background-color:	#FF6633;
        border-radius: 0 0 5px 5px;
        color: black;
    }
    form{
    
        border-bottom: 0px solid #cc9900;
        font-size: 12px;
    }
    h1{
        font: arial;
        font-size: 180%;
        text-align: center;
    }

fieldset{
	width: 37%;
}

legend{
	font-size: 30px;
}

.field{
	text-align: right;
	width: 100px;
	float: left;
	font-weight: bold;
}

.textbox-size{
	width: 200px;
	float: left;
}

fieldset p{
	clear: both;
	padding: 3px;
}
    
</style>
<?php 
}
?>

<?php
if ($pageStyle == "style3")
{
?>
<style>
    body {
        font-size: 16px;
        background-color: #FFCC66; 
		margin: 0px;
        color: black;
        padding: 3px;
    }
	#main {
		background-color: #FFCC00;
		margin-left:2.5%;
		margin-right:2.5%;
	}
    table {
        padding: 5px;
        padding-left:  15px;
        padding-right: 15px;
        background-color:	#FFCC66 ;
        border-radius: 0 0 5px 5px;
        color: black;
    }
    form{
    
        border-bottom: 0px solid #cc9900;
        font-size: 12px;
    }
    h1{
        font: arial;
        font-size: 180%;
        text-align: center;
    }

fieldset{
	width: 37%;
}

legend{
	font-size: 30px;
}

.field{
	text-align: right;
	width: 100px;
	float: left;
	font-weight: bold;
}

.textbox-size{
	width: 200px;
	float: left;
}

fieldset p{
	clear: both;
	padding: 3px;
}
    
</style>
<?php 
}
?>

<?php
if ($pageStyle == "style4")
{
?>
<style>
    body {
        font-size: 16px;
        background-color: #66CC66; 
		margin: 0px;
        color: black;
        padding: 3px;
    }
	#main {
		background-color: #66CC00;
		margin-left:2.5%;
		margin-right:2.5%;
	}
    table {
        padding: 5px;
        padding-left:  15px;
        padding-right: 15px;
        background-color:	#66CC66;
        border-radius: 0 0 5px 5px;
        color: black;
    }
    form{
    
        border-bottom: 0px solid #cc9900;
        font-size: 12px;
    }
    h1{
        font: arial;
        font-size: 180%;
        text-align: center;
    }

fieldset{
	width: 37%;
}

legend{
	font-size: 30px;
}

.field{
	text-align: right;
	width: 100px;
	float: left;
	font-weight: bold;
}

.textbox-size{
	width: 200px;
	float: left;
}

fieldset p{
	clear: both;
	padding: 3px;
}
 
 
</style>
<?php 
}
?>
<style>

/* CSSTerm.com Simple CSS menu */

.menu_simple ul {
    margin: 0; 
    padding: 0px;
    width:185px;
    list-style-type: none;
}

.menu_simple ul li a{
    text-decoration: none;
    color: white; 
    padding: 10.5px 11px;
    background-color: #005555;
    display:block;
    padding-right: 10px;
}
 
.menu_simple ul li a:visited {
    color: white;
}
 
.menu_simple ul li a:hover, .menu_simple ul li .current {
    color: white;
    background-color: #5FD367;
}
div.menu_simple h3{
    text-decoration: none;
    color: white; 
    padding: 10.5px 11px;
    background-color: #005555;
    display:block;
    
}
</style>

<style>
@import url("http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,300,700,400,600");

* {
	margin: 0;
	padding: 0;
	box-sizing: border-box;
}

body {
	font-family: 'Open Sans';
}

a {
	text-decoration: none;
}

div#header {
	width: 100%;
	height: 50px;
	background-color: #2c3e50;
	margin: 0 auto;
}

.logo {
	float: left;
	margin-top: 10px;
	margin-left: 10px;
}

.logo a {
	font-size: 1.3em;
	color: #fff;
}

.logo a span {
	font-weight: 300;
}

div#container {
	width: 100%;
	margin: 0 auto;
}

.sidebar {
	width: 250px;
	/*height: 100%;*/
	background-color: #171717;
	float: left;
}

ul#nav {

}

ul#nav li {
	list-style: none;
}

ul#nav li a {
	color: #ccc;
	display: block;
	padding: 10px;
	font-size: 0.8em;
	border-bottom: 1px solid #0A0A0A;
	-webkit-transition: 0.2s;
	-moz-transition: 0.2s;
	-o-transition: 0.2s;
	transition: 0.2s;
}

ul#nav li a:hover {
	background-color: #030303;
	color: #fff;
}

ul#nav li a.selected {
	background-color: #030303;
	color: #fff;
}


.content {
	width: auto;
	margin-left: 250px;
	height: 100%;
	background-color: #95a5a6;
	padding: 15px;
}

.content p {
	color: #424242;
	font-size: 0.73em;
}

div#box {
	margin-top: 15px;
}

div#box .box-top {
	color: #fff;
	text-shadow: 0px 1px #000;
	background-color: #2980b9;
	padding: 5px;
	padding-left: 15px;
	font-weight: 300;
}

div#box .box-panel {
	padding: 15px;
	background-color: #fff;
	color: #333;
}

a.mobile {
	display: block;
	color: #fff;
	background-color: #000;
	text-align: center;
	padding: 7px;
}

a.mobile:active {
	background-color: #4a4a4a;
}

@media only screen and (max-width: 320px) {
	.sidebar {
		width: 100%;
		display: none;
	}

	.content {
		margin-left: 0px;
	}
}

@media only screen and (min-width: 320px) {

	a.mobile {
		display: none;
	}

	.sidebar {
		height: 100%;
		display: block;
	}
}

</style>



</head>

<body style="font-family:<?php echo $textF ?>"><br>
<div id=main>
    <p><center><font size=2><a href="userAccountHome.php">Home</a> &nbsp;&nbsp;&nbsp; 
                            <a href="userAccountCalendar.php">Calendar</a> &nbsp;&nbsp;&nbsp; 
                            <a href="userAccountCourses.php">Courses</a> &nbsp;&nbsp;&nbsp;  
                            <a href="userAccountContacts.php">Contacts</a> &nbsp;&nbsp;&nbsp; 
                            <a href="userAccountOptions.php">Options</a> &nbsp;&nbsp;&nbsp;
                            <a href="userAccountLogout.php">Logout</a>
    </font></center></p>

        <table width="300" border="0" align="center" cellpadding="0" cellspacing="1">
        <tr>
        <td colspan="3"><strong><center>Home</center></strong></td>
        </tr>
</table>

      <div class="sidebar">
			<ul id="nav">
				
	<?php
      $link ="https://seproject-hrguyll.c9.io/userAccountCoursePage.php";
      
       $mycourse = mysqli_query($db,"SELECT * FROM course, linkid, professor WHERE linkid.sid = $sid 
       AND course.cid = linkid.cid AND course.pid = professor.id") or $test7 = "courses FAIL";

       if(mysqli_num_rows($mycourse) > 0){
           echo"<h3> Course Page </h3>";
            while($row = mysqli_fetch_assoc($mycourse)){
                
       
  echo "<li>". "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>" . "</li>";
          
                              }
       }
  
      ?>	
				
				
				
			</ul>
		</div>




<div class="content">
			<h1>Student Dashboard</h1>
			

<div id="box">
				
	<form name="form1" method="post" action="userAccountHome.php">
	<fieldset>
		<legend><?php echo $fname?>'s Account Information</legend>
		<p><label class="field" for="edit_fname">First Name:</label><input type="text" name="edit_fname" 
		                                                value="<?php echo $fname?>" class="textbox-size"/></p>
			<p></p>
		<p><label class="field" for="edit_lname">Last Name:</label><input type="text" name="edit_lname" 
		                                                value="<?php echo $lname?>" class="textbox-size"/></p>
			<p></p>
		<p><label class="field" for="edit_email">Email:</label><input type="text" name="edit_email" 
		                                                value="<?php echo $email?>" class="textbox-size"/></p>
			<p><?php echo $emailErr?></p>

		<p><center><input type="submit" name="edit" style="height:22px; width:153px" value="Edit Account"></center></p>
	</fieldset>
</form>
				
				
				
				
				
</div>
</div>







</body>
</html>
</html>