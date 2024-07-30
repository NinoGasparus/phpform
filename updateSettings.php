<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
if(isset($_POST["user"])) {
    $ok = true;
    $status = "unchanged";
    $user = $_POST["user"];
    $conn = mysqli_connect("localhost", "root", "123123");
    mysqli_select_db($conn, "form");

    if(isset($_POST["newuname"])) {
        if($_POST['newuname'] != ''){
        $newuname = $_POST["newuname"];
        $query = "SELECT * FROM uporabnik WHERE ime = '$newuname'";
        $result = mysqli_query($conn, $query);
        
        if(mysqli_num_rows($result) > 0) {
            $status = "Username taken";
            $ok = false;
        } else {
            $query1 = "UPDATE uporabnik SET ime = '$newuname' WHERE ime = '$user'";
          
            $status = "Username changed";
            session_start();
            $_SESSION['uporabnik'] = $newuname;
        }
    }
    }

    if($ok && isset($_POST["newemail"])) {
        if($_POST["newemail"] != ""){
        $newemail = $_POST["newemail"];
        $query = "SELECT * FROM uporabnik WHERE email = '$newemail'";
        $result = mysqli_query($conn, $query);
        
        if(mysqli_num_rows($result) > 0) {
            $status = "Email taken ";
            $ok = false;
        } else {
            $query2 = "UPDATE uporabnik SET email = '$newemail' WHERE ime = '$user'";
  
            $status = "Email changed";
            session_start();
           
        }
        }
    }

    if($ok  && isset( $_POST["oldpass"]) && isset($_POST['newpass']) && isset($_POST['newpassverify'])) {
        if(($_POST['newpass'] != "" && $_POST['newpassverify']) != "" && $_POST['oldpass'] !="" ) {
            $query = "SELECT geslo FROM uporabnik WHERE ime = '$user'";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_array($result);
            if($row['geslo'] == $_POST['oldpass']){
                if($_POST['newpass'] == $_POST['newpassverify']){
                    $newpass = $_POST['newpass'];
                    $query3 = "UPDATE uporabnik SET geslo = '$newpass' WHERE ime = '$user'";
        
                    $status = "complete";
                }else{
                    $status = "password missmatch";
                }


            }else{
                $ok = false;
                $status = "wrong password;";
            }
        }else{
           
        }
    }

   
    if(isset($_FILES["image"])) {
        $file = $_FILES["image"]["tmp_name"];
        $originalFilename = $_FILES["image"]["name"];
        $currentTimeSeconds = time();
        $uniqueFilename = $originalFilename."_".$currentTimeSeconds;
        $destination = "./slike/" . $uniqueFilename;
    
        if(move_uploaded_file($file, $destination)) {
            $image = "./slike/".$uniqueFilename;
            $query4 = "UPDATE uporabnik SET profileImage = '$uniqueFilename' WHERE ime  = '$user'";
        } else {
        }
    }
    

    if($ok){
        if(isset($query1)){
         mysqli_query($conn,$query1);
        }
        if(isset($query2)){
         mysqli_query($conn,$query2);
        }
        if(isset($query3)){
         mysqli_query($conn,$query3);
        }
        if(isset($query4)){
         mysqli_query($conn,$query4);
        }
    }
  
} else {
    $status = "Error: User parameter not set!";
}

echo $status;

if($ok) {
    echo "<script>window.location.href = 'index.php';</script>";
}else{
//     echo "
// <script>
//     var status = '$status';
//     var username = '$user';
//     window.location.href = 'nastavitve.php?status=' + encodeURIComponent(status) + '&username=' + encodeURIComponent(username);
// </script>";


}
