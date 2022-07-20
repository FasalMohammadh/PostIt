<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="bootstrap icons/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="css/profile.css">
    <link rel="stylesheet" href="css/common.css">
    <link rel="shortcut icon" type="image/jpg" href="otherRes/Favicon.jpeg">

</head>

<body>
    <?php
        require "nav.php";

        //get id from get method
       $email=$_GET['id'];

        if (empty($_SESSION['email'])) {
            header("Location:Login.php");
        }

        //if id is not available through get method page will be redirected to home
        if (empty($email)) {
            header("Location:Home.php");
        }

        //connection is included
        require "otherRes/connection.php";

        //get the user details according to the email passed in get
        $query="SELECT fullname,email,profile_pic_path,bio,joinedDate,DOB FROM Users WHERE email='$email'";
        $result=mysqli_query($con, $query);

        if (mysqli_num_rows($result) >0) {
            $record=mysqli_fetch_array($result);
        }

        //get no of post of the user 
        $query="SELECT COUNT(*) FROM Posts WHERE user_email='$email'";
        $res=mysqli_query($con, $query);

        if (mysqli_num_rows($res) >0) {
            $rec=mysqli_fetch_array($res);
        }

        //get no of friends of the user 
        $query="SELECT COUNT(*) FROM Users_friends WHERE user_email='$email'";
        $resFriends=mysqli_query($con, $query);

        if (mysqli_num_rows($resFriends) >0) {
            $recFriends=mysqli_fetch_array($resFriends);
        }

    ?>

    <!--shows all user details relevent to the email passed in get-->
    <div class=" mt-4 mb-4 d-flex justify-content-center col-10 mx-auto">
        <div class="card p-4  d-flex flex-row flex-wrap justify-content-around">
            <div class=" image d-flex flex-column justify-content-center align-items-center w-100">

                <form action="otherRes/newProPic.php" method="post" class="frm" enctype="multipart/form-data">
                    <div class="bgBox">
                        <img class="rounded-circle border" src="<?php echo $record[2]; ?>" height="150" width="150" />

                        <?php
                    if ($_SESSION['email']==$email) {
                        ?>
                        <label for="proPic" class="bi bi-images rounded-circle border"></label>
                        <input type="file" name="proPic" hidden id="proPic" onchange="(this.form.submit())">
                        <?php
                    }
                ?>
                    </div>

                </form>

                <span class="name mt-3"><?php echo $record[0]; ?></span>
                <div class="d-flex flex-row justify-content-center align-items-center gap-2">
                    <span class="bi bi-envelope-fill"></span>
                    <span><?php echo $record[1]; ?></span>

                </div>
                <span class="mt-1"><?php echo $record[3]; ?></span>
                <div class="row w-100">
                    <!--html element which shows no of friends-->
                    <span class="col-6 mt-2 text-center smallBox">
                        <div class="bi bi-people"></div>
                        <div>Friends</div><?php echo $recFriends[0];?>
                    </span>
                    <!--html element which shows no of posts-->
                    <span class=" col-6 mt-2 text-center smallBox">
                        <div class="bi bi-stickies"></div>
                        <div>Posts</div><?php echo $rec[0];?>
                    </span>
                </div>


            </div>


            <?php
            //this will load all the posts related to user email passed in get
            require 'otherRes/singlePost.php';
            loadPosts($email, "Mine");

        ?>

        </div>
    </div>

    <?php
    if ($_SESSION['email']==$email) {
        //this will load the post box if the showing profile and logged users are same
        include "otherRes/postBox.php";
    }

?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>