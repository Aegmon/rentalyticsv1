-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2023 at 12:33 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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
(67, 20, 'Parking'),
(72, 21, 'Internet'),
(73, 21, 'Kitchen'),
(74, 21, 'Bed'),
(75, 21, 'Parking'),
(76, 22, 'Internet'),
(77, 22, 'Bed'),
(78, 22, 'Laundry Facilities'),
(79, 23, 'Internet'),
(80, 23, 'Bed'),
(81, 23, 'Laundry Facilities'),
(82, 24, 'Internet'),
(83, 24, 'Kitchen'),
(84, 24, 'Bed'),
(85, 24, 'Parking'),
(86, 24, 'Laundry Facilities'),
(87, 25, 'Internet'),
(88, 25, 'Kitchen'),
(89, 25, 'Bed'),
(90, 26, 'Internet'),
(91, 26, 'Kitchen'),
(92, 26, 'Bed'),
(93, 26, 'Parking'),
(94, 27, 'Internet'),
(95, 27, 'Kitchen'),
(96, 27, 'Bed'),
(97, 27, 'Laundry Facilities'),
(98, 28, 'Internet'),
(99, 28, 'Bed'),
(100, 29, 'Internet'),
(101, 29, 'Bed'),
(102, 29, 'Laundry Facilities'),
(103, 30, 'Internet'),
(104, 30, 'Parking'),
(105, 30, 'Laundry Facilities'),
(106, 31, 'Internet'),
(107, 31, 'Bed'),
(108, 31, 'Laundry Facilities'),
(109, 32, 'Internet'),
(110, 32, 'Bed'),
(111, 32, 'Laundry Facilities'),
(112, 33, 'Internet'),
(113, 33, 'Kitchen'),
(114, 33, 'Bed'),
(115, 33, 'Parking'),
(116, 33, 'Laundry Facilities'),
(117, 34, 'Internet'),
(118, 34, 'Kitchen'),
(119, 34, 'Laundry Facilities'),
(120, 35, 'Kitchen'),
(121, 35, 'Bed'),
(122, 35, 'Parking'),
(123, 36, 'Internet'),
(124, 36, 'Bed'),
(125, 36, 'Parking'),
(126, 37, 'Internet'),
(127, 37, 'Bed'),
(128, 37, 'Laundry Facilities'),
(129, 38, 'Internet'),
(130, 38, 'Kitchen'),
(131, 38, 'Laundry Facilities'),
(132, 39, 'Internet'),
(133, 39, 'Pool'),
(134, 39, 'Laundry Facilities'),
(135, 40, 'Internet'),
(136, 40, 'Kitchen'),
(137, 40, 'Laundry Facilities'),
(138, 41, 'Internet'),
(139, 41, 'Parking'),
(140, 41, 'Laundry Facilities'),
(141, 42, 'Internet'),
(142, 42, 'Bed'),
(143, 42, 'Parking'),
(144, 43, 'Internet'),
(145, 43, 'Kitchen'),
(146, 43, 'Bed'),
(147, 43, 'Parking'),
(148, 44, 'Internet'),
(149, 44, 'Pool'),
(150, 44, 'Laundry Facilities'),
(151, 45, 'Internet'),
(152, 45, 'Kitchen'),
(153, 45, 'Bed'),
(154, 46, 'Bed'),
(155, 46, 'Laundry Facilities');

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
(32, 1, 22, '2023-11-24 01:35:14', 'rejected'),
(33, 2, 22, '2023-11-28 07:25:14', 'renter'),
(34, 1, 23, '2023-12-28 11:44:32', 'approved'),
(35, 11, 22, '2023-10-28 11:58:33', 'approved'),
(36, 11, 23, '2023-09-28 11:59:12', 'approved'),
(37, 1, 25, '2023-08-28 12:01:28', 'approved'),
(38, 1, 26, '2023-08-28 12:01:36', 'approved'),
(39, 1, 27, '2023-09-28 12:01:49', 'approved'),
(40, 1, 28, '2023-10-28 12:01:56', 'approved'),
(41, 9, 22, '2023-10-28 13:24:23', 'approved'),
(42, 3, 22, '2023-10-28 11:58:33', 'approved'),
(43, 3, 22, '2023-10-28 11:58:33', 'rejected'),
(44, 4, 22, '2023-10-28 11:58:33', 'rejected'),
(45, 4, 22, '2023-10-28 11:58:33', 'rejected'),
(46, 4, 22, '2023-08-28 11:58:33', 'rejected'),
(47, 4, 22, '2023-08-28 11:58:33', 'rejected'),
(48, 4, 22, '2023-08-28 11:58:33', 'rejected'),
(49, 4, 22, '2023-08-28 11:58:33', 'Approved'),
(50, 4, 22, '2023-08-28 11:58:33', 'Approved'),
(51, 5, 22, '2023-08-28 11:58:33', 'Approved'),
(52, 5, 22, '2023-08-28 11:58:33', 'renter'),
(53, 3, 22, '2023-08-28 11:58:33', 'renter'),
(54, 3, 22, '2023-09-28 11:58:33', 'renter'),
(55, 3, 23, '2023-09-28 12:01:49', 'approved'),
(56, 4, 23, '2023-09-28 12:01:49', 'approved'),
(57, 5, 23, '2023-09-28 12:01:49', 'approved'),
(58, 6, 23, '2023-09-28 12:01:49', 'approved'),
(59, 7, 23, '2023-09-28 12:01:49', 'approved'),
(60, 9, 23, '2023-09-28 12:01:49', 'approved'),
(61, 10, 23, '2023-09-28 12:01:49', 'approved'),
(62, 11, 23, '2023-09-28 12:01:49', 'approved'),
(63, 2, 23, '2023-09-28 12:01:49', 'approved'),
(64, 3, 23, '2023-09-28 12:01:49', 'approved'),
(65, 4, 23, '2023-09-28 12:01:49', 'approved'),
(66, 5, 23, '2023-09-28 12:01:49', 'approved'),
(67, 6, 23, '2023-09-28 12:01:49', 'approved'),
(68, 7, 23, '2023-09-28 12:01:49', 'approved'),
(69, 8, 23, '2023-09-28 12:01:49', 'approved'),
(70, 7, 23, '2023-10-28 12:01:49', 'approved'),
(71, 8, 23, '2023-10-28 12:01:49', 'approved'),
(72, 9, 23, '2023-10-28 12:01:49', 'approved'),
(73, 10, 23, '2023-10-28 12:01:49', 'approved'),
(74, 11, 23, '2023-10-28 12:01:49', 'approved'),
(75, 2, 23, '2023-10-28 12:01:49', 'rejected'),
(76, 3, 23, '2023-10-28 12:01:49', 'rejected'),
(77, 4, 23, '2023-10-28 12:01:49', 'rejected'),
(78, 5, 23, '2023-10-28 12:01:49', 'approved'),
(79, 6, 23, '2023-10-28 12:01:49', 'rejected'),
(80, 7, 23, '2023-11-28 12:01:49', 'approved'),
(81, 8, 23, '2023-11-28 12:01:49', 'approved'),
(82, 9, 23, '2023-11-28 12:01:49', 'approved'),
(83, 10, 23, '2023-11-28 12:01:49', 'approved'),
(84, 11, 23, '2023-11-28 12:01:49', 'approved'),
(85, 2, 23, '2023-11-28 12:01:49', 'rejected'),
(86, 3, 23, '2023-11-28 12:01:49', 'rejected'),
(87, 4, 23, '2023-11-28 12:01:49', 'rejected'),
(88, 5, 23, '2023-11-28 12:01:49', 'approved'),
(89, 6, 23, '2023-11-28 12:01:49', 'rejected'),
(90, 7, 23, '2023-12-28 12:01:49', 'approved'),
(91, 8, 23, '2023-12-28 12:01:49', 'approved'),
(92, 9, 23, '2023-12-28 12:01:49', 'approved'),
(93, 10, 23, '2023-12-28 12:01:49', 'approved'),
(94, 11, 23, '2023-12-28 12:01:49', 'approved'),
(95, 1, 23, '2023-12-28 12:01:49', 'rejected'),
(96, 2, 23, '2023-12-28 12:01:49', 'approved'),
(97, 3, 23, '2023-12-28 12:01:49', 'approved'),
(98, 4, 23, '2023-12-28 12:01:49', 'rejected'),
(99, 5, 23, '2023-12-28 12:01:49', 'approved'),
(100, 6, 23, '2023-12-28 12:01:49', 'rejected'),
(101, 7, 23, '2023-12-28 12:01:49', 'approved'),
(102, 8, 23, '2023-12-28 12:01:49', 'approved'),
(103, 9, 23, '2023-12-28 12:01:49', 'rejected'),
(104, 10, 23, '2023-12-28 12:01:49', 'approved'),
(105, 11, 23, '2023-12-28 12:01:49', 'approved'),
(106, 1, 23, '2023-12-28 12:01:49', 'approved'),
(107, 2, 23, '2023-12-28 12:01:49', 'approved'),
(108, 3, 23, '2023-12-28 12:01:49', 'approved'),
(109, 3, 22, '2023-11-28 12:01:49', 'rejected');

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
(10, 'rentalyticstarlac@gmail.com', 'rentalytics@tarlac112023', 'admin', 1),
(11, 'rentalyticstarlac+renter7@gmail.com', '12345678', 'tenant', 1),
(22, 'rentalyticstarlac+renter2@gmail.com', '12345678', 'tenant', 1),
(23, 'rentalyticstarlac+owner1@gmail.com', '12345678', 'owner', 1),
(24, 'rentalyticstarlac+owner2@gmail.com', '12345678', 'owner', 1),
(25, 'rentalyticstarlac+owner3@gmail.com', '12345678', 'owner', 1),
(26, 'rentalyticstarlac+owner4@gmail.com', '12345678', 'owner', 1),
(27, 'rentalyticstarlac+owner5@gmail.com', '12345678', 'owner', 1),
(28, 'rentalyticstarlac+renter1@gmail.com', '12345678', 'tenant', 1),
(33, 'rentalyticstarlac+renter3@gmail.com', '12345678', 'tenant', 1),
(44, 'rentalyticstarlac+renter10@gmail.com', '12345678', 'tenant', 1),
(55, 'rentalyticstarlac+renter9@gmail.com', '12345678', 'tenant', 1),
(77, 'rentalyticstarlac+renter8@gmail.com', '12345678', 'tenant', 1),
(88, 'rentalyticstarlac+renter6@gmail.com', '12345678', 'tenant', 1),
(99, 'rentalyticstarlac+renter5@gmail.com', '12345678', 'tenant', 1),
(100, 'rentalyticstarlac+renter4@gmail.com', '12345678', 'tenant', 1),
(101, 'pedrotenant@email.com', '12345678', 'tenant', 1),
(102, 'OwnerOne@gmail.com', 'Rentalytics@01', 'owner', 0);

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
(6, 'Bathroom (2)', 2),
(7, 'Bed (2)', 3),
(9, 'Amucao', 1),
(10, 'Min Price: 1000', 1),
(11, 'Max Price: 2500', 1),
(12, 'Min Price: 2000', 1),
(13, 'Max Price: 5000', 1),
(14, 'Apartment', 1),
(15, 'bedspace', 1),
(16, 'Dormitory', 1),
(17, 'boarding_house', 11),
(19, 'Bed (1)', 1),
(23, 'Bed (3)', 1),
(25, 'Bed (4)', 2),
(27, 'Bed (5)', 1),
(31, 'Bathroom (1)', 1),
(35, 'Bathroom (4)', 1),
(37, 'Bathroom (5)', 1),
(38, 'Asturias', 1);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `image_id` int(11) NOT NULL,
  `listing_id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`image_id`, `listing_id`, `image_url`) VALUES
(1, 43, '../uploads/o4bh2.jpeg'),
(2, 44, '../uploads/inbound6472849702055752327.jpg'),
(3, 44, '../uploads/inbound1751345639692428910.jpg'),
(4, 44, '../uploads/inbound8694859709521497854.jpg'),
(5, 44, '../uploads/inbound5469648425798126049.jpg'),
(6, 45, '../uploads/o4a2.jpeg'),
(7, 45, '../uploads/o5a1.jpeg'),
(8, 45, '../uploads/o5a2.jpeg'),
(9, 45, '../uploads/o5bh1.jpeg');

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
(22, 8, 'Owner One Bedspace', 'Fiesta Communities ', 'Aguso', 'Tarlac City', 'Tarlac', 'Clean\r\nHave a good environment\r\nQuiet', 2000.00, 1000.00, '../uploads/inbound6528786987624804792.jpg', 'Both', '2023-11-16 11:25:04', '2023-11-16 12:24:29', 'active', 'Verify', NULL, 3, 1, 'Not pets\r\nNo curfew ', '15.531284237048153', '120.59850123042649', 'bedspace'),
(23, 8, 'Owner One Apartment', 'Santa Rosa', 'Amucao', 'Tarlac City', 'Tarlac', 'Clean\r\nQuiet\r\nHave good environment ', 3000.00, 1500.00, '../uploads/inbound5623160557717180018.jpg', 'Female', '2023-11-16 11:30:20', '2023-11-16 12:24:32', 'active', 'Verify', '../uploads/inbound8561684148948526511.jpg', 2, 3, 'Have curfew\r\nNo visitors\r\nNo pets', '15.4687339', '120.6835677', 'apartment'),
(25, 11, 'Owner Four Dorm', 'Sitio Bacuit, Tibag, Tarlac City', 'Tibag', 'Tarlac City', 'Tarlac', 'Clean and Quiet', 1200.00, 800.00, '../uploads/o4d1.jpeg', 'Male', '2023-11-16 11:36:43', '2023-11-16 15:30:46', 'active', 'Verify', '../uploads/received_276316062071288.jpeg', 4, 1, 'Drinking and smoking inside is not allowed', '15.49045', '120.570099', 'dormitory'),
(26, 11, 'Owner Four Boarding House', 'Ramos street, San Vicente, Tarlac City', 'San Vicente', 'Tarlac City', 'Tarlac', 'Peaceful and Clean', 2000.00, 1100.00, '../uploads/o4bh2.jpeg', 'Both', '2023-11-16 11:39:21', '2023-11-16 16:04:07', 'active', 'Verify', '../uploads/received_869808694459396.jpeg', 4, 2, 'Bawal maingay', '15.4832968', '120.5859803', 'boarding_house'),
(27, 11, 'Owner Four Apartment', 'Zone 5, San Isidro, Tarlac City', 'San Isidro', 'Tarlac City', 'Tarlac', 'Clean', 1500.00, 800.00, '../uploads/o4a2.jpeg', 'Female', '2023-11-16 11:41:50', '2023-11-16 16:04:17', 'active', 'Verify', '../uploads/received_276316062071288.jpeg', 5, 2, 'Bawal maingay', '15.4937833', '120.5869792', 'apartment'),
(28, 11, 'Owner Four Bedspace', 'Zone 4, san rafael, tarlac city', 'San Rafael', 'Tarlac City', 'Tarlac', 'Clean', 1100.00, 600.00, '../uploads/o4b1.jpeg', 'Both', '2023-11-16 11:46:05', '2023-11-16 16:04:49', 'active', 'Verify', '../uploads/received_276316062071288.jpeg', 4, 1, 'Drinking and Smoking is not allowed', '15.4572131', '120.5883446', 'bedspace'),
(29, 8, 'Owner One Boarding', 'Central Elementary ', 'Alvindia', 'Tarlac City', 'Tarlac', 'Quiet\r\nClean\r\nGood location ', 4000.00, 1300.00, '../uploads/inbound6106849404066124637.jpg', 'Female', '2023-11-16 11:53:07', '2023-11-16 11:53:07', 'active', 'Unverified', '../uploads/inbound5131398044809251282.png', 5, 3, 'Don\'t have curfew\r\n', '15.5321825', '120.5943021', 'boarding_house'),
(30, 8, 'Owner One Dormitory', 'Armenia ', 'Armenia', 'Tarlac ', 'Tarlac', 'Good environment\r\nLot of place to go', 5000.00, 2500.00, '../uploads/inbound1934940559940835613.jpg', 'Male', '2023-11-16 11:56:39', '2023-11-16 11:56:39', 'active', 'Unverified', '../uploads/inbound431118397975791885.jpg', 6, 3, 'No curfew\r\nNo pets', '15.4297907', '120.5451797', 'dormitory'),
(31, 9, 'Owner Two Bedspace ', 'Zone 1', 'Aguso', 'Tarlac City', 'Tarlac', 'Clean and quiet\r\nGood location ', 2000.00, 1500.00, '../uploads/received_702995408455132.jpeg', 'Male', '2023-11-16 12:00:37', '2023-11-16 12:00:37', 'active', 'Unverified', '../uploads/received_309590591965504.jpeg', 2, 1, 'No curfew\r\nNo pets', '15.5338846', '120.5998973', 'bedspace'),
(32, 9, 'Owner Two Apartment ', 'Zone 7 ', 'Alvindia', 'Tarlac', 'Tarlac', 'Clean and Safe', 3000.00, 1500.00, '../uploads/received_325130023583056.jpeg', 'Both', '2023-11-16 12:02:48', '2023-11-16 12:02:48', 'active', 'Unverified', '../uploads/received_309590591965504.jpeg', 2, 2, 'No curfew\r\nNo pets', '15.5491653', '120.6063442', 'apartment'),
(33, 12, 'Owner Five Boarding House', 'Zone A', 'San Vicente', 'Tarlac City', 'Tarlac', 'Quiet, Clean and Safe', 2300.00, 1200.00, '../uploads/o5bh2.jpeg', 'Both', '2023-11-16 12:05:06', '2023-11-16 12:05:06', 'active', 'Unverified', '../uploads/received_276316062071288.jpeg', 3, 1, 'Bawal ang maingay at bisita sa loob ng kwarto', '15.4380456', '120.6113599', 'boarding_house'),
(34, 9, 'Owner Two Boarding ', 'Zone 6', 'Amucao', 'Tarlac City', 'Tarlac', 'Clean\r\nGood environment and neighborhood ', 3000.00, 1000.00, '../uploads/received_307826042145901.jpeg', 'Both', '2023-11-16 12:06:31', '2023-11-16 12:06:31', 'active', 'Unverified', '../uploads/received_309590591965504.jpeg', 6, 3, 'No curfew\r\nNo pets ', '15.4673615', '120.6846931', 'boarding_house'),
(35, 12, 'Owner Five Apartment', 'Zone 2', 'Trinidad', 'Tarlac City', 'Tarlac', 'Clean, Safe and Quiet', 1800.00, 1000.00, '../uploads/o5a1.jpeg', 'Both', '2023-11-16 12:07:43', '2023-11-16 12:07:43', 'active', 'Unverified', '../uploads/received_869808694459396.jpeg', 4, 1, 'Drinking and Smoking is not allowed', '15.5118225', '120.6329329', 'apartment'),
(36, 12, 'Owner Five Dorm', 'Orchid Street', 'San Vicente', 'Tarlac City', 'Tarlac', 'Safe and clean', 1300.00, 600.00, '../uploads/o5d2.jpeg', 'Male', '2023-11-16 12:11:07', '2023-11-16 12:11:07', 'active', 'Unverified', '../uploads/received_869808694459396.jpeg', 4, 1, 'Curfew hours, no drinking and smoking inside', '15.4728895', '120.5883446', 'dormitory'),
(37, 9, 'Owner Two Dormitory ', 'Zone 8', 'Armenia', 'Tarlac City', 'Tarlac', 'Clean and Quiet\r\nGood location ', 4000.00, 2000.00, '../uploads/received_217266084732999.jpeg', 'Male', '2023-11-16 12:14:08', '2023-11-16 12:14:08', 'active', 'Unverified', '../uploads/received_309590591965504.jpeg', 3, 1, 'No curfew\r\nNo visitors ', '15.4132164', '120.5305499', 'dormitory'),
(38, 10, 'Owner Three Bedspace ', 'Zone 11', 'Aguso', 'Tarlac City', 'Tarlac', 'Clean and Quiet\r\nGood environment ', 3000.00, 1500.00, '../uploads/received_1111172653132766.jpeg', 'Male', '2023-11-16 12:33:27', '2023-11-16 12:33:27', 'active', 'Unverified', '../uploads/received_309590591965504.jpeg', 3, 1, 'No pets\r\nNo visitors ', '15.53138', '120.598459', 'bedspace'),
(39, 10, 'Owner Three Apartment ', 'Zone 3', 'Alvindia', 'Tarlac', 'Tarlac', 'Clean and Happy\r\nGood environment ', 4000.00, 2000.00, '../uploads/received_1054886512218411.jpeg', 'Female', '2023-11-16 12:36:09', '2023-11-16 12:36:09', 'active', 'Unverified', '../uploads/received_309590591965504.jpeg', 2, 1, 'No visitors\r\nNo pets', '15.5491653', '120.6063442', 'apartment'),
(40, 10, 'Owner Three Boarding ', 'Zone 8', 'Amucao', 'Tarlac City', 'Tarlac', 'Clean and fresh\r\nGood environment\r\n', 5500.00, 2500.00, '../uploads/received_2817302268412826.jpeg', 'Both', '2023-11-16 12:38:16', '2023-11-16 12:38:16', 'active', 'Unverified', '../uploads/received_869808694459396.jpeg', 3, 4, 'No visitors\r\nNo pets', '15.4673615', '120.6846931', 'boarding_house'),
(41, 10, 'Owner Three Dormitory ', 'Zone 10', 'Armenia', 'Tarlac', 'Tarlac', 'Clean\r\nGood environment\r\n', 5000.00, 200.00, '../uploads/received_996431091459535.jpeg', 'Both', '2023-11-16 12:41:09', '2023-11-16 12:41:09', 'active', 'Unverified', '../uploads/received_276316062071288.jpeg', 3, 2, 'No pets \r\nNo visitors ', '15.4297907', '120.5451797', 'dormitory'),
(42, 12, 'Owner Five Bedspace', 'Zamora Street', 'San Roque', 'Tarlac City', 'Tarlac', 'Clean and safe', 1100.00, 500.00, '../uploads/o4b1.jpeg', 'Female', '2023-11-16 13:10:18', '2023-11-16 13:10:18', 'active', 'Unverified', '../uploads/received_869808694459396.jpeg', 4, 1, 'Drinking and smoking is not allowed inside', '15.4809409', '120.5955373', 'bedspace'),
(43, 11, 'Owner Four Boarding House', 'Rosal street, champaca street', 'San Vicente', 'Tarlac City', 'Tarlac', 'Clean and safe', 2000.00, 900.00, '../uploads/o4bh1.jpeg', 'Both', '2023-11-17 00:48:37', '2023-11-17 00:48:37', 'active', 'Unverified', '../uploads/received_869808694459396.jpeg', 4, 2, 'Curfew hours, drinking and smoking is not allowed', '15.4818654', '120.5872232', 'boarding_house'),
(44, 8, 'Owner One Boarding Two', 'Zone 1', 'Armenia', 'Tarlac ', 'Tarlac', 'Clean \r\nGood environment ', 4000.00, 1500.00, '../uploads/inbound3390740326539123584.jpg', 'Male', '2023-11-17 00:52:39', '2023-11-17 00:52:39', 'active', 'Unverified', '../uploads/inbound7665470187797716461.jpg', 2, 3, 'No pets \r\nNo visitors ', '15.4297907', '120.5451797', 'boarding_house'),
(45, 11, 'Owner Four Apartment', 'Ramos street', 'San Vicente', 'Tarlac City', 'Tarlac', 'Safe and quiet', 1900.00, 900.00, '../uploads/o4a1.jpeg', 'Male', '2023-11-17 00:55:14', '2023-11-17 00:55:15', 'active', 'Unverified', '../uploads/received_869808694459396.jpeg', 4, 2, 'No pets and has curfew hours', '15.4832968', '120.5859803', 'apartment'),
(46, 8, 'dsa', 'dsa', 'Baras-baras', '23', 'Tarlac', 'dsa', 123.00, 23.00, '../uploads/1 (19).png', 'Male', '2023-11-24 01:11:35', '2023-11-24 01:11:35', 'active', 'Unverified', '../uploads/qrcode.jpg', 12, 12, 'Observe Silence, Visitor Not Allowed, Maintain Cleanliness', '', '', 'boarding_house');

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
(12, 11, 8, '2023-11-16 20:27:25', 'Hello', 'tenant'),
(13, 11, 11, '2023-11-16 20:27:50', 'hi', 'owner'),
(14, 11, 11, '2023-11-16 20:29:09', 'what are your concerns?', 'owner'),
(16, 11, 11, '2023-11-16 20:40:03', 'Is there available?', 'tenant'),
(19, 8, 8, '2023-11-17 06:25:11', 'hi', 'owner'),
(20, 8, 8, '2023-11-17 06:25:59', 'hello', 'tenant'),
(21, 9, 8, '2023-11-17 06:27:25', 'Hello', 'tenant'),
(22, 5, 8, '2023-11-17 06:31:48', 'hi', 'tenant'),
(23, 8, 8, '2023-11-17 06:44:27', 'test', 'owner'),
(24, 8, 8, '2023-11-17 06:44:50', 'test', 'tenant'),
(25, 8, 8, '2023-11-17 06:45:31', 'test1', 'owner'),
(26, 8, 8, '2023-11-17 06:45:51', 'test2', 'tenant'),
(27, 8, 8, '2023-11-17 06:48:31', 'test', 'tenant'),
(28, 8, 11, '2023-11-17 06:48:46', 'test', 'tenant');

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
  `contactNumber` varchar(255) NOT NULL,
  `id_picture` varchar(255) NOT NULL,
  `profile_pic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`owner_id`, `user_id`, `name`, `birthdate`, `gender`, `contactNumber`, `id_picture`, `profile_pic`) VALUES
(8, 23, 'Owner One', '1989-09-12', 'Male', '09097856473', 'ID.jpg', '2.jpg'),
(9, 24, 'Owner Two', '1995-07-03', 'Female', '09675435768', 'ID.jpg', '1.jpg'),
(10, 25, 'Owner Three', '2001-06-26', 'Female', '09780946547', 'ID.jpg', '3.jpg'),
(11, 26, 'Owner Four', '1978-04-17', 'Male', '09456723458', 'ID.jpg', '5.jpg'),
(12, 27, 'Owner Five', '1984-07-03', 'Female', '09046734542', 'ID.jpg', '4.jpg'),
(13, 102, 'Owner One', '2001-11-12', 'Male', '090978901', '100353496.jpg', '100353496.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `application_id` int(11) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL DEFAULT 'paid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `application_id`, `payment_date`, `payment_method`, `payment_status`) VALUES
(31, 32, '2023-11-24', '', 'paid'),
(32, 34, '2023-11-28', '', 'paid'),
(33, 34, '2023-11-28', '', 'paid'),
(34, 34, '2023-11-28', '', 'paid');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int(11) NOT NULL,
  `rating` varchar(255) DEFAULT NULL,
  `feedback` text DEFAULT NULL,
  `tenant_id` int(11) NOT NULL,
  `listing_id` int(11) NOT NULL,
  `Amenities` int(11) NOT NULL,
  `Price` int(11) NOT NULL,
  `Location` int(11) NOT NULL,
  `Clealiness` int(11) NOT NULL,
  `Safety` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`review_id`, `rating`, `feedback`, `tenant_id`, `listing_id`, `Amenities`, `Price`, `Location`, `Clealiness`, `Safety`) VALUES
(10, '4', 'ste', 2, 22, 4, 4, 4, 4, 4);

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
  `contactNumber` varchar(255) NOT NULL,
  `profile_pic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tenant`
--

INSERT INTO `tenant` (`tenant_id`, `user_id`, `name`, `birthdate`, `gender`, `contactNumber`, `profile_pic`) VALUES
(1, 11, 'Renter Seven', '2002-07-11', 'Female', '09112345678', 'r1.webp'),
(2, 22, 'Renter Two', '2002-08-07', 'Male', '09826247731', 'r1.jpg'),
(3, 33, 'Renter Three', '2002-05-03', 'Male', '09223456789', 'r1.webp'),
(4, 44, 'Renter Ten', '2002-01-20', 'Female', '09901234567', 'r1.jpg'),
(5, 55, 'Renter Nine', '2002-06-05', 'Female', '09890123456', 'r1.jpg'),
(7, 77, 'Renter Eight', '2002-07-03', 'Female', '09789012345', 'r1.webp'),
(8, 88, 'Renter Six', '2002-07-16', 'Female', '09678901234', 'r1.jpg'),
(9, 99, 'Renter Five', '2002-07-08', 'Male', '09567890123', 'r1.jpg'),
(10, 100, 'Renter Four', '2002-09-17', 'Male', '09456789012', 'r1.webp'),
(11, 28, 'Renter One', '2002-09-09', 'Male', '09784538765', 'r1.webp');

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
(11, 11, 22),
(12, 11, 23),
(13, 2, 22);

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
  MODIFY `amenities_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `application`
--
ALTER TABLE `application`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `credentials`
--
ALTER TABLE `credentials`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `cus_ref`
--
ALTER TABLE `cus_ref`
  MODIFY `ref_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `listing`
--
ALTER TABLE `listing`
  MODIFY `listing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `owner`
--
ALTER TABLE `owner`
  MODIFY `owner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tenant`
--
ALTER TABLE `tenant`
  MODIFY `tenant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `togo`
--
ALTER TABLE `togo`
  MODIFY `togo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
