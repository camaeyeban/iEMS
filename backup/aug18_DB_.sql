-- phpMyAdmin SQL Dump
-- version 2.10.0.2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Aug 18, 2011 at 06:26 AM
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

INSERT INTO `ems_accomplishments` VALUES (1, '2011-08-10', '7:00 pm', '8:00 pm', 1, 'EMS MODULE', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES (2, '2011-08-10', '', '', 0, '', '', '', '');
INSERT INTO `ems_accomplishments` VALUES (3, '2011-08-16', '', '', 0, '', '', '', '');
INSERT INTO `ems_accomplishments` VALUES (4, '2011-08-16', '6:30 pm', '8:30 pm', 2, 'Finished testing of EMS.', '', 'Denied', 'Reason..');
INSERT INTO `ems_accomplishments` VALUES (5, '2011-08-17', '', '', 0, '', '', '', '');
INSERT INTO `ems_accomplishments` VALUES (6, '2011-08-18', '', '', 0, '', '', '', '');

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
  `status` varchar(20) NOT NULL,
  `state` smallint(1) NOT NULL,
  PRIMARY KEY  (`at_id`),
  KEY `emp_num` (`emp_num`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- 
-- Dumping data for table `ems_air_ticket`
-- 

INSERT INTO `ems_air_ticket` VALUES (1, 111, '2011-08-08', 'COHs', 'Manila', 'Cebu', 'Cebu Pac', 'Aug-9-2011 05:30:00 PM', 'Aug-9-2011 06:30:00 PM', 'Seminar.', 'ok na po.ssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss', '5,000.00', 'Reviewed', 2);
INSERT INTO `ems_air_ticket` VALUES (2, 111, '2011-08-10', 'Power House', 'Manila', 'Cebu', 'Cebu Pac', 'Aug-13-2011 11:00:00 PM', 'Aug-13-2011 11:50:00 PM', 'Seminar.', 'OK.', '6,000', 'Booked', 3);
INSERT INTO `ems_air_ticket` VALUES (3, 111, '2011-08-18', 'Super 8', 'Manila', 'Cebu', 'PAL', 'Aug-13-2011 11:00:00 PM', 'Aug-13-2011 11:50:00 PM', 'Bakasyown.\r\n', '', '', 'Pending', 0);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

-- 
-- Dumping data for table `ems_attachments`
-- 

INSERT INTO `ems_attachments` VALUES (22, '613', 'attachments/cat1.jpg', 'cat1.jpg', 'Sample Attachment', '119.8 kb', 'image/jpeg');
INSERT INTO `ems_attachments` VALUES (24, '111', 'attachments/shortlisted.txt', 'shortlisted.txt', '', '0.3 kb', 'text/plain');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=4 ;

-- 
-- Dumping data for table `ems_benefits`
-- 

INSERT INTO `ems_benefits` VALUES (1, '111', 8, 11);
INSERT INTO `ems_benefits` VALUES (2, '613', 15, 7);
INSERT INTO `ems_benefits` VALUES (3, '613', 7, 7);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

-- 
-- Dumping data for table `ems_business_units`
-- 

INSERT INTO `ems_business_units` VALUES (6, 'DEPT002', 'Richard Allan Ladiana', 'Sales');
INSERT INTO `ems_business_units` VALUES (8, 'DEPT005', 'Jason Meribeles', 'None');
INSERT INTO `ems_business_units` VALUES (9, 'DEPT0010', 'Hubert Dy', 'HR');
INSERT INTO `ems_business_units` VALUES (10, 'DEPT0010', 'Hubert Dy', 'None');
INSERT INTO `ems_business_units` VALUES (11, 'DEPT0010', 'Hubert Dy', 'None');
INSERT INTO `ems_business_units` VALUES (12, 'DEPT009', 'Benito Viloria', 'None');
INSERT INTO `ems_business_units` VALUES (13, 'DEPT0010', 'Hubert Dy', 'None');

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
INSERT INTO `ems_department` VALUES ('DEPT003', 'Product');
INSERT INTO `ems_department` VALUES ('DEPT004', 'HR');
INSERT INTO `ems_department` VALUES ('DEPT005', 'Support');
INSERT INTO `ems_department` VALUES ('DEPT006', 'Sales');
INSERT INTO `ems_department` VALUES ('DEPT007', 'Pharma');
INSERT INTO `ems_department` VALUES ('DEPT010', 'Training');

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

INSERT INTO `ems_employee` VALUES (111, '2011-08-01', '0000-00-00', '0000-00-00', 'Ladiana', 'Richard Allan', 'Godoy', 'DEPT002', 2, 5, 'EST002', 'male', 'Ortigas', 'Bulacan', 'Pasig      ', '1605', '', '7929662', '09386867806', '', 'raladiana.iripple@gmail.com', '', '1990-01-09', '2222565652', '3333', '555424234', '4444');
INSERT INTO `ems_employee` VALUES (222, '0000-00-00', '0000-00-00', '0000-00-00', 'Meribeles', 'Jason', '', 'DEPT005', 0, 0, '--Select--', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ems_employee` VALUES (555, '0000-00-00', '0000-00-00', '0000-00-00', 'Dela Cruz', 'Juan', '', 'DEPT002', 0, 0, '--Select--', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ems_employee` VALUES (613, '0000-00-00', '0000-00-00', '0000-00-00', 'Trial', 'Sample', 'Test', 'DEPT009', 6, 10, 'EST004', 'female', 'Sample Address', 'Sample Address2', 'Pasig   ', 'Bicol', '1109', '1245458dsfsdfsd', '12345679865sdfsdfsd', 'dfsddfgsdfgf', 'test@iripple.com', 'tes@yahoo.com', '1990-01-13', '131313', '141414', '121212', '151515');
INSERT INTO `ems_employee` VALUES (777, '0000-00-00', '0000-00-00', '0000-00-00', 'Viloria', 'Benito', 'B', 'DEPT009', 7, 8, 'EST003', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ems_employee` VALUES (888, '0000-00-00', '0000-00-00', '0000-00-00', 'Tayson', 'Jamil', '', 'DEPT005', 0, 0, 'EST001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ems_employee` VALUES (999, '0000-00-00', '0000-00-00', '0000-00-00', 'Balingit', 'Barbs', '', 'DEPT006', 5, 0, 'EST001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ems_employee` VALUES (1212, '0000-00-00', '0000-00-00', '0000-00-00', 'mm', 'MM', 'mm', NULL, NULL, 0, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2011-08-18', 'fdgfdsg', 'sdfgsfdg', 'edfgsg', 'fsdgfdsg');
INSERT INTO `ems_employee` VALUES (2141, '0000-00-00', '0000-00-00', '0000-00-00', 'Test', 'Samp', 'Test', 'DEPT009', 5, 6, 'EST003', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ems_employee` VALUES (3232, '0000-00-00', '0000-00-00', '0000-00-00', 'M', 'TestManager', 'T', 'DEPT009', 7, 10, 'EST003', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ems_employee` VALUES (20000101, '0000-00-00', '0000-00-00', '0000-00-00', 'Dy', 'Hubert', '', 'DEPT002', 2, 5, 'EST003', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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

INSERT INTO `ems_emp_status` VALUES ('EST001', 'Casuals');
INSERT INTO `ems_emp_status` VALUES ('EST002', 'Probationary');
INSERT INTO `ems_emp_status` VALUES ('EST003', 'Regular');
INSERT INTO `ems_emp_status` VALUES ('EST004', 'Contractual');
INSERT INTO `ems_emp_status` VALUES ('EST005', 'Test');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- 
-- Dumping data for table `ems_equip_requests`
-- 

INSERT INTO `ems_equip_requests` VALUES (2, 111, '2011-08-08', 'meeting', 'iRipple', '2011-08-09', '2011-08-09', 1, 'Projector|Laptop|Mouse|Targus.|', 'Cancelled', '');
INSERT INTO `ems_equip_requests` VALUES (4, 20000101, '2011-08-09', 'meeting', 'citihardware', '2011-08-09', '2011-08-09', 1, 'Projector|Keyboard|Polycom|', 'Denied', 'hello');
INSERT INTO `ems_equip_requests` VALUES (5, 111, '2011-08-10', 'meeting', 'iRipple', '2011-08-10', '2011-08-10', 1, 'Projector|Targus.|', 'Cancelled', 'Opo. cr lang :D');
INSERT INTO `ems_equip_requests` VALUES (6, 111, '2011-08-16', 'MANCOM', 'iRipple', '2011-08-17', '2011-08-17', 1, 'Projector|Laptop||', 'Pending', '');
INSERT INTO `ems_equip_requests` VALUES (7, 2141, '2011-08-17', 'Sample Purpose', 'Ripple', '2011-08-08', '2011-08-11', 4, 'Projector||', 'Pending', '');
INSERT INTO `ems_equip_requests` VALUES (8, 111, '2011-08-18', 'MANCOM', 'iRipple', '2011-08-18', '2011-08-18', 1, 'Projector|Mouse||', 'Pending', '');

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
  `state` tinyint(1) NOT NULL,
  PRIMARY KEY  (`erqstn_id`),
  KEY `emp_num` (`emp_num`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- 
-- Dumping data for table `ems_equip_requisitions`
-- 

INSERT INTO `ems_equip_requisitions` VALUES (2, 111, '2011-08-08', '0000-00-00', '3|', 'Projector|', 'Sample Purpose', 'not needed', 'Denied', 0);
INSERT INTO `ems_equip_requisitions` VALUES (3, 111, '2011-08-08', '2011-08-09', '3|', 'Projector|', 'Sample Purpose', 'denis rason', 'Denied', 0);
INSERT INTO `ems_equip_requisitions` VALUES (4, 111, '2011-08-09', '2011-08-10', '3|', 'Projector|', 'Sample Purpose', 'Ayos.', 'Cancelled', 1);
INSERT INTO `ems_equip_requisitions` VALUES (5, 111, '2011-08-10', '2011-08-12', '3|', 'Projector|', 'Sample Purpose', '', 'Cancelled', 0);
INSERT INTO `ems_equip_requisitions` VALUES (6, 111, '2011-08-15', '0000-00-00', '3|', 'Projector|', 'Sample Purpose', 'mali eh.', 'Cancelled', 0);
INSERT INTO `ems_equip_requisitions` VALUES (7, 2141, '2011-08-17', '2011-08-19', '3|', 'Projector|', 'Sample Purpose', '', 'Pending', 0);
INSERT INTO `ems_equip_requisitions` VALUES (8, 777, '2011-08-17', '2011-08-09', '5|', 'sdfsdfsdfdf|', 'dfsdfds', '', 'Pending', 0);

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
-- Table structure for table `ems_jobspecs`
-- 

CREATE TABLE `ems_jobspecs` (
  `jobspec_id` int(11) NOT NULL auto_increment,
  `jobspec_name` varchar(50) NOT NULL,
  `jobspec_desc` text,
  `jobspec_duties` text,
  PRIMARY KEY  (`jobspec_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `ems_jobspecs`
-- 

INSERT INTO `ems_jobspecs` VALUES (1, 'Software Solutions Associate', '', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- 
-- Dumping data for table `ems_jobtitle`
-- 

INSERT INTO `ems_jobtitle` VALUES (2, 'Software Engineer', NULL, NULL, 0);
INSERT INTO `ems_jobtitle` VALUES (4, 'Software Solutions Analyst', 'Good.', '', 0);
INSERT INTO `ems_jobtitle` VALUES (5, 'Quality Assurance Analyst', '', '', 0);
INSERT INTO `ems_jobtitle` VALUES (6, 'Technical Writer', 'Test Description', 'Sample Comment', 0);
INSERT INTO `ems_jobtitle` VALUES (7, 'Product Manager', 'Sample Manager', 'Sample Manager', 0);

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
  `reason` varchar(900) NOT NULL,
  `remarks` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY  (`leave_id`),
  KEY `emp_num` (`emp_num`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

-- 
-- Dumping data for table `ems_leave`
-- 

INSERT INTO `ems_leave` VALUES (44, 111, '2011-08-10', '2011-08-15', '2011-08-16', 2, '', 'Sick Leave', 'Fever. \r\n', '\r\n', 'Approved');
INSERT INTO `ems_leave` VALUES (45, 111, '2011-08-10', '2011-08-29', '2011-08-31', 3, '', 'Vacation Leave', 'Outing.\r\n', '[bb]: dfasdf\r\n\r\n[jk]: sdfsdf', 'Cancelled');
INSERT INTO `ems_leave` VALUES (46, 111, '2011-08-10', '2011-08-10', '2011-08-15', 5.5, 'AM', 'Vacation Leave', 'Outing.', ' ', 'Cancelled');
INSERT INTO `ems_leave` VALUES (47, 111, '2011-08-10', '2011-08-10', '2011-08-10', 1.5, 'AM', 'Sick Leave', 'Half day sick leave due to stomach ache.', '', 'Cancelled');
INSERT INTO `ems_leave` VALUES (48, 111, '2011-08-10', '2011-08-15', '2011-08-18', 4, '', 'Vacation Leave', 'Family vacation.', ' ', 'Cancelled');
INSERT INTO `ems_leave` VALUES (49, 888, '2011-08-12', '2011-08-24', '2011-08-24', 1, '', 'Sick Leave', 'Trangkaso.', '', 'Pending');
INSERT INTO `ems_leave` VALUES (50, 111, '2011-08-16', '2011-08-17', '2011-08-17', 0.5, 'AM', 'Sick Leave', 'Headache.', 'Test.', 'Denied');
INSERT INTO `ems_leave` VALUES (51, 111, '2011-08-17', '2011-08-23', '2011-08-23', 1, '', 'Sick Leave', 'Fever.', '', 'Pending');
INSERT INTO `ems_leave` VALUES (52, 613, '2011-08-17', '2011-08-18', '2011-08-18', 1, 'PM', 'Sick Leave', 'Sample SL', '', 'Pending');
INSERT INTO `ems_leave` VALUES (53, 613, '2011-08-17', '2011-08-18', '2011-08-19', 2, 'AM', 'Vacation Leave', 'Sample VL', 'Sample Remarks', 'Approved');
INSERT INTO `ems_leave` VALUES (54, 613, '2011-08-17', '2011-08-18', '2011-08-18', 1, 'AM', 'Emergency Leave', 'Sample EL', '', 'Pending');
INSERT INTO `ems_leave` VALUES (55, 613, '2011-08-17', '2011-08-22', '2011-08-26', 5, '', 'Maternity/Paternity Leave', 'Sample Maternity Leave', '', 'Approved');
INSERT INTO `ems_leave` VALUES (56, 777, '2011-08-17', '2011-09-05', '2011-09-09', 5, '', 'Vacation Leave', '..', '', 'Pending');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_leave_summary`
-- 

CREATE TABLE `ems_leave_summary` (
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

INSERT INTO `ems_leave_summary` VALUES (26, 40, '111', 'Sick Leave', 7, 3, 4);
INSERT INTO `ems_leave_summary` VALUES (27, 40, '111', 'Sick Leave', 7, 4, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- 
-- Dumping data for table `ems_ob`
-- 

INSERT INTO `ems_ob` VALUES (1, 111, '2011-08-10', 'Super 8', '2011-08-11', 'Delivery|POS.|', 'Cancelled', 'Yes sir!', '12:00 pm ', '1:00 pm', '2:00 pm', 1, '3:00 pm', 2);
INSERT INTO `ems_ob` VALUES (2, 888, '2011-08-11', 'Super 8', '2011-08-11', 'Network||', 'Pending', '', '12:00 am ', '12:55 am', '12:55 am', 1, '1:05 am', 2);
INSERT INTO `ems_ob` VALUES (3, 2141, '2011-08-17', 'Ripple', '2011-08-19', 'Meeting|hhhh|', 'Pending', 'hhhh', '1:00 pm ', '2:00 pm', '6:00 pm', 4, '2:00 pm', 4);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- 
-- Dumping data for table `ems_offset`
-- 

INSERT INTO `ems_offset` VALUES (1, 111, '2011-08-08', '2011-08-20', '2011-08-21', 8, 8, 'Ems', '2011-08-29', '2011-08-30', '$gutom aq. ', 'Cancelled');
INSERT INTO `ems_offset` VALUES (2, 111, '2011-08-10', '2011-08-06', '2011-08-07', 8, 8, 'pcount', '2011-08-16', '2011-08-18', 'one down.\r\ntwo down.\r\n', 'Denied');
INSERT INTO `ems_offset` VALUES (3, 613, '2011-08-17', '2011-08-16', '0000-00-00', 2, 0, 'Sample Accomplishments', '2011-08-29', '0000-00-00', 'Sample Remarks', 'Pending');

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

INSERT INTO `ems_ot` VALUES (1, 111, '2011-08-10', '2011-08-11', 6, 1, 'iEMS', 'Approved', '');
INSERT INTO `ems_ot` VALUES (2, 111, '2011-08-10', '2011-08-10', 4, 1, 'iEMS module.', 'Approved', '');
INSERT INTO `ems_ot` VALUES (3, 111, '2011-08-16', '2011-08-16', 2, 1, 'DTR', 'Denied', 'Reason..');
INSERT INTO `ems_ot` VALUES (4, 111, '2011-08-16', '2011-08-16', 2, 1, 'EMS Testing', 'Approved', '');
INSERT INTO `ems_ot` VALUES (5, 613, '2011-08-17', '2011-08-17', 2, 1, 'Sample OT', 'Pending', '');
INSERT INTO `ems_ot` VALUES (6, 111, '2011-08-18', '2011-08-18', 2, 1, 'Sample', 'Denied', 'Reason..');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- 
-- Dumping data for table `ems_photos`
-- 

INSERT INTO `ems_photos` VALUES (2, 666, 'photos/untitled.JPG');
INSERT INTO `ems_photos` VALUES (4, 222, 'photos/before.JPG');
INSERT INTO `ems_photos` VALUES (5, 20081201, 'photos/P8140710.JPG');
INSERT INTO `ems_photos` VALUES (6, 613, 'photos/43878072_9b440a24af_o.jpg');
INSERT INTO `ems_photos` VALUES (7, 111, 'photos/5493.jpg');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- 
-- Dumping data for table `ems_undertime`
-- 

INSERT INTO `ems_undertime` VALUES (5, 111, '2011-08-10', '2011-08-10', 'emergency', '3:30 pm', 'Family problem.', '', 'Pending');
INSERT INTO `ems_undertime` VALUES (6, 111, '2011-08-12', '2011-08-12', 'emergency', '4:30 pm', 'Emergency.', 'Change of mind. Will chose another date instead.', 'Cancelled');
INSERT INTO `ems_undertime` VALUES (7, 999, '2011-08-16', '2011-08-17', 'Emergency', '4:30 pm', 'Need to attend to personal matters.', 'nice to see this working. :)', 'Pending');
INSERT INTO `ems_undertime` VALUES (8, 613, '2011-08-17', '2011-08-17', 'Anticipated', '4:30 pm', 'Sample Undertime', '', 'Approved');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

-- 
-- Dumping data for table `ems_users`
-- 

INSERT INTO `ems_users` VALUES (1, 'admin', '202cb962ac59075b964b07152d234b70', 'no', NULL, 1, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (2, 'chard', '64f2820ec2d6e12bb3396db1505208c3', 'no', 111, 3, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (3, 'hdy', 'e10adc3949ba59abbe56e057f20f883e', 'no', 20000101, 2, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (4, 'jason', '2b877b4b825b48a9a0950dd5bd1f264d', 'no', 222, 2, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (7, 'barbs', '56032de71c59b706e1ec6d4b8b651f33', 'no', 999, 4, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (17, 'Samp', '098f6bcd4621d373cade4e832627b4f6', 'yes', 2141, 3, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (18, 'TestManager', '098f6bcd4621d373cade4e832627b4f6', 'no', 3232, 2, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (19, 'ben', '7fe4771c008a22eb763df47d19e2c6aa', 'no', 777, 2, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (20, 'jamil', '0e2cc23df7e37a854499f9d918b0219d', 'no', 888, 1, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (21, 'wewe', '2a7d544ccb742bd155e55c796de8e511', 'no', 1212, 1, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (22, 'admin', '03c7c0ace395d80182db07ae2c30f034', 'yes', 613, 1, 'Enabled', 0);

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
