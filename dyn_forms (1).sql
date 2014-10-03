-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2014 at 05:27 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dyn_forms`
--

-- --------------------------------------------------------

--
-- Table structure for table `form_attributes`
--

CREATE TABLE IF NOT EXISTS `form_attributes` (
  `att_id` varchar(36) NOT NULL,
  `form_id` varchar(36) NOT NULL,
  `type` varchar(100) NOT NULL,
  `attributes` text NOT NULL,
  `validations` text NOT NULL,
  PRIMARY KEY (`att_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `form_attributes`
--

INSERT INTO `form_attributes` (`att_id`, `form_id`, `type`, `attributes`, `validations`) VALUES
('1d70763e-07b3-b0cb-4c10735b07b0', '239b96c8-a3b5-649f-66e45472b9e2', 'text', '{"order":"0","name":"One"}', 'null'),
('2439963d-e236-da59-a9cbdfcc8fa3', 'c5d23b3c-4ce4-6ee8-73583b4470ed', 'number', '{"name":"Age"}', '{"required":"true"}'),
('51fd5651-428d-6a7e-5e4cec7d60a7', '323762ca-828a-d7d5-ff1a1b0775c8', 'text', '{"name":"Last Name"}', '{"required":"true"}'),
('6b0bd4ba-4e52-a662-4ef8e25c5ee0', '323762ca-828a-d7d5-ff1a1b0775c8', 'text', '{"name":"First Name"}', '{"required":"true"}'),
('93bd752f-9900-19ac-98d502dd8b5a', 'c5d23b3c-4ce4-6ee8-73583b4470ed', 'radio', '{"radioButtons":[{"$$hashKey":"007","name":"Red","value":"Red"},{"$$hashKey":"009","name":"Green","value":"Green"},{"$$hashKey":"00B","name":"Blue","value":"Blue"}],"name":"Colors"}', '{"required":"true"}'),
('aa3abbcd-3323-49a0-53e28b2930ec', 'c5d23b3c-4ce4-6ee8-73583b4470ed', 'text', '{"name":"Name"}', '{"required":"true","minChar":"3"}'),
('c3e62b00-819f-423c-e0e0675787aa', 'c5d23b3c-4ce4-6ee8-73583b4470ed', 'radio', '{"radioButtons":[{"$$hashKey":"00G","name":"Pizza","value":"Pizza"},{"$$hashKey":"00I","name":"Salad","value":"Salad"},{"$$hashKey":"00K","name":"Hamburger","value":"Hamburger"},{"$$hashKey":"00M","name":"Cheese Burger","value":"Cheese Burger"}],"name":"Foods"}', 'null'),
('d9da03be-59bc-2547-e9ec20d06009', '239b96c8-a3b5-649f-66e45472b9e2', 'text', '{"order":"1","name":"Two"}', 'null'),
('eb8f04f5-1583-7d05-c7e41c3f649b', '239b96c8-a3b5-649f-66e45472b9e2', 'radio', '{"order":"2","radioButtons":[{"$$hashKey":"00D","order":"0","name":"One"},{"$$hashKey":"00F","order":"1","name":"Two"},{"$$hashKey":"00H","order":"2","name":"Three"},{"$$hashKey":"00J","order":"3","name":"Four"}],"name":"Three"}', 'null');

-- --------------------------------------------------------

--
-- Table structure for table `form_types`
--

CREATE TABLE IF NOT EXISTS `form_types` (
  `form_id` varchar(36) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`form_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `form_types`
--

INSERT INTO `form_types` (`form_id`, `name`, `description`) VALUES
('239b96c8-a3b5-649f-66e45472b9e2', 'ORder test', 'test'),
('323762ca-828a-d7d5-ff1a1b0775c8', 'Name Form', 'Like it says'),
('c5d23b3c-4ce4-6ee8-73583b4470ed', 'Radio test', 'testing the radio buttons');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
