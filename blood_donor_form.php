<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Registration - BloodConnect</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.jpg" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- External CSS -->
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


    <!-- Floating Particles -->
    <div class="particles"></div>

    <div class="main-wrapper">
        <div class="form-container">
            <div class="form-header">
                <h2>
                    <i class="fas fa-hand-holding-heart icon"></i>
                    Donor Registration
                </h2>
                <button class="close-btn" onclick="closeForm()">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="form-content">
                <div class="section-title">— Join Our Life-Saving Community —</div>

                <!--novalidate  id="donorForm"-->
                <form action="insert_donor.php" method="post">
                    <!-- Full Name -->
                    <div class="form-group">
                        <label for="fullName" class="form-label">
                            <i class="fas fa-user"></i>
                            Full Name <span class="required">*</span>
                        </label>
                        <input type="text" class="form-control" id="fullName" name="fullName" required>
                        <div class="invalid-feedback">Full name is required</div>
                    </div>

                    <!-- Type and Blood Group -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="type" class="form-label">
                                    <i class="fas fa-users"></i>
                                    Type <span class="required">*</span>
                                </label>
                                <select class="form-select" id="type" name="type" required>
                                    <option value="">Select Type</option>
                                    <option value="individual">Individual</option>
                                    <option value="organization">Organization</option>
                                    <option value="corporate">Corporate</option>
                                </select>
                                <div class="invalid-feedback">Please select a type</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="bloodGroup" class="form-label">
                                    <i class="fas fa-tint"></i>
                                    Blood Group <span class="required">*</span>
                                </label>
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
                    </div>

                    <!-- State and City -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="state" class="form-label">
                                    <i class="fas fa-map-marker-alt"></i>
                                    State <span class="required">*</span>
                                </label>
                                <select class="form-select" id="state" name="state" required>
                                    <option value="">Select State</option>
                                    <option value="andhra-pradesh">Andhra Pradesh</option>
                                    <option value="arunachal-pradesh">Arunachal Pradesh</option>
                                    <option value="assam">Assam</option>
                                    <option value="bihar">Bihar</option>
                                    <option value="chhattisgarh">Chhattisgarh</option>
                                    <option value="goa">Goa</option>
                                    <option value="gujarat">Gujarat</option>
                                    <option value="haryana">Haryana</option>
                                    <option value="himachal-pradesh">Himachal Pradesh</option>
                                    <option value="jharkhand">Jharkhand</option>
                                    <option value="karnataka">Karnataka</option>
                                    <option value="kerala">Kerala</option>
                                    <option value="madhya-pradesh">Madhya Pradesh</option>
                                    <option value="maharashtra">Maharashtra</option>
                                    <option value="manipur">Manipur</option>
                                    <option value="meghalaya">Meghalaya</option>
                                    <option value="mizoram">Mizoram</option>
                                    <option value="nagaland">Nagaland</option>
                                    <option value="odisha">Odisha</option>
                                    <option value="punjab">Punjab</option>
                                    <option value="rajasthan">Rajasthan</option>
                                    <option value="sikkim">Sikkim</option>
                                    <option value="tamil-nadu">Tamil Nadu</option>
                                    <option value="telangana">Telangana</option>
                                    <option value="tripura">Tripura</option>
                                    <option value="uttar-pradesh">Uttar Pradesh</option>
                                    <option value="uttarakhand">Uttarakhand</option>
                                    <option value="west-bengal">West Bengal</option>
                                </select>
                                <div class="invalid-feedback">Please select a state</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="city" class="form-label">
                                    <i class="fas fa-city"></i>
                                    City
                                </label>
                                <input type="text" class="form-control" id="city" name="city">
                                <div class="invalid-feedback">City is required</div>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile Number -->
                    <div class="form-group">
                        <label for="mobile" class="form-label">
                            <i class="fas fa-phone"></i>
                            Mobile No <span class="required">*</span>
                        </label>
                        <input type="tel" class="form-control" id="mobile" name="mobile" required>
                        <div class="invalid-feedback">Valid mobile number is required</div>
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope"></i>
                            E-mail <span class="required">*</span>
                        </label>
                        <input type="email" class="form-control" id="email" name="email" required>
                        <div class="invalid-feedback">Valid email is required</div>
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password" class="form-label">
                            <i class="fas fa-lock"></i>
                            Password <span class="required">*</span>
                            <span class="password-hint">(minimum six characters)</span>
                        </label>
                        <input type="password" class="form-control" id="password" name="password" required
                            minlength="6">
                        <div class="invalid-feedback">Password must be at least 6 characters</div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group">
                        <label for="confirmPassword" class="form-label">
                            <i class="fas fa-lock"></i>
                            Confirm Password <span class="required">*</span>
                        </label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                            required>
                        <div class="invalid-feedback">Passwords do not match</div>
                    </div>

                    <!-- Security Question -->
                    <div class="form-group">
                        <label for="securityQuestion" class="form-label">
                            <i class="fas fa-question-circle"></i>
                            Security Question <span class="required">*</span>
                        </label>
                        <select class="form-select" id="securityQuestion" name="securityQuestion" required>
                            <option value="">Select Security Question</option>
                            <option value="pet-name">What is your pet's name?</option>
                            <option value="mother-maiden">What is your mother's maiden name?</option>
                            <option value="birth-city">In which city were you born?</option>
                            <option value="school-name">What is the name of your first school?</option>
                            <option value="favorite-color">What is your favorite color?</option>
                        </select>
                        <div class="invalid-feedback">Please select a security question</div>
                    </div>

                    <!-- Security Answer -->
                    <div class="form-group">
                        <label for="securityAnswer" class="form-label">
                            <i class="fas fa-key"></i>
                            Security Answer <span class="required">*</span>
                        </label>
                        <input type="text" class="form-control" id="securityAnswer" name="securityAnswer" required>
                        <div class="invalid-feedback">Security answer is required</div>
                    </div>

                    <!-- Last Time Blood Donated -->
                    <div class="form-group">
                        <label for="lastDonation" class="form-label">
                            <i class="fas fa-calendar-alt"></i>
                            Last Time Blood Donated
                        </label>
                        <select class="form-select" id="lastDonation" name="lastDonation">
                            <option value="never">Not donated ever</option>
                            <option value="0-3-months">0-3 months ago</option>
                            <option value="3-6-months">3-6 months ago</option>
                            <option value="6-12-months">6-12 months ago</option>
                            <option value="1-year">More than 1 year ago</option>
                        </select>
                    </div>

                    <!-- Terms Agreement -->
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="agreeTerms" name="agreeTerms" required>
                        <label class="form-check-label" for="agreeTerms">
                            I agree to the terms and conditions and consent to being contacted for blood donation drives
                            and emergency blood requests <span class="required">*</span>
                        </label>
                        <div class="invalid-feedback">You must agree to the terms and conditions to register</div>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit" class="btn-submit" name="submit">
                            <i class="fas fa-heart"></i> Register as Donor
                        </button>
                    </div>
                </form>

                <!-- Loading Animation -->
                <div class="loading" id="loading">
                    <div class="spinner"></div>
                    <p>Processing your registration...</p>
                </div>

                <!-- Success Animation -->
                <div class="success-checkmark" id="successCheck"></div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php
    include "footer.php";
    ?>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"> </script>
    <!-- External JS Validations -->
    <script src="donor.js"></script>
</body>

</html>