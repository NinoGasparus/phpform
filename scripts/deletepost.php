<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$req = $_POST;

if(isset($req["target"])){
    $conn = mysqli_connect("localhost","root","123123");
    mysqli_select_db($conn,"form");
    $query = "DELETE FROM komentar WHERE targetPost = " .$_POST['target'];
    $result = mysqli_query($conn, $query);
    
    $query = "DELETE FROM plike WHERE postID = " .$_POST["target"];
    $result = mysqli_query($conn, $query);
    
    $query = "DELETE FROM post WHERE id = ". $_POST['target'];
    $result = mysqli_query($conn, $query);

   
    mysqli_close( $conn );
    echo   "<script>window.history.back() </script>";
} echo   "<script>window.history.back() </script>";