<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <script src="aboutus.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kalnia:wght@100..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="services.css">
    <style>
        #contactDiv {
            margin: auto;
            margin-top: 10%;
            padding-left: 20px;
            padding-right: 20px;
            background: rgba(255, 255, 255, 0.1);
            /* Light transparency */
            backdrop-filter: blur(10px);
            /* Blurs the background behind */
            border-radius: 10px;
            /* Adds rounded corners */
            text-align: center;
            /* Adjust based on your layout */
            color: white;
        }
        * {
    box-sizing: border-box;
}

        body {
            background-image: url('./projects/Dubai Project/35.jpg');
            background-size: cover;
            /* Ensures the image covers the entire background */
            background-position: center center;
            /* Centers the image */
            background-attachment: fixed;
            /* Keeps the background static while scrolling */
        }

        .inputForm {
            color: #fff !important;
            border: none;
            border-bottom: 2px solid #fff !important;
            background: transparent;
        }

        .inputForm:focus {
            border-bottom: 2px solid #fff !important;
        }

        .inputForm::placeholder {
            color: rgba(255, 255, 255, 0.7) !important;
        }
    </style>
</head>

<body>
    <div id="mains">
        <?php
        include 'topbar.php';
        renderHeader();
        ?>
        <div id="contactDiv" style="color: white">
            <h3 style="color: white">Contact Us</h3>
            <form action="#" method="post" id="contactForm" style="color: white;">
                <input type="text" id="name" name="name" class="inputForm" placeholder="Full Name" required>
                <input type="email" id="email" name="email" class="inputForm" placeholder="E-mail" required>
                <textarea id="message" name="message" class="inputForm" placeholder="Message" required></textarea>
                <input type="submit" value="SUBMIT" class="button" id="submitBtn" style="margin-bottom: 15px">
            </form>
        </div>
    </div>
</body>

</html>