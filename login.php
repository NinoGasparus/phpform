<?php
$req = $_POST;
$status = "";

error_reporting(E_ALL);
ini_set('display_errors', 1);

if(isset($_POST["uname"]) && isset($_POST["pass"])) {
    $conn = mysqli_connect('localhost', 'root', '123123');
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    mysqli_select_db($conn, 'form');
    
    $uname = $_POST['uname'];
    $password =$_POST['pass'];
    
    $query = "SELECT id, ime, admin, disabled FROM uporabnik WHERE (ime = '$uname' OR email = '$uname') AND geslo = '$password'";
    
    $result = mysqli_query($conn, $query);
    
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        if($row['disabled'] == '1') {
            echo "<script> alert('Cannot log into this user');</script>";
        } else {
            session_start();
            $_SESSION["uporabnik"] = $row["ime"];
            $_SESSION["uporabnikID"] = $row["id"];
            $_SESSION['isadmin'] = $row['admin'];
            if($row['admin']) {
                $_SESSION['isAdmin'] = 1;
            }
            
            $status = "Prijava uspešna!";
            echo "<script>window.location.href = 'index.php';</script>";
        }
    } else {
        $status = "Napačno ime ali geslo!";
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
    <link rel="stylesheet"href="./css/settings.css">

    <style>
        #formname{
            text-decoration: underline;
    color: palevioletred;
    font-size: large;
    font-weight: bold;
        }
        
    </style>

</head>

<body>

    <div id="head">
        <div>
            <p id="formname"><a  href="index.php">PForum</a></p>
        </div>
        <div>
            
            <p></p>
        </div>
        <div id="user">

        </div>
    </div>
    <div id="main">
   
    
    <div id='center'>
            <h3> Prijava </h3>
            <form id='loginform' action="" method="POST">
                <label for="uname">Uporabniško ime ali epošta</label><br>
                <input type="text" name="uname" required><br>
                <label for="pass"> Geslo </label><br>
                <input type="password" name="pass" required><br>
                <button type="submit"> Log in</button><br>
                <?php 
                    if(isset($status) && $status != "") {
                        echo $status;
                    }
                ?>
                   
            </form>
            <div id='reg'>
            <h3> Nov uporabnik? </h3>
            <a href='register.php'> Registriraj  se!</a>
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