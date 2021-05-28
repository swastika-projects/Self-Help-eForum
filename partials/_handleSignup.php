<!-- DO IT LATER : show error alert when there is sign up error i.e $showError != "false" -->

<?php
$showError = "false";
 if($_SERVER["REQUEST_METHOD"] == "POST"){
     include '_dbconnect.php';
     $user_email = $_POST['signupEmail'];
     $user_name = $_POST['username'];
     $pass = $_POST['signupPassword'];
     $cpass = $_POST['signupCPassword'];

     //check whether this email already exits
     $exitSql = "SELECT * FROM `users` WHERE user_email = '$user_email'";
     $result = mysqli_query($conn, $exitSql);
     $numRows = mysqli_num_rows($result);
     if($numRows > 0){
         $showError = "Email already exists!";
     }
     else{
         if($pass == $cpass){
            //HASHING IS USED FOR PASSWORD PROTECTION : password_hash function 
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`user_email`, `user_pass`, `timestamp`, `user_name`) VALUES ('$user_email', '$hash', current_timestamp(), '$user_name')";
            $result = mysqli_query($conn, $sql);
            if($result){
                $showAlert = true;
                header("Location: /eforum/index.php?signupsuccess=true");
                exit();
            }
         }
         else{
            $showError = "Passwords do not match"; 
         }
     }
     header("Location: /eforum/index.php?signupsuccess=false&error=$showError");
 }

?>