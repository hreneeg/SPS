<?php


session_start();
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



?>




<!DOCTYPE html>
<html>
<head>
<title>SPS: Calendar</title>
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
	width: 97%;
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
	width: 97%;
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
	width: 97%;
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
	width: 97%;
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
        <td colspan="3"><strong><center>Calendar</center></strong></td>
        </tr>
        </table>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
</body>
</html>
</html>