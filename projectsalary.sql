-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2019 at 08:35 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `projectsalary`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE IF NOT EXISTS `attendance` (
  `id` int(255) NOT NULL,
  `department` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `emp_list`
--

CREATE TABLE IF NOT EXISTS `emp_list` (
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `department` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `salary` int(10) NOT NULL,
  `address` text NOT NULL,
  `phone_no` varchar(10) NOT NULL,
  `gender` varchar(6) NOT NULL,
`id` int(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp_list`
--

INSERT INTO `emp_list` (`first_name`, `last_name`, `email`, `department`, `password`, `salary`, `address`, `phone_no`, `gender`, `id`) VALUES
('Kunal', 'Bhardwaj', 'kbckunal@gmail.com', 'Admin', 'kpassword', 150000, '#210 B2 Shiv Colony, Pinjore', '8930874509', 'Male', 1),
('Harshit', 'Sood', 'hsood92@gmail.com', 'Sales Department', 'hpassword', 55000, 'Himshikha', '7456982354', 'Male', 2);

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE IF NOT EXISTS `holidays` (
  `day_name` varchar(20) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE IF NOT EXISTS `salary` (
  `id` int(255) NOT NULL,
  `gpf` int(10) NOT NULL,
  `gsi` int(10) NOT NULL,
  `ta` int(10) NOT NULL,
  `da` int(10) NOT NULL,
  `leave_deduction` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `emp_list`
--
ALTER TABLE `emp_list`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `emp_list`
--
ALTER TABLE `emp_list`
MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
