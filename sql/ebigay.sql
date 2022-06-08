-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2022 at 10:05 AM
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

--
-- Dumping data for table `cash_table`
--

INSERT INTO `cash_table` (`id`, `acc_id`, `name`, `amount`, `proof_of_receipt`) VALUES
(13, 2201046, 'Vince John Perez', '10.00', '280389823_1552450601819662_4309857574461364947_n.jpg'),
(14, 2201046, 'Vince John Perez', '10.00', '280389823_1552450601819662_4309857574461364947_n.jpg'),
(15, 2201046, 'Vince John Perez', '10.00', '280389823_1552450601819662_4309857574461364947_n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `donation_table`
--

CREATE TABLE `donation_table` (
  `id` int(11) NOT NULL,
  `acc_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type_of_donation` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `proof_donation` varchar(255) DEFAULT NULL,
  `date_donated` varchar(255) DEFAULT NULL,
  `status` varchar(25) NOT NULL,
  `notif_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donation_table`
--

INSERT INTO `donation_table` (`id`, `acc_id`, `name`, `type_of_donation`, `description`, `proof_donation`, `date_donated`, `status`, `notif_status`) VALUES
(76, 2201046, 'Vince John Perez', 'Cash', '10', '280389823_1552450601819662_4309857574461364947_n.jpg', 'June 1, 2022', 'Received', 1),
(77, 2201046, 'Vince John Perez', 'Goods: Clothes', '5x for boys pants\r\n5x for girls dress', 'IMG_7793 r dv 2x2.jpg', 'June 2, 2022', 'Received', 1),
(78, 2201046, 'Vince John Perez', 'Goods: Food', '5x Sardines', 'asdasd.PNG', 'June 5, 2022', 'Received', 1),
(79, 2201046, 'Vince John Perez', 'Goods: Toiletries', '5x Tissue Papers', 'qrcode.jpeg', 'June 8, 2022', 'Received', 1),
(80, 2201046, 'Vince John Perez', 'Cash', '10', '280389823_1552450601819662_4309857574461364947_n.jpg', 'June 6, 2022', 'Received', 1),
(81, 2201046, 'Vince John Perez', 'Cash', '10', '280389823_1552450601819662_4309857574461364947_n.jpg', 'June 7, 2022', 'Received', 1);

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
(8, 'Canned Goods', '100', '4000.00'),
(9, 'Testing', '100 kg', '1000.00');

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
  `status` varchar(25) DEFAULT NULL,
  `notif_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `sender_name`, `sender_email`, `msg_subject`, `msg_body`, `status`, `notif_status`) VALUES
(23, 'Vince John Perez', 'perezvj14@gmail.com', 'test', 'tasdafs', 'Replied', 1),
(24, 'Vince John Perez', 'perezvj14@gmail.com', 'Tulong!!!!', 'Penge po Pera Please :)', 'Replied', 1),
(25, 'Vince John Perez', 'perezvj14@gmail.com', 'Testing', 'Quisque dapibus tincidunt condimentum. Duis vehicula lectus eu risus pellentesque hendrerit. Nam nibh mauris, placerat id dignissim a, tristique sed ipsum. Nam luctus neque turpis, vel feugiat lectus fringilla at. Curabitur iaculis diam sed tortor congue,', 'Replied', 1),
(26, 'Vince John Perez', 'perezvj14@gmail.com', 'Question', 'When will the donations will be distributed to the recipients?', 'Replied', 1);

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
-- Table structure for table `total_cash`
--

CREATE TABLE `total_cash` (
  `total` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `total_cash`
--

INSERT INTO `total_cash` (`total`) VALUES
('10.00');

-- --------------------------------------------------------

--
-- Table structure for table `transactiontable`
--

CREATE TABLE `transactiontable` (
  `transac_id` int(11) NOT NULL,
  `acc_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date_generated` date NOT NULL,
  `date_claimed` date DEFAULT NULL,
  `status` varchar(10) NOT NULL,
  `notif_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactiontable`
--

INSERT INTO `transactiontable` (`transac_id`, `acc_id`, `name`, `date_generated`, `date_claimed`, `status`, `notif_status`) VALUES
(57, 2201025, 'Vince John Perez', '2022-06-06', '2022-05-06', 'Claimed', 0),
(59, 2201025, 'Vince John Perez', '2022-06-06', '2022-06-06', 'Claimed', 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `donation_table`
--
ALTER TABLE `donation_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `registered_accounts`
--
ALTER TABLE `registered_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2201047;

--
-- AUTO_INCREMENT for table `transactiontable`
--
ALTER TABLE `transactiontable`
  MODIFY `transac_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

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
