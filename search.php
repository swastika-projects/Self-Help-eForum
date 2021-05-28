<!-- work on the footer IMPORTANT -->

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



  <!-- search results -->
  <div class="container my-3" style="width:60%; margin:auto;" id="searchcontainer">
  <h1 class="lead">Search results for <em>"<?php echo $_GET['search']?>"</em></h1>

  <!-- pulling search results from database -->
  <?php
      $query=$_GET["search"];
      $sql = "SELECT * FROM `threads` WHERE MATCH(thread_title, thread_description) against ('$query')";
      $result = mysqli_query($conn, $sql);
      $noResults=true;
      while($row = mysqli_fetch_assoc($result))
      {
        $noResults=false;
        $title = $row['thread_title'];
        $description = $row['thread_description'];
        $thread_id = $row['thread_id'];
        $url="thread.php?threadid=".$thread_id;
         
        // FIX IT !!!!  hover of title, without hover text decoration must be none
        echo '<div class="container-fluid my-3 bg-light px-0">
        <h3 class="text-dark threadtitle" style="text-decoration: none;"><a href="'.$url.'" class="text-dark">'.$title.'</a> </h3>
        <p>'.$description.'</p>
        </div>';
      }
      if($noResults){
          echo '<div class="jumbotron jumbotron-fluid bg-light">
          <div class="container">
            <h3 class="text-md text-center py-2">No results found!</h3>
            <p class="py-1 my-2 mx-0">
                Make sure that all words are spelled correctly.<br>
                Try different keywords.<br>
                Try more general keywords.<br>
                Try fewer keywords.<br>
            </p>
          </div>
        </div>';
      }
  ?>

 <!-- <?php include 'partials/_footer.php'; ?>  -->

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
  </body>

  <style> 
  #searchcontainer{
      min-height:100vh; 
  }
  /* to fix thread tile hover */
  .threadtitle{
      text-decoration: none;
  }
  .threadtitle:hover{
    text-decoration: wavy;
  }
  </style>
</html>