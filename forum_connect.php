<?php
    $servername = getenv('IP');
    $username = getenv('C9_USER');
    $password = "";
    $database = "members_tbl";
    $dbport = 3306;
    $db = new mysqli($servername, $username, $password, $database, $dbport) or die("ERROR: with connection");
    $servername = getenv('IP');
    $username = getenv('C9_USER');
    $password = "";
    $database = "c9";
    $dbport = 3306;
    $c9db = new mysqli($servername, $username, $password, $database, $dbport) or die("No database");
?>