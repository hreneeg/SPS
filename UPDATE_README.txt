//-----------------------
// MARCH 07, 2015:
//-----------------------


Robert:
-Database is set up and linked to web project thanks to Syndall.
-New Users can be added. ~register.php~
-Website skeleton constructed.
-Loggin works and redirects to userAccountHome.php
-Loggout added.


Syndall:
 To insert to the Database 

                    First, Creating a Unique ID. (Most of the tables require and ID.)
                    The ID's goes from 1 and increases after each record is added.
                    
                     //-----------------------------------------------------
                      $q = mysqli_query($db,"SELECT max(id) FROM student"); // Selects Max ID in the table 
                       
                       if(mysqli_num_rows($q) > 0)
                       {
                          while($row = mysqli_fetch_assoc($q)){
                              $id =  $row["max(id)"];
                          }
                       }
                       
                       
                       if($id == NULL) // If no record is yet added.
                       {
                           $id = 1;  // start ID at 1.
                       }
                       else
                       {
                           $id++;  // increase ID # by 1. 
                       }
                    //------------------------------------------------------------------    
                    //  INSERTING VALUES INTO DATABASE.
                    //--------------------------------------------------------------------
                     
                        $query = "INSERT INTO student (id,firstname,lastname,username,password,email) 
                        VALUES ($id,'$fname','$lname','$username','$password','$email')"; 
                        $data = mysqli_query($db,$query) or die(mysql_error());
                        if($data) // If insertion was successful .
                        {
                            $success ="Congratulations, You are now registered!"; 
                            
                        } 
                        
To Take information form the Database look in userAccountHome.php
                        

//-----------------------
// MARCH 08, 2015:
//-----------------------

ROBERT:
- For reference, to comment in html, you use <!-- comment here -->. I know this helped me.


//----------------
//  MARCH 10, 2015
//------------------------
Syndall:
- Course page displays User course information
- Contact page displays User contacts, which include course professors and other contacts 
the user added.

//------------------
// MARCH 11, 2015
//------------------
Syndall:
-Option page now stores font and styles in the database, which are now displayed accross all pages. 
Robert created the differnent page styles and fonts.
//----------------
// MARCH 23, 2015
//-------------------
Syndall
-File Upload, Course Page and homework reminders are functional.
- Email Professor feature on Course Page.
//------------------
// MARCH 23, 2015
//------------------
ROBERT:
- I have looked up a calender tutorial, and I think because of it's simplicity and ease of access,
  this will be a good canadate for our project. The link to the tutorial is:
  https://www.youtube.com/watch?v=l76uglZBjpk&list=PLC3FA336653950084
  
//-----------------
//March 23/24 2015
//-----------------
Heather:
That was a great reference, Robert. I had no idea making one from scratch could be that simple!

-I went through the tutorial, troubleshooting because there's no button. I fixed a few
     small things, but it mostly looked exactly like he had it I wasn't 100% if the connect.php was right because it differed
     from the tutorial some, so I added what he had and commented it out just so you could check (I imagine you knew what you
     were doing when you did that though which makes that pointless. But I thought I'd add it incase.)
-I updated a button in show_calendar.php on 117 due to no buttons showing up on the calendar,
    as others were saying in the YT comments. I couldn't quite figure it out.
-added "Add event" button on the top left of the calendar page. It toggles a form for "date" and "details.
     I'm working on getting that info entered into the database but I'm trying to find the right way to integrate that.
-I created a mail.php file which could be overkill. Not sure. I basically created us all a new gmail so we could use 
     swiftmailer (which I also imported into the "other" folder) The credentials are:
     crsmgmtsystem@gmail.com
     passwprd : pmwtiguoejtuzzsd
     I could be overcomplicating things again with the e-mail, but I got the idea from stackOverflow since we can't use
     the mail() function. Here is a reference I was following: http://stackoverflow.com/questions/18101769/php-mailer-smtp-gmail-authentication
     
//-----------------
//March 25 2015
//-----------------
Aaron:
-Basic administrator functionality added.  Admin page visible only to admin accounts, only admin accounts can give other 
accounts admin status through the restricted page.  The value is stored in the final column of the student table.
     
     
//------------------
//March 25 2015
//--------------------
Syndall:
-Calendar events know display uniquely for each user.
-Course schedule is now on the home page.
- Weekly tasks added to the homepage.

     
//------------------
//March 26-27 2015
//--------------------
Heather
I know this wasn't one of the requirements, but I thought it could make our site better when I was looking for things to add:
-I started working on a forum using a Youtube tutorial. The files are currently mixed in with SEProject folder. They are:
viewpost.php, forum_index.php, forum_connect.php, forum.php (They aren't beautiful)
-It is connecting to the database, but not for our course members yet. 
-Functionality of adding posts/replies is working. I have a couple of issues with getting the right post in, but other than that, it's working
-I still need to connect it to our members.

//-------------------
// APRIL 11 2015
//---------------------
Syndall
Homework Reminder are implemented. Sends an email for homework assignments due within 3 days, one time per day.