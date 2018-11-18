-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 18, 2018 at 01:27 PM
-- Server version: 5.7.24-0ubuntu0.18.04.1
-- PHP Version: 7.0.32-4+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chat`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

DROP TABLE IF EXISTS `chat`;
CREATE TABLE `chat` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from` bigint(20) UNSIGNED NOT NULL,
  `to` bigint(20) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `date` datetime NOT NULL,
  `seen` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `from`, `to`, `message`, `date`, `seen`) VALUES
(1, 12, 8, 'Barev', '2018-11-15 11:49:19', '1'),
(2, 8, 12, 'Barev !!!', '2018-11-15 15:49:39', '1'),
(3, 8, 12, 'Test', '2018-11-15 16:04:41', '1'),
(4, 12, 6, 'Barev', '2018-11-15 17:00:20', '1'),
(5, 12, 8, 'test', '2018-11-15 17:02:26', '1'),
(6, 12, 8, 'Barev', '2018-11-15 17:02:45', '1'),
(7, 8, 12, 'Hello\r\n', '2018-11-15 17:05:04', '1'),
(8, 12, 12, 'Barev', '2018-11-15 17:05:47', '0'),
(9, 12, 8, 'sdf edfdsfsdfs fs f sdf ', '2018-11-15 17:08:03', '1'),
(10, 12, 8, 'fsdfsdf', '2018-11-15 17:08:26', '1'),
(15, 12, 6, 'sad as da d', '2018-11-18 07:30:40', '0'),
(16, 12, 6, 'test', '2018-11-18 07:30:51', '0'),
(17, 12, 6, 'asdad', '2018-11-18 07:31:46', '0'),
(18, 12, 6, 'asdas', '2018-11-18 07:32:29', '0'),
(19, 12, 6, 'test 123', '2018-11-18 07:34:47', '0'),
(20, 12, 6, 'sadsad as d', '2018-11-18 07:37:25', '0'),
(21, 12, 6, 'asdsa ', '2018-11-18 07:37:40', '0'),
(22, 12, 6, 'asdsa 123', '2018-11-18 07:38:31', '0'),
(23, 12, 6, 'asd ad ', '2018-11-18 07:42:44', '0'),
(24, 12, 6, '123\r\n', '2018-11-18 07:43:44', '0'),
(25, 12, 6, '123', '2018-11-18 07:43:52', '0'),
(26, 12, 6, 'Barev', '2018-11-18 07:44:38', '0'),
(27, 12, 6, 'BArev', '2018-11-18 07:45:13', '0'),
(28, 12, 7, 'test', '2018-11-18 07:48:15', '0'),
(29, 12, 7, 'test', '2018-11-18 07:48:17', '0'),
(30, 12, 7, 'test', '2018-11-18 07:48:20', '0'),
(31, 12, 7, 'test', '2018-11-18 07:48:23', '0'),
(32, 12, 7, 'test', '2018-11-18 07:48:26', '0'),
(33, 12, 9, 'test\r\n', '2018-11-18 08:39:51', '0'),
(34, 12, 9, 'asdas a da ', '2018-11-18 08:40:10', '0'),
(35, 12, 9, 'test', '2018-11-18 08:40:42', '0'),
(36, 12, 9, 'asdasd', '2018-11-18 08:40:53', '0'),
(37, 12, 9, 'sdfsf', '2018-11-18 08:41:49', '0'),
(38, 12, 9, 'test', '2018-11-18 08:42:40', '0'),
(39, 8, 12, 'Barev !!!\r\n', '2018-11-18 08:51:41', '1'),
(40, 8, 12, 'Test\r\n', '2018-11-18 08:52:13', '1'),
(41, 12, 8, 'test', '2018-11-18 08:53:24', '1'),
(42, 12, 8, 'test', '2018-11-18 08:54:51', '1'),
(43, 12, 8, 'test', '2018-11-18 08:55:32', '1'),
(44, 8, 12, 'Barev', '2018-11-18 08:55:46', '1'),
(45, 15, 12, 'Barev', '1970-01-01 00:33:38', '1'),
(46, 12, 10, 'sadad ', '2018-11-18 09:26:50', '0');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `deleted` enum('0','1') DEFAULT '0',
  `registrated_date` datetime DEFAULT NULL,
  `last_visit` datetime DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `email`, `password`, `deleted`, `registrated_date`, `last_visit`, `image`) VALUES
(6, 'Tigran Muradyan', 'tigran.inbox2@gmail.com', 'fca08bf95ff2e820223d3cca4512f5bd', '0', '2018-11-08 09:33:01', NULL, NULL),
(7, NULL, 'astghikmirijanyan1991@gmail.com', 'fca08bf95ff2e820223d3cca4512f5bd', '0', '2018-11-11 10:54:31', NULL, NULL),
(8, 'astghik', 'astghik.mirijanyan@gmail.com', 'fca08bf95ff2e820223d3cca4512f5bd', '0', '2018-11-12 11:32:07', NULL, NULL),
(9, 'karen', 'karen90@mail.ru', 'fca08bf95ff2e820223d3cca4512f5bd', '0', '2018-11-13 01:06:05', NULL, NULL),
(10, 'poxos', 'admin@example.com', 'fca08bf95ff2e820223d3cca4512f5bd', '0', '2018-11-13 06:44:28', NULL, NULL),
(11, 'Poxos', 'admin@admin.com', 'fca08bf95ff2e820223d3cca4512f5bd', '0', '2018-11-13 07:05:09', NULL, NULL),
(12, 'Tigran Muradyan', 'tigran.inbox@gmail.com', 'fca08bf95ff2e820223d3cca4512f5bd', '0', '2018-11-15 07:13:27', NULL, NULL),
(15, 'Tigran', 'new@user.com', 'fca08bf95ff2e820223d3cca4512f5bd', '0', '2018-11-18 13:04:18', NULL, '489861.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `from` (`from`),
  ADD KEY `to` (`to`);

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
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`from`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chat_ibfk_2` FOREIGN KEY (`to`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
