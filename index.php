<?php
    require_once "db.php";
    $photos = getmainphotos();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Web Page</title>
    <script src="script.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kalnia:wght@100..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="services.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400..800;1,400..800&display=swap" rel="stylesheet">
    <style>
        body{
            background-color: white;
        }
        p,span,div,h1,h2,h3,h5,h5,a{
            color: gray; 
            font-family: 'EB Garamond';
            font-weight: 400;
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
            padding: 5px;
          }
         
        
        #fon2{
            background-size: cover;
            line-height: 600px;
            font-size: 80px;
            text-align: center;
            height: 600px;
        }
        
        h1 {
            padding-top: 60px;
            text-align: center;
            font-weight: lighter;
            /* font-size: 40px; */
        }
        .projectName{margin-top: 10px;}

    </style>
</head>
<body>
    <div id="main">
        <?php
            include 'topbar.php';
            renderHeader();
        ?>
        <div id="fon"></div>
    </div>
    <div id="indicators">
        <div class="indicator" data-index="0"></div>
        <div class="indicator" data-index="1"></div>
        <div class="indicator" data-index="2"></div>
        <div class="indicator" data-index="3"></div>
    </div>  

    <h1>Catalogue</h1>

    <div id="final">
        <?php
            echo "<table>";
            $cnt = 0;
            foreach($photos as $i) {
                if($cnt < 3) {  // Only display the first 3 items
                    if($cnt % 3 == 0) {  // Start a new row after every 3 items
                        echo "<tr>";
                    }

                    echo '<td>';
                    echo '<a href="project.php?id=', $i['project'], '">';
                    echo '<div class="image-container">';
                    echo '<img src="', $i['path'], '" alt="???picnotloaded???" width="640px" height="300px">';
                    echo '<div class="overlay"></div>';
                    echo '</div>';
                    echo '</a>';
                    echo '<div class="projectName">', $i['project'], '</div>';
                    echo '</td>';

                    if($cnt % 3 == 2) {
                        echo "</tr>";
                    }

                    $cnt += 1;
                }
            }
            echo "</table>";
        ?>
    <div class="btn"><a href="./projects.php">EXPLORE</a></div>
    </div>
    <div id="contactDivWrapper">
        <div id="contactDiv">
             <h3>Contact Us</h3>
             <form action="#" method="post" id="contactForm">
                
                     <input type="text" id="name" name="name" class="inputForm" placeholder="Full Name" required>
                 
                     <input type="email" id="email" name="email" class="inputForm" placeholder="E-mail" required>
                 
                     <textarea id="message" name="message" class="inputForm" placeholder="Message" required></textarea>
               
                     <input type="submit" value="SUBMIT" class="btn" id="submitBtn">
             
             </form>
        </div>
    </div>
    <?php
        include_once "footer.php";
        renderFooter();
    ?>
</body>
</html>
