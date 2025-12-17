<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include "connect.php";

if (isset($_POST['submit'])) {
    $full_name = $_POST["fullName"] ?? null;
    $type = $_POST["type"] ?? null;
    $blood_group = $_POST["bloodGroup"] ?? null;
    $state = $_POST["state"] ?? null;
    $city = $_POST["city"] ?? null;
    $mob = $_POST["mobile"] ?? null;
    $email = $_POST["email"] ?? null;
    $lastDonation = $_POST["lastDonation"] ?? null;
    $agreeTerms = isset($_POST["agreeTerms"]);
    // Get the event_id, default to null if empty
    $event_id = !empty($_POST["event_id"]) ? (int)$_POST["event_id"] : null;

    // --- Form Validation ---
    if (!$full_name || !$type || !$blood_group || !$state || !$mob || !$email || !$agreeTerms) {
        header("Location: blood_donor_form.php?status=error&message=" . urlencode('All required fields must be filled and terms must be agreed to.'));
        exit;
    }

    // --- Database Operation ---
    $stmt = null;
    try {
        $convertedLastDonation = null;
        if ($lastDonation && $lastDonation !== 'never') {
            $currentDate = new DateTime();
            if ($lastDonation === '0-3-months') $currentDate->modify('-3 months');
            elseif ($lastDonation === '3-6-months') $currentDate->modify('-6 months');
            elseif ($lastDonation === '6-12-months') $currentDate->modify('-12 months');
            elseif ($lastDonation === '1-year') $currentDate->modify('-1 year');
            $convertedLastDonation = $currentDate->format('Y-m-d');
        }

        $status = 'pending';

        $insert = "INSERT INTO `donor`(`full_name`, `type`, `blood_group`, `state`, `city`, `mob`, `email`, `last_donate`, `status`, `event_id`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $insert);

        if ($stmt === false) {
            throw new Exception('Database prepare failed: ' . mysqli_error($conn));
        }

        mysqli_stmt_bind_param($stmt, "sssssssssi", $full_name, $type, $blood_group, $state, $city, $mob, $email, $convertedLastDonation, $status, $event_id);

        if (mysqli_stmt_execute($stmt)) {
            if (mysqli_stmt_affected_rows($stmt) == 1) {
                header("Location: landing_page.php?status=success&message=" . urlencode('Donor registered successfully!'));
                exit;
            } else {
                throw new Exception('Query executed, but no row was inserted.');
            }
        } else {
            throw new Exception('Database execute failed: ' . mysqli_stmt_error($stmt));
        }
    } catch (Exception $e) {
        if (!headers_sent()) {
            header("Location: blood_donor_form.php?status=error&message=" . urlencode($e->getMessage()));
        } else {
            // Fallback if headers are already sent
            echo "Error: " . htmlspecialchars($e->getMessage());
        }
        exit;
    } finally {
        if ($stmt) mysqli_stmt_close($stmt);
        if ($conn) mysqli_close($conn);
    }
} else {
    header("Location: blood_donor_form.php");
    exit;
}
?>