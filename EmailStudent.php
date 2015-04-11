<!DOCTYPE html>
    <html>
      <div id=main>
       <p><center><font size=2><a href="https://seproject-hrguyll.c9.io/userAccountHome.php">Home</a> &nbsp;&nbsp;&nbsp; 
                                <a href="https://seproject-hrguyll.c9.io/userAccountCalendar.php">Calendar</a> &nbsp;&nbsp;&nbsp;  
                                <a href="https://seproject-hrguyll.c9.io/userAccountCourses.php">Courses</a> &nbsp;&nbsp;&nbsp;  
                                <a href="https://seproject-hrguyll.c9.io/userAccountContacts.php">Contacts</a> &nbsp;&nbsp;&nbsp; 
                                <a href="https://seproject-hrguyll.c9.io/userAccountOptions.php">Options</a> &nbsp;&nbsp;&nbsp;
                                <a href="https://seproject-hrguyll.c9.io/userAccountLogout.php">Logout</a>
        </font></center></p>
    <center>
    <table width=70% cellpadding=5 border=1 bgcolor=#990000>
    <tr><td align=center>
    <font size=+5 style=times color=white>SPS Email System</font><br>
    </td></tr></table>
    </center>
    <br>
    <br>
    <p align= center></p><br>	
    <br>	
    
    <form name="Emailform" method="post" action="send_Email.php">
     
    <table width="450px" align = "center">
    <tr><td valign="top"><label for="email">E-mail Address *</label></td>
    <td valign="top"><input  type="text" name="email" maxlength="30" size="30">
    <tr><td valign="top"><label for="subject">Subject *</label></td>
      <td valign="top"><input  type="text" name="subject" maxlength="30" size="30">
      <p><span class="error"> </span></p>
      </td>
      </tr>
      <tr><td valign="top"><label for="message">Message *</label></td><td valign="top">
      <textarea  name="message" maxlength="1000" cols="36" rows="6"></textarea>
      <p><span class="error"> </span></p>
      </td>
      </tr>
      <tr><td colspan="2" style="text-align:center"><input type="submit" name="emailform"value="Submit"> </a>
      <p><span> </span></p>
      </td>
      </tr>
    </table>
    </form>
    </html>
