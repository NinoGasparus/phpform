<?php
function head(){


$username = 'lllllllllllllllllllll';
if(isset($_SESSION['uporabnik'])){
    $username = $_SESSION['uporabnik'];
    $conn = mysqli_connect('localhost','root','123123');
mysqli_select_db($conn,'form');

    $query = "SELECT profileImage from uporabnik where ime = '$username'";
$logo = mysqli_fetch_array(mysqli_query($conn, $query))['profileImage'];


}



if(isset($username) && $username != "lllllllllllllllllllll"){
    echo"<div id='head'>
        <div><p id='formname'><a href='index.php'>PForum</a></p></div>
        <div><p id='search'>Tvoje dnevne novice</p></div>
        <div id='user'>
            <div id='username' onclick='showinfo()'> $username</div>
            <div id='profilelogo'><img id='pfp' src='./slike/$logo' onclick='showinfo()'></div>
        </div>
        </div>";

    echo "<div id='infopane' >
        
        <form action='logout.php' method='POST' ><button type='submit'> Odjava </button> </form><br>
        <form action='nastavitve.php' method='POST'><button type='submit' name='username' value='$username' > Nastavitve </button></form>
    
    
    </div>";
}else{
    echo"<div id='head'>
    <div><p id='formname'><a href='index.php'>PForum</a></p></div>
    <div><p id='search'>Tvoje dnevne novice</p></p></div>
    <div id='user'>
        <div id='username'> 
            <a href='login.php'><button> Prijava </button></a></div>
    </div>
    </div>";
}

}
