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
//--------------------------------------------------------------------------
 $cidErr =$cxErr= $cnameErr = $cdayErr= $ctimeErr = $cdesErr = $creditErr = $pfnameErr =$pvemailErr= $plnameErr = $pemailErr = "";
 $added=$nocourse=$ssid=$lcid=$selected="";

 
session_start();

if(isset($_SESSION["contime"]))
{
    $icontime = $_SESSION["contime"];
    unset($_SESSION["contime"]);
}
 $test1 =$test2=$test3=$test4= $test5 =$test6=$test7=$test9="";
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
    $nocourse = true;
    $hide = false;
      $student = mysqli_query($db,"Select * from student where username = '$user' and password = '$pass' ")
                                           or $test5 = "SID FAIL";
                    
                            if(mysqli_num_rows($student) > 0){
                              while($row = mysqli_fetch_assoc($student)){
                                  
                                 $ssid = $row["ID"];
                
                              }
                            }
                            
     $linksid = mysqli_query($db,"Select * from linkid where sid = $ssid")
                                           or $test6 = "LINKID FAIL";
     
                if(mysqli_num_rows($linksid) > 0){
                    $nocourse  = false;
                             
                            }
     

     
 }
 
if(isset($_POST["srch"])){
    
   $selected = $_POST["search"];
   $hide = true;
   $show = true;
    
}
 
 
    


if(isset($_POST["cd"])){
    
   $did = $_POST["del"];
	$linkdel = mysqli_query($db," DELETE FROM linkid WHERE cid = $did AND sid =$ssid");
	// Refresh Page.
	header("location:userAccountCourses.php");
    
    
}


if(isset($_POST["course"]))
 {
    $user = $_SESSION["username"];
    $pass = $_SESSION["password"];
    
    $cday = array();
    $cid = $_POST["cid"];
    $cname = $_POST["cname"];
    $stime = $_POST["stime"];
    $etime = $_POST["etime"];
    $scompare = DATE("g:i a", STRTOTIME($stime));
    $ecompare = DATE("g:i a", STRTOTIME($etime));
    $cdes = $_POST["cdes"];
    $credit = $_POST["credit"];
    
    $pfname = $_POST["pfname"];
    $plname = $_POST["plname"];
    $pemail = $_POST["pemail"];
    
    $mon = $_POST["Mo"];
    $tue = $_POST["Tu"];
    $wed = $_POST["We"];
    $thu = $_POST["Th"];
    $fri = $_POST["Fr"];
    $sat = $_POST["Sa"];
    
    if(!empty($_POST["Mo"]))
        array_push($cday,$mon);
    if(!empty($_POST["Tu"]))
        array_push($cday,$tue);
    if(!empty($_POST["We"]))
        array_push($cday,$wed);
    if(!empty($_POST["Th"]))
        array_push($cday,$thu);
    if(!empty($_POST["Fr"]))
        array_push($cday,$fri);
    if(!empty($_POST["Sa"]))
        array_push($cday,$sat);
        
    $days = implode("",$cday);
    $comdays =$days;
   if (strpos($comdays, 'Mo') !== FALSE)
        $comdays = "Mo";
   if (strpos($comdays, 'Tu') !== FALSE)
        $comdays = "Tu";
   if (strpos($comdays, 'We') !== FALSE)
        $comdays = "We";
   if (strpos($comdays, 'Th') !== FALSE)
        $comdays = "Th";
   if (strpos($comdays, 'Fr') !== FALSE)
         $comdays = "Fr";
    if (strpos($comdays, 'Sa') !== FALSE) 
        $comdays = "Sa"; 
    
    
    
    $val = true;
    
        	    if(empty($_POST["cid"])){
        	        $cidErr = "Please enter a Course ID <br>";
        	        $val = false;
        	
        		}
        		if(empty($_POST["cname"])){
        	        
        	         $cnameErr = "Please enter a Course Name <br>";
        	        $val = false;
        	
        		}
        		if(empty($_POST["stime"])){
        	        
        	         $ctimeErr = "Please enter a Course Start Time <br>";
        	        $val = false;
        	
        		}
        		if(empty($_POST["etime"])){
        	        
        	         $ctimeErr .= "Please enter a Course End Time <br>";
        	        $val = false;
        	
        		}
        		if(empty($_POST["cdes"])){
        	        
        	         $cdesErr = "Please enter a Course Description <br>";
        	        $val = false;
        	
        		}
        		if(empty($_POST["credit"])){
        	         $creditErr = "Please enter  Course Credits <br>";
        	        $val = false;
        	        
        	
        		}
        		if(empty($cday)){
        	        
        	         $cdayErr = "Please enter  Course Meeting Days <br>";
        	        $val = false;
        	
        		}
        		if(empty($_POST["pfname"])){
        	         $pfnameErr = "Please enter the Professor's First Name <br>";
        	        $val = false;
        	        
        	
        		}
        		if(empty($_POST["plname"])){
        	        
        	         $plnameErr = "Please enter the Professor's Last Name <br>";
        	        $val = false;
        	
        		}
        		if(empty($_POST["pemail"])){
        	        
        	         $pemailErr = "Please enter the Professor Email <br>";
        	        $val = false;
        	
        		}
        		if(!filter_var($_POST["pemail"], FILTER_VALIDATE_EMAIL)) {
                $pvemailErr = "Please enter a valid email. For your Professor <br>" ;   
               $val = false;
               
               }
        		$checkcid = mysqli_query($db,"Select * from course WHERE cid = $cid");
        		if(mysqli_num_rows($checkcid) > 0){
        		    
        		    $cxErr = "Course ID Already exist, The course was not Added.";
        		    $val = false;
        		    
        		    
        		}
        		
        		
            $conflict = mysqli_query($db,"SELECT * FROM course, linkid WHERE linkid.sid = $ssid 
            AND linkid.cid = course.cid");
               
                            if(mysqli_num_rows($conflict) > 0){
                              while($row = mysqli_fetch_assoc($conflict)){
                                   $sttime  = DATE("g:i a", STRTOTIME($row["stime"]));
                                   $entime  = DATE("g:i a", STRTOTIME($row["etime"]));
        
                                   if(strpos($row["cdays"], $comdays) !== FALSE && ($ecompare >= $sttime && $scompare < $entime))
                                 {
                                    
		                                   $contime.= "There is a time conflict between your course ". $row["cname"]. " on ".$row["cdays"].
		                                   " at ".$sttime. " to ".$entime. "<br>" . "<hr>";
		                                   $val = false;
		                                }
                                     
                                 }
                                   
                              }
                           
            
            
              
                
    if($val){
          
                    $getstudentid = mysqli_query($db,"Select * from student where username = '$user' and password = '$pass' ")
                                           or $test3 = "SID FAIL";
                    
                            if(mysqli_num_rows($getstudentid) > 0){
                              while($row = mysqli_fetch_assoc($getstudentid)){
                                 $sid = $row["ID"];
                
                              }
                            }
                  
                  
                        
                     $dontaddprof = false;  
                    $profexist = "select * FROM professor WHERE firstname = '$pfname'
                    AND lastname = '$plname'";
                    	if(mysqli_num_rows($profexist) > 0){
                    	    $dontaddprof = true;
                    	    while($row = mysqli_fetch_assoc($profexist))
                    	    {
                                        $pid = $row["ID"];     
                                             
                                             
                            }
                    	}
                    	
                    	
                    
                 if(!$dontaddprof){     
                      $q = mysqli_query($db,"SELECT max(id) FROM professor");
                                       
                                       if(mysqli_num_rows($q) > 0)
                                       {
                                          while($row = mysqli_fetch_assoc($q)){
                                              $pid =  $row["max(id)"];
                                          }
                                       }
                                       
                                       
                                       if($pid == NULL)
                                       {
                                           $pid = 1;
                                       }
                                       else
                                       {
                                           $pid++; 
                                       }
                                       
                     
                     
                                       
                    $addprof = "INSERT INTO professor (id,firstname,lastname,email) 
                                VALUES ($pid,'$pfname','$plname','$pemail')"; 
                    $profadd = mysqli_query($db,$addprof) or $test = "Add Professor Failed.";
                    
                

                                       
                 }
                
                
                
                
                
                    $addcourse = " INSERT INTO course (cid,cname,stime,etime,cdays,cdes,credit,PID)
                                VALUES ($cid, '$cname', '$stime','$etime','$days','$cdes', $credit,$pid)";
                                
                    $courseadded = mysqli_query($db,$addcourse) or $test1 = "Adding Course Falied";
                
                                
                                      $ql = mysqli_query($db,"SELECT max(id) FROM linkid") or $test4 = "lINK ID FAILED";
                                       
                                       if(mysqli_num_rows($ql) > 0)
                                       {
                                          while($row = mysqli_fetch_assoc($ql)){
                                              $lid =  $row["max(id)"];
                                          }
                                       }
                                       
                                       
                                       if($lid == NULL)
                                       {
                                           $lid = 1;
                                       }
                                       else
                                       {
                                           $lid++; 
                                       }
                    $linkids = " INSERT INTO linkid (id,sid,cid,pid) 
                                 VALUES ($lid,$sid,$cid,$pid)";
                    $idadded =   mysqli_query($db,$linkids) or $test2 = "Adding Link ID falied";             
    $added = "Course Added!.";
    header("location:userAccountCourses.php"); // Refreshes the page.
   }

    
     
 }

?>

</script>
<script type="text/javascript">
  function HideShow(id,id2){
  
		var p = document.getElementById(id);
	     if( p.style.display == 'none')
		 {
			document.getElementById(id).style.display = 'block';
			document.getElementById(id2).innerHTML = "hide form";
			
		}else{
		document.getElementById(id).style.display = 'none';
		document.getElementById(id2).innerHTML = "Add Course";
		}
  }

  function HideShow2(id,id2){
  
		var p = document.getElementById(id);
	     if( p.style.display == 'none')
		 {
			document.getElementById(id).style.display = 'block';
			document.getElementById(id2).innerHTML = "hide form";
			
		}else{
		document.getElementById(id).style.display = 'none';
		document.getElementById(id2).innerHTML = "Add Course by ID";
		}
  }
</script>



<!DOCTYPE html>
<html>
<head>
<title>SPS: Courses</title>
<link href="search.css" rel="stylesheet" type="text/css" media="all"/>
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

</head>

<body style="font-family:<?php echo $textF ?>">

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
 
 
 	<p><span class="error"> <?php echo $cidErr;?></span></p>
     <p><span class="error"> <?php echo $cnameErr;?></span></p>
     <p><span class="error"> <?php echo $ctimeErr;?></span></p> 
     <p><span class="error"> <?php echo $cdayErr;?></span></p>
     <p><span class="error"> <?php echo $creditErr;?></span></p> 	
      <p><span class="error"> <?php echo $pfnameErr;?></span></p>	
      <p><span class="error"> <?php echo $plnameErr;?></span></p>	
      <p><span class="error"> <?php echo $pemailErr;?></span></p>
      	<p><span class="error"> <?php echo $cdesErr;?></span></p>
        <p><span class="error"> <?php echo $cxErr;?></span></p>
        <p><span class="error"> <?php echo $pvemailErr;?></span></p>
        <p><span class="error"> <?php echo $contime;?></span></p>
        <p><span class="error"> <?php echo $icontime;?></span></p>
  
<center>
 
<p>Search for a course by entering the course id. Click <a href="https://seproject-hrguyll.c9.io/courselist.php" target="_blank">here</a> to 
 view our listed courses.</p>    
 <form name="form2" method="post" action="userAccountCourses.php">
      <div class="container">
     <p class="s"><input name="search" id="search" type="search"></p>
     <input type="submit" name="srch" value="Search">
   </div>
   </form>
       <?php 
       if($show){
  include("search.php");
       }  
       
    ?>
    
    
    
<?php if(!$hide){?>    
 
</form>

 <button id ="s1" onclick ="HideShow('cform','s1')" >Add Course</button>
<form name="form1" method="post" action="userAccountCourses.php" id="cform" style="display: none ">
	<fieldset>
		<legend>Add Course</legend>
		<p><label for="cid">CourseID:</label><br /><input type="text" name="cid" class="textbox-size"/></p>
		<p><label for="cname">Course Name:</label><br /><input type="text" name="cname" class="textbox-size"/></p>
		<p><label for="stime">Course Start Time:</label><br /><input type="time" name="stime" class="textbox-size"/></p>
		<p><label for="etime">Course End Time:</label><br /><input type="time" name="etime" class="textbox-size"/></p>
		<p><label for="CDays">Course Days:</label>
		                        <p align="left">
		                        <input type="checkbox" name="Mo" value="Mo" />Mon<br/>
								<input type="checkbox" name="Tu" value="Tu" />Tue<br/>
								<input type="checkbox" name="We" value="We" />Wed<br/>
								<input type="checkbox" name="Th" value="Th" />Thu<br/>
								<input type="checkbox" name="Fr" value="Fr" />Fri<br/>
								<input type="checkbox" name="Sa" value="Sa" />Sat<br/>
								</p>
		</p>
		<p><label for="credit">Course Credits:</label><br /><input type="text" name="credit" class="textbox-size"/></p>
		<p><label for="pfname">Professor First Name:</label><br /><input type="text" name="pfname" class="textbox-size"/></p>
		<p><label for="plname">Professor Last Name:</label><br /><input type="text" name="plname" class="textbox-size"/></p>
		<p><label for="pemail">Professor Email:</label><br /><input type="text" name="pemail" class="textbox-size"/></p>
		<p><label for="cdes">Course Description:</label><br /><textarea rows="4" cols="35" name="cdes" style='float: left;'></textarea></p>
		<p align="left"><input type="submit" name="course" style="height:22px; width:153px" value="Add Course"></p>
	</fieldset>
	
</form>
</center>
        
      <?php // THIS  PHP CODE BELOW IS APART OF THIS FORM, SO THE FORM MUST BE ABOVE
     // AND THE </FORM> LINE MUST BE AT THE END OF THE PHP CODE. -SYNDALL
      ?>
      
  <p><center><form action="userAccountCourses.php" method = "post">
      <!--I moved the submitt button to below the table, but inside the form-->

<?php } ?>        
 <?php
      
       if((!$nocourse) && (!$hide)){
     
     echo "<h1> My Courses </h1>";
     
      $allcourse = mysqli_query($db,"SELECT * FROM course, linkid, professor WHERE linkid.sid = $ssid 
       AND course.cid = linkid.cid AND course.pid = professor.id") or $test7 = "courses FAIL";
       
                    
        
                   
     $link ="https://seproject-hrguyll.c9.io/userAccountCoursePage.php";               
     echo "<table border =1 align ='center'> ";
               echo "<tr>";
               echo "<th> SELECT</th>";
               echo "<th> Course ID</th>";
               echo "<th> Course Name</th>";
               echo "<th> Course Time</th>";
               echo "<th> Course Days</th>";
               echo "<th> Course Credits</th>";
               echo "<th> Course Description</th>";
               echo "<th> Professor First Name</th>";
               echo "<th> Professor Last Name</th>";
               echo "<th> Professor Email</th>";
               echo " </tr>";
                if(mysqli_num_rows($allcourse) > 0){
                  
                  
                  
                              while($row = mysqli_fetch_assoc($allcourse)){
                                  $mypid = $row["pid"];
                                  $mycid = $row["CID"];
               $stime  = DATE("g:i a", STRTOTIME($row["stime"]));
               $etime  = DATE("g:i a", STRTOTIME($row["etime"]));
                $input = " <input type='radio' name='del' value='$mycid'>";
                
               echo "<tr>";
               echo "<td>". $input . "</td>";
               echo  "<td>". $mycid. "</td>";
               echo "<td>" ."<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>" . "</td>";
               echo "<td>". $stime."-".$etime. "</td>";
               echo "<td>". $row["cdays"] . "</td>";
               echo "<td>". $row["credit"] . "</td>";
               echo "<td>". $row["cdes"] . "</td>";
               echo "<td>". $row["firstname"] . "</td>";
               echo "<td>". $row["lastname"] . "</td>";
               echo "<td>". $row["email"] . "</td>";
               echo "</tr>";
    
                              }
                              
                  
                            }
                          
      
                          
     echo "</table>";

    
                        }
      
      ?>
      <br/>
      <input type="submit" name="cd" value="Delete Selected Course" style='float: none;'>
 </form> 
 
 
<br/>
<br/>
</div>
<br/>
    
</body>
</html>
</html>