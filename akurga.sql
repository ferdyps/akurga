-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2019 at 03:24 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 5.6.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `akurga`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `password`, `role`) VALUES
(1, 'admin', '', 'admin', 'adminMaster');

-- --------------------------------------------------------

--
-- Table structure for table `warga`
--

CREATE TABLE `warga` (
  `nik` varchar(20) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nohp` varchar(13) DEFAULT NULL,
  `tempat_lahir` varchar(25) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `pendidikan` varchar(30) NOT NULL,
  `pekerjaan` varchar(30) NOT NULL,
  `nokk` varchar(14) DEFAULT NULL,
  `agama` varchar(10) NOT NULL,
  `jk` varchar(10) NOT NULL,
  `hub_dlm_kel` varchar(10) DEFAULT NULL,
  `status` varchar(10) NOT NULL,
  `no_rumah` varchar(5) NOT NULL,
  `gang` varchar(10) NOT NULL,
  `jenis_warga` varchar(10) NOT NULL,
  `id_kepala_keluarga` varchar(20) DEFAULT NULL,
  `valid` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `warga`
--

INSERT INTO `warga` (`nik`, `nama`, `nohp`, `tempat_lahir`, `tanggal_lahir`, `pendidikan`, `pekerjaan`, `nokk`, `agama`, `jk`, `hub_dlm_kel`, `status`, `no_rumah`, `gang`, `jenis_warga`, `id_kepala_keluarga`, `valid`) VALUES
('12', 'terserah', NULL, 'Dimanamana', '2019-12-31', 'TIDAK/BELUM SEKOLAH', 'PEGAWAI NEGERI SIPIL', '1212', 'islam', 'laki-laki', 'suami', 'menikah', '12', 'Bbk.Ciamis', 'Tetap', NULL, 0),
('122', 'terserah', '12', 'Dimanamana', '2019-12-31', 'BELUM TAMAT SD/SEDERAJAT', 'PEGAWAI NEGERI SIPIL', NULL, 'islam', 'laki-laki', NULL, 'menikah', '12', 'Bbk.Ciamis', 'Sementara', NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `warga`
--
ALTER TABLE `warga`
  ADD PRIMARY KEY (`nik`),
  ADD KEY `id_kepala_keluarga` (`id_kepala_keluarga`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
