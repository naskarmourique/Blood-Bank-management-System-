<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include "connect.php";


$response = [];

if ($conn->connect_error) {
    header("Location: landing_page.php?status=error&message=" . urlencode('Connection failed: ' . $conn->connect_error));
    exit;
}

$patientName = $_POST["pName"] ?? null;
$bloodGroup = $_POST["bloodGroup"] ?? null;
$units = $_POST["units"] ?? null;
$hospital_name = $_POST["hName"] ?? null;
$hospital_location = $_POST["hLocation"] ?? null;
$mobile = $_POST["mobile"] ?? null;
$required_date = $_POST["rDate"] ?? null;

if (!$patientName || !$bloodGroup || !$units || !$hospital_name || !$hospital_location || !$mobile || !$required_date) {
    header("Location: landing_page.php?status=error&message=" . urlencode('All fields are required.'));
    exit;
}

$insert2 = "INSERT INTO `blood_request`(`patient_name`, `BLOOD_GROUP`, `UNITS`, `HOSPITAL_NAME`, `HOSPITAL_LOCATION`, `MOB`, `REQUIRED_DATE`) VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $insert2);

if ($stmt === false) {
    header("Location: landing_page.php?status=error&message=" . urlencode('Prepare failed: ' . mysqli_error($conn)));
    exit;
}

mysqli_stmt_bind_param($stmt, "ssissss", $patientName, $bloodGroup, $units, $hospital_name, $hospital_location, $mobile, $required_date);

if (mysqli_stmt_execute($stmt)) {
    if (mysqli_stmt_affected_rows($stmt) == 1) {
        header("Location: landing_page.php?status=success&message=" . urlencode('Blood request submitted successfully!'));
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