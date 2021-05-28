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

  <!-- slider -->
  <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
  <ol class="carousel-indicators">
    <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"></li>
    <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"></li>
    <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"></li>
    <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3"></li>
    <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="4"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="https://source.unsplash.com/gMPsl1ez-Ts/2400x700" class="d-block w-100" alt="..."> 
    </div>
    <div class="carousel-item">
      <img src="https://source.unsplash.com/rU_BvpGC8nQ/2400x700" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="https://source.unsplash.com/mqoPbqrengk/2400x700" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="https://source.unsplash.com/MfqINxPDpKU/2400x700" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="https://source.unsplash.com/co-ukNRLtoQ/2400x700" class="d-block w-100" alt="...">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </a>
</div>
<!-- container for body elements after carousel -->
<div class="box">
<!-- RIGHT BOX FOR articles and videos HERE -->
<div class="container-right mx-3" style="width: 18%; float: right; margin: 0px 17px 20px 20px; padding: 2px;">
  <p class="text-center text-light py-2 my-1 shadow rounded-2 lead" style="background: #41295a;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #2F0743, #41295a);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #2F0743, #41295a); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */"><b>Watch Videos</b></p>
    <div class="col">

      <div class="video-wrapper shadow my-3 py-1 rounded-2" style="background:white;">
        <div class="video-container" style="margin: 5px 0px 0px 0px;">
        <iframe width="590" height="390" src="https://www.youtube.com/embed/lkDBImBAmN0" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
      </div>

      <div class="video-wrapper shadow my-3 py-1 rounded-2" style="background:white;">
        <div class="video-container" style="margin: 5px 0px 0px 0px;">
        <iframe width="590" height="390" src="https://www.youtube.com/embed/D8Gc6_S6i0k" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
      </div>
      
      <div class="video-wrapper shadow my-3 py-1 rounded-2" style="background:white;">
        <div class="video-container" style="margin: 5px 0px 0px 0px;">
        <iframe width="590" height="390" src="https://www.youtube.com/embed/EY5uIyklIAQ" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
      </div>

      <div class="video-wrapper shadow my-3 py-1 rounded-2" style="background:white;">
        <div class="video-container" style="margin: 5px 0px 0px 0px;">
        <iframe width="590" height="315" src="https://www.youtube.com/embed/gGuZVuUBeiQ" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
      </div>
  </div>
</div>


  <!-- LEFT BOX FOR POPULAR THREADS HERE -->
  <div class="container-right" style="width: 18.2%; float: left; margin: 0px 20px 20px 16px; padding: 2px;">
  <p class="text-center text-light py-2 my-1 shadow rounded-2 lead" style="background: #41295a;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #2F0743, #41295a);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #2F0743, #41295a); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */"><b>Popular Threads</b></p>
    <div class="col">
        <?php
          //hard coding thread_id of popular threads as part of an array
          $threadidArr = array(28,29,30,31);
          $i = 0;
        while($i!=4){
          $tempid= $threadidArr[$i++];
          $sql = "SELECT * FROM `threads` WHERE thread_id=$tempid";
          $result = mysqli_query($conn, $sql);
          while($row = mysqli_fetch_assoc($result))
          {
            $id= $row['thread_id'];
            $title = $row['thread_title'];
            $description = $row['thread_description'];
            $thread_user_id = $row['thread_user_id'];

            $sql2 = "SELECT user_name FROM `users` WHERE sno='$thread_user_id'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
         
           echo  '<div class="card rounded my-3 shadow" style="width: 16.9rem; border: 1px solid #E8E8E8;  background: #D3CCE3; 
           background: -webkit-linear-gradient(to right, #E9E4F0, #D3CCE3);
           background: linear-gradient(to right, #E9E4F0, #D3CCE3);">
            <div class="card-body" id="left-card">
              <h5 class="card-title">'.substr($title,0,40)."...".'</h5>
              <h6 class="card-subtitle mb-2 text-muted">Posted by <em>'.$row2['user_name'].'</em></h6>
              <p class="card-text">'.substr($description,0,80)."...".'</p>
              <a href="http://localhost/eforum/thread.php?threadid='.$id.'" class="card-link" style="color:#f46b45;">Visit thread</a>
            </div>
          </div>';
          }
        }
        ?>
    </div>
  </div>


 

<div class="container my-3 py-3 rounded-2" style="width:60%; background: #cbb4d4; background: -webkit-linear-gradient(to right, #cbb4d4, #D3CCE3);  /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to right, #cbb4d4, #D3CCE3);">
  <div class="container-fluid py-2 rounded-3" style="background-color: #f46b45;"><h2 class="text-center">What do you feel?</h2></div>
  <div class="row mx-3">
      <!-- fetch all the categories -->
      <?php 
      $sql = "SELECT * FROM `symptoms`";
      $result = mysqli_query($conn, $sql);
      $i=0;
      $symptom_img = array("AndE50aaHn4" , "wuo8KnyCm4I" , "f2feIgqsIXY", "oXo6IvDnkqc" , "hAZ3TNzQP6w" , "CCFCMb1Defk" , "VIO0tyzXL4U","4VjnmBs4RkQ");
      //  <!-- run a loop to iterate through all symptoms -->

      while($row = mysqli_fetch_assoc($result))
      {
        $id= $row['symptom_id'];
        $symptom_name = $row['symptom_name'];
        $symptom_text = $row['symptom_description'];
        echo '
        <div class="col-md-4 my-3">
        <div class="card" id="symptom-card" style="width: 15.5rem; padding: 0px; margin: 5px; background: #ECE9E6;
        background: -webkit-linear-gradient(to right, #FFFFFF, #ECE9E6);
        background: linear-gradient(to right, #FFFFFF, #ECE9E6);">
            <img src="https://source.unsplash.com/'.$symptom_img[$i++].'/1200x900" class="card-img-top" alt="...">
            <div class="card-body" style="height: 10.5rem; padding: 1px; margin: 3px;">
                <h5 class="card-title px-2">'.$symptom_name.'</a></h5>
                <p class="card-text px-2">'.substr($symptom_text,0,70)."...".'</p>
                <a href="threadlist.php?symid='.$id.'" class="btn btn-dark" style="text-decoration: none; ">View Thread</a>
            </div>
        </div>
        </div>';
      }
      ?>
  </div>
</div>
</div> <!-- to container for body elements after carousel -->


  <?php include 'partials/_footer.php'; ?> 

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


  .card-link{
    text-decoration: none;
  }
  .card-link:hover{
    text-decoration: underline;
  }
  #left-card:hover{
    box-shadow: 7px 7px 5px lightgrey;
    width: 17.2rem;
    background: #D3CCE3; 
    background: -webkit-linear-gradient(to right, #E9E4F0, #D3CCE3);
    background: linear-gradient(to right, #E9E4F0, #D3CCE3);
  }
  #symptom-card:hover{
    box-shadow: 7px 7px 5px #1F1C2C;
    width: 16rem;
    padding: 0px; margin: 5px;
  }
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