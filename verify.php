<?php 
require('db.php');
if(isset($_GET['vkey']))
{
   // if(vkey!=$_GET['vkey'])
    //echo"Problem";
   $query = "SELECT * FROM `users` WHERE 'vkey' = '$_GET[vkey]'";
   $result = mysqli_query($conn, $query) or die(mysql_error());
    //else
    echo "Verified";
    $query = "UPDATE `users` SET `verified`='1' " ;
    $result = mysqli_query($conn, $query) or die(mysql_error()); 
}