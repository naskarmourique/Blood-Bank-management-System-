<?php
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
            header("Location: manage_requests.php?message=Donor request approved successfully");
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