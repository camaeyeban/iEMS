-- phpMyAdmin SQL Dump
-- version 2.10.0.2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Oct 21, 2011 at 10:01 AM
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

DROP TABLE IF EXISTS `ems_accomplishments`;
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

INSERT INTO `ems_accomplishments` VALUES ('ovt-0001', '2011-09-30', '', '', 0, '', '', '', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0002', '2011-10-20', '', '', 0, '', '', '', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_active_user`
-- 

DROP TABLE IF EXISTS `ems_active_user`;
CREATE TABLE IF NOT EXISTS `ems_active_user` (
  `ID` int(4) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `emp_num` int(15) NOT NULL,
  `status` smallint(1) NOT NULL,
  PRIMARY KEY  (`ID`),
  KEY `emp_num` (`emp_num`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- 
-- Dumping data for table `ems_active_user`
-- 

INSERT INTO `ems_active_user` VALUES (1, 1, 1, 0);
INSERT INTO `ems_active_user` VALUES (2, 14, 1114, 2);
INSERT INTO `ems_active_user` VALUES (3, 3, 444, 0);
INSERT INTO `ems_active_user` VALUES (4, 7, 789, 0);
INSERT INTO `ems_active_user` VALUES (5, 12, 123, 0);
INSERT INTO `ems_active_user` VALUES (6, 4, 456, 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_air_ticket`
-- 

DROP TABLE IF EXISTS `ems_air_ticket`;
CREATE TABLE IF NOT EXISTS `ems_air_ticket` (
  `at_id` varchar(15) NOT NULL,
  `emp_num` int(15) NOT NULL,
  `date_filed` date NOT NULL,
  `client` varchar(30) NOT NULL,
  `origin` varchar(50) NOT NULL,
  `destination` varchar(50) NOT NULL,
  `airline` varchar(20) NOT NULL,
  `departure` varchar(100) NOT NULL,
  `arrival` varchar(100) NOT NULL,
  `purpose` varchar(900) NOT NULL,
  `type` varchar(20) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `status` varchar(50) NOT NULL,
  `state` smallint(1) NOT NULL,
  `attachment` varchar(200) NOT NULL,
  PRIMARY KEY  (`at_id`),
  KEY `emp_num` (`emp_num`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `ems_air_ticket`
-- 

INSERT INTO `ems_air_ticket` VALUES ('air-0004', 1114, '2011-10-14', 'Super 8', 'manila<br/>cebu', 'cebu<br/>manila', 'Tiger ', 'Aug-5-2011 03:00:00 PM', 'Aug-13-2011 11:50:00 PM', 'round trip 2', 'rt', '5000', 'Re-booked', 7, '');
INSERT INTO `ems_air_ticket` VALUES ('air-0005', 1114, '2011-10-14', 'iRipple', 'manila<br/>cebu', 'davao<br/>manila', 'Cebu Pacific', 'Oct-14-2011 11:19:27 AM<br/>Oct-15-2011 11:19:27 AM<br/>Oct-16-2011 11:19:27 AM', '', 'sample multi', 'multi', '10000', 'Booked', 3, 'remarksems_remarks.sql');
INSERT INTO `ems_air_ticket` VALUES ('air-0006', 123, '2011-10-19', '360', 'Manila<br/>Cebu', 'Cebu<br/>Manila', 'PAL', 'Oct-20-2011 10:00:00 PM', '', 'Customer Service and Technical Training', 'ow', '35000', 'Re-booked', 7, 'Cecilia Dy_OR_2.JPG');
INSERT INTO `ems_air_ticket` VALUES ('air-0007', 123, '2011-10-19', 'COH', 'Manila<br/>Cebu', 'Cebu<br/>Manila', 'PAL', 'Oct-19-2011 03:00:00 PM', 'Oct-24-2011 02:00:00 PM', 'Seminar', 'rt', '4000', 'Re-booked', 7, '');
INSERT INTO `ems_air_ticket` VALUES ('air-0008', 123, '2011-10-19', 'Citihardware', 'Manila<br/>General Santos', 'General Santos<br/>Manila', 'Cebu Pac', 'Oct-19-2011 02:05:09 PM', 'Oct-20-2011 02:05:09 PM', 'Client visit', 'rt', '4000', 'Booked', 3, 'DSL Proposal Page 2.jpg');
INSERT INTO `ems_air_ticket` VALUES ('air-0009', 123, '2011-10-19', 'Citihardware', 'Manila<br/>General Santos', 'Cebu<br/>Manila', 'Cebu Pac', 'Oct-25-2011 02:18:33 PM<br/>Oct-26-2011 02:18:33 PM<br/>Oct-27-2011 02:18:33 PM', '', 'Client meeting to General Santos and sales call to Cebu', 'multi', '9500', 'Booked', 3, 'ajax-loader.gif');
INSERT INTO `ems_air_ticket` VALUES ('air-0010', 1114, '2011-10-20', 'Citihardware', 'manila<br/>cebu', 'cebu<br/>manila', 'PAL', 'Oct-20-2011 01:34:13 PM', '', 'sample', 'ow', '5000', 'Booked', 3, 'mac.txt');
INSERT INTO `ems_air_ticket` VALUES ('air-0011', 1114, '2011-10-20', 'sample', 'sample<br/>sample', 'sample<br/>sample', 'sample', 'Oct-27-2011 01:53:56 PM', '', 'sample', 'ow', '5000', 'Reviewed', 2, '');
INSERT INTO `ems_air_ticket` VALUES ('air-0012', 123, '2011-10-20', 'Primer', 'Manila<br/>Cebu', 'Cebu<br/>Manila', 'Airphil', 'Oct-20-2011 01:50:55 PM', '', 'Live store opening.', 'ow', '5000', 'Booked', 3, 'EMS Accomplishment.docx');
INSERT INTO `ems_air_ticket` VALUES ('air-0013', 123, '2011-10-20', 'Sari Sari Breadstore', 'Manila<br/>Iloilo', 'Iloilo<br/>Manila', 'PAL', 'Oct-21-2011 02:02:21 PM', 'Oct-31-2011 02:02:21 PM', 'Business Process Mapping', 'rt', '8000', 'Booked', 3, '');
INSERT INTO `ems_air_ticket` VALUES ('air-0014', 123, '2011-10-20', 'Afficionado', 'Manila<br/>Bacolod', 'Iloilo<br/>Manila', 'PAL', 'Oct-20-2011 02:03:24 PM<br/>Oct-26-2011 02:03:24 PM<br/>Oct-29-2011 02:03:24 PM', '', 'Client meeting and store visit', 'multi', '5435.00', 'Booked', 3, 'Home Page_2.jpg');
INSERT INTO `ems_air_ticket` VALUES ('air-0015', 123, '2011-10-20', 'COH', 'Manila<br/>Cebu', 'Cebu<br/>Manila', 'PAL', 'Oct-24-2011 7:03:28 PM', 'Oct-26-2011 06:03:28 PM', 'Seminar', 'rt', '4700.00', 'Booked', 3, 'quotes.rtf');
INSERT INTO `ems_air_ticket` VALUES ('air-0016', 1114, '2011-10-21', 'Super 8', 'Manila<br/>iloilo', 'iloilo<br/>Manila', 'Cebu Pacific', 'Oct-26-2011 05:21:02 PM', '', 'Client visit', 'ow', '', 'Pending', 0, '');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_announcement`
-- 

DROP TABLE IF EXISTS `ems_announcement`;
CREATE TABLE IF NOT EXISTS `ems_announcement` (
  `ann_id` int(10) NOT NULL auto_increment,
  `title` varchar(100) default NULL,
  `day` date default NULL,
  `time` varchar(100) default NULL,
  `location` varchar(100) default NULL,
  `created_by` varchar(100) default NULL,
  `date_created` varchar(30) default NULL,
  `info` text,
  `photo` varchar(100) NOT NULL,
  PRIMARY KEY  (`ann_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `ems_announcement`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `ems_attachments`
-- 

DROP TABLE IF EXISTS `ems_attachments`;
CREATE TABLE IF NOT EXISTS `ems_attachments` (
  `a_id` int(11) NOT NULL auto_increment,
  `emp_num` int(15) NOT NULL,
  `path` varchar(200) NOT NULL,
  `file_name` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `size` varchar(10) NOT NULL,
  `type` varchar(20) NOT NULL,
  PRIMARY KEY  (`a_id`),
  KEY `emp_num` (`emp_num`),
  KEY `emp_num_2` (`emp_num`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `ems_attachments`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `ems_benefits`
-- 

DROP TABLE IF EXISTS `ems_benefits`;
CREATE TABLE IF NOT EXISTS `ems_benefits` (
  `ben_id` int(10) NOT NULL auto_increment,
  `emp_num` int(15) default NULL,
  `sl_num` float default NULL,
  `vl_num` float default NULL,
  PRIMARY KEY  (`ben_id`),
  KEY `leave_id` (`emp_num`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `ems_benefits`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `ems_business_units`
-- 

DROP TABLE IF EXISTS `ems_business_units`;
CREATE TABLE IF NOT EXISTS `ems_business_units` (
  `b_id` int(4) NOT NULL auto_increment,
  `dept_code` varchar(10) default NULL,
  `b_manager_name` varchar(100) NOT NULL,
  `oic` varchar(10) NOT NULL,
  PRIMARY KEY  (`b_id`),
  KEY `dept_code` (`dept_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- 
-- Dumping data for table `ems_business_units`
-- 

INSERT INTO `ems_business_units` VALUES (2, 'DEP-0002', 'Mary Anne Unson', 'None');
INSERT INTO `ems_business_units` VALUES (3, 'DEP-0003', 'Benito Viloria', 'None');
INSERT INTO `ems_business_units` VALUES (4, 'DEP-0004', 'Fracy Nagnal', 'None');
INSERT INTO `ems_business_units` VALUES (5, 'DEP-0005', 'Julie Cruz', 'None');
INSERT INTO `ems_business_units` VALUES (6, 'DEP-0006', 'Jennilyn See', 'None');
INSERT INTO `ems_business_units` VALUES (7, 'DEP-0007', 'Christian Dan Enrique', 'None');
INSERT INTO `ems_business_units` VALUES (8, 'DEP-0008', 'Eizell Legaspi', 'None');
INSERT INTO `ems_business_units` VALUES (9, 'DEP-0009', 'Julie Keng', 'None');
INSERT INTO `ems_business_units` VALUES (10, 'DEP-0001', 'Venice Ann Alluso', 'None');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_department`
-- 

DROP TABLE IF EXISTS `ems_department`;
CREATE TABLE IF NOT EXISTS `ems_department` (
  `dept_code` varchar(10) NOT NULL default '',
  `dept_name` varchar(50) NOT NULL,
  PRIMARY KEY  (`dept_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `ems_department`
-- 

INSERT INTO `ems_department` VALUES ('DEP-0001', 'Accounting');
INSERT INTO `ems_department` VALUES ('DEP-0002', 'Marketing / Hardware');
INSERT INTO `ems_department` VALUES ('DEP-0003', 'Product');
INSERT INTO `ems_department` VALUES ('DEP-0004', 'Project Implementation');
INSERT INTO `ems_department` VALUES ('DEP-0005', 'Support');
INSERT INTO `ems_department` VALUES ('DEP-0006', 'Sales');
INSERT INTO `ems_department` VALUES ('DEP-0007', 'Pharma');
INSERT INTO `ems_department` VALUES ('DEP-0008', 'Human Resource');
INSERT INTO `ems_department` VALUES ('DEP-0009', 'Admin');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_emergency_contacts`
-- 

DROP TABLE IF EXISTS `ems_emergency_contacts`;
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- 
-- Dumping data for table `ems_emergency_contacts`
-- 

INSERT INTO `ems_emergency_contacts` VALUES (3, 1114, 'Angelita', 'Mother', '7920622', '09386867806', '6681234');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_employee`
-- 

DROP TABLE IF EXISTS `ems_employee`;
CREATE TABLE IF NOT EXISTS `ems_employee` (
  `emp_num` int(15) NOT NULL,
  `date_employ` date NOT NULL,
  `date_reg` date NOT NULL,
  `date_sep` date NOT NULL,
  `emp_lastname` varchar(100) default NULL,
  `emp_firstname` varchar(100) default NULL,
  `emp_middlename` varchar(100) default NULL,
  `b_id` int(4) default NULL,
  `dept_code` varchar(10) default NULL,
  `job_title_code` int(10) default NULL,
  `jl_id` int(4) default NULL,
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
  `birthdate` date NOT NULL,
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

INSERT INTO `ems_employee` VALUES (1, '0000-00-00', '0000-00-00', '0000-00-00', 'iRipple', 'iEMS Admin', '', 0, NULL, NULL, 0, NULL, 'male', '', '', '  ', '', '', '', '', '', 'mackyboy_09@yahoo.com.ph', '', '1970-01-01', '', '', '', '');
INSERT INTO `ems_employee` VALUES (123, '0000-00-00', '0000-00-00', '0000-00-00', 'Legaspi', 'Eizell', '', 9, 'DEP-0009', 0, 0, '', 'female', '', '', ' ', '', '', '', '', '', 'elegaspi@iripple.com', '', '1984-08-14', '', '', '', '');
INSERT INTO `ems_employee` VALUES (222, '0000-00-00', '0000-00-00', '0000-00-00', 'Alluso', 'Venice Ann', '', 0, NULL, NULL, 0, NULL, 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01', '', '', '', '');
INSERT INTO `ems_employee` VALUES (333, '0000-00-00', '0000-00-00', '0000-00-00', 'Unson', 'Mary Anne', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL);
INSERT INTO `ems_employee` VALUES (444, '0000-00-00', '0000-00-00', '0000-00-00', 'Viloria', 'Benito', '', 9, 'DEP-0003', 0, 0, '', 'male', '', '', '  ', '', '', '', '', '', 'raladiana.iripple@gmail.com', '', '1970-01-01', '', '', '', '');
INSERT INTO `ems_employee` VALUES (456, '0000-00-00', '0000-00-00', '0000-00-00', 'Keng', 'Julie', '', 9, 'DEP-0009', 0, 0, '', 'female', '', '', '  ', '', '', '', '', '', 'elegaspi@iripple.com', '', '1970-01-01', '', '', '', '');
INSERT INTO `ems_employee` VALUES (555, '0000-00-00', '0000-00-00', '0000-00-00', 'Nagnal', 'Fracy', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL);
INSERT INTO `ems_employee` VALUES (777, '0000-00-00', '0000-00-00', '0000-00-00', 'See', 'Jennilyn', '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL);
INSERT INTO `ems_employee` VALUES (789, '0000-00-00', '0000-00-00', '0000-00-00', 'Balingit', 'Barbs', '', 6, 'DEP-0006', 0, 0, '', NULL, '', '', '  ', '', '', '', '', '', 'elegaspi@iripple.com', '', '0000-00-00', NULL, NULL, NULL, NULL);
INSERT INTO `ems_employee` VALUES (888, '0000-00-00', '0000-00-00', '0000-00-00', 'Enrique', 'Christian Dan', '', 0, NULL, NULL, 0, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', '', '', '', '');
INSERT INTO `ems_employee` VALUES (999, '0000-00-00', '0000-00-00', '0000-00-00', 'Cruz', 'Julie', '', 9, 'DEP-0005', 0, 0, '', 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01', '', '', '', '');
INSERT INTO `ems_employee` VALUES (1114, '2011-09-01', '0000-00-00', '0000-00-00', 'Ladiana', 'Richard Allan', 'Godoy', 3, 'DEP-0003', 2, 5, '', 'male', '', '', '  ', '', '', '', '', '', 'raladiana.iripple@gmail.com', '', '1990-01-09', '', '', '', '');
INSERT INTO `ems_employee` VALUES (1818, '2011-09-23', '0000-00-00', '0000-00-00', 'Tayson', 'Jamil Rose', 'J', 4, 'DEP-0004', 5, 10, 'EST004', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL);
INSERT INTO `ems_employee` VALUES (40404, '2011-09-23', '0000-00-00', '0000-00-00', 'Casiano', 'Neo Ethan', 'Ladiana', 7, 'DEP-0007', 9, 5, 'EST001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_emp_dependents`
-- 

DROP TABLE IF EXISTS `ems_emp_dependents`;
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

INSERT INTO `ems_emp_dependents` VALUES (3, 1, 'chard', 'tito', '0000-00-00');
INSERT INTO `ems_emp_dependents` VALUES (4, 1, 'dept4', 'hello', '2011-09-08');
INSERT INTO `ems_emp_dependents` VALUES (6, 1114, 'neo', 'pamangking tunays', '2004-04-04');
INSERT INTO `ems_emp_dependents` VALUES (8, 1114, 'jamil', 'girlfriend', '1990-11-06');
INSERT INTO `ems_emp_dependents` VALUES (9, 123, 'Roselia U Legaspi', 'Mother', '1950-12-22');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_emp_status`
-- 

DROP TABLE IF EXISTS `ems_emp_status`;
CREATE TABLE IF NOT EXISTS `ems_emp_status` (
  `code` varchar(15) NOT NULL,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY  (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `ems_emp_status`
-- 

INSERT INTO `ems_emp_status` VALUES ('EST001', 'Regular');
INSERT INTO `ems_emp_status` VALUES ('EST002', 'Contractual');
INSERT INTO `ems_emp_status` VALUES ('EST003', 'Resign');
INSERT INTO `ems_emp_status` VALUES ('EST004', 'Probationary');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_equip_requests`
-- 

DROP TABLE IF EXISTS `ems_equip_requests`;
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

INSERT INTO `ems_equip_requests` VALUES ('rsv-0001', 1114, '2011-09-14', 'meeting', 'iRipple', '2011-09-29', '2011-09-29', 1, 'Projector|Laptop|', 'Approved', '');
INSERT INTO `ems_equip_requests` VALUES ('rsv-0002', 1114, '2011-09-30', 'meeting', 'iRipple', '2011-09-30', '2011-09-30', 1, 'Projector|', 'Pending', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_equip_requisitions`
-- 

DROP TABLE IF EXISTS `ems_equip_requisitions`;
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

INSERT INTO `ems_equip_requisitions` VALUES ('ER2011002', 1114, '2011-09-16', '2011-09-23', '1|', 'mouse|', 'hello', '', 'Pending', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_geninfo`
-- 

DROP TABLE IF EXISTS `ems_geninfo`;
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

DROP TABLE IF EXISTS `ems_joblevel`;
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

DROP TABLE IF EXISTS `ems_jobtitle`;
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

INSERT INTO `ems_jobtitle` VALUES (2, 'Software Engineer', '', '', 0);
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

DROP TABLE IF EXISTS `ems_leave`;
CREATE TABLE IF NOT EXISTS `ems_leave` (
  `leave_id` varchar(15) NOT NULL,
  `emp_num` int(15) NOT NULL,
  `date_filed` date NOT NULL,
  `d_from` date NOT NULL,
  `d_to` date NOT NULL,
  `no_of_days` float NOT NULL,
  `time` varchar(8) NOT NULL,
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

INSERT INTO `ems_leave` VALUES ('lve-0001', 1114, '2011-09-23', '2011-09-29', '2011-09-30', 2, 'AM PM ', 'Vacation Leave', 1, 'hapi vacation.', '', 'Approved');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_ob`
-- 

DROP TABLE IF EXISTS `ems_ob`;
CREATE TABLE IF NOT EXISTS `ems_ob` (
  `ob_id` varchar(15) NOT NULL,
  `emp_num` int(15) NOT NULL,
  `date_filed` date NOT NULL,
  `client_branch` varchar(50) NOT NULL,
  `ob_from` date NOT NULL,
  `ob_to` date NOT NULL,
  `purpose` varchar(900) NOT NULL,
  `status` varchar(50) NOT NULL,
  `remarks` varchar(900) NOT NULL,
  `departure` varchar(100) NOT NULL,
  `time_start` varchar(10) NOT NULL,
  `time_end` varchar(10) NOT NULL,
  `duration` varchar(10) NOT NULL,
  `arrival` varchar(100) NOT NULL,
  `total` varchar(10) NOT NULL,
  PRIMARY KEY  (`ob_id`),
  KEY `emp_num` (`emp_num`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `ems_ob`
-- 

INSERT INTO `ems_ob` VALUES ('ofb-0002', 1114, '2011-10-19', 'iRipple', '2011-10-18', '2011-10-19', 'Delivery|', 'Pending for Approval', '', '60 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0003', 1114, '2011-10-19', 'iRipple', '2011-10-18', '0000-00-00', 'Network|', 'Pending for Approval', '', '70 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0004', 123, '2011-10-19', 'Pag-ibig Fund', '2011-10-19', '0000-00-00', 'Others|Seminar on online registration|', 'Cancelled', '', '705 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0005', 123, '2011-10-19', 'Pag-ibig Fund', '2011-10-19', '0000-00-00', 'Others|Seminar|', 'Confirmed', '', '705 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0006', 123, '2011-10-19', 'Magic/Dagupan', '2011-09-12', '2011-09-23', 'Others|Barter Software Training|', 'Pending for Approval', '', '600 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0007', 1114, '2011-10-19', 'Super 8', '2011-10-19', '0000-00-00', 'Delivery|', 'Approved', '', '540 ', '600', '720', '2.0', '780', '3.0');
INSERT INTO `ems_ob` VALUES ('ofb-0008', 123, '2011-10-20', 'Magic', '2011-10-18', '2011-10-19', 'Network|', 'Pending for Approval', '', '780 ', '840', '1620', '13.0', '1740', '15.0');
INSERT INTO `ems_ob` VALUES ('ofb-0009', 1114, '2011-10-20', 'iRipple', '2011-10-20', '2011-10-25', 'Network|', 'Pending for Confirmation', '', '--Select--', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0010', 1114, '2011-10-20', 'Citihardware', '2011-10-10', '2011-10-14', 'Delivery|', 'Pending for Approval', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0011', 123, '2011-10-20', 'Nesabel', '2011-10-04', '2011-10-04', 'Others|Checking of POS|', 'Pending for Approval', '', '780 ', '870', '1140', '4.30', '1320', '7.30');
INSERT INTO `ems_ob` VALUES ('ofb-0012', 123, '2011-10-20', 'Nesabel', '2011-10-19', '2011-10-20', 'Network|', 'Pending for Approval', '', '540 ', '600', '1560', '16.0', '1740', '19.0');
INSERT INTO `ems_ob` VALUES ('ofb-0013', 123, '2011-10-20', 'Magic/Dagupan', '2011-10-24', '2011-10-31', 'Others|Barter Software Training|', 'Pending for Approval', '', '', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0014', 123, '2011-10-20', 'Magic/Dagupan', '2011-10-21', '2011-10-31', 'Others|Training|', 'Pending for Approval', '', '', '', '', '', '', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_offset`
-- 

DROP TABLE IF EXISTS `ems_offset`;
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

INSERT INTO `ems_offset` VALUES ('off-0001', 1114, '2011-09-16', '2011-09-01', '2011-09-02', 8, 8, 'ems', '2011-09-29', '2011-09-30', '', 'Pending');
INSERT INTO `ems_offset` VALUES ('off-0002', 1114, '2011-09-30', '2011-09-30', '0000-00-00', 8, 0, 'af', '2011-09-30', '0000-00-00', '', 'Approved');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_ot`
-- 

DROP TABLE IF EXISTS `ems_ot`;
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

INSERT INTO `ems_ot` VALUES ('ovt-0001', 1114, '2011-09-30', '2011-09-30', 23, 1, 'wlaa', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0002', 1114, '2011-10-20', '2011-10-27', 4, 1, 'sdfg', 'Pending', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_photos`
-- 

DROP TABLE IF EXISTS `ems_photos`;
CREATE TABLE IF NOT EXISTS `ems_photos` (
  `img_id` int(11) NOT NULL auto_increment,
  `emp_num` int(15) NOT NULL,
  `path` varchar(200) NOT NULL,
  PRIMARY KEY  (`img_id`),
  KEY `emp_num` (`emp_num`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `ems_photos`
-- 

INSERT INTO `ems_photos` VALUES (1, 1114, 'photos/5493.jpg');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_remarks`
-- 

DROP TABLE IF EXISTS `ems_remarks`;
CREATE TABLE IF NOT EXISTS `ems_remarks` (
  `remarks_id` int(8) NOT NULL auto_increment,
  `id` varchar(15) NOT NULL,
  `emp_num` int(15) NOT NULL,
  `date` varchar(50) NOT NULL,
  `remarks` text NOT NULL,
  PRIMARY KEY  (`remarks_id`),
  KEY `emp_num` (`emp_num`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

-- 
-- Dumping data for table `ems_remarks`
-- 

INSERT INTO `ems_remarks` VALUES (1, 'ovt-0025', 1114, 'updated last: Sep 20, 2011 01:37:41 pm', 'this is just a test. jan ka lamang at wag kang aalis.  jan ka lamang at wag kang aalis. jan ka lamang at wag kang aalis.');
INSERT INTO `ems_remarks` VALUES (2, 'ovt-0025', 1114, 'updated last: Sep 21, 2011 03:25:49 pm', 'eehhhh ayeh. that what I said now.');
INSERT INTO `ems_remarks` VALUES (3, 'ovt-0025', 1114, 'updated last: Sep 21, 2011 03:27:18 pm', 'add ulit. wanna buy me flowers, like to talk for hours..<br />\r\nadd ulit. wanna buy me flowers, like to talk for hours..<br />\r\nadd ulit. wanna buy me flowers, like to talk for hours..add ulit. wanna buy me flowers, like to talk for hours..');
INSERT INTO `ems_remarks` VALUES (4, 'rsv-0001', 1, 'created: Sep 21, 2011 05:39:03 pm', 'ok na approve na ingatan mo yan. :D');
INSERT INTO `ems_remarks` VALUES (5, 'rsv-0001', 1114, 'updated last: Sep 21, 2011 05:52:32 pm', 'gud kala ko patatagalin mo pa e. aus yan, salamat anyways.');
INSERT INTO `ems_remarks` VALUES (6, 'ovt-0025', 1114, 'created: Sep 22, 2011 04:01:57 pm', '');
INSERT INTO `ems_remarks` VALUES (7, 'und-0001', 1114, 'created: Sep 23, 2011 09:55:07 am', 'ang panget ng interface pag IE ang gamit. tsk');
INSERT INTO `ems_remarks` VALUES (8, 'lve-0001', 1114, 'created: Sep 30, 2011 04:25:09 pm', 'Hello');
INSERT INTO `ems_remarks` VALUES (9, 'Pending', 1114, 'created: Oct 19, 2011 10:24:48 am', '');
INSERT INTO `ems_remarks` VALUES (10, 'air-0006', 123, 'created: Oct 19, 2011 01:38:52 pm', 'Ms. Barbs, please book.');
INSERT INTO `ems_remarks` VALUES (11, 'air-0006', 789, 'created: Oct 19, 2011 02:26:13 pm', 'Requested for rebooking due to client change of plans');
INSERT INTO `ems_remarks` VALUES (12, 'ofb-0004', 456, 'created: Oct 19, 2011 02:35:03 pm', 'Please complete once accomplished');
INSERT INTO `ems_remarks` VALUES (13, 'ofb-0013', 123, 'created: Oct 20, 2011 06:30:32 pm', 'Finished all training modules.');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_undertime`
-- 

DROP TABLE IF EXISTS `ems_undertime`;
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

INSERT INTO `ems_undertime` VALUES ('und-0001', 1114, '2011-09-13', '2011-09-13', 'Anticipated', '3:30 pm', 'i want e', '', 'Approved');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_users`
-- 

DROP TABLE IF EXISTS `ems_users`;
CREATE TABLE IF NOT EXISTS `ems_users` (
  `user_id` int(11) NOT NULL auto_increment,
  `username` varchar(40) default NULL,
  `password` varchar(200) default NULL,
  `deleted` varchar(3) NOT NULL,
  `emp_num` int(15) default NULL,
  `rights` smallint(1) NOT NULL,
  `status` varchar(8) NOT NULL,
  `is_admin` smallint(1) NOT NULL,
  PRIMARY KEY  (`user_id`),
  KEY `emp_num` (`emp_num`),
  KEY `emp_num_2` (`emp_num`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

-- 
-- Dumping data for table `ems_users`
-- 

INSERT INTO `ems_users` VALUES (1, 'admin', '202cb962ac59075b964b07152d234b70', '', 1, 1, 'Enabled', 1);
INSERT INTO `ems_users` VALUES (3, 'ben', '7fe4771c008a22eb763df47d19e2c6aa', 'no', 444, 2, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (4, 'jkeng', '202cb962ac59075b964b07152d234b70', 'no', 456, 2, 'Enabled', 1);
INSERT INTO `ems_users` VALUES (6, 'jc', 'b7adde8a9eec8ce92b5ee0507ce054a4', 'no', 999, 2, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (7, 'barbs', '56032de71c59b706e1ec6d4b8b651f33', 'no', 789, 4, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (10, 'Roy', 'd4c285227493531d0577140a1ed03964', '', 333, 2, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (11, 'mjocampo', '8c973b933c53fc43a9b14a712e535eea', 'no', NULL, 3, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (12, 'ice', '202cb962ac59075b964b07152d234b70', '', 123, 3, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (14, 'chard', '64f2820ec2d6e12bb3396db1505208c3', '', 1114, 3, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (15, 'jamil', '0e2cc23df7e37a854499f9d918b0219d', '', NULL, 4, 'Enabled', 0);

-- 
-- Constraints for dumped tables
-- 

-- 
-- Constraints for table `ems_accomplishments`
-- 
ALTER TABLE `ems_accomplishments`
  ADD CONSTRAINT `ems_accomplishments_ibfk_1` FOREIGN KEY (`ot_id`) REFERENCES `ems_ot` (`ot_id`) ON DELETE CASCADE;

-- 
-- Constraints for table `ems_active_user`
-- 
ALTER TABLE `ems_active_user`
  ADD CONSTRAINT `ems_active_user_ibfk_1` FOREIGN KEY (`emp_num`) REFERENCES `ems_employee` (`emp_num`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `ems_air_ticket`
-- 
ALTER TABLE `ems_air_ticket`
  ADD CONSTRAINT `ems_air_ticket_ibfk_1` FOREIGN KEY (`emp_num`) REFERENCES `ems_employee` (`emp_num`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `ems_attachments`
-- 
ALTER TABLE `ems_attachments`
  ADD CONSTRAINT `ems_attachments_ibfk_1` FOREIGN KEY (`emp_num`) REFERENCES `ems_employee` (`emp_num`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `ems_benefits`
-- 
ALTER TABLE `ems_benefits`
  ADD CONSTRAINT `ems_benefits_ibfk_1` FOREIGN KEY (`emp_num`) REFERENCES `ems_employee` (`emp_num`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `ems_business_units`
-- 
ALTER TABLE `ems_business_units`
  ADD CONSTRAINT `ems_business_units_ibfk_1` FOREIGN KEY (`dept_code`) REFERENCES `ems_department` (`dept_code`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `ems_emergency_contacts`
-- 
ALTER TABLE `ems_emergency_contacts`
  ADD CONSTRAINT `ems_emergency_contacts_ibfk_1` FOREIGN KEY (`emp_num`) REFERENCES `ems_employee` (`emp_num`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `ems_employee`
-- 
ALTER TABLE `ems_employee`
  ADD CONSTRAINT `ems_employee_ibfk_1` FOREIGN KEY (`dept_code`) REFERENCES `ems_department` (`dept_code`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `ems_emp_dependents`
-- 
ALTER TABLE `ems_emp_dependents`
  ADD CONSTRAINT `ems_emp_dependents_ibfk_1` FOREIGN KEY (`emp_num`) REFERENCES `ems_employee` (`emp_num`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `ems_equip_requests`
-- 
ALTER TABLE `ems_equip_requests`
  ADD CONSTRAINT `ems_equip_requests_ibfk_1` FOREIGN KEY (`emp_num`) REFERENCES `ems_employee` (`emp_num`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `ems_equip_requisitions`
-- 
ALTER TABLE `ems_equip_requisitions`
  ADD CONSTRAINT `ems_equip_requisitions_ibfk_1` FOREIGN KEY (`emp_num`) REFERENCES `ems_employee` (`emp_num`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `ems_leave`
-- 
ALTER TABLE `ems_leave`
  ADD CONSTRAINT `ems_leave_ibfk_1` FOREIGN KEY (`emp_num`) REFERENCES `ems_employee` (`emp_num`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `ems_ob`
-- 
ALTER TABLE `ems_ob`
  ADD CONSTRAINT `ems_ob_ibfk_1` FOREIGN KEY (`emp_num`) REFERENCES `ems_employee` (`emp_num`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `ems_offset`
-- 
ALTER TABLE `ems_offset`
  ADD CONSTRAINT `ems_offset_ibfk_1` FOREIGN KEY (`emp_num`) REFERENCES `ems_employee` (`emp_num`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `ems_ot`
-- 
ALTER TABLE `ems_ot`
  ADD CONSTRAINT `ems_ot_ibfk_1` FOREIGN KEY (`emp_num`) REFERENCES `ems_employee` (`emp_num`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `ems_photos`
-- 
ALTER TABLE `ems_photos`
  ADD CONSTRAINT `ems_photos_ibfk_1` FOREIGN KEY (`emp_num`) REFERENCES `ems_employee` (`emp_num`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `ems_remarks`
-- 
ALTER TABLE `ems_remarks`
  ADD CONSTRAINT `ems_remarks_ibfk_1` FOREIGN KEY (`emp_num`) REFERENCES `ems_employee` (`emp_num`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `ems_undertime`
-- 
ALTER TABLE `ems_undertime`
  ADD CONSTRAINT `ems_undertime_ibfk_1` FOREIGN KEY (`emp_num`) REFERENCES `ems_employee` (`emp_num`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `ems_users`
-- 
ALTER TABLE `ems_users`
  ADD CONSTRAINT `ems_users_ibfk_1` FOREIGN KEY (`emp_num`) REFERENCES `ems_employee` (`emp_num`) ON DELETE CASCADE ON UPDATE CASCADE;
