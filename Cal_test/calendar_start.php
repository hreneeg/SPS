<?php

	include ("connect.php");
   session_start();
  if(isset($_SESSION["username"]) && isset($_SESSION["password"])){
     
     $user = $_SESSION["username"];
    $pass = $_SESSION["password"];
    echo $user. " ". $pass;
     $student = mysqli_query($c9db,"Select * from student where username = '$user' and password = '$pass' ")
                                           or $test5 = "SID FAIL";
                    
                            if(mysqli_num_rows($student) > 0){
                              while($row = mysqli_fetch_assoc($student)){
                                  
                                 $sid = $row["ID"];
                
                              }
                            }
    
 }




$showmonth = $_POST['showmonth'];
$showyear = $_POST['showyear'];
$showmonth = preg_replace('#[^0-9]#i', '', $showmonth);	//Filter only accept numbers
$showyear = preg_replace('#[^0-9]#i', '', $showyear);	//Filter only accept numbers

$day_count = cal_days_in_month(CAL_GREGORIAN, $showmonth, $showyear);
$pre_days = date('w', mktime(0, 0, 0, $showmonth, 1, $showyear));
$post_days = (6 - (date('w', mktime(0, 0, 0, $showmonth, $day_count, $showyear))));

echo '<div id="calendar_wrap">';
	echo '<div class="title_bar">';
		echo '<div class="previous_month"><input name="myBtn" type="submit" value="previous Month" onClick="javascript:last_month();"></div>';
		echo '<div class="show_month">' . $showmonth . '/' . $showyear . '</div>';
		echo '<div class="next_month"><input name="myBtn" type="submit" value="Next Month" onClick="javascript:next_month();"></div>';
	echo '</div>';

	echo '<div class="week_days">';
		echo '<div class="days_of_week">Sun</div>';
		echo '<div class="days_of_week">Mon</div>';
		echo '<div class="days_of_week">Tue</div>';
		echo '<div class="days_of_week">Wed</div>';
		echo '<div class="days_of_week">Thur</div>';
		echo '<div class="days_of_week">Fri</div>';
		echo '<div class="days_of_week">Sat</div>';
		echo '<div class="clear"></div>';
		echo '</div>';
	
	/* Previous Month Filler Days */
	if ($pre_days != 0) {
		for($i=1; $i<=$pre_days; $i++) {
			echo '<div class="non_cal_day"></div>';
		}
	}
	
	/* Current Month */
	//Connect to mysql
	for($i=1; $i<= $day_count; $i++) {
		//get events logic

	
		$date = $showyear. "-".$showmonth. "-".$i;
		$newDate = date("Y-m-d", strtotime($date));
		$query = mysqli_query($db,"SELECT * FROM events WHERE evdate = '$newDate' AND sid = 19" );
		
		$num_rows = mysqli_num_rows($query);
		if($num_rows > 0) {
			$event = "<input name='$newDate' type='submit' value='Details' id='$newDate' onClick='javascript:show_details(this);'>";
		}
		
		
		
		//end get events
		echo '<div class="cal_day">';
		echo '<div class="day_heading">' . $i . '</div>';
		//show events button
		if($num_rows != 0) { echo "<div class='openings'><br />" . $event . "</div>";}
		//end button
		echo '</div>';
	}
	
	/* Next Month Filler Days */
	if ($post_days != 0) {
		for($i=1; $i<=$post_days; $i++) {
			echo '<div class="non_cal_day"></div>';
		}
	}
	
echo '</div>';
?>
