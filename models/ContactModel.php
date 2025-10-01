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
    
    // Update message status
    public function updateMessageStatus($id, $status) {
        $id = (int) $id;
        $status = $this->db->real_escape_string($status);
        
        $sql = "UPDATE contact_messages SET status = '$status' WHERE id = $id";
        $result = $this->db->query($sql);
        
        return $result;
    }
    
    // Delete message
    public function deleteMessage($id) {
        $id = (int) $id;
        
        $sql = "DELETE FROM contact_messages WHERE id = $id";
        $result = $this->db->query($sql);
        
        return $result;
    }
    
    // Get messages by status
    public function getMessagesByStatus($status) {
        $status = $this->db->real_escape_string($status);
        
        $sql = "SELECT * FROM contact_messages WHERE status = '$status' ORDER BY created_at DESC";
        $result = $this->db->query($sql);
        
        $messages = [];
        
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $messages[] = $row;
            }
        }
        
        return $messages;
    }
    
    // Get message statistics
    public function getMessageStats() {
        $stats = [];
        
        // Total messages
        $sql = "SELECT COUNT(*) as total FROM contact_messages";
        $result = $this->db->query($sql);
        $stats['total'] = $result->fetch_assoc()['total'];
        
        // New messages
        $sql = "SELECT COUNT(*) as new_count FROM contact_messages WHERE status = 'new'";
        $result = $this->db->query($sql);
        $stats['new'] = $result->fetch_assoc()['new_count'];
        
        // Read messages
        $sql = "SELECT COUNT(*) as read_count FROM contact_messages WHERE status = 'read'";
        $result = $this->db->query($sql);
        $stats['read'] = $result->fetch_assoc()['read_count'];
        
        // Replied messages
        $sql = "SELECT COUNT(*) as replied_count FROM contact_messages WHERE status = 'replied'";
        $result = $this->db->query($sql);
        $stats['replied'] = $result->fetch_assoc()['replied_count'];
        
        return $stats;
    }
}
?>