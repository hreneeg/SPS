<?php
session_start();
           include ("connect.php");
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
          
           
           
           
           
           
          /*  if(isset($_POST["del"])){
            	$did = $_POST["id"];
				$del = mysqli_query($db," DELETE FROM events WHERE id = $did");
			header("location:show_calendar.php");
			
				
            }
         
*/        
            $deets = $_POST['deets'];
            $newDate = date("Y-m-d", strtotime($deets));
    	    $events = "";
           
           
         
    
    	    
		    $query = mysqli_query($db,"SELECT * FROM events WHERE evdate = '$newDate' AND sid = $sid");
			$num_rows = mysqli_num_rows($query);
			if($num_rows == 0)
			{
				header("location:show_calendar.php");
			}
			
		    if($num_rows > 0){
				$events .= '<div id="eventsControl"><button onclick= "overlay()">Close</button><br /><br/><br/><b>' . $newDate . "</b><br/><br /> </div";
	            while($row = mysqli_fetch_assoc($query)){
	         	$desc = $row['description'];
	         	$getid = $row["id"];
	         	
	         	$form ="<form action='events.php' method ='post'>"  
    	       ."<input type='submit' name='edit' value='Edit'>" . 
	         	"<input type='hidden' name='id' value=' $getid'>"
	         	."<input type='submit' name='del' value='Delete'>"
	         	. "</form>";
	         	;
	         
	         	$events .= '<div id= "eventsBody">' . $desc . $form.'<br/> <hr><br/></div>';
	         	
        	 }
        	
        
 		} 
 		

echo $events;
echo $here;
           







?>