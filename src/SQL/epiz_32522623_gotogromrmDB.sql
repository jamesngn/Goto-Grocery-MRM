-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql213.epizy.com
-- Generation Time: Sep 20, 2022 at 07:55 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epiz_32522623_gotogromrmDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `memberID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `quantity` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`memberID`, `productID`, `quantity`) VALUES
(1, 4, 1),
(1, 5, 1),
(1, 6, 2),
(1, 7, 2),
(1, 10, 3);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CategoryID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CategoryID`, `Name`) VALUES
(123, 'samuel'),
(235, '234');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_ID` int(10) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `job_role` varchar(50) NOT NULL,
  `salary` int(10) NOT NULL,
  `hire_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `customer_id` int(10) NOT NULL,
  `customer_firstname` varchar(50) NOT NULL,
  `customer_lastname` varchar(50) NOT NULL,
  `customer_email` varchar(50) NOT NULL,
  `customer_password` varchar(50) NOT NULL,
  `CREATED_AT` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`customer_id`, `customer_firstname`, `customer_lastname`, `customer_email`, `customer_password`, `CREATED_AT`) VALUES
(1, 'KEK', 'TROLL', '1234@twitch.tv', '12234', '2022-09-09 06:13:02'),
(2, 'a', 'bb', 'ccc@gmail.com', 'Bob', '2022-09-18 19:43:03'),
(4, 'vvvv', 'vvvv', 'wsdsa@ggfds', 'ssadsa', '2022-09-18 20:00:13'),
(7, 'SADA', 'SADSADSA', '2W23E!@EDFSDF', 'SDADSADS', '2022-09-18 20:13:04'),
(8, 'SADSAD', 'SADSAD', 'WE2134E@DFVDFD', 'DSADASD', '2022-09-18 20:13:34'),
(9, 'SADSAD', 'SADSAD', 'WE2134Ew@DFVDFD', 'DSADASD', '2022-09-18 20:14:46'),
(10, 'SADSAD', 'SADSAD', 'WE2134Esw@DFVDFD', 'DSADASD', '2022-09-18 20:14:59'),
(11, 'sda', 'sadsadsa', 'e3r321@fedesdf', 'dasdsad', '2022-09-18 20:16:05'),
(12, 'sdadsd', 'sadsad', 'sdsad@DSASdsa', 'sadsa', '2022-09-18 20:31:28'),
(13, 'sdas', 'sadsadsa', 'dsadasdsd@SAda', 'sada', '2022-09-18 20:45:19'),
(14, 'sadsa', 'sadas', 'sadsa@sdasd', 'sadasdasdsadsa', '2022-09-18 22:48:26'),
(15, 'sadsa', 'sadas', 'sadsssa@sdasd', 'sadasdasdsadsa', '2022-09-18 22:49:46');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `qty_stock` int(50) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `category_ID` int(11) DEFAULT NULL,
  `supplier_ID` int(11) DEFAULT NULL,
  `date_stock_in` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `qty_stock`, `price`, `category_ID`, `supplier_ID`, `date_stock_in`) VALUES
(4, 'Iphone 13 Pro Max', 'An wonderful smartphone', 1, 2000, 1, 1, '05-09-2022'),
(5, 'Logitech MX Anywhere 3', 'A good mouse for office use', 1, 99, 1, 2, '05-09-2022'),
(6, 'Coca Cola', 'An  energy drink with 100x power', 100, 1.5, 10, 5, '05-09-2022'),
(7, 'Laptop', 'A powerful ipad, good for study and entertainment', 10, 1300, 5, 10, '05-09-2022'),
(8, 'Teddy Bear', 'Mr Bean\'s bear', 0, 100000, 536, 234, '22-10-2011'),
(10, 'Samsung Galaxy Tab A8 WiFi 64GB Grey', 'The Samsung Galaxy Tab A8 aims to enhance your everyday with it\'s impressive portability and multi-tasking abilities. Enjoy more of your media thanks to the 10.5&quot;, ultra-slim bezel display and quad-speakers with Dolby Atmos. Beyond looks, this tablet', 25, 377, 10, 2, '09-09-2022');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `purchaseID` int(11) NOT NULL,
  `memberID` int(11) NOT NULL,
  `purchaseTime` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`purchaseID`, `memberID`, `purchaseTime`) VALUES
(18, 5, '2022-09-08 05:25:20'),
(20, 0, '2022-09-08 05:37:08'),
(21, 1, '2022-09-08 05:37:14'),
(22, 0, '2022-09-08 05:38:09'),
(23, 0, '2022-09-08 05:39:50'),
(24, 5, '2022-09-08 05:40:05'),
(25, 0, '2022-09-08 06:08:08'),
(26, 0, '2022-09-08 06:12:59'),
(27, 0, '2022-09-08 06:17:53'),
(28, 0, '2022-09-08 06:18:19'),
(29, 0, '2022-09-08 07:19:42'),
(30, 0, '2022-09-08 23:00:19'),
(31, 1, '2022-09-09 12:23:20');

-- --------------------------------------------------------

--
-- Table structure for table `purchaseItem`
--

CREATE TABLE `purchaseItem` (
  `purchaseID` int(11) NOT NULL,
  `lineNo` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchaseItem`
--

INSERT INTO `purchaseItem` (`purchaseID`, `lineNo`, `productID`, `quantity`) VALUES
(18, 1, 4, 1),
(19, 1, 6, 10),
(21, 1, 4, 2),
(24, 1, 4, 1),
(31, 1, 4, 1),
(18, 2, 5, 1),
(24, 2, 5, 19),
(18, 3, 6, 6),
(24, 3, 8, 1),
(18, 4, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(10) NOT NULL,
  `supplier_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier_name`) VALUES
(321, 'Jim'),
(123, 'Sam');

-- --------------------------------------------------------

--
-- Table structure for table `supplydelivery`
--

CREATE TABLE `supplydelivery` (
  `prod_id` int(10) NOT NULL,
  `supp_id` varchar(10) NOT NULL,
  `quantity` float NOT NULL,
  `delivery_date` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `wishlistid` int(11) NOT NULL,
  `cust_id` int(10) DEFAULT NULL,
  `prod_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`wishlistid`, `cust_id`, `prod_id`) VALUES
(213, 2134, 1255),
(2314, 12, 415);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`memberID`,`productID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_ID`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `UNIQUE_EMAIL` (`customer_email`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purchaseID`);

--
-- Indexes for table `purchaseItem`
--
ALTER TABLE `purchaseItem`
  ADD PRIMARY KEY (`lineNo`,`purchaseID`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wishlistid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=236;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `customer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchaseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlistid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2315;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
