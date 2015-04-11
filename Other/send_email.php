<?php

    $servername = getenv('IP');
    $username = getenv('C9_USER');
    $password = "";
    $database = "c9";
    $dbport = 3306;
    
   $db = new mysqli($servername, $username, $password, $database, $dbport);
   $cdb = mysqli_select_db($db,$database);
   
   session_start();
   if(isset($_SESSION["username"]) && isset($_SESSION["password"])){
       
       $user = $_SESSION["username"];
       $pass = $_SESSION["password"];
       
       
        $student = mysqli_query($db,"Select * from student where username = '$user' and password = '$pass' ")
                                           or $test5 = "SID FAIL";
                    
                            if(mysqli_num_rows($student) > 0){
                              while($row = mysqli_fetch_assoc($student)){
                                  
                                 $email = $row["email"];
                                 $fname = $row["firstname"];
                                 $lname = $row["lastname"];
                              }
                            }
   $fullname = $fname . " " . $lname;
   
   if(isset($_POST["emailform"])){
       
       $emailto = $_POST["email"];
       $subject = $_POST["subject"];
       $message = $_POST["message"];
       
       $val = true;
       $err1 = true;
       $err2 = true;
       $err3 = true;
       $err4 = true;
       if(empty($_POST["message"])){
        $_SESSION["messageERR"] = "Please enter a Message";   
        $val = false; 
        
       }
       if(empty($_POST["subject"])){
        		$val = false;
        		$_SESSION["subjectERR"] = "Please enter a Subject";

        		}
            
      if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
               $_SESSION["invalidemail"] = "Sorry, Please enter a valid email." ;   
               $val = false;
               
               }
        if(empty($_POST["email"]))
                {
                    $_SESSION["emailERR"] = "Please enter email <br>";
                    $val = false;
                    
                } 
       
       
       if(!$val)
       {
          header("location:userAccountContacts.php"); 
       }


      
       
       
       
       
       if($val){
           
     
          
           
    
             
           }
    
    
    
       
   }     
       
       
       
       
       
       
       
   }
   
   
   























?>
