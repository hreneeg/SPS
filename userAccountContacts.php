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
   $firstNameERR =$lastnameERR=$lastnameERR=$emailERR=$noContactTypeERR="";
    $added=$ssid=$nocontacts="";
    session_start();
    
    $messageErr=$subjectErr=$emailErr=$invalidem=$msgsent="";
    
  $teste="";
  
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

  
    if(isset($_SESSION["subjectERR"])){
        $subjectErr = $_SESSION["subjectERR"];
        unset($_SESSION["subjectERR"]);
    }
    
    if(isset($_SESSION["messageERR"])){
        $messageErr = $_SESSION["messageERR"];
        unset($_SESSION["messageERR"]);
    }
    
    if(isset($_SESSION["emailERR"])){
        $emailErr = $_SESSION["emailERR"];
        unset($_SESSION["emailERR"]);
    }
    
    if(isset($_SESSION["invalidemail"])){
        $invalidem = $_SESSION["invalidemail"];
        unset($_SESSION["invalidemail"]);
    }
    
    if(isset($_SESSION["sent"])){
        $msgsent = $_SESSION["sent"];
        unset($_SESSION["sent"]);
    }

    
    
    
    
   
    if(isset($_SESSION["username"]) && isset($_SESSION["password"])){
         $user = $_SESSION["username"];
         $pass = $_SESSION["password"];
         $nocontacts = true;
       
        
        
        
             $student = mysqli_query($db,"Select * from student where username = '$user' and password = '$pass' ")
                                           or $test5 = "SID FAIL";
                    
                            if(mysqli_num_rows($student) > 0){
                              while($row = mysqli_fetch_assoc($student)){
                                  
                                 $ssid = $row["ID"];
                
                              }
                            }
                            
            $contactcheck = mysqli_query($db,"Select * from contact, linkcontact where 
             linkcontact.sid = $ssid") or $test6 = "CONTACT FAIL";
     
                if(mysqli_num_rows($contactcheck) > 0){
                    $nocontacts  = false;
                              
                            }                
                            
           
           $linkidcheck = mysqli_query($db,"Select * from linkid where sid = $ssid")
                                           or $test6 = "LINKID FAIL";
     
                if(mysqli_num_rows($linkidcheck) > 0){
                    $nocontacts = false;
                            
                            }
           
           
                            
                            
                            
    }     
         
    
    
    
     if(isset($_POST["contact"])) {
         
         
         
            $firstName =  $_POST["firstName"];
            $lastName =  $_POST["lastName"];
            $email =  $_POST["email"];
            $contactType = $_POST["contactType"];
        
          $val = true;
         if(empty($firstName)){
            $firstNameERR = "Please enter a First Name<br>";
            $val = false;
        }
        if(empty($_POST["lastName"])){
            $lastNameERR = "Please enter a Last Name <br>";
            $val = false;
         
         }
        if(empty($_POST["email"])){
            $emailERR = "Please enter a way to contact";
            $val = false;
        }
        if(empty($_POST["contactType"])){
            $noContactTypeERR = "Please select a contact Type";
            $val = false;
        }
            
            
               if($val){
        
                     $c = mysqli_query($db,"SELECT max(id) FROM contact");
                                       
                                       if(mysqli_num_rows($c) > 0)
                                       {
                                          while($row = mysqli_fetch_assoc($c)){
                                              $conid =  $row["max(id)"];
                                          }
                                       }
                                       
                                       
                                       if($conid == NULL)
                                       {
                                           $conid = 1;
                                       }
                                       else
                                       {
                                           $conid++; 
                                       }
        
        $lc = mysqli_query($db,"SELECT max(id) FROM linkcontact") or $test4 = "lINK ID FAILED";
                                       
                                       if(mysqli_num_rows($lc) > 0)
                                       {
                                          while($row = mysqli_fetch_assoc($lc)){
                                              $lconid =  $row["max(id)"];
                                          }
                                       }
                                       
                                       
                                       if($lconid == NULL)
                                       {
                                           $lconid = 1;
                                       }
                                       else
                                       {
                                           $lconid++; 
                                       }
        
        

                    $conadd = mysqli_query($db,"INSERT INTO contact(id,firstname,lastname,email,type) 
                                VALUES ($conid,'$firstName','$lastName','$email','$contactType')") or $testc = "Add Contact Failed.";
        
                    $linkconid =   mysqli_query($db," INSERT INTO linkcontact (id,cid,sid) 
                                 VALUES ($lconid,$conid,$ssid)") or $testi = "Adding Link ID falied";
        
        
           header("location:userAccountContacts.php"); // Refreshes Page.
            
              }
        
            
            
        
            
        }
        
    
     
        
        
        
        
        
        
    
?>   
 <script>
 function HideShow(id,id2){
  
		var p = document.getElementById(id);
	     if( p.style.display == 'none')
		 {
			document.getElementById(id).style.display = 'block';
			document.getElementById(id2).innerHTML = "hide form";
			
		}else{
		document.getElementById(id).style.display = 'none';
		document.getElementById(id2).innerHTML = "Add a Contact";
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
		document.getElementById(id2).innerHTML = "E-mail Student";
		}
  }
</script>


<!DOCTYPE html>
<html>
<head>
<title>SPS: Contacts</title>
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


  
<center>
<button id = "s1" onclick="HideShow('contactForm','s1')" > Add a Contact </button>

<p><span class="error"> <?php echo $firstNameERR;?></span></p>
<p><span class="error"> <?php echo $lastNameERR;?></span></p>
<p><span class="error"> <?php echo $emailERR;?></span></p>
<p><span class="error"> <?php echo $noContactTypeERR;?></span></p>

<div id = "addContact">
<form name="addContact" method="post" id = "contactForm" action="userAccountContacts.php" style = "display: none">
	<fieldset>
		<legend>Add A Contact</legend>
		<p><label for="firstName">First Name:</label><br /><input type="text" name="firstName" class="textbox-size"/></p>
		<p><label for="lastName">Last Name:</label><br /><input type="text" name="lastName" class="textbox-size"/></p>
		<p><label for="email">Email:</label><br /><input type="text" name="email" class="textbox-size"/></p>
		<p><label for="email">Contact Type:</label>
		    <p align="left">
			<input type="radio" name="contactType" value="Instructor"/>Instructor<br/>
			<input type="radio" name="contactType" value="Student"/>Student<br/>
			<input type="radio" name="contactType" value="Other"/>Other<br/>
		    </p>
        </p>  
		<p align="left"><input type="submit" name="contact" style="height:22px; width:153px" value="Add to Contacts"></p>
	</fieldset>
</form>
</div>
</center>

 <?php
 

 
      
       if(!$nocontacts){
      echo "<h1> My Contacts </h1>";
     
     
      $allcon = mysqli_query($db,"SELECT * FROM contact, linkcontact WHERE linkcontact.sid = $ssid
        AND contact.id = linkcontact.cid ") or $test7 = "courses FAIL";
                    
                    
                    
     echo "<table border =1 align ='center'> ";
              echo "<tr>";
              echo "<th>SELECT</th>";
              echo "<th>Contact First Name</th>";
              echo "<th>Contact Last Name</th>";
              echo "<th>Contact Email</th>";
              echo "<th>Contact Type</th>";
               echo " </tr>";
                if(mysqli_num_rows($allcon) > 0){
                              while($row = mysqli_fetch_assoc($allcon)){
                             $cfname =$row["firstname"];
                             $clname =$row["lastname"];
                             $cemail = $row["email"];
                             $ctype =$row["type"];
                            
                                  
                $input = " <input type='radio' name='con'>"
                ."<input type='hidden' name='cfname' value='$cfname'".
                "<input type='hidden' name='clname' value='$clname'".
                "<input type='hidden' name='cemail' value='$cemail'".
                "<input type='hidden' name='ctype' value='$ctype'";
               echo "<tr>";
               echo "<td>". $input . "</td>";
               echo "<td>". $row["firstname"] . "</td>";
               echo "<td>". $row["lastname"] . "</td>";
               echo "<td>". $row["email"] . "</td>";
                echo "<td>". $row["type"] . "</td>";
                echo "</tr>";
                              }
                              
                              
                            }
                          
        $myprof = mysqli_query($db,"SELECT * FROM professor, linkid WHERE linkid.sid = $ssid
    AND linkid.pid = professor.id") or $test10 = "PROF FAIL";
    
            if(mysqli_num_rows($myprof) > 0){
                    while($row = mysqli_fetch_assoc($myprof)){
                             $cfname =$row["firstname"];
                             $clname =$row["lastname"];
                             $cemail = $row["email"];
                             $ctype = "Professor";
                             
                 $input = " <input type='radio' name='con'>"
                ."<input type='hidden' name='cfname' value='$cfname'".
                "<input type='hidden' name='clname' value='$clname'".
                "<input type='hidden' name='cemail' value='$cemail'".
                "<input type='hidden' name='ctype' value='$ctype'";       
                        
                        
                echo "<tr>";
                echo "<td>". $input . "</td>";
               echo "<td>". $row["firstname"] . "</td>";
               echo "<td>". $row["lastname"] . "</td>";
               echo "<td>". $row["email"] . "</td>";
               echo "<td>". "Instructor" . "</td>";
                echo "</tr>";

                            

    
                              }
                              
                              
                            } 
                           
                            
     echo "</table>";


    
                        }
      
  

      ?>
<?php
echo"
        <p><center><form action='http://csce.uark.edu/~sem010/send_email.php' method='post'>
         <input type='submit' name='emcon' value ='Email Selected Contact'>
        </form></center></p>
    </font>"

?>

<br/>
<br/>
</div>
<br/>

</body>
</html>
</html>