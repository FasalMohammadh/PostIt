<?php
	session_start();
	$logedEmail=$_SESSION['email'];
	$postId=$_POST['postId'];
	$status=$_POST['status'];

if($status=="addlike"){
	$query="INSERT INTO Posts_users_like VALUES ('$logedEmail', ".intVal($postId).")";
}else{
	$query="DELETE FROM Posts_users_like WHERE user_email='$logedEmail' AND post_id= ".intVal($postId);
}
	include "connection.php";

	if (!$con -> query($query)) {
  			echo("Error description: " . $con -> error);
		}
		else{
			echo "success";
		}
?>