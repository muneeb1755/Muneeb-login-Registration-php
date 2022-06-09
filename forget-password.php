<?php
require('db.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Forget Password</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<form class="form" action="forget-password.php" method="post">
<h1 class="login-title">Forget Password</h1>
<input type="text" class="login-input" name="username" placeholder="Username" required />
<input type="text" class="login-input" name="email" placeholder="Email Adress">
<input type="submit" name="submit" value="Submit" class="login-button">
<p class="link">Remember Password? <a href="login.php">Login</a></p>
</form>

<?php
Use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer\PHPMailer.php';
require 'PHPMailer\SMTP.php';
require 'PHPMailer\Exception.php';
$mail = new PHPMailer(true);
if (isset($_POST['email'])){
  $username = $_POST['username'];
  $email = senitizeInput($_POST['email']);
  $query    = "SELECT * FROM `users` WHERE username='$username' && email='$email'";
$result = mysqli_query($conn, $query) or die(mysql_error());
}
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
  $mail->Subject = 'Reset Password';
  $mail->Body    = "<a href='http://localhost/login/registeration-login-system-master/update-password.php?email=$email'> Reset Password </a>";
  $mail->send();
  //header("Location: update-password.php");
  echo "<div class='form'>
  <h3>Email has been sent, Please Check your E-mail for reset your Password.</h3><br/>
  </div>";
  } 
  catch (Exception $e) {
  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
?>
</body>
</html>