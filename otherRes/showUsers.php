<?php
	$keys=$_POST['keys'];

	if(!empty($keys)){
	include "connection.php";

	$query="SELECT fullname,email,profile_pic_path FROM Users WHERE fullname LIKE'%$keys%'";

	$res=mysqli_query($con,$query);

	$arrUsers=array();

	if(mysqli_num_rows($res)>0){
		while($rec=mysqli_fetch_assoc($res)){
			array_push($arrUsers, $rec);
		}
		echo json_encode($arrUsers);
	}
	else{
		echo "empty";
	}
	}


?>