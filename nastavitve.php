<?php


$req = $_POST;

$status = "";
$user;
$pass;
$mail;
$pass;
$pfp;

if(isset($_GET['status']))
{
    $status = $_GET['status'];
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

if(isset($_POST["username"]) || isset($_GET['username'])){
    $conn = mysqli_connect('localhost', 'root', '123123');
    mysqli_select_db($conn, 'form');
    if(isset($_POST['username'])){
    $user = $_POST['username'];
    }else if(isset($_GET['username'])){
        $user = $_GET['username'];
    }
    $query = "SELECT * FROM uporabnik WHERE ime = '$user'";

    $result = mysqli_query($conn, $query);
    
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $user = $row["ime"];
        $mail = $row["email"];
        $pass = $row["geslo"];
        $pfp  = $row["profileImage"];

    } else {
        $status = "Prišlo je do napake";
    }
    
    mysqli_close($conn);
}
end:

?>





<html>

<head>
    <link rel="stylesheet" href="./css/root.css">
    <link rel="stylesheet" href="./css/head.css">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/foot.css">
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="./css/setting.css">
</head>

<body>

    <div id="head">
        <div>
            <p id="formname"><a href='index.php'>PForum</a>/Nastavitve</p>
        </div>
        <div>
           
            <p></p>
        </div>
        <div id="user">

        </div>
    </div>
    <div id="main">
   
    
    <div id='center'>
            <h3> Nastavitve </h3>
            <?php
            echo  '
            <form id="loginform" action="updateSettings.php" method="POST" enctype="multipart/form-data" >
                <input type ="hidden" name="user" value="'.$user.'">
                <label for="newuname">Uporabniško ime: '.$user.'</label><br>
                <input type="text" name="newuname"  placeholder="Novo uporabniško  ime" ><br>

                <label for="newemail"> E-pošta: '.$mail.'</label><br>
                <input type="text" name="newemail" placeholder="Nova epošta"><br>

                
                <label for="oldpass">Spremeni Geslo</label><br>
                <input type="password" name="oldpass" placeholder="Trenutno  geslo"><br>
                
                <label for="newpass"> Novo  geslo</label><br>
                <input type="password" name="newpass" placeholder="Novo geslo"><br>
                
                <label for="newpassverify"> Ponovi novo geslo</label><br>
                <input type="password" name="newpassverify" placeholder="Ponovi novo geslo"><br>
                
                <label for="image"> Naloži profilno sliko (priporočeno razmerje 1:1)</label>
                <input type="file" name="image" accept="image/png, image/jpg, image/gif"><br><br><br>

                <button type="submit"> Shrani spremembe</button><br>';
                
                    if(isset($status) && $status != "") {
                        echo $status;
                    }
                ?>
                  
            </form>
            <div id='reg'>
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