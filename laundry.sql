-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2023 at 10:07 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laundry`
--

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `laundry_type` varchar(20) DEFAULT NULL,
  `item_mass` int(3) DEFAULT NULL,
  `item_quantity` int(3) DEFAULT NULL,
  `pickup_time` date DEFAULT NULL,
  `delivery_time` date DEFAULT NULL,
  `address` varchar(80) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `total_price` float(10,6) DEFAULT NULL,
  `garis_bujur` float(10,6) DEFAULT NULL,
  `price_total` int(10) DEFAULT NULL,
  `order_status` varchar(50) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `unit_list` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `laundry_type`, `item_mass`, `item_quantity`, `pickup_time`, `delivery_time`, `address`, `note`, `total_price`, `garis_bujur`, `price_total`, `order_status`, `user_id`, `unit_list`) VALUES
(11, 'Wash&Fold', 5, NULL, '2023-11-16', '2023-11-30', 'Chittethu(H), Kollapally,palai,Kottayam', 'Separate whites and colors, wash separately', NULL, NULL, 600, 'Laundry Received', 4, '');

-- --------------------------------------------------------

--
-- Table structure for table `price`
--

CREATE TABLE `price` (
  `id` int(11) NOT NULL,
  `item_name` varchar(30) DEFAULT NULL,
  `price` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `price`
--

INSERT INTO `price` (`id`, `item_name`, `price`) VALUES
(1, 'Dry_clean', 'Rs.160'),
(2, 'Steam_iron', 'Rs.160'),
(3, 'Wash & fold', 'Rs.120'),
(4, 'Wash & Iron', 'Rs.100');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone_no` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone_no`) VALUES
(1, 'Administrator', 'admin@laundryonlinemks.com', '$2y$10$3ZovOOjFDvk4eain7/XFFuAfVLt9.zOyFM/FK8NC/2KHmA0Zk5O6W', '081242133333'),
(2, 'sara Jestine', 'sarajestine@gmail.com', '$2y$10$w7zNLFx1k4m5cTl8po4NPuyE7s0627HFQmHzEzvZWhWe2.IXVHCnO', '9447149489'),
(3, 'Anto Xavier Mathew', 'anto@gmail.com', '$2y$10$acZUA5b7AAWy61gE3UHijOX8icOQ/x..OffE7iT5.MMZu3k45PcYC', '98671236909'),
(4, 'Riya Roy', 'riyaroy@gmail.com', '$2y$10$T/jRHldB74f78vw/geUegOOVauujSQ1n4ZgfpaD5.NK1S9OeJU6bm', '9496249214'),
(5, 'Alysha Jaleel', 'alyshajaleel@gmail.com', '$2y$10$1iny4Kwq1dKni6ncxiYAtObCWrpn57WRJpSDXOIhHIK99hu25yf3W', '9895415410');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `price`
--
ALTER TABLE `price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
