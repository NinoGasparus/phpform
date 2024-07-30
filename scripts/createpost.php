<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
if(isset($_POST["naslov"]) && $_POST["naslov"] != ""){
    if(isset($_POST["vsebina"]) && $_POST["vsebina"] != ""){
        $conn = mysqli_connect("localhost","root","123123");
        mysqli_select_db($conn,"form");
        $title = $_POST['naslov'];
        $vsebina = $_POST['vsebina'];
        $autor = $_POST['autorID'];
        echo $autor;
    
        $uniqueFilename ="";
        if(isset($_FILES["image"])) {
            $file = $_FILES["image"]["tmp_name"];
            $originalFilename = $_FILES["image"]["name"];
            $currentTimeSeconds = time();
            if($originalFilename != ""){
            $uniqueFilename = $originalFilename."_".$currentTimeSeconds;
            }
            $destination = "../slike/" . $uniqueFilename;
        
            move_uploaded_file($file, $destination);
        }else{
            echo "image notset";
        }
        $query = "INSERT INTO post(naslov, vsebina, avtor, slika) VALUES('$title', '$vsebina', $autor, '$uniqueFilename')";
        $result = mysqli_query($conn, $query);
        mysqli_close($conn);
        
    }else{
        echo "idk something aint it";
    }
}else{
    echo "not ok";
}
echo "<script>window.history.back()</script>";

