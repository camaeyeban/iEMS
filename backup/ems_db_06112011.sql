-- phpMyAdmin SQL Dump
-- version 2.11.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 11, 2012 at 05:13 AM
-- Server version: 5.0.67
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ems_test`
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
  `no_of_hours` float NOT NULL,
  `actual_output` varchar(900) NOT NULL,
  `justification` varchar(900) NOT NULL,
  `status` varchar(20) NOT NULL,
  `remarks` varchar(900) NOT NULL,
  KEY `ot_id` (`ot_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ems_accomplishments`
--

INSERT INTO `ems_accomplishments` (`ot_id`, `date_filed`, `time_in`, `time_out`, `no_of_hours`, `actual_output`, `justification`, `status`, `remarks`) VALUES
('ovt-0001', '2011-09-30', '1110', '1320', 3.3, 'Task accomplished.', '', 'Approved', ''),
('ovt-0002', '2011-10-20', '1110', '1230', 2, 'test', '', 'Approved', ''),
('ovt-0003', '2012-04-20', '', '', 0, '', '', '', ''),
('ovt-0004', '2012-04-20', '', '', 0, '', '', '', ''),
('ovt-0005', '2012-04-20', '1110', '1320', 3.3, 'Test', '', 'Pending', ''),
('ovt-0006', '2012-04-20', '', '', 0, '', '', '', ''),
('ovt-0007', '2012-04-20', '', '', 0, '', '', '', ''),
('ovt-0008', '2012-04-20', '', '', 0, '', '', '', ''),
('ovt-0009', '2012-04-30', '', '', 0, '', '', '', ''),
('ovt-0010', '2012-04-30', '', '', 0, '', '', '', ''),
('ovt-0011', '2012-04-30', '', '', 0, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `ems_active_user`
--

CREATE TABLE IF NOT EXISTS `ems_active_user` (
  `ID` int(4) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `emp_num` int(15) NOT NULL,
  `status` smallint(1) NOT NULL,
  PRIMARY KEY  (`ID`),
  KEY `emp_num` (`emp_num`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `ems_active_user`
--

INSERT INTO `ems_active_user` (`ID`, `user_id`, `emp_num`, `status`) VALUES
(1, 1, 1, 0),
(2, 14, 200503804, 1),
(3, 3, 444, 0),
(4, 7, 789, 0),
(7, 17, 40404, 0),
(8, 16, 777, 0),
(9, 18, 123, 0),
(10, 19, 888, 0),
(11, 6, 999, 0),
(12, 20, 55666666, 0),
(13, 21, 13131313, 0),
(14, 22, 555, 0);

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

INSERT INTO `ems_air_ticket` (`at_id`, `emp_num`, `date_filed`, `client`, `origin`, `destination`, `airline`, `departure`, `arrival`, `purpose`, `type`, `amount`, `status`, `state`, `attachment`) VALUES
('air-0004', 200503804, '2011-10-14', 'Super 8', 'manila<br/>cebu', 'cebu<br/>manila', 'Tiger ', 'Aug-5-2011 03:00:00 PM', 'Aug-13-2011 11:50:00 PM', 'round trip 2', 'rt', '5000', 'Re-booked', 7, ''),
('air-0005', 200503804, '2011-10-14', 'iRipple', 'manila<br/>cebu', 'davao<br/>manila', 'Cebu Pacific', 'Oct-14-2011 11:19:27 AM<br/>Oct-15-2011 11:19:27 AM<br/>Oct-16-2011 11:19:27 AM', '', 'sample multi', 'multi', '10000', 'Booked', 3, 'remarksems_remarks.sql'),
('air-0010', 200503804, '2011-10-20', 'Citihardware', 'manila<br/>cebu', 'cebu<br/>manila', 'PAL', 'Oct-20-2011 01:34:13 PM', '', 'sample', 'ow', '5000', 'Booked', 3, 'mac.txt'),
('air-0011', 200503804, '2011-10-20', 'sample', 'sample<br/>sample', 'sample<br/>sample', 'sample', 'Oct-27-2011 01:53:56 PM', '', 'sample', 'ow', '5000', 'Reviewed', 2, ''),
('air-0016', 200503804, '2011-10-21', 'Super 8', 'Manila<br/>iloilo', 'iloilo<br/>Manila', 'Cebu Pacific', 'Oct-26-2011 05:21:02 PM', '', 'Client visit', 'ow', '', 'Confirmed', 1, ''),
('air-0017', 444, '2012-04-19', 'COH', 'Manila', 'Cebu', 'PAL', 'Apr-25-2012 09:21:24 AM', '', 'Deployment of POS', 'ow', '', 'Confirmed', 1, ''),
('air-0018', 555, '2012-04-20', 'Kevin', 'Manila', 'CDO', 'PAL', 'Apr-21-2012 09:54:52 AM', '', 'Test-Air Ticket Request', 'ow', '', 'Pending', 0, ''),
('air-0019', 789, '2012-04-20', 'COH', 'Manila', 'Cebu', 'Cebu Pac', 'Apr-25-2012 10:11:01 AM', '', 'Test Air Ticket Request - 2', 'ow', '', 'Pending', 0, ''),
('air-0020', 789, '2012-04-20', 'Shoppers', 'Manila', 'Zamboanga', 'PAL', 'Apr-30-2012 10:16:10 AM', '', 'Test 3', 'ow', '', 'Pending', 0, ''),
('air-0021', 444, '2012-04-20', 'COH', 'Manila<br/>Cebu', 'Cebu<br/>Manila', 'Zest Air', 'Apr-23-2012 10:29:27 AM', 'Apr-27-2012 10:29:27 AM', 'Test - 4', 'rt', '', 'Pending', 0, ''),
('air-0022', 555, '2012-04-26', 'Drugman', 'Manila', 'Palawan', 'Zest Air', 'Apr-30-2012 10:17:36 AM', '', 'Test 1-air ticket', 'ow', '', 'Pending', 0, ''),
('air-0023', 444, '2012-04-26', 'Nesabel', 'Manila', 'Bulacan', 'Cebu Pac', 'Apr-28-2012 10:23:14 AM', '', 'Test - air ticket 2', 'ow', '', 'Pending', 0, ''),
('air-0024', 789, '2012-04-26', 'Mydin', 'Manila', 'Malaysia', 'PAL', 'Apr-26-2012 10:25:07 AM', '', 'Air ticket - test 3', 'ow', '', 'Pending', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `ems_announcement`
--

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

CREATE TABLE IF NOT EXISTS `ems_benefits` (
  `ben_id` int(10) NOT NULL auto_increment,
  `emp_num` int(15) default NULL,
  `sl_num` float default NULL,
  `vl_num` float default NULL,
  PRIMARY KEY  (`ben_id`),
  KEY `leave_id` (`emp_num`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=6 ;

--
-- Dumping data for table `ems_benefits`
--

INSERT INTO `ems_benefits` (`ben_id`, `emp_num`, `sl_num`, `vl_num`) VALUES
(2, 200503804, 7.5, 7.5),
(3, 777, 0, 4.2),
(4, 1818, 0, 0),
(5, 999, 7.5, 7.5);

-- --------------------------------------------------------

--
-- Table structure for table `ems_business_units`
--

CREATE TABLE IF NOT EXISTS `ems_business_units` (
  `b_id` int(4) NOT NULL auto_increment,
  `dept_code` varchar(10) default NULL,
  `b_manager_name` varchar(100) NOT NULL,
  `oic` varchar(10) NOT NULL,
  `report_to` varchar(10) default NULL,
  PRIMARY KEY  (`b_id`),
  KEY `dept_code` (`dept_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `ems_business_units`
--

INSERT INTO `ems_business_units` (`b_id`, `dept_code`, `b_manager_name`, `oic`, `report_to`) VALUES
(2, 'DEP-0002', 'Mary Anne Unson', 'None', 'None'),
(3, 'DEP-0003', 'Benito Viloria', 'None', '55666666'),
(4, 'DEP-0004', 'Fracy Nagnal', 'None', '777'),
(5, 'DEP-0005', 'Julie Cruz', 'None', 'None'),
(6, 'DEP-0006', 'Jennilyn See', 'None', 'None'),
(7, 'DEP-0007', 'Christian Dan Enrique', 'None', 'None'),
(10, 'DEP-0001', 'Venice Ann Alluso', 'None', 'None'),
(12, 'DEP-0008', 'Sample Executive', 'None', 'None'),
(13, 'DEP-0010', 'Sample Manager', 'None', 'None'),
(14, 'DEP-0000', 'iEMS Admin iRipple', '777', 'None');

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

INSERT INTO `ems_department` (`dept_code`, `dept_name`) VALUES
('DEP-0000', 'Managers'),
('DEP-0001', 'Accounting'),
('DEP-0002', 'Marketing / Hardware'),
('DEP-0003', 'Product'),
('DEP-0004', 'Project Implementation'),
('DEP-0005', 'Support'),
('DEP-0006', 'Sales'),
('DEP-0007', 'Pharma'),
('DEP-0008', 'Human Resource'),
('DEP-0010', 'R&D');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `ems_emergency_contacts`
--

INSERT INTO `ems_emergency_contacts` (`ec_id`, `emp_num`, `ecc_name`, `ecc_relationship`, `ecc_home_no`, `ecc_mobile_no`, `ecc_office_no`) VALUES
(3, 200503804, 'Angelita', 'Mother', '7920622', '09386867806', '6681234');

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

INSERT INTO `ems_employee` (`emp_num`, `date_employ`, `date_reg`, `date_sep`, `emp_lastname`, `emp_firstname`, `emp_middlename`, `b_id`, `dept_code`, `job_title_code`, `jl_id`, `code`, `gender`, `address1`, `address2`, `city`, `province`, `zip`, `home_no`, `mobile`, `work_no`, `email`, `email2`, `birthdate`, `sss`, `tin`, `pag_ibig`, `phil_health`) VALUES
(1, '0000-00-00', '0000-00-00', '0000-00-00', 'iRipple', 'iEMS Admin', '', 0, NULL, NULL, 0, NULL, 'male', '', '', '  ', '', '', '', '', '', 'mackyboy_09@yahoo.com.ph', '', '1970-01-01', '', '', '', ''),
(123, '0000-00-00', '0000-00-00', '0000-00-00', 'Unson', 'Mary', '', 7, 'DEP-0007', 0, 0, '', NULL, '', '', ' ', '', '', '', '', '', 'elegaspi@iripple.com', '', '0000-00-00', NULL, NULL, NULL, NULL),
(222, '0000-00-00', '0000-00-00', '0000-00-00', 'Alluso', 'Venice Ann', '', 10, 'DEP-0001', 0, 0, 'EST001', 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01', '', '', '', ''),
(333, '0000-00-00', '0000-00-00', '0000-00-00', 'Unson', 'Mary Anne', '', 7, 'DEP-0007', 0, 0, '', 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', '', '', '', ''),
(444, '0000-00-00', '0000-00-00', '0000-00-00', 'Viloria', 'Benito', '', 9, 'DEP-0003', 0, 0, 'EST001', 'male', '', '', '   ', '', '', '', '', '', 'tlaude@iripple.com', '', '1970-01-01', '', '', '', ''),
(555, '0000-00-00', '0000-00-00', '0000-00-00', 'Nagnal', 'Fracy', '', 6, 'DEP-0004', 0, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL),
(777, '0000-00-00', '0000-00-00', '0000-00-00', 'See', 'Jennilyn', '', 6, 'DEP-0006', 0, 0, '', NULL, '', '', '   ', '', '', '', '', '', 'elegaspi@iripple.com', '', '0000-00-00', NULL, NULL, NULL, NULL),
(789, '0000-00-00', '0000-00-00', '0000-00-00', 'Balingit', 'Barbs', '', 6, 'DEP-0006', 0, 0, '', NULL, '', '', '  ', '', '', '', '', '', 'elegaspi@iripple.com', '', '0000-00-00', NULL, NULL, NULL, NULL),
(888, '0000-00-00', '0000-00-00', '0000-00-00', 'Enrique', 'Christian Dan', '', 7, 'DEP-0007', 0, 0, '', 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', '', '', '', ''),
(999, '0000-00-00', '0000-00-00', '0000-00-00', 'Cruz', 'Julie', '', 9, 'DEP-0005', 0, 0, '', 'female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01', '', '', '', ''),
(1818, '2011-09-23', '0000-00-00', '0000-00-00', 'Tayson', 'Jamil Rose', 'J', 4, 'DEP-0004', 5, 10, 'EST004', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL),
(40404, '2011-09-23', '0000-00-00', '0000-00-00', 'Casiano', 'Neo Ethan', 'Ladiana', 12, 'DEP-0008', 8, 5, 'EST001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL),
(13131313, '0000-00-00', '0000-00-00', '0000-00-00', 'Executive', 'Sample', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL),
(55666666, '2012-04-19', '0000-00-00', '0000-00-00', 'Manager', 'Sample', '', 13, 'DEP-0010', 2, 7, 'EST001', NULL, '', '', ' ', '', '', '', '', '', 'ted_laude@yahoo.com', '', '0000-00-00', NULL, NULL, NULL, NULL),
(200503804, '2011-09-01', '0000-00-00', '0000-00-00', 'Ladiana', 'Richard Allan', 'Godoy', 3, 'DEP-0003', 2, 5, '', 'male', '', '', '   ', '', '', '', '', '', 'tlaude@iripple.com', '', '1990-01-09', '', '', '', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `ems_emp_dependents`
--

INSERT INTO `ems_emp_dependents` (`ed_id`, `emp_num`, `ed_name`, `ed_relationship`, `ed_datebirth`) VALUES
(3, 1, 'chard', 'tito', '0000-00-00'),
(4, 1, 'dept4', 'hello', '2011-09-08'),
(6, 200503804, 'neo', 'pamangking tunays', '2004-04-04'),
(8, 200503804, 'jamil', 'girlfriend', '1990-11-06');

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

INSERT INTO `ems_emp_status` (`code`, `name`) VALUES
('EST001', 'Regular'),
('EST002', 'Contractual'),
('EST003', 'Resigned'),
('EST004', 'Probationary');

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

INSERT INTO `ems_equip_requests` (`erqst_id`, `emp_num`, `date_filed`, `subject_purpose`, `client_branch`, `date_from`, `date_to`, `no_of_days`, `equip_list`, `status`, `remarks`) VALUES
('rsv-0001', 200503804, '2011-09-14', 'meeting', 'iRipple', '2011-09-29', '2011-09-29', 1, 'Projector|Laptop|', 'Approved', ''),
('rsv-0002', 200503804, '2011-09-30', 'meeting', 'iRipple', '2011-09-30', '2011-09-30', 1, 'Projector|', 'Pending', '');

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

INSERT INTO `ems_equip_requisitions` (`erqstn_id`, `emp_num`, `date_filed`, `date_needed`, `qty`, `items`, `purpose`, `remarks`, `status`, `amount`) VALUES
('ER2011002', 200503804, '2011-09-16', '2011-09-23', '1|', 'mouse|', 'hello', '', 'Pending', '');

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

INSERT INTO `ems_geninfo` (`code`, `name`, `phone`, `add1`, `add2`, `city`, `state`, `zip`, `tin`, `pagibig`, `philhealth`, `sss`) VALUES
('001', 'iRipple', '4234', 'Ortigas', 'Pasig', 'Pasig', 'Manila', '123456', '34345345', '24234', '123123', '234234234');

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

INSERT INTO `ems_joblevel` (`jl_id`, `job_level`, `rank`, `grade`) VALUES
(5, '2', 'Staff', '1'),
(7, '1', 'Supervisor', '1'),
(8, '8', 'Test', '5'),
(10, '9', 'Test', '10'),
(11, '2', 'Staff', '3');

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

INSERT INTO `ems_jobtitle` (`job_title_code`, `job_title_name`, `job_title_desc`, `job_title_comm`, `jobspec_id`) VALUES
(2, 'Software Engineer', '', '', 0),
(4, 'Software Solutions Analyst', 'Good.', '', 0),
(5, 'Quality Assurance Analyst', '', '', 0),
(6, 'Technical Writer', 'Test Description', 'Sample Comment', 0),
(7, 'Product Manager', 'Sample Manager', 'Sample Manager', 0),
(8, 'Training Assistant', '', '', 0),
(9, 'Training Manager', '', '', 0);

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

INSERT INTO `ems_leave` (`leave_id`, `emp_num`, `date_filed`, `d_from`, `d_to`, `no_of_days`, `time`, `type`, `value`, `reason`, `remarks`, `status`) VALUES
('lve-0001', 200503804, '2011-09-23', '2011-09-29', '2011-09-30', 2, 'AM PM ', 'Vacation Leave', 1, 'hapi vacation.', '', 'Approved'),
('lve-0002', 200503804, '2012-01-05', '2012-01-05', '2012-01-05', 1, '  ', 'Sick Leave', 2, 'Back Pain', '', 'Approved'),
('lve-0003', 200503804, '2012-03-29', '2012-04-11', '2012-04-11', 1, '  ', 'Vacation Leave', 1, 'Pahinga.', '', 'Approved'),
('lve-0004', 200503804, '2012-03-29', '2012-03-19', '2012-03-27', 9, '  ', 'Sick Leave', 2, 'Sick.', '', 'Approved'),
('lve-0005', 200503804, '2013-03-29', '2013-03-18', '2013-03-29', 12, '  ', 'Sick Leave', 2, 'Sick', '', 'Approved'),
('lve-0006', 200503804, '2013-03-29', '2013-04-02', '2013-04-05', 4, '  ', 'Vacation Leave', 1, 'Rest', '', 'Approved'),
('lve-0007', 40404, '2012-04-13', '2012-04-16', '2012-04-17', 2, '  ', 'Sick Leave', 2, 'test', '', 'Pending'),
('lve-0008', 123, '2012-04-13', '2012-04-19', '2012-04-20', 2, '  ', 'Vacation Leave', 1, 'test', '', 'Pending'),
('lve-0009', 123, '2012-04-13', '2012-04-09', '2012-04-10', 2, '  ', 'Sick Leave', 2, 'Sick leave test', '', 'Pending'),
('lve-0010', 444, '2012-04-16', '2012-04-23', '2012-04-23', 1, '  ', 'Sick Leave', 2, 'My mother is sick.', '', 'Pending'),
('lve-0011', 999, '2012-04-16', '2012-04-16', '2012-04-16', 1, '  ', 'Sick Leave', 2, 'I am sick.', '', 'Pending'),
('lve-0012', 789, '2012-04-20', '2012-04-23', '2012-04-27', 5, '  ', 'Vacation Leave', 1, 'Test 1 - VL', '', 'Pending'),
('lve-0013', 555, '2012-04-20', '2012-04-24', '2012-04-25', 2, '  ', 'Vacation Leave', 1, 'Test 2 - VL', '', 'Pending'),
('lve-0014', 789, '2012-04-26', '2012-04-23', '2012-04-27', 5, '  ', 'Maternity/Paternity Leave', 0, 'test 5', '', 'Pending'),
('lve-0015', 444, '2012-04-26', '2012-04-23', '2012-04-24', 2, '  ', 'Sick Leave', 2, 'test 6', '', 'Pending'),
('lve-0016', 444, '2012-04-30', '2012-04-23', '2012-04-24', 2, '  ', 'Sick Leave', 2, 'sickdsfr', '', 'Pending'),
('lve-0017', 200503804, '2012-05-30', '2012-05-08', '2012-05-11', 4, '  ', 'Sick Leave', 2, 'sample', '', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `ems_ob`
--

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

INSERT INTO `ems_ob` (`ob_id`, `emp_num`, `date_filed`, `client_branch`, `ob_from`, `ob_to`, `purpose`, `status`, `remarks`, `departure`, `time_start`, `time_end`, `duration`, `arrival`, `total`) VALUES
('ofb-0002', 200503804, '2011-10-19', 'iRipple', '2011-10-18', '2011-10-19', 'Delivery|', 'Pending for Approval', '', '60 ', '--Select--', '--Select--', '', '--Select--', ''),
('ofb-0003', 200503804, '2011-10-19', 'iRipple', '2011-10-18', '0000-00-00', 'Network|', 'Pending for Approval', '', '70 ', '--Select--', '--Select--', '', '--Select--', ''),
('ofb-0007', 200503804, '2011-10-19', 'Super 8', '2011-10-19', '0000-00-00', 'Delivery|', 'Approved', '', '540 ', '600', '720', '2.0', '780', '3.0'),
('ofb-0009', 200503804, '2011-10-20', 'iRipple', '2011-10-20', '2011-10-25', 'Network|', 'Cancelled', '', '--Select--', '--Select--', '--Select--', '', '--Select--', ''),
('ofb-0010', 200503804, '2011-10-20', 'Citihardware', '2011-10-10', '2011-10-14', 'Delivery|', 'Cancelled', '', ' ', '', '', '', '', ''),
('ofb-0015', 200503804, '2012-01-02', 'Super 8', '2012-01-02', '2012-01-02', 'Network|', 'Cancelled', 'Network', '660 ', '690', '840', '2.30', '885', '3.45'),
('ofb-0016', 200503804, '2012-01-02', 'Super 8', '2012-01-03', '2012-01-03', 'Consultation|Delivery|Others|Maintenance|', 'Cancelled', '', '480 ', '505', '865', '6.0', '990', '8.05'),
('ofb-0017', 200503804, '2012-01-04', 'Super 8', '2012-01-06', '2012-01-06', 'Others|Installation|', 'Cancelled', 'Installation of Barter in 11 POS.', '600 ', '635', '990', '5.55', '1035', '7.15'),
('ofb-0018', 777, '2012-04-19', 'Cardams', '2012-04-18', '2012-04-20', 'Meeting|', 'Pending for Approval', '', ' ', '', '', '', '', ''),
('ofb-0019', 789, '2012-04-20', 'Seminar', '2012-04-16', '2012-04-20', 'Others|Seminar|', 'Pending for Approval', '', '', '', '', '', '', ''),
('ofb-0020', 555, '2012-04-20', 'Shoppers', '2012-04-21', '2012-04-23', 'Meeting|', 'Pending for Confirmation', '', '', '', '', '', '', ''),
('ofb-0021', 444, '2012-04-20', 'COH', '2012-04-09', '2012-04-13', 'Others|SAP Testing|', 'Pending for Approval', '', ' ', '', '', '', '', ''),
('ofb-0022', 200503804, '2012-04-20', 'Pharma', '2012-04-23', '2012-04-24', 'Network|', 'Cancelled', 'Any.', '600 ', '750', '2755', '33.25', '2815', '36.55'),
('ofb-0023', 200503804, '2012-04-20', 'Pharma2', '2012-04-23', '2012-04-27', 'Network|', 'Cancelled', 'Remarks.', ' ', '', '', '', '', ''),
('ofb-0024', 200503804, '2012-04-20', 'Pharma3', '2012-04-23', '2012-04-25', 'Network|Consultation|Delivery|Meeting|', 'Cancelled', 'Any Remarks.', ' ', '', '', '', '', ''),
('ofb-0025', 200503804, '2012-04-20', 'Pharma4', '2012-04-30', '2012-04-30', 'Network|Consultation|', 'Cancelled', '', '70 ', '910', '925', '0.15', '1310', '20.40'),
('ofb-0026', 555, '2012-04-26', 'Nesabel', '2012-04-02', '2012-04-06', 'Others|BPM|', 'Pending for Approval', '', ' ', '', '', '', '', ''),
('ofb-0027', 444, '2012-04-30', 'Citihardware', '2012-04-30', '2012-05-04', 'Meeting|', 'Pending for Approval', '', ' ', '', '', '', '', ''),
('ofb-0028', 200503804, '2012-05-30', 'test', '2012-05-21', '2012-05-25', 'Network|', 'Cancelled', '', ' ', '', '', '', '', ''),
('ofb-0029', 200503804, '2012-05-30', 'test', '2012-06-04', '2012-06-08', 'Consultation|', 'Pending for Approval', '', ' ', '', '', '', '', '');

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

INSERT INTO `ems_offset` (`offset_id`, `emp_num`, `date_filed`, `date_ot`, `date_ot2`, `ot_hours`, `ot_hours2`, `accomplishment`, `date_offset`, `date_offset2`, `remarks`, `status`) VALUES
('off-0001', 200503804, '2011-09-16', '2011-09-01', '2011-09-02', 8, 8, 'ems', '2011-09-29', '2011-09-30', '', 'Pending'),
('off-0002', 200503804, '2011-09-30', '2011-09-30', '0000-00-00', 8, 0, 'af', '2011-09-30', '0000-00-00', '', 'Approved'),
('off-0003', 444, '2012-04-26', '2012-04-28', '0000-00-00', 1, 0, 'Test 4', '2012-04-30', '0000-00-00', '', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `ems_ot`
--

CREATE TABLE IF NOT EXISTS `ems_ot` (
  `ot_id` varchar(15) NOT NULL,
  `emp_num` int(15) NOT NULL,
  `date_filed` date NOT NULL,
  `date_ot` date NOT NULL,
  `no_of_hours` float NOT NULL,
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

INSERT INTO `ems_ot` (`ot_id`, `emp_num`, `date_filed`, `date_ot`, `no_of_hours`, `cdc`, `expected_output`, `status`, `remarks`) VALUES
('ovt-0001', 200503804, '2011-09-30', '2011-09-30', 23, 1, 'wlaa', 'Approved', ''),
('ovt-0002', 200503804, '2011-10-20', '2011-10-20', 3, 1, 'sdfg', 'Approved', ''),
('ovt-0003', 789, '2012-04-20', '2012-04-20', 4, 1, 'Test - OT', 'Pending', ''),
('ovt-0004', 200503804, '2012-04-20', '2012-04-20', 2, 1, 'Overtime', 'Approved', ''),
('ovt-0005', 200503804, '2012-04-20', '2012-04-24', 2.5, 1, 'dsfgb', 'Approved', ''),
('ovt-0006', 200503804, '2012-04-20', '2012-04-20', 2, 1, 'sadfgh4erh', 'Approved', ''),
('ovt-0007', 200503804, '2012-04-20', '2012-04-20', 3, 2, 'Rest', 'Approved', ''),
('ovt-0008', 200503804, '2012-04-20', '2012-04-26', 2, 1, 'fdgher ag', 'Approved', ''),
('ovt-0009', 200503804, '2012-04-30', '2012-04-30', 3, 1, 'asdfe', 'Approved', ''),
('ovt-0010', 555, '2012-04-30', '2012-04-02', 4.5, 1, 'dsfwersa', 'Pending', ''),
('ovt-0011', 444, '2012-04-30', '2012-04-30', 5, 1, 'wla lng', 'Pending', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ems_photos`
--

INSERT INTO `ems_photos` (`img_id`, `emp_num`, `path`) VALUES
(1, 200503804, 'photos/5493.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `ems_remarks`
--

CREATE TABLE IF NOT EXISTS `ems_remarks` (
  `remarks_id` int(8) NOT NULL auto_increment,
  `id` varchar(15) NOT NULL,
  `emp_num` int(15) NOT NULL,
  `date` varchar(50) NOT NULL,
  `remarks` text NOT NULL,
  PRIMARY KEY  (`remarks_id`),
  KEY `emp_num` (`emp_num`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `ems_remarks`
--

INSERT INTO `ems_remarks` (`remarks_id`, `id`, `emp_num`, `date`, `remarks`) VALUES
(1, 'ovt-0025', 200503804, 'updated last: Sep 20, 2011 01:37:41 pm', 'this is just a test. jan ka lamang at wag kang aalis.  jan ka lamang at wag kang aalis. jan ka lamang at wag kang aalis.'),
(2, 'ovt-0025', 200503804, 'updated last: Sep 21, 2011 03:25:49 pm', 'eehhhh ayeh. that what I said now.'),
(3, 'ovt-0025', 200503804, 'updated last: Sep 21, 2011 03:27:18 pm', 'add ulit. wanna buy me flowers, like to talk for hours..<br />\r\nadd ulit. wanna buy me flowers, like to talk for hours..<br />\r\nadd ulit. wanna buy me flowers, like to talk for hours..add ulit. wanna buy me flowers, like to talk for hours..'),
(4, 'rsv-0001', 1, 'created: Sep 21, 2011 05:39:03 pm', 'ok na approve na ingatan mo yan. :D'),
(5, 'rsv-0001', 200503804, 'updated last: Sep 21, 2011 05:52:32 pm', 'gud kala ko patatagalin mo pa e. aus yan, salamat anyways.'),
(6, 'ovt-0025', 200503804, 'created: Sep 22, 2011 04:01:57 pm', ''),
(7, 'und-0001', 200503804, 'created: Sep 23, 2011 09:55:07 am', 'ang panget ng interface pag IE ang gamit. tsk'),
(8, 'lve-0001', 200503804, 'created: Sep 30, 2011 04:25:09 pm', 'Hello'),
(9, 'Pending', 200503804, 'created: Oct 19, 2011 10:24:48 am', ''),
(11, 'air-0006', 789, 'created: Oct 19, 2011 02:26:13 pm', 'Requested for rebooking due to client change of plans');

-- --------------------------------------------------------

--
-- Table structure for table `ems_settings`
--

CREATE TABLE IF NOT EXISTS `ems_settings` (
  `settingId` int(11) NOT NULL auto_increment,
  `settingName` varchar(50) NOT NULL,
  `value` varchar(50) NOT NULL,
  `createDate` datetime NOT NULL,
  `createBy` varchar(50) NOT NULL,
  `updateDate` datetime NOT NULL,
  `updateBy` varchar(50) NOT NULL,
  PRIMARY KEY  (`settingId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ems_settings`
--

INSERT INTO `ems_settings` (`settingId`, `settingName`, `value`, `createDate`, `createBy`, `updateDate`, `updateBy`) VALUES
(1, 'leaveCutOffStart', '2012-04-01', '2012-03-29 14:59:32', 'admin', '2012-03-29 18:55:29', 'admin'),
(2, 'leaveCutOffEnd', '2013-03-31', '2012-03-29 14:59:32', 'admin', '2012-03-29 18:55:29', 'admin');

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

INSERT INTO `ems_undertime` (`un_id`, `emp_num`, `date_filed`, `date_un`, `nature_un`, `time`, `reason`, `remarks`, `status`) VALUES
('und-0001', 200503804, '2011-09-13', '2011-09-13', 'Anticipated', '3:30 pm', 'i want e', '', 'Approved'),
('und-0002', 123, '2012-04-13', '2012-04-23', 'Anticipated', '3:30 pm', 'test', '', 'Pending'),
('und-0003', 444, '2012-04-19', '2012-04-19', 'Emergency', '4:30 pm', 'Emergency At Home', '', 'Pending'),
('und-0004', 200503804, '2012-04-19', '2012-04-19', 'Emergency', '4:50 pm', 'Emergency.', '', 'Pending'),
('und-0005', 789, '2012-04-19', '2012-04-19', 'Emergency', '3:30 pm', 'emergency under time', '', 'Pending'),
('und-0006', 200503804, '2012-04-20', '2012-04-26', 'Anticipated', '3:35 pm', 'Emergency', '', 'Pending');

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
  `rights` smallint(1) NOT NULL COMMENT '1=Admin, 2=Manager, 3=Employee, 4=Sales Admin',
  `status` varchar(8) NOT NULL,
  `is_admin` smallint(1) NOT NULL,
  PRIMARY KEY  (`user_id`),
  KEY `emp_num` (`emp_num`),
  KEY `emp_num_2` (`emp_num`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `ems_users`
--

INSERT INTO `ems_users` (`user_id`, `username`, `password`, `deleted`, `emp_num`, `rights`, `status`, `is_admin`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '', 1, 1, 'Enabled', 1),
(3, 'ben', '202cb962ac59075b964b07152d234b70', 'no', 444, 2, 'Enabled', 0),
(6, 'jc', 'b7adde8a9eec8ce92b5ee0507ce054a4', 'no', 999, 2, 'Enabled', 0),
(7, 'barbs', '202cb962ac59075b964b07152d234b70', 'no', 789, 4, 'Enabled', 1),
(10, 'Roy', 'd4c285227493531d0577140a1ed03964', '', 333, 2, 'Enabled', 0),
(11, 'mjocampo', '8c973b933c53fc43a9b14a712e535eea', 'no', NULL, 3, 'Enabled', 0),
(14, 'chard', '64f2820ec2d6e12bb3396db1505208c3', '', 200503804, 3, 'Enabled', 0),
(15, 'jamil', '0e2cc23df7e37a854499f9d918b0219d', '', NULL, 4, 'Enabled', 0),
(16, 'jsee', '202cb962ac59075b964b07152d234b70', '', 777, 2, 'Enabled', 0),
(17, 'neo', '202cb962ac59075b964b07152d234b70', '', 40404, 3, 'Enabled', 0),
(18, 'munson', '202cb962ac59075b964b07152d234b70', '', 123, 3, 'Enabled', 0),
(19, 'cenrique', '202cb962ac59075b964b07152d234b70', '', 888, 2, 'Enabled', 0),
(20, 'man', '39c63ddb96a31b9610cd976b896ad4f0', '', 55666666, 2, 'Enabled', 0),
(21, 'jkeng', '202cb962ac59075b964b07152d234b70', '', 13131313, 5, 'Enabled', 0),
(22, 'fracy', '405993c6b4bb9c5e28aa894bc85f4934', '', 555, 2, 'Enabled', 0);

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
