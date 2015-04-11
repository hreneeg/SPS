<?php
include("reminder.php");
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
if($pageStyle){}else{$pageStyle="style1";}



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

</script>
<script type="text/javascript">
  function HideShow(id,id2){
  
		var p = document.getElementById(id);
	     if( p.style.display == 'none')
		 {
			document.getElementById(id).style.display = 'block';
			document.getElementById(id2).innerHTML = "Hide Edit form";
			
		}else{
		document.getElementById(id).style.display = 'none';
		document.getElementById(id2).innerHTML = "Edit Account";
		}
  
  
  }

</script>







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
                            $edit_query = mysqli_query($db,"Select * from student where username = '$user' and password = '$pass' ");
                            if(mysqli_num_rows($edit_query) > 0)
                             {
                                while($row = mysqli_fetch_assoc($edit_query)){
                                    $admin = $row["admin"];
                                    $_SESSION["admin"] = $admin;
                                    if ($admin == 1 || $_SESSION["admin"] == 1){
                                        
                            

            echo "<li><a href='userAccountAdmin.php'>Admin</a></li>"; 
            } } } ?>
            <li><a href="userAccountLogout.php">Logout</a></li>
        </ul>
    </nav>
    </div>
    </center>

        
<center>
 <p><button id ="s1" onclick ="HideShow('cform','s1')" >Edit Account</button></p>
<form name="form1" method="post" action="userAccountHome.php" id ="cform" style = "display: none">
	<fieldset>
		<legend><?php echo $fname?>'s Account Information</legend>
		    <p><label for="edit_fname">First Name:</label>
		    <br /><input type="text" name="edit_fname" value="<?php echo $fname?>" class="textbox-size"/></p>

		    <br />
		    <p><label for="edit_lname">Last Name:</label>
		    <br /><input type="text" name="edit_lname" value="<?php echo $lname?>" class="textbox-size"/></p>

		    <br />
		    <p><label for="edit_email">Email:</label>
		    <br /><input type="text" name="edit_email" value="<?php echo $email?>" class="textbox-size"/></p>
			<p><?php echo $emailErr?></p>

		<p><center><input type="submit" name="edit" style="height:22px; width:153px" value="Edit Account"></center></p>
	</fieldset>
</form>
</center>
<br>
        
        
<?php
include("timeline.php");
?>
    
<?php
 if(!$showtimeline)
 {
     echo "<h3 align ='center'><b>You currently have no courses added.</b></h3>";
 }else echo "<h3 align ='center'><b>Course Schedule</b></h3>"
?>   

    <table width="80%" align="center"  >
    <div id="head_nav">
    <tr>
        <th>Time</th>
        <th>Monday</th>
        <th>Tuesday</th>
        <th>Wednesday</th>
        <th>Thrusday</th>
        <th>Friday</th>
        <th>Saturday</th>
    </tr>
</div>  

    <tr>
        <th>8:00 - 9:00</th>
        <?php
        if($mon89 != NULL)
        {
        echo "<td>". $mon89 . "</td>";
        }else echo "<td> </td>";
        if($tue89 != NULL)
        {
        echo "<td>". $tue89 . "</td>";
        }else echo "<td> </td>";
        if($wed89 != NULL)
        {
        echo "<td>". $wed89 . "</td>";
        }else echo "<td> </td>";
        if($th89 != NULL)
        {
        echo "<td>". $th89 . "</td>";
        }else echo "<td> </td>";
        if($fri89 != NULL)
        {
        echo "<td>". $fri89 . "</td>";
        }else echo "<td> </td>";
        if($sa89 != NULL)
        {
        echo "<td>". $sa89 . "</td>";
        }else echo "<td> </td>";
        ?>
        </div>
    </tr>
    
    
    
    <tr>
        <th>9:00 - 10:00</th>
            <?php
        if($mon910 != NULL)
        {
        echo "<td>". $mon910 . "</td>";
        }else echo "<td> </td>";
        if($tue910 != NULL)
        {
        echo "<td>". $tue910 . "</td>";
        }else echo "<td> </td>";
        if($wed910 != NULL)
        {
        echo "<td>". $wed910 . "</td>";
        }else echo "<td> </td>";
        if($th910 != NULL)
        {
        echo "<td>". $th910 . "</td>";
        }else echo "<td> </td>";
        if($fri910 != NULL)
        {
        echo "<td>". $fri910 . "</td>";
        }else echo "<td> </td>";
        if($sa910 != NULL)
        {
        echo "<td>". $sa910 . "</td>";
        }else echo "<td> </td>";
        ?>
        </div>
    </tr>
    
    <tr>
        <th>10:00 - 11:00</th>
        
            <?php
        if($mon1011 != NULL)
        {
        echo "<td>". $mon1011 . "</td>";
        }else echo "<td> </td>";
        if($tue1011 != NULL)
        {
        echo "<td>". $tue1011 . "</td>";
        }else echo "<td> </td>";
        if($wed1011 != NULL)
        {
        echo "<td>". $wed1011 . "</td>";
        }else echo "<td> </td>";
        if($th1011 != NULL)
        {
        echo "<td>". $th1011 . "</td>";
        }else echo "<td> </td>";
        if($fri1011 != NULL)
        {
        echo "<td>". $fri1011 . "</td>";
        }else echo "<td> </td>";
        if($sa1011 != NULL)
        {
        echo "<td>". $sa1011 . "</td>";
        }else echo "<td> </td>";
        ?>
        </div>
    </tr>
    
    <tr>
        <th>11:00 - 12:00</th>
        
            <?php
        if($mon1112 != NULL)
        {
        echo "<td>". $mon1112 . "</td>";
        }else echo "<td> </td>";
        if($tue1112 != NULL)
        {
        echo "<td>". $tue1112 . "</td>";
        }else echo "<td> </td>";
        if($wed1112 != NULL)
        {
        echo "<td>". $wed1112 . "</td>";
        }else echo "<td> </td>";
        if($th1112 != NULL)
        {
        echo "<td>". $th1112 . "</td>";
        }else echo "<td> </td>";
        if($fri1112 != NULL)
        {
        echo "<td>". $fri1112 . "</td>";
        }else echo "<td> </td>";
        if($sa1112 != NULL)
        {
        echo "<td>". $sa1112 . "</td>";
        }else echo "<td> </td>";
        ?>
        </div>
    </tr>
    
    
    <tr>
        <th>12:00 - 1:00</th>
        
            <?php
        if($mon121 != NULL)
        {
        echo "<td>". $mon121 . "</td>";
        }else echo "<td> </td>";
        if($tue121 != NULL)
        {
        echo "<td>". $tue121 . "</td>";
        }else echo "<td> </td>";
        if($wed121 != NULL)
        {
        echo "<td>". $wed121 . "</td>";
        }else echo "<td> </td>";
        if($th121 != NULL)
        {
        echo "<td>". $th121 . "</td>";
        }else echo "<td> </td>";
        if($fri121 != NULL)
        {
        echo "<td>". $fri121 . "</td>";
        }else echo "<td> </td>";
        if($sa121 != NULL)
        {
        echo "<td>". $sa121 . "</td>";
        }else echo "<td> </td>";
        ?>
        </div>
    </tr>
    
    <tr>
        <th>1:00 - 2:00</th>
        
            <?php
        if($mon12 != NULL)
        {
        echo "<td>". $mon12 . "</td>";
        }else echo "<td> </td>";
        if($tue12 != NULL)
        {
        echo "<td>". $tue12 . "</td>";
        }else echo "<td> </td>";
        if($wed12 != NULL)
        {
        echo "<td>". $wed12 . "</td>";
        }else echo "<td> </td>";
        if($th12 != NULL)
        {
        echo "<td>". $th12 . "</td>";
        }else echo "<td> </td>";
        if($fri12 != NULL)
        {
        echo "<td>". $fri12 . "</td>";
        }else echo "<td> </td>";
        if($sa12 != NULL)
        {
        echo "<td>". $sa12 . "</td>";
        }else echo "<td> </td>";
        ?>
        </div>
    </tr>
    
    <tr>
        <th>2:00 - 3:00</td>
        
            <?php
        if($mon23 != NULL)
        {
        echo "<td>". $mon23 . "</td>";
        }else echo "<td> </td>";
        if($tue23 != NULL)
        {
        echo "<td>". $tue23 . "</td>";
        }else echo "<td> </td>";
        if($wed23 != NULL)
        {
        echo "<td>". $wed23 . "</td>";
        }else echo "<td> </td>";
        if($th23 != NULL)
        {
        echo "<td>". $th23 . "</td>";
        }else echo "<td> </td>";
        if($fri23 != NULL)
        {
        echo "<td>". $fri23 . "</td>";
        }else echo "<td> </td>";
        if($sa23 != NULL)
        {
        echo "<td>". $sa23 . "</td>";
        }else echo "<td> </td>";
        ?>
        </div>
    </tr>

    <tr>
        <th>3:00 - 4:00</td>
        
            <?php
        if($mon34 != NULL)
        {
        echo "<td>". $mon34 . "</td>";
        }else echo "<td> </td>";
        if($tue34 != NULL)
        {
        echo "<td>". $tue34 . "</td>";
        }else echo "<td> </td>";
        if($wed34 != NULL)
        {
        echo "<td>". $wed34 . "</td>";
        }else echo "<td> </td>";
        if($th34 != NULL)
        {
        echo "<td>". $th34 . "</td>";
        }else echo "<td> </td>";
        if($fri34 != NULL)
        {
        echo "<td>". $fri34 . "</td>";
        }else echo "<td> </td>";
        if($sa34 != NULL)
        {
        echo "<td>". $sa34 . "</td>";
        }else echo "<td> </td>";
        ?>

        </div>
    </tr>

    <tr>
        <th>4:00 - 5:00</td>
        
            <?php
        if($mon45 != NULL)
        {
        echo "<td>". $mon45 . "</td>";
        }else echo "<td> </td>";
        if($tue45 != NULL)
        {
        echo "<td>". $tue45 . "</td>";
        }else echo "<td> </td>";
        if($wed45 != NULL)
        {
        echo "<td>". $wed45 . "</td>";
        }else echo "<td> </td>";
        if($th45 != NULL)
        {
        echo "<td>". $th45 . "</td>";
        }else echo "<td> </td>";
        if($fri45 != NULL)
        {
        echo "<td>". $fri45 . "</td>";
        }else echo "<td> </td>";
        if($sa45 != NULL)
        {
        echo "<td>". $sa45 . "</td>";
        }else echo "<td> </td>";
        ?>

        </div>
    </tr>

    <tr>
        <th>5:00 - 6:00</td>
            <?php
        if($mon56 != NULL)
        {
        echo "<td>". $mon56 . "</td>";
        }else echo "<td> </td>";
        if($tue56 != NULL)
        {
        echo "<td>". $tue56 . "</td>";
        }else echo "<td> </td>";
        if($wed56 != NULL)
        {
        echo "<td>". $wed56 . "</td>";
        }else echo "<td> </td>";
        if($th56 != NULL)
        {
        echo "<td>". $th56 . "</td>";
        }else echo "<td> </td>";
        if($fri56 != NULL)
        {
        echo "<td>". $fri56 . "</td>";
        }else echo "<td> </td>";
        if($sa56 != NULL)
        {
        echo "<td>". $sa56 . "</td>";
        }else echo "<td> </td>";
        ?>
        </div>
    </tr>
     <tr>
        <th>6:00 - 7:00</td>
            <?php
        if($mon67 != NULL)
        {
        echo "<td>". $mon67 . "</td>";
        }else echo "<td> </td>";
        if($tue67 != NULL)
        {
        echo "<td>". $tue67 . "</td>";
        }else echo "<td></td>";
        if($wed67 != NULL)
        {
        echo "<td>". $wed67 . "</td>";
        }else echo "<td> </td>";
        if($th67 != NULL)
        {
        echo "<td>". $th67 . "</td>";
        }else echo "<td> </td>";
        if($fri67 != NULL)
        {
        echo "<td>". $fri67 . "</td>";
        }else echo "<td> </td>";
        if($sa67 != NULL)
        {
        echo "<td>". $sa67 . "</td>";
        }else echo "<td></td>";
        ?>
        </div>
    </tr>
</table>
<br>
<br>
<br>

<?php include("weeklytask.php")?>
<h3 align ="center"><b>Weekly Tasks</b></h3>
 <table width="40%" align = "center" >
     <tr>
   <td><h2><b>Today</b></h2>
   <?php 
   if($today != NULL)
   {
       echo $today;
   }
   else
   {
       echo "You have no current task Today.";
   }
   
   ?>
   </td>
 
     </tr>
     <tr>
         <td><b><h2><?php echo $w2?></h2></b>
    <?php 
   if($secday != NULL)
   {
       echo $secday;
   }
   else
   {
       echo "You have no current task on " . $w2. ".";
   }
   
   ?>
         
         </td>
     </tr>
      <tr>
         <td><b><h2><?php echo $w3?></h2></b>
    <?php 
   if($thiday != NULL)
   {
       echo $thiday;
   }
   else
   {
       echo "You have no current task on " . $w3. ".";
   }
   
   ?>
         
         </td>
     </tr>
      <tr>
         <td><b><h2><?php echo $w4?></h2></b>
    <?php 
   if($forday != NULL)
   {
       echo $forday;
   }
   else
   {
       echo "You have no current task on " . $w4. ".";
   }
   
   ?>
         
         </td>
     </tr>
      <tr>
         <td><b><h2><?php echo $w5?></h2></b>
    <?php 
   if($fifday != NULL)
   {
       echo $fifday;
   }
   else
   {
       echo "You have no current task on " . $w5. ".";
   }
   
   ?>
         
         </td>
     </tr>
      <tr>
         <td><b><h2><?php echo $w6?></h2></b>
    <?php 
   if($sixday != NULL)
   {
       echo $sixday;
   }
   else
   {
       echo "You have no current task on " . $w6. ".";
   }
   
   ?>
         
         </td>
     </tr>
     <tr>
         <td><b><h2><?php echo $w7?></h2></b>
    <?php 
   if($sevday != NULL)
   {
       echo $sevday;
   }
   else
   {
       echo "You have no current task on " . $w7. ".";
   }
   ?>
         
         </td>
     </tr>
</table>
    
    
    
<br/>
<br/>
</div>
<br/>   


</body>
</html>
</html>