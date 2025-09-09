<?php
// Configuration file for Vaegarcon

// Define base paths
define('BASE_PATH', dirname(__DIR__));
define('INCLUDES_PATH', BASE_PATH . '/includes');
define('CONTROLLERS_PATH', BASE_PATH . '/controllers');
define('MODELS_PATH', BASE_PATH . '/models');
define('VIEWS_PATH', BASE_PATH . '/views');

// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'vaegarcon');

// Error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// URL configuration (dynamic)
$isHttps = (
    (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ||
    (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') ||
    (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443)
);
$scheme = $isHttps ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$baseDir = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/')), '/');
define('BASE_URL', $scheme . '://' . $host . ($baseDir ? $baseDir : ''));

// Default controller and action
define('DEFAULT_CONTROLLER', 'home');
define('DEFAULT_ACTION', 'index');
?>