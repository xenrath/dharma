-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 04, 2024 at 08:50 AM
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
-- Database: `dharma`
--

-- --------------------------------------------------------

--
-- Table structure for table `bukus`
--

CREATE TABLE `bukus` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `tahun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `isbn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penerbit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bukus`
--

INSERT INTO `bukus` (`id`, `user_id`, `tahun`, `judul`, `isbn`, `jumlah`, `penerbit`, `file`, `created_at`, `updated_at`) VALUES
(1, 29, '2023', 'Keperawatan Medikal Bedah: Teori dan Praktik Laboratorium Jilid 1', '978-623-487-538-6', '81', 'Eureka Media Aksara', NULL, '2024-11-25 01:37:02', '2024-11-25 01:37:02'),
(2, 68, '2022', 'Buku Panduan Praktikum Anatomi Fisiologi', '978-602-9263-15-2', '36', 'Rohima Press', 'buku/24112508475439.pdf', '2024-11-25 01:47:54', '2024-11-25 01:47:54'),
(3, 48, '2017', 'Buku Ajar Anatomi Fisiologi Manusia', '978-602-8873-63-5', '72', 'Pustaka Rihama', 'buku/24112508570485.pdf', '2024-11-25 01:57:04', '2024-11-25 01:57:04'),
(4, 48, '2021', 'Studi Literatur: Efek Toksik Methanyl Yellow', '978-623-6140-53-6', '52', 'Pustaka Rumah Cinta', 'buku/24112508582512.pdf', '2024-11-25 01:58:25', '2024-11-25 01:58:25'),
(5, 38, '2022', 'Latihan Soal Uji Kompetensi D III dan Profesi Bidan Jilid 2', '978-625-97910-2-5', '232', 'PT. Mahakarya Citra Utama Grup', NULL, '2024-11-25 01:59:15', '2024-11-25 01:59:15'),
(6, 38, '2022', 'Latihan Soal Uji Kompetensi Profesi Bidan Jilid I', '978-623-97910-8-7', '217', 'PT. Mahakarya Citra Utama Grup', NULL, '2024-11-25 02:00:19', '2024-11-25 02:00:19'),
(7, 38, '2023', 'Sukses UKOM DIII Kebidanan', '978-623-09-0621-3', '60', 'PT Nuansa Fajar Cemerlang', 'buku/24112509031347.pdf', '2024-11-25 02:03:13', '2024-11-25 02:03:13'),
(8, 38, '2023', 'Buku Ajar Asuhan Kebidanan Bayi dan Balita DIII Kebidanan', '978-623-8118-35-9', '119', 'Mahakarya Citra Utama', 'buku/24112509053029.pdf', '2024-11-25 02:05:30', '2024-11-25 02:05:30'),
(9, 38, '2023', 'Asuhan Kebidanan Kasus Fisiologis Pada Bayi, Balita dan Anak Pra Sekolah', '978-623-88659-3-2', '161', 'Nuansa Fajar Cemerlang Jakarta', NULL, '2024-11-25 02:06:41', '2024-11-25 02:06:41'),
(10, 38, '2023', 'Konsep Kebidanan', '978-623-8083-54-1', '94', 'Yayasan Wiyata Bestari Samasta', 'buku/24112509083832.pdf', '2024-11-25 02:08:38', '2024-11-25 02:08:38'),
(11, 38, '2023', 'Evidance Based Soal Kasus Kebidanan Komunitas V', '978-623-88564-7-3', '310', 'Nuansa Fajar Cemerlang Jakarta', NULL, '2024-11-25 02:09:48', '2024-11-25 02:09:48'),
(12, 50, '2022', 'PETUNJUK PRAKTIKUM KIMIA ORGANIK II', '978-602-8873-24-6', '28', 'Pustaka Rihama', 'buku/24112509113114.pdf', '2024-11-25 02:11:31', '2024-11-25 02:11:31'),
(13, 50, '2022', 'PETUNJUK PRAKTIKUM BIOKIMIA', '978-602-8873-09-3', '48', 'Pustaka Rihama', NULL, '2024-11-25 02:13:07', '2024-11-25 02:13:07'),
(14, 50, '2022', 'PETUNJUK PRAKTIKUM KIMIA FARMASI ANALISIS I', '978-602-8873-42-0', '40', 'Pustaka Rihama', 'buku/24112509143493.pdf', '2024-11-25 02:14:34', '2024-11-25 02:14:34'),
(15, 43, '2022', 'Buku Latihan Soal Uji Kompetensi DIII dan Profesi Bidan Jilid 2', '928-623-97910-2-5', '232', 'PT. Mahakarya Citra Utama Grup', 'buku/24112509165225.pdf', '2024-11-25 02:16:52', '2024-11-25 02:16:52'),
(16, 43, '2022', 'Buku Latihan Soal Uji Kompetensi DIII Bidan Jilid 1', '978-623-99869-1-9', '217', 'PT. Mahakarya Citra Utama Grup', 'buku/24112509183142.pdf', '2024-11-25 02:18:31', '2024-11-25 02:18:31'),
(17, 43, '2023', 'Evidance Based Soal Kasus Kebidanan Komunitas', '978-623-09-1888-9', '171', 'Nuansa Fajar Cemerlang Jakarta', 'buku/24112509201735.pdf', '2024-11-25 02:20:17', '2024-11-25 02:20:17'),
(18, 43, '2024', 'Diagnosa Masalah Dalam Lingkup Asuhan Kebidanan Pada Bayi, Balita Dan Anak Pra sekolah', '978-623-8411-18-4', '241', 'Penerbit Nuansa Fajar Cemerlang Jakarta', 'buku/24112509211054.pdf', '2024-11-25 02:21:10', '2024-11-25 02:21:10'),
(19, 43, '2023', 'Buku Pemeriksaan Fisik dan Uji Diagnostik Kebidanan', '978-623-09-7895-1', '256', 'PT. Adikarya Pratama Globalindo', 'buku/24112509231112.pdf', '2024-11-25 02:23:11', '2024-11-25 02:23:11'),
(20, 47, '2013', 'Buku Petunjuk Praktikum Anatomi Fisiologi Manusia', '978-602-8873-16-1', '28', 'Pustaka Rihama', 'buku/24112509243159.pdf', '2024-11-25 02:24:31', '2024-11-25 02:24:31'),
(21, 47, '2013', 'Buku petunjuk praktek Botani Farmasi', '978-602-8873-14-7', '48', 'Pustaka Rihama', 'buku/24112509331284.pdf', '2024-11-25 02:33:12', '2024-11-25 02:33:12'),
(22, 47, '2014', 'Buku petunjuk praktek farmasetika', '978-602-8873-18-5', '76', 'Pustaka Rihama', 'buku/24112509402398.pdf', '2024-11-25 02:40:23', '2024-11-25 02:40:23'),
(23, 46, '2022', 'Petunjuk Praktikum Mikrobiologi', '978-602-8873-53-6', '40', 'Pustaka Rihama', NULL, '2024-11-25 02:41:21', '2024-11-25 02:41:21'),
(24, 46, '2014', 'Petunjuk Praktikum Farmakognosi', '978-602-8873-19-2', '84', 'Pustaka Rihama', 'buku/24112509424479.pdf', '2024-11-25 02:42:44', '2024-11-25 02:42:44'),
(25, 52, '2022', 'Buku Praktikum Kimia Dasar', '978-602-8873-15-4', '48', 'Pustaka Rihama', NULL, '2024-11-25 02:44:08', '2024-11-25 02:44:08'),
(26, 52, '2022', 'PETUNJUK PRAKTIKUM KIMIA ANALISA I', '978-602-8873-25-3', '24', 'Pustaka Rihama', 'buku/24112509452799.pdf', '2024-11-25 02:45:27', '2024-11-25 02:45:27'),
(27, 37, '2022', 'Modul Pengantar Kebidanan', '978-602-280-163-4', '110', 'Deepublish', NULL, '2024-11-25 02:46:29', '2024-11-25 02:46:29'),
(28, 49, '2022', 'Petunjuk praktikum fitokimia 1', '978-602-8873-23-9', '32', 'Pustaka Rihama', 'buku/24112509475764.pdf', '2024-11-25 02:47:57', '2024-11-25 02:47:57'),
(29, 49, '2022', 'Petunjuk Praktikum Teknologi Sediaan Farmasi Semi Solid dan Liquid', '978-602-8873-53-6', '48', 'Pustaka Rihama', 'buku/24112509492246.pdf', '2024-11-25 02:49:22', '2024-11-25 02:49:22'),
(30, 49, '2022', 'petunjuk praktikum teknologi sediaan farmasi solid', '978-602-8873-41-3', '64', 'Pustaka Rihama', NULL, '2024-11-25 02:50:39', '2024-11-25 02:50:39'),
(31, 54, '2022', 'Buku Petunjuk Praktikum Kimia fisika', '978-602-8873-43-7', '24', 'Pustaka Rihama', 'buku/24112509515787.pdf', '2024-11-25 02:51:57', '2024-11-25 02:51:57'),
(32, 54, '2022', 'Buku Praktikum Farmakologi II', '978-602-8873-26-0', '60', 'Pustaka Rihama', 'buku/24112509532634.pdf', '2024-11-25 02:53:26', '2024-11-25 02:53:26'),
(33, 79, '2024', 'DASAR-DASAR KEWIRAUSAHAAN (Teori dan Panduan Berwirausaha)', '978-623-8634-51-4', '238', 'PT. Sonpedia Publishing Indonesia', 'buku/24112509573675.pdf', '2024-11-25 02:57:36', '2024-11-25 02:57:36'),
(34, 79, '2023', 'Konsep Dasar Kewirausahaan', '978-623-167-204-9', '74', 'PT. Pena Persada Kerta Utama', 'buku/24112510011135.pdf', '2024-11-25 03:01:11', '2024-11-25 03:01:11'),
(35, 79, '2023', 'MANAJEMEN OPERASI (Inovasi, Peluang, dan Tantangan Ekonomi Kreatif di Indonesia)', '978-623-8483-11-2', '265', 'PT. Sonpedia Publishing Indonesia', 'buku/24112510031662.pdf', '2024-11-25 03:03:16', '2024-11-25 03:03:16'),
(36, 79, '2024', 'PERILAKU KEORGANISASIAN', '978-623-8483-11-2', '138', 'GET PRESS', 'buku/24112510052615.pdf', '2024-11-25 03:05:26', '2024-11-25 03:05:26'),
(37, 77, '2023', 'Pengantar kewirausahaan', '9786237000877', '157', 'CV Seribu Bintang', 'buku/24112510083797.pdf', '2024-11-25 03:08:38', '2024-11-25 03:08:38'),
(38, 41, '2024', 'Buku lengkap Penananganan Fermasalahan Persalinan Fisiologis', '978-623-8411-16-0', '137', 'Nuansa Fajar Gemilang Jakarta', 'buku/24112510104638.pdf', '2024-11-25 03:10:46', '2024-11-25 03:10:46'),
(39, 69, '2022', 'Bahasa Indonesia untuk Akademik', '978-602-8873-57-4', '127', 'Pustaka Rihama', NULL, '2024-11-25 03:13:13', '2024-11-25 03:13:13'),
(40, 75, '2023', 'Sistem Pendukung Keputusan', '978-623-8345-69-4', '139', 'PT. Sonpedia Publishing Indonesia', 'buku/24112510144191.pdf', '2024-11-25 03:14:41', '2024-11-25 03:14:41'),
(41, 75, '2023', 'Buku Ajar Pengantar Basis Data', '978-623-8417-66-7', '174', 'PT. Sonpedia Publishing Indonesia', 'buku/24112510164447.pdf', '2024-11-25 03:16:45', '2024-11-25 03:16:45'),
(42, 79, '2023', 'KONSEP DASAR KEWIRAUSAHAAN', '978-623-167-204-9', '74', 'PT Pena Persada kerta utama', 'buku/24112510201990.pdf', '2024-11-25 03:20:19', '2024-11-25 03:20:19'),
(43, 79, '2023', 'Manajemen Operasi : Inovasi, Peluang, Tantangan Ekonomi Kreatif DI Indonesia', '9786238483112', '265', 'PT. Sonpedia Publising Indonesia', 'buku/24112511485499.pdf', '2024-11-25 04:48:54', '2024-11-25 04:48:54'),
(44, 79, '2024', 'DASAR-DASAR KEWIRAUSAHAAN (Teori dan Panduan Berwirausaha)', '978-623-8634-51-4', '227', 'PT. Sonpedia Publishing Indonesia', NULL, '2024-11-25 04:51:31', '2024-11-25 04:51:31');

-- --------------------------------------------------------

--
-- Table structure for table `buku_personels`
--

CREATE TABLE `buku_personels` (
  `id` bigint UNSIGNED NOT NULL,
  `buku_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buku_personels`
--

INSERT INTO `buku_personels` (`id`, `buku_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 22, '2024-11-25 01:37:02', '2024-11-25 01:37:02'),
(2, 8, 43, '2024-11-25 02:05:30', '2024-11-25 02:05:30'),
(3, 9, 43, '2024-11-25 02:06:41', '2024-11-25 02:06:41'),
(4, 10, 43, '2024-11-25 02:08:38', '2024-11-25 02:08:38'),
(5, 12, 52, '2024-11-25 02:11:31', '2024-11-25 02:11:31'),
(6, 13, 46, '2024-11-25 02:13:07', '2024-11-25 02:13:07'),
(7, 14, 46, '2024-11-25 02:14:34', '2024-11-25 02:14:34'),
(8, 20, 48, '2024-11-25 02:24:31', '2024-11-25 02:24:31'),
(9, 23, 53, '2024-11-25 02:41:21', '2024-11-25 02:41:21'),
(10, 25, 50, '2024-11-25 02:44:08', '2024-11-25 02:44:08'),
(11, 26, 50, '2024-11-25 02:45:27', '2024-11-25 02:45:27'),
(12, 28, 47, '2024-11-25 02:47:57', '2024-11-25 02:47:57'),
(13, 29, 53, '2024-11-25 02:49:22', '2024-11-25 02:49:22'),
(14, 30, 53, '2024-11-25 02:50:39', '2024-11-25 02:50:39'),
(15, 31, 52, '2024-11-25 02:51:57', '2024-11-25 02:51:57'),
(16, 32, 53, '2024-11-25 02:53:27', '2024-11-25 02:53:27'),
(17, 34, 77, '2024-11-25 03:01:11', '2024-11-25 03:01:11'),
(18, 34, 78, '2024-11-25 03:01:11', '2024-11-25 03:01:11'),
(19, 34, 80, '2024-11-25 03:01:11', '2024-11-25 03:01:11'),
(20, 37, 78, '2024-11-25 03:08:38', '2024-11-25 03:08:38'),
(21, 37, 79, '2024-11-25 03:08:38', '2024-11-25 03:08:38'),
(22, 42, 77, '2024-11-25 03:20:19', '2024-11-25 03:20:19'),
(23, 42, 78, '2024-11-25 03:20:19', '2024-11-25 03:20:19'),
(24, 42, 80, '2024-11-25 03:20:19', '2024-11-25 03:20:19');

-- --------------------------------------------------------

--
-- Table structure for table `fakultas`
--

CREATE TABLE `fakultas` (
  `id` bigint UNSIGNED NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fakultas`
--

INSERT INTO `fakultas` (`id`, `kode`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'FIKES', 'Fakultas Ilmu Kesehatan', NULL, NULL),
(2, 'FEB', 'Fakultas Ekonomi Bisnis', NULL, NULL),
(3, 'FIKOM', 'Fakultas Ilmu Komputer', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hkis`
--

CREATE TABLE `hkis` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `jenis_hki_id` bigint UNSIGNED NOT NULL,
  `judul` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pendaftaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('terdaftar','granted') COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hkis`
--

INSERT INTO `hkis` (`id`, `user_id`, `jenis_hki_id`, `judul`, `tahun`, `nomor`, `pendaftaran`, `status`, `file`, `created_at`, `updated_at`) VALUES
(1, 43, 3, 'Media Pembelajaran Laboratorium Vaksinasi Polio Oral', '2022', '000395155', 'EC00202279411', 'terdaftar', 'hki/24112511581071.pdf', '2024-11-25 04:58:10', '2024-11-25 05:10:13'),
(2, 11, 3, 'PERTOLONGAN PERTAMA PADA ANAK CIDERA', '2022', '000395615', 'EC00202279871', 'terdaftar', 'hki/24112512065199.pdf', '2024-11-25 05:06:51', '2024-11-25 05:10:37'),
(3, 36, 3, 'Mengenal Anemia Dalam Kehamilan', '2020', '00257884', 'EC00202126553', 'terdaftar', 'hki/24112512092496.pdf', '2024-11-25 05:09:24', '2024-11-25 05:09:24'),
(4, 42, 3, 'SAY NO TO PENIKAHAN DINI', '2022', '000321057', 'EC00202205776', 'terdaftar', NULL, '2024-11-25 05:11:54', '2024-11-25 05:11:54'),
(5, 66, 3, 'KURSI IBU HAMIL', '2021', '000297149', 'EC00202151904', 'terdaftar', NULL, '2024-11-25 05:12:53', '2024-11-25 05:12:53'),
(6, 46, 3, 'TEMU BLENYEH SEBAGAI ANTIOKSIDAN', '2021', '000288798', 'EC00202151168', 'terdaftar', NULL, '2024-11-25 05:13:58', '2024-11-25 05:13:58'),
(7, 44, 3, 'PERSIAPAN PERSALINAN PADA IBU HAMIL DI MASA NEW NORMAL', '2021', '000278440', 'EC00202150873', 'terdaftar', 'hki/24112512204339.pdf', '2024-11-25 05:20:43', '2024-11-25 05:20:43'),
(8, 11, 3, 'Mengenalkan Covid 19 Pada Anak', '2021', '000287954', 'EC00202147781', 'terdaftar', NULL, '2024-11-25 05:21:37', '2024-11-25 05:21:37'),
(9, 48, 3, 'BUKLET MEDITERANIA', '2021', '000300539', 'EC00202147566', 'terdaftar', NULL, '2024-11-25 05:22:52', '2024-11-25 05:22:52'),
(10, 38, 3, 'PUBERTAS REMAJA', '2021', '000261997', 'EC00202135210', 'terdaftar', NULL, '2024-11-25 05:26:16', '2024-11-25 05:26:16'),
(11, 45, 3, 'Tanda Dan Bahaya Masa Nifas', '2021', '000261323', 'EC00202134171', 'terdaftar', 'hki/24112512275321.pdf', '2024-11-25 05:27:53', '2024-11-25 05:27:53'),
(12, 38, 3, 'Booklet pendidikan Kesehatan Reproduksi Remaja', '2021', '000260930', 'EC00202134027', 'terdaftar', NULL, '2024-11-25 05:30:58', '2024-11-25 05:30:58'),
(13, 41, 3, 'KB SUNTIK', '2021', '000260928', 'EC00202134022', 'terdaftar', NULL, '2024-11-25 05:36:12', '2024-11-25 05:36:12'),
(14, 45, 3, 'ASI EKSKLUSIF', '2021', '000260927', 'EC00202134016', 'terdaftar', 'hki/24112512405388.pdf', '2024-11-25 05:40:05', '2024-11-25 05:40:53'),
(15, 11, 3, 'Judul kesehatan reproduksi pada remaja', '2021', '000257895', 'EC00202130475', 'terdaftar', NULL, '2024-11-25 05:43:18', '2024-11-25 05:43:18'),
(16, 25, 3, 'Modul Pelatihan Evidence Based Practice Triage', '2021', '000257246', 'EC00202130130', 'terdaftar', NULL, '2024-11-25 05:44:25', '2024-11-25 05:44:25'),
(17, 36, 3, 'Mengenal Anemia Dalam Kehamilan', '2021', '000257884', 'EC00202126553', 'terdaftar', NULL, '2024-11-25 05:47:10', '2024-11-25 05:47:10'),
(18, 28, 3, 'Senam Bebek Berenang', '2021', '000239951', 'EC00202109625', 'terdaftar', 'hki/24112512492541.pdf', '2024-11-25 05:49:25', '2024-11-25 05:49:25'),
(19, 28, 3, 'Video Storytelling Media Boneka Jari Kain Flanel', '2021', '000239658', 'EC00202109587', 'terdaftar', 'hki/24112512515542.pdf', '2024-11-25 05:51:55', '2024-11-25 05:51:55'),
(20, 7, 3, 'Kebutuhan Keluarga dalam perawatan ibu hamil dengan preeklampsia', '2023', '000238642', 'EC00202108139', 'terdaftar', NULL, '2024-11-25 05:53:28', '2024-11-25 05:57:52'),
(21, 87, 3, 'Booklet untuk anak Usia Sekolah \" Aku BIsa Cegah Penularan Penyakit Tuberkulosis\"', '2021', '000235574', 'EC00202108853', 'terdaftar', 'hki/24112501015272.pdf', '2024-11-25 06:01:52', '2024-11-25 06:01:52'),
(22, 87, 3, 'Pencegahan Tuberkulosis', '2021', '000238641', 'EC00202108055', 'terdaftar', 'hki/24112501044357.pdf', '2024-11-25 06:04:43', '2024-11-25 06:04:43'),
(23, 87, 3, 'Role Play Pencegahan Penularan Tuberkulosis Pada Anak Usia Sekolah', '2021', '000234795', 'EC00202108054', 'terdaftar', 'hki/24112501063781.pdf', '2024-11-25 06:06:37', '2024-11-25 06:06:37'),
(24, 44, 3, 'Pemeriksaan Kehamil ANC', '2021', '000206665', 'EC00202036976', 'terdaftar', 'hki/24112501080090.pdf', '2024-11-25 06:08:00', '2024-11-25 06:08:00'),
(25, 37, 3, 'Kehamilan di Era Pandemi Covid-19', '2020', '000206663', 'EC00202036975', 'terdaftar', 'hki/24112501090978.pdf', '2024-11-25 06:09:09', '2024-11-25 06:09:09'),
(26, 48, 3, 'SI NONA KALEM', '2020', '000199204', 'EC00202028091', 'terdaftar', 'hki/24112501103235.pdf', '2024-11-25 06:10:32', '2024-11-25 06:10:32'),
(27, 68, 3, 'Protokol Keselamatan Covid 19 di Masjid', '2020', '000199601', 'EC00202027762', 'terdaftar', 'hki/24112501114883.pdf', '2024-11-25 06:11:48', '2024-11-25 06:11:48'),
(28, 42, 3, 'Kenali Covid 19', '2020', '000196250', 'EC00202024700', 'terdaftar', NULL, '2024-11-25 06:12:45', '2024-11-25 06:12:45'),
(29, 11, 3, 'Emotional Freedom technique', '2020', '000193906', 'EC00202022257', 'terdaftar', 'hki/24112501142872.pdf', '2024-11-25 06:14:28', '2024-11-25 06:14:28'),
(30, 5, 3, 'LATIHAN AKTIVITAS SEHARI â€“ HARI (ACTIVITY OF DAILY LIVING) DAN PERAWATAN DIRI UNTUK PASIEN DENGAN CEDERA TULANG BELAKANG', '2020', '000193028', 'EC00202021279', 'terdaftar', 'hki/24112502034750.pdf', '2024-11-25 07:03:47', '2024-11-25 07:03:47'),
(31, 22, 3, 'PEMAKAIAN \"APRON CERIA\" UNTUK MENGURANGI KECEMASAN PADA ANAK YANG MENGALAMI STRES HOSPITALISASI', '2020', '000193027', 'EC00202021278', 'terdaftar', 'hki/24112502053545.pdf', '2024-11-25 07:05:35', '2024-11-25 07:05:35'),
(32, 8, 3, 'Cuci Tangan Pakai Sabun', '2020', '000184246', 'EC00202011605', 'terdaftar', 'hki/24112502063530.pdf', '2024-11-25 07:06:35', '2024-11-25 07:06:35'),
(33, 11, 3, '\'\'BRIPKA\" Binahong Krim Penyembuhan Luka', '2020', '000183190', 'EC00202010485', 'terdaftar', 'hki/24112502075099.pdf', '2024-11-25 07:07:50', '2024-11-25 07:07:50'),
(34, 46, 3, 'Masker Gel Peel-off\"GL\'\' Anti Jerawat dan Pemutih Wajah', '2019', '000169250', 'EC00201987593', 'terdaftar', 'hki/24112502085477.pdf', '2024-11-25 07:08:54', '2024-11-25 07:08:54'),
(35, 48, 3, 'BUNTAS AWAK (Sabun Kertas Aroma Kemangi)', '2019', '000152111', 'EC00201945461', 'terdaftar', 'hki/24112502095051.pdf', '2024-11-25 07:09:50', '2024-11-25 07:09:50'),
(36, 28, 3, 'Modul My Confident Book', '2019', '000144467', 'EC00201943926', 'terdaftar', 'hki/24112502105858.pdf', '2024-11-25 07:10:58', '2024-11-25 07:10:58'),
(37, 11, 3, 'video asuhan perkembangan pada BBLR', '2018', '000125048', 'EC00201854105', 'terdaftar', 'hki/24112502123430.pdf', '2024-11-25 07:12:34', '2024-11-25 07:12:34'),
(38, 28, 3, 'Proses Asuhan Keperawatan Jiwa', '2018', '000131962', 'EC00201854109', 'terdaftar', 'hki/24112502140967.pdf', '2024-11-25 07:14:09', '2024-11-25 07:14:09'),
(39, 3, 3, 'buku asuhan keperawatan medikal bedah (muskulo skeletal)', '2018', '000131888', 'EC00201853250', 'terdaftar', 'hki/24112504505882.pdf', '2024-11-25 09:50:58', '2024-11-25 09:50:58'),
(40, 18, 3, 'Panduan Profesi Ners Manajemen Keperawatan', '2018', '000126146', 'EC00201853249', 'terdaftar', 'hki/24112609062718.pdf', '2024-11-26 02:06:27', '2024-11-26 02:06:27'),
(41, 37, 3, 'Profesionalisme Bidan dalam deteksi Dini Pre eklamPsia', '2018', '000113140', 'EC00201822579', 'terdaftar', NULL, '2024-11-26 02:51:03', '2024-11-26 02:51:03'),
(42, 48, 3, 'Buku Ajar Anatomi Fisiologi Manusia', '2018', '000110232', 'EC00201814911', 'terdaftar', 'hki/24112609521188.pdf', '2024-11-26 02:52:11', '2024-11-26 02:52:11'),
(43, 27, 3, 'GELIS PISAN (Gel pilis pilihan ibu pasca melahirkan)', '2019', '000144775', 'EC00201944126', 'terdaftar', 'hki/24112609531860.pdf', '2024-11-26 02:53:18', '2024-11-26 02:53:18'),
(44, 78, 3, 'Pelatihan Handycraft Buket Bunga Untuk Unit Kegiatan Mahasiswa Universitas Bhamada Slawi', '2023', '000474289', 'EC00202341368', 'terdaftar', 'hki/24112609545271.pdf', '2024-11-26 02:54:52', '2024-11-26 02:54:52'),
(45, 29, 3, 'Keperawatan Medikal Bedah : Teori Dan Praktik Laboratorium Jilid 1', '2023', '000437106', 'EC00202304184', 'terdaftar', 'hki/24112609564777.pdf', '2024-11-26 02:56:47', '2024-11-26 02:56:47'),
(46, 29, 3, 'Keperawatan Medikal Bedah: Teori Dan Praktik Laboratorium Jilid 2', '2023', '000437107', 'EC00202304185', 'terdaftar', 'hki/24112610010655.pdf', '2024-11-26 02:58:22', '2024-11-26 03:01:06'),
(47, 48, 3, 'TERIGU', '2020', '000310979', 'EC00202024698', 'terdaftar', 'hki/24112610003249.pdf', '2024-11-26 03:00:32', '2024-11-26 03:00:32'),
(48, 79, 3, 'PELATIHAN BERWIRAUSAHA DENGAN MEMANFAATKAN MEDIA SOSIAL UNTUK MEMBANGUN JIWA MUDA MENJADI ENTREPRENEUR BAGI SISWA SMA N 2 SLAWI', '2023', '000484533', 'EC00202351598', 'terdaftar', 'hki/24112610040962.pdf', '2024-11-26 03:04:09', '2024-11-26 03:06:58'),
(49, 77, 3, 'Pengantar Kewirausahaan', '2023', '000533002', 'EC002023100047', 'terdaftar', 'hki/24112610063715.pdf', '2024-11-26 03:06:37', '2024-11-26 03:06:37'),
(50, 79, 3, 'Konsep Dasar Kewirausahaan', '2023', '000542729', 'EC002023109774', 'terdaftar', 'hki/24112610123934.pdf', '2024-11-26 03:12:39', '2024-11-26 03:12:39'),
(51, 79, 3, 'MANAJEMEN OPERASI : Inovasi, Peluang, Dan Tantangan Ekonomi Kreatif Di Indonesia', '2023', '000555639', 'EC002023122684', 'terdaftar', 'hki/24112610143426.pdf', '2024-11-26 03:14:34', '2024-11-26 03:14:34'),
(52, 77, 3, 'Pengantar Kewirausahaan', '2023', '000533002', 'EC002023100047', 'terdaftar', 'hki/24112610181949.pdf', '2024-11-26 03:18:19', '2024-11-26 03:18:19'),
(53, 38, 3, 'Buku Ajar Asuhan Kebidanan Bayi Dan Balita DIII Kebidanan', '2023', '000507728', 'EC00202374775', 'terdaftar', 'hki/24112610212871.pdf', '2024-11-26 03:20:10', '2024-11-26 03:21:28'),
(54, 38, 3, 'Asuhan Kebidanan Kasus Fisiologis Pada Bayi, Balita, Dan Anak Pra Sekolah', '2023', '000519178', 'EC00202386225', 'terdaftar', 'hki/24112610244069.pdf', '2024-11-26 03:24:40', '2024-11-26 03:24:40'),
(55, 38, 3, 'KONSEP KEBIDANAN', '2023', '000517494', 'EC00202384541', 'terdaftar', 'hki/24112610273735.pdf', '2024-11-26 03:27:37', '2024-11-26 03:27:37'),
(56, 38, 3, 'Evidence Based Soal Kasus Kebidanan Komunitas V', '2023', '000546451', 'EC002023113496', 'terdaftar', 'hki/24112610292966.pdf', '2024-11-26 03:29:29', '2024-11-26 03:29:29'),
(57, 38, 3, 'Buku Ajar Asuhan Kebidanan Neonatus, Bayi Balita Dan Anak Pra Sekolah', '2024', '000588030', 'EC00202412659', 'terdaftar', 'hki/24112610310862.pdf', '2024-11-26 03:31:08', '2024-11-26 03:31:08'),
(58, 75, 3, 'Aplikasi Chatbot Untuk Customer Service', '2023', '000531454', 'EC00202398499', 'terdaftar', 'hki/24112610365314.pdf', '2024-11-26 03:32:37', '2024-11-26 03:36:53'),
(59, 75, 3, 'BUKU AJAR PENGANTAR BASIS DATA', '2024', '000537522', 'EC002023104567', 'terdaftar', 'hki/24112610354587.pdf', '2024-11-26 03:35:45', '2024-11-26 03:35:45'),
(60, 51, 3, 'Tenses in Writing an English Abstract', '2023', '000480057', 'EC00202347122', 'terdaftar', 'hki/24112610383413.pdf', '2024-11-26 03:38:34', '2024-11-26 03:38:34'),
(61, 79, 3, 'DASAR-DASAR KEWIRAUSAHAAN : Teori Dan Panduan Berwirausaha', '2024', '000622016', 'EC00202446661', 'terdaftar', NULL, '2024-11-26 03:39:50', '2024-11-26 03:39:50'),
(62, 79, 3, 'Konsep Dasar Kewirausahaan', '2023', '000542729', 'EC002023109774', 'terdaftar', 'hki/24112610502075.pdf', '2024-11-26 03:50:20', '2024-11-26 03:50:20'),
(63, 79, 3, 'PELATIHAN BERWIRAUSAHA DENGAN MEMANFAATKAN MEDIA SOSIAL UNTUK MEMBANGUN JIWA MUDA MENJADI ENTREPRENEUR BAGI SISWA SMA N 2 SLAWI', '2023', '000484533', 'EC00202351598', 'terdaftar', 'hki/24112610525233.pdf', '2024-11-26 03:52:52', '2024-11-26 03:52:52'),
(64, 79, 3, 'DASAR-DASAR KEWIRAUSAHAAN : Teori Dan Panduan Berwirausaha', '2024', '000622016', 'EC00202446661', 'terdaftar', NULL, '2024-11-26 03:53:36', '2024-11-26 03:53:36'),
(65, 79, 3, 'MANAJEMEN OPERASI : Inovasi, Peluang, Dan Tantangan Ekonomi Kreatif Di Indonesia', '2023', '000555639', 'EC002023122684', 'terdaftar', NULL, '2024-11-26 03:54:39', '2024-11-26 03:54:39');

-- --------------------------------------------------------

--
-- Table structure for table `hki_personels`
--

CREATE TABLE `hki_personels` (
  `id` bigint UNSIGNED NOT NULL,
  `hki_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hki_personels`
--

INSERT INTO `hki_personels` (`id`, `hki_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 2, 12, '2024-11-25 05:06:51', '2024-11-25 05:06:51'),
(2, 2, 8, '2024-11-25 05:06:51', '2024-11-25 05:06:51'),
(3, 3, 41, '2024-11-25 05:09:24', '2024-11-25 05:09:24'),
(4, 4, 45, '2024-11-25 05:11:54', '2024-11-25 05:11:54'),
(5, 6, 51, '2024-11-25 05:13:58', '2024-11-25 05:13:58'),
(6, 7, 37, '2024-11-25 05:20:43', '2024-11-25 05:20:43'),
(7, 7, 39, '2024-11-25 05:20:43', '2024-11-25 05:20:43'),
(8, 10, 42, '2024-11-25 05:26:16', '2024-11-25 05:26:16'),
(9, 12, 43, '2024-11-25 05:30:58', '2024-11-25 05:30:58'),
(10, 12, 42, '2024-11-25 05:30:58', '2024-11-25 05:30:58'),
(11, 13, 40, '2024-11-25 05:36:12', '2024-11-25 05:36:12'),
(12, 13, 36, '2024-11-25 05:36:12', '2024-11-25 05:36:12'),
(13, 17, 41, '2024-11-25 05:47:10', '2024-11-25 05:47:10'),
(14, 18, 9, '2024-11-25 05:49:25', '2024-11-25 05:49:25'),
(15, 19, 11, '2024-11-25 05:51:55', '2024-11-25 05:51:55'),
(16, 20, 87, '2024-11-25 05:57:52', '2024-11-25 05:57:52'),
(17, 22, 7, '2024-11-25 06:04:43', '2024-11-25 06:04:43'),
(18, 24, 37, '2024-11-25 06:08:00', '2024-11-25 06:08:00'),
(19, 25, 44, '2024-11-25 06:09:09', '2024-11-25 06:09:09'),
(20, 28, 37, '2024-11-25 06:12:45', '2024-11-25 06:12:45'),
(21, 29, 8, '2024-11-25 06:14:28', '2024-11-25 06:14:28'),
(22, 29, 14, '2024-11-25 06:14:28', '2024-11-25 06:14:28'),
(23, 31, 11, '2024-11-25 07:05:35', '2024-11-25 07:05:35'),
(24, 38, 26, '2024-11-25 07:14:09', '2024-11-25 07:14:09'),
(25, 39, 7, '2024-11-25 09:50:58', '2024-11-25 09:50:58'),
(26, 44, 77, '2024-11-26 02:54:52', '2024-11-26 02:54:52'),
(27, 44, 79, '2024-11-26 02:54:52', '2024-11-26 02:54:52'),
(28, 45, 22, '2024-11-26 02:56:47', '2024-11-26 02:56:47'),
(29, 46, 30, '2024-11-26 02:58:22', '2024-11-26 02:58:22'),
(30, 49, 78, '2024-11-26 03:06:37', '2024-11-26 03:06:37'),
(31, 49, 79, '2024-11-26 03:06:37', '2024-11-26 03:06:37'),
(32, 48, 77, '2024-11-26 03:06:58', '2024-11-26 03:06:58'),
(33, 50, 77, '2024-11-26 03:12:39', '2024-11-26 03:12:39'),
(34, 50, 78, '2024-11-26 03:12:39', '2024-11-26 03:12:39'),
(35, 52, 78, '2024-11-26 03:18:19', '2024-11-26 03:18:19'),
(36, 52, 79, '2024-11-26 03:18:19', '2024-11-26 03:18:19'),
(37, 53, 43, '2024-11-26 03:20:10', '2024-11-26 03:20:10'),
(38, 54, 43, '2024-11-26 03:24:40', '2024-11-26 03:24:40'),
(39, 55, 43, '2024-11-26 03:27:37', '2024-11-26 03:27:37'),
(40, 56, 43, '2024-11-26 03:29:29', '2024-11-26 03:29:29'),
(41, 58, 76, '2024-11-26 03:32:37', '2024-11-26 03:32:37'),
(42, 58, 72, '2024-11-26 03:32:37', '2024-11-26 03:32:37'),
(43, 59, 72, '2024-11-26 03:35:45', '2024-11-26 03:35:45'),
(44, 62, 77, '2024-11-26 03:50:20', '2024-11-26 03:50:20'),
(45, 62, 78, '2024-11-26 03:50:20', '2024-11-26 03:50:20'),
(46, 62, 80, '2024-11-26 03:50:20', '2024-11-26 03:50:20'),
(47, 63, 77, '2024-11-26 03:52:52', '2024-11-26 03:52:52'),
(48, 63, 78, '2024-11-26 03:52:52', '2024-11-26 03:52:52'),
(49, 63, 80, '2024-11-26 03:52:52', '2024-11-26 03:52:52');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_hkis`
--

CREATE TABLE `jenis_hkis` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_hkis`
--

INSERT INTO `jenis_hkis` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Paten', NULL, NULL),
(2, 'Paten Sederhana', NULL, NULL),
(3, 'Hak Cipta', NULL, NULL),
(4, 'Merek Dagang', NULL, NULL),
(5, 'Rahasia Dagang', NULL, NULL),
(6, 'Desain Produk Industri', NULL, NULL),
(7, 'Perlindungan Varietas Tanaman', NULL, NULL),
(8, 'Perlindungan Topografi Sirkuit Terpadu', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_jurnals`
--

CREATE TABLE `jenis_jurnals` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_jurnals`
--

INSERT INTO `jenis_jurnals` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Internasional', NULL, NULL),
(2, 'Nasional Terakreditasi', NULL, NULL),
(3, 'Nasional Tidak Terakreditasi (Mempunyai ISSN)', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_luarans`
--

CREATE TABLE `jenis_luarans` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_luarans`
--

INSERT INTO `jenis_luarans` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Desain', NULL, NULL),
(2, 'Karya Seni', NULL, NULL),
(3, 'Kebijakan', NULL, NULL),
(4, 'Media Massa Nasional', NULL, NULL),
(5, 'Media Massa Internasional', NULL, NULL),
(6, 'Model', NULL, NULL),
(7, 'Prototype', NULL, NULL),
(8, 'Rekayasa Sosial', NULL, NULL),
(9, 'Teknologi Tepat Guna (TTG)', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_pendanaans`
--

CREATE TABLE `jenis_pendanaans` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_pendanaans`
--

INSERT INTO `jenis_pendanaans` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Universitas Bhamada Slawi', NULL, NULL),
(2, 'Pemerintah', NULL, NULL),
(3, 'Mandiri', NULL, NULL),
(4, 'Perusahaan Swasta', NULL, NULL),
(5, 'Luar Negeri', NULL, NULL),
(6, 'Hibah Yayasan', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_penelitians`
--

CREATE TABLE `jenis_penelitians` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_penelitians`
--

INSERT INTO `jenis_penelitians` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Fundamental', NULL, NULL),
(2, 'Dosen Pemula', NULL, NULL),
(3, 'Produk Terapan', NULL, NULL),
(4, 'Sosial, Humaniora dan Pendidikan', NULL, NULL),
(5, 'Unggulan Perguruan Tinggi', NULL, NULL),
(6, 'Search and Share Grant', NULL, NULL),
(7, 'Kerjasama', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_pengabdians`
--

CREATE TABLE `jenis_pengabdians` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_pengabdians`
--

INSERT INTO `jenis_pengabdians` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'IPTEK bagi Masyarakat', NULL, NULL),
(2, 'IPTEK bagi Kewirausahaan', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jurnals`
--

CREATE TABLE `jurnals` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `jenis_jurnal_id` bigint UNSIGNED NOT NULL,
  `tahun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `issn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `volume` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `halaman_awal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `halaman_akhir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mahasiswas` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jurnals`
--

INSERT INTO `jurnals` (`id`, `user_id`, `jenis_jurnal_id`, `tahun`, `nama`, `judul`, `issn`, `volume`, `nomor`, `halaman_awal`, `halaman_akhir`, `url`, `file`, `mahasiswas`, `created_at`, `updated_at`) VALUES
(1, 39, 1, '2021', 'Jurnal SMART Kebidanan', 'FAKTOR-FAKTOR YANG MEMPENGARUHI KEJADIAN LASERASI PERINEUM DI KABUPATEN TEGAL', '2503-0388', '8', '2', '90', '96', 'http://stikesyahoedsmg.ac.id/ojs/index.php/sjkb/article/view/473', 'jurnal/24112104422022.pdf', '[]', '2024-11-21 09:42:21', '2024-11-21 09:42:21'),
(2, 11, 1, '2022', 'Jurnal Ilmu dan Teknologi Kesehatan Bhamada', 'MINYAK JINTAN HITAM (NIGELLA SATIVA OIL) DAPAT MENCEGAH RUAM POPOK PADA BALITA DENGAN DIARE', '2355-3863', '13', '1', '1', '8', 'https://ojs.stikesbhamadaslawi.ac.id/index.php/jik/article/view/347', 'jurnal/24112104441033.pdf', '[]', '2024-11-21 09:44:10', '2024-11-21 09:44:10'),
(3, 29, 1, '2022', 'Jurnal Ilmu dan Teknologi Kesehatan Bhamada', 'HUBUNGAN VERBAL BULLYING DENGAN INTERAKSI SOSIAL PADA REMAJA', '2355-3863', '13', '1', '1', '5', 'https://ojs.stikesbhamadaslawi.ac.id/index.php/jik/article/view/368', NULL, '[]', '2024-11-21 09:47:17', '2024-11-21 09:47:17'),
(4, 10, 1, '2022', 'Jurnal Ilmu dan Teknologi Kesehatan Bhamada', 'PENGALAMAN KESEPIAN PADA LANSIA: SYSTEMATIC REVIEW', '2355-3863', '13', '1', '1', '10', 'https://ojs.stikesbhamadaslawi.ac.id/index.php/jik/article/view/358', 'jurnal/24112104490367.pdf', '[]', '2024-11-21 09:49:03', '2024-11-21 09:49:03'),
(5, 18, 1, '2022', 'Jurnal Ilmu dan Teknologi Kesehatan Bhamada', 'BEBAN KERJA PERAWAT PELAKSANA DENGAN PENERAPAN PATIENT SAFETY DI RUANG-ISOLASI COVID-19 RS MITRA SIAGA TEGAL', '2355-3863', '13', '1', '1', '8', 'https://ojs.stikesbhamadaslawi.ac.id/index.php/jik/article/view/363', 'jurnal/24112208262531.pdf', '[]', '2024-11-22 01:26:26', '2024-11-22 01:26:26'),
(6, 28, 1, '2022', 'Jurnal Ilmu dan Teknologi Kesehatan', 'HUBUNGAN BERMAIN GAME ONLINE DENGAN PERILAKU AGRESIF PADA REMAJA DI SMK BHAKTI PRAJA SLAWI', '2355-3863', '13', '1', '1', '7', 'https://ojs.stikesbhamadaslawi.ac.id/index.php/jik/article/view/380', 'jurnal/24112208293055.pdf', '[]', '2024-11-22 01:29:30', '2024-11-22 01:29:30'),
(7, 48, 1, '2022', 'Jurnal Ilmiah Medicamento', 'Evaluasi Penggunaan Obat Pada Pasien Gastritis di Puskesmas Kaladawa Periode Oktober-Desember 2018', '2356-4814', '7', '2', '1', '7', 'https://doi.org/10.36733/medicamento.v7i2.1510', 'jurnal/24112208324588.pdf', '[]', '2024-11-22 01:32:45', '2024-11-22 01:32:45'),
(8, 18, 1, '2022', 'Indonesian Journal for Health Sciences', 'HUBUNGAN ANTARA DEMENSIA DENGAN ACTIVITY OF DAILY LIVING (ADL) PADA LANJUT USIA', '2549-2721', '5', '2', '1', '9', 'https://journal.umpo.ac.id/index.php/IJHS/article/view/3698', 'jurnal/24112208383157.pdf', '[]', '2024-11-22 01:38:31', '2024-11-22 01:38:31'),
(9, 46, 1, '2022', 'Jurnal Ilmiah Kesehatan', 'Fitokimia dan Aktivitas Antioksidan Ekstrak Temu Blenyeh (Curcuma purpurascens Blumae)', '1978-3167', '15', '1', '1', '11', 'https://jurnal.umpp.ac.id/index.php/jik/article/view/627', 'jurnal/24112208403746.pdf', '[]', '2024-11-22 01:40:37', '2024-11-22 01:40:37'),
(10, 37, 1, '2022', 'Jurnal Ilmu Kesehatan', 'Hubungan Dukungan Sosial Ibu dengan Tingkat Kecemasan Dalam Menghadapi Sindrom Premenstruasi Pada Remaja Putri', '2580-930X', '5', '2', '1', '5', 'http://jik.stikesalifah.ac.id/index.php/jurnalkes/article/view/428', 'jurnal/24112208420980.pdf', '[]', '2024-11-22 01:42:09', '2024-11-22 01:42:09'),
(11, 36, 1, '2022', 'Jurnal Ilmu dan Teknologi Kesehatan Bhamada', 'PERBEDAAN CAPAIAN AKSEPTOR KB DI KABUPATEN TEGAL SEBELUM DAN SESUDAH PENCANANGAN KAMPUNG KB', '2355-3863', '12', '2', '1', '3', 'https://ojs.stikesbhamadaslawi.ac.id/index.php/jik/article/view/308', 'jurnal/24112208440769.pdf', '[]', '2024-11-22 01:44:07', '2024-11-22 01:44:07'),
(12, 19, 1, '2022', 'Jurnal Ilmu dan Teknologi Kesehatan Bhamada', 'HUBUNGAN TINGKAT STRESS ORANGTUA DENGAN MEKANISME KOPING PADA ORANGTUA YANG MEMILIKI ANAK TUNA GRAHITA USIA 7-18 TAHUN DI SLB N SLAWI', '2355-3863', '12', '2', '1', '6', 'https://ojs.stikesbhamadaslawi.ac.id/index.php/jik/article/view/306', 'jurnal/24112208455752.pdf', '[]', '2024-11-22 01:45:57', '2024-11-22 01:45:57'),
(13, 8, 1, '2022', 'Jurnal Ilmu dan Teknologi Kesehatan Bhamada', 'DUKUNGAN SOSIAL TEMAN SEBAYA DENGAN IDENTITAS DIRI REMAJA PUTRI SMK AL MANAAR MUHAMMADIYAH PEMALANG', '2355-3863', '12', '2', '1', '7', 'https://ojs.stikesbhamadaslawi.ac.id/index.php/jik/article/view/303', 'jurnal/24112208473588.pdf', '[]', '2024-11-22 01:47:35', '2024-11-22 01:47:35'),
(14, 68, 1, '2022', 'Jurnal Ilmu dan Teknologi Kesehatan Bhamada', 'HUBUNGAN PENGETAHUAN TENTANG KESELAMATAN DENGAN PERILAKU TIDAK AMAN PETANI BAWANG MERAH DI DESA TEGALGLAGA KABUPATEN BREBES', '2355-3863', '12', '2', '1', '4', 'https://ojs.stikesbhamadaslawi.ac.id/index.php/jik/article/view/271', 'jurnal/24112208495275.pdf', '[]', '2024-11-22 01:49:52', '2024-11-22 01:49:52'),
(15, 51, 1, '2022', 'Jurnal Abdimas Bhakti Indonesia', 'KUASAI SIMPLE PRESENT TENSE DENGAN SINGLE-SLOT SUBSTITUTION DRILL', '2721-0286', '3', '1', '1', '7', 'https://ojs.stikesbhamadaslawi.ac.id/index.php/JABI/article/view/399', 'jurnal/24112208523463.pdf', '[]', '2024-11-22 01:52:34', '2024-11-22 01:52:34'),
(16, 41, 1, '2022', 'Jurnal Abdimas Bhakti Indonesia', 'EDUKASI KESEHATAN TENTANG KB SUNTIK PADA WANITA USIA SUBUR DI MASA PANDEMI', '2721-0286', '3', '1', '1', '6', 'https://ojs.stikesbhamadaslawi.ac.id/index.php/JABI/article/view/395', 'jurnal/24112209063116.pdf', '[]', '2024-11-22 02:06:31', '2024-11-22 02:06:31'),
(17, 43, 1, '2022', 'Jurnal Abdimas Bhakti Indonesia', 'KOMUNIKASI INFORMASI EDUKASI (KIE) KESEHATAN REPRODUKSI REMAJA (KRR) PADA MASA PANDEMI COVID 19 DI SMP N 1 DUKUHWARU KEC. DUKUHWARU KAB. TEGAL', '2721-0286', '3', '1', '1', '10', 'https://ojs.stikesbhamadaslawi.ac.id/index.php/JABI/article/view/387', 'jurnal/24112209081860.pdf', '[]', '2024-11-22 02:08:19', '2024-11-22 02:08:19'),
(18, 74, 1, '2022', 'Jurnal Abdimas Bhakti Indonesia', 'PENYULUHAN ETIKA DAN KEAMANAN INFORMASI PADA PENGGUNAAN APLIKASI SMARTPHONE BAGI PESERTA DIDIK LKP KOMPUTER LESTARI SLAWI', '2721-0286', '3', '1', '1', '8', 'https://ojs.stikesbhamadaslawi.ac.id/index.php/JABI/article/view/386', 'jurnal/24112209100718.pdf', '[]', '2024-11-22 02:10:07', '2024-11-22 02:10:07'),
(19, 29, 1, '2022', 'Jurnal Abdimas Bhakti Indonesia', 'PENCEGAHAN COVID-19 MELALUI EDUKASI CUCI TANGAN DENGAN SEBELAS LANGKAH DI SD NEGERI SLAWI KULON 05', '2721-0286', '3', '1', '1', '10', 'https://ojs.stikesbhamadaslawi.ac.id/index.php/JABI/article/view/385', 'jurnal/24112209142644.pdf', '[]', '2024-11-22 02:14:26', '2024-11-22 02:14:26'),
(20, 44, 1, '2022', 'Jurnal Abdimas Bhakti Indonesia', 'EDUKASI MENJAGA IMUNITAS IBU HAMIL DI ERA NEW NORMAL', '2721-0286', '3', '1', '1', '6', 'https://ojs.stikesbhamadaslawi.ac.id/index.php/JABI/article/view/378', 'jurnal/24112209160688.pdf', '[]', '2024-11-22 02:16:06', '2024-11-22 02:16:06'),
(21, 29, 1, '2022', 'Jurnal Abdimas Bhakti Indonesia', 'EDUKASI 3M PLUS DAN MEDIA OVITRAP UNTUK PENCEGAHAN DEMAM BERDARAH DENGUE DI DESA KEBANDINGAN KECAMATAN KEDUNGBANTENG KABUPATEN TEGAL', '2721-0286', '3', '1', '1', '7', 'https://ojs.stikesbhamadaslawi.ac.id/index.php/JABI/article/view/374', 'jurnal/24112209540636.pdf', '[]', '2024-11-22 02:54:06', '2024-11-22 02:54:06'),
(22, 9, 1, '2022', 'Jurnal Abdimas Bhakti Indonesia', 'STRATEGI METODE EMOTIONAL FREEDOM TECHNIQUE (EFT) UNTUK MENURUNKAN KECEMASAN PADA GURU DALAM MENGHADAPI PEMBELAJARAN DARING', '2721-0286', '3', '1', '1', '10', 'https://ojs.stikesbhamadaslawi.ac.id/index.php/JABI/article/view/366', 'jurnal/24112209555697.pdf', '[]', '2024-11-22 02:55:56', '2024-11-22 02:55:56'),
(23, 43, 1, '2022', 'Jurnal Abdimas Bhakti Indonesia', 'EDUKASI KESEHATAN REPRODUKSI REMAJA PADA MASA PANDEMI COVID-19 DENGAN METODE BOOKLET DI DESA KALISAPU KECAMATAN SLAWI KABUPATEN TEGAL', '2721-0286', '2', '2', '1', '7', 'https://ojs.stikesbhamadaslawi.ac.id/index.php/JABI/article/view/365', 'jurnal/24112209574888.pdf', '[]', '2024-11-22 02:57:48', '2024-11-22 02:57:48'),
(24, 18, 1, '2022', 'Jurnal Abdimas Bhakti Indonesia', 'PENYULUHAN DIET DASH HIPERTENSI PADA LANSIA SELAMA MASA PANDEMI COVID-19', '2721-0286', '3', '1', '1', '9', 'https://ojs.stikesbhamadaslawi.ac.id/index.php/JABI/article/view/364', 'jurnal/24112209592817.pdf', '[]', '2024-11-22 02:59:28', '2024-11-22 02:59:28'),
(25, 66, 1, '2022', 'Jurnal Abdimas Bhakti Indonesia', 'PELATIHAN PENGGUNAAN ALAT PEMADAM API RINGAN (APAR) PADA UPTD LABORATORIUM PERINDUSTRIAN KABUPATEN TEGAL', '2721-0286', '2', '2', '1', '10', 'https://ojs.stikesbhamadaslawi.ac.id/index.php/JABI/article/view/355', 'jurnal/24112211325811.pdf', '[]', '2024-11-22 04:32:58', '2024-11-22 04:32:58'),
(26, 9, 1, '2022', 'Jurnal Abdimas Bhakti Indonesia', 'INTERVENSI TAKS (TERAPI AKTIVITAS KELOMPOK SOSIALISASI) SEBAGAI UPAYA MENURUNKAN TINGKAT DEPRESI LANSIA', '2721-0286', '2', '2', '1', '14', 'https://ojs.stikesbhamadaslawi.ac.id/index.php/JABI/article/view/353', 'jurnal/24112211342340.pdf', '[]', '2024-11-22 04:34:23', '2024-11-22 04:34:23'),
(27, 53, 1, '2022', 'Jurnal Abdimas Bhakti Indonesia', 'PENYULUHAN HERBA PENINGKAT SISTEM IMUN PADA MASA PANDEMI COVID-19', '2721-0286', '2', '2', '1', '8', 'https://ojs.stikesbhamadaslawi.ac.id/index.php/JABI/article/view/344', 'jurnal/24112211360287.pdf', '[]', '2024-11-22 04:36:02', '2024-11-22 04:36:02'),
(28, 28, 1, '2022', 'Jurnal Abdimas Bhakti Indonesia', 'SKRINING KEGAWATDARURATAN KESEHATAN LANJUT USIA (LANSIA) DI DESA MEJASEM TIMUR RW 06 KECAMATAN KRAMAT KABUPATEN TEGAL', '2721-0286', '2', '2', '1', '10', 'https://ojs.stikesbhamadaslawi.ac.id/index.php/JABI/article/view/339', 'jurnal/24112211375149.pdf', '[]', '2024-11-22 04:37:51', '2024-11-22 04:37:51'),
(29, 11, 1, '2022', 'Jurnal Abdimas Bhakti Indonesia', 'EDUKASI KESEHATAN REPRODUKSI REMAJA DI PANTI ASUHAN DARUL FARROH', '2721-0286', '2', '2', '1', '8', 'https://ojs.stikesbhamadaslawi.ac.id/index.php/JABI/article/view/307', 'jurnal/24112211392488.pdf', '[]', '2024-11-22 04:39:24', '2024-11-22 04:39:24'),
(30, 51, 1, '2022', 'Nivedana: Jurnal Komunikasi dan Bahasa', 'Tenses in Writing an English Abstract', '2723-7664', '3', '2', '146', '152', 'https://jurnal.radenwijaya.ac.id/index.php/NIVEDANA/article/view/659/394', NULL, '[]', '2024-11-22 04:40:34', '2024-11-22 04:40:34'),
(31, 51, 1, '2023', 'Lingua Franca: Jurnal Bahasa, Sastra dan Pengajarannya', 'Analisis Kesalahan Gramatikal dalam Abstrak Berbahasa Inggris', '2580-3255', '7', '1', '26', '37', 'https://journal.um-surabaya.ac.id/index.php/lingua/article/view/16214', NULL, '[]', '2024-11-22 05:41:52', '2024-11-22 05:41:52'),
(32, 72, 1, '2022', 'Jurnal Ilmiah Intech : Information Technology Journal of UMUS', 'PREDIKSI KELULUSAN MAHASISWA DENGAN NAÏVE BAYES DAN FEATURE SELECTION INFORMATION GAIN', '2685-4902', '4', '2', '223', '234', 'http://jurnal.umus.ac.id/index.php/intech/article/view/889', 'jurnal/24112212454994.pdf', '[]', '2024-11-22 05:45:49', '2024-11-22 05:45:49'),
(33, 50, 1, '2022', 'Jurnal FARMASIMED (JFM)', 'EFEKTIVITAS AFRODISIAKA KOMBINASI EKSTRAK BUAH PARE (Momordica charantia L.) DAN BAWANG PUTIH (Allium sativum L.) PADA MENCIT PUTIH (Mus muscullus) JANTAN', '2655-0814', '5', '1', '31', '38', 'https://doi.org/10.35451/jfm.v5i1.1242', 'jurnal/24112212500375.pdf', '[]', '2024-11-22 05:50:03', '2024-11-22 05:50:03'),
(34, 53, 1, '2022', 'Jurnal Sains dan Kesehatan (J. Sains Kes.)', 'Kombinasi Ekstrak Daun Kelor (Moringa Pterygosperma Gaertn .) dan Daun Lamtoro (Laucaena Leucocephalab Lmk.) sebagai Analgetik pada Mencit Putih Jantan dengan Metode Geliat', '2303-0267', '4', '6', '627', '634', 'https://jsk.farmasi.unmul.ac.id/index.php/jsk/article/view/1515/432', 'jurnal/24112212525952.pdf', '[]', '2024-11-22 05:52:59', '2024-11-22 05:52:59'),
(35, 21, 1, '2022', 'Jurnal Ilmiah Keperawatan Indonesia', 'Hubungan antara Mutu Pelayanan IGD dengan Kepuasan Keluarga Pasien di Ruang IGD RS Mitra Siaga Tega', '2580-3077', '6', '2', '201', '209', 'https://jurnal.umt.ac.id/index.php/jik/article/view/7848', 'jurnal/24112212544549.pdf', '[]', '2024-11-22 05:54:45', '2024-11-22 05:54:45'),
(36, 77, 1, '2023', 'Wawasan : Jurnal Ilmu Manajemen, Ekonomi dan Kewirausahaan', 'Pengaruh Keunggulan Produk dan Keunggulan Layanan terhadap Keputusan Pembelian Konsumen di CV. Pucuk Daun Lestari', '2963-5225', '1', '2', '170', '189', 'https://doi.org/10.58192/wawasan.v1i2.610', NULL, '[]', '2024-11-22 05:56:20', '2024-11-22 05:56:20'),
(37, 78, 1, '2023', 'SENTRI : Jurnal Riset Ilmiah', 'PENGARUH KEUNGGULAN PRODUK DAN KEUNGGULAN LAYANAN TERHADAP CUSTOMER LOYALTY DENGAN KEPUASAN CUSTOMER SEBAGAI VARIABEL INTERVENING DI PT ARIABIMA PROPERTINDO', '2963-1130', '2', '4', '1098', '1106', 'https://doi.org/10.55681/sentri.v2i4.706', 'jurnal/24112212580615.pdf', '[]', '2024-11-22 05:58:06', '2024-11-22 05:58:06'),
(38, 79, 1, '2023', 'Wawasan : Jurnal Ilmu Manajemen, Ekonomi dan Kewirausahaan', 'PENGARUH DUKUNGAN ORGANISASI DAN SIKAP KERJA TERHADAP PRODUKTIVITAS KERJA KARYAWAN UD HIDAYAH TEGAL', '2963-5225', '1', '1', '190', '207', 'https://journal.unimar-amni.ac.id/index.php/Wawasan/article/view/645/529', 'jurnal/24112212592952.pdf', '[]', '2024-11-22 05:59:29', '2024-11-22 05:59:29'),
(39, 69, 1, '2023', 'Jurnal Pendidikan Bahasa dan Sastra Indonesia', 'Syntactical Error Analysis on Fieldwork Report Made by the Vocational High School Students', '2477-846X', '8', '1', '32', '36', 'http://dx.doi.org/10.26737/jp-bsi.v8i1.3628', 'jurnal/24112201012268.pdf', '[]', '2024-11-22 06:01:22', '2024-11-22 06:01:22'),
(40, 77, 1, '2023', 'Sangkara Manajemen dan Bisnis', 'Peta Keterkaitan Konsep dalam Penelitian Kepemimpinan Kewirausahaan: Analisis Bibliometrik dan Co-occurrence', '2963-024X', '1', '3', '217', '228', 'https://sj.eastasouth-institute.com/index.php/smb/article/view/219', 'jurnal/24112201032129.pdf', '[]', '2024-11-22 06:03:21', '2024-11-22 06:03:21'),
(41, 78, 1, '2023', 'Sangkara Manajemen dan Bisnis', 'Pengaruh Budaya Organisasi Terhadap Inovasi Pada Perusahaan Teknologi: Studi Deskriptif Pada Startup XYZ Di Kota Bandung', '2963-024X', '1', '3', '114', '123', 'https://sj.eastasouth-institute.com/index.php/smb/article/view/220', 'jurnal/24112201054847.pdf', '[]', '2024-11-22 06:05:48', '2024-11-22 06:05:48'),
(42, 77, 1, '2023', 'JURNAL ILMIAH EDUNOMIKA', 'THE INFLUENCE OF SPIRITUAL LEADERSHIP STYLE AND OCB ON EMPLOYEE PERFORMANCE THROUGH WITH COMMITMENT AS MODERATING VARIABLE', '2598-1153', '8', '1', '1', '10', 'https://www.jurnal.stie-aas.ac.id/index.php/jie/article/view/10974', 'jurnal/24112201082561.pdf', '[]', '2024-11-22 06:08:25', '2024-11-22 06:08:25'),
(43, 79, 1, '2023', 'ejoin Jurnal pengabdian masyarakat', 'MENUMBUHKAN JIWA WIRAUSAHA MUDA DENGAN MEMANFAATKAN MEDIA SOSIAL SEBAGAI PELUANG KEWIRAUSAHAAN BAGI SISWA MAN 01 TEGAL MELALUI PELATIHAN “ENTREPRENEUR CLAS GO DIGITAL', '2985-5322', '1', '3', '104', '109', 'https://ejournal.nusantaraglobal.ac.id/index.php/ejoin/article/view/637', NULL, '[]', '2024-11-22 06:10:01', '2024-11-22 06:10:01'),
(44, 78, 1, '2023', 'World Management Journal', 'Mengoptimalkan Produktivitas Tim Melalui Manajemen Sumber Daya Manusia yang Efektif', '2988-1870', '1', '2', '12', '24', 'https://cesmid.or.id/index.php/world-management/article/view/10', 'jurnal/24112201112834.pdf', '[]', '2024-11-22 06:11:28', '2024-11-22 06:11:28'),
(45, 79, 1, '2023', 'Innovative: Journal Of Social Science Research', 'Pengaruh Keunggulan Produk dan Keunggulan Layanan Terhadap Customer Loyalty di Toko Bangunan (TB) Nusa Jaya', '2807-4238', '3', '4', '9825', '9839', 'https://j-innovative.org/index.php/Innovative/article/view/4615', 'jurnal/24112201145916.pdf', '[]', '2024-11-22 06:14:59', '2024-11-22 06:14:59'),
(46, 80, 1, '2023', 'Innovative: Journal Of Social Science Research', 'Analisa Rasio Keuangan NPL dan LDR terhadap Profitabilitas pada Bank yang Terdaftar di Bursa Efek Indonesia Periode Tahun 2020–2022', '2807-4238', '3', '4', '9853', '9868', 'https://j-innovative.org/index.php/Innovative/article/view/4616', 'jurnal/24112201174227.pdf', '[]', '2024-11-22 06:17:42', '2024-11-22 06:17:42'),
(47, 77, 1, '2023', 'JEMSI (Jurnal Ekonomi, Manajemen, dan Akuntansi)', 'Analysis of the Influence of Work Discipline, Motivation and Leadership Style on Performance of Automobile Authorized Dealer Company', '2579-5635', '9', '4', '1489', '1495', 'https://journal.lembagakita.org/index.php/jemsi/article/view/1369', 'jurnal/24112201192782.pdf', '[]', '2024-11-22 06:19:27', '2024-11-22 06:19:27'),
(48, 79, 1, '2023', 'JEKWS (Jurnal Ekonomi dan Kewirausahaan West science', 'Peran Kewirausahaan Sosisal dalam Pencapaian Tujuan Pembangunan Berkelanjutan (SDGs)', '2985-3818', '1', '3', '226', '235', 'https://wnj.westscience-press.com/index.php/jekws/article/view/528/535', 'jurnal/24112201204429.pdf', '[]', '2024-11-22 06:20:44', '2024-11-22 06:20:44'),
(49, 79, 1, '2023', 'JEMSI (Jurnal Ekonomi, Manajemen, dan Akuntansi)', 'The Influence of Leadership Style, Workload, Compensation and Organizational Culture on Performance of Auditors in National Private Company', '2579-5635', '9', '5', '2164', '2168', 'https://journal.lembagakita.org/index.php/jemsi/article/view/1614/1092', 'jurnal/24112201264469.pdf', '[]', '2024-11-22 06:26:44', '2024-11-22 06:26:44'),
(50, 79, 1, '2023', 'Edunomika', 'THE EFFECT OF LEADERSHIP AND WORK ENVIRONMENT ON EMPLOYEE PERFORMANCE WITH SATISFACTION AS A MODERATION VARIABLE', '2598-1153', '7', '2', '1', '6', 'https://www.jurnal.stie-aas.ac.id/index.php/jie/article/view/10050/pdf', 'jurnal/24112201282970.pdf', '[]', '2024-11-22 06:28:29', '2024-11-22 06:28:29'),
(51, 79, 1, '2023', 'Scientia', 'THE INFLUENCE OF PROMOTION STRATEGY, PRICE AND PRODUCT QUALITY ON PURCHASE DECISION OF PROCESSED SOYBEAN PRODUCTS IN INDONESIA', '2302-0059', '12', '3', '3967', '3971', 'https://infor.seaninstitute.org/index.php/pendidikan/article/view/1826/1528', 'jurnal/24112203084138.pdf', '[]', '2024-11-22 08:08:41', '2024-11-22 08:08:41'),
(52, 79, 1, '2023', 'Jurnal Ekonomi dan Kewirausahaan West Science', 'Dampak Pendidikan Kewirausahaan terhadap Keberhasilan Memulai Bisnis: Sebuah Studi Longitudinal', '2985-3818', '1', '3', '196', '206', 'https://wnj.westscience-press.com/index.php/jekws/article/view/520/461', 'jurnal/24112204034777.pdf', '[]', '2024-11-22 09:03:47', '2024-11-22 09:03:47'),
(53, 77, 1, '2023', 'JEMSI (Jurnal Ekonomi, Manajemen, dan Akuntansi', 'Analysis of the Influence of Work Discipline, Motivation and Leadership Style on Performance of Automobile Authorized Dealer Company', '2579-5635', '9', '4', '1489', '1495', 'https://journal.lembagakita.org/index.php/jemsi/article/view/1369', 'jurnal/24112204051623.pdf', '[]', '2024-11-22 09:05:16', '2024-11-22 09:05:16'),
(54, 79, 1, '2023', 'JABI: Jurnal Abdimas Bhakti Indonesia', 'PELATIHAN BERWIRAUSAHA DENGAN MEMANFAATKAN MEDIA SOSIAL UNTUK MEMBANGUN JIWA MUDA MENJADI ENTREPRENEUR BAGI SISWA SMA N 2 SLAWI', '2721-0278', '4', '1', '93', '100', 'https://ejournal.bhamada.ac.id/index.php/JABI/article/view/503/349', 'jurnal/24112204070594.pdf', '[]', '2024-11-22 09:07:05', '2024-11-22 09:07:05'),
(55, 77, 1, '2023', 'Jurnal Minfo Polgan', 'Analisis Pengaruh Likuiditas, Leverage, dan Profitabilitas terhadap Nilai Perusahaan dengan Kebijakan Dividen sebagai Variabel Intervening', '2797-3298', '12', '1', '1186', '1200', 'https://www.polgan.ac.id/jurnal/index.php/jmp/article/view/12662', 'jurnal/24112204084132.pdf', '[]', '2024-11-22 09:08:41', '2024-11-22 09:08:41'),
(56, 78, 1, '2024', 'Innovative: Journal Of Social Science Research', 'Pengaruh Ketersediaan Produk Dan Word Of Mouth Terhadap Keputusan Pembelian Pada Konsumen CV. Alisa', '2807-4238', '4', '3', '9107', '9117', 'https://j-innovative.org/index.php/Innovative/article/view/11382', 'jurnal/24112204102671.pdf', '[]', '2024-11-22 09:10:03', '2024-11-22 09:10:26'),
(57, 77, 1, '2024', 'Journal Of Human And Education (JAHE)', 'Pengenalan Digital Marketing Untuk Pelaku Usaha UMKM Diwilayah Kecamatan Pangkah', '2776-5857', '4', '1', '1', '5', 'http://jahe.or.id/index.php/jahe/article/view/528', 'jurnal/24112204114744.pdf', '[]', '2024-11-22 09:11:47', '2024-11-22 09:11:47'),
(59, 80, 1, '2024', 'comunity developen jurnal', 'PELATIHAN DASAR-DASAR LAPORAN KEUANGAN BUMDES DESA BULAKWARU KAB.TEGAL', '2721-5008', '5', '3', '144', '123', 'https://journal.universitaspahlawan.ac.id/index.php/cdj/article/view/30400', 'jurnal/24112204142673.pdf', '[]', '2024-11-22 09:14:26', '2024-11-22 09:14:26'),
(60, 79, 1, '2024', 'JABI', 'PELATIHAN BERWIRAUSAHA DENGAN MEMANFAATKAN MEDIA SOSIAL UNTUK MEMBANGUN JIWA MUDA MENJADI ENTREPRENEUR BAGI SISWA SMA N 2 SLAWI', '2721-0286', '4', '1', '93', '100', 'https://www.ejournal.bhamada.ac.id/index.php/JABI/article/view/503', 'jurnal/24112204162730.pdf', '[]', '2024-11-22 09:16:27', '2024-11-22 09:16:27'),
(61, 77, 1, '2023', 'Sangkara Manajemen dan Bisnis', 'Peta Keterkaitan Konsep dalam Penelitian Kepemimpinan Kewirausahaan: Analisis Bibliometrik dan Co-occurrence', '2985-7783', '1', '3', '217', '288', 'https://sj.eastasouth-institute.com/index.php/smb/article/view/219', 'jurnal/24112204184156.pdf', '[]', '2024-11-22 09:18:41', '2024-11-22 09:18:41'),
(62, 77, 1, '2024', 'Jurnal ilmiah Edunomika', 'THE INFLUENCE OF SPIRITUAL LEADERSHIP STYLE AND OCB ON EMPLOYEE PERFORMANCE THROUGH WITH COMMITMENT AS MODERATING VARIABLE', '2985-5322', '8', '1', '1', '9', 'https://jurnal.stie-aas.ac.id/index.php/jie/article/view/10974', 'jurnal/24112204194945.pdf', '[]', '2024-11-22 09:19:49', '2024-11-22 09:19:49'),
(63, 78, 1, '2024', 'Sinergi : Jurnal Riset Ilmiah', 'PERAN MOTIVASI DAN KUALITAS KEHIDUPAN KERJA DALAM MEMPENGARUHI ORGANIZATIONAL CITIZENSHIP BEHAVIOR PADA PT ARIABIMA PROPERINDO', '3031-8947', '1', '10', '911', '919', 'https://manggalajournal.org/index.php/SINERGI/article/view/448', 'jurnal/24112204211396.pdf', '[]', '2024-11-22 09:21:13', '2024-11-22 09:21:13'),
(64, 78, 1, '2024', 'Besriru : Jurnal pengabdian masyarakat', 'MENINGKATKAN MINAT BERWIRAUSAHA MELALUI PELATIHAN SOSIAL MEDIA MARKETING DAN PRODUCT PHOTO STYLING BAGI SISWA SMA NEGERI 2 SLAWI', '3031-9420', '1', '10', '785', '790', 'https://manggalajournal.org/index.php/BESIRU/article/view/446', 'jurnal/24112204254995.pdf', '[]', '2024-11-22 09:25:49', '2024-11-22 09:25:49'),
(65, 77, 1, '2024', 'Journal Of Human And Education (JAHE)', 'Pengenalan Digital Marketing Untuk Pelaku Usaha UMKM Diwilayah Kecamatan Pangkah', '2776-5857', '4', '1', '1', '5', 'https://jahe.or.id/index.php/jahe/article/view/528', 'jurnal/24112204270387.pdf', '[]', '2024-11-22 09:27:03', '2024-11-22 09:27:03'),
(66, 75, 1, '2024', 'comunity developen jurnal', 'PENINGKATAN KREATIVITAS KEWIRAUSAHAAN PADA SISWA PONPES AL QURTUBIYAH TEGAL UNTUK MEWUJUDKAN EKOSISTEM EKONOMI DIGITAL', '2721-5008', '5', '5', '8894', '8900', 'https://journal.universitaspahlawan.ac.id/index.php/cdj/article/view/34525', 'jurnal/24112204283359.pdf', '[]', '2024-11-22 09:28:33', '2024-11-22 09:28:33'),
(67, 77, 1, '2024', 'Jurnal of innovation Research And Knowledge', 'PENGARUH KUALITAS PRODUK DAN HARGA TERHADAP KEPUASAN KONSUMEN DI TOKO MEUBEL MULYA JAYA', '2798-3641', '4', '6', '3543', '3560', 'https://bajangjournal.com/index.php/JIRK/article/view/8867', 'jurnal/24112204300552.pdf', '[]', '2024-11-22 09:30:05', '2024-11-22 09:30:05');

-- --------------------------------------------------------

--
-- Table structure for table `jurnal_personels`
--

CREATE TABLE `jurnal_personels` (
  `id` bigint UNSIGNED NOT NULL,
  `jurnal_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jurnal_personels`
--

INSERT INTO `jurnal_personels` (`id`, `jurnal_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 41, '2024-11-21 09:42:21', '2024-11-21 09:42:21'),
(2, 1, 36, '2024-11-21 09:42:21', '2024-11-21 09:42:21'),
(3, 3, 20, '2024-11-21 09:47:17', '2024-11-21 09:47:17'),
(4, 4, 26, '2024-11-21 09:49:03', '2024-11-21 09:49:03'),
(5, 5, 27, '2024-11-22 01:26:26', '2024-11-22 01:26:26'),
(6, 6, 19, '2024-11-22 01:29:30', '2024-11-22 01:29:30'),
(7, 8, 27, '2024-11-22 01:38:31', '2024-11-22 01:38:31'),
(8, 9, 51, '2024-11-22 01:40:37', '2024-11-22 01:40:37'),
(9, 10, 42, '2024-11-22 01:42:09', '2024-11-22 01:42:09'),
(10, 11, 45, '2024-11-22 01:44:07', '2024-11-22 01:44:07'),
(11, 12, 28, '2024-11-22 01:45:57', '2024-11-22 01:45:57'),
(12, 13, 28, '2024-11-22 01:47:35', '2024-11-22 01:47:35'),
(13, 14, 69, '2024-11-22 01:49:52', '2024-11-22 01:49:52'),
(14, 14, 70, '2024-11-22 01:49:52', '2024-11-22 01:49:52'),
(15, 15, 68, '2024-11-22 01:52:34', '2024-11-22 01:52:34'),
(16, 15, 69, '2024-11-22 01:52:34', '2024-11-22 01:52:34'),
(17, 16, 36, '2024-11-22 02:06:31', '2024-11-22 02:06:31'),
(18, 17, 45, '2024-11-22 02:08:19', '2024-11-22 02:08:19'),
(19, 17, 42, '2024-11-22 02:08:19', '2024-11-22 02:08:19'),
(20, 17, 38, '2024-11-22 02:08:19', '2024-11-22 02:08:19'),
(21, 18, 73, '2024-11-22 02:10:07', '2024-11-22 02:10:07'),
(22, 18, 72, '2024-11-22 02:10:07', '2024-11-22 02:10:07'),
(23, 19, 18, '2024-11-22 02:14:26', '2024-11-22 02:14:26'),
(24, 19, 22, '2024-11-22 02:14:26', '2024-11-22 02:14:26'),
(25, 19, 28, '2024-11-22 02:14:26', '2024-11-22 02:14:26'),
(26, 20, 37, '2024-11-22 02:16:06', '2024-11-22 02:16:06'),
(27, 20, 39, '2024-11-22 02:16:06', '2024-11-22 02:16:06'),
(28, 22, 11, '2024-11-22 02:55:56', '2024-11-22 02:55:56'),
(29, 22, 8, '2024-11-22 02:55:56', '2024-11-22 02:55:56'),
(30, 23, 42, '2024-11-22 02:57:48', '2024-11-22 02:57:48'),
(31, 23, 38, '2024-11-22 02:57:48', '2024-11-22 02:57:48'),
(32, 25, 69, '2024-11-22 04:32:58', '2024-11-22 04:32:58'),
(33, 25, 70, '2024-11-22 04:32:58', '2024-11-22 04:32:58'),
(34, 27, 50, '2024-11-22 04:36:02', '2024-11-22 04:36:02'),
(35, 27, 46, '2024-11-22 04:36:02', '2024-11-22 04:36:02'),
(36, 28, 20, '2024-11-22 04:37:51', '2024-11-22 04:37:51'),
(37, 28, 23, '2024-11-22 04:37:51', '2024-11-22 04:37:51'),
(38, 28, 22, '2024-11-22 04:37:51', '2024-11-22 04:37:51'),
(39, 31, 52, '2024-11-22 05:41:52', '2024-11-22 05:41:52'),
(40, 31, 69, '2024-11-22 05:41:52', '2024-11-22 05:41:52'),
(41, 32, 74, '2024-11-22 05:45:49', '2024-11-22 05:45:49'),
(42, 33, 48, '2024-11-22 05:50:03', '2024-11-22 05:50:03'),
(43, 34, 49, '2024-11-22 05:52:59', '2024-11-22 05:52:59'),
(44, 34, 48, '2024-11-22 05:52:59', '2024-11-22 05:52:59'),
(45, 35, 23, '2024-11-22 05:54:45', '2024-11-22 05:54:45'),
(46, 36, 78, '2024-11-22 05:56:20', '2024-11-22 05:56:20'),
(47, 36, 79, '2024-11-22 05:56:20', '2024-11-22 05:56:20'),
(48, 37, 77, '2024-11-22 05:58:06', '2024-11-22 05:58:06'),
(49, 37, 79, '2024-11-22 05:58:06', '2024-11-22 05:58:06'),
(50, 39, 68, '2024-11-22 06:01:22', '2024-11-22 06:01:22'),
(51, 39, 51, '2024-11-22 06:01:22', '2024-11-22 06:01:22'),
(52, 41, 77, '2024-11-22 06:05:48', '2024-11-22 06:05:48'),
(53, 41, 79, '2024-11-22 06:05:48', '2024-11-22 06:05:48'),
(54, 43, 77, '2024-11-22 06:10:01', '2024-11-22 06:10:01'),
(55, 43, 78, '2024-11-22 06:10:01', '2024-11-22 06:10:01'),
(56, 45, 77, '2024-11-22 06:14:59', '2024-11-22 06:14:59'),
(57, 45, 78, '2024-11-22 06:14:59', '2024-11-22 06:14:59'),
(58, 45, 80, '2024-11-22 06:14:59', '2024-11-22 06:14:59'),
(59, 46, 77, '2024-11-22 06:17:42', '2024-11-22 06:17:42'),
(60, 46, 78, '2024-11-22 06:17:42', '2024-11-22 06:17:42'),
(61, 46, 79, '2024-11-22 06:17:42', '2024-11-22 06:17:42'),
(62, 54, 77, '2024-11-22 09:07:05', '2024-11-22 09:07:05'),
(63, 54, 78, '2024-11-22 09:07:05', '2024-11-22 09:07:05'),
(64, 54, 80, '2024-11-22 09:07:05', '2024-11-22 09:07:05'),
(65, 55, 78, '2024-11-22 09:08:41', '2024-11-22 09:08:41'),
(66, 55, 79, '2024-11-22 09:08:41', '2024-11-22 09:08:41'),
(67, 56, 77, '2024-11-22 09:10:03', '2024-11-22 09:10:03'),
(68, 56, 79, '2024-11-22 09:10:03', '2024-11-22 09:10:03'),
(69, 56, 80, '2024-11-22 09:10:03', '2024-11-22 09:10:03'),
(70, 57, 78, '2024-11-22 09:11:47', '2024-11-22 09:11:47'),
(71, 57, 79, '2024-11-22 09:11:47', '2024-11-22 09:11:47'),
(72, 57, 80, '2024-11-22 09:11:47', '2024-11-22 09:11:47'),
(75, 59, 77, '2024-11-22 09:14:26', '2024-11-22 09:14:26'),
(76, 59, 78, '2024-11-22 09:14:26', '2024-11-22 09:14:26'),
(77, 59, 79, '2024-11-22 09:14:26', '2024-11-22 09:14:26'),
(78, 60, 77, '2024-11-22 09:16:27', '2024-11-22 09:16:27'),
(79, 60, 78, '2024-11-22 09:16:27', '2024-11-22 09:16:27'),
(80, 60, 80, '2024-11-22 09:16:27', '2024-11-22 09:16:27'),
(81, 63, 77, '2024-11-22 09:21:13', '2024-11-22 09:21:13'),
(82, 63, 79, '2024-11-22 09:21:13', '2024-11-22 09:21:13'),
(83, 63, 80, '2024-11-22 09:21:13', '2024-11-22 09:21:13'),
(84, 64, 77, '2024-11-22 09:25:49', '2024-11-22 09:25:49'),
(85, 64, 79, '2024-11-22 09:25:49', '2024-11-22 09:25:49'),
(86, 64, 80, '2024-11-22 09:25:49', '2024-11-22 09:25:49'),
(87, 65, 78, '2024-11-22 09:27:03', '2024-11-22 09:27:03'),
(88, 65, 79, '2024-11-22 09:27:03', '2024-11-22 09:27:03'),
(89, 65, 80, '2024-11-22 09:27:03', '2024-11-22 09:27:03'),
(90, 66, 76, '2024-11-22 09:28:33', '2024-11-22 09:28:33'),
(91, 66, 77, '2024-11-22 09:28:33', '2024-11-22 09:28:33'),
(92, 66, 79, '2024-11-22 09:28:33', '2024-11-22 09:28:33'),
(93, 67, 65, '2024-11-22 09:30:05', '2024-11-22 09:30:05'),
(94, 67, 69, '2024-11-22 09:30:05', '2024-11-22 09:30:05'),
(95, 67, 78, '2024-11-22 09:30:05', '2024-11-22 09:30:05'),
(96, 67, 79, '2024-11-22 09:30:05', '2024-11-22 09:30:05'),
(97, 67, 80, '2024-11-22 09:30:05', '2024-11-22 09:30:05');

-- --------------------------------------------------------

--
-- Table structure for table `luarans`
--

CREATE TABLE `luarans` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `jenis_luaran_id` bigint UNSIGNED NOT NULL,
  `tahun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `luaran_personels`
--

CREATE TABLE `luaran_personels` (
  `id` bigint UNSIGNED NOT NULL,
  `luaran_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `makalahs`
--

CREATE TABLE `makalahs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `tingkat` enum('regional','nasional','internasional') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `forum` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `institusi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_awal` date NOT NULL,
  `tanggal_akhir` date NOT NULL,
  `tempat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('biasa','spesial') COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `makalahs`
--

INSERT INTO `makalahs` (`id`, `user_id`, `tingkat`, `tahun`, `judul`, `forum`, `institusi`, `tanggal_awal`, `tanggal_akhir`, `tempat`, `status`, `file`, `created_at`, `updated_at`) VALUES
(1, 69, 'regional', '2022', 'Semantic Error Analysis on Fieldwork Report by the Students of SMK Semesta Bumiayu', 'The Tegal International Conference on Applied Social Science & Humanities (TICASSH 2022)', 'Universitas Bhamada Slawi', '2022-11-11', '2022-11-11', 'Tegal', 'spesial', 'makalah/24112511544028.pdf', '2024-11-25 04:54:40', '2024-11-25 04:55:59');

-- --------------------------------------------------------

--
-- Table structure for table `makalah_personels`
--

CREATE TABLE `makalah_personels` (
  `id` bigint UNSIGNED NOT NULL,
  `makalah_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `makalah_personels`
--

INSERT INTO `makalah_personels` (`id`, `makalah_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 68, '2024-11-25 04:54:40', '2024-11-25 04:54:40'),
(2, 1, 51, '2024-11-25 04:54:40', '2024-11-25 04:54:40');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2024_08_05_064458_create_fakultas_table', 1),
(3, '2024_08_05_084713_create_prodis_table', 1),
(4, '2024_08_06_000000_create_users_table', 1),
(5, '2024_08_06_081854_create_jenis_pendanaans_table', 1),
(6, '2024_08_06_082635_create_jenis_penelitians_table', 1),
(7, '2024_08_06_082646_create_jenis_pengabdians_table', 1),
(8, '2024_08_15_024047_create_proposals_table', 1),
(9, '2024_08_15_024056_create_proposal_personels_table', 1),
(10, '2024_09_02_154218_create_proposal_jadwals_table', 1),
(11, '2024_09_04_100606_create_proposal_revisis_table', 1),
(12, '2024_09_11_152207_create_penelitians_table', 1),
(13, '2024_09_12_083207_create_penelitian_personels_table', 1),
(14, '2024_09_12_090140_create_pengabdians_table', 1),
(15, '2024_09_12_090148_create_pengabdian_personels_table', 1),
(16, '2024_09_19_091130_create_penelitian_revisis_table', 1),
(17, '2024_09_19_091137_create_pengabdian_revisis_table', 1),
(18, '2024_10_14_113045_create_proposal_mous_table', 1),
(19, '2024_11_01_084130_create_jenis_jurnals_table', 1),
(20, '2024_11_01_103726_create_jurnals_table', 1),
(21, '2024_11_01_106028_create_jurnal_personels_table', 1),
(22, '2024_11_06_151740_create_bukus_table', 1),
(23, '2024_11_06_152740_create_buku_personels_table', 1),
(24, '2024_11_06_163035_create_makalahs_table', 1),
(25, '2024_11_06_163135_create_makalah_personels_table', 1),
(26, '2024_11_06_163501_create_jenis_hkis_table', 1),
(27, '2024_11_06_163657_create_hkis_table', 1),
(28, '2024_11_11_104711_create_hki_personels_table', 1),
(29, '2024_11_14_094602_create_jenis_luarans_table', 1),
(30, '2024_11_14_095424_create_luarans_table', 1),
(31, '2024_11_15_104726_create_luaran_personels_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `penelitians`
--

CREATE TABLE `penelitians` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `tahun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_pendanaan_id` bigint UNSIGNED NOT NULL,
  `jenis_penelitian_id` bigint UNSIGNED DEFAULT NULL,
  `dana_setuju` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mahasiswas` json DEFAULT NULL,
  `status` enum('menunggu','revisi','selesai') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penelitians`
--

INSERT INTO `penelitians` (`id`, `user_id`, `tahun`, `judul`, `jenis_pendanaan_id`, `jenis_penelitian_id`, `dana_setuju`, `file`, `mahasiswas`, `status`, `created_at`, `updated_at`) VALUES
(1, 52, '2020', 'Identifikasi Katekin Ekstrak Etanol Kulit Pisang Kepok Kuning (Musa Balbisiana)', 1, 2, '7000000', NULL, '[]', 'selesai', '2024-11-20 02:39:10', '2024-11-20 02:39:10'),
(2, 47, '2020', 'Aktivitas Antidiabetik Kombinasi Ekstrak Rimpang Kunyit (Curcuma Domestica Val.) dan Metformin pada Zebrafish (Danio Rerio)', 1, 2, '7000000', NULL, '[]', 'selesai', '2024-11-20 02:48:28', '2024-11-20 02:48:28'),
(3, 66, '2020', 'Implementasi Manajemen Keselamatan dan Kesehatan Kerja di Rumah Sakit Umum Daerah Kardinah Tegal Tahun 2020', 1, 2, '7000000', NULL, '[]', 'selesai', '2024-11-20 02:51:44', '2024-11-20 02:51:44'),
(4, 68, '2020', 'Hubungan Pengetahuan tentang Circular Economy terhadap Perilaku Membuang sampah Mahasiswa STIKes Bhamada Slawi', 1, 2, '7000000', NULL, '[]', 'selesai', '2024-11-20 02:53:21', '2024-11-20 02:53:21'),
(5, 21, '2020', 'Hubungan Supervisi Kepala Ruang dengan Kepatuhan Perawat Melakukan Cuci Tangan di rumah Sakit Mitra Keluarga Tegal', 1, 2, '7000000', NULL, '[]', 'selesai', '2024-11-20 02:54:38', '2024-11-20 02:54:38'),
(6, 26, '2020', 'Strategi Koping Kader Kesehatan dalam Menghadapi Kesulitan di Posyandu: Studi Fenomenlogi', 1, 2, '7000000', NULL, '[]', 'selesai', '2024-11-20 03:00:16', '2024-11-20 03:00:16'),
(7, 44, '2020', 'Analisis Faktor Maternal terhadap Keteraturan Kunjungan Antenatal Care (ANC) di Wilayah Kerja Puskesmas Slawi Kabupaten Tegal', 1, 2, '7000000', NULL, '[]', 'selesai', '2024-11-20 03:02:16', '2024-11-20 03:02:16'),
(8, 36, '2020', 'Hubungan Anemia pada Ibu Bersalin dengan Kejadian BBLR di RSI PKU Muhammadiyah Singkil', 1, 2, '7000000', NULL, '[]', 'selesai', '2024-11-20 03:05:08', '2024-11-20 03:05:08'),
(9, 43, '2020', 'Pengaruh Peran Aktif Kader Kesehatan terhadap Kunjungan Neonatus Lengkap di Posyandu desa Timbangreja Wilayah Kerja Puskesmas Lebaksiu Kabupaten Tegal', 1, 2, '7000000', NULL, '[]', 'selesai', '2024-11-20 03:06:15', '2024-11-20 03:06:15'),
(10, 38, '2020', 'Studi Korelasi Ruang Lingkup Bidan dan Konselor Sebaya terhadap Perilaku Remaja di SMA N 3 Slawi', 1, 2, '7000000', NULL, '[]', 'selesai', '2024-11-20 03:07:31', '2024-11-20 03:07:31'),
(11, 37, '2020', 'Kepatuhan Kunjungan Antenatal Care Berdasarkan Faktor Maternal', 1, 2, '7000000', NULL, '[]', 'selesai', '2024-11-20 06:37:01', '2024-11-20 06:59:10'),
(12, 50, '2020', 'Hubungan Dukungan Keluarga terhadap Pemberian ASI Eksklusif pada Ibu Menyusui', 1, 2, '7000000', NULL, '[]', 'selesai', '2024-11-20 06:43:21', '2024-11-20 06:43:21'),
(13, 41, '2020', 'Hubungan Dukungan Keluarga terhadap Pemberian ASI Eksklusif pada Ibu Menyusui', 1, 2, '7000000', NULL, '[]', 'selesai', '2024-11-20 06:44:23', '2024-11-20 06:44:23'),
(14, 10, '2020', 'Studi Fenomenologi: Resieliensi Keluarga dalam Menerima Stigma Negatif Paska Positif Covid-19', 1, 2, '7000000', NULL, '[]', 'selesai', '2024-11-20 06:45:53', '2024-11-20 06:58:44'),
(15, 7, '2020', 'Pengaruh Health Coaching terhadap Perilaku Pencegahan Penularan Tuberkulosis di Kabupaten Tegal', 1, 2, '7000000', NULL, '[]', 'selesai', '2024-11-20 06:47:09', '2024-11-20 06:47:09'),
(16, 7, '2020', 'Studi Kualitatif: Eksplorasi Kebutuhan Keluarga dalam Keperawatan Ibu Hamil dengan Preeklampsia', 1, 2, '7000000', NULL, '[]', 'selesai', '2024-11-20 06:52:55', '2024-11-20 06:52:55'),
(17, 11, '2020', 'Pengaruh Emotional Freedom Technique (EFT) terhadap Tingkat Kecemasan Ibu yang Memiliki Bayi Berat Lahir Rendah (BBLR) di Ruang Peristi RSUD dr. Soeselo Kab. Tegal', 1, 2, '7000000', NULL, '[]', 'selesai', '2024-11-20 06:53:46', '2024-11-20 06:53:46'),
(18, 74, '2021', 'Analisis Perbandingan Protokol Routing OSPF dan Static untuk Optimalisasi Jaringan Komputer SMA Negeri 3 Tegal', 1, 2, '8000000', 'penelitian/24112001555171.pdf', '[]', 'selesai', '2024-11-20 06:54:55', '2024-11-20 06:55:51'),
(19, 73, '2021', 'Sistem Absensi Karyawan dan Instruktur Komputer Dengan Sensor RFID Berbasis ARDUINO UNO', 1, 2, '8000000', 'penelitian/24112001573162.pdf', '[]', 'selesai', '2024-11-20 06:57:31', '2024-11-20 06:57:31'),
(20, 72, '2021', 'Optimasi Metode Naive Bayes dengan Feature Selection Information Gain untuk Prediksi Kelulusan Mahasiswa Tepat Waktu', 1, 2, '8000000', 'penelitian/24112002090467.pdf', '[]', 'selesai', '2024-11-20 06:59:59', '2024-11-20 07:09:04'),
(21, 71, '2021', 'HUBUNGAN PENERAPAN PROTOKOL KESEHATAN DENGAN KEPATUHAN KARYAWAN DALAM PENCEGAHAN COVID – 19 DI MUTIARA CAHAYA SWALAYAN SLAWI', 1, 2, '8000000', 'penelitian/24112002082968.pdf', '[]', 'selesai', '2024-11-20 07:08:29', '2024-11-20 07:08:29'),
(22, 67, '2021', 'ANALISIS FAKTOR YANG MEMPENGARUHI TERHADAP KEPATUHAN PROTOKOL KESEHATAN PADA SISWA SMK BINA NUSA SLAWI DENGAN PENDEKATAN HEALTH BELIEF MODEL', 1, 2, '8000000', 'penelitian/24112002110954.pdf', '[]', 'selesai', '2024-11-20 07:11:09', '2024-11-20 07:11:09'),
(23, 42, '2021', 'ANALISIS FAKTOR KEJADIAN ANEMIA PADA KEHAMILAN REMAJA DI POSYANDU WILAYAH PUSKESMAS PANGKAH', 1, 2, '8000000', 'penelitian/24112002125199.pdf', '[]', 'selesai', '2024-11-20 07:12:51', '2024-11-20 07:12:51'),
(24, 39, '2021', 'HUBUNGAN PENGETAHUAN DENGAN KECEMASAN IBU HAMIL MENGHADAPI VAKSINASI COVID-19', 1, 2, '8000000', 'penelitian/24112002155895.pdf', '[]', 'selesai', '2024-11-20 07:15:58', '2024-11-20 07:15:58'),
(25, 45, '2021', 'HUBUNGAN DUKUNGAN TERHADAP KEJADIAN POST PARTUM BLUES PADA IBU NIFAS DI DESA DUKUHWARU KABUPATEN TEGAL', 1, 2, '8000000', 'penelitian/24112002182819.pdf', '[]', 'selesai', '2024-11-20 07:18:28', '2024-11-20 07:18:28'),
(26, 18, '2021', 'PENGARUH PENDIDIKAN KESEHATAN STANDING BANNER TERHADAP PERILAKU CUCI TANGAN PAKAI SABUN SELAMA PTM TERBATAS PANDEMI COVID-19 DI SDN SLAWI KULON 05 KABUPATEN TEGAL', 1, 2, '8000000', 'penelitian/24112002224865.pdf', '[]', 'selesai', '2024-11-20 07:22:48', '2024-11-20 07:22:48'),
(27, 41, '2021', 'HUBUNGAN IBU BERSALIN TERKONFIRMASI COVID -19 DENGAN JENIS PERSALINAN DI PUSKESMAS SLAWI KABUPATEN TEGAL', 1, 2, '8000000', NULL, '[]', 'selesai', '2024-11-20 07:25:06', '2024-11-20 07:25:06'),
(28, 14, '2021', 'PENGARUH EDUKASI PERTOLONGAN PERTAMA PADA KECELAKAAN TERHADAP TINGKAT PENGETAHUAN DAN KETRAMPILAN GURU TENTANG PERTOLONGAN PERTAMA DI SDN 03 LEBAKSIU KIDUL', 1, 2, '8000000', 'penelitian/24112002263096.pdf', '[]', 'selesai', '2024-11-20 07:26:30', '2024-11-20 07:26:30'),
(29, 50, '2021', 'PERBANDINGAN METODE EKSTRAKSI TERHADAP KADAR FLAVONOID TOTAL EKSTRAK ETANOL DAUN KERSEN (Muntingia calabura L.)', 1, 2, '8000000', 'penelitian/24112002282578.pdf', '[]', 'selesai', '2024-11-20 07:28:25', '2024-11-20 07:28:25'),
(30, 77, '2021', 'PENGARUH KEUNGGULAN PRODUK DAN KEUNGGULAN LAYANAN TERHADAP KEPUTUSAN PEMBELIAN KONSUMEN DI CV. PUCUK DAUN LESTARI', 3, 2, '8000000', 'penelitian/24112002295721.pdf', '[]', 'selesai', '2024-11-20 07:29:57', '2024-11-20 07:29:57'),
(31, 11, '2021', 'MINYAK JINTAN HITAM (NIGELLA SATIVA OIL) DAPAT MENCEGAH RUAM POPOK PADA BALITA DENGAN DIARE', 6, 2, '8000000', 'penelitian/24112108423049.pdf', '[]', 'selesai', '2024-11-21 01:42:14', '2024-11-21 01:42:30'),
(32, 29, '2021', 'HUBUNGAN VERBAL BULLYING DENGAN INTERAKSI SOSIAL PADA REMAJA', 6, 2, '8000000', 'penelitian/24112108435187.pdf', '[]', 'selesai', '2024-11-21 01:43:51', '2024-11-21 01:47:12'),
(33, 10, '2021', 'PENGALAMAN KESEPIAN PADA LANSIA: SYSTEMATIC REVIEW', 6, 2, '8000000', 'penelitian/24112108454994.pdf', '[]', 'selesai', '2024-11-21 01:45:49', '2024-11-21 01:45:49'),
(34, 18, '2021', 'BEBAN KERJA PERAWAT PELAKSANA DENGAN PENERAPAN PATIENT SAFETY DI RUANG-ISOLASI COVID-19 RS MITRA SIAGA TEGAL', 6, 2, '8000000', 'penelitian/24112108511428.pdf', '[]', 'selesai', '2024-11-21 01:51:14', '2024-11-21 01:51:14'),
(36, 8, '2021', 'DUKUNGAN SOSIAL TEMAN SEBAYA DENGAN IDENTITAS DIRI REMAJA PUTRI SMK AL MANAAR MUHAMMADIYAH PEMALANG', 6, 2, '8000000', 'penelitian/24112108555953.pdf', '[]', 'selesai', '2024-11-21 01:55:59', '2024-11-21 01:55:59'),
(37, 28, '2022', 'HUBUNGAN BERMAIN GAME ONLINE DENGAN PERILAKU AGRESIF PADA REMAJA DI SMK BHAKTI PRAJA SLAWI', 6, 2, '9000000', 'penelitian/24112109171214.pdf', '[]', 'selesai', '2024-11-21 02:17:12', '2024-11-21 02:17:12'),
(38, 48, '2022', 'Evaluasi Penggunaan Obat Pada Pasien Gastritis di Puskesmas Kaladawa Periode Oktober-Desember 2018', 6, 2, '9000000', 'penelitian/24112109184383.pdf', '[]', 'selesai', '2024-11-21 02:18:43', '2024-11-21 02:18:43'),
(39, 18, '2022', 'HUBUNGAN ANTARA DEMENSIA DENGAN ACTIVITY OF DAILY LIVING (ADL) PADA LANJUT USIA', 6, 2, '9000000', 'penelitian/24112109195968.pdf', '[]', 'selesai', '2024-11-21 02:19:59', '2024-11-21 02:19:59'),
(40, 46, '2022', 'Fitokimia dan Aktivitas Antioksidan Ekstrak Temu Blenyeh (Curcuma purpurascens Blumae)', 6, 2, '9000000', 'penelitian/24112109215438.pdf', '[]', 'selesai', '2024-11-21 02:21:54', '2024-11-21 02:21:54'),
(41, 37, '2022', 'Hubungan Dukungan Sosial Ibu dengan Tingkat Kecemasan Dalam Menghadapi Sindrom Premenstruasi Pada Remaja Putri', 6, 2, '9000000', 'penelitian/24112109231460.pdf', '[]', 'selesai', '2024-11-21 02:23:14', '2024-11-21 02:23:14'),
(42, 36, '2022', 'PERBEDAAN CAPAIAN AKSEPTOR KB DI KABUPATEN TEGAL SEBELUM DAN SESUDAH PENCANANGAN KAMPUNG KB', 6, 2, '9000000', 'penelitian/24112109242876.pdf', '[]', 'selesai', '2024-11-21 02:24:28', '2024-11-21 02:24:28'),
(43, 19, '2022', 'HUBUNGAN TINGKAT STRESS ORANGTUA DENGAN MEKANISME KOPING PADA ORANGTUA YANG MEMILIKI ANAK TUNA GRAHITA USIA 7-18 TAHUN DI SLB N SLAWI', 6, 2, '9000000', 'penelitian/24112109253511.pdf', '[]', 'selesai', '2024-11-21 02:25:35', '2024-11-21 02:25:35'),
(44, 68, '2022', 'HUBUNGAN PENGETAHUAN TENTANG KESELAMATAN DENGAN PERILAKU TIDAK AMAN PETANI BAWANG MERAH DI DESA TEGALGLAGA KABUPATEN BREBES', 6, 2, '9000000', 'penelitian/24112109372479.pdf', '[]', 'selesai', '2024-11-21 02:37:24', '2024-11-21 02:37:24'),
(45, 73, '2022', 'Penerapan Algoritma Apriori Pada Data Transaksi Penjualan Produk Wings Untuk Membantu Strategi', 1, 2, '9000000', NULL, '[]', 'selesai', '2024-11-21 02:39:12', '2024-11-21 02:39:12'),
(46, 72, '2022', 'Penerapan Metode Simple Additive Weighting (SAW) untuk Pemilihan Siswa Terbaik', 1, 2, '9000000', NULL, '[]', 'selesai', '2024-11-21 02:41:18', '2024-11-21 02:41:18'),
(47, 37, '2022', 'Studi Korelasi Riwayat Keluarga Dengan Kejadian Hipertensi Dalam Kehamilan', 1, 2, '9000000', NULL, '[]', 'selesai', '2024-11-21 02:42:56', '2024-11-21 02:42:56'),
(48, 38, '2022', 'Hubungan Antara Riwayat Status Gizi Ibu Hamil dengan Kejadian Stunting Balita', 1, 2, '9000000', NULL, '[]', 'selesai', '2024-11-21 02:44:13', '2024-11-21 02:44:13'),
(49, 36, '2022', 'Hubungan Berat Badan Lahir Bayi Terhadap Kejadian Ruptur Perineum Di Wilayah Kerja Puskesmas Talang Kabupaten Tegal', 1, 2, '9000000', NULL, '[]', 'selesai', '2024-11-21 03:05:27', '2024-11-21 03:05:27'),
(50, 45, '2022', 'Hubungan Status Gizi Dengan Produksi ASI pada Ibu Nifas di Puskesmas Kaladawa', 1, 2, '9000000', NULL, '[]', 'selesai', '2024-11-21 03:06:13', '2024-11-21 03:06:13'),
(51, 3, '2022', 'Hubungan Pemberian Asi Eksklusif Dengan Kejadian Stunting Pada Balita Di Desa Kalisapu Kabupaten Tegal', 1, 2, '9000000', NULL, '[]', 'selesai', '2024-11-21 03:07:34', '2024-11-21 03:07:34'),
(52, 7, '2022', 'Parenting Self Efficacy Ibu Remaja Dalam Merawat Bayi Baru Lahir (BBL)', 1, 2, '9000000', NULL, '[]', 'selesai', '2024-11-21 03:09:15', '2024-11-21 03:09:15'),
(53, 20, '2022', 'Pengaruh Edukasi Terhadap Pengetahuan dan Keterampilan Kader Kesehatan dalam Penanganan Kegawatdaruratan Kejang Demam Pada Anak Di Desa Penusupan Kabupaten Tegal', 1, 2, '9000000', NULL, '[]', 'selesai', '2024-11-21 03:11:59', '2024-11-21 03:11:59'),
(54, 24, '2022', 'Gambaran Masalah Kesehatan Masyarakat : Bullying Di Lingkungan Sekolah Dasar', 1, 2, '9000000', NULL, '[]', 'selesai', '2024-11-21 03:13:23', '2024-11-21 03:13:23'),
(55, 66, '2022', 'Hubungan Tingkat Pengetahuan dan Sikap Pekerja Harian Lepas Sektor Konstruksi Terhadap Kepesertaan Asuransi BPJS Ketenagakerjaan di Wilayah Kabupaten Tegal', 1, 2, '9000000', NULL, '[]', 'selesai', '2024-11-21 03:14:36', '2024-11-21 03:14:36'),
(56, 68, '2022', 'Hubungan Antara Beban Kerja Dengan Kelelahan Kerja Pada Tenaga Kerja Sektor Konstruksi Pada Proyek Pembangunan RS X Di Kabupaten Tegal', 1, 2, '9000000', NULL, '[]', 'selesai', '2024-11-21 03:16:13', '2024-11-21 03:16:13'),
(57, 54, '2022', 'Analsis Kadar Natrium Siklamat dan Pola Konsumsi Pada Minuman Cappucino Pedagang Kaki Lima dan Kafe di Kabupaten Tegal Menggunakan Metode HPLC', 1, 2, '9000000', NULL, '[]', 'selesai', '2024-11-21 03:17:20', '2024-11-21 03:17:20'),
(58, 79, '2022', 'Pengaruh Keunggulan Produk dan Keunggulan Layanan Terhadap Customer Loyality di Toko Bangunan (TB) Nusa jaya', 1, 2, '2500000', 'penelitian/24112110190019.pdf', '[]', 'selesai', '2024-11-21 03:19:00', '2024-11-21 03:19:00'),
(59, 80, '2022', 'Analisa Rasio Keuangan NPL dan LDR Terhadap Profitabilitas Pada Bank Yang Terdaftar di Bursa Efek Indonesia', 1, 2, '2500000', 'penelitian/24112110210465.pdf', '[]', 'selesai', '2024-11-21 03:21:04', '2024-11-21 03:21:04'),
(60, 83, '2022', 'Peningkatan Penjualan Fanaya Catering Melalui Pemasaran Instagram', 1, 2, '2040000', 'penelitian/24112110225186.pdf', '[]', 'selesai', '2024-11-21 03:22:51', '2024-11-21 03:22:51'),
(61, 29, '2022', 'Pengambilan data persepsi responden internal dan eksternal yang digunakan untuk pengukuran indeks tata kelola berbasis online (ITK-O) Polres Tegal', 2, 2, '10000000', NULL, '[]', 'selesai', '2024-11-21 03:24:03', '2024-11-21 03:24:03'),
(62, 74, '2022', 'Evaluasi kualitas aplikasi soeselo online dengan metode usability testing', 2, 2, '13000000', NULL, '[]', 'selesai', '2024-11-21 03:25:25', '2024-11-21 03:25:25'),
(63, 75, '2022', 'Analisis tingkat kematangan keamanan informasi rekam medik pelayanan elektronik menggunakan framework cobit 5 (Studi Kasus : RSUD. dr. Soeselo)', 2, 2, '13000000', NULL, '[]', 'selesai', '2024-11-21 03:26:38', '2024-11-21 03:26:38'),
(64, 48, '2022', 'Pengaruh kualitas layanan ANTOR (Antar Obat Sampai Rumah) terhadap kepercayaan dan kepuasan pasien rawat jalan di RSUD dr. Soeselo Kabupaten Tegal Tahun 2022', 2, 2, '13000000', NULL, '[]', 'selesai', '2024-11-21 03:27:48', '2024-11-21 03:27:48'),
(65, 66, '2022', 'Evektifitas program bank sampah \"BERLIMPAH\" dalam pemenuhan kesehatan kerja di RSUD dr. Soeselo', 2, 2, '13000000', NULL, '[]', 'selesai', '2024-11-21 03:29:05', '2024-11-21 03:29:05'),
(66, 9, '2022', 'Penerapan Caring Perawat Pada Pasien Emergency Di Ruang UGD Rumah Sakit Di Kota Tegal', 1, 2, '9000000', NULL, '[]', 'selesai', '2024-11-21 03:30:39', '2024-11-21 03:30:39');

-- --------------------------------------------------------

--
-- Table structure for table `penelitian_personels`
--

CREATE TABLE `penelitian_personels` (
  `id` bigint UNSIGNED NOT NULL,
  `penelitian_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penelitian_personels`
--

INSERT INTO `penelitian_personels` (`id`, `penelitian_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 47, '2024-11-20 02:39:10', '2024-11-20 02:39:10'),
(2, 1, 50, '2024-11-20 02:39:10', '2024-11-20 02:39:10'),
(3, 3, 69, '2024-11-20 02:51:44', '2024-11-20 02:51:44'),
(4, 3, 67, '2024-11-20 02:51:44', '2024-11-20 02:51:44'),
(5, 4, 71, '2024-11-20 02:53:21', '2024-11-20 02:53:21'),
(6, 4, 70, '2024-11-20 02:53:21', '2024-11-20 02:53:21'),
(7, 5, 23, '2024-11-20 02:54:38', '2024-11-20 02:54:38'),
(8, 6, 23, '2024-11-20 03:00:16', '2024-11-20 03:00:16'),
(9, 6, 17, '2024-11-20 03:00:16', '2024-11-20 03:00:16'),
(10, 7, 69, '2024-11-20 03:02:16', '2024-11-20 03:02:16'),
(11, 10, 37, '2024-11-20 03:07:31', '2024-11-20 03:07:31'),
(12, 10, 36, '2024-11-20 03:07:31', '2024-11-20 03:07:31'),
(13, 11, 69, '2024-11-20 06:37:01', '2024-11-20 06:37:01'),
(14, 11, 44, '2024-11-20 06:37:01', '2024-11-20 06:37:01'),
(15, 13, 43, '2024-11-20 06:44:23', '2024-11-20 06:44:23'),
(16, 13, 38, '2024-11-20 06:44:23', '2024-11-20 06:44:23'),
(17, 14, 12, '2024-11-20 06:45:53', '2024-11-20 06:45:53'),
(18, 14, 9, '2024-11-20 06:45:53', '2024-11-20 06:45:53'),
(19, 17, 8, '2024-11-20 06:53:46', '2024-11-20 06:53:46'),
(20, 17, 14, '2024-11-20 06:53:46', '2024-11-20 06:53:46'),
(21, 18, 73, '2024-11-20 06:54:55', '2024-11-20 06:54:55'),
(22, 18, 72, '2024-11-20 06:54:55', '2024-11-20 06:54:55'),
(23, 21, 68, '2024-11-20 07:08:29', '2024-11-20 07:08:29'),
(24, 22, 69, '2024-11-20 07:11:09', '2024-11-20 07:11:09'),
(25, 22, 66, '2024-11-20 07:11:09', '2024-11-20 07:11:09'),
(26, 23, 45, '2024-11-20 07:12:51', '2024-11-20 07:12:51'),
(27, 23, 43, '2024-11-20 07:12:51', '2024-11-20 07:12:51'),
(28, 23, 38, '2024-11-20 07:12:51', '2024-11-20 07:12:51'),
(29, 24, 37, '2024-11-20 07:15:58', '2024-11-20 07:15:58'),
(30, 24, 44, '2024-11-20 07:15:58', '2024-11-20 07:15:58'),
(31, 25, 43, '2024-11-20 07:18:28', '2024-11-20 07:18:28'),
(32, 25, 42, '2024-11-20 07:18:28', '2024-11-20 07:18:28'),
(33, 25, 38, '2024-11-20 07:18:28', '2024-11-20 07:18:28'),
(34, 26, 29, '2024-11-20 07:22:48', '2024-11-20 07:22:48'),
(35, 26, 28, '2024-11-20 07:22:48', '2024-11-20 07:22:48'),
(36, 27, 40, '2024-11-20 07:25:06', '2024-11-20 07:25:06'),
(37, 27, 36, '2024-11-20 07:25:06', '2024-11-20 07:25:06'),
(38, 28, 10, '2024-11-20 07:26:30', '2024-11-20 07:26:30'),
(39, 28, 9, '2024-11-20 07:26:30', '2024-11-20 07:26:30'),
(40, 28, 7, '2024-11-20 07:26:30', '2024-11-20 07:26:30'),
(41, 29, 54, '2024-11-20 07:28:25', '2024-11-20 07:28:25'),
(42, 29, 53, '2024-11-20 07:28:25', '2024-11-20 07:28:25'),
(43, 30, 78, '2024-11-20 07:29:57', '2024-11-20 07:29:57'),
(44, 30, 79, '2024-11-20 07:29:57', '2024-11-20 07:29:57'),
(46, 33, 26, '2024-11-21 01:45:49', '2024-11-21 01:45:49'),
(47, 32, 20, '2024-11-21 01:47:12', '2024-11-21 01:47:12'),
(48, 34, 27, '2024-11-21 01:51:14', '2024-11-21 01:51:14'),
(49, 36, 28, '2024-11-21 01:55:59', '2024-11-21 01:55:59'),
(50, 37, 19, '2024-11-21 02:17:12', '2024-11-21 02:17:12'),
(51, 39, 27, '2024-11-21 02:19:59', '2024-11-21 02:19:59'),
(52, 40, 51, '2024-11-21 02:21:54', '2024-11-21 02:21:54'),
(53, 41, 42, '2024-11-21 02:23:14', '2024-11-21 02:23:14'),
(54, 42, 45, '2024-11-21 02:24:28', '2024-11-21 02:24:28'),
(55, 43, 28, '2024-11-21 02:25:35', '2024-11-21 02:25:35'),
(56, 44, 69, '2024-11-21 02:37:24', '2024-11-21 02:37:24'),
(57, 44, 70, '2024-11-21 02:37:24', '2024-11-21 02:37:24'),
(58, 45, 72, '2024-11-21 02:39:12', '2024-11-21 02:39:12'),
(59, 46, 74, '2024-11-21 02:41:18', '2024-11-21 02:41:18'),
(60, 46, 73, '2024-11-21 02:41:18', '2024-11-21 02:41:18'),
(61, 47, 44, '2024-11-21 02:42:56', '2024-11-21 02:42:56'),
(62, 47, 39, '2024-11-21 02:42:56', '2024-11-21 02:42:56'),
(63, 48, 43, '2024-11-21 02:44:13', '2024-11-21 02:44:13'),
(64, 48, 42, '2024-11-21 02:44:13', '2024-11-21 02:44:13'),
(65, 49, 41, '2024-11-21 03:05:27', '2024-11-21 03:05:27'),
(66, 50, 40, '2024-11-21 03:06:13', '2024-11-21 03:06:13'),
(67, 51, 6, '2024-11-21 03:07:34', '2024-11-21 03:07:34'),
(68, 51, 4, '2024-11-21 03:07:34', '2024-11-21 03:07:34'),
(69, 52, 11, '2024-11-21 03:09:15', '2024-11-21 03:09:15'),
(70, 52, 10, '2024-11-21 03:09:15', '2024-11-21 03:09:15'),
(71, 53, 29, '2024-11-21 03:11:59', '2024-11-21 03:11:59'),
(72, 53, 22, '2024-11-21 03:11:59', '2024-11-21 03:11:59'),
(73, 54, 26, '2024-11-21 03:13:23', '2024-11-21 03:13:23'),
(74, 54, 27, '2024-11-21 03:13:23', '2024-11-21 03:13:23'),
(75, 55, 69, '2024-11-21 03:14:36', '2024-11-21 03:14:36'),
(76, 55, 67, '2024-11-21 03:14:36', '2024-11-21 03:14:36'),
(77, 56, 71, '2024-11-21 03:16:13', '2024-11-21 03:16:13'),
(78, 56, 70, '2024-11-21 03:16:13', '2024-11-21 03:16:13'),
(79, 57, 48, '2024-11-21 03:17:20', '2024-11-21 03:17:20'),
(80, 58, 77, '2024-11-21 03:19:00', '2024-11-21 03:19:00'),
(81, 59, 78, '2024-11-21 03:21:04', '2024-11-21 03:21:04'),
(82, 60, 84, '2024-11-21 03:22:51', '2024-11-21 03:22:51'),
(83, 60, 82, '2024-11-21 03:22:51', '2024-11-21 03:22:51'),
(84, 62, 73, '2024-11-21 03:25:25', '2024-11-21 03:25:25'),
(85, 63, 29, '2024-11-21 03:26:38', '2024-11-21 03:26:38'),
(86, 63, 72, '2024-11-21 03:26:38', '2024-11-21 03:26:38'),
(87, 64, 3, '2024-11-21 03:27:48', '2024-11-21 03:27:48'),
(88, 64, 47, '2024-11-21 03:27:48', '2024-11-21 03:27:48'),
(89, 65, 29, '2024-11-21 03:29:05', '2024-11-21 03:29:05'),
(90, 65, 67, '2024-11-21 03:29:05', '2024-11-21 03:29:05'),
(91, 66, 12, '2024-11-21 03:30:39', '2024-11-21 03:30:39'),
(92, 66, 14, '2024-11-21 03:30:39', '2024-11-21 03:30:39');

-- --------------------------------------------------------

--
-- Table structure for table `penelitian_revisis`
--

CREATE TABLE `penelitian_revisis` (
  `id` bigint UNSIGNED NOT NULL,
  `penelitian_id` bigint UNSIGNED NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengabdians`
--

CREATE TABLE `pengabdians` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `tahun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_pendanaan_id` bigint UNSIGNED NOT NULL,
  `jenis_pengabdian_id` bigint UNSIGNED DEFAULT NULL,
  `dana_setuju` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mahasiswas` json DEFAULT NULL,
  `status` enum('menunggu','revisi','selesai') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengabdians`
--

INSERT INTO `pengabdians` (`id`, `user_id`, `tahun`, `judul`, `jenis_pendanaan_id`, `jenis_pengabdian_id`, `dana_setuju`, `file`, `mahasiswas`, `status`, `created_at`, `updated_at`) VALUES
(1, 52, '2020', 'Trik Asyik Cegah Penyebaran Covid-19 di Panti Asuhan Zaenab Masykuri Adiwerna', 1, 1, '6000000', NULL, '[]', 'selesai', '2024-11-21 03:34:12', '2024-11-21 03:34:12'),
(2, 71, '2020', 'Sosialisasi Keselamatan dan Kesehatan Kerja di Laboratorium Farmasi pada Siswa Jurusan Farmasi SMK Harapan Bersama Tegal', 1, 1, '6000000', NULL, '[]', 'selesai', '2024-11-21 03:42:40', '2024-11-21 03:42:40'),
(3, 66, '2020', 'Pelatihan Penggunaan Alat Pemadam Api Ringan (APAR) pada UPTD Laboratorium Perindustrian Kabupaten Tegal', 1, 1, '6000000', NULL, '[]', 'selesai', '2024-11-21 03:44:02', '2024-11-21 03:44:02'),
(4, 28, '2020', 'Pelatihan Care Giver Orang dengan Gangguan Jiwa (ODGJ) bagi Perawat di Dinas Kesehatan Banyumas', 1, 1, '6000000', NULL, '[]', 'selesai', '2024-11-21 03:44:55', '2024-11-21 03:44:55'),
(5, 21, '2020', 'Pelatihan Psikoedukasi pada Orang sengan Gangguan Jiwa (ODGJ) bagi Perawat di Dinas Kesehatan Banyumas', 1, 1, '6000000', NULL, '[]', 'selesai', '2024-11-21 03:46:05', '2024-11-21 03:46:05'),
(6, 41, '2020', 'Penyuluhan ASI Eksklusif dan Praktik Perawatan Payudara pada KP ASI (Kelompok Pendukung ASI) di Desa Pacul Kecamatan Talang Kabupaten Tegal', 1, 1, '6000000', NULL, '[]', 'selesai', '2024-11-21 03:47:09', '2024-11-21 03:47:09'),
(7, 42, '2020', 'Penyuluhan Kesehatan Life Skill pada Masa Pandemi COvid-19 di Rumah Yatim Bina Anak Sholeh', 1, 1, '6000000', NULL, '[]', 'selesai', '2024-11-21 03:48:01', '2024-11-21 03:48:01'),
(8, 44, '2020', 'Edukasi Kesehatan mengenai Covid-19 pada Ibu Hamil di Desa Kalisapu Kecamatan Slawi Kabupaten Tegal', 1, 1, '6000000', NULL, '[]', 'selesai', '2024-11-21 03:48:48', '2024-11-21 03:48:48'),
(9, 37, '2020', 'Edukasi Kesehatan Reproduksi Remaja di SMA 1 dan 2 Kecamatan Slawi', 1, 1, '6000000', NULL, '[]', 'selesai', '2024-11-21 03:49:50', '2024-11-21 03:49:50'),
(10, 42, '2020', 'Pendidikan P3K Luka dan Perdarahan pada Patroli Keamanan Sekolah Satlantas', 1, 1, '6000000', NULL, '[]', 'selesai', '2024-11-21 03:50:31', '2024-11-21 03:50:31'),
(11, 44, '2020', 'Edukasi Vaksin Covid-19 bagi Masyarakat di Desa Kalisapu Kecamatan Slawi Kabupaten Tegal', 1, 1, '6000000', NULL, '[]', 'selesai', '2024-11-21 03:52:40', '2024-11-21 03:52:40'),
(12, 45, '2020', 'Pendidikan Kesehatan Tanda Bahaya Masa Nifas di Desa Kalisapu Kecamatan Slawi Kabupaten Tegal', 1, 1, '6000000', NULL, '[]', 'selesai', '2024-11-21 03:53:33', '2024-11-21 03:53:33'),
(13, 43, '2020', 'Konseling Praktik Perawatan Bayi Baru Lahir pada Masa Pandemi Covid-19 di Desa Kalisapu Kecamatan Slawi Kabupaten Tegal', 1, 1, '6000000', NULL, '[]', 'selesai', '2024-11-21 03:54:20', '2024-11-21 03:54:20'),
(14, 42, '2020', 'Edukasi Kesehatan Pencegahan Penyebaran Covid-19 pada Masyarakat Desa Kalisapu', 1, 1, '6000000', NULL, '[]', 'selesai', '2024-11-21 03:55:52', '2024-11-21 03:55:52'),
(15, 45, '2020', 'Simulasi Penanganan Kegawatdaruratan pada Anggota Patroli Keamanan Sekolah (PKS)', 1, 1, '6000000', NULL, '[]', 'selesai', '2024-11-21 03:58:27', '2024-11-21 03:58:27'),
(16, 10, '2020', 'Penyuluhan Kecelakaan Kerja pada Tenaga Kesehatan di Rumah Sakit Mitra Siaga Tegal', 1, 1, '6000000', NULL, '[]', 'selesai', '2024-11-21 04:02:39', '2024-11-21 04:02:39'),
(17, 5, '2020', 'Pendidikan P3K pada PKS Satlantas Polres Tegal', 1, 1, '6000000', NULL, '[]', 'selesai', '2024-11-21 04:03:32', '2024-11-21 04:03:32'),
(18, 66, '2021', 'PELATIHAN PEMBUATAN HAND SANITIZER UPAYA PENCEGAHAN COVID-19 PADA SISWA SMK MUHAMMADIYAH ADIWERNA', 1, 1, '7000000', 'pengabdian/24112112002792.pdf', '[]', 'selesai', '2024-11-21 05:00:27', '2024-11-21 05:00:27'),
(19, 8, '2021', 'EDUKASI TENTANG COVID DENGAN MEDIA BOOKLET PADA ANAK USIA DINI DI RA/KBIT SITI KHODIJAH SLAWI', 1, 1, '7000000', 'pengabdian/24112112180214.pdf', '[]', 'selesai', '2024-11-21 05:18:02', '2024-11-21 05:18:02'),
(20, 4, '2024', 'PELATIHAN AKUPRESURE MERIDIAN UNTUK MENINGKATKAN IMUNITAS DI MASA TRANSISI PANDEMI COVID 19', 1, 1, '7000000', 'pengabdian/24112112193238.pdf', '[]', 'selesai', '2024-11-21 05:19:32', '2024-11-21 05:19:32'),
(21, 53, '2021', 'KOSMETIK DARI TANAMAN HERBAL INDONESIA', 1, 1, '7000000', 'pengabdian/24112112215612.pdf', '[]', 'selesai', '2024-11-21 05:21:56', '2024-11-21 05:21:56'),
(22, 43, '2021', 'KOMUNIKASI INFORMASI EDUKASI (KIE) KESEHATAN REPRODUKSI REMAJA (KKR) PADA MASA PANDEMI DI SMP N 1 DUKUHWARU KECAMATAN DUKUHWARU KABUPATEN TEGAL', 1, 1, '7000000', 'pengabdian/24112112232363.pdf', '[]', 'selesai', '2024-11-21 05:23:23', '2024-11-21 05:23:23'),
(23, 36, '2021', 'PERSIAPAN PERSALINAN PADA MASA PANDEMI COVID 19 DI DESA DUKUWARU', 1, 1, '7000000', 'pengabdian/24112112244635.pdf', '[]', 'selesai', '2024-11-21 05:24:46', '2024-11-21 05:24:46'),
(24, 44, '2021', 'KOMUNIKASI INFORMASI EDUKASI (KIE) MENJAGA IMUNITAS IBU HAMIL DI ERA NEW NORMAL DESA DUKUHWARU', 1, 1, '7000000', 'pengabdian/24112112283563.pdf', '[]', 'selesai', '2024-11-21 05:28:35', '2024-11-21 05:28:35'),
(25, 25, '2021', 'PROGRAM IPTEKS BAGI MASYARAKAT (IbM) PELATIHAN PERTOLONGAN PERTAMA KEGAWATAN PADA ANAK BAGI ANGGOTA PKK DESA RANCAWIRU KECAMATAN PANGKAH KABUPATEN TEGAL', 1, 1, '7000000', 'pengabdian/24112112302832.pdf', '[]', 'selesai', '2024-11-21 05:29:30', '2024-11-21 05:30:28'),
(26, 45, '2021', 'PENDIDIKAN KESEHATAN TEKNIK MENYUSUI PADA IBU NIFAS', 1, 1, '7000000', 'pengabdian/24112112321182.pdf', '[]', 'selesai', '2024-11-21 05:32:11', '2024-11-21 05:32:11'),
(27, 51, '2021', 'KUASAI SIMPLE PRESENT TENSE DENGAN SINGLE-SLOT SUBSTITUTION DRILL', 6, 1, '7000000', 'pengabdian/24112112333854.pdf', '[]', 'selesai', '2024-11-21 05:33:38', '2024-11-21 05:33:38'),
(28, 41, '2021', 'EDUKASI KESEHATAN TENTANG KB SUNTIK PADA WANITA USIA SUBUR DI MASA PANDEMI', 6, 1, '7000000', 'pengabdian/24112102153988.pdf', '[]', 'selesai', '2024-11-21 07:15:39', '2024-11-21 07:15:39'),
(29, 43, '2021', 'KOMUNIKASI INFORMASI EDUKASI (KIE) KESEHATAN REPRODUKSI REMAJA (KRR) PADA MASA PANDEMI COVID 19 DI SMP N 1 DUKUHWARU KEC. DUKUHWARU KAB. TEGAL', 6, 1, '7000000', 'pengabdian/24112102174241.pdf', '[]', 'selesai', '2024-11-21 07:17:42', '2024-11-21 07:17:42'),
(30, 74, '2021', 'PENYULUHAN ETIKA DAN KEAMANAN INFORMASI PADA PENGGUNAAN APLIKASI SMARTPHONE BAGI PESERTA DIDIK LKP KOMPUTER LESTARI SLAWI', 6, 1, '7000000', 'pengabdian/24112102194662.pdf', '[]', 'selesai', '2024-11-21 07:19:46', '2024-11-21 07:19:46'),
(31, 29, '2021', 'PENCEGAHAN COVID-19 MELALUI EDUKASI CUCI TANGAN DENGAN SEBELAS LANGKAH DI SD NEGERI SLAWI KULON 05', 6, 1, '7000000', 'pengabdian/24112102211622.pdf', '[]', 'selesai', '2024-11-21 07:21:16', '2024-11-21 07:21:16'),
(32, 44, '2021', 'EDUKASI MENJAGA IMUNITAS IBU HAMIL DI ERA NEW NORMAL', 6, 1, '7000000', 'pengabdian/24112102222480.pdf', '[]', 'selesai', '2024-11-21 07:22:24', '2024-11-21 07:22:24'),
(33, 29, '2021', 'EDUKASI 3M PLUS DAN MEDIA OVITRAP UNTUK PENCEGAHAN DEMAM BERDARAH DENGUE DI DESA KEBANDINGAN KECAMATAN KEDUNGBANTENG KABUPATEN TEGAL', 6, 1, '7000000', 'pengabdian/24112102234775.pdf', '[]', 'selesai', '2024-11-21 07:23:47', '2024-11-21 07:23:47'),
(34, 9, '2021', 'STRATEGI METODE EMOTIONAL FREEDOM TECHNIQUE (EFT) UNTUK MENURUNKAN KECEMASAN PADA GURU DALAM MENGHADAPI PEMBELAJARAN DARING', 6, 1, '7000000', 'pengabdian/24112102313249.pdf', '[]', 'selesai', '2024-11-21 07:31:12', '2024-11-21 07:31:32'),
(35, 43, '2021', 'EDUKASI KESEHATAN REPRODUKSI REMAJA PADA MASA PANDEMI COVID-19 DENGAN METODE BOOKLET DI DESA KALISAPU KECAMATAN SLAWI KABUPATEN TEGAL', 6, 1, '7000000', 'pengabdian/24112102341692.pdf', '[]', 'selesai', '2024-11-21 07:34:16', '2024-11-21 07:34:16'),
(36, 18, '2021', 'PENYULUHAN DIET DASH HIPERTENSI PADA LANSIA SELAMA MASA PANDEMI COVID-19', 6, 1, '7000000', 'pengabdian/24112102351818.pdf', '[]', 'selesai', '2024-11-21 07:35:18', '2024-11-21 07:35:18'),
(37, 66, '2021', 'PELATIHAN PENGGUNAAN ALAT PEMADAM API RINGAN (APAR) PADA UPTD LABORATORIUM PERINDUSTRIAN KABUPATEN TEGAL', 6, 1, '7000000', 'pengabdian/24112102362853.pdf', '[]', 'selesai', '2024-11-21 07:36:28', '2024-11-21 07:36:28'),
(38, 9, '2021', 'INTERVENSI TAKS (TERAPI AKTIVITAS KELOMPOK SOSIALISASI) SEBAGAI UPAYA MENURUNKAN TINGKAT DEPRESI LANSIA', 6, 1, '7000000', 'pengabdian/24112102374659.pdf', '[]', 'selesai', '2024-11-21 07:37:46', '2024-11-21 07:37:46'),
(39, 53, '2021', 'PENYULUHAN HERBA PENINGKAT SISTEM IMUN PADA MASA PANDEMI COVID-19', 6, 1, '8000000', 'pengabdian/24112102452899.pdf', '[]', 'selesai', '2024-11-21 07:45:28', '2024-11-21 07:45:28'),
(40, 28, '2021', 'SKRINING KEGAWATDARURATAN KESEHATAN LANJUT USIA (LANSIA) DI DESA MEJASEM TIMUR RW 06 KECAMATAN KRAMAT KABUPATEN TEGAL', 6, 1, '8000000', 'pengabdian/24112102513932.pdf', '[]', 'selesai', '2024-11-21 07:51:39', '2024-11-21 07:51:39'),
(41, 11, '2021', 'EDUKASI KESEHATAN REPRODUKSI REMAJA DI PANTI ASUHAN DARUL FARROH', 6, 1, '8000000', 'pengabdian/24112102524646.pdf', '[]', 'selesai', '2024-11-21 07:52:46', '2024-11-21 07:52:46'),
(42, 74, '2022', 'Kegiatan Pelatihan Konfigurasi Internet Pada Operator SMA Negeri 3 Tegal', 1, 1, '9000000', NULL, '[]', 'selesai', '2024-11-21 07:54:08', '2024-11-21 07:54:08'),
(43, 73, '2022', 'Optimalisasi Penggunaan Powerpoint sebagai media pembelajaran pada SMK ANNUR Kabupaten Tegal', 1, 1, '8000000', NULL, '[]', 'selesai', '2024-11-21 07:56:13', '2024-11-21 07:56:13'),
(44, 10, '2022', 'Peningkatan Pengetahuan Lansia Mengenai Penyakit Tidak Menular Di prolanis Puskesmas Adiwerna', 1, 1, '8000000', NULL, '[]', 'selesai', '2024-11-21 07:57:23', '2024-11-21 07:57:23'),
(45, 12, '2022', 'Pendidikan Kesehatan \"GEMA CERMAT\" Sediaan Moderen & Tradisional di lebaksiu Kabupaten Tegal', 1, 1, '8000000', NULL, '[]', 'selesai', '2024-11-21 07:58:48', '2024-11-21 07:58:48'),
(46, 68, '2022', 'Pelatihan penerapan komunikasi pada proyek pembangunan gedung RSUD dr. Soeselo Kabupaten Tegal', 1, 1, '8000000', NULL, '[]', 'selesai', '2024-11-21 08:00:01', '2024-11-21 08:00:01'),
(47, 39, '2022', 'Komunikasi Informasi Edukasi (KIE) dalam upaya pencegahan dan penanggulangan anemia', 1, 1, '8000000', NULL, '[]', 'selesai', '2024-11-21 08:01:22', '2024-11-21 08:01:22'),
(48, 41, '2022', 'Komunikasi Informasi Edukasi (KIE) Tentang Senam Hamil Dalam Upaya Pencegahan Rupture Perineum pada Ibu Hamil di Desa Bengle Wilayah Kerja Puskesmas Talang Kabupaten Tegal', 1, 1, '8000000', NULL, '[]', 'selesai', '2024-11-21 08:02:02', '2024-11-21 08:02:02'),
(49, 45, '2022', 'Edukasi Perawatan Payudara pada Ibu masa nifas dan menyusui', 1, 1, '8000000', NULL, '[]', 'selesai', '2024-11-21 08:02:54', '2024-11-21 08:02:54'),
(50, 43, '2022', 'Edukasi Stimulasi Perkembangan Balita Dengan KPSP (Kuisioner Pra Skrining Perkembangan) di Desa Randusari Kecamatan Pagerbarang Kabupaten Tegal', 1, 1, '8000000', NULL, '[]', 'selesai', '2024-11-21 08:03:49', '2024-11-21 08:03:49'),
(51, 25, '2022', 'Pelatihan Pertolongan Pertama Pada Kecelakan Bagi Siswa SMA Negeri 1 Pangkah Kabupaten Tegal', 1, 1, '8000000', NULL, '[]', 'selesai', '2024-11-21 09:05:32', '2024-11-21 09:05:32'),
(52, 56, '2022', 'Penyuluhan Pengenalan Obat Sirup Yang Aman Terhadap Tingkat Pengetahuan Ibu-ibu PKK dan Kader Desa Kalisoka Kabupaten Tegal', 1, 1, '8000000', NULL, '[]', 'selesai', '2024-11-21 09:06:42', '2024-11-21 09:06:42'),
(53, 82, '2022', 'Pengembangan Model Literasi Klinik Saintifikasi Jamu Melalui Platform Digital \"Hello Djamoo\" Pada UPTD Wisata Kesehatan Jamu (WKJ) Kalibakung Kabupaten Tegal', 1, 1, '4500000', NULL, '[]', 'selesai', '2024-11-21 09:07:36', '2024-11-21 09:07:36'),
(54, 78, '2022', 'Pelatihan Handycraft Buket Bunga Untuk Unit Kegiatan Mahasiswa (UKM) Universitas Bhamada Slawi', 1, 1, '4500000', 'pengabdian/24112104085618.pdf', '[]', 'selesai', '2024-11-21 09:08:56', '2024-11-21 09:08:56'),
(55, 11, '2023', 'EDUKASI STUNTING DENGAN MEDIA AUDIOVISUAL PADA IBU DENGAN ANAK STUNTING DI POSYANDU MAWAR 2 DESA PENUSUPAN KECAMATAN PANGKAH KABUPATEN TEGAL', 1, 1, '4500000', 'pengabdian/24112104150134.pdf', '[]', 'selesai', '2024-11-21 09:15:01', '2024-11-21 09:15:01'),
(56, 72, '2024', 'Upaya Meningkatkan Minat Di Bidang Robotika Pada Siswa Sekolah Dasar Di SD Madinah Slawi Kabupaten Tegal', 1, 1, '8000000', NULL, '[]', 'selesai', '2024-11-21 09:16:13', '2024-11-21 09:16:13'),
(57, 73, '2023', 'PELATIHAN DASAR DIGITAL MARKETING PADA UMKM DESA KAMBANGAN KABUPATEN TEGAL', 1, 1, '8000000', NULL, '[]', 'selesai', '2024-11-21 09:16:59', '2024-11-21 09:16:59');

-- --------------------------------------------------------

--
-- Table structure for table `pengabdian_personels`
--

CREATE TABLE `pengabdian_personels` (
  `id` bigint UNSIGNED NOT NULL,
  `pengabdian_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengabdian_personels`
--

INSERT INTO `pengabdian_personels` (`id`, `pengabdian_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 18, 68, '2024-11-21 05:00:27', '2024-11-21 05:00:27'),
(2, 18, 71, '2024-11-21 05:00:27', '2024-11-21 05:00:27'),
(3, 18, 69, '2024-11-21 05:00:27', '2024-11-21 05:00:27'),
(4, 18, 67, '2024-11-21 05:00:27', '2024-11-21 05:00:27'),
(5, 19, 11, '2024-11-21 05:18:02', '2024-11-21 05:18:02'),
(6, 19, 14, '2024-11-21 05:18:02', '2024-11-21 05:18:02'),
(7, 19, 7, '2024-11-21 05:18:02', '2024-11-21 05:18:02'),
(8, 20, 6, '2024-11-21 05:19:32', '2024-11-21 05:19:32'),
(9, 20, 3, '2024-11-21 05:19:32', '2024-11-21 05:19:32'),
(10, 21, 49, '2024-11-21 05:21:56', '2024-11-21 05:21:56'),
(11, 21, 47, '2024-11-21 05:21:56', '2024-11-21 05:21:56'),
(12, 21, 46, '2024-11-21 05:21:56', '2024-11-21 05:21:56'),
(13, 21, 48, '2024-11-21 05:21:56', '2024-11-21 05:21:56'),
(14, 22, 45, '2024-11-21 05:23:23', '2024-11-21 05:23:23'),
(15, 22, 42, '2024-11-21 05:23:23', '2024-11-21 05:23:23'),
(16, 22, 38, '2024-11-21 05:23:23', '2024-11-21 05:23:23'),
(17, 23, 41, '2024-11-21 05:24:46', '2024-11-21 05:24:46'),
(18, 23, 40, '2024-11-21 05:24:46', '2024-11-21 05:24:46'),
(19, 24, 37, '2024-11-21 05:28:35', '2024-11-21 05:28:35'),
(20, 24, 39, '2024-11-21 05:28:35', '2024-11-21 05:28:35'),
(21, 25, 29, '2024-11-21 05:29:30', '2024-11-21 05:29:30'),
(22, 25, 20, '2024-11-21 05:29:30', '2024-11-21 05:29:30'),
(23, 26, 43, '2024-11-21 05:32:11', '2024-11-21 05:32:11'),
(24, 26, 42, '2024-11-21 05:32:11', '2024-11-21 05:32:11'),
(25, 26, 38, '2024-11-21 05:32:11', '2024-11-21 05:32:11'),
(26, 27, 68, '2024-11-21 05:33:38', '2024-11-21 05:33:38'),
(27, 27, 69, '2024-11-21 05:33:38', '2024-11-21 05:33:38'),
(28, 28, 36, '2024-11-21 07:15:39', '2024-11-21 07:15:39'),
(29, 29, 42, '2024-11-21 07:17:42', '2024-11-21 07:17:42'),
(30, 29, 38, '2024-11-21 07:17:42', '2024-11-21 07:17:42'),
(31, 30, 73, '2024-11-21 07:19:46', '2024-11-21 07:19:46'),
(32, 30, 72, '2024-11-21 07:19:46', '2024-11-21 07:19:46'),
(33, 31, 18, '2024-11-21 07:21:16', '2024-11-21 07:21:16'),
(34, 31, 22, '2024-11-21 07:21:16', '2024-11-21 07:21:16'),
(35, 31, 28, '2024-11-21 07:21:16', '2024-11-21 07:21:16'),
(36, 32, 37, '2024-11-21 07:22:24', '2024-11-21 07:22:24'),
(37, 32, 39, '2024-11-21 07:22:24', '2024-11-21 07:22:24'),
(38, 34, 11, '2024-11-21 07:31:12', '2024-11-21 07:31:12'),
(39, 34, 8, '2024-11-21 07:31:12', '2024-11-21 07:31:12'),
(40, 35, 42, '2024-11-21 07:34:16', '2024-11-21 07:34:16'),
(41, 35, 38, '2024-11-21 07:34:16', '2024-11-21 07:34:16'),
(42, 37, 69, '2024-11-21 07:36:28', '2024-11-21 07:36:28'),
(43, 37, 70, '2024-11-21 07:36:28', '2024-11-21 07:36:28'),
(44, 39, 50, '2024-11-21 07:45:28', '2024-11-21 07:45:28'),
(45, 39, 46, '2024-11-21 07:45:28', '2024-11-21 07:45:28'),
(46, 40, 20, '2024-11-21 07:51:39', '2024-11-21 07:51:39'),
(47, 40, 23, '2024-11-21 07:51:39', '2024-11-21 07:51:39'),
(48, 40, 22, '2024-11-21 07:51:39', '2024-11-21 07:51:39'),
(49, 43, 72, '2024-11-21 07:56:13', '2024-11-21 07:56:13'),
(50, 44, 3, '2024-11-21 07:57:23', '2024-11-21 07:57:23'),
(51, 44, 8, '2024-11-21 07:57:23', '2024-11-21 07:57:23'),
(52, 45, 4, '2024-11-21 07:58:48', '2024-11-21 07:58:48'),
(53, 45, 14, '2024-11-21 07:58:48', '2024-11-21 07:58:48'),
(54, 46, 69, '2024-11-21 08:00:01', '2024-11-21 08:00:01'),
(55, 46, 66, '2024-11-21 08:00:01', '2024-11-21 08:00:01'),
(56, 47, 37, '2024-11-21 08:01:22', '2024-11-21 08:01:22'),
(57, 47, 44, '2024-11-21 08:01:22', '2024-11-21 08:01:22'),
(58, 48, 36, '2024-11-21 08:02:02', '2024-11-21 08:02:02'),
(59, 49, 40, '2024-11-21 08:02:54', '2024-11-21 08:02:54'),
(60, 50, 42, '2024-11-21 08:03:49', '2024-11-21 08:03:49'),
(61, 50, 38, '2024-11-21 08:03:49', '2024-11-21 08:03:49'),
(62, 51, 29, '2024-11-21 09:05:32', '2024-11-21 09:05:32'),
(63, 51, 28, '2024-11-21 09:05:32', '2024-11-21 09:05:32'),
(64, 52, 47, '2024-11-21 09:06:42', '2024-11-21 09:06:42'),
(65, 52, 46, '2024-11-21 09:06:42', '2024-11-21 09:06:42'),
(66, 53, 84, '2024-11-21 09:07:36', '2024-11-21 09:07:36'),
(67, 53, 83, '2024-11-21 09:07:36', '2024-11-21 09:07:36'),
(68, 54, 77, '2024-11-21 09:08:56', '2024-11-21 09:08:56'),
(69, 54, 79, '2024-11-21 09:08:56', '2024-11-21 09:08:56'),
(70, 54, 80, '2024-11-21 09:08:56', '2024-11-21 09:08:56'),
(71, 55, 6, '2024-11-21 09:15:01', '2024-11-21 09:15:01'),
(72, 55, 9, '2024-11-21 09:15:01', '2024-11-21 09:15:01');

-- --------------------------------------------------------

--
-- Table structure for table `pengabdian_revisis`
--

CREATE TABLE `pengabdian_revisis` (
  `id` bigint UNSIGNED NOT NULL,
  `pengabdian_id` bigint UNSIGNED NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prodis`
--

CREATE TABLE `prodis` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fakultas_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prodis`
--

INSERT INTO `prodis` (`id`, `nama`, `fakultas_id`, `created_at`, `updated_at`) VALUES
(1, 'Profesi Ners', 1, NULL, NULL),
(2, 'S1 Ilmu Keperawatan', 1, NULL, NULL),
(3, 'S1 Farmasi', 1, NULL, NULL),
(4, 'D4 Keselamatan dan Kesehatan Kerja', 1, NULL, NULL),
(5, 'D3 Kebidanan', 1, NULL, NULL),
(6, 'D3 Keperawatan', 1, NULL, NULL),
(7, 'S1 Bisnis Digital', 2, NULL, NULL),
(8, 'S1 Kewirausahaan', 2, NULL, NULL),
(9, 'S1 Informatika', 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `proposals`
--

CREATE TABLE `proposals` (
  `id` bigint UNSIGNED NOT NULL,
  `jenis` enum('penelitian','pengabdian') COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `tahun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_penelitian_id` bigint UNSIGNED DEFAULT NULL,
  `jenis_pengabdian_id` bigint UNSIGNED DEFAULT NULL,
  `jenis_pendanaan_id` bigint UNSIGNED NOT NULL,
  `dana_usulan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dana_setuju` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mahasiswas` json DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jam` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `peninjau_id` bigint UNSIGNED DEFAULT NULL,
  `jadwal_id` bigint UNSIGNED DEFAULT NULL,
  `mou` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('menunggu','proses','revisi1','setuju1','revisi2','pendanaan','mou','setuju2','selesai') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `proposal_jadwals`
--

CREATE TABLE `proposal_jadwals` (
  `id` bigint UNSIGNED NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `nomor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `perihal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kepadas` json NOT NULL,
  `proposal_ids` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `proposal_mous`
--

CREATE TABLE `proposal_mous` (
  `id` bigint UNSIGNED NOT NULL,
  `proposal_id` bigint UNSIGNED NOT NULL,
  `nomor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `draft` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revisi` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `proposal_personels`
--

CREATE TABLE `proposal_personels` (
  `id` bigint UNSIGNED NOT NULL,
  `proposal_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `proposal_revisis`
--

CREATE TABLE `proposal_revisis` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `proposal_id` bigint UNSIGNED NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('revisi1','revisi2','revisi3') COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nidn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nipy` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `prodi_id` bigint UNSIGNED DEFAULT NULL,
  `telp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_sinta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_scopus` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `golongan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `is_ketua` tinyint(1) NOT NULL DEFAULT '0',
  `is_peninjau` tinyint(1) NOT NULL DEFAULT '0',
  `ttd` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('dev','operator','dosen') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`, `nidn`, `nipy`, `gender`, `prodi_id`, `telp`, `id_sinta`, `id_scopus`, `golongan`, `jabatan`, `alamat`, `is_ketua`, `is_peninjau`, `ttd`, `role`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Developer', 'dev', '$2y$12$ykb39Z5ZiPN76vHQysVTUuQftTZSg4lyg0N34ZZZCpICYJr/ebXeu', NULL, NULL, 'L', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dev', NULL, NULL, NULL),
(2, 'Reno Arkan Pratama, S.M', 'operator', '$2y$12$UekR8rWcGVuUJoq6yudR6ew4pM5B7Puq8lElKgp/ekiEk/Yv.5IkS', NULL, NULL, 'L', NULL, '085900451913', NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'operator', NULL, NULL, NULL),
(3, 'Dr. Risnanto, M. Kes', '0630067203', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0630067203', NULL, 'L', 6, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, 'dosen', NULL, NULL, NULL),
(4, 'Arriani Indrastuti, SKM.,M.Kes', '0605037601', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0605037601', NULL, 'P', 6, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(5, 'Woro Hapsari, S.Kep.Ns.,M.Kep', '0613028001', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0613028001', NULL, 'P', 6, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(6, 'Arifin Dwi Atmaja, S.Kep.Ns.,M.Kep', '0611077502', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0611077502', NULL, 'L', 6, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(7, 'Uswatun Insani, S.Kep.Ns.,M.Kep.', '0623078103', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0623078103', NULL, 'P', 6, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(8, 'Ita Nur Itsna, S.Kep.Ns.,M.A.N', '0613048604', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0613048604', NULL, 'P', 6, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(9, 'Sri Hidayati, S.Kep.Ns.,M.Kep.Sp.KMB', '0504117901', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0504117901', NULL, 'P', 6, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(10, 'Ramadhan Putra Satria, S.Kep.Ns.,M.Kep', '0626048902', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0626048902', NULL, 'L', 6, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(11, 'Anisa Oktiawati, S.Kep.Ns.,M.Kep', '0615108602', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0615108602', NULL, 'P', 6, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(12, 'Ani Ratnaningsih, S.Kep.Ns., M. Kep', '0615098703', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0615098703', NULL, 'P', 6, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(13, 'Dr. Faisaluddin, M.Psi., Psikolog', '0613018504', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0613018504', NULL, 'L', 6, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(14, 'Jumrotun Ni\'mah,S.Kep.Ns.,M.Kep', '0606029401', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0606029401', NULL, 'P', 6, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(15, 'Ns. Theodora Rosaria Geglorian, S.Kep., Ns., M.Kep', '0607118002', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0607118002', NULL, 'P', 6, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(16, 'Dr. Imam Safii, ', '8911680023', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '8911680023', NULL, 'L', 6, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(17, 'Umi Salamah, S.Pd.,MH', '0622126901', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0622126901', NULL, 'P', 2, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(18, 'Dr. Wisnu Widyantoro, S.Kp.,M.Kep', '0624027202', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0624027202', NULL, 'L', 2, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, 'dosen', NULL, NULL, NULL),
(19, 'Firman Hidayat,S.Kep.Ns., M.Kep. Sp.Kep.J', '0625037401', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0625037401', NULL, 'L', 2, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(20, 'Dwi Budi Prastiani,S.Kep.Ns., M.Kep.,Sp.Kep.Kom', '6190574101', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '6190574101', NULL, 'P', 2, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(21, 'Agus Budianto, S.Kep.Ns.,M.Kep', '0611077102', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0611077102', NULL, 'L', 2, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, 'dosen', NULL, NULL, NULL),
(22, 'Khodijah, S.Kep.Ns.,M.Kep', '0621038003', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0621038003', NULL, 'P', 2, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, 'dosen', NULL, NULL, NULL),
(23, 'Ikawati Setyaningrum, S.Kep.Ns., M.Kep', '0606118602', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0606118602', NULL, 'P', 2, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(24, 'Susi Muryani, S.Kep.Ns.,M.N.S', '0615058406', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0615058406', NULL, 'P', 2, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(25, 'Deni Irawan, S.Kep.Ns.,M.Kep', '0603038504', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0603038504', NULL, 'L', 2, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(26, 'Nurhakim Yudhi Wibowo, S.Kep.Ns.,M.Kep', '0619108504', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0619108504', NULL, 'L', 2, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(27, 'Ratna Widhiastuti,S.Kep.Ns.,M.Kep.', '0516028802', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0516028802', NULL, 'P', 2, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(28, 'Yessy Pramita Widodo, S.Kep.Ns.,M.Kep.', '0604088903', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0604088903', NULL, 'P', 2, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(29, 'Arif Rakhman, S.Kep.Ns.,M.A.N', '0611128801', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0611128801', NULL, 'L', 2, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, 'dosen', NULL, NULL, NULL),
(30, 'Eka Diana Permatasari, S.Kep., Ns., M.Kep.', '0607109601', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0607109601', NULL, 'P', 2, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(31, 'Novi Aprilia Kumala Dewi, S. Kep., Ns.,M. Kep', '0630049001', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0630049001', NULL, 'P', 2, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(32, 'Agung Laksana Hendra Pamungkas, M. Kep', '0603038903', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0603038903', NULL, 'L', 2, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(33, 'Syarifuddin Bakhtiar, M. Kep', '0608019103', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0608019103', NULL, 'L', 2, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(34, 'Dr. Angkatno', '8921680023', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '8921680023', NULL, 'L', 2, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(35, 'Dr. Sutikno', '8901680023', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '8901680023', NULL, 'L', 2, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(36, 'Tri Agustina Hadiningsih, SST.,M.Kes', '0625087901', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0625087901', NULL, 'P', 5, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(37, 'Natiqotul Fatkhiyah,S.SiT, Bdn., M.Kes ', '0614128001', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0614128001', NULL, 'P', 5, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, 'dosen', NULL, NULL, NULL),
(38, 'Siswati, S.SiT, Bdn .,M.Kes', '021078101', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '021078101', NULL, 'P', 5, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(39, 'Yuni Fitriani, S.Si.T,.MPH', '0624068502', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0624068502', NULL, 'P', 5, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(40, 'Rina Febri Wahyuningsih, S.SiT', '0601028602', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0601028602', NULL, 'P', 5, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(41, 'Ika Esti Anggraeni, SST, Bdn., M.Kes', '0616098704', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0616098704', NULL, 'P', 5, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(42, 'Masturoh, SST.,MPH', '0614048702', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0614048702', NULL, 'P', 5, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(43, 'Ike Putri Setyatama, SST.,M.Kes', '0618028601', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0618028601', NULL, 'P', 5, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(44, 'Sri Tanjung Rejeki , SST.,MPH', '0601068802', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0601068802', NULL, 'P', 5, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(45, 'Adrestia Rifki Naharani, S.SiT.,MPH', '0607068701', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0607068701', NULL, 'P', 5, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(46, 'Oktariani Pramiastuti, M.Sc.Apt', '0620107801', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0620107801', NULL, 'P', 3, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(47, 'Endang Istriningsih, M.Clin.Pharm.Apt', '0615028301', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0615028301', NULL, 'P', 3, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(48, 'Osie Listina, M.Sc.,Apt', '0627048403', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0627048403', NULL, 'P', 3, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(49, 'apt. Agung Nur Cahyanta, M.Farm, C. Herb', '060607902', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '060607902', NULL, 'L', 3, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(50, 'Ery Nourika Alfiraza, S.Si, M.Sc', '0608029202', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0608029202', NULL, 'P', 3, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(51, 'Fiqih Kartika Murti, M.Pd', '0628049002', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0628049002', NULL, 'P', 3, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(52, 'Desi Sri Rejeki, M.Si', '0602128603', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0602128603', NULL, 'P', 3, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(53, 'apt. Lailiana Garna Nurhidayati, M.Pharm.Sci.', '0617039302', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0617039302', NULL, 'P', 3, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(54, 'apt. Arifina Fahamsya, S.Farm.,M.Sc', '0613099102', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0613099102', NULL, 'P', 3, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(55, 'Afina, S. Farm., M. Farm', '0627099701', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0627099701', NULL, 'P', 3, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(56, 'Prihastini Setyo Wulandari, S. Farm., M. Farm', '0603109703', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0603109703', NULL, 'P', 3, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(57, 'Girly Risma Firsty, S. Farm., M. Farm', 'On proses', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', 'On proses', NULL, 'P', 3, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(58, 'apt. Fika Rizqiyana, M. Farm', '0603029401', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0603029401', NULL, 'P', 3, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(59, 'Yani Kusumaningdjati, M. Farm., Apt', '0601017004', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0601017004', NULL, 'P', 3, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(60, 'Mohamad Ihsanuddin,  M.Sc., Apt', '8932780023', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '8932780023', NULL, 'L', 3, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(61, 'Khusny Kamal,  M. Farm., Apt', '8908680023', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '8908680023', NULL, 'P', 3, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(62, 'Agnes Dwi Suryani,  M.Sc., Apt', '8987680023', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '8987680023', NULL, 'P', 3, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(63, 'Irrenne Wulan Syafitri,  M. Clin. Pharm., Apt', '8957880024', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '8957880024', NULL, 'P', 3, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(64, 'Shofa Khorun Nida, M. Farm., apt', '0621049504', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0621049504', NULL, 'P', 3, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(65, 'Dr. Musrifah', '2106107501', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '2106107501', NULL, 'P', 3, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(66, 'Rosmalia, ST.,M.Kes.', '0607117602', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0607117602', NULL, 'P', 4, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(67, 'Erna Agustin Sukmandari, S.KM.,MPH', '0913088603', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0913088603', NULL, 'P', 4, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(68, 'Agung Tyas Subekti, S.Kep.,MA', '0630128801', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0630128801', NULL, 'L', 4, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(69, 'Dwi Atmoko, M.Pd', '0631018704', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0631018704', NULL, 'L', 4, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(70, 'Triyono Rakhmadi, S.KM.,M.KKK', '0608057201', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0608057201', NULL, 'L', 4, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(71, 'Anggit Pratiwi, S.Si.MPH', '0611028902', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0611028902', NULL, 'P', 4, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(72, 'Sri Hartati, M.Kom', '0613057403', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0613057403', NULL, 'P', 9, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(73, 'Sonhaji, M. Kom', '0612186701', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0612186701', NULL, 'L', 9, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(74, 'Haries Anom Susetyo Aji Nugroho, M.Kom', '0604079102', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0604079102', NULL, 'L', 9, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(75, 'Rito Cipta Sigitta Hariyono, M. Kom', '0619128301', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0619128301', NULL, 'L', 9, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(76, 'Arif  Nursetyo, M. Kom', '0618129202', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0618129202', NULL, 'L', 9, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(77, 'M. Wahab Khasbulloh, SEI.,MM', '0629089203', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0629089203', NULL, 'L', 8, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(78, 'Muammar Afif Al Qusaeri, SE.,MM', '0625068601', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0625068601', NULL, 'L', 8, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(79, 'Muthi\'atul Khasanah, SE.,MM', '0622039401', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0622039401', NULL, 'P', 8, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(80, 'Wiliyanto, MM', '0615098704', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0615098704', NULL, 'L', 8, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(81, 'Fatkhurozaq, MM', '0618048002', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0618048002', NULL, 'L', 8, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(82, 'Toto Sudibyo, SE,.MM', '0624068101', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0624068101', NULL, 'L', 7, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(83, 'Nur Khayati, SE.,MM', '0628128503', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0628128503', NULL, 'P', 7, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(84, 'Moh. Miftah, SE.,MM', '0603118802', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0603118802', NULL, 'L', 7, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(85, 'Kusmyatun, MM', '0615088202', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0615088202', NULL, 'P', 7, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(86, 'Andika Chandra Prasetyo, MTI', '0621018807', '$2y$12$X.KWOCEMt.ITa8iwdvyeZuouNuTNzj6UWhdH7bx6F.a9hXBjkzu4S', '0621018807', NULL, 'L', 7, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', NULL, NULL, NULL),
(87, 'Evi Supriyattun, M.Kep', '0617028904', '$2y$12$ScbCTNuX/KSKDpTTGMR9ROZJ6yKZUBmYp/2pvVxuhgUUUyfCLRdtq', '0617028904', NULL, 'P', 6, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'dosen', '2024-11-25 05:57:18', '2024-11-25 05:57:18', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bukus`
--
ALTER TABLE `bukus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bukus_user_id_foreign` (`user_id`);

--
-- Indexes for table `buku_personels`
--
ALTER TABLE `buku_personels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buku_personels_buku_id_foreign` (`buku_id`),
  ADD KEY `buku_personels_user_id_foreign` (`user_id`);

--
-- Indexes for table `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fakultas_kode_unique` (`kode`);

--
-- Indexes for table `hkis`
--
ALTER TABLE `hkis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hkis_user_id_foreign` (`user_id`),
  ADD KEY `hkis_jenis_hki_id_foreign` (`jenis_hki_id`);

--
-- Indexes for table `hki_personels`
--
ALTER TABLE `hki_personels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hki_personels_hki_id_foreign` (`hki_id`),
  ADD KEY `hki_personels_user_id_foreign` (`user_id`);

--
-- Indexes for table `jenis_hkis`
--
ALTER TABLE `jenis_hkis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_jurnals`
--
ALTER TABLE `jenis_jurnals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_luarans`
--
ALTER TABLE `jenis_luarans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_pendanaans`
--
ALTER TABLE `jenis_pendanaans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_penelitians`
--
ALTER TABLE `jenis_penelitians`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_pengabdians`
--
ALTER TABLE `jenis_pengabdians`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jurnals`
--
ALTER TABLE `jurnals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jurnals_user_id_foreign` (`user_id`),
  ADD KEY `jurnals_jenis_jurnal_id_foreign` (`jenis_jurnal_id`);

--
-- Indexes for table `jurnal_personels`
--
ALTER TABLE `jurnal_personels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jurnal_personels_jurnal_id_foreign` (`jurnal_id`),
  ADD KEY `jurnal_personels_user_id_foreign` (`user_id`);

--
-- Indexes for table `luarans`
--
ALTER TABLE `luarans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `luarans_user_id_foreign` (`user_id`),
  ADD KEY `luarans_jenis_luaran_id_foreign` (`jenis_luaran_id`);

--
-- Indexes for table `luaran_personels`
--
ALTER TABLE `luaran_personels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `luaran_personels_luaran_id_foreign` (`luaran_id`),
  ADD KEY `luaran_personels_user_id_foreign` (`user_id`);

--
-- Indexes for table `makalahs`
--
ALTER TABLE `makalahs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `makalahs_user_id_foreign` (`user_id`);

--
-- Indexes for table `makalah_personels`
--
ALTER TABLE `makalah_personels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `makalah_personels_makalah_id_foreign` (`makalah_id`),
  ADD KEY `makalah_personels_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penelitians`
--
ALTER TABLE `penelitians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penelitians_user_id_foreign` (`user_id`),
  ADD KEY `penelitians_jenis_pendanaan_id_foreign` (`jenis_pendanaan_id`),
  ADD KEY `penelitians_jenis_penelitian_id_foreign` (`jenis_penelitian_id`);

--
-- Indexes for table `penelitian_personels`
--
ALTER TABLE `penelitian_personels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penelitian_personels_penelitian_id_foreign` (`penelitian_id`),
  ADD KEY `penelitian_personels_user_id_foreign` (`user_id`);

--
-- Indexes for table `penelitian_revisis`
--
ALTER TABLE `penelitian_revisis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penelitian_revisis_penelitian_id_foreign` (`penelitian_id`);

--
-- Indexes for table `pengabdians`
--
ALTER TABLE `pengabdians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengabdians_user_id_foreign` (`user_id`),
  ADD KEY `pengabdians_jenis_pendanaan_id_foreign` (`jenis_pendanaan_id`),
  ADD KEY `pengabdians_jenis_pengabdian_id_foreign` (`jenis_pengabdian_id`);

--
-- Indexes for table `pengabdian_personels`
--
ALTER TABLE `pengabdian_personels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengabdian_personels_pengabdian_id_foreign` (`pengabdian_id`),
  ADD KEY `pengabdian_personels_user_id_foreign` (`user_id`);

--
-- Indexes for table `pengabdian_revisis`
--
ALTER TABLE `pengabdian_revisis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengabdian_revisis_pengabdian_id_foreign` (`pengabdian_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `prodis`
--
ALTER TABLE `prodis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prodis_fakultas_id_foreign` (`fakultas_id`);

--
-- Indexes for table `proposals`
--
ALTER TABLE `proposals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proposals_user_id_foreign` (`user_id`),
  ADD KEY `proposals_jenis_penelitian_id_foreign` (`jenis_penelitian_id`),
  ADD KEY `proposals_jenis_pengabdian_id_foreign` (`jenis_pengabdian_id`),
  ADD KEY `proposals_jenis_pendanaan_id_foreign` (`jenis_pendanaan_id`),
  ADD KEY `proposals_peninjau_id_foreign` (`peninjau_id`);

--
-- Indexes for table `proposal_jadwals`
--
ALTER TABLE `proposal_jadwals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `proposal_jadwals_kode_unique` (`kode`),
  ADD UNIQUE KEY `proposal_jadwals_nomor_unique` (`nomor`);

--
-- Indexes for table `proposal_mous`
--
ALTER TABLE `proposal_mous`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proposal_mous_proposal_id_foreign` (`proposal_id`);

--
-- Indexes for table `proposal_personels`
--
ALTER TABLE `proposal_personels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proposal_personels_proposal_id_foreign` (`proposal_id`),
  ADD KEY `proposal_personels_user_id_foreign` (`user_id`);

--
-- Indexes for table `proposal_revisis`
--
ALTER TABLE `proposal_revisis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proposal_revisis_user_id_foreign` (`user_id`),
  ADD KEY `proposal_revisis_proposal_id_foreign` (`proposal_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_nidn_unique` (`nidn`),
  ADD UNIQUE KEY `users_nipy_unique` (`nipy`),
  ADD UNIQUE KEY `users_telp_unique` (`telp`),
  ADD UNIQUE KEY `users_id_sinta_unique` (`id_sinta`),
  ADD UNIQUE KEY `users_id_scopus_unique` (`id_scopus`),
  ADD KEY `users_prodi_id_foreign` (`prodi_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bukus`
--
ALTER TABLE `bukus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `buku_personels`
--
ALTER TABLE `buku_personels`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `fakultas`
--
ALTER TABLE `fakultas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hkis`
--
ALTER TABLE `hkis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `hki_personels`
--
ALTER TABLE `hki_personels`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `jenis_hkis`
--
ALTER TABLE `jenis_hkis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `jenis_jurnals`
--
ALTER TABLE `jenis_jurnals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jenis_luarans`
--
ALTER TABLE `jenis_luarans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jenis_pendanaans`
--
ALTER TABLE `jenis_pendanaans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jenis_penelitians`
--
ALTER TABLE `jenis_penelitians`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jenis_pengabdians`
--
ALTER TABLE `jenis_pengabdians`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jurnals`
--
ALTER TABLE `jurnals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `jurnal_personels`
--
ALTER TABLE `jurnal_personels`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `luarans`
--
ALTER TABLE `luarans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `luaran_personels`
--
ALTER TABLE `luaran_personels`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `makalahs`
--
ALTER TABLE `makalahs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `makalah_personels`
--
ALTER TABLE `makalah_personels`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `penelitians`
--
ALTER TABLE `penelitians`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `penelitian_personels`
--
ALTER TABLE `penelitian_personels`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `penelitian_revisis`
--
ALTER TABLE `penelitian_revisis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengabdians`
--
ALTER TABLE `pengabdians`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `pengabdian_personels`
--
ALTER TABLE `pengabdian_personels`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `pengabdian_revisis`
--
ALTER TABLE `pengabdian_revisis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prodis`
--
ALTER TABLE `prodis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `proposals`
--
ALTER TABLE `proposals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `proposal_jadwals`
--
ALTER TABLE `proposal_jadwals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `proposal_mous`
--
ALTER TABLE `proposal_mous`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `proposal_personels`
--
ALTER TABLE `proposal_personels`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `proposal_revisis`
--
ALTER TABLE `proposal_revisis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bukus`
--
ALTER TABLE `bukus`
  ADD CONSTRAINT `bukus_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT;

--
-- Constraints for table `buku_personels`
--
ALTER TABLE `buku_personels`
  ADD CONSTRAINT `buku_personels_buku_id_foreign` FOREIGN KEY (`buku_id`) REFERENCES `bukus` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `buku_personels_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT;

--
-- Constraints for table `hkis`
--
ALTER TABLE `hkis`
  ADD CONSTRAINT `hkis_jenis_hki_id_foreign` FOREIGN KEY (`jenis_hki_id`) REFERENCES `jenis_hkis` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `hkis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT;

--
-- Constraints for table `hki_personels`
--
ALTER TABLE `hki_personels`
  ADD CONSTRAINT `hki_personels_hki_id_foreign` FOREIGN KEY (`hki_id`) REFERENCES `hkis` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `hki_personels_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT;

--
-- Constraints for table `jurnals`
--
ALTER TABLE `jurnals`
  ADD CONSTRAINT `jurnals_jenis_jurnal_id_foreign` FOREIGN KEY (`jenis_jurnal_id`) REFERENCES `jenis_jurnals` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `jurnals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT;

--
-- Constraints for table `jurnal_personels`
--
ALTER TABLE `jurnal_personels`
  ADD CONSTRAINT `jurnal_personels_jurnal_id_foreign` FOREIGN KEY (`jurnal_id`) REFERENCES `jurnals` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `jurnal_personels_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT;

--
-- Constraints for table `luarans`
--
ALTER TABLE `luarans`
  ADD CONSTRAINT `luarans_jenis_luaran_id_foreign` FOREIGN KEY (`jenis_luaran_id`) REFERENCES `jenis_luarans` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `luarans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT;

--
-- Constraints for table `luaran_personels`
--
ALTER TABLE `luaran_personels`
  ADD CONSTRAINT `luaran_personels_luaran_id_foreign` FOREIGN KEY (`luaran_id`) REFERENCES `luarans` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `luaran_personels_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT;

--
-- Constraints for table `makalahs`
--
ALTER TABLE `makalahs`
  ADD CONSTRAINT `makalahs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT;

--
-- Constraints for table `makalah_personels`
--
ALTER TABLE `makalah_personels`
  ADD CONSTRAINT `makalah_personels_makalah_id_foreign` FOREIGN KEY (`makalah_id`) REFERENCES `makalahs` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `makalah_personels_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT;

--
-- Constraints for table `penelitians`
--
ALTER TABLE `penelitians`
  ADD CONSTRAINT `penelitians_jenis_pendanaan_id_foreign` FOREIGN KEY (`jenis_pendanaan_id`) REFERENCES `jenis_pendanaans` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `penelitians_jenis_penelitian_id_foreign` FOREIGN KEY (`jenis_penelitian_id`) REFERENCES `jenis_penelitians` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `penelitians_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT;

--
-- Constraints for table `penelitian_personels`
--
ALTER TABLE `penelitian_personels`
  ADD CONSTRAINT `penelitian_personels_penelitian_id_foreign` FOREIGN KEY (`penelitian_id`) REFERENCES `penelitians` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `penelitian_personels_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT;

--
-- Constraints for table `penelitian_revisis`
--
ALTER TABLE `penelitian_revisis`
  ADD CONSTRAINT `penelitian_revisis_penelitian_id_foreign` FOREIGN KEY (`penelitian_id`) REFERENCES `penelitians` (`id`) ON DELETE RESTRICT;

--
-- Constraints for table `pengabdians`
--
ALTER TABLE `pengabdians`
  ADD CONSTRAINT `pengabdians_jenis_pendanaan_id_foreign` FOREIGN KEY (`jenis_pendanaan_id`) REFERENCES `jenis_pendanaans` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `pengabdians_jenis_pengabdian_id_foreign` FOREIGN KEY (`jenis_pengabdian_id`) REFERENCES `jenis_pengabdians` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `pengabdians_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT;

--
-- Constraints for table `pengabdian_personels`
--
ALTER TABLE `pengabdian_personels`
  ADD CONSTRAINT `pengabdian_personels_pengabdian_id_foreign` FOREIGN KEY (`pengabdian_id`) REFERENCES `pengabdians` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `pengabdian_personels_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT;

--
-- Constraints for table `pengabdian_revisis`
--
ALTER TABLE `pengabdian_revisis`
  ADD CONSTRAINT `pengabdian_revisis_pengabdian_id_foreign` FOREIGN KEY (`pengabdian_id`) REFERENCES `pengabdians` (`id`) ON DELETE RESTRICT;

--
-- Constraints for table `prodis`
--
ALTER TABLE `prodis`
  ADD CONSTRAINT `prodis_fakultas_id_foreign` FOREIGN KEY (`fakultas_id`) REFERENCES `fakultas` (`id`) ON DELETE RESTRICT;

--
-- Constraints for table `proposals`
--
ALTER TABLE `proposals`
  ADD CONSTRAINT `proposals_jenis_pendanaan_id_foreign` FOREIGN KEY (`jenis_pendanaan_id`) REFERENCES `jenis_pendanaans` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `proposals_jenis_penelitian_id_foreign` FOREIGN KEY (`jenis_penelitian_id`) REFERENCES `jenis_penelitians` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `proposals_jenis_pengabdian_id_foreign` FOREIGN KEY (`jenis_pengabdian_id`) REFERENCES `jenis_pengabdians` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `proposals_peninjau_id_foreign` FOREIGN KEY (`peninjau_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `proposals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT;

--
-- Constraints for table `proposal_mous`
--
ALTER TABLE `proposal_mous`
  ADD CONSTRAINT `proposal_mous_proposal_id_foreign` FOREIGN KEY (`proposal_id`) REFERENCES `proposals` (`id`) ON DELETE RESTRICT;

--
-- Constraints for table `proposal_personels`
--
ALTER TABLE `proposal_personels`
  ADD CONSTRAINT `proposal_personels_proposal_id_foreign` FOREIGN KEY (`proposal_id`) REFERENCES `proposals` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `proposal_personels_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT;

--
-- Constraints for table `proposal_revisis`
--
ALTER TABLE `proposal_revisis`
  ADD CONSTRAINT `proposal_revisis_proposal_id_foreign` FOREIGN KEY (`proposal_id`) REFERENCES `proposals` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `proposal_revisis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_prodi_id_foreign` FOREIGN KEY (`prodi_id`) REFERENCES `prodis` (`id`) ON DELETE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
