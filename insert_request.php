<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer files
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

include "connect.php";

if (isset($_POST['pName'])) {
    $patientName = $_POST["pName"] ?? null;
    $bloodGroup = $_POST["bloodGroup"] ?? null;
    $units = $_POST["units"] ?? null;
    $hospital_name = $_POST["hName"] ?? null;
    $hospital_location = $_POST["hLocation"] ?? null;
    $mobile = $_POST["mobile"] ?? null;
    $email = $_POST["email"] ?? null;
    $required_date = $_POST["rDate"] ?? null;

    if (!$patientName || !$bloodGroup || !$units || !$hospital_name || !$hospital_location || !$mobile || !$required_date || !$email) {
        header("Location: blood_request.php?status=error&message=" . urlencode('All fields are required.'));
        exit;
    }

    // Server-side validation for required_date
    $currentDate = new DateTime();
    $reqDateObj = new DateTime($required_date);

    // Set time components of current date to 00:00:00 for accurate comparison of just the date part
    $currentDate->setTime(0, 0, 0);
    $reqDateObj->setTime(0, 0, 0);


    if ($reqDateObj < $currentDate) {
        header("Location: blood_request.php?status=error&message=" . urlencode('Required Date cannot be in the past.'));
        exit;
    }

    try {
        mysqli_begin_transaction($conn);

        // Check inventory
        $check_stock_sql = "SELECT available_units FROM blood_inventory WHERE blood_group = ? FOR UPDATE";
        $stmt_stock = mysqli_prepare($conn, $check_stock_sql);
        mysqli_stmt_bind_param($stmt_stock, "s", $bloodGroup);
        mysqli_stmt_execute($stmt_stock);
        $result_stock = mysqli_stmt_get_result($stmt_stock);
        
        if ($row = mysqli_fetch_assoc($result_stock)) {
            $available_units = $row['available_units'];
            if ($available_units >= $units) {
                // Sufficient stock, update inventory
                $new_units = $available_units - $units;
                $update_stock_sql = "UPDATE blood_inventory SET available_units = ? WHERE blood_group = ?";
                $stmt_update = mysqli_prepare($conn, $update_stock_sql);
                mysqli_stmt_bind_param($stmt_update, "is", $new_units, $bloodGroup);
                mysqli_stmt_execute($stmt_update);

                // Insert blood request
                $insert_request_sql = "INSERT INTO `blood_request`(`patient_name`, `blood_group`, `units`, `hospital_name`, `hospital_location`, `mob`, `email`, `required_date`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt_request = mysqli_prepare($conn, $insert_request_sql);
                mysqli_stmt_bind_param($stmt_request, "ssisssss", $patientName, $bloodGroup, $units, $hospital_name, $hospital_location, $mobile, $email, $required_date);
                
                if (mysqli_stmt_execute($stmt_request)) {
                    mysqli_commit($conn);

                    // SEND EMAIL CONFIRMATION
                    $mail = new PHPMailer(true);

                    try {
                        // --- SERVER SETTINGS ---
                        // You must update these settings with your own email provider's details.
                        // For example, if using Gmail, search for "Gmail SMTP settings".
                        $mail->isSMTP();
                        $mail->Host       = 'smtp.gmail.com'; // e.g., 'smtp.gmail.com'
                        $mail->SMTPAuth   = true;
                        $mail->Username   = 'bloodconnect8@gmail.com'; // Your email address
                        $mail->Password   = 'uaga mivb vvwj qvwg';    // Your email password or app-specific password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->Port       = 587;

                        // --- RECIPIENTS ---
                        $mail->setFrom('no-reply@yourdomain.com', 'BloodConnect');
                        $mail->addAddress($email, $patientName); // Uses the email and name from the form

                        // --- CONTENT ---
                        $mail->isHTML(true);
                        $mail->Subject = 'Your Blood Request has been Received';
                        $mail->Body    = "Dear $patientName,<br><br>Thank you for your blood request. We have successfully received it and our team will process it shortly.<br><br><b>Request Details:</b><br>Blood Group: $bloodGroup<br>Units Required: $units<br><br>Thank you for using BloodConnect.<br><br>Best regards,<br>The BloodConnect Team";
                        $mail->AltBody = "Dear $patientName,\n\nThank you for your blood request. We have successfully received it and our team will process it shortly.\n\nRequest Details:\nBlood Group: $bloodGroup\nUnits Required: $units\n\nThank you for using BloodConnect.\n\nBest regards,\nThe BloodConnect Team";

                        $mail->send();
                        $redirect_message = 'Blood request submitted successfully! A confirmation email has been sent.';
                    } catch (Exception $e) {
                        // Email sending failed, but the request was saved.
                        // We will still inform the user, but note the email failure.
                        $redirect_message = 'Blood request submitted successfully! However, the confirmation email could not be sent.';
                    }

                    header("Location: landing_page.php?status=success&message=" . urlencode($redirect_message));
                    exit;

                } else {
                    throw new Exception('Failed to submit blood request.');
                }
            } else {
                throw new Exception('Insufficient blood stock for ' . $bloodGroup . '. Only ' . $available_units . ' units available.');
            }
        } else {
            throw new Exception('Blood group ' . $bloodGroup . ' is not available in the inventory.');
        }
    } catch (Exception $e) {
        mysqli_rollback($conn);
        $error_message = $e->getMessage();
        if (!headers_sent()) {
            header("Location: blood_request.php?status=error&message=" . urlencode($error_message));
        } else {
            echo "Error: " . htmlspecialchars($error_message);
        }
        exit;
    } finally {
        if ($conn) {
            mysqli_close($conn);
        }
    }
} else {
    header("Location: blood_request.php");
    exit;
}
?>
