<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="css/login.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">
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

	<div class="d-flex flex-row col-9 mx-auto">
		<div class="login-box flex-column justify-content-around d-none d-lg-flex w-50 bg-dark text-white">
			<h3 class="text-center">Login</h3>
		</div>
		<!--login form-->
		<form class="login flex-fill" method="post" action="Login.php" onsubmit="validateAll(event)">
			<div class="col-12 text-center mb-2 box w-100">
				<span class="bi bi-person-check rounded-circle logo"></span>
			</div>
			<label for="email">Email<small></small>
				<input class="form-control form-control-sm" type="text" name="email" onblur="loadImg()"
					autocomplete="off" spellcheck="false">
			</label>

			<label for="pass">Password<small></small>
				<input class="form-control form-control-sm" type="password" name="pass">
			</label>

			<div class="btn-group btn-group-sm w-100">
				<input class="btn btn-primary btn-sm" type="reset" name="Clear" value="Clear">
				<input class="btn btn-primary btn-sm" type="submit" name="login" value="Login">
			</div>

		</form>
	</div>
	<?php
	//post to handle login data and to verify user
        if (!empty($_POST['login'])) {
            $email=$_POST['email'];
            $pass=$_POST['pass'];

            $query="SELECT * FROM Users WHERE BINARY email='$email' AND password='$pass'";

            require "otherRes/connection.php";

            $res=mysqli_query($con, $query);

            if (mysqli_num_rows($res)>0)
            {

                $_SESSION['email']=$email;
                echo '<script type="text/javascript">
					window.location.href = "Home.php";
				</script>';

            } 
            else
            {
                $query="SELECT * FROM admin WHERE BINARY admin_id='$email' AND password='$pass'";
                $res=mysqli_query($con, $query);

                if (mysqli_num_rows($res)>0)
                {
                    $_SESSION['admin']=$email;
                    echo '<script type="text/javascript">
					window.location.href = "admin.php";
					</script>';

                } 
                else 
                {
                    echo "<script type='text/javascript'>alert('Entered credentials incorrect');</script>";
                }
            }
        }
    ?>
	<script src="js/login.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>