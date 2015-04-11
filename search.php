  
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
    //$hide = false;
      $student = mysqli_query($db,"Select * from student where username = '$user' and password = '$pass' ")
                                           or $test5 = "SID FAIL";
                    
                            if(mysqli_num_rows($student) > 0){
                              while($row = mysqli_fetch_assoc($student)){
                                  
                                 $ssid = $row["ID"];
                
                              }
                            }
                            
     

     
 }
 
  
  
 if(isset($_POST["addsrch"])){
   $sel = $_POST["sel"];
   $profid = $_POST["pid"];
   $st = $_POST["st"];
    $et = $_POST["et"]; 
    $days = $_POST["cdy"];
   $val = true;
   $scompare = DATE("g:i a", STRTOTIME($st));
    $ecompare = DATE("g:i a", STRTOTIME($et));
  $conflict = mysqli_query($db,"SELECT * FROM course, linkid WHERE linkid.sid = $ssid 
            AND linkid.cid = course.cid");
               
                                   if (strpos($days, 'Mo') !== FALSE)
                                        $days = "Mo";
                                   if (strpos($days, 'Tu') !== FALSE)
                                        $days = "Tu";
                                   if (strpos($days, 'We') !== FALSE)
                                        $days = "We";
                                   if (strpos($days, 'Th') !== FALSE)
                                       $days = "Th";
                                   if (strpos($days, 'Fr') !== FALSE)
                                       $days = "Fr";
                                   if (strpos($days, 'Sa') !== FALSE) 
                                       $days = "Sa";
                                   

                                   
                           if(mysqli_num_rows($conflict) > 0){
                              while($row = mysqli_fetch_assoc($conflict)){
                                   $sttime  = DATE("g:i a", STRTOTIME($row["stime"]));
                                   $entime  = DATE("g:i a", STRTOTIME($row["etime"]));
        
                                   if(strpos($row["cdays"], $days) !== FALSE && ($ecompare >= $sttime && $scompare < $entime))
                                 {
                                     echo "here";
		                                   $_SESSION["contime"] .= "There is a time conflict between your course ". $row["cname"]. " on ".$row["cdays"].
		                                   " at ".$sttime. " to ".$entime. "<br>" . "<hr>";
		                                   $val = false;
		                                }
                                     
                                 }
                                   
                              }
                           



if($val){ 
  
 $ql = mysqli_query($db,"SELECT max(id) FROM linkid") or $test4 = "lINK ID FAILED";
                                       
                     if(mysqli_num_rows($ql) > 0)
                                 {
                          while($row = mysqli_fetch_assoc($ql)){
                                              $lid =  $row["max(id)"];
                                          }
                                       }
                                       
                                       
                                       if($lid == NULL)
                                       {
                                           $lid = 1;
                                       }
                                       else
                                       {
                                           $lid++; 
                                       }
                          
                     $linkids = "INSERT INTO linkid (id,sid,cid,pid) 
                                VALUES ($lid,$ssid,$sel,$profid)";
                         $idadded =   mysqli_query($db,$linkids) ;   
                         
	// Refresh Page.
	$show = false;
	$hide = false;
	header("location:userAccountCourses.php");
}
   header("location:userAccountCourses.php"); 
}  
  
 ?>

 
 
 
 
   
<?php

     
$allcourse = mysqli_query($db,"SELECT * FROM dircourse, professor WHERE dircourse.pid = professor.id
AND dircourse.cid = $selected") or $test7 = "courses FAIL";
       
                    

         
                if(mysqli_num_rows($allcourse) > 0){
                  echo "<h1 align = center> Searh Results</h1>";  
         echo "<form method='post' action='search.php'>.
              <input type='submit' name='addsrch' value='Add Course'>";         
                 echo "<br>";
                  echo "<br>"; 
                 echo "<table border =1 align ='center'> ";
               echo "<tr>";
               echo "<th> SELECT</th>";
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
                  
                              while($row = mysqli_fetch_assoc($allcourse)){
                                  $mypid = $row["PID"];
                                  $mycid = $row["CID"];
                                  $days = $row["cdays"];
               $stime  = DATE("g:i a", STRTOTIME($row["stime"]));
               $etime  = DATE("g:i a", STRTOTIME($row["etime"]));
               
               
                $input = " <input type='radio' name='sel' value='$mycid'>".
                         " <input type='hidden' name='pid' value='$mypid'>".
                         " <input type='hidden' name='st' value='$stime'>".
                         " <input type='hidden' name='et' value='$etime'>".
                         " <input type='hidden' name='cdy' value='$days'>";
                         
                         
               echo "<tr>";
               echo "<td>". $input . "</td>";
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
                              
                  
    echo "</table>";
     echo "</form>";          
                 
                            } else echo "<h4>No course were Found with the ID inputed</h4>";
  
  
?>