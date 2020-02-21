-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2020 at 07:13 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nhis`
--

-- --------------------------------------------------------

--
-- Table structure for table `client_booking`
--

CREATE TABLE `client_booking` (
  `ID` int(11) NOT NULL,
  `UNAME` varchar(25) NOT NULL,
  `DATE` date NOT NULL,
  `SERVICE` varchar(25) NOT NULL,
  `CENTER` varchar(25) NOT NULL,
  `BOOKED_ON` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client_booking`
--

INSERT INTO `client_booking` (`ID`, `UNAME`, `DATE`, `SERVICE`, `CENTER`, `BOOKED_ON`) VALUES
(12346, 'jDoe', '2020-02-23', 'Renewal', 'Ablekuma', '2020-02-21 18:08:58');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `ID` int(11) NOT NULL,
  `FNAME` varchar(25) NOT NULL,
  `LNAME` varchar(25) NOT NULL,
  `UNAME` varchar(25) NOT NULL,
  `PHONE` varchar(15) NOT NULL,
  `PSWD` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`ID`, `FNAME`, `LNAME`, `UNAME`, `PHONE`, `PSWD`) VALUES
(17, 'John', 'Doe', 'jDoe', '0231234567', 'password');

-- --------------------------------------------------------

--
-- Table structure for table `officials`
--

CREATE TABLE `officials` (
  `ID_NUM` varchar(15) NOT NULL,
  `PIN` int(5) NOT NULL,
  `LOCATION` varchar(25) NOT NULL,
  `NAME` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `officials`
--

INSERT INTO `officials` (`ID_NUM`, `PIN`, `LOCATION`, `NAME`) VALUES
('123456789', 1234, 'Ablekuma', 'Kofi Kyei'),
('987654321', 1234, 'Ayawaso', 'Agnes Afia');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client_booking`
--
ALTER TABLE `client_booking`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `UNAME` (`UNAME`);

--
-- Indexes for table `officials`
--
ALTER TABLE `officials`
  ADD PRIMARY KEY (`ID_NUM`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client_booking`
--
ALTER TABLE `client_booking`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12347;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
