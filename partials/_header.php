<?php

session_start();

echo '
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #734f96">
<div class="container-fluid">
  <a class="logo" href="/eforum"><img src="img/logo.PNG" width=100px height=50px class="my-0 mx-0" alt="Logo"></a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item mx-0">
        <a class="nav-link active" aria-current="page" href="/eforum">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="faq.php">FAQ</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Region
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
         
          <li><a class="dropdown-item" href="bangalore.php">Bangalore</a></li>
         
          <li><a class="dropdown-item" href="delhi.php">Delhi</a></li>
         
          <li><a class="dropdown-item" href="mumbai.php">Mumbai</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="index.php">Other</a></li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="lounge.php">Lounge</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact.php">About Us</a>
      </li>
    </ul>';

    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
      echo '<p class="text-light py-0 mx-1 my-1"> Welcome '.$_SESSION['user_name'].'!</p>
      <form class="d-flex" method="get" action="search.php">
      <input class="form-control me-2 mx-1" type="search" name="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-dark mx-1" type="submit">Search</button>
      </form>
      <a href="partials/_logout.php" class="btn btn-dark ml-2 mx-1">Logout</a>';
    }
    else{
      echo '
      <form class="d-flex" method="get" action="search.php">
      <input class="form-control me-2 mx-1" type="search" name="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-dark mx-1" type="submit">Search</button>
      </form>
      <div class="mx-1">
      <button class="btn btn-dark ml-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
      <button class="btn btn-dark mr-2" data-bs-toggle="modal" data-bs-target="#signupModal">SignUp</button>
      </div>';
    }
  echo '</div>
</div>
</nav>';
include 'partials/_loginModal.php';
include 'partials/_signupModal.php';

//check if signupsuccess=true
if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="true"){
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
          <strong>Yay!</strong> Sign Up successfull! Login to your account. 
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
}
if(isset($_GET['loginsuccess']) && $_GET['loginsuccess']=="true"){
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
          <strong>Yay! </strong>Login successful. Welcome to your account.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
}
if(isset($_GET['loginsuccess']) && $_GET['loginsuccess']=="false"){
  echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
  <strong>Oops!</strong> Login unsuccessful. Incorrect credentials. 
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
if(isset($_GET['logout']) && $_GET['logout']=="true"){
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
          <strong>Yay! </strong>Logout successfull. See you soon!
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
}

?>