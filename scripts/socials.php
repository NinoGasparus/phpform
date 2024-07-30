<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$req = $_POST;
if(isset($req["autor"])) {
    $autorid = $req['autor'];
    echo "autor" . $autorid;
    $kind = "";
    $targetpost = "";
    if(isset($req["like"])) {
        $kind = "like";
        $targetpost = $req["like"];
    } elseif(isset($req["dislike"])) {
        $kind = "dislike";
        $targetpost = $req["dislike"];
    }
    echo "target" . $targetpost;

    $conn = mysqli_connect("localhost", "root", "123123", "form");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query = "SELECT * FROM plike WHERE postID = $targetpost AND autorid = $autorid AND kind = '$kind'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0) {
        $query = "DELETE FROM plike WHERE postID = $targetpost AND autorid = $autorid AND kind = '$kind'";
        $result = mysqli_query($conn, $query);

        if ($kind == "like") {
            $query = "UPDATE post SET likes = likes - 1 WHERE id = $targetpost";
        } elseif ($kind == "dislike") {
            $query = "UPDATE post SET disslikes = disslikes - 1 WHERE id = $targetpost";
        }
        $result = mysqli_query($conn, $query);
    } else {
        $query = "INSERT INTO plike (postID, autorID, kind) VALUES ($targetpost, $autorid, '$kind')";
        $result = mysqli_query($conn, $query);

        if ($kind == "like") {
            $query = "UPDATE post SET likes = likes + 1 WHERE id = $targetpost";
        } elseif ($kind == "dislike") {
            $query = "UPDATE post SET disslikes = disslikes + 1 WHERE id = $targetpost";
        }
        $result = mysqli_query($conn, $query);
    }

    mysqli_close($conn);
} else {
    echo "not set";
}
echo "<script>window.history.back()</script>";

