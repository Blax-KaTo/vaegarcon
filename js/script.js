document.addEventListener('DOMContentLoaded', function() {
    // Hero Section Animation
    const heroContent = document.querySelector('.hero-content');
    if (heroContent) {
        heroContent.style.opacity = '0';
        heroContent.style.transform = 'translateY(30px)';
        
        setTimeout(() => {
            heroContent.style.transition = 'opacity 1s ease, transform 1s ease';
            heroContent.style.opacity = '1';
            heroContent.style.transform = 'translateY(0)';
        }, 300);
    }
    
    // Mobile Menu Toggle
    const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
    const nav = document.querySelector('nav');

    if (mobileMenuBtn) {
        mobileMenuBtn.addEventListener('click', function() {
            nav.style.display = nav.style.display === 'block' ? 'none' : 'block';
            
            // Toggle the hamburger menu animation
            this.classList.toggle('active');
            
            // Prevent scrolling when menu is open
            document.body.classList.toggle('menu-open');
        });
    }

    // Close mobile menu when clicking outside
    document.addEventListener('click', function(event) {
        const isClickInsideNav = nav.contains(event.target);
        const isClickOnMenuBtn = mobileMenuBtn.contains(event.target);
        
        if (!isClickInsideNav && !isClickOnMenuBtn && window.innerWidth <= 768 && nav.style.display === 'block') {
            nav.style.display = 'none';
            mobileMenuBtn.classList.remove('active');
            document.body.classList.remove('menu-open');
        }
    });

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();

            // Close mobile menu if open
            if (window.innerWidth <= 768 && nav.style.display === 'block') {
                nav.style.display = 'none';
                mobileMenuBtn.classList.remove('active');
                document.body.classList.remove('menu-open');
            }

            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);

            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 80, // Adjust for header height
                    behavior: 'smooth'
                });
            }
        });
    });

    // Form submission handling
    const contactForm = document.getElementById('contactForm');
    
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form data
            const formData = {
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                subject: document.getElementById('subject').value,
                message: document.getElementById('message').value
            };
            
            // Here you would typically send the data to a server
            // For now, we'll just show a success message
            alert('Thank you for your message! We will get back to you soon.');
            
            // Reset the form
            contactForm.reset();
        });
    }

    // Add active class to nav links based on scroll position
    const sections = document.querySelectorAll('section[id]');
    
    function highlightNavLink() {
        const scrollPosition = window.scrollY + 100; // Adjust for header height
        
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.offsetHeight;
            const sectionId = section.getAttribute('id');
            const navLink = document.querySelector(`nav a[href="#${sectionId}"]`);
            
            if (navLink && scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                document.querySelectorAll('nav a').forEach(link => {
                    link.classList.remove('active');
                });
                navLink.classList.add('active');
            }
        });
    }
    
    window.addEventListener('scroll', highlightNavLink);
    
    // Initialize the active nav link on page load
    highlightNavLink();

    // Add animation to cards on scroll
    const animateOnScroll = function() {
        const cards = document.querySelectorAll('.service-card, .industry-card, .about-card, .result-card');
        
        cards.forEach(card => {
            const cardPosition = card.getBoundingClientRect().top;
            const screenPosition = window.innerHeight / 1.3;
            
            if (cardPosition < screenPosition) {
                card.classList.add('animate');
            }
        });
    };
    
    window.addEventListener('scroll', animateOnScroll);
    
    // Initialize animations on page load
    animateOnScroll();
});