-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 17, 2026 at 03:01 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_simulasi_pbo_ti-1c_farissholahhasana`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_pendaftaran`
--

CREATE TABLE `tabel_pendaftaran` (
  `id_pendaftaran` int NOT NULL,
  `nama_calon` varchar(100) NOT NULL,
  `asal_sekolah` varchar(150) NOT NULL,
  `nilai_ujian` decimal(5,2) NOT NULL,
  `biaya_pendaftaran_dasar` decimal(10,2) NOT NULL,
  `jalur_pendaftaran` enum('Reguler','Prestasi','Kedinasan') NOT NULL,
  `pilihan_prodi` varchar(100) DEFAULT NULL,
  `lokasi_kampus` varchar(100) DEFAULT NULL,
  `jenis_prestasi` varchar(100) DEFAULT NULL,
  `tingkat_prestasi` varchar(100) DEFAULT NULL,
  `sk_ikatan_dinas` varchar(50) DEFAULT NULL,
  `instansi_sponsor` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tabel_pendaftaran`
--

INSERT INTO `tabel_pendaftaran` (`id_pendaftaran`, `nama_calon`, `asal_sekolah`, `nilai_ujian`, `biaya_pendaftaran_dasar`, `jalur_pendaftaran`, `pilihan_prodi`, `lokasi_kampus`, `jenis_prestasi`, `tingkat_prestasi`, `sk_ikatan_dinas`, `instansi_sponsor`) VALUES
(1, 'Budi Santoso', 'SMA Negeri 1 Jakarta', '75.50', '500000.00', 'Reguler', 'Teknik Informatika', 'Jakarta', NULL, NULL, NULL, NULL),
(2, 'Sinta Dewi', 'SMA Negeri 2 Bandung', '72.30', '500000.00', 'Reguler', 'Teknik Sipil', 'Bandung', NULL, NULL, NULL, NULL),
(3, 'Rafi Pratama', 'SMA Negeri 3 Surabaya', '78.75', '500000.00', 'Reguler', 'Akuntansi', 'Surabaya', NULL, NULL, NULL, NULL),
(4, 'Maya Kusuma', 'SMA Negeri 1 Medan', '68.40', '500000.00', 'Reguler', 'Sistem Informasi', 'Jakarta', NULL, NULL, NULL, NULL),
(5, 'Doni Wijaya', 'SMA Negeri 4 Yogyakarta', '81.20', '500000.00', 'Reguler', 'Teknik Mesin', 'Yogyakarta', NULL, NULL, NULL, NULL),
(6, 'Lina Hartati', 'SMA Negeri 2 Makassar', '73.60', '500000.00', 'Reguler', 'Manajemen', 'Makassar', NULL, NULL, NULL, NULL),
(7, 'Andi Gunawan', 'SMA Negeri 1 Palembang', '76.85', '500000.00', 'Reguler', 'Teknik Elektro', 'Jakarta', NULL, NULL, NULL, NULL),
(8, 'Cindy Lestari', 'SMA Negeri 3 Bandung', '79.45', '500000.00', 'Reguler', 'Psikologi', 'Bandung', NULL, NULL, NULL, NULL),
(9, 'Siti Nurhaliza', 'SMA Negeri 5 Bandung', '92.00', '500000.00', 'Prestasi', 'Teknik Informatika', 'Bandung', 'Olimpiade Matematika', 'Nasional', NULL, NULL),
(10, 'Fajar Hermawan', 'SMA Negeri 2 Jakarta', '88.75', '500000.00', 'Prestasi', 'Teknik Fisika', 'Jakarta', 'Kompetisi Robotika', 'Internasional', NULL, NULL),
(11, 'Eka Putri', 'SMA Negeri 1 Yogyakarta', '90.30', '500000.00', 'Prestasi', 'Biologi', 'Yogyakarta', 'Olimpiade Sains', 'Nasional', NULL, NULL),
(12, 'Hendra Kusuma', 'SMA Negeri 3 Surabaya', '85.60', '500000.00', 'Prestasi', 'Akuntansi', 'Surabaya', 'Kompetisi Esai', 'Lokal', NULL, NULL),
(13, 'Nadia Islamiah', 'SMA Negeri 2 Medan', '87.40', '500000.00', 'Prestasi', 'Teknik Informatika', 'Jakarta', 'Olimpiade Kimia', 'Nasional', NULL, NULL),
(14, 'Rian Prakoso', 'SMA Negeri 4 Bandung', '91.15', '500000.00', 'Prestasi', 'Teknik Mesin', 'Bandung', 'Lomba Karya Tulis', 'Internasional', NULL, NULL),
(15, 'Ahmad Wijaya', 'SMA Negeri 3 Surabaya', '88.75', '500000.00', 'Kedinasan', 'Administrasi Publik', 'Surabaya', NULL, NULL, 'SK-2024-001', 'Kementerian Dalam Negeri'),
(16, 'Dwi Hartono', 'SMA Negeri 1 Jakarta', '82.50', '500000.00', 'Kedinasan', 'Hukum Administrasi', 'Jakarta', NULL, NULL, 'SK-2024-002', 'Badan Kepegawaian Negara'),
(17, 'Rina Handoko', 'SMA Negeri 2 Bandung', '85.30', '500000.00', 'Kedinasan', 'Ekonomi Pembangunan', 'Bandung', NULL, NULL, 'SK-2024-003', 'Kementerian Keuangan'),
(18, 'Banu Setiawan', 'SMA Negeri 5 Yogyakarta', '83.90', '500000.00', 'Kedinasan', 'Manajemen Publik', 'Yogyakarta', NULL, NULL, 'SK-2024-004', 'Kementerian Pekerjaan Umum'),
(19, 'Titi Nurwijaya', 'SMA Negeri 4 Medan', '84.65', '500000.00', 'Kedinasan', 'Akuntansi Publik', 'Jakarta', NULL, NULL, 'SK-2024-005', 'Inspektorat Jenderal'),
(20, 'Wahyu Santoso', 'SMA Negeri 1 Makassar', '80.20', '500000.00', 'Kedinasan', 'Ilmu Administrasi', 'Makassar', NULL, NULL, 'SK-2024-006', 'Kementerian Kesehatan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_pendaftaran`
--
ALTER TABLE `tabel_pendaftaran`
  ADD PRIMARY KEY (`id_pendaftaran`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_pendaftaran`
--
ALTER TABLE `tabel_pendaftaran`
  MODIFY `id_pendaftaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
