<?php
include 'admin_check.php';
include 'connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $redirect_page = isset($_GET['redirect_to']) && $_GET['redirect_to'] === 'manage_requests' ? 'manage_requests.php' : 'blood_event.php';

    // First, get the event details for sending email
    $query = "SELECT contact_person, contact_email, event_name, status FROM blood_events WHERE id = ?";
    $stmt_select = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt_select, "i", $id);
    mysqli_stmt_execute($stmt_select);
    $result = mysqli_stmt_get_result($stmt_select);
    $event_details = mysqli_fetch_assoc($result);

    // Prepare and bind the delete statement
    $stmt = $conn->prepare("DELETE FROM blood_events WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $message = $redirect_page === 'manage_requests.php' ? 'Event request rejected and deleted successfully!' : 'Event deleted successfully!';
        header("Location: " . $redirect_page . "?message=" . urlencode($message));
    } else {
        header("Location: " . $redirect_page . "?error=Error deleting event: " . $stmt->error);
    }

    $stmt->close();
    mysqli_close($conn);
} else {
    header("Location: blood_event.php"); // Default redirect if accessed directly
}
?>