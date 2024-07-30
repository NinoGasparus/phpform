<?php 
session_start();
$req = $_GET;
$targetpost = "";
if(isset($req["targetPost"])){
$targetpost = $req['targetPost'];

}else{
    echo "<script>window.history.back()</script>";
 
}

?>


<html><head>
  <link rel="stylesheet" href="./css/root.css">
  <link rel="stylesheet" href="./css/head.css">
  <link rel="stylesheet" href="./css/main.css">
  <link rel="stylesheet" href="./css/foot.css">
  <link rel="stylesheet" href="./css/newpost.css">
  <script src="js/showinfo.js"> </script> 
  <script src="js/showcreator.js"></script>
  <style>
    #pagenumber{
    margin-left: 2vw;
    margin-right: 2vw;
}
  </style>
</head>

<body>
  
 
<?php 
include "./components/head.php";
head();
?>
<div id="main">
      <?php 
      $conn = mysqli_connect("localhost","root","123123");
      mysqli_select_db($conn,"form");
      $query = "SELECT  * FROM post WHERE id = $targetpost";
      $result = mysqli_query($conn, $query);
    
      if(number_format($result->num_rows) == 0){
        echo "<h1> Ni  objav. </h1>";
    
      }
      
        while($row = mysqli_fetch_array($result)){
          $id = $row['id'];
          $title= $row['naslov'];
          $author= $row['avtor'];
    
          $query = "SELECT ime FROM uporabnik WHERE id  = $author";
          $result2 = mysqli_query($conn, $query);
          $author = mysqli_fetch_array($result2)['ime'];
    
          $textContent = $row['vsebina'];
          $likes = $row['likes'];
          $dlikes = $row['disslikes'];
          $comments = $row['komentarji'];
          $imgPath = $row['slika'];
          $uid = -1;
          if(isset($_SESSION['uporabnikID'])){
          $uid = $_SESSION['uporabnikID'];
          }
          echo "
          <div class='post'>
            <h1 class='postTitle' id='$title'> $title</h1> 
            <h4 class='postAuthor'>By: $author </h4><br>
            <pre class='postTextContent'> $textContent </pre><br>
            <img class='postimagecontent' src='./slike/$imgPath'> 
            <div class='postSocialStats'>
              <form action='./scripts/socials.php' method ='post'>
                <input type='hidden' name='autor' value='$uid'>
                <div class='likes' ><button type='submit' name='like' value='$id'> like</button> $likes </div>
                <div class='dlikes' ><button type='submit' name='dislike' value='$id'> Dislike</button> $dlikes</div>
              </form>
                <form action='commentSection.php' method='GET'><div class='comments'><button type='submit' name='targetPost' value='$id'> Comment </button> $comments</div></form>
            </div>
          
          
          
          
          </div>";
        }
        mysqli_close( $conn );
    
      
      ?>



    <div id="addcomment">
      <form action ='./scripts/addcomment.php' method="POST">
      <input type='text' name='commentText'> 
      <button type='submit' name='targetPost' value='<?php echo $targetpost; ?>' <?php if(isset($_SESSION['uporabnik'])){}else{echo "disabled";}?>> Comment </button>
      </form>
      </div>



      <?php 
      $conn = mysqli_connect("localhost","root","123123");
      mysqli_select_db($conn,"form");
      $query = "SELECT  * FROM komentar WHERE targetPost = $targetpost";
      $result = mysqli_query($conn, $query);
    
      if(number_format($result->num_rows) == 0){
        echo "<h1> Ni  komentarjev</h1>";
    
      }
      
        while($row = mysqli_fetch_array($result)){
          $id = $row['id'];
          $author= $row['autor'];
    
          $query = "SELECT ime FROM uporabnik WHERE id  = $author";
          $result2 = mysqli_query($conn, $query);
          $author = mysqli_fetch_array($result2)['ime'];
    
          $textContent = $row['vsebina'];

          if(isset($_SESSION['uporabnikID'])){
          $uid = $_SESSION['uporabnikID'];
          }
          echo "
          <div class='comment'>
            <h4 class='postAuthor'>By: $author </h4><br>
            <pre class='postTextContent'> $textContent </pre><br>";

          if($_SESSION['isadmin'] == 1){
            echo "<form action='./scripts/delpost.php' method = 'POST'> 
                <input type='hidden' name='post' value ='$targetpost'>
                <button name = 'target' value ='$id'> X </button>
                </form>
            ";
          }else {
           
          }
          echo"</div>";
        }
        mysqli_close( $conn );
    
      
      ?>
      
      
      
      
      </div></div>
    <button id="newpost" onclick="showcreator()"> + </button>
    <div id="creator" style="display: none;"><h2> Nova objava </h2><h2> Naslov </h2> <form action="./scripts/createpost.php" method="POST" enctype="multipart/form-data"><input type="hidden" name="autorID" value="1"><input type="text" name="naslov" required=""><h2> Vsebina </h2><textarea name="vsebina" required=""></textarea><h3> Dodaj sliko </h3><input type="file" name="image" accept="image/png, image/jpg, image/gif"><button type="submit"> Objavi </button></form></div><div id="foot">
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

</body></html>