<?php
session_start();

// Data user contoh (dalam aplikasi nyata, data ini biasanya diambil dari database)
$valid_users = [
    'admin' => 'password123',
    'user' => 'user123',
    'test' => 'test123'
];

// Ambil data dari form
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Validasi input
if (empty($username) || empty($password)) {
    $_SESSION['login_error'] = 'Username dan password harus diisi!';
    header('Location: index.php');
    exit;
}

// Cek apakah user ada dan password cocok
if (isset($valid_users[$username]) && $valid_users[$username] === $password) {
    // Login berhasil
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username;
    $_SESSION['login_time'] = time();
    
    // Redirect ke dashboard
    header('Location: dashboard.php');
    exit;
} else {
    // Login gagal
    $_SESSION['login_error'] = 'Username atau password salah!';
    header('Location: index.php');
    exit;
}
?>