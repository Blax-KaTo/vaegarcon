# Vaegarcon - Fuel & Telemetry Engineering Solutions

## Front Controller Implementation

This project uses a PHP Front Controller pattern with MySQLi for database operations. The front controller pattern centralizes all requests through a single entry point (index.php) and routes them to the appropriate controllers and actions.

## Project Structure

```
Vaegarcon/
├── controllers/         # Controller classes
│   ├── BaseController.php
│   └── HomeController.php
├── database/            # Database scripts
│   └── vaegarcon_db.sql
├── includes/            # Core files
│   ├── config.php       # Configuration settings
│   ├── db.php           # Database connection (MySQLi)
│   └── router.php       # URL routing
├── models/              # Model classes
│   └── ContactModel.php
├── views/               # View templates
│   ├── home/
│   │   ├── index.php
│   │   └── contact.php
│   └── layouts/
│       ├── header.php
│       └── footer.php
├── css/                 # CSS files
├── js/                  # JavaScript files
├── assets/              # Images and other assets
├── .htaccess            # URL rewriting rules
├── index.php            # Front controller entry point
└── README.md            # Project documentation
```

## Setup Instructions

1. **Database Setup**:
   - Create a MySQL database named `vaegarcon_db`
   - Import the SQL file from `database/vaegarcon_db.sql`

2. **Configuration**:
   - Update database credentials in `includes/config.php` if needed
   - Adjust the `BASE_URL` constant in `includes/config.php` to match your environment

3. **Server Requirements**:
   - PHP 7.0 or higher
   - MySQL 5.7 or higher
   - Apache with mod_rewrite enabled

## URL Structure

The front controller uses the following URL structure:

```
http://localhost/Vaegarcon/controller/action/param1/param2/...
```

- If no controller is specified, the default controller (`home`) is used
- If no action is specified, the default action (`index`) is used

## Adding New Controllers

1. Create a new controller class in the `controllers` directory
2. Extend the `BaseController` class
3. Implement the required actions as methods

Example:

```php
<?php
class ServicesController extends BaseController {
    public function index() {
        // Display all services
        $this->render('services/index');
    }
    
    public function view($id) {
        // Display a specific service
        $this->render('services/view', ['id' => $id]);
    }
}
?>
```

## Adding New Models

1. Create a new model class in the `models` directory
2. Implement the required methods for data manipulation

Example:

```php
<?php
class ServiceModel {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }
    
    public function getAllServices() {
        $sql = "SELECT * FROM services";
        $result = $this->db->query($sql);
        
        $services = [];
        
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $services[] = $row;
            }
        }
        
        return $services;
    }
}
?>
```

## Adding New Views

1. Create a new view file in the `views` directory
2. Use the data passed from the controller

Example:

```php
<?php
// Include header
include VIEWS_PATH . '/layouts/header.php';
?>

<section class="services">
    <div class="container">
        <h1>Our Services</h1>
        <!-- Display services data -->
    </div>
</section>

<?php
// Include footer
include VIEWS_PATH . '/layouts/footer.php';
?>
```