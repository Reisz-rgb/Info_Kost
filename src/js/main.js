function redirectToLogin() {
    window.location.href = "login.html";
}
function redirectToRole() {
    window.location.href = "login_sebagai.html";
}
function redirectToRegist() {
    window.location.href = "regist.html";
} 

// Slideshow functionality
let currentSlide = 0;
const slides = ['slide-img', 'slide-img2', 'slide-img3'];
const overlayTexts = ['overlay-text-1', 'overlay-text-2', 'overlay-text-3'];
const totalSlides = slides.length;

// Initialize first slide visibility
document.addEventListener('DOMContentLoaded', function() {
    // Set all slides to hidden initially
    slides.forEach((slideId, index) => {
        const slide = document.getElementById(slideId);
        if (slide) {
            slide.style.opacity = index === 0 ? '1' : '0';
            slide.style.transition = 'opacity 0.5s ease-in-out';
        }
    });
    
    // Set all overlay texts to hidden initially
    overlayTexts.forEach((textId, index) => {
        const text = document.getElementById(textId);
        if (text) {
            text.style.opacity = index === 0 ? '1' : '0';
            text.style.transition = 'opacity 0.5s ease-in-out';
        }
    });
});

function showSlide(n) {
    // Hide all slides
    slides.forEach(slideId => {
        const slide = document.getElementById(slideId);
        if (slide) {
            slide.style.opacity = '0';
        }
    });
    
    // Hide all overlay texts
    overlayTexts.forEach(textId => {
        const text = document.getElementById(textId);
        if (text) {
            text.style.opacity = '0';
        }
    });
    
    // Show current slide
    const currentSlideElement = document.getElementById(slides[n]);
    if (currentSlideElement) {
        currentSlideElement.style.opacity = '1';
    }
    
    // Show current overlay text
    const currentOverlayText = document.getElementById(overlayTexts[n]);
    if (currentOverlayText) {
        currentOverlayText.style.opacity = '1';
    }
}

function nextSlide() {
    currentSlide = (currentSlide + 1) % totalSlides;
    showSlide(currentSlide);
}

function prevSlide() {
    currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
    showSlide(currentSlide);
}

// Auto-slide functionality
function startAutoSlide() {
    return setInterval(nextSlide, 7000); // Change slide every 7 seconds
}

// Initialize slideshow when page loads
document.addEventListener('DOMContentLoaded', function() {
    showSlide(currentSlide);
    
    // Start automatic sliding
    let autoSlideInterval = startAutoSlide();
    
    // Add event listeners for navigation buttons
    const nextBtn = document.getElementById('nextBtn');
    const prevBtn = document.getElementById('prevBtn');
    
    if (nextBtn) {
        nextBtn.addEventListener('click', function() {
            clearInterval(autoSlideInterval);
            nextSlide();
            autoSlideInterval = startAutoSlide(); // Restart auto-slide
        });
    }
    
    if (prevBtn) {
        prevBtn.addEventListener('click', function() {
            clearInterval(autoSlideInterval);
            prevSlide();
            autoSlideInterval = startAutoSlide(); // Restart auto-slide
        });
    }
});

function startCountdown() {
    // Check if countdown is already stored in localStorage
    let endTime = localStorage.getItem('countdownEndTime');
    
    if (!endTime) {
        // Set countdown duration (7 days from now) only if not already set
        const countdownDuration = 7 * 24 * 60 * 60 * 1000; // 7 days in milliseconds
        endTime = new Date().getTime() + countdownDuration;
        localStorage.setItem('countdownEndTime', endTime);
    } else {
        endTime = parseInt(endTime);
    }

    function updateCountdown() {
        const now = new Date().getTime();
        const timeLeft = endTime - now;

        if (timeLeft <= 0) {
            // Countdown finished
            document.getElementById('hours').textContent = '00';
            document.getElementById('minutes').textContent = '00';
            document.getElementById('seconds').textContent = '00';
            localStorage.removeItem('countdownEndTime'); // Clean up
            return;
        }

        // Calculate hours, minutes, seconds
        const hours = Math.floor(timeLeft / (1000 * 60 * 60));
        const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

        // Update display with leading zeros
        document.getElementById('hours').textContent = hours.toString().padStart(2, '0');
        document.getElementById('minutes').textContent = minutes.toString().padStart(2, '0');
        document.getElementById('seconds').textContent = seconds.toString().padStart(2, '0');
    }

    // Update immediately and then every second
    updateCountdown();
    setInterval(updateCountdown, 1000);
}

// Start countdown when page loads
document.addEventListener('DOMContentLoaded', startCountdown);

let navOpen = false;
    function toggleNav() {
        navOpen = !navOpen;
        const navMenu = document.getElementById('nav-menu');
        const menuIcon = document.getElementById('menu-icon');

        if (navOpen) {
            navMenu.classList.remove('hidden');
            menuIcon.innerHTML = '✖'; // Change to close icon
        } else {
            navMenu.classList.add('hidden');
            menuIcon.innerHTML = '☰'; // Change to menu icon
        }
    }
 


