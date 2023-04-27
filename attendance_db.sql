-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2020 at 08:08 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attendance_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_ID` int(11) NOT NULL,
  `admin_name` varchar(45) NOT NULL,
  `admin_username` varchar(45) NOT NULL,
  `admin_password` varchar(45) NOT NULL,
  `admin_departmentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_ID`, `admin_name`, `admin_username`, `admin_password`, `admin_departmentID`) VALUES
(1, 'Farhat Ullah', 'admincs', 'admincs', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attendance`
--

CREATE TABLE `tbl_attendance` (
  `att_ID` int(11) NOT NULL,
  `att_date` datetime NOT NULL,
  `att_status` varchar(10) NOT NULL,
  `att_studentID` int(11) NOT NULL,
  `att_groupID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_batch`
--

CREATE TABLE `tbl_batch` (
  `bat_ID` int(11) NOT NULL,
  `bat_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_batch`
--

INSERT INTO `tbl_batch` (`bat_ID`, `bat_name`) VALUES
(1, '1B'),
(2, '2B'),
(3, '3B');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_departments`
--

CREATE TABLE `tbl_departments` (
  `dep_ID` int(11) NOT NULL,
  `dep_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_departments`
--

INSERT INTO `tbl_departments` (`dep_ID`, `dep_name`) VALUES
(1, 'Computer Science'),
(2, 'Political Science'),
(3, 'English'),
(4, 'Urdu'),
(5, 'Chemistry'),
(6, 'Physics'),
(7, 'Zoology'),
(8, 'Mathematics');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_groups`
--

CREATE TABLE `tbl_groups` (
  `grp_ID` int(11) NOT NULL,
  `grp_name` varchar(45) NOT NULL,
  `grp_subjectID` int(11) NOT NULL,
  `grp_userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_semesters`
--

CREATE TABLE `tbl_semesters` (
  `sem_ID` int(11) NOT NULL,
  `sem_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_semesters`
--

INSERT INTO `tbl_semesters` (`sem_ID`, `sem_name`) VALUES
(1, '1st'),
(2, '2nd'),
(3, '3rd'),
(4, '4rth'),
(5, '5th'),
(6, '6th'),
(7, '7th'),
(8, '8th');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_students`
--

CREATE TABLE `tbl_students` (
  `std_ID` int(11) NOT NULL,
  `std_name` varchar(45) NOT NULL,
  `std_fathername` varchar(45) NOT NULL,
  `std_batchID` int(11) NOT NULL,
  `std_rollno` varchar(45) NOT NULL,
  `std_departmentID` int(11) NOT NULL,
  `std_semesterID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_students`
--

INSERT INTO `tbl_students` (`std_ID`, `std_name`, `std_fathername`, `std_batchID`, `std_rollno`, `std_departmentID`, `std_semesterID`) VALUES
(2, 'Farhat Ullah', 'Bakht Zamin', 1, 'CS02', 1, 7),
(4, 'Naeem Ullah', 'Muhammad Saleem', 1, 'CS04', 1, 7),
(6, 'Shah Hassan', 'Naik Muhammad', 1, 'CS20', 1, 7),
(7, 'Wakeel Badshah', 'Pir Hassan Shah', 1, 'CS07', 1, 7),
(9, 'Hamza Khan', 'Fazal Khaliq', 1, 'CS09', 1, 7),
(12, 'Amroz Khan', 'Shamroz Khan', 1, 'CS13', 1, 7),
(13, 'Mobin Rahman', 'Rahman Khan', 1, 'CS16', 1, 7),
(14, 'Abdur Rahman', 'Muhammad Jalat', 1, 'CS18', 1, 7),
(17, 'Ihtisham Khan', 'Raheem Dad', 1, 'CS19', 1, 7),
(23, 'Ahsan Khan', 'Khan', 1, 'PH01', 6, 7),
(24, 'Khalid Ali', 'Khan', 1, 'PH02', 6, 7),
(25, 'Muhammad Bilal', 'Khan', 1, 'PH03', 6, 7),
(26, 'Mehran Shah', 'Khan', 1, 'PH04', 6, 7),
(27, 'Humayun Khan', 'Khan', 1, 'PH05', 6, 7),
(33, 'Sharjil Ahmad', 'Israr Khan', 1, 'ZO01', 7, 1),
(34, 'Zaryab Khan', 'Khan', 1, 'CS26', 1, 7),
(38, 'Jawad Ali Shah', 'Khurshaid Ali Shah', 1, 'CS33', 1, 7),
(40, 'Adnan Khan', 'Salim Khan', 1, 'CS36', 1, 7),
(41, 'Hayat Khan', 'Dawa Khan', 1, 'CS35', 1, 7),
(42, 'Ashfaq Khan', 'Khan', 1, 'CS40', 1, 7),
(44, 'Muhammad Afzal', 'Afzal Khan', 1, 'CS28', 1, 7),
(48, 'Nouman Shah Bacha', 'Nawsherawan Badshah', 1, 'CS11', 1, 7),
(49, 'Imran Khan', 'Karim Khan', 1, 'CS14', 1, 7),
(50, 'Asaf Nawaz', 'Nawaz Zada', 1, 'CS15', 1, 7),
(51, 'Hamza Khan', 'Faridun Khan', 1, 'CS24', 1, 7),
(52, 'Younas Khan', 'Khan', 1, 'CS37', 1, 7),
(53, 'Farhad Ali', 'Ali', 1, 'CS29', 1, 7),
(54, 'Abdul Latif', 'Khan', 1, 'CS30', 1, 7),
(55, 'Jibran Khan', 'Khan', 1, 'CS17', 1, 7);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subjects`
--

CREATE TABLE `tbl_subjects` (
  `sub_ID` int(11) NOT NULL,
  `sub_name` varchar(60) NOT NULL,
  `sub_departmentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_subjects`
--

INSERT INTO `tbl_subjects` (`sub_ID`, `sub_name`, `sub_departmentID`) VALUES
(38, 'System Programming', 1),
(39, 'Information & Communication Technologies', 1),
(40, 'Programming Fundamental', 1),
(41, 'Data Structure', 1),
(42, 'Digital Logic Design', 1),
(43, 'Introduction To Databases', 1),
(44, 'Object Oriented Programming', 1),
(45, 'Software Engineering-I', 1),
(46, 'Computer Organization & Assembly Language', 1),
(47, 'Database Administration', 1),
(48, 'Operating System', 1),
(49, 'Software Engineering-II', 1),
(50, 'Data Communication & Network', 1),
(51, 'Advance Object Oriented Programming', 1),
(52, 'Web Technologies', 1),
(53, 'Islamiyat', 1),
(54, 'Physics', 1),
(55, 'Functional English', 1),
(56, 'Calculas & Analytical Geometry', 1),
(57, 'Technical Report Writing', 1),
(58, 'Statistics and Probability', 1),
(59, 'Discrete Mathematical Structures', 1),
(60, 'Electronics', 1),
(61, 'Communication & Presentation Skills', 1),
(62, 'Pak Studies', 1),
(63, 'Multivariable Calculas', 1),
(64, 'Linear Algebra & Application', 1),
(65, 'Artificial Intelligence', 1),
(66, 'Differential Equation', 1),
(67, 'Nuclear Physics', 6),
(68, 'Plasma Physics', 6),
(69, 'Particle Physics', 6),
(70, 'Compiler Construction', 1),
(71, 'Basic Electronics', 1),
(72, 'Theory Of Automata & Formal Languages', 1),
(73, 'E-commerce', 1),
(74, 'Rich Internet Application', 1),
(75, 'Analysis Of Algorithm', 1),
(76, 'Network Strategies', 1),
(77, 'Computer Graphics', 1),
(78, 'Computer Architecture', 1),
(79, 'Information Security', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_ID` int(11) NOT NULL,
  `user_name` varchar(45) NOT NULL,
  `user_username` varchar(45) NOT NULL,
  `user_password` varchar(45) NOT NULL,
  `user_batchID` int(11) NOT NULL,
  `user_semesterID` int(11) NOT NULL,
  `user_departmentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_ID`, `user_name`, `user_username`, `user_password`, `user_batchID`, `user_semesterID`, `user_departmentID`) VALUES
(14, 'Farhat Ullah', 'usercs', 'usercs', 1, 7, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_ID`);

--
-- Indexes for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  ADD PRIMARY KEY (`att_ID`);

--
-- Indexes for table `tbl_batch`
--
ALTER TABLE `tbl_batch`
  ADD PRIMARY KEY (`bat_ID`);

--
-- Indexes for table `tbl_departments`
--
ALTER TABLE `tbl_departments`
  ADD PRIMARY KEY (`dep_ID`);

--
-- Indexes for table `tbl_groups`
--
ALTER TABLE `tbl_groups`
  ADD PRIMARY KEY (`grp_ID`);

--
-- Indexes for table `tbl_semesters`
--
ALTER TABLE `tbl_semesters`
  ADD PRIMARY KEY (`sem_ID`);

--
-- Indexes for table `tbl_students`
--
ALTER TABLE `tbl_students`
  ADD PRIMARY KEY (`std_ID`);

--
-- Indexes for table `tbl_subjects`
--
ALTER TABLE `tbl_subjects`
  ADD PRIMARY KEY (`sub_ID`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  MODIFY `att_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=640;

--
-- AUTO_INCREMENT for table `tbl_batch`
--
ALTER TABLE `tbl_batch`
  MODIFY `bat_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_departments`
--
ALTER TABLE `tbl_departments`
  MODIFY `dep_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_groups`
--
ALTER TABLE `tbl_groups`
  MODIFY `grp_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_semesters`
--
ALTER TABLE `tbl_semesters`
  MODIFY `sem_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_students`
--
ALTER TABLE `tbl_students`
  MODIFY `std_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `tbl_subjects`
--
ALTER TABLE `tbl_subjects`
  MODIFY `sub_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
