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

    // First, get the donor details
    $query = "SELECT full_name, email FROM donor WHERE id = ?";
    $stmt_select = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt_select, "i", $id);
    mysqli_stmt_execute($stmt_select);
    $result = mysqli_stmt_get_result($stmt_select);

    if ($donor = mysqli_fetch_assoc($result)) {
        $full_name = $donor['full_name'];
        $email = $donor['email'];

        $sql = "UPDATE donor SET status = 'approved' WHERE id = ?";
        $stmt_update = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt_update, "i", $id);

        if (mysqli_stmt_execute($stmt_update)) {
            $mail = new PHPMailer(true);
            $redirect_message = 'Donor request approved successfully.';

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
                $mail->Subject = 'Your Blood Donor Application has been Approved';
                $mail->Body    = "Dear $full_name,<br><br>Congratulations! Your application to become a blood donor with BloodConnect has been approved. We are thrilled to have you as part of our life-saving community.<br><br>You are now eligible to donate blood at our centers and events. Keep an eye out for upcoming blood drives in your area.<br><br>Thank you for your commitment to saving lives.<br><br>Best regards,<br>The BloodConnect Team";
                $mail->AltBody = "Dear $full_name,\n\nCongratulations! Your application to become a blood donor with BloodConnect has been approved. We are thrilled to have you as part of our life-saving community.\n\nYou are now eligible to donate blood at our centers and events. Keep an eye out for upcoming blood drives in your area.\n\nThank you for your commitment to saving lives.\n\nBest regards,\nThe BloodConnect Team";

                $mail->send();
                $redirect_message = 'Donor request approved successfully and a confirmation email has been sent.';
            } catch (Exception $e) {
                $redirect_message = 'Donor request approved successfully, but the confirmation email could not be sent.';
            }
            header("Location: manage_requests.php?message=" . urlencode($redirect_message));
        } else {
            header("Location: manage_requests.php?error=Failed to approve donor request");
        }
    } else {
        header("Location: manage_requests.php?error=Could not find the donor to approve.");
    }
} else {
    header("Location: manage_requests.php?error=Invalid request");
}
?>