<?php

$path="otherRes/ProfilePics/".$_FILES["proPic"]["name"];

move_uploaded_file($_FILES["proPic"]["tmp_name"], "ProfilePics/".$_FILES["proPic"]["name"]);
			
include "connection.php";

session_start();

$logedEmail=$_SESSION['email'];

$query="SELECT profile_pic_path FROM Users WHERE email='$logedEmail'";

$res=mysqli_query($con,$query);

$rec=mysqli_fetch_array($res);

$parts=explode('/', $rec[0]);

unlink($parts[1]."/".$parts[2]);

$query="UPDATE Users SET profile_pic_path='$path' WHERE email='$logedEmail'";

if (!$con -> query($query)) {
  	echo("Error description: " . $con -> error);
}

// header("Location:http://loalhost/WebGrp/profile.php?id=$logedEmail")
?>