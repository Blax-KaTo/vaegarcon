<?php include VIEWS_PATH . '/layouts/header.php'; ?>

<div class="blog-container">
	<div class="container">
		<div class="blog-content" style="display:block;">
			<div class="blog-main" style="max-width:520px;margin:0 auto;">
				<h1 style="text-align:center;">Admin Login</h1>

				<?php if (!empty($errors['general'])): ?>
					<div style="background:#fee2e2;color:#991b1b;padding:12px;border-radius:8px;margin:10px 0;">
						<?php echo htmlspecialchars($errors['general']); ?>
					</div>
				<?php endif; ?>

				<form method="post" action="" style="display:grid;gap:14px;">
					<label>Username
						<input type="text" name="username" value="<?php echo htmlspecialchars($formData['username'] ?? ''); ?>" required style="width:100%;padding:12px;border:1px solid #e5e7eb;border-radius:8px;">
					</label>
					<?php if (!empty($errors['username'])): ?><div style="color:#b91c1c;font-size:12px;"><?php echo htmlspecialchars($errors['username']); ?></div><?php endif; ?>

					<label>Password
						<input type="password" name="password" required style="width:100%;padding:12px;border:1px solid #e5e7eb;border-radius:8px;">
					</label>
					<?php if (!empty($errors['password'])): ?><div style="color:#b91c1c;font-size:12px;"><?php echo htmlspecialchars($errors['password']); ?></div><?php endif; ?>

					<button type="submit" class="btn-primary" style="width:100%;">Login</button>
				</form>
			</div>
		</div>
	</div>
</div>

<?php include VIEWS_PATH . '/layouts/footer.php'; ?>
