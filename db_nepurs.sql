-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Nov 2023 pada 18.19
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_nepurs`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan_bimbingan`
--

CREATE TABLE `laporan_bimbingan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kelas` enum('10','11','12') NOT NULL,
  `semester` enum('ganjil','genap') NOT NULL,
  `bidangLayanan` enum('pribadi','sosial','belajar','karir') NOT NULL,
  `tanggalBimbingan` date NOT NULL,
  `keluhan` text NOT NULL,
  `solusi` text NOT NULL,
  `tahunAjar_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `siswa_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `laporan_bimbingan`
--

INSERT INTO `laporan_bimbingan` (`id`, `kelas`, `semester`, `bidangLayanan`, `tanggalBimbingan`, `keluhan`, `solusi`, `tahunAjar_id`, `user_id`, `siswa_id`, `created_at`, `updated_at`) VALUES
(4, '10', 'ganjil', 'pribadi', '2023-11-01', 'overthinking', 'diberikan saran saran', 8, 5, 2100151, '2023-11-12 18:40:15', '2023-11-12 18:40:15'),
(5, '11', 'ganjil', 'pribadi', '2023-10-31', 'Terlambat', 'diberi sosialisasi', 8, 5, 2100151, '2023-11-12 18:45:31', '2023-11-12 18:45:31'),
(6, '12', 'ganjil', 'belajar', '2023-11-02', 'Kesulitan belajar', 'diberikan pengarahan', 8, 5, 2200154, '2023-11-12 18:46:00', '2023-11-12 18:46:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(29, '2014_10_12_000000_create_users_table', 1),
(30, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(31, '2014_10_12_100000_create_password_resets_table', 1),
(32, '2019_08_19_000000_create_failed_jobs_table', 1),
(33, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(34, '2022_10_07_081144_create_tahun_ajar_table', 1),
(35, '2023_10_02_182333_create_profil_siswa_table', 1),
(36, '2023_10_02_183433_create_profil_guru_table', 1),
(37, '2023_10_07_074734_create_prestasi_siswa_table', 1),
(38, '2023_10_07_081510_create_laporan_bimbingan_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `prestasi_siswa`
--

CREATE TABLE `prestasi_siswa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tahunPencapaian` year(4) NOT NULL,
  `bidangPrestasi` enum('akademik','non-akademik') NOT NULL,
  `deskripsi` text NOT NULL,
  `tingkatPrestasi` enum('lokal','regional','nasional','internasional') NOT NULL,
  `posisiJuara` enum('I','II','III','harapan') NOT NULL,
  `buktiPrestasi` varchar(255) NOT NULL,
  `siswa_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `profil_guru`
--

CREATE TABLE `profil_guru` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `namaGuruBK` varchar(45) NOT NULL,
  `alamat` varchar(45) NOT NULL,
  `nomorWA` varchar(32) NOT NULL,
  `fotoGuruBK` text NOT NULL,
  `ulangPassword` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `profil_guru`
--

INSERT INTO `profil_guru` (`id`, `namaGuruBK`, `alamat`, `nomorWA`, `fotoGuruBK`, `ulangPassword`, `user_id`, `created_at`, `updated_at`) VALUES
(45671122, 'Makoto Ei', 'Kota Purwakarta', '08214512412', 'FotoGuru/1699453861.jpg', 'raidenshogun', 5, '2023-11-04 09:22:48', '2023-11-11 20:01:45'),
(6652773674130152, 'Indra Caya Maulana', 'Jl. Veteran gang ampera 2', '085721214023', 'FotoGuru/1699841103.jpg', 'Icm12345@', 7, '2023-11-12 19:05:03', '2023-11-12 19:05:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `profil_siswa`
--

CREATE TABLE `profil_siswa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `namaSiswa` varchar(255) NOT NULL,
  `tahunMasuk` int(11) NOT NULL,
  `tahunLulus` int(11) NOT NULL,
  `jurusan` enum('TKJ','DPIB','TITL','TKRO','TPM','T.ELIN','TSM','TAV','IOP') NOT NULL,
  `tgl_lahir` date NOT NULL,
  `fotoSiswa` varchar(255) NOT NULL,
  `ulangPassword` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `profil_siswa`
--

INSERT INTO `profil_siswa` (`id`, `namaSiswa`, `tahunMasuk`, `tahunLulus`, `jurusan`, `tgl_lahir`, `fotoSiswa`, `ulangPassword`, `user_id`, `created_at`, `updated_at`) VALUES
(2100151, 'Ayaka Kamisato', 2021, 2025, 'TKJ', '2002-08-18', 'FotoSiswa/1699453778.jpg', '11223344', 3, '2023-11-04 09:20:30', '2023-11-08 07:29:38'),
(2200154, 'Shenhe Yunisa', 2022, 2026, 'TKRO', '2004-07-09', 'FotoSiswa/1699453794.jpg', 'shenheyuu', 4, '2023-11-04 09:21:41', '2023-11-11 09:42:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahun_ajar`
--

CREATE TABLE `tahun_ajar` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tahun_ajar_siswa` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tahun_ajar`
--

INSERT INTO `tahun_ajar` (`id`, `tahun_ajar_siswa`, `created_at`, `updated_at`) VALUES
(1, '2016/2017', '2023-11-04 09:32:42', '2023-11-04 09:32:42'),
(2, '2017/2018', '2023-11-04 09:32:48', '2023-11-04 09:32:48'),
(3, '2018/2019', '2023-11-04 09:32:55', '2023-11-04 09:32:55'),
(4, '2019/2020', '2023-11-04 09:33:01', '2023-11-04 09:33:01'),
(5, '2020/2021', '2023-11-04 09:33:06', '2023-11-04 09:33:06'),
(6, '2021/2022', '2023-11-04 09:33:25', '2023-11-04 09:33:25'),
(7, '2022/2023', '2023-11-04 09:33:31', '2023-11-04 09:33:31'),
(8, '2023/2024', '2023-11-04 09:33:39', '2023-11-04 09:33:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `role` enum('siswa','guru','kepalaSekolah','admin') NOT NULL DEFAULT 'siswa',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `remember_token`, `role`, `created_at`, `updated_at`) VALUES
(1, 'adminkay', 'rhesakornelius@gmail.com', '$2y$10$3hviM6NS6.dlQ6JrUbPbvOT3rh3bsQTkqmLLBqpBfT29TrpKg5JbK', 'OldOV1H8bdl4LtA1BjBwOOwtc0UUc9Iq7koaB7B8QD0JR12baemu91LXzaGr', 'admin', '2023-11-04 09:16:49', '2023-11-04 09:16:49'),
(2, 'kepsektest', 'kepsektest@gmail.com', '$2y$10$kRApw6Wc.8np3589N4CgsOAgCVhtfsxIFUXQU5jWqkhSafVdPEEhG', NULL, 'kepalaSekolah', '2023-11-04 09:16:49', '2023-11-04 09:16:49'),
(3, 'ayakakamisato', 'ayakakamisato@gmail.com', '$2y$10$tpuW17AD5zyjdA2fmHFrxOmsqFGuo11jm6yTDERt.BxBtY1tjZDlG', 'QLP40mmaFRQzdCg6uskeYN2U9OwiAbD8aJqT5dnd3XOwTYWifz364webGI17', 'siswa', '2023-11-04 09:20:30', '2023-11-08 07:29:38'),
(4, 'shenheyuu', 'shenheyuu@gmail.com', '$2y$10$iG4hMMAMimHvMKmCg5oadegcvftxT7FXkfQEUC7mowwQIaQoqS/iW', 'im2My9NCr2eowuzVZ9bCUajYJebdwvGxINWOkMfbIiZyludPO6Vp84alvo1n', 'siswa', '2023-11-04 09:21:41', '2023-11-11 09:42:39'),
(5, 'raidenshogun', 'raidenshogun@gmail.com', '$2y$10$Gx1mjhB305DJAbYjX.R1TONMNOABisiWwNKoCufkOO7fpKyGNB.gC', 'S71sOlWOoPwx66UqzOMossRRbKFCrUoNm6nz3HvCd0WGI7gKLvN6Kg8LbaHS', 'guru', '2023-11-04 09:22:48', '2023-11-11 20:01:45'),
(7, 'indracayamaualana', 'cayamaulanaindra@gmail.com', '$2y$10$J80GREr3VHjFmdgwFO2HvugKdPisiTsxRO6oP2DMz72DpkL6c3bZu', 'gfXKFNEZDKDzu7yxHbtYPCZ54LgCqT2u5C4tuMCbVNeSmkiEwcJhUgh8JkhQ', 'guru', '2023-11-12 19:05:03', '2023-11-12 19:05:03');

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
-- Indeks untuk tabel `laporan_bimbingan`
--
ALTER TABLE `laporan_bimbingan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laporan_bimbingan_tahunajar_id_foreign` (`tahunAjar_id`),
  ADD KEY `laporan_bimbingan_user_id_foreign` (`user_id`),
  ADD KEY `laporan_bimbingan_siswa_id_foreign` (`siswa_id`);

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
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `prestasi_siswa`
--
ALTER TABLE `prestasi_siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prestasi_siswa_siswa_id_foreign` (`siswa_id`);

--
-- Indeks untuk tabel `profil_guru`
--
ALTER TABLE `profil_guru`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profil_guru_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `profil_siswa`
--
ALTER TABLE `profil_siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profil_siswa_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `tahun_ajar`
--
ALTER TABLE `tahun_ajar`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `laporan_bimbingan`
--
ALTER TABLE `laporan_bimbingan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `prestasi_siswa`
--
ALTER TABLE `prestasi_siswa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `profil_guru`
--
ALTER TABLE `profil_guru`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6652773674130153;

--
-- AUTO_INCREMENT untuk tabel `profil_siswa`
--
ALTER TABLE `profil_siswa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2200155;

--
-- AUTO_INCREMENT untuk tabel `tahun_ajar`
--
ALTER TABLE `tahun_ajar`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `laporan_bimbingan`
--
ALTER TABLE `laporan_bimbingan`
  ADD CONSTRAINT `laporan_bimbingan_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `profil_siswa` (`id`),
  ADD CONSTRAINT `laporan_bimbingan_tahunajar_id_foreign` FOREIGN KEY (`tahunAjar_id`) REFERENCES `tahun_ajar` (`id`),
  ADD CONSTRAINT `laporan_bimbingan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `prestasi_siswa`
--
ALTER TABLE `prestasi_siswa`
  ADD CONSTRAINT `prestasi_siswa_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `profil_siswa` (`id`);

--
-- Ketidakleluasaan untuk tabel `profil_guru`
--
ALTER TABLE `profil_guru`
  ADD CONSTRAINT `profil_guru_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `profil_siswa`
--
ALTER TABLE `profil_siswa`
  ADD CONSTRAINT `profil_siswa_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
