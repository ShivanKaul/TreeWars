-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2015 at 04:21 PM
-- Server version: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `treewars`
--

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE IF NOT EXISTS `teams` (
  `team_id` int(8) NOT NULL,
  `team_name` varchar(30) NOT NULL,
  `team_date` datetime NOT NULL,
  `team_school` text,
  `team_description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`team_id`, `team_name`, `team_date`, `team_school`, `team_description`) VALUES
(1, 'McGill', '2015-08-22 16:25:34', 'McGill', 'test'),
(2, 'Concordia', '2015-08-22 16:31:47', 'Booooooooo!! Booo Concordia boo!!', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `trees`
--

CREATE TABLE IF NOT EXISTS `trees` (
  `coordinates` int(2) NOT NULL,
  `tree_name` varchar(30) NOT NULL,
  `tree_date` datetime NOT NULL,
  `tree_owner` int(8) NOT NULL,
  `tree_level` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `trees`
--

INSERT INTO `trees` (`coordinates`, `tree_name`, `tree_date`, `tree_owner`, `tree_level`) VALUES
(2, 'bobothetree', '2015-08-22 23:32:04', 4, 0),
(21, 'dodothetree', '2015-08-22 23:32:46', 4, 0),
(41, 'choco', '2015-08-22 23:46:47', 4, 0),
(45, 'spaghettree', '2015-08-22 23:49:54', 4, 0),
(54, 'Albert', '2015-08-23 09:54:43', 4, 0),
(88, 'botothetree', '2015-08-22 23:48:48', 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(8) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `user_team` int(8) DEFAULT NULL,
  `user_pass` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `user_date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_team`, `user_pass`, `user_email`, `is_admin`, `user_date`) VALUES
(4, 'a', NULL, '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', 'a@a.a', 0, '2015-08-22 11:03:16'),
(5, 'c', NULL, '84a516841ba77a5b4648de2cd0dfcb30ea46dbb4', 'c@c.c', 0, '2015-08-22 11:06:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`team_id`),
  ADD UNIQUE KEY `team_name_unique` (`team_name`);

--
-- Indexes for table `trees`
--
ALTER TABLE `trees`
  ADD PRIMARY KEY (`coordinates`),
  ADD KEY `tree_owner` (`tree_owner`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name_unique` (`user_name`),
  ADD KEY `user_team` (`user_team`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `team_id` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `trees`
--
ALTER TABLE `trees`
  ADD CONSTRAINT `trees_ibfk_1` FOREIGN KEY (`tree_owner`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_team`) REFERENCES `teams` (`team_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
