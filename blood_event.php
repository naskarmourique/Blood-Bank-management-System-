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
    <!-- Navbar -->
    <?php
    include "header.php";
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
            <button class="create-event-btn" data-bs-toggle="modal" data-bs-target="#requestEventModal">
                <i class="fas fa-plus-circle me-2"></i>
                Request New Event
            </button>
        </div>

        <!-- Filters -->
        <div class="d-flex justify-content-center gap-3 mb-4 flex-wrap">
            <a href="#" class="filter-btn active" data-filter="all">All Events</a>
            <a href="#" class="filter-btn" data-filter="upcoming">Upcoming</a>
            <a href="#" class="filter-btn" data-filter="ongoing">Ongoing</a>
            <a href="#" class="filter-btn" data-filter="completed">Completed</a>
        </div>

        <!-- Events Grid -->
        <div class="g-4 mb-5" id="eventsContainer">
            <!-- Featured Event -->
            <div class="col">
                <div class="event-card featured">
                    <div class="d-flex">
                        <div class="event-date">
                            <div class="event-day">15</div>
                            <div class="event-month">AUG</div>
                        </div>
                        <div class="p-4 flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h4 class="fw-bold mb-1">Mega Blood Drive - Delhi</h4>
                                <span class="event-status status-upcoming">Upcoming</span>
                            </div>
                            <div class="mb-3">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <i class="fas fa-map-marker-alt text-danger"></i>
                                    <span>India Gate, New Delhi</span>
                                </div>
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <i class="fas fa-clock text-danger"></i>
                                    <span>9:00 AM - 5:00 PM</span>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fas fa-hospital text-danger"></i>
                                    <span>AIIMS Delhi & Red Cross Society</span>
                                </div>
                            </div>
                            <p class="text-muted mb-3">Join us for the largest blood donation camp in Delhi. Help us
                                save lives together!</p>
                            <div class="event-stats">
                                <div class="stat-item">
                                    <div class="stat-number">250</div>
                                    <div class="stat-label">Target Donors</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-number">127</div>
                                    <div class="stat-label">Registered</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-number">5</div>
                                    <div class="stat-label">Days Left</div>
                                </div>
                            </div>
                            <button class="btn btn-danger mt-3 w-100"
                                onclick="window.location.href='blood_donor_form.php'">
                                <i class="fas fa-user-plus me-2"></i>Register Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Regular Events -->
            <div class="col">
                <div class="event-card">
                    <div class="d-flex">
                        <div class="event-date">
                            <div class="event-day">12</div>
                            <div class="event-month">AUG</div>
                        </div>
                        <div class="p-3 flex-grow-1">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="fw-bold mb-0">Corporate Drive - TCS</h5>
                                <span class="event-status status-ongoing">Ongoing</span>
                            </div>
                            <div class="small text-muted mb-2">
                                <i class="fas fa-map-marker-alt me-1"></i>TCS Campus, Bangalore
                            </div>
                            <div class="event-stats">
                                <div class="stat-item">
                                    <div class="stat-number">42</div>
                                    <div class="stat-label">Donated</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-number">18</div>
                                    <div class="stat-label">Pending</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- New Ongoing Card 1 -->
            <div class="col">
                <div class="event-card">
                    <div class="d-flex">
                        <div class="event-date">
                            <div class="event-day">14</div>
                            <div class="event-month">AUG</div>
                        </div>
                        <div class="p-3 flex-grow-1">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="fw-bold mb-0">Hospital Charity Drive</h5>
                                <span class="event-status status-ongoing">Ongoing</span>
                            </div>
                            <div class="small text-muted mb-2">
                                <i class="fas fa-map-marker-alt me-1"></i>Apollo Hospital, Mumbai
                            </div>
                            <div class="event-stats">
                                <div class="stat-item">
                                    <div class="stat-number">42</div>
                                    <div class="stat-label">Donated</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-number">18</div>
                                    <div class="stat-label">Pending</div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- New Ongoing Card 2 -->
            <div class="col">
                <div class="event-card">
                    <div class="d-flex">
                        <div class="event-date">
                            <div class="event-day">18</div>
                            <div class="event-month">AUG</div>
                        </div>
                        <div class="p-3 flex-grow-1">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="fw-bold mb-0">City Sports Arena Drive</h5>
                                <span class="event-status status-ongoing">Ongoing</span>
                            </div>
                            <div class="small text-muted mb-2">
                                <i class="fas fa-map-marker-alt me-1"></i>Sports Arena, Delhi
                            </div>
                            <div class="event-stats">
                                <div class="stat-item">
                                    <div class="stat-number">42</div>
                                    <div class="stat-label">Donated</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-number">18</div>
                                    <div class="stat-label">Pending</div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- New Ongoing Card 3 -->
            <div class="col">
                <div class="event-card">
                    <div class="d-flex">
                        <div class="event-date">
                            <div class="event-day">22</div>
                            <div class="event-month">AUG</div>
                        </div>
                        <div class="p-3 flex-grow-1">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="fw-bold mb-0">Tech Park Blood Drive</h5>
                                <span class="event-status status-ongoing">Ongoing</span>
                            </div>
                            <div class="small text-muted mb-2">
                                <i class="fas fa-map-marker-alt me-1"></i>Cyberhub, Gurgaon
                            </div>
                            <div class="event-stats">
                                <div class="stat-item">
                                    <div class="stat-number">42</div>
                                    <div class="stat-label">Donated</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-number">18</div>
                                    <div class="stat-label">Pending</div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="event-card">
                    <div class="d-flex">
                        <div class="event-date">
                            <div class="event-day">18</div>
                            <div class="event-month">AUG</div>
                        </div>
                        <div class="p-3 flex-grow-1">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="fw-bold mb-0">University Drive</h5>
                                <span class="event-status status-upcoming">Upcoming</span>
                            </div>
                            <div class="small text-muted mb-2">
                                <i class="fas fa-map-marker-alt me-1"></i>IIT Mumbai
                            </div>
                            <div class="event-stats">
                                <div class="stat-item">
                                    <div class="stat-number">89</div>
                                    <div class="stat-label">Registered</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-number">150</div>
                                    <div class="stat-label">Target</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="event-card">
                    <div class="d-flex">
                        <div class="event-date">
                            <div class="event-day">05</div>
                            <div class="event-month">AUG</div>
                        </div>
                        <div class="p-3 flex-grow-1">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="fw-bold mb-0">Community Camp</h5>
                                <span class="event-status status-completed">Completed</span>
                            </div>
                            <div class="small text-muted mb-2">
                                <i class="fas fa-map-marker-alt me-1"></i>Sector 21, Noida
                            </div>
                            <div class="event-stats">
                                <div class="stat-item">
                                    <div class="stat-number">156</div>
                                    <div class="stat-label">Collected</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-number">98%</div>
                                    <div class="stat-label">Success</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- New Completed Card 1 -->
            <div class="col">
                <div class="event-card">
                    <div class="d-flex">
                        <div class="event-date">
                            <div class="event-day">07</div>
                            <div class="event-month">AUG</div>
                        </div>
                        <div class="p-3 flex-grow-1">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="fw-bold mb-0">Central Mall Blood Drive</h5>
                                <span class="event-status status-completed">Completed</span>
                            </div>
                            <div class="small text-muted mb-2">
                                <i class="fas fa-map-marker-alt me-1"></i>Central Mall, Indore
                            </div>
                            <div class="event-stats">
                                <div class="stat-item">
                                    <div class="stat-number">132</div>
                                    <div class="stat-label">Collected</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-number">95%</div>
                                    <div class="stat-label">Success</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- New Completed Card 2 -->
            <div class="col">
                <div class="event-card">
                    <div class="d-flex">
                        <div class="event-date">
                            <div class="event-day">09</div>
                            <div class="event-month">AUG</div>
                        </div>
                        <div class="p-3 flex-grow-1">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="fw-bold mb-0">Metro Station Camp</h5>
                                <span class="event-status status-completed">Completed</span>
                            </div>
                            <div class="small text-muted mb-2">
                                <i class="fas fa-map-marker-alt me-1"></i>Metro Station, Chandigarh
                            </div>
                            <div class="event-stats">
                                <div class="stat-item">
                                    <div class="stat-number">148</div>
                                    <div class="stat-label">Collected</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-number">97%</div>
                                    <div class="stat-label">Success</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- New Completed Card 3 -->
            <div class="col">
                <div class="event-card">
                    <div class="d-flex">
                        <div class="event-date">
                            <div class="event-day">11</div>
                            <div class="event-month">AUG</div>
                        </div>
                        <div class="p-3 flex-grow-1">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="fw-bold mb-0">Green Park Community Drive</h5>
                                <span class="event-status status-completed">Completed</span>
                            </div>
                            <div class="small text-muted mb-2">
                                <i class="fas fa-map-marker-alt me-1"></i>Green Park, New Delhi
                            </div>
                            <div class="event-stats">
                                <div class="stat-item">
                                    <div class="stat-number">165</div>
                                    <div class="stat-label">Collected</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-number">99%</div>
                                    <div class="stat-label">Success</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <!-- More Events -->
        <div class="row g-4 mb-5" id="moreEvents">
            <div class="col-md-6 col-lg-4">
                <div class="event-card h-100">
                    <div class="event-date">
                        <div class="event-day">22</div>
                        <div class="event-month">AUG</div>
                    </div>
                    <div class="p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-bold mb-0">Hospital Drive</h5>
                            <span class="event-status status-upcoming">Upcoming</span>
                        </div>
                        <div class="mb-3">
                            <div class="small text-muted mb-2">
                                <i class="fas fa-map-marker-alt me-1"></i>Apollo Hospital, Chennai
                            </div>
                            <div class="small text-muted">
                                <i class="fas fa-clock me-1"></i>8:00 AM - 4:00 PM
                            </div>
                        </div>
                        <div class="event-stats">
                            <div class="stat-item">
                                <div class="stat-number">67</div>
                                <div class="stat-label">Registered</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">100</div>
                                <div class="stat-label">Target</div>
                            </div>
                        </div>
                        <button class="btn btn-outline-danger mt-3 w-100 view-details-btn" data-title="Hospital Drive"
                            data-date="22 Aug 2024" data-time="8:00 AM - 4:00 PM"
                            data-location="Apollo Hospital, Chennai"
                            data-description="A blood drive to support local hospitals and meet urgent blood requirements.">
                            View Details
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="event-card h-100">
                    <div class="event-date">
                        <div class="event-day">25</div>
                        <div class="event-month">AUG</div>
                    </div>
                    <div class="p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-bold mb-0">Mall Drive</h5>
                            <span class="event-status status-upcoming">Upcoming</span>
                        </div>
                        <div class="mb-3">
                            <div class="small text-muted mb-2">
                                <i class="fas fa-map-marker-alt me-1"></i>Phoenix Mall, Pune
                            </div>
                            <div class="small text-muted">
                                <i class="fas fa-clock me-1"></i>10:00 AM - 8:00 PM
                            </div>
                        </div>
                        <div class="event-stats">
                            <div class="stat-item">
                                <div class="stat-number">34</div>
                                <div class="stat-label">Registered</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">80</div>
                                <div class="stat-label">Target</div>
                            </div>
                        </div>
                        <button class="btn btn-outline-danger mt-3 w-100 view-details-btn" data-title="Mall Drive"
                            data-date="25 Aug 2024" data-time="10:00 AM - 8:00 PM" data-location="Phoenix Mall, Pune"
                            data-description="Join us for a community blood donation camp at Phoenix Mall to help save lives.">
                            View Details
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="event-card h-100">
                    <div class="event-date">
                        <div class="event-day">28</div>
                        <div class="event-month">AUG</div>
                    </div>
                    <div class="p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-bold mb-0">School Drive</h5>
                            <span class="event-status status-upcoming">Upcoming</span>
                        </div>
                        <div class="mb-3">
                            <div class="small text-muted mb-2">
                                <i class="fas fa-map-marker-alt me-1"></i>DAV School, Kolkata
                            </div>
                            <div class="small text-muted">
                                <i class="fas fa-clock me-1"></i>9:00 AM - 3:00 PM
                            </div>
                        </div>
                        <div class="event-stats">
                            <div class="stat-item">
                                <div class="stat-number">23</div>
                                <div class="stat-label">Registered</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">60</div>
                                <div class="stat-label">Target</div>
                            </div>
                        </div>
                        <button class="btn btn-outline-danger mt-3 w-100 view-details-btn" data-title="School Drive"
                            data-date="28 Aug 2024" data-time="9:00 AM - 3:00 PM" data-location="DAV School, Kolkata"
                            data-description="School-organized blood donation event encouraging young donors and community members.">
                            View Details
                        </button>
                    </div>
                </div>
            </div>
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

        <!-- Request Event Modal -->
        <div class="modal fade" id="requestEventModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="border-radius: 20px; border: none;">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">
                            <i class="fas fa-plus-circle me-2"></i>Request New Blood Drive Event
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4">
                        <form id="requestEventForm">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="eventTitle" name="eventTitle" required>
                                        <label for="eventTitle">Event Title *</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select" id="eventType" name="eventType" required>
                                            <option value="">Choose Type</option>
                                            <option value="Community Drive">Community Drive</option>
                                            <option value="Corporate Drive">Corporate Drive</option>
                                            <option value="Hospital Drive">Hospital Drive</option>
                                            <option value="University Drive">University Drive</option>
                                            <option value="Mall Drive">Mall Drive</option>
                                            <option value="School Drive">School Drive</option>
                                        </select>
                                        <label for="eventType">Event Type *</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="eventLocation" name="eventLocation"
                                            required>
                                        <label for="eventLocation">Location *</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="date" class="form-control" id="eventDate" name="eventDate" required>
                                        <label for="eventDate">Date *</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="time" class="form-control" id="startTime" name="startTime" required>
                                        <label for="startTime">Start Time *</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="time" class="form-control" id="endTime" name="endTime" required>
                                        <label for="endTime">End Time *</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" id="targetDonors" name="targetDonors"
                                            min="1" required>
                                        <label for="targetDonors">Target Donors *</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="contactPerson" name="contactPerson"
                                            required>
                                        <label for="contactPerson">Contact Person *</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" id="eventDescription" name="eventDescription"
                                            style="height: 100px"></textarea>
                                        <label for="eventDescription">Description</label>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" onclick="requestEvent()">
                            <i class="fas fa-save me-2"></i>Request Event
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Request Confirmation Model -->
        <div class="modal fade" id="requestConfirmationModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content shadow-lg border-0" style="border-radius: 20px;">
                    <div class="modal-header bg-success text-white rounded-top">
                        <h5 class="modal-title fw-bold">
                            <i class="fas fa-check-circle me-2"></i>Request Received
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="alert alert-success" style="border-radius: 15px;">
                            🎉 Thank you for submitting your blood drive event request.
                            Our team will review the details and contact you soon.
                        </div>

                        <h6 class="fw-bold mt-4 mb-3">
                            <i class="fas fa-info-circle me-2 text-success"></i>Event Details
                        </h6>
                        <ul id="confirmationDetails" class="list-group list-group-flush shadow-sm rounded"
                            style="border: 1px solid rgba(0,0,0,0.05);"></ul>
                    </div>
                    <div class="modal-footer bg-light rounded-bottom">
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">
                            <i class="fas fa-check me-2"></i>Close
                        </button>
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

</body>

</html>