// e-BloodBank JavaScript
document.addEventListener('DOMContentLoaded', function() {
    
    // Sidebar navigation
    const navItems = document.querySelectorAll('.nav-item');
    navItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            navItems.forEach(nav => nav.classList.remove('active'));
            this.classList.add('active');
        });
    });
    
    // Emergency button animation
    const emergencyBtn = document.querySelector('.emergency-btn');
    if (emergencyBtn) {
        emergencyBtn.addEventListener('click', function() {
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = '';
            }, 100);
            
            // You can add emergency request functionality here
            console.log('Emergency request initiated');
        });
    }
    
    // Stats counter animation
    const statValues = document.querySelectorAll('.stat-value');
    const animateCounter = (element, finalValue) => {
        let currentValue = 0;
        const increment = finalValue / 50;
        
        const timer = setInterval(() => {
            currentValue += increment;
            if (currentValue >= finalValue) {
                element.textContent = finalValue;
                clearInterval(timer);
            } else {
                element.textContent = Math.floor(currentValue);
            }
        }, 30);
    };
    
    // Animate stat counters when they come into view
    const observerOptions = {
        threshold: 0.5,
        once: true
    };
    
    const statsObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const statValue = entry.target;
                const finalValue = parseInt(statValue.textContent);
                animateCounter(statValue, finalValue);
            }
        });
    }, observerOptions);
    
    statValues.forEach(stat => {
        statsObserver.observe(stat);
    });
    
    // Real-time clock update
    function updateTime() {
        const now = new Date();
        const timeString = now.toLocaleTimeString('en-IN', { 
            timeZone: 'Asia/Kolkata',
            hour12: true 
        });
        
        // Add time to header if there's a time element
        const timeElement = document.getElementById('current-time');
        if (timeElement) {
            timeElement.textContent = timeString;
        }
        
        console.log('Current IST:', timeString);
    }
    
    // Update time every second
    setInterval(updateTime, 1000);
    updateTime(); // Initial call
    
    // Quick action buttons hover effects
    const quickActionBtns = document.querySelectorAll('.quick-action-btn');
    quickActionBtns.forEach(btn => {
        btn.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px) scale(1.02)';
        });
        
        btn.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
        
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const actionType = this.classList[1]; // Get the second class (donor-reg, blood-collection, etc.)
            console.log(`${actionType} action clicked`);
            
            // Add ripple effect
            const ripple = document.createElement('div');
            ripple.style.position = 'absolute';
            ripple.style.borderRadius = '50%';
            ripple.style.background = 'rgba(255, 255, 255, 0.6)';
            ripple.style.transform = 'scale(0)';
            ripple.style.animation = 'ripple 0.6s linear';
            ripple.style.left = e.offsetX - 10 + 'px';
            ripple.style.top = e.offsetY - 10 + 'px';
            ripple.style.width = ripple.style.height = '20px';
            
            this.style.position = 'relative';
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });
    
    // Add ripple animation to CSS
    const style = document.createElement('style');
    style.textContent = `
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);
    
    // Blood inventory status updates (simulate real-time updates)
    const bloodInventoryUpdate = () => {
        const bloodGroups = ['a-pos', 'b-pos', 'ab-pos', 'o-pos', 'o-neg'];
        const statCards = document.querySelectorAll('.stat-card');
        
        statCards.forEach((card, index) => {
            if (bloodGroups[index]) {
                const statValue = card.querySelector('.stat-value');
                const currentValue = parseInt(statValue.textContent);
                
                // Simulate small random changes in inventory
                const change = Math.floor(Math.random() * 10) - 5; // -5 to +4
                const newValue = Math.max(0, currentValue + change);
                
                if (change !== 0) {
                    statValue.textContent = newValue;
                    
                    // Add visual feedback for changes
                    card.style.transform = 'scale(1.02)';
                    setTimeout(() => {
                        card.style.transform = 'scale(1)';
                    }, 200);
                }
            }
        });
    };
    
    // Update inventory every 30 seconds (for demo purposes)
    setInterval(bloodInventoryUpdate, 30000);
    
    // Notification simulation
    const showNotification = (message, type = 'info') => {
        const notification = document.createElement('div');
        notification.style.position = 'fixed';
        notification.style.top = '20px';
        notification.style.right = '20px';
        notification.style.background = type === 'emergency' ? '#ff416c' : '#667eea';
        notification.style.color = 'white';
        notification.style.padding = '1rem 1.5rem';
        notification.style.borderRadius = '12px';
        notification.style.boxShadow = '0 8px 32px rgba(0,0,0,0.3)';
        notification.style.zIndex = '9999';
        notification.style.transform = 'translateX(100%)';
        notification.style.transition = 'transform 0.3s ease';
        notification.textContent = message;
        
        document.body.appendChild(notification);
        
        // Animate in
        setTimeout(() => {
            notification.style.transform = 'translateX(0)';
        }, 100);
        
        // Auto remove after 5 seconds
        setTimeout(() => {
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => {
                notification.remove();
            }, 300);
        }, 5000);
    };
    
    // Simulate notifications
    setTimeout(() => {
        showNotification('New blood donation recorded - O+ type', 'info');
    }, 5000);
    
    setTimeout(() => {
        showNotification('🚨 URGENT: AB- blood needed at AIIMS Delhi', 'emergency');
    }, 15000);
    
    // Table row click handlers
    const tableRows = document.querySelectorAll('.table tbody tr');
    tableRows.forEach(row => {
        row.addEventListener('click', function() {
            // Remove active class from other rows
            tableRows.forEach(r => r.classList.remove('active-row'));
            
            // Add active class to clicked row
            this.classList.add('active-row');
            
            // Get blood group info
            const bloodGroup = this.querySelector('.blood-group').textContent;
            console.log(`Selected blood group: ${bloodGroup}`);
        });
    });
    
    // Add active row styling
    const activeRowStyle = document.createElement('style');
    activeRowStyle.textContent = `
        .active-row {
            background: rgba(102, 126, 234, 0.1) !important;
            transform: scale(1.01);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
        }
    `;
    document.head.appendChild(activeRowStyle);
    
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });
    
    // User profile dropdown (if implemented)
    const userProfile = document.querySelector('.user-profile');
    if (userProfile) {
        userProfile.addEventListener('click', function() {
            console.log('User profile clicked - implement dropdown menu here');
            // You can add dropdown menu functionality here
        });
    }
    
    // Search functionality placeholder
    const addSearchFunctionality = () => {
        const searchInput = document.getElementById('search-input');
        if (searchInput) {
            searchInput.addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase();
                console.log('Searching for:', searchTerm);
                // Implement search logic here
            });
        }
    };
    
    addSearchFunctionality();
    
    // Initialize any additional features
    console.// Bootstrap-compatible JavaScript
        document.addEventListener('DOMContentLoaded', function() {
            
            // Sidebar navigation
            const navItems = document.querySelectorAll('.nav-item-custom');
            navItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    navItems.forEach(nav => nav.classList.remove('active'));
                    this.classList.add('active');
                });
            });
            
            // Emergency button animation
            const emergencyBtn = document.querySelector('.emergency-btn');
            if (emergencyBtn) {
                emergencyBtn.addEventListener('click', function() {
                    this.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        this.style.transform = '';
                    }, 100);
                    
                    // Show Bootstrap toast notification
                    showToast('Emergency request initiated', 'danger');
                });
            }
            
            // Stats counter animation using Intersection Observer
            const statValues = document.querySelectorAll('.stat-value');
            const animateCounter = (element, finalValue) => {
                let currentValue = 0;
                const increment = finalValue / 50;
                
                const timer = setInterval(() => {
                    currentValue += increment;
                    if (currentValue >= finalValue) {
                        element.textContent = finalValue;
                        clearInterval(timer);
                    } else {
                        element.textContent = Math.floor(currentValue);
                    }
                }, 30);
            };
            
            const statsObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const statValue = entry.target;
                        const finalValue = parseInt(statValue.textContent);
                        animateCounter(statValue, finalValue);
                    }
                });
            }, { threshold: 0.5 });
            
            statValues.forEach(stat => {
                statsObserver.observe(stat);
            });
            
            // Hero stats counter animation
            const heroStats = document.querySelectorAll('.hero-stat-number');
            const heroStatsObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const statElement = entry.target;
                        const text = statElement.textContent;
                        const number = parseInt(text.replace(/\D/g, ''));
                        const suffix = text.replace(/\d/g, '');
                        
                        if (number) {
                            animateCounter(statElement, number);
                            // Add suffix back after animation
                            setTimeout(() => {
                                statElement.textContent = number + suffix;
                            }, 1500);
                        }
                    }
                });
            }, { threshold: 0.5 });
            
            heroStats.forEach(stat => {
                heroStatsObserver.observe(stat);
            });
            
            // Quick action buttons hover effects with Bootstrap utilities
            const quickActionBtns = document.querySelectorAll('.quick-action-btn');
            quickActionBtns.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const actionType = this.classList[1];
                    showToast(`${actionType} action clicked`, 'info');
                    
                    // Add ripple effect
                    const ripple = document.createElement('div');
                    ripple.className = 'position-absolute rounded-circle';
                    ripple.style.background = 'rgba(255, 255, 255, 0.6)';
                    ripple.style.transform = 'scale(0)';
                    ripple.style.animation = 'ripple 0.6s linear';
                    ripple.style.left = e.offsetX - 10 + 'px';
                    ripple.style.top = e.offsetY - 10 + 'px';
                    ripple.style.width = ripple.style.height = '20px';
                    
                    this.style.position = 'relative';
                    this.appendChild(ripple);
                    
                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });
            
            // Add ripple animation
            const style = document.createElement('style');
            style.textContent = `
                @keyframes ripple {
                    to {
                        transform: scale(4);
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(style);
            
            // Bootstrap toast notification function
            function showToast(message, type = 'info') {
                // Create toast container if it doesn't exist
                let toastContainer = document.querySelector('.toast-container');
                if (!toastContainer) {
                    toastContainer = document.createElement('div');
                    toastContainer.className = 'toast-container position-fixed top-0 end-0 p-3';
                    toastContainer.style.zIndex = '9999';
                    document.body.appendChild(toastContainer);
                }
                
                const toastEl = document.createElement('div');
                const bgClass = type === 'danger' ? 'bg-danger' : type === 'success' ? 'bg-success' : 'bg-info';
                
                toastEl.className = `toast ${bgClass} text-white`;
                toastEl.setAttribute('role', 'alert');
                toastEl.innerHTML = `
                    <div class="toast-body">
                        ${message}
                    </div>
                `;
                
                toastContainer.appendChild(toastEl);
                
                const toast = new bootstrap.Toast(toastEl, {
                    autohide: true,
                    delay: 5000
                });
                
                toast.show();
                
                // Remove toast element after it's hidden
                toastEl.addEventListener('hidden.bs.toast', function() {
                    toastEl.remove();
                });
            }
            
            // Table row selection with Bootstrap classes
            const tableRows = document.querySelectorAll('.table tbody tr');
            tableRows.forEach(row => {
                row.addEventListener('click', function() {
                    // Remove active class from other rows
                    tableRows.forEach(r => r.classList.remove('table-active', 'shadow-sm'));
                    
                    // Add active class to clicked row
                    this.classList.add('table-active', 'shadow-sm');
                    
                    // Get blood group info
                    const bloodGroup = this.querySelector('.blood-group').textContent;
                    console.log(`Selected blood group: ${bloodGroup}`);
                });
            });
            
            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                });
            });
            
            // Simulate real-time updates
            setTimeout(() => {
                showToast('New blood donation recorded - O+ type', 'success');
            }, 5000);
            
            setTimeout(() => {
                showToast('🚨 URGENT: AB- blood needed at AIIMS Delhi', 'danger');
            }, 15000);
            
            console.log('e-BloodBank Bootstrap system initialized successfully');
        });log('e-BloodBank system initialized successfully');
});

// Add smooth scrolling animation on form load
    document.querySelector('.form-container').style.opacity = '0';
    document.querySelector('.form-container').style.transform = 'translateY(50px)';

    setTimeout(() => {
        document.querySelector('.form-container').style.transition = 'all 0.8s ease-out';
        document.querySelector('.form-container').style.opacity = '1';
        document.querySelector('.form-container').style.transform = 'translateY(0)';
    }, 100);
