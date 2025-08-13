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

// Helper: Show error
function showError(fieldId, message) {
    const field = document.getElementById(fieldId);
    field.classList.add('is-invalid');
    const feedback = field.parentNode.querySelector('.invalid-feedback');
    if (feedback) feedback.textContent = message;
}

// Helper: Clear error
function clearError(fieldId) {
    const field = document.getElementById(fieldId);
    field.classList.remove('is-invalid');
}

// Clear all errors
function clearAllErrors() {
    document.querySelectorAll('.is-invalid').forEach(field => field.classList.remove('is-invalid'));
}

// Validations
function validatePatientName() {
    const name = document.getElementById('patientName').value.trim();
    if (name === '') {
        showError('patientName', 'Patient name is required');
        return false;
    }
    if (name.length < 3) {
        showError('patientName', 'Name must be at least 3 characters');
        return false;
    }
    if (!/^[a-zA-Z\s]+$/.test(name)) {
        showError('patientName', 'Name should contain only letters and spaces');
        return false;
    }
    clearError('patientName');
    return true;
}

function validateBloodGroup() {
    const group = document.getElementById('bloodGroup').value;
    if (group === '') {
        showError('bloodGroup', 'Please select blood group');
        return false;
    }
    clearError('bloodGroup');
    return true;
}

function validateUnits() {
    const units = parseInt(document.getElementById('units').value, 10);
    if (isNaN(units) || units < 1 || units > 10) {
        showError('units', 'Enter valid units (1–10)');
        return false;
    }
    clearError('units');
    return true;
}

function validateHospital() {
    const hospital = document.getElementById('hospital').value.trim();
    if (hospital === '') {
        showError('hospital', 'Hospital name is required');
        return false;
    }
    clearError('hospital');
    return true;
}

function validateLocation() {
    const location = document.getElementById('location').value.trim();
    if (location === '') {
        showError('location', 'Location is required');
        return false;
    }
    clearError('location');
    return true;
}

function validateMobile() {
    const mobile = document.getElementById('mobile').value.trim();
    if (mobile === '') {
        showError('mobile', 'Contact number is required');
        return false;
    }
    if (!/^\d+$/.test(mobile)) {
        showError('mobile', 'Number should contain only digits');
        return false;
    }
    if (mobile.length !== 10) {
        showError('mobile', 'Number must be exactly 10 digits');
        return false;
    }
    if (mobile.charAt(0) < '6' || mobile.charAt(0) > '9') {
        showError('mobile', 'Number should start with 6, 7, 8, or 9');
        return false;
    }
    clearError('mobile');
    return true;
}

function validateDate() {
    const date = document.getElementById('neededDate').value;
    if (date === '') {
        showError('neededDate', 'Please select a date');
        return false;
    }
    const today = new Date().toISOString().split('T')[0];
    if (date < today) {
        showError('neededDate', 'Date cannot be in the past');
        return false;
    }
    clearError('neededDate');
    return true;
}

function validateTerms() {
    const agree = document.getElementById('agreeTerms').checked;
    if (!agree) {
        showError('agreeTerms', 'You must agree before submitting');
        return false;
    }
    clearError('agreeTerms');
    return true;
}

// Main form validation
function validateForm() {
    clearAllErrors();
    let isValid = true;

    if (!validatePatientName()) isValid = false;
    if (!validateBloodGroup()) isValid = false;
    if (!validateUnits()) isValid = false;
    if (!validateHospital()) isValid = false;
    if (!validateLocation()) isValid = false;
    if (!validateMobile()) isValid = false;
    if (!validateDate()) isValid = false;
    if (!validateTerms()) isValid = false;

    return isValid;
}

// Handle form submit
function handleSubmit(event) {
    event.preventDefault();
    if (validateForm()) {
        document.getElementById('requestForm').style.display = 'none';
        document.getElementById('loading').style.display = 'block';
        setTimeout(() => {
            document.getElementById('loading').style.display = 'none';
            document.getElementById('successCheck').style.display = 'block';
            setTimeout(() => {
                alert('✅ Blood request submitted successfully. We will contact you soon.');
            }, 1000);
        }, 2000);
    } else {
        alert('❌ Please fix the errors before submitting.');
        const firstInvalid = document.querySelector('.is-invalid');
        if (firstInvalid) {
            firstInvalid.focus();
            firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }
}

// Event listeners
document.addEventListener('DOMContentLoaded', function () {
    createParticles();
    document.getElementById('requestForm').addEventListener('submit', handleSubmit);

    document.getElementById('patientName').addEventListener('blur', validatePatientName);
    document.getElementById('bloodGroup').addEventListener('change', validateBloodGroup);
    document.getElementById('units').addEventListener('blur', validateUnits);
    document.getElementById('hospital').addEventListener('blur', validateHospital);
    document.getElementById('location').addEventListener('blur', validateLocation);
    document.getElementById('mobile').addEventListener('blur', validateMobile);
    document.getElementById('neededDate').addEventListener('change', validateDate);
    document.getElementById('agreeTerms').addEventListener('change', validateTerms);

    // Mobile input format
    document.getElementById('mobile').addEventListener('input', function () {
        this.value = this.value.replace(/\D/g, '').slice(0, 10);
    });

    // Smooth form load animation
    document.querySelector('.form-container').style.opacity = '0';
    document.querySelector('.form-container').style.transform = 'translateY(50px)';
    setTimeout(() => {
        document.querySelector('.form-container').style.transition = 'all 0.8s ease-out';
        document.querySelector('.form-container').style.opacity = '1';
        document.querySelector('.form-container').style.transform = 'translateY(0)';
    }, 100);
});
