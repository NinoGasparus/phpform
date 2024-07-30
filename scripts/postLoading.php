<?php 

function loadPosts($post_amount,$offset){
  $off = $offset * $post_amount;


  $conn = mysqli_connect("localhost","root","123123");
  mysqli_select_db($conn,"form");
  $query = "SELECT  * FROM post LIMIT $post_amount OFFSET $off";
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
        <pre class='postTextContent'> $textContent </pre><br>";
       
        if($imgPath && $imgPath != "")
        { 
          echo "<img class='postimagecontent' src='./slike/$imgPath'>";
        }else{

        }
        
        echo"
        <div class='postSocialStats'>
          <form action='./scripts/socials.php' method ='post'>
            <input type='hidden' name='autor' value='$uid'>
           
            <div class='likes' ><button type='submit' name='like' value='$id'";
            if(isset($_SESSION["uporabnik"])){}else{echo " disabled ";}
            
            echo"> like</button> $likes </div>


            <div class='dlikes' ><button type='submit' name='dislike' value='$id'";
            if(isset($_SESSION["uporabnik"])){}else{echo " disabled ";}
            echo"> Dislike</button> $dlikes</div>

          </form>";
          
          echo
          "
            <form action='commentSection.php' method='GET'><div class='comments'><button type='submit' name='targetPost' value='$id'> Comments </button> $comments</div></form>";
            if(isset($_SESSION["isadmin"])){
              if($_SESSION['isadmin']){
                echo "<form action='./scripts/deletepost.php' method ='post'>
                  <button type='submit' name='target' value = '$id'> Odstrani </button> </form>
                ";
              }
            }else{echo "";}
       
            echo"
       
            </div>

        
        
      </div>";
      
    }
    mysqli_close( $conn );
}
