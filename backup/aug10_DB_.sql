-- phpMyAdmin SQL Dump
-- version 2.11.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 10, 2011 at 11:07 AM
-- Server version: 5.0.67
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ems`
--

-- --------------------------------------------------------

--
-- Table structure for table `ems_accomplishments`
--

CREATE TABLE IF NOT EXISTS `ems_accomplishments` (
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

INSERT INTO `ems_accomplishments` (`ot_id`, `date_filed`, `time_in`, `time_out`, `no_of_hours`, `actual_output`, `justification`, `status`, `remarks`) VALUES
(1, '2011-08-10', '', '', 0, '', '', '', ''),
(2, '2011-08-10', '', '', 0, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `ems_air_ticket`
--

CREATE TABLE IF NOT EXISTS `ems_air_ticket` (
  `at_id` int(11) NOT NULL auto_increment,
  `emp_num` int(15) NOT NULL,
  `date_filed` date NOT NULL,
  `origin` varchar(50) NOT NULL,
  `destination` varchar(50) NOT NULL,
  `airline` varchar(20) NOT NULL,
  `departure` varchar(50) NOT NULL,
  `arrival` varchar(50) NOT NULL,
  `purpose` varchar(900) NOT NULL,
  `remarks` varchar(900) NOT NULL,
  `status` varchar(20) NOT NULL,
  `state` smallint(1) NOT NULL,
  PRIMARY KEY  (`at_id`),
  KEY `emp_num` (`emp_num`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ems_air_ticket`
--

INSERT INTO `ems_air_ticket` (`at_id`, `emp_num`, `date_filed`, `origin`, `destination`, `airline`, `departure`, `arrival`, `purpose`, `remarks`, `status`, `state`) VALUES
(1, 111, '2011-08-08', 'Manila', 'Cebu', 'Cebu Pac', 'Aug-9-2011 05:30:00 PM', 'Aug-9-2011 06:30:00 PM', 'Seminar.', 'Training', 'Confirmed', 0),
(2, 111, '2011-08-10', 'Manila', 'Cebu', 'Cebu Pac', 'Aug-13-2011 11:00:00 PM', 'Aug-13-2011 11:50:00 PM', 'Seminar.', '', 'Pending', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ems_attachments`
--

CREATE TABLE IF NOT EXISTS `ems_attachments` (
  `a_id` int(11) NOT NULL auto_increment,
  `emp_num` varchar(15) NOT NULL,
  `path` varchar(50) NOT NULL,
  `file_name` varchar(30) NOT NULL,
  `description` varchar(200) NOT NULL,
  `size` varchar(10) NOT NULL,
  `type` varchar(10) NOT NULL,
  PRIMARY KEY  (`a_id`),
  KEY `emp_num` (`emp_num`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `ems_attachments`
--

INSERT INTO `ems_attachments` (`a_id`, `emp_num`, `path`, `file_name`, `description`, `size`, `type`) VALUES
(10, '111', 'attachments/emp_info_qry.txt', 'emp_info_qry.txt', '', '0.4 kb', 'text/plain'),
(12, '111', 'attachments/KPI Template_2011.xls', 'KPI Template_2011.xls', 'KPI Template', '916.0 kb', 'applicatio'),
(11, '111', 'attachments/EMS Gantt Chart.xlsx', 'EMS Gantt Chart.xlsx', '', '11.0 kb', 'applicatio');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ems_benefits`
--

INSERT INTO `ems_benefits` (`ben_id`, `emp_num`, `sl_num`, `vl_num`) VALUES
(1, '111', 7, 10);

-- --------------------------------------------------------

--
-- Table structure for table `ems_business_units`
--

CREATE TABLE IF NOT EXISTS `ems_business_units` (
  `b_id` int(4) NOT NULL auto_increment,
  `dept_code` varchar(10) default NULL,
  `b_manager_name` varchar(100) NOT NULL,
  PRIMARY KEY  (`b_id`),
  KEY `dept_code` (`dept_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `ems_business_units`
--

INSERT INTO `ems_business_units` (`b_id`, `dept_code`, `b_manager_name`) VALUES
(5, 'DEPT001', 'Richard Allan Ladiana'),
(6, 'DEPT003', 'Hubert Dy');

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
('DEPT002', 'Project'),
('DEPT003', 'Product'),
('DEPT004', 'HR'),
('DEPT005', 'Support'),
('DEPT006', 'Sales'),
('DEPT007', 'Pharma');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `ems_emergency_contacts`
--

INSERT INTO `ems_emergency_contacts` (`ec_id`, `emp_num`, `ecc_name`, `ecc_relationship`, `ecc_home_no`, `ecc_mobile_no`, `ecc_office_no`) VALUES
(5, 111, 'angelita ladiana', 'mother', '7920622', '', '1234'),
(8, 111, 'neo', 'pamangkin', '7920622', '', '1234'),
(10, 20081201, 'Erlinda D. Viloria', 'Mother', '', '', '');

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

INSERT INTO `ems_employee` (`emp_num`, `date_employ`, `date_reg`, `date_sep`, `emp_lastname`, `emp_firstname`, `emp_middlename`, `dept_code`, `job_title_code`, `jl_id`, `code`, `gender`, `address1`, `address2`, `city`, `province`, `zip`, `home_no`, `mobile`, `work_no`, `email`, `email2`, `birthdate`, `sss`, `tin`, `pag_ibig`, `phil_health`) VALUES
(111, '2011-08-01', '0000-00-00', '0000-00-00', 'Ladiana', 'Richard Allan', 'Godoy', 'DEPT003', 2, 5, 'EST002', 'male', 'Ortigas', 'Bulacan', 'Pasig  ', '', '', '7929662', '09386867806', '', '', '', '1990-01-09', '222256565', '3333', '555424234', '4444'),
(20000101, '0000-00-00', '0000-00-00', '0000-00-00', 'Dy', 'Hubert', '', 'DEPT003', 2, 5, 'EST003', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `ems_emp_dependents`
--

INSERT INTO `ems_emp_dependents` (`ed_id`, `emp_num`, `ed_name`, `ed_relationship`, `ed_datebirth`) VALUES
(6, 111, 'neo', 'pamangkin', '2004-04-04');

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
('EST001', 'Casual'),
('EST002', 'Probationary'),
('EST003', 'Regular');

-- --------------------------------------------------------

--
-- Table structure for table `ems_equip_requests`
--

CREATE TABLE IF NOT EXISTS `ems_equip_requests` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `ems_equip_requests`
--

INSERT INTO `ems_equip_requests` (`erqst_id`, `emp_num`, `date_filed`, `subject_purpose`, `client_branch`, `date_from`, `date_to`, `no_of_days`, `equip_list`, `status`, `remarks`) VALUES
(2, 111, '2011-08-08', 'meeting', 'iRipple', '2011-08-09', '2011-08-09', 1, 'Projector|Laptop|Mouse|Targus.|', 'Cancelled', ''),
(4, 20000101, '2011-08-09', 'meeting', 'citihardware', '2011-08-09', '2011-08-09', 1, 'Projector|Keyboard|Polycom|', 'Pending', ''),
(5, 111, '2011-08-10', 'meeting', 'iRipple', '2011-08-10', '2011-08-10', 1, 'Projector|Targus.|', 'Pending', '');

-- --------------------------------------------------------

--
-- Table structure for table `ems_equip_requisitions`
--

CREATE TABLE IF NOT EXISTS `ems_equip_requisitions` (
  `erqstn_id` int(11) NOT NULL auto_increment,
  `emp_num` int(15) NOT NULL,
  `date_filed` date NOT NULL,
  `date_needed` date NOT NULL,
  `qty` varchar(100) NOT NULL,
  `items` varchar(900) NOT NULL,
  `purpose` varchar(900) NOT NULL,
  `remarks` varchar(900) NOT NULL,
  `status` varchar(20) NOT NULL,
  `state` tinyint(1) NOT NULL,
  PRIMARY KEY  (`erqstn_id`),
  KEY `emp_num` (`emp_num`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `ems_equip_requisitions`
--

INSERT INTO `ems_equip_requisitions` (`erqstn_id`, `emp_num`, `date_filed`, `date_needed`, `qty`, `items`, `purpose`, `remarks`, `status`, `state`) VALUES
(2, 111, '2011-08-08', '0000-00-00', '1|1|', 'as|qw|', 'as', 'not needed', 'Denied', 0),
(3, 111, '2011-08-08', '2011-08-09', '1|', 'mouse|', 'Pc', 'Needed for office use.\r\n', 'Confirmed', 0),
(4, 111, '2011-08-09', '2011-08-10', '1|', 'LCD Monitor|', 'Office use', '', 'Confirmed', 0),
(5, 111, '2011-08-10', '2011-08-12', '1|', 'mouse|', 'Pc upgrade.\r\n', '', 'Pending', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `ems_joblevel`
--

INSERT INTO `ems_joblevel` (`jl_id`, `job_level`, `rank`, `grade`) VALUES
(5, '1', 'Staff', '1'),
(6, '2', 'Staff', '1'),
(7, '1', 'Supervisor', '1');

-- --------------------------------------------------------

--
-- Table structure for table `ems_jobspecs`
--

CREATE TABLE IF NOT EXISTS `ems_jobspecs` (
  `jobspec_id` int(11) NOT NULL auto_increment,
  `jobspec_name` varchar(50) NOT NULL,
  `jobspec_desc` text,
  `jobspec_duties` text,
  PRIMARY KEY  (`jobspec_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ems_jobspecs`
--

INSERT INTO `ems_jobspecs` (`jobspec_id`, `jobspec_name`, `jobspec_desc`, `jobspec_duties`) VALUES
(1, 'Software Solutions Associate', '', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `ems_jobtitle`
--

INSERT INTO `ems_jobtitle` (`job_title_code`, `job_title_name`, `job_title_desc`, `job_title_comm`, `jobspec_id`) VALUES
(2, 'Software Engineer', NULL, NULL, 0),
(4, 'Software Solutions Analyst', 'Good.', '', 0),
(5, 'Quality Assurance Analyst', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ems_leave`
--

CREATE TABLE IF NOT EXISTS `ems_leave` (
  `leave_id` int(11) NOT NULL auto_increment,
  `emp_num` int(15) NOT NULL,
  `date_filed` date NOT NULL,
  `d_from` date NOT NULL,
  `d_to` date NOT NULL,
  `no_of_days` float NOT NULL,
  `time` varchar(2) NOT NULL,
  `type` varchar(100) NOT NULL,
  `reason` varchar(900) NOT NULL,
  `remarks` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY  (`leave_id`),
  KEY `emp_num` (`emp_num`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `ems_leave`
--

INSERT INTO `ems_leave` (`leave_id`, `emp_num`, `date_filed`, `d_from`, `d_to`, `no_of_days`, `time`, `type`, `reason`, `remarks`, `status`) VALUES
(44, 111, '2011-08-10', '2011-08-15', '2011-08-16', 2, '', 'Sick Leave', 'Fever. \r\n', 'ok ok eto na.\r\n', 'Denied'),
(45, 111, '2011-08-10', '2011-08-29', '2011-08-31', 3, '', 'Vacation Leave', 'Outing.\r\n', '', 'Cancelled'),
(46, 111, '2011-08-10', '2011-08-10', '2011-08-15', 5.5, 'AM', 'Vacation Leave', 'Outing.', '', 'Cancelled'),
(47, 111, '2011-08-10', '2011-08-10', '2011-08-10', 1.5, 'AM', 'Sick Leave', 'Half day sick leave due to stomach ache.', '', 'Approved'),
(48, 111, '2011-08-10', '2011-08-15', '2011-08-18', 4, '', 'Vacation Leave', 'Family vacation.', '', 'Denied');

-- --------------------------------------------------------

--
-- Table structure for table `ems_leave_summary`
--

CREATE TABLE IF NOT EXISTS `ems_leave_summary` (
  `lv_sum_id` int(11) NOT NULL auto_increment,
  `leave_id` int(11) NOT NULL,
  `emp_num` varchar(15) NOT NULL,
  `type` varchar(15) NOT NULL,
  `benefits` int(4) NOT NULL,
  `days` int(4) NOT NULL,
  `balance` int(4) NOT NULL,
  PRIMARY KEY  (`lv_sum_id`),
  KEY `emp_num` (`emp_num`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `ems_leave_summary`
--

INSERT INTO `ems_leave_summary` (`lv_sum_id`, `leave_id`, `emp_num`, `type`, `benefits`, `days`, `balance`) VALUES
(26, 40, '111', 'Sick Leave', 7, 3, 4),
(27, 40, '111', 'Sick Leave', 7, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ems_ob`
--

CREATE TABLE IF NOT EXISTS `ems_ob` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ems_ob`
--

INSERT INTO `ems_ob` (`ob_id`, `emp_num`, `date_filed`, `client_branch`, `date_ob`, `purpose`, `status`, `remarks`, `departure`, `time_start`, `time_end`, `duration`, `arrival`, `total`) VALUES
(1, 111, '2011-08-10', 'Super 8', '2011-08-11', 'Delivery|POS.|', 'Pending', '', '12:00 pm ', '1:00 pm', '2:00 pm', 1, '3:00 pm', 2);

-- --------------------------------------------------------

--
-- Table structure for table `ems_offset`
--

CREATE TABLE IF NOT EXISTS `ems_offset` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ems_offset`
--

INSERT INTO `ems_offset` (`offset_id`, `emp_num`, `date_filed`, `date_ot`, `date_ot2`, `ot_hours`, `ot_hours2`, `accomplishment`, `date_offset`, `date_offset2`, `remarks`, `status`) VALUES
(1, 111, '2011-08-08', '2011-08-20', '2011-08-21', 8, 8, 'Ems', '2011-08-29', '2011-08-30', 'Ty.', 'Pending'),
(2, 111, '2011-08-10', '2011-08-06', '2011-08-07', 8, 8, 'pcount', '2011-08-16', '2011-08-18', 'Thanks.', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `ems_ot`
--

CREATE TABLE IF NOT EXISTS `ems_ot` (
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

INSERT INTO `ems_ot` (`ot_id`, `emp_num`, `date_filed`, `date_ot`, `no_of_hours`, `cdc`, `expected_output`, `status`, `remarks`) VALUES
(1, 111, '2011-08-10', '2011-08-11', 6, 1, 'iEMS', 'Pending', ''),
(2, 111, '2011-08-10', '2011-08-10', 4, 1, 'iEMS module.', 'Approved', '');

-- --------------------------------------------------------

--
-- Table structure for table `ems_photos`
--

CREATE TABLE IF NOT EXISTS `ems_photos` (
  `img_id` int(11) NOT NULL auto_increment,
  `emp_num` int(15) NOT NULL,
  `path` varchar(50) NOT NULL,
  PRIMARY KEY  (`img_id`),
  KEY `emp_num` (`emp_num`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `ems_photos`
--

INSERT INTO `ems_photos` (`img_id`, `emp_num`, `path`) VALUES
(2, 666, 'photos/untitled.JPG'),
(4, 222, 'photos/before.JPG'),
(5, 20081201, 'photos/P8140710.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `ems_undertime`
--

CREATE TABLE IF NOT EXISTS `ems_undertime` (
  `un_id` int(11) NOT NULL auto_increment,
  `emp_num` int(15) NOT NULL,
  `date_filed` date NOT NULL,
  `date_un` date NOT NULL,
  `nature_un` varchar(100) NOT NULL,
  `time` varchar(20) NOT NULL,
  `reason` varchar(900) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY  (`un_id`),
  KEY `emp_num` (`emp_num`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `ems_undertime`
--

INSERT INTO `ems_undertime` (`un_id`, `emp_num`, `date_filed`, `date_un`, `nature_un`, `time`, `reason`, `status`) VALUES
(5, 111, '2011-08-10', '2011-08-10', 'emergency|', '3:30 pm', 'Family problem.', 'Approved');

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
  PRIMARY KEY  (`user_id`),
  KEY `emp_num` (`emp_num`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `ems_users`
--

INSERT INTO `ems_users` (`user_id`, `username`, `password`, `deleted`, `emp_num`, `rights`, `status`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'no', NULL, 1, 'Enabled'),
(2, 'chard', '64f2820ec2d6e12bb3396db1505208c3', 'no', 111, 3, 'Enabled'),
(3, 'hdy', 'e10adc3949ba59abbe56e057f20f883e', 'no', 20000101, 2, 'Enabled');

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
