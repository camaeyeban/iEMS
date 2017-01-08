-- phpMyAdmin SQL Dump
-- version 2.10.0.2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Sep 01, 2011 at 01:27 AM
-- Server version: 5.0.67
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `ems`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_accomplishments`
-- 

CREATE TABLE `ems_accomplishments` (
  `ot_id` int(11) NOT NULL,
  `date_filed` date NOT NULL,
  `time_in` varchar(20) NOT NULL,
  `time_out` varchar(20) NOT NULL,
  `no_of_hours` int(4) NOT NULL,
  `actual_output` varchar(900) NOT NULL,
  `justification` varchar(900) NOT NULL,
  `status` varchar(20) NOT NULL,
  `remarks` varchar(900) NOT NULL,
  KEY `ot_id` (`ot_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `ems_accomplishments`
-- 

INSERT INTO `ems_accomplishments` VALUES (1, '2011-08-22', '12:00 am', '12:15 am', 3, 'adsf', '', 'Pending', '');
INSERT INTO `ems_accomplishments` VALUES (2, '2011-08-24', '6:30 pm', '8:30 pm', 2, 'Training Outline for Magic', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES (3, '2011-08-31', '', '', 0, '', '', '', '');
INSERT INTO `ems_accomplishments` VALUES (4, '2011-08-31', '', '', 0, '', '', '', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_active_user`
-- 

CREATE TABLE `ems_active_user` (
  `ID` int(4) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `emp_num` varchar(15) NOT NULL,
  `status` smallint(1) NOT NULL,
  PRIMARY KEY  (`ID`),
  KEY `emp_num` (`emp_num`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `ems_active_user`
-- 

INSERT INTO `ems_active_user` VALUES (1, 2, '111', 0);
INSERT INTO `ems_active_user` VALUES (2, 30, '111', 0);
INSERT INTO `ems_active_user` VALUES (3, 28, '1', 2);
INSERT INTO `ems_active_user` VALUES (4, 3, '20000101', 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_air_ticket`
-- 

CREATE TABLE `ems_air_ticket` (
  `at_id` int(11) NOT NULL auto_increment,
  `emp_num` int(15) NOT NULL,
  `date_filed` date NOT NULL,
  `client` varchar(30) NOT NULL,
  `origin` varchar(50) NOT NULL,
  `destination` varchar(50) NOT NULL,
  `airline` varchar(20) NOT NULL,
  `departure` varchar(50) NOT NULL,
  `arrival` varchar(50) NOT NULL,
  `purpose` varchar(900) NOT NULL,
  `remarks` varchar(900) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `status` varchar(50) NOT NULL,
  `state` smallint(1) NOT NULL,
  PRIMARY KEY  (`at_id`),
  KEY `emp_num` (`emp_num`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `ems_air_ticket`
-- 

INSERT INTO `ems_air_ticket` VALUES (1, 111, '2011-08-23', 'COH', 'Manila', 'Boracay', 'PAL', 'Aug-13-2011 11:00:00 PM', 'Aug-13-2011 11:50:00 PM', 'Meeting. meetingan', 'Aug-13-2011 11:00:00 PM', '6200', 'Re-booked', 7);
INSERT INTO `ems_air_ticket` VALUES (2, 222, '2011-08-24', 'Super 8', 'Manila', 'Cebu', 'Cebu Pac', 'Aug-24-2011 05:30:00 PM', 'Aug-24-2011 12:50:00 PM', 'Trip.', '', '', 'Confirmed', 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_attachments`
-- 

CREATE TABLE `ems_attachments` (
  `a_id` int(11) NOT NULL auto_increment,
  `emp_num` varchar(15) NOT NULL,
  `path` varchar(200) NOT NULL,
  `file_name` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `size` varchar(10) NOT NULL,
  `type` varchar(20) NOT NULL,
  PRIMARY KEY  (`a_id`),
  KEY `emp_num` (`emp_num`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

-- 
-- Dumping data for table `ems_attachments`
-- 

INSERT INTO `ems_attachments` VALUES (22, '613', 'attachments/cat1.jpg', 'cat1.jpg', 'Sample Attachment', '119.8 kb', 'image/jpeg');
INSERT INTO `ems_attachments` VALUES (24, '111', 'attachments/shortlisted.txt', 'shortlisted.txt', '', '0.3 kb', 'text/plain');
INSERT INTO `ems_attachments` VALUES (25, '111', 'attachments/3D-Heart-Wallpaper.jpg', '3D-Heart-Wallpaper.jpg', '', '13.7 kb', 'image/jpeg');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_benefits`
-- 

CREATE TABLE `ems_benefits` (
  `ben_id` int(10) NOT NULL auto_increment,
  `emp_num` varchar(15) default NULL,
  `sl_num` int(4) default NULL,
  `vl_num` int(4) default NULL,
  PRIMARY KEY  (`ben_id`),
  KEY `leave_id` (`emp_num`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `ems_benefits`
-- 

INSERT INTO `ems_benefits` VALUES (1, '111', 8, 11);
INSERT INTO `ems_benefits` VALUES (2, '613', 15, 7);

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_business_units`
-- 

CREATE TABLE `ems_business_units` (
  `b_id` int(4) NOT NULL auto_increment,
  `dept_code` varchar(10) default NULL,
  `b_manager_name` varchar(100) NOT NULL,
  `oic` varchar(10) NOT NULL,
  PRIMARY KEY  (`b_id`),
  KEY `dept_code` (`dept_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- 
-- Dumping data for table `ems_business_units`
-- 

INSERT INTO `ems_business_units` VALUES (1, 'DEPT002', 'Hubert Dy', 'None');
INSERT INTO `ems_business_units` VALUES (2, 'DEPT005', 'Jason Meribeles', 'None');
INSERT INTO `ems_business_units` VALUES (5, 'DEPT006', 'Fracy Nagnal', 'None');
INSERT INTO `ems_business_units` VALUES (6, 'DEPT011', 'Eizell Legaspi', 'None');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_department`
-- 

CREATE TABLE `ems_department` (
  `dept_code` varchar(10) NOT NULL default '',
  `dept_name` varchar(50) NOT NULL,
  PRIMARY KEY  (`dept_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `ems_department`
-- 

INSERT INTO `ems_department` VALUES ('DEPT002', 'Project');
INSERT INTO `ems_department` VALUES ('DEPT005', 'Support');
INSERT INTO `ems_department` VALUES ('DEPT006', 'Sales');
INSERT INTO `ems_department` VALUES ('DEPT010', 'Training');
INSERT INTO `ems_department` VALUES ('DEPT011', 'HR');
INSERT INTO `ems_department` VALUES ('DEPT012', 'Admin');
INSERT INTO `ems_department` VALUES ('DEPT013', 'Marketing and Hardware');
INSERT INTO `ems_department` VALUES ('DEPT014', 'Pharma');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_emergency_contacts`
-- 

CREATE TABLE `ems_emergency_contacts` (
  `ec_id` int(10) NOT NULL auto_increment,
  `emp_num` int(15) NOT NULL,
  `ecc_name` varchar(100) default NULL,
  `ecc_relationship` varchar(100) default NULL,
  `ecc_home_no` varchar(25) default NULL,
  `ecc_mobile_no` varchar(25) default NULL,
  `ecc_office_no` varchar(25) default NULL,
  PRIMARY KEY  (`ec_id`),
  KEY `emp_num` (`emp_num`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

-- 
-- Dumping data for table `ems_emergency_contacts`
-- 

INSERT INTO `ems_emergency_contacts` VALUES (8, 111, 'Angelita Ladiana', 'mother', '7920622', '333', '1234');
INSERT INTO `ems_emergency_contacts` VALUES (10, 20081201, 'Erlinda D. Viloria', 'Mother', '', '', '');
INSERT INTO `ems_emergency_contacts` VALUES (11, 613, 'Mia', 'Mother', 'gfdgdfgdfgfd1212', 'dsfsdf112', 'sdfsdfsdfd1212');
INSERT INTO `ems_emergency_contacts` VALUES (12, 111, 'Jamil Tayson', 'GF', '', '09386867802', '0000');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_employee`
-- 

CREATE TABLE `ems_employee` (
  `emp_num` int(15) NOT NULL,
  `date_employ` date NOT NULL,
  `date_reg` date NOT NULL,
  `date_sep` date NOT NULL,
  `emp_lastname` varchar(100) default NULL,
  `emp_firstname` varchar(100) default NULL,
  `emp_middlename` varchar(100) default NULL,
  `dept_code` varchar(10) default NULL,
  `job_title_code` int(10) default NULL,
  `jl_id` int(4) NOT NULL,
  `code` varchar(15) default NULL,
  `gender` varchar(6) default NULL,
  `address1` varchar(100) default NULL,
  `address2` varchar(100) default NULL,
  `city` varchar(50) default NULL,
  `province` varchar(50) default NULL,
  `zip` varchar(20) default NULL,
  `home_no` varchar(15) default NULL,
  `mobile` varchar(25) default NULL,
  `work_no` varchar(20) default NULL,
  `email` varchar(50) default NULL,
  `email2` varchar(50) default NULL,
  `birthdate` date default NULL,
  `sss` varchar(100) default NULL,
  `tin` varchar(100) default NULL,
  `pag_ibig` varchar(100) default NULL,
  `phil_health` varchar(100) default NULL,
  PRIMARY KEY  (`emp_num`),
  KEY `dept_code` (`dept_code`),
  KEY `job_title_code` (`job_title_code`),
  KEY `code` (`code`),
  KEY `jl_id` (`jl_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `ems_employee`
-- 

INSERT INTO `ems_employee` VALUES (1, '0000-00-00', '0000-00-00', '0000-00-00', 'Admin', 'System', '', 'DEPT012', 0, 0, '--Select--', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ems_employee` VALUES (111, '2011-08-01', '0000-00-00', '0000-00-00', 'Ladiana', 'Richard Allan', 'Godoy', 'DEPT002', 2, 5, 'EST002', 'male', 'Ortigas', 'Bulacan', 'Pasig       ', '1605', '', '7929662', '09386867806', '', 'raladiana.iripple@gmail.com', '', '0000-00-00', '2222565652', '3333', '555424234', '4444');
INSERT INTO `ems_employee` VALUES (143, '0000-00-00', '0000-00-00', '0000-00-00', 'Curtis', 'Anne', 'Smith', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ems_employee` VALUES (222, '0000-00-00', '0000-00-00', '0000-00-00', 'Meribeles', 'Jason', '', 'DEPT005', 0, 0, '--Select--', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ems_employee` VALUES (613, '0000-00-00', '0000-00-00', '0000-00-00', 'Trial', 'Sample', 'Test', 'DEPT009', 6, 10, 'EST004', 'female', 'Sample Address', 'Sample Address2', 'Pasig   ', 'Bicol', '1109', '1245458dsfsdfsd', '12345679865sdfsdfsd', 'dfsddfgsdfgf', 'test@iripple.com', 'tes@yahoo.com', '1990-01-13', '131313', '141414', '121212', '151515');
INSERT INTO `ems_employee` VALUES (777, '0000-00-00', '0000-00-00', '0000-00-00', 'Viloria', 'Benito', 'B', 'DEPT009', 7, 8, 'EST003', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ems_employee` VALUES (888, '0000-00-00', '0000-00-00', '0000-00-00', 'Tayson', 'Jamil', '', 'DEPT005', 0, 0, 'EST001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ems_employee` VALUES (999, '0000-00-00', '0000-00-00', '0000-00-00', 'Balingit', 'Barbs', '', 'DEPT006', 5, 0, 'EST001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ems_employee` VALUES (2141, '0000-00-00', '0000-00-00', '0000-00-00', 'Test', 'Samp', 'Test', 'DEPT009', 5, 6, 'EST003', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ems_employee` VALUES (3232, '0000-00-00', '0000-00-00', '0000-00-00', 'M', 'TestManager', 'T', 'DEPT009', 7, 10, 'EST003', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ems_employee` VALUES (20000101, '0000-00-00', '0000-00-00', '0000-00-00', 'Dy', 'Hubert', '', 'DEPT002', 2, 5, 'EST003', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ems_employee` VALUES (20070801, '0000-00-00', '0000-00-00', '0000-00-00', 'Nagnal', 'Fracy', 'Balcoba', 'DEPT010', 9, 7, 'EST003', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ems_employee` VALUES (20080803, '0000-00-00', '0000-00-00', '0000-00-00', 'Legaspi', 'Eizell', 'Unidad', 'DEPT010', 8, 5, 'EST003', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_emp_dependents`
-- 

CREATE TABLE `ems_emp_dependents` (
  `ed_id` int(10) NOT NULL auto_increment,
  `emp_num` int(15) NOT NULL,
  `ed_name` varchar(100) default NULL,
  `ed_relationship` varchar(100) default NULL,
  `ed_datebirth` date default NULL,
  PRIMARY KEY  (`ed_id`),
  KEY `emp_num` (`emp_num`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- 
-- Dumping data for table `ems_emp_dependents`
-- 

INSERT INTO `ems_emp_dependents` VALUES (6, 111, 'neo potpot', 'pinsan', '1970-01-01');
INSERT INTO `ems_emp_dependents` VALUES (7, 613, 'neo', 'pamangkin', '2004-04-04');
INSERT INTO `ems_emp_dependents` VALUES (8, 613, 'neo', 'pamangkin', '2004-04-04');
INSERT INTO `ems_emp_dependents` VALUES (9, 613, 'neo', 'pamangkin', '2004-04-04');
INSERT INTO `ems_emp_dependents` VALUES (10, 111, 'neo', 'pamangkin', '1970-01-01');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_emp_status`
-- 

CREATE TABLE `ems_emp_status` (
  `code` varchar(15) NOT NULL,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY  (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `ems_emp_status`
-- 

INSERT INTO `ems_emp_status` VALUES ('EST001', 'Casual');
INSERT INTO `ems_emp_status` VALUES ('EST002', 'Probationary');
INSERT INTO `ems_emp_status` VALUES ('EST003', 'Regular');
INSERT INTO `ems_emp_status` VALUES ('EST004', 'Contractual');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_equip_requests`
-- 

CREATE TABLE `ems_equip_requests` (
  `erqst_id` int(11) NOT NULL auto_increment,
  `emp_num` int(15) NOT NULL,
  `date_filed` date NOT NULL,
  `subject_purpose` varchar(30) NOT NULL,
  `client_branch` varchar(30) NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `no_of_days` int(4) NOT NULL,
  `equip_list` varchar(200) NOT NULL,
  `status` varchar(20) NOT NULL,
  `remarks` varchar(100) NOT NULL,
  PRIMARY KEY  (`erqst_id`),
  KEY `emp_num` (`emp_num`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- 
-- Dumping data for table `ems_equip_requests`
-- 

INSERT INTO `ems_equip_requests` VALUES (2, 111, '2011-08-08', 'meeting', 'iRipple', '2011-08-09', '2011-08-09', 1, 'Projector|Laptop|Mouse|Targus.|', 'Cancelled', '');
INSERT INTO `ems_equip_requests` VALUES (4, 20000101, '2011-08-09', 'meeting', 'citihardware', '2011-08-09', '2011-08-09', 1, 'Projector|Keyboard|Polycom|', 'Denied', 'hello');
INSERT INTO `ems_equip_requests` VALUES (5, 111, '2011-08-10', 'meeting', 'iRipple', '2011-08-10', '2011-08-10', 1, 'Projector|Targus.|', 'Cancelled', 'Opo. cr lang :D');
INSERT INTO `ems_equip_requests` VALUES (6, 111, '2011-08-16', 'MANCOM', 'iRipple', '2011-08-17', '2011-08-17', 1, 'Projector|Laptop||', 'Cancelled', '');
INSERT INTO `ems_equip_requests` VALUES (7, 2141, '2011-08-17', 'Sample Purpose', 'Ripple', '2011-08-08', '2011-08-11', 4, 'Projector||', 'Approved', '');
INSERT INTO `ems_equip_requests` VALUES (8, 111, '2011-08-18', 'MANCOM', 'iRipple', '2011-08-18', '2011-08-18', 1, 'Projector|Mouse||', 'Cancelled', '');
INSERT INTO `ems_equip_requests` VALUES (9, 111, '2011-08-31', 'das', 'sdf', '2011-08-10', '2011-08-13', 4, 'Laptop|sdf|', 'Pending', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_equip_requisitions`
-- 

CREATE TABLE `ems_equip_requisitions` (
  `erqstn_id` int(11) NOT NULL auto_increment,
  `emp_num` int(15) NOT NULL,
  `date_filed` date NOT NULL,
  `date_needed` date NOT NULL,
  `qty` varchar(100) NOT NULL,
  `items` varchar(900) NOT NULL,
  `purpose` varchar(900) NOT NULL,
  `remarks` varchar(900) NOT NULL,
  `status` varchar(20) NOT NULL,
  `amount` varchar(20) NOT NULL,
  PRIMARY KEY  (`erqstn_id`),
  KEY `emp_num` (`emp_num`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

-- 
-- Dumping data for table `ems_equip_requisitions`
-- 

INSERT INTO `ems_equip_requisitions` VALUES (1, 111, '2011-08-24', '2011-08-29', '2|1|', 'mouse|CPU|', 'Upgrade.', '', 'In Process', '850');
INSERT INTO `ems_equip_requisitions` VALUES (2, 111, '2011-08-26', '2011-08-31', '1|', 'Laptop|', 'Field work to General Santos City', '', 'Delivered', '22,000.00');
INSERT INTO `ems_equip_requisitions` VALUES (13, 111, '2011-08-31', '2011-08-31', '1|', 'mouse pad|', 'pod', '', 'Pending', '');
INSERT INTO `ems_equip_requisitions` VALUES (14, 111, '2011-08-31', '2011-08-17', '1|', 'keyboard|', 'rt', '', 'Pending', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_geninfo`
-- 

CREATE TABLE `ems_geninfo` (
  `code` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `add1` varchar(100) NOT NULL,
  `add2` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `zip` varchar(20) NOT NULL,
  `tin` varchar(20) NOT NULL,
  `pagibig` varchar(20) NOT NULL,
  `philhealth` varchar(20) NOT NULL,
  `sss` varchar(20) NOT NULL,
  PRIMARY KEY  (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `ems_geninfo`
-- 

INSERT INTO `ems_geninfo` VALUES ('001', 'iRipple', '4234', 'Ortigas', 'Pasig', 'Pasig', 'Manila', '123456', '34345345', '24234', '123123', '234234234');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_joblevel`
-- 

CREATE TABLE `ems_joblevel` (
  `jl_id` int(11) NOT NULL auto_increment,
  `job_level` varchar(4) NOT NULL,
  `rank` varchar(30) NOT NULL,
  `grade` varchar(2) NOT NULL,
  PRIMARY KEY  (`jl_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- 
-- Dumping data for table `ems_joblevel`
-- 

INSERT INTO `ems_joblevel` VALUES (5, '2', 'Staff', '1');
INSERT INTO `ems_joblevel` VALUES (6, '2', 'Staff', '1');
INSERT INTO `ems_joblevel` VALUES (7, '1', 'Supervisor', '1');
INSERT INTO `ems_joblevel` VALUES (8, '8', 'Test', '5');
INSERT INTO `ems_joblevel` VALUES (10, '9', 'Test', '10');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_jobtitle`
-- 

CREATE TABLE `ems_jobtitle` (
  `job_title_code` int(10) NOT NULL auto_increment,
  `job_title_name` varchar(50) NOT NULL,
  `job_title_desc` varchar(200) default NULL,
  `job_title_comm` varchar(400) default NULL,
  `jobspec_id` int(11) NOT NULL,
  PRIMARY KEY  (`job_title_code`),
  KEY `jobspec_id` (`jobspec_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- 
-- Dumping data for table `ems_jobtitle`
-- 

INSERT INTO `ems_jobtitle` VALUES (2, 'Software Engineer', NULL, NULL, 0);
INSERT INTO `ems_jobtitle` VALUES (4, 'Software Solutions Analyst', 'Good.', '', 0);
INSERT INTO `ems_jobtitle` VALUES (5, 'Quality Assurance Analyst', '', '', 0);
INSERT INTO `ems_jobtitle` VALUES (6, 'Technical Writer', 'Test Description', 'Sample Comment', 0);
INSERT INTO `ems_jobtitle` VALUES (7, 'Product Manager', 'Sample Manager', 'Sample Manager', 0);
INSERT INTO `ems_jobtitle` VALUES (8, 'Training Assistant', '', '', 0);
INSERT INTO `ems_jobtitle` VALUES (9, 'Training Manager', '', '', 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_leave`
-- 

CREATE TABLE `ems_leave` (
  `leave_id` int(11) NOT NULL auto_increment,
  `emp_num` int(15) NOT NULL,
  `date_filed` date NOT NULL,
  `d_from` date NOT NULL,
  `d_to` date NOT NULL,
  `no_of_days` float NOT NULL,
  `time` varchar(2) NOT NULL,
  `type` varchar(100) NOT NULL,
  `value` smallint(1) NOT NULL,
  `reason` varchar(900) NOT NULL,
  `remarks` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY  (`leave_id`),
  KEY `emp_num` (`emp_num`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

-- 
-- Dumping data for table `ems_leave`
-- 

INSERT INTO `ems_leave` VALUES (1, 111, '2011-08-21', '2011-08-21', '2011-08-25', 5, '', 'Sick Leave', 2, 's', '', 'Pending');
INSERT INTO `ems_leave` VALUES (44, 111, '2011-08-10', '2011-08-15', '2011-08-16', 2, '', 'Sick Leave', 2, 'Fever. \r\n', '', 'Cancelled');
INSERT INTO `ems_leave` VALUES (45, 111, '2011-08-10', '2011-08-29', '2011-08-31', 3, '', 'Vacation Leave', 1, 'Outing.\r\n', '[bb]: dfasdf\r\n\r\n[jk]: sdfsdf', 'Cancelled');
INSERT INTO `ems_leave` VALUES (46, 111, '2011-08-10', '2011-08-10', '2011-08-15', 5.5, 'AM', 'Vacation Leave', 1, 'Outing.', '', 'Cancelled');
INSERT INTO `ems_leave` VALUES (47, 111, '2011-08-10', '2011-08-10', '2011-08-10', 1.5, 'AM', 'Sick Leave', 2, 'Half day sick leave due to stomach ache.', '', 'Cancelled');
INSERT INTO `ems_leave` VALUES (48, 111, '2011-08-10', '2011-08-15', '2011-08-18', 4, '', 'Vacation Leave', 1, 'Family vacation.', '', 'Cancelled');
INSERT INTO `ems_leave` VALUES (49, 888, '2011-08-12', '2011-08-24', '2011-08-24', 1, '', 'Sick Leave', 0, 'Trangkaso.', '', 'Pending');
INSERT INTO `ems_leave` VALUES (50, 111, '2011-08-16', '2011-08-17', '2011-08-17', 0.5, 'AM', 'Sick Leave', 2, 'Headache.', 'Testing lamang pow itow. :D', 'Cancelled');
INSERT INTO `ems_leave` VALUES (51, 111, '2011-08-17', '2011-08-23', '2011-08-23', 1, '', 'Sick Leave', 2, 'Fever.', '', 'Denied');
INSERT INTO `ems_leave` VALUES (52, 613, '2011-08-17', '2011-08-18', '2011-08-18', 1, 'PM', 'Sick Leave', 2, 'Sample SL', '', 'Pending');
INSERT INTO `ems_leave` VALUES (53, 613, '2011-08-17', '2011-08-18', '2011-08-19', 2, 'AM', 'Vacation Leave', 1, 'Sample VL', 'Sample Remarks', 'Approved');
INSERT INTO `ems_leave` VALUES (54, 613, '2011-08-17', '2011-08-18', '2011-08-18', 1, 'AM', 'Emergency Leave', 2, 'Sample EL', '', 'Pending');
INSERT INTO `ems_leave` VALUES (55, 613, '2011-08-17', '2011-08-22', '2011-08-26', 5, '', 'Maternity/Paternity Leave', 3, 'Sample Maternity Leave', '', 'Approved');
INSERT INTO `ems_leave` VALUES (56, 777, '2011-08-17', '2011-09-05', '2011-09-09', 5, '', 'Vacation Leave', 1, '..', '', 'Pending');
INSERT INTO `ems_leave` VALUES (57, 111, '2011-08-23', '2011-08-26', '2011-08-26', 1, '', 'Vacation Leave', 1, 'ds', '', 'Approved');
INSERT INTO `ems_leave` VALUES (58, 111, '2011-08-23', '2011-08-25', '2011-08-26', 2, '', 'Vacation Leave', 1, 'sddsfadsf', '', 'Approved');
INSERT INTO `ems_leave` VALUES (60, 111, '2011-08-24', '2011-08-26', '2011-08-26', 1, '', 'Emergency Leave', 2, 'Emergency.\r\n', '', 'Approved');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_ob`
-- 

CREATE TABLE `ems_ob` (
  `ob_id` int(11) NOT NULL auto_increment,
  `emp_num` int(15) NOT NULL,
  `date_filed` date NOT NULL,
  `client_branch` varchar(50) NOT NULL,
  `date_ob` date NOT NULL,
  `purpose` varchar(900) NOT NULL,
  `status` varchar(20) NOT NULL,
  `remarks` varchar(900) NOT NULL,
  `departure` varchar(100) NOT NULL,
  `time_start` varchar(10) NOT NULL,
  `time_end` varchar(10) NOT NULL,
  `duration` int(11) NOT NULL,
  `arrival` varchar(100) NOT NULL,
  `total` int(11) NOT NULL,
  PRIMARY KEY  (`ob_id`),
  KEY `emp_num` (`emp_num`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- 
-- Dumping data for table `ems_ob`
-- 

INSERT INTO `ems_ob` VALUES (1, 111, '2011-08-10', 'Super 8', '2011-08-11', 'Delivery|POS.|', 'Cancelled', 'Moved to a later date.', '12:00 pm ', '1:00 pm', '2:00 pm', 1, '3:00 pm', 2);
INSERT INTO `ems_ob` VALUES (2, 888, '2011-08-11', 'Super 8', '2011-08-11', 'Network||', 'Pending', '', '12:00 am ', '12:55 am', '12:55 am', 1, '1:05 am', 2);
INSERT INTO `ems_ob` VALUES (3, 2141, '2011-08-17', 'Ripple', '2011-08-19', 'Meeting|hhhh|', 'Pending', 'hhhh', '1:00 pm ', '2:00 pm', '6:00 pm', 4, '2:00 pm', 4);
INSERT INTO `ems_ob` VALUES (4, 111, '2011-08-31', '', '0000-00-00', '|', 'Pending', '', '--Select-- ', '--Select--', '--Select--', 0, '--Select--', 0);
INSERT INTO `ems_ob` VALUES (5, 111, '2011-08-31', 'sdf', '2011-08-24', 'sdf|', 'Pending', 'sdf', '12:40 am ', '1:00 am', '1:00 am', 1, '1:05 am', 2);
INSERT INTO `ems_ob` VALUES (6, 111, '2011-08-31', 'COH', '2011-08-15', 'Network||', 'Pending', '', '12:15 am ', '1:00 am', '12:45 am', 1, '1:10 am', 2);

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_offset`
-- 

CREATE TABLE `ems_offset` (
  `offset_id` int(10) NOT NULL auto_increment,
  `emp_num` int(15) NOT NULL,
  `date_filed` date NOT NULL,
  `date_ot` date NOT NULL,
  `date_ot2` date default NULL,
  `ot_hours` int(4) NOT NULL,
  `ot_hours2` int(4) NOT NULL,
  `accomplishment` varchar(900) NOT NULL,
  `date_offset` date NOT NULL,
  `date_offset2` date default NULL,
  `remarks` varchar(900) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY  (`offset_id`),
  KEY `emp_num` (`emp_num`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- 
-- Dumping data for table `ems_offset`
-- 

INSERT INTO `ems_offset` VALUES (1, 111, '2011-08-08', '2011-08-20', '2011-08-21', 8, 8, 'Ems', '2011-08-29', '2011-08-30', '', 'Cancelled');
INSERT INTO `ems_offset` VALUES (2, 111, '2011-08-10', '2011-08-06', '2011-08-07', 8, 8, 'pcount', '2011-08-16', '2011-08-18', 'one down.\r\ntwo down.', 'Denied');
INSERT INTO `ems_offset` VALUES (3, 613, '2011-08-17', '2011-08-16', '0000-00-00', 2, 0, 'Sample Accomplishments', '2011-08-29', '0000-00-00', 'Sample Remarks', 'Pending');
INSERT INTO `ems_offset` VALUES (4, 111, '2011-08-23', '2011-08-27', '0000-00-00', 8, 0, 'iEMS Testing.', '2011-08-31', '0000-00-00', 'Family outing.', 'Approved');
INSERT INTO `ems_offset` VALUES (5, 111, '2011-08-26', '2011-08-25', '2011-08-24', 8, 8, 'iEMS', '2011-08-30', '2011-08-31', 'TY', 'Pending');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_ot`
-- 

CREATE TABLE `ems_ot` (
  `ot_id` int(11) NOT NULL,
  `emp_num` int(15) NOT NULL,
  `date_filed` date NOT NULL,
  `date_ot` date NOT NULL,
  `no_of_hours` int(4) NOT NULL,
  `cdc` smallint(1) NOT NULL,
  `expected_output` varchar(900) NOT NULL,
  `status` varchar(20) NOT NULL,
  `remarks` varchar(900) NOT NULL,
  PRIMARY KEY  (`ot_id`),
  KEY `emp_num` (`emp_num`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `ems_ot`
-- 

INSERT INTO `ems_ot` VALUES (1, 111, '2011-08-22', '2011-08-22', 4, 1, 'iEMS', 'Approved', 'Gudoy\r\n');
INSERT INTO `ems_ot` VALUES (2, 20080803, '2011-08-24', '2011-08-24', 2, 1, 'Finish outline for Magic training.', 'Approved', '');
INSERT INTO `ems_ot` VALUES (3, 111, '2011-08-31', '2011-08-26', 4, 1, 'loop', 'Pending', 'Antok aq tsk. ><');
INSERT INTO `ems_ot` VALUES (4, 111, '2011-08-31', '2011-08-31', 4, 1, 'loop', 'Pending', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_photos`
-- 

CREATE TABLE `ems_photos` (
  `img_id` int(11) NOT NULL auto_increment,
  `emp_num` int(15) NOT NULL,
  `path` varchar(200) NOT NULL,
  PRIMARY KEY  (`img_id`),
  KEY `emp_num` (`emp_num`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- 
-- Dumping data for table `ems_photos`
-- 

INSERT INTO `ems_photos` VALUES (2, 666, 'photos/untitled.JPG');
INSERT INTO `ems_photos` VALUES (4, 222, 'photos/before.JPG');
INSERT INTO `ems_photos` VALUES (5, 20081201, 'photos/P8140710.JPG');
INSERT INTO `ems_photos` VALUES (6, 613, 'photos/43878072_9b440a24af_o.jpg');
INSERT INTO `ems_photos` VALUES (7, 111, 'photos/5493.jpg');
INSERT INTO `ems_photos` VALUES (8, 143, 'photos/annecurtis2.jpg');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_undertime`
-- 

CREATE TABLE `ems_undertime` (
  `un_id` int(11) NOT NULL auto_increment,
  `emp_num` int(15) NOT NULL,
  `date_filed` date NOT NULL,
  `date_un` date NOT NULL,
  `nature_un` varchar(100) NOT NULL,
  `time` varchar(20) NOT NULL,
  `reason` varchar(900) NOT NULL,
  `remarks` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY  (`un_id`),
  KEY `emp_num` (`emp_num`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

-- 
-- Dumping data for table `ems_undertime`
-- 

INSERT INTO `ems_undertime` VALUES (1, 111, '2011-08-10', '2011-08-10', 'emergency', '3:30 pm', 'Family problem.', '', 'Denied');
INSERT INTO `ems_undertime` VALUES (6, 111, '2011-08-12', '2011-08-12', 'emergency', '4:30 pm', 'Emergency.', 'Change of mind. Will chose another date instead. WEWEWE', 'Cancelled');
INSERT INTO `ems_undertime` VALUES (7, 999, '2011-08-16', '2011-08-17', 'Emergency', '4:30 pm', 'Need to attend to personal matters.', 'nice to see this working. :)', 'Pending');
INSERT INTO `ems_undertime` VALUES (8, 613, '2011-08-17', '2011-08-17', 'Anticipated', '4:30 pm', 'Sample Undertime', '', 'Approved');
INSERT INTO `ems_undertime` VALUES (9, 111, '2011-08-23', '2011-08-23', 'Anticipated', '3:30 pm', 'Personal matters.', '', 'Cancelled');
INSERT INTO `ems_undertime` VALUES (10, 111, '2011-08-25', '0000-00-00', 'Array', '--:--', '', '', 'Pending');
INSERT INTO `ems_undertime` VALUES (11, 111, '2011-08-31', '0000-00-00', '', '--:--', '', '', 'Pending');
INSERT INTO `ems_undertime` VALUES (12, 111, '2011-08-31', '0000-00-00', '', '--:--', '', '', 'Pending');
INSERT INTO `ems_undertime` VALUES (13, 111, '2011-08-31', '0000-00-00', '', '--:--', '', '', 'Pending');
INSERT INTO `ems_undertime` VALUES (14, 111, '2011-08-31', '0000-00-00', '', '--:--', '', '', 'Pending');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_users`
-- 

CREATE TABLE `ems_users` (
  `user_id` int(11) NOT NULL auto_increment,
  `username` varchar(40) default NULL,
  `password` varchar(200) default NULL,
  `deleted` varchar(3) NOT NULL,
  `emp_num` int(15) default NULL,
  `rights` smallint(1) NOT NULL,
  `status` varchar(8) NOT NULL,
  `is_active` smallint(6) NOT NULL,
  PRIMARY KEY  (`user_id`),
  KEY `emp_num` (`emp_num`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

-- 
-- Dumping data for table `ems_users`
-- 

INSERT INTO `ems_users` VALUES (2, 'chard', '64f2820ec2d6e12bb3396db1505208c3', 'no', 111, 3, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (3, 'hdy', 'e10adc3949ba59abbe56e057f20f883e', 'no', 20000101, 2, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (4, 'jason', '2b877b4b825b48a9a0950dd5bd1f264d', 'no', 222, 2, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (7, 'barbs', '56032de71c59b706e1ec6d4b8b651f33', 'no', 999, 4, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (17, 'Samp', '098f6bcd4621d373cade4e832627b4f6', 'yes', 2141, 3, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (18, 'TestManager', '098f6bcd4621d373cade4e832627b4f6', 'no', 3232, 2, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (19, 'ben', '7fe4771c008a22eb763df47d19e2c6aa', 'no', 777, 2, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (20, 'jamil', '5275cb415e5bc3948e8f2cd492859f26', 'no', 888, 1, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (26, 'fnagnal', 'e10adc3949ba59abbe56e057f20f883e', 'no', 20070801, 2, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (27, 'elegaspi', '0a3eaf8ee2e3a9a479a9173ca1083d8c', 'no', 20080803, 3, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (28, 'admin', '202cb962ac59075b964b07152d234b70', 'no', 1, 1, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (30, 'adchard', '64f2820ec2d6e12bb3396db1505208c3', 'no', 111, 1, 'Enabled', 0);

-- 
-- Constraints for dumped tables
-- 

-- 
-- Constraints for table `ems_accomplishments`
-- 
ALTER TABLE `ems_accomplishments`
  ADD CONSTRAINT `ems_accomplishments_ibfk_1` FOREIGN KEY (`ot_id`) REFERENCES `ems_ot` (`ot_id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `ems_air_ticket`
-- 
ALTER TABLE `ems_air_ticket`
  ADD CONSTRAINT `ems_air_ticket_ibfk_1` FOREIGN KEY (`emp_num`) REFERENCES `ems_employee` (`emp_num`);

-- 
-- Constraints for table `ems_emp_dependents`
-- 
ALTER TABLE `ems_emp_dependents`
  ADD CONSTRAINT `ems_emp_dependents_ibfk_1` FOREIGN KEY (`emp_num`) REFERENCES `ems_employee` (`emp_num`);

-- 
-- Constraints for table `ems_equip_requisitions`
-- 
ALTER TABLE `ems_equip_requisitions`
  ADD CONSTRAINT `ems_equip_requisitions_ibfk_1` FOREIGN KEY (`emp_num`) REFERENCES `ems_employee` (`emp_num`);

-- 
-- Constraints for table `ems_leave`
-- 
ALTER TABLE `ems_leave`
  ADD CONSTRAINT `ems_leave_ibfk_1` FOREIGN KEY (`emp_num`) REFERENCES `ems_employee` (`emp_num`);

-- 
-- Constraints for table `ems_ot`
-- 
ALTER TABLE `ems_ot`
  ADD CONSTRAINT `ems_ot_ibfk_1` FOREIGN KEY (`emp_num`) REFERENCES `ems_employee` (`emp_num`);

-- 
-- Constraints for table `ems_users`
-- 
ALTER TABLE `ems_users`
  ADD CONSTRAINT `ems_users_ibfk_1` FOREIGN KEY (`emp_num`) REFERENCES `ems_employee` (`emp_num`) ON DELETE SET NULL;
