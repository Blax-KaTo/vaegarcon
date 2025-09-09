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
                        <h1>User Management</h1>
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
                    <a href="/admin/users" class="active">
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
                        <i class="fas fa-check-circle"></i>
                        <?php echo htmlspecialchars($_GET['success']); ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($_GET['error'])): ?>
                    <div class="alert alert-error">
                        <i class="fas fa-exclamation-triangle"></i>
                        <?php echo htmlspecialchars($_GET['error']); ?>
                    </div>
                <?php endif; ?>

                <div class="admin-actions">
                    <a href="/admin/createUser" class="btn-primary">
                        <i class="fas fa-user-plus"></i>
                        Create New User
                    </a>
                </div>

                <div class="users-table-container">
                    <table class="users-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>Last Login</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($users)): ?>
                                <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($user['id']); ?></td>
                                        <td>
                                            <div class="user-info">
                                                <i class="fas fa-user"></i>
                                                <?php echo htmlspecialchars($user['username']); ?>
                                            </div>
                                        </td>
                                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                                        <td>
                                            <span class="role-badge role-<?php echo $user['role']; ?>">
                                                <?php echo ucfirst($user['role']); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="status-badge status-<?php echo $user['status']; ?>">
                                                <?php echo ucfirst($user['status']); ?>
                                            </span>
                                        </td>
                                        <td><?php echo date('M j, Y', strtotime($user['created_at'])); ?></td>
                                        <td>
                                            <?php if ($user['last_login']): ?>
                                                <?php echo date('M j, Y g:i A', strtotime($user['last_login'])); ?>
                                            <?php else: ?>
                                                <span class="text-muted">Never</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="action-buttons">
                                                <a href="/admin/editUser/<?php echo $user['id']; ?>" class="btn-edit" title="Edit User">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <?php if ($user['id'] != $_SESSION['user_id']): ?>
                                                    <a href="/admin/deleteUser/<?php echo $user['id']; ?>" 
                                                       class="btn-delete" 
                                                       title="Delete User"
                                                       onclick="return confirm('Are you sure you want to delete this user?')">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="no-data">
                                        <i class="fas fa-users"></i>
                                        <p>No users found</p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
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

        .alert {
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.9rem;
        }

        .alert-success {
            background: #f0f9ff;
            color: #0369a1;
            border: 1px solid #bae6fd;
        }

        .alert-error {
            background: #fdf2f2;
            color: #e74c3c;
            border: 1px solid #fecaca;
        }

        .admin-actions {
            margin-bottom: 20px;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--primary-color);
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .btn-primary:hover {
            background: var(--secondary-color);
            transform: translateY(-1px);
        }

        /* Table Styles */
        .users-table-container {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .users-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
        }

        .users-table th,
        .users-table td {
            padding: 10px 8px;
            text-align: left;
            border-bottom: 1px solid #e1e5e9;
        }

        .users-table th {
            background: #f8fafc;
            font-weight: 600;
            color: var(--primary-color);
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .user-info i {
            font-size: 0.8rem;
            color: #64748b;
        }

        .role-badge,
        .status-badge {
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .role-admin {
            background: #fef3c7;
            color: #d97706;
        }

        .role-user {
            background: #e0f2fe;
            color: #0277bd;
        }

        .status-active {
            background: #dcfce7;
            color: #16a34a;
        }

        .status-inactive {
            background: #fee2e2;
            color: #dc2626;
        }

        .text-muted {
            color: #9ca3af;
            font-size: 0.8rem;
        }

        .action-buttons {
            display: flex;
            gap: 4px;
        }

        .btn-edit,
        .btn-delete {
            padding: 6px 8px;
            border-radius: 6px;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 0.8rem;
        }

        .btn-edit {
            background: #e0f2fe;
            color: #0277bd;
        }

        .btn-edit:hover {
            background: #0277bd;
            color: white;
        }

        .btn-delete {
            background: #fee2e2;
            color: #dc2626;
        }

        .btn-delete:hover {
            background: #dc2626;
            color: white;
        }

        .no-data {
            text-align: center;
            padding: 40px 20px;
            color: #9ca3af;
        }

        .no-data i {
            font-size: 2rem;
            margin-bottom: 10px;
            display: block;
        }

        .no-data p {
            margin: 0;
            font-size: 0.9rem;
        }

        /* Mobile table scroll */
        @media (max-width: 767px) {
            .users-table-container {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
            
            .users-table {
                min-width: 700px;
            }

            .users-table th,
            .users-table td {
                white-space: nowrap;
            }

            /* Hide less important columns on very small screens */
            .users-table th:nth-child(1),
            .users-table td:nth-child(1),
            .users-table th:nth-child(6),
            .users-table td:nth-child(6),
            .users-table th:nth-child(7),
            .users-table td:nth-child(7) {
                display: none;
            }
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

            .alert {
                padding: 15px;
                font-size: 1rem;
            }

            .users-table {
                font-size: 0.9rem;
            }

            .users-table th,
            .users-table td {
                padding: 12px 10px;
            }

            .btn-primary {
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

            .admin-actions {
                margin-bottom: 30px;
            }

            .users-table {
                font-size: 1rem;
            }

            .users-table th,
            .users-table td {
                padding: 15px 12px;
            }

            .users-table th:nth-child(1),
            .users-table td:nth-child(1),
            .users-table th:nth-child(6),
            .users-table td:nth-child(6),
            .users-table th:nth-child(7),
            .users-table td:nth-child(7) {
                display: table-cell;
            }

            .action-buttons {
                gap: 8px;
            }

            .btn-edit,
            .btn-delete {
                padding: 8px 10px;
                font-size: 0.9rem;
            }
        }

        /* Large Desktop */
        @media (min-width: 1200px) {
            .users-table th,
            .users-table td {
                padding: 15px;
            }
        }

        /* Focus styles for keyboard navigation */
        .admin-nav a:focus,
        .btn-primary:focus,
        .btn-edit:focus,
        .btn-delete:focus,
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