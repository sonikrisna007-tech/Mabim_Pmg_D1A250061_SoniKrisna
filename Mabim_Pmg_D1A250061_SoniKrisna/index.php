<?php
session_start();

// Jika sudah login, redirect ke dashboard
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('Location: dashboard.php');
    exit;
}

// Pesan error jika login gagal
$error = '';
if (isset($_SESSION['login_error'])) {
    $error = $_SESSION['login_error'];
    unset($_SESSION['login_error']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pasilkom - Login</title>
    <link rel="icon" href="assets/img/profile.jpg">
    <link rel="stylesheet" href="assets/css/styles.css">
    <style>
        .error-message {
            color: #e74c3c;
            font-size: 0.9rem;
            margin-top: 5px;
            margin-bottom: 10px;
            text-align: center;
            padding: 8px;
            background-color: rgba(231, 76, 60, 0.1);
            border-radius: 5px;
            border-left: 3px solid #e74c3c;
        }
        .success-message {
            color: #2ecc71;
            font-size: 0.9rem;
            margin-top: 5px;
            margin-bottom: 10px;
            text-align: center;
            padding: 8px;
            background-color: rgba(46, 204, 113, 0.1);
            border-radius: 5px;
            border-left: 3px solid #2ecc71;
        }
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }
        .shake {
            animation: shake 0.5s;
        }
    </style>
</head>
<body>
    <div class="login-class">
        <h2>LOGIN</h2>
        
        <?php if ($error): ?>
            <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <?php if (isset($_GET['logout']) && $_GET['logout'] == 'success'): ?>
            <div class="success-message">Logout berhasil! Sampai jumpa kembali.</div>
        <?php endif; ?>
        
        <form action="process_login.php" method="POST">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" placeholder="Masukkan username" required>
            
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Masukkan password" required>
            
            <input type="submit" value="Login">
        </form>
        
        <div style="text-align: center; margin-top: 20px; font-size: 0.9rem; color: #666;">
            <p>Demo credentials:</p>
            <p>Username: <strong>admin</strong></p>
            <p>Password: <strong>password123</strong></p>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const usernameInput = document.getElementById('username');
            const passwordInput = document.getElementById('password');
            const submitButton = document.querySelector('input[type="submit"]');
            
            <?php if ($error): ?>
                // Tambah efek shake jika ada error
                form.classList.add('shake');
                setTimeout(() => {
                    form.classList.remove('shake');
                }, 500);
            <?php endif; ?>
            
            // Fokus ke username input
            usernameInput.focus();
            
            // Validasi client-side
            form.addEventListener('submit', function(e) {
                let valid = true;
                
                // Reset error styles
                usernameInput.style.borderColor = '#e0e0e0';
                passwordInput.style.borderColor = '#e0e0e0';
                
                // Validasi username
                if (usernameInput.value.trim().length < 3) {
                    usernameInput.style.borderColor = '#e74c3c';
                    valid = false;
                }
                
                // Validasi password
                if (passwordInput.value.length < 6) {
                    passwordInput.style.borderColor = '#e74c3c';
                    valid = false;
                }
                
                if (!valid) {
                    e.preventDefault();
                    form.classList.add('shake');
                    setTimeout(() => {
                        form.classList.remove('shake');
                    }, 500);
                }
            });
        });
    </script>
</body>
</html>