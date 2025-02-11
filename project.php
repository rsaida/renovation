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
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
               transition: opacity 0.2s ease-in-out;
               max-width: none;
               left: 50%;
               transform: translateX(-50%);
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
          #exitView{
               color: rgb(70, 70, 70);
               margin-top: 30px;
               margin-right: 100px;
               width: fit-content;
          }
          #exitView svg{
               margin-right: 100px;
               position: relative;
               left: 93%;
               top: 25px;
          }

     </style>
</head>
<body>
     <!-- <a href="./projects.php" id="exitView"><i class="fa-solid fa-xmark"></i></a>
 -->
     <!-- <a href="./projects.php" id="exitView">&#10005;</a> -->
     <div id="exitViewWrapper">
          <a href="./projects.php" id="exitView">
          <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" stroke="none" width="40" height="40" viewBox="0 0 24 24">
               <path d="M18 6L6 18M6 6l12 12" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          </a>
     </div>


     <div id="gallery-container">
    <!-- Previous Arrow -->
     <a href="#" class="nav-arrow prev">
          <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" stroke="none" width="15" height="30" viewBox="0 0 15 27">
               <path fill-rule="nonzero" d="M14.258 1.53L13.198.47-.061 13.728l13.259 13.258 1.06-1.06L2.061 13.728z"></path>
          </svg>
     </a>

     <!-- Image Display -->
     <div id="displayImage">
          <img id="mainImage" src="<?= $pic; ?>" alt="Displayed Image">
          <img id="nextImage" src="" alt="Next Image">
     </div>

     <!-- Next Arrow -->
     <a href="#" class="nav-arrow next">
          <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" stroke="none" width="15" height="30" viewBox="0 0 15 27">
               <path fill-rule="nonzero" d="M.198 25.926l1.06 1.06 13.259-13.258L1.258.47.198 1.53l12.197 12.198z"></path>
          </svg>
     </a>
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

               document.querySelector(".next").addEventListener("click", showNextImage);
               document.querySelector(".prev").addEventListener("click", showPrevImage);

               document.addEventListener("keydown", function (event) {
                    if (event.key === "ArrowRight") {
                         updateImage(currentIndex + 1);
                    } else if (event.key === "ArrowLeft") {
                         updateImage(currentIndex - 1);
                    }
               });
          });
     </script>
</body>
</html>
