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
				<h1>Manage Blog Posts</h1>
				<nav class="admin-nav">
					<a href="/admin">Dashboard</a>
					<a href="/admin/posts" class="active">Blog Posts</a>
					<a href="/admin/createPost" class="btn-primary" style="margin-left:auto;">Create Post</a>
				</nav>
			</div>
		</header>

		<main class="admin-main">
			<div class="container">
				<div class="posts-table-wrapper" style="background:#fff;border-radius:12px;padding:20px;box-shadow:0 4px 15px rgba(0,0,0,0.08)">
					<table class="posts-table" style="width:100%;border-collapse:collapse;">
						<thead>
							<tr style="text-align:left;border-bottom:1px solid #e5e7eb;">
								<th style="padding:12px;">Title</th>
								<th style="padding:12px;">Status</th>
								<th style="padding:12px;">Author</th>
								<th style="padding:12px;">Updated</th>
								<th style="padding:12px;text-align:right;">Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php if (empty($posts)): ?>
								<tr><td colspan="5" style="padding:18px;color:#666;">No posts yet. Click "Create Post" to add one.</td></tr>
							<?php else: foreach ($posts as $p): ?>
							<tr style="border-bottom:1px solid #f1f5f9;">
								<td style="padding:12px;">
									<strong><?php echo htmlspecialchars($p['title']); ?></strong>
									<div style="color:#64748b;font-size:12px;">/blog/post/<?php echo htmlspecialchars($p['slug']); ?></div>
								</td>
								<td style="padding:12px;">
									<span style="padding:6px 10px;border-radius:10px;background:<?php echo $p['status']==='published'?'#e6f6ee':'#f1f5f9'; ?>;color:<?php echo $p['status']==='published'?'#0a7a3e':'#475569'; ?>;">
										<?php echo ucfirst($p['status']); ?>
									</span>
								</td>
								<td style="padding:12px;"><?php echo htmlspecialchars($p['author_name'] ?? '—'); ?></td>
								<td style="padding:12px;">
									<?php echo htmlspecialchars($p['updated_at'] ?? $p['created_at'] ?? ''); ?>
								</td>
								<td style="padding:12px;text-align:right;white-space:nowrap;">
									<a href="/admin/editPost/<?php echo (int)$p['id']; ?>" class="btn-primary" style="padding:8px 12px;border-radius:8px;">Edit</a>
									<?php if ($p['status'] !== 'published'): ?>
										<form action="/admin/publish/<?php echo (int)$p['id']; ?>" method="post" style="display:inline;">
											<button type="submit" class="btn-primary" style="padding:8px 12px;border-radius:8px;background:#0ea5e9;">Publish</button>
										</form>
									<?php else: ?>
										<form action="/admin/unpublish/<?php echo (int)$p['id']; ?>" method="post" style="display:inline;">
											<button type="submit" class="btn-primary" style="padding:8px 12px;border-radius:8px;background:#64748b;">Unpublish</button>
										</form>
									<?php endif; ?>
									<form action="/admin/deletePost/<?php echo (int)$p['id']; ?>" method="post" style="display:inline;" onsubmit="return confirm('Delete this post?');">
										<button type="submit" class="btn-primary" style="padding:8px 12px;border-radius:8px;background:#ef4444;">Delete</button>
									</form>
								</td>
							</tr>
							<?php endforeach; endif; ?>
						</tbody>
					</table>
				</div>
			</div>
		</main>
	</div>
</body>
</html>
