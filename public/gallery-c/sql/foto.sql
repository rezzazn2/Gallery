-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Mar 2024 pada 16.41
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gallery`
--

-- --------------------------------------------------------


--
-- Dumping data untuk tabel `foto`
--

INSERT INTO `foto` (`id`, `judulFoto`, `deskripsiFoto`, `albumId`, `userId`, `jalurFoto`, 'status', `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Wallapaper', 'Wallpaper astronout just brought rabbit some food', 0, 3, '3ZLXFk5CUlamoq4Wa19QhQAxkRH8xK3haKmiYfWv.jpg','muncul', NULL, '2024-03-05 07:44:19', '2024-03-05 07:44:19'),
(3, 'Wallpaper', 'Wallpaper highway rail', 0, 3, 'nKAr9W5fw7EX0uYYuE4LfqaoUg26n6JsYIm25wAm.jpg','muncul', NULL, '2024-03-05 07:45:09', '2024-03-05 07:45:09'),
(4, 'Wallpaper', 'minecraft wallpaper, minecraft at night', 0, 3, '6byCxxL6LAX7BE2y8kNJKDZzb7C3d26b5kT8tB3R.jpg','muncul', NULL, '2024-03-05 07:47:23', '2024-03-05 07:47:23'),
(5, 'Pemandangan Pantai', 'Pemandang di pantai rek', 0, 3, 'HhfrjvlEdjxpNq7Q2zmB0zmZvFE0ALwTfjlWuSoa.jpg','muncul', NULL, '2024-03-05 07:48:36', '2024-03-05 07:48:36'),
(6, 'That was a good day', 'pemandangan hari yang cerah', 0, 3, 'IxPfdXXnh118f3b6z4C2A6WsWxBXIvisLvd9bezo.jpg','muncul', NULL, '2024-03-05 07:49:28', '2024-03-05 07:49:28'),
(7, 'What a nice cloud', 'wanna', 0, 3, 'bBQwSRWT2fDSm7pic29L0Z305ifJxdhuDaZSAqr4.jpg','muncul', NULL, '2024-03-05 07:51:10', '2024-03-05 07:51:10'),
(9, 'Patrick Batman', 'American Psycho', 0, 4, 'frA70qFzPOyF6d6ZZ66lgZvvoBRtD9rXEfdmBxwR.jpg','muncul', NULL, '2024-03-05 08:00:13', '2024-03-05 08:00:13'),
(10, 'The God Father', 'american movie', 0, 4, '0pZWVWf67yYMgyaJgBnvyGlfnOYK6nvBqhUIT3oP.jpg','muncul', NULL, '2024-03-05 08:01:33', '2024-03-05 08:01:33'),
(11, 'American Sniper movies', 'What a great movie', 0, 4, 'BTb3YoxEt9nkQCXbWFQZgNRo4WniXCJAcQlzN4oN.jpg','muncul', NULL, '2024-03-05 08:02:11', '2024-03-05 08:02:11'),
(12, 'patrick batman', 'Sigma njir', 0, 4, 'saV1Nme44nyzaPp4ZRth9fgoWJjGDUfIXwr2pVs4.jpg','muncul', NULL, '2024-03-05 08:03:57', '2024-03-05 08:03:57'),
(13, 'Queen Gambits Movies', 'American movies', 0, 4, '00TgA7AhXfeI1ygNumzeEM298fA69cnlg9iVI0h4.jpg','muncul', NULL, '2024-03-05 08:04:30', '2024-03-05 08:04:30'),
(14, 'Breaking Bad', 'Jessie we gonna cooking rn', 0, 4, 'VYxZRun2dyZk5BplmB6qbENVjVjSHFzMXkHcQ6rg.jpg','muncul', NULL, '2024-03-05 08:05:32', '2024-03-05 08:05:32'),
(15, 'Better Call Saul', 'The Greatest Lawyer of all time', 0, 4, 'DKQRrZyS9lP9W1dvVWUzuaBoY2ngO086pjjd2EG4.jpg','muncul', NULL, '2024-03-05 08:06:48', '2024-03-05 08:06:48'),
(16, 'Tuttorial programming', 'How become a front end developer', 0, 5, 'f7uwi3t0yvNOOKBsRdIYZ9432ZgCIKMCqjANfph4.jpg','muncul', NULL, '2024-03-05 08:13:01', '2024-03-05 08:13:01'),
(17, 'roadmap fullstack developer', 'roadmap programming', 0, 5, 'PRgJ9afm7OyPSPWbRT3i62otzEKdJAC9UFdPF1qd.jpg','muncul', NULL, '2024-03-05 08:14:26', '2024-03-05 08:14:26'),
(18, 'Zee JkT48', 'ZEE', 0, 5, 'U02ZThzHoIE5HdehNy7mekhgDXBSN2XFJhXFm4P3.jpg','muncul', NULL, '2024-03-05 08:14:46', '2024-03-05 08:14:46'),
(19, 'JKT48 Song', 'JKT48 Song', 0, 5, '7qwgplaKMZF4w94FXRSrPvwQC91R6Qw0dkgHEPgC.jpg','muncul', NULL, '2024-03-05 08:15:17', '2024-03-05 08:15:17'),
(20, 'JKT48 new era', 'making hits songs forever', 0, 5, 'QKOWaZiO5eJqWhT8Rqx7F7qIrcEDlxw9nzi8HHSE.jpg','muncul', NULL, '2024-03-05 08:16:05', '2024-03-05 08:16:05'),
(21, 'JKT48 member', 'JKT48 member', 0, 5, '9TU2ZyQpLq15EZqxZlb9yLMRs3EVptAWLIEwFKYY.jpg','muncul', NULL, '2024-03-05 08:16:25', '2024-03-05 08:16:25'),
(22, 'Gurren Laggan', 'Nice', 0, 6, 'kLS0aLFY9ttzegafAgHC7YTRRoEQylxtFBnbloN3.jpg','muncul', NULL, '2024-03-05 08:22:12', '2024-03-05 08:22:12'),
(23, 'wallpaper osama ranking', 'bojji', 0, 6, 'Oo2VVPSQwAsdpUVcAZYV2JIQ8KK26gfVeI8ngxl8.jpg','muncul', NULL, '2024-03-05 08:22:33', '2024-03-05 08:22:33'),
(24, 'Fullmetal alchemist', 'retro', 0, 6, 'l8NgtsofTNRghGieEQY6jbpnOiPVKIGj2CPOmIwR.jpg','muncul', NULL, '2024-03-05 08:23:05', '2024-03-05 08:23:05'),
(25, 'RPG game', 'Uknown', 0, 6, 'vh7VIkeExhVzkiTlPTkqh3wISXDIKlxYGjIZMiev.jpg','muncul', NULL, '2024-03-05 08:23:25', '2024-03-05 08:23:25'),
(26, 'Darksoul 3', 'rpg games', 0, 6, 'Juij5Jw2Nm8WfcD2HZGVeFFcF3hwQcW5dXZPaokR.jpg','muncul', NULL, '2024-03-05 08:23:54', '2024-03-05 08:23:54'),
(27, 'Elden Rings', 'Darksoul X Genshin', 0, 6, '1L683YlbsorStsdp7MCzwgJ2CtoMzdLxzyIlwuXb.jpg','muncul', NULL, '2024-03-05 08:24:26', '2024-03-05 08:24:26'),
(28, 'doa doa harian', 'doa doa harian', 0, 7, 'czznlHmEUMu0j6WWcpiubXYOSYO2Vpm9XvFxwMTQ.jpg','muncul', NULL, '2024-03-05 08:31:48', '2024-03-05 08:31:48'),
(29, 'Doa setelah berwudhu', 'Doa setelah berwudhu', 0, 7, 'm2H4rLG9kOFVW2U4tcvuK7SJV7VoNws3GJD0F94C.jpg','muncul', NULL, '2024-03-05 08:35:07', '2024-03-05 08:35:07'),
(30, 'Dua ayat di malam hari', 'sunnah rasulullah', 0, 7, 'OnlykftvxRuWXmSQqV3EW7IdBeOd03h6VjO6mELL.jpg','muncul', NULL, '2024-03-05 08:35:35', '2024-03-05 08:35:35'),
(31, 'yahaha hayyuk', 'mabar tjuy', 0, 7, 'JoeqE1WbjLIVHtHEsYEvtQIJa60DQYUNZI05O8mk.jpg','muncul', NULL, '2024-03-05 08:36:08', '2024-03-05 08:36:08'),
(32, 'Gym Post', 'Daily activities', 0, 7, '2yNiVUhydTW840iEnJIAOWjn4LacwG6vNXc3THA2.jpg','muncul', NULL, '2024-03-05 08:37:16', '2024-03-05 08:37:16'),
(33, 'Wielino ino', 'tidur banginoo', 0, 7, 'S6vU4SGqCHkvHhBMrttDbXMtBnNGHJb9s0grUqrZ.jpg','muncul', NULL, '2024-03-05 08:37:49', '2024-03-05 08:37:49');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foto_userid_foreign` (`userId`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `foto`
--
ALTER TABLE `foto`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `foto`
--
ALTER TABLE `foto`
  ADD CONSTRAINT `foto_userid_foreign` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
