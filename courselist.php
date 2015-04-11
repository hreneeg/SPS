<!doctype html>
<html>
<head>
    <title>Timetable</title>
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
    </style>

</head>
<body>
<?php
   $servername = getenv('IP');
    $username = getenv('C9_USER');
    $password = "";
    $database = "c9";
    $dbport = 3306;
    
   $db = new mysqli($servername, $username, $password, $database, $dbport);
   $cdb = mysqli_select_db($db,$database);







echo "<h1 align = center> Listed Courses </h1>";
     
$allcourse = mysqli_query($db,"SELECT * FROM dircourse, professor WHERE dircourse.pid = professor.id") or $test7 = "courses FAIL";
       
                    
        
                   
     echo "<table border =1 align ='center'> ";
               echo "<tr>";
            //   echo "<th> SELECT</th>";
               echo "<th> Course ID</th>";
               echo "<th> Course Name</th>";
               echo "<th> Course Time</th>";
               echo "<th> Course Days</th>";
               echo "<th> Course Credits</th>";
               echo "<th> Course Description</th>";
               echo "<th> Professor First Name</th>";
               echo "<th> Professor Last Name</th>";
               echo "<th> Professor Email</th>";
               echo " </tr>";
                if(mysqli_num_rows($allcourse) > 0){
                  
                  
                  
                              while($row = mysqli_fetch_assoc($allcourse)){
                                  $mypid = $row["pid"];
                                  $mycid = $row["CID"];
               $stime  = DATE("g:i a", STRTOTIME($row["stime"]));
               $etime  = DATE("g:i a", STRTOTIME($row["etime"]));
               // $input = " <input type='radio' name='del' value='$mycid'>";
                
               echo "<tr>";
              // echo "<td>". $input . "</td>";
               echo  "<td>". $mycid. "</td>";
               echo "<td>" .$row["cname"]. "</td>";
               echo "<td>". $stime."-".$etime. "</td>";
               echo "<td>". $row["cdays"] . "</td>";
               echo "<td>". $row["credit"] . "</td>";
               echo "<td>". $row["cdes"] . "</td>";
               echo "<td>". $row["firstname"] . "</td>";
               echo "<td>". $row["lastname"] . "</td>";
               echo "<td>". $row["email"] . "</td>";
               echo "</tr>";
    
                              }
                              
                  
                            }
                          
      
                          
     echo "</table>";

?>