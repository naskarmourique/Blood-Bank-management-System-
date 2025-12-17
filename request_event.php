<?php
include 'connect.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['submit'])) {
    // All users (logged in or not) can request an event.
    // The status will be 'pending' by default.

    $event_name = $_POST['event_name'];
    $event_type = $_POST['event_type'];
    $location = $_POST['location'];
    $event_date = $_POST['event_date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $target_donors = (int)$_POST['target_donors'];
    $contact_person = $_POST['contact_person'];
    $contact_email = $_POST['contact_email'];
    $description = $_POST['description'];
    $status = 'pending'; // Requests always start as pending

    // Optional: If the user is logged in, you could associate the request with their user ID in the future.
    // For now, we will not store the user_id.
    // $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO blood_events (event_name, event_type, location, event_date, start_time, end_time, contact_person, contact_email, target_donors, description, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssiss", $event_name, $event_type, $location, $event_date, $start_time, $end_time, $contact_person, $contact_email, $target_donors, $description, $status);

    if ($stmt->execute()) {
        // Redirect with a success message
        header("Location: blood_event.php?message=Your event request has been submitted successfully! Our team will review it shortly.");
    } else {
        // Redirect with an error message
        header("Location: request_event_form.php?error=There was an error submitting your request. Please try again. " . $stmt->error);
    }

    $stmt->close();
    mysqli_close($conn);
} else {
    // If accessed directly, redirect to the form
    header("Location: request_event_form.php");
}
?>
