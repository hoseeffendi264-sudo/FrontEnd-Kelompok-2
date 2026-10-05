-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2026 at 03:19 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kopinusantara`
--

-- --------------------------------------------------------

--
-- Table structure for table `customerlist`
--

CREATE TABLE `customerlist` (
  `customerID` varchar(6) NOT NULL,
  `gmail` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customerlist`
--

INSERT INTO `customerlist` (`customerID`, `gmail`, `password`) VALUES
('CR0001', 'JohnDoe@gmail.com', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `drinklist`
--

CREATE TABLE `drinklist` (
  `drinkID` varchar(6) NOT NULL,
  `drinkName` varchar(20) NOT NULL,
  `drinkIMG` varchar(200) NOT NULL,
  `drinkDesc` varchar(200) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drinklist`
--

INSERT INTO `drinklist` (`drinkID`, `drinkName`, `drinkIMG`, `drinkDesc`, `price`) VALUES
('DR0001', 'Air Mineral', 'drink\\air-mineral.jpg', 'Minuman air mineral \"Le Minerale\"', 4000),
('DR0002', 'Teh Manis', 'drink\\teh-manis.jpg', 'Minuman teh yang diseduh mengunakan daun natural yang ditambahkan gula natural', 5000),
('DR0003', 'Lemonade', 'drink\\lemonade.jpg', 'Minuman yang diperas dari lemon yang segar', 6000),
('DR0004', 'YUM-Soda', 'drink\\yum-cola.jpg', 'Minuman ringan soda dicampur dengan buah oren dan grapefruit yang segar', 8000),
('DR0005', 'Kopi Nusantara', 'drink\\kopi-nusantara.jpg', 'Minuman kopi yang dibuat dengan kolaborasi dengan Kopi Nusantara.', 7000);

-- --------------------------------------------------------

--
-- Table structure for table `foodlist`
--

CREATE TABLE `foodlist` (
  `foodID` varchar(6) NOT NULL,
  `foodName` varchar(20) NOT NULL,
  `foodIMG` varchar(200) NOT NULL,
  `foodDesc` varchar(200) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `foodlist`
--

INSERT INTO `foodlist` (`foodID`, `foodName`, `foodIMG`, `foodDesc`, `price`) VALUES
('FD0001', 'Ketoprak Nusantara', 'food\\ketoprak-nusantara.jpg', 'Ketoprak special dibuat dari bahan-bahan premium, resep original dari toko kami', 23000),
('FD0002', 'Ketoprak Original', 'food\\ketoprak-original.jpg', 'Ketoprak klasik dengan lontong, bihun, tahu, tauge, dan kerupuk, disiram bumbu kacang kental yang gurih', 18000),
('FD0003', 'Ketoprak Jumbo', 'food\\ketoprak-jumbo.jpg', 'Porsi super besar untuk kamu yang lapar! Double lontong, double tahu, telur, bakso, dan siraman bumbu kacang berlimpah', 23000),
('FD0004', 'Ketoprak Telur', 'food\\ketoprak-telur.jpg', 'Ketoprak spesial dengan telur dadar, irisan timun segar, dan bawang goreng di atas piring ayam jago legendaris', 18000),
('FD0005', 'Ketoprak Komplit', 'food\\ketoprak-komplit.jpg', 'Porsi lebih besar dengan tambahan tahu goreng, tauge melimpah, dan taburan bawang goreng renyah', 20000);

-- --------------------------------------------------------

--
-- Table structure for table `tempcheckout`
--

CREATE TABLE `tempcheckout` (
  `itemID` varchar(6) NOT NULL,
  `itemName` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactionlist`
--

CREATE TABLE `transactionlist` (
  `customerID` varchar(6) NOT NULL,
  `date` date NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customerlist`
--
ALTER TABLE `customerlist`
  ADD PRIMARY KEY (`customerID`);

--
-- Indexes for table `drinklist`
--
ALTER TABLE `drinklist`
  ADD PRIMARY KEY (`drinkID`);

--
-- Indexes for table `foodlist`
--
ALTER TABLE `foodlist`
  ADD PRIMARY KEY (`foodID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
