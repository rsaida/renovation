<?php
     require_once "db.php";
     $photos = getmainphotos();
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Simple Web Page</title>
    <script src="script.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kalnia:wght@100..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="services.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400..800;1,400..800&display=swap" rel="stylesheet">
   
    <style>
          body{
            background-color:rgba(228,224,219);
          }
          p,span,div,h1,h2,h3,h5,h5,a{
               color: gray; 
          }
          table{
               margin: auto;
               border-spacing: 50px;
          }
          tr{
            height: fit-content;
          }
          #final {
            margin: auto;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.4);
            width: fit-content;
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
               width: 350px;
               height: 550px; /* Maintain aspect ratio */
               display: block; /* Remove any space below the image */
               object-fit: cover;
               margin: auto;
          }

          .overlay {
               position: absolute;
               top: 0;
               left: 0;
               right: 0;
               bottom: 0;
               height: 550px;
               /* background-color: rgba(0, 0, 0, 0.5);  */
               background-color: rgba(244, 208, 169, 0.68);
               opacity: 0; /* Initially hidden */
               transition: opacity 0.3s ease; /* Smooth transition */
          }

          .image-container:hover .overlay {
               opacity: 0.5; /* Show overlay on hover */
          }
          .projectName{
            /* border: 1px solid red; */
            text-align: center;
            margin-top: 10px;
          }
          #mains {
            background-image: url('./mainImg/office1_0001.jpg');
            background-size: cover;
            background-position: center;
            width: 100%;
            height: 100vh;
            /* display: flex; */
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
            position: relative;
        }
    </style>
</head>
     <div id="mains">
          <div id="topbar">
               <?php
               include 'topbar.php';
               renderHeader();
               ?>
          </div>
          <div id="scrollArrow" onclick="scrollToContent()">
            <i class="fas fa-chevron-down"></i>
          </div>
    </div>
    <div id="final">
     <?php
               echo "<table>";
               $cnt = 0;
               foreach($photos as $i) {
                    if($cnt % 3 == 0) {
                    echo "<tr>";
                    }
                    echo '<td>';
                    echo '<a href="project.php?id=', $i['project'], '">';
                    echo '<div class="image-container">';  // Wrap img in a div
                    echo '<img src="', $i['path'], '" alt="???picnotloaded???" width="640px" height="300px">';
                    echo '<div class="overlay"></div>';  // Add the overlay div
                    echo '</div>';  // Close the image container
                    echo '</a>';
                    echo '<div class="projectName">', $i['project'], '</div>';
                    // echo '<div class="projectLocation">', $i['project'], '</div>';
                    echo '<div class="breakSign"></div>';
                    echo '</td>';

                    if($cnt % 3 == 2) {
                    echo "</tr>";
                    }
                    $cnt += 1;
               }
               echo "</table>";    
          ?>
    </div>
     
     <!-- saf -->
     <?php
        include_once "footer.php";
        renderFooter();
     ?>
</body>
</html>