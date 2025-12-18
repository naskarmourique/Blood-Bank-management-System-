<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

include "connect.php";
require "config.php";

if (isset($_POST["submit"])) {
    $f_name = $_POST["fName"] ?? null;
    $l_name = $_POST["lName"] ?? null;
    $email = $_POST["email"] ?? null;
    $phone = $_POST["phone"] ?? null;
    $subject = $_POST["subject"] ?? null;
    $message = $_POST["massage"] ?? null; // Corrected variable name from massage to message

    if (!$f_name || !$l_name || !$email || !$phone || !$subject || !$message) {
        header("Location: contact.php?status=error&message=" . urlencode('All fields are required.'));
        exit;
    }

    try {
        $stmt = $conn->prepare("INSERT INTO `contact_us`(`first_name`, `last_name`, `email`, `mobile`, `subject`, `message`) VALUES (?, ?, ?, ?, ?, ?)");
        // Note: The column names in the query have been updated to match the schema dump (e.g., F_NAME -> first_name)
        $stmt->bind_param("ssssss", $f_name, $l_name, $email, $phone, $subject, $message);

        if ($stmt->execute()) {
            // Send confirmation email to user
            $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->isSMTP();
                $mail->Host       = SMTP_HOST;
                $mail->SMTPAuth   = true;
                $mail->Username   = SMTP_USERNAME;
                $mail->Password   = SMTP_PASSWORD;
                $mail->SMTPSecure = SMTP_SECURE;
                $mail->Port       = SMTP_PORT;

                //Recipients
                $mail->setFrom(SMTP_USERNAME, 'BloodConnect');
                $mail->addAddress($email, $f_name . ' ' . $l_name);     //Add a recipient

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Thank you for contacting BloodConnect';
                $mail->Body    = "Dear $f_name,<br><br>Thank you for contacting us. We have received your message and will get back to you shortly.<br><br><b>Your Message Summary:</b><br>Subject: $subject<br>Message: $message<br><br>Best regards,<br>The BloodConnect Team";
                $mail->AltBody = "Dear $f_name,\n\nThank you for contacting us. We have received your message and will get back to you shortly.\n\nYour Message Summary:\nSubject: $subject\nMessage: $message\n\nBest regards,\nThe BloodConnect Team";

                $mail->send();
                $redirect_message = 'Your message has been sent successfully! A confirmation email has been sent to you.';
            } catch (Exception $e) {
                $redirect_message = 'Your message has been sent successfully! However, the confirmation email could not be sent.';
            }

            header("Location: landing_page.php?status=success&message=" . urlencode($redirect_message));
            exit;
        } else {
            throw new Exception('Failed to execute statement.');
        }
    } catch (Exception $e) {
        $error_message = 'An error occurred: ' . $e->getMessage();
        // Check if headers are already sent before trying to redirect
        if (!headers_sent()) {
            header("Location: contact.php?status=error&message=" . urlencode($error_message));
        } else {
            // Fallback if headers are already sent
            echo "Error: " . htmlspecialchars($error_message);
        }
        exit;
    } finally {
        if (isset($stmt)) {
            $stmt->close();
        }
        if (isset($conn)) {
            $conn->close();
        }
    }
} else {
    // If the form wasn't submitted, redirect back to the contact page
    header("Location: contact.php");
    exit;
}
?>