<?php

$req = $_POST;

if(isset($req["target"])){
    $conn = mysqli_connect("localhost","root","123123");
    mysqli_select_db($conn,"form");

    $query = "DELETE FROM komentar WHERE id = ". $_POST['target'];
    $result = mysqli_query($conn, $query);

    $query = "UPDATE post SET komentarji = komentarji- 1 where id  = " . $_POST['post'];
    $result = mysqli_query($conn, $query);
    mysqli_close( $conn );
    echo   "<script>window.history.back() </script>";
}