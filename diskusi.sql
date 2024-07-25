-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2023 at 11:55 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `diskusi`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `email` text NOT NULL,
  `nama` text NOT NULL,
  `password` text NOT NULL,
  `no_hp` text NOT NULL,
  `img` text DEFAULT NULL,
  `level` enum('Administrator','Admin Master','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `email`, `nama`, `password`, `no_hp`, `img`, `level`) VALUES
(1, 'admin@admin.com', 'admin1', 'admin', '111', NULL, 'Administrator'),
(4, 'admin2@admin.com', 'admin utama', 'admin2', '222', NULL, 'Admin Master'),
(5, 'admin3@admin.com', 'admin3', 'admin3', '333', NULL, 'Admin Master');

-- --------------------------------------------------------

--
-- Table structure for table `diskusi`
--

CREATE TABLE `diskusi` (
  `id_diskusi` int(11) NOT NULL,
  `id_creator` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `judul_diskusi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `diskusi`
--

INSERT INTO `diskusi` (`id_diskusi`, `id_creator`, `id_kategori`, `judul_diskusi`) VALUES
(8, 2, 1, 'sadasd'),
(9, 2, 1, 'adsd');

-- --------------------------------------------------------

--
-- Table structure for table `diskusi_chat`
--

CREATE TABLE `diskusi_chat` (
  `id_diskusi_chat` int(11) NOT NULL,
  `id_parent` int(11) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `id_diskusi` int(11) NOT NULL,
  `img` text DEFAULT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `diskusi_chat`
--

INSERT INTO `diskusi_chat` (`id_diskusi_chat`, `id_parent`, `id_user`, `id_diskusi`, `img`, `content`, `created_at`) VALUES
(44, NULL, 2, 8, NULL, '<div>dasdasd</div>', '2023-05-22 10:25:35'),
(45, NULL, 2, 9, NULL, '<div>tes</div>', '2023-05-22 10:28:53');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'kategori 1'),
(2, 'kategori 2'),
(3, 'aasdsad');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id_report` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_diskusi_chat` int(11) NOT NULL,
  `jenis_pelanggaran` text NOT NULL,
  `alasan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `nama` text NOT NULL,
  `no_hp` text NOT NULL,
  `img` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `email`, `password`, `nama`, `no_hp`, `img`) VALUES
(2, 'user2@gmail.com', 'user2', 'abc', '222', ''),
(3, 'user2@mail.com', '222', 'user 2 user2', '12345', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRP7Pwh4A5rJop3j3yhYCbnqZDlGOHD118kAacjya3SfQ&amp;s');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `diskusi`
--
ALTER TABLE `diskusi`
  ADD PRIMARY KEY (`id_diskusi`),
  ADD KEY `diskusi_fk0` (`id_creator`),
  ADD KEY `diskusi_fk1` (`id_kategori`);

--
-- Indexes for table `diskusi_chat`
--
ALTER TABLE `diskusi_chat`
  ADD PRIMARY KEY (`id_diskusi_chat`),
  ADD KEY `diskusi_chat_fk0` (`id_parent`),
  ADD KEY `diskusi_chat_ibfk_1` (`id_diskusi`),
  ADD KEY `diskusi_chat_ibfk_2` (`id_user`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id_report`),
  ADD KEY `report_ibfk_1` (`id_diskusi_chat`),
  ADD KEY `report_fk0` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `diskusi`
--
ALTER TABLE `diskusi`
  MODIFY `id_diskusi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `diskusi_chat`
--
ALTER TABLE `diskusi_chat`
  MODIFY `id_diskusi_chat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id_report` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `diskusi`
--
ALTER TABLE `diskusi`
  ADD CONSTRAINT `diskusi_fk0` FOREIGN KEY (`id_creator`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `diskusi_fk1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `diskusi_chat`
--
ALTER TABLE `diskusi_chat`
  ADD CONSTRAINT `diskusi_chat_fk0` FOREIGN KEY (`id_parent`) REFERENCES `diskusi_chat` (`id_diskusi_chat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `diskusi_chat_ibfk_1` FOREIGN KEY (`id_diskusi`) REFERENCES `diskusi` (`id_diskusi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `diskusi_chat_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_fk0` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`id_diskusi_chat`) REFERENCES `diskusi_chat` (`id_diskusi_chat`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
