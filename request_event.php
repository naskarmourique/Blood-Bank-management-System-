<?php
// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer files
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

include 'connect.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['submit'])) {
    // All users (logged in or not) can request an event.
    // The status will be 'pending' by default.

    $event_name = $_POST['event_name'];
    $event_type = $_POST['event_type'];
    $location = $_POST['location'];
    $event_date = $_POST['event_date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $target_donors = (int)$_POST['target_donors'];
    $contact_person = $_POST['contact_person'];
    $contact_email = $_POST['contact_email'];
    $description = $_POST['description'];
    $status = 'pending'; // Requests always start as pending

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO blood_events (event_name, event_type, location, event_date, start_time, end_time, contact_person, contact_email, target_donors, description, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssiss", $event_name, $event_type, $location, $event_date, $start_time, $end_time, $contact_person, $contact_email, $target_donors, $description, $status);

    if ($stmt->execute()) {
        // --- SEND EMAIL CONFIRMATION ---
        $mail = new PHPMailer(true);
        $redirect_message = 'Your event request has been submitted successfully! Our team will review it shortly.'; // Default message

        try {
            // --- SERVER SETTINGS ---
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'bloodconnect8@gmail.com';
            $mail->Password   = 'uaga mivb vvwj qvwg';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // --- RECIPIENTS ---
            $mail->setFrom('no-reply@yourdomain.com', 'BloodConnect');
            $mail->addAddress($contact_email, $contact_person);

            // --- CONTENT ---
            $mail->isHTML(true);
            $mail->Subject = 'Your Event Request has been Submitted';
            $mail->Body    = "Dear $contact_person,<br><br>Thank you for submitting your event request to BloodConnect. We appreciate your initiative in helping our community.<br><br>Our team will review your request, and you will be notified once a decision has been made.<br><br><b>Event Details:</b><br>Event Name: $event_name<br>Date: $event_date<br>Location: $location<br><br>Best regards,<br>The BloodConnect Team";
            $mail->AltBody = "Dear $contact_person,\n\nThank you for submitting your event request to BloodConnect. We appreciate your initiative in helping our community.\n\nOur team will review your request, and you will be notified once a decision has been made.\n\nEvent Details:\nEvent Name: $event_name\nDate: $event_date\nLocation: $location\n\nBest regards,\nThe BloodConnect Team";

            $mail->send();
            $redirect_message = 'Your event request has been submitted successfully! A confirmation email has been sent.';
        } catch (Exception $e) {
            $redirect_message = 'Your event request has been submitted successfully! However, the confirmation email could not be sent.';
        }

        // Redirect with the appropriate message
        header("Location: blood_event.php?message=" . urlencode($redirect_message));
    } else {
        // Redirect with an error message
        header("Location: request_event_form.php?error=There was an error submitting your request. Please try again. " . $stmt->error);
    }

    $stmt->close();
    mysqli_close($conn);
} else {
    // If accessed directly, redirect to the form
    header("Location: request_event_form.php");
}
?>
