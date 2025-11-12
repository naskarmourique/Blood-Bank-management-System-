<?php
include 'admin_check.php';
include 'connect.php';

if (isset($_POST['submit'])) {
    // Retrieve and sanitize form data
    $event_name = $_POST['event_name'];
    $event_type = $_POST['event_type'];
    $location = $_POST['location'];
    $event_date = $_POST['event_date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $organizer = $_POST['organizer'];
    $contact_person = $_POST['contact_person'];
    $target_donors = (int)$_POST['target_donors'];
    $registered_donors = (int)$_POST['registered_donors'];
    $donated_units = (int)$_POST['donated_units'];
    $description = $_POST['description'];
    $status = $_POST['status'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO blood_events (event_name, event_type, location, event_date, start_time, end_time, organizer, contact_person, target_donors, registered_donors, donated_units, description, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssiiiss", $event_name, $event_type, $location, $event_date, $start_time, $end_time, $organizer, $contact_person, $target_donors, $registered_donors, $donated_units, $description, $status);

    if ($stmt->execute()) {
        header("Location: blood_event.php?message=Event added successfully!");
    } else {
        header("Location: add_event.php?error=Error adding event: " . $stmt->error);
    }

    $stmt->close();
    mysqli_close($conn);
} else {
    header("Location: add_event.php");
}
?>
