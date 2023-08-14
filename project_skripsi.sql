-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Aug 14, 2023 at 01:08 PM
-- Server version: 8.0.19
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
-- Database: `project_skripsi`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_file`
--

CREATE TABLE `data_file` (
  `id_data_file` varchar(36) NOT NULL,
  `tanggal_input` date NOT NULL,
  `nama_file` varchar(100) NOT NULL,
  `nama_file_enkripsi` varchar(100) NOT NULL,
  `file_size` float NOT NULL,
  `kunci` varchar(30) NOT NULL,
  `id_users` varchar(36) NOT NULL,
  `keterangan_file` varchar(100) NOT NULL,
  `status_file` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `data_file`
--

INSERT INTO `data_file` (`id_data_file`, `tanggal_input`, `nama_file`, `nama_file_enkripsi`, `file_size`, `kunci`, `id_users`, `keterangan_file`, `status_file`, `created_at`, `updated_at`) VALUES
('6b1205f1-3432-486e-bccf-80b1751c4ad3', '2023-01-10', '86534-laporan-rab-agustus-2022-pengajuan-september-2022.xlsx', '86534-laporan-rab-agustus-2022-pengajuan-september-2022.rda', 14.2969, '146b4bad23450903', 'd4971513-6303-4248-bd27-dbb1a999b51e', 'Mantap', 0, '2023-01-10 16:20:55', '2023-08-03 07:58:16'),
('77b8d92f-a887-4bc4-865a-749abe97d081', '2023-05-09', '27243-(1)-aktivitas-keuangan---oktober-2022-baru.xlsx', '27243-(1)-aktivitas-keuangan---oktober-2022-baru.rda', 249.947, '146b4bad23450903', 'd4971513-6303-4248-bd27-dbb1a999b51e', 'File Aktivitas Keuangan', 1, '2023-05-09 14:25:00', '2023-05-09 14:25:21'),
('7d6a0b72-d231-4a68-b93d-0663d43e222c', '2023-01-10', '18187-laporan-rab-agustus-2022-pengajuan-september-2022-(40).xlsx', '18187-laporan-rab-agustus-2022-pengajuan-september-2022-(40).rda', 1522.37, '146b4bad23450903', 'd4971513-6303-4248-bd27-dbb1a999b51e', 'TEST ENKRIPSI LAPORAN RAB', 1, '2023-01-10 16:28:44', '2023-01-10 16:30:46'),
('c3bbbc39-d88c-43ae-abe7-94be22463ed4', '2023-01-10', '62824-test.txt', '62824-test.rda', 16, '146b4bad23450903', 'd4971513-6303-4248-bd27-dbb1a999b51e', 'MANTAP GAN', 1, '2023-01-10 15:18:32', '2023-08-03 07:58:53'),
('e1e7457e-73be-41d3-82a2-d3c4be80fb44', '2023-08-14', '60103-test_2.txt', '60103-test_2.rda', 0.015625, 'e5840d8c53aa1847', 'd4971513-6303-4248-bd27-dbb1a999b51e', 'Test File 2', 1, '2023-08-14 13:05:54', '2023-08-14 13:07:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` varchar(36) NOT NULL,
  `name` varchar(75) NOT NULL,
  `username` varchar(75) NOT NULL,
  `password` varchar(75) NOT NULL,
  `remember_token` varchar(75) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `level_user` int NOT NULL,
  `status_akun` int NOT NULL,
  `status_delete` int NOT NULL,
  `last_login` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `name`, `username`, `password`, `remember_token`, `level_user`, `status_akun`, `status_delete`, `last_login`) VALUES
('33e7b8d7-2e8a-459e-9fee-49bb75e05a93', 'Mahmud', 'mahmud', '$2y$10$1E7tMOJPLanzGQC/uD4/4eR1IdG7gLV9iMgpOKAtuTpI55xBWV/1m', 'bAp8kemVIO0EiT0HUCIabqUoeuazu6Je7gHqWsCDVdECfuaj9TuTPfGyfFvd', 0, 1, 0, NULL),
('66345831-8ea8-406f-9f5d-ecb81c0835b7', 'Ulang', 'ulang', '$2y$10$.diJi4LuPV9A4WWWZMz4KeMj72WTLcXSgrJGieENZy.OngYJHIUEa', NULL, 0, 1, 0, NULL),
('8f83c066-401f-4ada-9a08-67710d987024', 'Ujang', 'ujang', '$2y$10$tdDKr6BmtuUebtRNm3FnYet3.skJqxP0YrxmxQMO0KA4ScEy627v.', NULL, 0, 1, 0, NULL),
('d4971513-6303-4248-bd27-dbb1a999b51e', 'Administrator', 'admin', '$2y$10$rq2tjnEOyOHfHI/zW/.H6.HKObWTvbmcFWQKC2CCwjOAgb3.IKBey', 'H7HoY5xqeGDtbQaF1ARTk683P761l8WfNbEMWHiCulHTjJUjt2z6Ng5ogjLD', 1, 1, 0, '2022-11-23 11:20:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_file`
--
ALTER TABLE `data_file`
  ADD PRIMARY KEY (`id_data_file`),
  ADD KEY `data_file_ibfk_1` (`id_users`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_file`
--
ALTER TABLE `data_file`
  ADD CONSTRAINT `data_file_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
