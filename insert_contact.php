<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include "connect.php";

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
            header("Location: landing_page.php?status=success&message=" . urlencode('Your message has been sent successfully!'));
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