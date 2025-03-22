-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2025 at 06:36 PM
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
('A-00001', 'P-00028', '2025-03-15', 1800, 40),
('A-00002', 'P-00029', '2025-03-15', 1900, 40),
('A-00003', 'P-00030', '2025-03-15', 2000, 40);

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

--
-- Dumping data for table `attendance_assistant`
--

INSERT INTO `attendance_assistant` (`attendance_id`, `assistant_id`, `class_id`, `attendance_date`, `attendance_status`, `remarks`) VALUES
(1, 'A-00001', 'CLR-00001', '2025-03-10', 'Present', 'Assisted with classroom setup and student activities.'),
(2, 'A-00002', 'CLR-00002', '2025-03-11', 'Absent', 'Sick leave, informed in advance.'),
(3, 'A-00003', 'CLR-00003', '2025-03-12', 'Leave', 'Personal leave, pre-approved by the teacher.'),
(4, 'A-00001', 'CLR-00004', '2025-03-13', 'Present', 'Assisted with materials and supported students during the lesson.'),
(5, 'A-00002', 'CLR-00005', '2025-03-14', 'Absent', 'Unable to attend due to a family emergency.'),
(6, 'A-00003', 'CLR-00006', '2025-03-15', 'Present', 'Assisted in managing the classroom, supported students.'),
(7, 'A-00001', 'CLR-00007', '2025-03-16', 'Leave', 'Pre-approved leave for personal reasons.'),
(8, 'A-00002', 'CLR-00001', '2025-03-17', 'Present', 'Supported teacher during a class activity and managed students.'),
(9, 'A-00003', 'CLR-00002', '2025-03-18', 'Absent', 'Medical leave, unable to attend.'),
(10, 'A-00001', 'CLR-00003', '2025-03-19', 'Present', 'On time, managed student queries effectively.'),
(11, 'A-00002', 'CLR-00004', '2025-03-20', 'Leave', 'Scheduled leave for a personal appointment.'),
(12, 'A-00003', 'CLR-00005', '2025-03-21', 'Present', 'Assisted with the setup and engaged with students.'),
(13, 'A-00001', 'CLR-00006', '2025-03-22', 'Absent', 'Unable to attend due to unforeseen circumstances.'),
(14, 'A-00002', 'CLR-00007', '2025-03-23', 'Present', 'Attended class on time and helped students with tasks.'),
(15, 'A-00003', 'CLR-00001', '2025-03-24', 'Present', 'Supported students during a practical session.'),
(16, 'A-00001', 'CLR-00002', '2025-03-25', 'Leave', 'Leave granted for a family event, notified in advance.'),
(17, 'A-00002', 'CLR-00003', '2025-03-26', 'Absent', 'Absent due to an urgent matter at home.'),
(18, 'A-00003', 'CLR-00004', '2025-03-27', 'Present', 'Assisted the teacher in lesson delivery.'),
(19, 'A-00001', 'CLR-00005', '2025-03-28', 'Leave', 'Leave for personal reasons, approved in advance.'),
(20, 'A-00002', 'CLR-00006', '2025-03-29', 'Present', 'Assisted in class activities and managed student behavior.');

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

--
-- Dumping data for table `attendance_student`
--

INSERT INTO `attendance_student` (`attendance_id`, `student_id`, `attendance_date`, `attendance_status`, `remarks`) VALUES
(1, 'STD-00001', '2025-03-10', 'Present', 'Arrived on time, engaged in class activities.'),
(2, 'STD-00002', '2025-03-11', 'Absent', 'Was absent due to illness, parents notified.'),
(3, 'STD-00003', '2025-03-12', 'Leave', 'Had pre-approved leave for a family event.'),
(4, 'STD-00004', '2025-03-13', 'Present', 'Completed all tasks and participated actively.'),
(5, 'STD-00005', '2025-03-14', 'Absent', 'Family emergency, missed the class.'),
(6, 'STD-00006', '2025-03-15', 'Present', 'Present and participated well in group activities.'),
(7, 'STD-00007', '2025-03-16', 'Leave', 'Personal leave, no class participation.'),
(8, 'STD-00008', '2025-03-17', 'Present', 'Participated in class and completed all assignments.'),
(9, 'STD-00009', '2025-03-18', 'Absent', 'Missed the class due to medical appointment.'),
(10, 'STD-00010', '2025-03-19', 'Leave', 'Pre-approved leave for school event.'),
(11, 'STD-00001', '2025-03-20', 'Present', 'Engaged in all activities, on time.'),
(12, 'STD-00002', '2025-03-21', 'Absent', 'Sick, unable to attend class.'),
(13, 'STD-00003', '2025-03-22', 'Present', 'Participated well, no issues.'),
(14, 'STD-00004', '2025-03-23', 'Present', 'Completed all work on time, no absences.'),
(15, 'STD-00005', '2025-03-24', 'Leave', 'Scheduled leave, personal matter.'),
(16, 'STD-00006', '2025-03-25', 'Present', 'Arrived early, fully participated.'),
(17, 'STD-00007', '2025-03-26', 'Absent', 'Missed due to unforeseen circumstances.'),
(18, 'STD-00008', '2025-03-27', 'Present', 'On time, class engagement was excellent.'),
(19, 'STD-00009', '2025-03-28', 'Leave', 'Leave due to personal reasons, notified in advance.'),
(20, 'STD-00010', '2025-03-29', 'Absent', 'Absent due to transportation issues.');

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
(1, 'TC-00001', '2025-03-10', 'Present', 'On time and prepared for the class.'),
(2, 'TC-00002', '2025-03-11', 'Absent', 'Sick leave, notified in advance.'),
(3, 'TC-00003', '2025-03-12', 'Leave', 'Personal leave, pre-approved.'),
(4, 'TC-00004', '2025-03-13', 'Present', 'Fully engaged with students.'),
(5, 'TC-00005', '2025-03-14', 'Absent', 'Emergency leave, unable to attend.'),
(6, 'TC-00006', '2025-03-15', 'Present', 'Conducted a successful class.'),
(7, 'TC-00007', '2025-03-16', 'Leave', 'Scheduled leave for personal reasons.'),
(8, 'TC-00001', '2025-03-17', 'Present', 'Prepared lesson plan, active participation.'),
(9, 'TC-00002', '2025-03-18', 'Absent', 'Unwell, no prior notice.'),
(10, 'TC-00004', '2025-03-20', 'Leave', 'Attending a professional development seminar.'),
(11, 'TC-00005', '2025-03-21', 'Present', 'All lessons were delivered as planned.'),
(12, 'TC-00006', '2025-03-22', 'Absent', 'Family emergency, could not attend.'),
(13, 'TC-00007', '2025-03-23', 'Present', 'Great feedback from students, lesson completed successfully.'),
(14, 'TC-00001', '2025-03-24', 'Present', 'Lesson delivered well, no issues.'),
(15, 'TC-00002', '2025-03-25', 'Leave', 'Leave approved in advance for a family event.'),
(16, 'TC-00003', '2025-03-26', 'Absent', 'Notified late, personal issue.'),
(17, 'TC-00004', '2025-03-27', 'Present', 'Lesson went well, students engaged.');

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
('CLR-00001', 'Reception Year', 201, 25, 'TC-00001'),
('CLR-00002', 'Year One', 202, 30, 'TC-00002'),
('CLR-00003', 'Year Two', 203, 28, 'TC-00003'),
('CLR-00004', 'Year Three', 204, 32, 'TC-00004'),
('CLR-00005', 'Year Four', 205, 30, 'TC-00005'),
('CLR-00006', 'Year Five', 206, 28, 'TC-00006'),
('CLR-00007', 'Year Six', 207, 35, 'TC-00007');

-- --------------------------------------------------------

--
-- Table structure for table `class_assistant`
--

CREATE TABLE `class_assistant` (
  `assistant_id` varchar(12) NOT NULL,
  `class_id` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_assistant`
--

INSERT INTO `class_assistant` (`assistant_id`, `class_id`) VALUES
('A-00001', 'CLR-00001'),
('A-00001', 'CLR-00002'),
('A-00002', 'CLR-00003'),
('A-00002', 'CLR-00004'),
('A-00003', 'CLR-00005'),
('A-00003', 'CLR-00006');

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
(1, 'STD-00001', '2025-03-10', 3.5, 3.5, 0, 'Paid'),
(2, 'STD-00002', '2025-03-12', 3.5, 3.5, 0, 'Paid'),
(3, 'STD-00003', '2025-03-14', 3.5, 0, 3.5, 'Paid'),
(4, 'STD-00004', '2025-03-16', 3.5, 3.5, 0, 'Paid'),
(5, 'STD-00005', '2025-03-18', 3.5, 3.5, 0, 'Paid'),
(6, 'STD-00006', '2025-03-20', 3.5, 0, 3.5, 'Pending'),
(7, 'STD-00007', '2025-03-22', 3.5, 3.5, 0, 'Paid'),
(8, 'STD-00008', '2025-03-24', 3.5, 0, 3.5, 'Overdue'),
(9, 'STD-00009', '2025-03-26', 3.5, 3.5, 0, 'Paid'),
(10, 'STD-00010', '2025-03-28', 3.5, 0, 3.5, 'Overdue'),
(11, 'STD-00001', '2025-03-29', 3.5, 3.5, 0, 'Paid'),
(12, 'STD-00002', '2025-03-30', 3.5, 0, 3.5, 'Pending'),
(13, 'STD-00003', '2025-03-31', 3.5, 3.5, 0, 'Paid'),
(14, 'STD-00004', '2025-04-01', 3.5, 3.5, 0, 'Paid'),
(15, 'STD-00005', '2025-04-02', 3.5, 0, 3.5, 'Pending'),
(16, 'STD-00006', '2025-04-03', 3.5, 3.5, 0, 'Paid'),
(17, 'STD-00007', '2025-04-04', 3.5, 0, 3.5, 'Overdue'),
(18, 'STD-00008', '2025-04-05', 3.5, 3.5, 0, 'Paid'),
(19, 'STD-00009', '2025-04-06', 3.5, 3.5, 0, 'Paid'),
(20, 'STD-00010', '2025-04-07', 3.5, 0, 3.5, 'Overdue');

-- --------------------------------------------------------

--
-- Table structure for table `guardian`
--

CREATE TABLE `guardian` (
  `guardian_id` varchar(12) NOT NULL,
  `student_id` varchar(12) NOT NULL,
  `relation` enum('Mother','Father','Family','Other') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guardian`
--

INSERT INTO `guardian` (`guardian_id`, `student_id`, `relation`) VALUES
('P-00031', 'STD-00001', 'Mother'),
('P-00033', 'STD-00002', 'Mother'),
('P-00034', 'STD-00002', 'Father'),
('P-00035', 'STD-00003', 'Family'),
('P-00036', 'STD-00003', 'Father'),
('P-00031', 'STD-00004', 'Mother'),
('P-00033', 'STD-00005', 'Mother'),
('P-00034', 'STD-00005', 'Family'),
('P-00035', 'STD-00006', 'Father'),
('P-00036', 'STD-00006', 'Other'),
('P-00031', 'STD-00007', 'Mother'),
('P-00033', 'STD-00008', 'Family'),
('P-00034', 'STD-00008', 'Father'),
('P-00035', 'STD-00009', 'Mother'),
('P-00036', 'STD-00009', 'Father'),
('P-00031', 'STD-00010', 'Mother'),
('P-00006', 'STD-00001', 'Family');

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
('BK-00001', 'Mathematics Made Easy', 'John Smith', '2015-08-01'),
('BK-00002', 'Science for Kids', 'Jane Doe', '2016-05-20'),
('BK-00003', 'History of the World', 'Emily Clark', '2014-12-10'),
('BK-00004', 'Understanding Geography', 'Robert Brown', '2017-01-15'),
('BK-00005', 'English Grammar Basics', 'Samantha Green', '2018-06-05'),
('BK-00006', 'Art and Creativity', 'Michael White', '2016-09-25'),
('BK-00007', 'The Adventures of Tom Sawyer', 'Mark Twain', '1876-04-01'),
('BK-00008', 'The Little Prince', 'Antoine de Saint-Exupéry', '1943-04-06'),
('BK-00009', 'The Lion, the Witch, and the Wardrobe', 'C.S. Lewis', '1950-10-16'),
('BK-00010', 'Harry Potter and the Sorcerer\'s Stone', 'J.K. Rowling', '1997-06-26'),
('BK-00011', 'Mathematics for Young Minds', 'Lucy White', '2015-03-12'),
('BK-00012', 'Learn to Read and Write', 'David Johnson', '2019-11-14'),
('BK-00013', 'Space Explorers', 'Chris Green', '2018-04-02'),
('BK-00014', 'The Wind in the Willows', 'Kenneth Grahame', '1908-01-01'),
('BK-00015', 'The Tale of Peter Rabbit', 'Beatrix Potter', '1902-12-14'),
('BK-00016', 'The Magic School Bus', 'Joanna Cole', '1986-09-10'),
('BK-00017', 'The Secret Garden', 'Frances Hodgson Burnett', '1911-08-01'),
('BK-00018', 'Charlotte\'s Web', 'E.B. White', '1952-10-15'),
('BK-00019', 'Winnie-the-Pooh', 'A.A. Milne', '1926-10-14'),
('BK-00020', 'Charlie and the Chocolate Factory', 'Roald Dahl', '1964-01-01'),
('BK-00021', 'The Berenstain Bears and the Big Road Race', 'Stan and Jan Berenstain', '1995-06-01'),
('BK-00022', 'A Wrinkle in Time', 'Madeleine L\'Engle', '1962-01-01'),
('BK-00023', 'Percy Jackson and the Olympians', 'Rick Riordan', '2005-06-28'),
('BK-00024', 'Anne of Green Gables', 'Lucy Maud Montgomery', '1908-06-01'),
('BK-00025', 'The Cat in the Hat', 'Dr. Seuss', '1957-03-12'),
('BK-00026', 'Where the Red Fern Grows', 'Wilson Rawls', '1961-09-01'),
('BK-00027', 'The Phantom Tollbooth', 'Norton Juster', '1961-09-01'),
('BK-00028', 'The Ugly Duckling', 'Hans Christian Andersen', '1843-01-01'),
('BK-00029', 'The Snowy Day', 'Ezra Jack Keats', '1962-01-01'),
('BK-00030', 'The Velveteen Rabbit', 'Margery Williams', '1922-11-21'),
('BK-00031', 'Little House on the Prairie', 'Laura Ingalls Wilder', '1935-03-15'),
('BK-00032', 'The Gruffalo', 'Julia Donaldson', '1999-03-01'),
('BK-00033', 'The Rainbow Fish', 'Marcus Pfister', '1992-01-01'),
('BK-00034', 'The Very Hungry Caterpillar', 'Eric Carle', '1969-03-01'),
('BK-00035', 'Goodnight Moon', 'Margaret Wise Brown', '1947-09-03'),
('BK-00036', 'Brown Bear, Brown Bear, What Do You See?', 'Bill Martin Jr.', '1967-03-03'),
('BK-00037', 'Guess How Much I Love You', 'Sam McBratney', '1994-10-01'),
('BK-00038', 'Green Eggs and Ham', 'Dr. Seuss', '1960-08-12'),
('BK-00039', 'The Giving Tree', 'Shel Silverstein', '1964-10-07'),
('BK-00040', 'The Little Engine That Could', 'Watty Piper', '1930-04-01'),
('BK-00041', 'The Pigeon Needs a Bath!', 'Mo Willems', '2014-06-10'),
('BK-00042', 'The Fantastic Flying Books of Mr. Morris Lessmore', 'William Joyce', '2012-03-01'),
('BK-00043', 'Pete the Cat', 'Eric Litwin', '2010-02-01'),
('BK-00044', 'If You Give a Mouse a Cookie', 'Laura Joffe Numeroff', '1985-07-01'),
('BK-00045', 'The Mitten', 'Jan Brett', '1989-01-01'),
('BK-00046', 'The Little Red Hen', 'Paul Galdone', '1973-01-01'),
('BK-00047', 'The Little House', 'Virginia Lee Burton', '1942-01-01'),
('BK-00048', 'How the Grinch Stole Christmas!', 'Dr. Seuss', '1957-10-12'),
('BK-00049', 'I Am Too Absolutely Small for School', 'Lauren Child', '2000-04-01'),
('BK-00050', 'I Can Read With My Eyes Shut!', 'Dr. Seuss', '1978-09-12');

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
(1, 'STD-00001', 'BK-00001', '2025-03-10', '2025-03-20', 'Pending'),
(2, 'STD-00002', 'BK-00002', '2025-03-12', '2025-03-22', 'Returned'),
(3, 'STD-00003', 'BK-00003', '2025-03-15', '2025-03-25', 'Pending'),
(4, 'STD-00004', 'BK-00004', '2025-03-17', '2025-03-27', 'Pending'),
(5, 'STD-00005', 'BK-00005', '2025-03-18', '2025-03-28', 'Returned'),
(6, 'STD-00006', 'BK-00006', '2025-03-20', '2025-03-30', 'Returned'),
(7, 'STD-00007', 'BK-00007', '2025-03-22', '2025-04-01', 'Overdue'),
(8, 'STD-00008', 'BK-00008', '2025-03-23', '2025-04-02', 'Returned'),
(9, 'STD-00009', 'BK-00009', '2025-03-24', '2025-04-03', 'Pending'),
(10, 'STD-00010', 'BK-00010', '2025-03-25', '2025-04-05', 'Returned'),
(11, 'STD-00001', 'BK-00011', '2025-03-26', '2025-04-05', 'Returned'),
(12, 'STD-00002', 'BK-00012', '2025-03-27', '2025-04-06', 'Pending'),
(13, 'STD-00003', 'BK-00013', '2025-03-28', '2025-04-07', 'Returned'),
(14, 'STD-00004', 'BK-00014', '2025-03-29', '2025-04-08', 'Pending'),
(15, 'STD-00005', 'BK-00015', '2025-03-30', '2025-04-09', 'Returned'),
(16, 'STD-00006', 'BK-00016', '2025-04-01', '2025-04-11', 'Overdue'),
(17, 'STD-00007', 'BK-00017', '2025-04-02', '2025-04-12', 'Pending'),
(18, 'STD-00008', 'BK-00018', '2025-04-03', '2025-04-13', 'Returned'),
(19, 'STD-00009', 'BK-00019', '2025-04-04', '2025-04-14', 'Returned'),
(20, 'STD-00010', 'BK-00020', '2025-04-05', '2025-04-15', 'Returned'),
(21, 'STD-00001', 'BK-00001', '2024-12-02', '2024-12-03', 'Pending');

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
('P-00001', 'John', 'Wick', '1890-08-09', 'Male', 'wickj@gmail.com', '10 Pinkroad Drive', 'Severe Asthmatic And Allergic to peanuts', '0161 123 123', 'PHD in Data Science'),
('P-00002', 'Emma', 'Johnson', '2016-05-12', 'Female', 'emmaj16@gmail.com', '2 Greenway Street', 'None', '07456 789 001', 'None'),
('P-00003', 'Noah', 'Smith', '2014-09-22', 'Male', 'noahs14@gmail.com', '5 Bluebell Lane', 'Peanut Allergy', '07456 789 002', 'None'),
('P-00004', 'Olivia', 'Brown', '2015-03-15', 'Female', 'oliviab15@gmail.com', '8 Oakwood Drive', 'Asthma', '07456 789 003', 'None'),
('P-00005', 'Liam', 'Williams', '2013-07-08', 'Male', 'liamw13@gmail.com', '3 Willow Road', 'None', '07456 789 004', 'None'),
('P-00006', 'Ava', 'Miller', '2016-11-30', 'Female', 'avam16@gmail.com', '6 Pine Avenue', 'Lactose Intolerant', '07456 789 005', 'None'),
('P-00007', 'James', 'Davis', '2012-06-18', 'Male', 'jamesd12@gmail.com', '12 Birch Close', 'None', '07456 789 006', 'None'),
('P-00008', 'Charlotte', 'Wilson', '2015-02-05', 'Female', 'charlottew15@gmail.com', '4 Maple Court', 'None', '07456 789 007', 'None'),
('P-00009', 'Lucas', 'Moore', '2014-12-27', 'Male', 'lucasm14@gmail.com', '7 Cherry Grove', 'Diabetic', '07456 789 008', 'None'),
('P-00010', 'Isabella', 'Taylor', '2013-08-10', 'Female', 'isabellat13@gmail.com', '10 Sycamore Way', 'None', '07456 789 009', 'None'),
('P-00011', 'Mason', 'Anderson', '2017-01-29', 'Male', 'masona17@gmail.com', '1 Rose Lane', 'Epilepsy', '07456 789 010', 'None'),
('P-00021', 'Sophia', 'Harris', '1985-04-16', 'Female', 'sophiah85@gmail.com', '23 Elm Street', 'None', '07456 789 011', 'B.Ed in Primary Education'),
('P-00022', 'Benjamin', 'White', '1978-11-20', 'Male', 'benjaminw78@gmail.com', '19 Cedar Road', 'Hypertension', '07456 789 012', 'M.Ed in Mathematics'),
('P-00023', 'Emily', 'Clark', '1990-07-05', 'Female', 'emilyc90@gmail.com', '15 Beech Avenue', 'None', '07456 789 013', 'B.Ed in English'),
('P-00024', 'Henry', 'Lewis', '1982-09-14', 'Male', 'henryl82@gmail.com', '30 Willow Street', 'None', '07456 789 014', 'M.Ed in Science'),
('P-00025', 'Ella', 'Scott', '1992-02-18', 'Female', 'ellasc92@gmail.com', '14 Fir Close', 'None', '07456 789 015', 'B.Ed in Arts'),
('P-00026', 'Daniel', 'Hall', '1987-12-03', 'Male', 'danielh87@gmail.com', '22 Ashwood Lane', 'None', '07456 789 016', 'M.Ed in Physical Education'),
('P-00027', 'Victoria', 'Adams', '1980-06-25', 'Female', 'victoriaa80@gmail.com', '26 Poplar Drive', 'None', '07456 789 017', 'B.Ed in Music'),
('P-00028', 'Hannah', 'Baker', '1995-09-10', 'Female', 'hannahb95@gmail.com', '11 Lilac Street', 'None', '07456 789 018', 'Diploma in Teaching Assistance'),
('P-00029', 'Jacob', 'Martin', '1998-04-28', 'Male', 'jacobm98@gmail.com', '9 Hawthorn Grove', 'None', '07456 789 019', 'Diploma in Early Childhood Education'),
('P-00030', 'Sophie', 'Rodriguez', '1996-03-07', 'Female', 'sophier96@gmail.com', '7 Mulberry Lane', 'None', '07456 789 020', 'Diploma in Special Education'),
('P-00031', 'Michael', 'Johnson', '1982-08-15', 'Male', 'michaelj82@gmail.com', '2 Greenway Street', 'None', '07456 789 021', 'None'),
('P-00033', 'Robert', 'Brown', '1979-02-17', 'Male', 'robertb79@gmail.com', '8 Oakwood Drive', 'None', '07456 789 023', 'None'),
('P-00034', 'Laura', 'Williams', '1984-10-30', 'Female', 'lauraw84@gmail.com', '3 Willow Road', 'None', '07456 789 024', 'None'),
('P-00035', 'David', 'Miller', '1981-07-12', 'Male', 'davidm81@gmail.com', '6 Pine Avenue', 'None', '07456 789 025', 'None'),
('P-00036', 'Jessica', 'Davis', '1983-12-05', 'Female', 'jessicad83@gmail.com', '12 Birch Close', 'None', '07456 789 026', 'None');

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
('STD-00001', 'P-00002', 'CLR-00001', 'CompSci', 1000, 'Paid', 'Active', '2025-03-15'),
('STD-00002', 'P-00003', 'CLR-00001', 'Biology', 1000, 'Pending', 'Active', '2025-03-15'),
('STD-00003', 'P-00004', 'CLR-00002', 'Maths', 1200, 'Pending', 'Active', '2025-03-15'),
('STD-00004', 'P-00005', 'CLR-00002', 'CompSci', 1100, 'Paid', 'Active', '2025-03-15'),
('STD-00005', 'P-00006', 'CLR-00003', 'Biology', 1000, 'Paid', 'Active', '2025-03-15'),
('STD-00006', 'P-00007', 'CLR-00003', 'Maths', 1200, 'Paid', 'Active', '2025-03-15'),
('STD-00007', 'P-00008', 'CLR-00004', 'CompSci', 1100, 'Pending', 'Active', '2025-03-15'),
('STD-00008', 'P-00009', 'CLR-00004', 'Biology', 1000, 'Paid', 'Active', '2025-03-15'),
('STD-00009', 'P-00010', 'CLR-00005', 'Maths', 1200, 'Paid', 'Active', '2025-03-15'),
('STD-00010', 'P-00011', 'CLR-00005', 'CompSci', 1100, 'Paid', 'Suspended', '2025-03-15');

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
('TC-00001', 'P-00021', '2025-03-15', 2300, 40),
('TC-00002', 'P-00022', '2025-03-15', 2400, 40),
('TC-00003', 'P-00023', '2025-03-15', 2600, 40),
('TC-00004', 'P-00024', '2025-03-15', 2800, 40),
('TC-00005', 'P-00025', '2025-03-15', 3000, 40),
('TC-00006', 'P-00026', '2025-03-15', 3200, 40),
('TC-00007', 'P-00027', '2025-03-15', 3400, 40);

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
  ADD KEY `assistant_id` (`assistant_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `attendance_student`
--
ALTER TABLE `attendance_student`
  ADD PRIMARY KEY (`attendance_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `attendance_teacher`
--
ALTER TABLE `attendance_teacher`
  ADD PRIMARY KEY (`attendance_id`),
  ADD KEY `teacher_id` (`teacher_id`);

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
  ADD KEY `assistant_id` (`assistant_id`),
  ADD KEY `class_id` (`class_id`);

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
  ADD KEY `guardian_id` (`guardian_id`),
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
  ADD KEY `user_person_id` (`person_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance_assistant`
--
ALTER TABLE `attendance_assistant`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `attendance_student`
--
ALTER TABLE `attendance_student`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `attendance_teacher`
--
ALTER TABLE `attendance_teacher`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `dinner_money`
--
ALTER TABLE `dinner_money`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `library_transaction`
--
ALTER TABLE `library_transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `admin_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
