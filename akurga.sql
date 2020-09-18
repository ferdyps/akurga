-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2020 at 06:24 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

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
  `kd_surat` varchar(50) NOT NULL,
  `no_surat` varchar(50) NOT NULL,
  `pengirim` varchar(100) NOT NULL,
  `tujuan` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `gambar_srt` text NOT NULL,
  `tgl_terima` date NOT NULL,
  `tgl_surat` date NOT NULL,
  `tgl_buat` date NOT NULL,
  `rt` varchar(6) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `arsip_surat`
--

INSERT INTO `arsip_surat` (`kd_surat`, `no_surat`, `pengirim`, `tujuan`, `keterangan`, `gambar_srt`, `tgl_terima`, `tgl_surat`, `tgl_buat`, `rt`, `id_user`) VALUES
('001-ASM-RT.01-VI-2020', '002/ASM/RT.03/VI/2020', 'RT 03', '', 'Surat pengantar RT 03', 'contoh_arsip3.jpg', '2020-06-02', '2020-06-02', '2020-06-02', 'RT 01', 8);

-- --------------------------------------------------------

--
-- Table structure for table `komplain`
--

CREATE TABLE `komplain` (
  `nomor_komplain` varchar(21) NOT NULL,
  `tanggal_komplain` date NOT NULL,
  `lokasi` varchar(150) DEFAULT NULL,
  `keluhan` text NOT NULL,
  `status` varchar(20) NOT NULL,
  `lingkup` varchar(2) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `gambar` text NOT NULL,
  `rt` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `komplain`
--

INSERT INTO `komplain` (`nomor_komplain`, `tanggal_komplain`, `lokasi`, `keluhan`, `status`, `lingkup`, `nik`, `gambar`, `rt`) VALUES
('001-KOMPLAIN-I-2020', '2020-07-02', '', 'sampah berserakan', 'selesai', 'RT', '1234567890123456', 'sampah-di-trotoar2.jpg', 'RT 01'),
('002-KOMPLAIN-I-2020', '2020-07-02', 'dijalan utama depan gang', 'Jalan rusak', 'selesai', 'RW', '1234567890123456', 'perbaikan-jalan-rusak-di-jombang-terkendala-aspal-yang-belum-datang_m_1309251.jpg', 'RT 01');

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `notif_id` int(11) NOT NULL,
  `notif_for` varchar(40) NOT NULL,
  `atr_pk` varchar(100) NOT NULL,
  `old_time_val` time NOT NULL,
  `new_time_val` time NOT NULL,
  `notif_msg` varchar(255) NOT NULL,
  `notif_datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `rt` varchar(7) NOT NULL,
  `notif_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notulensi_rpt`
--

CREATE TABLE `notulensi_rpt` (
  `no_notulen` varchar(30) NOT NULL,
  `tembusan` varchar(100) NOT NULL,
  `dokumentasi_rpt` varchar(100) NOT NULL,
  `keterangan_dokumentasi` text NOT NULL,
  `uraian_notulen_cetak` text NOT NULL,
  `uraian_notulen` text NOT NULL,
  `penulis` varchar(60) NOT NULL,
  `tgl_buat` date NOT NULL,
  `status` tinyint(4) NOT NULL,
  `rt` varchar(6) NOT NULL,
  `no_udg` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `no_pembayaran` int(10) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `pembayaran_bulan` varchar(50) NOT NULL,
  `tahun` int(5) NOT NULL,
  `nominal` varchar(20) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `gambar` text NOT NULL,
  `rt` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`no_pengeluaran`, `diberikan_kepada`, `tanggal`, `nominal`, `digunakan_untuk`, `gambar`, `rt`) VALUES
(68, 'Kebersihan', '2020-06-07', 150000, 'Biaya Gotong Royong', '', '1'),
(70, 'Fotocopy', '2020-06-07', 50000, 'Fotocopy Buku Iuran Warga baru ', 'detail_pembayaran2.PNG', '1'),
(71, 'Gaji Pegawai', '2020-06-07', 300000, 'Gaji Pegawai Baru', 'angin muson barat dan timur.webp', '1'),
(72, 'Gaji Pegawai', '2020-06-07', 300000, 'Gaji Pegawai Baru', 'anti pasat.jfif', '1'),
(73, 'Duka Cita', '2020-06-07', 150000, 'Gaji Pegawai yaa baru banget', '', '1'),
(74, 'Kesehatan', '2020-06-07', 150000, 'Menjenguk Orang Sakit rawat inap', '', '1'),
(75, 'Kebersihan', '2020-06-07', 100000, 'Biaya Gotong Royong', 'database.PNG', '1'),
(76, 'Kebersihan', '2020-06-07', 150000, 'Membeli makanan untuk gotong royong di rt 01', 'Logo-Bank-BTN.jpg', '1');

-- --------------------------------------------------------

--
-- Table structure for table `status_surat`
--

CREATE TABLE `status_surat` (
  `id` int(11) NOT NULL,
  `nomor_surat` varchar(20) NOT NULL,
  `pesan` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `expired_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status_surat`
--

INSERT INTO `status_surat` (`id`, `nomor_surat`, `pesan`, `status`, `created_at`, `expired_date`) VALUES
(90, '001-SK-II-VI-2020', '', 'pengajuan', '2020-06-16 07:47:14', '0000-00-00'),
(91, '001-SK-II-VI-2020', 'penulisan pembuatan menggunakan huruf kecil', 'ditolak', '2020-06-16 07:53:43', '0000-00-00'),
(92, '001-SK-II-VI-2020', '', 'pengajuan', '2020-06-16 07:54:18', '0000-00-00'),
(93, '001-SK-II-VI-2020', '', 'diterima', '2020-06-17 23:52:04', '2020-06-17'),
(94, '002-SK-II-VI-2020', '', 'pengajuan', '2020-06-18 00:11:12', '0000-00-00'),
(95, '002-SK-II-VI-2020', '', 'diterima', '2020-06-25 01:50:32', '2020-06-27'),
(96, '001-SK-V-VI-2020', '', 'pengajuan', '2020-06-18 09:28:32', '0000-00-00'),
(97, '001-SK-V-VI-2020', 'keperluan salah', 'ditolak', '2020-06-18 12:59:23', '0000-00-00'),
(98, '003-SK-II-VI-2020', '', 'pengajuan', '2020-06-27 02:50:50', '0000-00-00'),
(99, '003-SK-II-VI-2020', 'tulis keperluan dengan lengkap', 'ditolak', '2020-06-27 02:51:58', '0000-00-00'),
(100, '003-SK-II-VI-2020', '', 'pengajuan', '2020-06-27 02:52:33', '0000-00-00'),
(101, '003-SK-II-VI-2020', '', 'diterima', '2020-06-27 02:52:56', '2020-06-29'),
(102, '004-SK-II-VI-2020', '', 'pengajuan', '2020-06-27 23:32:43', '0000-00-00'),
(103, '005-SK-II-VI-2020', '', 'pengajuan', '2020-06-27 23:32:55', '0000-00-00'),
(104, '004-SK-II-VI-2020', '', 'diterima', '2020-06-28 00:57:46', '2020-06-30'),
(105, '001-SK-I-VII-2020', '', 'pengajuan', '2020-07-02 02:44:17', '0000-00-00'),
(106, '001-SK-I-VII-2020', 'tuliskan kepanjangan ktp', 'ditolak', '2020-07-02 02:45:43', '0000-00-00'),
(107, '001-SK-I-VII-2020', '', 'pengajuan', '2020-07-02 02:46:37', '0000-00-00'),
(108, '001-SK-I-VII-2020', '', 'diterima', '2020-07-02 02:47:14', '2020-07-04');

-- --------------------------------------------------------

--
-- Table structure for table `surat_pengantar`
--

CREATE TABLE `surat_pengantar` (
  `nomor_surat` varchar(20) NOT NULL,
  `keperluan` varchar(255) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `rt` varchar(10) NOT NULL,
  `pengurus` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat_pengantar`
--

INSERT INTO `surat_pengantar` (`nomor_surat`, `keperluan`, `nik`, `rt`, `pengurus`) VALUES
('001-SK-I-VII-2020', 'pembuatan Kartu Tanda Penduduk (KTP)', '1234567890123456', 'RT 01', 'agus'),
('001-SK-II-VI-2020', 'pembuatan SKCK', '4533201680829480', 'RT 02', 'Ferdy Pittardi Susanto'),
('001-SK-V-VI-2020', 'beli bengkoang', '4507861997611390', 'RT 05', ''),
('002-SK-II-VI-2020', 'pembaruan KK', '4533201680829480', 'RT 02', 'Ferdy Pittardi Susanto'),
('003-SK-II-VI-2020', 'pembuatan KTP', '4485923051621117', 'RT 02', 'Ferdy Pittardi Susanto'),
('004-SK-II-VI-2020', 'pembaruan KK', '4485923051621117', 'RT 02', 'Ferdy Pittardi Susanto'),
('005-SK-II-VI-2020', 'pembuatan SIM', '4485923051621117', 'RT 02', '');

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
  `usulan_rpt` text NOT NULL,
  `tgl_udg` date NOT NULL,
  `tgl_buat` date NOT NULL,
  `tgl_acc` date NOT NULL,
  `status` tinyint(1) NOT NULL,
  `rt` varchar(6) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat_undangan`
--

INSERT INTO `surat_undangan` (`no_udg`, `lampiran_udg`, `sifat_udg`, `perihal_udg`, `tujuan_surat`, `tempat_udg`, `isi_surat`, `jam_udg`, `acara_udg`, `catatan`, `tembusan`, `usulan_rpt`, `tgl_udg`, `tgl_buat`, `tgl_acc`, `status`, `rt`, `id_user`) VALUES
('001-RPT-RT.01-VI-2020', '_', 'Biasa', 'Undangan Rapat', 'Warga RT 01', 'Pos Tengah RT 01', 'Sehubungan dengan akan dioptimalkan kepengurusan dan program-program kerja RT 009/07 serta banyak hal yang perlu dibahas mengenai kinerja Pengurus RT 009/07 periode 2016/2017, maka dengan ini saya mengundang segenap jajaran Pengurus RT 009/07 untuk hadir dalam rapat tertutup yang akan dilaksanakan pada :', '17:00:00', '1.  Evaluasi kinerja\r\n2.  Pembenahan Struktur Lembaga/Organisasi RT 009/07\r\n3.  Merencanakan dan menetapkan program kerja tambahan\r\n', '', '1. Ketua RW 01', 'pengoptimalan kepengurusan dan program-program kerja RT 009/07 ', '2020-06-02', '2020-06-02', '0000-00-00', 1, 'RT 01', 8),
('002-RPT-RT.01-VI-2020', '_', 'Penting', 'asdsa', 'Warga RT 01', 'Rumah Ketua RT 01', 'asdsadas', '20:00:00', 'asdasdasd', '', 'asdad', 'test123', '2020-06-06', '2020-06-06', '0000-00-00', 1, 'RT 01', 8);

--
-- Triggers `surat_undangan`
--
DELIMITER $$
CREATE TRIGGER `after_suratundangan_update` AFTER UPDATE ON `surat_undangan` FOR EACH ROW BEGIN
    IF OLD.jam_udg <> new.jam_udg THEN
        INSERT INTO notifikasi
(notif_id, notif_for, atr_pk, old_time_val, new_time_val, notif_msg, notif_datetime, rt, notif_user_id)
        VALUES(
null,
"Ketua", 
new.no_udg,
old.jam_udg,
new.jam_udg,
"terjadi perubahan jam rapat pada no surat",
now(), 
new.rt, 
new.id_user
);
    END IF;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tarif`
--

CREATE TABLE `tarif` (
  `kodeiuran` int(11) NOT NULL,
  `jenis_iuran` varchar(50) NOT NULL,
  `nominal` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tarif`
--

INSERT INTO `tarif` (`kodeiuran`, `jenis_iuran`, `nominal`) VALUES
(1, 'Tetap', '15000'),
(2, 'Sementara', '10000');

-- --------------------------------------------------------

--
-- Table structure for table `tindak_lanjut`
--

CREATE TABLE `tindak_lanjut` (
  `id_tindak_lanjut` int(11) NOT NULL,
  `hasil_tindak_lanjut` text NOT NULL,
  `tgl_tindak_lanjut` date NOT NULL,
  `nomor_komplain` varchar(21) NOT NULL,
  `gambar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tindak_lanjut`
--

INSERT INTO `tindak_lanjut` (`id_tindak_lanjut`, `hasil_tindak_lanjut`, `tgl_tindak_lanjut`, `nomor_komplain`, `gambar`) VALUES
(24, 'berdasarkan laporan putri wartini, telah dipasang sebuah tempat sampah', '2020-07-02', '001-KOMPLAIN-I-2020', 'bak-sampah-4-jenis-472.jpg'),
(25, 'sudah ada upaya perbaikan', '2020-07-02', '002-KOMPLAIN-I-2020', '309af04a99c4735b1ccda933ce2107ed1.jpg');

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
(3, 'hengki', 'hengki@gmail.com', 'b5cd1263f2d38a19e20a88aa2f932403', 'Ketua RT'),
(5, 'ferdyps', 'fpittardi@gmail.com', '8b4128b957d0b7291777656bf30b50d5', 'Ketua RT'),
(7, 'aep01', 'aep01@gmail.com', '4bb3b07f17884366977bffff01a28c6a', 'Ketua RW'),
(8, 'agus', 'agus@gmail.com', 'fdf169558242ee051cca1479770ebac3', 'Ketua RT'),
(9, 'nurohman', 'nurohman@gmail.com', 'effa46f5a3f9880f7d8696e20ffdf127', 'Ketua RT'),
(11, 'wawan', 'wawan@gmail.com', '0a000f688d85de79e3761dec6816b2a5', 'Ketua RT'),
(12, 'raditya', 'raditya@gmail.com', 'cdf6b37f50728ed655037ac8edfa658d', 'Warga'),
(13, 'pauliarm', 'pauliarm@gmail.com', '47a7e1dd30b0fae8b2e955ed70368c0c', 'Warga'),
(14, 'samiah', 'samiah@gmail.com', '3cfc357401991cb27627f1e1c239fd3b', 'Warga'),
(15, 'putri', 'putri@gmail.com', '4093fed663717c843bea100d17fb67c8', 'Warga');

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
  `nokk` varchar(16) DEFAULT NULL,
  `agama` varchar(10) NOT NULL,
  `jk` varchar(10) NOT NULL,
  `hub_dlm_kel` varchar(10) DEFAULT NULL,
  `status` varchar(10) NOT NULL,
  `nama_jalan` varchar(100) NOT NULL,
  `no_rumah` varchar(5) NOT NULL,
  `gang` varchar(20) NOT NULL,
  `jenis_warga` varchar(10) NOT NULL,
  `rt` varchar(2) NOT NULL,
  `gambar` text NOT NULL,
  `id_kepala_keluarga` varchar(20) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `valid` int(2) NOT NULL,
  `pesan` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `warga`
--

INSERT INTO `warga` (`nik`, `nama`, `nohp`, `tempat_lahir`, `tanggal_lahir`, `pendidikan`, `pekerjaan`, `nokk`, `agama`, `jk`, `hub_dlm_kel`, `status`, `nama_jalan`, `no_rumah`, `gang`, `jenis_warga`, `rt`, `gambar`, `id_kepala_keluarga`, `id_user`, `valid`, `pesan`, `timestamp`) VALUES
('1234567890123456', 'putri wartini', '082244557788', 'bandung', '1993-07-02', 'DIPLOMA IV/STRATA I', 'KARYAWAN SWASTA', '', 'islam', 'perempuan', NULL, 'lajang', 'Diponegoro', '12', 'Bbk.Ciamis I', 'Sementara', '01', 'tempalte_ktp_indonesia_by_variozr77-da4sm338.jpg', NULL, 15, 1, '', '2020-07-02 02:43:21'),
('1531880715014990', 'Hengki Agung Kusnadi', '', 'Bandung', '2019-12-31', 'TIDAK/BELUM SEKOLAH', 'PEGAWAI NEGERI SIPIL', '2055837842368096', 'islam', 'laki-laki', 'suami', 'menikah', 'kalidium', '12989', 'Bbk.Ciamis III', 'Tetap', '04', '', NULL, 3, 1, '', '2020-06-15 09:53:52'),
('1747261675324794', 'Ferdy Pittardi Susanto', '081281443700', 'Tangerang', '1999-10-15', 'AKADEMI/DIPLOMA III/S. MUDA', 'MAHASISWA', '', 'islam', 'laki-laki', NULL, 'lajang', 'Sukapura', '27', 'Bbk.Ciamis I', 'Sementara', '02', '', NULL, 5, 1, '', '2020-06-15 09:51:22'),
('2810295063970361', 'aep saifudin', '089725678861', 'bandung', '1965-07-14', 'DIPLOMA IV/STRATA I', 'KARYAWAN SWASTA', '4233457452400906', 'islam', 'laki-laki', NULL, 'menikah', 'adiyaksa', '134', 'Bbk.Ciamis III', 'Tetap', '01', '', NULL, 7, 1, '', '2020-06-15 10:36:00'),
('4485923051621117', 'Samiah Lintang Halimah', '02455785476', 'Tasikmalaya', '1996-06-07', 'DIPLOMA II', 'KARYAWAN SWASTA', NULL, 'islam', 'perempuan', NULL, 'menikah', 'ketapang', '12', 'Bbk.Ciamis II', 'Sementara', '02', 'tempalte_ktp_indonesia_by_variozr77-da4sm336.jpg', NULL, 14, 1, '', '2020-06-27 02:50:27'),
('4507861997611390', 'Paulin Pudjiastuti', '068519211887', 'Cilegon', '1968-10-02', 'DIPLOMA IV/STRATA I', 'GURU', '', 'kristen', 'perempuan', NULL, 'menikah', 'Otista', '50', 'Bbk.Ciamis V', 'Sementara', '05', 'tempalte_ktp_indonesia_by_variozr77-da4sm335.jpg', NULL, 13, 1, '', '2020-06-18 09:28:13'),
('4533201680829480', 'Raditya Prasetyo', '035389480932', 'bandung', '1990-06-12', 'DIPLOMA IV/STRATA I', 'KARYAWAN SWASTA', '', 'islam', 'laki-laki', NULL, 'lajang', 'dahlia', '15', 'Bbk.Ciamis II', 'Sementara', '02', 'tempalte_ktp_indonesia_by_variozr77-da4sm331.jpg', NULL, 12, 1, '', '2020-06-18 09:12:54'),
('6385058052497984', 'nurohman', '081108220833', 'sumedang', '2020-04-01', 'TIDAK/BELUM SEKOLAH', 'BELUM/TIDAK BEKERJA', '', 'islam', 'laki-laki', NULL, 'lajang', 'adiyaksa', '12', 'Bbk.Ciamis I', 'Sementara', '05', '', NULL, 9, 1, '', '2020-07-01 15:49:19'),
('7471031306640002', 'Wawan Razak', '082245882231', 'bandung', '1987-06-12', 'DIPLOMA IV/STRATA I', 'KARYAWAN SWASTA', '', 'islam', 'laki-laki', NULL, 'lajang', 'wetan', '13', 'Bbk.Ciamis II', 'Sementara', '03', '5eb150f612742.jpg', NULL, 11, 1, '', '2020-06-15 09:51:51'),
('8798718442997151', 'agus', '082208330844', 'serang', '1973-07-11', 'TAMAT SD/SEDERAJAT', 'BELUM/TIDAK BEKERJA', '', 'islam', 'laki-laki', NULL, 'lajang', 'adiyaksa', '12', 'Bbk.Ciamis I', 'Sementara', '01', '', NULL, 8, 1, '', '2020-07-01 15:49:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arsip_surat`
--
ALTER TABLE `arsip_surat`
  ADD PRIMARY KEY (`kd_surat`),
  ADD KEY `id_user` (`id_user`);

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
  ADD PRIMARY KEY (`no_notulen`),
  ADD KEY `no_udg` (`no_udg`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`no_pembayaran`),
  ADD KEY `nik` (`nik`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`no_pengeluaran`);

--
-- Indexes for table `status_surat`
--
ALTER TABLE `status_surat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nomor_surat` (`nomor_surat`);

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
-- Indexes for table `tarif`
--
ALTER TABLE `tarif`
  ADD PRIMARY KEY (`kodeiuran`);

--
-- Indexes for table `tindak_lanjut`
--
ALTER TABLE `tindak_lanjut`
  ADD PRIMARY KEY (`id_tindak_lanjut`),
  ADD KEY `id_komplain` (`nomor_komplain`);

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
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `no_pembayaran` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `no_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `status_surat`
--
ALTER TABLE `status_surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `tindak_lanjut`
--
ALTER TABLE `tindak_lanjut`
  MODIFY `id_tindak_lanjut` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `arsip_surat`
--
ALTER TABLE `arsip_surat`
  ADD CONSTRAINT `arsip_surat_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `notulensi_rpt`
--
ALTER TABLE `notulensi_rpt`
  ADD CONSTRAINT `notulensi_rpt_ibfk_1` FOREIGN KEY (`no_udg`) REFERENCES `surat_undangan` (`no_udg`);

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `warga` (`nik`);

--
-- Constraints for table `surat_undangan`
--
ALTER TABLE `surat_undangan`
  ADD CONSTRAINT `surat_undangan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
