-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2022 at 06:06 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ebigay`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_account`
--

CREATE TABLE `admin_account` (
  `id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_account`
--

INSERT INTO `admin_account` (`id`, `user`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `donation_table`
--

CREATE TABLE `donation_table` (
  `id` int(11) NOT NULL,
  `acc_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type_of_donation` varchar(255) DEFAULT NULL,
  `proof_donation` varchar(255) DEFAULT NULL,
  `date_donated` varchar(255) DEFAULT NULL,
  `notif_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donation_table`
--

INSERT INTO `donation_table` (`id`, `acc_id`, `name`, `type_of_donation`, `proof_donation`, `date_donated`, `notif_status`) VALUES
(36, 2201025, 'Vince John Perez', 'Goods', 'IMG_7793 r dv 2x2.jpg', 'April 21, 2022', 1),
(37, 2201025, 'Vince John Perez', 'Cash', 'IMG_7793 r dv 2x2.jpg', 'April 14, 2022', 1);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `sender_name` varchar(50) NOT NULL,
  `sender_email` varchar(50) NOT NULL,
  `msg_subject` varchar(50) NOT NULL,
  `msg_body` varchar(255) NOT NULL,
  `notif_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `sender_name`, `sender_email`, `msg_subject`, `msg_body`, `notif_status`) VALUES
(23, 'Vince John Perez', 'perezvj14@gmail.com', 'test', 'tasdafs', 1);

-- --------------------------------------------------------

--
-- Table structure for table `registered_accounts`
--

CREATE TABLE `registered_accounts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `datebirth` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` bigint(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(25) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `annual_income` bigint(20) NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `token` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registered_accounts`
--

INSERT INTO `registered_accounts` (`id`, `name`, `datebirth`, `address`, `phone`, `email`, `role`, `occupation`, `annual_income`, `verified`, `token`, `password`) VALUES
(2201024, 'Vince John Perez', '1999-07-14', 'Quezon City', 9359148135, 'perezvj.social@gmail.com', 'Donor', '', 0, 1, '3be522ea5a7bf738a6d7c5782e32ae6c733a9e8967e24e4a1ee6f5e595dd386375b0f2bfc46c5e5498eee93c88df8b7bdd01', '356531c7cf37111656f9e782b7c5efa5'),
(2201025, 'Vince John Perez', '1999-07-14', 'Quezon City', 9359148135, 'perezvj14@gmail.com', 'Recipient', 'IT Professional', 15000, 1, 'ddc83fc2ed9df7f4460ccf54d709202a7f41ca10482281fe5b52e37da422fc321807b3b8c378371c88eec15d6431e28b90c7', '356531c7cf37111656f9e782b7c5efa5');

-- --------------------------------------------------------

--
-- Table structure for table `transactiontable`
--

CREATE TABLE `transactiontable` (
  `transac_id` int(11) NOT NULL,
  `acc_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date_generated` varchar(255) NOT NULL,
  `date_claimed` varchar(255) DEFAULT NULL,
  `status` varchar(10) NOT NULL,
  `notif_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactiontable`
--

INSERT INTO `transactiontable` (`transac_id`, `acc_id`, `name`, `date_generated`, `date_claimed`, `status`, `notif_status`) VALUES
(42, 2201025, 'Vince John Perez', 'March 31, 2022', 'April 20, 2022', 'Claimed', 1),
(43, 2201025, 'Vince John Perez', 'April 22, 2022', 'April 20, 2022', 'Claimed', 1),
(44, 2201025, 'Vince John Perez', 'April 14, 2022', 'Not Yet Available', 'Pending', 0),
(45, 2201025, 'Vince John Perez', 'April 23, 2022', 'Not Yet Available', 'Pending', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_account`
--
ALTER TABLE `admin_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donation_table`
--
ALTER TABLE `donation_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `acc_id_donation_fk` (`acc_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `registered_accounts`
--
ALTER TABLE `registered_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactiontable`
--
ALTER TABLE `transactiontable`
  ADD PRIMARY KEY (`transac_id`),
  ADD KEY `acc_id_recipient_fk` (`acc_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_account`
--
ALTER TABLE `admin_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `donation_table`
--
ALTER TABLE `donation_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `registered_accounts`
--
ALTER TABLE `registered_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2201026;

--
-- AUTO_INCREMENT for table `transactiontable`
--
ALTER TABLE `transactiontable`
  MODIFY `transac_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `donation_table`
--
ALTER TABLE `donation_table`
  ADD CONSTRAINT `acc_id_donation_fk` FOREIGN KEY (`acc_id`) REFERENCES `registered_accounts` (`id`);

--
-- Constraints for table `transactiontable`
--
ALTER TABLE `transactiontable`
  ADD CONSTRAINT `acc_id_recipient_fk` FOREIGN KEY (`acc_id`) REFERENCES `registered_accounts` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
