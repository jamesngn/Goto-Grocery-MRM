-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2022 at 06:07 AM
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
-- Database: `epiz_32522623_gotogromrmdb`
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
(236, 'Phone'),
(238, 'Audio'),
(240, 'Tablet'),
(241, 'Power Drink'),
(242, 'Laptop');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_ID` int(10) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(2, 'Quang', 'Nguyen', 'test@gmail.com', '123456789', '2022-09-10 00:14:57');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `qty_stock` int(50) DEFAULT 0,
  `retailPrice` float DEFAULT 0,
  `category_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `image`, `name`, `description`, `qty_stock`, `retailPrice`, `category_ID`) VALUES
(100000, '../image/product/100000.jpg', 'Quang Nguyen', '', 0, 1500, 242),
(100001, '../image/product/100001.jpg', 'Quang Nguyen', 'A gaming and powerful laptop', 0, 1300, 242),
(100002, '../image/product/100002.jpg', 'iPhone 14 Pro Max', 'An wonderful smartphone', 0, 1300, 236),
(100003, '../image/product/100003.jpg', 'MacBook', '', 0, 329999, 242);

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `saleID` int(11) NOT NULL,
  `memberID` int(11) NOT NULL,
  `purchaseTime` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`saleID`, `memberID`, `purchaseTime`) VALUES
(2, 2, '2022-09-10'),
(3, 2, '2022-09-10'),
(4, 2, '2022-09-10'),
(5, 1, '2022-09-10'),
(6, 1, '2022-09-10'),
(7, 1, '2022-09-10');

-- --------------------------------------------------------

--
-- Table structure for table `saleitem`
--

CREATE TABLE `saleitem` (
  `saleID` int(11) NOT NULL,
  `lineNo` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `saleitem`
--

INSERT INTO `saleitem` (`saleID`, `lineNo`, `productID`, `quantity`) VALUES
(2, 1, 4, 1),
(3, 1, 6, 40),
(4, 1, 13, 12),
(5, 1, 4, 1),
(6, 1, 6, 5),
(7, 1, 4, 1),
(2, 2, 5, 1),
(5, 2, 6, 2),
(7, 2, 7, 2),
(2, 3, 6, 2),
(5, 3, 7, 1),
(7, 3, 11, 19),
(2, 4, 7, 3),
(5, 4, 11, 1),
(7, 4, 13, 8),
(2, 5, 10, 5),
(5, 5, 13, 2),
(2, 6, 11, 7),
(2, 7, 13, 28);

-- --------------------------------------------------------

--
-- Table structure for table `suppdelivery`
--

CREATE TABLE `suppdelivery` (
  `supplydeliveryid` int(11) NOT NULL,
  `prod_id` int(10) NOT NULL,
  `supp_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `delivery_date` date NOT NULL,
  `supplier_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(123, 'Sam'),
(100000, 'Apple Inc');

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
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`saleID`);

--
-- Indexes for table `saleitem`
--
ALTER TABLE `saleitem`
  ADD PRIMARY KEY (`lineNo`,`saleID`);

--
-- Indexes for table `suppdelivery`
--
ALTER TABLE `suppdelivery`
  ADD PRIMARY KEY (`supplydeliveryid`);

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
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=243;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `customer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `saleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `suppdelivery`
--
ALTER TABLE `suppdelivery`
  MODIFY `supplydeliveryid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlistid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2315;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
