-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2020 at 04:29 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studentexam`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(1) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `queID` int(10) NOT NULL,
  `quemain` text NOT NULL,
  `queOpt1` text NOT NULL,
  `queOpt2` text NOT NULL,
  `queOpt3` text NOT NULL,
  `queOpt4` text NOT NULL,
  `queAns` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`queID`, `quemain`, `queOpt1`, `queOpt2`, `queOpt3`, `queOpt4`, `queAns`) VALUES
(1, 'sa ka naka palit og iphone', 'ambot', 'naa sa japan', 'lols', 'lol', ' china');

-- --------------------------------------------------------

--
-- Table structure for table `studentanswers`
--

CREATE TABLE `studentanswers` (
  `stanID` int(10) NOT NULL,
  `studID` int(10) NOT NULL,
  `queID` int(10) NOT NULL,
  `stanswer` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `studID` int(10) NOT NULL,
  `studFname` varchar(50) NOT NULL,
  `studLname` varchar(50) NOT NULL,
  `studMname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`studID`, `studFname`, `studLname`, `studMname`) VALUES
(11113, 'Myhca', 'Abenasa', 'B'),
(331231, 'Grace', 'Abenasa', 'M'),
(1423451, 'Snak', 'Thea', 'Meme'),
(11111775, 'Grace', 'Hiyocm', 'B'),
(14143526, 'Myhca', 'Abenasa', 'bermil'),
(14290696, 'Suyat', 'Fantonial', 'Hinoguin'),
(15321314, 'Mallen', 'Epe', 'Tuico'),
(15386204, 'Fantonial', 'Generalao', 'Godinez'),
(21313144, 'Myhca', 'Abenasa', 'S'),
(141435261, 'Myhcaa', 'Abenasaa', 'bermila'),
(153231545, 'Willa Mae', 'Fantonial', 'M'),
(153862041, '', '', ''),
(1151312441, 'Grace', 'Hiyoca', 'ambot');

-- --------------------------------------------------------

--
-- Table structure for table `studenttakers`
--

CREATE TABLE `studenttakers` (
  `studID` int(10) NOT NULL,
  `started` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `finished` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `score` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studentanswers`
--
ALTER TABLE `studentanswers`
  ADD PRIMARY KEY (`stanID`),
  ADD KEY `queID` (`queID`),
  ADD KEY `studentanswers_ibfk_2` (`studID`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`studID`);

--
-- Indexes for table `studenttakers`
--
ALTER TABLE `studenttakers`
  ADD PRIMARY KEY (`studID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `studentanswers`
--
ALTER TABLE `studentanswers`
  MODIFY `stanID` int(10) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `studentanswers`
--
ALTER TABLE `studentanswers`
  ADD CONSTRAINT `studentanswers_ibfk_1` FOREIGN KEY (`queID`) REFERENCES `studentanswers` (`stanID`),
  ADD CONSTRAINT `studentanswers_ibfk_2` FOREIGN KEY (`studID`) REFERENCES `studentanswers` (`stanID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
