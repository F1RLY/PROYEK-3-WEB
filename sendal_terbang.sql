-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 27 Apr 2026 pada 06.43
-- Versi server: 8.4.3
-- Versi PHP: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sendal_terbang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dosen`
--

CREATE TABLE `dosen` (
  `id` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `NIP` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `dosen`
--

INSERT INTO `dosen` (`id`, `nama`, `NIP`) VALUES
(1, 'Muhammad Mustamiin, S.Pd., M.Kom', '0005059202');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gambar`
--

CREATE TABLE `gambar` (
  `id` int NOT NULL,
  `lokasi` text NOT NULL,
  `imageCode` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `gambar`
--

INSERT INTO `gambar` (`id`, `lokasi`, `imageCode`, `created_at`, `updated_at`) VALUES
(66, '1776676901.jpeg', '69e5f025c9af4', '2026-04-20 09:21:41', '2026-04-20 09:21:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gambar_proyek`
--

CREATE TABLE `gambar_proyek` (
  `id` int NOT NULL,
  `proyekId` int NOT NULL,
  `gambarId` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelompok`
--

CREATE TABLE `kelompok` (
  `id` int NOT NULL,
  `mahasiswa` int NOT NULL,
  `proyek` int NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `kelompok`
--

INSERT INTO `kelompok` (`id`, `mahasiswa`, `proyek`, `created_at`, `updated_at`) VALUES
(80, 26, 31, '2026-04-26 14:39:31', '2026-04-26 14:39:31'),
(81, 26, 32, '2026-04-26 15:00:26', '2026-04-26 15:00:26'),
(82, 23, 33, '2026-04-26 15:09:42', '2026-04-26 15:09:42'),
(83, 23, 34, '2026-04-27 06:10:21', '2026-04-27 06:10:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int NOT NULL,
  `userID` int NOT NULL,
  `angkatan` varchar(4) NOT NULL,
  `kelas` varchar(1) NOT NULL,
  `link` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `userID`, `angkatan`, `kelas`, `link`, `created_at`, `updated_at`) VALUES
(23, 32, '2024', 'b', NULL, '2026-04-20 02:21:22', '2026-04-20 02:21:22'),
(24, 33, '2024', 'b', NULL, '2026-04-20 02:29:00', '2026-04-20 02:29:00'),
(25, 35, '2024', 'b', NULL, '2026-04-26 05:19:06', '2026-04-26 05:19:06'),
(26, 34, '2024', 'b', NULL, '2026-04-26 07:37:49', '2026-04-26 07:37:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa_sosial_media`
--

CREATE TABLE `mahasiswa_sosial_media` (
  `id` int NOT NULL,
  `mahasiswa_id` int NOT NULL,
  `sosial_media_id` int NOT NULL,
  `link` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2025_10_28_040254_users', 1),
(2, '2025_10_28_041329_create_sessions_table', 2),
(3, '2026_04_20_130824_create_cache_table', 3),
(4, '2026_04_20_132820_create_personal_access_tokens_table', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
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

--
-- Dumping data untuk tabel `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 34, 'auth', '9011ccab05846c789fbeca255e177ccd14055a5e85a3a22b61da93202e156a75', '[\"*\"]', NULL, NULL, '2026-04-20 06:30:00', '2026-04-20 06:30:00'),
(2, 'App\\Models\\User', 32, 'auth', '4f1d900630f7bccecfb262c364e1f0f14e3152647d23a98e79e4da63d7fa7e64', '[\"*\"]', NULL, NULL, '2026-04-20 06:30:33', '2026-04-20 06:30:33'),
(3, 'App\\Models\\User', 32, 'auth', 'dd7c601d9e673c4b6d1e8dbd18cec3e1b27ea3ace5527677873862c10106d95d', '[\"*\"]', NULL, NULL, '2026-04-20 06:33:36', '2026-04-20 06:33:36'),
(4, 'App\\Models\\User', 32, 'auth', '1558855354c08682e2b3a763ba10d2efcd1711b438a6b626b6542788ab493dcd', '[\"*\"]', NULL, NULL, '2026-04-20 06:36:32', '2026-04-20 06:36:32'),
(5, 'App\\Models\\User', 32, 'auth', '86e18fe46f8291b272e004fccd5cd539c82d31bcddc6b49b18f7180802202a24', '[\"*\"]', NULL, NULL, '2026-04-20 06:37:27', '2026-04-20 06:37:27'),
(6, 'App\\Models\\User', 34, 'auth', '4e08f62f53e48f393847419356c80d3fa72657c08f8d937c327c82b7c3ac34fe', '[\"*\"]', NULL, NULL, '2026-04-20 06:52:45', '2026-04-20 06:52:45'),
(7, 'App\\Models\\User', 34, 'auth', '17e058d033e2f1aa98da2c1c65a8f7e168683792a4087fb8eccb7e8607d179ba', '[\"*\"]', NULL, NULL, '2026-04-20 07:08:07', '2026-04-20 07:08:07'),
(8, 'App\\Models\\User', 32, 'auth', '1ebb3d34e8cff3cf318e8cc171c3e5d2eadba14ab093b6ca75c6c5e7ee3da665', '[\"*\"]', '2026-04-20 07:16:45', NULL, '2026-04-20 07:16:43', '2026-04-20 07:16:45'),
(9, 'App\\Models\\User', 32, 'auth', '3432e96b412423900f5c1f8760196477a9f8300696c71454717a6febbeb1b5aa', '[\"*\"]', '2026-04-20 07:17:03', NULL, '2026-04-20 07:17:01', '2026-04-20 07:17:03'),
(10, 'App\\Models\\User', 34, 'auth', '7c522bc97236b5f0ee0663462ff0e457a4c80c352420e62ad12b167a95fcc9ab', '[\"*\"]', NULL, NULL, '2026-04-20 17:34:36', '2026-04-20 17:34:36'),
(11, 'App\\Models\\User', 32, 'auth', '2b37d7f17951ff0b6f106bd85f879acfa4498c2978604abdb4a03881d8c4f592', '[\"*\"]', '2026-04-20 17:37:37', NULL, '2026-04-20 17:37:31', '2026-04-20 17:37:37'),
(12, 'App\\Models\\User', 34, 'auth', '136071fd162f0933a90f64b1b3e28caf60fd1700a4d2120041d48ea79c2af56d', '[\"*\"]', NULL, NULL, '2026-04-20 20:21:16', '2026-04-20 20:21:16'),
(13, 'App\\Models\\User', 32, 'auth', '1e4875f4e3c6eab1f9d8b11e42745fa0a18c01b92bd27a81575ab2d621431f3b', '[\"*\"]', '2026-04-20 20:21:44', NULL, '2026-04-20 20:21:22', '2026-04-20 20:21:44'),
(14, 'App\\Models\\User', 32, 'auth', 'c40685a98fd12a17e8d23f4795ab78ccf21dc9d8374035286d377e7d58c4c512', '[\"*\"]', '2026-04-25 21:59:27', NULL, '2026-04-25 21:59:19', '2026-04-25 21:59:27'),
(15, 'App\\Models\\User', 32, 'auth', '9535fb71d8a24022683ba2e8445c98cac1ca92230ee76810a37155aabdb814c4', '[\"*\"]', '2026-04-26 04:51:34', NULL, '2026-04-26 04:51:22', '2026-04-26 04:51:34'),
(16, 'App\\Models\\User', 32, 'auth', '0507eff3b27c7c66b9bd0bc3e7a4e4b34bb8768ff372d9a022e7ff1d87bab5c0', '[\"*\"]', '2026-04-26 04:55:01', NULL, '2026-04-26 04:53:59', '2026-04-26 04:55:01'),
(17, 'App\\Models\\User', 32, 'auth', 'b306106bb26e0dcaba483c5d1711a1705c0b653f96e9653b7f7d272bc9908fc3', '[\"*\"]', '2026-04-26 05:18:03', NULL, '2026-04-26 05:18:01', '2026-04-26 05:18:03'),
(18, 'App\\Models\\User', 35, 'auth', '917508d532feacb3628b84eb8e525b227e3ff3cda6691be6bc70d2ab9fb03a5a', '[\"*\"]', '2026-04-26 05:19:21', NULL, '2026-04-26 05:19:19', '2026-04-26 05:19:21'),
(19, 'App\\Models\\User', 32, 'auth', '675731f6744e35667f9e329fd177ff9ad2a26f784ecb950c136c89cbc6ba3d93', '[\"*\"]', NULL, NULL, '2026-04-26 05:31:54', '2026-04-26 05:31:54'),
(20, 'App\\Models\\User', 32, 'auth', '11567c61f62ec6f26ea86a652fcdf25671c7f8212216594edefdc1d23b85b746', '[\"*\"]', '2026-04-26 06:45:13', NULL, '2026-04-26 06:31:42', '2026-04-26 06:45:13'),
(21, 'App\\Models\\User', 32, 'auth', '5a6cf6e2d7f0884c4b0f99f8e5fec8d2f650955124334c1f03ca83f0899f6e47', '[\"*\"]', '2026-04-26 07:47:12', NULL, '2026-04-26 06:47:06', '2026-04-26 07:47:12'),
(22, 'App\\Models\\User', 34, 'auth', '423c85cd6416c4420e96ddbc464f749ed82f153bfc3d0ba2642aff119ed03251', '[\"*\"]', NULL, NULL, '2026-04-26 06:51:28', '2026-04-26 06:51:28'),
(23, 'App\\Models\\User', 34, 'auth', '193e4b2e57cfb9e86a7e076cf7c99056ac09a966c70a9284570b45a20d7513ff', '[\"*\"]', NULL, NULL, '2026-04-26 07:00:54', '2026-04-26 07:00:54'),
(24, 'App\\Models\\User', 34, 'auth', '8bea4ccd8ae68c6fb2dd7141bf17bdc61742df36597a8da37d5cf150a64ead7d', '[\"*\"]', NULL, NULL, '2026-04-26 07:09:33', '2026-04-26 07:09:33'),
(25, 'App\\Models\\User', 34, 'auth', 'ec3b6eedd2dd3f8b8fd1cb8b57467149da50343942f2446e23eb65f9287c664a', '[\"*\"]', NULL, NULL, '2026-04-26 07:10:57', '2026-04-26 07:10:57'),
(26, 'App\\Models\\User', 34, 'auth', '1ff7b7ec4bc1bb4ddec8b88fa0de55fa4d1a1541b886b4116ebeacef53ac1696', '[\"*\"]', NULL, NULL, '2026-04-26 07:11:32', '2026-04-26 07:11:32'),
(27, 'App\\Models\\User', 34, 'auth', '6876559b3fd2775dc88eb4e08a54d42ec8244595b403e33ff11fed5a935af85a', '[\"*\"]', NULL, NULL, '2026-04-26 07:15:48', '2026-04-26 07:15:48'),
(28, 'App\\Models\\User', 34, 'auth', '8bcee30e619ab52d44bc8ffef236719b8190b65d62beebcec3e0520d4dec7d3e', '[\"*\"]', NULL, NULL, '2026-04-26 07:22:05', '2026-04-26 07:22:05'),
(29, 'App\\Models\\User', 34, 'auth', 'a943d4ded3da24142097debf0348de72025d29f768a1449f6ade33f38294304c', '[\"*\"]', NULL, NULL, '2026-04-26 07:25:41', '2026-04-26 07:25:41'),
(30, 'App\\Models\\User', 34, 'auth', '7130ca5392297ee7c3968097d9193e0d4f26f2a637fa7fe68c3abf1dc2b730d8', '[\"*\"]', NULL, NULL, '2026-04-26 07:26:18', '2026-04-26 07:26:18'),
(31, 'App\\Models\\User', 34, 'auth', '30fa499010bd99b6ff593648effcdfd035daeb2e4e4a1409002e9a89dd8f64e4', '[\"*\"]', '2026-04-26 08:00:26', NULL, '2026-04-26 07:28:52', '2026-04-26 08:00:26'),
(32, 'App\\Models\\User', 32, 'auth', 'fba0ca857e4d9e3a1c84125b9b0212d2757a8320eeb1eb76eb25584176f3ae16', '[\"*\"]', '2026-04-26 07:53:07', NULL, '2026-04-26 07:48:20', '2026-04-26 07:53:07'),
(33, 'App\\Models\\User', 32, 'auth', '20a37f05f87592feeb56dbd3979d6540194148dd1f5693bd713eb9453a989cfa', '[\"*\"]', '2026-04-26 07:59:57', NULL, '2026-04-26 07:59:37', '2026-04-26 07:59:57'),
(34, 'App\\Models\\User', 32, 'auth', '9bd7fb6b11feb22a21204462f6f68597d2f4fd343facb53a76c5a798ca50f039', '[\"*\"]', '2026-04-26 08:16:06', NULL, '2026-04-26 08:05:25', '2026-04-26 08:16:06'),
(35, 'App\\Models\\User', 32, 'auth', '7b6585300a552b24215b523553d8c58ad5f162a0a4b7a4827f3f4f676c1199ed', '[\"*\"]', '2026-04-26 08:16:54', NULL, '2026-04-26 08:16:50', '2026-04-26 08:16:54'),
(36, 'App\\Models\\User', 32, 'auth', 'f234954ea6a14c86824c953aea85b49a6b6329082c410c0a971a34804b8921a6', '[\"*\"]', '2026-04-26 08:20:36', NULL, '2026-04-26 08:20:33', '2026-04-26 08:20:36'),
(37, 'App\\Models\\User', 32, 'auth', 'de8e28aac1e900e5865f4290a7ac772b117ccd2324b1580a28b0e0dba6d180c8', '[\"*\"]', '2026-04-26 22:39:00', NULL, '2026-04-26 22:38:51', '2026-04-26 22:39:00'),
(38, 'App\\Models\\User', 34, 'auth', 'ecf28bdd16fe336183cb4b061fa3e03fc1e77c4085ec7a4dfbdf1c9b66761758', '[\"*\"]', '2026-04-26 23:19:39', NULL, '2026-04-26 22:46:58', '2026-04-26 23:19:39'),
(39, 'App\\Models\\User', 32, 'auth', '070eaeee7e1d231a0e7ba005957a9fbea9435e87af3d32984b9a738e10f99aa9', '[\"*\"]', '2026-04-26 22:54:02', NULL, '2026-04-26 22:50:05', '2026-04-26 22:54:02'),
(40, 'App\\Models\\User', 32, 'auth', 'c95ceaa344e06d5afea13fd6191b61177fc57c65fb3b0050c3d050e3ec267ca6', '[\"*\"]', '2026-04-26 23:10:22', NULL, '2026-04-26 23:08:04', '2026-04-26 23:10:22'),
(41, 'App\\Models\\User', 32, 'auth', '4e9f66db211ecf01761d4cd00a0a969f63f75a0ae74757e0e001aab69e1c972e', '[\"*\"]', '2026-04-26 23:17:27', NULL, '2026-04-26 23:17:25', '2026-04-26 23:17:27'),
(42, 'App\\Models\\User', 32, 'auth', 'a3d6c5e4b077cde3b948ae59e2b13ed10833fe7b49cd0d8ea4c5a58e95762eba', '[\"*\"]', '2026-04-26 23:22:23', NULL, '2026-04-26 23:22:20', '2026-04-26 23:22:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `proyek`
--

CREATE TABLE `proyek` (
  `id` int NOT NULL,
  `repoCode` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `link` text,
  `file_laporan` text,
  `file_ppt` text,
  `dosenId` int DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` timestamp NOT NULL,
  `verifikasi` tinyint(1) NOT NULL,
  `proposal` tinyint(1) NOT NULL,
  `laporan` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `proyek`
--

INSERT INTO `proyek` (`id`, `repoCode`, `judul`, `deskripsi`, `link`, `file_laporan`, `file_ppt`, `dosenId`, `updated_at`, `created_at`, `verifikasi`, `proposal`, `laporan`) VALUES
(31, 'mNLG1Qq', 'Test Proyek', 'Ini adalah deskripsi proyek test', NULL, NULL, NULL, 1, '2026-04-26 14:39:31', '2026-04-26 07:39:31', 0, 0, 0),
(32, '0v9hqsf', 'Test Proyek', 'Ini adalah deskripsi proyek test', NULL, NULL, NULL, 1, '2026-04-26 15:00:26', '2026-04-26 08:00:26', 0, 0, 0),
(33, 'fqtiQdu', 't', 'g', '', '1777216182_KRITERIA PELAKSANAAN PEMAGANGAN.pdf', NULL, 1, '2026-04-26 15:09:42', '2026-04-26 08:09:42', 0, 0, 0),
(34, 'MFhkG2t', 'otdotdtox', 'txotxztozoz', '', NULL, NULL, 1, '2026-04-27 06:10:21', '2026-04-26 23:10:21', 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('dgfNvlcwdKmFAE8C2cHV7sASET8pgxJ0FaBW153h', 33, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJheEk1bVh0MXg1MnVCZnVncUhhaGp0R3AwMllGb1d1Y3Z2RnFraFJUIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjMzfQ==', 1776680971),
('J0nAPoA0ARBnRextTRK55v2L7xP0tTDSHOBZtewx', NULL, '127.0.0.1', 'PostmanRuntime/7.53.0', 'eyJfdG9rZW4iOiJiMTRFY3pmQWc2eTBTVkkwYmZqclM1Y0VhOEc2Q2NPWGx3VzVQNmNEIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9sb2dpbiIsInJvdXRlIjoibG9naW4ifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1776694145),
('Q8iGcuyUyTwNXfMiAmZIESzUG8jSZuEFtUKUIBjr', 32, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJWR0lmVUNHWDBxNkx4dFhRZEczMndPcGdTRTVmZmVsd0F1RnFMUEU0IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjMyfQ==', 1776691444),
('saNNZCpZ3OizTj7PfipD1ClwOObhON4SxyvmIvqQ', NULL, '10.242.68.152', 'PostmanRuntime/7.53.0', 'eyJfdG9rZW4iOiJuNDV5ZW14eHprNnpOb0tOVHJ0bE54Q0ZVU0lWMndaa1dvTVV1bVRxIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEwLjI0Mi42OC4xNTI6ODAwMFwvbG9naW4iLCJyb3V0ZSI6ImxvZ2luIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1777212087);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sosial_media`
--

CREATE TABLE `sosial_media` (
  `id` int NOT NULL,
  `nama` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','mahasiswa','dosen') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'mahasiswa',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `kode`, `email`, `password`, `role`, `created_at`, `updated_at`, `foto`) VALUES
(32, 'Firly Alam Sudrajat', '2403064', 'firlyalamsudrajat@gmail.com', '$2y$12$PdIUcdcwZAjNnxjkdzOuxeDKwGOGxvzlgk4GDZlqbAR7Kuh6lMOoe', 'mahasiswa', '2026-04-20 02:21:22', '2026-04-26 22:54:00', 'user_32_1777269240.jpg'),
(33, 'Sucipto Abdullah', '2403065', 'sucipto@gmail.com', '$2y$12$mUIbfZ5uywEcWCdPj5G6POa1VUvo65PFj6XbQRs699yRWuMdC3UXy', 'mahasiswa', '2026-04-20 02:29:00', '2026-04-20 02:29:00', NULL),
(34, 'testing', '999888', 'testing@test.com', '$2y$12$HSjCa3.gONjmTPVMRoxsFOvf1B/GdGGZlhGWHhE/3KI4Y3YlpNev2', 'mahasiswa', '2026-04-20 06:21:54', '2026-04-20 06:21:54', NULL),
(35, 'joko', '2403066', 'joko@gmail.com', '$2y$12$LJ9HdZA.CxcurELlomU21eoLqbF1kDve/zZYcQqnwFP7juiUZoPxu', 'mahasiswa', '2026-04-26 05:19:06', '2026-04-26 05:19:06', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `video_proyek`
--

CREATE TABLE `video_proyek` (
  `id` bigint UNSIGNED NOT NULL,
  `videoCode` varchar(255) NOT NULL,
  `lokasi` text NOT NULL,
  `proyekId` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `gambar`
--
ALTER TABLE `gambar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `gambar_proyek`
--
ALTER TABLE `gambar_proyek`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kelompok`
--
ALTER TABLE `kelompok`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mahasiswa` (`mahasiswa`),
  ADD KEY `proyek` (`proyek`);

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mahasiswa_sosial_media`
--
ALTER TABLE `mahasiswa_sosial_media`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `proyek`
--
ALTER TABLE `proyek`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `sosial_media`
--
ALTER TABLE `sosial_media`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_kode_unique` (`kode`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- Indeks untuk tabel `video_proyek`
--
ALTER TABLE `video_proyek`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `gambar`
--
ALTER TABLE `gambar`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT untuk tabel `gambar_proyek`
--
ALTER TABLE `gambar_proyek`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT untuk tabel `kelompok`
--
ALTER TABLE `kelompok`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `mahasiswa_sosial_media`
--
ALTER TABLE `mahasiswa_sosial_media`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `proyek`
--
ALTER TABLE `proyek`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `sosial_media`
--
ALTER TABLE `sosial_media`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `video_proyek`
--
ALTER TABLE `video_proyek`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `kelompok`
--
ALTER TABLE `kelompok`
  ADD CONSTRAINT `mahasiswa` FOREIGN KEY (`mahasiswa`) REFERENCES `mahasiswa` (`id`),
  ADD CONSTRAINT `proyek` FOREIGN KEY (`proyek`) REFERENCES `proyek` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
