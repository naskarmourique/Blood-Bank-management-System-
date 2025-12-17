<?php
include 'admin_check.php';
include 'connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt_select = null;
    $stmt_delete = null;

    try {
        // First, get the donor details for the email
        $query = "SELECT full_name, email FROM donor WHERE id = ?";
        $stmt_select = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt_select, "i", $id);
        mysqli_stmt_execute($stmt_select);
        $result = mysqli_stmt_get_result($stmt_select);
        
        if ($donor = mysqli_fetch_assoc($result)) {
            $full_name = $donor['full_name'];
            $email = $donor['email'];

            // Now, delete the donor record
            $sql = "DELETE FROM donor WHERE id = ?";
            $stmt_delete = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt_delete, "i", $id);

            if (mysqli_stmt_execute($stmt_delete)) {
                header("Location: manage_requests.php?message=Donor request rejected and record deleted successfully.");
            } else {
                throw new Exception("Failed to delete donor record.");
            }
        } else {
            throw new Exception("Could not find the donor to reject.");
        }
    } catch (Exception $e) {
        if (!headers_sent()) {
            header("Location: manage_requests.php?error=" . urlencode($e->getMessage()));
        } else {
            echo "Error: " . htmlspecialchars($e->getMessage());
        }
    } finally {
        if ($stmt_select) mysqli_stmt_close($stmt_select);
        if ($stmt_delete) mysqli_stmt_close($stmt_delete);
        if ($conn) mysqli_close($conn);
    }
    exit;

} else {
    header("Location: manage_requests.php?error=Invalid request");
    exit;
}
?>