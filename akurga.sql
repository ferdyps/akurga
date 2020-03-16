-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Mar 2020 pada 17.16
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
-- Database: `akurga`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `arsip_surat`
--

CREATE TABLE `arsip_surat` (
  `kd_surat` varchar(10) NOT NULL,
  `no_surat` varchar(50) NOT NULL,
  `pengirim` varchar(100) NOT NULL,
  `tujuan` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `gambar_srt` text NOT NULL,
  `tgl_terima` date NOT NULL,
  `tgl_surat` date NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `arsip_surat`
--

INSERT INTO `arsip_surat` (`kd_surat`, `no_surat`, `pengirim`, `tujuan`, `keterangan`, `gambar_srt`, `tgl_terima`, `tgl_surat`, `id_user`) VALUES
('0001-ASM-', 'asd12', 'asdasd', '', 'asdasd', '15095191694383.jpg', '2020-03-11', '2020-03-09', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `decline_warga`
--

CREATE TABLE `decline_warga` (
  `id` int(11) NOT NULL,
  `pesan` varchar(255) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `decline_warga`
--

INSERT INTO `decline_warga` (`id`, `pesan`, `nik`, `created_at`) VALUES
(1, 'pekerjaan salah', '456456456', '2020-02-23 03:21:02'),
(2, 'pekerjaan salah', '456456456', '2020-02-23 14:11:19'),
(3, 'dasdad', '456456456', '2020-02-29 02:32:33'),
(4, 'asdas', '00', '2020-02-29 03:14:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil_komplain`
--

CREATE TABLE `hasil_komplain` (
  `id_tindak_lanjut` int(11) NOT NULL,
  `tindak_lanjut` text NOT NULL,
  `tgl_tindak_lanjut` date NOT NULL,
  `nomor_komplain` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `komplain`
--

CREATE TABLE `komplain` (
  `nomor_komplain` varchar(20) NOT NULL,
  `tanggal_komplain` date NOT NULL,
  `lokasi` varchar(150) DEFAULT NULL,
  `keluhan` text NOT NULL,
  `status` varchar(20) NOT NULL,
  `lingkup` varchar(2) NOT NULL,
  `nik` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `komplain`
--

INSERT INTO `komplain` (`nomor_komplain`, `tanggal_komplain`, `lokasi`, `keluhan`, `status`, `lingkup`, `nik`) VALUES
('0001-KOMPLAIN', '2019-12-15', '', 'air kotor', 'pengajuan', '', '12'),
('0002-KOMPLAIN', '2019-12-17', '', 'jalan berlubang', 'selesai', '', '12'),
('0003-KOMPLAIN', '2019-12-19', 'sebelah warung', 'saluran air mampet', 'pengajuan', '', '12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `notulensi_rpt`
--

CREATE TABLE `notulensi_rpt` (
  `no_notulen` varchar(30) NOT NULL,
  `tembusan` varchar(100) NOT NULL,
  `dokumentasi_rpt` varchar(100) NOT NULL,
  `uraian_notulen` text NOT NULL,
  `penulis` varchar(60) NOT NULL,
  `tgl_buat` date NOT NULL,
  `tgl_acc` date NOT NULL,
  `status` tinyint(4) NOT NULL,
  `no_udg` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `notulensi_rpt`
--

INSERT INTO `notulensi_rpt` (`no_notulen`, `tembusan`, `dokumentasi_rpt`, `uraian_notulen`, `penulis`, `tgl_buat`, `tgl_acc`, `status`, `no_udg`) VALUES
('0001-NOT-', 'cek', '1511252958924.png', '<p>coba aja dulu</p>\r\n', 'adminMaster', '2020-03-11', '0000-00-00', 0, '0001-RPT-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `no_pembayaran` int(10) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `pembayaran_bulan` varchar(50) NOT NULL,
  `nominal` varchar(20) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`no_pembayaran`, `nik`, `pembayaran_bulan`, `nominal`, `tanggal`) VALUES
(5, '122', 'Januari', '10000', '0000-00-00'),
(34, '122', 'Februari', '10000', '2019-12-13'),
(35, '234', 'Februari', '10000', '2019-12-13'),
(36, '12', 'Januari', '15000', '2019-12-16'),
(37, '12', 'Januari', '15000', '2019-12-16'),
(38, '12', 'Februari', '15000', '2019-12-16'),
(39, '12', 'Maret', '15000', '2019-12-16'),
(40, '12', 'Oktober', '15000', '2019-12-16'),
(42, '12', 'Desember', '15000', '2019-12-19'),
(43, '122', 'Agustus', '10000', '2020-02-22'),
(44, '122', 'Maret', '15000', '2020-02-25'),
(45, '122', 'September', '15000', '2020-02-29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `no_pengeluaran` int(11) NOT NULL,
  `diberikan_kepada` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `nominal` int(11) NOT NULL,
  `digunakan_untuk` text NOT NULL,
  `gambar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengeluaran`
--

INSERT INTO `pengeluaran` (`no_pengeluaran`, `diberikan_kepada`, `tanggal`, `nominal`, `digunakan_untuk`, `gambar`) VALUES
(7, 'Bapak Yanto', '2019-11-15', 2000000, 'pembangunan Jalan ', 'gambar.jpg'),
(8, 'Ibu Tina', '2019-11-16', 100000, 'Acara 17 agustus', 'gambar.jpg'),
(15, 'Hesti ', '2019-11-27', 12000, 'Biaya Fotocopy ', 'gambar.jpg'),
(18, 'Shinta', '2019-11-21', 150000, 'Biaya Fotocopy ', 'gambar.jpg'),
(19, 'yyyyy', '2019-11-20', 40000, 'Membeli makanan untuk gotong royong', 'gambar.jpg'),
(20, 'Riska', '2019-11-15', 100000, 'Biaya Gotong Royong', 'gambar.jpg'),
(21, 'Riska', '2019-11-14', 190000, 'Membeli makanan untuk gotong royong', 'gambar.jpg'),
(22, 'Zey', '2019-11-09', 12000, 'Biaya Fotocopy ', 'gambar.jpg'),
(23, 'Sasa', '2019-12-04', 150000, 'Biaya Kebersihan', 'gambar.jpg'),
(24, 'Susanti', '2019-12-21', 100000, 'Membeli peralatan gotong royong', 'gambar.jpg'),
(25, 'Bapak Husein', '2019-12-13', 2000000, 'Biaya Kebersihan sampah', 'gambar.jpg'),
(26, 'Mirna', '0000-00-00', 500000, 'Acara 17 agustus', 'download.png'),
(27, 'Bapak Sutarno', '0000-00-00', 150000, 'Komisi Kebersihan', 'BPMN_As_Is.jpg'),
(28, 'Bapak yyyy', '0000-00-00', 150000, 'Biaya Listrik Pos', 'BPMN_As_Is1.jpg'),
(29, 'Rahmi', '2019-12-14', 150000, 'Biaya Keamanan', 'ERD_proyek.jpg'),
(30, 'Ibu Santi', '2019-12-15', 100000, 'Biaya Konsumsi Makan', 'userpersona21.png'),
(31, 'Ibu Yanti', '2019-12-16', 500000, 'Konsumsi 17 Agustus', 'WhatsApp_Image_2019-11-01_at_10_14_38_(1).jpeg'),
(32, 'Kebersihan', '2019-12-16', 500000, 'Membeli alat alat kebersihan', ''),
(33, 'Fotocopy', '2019-12-16', 50000, 'Fotocopy Buku Iuran Warga Terbaru', ''),
(34, 'Fotocopy', '2019-12-18', 50, 'Biaya Fotocopy Undangan Rapat ', 'input_iuran_keluar_akurga.PNG'),
(35, 'Gaji Pegawai', '2019-12-18', 500000, 'Gaji Pegawai Keamanan', 'login_baru_akurga.PNG'),
(36, 'Fotocopy', '2019-12-19', 50000, 'Fotocopy Buku Iuran wargga', ''),
(37, 'Kesehatan', '2019-12-26', 150000, 'Menjenguk Orang Sakit', 'WhatsApp_Image_2019-11-01_at_10_14_38_(1)2.jpeg'),
(38, 'Gaji Pegawai', '2020-01-21', 500000, 'Gaji Bulanan Pegawai', 'login_baru_akurga1.PNG'),
(39, 'Fotocopy', '2020-01-21', 255000, 'Fotocopy Undangan', 'Form_iuran_keluar.png'),
(40, 'Gaji Pegawai', '2020-01-21', 150000, 'Biaya Gotong Royong', 'Tampil_Iuran_Masuk_Kolektor.png'),
(41, 'Fotocopy', '2020-02-22', 300000, 'Foto Copy Barang', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_surat`
--

CREATE TABLE `status_surat` (
  `id` int(11) NOT NULL,
  `nomor_surat` varchar(20) NOT NULL,
  `pesan` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `status_surat`
--

INSERT INTO `status_surat` (`id`, `nomor_surat`, `pesan`, `status`, `created_at`) VALUES
(22, '0001-SK-I-', '', 'pengajuan', '2020-02-12 09:24:15'),
(23, '0001-SK-I-', '', 'diterima', '2020-02-12 09:25:23'),
(24, '0002-SK-I-', '', 'pengajuan', '2020-02-13 07:24:37'),
(25, '0002-SK-I-', 'tulis keperluan yang bener', 'ditolak', '2020-02-13 09:38:41'),
(26, '0002-SK-I-', '', 'pengajuan', '2020-02-14 03:55:40'),
(27, '0002-SK-I-', 'amal tidak memerlukan surat pengantar', 'ditolak', '2020-03-02 13:07:21'),
(28, '0002-SK-I-', '', 'pengajuan', '2020-03-02 13:11:53'),
(29, '0002-SK-I-', 'tidak boleh', 'ditolak', '2020-03-02 13:12:43'),
(30, '0002-SK-I-', '', 'pengajuan', '2020-03-03 13:31:39'),
(31, '0002-SK-I-', 'sdlajksldjlkad', 'ditolak', '2020-03-03 13:37:08'),
(32, '0002-SK-I-', 'sdlajksldjlkad', 'ditolak', '2020-03-03 13:37:36'),
(33, '0002-SK-I-', '', 'pengajuan', '2020-03-03 13:39:30'),
(34, '0002-SK-I-', 'asdasd', 'ditolak', '2020-03-03 13:43:49'),
(35, '0002-SK-I-', '', 'pengajuan', '2020-03-03 13:45:05'),
(36, '0002-SK-I-', 'adadada', 'ditolak', '2020-03-03 13:45:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_pengantar`
--

CREATE TABLE `surat_pengantar` (
  `nomor_surat` varchar(20) NOT NULL,
  `tanggal_surat` date NOT NULL,
  `keperluan` varchar(255) NOT NULL,
  `nik` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `surat_pengantar`
--

INSERT INTO `surat_pengantar` (`nomor_surat`, `tanggal_surat`, `keperluan`, `nik`) VALUES
('0001-SK-I-', '2020-02-14', 'nikah', '12'),
('0002-SK-I-', '2020-03-04', 'beli rokok', '12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_undangan`
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
  `status` tinyint(1) NOT NULL,
  `usulan_rpt` text NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `surat_undangan`
--

INSERT INTO `surat_undangan` (`no_udg`, `lampiran_udg`, `sifat_udg`, `perihal_udg`, `tujuan_surat`, `tempat_udg`, `isi_surat`, `jam_udg`, `acara_udg`, `catatan`, `tembusan`, `tgl_udg`, `tgl_buat`, `tgl_acc`, `status`, `usulan_rpt`, `id_user`) VALUES
('0001-RPT-', '1 lembar', 'Segera', 'alsmd', 'alsd', 'aksdn', 'alksdn', '20:00:00', 'kjaskjsajksab', '', 'alskdn', '2020-03-12', '2020-03-11', '0000-00-00', 1, '', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `password`, `role`) VALUES
(1, 'admin', '', '21232f297a57a5a743894a0e4a801fc3', 'adminMaster'),
(2, 'warga', '', 'warga', 'Warga'),
(3, 'terserah01', 'terserah@gmail.com', 'e00b29d5b34c3f78df09d45921c9ec47', 'Warga'),
(5, 'ferdyps', 'fpittardi@gmail.com', '8b4128b957d0b7291777656bf30b50d5', 'Ketua RT');

-- --------------------------------------------------------

--
-- Struktur dari tabel `warga`
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
-- Dumping data untuk tabel `warga`
--

INSERT INTO `warga` (`nik`, `nama`, `nohp`, `tempat_lahir`, `tanggal_lahir`, `pendidikan`, `pekerjaan`, `nokk`, `agama`, `jk`, `hub_dlm_kel`, `status`, `nama_jalan`, `no_rumah`, `gang`, `jenis_warga`, `id_kepala_keluarga`, `id_user`, `valid`) VALUES
('00', 'samiun', '098098098', 'serang', '2019-12-17', 'DIPLOMA IV/STRATA I', 'GURU', '', 'katolik', 'perempuan', NULL, 'menikah', 'adiyaksa', '12', 'Bbk.Ciamis I', 'Sementara', NULL, 0, 2),
('009', 'Samsul', '', 'Palembang', '2004-12-17', 'SLTA/SEDERAJAT', 'KARYAWAN BUMN', '555', 'hindu', 'laki-laki', 'suami', 'menikah', 'adiyaksa', '32', 'Bbk.Ciamis III', 'Tetap', NULL, 0, 0),
('0987654356788', 'Budogol', '097865674', 'Cianjur', '0000-00-00', 'STRATA III', 'TENTARA NASIONAL INDONESIA', NULL, 'islam', 'laki-laki', NULL, 'menikah', 'Microwave V', '659', 'Bbk.Ciamis III', 'Sementara', NULL, 0, 0),
('12', 'siapa aja', '', 'Dimanamana', '2019-12-31', 'TIDAK/BELUM SEKOLAH', 'PEGAWAI NEGERI SIPIL', '1212', 'islam', 'laki-laki', 'suami', 'menikah', 'kalidium', '12989', 'Bbk.Ciamis III', 'Tetap', NULL, 3, 1),
('122', 'terserah', '12', 'Dimanamana', '2019-12-31', 'DIPLOMA I/II', 'PEGAWAI NEGERI SIPIL', '', 'islam', 'laki-laki', NULL, 'menikah', 'Cisangkan', '12', 'Bbk.Ciamis II', 'Sementara', NULL, 0, 1),
('123123', 'Ferdy Pittardi Susanto', '081281443700', 'Tangerang', '1999-10-15', 'AKADEMI/DIPLOMA III/S. MUDA', 'MAHASISWA', '', 'islam', 'laki-laki', NULL, 'lajang', 'Sukapura', '27', 'Bbk.Ciamis I', 'Sementara', NULL, 5, 1),
('123123123', 'Hendra', '087808780878', 'Bandung', '1999-12-01', 'SLTA/SEDERAJAT', 'MAHASISWA', NULL, 'islam', 'laki-laki', NULL, 'lajang', 'adiyaksa', '10', 'Bbk.Ciamis IV', 'Sementara', NULL, 0, 1),
('234', 'maemunah', '098', 'medan', '0000-00-00', 'DIPLOMA IV/STRATA I', 'KARYAWAN SWASTA', '', 'islam', 'perempuan', NULL, 'menikah', 'adiyaksa', '134', 'Bbk.Ciamis III', 'Sementara', NULL, 0, 1),
('25111999', 'Fadil Armando', '082208220822', 'Bengkulu', '1999-11-25', 'STRATA III', 'PEGAWAI NEGERI SIPIL', '', 'islam', 'laki-laki', NULL, 'menikah', '', '123', 'Bbk.Ciamis IV', 'Sementara', NULL, 0, 0),
('4045', 'icad wakwaw', '', 'bandung', '1212-12-12', 'SLTA/SEDERAJAT', 'PEGAWAI NEGERI SIPIL', '345', 'hindu', 'laki-laki', 'suami', 'menikah', '', '123', 'Bbk.Ciamis V', 'Tetap', NULL, 0, 1),
('456456456', 'Wahyuni', '', 'Bandung', '0000-00-00', 'DIPLOMA IV/STRATA I', 'DOSEN', '771', 'islam', 'perempuan', 'istri', 'menikah', 'adiyaksa', '13', 'Bbk.Ciamis III', 'Tetap', NULL, 0, 0),
('8743567', 'Admesh', '8906858', 'Kupang', '2019-09-03', 'TIDAK/BELUM SEKOLAH', 'BELUM/TIDAK BEKERJA', '', 'islam', 'laki-laki', NULL, 'menikah', 'adiyaksa', '123', 'Bbk.Ciamis I', 'Sementara', NULL, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `arsip_surat`
--
ALTER TABLE `arsip_surat`
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `decline_warga`
--
ALTER TABLE `decline_warga`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nik` (`nik`);

--
-- Indeks untuk tabel `hasil_komplain`
--
ALTER TABLE `hasil_komplain`
  ADD PRIMARY KEY (`id_tindak_lanjut`),
  ADD KEY `id_komplain` (`nomor_komplain`);

--
-- Indeks untuk tabel `komplain`
--
ALTER TABLE `komplain`
  ADD PRIMARY KEY (`nomor_komplain`),
  ADD KEY `nik` (`nik`);

--
-- Indeks untuk tabel `notulensi_rpt`
--
ALTER TABLE `notulensi_rpt`
  ADD PRIMARY KEY (`no_notulen`),
  ADD KEY `no_udg` (`no_udg`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`no_pembayaran`),
  ADD KEY `nik` (`nik`);

--
-- Indeks untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`no_pengeluaran`);

--
-- Indeks untuk tabel `status_surat`
--
ALTER TABLE `status_surat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nomor_surat` (`nomor_surat`);

--
-- Indeks untuk tabel `surat_pengantar`
--
ALTER TABLE `surat_pengantar`
  ADD PRIMARY KEY (`nomor_surat`),
  ADD KEY `nik` (`nik`);

--
-- Indeks untuk tabel `surat_undangan`
--
ALTER TABLE `surat_undangan`
  ADD PRIMARY KEY (`no_udg`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `warga`
--
ALTER TABLE `warga`
  ADD PRIMARY KEY (`nik`),
  ADD KEY `id_kepala_keluarga` (`id_kepala_keluarga`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `decline_warga`
--
ALTER TABLE `decline_warga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `hasil_komplain`
--
ALTER TABLE `hasil_komplain`
  MODIFY `id_tindak_lanjut` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `no_pembayaran` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `no_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT untuk tabel `status_surat`
--
ALTER TABLE `status_surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `arsip_surat`
--
ALTER TABLE `arsip_surat`
  ADD CONSTRAINT `arsip_surat_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `notulensi_rpt`
--
ALTER TABLE `notulensi_rpt`
  ADD CONSTRAINT `notulensi_rpt_ibfk_1` FOREIGN KEY (`no_udg`) REFERENCES `surat_undangan` (`no_udg`);

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `warga` (`nik`);

--
-- Ketidakleluasaan untuk tabel `surat_undangan`
--
ALTER TABLE `surat_undangan`
  ADD CONSTRAINT `surat_undangan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
