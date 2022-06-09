<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "db";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>
<?php
function senitizeInput($input) {
  $input = trim($input);
  $input = stripslashes($input);
  $input = htmlspecialchars($input); 
  return $input;
}
?>