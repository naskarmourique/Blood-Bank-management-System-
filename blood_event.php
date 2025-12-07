<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Only include admin_check if an admin is logged in, to avoid redirecting non-admins
if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    include 'admin_check.php';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Drive Events - BloodConnect</title>

    <link rel="shortcut icon" href="favicon.jpg" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="particles.css">

    <style>
        /* Masonry layout for events container */
        #eventsContainer {
            column-count: 2;
            /* 2 columns for desktop */
            column-gap: 1.5rem;
            /* gap between columns */
        }

        #eventsContainer .col {
            display: inline-block;
            /* allows elements to respect column flow */
            width: 100%;
        }

        /* For mobile, make it 1 column */
        @media (max-width: 768px) {
            #eventsContainer {
                column-count: 1;
            }
        }

        .event-card {
            margin-bottom: 1.5rem;
            /* vertical spacing between cards */
            width: 100%;
            box-sizing: border-box;
        }
    </style>
</head>

<body>
    <div class="particles"></div>
    <!-- Navbar -->
    <?php
    include "header.php";
    include "connect.php"; // Include database connection

    // --- Automatic Event Status Update Logic ---
    $current_date = date('Y-m-d');

    // Update events to 'completed' if their date is in the past and status is 'approved' or 'ongoing'
    $sql_complete = "UPDATE blood_events SET status = 'completed' WHERE event_date < ? AND (status = 'approved' OR status = 'ongoing')";
    $stmt_complete = $conn->prepare($sql_complete);
    $stmt_complete->bind_param("s", $current_date);
    $stmt_complete->execute();
    $stmt_complete->close();

    // Update events to 'ongoing' if their date is today and status is 'approved'
    $sql_ongoing = "UPDATE blood_events SET status = 'ongoing' WHERE event_date = ? AND status = 'approved'";
    $stmt_ongoing = $conn->prepare($sql_ongoing);
    $stmt_ongoing->bind_param("s", $current_date);
    $stmt_ongoing->execute();
    $stmt_ongoing->close();
    // --- End Automatic Event Status Update Logic ---

    // Function to get event status based on date
    function getEventDisplayStatus($event_date, $db_status) {
        if ($db_status == 'rejected') {
            return 'Rejected';
        }
        if ($db_status == 'pending') {
            return 'Pending';
        }

        $today = new DateTime();
        $today->setTime(0, 0, 0); // Normalize today's date to midnight for accurate comparison
        $eventDateTime = new DateTime($event_date);
        $eventDateTime->setTime(0, 0, 0); // Normalize to start of day for comparison

        if ($db_status == 'completed' || $eventDateTime < $today) {
            return 'Completed'; // If explicitly completed in DB or past date
        } elseif ($eventDateTime == $today) {
            return 'Ongoing'; // If today's date
        } else {
            return 'Upcoming'; // Future date
        }
    }

    $upcoming_events = [];
    $ongoing_events = [];
    $completed_events = [];
    $pending_events = [];
    $rejected_events = [];

    // Fetch events from the database
    if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
        // Admin sees all events
        $sql = "SELECT * FROM blood_events ORDER BY event_date ASC, start_time ASC";
    } else {
        // Public only sees approved and completed events
        $sql = "SELECT * FROM blood_events WHERE status IN ('approved', 'completed') ORDER BY event_date ASC, start_time ASC";
    }
    
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($event = mysqli_fetch_assoc($result)) {
            $display_status = getEventDisplayStatus($event['event_date'], $event['status']);

            if ($display_status == 'Upcoming') {
                $upcoming_events[] = $event;
            } elseif ($display_status == 'Ongoing') {
                $ongoing_events[] = $event;
            } elseif ($display_status == 'Completed') {
                $completed_events[] = $event;
            } elseif ($display_status == 'Pending') {
                $pending_events[] = $event;
            } elseif ($display_status == 'Rejected') {
                $rejected_events[] = $event;
            }
        }
    }
    ?>

    <div class="container-fluid px-4">
        <!-- Hero Section -->
        <?php
        include "hero.php";
        ?>

        <!-- New Hero Section for this page only -->
        <div class="events-hero text-center">
            <h1 class="display-4 fw-bold mb-3">🩸 Blood Drive Events</h1>
            <p class="lead mb-4">Join our life-saving blood donation camps across India</p>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                        <a href="add_event.php" class="create-event-btn btn-success">
                            <i class="fas fa-plus-circle me-2"></i>
                            Add New Event
                        </a>
                        <?php else: ?>
                        <a href="request_event_form.php" class="create-event-btn">
                            <i class="fas fa-plus-circle me-2"></i>
                            Request New Event
                        </a>
                        <?php endif; ?>
                    </div>
            
                    <!-- Filters -->
                    <div class="d-flex justify-content-center gap-3 mb-4 flex-wrap">
                        <a href="#" class="filter-btn active" data-filter="all">All Events</a>
                        <a href="#" class="filter-btn" data-filter="upcoming">Upcoming</a>
                        <a href="#" class="filter-btn" data-filter="ongoing">Ongoing</a>
                        <a href="#" class="filter-btn" data-filter="completed">Completed</a>
                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                        <a href="#" class="filter-btn" data-filter="pending">Pending</a>
                        <a href="#" class="filter-btn" data-filter="rejected">Rejected</a>
                        <?php endif; ?>
                    </div>
            
                    <!-- Events Grid -->
                    <div class="g-4 mb-5" id="eventsContainer">
                        <?php
                        // Combine all events for display
                        $all_display_events = array_merge($pending_events, $upcoming_events, $ongoing_events, $completed_events, $rejected_events);
            
                        if (empty($all_display_events)) {
                            echo "<div class='col-12 text-center'><p class='lead'>No events to display at the moment.</p></div>";
                        } else {
                            foreach ($all_display_events as $event) {
                                $event_day = date('d', strtotime($event['event_date']));
                                $event_month = date('M', strtotime($event['event_date']));
                                $display_status = getEventDisplayStatus($event['event_date'], $event['status']);
                                $status_class = strtolower(str_replace(' ', '-', $display_status));
            
                                // Calculate days left for upcoming events
                                $days_left = '';
                                if ($display_status == 'Upcoming') {
                                    $today = new DateTime();
                                    $eventDateTime = new DateTime($event['event_date']);
                                    $interval = $today->diff($eventDateTime);
                                    $days_left = $interval->days;
                                    if ($days_left > 0) {
                                        $days_left = $days_left . ' Days Left';
                                    } else {
                                        $days_left = 'Today'; // Should be caught by Ongoing, but as a fallback
                                    }
                                }
            
                                // Determine stats to show based on display status
                                $stat1_number = ''; $stat1_label = '';
                                $stat2_number = ''; $stat2_label = '';
                                $stat3_number = ''; $stat3_label = '';
            
                                if ($display_status == 'Upcoming' || $display_status == 'Pending') {
                                    $stat1_number = $event['target_donors'];
                                    $stat1_label = 'Target Donors';
                                    $stat2_number = $event['registered_donors'];
                                    $stat2_label = 'Registered';
                                    if ($display_status == 'Upcoming') {
                                        $stat3_number = $days_left;
                                        $stat3_label = ''; // Label already in number
                                    }
                                } elseif ($display_status == 'Ongoing') {
                                    $stat1_number = $event['donated_units'];
                                    $stat1_label = 'Donated';
                                    $stat2_number = $event['registered_donors'] - $event['donated_units']; // Assuming pending = registered - donated
                                    $stat2_label = 'Pending';
                                } elseif ($display_status == 'Completed') {
                                    $stat1_number = $event['donated_units'];
                                    $stat1_label = 'Collected';
                                    // Calculate success percentage if target_donors > 0
                                    $success_percentage = ($event['target_donors'] > 0) ? round(($event['donated_units'] / $event['target_donors']) * 100) : 0;
                                    $stat2_number = $success_percentage . '%';
                                    $stat2_label = 'Success';
                                }
                        ?>
                        <div class="col">
                            <div class="event-card <?php echo ($display_status == 'Upcoming' && !empty($event['description'])) ? 'featured' : ''; ?>">
                                <div class="d-flex">
                                    <div class="event-date">
                                        <div class="event-day"><?php echo $event_day; ?></div>
                                        <div class="event-month"><?php echo $event_month; ?></div>
                                    </div>
                                    <div class="p-4 flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <h4 class="fw-bold mb-1"><?php echo htmlspecialchars($event['event_name']); ?></h4>
                                            <span class="event-status status-<?php echo $status_class; ?>"><?php echo $display_status; ?></span>
                                        </div>
                                        <div class="mb-3">
                                            <div class="d-flex align-items-center gap-2 mb-2">
                                                <i class="fas fa-map-marker-alt text-danger"></i>
                                                <span><?php echo htmlspecialchars($event['location']); ?></span>
                                            </div>
                                            <div class="d-flex align-items-center gap-2 mb-2">
                                                <i class="fas fa-clock text-danger"></i>
                                                <span><?php echo date('h:i A', strtotime($event['start_time'])) . ' - ' . date('h:i A', strtotime($event['end_time'])); ?></span>
                                            </div>
                                            <?php if (!empty($event['organizer'])): ?>
                                            <div class="d-flex align-items-center gap-2">
                                                <i class="fas fa-building text-danger"></i>
                                                <span><?php echo htmlspecialchars($event['organizer']); ?></span>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                        <?php if (!empty($event['description'])): ?>
                                        <p class="text-muted mb-3"><?php echo htmlspecialchars($event['description']); ?></p>
                                        <?php endif; ?>
                                        <div class="event-stats">
                                            <?php if (!empty($stat1_number)): ?>
                                            <div class="stat-item">
                                                <div class="stat-number"><?php echo $stat1_number; ?></div>
                                                <div class="stat-label"><?php echo $stat1_label; ?></div>
                                            </div>
                                            <?php endif; ?>
                                            <?php if (!empty($stat2_number)): ?>
                                            <div class="stat-item">
                                                <div class="stat-number"><?php echo $stat2_number; ?></div>
                                                <div class="stat-label"><?php echo $stat2_label; ?></div>
                                            </div>
                                            <?php endif; ?>
                                            <?php if (!empty($stat3_number)): ?>
                                            <div class="stat-item">
                                                <div class="stat-number"><?php echo $stat3_number; ?></div>
                                                <div class="stat-label"><?php echo $stat3_label; ?></div>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                        <button class="btn btn-danger mt-3 w-100 view-details-btn"
                                            data-bs-toggle="modal" data-bs-target="#eventDetailsModal"
                                            data-title="<?php echo htmlspecialchars($event['event_name']); ?>"
                                            data-date="<?php echo date('d M Y', strtotime($event['event_date'])); ?>"
                                            data-time="<?php echo date('h:i A', strtotime($event['start_time'])) . ' - ' . date('h:i A', strtotime($event['end_time'])); ?>"
                                            data-location="<?php echo htmlspecialchars($event['location']); ?>"
                                            data-description="<?php echo htmlspecialchars($event['description']); ?>">
                                            <i class="fas fa-info-circle me-2"></i>View Details
                                        </button>
                                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                                        <div class="admin-actions mt-2 d-flex gap-2">
                                            <a href="edit_event.php?id=<?php echo $event['id']; ?>" class="btn btn-warning btn-sm flex-fill">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                                                            <a href="delete_event.php?id=<?php echo $event['id']; ?>" class="btn btn-danger btn-sm flex-fill" onclick="return confirm('Are you sure you want to delete this event?');">
                                                                                <i class="fas fa-trash"></i> Delete
                                                                            </a>                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
            
                    <!-- View Details Modal -->
                    <div class="modal fade" id="eventDetailsModal" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content" style="border-radius: 20px;">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalEventTitle"></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Date:</strong> <span id="modalEventDate"></span></p>
                                    <p><strong>Time:</strong> <span id="modalEventTime"></span></p>
                                    <p><strong>Location:</strong> <span id="modalEventLocation"></span></p>
                                    <p id="modalEventDescription"></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <!-- Our Volunteers Section -->
                    <div class="row g-4 mb-5" id="volunteers">
                        <div class="row mb-4" style="margin-top: 1em;">
                            <div class="col-12">
                                <div class="glass-card p-5">
                                    <div class="text-center mb-4">
                                        <h3 class="fw-bold">👥 Our Amazing Volunteers</h3>
                                        <p class="text-muted">The heroes behind every successful blood drive</p>
                                    </div>
                                    <div class="row g-4">
                                        <div class="col-md-3 col-sm-6">
                                            <div class="volunteer-card">
                                                <div class="volunteer-avatar">DR</div>
                                                <h6 class="fw-bold mb-1">Dr. Rajesh Kumar</h6>
                                                <small class="text-muted">Lead Physician</small>
                                                <div class="mt-2">
                                                    <small class="text-success">
                                                        <i class="fas fa-check-circle me-1"></i>15 Events
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <div class="volunteer-card">
                                                <div class="volunteer-avatar">PS</div>
                                                <h6 class="fw-bold mb-1">Priya Sharma</h6>
                                                <small class="text-muted">Nursing Coordinator</small>
                                                <div class="mt-2">
                                                    <small class="text-success">
                                                        <i class="fas fa-check-circle me-1"></i>12 Events
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <div class="volunteer-card">
                                                <div class="volunteer-avatar">AM</div>
                                                <h6 class="fw-bold mb-1">Amit Mishra</h6>
                                                <small class="text-muted">Event Manager</small>
                                                <div class="mt-2">
                                                    <small class="text-success">
                                                        <i class="fas fa-check-circle me-1"></i>20 Events
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <div class="volunteer-card">
                                                <div class="volunteer-avatar">SG</div>
                                                <h6 class="fw-bold mb-1">Sunita Gupta</h6>
                                                <small class="text-muted">Volunteer Coordinator</small>
                                                <div class="mt-2">
                                                    <small class="text-success">
                                                        <i class="fas fa-check-circle me-1"></i>18 Events
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <!-- Footer -->
                    <?php
                    include "footer.php";
                    ?>
            
                    <!-- Bootstrap JS -->
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
            
                    <!-- External JS -->
                    <script src="event.js"></script>
            
                        <script src="particles.js"></script>

</body>
            
            </html>
            