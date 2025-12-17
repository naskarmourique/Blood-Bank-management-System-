
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

                <a href="blood_donor_form.php"><button class="btn btn-danger emergency-btn">
                        <i class="fas fa-hand-holding-heart"></i>
                        Donate Blood
                    </button>
                </a>

                <a href="blood_event.php"><button class="btn btn-danger emergency-btn">
                        <i class="fa-solid fa-hand-holding-droplet"></i>
                        Events
                    </button>
                </a>


                <?php if (isset($_SESSION['user_id'])): ?>
                    <?php
                    if ($_SESSION['role'] === 'admin') {
                        // Fetch pending request count for admin
                        include 'connect.php';

                        // Count pending events
                        $sql_events_count = "SELECT COUNT(*) as pending_events FROM blood_events WHERE status = 'pending'";
                        $result_events_count = mysqli_query($conn, $sql_events_count);
                        $pending_events_count = 0;
                        if ($result_events_count) {
                            $pending_events_count = mysqli_fetch_assoc($result_events_count)['pending_events'];
                        }

                        // Count pending blood requests
                        $sql_blood_count = "SELECT COUNT(*) as pending_blood FROM blood_request WHERE status = 'pending'";
                        $result_blood_count = mysqli_query($conn, $sql_blood_count);
                        $pending_blood_count = 0;
                        if ($result_blood_count) {
                            $pending_blood_count = mysqli_fetch_assoc($result_blood_count)['pending_blood'];
                        }

                        // Count pending donor requests
                        $sql_donor_count = "SELECT COUNT(*) as pending_donors FROM donor WHERE status = 'pending'";
                        $result_donor_count = mysqli_query($conn, $sql_donor_count);
                        $pending_donor_count = 0;
                        if ($result_donor_count) {
                            $pending_donor_count = mysqli_fetch_assoc($result_donor_count)['pending_donors'];
                        }

                        $total_pending_count = $pending_events_count + $pending_blood_count + $pending_donor_count;
                        ?>
                        <a href="manage_requests.php" class="btn btn-warning position-relative">
                            <i class="fas fa-tasks"></i> Manage Requests
                            <?php if ($total_pending_count > 0): ?>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    <?php echo $total_pending_count; ?>
                                    <span class="visually-hidden">pending requests</span>
                                </span>
                            <?php endif; ?>
                        </a>
                        <?php
                    }
                    ?>
                    <a href="logout.php" class="btn btn-logout" style="transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;" onmouseover="this.style.transform='scale(1.1)'; this.style.boxShadow='0 8px 20px rgba(0, 0, 0, 0.3)'; this.style.color='white';" onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none'; this.style.color='white';"><i class="fas fa-sign-out-alt"></i></a>
                <?php else: ?>
                    <a href="login.php" class="btn btn-login" style="transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;" onmouseover="this.style.transform='scale(1.1)'; this.style.boxShadow='0 8px 20px rgba(0, 0, 0, 0.3)'; this.style.color='white';" onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none'; this.style.color='white';"><i class="fas fa-sign-in-alt"></i> Admin Login</a>
                <?php endif; ?>

                <!-- BBO Details Trigger -->
                <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#bboDetailsModal" style="cursor: pointer;">
                    <div class="d-flex align-items-center gap-2 bg-light bg-opacity-25 rounded-3 p-2">
                        <div class="rounded-circle bg-primary"
                            style="width: 35px; height: 35px; background: url('data:image/svg+xml,<svg xmlns=&quot;http://www.w3.org/2000/svg&quot; viewBox=&quot;0 0 100 100&quot;><circle cx=&quot;50&quot; cy=&quot;35&quot; r=&quot;20&quot; fill=&quot;%23667eea&quot;/><path d=&quot;M20 80 Q50 60 80 80&quot; fill=&quot;%23667eea&quot;/></svg>') center/cover !important;">
                        </div>
                        <div class="text-white">
                            <div style="font-weight: 600; font-size: 0.9rem; color: #667eea;">Mourique</div>
                            <div style="font-size: 0.75rem; opacity: 0.8;color: #667eea;">Blood Bank Officer</div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</nav>

<!-- BBO Details Modal -->
<div class="modal fade" id="bboDetailsModal" tabindex="-1" aria-labelledby="bboDetailsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius: 15px; overflow: hidden;">
      <div class="modal-header text-white" style="background: linear-gradient(45deg, #a80505, #e63737); border-bottom: none;">
        <h5 class="modal-title" id="bboDetailsModalLabel"><i class="fas fa-user-shield me-2"></i>Blood Bank Officer Profile</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <div class="text-center mb-4">
            <img src="favicon.jpg" class="rounded-circle border border-2 border-danger p-1" alt="BBO" width="100">
            <h4 class="mt-3 mb-0">Mourique</h4>
            <p class="text-muted">Lead Blood Bank Officer</p>
            <p class="fst-italic text-danger">"Ensuring every drop counts towards saving a life."</p>
        </div>
        
        <div class="card mb-3">
            <div class="card-header bg-light">
                <i class="fas fa-tasks me-2"></i>Key Responsibilities
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Overseeing daily inventory and stock management.</li>
                <li class="list-group-item">Coordinating with hospitals for urgent requests.</li>
                <li class="list-group-item">Ensuring compliance with safety standards.</li>
            </ul>
        </div>

        <div class="card">
             <div class="card-header bg-light">
                <i class="fas fa-id-card me-2"></i>Official Contact
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><i class="fas fa-envelope me-2"></i><strong>Email:</strong> <a href="mailto:mourique.bbo@bloodconnect.org">mourique.bbo@bloodconnect.org</a></li>
                <li class="list-group-item"><i class="fas fa-phone me-2"></i><strong>Helpline:</strong> +91 98765 43210</li>
            </ul>
        </div>
      </div>
    </div>
  </div>
</div>