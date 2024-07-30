<?php

function newpost(){
    error_reporting(E_ALL);
ini_set('display_errors', 1);
    echo "
    <button id='newpost' onClick='showcreator()'> + </button>
    ";

    echo "<div id ='creator' >";
    if(isset($_SESSION['uporabnik'])){
        if($_SESSION['uporabnik'] != ""){
            $uid = $_SESSION["uporabnikID"];
            echo "<h2> Nova objava </h2>";
            echo "<h2> Naslov </h2> ";
            echo "<form action='./scripts/createpost.php' method ='POST'  enctype='multipart/form-data'>";
            echo "<input type='hidden' name='autorID' value ='$uid'>";
            echo "<input type='text' name='naslov'  required>";
            echo "<h2> Vsebina </h2>";
            echo "<textarea name='vsebina' required></textarea>";
            echo "<h3> Dodaj sliko </h3>";
            echo '<input type="file" name="image" accept="image/png, image/jpg, image/gif"><br>';
            echo "<button type='submit'> Objavi </button>";
            echo "</form>";

        }
    }
    else{
        echo  "<h1> Za dodajanje objave se prijavite</h1>";
    }
    echo "</div>";
}