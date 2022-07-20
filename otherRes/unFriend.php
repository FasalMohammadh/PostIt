<?php
require "connection.php";

session_start();
$logedEmail=$_SESSION['email'];
$id=$_GET["id"];
if (!empty($_GET["id"])) 
{
    $query="DELETE FROM Users_friends WHERE (user_email,user_email2) IN (('$logedEmail', '$id'), ('$id','$logedEmail'))";
    if (!$con -> query($query)) {
            echo("Error description: " . $con -> error);
        }
    header("Location:http://localhost/WebGrp/Home.php");
}

?>