<?php
// Blog Model for handling blog-related database operations

class BlogModel {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }
    
    // Get all published blog posts with pagination
    public function getPublishedPosts($page = 1, $limit = 6, $category = null) {
        $offset = ($page - 1) * $limit;
        
        $sql = "SELECT p.*, u.username as author_name, 
                       GROUP_CONCAT(c.name) as categories
                FROM blog_posts p 
                LEFT JOIN users u ON p.author_id = u.id
                LEFT JOIN blog_post_categories pc ON p.id = pc.post_id
                LEFT JOIN blog_categories c ON pc.category_id = c.id
                WHERE p.status = 'published'";
        
        if ($category) {
            $sql .= " AND c.slug = ?";
        }
        
        $sql .= " GROUP BY p.id ORDER BY p.published_at DESC LIMIT ? OFFSET ?";
        
        $stmt = $this->db->prepare($sql);
        
        if ($category) {
            $stmt->bind_param("sii", $category, $limit, $offset);
        } else {
            $stmt->bind_param("ii", $limit, $offset);
        }
        
        $stmt->execute();
        $result = $stmt->get_result();
        
        $posts = [];
        while ($row = $result->fetch_assoc()) {
            $posts[] = $row;
        }
        
        return $posts;
    }
    
    // Get total count of published posts
    public function getTotalPublishedPosts($category = null) {
        $sql = "SELECT COUNT(DISTINCT p.id) as total
                FROM blog_posts p 
                LEFT JOIN blog_post_categories pc ON p.id = pc.post_id
                LEFT JOIN blog_categories c ON pc.category_id = c.id
                WHERE p.status = 'published'";
        
        if ($category) {
            $sql .= " AND c.slug = ?";
        }
        
        $stmt = $this->db->prepare($sql);
        
        if ($category) {
            $stmt->bind_param("s", $category);
        }
        
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        return $row['total'];
    }
    
    // Get a single blog post by slug
    public function getPostBySlug($slug) {
        $sql = "SELECT p.*, u.username as author_name,
                       GROUP_CONCAT(c.name) as categories,
                       GROUP_CONCAT(c.slug) as category_slugs
                FROM blog_posts p 
                LEFT JOIN users u ON p.author_id = u.id
                LEFT JOIN blog_post_categories pc ON p.id = pc.post_id
                LEFT JOIN blog_categories c ON pc.category_id = c.id
                WHERE p.slug = ? AND p.status = 'published'
                GROUP BY p.id";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $slug);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->fetch_assoc();
    }
    
    // Get related posts
    public function getRelatedPosts($postId, $categoryIds, $limit = 3) {
        if (empty($categoryIds)) {
            return [];
        }
        
        $categoryIdsStr = implode(',', $categoryIds);
        
        $sql = "SELECT p.*, u.username as author_name
                FROM blog_posts p 
                LEFT JOIN users u ON p.author_id = u.id
                LEFT JOIN blog_post_categories pc ON p.id = pc.post_id
                WHERE p.status = 'published' 
                AND p.id != ? 
                AND pc.category_id IN ($categoryIdsStr)
                GROUP BY p.id 
                ORDER BY p.published_at DESC 
                LIMIT ?";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ii", $postId, $limit);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $posts = [];
        while ($row = $result->fetch_assoc()) {
            $posts[] = $row;
        }
        
        return $posts;
    }
    
    // Get all blog categories
    public function getAllCategories() {
        $sql = "SELECT c.*, COUNT(pc.post_id) as post_count
                FROM blog_categories c
                LEFT JOIN blog_post_categories pc ON c.id = pc.category_id
                LEFT JOIN blog_posts p ON pc.post_id = p.id AND p.status = 'published'
                GROUP BY c.id
                ORDER BY c.name ASC";
        
        $result = $this->db->query($sql);
        
        $categories = [];
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
        
        return $categories;
    }
    
    // Get posts by category
    public function getPostsByCategory($categorySlug, $page = 1, $limit = 6) {
        return $this->getPublishedPosts($page, $limit, $categorySlug);
    }
    
    // Search posts
    public function searchPosts($query, $page = 1, $limit = 6) {
        $offset = ($page - 1) * $limit;
        $searchTerm = "%$query%";
        
        $sql = "SELECT p.*, u.username as author_name,
                       GROUP_CONCAT(c.name) as categories
                FROM blog_posts p 
                LEFT JOIN users u ON p.author_id = u.id
                LEFT JOIN blog_post_categories pc ON p.id = pc.post_id
                LEFT JOIN blog_categories c ON pc.category_id = c.id
                WHERE p.status = 'published' 
                AND (p.title LIKE ? OR p.excerpt LIKE ? OR p.content LIKE ? OR p.tags LIKE ?)
                GROUP BY p.id 
                ORDER BY p.published_at DESC 
                LIMIT ? OFFSET ?";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssssii", $searchTerm, $searchTerm, $searchTerm, $searchTerm, $limit, $offset);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $posts = [];
        while ($row = $result->fetch_assoc()) {
            $posts[] = $row;
        }
        
        return $posts;
    }
    
    // Get total search results
    public function getTotalSearchResults($query) {
        $searchTerm = "%$query%";
        
        $sql = "SELECT COUNT(DISTINCT p.id) as total
                FROM blog_posts p 
                WHERE p.status = 'published' 
                AND (p.title LIKE ? OR p.excerpt LIKE ? OR p.content LIKE ? OR p.tags LIKE ?)";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssss", $searchTerm, $searchTerm, $searchTerm, $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        return $row['total'];
    }
    
    // Increment view count
    public function incrementViewCount($postId) {
        $sql = "UPDATE blog_posts SET view_count = view_count + 1 WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $postId);
        return $stmt->execute();
    }
    
    // Get popular posts
    public function getPopularPosts($limit = 5) {
        $sql = "SELECT p.*, u.username as author_name
                FROM blog_posts p 
                LEFT JOIN users u ON p.author_id = u.id
                WHERE p.status = 'published'
                ORDER BY p.view_count DESC, p.published_at DESC
                LIMIT ?";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $posts = [];
        while ($row = $result->fetch_assoc()) {
            $posts[] = $row;
        }
        
        return $posts;
    }
    
    // Get recent posts
    public function getRecentPosts($limit = 5) {
        $sql = "SELECT p.*, u.username as author_name
                FROM blog_posts p 
                LEFT JOIN users u ON p.author_id = u.id
                WHERE p.status = 'published'
                ORDER BY p.published_at DESC
                LIMIT ?";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $posts = [];
        while ($row = $result->fetch_assoc()) {
            $posts[] = $row;
        }
        
        return $posts;
    }
    
    // Admin methods
    public function getAllPosts() {
        $sql = "SELECT p.*, u.username as author_name,
                       GROUP_CONCAT(c.name) as categories
                FROM blog_posts p 
                LEFT JOIN users u ON p.author_id = u.id
                LEFT JOIN blog_post_categories pc ON p.id = pc.post_id
                LEFT JOIN blog_categories c ON pc.category_id = c.id
                GROUP BY p.id 
                ORDER BY p.created_at DESC";
        
        $result = $this->db->query($sql);
        
        $posts = [];
        while ($row = $result->fetch_assoc()) {
            $posts[] = $row;
        }
        
        return $posts;
    }
    
    public function getPostById($id) {
        $sql = "SELECT p.*, u.username as author_name,
                       (SELECT GROUP_CONCAT(category_id) FROM blog_post_categories WHERE post_id = p.id) AS category_ids_csv
                FROM blog_posts p 
                LEFT JOIN users u ON p.author_id = u.id
                WHERE p.id = ?";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if ($row && isset($row['category_ids_csv']) && $row['category_ids_csv'] !== null) {
            $row['category_ids'] = array_map('intval', explode(',', $row['category_ids_csv']));
        } else if ($row) {
            $row['category_ids'] = [];
        }
        return $row;
    }
    
    public function createPost($data) {
        $this->db->begin_transaction();
        
        try {
            $sql = "INSERT INTO blog_posts (title, slug, excerpt, content, status, tags, author_id, created_at, updated_at) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";
            
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("ssssssi", $data['title'], $data['slug'], $data['excerpt'], $data['content'], $data['status'], $data['tags'], $data['author_id']);
            
            if (!$stmt->execute()) {
                throw new Exception("Failed to create post");
            }
            
            $postId = $this->db->insert_id;
            
            // Set published_at if status is published
            if ($data['status'] === 'published') {
                $updateSql = "UPDATE blog_posts SET published_at = NOW() WHERE id = ?";
                $updateStmt = $this->db->prepare($updateSql);
                $updateStmt->bind_param("i", $postId);
                $updateStmt->execute();
            }
            
            // Add categories
            if (!empty($data['categories'])) {
                $this->addPostCategories($postId, $data['categories']);
            }
            
            $this->db->commit();
            return true;
            
        } catch (Exception $e) {
            $this->db->rollback();
            return false;
        }
    }
    
    public function updatePost($id, $data) {
        $this->db->begin_transaction();
        
        try {
            $sql = "UPDATE blog_posts SET title = ?, slug = ?, excerpt = ?, content = ?, status = ?, tags = ?, updated_at = NOW() WHERE id = ?";
            
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("ssssssi", $data['title'], $data['slug'], $data['excerpt'], $data['content'], $data['status'], $data['tags'], $id);
            
            if (!$stmt->execute()) {
                throw new Exception("Failed to update post");
            }
            
            // Set published_at if status is published and it wasn't published before
            if ($data['status'] === 'published') {
                $checkSql = "SELECT published_at FROM blog_posts WHERE id = ?";
                $checkStmt = $this->db->prepare($checkSql);
                $checkStmt->bind_param("i", $id);
                $checkStmt->execute();
                $result = $checkStmt->get_result();
                $post = $result->fetch_assoc();
                
                if (!$post['published_at']) {
                    $updateSql = "UPDATE blog_posts SET published_at = NOW() WHERE id = ?";
                    $updateStmt = $this->db->prepare($updateSql);
                    $updateStmt->bind_param("i", $id);
                    $updateStmt->execute();
                }
            }
            
            // Update categories
            $this->updatePostCategories($id, $data['categories']);
            
            $this->db->commit();
            return true;
            
        } catch (Exception $e) {
            $this->db->rollback();
            return false;
        }
    }
    
    public function deletePost($id) {
        $this->db->begin_transaction();
        
        try {
            // Delete post categories first
            $sql = "DELETE FROM blog_post_categories WHERE post_id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            
            // Delete the post
            $sql = "DELETE FROM blog_posts WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("i", $id);
            
            if (!$stmt->execute()) {
                throw new Exception("Failed to delete post");
            }
            
            $this->db->commit();
            return true;
            
        } catch (Exception $e) {
            $this->db->rollback();
            return false;
        }
    }
    
    // Update only status (and published_at if moving to published)
    public function setPostStatus($id, $status) {
        $sql = "UPDATE blog_posts 
                SET status = ?, 
                    published_at = CASE WHEN ? = 'published' AND published_at IS NULL THEN NOW() ELSE published_at END,
                    updated_at = NOW()
                WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssi", $status, $status, $id);
        return $stmt->execute();
    }
    
    private function addPostCategories($postId, $categoryIds) {
        $sql = "INSERT INTO blog_post_categories (post_id, category_id) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        
        foreach ($categoryIds as $categoryId) {
            $stmt->bind_param("ii", $postId, $categoryId);
            $stmt->execute();
        }
    }
    
    private function updatePostCategories($postId, $categoryIds) {
        // Remove existing categories
        $sql = "DELETE FROM blog_post_categories WHERE post_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $postId);
        $stmt->execute();
        
        // Add new categories
        if (!empty($categoryIds)) {
            $this->addPostCategories($postId, $categoryIds);
        }
    }
}
?>
