<?php
require_once "db.php";
if (isset($_GET["id"])) {
     $id = $_GET["id"];
     $photos = getphotos($id);
     $pic = !empty($photos) ? $photos[0]['path'] : '';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Home Page</title>
     <script defer src="script.js"></script>
     <link rel="stylesheet" href="style.css">
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Kalnia:wght@100..700&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
     <link rel="stylesheet" href="services.css">
     <style>
          body {
               background-color: white;
          }

          #gallery-container {
               padding-top: 50px;
               display: flex;
               margin: 0 auto;
               text-align: center;
               align-items: center;
               padding-left: 100px;
               padding-right: 100px;
               max-height: 700px;
               height: 700px;
               overflow: hidden;
          }

          #displayImage {
               position: relative;
               width: 100%;
               height: 700px;
               display: flex;
               align-items: center;
               justify-content: center;
               overflow: hidden;
          }
          #displayImage img {
               position: absolute;
               max-height: 700px;
               height: 700px;
               width: auto;
               object-fit: cover;
               top: 0;
               left: 0;
               transition: opacity 0.2s ease-in-out;
               max-width: none;
               /* Ensure images don't scale down */
          }

          #mainImage {
               z-index: 1;
               opacity: 1;
          }

          #nextImage {
               z-index: 2;
               opacity: 0;
          }

          .nav-arrow {
               color: rgb(70, 70, 70);
               font-size: 24px;
               cursor: pointer;
               text-decoration: none;
               padding: 10px;
          }
     </style>

</head>

<body>
     <div id="mains">
          <?php
          include 'topbar.php';
          renderHeader();
          ?>
     </div>

     <div id="gallery-container">
          <a href="#" class="nav-arrow prev" onclick="showPrevImage(event)">&#9665;</a>
          <div id="displayImage">
               <img id="mainImage" src="<?= $pic; ?>" alt="Displayed Image">
               <img id="nextImage" src="" alt="Next Image">
          </div>
          <a href="#" class="nav-arrow next" onclick="showNextImage(event)">&#9655;</a>
     </div>

     <script>
          document.addEventListener("DOMContentLoaded", function () {
               let images = <?php echo json_encode(array_column($photos, 'path')); ?>;
               let currentIndex = 0;
               const mainImage = document.getElementById("mainImage");
               const nextImage = document.getElementById("nextImage");
               let isTransitioning = false;

               function crossFade(newIndex) {
                    if (isTransitioning) return;
                    isTransitioning = true;

                    nextImage.src = images[newIndex];
                    nextImage.style.opacity = 1;

                    setTimeout(() => {
                         mainImage.src = images[newIndex];
                         nextImage.style.opacity = 0;
                         currentIndex = newIndex;
                         isTransitioning = false;
                    }, 200);
               }

               function updateImage(index) {
                    const newIndex = (index + images.length) % images.length;
                    crossFade(newIndex);
               }

               function showNextImage(e) {
                    e.preventDefault();
                    updateImage(currentIndex + 1);
               }

               function showPrevImage(e) {
                    e.preventDefault();
                    updateImage(currentIndex - 1);
               }

               document.addEventListener("keydown", function (event) {
                    if (event.key === "ArrowRight") {
                         showNextImage(event);
                    } else if (event.key === "ArrowLeft") {
                         showPrevImage(event);
                    }
               });
          });
     </script>
</body>

</html>