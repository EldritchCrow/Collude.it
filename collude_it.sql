-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2019 at 07:37 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `collude_it`
--

-- --------------------------------------------------------

--
-- Table structure for table `datetime_prefs`
--

CREATE TABLE `datetime_prefs` (
  `user_id` char(24) COLLATE utf8_unicode_ci NOT NULL,
  `day` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `start_time` int(4) NOT NULL,
  `end_time` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `group_id` char(24) COLLATE utf8_unicode_ci NOT NULL,
  `group_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `chat_history` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`group_id`, `group_name`, `chat_history`) VALUES
('5a59210d5acdb195560a091f', 'shut the fuck', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `group_members`
--

CREATE TABLE `group_members` (
  `group_id` char(24) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` char(24) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `group_members`
--

INSERT INTO `group_members` (`group_id`, `user_id`) VALUES
('5a59210d5acdb195560a091f', '5a59210d5acdb195560a091b'),
('5a59210d5acdb195560a091f', '6a09ffb2bf7510ff8a2657ef'),
('5a59210d5acdb195560a091f', '93c316f0939524976f7c1307'),
('5a59210d5acdb195560a091f', 'af4336da9e48064c399b115d');

-- --------------------------------------------------------

--
-- Table structure for table `location_prefs`
--

CREATE TABLE `location_prefs` (
  `user_id` char(24) COLLATE utf8_unicode_ci NOT NULL,
  `loc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rank` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

CREATE TABLE `meetings` (
  `meeting_id` char(24) COLLATE utf8_unicode_ci NOT NULL,
  `group_id` char(24) COLLATE utf8_unicode_ci NOT NULL,
  `m_time` datetime NOT NULL,
  `m_location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `confirmed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` char(24) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `real_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `real_name`, `password_hash`, `last_update`) VALUES
('039e6821f16d082064f5c653', 'a', 'a', '$2y$10$xzXiLRN3KeNaLz6tKL/ni.u.8Zlfbx1.V6uPEbjU76WcnuHPW4R8y', '2019-12-02 20:41:55'),
('5a59210d5acdb195560a091b', 'bob', 'bobby', '$2y$10$jjYmJ56lxH0TJi9l5kE7xe/X3KxANs9E0oDCCGQdJQtqFn9L9Ji.G', '2019-11-27 01:00:07'),
('6a09ffb2bf7510ff8a2657ef', 'd', 'd', '$2y$10$2fx2cyZ8FMsgaH8X5.ex..LK1Gaeh3DmKRan5cS1n0aOMGRfYEw0q', '2019-12-02 21:42:16'),
('93c316f0939524976f7c1307', 'b', 'b', '$2y$10$bQj1.m/HdPnaDY3adQq.xOak4YpG8yNPhKhSyEQcgug5zsMd.wjX6', '2019-12-02 20:45:24'),
('af4336da9e48064c399b115d', 'c', 'c', '$2y$10$NtWTTewftwc9TokvkzS2..V8ArZ1f8Dscz/DpZB1./bgwDdL9YY4S', '2019-12-02 21:37:50');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `user_id` char(24) COLLATE utf8_unicode_ci NOT NULL,
  `meeting_id` char(24) COLLATE utf8_unicode_ci NOT NULL,
  `yes` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `datetime_prefs`
--
ALTER TABLE `datetime_prefs`
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `group_members`
--
ALTER TABLE `group_members`
  ADD KEY `group_id` (`group_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `location_prefs`
--
ALTER TABLE `location_prefs`
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `meetings`
--
ALTER TABLE `meetings`
  ADD PRIMARY KEY (`meeting_id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD KEY `meeting_id` (`meeting_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `datetime_prefs`
--
ALTER TABLE `datetime_prefs`
  ADD CONSTRAINT `datetime_prefs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `group_members`
--
ALTER TABLE `group_members`
  ADD CONSTRAINT `group_members_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `group_members_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `location_prefs`
--
ALTER TABLE `location_prefs`
  ADD CONSTRAINT `location_prefs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `meetings`
--
ALTER TABLE `meetings`
  ADD CONSTRAINT `meetings_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`meeting_id`) REFERENCES `meetings` (`meeting_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
