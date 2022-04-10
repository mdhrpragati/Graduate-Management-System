-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 12, 2013 at 02:57 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gms`
--

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE IF NOT EXISTS `class` (
  `class_id` char(6) NOT NULL,
  `instructor` char(25) NOT NULL,
  `semester` char(15) NOT NULL,
  `course_code` varchar(10) NOT NULL,
  `batch` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`class_id`, `instructor`, `semester`, `course_code`, `batch`) VALUES
('1s2011', 'manoj@ku.edu.np', '1', 'COMP 504', 2011),
('1s2011', 'samatha@gmail.com', '1', 'COMP 505', 2011),
('3s2012', 'anil@gmail.com', '3', 'COMP 580', 2012),
('3s2012', 'samatha@gmail.com', '3', 'MAPG 503', 2012),
('3s2012', 'sita@ku.edu.np', '3', 'COMP 502', 2012),
('3s2012', 'manoj@ku.edu.np', '3', 'COMP 504', 2012),
('1s2012', 'samatha@gmail.com', '1', 'COMP 501', 2012),
('1s2012', 'TBA', '1', 'COMP 505', 2012),
('1s2012', 'TBA', '1', 'COMP 506', 2012),
('1s2013', 'anil@gmail.com', '1', 'COMP 501', 2013),
('1s2013', 'samatha@gmail.com', '1', 'COMP 502', 2013),
('1s2013', 'anil@gmail.com', '1', 'COMP 504', 2013);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `course_code` char(10) NOT NULL,
  `course_name` varchar(50) NOT NULL,
  `credit` tinyint(2) NOT NULL,
  `description` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`course_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This table keeps the details of the courses offered.';

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_code`, `course_name`, `credit`, `description`) VALUES
('COMP 116', 'Structured Programming', 3, 'tftff'),
('COMP 501', 'Design And Analysis Of Algorithm', 3, 'Contact Hour: 60'),
('COMP 502', 'Advance Programming Technique', 3, 'Contact Hour: 60 hrs'),
('COMP 504', 'Software Engineering', 2, 'Contact Hour: 60hrs'),
('COMP 505', 'Computer Network And Architecture', 3, 'Contact Hour: 60 hrs'),
('COMP 506', 'Advanced Operating System', 3, 'N/A\r\n\r\n'),
('COMP 580', 'Project Work', 3, 'N/A'),
('COMP 581', 'Project Work', 6, 'N/A'),
('COMP 582', 'Dissertation Work	', 15, 'N/A'),
('MAPG 503', 'Mathematical Foundation For Computer Science', 3, 'Contact Hour: 60 hrs');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `reg_no` varchar(11) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `middle_name` varchar(15) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `nationality` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `doe` date NOT NULL,
  `batch` char(4) NOT NULL,
  `permanent_address` varchar(100) NOT NULL,
  `temporary_address` varchar(100) NOT NULL,
  `cell_no` varchar(15) NOT NULL,
  `landline` int(15) NOT NULL,
  `photo` varchar(5) NOT NULL,
  `past_document` varchar(20) NOT NULL,
  PRIMARY KEY (`reg_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`reg_no`, `first_name`, `middle_name`, `last_name`, `nationality`, `dob`, `doe`, `batch`, `permanent_address`, `temporary_address`, `cell_no`, `landline`, `photo`, `past_document`) VALUES
('010001-12', 'Saurav', '', 'prajapati', 'Nepali', '2013-07-15', '2013-07-25', '2012', 'thimi', 'thimi', '9854012458', 5521448, '', ''),
('010002-11', 'Manoj ', 'Man', 'KC', 'Nepali', '2013-07-02', '2013-07-11', '2011', 'Bnepa', 'banepa', '9841553215', 0, '', ''),
('010003-11', 'Vivkek', '', 'Shakya', 'Nepali', '2013-07-04', '2013-07-24', '2011', 'Shankhamul', '', '9841553215', 0, '', ''),
('010005-11', 'Manoj ', 'Manjushree', 'KC', 'Nepali', '2013-07-02', '2013-07-24', '2011', 'Bnepa', 'banepa', '9611123456', 78897, '', ''),
('013001-12', 'Sara', 'Ratna', 'Joshi', 'nepali', '2013-07-24', '2013-07-11', '2012', 'Samakhushi', 'Samakhushi', '9803005614', 5532273, '', ''),
('013002-12', 'Shriya', '-', 'Karki', 'Nepali', '2013-07-25', '2013-07-12', '2012', 'Baudha', 'Nepal', '9803551545', 4470997, '', ''),
('013003-12', 'Ganesh', 'Man', 'Bhattarai', 'Nepali', '2013-07-25', '2013-07-18', '2012', 'Nepal', 'Nepal', '9841552468', 5584888, '', ''),
('013004-12', 'Shova', 'Ratna', 'Tuladhar', 'Nepali', '2013-07-23', '2013-07-05', '2012', 'Banepa', 'pokhara', '9854201124', 5542187, '', ''),
('013005-12', 'Sam', '', 'Smith', 'American', '2013-07-09', '2013-07-13', '2012', 'Texas', 'Texas', '9854200125', 5512455, '', ''),
('013099-11', 'Manoj ', 'Man', 'KC', 'Nepali', '2013-07-02', '2013-07-31', '2013', 'Bnepa', 'banepa', '9841553215', 0, '', ''),
('013099-13', 'Manoj ', 'Man', 'KC', 'Nepali', '0000-00-00', '0000-00-00', '2013', 'Bnepa', 'banepa', '9841553215', 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `student_grade`
--

CREATE TABLE IF NOT EXISTS `student_grade` (
  `reg_no` varchar(11) NOT NULL,
  `course_code` varchar(20) NOT NULL,
  `grade` char(2) NOT NULL,
  `class_id` char(6) NOT NULL,
  `remarks` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_grade`
--

INSERT INTO `student_grade` (`reg_no`, `course_code`, `grade`, `class_id`, `remarks`) VALUES
('010002-11', 'COMP 502', 'A-', '1s2011', ''),
('010002-11', 'COMP 504', 'A-', '1s2011', ''),
('010003-11', 'COMP 504', 'B+', '1s2011', ''),
('010001-12', 'COMP 501', 'A', '1s2012', ''),
('010001-12', 'COMP 505', 'B', '1s2012', ''),
('010001-12', 'COMP 506', 'B', '1s2012', ''),
('013004-12', 'COMP 501', 'C', '1s2012', ''),
('013004-12', 'COMP 505', 'A', '1s2012', ''),
('013004-12', 'COMP 506', 'B', '1s2012', ''),
('013005-12', 'COMP 501', 'A', '1s2012', ''),
('013005-12', 'COMP 505', 'A-', '1s2012', ''),
('013005-12', 'COMP 506', 'B+', '1s2012', ''),
('013002-12', 'COMP 580', '', '3s2012', ''),
('013002-12', 'COMP 504', '', '3s2012', ''),
('013003-12', 'MAPG 503', '', '3s2012', ''),
('013003-12', 'COMP 502', '', '3s2012', ''),
('013003-12', 'COMP 501', '', '1s2012', ''),
('013003-12', 'COMP 505', '', '1s2012', ''),
('013001-12', 'COMP 580', '', '3s2012', ''),
('013001-12', 'MAPG 503', '', '3s2012', '');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_detail`
--

CREATE TABLE IF NOT EXISTS `teacher_detail` (
  `email_id` char(25) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `designation` varchar(50) NOT NULL,
  PRIMARY KEY (`email_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher_detail`
--

INSERT INTO `teacher_detail` (`email_id`, `first_name`, `last_name`, `department`, `designation`) VALUES
('anil@gmail.com', 'Anil', 'Thapa', 'DoEE', 'Lecturer'),
('manoj@ku.edu.np', 'Manoj', 'Shakya', 'DoCSE', 'Assistant professor'),
('samatha@gmail.com', 'Samatha', 'KC', 'DoCSE', 'Professor'),
('saurav@ku.edu.np', 'Saurav', 'Prajapati', 'DoEE', 'Teaching Assistant'),
('sita@ku.edu.np', 'Sita', 'Rana', 'DoEE', 'Lecturer');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(2, 'user', 'ee11cbb19052e40b07aac0ca060c23ee'),
(8, 'sara', '5bd537fc3789b5482e4936968f0fde95');

-- --------------------------------------------------------

--
-- Table structure for table `user_detail`
--

CREATE TABLE IF NOT EXISTS `user_detail` (
  `user_id` int(4) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `middle_name` varchar(10) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `designation` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_detail`
--

INSERT INTO `user_detail` (`user_id`, `user_name`, `first_name`, `middle_name`, `last_name`, `email_id`, `Address`, `department`, `designation`) VALUES
(1, 'admin', 'Uer', 'Use', 'User', 'example@something.com', '', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
