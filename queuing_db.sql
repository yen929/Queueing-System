-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2026 at 06:49 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `queuing_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `audittrail`
--

CREATE TABLE `audittrail` (
  `userID` int(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `audittrail`
--

INSERT INTO `audittrail` (`userID`, `description`) VALUES
(0, 'Added a new user.');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `departmentID` int(16) NOT NULL,
  `departmentName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`departmentID`, `departmentName`) VALUES
(1, 'Computer Science'),
(2, 'Information Technology'),
(3, 'Hospitality Management');

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `programID` int(11) NOT NULL,
  `departmentID` int(11) NOT NULL,
  `programName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`programID`, `departmentID`, `programName`) VALUES
(1, 1, 'Bachelor of Science in Computer Science-Business Analytics');

-- --------------------------------------------------------

--
-- Table structure for table `queues`
--

CREATE TABLE `queues` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `queue_number` varchar(20) NOT NULL,
  `status` enum('waiting','processing','done') DEFAULT 'waiting',
  `stage` enum('evaluation','payment','registrar','other') DEFAULT 'evaluation',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('evaluator','cashier','registrar','admin') DEFAULT 'evaluator'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', 'admin123', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `course` varchar(100) NOT NULL,
  `is_pwd` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `useraccount`
--

CREATE TABLE `useraccount` (
  `first_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(16) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `userID` int(50) DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `last_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `useraccount`
--

INSERT INTO `useraccount` (`first_name`, `email`, `password`, `user_type`, `userID`, `status`, `last_name`) VALUES
('Charlene', 'admin@admin.com', 'admin12345', 'Admin', 1, 'Active', 'Dela Cruz'),
('Rhemelyn', 'rhem@email.com', '12345', 'Admin', 2, 'Inactive', 'Buenaflor'),
('Rassel', 'rassel@email.com', '12345', 'Faculty', 3, 'Inactive', 'Altero'),
('Diana', 'diana@email.com', '12345', 'Faculty', 4, 'Active', 'Perez'),
('Cristine', 'cm@email.com', '12345', 'Admin', 5, 'Active', 'Mat-an'),
('Jaylord', 'jaylorden@email.com', '12345', 'Student', 6, 'Active', 'Orden'),
('Helen', 'helen@email.com', '12345', 'Student', 7, 'Active', 'Derije'),
('Hans', 'hans@email.com', '12345', 'Faculty', 8, 'Active', 'Bangyad'),
('Rosen', 'rosen@email.com', '12345', 'Faculty', 9, 'Active', 'Pascua'),
('Melita', 'mel@email.com', '12345', 'Faculty', 10, 'Active', 'Batacan'),
('Irel', 'irel@email.com', '12345', 'Faculty', 11, 'Active', 'Derije'),
('Jerelyn', 'je@email.com', '12345', 'Faculty', 12, 'Active', 'Maejan'),
('Vernyll', 'vernyll@email.com', '12345', 'Faculty', 13, 'Active', 'Asis'),
('Krizsha', 'ksalinas@email.com', '12345', 'Faculty', 14, 'Active', 'Salinas'),
('ANa', 'anabelle@email.com', '12345', 'Student', 15, 'Active', 'Belle'),
('Marie', 'marie@email.com', '12345', 'Admin', 16, 'Active', 'Chan'),
('Dave', 'dave@email.com', 'dave', 'Student', 17, 'Active', 'Genove'),
('Dave', 'davemer@email.com', '1234567890', 'Admin', 18, 'Active', 'Mercado'),
('Diana', 'subiri@email.com', '123', 'Faculty', 19, 'Active', 'Subiri'),
('Irel', 'derije@email.com', '123', 'Faculty', 20, 'Active', 'Derije');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`departmentID`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`programID`),
  ADD KEY `departmentID` (`departmentID`);

--
-- Indexes for table `queues`
--
ALTER TABLE `queues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `departmentID` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `programID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `queues`
--
ALTER TABLE `queues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `programs`
--
ALTER TABLE `programs`
  ADD CONSTRAINT `programs_ibfk_1` FOREIGN KEY (`departmentID`) REFERENCES `departments` (`departmentID`);

--
-- Constraints for table `queues`
--
ALTER TABLE `queues`
  ADD CONSTRAINT `queues_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
