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
//---------------------------------------------------------------
session_start();
$rtoday= date("Y-m-d") ;
$query = mysqli_query($db,"SELECT homework.id, rdate, date,time,hwdesc,firstname,lastname,email 
FROM homework, student WHERE DATE_SUB(date, INTERVAL 3 DAY) AND date >= CURDATE()
AND homework.sid = student.id");
		$num_rows = mysqli_num_rows($query);
         if(mysqli_num_rows($query) > 0){
              while($row = mysqli_fetch_assoc($query)){
                  $rdate = $row["rdate"];
                  $desc = $row["hwdesc"] . "<br>";
                  $date = $row["date"]. "<br>";
                  $name =  $row["firstname"] . " ". $row["lastname"];
                  $email = $row["email"];
                  $time  = DATE("g:i a", STRTOTIME($row["time"]));
                  $reminder = "Reminder";
                  $id = $row["id"];
                  
                  echo $rdate ."==".$rtoday;
                  
                  if($rdate != $rtoday){
                  
           $url = 'http://www.csce.uark.edu/~sem010/reminder.php';
           $rdateupdate = "update homework set rdate ='$rtoday' WHERE id = $id";
          mysqli_query($db,$rdateupdate);
          
                $data = array(
                    'desc' => $desc,
                    'date' => $date,
                    'name'=> $name, 
                    'email'=> $email,
                    'reminder'=> $reminder,
                    'time'=> $time
                );
                
                // use key 'http' even if you send the request to https://...
                $options = array(
                    'http' => array(
                        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                        'method'  => 'POST',
                        'content' => http_build_query($data),
                    ),
                );
                $context  = stream_context_create($options);
                $result = file_get_contents($url, false, $context);  
                  
                  echo $result;
                  } 
              }
         }
         
         
         
      
?>