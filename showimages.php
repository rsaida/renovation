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
  <title>Gallery</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Kalnia:wght@100..700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    
    body {
      font-family: Arial, sans-serif;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      width: 100vw;
      overflow: hidden;
    }

    #exitView {
      position: absolute;
      top: 15px;
      right: 15px;
      cursor: pointer;
      z-index: 20;
    }

    #exitView svg {
      width: 35px;
      height: 35px;
      color: black;
    }

    #gallery-container {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 100vw;
      height: 100vh;
      position: relative;
      overflow: hidden;
    }

    .nav-arrow {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      font-size: 30px;
      color: black;
      cursor: pointer;
      padding: 15px;
      z-index: 10;
    }

    .nav-arrow.prev { left: 10px; }
    .nav-arrow.next { right: 10px; }

    #displayImage {
      position: relative;
      width: 100%;
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }

    #displayImage img {
      max-width: 100%;
      max-height: 100%;
      object-fit: contain;
      transition: opacity 0.5s ease-in-out;
      position: absolute;
      opacity: 0;
    }

    #displayImage img.active {
      opacity: 1;
    }

    @media (max-width: 768px) {
      .nav-arrow {
        font-size: 25px;
        padding: 10px;
      }
      #exitView svg {
        width: 30px;
        height: 30px;
      }
    }
  </style>
</head>
<body>

  <a href="./project.php?id=<?= htmlspecialchars($id, ENT_QUOTES) ?>" id="exitView">
    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" stroke="none" viewBox="0 0 24 24">
      <path d="M18 6L6 18M6 6l12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
  </a>

  <div id="gallery-container">
    <a href="#" class="nav-arrow prev">
      <i class="fas fa-chevron-left"></i>
    </a>
    <div id="displayImage">
      <img id="image1" class="active" src="<?= htmlspecialchars($pic, ENT_QUOTES) ?>" alt="">
      <img id="image2" src="" alt="">
    </div>
    <a href="#" class="nav-arrow next">
      <i class="fas fa-chevron-right"></i>
    </a>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      let images = <?php echo json_encode(array_column($photos, 'path')); ?>;
      if (!images || !images.length) images = ['<?= htmlspecialchars($pic, ENT_QUOTES) ?>'];

      let currentIndex = 0;
      const image1 = document.getElementById("image1");
      const image2 = document.getElementById("image2");
      let showingImage1 = true;

      function showImage(index) {
        index = (index + images.length) % images.length;
        if (showingImage1) {
          image2.src = images[index];
          image2.classList.add("active");
          image1.classList.remove("active");
        } else {
          image1.src = images[index];
          image1.classList.add("active");
          image2.classList.remove("active");
        }
        showingImage1 = !showingImage1;
        currentIndex = index;
      }

      document.querySelector(".next").addEventListener("click", function(e) {
        e.preventDefault();
        showImage(currentIndex + 1);
      });

      document.querySelector(".prev").addEventListener("click", function(e) {
        e.preventDefault();
        showImage(currentIndex - 1);
      });

      document.addEventListener("keydown", function(e) {
        if (e.key === "ArrowRight") showImage(currentIndex + 1);
        if (e.key === "ArrowLeft") showImage(currentIndex - 1);
        if (e.key === "Escape") window.location.href = document.getElementById("exitView").href;
      });

      let touchStartX = 0;
      let touchEndX = 0;

      document.getElementById("gallery-container").addEventListener("touchstart", function(e) {
        touchStartX = e.touches[0].clientX;
      });

      document.getElementById("gallery-container").addEventListener("touchend", function(e) {
        touchEndX = e.changedTouches[0].clientX;
        if (touchStartX - touchEndX > 50) showImage(currentIndex + 1); 
        if (touchEndX - touchStartX > 50) showImage(currentIndex - 1);
      });
    });
  </script>

</body>
</html>
