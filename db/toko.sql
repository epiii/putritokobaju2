-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 09, 2018 at 11:42 PM
-- Server version: 5.7.19
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko`
--

-- --------------------------------------------------------

--
-- Table structure for table `akses`
--

CREATE TABLE `akses` (
  `idAkses` int(2) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `salt` text NOT NULL,
  `nama` varchar(50) NOT NULL,
  `akses` varchar(10) NOT NULL,
  `toko` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `akses`
--

INSERT INTO `akses` (`idAkses`, `username`, `password`, `salt`, `nama`, `akses`, `toko`) VALUES
(5, 'Yuanita', '92275bdab41402677de804f757122e7b4b64f593d49e707e75cbb2e21238c054', '5b6cfabb3232d0.29642000', 'Yuanita Pratiwi', 'owner', NULL),
(6, 'Yuniati', '4fa496fec0f2c7918bd9548e3637adca869a738336839589d3979249f2fe74e7', '5b6cfaedb95df3.18907853', 'Yuniati dwi', 'supervisor', NULL),
(9, 'Zea', '02f618f504d9506270e9e9a6fc614f65a9baaa3ffd8f7dbf12e8daf84812dc87', '5b70af3fc00a10.42896684', 'Zea minka', 'penjaga', 'A'),
(10, 'Iwi', '5ea5a55868d019b7dff4e7752cff83b345b7639204d57bafb77525819ae850bd', '5b7113a3c0a324.23572954', 'Iwi Pratiwi', 'penjaga', 'D');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `idBarang` int(6) NOT NULL,
  `kode` varchar(6) NOT NULL,
  `ukuran` varchar(8) DEFAULT NULL,
  `jumlah` int(6) NOT NULL,
  `harga` int(8) NOT NULL,
  `jenisBarang` varchar(40) NOT NULL,
  `toko` varchar(10) NOT NULL,
  `merk` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`idBarang`, `kode`, `ukuran`, `jumlah`, `harga`, `jenisBarang`, `toko`, `merk`) VALUES
(35, '3EL1SM', 'L', 13, 40000, 'kaos', 'A', 'Polo'),
(36, '3EL1SM', 'L', 27, 70000, 'kaos', 'D', 'Polo'),
(37, '3EL1SM', 'XL', 11, 50000, 'kaos', 'A', 'Polo'),
(38, 'JOCL21', 'M', 12, 50000, 'kaos', 'B', 'tshirt'),
(39, 'W0E1RG', 'M', 50, 70000, 'batik', 'D', 'bateeq'),
(40, 'W0E1RG', 'XL', 17, 90000, 'batik', 'D', 'bateeq'),
(41, 'JOCL21', 'M', 8, 50000, 'kaos', 'A', 'tshirt'),
(42, 'W0E1RG', 'XL', 4, 90000, 'batik', 'A', 'bateeq'),
(43, 'W0E1RG', 'M', 10, 70000, 'batik', 'A', 'bateeq');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `idPenjualan` int(7) NOT NULL,
  `kode` varchar(6) NOT NULL,
  `tglTransaksi` datetime NOT NULL,
  `ukuran` varchar(10) NOT NULL,
  `jumlah` int(6) NOT NULL,
  `total` int(8) NOT NULL,
  `toko` varchar(10) NOT NULL,
  `harga` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`idPenjualan`, `kode`, `tglTransaksi`, `ukuran`, `jumlah`, `total`, `toko`, `harga`) VALUES
(10, '3EL1SM', '2018-08-12 22:53:51', 'L', 10, 400000, 'A', 40000),
(11, '3EL1SM', '2018-08-12 22:55:51', 'XL', 2, 100000, 'A', 50000),
(12, '3EL1SM', '2018-08-09 22:56:59', 'XL', 2, 100000, 'A', 50000),
(13, 'W0E1RG', '2018-08-09 23:09:15', 'XL', 3, 270000, 'D', 90000);

-- --------------------------------------------------------

--
-- Table structure for table `pinjam`
--

CREATE TABLE `pinjam` (
  `idPinjam` int(6) NOT NULL,
  `kode` varchar(6) NOT NULL,
  `ukuran` varchar(8) DEFAULT NULL,
  `jumlah` int(6) NOT NULL,
  `toko1` varchar(10) NOT NULL,
  `jenisBarang` varchar(40) NOT NULL,
  `merk` varchar(30) NOT NULL,
  `tglPinjam` datetime NOT NULL,
  `toko2` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pinjam`
--

INSERT INTO `pinjam` (`idPinjam`, `kode`, `ukuran`, `jumlah`, `toko1`, `jenisBarang`, `merk`, `tglPinjam`, `toko2`) VALUES
(5, 'JOCL21', 'M', 8, 'B', 'kaos', 'tshirt', '2018-08-09 22:59:37', 'A'),
(6, 'W0E1RG', 'XL', 4, 'D', 'batik', 'bateeq', '2018-08-09 23:00:51', 'A'),
(7, '3EL1SM', 'L', 2, 'A', 'kaos', 'Polo', '2018-08-09 23:11:02', 'D'),
(8, 'W0E1RG', 'M', 10, 'D', 'batik', 'bateeq', '2018-08-09 23:17:45', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat`
--

CREATE TABLE `riwayat` (
  `idRiwayat` int(7) NOT NULL,
  `tglMasuk` datetime NOT NULL,
  `kode` varchar(6) NOT NULL,
  `jumlah` int(6) NOT NULL,
  `ukuran` varchar(8) DEFAULT NULL,
  `harga` int(8) NOT NULL,
  `toko` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `riwayat`
--

INSERT INTO `riwayat` (`idRiwayat`, `tglMasuk`, `kode`, `jumlah`, `ukuran`, `harga`, `toko`) VALUES
(35, '2018-08-12 22:42:49', '3EL1SM', 25, 'L', 40000, 'A'),
(36, '2018-08-12 22:43:48', '3EL1SM', 20, 'L', 37000, 'D'),
(37, '2018-08-12 22:44:52', '3EL1SM', 15, 'XL', 50000, 'A'),
(38, '2018-08-12 22:46:29', 'JOCL21', 20, 'M', 50000, 'B'),
(39, '2018-08-12 22:48:04', '3EL1SM', 5, 'L', 70000, 'D'),
(40, '2018-08-12 22:49:21', 'W0E1RG', 60, 'M', 70000, 'D'),
(41, '2018-08-12 22:50:26', 'W0E1RG', 24, 'XL', 90000, 'D');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akses`
--
ALTER TABLE `akses`
  ADD PRIMARY KEY (`idAkses`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`idBarang`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`idPenjualan`);

--
-- Indexes for table `pinjam`
--
ALTER TABLE `pinjam`
  ADD PRIMARY KEY (`idPinjam`);

--
-- Indexes for table `riwayat`
--
ALTER TABLE `riwayat`
  ADD PRIMARY KEY (`idRiwayat`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akses`
--
ALTER TABLE `akses`
  MODIFY `idAkses` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `idBarang` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `idPenjualan` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pinjam`
--
ALTER TABLE `pinjam`
  MODIFY `idPinjam` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `riwayat`
--
ALTER TABLE `riwayat`
  MODIFY `idRiwayat` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
