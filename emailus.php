<?php
// Include the sendEmail function from sendemail.php
require_once 'sendemail.php';

/**
 * Renders the contact form.
 */
function renderemaildiv() {
    echo '
    <style>
        /* Contact container styles */
        #sendEmailContactDivWrapper {
            width: 100%;
            background: url(\'mainImg/dom1_0003.jpg\') no-repeat center center; /* Your image path */
            background-size: cover;
            position: relative;
            display: block; /* Ensures normal flow in the document */
            overflow: hidden; /* Prevents any potential overflow issues */
            margin-bottom: 0; /* Removes any bottom margin */
        }
        
        /* Overlay for better text visibility */
        #sendEmailContactDivWrapper::before {
            content: \'\';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            z-index: 1;
            pointer-events: none; /* Ensures we can click through the overlay */
        }
        
        /* Main content container */
        #sendEmailContactDiv {
            max-width: 1200px;
            margin: 0 auto;
            padding: 3rem 2rem; /* Reduced padding for more compact height */
            text-align: center;
            color: white;
            position: relative;
            z-index: 2;
        }
        
        /* Main heading style */
        #sendEmailContactDiv h1 {
            color: white;
            font-size: 3rem;
            margin-bottom: 1.5rem;
            font-weight: 300;
            letter-spacing: 3px;
        }
        
        /* Contact description text */
        #sendEmailContactDiv p {
            color: white;
            font-size: 1.2rem;
            margin-bottom: 2.5rem;
        }
        
        /* Form container */
        #sendEmailContactForm {
            max-width: 800px;
            margin: 0 auto;
        }
        
        /* Name-email row container */
        .sendEmailFormRow {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 1rem;
        }
        
        /* Individual input styling */
        .sendEmailInputForm {
            padding: 15px 20px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            font-size: 1rem;
            outline: none;
            width: 100%;
            box-sizing: border-box;
        }
        
        /* Input placeholder color */
        .sendEmailInputForm::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }
        
        /* Name and email inputs take equal width */
        .sendEmailFormRow .sendEmailInputForm {
            width: calc(50% - 10px);
        }
        
        /* Textarea container */
        .sendEmailTextareaContainer {
            margin-bottom: 1rem;
        }
        
        /* Textarea specific styles */
        #sendEmailMessage {
            min-height: 120px;
            resize: vertical;
            display: block;
            width: 100%;
        }
        
        /* Submit button container */
        .sendEmailBtnContainer {
            text-align: center;
        }
        
        /* Submit button */
        .sendEmailBtn {
            padding: 15px 40px;
            background-color: rgb(255, 255, 255, 0.7);
            font-family: "EB Garamond";
            color: #333;
            border: none;
            font-size: 1rem;
            cursor: pointer;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            width: 200px;
        }
        
        /* Button hover effect */
        .sendEmailBtn:hover {
            background-color: #f0f0f0;
        }
        
        /* Thank you popup styles */
        #sendEmailSubmitpopup {
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

        /* Popup content container */
        #sendEmailSubmitpopupContent {
            position: fixed;
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 3rem 3rem;
            border-radius: 0px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }
        
        /* Close button for popup */
        #sendEmailClosePopupBtn {
            position: absolute;
            top: 10px;
            right: 15px;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #333;
        }
        
        /* Class to show the popup */
        #sendEmailSubmitpopup.show {
            display: flex;
        }
        
        /* Responsive design for mobile devices */
        @media screen and (max-width: 768px) {
            #sendEmailContactDiv h1 {
                font-size: 2.2rem;
            }
            
            .sendEmailFormRow {
                flex-direction: column;
                gap: 1rem;
            }
            
            .sendEmailFormRow .sendEmailInputForm {
                width: 100%;
            }
            
            .sendEmailBtn {
                width: 100%;
            }
            
            #sendEmailSubmitpopupContent {
                padding: 2rem 2rem;
                width: 80%;
            }
        }
    </style>

    <div id="sendEmailContactDivWrapper">
        <div id="sendEmailContactDiv">
            <h1>REACH OUT TO US</h1>
            <p>Have a question or want to get in touch? Fill out the form below and we will get back to you soon.</p>
            <form action="" method="post" id="sendEmailContactForm">
                <div class="sendEmailFormRow">
                    <input type="text" id="sendEmailName" name="name" class="sendEmailInputForm" placeholder="Full Name" required>
                    <input type="email" id="sendEmailEmail" name="email" class="sendEmailInputForm" placeholder="E-mail" required>
                </div>
                <div class="sendEmailTextareaContainer">
                    <textarea id="sendEmailMessage" name="message" class="sendEmailInputForm" placeholder="Message" required></textarea>
                </div>
                <div class="sendEmailBtnContainer">
                    <input type="submit" name="submit" value="SUBMIT" class="sendEmailBtn" id="sendEmailSubmitBtn">
                </div>
            </form>
        </div>
    </div>

    <div id="sendEmailSubmitpopup">
        <div id="sendEmailSubmitpopupContent">
            <button id="sendEmailClosePopupBtn">&times;</button>
            <img src="./icons/heart.svg" alt="Heart Icon" style="max-height: 40px; max-width: 40px; margin-bottom: 5px;">
            <h1 style="margin-bottom: 10px;"><strong>Thank you</strong></h1>
            <h3>Your email is successfully submitted.<br>Check your inbox for future updates.</h3>
        </div>
    </div>

    <script>
    const sendEmailContactForm = document.getElementById("sendEmailContactForm");
    const sendEmailSubmitpopup = document.getElementById("sendEmailSubmitpopup");

    sendEmailContactForm.addEventListener("submit", function () {
        sessionStorage.setItem("scrollPosition", window.scrollY);
    });

    window.addEventListener("load", function () {
        const scrollPosition = sessionStorage.getItem("scrollPosition");
        if (scrollPosition !== null) {
            window.scrollTo(0, parseInt(scrollPosition));
            sessionStorage.removeItem("scrollPosition");
        }

        const sendEmailCloseBtn = document.getElementById("sendEmailClosePopupBtn");
        if (sendEmailCloseBtn) {
            sendEmailCloseBtn.addEventListener("click", function () {
                sendEmailSubmitpopup.style.display = "none";
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
                document.getElementById("sendEmailSubmitpopup").classList.add("show");
            });
        </script>';
    }
}
?>