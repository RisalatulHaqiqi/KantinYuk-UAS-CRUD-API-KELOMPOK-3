-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25. Januari 2024 jam 09:08
-- Versi Server: 5.5.8
-- Versi PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pesat`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `administrator`
--

CREATE TABLE IF NOT EXISTS `administrator` (
  `nama` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `administrator`
--

INSERT INTO `administrator` (`nama`, `password`) VALUES
('Reyhan', '123456'),
('Rerey', '123456');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE IF NOT EXISTS `keranjang` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `makanan` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data untuk tabel `keranjang`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `menuseller`
--

CREATE TABLE IF NOT EXISTS `menuseller` (
  `nama` varchar(50) NOT NULL,
  `domisili` varchar(50) NOT NULL,
  `menu` varchar(50) NOT NULL,
  `foto` text NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `menuseller`
--

INSERT INTO `menuseller` (`nama`, `domisili`, `menu`, `foto`, `price`) VALUES
('Warung Mbak Rino', 'Lolong', 'Pical', 'lontong pical.jpg', 20000),
('Warung Mbak Atik', 'Lubeg', 'Ayam Geprek', 'ayam geprek.jpeg', 10000),
('Warung Nino', 'Cengkeh', 'Sate', 'sate kambing.jpeg', 20000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mitra`
--

CREATE TABLE IF NOT EXISTS `mitra` (
  `nama` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mitra`
--

INSERT INTO `mitra` (`nama`, `password`) VALUES
('Abdi', '123'),
('Dino', '155'),
('Badu', '12333');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE IF NOT EXISTS `pengguna` (
  `nama` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`nama`, `password`) VALUES
('user', '123'),
('user1', '12345');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stokbhn`
--

CREATE TABLE IF NOT EXISTS `stokbhn` (
  `nama` varchar(50) NOT NULL,
  `harga` varchar(50) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `stokbhn`
--

INSERT INTO `stokbhn` (`nama`, `harga`, `foto`) VALUES
('Jamur Kuping', '20000', 'mushroom.png'),
('Brokoli', '10000', 'broccoli.png'),
('Bawang Bombay', '10000', 'Bawang bombay.png'),
('Keju', '10000', 'cheese-wedge.png'),
('Selada', '10000', 'cabbage.png'),
('Wortel', '10000', 'carrot.png'),
('Ayam buras', '50000', 'chicken.png'),
('Bayam', '10000', 'spinach_2079306.png'),
('Sarden Kaleng', '20000', 'tinned-food_5835225.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stokmakn`
--

CREATE TABLE IF NOT EXISTS `stokmakn` (
  `nama` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `stokmakn`
--

INSERT INTO `stokmakn` (`nama`, `harga`, `foto`) VALUES
('Bubur Ayam', 10000, 'bubur ayam.jpg'),
('Lontong Pical', 8000, 'lontong pical.jpg'),
('Nasi Goreng Spesial', 15000, 'Nasi Goreng spesial.jpg'),
('Pecel Ayam', 12000, 'pecel ayam.jpg'),
('Mie Goreng', 15000, 'mie goreng.jpeg'),
('Martabak Kubang', 20000, 'martabak.jpg'),
('Ayam Geprek', 50000, 'ayam geprek.jpeg'),
('Burger', 10000, 'burger.jpeg'),
('Potato Wedges', 50000, 'potato wedges.jpg'),
('Siomay', 50000, 'siomay.jpg'),
('Mie Ayam', 13000, 'mie ayam.jpeg');
