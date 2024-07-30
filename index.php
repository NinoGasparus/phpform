<!DOCTYPE html>
<html>

  <head>
  <link rel="stylesheet" href="./css/root.css">
  <link rel="stylesheet" href="./css/head.css">
  <link rel="stylesheet" href="./css/main.css">
  <link rel="stylesheet" href="./css/foot.css">
  <link rel="stylesheet" href="./css/newpost.css">
  <script src="js/showinfo.js"> </script> 
  <script src="js/showcreator.js"></script>
</head>

<body>
  
  <?php
  error_reporting(E_ALL);
  ini_set("display_errors",1);
  session_start();
  include "./components/head.php";
  include "./components/body.php";
  include "./components/newpost.php";
  include "./components/footer.php";
  include "./scripts/postLoading.php";
  
  head();
  body();
  newpost();
  footer();
  ?>
</body>

</html>