-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2024 at 09:29 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbsiswa`
--

-- --------------------------------------------------------

--
-- Table structure for table `dokumen_mapel`
--

CREATE TABLE `dokumen_mapel` (
  `dokumen_mapel_id` int(100) NOT NULL,
  `kode_mapel_id` int(100) NOT NULL,
  `path_file` varchar(100) NOT NULL,
  `nama_file` varchar(100) NOT NULL,
  `keterangan_file` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dokumen_mapel`
--

INSERT INTO `dokumen_mapel` (`dokumen_mapel_id`, `kode_mapel_id`, `path_file`, `nama_file`, `keterangan_file`) VALUES
(1, 1, 'q', 'q', 'q'),
(2, 2, 'a', 'a', 'a'),
(3, 3, 'a', 'b', 'b'),
(4, 4, 'n', 'N', 'N');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dokumen_mapel`
--
ALTER TABLE `dokumen_mapel`
  ADD PRIMARY KEY (`dokumen_mapel_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dokumen_mapel`
--
ALTER TABLE `dokumen_mapel`
  MODIFY `dokumen_mapel_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
