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
    $stmt_select = null;
    $stmt_delete = null;

    try {
        // First, get the donor details for the email
        $query = "SELECT full_name, email FROM donor WHERE id = ?";
        $stmt_select = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt_select, "i", $id);
        mysqli_stmt_execute($stmt_select);
        $result = mysqli_stmt_get_result($stmt_select);
        
        if ($donor = mysqli_fetch_assoc($result)) {
            $full_name = $donor['full_name'];
            $email = $donor['email'];

            // Now, delete the donor record
            $sql = "DELETE FROM donor WHERE id = ?";
            $stmt_delete = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt_delete, "i", $id);

            if (mysqli_stmt_execute($stmt_delete)) {
                $mail = new PHPMailer(true);
                $redirect_message = 'Donor request rejected and record deleted successfully.';

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
                    $mail->addAddress($email, $full_name);

                    // --- CONTENT ---
                    $mail->isHTML(true);
                    $mail->Subject = 'Your Blood Donor Application Status';
                    $mail->Body    = "Dear $full_name,<br><br>Thank you for your interest in becoming a blood donor with BloodConnect. After careful review, we regret to inform you that we are unable to approve your application at this time.<br><br>This decision does not diminish the value of your willingness to help. We encourage you to review the eligibility criteria and consider reapplying in the future if your circumstances change.<br><br>Thank you for your understanding.<br><br>Best regards,<br>The BloodConnect Team";
                    $mail->AltBody = "Dear $full_name,\n\nThank you for your interest in becoming a blood donor with BloodConnect. After careful review, we regret to inform you that we are unable to approve your application at this time.\n\nThis decision does not diminish the value of your willingness to help. We encourage you to review the eligibility criteria and consider reapplying in the future if your circumstances change.\n\nThank you for your understanding.\n\nBest regards,\nThe BloodConnect Team";

                    $mail->send();
                    $redirect_message = 'Donor request rejected and a notification email has been sent.';
                } catch (Exception $e) {
                    $redirect_message = 'Donor request rejected, but the notification email could not be sent.';
                }
                header("Location: manage_requests.php?message=" . urlencode($redirect_message));

            } else {
                throw new Exception("Failed to delete donor record.");
            }
        } else {
            throw new Exception("Could not find the donor to reject.");
        }
    } catch (Exception $e) {
        if (!headers_sent()) {
            header("Location: manage_requests.php?error=" . urlencode($e->getMessage()));
        } else {
            echo "Error: " . htmlspecialchars($e->getMessage());
        }
    } finally {
        if ($stmt_select) mysqli_stmt_close($stmt_select);
        if ($stmt_delete) mysqli_stmt_close($stmt_delete);
        if ($conn) mysqli_close($conn);
    }
    exit;

} else {
    header("Location: manage_requests.php?error=Invalid request");
    exit;
}
?>