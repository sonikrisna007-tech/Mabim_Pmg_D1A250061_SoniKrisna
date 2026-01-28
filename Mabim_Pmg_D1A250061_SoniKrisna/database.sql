-- Database MABIM 2025
CREATE DATABASE IF NOT EXISTS mabim2025;
USE mabim2025;

-- Tabel users
CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nim VARCHAR(20) UNIQUE NOT NULL,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    nama_lengkap VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    fakultas VARCHAR(100) NOT NULL,
    jurusan VARCHAR(100),
    angkatan VARCHAR(10) NOT NULL DEFAULT '2025',
    role ENUM('admin', 'mahasiswa', 'panitia') DEFAULT 'mahasiswa',
    divisi VARCHAR(100),
    foto_profil VARCHAR(255),
    bio TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    last_login TIMESTAMP NULL,
    status ENUM('active', 'inactive', 'banned') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabel activities
CREATE TABLE IF NOT EXISTS activities (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    activity_type VARCHAR(50),
    description TEXT,
    ip_address VARCHAR(45),
    user_agent TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabel mabim_schedule
CREATE TABLE IF NOT EXISTS mabim_schedule (
    id INT PRIMARY KEY AUTO_INCREMENT,
    hari_ke INT NOT NULL,
    tanggal DATE NOT NULL,
    waktu_mulai TIME NOT NULL,
    waktu_selesai TIME NOT NULL,
    kegiatan VARCHAR(200) NOT NULL,
    lokasi VARCHAR(100),
    pemateri VARCHAR(100),
    kategori ENUM('logika', 'estetika', 'etika', 'umum') DEFAULT 'umum',
    deskripsi TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert admin default (password: admin123)
INSERT INTO users (nim, username, password, nama_lengkap, email, fakultas, jurusan, angkatan, role, divisi) VALUES
('202500001', 'admin2025', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator MABIM', 'admin@mabim2025.ac.id', 'Administrasi', 'Sistem Informasi', '2025', 'admin', 'Biro Administrasi'),
('202511001', 'budi2025', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Budi Santoso', 'budi@student.ac.id', 'Fakultas Ilmu Komputer', 'Ilmu Komputer', '2025', 'mahasiswa', NULL),
('202511002', 'sari2025', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Sari Dewi', 'sari@student.ac.id', 'Fakultas Ilmu Komputer', 'Sistem Informasi', '2025', 'mahasiswa', NULL),
('202500002', 'panitia2025', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Panitia MABIM', 'panitia@mabim2025.ac.id', 'Panitia MABIM', 'Organisasi', '2025', 'panitia', 'Acara');

-- Insert jadwal MABIM
INSERT INTO mabim_schedule (hari_ke, tanggal, waktu_mulai, waktu_selesai, kegiatan, lokasi, pemateri, kategori, deskripsi) VALUES
(1, '2025-08-01', '08:00:00', '09:00:00', 'Registrasi Peserta', 'Gedung Serba Guna', 'Panitia', 'etika', 'Pendaftaran dan pengecekan dokumen'),
(1, '2025-08-01', '09:00:00', '10:30:00', 'Pembukaan MABIM 2025', 'Auditorium Utama', 'Rektor', 'umum', 'Pembukaan resmi MABIM 2025'),
(1, '2025-08-01', '10:30:00', '12:00:00', 'Tour Kampus', 'Seluruh Kampus', 'Panitia', 'estetika', 'Pengenalan fasilitas kampus'),
(2, '2025-08-02', '08:00:00', '10:00:00', 'Workshop Logika & Problem Solving', 'Lab Komputer', 'Dr. Ahmad', 'logika', 'Melatih kemampuan berpikir kritis'),
(2, '2025-08-02', '10:30:00', '12:30:00', 'Sesi Estetika: Design Thinking', 'Studio Kreatif', 'Maya Sari, M.Ds.', 'estetika', 'Mengembangkan rasa keindahan dan kreativitas'),
(3, '2025-08-03', '08:00:00', '12:00:00', 'Games & Team Building', 'Lapangan Olahraga', 'Panitia', 'etika', 'Membangun kerjasama tim dan karakter');

-- Buat index untuk performa
CREATE INDEX idx_username ON users(username);
CREATE INDEX idx_email ON users(email);
CREATE INDEX idx_nim ON users(nim);
CREATE INDEX idx_activities_user ON activities(user_id);
CREATE INDEX idx_schedule_hari ON mabim_schedule(hari_ke);