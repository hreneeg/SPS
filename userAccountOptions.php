<?php

    $servername = getenv('IP');
    $username = getenv('C9_USER');
    $password = "";
    $database = "c9";
    $dbport = 3306;
    
   $db = new mysqli($servername, $username, $password, $database, $dbport);
   $cdb = mysqli_select_db($db,$database);


session_start();

$pageFont = $_SESSION["pagefont"];
$pageStyle = $_SESSION["pagestyle"];
 $textF = "";
if($pageFont){
    if($pageFont=="font1"){$textF="Trebuchet MS";}
    if($pageFont=="font2"){$textF="Georgia";}
    if($pageFont=="font3"){$textF="Arial";}
    if($pageFont=="font4"){$textF="Courier";}
}else{
    $textF="Trebuchet MS";
}

$test1=$test2="";
if(isset($_POST["font"])){
    $user = $_SESSION["username"];
    $pass = $_SESSION["password"];
    $font = $_POST["pageFont"];
    $val = true;
    
    if(empty($_POST["pageFont"]))
    {
        $val = false;
    }
    
    if($val){
        
    $userid = mysqli_query($db,"SELECT * FROM student WHERE username='$user' and password='$pass'");
         
         if(mysqli_num_rows($userid) > 0)
        {
                while($row = mysqli_fetch_assoc($userid)){
                        $sid = $row["ID"];
                
        }

            
        }
    $useroption = mysqli_query($db,"SELECT * FROM options WHERE sid= $sid");
                        if(mysqli_num_rows($useroption) > 0){
                            
                     $fontupdate = mysqli_query($db,"update options set font ='$font' WHERE sid = $sid");
                     $_SESSION["pagefont"] = $font;
                    }else{
                        
                        $optionid = mysqli_query($db,"SELECT max(id) FROM options") or $test1 = "FAIL OPT ID";
                         if(mysqli_num_rows($optionid) > 0)
                                       {
                                          while($row = mysqli_fetch_assoc($optionid)){
                                              $oid =  $row["max(id)"];
                                          }
                                       }
                                       
                                       
                                       if($oid == NULL)
                                       {
                                           $oid = 1;
                                       }
                                       else
                                       {
                                           $oid++; 
                                       }
                        
                        
                        
                        $addfont = mysqli_query($db, "INSERT into options (id,font,style,sid) 
                        VALUES ($oid, '$font', '$pageStyle', $sid)") or $test2 = "INSERT FONT FAIL";
                        $_SESSION["pagefont"] = $font;
                    }
                    
      header("location:userAccountOptions.php");   
    }
}
 if(isset($_POST["style"])){
    $user = $_SESSION["username"];
    $pass = $_SESSION["password"];
    $style = $_POST["pageStyle"];
    $val = true;

    if(empty($_POST["pageStyle"]))
    {
        $val = false;
    }
    
    if($val){
        
    $userid = mysqli_query($db,"SELECT * FROM student WHERE username='$user' and password='$pass'");
         
         if(mysqli_num_rows($userid) > 0)
        {
                while($row = mysqli_fetch_assoc($userid)){
                        $sid = $row["ID"];
                
        }
    }
    $useroption = mysqli_query($db,"SELECT * FROM options WHERE sid= $sid");
                        if(mysqli_num_rows($useroption) > 0){
                            
                     $styleupdate = mysqli_query($db,"update options set style ='$style' WHERE sid = $sid");
                     $_SESSION["pagestyle"] = $style;
                    }else{
                        
                        $optionid = mysqli_query($db,"SELECT max(id) FROM options");
                         if(mysqli_num_rows($optionid) > 0)
                                       {
                                          while($row = mysqli_fetch_assoc($optionid)){
                                              $oid =  $row["max(id)"];
                                          }
                                       }
                                       
                                       
                                       if($oid == NULL)
                                       {
                                           $oid = 1;
                                       }
                                       else
                                       {
                                           $oid++; 
                                       }
                        
                        
                        
                        $addfont = mysqli_query($db, "INSERT into options (id,font,style,sid) 
                        VALUES ($oid, '$pageFont', '$style', $sid)");
                        $_SESSION["pagestyle"] = $style;
                    }
      header("location:userAccountOptions.php");              
    }
 
}


if(isset($_POST["updates"]))
{
            $user = $_SESSION["username"];
            $pass = $_SESSION["password"];
            $val = true;
             
            if(empty($_POST["wantUpdates"]))
            {
                $val = false;
            }
    
            if($val){
            $edit_query = mysqli_query($db,"SELECT * FROM student WHERE username='$user' and password='$pass'");
                                
           if(mysqli_num_rows($edit_query) > 0)
           {
              while($row = mysqli_fetch_assoc($edit_query)){
                 $id = $row["ID"];
                 
                 if(isset($_POST["wantUpdates"]) && $_POST["wantUpdates"] == 'true') $wupdates = 1;
                 else $wupdates = 0;
                 if(!empty($_POST["wantUpdates"])){
                     $up_update = "update student set updates = '$wupdates' WHERE id  = $id";
                     $upchange = mysqli_query($db,$up_update);
                 }
                 }
              }
            header("location:userAccountOptions.php");  
           }
}


//}
?>

<!DOCTYPE html>
<html>
<head>
<title>SPS: Options</title>
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
label, input{ 
    float:left; 
}
label {
    display: block;
    padding-left: 15px;
    text-indent: -15px;
}
input {
    width: 13px;
    height: 13px;
    padding: 0;
    margin:0;
    vertical-align: bottom;
    position: relative;
    top: -1px;
    overflow: hidden;
}
</style>
</head>

<body style="font-family:<?php echo $textF ?>">
    <br/>
    <div id=head>
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


<p> <?php echo $test1?></p>
<p> <?php echo $test2?></p>


<form name="form0" method="post" action="userAccountOptions.php" id ="tform2" style='margin-left: 37%;'>
	<fieldset>
	   <legend>Email Updates</legend>
	   <p>
	        <input type="radio" name="wantUpdates" value="true">Email me updates<br>
            <input type="radio" name="wantUpdates" value="false"> Don't email me updates<br>
	   </p>
	   <p>
	       <input type="submit" name="updates" style="height:22px; width:145px" value="Update Preference">
	   </p>
	</fieldset>
</form>
<br/>
<form name="form1" method="post" action="userAccountOptions.php" id ="tform" style='margin-left: 37%;'>
	<fieldset>
	   <legend>Themes</legend>
        <p>
	        <input type="radio" name="pageFont" value="font1"/>Trebuchet MS<br>
            <input type="radio" name="pageFont" value="font2"/>Georgia<br>
			<input type="radio" name="pageFont" value="font3"/>Arial<br>
			<input type="radio" name="pageFont" value="font4"/>Courier<br>
        </p>
		<p>
		    <input type="submit" name="font" style="height:22px; width:145px" value="Update Theme">
        </p>
	</fieldset>
</form>
<br/>
<form name="form2" method="post" action="userAccountOptions.php" id ="tform2" style='margin-left: 37%;'>
	<fieldset>
	   <legend>Skins</legend>
        <p>
            <input type="radio" name="pageStyle" value="style1"/>Classic<br>
        	<input type="radio" name="pageStyle" value="style2"/>Red<br>
            <input type="radio" name="pageStyle" value="style3"/>Yellow<br>
        	<input type="radio" name="pageStyle" value="style4"/>Green<br>
        </p>
		<p>
		    <input type="submit" name="style" style="height:22px; width:145px" value="Update Skin">
		</p>
	</fieldset>
</form>

<br/>
<br/>
</div>
<br/>

</body>
</html>
</html>