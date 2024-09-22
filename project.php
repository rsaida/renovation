<?php
     require_once "db.php";
     if (isset($_GET["id"])) {
          $id = $_GET["id"];
          $photos = getphotos($id);
     }
?>

<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
     <link rel="stylesheet" href="style.css">
</head>
<body>
     <?php
            include 'topbar.php';
            renderHeader();
     ?>
     <a href="projects.php">back</a>
     <br>
     <?php
          foreach($photos as $i) {
               echo '<img src="', $i['path'], '" alt="???picnotloaded??? width="640" height="480"><br>';
          }
     ?>
</body>
</html>