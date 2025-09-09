<?php
// User Model for authentication and admin management

class UserModel {
	private $db;

	public function __construct($db) {
		$this->db = $db;
	}

	public function getUserByUsername($username) {
		$sql = "SELECT * FROM users WHERE username = ? LIMIT 1";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->fetch_assoc();
	}

	public function getUserByEmail($email) {
		$sql = "SELECT * FROM users WHERE email = ? LIMIT 1";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("s", $email);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->fetch_assoc();
	}

	public function getAdminCount() {
		$sql = "SELECT COUNT(*) AS c FROM users WHERE role = 'admin'";
		$res = $this->db->query($sql);
		$row = $res->fetch_assoc();
		return (int)$row['c'];
	}

	public function createUser($username, $email, $passwordHash, $role = 'admin') {
		$sql = "INSERT INTO users (username, password, email, role, created_at, status) VALUES (?, ?, ?, ?, NOW(), 'active')";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("ssss", $username, $passwordHash, $email, $role);
		return $stmt->execute();
	}

	public function updateLastLogin($userId) {
		$sql = "UPDATE users SET last_login = NOW() WHERE id = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("i", $userId);
		return $stmt->execute();
	}

	public function getAllUsers() {
		$sql = "SELECT id, username, email, role, status, created_at, last_login FROM users ORDER BY created_at DESC";
		$result = $this->db->query($sql);
		return $result->fetch_all(MYSQLI_ASSOC);
	}

	public function getUserById($id) {
		$sql = "SELECT * FROM users WHERE id = ? LIMIT 1";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->fetch_assoc();
	}

	public function updateUser($id, $data) {
		$fields = [];
		$values = [];
		$types = '';

		foreach ($data as $field => $value) {
			$fields[] = "$field = ?";
			$values[] = $value;
			$types .= 's';
		}

		$sql = "UPDATE users SET " . implode(', ', $fields) . " WHERE id = ?";
		$values[] = $id;
		$types .= 'i';

		$stmt = $this->db->prepare($sql);
		$stmt->bind_param($types, ...$values);
		return $stmt->execute();
	}

	public function deleteUser($id) {
		$sql = "DELETE FROM users WHERE id = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->bind_param("i", $id);
		return $stmt->execute();
	}
}
?>
