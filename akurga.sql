-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2019 at 02:25 AM
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
  `keterangan` text NOT NULL,
  `gambar_srt` text NOT NULL,
  `tgl_terima` date NOT NULL,
  `tgl_surat` date NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `arsip_surat`
--

INSERT INTO `arsip_surat` (`kd_surat`, `no_surat`, `pengirim`, `keterangan`, `gambar_srt`, `tgl_terima`, `tgl_surat`, `id_user`) VALUES
('0001-ASM-', 'asd123', 'asdasd', 'asihdbashbdiasbn', '', '0000-00-00', '2019-12-10', 1),
('0002-ASM-', 'sjdnksjfk', 'kjsdfkjdbsq', 'asdasdad', 'notulen-rapat-02-maret-2014-1-638.jpg', '0000-00-00', '2019-12-11', 1),
('0003-ASM-', 'jdnssnadl', 'laknsdasd', 'asdasdasdad', '', '0000-00-00', '2019-12-17', 1),
('0004-ASM-', '001-RTPE', 'desa sukapura', 'surat permohonan', 'notulen-rapat-02-maret-2014-1-638.jpg', '0000-00-00', '2019-12-16', 1),
('0005-ASM-', 'sasaran', 'asbun', 'wqewqeqwqweqwqweqweqwqweqwqwe', 'Waterfall-model-phases.jpg', '0000-00-00', '2019-12-10', 1),
('0006-ASM-', 'qweqwe', 'qweqw', 'qweqweqwqw', '', '0000-00-00', '2019-12-14', 1),
('0007-ASM-', 'asdas', 'asdsad', 'adsfsdafsds', 'Waterfall-model-phases1.jpg', '0000-00-00', '2019-12-17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `komplain`
--

CREATE TABLE `komplain` (
  `nomor_komplain` varchar(20) NOT NULL,
  `tanggal_komplain` date NOT NULL,
  `lokasi` varchar(150) DEFAULT NULL,
  `keluhan` text NOT NULL,
  `nik` varchar(20) NOT NULL
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
  `tgl_acc` date NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notulensi_rpt`
--

INSERT INTO `notulensi_rpt` (`no_notulen`, `lampiran`, `tembusan`, `uraian_notulen`, `tgl_buat`, `tgl_acc`, `status`) VALUES
('0001-NOT-', '3 lampiran', '1. Y.th ksadkandlk', 'sadnsalkdnasdnsalkasndsa', '2019-12-16', '0000-00-00', 0),
('0002-NOT-', 'kasdlanslk', 'alskdnalksdn', 'lakndslkasndlask', '2019-12-17', '0000-00-00', 0),
('0003-NOT-', '1 lembar', 'Yth. ketua RT 02', 'sadmksadm mk kdsadka m', '2019-12-17', '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `no_pengeluaran` int(11) NOT NULL,
  `diberikan_kepada` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `nominal` int(11) NOT NULL,
  `digunakan_untuk` text NOT NULL,
  `gambar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `surat_pengantar`
--

CREATE TABLE `surat_pengantar` (
  `nomor_surat` varchar(20) NOT NULL,
  `tanggal_surat` date NOT NULL,
  `keperluan` varchar(255) NOT NULL,
  `nik` varchar(20) NOT NULL
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
  `tgl_udg` date NOT NULL,
  `tgl_buat` date NOT NULL,
  `tgl_acc` date NOT NULL,
  `usulan_rpt` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'admin', '', '21232f297a57a5a743894a0e4a801fc3', 'adminMaster'),
(2, 'warga', '', 'warga', 'Warga'),
(3, 'terserah01', 'terserah@gmail.com', 'e00b29d5b34c3f78df09d45921c9ec47', 'Warga'),
(5, 'ferdyps', 'fpittardi@gmail.com', '855cca62dc8f291f5d5bc03b0c75b6ec', 'Warga');

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
  `nama_jalan` varchar(100) NOT NULL,
  `no_rumah` varchar(5) NOT NULL,
  `gang` varchar(20) NOT NULL,
  `jenis_warga` varchar(10) NOT NULL,
  `id_kepala_keluarga` varchar(20) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `valid` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `warga`
--

INSERT INTO `warga` (`nik`, `nama`, `nohp`, `tempat_lahir`, `tanggal_lahir`, `pendidikan`, `pekerjaan`, `nokk`, `agama`, `jk`, `hub_dlm_kel`, `status`, `nama_jalan`, `no_rumah`, `gang`, `jenis_warga`, `id_kepala_keluarga`, `id_user`, `valid`) VALUES
('00', 'samiun', '098098098', 'serang', '2019-12-17', 'DIPLOMA IV/STRATA I', 'GURU', '', 'katolik', 'perempuan', NULL, 'menikah', 'adiyaksa', '12', 'Bbk.Ciamis I', 'Sementara', NULL, 0, 0),
('009', 'Samsul', '', 'Palembang', '2004-12-17', 'SLTA/SEDERAJAT', 'KARYAWAN BUMN', '555', 'hindu', 'laki-laki', 'suami', 'menikah', 'adiyaksa', '32', 'Bbk.Ciamis III', 'Tetap', NULL, 0, 0),
('0987654356788', 'Budogol', '097865674', 'Cianjur', '0000-00-00', 'STRATA III', 'TENTARA NASIONAL INDONESIA', NULL, 'islam', 'laki-laki', NULL, 'menikah', 'Microwave V', '659', 'Bbk.Ciamis III', 'Sementara', NULL, 0, 0),
('12', 'siapa aja', '', 'Dimanamana', '2019-12-31', 'TIDAK/BELUM SEKOLAH', 'PEGAWAI NEGERI SIPIL', '1212', 'islam', 'laki-laki', 'suami', 'menikah', 'kalidium', '12989', 'Bbk.Ciamis III', 'Tetap', NULL, 3, 1),
('122', 'terserah', '12', 'Dimanamana', '2019-12-31', 'DIPLOMA I/II', 'PEGAWAI NEGERI SIPIL', '', 'islam', 'laki-laki', NULL, 'menikah', 'Cisangkan', '12', 'Bbk.Ciamis II', 'Sementara', NULL, 0, 1),
('123123', 'Ferdy Pittardi Susanto', '081281443700', 'Tangerang', '1999-10-15', 'AKADEMI/DIPLOMA III/S. MUDA', 'MAHASISWA', '', 'islam', 'laki-laki', NULL, 'lajang', 'Sukapura', '27', 'Bbk.Ciamis I', 'Sementara', NULL, 5, 1),
('234', 'gogor', '098', 'medan', '1212-12-11', 'DIPLOMA IV/STRATA I', 'KARYAWAN SWASTA', '', 'islam', 'perempuan', NULL, 'menikah', '', '134', 'Bbk.Ciamis III', 'Sementara', NULL, 0, 1),
('25111999', 'Fadil Armando', '082208220822', 'Bengkulu', '1999-11-25', 'STRATA III', 'PEGAWAI NEGERI SIPIL', '', 'islam', 'laki-laki', NULL, 'menikah', '', '123', 'Bbk.Ciamis IV', 'Sementara', NULL, 0, 0),
('4045', 'icad wakwaw', '', 'bandung', '1212-12-12', 'SLTA/SEDERAJAT', 'PEGAWAI NEGERI SIPIL', '345', 'hindu', 'laki-laki', 'suami', 'menikah', '', '123', 'Bbk.Ciamis V', 'Tetap', NULL, 0, 1),
('8743567', 'Admesh', '8906858', 'Kupang', '2019-09-03', 'TIDAK/BELUM SEKOLAH', 'BELUM/TIDAK BEKERJA', '', 'islam', 'laki-laki', NULL, 'menikah', 'adiyaksa', '123', 'Bbk.Ciamis I', 'Sementara', NULL, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `komplain`
--
ALTER TABLE `komplain`
  ADD PRIMARY KEY (`nomor_komplain`),
  ADD KEY `nik` (`nik`);

--
-- Indexes for table `notulensi_rpt`
--
ALTER TABLE `notulensi_rpt`
  ADD PRIMARY KEY (`no_notulen`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`no_pengeluaran`);

--
-- Indexes for table `surat_pengantar`
--
ALTER TABLE `surat_pengantar`
  ADD PRIMARY KEY (`nomor_surat`),
  ADD KEY `nik` (`nik`);

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
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `no_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
