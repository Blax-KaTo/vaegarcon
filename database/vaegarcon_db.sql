-- Database creation script for Vaegarcon

-- Create database if not exists
CREATE DATABASE IF NOT EXISTS vaegarcon;

-- Use the database
USE vaegarcon;

-- Create site_settings table
CREATE TABLE IF NOT EXISTS site_settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(100) NOT NULL UNIQUE,
    setting_value TEXT,
    setting_group VARCHAR(100) DEFAULT 'general',
    description TEXT,
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create hero_images table
CREATE TABLE IF NOT EXISTS hero_images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    image_path VARCHAR(255) NOT NULL,
    description TEXT,
    button_text VARCHAR(100),
    button_link VARCHAR(255),
    active BOOLEAN DEFAULT TRUE,
    display_order INT DEFAULT 0,
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create contact_messages table
CREATE TABLE IF NOT EXISTS contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    subject VARCHAR(200),
    message TEXT NOT NULL,
    created_at DATETIME NOT NULL,
    status ENUM('new', 'read', 'replied') DEFAULT 'new'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create users table for admin access
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    role ENUM('admin', 'user') DEFAULT 'user',
    created_at DATETIME NOT NULL,
    last_login DATETIME,
    status ENUM('active', 'inactive') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create blog_posts table
CREATE TABLE IF NOT EXISTS blog_posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    excerpt TEXT,
    content LONGTEXT NOT NULL,
    featured_image VARCHAR(255),
    author_id INT,
    status ENUM('draft', 'published', 'archived') DEFAULT 'draft',
    published_at DATETIME,
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL,
    meta_title VARCHAR(255),
    meta_description TEXT,
    tags VARCHAR(500),
    view_count INT DEFAULT 0,
    FOREIGN KEY (author_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create blog_categories table
CREATE TABLE IF NOT EXISTS blog_categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) NOT NULL UNIQUE,
    description TEXT,
    parent_id INT NULL,
    created_at DATETIME NOT NULL,
    FOREIGN KEY (parent_id) REFERENCES blog_categories(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create blog_post_categories table for many-to-many relationship
CREATE TABLE IF NOT EXISTS blog_post_categories (
    post_id INT NOT NULL,
    category_id INT NOT NULL,
    PRIMARY KEY (post_id, category_id),
    FOREIGN KEY (post_id) REFERENCES blog_posts(id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES blog_categories(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert default admin user (password: admin123)
INSERT INTO users (username, password, email, role, created_at) VALUES
('admin', '$2y$10$8KQT9.xOAf4KyZ/kP.YOJ.P0Y6hEL2c1VDqxIqT1vTNfJWwZzrFe.', 'admin@vaegarcon.com', 'admin', NOW());

-- Insert default blog categories
INSERT INTO blog_categories (name, slug, description, created_at) VALUES
('Fuel Management', 'fuel-management', 'Articles about fuel management best practices and technologies', NOW()),
('Telemetry', 'telemetry', 'Telemetry solutions and monitoring systems', NOW()),
('Industry Insights', 'industry-insights', 'Latest trends and insights in the fuel industry', NOW()),
('Technology', 'technology', 'Innovative technologies in fuel and telemetry', NOW()),
('Case Studies', 'case-studies', 'Real-world implementations and success stories', NOW());

-- Insert sample contact messages
INSERT INTO contact_messages (name, email, subject, message, created_at, status) VALUES
('John Smith', 'john.smith@example.com', 'Fuel Management Inquiry', 'Hello, I am interested in learning more about your fuel management solutions. Could you please provide more information about your telemetry systems?', NOW(), 'new'),
('Sarah Johnson', 'sarah.j@company.com', 'Partnership Opportunity', 'We are a logistics company looking to implement fuel monitoring systems. Would like to discuss potential partnership opportunities.', NOW() - INTERVAL 1 DAY, 'read'),
('Mike Wilson', 'mike.w@transport.co.za', 'Technical Support', 'We have been using your fuel management system for 6 months and need technical support for an issue we are experiencing.', NOW() - INTERVAL 2 DAY, 'replied'),
('Lisa Brown', 'lisa.brown@fleet.com', 'Quote Request', 'Please provide a quote for implementing fuel telemetry across our fleet of 50 vehicles.', NOW() - INTERVAL 3 DAY, 'new'),
('David Lee', 'd.lee@mining.co.za', 'Renewable Energy Solutions', 'Interested in your renewable energy solutions for our mining operations. Can we schedule a consultation?', NOW() - INTERVAL 4 DAY, 'read');

-- Insert sample blog posts
INSERT INTO blog_posts (title, slug, excerpt, content, status, published_at, created_at, updated_at, meta_title, meta_description, tags, author_id) VALUES
('The Future of Fuel Management in Africa', 'future-fuel-management-africa', 'Discover how advanced telemetry and IoT solutions are revolutionizing fuel management across the African continent.', '<h2>The Future of Fuel Management in Africa</h2><p>Africa is experiencing a digital transformation in fuel management that promises to revolutionize how businesses operate across the continent. With the integration of advanced telemetry systems, IoT sensors, and real-time monitoring capabilities, fuel management is becoming more efficient, transparent, and cost-effective than ever before.</p><h3>Key Trends Shaping the Future</h3><ul><li><strong>Real-time Monitoring:</strong> Advanced sensors provide instant visibility into fuel levels, quality, and consumption patterns.</li><li><strong>Predictive Analytics:</strong> AI-powered systems can predict fuel needs and optimize delivery schedules.</li><li><strong>Mobile Integration:</strong> Managers can monitor operations from anywhere using mobile applications.</li><li><strong>Automated Reporting:</strong> Comprehensive reports are generated automatically, saving time and reducing errors.</li></ul><h3>Benefits for African Businesses</h3><p>The adoption of these technologies offers numerous advantages:</p><ul><li>Reduced fuel theft and losses</li><li>Improved operational efficiency</li><li>Better cost control and budgeting</li><li>Enhanced compliance with regulations</li><li>Increased profitability through optimization</li></ul><p>As Africa continues to develop its infrastructure and embrace digital solutions, the future of fuel management looks incredibly promising. Companies that adopt these technologies early will gain a significant competitive advantage in their respective markets.</p>', 'published', NOW(), NOW(), NOW(), 'Future of Fuel Management in Africa - Vaegarcon', 'Explore how advanced telemetry and IoT solutions are revolutionizing fuel management across Africa. Learn about key trends and benefits.', 'fuel-management,telemetry,africa,iot,digital-transformation', 1),
('Understanding Fuel Quality: A Comprehensive Guide', 'fuel-quality-comprehensive-guide', 'Learn about the critical factors that affect fuel quality and how proper monitoring can save your business money.', '<h2>Understanding Fuel Quality: A Comprehensive Guide</h2><p>Fuel quality is a critical factor that directly impacts engine performance, fuel efficiency, and overall operational costs. Understanding what affects fuel quality and how to monitor it effectively can save businesses significant amounts of money while ensuring reliable operations.</p><h3>What Affects Fuel Quality?</h3><p>Several factors can compromise fuel quality:</p><ul><li><strong>Contamination:</strong> Water, dirt, and other foreign particles can enter fuel storage tanks</li><li><strong>Oxidation:</strong> Fuel can degrade over time, especially when exposed to air and heat</li><li><strong>Microbial Growth:</strong> Bacteria and fungi can thrive in fuel tanks under certain conditions</li><li><strong>Temperature Fluctuations:</strong> Extreme temperatures can cause fuel to break down</li></ul><h3>The Importance of Regular Monitoring</h3><p>Regular fuel quality monitoring is essential for:</p><ul><li>Preventing engine damage and costly repairs</li><li>Maintaining optimal fuel efficiency</li><li>Ensuring compliance with industry standards</li><li>Protecting your investment in fuel storage infrastructure</li></ul><h3>Modern Monitoring Solutions</h3><p>Today\'s technology offers sophisticated monitoring capabilities:</p><ul><li>Real-time quality sensors</li><li>Automated sampling systems</li><li>Cloud-based monitoring platforms</li><li>Predictive maintenance alerts</li></ul><p>By implementing a comprehensive fuel quality monitoring system, businesses can proactively address issues before they become costly problems, ensuring smooth operations and maximum return on investment.</p>', 'published', NOW(), NOW(), NOW(), 'Fuel Quality Guide - Understanding and Monitoring - Vaegarcon', 'Learn about critical factors affecting fuel quality and how proper monitoring can save your business money. Comprehensive guide to fuel quality management.', 'fuel-quality,monitoring,contamination,maintenance,engine-performance', 1);