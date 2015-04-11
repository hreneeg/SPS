<?php
include("connect.php");

 session_start();
  if(isset($_SESSION["username"]) && isset($_SESSION["password"])){
     
     $user = $_SESSION["username"];
    $pass = $_SESSION["password"];
     $student = mysqli_query($c9db,"Select * from student where username = '$user' and password = '$pass' ")
                                           or $test5 = "SID FAIL";
                    
                            if(mysqli_num_rows($student) > 0){
                              while($row = mysqli_fetch_assoc($student)){
                                  
                                 $sid = $row["ID"];
                
                              }
                            }
    
 }

date_default_timezone_set('America/Chicago');
$day=strtotime("today");
$day2=strtotime("+1 days");
$day3=strtotime("+2 days");
$day4=strtotime("+3 days");
$day5=strtotime("+4 days");
$day6=strtotime("+5 days");
$day7=strtotime("+6 days");

$d1 = date("Y-m-d", $day);
$d2 = date("Y-m-d", $day2);
$d3 = date("Y-m-d", $day3);
$d4 = date("Y-m-d", $day4);
$d5 = date("Y-m-d", $day5);
$d6 = date("Y-m-d", $day6);
$d7 = date("Y-m-d", $day7);

$dt = strtotime($d2);
$w2 = date("l",$dt);
$dt = strtotime($d3);
$w3 = date("l",$dt);
$dt = strtotime($d4);
$w4 = date("l",$dt);
$dt = strtotime($d5);
$w5 = date("l",$dt);
$dt = strtotime($d6);
$w6 = date("l",$dt);
$dt = strtotime($d7);
$w7 = date("l",$dt);

 
     $query = mysqli_query($db,"SELECT * FROM events WHERE DATE_SUB(evdate, INTERVAL 7 DAY) AND sid = $sid" );
		$num_rows = mysqli_num_rows($query);
         if(mysqli_num_rows($query) > 0){
            
        while($row = mysqli_fetch_assoc($query)){
           
            
            if($row["evdate"] == $d1)
            {
                $today .="Your ".$row["evtype"] ." Event ". $row["description"] . " is scheduled today". "<br>";
            }
            
            if($row["evdate"] == $d2)
            {
                $secday .="Your ".$row["evtype"] ." Event ". $row["description"] . " is scheduled tomorrow". "<br>";
            }
            if($row["evdate"] == $d3)
            {
                $thiday .= "Your ".$row["evtype"] ." Event ". $row["description"] . " is scheduled on ".$w3. "<br>";;
            }
            if($row["evdate"] == $d4)
            {
                $forday .= "Your ".$row["evtype"] ." Event ". $row["description"] . " is scheduled on ".$w4. "<br>";
            }
            if($row["evdate"] == $d5)
            {
                $fifday .= "Your ".$row["evtype"] ." Event ". $row["description"] . " is scheduled on ".$w5. "<br>";
            }
            if($row["evdate"] == $d6)
            {
                $sixday .= "Your ".$row["evtype"] ." Event ". $row["description"]. " is scheduled on ".$w6. "<br>";
            }
             if($row["evdate"] == $d7)
            {
                $sevday .= "Your ".$row["evtype"] ." Event ". $row["description"] . " is scheduled on ".$w7. "<br>";
            }
        }
    }

  $idquery = mysqli_query($c9db,"SELECT * FROM homework WHERE DATE_SUB(date, INTERVAL 7 DAY) AND sid = $sid" );
		$num_rows = mysqli_num_rows($idquery);
         if(mysqli_num_rows($idquery) > 0){
           
        while($row = mysqli_fetch_assoc($idquery)){
        
             if($row["date"] == $d1)
            {
    
                $todayid = $row["CID"];
            }
            
            if($row["date"] == $d2)
            {
  
                $secid = $row["CID"];
            }
            if($row["date"] == $d3)
            {
        
                $thiid = $row["CID"];
            }
            if($row["date"] == $d4)
            {
       
                $forid = $row["CID"];
            }
            if($row["date"] == $d5)
            {
        
                $fifid = $row["CID"];
            }
            if($row["date"] == $d6)
            {
       
                $sixid = $row["CID"];
            }
             if($row["date"] == $d7)
            {

                $sevid = $row["CID"];
            }
        }


             }

   $taquery = mysqli_query($c9db,"SELECT * FROM course WHERE cid = $todayid" );
         if(mysqli_num_rows($taquery) > 0){
        while($row = mysqli_fetch_assoc($taquery)){  
            $todayname = $row["cname"];
              }
         }  
      
         $toquery = mysqli_query($c9db,"SELECT * FROM course WHERE  cid = $secid" );
         if(mysqli_num_rows($toquery) > 0){
        while($row = mysqli_fetch_assoc($toquery)){  
            $secname = $row["cname"];
              }
         }
         
         $thiquery = mysqli_query($c9db,"SELECT * FROM course WHERE  cid = $thiid" );
         if(mysqli_num_rows($thiquery) > 0){
        while($row = mysqli_fetch_assoc($thiquery)){  
            $thiname = $row["cname"];
              }
         }
         $forquery = mysqli_query($c9db,"SELECT * FROM course WHERE  cid = $forid" );
         if(mysqli_num_rows($forquery) > 0){
        while($row = mysqli_fetch_assoc($forquery)){  
            $forname = $row["cname"];
              }
         }
         $fifquery = mysqli_query($c9db,"SELECT * FROM course WHERE  cid = $fifid" );
         if(mysqli_num_rows($fifquery) > 0){
        while($row = mysqli_fetch_assoc($fifquery)){  
            $fifname = $row["cname"];
              }
         }
         $sixquery = mysqli_query($c9db,"SELECT * FROM course WHERE cid = $sixid" );
         if(mysqli_num_rows($sixquery) > 0){
        while($row = mysqli_fetch_assoc($sixquery)){  
            $sixname = $row["cname"];
              }
         }
         $sevquery = mysqli_query($c9db,"SELECT * FROM course WHERE cid = $sevid" );
         if(mysqli_num_rows($sevquery) > 0){
        while($row = mysqli_fetch_assoc($sevquery)){  
            $sevname = $row["cname"];
              }
         }


    $hwquery = mysqli_query($c9db,"SELECT * FROM homework WHERE DATE_SUB(date, INTERVAL 7 DAY) AND sid = $sid" );
		$num_rows = mysqli_num_rows($hwquery);
         if(mysqli_num_rows($hwquery) > 0){
           
        while($row = mysqli_fetch_assoc($hwquery)){
           $time  = DATE("g:i a", STRTOTIME($row["time"]));
             if($row["date"] == $d1)
            {
                $today .= $todayname." Homework Due Today at " . $time . "<br>";
               
            }
            
            if($row["date"] == $d2)
            {
                $secday .= $secname ." Homework Due Tommorrow at " .$time. "<br>";
               
            }
            if($row["date"] == $d3)
            {
                $thiday .= $thiname ." Homework Due on ".$w3 ." at ".$time . "<br>";
                
            }
            if($row["date"] == $d4)
            {
                $forday .= $forname. " Homework Due on ".$w4 ." at ".$time . "<br>";
              
            }
            if($row["date"] == $d5)
            {
                $fifday .=  $fifname." Homework Due on ".$w5 ." at ".$time . "<br>";
            
            }
            if($row["date"] == $d6)
            {
                $sixday .=  $sixname." Homework Due on ".$w6 ." at ".$time . "<br>";
            
            }
             if($row["date"] == $d7)
            {
                $sevday .= $sevname." Homework Due on ".$w7 ." at ".$time . "<br>";
            }
        }


             }
             
             
             
        
             

?>
