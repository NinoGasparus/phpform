<?php
$req = $_POST;
$status = "";

error_reporting(E_ALL);
ini_set('display_errors', 1);

if(isset($_POST["uname"]) && isset($_POST["email"]) && isset($_POST["pass"]) && isset($_POST["passverify"])) {
    $conn = mysqli_connect('localhost', 'root', '123123');
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    mysqli_select_db($conn, 'form');
    
    // Sanitize inputs to prevent SQL injection
    $uname = mysqli_real_escape_string($conn, $_POST['uname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['pass']);
    $passwordVerify = mysqli_real_escape_string($conn, $_POST['passverify']);
    
    // Check if username or email already exist
    $query = "SELECT * FROM uporabnik WHERE ime = '$uname' OR email = '$email'";
    $result = mysqli_query($conn, $query);
    
    if(mysqli_num_rows($result) > 0) {
        $status = "Uporabniško ime ali e-pošta že obstajata!";
    } else {
        // Check if passwords match
        if ($password !== $passwordVerify) {
            $status = "Gesli se ne ujemata!";
        } else {
            // Insert the new user into the database
            $query = "INSERT INTO uporabnik (ime, email, geslo) VALUES ('$uname', '$email', '$password')";
            if (mysqli_query($conn, $query)) {
                $status = "Uporabnik uspešno ustvarjen! <a href='login.php'> Prijavi se!</a> ";
            } else {
                $status = "Napaka pri ustvarjanju uporabnika: " . mysqli_error($conn);
            }
        }
    }
    
    mysqli_close($conn);
}


?>





<html>

<head>
    <link rel="stylesheet" href="./css/root.css">
    <link rel="stylesheet" href="./css/head.css">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/foot.css">
    <link rel="stylesheet" href="./css/login.css">

</head>

<body>

    <div id="head">
        <div>
            <p id="formname"><a href='index.php'>PForum</a></p>
        </div>
        <div>
           
            <p></p>
        </div>
        <div id="user">

        </div>
    </div>
    <div id="main">
   
    
    <div id='center'>
            <h3> Registracija </h3>
            <form id='loginform' action="" method="POST">
                <label for="uname">Uporabniško ime</label><br>
                <input type="text" name="uname" required><br>

                <label for="email"> E-pošta</label><br>
                <input type="text" name="email" required><br>

                <label for="pass"> Geslo</label><br>
                <input type="password" name="pass" required><br>
                
                <label for="pass"> Ponovi geslo</label><br>
                <input type="password" name="passverify" required><br>
                
                
                <button type="submit"> Register</button><br>
                <?php 
                    if(isset($status) && $status != "") {
                        echo $status;
                    }
                ?>
                   
            </form>
            <div id='reg'>
            <h3> Že imate račun? </h3>
            <a href='login.php'> Prijavi se!</a>
                </div>
    </div>

    </div>
    
    <div id="foot">
        <div class="footCol">
            <ul>
                <li>Kontakt:</li>
                <li>+386 123 123 123</li>
                <li>info@pforms.si</li>
            </ul>
        </div>
        <div class="footCol">
            <ul>
                <li>Pogoji:</li>
                <li>Pogoji poslovanja</li>
                <li>Pogoji zasebnosti</li>
            </ul>
        </div>
    </div>

</body>

</html>