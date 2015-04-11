<?php
$servername = getenv('IP');
    $username = getenv('C9_USER');
    $password = "";
    $database = "c9";
    $dbport = 3306;
    
   $db = new mysqli($servername, $username, $password, $database, $dbport);
   $cdb = mysqli_select_db($db,$database);
//-------------------------------------------
if(isset($_POST["course"]))
 {
   
    
    $cday = array();
    $cid = $_POST["cid"];
    $cname = $_POST["cname"];
    $stime = $_POST["stime"];
    $etime = $_POST["etime"];
    $cdes = $_POST["cdes"];
    $credit = $_POST["credit"];
    
    $pfname = $_POST["pfname"];
    $plname = $_POST["plname"];
    $pemail = $_POST["pemail"];
    
    $mon = $_POST["Mo"];
    $tue = $_POST["Tu"];
    $wed = $_POST["We"];
    $thu = $_POST["Th"];
    $fri = $_POST["Fr"];
    $sat = $_POST["Sa"];
    
    if(!empty($_POST["Mo"]))
        array_push($cday,$mon);
    if(!empty($_POST["Tu"]))
        array_push($cday,$tue);
    if(!empty($_POST["We"]))
        array_push($cday,$wed);
    if(!empty($_POST["Th"]))
        array_push($cday,$thu);
    if(!empty($_POST["Fr"]))
        array_push($cday,$fri);
    if(!empty($_POST["Sa"]))
        array_push($cday,$sat);
        
    $days = implode("",$cday);
    
    $val = true;
    
        	    if(empty($_POST["cid"])){
        	        $cidErr = "Please enter a Course ID <br>";
        	        $val = false;
        	
        		}
        		if(empty($_POST["cname"])){
        	        
        	         $cnameErr = "Please enter a Course Name <br>";
        	        $val = false;
        	
        		}
        		if(empty($_POST["stime"])){
        	        
        	         $ctimeErr = "Please enter a Course Start Time <br>";
        	        $val = false;
        	
        		}
        		if(empty($_POST["etime"])){
        	        
        	         $ctimeErr .= "Please enter a Course End Time <br>";
        	        $val = false;
        	
        		}
        		if(empty($_POST["cdes"])){
        	        
        	         $cdesErr = "Please enter a Course Description <br>";
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
        		if(!filter_var($_POST["pemail"], FILTER_VALIDATE_EMAIL)) {
                $pvemailErr = "Please enter a valid email. For your Professor <br>" ;   
               $val = false;
               
               }
        		$checkcid = mysqli_query($db,"Select * from course WHERE cid = $cid");
        		if(mysqli_num_rows($checkcid) > 0){
        		    
        		    $cxErr = "Course ID Already exist, The course was not Added.";
        		    $val = false;
        		    
        		    
        		}
        		
        
            
            
            
              
                
    if($val){
          
                    
                  
                  
  
                     $dontaddprof = false;  
                    $profexist = "select * FROM professor WHERE firstname = '$pfname'
                    AND lastname = '$plname'";
                    	if(mysqli_num_rows($profexist) > 0){
                    	    $dontaddprof = true;
                    	    while($row = mysqli_fetch_assoc($profexist))
                    	    {
                                        $pid = $row["ID"];     
                                             
                                             
                            }
                    	}
                    	
                    	
                    
                 if(!$dontaddprof){     
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
                                       
                     
                     
                                       
                    $addprof = "INSERT INTO professor (id,firstname,lastname,email) 
                                VALUES ($pid,'$pfname','$plname','$pemail')"; 
                    $profadd = mysqli_query($db,$addprof) or $test = "Add Professor Failed.";
                    
                

                                       
                 }
                
                
                
                
                
                    $addcourse = " INSERT INTO dircourse (cid,cname,stime,etime,cdays,cdes,credit,PID)
                                VALUES ($cid, '$cname', '$stime','$etime','$days','$cdes', $credit,$pid)";
                                
                    $courseadded = mysqli_query($db,$addcourse) or $test1 = "Adding Course Falied";
                            $added = "Course Added!.";
 
   }

    
 }





?>
<!DOCTYPE html>
<html>
<body>   

     <p><span class="error"> <?php echo $cidErr;?></span></p>
     <p><span class="error"> <?php echo $cnameErr;?></span></p>
     <p><span class="error"> <?php echo $ctimeErr;?></span></p> 
     <p><span class="error"> <?php echo $cdayErr;?></span></p>
     <p><span class="error"> <?php echo $creditErr;?></span></p> 	
      <p><span class="error"> <?php echo $pfnameErr;?></span></p>	
      <p><span class="error"> <?php echo $plnameErr;?></span></p>	
      <p><span class="error"> <?php echo $pemailErr;?></span></p>
      	<p><span class="error"> <?php echo $cdesErr;?></span></p>
        <p><span class="error"> <?php echo $cxErr;?></span></p>
        <p><span class="error"> <?php echo $pvemailErr;?></span></p>

                  <?php echo $added ?>
  






<form name="form1" method="post" action="addrecords.php">
	<fieldset>
		<legend>Add Course</legend>
		<p><label for="cid">CourseID:</label><br /><input type="text" name="cid" class="textbox-size"/></p>
		<p><label for="cname">Course Name:</label><br /><input type="text" name="cname" class="textbox-size"/></p>
		<p><label for="stime">Course Start Time:</label><br /><input type="time" name="stime" class="textbox-size"/></p>
		<p><label for="etime">Course End Time:</label><br /><input type="time" name="etime" class="textbox-size"/></p>
		<p><label for="CDays">Course Days:</label>
		                        <p align="left">
		                        <input type="checkbox" name="Mo" value="Mo" />Mon<br/>
								<input type="checkbox" name="Tu" value="Tu" />Tue<br/>
								<input type="checkbox" name="We" value="We" />Wed<br/>
								<input type="checkbox" name="Th" value="Th" />Thu<br/>
								<input type="checkbox" name="Fr" value="Fr" />Fri<br/>
								<input type="checkbox" name="Sa" value="Sa" />Sat<br/>
								</p>
		</p>
		<p><label for="credit">Course Credits:</label><br /><input type="text" name="credit" class="textbox-size"/></p>
		<p><label for="pfname">Professor First Name:</label><br /><input type="text" name="pfname" class="textbox-size"/></p>
		<p><label for="plname">Professor Last Name:</label><br /><input type="text" name="plname" class="textbox-size"/></p>
		<p><label for="pemail">Professor Email:</label><br /><input type="text" name="pemail" class="textbox-size"/></p>
		<p><label for="cdes">Course Description:</label><br /><textarea rows="4" cols="35" name="cdes" style='float: left;'></textarea></p>
		<p align="left"><input type="submit" name="course" style="height:22px; width:153px" value="Add Course"></p>
	</fieldset>
	
</form>    
    
    
    
</body>
</html>   