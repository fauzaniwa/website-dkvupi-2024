-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Feb 2024 pada 17.18
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
-- Database: `dkv`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(50) NOT NULL,
  `username_admin` varchar(50) NOT NULL,
  `email_admin` varchar(50) NOT NULL,
  `password_admin` varchar(50) NOT NULL,
  `created_admin` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_admin` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_ip_admin` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `username_admin`, `email_admin`, `password_admin`, `created_admin`, `last_admin`, `last_ip_admin`) VALUES
(1, 'Muhammad Fauzan Aztera', 'fauzanaztera', 'fauzan.aztera@gmail.com', '1234', '2024-01-14 05:12:28', '2024-01-14 05:12:28', '172.00.00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dosen`
--

CREATE TABLE `dosen` (
  `id_dosen` int(11) NOT NULL,
  `nama_dosen` varchar(50) NOT NULL,
  `nip_dosen` varchar(50) NOT NULL,
  `email_dosen` varchar(50) NOT NULL,
  `password_dosen` varchar(50) NOT NULL,
  `phone_dosen` varchar(50) NOT NULL,
  `instagram_dosen` varchar(50) NOT NULL,
  `bio_dosen` text NOT NULL,
  `img_dosen` varchar(100) NOT NULL,
  `created_dosen` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_dosen` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_ip_dosen` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id_mahasiswa` int(11) NOT NULL,
  `name_mahasiswa` varchar(50) NOT NULL,
  `nim_mahasiswa` varchar(50) NOT NULL,
  `tgllahir_mahasiswa` date NOT NULL,
  `email_mahasiswa` varchar(50) NOT NULL,
  `password_mahasiswa` varchar(50) NOT NULL,
  `phone_mahasiswa` varchar(50) NOT NULL,
  `instagram_mahasiswa` varchar(50) NOT NULL,
  `linkedin_mahasiswa` varchar(100) NOT NULL,
  `behance_mahasiswa` varchar(100) NOT NULL,
  `deskripsi_mahasiswa` text NOT NULL,
  `angkatan_mahasiswa` varchar(5) NOT NULL,
  `img_mahasiswa` varchar(100) NOT NULL,
  `created_mahasiswa` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_mahasiswa` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_ip_mahasiswa` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id_dosen`);

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id_dosen` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
