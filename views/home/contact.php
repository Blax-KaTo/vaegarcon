<?php
// Contact page view

// Include header
include VIEWS_PATH . '/layouts/header.php';
?>

<section id="contact" class="contact">
    <div class="container">
        <div class="section-header">
            <h2>Get In Touch</h2>
            <p>Ready to transform your fuel operations? Let's discuss your requirements</p>
        </div>
        
        <?php if (isset($success)): ?>
            <div class="alert alert-success">
                <?php echo $success; ?>
            </div>
        <?php endif; ?>
        
        <?php if (isset($error)): ?>
            <div class="alert alert-error">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        
        <div class="contact-grid">
            <div class="contact-info">
                <div class="contact-item">
                    <div class="contact-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="contact-text">
                        <h3>Location</h3>
                        <p>Kitwe, Zambia</p>
                        <p>Headquarters, Johannesburg, South Africa</p>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="contact-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="contact-text">
                        <h3>Phone</h3>
                        <p>+27 72 567 8908</p>
                        <p>+260 570 649 254</p>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="contact-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="contact-text">
                        <h3>Email</h3>
                        <p>info@vaegarcon.com</p>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="contact-icon">
                        <i class="fas fa-globe"></i>
                    </div>
                    <div class="contact-text">
                        <h3>Website</h3>
                        <p>www.vaegarcon.com</p>
                    </div>
                </div>
            </div>
            <div class="contact-form">
                <form id="contactForm" method="post" action="<?php echo BASE_URL; ?>/home/contact">
                    <div class="form-group">
                        <input type="text" id="name" name="name" placeholder="Your Name" required 
                               value="<?php echo isset($formData['name']) ? htmlspecialchars($formData['name']) : ''; ?>">
                        <?php if (isset($errors['name'])): ?>
                            <span class="error"><?php echo $errors['name']; ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <input type="email" id="email" name="email" placeholder="Your Email" required
                               value="<?php echo isset($formData['email']) ? htmlspecialchars($formData['email']) : ''; ?>">
                        <?php if (isset($errors['email'])): ?>
                            <span class="error"><?php echo $errors['email']; ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <input type="text" id="subject" name="subject" placeholder="Subject"
                               value="<?php echo isset($formData['subject']) ? htmlspecialchars($formData['subject']) : ''; ?>">
                    </div>
                    <div class="form-group">
                        <textarea id="message" name="message" placeholder="Your Message" required><?php echo isset($formData['message']) ? htmlspecialchars($formData['message']) : ''; ?></textarea>
                        <?php if (isset($errors['message'])): ?>
                            <span class="error"><?php echo $errors['message']; ?></span>
                        <?php endif; ?>
                    </div>
                    <button type="submit" class="btn-primary" id="submitBtn">
                        <span class="btn-text">Send Message</span>
                        <span class="btn-loading" style="display: none;">
                            <i class="fas fa-spinner fa-spin"></i> Sending...
                        </span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
// Include footer
include VIEWS_PATH . '/layouts/footer.php';
?>

<!-- EmailJS Integration -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>

<script>
// Initialize EmailJS
(function() {
    emailjs.init("9pDOJHmhrUQhpgEv8");
})();

document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('contactForm');
    const submitBtn = document.getElementById('submitBtn');
    const btnText = submitBtn.querySelector('.btn-text');
    const btnLoading = submitBtn.querySelector('.btn-loading');
    
    contactForm.addEventListener('submit', function(e) {
        // Don't prevent default - let the form submit normally to the server
        // This ensures database storage continues to work
        
        // Show loading state
        submitBtn.disabled = true;
        btnText.style.display = 'none';
        btnLoading.style.display = 'inline-flex';
        
        // Get form data
        const formData = new FormData(contactForm);
        const now = new Date();
        const date = now.toLocaleDateString();
        const time = now.toLocaleTimeString();
        
        const templateParams = {
            from_name: formData.get('name'),
            from_email: 'info@vaegarcon.com', // Use authenticated sender address
            reply_to: formData.get('email'), // Set reply-to as the actual sender
            subject: formData.get('subject') || 'Contact Form Submission',
            message: formData.get('message'),
            to_email: 'info@vaegarcon.com',
            date: date,
            time: time,
            customer_name: formData.get('name'),
            customer_email: formData.get('email')
        };
        
        // Send email via EmailJS (this runs in parallel with form submission)
        emailjs.send('service_eackrli', 'template_antaetp', templateParams)
            .then(function(response) {
                console.log('Email sent successfully!', response.status, response.text);
                
                // Show success message
                showMessage('Your message has been sent successfully! We will get back to you soon.', 'success');
                
            }, function(error) {
                console.error('Failed to send email:', error);
                
                // Show warning message but don't prevent form submission
                showMessage('Message saved! Email notification may be delayed.', 'warning');
            })
            .finally(function() {
                // Reset button state after a short delay to allow form submission
                setTimeout(function() {
                    submitBtn.disabled = false;
                    btnText.style.display = 'inline';
                    btnLoading.style.display = 'none';
                }, 1000);
            });
        
        // Let the form submit normally to the server for database storage
        // The server will handle the database insertion and show appropriate messages
    });
    
    function showMessage(message, type) {
        // Remove existing messages
        const existingAlerts = document.querySelectorAll('.alert');
        existingAlerts.forEach(alert => alert.remove());
        
        // Create new message element
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type}`;
        alertDiv.textContent = message;
        
        // Insert before the contact form
        const contactGrid = document.querySelector('.contact-grid');
        contactGrid.insertBefore(alertDiv, contactGrid.firstChild);
        
        // Auto-remove after 5 seconds
        setTimeout(() => {
            alertDiv.remove();
        }, 5000);
    }
});
</script>

<style>
.btn-primary {
    position: relative;
    overflow: hidden;
}

.btn-loading {
    display: none;
    align-items: center;
    gap: 8px;
}

.btn-primary:disabled {
    opacity: 0.7;
    cursor: not-allowed;
}

.alert {
    padding: 12px 16px;
    border-radius: 8px;
    margin-bottom: 20px;
    font-weight: 500;
    animation: slideDown 0.3s ease-out;
}

.alert-success {
    background-color: #d1fae5;
    color: #065f46;
    border: 1px solid #a7f3d0;
}

.alert-error {
    background-color: #fee2e2;
    color: #991b1b;
    border: 1px solid #fca5a5;
}

.alert-warning {
    background-color: #fef3c7;
    color: #92400e;
    border: 1px solid #fbbf24;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>