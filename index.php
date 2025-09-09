<?php
// Front Controller for Vaegarcon

// Start session
session_start();

// Include configuration and database connection
require_once 'includes/config.php';
require_once 'includes/db.php';

// Include router
require_once 'includes/router.php';

// Process the request
$router = new Router();
$router->route();
?>