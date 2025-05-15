-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Apr 27, 2025 at 04:21 PM
-- Server version: 5.7.39
-- PHP Version: 8.2.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pelatihan_satunama`
--

-- --------------------------------------------------------

--
-- Table structure for table `assesment_peserta_permintaan`
--

CREATE TABLE `assesment_peserta_permintaan` (
  `id_peserta` bigint(20) NOT NULL,
  `id_permintaan` bigint(20) NOT NULL,
  `id_user` bigint(20) UNSIGNED DEFAULT NULL,
  `nama_peserta` varchar(191) NOT NULL,
  `email_peserta` varchar(191) NOT NULL,
  `jenis_kelamin` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `tanggung_jawab` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assesment_peserta_permintaan`
--

INSERT INTO `assesment_peserta_permintaan` (`id_peserta`, `id_permintaan`, `id_user`, `nama_peserta`, `email_peserta`, `jenis_kelamin`, `jabatan`, `tanggung_jawab`, `created_at`, `updated_at`) VALUES
(4, 18, NULL, 'aaa', 'aaa@gmail.com', 'Laki-laki', 'sad', 'asds', '2025-04-12 14:38:49', '2025-04-12 14:38:49'),
(5, 18, NULL, 'bbb', 'bbb@gmail.com', 'Perempuan', 'asdas', 'asdddas', '2025-04-12 14:38:49', '2025-04-12 14:38:49');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `discussions`
--

CREATE TABLE `discussions` (
  `id_diskusi` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `views` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `discussions`
--

INSERT INTO `discussions` (`id_diskusi`, `id_user`, `title`, `content`, `views`, `created_at`, `updated_at`) VALUES
(6, 2, 'test', '<p>test</p>', 69, '2025-02-15 11:07:20', '2025-04-09 15:56:34'),
(22, 13, 'coba 1 file', '<p>file word</p>', 29, '2025-04-08 12:25:38', '2025-04-27 06:11:41'),
(23, 13, 'coba 2 file', '<p>2 file pdf</p>', 23, '2025-04-08 12:27:51', '2025-04-27 06:07:37');

-- --------------------------------------------------------

--
-- Table structure for table `discussions_files`
--

CREATE TABLE `discussions_files` (
  `id_file` bigint(20) NOT NULL,
  `id_diskusi` bigint(20) UNSIGNED NOT NULL,
  `file_url` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `discussions_files`
--

INSERT INTO `discussions_files` (`id_file`, `id_diskusi`, `file_url`) VALUES
(10, 22, 'https://drive.google.com/file/d/1iBfe_cJEjw2JSun5JjxE1AEU3OAHwqDo/view?usp=sharing'),
(11, 23, 'https://drive.google.com/file/d/1Ona9qzgJC4b9smT2QDwWvqEtwI7nsx7L/view?usp=sharing'),
(12, 23, 'https://drive.google.com/file/d/1_A7i0d4mB8QkW_928n2F_0kz1vv1chh6/view?usp=sharing');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fasilitator_foto`
--

CREATE TABLE `fasilitator_foto` (
  `id_foto` bigint(20) NOT NULL,
  `id_fasilitator` bigint(20) NOT NULL,
  `photo_url` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fasilitator_foto`
--

INSERT INTO `fasilitator_foto` (`id_foto`, `id_fasilitator`, `photo_url`) VALUES
(3, 10, 'pat-removebg-preview.png');

-- --------------------------------------------------------

--
-- Table structure for table `fasilitator_pelatihan`
--

CREATE TABLE `fasilitator_pelatihan` (
  `id_fasilitator` bigint(20) NOT NULL,
  `nama_fasilitator` varchar(191) DEFAULT NULL,
  `jenis_kelamin` varchar(100) DEFAULT NULL,
  `nik` varchar(50) DEFAULT NULL,
  `email_fasilitator` varchar(50) DEFAULT NULL,
  `nomor_telepon` varchar(50) DEFAULT NULL,
  `alamat` varchar(191) DEFAULT NULL,
  `id_internal_eksternal` bigint(20) DEFAULT NULL,
  `asal_lembaga` varchar(100) DEFAULT NULL,
  `body` text,
  `facebook` varchar(100) DEFAULT NULL,
  `twitter` varchar(100) DEFAULT NULL,
  `instagram` varchar(100) DEFAULT NULL,
  `linkedin` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fasilitator_pelatihan`
--

INSERT INTO `fasilitator_pelatihan` (`id_fasilitator`, `nama_fasilitator`, `jenis_kelamin`, `nik`, `email_fasilitator`, `nomor_telepon`, `alamat`, `id_internal_eksternal`, `asal_lembaga`, `body`, `facebook`, `twitter`, `instagram`, `linkedin`, `created_at`, `updated_at`) VALUES
(6, 'Agustine Dwi', 'Perempuan', '3576447103920003', 'agustine@satunama.org', '081234567891', 'Bantul', 1, 'SATUNAMA', 'MEL Specialist &amp; Officer', NULL, NULL, NULL, NULL, '2023-07-10 21:02:23', '2025-04-10 17:16:09'),
(7, 'Gerald Parongko', 'Laki-Laki', '3576447103920004', 'gerald@gmail.com', '082133768273', 'Amazon green', 1, 'SATUNAMA', 'Amazon green', NULL, NULL, NULL, NULL, '2023-11-06 05:12:36', '2024-05-07 22:44:44'),
(9, 'Makrus Ali', 'Laki-laki', '3576447103920006', 'markus@gmail.com', '08213XXXXX', 'Jalan Hasanuddin', 1, 'SATUNAMA', '<div>Lorem ipsum dolor, sit amet consectetur adipisicing elit.&nbsp;</div>', NULL, NULL, NULL, NULL, '2024-04-13 06:34:26', '2024-04-13 06:34:26'),
(10, 'Tandirilambun', 'Laki-Laki', '2222222222222222', 'tndiri@gmail.com', '082999111222', 'Jl. Tuntungan Yogyakarta', 2, 'Universitas Kristen Duta Wacana', 'JavaScript', NULL, NULL, NULL, NULL, '2024-05-06 03:38:14', '2025-04-10 17:20:41'),
(13, 'laurent', 'Perempuan', '123456789000', 'laurent@gmail.com', '0812345678', 'Jl. Tuntungan Yogyakarta', 1, 'SATUNAMA', '<div>Manajemen keungan</div>', NULL, NULL, NULL, NULL, '2024-05-13 20:39:25', '2024-05-13 20:40:14'),
(14, 'Debora', 'Laki-Laki', '2345678900111', 'debora@gmail.com', '56789019', 'Kota Besar', 1, 'SATUNAMA', '<div>Komunikasi, Training, Perencanaan</div>', NULL, NULL, NULL, NULL, '2024-05-13 21:18:25', '2024-05-13 21:18:51'),
(15, 'Mejun', 'Perempuan', '45678987', 'mejun@gmail.com', '08976564856', 'Duwet', 1, 'SATUNAMA', '<div>menjahit</div>', NULL, NULL, NULL, NULL, '2024-05-13 21:53:05', '2024-05-13 21:53:42');

-- --------------------------------------------------------

--
-- Table structure for table `form_evaluasi_konsultasi`
--

CREATE TABLE `form_evaluasi_konsultasi` (
  `id_form_evaluasi_konsultasi` bigint(20) NOT NULL,
  `id_pelatihan_konsultasi` bigint(20) NOT NULL,
  `content` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `form_evaluasi_konsultasi`
--

INSERT INTO `form_evaluasi_konsultasi` (`id_form_evaluasi_konsultasi`, `id_pelatihan_konsultasi`, `content`, `created_at`, `updated_at`) VALUES
(2, 2, '[{\"name\": \"metode_yang_digunakan\", \"type\": \"radio-group\", \"label\": \"Metode yang digunakan\", \"other\": false, \"inline\": true, \"values\": [{\"label\": \"Kurang\", \"value\": \"1\", \"selected\": false}, {\"label\": \"Cukup\", \"value\": \"2\", \"selected\": false}, {\"label\": \"Baik\", \"value\": \"3\", \"selected\": false}, {\"label\": \"Sangat Baik\", \"value\": \"4\", \"selected\": false}], \"required\": true}, {\"name\": \"kemampuan_merespon_peserta\", \"type\": \"radio-group\", \"label\": \"<span style=\\\"color: rgb(32, 33, 36); font-family: docs-Roboto, Helvetica, Arial, sans-serif; font-size: 16px;\\\">Kemampuan merespon peserta</span>\", \"other\": false, \"inline\": true, \"values\": [{\"label\": \"Kurang\", \"value\": \"1\", \"selected\": false}, {\"label\": \"Cukup\", \"value\": \"2\", \"selected\": false}, {\"label\": \"Baik\", \"value\": \"3\", \"selected\": false}, {\"label\": \"Sangat Baik\", \"value\": \"4\", \"selected\": false}], \"required\": true}, {\"name\": \"pengembangan_proses\", \"type\": \"radio-group\", \"label\": \"<span class=\\\"M7eMe\\\" style=\\\"font-size: 16px; font-family: docs-Roboto, Helvetica, Arial, sans-serif; letter-spacing: 0px; color: rgb(32, 33, 36);\\\">Pengendalian/ pengembangan proses</span>\", \"other\": false, \"inline\": true, \"values\": [{\"label\": \"Kurang\", \"value\": \"1\", \"selected\": false}, {\"label\": \"Cukup\", \"value\": \"2\", \"selected\": false}, {\"label\": \"Baik\", \"value\": \"3\", \"selected\": false}, {\"label\": \"Sangat Baik\", \"value\": \"4\", \"selected\": false}], \"required\": true}, {\"name\": \"kecukupan_waktu\", \"type\": \"radio-group\", \"label\": \"<span style=\\\"color: rgb(32, 33, 36); font-family: docs-Roboto, Helvetica, Arial, sans-serif; font-size: 16px;\\\">Kecukupan waktu</span>\", \"other\": false, \"inline\": true, \"values\": [{\"label\": \"Kurang\", \"value\": \"1\", \"selected\": false}, {\"label\": \"Cukup\", \"value\": \"2\", \"selected\": false}, {\"label\": \"Baik\", \"value\": \"3\", \"selected\": false}, {\"label\": \"Sangat Baik\", \"value\": \"4\", \"selected\": false}], \"required\": true}, {\"name\": \"penguasaan_materi\", \"type\": \"radio-group\", \"label\": \"<span class=\\\"M7eMe\\\" style=\\\"font-size: 16px; font-family: docs-Roboto, Helvetica, Arial, sans-serif; letter-spacing: 0px; color: rgb(32, 33, 36);\\\">Penguasaan materi</span><br>\", \"other\": false, \"inline\": true, \"values\": [{\"label\": \"Kurang\", \"value\": \"1\", \"selected\": false}, {\"label\": \"Cukup\", \"value\": \"2\", \"selected\": false}, {\"label\": \"Baik\", \"value\": \"3\", \"selected\": false}, {\"label\": \"Sangat Baik\", \"value\": \"4\", \"selected\": false}], \"required\": true}, {\"name\": \"kemampuan_menyampaikan_materi\", \"type\": \"radio-group\", \"label\": \"<span class=\\\"M7eMe\\\" style=\\\"font-size: 16px; font-family: docs-Roboto, Helvetica, Arial, sans-serif; letter-spacing: 0px; color: rgb(32, 33, 36);\\\">Kemampuan menyampaikan materi</span><br>\", \"other\": false, \"inline\": true, \"values\": [{\"label\": \"Kurang\", \"value\": \"1\", \"selected\": false}, {\"label\": \"Cukup\", \"value\": \"2\", \"selected\": false}, {\"label\": \"Baik\", \"value\": \"3\", \"selected\": false}, {\"label\": \"Sangat Baik\", \"value\": \"4\", \"selected\": false}], \"required\": true}, {\"name\": \"catatan_fasilitator\", \"type\": \"textarea\", \"label\": \"<span style=\\\"color: rgb(32, 33, 36); font-family: docs-Roboto, Helvetica, Arial, sans-serif; font-size: 16px;\\\">CATATAN : Apapun nilai yang anda berikan di atas, mohon diberikan penjelasan dalam satu atau dua kalimat di bawah ini:</span>\", \"subtype\": \"textarea\", \"required\": true, \"className\": \"form-control\"}, {\"type\": \"header\", \"label\": \"Peserta<br><span style=\\\"color: rgb(32, 33, 36); font-family: Roboto, Arial, sans-serif; font-size: 14.6667px; white-space-collapse: preserve;\\\">Silahkan menilai dan memberi komentar untuk hal-hal berikut :</span><br>\", \"subtype\": \"h6\"}, {\"name\": \"partisipasi_peserta\", \"type\": \"radio-group\", \"label\": \"<span class=\\\"M7eMe\\\" style=\\\"font-size: 16px; font-family: docs-Roboto, Helvetica, Arial, sans-serif; letter-spacing: 0px; color: rgb(32, 33, 36);\\\">Partisipasi peserta</span><br>\", \"other\": false, \"inline\": true, \"values\": [{\"label\": \"Kurang\", \"value\": \"1\", \"selected\": false}, {\"label\": \"Cukup\", \"value\": \"2\", \"selected\": false}, {\"label\": \"Baik\", \"value\": \"3\", \"selected\": false}, {\"label\": \"Sangat Baik\", \"value\": \"4\", \"selected\": false}], \"required\": true}, {\"name\": \"disiplin_peserta\", \"type\": \"radio-group\", \"label\": \"<span class=\\\"M7eMe\\\" style=\\\"font-size: 16px; font-family: docs-Roboto, Helvetica, Arial, sans-serif; letter-spacing: 0px; color: rgb(32, 33, 36);\\\">Disiplin peserta</span><br>\", \"other\": false, \"inline\": true, \"values\": [{\"label\": \"Kurang\", \"value\": \"1\", \"selected\": false}, {\"label\": \"Cukup\", \"value\": \"2\", \"selected\": false}, {\"label\": \"Baik\", \"value\": \"3\", \"selected\": false}, {\"label\": \"Sangat Baik\", \"value\": \"4\", \"selected\": false}], \"required\": true}, {\"name\": \"kemampuan_menyerap_materi\", \"type\": \"radio-group\", \"label\": \"<span class=\\\"M7eMe\\\" style=\\\"font-size: 16px; font-family: docs-Roboto, Helvetica, Arial, sans-serif; letter-spacing: 0px; color: rgb(32, 33, 36);\\\">Kemampuan menyerap materi</span><br>\", \"other\": false, \"inline\": true, \"values\": [{\"label\": \"Kurang\", \"value\": \"1\", \"selected\": false}, {\"label\": \"Cukup\", \"value\": \"2\", \"selected\": false}, {\"label\": \"Baik\", \"value\": \"3\", \"selected\": false}, {\"label\": \"Sangat Baik\", \"value\": \"4\", \"selected\": false}], \"required\": true}, {\"name\": \"keterbukaan_gagasan\", \"type\": \"radio-group\", \"label\": \"<span class=\\\"M7eMe\\\" style=\\\"font-size: 16px; font-family: docs-Roboto, Helvetica, Arial, sans-serif; letter-spacing: 0px; color: rgb(32, 33, 36);\\\">Keterbukaan gagasan</span><br>\", \"other\": false, \"inline\": true, \"values\": [{\"label\": \"Kurang\", \"value\": \"1\", \"selected\": false}, {\"label\": \"Cukup\", \"value\": \"2\", \"selected\": false}, {\"label\": \"Baik\", \"value\": \"3\", \"selected\": false}, {\"label\": \"Sangat Baik\", \"value\": \"4\", \"selected\": false}], \"required\": true}, {\"name\": \"catatan_peserta\", \"type\": \"textarea\", \"label\": \"<span style=\\\"color: rgb(32, 33, 36); font-family: docs-Roboto, Helvetica, Arial, sans-serif; font-size: 16px;\\\">CATATAN : Apapun nilai yang anda berikan di atas, mohon diberikan penjelasan dalam satu atau dua kalimat di bawah ini:</span>\", \"subtype\": \"textarea\", \"required\": true, \"className\": \"form-control\"}, {\"type\": \"header\", \"label\": \"Materi Pelatihan<br><span style=\\\"color: rgb(32, 33, 36); font-family: Roboto, Arial, sans-serif; font-size: 14.6667px; white-space-collapse: preserve;\\\">Dari topik-topik pembahasan di bawah, manakah yang :</span><br>\", \"subtype\": \"h6\"}, {\"name\": \"materi\", \"type\": \"radio-group\", \"label\": \"<span class=\\\"M7eMe\\\" style=\\\"font-size: 16px; font-family: docs-Roboto, Helvetica, Arial, sans-serif; letter-spacing: 0px; color: rgb(32, 33, 36);\\\"><p style=\\\"margin-bottom: 0px;\\\">Materi 1</p></span>\", \"other\": false, \"inline\": false, \"values\": [{\"label\": \"Tidak dipahami\", \"value\": \"Tidak dipahami\", \"selected\": false}, {\"label\": \"Mudah dipahami\", \"value\": \"Mudah dipahami\", \"selected\": false}, {\"label\": \"Sulit dipahami\", \"value\": \"Sulit dipahami\", \"selected\": false}, {\"label\": \"Sudah dipahami sebelumnya/ tidak ada hal baru\", \"value\": \"Sudah dipahami sebelumnya/ tidak ada hal baru\", \"selected\": false}], \"required\": true}, {\"type\": \"header\", \"label\": \"Fasilitas<br>\", \"subtype\": \"h6\"}, {\"name\": \"ruang_kelas\", \"type\": \"radio-group\", \"label\": \"<span class=\\\"M7eMe\\\" style=\\\"font-size: 16px; font-family: docs-Roboto, Helvetica, Arial, sans-serif; letter-spacing: 0px; color: rgb(32, 33, 36);\\\"><p style=\\\"margin-bottom: 0px;\\\">Ruang Kelas<br></p></span>\", \"other\": false, \"inline\": true, \"values\": [{\"label\": \"Tidak memuaskan\", \"value\": \"1\", \"selected\": false}, {\"label\": \"Kurang memuaskan\", \"value\": \"2\", \"selected\": false}, {\"label\": \"Cukup memuaskan\", \"value\": \"3\", \"selected\": false}, {\"label\": \"Memuaskan\", \"value\": \"4\", \"selected\": false}, {\"label\": \"Sangat Memuaskan\", \"value\": \"5\", \"selected\": false}], \"required\": true}, {\"name\": \"konsumsi\", \"type\": \"radio-group\", \"label\": \"<span style=\\\"color: rgb(32, 33, 36); font-family: docs-Roboto, Helvetica, Arial, sans-serif; font-size: 16px;\\\">Konsumsi</span>\", \"other\": false, \"inline\": true, \"values\": [{\"label\": \"Tidak memuaskan\", \"value\": \"1\", \"selected\": false}, {\"label\": \"Kurang memuaskan\", \"value\": \"2\", \"selected\": false}, {\"label\": \"Cukup memuaskan\", \"value\": \"3\", \"selected\": false}, {\"label\": \"Memuaskan\", \"value\": \"4\", \"selected\": false}, {\"label\": \"Sangat Memuaskan\", \"value\": \"5\", \"selected\": false}], \"required\": true}, {\"name\": \"layanan_panitia\", \"type\": \"radio-group\", \"label\": \"<span class=\\\"M7eMe\\\" style=\\\"font-size: 16px; font-family: docs-Roboto, Helvetica, Arial, sans-serif; letter-spacing: 0px; color: rgb(32, 33, 36);\\\">Layanan Panitia</span><br>\", \"other\": false, \"inline\": true, \"values\": [{\"label\": \"Tidak memuaskan\", \"value\": \"1\", \"selected\": false}, {\"label\": \"Kurang memuaskan\", \"value\": \"2\", \"selected\": false}, {\"label\": \"Cukup memuaskan\", \"value\": \"3\", \"selected\": false}, {\"label\": \"Memuaskan\", \"value\": \"4\", \"selected\": false}, {\"label\": \"Sangat Memuaskan\", \"value\": \"5\", \"selected\": false}], \"required\": true}, {\"name\": \"perbaikan_pelatihan\", \"type\": \"textarea\", \"label\": \"<span style=\\\"color: rgb(32, 33, 36); font-family: docs-Roboto, Helvetica, Arial, sans-serif; font-size: 16px;\\\">Apa yang dapat dilakukan untuk memperbaiki pelatihan ini, baik konten/ materi pelatihan maupun fasilitas pelatihan ?&nbsp;</span><br>\", \"subtype\": \"textarea\", \"required\": true, \"className\": \"form-control\"}, {\"name\": \"rekomendasi_pelatihan\", \"type\": \"radio-group\", \"label\": \"<span class=\\\"M7eMe\\\" style=\\\"font-size: 16px; font-family: docs-Roboto, Helvetica, Arial, sans-serif; letter-spacing: 0px; color: rgb(32, 33, 36);\\\">Saya akan merekomendasikan orang lain untuk mengikuti pelatihan ini<br></span>\", \"other\": false, \"inline\": false, \"values\": [{\"label\": \"Ya\", \"value\": \"Ya\", \"selected\": false}, {\"label\": \"Tidak\", \"value\": \"Tidak\", \"selected\": false}], \"required\": true}, {\"name\": \"kontak\", \"type\": \"text\", \"label\": \"<span style=\\\"color: rgb(32, 33, 36); font-family: docs-Roboto, Helvetica, Arial, sans-serif; font-size: 16px;\\\">Jika ya, sebutkan nama, lembaga dan kontak yang bisa dihubungi:</span>\", \"subtype\": \"text\", \"required\": true, \"className\": \"form-control\"}, {\"name\": \"manfaat_pelatihan\", \"type\": \"textarea\", \"label\": \"<span style=\\\"color: rgb(32, 33, 36); font-family: docs-Roboto, Helvetica, Arial, sans-serif; font-size: 16px;\\\">Hal yang paling utama yang saya dapatkan / pelajari dari pelatihan ini :</span><br>\", \"subtype\": \"textarea\", \"required\": true, \"className\": \"form-control\"}, {\"name\": \"pelatihan_yang_dibutuhkan\", \"type\": \"textarea\", \"label\": \"<span style=\\\"color: rgb(32, 33, 36); font-family: docs-Roboto, Helvetica, Arial, sans-serif; font-size: 16px;\\\">Pelatihan apa yang masih saya butuhkan utuk mendukung pekerjaan saya ?</span><br>\", \"subtype\": \"textarea\", \"required\": true, \"className\": \"form-control\"}]', '2025-03-19 20:19:43', '2025-04-13 13:53:59');

-- --------------------------------------------------------

--
-- Table structure for table `form_evaluasi_permintaan`
--

CREATE TABLE `form_evaluasi_permintaan` (
  `id_form_evaluasi_permintaan` bigint(20) NOT NULL,
  `id_pelatihan_permintaan` bigint(20) NOT NULL,
  `content` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `form_evaluasi_permintaan`
--

INSERT INTO `form_evaluasi_permintaan` (`id_form_evaluasi_permintaan`, `id_pelatihan_permintaan`, `content`, `created_at`, `updated_at`) VALUES
(5, 4, '[{\"type\": \"header\", \"label\": \"Fasilitator&nbsp; 1 : <br><span style=\\\"color: rgb(32, 33, 36); font-family: Roboto, Arial, sans-serif; font-size: 14.6667px; white-space-collapse: preserve;\\\">Silahkan menilai dan memberi komentar untuk hal-hal berikut :</span><br>\", \"subtype\": \"h6\"}, {\"name\": \"metode_yang_digunakan\", \"type\": \"radio-group\", \"label\": \"Metode yang digunakan\", \"other\": false, \"inline\": true, \"values\": [{\"label\": \"Kurang\", \"value\": \"1\", \"selected\": false}, {\"label\": \"Cukup\", \"value\": \"2\", \"selected\": false}, {\"label\": \"Baik\", \"value\": \"3\", \"selected\": false}, {\"label\": \"Sangat Baik\", \"value\": \"4\", \"selected\": false}], \"required\": true}, {\"name\": \"kemampuan_merespon_peserta\", \"type\": \"radio-group\", \"label\": \"<span style=\\\"color: rgb(32, 33, 36); font-family: docs-Roboto, Helvetica, Arial, sans-serif; font-size: 16px;\\\">Kemampuan merespon peserta</span>\", \"other\": false, \"inline\": true, \"values\": [{\"label\": \"Kurang\", \"value\": \"1\", \"selected\": false}, {\"label\": \"Cukup\", \"value\": \"2\", \"selected\": false}, {\"label\": \"Baik\", \"value\": \"3\", \"selected\": false}, {\"label\": \"Sangat Baik\", \"value\": \"4\", \"selected\": false}], \"required\": true}, {\"name\": \"pengembangan_proses\", \"type\": \"radio-group\", \"label\": \"<span class=\\\"M7eMe\\\" style=\\\"font-size: 16px; font-family: docs-Roboto, Helvetica, Arial, sans-serif; letter-spacing: 0px; color: rgb(32, 33, 36);\\\">Pengendalian/ pengembangan proses</span>\", \"other\": false, \"inline\": true, \"values\": [{\"label\": \"Kurang\", \"value\": \"1\", \"selected\": false}, {\"label\": \"Cukup\", \"value\": \"2\", \"selected\": false}, {\"label\": \"Baik\", \"value\": \"3\", \"selected\": false}, {\"label\": \"Sangat Baik\", \"value\": \"4\", \"selected\": false}], \"required\": true}, {\"name\": \"kecukupan_waktu\", \"type\": \"radio-group\", \"label\": \"<span style=\\\"color: rgb(32, 33, 36); font-family: docs-Roboto, Helvetica, Arial, sans-serif; font-size: 16px;\\\">Kecukupan waktu</span>\", \"other\": false, \"inline\": true, \"values\": [{\"label\": \"Kurang\", \"value\": \"1\", \"selected\": false}, {\"label\": \"Cukup\", \"value\": \"2\", \"selected\": false}, {\"label\": \"Baik\", \"value\": \"3\", \"selected\": false}, {\"label\": \"Sangat Baik\", \"value\": \"4\", \"selected\": false}], \"required\": true}, {\"name\": \"penguasaan_materi\", \"type\": \"radio-group\", \"label\": \"<span class=\\\"M7eMe\\\" style=\\\"font-size: 16px; font-family: docs-Roboto, Helvetica, Arial, sans-serif; letter-spacing: 0px; color: rgb(32, 33, 36);\\\">Penguasaan materi</span><br>\", \"other\": false, \"inline\": true, \"values\": [{\"label\": \"Kurang\", \"value\": \"1\", \"selected\": false}, {\"label\": \"Cukup\", \"value\": \"2\", \"selected\": false}, {\"label\": \"Baik\", \"value\": \"3\", \"selected\": false}, {\"label\": \"Sangat Baik\", \"value\": \"4\", \"selected\": false}], \"required\": true}, {\"name\": \"kemampuan_menyampaikan_materi\", \"type\": \"radio-group\", \"label\": \"<span class=\\\"M7eMe\\\" style=\\\"font-size: 16px; font-family: docs-Roboto, Helvetica, Arial, sans-serif; letter-spacing: 0px; color: rgb(32, 33, 36);\\\">Kemampuan menyampaikan materi</span><br>\", \"other\": false, \"inline\": true, \"values\": [{\"label\": \"Kurang\", \"value\": \"1\", \"selected\": false}, {\"label\": \"Cukup\", \"value\": \"2\", \"selected\": false}, {\"label\": \"Baik\", \"value\": \"3\", \"selected\": false}, {\"label\": \"Sangat Baik\", \"value\": \"4\", \"selected\": false}], \"required\": true}, {\"name\": \"catatan_fasilitator\", \"type\": \"textarea\", \"label\": \"<span style=\\\"color: rgb(32, 33, 36); font-family: docs-Roboto, Helvetica, Arial, sans-serif; font-size: 16px;\\\">CATATAN : Apapun nilai yang anda berikan di atas, mohon diberikan penjelasan dalam satu atau dua kalimat di bawah ini:</span>\", \"subtype\": \"textarea\", \"required\": true, \"className\": \"form-control\"}, {\"type\": \"header\", \"label\": \"Peserta<br><span style=\\\"color: rgb(32, 33, 36); font-family: Roboto, Arial, sans-serif; font-size: 14.6667px; white-space-collapse: preserve;\\\">Silahkan menilai dan memberi komentar untuk hal-hal berikut :</span><br>\", \"subtype\": \"h6\"}, {\"name\": \"partisipasi_peserta\", \"type\": \"radio-group\", \"label\": \"<span class=\\\"M7eMe\\\" style=\\\"font-size: 16px; font-family: docs-Roboto, Helvetica, Arial, sans-serif; letter-spacing: 0px; color: rgb(32, 33, 36);\\\">Partisipasi peserta</span><br>\", \"other\": false, \"inline\": true, \"values\": [{\"label\": \"Kurang\", \"value\": \"1\", \"selected\": false}, {\"label\": \"Cukup\", \"value\": \"2\", \"selected\": false}, {\"label\": \"Baik\", \"value\": \"3\", \"selected\": false}, {\"label\": \"Sangat Baik\", \"value\": \"4\", \"selected\": false}], \"required\": true}, {\"name\": \"disiplin_peserta\", \"type\": \"radio-group\", \"label\": \"<span class=\\\"M7eMe\\\" style=\\\"font-size: 16px; font-family: docs-Roboto, Helvetica, Arial, sans-serif; letter-spacing: 0px; color: rgb(32, 33, 36);\\\">Disiplin peserta</span><br>\", \"other\": false, \"inline\": true, \"values\": [{\"label\": \"Kurang\", \"value\": \"1\", \"selected\": false}, {\"label\": \"Cukup\", \"value\": \"2\", \"selected\": false}, {\"label\": \"Baik\", \"value\": \"3\", \"selected\": false}, {\"label\": \"Sangat Baik\", \"value\": \"4\", \"selected\": false}], \"required\": true}, {\"name\": \"kemampuan_menyerap_materi\", \"type\": \"radio-group\", \"label\": \"<span class=\\\"M7eMe\\\" style=\\\"font-size: 16px; font-family: docs-Roboto, Helvetica, Arial, sans-serif; letter-spacing: 0px; color: rgb(32, 33, 36);\\\">Kemampuan menyerap materi</span><br>\", \"other\": false, \"inline\": true, \"values\": [{\"label\": \"Kurang\", \"value\": \"1\", \"selected\": false}, {\"label\": \"Cukup\", \"value\": \"2\", \"selected\": false}, {\"label\": \"Baik\", \"value\": \"3\", \"selected\": false}, {\"label\": \"Sangat Baik\", \"value\": \"4\", \"selected\": false}], \"required\": true}, {\"name\": \"keterbukaan_gagasan\", \"type\": \"radio-group\", \"label\": \"<span class=\\\"M7eMe\\\" style=\\\"font-size: 16px; font-family: docs-Roboto, Helvetica, Arial, sans-serif; letter-spacing: 0px; color: rgb(32, 33, 36);\\\">Keterbukaan gagasan</span><br>\", \"other\": false, \"inline\": true, \"values\": [{\"label\": \"Kurang\", \"value\": \"1\", \"selected\": false}, {\"label\": \"Cukup\", \"value\": \"2\", \"selected\": false}, {\"label\": \"Baik\", \"value\": \"3\", \"selected\": false}, {\"label\": \"Sangat Baik\", \"value\": \"4\", \"selected\": false}], \"required\": true}, {\"name\": \"catatan_peserta\", \"type\": \"textarea\", \"label\": \"<span style=\\\"color: rgb(32, 33, 36); font-family: docs-Roboto, Helvetica, Arial, sans-serif; font-size: 16px;\\\">CATATAN : Apapun nilai yang anda berikan di atas, mohon diberikan penjelasan dalam satu atau dua kalimat di bawah ini:</span>\", \"subtype\": \"textarea\", \"required\": true, \"className\": \"form-control\"}, {\"type\": \"header\", \"label\": \"Materi Pelatihan<br><span style=\\\"color: rgb(32, 33, 36); font-family: Roboto, Arial, sans-serif; font-size: 14.6667px; white-space-collapse: preserve;\\\">Dari topik-topik pembahasan di bawah, manakah yang :</span><br>\", \"subtype\": \"h6\"}, {\"name\": \"materi\", \"type\": \"radio-group\", \"label\": \"<span class=\\\"M7eMe\\\" style=\\\"font-size: 16px; font-family: docs-Roboto, Helvetica, Arial, sans-serif; letter-spacing: 0px; color: rgb(32, 33, 36);\\\"><p style=\\\"margin-bottom: 0px;\\\">Materi 1</p></span>\", \"other\": false, \"inline\": false, \"values\": [{\"label\": \"Tidak dipahami\", \"value\": \"Tidak dipahami\", \"selected\": false}, {\"label\": \"Mudah dipahami\", \"value\": \"Mudah dipahami\", \"selected\": false}, {\"label\": \"Sulit dipahami\", \"value\": \"Sulit dipahami\", \"selected\": false}, {\"label\": \"Sudah dipahami sebelumnya/ tidak ada hal baru\", \"value\": \"Sudah dipahami sebelumnya/ tidak ada hal baru\", \"selected\": false}], \"required\": true}, {\"type\": \"header\", \"label\": \"Fasilitas<br>\", \"subtype\": \"h6\"}, {\"name\": \"ruang_kelas\", \"type\": \"radio-group\", \"label\": \"<span class=\\\"M7eMe\\\" style=\\\"font-size: 16px; font-family: docs-Roboto, Helvetica, Arial, sans-serif; letter-spacing: 0px; color: rgb(32, 33, 36);\\\"><p style=\\\"margin-bottom: 0px;\\\">Ruang Kelas<br></p></span>\", \"other\": false, \"inline\": true, \"values\": [{\"label\": \"Tidak memuaskan\", \"value\": \"1\", \"selected\": false}, {\"label\": \"Kurang memuaskan\", \"value\": \"2\", \"selected\": false}, {\"label\": \"Cukup memuaskan\", \"value\": \"3\", \"selected\": false}, {\"label\": \"Memuaskan\", \"value\": \"4\", \"selected\": false}, {\"label\": \"Sangat Memuaskan\", \"value\": \"5\", \"selected\": false}], \"required\": true}, {\"name\": \"konsumsi\", \"type\": \"radio-group\", \"label\": \"<span style=\\\"color: rgb(32, 33, 36); font-family: docs-Roboto, Helvetica, Arial, sans-serif; font-size: 16px;\\\">Konsumsi</span>\", \"other\": false, \"inline\": true, \"values\": [{\"label\": \"Tidak memuaskan\", \"value\": \"1\", \"selected\": false}, {\"label\": \"Kurang memuaskan\", \"value\": \"2\", \"selected\": false}, {\"label\": \"Cukup memuaskan\", \"value\": \"3\", \"selected\": false}, {\"label\": \"Memuaskan\", \"value\": \"4\", \"selected\": false}, {\"label\": \"Sangat Memuaskan\", \"value\": \"5\", \"selected\": false}], \"required\": true}, {\"name\": \"layanan_panitia\", \"type\": \"radio-group\", \"label\": \"<span class=\\\"M7eMe\\\" style=\\\"font-size: 16px; font-family: docs-Roboto, Helvetica, Arial, sans-serif; letter-spacing: 0px; color: rgb(32, 33, 36);\\\">Layanan Panitia</span><br>\", \"other\": false, \"inline\": true, \"values\": [{\"label\": \"Tidak memuaskan\", \"value\": \"1\", \"selected\": false}, {\"label\": \"Kurang memuaskan\", \"value\": \"2\", \"selected\": false}, {\"label\": \"Cukup memuaskan\", \"value\": \"3\", \"selected\": false}, {\"label\": \"Memuaskan\", \"value\": \"4\", \"selected\": false}, {\"label\": \"Sangat Memuaskan\", \"value\": \"5\", \"selected\": false}], \"required\": true}, {\"name\": \"perbaikan_pelatihan\", \"type\": \"textarea\", \"label\": \"<span style=\\\"color: rgb(32, 33, 36); font-family: docs-Roboto, Helvetica, Arial, sans-serif; font-size: 16px;\\\">Apa yang dapat dilakukan untuk memperbaiki pelatihan ini, baik konten/ materi pelatihan maupun fasilitas pelatihan ?&nbsp;</span><br>\", \"subtype\": \"textarea\", \"required\": true, \"className\": \"form-control\"}, {\"name\": \"rekomendasi_pelatihan\", \"type\": \"radio-group\", \"label\": \"<span class=\\\"M7eMe\\\" style=\\\"font-size: 16px; font-family: docs-Roboto, Helvetica, Arial, sans-serif; letter-spacing: 0px; color: rgb(32, 33, 36);\\\">Saya akan merekomendasikan orang lain untuk mengikuti pelatihan ini<br></span>\", \"other\": false, \"inline\": false, \"values\": [{\"label\": \"Ya\", \"value\": \"Ya\", \"selected\": false}, {\"label\": \"Tidak\", \"value\": \"Tidak\", \"selected\": false}], \"required\": true}, {\"name\": \"kontak\", \"type\": \"text\", \"label\": \"<span style=\\\"color: rgb(32, 33, 36); font-family: docs-Roboto, Helvetica, Arial, sans-serif; font-size: 16px;\\\">Jika ya, sebutkan nama, lembaga dan kontak yang bisa dihubungi:</span>\", \"subtype\": \"text\", \"required\": true, \"className\": \"form-control\"}, {\"name\": \"manfaat_pelatihan\", \"type\": \"textarea\", \"label\": \"<span style=\\\"color: rgb(32, 33, 36); font-family: docs-Roboto, Helvetica, Arial, sans-serif; font-size: 16px;\\\">Hal yang paling utama yang saya dapatkan / pelajari dari pelatihan ini :</span><br>\", \"subtype\": \"textarea\", \"required\": true, \"className\": \"form-control\"}, {\"name\": \"pelatihan_yang_dibutuhkan\", \"type\": \"textarea\", \"label\": \"<span style=\\\"color: rgb(32, 33, 36); font-family: docs-Roboto, Helvetica, Arial, sans-serif; font-size: 16px;\\\">Pelatihan apa yang masih saya butuhkan utuk mendukung pekerjaan saya ?</span><br>\", \"subtype\": \"textarea\", \"required\": true, \"className\": \"form-control\"}]', '2025-04-13 13:51:02', '2025-04-13 13:53:17');

-- --------------------------------------------------------

--
-- Table structure for table `form_evaluasi_reguler`
--

CREATE TABLE `form_evaluasi_reguler` (
  `id_form_evaluasi_reguler` bigint(20) NOT NULL,
  `id_reguler` bigint(20) NOT NULL,
  `content` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `form_studidampak_konsultasi`
--

CREATE TABLE `form_studidampak_konsultasi` (
  `id_form_studidampak_konsultasi` bigint(20) NOT NULL,
  `id_pelatihan_konsultasi` bigint(20) NOT NULL,
  `content` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `form_studidampak_konsultasi`
--

INSERT INTO `form_studidampak_konsultasi` (`id_form_studidampak_konsultasi`, `id_pelatihan_konsultasi`, `content`, `created_at`, `updated_at`) VALUES
(1, 2, '[{\"name\": \"radio-group-1712923959383-0\", \"type\": \"radio-group\", \"label\": \"Setelah pelatihan yang anda ikuti, apakah anda mengalami perubahan posisi dalam pekerjaan anda?\", \"other\": false, \"inline\": false, \"values\": [{\"label\": \"Ya\", \"value\": \"Ya\", \"selected\": false}, {\"label\": \"Tidak\", \"value\": \"Tidak\", \"selected\": false}], \"required\": false}, {\"name\": \"text-1712755105419-0\", \"type\": \"text\", \"label\": \"Jika ya, sebutkan posisi pekerjaan anda sebelum mengikuti pelatihan\", \"subtype\": \"text\", \"required\": false, \"className\": \"form-control\"}, {\"name\": \"text-1712930169882\", \"type\": \"text\", \"label\": \"Jika ya, sebutkan posisi pekerjaan anda setelah mengikuti pelatihan\", \"subtype\": \"text\", \"required\": false, \"className\": \"form-control\"}, {\"name\": \"text-1712755107411\", \"type\": \"text\", \"label\": \"Dari materi yang diberikan, topik-topik mana yang langsung dapat digunakan dalam pekerjaan anda?\", \"subtype\": \"text\", \"required\": false, \"className\": \"form-control\"}, {\"name\": \"text-1712755106955\", \"type\": \"text\", \"label\": \"Dari materi yang diberikan, topik-topik mana yang dapat dimanfaatkan untuk meningkatkan kinerja Unit/ divisi/ departemen/ lembaga anda?\", \"subtype\": \"text\", \"required\": false, \"className\": \"form-control\"}, {\"name\": \"text-1712930405787\", \"type\": \"text\", \"label\": \"<div>Dari materi yang diberikan, topik-topik mana yang masih merupakan kesulitan dan perlu diperdalam pemahamannya?</div>\", \"subtype\": \"text\", \"required\": false, \"className\": \"form-control\"}, {\"name\": \"text-1712930416026\", \"type\": \"text\", \"label\": \"<div>Dari materi yang diberikan, topik-topik mana yang dianggap tidak relevan?</div>\", \"subtype\": \"text\", \"required\": false, \"className\": \"form-control\"}, {\"name\": \"text-1712930431010\", \"type\": \"text\", \"label\": \"<div>Kalau pelatihan yang sama ditawarkan lagi, apakah anda merekomendasikan teman sejawat anda untuk mengikuti atau lembaga anda untuk mengirimkan stafnya?</div>\", \"subtype\": \"text\", \"required\": false, \"className\": \"form-control\"}, {\"name\": \"text-1712930448250\", \"type\": \"text\", \"label\": \"<div>Untuk semakin meningkatkan kapasitas anda dan lembaga anda, pelatihan-pelatihan apa yang sangat diperlukan?</div>\", \"subtype\": \"text\", \"required\": false, \"className\": \"form-control\"}]', '2025-03-20 00:00:41', '2025-03-20 00:00:41');

-- --------------------------------------------------------

--
-- Table structure for table `form_studidampak_permintaan`
--

CREATE TABLE `form_studidampak_permintaan` (
  `id_form_studidampak_permintaan` bigint(20) NOT NULL,
  `id_pelatihan_permintaan` bigint(20) NOT NULL,
  `content` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `form_studidampak_reguler`
--

CREATE TABLE `form_studidampak_reguler` (
  `id_form_studidampak_reguler` bigint(20) NOT NULL,
  `id_reguler` bigint(20) NOT NULL,
  `content` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `form_surveykepuasan_konsultasi`
--

CREATE TABLE `form_surveykepuasan_konsultasi` (
  `id_form_surveykepuasan_konsultasi` bigint(20) NOT NULL,
  `id_pelatihan_konsultasi` bigint(20) NOT NULL,
  `content` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `form_surveykepuasan_konsultasi`
--

INSERT INTO `form_surveykepuasan_konsultasi` (`id_form_surveykepuasan_konsultasi`, `id_pelatihan_konsultasi`, `content`, `created_at`, `updated_at`) VALUES
(1, 2, '[{\"name\": \"tingkat_kepuasan\", \"type\": \"radio-group\", \"label\": \"Seberapa puas anda dengan pelatihan di SATUNAMA?\", \"other\": false, \"inline\": true, \"values\": [{\"label\": \"Sangat tidak puas\", \"value\": \"1\", \"selected\": false}, {\"label\": \"Cukup puas\", \"value\": \"2\", \"selected\": false}, {\"label\": \"Puas\", \"value\": \"3\", \"selected\": false}, {\"label\": \"Sangat puas\", \"value\": \"4\", \"selected\": false}], \"required\": true}, {\"name\": \"kemampuan_merespon_peserta\", \"type\": \"radio-group\", \"label\": \"Seberapa cocok dan membantu topik pelatihan yang Anda ikuti dengan pekerjaan Anda?\", \"other\": false, \"inline\": true, \"values\": [{\"label\": \"Sangat tidak cocok\", \"value\": \"1\", \"selected\": false}, {\"label\": \"Kurang cocok\", \"value\": \"2\", \"selected\": false}, {\"label\": \"Cocok\", \"value\": \"3\", \"selected\": false}, {\"label\": \"Sangat cocok\", \"value\": \"4\", \"selected\": false}], \"required\": true}, {\"name\": \"pengembangan_proses\", \"type\": \"radio-group\", \"label\": \"Seberapa relevan fasilitas dengan harga yang Anda bayar untuk pelatihan di SATUNAMA?\", \"other\": false, \"inline\": true, \"values\": [{\"label\": \"Sangat tidak relevan \", \"value\": \"1\", \"selected\": false}, {\"label\": \"Kurang relevan\", \"value\": \"2\", \"selected\": false}, {\"label\": \"Relevan\", \"value\": \"3\", \"selected\": false}, {\"label\": \"Sangat relevan\", \"value\": \"4\", \"selected\": false}], \"required\": true}, {\"name\": \"text-1712755105419-0\", \"type\": \"text\", \"label\": \"Hal penting apa yang Anda ambil dari mengikuti pelatihan di SATUNAMA?\", \"subtype\": \"text\", \"required\": true, \"className\": \"form-control\"}, {\"name\": \"text-1712755107411\", \"type\": \"text\", \"label\": \"Berapa kali Anda mengikuti Pelatihan di SATUNAMA?\", \"subtype\": \"text\", \"required\": true, \"className\": \"form-control\"}, {\"name\": \"text-1712755106955\", \"type\": \"text\", \"label\": \"Selain di SATUNAMA, apakah Anda pernah mengikuti pelatihan lainnya? Sebutkan lembaga/ instansinya.\", \"subtype\": \"text\", \"required\": true, \"className\": \"form-control\"}]', '2025-03-19 23:32:55', '2025-03-19 23:32:55');

-- --------------------------------------------------------

--
-- Table structure for table `form_surveykepuasan_permintaan`
--

CREATE TABLE `form_surveykepuasan_permintaan` (
  `id_form_surveykepuasan_permintaan` bigint(20) NOT NULL,
  `id_pelatihan_permintaan` bigint(20) NOT NULL,
  `content` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `form_surveykepuasan_permintaan`
--

INSERT INTO `form_surveykepuasan_permintaan` (`id_form_surveykepuasan_permintaan`, `id_pelatihan_permintaan`, `content`, `created_at`, `updated_at`) VALUES
(3, 4, '[{\"name\": \"tingkat_kepuasan\", \"type\": \"radio-group\", \"label\": \"Seberapa puas anda dengan pelatihan di SATUNAMA?\", \"other\": false, \"inline\": true, \"values\": [{\"label\": \"Sangat tidak puas\", \"value\": \"1\", \"selected\": false}, {\"label\": \"Cukup puas\", \"value\": \"2\", \"selected\": false}, {\"label\": \"Puas\", \"value\": \"3\", \"selected\": false}, {\"label\": \"Sangat puas\", \"value\": \"4\", \"selected\": false}], \"required\": true}, {\"name\": \"kemampuan_merespon_peserta\", \"type\": \"radio-group\", \"label\": \"Seberapa cocok dan membantu topik pelatihan yang Anda ikuti dengan pekerjaan Anda?\", \"other\": false, \"inline\": true, \"values\": [{\"label\": \"Sangat tidak cocok\", \"value\": \"1\", \"selected\": false}, {\"label\": \"Kurang cocok\", \"value\": \"2\", \"selected\": false}, {\"label\": \"Cocok\", \"value\": \"3\", \"selected\": false}, {\"label\": \"Sangat cocok\", \"value\": \"4\", \"selected\": false}], \"required\": true}, {\"name\": \"pengembangan_proses\", \"type\": \"radio-group\", \"label\": \"Seberapa relevan fasilitas dengan harga yang Anda bayar untuk pelatihan di SATUNAMA?\", \"other\": false, \"inline\": true, \"values\": [{\"label\": \"Sangat tidak relevan \", \"value\": \"1\", \"selected\": false}, {\"label\": \"Kurang relevan\", \"value\": \"2\", \"selected\": false}, {\"label\": \"Relevan\", \"value\": \"3\", \"selected\": false}, {\"label\": \"Sangat relevan\", \"value\": \"4\", \"selected\": false}], \"required\": true}, {\"name\": \"text-1712755105419-0\", \"type\": \"text\", \"label\": \"Hal penting apa yang Anda ambil dari mengikuti pelatihan di SATUNAMA?\", \"subtype\": \"text\", \"required\": true, \"className\": \"form-control\"}, {\"name\": \"text-1712755107411\", \"type\": \"text\", \"label\": \"Berapa kali Anda mengikuti Pelatihan di SATUNAMA?\", \"subtype\": \"text\", \"required\": true, \"className\": \"form-control\"}, {\"name\": \"text-1712755106955\", \"type\": \"text\", \"label\": \"Selain di SATUNAMA, apakah Anda pernah mengikuti pelatihan lainnya? Sebutkan lembaga/ instansinya.\", \"subtype\": \"text\", \"required\": true, \"className\": \"form-control\"}]', '2025-04-13 15:38:28', '2025-04-13 15:38:28');

-- --------------------------------------------------------

--
-- Table structure for table `form_surveykepuasan_reguler`
--

CREATE TABLE `form_surveykepuasan_reguler` (
  `id_form_surveykepuasan_reguler` bigint(20) NOT NULL,
  `id_reguler` bigint(20) NOT NULL,
  `content` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hasil_evaluasi_konsultasi`
--

CREATE TABLE `hasil_evaluasi_konsultasi` (
  `id_hasil_evaluasi_konsultasi` bigint(20) NOT NULL,
  `id_pelatihan_konsultasi` bigint(20) NOT NULL,
  `id_peserta` bigint(20) NOT NULL,
  `data_respons` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hasil_evaluasi_konsultasi`
--

INSERT INTO `hasil_evaluasi_konsultasi` (`id_hasil_evaluasi_konsultasi`, `id_pelatihan_konsultasi`, `id_peserta`, `data_respons`, `created_at`, `updated_at`) VALUES
(1, 2, 6, '{\"kontak\": \"tidak ada\", \"materi\": \"Sulit dipahami\", \"konsumsi\": \"4\", \"ruang_kelas\": \"5\", \"catatan_peserta\": \"tidak ada\", \"kecukupan_waktu\": \"4\", \"layanan_panitia\": \"5\", \"disiplin_peserta\": \"4\", \"manfaat_pelatihan\": \"tidak ada\", \"penguasaan_materi\": \"4\", \"catatan_fasilitator\": \"tidak ada\", \"keterbukaan_gagasan\": \"3\", \"partisipasi_peserta\": \"4\", \"pengembangan_proses\": \"4\", \"perbaikan_pelatihan\": \"tidak ada\", \"metode_yang_digunakan\": \"4\", \"rekomendasi_pelatihan\": \"Tidak\", \"kemampuan_menyerap_materi\": \"2\", \"pelatihan_yang_dibutuhkan\": \"tidak ada\", \"kemampuan_merespon_peserta\": \"3\", \"kemampuan_menyampaikan_materi\": \"3\"}', NULL, NULL),
(2, 2, 9, '{\"kontak\": \"tidak ada\", \"materi\": \"Sulit dipahami\", \"konsumsi\": \"4\", \"ruang_kelas\": \"5\", \"catatan_peserta\": \"tidak ada\", \"kecukupan_waktu\": \"4\", \"layanan_panitia\": \"5\", \"disiplin_peserta\": \"4\", \"manfaat_pelatihan\": \"tidak ada\", \"penguasaan_materi\": \"4\", \"catatan_fasilitator\": \"tidak ada\", \"keterbukaan_gagasan\": \"3\", \"partisipasi_peserta\": \"4\", \"pengembangan_proses\": \"4\", \"perbaikan_pelatihan\": \"tidak ada\", \"metode_yang_digunakan\": \"4\", \"rekomendasi_pelatihan\": \"Tidak\", \"kemampuan_menyerap_materi\": \"2\", \"pelatihan_yang_dibutuhkan\": \"tidak ada\", \"kemampuan_merespon_peserta\": \"3\", \"kemampuan_menyampaikan_materi\": \"3\"}', NULL, NULL),
(3, 2, 9, '{\"kontak\": \"-\", \"materi\": \"Sulit dipahami\", \"konsumsi\": \"4\", \"ruang_kelas\": \"4\", \"catatan_peserta\": \"-\", \"kecukupan_waktu\": \"3\", \"layanan_panitia\": \"5\", \"disiplin_peserta\": \"3\", \"manfaat_pelatihan\": \"-\", \"penguasaan_materi\": \"4\", \"catatan_fasilitator\": \"-\", \"keterbukaan_gagasan\": \"4\", \"partisipasi_peserta\": \"3\", \"pengembangan_proses\": \"4\", \"perbaikan_pelatihan\": \"-\", \"metode_yang_digunakan\": \"2\", \"rekomendasi_pelatihan\": \"Tidak\", \"kemampuan_menyerap_materi\": \"4\", \"pelatihan_yang_dibutuhkan\": \"-\", \"kemampuan_merespon_peserta\": \"4\", \"kemampuan_menyampaikan_materi\": \"4\"}', '2025-03-24 20:06:20', '2025-03-24 20:06:20'),
(4, 2, 10, '{\"kontak\": \"-\", \"materi\": \"Sudah dipahami sebelumnya/ tidak ada hal baru\", \"konsumsi\": \"4\", \"ruang_kelas\": \"3\", \"catatan_peserta\": \"-\", \"kecukupan_waktu\": \"4\", \"layanan_panitia\": \"5\", \"disiplin_peserta\": \"4\", \"manfaat_pelatihan\": \"-\", \"penguasaan_materi\": \"3\", \"catatan_fasilitator\": \"-\", \"keterbukaan_gagasan\": \"4\", \"partisipasi_peserta\": \"3\", \"pengembangan_proses\": \"4\", \"perbaikan_pelatihan\": \"-\", \"metode_yang_digunakan\": \"4\", \"rekomendasi_pelatihan\": \"Tidak\", \"kemampuan_menyerap_materi\": \"3\", \"pelatihan_yang_dibutuhkan\": \"-\", \"kemampuan_merespon_peserta\": \"3\", \"kemampuan_menyampaikan_materi\": \"4\"}', '2025-03-28 22:41:57', '2025-03-28 22:41:57');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_evaluasi_permintaan`
--

CREATE TABLE `hasil_evaluasi_permintaan` (
  `id_hasil_evaluasi_permintaan` bigint(20) NOT NULL,
  `id_pelatihan_permintaan` bigint(20) NOT NULL,
  `id_peserta` bigint(20) NOT NULL,
  `data_respons` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hasil_evaluasi_reguler`
--

CREATE TABLE `hasil_evaluasi_reguler` (
  `id_hasil_evaluasi_reguler` bigint(20) NOT NULL,
  `id_pelatihan_reguler` bigint(20) NOT NULL,
  `id_peserta` bigint(20) NOT NULL,
  `data_respons` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hasil_studidampak_konsultasi`
--

CREATE TABLE `hasil_studidampak_konsultasi` (
  `id_hasil_studidampak_konsultasi` bigint(20) NOT NULL,
  `id_pelatihan_konsultasi` bigint(20) NOT NULL,
  `id_peserta` bigint(20) NOT NULL,
  `data_respons` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hasil_studidampak_konsultasi`
--

INSERT INTO `hasil_studidampak_konsultasi` (`id_hasil_studidampak_konsultasi`, `id_pelatihan_konsultasi`, `id_peserta`, `data_respons`, `created_at`, `updated_at`) VALUES
(1, 2, 8, '{\"text-1712755106955\": \"tidak ada\", \"text-1712755107411\": \"manajemen\", \"text-1712930169882\": \"tidak ada perubahan\", \"text-1712930405787\": \"tidak ada\", \"text-1712930416026\": \"tidak ada \", \"text-1712930431010\": \"tidak\", \"text-1712930448250\": \"tidak ada\", \"text-1712755105419-0\": \"-\", \"radio-group-1712923959383-0\": \"Ya\"}', '2025-03-25 19:03:11', '2025-03-25 19:03:11'),
(2, 2, 6, '{\"text-1712755106955\": \"tidak ada\", \"text-1712755107411\": \"-\", \"text-1712930169882\": \"-\", \"text-1712930405787\": \"-\", \"text-1712930416026\": \"-\", \"text-1712930431010\": \"-\", \"text-1712930448250\": \"-\", \"text-1712755105419-0\": \"-\", \"radio-group-1712923959383-0\": \"Tidak\"}', '2025-03-29 10:11:35', '2025-03-29 10:11:35'),
(3, 2, 10, '{\"text-1712755106955\": \"tidak ada\", \"text-1712755107411\": \"tidak\", \"text-1712930169882\": \"tidak\", \"text-1712930405787\": \"tidak\", \"text-1712930416026\": \"tidak\", \"text-1712930431010\": \"tidak\", \"text-1712930448250\": \"tidak\", \"text-1712755105419-0\": \"tidak ada\", \"radio-group-1712923959383-0\": \"Ya\"}', '2025-04-10 23:00:06', '2025-04-10 23:00:06');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_studidampak_permintaan`
--

CREATE TABLE `hasil_studidampak_permintaan` (
  `id_hasil_studidampak_permintaan` bigint(20) NOT NULL,
  `id_pelatihan_permintaan` bigint(20) NOT NULL,
  `id_peserta` bigint(20) NOT NULL,
  `data_respons` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hasil_studidampak_reguler`
--

CREATE TABLE `hasil_studidampak_reguler` (
  `id_hasil_studidampak_reguler` bigint(20) NOT NULL,
  `id_pelatihan_reguler` bigint(20) NOT NULL,
  `id_peserta` bigint(20) NOT NULL,
  `data_respons` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hasil_surveykepuasan_konsultasi`
--

CREATE TABLE `hasil_surveykepuasan_konsultasi` (
  `id_hasil_surveykepuasan_konsultasi` bigint(20) NOT NULL,
  `id_pelatihan_konsultasi` bigint(20) NOT NULL,
  `id_peserta` bigint(20) NOT NULL,
  `data_respons` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hasil_surveykepuasan_konsultasi`
--

INSERT INTO `hasil_surveykepuasan_konsultasi` (`id_hasil_surveykepuasan_konsultasi`, `id_pelatihan_konsultasi`, `id_peserta`, `data_respons`, `created_at`, `updated_at`) VALUES
(1, 2, 9, '{\"id_negara\": \"1\", \"id_provinsi\": \"34\", \"id_kabupaten\": \"994\", \"tingkat_kepuasan\": \"2\", \"text-1712755106955\": \"-\", \"text-1712755107411\": \"8\", \"pengembangan_proses\": \"4\", \"text-1712755105419-0\": \"-\", \"kemampuan_merespon_peserta\": \"4\"}', '2025-03-25 17:59:16', '2025-03-25 17:59:16'),
(2, 2, 8, '{\"id_negara\": \"1\", \"id_provinsi\": \"34\", \"id_kabupaten\": \"1006\", \"tingkat_kepuasan\": \"2\", \"text-1712755106955\": \"-\", \"text-1712755107411\": \"7\", \"pengembangan_proses\": \"4\", \"text-1712755105419-0\": \"-\", \"kemampuan_merespon_peserta\": \"3\"}', '2025-03-25 18:09:37', '2025-03-25 18:09:37'),
(3, 2, 6, '{\"id_negara\": \"1\", \"id_provinsi\": \"34\", \"id_kabupaten\": \"993\", \"tingkat_kepuasan\": \"2\", \"text-1712755106955\": \"tidak ada\", \"text-1712755107411\": \"7\", \"pengembangan_proses\": \"4\", \"text-1712755105419-0\": \"-\", \"kemampuan_merespon_peserta\": \"3\"}', '2025-03-29 10:20:57', '2025-03-29 10:20:57');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_surveykepuasan_permintaan`
--

CREATE TABLE `hasil_surveykepuasan_permintaan` (
  `id_hasil_surveykepuasan_permintaan` bigint(20) NOT NULL,
  `id_pelatihan_permintaan` bigint(20) NOT NULL,
  `id_peserta` bigint(20) NOT NULL,
  `data_respons` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hasil_surveykepuasan_reguler`
--

CREATE TABLE `hasil_surveykepuasan_reguler` (
  `id_hasil_surveykepuasan_reguler` bigint(20) NOT NULL,
  `id_pelatihan_reguler` bigint(20) NOT NULL,
  `id_peserta` bigint(20) NOT NULL,
  `data_respons` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `internal_eksternals`
--

CREATE TABLE `internal_eksternals` (
  `id_internal_eksternal` bigint(20) NOT NULL,
  `internal_eksternal` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `internal_eksternals`
--

INSERT INTO `internal_eksternals` (`id_internal_eksternal`, `internal_eksternal`, `created_at`, `updated_at`) VALUES
(1, 'Internal', '2025-01-11 15:26:29', '2025-01-11 15:26:29'),
(2, 'Eksternal', '2025-01-11 15:26:29', '2025-01-11 15:26:29');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kabupaten_kota`
--

CREATE TABLE `kabupaten_kota` (
  `id` int(11) NOT NULL,
  `nama_kabupaten_kota` varchar(255) NOT NULL,
  `id_provinsi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kabupaten_kota`
--

INSERT INTO `kabupaten_kota` (`id`, `nama_kabupaten_kota`, `id_provinsi`) VALUES
(1, 'Aileu', 1),
(2, 'Ainaro', 2),
(3, 'Hotudo', 2),
(4, 'Maubisse', 2),
(5, 'Baguia', 3),
(7, 'Baucau', 3),
(8, 'Bucoli', 3),
(9, 'Quelicai', 3),
(10, 'Laga', 3),
(11, 'Macadai de Baixo', 3),
(12, 'Venilale', 3),
(13, 'Atabae', 4),
(14, 'Aubá', 4),
(15, 'Balibo', 4),
(16, 'Bobonaro', 4),
(17, 'Lolotoe', 4),
(18, 'Maliana', 4),
(19, 'Fatululik', 5),
(20, 'Fohoren', 5),
(21, 'Suai', 5),
(22, 'Tilomar', 5),
(23, 'Zumalai', 5),
(24, 'Dare', 6),
(25, 'Dili', 6),
(26, 'Metinaro', 6),
(27, 'Atsabe', 7),
(28, 'Ermera', 7),
(29, 'Gleno', 7),
(30, 'Hatolina', 7),
(31, 'Com', 8),
(32, 'Fuiloro', 8),
(33, 'Iliomar', 8),
(34, 'Laivai', 8),
(35, 'Lautém', 8),
(36, 'Lore', 8),
(37, 'Lospalos', 8),
(38, 'Luro', 8),
(39, 'Mehara', 8),
(40, 'Tutuala', 8),
(41, 'Bazartete', 9),
(42, 'Liquiçá', 9),
(43, 'Maubara', 9),
(44, 'Laclubar', 10),
(45, 'Laleia', 10),
(46, 'Manatuto', 10),
(47, 'Natarbora', 10),
(48, 'Alas', 11),
(49, 'Fato Berlia', 11),
(50, 'Same', 11),
(51, 'Turiscai', 11),
(52, 'Fato Berlia', 11),
(53, 'Citrana', 12),
(54, 'Nitibe', 12),
(55, 'Oe Silo', 12),
(56, 'Pante Macassar', 12),
(57, 'Passabe', 12),
(58, 'Beacu', 13),
(59, 'Lacluta', 13),
(60, 'Ossu', 13),
(61, 'Uatolari', 13),
(62, 'Viqueque', 13),
(63, 'Berau', 14),
(64, 'Biquele', 14),
(906, 'Banda Aceh', 15),
(907, 'Bireun', 15),
(908, 'Kabupaten Aceh Barat', 15),
(909, 'Kabupaten Aceh Barat Daya', 15),
(910, 'Kabupaten Aceh Besar', 15),
(911, 'Kabupaten Aceh Jaya', 15),
(912, 'Kabupaten Aceh Selatan', 15),
(913, 'Kabupaten Aceh Singkil', 15),
(914, 'Kabupaten Aceh Tamiang', 15),
(915, 'Kabupaten Aceh Tengah', 15),
(916, 'Kabupaten Aceh Tenggara', 15),
(917, 'Kabupaten Aceh Timur', 15),
(918, 'Kabupaten Aceh Utara', 15),
(919, 'Kabupaten Bener Meriah', 15),
(920, 'Kabupaten Bireuen', 15),
(921, 'Kabupaten Gayo Lues', 15),
(922, 'Kabupaten Nagan Raya', 15),
(923, 'Kabupaten Pidie', 15),
(924, 'Kabupaten Simeulue', 15),
(925, 'Kota Banda Aceh', 15),
(926, 'Kota Langsa', 15),
(927, 'Kota Lhokseumawe', 15),
(928, 'Kota Sabang', 15),
(929, 'Kota Subulussalam', 15),
(930, 'Langsa', 15),
(931, 'Lhokseumawe', 15),
(932, 'Meulaboh', 15),
(933, 'Reuleuet', 15),
(934, 'Sabang', 15),
(935, 'Sigli', 15),
(936, 'Sinabang', 15),
(937, 'Singkil', 15),
(938, 'Amlapura', 252),
(939, 'Amlapura city', 252),
(940, 'Banjar', 252),
(941, 'Banjar Wangsian', 252),
(942, 'Bedugul', 252),
(943, 'Denpasar', 252),
(944, 'Jimbaran', 252),
(945, 'Kabupaten Badung', 252),
(946, 'Kabupaten Bangli', 252),
(947, 'Kabupaten Buleleng', 252),
(948, 'Kabupaten Gianyar', 252),
(949, 'Kabupaten Jembrana', 252),
(950, 'Kabupaten Karang Asem', 252),
(951, 'Kabupaten Klungkung', 252),
(952, 'Kabupaten Tabanan', 252),
(953, 'Klungkung', 252),
(954, 'Kota Denpasar', 252),
(955, 'Kuta', 252),
(956, 'Legian', 252),
(957, 'Lovina', 252),
(958, 'Munduk', 252),
(959, 'Negara', 252),
(960, 'Nusa Dua', 252),
(961, 'Seririt', 252),
(962, 'Singaraja', 252),
(963, 'Tabanan', 252),
(964, 'Ubud', 252),
(965, 'Curug', 271),
(966, 'Kabupaten Lebak', 271),
(967, 'Kabupaten Pandeglang', 271),
(968, 'Kabupaten Serang', 271),
(969, 'Kabupaten Tangerang', 271),
(970, 'Kota Cilegon', 271),
(971, 'Kota Serang', 271),
(972, 'Kota Tangerang', 271),
(973, 'Kota Tangerang Selatan', 271),
(974, 'Labuan', 271),
(975, 'Pandeglang', 271),
(976, 'Rangkasbitung', 271),
(977, 'Serang', 271),
(978, 'South Tangerang', 271),
(979, 'Tangerang', 271),
(980, 'Bengkulu', 325),
(981, 'Curup', 325),
(982, 'Kabupaten Bengkulu Selatan', 325),
(983, 'Kabupaten Bengkulu Tengah', 325),
(984, 'Kabupaten Bengkulu Utara', 325),
(985, 'Kabupaten Kaur', 325),
(986, 'Kabupaten Kepahiang', 325),
(987, 'Kabupaten Lebong', 325),
(988, 'Kabupaten Mukomuko', 325),
(989, 'Kabupaten Rejang Lebong', 325),
(990, 'Kabupaten Seluma', 325),
(991, 'Kota Bengkulu', 325),
(992, 'Bambanglipuro', 34),
(993, 'Bantul', 34),
(994, 'Depok', 34),
(995, 'Gamping Lor', 34),
(996, 'Godean', 34),
(997, 'Kabupaten Bantul', 34),
(998, 'Kabupaten Gunung Kidul', 34),
(999, 'Kabupaten Kulon Progo', 34),
(1000, 'Kabupaten Sleman', 34),
(1001, 'Kasihan', 34),
(1002, 'Kota Yogyakarta', 34),
(1003, 'Melati', 34),
(1004, 'Pandak', 34),
(1005, 'Pundong', 34),
(1006, 'Sewon', 34),
(1007, 'Sleman', 34),
(1008, 'Srandakan', 34),
(1009, 'Yogyakarta', 34),
(1010, 'Jakarta', 708),
(1011, 'Kota Administrasi Jakarta Barat', 708),
(1012, 'Kota Administrasi Jakarta Pusat', 708),
(1013, 'Kota Administrasi Jakarta Selatan', 708),
(1014, 'Kota Administrasi Jakarta Timur', 708),
(1015, 'Kota Administrasi Jakarta Utara', 708),
(1016, 'Gorontalo', 988),
(1017, 'Kabupaten Boalemo', 988),
(1018, 'Kabupaten Bone Bolango', 988),
(1019, 'Kabupaten Gorontalo', 988),
(1020, 'Kabupaten Gorontalo Utara', 988),
(1021, 'Kabupaten Pohuwato', 988),
(1022, 'Kota Gorontalo', 988),
(1023, 'Bejubang Dua', 1224),
(1024, 'Jambi City', 1224),
(1025, 'Kabupaten Batang Hari', 1224),
(1026, 'Kabupaten Bungo', 1224),
(1027, 'Kabupaten Kerinci', 1224),
(1028, 'Kabupaten Merangin', 1224),
(1029, 'Kabupaten Muaro Jambi', 1224),
(1030, 'Kabupaten Sarolangun', 1224),
(1031, 'Kabupaten Tanjung Jabung Barat', 1224),
(1032, 'Kabupaten Tanjung Jabung Timur', 1224),
(1033, 'Kabupaten Tebo', 1224),
(1034, 'Kota Jambi', 1224),
(1035, 'Kota Sungai Penuh', 1224),
(1036, 'Kuala Tungkal', 1224),
(1037, 'Mendaha', 1224),
(1038, 'Simpang', 1224),
(1039, 'Sungai Penuh', 1224),
(1040, 'Arjawinangun', 1229),
(1041, 'Astanajapura', 1229),
(1042, 'Bandung', 1229),
(1043, 'Banjar', 1229),
(1044, 'Banjaran', 1229),
(1045, 'Bekasi', 1229),
(1046, 'Bogor', 1229),
(1047, 'Caringin', 1229),
(1048, 'Ciamis', 1229),
(1049, 'Ciampea', 1229),
(1050, 'Cibinong', 1229),
(1051, 'Cicurug', 1229),
(1052, 'Cikampek', 1229),
(1053, 'Cikarang', 1229),
(1054, 'Cikupa', 1229),
(1055, 'Cileungsir', 1229),
(1056, 'Cileunyi', 1229),
(1057, 'Cimahi', 1229),
(1058, 'Ciputat', 1229),
(1059, 'Ciranjang-hilir', 1229),
(1060, 'Cirebon', 1229),
(1061, 'Citeureup', 1229),
(1062, 'Depok', 1229),
(1063, 'Indramayu', 1229),
(1064, 'Jatibarang', 1229),
(1065, 'Jatiwangi', 1229),
(1066, 'Kabupaten Bandung', 1229),
(1067, 'Kabupaten Bandung Barat', 1229),
(1068, 'Kabupaten Bekasi', 1229),
(1069, 'Kabupaten Bogor', 1229),
(1070, 'Kabupaten Ciamis', 1229),
(1071, 'Kabupaten Cianjur', 1229),
(1072, 'Kabupaten Cirebon', 1229),
(1073, 'Kabupaten Garut', 1229),
(1074, 'Kabupaten Indramayu', 1229),
(1075, 'Kabupaten Karawang', 1229),
(1076, 'Kabupaten Kuningan', 1229),
(1077, 'Kabupaten Majalengka', 1229),
(1078, 'Kabupaten Pangandaran', 1229),
(1079, 'Kabupaten Purwakarta', 1229),
(1080, 'Kabupaten Subang', 1229),
(1081, 'Kabupaten Sukabumi', 1229),
(1082, 'Kabupaten Sumedang', 1229),
(1083, 'Kabupaten Tasikmalaya', 1229),
(1084, 'Karangampel', 1229),
(1085, 'Karangsembung', 1229),
(1086, 'Kawalu', 1229),
(1087, 'Klangenan', 1229),
(1088, 'Kota Bandung', 1229),
(1089, 'Kota Banjar', 1229),
(1090, 'Kota Bekasi', 1229),
(1091, 'Kota Bogor', 1229),
(1092, 'Kota Cimahi', 1229),
(1093, 'Kota Cirebon', 1229),
(1094, 'Kota Depok', 1229),
(1095, 'Kota Sukabumi', 1229),
(1096, 'Kota Tasikmalaya', 1229),
(1097, 'Kresek', 1229),
(1098, 'Kuningan', 1229),
(1099, 'Lembang', 1229),
(1100, 'Majalengka', 1229),
(1101, 'Margahayukencana', 1229),
(1102, 'Ngawi', 1229),
(1103, 'Padalarang', 1229),
(1104, 'Palimanan', 1229),
(1105, 'Pamanukan', 1229),
(1106, 'Pameungpeuk', 1229),
(1107, 'Pamulang', 1229),
(1108, 'Parung', 1229),
(1109, 'Pasarkemis', 1229),
(1110, 'Paseh', 1229),
(1111, 'Pelabuhanratu', 1229),
(1112, 'Plumbon', 1229),
(1113, 'Purwakarta', 1229),
(1114, 'Rajapolah', 1229),
(1115, 'Rengasdengklok', 1229),
(1116, 'Sawangan', 1229),
(1117, 'Sepatan', 1229),
(1118, 'Serpong', 1229),
(1119, 'Singaparna', 1229),
(1120, 'Soreang', 1229),
(1121, 'Sukabumi', 1229),
(1122, 'Sumber', 1229),
(1123, 'Sumedang', 1229),
(1124, 'Sumedang Utara', 1229),
(1125, 'Tasikmalaya', 1229),
(1126, 'Teluknaga', 1229),
(1127, 'Wanaraja', 1229),
(1128, 'Weru', 1229),
(1129, 'Adiwerna', 1230),
(1130, 'Ambarawa', 1230),
(1131, 'Baekrajan', 1230),
(1132, 'Baki', 1230),
(1133, 'Balapulang', 1230),
(1134, 'Banyumas', 1230),
(1135, 'Batang', 1230),
(1136, 'Baturaden', 1230),
(1137, 'Blora', 1230),
(1138, 'Boyolali', 1230),
(1139, 'Buaran', 1230),
(1140, 'Bulakamba', 1230),
(1141, 'Candi Prambanan', 1230),
(1142, 'Ceper', 1230),
(1143, 'Cepu', 1230),
(1144, 'Colomadu', 1230),
(1145, 'Comal', 1230),
(1146, 'Delanggu', 1230),
(1147, 'Demak', 1230),
(1148, 'Dukuhturi', 1230),
(1149, 'Gatak', 1230),
(1150, 'Gebog', 1230),
(1151, 'Gombong', 1230),
(1152, 'Grogol', 1230),
(1153, 'Gunung Kendil', 1230),
(1154, 'Jaten', 1230),
(1155, 'Jatiroto', 1230),
(1156, 'Jekulo', 1230),
(1157, 'Jogonalan', 1230),
(1158, 'Juwana', 1230),
(1159, 'Kabupaten Banjarnegara', 1230),
(1160, 'Kabupaten Banyumas', 1230),
(1161, 'Kabupaten Batang', 1230),
(1162, 'Kabupaten Blora', 1230),
(1163, 'Kabupaten Boyolali', 1230),
(1164, 'Kabupaten Brebes', 1230),
(1165, 'Kabupaten Cilacap', 1230),
(1166, 'Kabupaten Demak', 1230),
(1167, 'Kabupaten Grobogan', 1230),
(1168, 'Kabupaten Jepara', 1230),
(1169, 'Kabupaten Karanganyar', 1230),
(1170, 'Kabupaten Kebumen', 1230),
(1171, 'Kabupaten Kendal', 1230),
(1172, 'Kabupaten Klaten', 1230),
(1173, 'Kabupaten Kudus', 1230),
(1174, 'Kabupaten Magelang', 1230),
(1175, 'Kabupaten Pati', 1230),
(1176, 'Kabupaten Pekalongan', 1230),
(1177, 'Kabupaten Pemalang', 1230),
(1178, 'Kabupaten Purbalingga', 1230),
(1179, 'Kabupaten Purworejo', 1230),
(1180, 'Kabupaten Rembang', 1230),
(1181, 'Kabupaten Semarang', 1230),
(1182, 'Kabupaten Sragen', 1230),
(1183, 'Kabupaten Sukoharjo', 1230),
(1184, 'Kabupaten Tegal', 1230),
(1185, 'Kabupaten Temanggung', 1230),
(1186, 'Kabupaten Wonogiri', 1230),
(1187, 'Kabupaten Wonosobo', 1230),
(1188, 'Karanganom', 1230),
(1189, 'Kartasura', 1230),
(1190, 'Kebonarun', 1230),
(1191, 'Kedungwuni', 1230),
(1192, 'Ketanggungan', 1230),
(1193, 'Klaten', 1230),
(1194, 'Kota Magelang', 1230),
(1195, 'Kota Pekalongan', 1230),
(1196, 'Kota Salatiga', 1230),
(1197, 'Kota Semarang', 1230),
(1198, 'Kota Surakarta', 1230),
(1199, 'Kota Tegal', 1230),
(1200, 'Kroya', 1230),
(1201, 'Kudus', 1230),
(1202, 'Kutoarjo', 1230),
(1203, 'Lasem', 1230),
(1204, 'Lebaksiu', 1230),
(1205, 'Magelang', 1230),
(1206, 'Majenang', 1230),
(1207, 'Margasari', 1230),
(1208, 'Mertoyudan', 1230),
(1209, 'Mlonggo', 1230),
(1210, 'Mranggen', 1230),
(1211, 'Muntilan', 1230),
(1212, 'Ngemplak', 1230),
(1213, 'Pati', 1230),
(1214, 'Pecangaan', 1230),
(1215, 'Pekalongan', 1230),
(1216, 'Pemalang', 1230),
(1217, 'Purbalingga', 1230),
(1218, 'Purwodadi', 1230),
(1219, 'Purwokerto', 1230),
(1220, 'Randudongkal', 1230),
(1221, 'Rembangan', 1230),
(1222, 'Salatiga', 1230),
(1223, 'Selogiri', 1230),
(1224, 'Semarang', 1230),
(1225, 'Sidareja', 1230),
(1226, 'Slawi', 1230),
(1227, 'Sokaraja', 1230),
(1228, 'Sragen', 1230),
(1229, 'Surakarta', 1230),
(1230, 'Tarub', 1230),
(1231, 'Tayu', 1230),
(1232, 'Tegal', 1230),
(1233, 'Trucuk', 1230),
(1234, 'Ungaran', 1230),
(1235, 'Wangon', 1230),
(1236, 'Wedi', 1230),
(1237, 'Welahan', 1230),
(1238, 'Weleri', 1230),
(1239, 'Wiradesa', 1230),
(1240, 'Wonopringgo', 1230),
(1241, 'Wonosobo', 1230),
(1242, 'Babat', 1231),
(1243, 'Balung', 1231),
(1244, 'Bangil', 1231),
(1245, 'Bangkalan', 1231),
(1246, 'Banyuwangi', 1231),
(1247, 'Batu', 1231),
(1248, 'Besuki', 1231),
(1249, 'Blitar', 1231),
(1250, 'Bojonegoro', 1231),
(1251, 'Bondowoso', 1231),
(1252, 'Boyolangu', 1231),
(1253, 'Buduran', 1231),
(1254, 'Dampit', 1231),
(1255, 'Diwek', 1231),
(1256, 'Driyorejo', 1231),
(1257, 'Gambiran Satu', 1231),
(1258, 'Gampengrejo', 1231),
(1259, 'Gedangan', 1231),
(1260, 'Genteng', 1231),
(1261, 'Gongdanglegi Kulon', 1231),
(1262, 'Gresik', 1231),
(1263, 'Gresik Regency', 1231),
(1264, 'Jember', 1231),
(1265, 'Jombang', 1231),
(1266, 'Kabupaten Bangkalan', 1231),
(1267, 'Kabupaten Banyuwangi', 1231),
(1268, 'Kabupaten Blitar', 1231),
(1269, 'Kabupaten Bojonegoro', 1231),
(1270, 'Kabupaten Bondowoso', 1231),
(1271, 'Kabupaten Jember', 1231),
(1272, 'Kabupaten Jombang', 1231),
(1273, 'Kabupaten Kediri', 1231),
(1274, 'Kabupaten Lamongan', 1231),
(1275, 'Kabupaten Lumajang', 1231),
(1276, 'Kabupaten Madiun', 1231),
(1277, 'Kabupaten Magetan', 1231),
(1278, 'Kabupaten Malang', 1231),
(1279, 'Kabupaten Mojokerto', 1231),
(1280, 'Kabupaten Nganjuk', 1231),
(1281, 'Kabupaten Ngawi', 1231),
(1282, 'Kabupaten Pacitan', 1231),
(1283, 'Kabupaten Pamekasan', 1231),
(1284, 'Kabupaten Pasuruan', 1231),
(1285, 'Kabupaten Ponorogo', 1231),
(1286, 'Kabupaten Probolinggo', 1231),
(1287, 'Kabupaten Sampang', 1231),
(1288, 'Kabupaten Sidoarjo', 1231),
(1289, 'Kabupaten Situbondo', 1231),
(1290, 'Kabupaten Sumenep', 1231),
(1291, 'Kabupaten Trenggalek', 1231),
(1292, 'Kabupaten Tuban', 1231),
(1293, 'Kabupaten Tulungagung', 1231),
(1294, 'Kalianget', 1231),
(1295, 'Kamal', 1231),
(1296, 'Kebomas', 1231),
(1297, 'Kediri', 1231),
(1298, 'Kedungwaru', 1231),
(1299, 'Kencong', 1231),
(1300, 'Kepanjen', 1231),
(1301, 'Kertosono', 1231),
(1302, 'Kota Batu', 1231),
(1303, 'Kota Blitar', 1231),
(1304, 'Kota Kediri', 1231),
(1305, 'Kota Madiun', 1231),
(1306, 'Kota Malang', 1231),
(1307, 'Kota Mojokerto', 1231),
(1308, 'Kota Pasuruan', 1231),
(1309, 'Kota Probolinggo', 1231),
(1310, 'Kota Surabaya', 1231),
(1311, 'Kraksaan', 1231),
(1312, 'Krian', 1231),
(1313, 'Lamongan', 1231),
(1314, 'Lawang', 1231),
(1315, 'Lumajang', 1231),
(1316, 'Madiun', 1231),
(1317, 'Malang', 1231),
(1318, 'Mojoagung', 1231),
(1319, 'Mojokerto', 1231),
(1320, 'Muncar', 1231),
(1321, 'Nganjuk', 1231),
(1322, 'Ngoro', 1231),
(1323, 'Ngunut', 1231),
(1324, 'Paciran', 1231),
(1325, 'Pakisaji', 1231),
(1326, 'Pamekasan', 1231),
(1327, 'Panarukan', 1231),
(1328, 'Pandaan', 1231),
(1329, 'Panji', 1231),
(1330, 'Pare', 1231),
(1331, 'Pasuruan', 1231),
(1332, 'Ponorogo', 1231),
(1333, 'Prigen', 1231),
(1334, 'Probolinggo', 1231),
(1335, 'Sampang', 1231),
(1336, 'Sidoarjo', 1231),
(1337, 'Singojuruh', 1231),
(1338, 'Singosari', 1231),
(1339, 'Situbondo', 1231),
(1340, 'Soko', 1231),
(1341, 'Srono', 1231),
(1342, 'Sumberpucung', 1231),
(1343, 'Sumenep', 1231),
(1344, 'Surabaya', 1231),
(1345, 'Tanggul', 1231),
(1346, 'Tanggulangin', 1231),
(1347, 'Trenggalek', 1231),
(1348, 'Tuban', 1231),
(1349, 'Tulangan Utara', 1231),
(1350, 'Tulungagung', 1231),
(1351, 'Wongsorejo', 1231),
(1352, 'Bengkayang', 61),
(1353, 'Kapuas Hulu', 61),
(1354, 'Kayong Utara', 61),
(1355, 'Ketapang', 61),
(1356, 'Kubu Raya', 61),
(1357, 'Landak', 61),
(1358, 'Manismata', 61),
(1359, 'Melawi', 61),
(1360, 'Mempawah', 61),
(1361, 'Pemangkat', 61),
(1362, 'Pontianak', 61),
(1363, 'Sambas', 61),
(1364, 'Sanggau', 61),
(1365, 'Sekadau', 61),
(1366, 'Singkawang', 61),
(1367, 'Sintang', 61),
(1368, 'Amuntai', 1288),
(1369, 'Banjarmasin', 1288),
(1370, 'Barabai', 1288),
(1371, 'Kabupaten Balangan', 1288),
(1372, 'Kabupaten Banjar', 1288),
(1373, 'Kabupaten Barito Kuala', 1288),
(1374, 'Kabupaten Hulu Sungai Selatan', 1288),
(1375, 'Kabupaten Hulu Sungai Tengah', 1288),
(1376, 'Kabupaten Hulu Sungai Utara', 1288),
(1377, 'Kabupaten Kota Baru', 1288),
(1378, 'Kabupaten Tabalong', 1288),
(1379, 'Kabupaten Tanah Bumbu', 1288),
(1380, 'Kabupaten Tanah Laut', 1288),
(1381, 'Kabupaten Tapin', 1288),
(1382, 'Kota Banjar Baru', 1288),
(1383, 'Kota Banjarmasin', 1288),
(1384, 'Martapura', 1288),
(1385, 'Kabupaten Barito Selatan', 62),
(1386, 'Kabupaten Barito Timur', 62),
(1387, 'Kabupaten Barito Utara', 62),
(1388, 'Kabupaten Gunung Mas', 62),
(1389, 'Kabupaten Kapuas', 62),
(1390, 'Kabupaten Katingan', 62),
(1391, 'Kabupaten Kotawaringin Barat', 62),
(1392, 'Kabupaten Kotawaringin Timur', 62),
(1393, 'Kabupaten Lamandau', 62),
(1394, 'Kabupaten Murung Raya', 62),
(1395, 'Kabupaten Pulang Pisau', 62),
(1396, 'Kabupaten Seruyan', 62),
(1397, 'Kabupaten Sukamara', 62),
(1398, 'Kota Palangka Raya', 62),
(1399, 'Kualakapuas', 62),
(1400, 'Palangkaraya', 62),
(1401, 'Pangkalanbuun', 62),
(1402, 'Sampit', 62),
(1403, 'Balikpapan', 1290),
(1404, 'Bontang', 1290),
(1405, 'City of Balikpapan', 1290),
(1406, 'Kabupaten Berau', 1290),
(1407, 'Kabupaten Kutai Barat', 1290),
(1408, 'Kabupaten Kutai Kartanegara', 1290),
(1409, 'Kabupaten Kutai Timur', 1290),
(1410, 'Kabupaten Mahakam Hulu', 1290),
(1411, 'Kabupaten Paser', 1290),
(1412, 'Kabupaten Penajam Paser Utara', 1290),
(1413, 'Kota Balikpapan', 1290),
(1414, 'Kota Bontang', 1290),
(1415, 'Kota Samarinda', 1290),
(1416, 'Loa Janan', 1290),
(1417, 'Samarinda', 1290),
(1418, 'Kabupaten Bulungan', 1291),
(1419, 'Kabupaten Malinau', 1291),
(1420, 'Kabupaten Nunukan', 1291),
(1421, 'Kabupaten Tana Tidung', 1291),
(1422, 'Tanjung Selor', 1291),
(1423, 'Tarakan', 1291),
(1424, 'Kabupaten Bangka', 1360),
(1425, 'Kabupaten Bangka Barat', 1360),
(1426, 'Kabupaten Bangka Selatan', 1360),
(1427, 'Kabupaten Bangka Tengah', 1360),
(1428, 'Kabupaten Belitung', 1360),
(1429, 'Kabupaten Belitung Timur', 1360),
(1430, 'Kota Pangkal Pinang', 1360),
(1431, 'Manggar', 1360),
(1432, 'Muntok', 1360),
(1433, 'Pangkalpinang', 1360),
(1434, 'Sungailiat', 1360),
(1435, 'Tanjung Pandan', 1360),
(1436, 'Kabupaten Bintan', 1361),
(1437, 'Kabupaten Karimun', 1361),
(1438, 'Kabupaten Kepulauan Anambas', 1361),
(1439, 'Kabupaten Lingga', 1361),
(1440, 'Kabupaten Natuna', 1361),
(1441, 'Kijang', 1361),
(1442, 'Kota Batam', 1361),
(1443, 'Kota Tanjung Pinang', 1361),
(1444, 'Tanjung Pinang', 1361),
(1445, 'Bandar Lampung', 1542),
(1446, 'Kabupaten Lampung Barat', 1542),
(1447, 'Kabupaten Lampung Selatan', 1542),
(1448, 'Kabupaten Lampung Tengah', 1542),
(1449, 'Kabupaten Lampung Timur', 1542),
(1450, 'Kabupaten Lampung Utara', 1542),
(1451, 'Kabupaten Mesuji', 1542),
(1452, 'Kabupaten Pesawaran', 1542),
(1453, 'Kabupaten Pesisir Barat', 1542),
(1454, 'Kabupaten Pringsewu', 1542),
(1455, 'Kabupaten Tanggamus', 1542),
(1456, 'Kabupaten Tulangbawang', 1542),
(1457, 'Kabupaten Way Kanan', 1542),
(1458, 'Kota Bandar Lampung', 1542),
(1459, 'Kota Metro', 1542),
(1460, 'Kotabumi', 1542),
(1461, 'Metro', 1542),
(1462, 'Terbanggi Besar', 1542),
(1463, 'Amahai', 1703),
(1464, 'Ambon', 1703),
(1465, 'Kabupaten Buru', 1703),
(1466, 'Kabupaten Buru Selatan', 1703),
(1467, 'Kabupaten Kepulauan Aru', 1703),
(1468, 'Kabupaten Maluku Barat Daya', 1703),
(1469, 'Kabupaten Maluku Tengah', 1703),
(1470, 'Kabupaten Maluku Tenggara', 1703),
(1471, 'Kabupaten Maluku Tenggara Barat', 1703),
(1472, 'Kabupaten Seram Bagian Barat', 1703),
(1473, 'Kabupaten Seram Bagian Timur', 1703),
(1474, 'Kota Ambon', 1703),
(1475, 'Kota Tual', 1703),
(1476, 'Tual', 1703),
(1477, 'East Halmahera Regency', 1704),
(1478, 'Kabupaten Halmahera Barat', 1704),
(1479, 'Kabupaten Halmahera Selatan', 1704),
(1480, 'Kabupaten Halmahera Tengah', 1704),
(1481, 'Kabupaten Halmahera Utara', 1704),
(1482, 'Kabupaten Kepulauan Sula', 1704),
(1483, 'Kabupaten Pulau Morotai', 1704),
(1484, 'Kabupaten Pulau Taliabu', 1704),
(1485, 'Kota Ternate', 1704),
(1486, 'Kota Tidore Kepulauan', 1704),
(1487, 'Sofifi', 1704),
(1488, 'Ternate', 1704),
(1489, 'Tobelo', 1704),
(1490, 'Bima', 2096),
(1491, 'Dompu', 2096),
(1492, 'Gili Air', 2096),
(1493, 'Kabupaten Bima', 2096),
(1494, 'Kabupaten Dompu', 2096),
(1495, 'Kabupaten Lombok Barat', 2096),
(1496, 'Kabupaten Lombok Tengah', 2096),
(1497, 'Kabupaten Lombok Timur', 2096),
(1498, 'Kabupaten Lombok Utara', 2096),
(1499, 'Kabupaten Sumbawa', 2096),
(1500, 'Kabupaten Sumbawa Barat', 2096),
(1501, 'Kota Bima', 2096),
(1502, 'Kota Mataram', 2096),
(1503, 'Labuan Lombok', 2096),
(1504, 'Lembar', 2096),
(1505, 'Mataram', 2096),
(1506, 'Pemenang', 2096),
(1507, 'Pototano', 2096),
(1508, 'Praya', 2096),
(1509, 'Senggigi', 2096),
(1510, 'Sumbawa Besar', 2096),
(1511, 'Atambua', 2097),
(1512, 'Ende', 2097),
(1513, 'Kabupaten Alor', 2097),
(1514, 'Kabupaten Belu', 2097),
(1515, 'Kabupaten Ende', 2097),
(1516, 'Kabupaten Flores Timur', 2097),
(1517, 'Kabupaten Kupang', 2097),
(1518, 'Kabupaten Lembata', 2097),
(1519, 'Kabupaten Malaka', 2097),
(1520, 'Kabupaten Manggarai', 2097),
(1521, 'Kabupaten Manggarai Barat', 2097),
(1522, 'Kabupaten Manggarai Timur', 2097),
(1523, 'Kabupaten Nagekeo', 2097),
(1524, 'Kabupaten Ngada', 2097),
(1525, 'Kabupaten Rote Ndao', 2097),
(1526, 'Kabupaten Sabu Raijua', 2097),
(1527, 'Kabupaten Sikka', 2097),
(1528, 'Kabupaten Sumba Barat', 2097),
(1529, 'Kabupaten Sumba Barat Daya', 2097),
(1530, 'Kabupaten Sumba Tengah', 2097),
(1531, 'Kabupaten Sumba Timur', 2097),
(1532, 'Kabupaten Timor Tengah Selatan', 2097),
(1533, 'Kabupaten Timor Tengah Utara', 2097),
(1534, 'Kefamenanu', 2097),
(1535, 'Komodo', 2097),
(1536, 'Kota Kupang', 2097),
(1537, 'Kupang', 2097),
(1538, 'Labuan Bajo', 2097),
(1539, 'Maumere', 2097),
(1540, 'Naisano Dua', 2097),
(1541, 'Ruteng', 2097),
(1542, 'Soe', 2097),
(1543, 'Waingapu', 2097),
(1544, 'Abepura', 2198),
(1545, 'Biak', 2198),
(1546, 'Insrom', 2198),
(1547, 'Jayapura', 2198),
(1548, 'Kabupaten Asmat', 2198),
(1549, 'Kabupaten Biak Numfor', 2198),
(1550, 'Kabupaten Boven Digoel', 2198),
(1551, 'Kabupaten Deiyai', 2198),
(1552, 'Kabupaten Dogiyai', 2198),
(1553, 'Kabupaten Intan Jaya', 2198),
(1554, 'Kabupaten Jayapura', 2198),
(1555, 'Kabupaten Jayawijaya', 2198),
(1556, 'Kabupaten Keerom', 2198),
(1557, 'Kabupaten Kepulauan Yapen', 2198),
(1558, 'Kabupaten Lanny Jaya', 2198),
(1559, 'Kabupaten Mamberamo Raya', 2198),
(1560, 'Kabupaten Mamberamo Tengah', 2198),
(1561, 'Kabupaten Mappi', 2198),
(1562, 'Kabupaten Merauke', 2198),
(1563, 'Kabupaten Mimika', 2198),
(1564, 'Kabupaten Nabire', 2198),
(1565, 'Kabupaten Nduga', 2198),
(1566, 'Kabupaten Paniai', 2198),
(1567, 'Kabupaten Pegunungan Bintang', 2198),
(1568, 'Kabupaten Puncak Jaya', 2198),
(1569, 'Kabupaten Sarmi', 2198),
(1570, 'Kabupaten Supiori', 2198),
(1571, 'Kabupaten Tolikara', 2198),
(1572, 'Kabupaten Waropen', 2198),
(1573, 'Kabupaten Yahukimo', 2198),
(1574, 'Kabupaten Yalimo', 2198),
(1575, 'Kota Jayapura', 2198),
(1576, 'Nabire', 2198),
(1577, 'Kabupaten Fakfak', 2199),
(1578, 'Kabupaten Kaimana', 2199),
(1579, 'Kabupaten Manokwari', 2199),
(1580, 'Kabupaten Manokwari Selatan', 2199),
(1581, 'Kabupaten Maybrat', 2199),
(1582, 'Kabupaten Raja Ampat', 2199),
(1583, 'Kabupaten Sorong', 2199),
(1584, 'Kabupaten Sorong Selatan', 2199),
(1585, 'Kabupaten Tambrauw', 2199),
(1586, 'Kabupaten Teluk Bintuni', 2199),
(1587, 'Kabupaten Teluk Wondama', 2199),
(1588, 'Kota Sorong', 2199),
(1589, 'Manokwari', 2199),
(1590, 'Sorong', 2199),
(1591, 'Balaipungut', 2437),
(1592, 'Batam', 2437),
(1593, 'Dumai', 2437),
(1594, 'Kabupaten Bengkalis', 2437),
(1595, 'Kabupaten Indragiri Hilir', 2437),
(1596, 'Kabupaten Indragiri Hulu', 2437),
(1597, 'Kabupaten Kampar', 2437),
(1598, 'Kabupaten Kepulauan Meranti', 2437),
(1599, 'Kabupaten Kuantan Singingi', 2437),
(1600, 'Kabupaten Pelalawan', 2437),
(1601, 'Kabupaten Rokan Hilir', 2437),
(1602, 'Kabupaten Rokan Hulu', 2437),
(1603, 'Kabupaten Siak', 2437),
(1604, 'Kota Dumai', 2437),
(1605, 'Kota Pekanbaru', 2437),
(1606, 'Pekanbaru', 2437),
(1607, 'Kabupaten Majene', 2837),
(1608, 'Kabupaten Mamasa', 2837),
(1609, 'Kabupaten Mamuju', 2837),
(1610, 'Kabupaten Mamuju Tengah', 2837),
(1611, 'Kabupaten Mamuju Utara', 2837),
(1612, 'Kabupaten Polewali Mandar', 2837),
(1613, 'Majene', 2837),
(1614, 'Mamuju', 2837),
(1615, 'Polewali', 2837),
(1616, 'Galesong', 2838),
(1617, 'Kabupaten Bantaeng', 2838),
(1618, 'Kabupaten Barru', 2838),
(1619, 'Kabupaten Bone', 2838),
(1620, 'Kabupaten Bulukumba', 2838),
(1621, 'Kabupaten Enrekang', 2838),
(1622, 'Kabupaten Gowa', 2838),
(1623, 'Kabupaten Jeneponto', 2838),
(1624, 'Kabupaten Luwu', 2838),
(1625, 'Kabupaten Luwu Timur', 2838),
(1626, 'Kabupaten Luwu Utara', 2838),
(1627, 'Kabupaten Maros', 2838),
(1628, 'Kabupaten Pangkajene Dan Kepulauan', 2838),
(1629, 'Kabupaten Pinrang', 2838),
(1630, 'Kabupaten Sidenreng Rappang', 2838),
(1631, 'Kabupaten Sinjai', 2838),
(1632, 'Kabupaten Soppeng', 2838),
(1633, 'Kabupaten Takalar', 2838),
(1634, 'Kabupaten Tana Toraja', 2838),
(1635, 'Kabupaten Toraja Utara', 2838),
(1636, 'Kabupaten Wajo', 2838),
(1637, 'Kota Makassar', 2838),
(1638, 'Kota Palopo', 2838),
(1639, 'Kota Parepare', 2838),
(1640, 'Makassar', 2838),
(1641, 'Maros', 2838),
(1642, 'Palopo', 2838),
(1643, 'Parepare', 2838),
(1644, 'Rantepao', 2838),
(1645, 'Selayar Islands Regency', 2838),
(1646, 'Sengkang', 2838),
(1647, 'Sinjai', 2838),
(1648, 'Watampone', 2838),
(1649, 'Kabupaten Banggai', 2839),
(1650, 'Kabupaten Banggai Kepulauan', 2839),
(1651, 'Kabupaten Banggai Laut', 2839),
(1652, 'Kabupaten Buol', 2839),
(1653, 'Kabupaten Donggala', 2839),
(1654, 'Kabupaten Morowali Utara', 2839),
(1655, 'Kabupaten Parigi Moutong', 2839),
(1656, 'Kabupaten Poso', 2839),
(1657, 'Kabupaten Sigi', 2839),
(1658, 'Kabupaten Toli-Toli', 2839),
(1659, 'Kota Palu', 2839),
(1660, 'Luwuk', 2839),
(1661, 'Morowali Regency', 2839),
(1662, 'Palu', 2839),
(1663, 'Poso', 2839),
(1664, 'Tojo Una-Una Regency', 2839),
(1665, 'Kabupaten Bombana', 2840),
(1666, 'Kabupaten Buton', 2840),
(1667, 'Kabupaten Buton Selatan', 2840),
(1668, 'Kabupaten Buton Tengah', 2840),
(1669, 'Kabupaten Buton Utara', 2840),
(1670, 'Kabupaten Kolaka', 2840),
(1671, 'Kabupaten Kolaka Timur', 2840),
(1672, 'Kabupaten Kolaka Utara', 2840),
(1673, 'Kabupaten Konawe', 2840),
(1674, 'Kabupaten Konawe Kepulauan', 2840),
(1675, 'Kabupaten Konawe Selatan', 2840),
(1676, 'Kabupaten Konawe Utara', 2840),
(1677, 'Kabupaten Muna', 2840),
(1678, 'Kabupaten Muna Barat', 2840),
(1679, 'Katabu', 2840),
(1680, 'Kendari', 2840),
(1681, 'Kota Baubau', 2840),
(1682, 'Kota Kendari', 2840),
(1683, 'Wakatobi Regency', 2840),
(1684, 'Kabupaten Bolaang Mongondow', 2841),
(1685, 'Kabupaten Bolaang Mongondow Selatan', 2841),
(1686, 'Kabupaten Bolaang Mongondow Timur', 2841),
(1687, 'Kabupaten Bolaang Mongondow Utara', 2841),
(1688, 'Kabupaten Kepulauan Sangihe', 2841),
(1689, 'Kabupaten Kepulauan Talaud', 2841),
(1690, 'Kabupaten Minahasa', 2841),
(1691, 'Kabupaten Minahasa Selatan', 2841),
(1692, 'Kabupaten Minahasa Tenggara', 2841),
(1693, 'Kabupaten Minahasa Utara', 2841),
(1694, 'Kabupaten Siau Tagulandang Biaro', 2841),
(1695, 'Kota Bitung', 2841),
(1696, 'Kota Kotamobagu', 2841),
(1697, 'Kota Manado', 2841),
(1698, 'Kota Tomohon', 2841),
(1699, 'Laikit Laikit II (Dimembe)', 2841),
(1700, 'Manado', 2841),
(1701, 'Tomohon', 2841),
(1702, 'Tondano', 2841),
(1703, 'Bukittinggi', 2843),
(1704, 'Kabupaten Agam', 2843),
(1705, 'Kabupaten Dharmasraya', 2843),
(1706, 'Kabupaten Kepulauan Mentawai', 2843),
(1707, 'Kabupaten Lima Puluh Kota', 2843),
(1708, 'Kabupaten Padang Pariaman', 2843),
(1709, 'Kabupaten Pasaman', 2843),
(1710, 'Kabupaten Pasaman Barat', 2843),
(1711, 'Kabupaten Pesisir Selatan', 2843),
(1712, 'Kabupaten Sijunjung', 2843),
(1713, 'Kabupaten Solok', 2843),
(1714, 'Kabupaten Solok Selatan', 2843),
(1715, 'Kabupaten Tanah Datar', 2843),
(1716, 'Kota Bukittinggi', 2843),
(1717, 'Kota Padang', 2843),
(1718, 'Kota Padang Panjang', 2843),
(1719, 'Kota Pariaman', 2843),
(1720, 'Kota Payakumbuh', 2843),
(1721, 'Kota Sawah Lunto', 2843),
(1722, 'Kota Solok', 2843),
(1723, 'Padang', 2843),
(1724, 'Pariaman', 2843),
(1725, 'Payakumbuh', 2843),
(1726, 'Sijunjung', 2843),
(1727, 'Solok', 2843),
(1728, 'Baturaja', 2844),
(1729, 'Kabupaten Empat Lawang', 2844),
(1730, 'Kabupaten Muara Enim', 2844),
(1731, 'Kabupaten Musi Banyuasin', 2844),
(1732, 'Kabupaten Musi Rawas', 2844),
(1733, 'Kabupaten Musi Rawas Utara', 2844),
(1734, 'Kabupaten Ogan Ilir', 2844),
(1735, 'Kabupaten Ogan Komering Ilir', 2844),
(1736, 'Kabupaten Ogan Komering Ulu', 2844),
(1737, 'Kabupaten Ogan Komering Ulu Selatan', 2844),
(1738, 'Kabupaten Ogan Komering Ulu Timur', 2844),
(1739, 'Kabupaten Penukal Abab Lematang Ilir', 2844),
(1740, 'Kota Lubuklinggau', 2844),
(1741, 'Kota Pagar Alam', 2844),
(1742, 'Kota Palembang', 2844),
(1743, 'Kota Prabumulih', 2844),
(1744, 'Lahat', 2844),
(1745, 'Lahat Regency', 2844),
(1746, 'Lubuklinggau', 2844),
(1747, 'Pagar Alam', 2844),
(1748, 'Palembang', 2844),
(1749, 'Prabumulih', 2844),
(1750, 'Tanjungagung', 2844),
(1751, 'Ambarita', 71),
(1752, 'Bandar', 71),
(1753, 'Belawan', 71),
(1754, 'Berastagi', 71),
(1755, 'Binjai', 71),
(1756, 'Deli Tua', 71),
(1757, 'Gunungsitoli', 71),
(1758, 'Kabanjahe', 71),
(1759, 'Kabupaten Asahan', 71),
(1760, 'Kabupaten Batu Bara', 71),
(1761, 'Kabupaten Dairi', 71),
(1762, 'Kabupaten Deli Serdang', 71),
(1763, 'Kabupaten Humbang Hasundutan', 71),
(1764, 'Kabupaten Karo', 71),
(1765, 'Kabupaten Labuhan Batu', 71),
(1766, 'Kabupaten Labuhan Batu Selatan', 71),
(1767, 'Kabupaten Labuhan Batu Utara', 71),
(1768, 'Kabupaten Langkat', 71),
(1769, 'Kabupaten Mandailing Natal', 71),
(1770, 'Kabupaten Nias', 71),
(1771, 'Kabupaten Nias Barat', 71),
(1772, 'Kabupaten Nias Utara', 71),
(1773, 'Kabupaten Padang Lawas', 71),
(1774, 'Kabupaten Padang Lawas Utara', 71),
(1775, 'Kabupaten Pakpak Bharat', 71),
(1776, 'Kabupaten Samosir', 71),
(1777, 'Kabupaten Serdang Bedagai', 71),
(1778, 'Kabupaten Simalungun', 71),
(1779, 'Kabupaten Tapanuli Selatan', 71),
(1780, 'Kabupaten Tapanuli Tengah', 71),
(1781, 'Kabupaten Tapanuli Utara', 71),
(1782, 'Kisaran', 71),
(1783, 'Kota Binjai', 71),
(1784, 'Kota Gunungsitoli', 71),
(1785, 'Kota Medan', 71),
(1786, 'Kota Padangsidimpuan', 71),
(1787, 'Kota Pematang Siantar', 71),
(1788, 'Kota Sibolga', 71),
(1789, 'Kota Tanjung Balai', 71),
(1790, 'Kota Tebing Tinggi', 71),
(1791, 'Labuhan Deli', 71),
(1792, 'Medan', 71),
(1793, 'Padangsidempuan', 71),
(1794, 'Pangkalan Brandan', 71),
(1795, 'Parapat', 71),
(1796, 'Pekan Bahapal', 71),
(1797, 'Pematangsiantar', 71),
(1798, 'Perbaungan', 71),
(1799, 'Percut', 71),
(1800, 'Rantauprapat', 71),
(1801, 'Sibolga', 71),
(1802, 'Stabat', 71),
(1803, 'Sunggal', 71),
(1804, 'Tanjungbalai', 71),
(1805, 'Tanjungtiram', 71),
(1806, 'Tebingtinggi', 71),
(1807, 'Teluk Nibung', 71),
(1808, 'Tomok Bolon', 71),
(1809, 'Tongging', 71),
(1810, 'Tuktuk Sonak', 71);

-- --------------------------------------------------------

--
-- Table structure for table `komen_diskusi`
--

CREATE TABLE `komen_diskusi` (
  `id_komen` bigint(20) NOT NULL,
  `id_diskusi` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED DEFAULT NULL,
  `id_parent` bigint(20) DEFAULT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `komen_diskusi`
--

INSERT INTO `komen_diskusi` (`id_komen`, `id_diskusi`, `id_user`, `id_parent`, `content`, `created_at`, `updated_at`) VALUES
(1, 6, 8, NULL, '<p>test</p>', '2025-03-22 10:15:06', '2025-03-22 10:15:06'),
(2, 6, 8, 1, '<p>hai</p>\r\n\r\n<p>&nbsp;</p>', '2025-03-22 10:15:16', '2025-03-22 10:15:16'),
(3, 6, 5, 2, '<p>hai juga</p>', '2025-03-23 20:38:49', '2025-03-23 20:38:49'),
(4, 6, 3, NULL, '<p>test</p>', '2025-03-27 03:34:28', '2025-03-27 03:34:28'),
(5, 6, 3, 1, '<p>halo</p>', '2025-03-27 03:35:21', '2025-03-27 03:35:21'),
(6, 6, 14, NULL, '<p>test</p>', '2025-04-08 00:07:17', '2025-04-08 00:07:17'),
(7, 6, 13, 4, '<p>halo admin</p>', '2025-04-08 06:25:16', '2025-04-08 06:25:16'),
(8, 6, 3, 7, '<p>halo juga</p>', '2025-04-08 06:27:15', '2025-04-08 06:27:15'),
(9, 23, 3, NULL, '<p>bagus</p>', '2025-04-08 12:31:48', '2025-04-08 12:31:48'),
(10, 23, 3, NULL, '<p><strong>Mantap</strong></p>', '2025-04-08 12:32:00', '2025-04-08 12:32:00'),
(11, 23, 13, 10, '<p><strong>Terima Kasih admin!!</strong></p>', '2025-04-08 12:32:32', '2025-04-08 12:32:32'),
(12, 22, 3, NULL, '<p><strong>Mantap</strong></p>', '2025-04-09 15:54:36', '2025-04-09 15:54:36'),
(13, 23, 14, 10, '<p>Keren</p>', '2025-04-27 06:07:37', '2025-04-27 06:07:37'),
(14, 22, 14, NULL, '<p>Test</p>', '2025-04-27 06:08:31', '2025-04-27 06:08:31'),
(15, 22, 14, 12, '<p>Keren</p>', '2025-04-27 06:09:56', '2025-04-27 06:09:56'),
(16, 22, 14, 15, '<p>halo</p>', '2025-04-27 06:10:10', '2025-04-27 06:10:10'),
(17, 22, 14, 12, '<p style=\"text-align:center\">Test</p>', '2025-04-27 06:11:40', '2025-04-27 06:11:40');

-- --------------------------------------------------------

--
-- Table structure for table `konsultasi`
--

CREATE TABLE `konsultasi` (
  `id_konsultasi` bigint(20) NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_kabupaten` int(11) NOT NULL,
  `id_provinsi` int(11) NOT NULL,
  `id_negara` int(11) NOT NULL,
  `nama_organisasi` varchar(191) NOT NULL,
  `jenis_organisasi` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `no_hp` varchar(13) DEFAULT NULL,
  `deskripsi_kebutuhan` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `konsultasi`
--

INSERT INTO `konsultasi` (`id_konsultasi`, `id_user`, `id_kabupaten`, `id_provinsi`, `id_negara`, `nama_organisasi`, `jenis_organisasi`, `email`, `no_hp`, `deskripsi_kebutuhan`, `created_at`, `updated_at`) VALUES
(2, 5, 1009, 34, 1, 'UKDW', 'Lembaga Pendidikan', 'ukdw@gmail.com', '082144094092', '-', '2025-03-09 19:44:15', '2025-03-09 19:44:15'),
(3, 5, 978, 271, 1, 'test', 'Komunitas', 'imt@gmail.com', '082144094092', '-', '2025-03-09 20:24:46', '2025-03-09 20:24:46');

-- --------------------------------------------------------

--
-- Table structure for table `konsultasi_fasilitators`
--

CREATE TABLE `konsultasi_fasilitators` (
  `id_pelatihan_fasilitator` bigint(20) NOT NULL,
  `id_pelatihan` bigint(20) NOT NULL,
  `id_fasilitator` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `konsultasi_fasilitators`
--

INSERT INTO `konsultasi_fasilitators` (`id_pelatihan_fasilitator`, `id_pelatihan`, `id_fasilitator`) VALUES
(10, 2, 9),
(11, 2, 14),
(12, 2, 15);

-- --------------------------------------------------------

--
-- Table structure for table `konsultasi_files`
--

CREATE TABLE `konsultasi_files` (
  `id` bigint(20) NOT NULL,
  `id_konsultasi` bigint(20) NOT NULL,
  `file_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `konsultasi_files`
--

INSERT INTO `konsultasi_files` (`id`, `id_konsultasi`, `file_url`) VALUES
(1, 2, 'https://drive.google.com/file/d/1sf_Nz6zKekRQPzkOADej_JECNJmJh4jU/view?usp=sharing');

-- --------------------------------------------------------

--
-- Table structure for table `konsultasi_images`
--

CREATE TABLE `konsultasi_images` (
  `id` bigint(20) NOT NULL,
  `id_konsultasi` bigint(20) NOT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `konsultasi_pelatihan`
--

CREATE TABLE `konsultasi_pelatihan` (
  `id_pelatihan_konsultasi` bigint(20) NOT NULL,
  `id_konsultasi` bigint(20) NOT NULL,
  `id_tema` int(11) NOT NULL,
  `nama_pelatihan` varchar(100) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `deskripsi_pelatihan` text NOT NULL,
  `metode_pelatihan` varchar(50) DEFAULT NULL,
  `lokasi_pelatihan` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `konsultasi_pelatihan`
--

INSERT INTO `konsultasi_pelatihan` (`id_pelatihan_konsultasi`, `id_konsultasi`, `id_tema`, `nama_pelatihan`, `tanggal_mulai`, `tanggal_selesai`, `deskripsi_pelatihan`, `metode_pelatihan`, `lokasi_pelatihan`, `created_at`, `updated_at`) VALUES
(2, 2, 1, 'pelatihan kehutanan', '2025-03-10', '2025-03-13', '<p>test lagi dengan file</p>', 'Online', 'Online', NULL, NULL),
(4, 3, 1, 'pelatihan kehutanan isap', '2025-03-12', '2025-03-15', '<p>test</p>', 'Online', 'Online', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `konsultasi_sertifikat`
--

CREATE TABLE `konsultasi_sertifikat` (
  `id_sertifikat` bigint(20) NOT NULL,
  `id_pelatihan_konsultasi` bigint(20) NOT NULL,
  `id_peserta` bigint(20) NOT NULL,
  `file_url` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `konsultasi_sertifikat`
--

INSERT INTO `konsultasi_sertifikat` (`id_sertifikat`, `id_pelatihan_konsultasi`, `id_peserta`, `file_url`) VALUES
(4, 2, 10, 'https://drive.google.com/file/d/1uU1Fy_KP_Qe-aJKu651KyOKNCDoAii9u/view?usp=sharing');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mitra`
--

CREATE TABLE `mitra` (
  `id_mitra` bigint(20) UNSIGNED NOT NULL,
  `id_negara_mitra` int(11) DEFAULT NULL,
  `id_provinsi_mitra` int(11) DEFAULT NULL,
  `id_kabupaten_kota` int(11) DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `pic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kontak_pic` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_awal_kerjasama` date DEFAULT NULL,
  `nama_mitra` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kecamatan` int(11) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mitra`
--

INSERT INTO `mitra` (`id_mitra`, `id_negara_mitra`, `id_provinsi_mitra`, `id_kabupaten_kota`, `alamat`, `pic`, `kontak_pic`, `tanggal_awal_kerjasama`, `nama_mitra`, `id_kecamatan`, `updated_at`, `created_at`) VALUES
(1, 1, 71, NULL, NULL, NULL, NULL, NULL, 'Yayasan Gugah Nurani Indonesia', NULL, NULL, NULL),
(2, 1, 62, NULL, NULL, NULL, NULL, NULL, 'JPIC Kalimantan', NULL, NULL, NULL),
(94, 1, 1231, NULL, 'Jawa Timur', ' Indonesia Barat ', NULL, NULL, 'AMPI', NULL, NULL, NULL),
(95, 1, 2097, NULL, 'Nusa Tenggara Timur', ' Indonesia Tengah', NULL, NULL, 'BLK Don Bosco Budi Daya Sumba', NULL, NULL, NULL),
(96, NULL, NULL, NULL, 'Timor Leste', NULL, NULL, NULL, 'Caritas Timor Leste (CATL)', NULL, NULL, NULL),
(97, 1, 1229, 1010, 'Jakarta', ' Indonesia Barat ', NULL, NULL, 'CommunityID', NULL, NULL, NULL),
(98, 1, 2839, NULL, 'Sulawesi Tengah', ' Indonesia Tengah', NULL, NULL, 'CSR DS-LNG', NULL, NULL, NULL),
(99, 1, 1231, NULL, 'Jawa Timur', ' Indonesia Barat ', NULL, NULL, 'CV Aster Group Malang', NULL, NULL, NULL),
(100, 1, 1229, NULL, 'Jawa Barat', ' Indonesia Barat', NULL, NULL, 'Danarta Anugrah Divina', NULL, NULL, NULL),
(101, 1, 1229, NULL, 'Jawa Barat', ' Indonesia Barat', NULL, NULL, 'DBM Blora', NULL, NULL, NULL),
(103, 1, 1230, NULL, 'Jawa Tengah', ' Indonesia Barat ', NULL, NULL, 'FKDC Jawa Tengah', NULL, NULL, NULL),
(104, 1, 1229, NULL, 'Jawa Barat Indonesia Barat', NULL, NULL, NULL, 'Forum Komunikasi Difabel Cirebon (FKDC)', NULL, NULL, NULL),
(105, 1, 2097, NULL, 'Nusa Tenggara Timur', ' Indonesia Tengah', NULL, NULL, 'HAFi Institute', NULL, NULL, NULL),
(106, 1, 71, NULL, 'Sumatera Utara', ' Indonesia Barat ', NULL, NULL, 'HKBP AIDS Ministry (Sumut)', NULL, NULL, NULL),
(108, 1, 2097, NULL, 'Nusa Tenggara Timur', ' Indonesia Tengah', NULL, NULL, 'Increase (NTT)', NULL, NULL, NULL),
(109, 1, 1229, NULL, 'Jawa Barat', ' Indonesia Barat', NULL, NULL, 'Indonesian Center for Sustainable Development', NULL, NULL, NULL),
(110, 1, 1231, NULL, 'Jawa Timur', ' Indonesia Barat ', NULL, NULL, 'ISCO Foundation', NULL, NULL, NULL),
(111, 1, 1229, 1010, 'Jakarta', ' Indonesia Barat', NULL, NULL, 'Keppak Sejahtera (Jabotabed)', NULL, NULL, NULL),
(112, 1, 1231, 1344, 'Surabaya', ' Jawa Timur', ' Indonesia', NULL, 'Keuskupan Surabaya ', NULL, NULL, NULL),
(113, 1, 1229, NULL, 'Jawa Barat', ' Indonesia Barat ', NULL, NULL, 'KITA (Kesetaraan dan Kemanusiaan) Institute', NULL, NULL, NULL),
(114, 1, 34, 1009, 'Yogyakarta', ' Indonesia Barat', NULL, NULL, 'Koperasi Simpan Pinjam Girimulyo ', NULL, NULL, NULL),
(115, 1, 2097, NULL, 'Nusa Tenggara Timur', ' Indonesia Tengah', NULL, NULL, 'Koperasi Simpan Pinjam Tanaoba Lais Manekat (TLM -NTT)', NULL, NULL, NULL),
(116, 1, 1231, NULL, 'Jawa Timur', ' Indonesia Barat ', NULL, NULL, 'LBH Hope (Jawa Timur)', NULL, NULL, NULL),
(117, 1, 61, NULL, 'Kalimantan Barat', ' Indonesia Barat', NULL, NULL, 'Lembaga Gemawan ', NULL, NULL, NULL),
(118, 1, 34, 1009, 'Yogyakarta', ' Indonesia Barat', NULL, NULL, 'Lembaga Perlindungan Anak Klaten ', NULL, NULL, NULL),
(121, 1, 1229, NULL, 'Jawa Barat Indonesia Barat', NULL, NULL, NULL, 'MARDIKA', NULL, NULL, NULL),
(122, 1, 34, NULL, 'Yogyakarta', ' Indonesia Barat', NULL, NULL, 'MDMC PP Muhammadiyah Yogyakarta ', NULL, NULL, NULL),
(124, 1, 1229, NULL, 'Jakarta', ' Indonesia Barat ', NULL, NULL, 'NLR Indonesia ', NULL, NULL, NULL),
(125, 1, 1231, NULL, 'Jawa Timur', ' Indonesia Barat ', NULL, NULL, 'NLR Pasuruan', NULL, NULL, NULL),
(126, 1, 61, NULL, 'Kalimantan Barat', ' Indonesia Barat', NULL, NULL, 'Pancur Kasih (Kalbar)', NULL, NULL, NULL),
(127, NULL, NULL, NULL, 'Timor Leste', NULL, NULL, NULL, 'Partai CNRT (KAS)', NULL, NULL, NULL),
(128, NULL, NULL, NULL, 'Timor Leste', NULL, NULL, NULL, 'Partai Demokrat', NULL, NULL, NULL),
(129, 1, 1230, NULL, 'Jawa Tengah', ' Indonesia Barat', NULL, NULL, 'PELITA', NULL, NULL, NULL),
(130, 1, 1230, NULL, 'Jawa Tengah', ' Indonesia Barat ', NULL, NULL, 'Perkumpulan Sehati Sukoharjo', NULL, NULL, NULL),
(131, 1, 2838, NULL, 'Sulawesi Selatan', ' Indonesia Tengah', NULL, NULL, 'PerMaTa Bulukumba', NULL, NULL, NULL),
(132, 1, 2838, NULL, 'Sulawesi Selatan', ' Indonesia Tengah', NULL, NULL, 'PerMaTa dan ForDisTU Toraja Utara', NULL, NULL, NULL),
(133, 1, 2838, NULL, 'Sulawesi Selatan', ' Indonesia Tengah', NULL, NULL, 'PerMaTa Jeneponto', NULL, NULL, NULL),
(134, 1, 1231, NULL, 'Jawa Timur', ' Indonesia Barat', NULL, NULL, 'PIB Bojonegoro ', NULL, NULL, NULL),
(135, 1, 2838, NULL, 'Sulawesi Selatan', ' Indonesia Tengah', NULL, NULL, 'PKPSS', NULL, NULL, NULL),
(136, 1, 2838, NULL, 'Sulawesi Selatan', ' Indonesia Tengah', NULL, NULL, 'PKPSULSEL', NULL, NULL, NULL),
(137, 1, NULL, NULL, 'Timor Leste', NULL, NULL, NULL, 'Plan International - Timor Leste ', NULL, NULL, NULL),
(138, 1, 1229, NULL, 'Jawa Barat Indonesia Barat', NULL, NULL, NULL, 'PPDI SUBANG', NULL, NULL, NULL),
(139, 1, 34, 1009, 'Yogyakarta', ' Indonesia Barat', NULL, NULL, 'PT SGK', NULL, NULL, NULL),
(140, 1, 34, 1009, 'Yogyakarta', ' Indonesia Barat', NULL, NULL, 'Pusat Perilaku dan Promosi Kesehatan,  FK-KMK UGM', NULL, NULL, NULL),
(141, 1, 34, 1009, 'Yogyakarta', ' Indonesia Barat', NULL, NULL, 'Pusat Rehabilitasi Yakkum ', NULL, NULL, NULL),
(142, 1, 1230, NULL, 'Jawa Tengah', ' Indonesia Barat ', NULL, NULL, 'Pusat Rehabilitasi Yakkum  (Jateng-DIY)', NULL, NULL, NULL),
(143, 1, 34, 1009, 'Yogyakarta', ' Indonesia Barat', NULL, NULL, 'Puskesmas Gatak', NULL, NULL, NULL),
(144, 1, 1231, NULL, 'Jawa Timur', ' Indonesia Barat ', NULL, NULL, 'Pustaka Lewi (Jawa Timur', NULL, NULL, NULL),
(145, 1, 1230, NULL, 'Jawa Tengah ', ' Indonesia Barat', NULL, NULL, 'Sanggar Inklusi Tunas Bangsa', NULL, NULL, NULL),
(146, 1, 1230, NULL, 'Jawa Tengah ', ' Indonesia Barat', NULL, NULL, 'SEHATI SUKOHARJO', NULL, NULL, NULL),
(147, 1, 34, 1009, 'Yogyakarta', ' Indonesia Barat', NULL, NULL, 'Semau Muda', NULL, NULL, NULL),
(148, 1, NULL, NULL, 'Jambi', ' Indonesia Barat ', NULL, NULL, 'SETARA Jambi', NULL, NULL, NULL),
(149, 1, 1230, NULL, 'Jawa Tengah ', ' Indonesia Barat', NULL, NULL, 'SLB-A Karya Murni', NULL, NULL, NULL),
(150, NULL, NULL, NULL, 'Timor Leste', NULL, NULL, NULL, 'SSYS (Kementrian Pemuda dan Olahraga TimLes)', NULL, NULL, NULL),
(151, 1, 2199, NULL, 'Papua Barat', ' Indonesia Timur', NULL, NULL, 'STIE Bukit Zaitun (Pap-Bar)', NULL, NULL, NULL),
(152, 1, 1230, NULL, 'Jawa Tengah', ' Indonesia Barat', NULL, NULL, 'Trukajaya (Jateng-DIY)', NULL, NULL, NULL),
(153, 1, 34, 1009, 'Yogyakarta', ' Indonesia Barat ', NULL, NULL, 'UCPRUK', NULL, NULL, NULL),
(154, 1, 1229, NULL, 'Jawa Barat', ' Indonesia Barat ', NULL, NULL, 'Universitas Katolik Parahyangan', NULL, NULL, NULL),
(155, 1, 1230, NULL, 'Jawa Tengah', ' Indonesia Barat ', NULL, NULL, 'UPTD PUSKESMAS KARTASURA DINKES SUKOHARJO', NULL, NULL, NULL),
(156, 1, 252, NULL, 'Bali', ' Indonesia Tengah', NULL, NULL, 'Widya Asih (Bali)', NULL, NULL, NULL),
(157, 1, 2199, NULL, 'Papua Barat', ' Indonesia Timur', NULL, NULL, 'Yay. Sosial Agustinus (Pap-Bar)', NULL, NULL, NULL),
(158, 1, 2097, NULL, 'Nusa Tenggara Timur', ' Indonesia Tengah', NULL, NULL, 'YAYASAN AIR HDUP SUMBA (NTT)', NULL, NULL, NULL),
(159, 1, 2097, NULL, 'Nusa Tenggara Timur', ' Indonesia Tengah ', NULL, NULL, 'Yayasan Ayo Indonesia', NULL, NULL, NULL),
(160, 1, 1703, NULL, 'Maluku', ' Indonesia Timur', NULL, NULL, 'Yayasan Ina Haha (Maluku)', NULL, NULL, NULL),
(161, 1, 1229, NULL, 'Jakarta', ' Indonesia Barat', NULL, NULL, 'Yayasan Kampus Diakoneia Modern  (Jabotabek)', NULL, NULL, NULL),
(162, 1, 1230, NULL, 'Jawa Tengah', ' Indonesia Barat ', NULL, NULL, 'YAYASAN KARYA BAKTI WONOSOBO', NULL, NULL, NULL),
(163, 1, 2097, NULL, 'Nusa Tenggara Timur', ' Indonesia Tengah', NULL, NULL, 'Yayasan Kita Keluarga Insani', NULL, NULL, NULL),
(164, 1, 71, NULL, 'Sumatera Utara', ' Indonesia Barat ', NULL, NULL, 'Yayasan Nurani Luhur Masyarakat (YNLM)-Medan', NULL, NULL, NULL),
(165, 1, 1229, NULL, 'Jakarta', ' Indonesia Barat ', NULL, NULL, 'Yayasan Peduli Kasih Anak Berkebutuhan Khusus', NULL, NULL, NULL),
(166, 1, 1703, NULL, 'Maluku', ' Indonesia Timur', NULL, NULL, 'Yayasan Pelangi Maluku', NULL, NULL, NULL),
(167, 1, 71, NULL, 'Sumatera Utara', ' Indonesia Barat ', NULL, NULL, 'Yayasan Pendidikan Tuna Netra (Yapentra )sumut)', NULL, NULL, NULL),
(168, 1, 1230, NULL, 'Jawa Tengah', ' Indonesia Barat ', NULL, NULL, 'Yayasan Pengabdian Hukum Indonesia (YAPHI) (Jateng-DIY)', NULL, NULL, NULL),
(170, 1, 1229, NULL, 'Jakarta', ' Indonesia Barat', NULL, NULL, 'Yayasan Rawinala (Jabotabed)', NULL, NULL, NULL),
(171, 1, 2199, NULL, 'Papua', ' Indonesia Timur ', NULL, NULL, 'Yayasan Rumsram Biak', NULL, NULL, NULL),
(172, 1, 61, NULL, 'Kalimantan Barat', ' Indonesia Barat', NULL, NULL, 'Yayasan SABATU Pontianak', NULL, NULL, NULL),
(173, 1, 34, 1009, 'Yogyakarta', ' Indonesia Barat', NULL, NULL, 'Yayasan Setara Semarang ', NULL, NULL, NULL),
(174, 1, 2199, NULL, 'Papua Barat', ' Indonesia Timur', NULL, NULL, 'Yayasan Siloam (Pap-Bar)', NULL, NULL, NULL),
(175, 1, 2097, NULL, 'Nusa Tenggara Timur', ' Indonesia Tengah ', NULL, NULL, 'YAYASAN SOSIAL IBU ANFRIDA NAOB', NULL, NULL, NULL),
(176, 1, 61, NULL, 'Kalimantan Barat', ' Indonesia Barat ', NULL, NULL, 'Yayasan Swadaya Dian Khatulistiwa (YSDK)', NULL, NULL, NULL),
(177, 1, 2097, NULL, 'Nusa Tenggara Timur', ' Indonesia Tengah', NULL, NULL, 'Yayasan Tananua Flores', NULL, NULL, NULL),
(178, 1, 1230, NULL, 'Jawa Tengah', ' Indonesia Barat ', NULL, NULL, 'Yayasan Trukajaya Salatiga', NULL, NULL, NULL),
(179, 1, 1703, NULL, 'Maluku', ' Indonesia Timur', NULL, NULL, 'Yayasan Tutwuri Handayani (Maluku)', NULL, NULL, NULL),
(180, 1, 1229, 1010, 'Jakarta', ' Indonesia Barat ', NULL, NULL, 'Yayasan Wadah Titian Harapan', NULL, NULL, NULL),
(181, 1, 2097, NULL, 'Nusa Tenggara Timur', ' Indonesia Tengah', NULL, NULL, 'Yayasan Wali Ati (YASALTI)', NULL, NULL, NULL),
(182, 1, 61, 1362, 'Pontianak', ' Kalimantan Barat', NULL, NULL, 'Yayasan DianTama', NULL, NULL, NULL),
(183, 1, 71, NULL, 'Sumatera Utara', ' Indonesia Barat', NULL, NULL, 'YKPD GBKP ALPHA OMEGA (Sumut)', NULL, NULL, NULL),
(184, 1, 1230, NULL, 'Jawa Tengah', ' Indonesia Barat ', NULL, NULL, 'YPCM Boyolali', NULL, NULL, NULL),
(185, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Tibet', NULL, '2025-04-07', '2025-04-07'),
(186, NULL, NULL, NULL, NULL, NULL, '000000000000', NULL, 'UKDW', NULL, '2025-04-07', '2025-04-07'),
(187, NULL, NULL, NULL, NULL, NULL, '333333333333', NULL, 'sadas', NULL, '2025-04-07', '2025-04-07'),
(188, NULL, NULL, NULL, NULL, NULL, '111111111111', NULL, 'jhjk', NULL, '2025-04-08', '2025-04-08');

-- --------------------------------------------------------

--
-- Table structure for table `negara`
--

CREATE TABLE `negara` (
  `id` int(11) NOT NULL,
  `nama_negara` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `negara`
--

INSERT INTO `negara` (`id`, `nama_negara`) VALUES
(1, 'Indonesia'),
(2, 'Timor Leste'),
(3, 'Afghanistan'),
(4, 'Albania'),
(5, 'Algeria'),
(6, 'Andorra'),
(7, 'Angola'),
(8, 'Antigua And Barbuda'),
(9, 'Argentina'),
(10, 'Armenia'),
(11, 'Australia'),
(12, 'Austria'),
(13, 'Azerbaijan'),
(14, 'Bahrain'),
(15, 'Bangladesh'),
(16, 'Barbados'),
(17, 'Belarus'),
(18, 'Belgium'),
(19, 'Belize'),
(20, 'Benin'),
(21, 'Bhutan'),
(22, 'Bolivia'),
(23, 'Bonaire, Sint Eustatius and Saba'),
(24, 'Bosnia and Herzegovina'),
(25, 'Botswana'),
(26, 'Brazil'),
(27, 'Brunei'),
(28, 'Bulgaria'),
(29, 'Burkina Faso'),
(30, 'Burundi'),
(31, 'Cambodia'),
(32, 'Cameroon'),
(33, 'Canada'),
(34, 'Cape Verde'),
(35, 'Central African Republic'),
(36, 'Chad'),
(37, 'Chile'),
(38, 'China'),
(39, 'Colombia'),
(40, 'Comoros'),
(41, 'Congo'),
(42, 'Costa Rica'),
(43, 'Cote D\'Ivoire (Ivory Coast)'),
(44, 'Croatia'),
(45, 'Cuba'),
(46, 'Cyprus'),
(47, 'Czech Republic'),
(48, 'Democratic Republic of the Congo'),
(49, 'Denmark'),
(50, 'Djibouti'),
(51, 'Dominica'),
(52, 'Dominican Republic'),
(53, 'East Timor'),
(54, 'Ecuador'),
(55, 'Egypt'),
(56, 'El Salvador'),
(57, 'Equatorial Guinea'),
(58, 'Eritrea'),
(59, 'Estonia'),
(60, 'Ethiopia'),
(61, 'Fiji Islands'),
(62, 'Finland'),
(63, 'France'),
(64, 'Gabon'),
(65, 'Gambia The'),
(66, 'Georgia'),
(67, 'Germany'),
(68, 'Ghana'),
(69, 'Greece'),
(70, 'Grenada'),
(71, 'Guatemala'),
(72, 'Guinea'),
(73, 'Guinea-Bissau'),
(74, 'Guyana'),
(75, 'Haiti'),
(76, 'Honduras'),
(77, 'Hungary'),
(78, 'Iceland'),
(79, 'India'),
(80, 'Iran'),
(81, 'Iraq'),
(82, 'Ireland'),
(83, 'Israel'),
(84, 'Italy'),
(85, 'Jamaica'),
(86, 'Japan'),
(87, 'Jordan'),
(88, 'Kazakhstan'),
(89, 'Kenya'),
(90, 'Kiribati'),
(91, 'Kuwait'),
(92, 'Kyrgyzstan'),
(93, 'Laos'),
(94, 'Latvia'),
(95, 'Lebanon'),
(96, 'Lesotho'),
(97, 'Liberia'),
(98, 'Libya'),
(99, 'Liechtenstein'),
(100, 'Lithuania'),
(101, 'Luxembourg'),
(102, 'Macedonia'),
(103, 'Madagascar'),
(104, 'Malawi'),
(105, 'Malaysia'),
(106, 'Maldives'),
(107, 'Mali'),
(108, 'Malta'),
(109, 'Mauritania'),
(110, 'Mauritius'),
(111, 'Mexico'),
(112, 'Micronesia'),
(113, 'Moldova'),
(114, 'Mongolia'),
(115, 'Montenegro'),
(116, 'Morocco'),
(117, 'Mozambique'),
(118, 'Myanmar'),
(119, 'Namibia'),
(120, 'Nauru'),
(121, 'Nepal'),
(122, 'Netherlands'),
(123, 'New Zealand'),
(124, 'Nicaragua'),
(125, 'Niger'),
(126, 'Nigeria'),
(127, 'North Korea'),
(128, 'Norway'),
(129, 'Oman'),
(130, 'Pakistan'),
(131, 'Palau'),
(132, 'Panama'),
(133, 'Papua new Guinea'),
(134, 'Paraguay'),
(135, 'Peru'),
(136, 'Philippines'),
(137, 'Poland'),
(138, 'Portugal'),
(139, 'Qatar'),
(140, 'Romania'),
(141, 'Russia'),
(142, 'Rwanda'),
(143, 'Saint Kitts And Nevis'),
(144, 'Saint Lucia'),
(145, 'Saint Vincent And The Grenadines'),
(146, 'Samoa'),
(147, 'San Marino'),
(148, 'Sao Tome and Principe'),
(149, 'Saudi Arabia'),
(150, 'Senegal'),
(151, 'Serbia'),
(152, 'Seychelles'),
(153, 'Sierra Leone'),
(154, 'Singapore'),
(155, 'Slovakia'),
(156, 'Slovenia'),
(157, 'Solomon Islands'),
(158, 'Somalia'),
(159, 'South Africa'),
(160, 'South Korea'),
(161, 'South Sudan'),
(162, 'Spain'),
(163, 'Sri Lanka'),
(164, 'Sudan'),
(165, 'Suriname'),
(166, 'Swaziland'),
(167, 'Sweden'),
(168, 'Switzerland'),
(169, 'Syria'),
(170, 'Taiwan'),
(171, 'Tajikistan'),
(172, 'Tanzania'),
(173, 'Thailand'),
(174, 'The Bahamas'),
(175, 'Togo'),
(176, 'Tonga'),
(177, 'Trinidad And Tobago'),
(178, 'Tunisia'),
(179, 'Turkey'),
(180, 'Turkmenistan'),
(181, 'Tuvalu'),
(182, 'Uganda'),
(183, 'Ukraine'),
(184, 'United Arab Emirates'),
(185, 'United Kingdom'),
(186, 'United States'),
(187, 'Uruguay'),
(188, 'Uzbekistan'),
(189, 'Vanuatu'),
(190, 'Venezuela'),
(191, 'Vietnam'),
(192, 'Virgin Islands (US)'),
(193, 'Yemen'),
(194, 'Zambia'),
(195, 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permintaan`
--

CREATE TABLE `permintaan` (
  `id_permintaan` bigint(20) NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_tema` int(11) DEFAULT NULL,
  `id_mitra` bigint(20) UNSIGNED DEFAULT NULL,
  `nama_mitra` varchar(255) DEFAULT NULL,
  `judul_pelatihan` varchar(191) NOT NULL,
  `tanggal_mulai` timestamp NULL DEFAULT NULL,
  `tanggal_selesai` timestamp NULL DEFAULT NULL,
  `masalah` text,
  `kebutuhan` text,
  `materi` text NOT NULL,
  `no_pic` varchar(255) DEFAULT NULL,
  `request_khusus` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permintaan`
--

INSERT INTO `permintaan` (`id_permintaan`, `id_user`, `id_tema`, `id_mitra`, `nama_mitra`, `judul_pelatihan`, `tanggal_mulai`, `tanggal_selesai`, `masalah`, `kebutuhan`, `materi`, `no_pic`, `request_khusus`, `created_at`, `updated_at`) VALUES
(3, 14, 3, 1, NULL, 'Pelatihan Manajemen', '2025-03-28 17:00:00', '2025-03-30 17:00:00', '-', '-', '-', '000000000000', 'tidak ada', NULL, NULL),
(4, 14, 2, 95, NULL, 'Pelatihan Bijak Berpolitik', '2025-03-31 17:00:00', '2025-04-04 17:00:00', 'tidak ada', 'tidak ada', 'tidak ada', '111111111111', 'tidak ada', NULL, NULL),
(18, 10, 2, 111, NULL, 'Pelatihan Bela Negara', '2025-04-16 17:00:00', '2025-04-08 17:00:00', 'sadasd', 'asdsd', 'asdasd', '111111111111', 'sadasd', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_fasilitators`
--

CREATE TABLE `permintaan_fasilitators` (
  `id_pelatihan_fasilitator` bigint(20) NOT NULL,
  `id_pelatihan` bigint(20) NOT NULL,
  `id_fasilitator` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permintaan_fasilitators`
--

INSERT INTO `permintaan_fasilitators` (`id_pelatihan_fasilitator`, `id_pelatihan`, `id_fasilitator`) VALUES
(14, 7, 9),
(15, 7, 13),
(16, 8, 9);

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_files`
--

CREATE TABLE `permintaan_files` (
  `id` bigint(20) NOT NULL,
  `id_permintaan` bigint(20) NOT NULL,
  `file_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permintaan_files`
--

INSERT INTO `permintaan_files` (`id`, `id_permintaan`, `file_url`) VALUES
(6, 7, 'https://drive.google.com/file/d/1J_0uxxtPXlgLms--S5tWQPtC-fBC03Qw/view?usp=sharing'),
(7, 7, 'https://drive.google.com/file/d/1LP-afpO5S3xDPM8yUPPEOuuiBsFtPWM1/view?usp=sharing');

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_images`
--

CREATE TABLE `permintaan_images` (
  `id` bigint(20) NOT NULL,
  `id_permintaan` bigint(20) NOT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_pelatihan`
--

CREATE TABLE `permintaan_pelatihan` (
  `id_pelatihan_permintaan` bigint(20) NOT NULL,
  `id_permintaan` bigint(20) NOT NULL,
  `id_tema` int(11) NOT NULL,
  `nama_pelatihan` varchar(191) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `deskripsi_pelatihan` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `metode_pelatihan` varchar(191) DEFAULT NULL,
  `lokasi_pelatihan` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permintaan_pelatihan`
--

INSERT INTO `permintaan_pelatihan` (`id_pelatihan_permintaan`, `id_permintaan`, `id_tema`, `nama_pelatihan`, `tanggal_mulai`, `tanggal_selesai`, `deskripsi_pelatihan`, `created_at`, `updated_at`, `metode_pelatihan`, `lokasi_pelatihan`) VALUES
(4, 3, 3, 'Pelatihan Manajemen', '2025-03-29', '2025-03-31', '<p>tidak ada</p>', NULL, NULL, 'Online', 'Online'),
(7, 18, 2, 'Pelatihan Bela Negara', '2025-04-17', '2025-04-19', '<p>test lagi</p>', NULL, NULL, 'Online', 'Online'),
(8, 4, 2, 'Pelatihan Bijak Berpolitik', '2025-04-01', '2025-04-05', '<p>iya</p>', NULL, NULL, 'Offline', 'jogja');

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_sertifikat`
--

CREATE TABLE `permintaan_sertifikat` (
  `id_sertifikat` bigint(11) NOT NULL,
  `id_pelatihan_permintaan` bigint(20) NOT NULL,
  `id_peserta` bigint(20) NOT NULL,
  `file_url` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permintaan_sertifikat`
--

INSERT INTO `permintaan_sertifikat` (`id_sertifikat`, `id_pelatihan_permintaan`, `id_peserta`, `file_url`) VALUES
(1, 7, 4, 'https://drive.google.com/file/d/1cPZ8n4vbmvefRX4mtOoYHpcnsltdKP5J/view?usp=sharing');

-- --------------------------------------------------------

--
-- Table structure for table `peserta_pelatihan_konsultasi`
--

CREATE TABLE `peserta_pelatihan_konsultasi` (
  `id_peserta` bigint(20) NOT NULL,
  `id_pelatihan_konsultasi` bigint(20) NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `nama_peserta` varchar(191) NOT NULL,
  `email_peserta` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peserta_pelatihan_konsultasi`
--

INSERT INTO `peserta_pelatihan_konsultasi` (`id_peserta`, `id_pelatihan_konsultasi`, `id_user`, `nama_peserta`, `email_peserta`, `created_at`, `updated_at`) VALUES
(6, 2, 7, 'John Julius', 'john@gmail.com', NULL, NULL),
(8, 2, 8, 'test11', 'imka@gmail.com', NULL, NULL),
(9, 2, 5, 'kevin', 'kevin@gmail.com', NULL, NULL),
(10, 2, 14, 'John Pattikayhatu', 'pattikayhatuj@gmail.com', NULL, NULL),
(11, 4, 14, 'John Pattikayhatu', 'pattikayhatuj@gmail.com', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `peserta_pelatihan_permintaan`
--

CREATE TABLE `peserta_pelatihan_permintaan` (
  `id_peserta` bigint(20) NOT NULL,
  `id_pelatihan_permintaan` bigint(20) NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `nama_peserta` varchar(191) NOT NULL,
  `email_peserta` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peserta_pelatihan_permintaan`
--

INSERT INTO `peserta_pelatihan_permintaan` (`id_peserta`, `id_pelatihan_permintaan`, `id_user`, `nama_peserta`, `email_peserta`, `created_at`, `updated_at`) VALUES
(2, 4, 14, 'John Pattikayhatu', 'pattikayhatuj@gmail.com', '2025-04-02 22:37:26', '2025-04-02 22:37:26'),
(3, 7, 13, 'Buddy Barnes', 'maingamej69@gmail.com', '2025-04-07 03:21:44', '2025-04-07 03:21:44'),
(4, 7, 14, 'John Julius', 'pattikayhatuj@gmail.com', '2025-04-27 07:11:13', '2025-04-27 07:11:13');

-- --------------------------------------------------------

--
-- Table structure for table `peserta_pelatihan_reguler`
--

CREATE TABLE `peserta_pelatihan_reguler` (
  `id_peserta_reguler` bigint(20) NOT NULL,
  `id_reguler` bigint(20) DEFAULT NULL,
  `id_user` bigint(20) UNSIGNED DEFAULT NULL,
  `id_kabupaten` int(11) DEFAULT NULL,
  `id_provinsi` int(11) DEFAULT NULL,
  `id_negara` int(11) DEFAULT NULL,
  `nama_peserta` varchar(100) DEFAULT NULL,
  `email_peserta` varchar(100) DEFAULT NULL,
  `no_hp` varchar(12) DEFAULT NULL,
  `rentang_usia` varchar(50) DEFAULT NULL,
  `gender` varchar(100) DEFAULT NULL,
  `organisasi` varchar(50) DEFAULT NULL,
  `nama_organisasi` varchar(100) DEFAULT NULL,
  `jabatan_peserta` varchar(100) DEFAULT NULL,
  `informasi` varchar(100) DEFAULT NULL,
  `pelatihan_relevan` varchar(100) DEFAULT NULL,
  `harapan_pelatihan` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peserta_pelatihan_reguler`
--

INSERT INTO `peserta_pelatihan_reguler` (`id_peserta_reguler`, `id_reguler`, `id_user`, `id_kabupaten`, `id_provinsi`, `id_negara`, `nama_peserta`, `email_peserta`, `no_hp`, `rentang_usia`, `gender`, `organisasi`, `nama_organisasi`, `jabatan_peserta`, `informasi`, `pelatihan_relevan`, `harapan_pelatihan`, `created_at`, `updated_at`) VALUES
(14, 8, 14, 1007, 34, 1, 'John Julius', 'pattikayhatuj@gmail.com', '082312839817', '20-25', 'Laki-Laki', 'Lembaga Pendidikan', 'Ukdw', 'Mahasiswa', 'Instagram', 'tidak ada', 'tidak ada', '2025-04-21 10:42:38', '2025-04-21 10:42:38'),
(21, 8, 13, 1011, 708, 1, 'Buddy Barnes', 'maingamej69@gmail.com', '008213123123', '26-30', 'Laki-Laki', 'Pemerintah', 'FFI', 'Anggota', 'Instagram', 'tidak ada', 'tidak ada', '2025-04-22 04:19:03', '2025-04-22 04:19:03');

-- --------------------------------------------------------

--
-- Table structure for table `provinsi`
--

CREATE TABLE `provinsi` (
  `id` int(11) NOT NULL,
  `nama_provinsi` varchar(255) NOT NULL,
  `id_negara` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `provinsi`
--

INSERT INTO `provinsi` (`id`, `nama_provinsi`, `id_negara`) VALUES
(1, 'Aileu', 2),
(2, 'Ainaro', 2),
(3, 'Baucau', 2),
(4, 'Bobonaro', 2),
(5, 'Cova-Lima', 2),
(6, 'Dili', 2),
(7, 'Ermera', 2),
(8, 'Lautém', 2),
(9, 'Liquiçá', 2),
(10, 'Manatuto', 2),
(11, 'Manufahi', 2),
(12, 'Oecussi-Ambeno', 2),
(13, 'Viqueque', 2),
(14, 'Atauro', 2),
(15, 'Aceh', 1),
(34, 'DI Yogyakarta', 1),
(61, 'Kalimantan Barat', 1),
(62, 'Kalimantan Tengah', 1),
(71, 'Sumatera Utara', 1),
(252, 'Bali', 1),
(271, 'Banten', 1),
(325, 'Bengkulu', 1),
(708, 'DKI Jakarta', 1),
(988, 'Gorontalo', 1),
(1224, 'Jambi', 1),
(1229, 'Jawa Barat', 1),
(1230, 'Jawa Tengah', 1),
(1231, 'Jawa Timur', 1),
(1288, 'Kalimantan Selatan', 1),
(1290, 'Kalimantan Timur', 1),
(1291, 'Kalimantan Utara', 1),
(1360, 'Kepulauan Bangka Belitung', 1),
(1361, 'Kepulauan Riau', 1),
(1542, 'Lampung', 1),
(1703, 'Maluku', 1),
(1704, 'Maluku Utara', 1),
(2096, 'Nusa Tenggara Barat', 1),
(2097, 'Nusa Tenggara Timur', 1),
(2198, 'Papua', 1),
(2199, 'Papua Barat', 1),
(2437, 'Riau', 1),
(2837, 'Sulawesi Barat', 1),
(2838, 'Sulawesi Selatan', 1),
(2839, 'Sulawesi Tengah', 1),
(2840, 'Sulawesi Tenggara', 1),
(2841, 'Sulawesi Utara', 1),
(2843, 'Sumatera Barat', 1),
(2844, 'Sumatera Selatan', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reguler`
--

CREATE TABLE `reguler` (
  `id_reguler` bigint(11) NOT NULL,
  `id_tema` int(11) DEFAULT NULL,
  `nama_pelatihan` varchar(100) DEFAULT NULL,
  `fee_pelatihan` decimal(10,2) DEFAULT NULL,
  `metode_pelatihan` varchar(100) DEFAULT NULL,
  `lokasi_pelatihan` varchar(100) DEFAULT NULL,
  `kuota_peserta` varchar(100) DEFAULT NULL,
  `tanggal_pendaftaran` date DEFAULT NULL,
  `tanggal_batas_pendaftaran` date DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `deskripsi_pelatihan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reguler`
--

INSERT INTO `reguler` (`id_reguler`, `id_tema`, `nama_pelatihan`, `fee_pelatihan`, `metode_pelatihan`, `lokasi_pelatihan`, `kuota_peserta`, `tanggal_pendaftaran`, `tanggal_batas_pendaftaran`, `tanggal_mulai`, `tanggal_selesai`, `deskripsi_pelatihan`) VALUES
(8, 3, 'Pelatihan Bela Negara', '50000.00', 'Online', 'Online', '20', '2025-04-21', '2025-04-29', '2025-04-30', '2025-05-08', '<p>test upload pelatihan dengan 1 gambar</p>');

-- --------------------------------------------------------

--
-- Table structure for table `reguler_fasilitators`
--

CREATE TABLE `reguler_fasilitators` (
  `id_pelatihan_fasilitator` bigint(20) NOT NULL,
  `id_pelatihan` bigint(20) NOT NULL,
  `id_fasilitator` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reguler_fasilitators`
--

INSERT INTO `reguler_fasilitators` (`id_pelatihan_fasilitator`, `id_pelatihan`, `id_fasilitator`) VALUES
(55, 8, 13);

-- --------------------------------------------------------

--
-- Table structure for table `reguler_files`
--

CREATE TABLE `reguler_files` (
  `id` bigint(20) NOT NULL,
  `id_reguler` bigint(20) NOT NULL,
  `file_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reguler_files`
--

INSERT INTO `reguler_files` (`id`, `id_reguler`, `file_url`) VALUES
(1, 8, 'https://drive.google.com/file/d/1z0kDvZCOt5cf2sprrUXm-bBRd2Zfo9LH/view?usp=sharing');

-- --------------------------------------------------------

--
-- Table structure for table `reguler_images`
--

CREATE TABLE `reguler_images` (
  `id` bigint(20) NOT NULL,
  `id_reguler` bigint(20) NOT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reguler_images`
--

INSERT INTO `reguler_images` (`id`, `id_reguler`, `image_url`) VALUES
(14, 8, '1.png');

-- --------------------------------------------------------

--
-- Table structure for table `reguler_sertifikat`
--

CREATE TABLE `reguler_sertifikat` (
  `id_sertifikat` bigint(20) NOT NULL,
  `id_reguler` bigint(20) NOT NULL,
  `id_peserta` bigint(20) NOT NULL,
  `file_url` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reguler_sertifikat`
--

INSERT INTO `reguler_sertifikat` (`id_sertifikat`, `id_reguler`, `id_peserta`, `file_url`) VALUES
(3, 8, 14, 'https://drive.google.com/file/d/1XpvbosNJgbQNXHfFG8gCXD6U92Xfcxez/view?usp=sharing');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `status_bayar_pelatihan`
--

CREATE TABLE `status_bayar_pelatihan` (
  `id_status` bigint(20) NOT NULL,
  `id_reguler` bigint(20) NOT NULL,
  `id_peserta` bigint(20) NOT NULL,
  `status` enum('belum_bayar','sudah_bayar') DEFAULT 'belum_bayar',
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status_bayar_pelatihan`
--

INSERT INTO `status_bayar_pelatihan` (`id_status`, `id_reguler`, `id_peserta`, `status`, `created_at`, `updated_at`) VALUES
(1, 8, 14, 'sudah_bayar', '2025-04-22', '2025-04-27'),
(2, 8, 21, 'sudah_bayar', '2025-04-22', '2025-04-22');

-- --------------------------------------------------------

--
-- Table structure for table `tema`
--

CREATE TABLE `tema` (
  `id` int(11) NOT NULL,
  `judul_tema` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tema`
--

INSERT INTO `tema` (`id`, `judul_tema`) VALUES
(1, 'Gender dan Inkuivitas'),
(2, 'Politik'),
(3, 'Monitoring, Evaluation dan Learning'),
(11, 'CTGA');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` enum('admin','peserta') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reset_token` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `roles`, `remember_token`, `reset_token`, `created_at`, `updated_at`) VALUES
(2, 'Orang ke - 2', '', 'orang@gmail.com', NULL, '$2y$12$rU/oyu1S3dTOF8Vl4M7C3uBDxpkHbyUsyLoy3XkzCpxfkbKCYcXIS', 'peserta', NULL, '', '2025-02-15 09:55:22', '2025-02-15 09:55:22'),
(3, 'Mediya', 'mediyastc', 'admin@gmail.com', NULL, '$2y$12$D.djRCYO1v6mSW../P5ZAehiJPj8dlgRmkkbHJ.u/y6fIsU9ALOW2', 'admin', NULL, '', NULL, '2025-04-12 06:10:27'),
(5, 'kevin', '', 'kevin@gmail.com', NULL, '$2y$12$vODXVaQwT/v4rB0XoUNxy.Cp.WkbU34AkYPmu2XbxfNubz5j5iQiG', 'peserta', NULL, '', '2025-03-09 15:18:56', '2025-03-09 20:32:33'),
(6, 'riko', '', 'riko@gmail.com', NULL, '$2y$12$wjPeVVlzGyZ4Vn7rnH2bcuGAeaFPTFmSI.vl9NRLXUCdCYlQ7Lzem', 'peserta', NULL, '', '2025-03-09 15:55:06', '2025-03-09 15:55:06'),
(7, 'John Julius', '', 'john@gmail.com', NULL, '$2y$12$Nd7g56xFFaD3segmSIeG9e1tI8mlVbWnFS6o1fZlPXALwPyFlSI/m', 'peserta', NULL, '', '2025-03-09 19:47:32', '2025-03-09 19:47:32'),
(8, 'test11', '', 'imka@gmail.com', NULL, '$2y$12$Nd7g56xFFaD3segmSIeG9e1tI8mlVbWnFS6o1fZlPXALwPyFlSI/m', 'peserta', NULL, '', '2025-03-09 20:13:24', '2025-03-09 20:17:32'),
(9, 'Reza Rahadian', '', 'reza@gmail.com', NULL, '$2y$12$ynmphVwhgnTLDHCdLDT9JOIsllzGWVghMsm6wdtyVWwuse/oOi1mi', 'peserta', NULL, '', '2025-03-26 05:33:33', '2025-03-26 05:33:33'),
(10, 'Joko Anwar', '', 'jokoanwar@gmail.com', NULL, '$2y$12$ynmphVwhgnTLDHCdLDT9JOIsllzGWVghMsm6wdtyVWwuse/oOi1mi', 'peserta', NULL, '', '2025-03-26 05:35:16', '2025-03-26 05:35:16'),
(13, 'Buddy Barnes', '', 'maingamej69@gmail.com', NULL, '$2y$12$z95YVGU/W8RDPXfAdY6k6uuwEh4OOLxOeROlc7szZb6cajVZmHNdm', 'peserta', NULL, '', '2025-03-26 23:30:19', '2025-03-26 23:30:19'),
(14, 'John Pattikayhatu', '', 'pattikayhatuj@gmail.com', NULL, '$2y$12$0BjcSj8UKF6j4UuSQHLC1eO6eqWkmyT5iAO9PIAuB.SdMNJSxeulC', 'peserta', NULL, 'i38twyRZmWsAo7m5rd0LIBJ25e7K07SdO2D75YDxTE19bN3KUBMXYpYifOdJXkQv', '2025-03-27 01:05:11', '2025-04-13 13:08:25'),
(15, 'debora', 'deborastc', 'debora@gmail.com', NULL, '$2y$12$nZQex5ou232FYEZgOq3QcepQNmntF.Z2Hrv1W.bjzKDJlGn5I2X1e', 'admin', NULL, '', NULL, '2025-04-12 08:05:58'),
(18, 'test', NULL, 'test@gmail.com', NULL, '$2y$12$QeZOiTKtUgiW3lkTJaPu4OFBzChGLV5XjwN47Jk.YismrGrjJqGmW', 'peserta', NULL, NULL, '2025-04-13 09:28:35', '2025-04-13 09:28:35'),
(19, 'test3', NULL, 'test3@gmail.com', NULL, '$2y$12$7kx1.LY0JcIYq81t1FHKOORj2A.FaQCbbtjHZQ3zWXYWhisjUKFlW', 'peserta', NULL, NULL, '2025-04-13 20:39:49', '2025-04-13 20:39:49'),
(20, 'Juan Sebastian', NULL, 'jd.official31@gmail.com', NULL, '$2y$12$26zTkTtRqNbXtVHh4hs9Be4zjxJ2Ye9dCgyp2HL89FUZfyp6n17GK', 'peserta', NULL, NULL, '2025-04-14 04:22:09', '2025-04-14 04:22:09'),
(21, 'Niggerballs', NULL, 'nigger@gmail.com', NULL, '$2y$12$RPph/NZsKY6iEWCmd7jP.eMKjQOut6WuEYpL0tbT60qI6Z5IMXQ0q', 'peserta', NULL, NULL, '2025-04-14 04:22:42', '2025-04-14 04:22:42'),
(22, 'NiggerRape', NULL, 'niggaballs@gmail.com', NULL, '$2y$12$5eEkVvA62zo22LghzgBZouQWMnTzFr5yJVfLqpk1vkUyb40U34NH.', 'peserta', NULL, NULL, '2025-04-14 04:25:36', '2025-04-14 04:25:36'),
(23, 'Diddy', NULL, 'diddy@gmail.com', NULL, '$2y$12$Regz7CXIZbSCdzFbPsDWhuNta/4JYrDZGWQHfVKh1.SqDvms/VJM.', 'peserta', NULL, NULL, '2025-04-14 04:34:56', '2025-04-14 04:34:56'),
(24, 'Mediya Juniandari', NULL, 'mediya.ja@satunama.org', NULL, '$2y$12$cdUb3rjUw9qHHDZrg8cTreSBi/j9TAVbA2NeYnSqzGyqvgqFVoE5m', 'peserta', NULL, NULL, '2025-04-15 23:31:17', '2025-04-15 23:31:17'),
(25, 'ccc', NULL, 'ccc@ganteng.com', NULL, '$2y$12$zCwIlN0Lpje3/JmEKm.gme00CSLjZod5uuBi85iy.wIlcODjieUQa', 'peserta', NULL, NULL, '2025-04-15 23:36:48', '2025-04-15 23:36:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assesment_peserta_permintaan`
--
ALTER TABLE `assesment_peserta_permintaan`
  ADD PRIMARY KEY (`id_peserta`),
  ADD KEY `id_permintaan` (`id_permintaan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `discussions`
--
ALTER TABLE `discussions`
  ADD PRIMARY KEY (`id_diskusi`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `discussions_files`
--
ALTER TABLE `discussions_files`
  ADD PRIMARY KEY (`id_file`),
  ADD KEY `id_diskusi` (`id_diskusi`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fasilitator_foto`
--
ALTER TABLE `fasilitator_foto`
  ADD PRIMARY KEY (`id_foto`),
  ADD KEY `id_fasilitator` (`id_fasilitator`);

--
-- Indexes for table `fasilitator_pelatihan`
--
ALTER TABLE `fasilitator_pelatihan`
  ADD PRIMARY KEY (`id_fasilitator`),
  ADD KEY `id_internal_eksternal` (`id_internal_eksternal`);

--
-- Indexes for table `form_evaluasi_konsultasi`
--
ALTER TABLE `form_evaluasi_konsultasi`
  ADD PRIMARY KEY (`id_form_evaluasi_konsultasi`),
  ADD KEY `idx_id_pelatihan_konsultasi` (`id_pelatihan_konsultasi`),
  ADD KEY `id_form_evaluasi_konsultasi` (`id_form_evaluasi_konsultasi`);

--
-- Indexes for table `form_evaluasi_permintaan`
--
ALTER TABLE `form_evaluasi_permintaan`
  ADD PRIMARY KEY (`id_form_evaluasi_permintaan`),
  ADD KEY `idx_id_permintaan` (`id_pelatihan_permintaan`),
  ADD KEY `id_form_evaluasi_permintaan` (`id_form_evaluasi_permintaan`),
  ADD KEY `id_pelatihan_permintaan` (`id_pelatihan_permintaan`);

--
-- Indexes for table `form_evaluasi_reguler`
--
ALTER TABLE `form_evaluasi_reguler`
  ADD PRIMARY KEY (`id_form_evaluasi_reguler`),
  ADD KEY `id_form_evaluasi_reguler` (`id_form_evaluasi_reguler`),
  ADD KEY `id_reguler` (`id_reguler`);

--
-- Indexes for table `form_studidampak_konsultasi`
--
ALTER TABLE `form_studidampak_konsultasi`
  ADD PRIMARY KEY (`id_form_studidampak_konsultasi`),
  ADD KEY `idx_id_pelatihan_konsultasi` (`id_pelatihan_konsultasi`),
  ADD KEY `id_pelatihan_konsultasi` (`id_pelatihan_konsultasi`);

--
-- Indexes for table `form_studidampak_permintaan`
--
ALTER TABLE `form_studidampak_permintaan`
  ADD PRIMARY KEY (`id_form_studidampak_permintaan`),
  ADD KEY `idx_id_pelatihan_permintaan` (`id_pelatihan_permintaan`),
  ADD KEY `id_pelatihan_permintaan` (`id_pelatihan_permintaan`);

--
-- Indexes for table `form_studidampak_reguler`
--
ALTER TABLE `form_studidampak_reguler`
  ADD PRIMARY KEY (`id_form_studidampak_reguler`),
  ADD KEY `id_reguler` (`id_reguler`);

--
-- Indexes for table `form_surveykepuasan_konsultasi`
--
ALTER TABLE `form_surveykepuasan_konsultasi`
  ADD PRIMARY KEY (`id_form_surveykepuasan_konsultasi`),
  ADD KEY `idx_id_pelatihan_konsultasi` (`id_pelatihan_konsultasi`),
  ADD KEY `id_pelatihan_konsultasi` (`id_pelatihan_konsultasi`);

--
-- Indexes for table `form_surveykepuasan_permintaan`
--
ALTER TABLE `form_surveykepuasan_permintaan`
  ADD PRIMARY KEY (`id_form_surveykepuasan_permintaan`),
  ADD KEY `idx_id_pelatihan_permintaan` (`id_pelatihan_permintaan`),
  ADD KEY `id_pelatihan_permintaan` (`id_pelatihan_permintaan`);

--
-- Indexes for table `form_surveykepuasan_reguler`
--
ALTER TABLE `form_surveykepuasan_reguler`
  ADD PRIMARY KEY (`id_form_surveykepuasan_reguler`),
  ADD KEY `id_reguler` (`id_reguler`);

--
-- Indexes for table `hasil_evaluasi_konsultasi`
--
ALTER TABLE `hasil_evaluasi_konsultasi`
  ADD PRIMARY KEY (`id_hasil_evaluasi_konsultasi`),
  ADD KEY `id_pelatihan_konsultasi` (`id_pelatihan_konsultasi`),
  ADD KEY `id_peserta` (`id_peserta`);

--
-- Indexes for table `hasil_evaluasi_permintaan`
--
ALTER TABLE `hasil_evaluasi_permintaan`
  ADD PRIMARY KEY (`id_hasil_evaluasi_permintaan`),
  ADD KEY `id_pelatihan_permintaan` (`id_pelatihan_permintaan`),
  ADD KEY `id_peserta` (`id_peserta`);

--
-- Indexes for table `hasil_evaluasi_reguler`
--
ALTER TABLE `hasil_evaluasi_reguler`
  ADD PRIMARY KEY (`id_hasil_evaluasi_reguler`),
  ADD KEY `id_pelatihan_reguler` (`id_pelatihan_reguler`),
  ADD KEY `id_peserta` (`id_peserta`);

--
-- Indexes for table `hasil_studidampak_konsultasi`
--
ALTER TABLE `hasil_studidampak_konsultasi`
  ADD PRIMARY KEY (`id_hasil_studidampak_konsultasi`),
  ADD KEY `id_pelatihan_konsultasi` (`id_pelatihan_konsultasi`),
  ADD KEY `id_peserta` (`id_peserta`);

--
-- Indexes for table `hasil_studidampak_permintaan`
--
ALTER TABLE `hasil_studidampak_permintaan`
  ADD PRIMARY KEY (`id_hasil_studidampak_permintaan`),
  ADD KEY `id_peserta` (`id_peserta`),
  ADD KEY `hasil_studidampak_permintaan_ibfk_1` (`id_pelatihan_permintaan`);

--
-- Indexes for table `hasil_studidampak_reguler`
--
ALTER TABLE `hasil_studidampak_reguler`
  ADD PRIMARY KEY (`id_hasil_studidampak_reguler`),
  ADD KEY `hasil_studidampak_reguler_ibfk_1` (`id_pelatihan_reguler`),
  ADD KEY `hasil_studidampak_reguler_ibfk_2` (`id_peserta`);

--
-- Indexes for table `hasil_surveykepuasan_konsultasi`
--
ALTER TABLE `hasil_surveykepuasan_konsultasi`
  ADD PRIMARY KEY (`id_hasil_surveykepuasan_konsultasi`),
  ADD KEY `id_pelatihan_konsultasi` (`id_pelatihan_konsultasi`),
  ADD KEY `id_peserta` (`id_peserta`);

--
-- Indexes for table `hasil_surveykepuasan_permintaan`
--
ALTER TABLE `hasil_surveykepuasan_permintaan`
  ADD PRIMARY KEY (`id_hasil_surveykepuasan_permintaan`),
  ADD KEY `id_peserta` (`id_peserta`),
  ADD KEY `hasil_surveykepuasan_permintaan_ibfk_1` (`id_pelatihan_permintaan`);

--
-- Indexes for table `hasil_surveykepuasan_reguler`
--
ALTER TABLE `hasil_surveykepuasan_reguler`
  ADD PRIMARY KEY (`id_hasil_surveykepuasan_reguler`),
  ADD KEY `hasil_surveykepuasan_reguler_ibfk_1` (`id_pelatihan_reguler`),
  ADD KEY `hasil_surveykepuasan_reguler_ibfk_2` (`id_peserta`);

--
-- Indexes for table `internal_eksternals`
--
ALTER TABLE `internal_eksternals`
  ADD PRIMARY KEY (`id_internal_eksternal`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kabupaten_kota`
--
ALTER TABLE `kabupaten_kota`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kabupaten_kota_ibfk_1` (`id_provinsi`);

--
-- Indexes for table `komen_diskusi`
--
ALTER TABLE `komen_diskusi`
  ADD PRIMARY KEY (`id_komen`),
  ADD KEY `id_diskusi` (`id_diskusi`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_parent` (`id_parent`);

--
-- Indexes for table `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD PRIMARY KEY (`id_konsultasi`),
  ADD KEY `id_negara` (`id_negara`),
  ADD KEY `id_provinsi` (`id_provinsi`),
  ADD KEY `id_kabupaten` (`id_kabupaten`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `konsultasi_fasilitators`
--
ALTER TABLE `konsultasi_fasilitators`
  ADD PRIMARY KEY (`id_pelatihan_fasilitator`),
  ADD KEY `konsultasi_fasilitators_ibfk_2` (`id_fasilitator`),
  ADD KEY `id_pelatihan` (`id_pelatihan`);

--
-- Indexes for table `konsultasi_files`
--
ALTER TABLE `konsultasi_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `konsultasi_files_ibfk_1` (`id_konsultasi`);

--
-- Indexes for table `konsultasi_images`
--
ALTER TABLE `konsultasi_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `konsultasi_images_ibfk_1` (`id_konsultasi`);

--
-- Indexes for table `konsultasi_pelatihan`
--
ALTER TABLE `konsultasi_pelatihan`
  ADD PRIMARY KEY (`id_pelatihan_konsultasi`),
  ADD KEY `konsultasi_pelatihan_ibfk_1` (`id_konsultasi`),
  ADD KEY `konsultasi_pelatihan_ibfk_2` (`id_tema`),
  ADD KEY `id_pelatihan_konsultasi` (`id_pelatihan_konsultasi`);

--
-- Indexes for table `konsultasi_sertifikat`
--
ALTER TABLE `konsultasi_sertifikat`
  ADD PRIMARY KEY (`id_sertifikat`),
  ADD KEY `id_pelatihan_konsultasi` (`id_pelatihan_konsultasi`),
  ADD KEY `id_peserta` (`id_peserta`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mitra`
--
ALTER TABLE `mitra`
  ADD PRIMARY KEY (`id_mitra`),
  ADD KEY `id_negara_mitra` (`id_negara_mitra`),
  ADD KEY `id_provinsi_mitra` (`id_provinsi_mitra`),
  ADD KEY `id_kabupaten_kota` (`id_kabupaten_kota`);

--
-- Indexes for table `negara`
--
ALTER TABLE `negara`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permintaan`
--
ALTER TABLE `permintaan`
  ADD PRIMARY KEY (`id_permintaan`),
  ADD KEY `permintaan_ibfk_2` (`id_mitra`),
  ADD KEY `permintaan_ibfk_3` (`id_user`),
  ADD KEY `permintaan_ibfk_1` (`id_tema`);

--
-- Indexes for table `permintaan_fasilitators`
--
ALTER TABLE `permintaan_fasilitators`
  ADD PRIMARY KEY (`id_pelatihan_fasilitator`),
  ADD KEY `id_fasilitator` (`id_fasilitator`),
  ADD KEY `id_pelatihan` (`id_pelatihan`);

--
-- Indexes for table `permintaan_files`
--
ALTER TABLE `permintaan_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permintaan_files_ibfk_1` (`id_permintaan`);

--
-- Indexes for table `permintaan_images`
--
ALTER TABLE `permintaan_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permintaan_images_ibfk_1` (`id_permintaan`);

--
-- Indexes for table `permintaan_pelatihan`
--
ALTER TABLE `permintaan_pelatihan`
  ADD PRIMARY KEY (`id_pelatihan_permintaan`),
  ADD KEY `id_tema` (`id_tema`),
  ADD KEY `permintaan_pelatihan_ibfk_1` (`id_permintaan`);

--
-- Indexes for table `permintaan_sertifikat`
--
ALTER TABLE `permintaan_sertifikat`
  ADD PRIMARY KEY (`id_sertifikat`),
  ADD KEY `id_peserta` (`id_peserta`),
  ADD KEY `id_pelatihan_permintaan` (`id_pelatihan_permintaan`);

--
-- Indexes for table `peserta_pelatihan_konsultasi`
--
ALTER TABLE `peserta_pelatihan_konsultasi`
  ADD PRIMARY KEY (`id_peserta`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `peserta_pelatihan_konsultasi_ibfk_1` (`id_pelatihan_konsultasi`);

--
-- Indexes for table `peserta_pelatihan_permintaan`
--
ALTER TABLE `peserta_pelatihan_permintaan`
  ADD PRIMARY KEY (`id_peserta`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `peserta_pelatihan_permintaan_ibfk_1` (`id_pelatihan_permintaan`);

--
-- Indexes for table `peserta_pelatihan_reguler`
--
ALTER TABLE `peserta_pelatihan_reguler`
  ADD PRIMARY KEY (`id_peserta_reguler`),
  ADD KEY `peserta_pelatihan_reguler_id_reguler_fkey` (`id_reguler`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `provinsi`
--
ALTER TABLE `provinsi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_negara` (`id_negara`);

--
-- Indexes for table `reguler`
--
ALTER TABLE `reguler`
  ADD PRIMARY KEY (`id_reguler`),
  ADD KEY `id_tema` (`id_tema`);

--
-- Indexes for table `reguler_fasilitators`
--
ALTER TABLE `reguler_fasilitators`
  ADD PRIMARY KEY (`id_pelatihan_fasilitator`),
  ADD KEY `id_fasilitator` (`id_fasilitator`),
  ADD KEY `id_pelatihan` (`id_pelatihan`);

--
-- Indexes for table `reguler_files`
--
ALTER TABLE `reguler_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_reguler` (`id_reguler`);

--
-- Indexes for table `reguler_images`
--
ALTER TABLE `reguler_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_reguler` (`id_reguler`);

--
-- Indexes for table `reguler_sertifikat`
--
ALTER TABLE `reguler_sertifikat`
  ADD PRIMARY KEY (`id_sertifikat`),
  ADD KEY `id_reguler` (`id_reguler`),
  ADD KEY `id_peserta` (`id_peserta`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `status_bayar_pelatihan`
--
ALTER TABLE `status_bayar_pelatihan`
  ADD PRIMARY KEY (`id_status`),
  ADD KEY `fk_status_reguler` (`id_reguler`),
  ADD KEY `fk_status_peserta` (`id_peserta`);

--
-- Indexes for table `tema`
--
ALTER TABLE `tema`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assesment_peserta_permintaan`
--
ALTER TABLE `assesment_peserta_permintaan`
  MODIFY `id_peserta` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `discussions`
--
ALTER TABLE `discussions`
  MODIFY `id_diskusi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `discussions_files`
--
ALTER TABLE `discussions_files`
  MODIFY `id_file` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fasilitator_foto`
--
ALTER TABLE `fasilitator_foto`
  MODIFY `id_foto` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `fasilitator_pelatihan`
--
ALTER TABLE `fasilitator_pelatihan`
  MODIFY `id_fasilitator` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `form_evaluasi_konsultasi`
--
ALTER TABLE `form_evaluasi_konsultasi`
  MODIFY `id_form_evaluasi_konsultasi` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `form_evaluasi_permintaan`
--
ALTER TABLE `form_evaluasi_permintaan`
  MODIFY `id_form_evaluasi_permintaan` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `form_evaluasi_reguler`
--
ALTER TABLE `form_evaluasi_reguler`
  MODIFY `id_form_evaluasi_reguler` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `form_studidampak_konsultasi`
--
ALTER TABLE `form_studidampak_konsultasi`
  MODIFY `id_form_studidampak_konsultasi` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `form_studidampak_permintaan`
--
ALTER TABLE `form_studidampak_permintaan`
  MODIFY `id_form_studidampak_permintaan` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `form_studidampak_reguler`
--
ALTER TABLE `form_studidampak_reguler`
  MODIFY `id_form_studidampak_reguler` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `form_surveykepuasan_konsultasi`
--
ALTER TABLE `form_surveykepuasan_konsultasi`
  MODIFY `id_form_surveykepuasan_konsultasi` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `form_surveykepuasan_permintaan`
--
ALTER TABLE `form_surveykepuasan_permintaan`
  MODIFY `id_form_surveykepuasan_permintaan` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `form_surveykepuasan_reguler`
--
ALTER TABLE `form_surveykepuasan_reguler`
  MODIFY `id_form_surveykepuasan_reguler` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hasil_evaluasi_konsultasi`
--
ALTER TABLE `hasil_evaluasi_konsultasi`
  MODIFY `id_hasil_evaluasi_konsultasi` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hasil_evaluasi_permintaan`
--
ALTER TABLE `hasil_evaluasi_permintaan`
  MODIFY `id_hasil_evaluasi_permintaan` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hasil_evaluasi_reguler`
--
ALTER TABLE `hasil_evaluasi_reguler`
  MODIFY `id_hasil_evaluasi_reguler` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hasil_studidampak_konsultasi`
--
ALTER TABLE `hasil_studidampak_konsultasi`
  MODIFY `id_hasil_studidampak_konsultasi` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hasil_studidampak_permintaan`
--
ALTER TABLE `hasil_studidampak_permintaan`
  MODIFY `id_hasil_studidampak_permintaan` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hasil_studidampak_reguler`
--
ALTER TABLE `hasil_studidampak_reguler`
  MODIFY `id_hasil_studidampak_reguler` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hasil_surveykepuasan_konsultasi`
--
ALTER TABLE `hasil_surveykepuasan_konsultasi`
  MODIFY `id_hasil_surveykepuasan_konsultasi` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hasil_surveykepuasan_permintaan`
--
ALTER TABLE `hasil_surveykepuasan_permintaan`
  MODIFY `id_hasil_surveykepuasan_permintaan` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hasil_surveykepuasan_reguler`
--
ALTER TABLE `hasil_surveykepuasan_reguler`
  MODIFY `id_hasil_surveykepuasan_reguler` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `internal_eksternals`
--
ALTER TABLE `internal_eksternals`
  MODIFY `id_internal_eksternal` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kabupaten_kota`
--
ALTER TABLE `kabupaten_kota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1811;

--
-- AUTO_INCREMENT for table `komen_diskusi`
--
ALTER TABLE `komen_diskusi`
  MODIFY `id_komen` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `konsultasi`
--
ALTER TABLE `konsultasi`
  MODIFY `id_konsultasi` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `konsultasi_fasilitators`
--
ALTER TABLE `konsultasi_fasilitators`
  MODIFY `id_pelatihan_fasilitator` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `konsultasi_files`
--
ALTER TABLE `konsultasi_files`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `konsultasi_images`
--
ALTER TABLE `konsultasi_images`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `konsultasi_pelatihan`
--
ALTER TABLE `konsultasi_pelatihan`
  MODIFY `id_pelatihan_konsultasi` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `konsultasi_sertifikat`
--
ALTER TABLE `konsultasi_sertifikat`
  MODIFY `id_sertifikat` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mitra`
--
ALTER TABLE `mitra`
  MODIFY `id_mitra` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=189;

--
-- AUTO_INCREMENT for table `negara`
--
ALTER TABLE `negara`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;

--
-- AUTO_INCREMENT for table `permintaan`
--
ALTER TABLE `permintaan`
  MODIFY `id_permintaan` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `permintaan_fasilitators`
--
ALTER TABLE `permintaan_fasilitators`
  MODIFY `id_pelatihan_fasilitator` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `permintaan_files`
--
ALTER TABLE `permintaan_files`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `permintaan_images`
--
ALTER TABLE `permintaan_images`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permintaan_pelatihan`
--
ALTER TABLE `permintaan_pelatihan`
  MODIFY `id_pelatihan_permintaan` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `permintaan_sertifikat`
--
ALTER TABLE `permintaan_sertifikat`
  MODIFY `id_sertifikat` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `peserta_pelatihan_konsultasi`
--
ALTER TABLE `peserta_pelatihan_konsultasi`
  MODIFY `id_peserta` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `peserta_pelatihan_permintaan`
--
ALTER TABLE `peserta_pelatihan_permintaan`
  MODIFY `id_peserta` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `peserta_pelatihan_reguler`
--
ALTER TABLE `peserta_pelatihan_reguler`
  MODIFY `id_peserta_reguler` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `reguler`
--
ALTER TABLE `reguler`
  MODIFY `id_reguler` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `reguler_fasilitators`
--
ALTER TABLE `reguler_fasilitators`
  MODIFY `id_pelatihan_fasilitator` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `reguler_files`
--
ALTER TABLE `reguler_files`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reguler_images`
--
ALTER TABLE `reguler_images`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `reguler_sertifikat`
--
ALTER TABLE `reguler_sertifikat`
  MODIFY `id_sertifikat` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `status_bayar_pelatihan`
--
ALTER TABLE `status_bayar_pelatihan`
  MODIFY `id_status` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tema`
--
ALTER TABLE `tema`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assesment_peserta_permintaan`
--
ALTER TABLE `assesment_peserta_permintaan`
  ADD CONSTRAINT `assesment_peserta_permintaan_ibfk_1` FOREIGN KEY (`id_permintaan`) REFERENCES `permintaan` (`id_permintaan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `assesment_peserta_permintaan_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `discussions`
--
ALTER TABLE `discussions`
  ADD CONSTRAINT `discussions_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `discussions_files`
--
ALTER TABLE `discussions_files`
  ADD CONSTRAINT `discussions_files_ibfk_1` FOREIGN KEY (`id_diskusi`) REFERENCES `discussions` (`id_diskusi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fasilitator_foto`
--
ALTER TABLE `fasilitator_foto`
  ADD CONSTRAINT `fasilitator_foto_ibfk_1` FOREIGN KEY (`id_fasilitator`) REFERENCES `fasilitator_pelatihan` (`id_fasilitator`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fasilitator_pelatihan`
--
ALTER TABLE `fasilitator_pelatihan`
  ADD CONSTRAINT `fasilitator_pelatihan_ibfk_1` FOREIGN KEY (`id_internal_eksternal`) REFERENCES `internal_eksternals` (`id_internal_eksternal`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `form_evaluasi_konsultasi`
--
ALTER TABLE `form_evaluasi_konsultasi`
  ADD CONSTRAINT `form_evaluasi_konsultasi_ibfk_1` FOREIGN KEY (`id_pelatihan_konsultasi`) REFERENCES `konsultasi_pelatihan` (`id_pelatihan_konsultasi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `form_evaluasi_permintaan`
--
ALTER TABLE `form_evaluasi_permintaan`
  ADD CONSTRAINT `form_evaluasi_permintaan_ibfk_1` FOREIGN KEY (`id_pelatihan_permintaan`) REFERENCES `permintaan_pelatihan` (`id_pelatihan_permintaan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `form_evaluasi_reguler`
--
ALTER TABLE `form_evaluasi_reguler`
  ADD CONSTRAINT `form_evaluasi_reguler_ibfk_1` FOREIGN KEY (`id_reguler`) REFERENCES `reguler` (`id_reguler`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `form_studidampak_konsultasi`
--
ALTER TABLE `form_studidampak_konsultasi`
  ADD CONSTRAINT `form_studidampak_konsultasi_ibfk_1` FOREIGN KEY (`id_pelatihan_konsultasi`) REFERENCES `konsultasi_pelatihan` (`id_pelatihan_konsultasi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `form_studidampak_permintaan`
--
ALTER TABLE `form_studidampak_permintaan`
  ADD CONSTRAINT `form_studidampak_permintaan_ibfk_1` FOREIGN KEY (`id_pelatihan_permintaan`) REFERENCES `permintaan_pelatihan` (`id_pelatihan_permintaan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `form_studidampak_reguler`
--
ALTER TABLE `form_studidampak_reguler`
  ADD CONSTRAINT `form_studidampak_reguler_ibfk_1` FOREIGN KEY (`id_reguler`) REFERENCES `reguler` (`id_reguler`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `form_surveykepuasan_konsultasi`
--
ALTER TABLE `form_surveykepuasan_konsultasi`
  ADD CONSTRAINT `form_surveykepuasan_konsultasi_ibfk_1` FOREIGN KEY (`id_pelatihan_konsultasi`) REFERENCES `konsultasi_pelatihan` (`id_pelatihan_konsultasi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `form_surveykepuasan_permintaan`
--
ALTER TABLE `form_surveykepuasan_permintaan`
  ADD CONSTRAINT `form_surveykepuasan_permintaan_ibfk_1` FOREIGN KEY (`id_pelatihan_permintaan`) REFERENCES `permintaan_pelatihan` (`id_pelatihan_permintaan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `form_surveykepuasan_reguler`
--
ALTER TABLE `form_surveykepuasan_reguler`
  ADD CONSTRAINT `form_surveykepuasan_reguler_ibfk_1` FOREIGN KEY (`id_reguler`) REFERENCES `reguler` (`id_reguler`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hasil_evaluasi_konsultasi`
--
ALTER TABLE `hasil_evaluasi_konsultasi`
  ADD CONSTRAINT `hasil_evaluasi_konsultasi_ibfk_1` FOREIGN KEY (`id_pelatihan_konsultasi`) REFERENCES `konsultasi_pelatihan` (`id_pelatihan_konsultasi`),
  ADD CONSTRAINT `hasil_evaluasi_konsultasi_ibfk_2` FOREIGN KEY (`id_peserta`) REFERENCES `peserta_pelatihan_konsultasi` (`id_peserta`);

--
-- Constraints for table `hasil_evaluasi_permintaan`
--
ALTER TABLE `hasil_evaluasi_permintaan`
  ADD CONSTRAINT `hasil_evaluasi_permintaan_ibfk_1` FOREIGN KEY (`id_pelatihan_permintaan`) REFERENCES `permintaan_pelatihan` (`id_pelatihan_permintaan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hasil_evaluasi_permintaan_ibfk_2` FOREIGN KEY (`id_peserta`) REFERENCES `peserta_pelatihan_permintaan` (`id_peserta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hasil_evaluasi_reguler`
--
ALTER TABLE `hasil_evaluasi_reguler`
  ADD CONSTRAINT `hasil_evaluasi_reguler_ibfk_1` FOREIGN KEY (`id_pelatihan_reguler`) REFERENCES `reguler` (`id_reguler`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hasil_evaluasi_reguler_ibfk_2` FOREIGN KEY (`id_peserta`) REFERENCES `peserta_pelatihan_reguler` (`id_peserta_reguler`);

--
-- Constraints for table `hasil_studidampak_konsultasi`
--
ALTER TABLE `hasil_studidampak_konsultasi`
  ADD CONSTRAINT `hasil_studidampak_konsultasi_ibfk_1` FOREIGN KEY (`id_pelatihan_konsultasi`) REFERENCES `konsultasi_pelatihan` (`id_pelatihan_konsultasi`),
  ADD CONSTRAINT `hasil_studidampak_konsultasi_ibfk_2` FOREIGN KEY (`id_peserta`) REFERENCES `peserta_pelatihan_konsultasi` (`id_peserta`);

--
-- Constraints for table `hasil_studidampak_permintaan`
--
ALTER TABLE `hasil_studidampak_permintaan`
  ADD CONSTRAINT `hasil_studidampak_permintaan_ibfk_1` FOREIGN KEY (`id_pelatihan_permintaan`) REFERENCES `permintaan_pelatihan` (`id_pelatihan_permintaan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hasil_studidampak_permintaan_ibfk_2` FOREIGN KEY (`id_peserta`) REFERENCES `peserta_pelatihan_permintaan` (`id_peserta`);

--
-- Constraints for table `hasil_studidampak_reguler`
--
ALTER TABLE `hasil_studidampak_reguler`
  ADD CONSTRAINT `hasil_studidampak_reguler_ibfk_1` FOREIGN KEY (`id_pelatihan_reguler`) REFERENCES `reguler` (`id_reguler`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hasil_studidampak_reguler_ibfk_2` FOREIGN KEY (`id_peserta`) REFERENCES `peserta_pelatihan_reguler` (`id_peserta_reguler`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hasil_surveykepuasan_konsultasi`
--
ALTER TABLE `hasil_surveykepuasan_konsultasi`
  ADD CONSTRAINT `hasil_surveykepuasan_konsultasi_ibfk_1` FOREIGN KEY (`id_pelatihan_konsultasi`) REFERENCES `konsultasi_pelatihan` (`id_pelatihan_konsultasi`),
  ADD CONSTRAINT `hasil_surveykepuasan_konsultasi_ibfk_2` FOREIGN KEY (`id_peserta`) REFERENCES `peserta_pelatihan_konsultasi` (`id_peserta`);

--
-- Constraints for table `hasil_surveykepuasan_permintaan`
--
ALTER TABLE `hasil_surveykepuasan_permintaan`
  ADD CONSTRAINT `hasil_surveykepuasan_permintaan_ibfk_1` FOREIGN KEY (`id_pelatihan_permintaan`) REFERENCES `permintaan_pelatihan` (`id_pelatihan_permintaan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hasil_surveykepuasan_permintaan_ibfk_2` FOREIGN KEY (`id_peserta`) REFERENCES `peserta_pelatihan_permintaan` (`id_peserta`);

--
-- Constraints for table `hasil_surveykepuasan_reguler`
--
ALTER TABLE `hasil_surveykepuasan_reguler`
  ADD CONSTRAINT `hasil_surveykepuasan_reguler_ibfk_1` FOREIGN KEY (`id_pelatihan_reguler`) REFERENCES `reguler` (`id_reguler`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hasil_surveykepuasan_reguler_ibfk_2` FOREIGN KEY (`id_peserta`) REFERENCES `peserta_pelatihan_reguler` (`id_peserta_reguler`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kabupaten_kota`
--
ALTER TABLE `kabupaten_kota`
  ADD CONSTRAINT `kabupaten_kota_ibfk_1` FOREIGN KEY (`id_provinsi`) REFERENCES `provinsi` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `komen_diskusi`
--
ALTER TABLE `komen_diskusi`
  ADD CONSTRAINT `komen_diskusi_ibfk_1` FOREIGN KEY (`id_diskusi`) REFERENCES `discussions` (`id_diskusi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `komen_diskusi_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `komen_diskusi_ibfk_3` FOREIGN KEY (`id_parent`) REFERENCES `komen_diskusi` (`id_komen`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD CONSTRAINT `konsultasi_ibfk_1` FOREIGN KEY (`id_negara`) REFERENCES `negara` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `konsultasi_ibfk_2` FOREIGN KEY (`id_provinsi`) REFERENCES `provinsi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `konsultasi_ibfk_3` FOREIGN KEY (`id_kabupaten`) REFERENCES `kabupaten_kota` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `konsultasi_ibfk_4` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `konsultasi_fasilitators`
--
ALTER TABLE `konsultasi_fasilitators`
  ADD CONSTRAINT `konsultasi_fasilitators_ibfk_2` FOREIGN KEY (`id_fasilitator`) REFERENCES `fasilitator_pelatihan` (`id_fasilitator`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `konsultasi_fasilitators_ibfk_3` FOREIGN KEY (`id_pelatihan`) REFERENCES `konsultasi_pelatihan` (`id_pelatihan_konsultasi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `konsultasi_files`
--
ALTER TABLE `konsultasi_files`
  ADD CONSTRAINT `konsultasi_files_ibfk_1` FOREIGN KEY (`id_konsultasi`) REFERENCES `konsultasi_pelatihan` (`id_pelatihan_konsultasi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `konsultasi_images`
--
ALTER TABLE `konsultasi_images`
  ADD CONSTRAINT `konsultasi_images_ibfk_1` FOREIGN KEY (`id_konsultasi`) REFERENCES `konsultasi` (`id_konsultasi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `konsultasi_pelatihan`
--
ALTER TABLE `konsultasi_pelatihan`
  ADD CONSTRAINT `konsultasi_pelatihan_ibfk_1` FOREIGN KEY (`id_konsultasi`) REFERENCES `konsultasi` (`id_konsultasi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `konsultasi_pelatihan_ibfk_2` FOREIGN KEY (`id_tema`) REFERENCES `tema` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `konsultasi_sertifikat`
--
ALTER TABLE `konsultasi_sertifikat`
  ADD CONSTRAINT `konsultasi_sertifikat_ibfk_1` FOREIGN KEY (`id_pelatihan_konsultasi`) REFERENCES `konsultasi_pelatihan` (`id_pelatihan_konsultasi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `konsultasi_sertifikat_ibfk_2` FOREIGN KEY (`id_peserta`) REFERENCES `peserta_pelatihan_konsultasi` (`id_peserta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mitra`
--
ALTER TABLE `mitra`
  ADD CONSTRAINT `mitra_ibfk_1` FOREIGN KEY (`id_negara_mitra`) REFERENCES `negara` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mitra_ibfk_2` FOREIGN KEY (`id_provinsi_mitra`) REFERENCES `provinsi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mitra_ibfk_3` FOREIGN KEY (`id_kabupaten_kota`) REFERENCES `kabupaten_kota` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permintaan`
--
ALTER TABLE `permintaan`
  ADD CONSTRAINT `permintaan_ibfk_1` FOREIGN KEY (`id_tema`) REFERENCES `tema` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `permintaan_ibfk_2` FOREIGN KEY (`id_mitra`) REFERENCES `mitra` (`id_mitra`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `permintaan_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `permintaan_fasilitators`
--
ALTER TABLE `permintaan_fasilitators`
  ADD CONSTRAINT `permintaan_fasilitators_ibfk_2` FOREIGN KEY (`id_fasilitator`) REFERENCES `fasilitator_pelatihan` (`id_fasilitator`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `permintaan_fasilitators_ibfk_3` FOREIGN KEY (`id_pelatihan`) REFERENCES `permintaan_pelatihan` (`id_pelatihan_permintaan`);

--
-- Constraints for table `permintaan_files`
--
ALTER TABLE `permintaan_files`
  ADD CONSTRAINT `permintaan_files_ibfk_1` FOREIGN KEY (`id_permintaan`) REFERENCES `permintaan_pelatihan` (`id_pelatihan_permintaan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permintaan_images`
--
ALTER TABLE `permintaan_images`
  ADD CONSTRAINT `permintaan_images_ibfk_1` FOREIGN KEY (`id_permintaan`) REFERENCES `permintaan` (`id_permintaan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permintaan_pelatihan`
--
ALTER TABLE `permintaan_pelatihan`
  ADD CONSTRAINT `permintaan_pelatihan_ibfk_1` FOREIGN KEY (`id_permintaan`) REFERENCES `permintaan` (`id_permintaan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permintaan_pelatihan_ibfk_2` FOREIGN KEY (`id_tema`) REFERENCES `tema` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `permintaan_sertifikat`
--
ALTER TABLE `permintaan_sertifikat`
  ADD CONSTRAINT `permintaan_sertifikat_ibfk_1` FOREIGN KEY (`id_peserta`) REFERENCES `peserta_pelatihan_permintaan` (`id_peserta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permintaan_sertifikat_ibfk_2` FOREIGN KEY (`id_pelatihan_permintaan`) REFERENCES `permintaan_pelatihan` (`id_pelatihan_permintaan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `peserta_pelatihan_konsultasi`
--
ALTER TABLE `peserta_pelatihan_konsultasi`
  ADD CONSTRAINT `peserta_pelatihan_konsultasi_ibfk_1` FOREIGN KEY (`id_pelatihan_konsultasi`) REFERENCES `konsultasi_pelatihan` (`id_pelatihan_konsultasi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `peserta_pelatihan_konsultasi_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `peserta_pelatihan_permintaan`
--
ALTER TABLE `peserta_pelatihan_permintaan`
  ADD CONSTRAINT `peserta_pelatihan_permintaan_ibfk_1` FOREIGN KEY (`id_pelatihan_permintaan`) REFERENCES `permintaan_pelatihan` (`id_pelatihan_permintaan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `peserta_pelatihan_permintaan_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `peserta_pelatihan_reguler`
--
ALTER TABLE `peserta_pelatihan_reguler`
  ADD CONSTRAINT `peserta_pelatihan_reguler_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `peserta_pelatihan_reguler_id_reguler_fkey` FOREIGN KEY (`id_reguler`) REFERENCES `reguler` (`id_reguler`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `provinsi`
--
ALTER TABLE `provinsi`
  ADD CONSTRAINT `provinsi_ibfk_1` FOREIGN KEY (`id_negara`) REFERENCES `negara` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `reguler`
--
ALTER TABLE `reguler`
  ADD CONSTRAINT `reguler_ibfk_1` FOREIGN KEY (`id_tema`) REFERENCES `tema` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reguler_fasilitators`
--
ALTER TABLE `reguler_fasilitators`
  ADD CONSTRAINT `reguler_fasilitators_ibfk_1` FOREIGN KEY (`id_fasilitator`) REFERENCES `fasilitator_pelatihan` (`id_fasilitator`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reguler_fasilitators_ibfk_2` FOREIGN KEY (`id_pelatihan`) REFERENCES `reguler` (`id_reguler`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reguler_files`
--
ALTER TABLE `reguler_files`
  ADD CONSTRAINT `reguler_files_ibfk_1` FOREIGN KEY (`id_reguler`) REFERENCES `reguler` (`id_reguler`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reguler_images`
--
ALTER TABLE `reguler_images`
  ADD CONSTRAINT `reguler_images_ibfk_1` FOREIGN KEY (`id_reguler`) REFERENCES `reguler` (`id_reguler`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reguler_sertifikat`
--
ALTER TABLE `reguler_sertifikat`
  ADD CONSTRAINT `reguler_sertifikat_ibfk_1` FOREIGN KEY (`id_reguler`) REFERENCES `reguler` (`id_reguler`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reguler_sertifikat_ibfk_2` FOREIGN KEY (`id_peserta`) REFERENCES `peserta_pelatihan_reguler` (`id_peserta_reguler`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `status_bayar_pelatihan`
--
ALTER TABLE `status_bayar_pelatihan`
  ADD CONSTRAINT `fk_status_peserta` FOREIGN KEY (`id_peserta`) REFERENCES `peserta_pelatihan_reguler` (`id_peserta_reguler`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_status_reguler` FOREIGN KEY (`id_reguler`) REFERENCES `reguler` (`id_reguler`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
