<?php
    session_start();
    require "forum_connect.php";
    $sql = "SELECT forum_id, forum_name FROM forum_tbl";
    if($query = $db->prepare($sql)){
        $query->bind_result($f_id, $f_name);
        $query->execute();
        $query->store_result();
        
    }else{
        echo $db->error;
    }
?>
<!DOCTYPE html>
<html>
<style type="text/css">
    body {
    background-color: #d0e4fe;
}
</style>
    <head>
        

        <p><center><font size=2><a href="userAccountHome.php">Home</a> &nbsp;&nbsp;&nbsp; 
                            <a href="userAccountCalendar.php">Calendar</a> &nbsp;&nbsp;&nbsp; 
                            <a href="userAccountCourses.php">Courses</a> &nbsp;&nbsp;&nbsp;  
                            <a href="userAccountContacts.php">Contacts</a> &nbsp;&nbsp;&nbsp; 
                            <a href="userAccountOptions.php">Options</a> &nbsp;&nbsp;&nbsp;
                            <br>
                            <br>
                                  <h1 class = "post"><font size = "7">Forum Topics</font></h1>
    </p></center>
    </head>
    <body>
        <br>
        <br>
        <br>
        <div id = "container">
            <table align = "center" width = "80%">
                <?php if($query->num_rows !== 0) :
                    while($row = $query->fetch()):
                ?>
            <tr><td><ul><li>
                    <a href = "forum.php?id=<?php echo $f_id?>"><?php  echo "<font size = '5'>". $f_name . "</font>";?> </a>
                    <?php endwhile; endif;
                    ?>
                   </li> </ul>
            </td></tr>
            </table>
        </div>
        
    </body>
</html>