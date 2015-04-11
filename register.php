<?php

//----------------------------------------------------------------------------------
// CONNECT TO THE DATABASE
//----------------------------------------------------------------------------------
    $servername = getenv('IP');
    $username = getenv('C9_USER');
    $password = "";
    $database = "c9";
    $dbport = 3306;
    
   $db = new mysqli($servername, $username, $password, $database, $dbport);
   $cdb = mysqli_select_db($db,$database);
   
 //-------------------------------------------------------------------------------  
 $fErr = $lErr = $uErr = $pErr = $emailErr = $eErr = "";
$userex = $emailex = $success = "";





if(isset($_POST['reg'])) 
 { 
            $val = true;      
            $reg = true;
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $username = $_POST['myusername'];
            $email = $_POST['email'];
            $password = $_POST['mypassword']; 
          //----------------------------------------------------
          // VALIDATES FORM ENTRIES
          //--------------------------------------------------------
        		if(empty($_POST["myusername"])){
        		$uErr = "Please enter a username<br>";
        		$val = false;
        		}
        		if(empty($_POST["mypassword"])){
        		$pErr = "Please enter a password<br>";
        		$val = false;
        		}
        		if(empty($_POST["fname"])){
        		$fErr= "Please enter your first name<br>";
        		$val = false;
        		}
        		
        		if(empty($_POST["lname"])){
        		$lErr = "Please enter your last name<br>";
        		$val = false;
        		}
            
               if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Please enter a valid email. (Eg. joe@example.com) <br> ";
               $val = false;
               }
                if(empty($_POST["email"]))
                {
                    $eErr = "Please enter email <br>";
                    $val = false;
                    
                }  
                
            
            //--------------------
                
                if(!$val)
                {
                    $reg = false;
                }
            //---------------------
            
            
                if($val){
                    
                $check_user = mysqli_query($db,"SELECT * FROM student WHERE username = '$username'"); 
                $check_email = mysqli_query($db,"SELECT * FROM student WHERE email = '$email'");
                                
                if(mysqli_num_rows($check_user) > 0)
                    {
                        $userex = "Username already exist <br>";
                        $reg = false;
                    }     
                   
                if(mysqli_num_rows($check_email) > 0)
                    {

                        $emailex = "Email address already exist <br>";
                        $reg = false;
                    }              
           
                }
            
        
            if($reg){
                
                     // Creating a Unique ID.  
                     //-----------------------------------------------------
                      $q = mysqli_query($db,"SELECT max(id) FROM student");
                       
                       if(mysqli_num_rows($q) > 0)
                       {
                          while($row = mysqli_fetch_assoc($q)){
                              $id =  $row["max(id)"];
                          }
                       }
                       
                       
                       if($id == NULL)
                       {
                           $id = 1;
                       }
                       else
                       {
                           $id++; 
                       }
                    //------------------------------------------------------------------    
                    //  INSERTING VALUES INTO DATABASE.
                    //--------------------------------------------------------------------
                     
                        $query = "INSERT INTO student (id,firstname,lastname,username,password,email) 
                        VALUES ($id,'$fname','$lname','$username','$password','$email')"; 
                        $data = mysqli_query($db,$query) or die(mysql_error());
                    
        
         }        
            
      
            
           
          

}
?>
            <html>
            <head>
            
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
<?php if(!$data){ ?>
            <br/>
            <br/>
                    <table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
                    <tr>
                    <form name="form1" method="post" action="register.php">
                    <td>
                    <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
                    <tr>
                    <td colspan="3"><strong>Registration Form</strong></td>
                       </tr>
                    <tr>
                    <td width="78">First Name</td>
                    <td width="15">:</td>
                    <td width="294"><input name="fname" type="text" id="myfname"></td>
                    <span class="error"> <?php echo $fErr;?></span>
                    </tr>
                    <tr>
                    <td width="78">Last Name</td>
                    <td width="15">:</td>
                    <td width="294"><input name="lname" type="text" id="mylname"></td>
                    <span class="error"> <?php echo $lErr;?></span>
                    </tr>
                    <tr>
                    <td width="78">Username</td>
                    <td width="6">:</td>
                    <td width="294"><input name="myusername" type="text" id="myusername"></td>
                    <span class="error"> <?php echo $uErr;?></span>
                    </tr>
                    <tr>
                    <td>Password</td>
                    <td>:</td>
                    <td><input name="mypassword" type="password" id="mypassword"></td>
                    <span class="error"> <?php echo $pErr;?></span>
                    </tr>
                    <tr>
                    <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td><input name="email" type="text" id="myemail"></td>
                    <span class="error"> <?php echo $eErr;?></span>
                    <span class="error"> <?php echo $emailErr;?></span>
                    </tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><input type="submit" name="reg" value="Sign up!"></td>
                    <span class="error"> <?php echo $userex;?></span>
                    <span class="error"> <?php echo $emailex;?></span>
                    </tr>
                    </table>
                    </td>
                    </form>
                    </tr>
                    </table>
<?php } else { ?>
            <h1>You are now registered!</h1>
            <br>
<?php } ?>
                    
   <p><font size="2"><center>  Click <a href = "https://seproject-hrguyll.c9.io/main_login.php" >here</a> to Sign in.</font></center></p>
            <br>
            <br>

</div>
</body>
</html>