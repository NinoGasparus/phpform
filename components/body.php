<?php
include "./components/navigator.php";
function body(){
    $pageNumber = isset($_GET['page']) ? intval($_GET['page']) : 0;

    echo "<div id='main'>";
    loadPosts(15, $pageNumber);

    echo "</div>";

    echo "<div id='nav'><form action='' method='GET'>";
    
    if($pageNumber == 0){
        echo "<button disabled=true type='button'> Back </button>";
    } else {
        $prevPage = $pageNumber - 1;
       
        echo "<button type='submit' name='page' value=$prevPage> Back </button>";
    }
    
    $nextPage = $pageNumber + 1;
   
    echo "<p id='pagenumber'>$pageNumber</p>";
    echo "<button type='submit' name='page' value=$nextPage> Next </button>";

    echo "</form></div>"; 
}

