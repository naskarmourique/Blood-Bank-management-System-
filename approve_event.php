<?php
include 'admin_check.php';
include 'connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare and bind
    $stmt = $conn->prepare("UPDATE blood_events SET status = 'approved' WHERE id = ? AND status = 'pending'");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            header("Location: manage_requests.php?message=Event approved successfully!");
        } else {
            header("Location: manage_requests.php?error=Event could not be approved. It may have already been processed.");
        }
    } else {
        header("Location: manage_requests.php?error=Error approving event: " . $stmt->error);
    }

    $stmt->close();
    mysqli_close($conn);
} else {
    header("Location: manage_requests.php"); // Redirect if accessed directly without ID
}
?>
