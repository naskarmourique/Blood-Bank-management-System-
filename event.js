document.addEventListener('DOMContentLoaded', function () {
    // ===== Filter functionality =====
    const eventsContainer = document.getElementById('eventsContainer');
    const filterButtons = document.querySelectorAll('.filter-btn');

    filterButtons.forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();

            filterButtons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            const filter = this.getAttribute('data-filter');
            const eventCols = eventsContainer.querySelectorAll('.col'); // Target the columns containing event cards

            eventCols.forEach(col => {
                const eventCard = col.querySelector('.event-card');
                if (!eventCard) return; // Skip if no event card found in col

                // Extract status from the class of the span.event-status
                const statusSpan = eventCard.querySelector('.event-status');
                if (!statusSpan) return;

                let currentStatus = '';
                if (statusSpan.classList.contains('status-upcoming')) {
                    currentStatus = 'upcoming';
                } else if (statusSpan.classList.contains('status-ongoing')) {
                    currentStatus = 'ongoing';
                } else if (statusSpan.classList.contains('status-completed')) {
                    currentStatus = 'completed';
                }
                // For other statuses like 'pending', 'approved', 'rejected', etc., they won't match these filters

                if (filter === 'all') {
                    col.style.display = 'inline-block';
                } else {
                    if (currentStatus === filter) {
                        col.style.display = 'inline-block';
                    } else {
                        col.style.display = 'none';
                    }
                }
            });
        });
    });

    // Set minimum date for event request and admin event forms
    const setMinDate = (inputElementId) => {
        const dateInput = document.getElementById(inputElementId);
        if (dateInput) {
            dateInput.min = new Date().toISOString().split('T')[0];
        }
    };
    setMinDate('eventDate'); // For request event modal
    setMinDate('adminEventDate'); // For admin event modal

    // The requestEvent function has been removed as it is no longer used.
    // Event requests are now handled by a standard PHP form submission.


    // ===== Admin Functions (Add/Edit/Delete) =====
    // These functions are no longer used and have been replaced by direct PHP form submissions.


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

    document.querySelectorAll('#eventsContainer .col').forEach((card, index) => { // Target the columns
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = `all 0.6s ease ${index * 0.1}s`;
        observer.observe(card);
    });
    
    // ===== View Details Modal Functionality =====
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

    // ===== Fix for body scroll issue after modal closes =====
    const modals = ['requestEventModal', 'requestConfirmationModal', 'adminEventModal', 'eventDetailsModal'];
    modals.forEach(modalId => {
        const modalElement = document.getElementById(modalId);
        if (modalElement) {
            modalElement.addEventListener('hidden.bs.modal', function () {
                // Ensure body overflow is reset when modal closes
                // Bootstrap 5 usually handles this, but explicit reset can fix conflicts
                document.body.style.overflow = ''; 
                document.body.style.paddingRight = ''; // Also reset padding-right if Bootstrap added it

                // Explicitly remove any lingering modal backdrops
                const backdrops = document.querySelectorAll('.modal-backdrop');
                backdrops.forEach(backdrop => backdrop.remove());
            });
        }
    });
});
