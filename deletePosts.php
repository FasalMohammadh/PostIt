<?php

    $connection = mysqli_connect("localhost", "root", "",);
    $db = mysqli_select_db($connection, 'webGrp');

    if(isset($_POST['deletedata']))
    {
        $post_id = $_POST['delete_id'];
     
        $query = "DELETE FROM Posts WHERE post_id='$post_id' ";
        $query_run = mysqli_query($connection, $query);

        if($query_run)
        {
            echo '<script> alert("Data Deleted"); </script>';
            header('Location: posts.php');
        }
        else
        {
            echo '<script> alert("Data Not Deleted"); </script>';
        }
    }

?>