-- phpMyAdmin SQL Dump
-- version 2.11.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 13, 2012 at 03:18 AM
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
('DEP-0009', 'Admin');
