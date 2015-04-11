
<?php

include ("connect.php");
  session_start();
	$dateErr=$descERR="";

$pageFont = $_SESSION["pagefont"];
$pageStyle = $_SESSION["pagestyle"];	
$textF="";
if($pageFont){
    if($pageFont=="font1"){$textF="Trebuchet MS";}
    if($pageFont=="font2"){$textF="Georgia";}
    if($pageFont=="font3"){$textF="Arial";}
    if($pageFont=="font4"){$textF="Courier";}
}else{
    $textF="Trebuchet MS";
}
	
if(isset($_SESSION["username"]) && isset($_SESSION["password"])){
     
     $user = $_SESSION["username"];
    $pass = $_SESSION["password"];
   
   $getstudentid = mysqli_query($c9db,"Select * from student where
           	 username = '$user' and password = '$pass' ");
                 
                            if(mysqli_num_rows($getstudentid) > 0){
                              while($row = mysqli_fetch_assoc($getstudentid)){
                                 $sid = $row["ID"];
                                
                              }
                            }
   

   
   
   
} else echo " Your are not Loged in - Session test";
			//------------------------------------
			// Insert Event in the Database
			//-----------------------------------
           
           
           if(isset($_POST["addE"])){
          
           	
              $stime = $_POST["stime"];
			  $etime = $_POST["etime"];
			  $scompare = DATE("g:i a", STRTOTIME($stime));
			  $ecompare = DATE("g:i a", STRTOTIME($etime));
	        $date = $_POST["date"];
           	$desc = $_POST["details"];
			  if(empty($_POST["evtype"])){
			  $evtype = $_POST["other"];
			  }
			  else
			  {
			  	$evtype = $_POST["evtype"];
			  }
			 
        		$strday =  strtotime($date);
        		$day = date("l",$strday);
        		$dayc = $day;
        		if($dayc == "Monday")
        		{
        			$dayc = "Mo";
        		}
        		if($dayc == "Tuesday")
        		{
        			$dayc = "Tu";
        		}
        		if($dayc == "Wednesday")
        		{
        			$dayc = "We";
        		}
        		if($dayc == "Thursday")
        		{
        			$dayc = "Th";
        		}
        		if($dayc == "Friday")
        		{
        			$dayc = "Fr";
        		}
        		if($dayc == "Saturday")
        		{
        			$dayc = "Sa";
        		}
        		 
			  
			  
           
           	$val = true;
           	$that = true;
           	if(empty($_POST["date"])){
           	
           	$dateErr = "Please Enter a Date";
           	$val = false;
           	$that = false;
           	}
           	
           	if(empty($_POST["details"])){
           	
           	$detErr = "Please Enter Detials about the Event";
           	$val = false;
           	$that = false;
           	}
           	if(empty($evtype)){
           	
           	$typErr = "Please select or enter an event type";
           	$val = false;
           	$that = false;
           	}
           	if(empty($_POST["stime"])){
        	        
        	       $stimeErr = "Please enter a Course Start Time <br>";
        	        $val = false;
        	        $that = false;
        	
        	}
        	
        	   if(empty($_POST["etime"]) && ($that) ){
        	 
	      $conflict = mysqli_query($c9db,"SELECT * FROM course, linkid WHERE linkid.sid = $sid 
                   AND linkid.cid = course.cid");
                   
        
                           if(mysqli_num_rows($conflict) > 0){
                              while($row = mysqli_fetch_assoc($conflict)){
                                   $sttime  = DATE("g:i a", STRTOTIME($row["stime"]));
                                   $entime  = DATE("g:i a", STRTOTIME($row["etime"]));
                         
                               
                                   if (strpos($row["cdays"], $dayc) !== FALSE && ($scompare >= $sttime && $scompare < $entime)) 
                                 {
                                     
                                     $contime .= "Your event conflicts with your course ". $row["cname"]. " on ".$row["cdays"].
		                                   " at ".$sttime. " to ".$entime. " you should reschedule this event". "<br>";
		                                   $val = false;
                          
                                 }
                                   
                              }
                           }
        	            
        	         $evconflict = mysqli_query($db,"SELECT * FROM  events WHERE sid = $sid ");  
        	          if(mysqli_num_rows($evconflict) > 0){
                              while($row = mysqli_fetch_assoc($evconflict)){
                
        					$strevday =  strtotime($row["evdate"]);
        					$evday = date("l",$strevday);
        					 
        					 

                   
                                   $sttime  = DATE("g:i a", STRTOTIME($row["stime"]));
                                   $entime  = DATE("g:i a", STRTOTIME($row["etime"]));
                 
                                   if($row["etime"] != NULL){
                                   if (strpos($evday, $day) !== FALSE && ($scompare >= $sttime && $scompare < $entime)) 
                                 {
                                     $contime .= "Your event conflicts with your  ".$row["evtype"]. " on ".$evday.
		                                   " at ".$sttime. " to ".$entime. " (".$row["evdate"].")"." you should reschedule this event". "<br>";
		                                   $val = false;
                          
                                 }
                                   }else if($scompare == $sttime && $row["evdate"] == $date){
                                   	
                                   $contime .= "You have two events scheduled on the same date at the same time. ". 
                                   $row["evtype"] . "  " . $row["description"] . " on ". $day ."  at ".$sttime."   ". $row["evdate"]."<br>";	
                                   $val = false;
                                   }
                              }
                           }
                           
        	
        	}else if(!empty($_POST["etime"]) && ($that))
        	{
        		
             $conflict2 = mysqli_query($c9db,"SELECT * FROM course, linkid WHERE linkid.sid = $sid 
            AND linkid.cid = course.cid");
               
                           if(mysqli_num_rows($conflict2) > 0){
                              while($row = mysqli_fetch_assoc($conflict2)){
                                   $sttime  = DATE("g:i a", STRTOTIME($row["stime"]));
                                   $entime  = DATE("g:i a", STRTOTIME($row["etime"]));
                                     
                                 
                            
                                   
                                 
                                if(strpos($row["cdays"], $dayc) !== FALSE && ($ecompare >= $sttime && $ecompare < $entime))
                                 {
                                   // echo "here";
		                                   $contime.= "There is a time conflict between your course ". $row["cname"]. " on ".$row["cdays"].
		                                   " at ".$sttime. " to ".$entime. "<br>" . "<hr>";
		                                   $val = false;
		                      }
                                   
                              }
                           }
        		
        		$evconflict2 = mysqli_query($db,"SELECT * FROM  events WHERE sid = $sid ");  
        	          if(mysqli_num_rows($evconflict2) > 0){
                              while($row = mysqli_fetch_assoc($evconflict2)){
                     
        					$strevday =  strtotime($row["evdate"]);
        					$evday = date("l",$strevday);
        				
                                   $sttime  = DATE("g:i a", STRTOTIME($row["stime"]));
                                   $entime  = DATE("g:i a", STRTOTIME($row["etime"]));
                 
                                 if($row["etime"] != NULL){
                                 if(strpos($evday, $day) !== FALSE  && ($ecompare >= $sttime && $ecompare < $entime))
                                 {
                                
		                                  $contime .= "You have a conflict between events ". $row["evtpe"]."   ".$row["description"]. " on ".$evday.
		                                   " at ".$sttime. " to ".$entime. " you should reschedule this event". "<br>";
		                                   $val = false;
		                                  
		                                
                                 }
                                   }else if($scompare == $sttime && $row["evdate"] ==$date){
                                   	
                                   $contime .= "You have two events scheduled on the same date at the same time. ". 
                                   $row["evtype"] . "  " . $row["description"] . " on ". $day ." at ".$sttime."   ". $row["evdate"]."<br>";	
                                 
                                   }
                              
                           }
        		
        		
        		
        		
        		
        	}
           	
          
           	
           	
           	
           	
        	}
           	
           	
           	if($vall)
           	{
           		
           		echo " Val";
           		
           		
           	//--------------------------------------	
           	// Makes a unqiue Id for each event.  
           	//----------------------------------------
           	
           	 $eid = mysqli_query($db,"SELECT max(id) FROM events"); 
           	 // Gets the Max or biggest id in the events table
                                     
                      if(mysqli_num_rows($eid) > 0)
                           {
                             while($row = mysqli_fetch_assoc($eid)){
                                 $eid =  $row["max(id)"];
                                   }
                           }
                                       
                       // If there is no id in the events table yet, it will return NULL
                       // so make the first id 1.
                       // Else if the is an id, it will add 1 to the max, or the biggest one.
                                       if($eid == NULL)
                                       {
                                           $eid = 1;
                                       }
                                       else
                                       {
                                           $eid++; 
                                       }
           	
           }
           
           //------------------------------------
           // Insert into tablename (each column name in the database, excatly as there are)
           // then the values.
           //----------------------------------
           if(!empty($_POST["etime"])){
           $addevent = mysqli_query($db, "INSERT INTO events (id,description,evdate,stime,etime,evtype,sid)
           VALUES ($eid, '$desc','$date','$stime','$etime','$evtype',$sid)");
           } 
           else
           {
               echo "Added";
           	$addevent = mysqli_query($db, "INSERT INTO events (id,description,evdate,stime,evtype,sid)
              VALUES ($eid, '$desc','$date','$stime','$evtype',$sid)");
           	
           }
           
           
         
           
           
           
           }


?>
  <p><span class="error"> <?php echo $detErr;?></span></p>
     <p><span class="error"> <?php echo $dateErr;?></span></p>
     <p><span class="error"> <?php echo $stimeErr;?></span></p> 
     <p><span class="error"> <?php echo $typErr;?></span></p>
 <p><span class="error"> <?php echo $contime;?></span></p>



	<form id = "Event" method = "post" action = "testcal.php">
			<fieldset>
				<legend>Add an Event</legend>
				<p><label for="date">Date:</label><br/><input type="date" name="date" class="textbox-size"/></p>
				<p><label for="stime">Start Time of Event:</label><br/><input type="time" name="stime" class="textbox-size"/></p>
				<p><label for="etime">Estimated End Time (Optional):</label><br/><input type="time" name="etime" class="textbox-size"/></p>
				<p><label for="CDays">Type of Event:</label>
		                        <p align="left">
		                        <input type="radio" name="evtype" value="Meeting" />Meeting<br/>
								<input type="radio" name="evtype" value="Travel" />Travel<br/>
								<input type="radio" name="evtype" value="Birthday" />Birthday<br/>
								</p>
				<p><label for="others">Other Event type:</label><br/><input type="text" name="other" class="textbox-size"/></p>				
				<p></p>
				<p><label for="details">Details</label><br /><textarea rows="2" cols="25" name="details" style='float: left;'></textarea></p>
			</p>
			
			<p align="left"><input type="submit" name="addE" style="height:22px; width:153px" value="Add" ></p>
			</fieldset>
		</form>