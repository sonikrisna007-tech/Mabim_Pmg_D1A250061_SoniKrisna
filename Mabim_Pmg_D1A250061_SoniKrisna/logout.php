<?php
session_start();

// Hapus semua session
$_SESSION = array();

// Hapus session cookie
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600, '/');
}

// Hancurkan session
session_destroy();

// Redirect ke halaman login dengan pesan logout berhasil
header('Location: index.php?logout=success');
exit;
?>