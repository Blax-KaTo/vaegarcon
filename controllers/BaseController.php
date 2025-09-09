<?php
// Base Controller class that all controllers will extend

class BaseController {
    protected $db;
    protected $data = [];
    
    public function __construct() {
        // Get database instance
        $this->db = Database::getInstance()->getConnection();
    }
    
    // Load model
    protected function loadModel($modelName) {
        $modelFile = MODELS_PATH . '/' . $modelName . '.php';
        
        if (file_exists($modelFile)) {
            require_once $modelFile;
            $model = new $modelName($this->db);
            return $model;
        }
        
        return null;
    }
    
    // Render view
    protected function render($view, $data = []) {
        // Merge data
        $this->data = array_merge($this->data, $data);
        
        // Extract data to make variables available in view
        extract($this->data);
        
        // Include view file
        $viewFile = VIEWS_PATH . '/' . $view . '.php';
        
        if (file_exists($viewFile)) {
            include $viewFile;
        } else {
            echo "View not found: {$view}";
        }
    }
    
    // Redirect to another URL
    protected function redirect($url) {
        header("Location: {$url}");
        exit;
    }
    
    // Get POST data
    protected function getPost($key = null, $default = null) {
        if ($key === null) {
            return $_POST;
        }
        
        return isset($_POST[$key]) ? $_POST[$key] : $default;
    }
    
    // Get GET data
    protected function getQuery($key = null, $default = null) {
        if ($key === null) {
            return $_GET;
        }
        
        return isset($_GET[$key]) ? $_GET[$key] : $default;
    }
    
    // Set data for view
    protected function setData($key, $value) {
        $this->data[$key] = $value;
    }
}
?>