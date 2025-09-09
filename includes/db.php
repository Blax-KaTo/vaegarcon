<?php
// Database connection using MySQLi

class Database {
    private static $instance = null;
    private $connection;
    
    private function __construct() {
        // Create connection
        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        
        // Check connection
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
        
        // Set charset
        $this->connection->set_charset("utf8");
    }
    
    // Get singleton instance
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    // Get connection
    public function getConnection() {
        return $this->connection;
    }
    
    // Execute query
    public function query($sql) {
        return $this->connection->query($sql);
    }
    
    // Prepare statement
    public function prepare($sql) {
        return $this->connection->prepare($sql);
    }
    
    // Get last insert ID
    public function getLastId() {
        return $this->connection->insert_id;
    }
    
    // Escape string
    public function escapeString($string) {
        return $this->connection->real_escape_string($string);
    }
    
    // Close connection
    public function close() {
        $this->connection->close();
    }
}
?>