<?php
    session_start();
    $_SESSION['uporabnik'] = '';
    $_SESSION['uporabnikID'] = '';
    session_destroy();
    
    echo "<script>window.location.href = 'index.php';</script>";
