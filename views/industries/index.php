<?php
// Industries overview page view

// Include header
include VIEWS_PATH . '/layouts/header.php';
?>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1>Industries We Serve</h1>
        <p>Tailored solutions for diverse sectors across Africa</p>
    </div>
</section>

<!-- Industries Overview -->
<section class="industries-overview">
    <div class="container">
        <div class="section-intro">
            <h2>Specialized Solutions for Every Sector</h2>
            <p>At Vaegarcon, we understand that different industries have unique challenges and requirements. Our solutions are tailored to address the specific needs of various sectors, ensuring optimal performance and efficiency.</p>
        </div>
        
        <div class="industries-grid">
            <!-- Transportation & Logistics -->
            <div class="industry-card large">
                <div class="industry-image">
                    <img src="<?php echo BASE_URL; ?>/images/industries/transportation.jpg" alt="Transportation & Logistics">
                </div>
                <div class="industry-content">
                    <div class="industry-icon">
                        <i class="fas fa-truck"></i>
                    </div>
                    <h3>Transportation & Logistics</h3>
                    <p>Our solutions help transportation companies optimize fuel consumption, prevent theft, and maintain accurate records for compliance and cost management.</p>
                    <ul class="industry-benefits">
                        <li>Fleet fuel consumption monitoring</li>
                        <li>Route optimization based on fuel efficiency</li>
                        <li>Driver behavior analysis</li>
                        <li>Automated compliance reporting</li>
                        <li>Theft prevention and detection</li>
                    </ul>
                    <a href="<?php echo BASE_URL; ?>/industries/transportation" class="btn-secondary">Learn More</a>
                </div>
            </div>
            
            <!-- Manufacturing -->
            <div class="industry-card large">
                <div class="industry-image">
                    <img src="<?php echo BASE_URL; ?>/images/industries/manufacturing.jpg" alt="Manufacturing">
                </div>
                <div class="industry-content">
                    <div class="industry-icon">
                        <i class="fas fa-industry"></i>
                    </div>
                    <h3>Manufacturing</h3>
                    <p>Our systems help manufacturing facilities monitor and optimize energy consumption, ensure reliable backup power, and maintain production continuity.</p>
                    <ul class="industry-benefits">
                        <li>Generator fuel monitoring</li>
                        <li>Production energy efficiency tracking</li>
                        <li>Predictive maintenance alerts</li>
                        <li>Automated inventory management</li>
                        <li>Regulatory compliance support</li>
                    </ul>
                    <a href="<?php echo BASE_URL; ?>/industries/manufacturing" class="btn-secondary">Learn More</a>
                </div>
            </div>
            
            <!-- Commercial Properties -->
            <div class="industry-card large">
                <div class="industry-image">
                    <img src="<?php echo BASE_URL; ?>/images/industries/commercial.jpg" alt="Commercial Properties">
                </div>
                <div class="industry-content">
                    <div class="industry-icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <h3>Commercial Properties</h3>
                    <p>Our solutions ensure reliable backup power for commercial buildings, with monitoring systems that provide peace of mind and business continuity.</p>
                    <ul class="industry-benefits">
                        <li>Backup generator monitoring</li>
                        <li>Power consumption analysis</li>
                        <li>Automated testing and reporting</li>
                        <li>Emergency response integration</li>
                        <li>Tenant billing and allocation</li>
                    </ul>
                    <a href="<?php echo BASE_URL; ?>/industries/commercial" class="btn-secondary">Learn More</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Additional Industries -->
<section class="additional-industries">
    <div class="container">
        <h2>Additional Sectors We Serve</h2>
        <div class="industries-mini-grid">
            <div class="industry-mini-card">
                <div class="industry-icon">
                    <i class="fas fa-hospital"></i>
                </div>
                <h3>Healthcare</h3>
                <p>Ensuring reliable power and fuel management for critical healthcare facilities.</p>
            </div>
            <div class="industry-mini-card">
                <div class="industry-icon">
                    <i class="fas fa-tractor"></i>
                </div>
                <h3>Agriculture</h3>
                <p>Optimizing fuel usage for farming operations and irrigation systems.</p>
            </div>
            <div class="industry-mini-card">
                <div class="industry-icon">
                    <i class="fas fa-broadcast-tower"></i>
                </div>
                <h3>Telecommunications</h3>
                <p>Monitoring backup power systems for network infrastructure reliability.</p>
            </div>
            <div class="industry-mini-card">
                <div class="industry-icon">
                    <i class="fas fa-oil-well"></i>
                </div>
                <h3>Mining</h3>
                <p>Comprehensive fuel management for remote mining operations.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2>Need a Solution for Your Industry?</h2>
            <p>Contact our team to discuss how we can address your specific industry challenges.</p>
            <a href="<?php echo BASE_URL; ?>/home/contact" class="btn-primary">Get in Touch</a>
        </div>
    </div>
</section>

<?php
// Include footer
include VIEWS_PATH . '/layouts/footer.php';
?>