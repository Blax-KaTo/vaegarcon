<?php
// Transportation industry detail page view

// Include header
include VIEWS_PATH . '/layouts/header.php';
?>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1>Transportation & Logistics Solutions</h1>
        <p>Optimizing fuel management for fleet operations across Africa</p>
    </div>
</section>

<!-- Industry Detail -->
<section class="industry-detail">
    <div class="container">
        <div class="industry-intro">
            <div class="industry-image">
                <img src="<?php echo BASE_URL; ?>/images/industries/transportation-detail.jpg" alt="Transportation & Logistics Solutions">
            </div>
            <div class="industry-overview">
                <h2>Fuel Management for Transportation Excellence</h2>
                <p>In the transportation and logistics sector, fuel represents one of the largest operational expenses. Our integrated solutions help fleet operators monitor consumption, prevent theft, optimize routes, and maintain accurate records for compliance and cost management.</p>
                <div class="key-benefits">
                    <h3>Key Benefits</h3>
                    <ul>
                        <li>Reduce fuel costs by up to 20%</li>
                        <li>Prevent unauthorized fuel usage and theft</li>
                        <li>Optimize route planning based on fuel efficiency</li>
                        <li>Simplify compliance reporting and tax claims</li>
                        <li>Extend vehicle lifespan through proper maintenance</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Solutions Section -->
        <div class="solutions-section">
            <h2>Our Transportation Solutions</h2>
            <div class="solutions-grid">
                <div class="solution-card">
                    <div class="solution-icon">
                        <i class="fas fa-gas-pump"></i>
                    </div>
                    <h3>Fleet Fuel Management</h3>
                    <p>Comprehensive systems for monitoring fuel consumption across your entire fleet, with detailed reporting by vehicle, driver, and route.</p>
                </div>
                <div class="solution-card">
                    <div class="solution-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Anti-Theft Systems</h3>
                    <p>Advanced security measures to prevent fuel theft, including real-time monitoring, alerts for unusual activity, and secure dispensing controls.</p>
                </div>
                <div class="solution-card">
                    <div class="solution-icon">
                        <i class="fas fa-route"></i>
                    </div>
                    <h3>Route Optimization</h3>
                    <p>Data-driven route planning that considers fuel efficiency, traffic patterns, and delivery schedules to minimize consumption and costs.</p>
                </div>
                <div class="solution-card">
                    <div class="solution-icon">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <h3>Driver Behavior Analysis</h3>
                    <p>Monitor and improve driving habits that impact fuel consumption, with personalized feedback and incentive programs.</p>
                </div>
                <div class="solution-card">
                    <div class="solution-icon">
                        <i class="fas fa-file-invoice"></i>
                    </div>
                    <h3>Compliance Reporting</h3>
                    <p>Automated generation of reports for regulatory compliance, tax claims, and internal auditing purposes.</p>
                </div>
                <div class="solution-card">
                    <div class="solution-icon">
                        <i class="fas fa-warehouse"></i>
                    </div>
                    <h3>Depot Management</h3>
                    <p>Complete solutions for managing fuel depots, including inventory control, dispensing systems, and delivery verification.</p>
                </div>
            </div>
        </div>
        
        <!-- Implementation Process -->
        <div class="implementation-process">
            <h2>Implementation Process</h2>
            <div class="process-steps">
                <div class="process-step">
                    <div class="step-number">1</div>
                    <h3>Assessment & Planning</h3>
                    <p>We analyze your current operations, fleet size, routes, and fuel management practices to identify opportunities for improvement.</p>
                </div>
                <div class="process-step">
                    <div class="step-number">2</div>
                    <h3>System Design</h3>
                    <p>Our team designs a customized solution that integrates with your existing systems and addresses your specific challenges.</p>
                </div>
                <div class="process-step">
                    <div class="step-number">3</div>
                    <h3>Equipment Installation</h3>
                    <p>We install and configure all necessary hardware, including telemetry devices, dispensing controls, and monitoring systems.</p>
                </div>
                <div class="process-step">
                    <div class="step-number">4</div>
                    <h3>Training & Onboarding</h3>
                    <p>Comprehensive training for your team ensures smooth adoption and maximum benefit from the new systems.</p>
                </div>
                <div class="process-step">
                    <div class="step-number">5</div>
                    <h3>Ongoing Support</h3>
                    <p>Continuous monitoring, regular maintenance, and system updates keep your solution performing optimally.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Case Study -->
<section class="case-study">
    <div class="container">
        <div class="case-study-content">
            <h2>Success Story: East African Logistics</h2>
            <p class="case-intro">A major logistics company operating across East Africa implemented our fleet fuel management solution for their 120-vehicle fleet.</p>
            
            <div class="case-results">
                <div class="result-item">
                    <div class="result-number">18%</div>
                    <p>Reduction in fuel expenses</p>
                </div>
                <div class="result-item">
                    <div class="result-number">22%</div>
                    <p>Decrease in unauthorized fuel usage</p>
                </div>
                <div class="result-item">
                    <div class="result-number">15%</div>
                    <p>Improvement in route efficiency</p>
                </div>
                <div class="result-item">
                    <div class="result-number">ROI</div>
                    <p>Achieved in 4 months</p>
                </div>
            </div>
            
            <blockquote>
                "Implementing Vaegarcon's fuel management system has been transformative for our business. The visibility and control we now have over our fuel usage has dramatically reduced our costs and improved our operational efficiency."
                <cite>- Fleet Manager, East African Logistics</cite>
            </blockquote>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2>Ready to Optimize Your Fleet's Fuel Efficiency?</h2>
            <p>Contact our team today to discuss how our transportation solutions can reduce your operational costs.</p>
            <a href="<?php echo BASE_URL; ?>/home/contact" class="btn-primary">Request a Consultation</a>
        </div>
    </div>
</section>

<!-- Related Industries -->
<section class="related-industries">
    <div class="container">
        <h2>Related Industries</h2>
        <div class="industries-mini-grid">
            <div class="industry-mini-card">
                <div class="industry-icon">
                    <i class="fas fa-industry"></i>
                </div>
                <h3>Manufacturing</h3>
                <p>Energy monitoring and efficiency solutions for production facilities.</p>
                <a href="<?php echo BASE_URL; ?>/industries/manufacturing" class="btn-text">Learn More <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="industry-mini-card">
                <div class="industry-icon">
                    <i class="fas fa-oil-well"></i>
                </div>
                <h3>Mining</h3>
                <p>Comprehensive fuel management for remote mining operations.</p>
                <a href="<?php echo BASE_URL; ?>/industries" class="btn-text">Learn More <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>

<?php
// Include footer
include VIEWS_PATH . '/layouts/footer.php';
?>