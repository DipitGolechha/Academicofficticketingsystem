-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 04, 2024 at 05:23 PM
-- Server version: 10.5.20-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id21643299_maindatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login_table`
--

CREATE TABLE `admin_login_table` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin_login_table`
--

INSERT INTO `admin_login_table` (`ID`, `Name`, `Email`, `Password`) VALUES
(1, 'Manoj sir', 'manoj.kannan@ddd.edu.in', '$2y$10$kqGUyA.Zof0o2Fll7MFho.ui.14r/7uiHB3KGn.N6B1KQaPvJYZ4S'),
(2, 'Nandini Ma\'am', 'nandini.kannan@ddd.edu.in', '$2y$10$svGOcOpAJ0M5DHVsn0ehwOFWzKq1bjnjqVfRjZcXyCKC.zMgwlFqC'),
(3, 'Academic Office', 'officeacademics@ddd.edu.in', '$2y$10$.eGcbrV88J4YjJO1ljitRumrfiXRx3FwktQlwe6I0pyPA4V3TZNyS');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `ID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Category` varchar(255) DEFAULT NULL,
  `Question` text NOT NULL,
  `Answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`ID`, `Date`, `Category`, `Question`, `Answer`) VALUES
(1, '2023-12-01', 'Course Issues', 'What is the distrubution of weightages in Computational Methods and Optimisation ?', '30% In Class Quiz, 30% Take home Assignments and Interview, 40% Project'),
(2, '2023-12-02', 'Course Issues', 'Even after being a 1 credit course, why does communication have such long and rigorous classes ?', 'This is due to the fact that communication lab is a lab course, 30hrs of lab needs to be completed. If it would have been a theory course, the hours would have been reduced to 15hrs.'),
(3, '2023-12-03', 'Course Issues', 'Do we need to pass both lab and theory seperately in order to pass Electronics System and Engineering ?', 'Yes. A student needs to individually pass the lab and theoritical component each in Electronics System and Engineering in order to pass the course.'),
(4, '2023-12-04', 'General Issues', 'What is the minimum attendane policy ?', 'Each course has its varied structure for attendence, Some don\'t have attendence at all and some courses have been given vey high weightages with respect to attendance.'),
(5, '2023-12-05', 'General Issues', 'When do we get to select are majors and do we have the option to select minors?', 'A student gets to select his/her major in the fourth semester. Students will also be given an option to select a minor from fifth semester onwards.'),
(6, '2023-12-06', 'General Issues', 'What is the process of make ups?', 'The decision on whether a student will be given a make up or not solely depends on the professor. There might be situations where the Academic Office intervenes if the student had a genuine reason, for example a medical emergency.'),
(7, '2023-12-07', 'General Issues', 'Is there a policy where I can improve my grade by re-taking the course?', 'A student only gets to improve his/her grade, if they get a grade of C- or lower. They can either give a supplementary exam to do so, or retake the course in the summer, or re-do with the new batch doing it. The decision of this solely depends on the Academic Office, and guidelines are always open to change'),
(8, '2023-12-08', 'Help Related to Academics', 'Is there a provision where we can take extra classes to improve in a particular subject?', 'As of now, No. You can reach out to your professors/TA\'s during their office hours and they can help/guide you with the problem you are facing.'),
(9, '2023-12-09', 'Help Related to Academics', 'Who do I contact, if I have any Academic concern?', 'You should firstly talk to the Associate Dean of Academics, and he/she can tell you who to approach if the issue isnt solvable by him/her, and what to do.'),
(10, '2023-12-03', 'Major Courses Concerns', 'What program electives does CSAI offer?', 'Here, is a list of electives offered by CSAI. 1 Data Mining 2.MLPR'),
(11, '2023-12-04', 'Major Courses Concerns', 'How many credits do I need for a minor?', 'A minor mainly consits of 3 or more program electives of that particular major, and that counts up as a minor.'),
(12, '2023-12-05', 'Major Courses Concerns', 'Can I change my major?', 'No, you cannot change your major. This is also subject to the decision made by the Academic Office.'),
(13, '2023-12-06', 'Others', 'What are the library timings?', 'The library is open from 7:00 am to 12:00 am.');

-- --------------------------------------------------------

--
-- Table structure for table `issues`
--

CREATE TABLE `issues` (
  `ID` int(11) NOT NULL,
  `Date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Title` varchar(255) NOT NULL,
  `Content` text NOT NULL,
  `Attachments` longblob DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `Priority` varchar(50) DEFAULT NULL,
  `Category` varchar(255) DEFAULT NULL,
  `StudentName` varchar(255) NOT NULL,
  `StudentEmail` varchar(255) NOT NULL,
  `AssignedTo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `issues`
--

INSERT INTO `issues` (`ID`, `Date`, `Title`, `Content`, `Attachments`, `Status`, `Priority`, `Category`, `StudentName`, `StudentEmail`, `AssignedTo`) VALUES
(4, '2023-12-11 18:32:19', 'Raised by Yashvi', 'hi!!', '', 'closed', 'low', 'Help Related to Academics', 'Dipit Golechha', 'dipit.golechha@hhh.edu.in', 'Academic Office'),
(6, '2023-12-11 19:04:40', 'Abcd', 'abhcdde', '', 'inprogress', 'medium', 'General Issues', 'Dipit Golechha', 'dipit.golechha@hhh.edu.in', 'Manoj sir'),
(8, '2023-12-12 09:31:55', 'presenation', 'HELLO ', '', 'open', 'high', 'Major Courses Concerns', 'Dipit Golechha', 'dipit.golechha@hhh.edu.in', 'Academic Office'),
(9, '2023-12-12 10:40:22', 'Presenation 2 ', 'Hello ilgc ', '', 'open', 'high', 'Help Related to Academics', 'Dipit Golechha', 'dipit.golechha@hhh.edu.in', 'Academic Office');

-- --------------------------------------------------------

--
-- Table structure for table `issues_status`
--

CREATE TABLE `issues_status` (
  `ID` int(11) DEFAULT NULL,
  `Time` timestamp NOT NULL DEFAULT current_timestamp(),
  `CommentTitle` varchar(255) DEFAULT NULL,
  `CommentText` text NOT NULL,
  `CommentBy` varchar(255) DEFAULT NULL,
  `CommentTo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `issues_status`
--

INSERT INTO `issues_status` (`ID`, `Time`, `CommentTitle`, `CommentText`, `CommentBy`, `CommentTo`) VALUES
(8, '2023-12-12 09:31:55', 'Acad office ', '1233', 'Manoj sir', 'Academic Office'),
(9, '2023-12-12 10:35:06', 'Updated 1', 'Hello world ', 'Manoj sir', 'Manoj sir'),
(9, '2023-12-12 10:40:22', 'Assigned changed ', '1123344', 'Manoj sir', 'Academic Office');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `StudentID` varchar(255) NOT NULL,
  `StudentName` varchar(255) NOT NULL,
  `Batch` varchar(50) NOT NULL,
  `StudentEmail` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`StudentID`, `StudentName`, `Batch`, `StudentEmail`, `Password`) VALUES
('U20220035', 'Dipit Golechha', 'Ug2022', 'dipit.golechha@hhh.edu.in', '$2y$10$2/oWzxyZCdrfLMoyki9d3e5wz9B1IMbzkhBoWRQfh11Nz78hf0eSC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login_table`
--
ALTER TABLE `admin_login_table`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `issues`
--
ALTER TABLE `issues`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `issues_status`
--
ALTER TABLE `issues_status`
  ADD KEY `ID` (`ID`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`StudentID`),
  ADD UNIQUE KEY `StudentEmail` (`StudentEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login_table`
--
ALTER TABLE `admin_login_table`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `issues`
--
ALTER TABLE `issues`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `issues_status`
--
ALTER TABLE `issues_status`
  ADD CONSTRAINT `issues_status_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `issues` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
