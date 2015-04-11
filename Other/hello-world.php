<!DOCTYPE html>
<html>
<head>

<style>
    body {
        font-family: "Trebuchet MS", Verdana, sans-serif;
        font-size: 16px;
        background-color: black; 
        color: white;
        padding: 3px;
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
        font-size: 160%;
        text-align: center;
    }
    #SignUp{
        font: arial;
        text-align: center;
    }
</style>
</head>

<body>
    <h1> Course Management System</h1>
        <table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
        <tr>
        <form name="login" method="post" action="checklogin.php">
        <td>
        <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
        <tr>    
        <td colspan="3"><strong>Member Login </strong></td>
        </tr>
        <tr>
        <td width="78">Username</td>
        <td width="6">:</td>
        <td width="294"><input name="username" type="text" id="username"></td>
        </tr>
        <tr>
        <td>Password</td>
        <td>:</td>
        <td><input name="password" type="password" id="password"></td>
        </tr>
        <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><input type="submit" name="Submit" value="Login"></td>
        </tr>
        </table>
        </td>
        </form>
        </tr>
        </table>
        <p id = "SignUp"> Not already a Member? Click <button id ="Register" type="Register">here</button> to sign up!</p>
<?php
    session_start(); // Starting Session
    $error=''; // Variable To Store Error Message
    if (isset($_POST['submit'])) {
        if (empty($_POST['username']) || empty($_POST['password'])) {
            $error = "Username or Password is invalid";
        }else{
            // Define $username and $password
            $username=$_POST['username'];
            $password=$_POST['password'];
        }
?>
</body>
</html>