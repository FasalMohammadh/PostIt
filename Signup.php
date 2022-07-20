<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PostIt Signup</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="bootstrap icons/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="css/signup.css">
	<link rel="shortcut icon" type="image/jpg" href="otherRes/Favicon.jpeg">
	<link rel="stylesheet" href="css/common.css">
</head>

<body>
	<?php
        require "nav.php";
        if (!empty($_SESSION['email'])) {
            header("Location:Home.php");
        }
         if(!empty($_SESSION['admin'])){
            header("Location:admin.php");
        }
    ?>

	<!--Signup form-->
	<form class="signup col-9" action="Signup.php" method="post" onsubmit="validateAll(event)"
		enctype="multipart/form-data">

		<div class="row">
			<div class="box col-12 col-md-6 ">
				<span class="bi bi-person-plus rounded-circle logo"></span>
			</div>
			<label class="col-12 col-md-6" for="bio">Bio
				<textarea name="bio" class="form-control form-control-sm" style="height: 94px; resize: none;"
					autocomplete="off" spellcheck="false"></textarea>
			</label>

			<label class="col-12 col-md-6" for="proPic">Profile Picture<small id="profileMsg"></small>
				<input class="form-control form-control-sm" type="file" name="proPic" id="proPic"
					accept=".jpeg,.png,.jpg" onchange="validate(event)">
			</label>

			<label class="col-12 col-md-6" for="name">Full Name<small></small>
				<input class="form-control form-control-sm" type="text" name="fullname"
					style="text-transform: capitalize;" autocomplete="off" spellcheck="false">

			</label>

			<label class="col-12 col-md-6" for="email">Email<small></small>
				<input class="form-control form-control-sm" type="email" name="email" autocomplete="off"
					spellcheck="false">

			</label>

			<label class="col-12 col-md-6" for="pass">Password<small></small>
				<input class="form-control form-control-sm" type="password" name="pass">

			</label>

			<label class="col-12 col-md-6" for="repass">Re-Password<small></small>
				<input class="form-control form-control-sm" type="password" name="repass">

			</label>

			<label class="col-12 col-md-6" for="DOB">Date of Birth<small></small>
				<input class="form-control form-control-sm" type="date" name="DOB">

			</label>

			<div class="btn-group btn-group-sm w-100">
				<input class="btn btn-primary btn-sm" type="reset" name="Clear" value="Clear">
				<input class="btn btn-primary btn-sm" type="submit" name="Signup" value="Join Us">
			</div>

		</div>


	</form>
	<?php
	//handling post to save data to the database 
        if (!empty($_POST['Signup'])) {
            $name=$_POST['fullname'];
            $email= $_POST['email'];
            $pass= $_POST['pass'];
            $DOB= $_POST['DOB'];
            $bio= $_POST['bio'];

            $path="otherRes/ProfilePics/".$_FILES["proPic"]["name"];

            move_uploaded_file($_FILES["proPic"]["tmp_name"], $path);
            
            include "otherRes/connection.php";

            $query="INSERT INTO Users VALUES ('$name', '$email','$pass','$DOB','$path','".date("Y-m-d")."','$bio')";

            if (mysqli_query($con,$query)) {
              echo '<script>window.location.href="Login.php"</script>';
            }else{
            	echo '<script>alert("Something went wrong");</script>';
            }
            
        }
    
    ?>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript" src="js/signup.js"></script>
</body>

</html>