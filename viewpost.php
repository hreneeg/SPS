<?php
    session_start();
    include("forum_connect.php");
    session_start();
    if(isset($_POST['textbox'])){
        $title = 'reply';
        $message = $_POST['textbox'];
        $id = $_GET['id'];
        $author = 'testauthor';
        $op = mysql_query($db, "SELECT op_id WHERE post_id = $id");
        $forum = mysqli_query($db, "SELECT forum_name WHERE post_id = $id");
        $forum = mysqli_query($db, "SELECT forum_name WHERE post_id = $id FROM forum_post");
        echo "forum: ". $forum;
        $fid = '1';
        $c = mysqli_query($db,"SELECT max(post_id) FROM forum_post");
            if(mysqli_num_rows($c) > 0) {
                while($row = mysqli_fetch_assoc($c)){
                      $post_id =  $row["max(post_id)"];
             }
        }
        if($post_id == NULL){
             $post_id = 1;                                  
        }
        else{
            $post_id++;   
        }
        echo "post id : " . $post_id ."<br>";
        $addpost = "INSERT INTO forum_post(post_id, post_title, post_author, post_body, post_type, op_id, forum_name, forum_id)
                                VALUES ('$post_id', '$title', 'heather', '$message', 'r', '$id', '$forum', '$fid')";
         if (mysqli_query($db, $addpost)) {
             $last_id = mysqli_insert_id($db);
             echo "New record created successfully. Last inserted ID is: " . $last_id;
        } else {
             echo "Error: " . $addpost. "<br>" . mysqli_error($db);
        }
} else {

}
    //check if user is logged 
    if(isset($_SESSION['logged-in']) && isset($_SESSION['username'])){
        $login = true;
    }else{
        $login = false;
    }

    //check if post_id and forum_id is set and are numeric
    if(isset($_GET['pid']) && is_numeric($_GET['pid']) && isset($_GET['id']) && is_numeric($_GET['id'])){
        $pid = $_GET['pid'];
         $id = $_GET['id'];
         
    }else{
        echo "Error Retrieving Post ID";
    }
    $postCheck = $db->query("SELECT * FROM forum_post WHERE post_id='$pid' AND forum_id='$id' AND post_type='o'")->num_rows;
    //grab original post to be displayed
    if($postCheck === 0){
        die("Error: Sorry, no such forum post found!");
    }
    $sql = "SELECT post_title, post_body, post_author FROM forum_post WHERE post_id=? AND forum_id=? AND post_type='o'";
    if($topicPost=$db->prepare($sql)){
        $topicPost->bind_param('ss', $pid, $id);
        $topicPost->bind_result($post_title, $post_body, $post_author);
        $topicPost->execute();
        $topicPost->store_result();
    }else{
        echo "Error: ". $db->error;
        exit();
    }
    //display the topic post
    $row = $topicPost->fetch();
?>

<!DOCTYPE html>
<html>
    <style type="text/css">
    body {
    background-color: white;
    }
    #topic_post{
        border: 5px solid black;
        width: 50%;
        background-color:  #d0e4fe;
    }
    #replies{
        border: 4px solid black;
        width: 50%;
        background-color: #d0e4fe;
       
    }
    #divide{
    
       border: 4px solid black;
       background-color: black;
    }
    footer{
        color: black;
    }
    </style>
    <head>
      <a href = "forum.php?id=<?php echo $id ?>">Back to Forum </a>
    </head>
    <p><center><font size=2><a href="userAccountHome.php">Home</a> &nbsp;&nbsp;&nbsp; 
                            <a href="userAccountCalendar.php">Calendar</a> &nbsp;&nbsp;&nbsp; 
                            <a href="userAccountCourses.php">Courses</a> &nbsp;&nbsp;&nbsp;  
                            <a href="userAccountContacts.php">Contacts</a> &nbsp;&nbsp;&nbsp; 
                            <a href="userAccountOptions.php">Options</a> &nbsp;&nbsp;&nbsp;
    </p>
    <body>
        <br>
        <br>
        <br>
        <div id = "primary">
            
            <div id = "topic_post" class="post">
                <header>
                    <h1 > <?php echo $post_title ?></h1>
                </header>
                <article> 
                    <?php echo $post_body ?>
                </article>
                <footer>
                    <?php echo "-<b>".$post_author."</b>"?>
                </footer>
                <br> 
                <br>
            </div>
            <br>
            <br>
            <br>
            <h2 class = "post"> Replies:</h2>
            <div id = "replies"  align= "center">
                <?php
                $reply = 'r';
                //display the reply posts
                $sql2 = "SELECT post_title, post_author, post_body FROM forum_post WHERE op_id = '$pid' AND post_type = '$reply'";
                if($replyPost=$db->prepare($sql2)){
                    $replyPost->bind_result($r_title, $r_author, $r_body);
                    $replyPost->execute();
                    $replyPost->store_result();
                }else{
                    echo "Error: ". $db->error;
                    exit();
                }
                if($replyPost->num_rows !== 0) :
                        echo "hello!";
                        while($rrow = $replyPost->fetch()):
                ?>
                <?php echo $r_body;?> </a> <br>
                <br>
                -<?php echo "<b>".$r_author. "</b>";?>
                <p id = "divide">   </p>
                <br>
                <br>
                <?php endwhile; endif;?>
                <br>
            </div>
        </div>
        <div id= "newReply"> 
        <br>
        <h3 class = "post">Enter a new reply:</h3>
        <form id = "reply" method = "post" action = "https://seproject-hrguyll.c9.io/viewpost.php?id=<&pid=4">">
        <textarea form = "reply" name = "textbox" rows = "10" cols = "93" style="border:dotted 5px black;"> </textarea><br>
        <input type = "submit">
        </form>
        </div>
    </body>
    
</html>