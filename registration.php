<?php
require('db.php');
$nameErr = $phoneErr = $emailErr = $passErr = "";
$name = $phone = $email = $password = $user = $phone1 = $email1 = "";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registration</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
  if (empty($_POST["username"])) {
    $nameErr = "Name is required";
  } else {
      $username = senitizeInput($_POST['username']);
      // check if name only contains letters and whitespace
      if (!preg_match ("/^[a-zA-z]*$/", $username)) {
        $nameErr = "Only letters and white spaces are allowed";
      }
    }
  if (empty($_POST["phone"])) {
    $phoneErr = "Phone is required";
  } else {
    $phone = $_POST["phone"];
    // check if name only contains letters and whitespace
    if (!preg_match('/^[0-9]*$/',$phone)) {
      $phoneErr = "Enter phone number with given format e.g: 03312179998";
    }
  }
  if (empty($_POST["email"])) {  
    $emailErr = "Email is required";
  } else { 
    $email = senitizeInput($_POST['email']);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }
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
      $passErr = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.";
    } else{
    echo 'Strong password.';
    }
  }
    $vkey = md5(time().$username);
    $varified='0';   
    if(empty($_POST["username"])
    || !preg_match ("/^[a-zA-z]*$/", $username)
    || empty($_POST["phone"])
    || !preg_match('/^[0-9]*$/',$phone)
    || empty($_POST["email"])
    || !filter_var($email, FILTER_VALIDATE_EMAIL)
    || empty($_POST["password"])) {
  echo "invalid Enteries";
  }
  else { 
    $query = "INSERT INTO `users`(`username`, `phone`, `email`, `password`, `vkey`, `verified`) 
    VALUES ('$username', '$phone', '$email', '$password', '$vkey', '$varified')";
        $result  = mysqli_query($conn, $query);		
        if ($result) {
          echo "<div class='form'>
                <h3>Data sent successfully.</h3><br/>
                <h3>Check your Email for verification.</h3><br/>
                </div>";
      } else {
        $error = mysqli_error($conn);
        echo "<div class='form'>
              <h3>ERROR.$error</h3><br/>
              <p class='link'>Click here to <a href='login.php'>registration</a> again.</p>
              </div>";
      }     
}
}
?>
  else {
  <p><span class="error">* required field</span></p>
  <form  class="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  <h1 class="login-title">Registration</h1>
  <input type="text" class="login-input" name="username" placeholder="Username" value="<?php echo $username; ?>"/>
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  <input type="text" class="login-input" name="phone" placeholder="Phone"value="<?php echo $phone; ?>"/>
  <span class="error">* <?php echo $phoneErr;?></span>
  <br><br>
  <input type="text" class="login-input" name="email" placeholder="Email Adress"value="<?php echo $email; ?>"> 
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  <input type="password" class="login-input" name="password" placeholder="Password"value="<?php echo $password; ?>">
  <span class="error">* <?php echo $passErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Register" class="login-button">
  <p class="link">Already have an account? <a href="login.php">Login here</a></p>
  </form>
  } 
<?php
  Use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;
  // When form submitted, insert values into the database.	
  $vkey= md5(time().$username);
  require 'PHPMailer\PHPMailer.php';
  require 'PHPMailer\SMTP.php';
  require 'PHPMailer\Exception.php';
  $mail = new PHPMailer(true);     
  try {
      //Server setting
      $mail->isSMTP();                                            //Send using SMTP
      $mail->Host       = 'smtp.mailtrap.io';                     //Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
      $mail->Username   = 'ad65768cd18a58';                     //SMTP username
      $mail->Password   = 'f4dc1695a16749';                               //SMTP password
      $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
      $mail->Port       = 2525;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
      //Recipients       
      $mail->setFrom('muneeb03312179998@gmail.com', 'Mailer');
      $mail->addAddress($email);     //Add a recipient
      //Content
      $mail->isHTML(true);                                  //Set email format to HTML
      $mail->Subject = 'Email Verifiation';
      $mail->Body    = "<a href='http://localhost/login/registeration-login-system-master/verify.php?vkey=$vkey'> Register Account </a>";
      $mail->send();
    }      
    catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
    echo 'Email has been sent';   		
  ?>
  </body>
  </html>