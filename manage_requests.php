<?php
include 'admin_check.php';
include 'connect.php';

// Fetch all pending event requests
$sql_events = "SELECT * FROM blood_events WHERE status = 'pending' ORDER BY created_at DESC";
$result_events = mysqli_query($conn, $sql_events);
$pending_events = [];
if ($result_events && mysqli_num_rows($result_events) > 0) {
    while ($row = mysqli_fetch_assoc($result_events)) {
        $pending_events[] = $row;
    }
}

// Fetch all pending blood requests
$sql_blood = "SELECT * FROM blood_request WHERE status = 'pending' ORDER BY required_date ASC";
$result_blood = mysqli_query($conn, $sql_blood);
$pending_blood_requests = [];
if ($result_blood && mysqli_num_rows($result_blood) > 0) {
    while ($row = mysqli_fetch_assoc($result_blood)) {
        $pending_blood_requests[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Requests - BloodConnect</title>
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
                <h2 class="mb-4 fw-bold"><i class="fas fa-tasks me-2"></i> Manage Requests</h2>

                <?php if (isset($_GET['message'])): ?>
                    <div class="alert alert-success"><?php echo htmlspecialchars($_GET['message']); ?></div>
                <?php endif; ?>
                <?php if (isset($_GET['error'])): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($_GET['error']); ?></div>
                <?php endif; ?>

                <h3 class="mb-3 fw-bold"><i class="fas fa-calendar-alt me-2"></i> Event Requests</h3>
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

                <hr class="my-5">

                <h3 class="mb-3 fw-bold"><i class="fas fa-tint me-2"></i> Blood Requests</h3>
                <?php if (empty($pending_blood_requests)): ?>
                    <div class="alert alert-info">There are no pending blood requests to review.</div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Patient Name</th>
                                    <th>Hospital</th>
                                    <th>Blood Group</th>
                                    <th>Units</th>
                                    <th>Required Date</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pending_blood_requests as $request): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($request['patient_name']); ?></td>
                                        <td><?php echo htmlspecialchars($request['hospital_name']); ?></td>
                                        <td><?php echo htmlspecialchars($request['blood_group']); ?></td>
                                        <td><?php echo htmlspecialchars($request['units']); ?></td>
                                        <td><?php echo date('d M Y', strtotime($request['required_date'])); ?></td>
                                        <td class="text-center">
                                            <a href="approve_blood_request.php?id=<?php echo $request['id']; ?>" class="btn btn-success btn-sm me-2 btn-action">
                                                <i class="fas fa-check"></i> Approve
                                            </a>
                                            <a href="reject_blood_request.php?id=<?php echo $request['id']; ?>" class="btn btn-danger btn-sm me-2 btn-action" onclick="return confirm('Are you sure you want to reject this blood request?');">
                                                <i class="fas fa-times"></i> Reject
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>

                <hr class="my-5">

                <h3 class="mb-3 fw-bold"><i class="fas fa-heart me-2"></i> Donation Requests</h3>
                <?php
                // Fetch all pending donor requests
                $sql_donors = "SELECT * FROM donor WHERE status = 'pending' ORDER BY created_at DESC";
                $result_donors = mysqli_query($conn, $sql_donors);
                $pending_donor_requests = [];
                if ($result_donors && mysqli_num_rows($result_donors) > 0) {
                    while ($row = mysqli_fetch_assoc($result_donors)) {
                        $pending_donor_requests[] = $row;
                    }
                }
                ?>

                <?php if (empty($pending_donor_requests)): ?>
                    <div class="alert alert-info">There are no pending donation requests to review.</div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Donor Name</th>
                                    <th>Blood Group</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Event (if any)</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pending_donor_requests as $donor): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($donor['full_name']); ?></td>
                                        <td><?php echo htmlspecialchars($donor['blood_group']); ?></td>
                                        <td><?php echo htmlspecialchars($donor['mob']); ?></td>
                                        <td><?php echo htmlspecialchars($donor['email']); ?></td>
                                        <td>
                                            <?php if ($donor['event_id']): ?>
                                                <?php
                                                $sql_event_name = "SELECT event_name FROM blood_events WHERE id = ?";
                                                $stmt_event_name = mysqli_prepare($conn, $sql_event_name);
                                                mysqli_stmt_bind_param($stmt_event_name, "i", $donor['event_id']);
                                                mysqli_stmt_execute($stmt_event_name);
                                                $result_event_name = mysqli_stmt_get_result($stmt_event_name);
                                                if ($event_row = mysqli_fetch_assoc($result_event_name)) {
                                                    echo htmlspecialchars($event_row['event_name']);
                                                } else {
                                                    echo "N/A";
                                                }
                                                mysqli_stmt_close($stmt_event_name);
                                                ?>
                                            <?php else: ?>
                                                No Event
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <a href="approve_donor.php?id=<?php echo $donor['id']; ?>" class="btn btn-success btn-sm me-2 btn-action">
                                                <i class="fas fa-check"></i> Approve
                                            </a>
                                            <a href="reject_donor.php?id=<?php echo $donor['id']; ?>" class="btn btn-danger btn-sm btn-action" onclick="return confirm('Are you sure you want to reject this donor request?');">
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
