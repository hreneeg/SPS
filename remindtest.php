<?php
session_start();
if(isset($_POST["test"]))
{
    $_SESSION["rtest"] = 1;
    
}else $_SESSION["rtest"] = 2;



?>