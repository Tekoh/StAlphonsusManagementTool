-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2025 at 05:34 PM
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
-- Database: `stalphonsusdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `assistant`
--

CREATE TABLE `assistant` (
  `assistant_id` varchar(12) NOT NULL,
  `person_id` varchar(12) NOT NULL,
  `enroll_date` date DEFAULT NULL,
  `salary` float DEFAULT NULL,
  `hours` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_assistant`
--

CREATE TABLE `attendance_assistant` (
  `attendance_id` int(11) NOT NULL,
  `assistant_id` varchar(12) NOT NULL,
  `class_id` varchar(12) NOT NULL,
  `attendance_date` date NOT NULL,
  `attendance_status` enum('Present','Absent','Leave') NOT NULL,
  `remarks` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_student`
--

CREATE TABLE `attendance_student` (
  `attendance_id` int(11) NOT NULL,
  `student_id` varchar(12) NOT NULL,
  `attendance_date` date NOT NULL,
  `attendance_status` enum('Present','Absent','Leave') NOT NULL,
  `remarks` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_teacher`
--

CREATE TABLE `attendance_teacher` (
  `attendance_id` int(11) NOT NULL,
  `teacher_id` varchar(12) NOT NULL,
  `attendance_date` date NOT NULL,
  `attendance_status` enum('Present','Absent','Leave') NOT NULL,
  `remarks` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `class_id` varchar(12) NOT NULL,
  `grade_level` varchar(50) NOT NULL,
  `room_number` int(11) NOT NULL,
  `capacity` int(11) NOT NULL,
  `teacher_id` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `class_assistant`
--

CREATE TABLE `class_assistant` (
  `class_assistant_id` int(11) NOT NULL,
  `assistant_id` varchar(12) NOT NULL,
  `class_id` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dinner_money`
--

CREATE TABLE `dinner_money` (
  `payment_id` int(11) NOT NULL,
  `student_id` varchar(12) NOT NULL,
  `transaction_date` date NOT NULL,
  `total_amount` float NOT NULL,
  `amount_paid` float DEFAULT NULL,
  `amount_due` float DEFAULT NULL,
  `transaction_status` enum('Paid','Pending','Overdue') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guardian`
--

CREATE TABLE `guardian` (
  `guardian_index_id` int(11) NOT NULL,
  `guardian_id` varchar(12) NOT NULL,
  `student_id` varchar(12) NOT NULL,
  `relation` enum('Mother','Father','Family','Other') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `library`
--

CREATE TABLE `library` (
  `book_id` varchar(12) NOT NULL,
  `book_name` varchar(100) DEFAULT NULL,
  `author_name` varchar(50) DEFAULT NULL,
  `book_published` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `library_transaction`
--

CREATE TABLE `library_transaction` (
  `transaction_id` int(11) NOT NULL,
  `student_id` varchar(12) NOT NULL,
  `book_id` varchar(12) NOT NULL,
  `borrow_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `transaction_status` enum('Returned','Pending','Overdue') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `persons`
--

CREATE TABLE `persons` (
  `person_id` varchar(12) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `medical_history` varchar(255) DEFAULT NULL,
  `contact` varchar(20) NOT NULL,
  `qualifications` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` varchar(12) NOT NULL,
  `person_id` varchar(12) NOT NULL,
  `class_id` varchar(12) NOT NULL,
  `subject` varchar(20) DEFAULT NULL,
  `fee` float DEFAULT NULL,
  `fee_status` enum('Paid','Pending','Overdue') DEFAULT NULL,
  `student_status` enum('Active','Inactive','Suspended') DEFAULT NULL,
  `enroll_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `teacher_id` varchar(12) NOT NULL,
  `person_id` varchar(12) NOT NULL,
  `enroll_date` date NOT NULL,
  `salary` float NOT NULL,
  `hours` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `admin_id` int(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `person_id` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`admin_id`, `username`, `password`, `person_id`) VALUES
(4, 'Mahd12345', '$2y$10$XS1G7NcTD9vC6Xy5.rHSGuryn8LVaOuZ3X/U5TF/4EURzZB3CZeSK', 'P-00001');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assistant`
--
ALTER TABLE `assistant`
  ADD PRIMARY KEY (`assistant_id`),
  ADD KEY `person_id` (`person_id`);

--
-- Indexes for table `attendance_assistant`
--
ALTER TABLE `attendance_assistant`
  ADD PRIMARY KEY (`attendance_id`),
  ADD UNIQUE KEY `unique_assistant_attendance` (`assistant_id`,`class_id`,`attendance_date`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `attendance_student`
--
ALTER TABLE `attendance_student`
  ADD PRIMARY KEY (`attendance_id`),
  ADD UNIQUE KEY `unique_student_attendance` (`student_id`,`attendance_date`);

--
-- Indexes for table `attendance_teacher`
--
ALTER TABLE `attendance_teacher`
  ADD PRIMARY KEY (`attendance_id`),
  ADD UNIQUE KEY `unique_teacher_attendance` (`teacher_id`,`attendance_date`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`class_id`),
  ADD UNIQUE KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `class_assistant`
--
ALTER TABLE `class_assistant`
  ADD PRIMARY KEY (`class_assistant_id`),
  ADD UNIQUE KEY `class_assist_constraint` (`class_id`,`assistant_id`),
  ADD KEY `assistant_id` (`assistant_id`);

--
-- Indexes for table `dinner_money`
--
ALTER TABLE `dinner_money`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `guardian`
--
ALTER TABLE `guardian`
  ADD PRIMARY KEY (`guardian_index_id`),
  ADD UNIQUE KEY `guardian_student_constraint` (`guardian_id`,`student_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `library`
--
ALTER TABLE `library`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `library_transaction`
--
ALTER TABLE `library_transaction`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `persons`
--
ALTER TABLE `persons`
  ADD PRIMARY KEY (`person_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `person_id` (`person_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacher_id`),
  ADD KEY `person_id` (`person_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `unique_username` (`username`),
  ADD KEY `user_person_id` (`person_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance_assistant`
--
ALTER TABLE `attendance_assistant`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendance_student`
--
ALTER TABLE `attendance_student`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendance_teacher`
--
ALTER TABLE `attendance_teacher`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `class_assistant`
--
ALTER TABLE `class_assistant`
  MODIFY `class_assistant_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dinner_money`
--
ALTER TABLE `dinner_money`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guardian`
--
ALTER TABLE `guardian`
  MODIFY `guardian_index_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `library_transaction`
--
ALTER TABLE `library_transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `admin_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assistant`
--
ALTER TABLE `assistant`
  ADD CONSTRAINT `assistant_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `persons` (`person_id`) ON DELETE CASCADE;

--
-- Constraints for table `attendance_assistant`
--
ALTER TABLE `attendance_assistant`
  ADD CONSTRAINT `attendance_assistant_ibfk_1` FOREIGN KEY (`assistant_id`) REFERENCES `assistant` (`assistant_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attendance_assistant_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `class` (`class_id`) ON DELETE CASCADE;

--
-- Constraints for table `attendance_student`
--
ALTER TABLE `attendance_student`
  ADD CONSTRAINT `attendance_student_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE;

--
-- Constraints for table `attendance_teacher`
--
ALTER TABLE `attendance_teacher`
  ADD CONSTRAINT `attendance_teacher_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`) ON DELETE CASCADE;

--
-- Constraints for table `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `class_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`) ON DELETE CASCADE;

--
-- Constraints for table `class_assistant`
--
ALTER TABLE `class_assistant`
  ADD CONSTRAINT `class_assistant_ibfk_1` FOREIGN KEY (`assistant_id`) REFERENCES `assistant` (`assistant_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `class_assistant_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `class` (`class_id`);

--
-- Constraints for table `dinner_money`
--
ALTER TABLE `dinner_money`
  ADD CONSTRAINT `dinner_money_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`);

--
-- Constraints for table `guardian`
--
ALTER TABLE `guardian`
  ADD CONSTRAINT `guardian_ibfk_1` FOREIGN KEY (`guardian_id`) REFERENCES `persons` (`person_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `guardian_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE;

--
-- Constraints for table `library_transaction`
--
ALTER TABLE `library_transaction`
  ADD CONSTRAINT `library_transaction_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `library_transaction_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `library` (`book_id`) ON DELETE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `persons` (`person_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `class` (`class_id`) ON DELETE CASCADE;

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `persons` (`person_id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `user_person_id` FOREIGN KEY (`person_id`) REFERENCES `persons` (`person_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
