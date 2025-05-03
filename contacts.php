<?php
// Include necessary files for email functionality
require_once 'sendemail.php'; // Make sure this file exists with your sendEmail function
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400..800;1,400..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body, html {
            font-family: 'EB Garamond', serif;
            height: 100%;
        }
        
        .page-container {
            display: flex;
            height: 100vh;
            width: 100%;
        }
        
        .contact-image {
            flex: 0.7;
            background-image: url('./projects/Dubai Project/35.jpg');
            background-size: cover;
            background-position: center;
            position: relative;
            height: 100vh;
        }
        
        .form-container {
            flex: 0.3;
            display: flex;
            flex-direction: column;
            padding: 2.5rem 2.5rem;
            background: rgba(228,224,219);
            height: 100vh;
            overflow-y: auto;
            position: relative; /* Add this for positioning */
        }
        
        .contact-header {
            margin-bottom: 1.2rem;
        }
        
        .contact-header h1 {
            font-size: 2.2rem;
            font-weight: 400;
            margin-bottom: 0.5rem;
            color: #333;
        }
        
        .contact-header p {
            font-size: 0.95rem;
            color: #666;
            line-height: 1.4;
        }
        
        .form-group {
            margin-bottom: 1rem;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.2rem;
            font-size: 1rem;
            color: #555;
        }
        
        .form-control {
            width: 100%;
            padding: 0.5rem 0;
            font-size: 1rem;
            border: none;
            border-bottom: 1px solid #999;
            background: transparent;
            transition: border-color 0.3s;
        }
        
        .form-control:focus {
            outline: none;
            border-bottom: 1px solid #333;
        }
        
        textarea.form-control {
            min-height: 80px;
            resize: vertical;
        }
        
        .submit-btn {
            display: inline-block;
            background: #333;
            color: #fff;
            border: none;
            padding: 0.7rem 1.8rem;
            font-size: 0.9rem;
            cursor: pointer;
            transition: background 0.3s;
            font-family: 'EB Garamond', serif;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 1rem;
        }
        
        .submit-btn:hover {
            background: #555;
        }
        
        .form-content {
            flex: 1; /* Take available space */
        }
        
        .contact-info {
            margin-top: auto; /* Push to bottom */
            padding-top: 1.5rem;
            border-top: 1px solid rgba(0,0,0,0.1);
        }
        
        .info-item {
            margin-bottom: 0.7rem;
        }
        
        .info-item h3 {
            font-size: 1.1rem;
            margin-bottom: 0.2rem;
            font-weight: 500;
            color: #333;
        }
        
        .info-item p, .info-item a {
            color: #666;
            text-decoration: none;
            font-size: 0.9rem;
            line-height: 1.3;
        }
        
        .info-item a:hover {
            color: #333;
        }
        
        /* Navigation Links Styles */
        .site-links {
            margin-top: 1rem;
            padding-top: 0.7rem;
            border-top: 1px solid rgba(0,0,0,0.1);
        }
        
        .site-links h3 {
            font-size: 1.1rem;
            margin-bottom: 0.3rem;
            font-weight: 500;
            color: #333;
        }
        
        .site-links-container {
            display: flex;
            flex-wrap: wrap;
        }
        
        .site-links-container a {
            color: #666;
            text-decoration: none;
            font-size: 0.9rem;
            margin-right: 1rem;
            margin-bottom: 0.3rem;
        }
        
        .site-links-container a:hover {
            color: #333;
            text-decoration: underline;
        }
        
        /* Success Popup */
        .success-popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }
        
        .popup-content {
            background: #fff;
            padding: 2.5rem;
            border-radius: 0;
            max-width: 400px;
            text-align: center;
            position: relative;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        .popup-close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 1.2rem;
            background: none;
            border: none;
            cursor: pointer;
            color: #999;
        }
        
        .popup-icon {
            font-size: 2rem;
            color: #4CAF50;
            margin-bottom: 1rem;
        }
        
        .popup-title {
            font-size: 1.8rem;
            margin-bottom: 0.8rem;
            color: #333;
        }
        
        .popup-message {
            font-size: 1rem;
            color: #666;
            line-height: 1.6;
        }
        
        .success-popup.show {
            display: flex;
        }
        
        /* Mobile Responsiveness */
        @media (max-width: 992px) {
            .page-container {
                flex-direction: column;
                height: auto;
                overflow-y: auto;
            }
            
            .contact-image {
                height: 40vh;
                min-height: 300px;
                flex: none;
            }
            
            .form-container {
                padding: 2rem;
                height: auto;
                min-height: 60vh;
                flex: none;
            }
            
            .contact-info {
                margin-top: 2rem; /* Add some margin for mobile */
            }
        }
        
        @media (max-width: 576px) {
            .form-container {
                padding: 1.5rem;
            }
            
            .contact-header h1 {
                font-size: 2rem;
            }
            
            .contact-header p {
                font-size: 0.9rem;
            }
            
            .submit-btn {
                width: 100%;
            }
            
            .popup-content {
                padding: 2rem;
                margin: 1rem;
                max-width: 90%;
            }
        }
    </style>
</head>
<body>
    <div class="page-container">
        <div class="contact-image"></div>
        <div class="form-container">
            <!-- Form content with flex: 1 to take available space -->
            <div class="form-content">
                <div class="contact-header">
                    <h1>Get in Touch</h1>
                    <p>We'd love to hear from you. Fill out the form below and we'll get back to you as soon as possible.</p>
                </div>
                
                <form method="post" class="contact-form">
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Your Message</label>
                        <textarea id="message" name="message" class="form-control" required></textarea>
                    </div>
                    
                    <button type="submit" name="submit" class="submit-btn">SEND MESSAGE</button>
                </form>
            </div>
            
            <!-- Contact info pushed to bottom -->
            <div class="contact-info">
                <div class="info-item">
                    <h3>Email</h3>
                    <p><a href="mailto:info@yourcompany.com">info@yourcompany.com</a></p>
                </div>
                
                <div class="info-item">
                    <h3>Phone</h3>
                    <p><a href="tel:+123456789">+1 (234) 567-890</a></p>
                </div>
                
                <div class="info-item">
                    <h3>Address</h3>
                    <p>123 Business Street, Suite 100<br>City, State 12345</p>
                </div>
                
                <!-- Navigation Links Section -->
                <div class="site-links">
                    <h3>Navigation</h3>
                    <div class="site-links-container">
                        <a href="index.php">HOME</a>
                        <a href="aboutus.php">ABOUT US</a>
                        <a href="services.php">SERVICES</a>
                        <a href="projects.php">PROJECTS</a>
                        <a href="contacts.php">CONTACT US</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Success Popup -->
    <div class="success-popup" id="successPopup">
        <div class="popup-content">
            <button class="popup-close" id="popupClose">&times;</button>
            <div class="popup-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <h2 class="popup-title">Thank You!</h2>
            <p class="popup-message">Your message has been sent successfully. We'll get back to you shortly.</p>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const contactForm = document.querySelector('.contact-form');
            const successPopup = document.getElementById('successPopup');
            const popupClose = document.getElementById('popupClose');
            
            // Store scroll position on form submit
            if (contactForm) {
                contactForm.addEventListener('submit', function() {
                    sessionStorage.setItem('scrollPosition', window.scrollY);
                });
            }
            
            // Restore scroll position and handle popup
            const scrollPosition = sessionStorage.getItem('scrollPosition');
            if (scrollPosition !== null) {
                window.scrollTo(0, parseInt(scrollPosition));
                sessionStorage.removeItem('scrollPosition');
            }
            
            // Close popup when close button is clicked
            if (popupClose) {
                popupClose.addEventListener('click', function() {
                    successPopup.classList.remove('show');
                });
            }
            
            // Close popup when clicking outside the popup content
            successPopup.addEventListener('click', function(e) {
                if (e.target === successPopup) {
                    successPopup.classList.remove('show');
                }
            });
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
                document.getElementById("successPopup").classList.add("show");
            });
        </script>';
    }
}
?>
</body>
</html>