<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include "connect.php";

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

// Start transaction
mysqli_begin_transaction($conn);

try {
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
            $insert_request_sql = "INSERT INTO `blood_request`(`patient_name`, `BLOOD_GROUP`, `UNITS`, `HOSPITAL_NAME`, `HOSPITAL_LOCATION`, `MOB`, `REQUIRED_DATE`) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt_request = mysqli_prepare($conn, $insert_request_sql);
            mysqli_stmt_bind_param($stmt_request, "ssissss", $patientName, $bloodGroup, $units, $hospital_name, $hospital_location, $mobile, $required_date);
            
            if (mysqli_stmt_execute($stmt_request)) {
                mysqli_commit($conn);
                header("Location: landing_page.php?status=success&message=" . urlencode('Blood request submitted successfully!'));
            } else {
                mysqli_rollback($conn);
                header("Location: landing_page.php?status=error&message=" . urlencode('Failed to submit blood request.'));
            }
        } else {
            // Insufficient stock
            mysqli_rollback($conn);
            header("Location: landing_page.php?status=error&message=" . urlencode('Insufficient blood stock for ' . $bloodGroup . '. Only ' . $available_units . ' units available.'));
        }
    } else {
        // Blood group not in inventory
        mysqli_rollback($conn);
        header("Location: landing_page.php?status=error&message=" . urlencode('Blood group ' . $bloodGroup . ' is not available in the inventory.'));
    }
    exit;

} catch (mysqli_sql_exception $exception) {
    mysqli_rollback($conn);
    header("Location: landing_page.php?status=error&message=" . urlencode('Transaction failed: ' . $exception->getMessage()));
    exit;
} finally {
    mysqli_close($conn);
}
?>