<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | BloodConnect - National Blood Management System</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.jpg" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="contact_css.css">
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
    </div>

    <div class="container my-5">
        <!-- Hero Section for Contact-Us -->
        <div class="hero glass-dark rounded-4 mb-5 fade-in">
            <div class="hero-content">
                <h1 class="display-4 fw-bold mb-3">💬 Get in Touch</h1>
                <p class="lead mb-0">We're here 24/7 to help save lives. Contact us for emergencies, support, or general inquiries.</p>
            </div>
        </div>

        <!-- Contact Methods -->
        <div class="row g-4 mb-5">
            <div class="col-lg-4 col-md-6 fade-in delay-1">
                <div class="contact-card glass emergency p-4 text-center">
                    <div class="contact-icon">
                        <i class="fas fa-ambulance"></i>
                    </div>
                    <h3 class="h4 fw-bold text-danger mb-3">🚨 Emergency Helpline</h3>
                    <div class="h2 fw-bold text-danger mb-2">108</div>
                    <p class="text-muted mb-4">24/7 Emergency Blood Requests<br>Immediate Response Guaranteed</p>
                    <a href="tel:108" class="btn btn-danger rounded-pill w-100">
                        <i class="fas fa-phone me-2"></i>Call Emergency
                    </a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 fade-in delay-2">
                <div class="contact-card glass general p-4 text-center">
                    <div class="contact-icon" style="background-color: #96c93d;">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3 class="h4 fw-bold text-primary mb-3">📞 General Support</h3>
                    <div class="h5 fw-bold mb-2">+91-11-2345-6789</div>
                    <p class="text-muted mb-4">Mon-Fri: 9 AM - 6 PM<br>General Inquiries & Information</p>
                    <a href="tel:+911123456789" class="btn btn-primary rounded-pill w-100">
                        <i class="fas fa-phone me-2"></i>Call Support
                    </a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mx-auto fade-in delay-3">
                <div class="contact-card glass support p-4 text-center">
                    <div class="contact-icon">
                        <i class="fas fa-tools"></i>
                    </div>
                    <h3 class="h4 fw-bold text-success mb-3">🛠️ Tech Support</h3>
                    <div class="h5 fw-bold mb-2">+91-11-2345-6790</div>
                    <p class="text-muted mb-4">24/7 Technical Support<br>System Issues & Assistance</p>
                    <a href="tel:+911123456790" class="btn btn-success rounded-pill w-100">
                        <i class="fas fa-phone me-2"></i>Get Help
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="row g-5">
            <!-- Contact Form -->
            <div class="col-lg-8">
                <div class="glass p-4 p-lg-5 fade-in">
                    <h2 class="fw-bold mb-2">💌 Send Message</h2>
                    <p class="text-muted mb-4">Fill out the form below and we'll get back to you within 24 hours.</p>
                    <!-- id="contactForm" -->
                    <form action="insert_contact.php" method="post">
                        <!-- Name Fields -->
                        <div class="row g-3 mb-4">
                            <div class="col-sm-6">
                                <label class="form-label fw-semibold">First Name </label>
                                <input type="text" class="form-control" name="fName" id="firstName" placeholder="Enter your first name" required>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label fw-semibold">Last Name </label>
                                <input type="text" class="form-control" name="lName" id="lastName" placeholder="Enter your last name" required>
                            </div>
                        </div>

                        <!-- Contact Fields -->
                        <div class="row g-3 mb-4">
                            <div class="col-sm-6">
                                <label class="form-label fw-semibold">Email Address </label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Ex: abc@hotmail.com" required>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label fw-semibold">Phone Number</label>
                                <input type="tel" class="form-control" name="phone" id="phone" placeholder="Enter your number" required>
                            </div>
                        </div>

                        <!-- Subject -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Subject </label>
                            <select class="form-select" name="subject" id="subject" required>
                                <option value="">Choose your inquiry type</option>
                                <option value="emergency">🚨 Emergency Blood Request</option>
                                <option value="donation">❤️ Blood Donation Inquiry</option>
                                <option value="registration">📝 Donor Registration</option>
                                <option value="technical">🛠️ Technical Support</option>
                                <option value="partnership">🤝 Partnership</option>
                                <option value="feedback">💭 Feedback</option>
                                <option value="other">📋 Other</option>
                            </select>
                        </div>

                        <!-- Message -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Your Message </label>
                            <textarea class="form-control" name="massage" id="message" rows="6" placeholder="Please describe your inquiry in detail..." style="resize: none;" required></textarea>
                        </div>

                        <!-- Newsletter -->
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="newsletter" required>
                            <label class="form-check-label" for="newsletter">
                                📧 Subscribe to blood donation updates and health tips
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" name="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-paper-plane me-2"></i>Send Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="col-lg-4">
                <div class="row g-4">
                    <!-- Office Hours -->
                    <div class="col-12 fade-in delay-1">
                        <div class="glass">
                            <div class="info-item hours">
                                <div class="info-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <h4 class="h5 fw-bold mb-3">⏰ Office Hours</h4>
                                <div class="small">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Monday - Friday:</span>
                                        <strong>9 AM - 6 PM</strong>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Saturday:</span>
                                        <strong>9 AM - 2 PM</strong>
                                    </div>
                                    <div class="d-flex justify-content-between mb-3">
                                        <span>Sunday:</span>
                                        <strong>Emergency Only</strong>
                                    </div>
                                    <div class="alert alert-danger p-2 small mb-0">
                                        🚨 Emergency services available 24/7
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Location -->
                    <div class="col-12 fade-in delay-2">
                        <div class="glass">
                            <div class="info-item location">
                                <div class="info-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <h4 class="h5 fw-bold mb-3">📍 Our Location</h4>
                                <p class="small mb-3">
                                    <strong>BloodConnect HQ</strong><br>
                                    12/4B Park Street <br>
                                    Kolkata - 700016 <br>
                                    West Bengal, India
                                </p>
                                <button class="btn btn-success btn-sm rounded-pill" onclick="openMap()">
                                    <i class="fas fa-directions me-1"></i>Get Directions
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="col-12 fade-in delay-3">
                        <div class="glass">
                            <div class="info-item email">
                                <div class="info-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <h4 class="h5 fw-bold mb-3">✉️ Email Us</h4>
                                <div class="small">
                                    <div class="mb-2">
                                        <strong>General:</strong><br>
                                        <a href="mailto:info@bloodconnect.gov.in" class="text-decoration-none">info@BloodConnect@gov.in</a>
                                    </div>
                                    <div class="mb-2">
                                        <strong>Emergency:</strong><br>
                                        <a href="mailto:emergency@bloodconnect.gov.in" class="text-decoration-none text-danger">emergency@BloodConnect@gov.in</a>
                                    </div>
                                    <div class="mb-0">
                                        <strong>Support:</strong><br>
                                        <a href="mailto:support@bloodconnect.gov.in" class="text-decoration-none">support@BloodConnect@gov.in</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Map Section -->
        <div class="row mt-5">
            <div class="col-12 fade-in">
                <div class="glass p-4">
                    <h3 class="fw-bold mb-4">🗺️ Find Us</h3>
                    <div class="map-container">
                        <div class="map-overlay">
                            <i class="fas fa-map-marked-alt display-4 mb-3"></i>
                            <h4>BloodConnect Headquarters</h4>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3686.431860351831!2d88.3374237!3d22.487974599999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a02709696a03e2d%3A0x9f9dd2c9b4f9cdff!2sSITM%3A%20Best%20BBA%20%26%20BCA%20college%20in%20Kolkata!5e0!3m2!1sen!2sin!4v1755696469488!5m2!1sen!2sin" width="600" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe><br>
                            <button class="btn btn-primary rounded-pill" onclick="openMap()">
                                <i class="fas fa-external-link-alt me-2"></i>Open in Maps
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating Action Button -->
    <button class="fab" data-bs-toggle="modal" data-bs-target="#quickContactModal" title="Quick Contact">
        <i class="fas fa-comments"></i>
    </button>

    <!-- Quick Contact Modal -->
    <div class="modal fade" id="quickContactModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4">
                <div class="modal-header bg-primary text-white rounded-top-4">
                    <h5 class="modal-title">🚀 Quick Contact Options</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="tel:108" class="btn btn-danger w-100 h-100 p-3 d-flex flex-column align-items-center">
                                <i class="fas fa-ambulance mb-2" style="font-size: 2rem;"></i>
                                <small>Emergency</small>
                                <strong>108</strong>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="tel:+911123456789" class="btn btn-primary w-100 h-100 p-3 d-flex flex-column align-items-center">
                                <i class="fas fa-phone mb-2" style="font-size: 2rem;"></i>
                                <small>General</small>
                                <strong>Call Us</strong>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="mailto:info@bloodconnect.gov.in" class="btn btn-warning w-100 h-100 p-3 d-flex flex-column align-items-center">
                                <i class="fas fa-envelope mb-2" style="font-size: 2rem;"></i>
                                <small>Email</small>
                                <strong>Send Mail</strong>
                            </a>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-success w-100 h-100 p-3 d-flex flex-column align-items-center" onclick="openWhatsApp()">
                                <i class="fab fa-whatsapp mb-2" style="font-size: 2rem;"></i>
                                <small>WhatsApp</small>
                                <strong>Chat</strong>
                            </button>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="text-center">
                        <small class="text-muted">Choose the best way to reach us based on your needs</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php
    include "footer.php";
    ?>

    <!-- Toast Container -->
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;"></div>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="contact_js.js"></script>
    
</body>

</html>