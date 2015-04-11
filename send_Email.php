<?php
  if (!empty($_POST['email']) && !empty($_POST['subject']) && !empty($_POST['message']))  {
      $email = $_POST['email'];
      $subject = $_POST['subject'];
      $message = $_POST['message'];
      $headers = 'From: webmaster@example.com' . "\r\n";
      echo "Email sent to : " . $email . "<br>"; 
      echo "Subject: " . $subject . "<br>";
      echo "Message: " . $message . "<br>";
     /* if(mail($email, $subject, $message)){
        echo "Email Sent";
      } else {
       echo "Error sending mail";
      }
      */
  } else {
  /*  echo 
    " <form method = 'post' action = 'https://seproject-hrguyll.c9.io/EmailStudent.php' > </form>
         <input type='hidden' name='add' value=' $email'>
         <input type='hidden' name='sub' value='$subject'>
         <input type='hidden' name='sub' value='$message'>"
*/
    if(empty($_POST['subject'])){
      $_POST['sub'] = false;
    }else{
      $_POST['sub'] = true;
    }
    if(empty($_POST['message'])){
      $_POST['mess'] = false;
    }else{
      $_POST['mess'] = true;
    }
    $_POST['redirect'] = true;
      echo $_POST['redirect'];
     ;
  }
?>
