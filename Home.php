<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap icons/bootstrap-icons.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/common.css">
    <link rel="shortcut icon" type="image/jpg" href="otherRes/Favicon.jpeg">
</head>

<body>

    <?php
        //included Nav
        require "nav.php";

        if (empty($_SESSION['email'])) {
            header("Location: Login.php");
        }

        $logedEmail=$_SESSION['email'];

        include "otherRes/connection.php";
    ?>

    <!--full div of friendlist and post-->
    <div class="big-div d-flex flex-wrap justify-content-around col-10 mx-auto rounded ">


        <!--div of friendlist and addfriend-->
        <div class="friendsBox card mt-4 text-center border d-flex flex-column  justify-content-center">
            <div>

            <div class="card-title">Add Friends</div>

            <?php
            //get the users who are not a friend of current user
                $query="SELECT fullname,profile_pic_path,email FROM Users WHERE email!='$logedEmail' AND email NOT IN(SELECT user_email2 FROM Users_friends WHERE user_email='$logedEmail')";

                $res=mysqli_query($con, $query);

                if (mysqli_num_rows($res)>0) {
                    while ($rec=mysqli_fetch_array($res)) {
                        ?>

            <!--box of a single person-->
            <div class="profile rounded p-2 m-2 border d-flex justify-content-between">
                <a href="profile.php?id=<?php echo $rec[2]?>"
                    class=" text-decoration-none mr-2 text-black">
                    <img src="<?php echo $rec[1]?>"
                        class="rounded-circle border border-primary" width="60px" height="60px">
                    <span><?php echo $rec[0]?></span>
                </a>
                <!--call add friend php to add as a friend-->
                <a href="otherRes/addFriend.php?id=<?php echo $rec[2]?>"
                    class="btn btn-primary btn-sm ms-2">Add Friend</a>
            </div>
            <?php
                    }
                } else {
                    //if no add friend found
                    echo "You are friend with everyone";
                }
        ?>
            <div class="card-title">My Friends</div>
            <?php
                //get the users who are a friend of current user
                $query="SELECT fullname,profile_pic_path,email FROM Users WHERE email!='$logedEmail' AND email IN(SELECT user_email2 FROM Users_friends WHERE user_email='$logedEmail')";

                $resAllFriends=mysqli_query($con, $query);
                     if (mysqli_num_rows($resAllFriends)>0) {
                         while ($rec=mysqli_fetch_array($resAllFriends)) {
                             ?>

            <div class="profile rounded p-2 m-2 border d-flex justify-content-between">
                <a href="profile.php?id=<?php echo $rec[2]?>"
                    class=" text-decoration-none mr-2 text-black">
                    <img src="<?php echo $rec[1]?>"
                        class="rounded-circle border border-primary" width="60px" height="60px">
                    <span><?php echo $rec[0]?></span>
                </a>
                <a href="otherRes/unFriend.php?id=<?php echo $rec[2]?>"
                    class="btn btn-danger btn-sm ms-2">UnFriend</a>
            </div>

            <?php
                         }
                     } else {
                         echo "Add some Friends to see their posts";
                     }
        ?>

</div>
        </div>
        <div class="allpost mt-4 bg-white rounded flex-fill">
            POSTS
            <?php
            //included php file which will load all posts related to email and type
            require 'otherRes/singlePost.php';
            loadPosts($logedEmail, "other");
    ?>
        </div>

    </div>

    <?php
    //included the postbox to the page
    include "otherRes/postBox.php";

    ?>
    <label for="check" class="bi bi-chat-square-dots-fill align-middle" onclick="hide()"></label>
    <input hidden type="checkbox" id="check">
    <div class="msgbox rounded d-flex flex-column">
        <?php
    // will load the users friend in chat box
    $query="SELECT fullname,profile_pic_path,email FROM Users WHERE email!='$logedEmail' AND email IN(SELECT user_email2 FROM Users_friends WHERE user_email='$logedEmail')";

                $res=mysqli_query($con, $query);

                if (mysqli_num_rows($res)>0) {
                    while ($rec=mysqli_fetch_array($res)) {
                        ?>

        <div class="profile rounded p-2 border-bottom d-flex justify-content-between">
            <div class="idHolder" id="<?php echo $rec[2]?>"
                class=" mr-2 " onclick="loadMsgWindow(event); loadMessages();">
                <img src="<?php echo $rec[1]?>"
                    class="rounded-circle border border-primary" width="60px" height="60px">
                <span><?php echo $rec[0]?></span>
            </div>
        </div>

        <?php
                    }
                }
?>
    </div>
    <section id="chatWindow" class="d-none">
        <script type="text/javascript" src="js/home.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>