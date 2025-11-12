<?php
include 'admin_check.php';
include 'connect.php';

// Fetch all pending event requests
$sql = "SELECT * FROM blood_events WHERE status = 'pending' ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);
$pending_events = [];
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $pending_events[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Event Requests - BloodConnect</title>
    <link rel="shortcut icon" href="favicon.jpg" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <style>
        .main-wrapper {
            padding: 2rem;
        }
        .table-container {
            background: #fff;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .btn-action {
            width: 100px;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="main-wrapper">
        <div class="container">
            <div class="table-container">
                <h2 class="mb-4 fw-bold"><i class="fas fa-tasks me-2"></i> Manage Event Requests</h2>

                <?php if (isset($_GET['message'])): ?>
                    <div class="alert alert-success"><?php echo htmlspecialchars($_GET['message']); ?></div>
                <?php endif; ?>
                <?php if (isset($_GET['error'])): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($_GET['error']); ?></div>
                <?php endif; ?>

                <?php if (empty($pending_events)): ?>
                    <div class="alert alert-info">There are no pending event requests to review.</div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Event Name</th>
                                    <th>Location</th>
                                    <th>Date</th>
                                    <th>Contact</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pending_events as $event): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($event['event_name']); ?></td>
                                        <td><?php echo htmlspecialchars($event['location']); ?></td>
                                        <td><?php echo date('d M Y', strtotime($event['event_date'])); ?></td>
                                        <td><?php echo htmlspecialchars($event['contact_person']); ?></td>
                                        <td class="text-center">
                                            <a href="approve_event.php?id=<?php echo $event['id']; ?>" class="btn btn-success btn-sm me-2 btn-action">
                                                <i class="fas fa-check"></i> Approve
                                            </a>
                                            <a href="delete_event.php?id=<?php echo $event['id']; ?>&redirect_to=manage_requests" class="btn btn-danger btn-sm btn-action" onclick="return confirm('Are you sure you want to reject and delete this event request?');">
                                                <i class="fas fa-times"></i> Reject
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
