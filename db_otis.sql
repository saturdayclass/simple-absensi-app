-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 31, 2021 at 03:52 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_otis`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_cabang`
--

CREATE TABLE `tb_cabang` (
  `id_cabang` int(11) NOT NULL,
  `nama_cabang` varchar(255) NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_cabang`
--

INSERT INTO `tb_cabang` (`id_cabang`, `nama_cabang`, `created`, `modified`) VALUES
(1, 'Cabang Balikpapan', '0000-00-00', '2021-01-16'),
(2, 'Cabang Balikpapan - ULaMM Balikpapan', '0000-00-00', '0000-00-00'),
(3, 'Cabang Balikpapan - ULaMM Soekarno Hatta - Balikpapan', '0000-00-00', '0000-00-00'),
(4, 'Cabang Balikpapan - ULaMM Petung', '0000-00-00', '0000-00-00'),
(5, 'Cabang Balikpapan - ULaMM Babulu', '0000-00-00', '0000-00-00'),
(6, 'Cabang Balikpapan - ULaMM Tanah Grogot', '0000-00-00', '0000-00-00'),
(7, 'Cabang Balikpapan - ULaMM Simpang Pait', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_lembur`
--

CREATE TABLE `tb_lembur` (
  `id_lembur` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `kode_outlet` varchar(255) NOT NULL,
  `posisi` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `jam_mulai` varchar(255) NOT NULL,
  `jam_selesai` varchar(255) NOT NULL,
  `aktivitas` text NOT NULL,
  `approval_unit` varchar(255) NOT NULL,
  `approval_cabang` varchar(255) NOT NULL,
  `approval_final` varchar(255) NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_lembur`
--

INSERT INTO `tb_lembur` (`id_lembur`, `nama`, `nip`, `kode_outlet`, `posisi`, `tanggal`, `jam_mulai`, `jam_selesai`, `aktivitas`, `approval_unit`, `approval_cabang`, `approval_final`, `created`, `modified`) VALUES
(18, 'Ria Ramadhanii', '16482.04.18', 'BLPP', 'Staf - KAM', '2021-01-25', '16:28', '19:28', 'Hmm', '1613638290.jpg', '1302613950.png', 'Tidak di setujui', '2021-01-24', '2021-01-24'),
(19, 'Ria Ramadhanii', '8413.07.20.M', 'BLPP', 'Staf - KAM', '2021-01-30', '10:28', '10:28', 'asasas', 'Belum di approve', 'Belum di approve', 'Belum di approve', '2021-01-30', '2021-01-30'),
(20, 'Ria Ramadhanii', '8413.07.20.M', 'BLPP', 'Staf - KAM', '2021-01-22', '13:40', '13:44', 'hmm', 'Belum di approve', 'Belum di approve', 'Belum di approve', '2021-01-30', '2021-01-30'),
(21, 'Ria Ramadhanii', '8413.07.20.M', 'BLPP', 'Staf - KAM', '2021-02-03', '10:43', '13:41', 'hjhj', 'Belum di approve', 'Belum di approve', 'Belum di approve', '2021-01-30', '2021-01-30'),
(22, 'Ria Ramadhanii', '8413.07.20.M', 'BLPP', 'Staf - KAM', '2021-01-30', '12:17', '12:17', 'Lm\r\n', 'Belum di approve', 'Belum di approve', 'Belum di approve', '2021-01-30', '2021-01-30'),
(23, 'Ria Ramadhanii', '8413.07.20.M', 'BLPP', 'Staf - KAM', '2021-01-30', '12:17', '12:17', 'Lm\r\n', 'Belum di approve', 'Belum di approve', 'Belum di approve', '2021-01-30', '2021-01-30'),
(24, 'Ria Ramadhanii', '8413.07.20.M', 'BLPP', 'Staf - KAM', '2021-01-20', '11:25', '17:19', 'aaaaa', 'Tidak di setujui', 'Belum di approve', 'Belum di approve', '2021-01-30', '2021-01-30'),
(25, 'Ria Ramadhanii', '8413.07.20.M', 'BLPP', 'Staf - KAM', '2021-01-30', '11:25', '11:22', 'nnnn\r\n', 'Belum di approve', 'Belum di approve', 'Belum di approve', '2021-01-30', '2021-01-30'),
(26, 'Ria Ramadhanii', '8413.07.20.M', 'BLPP', 'Staf - KAM', '2021-01-30', '11:25', '11:22', 'nnnn\r\n', 'Belum di approve', 'Belum di approve', 'Belum di approve', '2021-01-30', '2021-01-30'),
(27, 'Ria Ramadhanii', '8413.07.20.M', 'BLPP', 'Staf - KAM', '2021-01-27', '15:23', '11:26', 'Z', 'Belum di approve', 'Belum di approve', 'Belum di approve', '2021-01-30', '2021-01-30'),
(28, 'Ria Ramadhanii', '8413.07.20.M', 'BLPP', 'Staf - KAM', '2021-01-31', '11:24', '11:25', 'asasas', 'Belum di approve', 'Belum di approve', 'Belum di approve', '2021-01-30', '2021-01-30'),
(29, 'Dewanti Dwijaya Dinata', '7736.06.19.M', 'SKHT', 'Staf - KAM', '2021-01-30', '11:48', '15:47', 'X', 'Belum di approve', 'Belum di approve', 'Belum di approve', '2021-01-30', '2021-01-30'),
(30, 'Jahrul', '6877.10.18.M', 'BLP', 'Non staf - Security', '2021-01-31', '14:07', '16:08', 'Hm', 'Tidak perlu approval unit', '160009120.jpg', '847659507.png', '2021-01-31', '2021-01-31'),
(31, 'Jahrul', '6877.10.18.M', 'BLP', 'Non staf - Security', '2021-01-31', '02:50', '02:50', 'aaasssvvv', 'Tidak perlu approval unit', '627279081.png', 'Belum di approve', '2021-01-31', '2021-01-31');

-- --------------------------------------------------------

--
-- Table structure for table `tb_outlet`
--

CREATE TABLE `tb_outlet` (
  `id_outlet` int(11) NOT NULL,
  `kode_outlet` varchar(255) NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_outlet`
--

INSERT INTO `tb_outlet` (`id_outlet`, `kode_outlet`, `created`, `modified`) VALUES
(2, 'BLP', '2021-01-30', '2021-01-30'),
(3, 'BLPP', '2021-01-30', '2021-01-30'),
(4, 'SKHT', '2021-01-30', '2021-01-30');

-- --------------------------------------------------------

--
-- Table structure for table `tb_posisi`
--

CREATE TABLE `tb_posisi` (
  `id_posisi` int(11) NOT NULL,
  `nama_posisi` varchar(255) NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_posisi`
--

INSERT INTO `tb_posisi` (`id_posisi`, `nama_posisi`, `created`, `modified`) VALUES
(1, 'Staf - KAM', '0000-00-00', '2021-01-16'),
(2, 'Staf - Remidial', '0000-00-00', '0000-00-00'),
(3, 'Staf - Keuangan', '0000-00-00', '0000-00-00'),
(4, 'Staf - Colletion', '0000-00-00', '0000-00-00'),
(5, 'Staf - Desk SDM', '0000-00-00', '0000-00-00'),
(6, 'Staf - IT', '0000-00-00', '0000-00-00'),
(7, 'Non staf - Officeboy', '0000-00-00', '0000-00-00'),
(9, 'Non staf - Security', '0000-00-00', '0000-00-00'),
(10, 'Non staf - Receptionist', '0000-00-00', '0000-00-00'),
(11, 'Manajer Remidial', '0000-00-00', '0000-00-00'),
(12, 'Manajer Keuangan dan operasional', '0000-00-00', '0000-00-00'),
(13, 'Manajer Bisnis', '0000-00-00', '2021-01-16'),
(14, 'Pimpinan', '0000-00-00', '0000-00-00'),
(16, 'Kepala Kantor ULaMM', '2021-01-24', '2021-01-24'),
(18, 'Staf Desk SDM Balikpapan Wilayah 18 - Banjarmasin', '2021-01-24', '2021-01-24'),
(19, 'Manajer Bisnis ULaMM', '2021-01-31', '2021-01-31');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `posisi` varchar(255) NOT NULL,
  `unit_kerja` varchar(255) NOT NULL,
  `kode_outlet` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama`, `nip`, `posisi`, `unit_kerja`, `kode_outlet`, `username`, `password`, `role`, `created`, `modified`) VALUES
(2, 'Ria Ramadhanii', '8413.07.20.M', 'Staf - KAM', 'Cabang Balikpapan - ULaMM Balikpapan', 'BLPP', 'RRAMADHANI0123', 'pnm789', 'Staf/Non Staf', '2021-01-16', '2021-01-16'),
(3, 'admin', '12121212', 'Pimpinan', 'Cabang Balikpapan', 'qwqw', 'admin', 'admin', 'Super Admin', '2021-01-16', '2021-01-16'),
(4, 'Abdul Haris', '705.08.09', 'Manajer Keuangan dan operasional', 'Cabang Balikpapan', 'BLP', 'AHR', 'pnm789', 'Pimpinan Cabang', '2021-01-24', '2021-01-24'),
(5, 'Mohamad Risfi Rinaldi', '16482.04.18', 'Kepala Kantor ULaMM', 'Cabang Balikpapan - ULaMM Balikpapan', 'BLPP', 'MRRINALDI0129', 'pnm789', 'Pimpinan Unit', '2021-01-24', '2021-01-24'),
(6, 'Yazdi Anugrah', '1214.01.09', 'Pimpinan', 'Cabang Balikpapan', 'BLP', 'YZD', 'pnm789', 'Pimpinan Final', '2021-01-24', '2021-01-24'),
(7, 'Achmad Baridi', '22416.02.20', 'Staf Desk SDM Balikpapan Wilayah 18 - Banjarmasin', 'Cabang Balikpapan', 'BLP', 'ABARIDI0216', 'pnm789', 'admin', '2021-01-24', '2021-01-24'),
(10, 'Dewanti Dwijaya Dinata', '7736.06.19.M', 'Staf - KAM', 'Cabang Balikpapan - ULaMM Soekarno Hatta - Balikpapan', 'SKHT', 'DDDINATA0512', 'pnm789', 'Staf/Non Staf', '2021-01-30', '2021-01-30'),
(11, 'Alvin Budi Jayadi', '3499.07.11', 'Kepala Kantor ULaMM', 'Cabang Balikpapan - ULaMM Soekarno Hatta - Balikpapan', 'SKHT', 'ABJAYADI0920', 'pnm789', 'Pimpinan Unit', '2021-01-30', '2021-01-30'),
(12, 'M Syaiful Anwar', '650.03.09', 'Manajer Bisnis ULaMM', 'Cabang Balikpapan', 'BLP', 'MSR', 'pnm789', 'Pimpinan Cabang', '2021-01-31', '2021-01-31'),
(13, 'Jahrul', '6877.10.18.M', 'Non staf - Security', 'Cabang Balikpapan', 'BLP', 'JAHRUL', 'pnm789', 'Staf/Non Staf', '2021-01-31', '2021-01-31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_cabang`
--
ALTER TABLE `tb_cabang`
  ADD PRIMARY KEY (`id_cabang`);

--
-- Indexes for table `tb_lembur`
--
ALTER TABLE `tb_lembur`
  ADD PRIMARY KEY (`id_lembur`);

--
-- Indexes for table `tb_outlet`
--
ALTER TABLE `tb_outlet`
  ADD PRIMARY KEY (`id_outlet`);

--
-- Indexes for table `tb_posisi`
--
ALTER TABLE `tb_posisi`
  ADD PRIMARY KEY (`id_posisi`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_cabang`
--
ALTER TABLE `tb_cabang`
  MODIFY `id_cabang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_lembur`
--
ALTER TABLE `tb_lembur`
  MODIFY `id_lembur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tb_outlet`
--
ALTER TABLE `tb_outlet`
  MODIFY `id_outlet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_posisi`
--
ALTER TABLE `tb_posisi`
  MODIFY `id_posisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
