<?php
     require_once "db.php";
     if (isset($_GET["id"])) {
          $id = $_GET["id"];
          $photos = getphotos($id);
          $pic = getDisplayedPhoto($id)[0];
     }
?>

<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
     <link rel="stylesheet" href="style.css">
     <link rel="stylesheet" href="services.css">

     <style>
          .small img {
               width: 50%;

               padding-top: 10px;
          }
          .small {
               margin: 0 auto;
               text-align: center;
          }
     </style>
</head>
<body>
     <?php
            include 'topbar.php';
            renderHeader();
     ?>
     <br>
     
     <div id="servicesDiv">
          <div id="displayImage">
               <img src="<?=$pic;?>" alt="">
          </div>
          <div id="servicesText"style="text-align: right;">
               <h1 >Project Info</h1> <br>
               <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia vel animi explicabo libero obcaecati dignissimos non sit veniam dolore enim ea at, esse aperiam delectus laudantium. Minima omnis fugit nostrum!</p> <br>
               <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorem a explicabo consequatur ducimus fugit harum itaque eos atque quaerat aperiam voluptate facilis est, facere quibusdam iure, dignissimos odio, exercitationem excepturi?</p>
          </div>
     </div>
     <!-- <a href="projects.php">back</a> -->
     <br>
     <div class = "small">
     <?php
          foreach($photos as $i) {
               echo '<img src="', $i['path'], '" alt="???picnotloaded??? width="640" height="480"><br>';
          }
     ?>
     </div>
</body>
</html>