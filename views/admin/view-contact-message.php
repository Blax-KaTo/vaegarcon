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
                        <h1>View Message</h1>
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
                    <a href="/admin/siteSettings">
                        <i class="fas fa-cog"></i>
                        <span>Site Settings</span>
                    </a>
                    <a href="/admin/users">
                        <i class="fas fa-users"></i>
                        <span>Users</span>
                    </a>
                    <a href="/admin/contactMessages" class="active">
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
                <!-- Back Button -->
                <div class="back-button">
                    <a href="/admin/contactMessages" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Messages
                    </a>
                </div>

                <!-- Message Details -->
                <div class="message-detail-container">
                    <div class="message-detail-header">
                        <div class="message-info">
                            <h2><?php echo htmlspecialchars($message['name']); ?></h2>
                            <p class="message-email">
                                <i class="fas fa-envelope"></i>
                                <?php echo htmlspecialchars($message['email']); ?>
                            </p>
                            <?php if (!empty($message['subject'])): ?>
                                <p class="message-subject">
                                    <i class="fas fa-tag"></i>
                                    <?php echo htmlspecialchars($message['subject']); ?>
                                </p>
                            <?php endif; ?>
                        </div>
                        <div class="message-meta">
                            <div class="message-date">
                                <i class="fas fa-calendar"></i>
                                <?php echo date('F j, Y \a\t g:i A', strtotime($message['created_at'])); ?>
                            </div>
                            <div class="message-status status-<?php echo $message['status']; ?>">
                                <i class="fas fa-circle"></i>
                                <?php echo ucfirst($message['status']); ?>
                            </div>
                        </div>
                    </div>

                    <div class="message-content">
                        <h3>Message</h3>
                        <div class="message-text">
                            <?php echo nl2br(htmlspecialchars($message['message'])); ?>
                        </div>
                    </div>

                    <div class="message-actions">
                        <div class="status-update">
                            <h4>Update Status</h4>
                            <form method="post" action="/admin/updateContactMessageStatus/<?php echo $message['id']; ?>" class="status-form">
                                <div class="status-options">
                                    <label class="status-option <?php echo $message['status'] === 'new' ? 'active' : ''; ?>">
                                        <input type="radio" name="status" value="new" <?php echo $message['status'] === 'new' ? 'checked' : ''; ?>>
                                        <span class="status-label">
                                            <i class="fas fa-exclamation-circle"></i>
                                            New
                                        </span>
                                    </label>
                                    <label class="status-option <?php echo $message['status'] === 'read' ? 'active' : ''; ?>">
                                        <input type="radio" name="status" value="read" <?php echo $message['status'] === 'read' ? 'checked' : ''; ?>>
                                        <span class="status-label">
                                            <i class="fas fa-eye"></i>
                                            Read
                                        </span>
                                    </label>
                                    <label class="status-option <?php echo $message['status'] === 'replied' ? 'active' : ''; ?>">
                                        <input type="radio" name="status" value="replied" <?php echo $message['status'] === 'replied' ? 'checked' : ''; ?>>
                                        <span class="status-label">
                                            <i class="fas fa-reply"></i>
                                            Replied
                                        </span>
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Update Status
                                </button>
                            </form>
                        </div>

                        <div class="action-buttons">
                            <a href="mailto:<?php echo htmlspecialchars($message['email']); ?>" class="btn btn-primary">
                                <i class="fas fa-reply"></i> Reply via Email
                            </a>
                            <a href="/admin/deleteContactMessage/<?php echo $message['id']; ?>" 
                               class="btn btn-danger" 
                               onclick="return confirm('Are you sure you want to delete this message?')">
                                <i class="fas fa-trash"></i> Delete Message
                            </a>
                        </div>
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

        /* Back Button */
        .back-button {
            margin-bottom: 25px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-secondary {
            background: #e2e8f0;
            color: #475569;
        }

        .btn-secondary:hover {
            background: #cbd5e1;
        }

        .btn-primary {
            background: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background: var(--secondary-color);
        }

        .btn-danger {
            background: #ef4444;
            color: white;
        }

        .btn-danger:hover {
            background: #dc2626;
        }

        /* Message Detail Container */
        .message-detail-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .message-detail-header {
            padding: 25px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .message-info h2 {
            margin: 0 0 10px 0;
            color: var(--primary-color);
            font-size: 1.5rem;
        }

        .message-email,
        .message-subject {
            margin: 0 0 8px 0;
            color: #64748b;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .message-email i,
        .message-subject i {
            width: 16px;
            color: var(--primary-color);
        }

        .message-meta {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .message-date {
            color: #94a3b8;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .message-date i {
            width: 16px;
        }

        .message-status {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            width: fit-content;
        }

        .status-new {
            background: #fef3c7;
            color: #92400e;
        }

        .status-read {
            background: #dbeafe;
            color: #1e40af;
        }

        .status-replied {
            background: #d1fae5;
            color: #065f46;
        }

        .message-content {
            padding: 25px;
            border-bottom: 1px solid #e2e8f0;
        }

        .message-content h3 {
            margin: 0 0 15px 0;
            color: var(--primary-color);
            font-size: 1.2rem;
        }

        .message-text {
            color: #475569;
            line-height: 1.6;
            font-size: 1rem;
        }

        .message-actions {
            padding: 25px;
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        .status-update h4 {
            margin: 0 0 15px 0;
            color: var(--primary-color);
            font-size: 1.1rem;
        }

        .status-form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .status-options {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .status-option {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .status-option:hover {
            border-color: var(--primary-color);
            background: #f8fafc;
        }

        .status-option.active {
            border-color: var(--primary-color);
            background: #e0f2fe;
        }

        .status-option input[type="radio"] {
            margin: 0 12px 0 0;
            transform: scale(1.2);
        }

        .status-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
            color: #475569;
        }

        .status-option.active .status-label {
            color: var(--primary-color);
        }

        .action-buttons {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        /* Tablet Styles */
        @media (min-width: 576px) {
            .container {
                padding: 0 20px;
            }

            .header-left h1 {
                font-size: 1.8rem;
            }

            .message-detail-header {
                flex-direction: row;
                justify-content: space-between;
                align-items: flex-start;
            }

            .message-meta {
                align-items: flex-end;
            }

            .status-options {
                flex-direction: row;
                gap: 15px;
            }

            .action-buttons {
                flex-direction: row;
                gap: 15px;
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

            .message-actions {
                flex-direction: row;
                align-items: flex-start;
            }

            .status-update {
                flex: 1;
            }

            .action-buttons {
                flex-direction: column;
                min-width: 200px;
            }
        }

        /* Large Desktop */
        @media (min-width: 1200px) {
            .status-options {
                flex-direction: row;
            }

            .action-buttons {
                flex-direction: row;
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
        .btn:focus,
        .mobile-menu-toggle:focus,
        .status-option:focus {
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

            // Status option selection
            const statusOptions = document.querySelectorAll('.status-option');
            statusOptions.forEach(option => {
                option.addEventListener('click', function() {
                    // Remove active class from all options
                    statusOptions.forEach(opt => opt.classList.remove('active'));
                    // Add active class to clicked option
                    this.classList.add('active');
                    // Check the radio button
                    this.querySelector('input[type="radio"]').checked = true;
                });
            });
        });
    </script>
</body>
</html>
