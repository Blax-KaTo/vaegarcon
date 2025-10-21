<?php require_once VIEWS_PATH . '/layouts/header.php'; ?>

<div class="page-header">
    <div class="container">
        <h1>Fuel Management Systems</h1>
        <p>Optimize fuel consumption, reduce costs, and enhance operational efficiency</p>
    </div>
</div>

<section class="service-detail">
    <div class="container">
        <div class="service-intro">
            <div class="service-image">
                <img src="<?php echo BASE_URL; ?>/uploads/services/Fuel Management System.jpg" alt="Fuel Management Systems">
            </div>
            <div class="service-overview">
                <h2>Comprehensive Fuel Management Solutions</h2>
                <p>Vaegarcon's Fuel Management Systems provide end-to-end solutions for monitoring, controlling, and optimizing fuel usage across your fleet or facility operations. Our systems integrate seamlessly with your existing infrastructure to deliver real-time insights and automated controls that drive efficiency.</p>
                
                <div class="key-benefits">
                    <h3>Key Benefits</h3>
                    <ul>
                        <li>Reduce fuel costs by up to 15% through optimization and waste prevention</li>
                        <li>Prevent unauthorized fuel access and theft with secure authentication</li>
                        <li>Automate fuel reconciliation and eliminate manual record-keeping</li>
                        <li>Extend equipment lifespan through optimized fueling schedules</li>
                        <li>Reduce carbon footprint through improved fuel efficiency</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="features-section">
            <h2>Core Features</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <h3>Secure Access Control</h3>
                    <p>Implement driver ID cards, PIN codes, or biometric authentication to ensure only authorized personnel can access fuel. Track every transaction by user, vehicle, and department.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-tachometer-alt"></i>
                    </div>
                    <h3>Automated Dispensing</h3>
                    <p>Preset fuel limits by vehicle or equipment type, automatically control dispensing, and capture accurate data for every fueling event without manual intervention.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3>Consumption Analytics</h3>
                    <p>Advanced reporting tools identify consumption patterns, anomalies, and opportunities for optimization with customizable dashboards and scheduled reports.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-sync"></i>
                    </div>
                    <h3>Inventory Management</h3>
                    <p>Automated reconciliation between dispensed fuel and tank levels, with real-time inventory tracking and automated reordering when supplies run low.</p>
                </div>
            </div>
        </div>

        <div class="how-it-works">
            <h2>How It Works</h2>
            <div class="process-steps">
                <div class="process-step">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <h3>System Integration</h3>
                        <p>We install hardware components at your fueling stations and integrate with your existing tanks, pumps, and fleet management systems. Our technicians configure the system to your specific requirements.</p>
                    </div>
                </div>
                
                <div class="process-step">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <h3>User Authentication Setup</h3>
                        <p>We implement your chosen authentication method (cards, PINs, biometrics) and set up user profiles with appropriate access levels and fueling limits based on roles and vehicle types.</p>
                    </div>
                </div>
                
                <div class="process-step">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <h3>Data Collection & Processing</h3>
                        <p>The system automatically collects data from every fueling transaction, including user ID, vehicle ID, fuel type, quantity, time, and location, then processes this information in real-time.</p>
                    </div>
                </div>
                
                <div class="process-step">
                    <div class="step-number">4</div>
                    <div class="step-content">
                        <h3>Analysis & Optimization</h3>
                        <p>Our software analyzes consumption patterns, identifies inefficiencies, and provides actionable insights through customizable reports and dashboards, enabling continuous improvement.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="case-study">
    <div class="container">
        <h2>Success Story: Regional Logistics Company</h2>
        <p class="case-intro">A regional logistics company with a fleet of 75 vehicles implemented our Fuel Management System to address rising fuel costs and suspected fuel theft.</p>
        
        <div class="case-results">
            <div class="result-item">
                <div class="result-number">18%</div>
                <p>Reduction in overall fuel costs</p>
            </div>
            
            <div class="result-item">
                <div class="result-number">100%</div>
                <p>Elimination of unauthorized fueling</p>
            </div>
            
            <div class="result-item">
                <div class="result-number">8</div>
                <p>Hours saved weekly on administrative tasks</p>
            </div>
        </div>
        
        <blockquote>
            "The fuel management system from Vaegarcon paid for itself within the first six months. Not only did we eliminate fuel theft, but the data insights helped us optimize routes and vehicle maintenance schedules, further reducing our operational costs."
            <cite>- Operations Director, Regional Logistics Company</cite>
        </blockquote>
    </div>
</section>

<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2>Ready to Optimize Your Fuel Operations?</h2>
            <p>Contact us today for a consultation and personalized demonstration of our Fuel Management Systems.</p>
            <a href="<?php echo BASE_URL; ?>/home/contact" class="btn btn-primary">Request a Consultation</a>
        </div>
    </div>
</section>

<section class="related-services">
    <div class="container">
        <h2>Related Services</h2>
        <div class="services-mini-grid">
            <div class="service-mini-card">
                <h3>Telemetry & Tank Monitoring</h3>
                <p>Real-time monitoring of fuel levels, temperature, and quality in your storage tanks.</p>
                <a href="/Vaegarcon/services/telemetry" class="btn-text">Learn more <i class="fas fa-arrow-right"></i></a>
            </div>
            
            <div class="service-mini-card">
                <h3>Data Analytics</h3>
                <p>Advanced analytics and reporting to transform your operational data into actionable insights.</p>
                <a href="/Vaegarcon/services/dataAnalytics" class="btn-text">Learn more <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>

<?php require_once VIEWS_PATH . '/layouts/footer.php'; ?>