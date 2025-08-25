<!-- Navigation bar -->
<nav class="navbar navbar-expand-lg navbar-light sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="#">
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

                <div class="d-flex align-items-center gap-2 bg-light bg-opacity-25 rounded-3 p-2">
                    <div class="rounded-circle bg-primary"
                        style="width: 35px; height: 35px; background: url('data:image/svg+xml,<svg xmlns=&quot;http://www.w3.org/2000/svg&quot; viewBox=&quot;0 0 100 100&quot;><circle cx=&quot;50&quot; cy=&quot;35&quot; r=&quot;20&quot; fill=&quot;%23667eea&quot;/><path d=&quot;M20 80 Q50 60 80 80&quot; fill=&quot;%23667eea&quot;/></svg>') center/cover !important;">
                    </div>
                    <div class="text-white">
                        <div style="font-weight: 600; font-size: 0.9rem; color: #667eea;">Dr. Mourique</div>
                        <div style="font-size: 0.75rem; opacity: 0.8;color: #667eea;">Blood Bank Officer</div>
                    </div>
                    <?php include "icon.php" ?>
                </div>
            </div>

        </div>
    </div>
</nav>