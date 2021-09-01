-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Feb 2020 pada 21.04
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alternatif`
--

CREATE TABLE `alternatif` (
  `id_alternatif` int(11) NOT NULL,
  `id_kain` int(11) NOT NULL,
  `id_sup` int(11) NOT NULL,
  `tgl_beli` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `alternatif`
--

INSERT INTO `alternatif` (`id_alternatif`, `id_kain`, `id_sup`, `tgl_beli`) VALUES
(13, 1, 1, '2019-10-02'),
(14, 1, 2, '2019-10-10'),
(15, 1, 3, '2019-10-05'),
(16, 1, 4, '2019-11-03'),
(17, 1, 5, '2019-11-08'),
(18, 2, 1, '2019-09-05'),
(19, 2, 2, '2019-09-14'),
(20, 2, 3, '2019-09-08'),
(21, 2, 4, '2019-10-09'),
(22, 2, 5, '2019-10-25'),
(23, 3, 1, '2019-09-17'),
(24, 3, 2, '2019-09-19'),
(25, 3, 3, '2019-10-30'),
(26, 3, 4, '2019-11-21'),
(27, 3, 5, '2019-11-08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `harga`
--

CREATE TABLE `harga` (
  `id_alternatif` int(11) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `harga`
--

INSERT INTO `harga` (`id_alternatif`, `nilai`) VALUES
(13, 1000000),
(14, 2200000),
(15, 1500000),
(16, 1800000),
(17, 2600000),
(18, 2500000),
(19, 1000000),
(20, 1500000),
(21, 1800000),
(22, 2300000),
(23, 1500000),
(24, 2000000),
(25, 1900000),
(26, 2800000),
(27, 1300000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kain`
--

CREATE TABLE `kain` (
  `id_kain` int(11) NOT NULL,
  `nm_kain` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kain`
--

INSERT INTO `kain` (`id_kain`, `nm_kain`) VALUES
(1, 'KATUN'),
(2, 'DENIM'),
(3, 'SIFON');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kecacatan`
--

CREATE TABLE `kecacatan` (
  `id_alternatif` int(11) DEFAULT NULL,
  `nilai` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kecacatan`
--

INSERT INTO `kecacatan` (`id_alternatif`, `nilai`) VALUES
(13, 'Ringan'),
(14, 'Ringan'),
(15, 'Berat'),
(16, 'Berat'),
(17, 'Ringan'),
(18, 'Ringan'),
(19, 'Berat'),
(20, 'Ringan'),
(21, 'Berat'),
(22, 'Ringan'),
(23, 'Berat'),
(24, 'Ringan'),
(25, 'Berat'),
(26, 'Ringan'),
(27, 'Ringan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `kriteria` varchar(50) NOT NULL,
  `kepentingan` float NOT NULL,
  `cost_benefit` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `kriteria`, `kepentingan`, `cost_benefit`) VALUES
(1, 'Harga', 0.35, 'cost'),
(2, 'Kualitas', 0.25, 'benefit'),
(3, 'Pelayanan', 0.25, 'benefit'),
(4, 'Kecacatan', 0.15, 'cost');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kualitas`
--

CREATE TABLE `kualitas` (
  `id_alternatif` int(11) DEFAULT NULL,
  `nilai` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kualitas`
--

INSERT INTO `kualitas` (`id_alternatif`, `nilai`) VALUES
(13, 'Sedang'),
(14, 'Baik'),
(15, 'Buruk'),
(16, 'Sedang'),
(17, 'Baik'),
(18, 'Buruk'),
(19, 'Baik'),
(20, 'Sedang'),
(21, 'Baik'),
(22, 'Sedang'),
(23, 'Baik'),
(24, 'Sedang'),
(25, 'Sedang'),
(26, 'Baik'),
(27, 'Buruk');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelayanan`
--

CREATE TABLE `pelayanan` (
  `id_alternatif` int(11) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pelayanan`
--

INSERT INTO `pelayanan` (`id_alternatif`, `nilai`) VALUES
(13, 2),
(14, 2),
(15, 0),
(16, 2),
(17, 0),
(18, 0),
(19, 3),
(20, 2),
(21, 0),
(22, 1),
(23, 3),
(24, 1),
(25, 2),
(26, 0),
(27, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sub_kriteria`
--

CREATE TABLE `sub_kriteria` (
  `id_sub_kriteria` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `sub_kriteria` varchar(50) NOT NULL,
  `skor` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sub_kriteria`
--

INSERT INTO `sub_kriteria` (`id_sub_kriteria`, `id_kriteria`, `sub_kriteria`, `skor`) VALUES
(46, 1, '>=2.500.000', 1),
(47, 1, '>=2.000.000', 2),
(48, 1, '>=1.700.000', 3),
(49, 1, '>1.400.000', 4),
(50, 1, '<= 1.400.000', 5),
(51, 2, 'Buruk', 1),
(52, 2, 'Sedang', 3),
(53, 2, 'Baik', 5),
(54, 3, '>3 hari', 1),
(55, 3, '>=1 hari', 2),
(56, 3, '0 hari', 3),
(57, 4, 'Ringan', 3),
(58, 4, 'Berat', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id_sup` int(11) NOT NULL,
  `nm_sup` varchar(250) NOT NULL,
  `almt_sup` varchar(250) NOT NULL,
  `no_telp` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id_sup`, `nm_sup`, `almt_sup`, `no_telp`) VALUES
(1, 'Mimi', 'Jl. Kapasan No.169D, Kapasan, Kec. Simokerto, Kota SBY, Jawa Timur 60141', '0857325978'),
(2, 'Surya Indah ', 'JL. Kapasan, No. 169-E, Kapasan, Simokerto, Sidodadi, Surabaya, Kota SBY, Jawa Timur 60141', '0812345367'),
(3, 'Mitra', 'Jl. Gula, Bongkaran, Kec. Pabean Cantian, Kota SBY, Jawa Timur 60161', '0988787546'),
(4, 'Putra', 'Jl. Kapasan No.165, Kapasan, Kec. Simokerto, Kota SBY, Jawa Timur 60141', '0878678443'),
(5, 'Subur Jaya', 'Jl. Kapasan No.194B, Sidodadi, Kec. Simokerto, Kota SBY, Jawa Timur 60145', '0987567337');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `pass` varchar(256) NOT NULL,
  `level` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `user`, `pass`, `level`) VALUES
(1, 'admin', '0d9c19ec3c6044545f05c3458fe390c5', 'manager'),
(2, 'eka', '470b4062ff3bcbab92992a9e1100290f', 'staff');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id_alternatif`),
  ADD KEY `id_kain` (`id_kain`),
  ADD KEY `id_sup` (`id_sup`);

--
-- Indeks untuk tabel `harga`
--
ALTER TABLE `harga`
  ADD KEY `id_alternatif` (`id_alternatif`);

--
-- Indeks untuk tabel `kain`
--
ALTER TABLE `kain`
  ADD PRIMARY KEY (`id_kain`);

--
-- Indeks untuk tabel `kecacatan`
--
ALTER TABLE `kecacatan`
  ADD KEY `id_alternatif` (`id_alternatif`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indeks untuk tabel `kualitas`
--
ALTER TABLE `kualitas`
  ADD KEY `id_alternatif` (`id_alternatif`);

--
-- Indeks untuk tabel `pelayanan`
--
ALTER TABLE `pelayanan`
  ADD KEY `id_alternatif` (`id_alternatif`);

--
-- Indeks untuk tabel `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD PRIMARY KEY (`id_sub_kriteria`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_sup`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id_alternatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  MODIFY `id_sub_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  ADD CONSTRAINT `alternatif_ibfk_1` FOREIGN KEY (`id_kain`) REFERENCES `kain` (`id_kain`),
  ADD CONSTRAINT `alternatif_ibfk_2` FOREIGN KEY (`id_sup`) REFERENCES `supplier` (`id_sup`);

--
-- Ketidakleluasaan untuk tabel `harga`
--
ALTER TABLE `harga`
  ADD CONSTRAINT `harga_ibfk_1` FOREIGN KEY (`id_alternatif`) REFERENCES `alternatif` (`id_alternatif`);

--
-- Ketidakleluasaan untuk tabel `kecacatan`
--
ALTER TABLE `kecacatan`
  ADD CONSTRAINT `kecacatan_ibfk_1` FOREIGN KEY (`id_alternatif`) REFERENCES `alternatif` (`id_alternatif`);

--
-- Ketidakleluasaan untuk tabel `kualitas`
--
ALTER TABLE `kualitas`
  ADD CONSTRAINT `kualitas_ibfk_1` FOREIGN KEY (`id_alternatif`) REFERENCES `alternatif` (`id_alternatif`);

--
-- Ketidakleluasaan untuk tabel `pelayanan`
--
ALTER TABLE `pelayanan`
  ADD CONSTRAINT `pelayanan_ibfk_1` FOREIGN KEY (`id_alternatif`) REFERENCES `alternatif` (`id_alternatif`);

--
-- Ketidakleluasaan untuk tabel `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD CONSTRAINT `sub_kriteria_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
