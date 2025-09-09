<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="admin-container">
        <header class="admin-header">
            <div class="container">
                <div class="header-content">
                    <div class="header-left">
                        <h1>Site Settings</h1>
                    </div>
                    <div class="header-right">
                        <button class="mobile-menu-toggle" id="mobileMenuToggle">
                            <i class="fas fa-bars"></i>
                        </button>
                    </div>
                </div>
                <nav class="admin-nav" id="adminNav">
                    <a href="/admin">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="/admin/posts">
                        <i class="fas fa-newspaper"></i>
                        <span>Blog Posts</span>
                    </a>
                    <a href="/admin/heroImages">
                        <i class="fas fa-images"></i>
                        <span>Hero Images</span>
                    </a>
                    <a href="/admin/siteSettings" class="active">
                        <i class="fas fa-cog"></i>
                        <span>Site Settings</span>
                    </a>
                    <a href="/admin/users">
                        <i class="fas fa-users"></i>
                        <span>Users</span>
                    </a>
                    <a href="/blog">
                        <i class="fas fa-eye"></i>
                        <span>View Blog</span>
                    </a>
                    <a href="/">
                        <i class="fas fa-home"></i>
                        <span>Back to Site</span>
                    </a>
                    <a href="/logout" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </nav>
            </div>
        </header>

        <main class="admin-main">
            <div class="container">
                <?php if (isset($_GET['success'])): ?>
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i> <?php echo htmlspecialchars($_GET['success']); ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($_GET['error'])): ?>
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i> <?php echo htmlspecialchars($_GET['error']); ?>
                    </div>
                <?php endif; ?>

                <div class="admin-form">
                    <form action="/admin/updateSiteSettings" method="post" enctype="multipart/form-data">
                        <h2>General Settings</h2>
                        <div class="form-group">
                            <label for="site_title">Site Title</label>
                            <input type="text" id="site_title" name="site_title" value="<?php echo isset($settings['site_title']) ? htmlspecialchars($settings['site_title']['setting_value']) : 'Vaegarcon'; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="site_description">Site Description</label>
                            <textarea id="site_description" name="site_description" rows="3"><?php echo isset($settings['site_description']) ? htmlspecialchars($settings['site_description']['setting_value']) : ''; ?></textarea>
                        </div>

                        <h2>Contact Information</h2>
                        <div class="form-group">
                            <label for="contact_email">Contact Email</label>
                            <input type="email" id="contact_email" name="contact_email" value="<?php echo isset($settings['contact_email']) ? htmlspecialchars($settings['contact_email']['setting_value']) : ''; ?>">
                        </div>

                        <div class="form-group">
                            <label for="contact_phone">Contact Phone</label>
                            <input type="text" id="contact_phone" name="contact_phone" value="<?php echo isset($settings['contact_phone']) ? htmlspecialchars($settings['contact_phone']['setting_value']) : ''; ?>">
                        </div>

                        <div class="form-group">
                            <label for="contact_address">Contact Address</label>
                            <textarea id="contact_address" name="contact_address" rows="3"><?php echo isset($settings['contact_address']) ? htmlspecialchars($settings['contact_address']['setting_value']) : ''; ?></textarea>
                        </div>

                        <h2>Social Media</h2>
                        <div class="form-group">
                            <label for="social_facebook">Facebook URL</label>
                            <input type="url" id="social_facebook" name="social_facebook" value="<?php echo isset($settings['social_facebook']) ? htmlspecialchars($settings['social_facebook']['setting_value']) : ''; ?>">
                        </div>

                        <div class="form-group">
                            <label for="social_twitter">Twitter URL</label>
                            <input type="url" id="social_twitter" name="social_twitter" value="<?php echo isset($settings['social_twitter']) ? htmlspecialchars($settings['social_twitter']['setting_value']) : ''; ?>">
                        </div>

                        <div class="form-group">
                            <label for="social_linkedin">LinkedIn URL</label>
                            <input type="url" id="social_linkedin" name="social_linkedin" value="<?php echo isset($settings['social_linkedin']) ? htmlspecialchars($settings['social_linkedin']['setting_value']) : ''; ?>">
                        </div>

                        <div class="form-group">
                            <label for="social_instagram">Instagram URL</label>
                            <input type="url" id="social_instagram" name="social_instagram" value="<?php echo isset($settings['social_instagram']) ? htmlspecialchars($settings['social_instagram']['setting_value']) : ''; ?>">
                        </div>

                        <h2>Site Logo</h2>
                        <div class="form-group">
                            <label>Current Logo</label>
                            <div class="current-logo">
                                <?php if (isset($settings['site_logo']) && !empty($settings['site_logo']['setting_value'])): ?>
                                    <img src="/<?php echo htmlspecialchars($settings['site_logo']['setting_value']); ?>" alt="Site Logo">
                                <?php else: ?>
                                    <p>No logo uploaded</p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="site_logo">Upload New Logo</label>
                            <input type="file" id="site_logo" name="site_logo" accept="image/*">
                            <small>Recommended size: 200x80 pixels. Supported formats: JPG, PNG, GIF, SVG.</small>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn-primary">
                                <i class="fas fa-save"></i> Save Settings
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <style>
        /* Base styles - Mobile first */
        * {
            box-sizing: border-box;
        }

        .admin-container {
            min-height: 100vh;
            background-color: #f5f7fa;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        /* Header Styles */
        .admin-header {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .header-left h1 {
            color: var(--primary-color);
            margin: 0;
            font-size: 1.5rem;
        }

        .mobile-menu-toggle {
            display: block;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--primary-color);
            cursor: pointer;
            padding: 8px;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .mobile-menu-toggle:hover {
            background-color: #f1f5f9;
        }

        /* Navigation Styles */
        .admin-nav {
            display: none;
            flex-direction: column;
            gap: 8px;
            background: #f8fafc;
            border-radius: 12px;
            padding: 15px;
            margin-top: 15px;
        }

        .admin-nav.show {
            display: flex;
        }

        .admin-nav a {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #64748b;
            text-decoration: none;
            padding: 12px 15px;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .admin-nav a i {
            width: 20px;
            text-align: center;
            font-size: 1rem;
        }

        .admin-nav a:hover,
        .admin-nav a.active {
            background: var(--primary-color);
            color: white;
            transform: translateX(4px);
        }

        .admin-nav a.logout-btn:hover {
            background: #ef4444;
            transform: translateX(4px);
        }

        /* Main Content */
        .admin-main {
            padding: 20px 0;
        }

        /* Alert Messages */
        .alert {
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.9rem;
        }

        .alert-success {
            background-color: #dcfce7;
            color: #166534;
        }

        .alert-danger {
            background-color: #fee2e2;
            color: #b91c1c;
        }

        /* Form Styles */
        .admin-form {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .admin-form h2 {
            color: var(--primary-color);
            font-size: 1.3rem;
            margin-top: 30px;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #e2e8f0;
        }

        .admin-form h2:first-child {
            margin-top: 0;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #334155;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="url"],
        .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .form-group input[type="file"] {
            padding: 10px 0;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: var(--primary-color);
            outline: none;
        }

        .form-group small {
            display: block;
            margin-top: 5px;
            color: #64748b;
            font-size: 0.8rem;
        }

        .current-logo {
            margin-top: 10px;
            padding: 15px;
            background: #f8fafc;
            border-radius: 8px;
            text-align: center;
        }

        .current-logo img {
            max-width: 200px;
            max-height: 80px;
        }

        .current-logo p {
            color: #64748b;
            font-style: italic;
        }

        .form-actions {
            margin-top: 30px;
            display: flex;
            justify-content: flex-end;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--primary-color);
            color: white;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            font-size: 1rem;
            border: none;
            cursor: pointer;
        }

        .btn-primary:hover {
            background: var(--secondary-color);
            transform: translateY(-1px);
        }

        /* Tablet Styles */
        @media (min-width: 576px) {
            .container {
                padding: 0 20px;
            }

            .header-left h1 {
                font-size: 1.8rem;
            }

            .admin-main {
                padding: 25px 0;
            }

            .admin-form {
                padding: 30px;
            }

            .alert {
                padding: 15px;
                font-size: 1rem;
            }
        }

        /* Desktop Styles */
        @media (min-width: 768px) {
            .admin-header {
                padding: 20px 0;
            }

            .header-content {
                margin-bottom: 20px;
            }

            .header-left h1 {
                font-size: 2rem;
            }

            .mobile-menu-toggle {
                display: none;
            }

            .admin-nav {
                display: flex;
                flex-direction: row;
                background: transparent;
                padding: 0;
                margin-top: 0;
                gap: 15px;
                flex-wrap: wrap;
            }

            .admin-nav a {
                padding: 10px 15px;
                border-radius: 8px;
            }

            .admin-nav a:hover,
            .admin-nav a.active {
                transform: none;
            }

            .admin-nav a.logout-btn:hover {
                transform: none;
            }

            .admin-main {
                padding: 40px 0;
            }

            .admin-form {
                padding: 35px;
            }

            .form-group {
                margin-bottom: 25px;
            }
        }

        /* Large Desktop */
        @media (min-width: 1200px) {
            .admin-form {
                padding: 40px;
            }
        }

        /* Accessibility */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }

        /* Focus styles for keyboard navigation */
        .admin-nav a:focus,
        .btn-primary:focus,
        .mobile-menu-toggle:focus,
        input:focus,
        textarea:focus {
            outline: 2px solid var(--primary-color);
            outline-offset: 2px;
        }
    </style>

    <script>
        // Mobile menu toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuToggle = document.getElementById('mobileMenuToggle');
            const adminNav = document.getElementById('adminNav');

            if (mobileMenuToggle && adminNav) {
                mobileMenuToggle.addEventListener('click', function() {
                    adminNav.classList.toggle('show');
                    
                    // Update icon
                    const icon = this.querySelector('i');
                    if (adminNav.classList.contains('show')) {
                        icon.className = 'fas fa-times';
                    } else {
                        icon.className = 'fas fa-bars';
                    }
                });

                // Close menu when clicking outside
                document.addEventListener('click', function(event) {
                    if (!mobileMenuToggle.contains(event.target) && !adminNav.contains(event.target)) {
                        adminNav.classList.remove('show');
                        mobileMenuToggle.querySelector('i').className = 'fas fa-bars';
                    }
                });

                // Close menu on window resize to desktop
                window.addEventListener('resize', function() {
                    if (window.innerWidth >= 768) {
                        adminNav.classList.remove('show');
                        mobileMenuToggle.querySelector('i').className = 'fas fa-bars';
                    }
                });
            }
        });
    </script>
</body>
</html>