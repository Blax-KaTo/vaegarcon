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
                        <h1>Contact Messages</h1>
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
                <!-- Success/Error Messages -->
                <?php if (isset($_GET['success'])): ?>
                    <div class="alert alert-success">
                        <?php echo htmlspecialchars($_GET['success']); ?>
                    </div>
                <?php endif; ?>
                
                <?php if (isset($_GET['error'])): ?>
                    <div class="alert alert-error">
                        <?php echo htmlspecialchars($_GET['error']); ?>
                    </div>
                <?php endif; ?>

                <!-- Statistics Cards -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="stat-content">
                            <h3><?php echo $stats['total']; ?></h3>
                            <p>Total Messages</p>
                        </div>
                    </div>
                    <div class="stat-card new">
                        <div class="stat-icon">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <div class="stat-content">
                            <h3><?php echo $stats['new']; ?></h3>
                            <p>New Messages</p>
                        </div>
                    </div>
                    <div class="stat-card read">
                        <div class="stat-icon">
                            <i class="fas fa-eye"></i>
                        </div>
                        <div class="stat-content">
                            <h3><?php echo $stats['read']; ?></h3>
                            <p>Read Messages</p>
                        </div>
                    </div>
                    <div class="stat-card replied">
                        <div class="stat-icon">
                            <i class="fas fa-reply"></i>
                        </div>
                        <div class="stat-content">
                            <h3><?php echo $stats['replied']; ?></h3>
                            <p>Replied Messages</p>
                        </div>
                    </div>
                </div>

                <!-- Filter Tabs -->
                <div class="filter-tabs">
                    <a href="/admin/contactMessages" class="tab <?php echo $currentStatus === 'all' ? 'active' : ''; ?>">
                        All Messages
                    </a>
                    <a href="/admin/contactMessages?status=new" class="tab <?php echo $currentStatus === 'new' ? 'active' : ''; ?>">
                        New Messages
                    </a>
                    <a href="/admin/contactMessages?status=read" class="tab <?php echo $currentStatus === 'read' ? 'active' : ''; ?>">
                        Read Messages
                    </a>
                    <a href="/admin/contactMessages?status=replied" class="tab <?php echo $currentStatus === 'replied' ? 'active' : ''; ?>">
                        Replied Messages
                    </a>
                </div>

                <!-- Messages List -->
                <div class="messages-container">
                    <?php if (empty($messages)): ?>
                        <div class="empty-state">
                            <i class="fas fa-inbox"></i>
                            <h3>No messages found</h3>
                            <p>There are no contact messages to display.</p>
                        </div>
                    <?php else: ?>
                        <div class="messages-list">
                            <?php foreach ($messages as $message): ?>
                                <div class="message-card <?php echo $message['status']; ?>">
                                    <div class="message-header">
                                        <div class="message-info">
                                            <h4><?php echo htmlspecialchars($message['name']); ?></h4>
                                            <p class="message-email"><?php echo htmlspecialchars($message['email']); ?></p>
                                            <?php if (!empty($message['subject'])): ?>
                                                <p class="message-subject"><?php echo htmlspecialchars($message['subject']); ?></p>
                                            <?php endif; ?>
                                        </div>
                                        <div class="message-meta">
                                            <span class="message-date"><?php echo date('M j, Y g:i A', strtotime($message['created_at'])); ?></span>
                                            <span class="message-status status-<?php echo $message['status']; ?>">
                                                <?php echo ucfirst($message['status']); ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="message-content">
                                        <p><?php echo nl2br(htmlspecialchars(substr($message['message'], 0, 200))); ?>
                                        <?php if (strlen($message['message']) > 200): ?>...<?php endif; ?></p>
                                    </div>
                                    <div class="message-actions">
                                        <a href="/admin/viewContactMessage/<?php echo $message['id']; ?>" class="btn btn-primary">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                        <button class="btn btn-primary reply-btn" data-email="<?php echo htmlspecialchars($message['email']); ?>" data-name="<?php echo htmlspecialchars($message['name']); ?>" data-subject="<?php echo htmlspecialchars($message['subject']); ?>">
                                            <i class="fas fa-reply"></i> Reply
                                        </button>
                                        <div class="status-dropdown">
                                            <button class="btn btn-secondary dropdown-toggle">
                                                <i class="fas fa-edit"></i> Status
                                            </button>
                                            <div class="dropdown-menu">
                                                <form method="post" action="/admin/updateContactMessageStatus/<?php echo $message['id']; ?>" class="status-form">
                                                    <button type="submit" name="status" value="new" class="dropdown-item <?php echo $message['status'] === 'new' ? 'active' : ''; ?>">
                                                        <i class="fas fa-exclamation-circle"></i> Mark as New
                                                    </button>
                                                    <button type="submit" name="status" value="read" class="dropdown-item <?php echo $message['status'] === 'read' ? 'active' : ''; ?>">
                                                        <i class="fas fa-eye"></i> Mark as Read
                                                    </button>
                                                    <button type="submit" name="status" value="replied" class="dropdown-item <?php echo $message['status'] === 'replied' ? 'active' : ''; ?>">
                                                        <i class="fas fa-reply"></i> Mark as Replied
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        <a href="/admin/deleteContactMessage/<?php echo $message['id']; ?>" 
                                           class="btn btn-danger" 
                                           onclick="return confirm('Are you sure you want to delete this message?')">
                                            <i class="fas fa-trash"></i> Delete
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </div>

    <!-- Reply Modal -->
    <div id="replyModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Reply to Message</h3>
                <button class="modal-close" id="closeModal">&times;</button>
            </div>
            <form id="replyForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="replyTo">To:</label>
                        <input type="email" id="replyTo" name="replyTo" readonly>
                    </div>
                    <div class="form-group">
                        <label for="replyName">Name:</label>
                        <input type="text" id="replyName" name="replyName" readonly>
                    </div>
                    <div class="form-group">
                        <label for="replySubject">Subject:</label>
                        <input type="text" id="replySubject" name="replySubject" required>
                    </div>
                    <div class="form-group">
                        <label for="replyMessage">Message:</label>
                        <textarea id="replyMessage" name="replyMessage" rows="6" required placeholder="Type your reply here..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="cancelReply">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="sendReply">
                        <span class="btn-text">
                            <i class="fas fa-paper-plane"></i> Send Reply
                        </span>
                        <span class="btn-loading" style="display: none;">
                            <i class="fas fa-spinner fa-spin"></i> Sending...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- EmailJS Integration -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>

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

        /* Alert Styles */
        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .alert-error {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #fca5a5;
        }

        /* Statistics Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 15px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: white;
        }

        .stat-card .stat-icon {
            background: var(--primary-color);
        }

        .stat-card.new .stat-icon {
            background: #f59e0b;
        }

        .stat-card.read .stat-icon {
            background: #3b82f6;
        }

        .stat-card.replied .stat-icon {
            background: #10b981;
        }

        .stat-content h3 {
            margin: 0;
            font-size: 1.8rem;
            color: var(--primary-color);
        }

        .stat-content p {
            margin: 0;
            color: #64748b;
            font-size: 0.9rem;
        }

        /* Filter Tabs */
        .filter-tabs {
            display: flex;
            gap: 8px;
            margin-bottom: 25px;
            flex-wrap: wrap;
        }

        .tab {
            padding: 10px 16px;
            background: white;
            color: #64748b;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
        }

        .tab:hover {
            background: #f1f5f9;
            color: var(--primary-color);
        }

        .tab.active {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        /* Messages Container */
        .messages-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #64748b;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 15px;
            color: #cbd5e1;
        }

        .empty-state h3 {
            margin: 0 0 10px 0;
            color: #475569;
        }

        .empty-state p {
            margin: 0;
        }

        /* Messages List */
        .messages-list {
            padding: 0;
        }

        .message-card {
            border-bottom: 1px solid #e2e8f0;
            padding: 20px;
            transition: background-color 0.3s ease;
        }

        .message-card:last-child {
            border-bottom: none;
        }

        .message-card:hover {
            background-color: #f8fafc;
        }

        .message-card.new {
            border-left: 4px solid #f59e0b;
        }

        .message-card.read {
            border-left: 4px solid #3b82f6;
        }

        .message-card.replied {
            border-left: 4px solid #10b981;
        }

        .message-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 15px;
            gap: 15px;
        }

        .message-info h4 {
            margin: 0 0 5px 0;
            color: var(--primary-color);
            font-size: 1.1rem;
        }

        .message-email {
            margin: 0 0 5px 0;
            color: #64748b;
            font-size: 0.9rem;
        }

        .message-subject {
            margin: 0;
            color: #475569;
            font-weight: 500;
            font-size: 0.95rem;
        }

        .message-meta {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 5px;
        }

        .message-date {
            color: #94a3b8;
            font-size: 0.8rem;
        }

        .message-status {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
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
            margin-bottom: 15px;
        }

        .message-content p {
            margin: 0;
            color: #475569;
            line-height: 1.5;
        }

        .message-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 12px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background: var(--secondary-color);
        }

        .btn-secondary {
            background: #e2e8f0;
            color: #475569;
        }

        .btn-secondary:hover {
            background: #cbd5e1;
        }

        .btn-danger {
            background: #ef4444;
            color: white;
        }

        .btn-danger:hover {
            background: #dc2626;
        }

        /* Status Dropdown */
        .status-dropdown {
            position: relative;
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            min-width: 180px;
            z-index: 1000;
            display: none;
        }

        .status-dropdown:hover .dropdown-menu {
            display: block;
        }

        .status-form {
            padding: 0;
        }

        .dropdown-item {
            width: 100%;
            padding: 10px 15px;
            background: none;
            border: none;
            text-align: left;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            color: #475569;
            font-size: 0.85rem;
            transition: background-color 0.3s ease;
        }

        .dropdown-item:hover {
            background: #f1f5f9;
        }

        .dropdown-item.active {
            background: #e0f2fe;
            color: var(--primary-color);
        }

        /* Tablet Styles */
        @media (min-width: 576px) {
            .container {
                padding: 0 20px;
            }

            .header-left h1 {
                font-size: 1.8rem;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
            }

            .message-header {
                flex-direction: row;
            }

            .message-meta {
                align-items: flex-end;
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

            .stats-grid {
                grid-template-columns: repeat(4, 1fr);
            }

            .filter-tabs {
                gap: 12px;
            }

            .tab {
                padding: 12px 20px;
            }
        }

        /* Large Desktop */
        @media (min-width: 1200px) {
            .message-actions {
                flex-wrap: nowrap;
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
        .tab:focus {
            outline: 2px solid var(--primary-color);
            outline-offset: 2px;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 10000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            animation: fadeIn 0.3s ease-out;
        }

        .modal.show {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            width: 90%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            animation: slideUp 0.3s ease-out;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 25px;
            border-bottom: 1px solid #e2e8f0;
        }

        .modal-header h3 {
            margin: 0;
            color: var(--primary-color);
            font-size: 1.3rem;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #64748b;
            cursor: pointer;
            padding: 5px;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .modal-close:hover {
            background: #f1f5f9;
            color: #475569;
        }

        .modal-body {
            padding: 25px;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            padding: 20px 25px;
            border-top: 1px solid #e2e8f0;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-weight: 500;
            color: #374151;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 0.9rem;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .form-group input[readonly] {
            background-color: #f9fafb;
            color: #6b7280;
        }

        .btn-loading {
            display: none;
            align-items: center;
            gap: 8px;
        }

        .btn:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Mobile Modal Adjustments */
        @media (max-width: 768px) {
            .modal-content {
                width: 95%;
                margin: 20px;
            }

            .modal-header,
            .modal-body,
            .modal-footer {
                padding: 15px 20px;
            }

            .modal-footer {
                flex-direction: column;
            }

            .modal-footer .btn {
                width: 100%;
            }
        }
    </style>

    <script>
        // Initialize EmailJS
        (function() {
            emailjs.init("9pDOJHmhrUQhpgEv8");
        })();

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

            // Reply modal functionality
            const replyModal = document.getElementById('replyModal');
            const replyForm = document.getElementById('replyForm');
            const closeModal = document.getElementById('closeModal');
            const cancelReply = document.getElementById('cancelReply');
            const sendReply = document.getElementById('sendReply');
            const replyBtns = document.querySelectorAll('.reply-btn');

            // Open reply modal
            replyBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const email = this.getAttribute('data-email');
                    const name = this.getAttribute('data-name');
                    const subject = this.getAttribute('data-subject');
                    
                    document.getElementById('replyTo').value = email;
                    document.getElementById('replyName').value = name;
                    document.getElementById('replySubject').value = 'Re: ' + (subject || 'Contact Form Message');
                    document.getElementById('replyMessage').value = '';
                    
                    replyModal.classList.add('show');
                });
            });

            // Close modal functions
            function closeReplyModal() {
                replyModal.classList.remove('show');
                replyForm.reset();
            }

            closeModal.addEventListener('click', closeReplyModal);
            cancelReply.addEventListener('click', closeReplyModal);

            // Close modal when clicking outside
            replyModal.addEventListener('click', function(e) {
                if (e.target === replyModal) {
                    closeReplyModal();
                }
            });

            // Handle reply form submission
            replyForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const btnText = sendReply.querySelector('.btn-text');
                const btnLoading = sendReply.querySelector('.btn-loading');
                
                // Show loading state
                sendReply.disabled = true;
                btnText.style.display = 'none';
                btnLoading.style.display = 'inline-flex';
                
                // Get form data
                const formData = new FormData(replyForm);
                const now = new Date();
                const date = now.toLocaleDateString();
                const time = now.toLocaleTimeString();
                
                const templateParams = {
                    from_name: 'Vaegarcon Admin',
                    from_email: 'info@vaegarcon.com',
                    to_name: formData.get('replyName'),
                    to_email: formData.get('replyTo'),
                    subject: formData.get('replySubject'),
                    message: formData.get('replyMessage'),
                    reply_to: 'info@vaegarcon.com',
                    date: date,
                    time: time
                };
                
                // Send email via EmailJS
                emailjs.send('service_eackrli', 'template_antaetp', templateParams)
                    .then(function(response) {
                        console.log('Reply sent successfully!', response.status, response.text);
                        
                        // Show success message
                        showAlert('Reply sent successfully!', 'success');
                        
                        // Close modal
                        closeReplyModal();
                        
                        // Update message status to replied
                        updateMessageStatus();
                        
                    }, function(error) {
                        console.error('Failed to send reply:', error);
                        showAlert('Failed to send reply. Please try again.', 'error');
                    })
                    .finally(function() {
                        // Reset button state
                        sendReply.disabled = false;
                        btnText.style.display = 'inline';
                        btnLoading.style.display = 'none';
                    });
            });

            function showAlert(message, type) {
                // Remove existing alerts
                const existingAlerts = document.querySelectorAll('.alert');
                existingAlerts.forEach(alert => alert.remove());
                
                // Create new alert
                const alertDiv = document.createElement('div');
                alertDiv.className = `alert alert-${type}`;
                alertDiv.textContent = message;
                
                // Insert at top of main content
                const main = document.querySelector('.admin-main .container');
                main.insertBefore(alertDiv, main.firstChild);
                
                // Auto-remove after 5 seconds
                setTimeout(() => {
                    alertDiv.remove();
                }, 5000);
            }

            function updateMessageStatus() {
                // This would typically update the message status to 'replied'
                // For now, we'll just refresh the page to show updated status
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            }
        });
    </script>
</body>
</html>
