// Create floating particles
function createParticles() {
    const particlesContainer = document.querySelector('.particles');
    if (particlesContainer) { // Check if the container exists
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
}

document.addEventListener('DOMContentLoaded', function () {
    createParticles();
});
