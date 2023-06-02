-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Bulan Mei 2023 pada 07.10
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_reservasi_resto`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `id` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga_produk` varchar(100) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `kuantitas` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `keranjang`
--

INSERT INTO `keranjang` (`id`, `nama_produk`, `harga_produk`, `gambar`, `kuantitas`) VALUES
(2, 'chicken', '2', 'fried-chicken.jpg', 3),
(4, 'Es Jeruk', '10', 'mojito-g974c8479b_1920.jpg', 2),
(5, 'Lumpia', '3', 'lumpia.jpg', 1),
(6, 'Ikan Pedas', '3', 'ikanpedes.jpg', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_tlp` varchar(20) NOT NULL,
  `jml_orang` int(11) NOT NULL,
  `metode_bayar` varchar(100) NOT NULL,
  `total_produk` varchar(300) NOT NULL,
  `total_harga` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`id`, `nama`, `no_tlp`, `jml_orang`, `metode_bayar`, `total_produk`, `total_harga`, `tanggal`, `jam`, `status`) VALUES
(26, 'Ali', '085656200307', 2, 'BCA', 'chicken (3) , aaaa (2) , Es Jeruk (2) ', '30', '2023-05-24', '20:20:00', 0),
(29, 'Dibo', '0987658904', 4, 'BRI', 'chicken (3) , Es Jeruk (2) , Lumpia (1) ', '29', '2023-05-05', '08:24:00', 0),
(30, 'Ilham', '089765743821', 2, 'Dana', 'chicken (3) , Es Jeruk (2) , Lumpia (1) ', '29', '2023-05-17', '10:00:00', 0),
(31, 'Ali', '9539493455', 2, 'Mandiri', 'chicken (3) , Es Jeruk (2) , Lumpia (1) , Ikan Pedas (1) ', '32', '2023-05-30', '03:09:00', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga_produk` varchar(100) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id`, `nama_produk`, `harga_produk`, `gambar`) VALUES
(5, 'Chicken Smackdown', '2', 'fried-chicken.jpg'),
(6, 'Kopi', '2', 'coffee-g96c925390_1920.jpg'),
(7, 'Lumpia', '3', 'lumpia.jpg'),
(11, 'Es Jeruk', '10', 'mojito-g974c8479b_1920.jpg'),
(12, 'Ikan Pedas', '3', 'ikanpedes.jpg'),
(13, 'Rice Dish', '10', 'rice-dish.jpg'),
(14, 'Fried Rice', '10', 'fried-rice.jpg'),
(15, 'Sate Kambing', '15', 'satekambing.jpg'),
(16, 'Es Kopi', '10', 'es-kopi.jpg'),
(17, 'Jus Apel', '10', 'jus-apel.jpg'),
(18, 'Jus Alpukat', '14', 'jus-alpukat.jpg'),
(19, 'Thai Tea', '12', 'tea-tailand.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `type_user` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `email`, `password`, `type_user`) VALUES
(3, 'M Ali', 'ali', 'ali@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'user'),
(8, 'Dibo', 'dibo', 'dibo@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'user'),
(10, 'haerul', 'haerul021', 'haerul02@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
