-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql213.epizy.com
-- Generation Time: Sep 06, 2022 at 08:46 PM
-- Server version: 10.3.27-MariaDB
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
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CategoryID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `customer_id` int(10) NOT NULL,
  `customer_firstname` varchar(50) NOT NULL,
  `customer_lastname` varchar(50) NOT NULL,
  `customer_email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`customer_id`, `customer_firstname`, `customer_lastname`, `customer_email`) VALUES
(1, 'John', 'Nguyen', 'Bob@gmail.com'),
(2, '1', '2', '3'),
(3, '1', '2', '3'),
(5, '1111', '1111', '11111'),
(29, 'QUANG', 'NGUYEN', 'testtt@gmail.com'),
(30, 'a', 'b', 'c'),
(31, 'Bob', 'Tack', '212412@gmail.com'),
(32, 'testfname', 'testlname', 'testmail@gmail.com');

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `qty_stock`, `price`, `category_ID`, `supplier_ID`, `date_stock_in`) VALUES
(8, 's', 's', 0, 100, 0, 0, '22-10-2011'),
(7, 'Laptop', 'A powerful ipad, good for study and entertainment', 10, 1300, 5, 10, '05-09-2022'),
(4, 'Iphone 13 Pro Max', 'An wonderful smartphone', 5, 2000, 1, 1, '05-09-2022'),
(5, 'Logitech MX Anywhere 3', 'A good mouse for office use', 20, 99, 1, 2, '05-09-2022'),
(6, 'Coca Cola', 'An  energy drink with 100x power', 100, 1.5, 10, 5, '05-09-2022');

-- --------------------------------------------------------
-- table for employee
CREATE TABLE `employee` (
  `employee_ID` int(10) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  'job_role' varchar(50) NOT NULL,
  'salary'int(10) NOT NULL,
  'hire_date' date NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
--
-- dumping data for table 'employee'
INSERT INTO `employee` (`employee_ID`, `fname`, `lname`, `dob`, `job_role`, `salary`, `hire_date`) 
VALUES (1, 'Tawsif', 'Karim', '25/02/2000', 'Accounts officer', '$60,000', '21/01/2021'),
(3, 'Sajid', 'Muntasir', '26/01/2001', 'HR manager', '$65,000', '01/03/2021'),
(4, 'Quang', 'Nguyen', '12/05/2001', 'CEO', '$80,000', '01/09/2020'),
(2, 'Ricky', 'ponting', '05/06/2002', 'Admin Officer', '$65,000', '20/03/2021');


-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(10) NOT NULL,
  `supplier_name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`customer_id`);

--index for table 'employee'--

ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_ID`);

-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `customer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--AUTO_INCREMENT for table `employee`--
ALTER TABLE `employee`
  MODIFY `employee_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
