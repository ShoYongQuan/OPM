-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2022 at 06:26 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `opm`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `bookingID` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `price` float(6,2) DEFAULT NULL,
  `userID` int(11) NOT NULL,
  `massageID` int(11) NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `massage`
--

CREATE TABLE `massage` (
  `massageID` int(11) NOT NULL,
  `massageName` varchar(25) NOT NULL,
  `massageDescr` varchar(255) NOT NULL,
  `massagePrice` float(6,2) NOT NULL,
  `imgdir` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `massage`
--

INSERT INTO `massage` (`massageID`, `massageName`, `massageDescr`, `massagePrice`, `imgdir`) VALUES
(1001, 'Hot Stone Massage', 'Best for muscle pain and tension or relaxation.				', 99.00, '../massages/3fa24c6b599da510654d3312c32e586c.jpg'),
(1002, 'Aromatherapy Massage', 'Help boost your mood, reduce stress, and relieve muscle tension		', 109.00, '../massages/1ba8b8313afe3a59bbda2653c04eea1d.jpg'),
(1003, 'Deep Tissue Massage', 'Help relieve tight muscles, chronic muscle pain, and anxiety		', 125.00, '../massages/f14a65ae1bf4ff5fd4ef4fde23f3586d.jpg'),
(1004, 'Swedish Massage', 'Gentle full-body massage, ideal for people who are new to massage		', 78.00, '../massages/b23acba15b15fdcff619be8a917900cc.jpg'),
(1005, 'Shiatsu Massage', 'Japanese massage that promotes emotional and physical relaxation		', 156.00, '../massages/283e109c19ebc6a8515650f5a0a8e1b5.jpg'),
(1006, 'Thai Massage', 'Help improve flexibility, circulation, and energy levels		', 115.00, '../massages/a0933c1bc3a976f9c62e5e79e9e1dd7e.jpg'),
(1007, 'Reflexology Massage', 'Best for people who are looking to restore their natural energy levels		', 85.00, '../massages/15f316239e6aa644cc3bb906911a144b.jpg'),
(1008, 'Prenatal Massage', 'Reduce pregnancy body aches, reduce stress, and ease muscle tension		', 166.00, '../massages/cdda101209c22e18f4e199ad81cf374a.jpg'),
(1009, 'Sports Massage', 'Good option to help prevent sports injuries		', 120.00, '../massages/2f6bac06567dd43f2d49dc355c7ad78e.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `timeslot`
--

CREATE TABLE `timeslot` (
  `startTime` time NOT NULL,
  `endTime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `timeslot`
--

INSERT INTO `timeslot` (`startTime`, `endTime`) VALUES
('08:30:00', '09:30:00'),
('10:00:00', '11:00:00'),
('11:30:00', '12:30:00'),
('13:00:00', '14:00:00'),
('14:30:00', '15:30:00'),
('16:00:00', '17:00:00'),
('17:30:00', '18:30:00'),
('19:00:00', '20:00:00'),
('22:30:00', '23:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(11) NOT NULL,
  `name` varchar(35) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `dob` date NOT NULL,
  `phoneNo` varchar(10) NOT NULL,
  `email` varchar(35) NOT NULL,
  `password` varchar(255) NOT NULL,
  `code` int(6) NOT NULL,
  `role` varchar(8) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `name`, `gender`, `dob`, `phoneNo`, `email`, `password`, `code`, `role`, `image`) VALUES
(1, 'admin', 'male', '2022-08-19', '0123456789', 'admin@email.com', '$2y$10$i5P9PbwggtQ5zF5fKB8vS.5JdJ9LID8vZRG82zB9FC6jZenWrhR4G', 0, 'Admin', 'None');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`bookingID`),
  ADD KEY `customerID` (`userID`),
  ADD KEY `massageID` (`massageID`),
  ADD KEY `startTime` (`startTime`,`endTime`);

--
-- Indexes for table `massage`
--
ALTER TABLE `massage`
  ADD PRIMARY KEY (`massageID`);

--
-- Indexes for table `timeslot`
--
ALTER TABLE `timeslot`
  ADD PRIMARY KEY (`startTime`,`endTime`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `bookingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `massage`
--
ALTER TABLE `massage`
  MODIFY `massageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1014;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`massageID`) REFERENCES `massage` (`massageID`),
  ADD CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`startTime`,`endTime`) REFERENCES `timeslot` (`startTime`, `endTime`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
