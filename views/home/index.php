<?php
// Home page view

// Include header
include VIEWS_PATH . '/layouts/header.php';

// Fetch active hero images directly from the database
require_once INCLUDES_PATH . '/db.php';
require_once MODELS_PATH . '/SiteSettingsModel.php';
$db = Database::getInstance()->getConnection();
$siteSettingsModel = new SiteSettingsModel($db);
$heroImages = $siteSettingsModel->getActiveHeroImages();
?>

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <div class="hero-content">
            <h1><span class="text-gradient">Fuel & Telemetry</span>
            <span>Engineering Solutions</span></h1>
            <p>Delivering reliable, data-driven technology for safe, efficient, and profitable operations across Africa.</p>
            <div class="hero-slider">
                <?php if (!empty($heroImages)): ?>
                    <?php foreach ($heroImages as $image): ?>
                        <div class="slide">
                            <img src="<?php echo BASE_URL . '/' . $image['image_path']; ?>" alt="<?php echo htmlspecialchars($image['title']); ?>">
                            <?php if (!empty($image['title']) || !empty($image['description'])): ?>
                                <div class="slide-content">
                                    <?php if (!empty($image['title'])): ?>
                                        <h2><?php echo htmlspecialchars($image['title']); ?></h2>
                                    <?php endif; ?>
                                    <?php if (!empty($image['description'])): ?>
                                        <p><?php echo htmlspecialchars($image['description']); ?></p>
                                    <?php endif; ?>
                                    <?php if (!empty($image['button_text']) && !empty($image['button_link'])): ?>
                                        <a href="<?php echo htmlspecialchars($image['button_link']); ?>" class="btn"><?php echo htmlspecialchars($image['button_text']); ?></a>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <!-- Fallback to static images if no hero images in database -->
                    <?php
                    $industryImages = glob(__DIR__ . '/../../img/industries/*.{jpg,jpeg,png,gif}', GLOB_BRACE);
                    foreach ($industryImages as $imgPath): ?>
                        <div class="slide">
                            <img src="<?php echo BASE_URL . '/img/industries/' . basename($imgPath); ?>" alt="Industry Image">
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                <button class="slider-prev" aria-label="Previous">&#10094;</button>
                <button class="slider-next" aria-label="Next">&#10095;</button>
            </div>
        </div>
    </div>
</section>

<!-- Mission Section -->
<section id="mission" class="mission">
    <div class="container">
        <div class="mission-content">
            <div class="m-content">
                <h2>Our Mission</h2>
                <p>To deliver reliable, data-driven technology for safe, efficient, and profitable operations.</p>
            </div>
            <div class="m-content">
                <h2>Our Vision</h2>
                <p>To create a connected African fuel ecosystem with complete visibility and accountability, building the future of fuel management technology.</p>
            </div>
        </div>
    </div>
</section>

<!-- Proven Results Section -->
<section id="results" class="results">
    <div class="container">
        <div class="section-header">
            <h2>Proven Results</h2>
            <p>Our solutions deliver measurable improvements across all operations.</p>
        </div>
        <div class="results-content">
            <div class="results-grid">
                <div class="result-card">
                    <div class="result-number">30%</div>
                    <div class="result-text">Reduction in fuel loss</div>
                </div>
                <div class="result-card">
                    <div class="result-number">24/7</div>
                    <div class="result-text">Real-time monitoring</div>
                </div>
                <div class="result-card">
                    <div class="result-number">15%</div>
                    <div class="result-text">Increase in operational efficiency</div>
                </div>
                <div class="result-card">
                    <div class="result-number">99.9%</div>
                    <div class="result-text">System uptime reliability</div>
                </div>
            </div>
        </div>
    </div>
    </section>

<!-- Why Choose Vaegarcon Section -->
<section id="about" class="about">
    <div class="container">
        <div class="section-header">
            <h2 style="color: #fff;">Why Choose Vaegarcon</h2>
        </div>
        <div class="about-grid">
            <div class="about-card">
                <div class="about-icon">
                    <i class="fas fa-award"></i>
                </div>
                <h3>Proven Expertise</h3>
                <p>Deep knowledge in telemetry and fuel quality management with years of industry experience.</p>
            </div>
            <div class="about-card">
                <div class="about-icon">
                    <i class="fas fa-puzzle-piece"></i>
                </div>
                <h3>Modular Solutions</h3>
                <p>Flexible systems that integrate seamlessly with your existing infrastructure.</p>
            </div>
            <div class="about-card">
                <div class="about-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3>Actionable Analytics</h3>
                <p>Transform raw data into meaningful insights for operational improvement.</p>
            </div>
        </div>
    </div>
    </section>

<!-- Hello, Good morning / Get Started Section -->
<section id="get-started" class="get-started">
    <div class="container">
        <div class="get-started-grid">
            <div class="get-started-card">
                <div class="get-started-header">
                    <h2 style="text-align: left;">
                        <?php
                        // Dynamic greeting based on current time
                        date_default_timezone_set('Africa/Lagos'); // Set to your preferred timezone
                        $hour = (int)date('G');
                        if ($hour >= 5 && $hour < 12) {
                            $greeting = 'Good morning';
                        } elseif ($hour >= 12 && $hour < 17) {
                            $greeting = 'Good afternoon';
                        } elseif ($hour >= 17 && $hour < 21) {
                            $greeting = 'Good evening';
                        } else {
                            $greeting = 'Hello';
                        }
                        echo "Hello, $greeting...";
                        ?>
                    </h2>
                </div>
                <h3>Get Started with Vaegarcon</h3>
                <div class="btn-cont">
                    <a href="<?php echo BASE_URL; ?>/services" class="get-started-btn">Services</a>
                </div>
            </div>
        </div>
    </div>
    </section>

<?php
// Include footer
include VIEWS_PATH . '/layouts/footer.php';
?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.hero-slider .slide');
    const prevBtn = document.querySelector('.hero-slider .slider-prev');
    const nextBtn = document.querySelector('.hero-slider .slider-next');
    let current = 0;
    let timer;

    function showSlide(idx) {
        slides.forEach((slide, i) => {
            slide.classList.toggle('active', i === idx);
        });
        current = idx;
    }

    function nextSlide() {
        showSlide((current + 1) % slides.length);
    }

    function prevSlide() {
        showSlide((current - 1 + slides.length) % slides.length);
    }

    function startAutoSlide() {
        timer = setInterval(nextSlide, 3500);
    }

    function stopAutoSlide() {
        clearInterval(timer);
    }

    if (slides.length > 0) {
        showSlide(0);
        startAutoSlide();
        nextBtn.addEventListener('click', function() {
            stopAutoSlide();
            nextSlide();
            startAutoSlide();
        });
        prevBtn.addEventListener('click', function() {
            stopAutoSlide();
            prevSlide();
            startAutoSlide();
        });
    }
});
</script>