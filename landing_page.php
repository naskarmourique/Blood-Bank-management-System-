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
</head>

<body>
    <!-- Navbar -->
    <?php
    include "header.php";
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
                <div class="row g-4 mb-4">
                    <div class="col-md-6 col-xl-3">
                        <div class="glass-card stat-card blood-a p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="stat-icon"></div>
                                <div class="badge bg-success bg-opacity-25 text-success">
                                    <i class="fas fa-arrow-up"></i>
                                    +12%
                                </div>
                            </div>
                            <div class="stat-value">342</div>
                            <div class="text-muted">A+ Blood Units Available</div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3">
                        <div class="glass-card stat-card blood-b p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="stat-icon"></div>
                                <div class="badge bg-success bg-opacity-25 text-success">
                                    <i class="fas fa-arrow-up"></i>
                                    +8%
                                </div>
                            </div>
                            <div class="stat-value">189</div>
                            <div class="text-muted">B+ Blood Units Available</div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3">
                        <div class="glass-card stat-card blood-ab p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="stat-icon"></div>
                                <div class="badge bg-success bg-opacity-25 text-success">
                                    <i class="fas fa-arrow-up"></i>
                                    +5%
                                </div>
                            </div>
                            <div class="stat-value">67</div>
                            <div class="text-muted">AB+ Blood Units Available</div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3">
                        <div class="glass-card stat-card blood-o p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="stat-icon"></div>
                                <div class="badge bg-success bg-opacity-25 text-success">
                                    <i class="fas fa-arrow-up"></i>
                                    +15%
                                </div>
                            </div>
                            <div class="stat-value">445</div>
                            <div class="text-muted">O+ Blood Units Available</div>
                        </div>
                    </div>
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
                        <a href="blood_donor_form.php">
                            <button class="btn btn-primary">
                                <i class="fas fa-plus"></i>
                                Add Stock
                            </button>
                        </a>
                    </div>

                    <div class="table-responsive p-4">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Blood Group</th>
                                    <th>Available Units</th>
                                    <th>Expiry Soon</th>
                                    <th>Status</th>
                                    <th>Last Updated</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                include "connect.php";
                                $select = "SELECT * FROM `inventory` ";
                                $pass = mysqli_query($conn, $select);
                                while ($result = mysqli_fetch_assoc($pass)) {
                                ?>
                                    <tr>
                                        <?php
                                        if ($result["B_GROUP"] == "A+") {
                                        ?>
                                            <td><span class="blood-group a-pos"><?php echo $result["B_GROUP"]; ?></span></td>
                                        <?php
                                        } elseif ($result["B_GROUP"] == "A-") {
                                        ?>
                                            <td><span class="blood-group a-neg"><?php echo $result["B_GROUP"]; ?></span></td>
                                        <?php
                                        } elseif ($result["B_GROUP"] == "B+") {
                                        ?>
                                            <td><span class="blood-group b-pos"><?php echo $result["B_GROUP"]; ?></span></td>
                                        <?php
                                        } elseif ($result["B_GROUP"] == "B-") {
                                        ?>
                                            <td><span class="blood-group b-neg"><?php echo $result["B_GROUP"]; ?></span></td>
                                        <?php
                                        } elseif ($result["B_GROUP"] == "AB+") {
                                        ?>
                                            <td><span class="blood-group ab-pos"><?php echo $result["B_GROUP"]; ?></span></td>
                                        <?php
                                        } elseif ($result["B_GROUP"] == "AB-") {
                                        ?>
                                            <td><span class="blood-group ab-neg"><?php echo $result["B_GROUP"]; ?></span></td>
                                        <?php
                                        } elseif ($result["B_GROUP"] == "O+") {
                                        ?>
                                            <td><span class="blood-group o-pos"><?php echo $result["B_GROUP"]; ?></span></td>
                                        <?php
                                        } elseif ($result["B_GROUP"] == "O-") {
                                        ?>
                                            <td><span class="blood-group o-neg"><?php echo $result["B_GROUP"]; ?></span></td>
                                        <?php
                                        }
                                        ?>
                                        <td><strong><?php echo $result["UNITS"]; ?></strong></td>
                                        <td><?php echo $result["EXPIRY"]; ?></td>
                                        <?php
                                        if ($result["STATUS"] == "Available") {
                                        ?>
                                            <td><span class="status-badge status-available"><?php echo $result["STATUS"]; ?></span></td>
                                        <?php
                                        } elseif ($result["STATUS"] == "Low Stock") {
                                        ?>
                                            <td><span class="status-badge status-low"><?php echo $result["STATUS"]; ?></span></td>
                                        <?php

                                        } elseif ($result["STATUS"] == "Critical") {
                                        ?>
                                            <td><span class="status-badge status-critical"><?php echo $result["STATUS"]; ?></span></td>
                                        <?php
                                        }
                                        ?>
                                        <td><?php echo $result["LAST_UPDATED"]; ?></td>
                                    </tr>
                                <?php } ?>
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
                                <h4 class="fw-bold mb-0">🚨 Pending Requests</h4>
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
</body>

</html>