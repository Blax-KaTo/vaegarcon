<?php
// 404 Error page

// Set page title
$pageTitle = '404 Not Found - Vaegarcon';

// Include header
include VIEWS_PATH . '/layouts/header.php';
?>

<section class="error-page">
    <div class="container">
        <div class="error-content">
            <h1>404</h1>
            <h2>Page Not Found</h2>
            <p>The page you are looking for does not exist or has been moved.</p>
            <a href="<?php echo BASE_URL; ?>" class="btn-primary">Back to Home</a>
        </div>
    </div>
</section>

<style>
    .error-page {
        min-height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 50px 0;
    }
    
    .error-content h1 {
        font-size: 8rem;
        color: #0056b3;
        margin-bottom: 0;
        line-height: 1;
    }
    
    .error-content h2 {
        font-size: 2.5rem;
        margin-bottom: 20px;
        color: #333;
    }
    
    .error-content p {
        font-size: 1.2rem;
        margin-bottom: 30px;
        color: #666;
    }
</style>

<?php
// Include footer
include VIEWS_PATH . '/layouts/footer.php';
?>