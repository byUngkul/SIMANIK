-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 22 Agu 2017 pada 09.31
-- Versi Server: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simanik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `level`, `created_at`, `updated_at`, `remember_token`) VALUES
(1, 'admin', '$2y$10$BBJrdZ/QTX7V8CSdKZetT.V447hYpZ39vblYMrE33ldNzOxc4.15C', 'admin', '2017-08-18 02:51:09', '2017-08-18 02:51:09', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `apotekers`
--

CREATE TABLE `apotekers` (
  `id` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `level` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `apotekers`
--

INSERT INTO `apotekers` (`id`, `username`, `password`, `nama`, `alamat`, `tgl_lahir`, `level`, `photo`, `created_at`, `updated_at`, `remember_token`) VALUES
('AP001', 'apoteker', '$2y$10$ZK/nPfKEnLmFktx1IOxgx.a83rBx1SJBgz0ibeI7NlWQjobtCHuw.', 'apoteker', 'sidoarjo', '1989-06-25', 'apoteker', 'user-apoteker.jpg', '2017-08-18 02:55:32', '2017-08-18 02:55:32', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokters`
--

CREATE TABLE `dokters` (
  `id` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `spesialis_id` smallint(6) NOT NULL,
  `level` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `dokters`
--

INSERT INTO `dokters` (`id`, `username`, `password`, `nama`, `alamat`, `tgl_lahir`, `spesialis_id`, `level`, `photo`, `created_at`, `updated_at`, `remember_token`) VALUES
('DK001', 'dokter', '$2y$10$LDM9s5vPllMmoWa/trmGw.2Grdtp3C22flp7W18rjpgmTPFmGQWfO', 'dokter', 'sidoarjo', '1993-07-20', 1, 'dokter', 'user-dokter.jpg', '2017-08-18 02:54:28', '2017-08-18 02:54:28', NULL),
('DK002', 'oz', '$2y$10$W/j0bFXHdCmnISRzMC2g/.upd6XKofnQ3bcq.MMXRcJ8jFOURVBtu', 'dr. oz', 'jl. mayjend sungkono no 10 Mojokerto', '1999-08-03', 2, 'dokter', 'user-dokter.jpg', '2017-08-21 13:55:28', '2017-08-21 13:55:28', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_obat`
--

CREATE TABLE `kategori_obat` (
  `id` int(10) UNSIGNED NOT NULL,
  `kategori` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategori_obat`
--

INSERT INTO `kategori_obat` (`id`, `kategori`, `created_at`, `updated_at`) VALUES
(1, 'sakit kepala', '2017-08-18 03:20:52', '2017-08-18 04:11:44'),
(2, 'demam', '2017-08-21 07:07:55', '2017-08-21 07:07:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `obats`
--

CREATE TABLE `obats` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kandungan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori_id` int(10) UNSIGNED NOT NULL,
  `harga` double(8,2) NOT NULL,
  `status` enum('ada','habis') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `obats`
--

INSERT INTO `obats` (`id`, `nama`, `kandungan`, `kategori_id`, `harga`, `status`, `created_at`, `updated_at`) VALUES
(1, 'mixagrip', 'amoxilin', 1, 2000.00, 'habis', '2017-08-18 03:21:02', '2017-08-22 03:30:14'),
(2, 'bodrex', 'paracetamol', 2, 2000.00, 'ada', '2017-08-21 07:08:42', '2017-08-21 07:08:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasiens`
--

CREATE TABLE `pasiens` (
  `id` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('pria','wanita') COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `telp` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pekerjaan` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('antri','obat','selesai') COLLATE utf8mb4_unicode_ci NOT NULL,
  `layanan_dokter` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pasiens`
--

INSERT INTO `pasiens` (`id`, `nama`, `jenis_kelamin`, `alamat`, `tgl_lahir`, `telp`, `pekerjaan`, `status`, `layanan_dokter`, `created_at`, `updated_at`) VALUES
('PS0001', 'opick', 'pria', 'jl. hasanuddin no.40 Jakarta', '1998-06-23', '085707799317', 'penyanyi', 'selesai', 'DK001', '2017-08-22 04:22:18', '2017-08-22 04:32:39'),
('PS0002', 'cesar', 'pria', 'jl. imam bonjol no.40 jakarta', '1994-10-20', '08130305758', 'berjoget', 'selesai', 'DK002', '2017-08-22 04:23:04', '2017-08-22 04:30:23'),
('PS0003', 'cesar', 'pria', 'jl. imam bonjol no.40 jakarta', '1994-10-20', '08130305758', 'berjoget', 'selesai', 'DK002', '2017-08-22 04:37:02', '2017-08-22 04:39:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `reseps`
--

CREATE TABLE `reseps` (
  `id` int(11) NOT NULL,
  `dokter_id` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `obat_id` smallint(6) NOT NULL,
  `pasien_id` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` smallint(2) NOT NULL,
  `status` enum('belum','selesai','','') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `reseps`
--

INSERT INTO `reseps` (`id`, `dokter_id`, `obat_id`, `pasien_id`, `keterangan`, `jumlah`, `status`, `created_at`, `updated_at`) VALUES
(1, 'DK001', 1, 'PS0001', 'd.d', 2, 'selesai', '2017-08-22 04:24:49', '2017-08-22 04:32:39'),
(2, 'DK002', 1, 'PS0002', 'd.d', 1, 'selesai', '2017-08-22 04:28:29', '2017-08-22 04:30:23'),
(3, 'DK002', 1, 'PS0003', 'd.d', 1, 'selesai', '2017-08-22 04:38:48', '2017-08-22 04:39:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `resepsionists`
--

CREATE TABLE `resepsionists` (
  `id` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `level` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `resepsionists`
--

INSERT INTO `resepsionists` (`id`, `username`, `password`, `nama`, `alamat`, `tgl_lahir`, `level`, `photo`, `created_at`, `updated_at`, `remember_token`) VALUES
('RS001', 'resepsionist', '$2y$10$912Ux6ySgiMdtX2MxAGk6uvKNKPRZxJTD/3I0gmJB70vePvmtDtnm', 'resepsionist', 'sidoarjo', '1993-08-24', 'resepsionist', 'user-resepsionist.jpg', '2017-08-18 02:53:13', '2017-08-18 02:53:13', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rk_medis`
--

CREATE TABLE `rk_medis` (
  `id` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pasien_id` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `dokter_id` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `diagnosa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keluhan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `anamnesis` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tindakan` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `alergi_obat` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bb` double(8,2) NOT NULL,
  `tb` double(8,2) NOT NULL,
  `tensi` double(8,2) NOT NULL,
  `bw` enum('ya','tidak') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `rk_medis`
--

INSERT INTO `rk_medis` (`id`, `pasien_id`, `nama`, `tgl_lahir`, `dokter_id`, `diagnosa`, `keluhan`, `anamnesis`, `tindakan`, `keterangan`, `alergi_obat`, `bb`, `tb`, `tensi`, `bw`, `created_at`, `updated_at`) VALUES
('RK0001', 'PS0001', 'opick', '1998-06-23', 'DK001', 'sakit kepala', 'pusing', 'pusing selama 3 hari', 'umum', 'banyak istirahat', 'tidak', 80.00, 189.00, 110.00, 'tidak', '2017-08-22 04:24:48', '2017-08-22 04:24:48'),
('RK0002', 'PS0002', 'cesar', '1994-10-20', 'DK002', 'sakit kepala', 'pusing mual', 'pusing selama seminggu', 'umum', 'jl. benyamin no. 40 jakarta', 'tidak', 80.00, 189.00, 120.00, 'tidak', '2017-08-22 04:28:28', '2017-08-22 04:28:28'),
('RK0003', 'PS0003', 'cesar', '1994-10-20', 'DK002', 'sakit kepala', 'pusing', 'pusing selama seminggu', 'umum', 'banyak istirahat', 'tidak', 90.00, 189.00, 120.00, 'tidak', '2017-08-22 04:38:48', '2017-08-22 04:38:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `spesialis`
--

CREATE TABLE `spesialis` (
  `id` int(10) UNSIGNED NOT NULL,
  `spesialis` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `spesialis`
--

INSERT INTO `spesialis` (`id`, `spesialis`, `created_at`, `updated_at`) VALUES
(1, 'gigi', '2017-08-18 02:54:22', '2017-08-18 02:54:22'),
(2, 'organ dalam', '2017-08-21 13:55:08', '2017-08-21 13:55:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apotekers`
--
ALTER TABLE `apotekers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dokters`
--
ALTER TABLE `dokters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_obat`
--
ALTER TABLE `kategori_obat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `obats`
--
ALTER TABLE `obats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pasiens`
--
ALTER TABLE `pasiens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reseps`
--
ALTER TABLE `reseps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resepsionists`
--
ALTER TABLE `resepsionists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rk_medis`
--
ALTER TABLE `rk_medis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `spesialis`
--
ALTER TABLE `spesialis`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `kategori_obat`
--
ALTER TABLE `kategori_obat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `obats`
--
ALTER TABLE `obats`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `reseps`
--
ALTER TABLE `reseps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `spesialis`
--
ALTER TABLE `spesialis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
