<?php
include 'admin_check.php';
include 'connect.php';

$event = null;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM blood_events WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $event = $result->fetch_assoc();
    }
    $stmt->close();
}

if ($event === null) {
    header("Location: blood_event.php?error=Event not found");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event - BloodConnect</title>
    <link rel="shortcut icon" href="favicon.jpg" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="donor.css">
</head>
<body>
    <?php include "header.php"; ?>
    <div class="main-wrapper">
        <div class="form-container">
            <div class="form-header">
                <h2><i class="fas fa-edit icon"></i> Edit Event</h2>
                <a href="blood_event.php" class="close-btn"><i class="fas fa-times"></i></a>
            </div>
            <div class="form-content">
                <form action="update_event.php" method="post">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($event['id']); ?>">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="adminEventName" class="form-label">Event Name *</label>
                            <input type="text" class="form-control" id="adminEventName" name="event_name" value="<?php echo htmlspecialchars($event['event_name']); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="adminEventType" class="form-label">Event Type *</label>
                            <select class="form-select" id="adminEventType" name="event_type" required>
                                <option value="">Choose Type</option>
                                <option value="Community Drive" <?php if($event['event_type'] == 'Community Drive') echo 'selected'; ?>>Community Drive</option>
                                <option value="Corporate Drive" <?php if($event['event_type'] == 'Corporate Drive') echo 'selected'; ?>>Corporate Drive</option>
                                <option value="Hospital Drive" <?php if($event['event_type'] == 'Hospital Drive') echo 'selected'; ?>>Hospital Drive</option>
                                <option value="University Drive" <?php if($event['event_type'] == 'University Drive') echo 'selected'; ?>>University Drive</option>
                                <option value="Mall Drive" <?php if($event['event_type'] == 'Mall Drive') echo 'selected'; ?>>Mall Drive</option>
                                <option value="School Drive" <?php if($event['event_type'] == 'School Drive') echo 'selected'; ?>>School Drive</option>
                                <option value="Other" <?php if($event['event_type'] == 'Other') echo 'selected'; ?>>Other</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="adminEventLocation" class="form-label">Location *</label>
                            <input type="text" class="form-control" id="adminEventLocation" name="location" value="<?php echo htmlspecialchars($event['location']); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="adminEventDate" class="form-label">Date *</label>
                            <input type="date" class="form-control" id="adminEventDate" name="event_date" value="<?php echo htmlspecialchars($event['event_date']); ?>" required>
                        </div>
                        <div class="col-md-3">
                            <label for="adminStartTime" class="form-label">Start Time *</label>
                            <input type="time" class="form-control" id="adminStartTime" name="start_time" value="<?php echo htmlspecialchars($event['start_time']); ?>" required>
                        </div>
                        <div class="col-md-3">
                            <label for="adminEndTime" class="form-label">End Time *</label>
                            <input type="time" class="form-control" id="adminEndTime" name="end_time" value="<?php echo htmlspecialchars($event['end_time']); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="adminOrganizer" class="form-label">Organizer</label>
                            <input type="text" class="form-control" id="adminOrganizer" name="organizer" value="<?php echo htmlspecialchars($event['organizer']); ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="adminContactPerson" class="form-label">Contact Person</label>
                            <input type="text" class="form-control" id="adminContactPerson" name="contact_person" value="<?php echo htmlspecialchars($event['contact_person']); ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="adminTargetDonors" class="form-label">Target Donors *</label>
                            <input type="number" class="form-control" id="adminTargetDonors" name="target_donors" min="0" value="<?php echo htmlspecialchars($event['target_donors']); ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label for="adminRegisteredDonors" class="form-label">Registered Donors *</label>
                            <input type="number" class="form-control" id="adminRegisteredDonors" name="registered_donors" min="0" value="<?php echo htmlspecialchars($event['registered_donors']); ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label for="adminDonatedUnits" class="form-label">Donated Units *</label>
                            <input type="number" class="form-control" id="adminDonatedUnits" name="donated_units" min="0" value="<?php echo htmlspecialchars($event['donated_units']); ?>" required>
                        </div>
                        <div class="col-12">
                            <label for="adminEventDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="adminEventDescription" name="description" style="height: 100px; resize: none;"><?php echo htmlspecialchars($event['description']); ?></textarea>
                        </div>
                        <div class="col-12">
                            <label for="adminEventStatus" class="form-label">Status *</label>
                            <select class="form-select" id="adminEventStatus" name="status" required>
                                <option value="pending" <?php if($event['status'] == 'pending') echo 'selected'; ?>>Pending</option>
                                <option value="approved" <?php if($event['status'] == 'approved') echo 'selected'; ?>>Approved</option>
                                <option value="rejected" <?php if($event['status'] == 'rejected') echo 'selected'; ?>>Rejected</option>
                                <option value="completed" <?php if($event['status'] == 'completed') echo 'selected'; ?>>Completed</option>
                            </select>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <button type="submit" class="btn-submit" name="submit"><i class="fas fa-save"></i> Update Event</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include "footer.php"; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
