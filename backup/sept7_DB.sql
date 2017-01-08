-- phpMyAdmin SQL Dump
-- version 2.10.0.2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Sep 07, 2011 at 10:17 AM
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

CREATE TABLE IF NOT EXISTS `ems_accomplishments` (
  `ot_id` varchar(15) NOT NULL,
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

INSERT INTO `ems_accomplishments` VALUES ('ovt-0001', '2011-09-06', '12:00 am', '1:00 am', 1, 'This is my actual output. This is my actual output. This is my actual output. This is my actual output. This is my actual output. This is my actual output. This is my actual output. This is my actual output. This is my actual output. This is my actual output. This is my actual output. This is my actual output. This is my actual output. ', '', 'Approved', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_active_user`
-- 

CREATE TABLE IF NOT EXISTS `ems_active_user` (
  `ID` int(4) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `emp_num` varchar(15) NOT NULL,
  `status` smallint(1) NOT NULL,
  PRIMARY KEY  (`ID`),
  KEY `emp_num` (`emp_num`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- 
-- Dumping data for table `ems_active_user`
-- 

INSERT INTO `ems_active_user` VALUES (1, 2, '111', 1);
INSERT INTO `ems_active_user` VALUES (2, 30, '111', 0);
INSERT INTO `ems_active_user` VALUES (3, 28, '1', 0);
INSERT INTO `ems_active_user` VALUES (4, 3, '20000101', 0);
INSERT INTO `ems_active_user` VALUES (5, 7, '999', 0);
INSERT INTO `ems_active_user` VALUES (6, 27, '20080803', 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_air_ticket`
-- 

CREATE TABLE IF NOT EXISTS `ems_air_ticket` (
  `at_id` varchar(15) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `ems_air_ticket`
-- 

INSERT INTO `ems_air_ticket` VALUES ('air-0001', 111, '2011-09-06', 'Super 8', 'Manila', 'Cebu', 'Cebu Pac', 'Aug-13-2011 11:00:00 PM', 'Aug-13-2011 11:50:00 PM', 'Seminar.', '', '', 'Pending', 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_attachments`
-- 

CREATE TABLE IF NOT EXISTS `ems_attachments` (
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

CREATE TABLE IF NOT EXISTS `ems_benefits` (
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

CREATE TABLE IF NOT EXISTS `ems_business_units` (
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

CREATE TABLE IF NOT EXISTS `ems_department` (
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

CREATE TABLE IF NOT EXISTS `ems_emergency_contacts` (
  `ec_id` int(10) NOT NULL auto_increment,
  `emp_num` int(15) NOT NULL,
  `ecc_name` varchar(100) default NULL,
  `ecc_relationship` varchar(100) default NULL,
  `ecc_home_no` varchar(25) default NULL,
  `ecc_mobile_no` varchar(25) default NULL,
  `ecc_office_no` varchar(25) default NULL,
  PRIMARY KEY  (`ec_id`),
  KEY `emp_num` (`emp_num`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- 
-- Dumping data for table `ems_emergency_contacts`
-- 

INSERT INTO `ems_emergency_contacts` VALUES (8, 111, 'Angelita Ladiana', 'mother', '7920622', '333', '1234');
INSERT INTO `ems_emergency_contacts` VALUES (10, 20081201, 'Erlinda D. Viloria', 'Mother', '', '', '');
INSERT INTO `ems_emergency_contacts` VALUES (11, 613, 'Mia', 'Mother', 'gfdgdfgdfgfd1212', 'dsfsdf112', 'sdfsdfsdfd1212');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_employee`
-- 

CREATE TABLE IF NOT EXISTS `ems_employee` (
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
INSERT INTO `ems_employee` VALUES (111, '2011-08-01', '0000-00-00', '0000-00-00', 'Ladiana', 'Richard Allan', 'Godoy', 'DEPT002', 2, 5, 'EST002', 'male', 'Ortigas', 'Bulacan', 'Pasig            ', 'Bulacan', '', '7929662', '09386867806', '', 'raladiana.iripple@gmail.com', 'mackyboy_09@yahoo.com.ph', '1990-01-09', '2222565652', '333', '555424234', '4444');
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
INSERT INTO `ems_employee` VALUES (20080803, '0000-00-00', '0000-00-00', '0000-00-00', 'Legaspi', 'Eizell', 'Unidad', 'DEPT010', 8, 5, 'EST003', NULL, '', '', ' ', '', '', '', '', '', 'elegaspi@iripple.com', '', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_emp_dependents`
-- 

CREATE TABLE IF NOT EXISTS `ems_emp_dependents` (
  `ed_id` int(10) NOT NULL auto_increment,
  `emp_num` int(15) NOT NULL,
  `ed_name` varchar(100) default NULL,
  `ed_relationship` varchar(100) default NULL,
  `ed_datebirth` date default NULL,
  PRIMARY KEY  (`ed_id`),
  KEY `emp_num` (`emp_num`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- 
-- Dumping data for table `ems_emp_dependents`
-- 

INSERT INTO `ems_emp_dependents` VALUES (6, 111, 'neo potpot', 'pinsan', '2004-04-04');
INSERT INTO `ems_emp_dependents` VALUES (7, 613, 'neo', 'pamangkin', '2004-04-04');
INSERT INTO `ems_emp_dependents` VALUES (8, 613, 'neo', 'pamangkin', '2004-04-04');
INSERT INTO `ems_emp_dependents` VALUES (9, 613, 'neo', 'pamangkin', '2004-04-04');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_emp_status`
-- 

CREATE TABLE IF NOT EXISTS `ems_emp_status` (
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

CREATE TABLE IF NOT EXISTS `ems_equip_requests` (
  `erqst_id` varchar(15) NOT NULL,
  `emp_num` int(15) NOT NULL,
  `date_filed` date NOT NULL,
  `subject_purpose` varchar(30) NOT NULL,
  `client_branch` varchar(30) NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `no_of_days` int(4) NOT NULL,
  `equip_list` varchar(200) NOT NULL,
  `status` varchar(20) NOT NULL,
  `remarks` text NOT NULL,
  PRIMARY KEY  (`erqst_id`),
  KEY `emp_num` (`emp_num`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `ems_equip_requests`
-- 

INSERT INTO `ems_equip_requests` VALUES ('rsv-0001', 111, '2011-09-06', 'meeting', 'iRipple', '2011-09-06', '2011-09-06', 1, 'Mouse|', 'Pending', '');
INSERT INTO `ems_equip_requests` VALUES ('rsv-0002', 111, '2011-09-06', 'meeting', 'Super 8', '2011-09-07', '2011-09-08', 2, 'Projector|Laptop|Mouse|', 'Pending', '');
INSERT INTO `ems_equip_requests` VALUES ('rsv-0003', 111, '2011-09-06', 'das', 'COH', '2011-09-13', '2011-09-13', 1, 'Wireless Internet Device|', 'Pending', '');
INSERT INTO `ems_equip_requests` VALUES ('rsv-0004', 111, '2011-09-06', 'das', 'adsf', '2011-09-07', '2011-09-07', 1, 'Keyboard|Monitor|', 'Pending', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_equip_requisitions`
-- 

CREATE TABLE IF NOT EXISTS `ems_equip_requisitions` (
  `erqstn_id` varchar(15) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `ems_equip_requisitions`
-- 

INSERT INTO `ems_equip_requisitions` VALUES ('ER2011001', 111, '2011-09-06', '2011-09-09', '1|', 'mouse pad|', 'sdf', '', 'Pending', '');
INSERT INTO `ems_equip_requisitions` VALUES ('ER2011002', 111, '2011-09-06', '2011-09-14', '1|', 'keyboard|', 'ou e', '', 'Pending', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_geninfo`
-- 

CREATE TABLE IF NOT EXISTS `ems_geninfo` (
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

CREATE TABLE IF NOT EXISTS `ems_joblevel` (
  `jl_id` int(11) NOT NULL auto_increment,
  `job_level` varchar(4) NOT NULL,
  `rank` varchar(30) NOT NULL,
  `grade` varchar(2) NOT NULL,
  PRIMARY KEY  (`jl_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- 
-- Dumping data for table `ems_joblevel`
-- 

INSERT INTO `ems_joblevel` VALUES (5, '2', 'Staff', '1');
INSERT INTO `ems_joblevel` VALUES (7, '1', 'Supervisor', '1');
INSERT INTO `ems_joblevel` VALUES (8, '8', 'Test', '5');
INSERT INTO `ems_joblevel` VALUES (10, '9', 'Test', '10');
INSERT INTO `ems_joblevel` VALUES (11, '2', 'Staff', '3');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_jobtitle`
-- 

CREATE TABLE IF NOT EXISTS `ems_jobtitle` (
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

CREATE TABLE IF NOT EXISTS `ems_leave` (
  `leave_id` varchar(15) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `ems_leave`
-- 

INSERT INTO `ems_leave` VALUES ('lve-0001', 111, '2011-09-06', '2011-09-08', '2011-09-08', 1, '', 'Vacation Leave', 0, 'good', '', 'Pending');
INSERT INTO `ems_leave` VALUES ('lve-0002', 111, '2011-09-07', '2011-09-09', '2011-09-12', 4, '', 'Vacation Leave', 0, 'sdf', '', 'Pending');
INSERT INTO `ems_leave` VALUES ('lve-0003', 111, '2011-09-07', '2011-09-09', '2011-09-12', 4, '', 'Vacation Leave', 0, 'sdf', '', 'Pending');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_ob`
-- 

CREATE TABLE IF NOT EXISTS `ems_ob` (
  `ob_id` varchar(15) NOT NULL,
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
  `duration` float NOT NULL,
  `arrival` varchar(100) NOT NULL,
  `total` float NOT NULL,
  PRIMARY KEY  (`ob_id`),
  KEY `emp_num` (`emp_num`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `ems_ob`
-- 

INSERT INTO `ems_ob` VALUES ('ofb-0001', 111, '2011-09-06', 'Super 8', '2011-09-05', 'Network|', 'Pending', '', '12:00 am', '1:10 am', '1:20 am', 1.5, '1:15 am', 2.5);
INSERT INTO `ems_ob` VALUES ('ofb-0002', 111, '2011-09-06', 'Super 8', '2011-09-07', 'Network|', 'Pending', '', '12:05 am ', '1:10 am', '1:20 am', 3, '1:20 am', 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_offset`
-- 

CREATE TABLE IF NOT EXISTS `ems_offset` (
  `offset_id` varchar(15) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `ems_offset`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `ems_ot`
-- 

CREATE TABLE IF NOT EXISTS `ems_ot` (
  `ot_id` varchar(15) NOT NULL,
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

INSERT INTO `ems_ot` VALUES ('ovt-0001', 111, '2011-09-06', '2011-09-06', 3, 1, 'iems module. iems module. iems module. iems module. iems module. iems module. iems module. iems module. iems module. ', 'Approved', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_photos`
-- 

CREATE TABLE IF NOT EXISTS `ems_photos` (
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
-- Table structure for table `ems_remarks`
-- 

CREATE TABLE IF NOT EXISTS `ems_remarks` (
  `remarks_id` int(8) NOT NULL auto_increment,
  `id` varchar(15) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL,
  `remarks` text NOT NULL,
  PRIMARY KEY  (`remarks_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

-- 
-- Dumping data for table `ems_remarks`
-- 

INSERT INTO `ems_remarks` VALUES (1, 'lve-0001', '111', 'updated last: Sep 07, 2011 03:09:23 pm', 'cge nga update ko nga to. hmm');
INSERT INTO `ems_remarks` VALUES (3, 'und-0001', '20000101', 'updated last: Sep 07, 2011 03:03:52 pm', 'hello universe. gumana na ung ginawa ko .');
INSERT INTO `ems_remarks` VALUES (4, 'und-0002', '20000101', 'created: Sep 07, 2011 11:46:54 am', 'hello captain america.');
INSERT INTO `ems_remarks` VALUES (8, 'lve-0001', '20000101', 'updated last: Sep 07, 2011 03:03:30 pm', 'yeah baby yeah.');
INSERT INTO `ems_remarks` VALUES (9, 'und-0002', '111', 'updated last: Sep 07, 2011 03:06:41 pm', 'pst');
INSERT INTO `ems_remarks` VALUES (11, 'ovt-0001', '111', 'updated last: Sep 07, 2011 03:17:20 pm', 'remarks.');
INSERT INTO `ems_remarks` VALUES (13, 'ER2011001', '111', 'created: Sep 07, 2011 03:45:48 pm', 'hey');
INSERT INTO `ems_remarks` VALUES (14, 'ER2011002', '111', 'created: Sep 07, 2011 03:46:05 pm', 'bat kanina po ayaw gumana nito?');
INSERT INTO `ems_remarks` VALUES (15, 'rsv-0001', '1', 'created: Sep 07, 2011 05:17:19 pm', 'ok sure.');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_undertime`
-- 

CREATE TABLE IF NOT EXISTS `ems_undertime` (
  `un_id` varchar(15) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `ems_undertime`
-- 

INSERT INTO `ems_undertime` VALUES ('und-0001', 111, '2011-09-06', '2011-09-06', 'Emergency', '5:00 pm', 'antok ako e.', '', 'Pending');
INSERT INTO `ems_undertime` VALUES ('und-0002', 111, '2011-09-06', '2011-09-06', 'Anticipated', '4:00 pm', 'wala lang.', '', 'Pending');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_users`
-- 

CREATE TABLE IF NOT EXISTS `ems_users` (
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
INSERT INTO `ems_users` VALUES (27, 'elegaspi', '9f1538a2f5d2614f4cb7dba3c41ed3ea', 'no', 20080803, 3, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (28, 'admin', '202cb962ac59075b964b07152d234b70', 'no', 1, 1, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (30, 'adchard', 'b15ab48a6b37940b454bfa5a5dd44709', 'no', 111, 1, 'Enabled', 0);

-- 
-- Constraints for dumped tables
-- 

-- 
-- Constraints for table `ems_accomplishments`
-- 
ALTER TABLE `ems_accomplishments`
  ADD CONSTRAINT `ems_accomplishments_ibfk_1` FOREIGN KEY (`ot_id`) REFERENCES `ems_ot` (`ot_id`) ON DELETE CASCADE;

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
