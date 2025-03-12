<?php
require_once "db.php";
if (isset($_GET["id"])) {
  $projectId = $_GET["id"];
  $photos = getphotos($projectId);
  $pic = !empty($photos) ? $photos[0]['path'] : '';
  $description = getDescription($projectId);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Project</title>
  <style>
    .carousel {
      position: relative;
      overflow: hidden;
      width: 100%;
      margin-top: 50px;
    }

    .carousel-track {
      display: flex;
      will-change: transform;
    }

    .carousel-track img {
      height: 600px;
      width: auto;
      margin-right: 10px;
      cursor: pointer;
    }

    .arrow {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      font-size: 2em;
      background: rgba(0, 0, 0, 0.5);
      color: #fff;
      padding: 10px;
      cursor: pointer;
      z-index: 1;
      user-select: none;
    }

    #leftArrow {
      left: 10px;
    }

    #rightArrow {
      right: 10px;
    }

    .project-info {
      max-width: 1200px;
      margin: 50px auto;
      padding: 0 20px;
      font-family: sans-serif;
    }

    .project-info h2 {
      font-size: 2rem;
      margin-bottom: 20px;
    }

    .project-info p {
      line-height: 1.6;
      margin-bottom: 20px;
    }

    .project-details {
      display: flex;
      flex-wrap: wrap;
      gap: 40px;
      margin-top: 30px;
    }

    .project-details>div {
      flex: 1 1 200px;
    }

    .project-details h4 {
      font-weight: bold;
      margin-bottom: 10px;
    }

    @media (max-width: 768px) {
      .carousel-track img {
        height: 300px;
      }
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
  <div class="carousel">
    <div class="arrow" id="leftArrow">&#10094;</div>
    <div class="arrow" id="rightArrow">&#10095;</div>
    <div class="carousel-track" id="carouselTrack">
      <?php if (!empty($photos)): ?>
        <?php foreach ($photos as $index => $photo): ?>
          <img src="<?= $photo['path'] ?>" alt="<?= htmlspecialchars($photo['project'], ENT_QUOTES) ?>"
            data-index="<?= $index ?>">
        <?php endforeach; ?>
        <?php foreach ($photos as $index => $photo): ?>
          <img src="<?= $photo['path'] ?>" alt="<?= htmlspecialchars($photo['project'], ENT_QUOTES) ?>"
            data-index="<?= $index ?>">
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
  <div class="project-info">
    <h2><?= htmlspecialchars($projectId, ENT_QUOTES) ?></h2>
    <p><?= $description ?></p>
    <div class="project-details">
      <div>
        <h4>Project Location</h4>
        <p><?= getLocation($projectId) ?></p>
      </div>
      <div>
        <h4>Area</h4>
        <p><?= getArea($projectId) ?></p>
      </div>
      <div></div>
    </div>
  </div>
  <script>
    const track = document.getElementById('carouselTrack');
    let autoSpeed = 0.5, currentX = 0, targetX = 0;
    function animate() {
      targetX -= autoSpeed;
      currentX += (targetX - currentX) * 0.1;
      let baseWidth = track.scrollWidth / 2;
      if (currentX < -baseWidth) { currentX += baseWidth; targetX += baseWidth; }
      if (currentX > 0) { currentX -= baseWidth; targetX -= baseWidth; }
      track.style.transform = `translateX(${currentX}px)`;
      requestAnimationFrame(animate);
    }
    document.getElementById('leftArrow').addEventListener('click', () => { targetX += 300; });
    document.getElementById('rightArrow').addEventListener('click', () => { targetX -= 300; });
    animate();
    document.querySelectorAll('#carouselTrack img').forEach(img => {
      img.addEventListener('click', function () {
        let index = this.getAttribute('data-index');
        window.location.href = "showimages.php?id=" + encodeURIComponent("<?= htmlspecialchars($projectId, ENT_QUOTES) ?>") + "&photo=" + index;
      });
    });
  </script>
</body>

</html>