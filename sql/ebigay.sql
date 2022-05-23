-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2022 at 03:53 AM
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
-- Table structure for table `cash_table`
--

CREATE TABLE `cash_table` (
  `id` int(11) NOT NULL,
  `acc_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `proof_of_receipt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `donation_table`
--

CREATE TABLE `donation_table` (
  `id` int(11) NOT NULL,
  `acc_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type_of_donation` varchar(255) DEFAULT NULL,
  `amount` decimal(15,2) DEFAULT NULL,
  `proof_donation` varchar(255) DEFAULT NULL,
  `date_donated` varchar(255) DEFAULT NULL,
  `status` varchar(25) NOT NULL,
  `notif_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donation_table`
--

INSERT INTO `donation_table` (`id`, `acc_id`, `name`, `type_of_donation`, `amount`, `proof_donation`, `date_donated`, `status`, `notif_status`) VALUES
(68, 2201046, 'Vince John Perez', 'Goods', '0.00', '280389823_1552450601819662_4309857574461364947_n.jpg', 'May 23, 2022', 'Received', 1),
(69, 2201046, 'Vince John Perez', 'Cash', '3500.00', '280389823_1552450601819662_4309857574461364947_n.jpg', 'May 23, 2022', 'Being droped off', 1);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `item_id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `price` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`item_id`, `category`, `quantity`, `price`) VALUES
(6, 'Testing', '100 kg', '1000.00'),
(7, 'Testing', '100 kg', '1000.00'),
(8, 'Canned Goods', '100', '4000.00');

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
(2201025, 'Vince John Perez', '1999-07-14', 'Quezon City', 9359148135, 'perezvj14@gmail.com', 'Recipient', 'IT Professional', 15000, 1, 'ddc83fc2ed9df7f4460ccf54d709202a7f41ca10482281fe5b52e37da422fc321807b3b8c378371c88eec15d6431e28b90c7', '356531c7cf37111656f9e782b7c5efa5'),
(2201046, 'Vince John Perez', '1999-07-14', 'Quezon City', 9359148135, 'perezvj.social@gmail.com', 'Donor', '', 0, 1, '6c6ce73e49cde41a025cf0e578fad6626211af6b91fb0c595be2a7d9d57dfd570856e359c5595bca6eae6a9f2f4aac6af51f', '356531c7cf37111656f9e782b7c5efa5');

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
(44, 2201025, 'Vince John Perez', 'April 14, 2022', 'May 15, 2022', 'Claimed', 1),
(45, 2201025, 'Vince John Perez', 'April 23, 2022', 'May 15, 2022', 'Claimed', 1),
(46, 2201025, 'Vince John Perez', 'May 12, 2022', 'Not Yet Available', 'Pending', 1),
(47, 2201025, 'Vince John Perez', 'May 27, 2022', 'Not Yet Available', 'Pending', 1),
(48, 2201025, 'Vince John Perez', 'May 16, 2022', 'Not Yet Available', 'Pending', 1),
(49, 2201025, 'Vince John Perez', 'January 1, 1970', 'Not Yet Available', 'Pending', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_account`
--
ALTER TABLE `admin_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cash_table`
--
ALTER TABLE `cash_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `acc_id_cash_table_fk` (`acc_id`);

--
-- Indexes for table `donation_table`
--
ALTER TABLE `donation_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `acc_id_donation_fk` (`acc_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`item_id`);

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
-- AUTO_INCREMENT for table `cash_table`
--
ALTER TABLE `cash_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `donation_table`
--
ALTER TABLE `donation_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `registered_accounts`
--
ALTER TABLE `registered_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2201047;

--
-- AUTO_INCREMENT for table `transactiontable`
--
ALTER TABLE `transactiontable`
  MODIFY `transac_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cash_table`
--
ALTER TABLE `cash_table`
  ADD CONSTRAINT `acc_id_cash_table_fk` FOREIGN KEY (`acc_id`) REFERENCES `registered_accounts` (`id`);

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
