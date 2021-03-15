-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Mar 2021 pada 10.22
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_masis`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_assets`
--

CREATE TABLE `tb_assets` (
  `id_assets` int(11) NOT NULL,
  `kode_assets` varchar(15) NOT NULL,
  `merk` varchar(50) NOT NULL,
  `serial_number` varchar(128) NOT NULL,
  `id_pt` int(4) NOT NULL,
  `lokasi` varchar(128) NOT NULL,
  `cpu` varchar(128) NOT NULL,
  `ram` varchar(128) NOT NULL,
  `storage` varchar(128) NOT NULL,
  `gpu` varchar(128) NOT NULL,
  `display` varchar(128) NOT NULL,
  `lain` varchar(128) NOT NULL,
  `qty_id` int(11) NOT NULL,
  `tgl_pembelian` date NOT NULL,
  `kondisi` varchar(10) NOT NULL,
  `user` varchar(128) NOT NULL,
  `status_kondisi` varchar(10) DEFAULT NULL,
  `idle` varchar(5) DEFAULT NULL,
  `fisik` varchar(10) DEFAULT NULL,
  `ket_fisik` text NOT NULL,
  `status_unit` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_assets`
--

INSERT INTO `tb_assets` (`id_assets`, `kode_assets`, `merk`, `serial_number`, `id_pt`, `lokasi`, `cpu`, `ram`, `storage`, `gpu`, `display`, `lain`, `qty_id`, `tgl_pembelian`, `kondisi`, `user`, `status_kondisi`, `idle`, `fisik`, `ket_fisik`, `status_unit`) VALUES
(2, 'MSAL20210215643', 'Asus', '29740g9027hd3789', 10, 'HO', 'Intel', '6 GB', '500GB', 'radeon AMD', '32 inc', '', 17, '2021-02-04', '1', 'Budi', 'Bekas', 'on', 'Setengah', 'peang dikit                                ', 1),
(3, 'MSAL20210216451', 'Lenovo', '29740g9027hd', 7, 'HO', 'Intel', 'TEST', '1TB', 'TEST', '32 inc', 'tidak deh', 17, '2021-02-15', '1', 'Budi', 'Bekas', 'on', 'Setengah', 'qwq                                ', 1),
(4, 'MSAL20210216182', '', '', 10, '', '', '', '', '', '', '', 18, '0000-00-00', '1', '', NULL, NULL, NULL, '                                ', 1),
(6, 'MSAL20210216550', '', '', 2, '', '', '', '', '', '', '', 17, '0000-00-00', '1', '', '', 'on', '', '                                ', 1),
(7, 'MSAL20210217083', '', '', 7, '', '', '', '', '', '', '', 22, '0000-00-00', '1', '', '', NULL, '', '                                ', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_lend_assets`
--

CREATE TABLE `tb_lend_assets` (
  `id_lend` int(11) NOT NULL,
  `assets_id` int(11) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `qty_id` int(11) NOT NULL,
  `date_lend` datetime NOT NULL,
  `due_date` date NOT NULL,
  `date_return` datetime NOT NULL,
  `notes` text NOT NULL,
  `notes_user` text NOT NULL,
  `apprvd_y_dept` int(1) NOT NULL,
  `apprvd_mis_dept` int(1) NOT NULL,
  `lend_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_lend_assets`
--

INSERT INTO `tb_lend_assets` (`id_lend`, `assets_id`, `nama`, `qty_id`, `date_lend`, `due_date`, `date_return`, `notes`, `notes_user`, `apprvd_y_dept`, `apprvd_mis_dept`, `lend_status`) VALUES
(1, 0, 'ABDUL ROHMAN', 17, '2021-02-09 00:00:00', '2021-02-17', '0000-00-00 00:00:00', '0', 'untuk wfh', 0, 0, 3),
(2, 2, 'ADI TEGUH PRABOWO', 17, '2021-02-02 00:00:00', '2021-02-17', '2021-02-15 04:26:06', 'okela', 'wafh duluyee', 1, 1, 0),
(3, 2, 'ADI WINOTO', 17, '2021-02-09 00:00:00', '2021-02-15', '2021-02-15 04:21:37', 'no', 'TEST OKEE BANGG', 1, 1, 0),
(4, 0, 'AGIL PRASETYA', 17, '2021-02-02 00:00:00', '2021-02-17', '0000-00-00 00:00:00', '0', 'sorekali', 0, 0, 3),
(5, 2, 'ABDUL ROHMAN', 17, '2021-02-10 00:00:00', '2021-02-08', '2021-02-17 05:33:04', 'okelah', 'wafh duluyee', 1, 1, 0),
(6, 0, 'AGIL PRASETYA', 17, '2021-02-10 00:00:00', '2021-02-11', '0000-00-00 00:00:00', '0', 'sabtu', 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pt`
--

CREATE TABLE `tb_pt` (
  `id_pt` int(11) NOT NULL,
  `pt_name` varchar(50) NOT NULL,
  `alias` varchar(20) NOT NULL,
  `singkatan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pt`
--

INSERT INTO `tb_pt` (`id_pt`, `pt_name`, `alias`, `singkatan`) VALUES
(1, 'PT MULIA SAWIT AGRO LESTARI (HO)', 'PT MSAL (HO)', 'MSAL'),
(2, 'PT MULIA SAWIT AGRO LESTARI (PKS)', 'PT MSAL (PKS)', 'MSAL'),
(3, 'PT MULIA SAWIT AGRO LESTARI (KEBUN)', 'PT MSAL (KEBUN)', 'MSAL'),
(4, 'PT PERSADA SEJAHTERA AGRO MAKMUR (PKS)', 'PT PSAM (PKS)', 'PSAM'),
(5, 'PT PERSADA SEJAHTERA AGRO MAKMUR (KEBUN)', 'PT PSAM (KEBUN)', 'PEAK'),
(7, 'PT MITRA AGRO PERSADA ABADI', 'PT MAPA', 'MAPA'),
(8, 'PT PERSADA ERA AGRO KENCANA (PKS)', 'PT PEAK (PKS)', 'PEAK'),
(9, 'PT PERSADA ERA AGRO KENCANA (KEBUN)', 'PT PEAK (KEBUN)', 'PEAK'),
(10, 'RO PALANGKARAYA', 'RO PALANGKARAYA', 'ROP'),
(11, 'RO SAMPIT', 'RO SAMPIT', 'ROS');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_qty_assets`
--

CREATE TABLE `tb_qty_assets` (
  `id_qty` int(11) NOT NULL,
  `category` varchar(15) NOT NULL,
  `qty` int(3) NOT NULL,
  `tersedia` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_qty_assets`
--

INSERT INTO `tb_qty_assets` (`id_qty`, `category`, `qty`, `tersedia`) VALUES
(17, 'LAPTOP', 3, 3),
(18, 'PC', 1, 1),
(19, 'PRINTER', 0, 0),
(20, 'GEDGET/TAB', 0, 0),
(21, 'UPS', 0, 0),
(22, 'SCANER', 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_users`
--

CREATE TABLE `tb_users` (
  `id_users` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `department` varchar(30) NOT NULL,
  `position` varchar(30) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_users`
--

INSERT INTO `tb_users` (`id_users`, `name`, `department`, `position`, `is_active`, `date_created`) VALUES
(11, 'Genza', 'MIS', 'Lt 4', 1, 1610423891);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(5, 'Gensza Nando', 'Example@gmail.com', 'default.jpg', '$2y$10$mxwi3iG6r3wyfLdWGnodduvzVZ3laxCq0ayc3umR5Zqi.U6MwSDEu', 2, 1, 1609488815),
(9, 'pendriyani siti', 'pendriyani@gmail.com', '68873154_106055217429849_6565215596244369408_n.jpg', '$2y$10$ncR/cN1wLjUNKmuH2FGf5O9TXBZqxdx.2zox/X1EF3HQoRTKjMBwu', 1, 1, 1609637135),
(11, 'Admin Msal', 'adminmsal@gmail.com', 'default.jpg', '$2y$10$J/PKtinvtUpwmM5dZb4K4.Yl.m5e1SyEZwbXU/Bc/WNnFzi5Qtmei', 2, 1, 1610378543);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_assets`
--
ALTER TABLE `tb_assets`
  ADD PRIMARY KEY (`id_assets`);

--
-- Indeks untuk tabel `tb_lend_assets`
--
ALTER TABLE `tb_lend_assets`
  ADD PRIMARY KEY (`id_lend`);

--
-- Indeks untuk tabel `tb_pt`
--
ALTER TABLE `tb_pt`
  ADD PRIMARY KEY (`id_pt`);

--
-- Indeks untuk tabel `tb_qty_assets`
--
ALTER TABLE `tb_qty_assets`
  ADD PRIMARY KEY (`id_qty`);

--
-- Indeks untuk tabel `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id_users`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_assets`
--
ALTER TABLE `tb_assets`
  MODIFY `id_assets` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_lend_assets`
--
ALTER TABLE `tb_lend_assets`
  MODIFY `id_lend` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_pt`
--
ALTER TABLE `tb_pt`
  MODIFY `id_pt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tb_qty_assets`
--
ALTER TABLE `tb_qty_assets`
  MODIFY `id_qty` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
