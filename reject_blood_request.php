<?php
include 'admin_check.php';
include 'connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "UPDATE blood_request SET status = 'rejected' WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    if (mysqli_stmt_execute($stmt)) {
        header("Location: manage_requests.php?message=Request rejected successfully");
    } else {
        header("Location: manage_requests.php?error=Failed to reject request");
    }
} else {
    header("Location: manage_requests.php?error=Invalid request");
}
?>