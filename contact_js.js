// Simple JavaScript for functionality
document.addEventListener('DOMContentLoaded', function () {

    // Form submission
    document.getElementById('contactForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const firstName = document.getElementById('firstName').value;
        const lastName = document.getElementById('lastName').value;
        const email = document.getElementById('email').value;
        const subject = document.getElementById('subject').value;
        const message = document.getElementById('message').value;

        if (!firstName || !lastName || !email || !subject || !message) {
            showToast('Please fill in all required fields', 'warning');
            return;
        }

        // Show loading
        const submitBtn = document.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Sending...';
        submitBtn.disabled = true;

        // Simulate API call
        setTimeout(() => {
            showToast('✅ Message sent successfully! We\'ll get back to you within 24 hours.', 'success');
            document.getElementById('contactForm').reset();
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }, 2000);
    });

    // Auto-populate message templates
    document.getElementById('subject').addEventListener('change', function () {
        const messageField = document.getElementById('message');
        const templates = {
            'emergency': 'URGENT: I need immediate blood assistance.\n\nBlood Type Required: \nQuantity: \nHospital: \nPatient Name: \nContact: \n\nPlease respond immediately.',
            'donation': 'I would like to donate blood.\n\nBlood Type: \nAge: \nLocation: \nPreferred Date: \nContact: \n\nPlease provide guidance.',
            'registration': 'I want to register as a blood donor.\n\nFull Name: \nAge: \nBlood Type: \nLocation: \nContact: \n\nPlease help me register.',
            'technical': 'I need technical support.\n\nIssue: \nBrowser/Device: \nError Message: \n\nPlease assist.',
            'partnership': 'Partnership inquiry from [Organization].\n\nOrganization: \nType: \nServices: \nProposed collaboration: \n\nLet\'s discuss.',
            'feedback': 'Feedback about BloodConnect services.\n\nService used: \nExperience: \nSuggestions: \n\nThank you.'
        };

        if (templates[this.value] && !messageField.value.trim()) {
            messageField.value = templates[this.value];
        }
    });


    // Email validation
    document.getElementById('email').addEventListener('blur', function () {
        const email = this.value;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (email && !emailRegex.test(email)) {
            this.classList.add('is-invalid');
            this.classList.remove('is-valid');
        } else if (email) {
            this.classList.add('is-valid');
            this.classList.remove('is-invalid');
        }
    });

    // Contact card click handlers
    document.querySelectorAll('.contact-card').forEach(card => {
        card.addEventListener('click', function () {
            const link = this.querySelector('a[href^="tel:"]');
            if (link) {
                link.click();
            }
        });
    });

    // Animate elements on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationPlayState = 'running';
            }
        });
    }, observerOptions);

    // Observe all fade-in elements
    document.querySelectorAll('.fade-in').forEach(el => {
        el.style.animationPlayState = 'paused';
        observer.observe(el);
    });

    // Real-time form validation
    const requiredFields = document.querySelectorAll('[required]');
    requiredFields.forEach(field => {
        field.addEventListener('blur', function () {
            if (this.value.trim()) {
                this.classList.add('is-valid');
                this.classList.remove('is-invalid');
            } else {
                this.classList.add('is-invalid');
                this.classList.remove('is-valid');
            }
        });
    });
});

// Toast notification function
function showToast(message, type = 'info') {
    const toastContainer = document.querySelector('.toast-container');
    const bgClass = {
        'success': 'bg-success',
        'danger': 'bg-danger',
        'warning': 'bg-warning',
        'info': 'bg-info'
    }[type] || 'bg-info';

    const toast = document.createElement('div');
    toast.className = `toast ${bgClass} text-white`;
    toast.innerHTML = `
                <div class="toast-body">
                    ${message}
                    <button type="button" class="btn-close btn-close-white ms-2 float-end" data-bs-dismiss="toast"></button>
                </div>
            `;

    toastContainer.appendChild(toast);
    const bsToast = new bootstrap.Toast(toast);
    bsToast.show();

    toast.addEventListener('hidden.bs.toast', () => toast.remove());
}

// WhatsApp function
function openWhatsApp() {
    const phone = '+911123456789';
    const message = 'Hello! I need assistance with BloodConnect services.';
    const url = `https://wa.me/${phone}?text=${encodeURIComponent(message)}`;
    window.open(url, '_blank');
}

// Map function
function openMap() {
    const address = 'SITM Campus,Tollygunge, Kolkata, West Bengal 700041';
    const url = `https://www.google.com/maps/place/SITM:+Best+BBA+%26+BCA+college+in+Kolkata/@22.4879795,88.3348488,17z/data=!3m1!4b1!4m6!3m5!1s0x3a02709696a03e2d:0x9f9dd2c9b4f9cdff!8m2!3d22.4879746!4d88.3374237!16s%2Fg%2F1q62bclgc?entry=ttu&g_ep=EgoyMDI1MDgxNy4wIKXMDSoASAFQAw%3D%3D${encodeURIComponent(address)}`;
    window.open(url, '_blank');
}

// Emergency call tracking
document.querySelectorAll('a[href="tel:108"]').forEach(link => {
    link.addEventListener('click', function () {
        showToast('🚨 Connecting to Emergency Hotline 108...', 'danger');
    });
});


// Add smooth scrolling animation on form load
    document.querySelector('.form-container').style.opacity = '0';
    document.querySelector('.form-container').style.transform = 'translateY(50px)';

    setTimeout(() => {
        document.querySelector('.form-container').style.transition = 'all 0.8s ease-out';
        document.querySelector('.form-container').style.opacity = '1';
        document.querySelector('.form-container').style.transform = 'translateY(0)';
    }, 100);