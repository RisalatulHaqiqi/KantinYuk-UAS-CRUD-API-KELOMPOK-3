-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2025 at 12:11 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pesat`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `nama` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`nama`, `password`) VALUES
('Reyhan', '123456'),
('Rerey', '123456'),
('Risalatul', '12345678'),
('Delilla', '12345678'),
('Febrina', '12345678'),
('Nensa', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `Id` int(11) NOT NULL,
  `makanan` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menuseller`
--

CREATE TABLE `menuseller` (
  `nama` varchar(50) NOT NULL,
  `domisili` varchar(50) NOT NULL,
  `menu` varchar(50) NOT NULL,
  `foto` text NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `menuseller`
--

INSERT INTO `menuseller` (`nama`, `domisili`, `menu`, `foto`, `price`) VALUES
('Warung Nino', 'Cengkeh', 'Sate', 'sate kambing.jpeg', 20000);

-- --------------------------------------------------------

--
-- Table structure for table `mitra`
--

CREATE TABLE `mitra` (
  `nama` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `mitra`
--

INSERT INTO `mitra` (`nama`, `password`) VALUES
('Abdi', '123'),
('Dino', '155'),
('Badu', '12333');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--
CREATE TABLE `pengguna` (
  `nama` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telepon` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`nama`, `password`, `email`, `telepon`) VALUES
('user', '123', '', '0'),
('user1', '12345', '', '0'),
('Delilla Anandita', '$2y$10$PAuK7R/Qu4qk0/H3Uomr5OMLWaAwo1V/IYJpBMz8ZJO', 'delillaanandita@gmail.com', '2147483647'),
('Altron Engineering', '$2y$10$1vA5JwD9.gGvDZgTkWiy2.1zQU5.yK2R2fvGcEnLEXH', 'engineeringaltron@gmail.com', '2147483647'),
('hyhyhy', '$2y$10$nu1/DaZmhigwK1DZNvouK.dPB/1T/gWn4MaJSeihwoC', 'bimols.bl@gmail.com', '082146450899'),
('fufu fafa', '$2y$10$ynL8G5hhPKDvBCOvaSLXOOHczl8eNlQjqjF65L0iBxv', 'jaenudinrahman6@gmail.com', '098122323932'),
('fufufufu', 'pppppppp', 'hirosiunpkediri@gmail.com', '0193231313131');

-- --------------------------------------------------------

--
-- Table structure for table `stokbhn`
--

CREATE TABLE `stokbhn` (
  `nama` varchar(50) NOT NULL,
  `harga` varchar(50) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `stokbhn`
--

INSERT INTO `stokbhn` (`nama`, `harga`, `foto`) VALUES
('Teh(Es/Anget)', '3000', 'tehh.jpg'),
('Teh Jahe', '4000', 'tehjahe.jpg'),
('Es Jeruk', '4000', 'esjeruk.jpg'),
('Josua', '6000', 'josua.jpg'),
('Nutrisari', '3000', 'nutrisari.jpg'),
('Pop Ice', '3000', 'popice.jpg'),
('Milo', '5000', 'milo.jpg'),
('Susu', '5000', 'susu.jpg'),
('Chocolatos', '5000', 'cocolatos.jpg'),
('Cokelat', '5000', 'cokelat.jpg'),
('Coca-Cola', '8000', 'cocacola.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `stokmakn`
--

CREATE TABLE `stokmakn` (
  `nama` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `stokmakn`
--

INSERT INTO `stokmakn` (`nama`, `harga`, `foto`) VALUES
('Pecel', 7000, 'pecel.jpg'),
('Tumpang', 7000, 'tumpang.jpg'),
('Pecel Tumpang', 8000, 'peceltumpang.jpg'),
('Rujak', 8000, 'rujak.jpg'),
('Gado-Gado', 7000, 'gado.jpg'),
('Soto Ayam', 7000, 'sotoayam.jpg'),
('Soto Daging', 10000, 'sotodaging.jpg'),
('Mie Goreng', 5000, 'miegoreng.jpg'),
('Mie Kuah', 5000, 'miekuah.jpg'),
('Mie Nyemek', 6000, 'mienyemek.jpg'),
('Bubur Ayam', 7000, 'buburayam.jpg'),
('Nasi Ayam Geprek', 7000, 'ayamgeprek.jpg'),
('Nasi Ayam Bakar', 8000, 'ayambakar.jpg'),
('Nasi Bakar', 6000, 'nasibakar.jpg'),
('Nasi Kuning', 7000, 'nasikuning.jpg'),
('Nasi Uduk', 7000, 'nasiuduk.jpg'),
('Telur Ceplok', 3000, 'telur.jpg'),
('Nasi', 3000, 'nasi.jpg'),
('Gorengan', 1000, 'gorengan.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
