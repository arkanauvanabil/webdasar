-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2025 at 05:13 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sehatconnect_dokter`
--

-- --------------------------------------------------------

--
-- Table structure for table `arkan_admin`
--

CREATE TABLE `arkan_admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `arkan_admin`
--

INSERT INTO `arkan_admin` (`id_admin`, `username`, `password`) VALUES
(9, 'admin', '$2y$10$Giecdd6/D8l7J5pA3q2L..hcz3kkbBW3RD0SYwlf8Zo50FDx9TKOG');

-- --------------------------------------------------------

--
-- Table structure for table `arkan_dokter`
--

CREATE TABLE `arkan_dokter` (
  `id_dokter` int(11) NOT NULL,
  `nama_dokter` varchar(100) DEFAULT NULL,
  `spesialis` varchar(100) DEFAULT NULL,
  `id_klinik` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `arkan_dokter`
--

INSERT INTO `arkan_dokter` (`id_dokter`, `nama_dokter`, `spesialis`, `id_klinik`) VALUES
(1, 'Dr. Celoz', 'Otot', 1),
(2, 'Dr. Tirta', 'Psikolog', 2);

-- --------------------------------------------------------

--
-- Table structure for table `arkan_klinik`
--

CREATE TABLE `arkan_klinik` (
  `id_klinik` int(11) NOT NULL,
  `nama_klinik` varchar(100) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `arkan_klinik`
--

INSERT INTO `arkan_klinik` (`id_klinik`, `nama_klinik`, `telepon`, `alamat`) VALUES
(1, 'Klinik BYONCOMBAT', '081317653280', 'jl.Andalas'),
(2, 'Tirta Geng', '08162789206', 'Jl Limau Manih');

-- --------------------------------------------------------

--
-- Table structure for table `arkan_konsultasi`
--

CREATE TABLE `arkan_konsultasi` (
  `id_konsultasi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `keluhan` text NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `arkan_konsultasi`
--

INSERT INTO `arkan_konsultasi` (`id_konsultasi`, `id_user`, `id_dokter`, `keluhan`, `tanggal`) VALUES
(1, 4, 1, 'Otot saya Keseleo', '2025-07-01 23:10:06'),
(2, 4, 1, 'Batuk darah nabil berwarna abu abu', '2025-07-02 02:37:44');

-- --------------------------------------------------------

--
-- Table structure for table `arkan_obat`
--

CREATE TABLE `arkan_obat` (
  `id_obat` int(11) NOT NULL,
  `nama_obat` varchar(100) DEFAULT NULL,
  `jenis_obat` varchar(100) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `id_klinik` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `arkan_obat`
--

INSERT INTO `arkan_obat` (`id_obat`, `nama_obat`, `jenis_obat`, `harga`, `stok`, `id_klinik`) VALUES
(1, 'Gliseril Guaiakolat ', 'Batuk Berdahak', 15000, 99, 1);

-- --------------------------------------------------------

--
-- Table structure for table `arkan_user`
--

CREATE TABLE `arkan_user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `arkan_user`
--

INSERT INTO `arkan_user` (`id_user`, `nama_user`, `email`, `password`) VALUES
(1, 'siwa', 'siwa@gmail.com', '$2y$10$cqhsYxFDX0bBx2KVcmXfjudRI48vKtldZ.c8GtWJq/C4ozYQ.6r5u'),
(2, 'lakasud', 'lakasud@gmail.com', '$2y$10$Z/ESMVlaMd6LT9OgAUl1IOt5K/CMmutA4F5q8e2scWocpdam9q3z6'),
(3, 'Nabil', 'nabil@gmail.com', '$2y$10$fpsXwS.fR0fZPXA5FCRTHOJnCYjgXrRZT.g2PXOJbysUlhiDo8YDi'),
(4, 'sarky', 'sarkyy@gmail.com', '$2y$10$wqkzAXyeKzDZwZhNIo.78uWJS/AJLvdj2aRGRtlo/lBtZwCvI3zD.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arkan_admin`
--
ALTER TABLE `arkan_admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `arkan_dokter`
--
ALTER TABLE `arkan_dokter`
  ADD PRIMARY KEY (`id_dokter`),
  ADD KEY `id_klinik` (`id_klinik`);

--
-- Indexes for table `arkan_klinik`
--
ALTER TABLE `arkan_klinik`
  ADD PRIMARY KEY (`id_klinik`);

--
-- Indexes for table `arkan_konsultasi`
--
ALTER TABLE `arkan_konsultasi`
  ADD PRIMARY KEY (`id_konsultasi`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_dokter` (`id_dokter`);

--
-- Indexes for table `arkan_obat`
--
ALTER TABLE `arkan_obat`
  ADD PRIMARY KEY (`id_obat`),
  ADD KEY `id_klinik` (`id_klinik`);

--
-- Indexes for table `arkan_user`
--
ALTER TABLE `arkan_user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `arkan_admin`
--
ALTER TABLE `arkan_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `arkan_dokter`
--
ALTER TABLE `arkan_dokter`
  MODIFY `id_dokter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `arkan_klinik`
--
ALTER TABLE `arkan_klinik`
  MODIFY `id_klinik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `arkan_konsultasi`
--
ALTER TABLE `arkan_konsultasi`
  MODIFY `id_konsultasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `arkan_obat`
--
ALTER TABLE `arkan_obat`
  MODIFY `id_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `arkan_user`
--
ALTER TABLE `arkan_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `arkan_dokter`
--
ALTER TABLE `arkan_dokter`
  ADD CONSTRAINT `arkan_dokter_ibfk_1` FOREIGN KEY (`id_klinik`) REFERENCES `arkan_klinik` (`id_klinik`);

--
-- Constraints for table `arkan_konsultasi`
--
ALTER TABLE `arkan_konsultasi`
  ADD CONSTRAINT `arkan_konsultasi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `arkan_user` (`id_user`),
  ADD CONSTRAINT `arkan_konsultasi_ibfk_2` FOREIGN KEY (`id_dokter`) REFERENCES `arkan_dokter` (`id_dokter`);

--
-- Constraints for table `arkan_obat`
--
ALTER TABLE `arkan_obat`
  ADD CONSTRAINT `arkan_obat_ibfk_1` FOREIGN KEY (`id_klinik`) REFERENCES `arkan_klinik` (`id_klinik`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
