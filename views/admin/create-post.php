<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $pageTitle; ?></title>
	<link rel="stylesheet" href="/css/styles.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
	<div class="admin-container">
		<header class="admin-header">
			<div class="container">
				<h1>Create Blog Post</h1>
				<nav class="admin-nav">
					<a href="/admin">Dashboard</a>
					<a href="/admin/posts">Blog Posts</a>
				</nav>
			</div>
		</header>

		<main class="admin-main">
			<div class="container">
				<form method="post" action="" class="admin-form" style="background:#fff;border-radius:12px;padding:20px;box-shadow:0 4px 15px rgba(0,0,0,0.08);max-width:900px;">
					<div style="display:grid;gap:16px;">
						<label>Title
							<input type="text" name="title" value="<?php echo htmlspecialchars($formData['title'] ?? ''); ?>" required style="width:100%;padding:10px;border:1px solid #e5e7eb;border-radius:8px;">
						</label>
						<label>Slug (auto-generated)
							<input type="text" name="slug" value="<?php echo htmlspecialchars($formData['slug'] ?? ''); ?>" placeholder="auto" style="width:100%;padding:10px;border:1px solid #e5e7eb;border-radius:8px;">
						</label>
						<label>Excerpt
							<textarea name="excerpt" rows="3" style="width:100%;padding:10px;border:1px solid #e5e7eb;border-radius:8px;"><?php echo htmlspecialchars($formData['excerpt'] ?? ''); ?></textarea>
						</label>
						<label>Content
							<textarea name="content" rows="12" required style="width:100%;padding:10px;border:1px solid #e5e7eb;border-radius:8px;"><?php echo htmlspecialchars($formData['content'] ?? ''); ?></textarea>
						</label>
						<label>Status
							<select name="status" required style="width:100%;padding:10px;border:1px solid #e5e7eb;border-radius:8px;">
								<?php $st = $formData['status'] ?? 'draft'; ?>
								<option value="draft" <?php echo $st==='draft'?'selected':''; ?>>Draft</option>
								<option value="published" <?php echo $st==='published'?'selected':''; ?>>Published</option>
								<option value="archived" <?php echo $st==='archived'?'selected':''; ?>>Archived</option>
							</select>
						</label>
						<label>Categories
							<select name="categories[]" multiple style="width:100%;padding:10px;border:1px solid #e5e7eb;border-radius:8px;min-height:120px;">
								<?php foreach ($categories as $cat): ?>
									<option value="<?php echo (int)$cat['id']; ?>"><?php echo htmlspecialchars($cat['name']); ?></option>
								<?php endforeach; ?>
							</select>
						</label>
						<label>Tags (comma separated)
							<input type="text" name="tags" value="<?php echo htmlspecialchars($formData['tags'] ?? ''); ?>" style="width:100%;padding:10px;border:1px solid #e5e7eb;border-radius:8px;">
						</label>
						<div>
							<button type="submit" class="btn-primary">Save Post</button>
							<a href="/admin/posts" class="btn-primary" style="background:#64748b;">Cancel</a>
						</div>
					</div>
				</form>
			</div>
		</main>
	</div>
</body>
</html>
