<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>Self Help</title>
  </head>
  <body>
  <?php include 'partials/_header.php'; ?>
  <?php include 'partials/_dbconnect.php'; ?>
  <?php
  $id = $_GET['threadid'];
    $sql = "SELECT * FROM `threads` WHERE thread_id=$id";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result))
    {
      $title = $row['thread_title'];
      $description = $row['thread_description'];
      $user_id = $row['thread_user_id'];
     // $user_name = $row['thread_user_name'];

     $sql3 = "SELECT user_name FROM `users` WHERE sno='$user_id'";
     $result3 = mysqli_query($conn, $sql3);
     $row3 = mysqli_fetch_assoc($result3);
     $user_name = $row3['user_name'];
    }
  ?>

<?php 
    $method = $_SERVER['REQUEST_METHOD'];
    $showAlert=false;
    if($method=='POST'){
        //inserting comment into database
        $comment = $_POST['comment'];
        $sno = $_POST['sno'];
        //make changes to user_id and user_name (in $sql - VALUES) after completeting login/sign-up database. both id and name of user must be passed as VALUES instead of default  
        $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_time`, `comment_by`) VALUES ('$comment', '$id', current_timestamp(), '$sno')";
        $result = mysqli_query($conn, $sql);
        $showAlert=true;
        if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Yay!</strong> Your comment has been added.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
    }
 ?> 

<div class="container my-3 bg-light" style="width: 60%;">
    <div class="jumbotron">
    <h1 class="display-4"><?php echo $title ?></h1>
    <p class="lead"><?php echo $description ?></p>
    <hr class="my-4" >
    <p class="text-sm">Posted by <em><?php echo $user_name?></em> </p>
    </div>
</div>

<?php
  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
   echo '<div class="container bg-light" style="width: 60%;">  
   <h1>Post a comment</h1>
 <form action="'.$_SERVER['REQUEST_URI'].'" method="post">
         <div class="form-floating">
             <textarea class="form-control" placeholder="Leave a comment here" id="comment" name="comment"
                 style="height: 100px"></textarea>
             <label for="exampleFormControlTextarea1">Write your comment</label>
             <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">
         </div>
         <div class="mb-3 form-check">
             <input type="checkbox" class="form-check-input" id="exampleCheck1">
             <label class="form-check-label" for="exampleCheck1">I have read forum rules and guidelines</label>
         </div>
         <button type="submit" class="btn btn-dark">Post</button>
 </form>
</div>';
  }
  else{
    echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert" style="width: 60%; margin: auto;">
    <strong>You cannot comment! </strong> Log in to be able to participate in the discussion!  
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>'; 
  }
  ?>

<div class="container" style="width: 60%; text-shadow: 2px 1px lightgrey;"><h1 class="py-2">Discussions</h1></div>

<div class="container my-3 bg-light" style="width: 60%;"> 
    <?php
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `comments` WHERE thread_id=$id";
    $result = mysqli_query($conn, $sql);
    $noPost = true;
    while($row = mysqli_fetch_assoc($result))
    {
      $noPost = false;
      $id= $row['comment_id'];
      $content = $row['comment_content'];
      $comment_time = $row['comment_time'];
      $comment_by = $row['comment_by'];

      $sql2 = "SELECT user_name FROM `users` WHERE sno='$comment_by'";
      $result2 = mysqli_query($conn, $sql2);
      $row2 = mysqli_fetch_assoc($result2);
      echo 
      '<div class="media my-2 py-2" style="color:black;">
      <img class="mr-3" width="40px" src="img/default-user.png" alt="Generic placeholder image">
      ' .$row2['user_name']. '  at '.$comment_time. '
      <div class="media-body text-dark px-5">
          '. $content .'
      </div>
      </div>';
    }
    if($noPost){
      echo '<p class="py-3"> Be the first one to post!</p>';
    }
   ?>
</div>

  <?php //include 'partials/_footer.php'; ?>  

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>-->
    
  </body>
  <style> 
  .video-container {
	position: relative;
	padding-bottom: 50%;
	padding-top: 10px;
	height: 0;
	overflow: hidden;
}

.video-container iframe,  
.video-container object,  
.video-container embed {
	position: absolute;
	top: 3;
	left: 28px;
	width: 80%;
	height: 80%;
}
.video-wrapper {
	width: 440px;
	float:none;
	margin-left:auto;
	margin-right:auto;
	max-width: 100%;
}
  </style>
</html>