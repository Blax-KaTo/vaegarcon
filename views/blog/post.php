<?php include VIEWS_PATH . '/layouts/header.php'; ?>

<div class="blog-container">
    <div class="container">
        <div class="blog-content">
            <!-- Main Content -->
            <div class="blog-main">
                <article class="blog-post-full">
                    <!-- Post Header -->
                    <header class="post-header">
                        <div class="post-meta">
                            <span class="post-date">
                                <i class="fas fa-calendar"></i>
                                <?php echo date('F j, Y', strtotime($post['published_at'])); ?>
                            </span>
                            <?php if ($post['categories']): ?>
                                <span class="post-category">
                                    <i class="fas fa-tag"></i>
                                    <?php 
                                    $categories = explode(',', $post['categories']);
                                    foreach ($categories as $index => $category): ?>
                                        <a href="/blog/category/<?php echo htmlspecialchars(trim($category)); ?>">
                                            <?php echo htmlspecialchars(trim($category)); ?>
                                        </a><?php echo ($index < count($categories) - 1) ? ', ' : ''; ?>
                                    <?php endforeach; ?>
                                </span>
                            <?php endif; ?>
                            <span class="post-author">
                                <i class="fas fa-user"></i>
                                By <?php echo htmlspecialchars($post['author_name']); ?>
                            </span>
                            <span class="post-views">
                                <i class="fas fa-eye"></i>
                                <?php echo number_format($post['view_count']); ?> views
                            </span>
                        </div>
                        
                        <h1 class="post-title"><?php echo htmlspecialchars($post['title']); ?></h1>
                        
                        <?php if ($post['excerpt']): ?>
                            <div class="post-excerpt">
                                <?php echo htmlspecialchars($post['excerpt']); ?>
                            </div>
                        <?php endif; ?>
                    </header>

                    <!-- Featured Image -->
                    <?php if ($post['featured_image']): ?>
                        <div class="post-featured-image">
                            <img src="<?php echo htmlspecialchars($post['featured_image']); ?>" 
                                 alt="<?php echo htmlspecialchars($post['title']); ?>">
                        </div>
                    <?php endif; ?>

                    <!-- Post Content -->
                    <div class="post-content">
                        <?php echo $post['content']; ?>
                    </div>

                    <!-- Post Footer -->
                    <footer class="post-footer">
                        <?php if ($post['tags']): ?>
                            <div class="post-tags">
                                <h4>Tags:</h4>
                                <div class="tags-list">
                                    <?php 
                                    $tags = explode(',', $post['tags']);
                                    foreach ($tags as $tag): ?>
                                        <span class="tag"><?php echo htmlspecialchars(trim($tag)); ?></span>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="post-share">
                            <h4>Share this post:</h4>
                            <div class="share-buttons">
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>" 
                                   target="_blank" class="share-btn facebook">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>&text=<?php echo urlencode($post['title']); ?>" 
                                   target="_blank" class="share-btn twitter">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>" 
                                   target="_blank" class="share-btn linkedin">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="mailto:?subject=<?php echo urlencode($post['title']); ?>&body=<?php echo urlencode('Check out this article: ' . $_SERVER['REQUEST_URI']); ?>" 
                                   class="share-btn email">
                                    <i class="fas fa-envelope"></i>
                                </a>
                            </div>
                        </div>
                    </footer>
                </article>

                <!-- Related Posts -->
                <?php if (!empty($relatedPosts)): ?>
                    <section class="related-posts">
                        <h3>Related Posts</h3>
                        <div class="related-posts-grid">
                            <?php foreach ($relatedPosts as $relatedPost): ?>
                                <article class="related-post-card">
                                    <div class="post-image">
                                        <?php if ($relatedPost['featured_image']): ?>
                                            <img src="<?php echo htmlspecialchars($relatedPost['featured_image']); ?>" 
                                                 alt="<?php echo htmlspecialchars($relatedPost['title']); ?>">
                                        <?php else: ?>
                                            <div class="post-placeholder">
                                                <i class="fas fa-newspaper"></i>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="post-content">
                                        <h4 class="post-title">
                                            <a href="/blog/post/<?php echo htmlspecialchars($relatedPost['slug']); ?>">
                                                <?php echo htmlspecialchars($relatedPost['title']); ?>
                                            </a>
                                        </h4>
                                        <p class="post-excerpt">
                                            <?php echo htmlspecialchars($relatedPost['excerpt']); ?>
                                        </p>
                                        <div class="post-meta">
                                            <span class="post-date">
                                                <?php echo date('M j, Y', strtotime($relatedPost['published_at'])); ?>
                                            </span>
                                            <a href="/blog/post/<?php echo htmlspecialchars($relatedPost['slug']); ?>" class="read-more">
                                                Read More <i class="fas fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            <?php endforeach; ?>
                        </div>
                    </section>
                <?php endif; ?>

                <!-- Comments Section (Placeholder for future implementation) -->
                <section class="comments-section">
                    <h3>Comments</h3>
                    <div class="comments-placeholder">
                        <p>Comments functionality coming soon. Have a question about this article? <a href="/contact">Contact us</a>.</p>
                    </div>
                </section>
            </div>

            <!-- Sidebar -->
            <aside class="blog-sidebar">
                <!-- Categories -->
                <div class="sidebar-widget">
                    <h3>Categories</h3>
                    <ul class="category-list">
                        <?php foreach ($categories as $category): ?>
                            <li>
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
                            <?php foreach ($popularPosts as $popularPost): ?>
                                <div class="popular-post">
                                    <h4>
                                        <a href="/blog/post/<?php echo htmlspecialchars($popularPost['slug']); ?>">
                                            <?php echo htmlspecialchars($popularPost['title']); ?>
                                        </a>
                                    </h4>
                                    <span class="post-date">
                                        <?php echo date('M j, Y', strtotime($popularPost['published_at'])); ?>
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
                            <?php foreach ($recentPosts as $recentPost): ?>
                                <div class="recent-post">
                                    <h4>
                                        <a href="/blog/post/<?php echo htmlspecialchars($recentPost['slug']); ?>">
                                            <?php echo htmlspecialchars($recentPost['title']); ?>
                                        </a>
                                    </h4>
                                    <span class="post-date">
                                        <?php echo date('M j, Y', strtotime($recentPost['published_at'])); ?>
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
