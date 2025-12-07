<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BloodConnect | National Blood Management System</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.jpg" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- External CSS -->
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="particles.css">
</head>

<body>
    <div class="particles"></div>
    <!-- Navbar -->
    <?php
    include "header.php";
    ?>
    <?php
    if (isset($_GET['status']) && isset($_GET['message'])) {
        $status = $_GET['status'];
        $message = htmlspecialchars($_GET['message']);
        $alertClass = ($status === 'success') ? 'alert-success' : 'alert-danger';
        echo '<div class="container mt-3"><div class="alert ' . $alertClass . ' alert-dismissible fade show" role="alert">' . $message . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div></div>';
    }
    ?>
    <div class="container-fluid px-4">
        <!-- Hero Section -->
        <?php
        include "hero.php";
        ?>

        <!-- Main Content -->
        <div class="row g-4">
            <!-- Sidebar -->
            <div class="col-lg-3">
                <div class="glass-card sidebar p-4">
                    <div class="mb-4">
                        <h6 class="text-muted text-uppercase fw-bold mb-3"
                            style="font-size: 0.75rem; letter-spacing: 1.2px;">Dashboard</h6>
                        <a href="#hero" class="nav-item-custom active">
                            <i class="fas fa-chart-line"></i>
                            <span>Overview</span>
                        </a>
                        <a href="#ccards" class="nav-item-custom">
                            <i class="fas fa-id-card"></i>
                            <span>e-Donor Cards</span>
                        </a>
                        <a href="blood_event.php" class="nav-item-custom">
                            <i class="fa-solid fa-hand-holding-droplet"></i>
                            <span>Blood Campaign</span>
                        </a>
                    </div>

                    <div class="mb-4">
                        <h6 class="text-muted text-uppercase fw-bold mb-3"
                            style="font-size: 0.75rem; letter-spacing: 1.2px;">Blood Operations</h6>
                        <a href="#collection" class="nav-item-custom">
                            <i class="fas fa-tint"></i>
                            <span>Collection</span>
                        </a>
                    </div>

                    <div>
                        <h6 class="text-muted text-uppercase fw-bold mb-3"
                            style="font-size: 0.75rem; letter-spacing: 1.2px;">Inventory</h6>
                        <a href="#pending" class="nav-item-custom">
                            <i class="fa-solid fa-boxes-stacked"></i>
                            <span>Stock Management</span>
                        </a>
                        <a href="blood_donor_form.php" class="nav-item-custom">
                            <i class="fa-solid fa-newspaper"></i>
                            <span>Donation Form</span>
                        </a>
                    </div>

                    <div>
                        <h6 class="text-muted text-uppercase fw-bold mb-3"
                            style="font-size: 0.75rem; letter-spacing: 1.2px;">Abouts</h6>
                        <a href="services.php#about" class="nav-item-custom">
                            <i class="fa-solid fa-circle-info"></i>
                            <span>About us</span>
                        </a>
                        <a href="services.php#services" class="nav-item-custom">
                            <i class="fa-solid fa-user-tie"></i>
                            <span>Services</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="col-lg-9">
                <!-- Quick Actions -->
                <div class="row g-4 mb-4" id="ccards">
                    <div class="col-md-6 col-lg-3">
                        <a href="blood_donor_form.php" class="quick-action-btn donor-reg p-4 d-block text-center glass-card h-100">
                            <div class="action-icon">👨‍⚕️</div>
                            <h5 class="fw-bold mb-2">Donor Registration</h5>
                            <p class="mb-0" style="font-size: 0.85rem; color: #64748b;">Register new blood donors and
                                manage their profiles</p>
                        </a>
                    </div>
                    </a>
                    <div class="col-md-6 col-lg-3">
                        <a href="blood_event.php" class="quick-action-btn blood-collection p-4 d-block text-center glass-card h-100">
                            <div class="action-icon">🩸</div>
                            <h5 class="fw-bold mb-2">Blood Collection</h5>
                            <p class="mb-0" style="font-size: 0.85rem; color: #64748b;">Record blood collection and
                                screening data</p>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <a href="#collection" class="quick-action-btn inventory p-4 d-block text-center glass-card h-100">
                            <div class="action-icon">📦</div>
                            <h5 class="fw-bold mb-2">Inventory Management</h5>
                            <p class="mb-0" style="font-size: 0.85rem; color: #64748b;">Track blood units and component
                                availability</p>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <a href="blood_request.php" class="quick-action-btn emergency p-4 d-block text-center glass-card h-100">
                            <div class="action-icon">🚨</div>
                            <h5 class="fw-bold mb-2">Emergency Requests</h5>
                            <p class="mb-0" style="font-size: 0.85rem; color: #64748b;">Handle urgent blood requirement
                                requests</p>
                        </a>
                    </div>
                </div>

                <!-- Statistics Cards -->
                
                <?php
                include 'connect.php'; // Ensure database connection is available

                $blood_stats = [
                    'A+' => ['total_units' => 0, 'percentage_change' => 0, 'change_icon' => 'fas fa-minus', 'badge_class' => 'bg-secondary'],
                    'B+' => ['total_units' => 0, 'percentage_change' => 0, 'change_icon' => 'fas fa-minus', 'badge_class' => 'bg-secondary'],
                    'AB+' => ['total_units' => 0, 'percentage_change' => 0, 'change_icon' => 'fas fa-minus', 'badge_class' => 'bg-secondary'],
                    'O+' => ['total_units' => 0, 'percentage_change' => 0, 'change_icon' => 'fas fa-minus', 'badge_class' => 'bg-secondary'],
                ];

                // Fetch current and previous available units for each blood group
                $sql_stats = "SELECT blood_group, available_units, previous_available_units FROM blood_inventory WHERE blood_group IN ('A+', 'B+', 'AB+', 'O+')";
                $result_stats = mysqli_query($conn, $sql_stats);

                if ($result_stats && mysqli_num_rows($result_stats) > 0) {
                    while ($row_stats = mysqli_fetch_assoc($result_stats)) {
                        $current_units = $row_stats['available_units'];
                        $previous_units = $row_stats['previous_available_units'];
                        $blood_group = $row_stats['blood_group'];

                        $percentage_change = 0;
                        $change_icon = 'fas fa-minus';
                        $badge_class = 'bg-secondary';

                        // Calculate percentage change only if previous_units is available and not zero
                        if ($previous_units !== null && $previous_units > 0) {
                            $percentage_change = (($current_units - $previous_units) / $previous_units) * 100;
                            if ($percentage_change > 0) {
                                $change_icon = 'fas fa-arrow-up';
                                $badge_class = 'bg-success';
                            } elseif ($percentage_change < 0) {
                                $change_icon = 'fas fa-arrow-down';
                                $badge_class = 'bg-danger';
                            }
                        } elseif ($previous_units === null || $previous_units == 0) {
                            // If no previous data, or previous was zero, and current is positive, show as increase
                            if ($current_units > 0) {
                                $change_icon = 'fas fa-arrow-up';
                                $badge_class = 'bg-success';
                                $percentage_change = 100; // Arbitrary large increase if starting from zero
                            }
                        }


                        $blood_stats[$blood_group] = [
                            'total_units' => $current_units,
                            'percentage_change' => round(abs($percentage_change)),
                            'change_icon' => $change_icon,
                            'badge_class' => $badge_class,
                        ];
                    }
                }
                ?>
                <div class="row g-4 mb-4">
                    <?php foreach ($blood_stats as $group => $stats): ?>
                    <div class="col-md-6 col-xl-3">
                        <div class="glass-card stat-card blood-<?php echo strtolower(str_replace('+', '', $group)); ?> p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="stat-icon"></div>
                                <div class="badge <?php echo $stats['badge_class']; ?> bg-opacity-25 text-<?php echo str_replace('bg-', '', $stats['badge_class']); ?>">
                                    <i class="<?php echo $stats['change_icon']; ?>"></i>
                                    <?php echo $stats['percentage_change']; ?>%
                                </div>
                            </div>
                            <div class="stat-value"><?php echo $stats['total_units']; ?></div>
                            <div class="text-muted"><?php echo $group; ?> Blood Units Available</div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- Blood Inventory Table -->
                <div id="collection" class="glass-card mb-4">
                    <div class="d-flex justify-content-between align-items-center p-4 border-bottom">
                        <div>
                            <h3 class="fw-bold mb-2 d-flex align-items-center gap-2">
                                📦 Blood Inventory Status
                            </h3>
                            <p class="text-muted mb-0">Real-time blood stock monitoring across all centers</p>
                        </div>
                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                        <a href="add_stock.php">
                            <button class="btn btn-primary">
                                <i class="fas fa-plus"></i> Add Stock
                            </button>
                        </a>
                        <?php endif; ?>
                    </div>

                    <div class="table-responsive p-4">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Blood Group</th>
                                    <th>Available Units</th>
                                    <th>Status</th>
                                    <th>Last Updated</th>
                                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                                    <th>Actions</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include 'connect.php';

                                function getBloodGroupClass($bloodGroup) {
                                    $bloodGroup = strtoupper(trim($bloodGroup));
                                    $class_map = [
                                        'A+' => 'a-pos',
                                        'A-' => 'a-neg',
                                        'B+' => 'b-pos',
                                        'B-' => 'b-neg',
                                        'AB+' => 'ab-pos',
                                        'AB-' => 'ab-neg',
                                        'O+' => 'o-pos',
                                        'O-' => 'o-neg',
                                    ];
                                    return $class_map[$bloodGroup] ?? '';
                                }

                                $sql = "SELECT * FROM blood_inventory";
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <tr>
                                    <td><span class="blood-group <?php echo getBloodGroupClass($row['blood_group']); ?>"><?php echo $row['blood_group']; ?></span></td>
                                    <td><strong><?php echo $row['available_units']; ?> units</strong></td>
                                    <td><span class="status-badge status-<?php echo strtolower($row['status']); ?>"><?php echo $row['status']; ?></span></td>
                                    <td><?php echo date('d M Y, h:i A', strtotime($row['last_updated'])); ?></td>
                                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                                    <td>
                                        <a href="edit_stock.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                        <a href="delete_stock.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this record?');"><i class="fas fa-trash"></i></a>
                                    </td>
                                    <?php endif; ?>
                                </tr>
                                <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='5' class='text-center'>No records found</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>


                <!-- Recent Activity & Pending Requests -->
                <div class="row g-4">
                    <!-- Recent Activity -->
                    <div class="col-lg-6">
                        <div class="glass-card h-100">
                            <div class="d-flex justify-content-between align-items-center p-4 border-bottom">
                                <h4 class="fw-bold mb-0">Recent Activity</h4>
                                <a href="blood_event.php">
                                    <button class="btn btn-primary">View All</button>
                                </a>
                            </div>

                            <div class="p-4">
                                <div class="d-flex align-items-center gap-3 mb-3 p-3 rounded">
                                    <div class="activity-icon donation">🩸</div>
                                    <div class="flex-grow-1">
                                        <div class="fw-semibold mb-1">Blood Donation Completed</div>
                                        <div class="text-muted small">Rahul Kumar donated O+ blood</div>
                                    </div>
                                    <div class="text-muted small">2 mins ago</div>
                                </div>

                                <div class="d-flex align-items-center gap-3 mb-3 p-3 rounded">
                                    <div class="activity-icon request">🚨</div>
                                    <div class="flex-grow-1">
                                        <div class="fw-semibold mb-1">Emergency Request</div>
                                        <div class="text-muted small">AB- blood needed at AIIMS Delhi</div>
                                    </div>
                                    <div class="text-muted small">15 mins ago</div>
                                </div>

                                <div class="d-flex align-items-center gap-3 mb-3 p-3 rounded">
                                    <div class="activity-icon registration">👤</div>
                                    <div class="flex-grow-1">
                                        <div class="fw-semibold mb-1">New Donor Registered</div>
                                        <div class="text-muted small">Priya Sharma joined as B+ donor</div>
                                    </div>
                                    <div class="text-muted small">1 hour ago</div>
                                </div>

                                <div class="d-flex align-items-center gap-3 p-3 rounded">
                                    <div class="activity-icon donation">🩸</div>
                                    <div class="flex-grow-1">
                                        <div class="fw-semibold mb-1">Blood Camp Organized</div>
                                        <div class="text-muted small">50 donors participated in Delhi camp</div>
                                    </div>
                                    <div class="text-muted small">3 hours ago</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Requests -->
                    <div class="col-lg-6">
                        <div id="pending" class="glass-card h-100">
                            <div class="d-flex justify-content-between align-items-center p-4 border-bottom">
                                <h4 class.fw-bold mb-0">🚨 Pending Requests</h4>
                            </div>

                            <div class="p-4">
                                <div class="alert alert-danger border-0 mb-3"
                                    style="background: rgba(255, 65, 108, 0.1); border-left: 4px solid #ff416c !important;">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div>
                                            <div class="fw-bold text-danger">🚨 URGENT</div>
                                            <div class="small text-muted">AIIMS New Delhi</div>
                                        </div>
                                        <div class="text-end">
                                            <div class="fw-bold">AB- Negative</div>
                                            <div class="small text-muted">2 units needed</div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="small text-muted">Patient: Emergency Surgery</div>
                                        <button class="btn btn-danger btn-sm">Process</button>
                                    </div>
                                </div>

                                <div class="alert alert-warning border-0 mb-3"
                                    style="background: rgba(245, 158, 11, 0.1); border-left: 4px solid #f59e0b !important;">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div>
                                            <div class="fw-bold text-warning">🏥 HIGH PRIORITY</div>
                                            <div class="small text-muted">Max Hospital Saket</div>
                                        </div>
                                        <div class="text-end">
                                            <div class="fw-bold">O+ Positive</div>
                                            <div class="small text-muted">4 units needed</div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="small text-muted">Patient: Accident Case</div>
                                        <button class="btn btn-warning btn-sm">Process</button>
                                    </div>
                                </div>

                                <div class="alert alert-success border-0"
                                    style="background: rgba(16, 185, 129, 0.1); border-left: 4px solid #10b981 !important;">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div>
                                            <div class="fw-bold text-success">📋 ROUTINE</div>
                                            <div class="small text-muted">Apollo Hospital</div>
                                        </div>
                                        <div class="text-end">
                                            <div class="fw-bold">A+ Positive</div>
                                            <div class="small text-muted">1 unit needed</div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="small text-muted">Patient: Scheduled Surgery</div>
                                        <button class="btn btn-success btn-sm">Process</button>
                                    </div>
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

    <!-- Bootstrap JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <!-- External JS -->
    <script src="script.js"></script>
    <script src="theme.js"></script>
    <script src="particles.js"></script>
</body>

</html>