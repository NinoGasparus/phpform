<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
$req =$_POST;
if(isset($_POST["commentText"]) && isset($_POST["targetPost"])){
    $autor = $_SESSION['uporabnikID'];
    $conn = mysqli_connect("localhost", "root", "123123");
    $target = $_POST['targetPost'];
    $vsebina = $_POST['commentText'];
    mysqli_select_db($conn,"form");
    $query = "INSERT INTO komentar(autor, targetPost, vsebina) values($autor, $target, '$vsebina')";
    echo $query;
    $result = mysqli_query($conn, $query);

    $query = "UPDATE post SET komentarji = komentarji +1 WHERE id = ".$_POST['targetPost'];
    mysqli_query( $conn, $query);
    mysqli_close( $conn );
}else{
    echo "unset";
}
echo "<script> window.history.back()</script>";