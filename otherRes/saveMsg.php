<?php 
    
    if(!isset($_SESSION)){
    session_start();

    }	
    
    $logedEmail=$_SESSION['email'];

    $email=$_POST['id'];

	$msg=$_POST['msg'];

	include "connection.php";

	$query="INSERT INTO chat VALUES ('$logedEmail', '$email',NULL, '$msg', current_timestamp())";

	if (!$con -> query($query)) {
  		echo("Error description: " . $con -> error);
	}

?>