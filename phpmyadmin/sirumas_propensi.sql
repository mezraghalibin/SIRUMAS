-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 13 Apr 2016 pada 05.43
-- Versi Server: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sirumas_propensi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `file_lampiran`
--

CREATE TABLE `file_lampiran` (
  `id_pengumuman` int(10) UNSIGNED NOT NULL,
  `file` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `hibah`
--

CREATE TABLE `hibah` (
  `id_hibah` int(10) UNSIGNED NOT NULL,
  `nama_hibah` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8_unicode_ci NOT NULL,
  `kategori_hibah` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `besar_dana` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `pemberi` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `tgl_awal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tgl_akhir` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `staf_riset` varchar(25) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `komponen_nilai_laporan`
--

CREATE TABLE `komponen_nilai_laporan` (
  `id_laporan` int(10) UNSIGNED NOT NULL,
  `reviewer` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `nama_komp` text COLLATE utf8_unicode_ci NOT NULL,
  `nilai` double(25,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `komponen_nilai_proposal`
--

CREATE TABLE `komponen_nilai_proposal` (
  `id_proposal` int(10) UNSIGNED NOT NULL,
  `staf_riset` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `nama_komp` text COLLATE utf8_unicode_ci NOT NULL,
  `nilai` double(25,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan`
--

CREATE TABLE `laporan` (
  `id_laporan` int(10) UNSIGNED NOT NULL,
  `tipe_progres` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pengumpul` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `judul` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dosen` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `id_proposal` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `menilai_laporan`
--

CREATE TABLE `menilai_laporan` (
  `id_laporan` int(10) UNSIGNED NOT NULL,
  `reviewer` varchar(25) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `menilai_proposal`
--

CREATE TABLE `menilai_proposal` (
  `id_proposal` int(10) UNSIGNED NOT NULL,
  `staf_riset` varchar(25) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `menyesuaikan_keuangan`
--

CREATE TABLE `menyesuaikan_keuangan` (
  `staf_keuangan` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `id_proposal` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `komentar` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2016_04_11_072956_create_users_table', 1),
('2016_04_11_073006_create_pengumuman_table', 1),
('2016_04_11_073008_create_file_lampiran_table', 1),
('2016_04_11_073009_create_pesan_user_table', 1),
('2016_04_11_073011_create_hibah_table', 1),
('2016_04_11_073013_create_proposal_table', 1),
('2016_04_11_073014_create_laporan_table', 1),
('2016_04_11_073018_create_menilai_laporan_table', 1),
('2016_04_11_073019_create_menyesuaikan_keuangan_table', 1),
('2016_04_11_073021_create_komponen_nilai_laporan_table', 1),
('2016_04_11_073022_create_menilai_proposal_table', 1),
('2016_04_11_073024_create_komponen_nilai_proposal_table', 1),
('2016_04_11_073044_create_mou_peneliti_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mou_peneliti`
--

CREATE TABLE `mou_peneliti` (
  `id_mou` int(10) UNSIGNED NOT NULL,
  `file` text COLLATE utf8_unicode_ci NOT NULL,
  `peneliti` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `judul` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `staf_riset` varchar(25) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id_pengumuman` int(10) UNSIGNED NOT NULL,
  `nomor` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `staf_riset` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `tgl_post` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `judul` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `kategori` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `konten` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesan_user`
--

CREATE TABLE `pesan_user` (
  `username` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `id_pesan` int(10) UNSIGNED NOT NULL,
  `penerima` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `isread` tinyint(1) NOT NULL,
  `subjek` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `pesan` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `file` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `proposal`
--

CREATE TABLE `proposal` (
  `id_proposal` int(10) UNSIGNED NOT NULL,
  `nama_pengaju` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `no_hp` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `e-mail` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nip/nup` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `dosen` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kategori` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `judul_proposal` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `file` text COLLATE utf8_unicode_ci NOT NULL,
  `id_hibah` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `username` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `nama` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `no_pengenal` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `spesifik_role` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`username`, `nama`, `no_pengenal`, `role`, `spesifik_role`) VALUES
('azadya.p', 'Azadya Prikhaerannisa', '1306404683', 'staff', 'divisi keuangan'),
('Budi', 'Budi Budiarto', '123456789', 'mahasiswa', 'mahasiswa'),
('muhammad.ezra', 'Muhammad Ezra Ghalibin', '1306382915', 'staff', 'divisi riset'),
('muhammad.ihcsan', 'Muhammad Ihcsan Kamil Supri', '1306382770', 'mahasiswa', 'mahasiswa'),
('yara.azura', 'Yara Azura Sanurian', '1306382934', 'staff', 'dosen');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `file_lampiran`
--
ALTER TABLE `file_lampiran`
  ADD PRIMARY KEY (`id_pengumuman`,`file`);

--
-- Indexes for table `hibah`
--
ALTER TABLE `hibah`
  ADD PRIMARY KEY (`id_hibah`),
  ADD KEY `hibah_staf_riset_foreign` (`staf_riset`);

--
-- Indexes for table `komponen_nilai_laporan`
--
ALTER TABLE `komponen_nilai_laporan`
  ADD PRIMARY KEY (`id_laporan`,`reviewer`),
  ADD KEY `komponen_nilai_laporan_reviewer_foreign` (`reviewer`);

--
-- Indexes for table `komponen_nilai_proposal`
--
ALTER TABLE `komponen_nilai_proposal`
  ADD PRIMARY KEY (`id_proposal`,`staf_riset`),
  ADD KEY `komponen_nilai_proposal_staf_riset_foreign` (`staf_riset`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id_laporan`),
  ADD KEY `laporan_dosen_foreign` (`dosen`),
  ADD KEY `laporan_id_proposal_foreign` (`id_proposal`);

--
-- Indexes for table `menilai_laporan`
--
ALTER TABLE `menilai_laporan`
  ADD PRIMARY KEY (`id_laporan`,`reviewer`),
  ADD KEY `menilai_laporan_reviewer_foreign` (`reviewer`);

--
-- Indexes for table `menilai_proposal`
--
ALTER TABLE `menilai_proposal`
  ADD PRIMARY KEY (`id_proposal`,`staf_riset`),
  ADD KEY `menilai_proposal_staf_riset_foreign` (`staf_riset`);

--
-- Indexes for table `menyesuaikan_keuangan`
--
ALTER TABLE `menyesuaikan_keuangan`
  ADD PRIMARY KEY (`staf_keuangan`,`id_proposal`),
  ADD KEY `menyesuaikan_keuangan_id_proposal_foreign` (`id_proposal`);

--
-- Indexes for table `mou_peneliti`
--
ALTER TABLE `mou_peneliti`
  ADD PRIMARY KEY (`id_mou`),
  ADD KEY `mou_peneliti_staf_riset_foreign` (`staf_riset`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id_pengumuman`),
  ADD KEY `pengumuman_staf_riset_foreign` (`staf_riset`);

--
-- Indexes for table `pesan_user`
--
ALTER TABLE `pesan_user`
  ADD PRIMARY KEY (`id_pesan`),
  ADD UNIQUE KEY `pesan_user_username_unique` (`username`);

--
-- Indexes for table `proposal`
--
ALTER TABLE `proposal`
  ADD PRIMARY KEY (`id_proposal`),
  ADD KEY `proposal_dosen_foreign` (`dosen`),
  ADD KEY `proposal_id_hibah_foreign` (`id_hibah`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hibah`
--
ALTER TABLE `hibah`
  MODIFY `id_hibah` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id_laporan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mou_peneliti`
--
ALTER TABLE `mou_peneliti`
  MODIFY `id_mou` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id_pengumuman` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pesan_user`
--
ALTER TABLE `pesan_user`
  MODIFY `id_pesan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `proposal`
--
ALTER TABLE `proposal`
  MODIFY `id_proposal` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `file_lampiran`
--
ALTER TABLE `file_lampiran`
  ADD CONSTRAINT `file_lampiran_id_pengumuman_foreign` FOREIGN KEY (`id_pengumuman`) REFERENCES `pengumuman` (`id_pengumuman`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `hibah`
--
ALTER TABLE `hibah`
  ADD CONSTRAINT `hibah_staf_riset_foreign` FOREIGN KEY (`staf_riset`) REFERENCES `users` (`username`);

--
-- Ketidakleluasaan untuk tabel `komponen_nilai_laporan`
--
ALTER TABLE `komponen_nilai_laporan`
  ADD CONSTRAINT `komponen_nilai_laporan_id_laporan_foreign` FOREIGN KEY (`id_laporan`) REFERENCES `laporan` (`id_laporan`),
  ADD CONSTRAINT `komponen_nilai_laporan_reviewer_foreign` FOREIGN KEY (`reviewer`) REFERENCES `users` (`username`);

--
-- Ketidakleluasaan untuk tabel `komponen_nilai_proposal`
--
ALTER TABLE `komponen_nilai_proposal`
  ADD CONSTRAINT `komponen_nilai_proposal_id_proposal_foreign` FOREIGN KEY (`id_proposal`) REFERENCES `proposal` (`id_proposal`),
  ADD CONSTRAINT `komponen_nilai_proposal_staf_riset_foreign` FOREIGN KEY (`staf_riset`) REFERENCES `users` (`username`);

--
-- Ketidakleluasaan untuk tabel `laporan`
--
ALTER TABLE `laporan`
  ADD CONSTRAINT `laporan_dosen_foreign` FOREIGN KEY (`dosen`) REFERENCES `users` (`username`),
  ADD CONSTRAINT `laporan_id_proposal_foreign` FOREIGN KEY (`id_proposal`) REFERENCES `proposal` (`id_proposal`);

--
-- Ketidakleluasaan untuk tabel `menilai_laporan`
--
ALTER TABLE `menilai_laporan`
  ADD CONSTRAINT `menilai_laporan_id_laporan_foreign` FOREIGN KEY (`id_laporan`) REFERENCES `laporan` (`id_laporan`),
  ADD CONSTRAINT `menilai_laporan_reviewer_foreign` FOREIGN KEY (`reviewer`) REFERENCES `users` (`username`);

--
-- Ketidakleluasaan untuk tabel `menilai_proposal`
--
ALTER TABLE `menilai_proposal`
  ADD CONSTRAINT `menilai_proposal_id_proposal_foreign` FOREIGN KEY (`id_proposal`) REFERENCES `proposal` (`id_proposal`),
  ADD CONSTRAINT `menilai_proposal_staf_riset_foreign` FOREIGN KEY (`staf_riset`) REFERENCES `users` (`username`);

--
-- Ketidakleluasaan untuk tabel `menyesuaikan_keuangan`
--
ALTER TABLE `menyesuaikan_keuangan`
  ADD CONSTRAINT `menyesuaikan_keuangan_id_proposal_foreign` FOREIGN KEY (`id_proposal`) REFERENCES `proposal` (`id_proposal`),
  ADD CONSTRAINT `menyesuaikan_keuangan_staf_keuangan_foreign` FOREIGN KEY (`staf_keuangan`) REFERENCES `users` (`username`);

--
-- Ketidakleluasaan untuk tabel `mou_peneliti`
--
ALTER TABLE `mou_peneliti`
  ADD CONSTRAINT `mou_peneliti_staf_riset_foreign` FOREIGN KEY (`staf_riset`) REFERENCES `users` (`username`);

--
-- Ketidakleluasaan untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD CONSTRAINT `pengumuman_staf_riset_foreign` FOREIGN KEY (`staf_riset`) REFERENCES `users` (`username`);

--
-- Ketidakleluasaan untuk tabel `pesan_user`
--
ALTER TABLE `pesan_user`
  ADD CONSTRAINT `pesan_user_username_foreign` FOREIGN KEY (`username`) REFERENCES `users` (`username`);

--
-- Ketidakleluasaan untuk tabel `proposal`
--
ALTER TABLE `proposal`
  ADD CONSTRAINT `proposal_dosen_foreign` FOREIGN KEY (`dosen`) REFERENCES `users` (`username`),
  ADD CONSTRAINT `proposal_id_hibah_foreign` FOREIGN KEY (`id_hibah`) REFERENCES `hibah` (`id_hibah`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
