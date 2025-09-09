<?php
// Site Settings Model for managing site settings and hero images

class SiteSettingsModel {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }
    
    // Get a specific setting by key
    public function getSetting($key) {
        $stmt = $this->db->prepare("SELECT setting_value FROM site_settings WHERE setting_key = ?");
        $stmt->bind_param("s", $key);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['setting_value'];
        }
        
        return null;
    }
    
    // Get all settings
    public function getAllSettings() {
        $stmt = $this->db->prepare("SELECT * FROM site_settings ORDER BY setting_group, setting_key");
        $stmt->execute();
        $result = $stmt->get_result();
        
        $settings = [];
        while ($row = $result->fetch_assoc()) {
            $settings[] = $row;
        }
        
        return $settings;
    }
    
    // Get settings by group
    public function getSettingsByGroup($group) {
        $stmt = $this->db->prepare("SELECT * FROM site_settings WHERE setting_group = ? ORDER BY setting_key");
        $stmt->bind_param("s", $group);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $settings = [];
        while ($row = $result->fetch_assoc()) {
            $settings[] = $row;
        }
        
        return $settings;
    }
    
    // Update or create a setting
    public function updateSetting($key, $value, $group = 'general', $description = '') {
        // Check if setting exists
        $stmt = $this->db->prepare("SELECT id FROM site_settings WHERE setting_key = ?");
        $stmt->bind_param("s", $key);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $now = date('Y-m-d H:i:s');
        
        if ($result->num_rows > 0) {
            // Update existing setting
            $stmt = $this->db->prepare("UPDATE site_settings SET setting_value = ?, updated_at = ? WHERE setting_key = ?");
            $stmt->bind_param("sss", $value, $now, $key);
            return $stmt->execute();
        } else {
            // Create new setting
            $stmt = $this->db->prepare("INSERT INTO site_settings (setting_key, setting_value, setting_group, description, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $key, $value, $group, $description, $now, $now);
            return $stmt->execute();
        }
    }
    
    // Delete a setting
    public function deleteSetting($key) {
        $stmt = $this->db->prepare("DELETE FROM site_settings WHERE setting_key = ?");
        $stmt->bind_param("s", $key);
        return $stmt->execute();
    }
    
    // Hero Images Methods
    
    // Get all hero images
    public function getAllHeroImages() {
        $stmt = $this->db->prepare("SELECT * FROM hero_images ORDER BY display_order, id");
        $stmt->execute();
        $result = $stmt->get_result();
        
        $images = [];
        while ($row = $result->fetch_assoc()) {
            $images[] = $row;
        }
        
        return $images;
    }
    
    // Get active hero images
    public function getActiveHeroImages() {
        $stmt = $this->db->prepare("SELECT * FROM hero_images WHERE active = 1 ORDER BY display_order, id");
        $stmt->execute();
        $result = $stmt->get_result();
        
        $images = [];
        while ($row = $result->fetch_assoc()) {
            $images[] = $row;
        }
        
        return $images;
    }
    
    // Get hero image by ID
    public function getHeroImageById($id) {
        $stmt = $this->db->prepare("SELECT * FROM hero_images WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        
        return null;
    }
    
    // Create a new hero image
    public function createHeroImage($data) {
        $now = date('Y-m-d H:i:s');
        
        $stmt = $this->db->prepare("INSERT INTO hero_images (title, image_path, description, button_text, button_link, active, display_order, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssiiss", 
            $data['title'], 
            $data['image_path'], 
            $data['description'], 
            $data['button_text'], 
            $data['button_link'], 
            $data['active'], 
            $data['display_order'], 
            $now, 
            $now
        );
        
        if ($stmt->execute()) {
            return $this->db->insert_id;
        }
        
        return false;
    }
    
    // Update a hero image
    public function updateHeroImage($id, $data) {
        $now = date('Y-m-d H:i:s');
        
        $stmt = $this->db->prepare("UPDATE hero_images SET title = ?, image_path = ?, description = ?, button_text = ?, button_link = ?, active = ?, display_order = ?, updated_at = ? WHERE id = ?");
        $stmt->bind_param("sssssiiis", 
            $data['title'], 
            $data['image_path'], 
            $data['description'], 
            $data['button_text'], 
            $data['button_link'], 
            $data['active'], 
            $data['display_order'], 
            $now, 
            $id
        );
        
        return $stmt->execute();
    }
    
    // Delete a hero image
    public function deleteHeroImage($id) {
        $stmt = $this->db->prepare("DELETE FROM hero_images WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    
    // Update hero image status (active/inactive)
    public function updateHeroImageStatus($id, $active) {
        $now = date('Y-m-d H:i:s');
        
        $stmt = $this->db->prepare("UPDATE hero_images SET active = ?, updated_at = ? WHERE id = ?");
        $stmt->bind_param("isi", $active, $now, $id);
        return $stmt->execute();
    }
    
    // Update hero image display order
    public function updateHeroImageOrder($id, $order) {
        $now = date('Y-m-d H:i:s');
        
        $stmt = $this->db->prepare("UPDATE hero_images SET display_order = ?, updated_at = ? WHERE id = ?");
        $stmt->bind_param("isi", $order, $now, $id);
        return $stmt->execute();
    }
}
?>