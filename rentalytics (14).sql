-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2023 at 06:56 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rentalytics`
--

-- --------------------------------------------------------

--
-- Table structure for table `amenities`
--

CREATE TABLE `amenities` (
  `amenities_id` int(11) NOT NULL,
  `listing_id` int(11) NOT NULL,
  `amenity` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `amenities`
--

INSERT INTO `amenities` (`amenities_id`, `listing_id`, `amenity`) VALUES
(2, 3, 'Parking'),
(4, 4, 'Parking'),
(5, 4, 'Pool'),
(6, 5, 'Internet'),
(7, 5, 'Pool'),
(8, 6, 'Internet'),
(9, 6, 'Pool'),
(10, 7, 'Internet'),
(11, 7, 'Pool'),
(12, 8, 'Kitchen'),
(13, 8, 'Pool'),
(14, 9, 'Kitchen'),
(15, 9, 'Pool'),
(16, 10, 'Kitchen'),
(17, 10, 'Pool'),
(18, 11, 'Kitchen'),
(19, 11, 'Pool'),
(20, 12, 'Internet'),
(21, 12, 'Parking'),
(22, 13, 'Parking'),
(23, 14, 'Kitchen'),
(24, 15, 'Internet'),
(25, 15, 'Parking'),
(26, 15, 'Pool'),
(27, 16, 'Internet'),
(28, 16, 'Kitchen'),
(29, 16, 'Parking'),
(30, 16, 'Pool'),
(31, 17, 'Internet'),
(32, 17, 'Kitchen'),
(33, 17, 'Parking'),
(34, 17, 'Pool'),
(35, 19, 'Kitchen'),
(36, 19, 'Pool'),
(62, 1, 'Internet'),
(63, 1, 'Kitchen'),
(64, 1, 'Bed'),
(65, 1, 'Parking'),
(66, 20, 'Internet'),
(67, 20, 'Parking');

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `application_id` int(11) NOT NULL,
  `tenant_id` int(11) NOT NULL,
  `listing_id` int(11) NOT NULL,
  `date_of_application` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`application_id`, `tenant_id`, `listing_id`, `date_of_application`, `status`) VALUES
(20, 10, 1, '2023-11-15 03:58:14', 'rejected'),
(21, 10, 1, '2023-11-15 04:01:57', 'rejected'),
(22, 1, 1, '2023-11-15 04:02:33', 'renter'),
(23, 1, 16, '2023-11-15 03:31:53', 'rejected');

-- --------------------------------------------------------

--
-- Table structure for table `credentials`
--

CREATE TABLE `credentials` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `isVerify` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `credentials`
--

INSERT INTO `credentials` (`user_id`, `email`, `password`, `user_type`, `isVerify`) VALUES
(8, 'admin@email.com', 'admin123', 'admin', 0),
(9, 'tenant@email.com', 'pass123', 'tenant', 1),
(10, 'owner@email.com', 'pass123', 'owner', 1),
(11, 'dsa@dsa', '123', 'owner', 0),
(12, 'owner2@email.com', 'pass123', 'owner', 0),
(16, 'pedro@email.com', 'pass123', 'tenant', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cus_ref`
--

CREATE TABLE `cus_ref` (
  `ref_id` int(11) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cus_ref`
--

INSERT INTO `cus_ref` (`ref_id`, `keyword`, `count`) VALUES
(1, 'dsadas', 2),
(3, 'tarlac ', 2),
(4, 'TarLac  city', 1);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `image_id` int(11) NOT NULL,
  `listing_id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `listing`
--

CREATE TABLE `listing` (
  `listing_id` int(11) NOT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `listing_name` varchar(255) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `address3` varchar(255) NOT NULL,
  `address4` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `rentprice` decimal(10,2) NOT NULL,
  `reservationfee` decimal(10,2) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `gender_req` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `isVerify` enum('Verify','Unverified','','') NOT NULL DEFAULT 'Unverified',
  `docs_img` varchar(255) DEFAULT NULL,
  `n_bedroom` int(11) NOT NULL,
  `n_bathroom` int(11) NOT NULL,
  `house_rules` varchar(255) NOT NULL,
  `lat` varchar(255) NOT NULL,
  `lng` varchar(255) NOT NULL,
  `type` enum('boarding_house','apartment','dormitory','bedspace') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `listing`
--

INSERT INTO `listing` (`listing_id`, `owner_id`, `listing_name`, `address1`, `address2`, `address3`, `address4`, `description`, `rentprice`, `reservationfee`, `image_url`, `gender_req`, `created_at`, `updated_at`, `status`, `isVerify`, `docs_img`, `n_bedroom`, `n_bathroom`, `house_rules`, `lat`, `lng`, `type`) VALUES
(1, 1, 'House 1', '123 Street', 'Sto Domingo', 'Capas', 'Tarlac', 'Cozy and Quite :))', 2500.00, 500.00, '../uploads/building (2).jpg', 'Male', '2023-10-25 14:07:06', '2023-11-15 14:55:01', 'active', 'Verify', '../uploads/building (2).jpg', 3, 2, 'No pets allowed', '15.416276856337607', '120.60064255402833', 'boarding_house'),
(16, 1, 'Apparment 2', '', 'Batang-batang', 'Tarlac City', 'Tarlac', 'With Beautiful view', 2000.00, 1000.00, '../uploads/indigi-villa-model-1024x601.jpg', 'Male', '2023-10-29 02:51:04', '2023-11-15 16:15:45', 'active', 'Verify', 'Rentalytic-System-Process.docx', 2, 3, 'No karaoke', '15.416276856337607', '120.60064255402833', 'apartment'),
(17, 1, 'Dorm 1', '', 'Cutcut', 'Tarlac City', 'Tarlac', 'ttest ', 1000.00, 500.00, '../uploads/176138427_683216439038831_4319861464610385375_n.jpg', 'Both', '2023-11-02 12:39:57', '2023-11-15 16:11:39', 'active', 'Unverified', '../uploads/building (2).jpg', 2, 2, 'test house rules', '15.420041605698566', '120.60356079743653', 'dormitory'),
(18, 1, '', '', 'Burot', '', '', '', 0.00, 0.00, '../uploads/building (2).jpg', 'Male', '2023-11-02 12:43:25', '2023-11-15 14:54:52', 'active', 'Unverified', NULL, 0, 0, '', '', '', 'boarding_house'),
(19, 1, 'dsadas', 'test', 'Burot', 'Capas', 'Tarlac', '2132', 123.00, 321312.00, '../uploads/162855851_669796670380808_3630890986535801671_n.jpg', 'Male', '2023-11-02 12:44:03', '2023-11-15 03:46:33', 'active', 'Unverified', 'STUDENT-FACULTY-UNSURETESTCASES.docx', 321, 233, '321', '15.333524', '120.59045', 'boarding_house'),
(20, 1, '321', 'dsa', 'Batang-batang', 'dsa', 'Tarlac', '321', 31233.00, 312.00, '../uploads/building (2).jpg', 'Male', '2023-11-15 14:47:36', '2023-11-15 16:52:43', 'active', 'Unverified', '../uploads/building (2).jpg', 23, 23, '32', '', '', 'boarding_house');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `msg_id` int(11) NOT NULL,
  `tenant_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `message` varchar(255) NOT NULL,
  `message_from` enum('tenant','owner') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`msg_id`, `tenant_id`, `owner_id`, `date`, `message`, `message_from`) VALUES
(1, 1, 1, '2023-11-08 00:00:00', 'owner 1 message', 'owner'),
(2, 1, 1, '2023-11-08 00:05:12', 'dsadas', 'tenant'),
(3, 1, 1, '2023-11-08 00:00:00', 'owner2message', 'owner'),
(4, 1, 1, '2023-11-08 10:17:31', 'test', 'tenant'),
(5, 1, 1, '2023-11-14 16:55:25', 'hello', 'tenant'),
(6, 1, 1, '2023-11-14 16:57:03', 'hi', 'tenant'),
(7, 1, 1, '2023-11-14 17:09:25', 're', 'tenant'),
(8, 1, 1, '2023-11-14 17:25:01', 'test', 'owner'),
(9, 1, 1, '2023-11-14 19:31:16', 'test message 7:30 renter', 'tenant'),
(10, 1, 1, '2023-11-14 19:32:03', 'reply owner', 'owner'),
(11, 10, 1, '2023-11-15 11:36:26', 'Hellow ', 'tenant');

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE `owner` (
  `owner_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `id_picture` varchar(255) NOT NULL,
  `profile_pic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`owner_id`, `user_id`, `name`, `birthdate`, `gender`, `id_picture`, `profile_pic`) VALUES
(1, 10, 'Maria Makiling', '2023-10-13', 'Male', 'idpicture.png', 'User-Profile-PNG-Image.png'),
(2, 11, 'dasdas', '2005-11-02', 'Male', 'idpicture.png', 'User-Profile-PNG-Image.png'),
(3, 12, 'owner2', '2005-11-03', 'Female', 'idpicture.png', 'User-Profile-PNG-Image.png');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `application_id` int(11) NOT NULL,
  `payment_date` date NOT NULL,
  `ref_number` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL DEFAULT 'paid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `application_id`, `payment_date`, `ref_number`, `payment_status`) VALUES
(16, 21, '2023-11-15', '', 'paid');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int(11) NOT NULL,
  `rating` int(11) DEFAULT NULL,
  `feedback` text DEFAULT NULL,
  `tenant_id` int(11) NOT NULL,
  `listing_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`review_id`, `rating`, `feedback`, `tenant_id`, `listing_id`) VALUES
(1, 4, 'Good place', 1, 1),
(2, 1, 'Dirty', 1, 1),
(3, 4, 'good service', 1, 16);

-- --------------------------------------------------------

--
-- Table structure for table `tenant`
--

CREATE TABLE `tenant` (
  `tenant_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `profile_pic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tenant`
--

INSERT INTO `tenant` (`tenant_id`, `user_id`, `name`, `birthdate`, `gender`, `profile_pic`) VALUES
(1, 9, 'Juan Delacruz', '2023-10-20', 'Female', 'User-Profile-PNG-Image.png'),
(10, 16, 'Pedro Guzman', '2005-11-01', 'Male', 'User-Profile-PNG-Image.png');

-- --------------------------------------------------------

--
-- Table structure for table `togo`
--

CREATE TABLE `togo` (
  `togo_id` int(11) NOT NULL,
  `tenant_id` int(11) NOT NULL,
  `listing_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `togo`
--

INSERT INTO `togo` (`togo_id`, `tenant_id`, `listing_id`) VALUES
(7, 10, 1),
(8, 10, 16);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amenities`
--
ALTER TABLE `amenities`
  ADD PRIMARY KEY (`amenities_id`),
  ADD KEY `listing_id` (`listing_id`);

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`application_id`);

--
-- Indexes for table `credentials`
--
ALTER TABLE `credentials`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `cus_ref`
--
ALTER TABLE `cus_ref`
  ADD PRIMARY KEY (`ref_id`),
  ADD UNIQUE KEY `keyword_index` (`keyword`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `listing_id` (`listing_id`);

--
-- Indexes for table `listing`
--
ALTER TABLE `listing`
  ADD PRIMARY KEY (`listing_id`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`owner_id`),
  ADD KEY `fk_tenant_id` (`user_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `fk_application_id` (`application_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `sd` (`listing_id`),
  ADD KEY `dsadsa` (`tenant_id`);

--
-- Indexes for table `tenant`
--
ALTER TABLE `tenant`
  ADD PRIMARY KEY (`tenant_id`);

--
-- Indexes for table `togo`
--
ALTER TABLE `togo`
  ADD PRIMARY KEY (`togo_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `amenities`
--
ALTER TABLE `amenities`
  MODIFY `amenities_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `application`
--
ALTER TABLE `application`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `credentials`
--
ALTER TABLE `credentials`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `cus_ref`
--
ALTER TABLE `cus_ref`
  MODIFY `ref_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `listing`
--
ALTER TABLE `listing`
  MODIFY `listing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `owner`
--
ALTER TABLE `owner`
  MODIFY `owner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tenant`
--
ALTER TABLE `tenant`
  MODIFY `tenant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `togo`
--
ALTER TABLE `togo`
  MODIFY `togo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`listing_id`) REFERENCES `listing` (`listing_id`);

--
-- Constraints for table `listing`
--
ALTER TABLE `listing`
  ADD CONSTRAINT `listing_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `owner` (`owner_id`) ON DELETE CASCADE;

--
-- Constraints for table `owner`
--
ALTER TABLE `owner`
  ADD CONSTRAINT `fk_tenant_id` FOREIGN KEY (`user_id`) REFERENCES `credentials` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `fk_application_id` FOREIGN KEY (`application_id`) REFERENCES `application` (`application_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `dsadsa` FOREIGN KEY (`tenant_id`) REFERENCES `tenant` (`tenant_id`),
  ADD CONSTRAINT `sd` FOREIGN KEY (`listing_id`) REFERENCES `listing` (`listing_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
