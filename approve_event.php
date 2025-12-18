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

    // First, get the event details
    $query = "SELECT contact_person, contact_email, event_name FROM blood_events WHERE id = ?";
    $stmt_select = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt_select, "i", $id);
    mysqli_stmt_execute($stmt_select);
    $result = mysqli_stmt_get_result($stmt_select);

    if ($event = mysqli_fetch_assoc($result)) {
        $contact_person = $event['contact_person'];
        $contact_email = $event['contact_email'];
        $event_name = $event['event_name'];

        // Prepare and bind
        $stmt = $conn->prepare("UPDATE blood_events SET status = 'approved' WHERE id = ? AND status = 'pending'");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                $mail = new PHPMailer(true);
                $redirect_message = 'Event approved successfully!';

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
                    $mail->Subject = 'Your Blood Drive Event has been Approved';
                    $mail->Body    = "Dear $contact_person,<br><br>Great news! Your request to organize the blood drive event, '<b>$event_name</b>', has been approved by the BloodConnect team.<br><br>We are excited to partner with you to make this event a success. You can now view your approved event on our events page.<br><br>Thank you for your valuable contribution to our cause.<br><br>Best regards,<br>The BloodConnect Team";
                    $mail->AltBody = "Dear $contact_person,\n\nGreat news! Your request to organize the blood drive event, '$event_name', has been approved by the BloodConnect team.\n\nWe are excited to partner with you to make this event a success. You can now view your approved event on our events page.\n\nThank you for your valuable contribution to our cause.\n\nBest regards,\nThe BloodConnect Team";

                    $mail->send();
                    $redirect_message = 'Event approved successfully and a confirmation email has been sent.';
                } catch (Exception $e) {
                    $redirect_message = 'Event approved successfully, but the confirmation email could not be sent.';
                }
                header("Location: manage_requests.php?message=" . urlencode($redirect_message));

            } else {
                header("Location: manage_requests.php?error=Event could not be approved. It may have already been processed.");
            }
        } else {
            header("Location: manage_requests.php?error=Error approving event: " . $stmt->error);
        }
    } else {
        header("Location: manage_requests.php?error=Could not find the event to approve.");
    }

    $stmt->close();
    mysqli_close($conn);
} else {
    header("Location: manage_requests.php"); // Redirect if accessed directly without ID
}
?>
