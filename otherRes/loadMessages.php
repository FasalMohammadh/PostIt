<?php 
    
    if(!isset($_SESSION)){
    session_start();

    }	
    
    $logedEmail=$_SESSION['email'];

    $email=$_POST['id'];

	include "connection.php";

	$query="SELECT * FROM chat WHERE (user_email='$logedEmail' OR user_email='$email') AND (user_email2='$email' OR user_email2='$logedEmail')";

	$res=mysqli_query($con,$query);
	$arr=array();


	if(mysqli_num_rows($res)>0){
	while($rec=mysqli_fetch_assoc($res)){
		array_push($arr, $rec);
	}
	echo json_encode($arr);
	}else{
		echo "empty";
	}


	if (!$con -> query($query)) {
  		echo("Error description: " . $con -> error);
	}

?>