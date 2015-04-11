<?php
    require "forum_connect.php";
    session_start();
    if(isset($_POST['title']) && isset($_POST['textbox'])){
        $title = $_POST['title'];
        $message = $_POST['textbox'];
        $id = $_GET['id'];
        $author = 'testauthor';
        $op = 4;
        $forum = 'computer science';
        $fid = $_GET['id'];
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
                                VALUES ('$post_id', '$title', 'heather', '$message', 'o', '$id', '$forum', '$fid')";
         if (mysqli_query($db, $addpost)) {
             $last_id = mysqli_insert_id($db);
             echo "New record created successfully. Last inserted ID is: " . $last_id;
        } else {
             echo "Error: " . $addpost. "<br>" . mysqli_error($conn);
        }

} else {

}

    
    if(isset($_GET['id']) && is_numeric($_GET['id'])){
        $id = $_GET['id'];
    }else{
        die("Error!");
    }
    //check if id is a valid id
    $idCheck = $db->query("SELECT * FROM forum_tbl WHERE forum_id = '$id'");
    if($idCheck->num_rows !==1){
        die("Error");
    }
    $row = $idCheck->fetch_object();
    
    $sql = "SELECT post_id, post_title FROM forum_post WHERE forum_id = '$id' AND post_type ='o'";
    if($query = $db->prepare($sql)){
        $query->bind_param('s', $id);
        $query->bind_result($post_id, $post_title);
        $query->execute();
        $query->store_result();
    }else{
        echo $db->error;
    }

?>

<!DOCTYPE html>
<html>
    <script type="text/javascript">
          function HideShow(id,id2){
          
        		var p = document.getElementById(id);
        	     if( p.style.display == 'none'){
        			document.getElementById(id).style.display = 'block';
        			document.getElementById(id2).innerHTML = "hide form";
        			
        		}else{
            		document.getElementById(id).style.display = 'none';
            		document.getElementById(id2).innerHTML = "Add a course";
        		}
          }
</script>
<style>
    body {
        background-color: #FFCC66;
    }
#textboxid
{
    height: 400px;
    width: 800px;
    font-size:14pt;
}
    </style>

    
    
    <head>
         <a href = "forum_index.php">Back to Topics </a>
        
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
    <body>
       <p id = "forum_name"> <?php echo "<h><b><font size = '6'>" .$row->forum_name . "</font></b></h>"?> </p> </center>
       <p align = "right"> <button id ="New" onclick ="HideShow('newForm','New')"> New Post</button>
    <div method = "post" id = "newForm" style= "display: none" >
        <form method="post" action = "forum.php?id=<?php echo $id?>">
     	<fieldset>
		<legend>Add New Post </legend>
		<p><label for="title"><b>Title:</b></label><br /><input type="text" name="title" class="textbox-size"/></p>
        <p><label for="text"><b>Post:</b></label><br /></p>
        <textarea id = "textboxid" name = "textbox"/> </textarea>
        <p align="left"><input type="submit" name="post" style="height:22px; width:153px" value="Submit"></p>
	</fieldset>

</form>
</div>

           <div id = "container">
                <table width = "80%">
                  <?php  if($query->num_rows != 0) : ?>
                  <?php while($query->fetch()):?>
                  <tr>
                      <td>
                          <ul><li><a href = "viewpost.php?id=<?php echo $id?>&pid=<?php echo $post_id?>"> <?php echo "<font size = '5'>" .$post_title. "</font>";?> </a> </li>
                    </ul>
                      </td>
                  </tr>
                  <?php endwhile; ?>
                  <?php else: ?>
                  <tr>
                      <td>
                          No Posts
                      </td>
                  </tr>
                  <?php endif; ?>
            </table>
                 
        </div>
        
    </body>
</html>