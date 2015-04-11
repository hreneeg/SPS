<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>

<?php
// remove all session variables
session_unset(); 

// destroy the session 
session_destroy(); 

// redirect to main_login.php
header('Location: main_login.php');
?>

Loggout Failed...

</body>
</html>