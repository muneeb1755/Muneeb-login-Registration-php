<?php
require('db.php');
session_start();
if(isset($_GET['status']))
  {
    echo "updated successfully";
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
  <title>Login</title>
  <link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php
$nameErr = $passErr = "";
$username = $password = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["username"])) {
    $nameErr = "Name is required";
  } else {
    $username = senitizeInput(($_POST['username']));
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$username)) {
      $nameErr = "Enter Valid username";
    }
  }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["password"])) {
      $passErr = "Password is required for login";
    } else {
    $password = senitizeInput(($_REQUEST['password']));
    // Validate password strength
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);
    if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
        echo 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
    }else{
    echo 'Strong password.';
    }
  }
}
if(empty($_POST["username"])
  || !preg_match ("/^[a-zA-z]*$/", $username)){
  echo "invalid Enteries";
  }
  else
  {
  $query    = "SELECT * FROM `users` WHERE username='$username'AND password='$password'";
  $result = mysqli_query($conn, $query) or die(mysql_error());
  $row = mysqli_num_rows($result);
  if ($row == 1) {
  $_SESSION['username'] = $username;
  // Redirect to user dashboard page
  header("Location: dashboard.php");
  } else {
  echo "<div class='form'>
  <h3>Incorrect Username/password.</h3><br/>
  <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
  </div>";
  }
}
  ?>
  else {
  <p><span class="error">* required field</span></p>
  <form method="post" class="form" name="login" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  <h1 class="login-title">Login</h1>  
  <input type="text" class="login-input" name="username" placeholder="Username" autofocus="true"/>  
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  <input type="password" class="login-input" name="password" placeholder="Password"/>
  <span class="error">* <?php echo $passErr;?></span>
  <br><br>
  <input type="submit" value="Login" name="submit" class="login-button"/>
  <p class="link">Don't have an account? <a href="registration.php">Registration Now</a></p>
  <p class="link">Forget Password? <a href="forget-password.php">Forget Password</a></p>
  </form>
  }      
</body>
</html>
