<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include "connect.php";


$response = [];

if ($conn->connect_error) {
    header("Location: landing_page.php?status=error&message=" . urlencode('Connection failed: ' . $conn->connect_error));
    exit;
}

$FULL_NAME = $_POST["fullName"] ?? null;
$TYPE = $_POST["type"] ?? null;
$BLOOD_GROUP = $_POST["bloodGroup"] ?? null;
$STATE = $_POST["state"] ?? null;
$CITY = $_POST["city"] ?? null;
$MOB = $_POST["mobile"] ?? null;
$EMAIL = $_POST["email"] ?? null;
$PASSWORD = $_POST["password"] ?? null;
$C_PASSWORD = $_POST["confirmPassword"] ?? null;
$S_QUESTION = $_POST["securityQuestion"] ?? null;
$S_ANSWER = $_POST["securityAnswer"] ?? null;
$lastDonation = $_POST["lastDonation"] ?? null;

// Convert lastDonation string to a valid date or NULL
$convertedLastDonation = null;
if ($lastDonation === 'never') {
    $convertedLastDonation = null;
} else {
    $currentDate = new DateTime();
    switch ($lastDonation) {
        case '0-3-months':
            $currentDate->modify('-3 months');
            break;
        case '3-6-months':
            $currentDate->modify('-6 months');
            break;
        case '6-12-months':
            $currentDate->modify('-12 months');
            break;
        case '1-year-above':
            $currentDate->modify('-1 year'); // This is a simplification, could be more precise
            break;
        default:
            // Handle unexpected values, perhaps log an error or set to null
            $convertedLastDonation = null;
            break;
    }
    if ($convertedLastDonation !== null) { // Only format if it's not already null from default case
        $convertedLastDonation = $currentDate->format('Y-m-d');
    }
}

if (!$FULL_NAME || !$TYPE || !$BLOOD_GROUP || !$STATE || !$MOB || !$EMAIL || !$PASSWORD || !$C_PASSWORD || !$S_QUESTION || !$S_ANSWER) {
    header("Location: landing_page.php?status=error&message=" . urlencode('All required fields must be filled.'));
    exit;
}

if ($PASSWORD !== $C_PASSWORD) {
    header("Location: landing_page.php?status=error&message=" . urlencode('Passwords do not match.'));
    exit;
}

$insert = "INSERT INTO `donor`(`FULL_NAME`, `TYPE`, `BLOOD_GROUP`, `STATE`, `CITY`, `MOB`, `EMAIL`, `PASSWORD`, `S_QUESTION`, `S_ANSWER`, `LAST_DONATE`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $insert);

if ($stmt === false) {
    header("Location: landing_page.php?status=error&message=" . urlencode('Prepare failed: ' . mysqli_error($conn)));
    exit;
}

mysqli_stmt_bind_param($stmt, "sssssssssss", $FULL_NAME, $TYPE, $BLOOD_GROUP, $STATE, $CITY, $MOB, $EMAIL, $PASSWORD, $S_QUESTION, $S_ANSWER, $convertedLastDonation);

if (mysqli_stmt_execute($stmt)) {
    if (mysqli_stmt_affected_rows($stmt) == 1) {
        header("Location: landing_page.php?status=success&message=" . urlencode('Donor registered successfully!'));
    } else {
        header("Location: landing_page.php?status=error&message=" . urlencode('Query executed, but no row was inserted. Please check database configuration.'));
    }
} else {
    header("Location: landing_page.php?status=error&message=" . urlencode('Execute failed: ' . mysqli_stmt_error($stmt)));
}

// No need to echo json_encode($response); here anymore

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>