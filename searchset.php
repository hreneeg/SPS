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
    $hide = false;
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
   $st = $_POST["stime"];
    $et = $_POST["etime"]; 
   $val = true;
   $scompare = DATE("g:i a", STRTOTIME($st));
    $ecompare = DATE("g:i a", STRTOTIME($et));
  $conflict = mysqli_query($db,"SELECT * FROM course, linkid WHERE linkid.sid = $ssid 
            AND linkid.cid = course.cid");
               
                           if(mysqli_num_rows($conflict) > 0){
                              while($row = mysqli_fetch_assoc($conflict)){
                                   $sttime  = DATE("g:i a", STRTOTIME($row["stime"]));
                                   $entime  = DATE("g:i a", STRTOTIME($row["etime"]));
                 
                                   if(strpos($row["cdays"], $days) !== FALSE)
                                 {
                                 $intersect = min($entime, $ecompare) - max($sttime, $scompare);
                                  if ( $intersect < 0 ) $intersect = 0;
		                              $overlap = $intersect / 3600;
		                                if ( $overlap > 0 ){
		                                   $contime .= "There is a time conflict between your course ". $row["cname"]. " on ".$row["cdays"].
		                                   " at ".$sttime. " to ".$entime. "<br>" . "<hr>";
		                                   $val = false;
		                                }
                                     
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
    
}  
  
  
  
  
  
 
  
  
   
 ?>