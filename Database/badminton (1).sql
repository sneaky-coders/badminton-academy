-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 03, 2023 at 05:01 PM
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
-- Database: `badminton`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(100) NOT NULL,
  `court_id` int(100) NOT NULL,
  `transactionid` varchar(100) NOT NULL,
  `orderid` varchar(300) NOT NULL,
  `amount` varchar(200) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `court_id`, `transactionid`, `orderid`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'pay_N7OchIc8FP3A2d', 'order_N7OcQpHkVWwO2s', '205', 'paid', '2023-12-02 07:34:33', '2023-12-02 07:34:57'),
(2, 8, 'pay_N7UMYd64BUXTC7', 'order_N7UMG6uZ4Dz170', '205', 'paid', '2023-12-02 13:11:24', '2023-12-02 13:11:49'),
(3, 9, 'transaction_656b30ab0c363', 'order_N7UcrSJNgGQw8Q', '205', 'pending', '2023-12-02 13:27:07', NULL),
(4, 10, 'pay_N7VM1WUepr3lak', 'order_N7VLjdK5xstEIA', '204.72', 'paid', '2023-12-02 14:09:36', '2023-12-02 14:10:01');

-- --------------------------------------------------------

--
-- Table structure for table `court`
--

CREATE TABLE `court` (
  `id` int(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `courtname` varchar(100) NOT NULL,
  `courtnumber` int(20) NOT NULL,
  `location` varchar(100) NOT NULL,
  `date` varchar(100) DEFAULT NULL,
  `starttime` varchar(100) DEFAULT NULL,
  `endtime` varchar(100) DEFAULT NULL,
  `adults` int(50) NOT NULL DEFAULT 0,
  `children` int(50) NOT NULL DEFAULT 0,
  `young_children` int(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `court`
--

INSERT INTO `court` (`id`, `name`, `email`, `contact`, `address`, `courtname`, `courtnumber`, `location`, `date`, `starttime`, `endtime`, `adults`, `children`, `young_children`, `created_at`, `updated_at`) VALUES
(1, 'Alzaahid Nadaf', 'alzaahid@gmail.com', '09096245373', 'Plot 10A 5th cross veerbhadra nagar', '', 0, '', '2023-12-02', '13:04 PM', '14:04 PM', 1, 1, 1, '2023-12-02 07:34:19', '2023-12-02 07:34:29'),
(2, NULL, NULL, NULL, NULL, '', 0, '', '2023-12-02', '14:15 PM', '15:15 PM', 0, 0, 0, '2023-12-02 08:45:29', '0000-00-00 00:00:00'),
(3, NULL, NULL, NULL, NULL, '', 0, '', '2023-12-02', '14:34 PM', '15:35 PM', 2, 1, 1, '2023-12-02 09:10:07', '0000-00-00 00:00:00'),
(4, NULL, NULL, NULL, NULL, '', 0, '', '2023-12-02', '14:44 PM', '15:44 PM', 2, 1, 1, '2023-12-02 09:14:40', '0000-00-00 00:00:00'),
(5, NULL, NULL, NULL, NULL, '', 0, '', '2023-12-02', '14:00 PM', '15:00 PM', 1, 1, 1, '2023-12-02 09:24:28', '0000-00-00 00:00:00'),
(6, NULL, NULL, NULL, NULL, '', 0, '', '2023-12-02', '14:56 PM', '15:56 PM', 1, 1, 1, '2023-12-02 09:26:12', '0000-00-00 00:00:00'),
(7, NULL, NULL, NULL, NULL, '', 0, '', '2023-12-02', '14:56 PM', '15:56 PM', 1, 1, 1, '2023-12-02 09:27:02', '0000-00-00 00:00:00'),
(8, 'Alzaahid Nadaf', 'alzaahid@gmail.com', '6361922574', 'Plot 10A 5th cross veerbhadra nagar', '', 0, '', '2023-12-02', '15:04 PM', '18:40 PM', 2, 0, 0, '2023-12-02 13:10:52', '2023-12-02 13:11:19'),
(9, 'Alzaahid Nadaf', 'alzaahid@gmail.com', '6361922574', 'Plot 10A 5th cross veerbhadra nagar', '', 0, '', '2023-12-02', '18:54 PM', '18:54 PM', 2, 1, 1, '2023-12-02 13:24:12', '2023-12-02 13:26:09'),
(10, 'Alzaahid Nadaf', 'alzaahid@gmail.com', '6361922574', 'Plot 10A 5th cross veerbhadra nagar', '', 0, '', '2023-12-02', '19:38 PM', '20:38 PM', 2, 0, 0, '2023-12-02 14:08:40', '2023-12-02 14:09:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `level` int(100) NOT NULL DEFAULT 2,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `level`, `created_at`, `updated_at`) VALUES
(1, 'Alzaahid', 'zaahid97', 'alzaahid@gmail.com', 1, '2023-11-28 19:17:39', '2023-11-28 19:17:51'),
(2, 'Admin', 'admin@123', 'admin@example.com', 0, '2023-11-29 20:31:20', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rtg` (`court_id`);

--
-- Indexes for table `court`
--
ALTER TABLE `court`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `username` (`username`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `court`
--
ALTER TABLE `court`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `cd` FOREIGN KEY (`court_id`) REFERENCES `court` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
