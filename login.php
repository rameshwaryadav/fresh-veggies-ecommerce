<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Fresh Veggies</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="assets/css/auth-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

    <div class="auth-hero-container">
        <div class="auth-form-container">
            <a href="index.php" class="brand-logo"><i class="fas fa-leaf"></i></a>
            <h2>Welcome Back!</h2>
            
            <?php if(isset($_GET['status']) && $_GET['status'] == 'success'): ?>
                <p class="success-message">Registration successful! Please login.</p>
            <?php endif; ?>
            
            <form action="backend/login_process.php" method="post">
                <div class="input-group">
                    <i class="fas fa-envelope input-icon"></i>
                    <input type="email" name="email" class="form-input" required placeholder="Email Address">
                </div>

                <div class="input-group">
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" name="password" id="password" class="form-input" required placeholder="Password">
                    <i class="fas fa-eye password-toggle" id="togglePassword"></i>
                </div>

                <button type="submit" class="submit-button">Login Securely</button>
            </form>

            <div class="or-separator">or</div>

            <div class="social-login-buttons">
                <a href="#" class="social-btn google"><i class="fab fa-google"></i> Google</a>
                <a href="#" class="social-btn facebook"><i class="fab fa-facebook-f"></i> Facebook</a>
            </div>

            <p class="bottom-text">Don't have an account? <a href="register.php">Sign up</a></p>
        </div>
    </div>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        togglePassword.addEventListener('click', function (e) {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });
    </script>

</body>
</html>