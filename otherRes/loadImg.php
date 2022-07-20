<?php
require "connection.php";
$email=$_POST['email'];
$query = "SELECT profile_pic_path FROM Users WHERE email='$email'";
        
$res=mysqli_query($con, $query);

if (mysqli_num_rows($res)>0) {
    $rec=mysqli_fetch_array($res);
    echo $rec[0];
}
?>

