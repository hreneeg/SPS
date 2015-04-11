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
    
    
}


   
if(isset($_POST['hw'])){
    
   $hwdate = $_POST["hwdate"];
   $hwtime = $_POST["hwtime"];
   $desc = $_POST["desc"];
   $cid = $_SESSION["cid"];
   $hwtime=date('H:i:s',strtotime($hwtime));  
   
   
       $val = true;
       $err1 = true;
       $err2 = true;
       $err3 = true;
       $err4 = true;
       
       if(empty($_POST["hwdate"])){
        $_SESSION["hwdateERR"] = "Please enter a Homework Date";   
        $val = false; 
        
       }
       if(empty($_POST["hwtime"])){
        		$val = false;
        		$_SESSION["hwtimeERR"] = "Please enter a Homework Time";

        		}
            
        if(empty($_POST["desc"]))
                {
                    $_SESSION["descERR"] = "Please enter a brief description of your assigment<br>";
                    $val = false;
                    
                } 
       
       
       if(!$val)
       {
          header("location:userAccountCoursePage.php"); 
       }


      
       
       
       
       
       if($val){
           
           $getstudentid = mysqli_query($db,"Select * from student where username = '$user' and password = '$pass' ");
                    
                
                    
                    
                            if(mysqli_num_rows($getstudentid) > 0){
                              while($row = mysqli_fetch_assoc($getstudentid)){
                                 $sid = $row["ID"];
                                
                              }
                            }
           
          
                     $hw = mysqli_query($db,"SELECT max(id) FROM homework");
                                     
                                  
                                     
                                     
                                       
                                       if(mysqli_num_rows($hw) > 0)
                                       {
                                          while($row = mysqli_fetch_assoc($hw)){
                                              $hid =  $row["max(id)"];
                                          }
                                       }
                                       
                                       
                                       if($hid == NULL)
                                       {
                                           $hid = 1;
                                       }
                                       else
                                       {
                                           $hid++; 
                                       }
           
           
                $addhw = "INSERT INTO homework (id,date,time,hwdesc,sid,cid) 
                                VALUES ($hid,'$hwdate','$hwtime','$desc',$sid,$cid)"; 
                    $hwadd = mysqli_query($db,$addhw);
                    
                    if($hwadd){
                        header("location:userAccountCoursePage.php");
                    }else "Homework not added Error occured.";
           
          
           
       }
            
    
    
    
}else echo "not set";



?>