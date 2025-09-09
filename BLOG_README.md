# Vaegarcon Blog System

This document describes the blog system implementation for the Vaegarcon website.

## Features

- **Blog Posts**: Create, edit, and manage blog posts with categories and tags
- **Categories**: Organize posts into categories (Fuel Management, Telemetry, Industry Insights, etc.)
- **Search**: Full-text search across post titles, content, and tags
- **Responsive Design**: Mobile-friendly blog layout
- **Admin Panel**: Simple admin interface for managing posts
- **SEO Friendly**: Clean URLs, meta descriptions, and structured content
- **Social Sharing**: Built-in social media sharing buttons
- **Related Posts**: Automatic related post suggestions
- **Pagination**: Navigate through multiple pages of posts

## Database Structure

The blog system uses the following database tables:

### `blog_posts`
- `id`: Primary key
- `title`: Post title
- `slug`: URL-friendly version of title
- `excerpt`: Short description/excerpt
- `content`: Full post content (HTML)
- `featured_image`: Optional featured image URL
- `author_id`: Reference to users table
- `status`: Post status (draft, published, archived)
- `published_at`: Publication date
- `created_at`: Creation timestamp
- `updated_at`: Last update timestamp
- `meta_title`: SEO meta title
- `meta_description`: SEO meta description
- `tags`: Comma-separated tags
- `view_count`: Number of views

### `blog_categories`
- `id`: Primary key
- `name`: Category name
- `slug`: URL-friendly category name
- `description`: Category description
- `parent_id`: Parent category (for hierarchical categories)
- `created_at`: Creation timestamp

### `blog_post_categories`
- `post_id`: Reference to blog_posts
- `category_id`: Reference to blog_categories

## URL Structure

- **Blog Home**: `/blog`
- **Individual Post**: `/blog/post/{slug}`
- **Category View**: `/blog/category/{category-slug}`
- **Search Results**: `/blog/search?q={query}`
- **Admin Dashboard**: `/admin`
- **Manage Posts**: `/admin/posts`
- **Create Post**: `/admin/createPost`
- **Edit Post**: `/admin/editPost/{id}`

## Installation & Setup

### 1. Database Setup
Run the SQL commands in `database/vaegarcon_db.sql` to create the necessary tables and sample data.

### 2. File Structure
Ensure the following files are in place:
```
controllers/
├── BlogController.php
├── AdminController.php
└── BaseController.php

models/
└── BlogModel.php

views/
└── blog/
    ├── index.php
    ├── post.php
    ├── category.php
    └── search.php

views/admin/
└── dashboard.php
```

### 3. Configuration
The system uses the existing configuration in `includes/config.php`. Ensure the database connection is properly configured.

## Usage

### For Visitors

#### Browsing Posts
- Visit `/blog` to see all published posts
- Use the search bar to find specific content
- Click on categories to filter posts
- Navigate through pages using pagination

#### Reading Posts
- Click on any post title to read the full article
- Use social sharing buttons to share posts
- View related posts at the bottom of each article
- Subscribe to the newsletter using the sidebar form

### For Administrators

#### Accessing Admin Panel
1. Navigate to `/admin`
2. You must be logged in as an admin user
3. Default admin credentials:
   - Username: `admin`
   - Password: `admin123`

#### Managing Posts
1. **View All Posts**: `/admin/posts`
2. **Create New Post**: `/admin/createPost`
3. **Edit Existing Post**: `/admin/editPost/{id}`
4. **Delete Post**: Use the delete button in the posts list

#### Creating/Editing Posts
- **Title**: Required. Will be used to generate the URL slug
- **Excerpt**: Optional short description
- **Content**: Full post content (supports HTML)
- **Status**: Choose between draft, published, or archived
- **Categories**: Select one or more categories
- **Tags**: Comma-separated tags for better organization

## Customization

### Styling
Blog styles are included in `css/styles.css`. Key CSS classes:
- `.blog-container`: Main blog wrapper
- `.blog-post-card`: Individual post cards
- `.blog-sidebar`: Right sidebar
- `.blog-pagination`: Navigation between pages

### Adding New Categories
1. Insert new category into `blog_categories` table
2. The system will automatically pick up new categories

### Modifying Post Display
Edit the view files in `views/blog/` to change how posts are displayed.

## Security Features

- **SQL Injection Protection**: All database queries use prepared statements
- **XSS Protection**: Output is properly escaped using `htmlspecialchars()`
- **Admin Access Control**: Admin functions require proper authentication
- **Input Validation**: Form inputs are validated before processing

## Performance Considerations

- **Pagination**: Posts are loaded in batches (6 per page by default)
- **Database Indexing**: Ensure proper indexes on frequently queried fields
- **Image Optimization**: Featured images should be properly sized and compressed
- **Caching**: Consider implementing caching for frequently accessed content

## Future Enhancements

- **Comments System**: Allow visitors to comment on posts
- **User Registration**: Allow users to create accounts and subscribe
- **Email Notifications**: Send notifications for new posts
- **Analytics Dashboard**: Track post performance and visitor engagement
- **Image Management**: Built-in image upload and management
- **SEO Tools**: Advanced SEO optimization features
- **Multi-language Support**: Internationalization for multiple languages

## Troubleshooting

### Common Issues

1. **Posts Not Displaying**
   - Check if posts have `status = 'published'`
   - Verify database connection
   - Check for PHP errors in logs

2. **Admin Access Denied**
   - Ensure user is logged in
   - Verify user has admin role
   - Check session configuration

3. **Categories Not Working**
   - Verify `blog_post_categories` table has proper relationships
   - Check if categories exist in `blog_categories` table

4. **Search Not Working**
   - Ensure search form points to `/blog/search`
   - Check if search query parameter is being passed

### Debug Mode
Enable error reporting in `includes/config.php` for development:
```php
ini_set('display_errors', 1);
error_reporting(E_ALL);
```

## Support

For technical support or questions about the blog system, please contact the development team or refer to the main project documentation.

---

**Note**: This blog system is designed to integrate seamlessly with the existing Vaegarcon website. All styling and functionality follows the established design patterns and coding standards.
