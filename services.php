<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <script src="script.js" defer></script>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kalnia:wght@100..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="services.css">
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow-x: hidden;
            scroll-behavior: smooth;
        }

        #mains {
            background-image: url('./mainImg/32.jpg');
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

        #scrollArrow {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 40px;
            color: white;
            cursor: pointer;
            animation: bounce 1.5s infinite;
            transition: color 0.3s;
        }

        #scrollArrow:hover {
            color: #ffcc00;
            /* Highlight color on hover */
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateX(-50%) translateY(0);
            }

            50% {
                transform: translateX(-50%) translateY(15px);
            }
        }

        #break {
            width: 100%;
            height: 500px;
            background-image: url('./mainImg/11.jpg');
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
        }

        #contactDivWrapper {
            padding-top: 100px;
            padding-bottom: 100px;
        }

        #topbar {
            border-radius: 20px;
            width: 100%;
            height: 80px;
            /* Set a fixed height if you want the top bar to maintain a specific height */
            /* margin-top: -120px; */
        }

        #btndivformargin {
            margin-top: 50px;
        }

        #fon2 {
            background-size: cover;
            /* line-height: 600px; */
            font-size: 80px;
            text-align: center;
            height: 60;
            /* Moves it down 600px */
        }

    </style>
</head>

<body>

    <div id="mains">
        <div id="topbar">
            <?php
            include 'topbar.php';
            renderHeader();
            ?>
        </div>

        <h1 id="fon2" style="color:white; margin-top:50px;">OUR SERVICES</h1>

        <!-- Scroll Arrow -->
        <div id="scrollArrow" onclick="scrollToContent()">
            <i class="fas fa-chevron-down"></i>
        </div>
    </div>

    <div id="fon">
        <div class="servicesDiv">
            <div id="servicesText">
                <h1>Services</h1> <br>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia vel animi explicabo libero
                    obcaecati dignissimos non sit veniam dolore enim ea at, esse aperiam delectus laudantium. Minima
                    omnis fugit nostrum!</p> <br>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorem a explicabo consequatur ducimus
                    fugit harum itaque eos atque quaerat aperiam voluptate facilis est, facere quibusdam iure,
                    dignissimos odio, exercitationem excepturi?</p>
                <div id="btndivformargin"><a href="./projects.php" class="btn" id="btn">VIEW OUR PROJECTS</a></div>
            </div>
            <div id="displayImage">
                <img src="./mainImg/office2_0002.jpg" alt="">
            </div>
        </div>
    </div>

    <div id="break"></div> <!-- Parallax Section -->

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

    <script>
        // Parallax Effect
        window.addEventListener('scroll', function () {
            const breakSection = document.getElementById('break');
            let offset = window.pageYOffset;
            breakSection.style.backgroundPositionY = offset * 0.5 + 'px';
        });

        // Smooth Scroll
        function scrollToContent() {
            const targetSection = document.getElementById('fon');
            targetSection.scrollIntoView({ behavior: 'smooth' });
        }
        document.addEventListener("scroll", function () {
            const breakSection = document.getElementById("break");
            let scrollPosition = window.scrollY;
            breakSection.style.backgroundPositionY = (scrollPosition * 0.5) + "px";
        });

    </script>
</body>

</html>