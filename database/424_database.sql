-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2017 at 03:03 AM
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
  `annotation` varchar(3000) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dagr`
--

INSERT INTO `dagr` (`id`, `name`, `time_created`, `path`, `annotation`) VALUES
('3270C5C5-F589-4BA2-820B-6EBD0DD4C85E', 'Image File Renamed 3', '0000-00-00 00:00:00', 'ted.jpg', 'When preparing an SQL statement, always make sure you actually execute it.'),
('7532A82F-E3E2-4E1D-9D7F-9B23E1831B06', 'Google', '0000-00-00 00:00:00', 'http://www.google.com', ''),
('C5296946-0CB0-451C-9760-D6A50D062C7D', 'bobby''s gif', '0000-00-00 00:00:00', 'bobby.gif', ''),
('E9969B82-E2CB-4012-9675-754E58B5629E', 'Test Image File', '0000-00-00 00:00:00', '', ''),
('EE21CDAF-6845-4135-AD4C-FAF45300AF04', 'Child Name', '0000-00-00 00:00:00', '', ''),
('FCBB1E3B-07BD-4451-8B25-83C14D7B0707', 'Parent Name', '0000-00-00 00:00:00', '', '');

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
('C5296946-0CB0-451C-9760-D6A50D062C7D', '2017-05-12 02:25:57', '::1', 'image/gif', 872427);

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
