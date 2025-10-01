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
                        <h1>Admin Dashboard</h1>
                    </div>
                    <div class="header-right">
                        <button class="mobile-menu-toggle" id="mobileMenuToggle">
                            <i class="fas fa-bars"></i>
                        </button>
                    </div>
                </div>
                <nav class="admin-nav" id="adminNav">
                    <a href="/admin" class="active">
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
                    <a href="/admin/siteSettings">
                        <i class="fas fa-cog"></i>
                        <span>Site Settings</span>
                    </a>
                    <a href="/admin/users">
                        <i class="fas fa-users"></i>
                        <span>Users</span>
                    </a>
                    <a href="/admin/contactMessages">
                        <i class="fas fa-envelope"></i>
                        <span>Contact Messages</span>
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
                <div class="dashboard-grid">
                    <div class="dashboard-card">
                        <div class="card-icon">
                            <i class="fas fa-newspaper"></i>
                        </div>
                        <h3>Blog Posts</h3>
                        <p>Manage your blog posts</p>
                        <a href="/admin/posts" class="btn-primary">Manage Posts</a>
                    </div>

                    <div class="dashboard-card">
                        <div class="card-icon">
                            <i class="fas fa-plus"></i>
                        </div>
                        <h3>Create Post</h3>
                        <p>Add a new blog post</p>
                        <a href="/admin/createPost" class="btn-primary">Create Post</a>
                    </div>

                    <div class="dashboard-card">
                        <div class="card-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3>Analytics</h3>
                        <p>View blog statistics</p>
                        <a href="#" class="btn-primary">View Stats</a>
                    </div>

                    <div class="dashboard-card">
                        <div class="card-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3>User Management</h3>
                        <p>Manage user accounts</p>
                        <a href="/admin/users" class="btn-primary">Manage Users</a>
                    </div>

                    <div class="dashboard-card">
                        <div class="card-icon">
                            <i class="fas fa-images"></i>
                        </div>
                        <h3>Hero Images</h3>
                        <p>Manage homepage slider</p>
                        <a href="/admin/heroImages" class="btn-primary">Manage Images</a>
                    </div>

                    <div class="dashboard-card">
                        <div class="card-icon">
                            <i class="fas fa-cog"></i>
                        </div>
                        <h3>Site Settings</h3>
                        <p>Configure site settings</p>
                        <a href="/admin/siteSettings" class="btn-primary">Settings</a>
                    </div>

                    <div class="dashboard-card">
                        <div class="card-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h3>Contact Messages</h3>
                        <p>Manage contact form messages</p>
                        <a href="/admin/contactMessages" class="btn-primary">View Messages</a>
                    </div>
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

        .dashboard-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .dashboard-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .card-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            color: white;
            font-size: 1.5rem;
        }

        .dashboard-card h3 {
            color: var(--primary-color);
            margin-bottom: 10px;
            font-size: 1.2rem;
        }

        .dashboard-card p {
            color: #666;
            margin-bottom: 15px;
            font-size: 0.9rem;
            line-height: 1.4;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--primary-color);
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            font-size: 0.9rem;
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

            .dashboard-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 25px;
            }

            .dashboard-card {
                padding: 30px;
            }

            .card-icon {
                width: 70px;
                height: 70px;
                font-size: 1.8rem;
                margin-bottom: 20px;
            }

            .dashboard-card h3 {
                font-size: 1.3rem;
            }

            .dashboard-card p {
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

            .dashboard-grid {
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                gap: 30px;
            }

            .card-icon {
                width: 80px;
                height: 80px;
                font-size: 2rem;
            }
        }

        /* Large Desktop */
        @media (min-width: 1200px) {
            .dashboard-grid {
                grid-template-columns: repeat(3, 1fr);
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
        .mobile-menu-toggle:focus {
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
