<?php

    $servername = getenv('IP');
    $username = getenv('C9_USER');
    $password = "";
    $database = "c9";
    $dbport = 3306;
    
   $db = new mysqli($servername, $username, $password, $database, $dbport);
   $cdb = mysqli_select_db($db,$database);
//---------------------------------------------------------------
session_start();
if(isset($_SESSION["username"]) && isset($_SESSION["password"])){
     
     $user = $_SESSION["username"];
    $pass = $_SESSION["password"];
    
    
}




if(isset($_FILES['notes'])){
    $cid = $_SESSION["cid"];
    $file = $_FILES['notes'];
   
   $file_name = $file["name"];
   $file_tmp = $file["tmp_name"];
   $file_size = $file["size"];
   $file_error = $file["error"];
   
   $file_ext = explode('.', $file_name);
   $file_ext = strtolower(end($file_ext));
   $val = false;
   $allowed = array('txt', 'pdf', 'docx');
   
   if(in_array($file_ext, $allowed)){
       if($file_error === 0){
           if($file_size <= 5000000) // 5MB
           {
               $file_unq = uniqid('',true) . '.' . $file_ext;
               echo $file_desination = 'uploads/' . $file_unq;
               echo "<br>";
               if(move_uploaded_file($_FILES["notes"]["tmp_name"],$file_desination)){
                   
                   $val = true;
               }
               
               
           }else echo "size error";
       }else echo "error";
       
       
   }else echo "not allowed";
    
    
     if($val){
           
           $getstudentid = mysqli_query($db,"Select * from student where username = '$user' and password = '$pass' ");
                    
                
                    
                    
                            if(mysqli_num_rows($getstudentid) > 0){
                              while($row = mysqli_fetch_assoc($getstudentid)){
                                 $sid = $row["ID"];
                                
                              }
                            }
           
          
                     $notes = mysqli_query($db,"SELECT max(id) FROM files");
                                     
                         if($notes) echo "notes good";         
                                     
                                     
                                       
                                       if(mysqli_num_rows($notes) > 0)
                                       {
                                          while($row = mysqli_fetch_assoc($notes)){
                                              $fid =  $row["max(id)"];
                                          }
                                       }
                                       
                                       
                                       if($fid == NULL)
                                       {
                                           $fid = 1;
                                       }
                                       else
                                       {
                                           $fid++; 
                                       }
           
           
                $addfile = "INSERT INTO files (id,sid,cid,fname,location) 
                                VALUES ($fid,$sid,$cid,'$file_name','$file_desination')"; 
                    $hwadd = mysqli_query($db,$addfile);
                    
                    if($hwadd){
                        header("location:userAccountCoursePage.php");
                    }else echo "File not added Error occured.";
           
          
           
       }
    
    
}



?>