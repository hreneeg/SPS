<!DOCTYPE HTML>
<html>
<head>
<style>
    head{
        color: black;
        text-align: right;
        font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;
        font-size: 180%;
    }
    #Welcome{
        font-size: 200%;
        font-weight: bold;
        font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;
    }
    body {
        font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;
        font-weight: bold;
    }
</style>
<align="right"><a href="index.php">Update Profile</a>
<align="right"><a href="index.php">Logout</a>
</head>
<body>
    <div id = "Welcome"> Your Profile Information </div>
    <table width="398" border="0" align="left" cellpadding="0">
        <tr><td></td></tr><tr></tr><tr>
        <td width="129" rowspan="5"><img src="<?php echo $picture ?>" width="129" height="129" alt="no image found"/></td>
        <tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
        <td width="82" valign="top"><div align="left">FirstName:</div></td>
        <td width="165" valign="top"><?php echo $fname ?></td>
        </tr><tr></tr><tr>
        <td valign="top"><div align="left">LastName:</div></td>
        <td valign="top"><?php echo $lname ?></td>
        </tr><tr></tr><tr>
        <td valign="top"><div align="left">Gender:</div></td>
        <td valign="top"><?php echo $gender ?></td>
        </tr><tr></tr><tr>
        <td valign="top"><div align="left">E-mail:</div></td>
        <td valign="top"><?php echo $email ?></td>
        </tr><tr></tr></tr><tr>
        <td valign="top"><div align="left">Classes:</div></td>
        <td valign="top"><?php echo $classes ?></td>
        </tr>
    </table>
    <p align="center"><a href="index.php"></a></p>
</body> 
</html>

