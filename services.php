<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BloodConnect | Services</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.jpg" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">

    <!-- External CSS -->
    <link rel="stylesheet" href="styles.css">

    <style>
        .rating-input {
            display: flex;
            flex-direction: row-reverse;
            /* reverse the DOM order */
            gap: 0.25rem;
        }

        .rating-input label {
            font-size: 1.5rem;
            color: #d1d5db;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .rating-input label:hover,
        .rating-input label:hover~label {
            color: #fbbf24;
        }

        .rating-input input[type="radio"]:checked~label {
            color: #fbbf24;
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
        <?php include "hero.php"; ?>

        <!-- Carousel Section -->
        <section id="highlights" class="my-5">
            <div id="bloodCarousel" class="carousel slide" data-bs-ride="carousel">

                <!-- Indicators -->
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#bloodCarousel" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#bloodCarousel" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#bloodCarousel" data-bs-slide-to="2"></button>
                    <button type="button" data-bs-target="#bloodCarousel" data-bs-slide-to="3"></button>
                    <button type="button" data-bs-target="#bloodCarousel" data-bs-slide-to="4"></button>
                </div>

                <!-- Carousel Items -->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="https://nirmawebsite.s3.ap-south-1.amazonaws.com/wp-content/uploads/2022/09/1.jpg" class="d-block w-100"
                            alt="Blood Donation Drive" style="width:100%; height:80vh; object-fit:cover; border-radius: 20px;">
                        <div class="carousel-caption d-none d-sm-block bg-dark bg-opacity-50 rounded p-3">
                            <h5>Join Our Blood Donation Drives</h5>
                            <p>Together we can save millions of lives every year.</p>
                        </div>
                    </div>
                    <div class="carousel-item active">
                        <img src="https://ebloodbank.gov.in/eBloodbank/assets/img/map.png" class="d-block w-100"
                            alt="Blood Bank" style="width:100%; height:80vh; object-fit:cover; border-radius: 20px">
                        <div class="carousel-caption d-none d-sm-block bg-dark bg-opacity-50 rounded p-3">
                            <h5>Nationwide Blood Bank Network</h5>
                            <p>availability of blood at any part of the country</p>
                        </div>
                    </div>
                    <div class="carousel-item active">
                        <img src="https://www.bbh.org/wp-content/uploads/2025/06/hq-header-1.jpg" class="d-block w-100"
                            alt="Emergency Help" style="width:100%; height:80vh; object-fit:cover; border-radius: 20px">
                        <div class="carousel-caption d-none d-sm-block bg-dark bg-opacity-50 rounded p-3">
                            <h5>24/7 Emergency Support</h5>
                            <p>Quick response for urgent blood requirements.</p>
                        </div>
                    </div>
                    <div class="carousel-item active">
                        <img src="https://www.raster.in/img/products/blood-bank/blood-bank-management-system.jpg" class="d-block w-100"
                            alt="Blood Bank" style="width:100%; height:80vh; object-fit:cover; border-radius: 20px">
                        <div class="carousel-caption d-none d-sm-block bg-dark bg-opacity-50 rounded p-3">
                            <h5>Connectivity & Management</h5>
                            <p>Ensures hospitals have good supply or inventories of blood bags</p>
                        </div>
                    </div>
                    <div class="carousel-item active">
                        <img src="https://media.istockphoto.com/id/1757606313/photo/african-businessman-donating-blood-for-people-in-need-in-bright-hospital-female-nurse-with.jpg?s=612x612&w=0&k=20&c=m1C91j3THa82iMJGTfarAT_5qbTlGGhDsl56eNu0004=" class="d-block w-100"
                            alt="Blood Bank" style="width:100%; height:80vh; object-fit:cover; border-radius: 20px">
                        <div class="carousel-caption d-none d-sm-block bg-dark bg-opacity-50 rounded p-3">
                            <h5>Blood Donation Medical Stuff</h5>
                            <p>Donors are treated carefully and availability of other advancements are there</p>
                        </div>
                    </div>
                </div>

                <!-- Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#bloodCarousel" data-bs-slide="prev"
                    style="width:50px; height:50px; background-color: white; border-radius:50%; top:50%; transform:translateY(-50%); opacity:0.9; position:absolute; left:15px;">
                    <span class="carousel-control-prev-icon" aria-hidden="true"
                        style="background-size: 20px 20px; filter: invert(1);"></span>
                </button>

                <button class="carousel-control-next" type="button" data-bs-target="#bloodCarousel" data-bs-slide="next"
                    style="width:50px; height:50px; background-color:white; border-radius:50%; top:50%; transform:translateY(-50%); opacity:0.9; position:absolute; right:15px;">
                    <span class="carousel-control-next-icon" aria-hidden="true"
                        style="background-size: 20px 20px; filter: invert(1);"></span>
                </button>
            </div>
        </section>

        <!-- About Section -->
        <section id="about" class="section my-4 p-4 container">
            <h2 class="text-center mb-4"><i class="fas fa-info-circle"></i> About Us</h2>
            <div class="row g-4 justify-content-center">
                <div class="col-md-4">
                    <div class="flex-item text-center">
                        <i class="fas fa-lightbulb"></i>
                        <h3>Our Mission</h3>
                        <p>To build a reliable national blood network that saves lives through timely donations and
                            accessibility.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="flex-item text-center">
                        <i class="fas fa-cogs"></i>
                        <h3>How It Works</h3>
                        <p>We use smart technology to connect donors, hospitals, and patients in real time across India.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="flex-item text-center" style="height: 275px;">
                        <i class="fas fa-hands-helping"></i>
                        <h3>Why It Matters</h3>
                        <p>Every second counts in an emergency — our system ensures blood reaches where it's needed
                            most.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- NEW FEEDBACK SECTION -->
        <section id="feedback" class="feedback-section py-5">
            <div class="feedback-content container">
                <div class="feedback-header">
                    <h2 class="feedback-title"><i class="fas fa-comments"></i> What People Say</h2>
                    <p class="feedback-subtitle">Real experiences from donors, patients, and healthcare professionals</p>
                </div>

                <div class="row g-4">
                    <!-- Testimonials Column -->
                    <div class="col-lg-7">
                        <div class="feedback-card h-100">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="testimonial-card">
                                        <div class="testimonial-quote">
                                            This platform saved my father's life during his emergency surgery. Within minutes, we found the exact blood type needed at a nearby hospital.
                                        </div>
                                        <div class="testimonial-author">
                                            <div class="author-avatar">P</div>
                                            <div class="author-info">
                                                <h6>Priya Singh</h6>
                                                <small>Patient Family</small>
                                                <div class="rating">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="testimonial-card">
                                        <div class="testimonial-quote">
                                            As a regular donor, I love how easy it is to schedule appointments and track my donation history. The system is incredibly user-friendly.
                                        </div>
                                        <div class="testimonial-author">
                                            <div class="author-avatar">R</div>
                                            <div class="author-info">
                                                <h6>Rohan Ghosh</h6>
                                                <small>Regular Donor</small>
                                                <div class="rating">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="testimonial-card">
                                        <div class="testimonial-quote">
                                            Our hospital has seen a 40% improvement in blood inventory management since integrating with e-BloodBank. Excellent work!
                                        </div>
                                        <div class="testimonial-author">
                                            <div class="author-avatar">S</div>
                                            <div class="author-info">
                                                <h6>Dr. Sunita Reddy</h6>
                                                <small>Hospital Administrator</small>
                                                <div class="rating">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="testimonial-card">
                                        <div class="testimonial-quote">
                                            The mobile app notifications helped me donate blood during a critical shortage in my area. Proud to be part of this life-saving network.
                                        </div>
                                        <div class="testimonial-author">
                                            <div class="author-avatar">A</div>
                                            <div class="author-info">
                                                <h6>Amit Das</h6>
                                                <small>Volunteer Donor</small>
                                                <div class="rating">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="feedback-stats">
                                <div class="feedback-stat">
                                    <span class="feedback-stat-number">4.9</span>
                                    <span class="feedback-stat-label">Average Rating</span>
                                </div>
                                <div class="feedback-stat">
                                    <span class="feedback-stat-number">12k+</span>
                                    <span class="feedback-stat-label">Reviews</span>
                                </div>
                                <div class="feedback-stat">
                                    <span class="feedback-stat-number">98%</span>
                                    <span class="feedback-stat-label">Satisfaction</span>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Feedback Form Column -->
                    <div class="col-lg-5">
                        <div class="feedback-card">
                            <h4 class="text-center mb-4" style="color: #2d3748; font-weight: 700;">
                                <i class="fas fa-pen-alt" style="color: #667eea;"></i> Share Your Experience
                            </h4>
                            <form class="feedback-form p-20 m-20" id="feedbackForm" action="insert_feedback.php" method="post">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="userName" placeholder="Your Name" name="name" required>
                                    <label for="userName">Your Name</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <select class="form-select" id="userType" name="type" required>
                                        <option value="">Choose...</option>
                                        <option value="donor">Blood Donor</option>
                                        <option value="patient">Patient/Family</option>
                                        <option value="hospital">Healthcare Professional</option>
                                        <option value="volunteer">Volunteer</option>
                                    </select>
                                    <label for="userType">You are a</label>
                                </div>

                                <div class="mb-3" style="padding: 10px">
                                    <label class="form-label" style="color: #4a5568; font-weight: 500">Rate your experience</label>
                                    <div class="rating-input">
                                        <input type="radio" id="star5" name="rating" value="5"><label for="star5">★</label>
                                        <input type="radio" id="star4" name="rating" value="4"><label for="star4">★</label>
                                        <input type="radio" id="star3" name="rating" value="3"><label for="star3">★</label>
                                        <input type="radio" id="star2" name="rating" value="2"><label for="star2">★</label>
                                        <input type="radio" id="star1" name="rating" value="1"><label for="star1">★</label>
                                    </div>

                                </div>

                                <div class="form-floating mb-4">
                                    <textarea class="form-control" placeholder="Share your experience" id="feedback" style="height: 200px; resize: none;" name="feedback" required></textarea>
                                    <label for="feedback">Your Feedback</label>
                                </div>

                                <div class="d-grid">
                                    <button class="submit-btn" type="submit" name="submit">
                                        <i class="fas fa-paper-plane me-2"></i>Submit Feedback
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Services Section -->
        <section id="services" class="section my-4 p-4 container">
            <h2 class="text-center mb-4"><i class="fas fa-hand-holding-heart"></i> Our Services</h2>
            <div class="row g-4 justify-content-center ">
                <div class="col-sm-6 col-lg-3">
                    <a href="blood_donor_form.php" style="text-decoration:none; color:#2d3748">
                        <div class="flex-item text-center" style="height: 300px;">
                            <i class="fas fa-user-plus"></i>
                            <h3>Donor Registration</h3>
                            <p>Register and manage profiles of voluntary donors nationwide.</p>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <a href="blood_request.php" style="text-decoration:none; color:#2d3748">
                        <div class="flex-item text-center" style="height: 300px;">
                            <i class="fas fa-ambulance"></i>
                            <h3>Emergency Requests</h3>
                            <p>Real-time tracking and support for urgent blood needs.</p>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <a href="landing_page.php#collection" style="text-decoration:none; color:#2d3748">
                        <div class="flex-item text-center" style="height: 300px;">
                            <i class="fas fa-tint"></i>
                            <h3>Blood Inventory</h3>
                            <p>Monitor availability and expiry of all blood units.</p>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="flex-item text-center" style="height: 300px;">
                        <i class="fas fa-heartbeat"></i>
                        <h3>Health Screening</h3>
                        <p>Maintain a healthy donor base through quality checks.</p>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <?php
    include "footer.php";
    ?>


    <!-- Back to Top Button -->
    <button id="backToTop" title="Back to top"><i class="fas fa-arrow-up"></i></button>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <!-- Back to Top JS -->
    <script>
        const backToTopBtn = document.getElementById("backToTop");

        window.onscroll = function() {
            if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
                backToTopBtn.style.display = "block";
            } else {
                backToTopBtn.style.display = "none";
            }
        };

        backToTopBtn.onclick = function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        };
    </script>
</body>

</html>