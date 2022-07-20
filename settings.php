<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Account Settings</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="bootstrap icons/bootstrap-icons.css">
	<link rel="stylesheet" href="css/common.css">
	<link rel="shortcut icon" type="image/jpg" href="otherRes/Favicon.jpeg">

</head>

<body>
	<?php
        require "nav.php";

        if (empty($_SESSION['email'])) {
            header("Location:Login.php");
        }

        require "otherRes/connection.php";

        $logedEmail=$_SESSION['email'];

        //get the full user details
        $query="SELECT fullname,email,profile_pic_path,bio,joinedDate,DOB FROM Users WHERE email='$logedEmail'";
           $result=mysqli_query($con, $query);

        if (mysqli_num_rows($result) >0) {
            $rec=mysqli_fetch_array($result);
        }

        //to get the user's friend count
        $query="SELECT COUNT(*) FROM Users_friends WHERE user_email='$logedEmail'";
        $resFriends=mysqli_query($con, $query);

        if (mysqli_num_rows($resFriends) >0) {
            $recFriends=mysqli_fetch_array($resFriends);
        }
    ?>
	<div class="container mt-4 mb-4 d-flex justify-content-center">
		<div class="card p-4  d-flex flex-row flex-wrap justify-content-center flex-fill">

			<!--box of user details with user image and with edit profile and change password button-->
			<div class=" image d-flex flex-column justify-content-center align-items-center px-5">
				<img class="rounded-circle border"
					src="<?php echo $rec[2]; ?>" height="150"
					width="150" />
				<span class="name mt-3"><?php echo $rec[0]; ?></span>
				<div class="d-flex flex-row justify-content-center align-items-center gap-2">
					<span class="bi bi-envelope-fill"></span>
					<span><?php echo $rec[1]; ?></span>
				</div>
				<span class="mt-2"><?php echo $recFriends[0];?>
					Friends</span>
				<button class="btn btn-sm btn-dark rounded mt-2 btnedit">Edit Profile</button>
				<button class="btn btn-sm btn-dark rounded mt-2 btnChangePass">Change Password</button>
				<span class="mt-3"><?php echo $rec[3]; ?></span>
				<span class=" px-2 rounded mt-4 bg-warning">Joined <?php echo $rec[4]; ?></span>
			</div>

			<!--form of change password-->
			<form class="frmChangePass d-flex flex-column bg-dark mt-4 ms-4 rounded p-3 justify-content-center d-none" action="settings.php" method="post" enctype="multipart/form-data">
				
				<h4 class="text-center text-white">Password Change</h4>

				<input spellcheck="false" class="form-control mt-2 form-control-sm" type="password" name="oldpass" placeholder="Old Password">

				<input class="form-control mt-2 form-control-sm" type="password" name="newPass"
					placeholder="New Password">

				<input class="form-control mt-2 form-control-sm" type="password" name="newRePass"
					placeholder="Re Password">

				<input type="submit" value="Change Password" class="btn btn-primary btn-sm mt-2" name="changePass" onclick="checkPass(event)">

			</form>

			<!--form of change user details-->
			<form class="form d-flex flex-column bg-dark mt-4 ms-4 rounded justify-content-center p-3 d-none"
				action="settings.php" method="post" enctype="multipart/form-data">
				<h4 class="text-center text-white">Account Information</h4>

				<input class="form-control mt-2 form-control-sm" type="text" name="fullname"
					value="<?php echo $rec[0]; ?>">

				<input spellcheck="false" class="form-control mt-2 form-control-sm" type="text" name="email"
					value="<?php echo $rec[1]; ?>">

				<input spellcheck="false" class="form-control mt-2 form-control-sm" type="date" name="DOB"
					value="<?php echo $rec[5]; ?>">

				<textarea class="form-control mt-2 form-control-sm" value="" cols="3" spellcheck="false" name="bio"
					spellcheck="false"><?php echo $rec[3]; ?></textarea>
				<input type="submit" value="Save Profile" class="btn btn-primary btn-sm mt-2" name="saveprofile">

			</form>

		</div>
	</div>

	<?php

	// post method to save new user details
        if (!empty($_POST['saveprofile'])) {
            $name=$_POST['fullname'];
            $email= $_POST['email'];
            $DOB= $_POST['DOB'];
            $bio= $_POST['bio'];

            //update the user details to the database
            $query="UPDATE Users SET fullname = '$name', email = '$email',DOB = '$DOB',bio = '$bio' WHERE email = '$logedEmail'";

            if(mysqli_query($con, $query)){
            	$_SESSION['email']= $email;
            	  echo '<script language="Javascript">
					window.location = "http://localhost/WebGrp/settings.php";
					</script>';
				echo '<script>alert("Your informations updated successfully");</script>';
            }else{
            	echo '<script>alert("Something went wrong");</script>';
            }

            //reload the page again with js
          
        }
    
    ?>

	<?php

	//post method to save user's new password
        if (!empty($_POST['changePass'])) {
            $oldPass=$_POST['oldpass'];

            $query="SELECT email FROM Users WHERE email = '$logedEmail' AND password='$oldPass'";

            $res1=mysqli_query($con, $query);
            
            if (mysqli_num_rows($res1)>0) {
                $newPass=$_POST['newPass'];

                $query="UPDATE Users SET password='$newPass' WHERE email = '$logedEmail'";

                mysqli_query($con, $query);

                echo "<script type='text/javascript'>alert('password change successful');</script>";
            } else {
                echo "<script type='text/javascript'>alert('Your old Password Invalid! Password Reset Failed');</script>";
            }
        }
    ?>
	<script type="text/javascript">

		//when clicking the editprofile button this will show/hide the edit profile form
		document.getElementsByClassName('btnedit')[0].addEventListener('click', () => {
			document.getElementsByClassName('form')[0].classList.toggle("d-none");
		});

		//when clicking the change password button this will show/hide the change password form
		document.getElementsByClassName('btnChangePass')[0].addEventListener('click', () => {
			document.getElementsByClassName('frmChangePass')[0].classList.toggle("d-none");
		})

		//check the passwords before post
		let checkPass=event=>{
			oldpass=document.getElementsByName('oldpass')[0].value;
			pass=document.getElementsByName('newPass')[0].value;
			rePass=document.getElementsByName('newRePass')[0].value;

			if(oldpass===pass)
			{
				event.preventDefault();
				alert("oldpass and new password fields are same");
			}
			else
			{
				if(pass.length<8)
				{
					event.preventDefault();
					alert("password must be atleast 8 characters");
				}
				else
				{
					if(!(pass===rePass))
					{
						event.preventDefault();
						alert("password do not match");
					}
				}
			}

			

		}
	</script>

	<script type="text/javascript" src="js/signup.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>