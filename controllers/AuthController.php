<?php
require_once CONTROLLERS_PATH . '/BaseController.php';

class AuthController extends BaseController {
	public function __construct() {
		parent::__construct();
	}

	public function login() {
		$this->setData('pageTitle', 'Admin Login - Vaegarcon');

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$username = trim($this->getPost('username'));
			$password = $this->getPost('password');

			$errors = [];
			if ($username === '') { $errors['username'] = 'Username is required'; }
			if ($password === '') { $errors['password'] = 'Password is required'; }

			if (empty($errors)) {
				$userModel = $this->loadModel('UserModel');
				$user = $userModel->getUserByUsername($username);

				if ($user && password_verify($password, $user['password'])) {
					if ($user['status'] !== 'active') {
						$errors['general'] = 'Account is inactive.';
					} else {
						$_SESSION['user_id'] = (int)$user['id'];
						$_SESSION['user_role'] = $user['role'];
						$_SESSION['username'] = $user['username'];
						$userModel->updateLastLogin((int)$user['id']);
						$this->redirect('/admin');
					}
				} else {
					$errors['general'] = 'Invalid username or password';
				}
			}

			$this->setData('errors', $errors);
			$this->setData('formData', ['username' => $username]);
		}

		$this->render('auth/login');
	}

	public function logout() {
		session_destroy();
		$this->redirect('/login');
	}
}
?>
