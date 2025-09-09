<?php
// Telemetry service detail page view

// Include header
include VIEWS_PATH . '/layouts/header.php';
?>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1>Telemetry & Tank Monitoring</h1>
        <p>Real-time level and quality data for complete fuel visibility</p>
    </div>
</section>

<!-- Service Detail -->
<section class="service-detail">
    <div class="container">
        <div class="service-intro">
            <div class="service-image">
                <img src="<?php echo BASE_URL; ?>/images/services/telemetry-detail.jpg" alt="Telemetry & Tank Monitoring Systems">
            </div>
            <div class="service-overview">
                <h2>Advanced Monitoring for Complete Visibility</h2>
                <p>Our telemetry solutions provide real-time monitoring of fuel levels, quality, and environmental conditions. With our systems, you gain complete visibility into your fuel inventory across all locations, enabling better decision-making and operational efficiency.</p>
                <div class="key-benefits">
                    <h3>Key Benefits</h3>
                    <ul>
                        <li>Reduce fuel losses by up to 15%</li>
                        <li>Eliminate manual tank dipping and associated errors</li>
                        <li>Prevent stock-outs and emergency deliveries</li>
                        <li>Early detection of leaks and quality issues</li>
                        <li>Optimize delivery schedules and inventory levels</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Features Section -->
        <div class="features-section">
            <h2>Key Features</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3>Real-time Level Monitoring</h3>
                    <p>Continuous monitoring of fuel levels with millimeter accuracy, providing instant visibility into your inventory status.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-thermometer-half"></i>
                    </div>
                    <h3>Quality & Temperature Sensing</h3>
                    <p>Monitor fuel quality parameters and temperature to ensure product integrity and prevent equipment damage.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <h3>Leak Detection & Alerts</h3>
                    <p>Advanced algorithms detect even slow leaks, with immediate notifications to prevent environmental damage and product loss.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-sliders-h"></i>
                    </div>
                    <h3>Remote Calibration</h3>
                    <p>Adjust and calibrate monitoring systems remotely, reducing the need for site visits and ensuring accuracy.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-history"></i>
                    </div>
                    <h3>Historical Data Analysis</h3>
                    <p>Access and analyze historical data to identify trends, optimize inventory levels, and improve forecasting.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h3>Mobile Accessibility</h3>
                    <p>Access your fuel data anytime, anywhere through our mobile application, enabling on-the-go decision making.</p>
                </div>
            </div>
        </div>
        
        <!-- How It Works -->
        <div class="how-it-works">
            <h2>How It Works</h2>
            <div class="process-steps">
                <div class="process-step">
                    <div class="step-number">1</div>
                    <h3>Installation & Setup</h3>
                    <p>Our team installs and configures the telemetry equipment on your tanks, ensuring proper calibration and communication.</p>
                </div>
                <div class="process-step">
                    <div class="step-number">2</div>
                    <h3>Data Collection</h3>
                    <p>Sensors continuously collect data on fuel levels, temperature, quality, and environmental conditions.</p>
                </div>
                <div class="process-step">
                    <div class="step-number">3</div>
                    <h3>Transmission & Processing</h3>
                    <p>Data is securely transmitted to our cloud platform where it's processed and analyzed in real-time.</p>
                </div>
                <div class="process-step">
                    <div class="step-number">4</div>
                    <h3>Visualization & Alerts</h3>
                    <p>Information is presented in intuitive dashboards, with automated alerts for critical conditions.</p>
                </div>
                <div class="process-step">
                    <div class="step-number">5</div>
                    <h3>Reporting & Optimization</h3>
                    <p>Regular reports provide insights for operational improvements and inventory optimization.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Case Study -->
<section class="case-study">
    <div class="container">
        <div class="case-study-content">
            <h2>Success Story: National Logistics Company</h2>
            <p class="case-intro">A leading logistics company with operations across 5 African countries implemented our telemetry solution across 35 depots.</p>
            
            <div class="case-results">
                <div class="result-item">
                    <div class="result-number">12%</div>
                    <p>Reduction in fuel losses</p>
                </div>
                <div class="result-item">
                    <div class="result-number">8%</div>
                    <p>Decrease in operational costs</p>
                </div>
                <div class="result-item">
                    <div class="result-number">100%</div>
                    <p>Elimination of stock-outs</p>
                </div>
                <div class="result-item">
                    <div class="result-number">ROI</div>
                    <p>Achieved in under 6 months</p>
                </div>
            </div>
            
            <blockquote>
                "Vaegarcon's telemetry solution has transformed how we manage our fuel inventory. The real-time visibility and alerts have eliminated stock-outs while significantly reducing our operational costs."
                <cite>- Operations Director, National Logistics Company</cite>
            </blockquote>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2>Ready to Gain Complete Visibility of Your Fuel Assets?</h2>
            <p>Contact our team today to discuss how our telemetry solutions can transform your operations.</p>
            <a href="<?php echo BASE_URL; ?>/home/contact" class="btn-primary">Request a Consultation</a>
        </div>
    </div>
</section>

<!-- Related Services -->
<section class="related-services">
    <div class="container">
        <h2>Related Services</h2>
        <div class="services-mini-grid">
            <div class="service-mini-card">
                <div class="service-icon">
                    <i class="fas fa-gas-pump"></i>
                </div>
                <h3>Fuel Management Systems</h3>
                <p>End-to-end solutions for fuel inventory, dispensing, and consumption tracking.</p>
                <a href="<?php echo BASE_URL; ?>/services/fuelManagement" class="btn-text">Learn More <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="service-mini-card">
                <div class="service-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3>Data Analytics</h3>
                <p>Advanced analytics and reporting for operational insights and decision support.</p>
                <a href="<?php echo BASE_URL; ?>/services/dataAnalytics" class="btn-text">Learn More <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>

<?php
// Include footer
include VIEWS_PATH . '/layouts/footer.php';
?>