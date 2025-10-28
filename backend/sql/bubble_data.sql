-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2025 at 09:18 AM
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
-- Table structure for table `feed`
--

CREATE TABLE `feed` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `posted_by` int(11) NOT NULL,
  `like_count` int(11) DEFAULT 0,
  `share_count` int(11) DEFAULT 0,
  `is_saved` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `friend_requests`
--

CREATE TABLE `friend_requests` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `status` enum('pending','accepted','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `sender_name` varchar(100) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `message_content` text DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `time_posted` datetime DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL,
  `image_path` varchar(500) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `content`, `time_posted`, `user_id`, `image_path`, `timestamp`) VALUES
(13, 'dreams are the wings of the mind you can fly\r\n', '2025-10-20 11:05:19', 15, NULL, '2025-10-20 09:05:19'),
(20, 'im wishing on a star', '2025-10-20 12:08:16', 14, NULL, '2025-10-20 10:08:16'),
(22, 'what a man what a night', '2025-10-20 12:49:12', 12, '68f613a8d704d_527d94df492c87037c2f424374de9056.jpg', '2025-10-20 10:49:12'),
(23, 'Son we live in a world with walls, walls that have to be protected by man with guns. Who is gonna do it you, you lieutenant Weinberg? I have a responsibility greater than you could possibly ever fathom. You weep for Santiago, and you curse the marines, you have that luxury, the luxury of not knowing what I know, that Santiago\'s death while tragic probably saved lives and my existence while grotesque and incomprehensible to you saves lives!!!you don\'t want the truth because deep down in places you don\'t talk about at parties, you want me on that wall you need me on that wall.we use words like honor code and respect we use these words as the backbone of a life spent protecting something,you use them as a punchline!!!', '2025-10-20 14:31:51', 12, '68f62bb736c87_Colonel Nathan R_ Jessup - \'A Few Good Men\' (1).jpg', '2025-10-20 12:31:51'),
(24, 'genlemen that night is upon us', '2025-10-20 14:59:25', 14, '68f6322dde85b_lfc.floz67 - 7546249510352194818.mp4', '2025-10-20 12:59:25'),
(25, 'nothin much', '2025-10-21 10:09:54', 14, NULL, '2025-10-21 08:09:54'),
(26, 'the path of the righteous man is beset on all sides by the inequities of the selfish and the tyranny of evil men. Blessed is he who in the name of charity Shepards his brother through the valley of darkness for he is truly his brother\'s keeper and the finder of lost children. I will strike upon thee with great vengeance and furious anger those who would poison and destroy my brothers. And you will know my name is the lord when I lay my vengeance upon thee!!', '2025-10-22 10:53:31', 20, '68f89b8b25bbe_Samuel L Jackson.jpg', '2025-10-22 08:53:31'),
(27, 'We’re the middle children of history, man. No purpose or place. We have no Great War. No Great Depression. Our Great War’s a spiritual war… our Great Depression is our lives. We’ve all been raised on television to believe that one day we’d all be millionaires, and movie gods, and rock stars. But we won’t. And we’re slowly learning that fact. And we’re very, very pissed off', '2025-10-22 11:47:11', 20, '68f8a81fd8b8f_download.jpg', '2025-10-22 09:47:11'),
(28, 'when in disgrace with fortune and man\'s eyes, I all alone beweep my outcast state and bother deaf heaven with my bootless cries, wishing me like to one more rich in hope, featured like him, like him with friends possessed, desiring this man\'s art and that man\'s scope, with what I most enjoy contented least. Yet in these thoughts myself almost despising, haply I think on thee, and my state sings hymns at heaven\'s gate, for thy sweet love remembered such wealth brings that I then scorn to change my state with kings', '2025-10-22 15:07:16', 15, '68f8d704c3024_shakespare.jpg', '2025-10-22 13:07:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `security_question` varchar(255) NOT NULL,
  `security_answer` varchar(255) DEFAULT NULL,
  `cover_pic` varchar(500) DEFAULT NULL,
  `bio` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password_hash`, `profile_picture`, `security_question`, `security_answer`, `cover_pic`, `bio`) VALUES
(12, 'Pitso Tladi', 'pitsotladi71@gmail.com', '$2y$10$Lia0F6iXjt5RqiMrqdRWkOWe/I4Y9jZgPJAAKK/U85uI6U4tRe33m', 'OIP.webp', 'city of birth', 'Johannesburg', NULL, NULL),
(13, 'george orwell', 'georgeOrwell@oceana.gov', '$2y$10$gwB5LU8riewZiXHYYl7DKumXgqqe8tOapLBE9RPYGan62WSuuUI3u', 'download.jpg', 'city of birth', 'oceana', NULL, NULL),
(14, 'max Halloway', 'maxblessed@ufc.org', '$2y$10$aBXO2xjGdOt01UIRDdrgxeabPrOhRA82AASe93mEO.MnXXutC/bPm', '527d94df492c87037c2f424374de9056.jpg', 'favourite team', 'Barcelona FC', NULL, NULL),
(15, 'winston churchil', 'winstonchurch@ww2.com', '$2y$10$lsqr.lSb5RBG7VHS6E.XQ.13CfxHpoQgcTOnb2rnfoJyzAU2VdMwi', 'Winston Churchill - Wikipedia.jpg', 'favourite team', 'Burnley', NULL, NULL),
(16, 'christiano ronaldo', 'christiano@cr7.co.za', '$2y$10$nhUYLm.AXt1pxvQYDfa.uOfNItFHFbt8OyStPenC3ih8AxrkpjcbC', '', 'favourite_team', 'Real Madrid', NULL, NULL),
(17, 'George st pierre', 'georgest@ufc.org', '$2y$10$dnQwI5OgaP/PpjaLvXj4pOuwUg.4bQAbKmyVg7cfSnjbMKAma4Y.y', 'GSP ☠️.jpg', 'City of birth', 'Canada', NULL, NULL),
(20, 'samuel L jackson', 'JulesWinnfield@LA.com', '$2y$10$t.8SlluNF3pqnlFUjvFTx.AD2D5mdrA4ei6OgENVh4bPSTk05Ibj6', 'Samuel L_ Jackson.jpg', 'favourite team', 'chicago bulls', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `feed`
--
ALTER TABLE `feed`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `posted_by` (`posted_by`);

--
-- Indexes for table `friend_requests`
--
ALTER TABLE `friend_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`);

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
-- AUTO_INCREMENT for table `feed`
--
ALTER TABLE `feed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `friend_requests`
--
ALTER TABLE `friend_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feed`
--
ALTER TABLE `feed`
  ADD CONSTRAINT `feed_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `feed_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `feed_ibfk_3` FOREIGN KEY (`posted_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `friend_requests`
--
ALTER TABLE `friend_requests`
  ADD CONSTRAINT `friend_requests_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `friend_requests_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
