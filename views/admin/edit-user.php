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
                        <h1>Edit User</h1>
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
                <div class="form-container">
                    <div class="form-header">
                        <i class="fas fa-user-edit"></i>
                        <h2>Edit User Account</h2>
                        <p>Update user information and settings</p>
                    </div>

                    <?php if (isset($error)): ?>
                        <div class="alert alert-error">
                            <i class="fas fa-exclamation-triangle"></i>
                            <?php echo htmlspecialchars($error); ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" class="user-form">
                        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken ?? ''); ?>">
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="username">
                                    <i class="fas fa-user"></i>
                                    Username
                                </label>
                                <input 
                                    type="text" 
                                    id="username" 
                                    name="username" 
                                    value="<?php echo htmlspecialchars($formData['username'] ?? ''); ?>"
                                    placeholder="Enter username"
                                    required
                                >
                                <?php if (isset($errors['username'])): ?>
                                    <span class="error-text"><?php echo htmlspecialchars($errors['username']); ?></span>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label for="email">
                                    <i class="fas fa-envelope"></i>
                                    Email Address
                                </label>
                                <input 
                                    type="email" 
                                    id="email" 
                                    name="email" 
                                    value="<?php echo htmlspecialchars($formData['email'] ?? ''); ?>"
                                    placeholder="Enter email address"
                                    required
                                >
                                <?php if (isset($errors['email'])): ?>
                                    <span class="error-text"><?php echo htmlspecialchars($errors['email']); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="password">
                                    <i class="fas fa-lock"></i>
                                    New Password
                                </label>
                                <input 
                                    type="password" 
                                    id="password" 
                                    name="password" 
                                    placeholder="Leave blank to keep current password"
                                >
                                <small class="form-help">Leave blank to keep the current password</small>
                                <?php if (isset($errors['password'])): ?>
                                    <span class="error-text"><?php echo htmlspecialchars($errors['password']); ?></span>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label for="confirm_password">
                                    <i class="fas fa-lock"></i>
                                    Confirm New Password
                                </label>
                                <input 
                                    type="password" 
                                    id="confirm_password" 
                                    name="confirm_password" 
                                    placeholder="Confirm new password"
                                >
                                <?php if (isset($errors['confirm_password'])): ?>
                                    <span class="error-text"><?php echo htmlspecialchars($errors['confirm_password']); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="role">
                                    <i class="fas fa-user-tag"></i>
                                    User Role
                                </label>
                                <select id="role" name="role" required>
                                    <option value="">Select Role</option>
                                    <option value="admin" <?php echo (($formData['role'] ?? '') === 'admin') ? 'selected' : ''; ?>>Administrator</option>
                                    <option value="user" <?php echo (($formData['role'] ?? '') === 'user') ? 'selected' : ''; ?>>Regular User</option>
                                </select>
                                <?php if (isset($errors['role'])): ?>
                                    <span class="error-text"><?php echo htmlspecialchars($errors['role']); ?></span>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label for="status">
                                    <i class="fas fa-toggle-on"></i>
                                    Account Status
                                </label>
                                <select id="status" name="status" required>
                                    <option value="">Select Status</option>
                                    <option value="active" <?php echo (($formData['status'] ?? '') === 'active') ? 'selected' : ''; ?>>Active</option>
                                    <option value="inactive" <?php echo (($formData['status'] ?? '') === 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                                </select>
                                <?php if (isset($errors['status'])): ?>
                                    <span class="error-text"><?php echo htmlspecialchars($errors['status']); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="user-info-card">
                            <h3>Account Information</h3>
                            <div class="info-grid">
                                <div class="info-item">
                                    <label>User ID:</label>
                                    <span><?php echo htmlspecialchars($user['id'] ?? ''); ?></span>
                                </div>
                                <div class="info-item">
                                    <label>Created:</label>
                                    <span><?php echo isset($user['created_at']) ? date('M j, Y g:i A', strtotime($user['created_at'])) : 'N/A'; ?></span>
                                </div>
                                <div class="info-item">
                                    <label>Last Login:</label>
                                    <span>
                                        <?php if (isset($user['last_login']) && $user['last_login']): ?>
                                            <?php echo date('M j, Y g:i A', strtotime($user['last_login'])); ?>
                                        <?php else: ?>
                                            Never
                                        <?php endif; ?>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <a href="/admin/users" class="btn-secondary">
                                <i class="fas fa-arrow-left"></i>
                                Back to Users
                            </a>
                            <button type="submit" class="btn-primary">
                                <i class="fas fa-save"></i>
                                Update User
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

        .form-container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .form-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-header i {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 15px;
        }

        .form-header h2 {
            color: var(--primary-color);
            margin-bottom: 8px;
            font-size: 1.5rem;
        }

        .form-header p {
            color: #666;
            font-size: 0.9rem;
        }

        .alert {
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.9rem;
        }

        .alert-error {
            background: #fdf2f2;
            color: #e74c3c;
            border: 1px solid #fecaca;
        }

        .user-form {
            margin-bottom: 20px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 0.9rem;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e1e5e9;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }

        .form-help {
            color: #666;
            font-size: 0.8rem;
            margin-top: 5px;
            display: block;
        }

        .error-text {
            color: #e74c3c;
            font-size: 0.8rem;
            margin-top: 5px;
            display: block;
        }

        .user-info-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
        }

        .user-info-card h3 {
            color: var(--primary-color);
            margin-bottom: 15px;
            font-size: 1.1rem;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .info-item label {
            font-weight: 600;
            color: #64748b;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-item span {
            color: #1e293b;
            font-size: 0.9rem;
        }

        .form-actions {
            display: flex;
            flex-direction: column;
            gap: 12px;
            padding-top: 20px;
            border-top: 1px solid #e1e5e9;
        }

        .btn-primary,
        .btn-secondary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 0.9rem;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background: var(--secondary-color);
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: #f8fafc;
            color: #64748b;
            border: 2px solid #e2e8f0;
        }

        .btn-secondary:hover {
            background: #e2e8f0;
            color: #475569;
        }

        /* Tablet Styles */
        @media (min-width: 576px) {
            .container {
                padding: 0 20px;
            }

            .header-left h1 {
                font-size: 1.8rem;
            }

            .form-container {
                max-width: 750px;
                padding: 35px;
            }

            .form-header h2 {
                font-size: 1.8rem;
            }

            .form-header p {
                font-size: 1rem;
            }

            .form-row {
                grid-template-columns: 1fr 1fr;
                gap: 25px;
            }

            .info-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }

            .form-actions {
                flex-direction: row;
                justify-content: flex-end;
                gap: 15px;
            }

            .btn-primary,
            .btn-secondary {
                padding: 14px 24px;
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

            .form-container {
                max-width: 900px;
                padding: 40px;
            }

            .form-header {
                margin-bottom: 40px;
            }

            .form-header i {
                font-size: 3rem;
            }

            .form-header h2 {
                font-size: 2rem;
            }

            .alert {
                padding: 15px;
                font-size: 1rem;
            }

            .form-group {
                margin-bottom: 25px;
            }

            .form-group label {
                font-size: 1rem;
            }

            .form-group input,
            .form-group select {
                padding: 15px;
            }

            .user-info-card {
                padding: 25px;
                margin-bottom: 30px;
            }

            .user-info-card h3 {
                font-size: 1.3rem;
                margin-bottom: 20px;
            }

            .info-grid {
                grid-template-columns: repeat(3, 1fr);
            }

            .info-item label {
                font-size: 0.9rem;
            }

            .info-item span {
                font-size: 1rem;
            }
        }

        /* Large Desktop */
        @media (min-width: 1200px) {
            .form-container {
                max-width: 1000px;
            }
        }

        /* Focus styles for keyboard navigation */
        .admin-nav a:focus,
        .btn-primary:focus,
        .btn-secondary:focus,
        .mobile-menu-toggle:focus,
        .form-group input:focus,
        .form-group select:focus {
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