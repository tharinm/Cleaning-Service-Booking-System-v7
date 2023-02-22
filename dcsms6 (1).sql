-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 21, 2023 at 03:18 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dcsms6`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_employee_registration`
--

DROP TABLE IF EXISTS `admin_employee_registration`;
CREATE TABLE IF NOT EXISTS `admin_employee_registration` (
  `t_emp_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  KEY `t_emp_id` (`t_emp_id`),
  KEY `emp_id` (`emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_employee_registration`
--

INSERT INTO `admin_employee_registration` (`t_emp_id`, `emp_id`) VALUES
(2, 2),
(2, 2),
(1, 1),
(3, 0),
(3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `admin_pay`
--

DROP TABLE IF EXISTS `admin_pay`;
CREATE TABLE IF NOT EXISTS `admin_pay` (
  `acc` int(11) NOT NULL,
  `acc_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`acc_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bannded_employee`
--

DROP TABLE IF EXISTS `bannded_employee`;
CREATE TABLE IF NOT EXISTS `bannded_employee` (
  `bandded_id` int(11) NOT NULL,
  `bandded_emp_name` varchar(255) NOT NULL,
  `bandded_emp_email` varchar(255) NOT NULL,
  `bandded_emp_nic` varchar(255) NOT NULL,
  PRIMARY KEY (`bandded_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cancel_order`
--

DROP TABLE IF EXISTS `cancel_order`;
CREATE TABLE IF NOT EXISTS `cancel_order` (
  `cancel_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `aemp_id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`cancel_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cancel_order`
--

INSERT INTO `cancel_order` (`cancel_id`, `order_id`, `aemp_id`, `category`, `date`) VALUES
(1, 3, 2, 'outdoor', '2023-02-22'),
(2, 4, 1, 'outdoor', '2023-02-20');

-- --------------------------------------------------------

--
-- Table structure for table `complain`
--

DROP TABLE IF EXISTS `complain`;
CREATE TABLE IF NOT EXISTS `complain` (
  `complain_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `complain_description` varchar(255) NOT NULL,
  PRIMARY KEY (`complain_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complain`
--

INSERT INTO `complain` (`complain_id`, `order_id`, `complain_description`) VALUES
(1, 5, 'good work'),
(2, 7, 'late'),
(3, 20, 'I ordered a product from your website two weeks ago, and it still hasn\'t arrived. I have tried contacting your customer support multiple times, but have received no response. ');

-- --------------------------------------------------------

--
-- Table structure for table `complete`
--

DROP TABLE IF EXISTS `complete`;
CREATE TABLE IF NOT EXISTS `complete` (
  `order_id` int(11) NOT NULL,
  `c_complete` int(11) NOT NULL,
  `e_complete` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `order_id` (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complete`
--

INSERT INTO `complete` (`order_id`, `c_complete`, `e_complete`) VALUES
(11, 1, 1),
(5, 1, 0),
(12, 1, 1),
(9, 1, 1),
(10, 1, 1),
(7, 1, 0),
(2, 1, 0),
(1, 1, 1),
(13, 1, 1),
(14, 1, 1),
(6, 1, 1),
(18, 1, 1),
(19, 1, 0),
(20, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `cus_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `mobile` int(10) DEFAULT NULL,
  `nic` varchar(15) DEFAULT NULL,
  `postal_code` int(11) DEFAULT NULL,
  `cus_points` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cus_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cus_id`, `user_name`, `email`, `first_name`, `last_name`, `address`, `mobile`, `nic`, `postal_code`, `cus_points`) VALUES
(1, 'user1', 'mtkdesilva@gmail.com', 'KUMARA', 'KUMAR', 'no /15, beach road ,matara', 770308960, '984191116V', 20334, 100),
(2, 'user2', 'mtkdesilva98@gmail.com', 'thanuka', 'silva', 'NO101/20,RUBBERWATTA,wathugedara', 768069204, '982294775V', 98888, 500);

-- --------------------------------------------------------

--
-- Table structure for table `customer_bank_details`
--

DROP TABLE IF EXISTS `customer_bank_details`;
CREATE TABLE IF NOT EXISTS `customer_bank_details` (
  `cb_id` int(11) NOT NULL AUTO_INCREMENT,
  `cus_id` int(11) NOT NULL DEFAULT '1',
  `bank_name` varchar(255) NOT NULL,
  `bank_acc` int(11) NOT NULL,
  `cb_email` varchar(255) NOT NULL,
  PRIMARY KEY (`cb_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `t_emp_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `emp_fname` varchar(255) DEFAULT NULL,
  `emp_lname` varchar(255) DEFAULT NULL,
  `emp_address` varchar(255) DEFAULT NULL,
  `emp_email` varchar(255) NOT NULL,
  `emp_nic` varchar(15) DEFAULT NULL,
  `emp_postalcode` int(11) DEFAULT NULL,
  `emp_bankname` varchar(255) DEFAULT NULL,
  `emp_bankacc` int(11) DEFAULT NULL,
  `emp_categories` varchar(255) DEFAULT NULL,
  `emp_qulification` varchar(255) DEFAULT NULL,
  `emp_filename` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`t_emp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`t_emp_id`, `user_name`, `emp_fname`, `emp_lname`, `emp_address`, `emp_email`, `emp_nic`, `emp_postalcode`, `emp_bankname`, `emp_bankacc`, `emp_categories`, `emp_qulification`, `emp_filename`) VALUES
(1, 'emp1', 'thanuka', 'kumara', 'no /15, beach road ,matara', 'avishka1098@gmail.com', '982191114V', 20334, NULL, NULL, 'greenclean,indoorclean,', 'Currently Working In cleaning service', 'istockphoto-1324786380-170667a - Copy.jpg'),
(2, 'emp2', 'avishka', 'hettiarachchi', 'no /15, beach road ,matara', 'thanukakumara20@gmail.com', '334455669V', 20334, NULL, NULL, 'indoorclean,outdoorclean,specialclean,', 'Worked in cleaning service', 'resources-benefits-employees-want-most-min-768x483-1-e1540508225245.jpg'),
(3, 'emp3', 'channa', 'vidanagamachchi', 'no /15, beach road ,matara', 'mtkdesilva1998@gmail.com', '982191188V', 20336, NULL, NULL, 'greenclean,indoorclean,outdoorclean,specialclean,', 'Worked in cleaning service', '360_F_332588811_bYNAWoxbBHaAvIFfHNKk71OZrNBlzAVQ.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `emp_payment`
--

DROP TABLE IF EXISTS `emp_payment`;
CREATE TABLE IF NOT EXISTS `emp_payment` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `balance` int(11) NOT NULL DEFAULT '400',
  PRIMARY KEY (`payment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp_payment`
--

INSERT INTO `emp_payment` (`payment_id`, `order_id`, `emp_id`, `balance`) VALUES
(1, 2, 2, 400),
(2, 2, 2, 400),
(3, 2, 2, 400),
(4, 9, 1, 400),
(5, 1, 1, 400),
(6, 9, 1, 400),
(7, 9, 1, 400),
(8, 10, 1, 400),
(9, 12, 1, 400),
(10, 11, 1, 400),
(11, 1, 1, 400),
(12, 13, 2, 400),
(13, 14, 2, 400),
(14, 18, 2, 400),
(15, 20, 2, 400);

-- --------------------------------------------------------

--
-- Table structure for table `emp_reject_orders`
--

DROP TABLE IF EXISTS `emp_reject_orders`;
CREATE TABLE IF NOT EXISTS `emp_reject_orders` (
  `rejected_order_id` int(11) NOT NULL,
  `aemp_id` int(11) NOT NULL DEFAULT '0',
  `category` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  UNIQUE KEY `rejected_order_id` (`rejected_order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp_reject_orders`
--

INSERT INTO `emp_reject_orders` (`rejected_order_id`, `aemp_id`, `category`, `date`, `time`, `status`) VALUES
(6, 1, 'outdoor', '2023-02-14', '22:10:00', 'Completed'),
(16, 1, 'residential', '2023-02-16', '07:15:00', 'Accept'),
(18, 2, 'special', '2023-02-28', '21:00:00', 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `emp_withdrawal_request`
--

DROP TABLE IF EXISTS `emp_withdrawal_request`;
CREATE TABLE IF NOT EXISTS `emp_withdrawal_request` (
  `request_id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) NOT NULL,
  `bank_acc` char(25) NOT NULL,
  `amount` int(11) NOT NULL,
  `status` varchar(25) DEFAULT 'pending',
  PRIMARY KEY (`request_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp_withdrawal_request`
--

INSERT INTO `emp_withdrawal_request` (`request_id`, `emp_id`, `bank_acc`, `amount`, `status`) VALUES
(8, 1, '4433221155', 3200, 'pending'),
(10, 2, '5544332211', 2400, 'pending'),
(13, 1, '22335465465765756', 3200, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
CREATE TABLE IF NOT EXISTS `files` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `size` int(11) NOT NULL,
  `downloads` int(11) NOT NULL,
  `e_id` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `name`, `size`, `downloads`, `e_id`) VALUES
(1, 'Grama niladari form MyCleaners.pdf', 171714, 0, 2),
(4, 'Your paragraph text.pdf', 21750, 0, 3),
(3, 'Grama niladari form MyCleaners.pdf', 171714, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

DROP TABLE IF EXISTS `forms`;
CREATE TABLE IF NOT EXISTS `forms` (
  `form_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `size` int(11) NOT NULL,
  `downloads` int(11) NOT NULL,
  PRIMARY KEY (`form_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forms`
--

INSERT INTO `forms` (`form_id`, `name`, `size`, `downloads`) VALUES
(1, 'Medical_Form_MyCleaners.pdf', 164820, 0),
(2, 'Grama_niladari_form_MyCleaners.pdf', 170633, 0);

-- --------------------------------------------------------

--
-- Table structure for table `job_accepted_emp`
--

DROP TABLE IF EXISTS `job_accepted_emp`;
CREATE TABLE IF NOT EXISTS `job_accepted_emp` (
  `a_emp_id` int(11) NOT NULL,
  `a_order_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_accepted_emp`
--

INSERT INTO `job_accepted_emp` (`a_emp_id`, `a_order_id`) VALUES
(1, 21),
(2, 20),
(1, 19),
(1, 18),
(1, 16),
(1, 15),
(2, 14),
(2, 13),
(1, 12),
(1, 10),
(1, 9),
(1, 8),
(2, 7),
(2, 6),
(1, 5),
(1, 4),
(2, 3),
(2, 1),
(3, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `job_order`
--

DROP TABLE IF EXISTS `job_order`;
CREATE TABLE IF NOT EXISTS `job_order` (
  `job_order_id` int(11) NOT NULL AUTO_INCREMENT,
  `cus_id` int(11) NOT NULL,
  `aemp_id` int(11) NOT NULL DEFAULT '0',
  `job_order_address` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `job_order_date` date NOT NULL,
  `job_order_time` time NOT NULL,
  `special_note` varchar(255) NOT NULL,
  `job_order_category` varchar(255) NOT NULL,
  `job_order_tools` varchar(255) NOT NULL,
  `work_detail` varchar(255) NOT NULL,
  `duration` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Pending',
  PRIMARY KEY (`job_order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_order`
--

INSERT INTO `job_order` (`job_order_id`, `cus_id`, `aemp_id`, `job_order_address`, `location`, `job_order_date`, `job_order_time`, `special_note`, `job_order_category`, `job_order_tools`, `work_detail`, `duration`, `filename`, `status`) VALUES
(1, 1, 1, 'no 20,werahena,matara', 'matara', '2023-02-11', '12:00:00', 'use mask', 'residential', 'yes', 'nothing', 5, 'page2.jpg', 'Completed'),
(2, 2, 2, 'NO101/20,RUBBERWATTA,wathugedara', 'galle', '2023-02-24', '20:00:00', 'wear mask', 'green', 'yes', 'use tools', 12, 'istockphoto-488222865-170667a.jpg', 'Completed'),
(5, 2, 1, 'no 26,werahena,matara', 'galle', '2023-02-28', '12:54:00', 'wash dishes', 'special', 'no', 'no', 2, 'istockphoto-488222865-170667a.jpg', 'Completed'),
(6, 2, 2, 'no 22,werahena,matara', 'matara', '2023-02-13', '10:00:00', 'come on time', 'outdoor', 'no', 'garden clean', 2, 'page2.jpg', 'Completed'),
(7, 1, 2, 'no /15, beach road ,matara', 'ambalangoda', '2023-02-24', '20:00:00', 'dont be late', 'special', 'no', 'party', 7, 'Feeling-Like-I-Need-To-Apologize-For-My-Mess-1.jpg', 'Completed'),
(9, 1, 1, 'no 40,werahena,matara', 'matara', '2023-02-21', '14:10:00', 'home work', 'green', 'yes', 'nothing', 4, 'Feeling-Like-I-Need-To-Apologize-For-My-Mess-1.jpg', 'Completed'),
(10, 1, 1, 'no /15, beach road ,matara', 'ja ella', '2023-02-27', '16:40:00', 'ff', 'special', 'yes', 'rr', 1, 'istockphoto-488222865-170667a.jpg', 'Completed'),
(11, 1, 1, 'no 30,werahena,matara', 'matara', '2023-02-17', '18:30:00', 'not old cleaner', 'residential', 'no', 'cleaning', 2, 'istockphoto-488222865-170667a.jpg', 'Completed'),
(12, 2, 1, 'NO101/20,RUBBERWATTA,wathugedara', 'galle', '2023-02-28', '16:26:00', 'gg', 'special', 'no', 'n', 4, 'Feeling-Like-I-Need-To-Apologize-For-My-Mess-1.jpg', 'Completed'),
(13, 2, 2, 'NO101/20,RUBBERWATTA,', 'matara', '2023-02-22', '18:30:00', 'dont be late', 'residential', 'yes', 'bring tools', 7, '', 'Completed'),
(14, 1, 2, 'no 33/beach road,matara', 'matara', '2023-02-20', '15:40:00', 'please come on time', 'green', 'yes', 'need a grass cutter', 5, '', 'Completed'),
(15, 2, 1, 'no 55/beach road,galle', 'galle', '2023-02-27', '07:45:00', 'low budget', 'green', 'yes', 'bring a useful tool', 3, 'page2.jpg', 'Accept'),
(16, 2, 1, 'no 5 galle road colombo7', 'colombo', '2023-02-21', '08:00:00', 'wear a mask when you come', 'residential', 'no', 'kitchen cleaning', 4, 'Feeling-Like-I-Need-To-Apologize-For-My-Mess-1.jpg', 'Re-Pending'),
(17, 1, 0, 'no67 kelin weediya ,pitakotteh', 'matara', '2023-02-14', '08:40:00', 'need experienced person', 'residential', 'no', 'roof cleaning', 5, 'istockphoto-488222865-170667a.jpg', 'Pending'),
(18, 2, 1, 'no56 gabada weediya hettimulla', 'matara', '2023-02-22', '20:50:00', 'dont be late', 'special', 'no', 'need 4 persons', 4, 'istockphoto-488222865-170667a.jpg', 'Completed'),
(19, 2, 1, 'no /15, beach road ,matara', 'ambalangoda', '2023-02-21', '10:30:00', 'gggg', 'residential', 'yes', 'gg', 4, 'istockphoto-488222865-170667a.jpg', 'CCompleted'),
(20, 2, 2, 'no 20,werahena,matara', 'matara', '2023-02-28', '05:30:00', 'gg', 'residential', 'yes', 'gg', 4, 'istockphoto-488222865-170667a.jpg', 'Completed'),
(21, 1, 1, 'no /15, beach road ,matara', 'matara', '2023-02-14', '20:30:00', 'good', 'residential', 'yes', 'gg', 3, 'page2.jpg', 'Accept');

-- --------------------------------------------------------

--
-- Table structure for table `medifiles`
--

DROP TABLE IF EXISTS `medifiles`;
CREATE TABLE IF NOT EXISTS `medifiles` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `size` int(11) NOT NULL,
  `downloads` int(11) NOT NULL,
  `e_id` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medifiles`
--

INSERT INTO `medifiles` (`id`, `name`, `size`, `downloads`, `e_id`) VALUES
(1, 'Medical Form MyCleaners.pdf', 164820, 0, 2),
(4, 'PHY3232_problem_set_02.pdf', 115665, 0, 3),
(3, 'Medical Form MyCleaners.pdf', 164820, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `price`
--

DROP TABLE IF EXISTS `price`;
CREATE TABLE IF NOT EXISTS `price` (
  `price_id` int(255) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `amount` int(255) NOT NULL,
  PRIMARY KEY (`price_id`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `price`
--

INSERT INTO `price` (`price_id`, `order_id`, `amount`) VALUES
(50, 21, 1300),
(54, 16, 2400),
(53, 15, 2400),
(52, 15, 2400),
(51, 15, 2400),
(49, 15, 1900),
(48, 15, 2400),
(47, 21, 1800),
(46, 19, 1300),
(45, 19, 1800);

-- --------------------------------------------------------

--
-- Table structure for table `refunds`
--

DROP TABLE IF EXISTS `refunds`;
CREATE TABLE IF NOT EXISTS `refunds` (
  `rf_id` int(11) NOT NULL AUTO_INCREMENT,
  `cus_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL DEFAULT '400',
  `status` varchar(25) NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`rf_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `refunds`
--

INSERT INTO `refunds` (`rf_id`, `cus_id`, `amount`, `status`) VALUES
(1, 2, 400, 'pending'),
(2, 1, 400, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `registered_employee`
--

DROP TABLE IF EXISTS `registered_employee`;
CREATE TABLE IF NOT EXISTS `registered_employee` (
  `emp_id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_name` varchar(255) NOT NULL,
  `emp_status` varchar(255) NOT NULL,
  `emp_filename` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nic` varchar(15) NOT NULL,
  `emp_points` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`emp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registered_employee`
--

INSERT INTO `registered_employee` (`emp_id`, `emp_name`, `emp_status`, `emp_filename`, `email`, `nic`, `emp_points`) VALUES
(1, 'thanuka', 'Currently Working In cleaning service', 'istockphoto-1324786380-170667a - Copy.jpg', 'avishka1098@gmail.com', '982191114V', 521),
(2, 'avishka', 'Worked in cleaning service', 'resources-benefits-employees-want-most-min-768x483-1-e1540508225245.jpg', 'thanukakumara20@gmail.com', '334455669V', 320);

-- --------------------------------------------------------

--
-- Table structure for table `reshedule`
--

DROP TABLE IF EXISTS `reshedule`;
CREATE TABLE IF NOT EXISTS `reshedule` (
  `re_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `aemp_id` int(11) NOT NULL DEFAULT '0',
  `re_date` date NOT NULL,
  `re_time` time NOT NULL,
  `category` varchar(255) NOT NULL,
  `re_status` varchar(255) NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`re_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reshedule`
--

INSERT INTO `reshedule` (`re_id`, `order_id`, `aemp_id`, `re_date`, `re_time`, `category`, `re_status`) VALUES
(1, 2, 1, '2023-02-18', '22:20:00', 'green', 'completed'),
(2, 1, 1, '2023-02-17', '21:50:00', 'residential', 'completed'),
(3, 6, 0, '2023-02-14', '22:10:00', 'outdoor', 'completed'),
(13, 21, 0, '2023-02-21', '21:50:00', 'residential', 'pending'),
(6, 11, 1, '2023-02-19', '19:30:00', 'outdoor', 'completed'),
(8, 5, 1, '2023-02-17', '12:15:00', 'special', 'completed'),
(9, 14, 2, '2023-02-14', '06:00:00', 'residential', 'completed'),
(10, 15, 1, '2023-02-16', '08:08:00', 'green', 'accept'),
(11, 16, 0, '2023-02-16', '07:15:00', 'residential', 'rejected'),
(12, 18, 0, '2023-02-28', '21:00:00', 'special', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `session_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`session_id`, `user_id`, `username`) VALUES
(1, 1, 'user1'),
(2, 2, 'user2'),
(3, 3, 'emp1'),
(4, 4, 'emp2'),
(5, 5, 'admin'),
(6, 6, 'emp3');

-- --------------------------------------------------------

--
-- Table structure for table `time`
--

DROP TABLE IF EXISTS `time`;
CREATE TABLE IF NOT EXISTS `time` (
  `time_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `start_time` varchar(255) NOT NULL,
  `end_time` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`time_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `time`
--

INSERT INTO `time` (`time_id`, `order_id`, `start_time`, `end_time`) VALUES
(20, 16, '06.00', '10.00'),
(1, 0, '08.00', '16.00'),
(16, 19, '07.00', '10.00'),
(17, 19, '07.00', '10.00'),
(18, 15, '06.00', '09.00'),
(19, 21, '06.00', '09.00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(200) NOT NULL,
  `v_code` varchar(255) NOT NULL,
  `v_user` varchar(255) NOT NULL DEFAULT '0',
  `reset_token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `mobile`, `password`, `role`, `v_code`, `v_user`, `reset_token`) VALUES
(1, 'user1', 'mtkdesilva@gmail.com', 768069204, '$2y$10$HCFvIdPsodswUivAIaGn/.qmho7LrCPWwxAh19HfWDKGnCqMn3QYm', 'user', 'c2a14a15bacc298ecce9956b6f0b563d', '1', NULL),
(2, 'user2', 'mtkdesilva98@gmail.com', 768069225, '$2y$10$GIqJ740sZ.feiJXo2cJkpOomNTTMkV6y1wKXu/VlKWHs4cZZlBrYK', 'user', 'e198c7c16fcb9f4e90bc28ad1c61c937', '1', NULL),
(3, 'emp1', 'avishka1098@gmail.com', 768069204, '$2y$10$I0ej45PZ9VreGnQj9WqHb.k2nICSBO.9BSxgQ4GD7Z61mezicbfMq', 'employee', '5e4bb98d0b1366c162c946d4a89409aa', '1', NULL),
(4, 'emp2', 'thanukakumara20@gmail.com', 768069204, '$2y$10$OCHNhhV/Gaxs60OtU8vDjOFd9rlBcB/iV4XG3egL0tl/Pgvs2tzBC', 'employee', 'c05a605b69c486a48b99a0a69d94d262', '1', NULL),
(5, 'ádmin', 'admin@dcsms.ac.lk', 765645678, '$2y$10$HCFvIdPsodswUivAIaGn/.qmho7LrCPWwxAh19HfWDKGnCqMn3QYm', 'admin', 'c2a14a15bacc298ecce9956b6f0b563d', '1', NULL),
(6, 'emp3', 'mtkdesilva1998@gmail.com', 768069245, '$2y$10$coUGJ9FgGand3MZAQ.Fz8.YGNaOJ90LP/eo43AP2kjywZBTHBRKQ2', 'employee', 'e745fdeac585f28f093a1d82dd1601a7', '1', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
