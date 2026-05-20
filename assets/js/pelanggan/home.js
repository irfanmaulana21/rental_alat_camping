// AOS init
AOS.init({
    duration: 900,
    once: true,
    offset: 60,
    easing: 'ease-out-cubic'
});

// Navbar scroll effect
const navbar = document.getElementById('navbar');
window.addEventListener('scroll', () => {
    if (window.scrollY > 40) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
});

// Hamburger menu
const hamburger = document.getElementById('hamburger');
const mobileMenu = document.getElementById('mobileMenu');

hamburger.addEventListener('click', () => {
    mobileMenu.classList.toggle('open');
});

// Close mobile menu on outside click
document.addEventListener('click', (e) => {
    if (!hamburger.contains(e.target) && !mobileMenu.contains(e.target)) {
        mobileMenu.classList.remove('open');
    }
});