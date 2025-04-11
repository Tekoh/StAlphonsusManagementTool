-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2025 at 06:45 PM
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

--
-- Dumping data for table `assistant`
--

INSERT INTO `assistant` (`assistant_id`, `person_id`, `enroll_date`, `salary`, `hours`) VALUES
('A-00002', 'P-00012', '2024-03-10', 22000, 35),
('A-00003', 'P-00018', '2024-06-20', 18000, 25),
('A-00004', 'P-00024', '2024-09-01', 21000, 32),
('A-00005', 'P-00051', '2025-02-01', 19000, 28);

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

--
-- Dumping data for table `attendance_teacher`
--

INSERT INTO `attendance_teacher` (`attendance_id`, `teacher_id`, `attendance_date`, `attendance_status`, `remarks`) VALUES
(1, 'TC-00001', '2025-04-07', 'Present', ''),
(2, 'TC-00002', '2025-04-07', 'Absent', ''),
(3, 'TC-00003', '2025-04-07', 'Absent', ''),
(4, 'TC-00004', '2025-04-07', 'Absent', ''),
(5, 'TC-00005', '2025-04-07', 'Absent', ''),
(6, 'TC-00006', '2025-04-07', 'Absent', ''),
(7, 'TC-00007', '2025-04-07', 'Absent', '');

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

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`class_id`, `grade_level`, `room_number`, `capacity`, `teacher_id`) VALUES
('CLR-00001', 'Reception Year', 101, 55, 'TC-00007'),
('CLR-00002', 'Year One', 102, 56, 'TC-00006'),
('CLR-00003', 'Year Two', 103, 70, 'TC-00005'),
('CLR-00004', 'Year Three', 106, 77, 'TC-00004'),
('CLR-00005', 'Year Four', 111, 76, 'TC-00003'),
('CLR-00006', 'Year Five', 112, 76, 'TC-00002'),
('CLR-00007', 'Year Six', 165, 76, 'TC-00001');

-- --------------------------------------------------------

--
-- Table structure for table `class_assistant`
--

CREATE TABLE `class_assistant` (
  `class_assistant_id` int(11) NOT NULL,
  `assistant_id` varchar(12) NOT NULL,
  `class_id` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_assistant`
--

INSERT INTO `class_assistant` (`class_assistant_id`, `assistant_id`, `class_id`) VALUES
(1, 'A-00002', 'CLR-00001'),
(9, 'A-00005', 'CLR-00001'),
(2, 'A-00002', 'CLR-00002'),
(3, 'A-00003', 'CLR-00003'),
(5, 'A-00003', 'CLR-00004'),
(6, 'A-00004', 'CLR-00005'),
(7, 'A-00005', 'CLR-00006'),
(8, 'A-00005', 'CLR-00007');

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

--
-- Dumping data for table `dinner_money`
--

INSERT INTO `dinner_money` (`payment_id`, `student_id`, `transaction_date`, `total_amount`, `amount_paid`, `amount_due`, `transaction_status`) VALUES
(2, 'STD-00002', '2025-02-15', 50, 25, 25, 'Pending'),
(5, 'STD-00005', '2025-02-10', 50, 30, 20, 'Pending'),
(6, 'STD-00006', '2025-03-15', 50, 0, 50, 'Overdue'),
(7, 'STD-00007', '2025-01-25', 50, 50, 0, 'Paid'),
(8, 'STD-00008', '2025-02-20', 50, 40, 10, 'Pending'),
(9, 'STD-00009', '2025-03-05', 50, 0, 50, 'Overdue'),
(10, 'STD-00010', '2025-01-15', 50, 50, 0, 'Paid'),
(11, 'STD-00011', '2025-02-25', 50, 20, 30, 'Pending'),
(12, 'STD-00012', '2025-03-10', 50, 0, 50, 'Overdue'),
(13, 'STD-00013', '2025-01-30', 50, 50, 0, 'Paid'),
(14, 'STD-00014', '2025-02-05', 50, 35, 15, 'Pending'),
(15, 'STD-00015', '2025-03-20', 50, 0, 50, 'Overdue'),
(16, 'STD-00016', '2025-01-05', 50, 50, 0, 'Paid'),
(17, 'STD-00017', '2025-02-15', 50, 10, 40, 'Pending'),
(18, 'STD-00018', '2025-03-25', 50, 0, 50, 'Overdue'),
(19, 'STD-00019', '2025-01-10', 50, 50, 0, 'Paid'),
(20, 'STD-00020', '2025-02-20', 50, 45, 5, 'Pending'),
(21, 'STD-00021', '2025-03-01', 50, 0, 50, 'Overdue'),
(22, 'STD-00022', '2025-01-15', 50, 50, 0, 'Paid'),
(23, 'STD-00023', '2025-02-25', 50, 30, 20, 'Pending'),
(24, 'STD-00024', '2025-03-05', 50, 0, 50, 'Overdue'),
(25, 'STD-00025', '2025-01-20', 50, 50, 0, 'Paid'),
(26, 'STD-00026', '2025-02-10', 50, 20, 30, 'Pending'),
(27, 'STD-00027', '2025-03-15', 50, 0, 50, 'Overdue'),
(28, 'STD-00028', '2025-01-25', 50, 50, 0, 'Paid'),
(29, 'STD-00029', '2025-02-15', 50, 40, 10, 'Pending'),
(30, 'STD-00030', '2025-03-20', 50, 0, 50, 'Overdue'),
(31, 'STD-00031', '2025-01-30', 50, 50, 0, 'Paid'),
(32, 'STD-00032', '2025-02-05', 50, 25, 25, 'Pending'),
(33, 'STD-00033', '2025-03-25', 50, 0, 50, 'Overdue'),
(34, 'STD-00034', '2025-01-05', 50, 50, 0, 'Paid'),
(35, 'STD-00035', '2025-02-10', 50, 30, 20, 'Pending'),
(36, 'STD-00036', '2025-03-01', 50, 0, 50, 'Overdue'),
(37, 'STD-00037', '2025-01-15', 50, 50, 0, 'Paid'),
(38, 'STD-00038', '2025-02-20', 50, 15, 35, 'Pending'),
(39, 'STD-00039', '2025-03-05', 50, 0, 50, 'Overdue'),
(40, 'STD-00040', '2025-01-20', 50, 50, 0, 'Paid');

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

--
-- Dumping data for table `guardian`
--

INSERT INTO `guardian` (`guardian_index_id`, `guardian_id`, `student_id`, `relation`) VALUES
(1, 'P-00052', 'STD-00001', 'Mother'),
(2, 'P-00053', 'STD-00002', 'Father'),
(3, 'P-00054', 'STD-00003', 'Mother'),
(4, 'P-00055', 'STD-00004', 'Father'),
(5, 'P-00056', 'STD-00005', 'Mother'),
(6, 'P-00057', 'STD-00006', 'Father'),
(7, 'P-00058', 'STD-00007', 'Mother'),
(8, 'P-00059', 'STD-00008', 'Father'),
(9, 'P-00060', 'STD-00009', 'Family'),
(10, 'P-00061', 'STD-00010', 'Other'),
(11, 'P-00062', 'STD-00011', 'Mother'),
(12, 'P-00063', 'STD-00012', 'Father'),
(13, 'P-00064', 'STD-00013', 'Mother'),
(14, 'P-00065', 'STD-00014', 'Father'),
(15, 'P-00066', 'STD-00015', 'Family'),
(16, 'P-00067', 'STD-00016', 'Other'),
(17, 'P-00068', 'STD-00017', 'Mother'),
(18, 'P-00069', 'STD-00018', 'Father'),
(19, 'P-00070', 'STD-00019', 'Mother'),
(20, 'P-00071', 'STD-00020', 'Father'),
(21, 'P-00072', 'STD-00021', 'Mother'),
(22, 'P-00073', 'STD-00022', 'Father'),
(23, 'P-00074', 'STD-00023', 'Family'),
(24, 'P-00075', 'STD-00024', 'Other'),
(25, 'P-00076', 'STD-00025', 'Mother'),
(26, 'P-00077', 'STD-00026', 'Father'),
(27, 'P-00078', 'STD-00027', 'Mother'),
(28, 'P-00079', 'STD-00028', 'Father'),
(29, 'P-00080', 'STD-00029', 'Family'),
(30, 'P-00081', 'STD-00030', 'Other'),
(31, 'P-00082', 'STD-00031', 'Mother'),
(32, 'P-00083', 'STD-00032', 'Father'),
(33, 'P-00084', 'STD-00033', 'Mother'),
(34, 'P-00085', 'STD-00034', 'Father'),
(35, 'P-00086', 'STD-00035', 'Mother'),
(36, 'P-00087', 'STD-00036', 'Father'),
(37, 'P-00088', 'STD-00037', 'Family'),
(38, 'P-00089', 'STD-00038', 'Other'),
(39, 'P-00090', 'STD-00039', 'Mother'),
(40, 'P-00091', 'STD-00040', 'Father');

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

--
-- Dumping data for table `library`
--

INSERT INTO `library` (`book_id`, `book_name`, `author_name`, `book_published`) VALUES
('BK-00001', 'The Very Hungry Caterpillar', 'Eric Carle', '1969-01-01'),
('BK-00002', 'Where the Wild Things Are', 'Maurice Sendak', '1963-01-01'),
('BK-00003', 'The Gruffalo', 'Julia Donaldson', '1999-01-01'),
('BK-00004', 'Charlotte’s Web', 'E.B. White', '1952-01-01'),
('BK-00005', 'Matilda', 'Roald Dahl', '1988-01-01'),
('BK-00006', 'The Lion, the Witch and the Wardrobe', 'C.S. Lewis', '1950-01-01'),
('BK-00007', 'Dear Zoo', 'Rod Campbell', '1982-01-01'),
('BK-00008', 'The BFG', 'Roald Dahl', '1982-01-01'),
('BK-00009', 'Room on the Broom', 'Julia Donaldson', '2001-01-01'),
('BK-00010', 'The Cat in the Hat', 'Dr. Seuss', '1957-01-01'),
('BK-00011', 'Harry Potter and the Philosopher’s Stone', 'J.K. Rowling', '1997-01-01'),
('BK-00012', 'The Tale of Peter Rabbit', 'Beatrix Potter', '1902-01-01'),
('BK-00013', 'Charlie and the Chocolate Factory', 'Roald Dahl', '1964-01-01'),
('BK-00014', 'We’re Going on a Bear Hunt', 'Michael Rosen', '1989-01-01'),
('BK-00015', 'The Tiger Who Came to Tea', 'Judith Kerr', '1968-01-01'),
('BK-00016', 'Percy the Park Keeper', 'Nick Butterworth', '1989-01-01'),
('BK-00017', 'The Wind in the Willows', 'Kenneth Grahame', '1908-01-01'),
('BK-00018', 'Stick Man', 'Julia Donaldson', '2008-01-01'),
('BK-00019', 'James and the Giant Peach', 'Roald Dahl', '1961-01-01'),
('BK-00020', 'The Enormous Crocodile', 'Roald Dahl', '1978-01-01'),
('BK-00021', 'The Secret Garden', 'Frances Hodgson Burnett', '1911-01-01'),
('BK-00022', 'The Jolly Postman', 'Allan Ahlberg', '1986-01-01'),
('BK-00023', 'The Snowman', 'Raymond Briggs', '1978-01-01'),
('BK-00024', 'Hairy Maclary from Donaldson’s Dairy', 'Lynley Dodd', '1983-01-01'),
('BK-00025', 'The Magic Faraway Tree', 'Enid Blyton', '1943-01-01'),
('BK-00026', 'A Bear Called Paddington', 'Michael Bond', '1958-01-01'),
('BK-00027', 'The Worst Witch', 'Jill Murphy', '1974-01-01'),
('BK-00028', 'Each Peach Pear Plum', 'Janet Ahlberg', '1978-01-01'),
('BK-00029', 'The Velveteen Rabbit', 'Margery Williams', '1922-01-01'),
('BK-00030', 'Elmer', 'David McKee', '1989-01-01'),
('BK-00031', 'The Rainbow Fish', 'Marcus Pfister', '1992-01-01'),
('BK-00032', 'The Twits', 'Roald Dahl', '1980-01-01'),
('BK-00033', 'The Day the Crayons Quit', 'Drew Daywalt', '2013-01-01'),
('BK-00034', 'Goodnight Moon', 'Margaret Wise Brown', '1947-01-01'),
('BK-00035', 'The Three Little Pigs', 'James Marshall', '1989-01-01'),
('BK-00036', 'Fantastic Mr Fox', 'Roald Dahl', '1970-01-01'),
('BK-00037', 'The Paper Bag Princess', 'Robert Munsch', '1980-01-01'),
('BK-00038', 'Winnie-the-Pooh', 'A.A. Milne', '1926-01-01'),
('BK-00039', 'The Snail and the Whale', 'Julia Donaldson', '2003-01-01'),
('BK-00040', 'Green Eggs and Ham', 'Dr. Seuss', '1960-01-01'),
('BK-00041', 'The Hobbit', 'J.R.R. Tolkien', '1937-01-01'),
('BK-00042', 'The Little Prince', 'Antoine de Saint-Exupéry', '1943-01-01'),
('BK-00043', 'Dogger', 'Shirley Hughes', '1977-01-01'),
('BK-00044', 'The Giving Tree', 'Shel Silverstein', '1964-01-01'),
('BK-00045', 'Stig of the Dump', 'Clive King', '1963-01-01'),
('BK-00046', 'The Mixed-Up Chameleon', 'Eric Carle', '1975-01-01'),
('BK-00047', 'Zog', 'Julia Donaldson', '2010-01-01'),
('BK-00048', 'The Famous Five: Five on a Treasure Island', 'Enid Blyton', '1942-01-01'),
('BK-00049', 'The Witches', 'Roald Dahl', '1983-01-01'),
('BK-00050', 'Oh, the Places You’ll Go!', 'Dr. Seuss', '1990-01-01');

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

--
-- Dumping data for table `library_transaction`
--

INSERT INTO `library_transaction` (`transaction_id`, `student_id`, `book_id`, `borrow_date`, `return_date`, `transaction_status`) VALUES
(2, 'STD-00005', 'BK-00021', '2024-01-03', NULL, 'Pending'),
(3, 'STD-00019', 'BK-00011', '2024-01-04', '2024-01-12', 'Overdue'),
(4, 'STD-00001', 'BK-00050', '2024-01-05', '2024-01-15', 'Returned'),
(5, 'STD-00029', 'BK-00003', '2024-01-06', NULL, 'Pending'),
(6, 'STD-00011', 'BK-00041', '2024-01-07', '2024-01-16', 'Returned'),
(7, 'STD-00007', 'BK-00014', '2024-01-08', NULL, 'Pending'),
(8, 'STD-00003', 'BK-00039', '2024-01-09', '2024-01-20', 'Overdue'),
(9, 'STD-00015', 'BK-00010', '2024-01-10', '2024-01-18', 'Returned'),
(10, 'STD-00028', 'BK-00004', '2024-01-11', NULL, 'Pending'),
(11, 'STD-00025', 'BK-00022', '2024-01-12', '2024-01-19', 'Returned'),
(12, 'STD-00031', 'BK-00019', '2024-01-13', NULL, 'Pending'),
(13, 'STD-00006', 'BK-00013', '2024-01-14', '2024-01-21', 'Returned'),
(14, 'STD-00035', 'BK-00007', '2024-01-15', NULL, 'Pending'),
(15, 'STD-00017', 'BK-00046', '2024-01-16', '2024-01-24', 'Overdue'),
(16, 'STD-00013', 'BK-00020', '2024-01-17', '2024-01-25', 'Returned'),
(17, 'STD-00038', 'BK-00002', '2024-01-18', NULL, 'Pending'),
(18, 'STD-00040', 'BK-00012', '2024-01-19', '2024-01-27', 'Returned'),
(19, 'STD-00022', 'BK-00026', '2024-01-20', NULL, 'Pending'),
(20, 'STD-00004', 'BK-00018', '2024-01-21', '2024-01-28', 'Overdue'),
(21, 'STD-00002', 'BK-00025', '2024-01-22', '2024-01-30', 'Returned'),
(22, 'STD-00033', 'BK-00005', '2024-01-23', NULL, 'Pending'),
(23, 'STD-00020', 'BK-00016', '2024-01-24', '2024-02-01', 'Returned'),
(24, 'STD-00008', 'BK-00040', '2024-01-25', NULL, 'Pending'),
(25, 'STD-00023', 'BK-00009', '2024-01-26', '2024-02-02', 'Returned'),
(26, 'STD-00014', 'BK-00029', '2024-01-27', NULL, 'Pending'),
(27, 'STD-00026', 'BK-00032', '2024-01-28', '2024-02-03', 'Returned'),
(28, 'STD-00009', 'BK-00015', '2024-01-29', '2024-02-05', 'Overdue'),
(29, 'STD-00030', 'BK-00023', '2024-01-30', '2024-02-06', 'Returned'),
(30, 'STD-00036', 'BK-00031', '2024-01-31', NULL, 'Pending'),
(31, 'STD-00034', 'BK-00037', '2024-02-01', '2024-02-08', 'Returned'),
(32, 'STD-00010', 'BK-00017', '2024-02-02', NULL, 'Pending'),
(33, 'STD-00016', 'BK-00001', '2024-02-03', '2024-02-10', 'Returned'),
(34, 'STD-00039', 'BK-00006', '2024-02-04', NULL, 'Pending'),
(35, 'STD-00032', 'BK-00034', '2024-02-05', '2024-02-11', 'Returned'),
(36, 'STD-00027', 'BK-00028', '2024-02-06', NULL, 'Pending'),
(37, 'STD-00021', 'BK-00008', '2024-02-07', '2024-02-13', 'Returned'),
(38, 'STD-00018', 'BK-00024', '2024-02-08', NULL, 'Pending'),
(39, 'STD-00037', 'BK-00036', '2024-02-09', '2024-02-14', 'Overdue'),
(40, 'STD-00024', 'BK-00047', '2024-02-10', '2024-02-16', 'Returned');

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

--
-- Dumping data for table `persons`
--

INSERT INTO `persons` (`person_id`, `first_name`, `last_name`, `date_of_birth`, `gender`, `email`, `address`, `medical_history`, `contact`, `qualifications`) VALUES
('P-00001', 'Emma', 'Johnson', '1991-12-04', 'Female', 'j.emma_91@teacher.stalph.ac.uk', '45 Maple Street, Manchester, M1 3AD, UK', 'No known allergies, asthma diagnosed at age 15.', '+44 7911 123456', 'BSc in Psychology from University of Manchester (2013)\r\nMSc in Clinical Psychology from University C'),
('P-00002', 'Liam', 'Brown', '1985-03-23', 'Male', 'B.Liam_85@teacher.stalph.ac.uk', '102 Birch Avenue, London, E2 5LN, UK', 'History of migraines, no chronic conditions.', '+44 7911 654321', 'BEng in Mechanical Engineering from University of Cambridge (2007)\r\nMSc in Robotics from Imperial Co'),
('P-00003', 'Sophie', 'White', '1994-05-06', 'Female', 'W.Sophie_94@teacher.stalph.ac.uk', '67 Pine Close, Birmingham, B9 1PH, UK', 'No medical history, physically active.', '+44 7856 987654', 'BA in Graphic Design from Birmingham City University (2016)\r\n\r\nDiploma in Digital Marketing (2018)'),
('P-00004', 'Jack', 'Green', '1988-08-29', 'Male', 'G.Jack_88@teacher.stalph.ac.uk', '33 Oak Road, Leeds, LS2 7EG, UK', 'Type 2 diabetes, managed with medication.', '+44 7701 123987', 'BSc in Business Administration from University of Leeds (2010)\r\nMBA from University of Oxford (2015)'),
('P-00005', 'Olivia', 'Taylor', '1992-12-01', 'Female', 'T.Olivia_98@teacher.stalph.ac.uk', '20 Willow Crescent, Liverpool, L3 4EE, UK', 'Asthma, seasonal allergies.', '+44 7623 456789', 'BA in Education from University of Liverpool (2014)\r\nPGCE (Postgraduate Certificate in Education) fr'),
('P-00006', 'Ethan', 'Clarke', '1990-01-02', 'Male', 'C.Ethan_90@teacher.stalph.ac.uk', '90 Elm Street, Newcastle, NE4 1HH, UK', 'No significant medical issues, occasional back pain.', '+44 7440 123456', 'BSc in Computer Science from Newcastle University (2012)\r\nCertification in Data Analysis (2016)'),
('P-00007', 'Aeva', 'Harris', '1998-12-09', 'Female', 'H.Ava_98@teacher.stalph.ac.uk', '12 Cherry Road, Sheffield, S1 2JA, UK', 'No chronic conditions, minor food allergies.', '+44 7411 234567', 'BSc in Nursing from University of Sheffield (2018)\r\n\r\nFirst Aid and CPR Certified (2019)'),
('P-00008', 'Liam', 'Patel', '2019-09-05', 'Male', 'liam.patel@student.stalph.ac.uk', '45 Elm Rd, Manchester', 'Asthma', '07123456790', 'None (Reception student)'),
('P-00009', 'Sophie', 'Hughes', '2018-11-22', 'Female', 'sophie.hughes@student.stalph.ac.uk', '7 Pine Ave, Bristol', 'None', '07123456791', 'None (Year 1 student)'),
('P-00010', 'Noah', 'Bennett', '2017-06-15', 'Male', 'noah.bennett@student.stalph.ac.uk', '23 Birch Ln, Leeds', 'Peanut allergy', '07123456792', 'None (Year 2 student)'),
('P-00011', 'Olivia', 'Khan', '2016-02-28', 'Female', 'olivia.khan@student.stalph.ac.uk', '9 Maple Dr, Birmingham', 'None', '07123456793', 'None (Year 3 student)'),
('P-00012', 'James', 'Turner', '1990-07-19', 'Male', 'james.turner@assistant.stalph.ac.uk', '31 Cedar St, Sheffield', 'None', '07123456794', 'M.Ed, Teaching Certificate'),
('P-00013', 'Ava', 'Morgan', '2015-10-03', 'Female', 'ava.morgan@student.stalph.ac.uk', '15 Ash Rd, Liverpool', 'None', '07123456795', 'None (Year 4 student)'),
('P-00014', 'Ethan', 'Brooks', '2014-04-17', 'Male', 'ethan.brooks@student.stalph.ac.uk', '8 Willow Way, Newcastle', 'Eczema', '07123456796', 'None (Year 5 student)'),
('P-00015', 'Isabella', 'Lee', '2013-12-09', 'Female', 'isabella.lee@student.stalph.ac.uk', '27 Spruce St, Cardiff', 'None', '07123456797', 'None (Year 6 student)'),
('P-00016', 'Mason', 'Wright', '2019-01-30', 'Male', 'mason.wright@student.stalph.ac.uk', '3 Poplar Ct, Glasgow', 'None', '07123456798', 'None (Reception student)'),
('P-00017', 'Charlotte', 'Evans', '2018-08-14', 'Female', 'charlotte.evans@student.stalph.ac.uk', '19 Laurel Rd, Edinburgh', 'None', '07123456799', 'None (Year 1 student)'),
('P-00018', 'Jacob', 'Singh', '1988-05-23', 'Male', 'jacob.singh@assistant.stalph.ac.uk', '4 Hazel St, London', 'None', '07123456800', 'B.A., Teaching Assistant Cert.'),
('P-00019', 'Amelia', 'Foster', '2017-03-07', 'Female', 'amelia.foster@student.stalph.ac.uk', '11 Sycamore Ln, Bristol', 'None', '07123456801', 'None (Year 2 student)'),
('P-00020', 'William', 'Gray', '2016-09-19', 'Male', 'william.gray@student.stalph.ac.uk', '33 Chestnut Dr, Leeds', 'None', '07123456802', 'None (Year 3 student)'),
('P-00021', 'Mia', 'Phillips', '2015-05-01', 'Female', 'mia.phillips@student.stalph.ac.uk', '22 Magnolia Rd, Manchester', 'None', '07123456803', 'None (Year 4 student)'),
('P-00022', 'Lucas', 'Adams', '2014-11-13', 'Male', 'lucas.adams@student.stalph.ac.uk', '6 Linden St, Birmingham', 'None', '07123456804', 'None (Year 5 student)'),
('P-00023', 'Harper', 'Scott', '2013-07-25', 'Female', 'harper.scott@student.stalph.ac.uk', '28 Rowan Ave, Sheffield', 'Asthma', '07123456805', 'None (Year 6 student)'),
('P-00024', 'Grace', 'Mitchell', '1992-02-08', 'Female', 'grace.mitchell@assistant.stalph.ac.uk', '17 Holly Rd, Liverpool', 'None', '07123456806', 'B.Sc., Teaching Certificate'),
('P-00025', 'Henry', 'Taylor', '2019-04-21', 'Male', 'henry.taylor@student.stalph.ac.uk', '5 Ivy Ln, Newcastle', 'None', '07123456807', 'None (Reception student)'),
('P-00026', 'Lily', 'Walker', '2018-12-16', 'Female', 'lily.walker@student.stalph.ac.uk', '14 Juniper St, Cardiff', 'None', '07123456808', 'None (Year 1 student)'),
('P-00027', 'Jack', 'Harris', '2017-08-02', 'Male', 'jack.harris@student.stalph.ac.uk', '25 Cedar Ct, Glasgow', 'None', '07123456809', 'None (Year 2 student)'),
('P-00028', 'Ella', 'Lewis', '2016-03-29', 'Female', 'ella.lewis@student.stalph.ac.uk', '9 Birch Rd, Edinburgh', 'None', '07123456810', 'None (Year 3 student)'),
('P-00029', 'Alexander', 'Clark', '2015-11-11', 'Male', 'alexander.clark@student.stalph.ac.uk', '30 Elm Dr, London', 'None', '07123456811', 'None (Year 4 student)'),
('P-00030', 'Scarlett', 'Young', '2014-06-04', 'Female', 'scarlett.young@student.stalph.ac.uk', '12 Pine St, Manchester', 'None', '07123456812', 'None (Year 5 student)'),
('P-00031', 'Daniel', 'King', '2013-01-27', 'Male', 'daniel.king@student.stalph.ac.uk', '21 Oak Ave, Bristol', 'None', '07123456813', 'None (Year 6 student)'),
('P-00032', 'Chloe', 'Baker', '2019-07-09', 'Female', 'chloe.baker@student.stalph.ac.uk', '8 Maple Ln, Leeds', 'None', '07123456814', 'None (Reception student)'),
('P-00033', 'Thomas', 'Green', '2018-02-14', 'Male', 'thomas.green@student.stalph.ac.uk', '10 Ash St, Birmingham', 'None', '07123456815', 'None (Year 1 student)'),
('P-00034', 'Evelyn', 'Hall', '2017-09-27', 'Female', 'evelyn.hall@student.stalph.ac.uk', '16 Spruce Rd, Sheffield', 'None', '07123456816', 'None (Year 2 student)'),
('P-00035', 'Oliver', 'Wood', '2016-05-10', 'Male', 'oliver.wood@student.stalph.ac.uk', '4 Willow Dr, Liverpool', 'None', '07123456817', 'None (Year 3 student)'),
('P-00036', 'Zoe', 'James', '2015-12-23', 'Female', 'zoe.james@student.stalph.ac.uk', '29 Cedar Ln, Newcastle', 'None', '07123456818', 'None (Year 4 student)'),
('P-00037', 'Leo', 'Ward', '2014-08-06', 'Male', 'leo.ward@student.stalph.ac.uk', '13 Pine Ct, Cardiff', 'None', '07123456819', 'None (Year 5 student)'),
('P-00038', 'Ruby', 'Cox', '2013-03-19', 'Female', 'ruby.cox@student.stalph.ac.uk', '7 Oak Rd, Glasgow', 'None', '07123456820', 'None (Year 6 student)'),
('P-00039', 'Finn', 'Bell', '2019-10-02', 'Male', 'finn.bell@student.stalph.ac.uk', '20 Elm St, Edinburgh', 'None', '07123456821', 'None (Reception student)'),
('P-00040', 'Isla', 'Murphy', '2018-06-15', 'Female', 'isla.murphy@student.stalph.ac.uk', '5 Birch Ave, London', 'None', '07123456822', 'None (Year 1 student)'),
('P-00041', 'George', 'Price', '2017-01-28', 'Male', 'george.price@student.stalph.ac.uk', '11 Maple Rd, Manchester', 'None', '07123456823', 'None (Year 2 student)'),
('P-00042', 'Hannah', 'Ross', '2016-10-11', 'Female', 'hannah.ross@student.stalph.ac.uk', '26 Spruce Dr, Bristol', 'None', '07123456824', 'None (Year 3 student)'),
('P-00043', 'Samuel', 'Cook', '2015-07-04', 'Male', 'samuel.cook@student.stalph.ac.uk', '9 Cedar St, Leeds', 'None', '07123456825', 'None (Year 4 student)'),
('P-00044', 'Freya', 'Hill', '2014-02-17', 'Female', 'freya.hill@student.stalph.ac.uk', '15 Pine Ln, Birmingham', 'None', '07123456826', 'None (Year 5 student)'),
('P-00045', 'Oscar', 'Moore', '2013-11-30', 'Male', 'oscar.moore@student.stalph.ac.uk', '22 Oak Ct, Sheffield', 'None', '07123456827', 'None (Year 6 student)'),
('P-00046', 'Poppy', 'Davis', '2019-03-13', 'Female', 'poppy.davis@student.stalph.ac.uk', '3 Elm Dr, Liverpool', 'None', '07123456828', 'None (Reception student)'),
('P-00047', 'Alfie', 'Parker', '2018-09-26', 'Male', 'alfie.parker@student.stalph.ac.uk', '18 Birch Rd, Newcastle', 'None', '07123456829', 'None (Year 1 student)'),
('P-00048', 'Ellie', 'Thompson', '2017-04-08', 'Female', 'ellie.thompson@student.stalph.ac.uk', '6 Spruce St, Cardiff', 'None', '07123456830', 'None (Year 2 student)'),
('P-00049', 'Max', 'Roberts', '2016-12-21', 'Male', 'max.roberts@student.stalph.ac.uk', '24 Cedar Ave, Glasgow', 'None', '07123456831', 'None (Year 3 student)'),
('P-00050', 'Layla', 'Wilson', '2015-08-03', 'Female', 'layla.wilson@student.stalph.ac.uk', '10 Oak Ln, Edinburgh', 'None', '07123456832', 'None (Year 4 student)'),
('P-00051', 'Sarah', 'Johnson', '1987-11-15', 'Female', 'sarah.johnson@assistant.stalph.ac.uk', '8 Pine Rd, London', 'None', '07123456833', 'B.A., Teaching Assistant Cert.'),
('P-00052', 'Rachel', 'Patel', '1980-05-12', 'Female', 'rachel.patel@guardian.stalph.ac.uk', '45 Elm Rd, Manchester', 'None', '07123456834', 'None'),
('P-00053', 'Mark', 'Hughes', '1978-09-25', 'Male', 'mark.hughes@guardian.stalph.ac.uk', '7 Pine Ave, Bristol', 'None', '07123456835', 'None'),
('P-00054', 'Susan', 'Bennett', '1982-03-17', 'Female', 'susan.bennett@guardian.stalph.ac.uk', '23 Birch Ln, Leeds', 'None', '07123456836', 'None'),
('P-00055', 'David', 'Khan', '1975-11-30', 'Male', 'david.khan@guardian.stalph.ac.uk', '9 Maple Dr, Birmingham', 'None', '07123456837', 'None'),
('P-00056', 'Laura', 'Morgan', '1985-07-22', 'Female', 'laura.morgan@guardian.stalph.ac.uk', '15 Ash Rd, Liverpool', 'None', '07123456838', 'None'),
('P-00057', 'Peter', 'Brooks', '1983-01-14', 'Male', 'peter.brooks@guardian.stalph.ac.uk', '8 Willow Way, Newcastle', 'None', '07123456839', 'None'),
('P-00058', 'Emma', 'Lee', '1979-06-08', 'Female', 'emma.lee@guardian.stalph.ac.uk', '27 Spruce St, Cardiff', 'None', '07123456840', 'None'),
('P-00059', 'John', 'Wright', '1981-10-19', 'Male', 'john.wright@guardian.stalph.ac.uk', '3 Poplar Ct, Glasgow', 'None', '07123456841', 'None'),
('P-00060', 'Claire', 'Evans', '1984-04-03', 'Female', 'claire.evans@guardian.stalph.ac.uk', '19 Laurel Rd, Edinburgh', 'None', '07123456842', 'None'),
('P-00061', 'Thomas', 'Foster', '1977-12-27', 'Male', 'thomas.foster@guardian.stalph.ac.uk', '11 Sycamore Ln, Bristol', 'None', '07123456843', 'None'),
('P-00062', 'Jane', 'Gray', '1980-08-15', 'Female', 'jane.gray@guardian.stalph.ac.uk', '33 Chestnut Dr, Leeds', 'None', '07123456844', 'None'),
('P-00063', 'Michael', 'Phillips', '1982-02-09', 'Male', 'michael.phillips@guardian.stalph.ac.uk', '22 Magnolia Rd, Manchester', 'None', '07123456845', 'None'),
('P-00064', 'Sarah', 'Adams', '1986-09-11', 'Female', 'sarah.adams@guardian.stalph.ac.uk', '6 Linden St, Birmingham', 'None', '07123456846', 'None'),
('P-00065', 'Robert', 'Scott', '1976-05-04', 'Male', 'robert.scott@guardian.stalph.ac.uk', '28 Rowan Ave, Sheffield', 'None', '07123456847', 'None'),
('P-00066', 'Lisa', 'Taylor', '1983-11-28', 'Female', 'lisa.taylor@guardian.stalph.ac.uk', '5 Ivy Ln, Newcastle', 'None', '07123456848', 'None'),
('P-00067', 'Paul', 'Walker', '1981-07-16', 'Male', 'paul.walker@guardian.stalph.ac.uk', '14 Juniper St, Cardiff', 'None', '07123456849', 'None'),
('P-00068', 'Anna', 'Harris', '1979-03-20', 'Female', 'anna.harris@guardian.stalph.ac.uk', '25 Cedar Ct, Glasgow', 'None', '07123456850', 'None'),
('P-00069', 'James', 'Lewis', '1984-10-13', 'Male', 'james.lewis@guardian.stalph.ac.uk', '9 Birch Rd, Edinburgh', 'None', '07123456851', 'None'),
('P-00070', 'Kelly', 'Clark', '1980-06-07', 'Female', 'kelly.clark@guardian.stalph.ac.uk', '30 Elm Dr, London', 'None', '07123456852', 'None'),
('P-00071', 'Andrew', 'Young', '1978-12-01', 'Male', 'andrew.young@guardian.stalph.ac.uk', '12 Pine St, Manchester', 'None', '07123456853', 'None'),
('P-00072', 'Helen', 'King', '1985-04-25', 'Female', 'helen.king@guardian.stalph.ac.uk', '21 Oak Ave, Bristol', 'None', '07123456854', 'None'),
('P-00073', 'Steven', 'Baker', '1982-08-18', 'Male', 'steven.baker@guardian.stalph.ac.uk', '8 Maple Ln, Leeds', 'None', '07123456855', 'None'),
('P-00074', 'Mary', 'Green', '1977-02-11', 'Female', 'mary.green@guardian.stalph.ac.uk', '10 Ash St, Birmingham', 'None', '07123456856', 'None'),
('P-00075', 'Richard', 'Hall', '1983-09-03', 'Male', 'richard.hall@guardian.stalph.ac.uk', '16 Spruce Rd, Sheffield', 'None', '07123456857', 'None'),
('P-00076', 'Sophie', 'Wood', '1981-05-27', 'Female', 'sophie.wood@guardian.stalph.ac.uk', '4 Willow Dr, Liverpool', 'None', '07123456858', 'None'),
('P-00077', 'Daniel', 'James', '1979-11-20', 'Male', 'daniel.james@guardian.stalph.ac.uk', '29 Cedar Ln, Newcastle', 'None', '07123456859', 'None'),
('P-00078', 'Rebecca', 'Ward', '1984-07-14', 'Female', 'rebecca.ward@guardian.stalph.ac.uk', '13 Pine Ct, Cardiff', 'None', '07123456860', 'None'),
('P-00079', 'George', 'Cox', '1980-03-08', 'Male', 'george.cox@guardian.stalph.ac.uk', '7 Oak Rd, Glasgow', 'None', '07123456861', 'None'),
('P-00080', 'Linda', 'Bell', '1982-10-01', 'Female', 'linda.bell@guardian.stalph.ac.uk', '20 Elm St, Edinburgh', 'None', '07123456862', 'None'),
('P-00081', 'Edward', 'Murphy', '1978-06-24', 'Male', 'edward.murphy@guardian.stalph.ac.uk', '5 Birch Ave, London', 'None', '07123456863', 'None'),
('P-00082', 'Julie', 'Price', '1985-01-17', 'Female', 'julie.price@guardian.stalph.ac.uk', '11 Maple Rd, Manchester', 'None', '07123456864', 'None'),
('P-00083', 'Brian', 'Ross', '1983-08-10', 'Male', 'brian.ross@guardian.stalph.ac.uk', '26 Spruce Dr, Bristol', 'None', '07123456865', 'None'),
('P-00084', 'Kate', 'Cook', '1979-04-04', 'Female', 'kate.cook@guardian.stalph.ac.uk', '9 Cedar St, Leeds', 'None', '07123456866', 'None'),
('P-00085', 'Martin', 'Hill', '1981-12-28', 'Male', 'martin.hill@guardian.stalph.ac.uk', '15 Pine Ln, Birmingham', 'None', '07123456867', 'None'),
('P-00086', 'Nancy', 'Moore', '1984-06-21', 'Female', 'nancy.moore@guardian.stalph.ac.uk', '22 Oak Ct, Sheffield', 'None', '07123456868', 'None'),
('P-00087', 'Philip', 'Davis', '1977-10-15', 'Male', 'philip.davis@guardian.stalph.ac.uk', '3 Elm Dr, Liverpool', 'None', '07123456869', 'None'),
('P-00088', 'Alice', 'Parker', '1982-02-07', 'Female', 'alice.parker@guardian.stalph.ac.uk', '18 Birch Rd, Newcastle', 'None', '07123456870', 'None'),
('P-00089', 'Charles', 'Thompson', '1980-09-30', 'Male', 'charles.thompson@guardian.stalph.ac.uk', '6 Spruce St, Cardiff', 'None', '07123456871', 'None'),
('P-00090', 'Diana', 'Roberts', '1983-05-23', 'Female', 'diana.roberts@guardian.stalph.ac.uk', '24 Cedar Ave, Glasgow', 'None', '07123456872', 'None'),
('P-00091', 'Henry', 'Wilson', '1978-11-16', 'Male', 'henry.wilson@guardian.stalph.ac.uk', '10 Oak Ln, Edinburgh', 'None', '07123456873', 'None'),
('P-00092', 'Mahd', 'Raihan', '2004-08-14', 'Male', 'mahdraihan@outlook.com', 'University Academy 92 Old Trafford Manchester', 'Nill', '+441234123456', 'Nill'),
('P-00093', 'Mahd', 'Raihan', '2004-08-14', 'Male', 'mahdraihan1@outlook.com', 'University Academy 92 Old Trafford Manchester', 'Nill', '+441234123456', 'Nill'),
('P-00094', 'Mahd', 'Raihan', '1999-12-12', 'Male', 'mahdraihan21@outlook.com', 'University Academy 92 Old Trafford Manchester', 'Nill', '+441234123456', 'Nill');

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

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `person_id`, `class_id`, `subject`, `fee`, `fee_status`, `student_status`, `enroll_date`) VALUES
('STD-00001', 'P-00008', 'CLR-00001', 'Core Curriculum', 500, 'Pending', 'Active', '2024-09-01'),
('STD-00002', 'P-00009', 'CLR-00002', 'Core Curriculum', 500, 'Pending', 'Active', '2024-09-02'),
('STD-00003', 'P-00010', 'CLR-00003', 'Core Curriculum', 500, 'Overdue', 'Suspended', '2024-09-03'),
('STD-00004', 'P-00011', 'CLR-00004', 'Core Curriculum', 500, 'Paid', 'Active', '2024-09-04'),
('STD-00005', 'P-00013', 'CLR-00005', 'Core Curriculum', 500, 'Pending', 'Inactive', '2024-09-05'),
('STD-00006', 'P-00014', 'CLR-00006', 'Core Curriculum', 500, 'Overdue', 'Active', '2024-09-06'),
('STD-00007', 'P-00015', 'CLR-00007', 'Core Curriculum', 500, 'Paid', 'Active', '2024-09-07'),
('STD-00008', 'P-00016', 'CLR-00001', 'Core Curriculum', 500, 'Pending', 'Active', '2024-09-08'),
('STD-00009', 'P-00017', 'CLR-00002', 'Core Curriculum', 500, 'Paid', 'Inactive', '2024-09-09'),
('STD-00010', 'P-00019', 'CLR-00003', 'Core Curriculum', 500, 'Overdue', 'Suspended', '2024-09-10'),
('STD-00011', 'P-00020', 'CLR-00004', 'Core Curriculum', 500, 'Paid', 'Active', '2024-09-11'),
('STD-00012', 'P-00021', 'CLR-00005', 'Core Curriculum', 500, 'Pending', 'Active', '2024-09-12'),
('STD-00013', 'P-00022', 'CLR-00006', 'Core Curriculum', 500, 'Overdue', 'Inactive', '2024-09-13'),
('STD-00014', 'P-00023', 'CLR-00007', 'Core Curriculum', 500, 'Paid', 'Active', '2024-09-14'),
('STD-00015', 'P-00025', 'CLR-00001', 'Core Curriculum', 500, 'Pending', 'Active', '2024-09-15'),
('STD-00016', 'P-00026', 'CLR-00002', 'Core Curriculum', 500, 'Paid', 'Suspended', '2024-09-16'),
('STD-00017', 'P-00027', 'CLR-00003', 'Core Curriculum', 500, 'Overdue', 'Active', '2024-09-17'),
('STD-00018', 'P-00028', 'CLR-00004', 'Core Curriculum', 500, 'Paid', 'Active', '2024-09-18'),
('STD-00019', 'P-00029', 'CLR-00005', 'Core Curriculum', 500, 'Pending', 'Inactive', '2024-09-19'),
('STD-00020', 'P-00030', 'CLR-00006', 'Core Curriculum', 500, 'Overdue', 'Active', '2024-09-20'),
('STD-00021', 'P-00031', 'CLR-00007', 'Core Curriculum', 500, 'Paid', 'Active', '2024-09-21'),
('STD-00022', 'P-00032', 'CLR-00001', 'Core Curriculum', 500, 'Pending', 'Active', '2024-09-22'),
('STD-00023', 'P-00033', 'CLR-00002', 'Core Curriculum', 500, 'Paid', 'Inactive', '2024-09-23'),
('STD-00024', 'P-00034', 'CLR-00003', 'Core Curriculum', 500, 'Overdue', 'Suspended', '2024-09-24'),
('STD-00025', 'P-00035', 'CLR-00004', 'Core Curriculum', 500, 'Paid', 'Active', '2024-09-25'),
('STD-00026', 'P-00036', 'CLR-00005', 'Core Curriculum', 500, 'Pending', 'Active', '2024-09-26'),
('STD-00027', 'P-00037', 'CLR-00006', 'Core Curriculum', 500, 'Overdue', 'Inactive', '2024-09-27'),
('STD-00028', 'P-00038', 'CLR-00007', 'Core Curriculum', 500, 'Paid', 'Active', '2024-09-28'),
('STD-00029', 'P-00039', 'CLR-00001', 'Core Curriculum', 500, 'Pending', 'Active', '2024-09-29'),
('STD-00030', 'P-00040', 'CLR-00002', 'Core Curriculum', 500, 'Paid', 'Suspended', '2024-09-30'),
('STD-00031', 'P-00041', 'CLR-00003', 'Core Curriculum', 500, 'Overdue', 'Active', '2024-10-01'),
('STD-00032', 'P-00042', 'CLR-00004', 'Core Curriculum', 500, 'Paid', 'Active', '2024-10-02'),
('STD-00033', 'P-00043', 'CLR-00005', 'Core Curriculum', 500, 'Pending', 'Inactive', '2024-10-03'),
('STD-00034', 'P-00044', 'CLR-00006', 'Core Curriculum', 500, 'Overdue', 'Active', '2024-10-04'),
('STD-00035', 'P-00045', 'CLR-00007', 'Core Curriculum', 500, 'Paid', 'Active', '2024-10-05'),
('STD-00036', 'P-00046', 'CLR-00001', 'Core Curriculum', 500, 'Pending', 'Active', '2024-10-06'),
('STD-00037', 'P-00047', 'CLR-00002', 'Core Curriculum', 500, 'Paid', 'Inactive', '2024-10-07'),
('STD-00038', 'P-00048', 'CLR-00003', 'Core Curriculum', 500, 'Overdue', 'Suspended', '2024-10-08'),
('STD-00039', 'P-00049', 'CLR-00004', 'Core Curriculum', 500, 'Paid', 'Active', '2024-10-09'),
('STD-00040', 'P-00050', 'CLR-00005', 'Core Curriculum', 500, 'Pending', 'Active', '2024-10-10'),
('STD-00041', 'P-00094', 'CLR-00002', 'Core', 2000, 'Paid', 'Active', '2025-04-11');

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

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacher_id`, `person_id`, `enroll_date`, `salary`, `hours`) VALUES
('TC-00001', 'P-00001', '2025-04-05', 2500, 40),
('TC-00002', 'P-00002', '2025-04-05', 3500, 50),
('TC-00003', 'P-00003', '2025-04-05', 4000, 34),
('TC-00004', 'P-00004', '2025-04-05', 1500, 12),
('TC-00005', 'P-00005', '2025-04-05', 3500, 49),
('TC-00006', 'P-00006', '2025-04-05', 4600, 40),
('TC-00007', 'P-00007', '2025-04-05', 2300, 20);

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
(1, 'Mahd12345', '$2y$10$XS1G7NcTD9vC6Xy5.rHSGuryn8LVaOuZ3X/U5TF/4EURzZB3CZeSK', 'P-00001');

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
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `class_assistant`
--
ALTER TABLE `class_assistant`
  MODIFY `class_assistant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `dinner_money`
--
ALTER TABLE `dinner_money`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `guardian`
--
ALTER TABLE `guardian`
  MODIFY `guardian_index_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `library_transaction`
--
ALTER TABLE `library_transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

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
