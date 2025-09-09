<?php
// Industries Controller for handling industry-specific pages

require_once CONTROLLERS_PATH . '/BaseController.php';

class IndustriesController extends BaseController {
    
    public function __construct() {
        parent::__construct();
    }
    
    // Default action - display industries overview page
    public function index() {
        // Set page title
        $this->setData('pageTitle', 'Industries We Serve - Vaegarcon');
        
        // Load any models if needed
        // $industryModel = $this->loadModel('IndustryModel');
        // $industries = $industryModel->getAllIndustries();
        // $this->setData('industries', $industries);
        
        // Render the view
        $this->render('industries/index');
    }
    
    // Transportation industry details
    public function transportation() {
        $this->setData('pageTitle', 'Transportation & Logistics Solutions - Vaegarcon');
        $this->render('industries/transportation');
    }
    
    // Manufacturing industry details
    public function manufacturing() {
        $this->setData('pageTitle', 'Manufacturing Solutions - Vaegarcon');
        $this->render('industries/manufacturing');
    }
    
    // Commercial properties industry details
    public function commercial() {
        $this->setData('pageTitle', 'Commercial Property Solutions - Vaegarcon');
        $this->render('industries/commercial');
    }
}