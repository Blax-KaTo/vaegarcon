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
    <div class="setup-container">
        <div class="setup-card">
            <div class="setup-header">
                <i class="fas fa-user-shield"></i>
                <h1>Create Admin Account</h1>
                <p>Set up your administrator account to manage the system</p>
            </div>

            <?php if (isset($error)): ?>
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-triangle"></i>
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="setup-form">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken ?? ''); ?>">
                
                <div class="form-group">
                    <label for="username">
                        <i class="fas fa-user"></i>
                        Username
                    </label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        value="<?php echo htmlspecialchars($formData['username'] ?? ''); ?>"
                        placeholder="Enter username"
                        required
                    >
                    <?php if (isset($errors['username'])): ?>
                        <span class="error-text"><?php echo htmlspecialchars($errors['username']); ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="email">
                        <i class="fas fa-envelope"></i>
                        Email Address
                    </label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="<?php echo htmlspecialchars($formData['email'] ?? ''); ?>"
                        placeholder="Enter email address"
                        required
                    >
                    <?php if (isset($errors['email'])): ?>
                        <span class="error-text"><?php echo htmlspecialchars($errors['email']); ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="password">
                        <i class="fas fa-lock"></i>
                        Password
                    </label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        placeholder="Enter password (min 8 characters)"
                        required
                    >
                    <?php if (isset($errors['password'])): ?>
                        <span class="error-text"><?php echo htmlspecialchars($errors['password']); ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="confirm_password">
                        <i class="fas fa-lock"></i>
                        Confirm Password
                    </label>
                    <input 
                        type="password" 
                        id="confirm_password" 
                        name="confirm_password" 
                        placeholder="Confirm your password"
                        required
                    >
                    <?php if (isset($errors['confirm_password'])): ?>
                        <span class="error-text"><?php echo htmlspecialchars($errors['confirm_password']); ?></span>
                    <?php endif; ?>
                </div>

                <button type="submit" class="btn-primary btn-full">
                    <i class="fas fa-user-plus"></i>
                    Create Admin Account
                </button>
            </form>

            <div class="setup-footer">
                <p>Already have an account? <a href="/login">Login here</a></p>
            </div>
        </div>
    </div>

    <style>
        .setup-container {
            min-height: 100vh;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .setup-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        .setup-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .setup-header i {
            font-size: 4rem;
            color: var(--primary-color);
            margin-bottom: 20px;
        }

        .setup-header h1 {
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .setup-header p {
            color: #666;
            font-size: 1.1rem;
        }

        .setup-form {
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 8px;
        }

        .form-group input {
            width: 100%;
            padding: 15px;
            border: 2px solid #e1e5e9;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }

        .error-text {
            color: #e74c3c;
            font-size: 0.9rem;
            margin-top: 5px;
            display: block;
        }

        .alert {
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-error {
            background: #fdf2f2;
            color: #e74c3c;
            border: 1px solid #fecaca;
        }

        .btn-full {
            width: 100%;
            padding: 15px;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .setup-footer {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #e1e5e9;
        }

        .setup-footer a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
        }

        .setup-footer a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .setup-card {
                padding: 30px 20px;
            }
        }
    </style>
</body>
</html>