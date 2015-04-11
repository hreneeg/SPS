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
    
     // Query to Database
       $query = mysqli_query($db,"Select * from student where username = '$user' and 
       password = '$pass' ");
       
   // if any rows are selected. Just copy this code.
   if(mysqli_num_rows($query) > 0)
   {
      while($row = mysqli_fetch_assoc($query)){
          // Select the information by row name.
          $fname =  $row["firstname"];
          $lname = $row["lastname"];
          $email = $row["email"];
      }
   }else echo "no rows";
    
    
    
    
}


?>

<!DOCTYPE html>
<html>
<head>
<title>SPS: Home</title>
<style>
    body {
        font-family: "Trebuchet MS", Verdana, sans-serif;
        font-size: 16px;
        background-color: #DADAFF; 
		    margin: 0px;
        color: black;
        padding: 3px;
    }
	#main {
		background-color: white;
		margin-left:22%;
		margin-right:22%;
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
    
        font-family: Georgia, serif;
        border-bottom: 3px solid #cc9900;
        font-size: 30px;
    }
    h1{
        font: arial;
        font-size: 180%;
        text-align: center;
    }

</style>
</head>

<body><div id=main>
    <p><center><font size=2><a href="userAccountHome.php">Home</a> &nbsp;&nbsp;&nbsp;&nbsp;  
                            <a href="userAccountCalendar.php">Calendar</a> &nbsp;&nbsp;&nbsp;&nbsp;  
                            <a href="userAccountCourses.php">Courses</a> &nbsp;&nbsp;&nbsp;&nbsp;  
                            <a href="userAccountContacts.php">Contacts</a> &nbsp;&nbsp;&nbsp;&nbsp; 
                            <a href="userAccountOptions.php">Options</a> &nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="userAccountLogout.php">Logout</a>
    </font></center></p>

        <table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
        <tr>
        <td colspan="3"><strong><center>Home</center></strong></td>
        </tr>
        </table>
        
    <br>

     <table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
                    <tr>
                    <form name="form1" method="post" action="userAccountHome.php">
                    <td>
                    <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
                    <tr>
                    <td colspan="3"><strong>Your Account Information</strong></td>
                       </tr>
                    <tr>
                    <td width="8">First Name</td>
                    <td width="15">:</td>
                    <td width="294"><input name="edit_fname" type="text" value ='<?php echo $fname?>'></td>
                    </tr>
                    <tr>
                    <td width="8">Last Name</td>
                    <td width="15">:</td>
                    <td width="294"><input name="edit_lname" type="text" value="<?php echo $lname?>"></td>
                    </tr>
                    <tr>
                    <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td><input name="edit_email" type="text" value="<?php echo $email?>"></td>
                    <span class="error"> <?php echo $emailErr;?></span>
                    </tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><input type="submit" name="edit" style="height:22px; width:153px" value="Edit Account"></td>
                     <span> <?php echo $accupdated?></span>
                    </tr>
                    </table>
                    </td>
                    </form>
                    </tr>
                    </table>
           
<br>
<br>




</body>
</html>
</html>