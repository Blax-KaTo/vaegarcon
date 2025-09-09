<?php
// Contact Model for handling contact form submissions

class ContactModel {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }
    
    // Save contact message to database
    public function saveMessage($name, $email, $subject, $message) {
        // Sanitize inputs
        $name = $this->db->real_escape_string($name);
        $email = $this->db->real_escape_string($email);
        $subject = $this->db->real_escape_string($subject);
        $message = $this->db->real_escape_string($message);
        $created_at = date('Y-m-d H:i:s');
        
        // Prepare SQL statement
        $sql = "INSERT INTO contact_messages (name, email, subject, message, created_at) 
                VALUES ('$name', '$email', '$subject', '$message', '$created_at')";
        
        // Execute query
        $result = $this->db->query($sql);
        
        return $result;
    }
    
    // Get all contact messages
    public function getAllMessages() {
        $sql = "SELECT * FROM contact_messages ORDER BY created_at DESC";
        $result = $this->db->query($sql);
        
        $messages = [];
        
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $messages[] = $row;
            }
        }
        
        return $messages;
    }
    
    // Get message by ID
    public function getMessageById($id) {
        $id = (int) $id; // Ensure it's an integer
        
        $sql = "SELECT * FROM contact_messages WHERE id = $id";
        $result = $this->db->query($sql);
        
        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        
        return null;
    }
}
?>