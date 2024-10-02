<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <script src="script.js">
    </script>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kalnia:wght@100..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="services.css">
</head>
<body>
    <div id="mains">
        <?php
            include 'topbar.php';
            renderHeader();
        ?>
        <div id="fon">
            <div id="servicesDiv">
                <div id="servicesText">
                    <h1>Services</h1> <br>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia vel animi explicabo libero obcaecati dignissimos non sit veniam dolore enim ea at, esse aperiam delectus laudantium. Minima omnis fugit nostrum!</p> <br>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorem a explicabo consequatur ducimus fugit harum itaque eos atque quaerat aperiam voluptate facilis est, facere quibusdam iure, dignissimos odio, exercitationem excepturi?</p>
                </div>
                <div id="displayImage">
                    <img src="./projects/p1/29.jpg" alt="">
                    <input type="button" value="VIEW OUR PROJECTS" id="viewProjects" class="button">
                </div>
            </div>
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
    </div>
       
    
</body>
</html>
