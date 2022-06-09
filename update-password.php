<?php
require('db.php');
if(isset($_GET['email'])) {    
$query="SELECT * FROM `users` WHERE 'email'='$_GET[email]'";
$result=mysqli_query($conn, $query);
if($result) {
  echo 
  "<div class='container'>
  <h3 class='text-center'>Reset Your Password</h3>
  <form action='update-password.php' method='post'>
  <div class='mb-3 col-md-5' >
  <label for='password' class='form-label'>Password</label>
  <input type='password' class='form-control' id='password' name='password' required>
  <br>
  <button type='submit' class='btn btn-primary' name='update-password'>Reset Now</button>
  <input type='hidden' name='email' value='$_GET[email]'>
  </div>
  </form>
  </div>";       
}
else {
  echo "query didnt work";
}
}
  //this code is written for forget password
  if(isset($_POST['update-password'])) {
  $password=senitizeInput($_POST["password"]);
  $update="UPDATE `users` SET `password`='$password' WHERE `email`='$_POST[email]'";
  if(mysqli_query($conn, $update)) {
  echo"<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!</strong> Password Updated Successfully
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
} else {
  echo"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
  <strong>Danger!</strong> Password Update Error
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
}
}
?>