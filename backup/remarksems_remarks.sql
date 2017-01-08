-- phpMyAdmin SQL Dump
-- version 2.10.0.2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Sep 23, 2011 at 09:39 AM
-- Server version: 5.0.67
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `ems`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_remarks`
-- 

CREATE TABLE `ems_remarks` (
  `remarks_id` int(8) NOT NULL auto_increment,
  `id` varchar(15) NOT NULL,
  `emp_num` int(15) NOT NULL,
  `date` varchar(50) NOT NULL,
  `remarks` text NOT NULL,
  PRIMARY KEY  (`remarks_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- 
-- Dumping data for table `ems_remarks`
-- 

INSERT INTO `ems_remarks` VALUES (1, 'ovt-0025', 111, 'updated last: Sep 20, 2011 01:37:41 pm', 'this is just a test. jan ka lamang at wag kang aalis.  jan ka lamang at wag kang aalis. jan ka lamang at wag kang aalis.');
INSERT INTO `ems_remarks` VALUES (2, 'ovt-0025', 111, 'updated last: Sep 21, 2011 03:25:49 pm', 'eehhhh ayeh. that what I said now.');
INSERT INTO `ems_remarks` VALUES (3, 'ovt-0025', 111, 'updated last: Sep 21, 2011 03:27:18 pm', 'add ulit. wanna buy me flowers, like to talk for hours..<br />\r\nadd ulit. wanna buy me flowers, like to talk for hours..<br />\r\nadd ulit. wanna buy me flowers, like to talk for hours..add ulit. wanna buy me flowers, like to talk for hours..');
INSERT INTO `ems_remarks` VALUES (4, 'rsv-0001', 1, 'created: Sep 21, 2011 05:39:03 pm', 'ok na approve na ingatan mo yan. :D');
INSERT INTO `ems_remarks` VALUES (5, 'rsv-0001', 111, 'updated last: Sep 21, 2011 05:52:32 pm', 'gud kala ko patatagalin mo pa e. aus yan, salamat anyways.');
INSERT INTO `ems_remarks` VALUES (7, 'und-0001', 111, 'created: Sep 23, 2011 09:55:07 am', 'ang panget ng interface pag IE ang gamit. tsk');
