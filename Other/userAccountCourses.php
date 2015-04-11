<?php
//---------------------------------------------
// CONNECT TO DB
//---------------------------------------

    $servername = getenv('IP');
    $username = getenv('C9_USER');
    $password = "";
    $database = "c9";
    $dbport = 3306;
    
   $db = new mysqli($servername, $username, $password, $database, $dbport);
   $cdb = mysqli_select_db($db,$database);
//--------------------------------------------------------------------------
 $cidERR = $cnameERR = $cdayErr= $ctimeErr = $cdesERR = $creditErr = $pfnameErr = $plnameErr = $pemailErr = "";
 $added=  "";
 
session_start();
 
 $test1 =$test2=$test3=$test4="";
 
 if(isset($_SESSION["username"]) && isset($_SESSION["password"]))
{
    
    
    $added =" Username and Password Test";
    
}
 
 
 if(isset($_POST["course"]))
 {
     $did = $_POST["del"];
     echo "HERE";
     echo $did;
     $del = mysqli_query($db,"DELETE FROM courses WHERE id = $did");
			header("location:userAccountCourses.php");
     
 }else echo "NO";
                  
 
 
 
 
 
 $m = $t = $w = $tu = $f = $s = "";
if(isset($_POST["course"]))
 {
echo "HERE";
    $user = $_SESSION["username"];
    $pass = $_SESSION["password"];
    
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
    
    if(!empty($_POST["M"]))
        array_push($cday,$mon);
    if(!empty($_POST["T"]))
        array_push($cday,$tue);
    if(!empty($_POST["W"]))
        array_push($cday,$wed);
    if(!empty($_POST["TU"]))
        array_push($cday,$thu);
    if(!empty($_POST["F"]))
        array_push($cday,$fri);
    if(!empty($_POST["S"]))
        array_push($cday,$sat);
        
    $days = implode("",$cday);
    
    $val = true;
    
        	    if(empty($_POST["cid"])){
        	        $cidERR = "Please enter a Course ID <br>";
        	        $val = false;
        	
        		}
        		if(empty($_POST["cname"])){
        	        
        	         $cnameERR = "Please enter a Course Name <br>";
        	        $val = false;
        	
        		}
        		if(empty($_POST["ctime"])){
        	        
        	         $ctimeErr = "Please enter a Course Time <br>";
        	        $val = false;
        	
        		}
        		if(empty($_POST["cdes"])){
        	        
        	         $cdesERR = "Please enter a Course Description <br>";
        	        $val = false;
        	
        		}
        		if(empty($_POST["credit"])){
        	         $creditErr = "Please enter  Course Credits <br>";
        	        $val = false;
        	        
        	
        		}
        		if(empty($cday)){
        	        
        	         $cdayErr = "Please enter  Course Meeting Days <br>";
        	        $val = false;
        	
        		}
        		if(empty($_POST["pfname"])){
        	         $pfnameErr = "Please enter the Professor's First Name <br>";
        	        $val = false;
        	        
        	
        		}
        		if(empty($_POST["plname"])){
        	        
        	         $plnameErr = "Please enter the Professor's Last Name <br>";
        	        $val = false;
        	
        		}
        		if(empty($_POST["pemail"])){
        	        
        	         $pemailErr = "Please enter the Professor Email <br>";
        	        $val = false;
        	
        		}
        		
            
              
                
    if($val){
          
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
                                
                    $data = mysqli_query($db,$addprof) or $test = "";
                    
                
                    $addcourse = " INSERT INTO course (cid,cname,ctime,cdays,cdes,credit,PID)
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
   }

    
     
 }









?>


<!DOCTYPE html>
<html>
<head>
<title>SPS: Courses</title>
<style>
    body {
        font-family: "Trebuchet MS", Verdana, sans-serif;
        font-size: 16px;
        background-color: #DADAFF; 
		    margin: 0px;
        color: black;
        padding: 3px;
    }
	#main {
		background-color: white;
		margin-left:22%;
		margin-right:22%;
	}
    table {
        padding: 5px;
        padding-left:  15px;
        padding-right: 15px;
        background-color:	#DADAFF ;
        border-radius: 0 0 5px 5px;
        color: black;
    }
    form{
    
        font-family: Georgia, serif;
        border-bottom: 3px solid #cc9900;
        font-size: 30px;
    }
    h1{
        font: arial;
        font-size: 180%;
        text-align: center;
    }

</style>
</head>
<link href="menu.css" rel="stylesheet" type="text/css" media="all"/>	
<body><div class="container">
    <nav>
      <ul>
        <li class="active"><a href="#">Dashboard</a></li>
        <li><a href="#">Home<span class="badge">4</span></a></li>
        <li><a href="#">Calendar<span class="badge green">8</span></a></li>
        <li><a href="#">Course<span class="badge yellow">15</span></a></li>
        <li><a href="#">Contact<span class="badge red">16</span></a></li>
        <li><a href="#">Options<span class="badge red">16</span></a></li>
        <li><a href="#">Logout</a></li>
      </ul>
    </nav>
  </div></center></p>
    
    
    

      
    
  
</body>
</html>
</html>