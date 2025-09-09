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
                        <p>Johannesburg, South Africa</p>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="contact-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="contact-text">
                        <h3>Phone</h3>
                        <p>+27 (0) 11 000 0000</p>
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
                    <button type="submit" class="btn-primary">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
// Include footer
include VIEWS_PATH . '/layouts/footer.php';
?>