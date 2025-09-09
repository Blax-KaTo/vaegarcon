<?php
// Router class for handling URL routing

class Router {
    private $controller;
    private $action;
    private $params = [];
    
    public function __construct() {
        $this->parseUrl();
    }
    
    // Parse the URL into controller, action and parameters
    private function parseUrl() {
        // Get the URL path robustly across hosts
        $path = '';
        if (!empty($_SERVER['PATH_INFO'])) {
            $path = $_SERVER['PATH_INFO'];
        } elseif (!empty($_SERVER['ORIG_PATH_INFO']) && $_SERVER['ORIG_PATH_INFO'] !== '/index.php') {
            $path = $_SERVER['ORIG_PATH_INFO'];
        } elseif (!empty($_SERVER['REQUEST_URI'])) {
            $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            // Strip base directory if app is in subfolder
            $scriptDir = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
            if ($scriptDir && strpos($uri, $scriptDir) === 0) {
                $uri = substr($uri, strlen($scriptDir));
            }
            // Remove leading /index.php component if present
            if (strpos($uri, '/index.php') === 0) {
                $uri = substr($uri, strlen('/index.php'));
            }
            $path = $uri;
        }

        // If path is empty, use default controller and action
        if ($path === '' || $path === '/') {
            $this->controller = DEFAULT_CONTROLLER;
            $this->action = DEFAULT_ACTION;
            return;
        }
        
        // Remove leading slash
        $path = ltrim($path, '/');
        
        // Split the URL into parts
        $parts = explode('/', $path);
        
        // Get controller
        $this->controller = !empty($parts[0]) ? $parts[0] : DEFAULT_CONTROLLER;
        
        // Shortcut aliases for auth routes
        if ($this->controller === 'login') {
            $this->controller = 'auth';
            $this->action = 'login';
            $this->params = [];
            return;
        }
        if ($this->controller === 'logout') {
            $this->controller = 'auth';
            $this->action = 'logout';
            $this->params = [];
            return;
        }
        if ($this->controller === 'setup') {
            // allow /setup/admin
            $this->controller = 'setup';
            $this->action = isset($parts[1]) && $parts[1] ? $parts[1] : 'admin';
            $this->params = array_slice($parts, 2);
            return;
        }
        
        // Get action
        $this->action = isset($parts[1]) && !empty($parts[1]) ? $parts[1] : DEFAULT_ACTION;
        
        // Get parameters
        $this->params = array_slice($parts, 2);
    }
    
    // Route the request to the appropriate controller and action
    public function route() {
        // Format controller name
        $controllerName = ucfirst($this->controller) . 'Controller';
        $controllerFile = CONTROLLERS_PATH . '/' . $controllerName . '.php';
        
        // Check if controller file exists
        if (!file_exists($controllerFile)) {
            $this->handleError(404, "Controller not found: {$controllerName}");
            return;
        }
        
        // Include controller file
        require_once $controllerFile;
        
        // Check if controller class exists
        if (!class_exists($controllerName)) {
            $this->handleError(404, "Controller class not found: {$controllerName}");
            return;
        }
        
        // Create controller instance
        $controller = new $controllerName();
        
        // Check if action method exists
        if (!method_exists($controller, $this->action)) {
            $this->handleError(404, "Action not found: {$this->action}");
            return;
        }
        
        // Call the action method with parameters
        call_user_func_array([$controller, $this->action], $this->params);
    }
    
    // Handle errors
    private function handleError($code, $message) {
        http_response_code($code);
        
        // Include error view if exists
        $errorFile = VIEWS_PATH . '/error/' . $code . '.php';
        if (file_exists($errorFile)) {
            include $errorFile;
        } else {
            echo "<h1>Error {$code}</h1>";
            echo "<p>{$message}</p>";
        }
    }
}
?>