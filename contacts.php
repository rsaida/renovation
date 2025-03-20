<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
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
        #contactDiv {
            margin: auto;
            margin-top: 7%;
            padding-left: 20px;
            padding-right: 20px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            border-radius: 10px;
            text-align: center;
            color: white;
            height: 350px;
        }
        #asd {
            margin-top: 135px;
        }
        body {
            background-image: url('./projects/Dubai Project/35.jpg');
            background-size: cover;
            background-position: center top;
            background-attachment: fixed;
            min-height: 100vh;
        }
        .inputForm {
            color: #fff !important;
            border: none;
            border-bottom: 2px solid #fff !important;
            background: transparent;
            transition: color 0.3s ease, border-bottom 0.3s ease;
        }
        .inputForm:focus {
            border-bottom: 2px solid #fff !important;
            outline: none;
        }
        .inputForm::placeholder {
            color: rgba(255, 255, 255, 0.7) !important;
        }
        .inputForm:hover {
            color: beige !important;
            border-bottom: 2px solid rgba(228, 224, 219) !important;
        }
        .mobile-only {
            display: none;
        }
        @media screen and (max-width: 600px) {
            #contactDiv {
                width: 90%;
                margin-top: 15%;
                padding-left: 10px;
                padding-right: 10px;
            }
            #contactDiv h3 {
                font-size: 1.4rem;
            }
            #contactForm {
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            #contactForm input[type="text"],
            #contactForm input[type="email"],
            #contactForm textarea {
                width: 100%;
                margin-bottom: 15px;
                font-size: 1rem;
            }
            .mobile-only {
                display: block;
            }
            body {
                background-size: cover;
                background-position: top;
                background-attachment: scroll;
                min-height: 100vh;
                overflow-y: auto;
            }
            #idk {
                position: relative;
                top: -600px;
            }
        }
    </style>
</head>
<body>
    <div id="main">
        <?php
        include 'topbar.php';
        renderHeader();
        ?>
    </div>
    <div id="idk">
        <div id="contactDiv" style="color: white">
            <br class="mobile-only">
            <h3 style="color: white">Contact Us</h3>
            <form action="#" method="post" id="contactForm" style="color: white;">
                <input type="text" id="name" name="name" class="inputForm" placeholder="Full Name" required>
                <input type="email" id="email" name="email" class="inputForm" placeholder="E-mail" required>
                <textarea id="message" name="message" class="inputForm" placeholder="Message" required></textarea>
                <input type="submit" value="SUBMIT" class="button" id="submitBtn" style="margin-bottom: 15px">
            </form>
        </div>
    </div>
    <div id="asd"></div>
</body>
</html>
