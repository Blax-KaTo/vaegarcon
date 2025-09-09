<?php
require_once CONTROLLERS_PATH . '/BaseController.php';

class SetupController extends BaseController {
	public function __construct() {
		parent::__construct();
	}

	public function admin() {
		$this->setData('pageTitle', 'Create Admin - Vaegarcon');

		// Simple lock: if an admin exists and not logged in as admin, block creating more via public setup
		$userModel = $this->loadModel('UserModel');
		if ($userModel->getAdminCount() > 0 && (empty($_SESSION['user_id']) || ($_SESSION['user_role'] ?? '') !== 'admin')) {
			$this->setData('error', 'Admin already exists. Please login or contact an administrator.');
			$this->render('setup/admin');
			return;
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
				$this->render('setup/admin');
				return;
			}

			$username = trim($this->getPost('username'));
			$email = trim($this->getPost('email'));
			$password = $this->getPost('password');
			$confirm = $this->getPost('confirm_password');

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
			if ($userModel->getUserByUsername($username)) {
				$errors['username'] = 'Username already taken';
			}
			if ($userModel->getUserByEmail($email)) {
				$errors['email'] = 'Email already in use';
			}

			if (empty($errors)) {
				$hash = password_hash($password, PASSWORD_BCRYPT);
				$created = $userModel->createUser($username, $email, $hash, 'admin');
				if ($created) {
					unset($_SESSION['csrf_token']);
					$this->redirect('/login');
				} else {
					$this->setData('error', 'Failed to create admin.');
				}
			} else {
				$this->setData('errors', $errors);
			}

			$this->setData('formData', [ 'username' => $username, 'email' => $email ]);
		}

		$this->render('setup/admin');
	}
}
?>
