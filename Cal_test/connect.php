<?php
	$servername = getenv('IP');
    $username = getenv('C9_USER');
    $password = "";
    $database = "ecalendar";
    $dbport = 3306;

    //$conn = mysql_connect($servername, $username, $password) or die("could not connect");
   // mysql_select_db($database) or die("no databse");
   $db = new mysqli($servername, $username, $password, $database, $dbport) or die("No database");
   //$cdb = mysqli_select_db($db,$database) or die ("No database");	
   
   
   $servername = getenv('IP');
    $username = getenv('C9_USER');
    $password = "";
    $database = "c9";
    $dbport = 3306;

 
   $c9db = new mysqli($servername, $username, $password, $database, $dbport) or die("No database");
   
   
   
?>