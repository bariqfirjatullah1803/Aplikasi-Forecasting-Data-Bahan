-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Agu 2021 pada 15.34
-- Versi server: 10.4.16-MariaDB
-- Versi PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_forecast`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_spk`
--

CREATE TABLE `tb_spk` (
  `id_spk` int(11) NOT NULL,
  `nama_pemilik` varchar(255) DEFAULT NULL,
  `jabatan_pemilik` varchar(255) DEFAULT NULL,
  `nama_pekerja` varchar(255) DEFAULT NULL,
  `jabatan_pekerja` varchar(255) DEFAULT NULL,
  `alamat_pekerja` varchar(255) DEFAULT NULL,
  `id_transaksi` varchar(255) DEFAULT NULL,
  `date_created` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_spk`
--
ALTER TABLE `tb_spk`
  ADD PRIMARY KEY (`id_spk`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_spk`
--
ALTER TABLE `tb_spk`
  MODIFY `id_spk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
