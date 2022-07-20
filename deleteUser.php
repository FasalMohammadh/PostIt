<?php

    $connection = mysqli_connect("localhost", "root", "",);
    $db = mysqli_select_db($connection, 'webGrp');

    if(isset($_POST['deletedata']))
    {
        $email = $_POST['delete_id'];
     
        $query = "DELETE FROM Users WHERE email='$email' ";
        $query_run = mysqli_query($connection, $query);

        if($query_run)
        {
            echo '<script> alert("Data Deleted"); </script>';
            header('Location: user.php');
        }
        else
        {
            echo '<script> alert("Data Not Deleted"); </script>';
        }
    }

?>