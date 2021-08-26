-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2021 at 12:29 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ems`
--

-- --------------------------------------------------------

--
-- Table structure for table `adduser`
--

CREATE TABLE `adduser` (
  `addusr_id` int(255) NOT NULL,
  `addusr_name` varchar(1000) NOT NULL,
  `addusr_signup_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `addusr_exipre` timestamp NULL DEFAULT NULL,
  `usr_mac` varchar(1000) NOT NULL,
  `addusr_status` varchar(100) NOT NULL,
  `addusr_state` varchar(100) NOT NULL,
  `addusr_credit` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adduser`
--

INSERT INTO `adduser` (`addusr_id`, `addusr_name`, `addusr_signup_date`, `addusr_exipre`, `usr_mac`, `addusr_status`, `addusr_state`, `addusr_credit`) VALUES
(1, 'kongkan', '2021-08-18 22:04:32', '2021-09-17 22:04:32', '', '', 'Full', 0),
(2, 'mrikongkan', '2021-08-18 22:04:45', '2021-08-21 22:04:45', '', '', 'Demo', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(255) NOT NULL,
  `nickname` varchar(1000) NOT NULL,
  `user_name` varchar(1000) NOT NULL,
  `user_email` varchar(1000) NOT NULL,
  `user_pass` varchar(1000) NOT NULL,
  `user_img` longtext DEFAULT NULL,
  `user_role` varchar(100) NOT NULL,
  `user_dept` varchar(100) NOT NULL,
  `user_gen` varchar(100) NOT NULL,
  `create_by` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `nickname`, `user_name`, `user_email`, `user_pass`, `user_img`, `user_role`, `user_dept`, `user_gen`, `create_by`) VALUES
(28, 'kongkan', 'Mrikongkan Mondal', 'mr.kongkan.cseiu@gmail.com', 'd24ed57a1c91d753fcb90cd50ad3e4b5', NULL, 'Admin', 'Web Design', 'Male', '2021-08-21 17:56:13'),
(29, 'mrikongkan', 'Mrikongkan Mondal', 'kongkan.cseiu@gmail.com', 'a6a4398accc1bec791a19e262725bee3', NULL, 'User', 'Search Engine Optimozation', 'Other', '2021-08-15 21:25:10'),
(30, 'sumanta', 'Sumanta Mondal', 'sumantamondal@gmail.com', '3e06bac579d47690b59827d8b09c579a', NULL, 'User', 'Search Engine Optimozation', 'Male', '2021-08-16 17:02:55'),
(31, 'kuntal', 'Kuntal Mondal', 'kuntalmondal@gmail.com', 'e78c17db3f1e3c505aa1f6ccb6f137f5', NULL, 'User', 'Search Engine Optimozation', 'Male', '2021-08-16 17:04:22'),
(32, 'puranjoy', 'Puranjoy Mondal', 'puranjoymondal@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'Super', 'Web Design', 'Male', '2021-08-19 22:28:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adduser`
--
ALTER TABLE `adduser`
  ADD PRIMARY KEY (`addusr_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adduser`
--
ALTER TABLE `adduser`
  MODIFY `addusr_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
