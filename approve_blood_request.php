<?php
include 'admin_check.php';
include 'connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // First, get the request details
    $query = "SELECT patient_name, email FROM blood_request WHERE id = ?";
    $stmt_select = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt_select, "i", $id);
    mysqli_stmt_execute($stmt_select);
    $result = mysqli_stmt_get_result($stmt_select);
    
    if ($request = mysqli_fetch_assoc($result)) {
        $patient_name = $request['patient_name'];
        $email = $request['email'];

        $sql = "UPDATE blood_request SET status = 'approved' WHERE id = ?";
        $stmt_update = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt_update, "i", $id);

        if (mysqli_stmt_execute($stmt_update)) {
            header("Location: manage_requests.php?message=Request approved successfully");
        } else {
            header("Location: manage_requests.php?error=Failed to approve request");
        }
    } else {
        header("Location: manage_requests.php?error=Could not find the request to approve.");
    }
} else {
    header("Location: manage_requests.php?error=Invalid request");
}
?>