<?php include VIEWS_PATH . '/layouts/header.php'; ?>

<div class="blog-container">
    <div class="container">
        <!-- Category Header -->
        <div class="blog-header">
            <h1><?php echo htmlspecialchars($currentCategory['name']); ?></h1>
            <p><?php echo htmlspecialchars($currentCategory['description']); ?></p>
            <div class="category-stats">
                <span class="post-count"><?php echo $totalPosts; ?> post<?php echo $totalPosts != 1 ? 's' : ''; ?></span>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="blog-search">
            <form action="/blog/search" method="GET" class="search-form">
                <div class="search-input-group">
                    <input type="text" name="q" placeholder="Search articles..." required>
                    <button type="submit" class="search-btn">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>

        <div class="blog-content">
            <!-- Main Content -->
            <div class="blog-main">
                <?php if (empty($posts)): ?>
                    <div class="no-posts">
                        <h3>No posts found in this category</h3>
                        <p>We couldn't find any blog posts in the "<?php echo htmlspecialchars($currentCategory['name']); ?>" category.</p>
                        <a href="/blog" class="btn-primary">Browse All Posts</a>
                    </div>
                <?php else: ?>
                    <!-- Blog Posts Grid -->
                    <div class="blog-posts-grid">
                        <?php foreach ($posts as $post): ?>
                            <article class="blog-post-card">
                                <div class="post-image">
                                    <?php if ($post['featured_image']): ?>
                                        <img src="<?php echo htmlspecialchars($post['featured_image']); ?>" alt="<?php echo htmlspecialchars($post['title']); ?>">
                                    <?php else: ?>
                                        <div class="post-placeholder">
                                            <i class="fas fa-newspaper"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="post-content">
                                    <div class="post-meta">
                                        <span class="post-date">
                                            <i class="fas fa-calendar"></i>
                                            <?php echo date('M j, Y', strtotime($post['published_at'])); ?>
                                        </span>
                                        <?php if ($post['categories']): ?>
                                            <span class="post-category">
                                                <i class="fas fa-tag"></i>
                                                <?php 
                                                $categories = explode(',', $post['categories']);
                                                echo htmlspecialchars(trim($categories[0])); 
                                                ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <h2 class="post-title">
                                        <a href="/blog/post/<?php echo htmlspecialchars($post['slug']); ?>">
                                            <?php echo htmlspecialchars($post['title']); ?>
                                        </a>
                                    </h2>
                                    <p class="post-excerpt">
                                        <?php echo htmlspecialchars($post['excerpt']); ?>
                                    </p>
                                    <div class="post-footer">
                                        <span class="post-author">
                                            <i class="fas fa-user"></i>
                                            <?php echo htmlspecialchars($post['author_name']); ?>
                                        </span>
                                        <a href="/blog/post/<?php echo htmlspecialchars($post['slug']); ?>" class="read-more">
                                            Read More <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>

                    <!-- Pagination -->
                    <?php if ($totalPages > 1): ?>
                        <div class="blog-pagination">
                            <?php if ($currentPage > 1): ?>
                                <a href="/blog/category/<?php echo htmlspecialchars($currentCategory['slug']); ?>?page=<?php echo $currentPage - 1; ?>" class="page-link prev">
                                    <i class="fas fa-chevron-left"></i> Previous
                                </a>
                            <?php endif; ?>
                            
                            <div class="page-numbers">
                                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                    <?php if ($i == $currentPage): ?>
                                        <span class="page-link current"><?php echo $i; ?></span>
                                    <?php elseif ($i == 1 || $i == $totalPages || ($i >= $currentPage - 2 && $i <= $currentPage + 2)): ?>
                                        <a href="/blog/category/<?php echo htmlspecialchars($currentCategory['slug']); ?>?page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
                                    <?php elseif ($i == $currentPage - 3 || $i == $currentPage + 3): ?>
                                        <span class="page-ellipsis">...</span>
                                    <?php endif; ?>
                                <?php endfor; ?>
                            </div>
                            
                            <?php if ($currentPage < $totalPages): ?>
                                <a href="/blog/category/<?php echo htmlspecialchars($currentCategory['slug']); ?>?page=<?php echo $currentPage + 1; ?>" class="page-link next">
                                    Next <i class="fas fa-chevron-right"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>

            <!-- Sidebar -->
            <aside class="blog-sidebar">
                <!-- Categories -->
                <div class="sidebar-widget">
                    <h3>Categories</h3>
                    <ul class="category-list">
                        <?php foreach ($categories as $category): ?>
                            <li class="<?php echo $category['slug'] === $currentCategory['slug'] ? 'current-category' : ''; ?>">
                                <a href="/blog/category/<?php echo htmlspecialchars($category['slug']); ?>">
                                    <?php echo htmlspecialchars($category['name']); ?>
                                    <span class="post-count">(<?php echo $category['post_count']; ?>)</span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Popular Posts -->
                <?php if (!empty($popularPosts)): ?>
                    <div class="sidebar-widget">
                        <h3>Popular Posts</h3>
                        <div class="popular-posts">
                            <?php foreach ($popularPosts as $post): ?>
                                <div class="popular-post">
                                    <h4>
                                        <a href="/blog/post/<?php echo htmlspecialchars($post['slug']); ?>">
                                            <?php echo htmlspecialchars($post['title']); ?>
                                        </a>
                                    </h4>
                                    <span class="post-date">
                                        <?php echo date('M j, Y', strtotime($post['published_at'])); ?>
                                    </span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Recent Posts -->
                <?php if (!empty($recentPosts)): ?>
                    <div class="sidebar-widget">
                        <h3>Recent Posts</h3>
                        <div class="recent-posts">
                            <?php foreach ($recentPosts as $post): ?>
                                <div class="recent-post">
                                    <h4>
                                        <a href="/blog/post/<?php echo htmlspecialchars($post['slug']); ?>">
                                            <?php echo htmlspecialchars($post['title']); ?>
                                        </a>
                                    </h4>
                                    <span class="post-date">
                                        <?php echo date('M j, Y', strtotime($post['published_at'])); ?>
                                    </span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Newsletter Signup -->
                <div class="sidebar-widget newsletter-widget">
                    <h3>Stay Updated</h3>
                    <p>Get the latest insights delivered to your inbox.</p>
                    <form class="newsletter-form">
                        <input type="email" placeholder="Your email address" required>
                        <button type="submit" class="btn-primary">Subscribe</button>
                    </form>
                </div>

                <!-- Back to Blog -->
                <div class="sidebar-widget">
                    <a href="/blog" class="back-to-blog">
                        <i class="fas fa-arrow-left"></i> Back to Blog
                    </a>
                </div>
            </aside>
        </div>
    </div>
</div>

<?php include VIEWS_PATH . '/layouts/footer.php'; ?>