-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 06, 2023 at 03:41 PM
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
-- Database: `dcsms5`
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

--
-- Dumping data for table `bannded_employee`
--

INSERT INTO `bannded_employee` (`bandded_id`, `bandded_emp_name`, `bandded_emp_email`, `bandded_emp_nic`) VALUES
(1, 'emp11', 'mtkdesilva@gmail.com', '982191114V');

-- --------------------------------------------------------

--
-- Table structure for table `cancel_order`
--

DROP TABLE IF EXISTS `cancel_order`;
CREATE TABLE IF NOT EXISTS `cancel_order` (
  `cancel_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`cancel_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complain`
--

INSERT INTO `complain` (`complain_id`, `order_id`, `complain_description`) VALUES
(1, 1, 'late to come');

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
(1, 1, 0);

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
  `nic` varchar(15) DEFAULT NULL,
  `postal_code` int(11) DEFAULT NULL,
  `cus_points` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cus_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cus_id`, `user_name`, `email`, `first_name`, `last_name`, `address`, `nic`, `postal_code`, `cus_points`) VALUES
(1, 'user1', 'mtkdesilva98@gmail.com', 'user1', 'MURUKKUWADURA', 'NO:101/20,RUBBERWATTA,', '982191114V', 88888, 100),
(2, 'user2', 'yyy@gmail.com', 'yyy', 'silva', NULL, NULL, NULL, 0),
(3, 'user3', 'jjj@gmail.com', NULL, NULL, NULL, NULL, NULL, 0);

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
  PRIMARY KEY (`t_emp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`t_emp_id`, `user_name`, `emp_fname`, `emp_lname`, `emp_address`, `emp_email`, `emp_nic`, `emp_postalcode`, `emp_bankname`, `emp_bankacc`, `emp_categories`, `emp_qulification`) VALUES
(1, 'emp1', 'emp11', 'MURUKKUWADURA', 'NO:101/20,RUBBERWATTA,', 'mtkdesilva@gmail.com', '982191114V', 88888, NULL, NULL, 'greenclean,indoorclean,outdoorclean,', 'Currently Working In cleaning service');

-- --------------------------------------------------------

--
-- Table structure for table `emp_payment`
--

DROP TABLE IF EXISTS `emp_payment`;
CREATE TABLE IF NOT EXISTS `emp_payment` (
  `order_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `balance` int(11) NOT NULL DEFAULT '400'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp_payment`
--

INSERT INTO `emp_payment` (`order_id`, `emp_id`, `balance`) VALUES
(1, 1, 400);

-- --------------------------------------------------------

--
-- Table structure for table `emp_reject_orders`
--

DROP TABLE IF EXISTS `emp_reject_orders`;
CREATE TABLE IF NOT EXISTS `emp_reject_orders` (
  `rejected_order_id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp_reject_orders`
--

INSERT INTO `emp_reject_orders` (`rejected_order_id`, `category`, `date`, `time`, `status`) VALUES
(1, 'residential', '2023-01-04', '08:20:00', 'Accept');

-- --------------------------------------------------------

--
-- Table structure for table `emp_withdrawal_request`
--

DROP TABLE IF EXISTS `emp_withdrawal_request`;
CREATE TABLE IF NOT EXISTS `emp_withdrawal_request` (
  `request_id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_acc` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`request_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp_withdrawal_request`
--

INSERT INTO `emp_withdrawal_request` (`request_id`, `bank_acc`, `amount`) VALUES
(1, 5566, 400);

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `filename`) VALUES
(1, 'istockphoto-1324786380-170667a - Copy.jpg');

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
(1, 1),
(1, 1),
(1, 1),
(1, 1),
(1, 1),
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `job_order`
--

DROP TABLE IF EXISTS `job_order`;
CREATE TABLE IF NOT EXISTS `job_order` (
  `job_order_id` int(11) NOT NULL AUTO_INCREMENT,
  `cus_id` int(11) NOT NULL,
  `job_order_address` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `job_order_date` date NOT NULL,
  `special_note` varchar(255) NOT NULL,
  `job_order_category` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Pending',
  PRIMARY KEY (`job_order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_order`
--

INSERT INTO `job_order` (`job_order_id`, `cus_id`, `job_order_address`, `location`, `job_order_date`, `special_note`, `job_order_category`, `status`) VALUES
(1, 1, 'NO101/20beachroad,matara', 'galle', '2022-12-24', 'low budget hourly rate is 500rs', 'residential', 'Accept');

-- --------------------------------------------------------

--
-- Table structure for table `refunds`
--

DROP TABLE IF EXISTS `refunds`;
CREATE TABLE IF NOT EXISTS `refunds` (
  `rf_id` int(11) NOT NULL AUTO_INCREMENT,
  `cus_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL DEFAULT '400',
  PRIMARY KEY (`rf_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
(1, 'emp11', 'Currently Working In cleaning service', 'istockphoto-1324786380-170667a - Copy.jpg', 'mtkdesilva@gmail.com', '982191114V', 874),
(2, 'kamal', 'working in a cleanning service..', 'no', 'asd@gmail.com', '876734892V', 100);

-- --------------------------------------------------------

--
-- Table structure for table `reshedule`
--

DROP TABLE IF EXISTS `reshedule`;
CREATE TABLE IF NOT EXISTS `reshedule` (
  `re_id` int(11) NOT NULL AUTO_INCREMENT,
  `re_date` date NOT NULL,
  `re_time` time NOT NULL,
  `category` varchar(255) NOT NULL,
  `re_status` varchar(255) NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`re_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reshedule`
--

INSERT INTO `reshedule` (`re_id`, `re_date`, `re_time`, `category`, `re_status`) VALUES
(1, '2023-01-04', '08:20:00', 'residential', 'rejected');

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `mobile`, `password`, `role`, `v_code`, `v_user`, `reset_token`) VALUES
(1, 'admin', 'thanuka@gmail.com', 756789789, '$2y$10$k/V8ceUpd.jahCJzhGq70.TBqoLHfV/5V5qvq7rmLy.edXFYzEj4S', 'admin', '', '1', NULL),
(2, 'user1', 'mtkdesilva98@gmail.com', 778989789, '$2y$10$.5egjQk3b.fHuHFrCcYK8ei9pn1MAf7KjRzgJ7z1ApzLN1IHCr/5y', 'user', '602a431b3774a27382ad187c369412f0', '1', NULL),
(6, 'mtkdesilva1998@gmail.com', 'mtkdesilva1998@gmail.com', 778989789, '$2y$10$xzVtye5R/XPS7sJBO0mrkO8vRdwMupNZPIPwJogQgekjiYptt/vgK', 'employee', '28848c0aba2bde931de2a5c9e6ebe7cb', '1', NULL),
(12, 'user2', 'thanukakumara20@gmail.com', 768069204, '$2y$10$nfliO40j.YmKccmytdTWk./n6xu3DV0itFTJ/WVnN9NLfwSq.4aAu', 'user', 'd661e02175ee26fb1059484f9b806643', '1', NULL),
(15, 'emp1', 'mtkdesilva@gmail.com', 768069204, '$2y$10$dRrf./lIYzSBSeERz5rriecnPBZ87ST23u5dKgm7UqKUgIojpd7mm', 'employee', '36c5ba7d6a184c29347123e0dbbff938', '1', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
