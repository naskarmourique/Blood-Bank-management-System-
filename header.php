<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!-- Navigation bar -->
<nav class="navbar navbar-expand-lg navbar-light sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="landing_page.php">
            <div class="logo-icon"></div>
            <div>
                <h1>BloodConnect</h1>
                <p>National Blood Management System</p>
            </div>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="ms-auto d-flex align-items-center gap-3">
                <a href="blood_request.php"><button class="btn btn-danger emergency-btn">
                        <i class="fas fa-plus-circle"></i>
                        Emergency Request
                    </button>
                </a>


                <?php if (isset($_SESSION['user_id'])): ?>
                    <?php
                    if ($_SESSION['role'] === 'admin') {
                        // Fetch pending request count for admin
                        include 'connect.php';
                        $sql_count = "SELECT COUNT(*) as pending_count FROM blood_events WHERE status = 'pending'";
                        $result_count = mysqli_query($conn, $sql_count);
                        $pending_count = 0;
                        if ($result_count) {
                            $pending_count = mysqli_fetch_assoc($result_count)['pending_count'];
                        }
                        ?>
                        <a href="manage_requests.php" class="btn btn-warning position-relative">
                            <i class="fas fa-tasks"></i> Manage Requests
                            <?php if ($pending_count > 0): ?>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    <?php echo $pending_count; ?>
                                    <span class="visually-hidden">pending requests</span>
                                </span>
                            <?php endif; ?>
                        </a>
                        <?php
                    }
                    ?>
                    <a href="logout.php" class="btn btn-logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
                <?php else: ?>
                    <a href="login.php" class="btn btn-login"><i class="fas fa-sign-in-alt"></i> Admin Login</a>
                <?php endif; ?>

                <div class="d-flex align-items-center gap-2 bg-light bg-opacity-25 rounded-3 p-2">
                    <div class="rounded-circle bg-primary"
                        style="width: 35px; height: 35px; background: url('data:image/svg+xml,<svg xmlns=&quot;http://www.w3.org/2000/svg&quot; viewBox=&quot;0 0 100 100&quot;><circle cx=&quot;50&quot; cy=&quot;35&quot; r=&quot;20&quot; fill=&quot;%23667eea&quot;/><path d=&quot;M20 80 Q50 60 80 80&quot; fill=&quot;%23667eea&quot;/></svg>') center/cover !important;">
                    </div>
                    <div class="text-white">
                        <div style="font-weight: 600; font-size: 0.9rem; color: #667eea;">Mourique</div>
                        <div style="font-size: 0.75rem; opacity: 0.8;color: #667eea;">Blood Bank Officer</div>
                    </div>
                    <?php include "icon.php" ?>
                </div>
            </div>

        </div>
    </div>
</nav>