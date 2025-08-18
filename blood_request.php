<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Request - BloodConnect</title>
    <link rel="shortcut icon" href="favicon.jpg" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="donor.css">
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

    <div class="particles"></div>

    <div class="main-wrapper">
        <div class="form-container">
            <div class="form-header">
                <h2><i class="fas fa-ambulance icon"></i> Blood Request</h2>
                <button class="close-btn" onclick="closeForm()"><i class="fas fa-times"></i></button>
            </div>

            <div class="form-content">
                <div class="section-title">— Request Blood Urgently —</div>

                <!-- id="requestForm" novalidate -->
                <form action="insert_request.php" method="post">
                    <!-- Patient Name -->
                    <div class="form-group">
                        <label for="patientName" class="form-label"><i class="fas fa-user-injured"></i> Patient Name
                            <span class="required">*</span></label>
                        <input type="text" class="form-control" id="patientName" name="pName" required>
                        <div class="invalid-feedback">Patient name is required</div>
                    </div>

                    <!-- Blood Group & Units Needed -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="bloodGroup" class="form-label"><i class="fas fa-tint"></i> Blood Group <span
                                        class="required">*</span></label>
                                <select class="form-select" id="bloodGroup" name="bloodGroup" required>
                                    <option value="">Select Blood Group</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                </select>
                                <div class="invalid-feedback">Please select blood group</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="units" class="form-label"><i class="fas fa-vials"></i> Units Required <span
                                        class="required">*</span></label>
                                <input type="number" class="form-control" id="units" name="units" min="1" max="10" required>
                                <div class="invalid-feedback">Enter valid units (1–10)</div>
                            </div>
                        </div>
                    </div>

                    <!-- Hospital Name & Location -->
                    <div class="form-group">
                        <label for="hospital" class="form-label"><i class="fas fa-hospital"></i> Hospital Name <span
                                class="required">*</span></label>
                        <input type="text" class="form-control" id="hospital" name="hName" required>
                        <div class="invalid-feedback">Hospital name is required</div>
                    </div>

                    <div class="form-group">
                        <label for="location" class="form-label"><i class="fas fa-map-marker-alt"></i> Hospital Location
                            <span class="required">*</span></label>
                        <input type="text" class="form-control" id="location" name="hLocation" required>
                        <div class="invalid-feedback">Location is required</div>
                    </div>

                    <!-- Contact Number -->
                    <div class="form-group">
                        <label for="mobile" class="form-label"><i class="fas fa-phone"></i> Contact No <span
                                class="required">*</span></label>
                        <input type="tel" class="form-control" id="mobile" name="mobile" required>
                        <div class="invalid-feedback">Valid contact number is required</div>
                    </div>

                    <!-- Needed Date -->
                    <div class="form-group">
                        <label for="neededDate" class="form-label"><i class="fas fa-calendar-alt"></i> Required By Date
                            <span class="required">*</span></label>
                        <input type="date" class="form-control" id="neededDate" name="rDate" required>
                        <div class="invalid-feedback">Please select a date</div>
                    </div>

                    <!-- Terms Agreement -->
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="agreeTerms" required>
                        <label class="form-check-label" for="agreeTerms">I confirm that the above information is correct
                            and I consent to being contacted for this request <span class="required">*</span></label>
                        <div class="invalid-feedback">You must agree before submitting</div>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit" class="btn-submit" name="submit"><i class="fas fa-paper-plane"></i> Submit
                            Request</button>
                    </div>
                </form>

                <div class="loading" id="loading">
                    <div class="spinner"></div>
                    <p>Processing your request...</p>
                </div>
                <div class="success-checkmark" id="successCheck"></div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php
    include "footer.php";
    ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="request.js"></script>
</body>

</html>