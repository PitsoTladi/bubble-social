-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2025 at 02:30 PM
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
-- Database: `bubble_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password_hash`, `profile_picture`) VALUES
(1, 'pitso Tladi', '4023030430@me.com', '$2y$10$8Fi1OZy/vSxCutT7xer..ee1nnGvzvd.LdSKy5Utw80KI33pcxFNy', 'OIP.webp'),
(3, 'Sade adu', 'saduAdu@gmail.com', '$2y$10$HYK/GLXvj7ZSEJYQ6Csk/OecOC2ZDFJIHfLTJkeTr1yLAWRsV2qWe', '0189e8d36d8507d0d19f884ba5fa7348.jpg'),
(4, 'Lauryn Hill', 'Lboogie@refugeeCamp.us', '$2y$10$kugDDSTv326YW0BM3jaKpudy7q601JUAkzv9CB4axCL4WhK5fpMGC', '057a2d63b2c2f3dd595f0254f22f3543.jpg'),
(5, 'Malcom Little', 'MaleekAlshabaz@noi.org', '$2y$10$CrSnpOrmXL4uEPIM36wvY.sHzPVFIf9J/xcTYAQEUxyEPp/SSZBg2', ''),
(8, 'Ernesto Che', 'Cheguevara@something.com', '$2y$10$6HdssFyYYsSUTyf44TdfLedRa3IRkod/BAe0XXmWkO1iXLIaoV5Yu', 'dedf0a5b5d5649b7ef91232052cd477d.jpg'),
(9, 'illa Touporia', 'elMetador@espaniol.ufc', '$2y$10$Xvz2zJa0q5bBUs9OcXxz2ObzOFWXd.hiQFKMRc5.YksoB82NZgyzO', '527d94df492c87037c2f424374de9056.jpg'),
(10, 'frank lucas', 'frankwhite@myOrg.ny', '$2y$10$YowXZTTunruaEmXQ28A5Du5v8ko.caQLSnahyfZcjomkTkDoyfEwS', 'e32d9f7d7ae9f16ec7cfe7ea71404fe4.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
