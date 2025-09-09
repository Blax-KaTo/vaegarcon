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
                        <h1>Hero Images</h1>
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
                    <a href="/admin/heroImages" class="active">
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

                <div class="admin-actions">
                    <a href="#" class="btn-primary" id="addHeroImageBtn">
                        <i class="fas fa-plus"></i> Add New Hero Image
                    </a>
                </div>

                <!-- Add Hero Image Modal -->
                <div class="modal" id="addHeroImageModal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2>Add New Hero Image</h2>
                            <button class="close-modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form action="/admin/addHeroImage" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" id="title" name="title" required>
                                </div>
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" id="image" name="image" accept="image/*" required>
                                    <small>Recommended size: 1920x800 pixels. Supported formats: JPG, PNG, GIF.</small>
                                </div>
                                <div class="form-group">
                                    <label for="display_order">Display Order</label>
                                    <input type="number" id="display_order" name="display_order" min="1" value="1">
                                    <small>Lower numbers will be displayed first.</small>
                                </div>
                                <div class="form-group">
                                    <label class="checkbox-label">
                                        <input type="checkbox" name="is_active" checked>
                                        <span>Active</span>
                                    </label>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn-primary">
                                        <i class="fas fa-save"></i> Save Image
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Edit Hero Image Modal -->
                <div class="modal" id="editHeroImageModal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2>Edit Hero Image</h2>
                            <button class="close-modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form action="/admin/editHeroImage" method="post" enctype="multipart/form-data">
                                <input type="hidden" id="edit_id" name="id">
                                <div class="form-group">
                                    <label for="edit_title">Title</label>
                                    <input type="text" id="edit_title" name="title" required>
                                </div>
                                <div class="form-group">
                                    <label>Current Image</label>
                                    <div class="current-image">
                                        <img id="current_image_preview" src="" alt="Current Hero Image">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="edit_image">Replace Image</label>
                                    <input type="file" id="edit_image" name="image" accept="image/*">
                                    <small>Leave empty to keep current image. Recommended size: 1920x800 pixels.</small>
                                </div>
                                <div class="form-group">
                                    <label for="edit_display_order">Display Order</label>
                                    <input type="number" id="edit_display_order" name="display_order" min="1">
                                    <small>Lower numbers will be displayed first.</small>
                                </div>
                                <div class="form-group">
                                    <label class="checkbox-label">
                                        <input type="checkbox" id="edit_is_active" name="is_active">
                                        <span>Active</span>
                                    </label>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn-primary">
                                        <i class="fas fa-save"></i> Update Image
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Hero Images List -->
                <div class="admin-table-container">
                    <?php if (empty($heroImages)): ?>
                        <div class="empty-state">
                            <i class="fas fa-images"></i>
                            <h2>No Hero Images Found</h2>
                            <p>Add your first hero image to display on your homepage.</p>
                        </div>
                    <?php else: ?>
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Order</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($heroImages as $image): ?>
                                    <tr>
                                        <td class="image-cell">
                                            <img src="/<?php echo htmlspecialchars($image['image_path']); ?>" alt="<?php echo htmlspecialchars($image['title']); ?>">
                                        </td>
                                        <td><?php echo htmlspecialchars($image['title']); ?></td>
                                        <td><?php echo htmlspecialchars($image['display_order']); ?></td>
                                        <td>
                                            <span class="status-badge <?php echo $image['is_active'] ? 'active' : 'inactive'; ?>">
                                                <?php echo $image['is_active'] ? 'Active' : 'Inactive'; ?>
                                            </span>
                                        </td>
                                        <td class="actions-cell">
                                            <a href="#" class="btn-icon edit-hero-image" data-id="<?php echo $image['id']; ?>" data-title="<?php echo htmlspecialchars($image['title']); ?>" data-image="<?php echo htmlspecialchars($image['image_path']); ?>" data-order="<?php echo $image['display_order']; ?>" data-active="<?php echo $image['is_active']; ?>">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="/admin/toggleHeroImageStatus/<?php echo $image['id']; ?>" class="btn-icon toggle-status" title="<?php echo $image['is_active'] ? 'Deactivate' : 'Activate'; ?>">
                                                <i class="fas <?php echo $image['is_active'] ? 'fa-eye-slash' : 'fa-eye'; ?>"></i>
                                            </a>
                                            <a href="#" class="btn-icon delete-hero-image" data-id="<?php echo $image['id']; ?>" data-title="<?php echo htmlspecialchars($image['title']); ?>">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>

                <!-- Delete Confirmation Modal -->
                <div class="modal" id="deleteConfirmModal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2>Confirm Deletion</h2>
                            <button class="close-modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete the hero image <strong id="deleteImageTitle"></strong>?</p>
                            <p class="warning">This action cannot be undone.</p>
                            <div class="form-actions">
                                <a href="#" id="confirmDeleteBtn" class="btn-danger">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </a>
                                <button class="btn-secondary close-modal">
                                    <i class="fas fa-times"></i> Cancel
                                </button>
                            </div>
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

        /* Admin Actions */
        .admin-actions {
            margin-bottom: 20px;
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

        .btn-secondary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #e2e8f0;
            color: #334155;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            font-size: 1rem;
            border: none;
            cursor: pointer;
        }

        .btn-secondary:hover {
            background: #cbd5e1;
        }

        .btn-danger {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #ef4444;
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

        .btn-danger:hover {
            background: #dc2626;
        }

        .btn-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 8px;
            color: #64748b;
            text-decoration: none;
            transition: all 0.3s ease;
            background: #f1f5f9;
        }

        .btn-icon:hover {
            background: var(--primary-color);
            color: white;
        }

        .btn-icon.toggle-status:hover {
            background: #eab308;
        }

        .btn-icon.delete-hero-image:hover {
            background: #ef4444;
        }

        /* Table Styles */
        .admin-table-container {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            overflow-x: auto;
        }

        .admin-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.95rem;
        }

        .admin-table th {
            text-align: left;
            padding: 15px 10px;
            border-bottom: 2px solid #e2e8f0;
            color: #334155;
            font-weight: 600;
        }

        .admin-table td {
            padding: 15px 10px;
            border-bottom: 1px solid #e2e8f0;
            color: #475569;
        }

        .admin-table tr:last-child td {
            border-bottom: none;
        }

        .admin-table .image-cell {
            width: 120px;
        }

        .admin-table .image-cell img {
            width: 100%;
            height: 60px;
            object-fit: cover;
            border-radius: 6px;
        }

        .admin-table .actions-cell {
            display: flex;
            gap: 8px;
            justify-content: flex-end;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .status-badge.active {
            background-color: #dcfce7;
            color: #166534;
        }

        .status-badge.inactive {
            background-color: #f1f5f9;
            color: #64748b;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #64748b;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 15px;
            color: #cbd5e1;
        }

        .empty-state h2 {
            margin-bottom: 10px;
            color: #334155;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1100;
            overflow-y: auto;
            padding: 20px;
        }

        .modal-content {
            background-color: white;
            border-radius: 15px;
            max-width: 600px;
            margin: 40px auto;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            position: relative;
        }

        .modal-header {
            padding: 20px 25px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h2 {
            margin: 0;
            color: var(--primary-color);
            font-size: 1.5rem;
        }

        .close-modal {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #64748b;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .close-modal:hover {
            color: #ef4444;
        }

        .modal-body {
            padding: 25px;
        }

        /* Form Styles */
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
        .form-group input[type="number"] {
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

        .form-group input:focus {
            border-color: var(--primary-color);
            outline: none;
        }

        .form-group small {
            display: block;
            margin-top: 5px;
            color: #64748b;
            font-size: 0.8rem;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
        }

        .checkbox-label input[type="checkbox"] {
            width: 18px;
            height: 18px;
        }

        .current-image {
            margin-top: 10px;
            padding: 15px;
            background: #f8fafc;
            border-radius: 8px;
            text-align: center;
        }

        .current-image img {
            max-width: 100%;
            max-height: 200px;
            border-radius: 6px;
        }

        .form-actions {
            margin-top: 30px;
            display: flex;
            justify-content: flex-end;
            gap: 15px;
        }

        .warning {
            color: #ef4444;
            font-weight: 500;
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

            .admin-table-container {
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

            .admin-table-container {
                padding: 35px;
            }

            .form-group {
                margin-bottom: 25px;
            }
        }

        /* Large Desktop */
        @media (min-width: 1200px) {
            .admin-table-container {
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
        .btn-secondary:focus,
        .btn-danger:focus,
        .btn-icon:focus,
        .mobile-menu-toggle:focus,
        input:focus {
            outline: 2px solid var(--primary-color);
            outline-offset: 2px;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile menu toggle functionality
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

            // Modal functionality
            const modals = document.querySelectorAll('.modal');
            const modalTriggers = {
                'addHeroImageBtn': 'addHeroImageModal',
                'editHeroImageBtns': 'editHeroImageModal',
                'deleteHeroImageBtns': 'deleteConfirmModal'
            };

            // Close modal function
            function closeAllModals() {
                modals.forEach(modal => {
                    modal.style.display = 'none';
                });
                document.body.style.overflow = 'auto';
            }

            // Close buttons
            const closeButtons = document.querySelectorAll('.close-modal');
            closeButtons.forEach(button => {
                button.addEventListener('click', closeAllModals);
            });

            // Close when clicking outside modal content
            modals.forEach(modal => {
                modal.addEventListener('click', function(event) {
                    if (event.target === modal) {
                        closeAllModals();
                    }
                });
            });

            // Close on escape key
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    closeAllModals();
                }
            });

            // Add Hero Image button
            const addHeroImageBtn = document.getElementById('addHeroImageBtn');
            if (addHeroImageBtn) {
                addHeroImageBtn.addEventListener('click', function(event) {
                    event.preventDefault();
                    document.getElementById('addHeroImageModal').style.display = 'block';
                    document.body.style.overflow = 'hidden';
                });
            }

            // Edit Hero Image buttons
            const editButtons = document.querySelectorAll('.edit-hero-image');
            editButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const id = this.getAttribute('data-id');
                    const title = this.getAttribute('data-title');
                    const image = this.getAttribute('data-image');
                    const order = this.getAttribute('data-order');
                    const active = this.getAttribute('data-active') === '1';

                    // Populate the edit form
                    document.getElementById('edit_id').value = id;
                    document.getElementById('edit_title').value = title;
                    document.getElementById('current_image_preview').src = '/' + image;
                    document.getElementById('edit_display_order').value = order;
                    document.getElementById('edit_is_active').checked = active;

                    // Show the modal
                    document.getElementById('editHeroImageModal').style.display = 'block';
                    document.body.style.overflow = 'hidden';
                });
            });

            // Delete Hero Image buttons
            const deleteButtons = document.querySelectorAll('.delete-hero-image');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const id = this.getAttribute('data-id');
                    const title = this.getAttribute('data-title');

                    // Set the confirmation message
                    document.getElementById('deleteImageTitle').textContent = title;
                    
                    // Set the confirm delete button href
                    document.getElementById('confirmDeleteBtn').href = '/admin/deleteHeroImage/' + id;

                    // Show the modal
                    document.getElementById('deleteConfirmModal').style.display = 'block';
                    document.body.style.overflow = 'hidden';
                });
            });
        });
    </script>
</body>
</html>