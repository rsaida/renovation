<?php
     require_once "db.php";
     $photos = getmainphotos();
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Web Page</title>
    <script src="script.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kalnia:wght@100..700&display=swap" rel="stylesheet">
</head>
    <div id="mains">
          <?php
               include 'topbar.php';
               renderHeader();
          ?>
    </div>
     <?php
          echo "<table>";
          $cnt = 0;
          foreach($photos as $i) {
               if($cnt % 2 == 0) {
                    echo "<tr>";
               }
               echo '<td><a href="project.php?id=', $i['project'], '">';
               echo '<img src="', $i['path'], '" alt="???picnotloaded??? width="640px" height="300px"><br>';
               echo '</a></td>';
               if($cnt % 2 == 1) {
                    echo "</tr>";
               }
               $cnt += 1;
          }
          echo "</table>";
     ?>
</body>
</html>