<?php
// Services Controller for handling services pages

require_once CONTROLLERS_PATH . '/BaseController.php';

class ServicesController extends BaseController {
    
    public function __construct() {
        parent::__construct();
    }
    
    // Default action - display services overview page
    public function index() {
        // Set page title
        $this->setData('pageTitle', 'Our Services - Vaegarcon');
        
        // Load any models if needed
        // $serviceModel = $this->loadModel('ServiceModel');
        // $services = $serviceModel->getAllServices();
        // $this->setData('services', $services);
        
        // Render the view
        $this->render('services/index');
    }
    
    // Telemetry service details
    public function telemetry() {
        $this->setData('pageTitle', 'Telemetry & Tank Monitoring - Vaegarcon');
        $this->render('services/telemetry');
    }
    
    // Fuel management service details
    public function fuelManagement() {
        $this->setData('pageTitle', 'Fuel Management Systems - Vaegarcon');
        $this->render('services/fuel-management');
    }
    
    // Data analytics service details
    public function dataAnalytics() {
        $this->setData('pageTitle', 'Data Analytics Solutions - Vaegarcon');
        $this->render('services/data-analytics');
    }
}