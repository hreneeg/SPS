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
                                  
                                 $ssid = $row["ID"];
                
                              }
                            }
                            
     $linksid = mysqli_query($db,"Select * from linkid where sid = $ssid")
                                           or $test6 = "LINKID FAIL";
     
                if(mysqli_num_rows($linksid) > 0){
                    $nocourse  = false;
                             
                            }
     

     
 }
?>

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

    td:hover
    {
        cursor: pointer;
        background: #666;
        color: white;
    }
    </style>

</head>
<body>
    
<?php

$allcourse = mysqli_query($db,"SELECT * FROM course, linkid, professor WHERE linkid.sid = $ssid 
       AND course.cid = linkid.cid AND course.pid = professor.id") or $test7 = "courses FAIL"; 
       $link ="https://seproject-hrguyll.c9.io/userAccountCoursePage.php";   
        
     $num =  mysqli_num_rows($allcourse); 
        if(mysqli_num_rows($allcourse) > 0){
            $showtimeline = true;
        while($row = mysqli_fetch_assoc($allcourse)){
           $lap =0;
          $stime  = DATE("g:i a", STRTOTIME($row["stime"]));
          $etime  = DATE("g:i a", STRTOTIME($row["etime"]));
          $end = (strtotime($etime) - strtotime($stime)) / 3600;
          $stop = $see = intval($end) + 1;
        if (strpos($row["cdays"], 'Mo') !== FALSE && (($stime >= "8:00 am" && $stime < "9:00 am")))
        {
              $mon89 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;
        }
    
        if (strpos($row["cdays"], 'Tu') !== FALSE && (($stime >= "8:00 am" && $stime < "9:00 am") || ($start) ))
        {
             $tue89 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;
        }
       
        if (strpos($row["cdays"], 'We') !== FALSE && (($stime >= "8:00 am" && $stime < "9:00 am") || ($start) ))
        {
            $wed89 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;
        }
           
        if (strpos($row["cdays"], 'Th') !== FALSE && (($stime >= "8:00 am" && $stime < "9:00 am") || ($start) ))
        {
             $th89 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;
        }
       
        if (strpos($row["cdays"], 'Fr') !== FALSE && (($stime >= "8:00 am" && $stime < "9:00 am") || ($start) ))
        {
                $fri89 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;
        }
     
         if (strpos($row["cdays"], 'Sa') !== FALSE && (($stime >= "8:00 am" && $stime < "9:00 am") || ($start) ))
        {
            $sa89 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;
        }
      

         if($start)
         {
              $lap++; if($lap + 1 >= $stop)$start = false;
         }
   
        if (strpos($row["cdays"], 'Mo') !== FALSE && (($stime >= "9:00 am" && $stime < "10:00 am") || ($start)  ))
        {
            $mon910 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;  
        }
   
        if (strpos($row["cdays"], 'Tu') !== FALSE && (($stime >= "9:00 am" && $stime < "10:00 am") || ($start)  ))
        {
            $tue910 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;
        }
         
        if (strpos($row["cdays"], 'We') !== FALSE && (($stime >= "9:00 am" && $stime < "10:00 am") || ($start)  ))
        {
             $wed910 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;
        }
     
        if (strpos($row["cdays"], 'Th') !== FALSE && (($stime >= "9:00 am" && $stime < "10:00 am") || ($start)  ))
        {
            $th910 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;
        }
        if (strpos($row["cdays"], 'Fr') !== FALSE && (($stime >= "9:00 am" && $stime < "10:00 am") || ($start)  ))
        {
           $fri910 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;
        }
        
         if (strpos($row["cdays"], 'Sa') !== FALSE && (($stime >= "9:00 am" && $stime < "10:00 am") || ($start)  ))
        {
         $sa910 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;
        }
        
  
     if($start)
         {
              $lap++; if($lap + 1 >= $stop)$start = false;
         }
  
  
  
        if (strpos($row["cdays"], 'Mo') !== FALSE && (($stime >= "10:00 am" && $stime < "11:00 am") || ($start)))
        {
    $mon1011 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true; 

        }

        if (strpos($row["cdays"], 'Tu') !== FALSE && (($stime >= "10:00 am" && $stime < "11:00 am") || ($start)))
        {
     $tue1011 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;

        }
    
        if (strpos($row["cdays"], 'We') !== FALSE && (($stime >= "10:00 am" && $stime < "11:00 am") || ($start)))
        {
      $wed1011 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;

        }
 
        if (strpos($row["cdays"], 'Th') !== FALSE && (($stime >= "10:00 am" && $stime < "11:00 am") || ($start)))
        {
      $th1011 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;

        }

        if (strpos($row["cdays"], 'Fr') !== FALSE && (($stime >= "10:00 am" && $stime < "11:00 am") || ($start)))
        {
    $fri1011 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;

        }

         if (strpos($row["cdays"], 'Sa') !== FALSE && (($stime >= "10:00 am" && $stime < "11:00 am") || ($start)))
        {
  $sa1011 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;
        }
        
        
        if($start)
         {
              $lap++; if($lap + 1 >= $stop)$start = false;
         }
        
      
        if (strpos($row["cdays"], 'Mo') !== FALSE && (($stime >= "11:00 am" && $stime < "12:00 pm") || ($start)))
        {
       $mon1112 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true; 

        }
        
        if (strpos($row["cdays"], 'Tu') !== FALSE && (($stime >= "11:00 am" && $stime < "12:00 pm") || ($start)))
        {
     $tue1112 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;

        }
          
        if (strpos($row["cdays"], 'We') !== FALSE && (($stime >= "11:00 am" && $stime < "12:00 pm") || ($start)))
        {
     $wed1112 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;

        }
          
        if (strpos($row["cdays"], 'Th') !== FALSE && (($stime >= "11:00 am" && $stime < "12:00 pm") || ($start)))
        {
       $th1112 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;

        }
   
        if (strpos($row["cdays"], 'Fr') !== FALSE && (($stime >= "11:00 am" && $stime < "12:00 pm") || ($start)))
        {
       $fri1112 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;

        }
       
         if (strpos($row["cdays"], 'Sa') !== FALSE && (($stime >= "11:00 am" && $stime < "12:00 pm") || ($start)))
        {
       $sa1112 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;
        }
    
    
    if($start)
         {
              $lap++; if($lap + 1 >= $stop)$start = false;
         
         }
    
    
    
        if (strpos($row["cdays"], 'Mo') !== FALSE && (($stime >= "12:00 pm" && $stime < "1:00 pm") || ($start) ))
        {
      $mon121 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true; 

        }
  
        if (strpos($row["cdays"], 'Tu') !== FALSE && (($stime >= "12:00 pm" && $stime < "1:00 pm") || ($start) ))
        {
   $tue121 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;

        }
        
        if (strpos($row["cdays"], 'We') !== FALSE && (($stime >= "12:00 pm" && $stime < "1:00 pm") || ($start) ))
        {
        $wed121 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;

        }
         
        if (strpos($row["cdays"], 'Th') !== FALSE && (($stime >= "12:00 pm" && $stime < "1:00 pm") || ($start) ))
        {
        $th121 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;

        }
      
        if (strpos($row["cdays"], 'Fr') !== FALSE && (($stime >= "12:00 pm" && $stime < "1:00 pm") || ($start) ))
        {
        $fri121 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;

        }
       
         if (strpos($row["cdays"], 'Sa') !== FALSE && (($stime >= "12:00 pm" && $stime < "1:00 pm") || ($start) ))
        {
        $sa121 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;
        }
      
      
      if($start)
         {
              $lap++; if($lap + 1 >= $stop)$start = false;
            
         }
      
      
      
        if (strpos($row["cdays"], 'Mo') !== FALSE && (($stime >= "1:00 pm" && $stime < "2:00 pm") || ($start)))
        {
     $mon12 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true; 

        }
       
        if (strpos($row["cdays"], 'Tu') !== FALSE && (($stime >= "1:00 pm" && $stime < "2:00 pm") || ($start)))
        {
    $tue12 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;

        }
        
        if (strpos($row["cdays"], 'We') !== FALSE && (($stime >= "1:00 pm" && $stime < "2:00 pm") || ($start)))
        {
      $wed12 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;

        }
         
        if (strpos($row["cdays"], 'Th') !== FALSE && (($stime >= "1:00 pm" && $stime < "2:00 pm") || ($start)))
        {
       $th12 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;

        }
        
        if (strpos($row["cdays"], 'Fr') !== FALSE && (($stime >= "1:00 pm" && $stime < "2:00 pm") || ($start)))
        {
  $fri12 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;

        }
        
         if (strpos($row["cdays"], 'Sa') !== FALSE && (($stime >= "1:00 pm" && $stime < "2:00 pm") || ($start)))
        {
   $sa12 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;
        }
        
        
        if($start)
         {
              $lap++; if($lap + 1 >= $stop)$start = false;
             
         }
        
       
        if (strpos($row["cdays"], 'Mo') !== FALSE && (($stime >= "2:00 pm" && $stime < "3:00 pm") || ($start)))
        {
$mon23 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true; 

        }
     
        if (strpos($row["cdays"], 'Tu') !== FALSE && (($stime >= "2:00 pm" && $stime < "3:00 pm") || ($start)))
        {
$tue23 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;

        }
       
        if (strpos($row["cdays"], 'We') !== FALSE && (($stime >= "2:00 pm" && $stime < "3:00 pm") || ($start)))
        {
$wed23 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;

        }
          
        if (strpos($row["cdays"], 'Th') !== FALSE && (($stime >= "2:00 pm" && $stime < "3:00 pm") || ($start)))
        {
      $th23 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;
 
        }
      
        if (strpos($row["cdays"], 'Fr') !== FALSE && (($stime >= "2:00 pm" && $stime < "3:00 pm") || ($start)))
        {
   $fri23 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;

        }
      
         if (strpos($row["cdays"], 'Sa') !== FALSE && (($stime >= "2:00 pm" && $stime < "3:00 pm") || ($start)))
        {
     $sa23 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;
        }
     
     if($start)
         {
              $lap++; if($lap + 1 >= $stop)$start = false;
         }
     
     
        if (strpos($row["cdays"], 'Mo') !== FALSE && (($stime >= "3:00 pm" && $stime < "4:00 pm") || ($start)))
        {
     $mon34 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true; 

        }
       
        if (strpos($row["cdays"], 'Tu') !== FALSE && (($stime >= "3:00 pm" && $stime < "4:00 pm") || ($start)))
        {
      $tue34 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;

        }
        
        if (strpos($row["cdays"], 'We') !== FALSE && (($stime >= "3:00 pm" && $stime < "4:00 pm") || ($start)))
        {
      $wed34 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;

        }
         
        if (strpos($row["cdays"], 'Th') !== FALSE && (($stime >= "3:00 pm" && $stime < "4:00 pm") || ($start)))
        {
       $th34 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;

        }
      
        if (strpos($row["cdays"], 'Fr') !== FALSE && (($stime >= "3:00 pm" && $stime < "4:00 pm") || ($start)))
        {
    $fri34 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;

        }
     
         if (strpos($row["cdays"], 'Sa') !== FALSE && (($stime >= "3:00 pm" && $stime < "4:00 pm") || ($start)))
        {
   $sa34 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;
        }
   
   
   if($start)
         {
              $lap++; if($lap + 1 >= $stop)$start = false;
         }
   
   
        if (strpos($row["cdays"], 'Mo') !== FALSE && (($stime >= "4:00 pm" && $stime < "5:00 pm") || ($start)))
        {
      $mon45 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true; 

        }
       
        if (strpos($row["cdays"], 'Tu') !== FALSE && (($stime >= "4:00 pm" && $stime < "5:00 pm") || ($start)))
        {
      $tue45 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;

        }
       
        if (strpos($row["cdays"], 'We') !== FALSE && (($stime >= "4:00 pm" && $stime < "5:00 pm") || ($start)))
        {
        $wed45 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;

        }
       
        if (strpos($row["cdays"], 'Th') !== FALSE && (($stime >= "4:00 pm" && $stime < "5:00 pm") || ($start)))
        {
        $th45 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;

        }
        
        if (strpos($row["cdays"], 'Fr') !== FALSE && (($stime >= "4:00 pm" && $stime < "5:00 pm") || ($start)))
        {
      $fri45 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;

        }
      
         if (strpos($row["cdays"], 'Sa') !== FALSE && (($stime >= "4:00 pm" && $stime < "5:00 pm") || ($start)))
        {
     $sa45 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;
        }
    
    if($start)
         {
              $lap++; if($lap + 1 >= $stop)$start = false;
         }
    
    
    
 
        if (strpos($row["cdays"], 'Mo') !== FALSE && (($stime >= "5:00 pm" && $stime < "6:00 pm") || ($start) ))
        {
     $mon56 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true; 

        }
       
        if (strpos($row["cdays"], 'Tu') !== FALSE && (($stime >= "5:00 pm" && $stime < "6:00 pm") || ($start) ))
        {
    $tue56 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;
      
        }
        
        if (strpos($row["cdays"], 'We') !== FALSE && (($stime >= "5:00 pm" && $stime < "6:00 pm") || ($start) ))
        {
        $wed56 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;

        }
         
        if (strpos($row["cdays"], 'Th') !== FALSE && (($stime >= "5:00 pm" && $stime < "6:00 pm") || ($start) ))
        {
       $th56 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;

        }
 
        if (strpos($row["cdays"], 'Fr') !== FALSE && (($stime >= "5:00 pm" && $stime < "6:00 pm") || ($start) ))
        {
        $fri56 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;

        }
   
         if (strpos($row["cdays"], 'Sa') !== FALSE && (($stime >= "5:00 pm" && $stime < "6:00 pm") || ($start) ))
        {
          $sa56 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;
        }
 
 
 
         if($start)
         {
              $lap++; if($lap + 1 >= $stop)$start = false;
         }
 
 
   
        if (strpos($row["cdays"], 'Mo') !== FALSE && (($stime >= "6:00 pm" && $stime < "7:00 pm") || ($start)))
        {
         $mon67 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true; 

        }
       
        if (strpos($row["cdays"], 'Tu') !== FALSE && (($stime >= "6:00 pm" && $stime < "7:00 pm") || ($start)))
        {
    $tue67 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;

        }
       
        if (strpos($row["cdays"], 'We') !== FALSE && (($stime >= "6:00 pm" && $stime < "7:00 pm") || ($start)))
        {
       $wed67 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;

        }
       
        if (strpos($row["cdays"], 'Th') !== FALSE && (($stime >= "6:00 pm" && $stime < "7:00 pm") || ($start)))
        {
        $th67 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;

        }
      
        if (strpos($row["cdays"], 'Fr') !== FALSE && (($stime >= "6:00 pm" && $stime < "7:00 pm") || ($start)))
        {
    $fri67 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;

        }
        
         if (strpos($row["cdays"], 'Sa') !== FALSE && (($stime >= "6:00 pm" && $stime < "7:00 pm") || ($start)))
        {
 $sa67 .= "<a href='".$link."/"."?"."key=".$row["CID"]."'>".$row["cname"]."</a>"."<br>";    $start = true;
        }
       
          }
        }
 

?>
