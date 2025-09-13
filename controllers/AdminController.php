<?php
// Admin Controller for managing blog posts

require_once CONTROLLERS_PATH . '/BaseController.php';

class AdminController extends BaseController {
    
    private $blogModel;
    private $userModel;
    private $siteSettingsModel;
    
    public function __construct() {
        parent::__construct();
        
        // Check if user is logged in and is admin
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
            $this->redirect('/login');
        }
        
        $this->blogModel = $this->loadModel('BlogModel');
        $this->userModel = $this->loadModel('UserModel');
        $this->siteSettingsModel = $this->loadModel('SiteSettingsModel');
    }
    
    // Admin dashboard
    public function index() {
        $this->setData('pageTitle', 'Admin Dashboard - Vaegarcon');
        $this->render('admin/dashboard');
    }
    
    // Site Settings
    public function siteSettings() {
        $settings = $this->siteSettingsModel->getAllSettings();
        
        $this->setData('pageTitle', 'Site Settings - Vaegarcon');
        $this->setData('settings', $settings);
        $this->render('admin/site-settings');
    }
    
    // Update site settings
    public function updateSiteSettings() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $settings = $this->getPost();
            
            // Remove CSRF token if present
            if (isset($settings['csrf_token'])) {
                unset($settings['csrf_token']);
            }
            
            // Process logo upload if present
            if (isset($_FILES['site_logo']) && $_FILES['site_logo']['error'] === UPLOAD_ERR_OK) {
                $logoPath = $this->handleFileUpload('site_logo', 'img/site/');
                if ($logoPath) {
                    $this->siteSettingsModel->updateSetting('site_logo', $logoPath, 'appearance', 'Site Logo');
                }
            }
            
            // Update other settings
            foreach ($settings as $key => $value) {
                $this->siteSettingsModel->updateSetting($key, $value);
            }
            
            $this->redirect('/admin/siteSettings?success=Settings updated successfully');
        }
        
        $this->redirect('/admin/siteSettings');
    }
    
    // List all blog posts
    public function posts() {
        $posts = $this->blogModel->getAllPosts();
        
        $this->setData('pageTitle', 'Manage Blog Posts - Vaegarcon');
        $this->setData('posts', $posts);
        $this->render('admin/posts');
    }

    // Publish a post
    public function publish($id = null) {
        if (!$id) { $this->redirect('/admin/posts'); }
        $this->blogModel->setPostStatus((int)$id, 'published');
        $this->redirect('/admin/posts');
    }

    // Unpublish (move to draft)
    public function unpublish($id = null) {
        if (!$id) { $this->redirect('/admin/posts'); }
        $this->blogModel->setPostStatus((int)$id, 'draft');
        $this->redirect('/admin/posts');
    }
    
    // Create new blog post
    public function createPost() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $this->getPost('title');
            $excerpt = $this->getPost('excerpt');
            $content = $this->getPost('content');
            $status = $this->getPost('status');
            $categories = $this->getPost('categories', []);
            $tags = $this->getPost('tags');
            
            // Validate inputs
            $errors = [];
            
            if (empty($title)) {
                $errors['title'] = 'Title is required';
            }
            
            if (empty($content)) {
                $errors['content'] = 'Content is required';
            }
            
            if (empty($status)) {
                $errors['status'] = 'Status is required';
            }
            
            // If no errors, create the post
            if (empty($errors)) {
                $slug = $this->createSlug($title);
                
                $result = $this->blogModel->createPost([
                    'title' => $title,
                    'slug' => $slug,
                    'excerpt' => $excerpt,
                    'content' => $content,
                    'status' => $status,
                    'tags' => $tags,
                    'author_id' => $_SESSION['user_id'],
                    'categories' => $categories
                ]);
                
                if ($result) {
                    $this->redirect('/admin/posts?success=Post created successfully');
                } else {
                    $errors['general'] = 'Failed to create post';
                }
            }
            
            $this->setData('errors', $errors);
            $this->setData('formData', $_POST);
        }
        
        $categories = $this->blogModel->getAllCategories();
        
        $this->setData('pageTitle', 'Create New Post - Vaegarcon');
        $this->setData('categories', $categories);
        $this->render('admin/create-post');
    }
    
    // Edit blog post
    public function editPost($id = null) {
        if (!$id) {
            $this->redirect('/admin/posts');
        }
        
        $post = $this->blogModel->getPostById($id);
        
        if (!$post) {
            $this->redirect('/admin/posts?error=Post not found');
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $this->getPost('title');
            $excerpt = $this->getPost('excerpt');
            $content = $this->getPost('content');
            $status = $this->getPost('status');
            $categories = $this->getPost('categories', []);
            $tags = $this->getPost('tags');
            
            // Validate inputs
            $errors = [];
            
            if (empty($title)) {
                $errors['title'] = 'Title is required';
            }
            
            if (empty($content)) {
                $errors['content'] = 'Content is required';
            }
            
            if (empty($status)) {
                $errors['status'] = 'Status is required';
            }
            
            // If no errors, update the post
            if (empty($errors)) {
                $slug = $this->createSlug($title);
                
                $result = $this->blogModel->updatePost($id, [
                    'title' => $title,
                    'slug' => $slug,
                    'excerpt' => $excerpt,
                    'content' => $content,
                    'status' => $status,
                    'tags' => $tags,
                    'categories' => $categories
                ]);
                
                if ($result) {
                    $this->redirect('/admin/posts?success=Post updated successfully');
                } else {
                    $errors['general'] = 'Failed to update post';
                }
            }
            
            $this->setData('errors', $errors);
            $this->setData('formData', $_POST);
        } else {
            $this->setData('formData', $post);
        }
        
        $categories = $this->blogModel->getAllCategories();
        
        $this->setData('pageTitle', 'Edit Post - Vaegarcon');
        $this->setData('post', $post);
        $this->setData('categories', $categories);
        $this->render('admin/edit-post');
    }
    
    // Delete blog post
    public function deletePost($id = null) {
        if (!$id) {
            $this->redirect('/admin/posts');
        }
        
        $result = $this->blogModel->deletePost($id);
        
        if ($result) {
            $this->redirect('/admin/posts?success=Post deleted successfully');
        } else {
            $this->redirect('/admin/posts?error=Failed to delete post');
        }
    }
    
    // Hero Images Management
    public function heroImages() {
        $heroImages = $this->siteSettingsModel->getAllHeroImages();
        
        $this->setData('pageTitle', 'Manage Hero Images - Vaegarcon');
        $this->setData('heroImages', $heroImages);
        $this->render('admin/hero-images');
    }
    
    // Add Hero Image
    public function addHeroImage() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $this->getPost('title');
            $description = $this->getPost('description');
            $buttonText = $this->getPost('button_text');
            $buttonLink = $this->getPost('button_link');
            $active = $this->getPost('active', 0);
            $displayOrder = $this->getPost('display_order', 0);
            
            // Validate inputs
            $errors = [];
            
            if (empty($title)) {
                $errors['title'] = 'Title is required';
            }
            
            // Check if image was uploaded
            if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
                $errors['image'] = 'Image is required';
            }
            
            // If no errors, create the hero image
            if (empty($errors)) {
                $imagePath = $this->handleFileUpload('image', 'img/hero/');
                
                if ($imagePath) {
                    $result = $this->siteSettingsModel->createHeroImage([
                        'title' => $title,
                        'image_path' => $imagePath,
                        'description' => $description,
                        'button_text' => $buttonText,
                        'button_link' => $buttonLink,
                        'active' => $active ? 1 : 0,
                        'display_order' => (int)$displayOrder
                    ]);
                    
                    if ($result) {
                        $this->redirect('/admin/heroImages?success=Hero image added successfully');
                    } else {
                        $errors['general'] = 'Failed to add hero image';
                    }
                } else {
                    $errors['image'] = 'Failed to upload image';
                }
            }
            
            $this->setData('errors', $errors);
            $this->setData('formData', $_POST);
        }
        
        $this->setData('pageTitle', 'Add Hero Image - Vaegarcon');
        $this->render('admin/add-hero-image');
    }
    
    // Edit Hero Image
    public function editHeroImage($id = null) {
        if (!$id) {
            $this->redirect('/admin/heroImages');
        }
        
        $heroImage = $this->siteSettingsModel->getHeroImageById($id);
        
        if (!$heroImage) {
            $this->redirect('/admin/heroImages?error=Hero image not found');
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $this->getPost('title');
            $description = $this->getPost('description');
            $buttonText = $this->getPost('button_text');
            $buttonLink = $this->getPost('button_link');
            $active = $this->getPost('active', 0);
            $displayOrder = $this->getPost('display_order', 0);
            
            // Validate inputs
            $errors = [];
            
            if (empty($title)) {
                $errors['title'] = 'Title is required';
            }
            
            // Prepare update data
            $updateData = [
                'title' => $title,
                'description' => $description,
                'button_text' => $buttonText,
                'button_link' => $buttonLink,
                'active' => $active ? 1 : 0,
                'display_order' => (int)$displayOrder,
                'image_path' => $heroImage['image_path'] // Default to existing image
            ];
            
            // Check if a new image was uploaded
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $imagePath = $this->handleFileUpload('image', 'img/hero/');
                
                if ($imagePath) {
                    $updateData['image_path'] = $imagePath;
                    
                    // Delete old image if it exists and is not the default
                    if (!empty($heroImage['image_path']) && file_exists(BASE_PATH . '/' . $heroImage['image_path'])) {
                @unlink(BASE_PATH . '/' . $heroImage['image_path']);
                    }
                } else {
                    $errors['image'] = 'Failed to upload image';
                }
            }
            
            // If no errors, update the hero image
            if (empty($errors)) {
                $result = $this->siteSettingsModel->updateHeroImage($id, $updateData);
                
                if ($result) {
                    $this->redirect('/admin/heroImages?success=Hero image updated successfully');
                } else {
                    $errors['general'] = 'Failed to update hero image';
                }
            }
            
            $this->setData('errors', $errors);
            $this->setData('formData', $_POST);
        } else {
            $this->setData('formData', $heroImage);
        }
        
        $this->setData('pageTitle', 'Edit Hero Image - Vaegarcon');
        $this->setData('heroImage', $heroImage);
        $this->render('admin/edit-hero-image');
    }
    
    // Delete Hero Image
    public function deleteHeroImage($id = null) {
        if (!$id) {
            $this->redirect('/admin/heroImages');
        }
        
        $heroImage = $this->siteSettingsModel->getHeroImageById($id);
        
        if ($heroImage) {
            // Delete the image file if it exists
            if (!empty($heroImage['image_path']) && file_exists(BASE_PATH . '/' . $heroImage['image_path'])) {
                @unlink(BASE_PATH . '/' . $heroImage['image_path']);
            }
            
            $result = $this->siteSettingsModel->deleteHeroImage($id);
            
            if ($result) {
                $this->redirect('/admin/heroImages?success=Hero image deleted successfully');
            } else {
                $this->redirect('/admin/heroImages?error=Failed to delete hero image');
            }
        } else {
            $this->redirect('/admin/heroImages?error=Hero image not found');
        }
    }
    
    // Toggle Hero Image Status
    public function toggleHeroImageStatus($id = null) {
        if (!$id) {
            $this->redirect('/admin/heroImages');
        }
        
        $heroImage = $this->siteSettingsModel->getHeroImageById($id);
        
        if ($heroImage) {
            $newStatus = $heroImage['active'] ? 0 : 1;
            $result = $this->siteSettingsModel->updateHeroImageStatus($id, $newStatus);
            
            if ($result) {
                $statusText = $newStatus ? 'activated' : 'deactivated';
                $this->redirect("/admin/heroImages?success=Hero image {$statusText} successfully");
            } else {
                $this->redirect('/admin/heroImages?error=Failed to update hero image status');
            }
        } else {
            $this->redirect('/admin/heroImages?error=Hero image not found');
        }
    }
    
    // Handle file upload
    private function handleFileUpload($fileInputName, $targetDir) {
        // Create target directory if it doesn't exist
        $targetDirPath = BASE_PATH . '/' . $targetDir;
        if (!file_exists($targetDirPath)) {
            mkdir($targetDirPath, 0755, true);
        }
        
        $fileName = basename($_FILES[$fileInputName]['name']);
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        
        // Generate unique filename
        $uniqueName = uniqid() . '_' . bin2hex(random_bytes(8)) . '.' . $fileExt;
        $targetFilePath = $targetDir . $uniqueName;
        
        // Check if file is an actual image
        $check = getimagesize($_FILES[$fileInputName]['tmp_name']);
        if ($check === false) {
            return false;
        }
        
        // Check file size (limit to 5MB)
        if ($_FILES[$fileInputName]['size'] > 5000000) {
            return false;
        }
        
        // Allow certain file formats
        $allowedFormats = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'];
        if (!in_array($fileExt, $allowedFormats)) {
            return false;
        }
        
        // Upload file
        if (move_uploaded_file($_FILES[$fileInputName]['tmp_name'], BASE_PATH . '/' . $targetFilePath)) {
            return $targetFilePath;
        }
        
        return false;
    }
    
    // List all users
    public function users() {
        $users = $this->userModel->getAllUsers();
        
        $this->setData('pageTitle', 'Manage Users - Vaegarcon');
        $this->setData('users', $users);
        $this->render('admin/users');
    }
    
    // Create new user
    public function createUser() {
        // CSRF token
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        $this->setData('csrfToken', $_SESSION['csrf_token']);
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $this->getPost('csrf_token');
            if (!$token || !hash_equals($_SESSION['csrf_token'], $token)) {
                $this->setData('error', 'Invalid CSRF token.');
                $this->render('admin/create-user');
                return;
            }

            $username = trim($this->getPost('username'));
            $email = trim($this->getPost('email'));
            $password = $this->getPost('password');
            $confirm = $this->getPost('confirm_password');
            $role = $this->getPost('role');

            $errors = [];
            if ($username === '' || !preg_match('/^[a-zA-Z0-9_\-\.]{3,}$/', $username)) {
                $errors['username'] = 'Username must be at least 3 characters (letters, numbers, _ . -)';
            }
            if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Valid email is required';
            }
            if (strlen($password) < 8) {
                $errors['password'] = 'Password must be at least 8 characters';
            }
            if ($password !== $confirm) {
                $errors['confirm_password'] = 'Passwords do not match';
            }
            if (!in_array($role, ['admin', 'user'])) {
                $errors['role'] = 'Invalid role selected';
            }
            if ($this->userModel->getUserByUsername($username)) {
                $errors['username'] = 'Username already taken';
            }
            if ($this->userModel->getUserByEmail($email)) {
                $errors['email'] = 'Email already in use';
            }

            if (empty($errors)) {
                $hash = password_hash($password, PASSWORD_BCRYPT);
                $created = $this->userModel->createUser($username, $email, $hash, $role);
                if ($created) {
                    unset($_SESSION['csrf_token']);
                    $this->redirect('/admin/users?success=User created successfully');
                } else {
                    $this->setData('error', 'Failed to create user.');
                }
            } else {
                $this->setData('errors', $errors);
            }

            $this->setData('formData', [ 'username' => $username, 'email' => $email, 'role' => $role ]);
        }

        $this->setData('pageTitle', 'Create New User - Vaegarcon');
        $this->render('admin/create-user');
    }
    
    // Edit user
    public function editUser($id = null) {
        if (!$id) {
            $this->redirect('/admin/users');
        }
        
        $user = $this->userModel->getUserById($id);
        if (!$user) {
            $this->redirect('/admin/users?error=User not found');
        }
        
        // CSRF token
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        $this->setData('csrfToken', $_SESSION['csrf_token']);
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $this->getPost('csrf_token');
            if (!$token || !hash_equals($_SESSION['csrf_token'], $token)) {
                $this->setData('error', 'Invalid CSRF token.');
                $this->render('admin/edit-user');
                return;
            }

            $username = trim($this->getPost('username'));
            $email = trim($this->getPost('email'));
            $password = $this->getPost('password');
            $confirm = $this->getPost('confirm_password');
            $role = $this->getPost('role');
            $status = $this->getPost('status');

            $errors = [];
            if ($username === '' || !preg_match('/^[a-zA-Z0-9_\-\.]{3,}$/', $username)) {
                $errors['username'] = 'Username must be at least 3 characters (letters, numbers, _ . -)';
            }
            if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Valid email is required';
            }
            if (!empty($password) && strlen($password) < 8) {
                $errors['password'] = 'Password must be at least 8 characters';
            }
            if (!empty($password) && $password !== $confirm) {
                $errors['confirm_password'] = 'Passwords do not match';
            }
            if (!in_array($role, ['admin', 'user'])) {
                $errors['role'] = 'Invalid role selected';
            }
            if (!in_array($status, ['active', 'inactive'])) {
                $errors['status'] = 'Invalid status selected';
            }
            
            // Check if username/email is taken by another user
            $existingUser = $this->userModel->getUserByUsername($username);
            if ($existingUser && $existingUser['id'] != $id) {
                $errors['username'] = 'Username already taken';
            }
            $existingUser = $this->userModel->getUserByEmail($email);
            if ($existingUser && $existingUser['id'] != $id) {
                $errors['email'] = 'Email already in use';
            }

            if (empty($errors)) {
                $updateData = [
                    'username' => $username,
                    'email' => $email,
                    'role' => $role,
                    'status' => $status
                ];
                
                if (!empty($password)) {
                    $updateData['password'] = password_hash($password, PASSWORD_BCRYPT);
                }
                
                $updated = $this->userModel->updateUser($id, $updateData);
                if ($updated) {
                    unset($_SESSION['csrf_token']);
                    $this->redirect('/admin/users?success=User updated successfully');
                } else {
                    $this->setData('error', 'Failed to update user.');
                }
            } else {
                $this->setData('errors', $errors);
            }

            $this->setData('formData', $_POST);
        } else {
            $this->setData('formData', $user);
        }

        $this->setData('pageTitle', 'Edit User - Vaegarcon');
        $this->setData('user', $user);
        $this->render('admin/edit-user');
    }
    
    // Delete user
    public function deleteUser($id = null) {
        if (!$id) {
            $this->redirect('/admin/users');
        }
        
        // Prevent deleting yourself
        if ($id == $_SESSION['user_id']) {
            $this->redirect('/admin/users?error=Cannot delete your own account');
        }
        
        $result = $this->userModel->deleteUser($id);
        
        if ($result) {
            $this->redirect('/admin/users?success=User deleted successfully');
        } else {
            $this->redirect('/admin/users?error=Failed to delete user');
        }
    }

    // Create URL slug from title
    private function createSlug($title) {
        $slug = strtolower(trim($title));
        $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
        $slug = preg_replace('/-+/', '-', $slug);
        $slug = trim($slug, '-');
        
        return $slug;
    }
}
?>