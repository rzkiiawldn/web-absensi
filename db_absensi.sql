-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2021 at 06:17 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_absensi`
--

-- --------------------------------------------------------

--
-- Table structure for table `absen`
--

CREATE TABLE `absen` (
  `id_absen` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `absen_masuk` time DEFAULT NULL,
  `absen_pulang` time DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `absen`
--

INSERT INTO `absen` (`id_absen`, `tanggal`, `absen_masuk`, `absen_pulang`, `status`, `keterangan`, `id_user`) VALUES
(98, '2021-05-06', '13:25:13', NULL, NULL, NULL, 13),
(99, '2021-05-19', '13:34:16', NULL, NULL, NULL, 13),
(100, '2021-05-21', '13:34:38', '14:25:45', NULL, NULL, 13),
(101, '2021-05-21', '14:59:37', '15:59:34', NULL, NULL, 14),
(102, '2021-05-24', '09:28:07', '09:55:22', NULL, NULL, 14),
(103, '2021-05-23', '12:12:07', '12:12:25', NULL, NULL, 13),
(104, '2021-05-24', '13:26:17', '13:31:37', NULL, NULL, 15),
(111, '2021-05-24', NULL, NULL, 'Izin', 'acara keluarga', 13);

-- --------------------------------------------------------

--
-- Table structure for table `absen_detail`
--

CREATE TABLE `absen_detail` (
  `id_absen_detail` int(11) NOT NULL,
  `absen_id` int(11) NOT NULL,
  `keterangan_masuk` varchar(225) DEFAULT NULL,
  `keterangan_pulang` varchar(50) DEFAULT NULL,
  `latitude_masuk` text DEFAULT NULL,
  `latitude_pulang` text DEFAULT NULL,
  `longitude_masuk` text DEFAULT NULL,
  `longitude_pulang` text DEFAULT NULL,
  `keterangan_jadwal` varchar(225) DEFAULT NULL,
  `foto_masuk` longtext DEFAULT NULL,
  `foto_pulang` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `absen_detail`
--

INSERT INTO `absen_detail` (`id_absen_detail`, `absen_id`, `keterangan_masuk`, `keterangan_pulang`, `latitude_masuk`, `latitude_pulang`, `longitude_masuk`, `longitude_pulang`, `keterangan_jadwal`, `foto_masuk`, `foto_pulang`) VALUES
(64, 98, 'Masuk', NULL, '-6.2191', NULL, '106.7308', NULL, 'Shift 1', '', NULL),
(65, 99, 'Masuk', NULL, '-6.2191', NULL, '106.7308', NULL, 'Shift 1', '', NULL),
(66, 100, 'Masuk', 'Pulang', '-6.2191', '', '106.7308', '', 'Reguler', '', ''),
(67, 101, 'Masuk', 'Pulang', '-6.2191', '-6.2107262', '106.7308', '106.7116815', 'Shift 2', '', ''),
(68, 102, 'Masuk', 'Pulang', '-6.2304736', '', '106.7116815', '', 'Reguler', '', ''),
(69, 103, 'Masuk', 'Pulang', '-6.2304736', '-6.2304736', '106.7116815', '106.7116815', 'Shift 2', '', ''),
(70, 104, 'Masuk', 'Pulang', '-6.2304736', '-6.2304736', '106.7116815', '106.7116815', 'Reguler', '', ''),
(74, 110, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(75, 111, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cuti_user`
--

CREATE TABLE `cuti_user` (
  `id_cuti_user` int(11) NOT NULL,
  `id_cuti` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tgl_cuti` date NOT NULL,
  `tgl_selesai_cuti` date NOT NULL,
  `jumlah_cuti_user` varchar(11) NOT NULL,
  `alasan_cuti` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cuti_user`
--

INSERT INTO `cuti_user` (`id_cuti_user`, `id_cuti`, `id_user`, `tgl_cuti`, `tgl_selesai_cuti`, `jumlah_cuti_user`, `alasan_cuti`) VALUES
(23, 20, 13, '2021-05-25', '2021-05-27', '2', 'liburan'),
(24, 20, 13, '2021-05-26', '2021-05-27', '1', 'as');

-- --------------------------------------------------------

--
-- Table structure for table `data_cuti`
--

CREATE TABLE `data_cuti` (
  `id_cuti` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `jumlah_cuti` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_cuti`
--

INSERT INTO `data_cuti` (`id_cuti`, `id_user`, `jumlah_cuti`) VALUES
(20, 13, 9);

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `id_divisi` int(11) NOT NULL,
  `divisi` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`id_divisi`, `divisi`) VALUES
(1, 'a'),
(2, 'b');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `jabatan` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `jabatan`) VALUES
(1, 'pm');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_kerja`
--

CREATE TABLE `jadwal_kerja` (
  `id_jadwal` int(11) NOT NULL,
  `jadwal` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jadwal_kerja`
--

INSERT INTO `jadwal_kerja` (`id_jadwal`, `jadwal`) VALUES
(1, 'Reguler'),
(2, 'Shift 1'),
(3, 'Shift 2');

-- --------------------------------------------------------

--
-- Table structure for table `jam_kerja`
--

CREATE TABLE `jam_kerja` (
  `id_jam` int(11) NOT NULL,
  `masuk` time NOT NULL,
  `pulang` time NOT NULL,
  `jadwal_kerja` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jam_kerja`
--

INSERT INTO `jam_kerja` (`id_jam`, `masuk`, `pulang`, `jadwal_kerja`) VALUES
(1, '09:00:00', '15:00:00', '1'),
(2, '06:00:00', '13:00:00', '2');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `id_divisi` int(11) NOT NULL,
  `nik` varchar(225) NOT NULL,
  `nama_karyawan` varchar(225) NOT NULL,
  `alamat_karyawan` text NOT NULL,
  `foto_karyawan` varchar(225) NOT NULL,
  `tahun_bergabung` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `id_user`, `id_jabatan`, `id_divisi`, `nik`, `nama_karyawan`, `alamat_karyawan`, `foto_karyawan`, `tahun_bergabung`) VALUES
(5, 13, 1, 2, 'EL-0001', 'pegawai', 'tgr', '1', 2021),
(6, 14, 1, 1, 'EL-0002', 'rizki', 'tangerang', '1', 2021),
(7, 15, 1, 1, 'EL-0003', 'karyawan', 'ckl', '1', 2021);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `id_level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `id_level`) VALUES
(1, 'admin', '$2y$10$D57ydtRTqjoJco0IisE9MeLBdTM3k2Rd8aKimg7wCQc1dCyc0thD2', 1),
(2, 'hrd', '$2y$10$YrmDxh.1dJHpQ89nOYUSOepfikxPdqRLuK9IV8oiGJMlp64inWyBq', 2),
(13, 'pegawai', '$2y$10$8BYUXK71G31Wv5gN6gL1W.DPBSKwDO7Zk3iksGIXDifi4MPtHo5ZK', 3),
(14, 'rizki', '$2y$10$pB8Hgg1xQekOPX761m4AB.eK/j9sVr.CifKCKUETCGF0YyiMYQStO', 3),
(15, 'karyawan', '$2y$10$HlQX.MV22VwzBfDGkRCPtOdSR/hngK16VLJsiilygOwT3Quqk3FWW', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_akses_menu`
--

CREATE TABLE `user_akses_menu` (
  `id_akses` int(11) NOT NULL,
  `id_level` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `id_sub` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_akses_menu`
--

INSERT INTO `user_akses_menu` (`id_akses`, `id_level`, `id_menu`, `id_sub`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 2),
(3, 1, 2, 3),
(4, 1, 2, 6),
(5, 1, 1, 4),
(6, 1, 1, 5),
(9, 2, 2, 2),
(12, 3, 2, 2),
(15, 2, 4, 7),
(16, 2, 4, 9),
(17, 3, 4, 7),
(18, 3, 4, 8),
(19, 3, 4, 10),
(21, 1, 4, 0),
(22, 1, 4, 7),
(23, 1, 4, 9),
(24, 2, 2, 3),
(26, 2, 4, 8),
(27, 2, 4, 10),
(28, 1, 2, 14),
(29, 1, 2, 15),
(31, 1, 9, 16),
(32, 2, 9, 16),
(34, 3, 9, 18),
(35, 3, 9, 17),
(37, 3, 9, 16),
(38, 2, 9, 19),
(39, 1, 9, 19),
(40, 2, 9, 17),
(41, 2, 2, 15),
(42, 2, 2, 14);

-- --------------------------------------------------------

--
-- Table structure for table `user_level`
--

CREATE TABLE `user_level` (
  `id_level` int(11) NOT NULL,
  `level` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_level`
--

INSERT INTO `user_level` (`id_level`, `level`) VALUES
(1, 'Admin'),
(2, 'HRD'),
(3, 'Pegawai');

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id_menu` int(11) NOT NULL,
  `menu` varchar(50) NOT NULL,
  `is_active` int(11) NOT NULL,
  `urutan_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id_menu`, `menu`, `is_active`, `urutan_menu`) VALUES
(1, 'Pengaturan', 1, 4),
(2, 'User', 1, 1),
(4, 'Absensi', 1, 2),
(9, 'Cuti', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id_sub` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `submenu` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `is_active` int(11) NOT NULL,
  `urutan_sub` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id_sub`, `id_menu`, `submenu`, `url`, `icon`, `is_active`, `urutan_sub`) VALUES
(1, 1, 'Hak Akses', 'pengaturan/hak_akses', 'fas fa-fw fa-cogs', 1, 3),
(2, 2, 'Dashboard', 'user', 'fas fa-fw fa-home', 1, 1),
(3, 2, 'Data User', 'user/data_user', 'fas fa-fw fa-users', 1, 2),
(4, 1, 'Menu', 'pengaturan/menu', 'fas fa-sliders-h', 1, 1),
(5, 1, 'Submenu', 'pengaturan/submenu', 'fas fa-fw fa-tasks', 1, 2),
(6, 2, 'Level', 'user/level', 'fas fa-fw fa-dot-circle', 1, 4),
(7, 4, 'Jam Kerja', 'absensi/jam_kerja', 'fas fa-fw fa-clock', 1, 1),
(8, 4, 'Absen Harian', 'absensi', 'fas fa-fw fa-hand-paper', 1, 2),
(9, 4, 'Data Absensi', 'absensi/data_absensi', 'fas fa-fw fa-clipboard-list', 1, 3),
(10, 4, 'Detail Absensi', 'absensi/detail_absensi', 'fas fa-fw fa-list', 1, 3),
(11, 2, 'Edit Profile', 'user/edit_profile', 'fas fa-fw fa-user', 1, 3),
(14, 2, 'Divisi', 'user/divisi', 'fas fa-fw fa-users', 1, 5),
(15, 2, 'Jabatan', 'user/jabatan', 'fas fa-fw fa-user', 1, 6),
(16, 9, 'Detail Cuti', 'cuti/detail_cuti', 'fas fa-fw fa-user', 1, 2),
(17, 9, 'Pengajuan Cuti', 'cuti/pengajuan', 'fas fa-fw fa-user', 1, 1),
(19, 9, 'Data Cuti', 'cuti', 'fas fa-fw fa-user', 1, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absen`
--
ALTER TABLE `absen`
  ADD PRIMARY KEY (`id_absen`);

--
-- Indexes for table `absen_detail`
--
ALTER TABLE `absen_detail`
  ADD PRIMARY KEY (`id_absen_detail`);

--
-- Indexes for table `cuti_user`
--
ALTER TABLE `cuti_user`
  ADD PRIMARY KEY (`id_cuti_user`);

--
-- Indexes for table `data_cuti`
--
ALTER TABLE `data_cuti`
  ADD PRIMARY KEY (`id_cuti`);

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id_divisi`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `jadwal_kerja`
--
ALTER TABLE `jadwal_kerja`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indexes for table `jam_kerja`
--
ALTER TABLE `jam_kerja`
  ADD PRIMARY KEY (`id_jam`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `user_akses_menu`
--
ALTER TABLE `user_akses_menu`
  ADD PRIMARY KEY (`id_akses`);

--
-- Indexes for table `user_level`
--
ALTER TABLE `user_level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id_sub`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absen`
--
ALTER TABLE `absen`
  MODIFY `id_absen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `absen_detail`
--
ALTER TABLE `absen_detail`
  MODIFY `id_absen_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `cuti_user`
--
ALTER TABLE `cuti_user`
  MODIFY `id_cuti_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `data_cuti`
--
ALTER TABLE `data_cuti`
  MODIFY `id_cuti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id_divisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jadwal_kerja`
--
ALTER TABLE `jadwal_kerja`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jam_kerja`
--
ALTER TABLE `jam_kerja`
  MODIFY `id_jam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user_akses_menu`
--
ALTER TABLE `user_akses_menu`
  MODIFY `id_akses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `user_level`
--
ALTER TABLE `user_level`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id_sub` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
