<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: index.php');
    exit;
}

$username = htmlspecialchars($_SESSION['username']);
$login_time = date('d F Y H:i:s', $_SESSION['login_time']);
$current_time = date('d F Y H:i:s');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pasilkom - Dashboard</title>
    <link rel="icon" href="assets/img/profile.jpg">
    <link rel="stylesheet" href="assets/css/styles.css">
    <style>
        /* Reset beberapa style dari login page */
        body {
            background: linear-gradient(135deg, #1a2980, #26d0ce);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .dashboard-container {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 800px;
            padding: 40px 35px;
            position: relative;
            overflow: hidden;
            animation: fadeIn 0.8s ease-out;
        }
        
        .dashboard-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(to right, #1a2980, #26d0ce);
        }
        
        .welcome-header {
            text-align: center;
            margin-bottom: 40px;
            position: relative;
        }
        
        .welcome-header h1 {
            color: #1a2980;
            font-size: 2.5rem;
            font-weight: 700;
            letter-spacing: 1px;
            padding-bottom: 15px;
        }
        
        .welcome-header h1::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: linear-gradient(to right, #1a2980, #26d0ce);
            border-radius: 2px;
        }
        
        .user-info {
            background: linear-gradient(135deg, rgba(26, 41, 128, 0.1), rgba(38, 208, 206, 0.1));
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
            border-left: 5px solid #1a2980;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .info-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease;
        }
        
        .info-card:hover {
            transform: translateY(-5px);
        }
        
        .info-card h3 {
            color: #1a2980;
            margin-bottom: 15px;
            font-size: 1.3rem;
        }
        
        .info-card p {
            color: #555;
            line-height: 1.6;
        }
        
        .info-card .highlight {
            color: #1a2980;
            font-weight: 600;
            font-size: 1.1rem;
        }
        
        .logout-btn {
            display: block;
            width: 200px;
            margin: 40px auto 0;
            text-align: center;
            background: linear-gradient(to right, #1a2980, #26d0ce);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 15px 30px;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            box-shadow: 0 5px 15px rgba(26, 41, 128, 0.2);
        }
        
        .logout-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(26, 41, 128, 0.3);
        }
        
        .logout-btn:active {
            transform: translateY(0);
        }
        
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .logo h2 {
            color: #1a2980;
            font-size: 2.2rem;
            font-weight: 700;
            letter-spacing: 2px;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @media (max-width: 768px) {
            .dashboard-container {
                padding: 30px 20px;
                max-width: 95%;
            }
            
            .welcome-header h1 {
                font-size: 2rem;
            }
            
            .info-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="logo">
            <h2>PASILKOM</h2>
        </div>
        
        <div class="welcome-header">
            <h1>Selamat Datang, <?php echo $username; ?>!</h1>
        </div>
        
        <div class="user-info">
            <h3>Informasi Login Anda:</h3>
            <p>Username: <span class="highlight"><?php echo $username; ?></span></p>
            <p>Waktu Login: <span class="highlight"><?php echo $login_time; ?></span></p>
            <p>Waktu Sekarang: <span class="highlight"><?php echo $current_time; ?></span></p>
        </div>
        
        <div class="info-grid">
            <div class="info-card">
                <h3>📊 Dashboard Utama</h3>
                <p>Ini adalah halaman dashboard utama Pasilkom. Dari sini Anda dapat mengakses semua fitur dan layanan yang tersedia.</p>
            </div>
            
            <div class="info-card">
                <h3>🔐 Keamanan Akun</h3>
                <p>Pastikan Anda selalu logout setelah menggunakan sistem untuk menjaga keamanan akun Anda.</p>
            </div>
            
            <div class="info-card">
                <h3>📈 Statistik</h3>
                <p>Lihat statistik penggunaan dan aktivitas akun Anda dalam sistem Pasilkom.</p>
            </div>
            
            <div class="info-card">
                <h3>⚙️ Pengaturan</h3>
                <p>Kelola preferensi dan pengaturan akun Anda sesuai kebutuhan.</p>
            </div>
        </div>
        
        <div style="text-align: center; margin-top: 30px; color: #666;">
            <p>Anda telah berhasil login ke sistem Pasilkom</p>
            <p>Sesi login aktif sejak: <?php echo $login_time; ?></p>
        </div>
        
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</body>
</html>