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
   
//--------------------------------------------------------------------------
$err = $err1 = $err2 = "";
session_start();
if(isset($_POST["Submit"])){
            // username and password sent from form 
            $myusername=$_POST['myusername']; 
            $mypassword=$_POST['mypassword']; 
            $val = true;
            
            if(empty($myusername)){
        	   $err1 = "Please Enter a Username <br>";
        	   $val = false;
            }
        	if(empty($mypassword)){
        	   
               $err2 = "Please Enter a Password <br>";
               $val = false;
        	}
                
            if($val){
            $check_user = mysqli_query($db,"SELECT * FROM student WHERE username='$myusername' and password='$mypassword'");
         
         

                if(mysqli_num_rows($check_user) > 0)
                    {
                        $_SESSION["username"] = $myusername;
                        $_SESSION ["password"] = $mypassword;
                        
                        while($row = mysqli_fetch_assoc($check_user)){
                                 $sid = $row["ID"];
                
                              }
                        
             $useroption = mysqli_query($db,"SELECT * FROM options WHERE sid= $sid");
                        if(mysqli_num_rows($useroption) > 0){
                        while($row = mysqli_fetch_assoc($useroption)){
                                 $_SESSION["pagefont"] = $row["font"];
                                 $_SESSION["pagestyle"] = $row["style"];
                                 
                              }
                              
                              
                        }else{
                            
                            $_SESSION["pagefont"] = "font1";
                            $_SESSION["pagestyle"] = "style1";
                            
                        }
                        
                        header("location:userAccountHome.php");
                        
                        
        
                    } 
                    else
                    {
                         $err = "Username or Password is Incorrect. <br>";
                    }
                    
            }

}



?>



<!DOCTYPE html>
<html>
<head>
<title>SPS: Login</title>
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
		background-color: #FFFFFF;
		margin-left:2.5%;
		margin-right:2.5%;
		box-shadow: 10px 10px 5px #888888;
	}
	#head {
	    width: 100%;
	    height: 73px;
	    background-color: #FFFFFF;
		margin: 0;
		display: inline-block; 
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

<body>
    
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
    
<div id="main">
        <br/>
        <br/>
        <table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
        <tr>
        <form name="form1" method="post" action="main_login.php">
        <td>
        <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
        <tr>
        <td colspan="3"><strong>Member Login </strong></td>
        </tr>
        <tr>
        <td width="78">Username</td>
        <td width="6">:</td>
        <td width="294"><input name="myusername" type="text" id="myusername"></td>
        <span class="error"> <?php echo $err1;?></span>
        </tr>
        <tr>
        <td>Password</td>
        <td>:</td>
        <td><input name="mypassword" type="password" id="mypassword"></td>
        <span class="error"> <?php echo $err2;?></span>
        </tr>
        <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><input type="submit" name="Submit" value="Login"></td>
        <span class="error"> <?php echo $err;?></span>
        </tr>
        </table>
        </td>
        </form>
        </tr>
        </table>
        
    <p><font size="2"><center> Not already a Member? Click <a href = "https://seproject-hrguyll.c9.io/register.php">here</a> to sign up!</font></center></p>
<br>
<br>

</div>
</body>
</html>
</html>