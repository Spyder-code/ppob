-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Feb 2022 pada 16.02
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ppob`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2020_10_03_125517_create_table_nominal', 1),
(6, '2020_10_03_125541_create_table_pulsa', 1),
(7, '2020_10_03_125555_create_table_kategori', 1),
(8, '2020_10_03_125611_create_table_data', 1),
(9, '2020_10_03_125622_create_table_paket_data', 1),
(10, '2020_10_03_125637_create_table_pln', 1),
(11, '2020_10_03_125655_create_table_nominal_pln', 1),
(12, '2020_10_03_133410_create_table_provider', 1),
(13, '2020_10_04_054139_create_table_pln_customer', 1),
(14, '2021_11_21_172516_create_riwayat_saldos_table', 1),
(15, '2021_11_24_182147_create_request_saldos_table', 1),
(16, '2021_12_11_065435_create_setting_websites_table', 1),
(17, '2022_02_03_164047_create_rewards_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `request_saldos`
--

CREATE TABLE `request_saldos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `bukti` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nominal` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rewards`
--

CREATE TABLE `rewards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `outlet_id` bigint(20) UNSIGNED NOT NULL,
  `reward` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_saldos`
--

CREATE TABLE `riwayat_saldos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `saldoAfter` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `saldoPlus` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `saldoNow` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `setting_websites`
--

CREATE TABLE `setting_websites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `favicon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `app_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `setting_websites`
--

INSERT INTO `setting_websites` (`id`, `favicon`, `logo`, `app_name`, `footer_name`, `created_at`, `updated_at`) VALUES
(1, '', '', 'PT Hana Patria Sejati', 'PT Hana Patria Sejati', '2022-02-03 10:56:05', '2022-02-03 10:56:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `table_kategori`
--

CREATE TABLE `table_kategori` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `table_kategori`
--

INSERT INTO `table_kategori` (`id`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Pulsa', NULL, NULL),
(2, 'Paket Data', NULL, NULL),
(3, 'PLN', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `table_nominal_data`
--

CREATE TABLE `table_nominal_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_paket` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_provider` int(11) NOT NULL,
  `fixed_price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `table_nominal_data`
--

INSERT INTO `table_nominal_data` (`id`, `nama_paket`, `id_provider`, `fixed_price`, `created_at`, `updated_at`) VALUES
(1, 'Paket 25 GB 1 Bulan', 2, 100000, '2020-10-03 12:56:45', '2020-10-03 12:56:45'),
(2, '1 GB 1 minggu', 1, 20000, '2020-10-03 12:56:45', '2020-10-03 12:56:45'),
(3, '1.5 GB 1 Minggu', 3, 10000, '2020-10-03 13:33:18', '2020-10-03 13:33:18'),
(4, '3 GB 1 Bulan Unlimited Social Media', 2, 25000, '2020-10-03 13:33:18', '2020-10-03 13:33:18'),
(7, '3 GB 1 Bulan', 1, 25000, '2020-10-03 14:48:11', '2020-10-03 14:48:11'),
(8, '7 GB 1 Bulan', 1, 50000, '2020-10-03 14:48:11', '2020-10-03 14:48:11'),
(9, '10 GB & Unlimited Social Media', 2, 50000, '2020-10-03 14:50:54', '2020-10-03 14:50:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `table_nominal_pln`
--

CREATE TABLE `table_nominal_pln` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `paket_pln` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fixed_price` int(11) NOT NULL,
  `daya` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `table_nominal_pln`
--

INSERT INTO `table_nominal_pln` (`id`, `paket_pln`, `fixed_price`, `daya`, `created_at`, `updated_at`) VALUES
(1, '20Rb', 20200, 0, '2020-10-03 15:29:41', '2020-10-03 15:29:41'),
(2, '50Rb', 50200, 0, '2020-10-03 15:29:41', '2020-10-03 15:29:41'),
(3, '100Rb', 100200, 0, '2020-10-03 15:29:41', '2020-10-03 15:29:41'),
(4, '200Rb', 200200, 0, '2020-10-03 15:29:41', '2020-10-03 15:29:41'),
(5, '500Rb', 500200, 0, '2020-10-03 15:29:41', '2020-10-03 15:29:41'),
(6, '1Jt', 1000200, 0, '2020-10-03 15:29:41', '2020-10-03 15:29:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `table_nominal_pulsa`
--

CREATE TABLE `table_nominal_pulsa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nominal` int(11) NOT NULL,
  `fixed_price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `table_nominal_pulsa`
--

INSERT INTO `table_nominal_pulsa` (`id`, `nominal`, `fixed_price`, `created_at`, `updated_at`) VALUES
(1, 5000, 5200, '2020-10-03 02:24:19', '2020-10-03 02:24:19'),
(2, 10000, 10200, '2020-10-03 02:24:19', '2020-10-03 02:24:19'),
(3, 20000, 20200, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 15000, 15200, '2020-10-03 00:51:55', '2020-10-03 00:51:55'),
(5, 25000, 252000, '2020-10-03 02:52:41', '2020-10-03 02:52:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `table_paket_data`
--

CREATE TABLE `table_paket_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `outlet_id` bigint(20) UNSIGNED NOT NULL,
  `nomor_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_paket_data` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_provider` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `table_paket_data`
--

INSERT INTO `table_paket_data` (`id`, `outlet_id`, `nomor_hp`, `id_paket_data`, `id_provider`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, '083857317946', '2', '3', '20000', '2022-02-03 12:22:27', '2022-02-03 12:22:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `table_pln`
--

CREATE TABLE `table_pln` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `outlet_id` bigint(20) UNSIGNED NOT NULL,
  `id_customer` int(11) NOT NULL,
  `id_paket_pln` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `informasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `table_pln`
--

INSERT INTO `table_pln` (`id`, `outlet_id`, `id_customer`, `id_paket_pln`, `price`, `informasi`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 50200, 'pembayaran masuk 1 jam setelah checkout!', '2022-01-03 12:24:31', '2022-02-03 12:24:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `table_pln_customer`
--

CREATE TABLE `table_pln_customer` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_pelanggan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_meteran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batas_daya` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `table_pln_customer`
--

INSERT INTO `table_pln_customer` (`id`, `nama`, `id_pelanggan`, `no_meteran`, `batas_daya`, `created_at`, `updated_at`) VALUES
(1, 'Andhika', '434234324234', '111212454', '400 VA', '2020-10-03 15:50:14', NULL),
(2, 'Arda', '465467867', '555222111', '1200 VA', '2020-10-03 16:21:22', NULL),
(3, 'Yanto', '46464546456', '888777999', '450 VA', '2020-10-03 16:21:22', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `table_provider`
--

CREATE TABLE `table_provider` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_provider` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_provider` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `table_provider`
--

INSERT INTO `table_provider` (`id`, `nama_provider`, `kode_provider`, `created_at`, `updated_at`) VALUES
(1, 'Telkom', '001', '2020-10-03 02:17:48', '2020-10-03 02:17:48'),
(2, 'Indosat Oredooo', '002', '2020-10-03 02:17:48', '2020-10-03 02:17:48'),
(3, 'Tree', '003', '2020-10-03 02:17:48', '2020-10-03 02:17:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `table_pulsa`
--

CREATE TABLE `table_pulsa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `outlet_id` bigint(20) UNSIGNED NOT NULL,
  `nomor_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_nominal` int(11) NOT NULL,
  `id_provider` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `table_pulsa`
--

INSERT INTO `table_pulsa` (`id`, `outlet_id`, `nomor_hp`, `id_nominal`, `id_provider`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, '083857317946', 2, 2, 10200, '2022-02-03 12:18:34', '2022-02-03 12:18:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `saldo` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `role`, `gender`, `phone`, `address`, `avatar`, `status`, `saldo`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'outlet', '-', '-', NULL, 'admin.jpg', 'active', -80400, 'admin@test.com', '2021-07-09 13:19:13', '$2y$10$u3NhosfLZp6B1rJ/3vsFEOKNAvZ2A5znkk6udLrQWUu11hZ/0Q1W.', 'kpK8gGXS0OUSZ0KAmjHV4ABNJNk0Y9pLk9WDXAKAO7BomKD2uOGZ2BQBpTrk', '2022-02-03 10:56:06', '2022-02-03 12:24:36'),
(2, 'Operator', 'operator', 'Pria', '085767113554', NULL, 'operator.jpg', 'active', 0, 'operator@test.com', '2021-07-09 13:19:13', '$2y$10$LbArttBG7b.wjK4TGkY7AePu9tipEXGjHP6u/7MLBwIwrzeEGtFMO', 'nMNJe7kXnwNv2Uk18WmpcFP0jg8p0pDo6UJeHsGeAw9Yo7ZiTyPXsK1s8h78', '2022-02-03 10:56:06', '2022-02-03 10:56:06'),
(3, 'Outlet', 'outlet', 'Pria', '085767113554', NULL, 'outlet.jpg', 'non-active', 0, 'outlet@test.com', '2021-07-09 13:19:13', '$2y$10$i89Dov7gU33uxSA2MzyjVe2RNWDIHhRc/TPrle6E5ynUghKeA3D9y', 'IUOGkm34WCFnFbcwyVsaB8US9XEk9vB9TtB6HkTQhdGvsy6qcCdicSN5RD6u', '2022-02-03 10:56:06', '2022-02-03 10:56:06'),
(4, 'Outlet2', 'outlet', 'Pria', '085767113554', NULL, 'outlet.jpg', 'non-active', 0, 'outlet2@test.com', '2021-07-09 13:19:13', '$2y$10$l/ZvIWd26RjdI.4d/F26cOtMW1uyAfc8sbNQU6Dgj1U5MVCOE1is6', '8YB0IjIn2wUUEmM671tupclTovlqegdIS2m0w9B7sZP9asiG8P8KPqkBCdyz', '2022-02-03 10:56:06', '2022-02-03 10:56:06'),
(5, 'Outlet3', 'outlet', 'Pria', '085767113554', NULL, 'outlet.jpg', 'non-active', 0, 'outlet3@test.com', '2021-07-09 13:19:13', '$2y$10$b3yK2jgj0Aftsk0EpkmOVuYDKqgaEHoGzOF3EQuShRRQs9TVE46we', 'bIthuhPIN1GpqQbfIWmxf8qUtncYrhhpzL51Pf9geDDCw3WJg86xDR9nmcRw', '2022-02-03 10:56:07', '2022-02-03 10:56:07'),
(6, 'Outlet4', 'outlet', 'Pria', '085767113554', NULL, 'outlet.jpg', 'non-active', 0, 'outlet4@test.com', '2021-07-09 13:19:13', '$2y$10$QsaLszgT8gpYM2Q/A8eBCeyiopNPJyygFqcZAcqYJxvmq9CTFAiZa', '5ZD9u1UqX99LzyyjdcoHwlLwuh0W1Mk9ou08sJPwxYIvL0WAzkjkY2WfeNvt', '2022-02-03 10:56:08', '2022-02-03 10:56:08'),
(7, 'Outlet5', 'outlet', 'Pria', '085767113554', NULL, 'outlet.jpg', 'non-active', 0, 'outlet5@test.com', '2021-07-09 13:19:13', '$2y$10$D1KmlvGCMkOYPm3V3ajLnOiX5z2UQs0exOhoFWKj8jMoRanCpytLW', 'DEEClLDoSYp7PFTGhVyU9GYbPTKTUGMfxDF26zQJU3KYF7G8yiV5biMmKHMq', '2022-02-03 10:56:08', '2022-02-03 10:56:08'),
(8, 'Outlet6', 'outlet', 'Pria', '085767113554', NULL, 'outlet.jpg', 'non-active', 0, 'outlet6@test.com', '2021-07-09 13:19:13', '$2y$10$XOyiksAjdTCtsJEan.o5CuO6/1Ttlaj12jIRlO1v3amIGFyDDfAAW', 'DEfbQCpX7P9Pb0uY7ia5IuhE884gkGa38dRp36g4v5xkDE7ibP2LkiA2m9bL', '2022-02-03 10:56:08', '2022-02-03 10:56:08'),
(9, 'Outlet7', 'outlet', 'Pria', '085767113554', NULL, 'outlet.jpg', 'non-active', 0, 'outlet7@test.com', '2021-07-09 13:19:13', '$2y$10$W3jPoDTu9KIjt6VzbSQ7deLQySDCPvVG6IDfwbSHOyHIm0EwUZZH2', 'IwfFzRvA7kE90CkiOQezCWeeH0A6iClZfb1hqN9PZyFJ1VbXJnoQqxQIoeHZ', '2022-02-03 10:56:08', '2022-02-03 10:56:08'),
(10, 'Outlet8', 'outlet', 'Pria', '085767113554', NULL, 'outlet.jpg', 'non-active', 0, 'outlet8@test.com', '2021-07-09 13:19:13', '$2y$10$QrROpHh.lmdEow7SyGA3j.xhey.CV.1LvjnNJoekBBGrxA9ZfVG2G', 'vl0TipyWejbdJamR1kI5lm4UJqO8dXET06HtL0hwukjCKdYW7xhteU0Z3hx1', '2022-02-03 10:56:08', '2022-02-03 10:56:08'),
(11, 'Outlet9', 'outlet', 'Pria', '085767113554', NULL, 'outlet.jpg', 'non-active', 0, 'outlet9@test.com', '2021-07-09 13:19:13', '$2y$10$onN9vMjJV.n7kUbimda3m.vET2FYAQ7Q6bz0EkzWyd6p2ulE.rpmS', 'F3zDSwJGrydXoNUuUIFZNKf5cGKWrYZlViJzQzxMzvv6EMBhhKXSF9DRvRBv', '2022-02-03 10:56:08', '2022-02-03 10:56:08'),
(12, 'Outlet10', 'outlet', 'Pria', '085767113554', NULL, 'outlet.jpg', 'non-active', 0, 'outlet10@test.com', '2021-07-09 13:19:13', '$2y$10$f.sIpOI6Hhi9s0BxDVA/Se2SLvtCIqm8FFRBhI7hbmNYRmvB45B26', 'EBKH6f1OJyoppvntJ5kPwfqJrOezM4O2bkQJZOAoLNvLJudR1xSFdc0qb8BJ', '2022-02-03 10:56:08', '2022-02-03 10:56:08');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `request_saldos`
--
ALTER TABLE `request_saldos`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rewards`
--
ALTER TABLE `rewards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rewards_outlet_id_foreign` (`outlet_id`);

--
-- Indeks untuk tabel `riwayat_saldos`
--
ALTER TABLE `riwayat_saldos`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `setting_websites`
--
ALTER TABLE `setting_websites`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `table_kategori`
--
ALTER TABLE `table_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `table_nominal_data`
--
ALTER TABLE `table_nominal_data`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `table_nominal_pln`
--
ALTER TABLE `table_nominal_pln`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `table_nominal_pulsa`
--
ALTER TABLE `table_nominal_pulsa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `table_paket_data`
--
ALTER TABLE `table_paket_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `table_paket_data_outlet_id_foreign` (`outlet_id`);

--
-- Indeks untuk tabel `table_pln`
--
ALTER TABLE `table_pln`
  ADD PRIMARY KEY (`id`),
  ADD KEY `table_pln_outlet_id_foreign` (`outlet_id`);

--
-- Indeks untuk tabel `table_pln_customer`
--
ALTER TABLE `table_pln_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `table_provider`
--
ALTER TABLE `table_provider`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `table_pulsa`
--
ALTER TABLE `table_pulsa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `table_pulsa_outlet_id_foreign` (`outlet_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `request_saldos`
--
ALTER TABLE `request_saldos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `rewards`
--
ALTER TABLE `rewards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `riwayat_saldos`
--
ALTER TABLE `riwayat_saldos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `setting_websites`
--
ALTER TABLE `setting_websites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `table_kategori`
--
ALTER TABLE `table_kategori`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `table_nominal_data`
--
ALTER TABLE `table_nominal_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `table_nominal_pln`
--
ALTER TABLE `table_nominal_pln`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `table_nominal_pulsa`
--
ALTER TABLE `table_nominal_pulsa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `table_paket_data`
--
ALTER TABLE `table_paket_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `table_pln`
--
ALTER TABLE `table_pln`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `table_pln_customer`
--
ALTER TABLE `table_pln_customer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `table_provider`
--
ALTER TABLE `table_provider`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `table_pulsa`
--
ALTER TABLE `table_pulsa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `rewards`
--
ALTER TABLE `rewards`
  ADD CONSTRAINT `rewards_outlet_id_foreign` FOREIGN KEY (`outlet_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `table_paket_data`
--
ALTER TABLE `table_paket_data`
  ADD CONSTRAINT `table_paket_data_outlet_id_foreign` FOREIGN KEY (`outlet_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `table_pln`
--
ALTER TABLE `table_pln`
  ADD CONSTRAINT `table_pln_outlet_id_foreign` FOREIGN KEY (`outlet_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `table_pulsa`
--
ALTER TABLE `table_pulsa`
  ADD CONSTRAINT `table_pulsa_outlet_id_foreign` FOREIGN KEY (`outlet_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
