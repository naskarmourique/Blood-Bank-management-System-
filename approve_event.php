<?php
include 'admin_check.php';
include 'connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // First, get the event details
    $query = "SELECT contact_person, contact_email, event_name FROM blood_events WHERE id = ?";
    $stmt_select = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt_select, "i", $id);
    mysqli_stmt_execute($stmt_select);
    $result = mysqli_stmt_get_result($stmt_select);

    if ($event = mysqli_fetch_assoc($result)) {
        $contact_person = $event['contact_person'];
        $contact_email = $event['contact_email'];
        $event_name = $event['event_name'];

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
    } else {
        header("Location: manage_requests.php?error=Could not find the event to approve.");
    }

    $stmt->close();
    mysqli_close($conn);
} else {
    header("Location: manage_requests.php"); // Redirect if accessed directly without ID
}
?>
