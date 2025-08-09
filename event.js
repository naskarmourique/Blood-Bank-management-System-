
// Filter functionality
document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', function (e) {
        e.preventDefault();

        // Update active filter
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');

        const filter = this.getAttribute('data-filter');
        const events = document.querySelectorAll('.event-card');

        events.forEach(event => {
            const status = event.querySelector('.event-status');
            if (filter === 'all') {
                event.parentElement.style.display = 'block';
            } else {
                if (status && status.classList.contains(`status-${filter}`)) {
                    event.parentElement.style.display = 'block';
                } else {
                    event.parentElement.style.display = 'none';
                }
            }
        });
    });
});

// Set minimum date for event creation
document.getElementById('eventDate').min = new Date().toISOString().split('T')[0];

// Create event function
function createEvent() {
    const form = document.getElementById('createEventForm');
    const formData = new FormData(form);

    // Basic validation
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }

    // Show success message
    alert('🎉 Blood drive event created successfully!');

    // Close modal and reset form
    const modal = bootstrap.Modal.getInstance(document.getElementById('createEventModal'));
    modal.hide();
    form.reset();

    // In a real app, you would send data to server here
    console.log('Event created with data:', Object.fromEntries(formData));
}

// Add some interactive animations
document.addEventListener('DOMContentLoaded', function () {
    // Animate event cards on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Initially hide cards and observe them
    document.querySelectorAll('.event-card').forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = `all 0.6s ease ${index * 0.1}s`;
        observer.observe(card);
    });
});

// Update ongoing event stats (simulation)
setInterval(() => {
    const ongoingEvents = document.querySelectorAll('.status-ongoing');
    ongoingEvents.forEach(event => {
        const card = event.closest('.event-card');
        const statNumbers = card.querySelectorAll('.stat-number');
        statNumbers.forEach(stat => {
            const currentValue = parseInt(stat.textContent);
            if (Math.random() > 0.7) { // 30% chance to update
                stat.textContent = currentValue + 1;
                stat.style.color = '#10b981';
                setTimeout(() => {
                    stat.style.color = '#ff416c';
                }, 1000);
            }
        });
    });
}, 10000); // Update every 10 seconds
