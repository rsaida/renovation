<?php
// renderemaildiv.php

// Include the sendEmail function from sendemail.php
require_once 'sendemail.php';

/**
 * Renders the contact form.
 */
function renderEmailDiv() {
    echo '


    <style>
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
            #submitpopupContent{
                padding: 0rem 3rem;
                width: 75%;
            }
            #submitpopupContent {
                padding: 2rem 2rem;
            }
        }
    </style>

    <div id="contactDivWrapper">
        <div id="contactDiv">
            <h3>Contact Us</h3>
            <form action="" method="post" id="contactForm">
                <input type="text" id="name" name="name" class="inputForm" placeholder="Full Name" required>
                <input type="email" id="email" name="email" class="inputForm" placeholder="E-mail" required>
                <textarea id="message" name="message" class="inputForm" placeholder="Message" required></textarea>
                <input type="submit" name="submit" value="SUBMIT" class="btn" id="submitBtn">
            </form>
        </div>
    </div>

    <div id="submitpopup">
        <div id="submitpopupContent">
            <button id="closePopupBtn">&times;</button>
            <img src="./icons/heart.svg" alt="Heart Icon" style="max-height: 40px; max-width: 40px; margin-bottom: 5px;">
            <h1 style="margin-bottom: 10px;"><strong>Thank you</strong></h1>
            <h3>Your email is successfully submitted.<br>Check your inbox for future updates.</h3>
        </div>
    </div>

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
';
}

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
            window.addEventListener("load", function () {
                document.getElementById("submitpopup").classList.add("show");
            });
        </script>';
    }
}
?>
