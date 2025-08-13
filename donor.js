// Create floating particles
function createParticles() {
    const particlesContainer = document.querySelector('.particles');
    const particleCount = 50;

    for (let i = 0; i < particleCount; i++) {
        const particle = document.createElement('div');
        particle.className = 'particle';
        particle.style.left = Math.random() * 100 + '%';
        particle.style.animationDelay = Math.random() * 15 + 's';
        particle.style.animationDuration = (Math.random() * 10 + 10) + 's';
        particlesContainer.appendChild(particle);
    }
}

function closeForm() {
    if (confirm('❌ Are you sure you want to close this form?')) {
        window.close();
        window.open("landing_page.php","_self");
    }
}

// Helper function to show error
function showError(fieldId, message) {
    const field = document.getElementById(fieldId);
    field.classList.add('is-invalid');
    const feedback = field.parentNode.querySelector('.invalid-feedback');
    if (feedback) {
        feedback.textContent = message;
    }
}

// Helper function to clear error
function clearError(fieldId) {
    const field = document.getElementById(fieldId);
    field.classList.remove('is-invalid');
}

// Clear all errors
function clearAllErrors() {
    const invalidFields = document.querySelectorAll('.is-invalid');
    invalidFields.forEach(field => field.classList.remove('is-invalid'));
}

// Validate full name
function validateFullName() {
    const fullName = document.getElementById('fullName').value.trim();

    if (fullName === '') {
        showError('fullName', 'Full name is required');
        return false;
    }

    if (fullName.length < 3) {
        showError('fullName', 'Full name must be at least 3 characters');
        return false;
    }

    const namePattern = /^[a-zA-Z\s]+$/;
    if (!namePattern.test(fullName)) {
        showError('fullName', 'Full name should contain only letters and spaces');
        return false;
    }

    clearError('fullName');
    return true;
}

// Validate type selection
function validateType() {
    const type = document.getElementById('type').value;

    if (type === '') {
        showError('type', 'Please select a type');
        return false;
    }

    clearError('type');
    return true;
}

// Validate blood group
function validateBloodGroup() {
    const bloodGroup = document.getElementById('bloodGroup').value;

    if (bloodGroup === '') {
        showError('bloodGroup', 'Please select blood group');
        return false;
    }

    clearError('bloodGroup');
    return true;
}

// Validate state
function validateState() {
    const state = document.getElementById('state').value;

    if (state === '') {
        showError('state', 'Please select a state');
        return false;
    }

    clearError('state');
    return true;
}

// Validate city
function validateCity() {
    const city = document.getElementById('city').value.trim();

    if (city !== '') {
        if (city.length < 2) {
            showError('city', 'City name must be at least 2 characters');
            return false;
        }

        const cityPattern = /^[a-zA-Z\s]+$/;
        if (!cityPattern.test(city)) {
            showError('city', 'City name should contain only letters and spaces');
            return false;
        }
    }

    clearError('city');
    return true;
}

// Validate mobile number
function validateMobile() {
    const mobile = document.getElementById('mobile').value.trim();

    if (mobile === '') {
        showError('mobile', 'Mobile number is required');
        return false;
    }

    const mobilePattern = /^\d+$/;
    if (!mobilePattern.test(mobile)) {
        showError('mobile', 'Mobile number should contain only digits');
        return false;
    }

    if (mobile.length !== 10) {
        showError('mobile', 'Mobile number must be exactly 10 digits');
        return false;
    }

    if (mobile.charAt(0) < '6' || mobile.charAt(0) > '9') {
        showError('mobile', 'Mobile number should start with 6, 7, 8, or 9');
        return false;
    }

    clearError('mobile');
    return true;
}

// Validate email
function validateEmail() {
    const email = document.getElementById('email').value.trim();

    if (email === '') {
        showError('email', 'Email is required');
        return false;
    }

    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!emailPattern.test(email)) {
        showError('email', 'Please enter a valid email address');
        return false;
    }

    clearError('email');
    return true;
}

// Validate password
function validatePassword() {
    const password = document.getElementById('password').value;

    if (password === '') {
        showError('password', 'Password is required');
        return false;
    }

    if (password.length < 6) {
        showError('password', 'Password must be at least 6 characters long');
        return false;
    }

    const hasLetter = /[a-zA-Z]/.test(password);
    const hasNumber = /\d/.test(password);

    if (!hasLetter || !hasNumber) {
        showError('password', 'Password must contain at least one letter and one number');
        return false;
    }

    clearError('password');
    return true;
}

// Validate confirm password
function validateConfirmPassword() {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;

    if (confirmPassword === '') {
        showError('confirmPassword', 'Please confirm your password');
        return false;
    }

    if (password !== confirmPassword) {
        showError('confirmPassword', 'Passwords do not match');
        return false;
    }

    clearError('confirmPassword');
    return true;
}

// Validate security question
function validateSecurityQuestion() {
    const securityQuestion = document.getElementById('securityQuestion').value;

    if (securityQuestion === '') {
        showError('securityQuestion', 'Please select a security question');
        return false;
    }

    clearError('securityQuestion');
    return true;
}

// Validate security answer
function validateSecurityAnswer() {
    const securityAnswer = document.getElementById('securityAnswer').value.trim();

    if (securityAnswer === '') {
        showError('securityAnswer', 'Security answer is required');
        return false;
    }

    if (securityAnswer.length < 2) {
        showError('securityAnswer', 'Security answer must be at least 2 characters');
        return false;
    }

    clearError('securityAnswer');
    return true;
}

// Validate terms agreement
function validateTermsAgreement() {
    const agreeTerms = document.getElementById('agreeTerms').checked;

    if (!agreeTerms) {
        showError('agreeTerms', 'You must agree to the terms and conditions to register');
        return false;
    }

    clearError('agreeTerms');
    return true;
}

// Main form validation function
function validateForm() {
    clearAllErrors();

    let isValid = true;

    if (!validateFullName()) isValid = false;
    if (!validateType()) isValid = false;
    if (!validateBloodGroup()) isValid = false;
    if (!validateState()) isValid = false;
    if (!validateCity()) isValid = false;
    if (!validateMobile()) isValid = false;
    if (!validateEmail()) isValid = false;
    if (!validatePassword()) isValid = false;
    if (!validateConfirmPassword()) isValid = false;
    if (!validateSecurityQuestion()) isValid = false;
    if (!validateSecurityAnswer()) isValid = false;
    if (!validateTermsAgreement()) isValid = false;

    return isValid;
}

// Form submission handler
function handleSubmit(event) {
    event.preventDefault();

    if (validateForm()) {
        // Show loading animation
        document.getElementById('donorForm').style.display = 'none';
        document.getElementById('loading').style.display = 'block';

        // Simulate form submission
        setTimeout(() => {
            document.getElementById('loading').style.display = 'none';
            document.getElementById('successCheck').style.display = 'block';

            // Show success message
            setTimeout(() => {
                alert('🎉 Registration Successful! Welcome to our life-saving community. You will receive a confirmation email shortly.');
                console.log('Form is valid and ready to submit');
            }, 1000);
        }, 2000);
    } else {
        alert('❌ Please correct the errors in the form before submitting.');
        // Focus on first invalid field
        const firstInvalid = document.querySelector('.is-invalid');
        if (firstInvalid) {
            firstInvalid.focus();
            firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }
}

// Add event listeners when page loads
document.addEventListener('DOMContentLoaded', function () {
    createParticles();

    document.getElementById('donorForm').addEventListener('submit', handleSubmit);

    // Real-time validation on blur
    document.getElementById('fullName').addEventListener('blur', validateFullName);
    document.getElementById('type').addEventListener('change', validateType);
    document.getElementById('bloodGroup').addEventListener('change', validateBloodGroup);
    document.getElementById('state').addEventListener('change', validateState);
    document.getElementById('city').addEventListener('blur', validateCity);
    document.getElementById('mobile').addEventListener('blur', validateMobile);
    document.getElementById('email').addEventListener('blur', validateEmail);
    document.getElementById('password').addEventListener('blur', validatePassword);
    document.getElementById('confirmPassword').addEventListener('blur', validateConfirmPassword);
    document.getElementById('securityQuestion').addEventListener('change', validateSecurityQuestion);
    document.getElementById('securityAnswer').addEventListener('blur', validateSecurityAnswer);
    document.getElementById('agreeTerms').addEventListener('change', validateTermsAgreement);

    // Clear errors when user starts typing
    const inputs = document.querySelectorAll('input, select');
    inputs.forEach(input => {
        input.addEventListener('focus', function () {
            clearError(this.id);
        });
    });

    // Add Enter key navigation
    const formElements = [
        'fullName', 'type', 'bloodGroup', 'state', 'city',
        'mobile', 'email', 'password', 'confirmPassword',
        'securityQuestion', 'securityAnswer', 'lastDonation', 'agreeTerms'
    ];

    formElements.forEach((elementId, index) => {
        const element = document.getElementById(elementId);
        if (element) {
            element.addEventListener('keydown', function (event) {
                if (event.key === 'Enter') {
                    event.preventDefault();

                    // Find next element
                    const nextIndex = index + 1;
                    if (nextIndex < formElements.length) {
                        const nextElement = document.getElementById(formElements[nextIndex]);
                        if (nextElement) {
                            nextElement.focus();
                        }
                    } else {
                        // If last element, submit the form
                        handleSubmit(event);
                    }
                }
            });
        }
    });

    // Add smooth scrolling animation on form load
    document.querySelector('.form-container').style.opacity = '0';
    document.querySelector('.form-container').style.transform = 'translateY(50px)';

    setTimeout(() => {
        document.querySelector('.form-container').style.transition = 'all 0.8s ease-out';
        document.querySelector('.form-container').style.opacity = '1';
        document.querySelector('.form-container').style.transform = 'translateY(0)';
    }, 100);
});

// Add input formatting
document.addEventListener('DOMContentLoaded', function () {
    // Format mobile number input
    const mobileInput = document.getElementById('mobile');
    mobileInput.addEventListener('input', function () {
        this.value = this.value.replace(/\D/g, '');
        if (this.value.length > 10) {
            this.value = this.value.slice(0, 10);
        }
    });

    // Format name inputs to title case
    const nameInputs = ['fullName', 'city', 'securityAnswer'];
    nameInputs.forEach(inputId => {
        const input = document.getElementById(inputId);
        if (input && inputId !== 'securityAnswer') {
            input.addEventListener('blur', function () {
                this.value = this.value.toLowerCase().replace(/\b\w/g, l => l.toUpperCase());
            });
        }
    });
});
