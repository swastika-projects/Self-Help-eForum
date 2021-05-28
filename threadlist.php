<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"  
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous"> 

        <!-- <link rel="stylesheet" href="https://bootswatch.com/4/journal/bootstrap.min.css"/> -->

    <title>Self Help</title>
</head>

<body>
    <?php include 'partials/_header.php'; ?>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php
  $id = $_GET['symid'];
    $sql = "SELECT * FROM `symptoms` WHERE symptom_id=$id";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result))
    {
      $symptom_name = $row['symptom_name'];
      $symptom_text = $row['symptom_description'];
    }
  ?>
 <?php 
    $method = $_SERVER['REQUEST_METHOD'];
    $showAlert=false;
    if($method=='POST'){
        //inserting thread into database
        $th_title = $_POST['title'];
        $th_description = $_POST['description'];
        $sno = $_POST['sno'];

        //make changes to user_id and user_name (in $sql - VALUES) after completeting login/sign-up database. both id and name of user must be passed as VALUES instead of default  
        $sql = "INSERT INTO `threads` (`thread_title`, `thread_description`, `thread_sym_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_description ', '$id', '$sno', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showAlert=true;
        if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Yay!</strong> Your post has been successfully submitted.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
    }
 ?> 
    <div class="container my-3" style="width: 60%; background: #41295a;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #2F0743, #41295a);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #2F0743, #41295a); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */">
        <div class="jumbotron">
            <h1 class="display-4" style="color:white;">What is <?php echo $symptom_name ?>?</h1>
            <p class="lead" style="color:white;"><?php echo $symptom_text ?></p>
            <hr class="my-4" style="color:white;">
            <p style="color:white;">Know more about our Forum Rules and Guidelines</p>
            <p class="lead">
                <a class="btn btn-secondary btn-md my-2" href="faq.php" role="button">Learn more</a>
            </p>
        </div>
    </div>
  <?php
  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
   echo '<div class="container bg-light" style="width: 60%;">  
      <h1>Start a discussion</h1>
    <form action="'.$_SERVER["REQUEST_URI"].'" method="post">
            <div class="mb-3 form-group">
                <label for="exampleInputEmail1" class="form-label">Thread title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">Title character limit : 150</div>
            </div>
            <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">
            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" id="description" name="description"
                    style="height: 100px"></textarea>
                <label for="exampleFormControlTextarea1">Description</label>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">I have read forum rules and guidelines</label>
            </div>
            <button type="submit" class="btn btn-dark">Submit</button>
        </form>
    </div>';
  }
  else{
    echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert" style="width: 60%; margin: auto;">
    <strong>You cannot post! </strong> Log in to be able to start a thread of your own!  
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>'; 
  }
  ?>

<!-- <div class="container bg-light py-1" style="width: 60%;">
            <p class="text-md">Log in to be able to post. </p>
                </div> -->

    <div class="container" style="width: 60%;">
        <h2 class="py-2" style="text-shadow: 2px 1px lightgrey;">Browse related threads</h2>
    </div>
    <div class="container my-3" style="width: 60%;">
    <?php
    $id = $_GET['symid'];
    $sql = "SELECT * FROM `threads` WHERE thread_sym_id=$id";
    $result = mysqli_query($conn, $sql);
    $noPost = true;
    while($row = mysqli_fetch_assoc($result))
    {
      $noPost = false;
      $id= $row['thread_id'];
      $title = $row['thread_title'];
      $description = $row['thread_description'];
      $thread_time = $row['timestamp'];
      $thread_user_id = $row['thread_user_id'];

      $sql2 = "SELECT user_name FROM `users` WHERE sno='$thread_user_id'";
      $result2 = mysqli_query($conn, $sql2);
      $row2 = mysqli_fetch_assoc($result2);
     

      //$username = $row['thread_user_name'];
      echo 
      '<div class="media my-2 py-2 bg-light" style="color:darkpurple;">
      <img class="mr-3" width="40px" src="img/default-user.png" alt="Generic placeholder image"><em>
      ' .$row2['user_name']. ' at '.$thread_time. '</em>
      <div class="media-body text-dark px-5">
        
          <h5 class="mt-0" id="thread-title" > <a href="thread.php?threadid='.$id.'" class="text-dark" style="text-decoration:none;">'. $title .'</a></h5>
          '.substr($description,0,700)."...".'
      </div>
      </div>';
    }
    if($noPost){
      echo '<div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h3 class="text-md ">No Results</h3>
        <p class="lead">Be the first one to post!</p>
      </div>
    </div>';
    }
   ?>

    </div>
    <?php //include 'partials/_footer.php'; ?> 



    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
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
    float: none;
    margin-left: auto;
    margin-right: auto;
    max-width: 100%;
}
#thread-title:hover{
   text-decoration: underline;
}

</style>

</html>