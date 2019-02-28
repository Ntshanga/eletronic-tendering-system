-- phpMyAdmin SQL Dump
-- version 4.6.4deb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 14, 2017 at 12:16 PM
-- Server version: 5.7.18-0ubuntu0.16.10.1
-- PHP Version: 7.0.18-0ubuntu0.16.10.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_tendering`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `username`, `password`) VALUES
(1, 'chirchir', '$2y$10$vMv889lQybmuofOwype7MupQneptuZCnqaWnRh7fEoUKIUUDdAEWK'),
(2, 'shadowalker', '$2y$10$5hQ4IU4xS0e5XTws7Xj1f.ZykSYeKo1fA0765ZWEepoS0mqhQg1jS');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `commentID` int(25) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `PhoneNo` varchar(15) NOT NULL,
  `Comments` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`commentID`, `FirstName`, `LastName`, `PhoneNo`, `Comments`) VALUES
(2, 'emmanuel ', 'chirchir', '0705814794', 'how can i become a member'),
(3, 'shadrack ', 'messhack ', '07058337485', ' i am so pleased to join your guys give me a better way to so this ');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `memberID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `active` varchar(255) NOT NULL,
  `resetToken` varchar(255) DEFAULT NULL,
  `resetComplete` varchar(3) DEFAULT 'No',
  `Firstname` varchar(100) NOT NULL,
  `Lastname` varchar(100) NOT NULL,
  `Company_name` varchar(100) NOT NULL,
  `PhoneNo` varchar(100) NOT NULL,
  `Location` varchar(100) NOT NULL,
  `Specialization` varchar(200) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`memberID`, `username`, `password`, `email`, `active`, `resetToken`, `resetComplete`, `Firstname`, `Lastname`, `Company_name`, `PhoneNo`, `Location`, `Specialization`, `address`) VALUES
(24, 'chirchir', '$2y$10$KtBZxD4JsHUIS/DUd/nV0eM.SHJlZpLnlg4Ow1c.y9xCjiT45kFRi', 'chirchir7370@gmail.com', 'Yes', 'ee48b97bb7419e4ad80b2703ce15a900', 'No', 'chirchir', 'emmanuel', 'Shadowalker', '+254705814794', 'Kisumu', 'wall painting', '360  Eldoret'),
(26, 'sharon ', '$2y$10$HRe7YKReodPQNyuFIF8ZRu4kgdTo3Dkzq9gnCSK8NS7H1yM64s2wi', 'sharon@gmail.com', '3e846f2d980d41ed5d1307b3bedaa252', NULL, 'No', 'enter First Name', 'enter Last name', 'enter Company name', 'enter Phone No', 'Current Location', 'your Specialixation', 'address and city');

-- --------------------------------------------------------

--
-- Table structure for table `progress_bar`
--

CREATE TABLE `progress_bar` (
  `progress_id` int(100) NOT NULL,
  `tender_id` int(100) NOT NULL,
  `supplier_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Tender_assign`
--

CREATE TABLE `Tender_assign` (
  `assign_id` int(100) NOT NULL,
  `tender_id` int(100) NOT NULL,
  `supplier_id` int(100) NOT NULL,
  `date_created` varchar(50) NOT NULL,
  `end_created` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Tender_details`
--

CREATE TABLE `Tender_details` (
  `tender_id` int(100) NOT NULL,
  `tender_info` varchar(1000) NOT NULL,
  `tender_descr` varchar(500) DEFAULT NULL,
  `tender_cost` varchar(100) NOT NULL,
  `client` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `bid` int(2) NOT NULL,
  `pending` int(2) NOT NULL,
  `closing_date` varchar(50) NOT NULL,
  `userID` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Tender_details`
--

INSERT INTO `Tender_details` (`tender_id`, `tender_info`, `tender_descr`, `tender_cost`, `client`, `location`, `bid`, `pending`, `closing_date`, `userID`) VALUES
(10, 'House Painting', 'KRA is looking for a company that can provide paitnting servicest to all our offices country wide', 'ksh 47847474', 'KRA', 'Nairobi', 1, 0, '07-10-2017', 24);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `login_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentID`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`memberID`);

--
-- Indexes for table `progress_bar`
--
ALTER TABLE `progress_bar`
  ADD PRIMARY KEY (`progress_id`);

--
-- Indexes for table `Tender_assign`
--
ALTER TABLE `Tender_assign`
  ADD PRIMARY KEY (`assign_id`);

--
-- Indexes for table `Tender_details`
--
ALTER TABLE `Tender_details`
  ADD PRIMARY KEY (`tender_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentID` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `memberID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `progress_bar`
--
ALTER TABLE `progress_bar`
  MODIFY `progress_id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Tender_assign`
--
ALTER TABLE `Tender_assign`
  MODIFY `assign_id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Tender_details`
--
ALTER TABLE `Tender_details`
  MODIFY `tender_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
