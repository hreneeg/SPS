<?php


//----------------------------------------------------------------------------------
// CONNECT TO THE DATABASE
//----------------------------------------------------------------------------------
    $servername = getenv('IP');
    $username = getenv('C9_USER');
    $password = "";
    $database = "c9";
    $dbport = 3306;
    
   $db = new mysqli($servername, $username, $password, $database, $dbport);
   $cdb = mysqli_select_db($db,$database);
   
 //-------------------------------------------------------------------------------  
 $fErr = $lErr = $uErr = $pErr = $emailErr = $eErr = "";
$userex = $emailex = $success = "";


$user = "sem010";
    $pass = "pass1";
    
    $cday = array();
    $cid = $_POST["cid"];
    $cname = $_POST["cname"];
    $ctime = $_POST["ctime"];
    $cdes = $_POST["cdes"];
    $credit = $_POST["credit"];
    
    $pfname = $_POST["pfname"];
    $plname = $_POST["plname"];
    $pemail = $_POST["pemail"];
    
    $mon = $_POST["M"];
    $tue = $_POST["T"];
    $wed = $_POST["W"];
    $thu = $_POST["TU"];
    $fri = $_POST["F"];
    $sat = $_POST["S"];


 $days = implode("",$cday);











        $getstudentid = mysqli_query($db,"Select id from student where username = '$user' and password = '$pass' ");
                    
                            if(mysqli_num_rows($edit_query) > 0){
                              while($row = mysqli_fetch_assoc($edit_query)){
                                 $sid = $row["id"];
                
                              }
                            }
                  
                                     // Creating a Unique ID for Prof..  
                                     //-----------------------------------------------------
                                      $q = mysqli_query($db,"SELECT max(id) FROM professor");
                                       
                                       if(mysqli_num_rows($q) > 0)
                                       {
                                          while($row = mysqli_fetch_assoc($q)){
                                              $pid =  $row["max(id)"];
                                          }
                                       }
                                       
                                       
                                       if($pid == NULL)
                                       {
                                           $pid = 1;
                                       }
                                       else
                                       {
                                           $pid++; 
                                       }
                                       
                    
                    $addprof = "INSERT INTO professor(id,firstname,email) 
                                VALUES ($pid,'$pfname','$plname',$pemail')"; 
                                
                    $data = mysqli_query($db,$addprof) or die(mysql_error());
                    
                
                    $addcourse = " INSERT INTO course (CID,cname,ctime,cdays,cdes,credit,PID)
                                VALUES ($cid, '$cname', '$ctime','$days','$cdes', $credit,$pid)";
                                
                    $courseadded = mysqli_query($db,$addcourse) or die(mysql_error());
                
                                        // Creating a Unique ID for id list 
                                     //-----------------------------------------------------
                                      $ql = mysqli_query($db,"SELECT max(id) FROM professor");
                                       
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
                    $linkids = " INSERT INTO linkid (id,sid,cid,pid) 
                                 VALUES ($lid,$sid,$cid,$pid)";
                    $idadded =   mysqli_query($db,$linkids) or die(mysql_error());             
    $added = "Course Added!.";









?>