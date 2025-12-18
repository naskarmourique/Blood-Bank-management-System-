<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

include 'admin_check.php';
include 'connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $redirect_page = isset($_GET['redirect_to']) && $_GET['redirect_to'] === 'manage_requests' ? 'manage_requests.php' : 'blood_event.php';

    // First, get the event details for sending email
    $query = "SELECT contact_person, contact_email, event_name, status FROM blood_events WHERE id = ?";
    $stmt_select = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt_select, "i", $id);
    mysqli_stmt_execute($stmt_select);
    $result = mysqli_stmt_get_result($stmt_select);
    $event_details = mysqli_fetch_assoc($result);

    // Prepare and bind the delete statement
    $stmt = $conn->prepare("DELETE FROM blood_events WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $message = $redirect_page === 'manage_requests.php' ? 'Event request rejected and deleted successfully!' : 'Event deleted successfully!';
        
        // Send email only if it was a pending request being rejected
        if ($event_details && $event_details['status'] === 'pending' && !empty($event_details['contact_email'])) {
            $mail = new PHPMailer(true);
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
                $mail->addAddress($event_details['contact_email'], $event_details['contact_person']);

                // --- CONTENT ---
                $mail->isHTML(true);
                $mail->Subject = 'Your Blood Drive Event Status';
                $mail->Body    = "Dear " . htmlspecialchars($event_details['contact_person']) . ",<br><br>Thank you for your interest in organizing the event, '<b>" . htmlspecialchars($event_details['event_name']) . "</b>'. After careful consideration, we regret to inform you that we are unable to approve your event request at this time.<br><br>We appreciate your initiative and encourage you to reach out with future event proposals.<br><br>Thank you for your understanding.<br><br>Best regards,<br>The BloodConnect Team";
                $mail->AltBody = "Dear " . htmlspecialchars($event_details['contact_person']) . ",\n\nThank you for your interest in organizing the event, '" . htmlspecialchars($event_details['event_name']) . "'. After careful consideration, we regret to inform you that we are unable to approve your event request at this time.\n\nWe appreciate your initiative and encourage you to reach out with future event proposals.\n\nThank you for your understanding.\n\nBest regards,\nThe BloodConnect Team";

                $mail->send();
                $message = 'Event request rejected and a notification email has been sent.';
            } catch (Exception $e) {
                $message = 'Event request rejected, but the notification email could not be sent.';
            }
        }
        
        header("Location: " . $redirect_page . "?message=" . urlencode($message));
    } else {
        header("Location: " . $redirect_page . "?error=Error deleting event: " . $stmt->error);
    }

    $stmt->close();
    mysqli_close($conn);
} else {
    header("Location: blood_event.php"); // Default redirect if accessed directly
}
?>