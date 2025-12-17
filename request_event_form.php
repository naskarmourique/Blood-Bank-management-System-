<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request New Event - BloodConnect</title>
    <link rel="shortcut icon" href="favicon.jpg" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="donor.css">
    <link rel="stylesheet" href="particles.css">
</head>
<body>
    <div class="particles"></div>
    <?php include "header.php"; ?>
    <div class="main-wrapper">
        <div class="form-container">
            <div class="form-header">
                <h2><i class="fas fa-plus-circle icon"></i> Request New Blood Drive Event</h2>
                <a href="blood_event.php" class="close-btn"><i class="fas fa-times"></i></a>
            </div>
            <div class="form-content">
                <form action="request_event.php" method="post">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="event_name" class="form-label">Event Title *</label>
                            <input type="text" class="form-control" id="event_name" name="event_name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="event_type" class="form-label">Event Type *</label>
                            <select class="form-select" id="event_type" name="event_type" required>
                                <option value="">Choose Type</option>
                                <option value="Community Drive">Community Drive</option>
                                <option value="Corporate Drive">Corporate Drive</option>
                                <option value="Hospital Drive">Hospital Drive</option>
                                <option value="University Drive">University Drive</option>
                                <option value="Mall Drive">Mall Drive</option>
                                <option value="School Drive">School Drive</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="location" class="form-label">Location *</label>
                            <input type="text" class="form-control" id="location" name="location" required>
                        </div>
                        <div class="col-md-6">
                            <label for="event_date" class="form-label">Date *</label>
                            <input type="date" class="form-control" id="event_date" name="event_date" required>
                        </div>
                        <div class="col-md-3">
                            <label for="start_time" class="form-label">Start Time *</label>
                            <input type="time" class="form-control" id="start_time" name="start_time" required>
                        </div>
                        <div class="col-md-3">
                            <label for="end_time" class="form-label">End Time *</label>
                            <input type="time" class="form-control" id="end_time" name="end_time" required>
                        </div>
                        <div class="col-md-6">
                            <label for="target_donors" class="form-label">Target Donors *</label>
                            <input type="number" class="form-control" id="target_donors" name="target_donors" min="1" required>
                        </div>
                        <div class="col-md-6">
                            <label for="contact_person" class="form-label">Contact Person *</label>
                            <input type="text" class="form-control" id="contact_person" name="contact_person" required>
                        </div>
                        <div class="col-md-6">
                            <label for="contact_email" class="form-label">Contact Email *</label>
                            <input type="email" class="form-control" id="contact_email" name="contact_email" required>
                        </div>
                        <div class="col-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" style="height: 100px; resize: none;"></textarea>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <button type="submit" class="btn-submit" name="submit"><i class="fas fa-paper-plane"></i> Submit Request</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include "footer.php"; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="particles.js"></script>
    <script>
        // Set minimum date for the event date input
        const dateInput = document.getElementById('eventDate');
        if (dateInput) {
            dateInput.min = new Date().toISOString().split('T')[0];
        }
    </script>
</body>
</html>
