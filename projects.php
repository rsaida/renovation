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
    <link rel="stylesheet" href="services.css">
    <style>
          table{
               margin: auto;
               margin-top: 5%;
               width: 90%;
          }
          td{
               padding-left: 1%;
               padding-right: 1%;
          }
          img {
               width: 100%;
               height: 100%;
          }
          .image-container {
               position: relative;
               display: inline-block; /* Allow it to size to the image */
               overflow: hidden; /* Hide overflow for the overlay */
          }

          .image-container img {
               width: 100%;
               height: auto; /* Maintain aspect ratio */
               display: block; /* Remove any space below the image */
          }

          .overlay {
               position: absolute;
               top: 0;
               left: 0;
               right: 0;
               bottom: 0;
               background-color: rgba(0, 0, 0, 0.5); /* Black with 50% opacity */
               opacity: 0; /* Initially hidden */
               transition: opacity 0.3s ease; /* Smooth transition */
          }

          .image-container:hover .overlay {
               opacity: 0.5; /* Show overlay on hover */
          }

    </style>
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
               echo '<td>';
               echo '<a href="project.php?id=', $i['project'], '">';
               echo '<div class="image-container">';  // Wrap img in a div
               echo '<img src="', $i['path'], '" alt="???picnotloaded???" width="640px" height="300px">';
               echo '<div class="overlay"></div>';  // Add the overlay div
               echo '</div>';  // Close the image container
               echo '</a>';
               echo '</td>';
               if($cnt % 2 == 1) {
                   echo "</tr>";
               }
               $cnt += 1;
           }
          echo "</table>";    
     ?>
     <!-- saf -->
</body>
</html>