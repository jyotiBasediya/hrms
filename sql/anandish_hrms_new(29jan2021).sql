-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 30, 2021 at 12:25 AM
-- Server version: 5.7.32
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `anandish_hrms_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int(11) NOT NULL,
  `policy` text NOT NULL,
  `about` text NOT NULL,
  `service` text NOT NULL,
  `payment` text NOT NULL,
  `contact` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `add_client`
--

CREATE TABLE `add_client` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_address` varchar(255) NOT NULL,
  `gst_number` varchar(255) NOT NULL,
  `pan_number` varchar(255) DEFAULT NULL,
  `spoc_name` varchar(255) DEFAULT NULL,
  `gst_certificate` varchar(255) NOT NULL,
  `person_name` varchar(255) NOT NULL,
  `contact_no` bigint(20) NOT NULL,
  `mail_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `add_client`
--

INSERT INTO `add_client` (`id`, `first_name`, `last_name`, `company_name`, `company_address`, `gst_number`, `pan_number`, `spoc_name`, `gst_certificate`, `person_name`, `contact_no`, `mail_id`) VALUES
(1, 'infogains', '', 'infogains', 'indore', '456456', NULL, NULL, '231476231-image-cute.jpg', 'ajay', 1234567890, 'ap@yopmail.com'),
(2, 'Aarav', '', 'Aarav', 'indore', '45154', NULL, NULL, '71h6PpGaz9L__AC_SL1500_.jpg', 'Rashmi', 8744544744, 'ap@yopmail.com'),
(3, 'Google', '', 'Google', 'mumbai', 'fdsf', NULL, NULL, '', 'Anjali', 5675665666, 'ankurk@yopmail.com'),
(4, 'info', '', 'info', 'pipliyahana', '123456789', NULL, NULL, 'Penguins.jpg', 'Rashmi', 6263691795, 'rashmi.infograins1@gmail.com'),
(5, 'Aarav Solutions', '', 'Aarav Solutions', 'Titanium Heights Ahmedabad', 'AZRPG110DCG', 'AZRPG112234d', '9199191911', '', 'Shilpa Gubrele', 8335000582, 'shilpa.gubrele@aaravsolutions.com'),
(6, 'Wipro', '', 'Wipro', 'Mumbai', '654645', 'WIPRO45612', '4587', 'efd2d51a3fc930666b2dd5795779c868e1afbd61_00.jpg', 'Wipro', 7894561254, 'wipro@yopmail.com'),
(7, 'infograins', '', 'infograins', 'indore', '123456789', 'aa2121aa22', '545556', 'images_(1).png', 'rahul', 7000876161, 'rj@yopmail.com'),
(8, 'Deloitte India Pvt. Ltd', '', 'Deloitte India Pvt. Ltd', 'Mumbai', 'deloitte india pvt ltd', '932030202', 'harish', '', 'Harish', 9988898988, 'abc@xyz.com');

-- --------------------------------------------------------

--
-- Table structure for table `add_project`
--

CREATE TABLE `add_project` (
  `id` int(11) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `project_manager` varchar(255) DEFAULT NULL,
  `short_name` varchar(255) NOT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `project_number` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `status` varchar(11) NOT NULL DEFAULT '1' COMMENT '1=active,0=inactive',
  `assign_to` varchar(255) NOT NULL,
  `curreny_type` varchar(255) DEFAULT NULL,
  `notes` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `add_project`
--

INSERT INTO `add_project` (`id`, `client_name`, `project_name`, `project_manager`, `short_name`, `currency`, `project_number`, `client_id`, `status`, `assign_to`, `curreny_type`, `notes`) VALUES
(3, '2', 'Airtel', '', 'A_CRM', 'USD', 0, 0, 'active', '1,2,3', NULL, '                                      \r\n                                    '),
(4, '1', 'Water Hub', '1', 'HR', 'INR', 77, 867, 'active', '2,3', NULL, ' dfgdfgfdgdfgfdgfd         '),
(5, '5', 'Aarav HRMS', '24', 'AS-HRMS', '', 0, 0, 'active', '2,24', NULL, '                                      \r\n                                    '),
(6, '7', 'Ebusiness', '23', 'hr', 'INR', 123, 321, 'active', '23,27', NULL, '                                      \r\n                                    asdsfdfdfgdg'),
(7, '5', 'Aarav HRMS Phase II', '14', 'AS-HRMS Phase II', 'INR', 0, 0, 'active', '2,14', NULL, '                                      \r\n                                    '),
(8, '8', 'GSS', '1', 'GSS', 'USD', 0, 0, 'active', '1,2,3', NULL, '                                      \r\n                                    ');

-- --------------------------------------------------------

--
-- Table structure for table `cms`
--

CREATE TABLE `cms` (
  `id` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cms`
--

INSERT INTO `cms` (`id`, `type`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 'About Us', 'About Us', '<p>Aarav Solutions is a global product engineering and IT consulting services provider. Our clientele comes from a broad array of industries &ndash; Telecommunications, Banking &amp; Finance, Government, Power and Utilities among various other B2B segments. Our goal is to empower businesses in their quest for digital transformation with our experience, innovation and next generation technology.</p>\r\n\r\n<p>The core value of Aarav Solutions lies in building sustainable growth for its stakeholders viz. customers, partners and employees. We are have achieved remarkable results as team to bring service excellence and zeal for our customers.</p>\r\n\r\n<p>Test Test Test</p>\r\n', '2020-05-12 07:23:08', '2020-05-12 07:23:08'),
(2, 'Privacy Policy', 'Privacy Policy', '<p>Pramod Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n', '2020-05-12 07:23:08', '2020-05-12 07:23:08'),
(3, 'Tems and Condition', 'Tems and Condition', '<p>test Terms and Conditions added by Shilpa</p>\r\n\r\n<p>tested by Shilpa on 27 Jan 2021</p>\r\n', '2020-05-12 07:23:08', '2020-05-12 07:23:08'),
(4, 'Document', 'Document', '<p>Pramod Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.12345</p>\r\n', '2021-01-13 07:05:09', '2021-01-13 07:05:09');

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT '1' COMMENT '1=active,0=not active',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`id`, `name`, `status`, `created_at`) VALUES
(1, 'INR', 1, '2021-01-19 14:51:11'),
(2, 'USD', 1, '2021-01-19 14:51:11');

-- --------------------------------------------------------

--
-- Table structure for table `division`
--

CREATE TABLE `division` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT '1' COMMENT '1=active,0=deactive',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `division`
--

INSERT INTO `division` (`id`, `name`, `status`, `created_at`) VALUES
(1, 'Managent', 1, '2021-01-29 05:46:45'),
(2, 'Sales', 1, '2021-01-29 05:46:45'),
(3, 'Marketing', 1, '2021-01-29 07:48:24'),
(4, 'IT Firmssddd', 1, '2021-01-29 07:48:50');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `level` varchar(255) NOT NULL,
  `full_name` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `start_date` varchar(255) NOT NULL,
  `end_date` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `employement` varchar(255) NOT NULL,
  `division` int(1) NOT NULL,
  `default_task` varchar(200) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `accounting_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=Active , 0=Inactive''',
  `notes` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `level`, `full_name`, `email`, `start_date`, `end_date`, `role`, `employement`, `division`, `default_task`, `emp_id`, `accounting_id`, `status`, `notes`, `password`) VALUES
(1, '', 'rahul deshmukh', 'admin@os.com', '', '', '', '0', 0, '', 0, 0, 0, '                                      \r\n                                    ', '123456'),
(2, '', 'sohel khan', 'admin@os.com', '', '', '', '0', 0, '', 0, 0, 0, '                                      \r\n                                    ', '123456'),
(3, '', 'sohel khan1', 'admin@os.com', '', '', '', '0', 0, '', 0, 0, 0, '                                      \r\n                                    ', '123456'),
(4, '', 'sohel khan1', 'admin@os.com', '', '', '', '0', 0, '', 0, 0, 0, '                                      \r\n                                    ', '123456'),
(5, '', 'sohel khan1', 'admin@os.com', '', '', '', '0', 0, '', 0, 0, 0, '                                      \r\n                                    ', '123456'),
(6, '', 'sohel khan1', 'admin@os.com', '', '', '', '0', 0, '', 0, 0, 0, '                                      \r\n                                    ', '123456'),
(7, '', 'sohel khan1', 'admin@os.com', '', '', '', '0', 0, '', 0, 0, 0, '                                      \r\n                                    ', '123456'),
(8, '', 'sohel khan1', 'admin@os.com', '', '', '', '0', 0, '', 0, 0, 0, '                                      \r\n                                    ', '123456'),
(9, '', 'sohel khan1', 'admin@os.com', '', '', '', '0', 0, '', 0, 0, 0, '                                      \r\n                                    ', '123456'),
(10, '', 'sohel khan', 'admin@os.com', '', '', '', '0', 0, '', 0, 0, 0, '                                      \r\n                                    ', '123456'),
(11, '', 'sohel khan', 'admin@os.com', '', '', '', '0', 0, '', 0, 0, 0, '                                      \r\n                                    ', '123456'),
(12, '', 'sohel khan', 'admin@os.com', '', '', '', '0', 0, '', 0, 0, 0, '                                      \r\n                                    ', '123456'),
(13, '', 'sohel khan', 'admin@os.com', '', '', '', '0', 0, '', 0, 0, 0, '                                      \r\n                                    ', '123456'),
(14, '', 'sohel khan', 'admin@os.com', '', '', '', '0', 0, '', 0, 0, 0, '                                      \r\n                                    ', '123456'),
(15, '', 'rahul deshmukhfff', 'admin@os.com', '', '', '', '0', 0, '', 0, 0, 0, '                                      \r\n                                    ', '123456'),
(16, '', 'rahul deshmukhfff', 'admin@os.com', '', '', '', '0', 0, '', 0, 0, 0, '                                      \r\n                                    ', '123456'),
(17, '', 'rahul deshmukhfff', 'admin@os.com', '', '', '', '0', 0, '', 0, 0, 0, '                                      \r\n                                    ', '123456'),
(18, '', 'rahul deshmukhfff', 'admin@os.com', '', '', '', '0', 0, '', 0, 0, 0, '                                      \r\n                                    ', '123456'),
(19, '', 'rahul deshmukhfff', 'admin@os.com', '', '', '', '0', 0, '', 0, 0, 0, '                                      \r\n                                    ', '123456'),
(20, '', 'rahul deshmukhfff', 'admin@os.com', '', '', '', '0', 0, '', 0, 0, 0, '                                      \r\n                                    ', '123456'),
(21, '', 'rahul deshmukhfff', 'admin@os.com', '', '', '', '0', 0, '', 0, 0, 0, '                                      \r\n                                    ', '123456'),
(22, '', 'rahul deshmukhfff', 'admin@os.com', '', '', '', '0', 0, '', 0, 0, 0, '                                      \r\n                                    ', '123456'),
(23, '', 'rahul deshmukhfff', 'admin@os.com', '', '', '', '0', 0, '', 0, 0, 0, '                                      \r\n                                    ', '123456'),
(24, '', 'rahul deshmukhfff', 'admin@os.com', '', '', '', '0', 0, '', 0, 0, 0, '                                      \r\n                                    ', '123456'),
(25, '', '', 'admin@os.com', '', '', '', '0', 0, '', 0, 0, 0, '                                      \r\n                                    ', '123456'),
(26, '', '', '', '', '', '', '0', 0, '', 0, 0, 0, '                                      \r\n                                    ', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `employee_resources`
--

CREATE TABLE `employee_resources` (
  `id` int(11) NOT NULL,
  `company_id` varchar(255) DEFAULT NULL,
  `project_id` varchar(255) DEFAULT NULL,
  `task_id` varchar(255) DEFAULT NULL,
  `employee_id` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `hour` varchar(255) DEFAULT NULL,
  `approved_status` varchar(255) DEFAULT NULL COMMENT '0 = pending, 1 = accepted, 2 = rejected',
  `comment` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_resources`
--

INSERT INTO `employee_resources` (`id`, `company_id`, `project_id`, `task_id`, `employee_id`, `date`, `hour`, `approved_status`, `comment`, `created_at`) VALUES
(1, '5', '5', '4', '23', '2021-01-22', '5', NULL, NULL, '2021-01-22 19:11:24'),
(2, '5', '5', '4', '23', '2021-01-21', '5', NULL, NULL, '2021-01-22 19:12:23'),
(3, '5', '5', '4', '23', '2021-01-20', '5', NULL, NULL, '2021-01-22 19:12:23'),
(4, '7', '6', '5', '23', '2021-01-27', '8', NULL, NULL, '2021-01-27 15:07:20');

-- --------------------------------------------------------

--
-- Table structure for table `expense_appliedby_employee`
--

CREATE TABLE `expense_appliedby_employee` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `expense_category_id` int(11) NOT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `remark` varchar(255) NOT NULL,
  `status` enum('pending','approved','decline') NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expense_appliedby_employee`
--

INSERT INTO `expense_appliedby_employee` (`id`, `employee_id`, `expense_category_id`, `amount`, `img`, `remark`, `status`, `created_at`) VALUES
(1, 23, 1, '1500', 'Lolli-clone1.jpg', 'fdgdfgdf', 'approved', '0000-00-00 00:00:00'),
(2, 23, 1, '1560', 'ChowNow-Clone-Need-To-Have-An-App-Like-ChowNow-For-Your-Food-Delivery-Business.jpg', 'fghgfh', 'pending', '0000-00-00 00:00:00'),
(3, 23, 1, '462', 'ChowNow-Clone-Need-To-Have-An-App-Like-ChowNow-For-Your-Food-Delivery-Business1.jpg', 'asd', 'decline', '0000-00-00 00:00:00'),
(4, 23, 4, '273', '', '2000', 'pending', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `expense_categories`
--

CREATE TABLE `expense_categories` (
  `expense_category_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expense_categories`
--

INSERT INTO `expense_categories` (`expense_category_id`, `name`, `status`, `created_at`) VALUES
(1, 'AIR', 1, '2021-01-23 17:28:19'),
(2, 'Travel', 1, '2021-01-27 12:26:21'),
(3, 'Food', 1, '2021-01-27 12:26:35'),
(4, 'meeting', 1, '2021-01-27 13:28:28'),
(5, 'Air Ticket', 1, '2021-01-28 16:29:22');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `category` int(11) DEFAULT NULL COMMENT '1=service_provider,2=website',
  `question` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `answer` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '0=deactive,1=active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `category`, `question`, `answer`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '<p><strong>Lorem</strong> Ipsum has been the industry</p>', '<p><strong>text </strong>of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 1, NULL, NULL),
(2, 1, '<p><strong>Lorem</strong> Ipsum has been the industry&#39;s</p>\r\n', '<p><strong>text </strong>of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the releasfghfge of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n', 1, '2021-01-13 00:20:05', '2021-01-13 00:20:05'),
(5, NULL, '<p>How many Leaves</p>\r\n', '<p>As Per Leave Policy</p>\r\n', 1, '2021-01-22 21:23:50', '2021-01-22 21:23:50');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_access_history`
--

CREATE TABLE `hrms_access_history` (
  `history_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `access_id` int(11) NOT NULL,
  `action` varchar(50) NOT NULL,
  `access_type` varchar(200) NOT NULL,
  `access` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_access_history`
--

INSERT INTO `hrms_access_history` (`history_id`, `employee_id`, `access_id`, `action`, `access_type`, `access`, `created_at`, `status`) VALUES
(1, 10, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.120/ilinkhr/employees/detail/10\"><strong>kripa saxena</strong> logged in.</a></p>', '2018-01-09 11:07:32', 0),
(2, 20, 0, 'Processed', 'Forgot Password', '<p><a href=\"http://192.168.1.120/ilinkhr/employees/detail/20\"><strong>Hemant Anjana</strong> was forgot his password.</a></p>', '2018-01-09 11:20:49', 0),
(3, 10, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.120/ilinkhr/employees/detail/10\"><strong>shilpa agrwal</strong> logged in.</a></p>', '2018-01-09 11:59:16', 0),
(4, 10, 0, 'Edited', 'Update Profile', '<p><a href=\"http://192.168.1.120/ilinkhr/employees/detail/10\"><strong>shilpa agrwal</strong> updated her profile.</a></p>', '2018-01-09 12:00:15', 0),
(5, 10, 0, 'Added', 'Task Images', '<p><a href=\"http://192.168.1.120/ilinkhr/timesheet/task_details/id/5\"><strong>shilpa agrwal</strong> added/removed images to the task.</a></p>', '2018-01-09 12:00:48', 0),
(6, 10, 0, 'Added', 'Task Images', '<p><a href=\"http://192.168.1.120/ilinkhr/timesheet/task_details/id/5\"><strong>shilpa agrwal</strong> added/removed images to the task.</a></p>', '2018-01-09 12:01:21', 0),
(7, 10, 0, 'Added', 'Task Images', '<p><a href=\"http://192.168.1.120/ilinkhr/timesheet/task_details/id/7\"><strong>shilpa agrwal</strong> added/removed images to the task.</a></p>', '2018-01-09 12:01:34', 0),
(8, 10, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.120/ilinkhr/employees/detail/10\"><strong>shilpa agrwal</strong> logged in.</a></p>', '2018-01-09 12:03:22', 0),
(9, 10, 0, 'Processed', 'Punch In', '<p><a href=\"http://192.168.1.120/ilinkhr/timesheet/attendance/\"><strong>shilpa agrwal</strong> punched in.</a></p>', '2018-01-09 12:05:07', 0),
(10, 10, 0, 'Processed', 'Punch Out', '<p><a href=\"http://192.168.1.120/ilinkhr/timesheet/attendance/\"><strong>shilpa agrwal</strong> punched out.</a></p>', '2018-01-09 12:05:09', 0),
(11, 10, 0, 'Processed', 'Punch In', '<p><a href=\"http://192.168.1.120/ilinkhr/timesheet/attendance/\"><strong>shilpa agrwal</strong> punched in.</a></p>', '2018-01-09 12:05:11', 0),
(12, 10, 0, 'Processed', 'Punch Out', '<p><a href=\"http://192.168.1.120/ilinkhr/timesheet/attendance/\"><strong>shilpa agrwal</strong> punched out.</a></p>', '2018-01-09 12:05:12', 0),
(13, 10, 0, 'Processed', 'Punch In', '<p><a href=\"http://192.168.1.120/ilinkhr/timesheet/attendance/\"><strong>shilpa agrwal</strong> punched in.</a></p>', '2018-01-09 12:05:24', 0),
(14, 10, 0, 'Processed', 'Punch Out', '<p><a href=\"http://192.168.1.120/ilinkhr/timesheet/attendance/\"><strong>shilpa agrwal</strong> punched out.</a></p>', '2018-01-09 12:05:27', 0),
(15, 10, 0, 'Edited', 'Update Profile', '<p><a href=\"http://192.168.1.120/ilinkhr/employees/detail/10\"><strong>shilpa agrwal</strong> updated her profile.</a></p>', '2018-01-09 12:09:47', 0),
(16, 10, 0, 'Edited', 'Profile Image Update', '<p><a href=\"http://192.168.1.120/ilinkhr/employees/detail/10\"><strong>shilpa agrwal</strong> changed her cover image.</a></p>', '2018-01-09 12:10:22', 0),
(17, 10, 0, 'Edited', 'Profile Cover Update', '<p><a href=\"http://192.168.1.120/ilinkhr/employees/detail/10\"><strong>shilpa agrwal</strong> changed her cover image.</a></p>', '2018-01-09 12:12:01', 0),
(18, 10, 0, 'Added', 'Leave', '<p><a href=\"http://192.168.1.120/ilinkhr/timesheet/leave/\"><strong>shilpa agrwal</strong> applied for leave.</a></p>', '2018-01-09 12:13:03', 0),
(19, 10, 0, 'Added', 'No Work', '<p><a href=\"http://192.168.1.120/ilinkhr/employees/no_work/\"><strong>shilpa agrwal</strong> remind for no work.</a></p>', '2018-01-09 12:13:27', 0),
(20, 10, 0, 'Added', 'Task Images', '<p><a href=\"http://192.168.1.120/ilinkhr/timesheet/task_details/id/5\"><strong>shilpa agrwal</strong> added/removed images from the task.</a></p>', '2018-01-09 12:14:05', 0),
(21, 10, 0, 'Added', 'Project Query', '<p><a href=\"http://192.168.1.120/ilinkhr/timesheet/task_details/id/5\"><strong>shilpa agrwal</strong> have a query about her task.</a></p>', '2018-01-09 12:14:35', 0),
(22, 10, 0, 'Added', 'File Management', '<p><a href=\"http://192.168.1.120/ilinkhr/file_management\"><strong>shilpa agrwal</strong> added a file.</a></p>', '2018-01-09 12:15:19', 0),
(23, 10, 0, 'Added', 'Appraisal Application', '<p><a href=\"http://192.168.1.120/ilinkhr/performance/appraisal_applications\"><strong>shilpa agrwal</strong> applied for appraisal.</a></p>', '2018-01-09 12:17:04', 0),
(24, 10, 0, 'Added', 'File Management', '<p><a href=\"http://192.168.1.120/ilinkhr/file_management\"><strong>shilpa agrwal</strong> added a file.</a></p>', '2018-01-09 12:17:23', 0),
(25, 10, 0, 'Added', 'File Request', '<p><a href=\"http://192.168.1.120/ilinkhr/file_management\"><strong>shilpa agrwal</strong> requested for a file.</a></p>', '2018-01-09 12:19:44', 0),
(26, 10, 0, 'Added', 'File Request', '<p><a href=\"http://192.168.1.120/ilinkhr/tickets\"><strong>shilpa agrwal</strong> generated a ticket.</a></p>', '2018-01-09 12:20:25', 0),
(27, 10, 0, 'Added', 'Travel Expense', '<p><a href=\"http://192.168.1.120/ilinkhr/travel\"><strong>shilpa agrwal</strong> added travel expense.</a></p>', '2018-01-09 12:21:26', 0),
(28, 10, 0, 'Added', 'Survey', '<p><a href=\"http://192.168.1.120/ilinkhr/survey/employee_survey\"><strong>shilpa agrwal</strong> take a tour to survey.</a></p>', '2018-01-09 12:21:49', 0),
(29, 10, 0, 'Added', 'Survey', '<p><a href=\"http://192.168.1.120/ilinkhr/survey/employee_survey\"><strong>shilpa agrwal</strong> take a tour to survey.</a></p>', '2018-01-09 12:21:49', 0),
(30, 10, 0, 'Edited', 'Update Health', '<p><a href=\"http://192.168.1.120/ilinkhr/employees/detail/10\"><strong>shilpa agrwal</strong> update her health detail.</a></p>', '2018-01-09 12:22:20', 0),
(31, 10, 0, 'Added', 'Medical Convocation Request', '<p><a href=\"http://192.168.1.120/ilinkhr/employees/medical_convocation/\"><strong>shilpa agrwal</strong> requested for her medical convocation.</a></p>', '2018-01-09 12:22:22', 0),
(32, 10, 0, 'Added', 'Feedback', '<p><a href=\"http://192.168.1.120/ilinkhr/employees/feedback/\"><strong>shilpa agrwal</strong> gave her feedback.</a></p>', '2018-01-09 12:22:51', 0),
(33, 10, 0, 'Added', 'File Management', '<p><a href=\"http://192.168.1.120/ilinkhr/file_management\"><strong>shilpa agrwal</strong> added a file.</a></p>', '2018-01-09 12:35:15', 0),
(34, 10, 0, 'Added', 'File Request', '<p><a href=\"http://192.168.1.120/ilinkhr/file_management\"><strong>shilpa agrwal</strong> requested for a file.</a></p>', '2018-01-09 12:36:12', 0),
(35, 10, 0, 'Added', 'Recruiment', '<p><a href=\"http://192.168.1.120/ilinkhr/job_post\"><strong>shilpa agrwal</strong> applied for job requirement.</a></p>', '2018-01-10 07:33:15', 0),
(36, 10, 0, 'Added', 'Recruiment', '<p><a href=\"http://192.168.1.120/ilinkhr/job_post\"><strong>shilpa agrwal</strong> applied for job requirement.</a></p>', '2018-01-10 07:42:32', 0),
(37, 10, 0, 'Added', 'Recruiment', '<p><a href=\"http://192.168.1.120/ilinkhr/job_post\"><strong>shilpa agrwal</strong> applied for job requirement.</a></p>', '2018-01-10 11:16:48', 0),
(38, 10, 0, 'Added', 'File Request', '<p><a href=\"http://192.168.1.120/ilinkhr/file_management\"><strong>shilpa agrwal</strong> requested for a file.</a></p>', '2018-01-10 11:17:43', 0),
(39, 10, 0, 'Added', 'Appraisal Application', '<p><a href=\"http://192.168.1.120/ilinkhr/performance/appraisal_applications\"><strong>shilpa agrwal</strong> applied for appraisal.</a></p>', '2018-01-10 11:19:51', 0),
(40, 10, 0, 'Added', 'Recruiment', '<p><a href=\"http://192.168.1.120/ilinkhr/job_post\"><strong>shilpa agrwal</strong> applied for job requirement.</a></p>', '2018-01-10 11:24:35', 0),
(41, 10, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.120/ilinkhr/employees/detail/10\"><strong>shilpa agrwal</strong> logged in.</a></p>', '2018-01-11 06:31:37', 0),
(42, 10, 0, 'Edited', 'Update Health', '<p><a href=\"http://192.168.1.120/ilinkhr/employees/detail/10\"><strong>shilpa agrwal</strong> update her health detail.</a></p>', '2018-01-11 09:18:32', 0),
(43, 1, 0, 'Added', 'Task Images', '<p><a href=\"http://192.168.1.120/ilinkhr/timesheet/task_details/id/7\"><strong>Admin Admin</strong> added/removed images from the task.</a></p>', '2018-01-11 13:40:09', 0),
(44, 1, 0, 'Processed', 'Punch In', '<p><a href=\"https://infograins.in/INFO01/hrms/timesheet/attendance/\"><strong>Admin Admin</strong> punched in.</a></p>', '2018-01-13 00:04:31', 0),
(45, 1, 0, 'Processed', 'Login', '<p><a href=\"https://infograins.in/INFO01/hrms/employees/detail/1\"><strong>Admin Admin</strong> logged in.</a></p>', '2018-01-18 06:18:17', 0),
(46, 1, 0, 'Processed', 'Login', '<p><a href=\"https://infograins.in/INFO01/hrms/employees/detail/1\"><strong>Admin Admin</strong> logged in.</a></p>', '2018-01-18 06:19:34', 0),
(47, 1, 0, 'Added', 'Medical Convocation Request', '<p><a href=\"https://infograins.in/INFO01/hrms/employees/medical_convocation/\"><strong>Admin Admin</strong> requested for his medical convocation.</a></p>', '2018-01-18 06:20:41', 0),
(48, 10, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.120/ilinkhr/employees/detail/10\"><strong>shilpa agrwal</strong> logged in.</a></p>', '2018-03-05 07:16:19', 0),
(49, 10, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.120/ilinkhr/employees/detail/10\"><strong>shilpa agrwal</strong> logged in.</a></p>', '2018-03-05 07:16:54', 0),
(50, 10, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.120/ilinkhr/employees/detail/10\"><strong>shilpa agrwal</strong> logged in.</a></p>', '2018-03-05 07:20:52', 0),
(51, 1, 0, 'Processed', 'Punch Out', '<p><a href=\"https://infograins.in/INFO01/hrms/timesheet/attendance/\"><strong>Admin Admin</strong> punched out.</a></p>', '2018-03-08 03:17:49', 0),
(52, 1, 0, 'Processed', 'Punch In', '<p><a href=\"https://infograins.in/INFO01/hrms/timesheet/attendance/\"><strong>Admin Admin</strong> punched in.</a></p>', '2018-03-08 03:17:53', 0),
(53, 1, 0, 'Added', 'Ticket Generated', '<p><a href=\"https://infograins.in/INFO01/hrms/tickets\"><strong>Admin Admin</strong> generated a ticket.</a></p>', '2018-03-08 03:20:32', 0),
(54, 10, 0, 'Processed', 'Login', '<p><a href=\"https://infograins.in/INFO01/hrms/employees/detail/10\"><strong>shilpa agrwal</strong> logged in.</a></p>', '2018-03-08 21:45:18', 0),
(55, 16, 0, 'Added', 'Ticket Generated', '<p><a href=\"https://infograins.in/INFO01/hrms/tickets\"><strong>deepak shrama</strong> generated a ticket.</a></p>', '2018-04-16 23:25:11', 0),
(56, 10, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/10\"><strong>shilpa agrwal</strong> logged in.</a></p>', '2018-04-18 09:59:08', 0),
(57, 10, 0, 'Processed', 'Punch In', '<p><a href=\"http://192.168.1.118/hrms/timesheet/attendance/\"><strong>shilpa agrwal</strong> punched in.</a></p>', '2018-04-18 09:59:39', 0),
(58, 10, 0, 'Processed', 'Punch Out', '<p><a href=\"http://192.168.1.118/hrms/timesheet/attendance/\"><strong>shilpa agrwal</strong> punched out.</a></p>', '2018-04-18 10:03:08', 0),
(59, 10, 0, 'Processed', 'Punch In', '<p><a href=\"http://192.168.1.118/hrms/timesheet/attendance/\"><strong>shilpa agrwal</strong> punched in.</a></p>', '2018-04-18 10:16:55', 0),
(60, 10, 0, 'Processed', 'Punch Out', '<p><a href=\"http://192.168.1.118/hrms/timesheet/attendance/\"><strong>shilpa agrwal</strong> punched out.</a></p>', '2018-04-18 10:26:17', 0),
(61, 10, 0, 'Processed', 'Punch In', '<p><a href=\"http://192.168.1.118/hrms/timesheet/attendance/\"><strong>shilpa agrwal</strong> punched in.</a></p>', '2018-04-18 11:52:24', 0),
(62, 10, 0, 'Processed', 'Punch Out', '<p><a href=\"http://192.168.1.118/hrms/timesheet/attendance/\"><strong>shilpa agrwal</strong> punched out.</a></p>', '2018-04-18 11:53:38', 0),
(63, 48, 0, 'Processed', 'Punch In', '<p><a href=\"http://192.168.1.118/hrms/timesheet/attendance/\"><strong>testTwo testTwo</strong> punched in.</a></p>', '2018-04-25 07:15:24', 0),
(64, 48, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/48\"><strong>testTwo testTwo</strong> logged in.</a></p>', '2018-04-25 10:45:32', 0),
(65, 48, 0, 'Added', 'Apply For Leave', '<p><a href=\"http://192.168.1.118/hrms/timesheet/leave/\"><strong>testTwo testTwo</strong> applied for leave.</a></p>', '2018-04-25 10:55:57', 0),
(66, 48, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/48\"><strong>testTwo testTwo</strong> logged in.</a></p>', '2018-04-25 11:05:19', 0),
(67, 48, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/48\"><strong>testTwo testTwo</strong> logged in.</a></p>', '2018-04-25 11:21:37', 0),
(68, 45, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/45\"><strong>tina jain</strong> logged in.</a></p>', '2018-04-26 06:41:31', 0),
(69, 0, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/0\"><strong> </strong> logged in.</a></p>', '2018-04-26 06:50:35', 0),
(70, 0, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/0\"><strong> </strong> logged in.</a></p>', '2018-04-26 06:57:12', 0),
(71, 49, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/49\"><strong>tina jain</strong> logged in.</a></p>', '2018-04-26 07:08:57', 0),
(72, 49, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/49\"><strong>tina jain</strong> logged in.</a></p>', '2018-04-26 07:09:16', 0),
(73, 49, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/49\"><strong>tina jain</strong> logged in.</a></p>', '2018-04-26 07:09:45', 0),
(74, 49, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/49\"><strong>tina jain</strong> logged in.</a></p>', '2018-04-26 07:13:32', 0),
(75, 49, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/49\"><strong>tina jain</strong> logged in.</a></p>', '2018-04-26 07:16:16', 0),
(76, 49, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/49\"><strong>tina jain</strong> logged in.</a></p>', '2018-04-26 07:17:12', 0),
(77, 49, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/49\"><strong>tina jain</strong> logged in.</a></p>', '2018-04-26 07:18:28', 0),
(78, 49, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/49\"><strong>tina jain</strong> logged in.</a></p>', '2018-04-26 07:41:29', 0),
(79, 48, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/48\"><strong>testTwo testTwo</strong> logged in.</a></p>', '2018-04-26 12:12:47', 0),
(80, 49, 0, 'Added', 'Ticket Generated', '<p><a href=\"http://192.168.1.118/hrms/tickets\"><strong>tina jain</strong> generated a ticket.</a></p>', '2018-04-26 12:31:47', 0),
(81, 49, 0, 'Added', 'Ticket Generated', '<p><a href=\"http://192.168.1.118/hrms/tickets\"><strong>tina jain</strong> generated a ticket.</a></p>', '2018-04-26 12:49:41', 0),
(82, 49, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/49\"><strong>tina jain</strong> logged in.</a></p>', '2018-04-28 10:13:48', 0),
(83, 49, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/49\"><strong>tina jain</strong> logged in.</a></p>', '2018-04-28 10:14:42', 0),
(84, 49, 0, 'Added', 'Apply For Leave', '<p><a href=\"http://192.168.1.118/hrms/timesheet/leave/\"><strong>tina jain</strong> applied for leave.</a></p>', '2018-04-28 10:41:29', 0),
(85, 4, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/4\"><strong>Vipin Shukla</strong> logged in.</a></p>', '2018-04-28 11:03:15', 0),
(86, 17, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/17\"><strong>archna jayswal</strong> logged in.</a></p>', '2018-04-30 09:03:41', 0),
(87, 4, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/4\"><strong>Vipin Shukla</strong> logged in.</a></p>', '2018-05-01 05:36:55', 0),
(88, 4, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/4\"><strong>Vipin Shukla</strong> logged in.</a></p>', '2018-05-01 06:30:30', 0),
(89, 49, 0, 'Added', 'Ticket Generated', '<p><a href=\"http://192.168.1.118/hrms/tickets\"><strong>tina jain</strong> generated a ticket.</a></p>', '2018-05-01 06:54:46', 0),
(90, 49, 0, 'Added', 'Travel Expense', '<p><a href=\"http://192.168.1.118/hrms/travel\"><strong>tina jain</strong> added travel expense.</a></p>', '2018-05-01 06:56:14', 0),
(91, 1, 0, 'Added', 'Ticket Generated', '<p><a href=\"http://192.168.1.118/hrms/tickets\"><strong>Admin Admin</strong> generated a ticket.</a></p>', '2018-05-01 07:29:52', 0),
(92, 1, 0, 'Added', 'Appraisal Application', '<p><a href=\"http://192.168.1.118/hrms/performance/appraisal_applications\"><strong>Admin Admin</strong> applied for appraisal.</a></p>', '2018-05-01 07:32:06', 0),
(93, 49, 0, 'Added', 'Appraisal Application', '<p><a href=\"http://192.168.1.118/hrms/performance/appraisal_applications\"><strong>tina jain</strong> applied for appraisal.</a></p>', '2018-05-01 09:10:36', 0),
(94, 1, 0, 'Added', 'Appraisal Application', '<p><a href=\"http://192.168.1.118/hrms/performance/appraisal_applications\"><strong>Admin Admin</strong> applied for appraisal.</a></p>', '2018-05-01 10:07:54', 0),
(95, 49, 0, 'Added', 'Appraisal Application', '<p><a href=\"http://192.168.1.118/hrms/performance/appraisal_applications\"><strong>tina jain</strong> applied for appraisal.</a></p>', '2018-05-01 11:13:19', 0),
(96, 49, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/49\"><strong>tina jain</strong> logged in.</a></p>', '2018-05-02 05:17:52', 0),
(97, 10, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/10\"><strong>shilpa agrwal</strong> logged in.</a></p>', '2018-05-02 05:18:05', 0),
(98, 10, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/10\"><strong>shilpa agrwal</strong> logged in.</a></p>', '2018-05-02 05:18:09', 0),
(99, 49, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/49\"><strong>tina jain</strong> logged in.</a></p>', '2018-05-02 05:19:04', 0),
(100, 10, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/10\"><strong>shilpa agrwal</strong> logged in.</a></p>', '2018-05-02 05:19:22', 0),
(101, 49, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/49\"><strong>tina jain</strong> logged in.</a></p>', '2018-05-02 05:25:07', 0),
(102, 49, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/49\"><strong>tina jain</strong> logged in.</a></p>', '2018-05-02 05:33:34', 0),
(103, 49, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/49\"><strong>tina jain</strong> logged in.</a></p>', '2018-05-02 05:33:41', 0),
(104, 49, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/49\"><strong>tina jain</strong> logged in.</a></p>', '2018-05-02 05:33:43', 0),
(105, 49, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/49\"><strong>tina jain</strong> logged in.</a></p>', '2018-05-02 05:33:57', 0),
(106, 49, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/49\"><strong>tina jain</strong> logged in.</a></p>', '2018-05-02 05:51:19', 0),
(107, 10, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/10\"><strong>shilpa agrwal</strong> logged in.</a></p>', '2018-05-02 06:10:46', 0),
(108, 49, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/49\"><strong>tina jain</strong> logged in.</a></p>', '2018-05-02 06:17:21', 0),
(109, 49, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/49\"><strong>tina jain</strong> logged in.</a></p>', '2018-05-02 06:17:30', 0),
(110, 4, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/4\"><strong>Vipin Shukla</strong> logged in.</a></p>', '2018-05-02 06:20:02', 0),
(111, 4, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/4\"><strong>Vipin Shukla</strong> logged in.</a></p>', '2018-05-02 06:21:55', 0),
(112, 49, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/49\"><strong>tina jain</strong> logged in.</a></p>', '2018-05-02 06:41:22', 0),
(113, 49, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/49\"><strong>tina jain</strong> logged in.</a></p>', '2018-05-02 06:44:01', 0),
(114, 49, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/49\"><strong>tina jain</strong> logged in.</a></p>', '2018-05-02 06:45:04', 0),
(115, 10, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/10\"><strong>shilpa agrwal</strong> logged in.</a></p>', '2018-05-02 06:52:23', 0),
(116, 4, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/4\"><strong>Vipin Shukla</strong> logged in.</a></p>', '2018-05-02 10:19:14', 0),
(117, 4, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/4\"><strong>Vipin Shukla</strong> logged in.</a></p>', '2018-05-02 10:19:32', 0),
(118, 4, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/4\"><strong>Vipin Shukla</strong> logged in.</a></p>', '2018-05-02 10:21:30', 0),
(119, 4, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/4\"><strong>Vipin Shukla</strong> logged in.</a></p>', '2018-05-02 10:23:19', 0),
(120, 4, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/4\"><strong>Vipin Shukla</strong> logged in.</a></p>', '2018-05-02 10:25:23', 0),
(121, 4, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/4\"><strong>Vipin Shukla</strong> logged in.</a></p>', '2018-05-02 10:25:48', 0),
(122, 5, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/5\"><strong>Abdul Alim</strong> logged in.</a></p>', '2018-05-02 10:28:20', 0),
(123, 5, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/5\"><strong>Abdul Alim</strong> logged in.</a></p>', '2018-05-02 10:28:31', 0),
(124, 5, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/5\"><strong>Abdul Alim</strong> logged in.</a></p>', '2018-05-02 10:28:51', 0),
(125, 5, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/5\"><strong>Abdul Alim</strong> logged in.</a></p>', '2018-05-02 10:29:53', 0),
(126, 5, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/5\"><strong>Abdul Alim</strong> logged in.</a></p>', '2018-05-02 10:30:46', 0),
(127, 5, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/5\"><strong>Abdul Alim</strong> logged in.</a></p>', '2018-05-02 10:32:35', 0),
(128, 5, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/5\"><strong>Abdul Alim</strong> logged in.</a></p>', '2018-05-02 11:11:34', 0),
(129, 5, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/5\"><strong>Abdul Alim</strong> logged in.</a></p>', '2018-05-02 11:18:55', 0),
(130, 49, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/49\"><strong>tina jain</strong> logged in.</a></p>', '2018-05-02 11:20:18', 0),
(131, 5, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/5\"><strong>Abdul Alim</strong> logged in.</a></p>', '2018-05-02 12:08:43', 0),
(132, 5, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/5\"><strong>Abdul Alim</strong> logged in.</a></p>', '2018-05-02 13:52:56', 0),
(133, 5, 0, 'Added', 'Medical Convocation Request', '<p><a href=\"http://192.168.1.118/hrms/employees/medical_convocation/\"><strong>Abdul Alim</strong> requested for his medical convocation.</a></p>', '2018-05-02 14:01:25', 0),
(134, 5, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/5\"><strong>Abdul Alim</strong> logged in.</a></p>', '2018-05-03 06:42:52', 0),
(135, 5, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/5\"><strong>Abdul Alim</strong> logged in.</a></p>', '2018-05-03 06:50:21', 0),
(136, 4, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/4\"><strong>Vipin Shukla</strong> logged in.</a></p>', '2018-05-03 12:15:48', 0),
(137, 49, 0, 'Added', 'Ticket Generated', '<p><a href=\"http://192.168.1.118/hrms/tickets\"><strong>shilpa agrwal</strong> generated a ticket.</a></p>', '2018-05-03 13:29:49', 0),
(138, 49, 0, 'Added', 'Ticket Generated', '<p><a href=\"http://192.168.1.118/hrms/tickets\"><strong>shilpa agrwal</strong> generated a ticket.</a></p>', '2018-05-03 13:35:25', 0),
(139, 49, 0, 'Added', 'Appraisal Application', '<p><a href=\"http://192.168.1.118/hrms/performance/appraisal_applications\"><strong>shilpa agrwal</strong> applied for appraisal.</a></p>', '2018-05-04 13:33:32', 0),
(140, 52, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/52\"><strong>ritika bhawsar</strong> logged in.</a></p>', '2018-05-04 14:12:11', 0),
(141, 52, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/52\"><strong>ritika bhawsar</strong> logged in.</a></p>', '2018-05-04 14:14:48', 0),
(142, 52, 0, 'Processed', 'Login', '<p><a href=\"http://192.168.1.118/hrms/employees/detail/52\"><strong>ritika bhawsar</strong> logged in.</a></p>', '2018-05-04 14:16:35', 0),
(143, 52, 0, 'Processed', 'Punch In', '<p><a href=\"http://192.168.1.118/hrms/timesheet/attendance/\"><strong>ritika bhawsar</strong> punched in.</a></p>', '2018-05-04 14:39:10', 0),
(144, 53, 0, 'Processed', 'Login', '<p><a href=\"https://infograins.in/INFO01/hrms/employees/detail/53\"><strong>abdul admin</strong> logged in.</a></p>', '2018-05-05 19:47:56', 0),
(145, 53, 0, 'Processed', 'Login', '<p><a href=\"https://infograins.in/INFO01/hrms/employees/detail/53\"><strong>abdul admin</strong> logged in.</a></p>', '2018-05-05 19:55:52', 0),
(146, 52, 0, 'Processed', 'Login', '<p><a href=\"https://infograins.in/INFO01/hrms/employees/detail/52\"><strong>ritika bhawsar</strong> logged in.</a></p>', '2018-05-05 20:09:24', 0),
(147, 52, 0, 'Processed', 'Login', '<p><a href=\"https://infograins.in/INFO01/hrms/employees/detail/52\"><strong>ritika bhawsar</strong> logged in.</a></p>', '2018-05-05 20:12:41', 0),
(148, 53, 0, 'Processed', 'Login', '<p><a href=\"https://infograins.in/INFO01/hrms/employees/detail/53\"><strong>abdul admin</strong> logged in.</a></p>', '2018-05-05 20:14:00', 0),
(149, 52, 0, 'Processed', 'Login', '<p><a href=\"https://infograins.in/INFO01/hrms/employees/detail/52\"><strong>ritika bhawsar</strong> logged in.</a></p>', '2018-05-05 20:16:57', 0),
(150, 52, 0, 'Processed', 'Login', '<p><a href=\"https://infograins.in/INFO01/hrms/employees/detail/52\"><strong>ritika bhawsar</strong> logged in.</a></p>', '2018-05-05 20:40:31', 0),
(151, 53, 0, 'Processed', 'Login', '<p><a href=\"https://infograins.in/INFO01/hrms/employees/detail/53\"><strong>abdul admin</strong> logged in.</a></p>', '2018-05-05 20:41:53', 0),
(152, 53, 0, 'Processed', 'Login', '<p><a href=\"https://infograins.in/INFO01/hrms/employees/detail/53\"><strong>abdul admin</strong> logged in.</a></p>', '2018-05-05 20:47:28', 0),
(153, 53, 0, 'Processed', 'Login', '<p><a href=\"https://infograins.in/INFO01/hrms/employees/detail/53\"><strong>abdul admin</strong> logged in.</a></p>', '2018-05-05 20:49:24', 0),
(154, 61, 0, 'Processed', 'Login', '<p><a href=\"https://infograins.in/INFO01/hrms/employees/detail/61\"><strong>pawan paliwal</strong> logged in.</a></p>', '2018-05-05 22:44:25', 0),
(155, 61, 0, 'Processed', 'Punch In', '<p><a href=\"https://infograins.in/INFO01/hrms/timesheet/attendance/\"><strong>pawan paliwal</strong> punched in.</a></p>', '2018-05-05 22:44:42', 0),
(156, 61, 0, 'Processed', 'Punch Out', '<p><a href=\"https://infograins.in/INFO01/hrms/timesheet/attendance/\"><strong>pawan paliwal</strong> punched out.</a></p>', '2018-05-05 22:44:49', 0),
(157, 61, 0, 'Added', 'No Work', '<p><a href=\"https://infograins.in/INFO01/hrms/employees/no_work/\"><strong>pawan paliwal</strong> remind for no work.</a></p>', '2018-05-05 22:47:25', 0),
(158, 61, 0, 'Added', 'Task Images', '<p><a href=\"https://infograins.in/INFO01/hrms/timesheet/task_details/id/8\"><strong>pawan paliwal</strong> added/removed images from the task.</a></p>', '2018-05-05 22:49:46', 0),
(159, 61, 0, 'Added', 'Project Query', '<p><a href=\"https://infograins.in/INFO01/hrms/timesheet/task_details/id/8\"><strong>pawan paliwal</strong> have a query about his task.</a></p>', '2018-05-05 22:49:58', 0),
(160, 62, 0, 'Processed', 'Login', '<p><a href=\"https://infograins.in/INFO01/hrms/employees/detail/62\"><strong>Ajay patidar</strong> logged in.</a></p>', '2018-05-05 22:51:52', 0),
(161, 62, 0, 'Added', 'No Work', '<p><a href=\"https://infograins.in/INFO01/hrms/employees/no_work/\"><strong>Ajay patidar</strong> remind for no work.</a></p>', '2018-05-05 22:52:02', 0),
(162, 62, 0, 'Added', 'Apply For Leave', '<p><a href=\"https://infograins.in/INFO01/hrms/timesheet/leave/\"><strong>Ajay patidar</strong> applied for leave.</a></p>', '2018-05-05 22:52:39', 0),
(163, 62, 0, 'Processed', 'Punch In', '<p><a href=\"https://infograins.in/INFO01/hrms/timesheet/attendance/\"><strong>Ajay patidar</strong> punched in.</a></p>', '2018-05-05 22:52:49', 0),
(164, 62, 0, 'Processed', 'Punch Out', '<p><a href=\"https://infograins.in/INFO01/hrms/timesheet/attendance/\"><strong>Ajay patidar</strong> punched out.</a></p>', '2018-05-05 22:52:52', 0),
(165, 62, 0, 'Added', 'No Work', '<p><a href=\"https://infograins.in/INFO01/hrms/employees/no_work/\"><strong>Ajay patidar</strong> remind for no work.</a></p>', '2018-05-05 22:56:27', 0),
(166, 62, 0, 'Added', 'Task Images', '<p><a href=\"https://infograins.in/INFO01/hrms/timesheet/task_details/id/9\"><strong>Ajay patidar</strong> added/removed images from the task.</a></p>', '2018-05-05 22:57:03', 0),
(167, 62, 0, 'Added', 'Project Query', '<p><a href=\"https://infograins.in/INFO01/hrms/timesheet/task_details/id/9\"><strong>Ajay patidar</strong> have a query about his task.</a></p>', '2018-05-05 22:57:35', 0),
(168, 62, 0, 'Added', 'Medical Convocation Request', '<p><a href=\"https://infograins.in/INFO01/hrms/employees/medical_convocation/\"><strong>Ajay patidar</strong> requested for  medical convocation.</a></p>', '2018-05-05 23:13:02', 0),
(169, 62, 0, 'Edited', 'Update Health', '<p><a href=\"https://infograins.in/INFO01/hrms/employees/detail/62\"><strong>Ajay patidar</strong> update  health detail.</a></p>', '2018-05-05 23:13:26', 0),
(170, 62, 0, 'Added', 'Appraisal Application', '<p><a href=\"https://infograins.in/INFO01/hrms/performance/appraisal_applications\"><strong>Ajay patidar</strong> applied for appraisal.</a></p>', '2018-05-05 23:18:39', 0),
(171, 62, 0, 'Added', 'No Work', '<p><a href=\"https://infograins.in/INFO01/hrms/employees/no_work/\"><strong>Ajay patidar</strong> remind for no work.</a></p>', '2018-05-05 23:19:50', 0),
(172, 62, 0, 'Added', 'Project Query', '<p><a href=\"https://infograins.in/INFO01/hrms/timesheet/task_details/id/9\"><strong>Ajay patidar</strong> have a query about  task.</a></p>', '2018-05-05 23:20:23', 0),
(173, 62, 0, 'Added', 'Project Query', '<p><a href=\"https://infograins.in/INFO01/hrms/timesheet/task_details/id/9\"><strong>Ajay patidar</strong> have a query about  task.</a></p>', '2018-05-05 23:21:43', 0),
(174, 62, 0, 'Added', 'Project Query', '<p><a href=\"https://infograins.in/INFO01/hrms/timesheet/task_details/id/1\"><strong>Ajay patidar</strong> have a query about  task.</a></p>', '2018-05-05 23:22:24', 0),
(175, 62, 0, 'Added', 'Ticket Generated', '<p><a href=\"https://infograins.in/INFO01/hrms/tickets\"><strong>Ajay patidar</strong> generated a ticket.</a></p>', '2018-05-05 23:40:07', 0),
(176, 61, 0, 'Processed', 'Login', '<p><a href=\"https://infograins.in/INFO01/hrms/employees/detail/61\"><strong>pawan paliwal</strong> logged in.</a></p>', '2018-05-05 23:53:19', 0),
(177, 61, 0, 'Processed', 'Punch In', '<p><a href=\"https://infograins.in/INFO01/hrms/timesheet/attendance/\"><strong>pawan paliwal</strong> punched in.</a></p>', '2018-05-05 23:53:50', 0),
(178, 61, 0, 'Processed', 'Punch Out', '<p><a href=\"https://infograins.in/INFO01/hrms/timesheet/attendance/\"><strong>pawan paliwal</strong> punched out.</a></p>', '2018-05-06 00:06:06', 0),
(179, 61, 0, 'Processed', 'Login', '<p><a href=\"https://infograins.in/INFO01/hrms/employees/detail/61\"><strong>pawan paliwal</strong> logged in.</a></p>', '2018-05-06 00:18:33', 0),
(180, 61, 0, 'Processed', 'Login', '<p><a href=\"https://infograins.in/INFO01/hrms/employees/detail/61\"><strong>pawan paliwal</strong> logged in.</a></p>', '2018-05-06 01:38:17', 0),
(181, 62, 0, 'Processed', 'Login', '<p><a href=\"https://infograins.in/INFO01/hrms/employees/detail/62\"><strong>Ajay patidar</strong> logged in.</a></p>', '2018-05-06 01:42:43', 0),
(182, 61, 0, 'Added', 'Travel Expense', '<p><a href=\"https://infograins.in/INFO01/hrms/travel\"><strong>pawan paliwal</strong> added travel expense.</a></p>', '2018-05-06 01:50:30', 0),
(183, 61, 0, 'Processed', 'Login', '<p><a href=\"https://infograins.in/INFO01/hrms/employees/detail/61\"><strong>pawan paliwal</strong> logged in.</a></p>', '2018-05-07 17:51:36', 0),
(184, 62, 0, 'Processed', 'Login', '<p><a href=\"https://infograins.in/INFO01/hrms/employees/detail/62\"><strong>Ajay patidar</strong> logged in.</a></p>', '2018-05-07 17:52:11', 0),
(185, 61, 0, 'Processed', 'Login', '<p><a href=\"https://infograins.in/INFO01/hrms/employees/detail/61\"><strong>pawan paliwal</strong> logged in.</a></p>', '2018-05-07 17:56:59', 0),
(186, 61, 0, 'Processed', 'Punch In', '<p><a href=\"https://infograins.in/INFO01/hrms/timesheet/attendance/\"><strong>pawan paliwal</strong> punched in.</a></p>', '2018-05-07 17:58:31', 0),
(187, 61, 0, 'Added', 'Ticket Generated', '<p><a href=\"https://infograins.in/INFO01/hrms/tickets\"><strong>pawan paliwal</strong> generated a ticket.</a></p>', '2018-05-07 18:00:18', 0),
(188, 61, 0, 'Processed', 'Login', '<p><a href=\"https://infograins.in/INFO01/hrms/employees/detail/61\"><strong>pawan paliwal</strong> logged in.</a></p>', '2018-05-07 18:16:30', 0),
(189, 61, 0, 'Added', 'Apply For Leave', '<p><a href=\"https://infograins.in/INFO01/hrms/timesheet/leave/\"><strong>pawan paliwal</strong> applied for leave.</a></p>', '2018-05-07 18:52:51', 0),
(190, 61, 0, 'Added', 'Apply For Leave', '<p><a href=\"https://infograins.in/INFO01/hrms/timesheet/leave/\"><strong>pawan paliwal</strong> applied for leave.</a></p>', '2018-05-07 18:53:58', 0),
(191, 61, 0, 'Added', 'Apply For Leave', '<p><a href=\"https://infograins.in/INFO01/hrms/timesheet/leave/\"><strong>pawan paliwal</strong> applied for leave.</a></p>', '2018-05-07 18:54:08', 0),
(192, 61, 0, 'Added', 'Travel Expense', '<p><a href=\"https://infograins.in/INFO01/hrms/travel\"><strong>pawan paliwal</strong> added travel expense.</a></p>', '2018-05-07 19:21:19', 0),
(193, 61, 0, 'Added', 'Travel Expense', '<p><a href=\"https://infograins.in/INFO01/hrms/travel\"><strong>pawan paliwal</strong> added travel expense.</a></p>', '2018-05-07 19:42:56', 0),
(194, 62, 0, 'Processed', 'Login', '<p><a href=\"https://infograins.in/INFO01/hrms/employees/detail/62\"><strong>Ajay patidar</strong> logged in.</a></p>', '2018-05-07 20:24:52', 0),
(195, 62, 0, 'Added', 'Apply For Leave', '<p><a href=\"https://infograins.in/INFO01/hrms/timesheet/leave/\"><strong>Ajay patidar</strong> applied for leave.</a></p>', '2018-05-07 20:25:21', 0),
(196, 62, 0, 'Added', 'Ticket Generated', '<p><a href=\"https://infograins.in/INFO01/hrms/tickets\"><strong>Ajay patidar</strong> generated a ticket.</a></p>', '2018-05-07 20:26:39', 0),
(197, 61, 0, 'Processed', 'Login', '<p><a href=\"https://infograins.in/INFO01/hrms/employees/detail/61\"><strong>pawan paliwal</strong> logged in.</a></p>', '2018-05-07 20:30:46', 0),
(198, 61, 0, 'Added', 'Appraisal Application', '<p><a href=\"https://infograins.in/INFO01/hrms/performance/appraisal_applications\"><strong>pawan paliwal</strong> applied for appraisal.</a></p>', '2018-05-07 22:01:00', 0),
(199, 61, 0, 'Processed', 'Punch Out', '<p><a href=\"https://infograins.in/INFO01/hrms/timesheet/attendance/\"><strong>pawan paliwal</strong> punched out.</a></p>', '2018-05-07 22:32:43', 0),
(200, 61, 0, 'Added', 'Ticket Generated', '<p><a href=\"https://infograins.in/INFO01/hrms/tickets\"><strong>pawan paliwal</strong> generated a ticket.</a></p>', '2018-05-07 23:26:48', 0),
(201, 61, 0, 'Processed', 'Login', '<p><a href=\"https://infograins.in/INFO01/hrms/employees/detail/61\"><strong>pawan paliwal</strong> logged in.</a></p>', '2018-05-07 23:35:05', 0),
(202, 62, 0, 'Processed', 'Login', '<p><a href=\"https://infograins.in/INFO01/hrms/employees/detail/62\"><strong>Ajay patidar</strong> logged in.</a></p>', '2018-05-08 17:16:33', 0),
(203, 64, 0, 'Processed', 'Login', '<p><a href=\"https://infograins.in/INFO01/hrms/employees/detail/64\"><strong>suma aa</strong> logged in.</a></p>', '2018-05-08 19:05:25', 0),
(204, 72, 0, 'Processed', 'Login', '<p><a href=\"https://infograins.in/INFO01/hrms/employees/detail/72\"><strong>ritika jain</strong> logged in.</a></p>', '2018-05-09 19:40:22', 0),
(205, 72, 0, 'Added', 'Task Images', '<p><a href=\"https://infograins.in/INFO01/hrms/timesheet/task_details/id/10\"><strong>ritika jain</strong> added/removed images from the task.</a></p>', '2018-05-09 20:15:40', 0),
(206, 72, 0, 'Added', 'Project Query', '<p><a href=\"https://infograins.in/INFO01/hrms/timesheet/task_details/id/10\"><strong>ritika jain</strong> have a query about  task.</a></p>', '2018-05-09 20:16:08', 0),
(207, 72, 0, 'Added', 'Task Images', '<p><a href=\"https://infograins.in/INFO01/hrms/timesheet/task_details/id/10\"><strong>ritika jain</strong> added/removed images from the task.</a></p>', '2018-05-09 20:17:28', 0),
(208, 72, 0, 'Added', 'Task Images', '<p><a href=\"https://infograins.in/INFO01/hrms/timesheet/task_details/id/10\"><strong>ritika jain</strong> added/removed images from the task.</a></p>', '2018-05-09 20:18:04', 0),
(209, 62, 0, 'Processed', 'Login', '<p><a href=\"https://infograins.in/INFO01/hrms/employees/detail/62\"><strong>Ajay patidar</strong> logged in.</a></p>', '2018-05-13 08:56:21', 0),
(210, 62, 0, 'Processed', 'Punch Out', '<p><a href=\"https://infograins.in/INFO01/hrms/timesheet/attendance/\"><strong>Ajay patidar</strong> punched out.</a></p>', '2018-05-14 02:46:18', 0),
(211, 62, 0, 'Added', 'File Request', '<p><a href=\"https://infograins.in/INFO01/hrms/file_management\"><strong>Ajay patidar</strong> requested for a file.</a></p>', '2018-05-14 02:50:21', 0),
(212, 62, 0, 'Added', 'Travel Expense', '<p><a href=\"https://infograins.in/INFO01/hrms/travel\"><strong>Ajay patidar</strong> added travel expense.</a></p>', '2018-05-14 02:55:44', 0);

-- --------------------------------------------------------

--
-- Table structure for table `hrms_announcements`
--

CREATE TABLE `hrms_announcements` (
  `announcement_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `start_date` varchar(200) NOT NULL,
  `end_date` varchar(200) NOT NULL,
  `company_id` int(111) NOT NULL,
  `location_id` int(111) NOT NULL,
  `department_id` int(111) NOT NULL,
  `published_by` int(111) NOT NULL,
  `summary` text NOT NULL,
  `description` varchar(10000) NOT NULL,
  `designation_id` varchar(50) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_announcements`
--

INSERT INTO `hrms_announcements` (`announcement_id`, `title`, `start_date`, `end_date`, `company_id`, `location_id`, `department_id`, `published_by`, `summary`, `description`, `designation_id`, `is_active`, `created_at`) VALUES
(1, 'party', '', '', 21, 0, 0, 59, 'party on saturday', '&lt;p&gt;&lt;br&gt;&lt;/p&gt;', '10', 0, '05-05-2018'),
(3, 'IT annoc', '2019-06-17', '2019-06-30', 33, 24, 35, 82, 'Added from the pages', '&lt;p&gt;Added again nhsjasas dadad&lt;/p&gt;', '10', 0, '17-06-2019'),
(4, 'QA1 Allownce', '', '', 33, 25, 34, 82, 'Added Summary first', '&lt;p&gt;Added the description first time.&lt;/p&gt;&lt;p&gt;&lt;/p&gt;&lt;ul&gt;&lt;li&gt;Rule 1&lt;/li&gt;&lt;li&gt;Rule 2&lt;/li&gt;&lt;li&gt;Rule 3&lt;/li&gt;&lt;li&gt;Rule 4&lt;/li&gt;&lt;li&gt;Rule 5&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;&lt;/p&gt;', '10', 0, '17-06-2019'),
(6, 'holiday', '', '', 21, 0, 0, 59, 'xcvxcvxcc', '&lt;p&gt;&lt;br&gt;&lt;/p&gt;', NULL, 0, '12-11-2020');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_appraisal_apply`
--

CREATE TABLE `hrms_appraisal_apply` (
  `appraisal_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `designation_id` int(11) NOT NULL,
  `last_appraisal_date` date NOT NULL,
  `expected_appraisal_date` date NOT NULL,
  `current_salary` float NOT NULL,
  `expected_salary` float NOT NULL,
  `promotion` int(11) NOT NULL,
  `apply_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `apply_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_appraisal_apply`
--

INSERT INTO `hrms_appraisal_apply` (`appraisal_id`, `user_id`, `name`, `designation_id`, `last_appraisal_date`, `expected_appraisal_date`, `current_salary`, `expected_salary`, `promotion`, `apply_date`, `apply_status`) VALUES
(1, 62, 'pawan', 2, '2018-05-05', '2019-05-30', 250000, 350000, 0, '2018-05-05 23:18:39', 0);

-- --------------------------------------------------------

--
-- Table structure for table `hrms_attendance_time`
--

CREATE TABLE `hrms_attendance_time` (
  `time_attendance_id` int(111) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `attendance_date` varchar(255) NOT NULL,
  `clock_in` varchar(255) NOT NULL,
  `clock_out` varchar(255) NOT NULL,
  `clock_in_out` varchar(255) NOT NULL,
  `time_late` varchar(255) NOT NULL,
  `early_leaving` varchar(255) NOT NULL,
  `overtime` varchar(255) NOT NULL,
  `total_work` varchar(255) NOT NULL,
  `total_rest` varchar(255) NOT NULL,
  `attendance_status` varchar(100) NOT NULL,
  `in_latitude` varchar(100) NOT NULL DEFAULT '0',
  `in_longitude` varchar(100) NOT NULL DEFAULT '0',
  `out_latitude` varchar(100) NOT NULL DEFAULT '0',
  `out_longitude` varchar(100) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_attendance_time`
--

INSERT INTO `hrms_attendance_time` (`time_attendance_id`, `employee_id`, `attendance_date`, `clock_in`, `clock_out`, `clock_in_out`, `time_late`, `early_leaving`, `overtime`, `total_work`, `total_rest`, `attendance_status`, `in_latitude`, `in_longitude`, `out_latitude`, `out_longitude`) VALUES
(1, 52, '2018-05-04', '2018-05-04 20:09:10', '2020-12-30 18:37:10', '0', '2018-05-04 20:09:10', '2020-12-30 18:37:10', '2020-12-30 18:37:10', '0:0', '', 'Present', '22.417615', '75.856164', '0', '0'),
(2, 61, '2018-05-05', '2018-05-05 15:44:42', '2020-12-30 18:37:10', '0', '2018-05-05 15:44:42', '2020-12-30 18:37:10', '2020-12-30 18:37:10', '0:0', '', 'Present', '22.6870580530005', '75.861471528258', '22.6870580530005', '75.861471528258'),
(3, 62, '2018-05-05', '2018-05-05 15:52:49', '2020-12-30 18:37:10', '0', '2018-05-05 15:52:49', '2020-12-30 18:37:10', '2020-12-30 18:37:10', '0:0', '', 'Present', '22.6870275009635', '75.8613649104497', '22.6870275009635', '75.8613649104497'),
(4, 61, '2018-05-05', '2018-05-05 16:53:50', '2020-12-30 18:37:10', '0', '2018-05-05 16:53:50', '2020-12-30 18:37:10', '2020-12-30 18:37:10', '0:0', '1:9:1', 'Present', '22.6878348895461', '75.8620109306306', '22.6869637984994', '75.8614574466607'),
(5, 61, '2018-05-07', '2018-05-07 10:58:31', '2020-12-30 18:37:10', '0', '2018-05-07 10:58:31', '2020-12-30 18:37:10', '2020-12-30 18:37:10', '0:0', '10:58:31', 'Present', '22.6872665947514', '75.8614275232664', '22.417615', '75.856164'),
(6, 1, '2018-05-10', '2018-05-10 15:03:03', '2020-12-30 18:37:10', '0', '2018-05-10 15:03:03', '2020-12-30 18:37:10', '2020-12-30 18:37:10', '0:0', '', 'Present', '15.3105589', '-4.3077455', '0', '0'),
(7, 62, '2018-05-10', '2018-05-11 03:45:02', '2020-12-30 18:37:10', '0', '2018-05-11 03:45:02', '2020-12-30 18:37:10', '2020-12-30 18:37:10', '0:0', '', 'Present', '0', '0', '-4.33637056500123', '15.258204136058'),
(8, 52, '2019-06-15', '2019-06-15 16:48:12', '2020-12-30 18:37:10', '0', '2019-06-15 16:48:12', '2020-12-30 18:37:10', '2020-12-30 18:37:10', '0:0', '', 'Present', '0', '0', '0', '0'),
(9, 62, '2019-06-15', '2019-06-15 23:07:01', '2020-12-30 18:37:10', '0', '2019-06-15 23:07:01', '2020-12-30 18:37:10', '2020-12-30 18:37:10', '0:0', '', 'Present', '0', '0', '0', '0'),
(10, 62, '2019-06-17', '2019-06-17 16:14:05', '2020-12-30 18:37:10', '0', '2019-06-17 16:14:05', '2020-12-30 18:37:10', '2020-12-30 18:37:10', '0:0', '', 'Present', '0', '0', '0', '0'),
(11, 62, '2019-06-19', '2019-06-19 20:24:31', '2020-12-30 18:37:10', '0', '2019-06-19 20:24:31', '2020-12-30 18:37:10', '2020-12-30 18:37:10', '0:0', '', 'Present', '0', '0', '0', '0'),
(12, 62, '2019-07-10', '2019-07-11 00:40:42', '2020-12-30 18:37:10', '0', '2019-07-11 00:40:42', '2020-12-30 18:37:10', '2020-12-30 18:37:10', '0:0', '', 'Present', '0', '0', '0', '0'),
(13, 62, '2019-07-17', '2019-07-17 17:19:51', '2020-12-30 18:37:10', '0', '2019-07-17 17:19:51', '2020-12-30 18:37:10', '2020-12-30 18:37:10', '0:0', '', 'Present', '0', '0', '0', '0'),
(14, 62, '2019-07-17', '2019-07-17 20:49:43', '2020-12-30 18:37:10', '0', '2019-07-17 20:49:43', '2020-12-30 18:37:10', '2020-12-30 18:37:10', '0:0', '0:0', 'Present', '0', '0', '0', '0'),
(15, 62, '2019-07-18', '2019-07-18 22:12:17', '2020-12-30 18:37:10', '0', '2019-07-18 22:12:17', '2020-12-30 18:37:10', '2020-12-30 18:37:10', '0:0', '', 'Present', '0', '0', '0', '0'),
(16, 62, '2020-10-29', '2020-10-29 15:19:52', '2020-12-30 18:37:10', '0', '2020-10-29 15:19:52', '2020-12-30 18:37:10', '2020-12-30 18:37:10', '0:0', '', 'Present', '0', '0', '0', '0'),
(17, 59, '2020-11-09', '2020-11-09 15:04:12', '2020-12-30 18:37:10', '0', '2020-11-09 15:04:12', '2020-12-30 18:37:10', '2020-12-30 18:37:10', '0:0', '', 'Present', '0', '0', '0', '0'),
(18, 59, '2020-11-09', '2020-11-09 15:04:12', '2020-12-30 18:37:10', '0', '2020-11-09 15:04:12', '2020-12-30 18:37:10', '2020-12-30 18:37:10', '0:0', '3:59', 'Present', '0', '0', '0', '0'),
(19, 59, '2020-11-09', '2020-11-09 16:03:02', '2020-12-30 18:37:10', '0', '2020-11-09 16:03:02', '2020-12-30 18:37:10', '2020-12-30 18:37:10', '0:0', '0:58', 'Present', '0', '0', '0', '0'),
(20, 62, '2020-11-09', '2020-11-09 16:04:59', '2020-12-30 18:37:10', '0', '2020-11-09 16:04:59', '2020-12-30 18:37:10', '2020-12-30 18:37:10', '0:0', '', 'Present', '0', '0', '0', '0'),
(21, 62, '2020-11-09', '2020-11-09 16:22:34', '2020-12-30 18:37:10', '0', '2020-11-09 16:22:34', '2020-12-30 18:37:10', '2020-12-30 18:37:10', '0:0', '0:17', 'Present', '0', '0', '0', '0'),
(22, 62, '2020-12-12', '2020-12-12 18:09:51', '2020-12-30 18:37:10', '0', '2020-12-12 18:09:51', '2020-12-30 18:37:10', '2020-12-30 18:37:10', '0:0', '', 'Present', '0', '0', '0', '0'),
(23, 59, '2020-12-17', '2020-12-17 21:19:40', '2020-12-30 18:37:10', '0', '2020-12-17 21:19:40', '2020-12-30 18:37:10', '2020-12-30 18:37:10', '0:0', '', 'Present', '0', '0', '0', '0'),
(24, 59, '2020-12-17', '2020-12-17 21:50:04', '2020-12-30 18:37:10', '0', '2020-12-17 21:50:04', '2020-12-30 18:37:10', '2020-12-30 18:37:10', '0:0', '0:30', 'Present', '0', '0', '0', '0'),
(25, 59, '2020-12-18', '2020-12-18 15:57:25', '2020-12-30 18:37:10', '0', '2020-12-18 15:57:25', '2020-12-30 18:37:10', '2020-12-30 18:37:10', '0:0', '', 'Present', '0', '0', '0', '0'),
(26, 59, '2020-12-30', '2020-12-30 18:37:01', '2020-12-30 18:37:10', '0', '2020-12-30 18:37:01', '2020-12-30 18:37:10', '2020-12-30 18:37:10', '0:0', '', 'Present', '0', '0', '0', '0'),
(27, 59, '2020-12-30', '2020-12-30 18:37:07', '2020-12-30 18:37:10', '0', '2020-12-30 18:37:07', '2020-12-30 18:37:10', '2020-12-30 18:37:10', '0:0', '0:0', 'Present', '0', '0', '0', '0'),
(28, 23, '2018-05-04', '2018-05-04 20:09:10', '2020-12-30 18:37:10', '0', '2018-05-04 20:09:10', '2020-12-30 18:37:10', '2020-12-30 18:37:10', '0:0', '', 'Present', '22.417615', '75.856164', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_awards`
--

CREATE TABLE `hrms_awards` (
  `award_id` int(11) NOT NULL,
  `employee_id` int(200) NOT NULL,
  `award_type_id` int(200) NOT NULL,
  `gift_item` varchar(200) NOT NULL,
  `cash_price` varchar(200) NOT NULL,
  `award_photo` varchar(255) NOT NULL,
  `award_month_year` varchar(200) NOT NULL,
  `award_information` text NOT NULL,
  `description` text NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_awards`
--

INSERT INTO `hrms_awards` (`award_id`, `employee_id`, `award_type_id`, `gift_item`, `cash_price`, `award_photo`, `award_month_year`, `award_information`, `description`, `created_at`) VALUES
(1, 62, 3, '2000', '2000', 'award_1525522761.jpg', '2018-05', 'good job', '&lt;p&gt;good job&lt;/p&gt;', '2018-05-05'),
(2, 82, 2, '', '20000', 'award_1560763900.jpeg', '2020-06', 'Added afgd aghshgahsghjagshjag shj hgas gahjgsja sas', '&lt;p&gt;&lt;/p&gt;&lt;ol&gt;&lt;li&gt;frstya ghjags&amp;nbsp;&lt;/li&gt;&lt;li&gt;kjagdj&lt;/li&gt;&lt;li&gt;klaj&amp;nbsp;&lt;/li&gt;&lt;li&gt;ahdkhka&amp;nbsp;&lt;/li&gt;&lt;li&gt;&amp;nbsp;kjhahs&amp;nbsp;&lt;/li&gt;&lt;li&gt;&amp;nbsp;hgjasas&lt;/li&gt;&lt;/ol&gt;&lt;p&gt;&lt;/p&gt;', '2019-06-17'),
(4, 123, 6, 'gift', '5000', 'award_1605251374.png', '2020-11', 'well done', '&lt;p&gt;qwertyuiop&lt;/p&gt;', '2020-11-14'),
(5, 116, 4, '10000', '10000', 'award_1605251500.png', '2020-11', 'jn', '&lt;p&gt;jkn&lt;/p&gt;', '2020-11-14');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_award_type`
--

CREATE TABLE `hrms_award_type` (
  `award_type_id` int(11) NOT NULL,
  `award_type` varchar(200) NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_award_type`
--

INSERT INTO `hrms_award_type` (`award_type_id`, `award_type`, `created_at`) VALUES
(1, 'Performer of the Year', '28-04-2017'),
(2, 'Most Consistent Employee', '28-04-2017'),
(3, 'Employee of the Month', '28-04-2017'),
(4, 'Employee of the Year', '28-04-2017'),
(5, 'Hard Worker Award', '28-04-2017'),
(6, 'Certificate of Excellence', '28-04-2017'),
(7, 'Certificate of Project Completion', '28-04-2017'),
(8, 'Outstanding Leadership', '28-04-2017');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_benefits`
--

CREATE TABLE `hrms_benefits` (
  `benefit_id` int(11) NOT NULL,
  `benefit_type_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `start_date` varchar(100) NOT NULL,
  `end_date` varchar(100) NOT NULL,
  `amount` int(11) NOT NULL,
  `description` varchar(5000) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `added_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_benefits`
--

INSERT INTO `hrms_benefits` (`benefit_id`, `benefit_type_id`, `employee_id`, `start_date`, `end_date`, `amount`, `description`, `status`, `added_by`, `created_at`) VALUES
(1, 2, 82, '2019-06-17', '2019-06-30', 5000, 'test', 1, 82, '2019-06-17 03:47:03'),
(2, 2, 60, '2020-11-02', '2020-11-10', 50, 'dsfdsf', 1, 59, '2020-11-09 11:59:43'),
(3, 1, 61, '2020-12-12', '2020-12-19', 5000, 'ydydjdjy', 1, 59, '2020-12-12 02:08:04');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_benefits_type`
--

CREATE TABLE `hrms_benefits_type` (
  `benefit_type_id` int(11) NOT NULL,
  `benefit_type` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_benefits_type`
--

INSERT INTO `hrms_benefits_type` (`benefit_type_id`, `benefit_type`, `created_at`) VALUES
(1, 'Loan', '2018-01-02 08:01:21'),
(2, 'Medical Insurance', '2018-01-02 08:00:50');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_chat_messages`
--

CREATE TABLE `hrms_chat_messages` (
  `message_id` int(11) UNSIGNED NOT NULL,
  `from_id` varchar(40) NOT NULL DEFAULT '',
  `to_id` varchar(50) NOT NULL DEFAULT '',
  `message_frm` varchar(255) NOT NULL,
  `message_to` varchar(255) NOT NULL,
  `from_uname` varchar(225) NOT NULL DEFAULT '',
  `to_uname` varchar(255) NOT NULL DEFAULT '',
  `message_content` longtext NOT NULL,
  `message_date` varchar(255) DEFAULT NULL,
  `recd` tinyint(1) NOT NULL DEFAULT '0',
  `message_type` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hrms_companies`
--

CREATE TABLE `hrms_companies` (
  `company_id` int(111) NOT NULL,
  `type_id` int(111) NOT NULL,
  `name` varchar(255) NOT NULL,
  `trading_name` varchar(255) NOT NULL,
  `registration_no` varchar(255) NOT NULL,
  `government_tax` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `website_url` varchar(255) NOT NULL,
  `address_1` text NOT NULL,
  `address_2` text NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `country` int(111) NOT NULL,
  `is_active` int(11) DEFAULT '1' COMMENT '1=active,2=not active',
  `added_by` int(111) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `modified_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_companies`
--

INSERT INTO `hrms_companies` (`company_id`, `type_id`, `name`, `trading_name`, `registration_no`, `government_tax`, `email`, `logo`, `contact_number`, `website_url`, `address_1`, `address_2`, `city`, `state`, `zipcode`, `country`, `is_active`, `added_by`, `created_at`, `modified_at`) VALUES
(5, 3, 'Jk Techd', 'test Trading', '123456', '', 'jktest@demoexample.com', 'logo_1499896380.png', '123456789', 'engineertjk.com', 'G11 Markaz', 'dsfasdfsadf', 'Islamabad', 'Federal', '44000', 173, 1, 1, '28-04-2017', '2018-04-21 16:57:33'),
(17, 1, 'info tech', 'yyuu', '123456', 'fdf', 'ritika@gmail.com', 'logo_1524312271.png', '9876543210', 'http://192.168.1.118/hrms/company', 'indore', 'uyuyu', 'indore', 'madhya pradesh', '45001', 99, 1, 31, '21-04-2018', NULL),
(18, 1, 'test cmp', 'legal', '123', '123', 'test@infograins.com', 'logo_1525443829.png', '9876543210', 'http://192.168.1.118/hrms/company', 'indore', 'indore', 'indore', 'mp', '452001', 99, 1, 31, '04-05-2018', NULL),
(21, 1, 'infograins', 'legal', '123', '123', 'ritika@infograins.com', 'logo_1525514787.png', '9876543210', 'http://192.168.1.118/hrms/company', 'indore', 'indore', 'indore', 'mp', '452001', 99, 1, 31, '05-05-2018', NULL),
(22, 1, 'IlinkHr', '654', '741852963', '321456789qwe5', 'ilinkhr@yopmail.com', 'logo_1525695889.png', '9826666666', 'www.ilinkhr.com', 'geeta bhawan indore ', '', 'indore', 'mp', '452001', 2, 1, 31, '07-05-2018', '2018-05-07 18:04:21'),
(23, 1, 'test company', 'legal', '123', '123', 'test12@yopmail.com', 'logo_1525844014.jpeg', '9876543210', 'http://192.168.1.118/hrms/company', 'indore', 'indore', 'indore', 'mp', '452001', 99, 1, 31, '09-05-2018', NULL),
(24, 1, 'Infograins Software SOlutions Private Limited', 'Software', 'dfsdfmkf2324', '12345678901234', 'ajayshuklak@gmail.com', 'logo_1560606327.png', '9713406272', 'https://infograins.com', '403 RADHE RADHE APARTMENT', 'SHREE KRISHNA AVENUE', 'Indore', 'Madhya Pradesh', '452001', 99, 1, 31, '15-06-2019', NULL),
(25, 1, 'InfoGrains TEST Team', 'Nothing', 'MH544554544', 'GHN13454554', 'gunjanrajput@infograins.com', 'logo_1560751869.png', '145sasasasas', 'www.info.com', 'Krishna Tower 202 beaf agd dggadhg dh agdhjd', '', 'indore', 'mp', '452001', 99, 1, 31, '17-06-2019', NULL),
(27, 1, 'Testing Company', 'TestingTrade', '12345645456', '154564544as', 'gunjanrajput@infograins.com', 'logo_1560752677.jpeg', '3265987444', 'www.info1.com', 'Added new address for test', '', 'indore2', 'madhya pradesh', '452001', 92, 2, 31, '17-06-2019', '2019-07-17 20:12:01'),
(28, 1, 'Rajput101', '', '4564567664', 'Tes12412', 'raj@gmail.com', 'logo_1560752894.jpeg', '9876543208', 'www.infograin.com', 'Test 101 ghag ahgd ghdgahgdad', '', 'inodwewe', '', '452001', 13, 1, 31, '17-06-2019', NULL),
(29, 1, 'Testing Company', 'TestingTrade', '12345645456', '154564544as', 'gunjanrajput@infograins.com', 'logo_1560753328.jpeg', '3265987444', 'www.test.com', 'Added new address for test', '', 'indore11', '', '452001', 5, 1, 31, '17-06-2019', NULL),
(30, 1, 'Testing Company', 'TestingTrade', '12345645456', '154564544as', 'gunjanrajput@infograins.com', 'logo_1560753352.jpeg', '3265987444', 'www.test.com', 'Added new address for test', '', 'indore11', '', '452001', 5, 1, 31, '17-06-2019', NULL),
(31, 1, 'Testing Rule Name', '', '2656356556', '', 'rajputgunjan@gmail.com', 'logo_1560754035.jpeg', '98765432121', 'www.infoh.com', 'test 101', '', 'Indore', 'mp', '452011', 99, 1, 31, '17-06-2019', NULL),
(32, 1, 'infograins1', 'ee', '121', 'sds11321', 'info1@yopmail.com', 'logo_1560756437.jpeg', '1234567892', 'www.infograins.com', 'krishnatower indore', 'indore', 'indore', 'mp', '452001', 99, 1, 31, '17-06-2019', NULL),
(33, 1, 'TestingNew', '', '389728323', 'ahs826423', 'rajptest@gmail.com', 'logo_1560757832.jpeg', '321658555', 'www.facebook.com', 'test 101jhdad', '', 'pune', 'MH', '452111', 99, 1, 31, '17-06-2019', '2019-06-17 13:26:52'),
(48, 5, 'Tata Consultancy services', '123456789', '1234567890kjhfddsd1234', 'CIFPS 63-43424 sfsasod', 'rashmik1205@gmail.com', 'logo_1562771789.png', '9713406272', 'https://infograins.com', '403 RADHE RADHE APARTMENT', 'SHREE KRISHNA AVENUE', 'Indore', 'Madhya Pradesh', '452001', 99, 1, 31, '10-07-2019', NULL),
(53, 1, 'Brijraj firm', 'pvt ltd', '1234567890kjhfddsd1234', '', 'ajayshuklak@gmail.com', 'logo_1563350007.jpg', '9713406272', 'https://infograins.com', '403 Radhe Radhe apartment', 'Shree Krishna Avenue phase 3', 'Indoe', 'Madhya Pradesh', '452001', 99, 1, 31, '17-07-2019', NULL),
(54, 1, 'codereadysoftware', 'pvt ltd', '123456789ascvfsfd', 'CIFPS 63-43424 sfsasod', 'metro@infograins.com', 'logo_1563358304.png', '9713688425', 'metro.com', 'Metro tower 7th floor', '', 'Bhopal', 'MP', '452001', 99, 1, 31, '17-07-2019', NULL),
(57, 2, 'infograins', 'legal', '87878787878787', '78787878787', 'Dk@yopmail.com', 'logo_1563359382.png', '98109328133', 'www.info.com', 'indore', 'indore', 'Indore', 'Madhya Pradesh', '452001', 99, 1, 31, '17-07-2019', '2019-07-17 16:05:17'),
(59, 3, 'Infograins Software Solutions Pvt Ltd ', '', '123456789952222222', '', 'hr@infograins.com', 'logo_1563364897.png', '9770477239', 'https://infograins.com/', ' Krishna Tower, 208, 2nd Floor, OPP. Scheme-140, Main Rd, Pipliyahana, Indore, Madhya Pradesh 452016', '', 'indore', 'madhyapradesh', '452009', 99, 1, 31, '17-07-2019', NULL),
(60, 1, 'Kisanveg India Pvt Ltd', 'kisanveg', '12313213', '123516165', 'ajay@kisanveg.com', 'logo_1604903960.jpg', '9977611436', 'http://kisanveg.com/', '208 Krishna Tower Indore, Madhya pradesh', 'Phase 1,:imbodi', 'MP', 'Madhya Pradesh', '452001', 99, 1, 31, '09-11-2020', NULL),
(61, 1, 'Kisanveg India Pvt Ltd', 'kisanveg', '12313213', '123516165', 'ajay@kisanveg.com', 'logo_1604904024.jpg', '9977611436', 'http://kisanveg.com/', '208 Krishna Tower Indore, Madhya pradesh', 'Phase 1,:imbodi', 'MP', 'Madhya Pradesh', '452001', 99, 1, 31, '09-11-2020', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hrms_company_info`
--

CREATE TABLE `hrms_company_info` (
  `company_info_id` int(111) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `logo_second` varchar(255) NOT NULL,
  `sign_in_logo` varchar(255) NOT NULL,
  `favicon` varchar(255) NOT NULL,
  `website_url` text NOT NULL,
  `starting_year` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_email` varchar(255) NOT NULL,
  `company_contact` varchar(255) NOT NULL,
  `contact_person` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address_1` text NOT NULL,
  `address_2` text NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `country` int(111) NOT NULL,
  `updated_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_company_info`
--

INSERT INTO `hrms_company_info` (`company_info_id`, `logo`, `logo_second`, `sign_in_logo`, `favicon`, `website_url`, `starting_year`, `company_name`, `company_email`, `company_contact`, `contact_person`, `email`, `phone`, `address_1`, `address_2`, `city`, `state`, `zipcode`, `country`, `updated_at`) VALUES
(1, 'logo_1560750345.png', 'logo2_1560750345.png', 'signin_logo_1560750378.png', 'favicon_1560750345.png', '', '', 'iLinkHR', '', '', 'Hemant Anjana', 'info@ilinkhr.com', '123456789', 'Address Line 1', 'Address Line 2', 'Test', 'Federal', '44000', 118, '2017-05-20 12:05:53');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_company_policy`
--

CREATE TABLE `hrms_company_policy` (
  `policy_id` int(111) NOT NULL,
  `company_id` int(111) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `added_by` int(111) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_company_policy`
--

INSERT INTO `hrms_company_policy` (`policy_id`, `company_id`, `title`, `description`, `added_by`, `created_at`) VALUES
(1, 0, 'Privacy Policy', '&lt;p&gt;iLinkHR (referred Company, hereafter) is a web design and development company. This Privacy Policy (Policy, herein) defines how the Company and website and its services will collect, use and disclose personal info of customers through our websites and online services and other websites and online services that are linked to our website (if any).&lt;br&gt;We are committed to protect your privacy when visit or get in touch with our website. This notice covers information that may or may not analyze you.&lt;/p&gt;&lt;p&gt;Type of data that we collect:&lt;/p&gt;&lt;p&gt;The company may ask you to fill online form on its website which includes information that enables us to know you better. Such entities include details as:&lt;br&gt;? Full name&lt;br&gt;? Contact number&lt;br&gt;? Email address&lt;br&gt;? Address&lt;/p&gt;&lt;p&gt;Job application and employment:&lt;/p&gt;&lt;p&gt;If you send us information in regards with a job application, we may keep it for up to three years in case we decide to contact you at a later date. You don’t need to bother for data shared by you we keep it protected from external entities. Details shared by you are kept to let you know about in future relevant job opportunities.&lt;br&gt;If we employ you, we collect information about you and your work from time to time during the period of your employment. This information will be used only for purposes directly pertinent to your employment. After your employment has ended, we will keep your file for six years before wrecking or deleting it.&lt;/p&gt;&lt;p&gt;Website usage information:&lt;/p&gt;&lt;p&gt;We may use software embedded in our website (such as JavaScript) to collect info about which pages you view and how you reach them, what you do when you visit a page, the length of time you prevail on the page, and how we perform in providing content to you. In some cases, this data may be used to associate such information with an attributable person.&lt;br&gt;Any changes in website are prior to be made with or without any notice; we keep all rights reserved to make any changes to provide you excellent user experience.&lt;/p&gt;&lt;p&gt;Cookies policy:&lt;/p&gt;&lt;p&gt;Cookies are small text files that are fixed on your computer’s hard drive over your web browser when you visit any web site. They are widely used to make websites work, or work more efficiently, as well as to provide information to the owners of the site. You can manually debilitate cookies at any time – check your browser’s ‘Help’ to find out how. This will not affect your ability to view the site.&lt;br&gt;All the time we try our best to keep your personal information confidential, restricted and protected however, we cannot promise online safety of your information because there are a few technical constraints out of our bounds, like, software that process your information.&lt;/p&gt;&lt;p&gt;We appreciate your questions, comments and concerns leading to betterment of this Policy. You can reach us at:&lt;br&gt;Info@hrms.com, or at our postal address:&lt;/p&gt;', 1, '09-01-2018'),
(6, 0, 'Terms And Conditions', '&lt;p&gt;We at Infograins.com express our heartiest welcome to our visitors. Infograins Solutions Provides access and use of its website as (website), subjects to your agreement to the following “Terms of Use”. Services provided by our website are strictly subjects to the terms of the company. So, please read these Terms and carefully before accessing or using the site. By accessing or using the site, we assume that you agree to be complying with these terms and conditions of our company.&lt;/p&gt;&lt;p&gt;All site designs, texts, graphics, logos, icons and images thereof are exclusive property of info grains Solutions or its licensors and are protected by Indian and International copyright laws. Visitors do not have any right to reuse our copyright stuff in any way, without taking prior written permission from Infograins. We at Infograins software solutions pvt.ltd owns all the wrights to take prior actions against misuse of our website stuff in any way.&lt;/p&gt;', 1, '09-01-2018'),
(7, 0, 'Trademarks:', '&lt;p&gt;The trademarks including designs, logos, service marks displayed on the site are registered and unregistered trademarks of info grains. You agree that you will not refer or publish any information to info grains Solutions in any other public media including websites, press releases, etc. for advertising or promotional purposes. Use of any trademark without written consent will be a violation of info grains trademark and other intellectual property rights.&lt;br&gt;&lt;/p&gt;', 1, '09-01-2018'),
(8, 0, 'Use of Site Content:', '&lt;p&gt;The content of the pages of the Site is for your general information and read only purpose and owned by or licensed to iLinkHR solutions. It is subject to change without any prior notice. We may review, edit, reject, decline to post and/or delete any Content that in the sole decision of violate these Terms of Use or which might be offensive, illegal. You may not otherwise reproduce, modify, distribute, transmit, post, or disclose the Site Content without prior written consent of info grains Solutions.&lt;/p&gt;&lt;p&gt;By using this website you agree that the exclusions and limitations of liability set out in this website disclaimer are reasonable.&lt;/p&gt;&lt;p&gt;If you do not think they are reasonable, you must not use this website.&lt;/p&gt;&lt;p&gt;You accept that, as a &lt;span style=\\&quot;font-size: 1rem; font-weight: bolder;\\&quot;&gt;limited liability&lt;/span&gt;&lt;span style=\\&quot;font-size: 1rem;\\&quot;&gt; &lt;/span&gt;&lt;span style=\\&quot;font-size: 1rem;\\&quot;&gt;entity, info grains has an interest in limiting the personal liability of its officers and employees. You agree that you will not bring any claim personally against info grains in respect of any losses you suffer in connection with the website.&lt;/span&gt;&lt;/p&gt;', 1, '09-01-2018'),
(9, 21, 'company policy', '&lt;center style=\\&quot;\\\\\\&quot;box-sizing:\\&quot; content-box;=\\&quot;\\&quot; margin:=\\&quot;\\&quot; 0px;=\\&quot;\\&quot; padding:=\\&quot;\\&quot; border:=\\&quot;\\&quot; outline-style:=\\&quot;\\&quot; initial;=\\&quot;\\&quot; outline-width:=\\&quot;\\&quot; vertical-align:=\\&quot;\\&quot; baseline;=\\&quot;\\&quot; font-variant-numeric:=\\&quot;\\&quot; inherit;=\\&quot;\\&quot; font-variant-east-asian:=\\&quot;\\&quot; font-stretch:=\\&quot;\\&quot; font-size:=\\&quot;\\&quot; 15px;=\\&quot;\\&quot; line-height:=\\&quot;\\&quot; font-family:=\\&quot;\\&quot; arial,=\\&quot;\\&quot; helvetica,=\\&quot;\\&quot; sans-serif;=\\&quot;\\&quot; color:=\\&quot;\\&quot; rgb(51,=\\&quot;\\&quot; 51,=\\&quot;\\&quot; 51);=\\&quot;\\&quot; background-color:=\\&quot;\\&quot; rgb(254,=\\&quot;\\&quot; 254,=\\&quot;\\&quot; 254);\\\\\\&quot;=\\&quot;\\&quot;&gt;&lt;strong style=\\&quot;\\\\\\&quot;box-sizing:\\&quot; content-box;=\\&quot;\\&quot; font-weight:=\\&quot;\\&quot; bold;=\\&quot;\\&quot; margin:=\\&quot;\\&quot; 0px;=\\&quot;\\&quot; padding:=\\&quot;\\&quot; border:=\\&quot;\\&quot; outline-style:=\\&quot;\\&quot; initial;=\\&quot;\\&quot; outline-width:=\\&quot;\\&quot; vertical-align:=\\&quot;\\&quot; baseline;=\\&quot;\\&quot; font-style:=\\&quot;\\&quot; inherit;=\\&quot;\\&quot; font-variant:=\\&quot;\\&quot; font-stretch:=\\&quot;\\&quot; font-size:=\\&quot;\\&quot; line-height:=\\&quot;\\&quot; font-family:=\\&quot;\\&quot; inherit;\\\\\\&quot;=\\&quot;\\&quot;&gt;Privacy Notice&lt;/strong&gt;&lt;/center&gt;&lt;center style=\\&quot;box-sizing: content-box; margin: 0px; padding: 0px; border: 0px; outline-style: initial; outline-width: 0px; vertical-align: baseline; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: inherit; font-family: Arial, Helvetica, sans-serif; color: rgb(51, 51, 51); background-color: rgb(254, 254, 254);\\&quot;&gt;&lt;strong style=\\&quot;box-sizing: content-box; font-weight: bold; margin: 0px; padding: 0px; border: 0px; outline-style: initial; outline-width: 0px; vertical-align: baseline; font-style: inherit; font-variant: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit;\\&quot;&gt;Privacy Notice&lt;/strong&gt;&lt;/center&gt;&lt;p style=\\&quot;box-sizing: content-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; font-size: 15px; background-color: rgb(254, 254, 254);\\&quot;&gt;This privacy notice discloses the privacy practices for &lt;span style=\\&quot;box-sizing: content-box; margin: 0px; padding: 0px; border: 0px; outline-style: initial; outline-width: 0px; vertical-align: baseline; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; text-decoration-line: underline;\\&quot;&gt;(website address)&lt;/span&gt;. This privacy notice applies solely to information collected by this website. It will notify you of the following:&lt;/p&gt;&lt;ol type=\\&quot;1\\&quot; style=\\&quot;box-sizing: content-box; margin-right: 0px; margin-bottom: 0px; margin-left: 40px; padding: 0px 0px 0px 25px; border: 0px; outline-style: initial; outline-width: 0px; vertical-align: baseline; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: inherit; font-family: Arial, Helvetica, sans-serif; list-style-position: initial; list-style-image: initial; color: rgb(51, 51, 51); background-color: rgb(254, 254, 254);\\&quot;&gt;&lt;li style=\\&quot;box-sizing: content-box; margin: 0px; padding: 0px; border: 0px; outline-style: initial; outline-width: 0px; vertical-align: baseline; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; list-style: decimal;\\&quot;&gt;What personally identifiable information is collected from you through the website, how it is used and with whom it may be shared.&lt;/li&gt;&lt;li style=\\&quot;box-sizing: content-box; margin: 0px; padding: 0px; border: 0px; outline-style: initial; outline-width: 0px; vertical-align: baseline; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; list-style: decimal;\\&quot;&gt;What choices are available to you regarding the use of your data.&lt;/li&gt;&lt;li style=\\&quot;box-sizing: content-box; margin: 0px; padding: 0px; border: 0px; outline-style: initial; outline-width: 0px; vertical-align: baseline; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; list-style: decimal;\\&quot;&gt;The security procedures in place to protect the misuse of your information.&lt;/li&gt;&lt;li style=\\&quot;box-sizing: content-box; margin: 0px; padding: 0px; border: 0px; outline-style: initial; outline-width: 0px; vertical-align: baseline; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; list-style: decimal;\\&quot;&gt;How you can correct any inaccuracies in the information.&lt;/li&gt;&lt;/ol&gt;&lt;p style=\\&quot;box-sizing: content-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; font-size: 15px; background-color: rgb(254, 254, 254);\\&quot;&gt;&lt;strong style=\\&quot;box-sizing: content-box; font-weight: bold; margin: 0px; padding: 0px; border: 0px; outline-style: initial; outline-width: 0px; vertical-align: baseline; font-style: inherit; font-variant: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit;\\&quot;&gt;Information Collection, Use, and Sharing&lt;/strong&gt; &lt;br style=\\&quot;box-sizing: content-box;\\&quot;&gt;We are the sole owners of the information collected on this site. We only have access to/collect information that you voluntarily give us via email or other direct contact from you. We will not sell or rent this information to anyone.&lt;/p&gt;&lt;p style=\\&quot;box-sizing: content-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; font-size: 15px; background-color: rgb(254, 254, 254);\\&quot;&gt;We will use your information to respond to you, regarding the reason you contacted us. We will not share your information with any third party outside of our organization, other than as necessary to fulfill your request, e.g. to ship an order.&lt;/p&gt;&lt;p style=\\&quot;box-sizing: content-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; font-size: 15px; background-color: rgb(254, 254, 254);\\&quot;&gt;Unless you ask us not to, we may contact you via email in the future to tell you about specials, new products or services, or changes to this privacy policy.&lt;/p&gt;&lt;p style=\\&quot;box-sizing: content-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; font-size: 15px; background-color: rgb(254, 254, 254);\\&quot;&gt;&lt;strong style=\\&quot;box-sizing: content-box; font-weight: bold; margin: 0px; padding: 0px; border: 0px; outline-style: initial; outline-width: 0px; vertical-align: baseline; font-style: inherit; font-variant: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit;\\&quot;&gt;Your Access to and Control Over Information&lt;/strong&gt; &lt;br style=\\&quot;box-sizing: content-box;\\&quot;&gt;You may opt out of any future contacts from us at any time. You can do the following at any time by contacting us via the email address or phone number given on our website:&lt;/p&gt;&lt;ul style=\\&quot;box-sizing: content-box; margin-right: 0px; margin-bottom: 0px; margin-left: 40px; padding: 0px; border: 0px; outline-style: initial; outline-width: 0px; vertical-align: baseline; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 15px; line-height: inherit; font-family: Arial, Helvetica, sans-serif; list-style: none; color: rgb(51, 51, 51); background-color: rgb(254, 254, 254);\\&quot;&gt;&lt;li style=\\&quot;box-sizing: content-box; margin: 0px 0px 0px 30px; padding: 0px; border: 0px; outline-style: initial; outline-width: 0px; vertical-align: baseline; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; list-style: disc;\\&quot;&gt;See what data we have about you, if any.&lt;/li&gt;&lt;li style=\\&quot;box-sizing: content-box; margin: 0px 0px 0px 30px; padding: 0px; border: 0px; outline-style: initial; outline-width: 0px; vertical-align: baseline; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; list-style: disc;\\&quot;&gt;Change/correct any data we have about you.&lt;/li&gt;&lt;li style=\\&quot;box-sizing: content-box; margin: 0px 0px 0px 30px; padding: 0px; border: 0px; outline-style: initial; outline-width: 0px; vertical-align: baseline; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; list-style: disc;\\&quot;&gt;Have us delete any data we have about you.&lt;/li&gt;&lt;li style=\\&quot;box-sizing: content-box; margin: 0px 0px 0px 30px; padding: 0px; border: 0px; outline-style: initial; outline-width: 0px; vertical-align: baseline; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; list-style: disc;\\&quot;&gt;Express any concern you have about our use of your data.&lt;/li&gt;&lt;/ul&gt;&lt;p style=\\&quot;box-sizing: content-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; font-size: 15px; background-color: rgb(254, 254, 254);\\&quot;&gt;&lt;strong style=\\&quot;box-sizing: content-box; font-weight: bold; margin: 0px; padding: 0px; border: 0px; outline-style: initial; outline-width: 0px; vertical-align: baseline; font-style: inherit; font-variant: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit;\\&quot;&gt;Security&lt;/strong&gt; &lt;br style=\\&quot;box-sizing: content-box;\\&quot;&gt;We take precautions to protect your information. When you submit sensitive information via the website, your information is protected both online and offline.&lt;/p&gt;&lt;p style=\\&quot;box-sizing: content-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; font-size: 15px; background-color: rgb(254, 254, 254);\\&quot;&gt;Wherever we collect sensitive information (such as credit card data), that information is encrypted and transmitted to us in a secure way. You can verify this by looking for a lock icon in the address bar and looking for \\&quot;https\\&quot; at the beginning of the address of the Web page.&lt;/p&gt;&lt;p style=\\&quot;box-sizing: content-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; font-size: 15px; background-color: rgb(254, 254, 254);\\&quot;&gt;While we use encryption to protect sensitive information transmitted online, we also protect your information offline. Only employees who need the information to perform a specific job (for example, billing or customer service) are granted access to personally identifiable information. The computers/servers in which we store personally identifiable information are kept in a secure environment.&lt;/p&gt;', 59, '05-05-2018');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_company_type`
--

CREATE TABLE `hrms_company_type` (
  `type_id` int(111) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_company_type`
--

INSERT INTO `hrms_company_type` (`type_id`, `name`, `created_at`) VALUES
(1, 'Corporation', ''),
(2, 'Exempt Organization', ''),
(3, 'Partnership', ''),
(4, 'Private Foundation', ''),
(5, 'Limited Liability Company', '');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_contract_type`
--

CREATE TABLE `hrms_contract_type` (
  `contract_type_id` int(111) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_contract_type`
--

INSERT INTO `hrms_contract_type` (`contract_type_id`, `name`, `created_at`) VALUES
(1, 'Permanent', '2019-06-17 14:46:15'),
(2, 'Internship', '28-04-2017'),
(3, 'Regular', '28-04-2017'),
(4, 'Probation', '28-04-2017'),
(7, 'test 1', '2020-11-11 16:20:25');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_countries`
--

CREATE TABLE `hrms_countries` (
  `country_id` int(11) NOT NULL,
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `country_name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hrms_countries`
--

INSERT INTO `hrms_countries` (`country_id`, `country_code`, `country_name`) VALUES
(1, 'AF', 'Afghanistan'),
(2, 'AL', 'Albania'),
(3, 'DZ', 'Algeria'),
(4, 'DS', 'American Samoa'),
(5, 'AD', 'Andorra'),
(6, 'AO', 'Angola'),
(7, 'AI', 'Anguilla'),
(8, 'AQ', 'Antarctica'),
(9, 'AG', 'Antigua and Barbuda'),
(10, 'AR', 'Argentina'),
(11, 'AM', 'Armenia'),
(12, 'AW', 'Aruba'),
(13, 'AU', 'Australia'),
(14, 'AT', 'Austria'),
(15, 'AZ', 'Azerbaijan'),
(16, 'BS', 'Bahamas'),
(17, 'BH', 'Bahrain'),
(18, 'BD', 'Bangladesh'),
(19, 'BB', 'Barbados'),
(20, 'BY', 'Belarus'),
(21, 'BE', 'Belgium'),
(22, 'BZ', 'Belize'),
(23, 'BJ', 'Benin'),
(24, 'BM', 'Bermuda'),
(25, 'BT', 'Bhutan'),
(26, 'BO', 'Bolivia'),
(27, 'BA', 'Bosnia and Herzegovina'),
(28, 'BW', 'Botswana'),
(29, 'BV', 'Bouvet Island'),
(30, 'BR', 'Brazil'),
(31, 'IO', 'British Indian Ocean Territory'),
(32, 'BN', 'Brunei Darussalam'),
(33, 'BG', 'Bulgaria'),
(34, 'BF', 'Burkina Faso'),
(35, 'BI', 'Burundi'),
(36, 'KH', 'Cambodia'),
(37, 'CM', 'Cameroon'),
(38, 'CA', 'Canada'),
(39, 'CV', 'Cape Verde'),
(40, 'KY', 'Cayman Islands'),
(41, 'CF', 'Central African Republic'),
(42, 'TD', 'Chad'),
(43, 'CL', 'Chile'),
(44, 'CN', 'China'),
(45, 'CX', 'Christmas Island'),
(46, 'CC', 'Cocos (Keeling) Islands'),
(47, 'CO', 'Colombia'),
(48, 'KM', 'Comoros'),
(49, 'CG', 'Congo'),
(50, 'CK', 'Cook Islands'),
(51, 'CR', 'Costa Rica'),
(52, 'HR', 'Croatia (Hrvatska)'),
(53, 'CU', 'Cuba'),
(54, 'CY', 'Cyprus'),
(55, 'CZ', 'Czech Republic'),
(56, 'DK', 'Denmark'),
(57, 'DJ', 'Djibouti'),
(58, 'DM', 'Dominica'),
(59, 'DO', 'Dominican Republic'),
(60, 'TP', 'East Timor'),
(61, 'EC', 'Ecuador'),
(62, 'EG', 'Egypt'),
(63, 'SV', 'El Salvador'),
(64, 'GQ', 'Equatorial Guinea'),
(65, 'ER', 'Eritrea'),
(66, 'EE', 'Estonia'),
(67, 'ET', 'Ethiopia'),
(68, 'FK', 'Falkland Islands (Malvinas)'),
(69, 'FO', 'Faroe Islands'),
(70, 'FJ', 'Fiji'),
(71, 'FI', 'Finland'),
(72, 'FR', 'France'),
(73, 'FX', 'France, Metropolitan'),
(74, 'GF', 'French Guiana'),
(75, 'PF', 'French Polynesia'),
(76, 'TF', 'French Southern Territories'),
(77, 'GA', 'Gabon'),
(78, 'GM', 'Gambia'),
(79, 'GE', 'Georgia'),
(80, 'DE', 'Germany'),
(81, 'GH', 'Ghana'),
(82, 'GI', 'Gibraltar'),
(83, 'GK', 'Guernsey'),
(84, 'GR', 'Greece'),
(85, 'GL', 'Greenland'),
(86, 'GD', 'Grenada'),
(87, 'GP', 'Guadeloupe'),
(88, 'GU', 'Guam'),
(89, 'GT', 'Guatemala'),
(90, 'GN', 'Guinea'),
(91, 'GW', 'Guinea-Bissau'),
(92, 'GY', 'Guyana'),
(93, 'HT', 'Haiti'),
(94, 'HM', 'Heard and Mc Donald Islands'),
(95, 'HN', 'Honduras'),
(96, 'HK', 'Hong Kong'),
(97, 'HU', 'Hungary'),
(98, 'IS', 'Iceland'),
(99, 'IN', 'India'),
(100, 'IM', 'Isle of Man'),
(101, 'ID', 'Indonesia'),
(102, 'IR', 'Iran (Islamic Republic of)'),
(103, 'IQ', 'Iraq'),
(104, 'IE', 'Ireland'),
(105, 'IL', 'Israel'),
(106, 'IT', 'Italy'),
(107, 'CI', 'Ivory Coast'),
(108, 'JE', 'Jersey'),
(109, 'JM', 'Jamaica'),
(110, 'JP', 'Japan'),
(111, 'JO', 'Jordan'),
(112, 'KZ', 'Kazakhstan'),
(113, 'KE', 'Kenya'),
(114, 'KI', 'Kiribati'),
(115, 'KP', 'Korea, Democratic People\'s Republic of'),
(116, 'KR', 'Korea, Republic of'),
(117, 'XK', 'Kosovo'),
(118, 'KW', 'Kuwait'),
(119, 'KG', 'Kyrgyzstan'),
(120, 'LA', 'Lao People\'s Democratic Republic'),
(121, 'LV', 'Latvia'),
(122, 'LB', 'Lebanon'),
(123, 'LS', 'Lesotho'),
(124, 'LR', 'Liberia'),
(125, 'LY', 'Libyan Arab Jamahiriya'),
(126, 'LI', 'Liechtenstein'),
(127, 'LT', 'Lithuania'),
(128, 'LU', 'Luxembourg'),
(129, 'MO', 'Macau'),
(130, 'MK', 'Macedonia'),
(131, 'MG', 'Madagascar'),
(132, 'MW', 'Malawi'),
(133, 'MY', 'Malaysia'),
(134, 'MV', 'Maldives'),
(135, 'ML', 'Mali'),
(136, 'MT', 'Malta'),
(137, 'MH', 'Marshall Islands'),
(138, 'MQ', 'Martinique'),
(139, 'MR', 'Mauritania'),
(140, 'MU', 'Mauritius'),
(141, 'TY', 'Mayotte'),
(142, 'MX', 'Mexico'),
(143, 'FM', 'Micronesia, Federated States of'),
(144, 'MD', 'Moldova, Republic of'),
(145, 'MC', 'Monaco'),
(146, 'MN', 'Mongolia'),
(147, 'ME', 'Montenegro'),
(148, 'MS', 'Montserrat'),
(149, 'MA', 'Morocco'),
(150, 'MZ', 'Mozambique'),
(151, 'MM', 'Myanmar'),
(152, 'NA', 'Namibia'),
(153, 'NR', 'Nauru'),
(154, 'NP', 'Nepal'),
(155, 'NL', 'Netherlands'),
(156, 'AN', 'Netherlands Antilles'),
(157, 'NC', 'New Caledonia'),
(158, 'NZ', 'New Zealand'),
(159, 'NI', 'Nicaragua'),
(160, 'NE', 'Niger'),
(161, 'NG', 'Nigeria'),
(162, 'NU', 'Niue'),
(163, 'NF', 'Norfolk Island'),
(164, 'MP', 'Northern Mariana Islands'),
(165, 'NO', 'Norway'),
(166, 'OM', 'Oman'),
(167, 'PK', 'Pakistan'),
(168, 'PW', 'Palau'),
(169, 'PS', 'Palestine'),
(170, 'PA', 'Panama'),
(171, 'PG', 'Papua New Guinea'),
(172, 'PY', 'Paraguay'),
(173, 'PE', 'Peru'),
(174, 'PH', 'Philippines'),
(175, 'PN', 'Pitcairn'),
(176, 'PL', 'Poland'),
(177, 'PT', 'Portugal'),
(178, 'PR', 'Puerto Rico'),
(179, 'QA', 'Qatar'),
(180, 'RE', 'Reunion'),
(181, 'RO', 'Romania'),
(182, 'RU', 'Russian Federation'),
(183, 'RW', 'Rwanda'),
(184, 'KN', 'Saint Kitts and Nevis'),
(185, 'LC', 'Saint Lucia'),
(186, 'VC', 'Saint Vincent and the Grenadines'),
(187, 'WS', 'Samoa'),
(188, 'SM', 'San Marino'),
(189, 'ST', 'Sao Tome and Principe'),
(190, 'SA', 'Saudi Arabia'),
(191, 'SN', 'Senegal'),
(192, 'RS', 'Serbia'),
(193, 'SC', 'Seychelles'),
(194, 'SL', 'Sierra Leone'),
(195, 'SG', 'Singapore'),
(196, 'SK', 'Slovakia'),
(197, 'SI', 'Slovenia'),
(198, 'SB', 'Solomon Islands'),
(199, 'SO', 'Somalia'),
(200, 'ZA', 'South Africa'),
(201, 'GS', 'South Georgia South Sandwich Islands'),
(202, 'ES', 'Spain'),
(203, 'LK', 'Sri Lanka'),
(204, 'SH', 'St. Helena'),
(205, 'PM', 'St. Pierre and Miquelon'),
(206, 'SD', 'Sudan'),
(207, 'SR', 'Suriname'),
(208, 'SJ', 'Svalbard and Jan Mayen Islands'),
(209, 'SZ', 'Swaziland'),
(210, 'SE', 'Sweden'),
(211, 'CH', 'Switzerland'),
(212, 'SY', 'Syrian Arab Republic'),
(213, 'TW', 'Taiwan'),
(214, 'TJ', 'Tajikistan'),
(215, 'TZ', 'Tanzania, United Republic of'),
(216, 'TH', 'Thailand'),
(217, 'TG', 'Togo'),
(218, 'TK', 'Tokelau'),
(219, 'TO', 'Tonga'),
(220, 'TT', 'Trinidad and Tobago'),
(221, 'TN', 'Tunisia'),
(222, 'TR', 'Turkey'),
(223, 'TM', 'Turkmenistan'),
(224, 'TC', 'Turks and Caicos Islands'),
(225, 'TV', 'Tuvalu'),
(226, 'UG', 'Uganda'),
(227, 'UA', 'Ukraine'),
(228, 'AE', 'United Arab Emirates'),
(229, 'GB', 'United Kingdom'),
(230, 'US', 'United States'),
(231, 'UM', 'United States minor outlying islands'),
(232, 'UY', 'Uruguay'),
(233, 'UZ', 'Uzbekistan'),
(234, 'VU', 'Vanuatu'),
(235, 'VA', 'Vatican City State'),
(236, 'VE', 'Venezuela'),
(237, 'VN', 'Vietnam'),
(238, 'VG', 'Virgin Islands (British)'),
(239, 'VI', 'Virgin Islands (U.S.)'),
(240, 'WF', 'Wallis and Futuna Islands'),
(241, 'EH', 'Western Sahara'),
(242, 'YE', 'Yemen'),
(243, 'ZR', 'Zaire'),
(244, 'ZM', 'Zambia'),
(245, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_currencies`
--

CREATE TABLE `hrms_currencies` (
  `currency_id` int(111) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `symbol` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_currencies`
--

INSERT INTO `hrms_currencies` (`currency_id`, `name`, `code`, `symbol`) VALUES
(2, 'Rupee', 'INR', '₹'),
(6, 'Dollars', 'AUD', '$'),
(11, 'Euro', 'EUR', '€'),
(19, 'Pounds', 'GBP', '£'),
(22, 'Dollars', 'CAD', '$'),
(25, 'Yuan Renminbi', 'CNY', '¥'),
(44, 'Dollars', 'HKD', '$'),
(47, 'Rupees', 'INR', 'Rp'),
(53, 'Yen', 'JPY', '¥'),
(63, 'Switzerland Francs', 'CHF', 'CHF'),
(66, 'Ringgits', 'MYR', 'RM'),
(73, 'Guilders', 'ANG', 'ƒ'),
(74, 'Dollars', 'NZD', '$'),
(92, 'Dollars', 'SGD', '$'),
(94, 'Shillings', 'SOS', 'S'),
(112, 'Zimbabwe Dollars', 'ZWD', 'Z$');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_database_backup`
--

CREATE TABLE `hrms_database_backup` (
  `backup_id` int(111) NOT NULL,
  `backup_file` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hrms_departments`
--

CREATE TABLE `hrms_departments` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(200) NOT NULL,
  `location_id` int(111) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `added_by` int(111) NOT NULL,
  `created_at` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_departments`
--

INSERT INTO `hrms_departments` (`department_id`, `department_name`, `location_id`, `employee_id`, `company_id`, `added_by`, `created_at`, `status`) VALUES
(1, 'adminstration', 1, 31, 17, 44, '04-05-2018', 1),
(2, 'manager', 2, 44, 17, 44, '04-05-2018', 1),
(3, 'manager', 3, 54, 18, 54, '04-05-2018', 1),
(4, 'adminDepartment', 4, 55, 19, 55, '05-05-2018', 1),
(5, 'manageDepartment', 4, 55, 19, 55, '05-05-2018', 1),
(6, 'employeeDepartment', 4, 55, 19, 55, '05-05-2018', 1),
(7, 'Admin', 6, 56, 20, 56, '05-05-2018', 1),
(8, 'manager', 6, 56, 20, 56, '05-05-2018', 1),
(9, 'Hr', 6, 56, 20, 56, '05-05-2018', 1),
(11, 'admin', 8, 59, 21, 59, '05-05-2018', 1),
(12, 'manager', 9, 60, 21, 59, '05-05-2018', 1),
(13, 'Admin', 10, 63, 22, 63, '07-05-2018', 1),
(14, 'Development (php)', 10, 67, 22, 63, '07-05-2018', 1),
(15, 'Testing ', 10, 64, 22, 63, '08-05-2018', 1),
(16, 'Admin', 11, 65, 23, 65, '09-05-2018', 1),
(17, 'hr department', 11, 65, 23, 65, '09-05-2018', 1),
(18, 'Hr department ', 10, 63, 22, 63, '09-05-2018', 1),
(19, 'Marketing ', 10, 63, 22, 63, '09-05-2018', 1),
(20, 'Development (android)', 10, 67, 22, 63, '09-05-2018', 1),
(21, 'Development (designing  )', 10, 67, 22, 63, '09-05-2018', 1),
(22, 'Development (ios)', 10, 67, 22, 63, '09-05-2018', 1),
(23, 'Admin', 12, 73, 24, 73, '15-06-2019', 1),
(24, 'Admin', 13, 74, 25, 74, '17-06-2019', 1),
(25, 'Admin', 14, 75, 26, 75, '17-06-2019', 1),
(26, 'Admin', 15, 76, 27, 76, '17-06-2019', 1),
(27, 'Admin', 16, 77, 28, 77, '17-06-2019', 1),
(28, 'Admin', 17, 78, 29, 78, '17-06-2019', 1),
(29, 'Admin', 18, 79, 30, 79, '17-06-2019', 1),
(30, 'Admin', 19, 80, 31, 80, '17-06-2019', 1),
(31, 'IT department', 20, 80, 31, 80, '17-06-2019', 1),
(32, 'Admin', 22, 81, 32, 81, '17-06-2019', 1),
(33, 'Admin', 23, 82, 33, 82, '17-06-2019', 1),
(34, 'IT Department', 24, 82, 33, 82, '17-06-2019', 1),
(35, 'Medical', 24, 82, 33, 82, '17-06-2019', 1),
(36, 'Admin', 26, 83, 34, 83, '20-06-2019', 1),
(37, 'Admin', 27, 84, 35, 84, '20-06-2019', 1),
(38, 'Admin', 28, 85, 36, 85, '20-06-2019', 1),
(39, 'Admin', 29, 86, 37, 86, '20-06-2019', 1),
(40, 'Admin', 30, 87, 38, 87, '20-06-2019', 1),
(41, 'Admin', 31, 88, 39, 88, '20-06-2019', 1),
(42, 'Admin', 32, 89, 40, 89, '20-06-2019', 1),
(43, 'Admin', 33, 90, 41, 90, '20-06-2019', 1),
(44, 'Admin', 34, 91, 42, 91, '20-06-2019', 1),
(45, 'Admin', 35, 98, 48, 98, '10-07-2019', 1),
(46, 'Admin', 36, 103, 53, 103, '17-07-2019', 1),
(47, 'Admin', 37, 104, 54, 104, '17-07-2019', 1),
(48, 'Admin', 38, 105, 55, 105, '17-07-2019', 1),
(49, 'Sales', 37, 0, 54, 104, '17-07-2019', 1),
(50, 'Sales', 37, 104, 54, 104, '17-07-2019', 1),
(51, 'Admin', 39, 106, 56, 106, '17-07-2019', 1),
(52, 'Admin', 40, 107, 57, 107, '17-07-2019', 1),
(53, 'Admin', 41, 108, 58, 108, '17-07-2019', 1),
(54, 'Admin', 42, 109, 59, 109, '17-07-2019', 1),
(55, 'CTO', 42, 0, 59, 109, '17-07-2019', 1),
(56, 'ceo', 42, 109, 59, 109, '17-07-2019', 1),
(57, 'ceo', 42, 109, 59, 109, '17-07-2019', 1),
(58, 'Sales', 8, 60, 21, 59, '17-07-2019', 1),
(59, 'Sales', 8, 61, 21, 59, '17-07-2019', 1),
(60, 'PHP', 8, 59, 21, 59, '17-07-2019', 1),
(62, 'Admin', 44, 110, 60, 110, '19-07-2019', 1),
(64, 'Admin', 46, 110, 60, 110, '09-11-2020', 1),
(65, 'Admin', 47, 111, 61, 111, '09-11-2020', 1),
(66, 'Admin', 49, 117, 62, 117, '09-11-2020', 1),
(67, 'Admin', 50, 118, 63, 118, '09-11-2020', 1),
(68, 'Admin', 51, 120, 67, 120, '09-11-2020', 1),
(69, 'Admin', 52, 121, 68, 121, '09-11-2020', 1),
(70, 'web', 43, 62, 21, 59, '12-11-2020', 1),
(71, 'ios', 8, 60, 21, 59, '12-11-2020', 1),
(72, 'web', 43, 116, 21, 59, '12-11-2020', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hrms_designations`
--

CREATE TABLE `hrms_designations` (
  `designation_id` int(11) NOT NULL,
  `department_id` int(200) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `designation_name` varchar(200) NOT NULL,
  `added_by` int(111) NOT NULL,
  `created_at` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_designations`
--

INSERT INTO `hrms_designations` (`designation_id`, `department_id`, `company_id`, `designation_name`, `added_by`, `created_at`, `status`) VALUES
(1, 1, 17, 'admin admin', 44, '04-05-2018', 1),
(2, 2, 17, 'hr manager', 44, '04-05-2018', 1),
(3, 3, 18, 'hr2manager', 54, '04-05-2018', 1),
(4, 4, 19, 'admin', 55, '05-05-2018', 1),
(5, 5, 19, 'manager', 55, '05-05-2018', 1),
(6, 6, 19, 'employee', 55, '05-05-2018', 1),
(7, 7, 20, 'admin', 31, '05-05-2018', 1),
(8, 8, 20, 'hr manager', 56, '05-05-2018', 1),
(9, 7, 20, 'adminDes', 56, '05-05-2018', 1),
(10, 10, 21, 'admin', 31, '05-05-2018', 1),
(11, 11, 21, 'adminstration', 59, '05-05-2018', 1),
(12, 12, 21, 'hr manager', 59, '05-05-2018', 1),
(13, 13, 22, 'admin', 31, '07-05-2018', 1),
(15, 16, 23, 'admin', 31, '09-05-2018', 1),
(16, 17, 23, 'hr manager', 65, '09-05-2018', 1),
(17, 18, 22, 'Jr.hr manager ', 63, '09-05-2018', 1),
(18, 15, 22, 'Team lead', 63, '09-05-2018', 1),
(19, 19, 22, 'marketing lead ', 63, '09-05-2018', 1),
(20, 14, 22, 'Team lead (php)', 63, '09-05-2018', 1),
(21, 20, 22, 'Team lead', 63, '09-05-2018', 1),
(22, 22, 22, 'Team lead', 63, '09-05-2018', 1),
(23, 21, 22, 'Team lead', 63, '09-05-2018', 1),
(24, 14, 22, 'employ ', 63, '09-05-2018', 1),
(25, 23, 24, 'admin', 31, '15-06-2019', 1),
(26, 24, 25, 'admin', 31, '17-06-2019', 1),
(27, 25, 26, 'admin', 31, '17-06-2019', 1),
(28, 26, 27, 'admin', 31, '17-06-2019', 1),
(29, 27, 28, 'admin', 31, '17-06-2019', 1),
(30, 28, 29, 'admin', 31, '17-06-2019', 1),
(31, 29, 30, 'admin', 31, '17-06-2019', 1),
(32, 30, 31, 'admin', 31, '17-06-2019', 1),
(33, 32, 32, 'admin', 31, '17-06-2019', 1),
(34, 33, 33, 'admin', 31, '17-06-2019', 1),
(35, 34, 33, 'Job-1', 82, '17-06-2019', 1),
(36, 34, 33, 'job-2', 82, '17-06-2019', 1),
(37, 36, 34, 'admin', 31, '20-06-2019', 1),
(38, 37, 35, 'admin', 31, '20-06-2019', 1),
(39, 38, 36, 'admin', 31, '20-06-2019', 1),
(40, 39, 37, 'admin', 31, '20-06-2019', 1),
(41, 40, 38, 'admin', 31, '20-06-2019', 1),
(42, 41, 39, 'admin', 31, '20-06-2019', 1),
(43, 42, 40, 'admin', 31, '20-06-2019', 1),
(44, 43, 41, 'admin', 31, '20-06-2019', 1),
(45, 44, 42, 'admin', 31, '20-06-2019', 1),
(46, 45, 48, 'admin', 31, '10-07-2019', 1),
(47, 46, 53, 'admin', 31, '17-07-2019', 1),
(48, 47, 54, 'admin', 31, '17-07-2019', 1),
(49, 48, 55, 'admin', 31, '17-07-2019', 1),
(50, 47, 54, 'Training', 104, '17-07-2019', 1),
(51, 51, 56, 'admin', 31, '17-07-2019', 1),
(52, 52, 57, 'admin', 31, '17-07-2019', 1),
(53, 53, 58, 'admin', 31, '17-07-2019', 1),
(54, 54, 59, 'HR', 31, '17-07-2019', 1),
(55, 54, 59, 'CEO', 109, '17-07-2019', 1),
(56, 58, 21, 'BDE', 59, '17-07-2019', 1),
(57, 60, 21, 'Sr Developer', 59, '17-07-2019', 1),
(58, 60, 21, 'Junior dev', 59, '17-07-2019', 1),
(59, 61, 21, 'Android', 59, '18-07-2019', 1),
(60, 62, 60, 'admin', 31, '19-07-2019', 1),
(62, 64, 60, 'admin', 31, '09-11-2020', 1),
(63, 65, 61, 'admin', 31, '09-11-2020', 1),
(64, 66, 62, 'admin', 31, '09-11-2020', 1),
(65, 67, 63, 'admin', 31, '09-11-2020', 1),
(66, 68, 67, 'admin', 31, '09-11-2020', 1),
(67, 69, 68, 'admin', 31, '09-11-2020', 1),
(68, 12, 21, 'rtyttry', 59, '12-11-2020', 1),
(69, 11, 21, 'test', 59, '12-11-2020', 1),
(70, 11, 21, 'tester', 59, '12-11-2020', 1),
(71, 12, 21, 'test', 59, '12-11-2020', 1),
(72, 60, 21, 'tester', 59, '12-11-2020', 1),
(73, 12, 21, 'test', 59, '12-11-2020', 1),
(74, 60, 21, 'tester', 59, '12-11-2020', 1),
(75, 58, 21, 'tester', 59, '12-11-2020', 1),
(76, 70, 21, 'tester', 59, '12-11-2020', 1),
(77, 12, 21, 'tester', 59, '12-11-2020', 1),
(78, 12, 21, 'rt', 59, '12-11-2020', 1),
(79, 12, 21, 'tester', 59, '12-11-2020', 1),
(80, 12, 21, 'tester', 59, '12-11-2020', 1),
(81, 12, 21, 'dfdsf', 59, '12-11-2020', 1),
(82, 58, 21, 'dfdsf', 59, '12-11-2020', 1),
(83, 12, 21, 'tester', 59, '12-11-2020', 1),
(84, 12, 21, 'tester', 59, '12-11-2020', 1),
(85, 12, 21, 'tester', 59, '12-11-2020', 1),
(86, 58, 21, 'tester', 59, '12-11-2020', 1),
(87, 60, 21, 'tester', 59, '12-11-2020', 1),
(88, 59, 21, 'tester', 59, '12-11-2020', 1),
(89, 70, 21, 'tester', 59, '12-11-2020', 1),
(90, 59, 21, 'tester', 59, '12-11-2020', 1),
(91, 12, 21, 'asd', 59, '12-11-2020', 1),
(92, 12, 21, 'tester', 59, '12-11-2020', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hrms_disciplinary`
--

CREATE TABLE `hrms_disciplinary` (
  `disciplinary_id` int(111) NOT NULL,
  `company_id` int(111) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `added_by` int(111) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_disciplinary`
--

INSERT INTO `hrms_disciplinary` (`disciplinary_id`, `company_id`, `title`, `description`, `added_by`, `created_at`) VALUES
(1, 1, 'test 11', '&lt;p&gt;qwwte gsfd dfsdf gdfdfgdf&lt;/p&gt;', 1, '04-01-2018');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_document_type`
--

CREATE TABLE `hrms_document_type` (
  `document_type_id` int(11) NOT NULL,
  `document_type` varchar(255) NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_document_type`
--

INSERT INTO `hrms_document_type` (`document_type_id`, `document_type`, `created_at`) VALUES
(1, 'Driving License', '28-04-2017'),
(2, 'Passport', '28-04-2017'),
(3, 'Visa', '28-04-2017');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_email_history`
--

CREATE TABLE `hrms_email_history` (
  `history_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `email_type` varchar(100) NOT NULL,
  `email_for` varchar(100) NOT NULL,
  `email_to` varchar(100) NOT NULL,
  `email_subject` varchar(1000) NOT NULL,
  `email_message` longtext NOT NULL,
  `send_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_email_history`
--

INSERT INTO `hrms_email_history` (`history_id`, `employee_id`, `email_type`, `email_for`, `email_to`, `email_subject`, `email_message`, `send_date`) VALUES
(1, 10, 'receive', 'Welcome', 'ajay@infograins.com', 'Welcome Email  - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://192.168.1.120/ilinkhr/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Hello&nbsp;Ajay Patidar,</p><p>Welcome to&nbsp;iLinkHR&nbsp;.Thanks for joining&nbsp;iLinkHR. We listed your sign in details below, make sure you keep them safe.</p><p>Your Username: ajay123</p><p>Your Employee ID: INFO111<br>Your Email Address: ajay@infograins.com<br>Your Password: 123456</p><p><span style=\"font-size: 1rem;\">Link doesn&#039;t work? Copy the following link to your browser address bar:</span></p><p>http://localhost/ilinkhr/</p><p>Have fun!</p><p>The&nbsp;iLinkHR&nbsp;Team.</p></div>', '2017-12-28 10:25:58'),
(2, 10, 'receive', 'Award', 'Shilpa@infograins.com', 'Award Received - iLinkHR', '<div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"><img src=\"http://192.168.1.120/ilinkhr/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Hello&nbsp;Shilpa Shilpa,</p><p>You have been&nbsp;awarded&nbsp;Performer of the Year.</p><p>You can view this award by logging in to the portal using the link below.<br></p><p>Copy the following link to your browser address bar:</p><p>http://localhost/ilinkhr/</p><p>Regards</p><p>The iLinkHR Team</p></div>', '2017-12-28 10:26:25'),
(3, 10, 'receive', 'Warning', 'Shilpa@infograins.com', 'Warning : qwrety - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://192.168.1.120/ilinkhr/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Dear Employee,</p><p>You have a new Final Written Warning by Jyoti Kushwah.</p><p><strong>Warning Message :-&nbsp;</strong></p><p>&lt;p&gt;sd gfsad fas dfasdf asfasd&lt;/p&gt;</p><p>Regards,</p><p>The iLinkHR Team</p></div>', '2017-12-28 10:26:46'),
(4, 10, 'receive', 'Task Assign', 'Shilpa@infograins.com', 'Task assigned - iLinkHR', '<div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"><img src=\"http://192.168.1.120/ilinkhr/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Dear Employee,</p><p>A new task&nbsp;<span style=\"\\&quot;font-weight:\" bolder;\\\"=\"\">HRMS</span>&nbsp;has been assigned to you by&nbsp;<span style=\"\\&quot;font-weight:\" bolder;\\\"=\"\">Admin Admin</span>.</p><p>You can view this task by logging in to the portal using the link below.</p><p><span style=\"font-size: 1rem;\">Copy the following link to your browser address bar:</span></p><p>http://localhost/ilinkhr/</p><p>Regards,</p><p>The iLinkHR Team</p></div>', '2017-12-28 10:27:37'),
(5, 20, 'receive', 'Task Assign', 'ranjeet@infograins.com', 'Task assigned - iLinkHR', '<div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"><img src=\"http://192.168.1.120/ilinkhr/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Dear Employee,</p><p>A new task&nbsp;<span style=\"\\&quot;font-weight:\" bolder;\\\"=\"\">HRMS</span>&nbsp;has been assigned to you by&nbsp;<span style=\"\\&quot;font-weight:\" bolder;\\\"=\"\">Admin Admin</span>.</p><p>You can view this task by logging in to the portal using the link below.</p><p><span style=\"font-size: 1rem;\">Copy the following link to your browser address bar:</span></p><p>http://localhost/ilinkhr/</p><p>Regards,</p><p>The iLinkHR Team</p></div>', '2017-12-28 10:27:37'),
(6, 27, 'receive', 'Task Assign', 'shalinee@infograins.com', 'Task assigned - iLinkHR', '<div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"><img src=\"http://192.168.1.120/ilinkhr/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Dear Employee,</p><p>A new task&nbsp;<span style=\"\\&quot;font-weight:\" bolder;\\\"=\"\">HRMS</span>&nbsp;has been assigned to you by&nbsp;<span style=\"\\&quot;font-weight:\" bolder;\\\"=\"\">Admin Admin</span>.</p><p>You can view this task by logging in to the portal using the link below.</p><p><span style=\"font-size: 1rem;\">Copy the following link to your browser address bar:</span></p><p>http://localhost/ilinkhr/</p><p>Regards,</p><p>The iLinkHR Team</p></div>', '2017-12-28 10:27:37'),
(7, 29, 'receive', 'Task Assign', 'ajay@infograins.com', 'Task assigned - iLinkHR', '<div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"><img src=\"http://192.168.1.120/ilinkhr/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Dear Employee,</p><p>A new task&nbsp;<span style=\"\\&quot;font-weight:\" bolder;\\\"=\"\">HRMS</span>&nbsp;has been assigned to you by&nbsp;<span style=\"\\&quot;font-weight:\" bolder;\\\"=\"\">Admin Admin</span>.</p><p>You can view this task by logging in to the portal using the link below.</p><p><span style=\"font-size: 1rem;\">Copy the following link to your browser address bar:</span></p><p>http://localhost/ilinkhr/</p><p>Regards,</p><p>The iLinkHR Team</p></div>', '2017-12-28 10:27:37'),
(8, 10, 'send', 'Leave', 'info@ilinkhr.com', 'A Leave Request from you - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://localhost/ilinkhr/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Dear Admin,</p><p>Shilpa Shilpa&nbsp;wants a leave from you.</p><p>You can view this leave request by logging in to the portal using the link below.</p><p>Regards</p><p>The iLinkHR Team</p></div>', '2017-12-28 10:28:07'),
(9, 10, 'receive', 'Leave', 'Shilpa@infograins.com', 'Your leave request has been approved - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://192.168.1.120/ilinkhr/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Your leave request has been approved</p><p><font color=\"#333333\" face=\"sans-serif, Arial, Verdana, Trebuchet MS\">Congratulations!&nbsp;Your leave request from&nbsp;</font>01-Dec-2017&nbsp;to&nbsp;10-Dec-2017&nbsp;has been approved by your company management.</p><p>Regards<br>The iLinkHR Team</p></div>', '2017-12-28 10:28:16'),
(10, 4, 'receive', 'Task Assign', 'vipin@infograins.com', 'Task assigned - iLinkHR', '<div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"><img src=\"http://localhost/ilinkhr/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Dear Employee,</p><p>A new task&nbsp;<span style=\"\\&quot;font-weight:\" bolder;\\\"=\"\">aSf asd fasdf</span>&nbsp;has been assigned to you by&nbsp;<span style=\"\\&quot;font-weight:\" bolder;\\\"=\"\">Admin Admin</span>.</p><p>You can view this task by logging in to the portal using the link below.</p><p><span style=\"font-size: 1rem;\">Copy the following link to your browser address bar:</span></p><p>http://localhost/ilinkhr/</p><p>Regards,</p><p>The iLinkHR Team</p></div>', '2017-12-28 11:24:55'),
(11, 10, 'receive', 'Task Assign', 'Shilpa@infograins.com', 'Task assigned - iLinkHR', '<div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"><img src=\"http://localhost/ilinkhr/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Dear Employee,</p><p>A new task&nbsp;<span style=\"\\&quot;font-weight:\" bolder;\\\"=\"\">Test Task</span>&nbsp;has been assigned to you by&nbsp;<span style=\"\\&quot;font-weight:\" bolder;\\\"=\"\">Admin Admin</span>.</p><p>You can view this task by logging in to the portal using the link below.</p><p><span style=\"font-size: 1rem;\">Copy the following link to your browser address bar:</span></p><p>http://localhost/ilinkhr/</p><p>Regards,</p><p>The iLinkHR Team</p></div>', '2017-12-29 07:51:41'),
(12, 20, 'receive', 'Task Assign', 'ranjeet@infograins.com', 'Task assigned - iLinkHR', '<div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"><img src=\"http://localhost/ilinkhr/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Dear Employee,</p><p>A new task&nbsp;<span style=\"\\&quot;font-weight:\" bolder;\\\"=\"\">Test Task</span>&nbsp;has been assigned to you by&nbsp;<span style=\"\\&quot;font-weight:\" bolder;\\\"=\"\">Admin Admin</span>.</p><p>You can view this task by logging in to the portal using the link below.</p><p><span style=\"font-size: 1rem;\">Copy the following link to your browser address bar:</span></p><p>http://localhost/ilinkhr/</p><p>Regards,</p><p>The iLinkHR Team</p></div>', '2017-12-29 07:51:41'),
(13, 10, 'receive', 'Warning', 'Shilpa@infograins.com', 'Warning : Test Warning - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://192.168.1.120/ilinkhr/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Dear Employee,</p><p>You have a new First Written Warning by Jyoti Kushwah.</p><p><strong>Warning Message :-&nbsp;</strong></p><p>Warning test content</p><p>Regards,</p><p>The iLinkHR Team</p></div>', '2017-12-30 06:48:32'),
(14, 10, 'receive', 'Warning', 'Shilpa@infograins.com', 'Warning : Test Warning 1 - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://192.168.1.120/ilinkhr/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Dear Employee,</p><p>You have a new Verbal Warning by Jyoti Kushwah.</p><p><strong>Warning Message :-&nbsp;</strong></p><p>Hello this is first warning test description.</p><p>Regards,</p><p>The iLinkHR Team</p></div>', '2017-12-30 06:54:31'),
(15, 10, 'receive', 'Warning', 'Shilpa@infograins.com', 'Warning : Test Warning 2 - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://192.168.1.120/ilinkhr/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Dear Employee,</p><p>You have a new Final Written Warning by Jyoti Kushwah.</p><p><strong>Warning Message :-&nbsp;</strong></p><p>Hello this is second warning test description.</p><p>Regards,</p><p>The iLinkHR Team</p></div>', '2017-12-30 06:54:57'),
(16, 21, 'receive', 'Leave', 'aaryav27@yopmail.com', 'Your leave request has been approved - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://192.168.1.120/ilinkhr/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Your leave request has been approved</p><p><font color=\"#333333\" face=\"sans-serif, Arial, Verdana, Trebuchet MS\">Congratulations!&nbsp;Your leave request from&nbsp;</font>06-Dec-2017&nbsp;to&nbsp;07-Dec-2017&nbsp;has been approved by your company management.</p><p>Regards<br>The iLinkHR Team</p></div>', '2018-01-02 05:13:48'),
(17, 19, 'receive', 'Leave', 'shweta20@yopmail.com', 'Your leave request has been approved - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://192.168.1.120/ilinkhr/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Your leave request has been approved</p><p><font color=\"#333333\" face=\"sans-serif, Arial, Verdana, Trebuchet MS\">Congratulations!&nbsp;Your leave request from&nbsp;</font>07-Dec-2017&nbsp;to&nbsp;15-Dec-2017&nbsp;has been approved by your company management.</p><p>Regards<br>The iLinkHR Team</p></div>', '2018-01-02 05:14:11'),
(18, 10, 'receive', 'Leave', 'kripa@infograins.com', 'Your leave request has been approved - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://192.168.1.120/ilinkhr/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Your leave request has been approved</p><p><font color=\"#333333\" face=\"sans-serif, Arial, Verdana, Trebuchet MS\">Congratulations!&nbsp;Your leave request from&nbsp;</font>06-Jan-2018&nbsp;to&nbsp;07-Jan-2018&nbsp;has been approved by your company management.</p><p>Regards<br>The iLinkHR Team</p></div>', '2018-01-06 06:54:52'),
(19, 30, 'receive', 'Welcome', 'rashmi@gmail.com', 'Welcome Email  - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://192.168.1.120/ilinkhr/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Hello&nbsp;sasa sasas,</p><p>Welcome to&nbsp;iLinkHR&nbsp;.Thanks for joining&nbsp;iLinkHR. We listed your sign in details below, make sure you keep them safe.</p><p>Your Username: rashmi</p><p>Your Employee ID: 001<br>Your Email Address: rashmi@gmail.com<br>Your Password: asdfgh</p><p><span style=\"font-size: 1rem;\">Link doesn&#039;t work? Copy the following link to your browser address bar:</span></p><p>http://192.168.1.120/ilinkhr/</p><p>Have fun!</p><p>The&nbsp;iLinkHR&nbsp;Team.</p></div>', '2018-01-06 07:57:23'),
(20, 6, 'send', 'Leave', 'info@ilinkhr.com', 'A Leave Request from you - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://192.168.1.120/ilinkhr/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Dear Admin,</p><p>Amit Batham&nbsp;wants a leave from you.</p><p>You can view this leave request by logging in to the portal using the link below.</p><p>Regards</p><p>The iLinkHR Team</p></div>', '2018-01-06 08:01:26'),
(21, 17, 'send', 'Leave', 'info@ilinkhr.com', 'A Leave Request from you - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://192.168.1.120/ilinkhr/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Dear Admin,</p><p>archna jayswal&nbsp;wants a leave from you.</p><p>You can view this leave request by logging in to the portal using the link below.</p><p>Regards</p><p>The iLinkHR Team</p></div>', '2018-01-06 08:02:35'),
(22, 5, 'send', 'Leave', 'info@ilinkhr.com', 'A Leave Request from you - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://192.168.1.120/ilinkhr/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Dear Admin,</p><p>Abdul Alim&nbsp;wants a leave from you.</p><p>You can view this leave request by logging in to the portal using the link below.</p><p>Regards</p><p>The iLinkHR Team</p></div>', '2018-01-06 08:04:17'),
(23, 6, 'receive', 'Leave', 'amit@infograins.com', 'Your leave request has been Rejected - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://192.168.1.120/ilinkhr/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Your leave request has been Rejected</p><p>Unfortunately !&nbsp;Your leave request from&nbsp;01-Jan-2018&nbsp;to&nbsp;31-Jan-2018&nbsp;has been Rejected by your company management.</p><p>Regards</p><p>The iLinkHR Team</p></div>', '2018-01-06 08:05:26'),
(24, 6, 'receive', 'Leave', 'amit@infograins.com', 'Your leave request has been approved - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://192.168.1.120/ilinkhr/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Your leave request has been approved</p><p><font color=\"\\&quot;#333333\\&quot;\" face=\"\\&quot;sans-serif,\" arial,=\"\" verdana,=\"\" trebuchet=\"\" ms\\\"=\"\">Congratulations!&nbsp;Your leave request from&nbsp;</font>01-Jan-2018&nbsp;to&nbsp;31-Jan-2018&nbsp;has been approved by your company management.</p><p>&lt;p&gt;sdasdasd&lt;/p&gt;</p><p>Regards<br>The iLinkHR Team</p></div>', '2018-01-06 08:08:35'),
(25, 6, 'receive', 'Leave', 'amit@infograins.com', 'Your leave request has been approved - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://192.168.1.120/ilinkhr/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Your leave request has been approved</p><p><font color=\"\\&quot;#333333\\&quot;\" face=\"\\&quot;sans-serif,\" arial,=\"\" verdana,=\"\" trebuchet=\"\" ms\\\"=\"\">Congratulations!&nbsp;Your leave request from&nbsp;</font>01-Jan-2018&nbsp;to&nbsp;31-Jan-2018&nbsp;has been approved by your company management.</p><p>&lt;p&gt;sdasdasdzsz fs ar gaga f SA1F6A4D6 3AS5DF3 68W4EF65 34ASFD354 A8F64W 6EF46 5E4 A0R 64 8EH52S1V3684 6A5FR14 98R&lt;/p&gt;</p><p>Regards<br>The iLinkHR Team</p></div>', '2018-01-06 08:09:10'),
(26, 21, 'receive', 'Leave', 'aaryav27@yopmail.com', ' - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://192.168.1.120/ilinkhr/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br></div>', '2018-01-09 05:51:43'),
(27, 21, 'receive', 'Leave', 'aaryav27@yopmail.com', ' - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://192.168.1.120/ilinkhr/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br></div>', '2018-01-09 05:51:44'),
(28, 21, 'receive', 'Leave', 'aaryav27@yopmail.com', 'Your leave request has been Rejected - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://192.168.1.120/ilinkhr/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Your leave request has been Rejected</p><p>Unfortunately !&nbsp;Your leave request from&nbsp;06-Dec-2017&nbsp;to&nbsp;07-Dec-2017&nbsp;has been Rejected by your company management.</p><p>&lt;p&gt;ryrtytyty&lt;/p&gt;</p><p>Regards</p><p>The iLinkHR Team</p></div>', '2018-01-09 05:51:52'),
(29, 21, 'receive', 'Leave', 'aaryav27@yopmail.com', 'Your leave request has been Rejected - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://192.168.1.120/ilinkhr/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Your leave request has been Rejected</p><p>Unfortunately !&nbsp;Your leave request from&nbsp;06-Dec-2017&nbsp;to&nbsp;07-Dec-2017&nbsp;has been Rejected by your company management.</p><p>&lt;p&gt;Your leave approved&lt;/p&gt;</p><p>Regards</p><p>The iLinkHR Team</p></div>', '2018-01-09 05:52:01'),
(30, 21, 'receive', 'Leave', 'aaryav27@yopmail.com', 'Your leave request has been approved - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://192.168.1.120/ilinkhr/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Your leave request has been approved</p><p><font color=\"\\&quot;#333333\\&quot;\" face=\"\\&quot;sans-serif,\" arial,=\"\" verdana,=\"\" trebuchet=\"\" ms\\\"=\"\">Congratulations!&nbsp;Your leave request from&nbsp;</font>06-Dec-2017&nbsp;to&nbsp;07-Dec-2017&nbsp;has been approved by your company management.</p><p>&lt;p&gt;Your leave approved&lt;/p&gt;</p><p>Regards<br>The iLinkHR Team</p></div>', '2018-01-09 05:52:07'),
(31, 30, 'receive', 'Welcome', 'pooja@gmail.com', 'Welcome Email  - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"https://infograins.in/INFO01/hrms/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Hello&nbsp;pooja jain,</p><p>Welcome to&nbsp;iLinkHR&nbsp;.Thanks for joining&nbsp;iLinkHR. We listed your sign in details below, make sure you keep them safe.</p><p>Your Username: pooja</p><p>Your Employee ID: 001<br>Your Email Address: pooja@gmail.com<br>Your Password: 123456</p><p><span style=\"font-size: 1rem;\">Link doesn&#039;t work? Copy the following link to your browser address bar:</span></p><p>https://infograins.in/INFO01/hrms/</p><p>Have fun!</p><p>The&nbsp;iLinkHR&nbsp;Team.</p></div>', '2018-04-16 11:39:37'),
(32, 31, 'receive', 'Welcome', 'superadmin@gmail.com', 'Welcome Email  - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://192.168.1.118/hrms/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Hello&nbsp;super admin,</p><p>Welcome to&nbsp;iLinkHR&nbsp;.Thanks for joining&nbsp;iLinkHR. We listed your sign in details below, make sure you keep them safe.</p><p>Your Username: superAdmin</p><p>Your Employee ID: INFO1110<br>Your Email Address: superadmin@gmail.com<br>Your Password: superadmin</p><p><span style=\"font-size: 1rem;\">Link doesn&#039;t work? Copy the following link to your browser address bar:</span></p><p>http://192.168.1.118/hrms/</p><p>Have fun!</p><p>The&nbsp;iLinkHR&nbsp;Team.</p></div>', '2018-04-18 07:24:32'),
(33, 42, 'receive', 'Welcome', 'ritika@infograins.com', 'Welcome Email  - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://192.168.1.118/hrms/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Hello&nbsp;r r,</p><p>Welcome to&nbsp;iLinkHR&nbsp;.Thanks for joining&nbsp;iLinkHR. We listed your sign in details below, make sure you keep them safe.</p><p>Your Username: ritika22</p><p>Your Employee ID: INFO1110<br>Your Email Address: ritika@infograins.com<br>Your Password: 123456</p><p><span style=\"font-size: 1rem;\">Link doesn&#039;t work? Copy the following link to your browser address bar:</span></p><p>http://192.168.1.118/hrms/</p><p>Have fun!</p><p>The&nbsp;iLinkHR&nbsp;Team.</p></div>', '2018-04-20 07:47:11'),
(34, 45, 'receive', 'Welcome', 'tina@gmail.com', 'Welcome Email  - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://192.168.1.118/hrms/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Hello&nbsp;tina jain,</p><p>Welcome to&nbsp;iLinkHR&nbsp;.Thanks for joining&nbsp;iLinkHR. We listed your sign in details below, make sure you keep them safe.</p><p>Your Username: tina</p><p>Your Employee ID: INFOTECH001<br>Your Email Address: tina@gmail.com<br>Your Password: 123456</p><p><span style=\"font-size: 1rem;\">Link doesn&#039;t work? Copy the following link to your browser address bar:</span></p><p>http://192.168.1.118/hrms/</p><p>Have fun!</p><p>The&nbsp;iLinkHR&nbsp;Team.</p></div>', '2018-04-21 12:38:11'),
(35, 46, 'receive', 'Welcome', 'ritika@gmail.com', 'Welcome Email  - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://192.168.1.118/hrms/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Hello&nbsp;test employee,</p><p>Welcome to&nbsp;iLinkHR&nbsp;.Thanks for joining&nbsp;iLinkHR. We listed your sign in details below, make sure you keep them safe.</p><p>Your Username: testEmp</p><p>Your Employee ID: INFO1111<br>Your Email Address: ritika@gmail.com<br>Your Password: 123456</p><p><span style=\"font-size: 1rem;\">Link doesn&#039;t work? Copy the following link to your browser address bar:</span></p><p>http://192.168.1.118/hrms/</p><p>Have fun!</p><p>The&nbsp;iLinkHR&nbsp;Team.</p></div>', '2018-04-23 05:40:46'),
(36, 47, 'receive', 'Welcome', 'ritika@gmail.com', 'Welcome Email  - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://192.168.1.118/hrms/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Hello&nbsp;test admin,</p><p>Welcome to&nbsp;iLinkHR&nbsp;.Thanks for joining&nbsp;iLinkHR. We listed your sign in details below, make sure you keep them safe.</p><p>Your Username: riti</p><p>Your Employee ID: INFO1111<br>Your Email Address: ritika@gmail.com<br>Your Password: 123456</p><p><span style=\"font-size: 1rem;\">Link doesn&#039;t work? Copy the following link to your browser address bar:</span></p><p>http://192.168.1.118/hrms/</p><p>Have fun!</p><p>The&nbsp;iLinkHR&nbsp;Team.</p></div>', '2018-04-23 05:47:00'),
(37, 48, 'receive', 'Welcome', 'ritika@gmail.com', 'Welcome Email  - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://192.168.1.118/hrms/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Hello&nbsp;testTwo testTwo,</p><p>Welcome to&nbsp;iLinkHR&nbsp;.Thanks for joining&nbsp;iLinkHR. We listed your sign in details below, make sure you keep them safe.</p><p>Your Username: test2</p><p>Your Employee ID: INFO1112<br>Your Email Address: ritika@gmail.com<br>Your Password: 123456</p><p><span style=\"font-size: 1rem;\">Link doesn&#039;t work? Copy the following link to your browser address bar:</span></p><p>http://192.168.1.118/hrms/</p><p>Have fun!</p><p>The&nbsp;iLinkHR&nbsp;Team.</p></div>', '2018-04-23 07:18:10'),
(38, 48, 'send', 'Leave', 'info@ilinkhr.com', 'A Leave Request from you - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://192.168.1.118/hrms/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Dear Admin,</p><p>testTwo testTwo&nbsp;wants a leave from you.</p><p>You can view this leave request by logging in to the portal using the link below.</p><p>Regards</p><p>The iLinkHR Team</p></div>', '2018-04-25 10:50:19'),
(39, 48, 'receive', 'Leave', 'ritika@gmail.com', 'Your leave request has been approved - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://192.168.1.118/hrms/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Your leave request has been approved</p><p><font color=\"\\&quot;#333333\\&quot;\" face=\"\\&quot;sans-serif,\" arial,=\"\" verdana,=\"\" trebuchet=\"\" ms\\\"=\"\">Congratulations!&nbsp;Your leave request from&nbsp;</font>27-Apr-2018&nbsp;to&nbsp;28-Apr-2018&nbsp;has been approved by your company management.</p><p>&lt;p&gt;&lt;br&gt;&lt;/p&gt;</p><p>Regards<br>The iLinkHR Team</p></div>', '2018-04-25 10:50:54'),
(40, 49, 'receive', 'Welcome', 'tina@gmail.com', 'Welcome Email  - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://192.168.1.118/hrms/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Hello&nbsp;tina jain,</p><p>Welcome to&nbsp;iLinkHR&nbsp;.Thanks for joining&nbsp;iLinkHR. We listed your sign in details below, make sure you keep them safe.</p><p>Your Username: tina</p><p>Your Employee ID: INFO123<br>Your Email Address: tina@gmail.com<br>Your Password: 123456</p><p><span style=\"font-size: 1rem;\">Link doesn&#039;t work? Copy the following link to your browser address bar:</span></p><p>http://192.168.1.118/hrms/</p><p>Have fun!</p><p>The&nbsp;iLinkHR&nbsp;Team.</p></div>', '2018-04-26 07:07:35'),
(41, 50, 'receive', 'Welcome', 'tyt@gmail.com', 'Welcome Email  - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://192.168.1.118/hrms/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Hello&nbsp;tty yty,</p><p>Welcome to&nbsp;iLinkHR&nbsp;.Thanks for joining&nbsp;iLinkHR. We listed your sign in details below, make sure you keep them safe.</p><p>Your Username: tyty</p><p>Your Employee ID: tyt<br>Your Email Address: tyt@gmail.com<br>Your Password: 1234567</p><p><span style=\"font-size: 1rem;\">Link doesn&#039;t work? Copy the following link to your browser address bar:</span></p><p>http://192.168.1.118/hrms/</p><p>Have fun!</p><p>The&nbsp;iLinkHR&nbsp;Team.</p></div>', '2018-04-26 09:59:20'),
(42, 51, 'receive', 'Welcome', 'ritika@infograins.com', 'Welcome Email  - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://192.168.1.118/hrms/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Hello&nbsp;rrt tr,</p><p>Welcome to&nbsp;iLinkHR&nbsp;.Thanks for joining&nbsp;iLinkHR. We listed your sign in details below, make sure you keep them safe.</p><p>Your Username: rtrt</p><p>Your Employee ID: trt<br>Your Email Address: ritika@infograins.com<br>Your Password: 123456</p><p><span style=\"font-size: 1rem;\">Link doesn&#039;t work? Copy the following link to your browser address bar:</span></p><p>http://192.168.1.118/hrms/</p><p>Have fun!</p><p>The&nbsp;iLinkHR&nbsp;Team.</p></div>', '2018-04-26 10:12:30'),
(43, 49, 'receive', 'Leave', 'tina@gmail.com', 'Your leave request has been approved - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://192.168.1.118/hrms/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Your leave request has been approved</p><p><font color=\"\\&quot;#333333\\&quot;\" face=\"\\&quot;sans-serif,\" arial,=\"\" verdana,=\"\" trebuchet=\"\" ms\\\"=\"\">Congratulations!&nbsp;Your leave request from&nbsp;</font>10-Dec-2017&nbsp;to&nbsp;15-Dec-2017&nbsp;has been approved by your company management.</p><p>&lt;p&gt;&lt;br&gt;&lt;/p&gt;</p><p>Regards<br>The iLinkHR Team</p></div>', '2018-05-01 12:43:13'),
(44, 49, 'receive', 'Leave', 'tina@gmail.com', 'Your leave request has been Rejected - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://192.168.1.118/hrms/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Your leave request has been Rejected</p><p>Unfortunately !&nbsp;Your leave request from&nbsp;10-Dec-2017&nbsp;to&nbsp;15-Dec-2017&nbsp;has been Rejected by your company management.</p><p>&lt;p&gt;&lt;br&gt;&lt;/p&gt;</p><p>Regards</p><p>The iLinkHR Team</p></div>', '2018-05-01 12:43:45'),
(45, 48, 'receive', 'Leave', 'ritika@gmail.com', 'Your leave request has been approved - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://192.168.1.118/hrms/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Your leave request has been approved</p><p><font color=\"\\&quot;#333333\\&quot;\" face=\"\\&quot;sans-serif,\" arial,=\"\" verdana,=\"\" trebuchet=\"\" ms\\\"=\"\">Congratulations!&nbsp;Your leave request from&nbsp;</font>27-Apr-2018&nbsp;to&nbsp;28-Apr-2018&nbsp;has been approved by your company management.</p><p></p><p>Regards<br>The iLinkHR Team</p></div>', '2018-05-03 08:48:23'),
(46, 52, 'receive', 'Welcome', 'ritika@infograins.com', 'Welcome Email  - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://192.168.1.118/hrms/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Hello&nbsp;ritika bhawsar,</p><p>Welcome to&nbsp;iLinkHR&nbsp;.Thanks for joining&nbsp;iLinkHR. We listed your sign in details below, make sure you keep them safe.</p><p>Your Username: ritika</p><p>Your Employee ID: 12<br>Your Email Address: ritika@infograins.com<br>Your Password: 123456</p><p><span style=\"font-size: 1rem;\">Link doesn&#039;t work? Copy the following link to your browser address bar:</span></p><p>http://192.168.1.118/hrms/</p><p>Have fun!</p><p>The&nbsp;iLinkHR&nbsp;Team.</p></div>', '2018-05-04 14:01:30'),
(47, 57, 'receive', 'Welcome', 'pawan@infograins.com', 'Welcome Email  - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"https://infograins.in/INFO01/hrms/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Hello&nbsp;pawan paliwal,</p><p>Welcome to&nbsp;iLinkHR&nbsp;.Thanks for joining&nbsp;iLinkHR. We listed your sign in details below, make sure you keep them safe.</p><p>Your Username: pawan</p><p>Your Employee ID: INFO001<br>Your Email Address: pawan@infograins.com<br>Your Password: 123456</p><p><span style=\"font-size: 1rem;\">Link doesn&#039;t work? Copy the following link to your browser address bar:</span></p><p>https://infograins.in/INFO01/hrms/</p><p>Have fun!</p><p>The&nbsp;iLinkHR&nbsp;Team.</p></div>', '2018-05-05 09:55:19'),
(48, 58, 'receive', 'Welcome', 'ajay@infograins.com', 'Welcome Email  - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"https://infograins.in/INFO01/hrms/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Hello&nbsp;ajay patidar,</p><p>Welcome to&nbsp;iLinkHR&nbsp;.Thanks for joining&nbsp;iLinkHR. We listed your sign in details below, make sure you keep them safe.</p><p>Your Username: ajay</p><p>Your Employee ID: INFO1110<br>Your Email Address: ajay@infograins.com<br>Your Password: 123456</p><p><span style=\"font-size: 1rem;\">Link doesn&#039;t work? Copy the following link to your browser address bar:</span></p><p>https://infograins.in/INFO01/hrms/</p><p>Have fun!</p><p>The&nbsp;iLinkHR&nbsp;Team.</p></div>', '2018-05-05 10:01:35'),
(49, 60, 'receive', 'Welcome', 'ajayIn@infograins.com', 'Welcome Email  - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"https://infograins.in/INFO01/hrms/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Hello&nbsp;Ajay sukla,</p><p>Welcome to&nbsp;iLinkHR&nbsp;.Thanks for joining&nbsp;iLinkHR. We listed your sign in details below, make sure you keep them safe.</p><p>Your Username: ajay</p><p>Your Employee ID: INFO1110<br>Your Email Address: ajayIn@infograins.com<br>Your Password: 123456</p><p><span style=\"font-size: 1rem;\">Link doesn&#039;t work? Copy the following link to your browser address bar:</span></p><p>https://infograins.in/INFO01/hrms/</p><p>Have fun!</p><p>The&nbsp;iLinkHR&nbsp;Team.</p></div>', '2018-05-05 10:08:27'),
(50, 61, 'receive', 'Welcome', 'pawan@inf.com', 'Welcome Email  - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"https://infograins.in/INFO01/hrms/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Hello&nbsp;pawan paliwal,</p><p>Welcome to&nbsp;iLinkHR&nbsp;.Thanks for joining&nbsp;iLinkHR. We listed your sign in details below, make sure you keep them safe.</p><p>Your Username: pawan</p><p>Your Employee ID: INFO1110<br>Your Email Address: pawan@inf.com<br>Your Password: 123456</p><p><span style=\"font-size: 1rem;\">Link doesn&#039;t work? Copy the following link to your browser address bar:</span></p><p>https://infograins.in/INFO01/hrms/</p><p>Have fun!</p><p>The&nbsp;iLinkHR&nbsp;Team.</p></div>', '2018-05-05 10:12:09'),
(51, 62, 'receive', 'Welcome', 'ajay@infograins.com', 'Welcome Email  - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"https://infograins.in/INFO01/hrms/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Hello&nbsp;Ajay patidar,</p><p>Welcome to&nbsp;iLinkHR&nbsp;.Thanks for joining&nbsp;iLinkHR. We listed your sign in details below, make sure you keep them safe.</p><p>Your Username: ajaypatidar</p><p>Your Employee ID: INFO1110<br>Your Email Address: ajay@infograins.com<br>Your Password: 123456</p><p><span style=\"font-size: 1rem;\">Link doesn&#039;t work? Copy the following link to your browser address bar:</span></p><p>https://infograins.in/INFO01/hrms/</p><p>Have fun!</p><p>The&nbsp;iLinkHR&nbsp;Team.</p></div>', '2018-05-05 10:13:30'),
(52, 60, 'receive', 'Task Assign', 'ajayIn@infograins.com', 'Task assigned - iLinkHR', '<div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"><img src=\"https://infograins.in/INFO01/hrms/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Dear Employee,</p><p>A new task&nbsp;<span style=\"\\&quot;font-weight:\" bolder;\\\"=\"\">hrms first module</span>&nbsp;has been assigned to you by&nbsp;<span style=\"\\&quot;font-weight:\" bolder;\\\"=\"\">info com</span>.</p><p>You can view this task by logging in to the portal using the link below.</p><p><span style=\"font-size: 1rem;\">Copy the following link to your browser address bar:</span></p><p>https://infograins.in/INFO01/hrms/</p><p>Regards,</p><p>The iLinkHR Team</p></div>', '2018-05-05 10:18:16'),
(53, 61, 'receive', 'Task Assign', 'pawan@inf.com', 'Task assigned - iLinkHR', '<div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"><img src=\"https://infograins.in/INFO01/hrms/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Dear Employee,</p><p>A new task&nbsp;<span style=\"\\&quot;font-weight:\" bolder;\\\"=\"\">hrms first module</span>&nbsp;has been assigned to you by&nbsp;<span style=\"\\&quot;font-weight:\" bolder;\\\"=\"\">info com</span>.</p><p>You can view this task by logging in to the portal using the link below.</p><p><span style=\"font-size: 1rem;\">Copy the following link to your browser address bar:</span></p><p>https://infograins.in/INFO01/hrms/</p><p>Regards,</p><p>The iLinkHR Team</p></div>', '2018-05-05 10:18:16'),
(54, 60, 'receive', 'Task Assign', 'ajayIn@infograins.com', 'Task assigned - iLinkHR', '<div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"><img src=\"https://infograins.in/INFO01/hrms/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Dear Employee,</p><p>A new task&nbsp;<span style=\"\\&quot;font-weight:\" bolder;\\\"=\"\">hrms first module</span>&nbsp;has been assigned to you by&nbsp;<span style=\"\\&quot;font-weight:\" bolder;\\\"=\"\">info com</span>.</p><p>You can view this task by logging in to the portal using the link below.</p><p><span style=\"font-size: 1rem;\">Copy the following link to your browser address bar:</span></p><p>https://infograins.in/INFO01/hrms/</p><p>Regards,</p><p>The iLinkHR Team</p></div>', '2018-05-05 10:26:04'),
(55, 61, 'receive', 'Task Assign', 'pawan@inf.com', 'Task assigned - iLinkHR', '<div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"><img src=\"https://infograins.in/INFO01/hrms/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Dear Employee,</p><p>A new task&nbsp;<span style=\"\\&quot;font-weight:\" bolder;\\\"=\"\">hrms first module</span>&nbsp;has been assigned to you by&nbsp;<span style=\"\\&quot;font-weight:\" bolder;\\\"=\"\">info com</span>.</p><p>You can view this task by logging in to the portal using the link below.</p><p><span style=\"font-size: 1rem;\">Copy the following link to your browser address bar:</span></p><p>https://infograins.in/INFO01/hrms/</p><p>Regards,</p><p>The iLinkHR Team</p></div>', '2018-05-05 10:26:04'),
(56, 62, 'receive', 'Task Assign', 'ajay@infograins.com', 'Task assigned - iLinkHR', '<div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"><img src=\"https://infograins.in/INFO01/hrms/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Dear Employee,</p><p>A new task&nbsp;<span style=\"\\&quot;font-weight:\" bolder;\\\"=\"\">hrms first module</span>&nbsp;has been assigned to you by&nbsp;<span style=\"\\&quot;font-weight:\" bolder;\\\"=\"\">info com</span>.</p><p>You can view this task by logging in to the portal using the link below.</p><p><span style=\"font-size: 1rem;\">Copy the following link to your browser address bar:</span></p><p>https://infograins.in/INFO01/hrms/</p><p>Regards,</p><p>The iLinkHR Team</p></div>', '2018-05-05 10:26:04'),
(57, 62, 'receive', 'Award', 'ajay@infograins.com', 'Award Received - iLinkHR', '<div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"><img src=\"https://infograins.in/INFO01/hrms/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Hello&nbsp;Ajay patidar,</p><p>You have been&nbsp;awarded&nbsp;Employee of the Month.</p><p>You can view this award by logging in to the portal using the link below.<br></p><p>Copy the following link to your browser address bar:</p><p>https://infograins.in/INFO01/hrms/</p><p>Regards</p><p>The iLinkHR Team</p></div>', '2018-05-05 12:19:20'),
(58, 60, 'receive', 'Warning', 'ajayIn@infograins.com', 'Warning : late coming - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"https://infograins.in/INFO01/hrms/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Dear Employee,</p><p>You have a new Verbal Warning by Ajay sukla.</p><p><strong>Warning Message :-&nbsp;</strong></p><p>this is last warning</p><p>Regards,</p><p>The iLinkHR Team</p></div>', '2018-05-05 12:26:20'),
(59, 64, 'receive', 'Welcome', 'su@yopmail.com', 'Welcome Email  - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"https://infograins.in/INFO01/hrms/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Hello&nbsp;suma aa,</p><p>Welcome to&nbsp;iLinkHR&nbsp;.Thanks for joining&nbsp;iLinkHR. We listed your sign in details below, make sure you keep them safe.</p><p>Your Username: su</p><p>Your Employee ID: info001<br>Your Email Address: su@yopmail.com<br>Your Password: 123456</p><p><span style=\"font-size: 1rem;\">Link doesn&#039;t work? Copy the following link to your browser address bar:</span></p><p>https://infograins.in/INFO01/hrms/</p><p>Have fun!</p><p>The&nbsp;iLinkHR&nbsp;Team.</p></div>', '2018-05-08 06:11:07'),
(60, 66, 'receive', 'Welcome', 'joyti@yopmail.com', 'Welcome Email  - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"https://infograins.in/INFO01/hrms/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Hello&nbsp;joyti jain,</p><p>Welcome to&nbsp;iLinkHR&nbsp;.Thanks for joining&nbsp;iLinkHR. We listed your sign in details below, make sure you keep them safe.</p><p>Your Username: joyti</p><p>Your Employee ID: 001<br>Your Email Address: joyti@yopmail.com<br>Your Password: 123456</p><p><span style=\"font-size: 1rem;\">Link doesn&#039;t work? Copy the following link to your browser address bar:</span></p><p>https://infograins.in/INFO01/hrms/</p><p>Have fun!</p><p>The&nbsp;iLinkHR&nbsp;Team.</p></div>', '2018-05-09 05:41:25'),
(61, 67, 'receive', 'Welcome', 'vipin@ilinkhr.com', 'Welcome Email  - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"https://infograins.in/INFO01/hrms/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Hello&nbsp;vipin shukla,</p><p>Welcome to&nbsp;iLinkHR&nbsp;.Thanks for joining&nbsp;iLinkHR. We listed your sign in details below, make sure you keep them safe.</p><p>Your Username: vipin</p><p>Your Employee ID: ilinkhr001<br>Your Email Address: vipin@ilinkhr.com<br>Your Password: 123456</p><p><span style=\"font-size: 1rem;\">Link doesn&#039;t work? Copy the following link to your browser address bar:</span></p><p>https://infograins.in/INFO01/hrms/</p><p>Have fun!</p><p>The&nbsp;iLinkHR&nbsp;Team.</p></div>', '2018-05-09 06:22:34'),
(62, 68, 'receive', 'Welcome', 'shilpa@yopmail.com', 'Welcome Email  - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"https://infograins.in/INFO01/hrms/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Hello&nbsp;Shilpa agrawal,</p><p>Welcome to&nbsp;iLinkHR&nbsp;.Thanks for joining&nbsp;iLinkHR. We listed your sign in details below, make sure you keep them safe.</p><p>Your Username: shilpa</p><p>Your Employee ID: info003<br>Your Email Address: shilpa@yopmail.com<br>Your Password: 123456</p><p><span style=\"font-size: 1rem;\">Link doesn&#039;t work? Copy the following link to your browser address bar:</span></p><p>https://infograins.in/INFO01/hrms/</p><p>Have fun!</p><p>The&nbsp;iLinkHR&nbsp;Team.</p></div>', '2018-05-09 06:31:34'),
(63, 69, 'receive', 'Welcome', '`kripa@yopmail.com', 'Welcome Email  - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"https://infograins.in/INFO01/hrms/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Hello&nbsp;kripa singh,</p><p>Welcome to&nbsp;iLinkHR&nbsp;.Thanks for joining&nbsp;iLinkHR. We listed your sign in details below, make sure you keep them safe.</p><p>Your Username: kripa</p><p>Your Employee ID: ilinkhr004<br>Your Email Address: `kripa@yopmail.com<br>Your Password: 123456</p><p><span style=\"font-size: 1rem;\">Link doesn&#039;t work? Copy the following link to your browser address bar:</span></p><p>https://infograins.in/INFO01/hrms/</p><p>Have fun!</p><p>The&nbsp;iLinkHR&nbsp;Team.</p></div>', '2018-05-09 06:39:06'),
(64, 70, 'receive', 'Welcome', 'suraj@yopmail.com', 'Welcome Email  - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"https://infograins.in/INFO01/hrms/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Hello&nbsp;suraj giri,</p><p>Welcome to&nbsp;iLinkHR&nbsp;.Thanks for joining&nbsp;iLinkHR. We listed your sign in details below, make sure you keep them safe.</p><p>Your Username: suraj</p><p>Your Employee ID: ilinkhr005<br>Your Email Address: suraj@yopmail.com<br>Your Password: 123456</p><p><span style=\"font-size: 1rem;\">Link doesn&#039;t work? Copy the following link to your browser address bar:</span></p><p>https://infograins.in/INFO01/hrms/</p><p>Have fun!</p><p>The&nbsp;iLinkHR&nbsp;Team.</p></div>', '2018-05-09 06:41:47'),
(65, 71, 'receive', 'Welcome', 'krishna@yopmail.com', 'Welcome Email  - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"https://infograins.in/INFO01/hrms/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Hello&nbsp;krishna thakur,</p><p>Welcome to&nbsp;iLinkHR&nbsp;.Thanks for joining&nbsp;iLinkHR. We listed your sign in details below, make sure you keep them safe.</p><p>Your Username: krishna1</p><p>Your Employee ID: ilinkhr006<br>Your Email Address: krishna@yopmail.com<br>Your Password: 123456</p><p><span style=\"font-size: 1rem;\">Link doesn&#039;t work? Copy the following link to your browser address bar:</span></p><p>https://infograins.in/INFO01/hrms/</p><p>Have fun!</p><p>The&nbsp;iLinkHR&nbsp;Team.</p></div>', '2018-05-09 06:43:48'),
(66, 72, 'receive', 'Welcome', 'ritika@yopmail.com', 'Welcome Email  - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"https://infograins.in/INFO01/hrms/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Hello&nbsp;ritika jain,</p><p>Welcome to&nbsp;iLinkHR&nbsp;.Thanks for joining&nbsp;iLinkHR. We listed your sign in details below, make sure you keep them safe.</p><p>Your Username: ritika1</p><p>Your Employee ID: ilinkhr006<br>Your Email Address: ritika@yopmail.com<br>Your Password: 123456</p><p><span style=\"font-size: 1rem;\">Link doesn&#039;t work? Copy the following link to your browser address bar:</span></p><p>https://infograins.in/INFO01/hrms/</p><p>Have fun!</p><p>The&nbsp;iLinkHR&nbsp;Team.</p></div>', '2018-05-09 06:55:13');
INSERT INTO `hrms_email_history` (`history_id`, `employee_id`, `email_type`, `email_for`, `email_to`, `email_subject`, `email_message`, `send_date`) VALUES
(67, 72, 'receive', 'Task Assign', 'ritika@yopmail.com', 'Task assigned - iLinkHR', '<div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"><img src=\"https://infograins.in/INFO01/hrms/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Dear Employee,</p><p>A new task&nbsp;<span style=\"\\&quot;font-weight:\" bolder;\\\"=\"\">new point</span>&nbsp;has been assigned to you by&nbsp;<span style=\"\\&quot;font-weight:\" bolder;\\\"=\"\">krishna thakur</span>.</p><p>You can view this task by logging in to the portal using the link below.</p><p><span style=\"font-size: 1rem;\">Copy the following link to your browser address bar:</span></p><p>https://infograins.in/INFO01/hrms/</p><p>Regards,</p><p>The iLinkHR Team</p></div>', '2018-05-09 07:05:19'),
(68, 72, 'receive', 'Task Assign', 'ritika@yopmail.com', 'Task assigned - iLinkHR', '<div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"><img src=\"https://infograins.in/INFO01/hrms/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Dear Employee,</p><p>A new task&nbsp;<span style=\"\\&quot;font-weight:\" bolder;\\\"=\"\">wewqe</span>&nbsp;has been assigned to you by&nbsp;<span style=\"\\&quot;font-weight:\" bolder;\\\"=\"\">krishna thakur</span>.</p><p>You can view this task by logging in to the portal using the link below.</p><p><span style=\"font-size: 1rem;\">Copy the following link to your browser address bar:</span></p><p>https://infograins.in/INFO01/hrms/</p><p>Regards,</p><p>The iLinkHR Team</p></div>', '2018-05-09 07:05:43'),
(69, 64, 'receive', 'Task Assign', 'hemant@yopmail.com', 'Task assigned - iLinkHR', '<div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"><img src=\"https://infograins.in/INFO01/hrms/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Dear Employee,</p><p>A new task&nbsp;<span style=\"\\&quot;font-weight:\" bolder;\\\"=\"\">hrms</span>&nbsp;has been assigned to you by&nbsp;<span style=\"\\&quot;font-weight:\" bolder;\\\"=\"\">krishna thakur</span>.</p><p>You can view this task by logging in to the portal using the link below.</p><p><span style=\"font-size: 1rem;\">Copy the following link to your browser address bar:</span></p><p>https://infograins.in/INFO01/hrms/</p><p>Regards,</p><p>The iLinkHR Team</p></div>', '2018-05-09 09:29:05'),
(70, 72, 'receive', 'Task Assign', 'ritika@yopmail.com', 'Task assigned - iLinkHR', '<div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"><img src=\"https://infograins.in/INFO01/hrms/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Dear Employee,</p><p>A new task&nbsp;<span style=\"\\&quot;font-weight:\" bolder;\\\"=\"\">hrms</span>&nbsp;has been assigned to you by&nbsp;<span style=\"\\&quot;font-weight:\" bolder;\\\"=\"\">krishna thakur</span>.</p><p>You can view this task by logging in to the portal using the link below.</p><p><span style=\"font-size: 1rem;\">Copy the following link to your browser address bar:</span></p><p>https://infograins.in/INFO01/hrms/</p><p>Regards,</p><p>The iLinkHR Team</p></div>', '2018-05-09 09:29:05'),
(71, 62, 'send', 'Leave', 'info@ilinkhr.com', 'A Leave Request from you - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"https://infograins.in/INFO01/hrms/uploads/logo/logo_1513925940.png\" title=\"iLinkHR\"><br><p>Dear Admin,</p><p>Ajay patidar&nbsp;wants a leave from you.</p><p>You can view this leave request by logging in to the portal using the link below.</p><p>Regards</p><p>The iLinkHR Team</p></div>', '2018-05-10 18:17:07'),
(72, 62, 'send', 'Leave', 'info@ilinkhr.com', 'A Leave Request from you - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://18.191.152.224/our_products/hrms/uploads/logo/logo_1526224270.png\" title=\"iLinkHR\"><br><p>Dear Admin,</p><p>Ajay patidar&nbsp;wants a leave from you.</p><p>You can view this leave request by logging in to the portal using the link below.</p><p>Regards</p><p>The iLinkHR Team</p></div>', '2019-06-15 13:37:31'),
(73, 62, 'receive', 'Leave', 'ajay@infograins.com', 'Your leave request has been approved - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://18.191.152.224/our_products/hrms/uploads/logo/logo_1526224270.png\" title=\"iLinkHR\"><br><p>Your leave request has been approved</p><p><font color=\"\\&quot;#333333\\&quot;\" face=\"\\&quot;sans-serif,\" arial,=\"\" verdana,=\"\" trebuchet=\"\" ms\\\"=\"\">Congratulations!&nbsp;Your leave request from&nbsp;</font>16-Jun-2019&nbsp;to&nbsp;17-Jun-2019&nbsp;has been approved by your company management.</p><p></p><p>Regards<br>The iLinkHR Team</p></div>', '2019-06-15 13:41:45'),
(74, 82, 'receive', 'Award', 'rajptest@gmail.com', 'Award Received - iLinkHR', '<div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"><img src=\"http://18.191.152.224/our_products/hrms/uploads/logo/logo_1560750345.png\" title=\"iLinkHR\"><br><p>Hello&nbsp;G R,</p><p>You have been&nbsp;awarded&nbsp;Most Consistent Employee.</p><p>You can view this award by logging in to the portal using the link below.<br></p><p>Copy the following link to your browser address bar:</p><p>http://18.191.152.224/our_products/hrms/</p><p>Regards</p><p>The iLinkHR Team</p></div>', '2019-06-17 09:31:40'),
(75, 82, 'receive', 'Warning', 'rajptest@gmail.com', 'Warning : ssasa - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://18.191.152.224/our_products/hrms/uploads/logo/logo_1560750345.png\" title=\"iLinkHR\"><br><p>Dear Employee,</p><p>You have a new Verbal Warning by G R.</p><p><strong>Warning Message :-&nbsp;</strong></p><p>sasas aas</p><p>Regards,</p><p>The iLinkHR Team</p></div>', '2019-06-17 09:58:37'),
(76, 82, 'send', 'Leave', 'info@ilinkhr.com', 'A Leave Request from you - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://18.191.152.224/our_products/hrms/uploads/logo/logo_1560750345.png\" title=\"iLinkHR\"><br><p>Dear Admin,</p><p>G R&nbsp;wants a leave from you.</p><p>You can view this leave request by logging in to the portal using the link below.</p><p>Regards</p><p>The iLinkHR Team</p></div>', '2019-06-17 10:05:00'),
(77, 82, 'receive', 'Leave', 'rajptest@gmail.com', 'Your leave request has been Rejected - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://18.191.152.224/our_products/hrms/uploads/logo/logo_1560750345.png\" title=\"iLinkHR\"><br><p>Your leave request has been Rejected</p><p>Unfortunately !&nbsp;Your leave request from&nbsp;17-Jun-2019&nbsp;to&nbsp;19-Jun-2019&nbsp;has been Rejected by your company management.</p><p></p><p>Regards</p><p>The iLinkHR Team</p></div>', '2019-06-17 10:05:18'),
(78, 82, 'receive', 'Leave', 'rajptest@gmail.com', 'Your leave request has been Rejected - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://18.191.152.224/our_products/hrms/uploads/logo/logo_1560750345.png\" title=\"iLinkHR\"><br><p>Your leave request has been Rejected</p><p>Unfortunately !&nbsp;Your leave request from&nbsp;17-Jun-2019&nbsp;to&nbsp;19-Jun-2019&nbsp;has been Rejected by your company management.</p><p></p><p>Regards</p><p>The iLinkHR Team</p></div>', '2019-06-17 10:05:26'),
(79, 82, 'receive', 'Task Assign', 'rajptest@gmail.com', 'Task assigned - iLinkHR', '<div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"><img src=\"http://18.191.152.224/our_products/hrms/uploads/logo/logo_1560750345.png\" title=\"iLinkHR\"><br><p>Dear Employee,</p><p>A new task&nbsp;<span style=\"\\&quot;font-weight:\" bolder;\\\"=\"\">QA </span>&nbsp;has been assigned to you by&nbsp;<span style=\"\\&quot;font-weight:\" bolder;\\\"=\"\">G R</span>.</p><p>You can view this task by logging in to the portal using the link below.</p><p><span style=\"font-size: 1rem;\">Copy the following link to your browser address bar:</span></p><p>http://18.191.152.224/our_products/hrms/</p><p>Regards,</p><p>The iLinkHR Team</p></div>', '2019-06-17 10:19:26'),
(80, 62, 'send', 'Leave', 'info@ilinkhr.com', 'A Leave Request from you - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://18.191.152.224/our_products/hrms/uploads/logo/logo_1560750345.png\" title=\"iLinkHR\"><br><p>Dear Admin,</p><p>Ajay patidar&nbsp;wants a leave from you.</p><p>You can view this leave request by logging in to the portal using the link below.</p><p>Regards</p><p>The iLinkHR Team</p></div>', '2019-06-17 10:24:14'),
(81, 62, 'receive', 'Leave', 'ajay@infograins.com', 'Your leave request has been approved - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://18.191.152.224/our_products/hrms/uploads/logo/logo_1560750345.png\" title=\"iLinkHR\"><br><p>Your leave request has been approved</p><p><font color=\"\\&quot;#333333\\&quot;\" face=\"\\&quot;sans-serif,\" arial,=\"\" verdana,=\"\" trebuchet=\"\" ms\\\"=\"\">Congratulations!&nbsp;Your leave request from&nbsp;</font>17-Jun-2019&nbsp;to&nbsp;30-Jun-2019&nbsp;has been approved by your company management.</p><p></p><p>Regards<br>The iLinkHR Team</p></div>', '2019-06-17 10:28:40'),
(82, 62, 'receive', 'Leave', 'ajay@infograins.com', 'Your leave request has been Rejected - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://18.191.152.224/our_products/hrms/uploads/logo/logo_1560750345.png\" title=\"iLinkHR\"><br><p>Your leave request has been Rejected</p><p>Unfortunately !&nbsp;Your leave request from&nbsp;17-Jun-2019&nbsp;to&nbsp;30-Jun-2019&nbsp;has been Rejected by your company management.</p><p></p><p>Regards</p><p>The iLinkHR Team</p></div>', '2019-06-17 10:29:28'),
(83, 62, 'receive', 'Task Assign', 'ajay@infograins.com', 'Task assigned - iLinkHR', '<div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"><img src=\"http://18.191.152.224/our_products/hrms/uploads/logo/logo_1560750345.png\" title=\"iLinkHR\"><br><p>Dear Employee,</p><p>A new task&nbsp;<span style=\"\\&quot;font-weight:\" bolder;\\\"=\"\">Ada</span>&nbsp;has been assigned to you by&nbsp;<span style=\"\\&quot;font-weight:\" bolder;\\\"=\"\">info com</span>.</p><p>You can view this task by logging in to the portal using the link below.</p><p><span style=\"font-size: 1rem;\">Copy the following link to your browser address bar:</span></p><p>http://18.191.152.224/our_products/hrms/</p><p>Regards,</p><p>The iLinkHR Team</p></div>', '2019-06-17 10:42:22'),
(84, 62, 'send', 'Leave', 'info@ilinkhr.com', 'A Leave Request from you - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://myhrms.org/hr/uploads/logo/logo_1560750345.png\" title=\"iLinkHR\"><br><p>Dear Admin,</p><p>Ajay patidar&nbsp;wants a leave from you.</p><p>You can view this leave request by logging in to the portal using the link below.</p><p>Regards</p><p>The iLinkHR Team</p></div>', '2019-07-17 10:31:52'),
(85, 60, 'receive', 'Warning', 'ajayIn@infograins.com', 'Warning : Mobile usage - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://myhrms.org/hr/uploads/logo/logo_1560750345.png\" title=\"iLinkHR\"><br><p>Dear Employee,</p><p>You have a new Verbal Warning by pawan paliwal.</p><p><strong>Warning Message :-&nbsp;</strong></p><p>dgassf agd gsf asglsg SG SGA</p><p>Regards,</p><p>The iLinkHR Team</p></div>', '2019-07-17 11:06:13'),
(86, 62, 'send', 'Leave', 'info@ilinkhr.com', 'A Leave Request from you - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://myhrms.org/hr/uploads/logo/logo_1560750345.png\" title=\"iLinkHR\"><br><p>Dear Admin,</p><p>Ajay patidar&nbsp;wants a leave from you.</p><p>You can view this leave request by logging in to the portal using the link below.</p><p>Regards</p><p>The iLinkHR Team</p></div>', '2019-07-17 11:21:58'),
(87, 62, 'send', 'Leave', 'info@ilinkhr.com', 'A Leave Request from you - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://myhrms.org/hr/uploads/logo/logo_1560750345.png\" title=\"iLinkHR\"><br><p>Dear Admin,</p><p>Ajay patidar&nbsp;wants a leave from you.</p><p>You can view this leave request by logging in to the portal using the link below.</p><p>Regards</p><p>The iLinkHR Team</p></div>', '2020-10-29 05:49:31'),
(88, 60, 'receive', 'Award', 'ajayIn@infograins.com', 'Award Received - iLinkHR', '<div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"><img src=\"http://myhrms.org/hr/uploads/logo/logo_1560750345.png\" title=\"iLinkHR\"><br><p>Hello&nbsp;Ajay sukla,</p><p>You have been&nbsp;awarded&nbsp;Most Consistent Employee.</p><p>You can view this award by logging in to the portal using the link below.<br></p><p>Copy the following link to your browser address bar:</p><p>http://myhrms.org/hr/</p><p>Regards</p><p>The iLinkHR Team</p></div>', '2020-11-09 06:15:55'),
(89, 60, 'receive', 'Task Assign', 'ajayIn@infograins.com', 'Task assigned - iLinkHR', '<div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"><img src=\"http://myhrms.org/hr/uploads/logo/logo_1560750345.png\" title=\"iLinkHR\"><br><p>Dear Employee,</p><p>A new task&nbsp;<span style=\"\\&quot;font-weight:\" bolder;\\\"=\"\">dfds</span>&nbsp;has been assigned to you by&nbsp;<span style=\"\\&quot;font-weight:\" bolder;\\\"=\"\">info com</span>.</p><p>You can view this task by logging in to the portal using the link below.</p><p><span style=\"font-size: 1rem;\">Copy the following link to your browser address bar:</span></p><p>http://myhrms.org/hr/</p><p>Regards,</p><p>The iLinkHR Team</p></div>', '2020-11-09 06:31:07'),
(90, 61, 'receive', 'Task Assign', 'pawan@inf.com', 'Task assigned - iLinkHR', '<div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"><img src=\"http://myhrms.org/hr/uploads/logo/logo_1560750345.png\" title=\"iLinkHR\"><br><p>Dear Employee,</p><p>A new task&nbsp;<span style=\"\\&quot;font-weight:\" bolder;\\\"=\"\">dfds</span>&nbsp;has been assigned to you by&nbsp;<span style=\"\\&quot;font-weight:\" bolder;\\\"=\"\">info com</span>.</p><p>You can view this task by logging in to the portal using the link below.</p><p><span style=\"font-size: 1rem;\">Copy the following link to your browser address bar:</span></p><p>http://myhrms.org/hr/</p><p>Regards,</p><p>The iLinkHR Team</p></div>', '2020-11-09 06:31:07'),
(91, 59, 'send', 'Leave', 'info@ilinkhr.com', 'A Leave Request from you - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://myhrms.org/hr/uploads/logo/logo_1560750345.png\" title=\"iLinkHR\"><br><p>Dear Admin,</p><p>info com&nbsp;wants a leave from you.</p><p>You can view this leave request by logging in to the portal using the link below.</p><p>Regards</p><p>The iLinkHR Team</p></div>', '2020-11-09 06:34:55'),
(92, 113, 'receive', 'Welcome', 'neetesha@yopmail.com', 'Welcome Email  - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://myhrms.org/hr/uploads/logo/logo_1560750345.png\" title=\"iLinkHR\"><br><p>Hello&nbsp;neeteshagr agrawalagra,</p><p>Welcome to&nbsp;iLinkHR&nbsp;.Thanks for joining&nbsp;iLinkHR. We listed your sign in details below, make sure you keep them safe.</p><p>Your Username: IT-5</p><p>Your Employee ID: 12323141<br>Your Email Address: neetesha@yopmail.com<br>Your Password: 123456</p><p><span style=\"font-size: 1rem;\">Link doesn&#039;t work? Copy the following link to your browser address bar:</span></p><p>http://myhrms.org/hr/</p><p>Have fun!</p><p>The&nbsp;iLinkHR&nbsp;Team.</p></div>', '2020-11-09 07:44:59'),
(93, 115, 'receive', 'Welcome', 'neetesha@yopmail.com', 'Welcome Email  - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://myhrms.org/hr/uploads/logo/logo_1560750345.png\" title=\"iLinkHR\"><br><p>Hello&nbsp;neeteshagr agrawalagra,</p><p>Welcome to&nbsp;iLinkHR&nbsp;.Thanks for joining&nbsp;iLinkHR. We listed your sign in details below, make sure you keep them safe.</p><p>Your Username: IT-7</p><p>Your Employee ID: 12323141<br>Your Email Address: neetesha@yopmail.com<br>Your Password: 123456</p><p><span style=\"font-size: 1rem;\">Link doesn&#039;t work? Copy the following link to your browser address bar:</span></p><p>http://myhrms.org/hr/</p><p>Have fun!</p><p>The&nbsp;iLinkHR&nbsp;Team.</p></div>', '2020-11-09 07:51:35'),
(94, 116, 'receive', 'Welcome', 'rj@yopmail.com', 'Welcome Email  - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://myhrms.org/hr/uploads/logo/logo_1560750345.png\" title=\"iLinkHR\"><br><p>Hello&nbsp;test rj,</p><p>Welcome to&nbsp;iLinkHR&nbsp;.Thanks for joining&nbsp;iLinkHR. We listed your sign in details below, make sure you keep them safe.</p><p>Your Username: dscsf</p><p>Your Employee ID: ddfdf<br>Your Email Address: rj@yopmail.com<br>Your Password: 123456789</p><p><span style=\"font-size: 1rem;\">Link doesn&#039;t work? Copy the following link to your browser address bar:</span></p><p>http://myhrms.org/hr/</p><p>Have fun!</p><p>The&nbsp;iLinkHR&nbsp;Team.</p></div>', '2020-11-09 10:18:46'),
(95, 122, 'receive', 'Welcome', 'neetesha@yopmail.com', 'Welcome Email  - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://myhrms.org/hr/uploads/logo/logo_1560750345.png\" title=\"iLinkHR\"><br><p>Hello&nbsp;SFSDFSF FSDFSFS,</p><p>Welcome to&nbsp;iLinkHR&nbsp;.Thanks for joining&nbsp;iLinkHR. We listed your sign in details below, make sure you keep them safe.</p><p>Your Username: FDSFS</p><p>Your Employee ID: 43424<br>Your Email Address: neetesha@yopmail.com<br>Your Password: 123456</p><p><span style=\"font-size: 1rem;\">Link doesn&#039;t work? Copy the following link to your browser address bar:</span></p><p>http://myhrms.org/hr/</p><p>Have fun!</p><p>The&nbsp;iLinkHR&nbsp;Team.</p></div>', '2020-11-12 08:17:56'),
(96, 123, 'receive', 'Welcome', 'kaifi.azad@gmail.com', 'Welcome Email  - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://myhrms.org/hr/uploads/logo/logo_1560750345.png\" title=\"iLinkHR\"><br><p>Hello&nbsp;rahul jain,</p><p>Welcome to&nbsp;iLinkHR&nbsp;.Thanks for joining&nbsp;iLinkHR. We listed your sign in details below, make sure you keep them safe.</p><p>Your Username: rahuljn</p><p>Your Employee ID: 123<br>Your Email Address: kaifi.azad@gmail.com<br>Your Password: 123456</p><p><span style=\"font-size: 1rem;\">Link doesn&#039;t work? Copy the following link to your browser address bar:</span></p><p>http://myhrms.org/hr/</p><p>Have fun!</p><p>The&nbsp;iLinkHR&nbsp;Team.</p></div>', '2020-11-12 08:18:57'),
(97, 123, 'receive', 'Task Assign', 'kaifi.azad@gmail.com', 'Task assigned - iLinkHR', '<div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"><img src=\"http://myhrms.org/hr/uploads/logo/logo_1560750345.png\" title=\"iLinkHR\"><br><p>Dear Employee,</p><p>A new task&nbsp;<span style=\"\\&quot;font-weight:\" bolder;\\\"=\"\">newtask</span>&nbsp;has been assigned to you by&nbsp;<span style=\"\\&quot;font-weight:\" bolder;\\\"=\"\">info com</span>.</p><p>You can view this task by logging in to the portal using the link below.</p><p><span style=\"font-size: 1rem;\">Copy the following link to your browser address bar:</span></p><p>http://myhrms.org/hr/</p><p>Regards,</p><p>The iLinkHR Team</p></div>', '2020-11-12 08:25:28'),
(98, 123, 'receive', 'Award', 'kaifi.azad@gmail.com', 'Award Received - iLinkHR', '<div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"><img src=\"http://myhrms.org/hr/uploads/logo/logo_1560750345.png\" title=\"iLinkHR\"><br><p>Hello&nbsp;rahul jain,</p><p>You have been&nbsp;awarded&nbsp;Certificate of Excellence.</p><p>You can view this award by logging in to the portal using the link below.<br></p><p>Copy the following link to your browser address bar:</p><p>http://myhrms.org/hr/</p><p>Regards</p><p>The iLinkHR Team</p></div>', '2020-11-13 07:09:34'),
(99, 116, 'receive', 'Award', 'rj@yopmail.com', 'Award Received - iLinkHR', '<div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"><img src=\"http://myhrms.org/hr/uploads/logo/logo_1560750345.png\" title=\"iLinkHR\"><br><p>Hello&nbsp;test rj,</p><p>You have been&nbsp;awarded&nbsp;Employee of the Year.</p><p>You can view this award by logging in to the portal using the link below.<br></p><p>Copy the following link to your browser address bar:</p><p>http://myhrms.org/hr/</p><p>Regards</p><p>The iLinkHR Team</p></div>', '2020-11-13 07:11:39'),
(100, 60, 'receive', 'Warning', 'ajayIn@infograins.com', 'Warning : sadas - iLinkHR', ' <div style=\"background:#f6f6f6;font-family:Verdana,Arial, Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;\"> <img src=\"http://myhrms.org/hr/uploads/logo/logo_1560750345.png\" title=\"iLinkHR\"><br><p>Dear Employee,</p><p>You have a new First Written Warning by test rj.</p><p><strong>Warning Message :-&nbsp;</strong></p><p>tfydyrdyrdtrdrtd</p><p>Regards,</p><p>The iLinkHR Team</p></div>', '2020-12-12 08:24:54');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_email_template`
--

CREATE TABLE `hrms_email_template` (
  `template_id` int(111) NOT NULL,
  `template_code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_email_template`
--

INSERT INTO `hrms_email_template` (`template_id`, `template_code`, `name`, `subject`, `message`, `status`) VALUES
(1, 'test', 'Payslip generated', 'Payslip generated', '&lt;p&gt;Hello&amp;nbsp;{var employee_name},&lt;/p&gt;&lt;p&gt;Your payslip generated for the month of {var payslip_date}.&lt;/p&gt;&lt;p&gt;Regards&lt;/p&gt;&lt;p&gt;The&amp;nbsp;{var site_name}&amp;nbsp;Team&lt;/p&gt;', 1),
(2, 'test2', 'Forgot Password', 'Forgot Password', '&lt;p&gt;There was recently a request for password for your &amp;nbsp;{var site_name}&amp;nbsp;account.&lt;/p&gt;&lt;p&gt;Please, keep it in your records so you don\\&#039;t forget it.&lt;/p&gt;&lt;p&gt;Your username: {var username}&lt;br&gt;Your email address: {var email}&lt;br&gt;Your password: {var password}&lt;/p&gt;&lt;p&gt;Thank you,&lt;br&gt;The {var site_name} Team&lt;/p&gt;', 1),
(3, '', 'New Project', 'New Project', '&lt;p&gt;Dear {var name},&lt;/p&gt;&lt;p&gt;New project has been assigned to you.&lt;/p&gt;&lt;p&gt;Project Name: {var project_name}&lt;/p&gt;&lt;p&gt;Project Start Date:&amp;nbsp;&lt;span 1rem;\\\\\\&quot;=\\&quot;\\&quot;&gt;{var project_start_date}&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span 1rem;\\\\\\&quot;=\\&quot;\\&quot;&gt;Thank you,&lt;/span&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;The {var site_name} Team&lt;/p&gt;', 1),
(4, '', 'Announcement', 'New Announcement', '&lt;p&gt;Dear &amp;nbsp;User,&lt;/p&gt;&lt;p&gt;New&amp;nbsp;Announcement has been published by admin,&amp;nbsp;please click on below link:&lt;/p&gt;&lt;p&gt;&lt;span style=\\&quot;font-size: 1rem;\\&quot;&gt;Copy the following link to your browser address bar:&lt;/span&gt;&lt;/p&gt;&lt;p&gt;{var site_url}&lt;/p&gt;&lt;p&gt;Have fun!&lt;br&gt;The {var site_name} Team&lt;/p&gt;', 1),
(5, '', 'Leave Request ', 'A Leave Request from you', '&lt;p&gt;Dear Admin,&lt;/p&gt;&lt;p&gt;{var employee_name}&amp;nbsp;wants a leave from you.&lt;/p&gt;&lt;p&gt;You can view this leave request by logging in to the portal using the link below.&lt;/p&gt;&lt;p&gt;Regards&lt;/p&gt;&lt;p&gt;The {var site_name} Team&lt;/p&gt;', 1),
(6, '', 'Leave Approve', 'Your leave request has been approved', '&lt;p&gt;Your leave request has been approved&lt;/p&gt;&lt;p&gt;&lt;font color=\\&quot;\\\\&amp;quot;#333333\\\\&amp;quot;\\&quot; face=\\&quot;\\\\&amp;quot;sans-serif,\\&quot; arial,=\\&quot;\\&quot; verdana,=\\&quot;\\&quot; trebuchet=\\&quot;\\&quot; ms\\\\\\&quot;=\\&quot;\\&quot;&gt;Congratulations!&amp;nbsp;Your leave request from&amp;nbsp;&lt;/font&gt;{var leave_start_date}&amp;nbsp;to&amp;nbsp;{var leave_end_date}&amp;nbsp;has been approved by your company management.&lt;/p&gt;&lt;p&gt;{reason}&lt;/p&gt;&lt;p&gt;Regards&lt;br&gt;The {var site_name} Team&lt;/p&gt;', 1),
(7, '', 'Leave Reject', 'Your leave request has been Rejected', '&lt;p&gt;Your leave request has been Rejected&lt;/p&gt;&lt;p&gt;Unfortunately !&amp;nbsp;Your leave request from&amp;nbsp;{var leave_start_date}&amp;nbsp;to&amp;nbsp;{var leave_end_date}&amp;nbsp;has been Rejected by your company management.&lt;/p&gt;&lt;p&gt;{reason}&lt;/p&gt;&lt;p&gt;Regards&lt;/p&gt;&lt;p&gt;The {var site_name} Team&lt;/p&gt;', 1),
(8, '', 'Welcome Email ', 'Welcome Email ', '&lt;p&gt;Hello&amp;nbsp;{var employee_name},&lt;/p&gt;&lt;p&gt;Welcome to&amp;nbsp;{var site_name}&amp;nbsp;.Thanks for joining&amp;nbsp;{var site_name}. We listed your sign in details below, make sure you keep them safe.&lt;/p&gt;&lt;p&gt;Your Username: {var username}&lt;/p&gt;&lt;p&gt;Your Employee ID: {var employee_id}&lt;br&gt;Your Email Address: {var email}&lt;br&gt;Your Password: {var password}&lt;/p&gt;&lt;p&gt;&lt;span style=\\&quot;font-size: 1rem;\\&quot;&gt;Link doesn\\&#039;t work? Copy the following link to your browser address bar:&lt;/span&gt;&lt;/p&gt;&lt;p&gt;{var site_url}&lt;/p&gt;&lt;p&gt;Have fun!&lt;/p&gt;&lt;p&gt;The&amp;nbsp;{var site_name}&amp;nbsp;Team.&lt;/p&gt;', 1),
(9, '', 'Transfer', 'New Transfer', '&lt;p&gt;Hello&amp;nbsp;{var employee_name},&lt;/p&gt;&lt;p&gt;You have been&amp;nbsp;transfered to another department and location.&lt;/p&gt;&lt;p&gt;You can view the transfer details by logging in to the portal using the link below.&lt;/p&gt;&lt;p&gt;&lt;span style=\\&quot;font-size: 1rem;\\&quot;&gt;&amp;nbsp;Copy the following link to your browser address bar:&lt;/span&gt;&lt;/p&gt;&lt;p&gt;{var site_url}&lt;/p&gt;&lt;p&gt;Regards&lt;/p&gt;&lt;p&gt;The {var site_name} Team&lt;/p&gt;', 1),
(10, '', 'Award', 'Award Received', '&lt;p&gt;Hello&amp;nbsp;{var employee_name},&lt;/p&gt;&lt;p&gt;You have been&amp;nbsp;awarded&amp;nbsp;{var award_name}.&lt;/p&gt;&lt;p&gt;You can view this award by logging in to the portal using the link below.&lt;br&gt;&lt;/p&gt;&lt;p&gt;Copy the following link to your browser address bar:&lt;/p&gt;&lt;p&gt;{var site_url}&lt;/p&gt;&lt;p&gt;Regards&lt;/p&gt;&lt;p&gt;The {var site_name} Team&lt;/p&gt;', 1),
(11, '', 'New job application', 'New job application submitted', '&lt;p style=\\&quot;\\\\&amp;quot;color:\\&quot; rgb(51,=\\&quot;\\&quot; 51,=\\&quot;\\&quot; 51);=\\&quot;\\&quot; font-family:=\\&quot;\\&quot; sans-serif,=\\&quot;\\&quot; arial,=\\&quot;\\&quot; verdana,=\\&quot;\\&quot; &amp;quot;trebuchet=\\&quot;\\&quot; ms&amp;quot;;\\\\\\&quot;=\\&quot;\\&quot;&gt;Hi,&lt;/p&gt;&lt;p style=\\&quot;\\\\&amp;quot;color:\\&quot; rgb(51,=\\&quot;\\&quot; 51,=\\&quot;\\&quot; 51);=\\&quot;\\&quot; font-family:=\\&quot;\\&quot; sans-serif,=\\&quot;\\&quot; arial,=\\&quot;\\&quot; verdana,=\\&quot;\\&quot; &amp;quot;trebuchet=\\&quot;\\&quot; ms&amp;quot;;\\\\\\&quot;=\\&quot;\\&quot;&gt;&lt;strong&gt;{var employee_name}&amp;nbsp;&lt;/strong&gt;has submitted the job application for&amp;nbsp;&lt;span style=\\&quot;\\\\&amp;quot;font-weight:\\&quot; bolder;=\\&quot;\\&quot; font-size:=\\&quot;\\&quot; 1rem;\\\\\\&quot;=\\&quot;\\&quot;&gt;{var job_title}&lt;/span&gt;&lt;/p&gt;&lt;p style=\\&quot;\\\\&amp;quot;color:\\&quot; rgb(51,=\\&quot;\\&quot; 51,=\\&quot;\\&quot; 51);=\\&quot;\\&quot; font-family:=\\&quot;\\&quot; sans-serif,=\\&quot;\\&quot; arial,=\\&quot;\\&quot; verdana,=\\&quot;\\&quot; &amp;quot;trebuchet=\\&quot;\\&quot; ms&amp;quot;;\\\\\\&quot;=\\&quot;\\&quot;&gt;Best Regards,&lt;/p&gt;&lt;p style=\\&quot;\\\\&amp;quot;color:\\&quot; rgb(51,=\\&quot;\\&quot; 51,=\\&quot;\\&quot; 51);=\\&quot;\\&quot; font-family:=\\&quot;\\&quot; sans-serif,=\\&quot;\\&quot; arial,=\\&quot;\\&quot; verdana,=\\&quot;\\&quot; &amp;quot;trebuchet=\\&quot;\\&quot; ms&amp;quot;;\\\\\\&quot;=\\&quot;\\&quot;&gt;The {var site_name} Team&lt;/p&gt;', 1),
(12, '', 'Resignation', 'Resignation Notice', '&lt;p&gt;Hello&amp;nbsp;{var employee_name},&lt;/p&gt;&lt;p&gt;Resignation Notice has been sent to you.&lt;/p&gt;&lt;p&gt;You can view the notice details by logging in to the portal using the link below.&lt;/p&gt;&lt;p&gt;&lt;span style=\\&quot;font-size: 1rem;\\&quot;&gt;Copy the following link to your browser address bar:&lt;/span&gt;&lt;/p&gt;&lt;p&gt;{var site_url}&lt;/p&gt;&lt;p&gt;Regards&lt;/p&gt;&lt;p&gt;The {var site_name} Team&lt;/p&gt;', 1),
(13, '', 'New Training', 'Training  Assigned ', '&lt;p style=\\&quot;color: rgb(51, 51, 51); font-family: sans-serif, Arial, Verdana, &amp;quot;Trebuchet MS&amp;quot;;\\&quot;&gt;Dear Employee,&lt;/p&gt;&lt;p style=\\&quot;color: rgb(51, 51, 51); font-family: sans-serif, Arial, Verdana, &amp;quot;Trebuchet MS&amp;quot;;\\&quot;&gt;A new Training &amp;nbsp;&lt;strong&gt;{var training_name}&lt;/strong&gt;&amp;nbsp;&amp;nbsp;has been assigned to you.&lt;/p&gt;&lt;p style=\\&quot;color: rgb(51, 51, 51); font-family: sans-serif, Arial, Verdana, &amp;quot;Trebuchet MS&amp;quot;;\\&quot;&gt;You can view this Training by logging in to the portal using the link below.&lt;/p&gt;&lt;p style=\\&quot;\\&quot;&gt;&lt;span style=\\&quot;font-size: 1rem;\\&quot;&gt;Copy the following link to your browser address bar:&lt;/span&gt;&lt;/p&gt;&lt;p&gt;{var site_url}&lt;/p&gt;&lt;p style=\\&quot;color: rgb(51, 51, 51); font-family: sans-serif, Arial, Verdana, &amp;quot;Trebuchet MS&amp;quot;;\\&quot;&gt;&lt;span style=\\&quot;font-size: 1rem;\\&quot;&gt;Regards&lt;/span&gt;&lt;/p&gt;&lt;p style=\\&quot;color: rgb(51, 51, 51); font-family: sans-serif, Arial, Verdana, &amp;quot;Trebuchet MS&amp;quot;;\\&quot;&gt;&lt;span style=\\&quot;font-size: 1rem;\\&quot;&gt;The {var site_name} Team&lt;/span&gt;&lt;/p&gt;', 1),
(14, '', 'New Task', 'Task assigned', '&lt;p&gt;Dear Employee,&lt;/p&gt;&lt;p&gt;A new task&amp;nbsp;&lt;span style=\\&quot;\\\\&amp;quot;font-weight:\\&quot; bolder;\\\\\\&quot;=\\&quot;\\&quot;&gt;{var task_name}&lt;/span&gt;&amp;nbsp;has been assigned to you by&amp;nbsp;&lt;span style=\\&quot;\\\\&amp;quot;font-weight:\\&quot; bolder;\\\\\\&quot;=\\&quot;\\&quot;&gt;{var task_assigned_by}&lt;/span&gt;.&lt;/p&gt;&lt;p&gt;You can view this task by logging in to the portal using the link below.&lt;/p&gt;&lt;p&gt;&lt;span style=\\&quot;font-size: 1rem;\\&quot;&gt;Copy the following link to your browser address bar:&lt;/span&gt;&lt;/p&gt;&lt;p&gt;{var site_url}&lt;/p&gt;&lt;p&gt;Regards,&lt;/p&gt;&lt;p&gt;The {var site_name} Team&lt;/p&gt;', 1),
(15, '', 'New Ticket', 'New Ticket [#{var ticket_code}]', '&lt;p style=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\&amp;quot;color:\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; rgb(51,=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; 51,=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; 51);=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; font-family:=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; sans-serif,=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; arial,=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; verdana,=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; &amp;quot;trebuchet=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; ms&amp;quot;;\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\&quot;=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot;&gt;&lt;span style=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\&amp;quot;font-size:\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; 1rem;\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\&quot;=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot;&gt;Dear Admin,&lt;/span&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\&amp;quot;color:\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; rgb(51,=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; 51,=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; 51);=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; font-family:=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; sans-serif,=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; arial,=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; verdana,=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; &amp;quot;trebuchet=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; ms&amp;quot;;\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\&quot;=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot;&gt;&lt;span style=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\&amp;quot;font-size:\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; 1rem;\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\&quot;=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot;&gt;Your received a new ticket.&lt;/span&gt;&lt;/p&gt;&lt;p style=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\&amp;quot;color:\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; rgb(51,=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; 51,=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; 51);=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; font-family:=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; sans-serif,=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; arial,=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; verdana,=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; &amp;quot;trebuchet=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; ms&amp;quot;;\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\&quot;=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot;&gt;&lt;span style=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\&amp;quot;font-size:\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; 1rem;\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\&quot;=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot;&gt;Ticket Code: #{var ticket_code}&lt;/span&gt;&lt;/p&gt;&lt;p style=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\&amp;quot;color:\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; rgb(51,=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; 51,=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; 51);=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; font-family:=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; sans-serif,=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; arial,=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; verdana,=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; &amp;quot;trebuchet=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; ms&amp;quot;;\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\&quot;=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot;&gt;Status : Open&lt;/p&gt;&lt;p style=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\&amp;quot;color:\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; rgb(51,=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; 51,=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; 51);=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; font-family:=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; sans-serif,=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; arial,=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; verdana,=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; &amp;quot;trebuchet=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; ms&amp;quot;;\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\&quot;=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot;&gt;&lt;span style=\\&quot;font-size: 1rem;\\&quot;&gt;Regards&lt;/span&gt;&lt;/p&gt;&lt;p style=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\&amp;quot;color:\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; rgb(51,=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; 51,=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; 51);=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; font-family:=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; sans-serif,=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; arial,=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; verdana,=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; &amp;quot;trebuchet=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; ms&amp;quot;;\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\&quot;=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot;&gt;The {var site_name} Team&lt;/p&gt;', 1),
(16, '', 'Warning', 'Warning', '&lt;p&gt;Dear Employee,&lt;/p&gt;&lt;p&gt;You have a new {var warning_type} by {var warning_by}.&lt;/p&gt;&lt;p&gt;&lt;strong&gt;Warning Message :-&amp;nbsp;&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;{var warning_message}&lt;/p&gt;&lt;p&gt;Regards,&lt;/p&gt;&lt;p&gt;The {var site_name} Team&lt;/p&gt;', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hrms_employees`
--

CREATE TABLE `hrms_employees` (
  `check_change_password` int(11) NOT NULL DEFAULT '0' COMMENT '1=first_changed,0=not changed',
  `company_name` varchar(255) DEFAULT NULL,
  `manager_id` int(11) DEFAULT NULL,
  `mobile_no` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `level` varchar(255) DEFAULT NULL,
  `employee_id` varchar(200) NOT NULL,
  `office_shift_id` int(111) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `email_two` varchar(150) DEFAULT NULL,
  `password` varchar(200) NOT NULL,
  `confirm_password` varchar(255) NOT NULL,
  `date_of_birth` varchar(200) NOT NULL,
  `city_of_birth` varchar(150) DEFAULT NULL,
  `country_of_birth` varchar(100) DEFAULT NULL,
  `gender` varchar(200) NOT NULL,
  `user_role_id` int(100) NOT NULL,
  `department_id` int(100) NOT NULL,
  `designation_id` int(100) NOT NULL,
  `head_designation` int(11) NOT NULL DEFAULT '0',
  `head_employee` int(11) DEFAULT '0',
  `company_id` int(111) DEFAULT '0',
  `role` varchar(255) DEFAULT NULL,
  `empType` varchar(255) NOT NULL COMMENT 'forgen key of hrms_emplyee_type',
  `division` int(11) NOT NULL,
  `default_task` varchar(255) NOT NULL,
  `accounting_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1=Active , 0=Inactive''',
  `assign_to` varchar(255) DEFAULT NULL,
  `notes` varchar(255) NOT NULL,
  `salary_template` varchar(255) NOT NULL,
  `hourly_grade_id` int(111) NOT NULL,
  `monthly_grade_id` int(111) NOT NULL,
  `date_of_joining` varchar(200) NOT NULL,
  `date_of_leaving` varchar(255) NOT NULL,
  `marital_status` varchar(255) NOT NULL COMMENT '1=married,2=unmarried,3=devorce',
  `spouse_name` varchar(50) DEFAULT NULL,
  `spouse_dob` varchar(100) DEFAULT NULL,
  `marrige_anniversery_date` varchar(100) DEFAULT NULL,
  `children` varchar(100) DEFAULT NULL,
  `salary` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `address_two` text,
  `profile_picture` text NOT NULL,
  `profile_background` text NOT NULL,
  `wpn` varchar(150) DEFAULT NULL COMMENT 'work permit number',
  `wpn_issuedate` varchar(150) DEFAULT NULL,
  `wpn_expirydate` varchar(150) DEFAULT NULL,
  `passport_number` varchar(150) DEFAULT NULL,
  `passport_issuedate` varchar(150) DEFAULT NULL,
  `passsport_expirydate` varchar(100) DEFAULT NULL,
  `nsn` varchar(100) DEFAULT NULL,
  `visa_number` varchar(50) DEFAULT NULL,
  `visa_issuedate` varchar(100) DEFAULT NULL,
  `visa_expirydate` varchar(100) DEFAULT NULL,
  `emergency_contact_name` varchar(50) DEFAULT NULL,
  `emergency_contact_number` varchar(50) DEFAULT NULL,
  `emergency_contact_relation` varchar(50) DEFAULT NULL,
  `emergency_contact_email` varchar(100) DEFAULT NULL,
  `resume` text NOT NULL,
  `skype_id` varchar(200) NOT NULL,
  `contact_no` varchar(200) NOT NULL,
  `telephone` varchar(50) DEFAULT NULL,
  `facebook_link` text NOT NULL,
  `twitter_link` text NOT NULL,
  `blogger_link` text NOT NULL,
  `linkdedin_link` text NOT NULL,
  `google_plus_link` text NOT NULL,
  `instagram_link` varchar(255) NOT NULL,
  `pinterest_link` varchar(255) NOT NULL,
  `youtube_link` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL COMMENT '1=active,2=not active',
  `last_login_date` varchar(255) NOT NULL,
  `last_logout_date` varchar(255) NOT NULL,
  `last_login_ip` varchar(255) NOT NULL,
  `device_id` varchar(50) DEFAULT NULL,
  `device_type` varchar(100) DEFAULT NULL,
  `is_logged_in` int(111) NOT NULL,
  `online` int(111) NOT NULL,
  `created_at` varchar(200) NOT NULL,
  `blood_group` varchar(11) DEFAULT NULL,
  `height` varchar(11) DEFAULT NULL,
  `weight` varchar(11) DEFAULT NULL,
  `disease` varchar(100) DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `municipality` varchar(255) DEFAULT NULL,
  `check_timesheat` varchar(255) DEFAULT NULL,
  `desk_number` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `time_zone` varchar(255) DEFAULT NULL,
  `timesheet` varchar(255) DEFAULT NULL,
  `check_timeoff` varchar(255) DEFAULT NULL,
  `time_off` varchar(255) DEFAULT NULL,
  `expense_check` varchar(255) DEFAULT NULL,
  `expenses` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_employees`
--

INSERT INTO `hrms_employees` (`check_change_password`, `company_name`, `manager_id`, `mobile_no`, `user_id`, `level`, `employee_id`, `office_shift_id`, `first_name`, `last_name`, `username`, `email`, `email_two`, `password`, `confirm_password`, `date_of_birth`, `city_of_birth`, `country_of_birth`, `gender`, `user_role_id`, `department_id`, `designation_id`, `head_designation`, `head_employee`, `company_id`, `role`, `empType`, `division`, `default_task`, `accounting_id`, `status`, `assign_to`, `notes`, `salary_template`, `hourly_grade_id`, `monthly_grade_id`, `date_of_joining`, `date_of_leaving`, `marital_status`, `spouse_name`, `spouse_dob`, `marrige_anniversery_date`, `children`, `salary`, `address`, `address_two`, `profile_picture`, `profile_background`, `wpn`, `wpn_issuedate`, `wpn_expirydate`, `passport_number`, `passport_issuedate`, `passsport_expirydate`, `nsn`, `visa_number`, `visa_issuedate`, `visa_expirydate`, `emergency_contact_name`, `emergency_contact_number`, `emergency_contact_relation`, `emergency_contact_email`, `resume`, `skype_id`, `contact_no`, `telephone`, `facebook_link`, `twitter_link`, `blogger_link`, `linkdedin_link`, `google_plus_link`, `instagram_link`, `pinterest_link`, `youtube_link`, `is_active`, `last_login_date`, `last_logout_date`, `last_login_ip`, `device_id`, `device_type`, `is_logged_in`, `online`, `created_at`, `blood_group`, `height`, `weight`, `disease`, `modified_at`, `state`, `city`, `country`, `municipality`, `check_timesheat`, `desk_number`, `location`, `time_zone`, `timesheet`, `check_timeoff`, `time_off`, `expense_check`, `expenses`) VALUES
(1, NULL, NULL, NULL, 1, '', '1', 1, 'SuperAdmin', '', 'infograins', 'ak@gmail.com', NULL, '123456', '', '2021-01-14', 'indore', 'india', 'male', 1, 1, 1, 0, 0, 21, 'trainee', 'Hourly employee', 0, 'dds', 1, 0, '', '                                                                                                                                                                                                                                              \r\n               ', '', 0, 0, '2021-01-08', '2021-01-11', '', NULL, NULL, NULL, NULL, '', '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, '', '', '', '', '', '', '', '', 0, '30-01-2021 10:55:02', '29-01-2021 19:35:36', '103.15.67.106', NULL, NULL, 1, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(0, NULL, NULL, NULL, 2, '', '1', 1, 'sohel', 'khan', 'infograins', 'admin@gmail.com', NULL, '123456', '', '2021-01-14', 'indore', 'india', 'male', 1, 1, 1, 0, 0, 1, 'Developer', 'junior deve', 0, 'hrms', 1, 1, '', '', '', 0, 0, '', '', '', NULL, NULL, NULL, NULL, '', '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, '', '', '', '', '', '', '', '', 1, '', '', '', NULL, NULL, 0, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(0, NULL, NULL, NULL, 3, '', '', 0, 'rahul', 'deshmukhfff', '', 'admin@os.com', NULL, '123456', '', '2021-01-14', NULL, NULL, '', 0, 0, 0, 0, 0, 0, 'junior employee', 'Full-time e', 0, '', 0, 0, '', '                                      \r\n                                    ', '', 0, 0, '2021-01-05', '2021-01-06', '', NULL, NULL, NULL, NULL, '', '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, '', '', '', '', '', '', '', '', 0, '', '', '', NULL, NULL, 0, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(0, NULL, NULL, NULL, 4, '', '', 0, 'dfgdf55555', '', '', 'a@yopmail.com', NULL, '12345678', '', '2021-01-14', NULL, NULL, '', 0, 0, 0, 0, 0, 0, '', 'Contractor', 0, '', 0, 0, '', '                                      \r\n                                    ', '', 0, 0, '2021-01-05', '2021-01-31', '', NULL, NULL, NULL, NULL, '', '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, '', '', '', '', '', '', '', '', 0, '', '', '', NULL, NULL, 0, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(0, NULL, NULL, NULL, 6, '', '', 0, 'kjfdjljj', '', '', 'kshkd@gmail.com', NULL, '12345678', '', '2021-01-14', NULL, NULL, '', 0, 0, 0, 0, 0, 0, '', 'Contractor', 0, '', 0, 0, '', '                                      \r\n                                    ', '', 0, 0, '2021-01-04', '2021-01-05', '', NULL, NULL, NULL, NULL, '', '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, '', '', '', '', '', '', '', '', 0, '', '', '', NULL, NULL, 0, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(0, NULL, NULL, NULL, 8, '', '', 0, 'ankit', '', '', 'savayam.khede@gmail.com', NULL, '12345678', '', '2021-01-14', NULL, NULL, '', 0, 0, 0, 0, 0, 0, 'QA', 'Contractor', 0, '', 0, 0, '', '                                      \r\n                                    ', '', 0, 0, '2021-01-05', '2021-01-05', '', NULL, NULL, NULL, NULL, '', '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, '', '', '', '', '', '', '', '', 0, '', '', '', NULL, NULL, 0, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(0, NULL, NULL, NULL, 11, '', '01', 0, 'pramod', 'pramod', '', 'pramoddwivedi.infograins@gmail.com', NULL, '12345678', '', '2021-01-14', NULL, NULL, '', 0, 0, 0, 0, 0, 0, 're', 'Hourly empl', 0, 're', 1, 0, '', '', '', 0, 0, '2021-01-06', '2021-01-07', '', NULL, NULL, NULL, NULL, '', '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, '', '', '', '', '', '', '', '', 0, '', '', '', NULL, NULL, 0, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(0, NULL, NULL, NULL, 13, '', '01', 0, '', 'anshul', '', 'anshulL@yopmail.com', NULL, '123456', '', '2021-01-14', NULL, NULL, '', 0, 0, 0, 0, 0, 0, 'qulity analysis', 'Standard', 0, 'dds', 21, 0, '', '                                                                                                                      \r\n                                  anshul  khede @                                        \r\n                                            ', '', 0, 0, '2021-01-07', '2021-01-09', '', NULL, NULL, NULL, NULL, '', '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, '', '', '', '', '', '', '', '', 0, '', '', '', NULL, NULL, 0, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(0, NULL, 23, '8335000582', 14, '', 'A98', 0, 'Shilpa', 'Gubrele', '', 'shilpa.gubrele@aaravsolutions.com', NULL, '', '', '2021-01-14', NULL, NULL, '', 3, 0, 0, 0, 0, 0, NULL, 'Full-time', 2, '', 0, 0, '', '                                                                                                                  \r\n                                                                                                            ', '', 0, 0, '2021-01-01', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 'Pic.JPG', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, '', '', '', '', '', '', '', '', 0, '', '', '', NULL, NULL, 0, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'on', 'Block A 98', 'Ahmedabad', 'IST', '24', 'on', '24', 'on', ''),
(0, NULL, NULL, NULL, 16, '', '', 0, 'Shilpa', 'Gubrele', '', 'shilpagubrele@gmail.com', NULL, '123456', '', '2021-01-14', NULL, NULL, '', 0, 0, 0, 0, 0, 0, '', 'Contractor', 0, '', 0, 0, '', '                                      \r\n                                    ', '', 0, 0, '2021-01-01', '2021-01-31', '', NULL, NULL, NULL, NULL, '', '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, '', '', '', '', '', '', '', '', 0, '', '', '', NULL, NULL, 0, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1, NULL, NULL, NULL, 23, 'L1', '2', 0, 'apeksha', 'mazumdar', '', 'apeksh@yopmail.com', NULL, '123456', '123456', '2021-01-14', NULL, NULL, '', 3, 0, 0, 0, 0, 0, 'hr', 'Full-time employee', 0, 'hrms', 3, 1, '', 'Hey Hello                                      \r\n                                    ', '', 0, 0, '2021-01-12', '2021-01-13', '', NULL, NULL, NULL, NULL, '', '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, '', '', '', '', '', '', '', '', 0, '29-01-2021 19:35:41', '29-01-2021 18:09:43', '122.168.71.215', NULL, NULL, 1, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(0, NULL, NULL, NULL, 24, 'L4', 'dfgdfg', 0, 'apeksha', '', '', 'wa@yopmail.com', NULL, '', '', '2021-01-14', NULL, NULL, '', 12, 0, 0, 0, 0, NULL, NULL, 'Contractor', 0, 'gfdg', 657, 0, NULL, 'gdgdf dfgdgfdfg                                    ', '', 0, 0, '2021-02-07', '2021-03-14', '', NULL, NULL, NULL, NULL, '', '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, '', '', '', '', '', '', '', '', 0, '', '', '', NULL, NULL, 0, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'on', '55', 'indore', 'india', '3', 'on', '14', NULL, ''),
(1, NULL, 8, '1234567890', 43, 'L2', 'r65756', 0, 'aPkehsa', '', '', 'rahul@yopmail.com', NULL, '456123', '123456', '2021-01-14', NULL, NULL, '', 2, 0, 0, 0, 0, 0, NULL, 'Full-time', 2, 'gfdg', 0, 1, NULL, '', '', 0, 0, '2021-01-13', '', '', NULL, NULL, NULL, NULL, '', '', NULL, 'backgrond_imge1.png', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, '', '', '', '', '', '', '', '', 0, '29-01-2021 18:08:36', '29-01-2021 18:08:55', '122.168.71.215', NULL, NULL, 0, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'on', '55', '', '', '13', NULL, '', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_employee_bankaccount`
--

CREATE TABLE `hrms_employee_bankaccount` (
  `bankaccount_id` int(111) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `is_primary` int(11) NOT NULL,
  `account_title` varchar(255) NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `bank_code` varchar(255) NOT NULL,
  `bank_branch` text NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hrms_employee_complaints`
--

CREATE TABLE `hrms_employee_complaints` (
  `complaint_id` int(111) NOT NULL,
  `complaint_from` int(111) NOT NULL,
  `title` varchar(255) NOT NULL,
  `complaint_date` varchar(255) NOT NULL,
  `complaint_against` text NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(2) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hrms_employee_contacts`
--

CREATE TABLE `hrms_employee_contacts` (
  `contact_id` int(111) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `relation` varchar(255) NOT NULL,
  `is_primary` int(111) NOT NULL,
  `is_dependent` int(111) NOT NULL,
  `contact_name` varchar(255) NOT NULL,
  `work_phone` varchar(255) NOT NULL,
  `work_phone_extension` varchar(255) NOT NULL,
  `mobile_phone` varchar(255) NOT NULL,
  `home_phone` varchar(255) NOT NULL,
  `work_email` varchar(255) NOT NULL,
  `personal_email` varchar(255) NOT NULL,
  `address_1` text NOT NULL,
  `address_2` text NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hrms_employee_contract`
--

CREATE TABLE `hrms_employee_contract` (
  `contract_id` int(111) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `contract_type_id` int(111) NOT NULL,
  `from_date` varchar(255) NOT NULL,
  `designation_id` int(111) NOT NULL,
  `title` varchar(255) NOT NULL,
  `to_date` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_employee_contract`
--

INSERT INTO `hrms_employee_contract` (`contract_id`, `employee_id`, `contract_type_id`, `from_date`, `designation_id`, `title`, `to_date`, `description`, `created_at`) VALUES
(1, 62, 1, '2018-05-05', 12, 'company contract', '2019-05-31', 'While we use encryption to protect sensitive information transmitted online, we also protect your information offline. Only employees who need the information to perform a specific job (for example, billing or customer service) are granted access to personally identifiable information. The computers/servers in which we store personally identifiable information are kept in a secure environment.', '05-05-2018');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_employee_documents`
--

CREATE TABLE `hrms_employee_documents` (
  `document_id` int(111) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `document_type_id` int(111) NOT NULL,
  `date_of_expiry` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `notification_email` varchar(255) NOT NULL,
  `is_alert` tinyint(1) NOT NULL,
  `description` text NOT NULL,
  `document_file` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hrms_employee_exit`
--

CREATE TABLE `hrms_employee_exit` (
  `exit_id` int(111) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `exit_date` varchar(255) NOT NULL,
  `exit_type_id` int(111) NOT NULL,
  `exit_interview` int(111) NOT NULL,
  `is_inactivate_account` int(111) NOT NULL,
  `reason` text NOT NULL,
  `added_by` int(111) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hrms_employee_exit_type`
--

CREATE TABLE `hrms_employee_exit_type` (
  `exit_type_id` int(111) NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_employee_exit_type`
--

INSERT INTO `hrms_employee_exit_type` (`exit_type_id`, `type`, `created_at`) VALUES
(1, 'Resignation', ''),
(2, 'Retirement', ''),
(3, 'End of Contract', ''),
(4, 'End of Project', ''),
(5, 'Dismissal', ''),
(6, 'Layoff', ''),
(7, 'Termination by Mutual Agreement', ''),
(8, 'Forced Resignation', ''),
(9, 'End of Temporary Appointment', ''),
(10, 'Death', ''),
(11, 'Abadonment', ''),
(12, 'Transfer', '');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_employee_feedback`
--

CREATE TABLE `hrms_employee_feedback` (
  `feedback_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `answers` varchar(5000) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `created_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hrms_employee_have_work`
--

CREATE TABLE `hrms_employee_have_work` (
  `have_word_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `work_status` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1=open,2=close',
  `work_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` varchar(100) DEFAULT NULL,
  `comment` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_employee_have_work`
--

INSERT INTO `hrms_employee_have_work` (`have_word_id`, `employee_id`, `work_status`, `status`, `work_date`, `modified_at`, `comment`) VALUES
(1, 61, 1, 1, '2018-05-05 22:47:25', NULL, NULL),
(2, 62, 1, 2, '2018-05-05 22:52:02', '2018-05-07 13:09:36', 'your comment...dklmlkmklcxv'),
(3, 62, 1, 2, '2018-05-05 22:56:27', '2018-05-07 12:56:07', 'your comment...ksdmksmsdksfd'),
(4, 62, 1, 2, '2018-05-05 23:19:50', '2018-05-07 11:43:57', 'your comment...kdkdfd');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_employee_immigration`
--

CREATE TABLE `hrms_employee_immigration` (
  `immigration_id` int(111) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `document_type_id` int(111) NOT NULL,
  `document_number` varchar(255) NOT NULL,
  `document_file` varchar(255) NOT NULL,
  `issue_date` varchar(255) NOT NULL,
  `expiry_date` varchar(255) NOT NULL,
  `country_id` varchar(255) NOT NULL,
  `eligible_review_date` varchar(255) NOT NULL,
  `comments` text NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hrms_employee_leave`
--

CREATE TABLE `hrms_employee_leave` (
  `leave_id` int(111) NOT NULL,
  `leave_type` varchar(255) NOT NULL,
  `from_date` varchar(255) NOT NULL,
  `to_date` varchar(255) NOT NULL,
  `leave_for_employee` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL,
  `emp_leave` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1=Approve,0=Pending',
  `employee_id` int(111) NOT NULL,
  `contract_id` int(111) NOT NULL,
  `casual_leave` varchar(255) NOT NULL,
  `medical_leave` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_employee_leave`
--

INSERT INTO `hrms_employee_leave` (`leave_id`, `leave_type`, `from_date`, `to_date`, `leave_for_employee`, `note`, `emp_leave`, `status`, `employee_id`, `contract_id`, `casual_leave`, `medical_leave`, `created_at`) VALUES
(2, 'Casual Leave', '2021-01-13', '2021-01-28', 'sohel khan', 'dfdsgfd                                      \r\n                                    ', 'sohel khan', 1, 0, 0, '', '', ''),
(3, 'Medical Leave', '2021-01-16', '2021-01-28', '', ' dfdsgfd  jj                                   \r\n                                                                          \r\n                                                                          \r\n                                    ', ' anshul', 0, 0, 0, '', '', ''),
(4, 'Vacation Leave', '2021-01-15', '2021-01-31', '', 'xyz                                    \r\n                                                                                                                           \r\n                                                                          \r\n             ', 'sohel khan', 1, 0, 0, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_employee_location`
--

CREATE TABLE `hrms_employee_location` (
  `office_location_id` int(111) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `location_id` int(111) NOT NULL,
  `from_date` varchar(255) NOT NULL,
  `to_date` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hrms_employee_medical_convocation`
--

CREATE TABLE `hrms_employee_medical_convocation` (
  `convocation_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `convocation_date` date NOT NULL,
  `health_status` varchar(100) NOT NULL,
  `disease` varchar(500) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_employee_medical_convocation`
--

INSERT INTO `hrms_employee_medical_convocation` (`convocation_id`, `employee_id`, `convocation_date`, `health_status`, `disease`, `created_by`, `created_at`) VALUES
(1, 62, '2018-05-05', 'normal', 'sick', 59, '2018-05-05 16:04:53'),
(2, 82, '2019-06-17', 'good', 'dad', 82, '2019-06-17 15:33:09'),
(3, 60, '2020-11-10', 'dsfdsf', 'dsfdsf', 59, '2020-11-09 11:49:58'),
(4, 59, '2020-12-12', 'not good', 'fhgdh', 59, '2020-12-12 13:56:18');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_employee_medical_request`
--

CREATE TABLE `hrms_employee_medical_request` (
  `request_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_employee_medical_request`
--

INSERT INTO `hrms_employee_medical_request` (`request_id`, `employee_id`, `status`, `created_at`) VALUES
(1, 62, 1, '2018-05-05 16:13:02');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_employee_probations`
--

CREATE TABLE `hrms_employee_probations` (
  `probation_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `compnay_id` int(11) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `description` varchar(5000) NOT NULL,
  `result` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_employee_probations`
--

INSERT INTO `hrms_employee_probations` (`probation_id`, `employee_id`, `compnay_id`, `start_date`, `end_date`, `description`, `result`, `created_at`) VALUES
(1, 52, 17, '2018-05-03', '2018-05-31', 'tyt tyty', 0, '2018-05-04 14:02:15'),
(2, 62, 21, '2018-05-05', '2018-05-31', 'While we use encryption to protect sensitive information transmitted online, we also protect your information offline. Only employees who need the information to perform a specific job (for example, billing or customer service) are granted access to personally identifiable information. The computers/servers in which we store personally identifiable information are kept in a secure environment.', 0, '2018-05-05 23:49:56'),
(3, 82, 33, '2019-06-17', '2019-08-29', 'added tags aghsasas', 2, '2019-06-17 09:39:11'),
(4, 82, 33, '2019-06-17', '2019-06-30', 'sasasas', 0, '2019-06-17 15:09:29');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_employee_promotions`
--

CREATE TABLE `hrms_employee_promotions` (
  `promotion_id` int(111) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `promotion_date` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `location_To` varchar(50) DEFAULT NULL,
  `location_from` varchar(50) DEFAULT NULL,
  `department_to` varchar(50) DEFAULT NULL,
  `department_from` varchar(50) DEFAULT NULL,
  `designation_to` varchar(50) DEFAULT NULL,
  `designation_from` varchar(50) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0=pending,1=approved,2=rejectd',
  `added_by` int(111) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `modified_at` varchar(100) DEFAULT NULL,
  `comment` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_employee_promotions`
--

INSERT INTO `hrms_employee_promotions` (`promotion_id`, `employee_id`, `company_id`, `title`, `promotion_date`, `description`, `location_To`, `location_from`, `department_to`, `department_from`, `designation_to`, `designation_from`, `status`, `added_by`, `created_at`, `modified_at`, `comment`) VALUES
(1, 52, 17, 'hgfhh', '2018-05-04', '', '1', '2', '1', '2', '1', '1', 8, 44, '04-05-2018', '2018-05-05 18:21:37', 'hiii'),
(2, 49, 17, 'prmotion', '', 'test promotion', '4', '5', '11', '11', '27', '28', 0, 49, '05-05-2018', NULL, NULL),
(3, 49, 17, 'prmotion', '', 'test promotion', '4', '5', '11', '11', '27', '28', 0, 49, '05-05-2018', NULL, NULL),
(4, 61, 21, 'paean', '', '(optional)zN Znjzbzjzx ', '9', '8', '10', '12', '12', '12', 0, 61, '07-05-2018', NULL, NULL),
(5, 82, 33, 'Senior QA', '2019-06-30', '', '24', '24', '34', '34', '35', '35', 0, 82, '17-06-2019', NULL, 'rtretetet'),
(6, 82, 33, 'sasa', '2019-06-25', '', '24', '24', '34', '35', '35', '36', 0, 82, '17-06-2019', NULL, NULL),
(7, 82, 33, 'QA', '2019-06-17', '', '24', '25', '34', '34', '36', '36', 0, 82, '17-06-2019', NULL, NULL),
(8, 62, 21, 'Senior QA', '2019-06-30', '', '8', '9', '10', '11', '10', '10', 0, 59, '17-06-2019', NULL, NULL),
(9, 60, 21, 'Director', '2020-12-19', '', '43', '43', '58', '12', '82', '82', 0, 59, '12-12-2020', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hrms_employee_qualification`
--

CREATE TABLE `hrms_employee_qualification` (
  `qualification_id` int(111) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `name` varchar(255) NOT NULL,
  `education_level_id` int(111) NOT NULL,
  `from_year` varchar(255) NOT NULL,
  `language_id` int(111) NOT NULL,
  `to_year` varchar(255) NOT NULL,
  `skill_id` text NOT NULL,
  `description` text NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_employee_qualification`
--

INSERT INTO `hrms_employee_qualification` (`qualification_id`, `employee_id`, `name`, `education_level_id`, `from_year`, `language_id`, `to_year`, `skill_id`, `description`, `created_at`) VALUES
(1, 64, 'kk', 1, '2010-05-04', 1, '2012-05-16', '3', 'SAcdff', '08-05-2018');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_employee_resignations`
--

CREATE TABLE `hrms_employee_resignations` (
  `resignation_id` int(111) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `notice_date` varchar(255) NOT NULL,
  `resignation_date` varchar(255) NOT NULL,
  `reason` text NOT NULL,
  `added_by` int(111) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hrms_employee_shift`
--

CREATE TABLE `hrms_employee_shift` (
  `emp_shift_id` int(111) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `shift_id` int(111) NOT NULL,
  `from_date` varchar(255) NOT NULL,
  `to_date` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_employee_shift`
--

INSERT INTO `hrms_employee_shift` (`emp_shift_id`, `employee_id`, `shift_id`, `from_date`, `to_date`, `created_at`) VALUES
(6, 1, 1, '2017-02-01', '2017-11-30', '2017-02-25 02:53:48'),
(9, 23, 1, '2017-01-02', '2017-12-29', '2017-04-28 03:31:27'),
(10, 24, 1, '2017-06-08', '2017-12-28', '27-06-2017'),
(11, 31, 1, '2017-12-01', '2017-12-31', '18-12-2017'),
(12, 5, 1, '2017-12-01', '2017-12-31', '27-12-2017'),
(13, 10, 1, '2018-01-01', '2018-01-31', '30-12-2017'),
(14, 10, 2, '2018-02-01', '2018-02-28', '30-12-2017'),
(15, 10, 4, '2018-03-01', '2018-03-31', '30-12-2017'),
(16, 61, 5, '2018-05-05', '2018-05-05', '05-05-2018'),
(17, 62, 5, '2018-05-05', '2018-05-05', '05-05-2018');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_employee_terminations`
--

CREATE TABLE `hrms_employee_terminations` (
  `termination_id` int(111) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `terminated_by` int(111) NOT NULL,
  `termination_type_id` int(111) NOT NULL,
  `termination_date` varchar(255) NOT NULL,
  `notice_date` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(2) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hrms_employee_transfer`
--

CREATE TABLE `hrms_employee_transfer` (
  `transfer_id` int(111) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `transfer_date` varchar(255) NOT NULL,
  `transfer_department` int(111) NOT NULL COMMENT 'tranferDepartmentTo',
  `department_from` int(11) DEFAULT NULL,
  `transfer_location` int(111) NOT NULL COMMENT 'transfer_to',
  `transferfrom` varchar(200) DEFAULT NULL,
  `designation_to` int(11) DEFAULT NULL,
  `designation_from` int(11) DEFAULT NULL,
  `description` text CHARACTER SET utf16,
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0=pending1=approved,2=reject',
  `added_by` int(111) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `modified_at` varchar(100) DEFAULT NULL,
  `comment` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_employee_transfer`
--

INSERT INTO `hrms_employee_transfer` (`transfer_id`, `employee_id`, `company_id`, `transfer_date`, `transfer_department`, `department_from`, `transfer_location`, `transferfrom`, `designation_to`, `designation_from`, `description`, `status`, `added_by`, `created_at`, `modified_at`, `comment`) VALUES
(1, 52, 17, '2018-05-25', 2, 1, 1, '2', 2, 1, '', 0, 44, '04-05-2018', NULL, NULL),
(2, 49, 17, '', 11, 11, 4, '4', NULL, NULL, NULL, 1, 49, '2018-05-05', NULL, NULL),
(3, 52, 17, '', 2, 1, 1, '1', NULL, NULL, NULL, 1, 52, '2018-05-05', NULL, NULL),
(5, 49, 17, '', 11, 11, 4, '4', NULL, NULL, NULL, 1, 49, '2018-05-05', NULL, NULL),
(11, 49, 17, '', 11, 11, 4, '4', NULL, NULL, NULL, 1, 49, '2018-05-05', NULL, NULL),
(13, 61, 21, '', 11, 10, 9, '8', NULL, NULL, NULL, 1, 61, '2018-05-07', NULL, NULL),
(14, 61, 21, '', 12, 10, 9, '8', NULL, NULL, NULL, 1, 61, '2018-05-08', NULL, NULL),
(15, 82, 33, '2019-06-30', 34, 34, 23, '25', 35, 36, '', 0, 82, '17-06-2019', NULL, NULL),
(16, 62, 21, '2019-06-25', 11, 12, 8, '9', 11, 12, 'Adccedjd', 1, 59, '17-06-2019', NULL, 'sasas'),
(18, 61, 21, '2020-11-11', 11, 60, 48, '43', 11, 57, '', 0, 59, '11-11-2020', NULL, NULL),
(19, 61, 21, '2020-11-12', 60, 60, 48, '43', 57, 58, '', 0, 59, '11-11-2020', NULL, NULL),
(20, 61, 21, '2020-12-19', 70, 59, 9, '9', 89, 90, '', 0, 59, '12-12-2020', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hrms_employee_travels`
--

CREATE TABLE `hrms_employee_travels` (
  `travel_id` int(111) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `start_date` varchar(255) NOT NULL,
  `end_date` varchar(255) NOT NULL,
  `visit_purpose` varchar(255) NOT NULL,
  `visit_place` varchar(255) NOT NULL,
  `travel_mode` int(111) NOT NULL,
  `arrangement_type` int(111) NOT NULL,
  `expected_budget` varchar(255) NOT NULL,
  `actual_budget` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0=pending,1=accept,2=rejected',
  `added_by` int(111) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `modified_at` varchar(100) DEFAULT NULL,
  `comment` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_employee_travels`
--

INSERT INTO `hrms_employee_travels` (`travel_id`, `employee_id`, `company_id`, `start_date`, `end_date`, `visit_purpose`, `visit_place`, `travel_mode`, `arrangement_type`, `expected_budget`, `actual_budget`, `description`, `status`, `added_by`, `created_at`, `modified_at`, `comment`) VALUES
(1, 52, 17, '2018-05-04', '2018-05-17', 'fgh gfg', 'indore', 1, 1, '2345', '2000', 'ty tyt y', 0, 44, '04-05-2018', NULL, NULL),
(2, 62, 21, '2018-05-12', '2018-05-31', 'travler', 'indore', 1, 2, '200', '200', 'indore travel', 1, 59, '05-05-2018', '2018-05-05 18:38:32', 'your comment...'),
(3, 61, 21, '2018-05-06', '2020-05-06', 'dhhdhf', 'hdhd hdh', 0, 0, '', '', 'Jdjdjd', 0, 61, '2018-05-05 18:50:30', NULL, NULL),
(4, 49, 17, '2018-01-05', '2018-01-20', 'Traning', 'Delhi', 0, 0, '', '', 'for testing', 0, 49, '2018-05-07 12:04:43', NULL, NULL),
(5, 49, 17, '2018-01-05', '2018-01-20', 'Traning', 'Delhi', 0, 0, '', '', 'for testing', 0, 49, '2018-05-07 12:08:55', NULL, NULL),
(6, 49, 17, '2018-01-05', '2018-01-20', 'Traning', 'Delhi', 0, 0, '', '', 'for testing', 0, 49, '2018-05-07 12:21:09', NULL, NULL),
(7, 61, 17, '2018-01-05', '2018-01-20', 'Traning', 'Delhi', 0, 0, '', '', 'for testing', 2, 61, '2018-05-07 12:21:19', '2018-05-07 12:41:42', 'hiii'),
(8, 61, 17, '2018-01-05', '2018-01-20', 'Traning', 'Delhi', 0, 0, '', '', 'for testing', 0, 61, '2018-05-07 12:42:56', NULL, NULL),
(9, 62, 21, '2018-06-13', '2018-06-17', 'maintenance', 'Lubumbashi ', 0, 0, '', '', 'Maintenance ', 0, 62, '2018-05-13 19:55:44', NULL, NULL),
(11, 82, 33, '2019-06-17', '2019-06-30', 'dadasd', 'dasasas', 3, 2, '3000k', '2000K', '', 2, 82, '17-06-2019', NULL, ''),
(13, 62, 21, '2020-12-19', '2020-12-31', 'sales', 'dubai', 3, 3, '5000', '10000', '', 0, 59, '12-12-2020', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hrms_employee_warnings`
--

CREATE TABLE `hrms_employee_warnings` (
  `warning_id` int(111) NOT NULL,
  `warning_to` int(111) NOT NULL,
  `warning_by` int(111) NOT NULL,
  `warning_date` varchar(255) NOT NULL,
  `warning_type_id` int(111) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(2) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_employee_warnings`
--

INSERT INTO `hrms_employee_warnings` (`warning_id`, `warning_to`, `warning_by`, `warning_date`, `warning_type_id`, `subject`, `description`, `status`, `created_at`) VALUES
(1, 62, 60, '2018-05-05', 1, 'late coming', 'this is last warning', 0, '05-05-2018'),
(2, 82, 82, '2019-06-18', 1, 'ssasa', 'sasas aas', 0, '17-06-2019'),
(3, 60, 61, '2019-07-18', 1, 'Mobile usage', 'dgassf agd gsf asglsg SG SGA', 0, '17-07-2019'),
(4, 60, 116, '2020-12-12', 2, 'sadas', 'tfydyrdyrdtrdrtd', 0, '12-12-2020');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_employee_work_experience`
--

CREATE TABLE `hrms_employee_work_experience` (
  `work_experience_id` int(111) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `from_date` varchar(255) NOT NULL,
  `to_date` varchar(255) NOT NULL,
  `post` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hrms_emplyee_type`
--

CREATE TABLE `hrms_emplyee_type` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_emplyee_type`
--

INSERT INTO `hrms_emplyee_type` (`id`, `title`, `created_at`, `modified_at`) VALUES
(1, 'Regular staff', '2018-04-23 00:00:00', '0000-00-00 00:00:00'),
(2, 'Tempoeary', '2018-04-23 00:00:00', '0000-00-00 00:00:00'),
(3, 'Contract Employee', '2018-04-23 00:00:00', '0000-00-00 00:00:00'),
(4, 'Paid Intern', '2018-04-23 00:00:00', '0000-00-00 00:00:00'),
(5, 'Unpaid Intern', '2018-04-23 00:00:00', '0000-00-00 00:00:00'),
(6, 'Consultants', '2018-04-23 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_expenses`
--

CREATE TABLE `hrms_expenses` (
  `expense_id` int(11) NOT NULL,
  `employee_id` int(200) NOT NULL,
  `expense_type_id` int(200) NOT NULL,
  `billcopy_file` text NOT NULL,
  `amount` varchar(200) NOT NULL,
  `purchase_date` varchar(200) NOT NULL,
  `remarks` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `status_remarks` text NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_expenses`
--

INSERT INTO `hrms_expenses` (`expense_id`, `employee_id`, `expense_type_id`, `billcopy_file`, `amount`, `purchase_date`, `remarks`, `status`, `status_remarks`, `created_at`) VALUES
(2, 23, 1, 'bill_copy_1499896523.png', '1200', '2017-01-03', '&lt;p&gt;&lt;span style=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\&amp;quot;color:\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; rgb(51,=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; 51,=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; 51);=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; font-family:=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; &amp;quot;source=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; sans=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; pro&amp;quot;,=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; &amp;quot;helvetica=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; neue&amp;quot;,=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; helvetica,=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; arial,=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; sans-serif;=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; font-size:=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; 12px;=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; text-align:=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot; justify;\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\&quot;=\\&quot;\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\\\\\\\\\&amp;quot;\\\\\\\\&amp;quot;\\\\&amp;quot;\\&quot;&gt;Office utility Bills.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;', 0, '', '28-04-2017'),
(8, 23, 1, 'bill_copy_1499896528.png', '2343', '2017-05-03', '&lt;p&gt;sdfadsfdsfd&lt;/p&gt;', 1, '', '31-05-2017');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_expense_type`
--

CREATE TABLE `hrms_expense_type` (
  `expense_type_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hrms_faq`
--

CREATE TABLE `hrms_faq` (
  `faq_id` int(111) NOT NULL,
  `company_id` int(111) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `added_by` int(111) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_faq`
--

INSERT INTO `hrms_faq` (`faq_id`, `company_id`, `title`, `description`, `added_by`, `created_at`) VALUES
(1, 0, 'What is Lorem Ipsum?', 'Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven\\&#039;t heard of them accusamus labore sustainable VHS.', 1, '09-01-2018'),
(2, 0, 'What is Lorem Ipsum?', 'Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven\\&#039;t heard of them accusamus labore sustainable VHS.', 1, '09-01-2018'),
(3, 0, 'What is Lorem Ipsum?', 'Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven\\\\\\&#039;t heard of them accusamus labore sustainable VHS.', 1, '09-01-2018'),
(4, 0, 'What is Lorem Ipsum?', 'Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven\\&#039;t heard of them accusamus labore sustainable VHS.', 1, '09-01-2018'),
(5, 0, 'What is Lorem Ipsum?', 'Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven\\&#039;t heard of them accusamus labore sustainable VHS.', 1, '09-01-2018'),
(6, 0, 'What is Lorem Ipsum?', 'Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven\\&#039;t heard of them accusamus labore sustainable VHS.', 1, '09-01-2018');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_file_management`
--

CREATE TABLE `hrms_file_management` (
  `file_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `file_name` varchar(200) NOT NULL,
  `file_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(500) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_file_management`
--

INSERT INTO `hrms_file_management` (`file_id`, `employee_id`, `department_id`, `file_name`, `file_date`, `title`, `status`) VALUES
(1, 10, 5, '1513858638.jpg', '2017-12-28 10:56:26', NULL, 1),
(2, 10, 5, '1513858662.jpg', '2017-12-28 10:56:28', NULL, 1),
(3, 10, 1, '', '2017-12-28 11:01:26', 'Please share a file', 2),
(4, 3, 1, '1515156280.xlsx', '2017-12-30 09:02:39', 'SAlary slip', 2),
(5, 10, 1, '1515156215.png', '2018-01-04 09:19:52', 'Please share a file', 2),
(6, 10, 2, '1515156208.jpg', '2018-01-04 12:35:43', 'mew handbook', 2),
(7, 10, 8, '1515496169.jpg', '2018-01-09 11:09:29', NULL, 1),
(8, 10, 6, '1515496806.apk', '2018-01-09 11:20:06', NULL, 1),
(9, 10, 3, '1515497135.mp3', '2018-01-09 11:25:35', NULL, 1),
(10, 10, 3, '1515500119.jpeg', '2018-01-09 12:15:19', NULL, 1),
(11, 10, 1, '1515500243.jpg', '2018-01-09 12:17:23', NULL, 1),
(12, 10, 2, '', '2018-01-09 12:19:44', 'please provide file', 2),
(13, 49, 5, '1515501315.jpg', '2018-01-09 12:35:15', NULL, 1),
(14, 10, 1, '', '2018-01-09 12:36:12', 'hhhjk.png', 2),
(15, 10, 2, '', '2018-01-10 11:17:43', 'qwetty', 2),
(16, 62, 9, '', '2018-05-14 02:50:21', 'attestation de travail', 2);

-- --------------------------------------------------------

--
-- Table structure for table `hrms_holidays`
--

CREATE TABLE `hrms_holidays` (
  `holiday_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `event_name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `location` varchar(255) NOT NULL,
  `start_date` varchar(200) NOT NULL,
  `end_date` varchar(200) NOT NULL,
  `is_publish` tinyint(1) NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_holidays`
--

INSERT INTO `hrms_holidays` (`holiday_id`, `company_id`, `event_name`, `description`, `location`, `start_date`, `end_date`, `is_publish`, `created_at`) VALUES
(1, 21, 'Holi', ' Holi HoliHoliHoliHoliHoliHoliHoli', '53', '2021-02-01', '2021-02-28', 1, '2021-01-23'),
(2, 21, 'vvvz', 'vhvkhjvgkgvkugukvvughjvvvvvvvvvvvvvvvvv', '8', '2021-01-07', '2021-01-30', 1, '2021-01-23'),
(3, 21, 'Republic day', 'gvckghv khg v', '55', '2021-01-26', '2021-01-26', 1, '2021-01-23'),
(4, 21, 'Basant Panchmi', '', '61', '2021-02-16', '2021-02-16', 1, '2021-01-27');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_hourly_templates`
--

CREATE TABLE `hrms_hourly_templates` (
  `hourly_rate_id` int(111) NOT NULL,
  `company_id` int(11) NOT NULL,
  `hourly_grade` varchar(255) NOT NULL,
  `hourly_rate` varchar(255) NOT NULL,
  `added_by` int(111) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_hourly_templates`
--

INSERT INTO `hrms_hourly_templates` (`hourly_rate_id`, `company_id`, `hourly_grade`, `hourly_rate`, `added_by`, `created_at`) VALUES
(1, 21, 'new hourly', '2356', 59, '05-05-2018 03:57:34'),
(2, 33, 'QA', '100', 82, '17-06-2019 03:43:00'),
(4, 21, 'hourly', '$5562', 59, '17-12-2020 05:24:27');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_jobs`
--

CREATE TABLE `hrms_jobs` (
  `job_id` int(11) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `designation_id` int(111) NOT NULL,
  `job_type` int(225) NOT NULL,
  `job_vacancy` int(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `minimum_experience` varchar(255) NOT NULL,
  `date_of_closing` varchar(200) NOT NULL,
  `short_description` text NOT NULL,
  `long_description` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hrms_job_applications`
--

CREATE TABLE `hrms_job_applications` (
  `application_id` int(111) NOT NULL,
  `job_id` int(111) NOT NULL,
  `user_id` int(111) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `experience` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `job_resume` text NOT NULL,
  `application_status` varchar(200) NOT NULL,
  `application_remarks` text NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hrms_job_interviews`
--

CREATE TABLE `hrms_job_interviews` (
  `job_interview_id` int(111) NOT NULL,
  `job_id` int(111) NOT NULL,
  `interviewers_id` varchar(255) NOT NULL,
  `interview_place` varchar(255) NOT NULL,
  `interview_date` varchar(255) NOT NULL,
  `interview_time` varchar(255) NOT NULL,
  `interviewees_id` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `added_by` int(111) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hrms_job_type`
--

CREATE TABLE `hrms_job_type` (
  `job_type_id` int(111) NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_job_type`
--

INSERT INTO `hrms_job_type` (`job_type_id`, `type`, `created_at`) VALUES
(1, 'Intern', '2017-03-22 07:07:55'),
(2, 'Freelancer', '2017-03-22 07:07:55'),
(5, 'Full-Time', '2017-03-22 07:07:55'),
(6, 'Part-Time', '2017-03-22 07:08:00'),
(7, 'Contract', '2017-03-22 07:08:03');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_leaves`
--

CREATE TABLE `hrms_leaves` (
  `id` int(11) NOT NULL,
  `emp_name` varchar(255) NOT NULL,
  `leave` varchar(255) NOT NULL,
  `sdate` varchar(255) NOT NULL,
  `edate` varchar(255) NOT NULL,
  `number_days` varchar(255) DEFAULT NULL,
  `note` varchar(255) NOT NULL,
  `status` tinyint(11) NOT NULL DEFAULT '0' COMMENT '1 for Approve,0 for Pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_leaves`
--

INSERT INTO `hrms_leaves` (`id`, `emp_name`, `leave`, `sdate`, `edate`, `number_days`, `note`, `status`) VALUES
(6, '23', '2', '2020-01-21', '2021-01-31', '10', 'dfsdfsdfsds              ', 1),
(7, '23', '1', '2021-01-26', '2021-01-31', '5', 'ghf', 2),
(8, '23', '2', '2021-01-24', '2021-01-28', '4', '', 0),
(9, '23', '3', '2021-01-27', '2021-01-29', '2', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `hrms_leave_applications`
--

CREATE TABLE `hrms_leave_applications` (
  `leave_id` int(11) NOT NULL,
  `employee_id` int(222) NOT NULL,
  `leave_type_id` int(222) NOT NULL,
  `from_date` varchar(200) NOT NULL,
  `to_date` varchar(200) NOT NULL,
  `applied_on` varchar(200) NOT NULL,
  `reason` text NOT NULL,
  `remarks` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=pending,2=approve,3=reject',
  `created_at` varchar(200) NOT NULL,
  `modified_at` varchar(100) DEFAULT NULL,
  `comment` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_leave_applications`
--

INSERT INTO `hrms_leave_applications` (`leave_id`, `employee_id`, `leave_type_id`, `from_date`, `to_date`, `applied_on`, `reason`, `remarks`, `status`, `created_at`, `modified_at`, `comment`) VALUES
(1, 62, 2, '2018-06-05', '2018-09-05', '2018-05-05 15:52:39', 'Health issues', 'your comment...kjdnkjdn', 2, '2018-05-05 15:52:39', '2018-05-05 18:29:53', NULL),
(2, 61, 2, '2018-06-07', '2018-09-07', '2018-05-07 11:52:51', 'Ghsafvahsavgasdfgv', '', 1, '2018-05-07 11:52:51', NULL, NULL),
(3, 61, 2, '2018-06-07', '2018-09-07', '2018-05-07 11:53:58', 'Ghsafvahsavgasdfgv', '', 1, '2018-05-07 11:53:58', NULL, NULL),
(4, 61, 2, '2018-06-07', '2018-09-07', '2018-05-07 11:54:08', 'Ghsafvahsavgasdfgv', '', 1, '2018-05-07 11:54:08', NULL, NULL),
(5, 62, 2, '2018-05-09', '2018-05-10', '2018-05-07 13:25:21', 'Chdhdudfh', 'N b n b hnyour comment...', 2, '2018-05-07 13:25:21', '2018-05-07 13:25:48', NULL),
(6, 62, 1, '2018-10-07', '2018-10-19', '2018-05-10 11:47:07', 'Holidays', '&lt;p&gt;&lt;br&gt;&lt;/p&gt;', 1, '2018-05-10 11:47:07', NULL, NULL),
(7, 62, 1, '2019-06-16', '2019-06-17', '2019-06-15 07:07:31', 'Personal Work', '', 2, '2019-06-15 07:07:31', NULL, NULL),
(8, 82, 1, '2019-06-17', '2019-06-19', '2019-06-17 03:35:00', 'sasa hyagh hjags sas', '', 3, '2019-06-17 03:35:00', NULL, NULL),
(9, 62, 2, '2019-06-17', '2019-06-30', '2019-06-17 03:54:14', 'Ajay leave', '', 3, '2019-06-17 03:54:14', NULL, NULL),
(11, 62, 1, '2019-07-18', '2019-07-19', '2019-07-17 04:51:58', 'Sick', '&lt;p&gt;Not feeling well&lt;/p&gt;', 1, '2019-07-17 04:51:58', NULL, NULL),
(12, 62, 1, '2020-10-31', '2020-11-04', '2020-10-29 11:19:31', 'fvfgdfgdf', '&lt;p&gt;&lt;br&gt;&lt;/p&gt;', 1, '2020-10-29 11:19:31', NULL, NULL),
(13, 59, 1, '2020-11-10', '2020-11-11', '2020-11-09 12:04:55', 'dsfds', '&lt;p&gt;dsfdsfdsfdsdfssdfdsfdsfdsf&lt;/p&gt;', 1, '2020-11-09 12:04:55', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hrms_leave_category`
--

CREATE TABLE `hrms_leave_category` (
  `id` int(11) NOT NULL,
  `leave_name` varchar(255) NOT NULL,
  `yearly_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_leave_category`
--

INSERT INTO `hrms_leave_category` (`id`, `leave_name`, `yearly_number`) VALUES
(1, 'Vacation Leave', '20'),
(2, 'Medical Leave', '50'),
(3, 'Casual Leave', '7'),
(4, 'Feburay', '44'),
(5, 'Feburay', '30'),
(6, 'Optional Hoiday', '2');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_leave_type`
--

CREATE TABLE `hrms_leave_type` (
  `leave_type_id` int(11) NOT NULL,
  `type_name` varchar(200) NOT NULL,
  `days_per_year` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_leave_type`
--

INSERT INTO `hrms_leave_type` (`leave_type_id`, `type_name`, `days_per_year`, `status`, `created_at`) VALUES
(1, 'Casual Leave', '15', 1, '2017-04-28 07:42:15'),
(2, 'Medical Leave', '20', 1, '2017-04-28 07:42:24');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_make_payment`
--

CREATE TABLE `hrms_make_payment` (
  `make_payment_id` int(111) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `department_id` int(111) NOT NULL,
  `company_id` int(111) NOT NULL,
  `location_id` int(111) NOT NULL,
  `designation_id` int(111) NOT NULL,
  `payment_date` varchar(200) NOT NULL,
  `basic_salary` varchar(255) NOT NULL,
  `payment_amount` varchar(255) NOT NULL,
  `gross_salary` varchar(255) NOT NULL,
  `total_allowances` varchar(255) NOT NULL,
  `total_deductions` varchar(255) NOT NULL,
  `net_salary` varchar(255) NOT NULL,
  `house_rent_allowance` varchar(255) NOT NULL,
  `medical_allowance` varchar(255) NOT NULL,
  `travelling_allowance` varchar(255) NOT NULL,
  `dearness_allowance` varchar(255) NOT NULL,
  `provident_fund` varchar(255) NOT NULL,
  `tax_deduction` varchar(255) NOT NULL,
  `security_deposit` varchar(255) NOT NULL,
  `overtime_rate` varchar(255) NOT NULL,
  `is_payment` tinyint(1) NOT NULL,
  `payment_method` int(11) NOT NULL,
  `hourly_rate` varchar(255) NOT NULL,
  `total_hours_work` varchar(255) NOT NULL,
  `comments` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_make_payment`
--

INSERT INTO `hrms_make_payment` (`make_payment_id`, `employee_id`, `department_id`, `company_id`, `location_id`, `designation_id`, `payment_date`, `basic_salary`, `payment_amount`, `gross_salary`, `total_allowances`, `total_deductions`, `net_salary`, `house_rent_allowance`, `medical_allowance`, `travelling_allowance`, `dearness_allowance`, `provident_fund`, `tax_deduction`, `security_deposit`, `overtime_rate`, `is_payment`, `payment_method`, `hourly_rate`, `total_hours_work`, `comments`, `status`, `created_at`) VALUES
(1, 61, 11, 21, 8, 11, '2018-05', '2000', '2024', '2149', '149', '125', '2024', '45', '25', '23', '56', '45', '25', '55', '45', 1, 2, '', '', 'enjoy', 1, '05-05-2018 03:58:25'),
(2, 62, 12, 21, 9, 12, '2018-05', '2000', '2024', '2149', '149', '125', '2024', '45', '25', '23', '56', '45', '25', '55', '45', 1, 2, '', '', 'enjoy', 1, '05-05-2018 03:58:41'),
(3, 61, 11, 21, 8, 11, '2018-03', '2000', '2024', '2149', '149', '125', '2024', '45', '25', '23', '56', '45', '25', '55', '45', 1, 3, '', '', 'enjoy', 1, '05-05-2018 04:00:25'),
(4, 62, 12, 21, 9, 12, '2018-03', '2000', '2024', '2149', '149', '125', '2024', '45', '25', '23', '56', '45', '25', '55', '45', 1, 2, '', '', 'hello', 1, '05-05-2018 04:00:39'),
(5, 82, 2, 17, 2, 34, '2019-06', '8000', '8000', '10000', '2000', '2000', '8000', '500', '500', '500', '500', '500', '1000', '500', '100', 1, 2, '', '', 'Comment', 1, '17-06-2019 03:45:49'),
(6, 61, 11, 21, 8, 11, '2019-07', '2000', '2024', '2149', '149', '125', '2024', '45', '25', '23', '56', '45', '25', '55', '45', 1, 5, '', '', 'sALARY BY iNFOGRAINS', 1, '17-07-2019 04:43:23'),
(7, 61, 11, 21, 8, 11, '2020-11', '2000', '2024', '2149', '149', '125', '2024', '45', '25', '23', '56', '45', '25', '55', '45', 1, 2, '', '', 'dfbvc ', 1, '09-11-2020 11:58:43');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_manumally_attendrance`
--

CREATE TABLE `hrms_manumally_attendrance` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(255) DEFAULT NULL,
  `project_id` varchar(255) DEFAULT NULL,
  `task_id` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `start_time` varchar(255) DEFAULT NULL,
  `end_time` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT '0' COMMENT '0=pending,1=approved,2=rejected',
  `comment` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_manumally_attendrance`
--

INSERT INTO `hrms_manumally_attendrance` (`id`, `employee_id`, `project_id`, `task_id`, `date`, `start_time`, `end_time`, `status`, `comment`, `created_at`) VALUES
(2, '23', '4', '2', '2021-01-05', '12:48 AM', '01:48 PM', 1, NULL, '2021-01-25 06:16:50'),
(3, '23', '4', '2', '2021-01-07', '12:50 AM', '01:50 AM', 2, 'check it', '2021-01-25 06:18:58'),
(4, '23', '4', '3', '2021-01-07', '12:33 AM', '02:39 PM', 1, NULL, '2021-01-25 06:18:58');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_newsletter`
--

CREATE TABLE `hrms_newsletter` (
  `id` int(11) NOT NULL,
  `title` text,
  `description` text,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1=active,0=deactive',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_newsletter`
--

INSERT INTO `hrms_newsletter` (`id`, `title`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, '<p>CHeck News</p>\r\n', '<p>CHeck News&nbsp;CHeck News&nbsp;CHeck News&nbsp;CHeck News&nbsp;CHeck News&nbsp;CHeck News&nbsp;CHeck News</p>\r\n', 1, '2021-01-27 16:12:47', '2021-01-27 16:12:47'),
(2, '<p>CHeck fdgdf</p>\r\n', '<p>CHeck News&nbsp;CHeck News&nbsp;CHeck News&nbsp;CHeck News&nbsp;CHeck News&nbsp;CHeck News&nbsp;CHeck News</p>\r\n', 1, '2021-01-27 16:12:47', '2021-01-27 16:12:47'),
(3, '<p>CHeck fdgdfgdf</p>\r\n', '<p>CHeck News&nbsp;CHeck News&nbsp;CHeck News&nbsp;CHeck News&nbsp;CHeck News&nbsp;CHeck News&nbsp;CHeck News</p>\r\n', 1, '2021-01-27 16:12:47', '2021-01-27 16:12:47'),
(4, '<p>Sanvid Launch</p>\r\n', '<p>Sanvid</p>\r\n', 1, '2021-01-27 17:31:25', '2021-01-27 17:31:25');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_office_location`
--

CREATE TABLE `hrms_office_location` (
  `location_id` int(11) NOT NULL,
  `company_id` int(111) NOT NULL,
  `location_head` int(111) NOT NULL,
  `location_manager` int(111) NOT NULL,
  `location_name` varchar(200) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `fax` varchar(255) NOT NULL,
  `address_1` text NOT NULL,
  `address_2` text NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `country` int(111) NOT NULL,
  `added_by` int(111) NOT NULL,
  `created_at` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_office_location`
--

INSERT INTO `hrms_office_location` (`location_id`, `company_id`, `location_head`, `location_manager`, `location_name`, `email`, `phone`, `fax`, `address_1`, `address_2`, `city`, `state`, `zipcode`, `country`, `added_by`, `created_at`, `status`) VALUES
(1, 17, 31, 31, 'indore', 'indore@gmail.com', '9876543210', '123', 'indore', 'indore', 'indore', 'mp', '452001', 99, 44, '04-05-2018', 1),
(2, 17, 44, 44, 'indore bhawarkua', 'ritika@infograins.com', '9876543210', '123', 'indore', 'indore', 'indore', 'mp', '452001', 99, 44, '04-05-2018', 1),
(3, 18, 54, 54, 'indore', 'ritika@gmail.com', '9876543210', '123456', 'indore2', 'indore', 'indore', 'madhya pradesh', '45001', 99, 54, '04-05-2018', 1),
(4, 19, 55, 55, 'indore bhawarkua', 'infograins@gmail.com', '9876543210', '9876543210', 'indore', 'indore', 'indore', 'mp', '452001', 99, 55, '05-05-2018', 1),
(5, 19, 55, 0, 'infograins choithram mandi', 'infograins@gmail.com', '9876543210', '9876543210', 'indore', 'indore', 'indore', 'mp', '452001', 99, 55, '05-05-2018', 1),
(6, 20, 56, 56, 'infograins', 'ritika@infograins.com', '9876543210', '', 'indore', 'indore', 'indore', 'mp', '452001', 99, 31, '05-05-2018', 1),
(7, 20, 56, 56, 'info bhwarkua', 'info@infograins.com', '9876543210', '123456', 'indore2', 'indore', 'indore', 'mp', '452001', 99, 56, '05-05-2018', 1),
(8, 21, 59, 59, 'infograins', 'ritika@infograins.com', '9876543210', '', 'indore', 'indore', 'indore', 'mp', '452001', 99, 31, '05-05-2018', 1),
(9, 21, 59, 59, 'info bhwarkua', 'ritika@gmail.com', '9876543210', '123456', 'indore2', 'indore', 'indore', 'mp', '452001', 99, 59, '05-05-2018', 1),
(10, 22, 63, 63, 'IlinkHr', 'ilinkhr@yopmail.com', '9826666666', '', 'geeta bhawan indore ', '', 'indore', 'mp', '452001', 2, 31, '07-05-2018', 1),
(11, 23, 65, 65, 'test company', 'test12@yopmail.com', '9876543210', '', 'indore', 'indore', 'indore', 'mp', '452001', 99, 31, '09-05-2018', 1),
(12, 24, 73, 73, 'Infograins Software SOlutions Private Limited', 'ajayshuklak@gmail.com', '9713406272', '', '403 RADHE RADHE APARTMENT', 'SHREE KRISHNA AVENUE', 'Indore', 'Madhya Pradesh', '452001', 99, 31, '15-06-2019', 1),
(13, 25, 74, 74, 'InfoGrains TEST Team', 'gunjanrajput@infograins.com', '145sasasasas', '', 'Krishna Tower 202 beaf agd dggadhg dh agdhjd', '', 'indore', 'mp', '452001', 99, 31, '17-06-2019', 1),
(14, 26, 75, 75, 'InfoGrains TEST Team', 'gunjanrajput@infograins.com', '145sasasasas', '', 'Krishna Tower 202 beaf agd dggadhg dh agdhjd', '', 'indore', 'mp', '452001', 99, 31, '17-06-2019', 1),
(15, 27, 76, 76, 'Testing Company', 'gunjanrajput@infograins.com', '3265987444', '', 'Added new address for test', '', 'indore2', 'madhya pradesh', '452001', 92, 31, '17-06-2019', 1),
(16, 28, 77, 77, 'Test', 'raj@gmail.com', '9876543211', '', 'Test 101 ghag ahgd ghdgahgdad', '', 'inodwewe', '', '452001', 13, 31, '17-06-2019', 1),
(17, 29, 78, 78, 'Testing Company', 'gunjanrajput@infograins.com', '3265987444', '', 'Added new address for test', '', 'indore11', '', '452001', 5, 31, '17-06-2019', 1),
(18, 30, 79, 79, 'Testing Company', 'gunjanrajput@infograins.com', '3265987444', '', 'Added new address for test', '', 'indore11', '', '452001', 5, 31, '17-06-2019', 1),
(19, 31, 80, 80, 'Testing Rule Name', 'rajputgunjan@gmail.com', '98765432121', '', 'test 101', '', 'Indore', 'mp', '452011', 99, 31, '17-06-2019', 1),
(20, 31, 80, 80, 'HBD', 'hbd@gmail.com', '32114564546', '', 'Krishna tower testing', 'ass assas', 'HBD', 'HBD', '542110', 99, 80, '17-06-2019', 1),
(21, 31, 80, 80, 'gdg', 'gdgdgd@gmail.com', 'gdgddg', '', 'gdgdg', 'gdg', 'pune', 'M', '452001', 99, 80, '17-06-2019', 1),
(22, 32, 81, 81, 'infograins1', 'info1@yopmail.com', '1234567892', '', 'krishnatower indore', 'indore', 'indore', 'mp', '452001', 99, 31, '17-06-2019', 1),
(23, 33, 82, 82, 'TestingNew', 'rajptest@gmail.com', '321658555', '', 'test 101jhdad', '', 'pune', 'MH', '452111', 99, 31, '17-06-2019', 1),
(24, 33, 82, 82, 'Loc-1', 'loc@gmail.com', '975431111', '', '', '', 'pune', 'MH', '542111', 99, 82, '17-06-2019', 1),
(25, 33, 82, 82, 'Loc-2', 'loc2@gmail.com', '698478787', '', 'Testing loc 2', '', 'pune', 'MH', '4521000', 99, 82, '17-06-2019', 1),
(26, 34, 83, 83, 'neetesh', 'neetesh@yopmail.com', '9874563210', '', 'bangali square', '', 'indore', 'mp', '452001', 99, 31, '20-06-2019', 1),
(27, 35, 84, 84, 'neetesh', 'shrya@yopmail.com', '9874563210', '', 'bangali square', '', 'indore', 'mp', '452001', 99, 31, '20-06-2019', 1),
(28, 36, 85, 85, 'neetesh', 'shrya@yopmail.com', '9874563210', '', 'bangali square', '', 'indore', 'mp', '452001', 99, 31, '20-06-2019', 1),
(29, 37, 86, 86, 'neetesh', 'shrya@yopmail.com', '9874563210', '', 'bangali square', '', 'indore', 'mp', '452001', 99, 31, '20-06-2019', 1),
(30, 38, 87, 87, 'dfdgdgdgd', 'neetesh@yopmail.com', '9874563210', '', 'bangali square', '', 'indore', 'mp', '452001', 99, 31, '20-06-2019', 1),
(31, 39, 88, 88, 'gdgdfgdgdgdgdgd', 'shrya@yopmail.com', '9874563210', '', 'bangali square', '', 'indore', 'mp', '452001', 99, 31, '20-06-2019', 1),
(32, 40, 89, 89, 'gdgdfgdgdgdgdgd', 'neetesh@yopmail.com', '9874563210', '', 'bangali square', '', 'indore', 'mp', '452001', 99, 31, '20-06-2019', 1),
(33, 41, 90, 90, 'gdgdfgdgdgdgdgd', 'shrya@yopmail.com', '9874563210', '', 'bangali square', '', 'indore', 'mp', '452001', 99, 31, '20-06-2019', 1),
(34, 42, 91, 91, 'gdgdfgdgdgdgdgd', 'neetesh@yopmail.com', '9874563210', '', 'bangali square', '', 'indore', 'mp', '452001', 99, 31, '20-06-2019', 1),
(35, 48, 98, 98, 'Tata Consultancy services', 'rashmik1205@gmail.com', '9713406272', '', '403 RADHE RADHE APARTMENT', 'SHREE KRISHNA AVENUE', 'Indore', 'Madhya Pradesh', '452001', 99, 31, '10-07-2019', 1),
(36, 53, 103, 103, 'Brijraj firm', 'ajayshuklak@gmail.com', '9713406272', '', '403 Radhe Radhe apartment', 'Shree Krishna Avenue phase 3', 'Indoe', 'Madhya Pradesh', '452001', 99, 31, '17-07-2019', 1),
(37, 54, 104, 104, 'codereadysoftware', 'metro@infograins.com', '9713688425', '', 'Metro tower 7th floor', '', 'Bhopal', 'MP', '452001', 99, 31, '17-07-2019', 1),
(38, 55, 105, 105, 'infograins', 'Testing1@yopmail.com', '878784545454', '', 'indore', '', 'Indore', 'Madhya Pradesh', '452001', 99, 31, '17-07-2019', 1),
(39, 56, 106, 106, 'Info', 'pankajverma@infograins.com', '98109328133', '', 'indore', 'indore', 'Indore', 'Madhya Pradesh', '452001', 99, 31, '17-07-2019', 1),
(40, 57, 107, 107, 'infograins', 'Dk@yopmail.com', '98109328133', '', 'indore', '', 'Indore', 'Madhya Pradesh', '452001', 99, 31, '17-07-2019', 1),
(41, 58, 108, 108, 'company', 'dk@yopmail.com', '1234567890', '', 'chennnai', '', 'Bhopal', '', '741258', 99, 31, '17-07-2019', 1),
(42, 59, 109, 109, 'Infograins Software Solutions Pvt Ltd ', 'hr@infograins.com', '9770477239', '', ' Krishna Tower, 208, 2nd Floor, OPP. Scheme-140, Main Rd, Pipliyahana, Indore, Madhya Pradesh 452016', '', 'indore', 'madhyapradesh', '452009', 99, 31, '17-07-2019', 1),
(43, 21, 60, 60, 'janjeerwala', 'hr@mavencluster.com', '0731 409 4348', '', 'check', '', 'Indore', '', '', 99, 59, '18-07-2019', 1),
(44, 60, 110, 110, 'jeet', 'admin@admin.com', '0', '', 'tl, ', 'mkbn', 'b,b', 'b,h', '13254', 19, 31, '19-07-2019', 1),
(46, 60, 110, 110, 'Kisanveg India Pvt Ltd', 'ajay@kisanveg.com', '9977611436', '', '208 Krishna Tower Indore, Madhya pradesh', 'Phase 1,:imbodi', 'MP', 'Madhya Pradesh', '452001', 99, 31, '09-11-2020', 1),
(47, 61, 111, 111, 'Kisanveg India Pvt Ltd', 'ajay@kisanveg.com', '9977611436', '', '208 Krishna Tower Indore, Madhya pradesh', 'Phase 1,:imbodi', 'MP', 'Madhya Pradesh', '452001', 99, 31, '09-11-2020', 1),
(48, 21, 116, 116, 'krishna tower', 'neetesha@yopmail.com', '8654644465', '54245635', 'Indore', '', 'indore', 'MP', '123456', 99, 59, '09-11-2020', 1),
(49, 62, 117, 117, 'test', 'neetesha@yopmail.com', '98765756464', '', 'Indore', '', 'indore', 'MP', '123456', 99, 31, '09-11-2020', 1),
(50, 63, 118, 118, 'test', 'neetesha@yopmail.com', '98765756464', '', 'Indore', '', 'indore', 'MP', '123456', 99, 31, '09-11-2020', 1),
(51, 67, 120, 120, 'wrrweew', 'neetesha@yopmail.com', '56546464646', '', 'Indore', '', 'indore', 'MP', '123456', 99, 31, '09-11-2020', 1),
(52, 68, 121, 121, 'wrrweew', 'neetesha@yopmail.com', '56546464646', '', 'Indore', '', 'indore', 'MP', '123456', 99, 31, '09-11-2020', 1),
(53, 21, 60, 60, 'vijay nagar', 'asd@gmail.com', '6546565665', '456456546', 'dfgdfgd', 'dfsdf', 'bhopal', 'Madhya Pradesh', '462001', 99, 59, '12-11-2020', 1),
(54, 1, 31, 31, 'indore', 'indore@gmail.com', '9876543210', '123', 'indore', 'indore', 'indore', 'mp', '452001', 99, 44, '04-05-2018', 1),
(55, 0, 0, 0, 'Bhopal', 'ap@yopmail.com', '1234567890', '', 'area colony bhopal', '', '', '', '', 0, 0, '', 1),
(56, 0, 0, 0, 'janjeerwala', 'hr@mavencluster.com', '0731 409 4348', '', 'bhopal', '', '', '', '', 0, 0, '', 1),
(57, 0, 0, 0, 'janjeerwala', 'hr@mavencluster.com', '0731 409 4348', '', 'check', '', '', '', '', 0, 0, '', 1),
(58, 0, 0, 0, 'Dubai', 'dubai@infograins.com', '123456789012', '', 'Dubai Dubai', '', '', '', '', 0, 0, '', 1),
(59, 0, 0, 0, 'Dubai', 'dubai@infograins.com', '123456789012', '', 'Dubai Dubai', '', '', '', '', 0, 0, '', 1),
(60, 0, 0, 0, 'USA', 'usa@yopmail.com', '4567891230', '', 'TYest', '', '', '', '', 0, 0, '', 1),
(61, 0, 0, 0, 'Aarav Solutions Ahmedabad', 'sales@aarav.com', '9770323832', '', 'Titanium Hieghts', '', '', '', '', 0, 0, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hrms_office_shift`
--

CREATE TABLE `hrms_office_shift` (
  `office_shift_id` int(111) NOT NULL,
  `shift_name` varchar(255) NOT NULL,
  `company_id` int(11) NOT NULL,
  `default_shift` int(111) NOT NULL,
  `monday_in_time` varchar(222) NOT NULL,
  `monday_out_time` varchar(222) NOT NULL,
  `tuesday_in_time` varchar(222) NOT NULL,
  `tuesday_out_time` varchar(222) NOT NULL,
  `wednesday_in_time` varchar(222) NOT NULL,
  `wednesday_out_time` varchar(222) NOT NULL,
  `thursday_in_time` varchar(222) NOT NULL,
  `thursday_out_time` varchar(222) NOT NULL,
  `friday_in_time` varchar(222) NOT NULL,
  `friday_out_time` varchar(222) NOT NULL,
  `saturday_in_time` varchar(222) NOT NULL,
  `saturday_out_time` varchar(222) NOT NULL,
  `sunday_in_time` varchar(222) NOT NULL,
  `sunday_out_time` varchar(222) NOT NULL,
  `created_at` varchar(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_office_shift`
--

INSERT INTO `hrms_office_shift` (`office_shift_id`, `shift_name`, `company_id`, `default_shift`, `monday_in_time`, `monday_out_time`, `tuesday_in_time`, `tuesday_out_time`, `wednesday_in_time`, `wednesday_out_time`, `thursday_in_time`, `thursday_out_time`, `friday_in_time`, `friday_out_time`, `saturday_in_time`, `saturday_out_time`, `sunday_in_time`, `sunday_out_time`, `created_at`) VALUES
(1, 'morning', 17, 0, '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', ''),
(2, 'morning', 18, 0, '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '2018-05-04 19:53:49'),
(3, 'morning', 19, 0, '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '2018-05-05 11:56:06'),
(4, 'morning', 20, 0, '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '2018-05-05 15:20:48'),
(5, 'morning', 21, 0, '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '2018-05-05 15:36:27'),
(6, 'morning', 22, 0, '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '2018-05-07 17:54:48'),
(7, 'morning', 23, 0, '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '2018-05-09 11:03:33'),
(8, 'morning', 24, 0, '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '2019-06-15 19:15:27'),
(9, 'morning', 25, 0, '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '2019-06-17 11:41:09'),
(10, 'morning', 26, 0, '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '2019-06-17 11:41:35'),
(11, 'morning', 27, 0, '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '2019-06-17 11:54:37'),
(12, 'morning', 28, 0, '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '2019-06-17 11:58:13'),
(13, 'morning', 29, 0, '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '2019-06-17 12:05:28'),
(14, 'morning', 30, 0, '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '2019-06-17 12:05:52'),
(15, 'morning', 31, 0, '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '2019-06-17 12:17:15'),
(16, 'morning', 32, 0, '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '2019-06-17 12:57:17'),
(17, 'morning', 33, 0, '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '2019-06-17 13:20:31'),
(18, 'Morning 1', 33, 0, '08:35', '03:15', '09:15', '08:12', '08:59', '04:20', '', '', '', '', '', '', '', '', '2019-06-17'),
(19, 'AfterNoon', 21, 0, '09:15', '08:24', '', '', '', '', '', '', '', '', '', '', '', '', '2019-06-17'),
(20, 'morning', 34, 0, '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '2019-06-20 11:09:43'),
(21, 'morning', 35, 0, '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '2019-06-20 11:18:47'),
(22, 'morning', 36, 0, '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '2019-06-20 11:21:52'),
(23, 'morning', 37, 0, '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '2019-06-20 11:31:39'),
(24, 'morning', 38, 0, '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '2019-06-20 11:33:50'),
(25, 'morning', 39, 0, '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '2019-06-20 11:54:29'),
(26, 'morning', 40, 0, '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '2019-06-20 11:58:42'),
(27, 'morning', 41, 0, '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '2019-06-20 12:00:35'),
(28, 'morning', 42, 0, '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '2019-06-20 12:04:51'),
(29, 'morning', 48, 0, '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '2019-07-10 20:46:29'),
(30, 'morning', 53, 0, '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '2019-07-17 13:23:27'),
(31, 'morning', 54, 0, '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '2019-07-17 15:41:43'),
(32, 'morning', 55, 0, '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '2019-07-17 15:44:23'),
(33, 'morning', 56, 0, '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '2019-07-17 15:49:38'),
(34, 'morning', 57, 0, '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '2019-07-17 15:59:42'),
(35, 'morning', 58, 0, '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '2019-07-17 16:39:15'),
(36, 'morning', 59, 0, '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '2019-07-17 17:31:36'),
(37, 'morning', 60, 0, '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '2019-07-19 15:06:35'),
(38, 'morning', 60, 0, '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '2020-11-09 12:09:19'),
(39, 'morning', 61, 0, '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '2020-11-09 12:10:24'),
(40, 'morning', 62, 0, '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '2020-11-09 18:19:08'),
(41, 'morning', 63, 0, '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '2020-11-09 18:20:22'),
(42, 'morning', 67, 0, '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '2020-11-09 18:36:11'),
(43, 'morning', 68, 0, '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '09:00', '17:00', '2020-11-09 18:36:52');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_payment_method`
--

CREATE TABLE `hrms_payment_method` (
  `payment_method_id` int(111) NOT NULL,
  `method_name` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_payment_method`
--

INSERT INTO `hrms_payment_method` (`payment_method_id`, `method_name`, `created_at`) VALUES
(10, 'Cash', '24-02-2017'),
(11, 'Credit Card', '24-02-2017'),
(12, 'Bank', '24-02-2017'),
(13, 'Visa Debit Cart', '24-02-2017'),
(14, 'Online', '24-02-2017'),
(15, 'By Hand', '24-02-2017');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_performance_appraisal`
--

CREATE TABLE `hrms_performance_appraisal` (
  `performance_appraisal_id` int(111) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `appraisal_year_month` varchar(255) NOT NULL,
  `customer_experience` int(111) NOT NULL,
  `marketing` int(111) NOT NULL,
  `management` int(111) NOT NULL,
  `administration` int(111) NOT NULL,
  `presentation_skill` int(111) NOT NULL,
  `quality_of_work` int(111) NOT NULL,
  `efficiency` int(111) NOT NULL,
  `integrity` int(111) NOT NULL,
  `professionalism` int(111) NOT NULL,
  `team_work` int(111) NOT NULL,
  `critical_thinking` int(111) NOT NULL,
  `conflict_management` int(111) NOT NULL,
  `attendance` int(111) NOT NULL,
  `ability_to_meet_deadline` int(111) NOT NULL,
  `remarks` text NOT NULL,
  `added_by` int(111) NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hrms_performance_indicator`
--

CREATE TABLE `hrms_performance_indicator` (
  `performance_indicator_id` int(111) NOT NULL,
  `designation_id` int(111) NOT NULL,
  `customer_experience` int(111) NOT NULL,
  `marketing` int(111) NOT NULL,
  `management` int(111) NOT NULL,
  `administration` int(111) NOT NULL,
  `presentation_skill` int(111) NOT NULL,
  `quality_of_work` int(111) NOT NULL,
  `efficiency` int(111) NOT NULL,
  `integrity` int(111) NOT NULL,
  `professionalism` int(111) NOT NULL,
  `team_work` int(111) NOT NULL,
  `critical_thinking` int(111) NOT NULL,
  `conflict_management` int(111) NOT NULL,
  `attendance` int(111) NOT NULL,
  `ability_to_meet_deadline` int(111) NOT NULL,
  `added_by` int(111) NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hrms_projects`
--

CREATE TABLE `hrms_projects` (
  `project_id` int(111) NOT NULL,
  `title` varchar(255) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `start_date` varchar(255) NOT NULL,
  `end_date` varchar(255) NOT NULL,
  `company_id` int(111) NOT NULL,
  `head_of_project` int(11) NOT NULL,
  `assigned_to` text NOT NULL,
  `priority` varchar(255) NOT NULL,
  `cost` bigint(20) NOT NULL DEFAULT '0',
  `summary` text NOT NULL,
  `description` text NOT NULL,
  `added_by` int(111) NOT NULL,
  `project_progress` varchar(255) NOT NULL,
  `status` tinyint(2) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_projects`
--

INSERT INTO `hrms_projects` (`project_id`, `title`, `client_name`, `start_date`, `end_date`, `company_id`, `head_of_project`, `assigned_to`, `priority`, `cost`, `summary`, `description`, `added_by`, `project_progress`, `status`, `created_at`) VALUES
(1, 'hrms', 'hrms client', '2018-05-05', '2018-05-09', 21, 60, '61,62', '1', 5000, 'hrms', '&lt;p&gt;hii this is very important project&lt;br&gt;&lt;/p&gt;', 59, '35', 0, '2018-05-05'),
(2, 'HR Software', 'HR', '2019-06-17', '2019-06-30', 33, 82, '82', '1', 520000, 'test tetsasas', '&lt;p&gt;asasas dadad&lt;/p&gt;', 82, '0', 0, '2019-06-17'),
(3, 'Testing QA', 'asasas', '2019-06-17', '2019-06-30', 21, 59, '62', '1', 5367523, 'sasas', '&lt;p&gt;as agh ghasj ajsas&lt;/p&gt;&lt;p&gt;&lt;/p&gt;&lt;ol&gt;&lt;li&gt;gagshh aas&lt;/li&gt;&lt;li&gt;ajgsjas&lt;/li&gt;&lt;li&gt;skjahsa&lt;/li&gt;&lt;li&gt;skah sas&lt;/li&gt;&lt;/ol&gt;&lt;p&gt;&lt;/p&gt;', 59, '25', 1, '2019-06-17'),
(4, 'Infograins Software Solutions Pvt Ltd', 'Stanley', '2019-07-10', '2019-07-18', 47, 97, '97', '1', 60, 'Hello Please do that ASPA', '&lt;p&gt;&lt;br&gt;&lt;/p&gt;', 97, '0', 0, '2019-07-10'),
(5, 'HRmanagement', 'Ayushi', '2019-07-18', '2019-08-15', 21, 61, '62', '1', 150000, 'hello how are you', '&lt;p&gt;Hello looking for the software&lt;/p&gt;', 59, '0', 0, '2019-07-17'),
(7, '100000', '100000', '2020-11-02', '2020-11-30', 21, 60, '60,61,62,116,123', '1', 1200, 'Project for testing the tool', '&lt;p&gt;Project 1 for testing the tool&lt;/p&gt;', 59, '0', 1, '2020-11-12');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_qualification_education_level`
--

CREATE TABLE `hrms_qualification_education_level` (
  `education_level_id` int(111) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_qualification_education_level`
--

INSERT INTO `hrms_qualification_education_level` (`education_level_id`, `name`, `created_at`) VALUES
(1, 'High School Diploma / GED', '28-04-2017'),
(2, 'Associate Degree', '28-04-2017'),
(3, 'Graduate', '28-04-2017'),
(4, 'Post Graduate', '28-04-2017'),
(5, 'Doctorate', '28-04-2017');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_qualification_language`
--

CREATE TABLE `hrms_qualification_language` (
  `language_id` int(111) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_qualification_language`
--

INSERT INTO `hrms_qualification_language` (`language_id`, `name`, `created_at`) VALUES
(1, 'English', '28-04-2017'),
(2, 'French', '28-04-2017'),
(3, 'Arabic', '28-04-2017'),
(4, 'Russian', '28-04-2017'),
(5, 'Spanish', '28-04-2017');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_qualification_skill`
--

CREATE TABLE `hrms_qualification_skill` (
  `skill_id` int(111) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_qualification_skill`
--

INSERT INTO `hrms_qualification_skill` (`skill_id`, `name`, `created_at`) VALUES
(1, 'PHP 4/5/6/7', '28-04-2017'),
(2, 'jQuery', '28-04-2017'),
(3, 'Ajax', '28-04-2017'),
(4, 'Magento', '28-04-2017'),
(5, 'CodeIgniter', '28-04-2017');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_salary_templates`
--

CREATE TABLE `hrms_salary_templates` (
  `salary_template_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `salary_grades` varchar(255) NOT NULL,
  `basic_salary` varchar(255) NOT NULL,
  `overtime_rate` varchar(255) NOT NULL,
  `house_rent_allowance` varchar(255) NOT NULL,
  `medical_allowance` varchar(255) NOT NULL,
  `travelling_allowance` varchar(255) NOT NULL,
  `dearness_allowance` varchar(255) NOT NULL,
  `security_deposit` varchar(255) NOT NULL,
  `provident_fund` varchar(255) NOT NULL,
  `tax_deduction` varchar(255) NOT NULL,
  `gross_salary` varchar(255) NOT NULL,
  `total_allowance` varchar(255) NOT NULL,
  `total_deduction` varchar(255) NOT NULL,
  `net_salary` varchar(255) NOT NULL,
  `added_by` int(111) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_salary_templates`
--

INSERT INTO `hrms_salary_templates` (`salary_template_id`, `company_id`, `salary_grades`, `basic_salary`, `overtime_rate`, `house_rent_allowance`, `medical_allowance`, `travelling_allowance`, `dearness_allowance`, `security_deposit`, `provident_fund`, `tax_deduction`, `gross_salary`, `total_allowance`, `total_deduction`, `net_salary`, `added_by`, `created_at`) VALUES
(1, 0, 'TL Salary', '20000', '100', '1000', '500', '1000', '1000', '1000', '1000', '1000', '23500', '3500', '3000', '20500', 1, '27-12-2017 02:04:23'),
(2, 0, 'HR Salary', '10000', '100', '1000', '500', '500', '500', '300', '1000', '500', '12500', '2500', '1800', '10700', 1, '02-01-2018 11:26:19'),
(3, 0, 'Test Template', '10000', '100', '1500', '500', '500', '1200', '100', '1500', '350', '13700', '3700', '1950', '11750', 1, '06-01-2018 11:53:02'),
(4, 0, 'Test Template', '12000', '', '', '', '', '', '', '', '', '12000', '0', '0', '12000', 1, '06-01-2018 12:57:38'),
(5, 0, 'dfsdf', 'dsfsdf', '', '', '', '', '', '', '', '', 'NaN', '0', '0', 'NaN', 1, '06-01-2018 01:03:32'),
(6, 21, 'new templete', '2000', '45', '45', '25', '23', '56', '55', '45', '25', '2149', '149', '125', '2024', 59, '05-05-2018 03:57:17'),
(7, 33, 'Pay First', '8000', '100', '500', '500', '500', '500', '500', '500', '1000', '10000', '2000', '2000', '8000', 82, '17-06-2019 03:42:26'),
(9, 21, 'test payroll', '5000', '200', '500', '600', '600', '500', '200', '300', '200', '7200', '2200', '700', '6500', 59, '12-12-2020 02:03:27');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_support_tickets`
--

CREATE TABLE `hrms_support_tickets` (
  `ticket_id` int(11) NOT NULL,
  `ticket_code` varchar(200) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `compny_id` int(11) DEFAULT NULL,
  `ticket_priority` varchar(255) NOT NULL,
  `department_id` int(111) NOT NULL,
  `assigned_to` text NOT NULL,
  `message` text NOT NULL,
  `description` text NOT NULL,
  `ticket_remarks` text NOT NULL,
  `ticket_status` varchar(200) NOT NULL COMMENT '1=open,2=close',
  `ticket_note` text NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `modified_at` varchar(100) DEFAULT NULL,
  `comment` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_support_tickets`
--

INSERT INTO `hrms_support_tickets` (`ticket_id`, `ticket_code`, `subject`, `employee_id`, `compny_id`, `ticket_priority`, `department_id`, `assigned_to`, `message`, `description`, `ticket_remarks`, `ticket_status`, `ticket_note`, `created_at`, `modified_at`, `comment`) VALUES
(1, 'S6E5UBJ', 'device issue', 62, 21, '2', 0, '', '', 'Bdbhdhdhhfjfkd', '', '2', '', '2018-05-05 16:40:07', '2018-05-07 14:49:08', 'your comment...lerlddlg'),
(2, 'HL3RAB8', 'hdhdb', 61, 21, '2', 0, '', '', 'Gdhdhhd', '', '1', '', '2018-05-07 11:00:17', '2018-05-07 14:03:53', 'hiii'),
(3, 'LCSSMOK', 'hdhdhxhhchfh', 62, 21, '3', 0, '', '', 'Ritika man', '', '1', '', '2018-05-07 13:26:39', '2018-05-07 13:27:11', 'your comment...dkmdkldm'),
(4, 'OJ1S837', 'bjhjbjhbjhbhj', 61, 21, '2', 0, '', '', 'bhbhubhbubub', '', '1', '', '2018-05-07 16:26:48', NULL, NULL),
(5, 'JAZ99OG', 'Demande d\'attestation', 62, 21, '', 0, '', '', '&lt;p&gt;Bonjour,&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;J4ai un besoin urgent d\\&#039;attestation.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;Cordialement,&lt;/p&gt;&lt;p&gt;Ajay&lt;br&gt;&lt;/p&gt;', '', '1', '', '10-05-2018 11:48:37', NULL, NULL),
(6, '6UL273N', 'Sim woth Internet', 62, 21, '', 0, '', '', '&lt;p&gt;&lt;br&gt;&lt;/p&gt;', '', '1', '', '15-06-2019 07:07:57', NULL, NULL),
(7, 'C6XRIUG', 'Genertaedd dsdsd', 82, 33, '', 0, '', '', 'dsdsdsdsd', '', '1', '', '17-06-2019 03:49:58', NULL, NULL),
(8, 'LN6U4SY', 'New Device issue ', 62, 21, '', 0, '', '', '&lt;p&gt;&lt;br&gt;&lt;/p&gt;', '', '1', '', '17-06-2019 04:05:32', NULL, NULL),
(9, 'KEB219O', ' bvvbvb', 60, 21, '', 0, '', '', 'vcbvcb', '', '1', '', '09-11-2020 12:02:51', NULL, NULL),
(10, 'AXRI80B', 'gfdfg', 59, 21, '', 0, '', '', '&lt;p&gt;dsfdsfds&lt;/p&gt;', '', '1', '', '09-11-2020 12:05:36', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hrms_support_ticket_files`
--

CREATE TABLE `hrms_support_ticket_files` (
  `ticket_file_id` int(111) NOT NULL,
  `ticket_id` int(111) NOT NULL,
  `employee_id` int(111) NOT NULL,
  `ticket_files` varchar(255) NOT NULL,
  `file_size` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hrms_survey`
--

CREATE TABLE `hrms_survey` (
  `survey_id` int(11) NOT NULL,
  `title` varchar(500) NOT NULL,
  `description` varchar(10000) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hrms_survey_answers`
--

CREATE TABLE `hrms_survey_answers` (
  `answer_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `survey_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer` varchar(1000) NOT NULL,
  `craeted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hrms_survey_question`
--

CREATE TABLE `hrms_survey_question` (
  `question_id` int(11) NOT NULL,
  `survey_id` int(11) NOT NULL,
  `question` varchar(1000) NOT NULL,
  `answer_type` varchar(100) NOT NULL,
  `answer_options` varchar(10000) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hrms_system_setting`
--

CREATE TABLE `hrms_system_setting` (
  `setting_id` int(111) NOT NULL,
  `application_name` varchar(255) NOT NULL,
  `default_currency` varchar(255) NOT NULL,
  `default_currency_symbol` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `show_currency` varchar(255) NOT NULL,
  `currency_position` varchar(255) NOT NULL,
  `notification_position` varchar(255) NOT NULL,
  `notification_close_btn` varchar(255) NOT NULL,
  `notification_bar` varchar(255) NOT NULL,
  `enable_registration` varchar(255) NOT NULL,
  `login_with` varchar(255) NOT NULL,
  `date_format_xi` varchar(255) NOT NULL,
  `employee_manage_own_contact` varchar(255) NOT NULL,
  `employee_manage_own_profile` varchar(255) NOT NULL,
  `employee_manage_own_qualification` varchar(255) NOT NULL,
  `employee_manage_own_work_experience` varchar(255) NOT NULL,
  `employee_manage_own_document` varchar(255) NOT NULL,
  `employee_manage_own_picture` varchar(255) NOT NULL,
  `employee_manage_own_social` varchar(255) NOT NULL,
  `employee_manage_own_bank_account` varchar(255) NOT NULL,
  `enable_attendance` varchar(255) NOT NULL,
  `enable_clock_in_btn` varchar(255) NOT NULL,
  `enable_email_notification` varchar(255) NOT NULL,
  `payroll_include_day_summary` varchar(255) NOT NULL,
  `payroll_include_hour_summary` varchar(255) NOT NULL,
  `payroll_include_leave_summary` varchar(255) NOT NULL,
  `enable_job_application_candidates` varchar(255) NOT NULL,
  `job_logo` varchar(255) NOT NULL,
  `payroll_logo` varchar(255) NOT NULL,
  `enable_profile_background` varchar(255) NOT NULL,
  `enable_policy_link` varchar(255) NOT NULL,
  `enable_layout` varchar(255) NOT NULL,
  `job_application_format` text NOT NULL,
  `project_email` varchar(255) NOT NULL,
  `holiday_email` varchar(255) NOT NULL,
  `leave_email` varchar(255) NOT NULL,
  `payslip_email` varchar(255) NOT NULL,
  `award_email` varchar(255) NOT NULL,
  `recruitment_email` varchar(255) NOT NULL,
  `announcement_email` varchar(255) NOT NULL,
  `training_email` varchar(255) NOT NULL,
  `task_email` varchar(255) NOT NULL,
  `compact_sidebar` varchar(255) NOT NULL,
  `fixed_header` varchar(255) NOT NULL,
  `fixed_sidebar` varchar(255) NOT NULL,
  `boxed_wrapper` varchar(255) NOT NULL,
  `layout_static` varchar(255) NOT NULL,
  `system_skin` varchar(255) NOT NULL,
  `animation_effect` varchar(255) NOT NULL,
  `animation_effect_modal` varchar(255) NOT NULL,
  `animation_effect_topmenu` varchar(255) NOT NULL,
  `footer_text` varchar(255) NOT NULL,
  `enable_page_rendered` varchar(255) NOT NULL,
  `enable_current_year` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_system_setting`
--

INSERT INTO `hrms_system_setting` (`setting_id`, `application_name`, `default_currency`, `default_currency_symbol`, `show_currency`, `currency_position`, `notification_position`, `notification_close_btn`, `notification_bar`, `enable_registration`, `login_with`, `date_format_xi`, `employee_manage_own_contact`, `employee_manage_own_profile`, `employee_manage_own_qualification`, `employee_manage_own_work_experience`, `employee_manage_own_document`, `employee_manage_own_picture`, `employee_manage_own_social`, `employee_manage_own_bank_account`, `enable_attendance`, `enable_clock_in_btn`, `enable_email_notification`, `payroll_include_day_summary`, `payroll_include_hour_summary`, `payroll_include_leave_summary`, `enable_job_application_candidates`, `job_logo`, `payroll_logo`, `enable_profile_background`, `enable_policy_link`, `enable_layout`, `job_application_format`, `project_email`, `holiday_email`, `leave_email`, `payslip_email`, `award_email`, `recruitment_email`, `announcement_email`, `training_email`, `task_email`, `compact_sidebar`, `fixed_header`, `fixed_sidebar`, `boxed_wrapper`, `layout_static`, `system_skin`, `animation_effect`, `animation_effect_modal`, `animation_effect_topmenu`, `footer_text`, `enable_page_rendered`, `enable_current_year`, `updated_at`) VALUES
(1, 'InfograinsHRMS', 'AUD - $', 'AUD - $', 'symbol', 'Prefix', 'toast-bottom-right', 'true', 'true', 'no', 'username', 'd-M-Y', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'job_logo_1513941215.png', 'payroll_logo_1513941207.png', 'yes', 'yes', 'yes', 'doc,docx,jpeg,jpg,pdf,txt,excel', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', '', 'fixed-header', 'fixed-sidebar', '', '', 'skin-4', 'fadeInDown', 'pulse', 'pulse', 'InfograinsHRMS', 'yes', 'yes', '2017-05-09 04:27:32');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_tasks`
--

CREATE TABLE `hrms_tasks` (
  `task_id` int(11) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `created_by` int(111) NOT NULL,
  `task_name` varchar(255) NOT NULL,
  `task_code` varchar(10) NOT NULL COMMENT 'suggested 3-5 characters',
  `assigned_to` varchar(255) NOT NULL,
  `company_id` int(11) NOT NULL,
  `start_date` varchar(200) NOT NULL,
  `expected_end_date` varchar(100) NOT NULL,
  `end_date` varchar(200) NOT NULL,
  `task_hour` varchar(200) NOT NULL,
  `task_progress` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `task_status` varchar(255) DEFAULT NULL,
  `assign_to` varchar(255) NOT NULL,
  `task_note` text NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_tasks`
--

INSERT INTO `hrms_tasks` (`task_id`, `client_name`, `project_name`, `created_by`, `task_name`, `task_code`, `assigned_to`, `company_id`, `start_date`, `expected_end_date`, `end_date`, `task_hour`, `task_progress`, `description`, `task_status`, `assign_to`, `task_note`, `created_at`) VALUES
(1, '2', '3', 0, 'check task', '#fdsf', '', 0, '', '', '', '', '', '', 'billing', '23', 'dfgdfgdfgdf', ''),
(2, '1', '4', 0, 'check task', 'Task45', '', 0, '', '', '', '', '', '', 'billing', '11', 'check                                      \r\n                                    ', ''),
(3, '1', '4', 0, 'First Module', 'T#12', '', 0, '', '', '', '', '', '', 'billing', '23', 'dfgdfgdf', ''),
(4, '5', '5', 0, 'check task', 'Task457', '', 0, '', '', '', '', '', '', 'billing', '23', 'ffdgdfgd                       \r\n                                    ', ''),
(5, '7', '6', 0, 'tK_1', '001', '', 0, '', '', '', '', '', '', 'billing', '23,27', '                                      \r\n              ascdfde                      ', ''),
(6, '5', '7', 0, 'UAT', 'UAT01', '', 0, '', '', '', '', '', '', 'billing', '2,14', '                                      \r\n                                    ', ''),
(7, '5', '7', 0, 'UAT', 'UAT01', '', 0, '', '', '', '', '', '', 'billing', '2,14', '                                      \r\n                                    ', ''),
(8, '5', '7', 0, 'UAT', 'UAT01', '', 0, '', '', '', '', '', '', 'billing', '2,14', '                                      \r\n                                    ', ''),
(9, '8', '8', 0, 'planning', 'gsp', '', 0, '', '', '', '', '', '', 'billing', '1,2,3,4', '                                      \r\n                                    ', ''),
(10, '1', '4', 0, 'demo', 'jdj', '', 0, '', '', '', '', '', '', 'billing', '1,2,3,4,6,8', '                                      \r\n         dfdf                          ', ''),
(11, '', '', 0, 'Testing', 'fdsfsdf', '', 0, '', '', '', '', '', '', 'non_billing', '2,4', ' gfhfghfg ', '');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_tasks_attachment`
--

CREATE TABLE `hrms_tasks_attachment` (
  `task_attachment_id` int(11) NOT NULL,
  `task_id` int(200) NOT NULL,
  `upload_by` int(255) NOT NULL,
  `file_title` varchar(255) NOT NULL,
  `file_description` text NOT NULL,
  `attachment_file` text NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_tasks_attachment`
--

INSERT INTO `hrms_tasks_attachment` (`task_attachment_id`, `task_id`, `upload_by`, `file_title`, `file_description`, `attachment_file`, `created_at`) VALUES
(53, 2, 3, '', '', 'task_15149783070.jpg', '2018-01-03 04:48:27'),
(70, 1, 3, '', '', 'task_15154146570.jpg', '2018-01-08 06:00:57'),
(71, 1, 3, '', '', 'task_15154146571.jpg', '2018-01-08 06:00:57'),
(75, 5, 10, '', '', 'task_15154992810.jpg', '2018-01-09 05:31:21'),
(76, 5, 10, '', '', 'task_15155000450.jpg', '2018-01-09 05:44:05'),
(77, 7, 1, '', '', 'task_15156780090.', '2018-01-11 07:10:09'),
(78, 8, 61, '', '', 'task_15255155860.jpg', '2018-05-05 03:49:46'),
(79, 9, 62, '', '', 'task_15255160230.jpg', '2018-05-05 03:57:03'),
(80, 10, 72, '', '', 'task_15258519400.jpg', '2018-05-09 01:15:40'),
(81, 10, 72, '', '', 'task_15258520840.jpg', '2018-05-09 01:18:04'),
(82, 15, 59, '', '', 'task_1605183561.png', '12-11-2020 05:49:20');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_tasks_comments`
--

CREATE TABLE `hrms_tasks_comments` (
  `comment_id` int(11) NOT NULL,
  `task_id` int(200) NOT NULL,
  `user_id` int(200) NOT NULL,
  `task_comments` text NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_tasks_comments`
--

INSERT INTO `hrms_tasks_comments` (`comment_id`, `task_id`, `user_id`, `task_comments`, `created_at`) VALUES
(1, 1, 59, 'good', '05-05-2018 04:18:32'),
(2, 1, 59, 'good work', '05-05-2018 04:23:37'),
(3, 14, 62, 'adde hgs ajssss', '17-06-2019 04:15:01'),
(4, 15, 59, 'ytryrtyt', '12-11-2020 05:48:32');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_tasks_query`
--

CREATE TABLE `hrms_tasks_query` (
  `tasks_query_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1=open.2=close',
  `query` varchar(10000) NOT NULL,
  `query_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` varchar(100) DEFAULT NULL,
  `comment` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_tasks_query`
--

INSERT INTO `hrms_tasks_query` (`tasks_query_id`, `employee_id`, `task_id`, `status`, `query`, `query_date`, `modified_at`, `comment`) VALUES
(1, 61, 8, 1, 'Coment here...chdhdhdhdjdjdjdududud', '2018-05-05 22:49:58', NULL, NULL),
(2, 62, 9, 21, 'I am not able to understand what should I do', '2018-05-05 22:57:35', '2018-05-07 14:13:26', 'hiii'),
(3, 62, 9, 1, 'Module description ', '2018-05-05 23:20:23', NULL, NULL),
(4, 62, 9, 1, 'Send description ', '2018-05-05 23:21:43', NULL, NULL),
(5, 62, 1, 21, 'Coment here...', '2018-05-05 23:22:24', '2018-05-07 14:16:41', 'hiii'),
(6, 72, 10, 1, 'Please tel me about the project ', '2018-05-09 20:16:08', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hrms_task_employee`
--

CREATE TABLE `hrms_task_employee` (
  `id` int(11) NOT NULL,
  `client_name` varchar(255) DEFAULT NULL,
  `project_name` varchar(255) DEFAULT NULL,
  `task_id` varchar(255) DEFAULT NULL,
  `employee` varchar(255) DEFAULT NULL,
  `cost` varchar(255) DEFAULT NULL,
  `hours` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_task_employee`
--

INSERT INTO `hrms_task_employee` (`id`, `client_name`, `project_name`, `task_id`, `employee`, `cost`, `hours`, `created_at`) VALUES
(1, '2', '3', '1', '23', '0', NULL, '2021-01-22 13:22:26'),
(2, '1', '4', '2', '11', '0', NULL, '2021-01-22 13:36:52'),
(3, '1', '4', '3', '23', '0', NULL, '2021-01-22 13:39:33'),
(4, '5', '5', '4', '23', '0', NULL, '2021-01-22 13:40:23'),
(5, '7', '6', '5', '23', '50000', '20', '2021-01-23 10:47:25'),
(6, '7', '6', '5', '27', '0', NULL, '2021-01-23 10:47:25'),
(7, '5', '7', '6', '2', '0', NULL, '2021-01-27 06:32:22'),
(8, '5', '7', '6', '14', '0', NULL, '2021-01-27 06:32:22'),
(9, '5', '7', '7', '2', '0', NULL, '2021-01-27 06:33:12'),
(10, '5', '7', '7', '14', '0', NULL, '2021-01-27 06:33:12'),
(11, '5', '7', '8', '2', '1000', '12', '2021-01-27 06:33:48'),
(12, '5', '7', '8', '14', '2000', '10', '2021-01-27 06:33:48'),
(13, '8', '8', '9', '1', '0', NULL, '2021-01-27 08:21:48'),
(14, '8', '8', '9', '2', '0', NULL, '2021-01-27 08:21:48'),
(15, '8', '8', '9', '3', '0', NULL, '2021-01-27 08:21:48'),
(16, '8', '8', '9', '4', '0', NULL, '2021-01-27 08:21:48'),
(17, '1', '4', '10', '1', '0', NULL, '2021-01-27 12:39:16'),
(18, '1', '4', '10', '2', '0', NULL, '2021-01-27 12:39:16'),
(19, '1', '4', '10', '3', '0', NULL, '2021-01-27 12:39:16'),
(20, '1', '4', '10', '4', '0', NULL, '2021-01-27 12:39:16'),
(21, '1', '4', '10', '6', '0', NULL, '2021-01-27 12:39:16'),
(22, '1', '4', '10', '8', '0', NULL, '2021-01-27 12:39:16'),
(23, '1', '4', '11', '2', '0', NULL, '2021-01-29 09:02:33'),
(24, '1', '4', '11', '4', '0', NULL, '2021-01-29 09:02:33');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_termination_type`
--

CREATE TABLE `hrms_termination_type` (
  `termination_type_id` int(111) NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_termination_type`
--

INSERT INTO `hrms_termination_type` (`termination_type_id`, `type`, `created_at`) VALUES
(1, 'Layoff', ''),
(2, 'Damaging Company Property', ''),
(3, 'Drug or Alcohol Possession at Work', ''),
(4, 'Falsifying Company Records', ''),
(5, 'Insubordination', ''),
(6, 'Misconduct', ''),
(7, 'Poor Performance', ''),
(8, 'Stealing', ''),
(9, 'Using Company Property for Personal Business', ''),
(10, 'Taking Too Much Time Off', ''),
(11, 'Violating Company Policy', ''),
(12, 'Voluntary Termination', ''),
(13, 'Involuntary Termination', ''),
(14, 'Discriminatory Conduct Towards others', ''),
(15, 'Harassment (Sexual and Otherwise)', '');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_throughofday`
--

CREATE TABLE `hrms_throughofday` (
  `id` int(11) NOT NULL,
  `heading` text,
  `description` text,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1=active,0=deactive',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_throughofday`
--

INSERT INTO `hrms_throughofday` (`id`, `heading`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Get Through of the', 'Get Through of the gfdgdfgfdgdf', 1, '2021-01-29 10:54:02', '2021-01-29 10:54:02');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_tickets_attachment`
--

CREATE TABLE `hrms_tickets_attachment` (
  `ticket_attachment_id` int(11) NOT NULL,
  `ticket_id` int(200) NOT NULL,
  `upload_by` int(255) NOT NULL,
  `file_title` varchar(255) NOT NULL,
  `file_description` text NOT NULL,
  `attachment_file` text NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hrms_tickets_comments`
--

CREATE TABLE `hrms_tickets_comments` (
  `comment_id` int(11) NOT NULL,
  `ticket_id` int(200) NOT NULL,
  `user_id` int(200) NOT NULL,
  `ticket_comments` text NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_tickets_comments`
--

INSERT INTO `hrms_tickets_comments` (`comment_id`, `ticket_id`, `user_id`, `ticket_comments`, `created_at`) VALUES
(1, 1, 62, 'will resolve', '05-05-2018 04:40:27'),
(2, 2, 61, 'fdsttd', '07-05-2018 12:44:53'),
(3, 2, 61, 'gdhddjdd', '07-05-2018 12:47:48'),
(4, 1, 62, 'ddghhhdfbdjxjhcjfjjfjdjjdujduryydyrh hdhchxhdjjfjjdjdjdjjdjxjbdbxjcjjdhxvbxhsjeurutidjcbbcuf hchdbbxhxhxhxucudbduxhrurhybdjcifbtj', '07-05-2018 03:59:29'),
(5, 2, 61, 'hhjhjhjh', '07-05-2018 04:19:46'),
(6, 2, 61, 'kjkjkj', '07-05-2018 04:21:42'),
(7, 2, 61, 'iiiiii', '07-05-2018 04:23:06'),
(8, 2, 61, 'hjkjkj', '07-05-2018 04:24:15'),
(9, 2, 61, 'archana', '07-05-2018 04:24:25'),
(10, 4, 61, 'fgklnhjkgnhjkgnhjk', '07-05-2018 04:27:08'),
(11, 4, 61, 'ttt', '07-05-2018 04:27:13'),
(12, 1, 62, 'hvgjjgfhgfhik', '13-05-2018 02:00:12'),
(14, 7, 82, 'Added commnet ahdadas', '17-06-2019 03:50:23'),
(15, 8, 59, 'Issue has been resolved', '17-06-2019 04:06:08'),
(16, 8, 62, 'Not fixed', '17-06-2019 04:06:44'),
(17, 1, 59, 'dfdsf', '09-11-2020 03:52:05');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_trainers`
--

CREATE TABLE `hrms_trainers` (
  `trainer_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `designation_id` int(111) NOT NULL,
  `expertise` text NOT NULL,
  `address` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_trainers`
--

INSERT INTO `hrms_trainers` (`trainer_id`, `first_name`, `last_name`, `contact_number`, `email`, `designation_id`, `expertise`, `address`, `status`, `created_at`) VALUES
(1, 'Barbara', 'Young', '123456789', 'barbara@testemail.com', 15, 'ADSDsdSddddwwsd&lt;p&gt;&lt;/p&gt;', 'Test Address', 1, '28-04-2017'),
(2, 'Hemant', 'Anjana', '8462014777', 'hemant@infograins.com', 16, '&lt;p&gt;PHP Developer&lt;/p&gt;&lt;p&gt;Javascript Developer&lt;/p&gt;', 'Indore', 1, '03-01-2018');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_training`
--

CREATE TABLE `hrms_training` (
  `training_id` int(11) NOT NULL,
  `employee_id` varchar(200) NOT NULL,
  `training_type_id` int(200) NOT NULL,
  `trainer_id` int(200) NOT NULL,
  `start_date` varchar(200) NOT NULL,
  `finish_date` varchar(200) NOT NULL,
  `training_cost` varchar(200) NOT NULL,
  `training_status` int(200) NOT NULL,
  `description` text NOT NULL,
  `performance` varchar(200) NOT NULL,
  `remarks` text NOT NULL,
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hrms_training_types`
--

CREATE TABLE `hrms_training_types` (
  `training_type_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_training_types`
--

INSERT INTO `hrms_training_types` (`training_type_id`, `type`, `created_at`, `status`) VALUES
(1, 'Job Training', '28-04-2017', 1),
(2, 'Promotional Training', '28-04-2017', 1),
(3, 'Workshop', '28-04-2017', 1),
(4, 'Webinar', '28-04-2017', 1),
(5, 'Seminar', '28-04-2017', 1),
(6, 'Online Training', '28-04-2017', 1),
(8, 'Skill Development', '03-01-2018 01:05:35', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hrms_travel_arrangement_type`
--

CREATE TABLE `hrms_travel_arrangement_type` (
  `arrangement_type_id` int(111) NOT NULL,
  `type` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_travel_arrangement_type`
--

INSERT INTO `hrms_travel_arrangement_type` (`arrangement_type_id`, `type`, `status`, `created_at`) VALUES
(1, 'Personal Arrangment', 1, '2017-04-28 07:47:55'),
(2, 'Hotel', 1, '2017-04-28 07:48:00'),
(3, 'Guest House', 1, '2017-04-28 07:48:06'),
(4, 'Motel', 1, '2017-04-28 07:48:11'),
(5, 'AirBnB', 1, '2017-04-28 07:48:16');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_user_roles`
--

CREATE TABLE `hrms_user_roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(200) NOT NULL,
  `role_access` varchar(200) NOT NULL,
  `role_resources` text NOT NULL COMMENT ' 0=dashboard,1=client,2=project,3=task,4=employee_mangment,5=add_resource_cost,6=expense_category,7=expense_approval,8=location,9=department,10=employee_manament,11=leave_category,12=leave_request,13=holiday_calendra,14=staff_access,15=audit_log,16=expense_category,17=report,18=emp_report,19=admin_timesheat,20=admin_timeoff,21=admin_aboutus,22=admin_terms,23=admin_faq,24=admin_document,  25=dayview,26=weekly,27=emp_timesheet,28=emp_timeoff,29=apply_for_leave,30=leave_balance,31=HR_leave_balance,32=emp_expense,33=exmp_report,34=emp_mytask,35=v_aboutus,36=v_terms,37=v_document,38=v_faq,39=add_client,40=edit_client,41=add_project,42=edit_project,43=add_task,44=edit_task,45=add_emp,46=edit_emp,47=view_emp,48=edit_poject_cost,49=add_location,50=edit_location,51=add_department,52=edit_department,53=add_leave_Category,54=edit_leave_category,55=approved_leave,56=add_holiday,57=edit_holiday,58=add_applyleave,59=add_applyexpense,60=add_hour,61=view_hour,62=manumally_attendance',
  `created_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_user_roles`
--

INSERT INTO `hrms_user_roles` (`role_id`, `role_name`, `role_access`, `role_resources`, `created_at`) VALUES
(1, 'Super Admin', '', '1, 2, 6, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 27, 28, 29, 32, 33, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56', ''),
(2, 'Manager', '', '2, 4, 5, 15, 16, 17, 25, 26, 32, 33, 44, 46, 48, 50, 51, 53, 54, 55, 56', ''),
(3, 'Employee', '', '2, 3, 23, 24, 26, 30, 31, 34, 44, 46, 48, 51, 53, 56', '');

-- --------------------------------------------------------

--
-- Table structure for table `hrms_warning_type`
--

CREATE TABLE `hrms_warning_type` (
  `warning_type_id` int(111) NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hrms_warning_type`
--

INSERT INTO `hrms_warning_type` (`warning_type_id`, `type`, `created_at`) VALUES
(1, 'Verbal Warning', '2017-04-28 07:43:33'),
(2, 'First Written Warning', '2017-04-28 07:43:38'),
(3, 'Second Written Warning', '2017-04-28 07:43:44'),
(4, 'Final Written Warning', '2017-04-28 07:43:49'),
(5, 'Incident Explanation Request', '2017-04-28 07:43:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_client`
--
ALTER TABLE `add_client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `add_project`
--
ALTER TABLE `add_project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms`
--
ALTER TABLE `cms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `division`
--
ALTER TABLE `division`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_resources`
--
ALTER TABLE `employee_resources`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_appliedby_employee`
--
ALTER TABLE `expense_appliedby_employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_categories`
--
ALTER TABLE `expense_categories`
  ADD PRIMARY KEY (`expense_category_id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hrms_access_history`
--
ALTER TABLE `hrms_access_history`
  ADD PRIMARY KEY (`history_id`);

--
-- Indexes for table `hrms_announcements`
--
ALTER TABLE `hrms_announcements`
  ADD PRIMARY KEY (`announcement_id`);

--
-- Indexes for table `hrms_appraisal_apply`
--
ALTER TABLE `hrms_appraisal_apply`
  ADD PRIMARY KEY (`appraisal_id`);

--
-- Indexes for table `hrms_attendance_time`
--
ALTER TABLE `hrms_attendance_time`
  ADD PRIMARY KEY (`time_attendance_id`);

--
-- Indexes for table `hrms_awards`
--
ALTER TABLE `hrms_awards`
  ADD PRIMARY KEY (`award_id`);

--
-- Indexes for table `hrms_award_type`
--
ALTER TABLE `hrms_award_type`
  ADD PRIMARY KEY (`award_type_id`);

--
-- Indexes for table `hrms_benefits`
--
ALTER TABLE `hrms_benefits`
  ADD PRIMARY KEY (`benefit_id`);

--
-- Indexes for table `hrms_benefits_type`
--
ALTER TABLE `hrms_benefits_type`
  ADD PRIMARY KEY (`benefit_type_id`);

--
-- Indexes for table `hrms_chat_messages`
--
ALTER TABLE `hrms_chat_messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `hrms_companies`
--
ALTER TABLE `hrms_companies`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `hrms_company_info`
--
ALTER TABLE `hrms_company_info`
  ADD PRIMARY KEY (`company_info_id`);

--
-- Indexes for table `hrms_company_policy`
--
ALTER TABLE `hrms_company_policy`
  ADD PRIMARY KEY (`policy_id`);

--
-- Indexes for table `hrms_company_type`
--
ALTER TABLE `hrms_company_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `hrms_contract_type`
--
ALTER TABLE `hrms_contract_type`
  ADD PRIMARY KEY (`contract_type_id`);

--
-- Indexes for table `hrms_countries`
--
ALTER TABLE `hrms_countries`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `hrms_currencies`
--
ALTER TABLE `hrms_currencies`
  ADD PRIMARY KEY (`currency_id`);

--
-- Indexes for table `hrms_database_backup`
--
ALTER TABLE `hrms_database_backup`
  ADD PRIMARY KEY (`backup_id`);

--
-- Indexes for table `hrms_departments`
--
ALTER TABLE `hrms_departments`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `hrms_designations`
--
ALTER TABLE `hrms_designations`
  ADD PRIMARY KEY (`designation_id`);

--
-- Indexes for table `hrms_disciplinary`
--
ALTER TABLE `hrms_disciplinary`
  ADD PRIMARY KEY (`disciplinary_id`);

--
-- Indexes for table `hrms_document_type`
--
ALTER TABLE `hrms_document_type`
  ADD PRIMARY KEY (`document_type_id`);

--
-- Indexes for table `hrms_email_history`
--
ALTER TABLE `hrms_email_history`
  ADD PRIMARY KEY (`history_id`);

--
-- Indexes for table `hrms_email_template`
--
ALTER TABLE `hrms_email_template`
  ADD PRIMARY KEY (`template_id`);

--
-- Indexes for table `hrms_employees`
--
ALTER TABLE `hrms_employees`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `hrms_employee_bankaccount`
--
ALTER TABLE `hrms_employee_bankaccount`
  ADD PRIMARY KEY (`bankaccount_id`);

--
-- Indexes for table `hrms_employee_complaints`
--
ALTER TABLE `hrms_employee_complaints`
  ADD PRIMARY KEY (`complaint_id`);

--
-- Indexes for table `hrms_employee_contacts`
--
ALTER TABLE `hrms_employee_contacts`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `hrms_employee_contract`
--
ALTER TABLE `hrms_employee_contract`
  ADD PRIMARY KEY (`contract_id`);

--
-- Indexes for table `hrms_employee_documents`
--
ALTER TABLE `hrms_employee_documents`
  ADD PRIMARY KEY (`document_id`);

--
-- Indexes for table `hrms_employee_exit`
--
ALTER TABLE `hrms_employee_exit`
  ADD PRIMARY KEY (`exit_id`);

--
-- Indexes for table `hrms_employee_exit_type`
--
ALTER TABLE `hrms_employee_exit_type`
  ADD PRIMARY KEY (`exit_type_id`);

--
-- Indexes for table `hrms_employee_feedback`
--
ALTER TABLE `hrms_employee_feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `hrms_employee_have_work`
--
ALTER TABLE `hrms_employee_have_work`
  ADD PRIMARY KEY (`have_word_id`);

--
-- Indexes for table `hrms_employee_immigration`
--
ALTER TABLE `hrms_employee_immigration`
  ADD PRIMARY KEY (`immigration_id`);

--
-- Indexes for table `hrms_employee_leave`
--
ALTER TABLE `hrms_employee_leave`
  ADD PRIMARY KEY (`leave_id`);

--
-- Indexes for table `hrms_employee_location`
--
ALTER TABLE `hrms_employee_location`
  ADD PRIMARY KEY (`office_location_id`);

--
-- Indexes for table `hrms_employee_medical_convocation`
--
ALTER TABLE `hrms_employee_medical_convocation`
  ADD PRIMARY KEY (`convocation_id`);

--
-- Indexes for table `hrms_employee_medical_request`
--
ALTER TABLE `hrms_employee_medical_request`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `hrms_employee_probations`
--
ALTER TABLE `hrms_employee_probations`
  ADD PRIMARY KEY (`probation_id`);

--
-- Indexes for table `hrms_employee_promotions`
--
ALTER TABLE `hrms_employee_promotions`
  ADD PRIMARY KEY (`promotion_id`);

--
-- Indexes for table `hrms_employee_qualification`
--
ALTER TABLE `hrms_employee_qualification`
  ADD PRIMARY KEY (`qualification_id`);

--
-- Indexes for table `hrms_employee_resignations`
--
ALTER TABLE `hrms_employee_resignations`
  ADD PRIMARY KEY (`resignation_id`);

--
-- Indexes for table `hrms_employee_shift`
--
ALTER TABLE `hrms_employee_shift`
  ADD PRIMARY KEY (`emp_shift_id`);

--
-- Indexes for table `hrms_employee_terminations`
--
ALTER TABLE `hrms_employee_terminations`
  ADD PRIMARY KEY (`termination_id`);

--
-- Indexes for table `hrms_employee_transfer`
--
ALTER TABLE `hrms_employee_transfer`
  ADD PRIMARY KEY (`transfer_id`);

--
-- Indexes for table `hrms_employee_travels`
--
ALTER TABLE `hrms_employee_travels`
  ADD PRIMARY KEY (`travel_id`);

--
-- Indexes for table `hrms_employee_warnings`
--
ALTER TABLE `hrms_employee_warnings`
  ADD PRIMARY KEY (`warning_id`);

--
-- Indexes for table `hrms_employee_work_experience`
--
ALTER TABLE `hrms_employee_work_experience`
  ADD PRIMARY KEY (`work_experience_id`);

--
-- Indexes for table `hrms_emplyee_type`
--
ALTER TABLE `hrms_emplyee_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hrms_expenses`
--
ALTER TABLE `hrms_expenses`
  ADD PRIMARY KEY (`expense_id`);

--
-- Indexes for table `hrms_expense_type`
--
ALTER TABLE `hrms_expense_type`
  ADD PRIMARY KEY (`expense_type_id`);

--
-- Indexes for table `hrms_faq`
--
ALTER TABLE `hrms_faq`
  ADD PRIMARY KEY (`faq_id`);

--
-- Indexes for table `hrms_file_management`
--
ALTER TABLE `hrms_file_management`
  ADD PRIMARY KEY (`file_id`);

--
-- Indexes for table `hrms_holidays`
--
ALTER TABLE `hrms_holidays`
  ADD PRIMARY KEY (`holiday_id`);

--
-- Indexes for table `hrms_hourly_templates`
--
ALTER TABLE `hrms_hourly_templates`
  ADD PRIMARY KEY (`hourly_rate_id`);

--
-- Indexes for table `hrms_jobs`
--
ALTER TABLE `hrms_jobs`
  ADD PRIMARY KEY (`job_id`);

--
-- Indexes for table `hrms_job_applications`
--
ALTER TABLE `hrms_job_applications`
  ADD PRIMARY KEY (`application_id`);

--
-- Indexes for table `hrms_job_interviews`
--
ALTER TABLE `hrms_job_interviews`
  ADD PRIMARY KEY (`job_interview_id`);

--
-- Indexes for table `hrms_job_type`
--
ALTER TABLE `hrms_job_type`
  ADD PRIMARY KEY (`job_type_id`);

--
-- Indexes for table `hrms_leaves`
--
ALTER TABLE `hrms_leaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hrms_leave_applications`
--
ALTER TABLE `hrms_leave_applications`
  ADD PRIMARY KEY (`leave_id`);

--
-- Indexes for table `hrms_leave_category`
--
ALTER TABLE `hrms_leave_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hrms_leave_type`
--
ALTER TABLE `hrms_leave_type`
  ADD PRIMARY KEY (`leave_type_id`);

--
-- Indexes for table `hrms_make_payment`
--
ALTER TABLE `hrms_make_payment`
  ADD PRIMARY KEY (`make_payment_id`);

--
-- Indexes for table `hrms_manumally_attendrance`
--
ALTER TABLE `hrms_manumally_attendrance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hrms_newsletter`
--
ALTER TABLE `hrms_newsletter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hrms_office_location`
--
ALTER TABLE `hrms_office_location`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `hrms_office_shift`
--
ALTER TABLE `hrms_office_shift`
  ADD PRIMARY KEY (`office_shift_id`);

--
-- Indexes for table `hrms_payment_method`
--
ALTER TABLE `hrms_payment_method`
  ADD PRIMARY KEY (`payment_method_id`);

--
-- Indexes for table `hrms_performance_appraisal`
--
ALTER TABLE `hrms_performance_appraisal`
  ADD PRIMARY KEY (`performance_appraisal_id`);

--
-- Indexes for table `hrms_performance_indicator`
--
ALTER TABLE `hrms_performance_indicator`
  ADD PRIMARY KEY (`performance_indicator_id`);

--
-- Indexes for table `hrms_projects`
--
ALTER TABLE `hrms_projects`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `hrms_qualification_education_level`
--
ALTER TABLE `hrms_qualification_education_level`
  ADD PRIMARY KEY (`education_level_id`);

--
-- Indexes for table `hrms_qualification_language`
--
ALTER TABLE `hrms_qualification_language`
  ADD PRIMARY KEY (`language_id`);

--
-- Indexes for table `hrms_qualification_skill`
--
ALTER TABLE `hrms_qualification_skill`
  ADD PRIMARY KEY (`skill_id`);

--
-- Indexes for table `hrms_salary_templates`
--
ALTER TABLE `hrms_salary_templates`
  ADD PRIMARY KEY (`salary_template_id`);

--
-- Indexes for table `hrms_support_tickets`
--
ALTER TABLE `hrms_support_tickets`
  ADD PRIMARY KEY (`ticket_id`);

--
-- Indexes for table `hrms_support_ticket_files`
--
ALTER TABLE `hrms_support_ticket_files`
  ADD PRIMARY KEY (`ticket_file_id`);

--
-- Indexes for table `hrms_survey`
--
ALTER TABLE `hrms_survey`
  ADD PRIMARY KEY (`survey_id`);

--
-- Indexes for table `hrms_survey_answers`
--
ALTER TABLE `hrms_survey_answers`
  ADD PRIMARY KEY (`answer_id`);

--
-- Indexes for table `hrms_survey_question`
--
ALTER TABLE `hrms_survey_question`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `hrms_system_setting`
--
ALTER TABLE `hrms_system_setting`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `hrms_tasks`
--
ALTER TABLE `hrms_tasks`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `hrms_tasks_attachment`
--
ALTER TABLE `hrms_tasks_attachment`
  ADD PRIMARY KEY (`task_attachment_id`);

--
-- Indexes for table `hrms_tasks_comments`
--
ALTER TABLE `hrms_tasks_comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `hrms_tasks_query`
--
ALTER TABLE `hrms_tasks_query`
  ADD PRIMARY KEY (`tasks_query_id`);

--
-- Indexes for table `hrms_task_employee`
--
ALTER TABLE `hrms_task_employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hrms_termination_type`
--
ALTER TABLE `hrms_termination_type`
  ADD PRIMARY KEY (`termination_type_id`);

--
-- Indexes for table `hrms_throughofday`
--
ALTER TABLE `hrms_throughofday`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hrms_tickets_attachment`
--
ALTER TABLE `hrms_tickets_attachment`
  ADD PRIMARY KEY (`ticket_attachment_id`);

--
-- Indexes for table `hrms_tickets_comments`
--
ALTER TABLE `hrms_tickets_comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `hrms_trainers`
--
ALTER TABLE `hrms_trainers`
  ADD PRIMARY KEY (`trainer_id`);

--
-- Indexes for table `hrms_training`
--
ALTER TABLE `hrms_training`
  ADD PRIMARY KEY (`training_id`);

--
-- Indexes for table `hrms_training_types`
--
ALTER TABLE `hrms_training_types`
  ADD PRIMARY KEY (`training_type_id`);

--
-- Indexes for table `hrms_travel_arrangement_type`
--
ALTER TABLE `hrms_travel_arrangement_type`
  ADD PRIMARY KEY (`arrangement_type_id`);

--
-- Indexes for table `hrms_user_roles`
--
ALTER TABLE `hrms_user_roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `hrms_warning_type`
--
ALTER TABLE `hrms_warning_type`
  ADD PRIMARY KEY (`warning_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_client`
--
ALTER TABLE `add_client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `add_project`
--
ALTER TABLE `add_project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cms`
--
ALTER TABLE `cms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `division`
--
ALTER TABLE `division`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `employee_resources`
--
ALTER TABLE `employee_resources`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `expense_appliedby_employee`
--
ALTER TABLE `expense_appliedby_employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `expense_categories`
--
ALTER TABLE `expense_categories`
  MODIFY `expense_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hrms_access_history`
--
ALTER TABLE `hrms_access_history`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213;

--
-- AUTO_INCREMENT for table `hrms_announcements`
--
ALTER TABLE `hrms_announcements`
  MODIFY `announcement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `hrms_appraisal_apply`
--
ALTER TABLE `hrms_appraisal_apply`
  MODIFY `appraisal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hrms_attendance_time`
--
ALTER TABLE `hrms_attendance_time`
  MODIFY `time_attendance_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `hrms_awards`
--
ALTER TABLE `hrms_awards`
  MODIFY `award_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hrms_award_type`
--
ALTER TABLE `hrms_award_type`
  MODIFY `award_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `hrms_benefits`
--
ALTER TABLE `hrms_benefits`
  MODIFY `benefit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hrms_benefits_type`
--
ALTER TABLE `hrms_benefits_type`
  MODIFY `benefit_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hrms_chat_messages`
--
ALTER TABLE `hrms_chat_messages`
  MODIFY `message_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hrms_companies`
--
ALTER TABLE `hrms_companies`
  MODIFY `company_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `hrms_company_info`
--
ALTER TABLE `hrms_company_info`
  MODIFY `company_info_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hrms_company_policy`
--
ALTER TABLE `hrms_company_policy`
  MODIFY `policy_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `hrms_company_type`
--
ALTER TABLE `hrms_company_type`
  MODIFY `type_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hrms_contract_type`
--
ALTER TABLE `hrms_contract_type`
  MODIFY `contract_type_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `hrms_countries`
--
ALTER TABLE `hrms_countries`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;

--
-- AUTO_INCREMENT for table `hrms_currencies`
--
ALTER TABLE `hrms_currencies`
  MODIFY `currency_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `hrms_database_backup`
--
ALTER TABLE `hrms_database_backup`
  MODIFY `backup_id` int(111) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hrms_departments`
--
ALTER TABLE `hrms_departments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `hrms_designations`
--
ALTER TABLE `hrms_designations`
  MODIFY `designation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `hrms_disciplinary`
--
ALTER TABLE `hrms_disciplinary`
  MODIFY `disciplinary_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hrms_document_type`
--
ALTER TABLE `hrms_document_type`
  MODIFY `document_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hrms_email_history`
--
ALTER TABLE `hrms_email_history`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `hrms_email_template`
--
ALTER TABLE `hrms_email_template`
  MODIFY `template_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `hrms_employees`
--
ALTER TABLE `hrms_employees`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `hrms_employee_bankaccount`
--
ALTER TABLE `hrms_employee_bankaccount`
  MODIFY `bankaccount_id` int(111) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hrms_employee_complaints`
--
ALTER TABLE `hrms_employee_complaints`
  MODIFY `complaint_id` int(111) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hrms_employee_contacts`
--
ALTER TABLE `hrms_employee_contacts`
  MODIFY `contact_id` int(111) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hrms_employee_contract`
--
ALTER TABLE `hrms_employee_contract`
  MODIFY `contract_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hrms_employee_documents`
--
ALTER TABLE `hrms_employee_documents`
  MODIFY `document_id` int(111) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hrms_employee_exit`
--
ALTER TABLE `hrms_employee_exit`
  MODIFY `exit_id` int(111) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hrms_employee_exit_type`
--
ALTER TABLE `hrms_employee_exit_type`
  MODIFY `exit_type_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `hrms_employee_feedback`
--
ALTER TABLE `hrms_employee_feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hrms_employee_have_work`
--
ALTER TABLE `hrms_employee_have_work`
  MODIFY `have_word_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hrms_employee_immigration`
--
ALTER TABLE `hrms_employee_immigration`
  MODIFY `immigration_id` int(111) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hrms_employee_leave`
--
ALTER TABLE `hrms_employee_leave`
  MODIFY `leave_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hrms_employee_location`
--
ALTER TABLE `hrms_employee_location`
  MODIFY `office_location_id` int(111) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hrms_employee_medical_convocation`
--
ALTER TABLE `hrms_employee_medical_convocation`
  MODIFY `convocation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hrms_employee_medical_request`
--
ALTER TABLE `hrms_employee_medical_request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hrms_employee_probations`
--
ALTER TABLE `hrms_employee_probations`
  MODIFY `probation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hrms_employee_promotions`
--
ALTER TABLE `hrms_employee_promotions`
  MODIFY `promotion_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `hrms_employee_qualification`
--
ALTER TABLE `hrms_employee_qualification`
  MODIFY `qualification_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hrms_employee_resignations`
--
ALTER TABLE `hrms_employee_resignations`
  MODIFY `resignation_id` int(111) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hrms_employee_shift`
--
ALTER TABLE `hrms_employee_shift`
  MODIFY `emp_shift_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `hrms_employee_terminations`
--
ALTER TABLE `hrms_employee_terminations`
  MODIFY `termination_id` int(111) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hrms_employee_transfer`
--
ALTER TABLE `hrms_employee_transfer`
  MODIFY `transfer_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `hrms_employee_travels`
--
ALTER TABLE `hrms_employee_travels`
  MODIFY `travel_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `hrms_employee_warnings`
--
ALTER TABLE `hrms_employee_warnings`
  MODIFY `warning_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hrms_employee_work_experience`
--
ALTER TABLE `hrms_employee_work_experience`
  MODIFY `work_experience_id` int(111) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hrms_emplyee_type`
--
ALTER TABLE `hrms_emplyee_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `hrms_expenses`
--
ALTER TABLE `hrms_expenses`
  MODIFY `expense_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `hrms_expense_type`
--
ALTER TABLE `hrms_expense_type`
  MODIFY `expense_type_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hrms_faq`
--
ALTER TABLE `hrms_faq`
  MODIFY `faq_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `hrms_file_management`
--
ALTER TABLE `hrms_file_management`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `hrms_holidays`
--
ALTER TABLE `hrms_holidays`
  MODIFY `holiday_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hrms_hourly_templates`
--
ALTER TABLE `hrms_hourly_templates`
  MODIFY `hourly_rate_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hrms_jobs`
--
ALTER TABLE `hrms_jobs`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hrms_job_applications`
--
ALTER TABLE `hrms_job_applications`
  MODIFY `application_id` int(111) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hrms_job_interviews`
--
ALTER TABLE `hrms_job_interviews`
  MODIFY `job_interview_id` int(111) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hrms_job_type`
--
ALTER TABLE `hrms_job_type`
  MODIFY `job_type_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `hrms_leaves`
--
ALTER TABLE `hrms_leaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `hrms_leave_applications`
--
ALTER TABLE `hrms_leave_applications`
  MODIFY `leave_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `hrms_leave_category`
--
ALTER TABLE `hrms_leave_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `hrms_leave_type`
--
ALTER TABLE `hrms_leave_type`
  MODIFY `leave_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hrms_make_payment`
--
ALTER TABLE `hrms_make_payment`
  MODIFY `make_payment_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `hrms_manumally_attendrance`
--
ALTER TABLE `hrms_manumally_attendrance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hrms_newsletter`
--
ALTER TABLE `hrms_newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hrms_office_location`
--
ALTER TABLE `hrms_office_location`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `hrms_office_shift`
--
ALTER TABLE `hrms_office_shift`
  MODIFY `office_shift_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `hrms_payment_method`
--
ALTER TABLE `hrms_payment_method`
  MODIFY `payment_method_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `hrms_performance_appraisal`
--
ALTER TABLE `hrms_performance_appraisal`
  MODIFY `performance_appraisal_id` int(111) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hrms_performance_indicator`
--
ALTER TABLE `hrms_performance_indicator`
  MODIFY `performance_indicator_id` int(111) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hrms_projects`
--
ALTER TABLE `hrms_projects`
  MODIFY `project_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `hrms_qualification_education_level`
--
ALTER TABLE `hrms_qualification_education_level`
  MODIFY `education_level_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hrms_qualification_language`
--
ALTER TABLE `hrms_qualification_language`
  MODIFY `language_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hrms_qualification_skill`
--
ALTER TABLE `hrms_qualification_skill`
  MODIFY `skill_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hrms_salary_templates`
--
ALTER TABLE `hrms_salary_templates`
  MODIFY `salary_template_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `hrms_support_tickets`
--
ALTER TABLE `hrms_support_tickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `hrms_support_ticket_files`
--
ALTER TABLE `hrms_support_ticket_files`
  MODIFY `ticket_file_id` int(111) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hrms_survey`
--
ALTER TABLE `hrms_survey`
  MODIFY `survey_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hrms_survey_answers`
--
ALTER TABLE `hrms_survey_answers`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hrms_survey_question`
--
ALTER TABLE `hrms_survey_question`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hrms_system_setting`
--
ALTER TABLE `hrms_system_setting`
  MODIFY `setting_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hrms_tasks`
--
ALTER TABLE `hrms_tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `hrms_tasks_attachment`
--
ALTER TABLE `hrms_tasks_attachment`
  MODIFY `task_attachment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `hrms_tasks_comments`
--
ALTER TABLE `hrms_tasks_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hrms_tasks_query`
--
ALTER TABLE `hrms_tasks_query`
  MODIFY `tasks_query_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `hrms_task_employee`
--
ALTER TABLE `hrms_task_employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `hrms_termination_type`
--
ALTER TABLE `hrms_termination_type`
  MODIFY `termination_type_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `hrms_throughofday`
--
ALTER TABLE `hrms_throughofday`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hrms_tickets_attachment`
--
ALTER TABLE `hrms_tickets_attachment`
  MODIFY `ticket_attachment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hrms_tickets_comments`
--
ALTER TABLE `hrms_tickets_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `hrms_trainers`
--
ALTER TABLE `hrms_trainers`
  MODIFY `trainer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hrms_training`
--
ALTER TABLE `hrms_training`
  MODIFY `training_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hrms_training_types`
--
ALTER TABLE `hrms_training_types`
  MODIFY `training_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `hrms_travel_arrangement_type`
--
ALTER TABLE `hrms_travel_arrangement_type`
  MODIFY `arrangement_type_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hrms_user_roles`
--
ALTER TABLE `hrms_user_roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hrms_warning_type`
--
ALTER TABLE `hrms_warning_type`
  MODIFY `warning_type_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
