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
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `alamat`, `email`, `password`, `role`, `fotoProfil`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'adminworld', 'admin@gmail.com', '$2y$12$7dBWzZhnoeRYNC88TV/f/uBdOBTbmWmnY34NaTEkk6eu7EA6BB8a2', 'admin', 'default.jpg', NULL, '2024-03-05 04:40:52', '2024-03-05 04:40:52'),
(3, 'muhammad rezza', 'rezza1665', 'Pamarican', 'muhammadreza1665@gmail.com', '$2y$12$LNsRkqjkJ36rXyhjotqkjuK0XwDOVBRU19pgVmYY9rvvp/f9iPExy', 'user', 'default.jpg', NULL, '2024-03-05 04:48:28', '2024-03-05 04:48:28'),
(4, 'andre ilham nugraha', 'andre', 'dobo', 'andre@gmail.com', '$2y$12$RloqYfQ089sKQuy8.4ci9uDSUzK.532vPaQKQMd2gPPeXSu.ZqUZa', 'user', 'default.jpg', NULL, '2024-03-05 07:52:25', '2024-03-05 07:52:25'),
(5, 'muhammad zahwan sidqi', 'zahwan', 'cikabuyutan timur', 'zahwan@gmail.com', '$2y$12$hIusjy3iu.TrIBy27D9HYeGmfZursKm9FZCH6XvTTxPaFq/sDsMve', 'user', 'default.jpg', NULL, '2024-03-05 08:08:29', '2024-03-05 08:08:29'),
(6, 'Albia Fabiansyah', 'albia', 'Gang Bawang', 'albia@gmail.com', '$2y$12$hPMSb6hxx5I.5wO93ert5eivtUBjp7J8kXu12Kg3cD.2XFpSf92BS', 'user', 'default.jpg', NULL, '2024-03-05 08:17:58', '2024-03-05 08:17:58'),
(7, 'Fahrezi Putra Bachtiar', 'fahrezi', 'sumedang', 'fahrezi@gmail.com', '$2y$12$isJ59bcN2aJxOU9DOe5iSeX2ab5njwDaXi645Pt5K9uSzg3a649Ta', 'user', 'default.jpg', NULL, '2024-03-05 08:26:51', '2024-03-05 08:26:51');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
