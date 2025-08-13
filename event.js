document.addEventListener('DOMContentLoaded', function () {

    // ===== Filter functionality =====
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();

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

    // Set minimum date for event request
    const dateInput = document.getElementById('eventDate');
    if (dateInput) {
        dateInput.min = new Date().toISOString().split('T')[0];
    }

    // Request Event function
    window.requestEvent = function () {
        const form = document.getElementById('requestEventForm');

        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        const formData = new FormData(form);
        const confirmationList = document.getElementById('confirmationDetails');
        confirmationList.innerHTML = '';

        formData.forEach((value, key) => {
            if (value.trim() !== '') {
                const li = document.createElement('li');
                li.classList.add('list-group-item');
                const label = key.charAt(0).toUpperCase() + key.slice(1);
                li.innerHTML = `<strong>${label}:</strong> ${value}`;
                confirmationList.appendChild(li);
            }
        });

        const requestModal = bootstrap.Modal.getInstance(document.getElementById('requestEventModal'));
        requestModal.hide();

        const confirmationModal = new bootstrap.Modal(document.getElementById('requestConfirmationModal'));
        confirmationModal.show();

        form.reset();
    };

    // ===== Animate event cards on scroll =====
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

    document.querySelectorAll('.event-card').forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = `all 0.6s ease ${index * 0.1}s`;
        observer.observe(card);
    });
    
    // ===== Update ongoing event stats =====
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
    }, 10000);

});

// ===== View Details Modal Functionality =====
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.view-details-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            document.getElementById('modalEventTitle').textContent = this.dataset.title;
            document.getElementById('modalEventDate').textContent = this.dataset.date;
            document.getElementById('modalEventTime').textContent = this.dataset.time;
            document.getElementById('modalEventLocation').textContent = this.dataset.location;
            document.getElementById('modalEventDescription').textContent = this.dataset.description;

            let modal = new bootstrap.Modal(document.getElementById('eventDetailsModal'));
            modal.show();
        });
    });
});
