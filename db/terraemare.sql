-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2018 at 05:56 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `terraemare`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryID` int(11) NOT NULL,
  `categoryName` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryID`, `categoryName`) VALUES
(1, 'pizza'),
(2, 'salad');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `optionID` int(11) NOT NULL,
  `optionName` varchar(20) NOT NULL,
  `categoryID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`optionID`, `optionName`, `categoryID`) VALUES
(1, 'diameter', 1),
(2, 'souce', 2);

-- --------------------------------------------------------

--
-- Table structure for table `optionvalue`
--

CREATE TABLE `optionvalue` (
  `optionvalueID` int(11) NOT NULL,
  `optionID` int(11) NOT NULL,
  `optionvalueName` varchar(50) NOT NULL,
  `supplementary` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `optionvalue`
--

INSERT INTO `optionvalue` (`optionvalueID`, `optionID`, `optionvalueName`, `supplementary`) VALUES
(1, 1, '20 cm', '0.00'),
(2, 1, '30 cm', '5.00'),
(3, 1, '40 cm', '10.00'),
(4, 2, 'with french souce', '0.00'),
(5, 2, 'with italian souce', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` decimal(5,2) NOT NULL,
  `description` varchar(100) NOT NULL,
  `categoryID` int(11) NOT NULL,
  `imgUrl` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `description`, `categoryID`, `imgUrl`) VALUES
(1, 'Pizza Margherita', '12.00', 'with tomatensauce, mozzarella and oregano', 1, 'assets/img/pizza1.jpg'),
(2, 'Pizza Funghi', '14.00', 'with tomatensauce, mozzarella, mushrooms and oregano', 1, 'assets/img/pizza2.jpg'),
(3, 'Pizza Prosciutto', '16.00', 'with tomatensauce, mozzarella, ham and oregano', 1, 'assets/img/pizza3.jpg'),
(4, 'Greek salad', '9.00', 'with feta, olives, cucumbers and tomatoes', 2, 'assets/img/salad1.jpg'),
(5, 'Caprese salad', '8.00', 'with mzzarella, basil and fresh tomatoes', 2, 'assets/img/salad2.jpg'),
(6, 'Pizza Vegetaria ', '16.00', 'with tomato sauce, mozzarella, artichokes, onion, pepperoni, spinach and garlic', 1, 'assets/img/pizza4.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`optionID`),
  ADD KEY `categoryID` (`categoryID`);

--
-- Indexes for table `optionvalue`
--
ALTER TABLE `optionvalue`
  ADD PRIMARY KEY (`optionvalueID`),
  ADD KEY `optionID` (`optionID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoryID` (`categoryID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `optionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `optionvalue`
--
ALTER TABLE `optionvalue`
  MODIFY `optionvalueID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `options`
--
ALTER TABLE `options`
  ADD CONSTRAINT `options_ibfk_1` FOREIGN KEY (`categoryID`) REFERENCES `category` (`categoryID`);

--
-- Constraints for table `optionvalue`
--
ALTER TABLE `optionvalue`
  ADD CONSTRAINT `optionvalue_ibfk_1` FOREIGN KEY (`optionID`) REFERENCES `options` (`optionID`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`categoryID`) REFERENCES `category` (`categoryID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
