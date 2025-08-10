<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Fresh Veggies</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="assets/css/auth-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

    <div class="auth-hero-container">
        <div class="auth-form-container">
            <a href="index.php" class="brand-logo"><i class="fas fa-leaf"></i></a>
            <h2>Create Your Account</h2>
            
            <form action="backend/register_process.php" method="post">
                <div class="input-group">
                    <i class="fas fa-user input-icon"></i>
                    <input type="text" name="name" class="form-input" required placeholder="Full Name">
                </div>

                <div class="input-group">
                    <i class="fas fa-envelope input-icon"></i>
                    <input type="email" name="email" class="form-input" required placeholder="Email Address">
                </div>
                
                <div class="input-group">
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" name="password" id="password" class="form-input" required placeholder="Create Password">
                    <i class="fas fa-eye password-toggle" id="togglePassword"></i>
                </div>
                
                <div class="input-group">
                    <i class="fas fa-store input-icon"></i>
                    <select name="user_type" class="form-input" required>
                        <option value="" disabled selected>Register as a...</option>
                        <option value="buyer">Buyer (I want to buy)</option>
                        <option value="seller">Seller (I want to sell)</option>
                    </select>
                </div>

                <button type="submit" class="submit-button">Create Account</button>
            </form>

            <p class="bottom-text">Already have an account? <a href="login.php">Login here</a></p>
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