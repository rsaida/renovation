<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <script src="aboutus.js">
    </script>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kalnia:wght@100..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="services.css">
    <style>
        #contactDiv{
            margin: auto;
            margin-top: 10%;
        }
        body{
            background-image: url('./projects/p2/1.jpg');
        }
    </style>
</head>
<body>
    <div id="mains">
        <?php
            include 'topbar.php';
            renderHeader();
        ?>
        <div id="contactDiv">
                <h3>Contact Us</h3>
                <form action="#" method="post" id="contactForm">
                   
                        <input type="text" id="name" name="name" class="inputForm" placeholder="Full Name" required>
                    
                        <input type="email" id="email" name="email" class="inputForm" placeholder="E-mail" required>
                    
                        <textarea id="message" name="message" class="inputForm" placeholder="Message" required></textarea>
                  
                        <input type="submit" value="SUBMIT" class="button" id="submitBtn">
                
                </form>
        </div>
    </div>
    
    <!-- <iframe
    src="https://g.co/kgs/vGrDyAQ"
    width="600"
    height="450"
    frameborder="0"
    style="border:0"
    allowfullscreen>
    </iframe> -->
</body>
</html>
