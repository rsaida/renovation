<?php

// sendemail.php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include Composer's autoloader
require 'vendor/autoload.php';

/**
 * Sends an email using Gmail's SMTP server.
 *
 * @param string $subject The email subject.
 * @param string $body The plain text body of the email.
 * @return bool Returns true if the email was sent successfully, false otherwise.
 */
function sendEmail($subject, $body) {
    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'noreply.melie@gmail.com'; // Your Gmail address
        $mail->Password   = 'fmdk umwy cibl ayfs';        // Your Gmail App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Sender and recipient settings
        $mail->setFrom('noreply.melie@gmail.com', 'Melie');
        $mail->addAddress('sobsherzod@gmail.com', 'Sherzod');

        // Email content settings
        $mail->isHTML(false);
        $mail->Subject = $subject;
        $mail->Body    = $body;

        // Send the email
        $mail->send();
        return true;
    } catch (Exception $e) {
        // Uncomment for debugging:
        // echo "Mailer Error: " . $mail->ErrorInfo;
        return false;
    }
}
?>
