<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <!-- <script src="script.js">
    </script> -->
    <link rel="stylesheet" href="services.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kalnia:wght@100..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="services.css">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400..800;1,400..800&display=swap" rel="stylesheet">
    <style>
        /* *{
            border: 1px solid black;
        } */
        p,span,div,h1,h2,h3,h5,h5,a,body{
            color: rgb(70, 70, 70); 
            font-family: 'EB Garamond';
            font-weight: 400;
        }
        #servicesDiv{
            display: flex;
            margin: auto;
            align-items: center;
            padding: 5%;
            gap: 5%;
            width: 80%;
            height: 500pxs;
            /* border: 1px solid red; */
        }
        #final {
            margin: auto;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.4);
        }
        #displayImage{
            width: 55%;
        }
        #servicesText{
            width: 40%;
            height: 500px;
            font-size: 20px;
            /* border: 1px solid green; */
        }
        img{
            height: 500px;
            width: auto;
            object-fit: cover;
            margin-bottom: 30px;
        }
        #mains{
            padding-top: 20px;
            /* background-color: rgba(140, 120, 90, 50%); */
            height: 100%;
        }
        
        h1{
            margin-top: 0;
            /* border: 1px solid red; */
        }
        #viewProjects{
            width: 100%;
        }
        #main{background-image: url('./mainImg/dom1_0003.jpg'); background-position: 20% 40%; min-height: 100vh;}
        body{ background-color: white;color: rgb(70, 70, 70);}
    </style>
</head>
<body>
    <div id="main">
        <?php
            include 'topbar.php';
            renderHeader();
        ?>
        <div id="fon2" style="color:white;">
          WE ARE MELIÉ WE ARE MELIÉ 
        </div>
    </div>
    <div id="servicesDiv">
        <div id="servicesText"style="text-align: left;">
            <h1 >About us</h1> <br>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia vel animi explicabo libero obcaecati dignissimos non sit veniam dolore enim ea at, esse aperiam delectus laudantium. Minima omnis fugit nostrum!</p> <br>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorem a explicabo consequatur ducimus fugit harum itaque eos atque quaerat aperiam voluptate facilis est, facere quibusdam iure, dignissimos odio, exercitationem excepturi?</p>
            <br><br><a href="./projects.php" class="btn" id="btn">VIEW OUR PROJECTS</a>
        </div>
            <div id="displayImage">
            <img src="./mainImg/32.jpg" alt="">
            <!-- <input type="button" value="VIEW OUR PROJECTS" id="viewProjects" class="btn"> -->
            <!-- <a href="./projects.php" class="btn">VIEW OUR PROJECTS</a> -->
        </div>
    </div>
    <div id="final">
        <div id="servicesDiv">
            <div id="displayImage">
                <img src="./mainImg/office2_0002.jpg" alt="">
                <!-- <input type="button" value="VIEW OUR PROJECTS" id="viewProjects" class="btn"> -->
                <!-- <a href="./projects.php" class="btn">VIEW OUR PROJECTS</a> -->
            </div>
            <div id="servicesText"style="text-align: right;">
                <h1 >About us</h1> <br>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia vel animi explicabo libero obcaecati dignissimos non sit veniam dolore enim ea at, esse aperiam delectus laudantium. Minima omnis fugit nostrum!</p> <br>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorem a explicabo consequatur ducimus fugit harum itaque eos atque quaerat aperiam voluptate facilis est, facere quibusdam iure, dignissimos odio, exercitationem excepturi?</p>
                <br><br><a href="./projects.php" class="btn" id="btn">VIEW OUR PROJECTS</a>
            </div>
        </div>
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
</body>
</html>
