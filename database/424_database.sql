-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2017 at 06:26 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `424_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` varchar(36) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
('09EB7096-0C73-40BE-9661-BA9D69969156', 'New Category 2'),
('1BAD05B2-2116-401C-B81C-B86E269C648A', 'New Category'),
('48C68086-3ECD-46BD-8FE5-A0B85D7FE6A4', 'tag_2'),
('BE7674F3-F56F-4301-9835-CE4D0E70FF3E', 'tag_1');

-- --------------------------------------------------------

--
-- Table structure for table `children`
--

CREATE TABLE `children` (
  `parent_id` varchar(36) NOT NULL,
  `child_id` varchar(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `children`
--

INSERT INTO `children` (`parent_id`, `child_id`) VALUES
('3270C5C5-F589-4BA2-820B-6EBD0DD4C85E', 'EE21CDAF-6845-4135-AD4C-FAF45300AF04'),
('FCBB1E3B-07BD-4451-8B25-83C14D7B0707', '3270C5C5-F589-4BA2-820B-6EBD0DD4C85E');

-- --------------------------------------------------------

--
-- Table structure for table `dagr`
--

CREATE TABLE `dagr` (
  `id` varchar(36) NOT NULL,
  `name` varchar(260) NOT NULL,
  `time_created` datetime NOT NULL,
  `path` varchar(500) NOT NULL,
  `hash` char(64) NOT NULL,
  `annotation` varchar(3000) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dagr`
--

INSERT INTO `dagr` (`id`, `name`, `time_created`, `path`, `hash`, `annotation`) VALUES
('19C44253-8FA9-4BFC-8363-2E2DD39DCCD5', 'New AutoHotkey Script 2.ahk', '2017-05-12 06:22:56', 'D:\\Dropbox\\Work\\Schoolwork\\2017 - Spring\\CMSC 424 - Database\\Files for Upload\\folder1\\folder2\\New AutoHotkey Script 2.ahk', '', ''),
('2E4008E0-8ABA-4957-93B9-CC7E5EB8F69F', 'New AutoHotkey Script 2.ahk', '2017-05-12 06:23:13', 'D:\\Dropbox\\Work\\Schoolwork\\2017 - Spring\\CMSC 424 - Database\\Files for Upload\\folder1\\folder2\\New AutoHotkey Script 2.ahk', '', ''),
('3270C5C5-F589-4BA2-820B-6EBD0DD4C85E', 'Image File Renamed 3', '0000-00-00 00:00:00', 'ted.jpg', '', 'When preparing an SQL statement, always make sure you actually execute it.'),
('48424A62-E13A-4E0D-AD24-292787279DEF', 'New Text Document.txt', '2017-05-12 06:18:28', 'D:\\Dropbox\\Work\\Schoolwork\\2017 - Spring\\CMSC 424 - Database\\Files for Upload\\folder1\\folder2\\New Text Document.txt', '', ''),
('4E02500E-9200-4F6D-B91D-0A1A63322912', 'pub1.pub', '2017-05-12 06:21:39', 'D:\\Dropbox\\Work\\Schoolwork\\2017 - Spring\\CMSC 424 - Database\\Files for Upload\\folder1\\pub1.pub', '', ''),
('4EE77F5D-4D76-4D7D-887E-0C94F70E4561', 'New Text Document.txt', '2017-05-12 06:23:13', 'D:\\Dropbox\\Work\\Schoolwork\\2017 - Spring\\CMSC 424 - Database\\Files for Upload\\folder1\\folder2\\New Text Document.txt', '', ''),
('579D1368-0BE3-4AFD-B63C-614D855202D1', 'pub1.pub', '2017-05-12 06:22:57', 'D:\\Dropbox\\Work\\Schoolwork\\2017 - Spring\\CMSC 424 - Database\\Files for Upload\\folder1\\pub1.pub', '', ''),
('60363997-D426-4F6A-A056-47967C11CF71', 'New AutoHotkey Script.ahk', '2017-05-12 06:21:39', 'D:\\Dropbox\\Work\\Schoolwork\\2017 - Spring\\CMSC 424 - Database\\Files for Upload\\folder1\\folder2\\New AutoHotkey Script.ahk', '', ''),
('67C5A1D9-C8B9-480F-9641-1304FA6C71AD', 'pub1.pub', '2017-05-12 06:23:13', 'D:\\Dropbox\\Work\\Schoolwork\\2017 - Spring\\CMSC 424 - Database\\Files for Upload\\folder1\\pub1.pub', '', ''),
('6E14F5E1-6335-44A6-8E72-EE5391A5BA6A', 'folder1', '2017-05-12 06:13:03', 'D:\\Dropbox\\Work\\Schoolwork\\2017 - Spring\\CMSC 424 - Database\\Files for Upload\\folder1', '', ''),
('702A6A7A-1701-48DB-9F27-066DF58D60EE', 'New Text Document.txt', '2017-05-12 06:21:39', 'D:\\Dropbox\\Work\\Schoolwork\\2017 - Spring\\CMSC 424 - Database\\Files for Upload\\folder1\\folder2\\New Text Document.txt', '', ''),
('7532A82F-E3E2-4E1D-9D7F-9B23E1831B06', 'Google', '0000-00-00 00:00:00', 'http://www.google.com', '', ''),
('89763691-ABDD-409B-8589-025B468C8C51', 'New Text Document.txt', '2017-05-12 06:22:57', 'D:\\Dropbox\\Work\\Schoolwork\\2017 - Spring\\CMSC 424 - Database\\Files for Upload\\folder1\\folder2\\New Text Document.txt', '', ''),
('8CE7E92F-DFE2-4BDD-A638-C29414BB36EB', 'New AutoHotkey Script.ahk', '2017-05-12 06:18:28', 'D:\\Dropbox\\Work\\Schoolwork\\2017 - Spring\\CMSC 424 - Database\\Files for Upload\\folder1\\folder2\\New AutoHotkey Script.ahk', '', ''),
('95970925-D56E-451F-8047-C167347BB4B2', 'pub1.pub', '2017-05-12 06:18:28', 'D:\\Dropbox\\Work\\Schoolwork\\2017 - Spring\\CMSC 424 - Database\\Files for Upload\\folder1\\pub1.pub', '', ''),
('BA4B1834-4E1C-4120-BD08-A2FBD2883582', '123abv', '2017-05-12 03:07:52', 'bobby.gif', '', ''),
('C5296946-0CB0-451C-9760-D6A50D062C7D', 'bobby''s gif', '0000-00-00 00:00:00', 'bobby.gif', '', ''),
('D134CEE7-9B86-455C-A556-D7E9F05554C5', 'folder1', '2017-05-12 06:12:07', 'D:\\Dropbox\\Work\\Schoolwork\\2017 - Spring\\CMSC 424 - Database\\Files for Upload\\folder1', '', ''),
('E9969B82-E2CB-4012-9675-754E58B5629E', 'Test Image File', '0000-00-00 00:00:00', '', '', ''),
('EE21CDAF-6845-4135-AD4C-FAF45300AF04', 'Child Name', '0000-00-00 00:00:00', '', '', ''),
('EE321DF5-0DC2-41A9-9FD9-0731279CC0D9', 'Bobby gif edit checker', '2017-05-12 04:44:36', 'bobby.gif', '', ''),
('FCBB1E3B-07BD-4451-8B25-83C14D7B0707', 'Parent Name', '0000-00-00 00:00:00', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `dagr_to_categories`
--

CREATE TABLE `dagr_to_categories` (
  `dagr_id` varchar(36) NOT NULL,
  `category_id` varchar(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dagr_to_categories`
--

INSERT INTO `dagr_to_categories` (`dagr_id`, `category_id`) VALUES
('3270C5C5-F589-4BA2-820B-6EBD0DD4C85E', 'BE7674F3-F56F-4301-9835-CE4D0E70FF3E'),
('EE21CDAF-6845-4135-AD4C-FAF45300AF04', 'BE7674F3-F56F-4301-9835-CE4D0E70FF3E');

-- --------------------------------------------------------

--
-- Table structure for table `metadata`
--

CREATE TABLE `metadata` (
  `dagr_id` varchar(36) NOT NULL,
  `time_edited` datetime NOT NULL,
  `author` varchar(100) NOT NULL,
  `file_type` varchar(100) NOT NULL,
  `file_size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `metadata`
--

INSERT INTO `metadata` (`dagr_id`, `time_edited`, `author`, `file_type`, `file_size`) VALUES
('3270C5C5-F589-4BA2-820B-6EBD0DD4C85E', '1000-01-01 00:00:00', 'tim', '', 0),
('7532A82F-E3E2-4E1D-9D7F-9B23E1831B06', '0000-00-00 00:00:00', 'Mark', 'jpg', 300),
('60363997-D426-4F6A-A056-47967C11CF71', '2017-05-12 06:11:47', '::1', 'ahk', 324),
('702A6A7A-1701-48DB-9F27-066DF58D60EE', '2017-05-12 06:11:45', '::1', 'txt', 0),
('4E02500E-9200-4F6D-B91D-0A1A63322912', '2017-05-12 06:11:32', '::1', 'pub', 59904),
('19C44253-8FA9-4BFC-8363-2E2DD39DCCD5', '2017-05-12 06:11:47', '::1', 'ahk', 324),
('89763691-ABDD-409B-8589-025B468C8C51', '2017-05-12 06:11:45', '::1', 'txt', 0),
('579D1368-0BE3-4AFD-B63C-614D855202D1', '2017-05-12 06:11:32', '::1', 'pub', 59904),
('2E4008E0-8ABA-4957-93B9-CC7E5EB8F69F', '2017-05-12 06:11:47', '::1', 'ahk', 324),
('4EE77F5D-4D76-4D7D-887E-0C94F70E4561', '2017-05-12 06:11:45', '::1', 'txt', 0),
('67C5A1D9-C8B9-480F-9641-1304FA6C71AD', '2017-05-12 06:11:32', '::1', 'pub', 59904);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `children`
--
ALTER TABLE `children`
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `fk_grade_id` (`child_id`);

--
-- Indexes for table `dagr`
--
ALTER TABLE `dagr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dagr_to_categories`
--
ALTER TABLE `dagr_to_categories`
  ADD KEY `dagr_id` (`dagr_id`),
  ADD KEY `tag_id` (`category_id`);

--
-- Indexes for table `metadata`
--
ALTER TABLE `metadata`
  ADD KEY `dagr_id` (`dagr_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `children`
--
ALTER TABLE `children`
  ADD CONSTRAINT `children_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `dagr` (`id`),
  ADD CONSTRAINT `children_ibfk_2` FOREIGN KEY (`parent_id`) REFERENCES `dagr` (`id`),
  ADD CONSTRAINT `fk_grade_id` FOREIGN KEY (`child_id`) REFERENCES `dagr` (`id`);

--
-- Constraints for table `dagr_to_categories`
--
ALTER TABLE `dagr_to_categories`
  ADD CONSTRAINT `dagr_to_categories_ibfk_1` FOREIGN KEY (`dagr_id`) REFERENCES `dagr` (`id`),
  ADD CONSTRAINT `dagr_to_categories_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `metadata`
--
ALTER TABLE `metadata`
  ADD CONSTRAINT `metadata_ibfk_1` FOREIGN KEY (`dagr_id`) REFERENCES `dagr` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
