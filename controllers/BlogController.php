<?php
// Blog Controller for handling blog-related requests

require_once CONTROLLERS_PATH . '/BaseController.php';

class BlogController extends BaseController {
    
    private $blogModel;
    
    public function __construct() {
        parent::__construct();
        $this->blogModel = $this->loadModel('BlogModel');
    }
    
    // Display blog listing page
    public function index() {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page = max(1, $page); // Ensure page is at least 1
        
        $posts = $this->blogModel->getPublishedPosts($page, 6);
        $totalPosts = $this->blogModel->getTotalPublishedPosts();
        $totalPages = ceil($totalPosts / 6);
        $categories = $this->blogModel->getAllCategories();
        $popularPosts = $this->blogModel->getPopularPosts(5);
        $recentPosts = $this->blogModel->getRecentPosts(5);
        
        $this->setData('pageTitle', 'Blog - Vaegarcon');
        $this->setData('posts', $posts);
        $this->setData('currentPage', $page);
        $this->setData('totalPages', $totalPages);
        $this->setData('totalPosts', $totalPosts);
        $this->setData('categories', $categories);
        $this->setData('popularPosts', $popularPosts);
        $this->setData('recentPosts', $recentPosts);
        
        $this->render('blog/index');
    }
    
    // Display single blog post
    public function post($slug = null) {
        if (!$slug) {
            $this->redirect('/blog');
        }
        
        $post = $this->blogModel->getPostBySlug($slug);
        
        if (!$post) {
            $this->setData('pageTitle', 'Post Not Found - Vaegarcon');
            $this->setData('error', 'The requested blog post could not be found.');
            $this->render('blog/404');
            return;
        }
        
        // Increment view count
        $this->blogModel->incrementViewCount($post['id']);
        
        // Get related posts
        $categorySlugs = $post['category_slugs'] ? explode(',', $post['category_slugs']) : [];
        $relatedPosts = $this->blogModel->getRelatedPosts($post['id'], $categorySlugs, 3);
        
        // Get categories for sidebar
        $categories = $this->blogModel->getAllCategories();
        $popularPosts = $this->blogModel->getPopularPosts(5);
        $recentPosts = $this->blogModel->getRecentPosts(5);
        
        $this->setData('pageTitle', $post['meta_title'] ?: $post['title'] . ' - Vaegarcon');
        $this->setData('post', $post);
        $this->setData('relatedPosts', $relatedPosts);
        $this->setData('categories', $categories);
        $this->setData('popularPosts', $popularPosts);
        $this->setData('recentPosts', $recentPosts);
        
        $this->render('blog/post');
    }
    
    // Display posts by category
    public function category($categorySlug = null) {
        if (!$categorySlug) {
            $this->redirect('/blog');
        }
        
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page = max(1, $page);
        
        $posts = $this->blogModel->getPostsByCategory($categorySlug, $page, 6);
        $totalPosts = $this->blogModel->getTotalPublishedPosts($categorySlug);
        $totalPages = ceil($totalPosts / 6);
        
        // Get category info
        $categories = $this->blogModel->getAllCategories();
        $currentCategory = null;
        foreach ($categories as $cat) {
            if ($cat['slug'] === $categorySlug) {
                $currentCategory = $cat;
                break;
            }
        }
        
        if (!$currentCategory) {
            $this->redirect('/blog');
        }
        
        $popularPosts = $this->blogModel->getPopularPosts(5);
        $recentPosts = $this->blogModel->getRecentPosts(5);
        
        $this->setData('pageTitle', $currentCategory['name'] . ' - Blog - Vaegarcon');
        $this->setData('posts', $posts);
        $this->setData('currentPage', $page);
        $this->setData('totalPages', $totalPages);
        $this->setData('totalPosts', $totalPosts);
        $this->setData('currentCategory', $currentCategory);
        $this->setData('categories', $categories);
        $this->setData('popularPosts', $popularPosts);
        $this->setData('recentPosts', $recentPosts);
        
        $this->render('blog/category');
    }
    
    // Search blog posts
    public function search() {
        $query = isset($_GET['q']) ? trim($_GET['q']) : '';
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page = max(1, $page);
        
        if (empty($query)) {
            $this->redirect('/blog');
        }
        
        $posts = $this->blogModel->searchPosts($query, $page, 6);
        $totalPosts = $this->blogModel->getTotalSearchResults($query);
        $totalPages = ceil($totalPosts / 6);
        
        $categories = $this->blogModel->getAllCategories();
        $popularPosts = $this->blogModel->getPopularPosts(5);
        $recentPosts = $this->blogModel->getRecentPosts(5);
        
        $this->setData('pageTitle', 'Search Results for "' . htmlspecialchars($query) . '" - Blog - Vaegarcon');
        $this->setData('posts', $posts);
        $this->setData('currentPage', $page);
        $this->setData('totalPages', $totalPages);
        $this->setData('totalPosts', $totalPosts);
        $this->setData('searchQuery', $query);
        $this->setData('categories', $categories);
        $this->setData('popularPosts', $popularPosts);
        $this->setData('recentPosts', $recentPosts);
        
        $this->render('blog/search');
    }
    
    // RSS feed
    public function rss() {
        $posts = $this->blogModel->getPublishedPosts(1, 20);
        
        header('Content-Type: application/rss+xml; charset=UTF-8');
        
        $this->setData('posts', $posts);
        $this->render('blog/rss');
    }
    
    // Sitemap for blog
    public function sitemap() {
        $posts = $this->blogModel->getPublishedPosts(1, 1000); // Get all published posts
        $categories = $this->blogModel->getAllCategories();
        
        header('Content-Type: application/xml; charset=UTF-8');
        
        $this->setData('posts', $posts);
        $this->setData('categories', $categories);
        $this->render('blog/sitemap');
    }
}
?>
