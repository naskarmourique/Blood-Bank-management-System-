<?php
include 'admin_check.php';
include 'connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        mysqli_begin_transaction($conn);

        // First, get the request details
        $query = "SELECT patient_name, email, blood_group, units FROM blood_request WHERE id = ? FOR UPDATE";
        $stmt_select = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt_select, "i", $id);
        mysqli_stmt_execute($stmt_select);
        $result = mysqli_stmt_get_result($stmt_select);
        
        if ($request = mysqli_fetch_assoc($result)) {
            $patient_name = $request['patient_name'];
            $email = $request['email'];
            $blood_group = $request['blood_group'];
            $units = $request['units'];

            // Add the units back to the inventory
            $update_stock_sql = "UPDATE blood_inventory SET available_units = available_units + ? WHERE blood_group = ?";
            $stmt_update = mysqli_prepare($conn, $update_stock_sql);
            mysqli_stmt_bind_param($stmt_update, "is", $units, $blood_group);
            mysqli_stmt_execute($stmt_update);

            // Now, delete the request
            $delete_sql = "DELETE FROM blood_request WHERE id = ?";
            $stmt_delete = mysqli_prepare($conn, $delete_sql);
            mysqli_stmt_bind_param($stmt_delete, "i", $id);

            if (mysqli_stmt_execute($stmt_delete)) {
                mysqli_commit($conn);
                header("Location: manage_requests.php?message=Request rejected successfully and stock updated.");
            } else {
                throw new Exception("Failed to delete the request.");
            }
        } else {
            throw new Exception("Could not find the request to reject.");
        }
    } catch (Exception $e) {
        mysqli_rollback($conn);
        if (!headers_sent()) {
            header("Location: manage_requests.php?error=" . urlencode($e->getMessage()));
        } else {
            echo "Error: " . htmlspecialchars($e->getMessage());
        }
    } finally {
        if (isset($conn)) {
            mysqli_close($conn);
        }
    }
    exit;

} else {
    header("Location: manage_requests.php?error=Invalid request");
    exit;
}
?>