-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2019 at 02:24 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

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
-- Table structure for table `arsip_surat`
--

CREATE TABLE `arsip_surat` (
  `kd_surat` varchar(10) NOT NULL,
  `no_surat` varchar(50) NOT NULL,
  `pengirim` varchar(100) NOT NULL,
  `tujuan` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `gambar_srt` text NOT NULL,
  `tgl_terima` date NOT NULL,
  `tgl_surat` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notulensi_rpt`
--

CREATE TABLE `notulensi_rpt` (
  `no_notulen` varchar(30) NOT NULL,
  `lampiran` varchar(80) NOT NULL,
  `tembusan` varchar(100) NOT NULL,
  `uraian_notulen` text NOT NULL,
  `tgl_buat` date NOT NULL,
  `tgl_acc` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `surat_undangan`
--

CREATE TABLE `surat_undangan` (
  `no_udg` varchar(30) NOT NULL,
  `lampiran_udg` varchar(80) NOT NULL,
  `sifat_udg` varchar(15) NOT NULL,
  `perihal_udg` varchar(80) NOT NULL,
  `tujuan_surat` varchar(70) NOT NULL,
  `tempat_udg` varchar(70) NOT NULL,
  `isi_surat` text NOT NULL,
  `jam_udg` time NOT NULL,
  `acara_udg` text NOT NULL,
  `catatan` text NOT NULL,
  `tembusan` varchar(100) NOT NULL,
  `daftar_hadir` varchar(100) NOT NULL,
  `tgl_udg` date NOT NULL,
  `tgl_buat` date NOT NULL,
  `tgl_acc` date NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat_undangan`
--

INSERT INTO `surat_undangan` (`no_udg`, `lampiran_udg`, `sifat_udg`, `perihal_udg`, `tujuan_surat`, `tempat_udg`, `isi_surat`, `jam_udg`, `acara_udg`, `catatan`, `tembusan`, `daftar_hadir`, `tgl_udg`, `tgl_buat`, `tgl_acc`, `id_user`) VALUES
('0001/RPT/', '1 lembar', 'Penting', 'Keselamatan harta benda', 'warga RW 01', '2019-12-31', 'asd', '23:59:00', 's', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(20) NOT NULL,
  `jabatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `password`, `role`, `jabatan`) VALUES
(1, 'admin', '', 'admin', 'adminMaster', 'sekretaris RT 01');

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
  `id_user` int(11) NOT NULL,
  `valid` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `warga`
--

INSERT INTO `warga` (`nik`, `nama`, `nohp`, `tempat_lahir`, `tanggal_lahir`, `pendidikan`, `pekerjaan`, `nokk`, `agama`, `jk`, `hub_dlm_kel`, `status`, `no_rumah`, `gang`, `jenis_warga`, `id_kepala_keluarga`, `id_user`, `valid`) VALUES
('1123', 'asdsad', '123123', 'asdadasd', '2019-12-01', 'SLTP/SEDERAJAT', 'KARYAWAN SWASTA', NULL, 'islam', 'laki-laki', NULL, 'menikah', '12', 'Bbk.Ciamis', 'Sementara', NULL, 0, 1),
('12', 'terserah', NULL, 'Dimanamana', '2019-12-31', 'TIDAK/BELUM SEKOLAH', 'PEGAWAI NEGERI SIPIL', '1212', 'islam', 'laki-laki', 'suami', 'menikah', '12', 'Bbk.Ciamis', 'Tetap', NULL, 0, 1),
('122', 'terserah', '12', 'Dimanamana', '2019-12-31', 'BELUM TAMAT SD/SEDERAJAT', 'PEGAWAI NEGERI SIPIL', NULL, 'islam', 'laki-laki', NULL, 'menikah', '12', 'Bbk.Ciamis', 'Sementara', NULL, 0, 1),
('25111999', 'asfasd', '1231233', 'bengkulu', '1999-11-25', 'DIPLOMA I/II', 'KARYAWAN SWASTA', NULL, 'kristen', 'laki-laki', NULL, 'menikah', '1', 'Bbk.Ciamis', 'Sementara', NULL, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notulensi_rpt`
--
ALTER TABLE `notulensi_rpt`
  ADD PRIMARY KEY (`no_notulen`);

--
-- Indexes for table `surat_undangan`
--
ALTER TABLE `surat_undangan`
  ADD PRIMARY KEY (`no_udg`),
  ADD KEY `id_user` (`id_user`);

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
  ADD KEY `id_kepala_keluarga` (`id_kepala_keluarga`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `surat_undangan`
--
ALTER TABLE `surat_undangan`
  ADD CONSTRAINT `surat_undangan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
