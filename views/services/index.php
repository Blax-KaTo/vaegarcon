<?php
// Services overview page view

// Include header
include VIEWS_PATH . '/layouts/header.php';
?>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1>Our Services</h1>
        <p>Comprehensive solutions for fuel management, telemetry, and operational excellence</p>
    </div>
</section>

<!-- Services Overview -->
<section class="services-overview">
    <div class="container">
        <div class="section-intro">
            <h2>Integrated Solutions for Complete Fuel Visibility</h2>
            <p>At Vaegarcon, we provide end-to-end solutions for fuel management, telemetry, and operational excellence. Our technology-driven approach ensures that your fuel operations are efficient, secure, and optimized for maximum profitability.</p>
        </div>
        
        <div class="services-grid">
            <!-- Telemetry & Tank Monitoring -->
            <div class="service-card large">
                <div class="service-image">
                    <img src="<?php echo BASE_URL; ?>/images/services/telemetry.jpg" alt="Telemetry & Tank Monitoring">
                </div>
                <div class="service-content">
                    <div class="service-icon">
                        <i class="fas fa-tachometer-alt"></i>
                    </div>
                    <h3>Telemetry & Tank Monitoring</h3>
                    <p>Our advanced telemetry solutions provide real-time monitoring of fuel levels, quality, and environmental conditions. With our systems, you gain complete visibility into your fuel inventory across all locations.</p>
                    <ul class="service-features">
                        <li>Real-time level monitoring</li>
                        <li>Quality and temperature sensing</li>
                        <li>Leak detection and alerts</li>
                        <li>Remote calibration capabilities</li>
                        <li>Historical data analysis</li>
                    </ul>
                    <a href="<?php echo BASE_URL; ?>/services/telemetry" class="btn-secondary">Learn More</a>
                </div>
            </div>
            
            <!-- Fuel Management Systems -->
            <div class="service-card large">
                <div class="service-image">
                    <img src="<?php echo BASE_URL; ?>/images/services/fuel-management.jpg" alt="Fuel Management Systems">
                </div>
                <div class="service-content">
                    <div class="service-icon">
                        <i class="fas fa-gas-pump"></i>
                    </div>
                    <h3>Fuel Management Systems</h3>
                    <p>Our comprehensive fuel management solutions track every drop of fuel from delivery to consumption. Our systems integrate with your existing infrastructure to provide seamless control and accountability.</p>
                    <ul class="service-features">
                        <li>Automated delivery verification</li>
                        <li>Dispensing control and authorization</li>
                        <li>Consumption tracking and reporting</li>
                        <li>Theft prevention measures</li>
                        <li>Inventory reconciliation</li>
                    </ul>
                    <a href="<?php echo BASE_URL; ?>/services/fuelManagement" class="btn-secondary">Learn More</a>
                </div>
            </div>
            
            <!-- Data Analytics -->
            <div class="service-card large">
                <div class="service-image">
                    <img src="<?php echo BASE_URL; ?>/images/services/data-analytics.jpg" alt="Data Analytics">
                </div>
                <div class="service-content">
                    <div class="service-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3>Data Analytics</h3>
                    <p>Transform your operational data into actionable insights with our advanced analytics platform. Our customizable dashboards and reports help you identify trends, optimize operations, and make data-driven decisions.</p>
                    <ul class="service-features">
                        <li>Customizable dashboards</li>
                        <li>Predictive maintenance alerts</li>
                        <li>Consumption pattern analysis</li>
                        <li>Cost optimization recommendations</li>
                        <li>Compliance and audit reporting</li>
                    </ul>
                    <a href="<?php echo BASE_URL; ?>/services/dataAnalytics" class="btn-secondary">Learn More</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2>Ready to Transform Your Fuel Operations?</h2>
            <p>Contact our team today to discuss how our solutions can address your specific challenges.</p>
            <a href="<?php echo BASE_URL; ?>/home/contact" class="btn-primary">Get in Touch</a>
        </div>
    </div>
</section>

<?php
// Include footer
include VIEWS_PATH . '/layouts/footer.php';
?>