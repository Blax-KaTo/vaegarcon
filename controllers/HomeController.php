<?php
// Home Controller for handling the main page

require_once CONTROLLERS_PATH . '/BaseController.php';

class HomeController extends BaseController {
    
    public function __construct() {
        parent::__construct();
    }
    
    // Default action - display home page
    public function index() {
        // Set page title
        $this->setData('pageTitle', 'Vaegarcon - Fuel & Telemetry Engineering Solutions');
        
        // Load SiteSettingsModel to get hero images
        $siteSettingsModel = $this->loadModel('SiteSettingsModel');
        $heroImages = $siteSettingsModel->getActiveHeroImages();
        $this->setData('heroImages', $heroImages);
        
        // Render the view
        $this->render('home/index');
    }
    
    // About page
    public function about() {
        $this->setData('pageTitle', 'About Us - Vaegarcon');
        $this->render('home/about');
    }
    
    // Contact page
    public function contact() {
        $this->setData('pageTitle', 'Contact Us - Vaegarcon');
        
        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $this->getPost('name');
            $email = $this->getPost('email');
            $subject = $this->getPost('subject');
            $message = $this->getPost('message');
            
            // Validate inputs
            $errors = [];
            
            if (empty($name)) {
                $errors['name'] = 'Name is required';
            }
            
            if (empty($email)) {
                $errors['email'] = 'Email is required';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Invalid email format';
            }
            
            if (empty($message)) {
                $errors['message'] = 'Message is required';
            }
            
            // If no errors, process the form
            if (empty($errors)) {
                // Load contact model
                $contactModel = $this->loadModel('ContactModel');
                
                // Save contact message
                $result = $contactModel->saveMessage($name, $email, $subject, $message);
                
                if ($result) {
                    // Set success message
                    $this->setData('success', 'Your message has been received! We will get back to you soon.');
                } else {
                    // Set error message
                    $this->setData('error', 'Failed to send message. Please try again later.');
                }
            } else {
                // Set errors
                $this->setData('errors', $errors);
                
                // Set form data for repopulation
                $this->setData('formData', [
                    'name' => $name,
                    'email' => $email,
                    'subject' => $subject,
                    'message' => $message
                ]);
            }
        }
        
        $this->render('home/contact');
    }
}
?>