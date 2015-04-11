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

     
        $header = "https://seproject-hrguyll.c9.io/";   
 $mynotes = mysqli_query($db,"SELECT * FROM files WHERE sid = $sid 
       AND cid = $cid") ;
       
         if(mysqli_num_rows($mynotes) > 0){
        echo " <table width='37%' style='float: left'>";  
       echo "<th> My Notes </th>";
       echo "<tr>";
       echo "<td>";
           while($row = mysqli_fetch_assoc($mynotes)){
               echo "<h4>". "<a href='".$header.$row["location"]."'>" . $row["fname"]."</a>". "</h4>";
             
           }
           
           
     } 
     echo " </td>".
     "</tr>";
     echo "</table>";
     
?>