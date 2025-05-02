<?php
require_once 'sendemail.php'; 
?>
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
        /* Add styles for the popup message */
        #submitpopup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(2px);
            align-items: center;
            justify-content: center;
            text-align: center;
            z-index: 9999;
        }

        #submitpopupContent {
            position: fixed;
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 3rem 3rem;
            border-radius: 0px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }
        #closePopupBtn {
            position: absolute;
            top: 10px;
            right: 15px;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #333;
        }
        #submitpopup.show {
            display: flex;
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
            #submitpopupContent{
                padding: 0rem 3rem;
                width: 75%;
            }
            #submitpopupContent {
                padding: 2rem 2rem;
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
            <form action="" method="post" id="contactForm" style="color: white;">
                <input type="text" id="name" name="name" class="inputForm" placeholder="Full Name" required>
                <input type="email" id="email" name="email" class="inputForm" placeholder="E-mail" required>
                <textarea id="message" name="message" class="inputForm" placeholder="Message" required></textarea>
                <input type="submit" name="submit" value="SUBMIT" class="button" id="submitBtn" style="margin-bottom: 15px">
            </form>
        </div>
    </div>

    <!-- Add the popup for submission confirmation -->
    <div id="submitpopup">
        <div id="submitpopupContent">
            <button id="closePopupBtn">&times;</button>
            <img src="./icons/heart.svg" alt="Heart Icon" style="max-height: 40px; max-width: 40px; margin-bottom: 5px;">
            <h1 style="margin-bottom: 10px;"><strong>Thank you</strong></h1>
            <h3>Your email is successfully submitted.<br>Check your inbox for future updates.</h3>
        </div>
    </div>

    <div id="asd"></div>

    <script>
        const contactForm = document.getElementById("contactForm");
        const submitPopup = document.getElementById("submitpopup");

        contactForm.addEventListener("submit", function () {
            sessionStorage.setItem("scrollPosition", window.scrollY);
        });

        window.addEventListener("load", function () {
            const scrollPosition = sessionStorage.getItem("scrollPosition");
            if (scrollPosition !== null) {
                window.scrollTo(0, parseInt(scrollPosition));
                sessionStorage.removeItem("scrollPosition");
            }

            const closeBtn = document.getElementById("closePopupBtn");
            if (closeBtn) {
                closeBtn.addEventListener("click", function () {
                    submitPopup.style.display = "none";
                });
            }
        });
    </script>

<?php
// Check if the form is submitted and process the data
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Retrieve form data (additional sanitization can be added as needed)
    $name    = trim($_POST['name'] ?? 'No Name');
    $email   = trim($_POST['email'] ?? 'No Email');
    $message = trim($_POST['message'] ?? 'No Message');

    // Create email subject and body
    $subject = 'New Contact Form Submission from ' . $name;
    $body    = "You have received a new message from your contact form:\n\n";
    $body   .= "Name: " . $name . "\n";
    $body   .= "Email: " . $email . "\n";
    $body   .= "Message:\n" . $message;

    // Call the sendEmail function to send the email
    if (sendEmail($subject, $body)) {
        echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                document.getElementById("submitpopup").classList.add("show");
            });
        </script>';
    }
}
?>
</body>
</html>