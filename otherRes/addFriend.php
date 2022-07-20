<?php
require 'connection.php';
session_start();
$logedEmail=$_SESSION['email'];
$id=$_GET["id"];
if (!empty($_GET["id"])) 
{
    $query="INSERT INTO Users_friends VALUES ('$logedEmail', '$id'), ('$id','$logedEmail')";
    if (!$con -> query($query)) {
            echo("Error description: " . $con -> error);
        }
    header("Location:http://localhost/WebGrp/Home.php");
}

?>