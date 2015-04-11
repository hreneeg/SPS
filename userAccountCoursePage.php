<?php
include("reminder.php");

    $servername = getenv('IP');
    $username = getenv('C9_USER');
    $password = "";
    $database = "c9";
    $dbport = 3306;
    $db = new mysqli($servername, $username, $password, $database, $dbport);
   $cdb = mysqli_select_db($db,$database);
   session_start();
   $cname="";
   $pemail=$pfname=$plname=$fname=$lname=$email="";

   
    if(isset($_GET["key"])){
        
       $_SESSION["cid"] = $_GET["key"]; 
    }
   
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
    
  $getstudentid = mysqli_query($db,"Select * from student where username = '$user' and password = '$pass' ");
                    
                            if(mysqli_num_rows($getstudentid) > 0){
                              while($row = mysqli_fetch_assoc($getstudentid)){
                                 $sid = $row["ID"];
                                 $fname =$row["firstname"];
                                 $lname =$row["lastname"];
                                 $email = $row["email"];
                              }
                            }
           
     
     $cid = $_SESSION["cid"];
     
     $mycourse = mysqli_query($db,"SELECT * FROM course WHERE cid=$cid") or $test7 = "courses FAIL";
     
     if(mysqli_num_rows($mycourse) > 0){
            while($row = mysqli_fetch_assoc($mycourse)){
             $cname = $row["cname"]; 
            }
            
     }
     
     
      $myprof = mysqli_query($db,"SELECT * FROM course, professor WHERE professor.id = course.pid
      AND course.cid = $cid") or $test10 = "PROF FAIL";
    
            if(mysqli_num_rows($myprof) > 0){
                    while($row = mysqli_fetch_assoc($myprof)){
                         $pfname = $row["firstname"];
                          $plname = $row["lastname"];
                           $pemail = $row["email"];
                        
                    }
            }
     
     
     
     

 }
 
?>


<!DOCTYPE html>
<html>
<head>
    <title>SPS: Course Page</title>
    <link href="https://seproject-hrguyll.c9.io/menu2.css" rel="stylesheet" type="text/css" media="all"/>
<?php if ($pageStyle == "style1"){ ?>
    <link href='https://seproject-hrguyll.c9.io/styleC3.css' rel='stylesheet' type='text/css' media='all'/>
<?php } ?>

<?php if ($pageStyle == "style2"){ ?>
    <link href="https://seproject-hrguyll.c9.io/styleR2.css" rel="stylesheet" type="text/css" media="all"/>
<?php } ?>

<?php if ($pageStyle == "style3"){ ?>
    <link href="https://seproject-hrguyll.c9.io/styleY2.css" rel="stylesheet" type="text/css" media="all"/>
<?php } ?>

<?php if ($pageStyle == "style4"){ ?>
    <link href="https://seproject-hrguyll.c9.io/styleG2.css" rel="stylesheet" type="text/css" media="all"/>
<?php } ?>
</head>
    

<body style="font-family:<?php echo $textF ?>">
    <br/>
    <div id=head>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <img src="https://seproject-hrguyll.c9.io/logo.png" alt="SPS" style="width: 68px; hight: 68px; vertical-align: middle;">
        <font face="Impact" size="5" style="width: 68px; hight: 68px; vertical-align: middle;">
            Student Planner SPS
        </font>
    </div>
    <br/>
    <br/>
    
<div id="main">
    
   <center>
    <div class="container">
    <nav>
        <ul style="list-style-type: none; border-width: 0px;">
            <li><a href="https://seproject-hrguyll.c9.io/userAccountHome.php">Home</a></li>
            <li><a href="https://seproject-hrguyll.c9.io/userAccountCalendar.php">Calendar</a></li>
            <li><a href="https://seproject-hrguyll.c9.io/userAccountCourses.php">Course</a></li>
            <li><a href="https://seproject-hrguyll.c9.io/userAccountContacts.php">Contact</a></li>
            <li><a href="https://seproject-hrguyll.c9.io/userAccountOptions.php">Options</a></li>
            <?php
            if ($_SESSION["admin"] == 1){
            echo "<li><a href='https://seproject-hrguyll.c9.io/userAccountAdmin.php'>Admin</a></li>"; 
            } ?>
            <li><a href="https://seproject-hrguyll.c9.io/userAccountLogout.php">Logout</a></li>
        </ul>
    </nav>
    </div>
    </center> 
    
    
<center>

<font size=+5 color=black><?php echo $cname?></font><br/><br/><br/>

</center>

<?php
echo"
    <p><center>
        <form action='http://csce.uark.edu/~sem010/send_email.php' method='post'>
         <input type='submit' name='profem' value ='Email Professor'> 
         <input type='hidden' name='pemail' value=' $pemail'>
         <input type='hidden' name='uemail' value='$email'>
         <input type='hidden' name='pfname' value='$pfname'>
         <input type='hidden' name='plname' value='$plname'>
         <input type='hidden' name='ufname' value=' $fname'>
         <input type='hidden' name='ulname' value='$lname'>
        </form>
    </font></center></p>"

?>  


<center>
<form action ="https://seproject-hrguyll.c9.io/upload.php" method="post" enctype="multipart/form-data" border =1>
 <fieldset>
  <legend>Upload Notes</legend>    
  <p align="left"><input type="file" name=notes></p>
  <p align="left"><input type="submit" value ="Upload"></p>
 </fieldset>
</form>
</center>


<form action="https://seproject-hrguyll.c9.io/homework.php" method="post" align ='center'>
<p>Homwork reminders</p>
What date is your Homwork due? <input type="date" name="hwdate"><br>
What time is your Homework due? <input type="time" name="hwtime"><br>
<p>Please give a brief description of your assignment<br>
<textarea rows="4" cols="35" name="desc"></textarea></p>
<input type="submit" name="hw" value="Submit">
</form>



<br/>
<br/>
</div>
<br/>

</html>

<?php

include("filemanager.php");
include("hwmanager.php"); 
     
    
   
?>

