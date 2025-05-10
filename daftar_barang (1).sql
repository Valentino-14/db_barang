-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2025 at 10:39 AM
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
-- Database: `dt_barang`
--

-- --------------------------------------------------------

--
-- Table structure for table `daftar_barang`
--

CREATE TABLE `daftar_barang` (
  `id` int(10) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `jumlah_barang` int(10) NOT NULL,
  `satuan_barang` varchar(20) NOT NULL,
  `harga_beli` double(10,2) NOT NULL,
  `status_barang` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daftar_barang`
--

INSERT INTO `daftar_barang` (`id`, `kode_barang`, `nama_barang`, `jumlah_barang`, `satuan_barang`, `harga_beli`, `status_barang`) VALUES
(1, 'ac-011', 'pulpen', 20, '1', 5.00, 1),
(2, 'ac-0112', 'pensil', 40, '2', 3.00, 1),
(3, 'ab-101', 'buku', 15, '1', 7.00, 0),
(4, 'ab-102', 'kertas', 100, '10', 2.00, 0),
(5, 'ac-0113', 'penghapus', 30, '1', 3.00, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daftar_barang`
--
ALTER TABLE `daftar_barang`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daftar_barang`
--
ALTER TABLE `daftar_barang`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
