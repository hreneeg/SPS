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
     
     
     
     
     
     

 }
 
?>
<!DOCTYPE html>
<html>
 
 <style type="text/css">
    body
    {
        font-family: arial;
    }

    th,td
    {
        margin: 0;
        text-align: center;
        border-collapse: collapse;
        outline: 1px solid #e3e3e3;
    }

    td
    {
        padding: 5px 10px;
    }

    th
    {
        background: #666;
        color: white;
        padding: 5px 10px;
    }
    iframe {
        margin: 0;
        padding: 0;
        border: none;
        width: value;
        height: value;
       }
    
    
    
    </style> 
<?php
$allhw = mysqli_query($db,"SELECT * FROM homework WHERE sid = $sid 
       AND cid = $cid") or $test7 = "courses FAIL";
       $i = 0;
      if(mysqli_num_rows($allhw) > 0){
       
       
       echo " <table width='37%' style='float: right'>"; 
       echo "<th> My Homework Assignments </th>";
               echo "<tr>";
              echo "<td>";
           while($row = mysqli_fetch_assoc($allhw)){
              $i++; 
              $strevday = strtotime($row["date"]);
        	  $evday = date("l",$strevday);
        	   
        	  $time  = DATE("g:i a", STRTOTIME($row["time"]));
        	 
             echo "<h2> Homework ".$i ."</h2>"."<br>"
              .$row["hwdesc"]. "<br>"."<br>".
              
             "<b>". "Due Date: ".$row["date"]."</b>". "<br>".
               $evday." at ".$time. "<br>"."<br>"."<hr>";
            
           }
          echo "</td>";
         echo "</tr>";   
     }
     echo "</table>";
     
     
    
   
?>