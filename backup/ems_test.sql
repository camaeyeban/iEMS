-- phpMyAdmin SQL Dump
-- version 2.10.0.2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Apr 25, 2013 at 12:50 AM
-- Server version: 5.0.37
-- PHP Version: 5.2.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `ems_test`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_accomplishments`
-- 

CREATE TABLE `ems_accomplishments` (
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `ems_accomplishments`
-- 

INSERT INTO `ems_accomplishments` VALUES ('ovt-0001', '2011-10-10', '1140', '1260', 2, 'Done Consolidating Issues of assigned Clients ', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0002', '2011-10-10', '1140', '1260', 2, 'listed all pending issues with BC and DEV.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0003', '2011-10-13', '210', '1320', 18, 'Complete Migrating Old Generic POS to HP rp5700 POS Paris Hilton New Port\r\nDetails is as follows.\r\n- Backup Important Database, Files, current settings and  Documents from old POS\r\n- Install Sharepoint, and Barter POS\r\n- Restore Computer Settings, Sharepoint and POS files\r\n- Restore Backup Datase, files and Docuements\r\n- Update VNC Server for performance Improvement\r\n- Update VNC Server for performance Improvement\r\n- Create new terminal remotely in server.\r\n- Set current configuration of terminal\r\n- Syncronize Branch to Headoffice\r\n- Test  connection\r\n- Download POSsync Data\r\n- Update Barter POS\r\n- Excecute 1st Z-reading\r\n- Assist Encoding of Sales\r\n- Check DSR\r\n- Test Send Data to Server\r\n- Check if Server Recieve Branch Sales', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0004', '2011-10-14', '1140', '1320', 3, 'corrected zreading of Tarlac with dates dec 22,2010, dec 30, 2010, dec 31,2010 and oct 12,2011.\r\ncorrected zreading of Ortigas with dates oct 29,2010, dec 31,2010 and oct 11, 2011', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0005', '2011-10-18', '1140', '1375', 4, 'sent the revised pos.mdb to client.', 'wait for HD''s tool to remove excess spaces. then test it before forwarding to client.', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0006', '2011-10-28', '1110', '30', 6, 'Fixed urgent bugs in EMS for launching: OB Confirmation and Approval when OB and date filed is on the same day. Fixed ob arrival in summary. Updated EMS database and source.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0007', '2011-10-28', '', '', 0, '', '', '', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0008', '2011-11-02', '1020', '510', 7, 'software was upgraded to barter 8.5.3', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0009', '2011-11-02', '1260', '120', 5, 'printer configuration of ibm 1nr printer', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0010', '2011-11-02', '1110', '1260', 2, 'Petty Cash schedule - including the manual journal\r\nPrinting of Confirmation letter for audit', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0011', '2011-11-02', '', '', 0, '', '', '', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0012', '2011-11-02', '', '', 0, '', '', '', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0013', '2011-11-02', '', '', 0, '', '', '', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0014', '2011-11-03', '1050', '1230', 3, 'set up and configured 10 ibm 1nr printer', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0015', '2011-11-03', '1110', '1260', 2, 'Bank Recon -SP Account\r\n                   - Third Party Account\r\n                   - Regular Account', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0016', '2011-11-04', '555', '1065', 7, 'I was able to clarify and simplify the procedure in parsing and importing of general article IDOC but was not able to finish full importation of general article due to additional validations that must be considered when clarified by HD. ', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0017', '2011-11-04', '510', '1030', 8, 'VAT for the month of October\r\nBank Recon -Regular Account', 'Executives (VJ/HD/JK) allowances and reimbursements are included in computing for VAT payable that''s why it take time to cpmpute for it.', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0018', '2011-11-08', '1110', '1230', 2, 'Finished the code for parsing of General Article IDOC, but not yet tested.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0019', '2011-11-08', '1110', '1230', 2, 'Released the update for Issue#4367\r\n\r\nEmail: FOR RELEASE [Gamot Publiko] Updates for Issue#4367 - Unable to save Physical Count document\r\n\r\nEmail to Client: [Gamot Publiko] Updates for Issue#4367 - Unable to save Physical Count document', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0020', '2011-11-09', '1110', '1260', 2, 'Was able to import a product to barter from an idoc but there are still no logs and progress bar yet.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0021', '2011-11-10', '1110', '1260', 2, 'Buy materials and finish printing of Manuals to be use in SCV Training.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0022', '2011-11-10', '390', '420', 24, 'travel time/version upgrade', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0023', '2011-11-10', '720', '120', 14, 'monitoring/printer setup', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0024', '2011-11-10', '510', '360', 22, 'printer setup/upgrade monitoring/travel time', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0025', '2011-11-14', '1140', '1435', 5, 'Installation of Barter Software Upgrade Version 8.5.3a\r\n\r\nNOTE: time out supposed to be 12:00am and no. of hrs. rendered is 5hr.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0026', '2011-11-16', '1140', '1310', 3, 'installed barter to 19 POS of Super8', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0027', '2011-11-16', '1110', '1260', 2, 'Printed Audit Confirmation letters\r\n            -Account Receivable\r\n            -Account Payable', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0028', '2011-11-17', '1140', '1290', 2, 'installed and configured 19 printers of Super 8 Molino', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0029', '2011-11-24', '675', '1155', 8, 'Tested the 360 POS and Lookup updates.  Refer to 	 RE: [three-sixty] Revisions - For testing for QA Findings', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0030', '2011-11-25', '565', '1035', 8, 'Update the 2307 form for audit purposes\r\nOR,deposit slip filling\r\nAccounts Receivable hard copy update', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0031', '2011-11-25', '1050', '1170', 2, 'Test Issue # 4430 Cancelled status not seen in HO only posted', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0032', '2011-11-26', '660', '1020', 6, 'done issues in pentstar and KLGFS (urgent) as been expected..\r\n', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0033', '2011-11-28', '1020', '1260', 4, 'barter and hardware maintenance', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0034', '2011-11-28', '1140', '60', 6, 'barter and hardware maintenance', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0035', '2011-11-28', '1110', '1230', 2, 'Released Issue #4430 of IMart', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0036', '2011-12-01', '1110', '1260', 2, 'Created the IDOCS for Article, SetArticle, EAN and PriceandPromotions', 'IDOCS will be used for testing and simulation of COH updates - 12/02/2011', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0037', '2011-12-01', '1110', '1230', 2, 'Bank recon - Regular Account\r\n                     Third Party Account\r\n                     Special PArty Account\r\n                     BIR online account', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0038', '2011-12-02', '885', '30', 9, 'Tested the SAP Agent (Outbound)\r\nPlease refer to Basecamp for result of testing', 'Update is needed on 12/6/2011', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0039', '2011-12-02', '1050', '1230', 3, 'Fixed errors and other findings in first QA testing of SAP Agent.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0040', '2011-12-05', '1110', '00', 5, 'Revised SAP Agent bugs and other minor revisions according to findings of QA.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0041', '2011-12-06', '1110', '15', 6, 'Test LH#355:Printing of Invoice to regular dot-matrix printer (2nd Cycle Test)', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0042', '2011-12-06', '1110', '30', 6, 'Tested SAP Agent Outbound - Profiles and Promotions of COH.\r\nSee email: [COH] QA Findings for SAP Outbound - Profiles (12/05/2011 - 12/06/2011)	', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0043', '2011-12-12', '', '', 0, '', '', '', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0044', '2011-12-12', '540', '1290', 12, 'setting up New Dell Server - Done\r\nSetting up workstation credential for new Server-Done\r\nRestore database from old to new server - Done\r\nSettings and configuration - Done', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0045', '2011-12-14', '560', '1025', 7, 'Sort and clean the reception area and the pantry dispose the food container with no owner, mug that cant be use.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0046', '2011-12-15', '1260', '60', 4, 'Assisted Ms Kim, for Barter MMS upgrade. Installation and Final Testing', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0047', '2011-12-15', '1140', '1270', 2, 'configured and reset 4 additional pos', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0048', '2011-12-20', '1140', '1435', 5, 'Go live monitoring - closing, sales submission', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0049', '2011-12-21', '1140', '1290', 2, 'Reindexed Product table and assist mam Des with uncategorized supplier', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0050', '2011-12-22', '1140', '1320', 3, 'Support Prince NRA POS Issue and consolidate assigned client issues', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0051', '2011-12-22', '1140', '1320', 3, 'consolidate issues of clients', '', 'Cancelled', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0052', '2011-12-22', '1110', '30', 6, 'Finished the revisions in Barter TX to limit the menus and features for Barter-SAP edition but not including the document update. The map for the Barter-SAP edition will follow.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0053', '2011-12-22', '1110', '70', 7, 'TESTED COH UPDATES', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0054', '2011-12-23', '1200', '1320', 2, 'consolidated issues of all clients for check point meeting', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0055', '2011-12-23', '1050', '1170', 2, 'Tested COH updates.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0056', '2011-12-27', '1140', '1290', 2, 'Tested the following issues of Delivery Module (COH):\r\nPassed:\r\n1. Birthday and TIN no. of customer  birthday is not remembered in changing customer in POS\r\n2. A sale transaction with vkit, alternate barcode, packing and regular item prints a thousand copy when form printing is selected.\r\n\r\nFailed:\r\n1. Truncated Tel. no and TIN\r\n2. Different length of Receiver address and customer address (backend)\r\n\r\n', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0057', '2011-12-27', '1110', '1435', 5, 'Developed Delivery Preprinted with Composition printing format (Unfinished). \r\n\r\nActual Time Out: 12/28/2001 12AM', 'Did the QA findings of the update released for testing earlier (other formats of form printing)', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0058', '2011-12-27', '1110', '1435', 5, 'Modify needed changes for Credit Memo Report and Delivery/Pickup Report for COH and released to QA for testing.\r\n\r\nActual time-out: 12:00 AM', 'Did the QA''s additional findings. Report should be released on or before 12/28/2011.', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0059', '2011-12-28', '1140', '20', 5, 'Tested the following passed DR issues:\r\n-error in db updater\r\n-retagging of items in document.\r\n-Delivery document printing in pre-printed format.\r\n-Print count of of reprinting delivery document in standard and pre -printed format.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0060', '2011-12-29', '1140', '1260', 2, 'Tested the following passed updates for delivery module:\r\n1. Printing of document in four form format:\r\n- Standard\r\n- Standrad with compo\r\n- Pre Printed\r\n- Pre Printed with compo\r\n2. Corrections on Delivery Report header.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0061', '2011-12-29', '1110', '1230', 2, 'Update passed by QA.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0062', '2011-12-29', '1110', '1275', 2.45, 'Was able to revise all findings of QA in POS printing with journal copy.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0063', '2011-12-29', '1140', '1260', 2, 'Tested the pending COH Updates', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0064', '2012-01-02', '1110', '1290', 3, 'Enabled saving of combo promo and its detail and combo group.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0065', '2012-01-03', '1110', '1250', 2.2, 'Adeo report - dec 2011', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0066', '2012-01-04', '1110', '30', 6, 'Printed 6 copies of test scripts for COH', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0067', '2012-01-04', '1110', '1245', 2.15, 'update google docs 2307 report', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0068', '2012-01-05', '1110', '1230', 2, 'Acquire needed sample data (filled up table fields) for CLP export. Started develop CLP export plugin for S8.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0069', '2012-01-06', '1110', '1230', 2, 'Enabled searching and adding of combo and its items in POS.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0070', '2012-01-06', '1110', '1230', 2, 'Able to connect and export file to FTP. ', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0071', '2012-01-07', '330', '450', 2, 'Continued development for CLP Export. Created query for CustomerPromo.txt and CustomerAccum.txt', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0072', '2012-01-09', '660', '1020', 6, 'Created setting for printing details in COMBO and apply it in receipt printing in POS.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0073', '2012-01-09', '660', '1020', 6, 'Continued development of CLP Export Plugin. Terminator.txt and started Auto Export.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0074', '2012-01-09', '1050', '1215', 2.45, '5''S in OMD Area ', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0075', '2012-01-09', '960', '1320', 6, 'Finished the COH POS Promo Test Scripts and sent to Ms. Fracy', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0076', '2012-01-11', '1110', '1250', 2.2, 'Reclassification of expense account (HMO-OPEX ,Travel national) \r\nThird party cost account matching ', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0077', '2012-01-11', '1110', '1260', 2.3, 'KS and I were able to run the script to fix customer points of Super 8 in HO regarding GPTS*1211B promo.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0078', '2012-01-12', '1110', '1345', 3.55, 'reclassification of expense account\r\naccrual of revenue', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0079', '2012-01-13', '1110', '1270', 2.4, 'Expanded witholding tax dec 2011 \r\nPetty cash report as of jan 13,2011 \r\nCheck processing', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0080', '2012-01-16', '1050', '1270', 3.4, 'Prepare 4pcs Training Manual, then bind and 26 Certificate of Completion for EZ supermarket training.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0081', '2012-01-17', '810', '1165', 5.55, 'Sorting items in cabinet, cleaning in reception area and assisting Supermax for the carpet cleaning ', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0082', '2012-01-17', '1140', '1310', 2.5, 'done testing', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0083', '2012-01-20', '1110', '1300', 3.1, 'Quarterly VAT payable - 4th quarter', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0084', '2012-01-30', '', '', 0, '', '', '', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0085', '2012-01-31', '', '', 0, '', '', '', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0086', '2012-02-07', '1110', '1295', 3.05, 'Bank recon-regular\r\n                 -Third party\r\n                 -Special Party', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0087', '2012-02-09', '1110', '1290', 3, 'Tested Citihardware Updates and finished the setup of database (HQ and Branch) for testing.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0088', '2012-02-09', '1110', '1290', 3, 'Tested the HQ and Branch Agents of Citihardware.\r\nResult: Failed on my end.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0089', '2012-02-09', '1110', '1290', 3, 'Updated the folowing manuals for COH:\r\n1. POS Sales Management User Manuals (Reports)\r\n2. Part of Delivery User Manual\r\n3. Part of POS Profiles User Manual\r\n', 'Updated other user manuals.', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0090', '2012-02-10', '1050', '1350', 5, 'Tested Issue#4071 - Reservation\r\nResult:  Failed\r\nTested the updates for HQ and Branch Agents\r\nResult: Failed', 'Sir Ben was in a meeting and the target date of the release is ASAP', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0091', '2012-02-13', '720', '1320', 10, 'Finished the testing of Reservation, HQ and Branch Agent updates.\r\nCreated the test script for Reservation, HQ and Branch Agent updates.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0092', '2012-02-13', '1110', '1230', 2, '1. Compiled the installer, release notes and revised the test scripts previously released by QA\r\nEmail Release: [Ripple] Barter MMS Installer 8.5.4 \r\n2. Prepared the Email Release for Citihardware', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0093', '2012-02-14', '1050', '1350', 5, '1. Tested Prince Blake and Prince Rhea updates\r\n2. Documented files for release.\r\n3. Released Issue #04577', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0094', '2012-02-14', '690', '1110', 7, '1. Test Issues #04531 and #4582 of Prince Rhea for 2nd cycle test\r\n2. Documented Test Script and Read me.\r\n3. Released updates to CB.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0095', '2012-02-20', '1110', '1280', 2.5, 'Was not able to finish merging due to Super 8''s concern regarding their Eco Bag promo. Also, there were major files that took a little longer to be merged.', 'Kat approached me for help to discuss Super 8''s concern regarding the changes for the Eco Bag promo. We discussed it with sir BV and sir HD which took place during the OT hours applied. Continued some merging work afterwards.', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0096', '2012-02-21', '1110', '1295', 3.05, 'Entries for January 2012 FS', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0097', '2012-02-21', '1260', '60', 4, 'working upgraded version (Barter 8.5.4) issue: all documents before upgrade was blank upon opening the document', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0098', '2012-02-22', '1200', '300', 10, 'Upgraded to Barter 8.5.4', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0099', '2012-02-23', '1110', '1255', 2.25, 'Entries for January 2012 FS', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0100', '2012-02-24', '1080', '1380', 5, 'Fixed issues arises after upgrade', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0101', '2012-02-29', '1110', '1230', 2, 'BIR Alphalist 1604E', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0102', '2012-03-01', '1110', '1230', 2, '1. Test Issue #4706 Eco Bag Enhancement - 3rd Cycle Test\r\n 2. Created Documentation for Release\r\n- Test Script\r\n- Read Me\r\n- Updater', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0103', '2012-03-02', '1110', '1335', 3.45, 'Entries for month-end closing\r\nCheck Processing\r\nBank Recon -Regular,3P,SP', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0104', '2012-03-09', '1050', '1270', 3.4, 'Finished revisions in the source code but not yet released. Finished meeting with sir Hubert regarding the logic for Shoppers''s Starsol Agent.', 'Meeting with sir HD took a little longer since some are asking urgent matters to him, which also hindered in finishing the update for Super 8.', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0105', '2012-03-12', '1110', '1230', 2, 'Submitted update for Super 8''s new CLP process. Email subject: FOR TESTING: [S8]:#04704 - CLP migration: UNION BANK to RCBC', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0106', '2012-03-15', '1110', '1230', 2, 'Test Issue #4707 CLP Migration\r\n- Report QA findings for 1st Cycle Test\r\n- Created Test script for the update', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0107', '2012-03-19', '1110', '1260', 2.3, 'Finished CLP presentation material for training. Helped LE in testing HQ update for Magic but the setup she used is incorrect.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0108', '2012-03-22', '1110', '1275', 2.45, '1. Tested Issue #4758 of Magic\r\n2. Created Test Script\r\n3. Created Read Me', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0109', '2012-03-23', '1050', '1260', 3.3, 'I was able to import the basic profiles for Starsol.', 'Had an urgent modification regarding Magic''s issue regarding updating of GC''s in HQ Agent which hampered me in finishing the importation of Starsol Agent basic profiles.', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0110', '2012-03-26', '1050', '1440', 6.3, '1. Tested Magic HQ Agent (Issue 4578)\r\n2. Created test script\r\n3. Created Read Me\r\n4. Created updater for the issue\r\n5. Released Test #4578 of Magic with Revision to CB and other dept.\r\n6. Finished and released COH User Manuals.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0111', '2012-03-26', '1140', '1260', 2, 'support powerhouse for promotion error', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0112', '2012-03-26', '1110', '1425', 5.15, 'Check processing,printing of reports for BOD meeting', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0113', '2012-03-27', '1110', '1275', 2.45, '1. Revised COH User Manuals.\r\n2. Created Test Script for Issue 4727\r\n3. Released Issue no. 4727- POS Reprinting Report to CB', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0114', '2012-03-28', '1110', '1260', 2.3, 'Fixed QA findings in POS for reservation issue.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0115', '2012-03-28', '1110', '1320', 3.3, '-  Compiled the COH Installer and burned it to CD.\r\n-  Accomplished some parts of the Training Material for PCount', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0116', '2012-03-28', '1110', '1230', 2, 'Accomplished some parts of the training material for PCount/Bootcamp', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0117', '2012-03-28', '1110', '1260', 2.3, 'Finished and emailed correction scripts for Nesabel and Super 8.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0118', '2012-03-29', '1110', '1380', 4.3, 'Sent the Training Material for PCount and Standard Replication Process to EL, CE and BV.\r\nEMAIL:  Training Materials for Bootcamp (PCount and Standard Replication)', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0119', '2012-04-03', '1110', '1410', 5, 'Restored files from D: drive of iRipple server and the respective programs (with HD and ms. JC) accessed by iRipple employees, specifically RIRS, IEMS, SVN and FTP folders.', 'Had a little problem in restoring SVN files and access for committing source codes which I checked after the restoration. The problem was fixed by Ms. JC.', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0120', '2012-04-03', '1110', '1230', 2, 'Created Release Notes for Barter 8.5.4c installer and endorsed to CB', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0121', '2012-04-04', '1110', '1305', 3.15, 'Prepare Training Materials that will be use in Support Technical Boot camp', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0122', '2012-04-04', '1110', '1290', 3, 'Was able to find and fixed one cause of the bug for Promos which happens when a product has no division/department/section/category and is bought by the customer. Added logging since the other scenario was not replicated.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0123', '2012-04-09', '840', '1680', 14, '-Backup database\r\n-Run DB Updater\r\n-Update Server\r\n-Update POS (Muzon and Bagong Silang)\r\n', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0124', '2012-04-10', '540', '1410', 14.3, 'Finished fixing new KLGFS Pre-printed form', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0125', '2012-04-10', '780', '1380', 10, 'boot camp day 2', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0126', '2012-04-11', '780', '1380', 10, 'Finished Day 2 Barter Support Bootcamp Training and RIRS demo', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0127', '2012-04-12', '1110', '1320', 3.3, 'Worked on Starsol Agent importing of products. Worked on OIC feature in ems.', 'Worked on OIC feature in ems in working copy for Ms. Eiz to check the following day.', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0128', '2012-04-13', '', '', 0, '', '', '', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0129', '2012-04-13', '1155', '1350', 3.15, 'Attended IBM and CTC Thanksgiving', 'The event ended up late', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0130', '2012-04-18', '1110', '1420', 5.1, 'Printing of SEC reports', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0131', '2012-04-20', '', '', 0, '', '', '', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0132', '2012-04-23', '1050', '1175', 2.05, 'quotes done', 'All quotes were sent to clients on their expected date of receipt', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0133', '2012-04-23', '', '', 0, '', '', '', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0134', '2012-04-26', '1110', '1230', 2, 'Able to finish New, Open and Delete Order feature of Queue Buster', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0135', '2012-04-26', '1110', '1350', 4, 'Epson Business Review and Awards Night', 'The event was ended late.', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0136', '2012-04-30', '', '', 0, '', '', '', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0137', '2012-05-02', '1110', '1290', 3, '1. Released Issue #4094 of Susana\r\n-Created Test Scrip and Read Me\r\n2. Created Release Notes for Barter 8.4.5d installer and endorsed it to CB.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0138', '2012-05-03', '930', '1110', 3, '-Fix Problem with Price Verifier\r\n-Update Price Verifier with Sir Ben Help', '', 'Cancelled', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0139', '2012-05-03', '1140', '1350', 3.3, '-Fix Unisilver Server Username and Password\r\n-Reinstall new antivirus\r\n', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0140', '2012-05-03', '1140', '1410', 4.3, '-Same procedure as last time\r\n-Update windows with service pack\r\n-reinstall new antivirus', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0141', '2012-05-06', '540', '1080', 9, 'Talked with Ms. Liza during the morning. Went to office in the afternoon to work on polishes and test Starsol Agent with HD.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0142', '2012-05-07', '1050', '1170', 2, 'Month-end closing -Bank Recon regular,Interest for placement 1,2,3 account', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0143', '2012-05-07', '1050', '1230', 3, 'Test and Release Magic: Updates for Issue #4889 - Branch Agent doesnt recognize master_<siterefcode>\r\n\r\n-Created Test Case and Read Me\r\n-Created Updater for the Issue\r\n-Released update to CB', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0144', '2012-05-08', '1050', '1320', 4.3, '1. Prepare the Update for Issue#4834 and Issue#4838 (Updater, Test Case and Release Notes)\r\n2. Released the update for Issue#4834 and Issue#4838 of Citihardware\r\nEmail Reference: [Citihardware] Updates for Issue#4834 and Issue#4838 - Cancelled document in Branch found posted in HO and Error in processing PWS for All Sites', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0145', '2012-05-10', '1110', '1280', 2.5, '1. Tested Issue #486 for 2nd Cycle Test\r\n2. Created test case, read me and updater.\r\n3. Release update to CB.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0146', '2012-05-10', '1110', '1280', 2.5, 'Released the update for LH#486 to client.\r\nEmail Reference: [Citihardware] Updates for LH#486 - A truck icon will still display after posting a transfer out document', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0147', '2012-05-10', '910', '1090', 3, 'Update Price verifier to fix connection problem', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0148', '2012-05-15', '', '', 0, '', '', '', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0149', '2012-05-15', '1110', '1285', 2.55, 'Submitted the modified file for Barterwebmodule to Rajiv to solve their issue regarding adding of customers.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0150', '2012-05-17', '1110', '1320', 3.3, '17Q -PSE Report', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0151', '2012-05-25', '1140', '1435', 4.55, 'Setup unisilver new server', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0152', '2012-05-25', '840', '1740', 15, 'cheers upgrade and monitoring.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0153', '2012-05-25', '1050', '1170', 2, 'check processing', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0154', '2012-05-26', '675', '1165', 8.1, 'Finished revisions for POS and TX requirements for Super 8 RCBC-CLP migration Phase 1. I was able to create an initial version of RCBC Export report in Web.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0155', '2012-05-29', '1110', '1230', 2, 'update revenue report for google docs importing', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0156', '2012-05-30', '1110', '1350', 4, 'Tested Issue #496 of Super for First Cycle Test with replication on the reported other issue regarding to their promo with Ted Laude.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0157', '2012-05-31', '1110', '1350', 4, 'Checked Super 8''s problem regarding group discount with sir HD but was unable to find the exact cause. Fixed some issues raised by QA during testing of S8''s PH1 for RCBC.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0158', '2012-05-31', '1110', '1410', 5, 'Was able to fix the bug regarding Super 8''s group discount promo and was able to fix all revisions for RCBC Phase 1.', 'On Standby while QA is testing the updates.', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0159', '2012-06-01', '1110', '1415', 5.05, '- Tested Issue LH#496 CLP Migration Phase 1 of Super 8\r\n- Created documents for release: Test Case and Read Me.\r\n- Generated updater for the release.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0160', '2012-06-02', '540', '780', 4, 'Month-end Closing - Bank Recon -SP Bank Recon -3P Bank Recon -Regular', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0161', '2012-06-04', '1110', '1410', 5, 'Released the updates for 4154, 4309, 4532, 4549, 4556, 4442, 3587, 4864 and 4888\r\nEmail: [Citihardware] Batch Updates for Issue# 4154, 4309, 4442, 4532, 4549, 4556, 4864, 3587', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0162', '2012-06-05', '1110', '1350', 4, 'Was able to finish the Points Earned Report. Was not able to finish other reports due to other urgent issues of Super 8.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0163', '2012-06-05', '1110', '1230', 2, 'VAT May 2012', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0164', '2012-06-08', '', '', 0, '', '', '', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0165', '2012-06-09', '740', '1220', 8, 'Was able to finish the remaining reports (Points Redeemed Report and Item Claims Report) for CLP, just have to add the configuration for the Customer Analytic tab.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0166', '2012-06-11', '1110', '1260', 2.3, 'Marketing Database ', 'Needed to finish the database summary that will be presented to Sir VJ on the following morning.', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0167', '2012-06-13', '1080', '1290', 3.3, '1. Test Issue #510 for first cycle test with actual exchanging of bug findings with Dev.\r\n(Urgent Issue)', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0168', '2012-06-13', '810', '1110', 5, '1. Tested Issue #510 - Magic : Terminal Sales Report by Supplier for 2nd cycle test.\r\n2. Sent QA findings QA and Dev.\r\n\r\n', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0169', '2012-06-14', '1140', '1260', 2, '1. Evaluated the error encountered in the report with TS who is on field (Ever) 2. \r\nDecided to replicate the issue in Ripple on the following day with TS.\r\n2. Discussed Failed update of Super8 - CLP Migration Phase 1 and replicated the said issue.\r\n3. Analyzed and sent feedback to starsol team the feedback of starsol testing.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0170', '2012-06-14', '960', '1500', 9, 'Updated old POS to new POS. Installed barterPOS to the formatted POS.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0171', '2012-06-14', '1020', '1500', 8, 'Update POS at DDs Supermarket', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0172', '2012-06-14', '1140', '1285', 2.25, 'Have analyzed SCV''s Z-reading problem and provided possible causes and steps to replicate the problem. Checked the logs to be sent to Shoppers for their review of exported products.', 'The log from Starsol included duplicate data. We have to look at the contents and remove them carefully to avoid confusion when checked by the client.', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0173', '2012-06-22', '600', '1170', 9.3, 'Finished PH2-part1 but QA was not able to check it due to difficulty in PH1 checking.', 'Assisted Ms. Jen during her testing of latest POS and other concerns.', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0174', '2012-06-22', '1020', '1440', 7, 'Set up 4 POS at DDs Supermarket', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0175', '2012-06-25', '1080', '1260', 3, 'Test the part of #496 CLP Migration of super 8 from AA. Sent Findings for 1st cycle test', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0176', '2012-06-25', '620', '1325', 11.45, 'Tested #496 - CLP Migration of Super 8 for 5th Cycle Test including AA and TL''s update.\r\n', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0177', '2012-06-27', '1140', '1290', 2.3, 'Finished POS revisions for Phase 2 and added additional requirement to swipe customer card before reward points redemption. Submitted updates to QA.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0178', '2012-07-03', '1110', '1260', 2.3, 'Month end closing - Bank recon and entries', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0179', '2012-07-05', '1050', '1170', 2, 'Check processing', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0180', '2012-07-11', '1110', '1230', 2, 'quotes were sent to client, all bir pos applications were lodged and cheers support was done', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0181', '2012-07-16', '520', '1040', 8.4, 'Telemarketing database, &discussed future plan for the marketing tasks', 'Telemarketing Activities has been started, database was needed to forward to RS for her references. Need to discuss & finish the schedule for it will be reported to the management.', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0182', '2012-07-20', '1110', '1290', 3, 'Market Mapping Summary & Pivot Table for Supermarket (all regions)', 'Finished consolidating Market Mapping to meet the deadline.', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0183', '2012-07-21', '710', '1080', 6.1, 'Was able to use the fingerprint device to register a user fingerprint and test/verify the user''s fingerprint in Barter.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0184', '2012-07-26', '1230', '1530', 5, 'upgrading of Server, POS , W.Station', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0185', '2012-08-02', '1110', '1275', 2.45, 'Month-end closing\r\nentries for adeo\r\nbank recon -reg\r\nother closing entries', 'entries for adeo,bank recon -reg,other closing entries', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0186', '2012-08-06', '1110', '1355', 4.05, 'Month end closing \r\n1.Bank Recon\r\n2. Closing Entries', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0187', '2012-08-10', '550', '1140', 9.5, 'Was able to start the on the report but was unable to finish it due to the details needed in the report.', 'Need more time to include all requirements for the report such as Brand and Salesman advance filter and site filter based on siteId not on siteCode.', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0188', '2012-08-11', '', '', 0, '', '', '', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0189', '2012-08-13', '1110', '1280', 2.5, 'We let the materials  packed in well organized ready for the nextday of the event, Before the team leave.', 'We need to finish packed the materials. ', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0190', '2012-08-13', '1050', '1470', 7, '2nd Day of The Event: delivered the units and materials used at the event to office', 'The Event was finished late and we delivered all the units to office well organized and secure.', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0191', '2012-08-13', '550', '1140', 9.5, 'Was able to start the report but was not able to finish because of database issues like no available data to unit test the report.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0192', '2012-08-15', '1170', '1290', 2, 'Have to finalize and get ready the list of the materials brought to PASI Event.', 'Finalize and completed the materials. ', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0193', '2012-08-20', '780', '1080', 5, 'vat for july 2012\r\ncheck processing', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0194', '2012-08-22', '1080', '1410', 5.3, 'passed the and release the update to the client.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0195', '2012-08-22', '1080', '1290', 3.3, 'Installed Barter workstation and unInstall Barter in-active user.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0196', '2012-08-24', '510', '750', 4, 'Delivered the units at Gen. Luna Secured and organized.', 'Need to assist them on the scheduled time.', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0197', '2012-08-27', '', '', 0, '', '', '', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0198', '2012-08-28', '1140', '1260', 2, 'Stand by support', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0199', '2012-08-28', '630', '1170', 9, 'Test and released the update for Super 8\r\nEmail Reference: [Super 8] Updates for LH#628 and LH#630 - Fix for progress bar in Site Product Import and Exporting of Customer Group Discount in CLP Export Plugin\r\n\r\nTested the updates and created Test Case for Lee Plaza', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0200', '2012-08-31', '1140', '1260', 2, 'Was able to talk with SAP team regarding clarifications for flow regarding Transfers and integration specs.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0201', '2012-09-01', '1050', '1230', 3, 'retrieval of OR,liquidation for Mydin Project to be billed to client ', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0202', '2012-09-01', '600', '1110', 8.3, 'Cash advances entries\r\nretrieval of OR''s,liquidations for Mydin project expenses to be billed to client', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0203', '2012-09-04', '1110', '1260', 2.3, 'applied for all bir pos permit applications, prepared P.O.''s and answered emails of clients', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0204', '2012-09-04', '1140', '1530', 6.3, 'Was able to set up F&B in HP touchscreen at around 1:30am. Sir Ben took over around that time then I already left at around 2am.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0205', '2012-09-07', '1140', '1470', 5.3, ' Was able to do a part of the formal receipt, especially the template since LME has their own required format for their formal receipt.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0206', '2012-09-11', '1140', '1410', 4.3, 'Revised Barter F&B for Max''s demo based on Ms. Jen''s list. Coordinated with Sir Allan of Nueca to update the easy waiter also based on Ms. Jen''s list.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0207', '2012-09-13', '1140', '1680', 9, 'Was able to install the printer and cash drawer for Barter F&B for Max''s demo. Was able to test the basic transaction flow with Ms. Yani and made sure that everything works.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0208', '2012-09-13', '1110', '1240', 2.1, 'Scanning and Collating of Epson and Grandtech Documents for submission, assisted Paramount in Hardware Concerns done', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0209', '2012-09-13', '1140', '1560', 7, 'Created a script to fix/data correct COH duplicate barcodes and regular items in branch which became alternate items.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0210', '2012-09-14', '1050', '1225', 2.55, 'check processing for iripple and billing for RMDC', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0211', '2012-09-20', '1110', '1235', 2.05, 'update revenue report', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0212', '2012-09-20', '1110', '1300', 3.1, 'VAT AUGUST 2012', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0213', '2012-09-24', '1110', '1230', 2, 'Finished installation of barter POS on 13 machines.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0214', '2012-09-25', '510', '1005', 8.15, 'Started revisions for formal receipt printing in C#.NET.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0215', '2012-09-25', '1140', '1435', 4.55, 'Was able to finish the formal receipt printing for LME to be sent the following day.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0216', '2012-09-26', '1140', '1620', 8, 'installed and configured POS, Backend, webservice and CLP for the demo unit.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0217', '2012-09-26', '1140', '1620', 8, 'DONE- Set-up for COH and Standard barter version in demo unit for PNG prospect client presentation', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0218', '2012-09-27', '1140', '1320', 3, 'DONE - COH Issues Replication', 'Total of 3 hours', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0219', '2012-09-28', '1080', '1610', 8.5, 'Set Up demo unit for Agmark', 'Set Up demo unit for Agmark', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0220', '2012-10-01', '1140', '1620', 8, 'Installation and Configuration of Barter, CLP', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0221', '2012-10-02', '1140', '1400', 4.2, 'DONE- POS Set-up for Marketing and Hardware events', 'Total of 4.20 hrs', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0222', '2012-10-02', '1140', '1340', 3.2, 'DONE- COH Issue fixing and meeting with Sir BV', 'Total of 3.20 hrs', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0223', '2012-10-03', '270', '1205', 6, 'Egrees: Returned the units to the iRipple office.', 'The event was finished late and we delivered the units at office.', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0224', '2012-10-04', '1110', '1220', 1.5, 'done deal for all BIR Applications for GABC,collate primer orders and preparation of demo to radc', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0225', '2012-10-04', '1110', '1245', 2.15, 'update revenue report', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0226', '2012-10-06', '630', '990', 6, 'Demo and Set up of AP Link for Lee Plaza', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0227', '2012-10-08', '', '', 0, '', '', '', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0228', '2012-10-09', '655', '1250', 10, 'Tested POS transactions for earning and redemption of points', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0229', '2012-10-09', '1110', '1230', 2, 'bank recon - regular account', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0230', '2012-10-10', '1020', '1320', 5, 'Printed UAT for sign off and Daily Stock Activity Report for Elite', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0231', '2012-10-10', '1110', '1220', 1.5, 'BIR Applications, P.O. preparation, sending of bir processed applications to clients', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0232', '2012-10-11', '1110', '1230', 2, 'Prepared marketing materials for ingress, documents and send eblast invitation.', 'Need to finished the tasks.', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0233', '2012-10-13', '920', '1260', 5.4, 'Card details are already displayed on store level (POS)', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0234', '2012-10-13', '640', '1270', 10.3, 'Test reports and other remaining issues', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0235', '2012-10-16', '540', '1140', 6, '2nd Day of the event: Man the booth until 7:00 pm', 'The event was ended by the scheduled time.', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0236', '2012-10-16', '540', '1380', 13, 'Egress: Delivered Marketing Materials at Ripple Office', 'The event was ended late and we need to delivered the units at office.', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0237', '2012-10-17', '1110', '1225', 1.55, 'done deal for BIR POS Applications, bir sticker preparation and printing', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0238', '2012-10-23', '1110', '1230', 2, 'AP entries for iripple,imaghine,rmdc', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0239', '2012-10-25', '1080', '1320', 4, 'Sent Promo Manager and POS (Simplicity''s version) update to Ian for Simplicity''s promo request.', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0240', '2012-10-25', '600', '1050', 7.3, 'revenue report,closing entries for adeo on foreign transactions', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0241', '2012-10-26', '485', '975', 8.1, 'Finished testing/revision of new Full Tax Invoice (Formal Receipt) Printing.', 'Also sent a revision update for Simplicity''s POS for Coupon promo (selected items).', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0242', '2012-10-29', '', '', 0, '', '', '', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0243', '2012-10-29', '1110', '1295', 3.05, 'done deal on bir pos applications,logging of po''s, si and dr''s to xero, si and dr preparation for deliveries, endorsement of tasks', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0244', '2012-10-31', '570', '1260', 11.3, 'Was able to code review and commit SAP Agent with revisions by sir Jorge. Conducted testing of whole flow for stock transfers with Ms. Eiz.', 'The team remained on standby as required.', 'Denied', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0245', '2012-10-31', '', '', 0, '', '', '', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0246', '2012-10-31', '', '', 0, '', '', '', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0247', '2012-10-31', '', '', 0, '', '', '', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0248', '2012-11-05', '1110', '1230', 2, 'bank recon - metrobank wack-wack dollar account', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0249', '2012-11-06', '', '', 0, '', '', '', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0250', '2012-11-06', '1110', '1220', 1.5, 'accomplished all bir pos applications and quotation preparations', '', 'Denied', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0251', '2012-11-07', '1110', '1260', 2.3, 'entries for reimbursable from employee', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0252', '2012-11-08', '1110', '1260', 2.3, 'trial balance schedule', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0253', '2012-11-09', '1050', '1260', 3.3, 'checking trial balance schedule for audit preparation', '', 'Denied', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0254', '2012-11-13', '1110', '1290', 3, 'VAT October 2012 schedule ,relief and validation ', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0255', '2012-11-13', '1110', '1350', 4, 'finalizing SEC Report 17Q', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0256', '2012-11-17', '', '', 0, '', '', 'Pending', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0257', '2013-01-07', '1200', '2760', 26, 'test', '', 'Approved', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0258', '2013-01-11', '', '', 0, '', '', '', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0259', '2013-01-11', '', '', 0, '', '', '', '');
INSERT INTO `ems_accomplishments` VALUES ('ovt-0260', '2013-01-11', '', '', 0, '', '', '', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_active_user`
-- 

CREATE TABLE `ems_active_user` (
  `ID` int(4) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `emp_num` int(15) NOT NULL,
  `status` smallint(1) NOT NULL,
  PRIMARY KEY  (`ID`),
  KEY `emp_num` (`emp_num`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=56 ;

-- 
-- Dumping data for table `ems_active_user`
-- 

INSERT INTO `ems_active_user` VALUES (4, 1, 1, 2);
INSERT INTO `ems_active_user` VALUES (6, 16, 20060801, 0);
INSERT INTO `ems_active_user` VALUES (7, 24, 20110402, 0);
INSERT INTO `ems_active_user` VALUES (8, 26, 20091204, 0);
INSERT INTO `ems_active_user` VALUES (9, 20, 20080603, 49);
INSERT INTO `ems_active_user` VALUES (10, 27, 20000101, 0);
INSERT INTO `ems_active_user` VALUES (11, 23, 20100301, 0);
INSERT INTO `ems_active_user` VALUES (12, 17, 20100401, 89);
INSERT INTO `ems_active_user` VALUES (13, 22, 20100603, 110);
INSERT INTO `ems_active_user` VALUES (14, 19, 20100602, 6);
INSERT INTO `ems_active_user` VALUES (15, 18, 20100601, 0);
INSERT INTO `ems_active_user` VALUES (16, 28, 20110201, 0);
INSERT INTO `ems_active_user` VALUES (17, 49, 20111001, 0);
INSERT INTO `ems_active_user` VALUES (18, 29, 20080801, 1);
INSERT INTO `ems_active_user` VALUES (19, 41, 20080701, 0);
INSERT INTO `ems_active_user` VALUES (20, 44, 20090802, 8);
INSERT INTO `ems_active_user` VALUES (21, 48, 20110301, 0);
INSERT INTO `ems_active_user` VALUES (22, 47, 20100201, 7);
INSERT INTO `ems_active_user` VALUES (23, 31, 20071002, 0);
INSERT INTO `ems_active_user` VALUES (24, 38, 20070801, 95);
INSERT INTO `ems_active_user` VALUES (25, 33, 20081101, 0);
INSERT INTO `ems_active_user` VALUES (26, 46, 20091201, 0);
INSERT INTO `ems_active_user` VALUES (27, 34, 20000102, 2);
INSERT INTO `ems_active_user` VALUES (28, 39, 20070804, 55);
INSERT INTO `ems_active_user` VALUES (29, 32, 20080604, 0);
INSERT INTO `ems_active_user` VALUES (30, 40, 20080101, 10);
INSERT INTO `ems_active_user` VALUES (31, 50, 20100303, 11);
INSERT INTO `ems_active_user` VALUES (32, 35, 20060901, 0);
INSERT INTO `ems_active_user` VALUES (35, 42, 20090501, 5);
INSERT INTO `ems_active_user` VALUES (36, 51, 20100903, 55);
INSERT INTO `ems_active_user` VALUES (37, 37, 20070705, 6);
INSERT INTO `ems_active_user` VALUES (38, 36, 20070701, 0);
INSERT INTO `ems_active_user` VALUES (39, 52, 20091203, 2);
INSERT INTO `ems_active_user` VALUES (40, 45, 20091002, 6);
INSERT INTO `ems_active_user` VALUES (41, 43, 20090702, 18);
INSERT INTO `ems_active_user` VALUES (42, 55, 20110501, 8);
INSERT INTO `ems_active_user` VALUES (43, 56, 20111201, 5);
INSERT INTO `ems_active_user` VALUES (44, 57, 20120301, 1);
INSERT INTO `ems_active_user` VALUES (45, 58, 20120302, 3);
INSERT INTO `ems_active_user` VALUES (46, 54, 20111101, 1);
INSERT INTO `ems_active_user` VALUES (47, 53, 20110201, 2);
INSERT INTO `ems_active_user` VALUES (48, 59, 5012012, 5);
INSERT INTO `ems_active_user` VALUES (49, 61, 20120601, 6);
INSERT INTO `ems_active_user` VALUES (50, 62, 20120701, 0);
INSERT INTO `ems_active_user` VALUES (51, 0, 0, 0);
INSERT INTO `ems_active_user` VALUES (52, 63, 20120602, 7);
INSERT INTO `ems_active_user` VALUES (53, 64, 20120901, 2);
INSERT INTO `ems_active_user` VALUES (54, 65, 20120801, 0);
INSERT INTO `ems_active_user` VALUES (55, 66, 2147483647, 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_air_ticket`
-- 

CREATE TABLE `ems_air_ticket` (
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `ems_air_ticket`
-- 

INSERT INTO `ems_air_ticket` VALUES ('air-0001', 20110102, '2011-10-31', 'COH', 'Manila', 'Cebu', 'PAL', 'Nov-1-2011 11:10:05 PM', '', 'Meeting', 'ow', '', 'Pending', 0, '');
INSERT INTO `ems_air_ticket` VALUES ('air-0002', 20070804, '2011-11-09', 'Kevin Enterprises', 'Manila<br/>Cagayan de Oro', 'Cagayan de Oro<br/>Manila', 'Air Phil Express', 'Nov-17-2011 7:55am', '', 'Client request of demo meeting on Thursday, Nov 17 2pm.\r\nNeed to arrive in CDO before 12nn. Travel time is about 2 hours. Tentatively, my return flight will be from davao. Waiting for Sir Justin''s approval to meet.', 'ow', '3,596.00', 'Booked', 3, '');
INSERT INTO `ems_air_ticket` VALUES ('air-0003', 20070804, '2011-11-14', 'CDO,DVO,GSC', 'GenSan City<br/>Manila', 'Manila<br/>GenSan City', 'Cebu Pac', 'Nov-21-2011 03:00:00 PM', '', 'Land trip from CDO to DVO. While in DVO, will visit Justin Gaisano and lacoste abreeza. Land trip DVO to Gensan to visit RDHW.', 'ow', '2,983.68', 'Booked', 3, '');
INSERT INTO `ems_air_ticket` VALUES ('air-0004', 20070701, '2011-12-07', 'COH', 'Manila<br/>Cebu', 'Cebu<br/>Manila', 'CEBUPACific', 'Dec-13-2011 07:20:00 AM', 'Dec-14-2011 08:50:00 PM', 'For BIR Presentation', 'rt', '2,926.56', 'Booked', 3, '');
INSERT INTO `ems_air_ticket` VALUES ('air-0005', 20060801, '2011-12-12', 'Prince Warehouse - NRA', 'Manila<br/>Cebu', 'Cebu<br/>Manila', 'Cebu Pacific or PAL', 'Dec-13-2011 7:00:00 AM', 'Dec-15-2011 03:00:00 PM', 'Meeting with Ms.Rhea regarding Prince Warehouse Issues, Courtesy visit to Sir Antonio of ThreeSixty Pharmacy, Issues resolution of ThreeSixty Pharmacy', 'rt', '', 'Denied', 0, '');
INSERT INTO `ems_air_ticket` VALUES ('air-0006', 20070804, '2011-12-28', 'Netopia', 'Iloilo<br/>Manila', 'Manila<br/>Iloilo', 'Any', 'Jan-4-2012 05:00:00 AM', '', 'I was set to be back on Jan 5. Client cannot resched the demo so I need to be back on Jan 4 1st flight.', 'ow', '', 'Reviewed', 2, '');
INSERT INTO `ems_air_ticket` VALUES ('air-0007', 20070701, '2012-02-09', 'iRipple', 'Cebu<br/>Manila', 'Manila<br/>Cebu', 'CEBUPACific/PAL', 'Feb-16-2012 02:46:55 PM', 'Feb-20-2012 02:46:55 PM', 'For iRipple Mission Vision Cascade ', 'rt', 'P3,395.84', 'Booked', 3, 'fracy_0216-20.pdf');
INSERT INTO `ems_air_ticket` VALUES ('air-0008', 20060801, '2012-02-17', 'ThreeSixty Pharmacy', 'Manila<br/>Cebu', 'Cebu<br/>Manila', 'Cebu Pacific or PAL', 'Feb-21-2012 7:00:00 AM', 'Feb-24-2012 3:00:00 PM', 'Deployment of new enhancement for ThreeSixty Pharmacy', 'rt', '', 'Denied', 0, '');
INSERT INTO `ems_air_ticket` VALUES ('air-0009', 20070705, '2012-02-20', 'Kevin Enterprises', 'Manila<br/>Cagayan De Oro', 'Cagayan De Oro<br/>Manila', 'Cebu Pacific', 'Feb-24-2012 01:17:31 PM', 'Feb-26-2012 01:17:31 PM', 'Kick off meeting:\r\nFor CC and IL:\r\nDeparture from Manila to CDO: February 24 (morning)\r\nDeparture from CDO to Manila: February 26 (afternoon)\r\n\r\nFor FN:\r\nDeparture from Cebu to CDO: February 24 (morning)\r\nDeparture from CDO to Manila: February 26 (afternoon)\r\n\r\n', 'rt', 'P9,795.52', 'Booked', 3, 'cc_il.pdf');
INSERT INTO `ems_air_ticket` VALUES ('air-0010', 20070804, '2012-02-28', '360 Pharma', 'Manila<br/>Cebu', 'Cebu<br/>Manila', 'Cebu Pac', 'Mar-5-2012 9AM', 'Mar-7-2012 6PM', 'CStore demo\r\n\r\nJK Flight Details:\r\n\r\nMNL- CEB  Mar-5-2012 9AM\r\nCEB - MNL Mar-6-2012 6PM', 'rt', 'P6,185.76', 'Booked', 3, 'cc_mla-cebu-mla_0305-07.pdf');
INSERT INTO `ems_air_ticket` VALUES ('air-0011', 20070804, '2012-03-01', 'Munsterific/Foodman/Libra Mart', 'Manila<br/>Bacolod', 'Bacolod<br/>Manila', 'Cebu Pac', 'Mar-8-2012 04:55:33 AM', 'Mar-10-2012 08:30:33 PM', 'Manila - Bacolod        Mar-8-2012 04:55:33 AM   (1st flight)\r\nIloilo - Manila             Mar-10-2012 08:30:33 PM\r\n\r\nMunsterific - POC\r\nFoodman - Meeting (Pricing)\r\nLibra Mart - (new prospect)', 'rt', 'P2,677.92', 'Booked', 3, 'cc_mla-ilo-bcd-mla_0308-10.pdf');
INSERT INTO `ems_air_ticket` VALUES ('air-0012', 20070705, '2012-04-03', 'Kevin Enterprises Cagayan De O', 'Manila<br/>Cagayan De Oro', 'Cagayan De Oro<br/>Manila', 'Cebu Pacific', 'Apr-11-2012 ', 'Apr-13-2012', '1. BPA (Business Process sign-off) this is to formally recognize our proposed business process, (I emailed this earlier for your review)\r\n2. Server Setup (this was not done during our last visit)\r\n3. Monitor the encoding of items (if there are any further questions)\r\n4. Site-visit\r\n5. Plotting of final schedule (as per you advise earlier, our target live will be on the month of May)', 'rt', 'P10,691.00', 'Booked', 3, '');
INSERT INTO `ems_air_ticket` VALUES ('air-0013', 20070705, '2012-05-02', 'Kevin Enterprises Cagayan De O', 'Manila<br/>Cagayan De Oro', 'Cagayan De Oro<br/>Manila', 'Cebu Pacific', 'May-6-2012 09:53:25 AM', 'May-11-2012 09:53:25 AM', 'Training of backend and frontend users with TS\r\n\r\nto CDO on May 6 - 8AM or 9AM\r\nto Manila on May 14 - 5PM or 6PM', 'rt', 'P10,918.00', 'Booked', 3, 'ilanante_mla-cdo_0506-112012.doc');
INSERT INTO `ems_air_ticket` VALUES ('air-0014', 20070701, '2012-05-07', 'Prince Blake HO', 'Cebu<br/>Manila', 'Manila<br/>Cebu', 'CEBUPACific/PAL', 'May-10-2012 02:02:08 PM', '', 'CLP Implementation. This is Charge to Prince Blake CLP Implem Services.', 'ow', 'P2098.88', 'Booked', 3, 'MBRDTQ_fn.pdf');
INSERT INTO `ems_air_ticket` VALUES ('air-0015', 20070804, '2012-05-09', 'Bluefields, Iloilo', 'Manila<br/>Iloilo', 'Iloilo<br/>Manila', 'Cebu Pac', 'May-14-2012  4-5am', 'May-16-2012  6-7am', 'Bluefields: \r\nContract Signing & Kick Off\r\nLedi''s Supermart:\r\nSales Visit', 'rt', 'P2,881.76', 'Booked', 3, 'cc_mla-iloilo-mla_0514-17.pdf');
INSERT INTO `ems_air_ticket` VALUES ('air-0016', 20100603, '2012-05-09', 'Prince Blake', 'Manila<br/>Cebu', 'Cebu<br/>Manila', 'cebu pac', 'May-14-2012 06:00:00 AM', '', 'CLP live monitoring', 'ow', 'P1,678.68', 'Booked', 3, 'rb_mla-cebu-mla_0513-15.pdf');
INSERT INTO `ems_air_ticket` VALUES ('air-0017', 20070701, '2012-05-09', 'Blue Fields', 'Manila<br/>Iloilo', 'Iloilo<br/>Manila', 'CEBUPACific/PAL', 'May-15-2012 02:04:28 PM', '', 'Kick Off and Meeting with SSB Roll Out', 'ow', 'P1,993.00', 'Booked', 3, 'fn_mla-iloilo_0515.pdf');
INSERT INTO `ems_air_ticket` VALUES ('air-0018', 20100603, '2012-05-09', 'Prince Blake', 'Cebu<br/>Manila', 'Manila<br/>Cebu', 'cebu pac', 'May-15-2012 09:00:00 PM', '', 'CLP monitoring', 'ow', 'P1,908.68', 'Booked', 3, 'rb_mla-cebu-mla_0513-15.pdf');
INSERT INTO `ems_air_ticket` VALUES ('air-0019', 20070705, '2012-05-16', 'Kevin Enterprises ', 'Manila<br/>Cagayan De Oro', 'Cagayan De Oro<br/>Manila', 'Cebu Pacific', 'May-17-2012 09:39:13 AM', 'May-18-2012 09:39:13 AM', 'setup of POS in new store and 1 day monitoring of transfer of stocks in new store', 'rt', 'P5,502.56', 'Booked', 3, 'T7TJYP-31May2012.pdf');
INSERT INTO `ems_air_ticket` VALUES ('air-0020', 20070701, '2012-05-18', 'Blue Fields', 'Manila<br/>Iloilo', 'Iloilo<br/>Manila', 'CEBUPACific/PAL', 'May-23-2012 02:25:47 PM', '', 'Installation of Unites and Data Encoding Training.\r\n\r\nNote: This is for Rajiv I am requesting on His Behalf. Please have a 7 or 8 am flight for him', 'ow', 'P2,384.48', 'Booked', 3, 'rb_mla-iloilo_0523.pdf');
INSERT INTO `ems_air_ticket` VALUES ('air-0021', 20070701, '2012-05-23', 'Blue Fields', 'Manila<br/>Iloilo', 'Iloilo<br/>Manila', 'CEBUPACific/PAL', 'May-29-2012 03:44:42 PM', '', 'Business Process Presentation', 'ow', 'P1,734.88', 'Booked', 3, 'R6LJSS_fn_mla-iloilo_0529.htm');
INSERT INTO `ems_air_ticket` VALUES ('air-0022', 20070701, '2012-05-28', 'Blue Fields', 'iloilo<br/>Manila', 'Manila<br/>iloilo', 'CEBUPACific/PAL', 'may 31', '', 'Back to Manila ', 'ow', 'P1,734.88', 'Booked', 3, 'R6LJSS-25May2012.pdf');
INSERT INTO `ems_air_ticket` VALUES ('air-0023', 20100301, '2012-05-31', 'Kevin', 'Manila<br/>Cagayan De Oro', 'Cagayan De Oro<br/>Manila', 'Cebu', 'Jun-4-2012 02:21:49 PM', 'Jun-10-2012 02:21:49 PM', 'Set up, Dry Run', 'rt', 'P6, 006.56', 'Booked', 3, 'GFGV3B-31May2012.pdf');
INSERT INTO `ems_air_ticket` VALUES ('air-0024', 20070701, '2012-06-08', 'Kevin', 'Manila<br/>CDO', 'CDO<br/>Manila', 'CEBUPACific/PAL', 'Jun-12-2012 05:10:02 PM', '', 'Go Live and Monitoring', 'ow', 'P2,798.88', 'Booked', 3, 'A32RYL-08Jun2012.pdf');
INSERT INTO `ems_air_ticket` VALUES ('air-0025', 20070701, '2012-06-08', 'Kevin', 'cdo<br/>cebu', 'cebu<br/>cdo', 'CEBUPACific/PAL', 'Jun-13-2012 05:14:56 PM', '', 'live an dmonitoring', 'ow', 'P1,527.68', 'Booked', 3, 'GFGP4B-08Jun2012.pdf');
INSERT INTO `ems_air_ticket` VALUES ('air-0026', 20070705, '2012-06-27', 'Kevin Enterprises', 'Manila<br/>Cagayan De Oro', 'Cagayan De Oro<br/>Manila', 'Cebu Pacific', 'Jul-2-2012 05:45:09 PM', 'Jul-7-2012 05:45:09 PM', 'Administrator training, stabilize backend process, CLP implementation, preparation for Support turnover.', 'rt', 'P5,782.56', 'Booked', 3, 'N61IYF-28Jun2012.pdf');
INSERT INTO `ems_air_ticket` VALUES ('air-0027', 20070804, '2012-07-03', 'MYDIN', 'MANILA<br/>KUALA LUMPUR', 'KUALA LUMPUR<br/>MANILA', 'CEBU PACIFIC', 'Jul-8-2012 8:55 PM', 'Jul-15-2012 1:0 AM', '- MYDIN requirements gathering, verification and initial development\r\n- 2 PAX (with HD)', 'rt', 'P23,353.96', 'Booked', 3, 'PrintItineraryReceipt.aspx.htm');
INSERT INTO `ems_air_ticket` VALUES ('air-0028', 20120601, '2012-07-06', 'Blue fields', 'Manila<br/>Iloilo', 'Iloilo<br/>Manila', 'Cebu Pacific', 'Jul-14-2012 05:15:31 PM', 'Jul-27-2012 05:15:31 PM', 'Barter training', 'rt', 'P3,912.16', 'Booked', 3, 'R5SZ9S-10Jul2012-1.pdf');
INSERT INTO `ems_air_ticket` VALUES ('air-0029', 20080801, '2012-07-09', 'Blue Fields', 'Manila<br/>Iloilo', 'Iloilo<br/>Manila', 'Cebu Pacific', 'Jul-14-2012 10:00:00 AM', 'Jul-27-2012 9:00:00 AM', 'Client Training', 'rt', 'P3,912.16', 'Booked', 3, 'R5SZ9S-10Jul2012-1.pdf');
INSERT INTO `ems_air_ticket` VALUES ('air-0030', 20070701, '2012-07-10', 'Blue Fields', 'Cebu<br/>Iloilo', 'Iloilo<br/>Cebu', 'CEBUPACific/PAL', 'Jul-13-2012 01:32:33 PM', '', 'For Network Testing and Training Set Up\r\n\r\nFor Rajiv', 'ow', 'P1,695.68', 'Booked', 3, 'ZGG5HE-10Jul2012.pdf');
INSERT INTO `ems_air_ticket` VALUES ('air-0031', 20070701, '2012-07-11', 'Blue Fields', 'Cebu<br/>Iloilo', 'Iloilo<br/>Cebu', 'CEBUPACific/PAL', 'Jul-13-2012 02:14:33 PM', 'Jul-16-2012 02:14:33 PM', 'Meeting and Align with Client for the upcoming schedules and resolve park items', 'rt', 'P3,391.36', 'Booked', 3, 'fracy.pdf');
INSERT INTO `ems_air_ticket` VALUES ('air-0032', 20070701, '2012-07-11', 'Blue Fields', 'iloilo<br/>cebu', 'cebu<br/>iloilo', 'CEBUPACific/PAL', 'Jul-16-2012 02:17:12 PM', '', 'Network test and Training Set Up', 'ow', 'P1,695.00', 'Booked', 3, 'rajiv.pdf');
INSERT INTO `ems_air_ticket` VALUES ('air-0033', 20070804, '2012-07-19', 'BKK (Samsonite, Makro)', 'MNL<br/>BKK', 'BKK<br/>MNL', 'Cebu Pacific', 'Jul-23-2012 9:35:17 PM', 'Jul-26-2012 12:40:17 AM', 'Thailand prospect meetings with JK.\r\n\r\nPLS BOOK FOR 2 PAX. (Me and JK)', 'rt', 'P28,656.46', 'Booked', 3, 'cc.pdf');
INSERT INTO `ems_air_ticket` VALUES ('air-0034', 20080603, '2012-08-08', 'RD Hardware', 'Mla<br/>Gensan', 'Gensan<br/>Mla', 'Cebu', 'Aug-13-2012 03:04:01 PM', 'Aug-16-2012 03:04:01 PM', 'Upgrade of their Barter MMS version', 'rt', 'P6,800.16', 'Booked', 3, 'P6HDSS-09Aug2012.pdf');
INSERT INTO `ems_air_ticket` VALUES ('air-0035', 20060801, '2012-09-10', 'COH', 'Manila<br/>Cebu', 'Cebu<br/>Manila', '', 'Sep-17-2012 02:08:14 PM', 'Sep-18-2012 02:08:14 PM', 'Support Turnover Meeting with COH', 'rt', '', 'Booked', 3, 'J4ZNNY_ce.pdf');
INSERT INTO `ems_air_ticket` VALUES ('air-0036', 20080603, '2012-09-10', 'Budget Home Depot', 'Manila<br/>Palawan', 'Palawan<br/>Manila', '', 'Sep-23-2012 02:55:51 PM', 'Sep-28-2012 02:55:51 PM', 'Implementation for new branch.', 'rt', '', 'Confirmed', 1, 'QBFRJD_pj.pdf');
INSERT INTO `ems_air_ticket` VALUES ('air-0037', 20100603, '2012-10-10', 'BLUEFIELDS/ILOILO', 'Cebu<br/>Iloilo', 'Iloilo<br/>Cebu', '', 'Oct-12-2012 7:00:00 PM', 'Oct-22-2012 7:00:00 AM', 'Bluefields Maasin Branch Set-Up and Live Monitoring', 'rt', '', 'Confirmed', 1, '');
INSERT INTO `ems_air_ticket` VALUES ('air-0038', 20080101, '2012-10-11', 'LME', 'MANILA<br/>BANGKOK', 'BANGKOK<br/>MANILA', '', 'Oct-28-2012 10:35:00 PM', 'Nov-18-2012 12:35:25 AM', 'LME Go Live', 'rt', '', 'Pending', 0, '');
INSERT INTO `ems_air_ticket` VALUES ('air-0039', 20070804, '2012-11-07', 'MYDIN', 'MNL<br/>KL', 'KL<br/>MNL', '', 'Nov-20-2012 8:55 PM', 'Dec-8-2012 1:20 AM', 'Implementation', 'rt', '', 'Confirmed', 1, '');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_announcement`
-- 

CREATE TABLE `ems_announcement` (
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

CREATE TABLE `ems_attachments` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `ems_attachments`
-- 

INSERT INTO `ems_attachments` VALUES (1, 20080801, 'attachments/KPI_EUL_2011.xls', 'KPI_EUL_2011.xls', 'Detailed KPI with status for each.', '920.0 kb', 'application/vnd.ms-e');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_benefits`
-- 

CREATE TABLE `ems_benefits` (
  `ben_id` int(10) NOT NULL auto_increment,
  `emp_num` int(15) default NULL,
  `sl_num` float default NULL,
  `vl_num` float default NULL,
  PRIMARY KEY  (`ben_id`),
  KEY `leave_id` (`emp_num`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=95 ;

-- 
-- Dumping data for table `ems_benefits`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `ems_business_units`
-- 

CREATE TABLE `ems_business_units` (
  `b_id` int(4) NOT NULL auto_increment,
  `dept_code` varchar(10) default NULL,
  `b_manager_name` varchar(100) NOT NULL,
  `oic` varchar(10) NOT NULL,
  `report_to` varchar(10) default NULL,
  PRIMARY KEY  (`b_id`),
  KEY `dept_code` (`dept_code`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

-- 
-- Dumping data for table `ems_business_units`
-- 

INSERT INTO `ems_business_units` VALUES (11, 'DEP-0001', 'Christian Dan Enrique', 'None', '20120801');
INSERT INTO `ems_business_units` VALUES (14, 'DEP-0010', 'Julie Keng', 'None', '');
INSERT INTO `ems_business_units` VALUES (15, 'DEP-0002', 'Flordeliza Clarete', 'None', NULL);
INSERT INTO `ems_business_units` VALUES (16, 'DEP-0005', 'Venice Ann Alluso', 'None', '20111101');
INSERT INTO `ems_business_units` VALUES (17, 'DEP-0006', 'Mary Anne Unson', 'None', '20091204');
INSERT INTO `ems_business_units` VALUES (18, 'DEP-0008', 'Arian Cates Chie', 'None', '20120801');
INSERT INTO `ems_business_units` VALUES (19, 'DEP-0009', 'Jenilyn See', 'None', '20091204');
INSERT INTO `ems_business_units` VALUES (20, 'DEP-0004', 'Benito Jr. Viloria', 'None', '20120801');
INSERT INTO `ems_business_units` VALUES (21, 'DEP-0007', 'Victor Javier', '20120801', '20120801');
INSERT INTO `ems_business_units` VALUES (24, 'DEP-0011', 'Loi Rialubin', 'None', 'None');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_demo_requests`
-- 

CREATE TABLE `ems_demo_requests` (
  `drqst_id` varchar(15) NOT NULL,
  KEY `drqst_id` (`drqst_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `ems_demo_requests`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `ems_department`
-- 

CREATE TABLE `ems_department` (
  `dept_code` varchar(10) NOT NULL default '',
  `dept_name` varchar(50) NOT NULL,
  PRIMARY KEY  (`dept_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `ems_department`
-- 

INSERT INTO `ems_department` VALUES ('DEP-0001', 'Support');
INSERT INTO `ems_department` VALUES ('DEP-0002', 'OMD');
INSERT INTO `ems_department` VALUES ('DEP-0004', 'Product');
INSERT INTO `ems_department` VALUES ('DEP-0005', 'Accounting');
INSERT INTO `ems_department` VALUES ('DEP-0006', 'Marketing and Hardware');
INSERT INTO `ems_department` VALUES ('DEP-0007', 'R & D');
INSERT INTO `ems_department` VALUES ('DEP-0008', 'Project');
INSERT INTO `ems_department` VALUES ('DEP-0009', 'Sales');
INSERT INTO `ems_department` VALUES ('DEP-0010', 'Executive');
INSERT INTO `ems_department` VALUES ('DEP-0011', 'Managers');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

-- 
-- Dumping data for table `ems_emergency_contacts`
-- 

INSERT INTO `ems_emergency_contacts` VALUES (1, 20080603, 'Adoracion Julio', 'Mother', '826-1756', '', '');
INSERT INTO `ems_emergency_contacts` VALUES (2, 20060801, 'Evelyn Enrique', 'Mother', '571-7013', '09278236036', '');
INSERT INTO `ems_emergency_contacts` VALUES (5, 20100401, 'Alona A. Suarez', 'Mother', '', '09229672352', '');
INSERT INTO `ems_emergency_contacts` VALUES (7, 20100602, 'Bonifacio Delica', 'Father', '(042) 373-4793', '', '');
INSERT INTO `ems_emergency_contacts` VALUES (8, 20100603, 'Marissa Provido', 'Relative', '850-0522', '', '');
INSERT INTO `ems_emergency_contacts` VALUES (9, 20091204, 'Willard Keng', 'Husband', '', '', '687-4412');
INSERT INTO `ems_emergency_contacts` VALUES (10, 20000101, 'Joanna Javier', 'Wife', '522-6891', '', '');
INSERT INTO `ems_emergency_contacts` VALUES (11, 20110402, 'Arlene Arceo', 'Mother', '942-22-96', '0919-334-82-42', '');
INSERT INTO `ems_emergency_contacts` VALUES (12, 20100301, 'Erlinda P. Sadaya', 'Mother', '', '09055684315', '');
INSERT INTO `ems_emergency_contacts` VALUES (13, 20080801, 'Roselia Legaspi  ', 'Mother', '2954202 ', '09163226024', '');
INSERT INTO `ems_emergency_contacts` VALUES (19, 20070701, 'Belen Arceta', 'Mother', '', '09204772233', '');
INSERT INTO `ems_emergency_contacts` VALUES (20, 20070804, 'Atty. Gualberto V. Cataluña', 'Father', '', '09214657639', '');
INSERT INTO `ems_emergency_contacts` VALUES (21, 20080101, 'Nieves Cruz', 'Mother', '714-9213', '09198600659', '');
INSERT INTO `ems_emergency_contacts` VALUES (22, 20080604, 'Fr. Henry Bocala', 'Adviser', '', '09282387959', '');
INSERT INTO `ems_emergency_contacts` VALUES (23, 20091201, 'Elena See', 'Mother', '253-7855', '', '');
INSERT INTO `ems_emergency_contacts` VALUES (24, 20081101, ' Erlinda Viloria', 'Mother', '', '09279313740', '');
INSERT INTO `ems_emergency_contacts` VALUES (25, 20080701, 'Mario Andalis', 'Father', '', '09198948717', '');
INSERT INTO `ems_emergency_contacts` VALUES (26, 20090802, 'Clarita O. Laude', 'Mother', '', '09395527863', '3890866');
INSERT INTO `ems_emergency_contacts` VALUES (28, 20071002, 'Viena Lyn Pia Alluso', 'Sister', '9831244', '(63)9273864322', '');
INSERT INTO `ems_emergency_contacts` VALUES (29, 20091203, 'Arvie Ocampo', 'Husband', '', '09226329859', '');
INSERT INTO `ems_emergency_contacts` VALUES (30, 20091203, 'Myrna Jacob', 'Mother', '', '', '');
INSERT INTO `ems_emergency_contacts` VALUES (31, 20110201, 'Garry B. Balingit', 'Husband', '651-1256 / 345-5125', '0919-2107979', '8922056');
INSERT INTO `ems_emergency_contacts` VALUES (32, 20100303, 'Maria Cristina Juarez', 'Mother', '', '09158458392', '');
INSERT INTO `ems_emergency_contacts` VALUES (33, 20100903, 'Rosita Estrelles', 'Mother', '4219276', '09089834636', '');
INSERT INTO `ems_emergency_contacts` VALUES (34, 20100201, 'Elizabeth Gerosanib', 'Mother', '', '09339444596', '');
INSERT INTO `ems_emergency_contacts` VALUES (35, 20090501, 'Elizabeth Jaraba', 'Mother', '', '09065293007', '');
INSERT INTO `ems_emergency_contacts` VALUES (36, 20111101, 'Willie Clarete', 'Husband', '', '', '');
INSERT INTO `ems_emergency_contacts` VALUES (37, 20120302, 'Rafael Lepalem', 'Father', '09108736432', '', '');
INSERT INTO `ems_emergency_contacts` VALUES (38, 20120301, 'Teody S. Pastera', 'Husband', '', '+639064963017', '');
INSERT INTO `ems_emergency_contacts` VALUES (39, 20120301, 'Rachel H. Villanueva', 'Cousin', '', '+639228421762', '');
INSERT INTO `ems_emergency_contacts` VALUES (40, 20120301, 'Raquel H. Malunhao', 'Cousin', '', '+639228147498', '');
INSERT INTO `ems_emergency_contacts` VALUES (41, 20100601, 'Cornelio P. Alcantara Jr.', 'Husband', '', '09207678554', '');
INSERT INTO `ems_emergency_contacts` VALUES (43, 20110301, 'Ronnie Saldevia', 'Brother', '532-8770', '09468087447', '');
INSERT INTO `ems_emergency_contacts` VALUES (44, 5012012, 'Ranie Ritchelle C. Gabriel', 'Wife', '', '09334317384', '');
INSERT INTO `ems_emergency_contacts` VALUES (45, 5012012, 'Vicente F. Gabriel', 'Father', '', '09228102315', '');
INSERT INTO `ems_emergency_contacts` VALUES (46, 20120901, 'Abel Santos', 'Father', '6320730', '09228334623', '');
INSERT INTO `ems_emergency_contacts` VALUES (47, 20120901, 'Analiza Santos', 'Mother', '6320730', '09228334624', '');
INSERT INTO `ems_emergency_contacts` VALUES (48, 20120801, 'Jing T. Dee', 'Partner', '912-4529', '0917-5271648', '');

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `ems_employee`
-- 

INSERT INTO `ems_employee` VALUES (1, '0000-00-00', '0000-00-00', '0000-00-00', 'iRipple', 'iEMS Admin', '', 0, NULL, NULL, 0, NULL, 'male', '', '', '  ', '', '', '', '', '', 'mackyboy_09@yahoo.com.ph', '', '1970-01-01', '', '', '', '');
INSERT INTO `ems_employee` VALUES (5012012, '2012-05-02', '0000-00-00', '0000-00-00', 'Gabriel', 'Raymond', 'M', 24, 'DEP-0007', 24, 15, 'EST002', 'male', '540 Caingin St. Sto.Tomas Sta. Maria', '', ' ', 'Bulacan', '3022', '', '09334317364', '', 'rgabriel@iripple.com', 'raymond.m.gabriel@gmail.com', '1985-05-10', '', '', '', '');
INSERT INTO `ems_employee` VALUES (20000101, '2000-01-01', '0000-00-00', '0000-00-00', 'Javier', 'Victor ', 'Tolentino', 0, 'DEP-0010', 30, 33, 'EST003', 'male', 'Unit 723 Midtown Exec,  Homes, 1268 UN Ave.,  Paco', '', 'Manila   ', '', '1007', '522-6891', '', '687-4412', 'vjavier@iripple.com', '', '1974-03-30', '33-4255949-4', '169-336-907', '109003251575', '19-090356734-5');
INSERT INTO `ems_employee` VALUES (20000102, '2000-01-03', '0000-00-00', '0000-00-00', 'Dy', 'Hubert', 'Co', 0, 'DEP-0010', 26, 32, 'EST003', 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1975-09-05', '33-4594526-7  ', '193-430-580  ', '1090-0325-1564  ', '19-050646578-1  ');
INSERT INTO `ems_employee` VALUES (20060801, '2006-08-01', '0000-00-00', '0000-00-00', 'Enrique', 'Christian Dan', 'Soriano', 24, 'DEP-0001', 10, 24, 'EST003', 'male', '#9 Kawilihan St. Caniogan ', '', 'Pasig City ', 'Metro Manila', '1606', '571-7013', '09228264981', '687-4412', '', '', '1984-11-12', '34-0167141-7', '217-087-684-000', '109003376165', '01-050462036-6');
INSERT INTO `ems_employee` VALUES (20060901, '2006-09-27', '0000-00-00', '0000-00-00', 'Habacon  ', 'Juvi Araceli  ', 'De Leon  ', 19, 'DEP-0009', 33, 24, 'EST004', 'female', '', '', ' ', '', '', '', '0922.8264984', '687.4412 loc 305', 'jhabacon@iripple.com', '', '1985-09-02', '34-0248752-9', '303-455-116-000', '1090-0337-8339', '01-025149483-0 ');
INSERT INTO `ems_employee` VALUES (20070701, '2007-07-03', '0000-00-00', '0000-00-00', 'Nagnal', 'Fracy', 'Balcoba', 24, 'DEP-0008', 22, 24, 'EST003', 'female', '26B Sandoval Compound, Dr. Sixto Antonio Avenue., ', 'Rosario', 'Pasig ', '', '', '', '09228264980', '687 4412 loc 304', 'fnagnal@iripple.com', '', '1986-03-24', '07-2342901-0  ', '306-342-442-000  ', '1090-0339-9621  ', '01-050526712-0  ');
INSERT INTO `ems_employee` VALUES (20070705, '2007-07-03', '0000-00-00', '0000-00-00', 'Lanante', 'Iris Dawn', 'Garces', 18, 'DEP-0008', 21, 16, 'EST003', 'female', '', '', ' ', '', '', '', '', '', 'ilanante@iripple.com', '', '1986-11-24', '34-0454414-3  ', '306-342-685-000  ', '109003399610  ', '01-050440152-4   ');
INSERT INTO `ems_employee` VALUES (20070801, '2007-08-01', '0000-00-00', '0000-00-00', 'Chie', 'Arian Cates', 'Marquez', 24, 'DEP-0008', 21, 16, 'EST003', 'female', '', '', ' ', '', '', '', '', '', 'achie@iripple.com', '', '1986-09-25', '34-0564098-1  ', '306-575-452-000  ', '1090-0340-2217  ', '');
INSERT INTO `ems_employee` VALUES (20070804, '2007-08-28', '0000-00-00', '0000-00-00', 'Cataluna', 'Christian Gilbert', 'Brana', 19, 'DEP-0009', 14, 24, 'EST003', 'male', '308 Dansalan St., ', 'Ilaya', 'Mandaluyong  ', '', '1550', '09496101050', '09228264975', '', 'ccataluna@iripple.com', 'cgcataluna@gmail.com', '1982-08-01', '34-0738069-2  ', '942-460-471  ', '1090-0340-2196  ', '01-051131017-8');
INSERT INTO `ems_employee` VALUES (20071002, '2007-10-17', '0000-00-00', '0000-00-00', 'Alluso', 'Venice Ann', 'Dela Cruz  ', 14, 'DEP-0005', 13, 24, 'EST003', 'female', '84 J.P. Ramoy St., Talipapa, ', '', 'Caloocan  ', 'Metro Manila', '1400', '9831244', '(63)9175699028', '687-4412', 'valluso@iripple.com', '', '1981-07-16', '33-8560528-2  ', '228-994-371-000  ', '1090-0340-7078  ', '01-050041101-0  ');
INSERT INTO `ems_employee` VALUES (20080101, '2008-01-07', '0000-00-00', '0000-00-00', 'Cruz', 'Julie Vernes', 'Vergara', 24, 'DEP-0007', 10, 24, 'EST003', 'female', '732 Domingo Santiago St., ', 'Sampaloc', 'Manila ', 'NCR', '', '714-9213', '09228837637', '', 'jcruz@iripple.com', '', '1984-02-05', '33-9019232-4  ', '235-082-413-000  ', '1090-0341-6949  ', '01-050030065-0  ');
INSERT INTO `ems_employee` VALUES (20080603, '2008-06-02', '0000-00-00', '0000-00-00', 'Julio', 'Peejay ', 'Santos', 11, 'DEP-0001', 36, 18, 'EST003', 'male', '750 Tramo St., Manuyo ', '', 'Las Piñas City ', 'Metro Manila', '', '826-1756', '09228264985', '687-4412', 'pjulio@iripple.com', '', '1984-01-22', '33-7973153-1', '304-620-297-000', '109003271692', '08-050783596-5');
INSERT INTO `ems_employee` VALUES (20080604, '2008-06-16', '0000-00-00', '0000-00-00', 'Unson', 'Mary Anne', 'Bocala', 14, 'DEP-0006', 37, 24, 'EST003', 'female', 'Unit 3008, Cityland Condominium ', 'Shaw Blvd.', 'Mandaluyong ', '', '', '', '09228170695', '687-4412 loc 303', 'munson@iripple.com', '', '1982-07-06', '09-2319305-2  ', '929-073-871-000  ', '1090-0327-1713  ', '16-050146063-7  ');
INSERT INTO `ems_employee` VALUES (20080701, '2008-07-01', '0000-00-00', '0000-00-00', 'Andalis', 'Maricon', 'Roquid', 17, 'DEP-0006', 17, 16, 'EST003', 'female', '', '', '   ', '', '', '', '09228170695', '687-44-12 loc. 306', 'mandalis@iripple.com', '', '1986-08-21', '34-0807412-7  ', '263-170-749-000  ', '1090-0328-4323  ', '01-025191120-2  ');
INSERT INTO `ems_employee` VALUES (20080801, '2008-08-04', '0000-00-00', '0000-00-00', 'Legaspi', 'Eizell', 'Unidad  ', 15, 'DEP-0002', 9, 24, 'EST003', 'female', 'B10 L3 Exodus Ville, ', 'Brgy. San Vicente', 'Angono      ', 'Rizal  ', '', '', '09228264979', '687-4412 loc 450', 'elegaspi@iripple.com', '', '1984-08-14', '33-9422801-6  ', '216-697-325-000  ', '1090-0329-6523  ', '03-050164839-2  ');
INSERT INTO `ems_employee` VALUES (20081101, '2008-11-17', '0000-00-00', '0000-00-00', 'Viloria', 'Benito Jr.', 'Dabbay', 24, 'DEP-0004', 34, 24, 'EST003', 'male', '26C Sandoval Compound, Dr. Sixto Antonio Avenue., ', 'Rosario', 'Pasig  ', '', '', '', '09228264977 / 09178085700', '687-4412 loc 389', '', '', '1980-12-24', '33-5076967-4  ', '216-060-032  ', '', '19-089188228-2  ');
INSERT INTO `ems_employee` VALUES (20090501, '2009-05-05', '0000-00-00', '0000-00-00', 'Jaraba', 'Noreen Bianca', 'Abo', 20, 'DEP-0004', 24, 16, 'EST004', 'female', '', '', ' Caloocan ', '', '1428', '', '09333770823', '', 'njaraba@iripple.com', '', '1988-03-17', '34-1569667-9  ', '274-284-538  ', '', '01-050828957-5  ');
INSERT INTO `ems_employee` VALUES (20090702, '2009-07-22', '0000-00-00', '0000-00-00', 'Briones', 'Czarina', 'Baniqued', 20, 'DEP-0004', 25, 16, 'EST003', 'female', '2359 A. Garrido Street, Sta Ana', '', 'Manila ', '', '1009', '', '0917-5503750', '', 'zbriones@iripple.com', 'czarina.briones@yahoo.com', '1987-10-28', '34-1627176-3  ', '307-801-457-000  ', '', '01-050828958-3  ');
INSERT INTO `ems_employee` VALUES (20090802, '2009-08-10', '0000-00-00', '0000-00-00', 'Laude', 'Ted Marty', 'Octavio', 20, 'DEP-0004', 24, 16, 'EST003', 'male', 'Blk 2 Lot 1 Phase 4C Grandvalley Subd.', 'Mahabang Parang', 'Angono ', 'Rizal', '1930', '', '09267149562', '6874412', 'tlaude@iripple.com', 'ted_laude@yahoo.com', '1989-03-08', '34-1661967-1  ', '279-838-267  ', '', '01-051224536-1  ');
INSERT INTO `ems_employee` VALUES (20091002, '2009-10-19', '0000-00-00', '0000-00-00', 'Haban', 'Marichel', 'Ramirez', 20, 'DEP-0004', 5, 15, 'EST004', 'female', '', '', ' ', '', '', '', '', '', 'mhaban@iripple.com', '', '1983-10-30', '34-00691809  ', '250-348-983-000  ', '', '01-050353293-5  ');
INSERT INTO `ems_employee` VALUES (20091201, '2009-12-01', '0000-00-00', '0000-00-00', 'See', 'Jenilyn', 'Chua', 14, 'DEP-0009', 11, 24, 'EST003', 'female', '912 Luzon St.,', 'Sta. Cruz', 'Manila  ', 'Manila', '', '', '09228385733', '687-4412 loc 270', 'jsee@iripple.com', '', '1982-11-15', '33-8959145-7  ', '231-118-158-000  ', '', '02-050053530-0  ');
INSERT INTO `ems_employee` VALUES (20091203, '2009-12-07', '0000-00-00', '0000-00-00', 'Ocampo', 'Mary Jane', 'Jacob', 15, 'DEP-0002', 32, 14, 'EST003', 'female', '#29 Orange st. Odelco Subd. San Bartolome Novaliches Q.C', 'Ph3 Blk 3 Lot 21 Dormitory Pasacola Dulo Nagkaisang Nayon Novaliches Q.C', 'Quezon City ', 'Metro Manila', '1123', '', '09327897151', '6874412', 'mjacob@iripple.com', '', '1985-10-16', '33-8168508-6  ', '245-794-508-000', '1080-0254-0387', '03-050240635-3  ');
INSERT INTO `ems_employee` VALUES (20091204, '2010-12-04', '0000-00-00', '0000-00-00', 'Keng', 'Julie', 'Javier', 0, 'DEP-0010', 29, 32, 'EST003', 'female', '723 Midtown Executive Homes, ', 'Paco ', 'Manila  ', '', '1007', '', '09178383893', '687-4412', 'jkeng@iripple.com', '', '1976-04-12', '33-5357724-5', '181-214-528', '', '');
INSERT INTO `ems_employee` VALUES (20100201, '2010-02-14', '0000-00-00', '0000-00-00', 'Gerosanib', 'Jenelyn', 'Susi', 20, 'DEP-0004', 2, 15, 'EST004', 'female', '1351 Alinian St. Tondo', '', ' Manila  ', 'Metro Manila', '1013', '', '09322165971', '', 'jgerosanib@iripple.com', '', '1989-02-12', '34-1770626-6  ', '282-274-615-000  ', '1210 1359 0145', '01-051131019-4  ');
INSERT INTO `ems_employee` VALUES (20100301, '2010-03-01', '0000-00-00', '0000-00-00', 'Sadaya', 'Hannah Trinah', 'Peñalosa', 18, 'DEP-0008', 21, 20, 'EST003', 'female', '26-B Sandoval Compd. Dr. Sixto Antonio Ave. Rosario', '', 'Pasig City ', 'Metro Manila', '', '', '09228268539', '6874412', 'tsadaya@iripple.com', '', '1985-11-23', '07-2343105-3', '258-886-373-000', '', '02-050375389-9');
INSERT INTO `ems_employee` VALUES (20100303, '2010-03-17', '0000-00-00', '0000-00-00', 'Mateo', 'Chrizchelle', 'Latonero', 17, 'DEP-0006', 15, 14, 'EST004', 'female', 'Blk 8 Lot 6 Lopez Compound', 'Tabon I', 'Las Piñas City ', 'Metro Manila', '1740', '', '09228264976', '6874412', 'cmateo@iripple.com', 'ychelle_purpleness@yahoo.com.ph', '1991-08-30', '34-1428373-7  ', '275-132-170-000', '', '03-0506325-451');
INSERT INTO `ems_employee` VALUES (20100401, '2010-04-05', '0000-00-00', '0000-00-00', 'Suarez', 'Katrina ', 'Aloña', 11, 'DEP-0001', 4, 16, 'EST003', 'female', '1721 Lardizabal Extension, Sampaloc ', '', ' Manila ', 'Metro Manila', '', '', '09228268576', '', 'ksuarez@iripple.com', '', '1989-05-16', '34-1660167-6', '277-253-104-000', '1210-0633-9252', '01-051095494-2');
INSERT INTO `ems_employee` VALUES (20100601, '2010-06-01', '0000-00-00', '0000-00-00', 'Alcantara', 'Sheryl Mie ', 'Velasquez', 11, 'DEP-0001', 4, 16, 'EST003', 'female', '24A Velasquez St., Bagong Ilog, ', '', ' Pasig City ', 'Metro Manila', '', '', '09228160694', '687-4412', 'svelasquez@iripple.com', '', '1983-10-05', '33-9207122-3', '246-571-498', '', '01-050350025-1');
INSERT INTO `ems_employee` VALUES (20100602, '2010-06-07', '0000-00-00', '0000-00-00', 'Delica', 'Ruel', 'De Torres', 11, 'DEP-0001', 4, 16, 'EST003', 'male', 'Dorm 4 Lung Center of the Phil., Quezon Ave.,y', '', ' Quezon City ', 'Metro Manila', '', '', '09228268546', '687-4412', 'rdelica@iripple.com', '', '1981-07-30', '04-1436194-0', '931-553-201', '109002187063', '19-090232587-9');
INSERT INTO `ems_employee` VALUES (20100603, '2010-06-07', '0000-00-00', '0000-00-00', 'Buenafe', 'Rajiv', 'Sotio', 18, 'DEP-0008', 21, 20, 'EST003', 'male', '314-B Panay St., Brgy. Pitogo,', '', 'Makati City   ', 'Metro Manila', '', '', '09228470949', '687-4412', 'rbuenafe@iripple.com', '', '1986-07-21', '07-2491304-6', '286-175-595', '1210-1353-4114', '11-050406050-0');
INSERT INTO `ems_employee` VALUES (20100903, '2010-09-01', '0000-00-00', '0000-00-00', 'Estrelles', 'Leah', 'Bornilla  ', 20, 'DEP-0004', 6, 15, 'EST003', 'female', 'B 3 L 20 ESCOPA 4, PROJ. 4', '', 'QUEZON CITY ', 'METRO MANILA', '1109', '4219276', '09339252136', '', 'lestrelles@iripple.com', 'leah_estrelles@yahoo.com.ph', '1990-01-13', '34-225413-4  ', '297-091-522  ', '', '030507007755');
INSERT INTO `ems_employee` VALUES (20110201, '2011-02-21', '0000-00-00', '0000-00-00', 'Balingit', 'Barbara', 'Sanchez', 19, 'DEP-0009', 18, 14, 'EST003', 'female', '133 Bloomingdale Ave. Bloomingdale Subd. Brgy. San Pedro', '', 'Angono ', 'Rizal', '1930', '651-1256', '0922-8558705', '687-4412', 'bbalingit@iripple.com', '', '1974-10-29', '33-2844955-7', '191-153-310-000', '1210-1351-7239', '19-052-366-866-1');
INSERT INTO `ems_employee` VALUES (20110301, '2011-07-18', '0000-00-00', '0000-00-00', 'Pancho', 'Jona', 'Balasabas', 16, 'DEP-0005', 19, 14, 'EST003', 'female', 'No. 93 Pascual Bldg.,New Zaniga,P. Cruz, Mandaluyong City', 'Octavio Village,Cannery,Polomolok,South Cotabato', ' Mandaluyong City ', 'NCR', '1605', '532-8770', '09212863224', '687-4412', 'jpancho@iripple.com', 'jona_panch09@yahoo.com', '1987-08-26', '09- 3224247-3  ', '297-705-783-000', '1210-1278-4307', '17-050242994-1  ');
INSERT INTO `ems_employee` VALUES (20110402, '2011-04-25', '0000-00-00', '0000-00-00', 'Arceo', 'Arwin', 'Onio', 20, 'DEP-0004', 23, 14, 'EST003', 'male', '48-C Sevilla Homes, Sevill Street Parang Marikina City', '', 'Marikina   ', 'Leyte', '', '942-22-96', '0929-340-5600', '', '', '', '1990-10-05', '34-611516-5', '', '', '');
INSERT INTO `ems_employee` VALUES (20110501, '0000-00-00', '0000-00-00', '0000-00-00', 'Dela Cruz', 'Aldrin', 'Cruz', 24, 'DEP-0007', 24, 0, 'EST003', 'male', '', '', ' ', '', '', '', '', '', 'adelacruz@iripple.com', '', '1990-09-30', '', '', '', '');
INSERT INTO `ems_employee` VALUES (20111001, '2011-10-03', '0000-00-00', '0000-00-00', 'Busio', 'Alberto Nikolas', 'Francis', 21, 'DEP-0007', 24, 20, 'EST004', NULL, 'Blk4 L16B Constantine St., PH4 ', 'Vista Verde Executive Village', 'Cainta  ', 'Rizal', '', '6815159', '09399018947', '', 'abusio@iripple.com', '', '0000-00-00', NULL, NULL, NULL, NULL);
INSERT INTO `ems_employee` VALUES (20111101, '2011-11-15', '0000-00-00', '0000-00-00', 'Clarete', 'Flordeliza', 'Bambilla', 14, 'DEP-0002', 35, 0, 'EST007', 'female', '67-B Doña Aurora St. ', '', ' San Roque Angono ', 'Rizal City', '', '687-4412', '', '', 'fclarete@iripple.com', '', '1975-12-27', '33-3140609-5', '147-957-616', '000-909-915-901', '');
INSERT INTO `ems_employee` VALUES (20111201, '2012-01-02', '0000-00-00', '0000-00-00', 'Bonita', 'Reynaldo Jr', 'Catuira', 24, 'DEP-0007', 24, 0, 'EST002', 'male', '', '', ' ', '', '', '', '', '', 'abonita@iripple.com', '', '2012-01-06', '', '', '', '');
INSERT INTO `ems_employee` VALUES (20120301, '2012-03-01', '0000-00-00', '0000-00-00', 'Pastera', 'Marianne', 'Delasa', 19, 'DEP-0009', 14, 0, 'EST002', 'female', 'B2 L2, Parkdale I, ', 'Anabu I, Imus,', '  ', 'Cavite', '', '', '+639228291296', '', 'mpastera@iripple.com', '', '1976-06-30', '335-039547-5', '900-384-400', '104001863407', '01-050172133-1');
INSERT INTO `ems_employee` VALUES (20120302, '2012-03-01', '0000-00-00', '0000-00-00', 'Lepalem', 'Ashly Razel', 'Dailisan', 17, 'DEP-0006', 15, 14, 'EST002', 'female', '680 A. Bonifacio Ave.Barangay San Juan', '', '   ', 'Cainta Rizal', '', '', '09078552375', '', 'alepalem@iripple.com', 'ardlepalem@gmail.com', '1992-09-14', '34-3097373', '419-822-737', '', '');
INSERT INTO `ems_employee` VALUES (20120601, '2012-06-04', '0000-00-00', '0000-00-00', 'Gonzales', 'Olive Issah', 'Palad', 11, 'DEP-0001', 20, 14, 'EST002', 'female', '416 MRR st. Manggahan', '', 'Pasig ', '', '', '', '0920-6121-995', '', 'ogonzales@iripple.com', 'olive.gonzales17@yahoo.com', '1989-09-15', '34-2219522-8', '296-362-360-000', '', '');
INSERT INTO `ems_employee` VALUES (20120602, '2012-06-04', '0000-00-00', '0000-00-00', 'Macaraig', 'Angelica Mari', 'Arambulo', 24, 'DEP-0007', 2, 14, 'EST002', 'female', '', '', ' ', '', '', '', '', '', 'amacaraig@iripple.com', '', '1992-04-25', '', '', '', '');
INSERT INTO `ems_employee` VALUES (20120701, '2012-07-03', '0000-00-00', '0000-00-00', 'Lozada', 'Cesariel', 'Mandigal', 20, 'DEP-0004', 24, 0, 'EST002', 'male', '', '', ' ', '', '', '', '', '', 'clozada@iripple.com', '', '1986-01-20', '', '', '', '');
INSERT INTO `ems_employee` VALUES (20120801, '0000-00-00', '0000-00-00', '0000-00-00', 'Rialubin', 'Loi', 'Rojas', 23, 'DEP-0000', 0, 0, '', 'female', '#33-D Liberty Avenue', 'Murphy, Cubao', ' Quezon City  ', '', '1109', '912-4529', '0917-8960768', '687-4412 local 304', 'lrialubin@iripple.com', 'loirialubin@yahoo.com', '1968-06-21', '03-9638683-6', '135-893-898', '', '');
INSERT INTO `ems_employee` VALUES (20120901, '2012-09-10', '0000-00-00', '0000-00-00', 'Santos', 'Arvin Allen', 'Cabalza', 18, 'DEP-0008', 38, 14, 'EST002', 'male', '20 Butterfly St.', 'Valle Verde 6', 'Pasig City ', '', '1600', '6320730', '09062677639/ 09228334625', '', 'asantos@iripple.com', 'arvin.santos@uap.asia', '1989-10-08', '34-3412870-4', '425-939-571-000', '1210-5408-7701', '2200-0039-6184');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- 
-- Dumping data for table `ems_emp_dependents`
-- 

INSERT INTO `ems_emp_dependents` VALUES (1, 20091203, 'Martheena Jamell J. Ocampo', 'Daughter', '2011-01-30');
INSERT INTO `ems_emp_dependents` VALUES (2, 20091203, 'Arvie Ocampo', 'Husband', '1983-10-27');
INSERT INTO `ems_emp_dependents` VALUES (3, 20110201, 'Jeremy Cedric S. Balingit', 'Son', '2002-09-11');
INSERT INTO `ems_emp_dependents` VALUES (4, 20110201, 'Jazmin Karylle S. Balingit', 'Daughter', '2003-11-05');
INSERT INTO `ems_emp_dependents` VALUES (5, 20100602, 'Bonifacio Delica', 'Father', '2011-05-14');
INSERT INTO `ems_emp_dependents` VALUES (6, 20120301, 'Ianne Theodore Delasa Pastera', 'Son', '2009-04-22');
INSERT INTO `ems_emp_dependents` VALUES (7, 20120301, 'Teody S. Pastera', 'Husband', '1977-04-22');
INSERT INTO `ems_emp_dependents` VALUES (8, 5012012, 'Ranie Ritchelle C. Gabriel', 'Wife', '1983-06-15');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_emp_status`
-- 

CREATE TABLE `ems_emp_status` (
  `code` varchar(15) NOT NULL,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY  (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `ems_emp_status`
-- 

INSERT INTO `ems_emp_status` VALUES ('EST001', 'Casual');
INSERT INTO `ems_emp_status` VALUES ('EST002', 'Probationary');
INSERT INTO `ems_emp_status` VALUES ('EST003', 'Regular');
INSERT INTO `ems_emp_status` VALUES ('EST004', 'Resigned');
INSERT INTO `ems_emp_status` VALUES ('EST005', 'Terminated');
INSERT INTO `ems_emp_status` VALUES ('EST006', 'Student Trainee');
INSERT INTO `ems_emp_status` VALUES ('EST007', 'Consultant');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_equip_requests`
-- 

CREATE TABLE `ems_equip_requests` (
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `ems_equip_requests`
-- 

INSERT INTO `ems_equip_requests` VALUES ('rsv-0001', 20080101, '2011-10-28', 'MFP Meeting', 'iRipple 25th Training Room', '2011-11-02', '2011-11-02', 1, 'Projector|', 'Approved', '');
INSERT INTO `ems_equip_requests` VALUES ('rsv-0002', 20080801, '2011-11-09', 'Barter Training', 'S-CV', '2011-11-10', '2011-11-11', 2, 'Projector|', 'Approved', '');
INSERT INTO `ems_equip_requests` VALUES ('rsv-0003', 20081101, '2011-11-11', 'Meeting', 'COH', '2011-11-14', '2011-11-23', 10, 'Projector|', 'Approved', '');
INSERT INTO `ems_equip_requests` VALUES ('rsv-0004', 20080801, '2011-11-14', 'Company Orientation', 'iRipple', '2011-11-15', '2011-11-15', 1, 'Projector|', 'Approved', '');
INSERT INTO `ems_equip_requests` VALUES ('rsv-0005', 20100603, '2011-11-15', 'Client MA Support Meeting', 'iripple', '2011-11-15', '2011-11-15', 1, 'Projector|', 'Approved', '');
INSERT INTO `ems_equip_requests` VALUES ('rsv-0006', 20100601, '2011-11-21', 'Checkpoint meeting', 'Ripple', '2011-11-21', '2011-11-21', 1, 'Projector|Others:|Conference Room|', 'Approved', '');
INSERT INTO `ems_equip_requests` VALUES ('rsv-0007', 20060901, '2011-11-21', 'On-site testing', 'COH-Cebu', '2011-11-14', '2011-11-18', 5, 'Projector|', 'Approved', '');
INSERT INTO `ems_equip_requests` VALUES ('rsv-0008', 20100602, '2011-12-08', 'Century Chemincal Corp Meeting', 'Century Chem. Toctocan', '2011-12-08', '2011-12-08', 1, 'Projector|', 'Approved', '');
INSERT INTO `ems_equip_requests` VALUES ('rsv-0009', 20100603, '2011-12-12', 'Checking Old Data', 'Nesabel/Pateros', '2011-12-12', '2011-12-12', 1, 'Laptop|', 'Approved', '');
INSERT INTO `ems_equip_requests` VALUES ('rsv-0010', 20060901, '2011-12-21', 'Google Map Plotting', 'iRipple', '2011-12-21', '2011-12-29', 9, 'Laptop|', 'Approved', '');
INSERT INTO `ems_equip_requests` VALUES ('rsv-0011', 20090501, '2011-12-28', 'BRBQ King discussion', 'BRBQ King', '2011-12-28', '2011-12-28', 1, 'Projector|', 'Approved', '');
INSERT INTO `ems_equip_requests` VALUES ('rsv-0012', 20110201, '2012-01-05', 'sales meeting', 'Sales Dept', '2012-01-06', '2012-01-06', 1, 'Projector|', 'Approved', '');
INSERT INTO `ems_equip_requests` VALUES ('rsv-0013', 20060901, '2012-01-06', 'Google Map Plotting', 'iRipple', '2012-01-06', '2012-01-13', 8, 'Laptop|', 'Approved', '');
INSERT INTO `ems_equip_requests` VALUES ('rsv-0014', 20100301, '2012-02-03', 'GC manager demo', 'Magic', '2012-02-03', '2012-02-03', 1, 'Polycom|', 'Approved', '');
INSERT INTO `ems_equip_requests` VALUES ('rsv-0015', 20060901, '2012-02-03', 'Communication', 'iRipple', '2012-02-03', '2012-02-24', 22, 'Others:|Cellphone|', 'Approved', '');
INSERT INTO `ems_equip_requests` VALUES ('rsv-0016', 20100601, '2012-02-03', 'Meeting', 'Citihardware', '2012-02-03', '2012-02-03', 1, 'Polycom|', 'Approved', '');
INSERT INTO `ems_equip_requests` VALUES ('rsv-0017', 20100601, '2012-03-09', 'Citihardware Meeting', 'Citihardware', '2012-03-09', '2012-03-09', 1, 'Projector|', 'Approved', '');
INSERT INTO `ems_equip_requests` VALUES ('rsv-0018', 20100601, '2012-03-14', 'Citihardware Meeting', 'HO', '2012-03-15', '2012-03-15', 1, 'Projector|Polycom|', 'Approved', '');
INSERT INTO `ems_equip_requests` VALUES ('rsv-0019', 20080801, '2012-03-19', 'Company Orientation', 'iRipple', '2012-03-19', '2012-03-19', 1, 'Projector|', 'Approved', '');
INSERT INTO `ems_equip_requests` VALUES ('rsv-0020', 20080801, '2012-03-22', 'Friday Session', 'iRipple', '2012-03-23', '2012-03-23', 1, 'Projector|', 'Approved', '');
INSERT INTO `ems_equip_requests` VALUES ('rsv-0021', 20120302, '2012-03-27', 'for marketing use (my computer', 'Marketing Department', '2012-03-28', '2012-04-02', 6, 'Laptop|', 'Approved', '');
INSERT INTO `ems_equip_requests` VALUES ('rsv-0022', 20080801, '2012-03-29', 'Barter Support Technical Bootc', 'iRipple, Inc./Antipolo Venue', '2012-03-30', '2012-04-01', 3, 'Projector|', 'Approved', '');
INSERT INTO `ems_equip_requests` VALUES ('rsv-0023', 20100601, '2012-04-12', 'Support Meeting', 'Ripple', '2012-04-12', '2012-04-12', 1, 'Projector|', 'Approved', '');
INSERT INTO `ems_equip_requests` VALUES ('rsv-0024', 20080801, '2012-04-20', 'Meeting', 'Ms. Liza', '2012-04-23', '2012-04-23', 1, 'Projector|', 'Approved', '');
INSERT INTO `ems_equip_requests` VALUES ('rsv-0025', 20100601, '2012-04-24', 'Telecon Meeting in Citihardwar', 'Ripple', '2012-04-25', '2012-04-25', 1, 'Projector|Polycom|', 'Approved', '');
INSERT INTO `ems_equip_requests` VALUES ('rsv-0026', 20071002, '2012-05-04', 'Annual Stockholders Meeting', 'Makati', '2012-05-08', '2012-05-08', 1, 'Projector|', 'Approved', '');
INSERT INTO `ems_equip_requests` VALUES ('rsv-0027', 20070804, '2012-05-17', 'telcon', 'ABM', '2012-05-17', '2012-05-17', 1, 'Polycom|', 'Approved', '');
INSERT INTO `ems_equip_requests` VALUES ('rsv-0028', 20120302, '2012-07-19', 'Used by RS to input Telemarket', 'Marketing', '2012-07-19', '2012-07-27', 9, 'Laptop|', 'Approved', '');
INSERT INTO `ems_equip_requests` VALUES ('rsv-0029', 20090802, '2012-08-15', 'Conference Call with SAP', 'LME Project', '2012-08-15', '2012-08-15', 1, 'Polycom|', 'Approved', '');
INSERT INTO `ems_equip_requests` VALUES ('rsv-0030', 20100601, '2012-08-28', 'Citihardware webcon meeting', 'Citihardware', '2012-08-28', '2012-08-28', 1, 'Projector|Polycom|', 'Denied', '');
INSERT INTO `ems_equip_requests` VALUES ('rsv-0031', 20080801, '2012-08-28', 'Training', 'DDs', '2012-08-29', '2012-09-03', 6, 'Projector|', 'Approved', '');
INSERT INTO `ems_equip_requests` VALUES ('rsv-0032', 20090802, '2012-08-30', 'Conference Call with SAP', 'LME Project', '2012-08-30', '2012-08-30', 1, 'Polycom|', 'Approved', '');
INSERT INTO `ems_equip_requests` VALUES ('rsv-0033', 20110402, '2013-01-07', 'yersytas', '', '2013-01-09', '2013-01-09', 1, 'Epson White|', 'Approved', '');
INSERT INTO `ems_equip_requests` VALUES ('rsv-0034', 20110402, '2013-01-11', 'test', '', '2013-01-15', '2013-01-15', 1, 'Epson White|', 'Denied', '');
INSERT INTO `ems_equip_requests` VALUES ('rsv-0035', 20110402, '2013-01-11', 'test', '', '2013-01-12', '2013-01-12', 1, 'Globe Tattoo|', 'Pending', '');
INSERT INTO `ems_equip_requests` VALUES ('rsv-0036', 20110402, '2013-01-11', 'test', '', '2013-01-14', '2013-01-14', 1, 'Sun Broadband|', 'Pending', '');
INSERT INTO `ems_equip_requests` VALUES ('rsv-0037', 20110402, '2013-01-21', 'test', '', '2013-01-22', '2013-01-22', 1, 'Others:|.|', 'Approved', '');
INSERT INTO `ems_equip_requests` VALUES ('rsv-0038', 20081101, '2013-01-25', 'test', '', '2013-01-26', '2013-01-26', 1, 'Acer K-11|', 'Pending', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_equip_requisitions`
-- 

CREATE TABLE `ems_equip_requisitions` (
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `ems_equip_requisitions`
-- 

INSERT INTO `ems_equip_requisitions` VALUES ('ER2011001', 20100603, '2011-10-10', '2011-10-10', '1|', 'Projector|', 'Prince Rhea - Barter Data Validator Meeting', '', 'Denied', '');
INSERT INTO `ems_equip_requisitions` VALUES ('ER2011002', 20110402, '2011-10-20', '2011-10-24', '1|', 'Mouse|', 'For my work desktop since the old mouse is not working.', '', 'Delivered', '');
INSERT INTO `ems_equip_requisitions` VALUES ('ER2011003', 20071002, '2011-10-28', '2011-11-03', '1|1|1|', 'Macbook Pro 13.3|Apple Care Warranty -- 9,500 VAT inc.|Rechargeable Battery -- 1,300 VAT inc.|', '-For R & D as requested by Sir VJ\r\n-Prefered supplier is Studio 84, Inc.', '', 'Delivered', '');
INSERT INTO `ems_equip_requisitions` VALUES ('ER2011004', 20090702, '2011-11-08', '2011-11-11', '3|', 'Mouse|', 'For 3 Computers under Product Team:\r\n2  Test PCs\r\n1  MHaban''s', '', 'Delivered', '');
INSERT INTO `ems_equip_requisitions` VALUES ('ER2011005', 20080701, '2011-11-10', '2011-11-16', '1|', 'Windows Server 2008 R2 Standard Edition ROK|', 'OS for iRipple Server, request by Sir Hubes and Sir Ben', '', 'Delivered', '');
INSERT INTO `ems_equip_requisitions` VALUES ('ER2011006', 20080101, '2011-11-11', '2011-11-14', '1|', '2-4 GB USB Transcend Brand|', 'For uploading DTR at 25th floor', '', 'Denied', '');
INSERT INTO `ems_equip_requisitions` VALUES ('ER2011007', 20060901, '2011-11-11', '2011-11-14', '1|', 'new epson projector|', 'COH-SAP on-site testing\r\nNov14-26', '', 'Denied', '');
INSERT INTO `ems_equip_requisitions` VALUES ('ER2011008', 20091203, '2011-11-14', '2011-11-25', '1|', 'Transcend|', 'to be use in uploading the DTR of R&D Biometric Machine.', '', 'Delivered', '');
INSERT INTO `ems_equip_requisitions` VALUES ('ER2011009', 20100401, '2011-11-14', '2011-11-14', '1|', 'projector|', 'smteam checkpoint meeting', '', 'Denied', '');
INSERT INTO `ems_equip_requisitions` VALUES ('ER2011010', 20080604, '2011-11-17', '2011-11-18', '1|', 'Laminating Machine |', 'BIR Permit lamination for Primer.  Budget is maximum of 3500 for the machine and laminating film/roll', '', 'Delivered', '');
INSERT INTO `ems_equip_requisitions` VALUES ('ER2011011', 20080801, '2011-11-22', '2011-11-24', '1|', '4G USB Flash Drive|', 'To be used in extracting R&D DTR from iLab Biometrics System. \r\n\r\nNote: The 16GB Flash Drive provided by Marketing (c/o Ms. Meanne) was given to JC in exchange of a 4GB (which is more appropriate to use). This makes the 4GB as company property.', '', 'Delivered', '');
INSERT INTO `ems_equip_requisitions` VALUES ('ER2011012', 20100303, '2011-11-23', '2011-11-24', '2|', 'HP 21 & HP 22|', 'Ink for deskjet 2400', '', 'Delivered', '');
INSERT INTO `ems_equip_requisitions` VALUES ('ER2011013', 20100601, '2011-12-02', '2011-12-02', '1|', 'Projector|', 'Support Meeting', '', 'Denied', '');
INSERT INTO `ems_equip_requisitions` VALUES ('ER2011014', 20100601, '2011-12-21', '2011-12-21', '1|', 'Polycom|', 'Citihardware Telecon', '', 'Denied', '');
INSERT INTO `ems_equip_requisitions` VALUES ('ER2011015', 20070705, '2012-01-05', '2012-01-05', '1|', 'Globe number for Project|', 'As per FN, request for Globe number for the Project Team', '', 'Delivered', '');
INSERT INTO `ems_equip_requisitions` VALUES ('ER2012016', 20080701, '2012-02-16', '2012-02-16', '1|', 'Nokia 2700 Classic|', 'unit in replacement for Sony Ericsson W205 (defective unit)', '', 'Pending', '');
INSERT INTO `ems_equip_requisitions` VALUES ('ER2012017', 20071002, '2012-02-17', '2012-02-29', '1|', 'USB|', 'To store report files needed for reportorial requirements of SSS, Philhealth and Pag-ibig. ', '', 'Delivered', '');
INSERT INTO `ems_equip_requisitions` VALUES ('ER2012018', 20110201, '2012-03-01', '2012-03-01', '3|', '1 (unit) laptop, 1 (unit) desktop computer, 1 extension cord|', 'for Sales Dept. use; for the desktop computer, Sir PJ will recommend the specs needed', '', 'Delivered', '');
INSERT INTO `ems_equip_requisitions` VALUES ('ER2012019', 20070804, '2012-05-17', '2012-05-17', '1|', 'polycom|', 'telcon meeting with ABM regarding rdhw sap interface', '', 'Delivered', '');
INSERT INTO `ems_equip_requisitions` VALUES ('ER2012020', 20070804, '2012-06-04', '2012-06-04', '1|', 'Samsung NP530U4B-S03PH|', 'Sales Laptop for Demo', '', 'Delivered', '');
INSERT INTO `ems_equip_requisitions` VALUES ('ER2012021', 20080603, '2012-06-14', '2012-06-14', '1|', 'projector|', 'meeting for incentive programs', '', 'Delivered', '');
INSERT INTO `ems_equip_requisitions` VALUES ('ER2012022', 20110402, '2012-06-19', '2012-06-19', '1|', 'mouse|', 'More my desktop  my  mouse is not working anymore.', '', 'Delivered', '');
INSERT INTO `ems_equip_requisitions` VALUES ('ER2012023', 20070804, '2012-06-21', '2012-06-22', '1|', 'Samsung Ultra book NP530U3C-A02PH|', 'Sales Unit', '', 'Delivered', '');
INSERT INTO `ems_equip_requisitions` VALUES ('ER2012024', 20090802, '2012-07-09', '2012-07-13', '1|', 'Buffalo External Hard Disk Drive 500GB USB 3.0|', 'This will be used to back-up the source codes since the old backup disk is already defective. MA already quoted this.', '', 'Denied', '');
INSERT INTO `ems_equip_requisitions` VALUES ('ER2012025', 20120602, '2012-08-15', '2012-08-17', '10|', 'Rechargeable Batteries|', 'For Angel and Han''s iMac accessories (mouse and keyboards)', '', 'Pending', '');
INSERT INTO `ems_equip_requisitions` VALUES ('ER2012026', 20110402, '2013-01-07', '2013-01-10', '1|', 'dfgdfg|', 'dsfsdf', '', 'Delivered', '');
INSERT INTO `ems_equip_requisitions` VALUES ('ER2013027', 20110402, '2013-01-11', '2013-01-16', '3|', 'mouse|', 'test', '', 'Denied', '');
INSERT INTO `ems_equip_requisitions` VALUES ('ER2013028', 20110402, '2013-01-11', '2013-01-12', '1|', 'lcd monitor|', 'test', '', 'Pending', '');
INSERT INTO `ems_equip_requisitions` VALUES ('ER2013029', 20110402, '2013-01-11', '2013-01-14', '1|', 'keyboard|', 'test', '', 'Pending', '');

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `ems_geninfo`
-- 


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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

-- 
-- Dumping data for table `ems_joblevel`
-- 

INSERT INTO `ems_joblevel` VALUES (14, '1', 'Staff', '1');
INSERT INTO `ems_joblevel` VALUES (15, '1', 'Staff', '2');
INSERT INTO `ems_joblevel` VALUES (16, '2', 'Staff', '1');
INSERT INTO `ems_joblevel` VALUES (17, '2', 'Staff', '2');
INSERT INTO `ems_joblevel` VALUES (18, '3', 'Staff', '1');
INSERT INTO `ems_joblevel` VALUES (19, '3', 'Staff', '2');
INSERT INTO `ems_joblevel` VALUES (20, '3', 'Supervisor', '1');
INSERT INTO `ems_joblevel` VALUES (21, '3', 'Supervisor', '2');
INSERT INTO `ems_joblevel` VALUES (22, '4', 'Supervisor', '1');
INSERT INTO `ems_joblevel` VALUES (23, '4', 'Supervisor', '2');
INSERT INTO `ems_joblevel` VALUES (24, '5', 'Jr. Management ', '1');
INSERT INTO `ems_joblevel` VALUES (25, '5', 'Jr. Management ', '2');
INSERT INTO `ems_joblevel` VALUES (26, '6', 'Jr. Management', '1');
INSERT INTO `ems_joblevel` VALUES (27, '6', 'Jr. Management', '2');
INSERT INTO `ems_joblevel` VALUES (28, '7', 'Mid- Management', '1');
INSERT INTO `ems_joblevel` VALUES (29, '7', 'Mid- Management', '2');
INSERT INTO `ems_joblevel` VALUES (30, '8', 'Top Management', '1');
INSERT INTO `ems_joblevel` VALUES (31, '8', 'Top Management', '2');
INSERT INTO `ems_joblevel` VALUES (32, '9', 'Executive', '1');
INSERT INTO `ems_joblevel` VALUES (33, '9', 'Executive', '2');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

-- 
-- Dumping data for table `ems_jobtitle`
-- 

INSERT INTO `ems_jobtitle` VALUES (2, 'Jr. Software Engineer', '', '', 0);
INSERT INTO `ems_jobtitle` VALUES (4, 'Software Solutions Analyst', 'Good.', '', 0);
INSERT INTO `ems_jobtitle` VALUES (5, 'Quality Assurance Analyst', '', '', 0);
INSERT INTO `ems_jobtitle` VALUES (6, 'Technical Writer', 'Test Description', 'Sample Comment', 0);
INSERT INTO `ems_jobtitle` VALUES (7, 'Product Manager', 'Sample Manager', 'Sample Manager', 0);
INSERT INTO `ems_jobtitle` VALUES (8, 'Training Assistant', '', '', 0);
INSERT INTO `ems_jobtitle` VALUES (9, 'Training Manager', '', '', 0);
INSERT INTO `ems_jobtitle` VALUES (10, 'Software Solutions Manager', '', '', 0);
INSERT INTO `ems_jobtitle` VALUES (11, 'Sales Manager', '', '', 0);
INSERT INTO `ems_jobtitle` VALUES (13, 'Finance Manager', '', '', 0);
INSERT INTO `ems_jobtitle` VALUES (14, 'Account Manager', '', '', 0);
INSERT INTO `ems_jobtitle` VALUES (15, 'Marketing/ Hardware Associate', '', '', 0);
INSERT INTO `ems_jobtitle` VALUES (16, 'Jr. Marketing/Hardware Specialist', '', '', 0);
INSERT INTO `ems_jobtitle` VALUES (17, 'Sr. Marketing/Hardware Specialist', '', '', 0);
INSERT INTO `ems_jobtitle` VALUES (18, 'Sales Admin', '', '', 0);
INSERT INTO `ems_jobtitle` VALUES (19, 'Accounting Staff', '', '', 0);
INSERT INTO `ems_jobtitle` VALUES (20, 'Software Solutions Associate', '', '', 0);
INSERT INTO `ems_jobtitle` VALUES (21, 'Sr. Project Consultant', '', '', 0);
INSERT INTO `ems_jobtitle` VALUES (22, 'Implementation Manager', '', '', 0);
INSERT INTO `ems_jobtitle` VALUES (23, 'Programmer', '', '', 0);
INSERT INTO `ems_jobtitle` VALUES (24, 'Sr. Software Engineer', '', '', 0);
INSERT INTO `ems_jobtitle` VALUES (25, 'Software Development Supervisor', '', '', 0);
INSERT INTO `ems_jobtitle` VALUES (26, 'Chief Technology Officer', '', '', 0);
INSERT INTO `ems_jobtitle` VALUES (27, 'QA Specialist', '', '', 0);
INSERT INTO `ems_jobtitle` VALUES (29, 'Chief Operating Officer', '', '', 0);
INSERT INTO `ems_jobtitle` VALUES (30, 'CEO/ President', '', '', 0);
INSERT INTO `ems_jobtitle` VALUES (31, 'HR and Admin Manager', '', '', 0);
INSERT INTO `ems_jobtitle` VALUES (32, 'Administrative Assistant', '', '', 0);
INSERT INTO `ems_jobtitle` VALUES (33, 'Business Development Manager', '', '', 0);
INSERT INTO `ems_jobtitle` VALUES (34, 'Software Development Manager', '', '', 0);
INSERT INTO `ems_jobtitle` VALUES (35, 'OMD Manager', '', '', 0);
INSERT INTO `ems_jobtitle` VALUES (36, 'Software Solutions Supervisor', '', '', 0);
INSERT INTO `ems_jobtitle` VALUES (37, 'Marketing Manager', '', '', 0);
INSERT INTO `ems_jobtitle` VALUES (38, 'Jr. Project Consultant', '', '', 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_leave`
-- 

CREATE TABLE `ems_leave` (
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `ems_leave`
-- 

INSERT INTO `ems_leave` VALUES ('lve-0001', 20100602, '2011-10-10', '2011-10-28', '2011-10-28', 1, 'AM PM ', 'Vacation Leave', 1, 'Out of Town - need to manage important documents', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0002', 20100602, '2011-10-10', '2011-11-11', '2011-11-11', 1, 'AM PM ', 'Vacation Leave', 1, 'Out of town - Family gathering', '', 'Cancelled');
INSERT INTO `ems_leave` VALUES ('lve-0003', 20100602, '2011-10-17', '2011-11-07', '2011-11-09', 3, 'AM PM ', 'Vacation Leave', 1, 'Out of Town - Family Gathering', '', 'Cancelled');
INSERT INTO `ems_leave` VALUES ('lve-0004', 20100602, '2011-10-17', '2011-11-07', '2011-11-11', 5, 'AM PM ', 'Vacation Leave', 1, 'Family Gathering', '', 'Cancelled');
INSERT INTO `ems_leave` VALUES ('lve-0005', 20100603, '2011-10-18', '2011-10-17', '2011-10-17', 1, 'AM PM ', 'Sick Leave', 2, 'Not feeling well due of migraine. ', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0006', 20110402, '2011-10-20', '2011-10-20', '2011-10-20', 0.5, 'AM  ', 'Sick Leave', 2, 'sudden head ache.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0007', 20100301, '2011-10-24', '2011-10-21', '2011-10-21', 1, '  ', 'Sick Leave', 2, 'migraine', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0008', 20100602, '2011-10-24', '2011-11-09', '2011-11-11', 3, 'AM PM ', 'Vacation Leave', 1, 'Family gathering', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0009', 20100201, '2011-10-28', '2011-10-28', '2011-10-28', 0.5, ' PM ', 'Sick Leave', 2, 'Not feeling well. Dysmenorrhea.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0010', 20080604, '2011-10-28', '2011-10-25', '2011-10-25', 1, 'AM PM ', 'Sick Leave', 2, 'Not feeling well.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0011', 20100903, '2011-11-02', '2011-10-28', '2011-10-28', 1, 'AM PM ', 'Sick Leave', 2, 'I had sore eyes.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0012', 20110301, '2011-11-02', '2011-11-09', '2011-11-14', 3.5, 'AM PM ', 'Vacation Leave', 1, 'Going home for vacation', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0013', 20090802, '2011-11-02', '2011-11-02', '2011-11-02', 0.5, 'AM  ', 'Sick Leave', 2, 'Headache/ not feeling well.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0014', 20070804, '2011-11-02', '2011-11-02', '2011-11-02', 0.5, 'AM  ', 'Sick Leave', 2, 'Sick', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0015', 20091203, '2011-11-02', '2011-11-02', '2011-11-02', 0.5, 'AM  ', 'Emergency Leave', 2, 'Due to heavy rain and not feeling well because of flu.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0016', 20100401, '2011-11-02', '2011-11-02', '2011-11-02', 0.5, 'AM  ', 'Sick Leave', 2, 'fever, cough and colds', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0017', 20080604, '2011-11-02', '2011-12-22', '2012-01-03', 7, '  ', 'Vacation Leave', 1, 'Christmas break', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0018', 20070804, '2011-11-02', '2011-11-10', '2011-11-10', 1, 'AM PM ', 'Vacation Leave', 1, 'Vacation', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0019', 20100303, '2011-11-02', '2011-10-26', '2011-10-26', 1, 'AM PM ', 'Sick Leave', 2, 'headache & back pain.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0020', 20100303, '2011-11-02', '2011-11-14', '2011-11-18', 5, 'AM PM ', 'Vacation Leave', 1, 'National Youth Day Camp. (as part of the celebration for Year of the Youths, local version of the World Youth Day.)', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0021', 20091002, '2011-11-03', '2011-12-28', '2011-12-29', 2, 'AM PM ', 'Vacation Leave', 1, 'Going home [Ilocos]', '', 'Denied');
INSERT INTO `ems_leave` VALUES ('lve-0022', 20091002, '2011-11-03', '2011-12-28', '2011-12-29', 2, 'AM PM ', 'Vacation Leave', 1, 'GOing home to ilocos', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0023', 20091002, '2011-11-03', '2012-01-31', '2012-01-31', 1, 'AM PM ', 'Vacation Leave', 1, 'test lang po. please deny this VL sir ben', '', 'Denied');
INSERT INTO `ems_leave` VALUES ('lve-0024', 20071002, '2011-11-08', '2011-12-28', '2011-12-29', 2, 'AM PM ', 'Vacation Leave', 1, 'Attend friend''s wedding in Bulacan. I will be part of the entourage.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0025', 20091203, '2011-11-08', '2011-11-04', '2011-11-04', 1, 'AM PM ', 'Emergency Leave', 2, 'Not Feeling well.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0026', 20090702, '2011-11-09', '2011-12-23', '2011-12-26', 2, 'AM PM ', 'Vacation Leave', 1, 'Christmas vacation with family in Vietnam', '', 'Cancelled');
INSERT INTO `ems_leave` VALUES ('lve-0027', 20110402, '2011-11-10', '2011-11-10', '2011-11-10', 0.5, ' PM ', 'Emergency Leave', 2, 'I Need to go home early because no one will wait for the package delivery from my nephew in our house.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0028', 20070705, '2011-11-10', '2011-11-10', '2011-11-10', 0.5, 'AM  ', 'Sick Leave', 2, 'Got home from Dagupan yesterday at 2AM.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0029', 20090702, '2011-11-11', '2011-11-22', '2011-11-22', 1, 'AM PM ', 'Vacation Leave', 1, 'Will attend a friend''s wedding.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0030', 20060801, '2011-11-11', '2012-10-01', '2012-10-04', 4, ' PM ', 'Vacation Leave', 1, 'Vacation in Cebu City', '', 'Cancelled');
INSERT INTO `ems_leave` VALUES ('lve-0031', 20091002, '2011-11-11', '2011-11-11', '2011-11-11', 1, 'AM PM ', 'Emergency Leave', 2, 'Not able to come to work due to the schedule of our flight back to manila', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0032', 20100603, '2011-11-14', '2011-11-11', '2011-11-11', 1, 'AM PM ', 'Sick Leave', 2, 'Headache, Fever and Flu', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0033', 20100201, '2011-11-17', '2011-11-16', '2011-11-16', 1, '  ', 'Sick Leave', 2, 'Not feeling well.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0034', 20100903, '2011-11-17', '2011-11-17', '2011-11-17', 1, ' PM ', 'Emergency Leave', 2, 'Family matters', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0035', 20091203, '2011-11-17', '2011-11-16', '2011-11-16', 1, 'AM PM ', 'Emergency Leave', 2, 'Accompanied my baby to doctor due to fever and flu', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0036', 20080701, '2011-11-18', '2011-11-18', '2011-11-18', 1, 'AM  ', 'Sick Leave', 2, 'body ache', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0037', 20080701, '2011-11-18', '2011-12-22', '2012-01-03', 13, '  ', 'Vacation Leave', 1, 'Christmas Vacation, please exclude holidays and weekend.thanks', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0038', 20110201, '2011-11-18', '2011-11-23', '2011-11-23', 1, '  ', 'Vacation Leave', 1, 'attend to personal matters', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0039', 20100601, '2011-11-21', '2011-11-23', '2011-11-23', 1, '  ', 'Vacation Leave', 1, 'Personal Reason', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0040', 20070705, '2011-11-23', '2011-11-24', '2011-11-25', 2, '  ', 'Emergency Leave', 2, 'Birthday', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0041', 20080604, '2011-11-23', '2011-11-23', '2011-11-23', 1, 'AM  ', 'Sick Leave', 2, 'Had a Doctor''s appointment for skin rashes.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0042', 20070804, '2011-11-23', '2011-11-22', '2011-11-22', 0.5, 'AM  ', 'Sick Leave', 2, 'sick', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0043', 20090702, '2011-11-24', '2011-12-21', '2011-12-26', 6, 'AM PM ', 'Vacation Leave', 1, 'Christmas vacation with family in Vietnam', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0044', 20091002, '2011-11-26', '2012-01-02', '2012-01-02', 1, 'AM PM ', 'Vacation Leave', 1, 'Back to manila from ilocos. Not able to go back in Jan 1 due to lack of buses route to manila.', '', 'Denied');
INSERT INTO `ems_leave` VALUES ('lve-0045', 20110402, '2011-11-29', '2011-11-28', '2011-11-28', 1, 'AM  ', 'Sick Leave', 2, 'Head ache from runny nose and cough', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0046', 20100301, '2011-11-29', '2011-11-28', '2011-11-28', 1, '  ', 'Sick Leave', 2, 'rheumatism', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0047', 20110402, '2011-12-01', '2011-12-08', '2011-12-08', 1, 'AM PM ', 'Vacation Leave', 1, 'First year death anniversary of my father', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0048', 20110402, '2011-12-01', '2011-12-08', '2011-12-08', 1, 'AM PM ', 'Vacation Leave', 1, 'First year death anniversary of my father', '', 'Cancelled');
INSERT INTO `ems_leave` VALUES ('lve-0049', 20091002, '2011-12-01', '2011-12-01', '2011-12-01', 1, 'AM PM ', 'Emergency Leave', 2, 'Personal Matter', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0050', 20100603, '2011-12-01', '2011-11-28', '2011-11-28', 1, 'AM PM ', 'Sick Leave', 2, 'Head ace and body pain ', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0051', 20100603, '2011-12-01', '2011-11-29', '2011-11-29', 0.5, 'AM  ', 'Sick Leave', 2, 'not feeling well due of migraine.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0052', 20100303, '2011-12-01', '2011-12-02', '2011-12-02', 1, ' PM ', 'Emergency Leave', 2, 'personal matter.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0053', 20110301, '2011-12-01', '2011-12-02', '2011-12-05', 2, '  ', 'Emergency Leave', 2, 'Wedding of my sister', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0054', 20070701, '2011-12-02', '2011-12-05', '2011-12-05', 1, 'AM PM ', 'Vacation Leave', 1, 'Need to assist my aunt with er stuff from Germany to iloilo flight. Will leave some of her baggage to me', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0055', 20100201, '2011-12-05', '2011-12-05', '2011-12-05', 0.5, 'AM  ', 'Sick Leave', 2, 'Not feeling well.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0056', 20070705, '2011-12-06', '2012-03-12', '2012-03-16', 5, '  ', 'Vacation Leave', 1, 'Trip with a balikbayan', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0057', 20070801, '2011-12-06', '2011-12-06', '2011-12-06', 0.5, 'AM  ', 'Sick Leave', 2, 'Headache', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0058', 20060901, '2011-12-07', '2011-12-06', '2011-12-06', 1, '  ', 'Sick Leave', 2, 'Sick', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0059', 20100603, '2011-12-07', '2011-12-05', '2011-12-05', 1, 'AM PM ', 'Sick Leave', 2, 'not feeling well due of migraine.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0060', 20100603, '2011-12-07', '2011-12-29', '2011-12-29', 1, 'AM PM ', 'Vacation Leave', 1, 'Going back home to celebrate new year with my family', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0061', 20100603, '2011-12-07', '2012-01-02', '2012-01-02', 1, 'AM PM ', 'Vacation Leave', 1, 'Going back home to celebrate new year with my family', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0062', 20100301, '2011-12-07', '2011-12-05', '2011-12-05', 0.5, 'AM  ', 'Emergency Leave', 2, 'personal matters', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0063', 20091201, '2011-12-07', '2011-12-07', '2011-12-07', 1, 'AM  ', 'Sick Leave', 2, 'Need to go to Healthway for checkup and Tetanus shot.  Got cut on the jeep. ', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0064', 20080701, '2011-12-07', '2011-12-07', '2011-12-07', 1, 'AM  ', 'Sick Leave', 2, 'not feeling well.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0065', 20100303, '2011-12-08', '2011-12-02', '2011-12-02', 1, ' PM ', 'Emergency Leave', 2, 'anniversary celebration of our youth organization. Emergency leave due to late advise.', '', 'Cancelled');
INSERT INTO `ems_leave` VALUES ('lve-0066', 20100303, '2011-12-08', '2011-12-06', '2011-12-06', 1, 'AM PM ', 'Sick Leave', 2, 'back pain and dysmenorrhea.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0067', 20100303, '2011-12-08', '2011-12-08', '2011-12-08', 1, 'AM  ', 'Emergency Leave', 2, 'family emergency.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0068', 20070705, '2011-12-09', '2011-12-08', '2011-12-08', 0.5, 'AM  ', 'Emergency Leave', 2, 'Back Ache', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0069', 20100601, '2011-12-09', '2011-12-13', '2011-12-13', 1, ' PM ', 'Vacation Leave', 1, 'Getting Marriage License', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0070', 20080101, '2011-12-11', '2011-12-14', '2011-12-14', 1, '  ', 'Vacation Leave', 1, 'attend of family wedding', '', 'Cancelled');
INSERT INTO `ems_leave` VALUES ('lve-0071', 20060901, '2011-12-11', '2011-12-20', '2011-12-20', 1, '  ', 'Vacation Leave', 1, 'wedding event', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0072', 20110201, '2011-12-12', '2011-12-01', '2011-12-05', 3, ' PM ', 'Emergency Leave', 2, 'December 01, 02 and 05, 2011 - funeral wake of my mother-in-law', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0073', 20100602, '2011-12-12', '2011-12-05', '2011-12-05', 1, 'AM PM ', 'Sick Leave', 2, 'Not Feeling well', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0074', 20060901, '2011-12-12', '2011-12-12', '2011-12-12', 0.5, 'AM  ', 'Emergency Leave', 2, 'personal-VL', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0075', 20110402, '2011-12-12', '2011-12-26', '2011-12-26', 1, '  ', 'Vacation Leave', 1, 'Vication w/ my family and special someone :))', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0076', 20110402, '2011-12-12', '2011-12-26', '2011-12-26', 1, '  ', 'Vacation Leave', 1, 'Vication w/ my family and special someone :))', '', 'Cancelled');
INSERT INTO `ems_leave` VALUES ('lve-0077', 20110402, '2011-12-12', '2011-12-26', '2011-12-26', 1, '  ', 'Vacation Leave', 1, 'Vication w/ my family and special someone :))', '', 'Cancelled');
INSERT INTO `ems_leave` VALUES ('lve-0078', 20080603, '2011-12-12', '2011-12-07', '2011-12-07', 1, 'AM  ', 'Sick Leave', 2, 'Not feeling well.', '', 'Cancelled');
INSERT INTO `ems_leave` VALUES ('lve-0079', 20080603, '2011-12-12', '2011-12-07', '2011-12-07', 0.5, 'AM  ', 'Sick Leave', 2, 'Not feeling well.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0080', 20080603, '2011-12-12', '2011-12-07', '2011-12-07', 0.5, 'AM  ', 'Sick Leave', 2, 'Not feeling well.', '', 'Cancelled');
INSERT INTO `ems_leave` VALUES ('lve-0081', 20100602, '2011-12-12', '2011-12-22', '2011-12-22', 1, 'AM PM ', 'Vacation Leave', 1, 'need to pickup my brother in the airport from Dasmarinas cavite', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0082', 20100903, '2011-12-13', '2011-12-12', '2011-12-12', 1, 'AM PM ', 'Sick Leave', 2, 'Not feeling well. I had dysmenorrhea.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0083', 20100401, '2011-12-13', '2011-12-09', '2011-12-09', 0.5, 'AM  ', 'Sick Leave', 2, 'Headache', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0084', 20070705, '2011-12-13', '2011-12-13', '2011-12-13', 0.5, 'AM  ', 'Emergency Leave', 2, 'Had to run an important errand', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0085', 20100201, '2011-12-14', '2011-12-26', '2011-12-26', 1, '  ', 'Vacation Leave', 1, 'Personal reason.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0086', 20091203, '2011-12-14', '2011-12-26', '2011-12-29', 4, 'AM PM ', 'Vacation Leave', 1, 'We will be having vacation in Nueva Ecija', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0087', 20060901, '2011-12-15', '2011-12-14', '2011-12-14', 1, '  ', 'Emergency Leave', 2, 'VL', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0088', 20091203, '2011-12-15', '2011-11-29', '2011-11-29', 1, 'AM PM ', 'Sick Leave', 2, 'Sick Leave due to Cough and Flu.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0089', 20091201, '2011-12-19', '2011-12-20', '2011-12-20', 1, '  ', 'Sick Leave', 2, 'Apply for driver''s license with CC and MU.', '', 'Cancelled');
INSERT INTO `ems_leave` VALUES ('lve-0090', 20090702, '2011-12-20', '2011-12-20', '2011-12-20', 1, ' PM ', 'Emergency Leave', 2, 'Need to prepare for Vietnam trip with family.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0091', 20091201, '2011-12-20', '2011-12-21', '2011-12-21', 1, '  ', 'Sick Leave', 2, 'Apply for driver''s license with CC and MU.', '', 'Denied');
INSERT INTO `ems_leave` VALUES ('lve-0092', 20090501, '2011-12-20', '2011-12-26', '2011-12-26', 1, '  ', 'Vacation Leave', 1, 'Post-Christmas VacationLeave', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0093', 20080604, '2011-12-20', '2011-12-21', '2011-12-21', 1, 'AM PM ', 'Emergency Leave', 2, 'Secure driver''s license', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0094', 20071002, '2011-12-20', '2011-12-22', '2011-12-22', 1, 'AM PM ', 'Vacation Leave', 1, 'Annual Physical Exam', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0095', 20110201, '2011-12-21', '2011-12-19', '2011-12-21', 3, '  ', 'Emergency Leave', 2, 'take my father to the hospital and attend to his hospital needs/requirements', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0096', 20100401, '2011-12-21', '2011-12-21', '2011-12-21', 0.5, 'AM  ', 'Sick Leave', 2, 'Not feeling well', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0097', 20100603, '2011-12-22', '2011-12-21', '2011-12-21', 0.5, 'AM  ', 'Sick Leave', 2, 'stomach ache and LBM', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0098', 20091203, '2011-12-22', '2011-12-19', '2011-12-21', 3, 'AM PM ', 'Sick Leave', 2, 'Due to irritated eyes/Sore eyes', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0099', 20070804, '2011-12-22', '2011-12-21', '2011-12-21', 1, '  ', 'Emergency Leave', 2, 'Processed Driver''s License ', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0100', 20100601, '2011-12-22', '2011-12-19', '2011-12-19', 1, '  ', 'Sick Leave', 2, 'Abdominal pain', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0101', 20100601, '2011-12-22', '2011-12-20', '2011-12-20', 1, ' PM ', 'Emergency Leave', 2, 'Personal Matter (CANA)', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0102', 20091002, '2011-12-23', '2011-12-23', '2011-12-23', 1, 'AM  ', 'Emergency Leave', 2, 'Personal Matter', '', 'Cancelled');
INSERT INTO `ems_leave` VALUES ('lve-0103', 20100601, '2011-12-26', '2011-12-28', '2011-12-28', 1, ' PM ', 'Vacation Leave', 1, 'Personal Matter', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0104', 20091002, '2011-12-26', '2011-12-26', '2011-12-26', 0.5, ' PM ', 'Sick Leave', 2, 'Not feeling well..fever, headache and back pain', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0105', 20091002, '2011-12-26', '2011-12-23', '2011-12-23', 0.5, 'AM  ', 'Emergency Leave', 2, 'Personal Matter', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0106', 20110402, '2011-12-27', '2011-12-27', '2011-12-27', 0.5, 'AM  ', 'Sick Leave', 2, 'head ache due to cough and sneeze..\r\n', '', 'Cancelled');
INSERT INTO `ems_leave` VALUES ('lve-0107', 20110402, '2011-12-27', '2011-12-27', '2011-12-27', 0.5, 'AM  ', 'Sick Leave', 2, 'head ache due to cough and sneeze..\r\n', '', 'Cancelled');
INSERT INTO `ems_leave` VALUES ('lve-0108', 20110402, '2011-12-27', '2011-12-27', '2011-12-27', 0.5, 'AM  ', 'Sick Leave', 2, 'head ache due to cough and sneeze..\r\n', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0109', 20080801, '2011-12-27', '2011-12-29', '2011-12-29', 1, '  ', 'Vacation Leave', 1, 'Personal holiday leave to rest and prepare for new year.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0110', 20070804, '2011-12-28', '2011-12-29', '2011-12-29', 1, '  ', 'Emergency Leave', 2, 'VL', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0111', 20070705, '2011-12-29', '2011-12-26', '2011-12-26', 1, '  ', 'Emergency Leave', 2, 'Family Gathering', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0112', 20060901, '2011-12-29', '2011-12-29', '2011-12-29', 1, '  ', 'Emergency Leave', 2, 'my sister''s operation on gall stones', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0113', 20070804, '2012-01-01', '2012-01-03', '2012-01-03', 1, '  ', 'Vacation Leave', 1, 'VL', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0114', 20110301, '2012-01-02', '2012-01-27', '2012-01-30', 2, '  ', 'Vacation Leave', 1, 'Going to Cebu to attend wedding of my cousin', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0115', 20091203, '2012-01-02', '2012-01-02', '2012-01-02', 0.5, 'AM  ', 'Emergency Leave', 2, 'Taking care of my baby due to high fever.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0116', 20091203, '2012-01-02', '2012-01-30', '2012-01-30', 1, 'AM PM ', 'Vacation Leave', 1, '1st Birthday of my daugther.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0117', 20090702, '2012-01-02', '2012-01-02', '2012-01-02', 1, 'AM PM ', 'Sick Leave', 2, 'Stomach ache and LBM', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0118', 20100201, '2012-01-03', '2011-12-29', '2011-12-29', 1, '  ', 'Sick Leave', 2, 'Not feeling well.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0119', 20100201, '2012-01-03', '2012-01-02', '2012-01-02', 1, '  ', 'Emergency Leave', 2, 'needed to assist and take care of my mother because she''s sick.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0120', 20060801, '2012-01-03', '2012-01-02', '2012-01-02', 1, '  ', 'Sick Leave', 2, 'Due to back pain', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0121', 20100301, '2012-01-03', '2012-01-02', '2012-01-02', 1, '  ', 'Sick Leave', 2, 'dysmenorrhea', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0122', 20110402, '2012-01-04', '2012-01-04', '2012-01-04', 0.5, 'AM  ', 'Sick Leave', 2, 'loose bowel movement', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0123', 20090702, '2012-01-05', '2012-01-04', '2012-01-04', 1, 'AM PM ', 'Sick Leave', 2, 'Stomach ache', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0124', 20080701, '2012-01-05', '2012-01-04', '2012-01-04', 1, '  ', 'Emergency Leave', 2, 'Not feeling well', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0125', 20100201, '2012-01-05', '2012-01-11', '2012-01-11', 0.5, ' PM ', 'Vacation Leave', 1, 'Personal.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0126', 20070705, '2012-01-05', '2012-01-02', '2012-01-02', 1, '  ', 'Emergency Leave', 2, 'Family Gathering', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0127', 20070804, '2012-01-05', '2012-01-05', '2012-01-05', 0.5, ' PM ', 'Emergency Leave', 2, 'Personal', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0128', 20100603, '2012-01-05', '2012-01-04', '2012-01-04', 1, 'AM PM ', 'Sick Leave', 2, 'not feeling well due of migraine.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0129', 20100601, '2012-01-06', '2012-01-11', '2012-01-13', 3, '  ', 'Vacation Leave', 1, 'Wedding Preparation', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0130', 20100601, '2012-01-06', '2012-01-16', '2012-01-17', 2, '  ', 'Vacation Leave', 1, 'Lipat-Bahay', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0131', 20070801, '2012-01-06', '2012-01-05', '2012-01-05', 0.5, 'AM  ', 'Sick Leave', 2, 'Dizziness', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0132', 20110402, '2012-01-06', '2012-01-05', '2012-01-05', 0.5, ' PM ', 'Emergency Leave', 2, 'Family -personal problem', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0133', 20060901, '2012-01-06', '2012-01-04', '2012-01-05', 2, '  ', 'Sick Leave', 2, 'not feeling well', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0134', 20060901, '2012-01-06', '2012-01-13', '2012-01-13', 1, '  ', 'Vacation Leave', 1, 'Church Choir in Roxas, Oriental Mindoro', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0135', 20100401, '2012-01-07', '2012-01-05', '2012-01-05', 1, '  ', 'Sick Leave', 2, 'Chest pain', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0136', 20100303, '2012-01-09', '2012-01-04', '2012-01-05', 2, 'AM PM ', 'Sick Leave', 2, 'dysmenorrhea ', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0137', 20090702, '2012-01-09', '2012-01-09', '2012-01-10', 2, 'AM PM ', 'Sick Leave', 2, 'Due to fever and tonsillitis', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0138', 20110201, '2012-01-11', '2012-01-09', '2012-01-10', 2, '  ', 'Emergency Leave', 2, 'attend to my father''s hospital needs/requirements', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0139', 20080603, '2012-01-11', '2012-01-10', '2012-01-10', 1, '  ', 'Sick Leave', 2, 'not feeling well. head ache.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0140', 20070701, '2012-01-11', '2012-01-18', '2012-01-20', 3, 'AM PM ', 'Vacation Leave', 1, 'Attend burial of my uncle in ILOILO', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0141', 20090702, '2012-01-12', '2012-01-12', '2012-01-13', 2, 'AM PM ', 'Sick Leave', 2, 'Due to upper respiratory track infection, dehydration and acute gastroentiritis', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0142', 20090702, '2012-01-12', '2012-01-12', '2012-01-13', 2, 'AM PM ', 'Sick Leave', 2, 'Due to upper respiratory track infection, dehydration and acute gastroentiritis', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0143', 20060901, '2012-01-12', '2012-01-11', '2012-01-11', 1, '  ', 'Sick Leave', 2, 'not feeling well', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0144', 20110201, '2012-01-13', '2012-01-12', '2012-01-13', 1.5, '  ', 'Emergency Leave', 2, 'my father was discharged to the hospital (01/12/2012) and accompany to The Medical City for heart check up (01/13/2012 - am)', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0145', 20090702, '2012-01-16', '2012-01-16', '2012-01-16', 1, 'AM PM ', 'Sick Leave', 2, 'Stomach ache and checkup with doctor', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0146', 20060901, '2012-01-16', '2012-01-16', '2012-01-16', 1, '  ', 'Emergency Leave', 2, 'family', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0147', 20060901, '2012-01-17', '2012-01-17', '2012-01-17', 0.5, 'AM  ', 'Emergency Leave', 2, 'half day: from the hospital', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0148', 20100201, '2012-01-18', '2012-01-18', '2012-01-18', 0.5, 'AM  ', 'Sick Leave', 2, 'Headache.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0149', 20090702, '2012-01-19', '2012-01-17', '2012-01-18', 2, 'AM PM ', 'Sick Leave', 2, 'Scheduled Gastroscopy in Makati Med - January 17, 2012\r\nStomach ache and needs to rest - January 18, 2012', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0150', 20070705, '2012-01-24', '2012-01-20', '2012-01-20', 1, '  ', 'Emergency Leave', 2, 'had to run an important errand', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0151', 20090702, '2012-01-25', '2012-01-25', '2012-01-25', 0.5, ' PM ', 'Emergency Leave', 2, 'Accompany my father in the airport', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0152', 20090501, '2012-01-27', '2012-02-01', '2012-02-01', 1, '  ', 'Vacation Leave', 1, 'Personal matter', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0153', 20080701, '2012-01-27', '2012-01-25', '2012-01-25', 1, '  ', 'Sick Leave', 2, 'fever', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0154', 20090802, '2012-01-26', '2012-02-01', '2012-02-01', 0.5, 'AM  ', 'Vacation Leave', 1, 'Personal matters.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0155', 20100201, '2012-01-30', '2012-02-03', '2012-02-03', 1, '  ', 'Vacation Leave', 1, 'Family affair', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0156', 20110201, '2012-01-31', '2012-01-24', '2012-01-27', 4, '  ', 'Emergency Leave', 2, 'schedule of my father''s prostate operation / attend to hospital needs and requirements', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0157', 20100201, '2012-02-02', '2012-02-02', '2012-02-02', 0.5, 'AM  ', 'Sick Leave', 2, 'Not felling well.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0158', 20100401, '2012-02-03', '2012-01-26', '2012-02-01', 5, '  ', 'Emergency Leave', 2, 'Lola''s wake.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0159', 20100903, '2012-02-07', '2012-02-07', '2012-02-07', 1, 'AM  ', 'Sick Leave', 2, 'I had a migraine. :(', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0160', 20090501, '2012-02-07', '2012-02-09', '2012-02-09', 0.5, ' PM ', 'Vacation Leave', 1, 'Personal matter.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0161', 20100602, '2012-02-07', '2012-02-07', '2012-02-07', 1, 'AM  ', 'Sick Leave', 2, 'halfday Headache....', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0162', 20100201, '2012-02-09', '2012-02-13', '2012-02-13', 1, 'AM PM ', 'Vacation Leave', 1, 'Family Affair', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0163', 20071002, '2012-02-10', '2012-02-09', '2012-02-09', 1, 'AM PM ', 'Sick Leave', 2, 'Bad stomach', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0164', 20080701, '2012-02-10', '2012-02-10', '2012-02-10', 1, '  ', 'Sick Leave', 2, 'headache', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0165', 20090501, '2012-02-13', '2012-02-16', '2012-02-16', 1, 'AM PM ', 'Vacation Leave', 1, 'Personal Matter', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0166', 20110402, '2012-02-14', '2012-02-13', '2012-02-13', 1, 'AM PM ', 'Sick Leave', 2, 'Cough that causes to headache and flu', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0167', 20100201, '2012-02-17', '2012-02-16', '2012-02-16', 1, 'AM PM ', 'Sick Leave', 2, 'Not feeling well.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0168', 20110301, '2012-02-17', '2012-02-16', '2012-02-16', 1, 'AM PM ', 'Sick Leave', 2, 'I''m not feeling well', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0169', 20080603, '2012-02-20', '2012-02-22', '2012-02-22', 1, '  ', 'Vacation Leave', 1, 'need to assist in pabasa.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0170', 20110201, '2012-02-21', '2012-02-24', '2012-02-24', 1, '  ', 'Vacation Leave', 1, 'attend to my daughter''s First Communion', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0171', 20111201, '2012-02-22', '2012-04-17', '2012-04-20', 3, 'AM PM ', 'Vacation Leave', 1, 'Attending a personal development seminar', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0172', 20111201, '2012-02-22', '2012-04-23', '2012-04-27', 4, 'AM PM ', 'Vacation Leave', 1, 'Attending a personal development seminar', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0173', 20111201, '2012-02-22', '2012-05-01', '2012-05-04', 3, 'AM PM ', 'Vacation Leave', 1, 'Attending a personal development seminar', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0174', 20111201, '2012-02-22', '2012-05-07', '2012-05-08', 2, 'AM PM ', 'Vacation Leave', 1, 'Attending a personal development seminar which lasts for 21 days. ', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0175', 20070705, '2012-02-23', '2012-02-23', '2012-02-23', 0.5, '  ', 'Sick Leave', 2, '[Morning] Headache', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0176', 20090501, '2012-02-24', '2012-02-23', '2012-02-23', 1, 'AM PM ', 'Sick Leave', 2, 'Was sick with fever, colds and sore throat.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0177', 20100903, '2012-02-24', '2012-03-30', '2012-03-30', 1, 'AM PM ', 'Vacation Leave', 1, 'Will have a Vacation in Ilocos :)', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0178', 20110402, '2012-02-24', '2012-02-24', '2012-02-24', 1, 'AM  ', 'Sick Leave', 2, 'LBM', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0179', 20100201, '2012-02-28', '2012-02-28', '2012-02-28', 0.5, 'AM  ', 'Sick Leave', 2, 'Stomachache.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0180', 20080701, '2012-02-29', '2012-02-28', '2012-02-28', 1, '  ', 'Sick Leave', 2, 'fever and allergy', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0181', 20100201, '2012-02-29', '2012-03-05', '2012-03-05', 0.5, ' PM ', 'Vacation Leave', 1, 'Get ATM card at Metrobank UN.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0182', 20090802, '2012-03-05', '2012-03-08', '2012-03-08', 0.5, ' PM ', 'Vacation Leave', 1, 'Have to fetch something for my sister/ Rest.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0183', 20080603, '2012-03-05', '2012-03-26', '2012-03-27', 2, ' PM ', 'Vacation Leave', 1, 'spending time with the family.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0184', 20100603, '2012-03-05', '2012-03-09', '2012-03-09', 1, 'AM PM ', 'Vacation Leave', 1, 'Personal Matter', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0185', 20100603, '2012-03-05', '2012-03-12', '2012-03-12', 0.5, 'AM  ', 'Vacation Leave', 1, 'Personal matter', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0186', 20100301, '2012-03-06', '2012-03-05', '2012-03-05', 0.5, 'AM  ', 'Sick Leave', 2, 'migraine', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0187', 20100602, '2012-03-07', '2012-03-01', '2012-03-01', 0.5, 'AM  ', 'Sick Leave', 2, 'Not feeling well due to Headache', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0188', 20120301, '2012-03-08', '2012-03-07', '2012-03-07', 0.5, 'AM  ', 'Emergency Leave', 2, 'due to heavy traffic along Aguinaldo Hi-way, Cavite. ', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0189', 20071002, '2012-03-08', '2012-03-21', '2012-03-21', 1, 'AM PM ', 'Vacation Leave', 1, 'Personal Errand', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0190', 20080801, '2012-03-13', '2012-03-13', '2012-03-13', 0.5, 'AM  ', 'Sick Leave', 2, 'Dizziness due to menstruation.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0191', 20091201, '2012-03-14', '2012-03-15', '2012-03-15', 0.5, 'AM  ', 'Emergency Leave', 2, 'Need to process some personal documents', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0192', 20100903, '2012-03-15', '2012-03-28', '2012-03-28', 0.5, ' PM ', 'Vacation Leave', 1, 'Will have a vacation in Ilocos', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0193', 20070701, '2012-03-19', '2012-03-29', '2012-03-29', 1, 'AM PM ', 'Vacation Leave', 1, 'Attend Graduation of My Alma Matter in High School -I was invited as guest speaker', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0194', 20071002, '2012-03-19', '2012-03-30', '2012-03-30', 1, 'AM PM ', 'Vacation Leave', 1, 'Personal Errand', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0195', 20080801, '2012-03-19', '2012-03-21', '2012-03-21', 1, '  ', 'Vacation Leave', 1, 'Personal Vacation', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0196', 20081101, '2012-03-19', '2012-03-21', '2012-03-21', 1, '  ', 'Vacation Leave', 1, 'Personal Vacation', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0197', 20091203, '2012-03-20', '2012-03-20', '2012-03-20', 0.5, ' PM ', 'Emergency Leave', 2, 'Need to go my baby to pediatrician due high fever and flu our schedule is 3pm @ Bernardino Hospital.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0198', 20100201, '2012-03-20', '2012-03-26', '2012-03-26', 1, 'AM PM ', 'Vacation Leave', 1, 'Personal', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0199', 20100201, '2012-03-22', '2012-03-21', '2012-03-21', 1, 'AM PM ', 'Sick Leave', 2, 'Stomachache and Diarrhea.\r\n', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0200', 20070804, '2012-03-23', '2012-04-02', '2012-04-04', 3, 'AM PM ', 'Vacation Leave', 1, 'VL', '', 'Cancelled');
INSERT INTO `ems_leave` VALUES ('lve-0201', 20091201, '2012-03-26', '2012-03-30', '2012-03-30', 1, '  ', 'Vacation Leave', 1, 'Will attend the funeral of my uncle.', '', 'Cancelled');
INSERT INTO `ems_leave` VALUES ('lve-0202', 20100903, '2012-03-26', '2012-03-26', '2012-03-26', 0.5, 'AM  ', 'Emergency Leave', 2, 'Family matters.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0203', 20100401, '2012-03-28', '2012-03-28', '2012-03-28', 0.5, 'AM  ', 'Sick Leave', 2, 'Headache and fever', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0204', 20110201, '2012-03-28', '2012-04-03', '2012-04-03', 1, '  ', 'Vacation Leave', 1, 'attend my son''s Recognition Day :)', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0205', 20100201, '2012-03-29', '2012-04-03', '2012-04-03', 1, 'AM PM ', 'Vacation Leave', 1, 'Will process the request for the TOR.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0206', 20100301, '2012-04-03', '2012-04-02', '2012-04-02', 1, '  ', 'Sick Leave', 2, 'migraine', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0207', 20100301, '2012-04-03', '2012-04-03', '2012-04-03', 1, 'AM  ', 'Sick Leave', 2, 'migraine and body pains', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0208', 20070801, '2012-04-03', '2012-04-04', '2012-04-04', 1, '  ', 'Vacation Leave', 1, 'for holy week', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0209', 20100602, '2012-04-09', '2012-04-10', '2012-04-10', 1, 'AM PM ', 'Emergency Leave', 2, 'My Aunt''s Funeral ', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0210', 20110402, '2012-04-09', '2012-04-16', '2012-04-16', 1, '  ', 'Vacation Leave', 1, 'family gathering', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0211', 20100201, '2012-04-10', '2012-04-11', '2012-04-11', 0.5, ' PM ', 'Emergency Leave', 2, 'Personal.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0212', 20100603, '2012-04-10', '2012-04-11', '2012-04-11', 1, 'AM PM ', 'Emergency Leave', 2, 'Extended Holy Week vacation in Iloilo due to return ticket problem to manila', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0213', 20100603, '2012-04-10', '2012-04-12', '2012-04-12', 1, 'AM PM ', 'Vacation Leave', 1, 'Extended Holy week vacation in Iloilo', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0214', 20110501, '2012-04-11', '2012-04-11', '2012-04-11', 1, ' PM ', 'Emergency Leave', 2, 'Mother''s sick and needs to be attended to', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0215', 20090802, '2012-04-11', '2012-04-13', '2012-04-13', 0.5, ' PM ', 'Vacation Leave', 1, 'Need to pay insurance before due date.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0216', 20100201, '2012-04-13', '2012-04-18', '2012-04-18', 1, 'AM PM ', 'Vacation Leave', 1, 'Process lost IDs.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0217', 20080801, '2012-04-16', '2012-04-16', '2012-04-16', 0.5, 'AM  ', 'Sick Leave', 2, 'Body pain', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0218', 20091203, '2012-04-17', '2012-04-27', '2012-04-27', 1, 'AM PM ', 'Vacation Leave', 1, 'Family and Relatives outing @ Bulacan', '', 'Cancelled');
INSERT INTO `ems_leave` VALUES ('lve-0219', 20080801, '2012-04-17', '2012-04-04', '2012-04-04', 0.5, 'AM  ', 'Sick Leave', 2, 'Late. Arrived at 10:04 AM.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0220', 0, '2012-04-17', '2012-04-17', '2012-04-17', 0.5, 'AM  ', 'Sick Leave', 2, 'Headache', '', 'Pending');
INSERT INTO `ems_leave` VALUES ('lve-0221', 20070801, '2012-04-17', '2012-04-17', '2012-04-17', 0.5, 'AM  ', 'Sick Leave', 2, 'Headache', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0222', 20080603, '2012-04-18', '2012-05-02', '2012-05-02', 1, '  ', 'Vacation Leave', 1, 'Need to facilitate the Annual Summer Training camp in Baguio', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0223', 20100602, '2012-04-18', '2012-04-18', '2012-04-18', 0.5, 'AM  ', 'Sick Leave', 2, 'No feeling well... Headache... ', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0224', 20080801, '2012-04-20', '2012-04-19', '2012-04-19', 0.5, 'AM  ', 'Sick Leave', 2, 'Late due to wall clock that stopped working. Arrived 10:05.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0225', 20110402, '2012-04-20', '2012-04-20', '2012-04-20', 0.5, 'AM  ', 'Sick Leave', 2, 'Due to LBM', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0226', 20100603, '2012-04-20', '2012-04-17', '2012-04-17', 1, 'AM PM ', 'Sick Leave', 2, 'due of Diarrhea', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0227', 20091203, '2012-04-23', '2012-04-18', '2012-04-18', 1, 'AM PM ', 'Sick Leave', 2, 'due to dizziness and lbm', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0228', 20091203, '2012-04-23', '2012-04-25', '2012-04-25', 1, 'AM PM ', 'Vacation Leave', 1, 're schedule of our family outing @ Bulacan', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0229', 20070804, '2012-04-23', '2012-04-02', '2012-04-03', 1.5, '  ', 'Vacation Leave', 1, 'Considered as VL', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0230', 20070801, '2012-04-24', '2012-04-23', '2012-04-23', 1, '  ', 'Sick Leave', 2, 'Not feeling well', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0231', 20100401, '2012-04-24', '2012-04-11', '2012-04-11', 1, '  ', 'Sick Leave', 2, 'Fever', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0232', 20110301, '2012-04-24', '2012-06-11', '2012-06-13', 2.5, 'AM  ', 'Vacation Leave', 1, 'Going to Gensan to attend friend''s wedding', '', 'Cancelled');
INSERT INTO `ems_leave` VALUES ('lve-0233', 20080101, '2012-04-25', '2012-04-27', '2012-04-27', 1, '  ', 'Vacation Leave', 1, 'Personal Matters', '', 'Cancelled');
INSERT INTO `ems_leave` VALUES ('lve-0234', 20100201, '2012-04-26', '2012-04-24', '2012-04-24', 1, '  ', 'Sick Leave', 2, 'Not feeling well. ', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0235', 20110402, '2012-04-26', '2012-04-26', '2012-04-26', 0.5, '  ', 'Emergency Leave', 2, 'Very personal matter', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0236', 20091203, '2012-04-30', '2012-04-27', '2012-04-27', 1, 'AM PM ', 'Emergency Leave', 2, 'Extended Vacation with my husband relatives', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0237', 20070804, '2012-04-30', '2012-04-30', '2012-04-30', 0.5, 'AM  ', 'Sick Leave', 2, 'Sick', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0238', 20110201, '2012-04-30', '2012-05-04', '2012-05-04', 1, '  ', 'Vacation Leave', 1, 'attend to personal matter', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0239', 20080101, '2012-05-02', '2012-05-04', '2012-05-04', 1, '  ', 'Vacation Leave', 1, 'family gathering', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0240', 20100401, '2012-05-02', '2012-05-02', '2012-05-02', 0.5, 'AM  ', 'Sick Leave', 2, 'headache', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0241', 20070701, '2012-05-04', '2012-05-04', '2012-05-04', 0.5, 'AM  ', 'Sick Leave', 2, 'Hyperacidity', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0242', 20080801, '2012-05-06', '2012-04-25', '2012-04-25', 0.5, 'AM  ', 'Emergency Leave', 2, 'My father''s birthday. Had to attend to them.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0243', 20080801, '2012-05-06', '2012-05-03', '2012-05-03', 1, '  ', 'Sick Leave', 2, 'Vertigo', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0244', 20080701, '2012-05-07', '2012-05-07', '2012-05-07', 1, 'AM  ', 'Sick Leave', 2, 'not feeling well due to dysmenorrhea', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0245', 20110402, '2012-05-08', '2012-05-10', '2012-05-10', 1, '  ', 'Vacation Leave', 1, 'Family vacation', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0246', 20090802, '2012-05-08', '2012-05-11', '2012-05-11', 0.5, ' PM ', 'Vacation Leave', 1, 'Need to help my mother to fetch purified water gallons since we will have our outing on Saturday to Sunday.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0247', 20080701, '2012-05-08', '2012-05-15', '2012-05-15', 1, '  ', 'Vacation Leave', 1, 'Need to attend to an important matter ', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0248', 20100603, '2012-05-09', '2012-06-11', '2012-06-11', 1, 'AM PM ', 'Vacation Leave', 1, 'Going back home to iloilo', '', 'Cancelled');
INSERT INTO `ems_leave` VALUES ('lve-0249', 20080801, '2012-05-10', '2012-05-08', '2012-05-08', 1, '  ', 'Sick Leave', 2, 'Vertigo. Was recommended with 1-2 days bed rest by the doctor from ER confinement.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0250', 20070801, '2012-05-10', '2012-04-26', '2012-04-26', 0.5, 'AM  ', 'Sick Leave', 2, 'Not feeling well', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0251', 20080603, '2012-05-14', '2012-05-11', '2012-05-11', 1, '  ', 'Sick Leave', 2, 'not feeling well due to a flu', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0252', 20091203, '2012-05-14', '2012-05-14', '2012-05-14', 0.5, 'AM  ', 'Emergency Leave', 2, 'Personal Matters.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0253', 20100401, '2012-05-14', '2012-05-14', '2012-05-14', 1, '  ', 'Sick Leave', 2, 'Belly ache.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0254', 20070801, '2012-05-15', '2012-05-14', '2012-05-14', 1, '  ', 'Sick Leave', 2, 'bad throat and body pain', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0255', 20110301, '2012-05-15', '2012-06-11', '2012-06-13', 1.5, 'AM  ', 'Vacation Leave', 1, 'Going home to Gensan to attend wedding of my friend.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0256', 20070705, '2012-05-15', '2012-05-04', '2012-05-04', 1, 'AM  ', 'Emergency Leave', 2, 'Got home from Dagupan 2AM', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0257', 20110201, '2012-05-15', '2012-05-14', '2012-05-14', 1, '  ', 'Sick Leave', 2, 'not feeling well; stomach ache', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0258', 20100301, '2012-05-16', '2012-05-14', '2012-05-14', 1, '  ', 'Sick Leave', 2, 'fever', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0259', 20070705, '2012-05-16', '2012-05-14', '2012-05-14', 1, '  ', 'Emergency Leave', 2, 'Personal', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0260', 20100601, '2012-05-16', '2012-05-31', '2012-05-31', 1, '  ', 'Vacation Leave', 1, 'Personal Matter', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0261', 20080101, '2012-05-16', '2012-05-16', '2012-05-16', 0.5, 'AM  ', 'Sick Leave', 2, 'LBM', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0262', 20110402, '2012-05-17', '2012-05-15', '2012-05-15', 1, 'AM PM ', 'Sick Leave', 2, 'Flu and head ache', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0263', 20070801, '2012-05-17', '2012-05-16', '2012-05-16', 1, '  ', 'Sick Leave', 2, 'Fever, cough and colds', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0264', 20070801, '2012-05-17', '2012-05-21', '2012-05-21', 0.5, ' PM ', 'Vacation Leave', 1, 'Personal business\r\n', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0265', 20070801, '2012-05-17', '2012-05-22', '2012-05-22', 0.5, 'AM  ', 'Vacation Leave', 1, 'Personal business', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0266', 20070705, '2012-05-21', '2012-05-21', '2012-05-21', 0.5, 'AM  ', 'Emergency Leave', 2, 'important errand at home', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0267', 20071002, '2012-05-22', '2012-06-13', '2012-06-15', 3, '  ', 'Vacation Leave', 1, 'Boracay trip with friends ', '', 'Cancelled');
INSERT INTO `ems_leave` VALUES ('lve-0268', 20100601, '2012-05-23', '2012-06-11', '2012-08-08', 59, '  ', '', 0, 'Maternity', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0269', 20100601, '2012-05-25', '2012-05-21', '2012-05-21', 1, 'AM  ', 'Sick Leave', 2, 'Headache', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0270', 20100602, '2012-05-25', '2012-05-23', '2012-05-23', 0.5, 'AM  ', 'Sick Leave', 2, 'Not Feeling well due to headache.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0271', 20080701, '2012-05-25', '2012-05-24', '2012-05-24', 1, '  ', 'Emergency Leave', 2, 'have to take care of my sick sister', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0272', 20110201, '2012-05-26', '2012-05-30', '2012-05-30', 1, '  ', 'Vacation Leave', 1, 'enrollment of my kids', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0273', 20080603, '2012-05-28', '2012-05-30', '2012-05-30', 1, '  ', 'Vacation Leave', 1, 'need to attend an  Interment.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0274', 20070801, '2012-05-28', '2012-05-21', '2012-05-21', 0.5, 'AM  ', 'Sick Leave', 2, 'Not feeling well (abdominal pain)', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0275', 20070801, '2012-05-28', '2012-05-22', '2012-05-22', 0.5, ' PM ', 'Sick Leave', 2, 'Not feeling well (abdominal pain)', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0276', 20070801, '2012-05-28', '2012-05-23', '2012-05-24', 2, '  ', 'Sick Leave', 2, 'Not feeling well (abdominal pain)', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0277', 20080801, '2012-05-28', '2012-05-31', '2012-05-31', 1, '  ', 'Vacation Leave', 1, 'Personal matters.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0278', 20110402, '2012-05-29', '2012-05-28', '2012-05-28', 0.5, 'AM  ', 'Sick Leave', 2, 'Head ache and vomiting', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0279', 20080101, '2012-05-30', '2012-05-25', '2012-05-25', 1, '  ', 'Sick Leave', 2, 'Dysmenorrhea', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0280', 20080101, '2012-05-30', '2012-05-29', '2012-05-29', 1, '  ', 'Sick Leave', 2, 'Gastroenteritis', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0281', 20081101, '2012-05-30', '2012-05-31', '2012-05-31', 1, 'AM PM ', 'Emergency Leave', 2, 'Personal Reason', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0282', 20100903, '2012-05-31', '2012-06-11', '2012-06-11', 1, 'AM PM ', 'Vacation Leave', 1, 'Personal matters.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0283', 20110402, '2012-06-01', '2012-05-31', '2012-05-31', 1, 'AM PM ', 'Sick Leave', 2, 'tonsillitis and severe head ache\r\n', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0284', 20070705, '2012-06-01', '2012-06-01', '2012-06-01', 0.5, 'AM  ', 'Emergency Leave', 2, 'Got home from Dagupan 1AM', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0285', 20091203, '2012-06-04', '2012-06-05', '2012-06-05', 0.5, ' PM ', 'Emergency Leave', 2, 'Need to attend civil wedding of my aunt.', '', 'Cancelled');
INSERT INTO `ems_leave` VALUES ('lve-0286', 20070705, '2012-06-04', '2012-06-15', '2012-06-15', 1, '  ', 'Vacation Leave', 1, 'Personal', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0287', 20120301, '2012-06-04', '2012-06-11', '2012-06-11', 1, '  ', 'Vacation Leave', 1, 'Personal matters.  Schedule visit of my husband & kid.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0288', 20110301, '2012-06-04', '2012-06-13', '2012-06-13', 0.5, ' PM ', 'Vacation Leave', 1, 'Flight gensan to manila', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0289', 20070804, '2012-06-08', '2012-06-13', '2012-06-13', 0.5, 'AM  ', 'Vacation Leave', 1, 'Family', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0290', 20070804, '2012-06-08', '2012-06-05', '2012-06-05', 1, '  ', 'Sick Leave', 2, 'Allergic Rhinitis', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0291', 20110402, '2012-06-11', '2012-06-14', '2012-06-14', 1, 'AM PM ', 'Vacation Leave', 1, 'lead my grand mother to the airport and help my girlfriend to evacuate to our house', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0292', 20100903, '2012-06-13', '2012-06-15', '2012-06-15', 1, 'AM PM ', 'Vacation Leave', 1, 'Family matters.', '', 'Cancelled');
INSERT INTO `ems_leave` VALUES ('lve-0293', 20071002, '2012-06-15', '2012-06-29', '2012-06-29', 1, ' PM ', 'Vacation Leave', 1, 'Attend personal errand', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0294', 20110301, '2012-06-18', '2012-06-18', '2012-06-18', 0.5, ' PM ', 'Sick Leave', 2, 'I''m not feeling well due to dysmenorrhea', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0295', 20110402, '2012-06-18', '2012-06-18', '2012-06-18', 0.5, 'AM  ', 'Sick Leave', 2, 'LBM', '', 'Cancelled');
INSERT INTO `ems_leave` VALUES ('lve-0296', 20110402, '2012-06-18', '2012-06-18', '2012-06-18', 0.5, 'AM  ', 'Sick Leave', 2, 'LBM', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0297', 20100401, '2012-06-18', '2012-06-18', '2012-06-18', 0.5, 'AM  ', 'Sick Leave', 2, 'Muscle pain.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0298', 20080701, '2012-06-19', '2012-06-19', '2012-06-19', 0.5, 'AM  ', 'Sick Leave', 2, 'not feeling well-half day', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0299', 20071002, '2012-06-20', '2012-06-18', '2012-06-18', 1, '  ', 'Sick Leave', 2, 'Not feeling well due to fatigue', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0300', 20100903, '2012-06-20', '2012-06-19', '2012-06-19', 1, 'AM PM ', 'Emergency Leave', 2, 'Family matters.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0301', 20070701, '2012-06-21', '2012-06-21', '2012-06-21', 0.5, 'AM  ', 'Emergency Leave', 2, 'Need to process my sister''s papers', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0302', 0, '2012-06-21', '2012-07-09', '2012-07-09', 0.5, ' PM ', 'Vacation Leave', 1, 'I attend important matters', '', 'Pending');
INSERT INTO `ems_leave` VALUES ('lve-0303', 20100603, '2012-06-21', '2012-06-19', '2012-06-19', 1, 'AM  ', 'Sick Leave', 2, 'not feeling well due of LBM', '', 'Cancelled');
INSERT INTO `ems_leave` VALUES ('lve-0304', 20110402, '2012-06-22', '2012-06-22', '2012-06-22', 0.5, 'AM  ', 'Sick Leave', 2, 'Head ache', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0305', 20100401, '2012-06-22', '2012-06-22', '2012-06-22', 0.5, 'AM  ', 'Sick Leave', 2, 'Headache.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0306', 20100603, '2012-06-25', '2012-06-19', '2012-06-19', 0.5, 'AM  ', 'Sick Leave', 2, 'not feeling well due of LBM', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0307', 20100401, '2012-06-26', '2012-06-25', '2012-06-25', 0.5, 'AM  ', 'Emergency Leave', 2, 'Loan contract signing.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0308', 20081101, '2012-06-26', '2012-06-27', '2012-06-27', 1, ' PM ', 'Sick Leave', 2, 'Need to attend seminar for driver''s license.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0309', 20120302, '2012-06-27', '2012-06-26', '2012-06-26', 0.5, ' PM ', 'Sick Leave', 2, 'I''m not feeling well because of my headache.', '', 'Cancelled');
INSERT INTO `ems_leave` VALUES ('lve-0310', 20120302, '2012-06-27', '2012-06-26', '2012-06-26', 0.5, ' PM ', 'Sick Leave', 2, 'I''m not feeling well because of my headache.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0311', 20081101, '2012-06-27', '2012-06-28', '2012-06-28', 0.5, 'AM  ', 'Sick Leave', 2, 'Apply Driver''s License', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0312', 20120301, '2012-06-28', '2012-07-03', '2012-07-03', 1, '  ', 'Vacation Leave', 1, 'Vacation to province (negros)', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0313', 20100903, '2012-07-04', '2012-07-06', '2012-07-06', 1, 'AM PM ', 'Vacation Leave', 1, 'Personal Matters.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0314', 5012012, '2012-07-05', '2012-07-03', '2012-07-03', 1, 'AM PM ', 'Sick Leave', 2, 'Back pain particularly left shoulder blade', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0315', 20090702, '2012-07-05', '2012-07-05', '2012-07-05', 0.5, 'AM  ', 'Emergency Leave', 2, 'Family matter', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0316', 20070801, '2012-07-06', '2012-07-06', '2012-07-06', 0.5, 'AM  ', 'Sick Leave', 2, 'LBM', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0317', 20080701, '2012-07-06', '2012-07-05', '2012-07-05', 0.5, 'AM  ', 'Sick Leave', 2, 'dysmenorrhea', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0318', 20080701, '2012-07-09', '2012-07-10', '2012-07-10', 1, '  ', 'Vacation Leave', 1, 'need to attend a family get together', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0319', 20110402, '2012-07-09', '2012-07-06', '2012-07-06', 0.5, 'AM  ', 'Sick Leave', 2, 'severe head ache', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0320', 20080701, '2012-07-09', '2012-07-10', '2012-07-10', 1, '  ', 'Emergency Leave', 2, 'need to attend a family affair', '', 'Cancelled');
INSERT INTO `ems_leave` VALUES ('lve-0321', 20080801, '2012-07-09', '2012-06-27', '2012-06-27', 0.5, 'AM  ', 'Emergency Leave', 2, 'Late', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0322', 20070705, '2012-07-09', '2012-07-09', '2012-07-09', 0.5, 'AM  ', 'Emergency Leave', 2, 'Personal', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0323', 20080801, '2012-07-09', '2012-06-29', '2012-06-29', 1, '  ', 'Sick Leave', 2, 'Slight fever and body ache', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0324', 20081101, '2012-07-09', '2012-07-12', '2012-07-12', 0.5, ' PM ', 'Vacation Leave', 1, 'Need to attend seminar', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0325', 20081101, '2012-07-09', '2012-07-27', '2012-07-27', 1, '  ', 'Vacation Leave', 1, 'Application for marriage license', '', 'Cancelled');
INSERT INTO `ems_leave` VALUES ('lve-0326', 20091203, '2012-07-09', '2012-06-13', '2012-07-13', 1, '  ', 'Sick Leave', 2, 'Personal Matter', '', 'Cancelled');
INSERT INTO `ems_leave` VALUES ('lve-0327', 20091203, '2012-07-09', '2012-06-13', '2012-06-13', 1, '  ', 'Sick Leave', 2, 'Not feeling well', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0328', 20091203, '2012-07-09', '2012-06-18', '2012-06-18', 1, '  ', 'Emergency Leave', 2, 'Personal Matter', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0329', 20091203, '2012-07-09', '2012-05-24', '2012-05-24', 0.5, 'AM  ', 'Emergency Leave', 2, 'Not Feeling well', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0330', 20091203, '2012-07-09', '2012-06-28', '2012-06-28', 1, '  ', 'Emergency Leave', 2, 'Personal Matter', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0331', 20091203, '2012-07-09', '2012-07-03', '2012-07-03', 0.5, 'AM  ', 'Emergency Leave', 2, 'Due to Bad Weather condition', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0332', 20080801, '2012-07-10', '2012-07-12', '2012-07-12', 1, '  ', 'Vacation Leave', 1, 'Seminar for Marriage License application', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0333', 20080801, '2012-07-10', '2012-07-27', '2012-07-27', 0.5, ' PM ', 'Vacation Leave', 1, 'Process requirements for Marriage Contract', '', 'Cancelled');
INSERT INTO `ems_leave` VALUES ('lve-0334', 20080801, '2012-07-10', '2012-06-08', '2012-06-08', 1, '  ', 'Sick Leave', 2, 'Not feeling well', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0335', 20110201, '2012-07-10', '2012-07-09', '2012-07-09', 1, '  ', 'Emergency Leave', 2, 'accompanied my father to the hospital for check-up due to severe headache', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0336', 20100301, '2012-07-11', '2012-07-10', '2012-07-10', 1, '  ', 'Sick Leave', 2, 'Swollen Tonsil and Headache', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0337', 20070705, '2012-07-11', '2012-07-11', '2012-07-11', 0.5, 'AM  ', 'Emergency Leave', 2, 'personal', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0338', 5012012, '2012-07-12', '2012-07-11', '2012-07-11', 1, 'AM PM ', 'Sick Leave', 2, 'Colds and some fever.', '', 'Pending');
INSERT INTO `ems_leave` VALUES ('lve-0339', 20100301, '2012-07-16', '2012-07-27', '2012-07-27', 1, '  ', 'Vacation Leave', 1, 'going home', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0340', 20100301, '2012-07-16', '2012-07-30', '2012-07-30', 1, '  ', 'Vacation Leave', 1, 'going home', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0341', 20100301, '2012-07-16', '2012-07-20', '2012-07-20', 1, 'AM  ', 'Vacation Leave', 1, 'will accompany my brother', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0342', 20090802, '2012-07-16', '2012-07-19', '2012-07-19', 1, '  ', 'Vacation Leave', 1, 'Personal matters (regarding house).', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0343', 20070705, '2012-07-17', '2012-07-17', '2012-07-17', 0.5, 'AM  ', 'Emergency Leave', 2, 'personal', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0344', 20100401, '2012-07-20', '2012-07-19', '2012-07-19', 1, '  ', 'Sick Leave', 2, 'flu.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0345', 20080701, '2012-07-20', '2012-07-20', '2012-07-20', 0.5, 'AM  ', 'Sick Leave', 2, 'headache', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0346', 20110301, '2012-07-24', '2012-07-24', '2012-07-24', 0.5, 'AM  ', 'Emergency Leave', 2, 'I have an urgent matter to settle.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0347', 20110301, '2012-07-24', '2012-07-24', '2012-07-24', 0.5, 'AM  ', 'Emergency Leave', 2, 'I have an urgent matter to settle.', '', 'Cancelled');
INSERT INTO `ems_leave` VALUES ('lve-0348', 20090702, '2012-07-24', '2012-07-26', '2012-07-26', 1, 'AM PM ', 'Vacation Leave', 1, 'Personal matter', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0349', 20071002, '2012-07-25', '2012-07-27', '2012-07-27', 1, '  ', 'Vacation Leave', 1, 'Attend seminar at PICPA', '', 'Cancelled');
INSERT INTO `ems_leave` VALUES ('lve-0350', 20071002, '2012-07-26', '2012-08-02', '2012-08-02', 1, '  ', 'Vacation Leave', 1, 'Attend PICPA Seminar (rescheduled from July 27)', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0351', 20110402, '2012-07-26', '2012-07-23', '2012-07-23', 0.5, 'AM  ', 'Sick Leave', 2, 'Personal Related Problem', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0352', 20071002, '2012-07-26', '2012-07-03', '2012-07-03', 1, 'AM  ', 'Sick Leave', 2, 'Not feeling well', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0353', 20070705, '2012-07-26', '2012-07-19', '2012-07-19', 0.5, 'AM  ', 'Emergency Leave', 2, 'personal', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0354', 20070705, '2012-07-26', '2012-07-23', '2012-07-23', 0.5, 'AM  ', 'Emergency Leave', 2, 'personal', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0355', 20070705, '2012-07-26', '2012-07-24', '2012-07-24', 0.5, 'AM  ', 'Emergency Leave', 2, 'personal', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0356', 20070705, '2012-07-26', '2012-07-26', '2012-07-26', 0.5, 'AM  ', 'Emergency Leave', 2, 'personal', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0357', 20070705, '2012-07-26', '2012-07-30', '2012-07-31', 2, '  ', 'Vacation Leave', 1, 'Terminal Leave', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0358', 20080604, '2012-07-26', '2012-07-05', '2012-07-06', 2, '  ', 'Emergency Leave', 2, 'Vacation Leave', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0359', 20080604, '2012-07-26', '2012-07-05', '2012-07-06', 2, '  ', 'Emergency Leave', 2, 'Vacation Leave', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0360', 20080604, '2012-07-26', '2012-07-05', '2012-07-06', 2, '  ', 'Emergency Leave', 2, 'Vacation Leave', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0361', 5012012, '2012-07-27', '2012-07-04', '2012-07-04', 1, 'AM PM ', 'Sick Leave', 2, 'Food Poisoning ', '', 'Pending');
INSERT INTO `ems_leave` VALUES ('lve-0362', 20100903, '2012-07-27', '2012-08-03', '2012-08-03', 1, 'AM PM ', 'Vacation Leave', 1, 'Personal Matters.', '', 'Denied');
INSERT INTO `ems_leave` VALUES ('lve-0363', 20081101, '2012-07-30', '2012-08-01', '2012-08-01', 1, 'AM PM ', 'Vacation Leave', 1, 'Taytay Municipal Hall - Sumbission of requirements', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0364', 20080801, '2012-07-30', '2012-08-01', '2012-08-01', 1, '  ', 'Vacation Leave', 1, 'Process documents for marriage contract application.', '', 'Pending');
INSERT INTO `ems_leave` VALUES ('lve-0365', 20120301, '2012-07-30', '2012-07-30', '2012-07-30', 1, '  ', 'Emergency Leave', 2, 'due to floods on the road, no electricity, & no water to use', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0366', 20100401, '2012-07-31', '2012-08-02', '2012-08-02', 1, '  ', 'Emergency Leave', 2, 'Personal matter.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0367', 20091201, '2012-07-31', '2012-07-31', '2012-07-31', 1, 'AM  ', 'Emergency Leave', 2, 'Accompany my mom to check her sprained ankle', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0368', 5012012, '2012-08-01', '2012-07-30', '2012-07-30', 1, 'AM PM ', 'Emergency Leave', 2, 'My dad slipped and have to brought to the hospital for x-ray', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0369', 20090702, '2012-08-03', '2012-08-02', '2012-08-02', 1, 'AM PM ', 'Emergency Leave', 2, 'Needed to do an errand requested by my mother', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0370', 20100401, '2012-08-08', '2012-08-03', '2012-08-03', 1, '  ', 'Sick Leave', 2, 'flu.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0374', 5012012, '2012-08-09', '2012-08-08', '2012-08-08', 1, 'AM PM ', 'Emergency Leave', 2, 'No transportaion going to the office due to heavy rain faill', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0375', 20110201, '2012-08-09', '2012-08-08', '2012-08-08', 1, '  ', 'Emergency Leave', 2, 'no transportation due to heavy rains and flood', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0376', 20110201, '2012-08-09', '2012-08-08', '2012-08-08', 1, '  ', 'Emergency Leave', 2, 'no transportation due to heavy rains and flood', '', 'Cancelled');
INSERT INTO `ems_leave` VALUES ('lve-0377', 20090702, '2012-08-09', '2012-08-08', '2012-08-08', 1, 'AM  ', 'Emergency Leave', 2, 'Due to flooded areas in Sta Ana', '', 'Cancelled');
INSERT INTO `ems_leave` VALUES ('lve-0378', 20090702, '2012-08-09', '2012-08-09', '2012-08-09', 0.5, 'AM  ', 'Emergency Leave', 2, 'Traffic accident in Makati', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0379', 20090802, '2012-08-09', '2012-08-08', '2012-08-08', 1, '  ', 'Emergency Leave', 2, 'Bad weather, very limited PUJ''s/ PUV''s and cannot pass through Cainta/Junction route.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0380', 20100401, '2012-08-09', '2012-08-09', '2012-08-09', 0.5, 'AM  ', 'Sick Leave', 2, 'stomach ache.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0381', 20080801, '2012-08-09', '2012-08-08', '2012-08-09', 2, '  ', 'Emergency Leave', 2, 'Our area is flooded. Water level increased after a day and is stagnant in our area. Need to arrange things to evacuate.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0382', 20110402, '2012-08-13', '2012-08-13', '2012-08-13', 1, 'AM  ', 'Sick Leave', 2, 'Personal Matter', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0383', 20110402, '2012-08-13', '2012-08-16', '2012-08-16', 1, 'AM PM ', 'Vacation Leave', 1, 'Will be with my girlfriend''s check up', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0384', 0, '2012-08-13', '2012-08-13', '2012-08-13', 0.5, 'AM  ', 'Emergency Leave', 2, 'Personal Concern', '', 'Pending');
INSERT INTO `ems_leave` VALUES ('lve-0385', 20100401, '2012-08-13', '2012-08-13', '2012-08-13', 0.5, 'AM  ', 'Emergency Leave', 2, 'Personal concern', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0386', 20110201, '2012-08-13', '2012-08-13', '2012-08-13', 0.5, ' PM ', 'Emergency Leave', 2, 'heavy traffic in all alternative routes from Angono to workplace', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0387', 20120302, '2012-08-13', '2012-08-07', '2012-08-08', 2, '  ', 'Emergency Leave', 2, 'Due to heavy rain & flood, I wasn''t able to come at office.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0388', 20090702, '2012-08-15', '2012-08-15', '2012-08-15', 0.5, 'AM  ', 'Emergency Leave', 2, 'Personal matter', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0389', 20080101, '2012-08-16', '2012-08-27', '2012-08-27', 1, '  ', 'Sick Leave', 2, 'Dysmonnorhea', '', 'Pending');
INSERT INTO `ems_leave` VALUES ('lve-0390', 20120302, '2012-08-17', '2012-09-14', '2012-09-14', 1, '  ', 'Vacation Leave', 1, 'I will celebrate my birthday with my family. :)', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0391', 20080701, '2012-08-22', '2012-08-17', '2012-08-17', 1, '  ', 'Emergency Leave', 2, 'need to attend to an important matter', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0392', 20100601, '2012-08-22', '2012-08-14', '2012-08-14', 1, '  ', 'Sick Leave', 2, 'Not feeling well', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0393', 20100601, '2012-08-22', '2012-08-15', '2012-08-15', 1, 'AM  ', 'Emergency Leave', 2, 'Immunization of my son', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0394', 20091201, '2012-08-23', '2012-08-23', '2012-08-23', 1, 'AM PM ', 'Emergency Leave', 2, 'Need to attend to personal documents.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0395', 20100401, '2012-08-23', '2012-08-23', '2012-08-23', 0.5, 'AM  ', 'Sick Leave', 2, 'Tummy ache', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0396', 20091203, '2012-08-23', '2012-08-30', '2012-08-31', 2, 'AM PM ', 'Vacation Leave', 1, 'Terminal Leave', '', 'Denied');
INSERT INTO `ems_leave` VALUES ('lve-0397', 20080603, '2012-08-23', '2012-08-31', '2012-09-03', 2, '  ', 'Vacation Leave', 1, 'need to spent time and have a out of town vacation with my close friends', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0398', 20080801, '2012-08-28', '2012-09-05', '2012-09-07', 3, '  ', 'Vacation Leave', 1, 'Pre-wedding leave.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0399', 20080801, '2012-08-28', '2012-09-10', '2012-09-12', 3, '  ', 'Vacation Leave', 1, 'Post-wedding leave.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0400', 20100301, '2012-08-29', '2012-08-28', '2012-08-28', 1, '  ', 'Sick Leave', 2, 'hyper acidity', '', 'Cancelled');
INSERT INTO `ems_leave` VALUES ('lve-0401', 20100301, '2012-08-31', '2012-08-31', '2012-08-31', 1, 'AM  ', 'Sick Leave', 2, 'migraine', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0402', 20100401, '2012-09-03', '2012-08-31', '2012-08-31', 1, '  ', 'Emergency Leave', 2, 'Bring mother to hospital due to allergic rhinitis.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0403', 20071002, '2012-09-03', '2012-09-05', '2012-09-05', 1, '  ', 'Vacation Leave', 1, 'Vacation', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0404', 20090702, '2012-09-03', '2012-09-05', '2012-09-05', 1, 'AM PM ', 'Vacation Leave', 1, 'Personal matter', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0405', 20100601, '2012-09-03', '2012-09-19', '2012-09-19', 1, '  ', 'Vacation Leave', 1, 'Immunization of my son ', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0406', 20081101, '2012-09-04', '2012-09-05', '2012-09-05', 1, '  ', 'Emergency Leave', 2, 'Preparation of the Wedding.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0407', 20081101, '2012-09-04', '2012-09-06', '2012-09-07', 2, '  ', 'Vacation Leave', 1, 'Preparation for the Wedding.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0408', 20081101, '2012-09-04', '2012-09-10', '2012-09-12', 3, '  ', 'Vacation Leave', 1, 'After wedding', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0409', 20080701, '2012-09-05', '2012-09-07', '2012-09-07', 0.5, 'AM  ', 'Sick Leave', 2, 'LBM', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0410', 20100401, '2012-09-05', '2012-09-05', '2012-09-05', 0.5, 'AM  ', 'Sick Leave', 2, 'fever', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0411', 20100401, '2012-09-05', '2012-10-25', '2012-10-31', 4, '  ', 'Vacation Leave', 1, 'Cebu trip', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0412', 20110201, '2012-09-07', '2012-09-11', '2012-09-11', 1, '  ', 'Vacation Leave', 1, 'birthday of my son', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0413', 20100401, '2012-09-07', '2012-09-07', '2012-09-07', 0.5, 'AM  ', 'Sick Leave', 2, 'Fever', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0414', 20110402, '2012-09-10', '2012-09-13', '2012-09-13', 1, 'AM PM ', 'Vacation Leave', 1, 'Will be with my girlfriend for her check up', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0415', 20090702, '2012-09-10', '2012-09-06', '2012-09-06', 1, 'AM PM ', 'Emergency Leave', 2, 'Needed to do an errand requested by my brother', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0416', 20110301, '2012-09-12', '2012-09-11', '2012-09-11', 1, '  ', 'Sick Leave', 2, 'fever due to my tonsilitis', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0417', 20120302, '2012-09-12', '2012-09-10', '2012-09-10', 0.5, 'AM  ', 'Sick Leave', 2, 'Due to Dsymenorrhea iI can''t come at office.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0418', 20080604, '2012-09-12', '2012-09-11', '2012-09-11', 0.5, 'AM  ', 'Sick Leave', 2, 'Half day Sick Leave only', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0419', 20090702, '2012-09-16', '2012-09-20', '2012-09-20', 1, 'AM PM ', 'Vacation Leave', 1, 'My lolo''s burial', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0420', 20100301, '2012-09-18', '2012-09-14', '2012-09-14', 1, 'AM  ', 'Sick Leave', 2, 'LBM', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0421', 20080801, '2012-09-19', '2012-09-17', '2012-09-17', 1, '  ', 'Sick Leave', 2, 'Dysmenorrhea', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0422', 20110402, '2012-09-20', '2012-09-20', '2012-09-20', 0.5, 'AM  ', 'Sick Leave', 2, 'Head Ache', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0423', 20070801, '2012-09-20', '2012-09-25', '2012-09-25', 1, '  ', 'Vacation Leave', 1, 'Birthday leave :)', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0424', 20100601, '2012-09-21', '2012-09-20', '2012-09-20', 1, '  ', 'Sick Leave', 2, 'Diarrhea', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0425', 20080701, '2012-09-24', '2012-09-21', '2012-09-21', 0.5, 'AM  ', 'Sick Leave', 2, 'not feeling well due to body ache', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0426', 20080701, '2012-09-24', '2012-09-24', '2012-09-24', 0.5, ' PM ', 'Emergency Leave', 2, 'choir practice for church anniversary', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0427', 20060801, '2012-09-24', '2012-09-26', '2012-09-26', 1, '  ', 'Vacation Leave', 1, 'I will help my mom on her errands and will get my license', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0428', 20120601, '2012-09-24', '2012-09-21', '2012-09-21', 1, ' PM ', 'Sick Leave', 2, 'due to headache', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0429', 20120302, '2012-10-02', '2012-10-01', '2012-10-01', 1, '  ', 'Sick Leave', 2, 'I wasn''t able to come at office because of my headache.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0430', 20110402, '2012-10-03', '2012-09-24', '2012-10-02', 9, '  ', 'Maternity/Paternity Leave', 0, 'Paternal leave ', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0431', 20070801, '2012-10-04', '2012-10-03', '2012-10-03', 1, '  ', 'Emergency Leave', 2, 'Lab test at Healthway and check-up', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0432', 20080701, '2012-10-08', '2012-10-05', '2012-10-05', 1, '  ', 'Sick Leave', 2, 'headache', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0433', 20110301, '2012-10-08', '2012-10-16', '2012-10-16', 1, 'AM PM ', 'Vacation Leave', 1, 'Personal matter', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0434', 20120302, '2012-10-09', '2012-10-15', '2012-10-15', 1, ' PM ', 'Vacation Leave', 1, 'Personal Matters.', '', 'Cancelled');
INSERT INTO `ems_leave` VALUES ('lve-0435', 20080603, '2012-10-10', '2012-10-11', '2012-10-11', 1, '  ', 'Vacation Leave', 1, 'need to attend interment.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0436', 20080101, '2012-10-11', '2012-10-11', '2012-10-11', 0.5, 'AM  ', 'Sick Leave', 2, 'Headache', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0437', 20070801, '2012-10-13', '2012-10-11', '2012-10-11', 0.5, 'AM  ', 'Sick Leave', 2, 'Dizziness and mild fever', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0438', 20100401, '2012-10-15', '2012-10-15', '2012-10-15', 0.5, 'AM  ', 'Sick Leave', 2, 'Headache and colds.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0439', 20120302, '2012-10-16', '2012-10-15', '2012-10-15', 1, '  ', 'Emergency Leave', 2, 'I have no rest day last Week end. ', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0440', 20080701, '2012-10-17', '2012-10-17', '2012-10-17', 0.5, 'AM  ', 'Sick Leave', 2, 'not feeling well due to headache', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0441', 20120301, '2012-10-18', '2012-10-24', '2012-10-24', 0.5, ' PM ', 'Vacation Leave', 1, 'Negros vacation', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0442', 20120301, '2012-10-18', '2012-11-02', '2012-11-02', 1, '  ', 'Vacation Leave', 1, 'Negros vacation', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0443', 20120301, '2012-10-18', '2012-11-05', '2012-11-05', 1, '  ', 'Vacation Leave', 1, 'Negros vacation', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0444', 20120301, '2012-10-18', '2012-10-25', '2012-10-25', 1, '  ', 'Vacation Leave', 1, 'Negros Vacation', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0445', 20080701, '2012-10-18', '2012-10-24', '2012-10-25', 2, '  ', 'Vacation Leave', 1, 'need to go home to province.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0446', 20071002, '2012-10-18', '2012-10-25', '2012-10-25', 1, '  ', 'Vacation Leave', 1, '"Me" Time', '', 'Cancelled');
INSERT INTO `ems_leave` VALUES ('lve-0447', 20080801, '2012-10-22', '2012-10-19', '2012-10-19', 1, '  ', 'Sick Leave', 2, 'Dizzyness', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0448', 20060801, '2012-10-23', '2012-10-25', '2012-10-25', 0.5, 'AM  ', 'Vacation Leave', 1, 'Personal reasons, need to do something in the morning', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0449', 20100301, '2012-10-27', '2013-01-02', '2013-01-07', 4, '  ', 'Vacation Leave', 1, 'go home to celebrate new year with my family', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0450', 20110201, '2012-10-29', '2012-11-05', '2012-11-05', 1, '  ', 'Vacation Leave', 1, 'it''s my daughter''s birthday :)', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0451', 20100301, '2012-10-30', '2012-10-30', '2012-10-30', 0.5, ' PM ', 'Sick Leave', 2, 'dysmenorrhea', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0452', 20080604, '2012-10-31', '2012-12-26', '2012-12-28', 3, '  ', 'Vacation Leave', 1, 'Christmas break', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0453', 20120301, '2012-11-07', '2012-11-07', '2012-11-07', 1, '  ', 'Sick Leave', 2, 'Fever & body pains', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0454', 20110301, '2012-11-07', '2012-12-24', '2012-12-28', 4, '  ', 'Vacation Leave', 1, 'Holiday leave - time for my family!', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0455', 20110301, '2012-11-08', '2012-11-21', '2012-11-22', 2, '  ', 'Vacation Leave', 1, 'Personal Time', '', 'Cancelled');
INSERT INTO `ems_leave` VALUES ('lve-0456', 5012012, '2012-11-12', '2012-11-12', '2012-11-12', 1, 'AM PM ', 'Sick Leave', 2, 'I have colds and slight fever.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0457', 20120602, '2012-11-12', '2012-11-16', '2012-11-16', 1, 'AM PM ', 'Sick Leave', 2, 'Will undergo medical treatment.', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0458', 5012012, '2012-11-13', '2012-11-13', '2012-11-13', 1, 'AM PM ', 'Sick Leave', 2, 'Still sick with colds and fever', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0459', 20080101, '2012-11-14', '2012-12-26', '2012-12-28', 3, '  ', 'Vacation Leave', 1, 'LEAVE', '', 'Denied');
INSERT INTO `ems_leave` VALUES ('lve-0460', 20080101, '2012-11-14', '2012-12-31', '2012-12-31', 1, '  ', 'Vacation Leave', 1, 'LEAVE', '', 'Denied');
INSERT INTO `ems_leave` VALUES ('lve-0461', 20080101, '2012-11-14', '2013-02-04', '2013-02-05', 2, '  ', 'Vacation Leave', 1, 'LEAVE', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0462', 5012012, '2012-11-15', '2012-12-26', '2012-12-28', 3, 'AM PM ', 'Vacation Leave', 1, 'Christmas Holiday', '', 'Denied');
INSERT INTO `ems_leave` VALUES ('lve-0463', 20081101, '2013-04-23', '2013-03-11', '2013-03-11', 0.5, '11:00 am', 'Emergency Leave', 2, 'TEST', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0464', 20081101, '2013-04-24', '2013-04-23', '2013-04-23', 0.5, '11:00 am', 'Emergency Leave', 2, 'LATE', '', 'Approved');
INSERT INTO `ems_leave` VALUES ('lve-0465', 20081101, '2013-04-24', '2013-04-24', '2013-04-24', 0.5, '10:00 am', 'Emergency Leave', 2, 'TEST', '', 'Approved');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_ob`
-- 

CREATE TABLE `ems_ob` (
  `ob_id` varchar(15) NOT NULL,
  `emp_num` int(15) NOT NULL,
  `date_filed` datetime NOT NULL,
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `ems_ob`
-- 

INSERT INTO `ems_ob` VALUES ('ofb-0001', 20100401, '2011-10-11 00:00:00', 'Ever Grand Central', '2011-10-11', '0000-00-00', 'Others|Go Live|', 'Approved', '', '450 ', '600', '1110', '8.3', '1200', '10');
INSERT INTO `ems_ob` VALUES ('ofb-0002', 20080603, '2011-10-12 00:00:00', 'FDI', '2011-10-11', '0000-00-00', 'Meeting|', 'Approved', 'Checkpoint meeting and deployment of update to fix issue on RIRS #4297 and RIRS #4344', '855 ', '915', '1090', '2.55', '1125', '3.3');
INSERT INTO `ems_ob` VALUES ('ofb-0003', 20100602, '2011-10-12 00:00:00', 'Paris Hilton Newport', '2011-10-12', '0000-00-00', 'Others|POS Harware Upgrade|', 'Approved', 'Need to upgrade POS Hard ware from Generic POS to HP rp5700', '840', '930', '1320', '6.39', '1410', '8.42');
INSERT INTO `ems_ob` VALUES ('ofb-0004', 20080603, '2011-10-17 00:00:00', 'KLG Main', '2011-10-14', '0000-00-00', 'Delivery|Meeting|', 'Approved', 'Meeting regarding Pcount, check error on new printer LQ 300 and product that can''t delte the picture', '495 ', '540', '780', '4', '900', '6');
INSERT INTO `ems_ob` VALUES ('ofb-0005', 20100602, '2011-10-19 00:00:00', 'Lacoste Trinoma ', '2011-10-20', '0000-00-00', 'Others|Need to check and configure Cash Drawer.|', 'Cancelled', 'with SPL 1016', '1050 ', '1095', '1140', '0.45', '1170', '1.15');
INSERT INTO `ems_ob` VALUES ('ofb-0006', 20100301, '2011-10-20 00:00:00', 'Suy Sing', '2011-10-19', '0000-00-00', 'Others|installation of Registration Management System and Demo for Raffle. Printing of Stickers|', 'Approved', '', '605 ', '690', '1080', '6.3', '1170', '8');
INSERT INTO `ems_ob` VALUES ('ofb-0007', 20100401, '2011-10-21 00:00:00', 'Super8 Ortigas and Shaw', '2011-10-19', '0000-00-00', 'Others|Onsite monitoring of GC online issue and NULL value in status field in Systemuser.|', 'Approved', '', '480 ', '570', '720', '2.3', '780', '3.3');
INSERT INTO `ems_ob` VALUES ('ofb-0008', 20100401, '2011-10-21 00:00:00', 'Ever Recto', '2011-10-21', '0000-00-00', 'Others|Installation for Roces and Cainta branch.|', 'Approved', '', '540 ', '600', '1080', '8', '1200', '10');
INSERT INTO `ems_ob` VALUES ('ofb-0009', 20110402, '2011-10-25 00:00:00', 'New Creation', '2011-10-25', '0000-00-00', 'Others|Onsite Development|', 'Approved', 'Onsite Development and discuss all the issues of New Creation about barter 8 distrib', '450 ', '645', '1200', '9.15', '1380', '12.15');
INSERT INTO `ems_ob` VALUES ('ofb-0010', 20080604, '2011-10-28 00:00:00', 'Primer', '2011-10-27', '2011-10-27', 'Meeting|Others|Consolidation of documents for billing purposes.|', 'Approved', '', '495 ', '--Select--', '--Select--', '', '1230', '');
INSERT INTO `ems_ob` VALUES ('ofb-0011', 20100301, '2011-10-28 19:41:00', 'Cheers', '2011-10-26', '2011-10-27', 'Others|upgrade|', 'Approved', '', '390 ', '1020', '1860', '14.0', '1925', '17.05');
INSERT INTO `ems_ob` VALUES ('ofb-0012', 20100301, '2011-10-28 19:43:00', 'Cheers', '2011-10-27', '2011-10-28', 'Others|upgrade|', 'Approved', '', '780 ', '795', '1500', '11.45', '1560', '12.45');
INSERT INTO `ems_ob` VALUES ('ofb-0013', 20100301, '2011-10-28 19:44:00', 'Cheers', '2011-10-28', '2011-10-29', 'Others|hardware configuration|', 'Cancelled', '', '510 ', '540', '--Select--', '20.0', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0014', 20070801, '2011-11-02 10:21:00', 'Prince Blake', '2011-11-03', '2011-11-13', 'Others|Dry run, live and monitoring|', 'Approved', 'Bogo and Pardo branch', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0015', 20100401, '2011-11-02 14:36:00', 'Ever Paliparan', '2011-10-28', '2011-10-28', 'Others|Go live monitoring|', 'Approved', '', '360 ', '560', '900', '5.40', '1140', '9.40');
INSERT INTO `ems_ob` VALUES ('ofb-0016', 20060901, '2011-11-02 15:47:00', 'Cheers Mart/Isabela', '2011-10-26', '2011-10-29', 'Others|software upgrade & setup printers|', 'Approved', 'w/ TSadaya', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0017', 20070701, '2011-11-02 18:00:00', 'Emilou-Cavite', '2011-11-03', '2011-11-03', 'Meeting|', 'Confirmed', '', '450 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0018', 20100602, '2011-11-02 18:10:00', 'DDs Grocery store', '2011-10-27', '2011-10-27', 'Network|Consultation|Others|Check ALL POS, Fix POS Problems, fix problem with debit loyalty points, sql server upgrade|', 'Approved', '', '420 ', '510', '1050', '9.540', '1140', '11.570');
INSERT INTO `ems_ob` VALUES ('ofb-0019', 20100602, '2011-11-02 18:15:00', 'Pentstar HO', '2011-11-03', '2011-11-03', 'Others|Accounting system and barter Workstation Upgrade. |', 'Approved', 'Ms April requested for workstation Hardware upgrade of accounting system with barter. Accounting system provider will also be present tomorrow Nov. 3, 2011 at 9am', '825', '845', '910', '1.65', '925', '2.20');
INSERT INTO `ems_ob` VALUES ('ofb-0020', 20090702, '2011-11-03 10:54:00', 'COH - Cebu', '2011-10-27', '2011-10-28', 'Others|UAT Observation with Ms. Fracy|', 'Approved', 'UAT Observation with Ms. Fracy', '330 ', '600', '2370', '29.30', '2700', '35.0');
INSERT INTO `ems_ob` VALUES ('ofb-0021', 20100903, '2011-11-03 11:12:00', 'JG Manpo', '2011-11-08', '2011-11-08', 'Others|Will process Company clearance and other application requirements.|', 'Confirmed', '', '510 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0022', 20100301, '2011-11-03 11:34:00', 'Cheers', '2011-10-28', '2011-10-29', 'Others|ibm 1nr printer configuration|', 'Approved', '', '510 ', '540', '2670', '35.30', '1800', '');
INSERT INTO `ems_ob` VALUES ('ofb-0023', 20100603, '2011-11-03 16:46:00', 'Nesabel/Pateros', '2011-11-03', '2011-11-03', 'Others|Barter Software upgrade and Installation|', 'Approved', '', '1080 ', '1140', '1435', '4.55', '30', '');
INSERT INTO `ems_ob` VALUES ('ofb-0024', 20100603, '2011-11-04 11:24:00', 'Nesabel/Pateros', '2011-11-04', '2011-11-04', 'Others|Software Upgrade Monitoring|', 'Approved', '', '690 ', '720', '1170', '7.30', '1185', '8.15');
INSERT INTO `ems_ob` VALUES ('ofb-0025', 20080701, '2011-11-08 15:08:00', 'IBM', '2011-11-09', '2011-11-09', 'Others|IBM BP KICK OFF|', 'Cancelled', '', '960 ', '--Select--', '1260', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0026', 20100303, '2011-11-08 18:25:00', 'JG Manpo', '2011-11-09', '2011-11-09', 'Others|renewal of contract|', 'Approved', '', '480 ', '510', '720', '3.30', '745', '4.25');
INSERT INTO `ems_ob` VALUES ('ofb-0027', 20090501, '2011-11-09 10:39:00', 'OCLP/GSC', '2011-11-09', '2011-11-09', 'Others|Support|', 'Confirmed', 'They been experiencing error in printing contracts. (Urgent)', '780 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0028', 20060901, '2011-11-10 15:30:00', 'COH-Cebu', '2011-11-14', '2011-11-26', 'Others|SAP on-site testing/revision|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0029', 20060901, '2011-11-10 15:37:00', 'DSAP', '2011-11-09', '2011-11-09', 'Others|Barter Rx presentation/demo|', 'Approved', 'w/ CC, CE', '765 ', '780', '930', '2.30', '945', '3.15');
INSERT INTO `ems_ob` VALUES ('ofb-0030', 20100303, '2011-11-10 16:00:00', 'sfsd', '2011-11-24', '2011-11-28', 'Delivery|', 'Cancelled', 'safas', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0031', 20100303, '2011-11-10 16:01:00', 'abc', '2011-11-17', '2011-11-17', 'Others|abcde|', 'Cancelled', '', '--Select-- ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0032', 20080101, '2011-11-11 14:02:00', 'Pentstar/HO', '2011-11-11', '2011-11-11', 'Meeting|', 'Cancelled', 'Checkpoint Meeting with Sir Tristan - Introduce Ian Enrique to Sir Tristan.', '600 ', '600', '690', '1.30', '720', '2.0');
INSERT INTO `ems_ob` VALUES ('ofb-0033', 20080701, '2011-11-11 14:48:00', 'Primer', '2011-11-14', '2011-11-14', 'Meeting|Others|Reconciliation of BIR POS Permit for DC Megamall and other BIR Concerns with Ms. Elsa|', 'Approved', '', '470', '520', '570', '0.50', '630', '2.40');
INSERT INTO `ems_ob` VALUES ('ofb-0034', 20090802, '2011-11-11 17:46:00', 'COH', '2011-11-14', '2011-11-23', 'Meeting|Others|Testing and simulation of Barter-SAP Agent|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0035', 20081101, '2011-11-11 18:36:00', 'COH', '2011-11-14', '2011-11-23', 'Meeting|Others|Testing, Development|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0036', 20100603, '2011-11-14 10:14:00', 'Nesabel/Bulacan', '2011-11-08', '2011-11-08', 'Others|Barter Version Software Upgrade Installation and Monitoring|', 'Approved', '', '570 ', '750', '1290', '9.0', '1305', '12.15');
INSERT INTO `ems_ob` VALUES ('ofb-0037', 20100603, '2011-11-14 10:15:00', 'Nesabel/Bulacan', '2011-11-09', '2011-11-09', 'Others|Barter Version Software Upgrade Installation and Monitoring|', 'Approved', '', '525 ', '540', '1350', '13.30', '1380', '14.15');
INSERT INTO `ems_ob` VALUES ('ofb-0038', 20100603, '2011-11-14 10:17:00', 'Nesabel/Bulacan', '2011-11-10', '2011-11-10', 'Others|Barter Version Software Upgrade Installation and Monitoring|', 'Approved', '', '525 ', '540', '1170', '10.30', '1380', '14.15');
INSERT INTO `ems_ob` VALUES ('ofb-0039', 20100401, '2011-11-14 11:30:00', 'Ever Roces', '2011-11-13', '2011-11-13', 'Others|Go live monitoring|', 'Approved', '', '420 ', '510', '930', '7.0', '1050', '10.30');
INSERT INTO `ems_ob` VALUES ('ofb-0040', 20080701, '2011-11-14 16:41:00', 'Epson', '2011-11-18', '2011-11-18', 'Meeting|Others|Epson Corporate Partner''s Business Review|', 'Confirmed', 'with Miss Meanne', '1020 ', '--Select--', '1260', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0041', 20070701, '2011-11-16 11:45:00', 'Prince Blake HO', '2011-11-23', '2011-11-23', 'Meeting|', 'Confirmed', '', '480 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0042', 20080603, '2011-11-16 14:54:00', 'Krazy Krepes', '2011-11-15', '2011-11-15', 'Others|Back Office on site maintenance.|', 'Approved', '', '480 ', '540', '720', '3.0', '870', '6.30');
INSERT INTO `ems_ob` VALUES ('ofb-0043', 20080603, '2011-11-16 14:54:00', 'Krazy Krepes', '2011-11-15', '2011-11-15', 'Others|Back Office on site maintenance.|', 'Denied', '', '480 ', '540', '720', '3.0', '870', '6.30');
INSERT INTO `ems_ob` VALUES ('ofb-0044', 20080701, '2011-11-16 17:01:00', 'GABC, Super 8, Primer', '2011-11-17', '2011-11-17', 'Delivery|', 'Confirmed', 'with Kuya Mon', '540 ', '--Select--', '960', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0045', 20110402, '2011-11-17 18:31:00', 'SportsHouse', '2011-11-17', '2011-11-17', 'Meeting|', 'Approved', '', '570 ', '630', '810', '3.0', '870', '5.0');
INSERT INTO `ems_ob` VALUES ('ofb-0046', 20110402, '2011-11-17 18:37:00', 'pentstar-lacoste', '2011-11-17', '2011-11-17', 'Consultation|Others|Investigate how to fix the issue in POS Z-reading wrong accumulation|', 'Approved', '', '810 ', '865', '1095', '3.50', '1110', '5.0');
INSERT INTO `ems_ob` VALUES ('ofb-0047', 20100401, '2011-11-18 16:03:00', 'Ever Cainta', '2011-11-18', '2011-11-18', 'Others|Go Live Monitoring|', 'Approved', '', '420 ', '480', '930', '7.30', '990', '9.30');
INSERT INTO `ems_ob` VALUES ('ofb-0048', 20100602, '2011-11-21 09:17:00', 'Pentstar LF Glorietta', '2011-11-19', '2011-11-19', 'Others|Need to fix zreading of Lacoste footwear Glorietta|', 'Approved', '', '570 ', '600', '930', '5.330', '960', '8.270');
INSERT INTO `ems_ob` VALUES ('ofb-0049', 20100602, '2011-11-21 09:19:00', 'Pentstar LF Rockwell', '2011-11-12', '2011-11-12', 'Others|Need to Fix No Discount on zreading problem, |', 'Approved', '', '960 ', '1020', '1080', '1.60', '1110', '4.30');
INSERT INTO `ems_ob` VALUES ('ofb-0050', 20100602, '2011-11-21 09:34:00', 'Pentstar LF Megamall', '2011-11-23', '2011-11-23', 'Others|Lacoste Footwear Hardware POS upgrade From Old POS to New POS|', 'Approved', '', '630', '645', '1045', '6.400', '1050', '6.05');
INSERT INTO `ems_ob` VALUES ('ofb-0051', 20080701, '2011-11-21 11:54:00', 'Anson', '2011-11-22', '2011-11-22', 'Meeting|Others|Meeting with Anson''s LTDO for submission of cancellation of POS Permit granted to their SPM''s, submission of disposal letter for SPM retired by Anson|', 'Approved', '', '450', '540', '585', '0.45', '710', '3.05');
INSERT INTO `ems_ob` VALUES ('ofb-0052', 20110402, '2011-11-21 22:54:00', 'SportsHouse HO', '2011-11-21', '2011-11-21', 'Others|onsite development|', 'Approved', 'fix issue of sportshouse in deleting empty folder, and gather informations in creating new report request.', '480 ', '570', '1170', '10.0', '1260', '13.0');
INSERT INTO `ems_ob` VALUES ('ofb-0053', 20080701, '2011-11-22 14:43:00', 'GABC', '2011-11-22', '2011-11-22', 'Delivery|Others|Delivery of 5 OS for POS and countersigning of docs for HW Payment Processing|', 'Confirmed', '', '960 ', '--Select--', '1110', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0054', 20110402, '2011-11-24 10:27:00', 'KLGFS', '2011-11-22', '2011-11-22', 'Consultation|', 'Approved', 'Fix all the issues of KLGFS Regarding their reports. (onsite Dev)', '570 ', '630', '1110', '8.0', '1260', '11.30');
INSERT INTO `ems_ob` VALUES ('ofb-0055', 20100602, '2011-11-24 18:32:00', 'LF Megamall', '2011-11-24', '2011-11-24', 'Others|need to send regeneration of mall sales|', 'Approved', '', '1110', '1120', '1155', '0.35', '1170', '0.55');
INSERT INTO `ems_ob` VALUES ('ofb-0056', 20110402, '2011-11-26 11:06:00', 'SportsHouse', '2011-11-24', '2011-11-24', 'Others|Onsite Development|', 'Approved', 'Fix the urgent issue of sportshouse in barcode printing wrong amount output', '480 ', '570', '1140', '9.30', '1290', '13.30');
INSERT INTO `ems_ob` VALUES ('ofb-0057', 20100301, '2011-11-28 09:11:00', 'Simplicity', '2011-11-24', '2011-11-24', 'Others|maintenance|', 'Approved', '', '480 ', '600', '1170', '9.30', '1290', '13.30');
INSERT INTO `ems_ob` VALUES ('ofb-0058', 20100301, '2011-11-28 09:14:00', 'Simplicity / Muzon', '2011-11-25', '2011-11-25', 'Others|maintenance|', 'Approved', '', '450 ', '615', '1335', '12.0', '60', '');
INSERT INTO `ems_ob` VALUES ('ofb-0059', 20100303, '2011-11-29 18:49:00', 'Suoper8', '2011-11-29', '2011-11-29', 'Delivery|', 'Approved', 'delivery to Super8 (5MSR)', '840 ', '845', '1090', '4.05', '1095', '4.05');
INSERT INTO `ems_ob` VALUES ('ofb-0060', 20100602, '2011-12-01 10:47:00', 'Gaisano Gen San', '2011-11-29', '2011-11-29', 'Others|Install and Setup New DELL Server|', 'Approved', '', '330 ', '720', '2700', '33.1980', '2715', '41.2265');
INSERT INTO `ems_ob` VALUES ('ofb-0061', 20100401, '2011-12-02 10:54:00', 'Super8 Molino', '2011-11-25', '2011-11-25', 'Others|Installation of Server and Workstation|', 'Approved', '', '570 ', '660', '970', '5.10', '1090', '8.40');
INSERT INTO `ems_ob` VALUES ('ofb-0062', 20070801, '2011-12-02 11:12:00', 'Parmasyutika', '2011-12-02', '2011-12-09', 'Others|Setup and installation. Barter backend, POS and lookup training|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0063', 20100602, '2011-12-05 18:01:00', 'Gaisano Gen San', '2011-11-30', '2011-11-30', 'Others|Onsite Monitoring and Onsite Support after Server Upgrade on Nov 29, 2011|', 'Approved', '', '525 ', '540', '1270', '12.730', '1290', '14.645');
INSERT INTO `ems_ob` VALUES ('ofb-0064', 20080701, '2011-12-05 18:10:00', 'Pentstar', '2011-12-05', '2011-12-05', 'Meeting|', 'Approved', 'BIR Meeting regarding ATP and other concerns', '890', '910', '980', '1.10', '1010', '2.0');
INSERT INTO `ems_ob` VALUES ('ofb-0065', 20080604, '2011-12-05 18:16:00', 'Pentstar', '2011-12-05', '2011-12-05', 'Meeting|', 'Approved', '', '195 ', '--Select--', '--Select--', '', '255', '');
INSERT INTO `ems_ob` VALUES ('ofb-0066', 20100602, '2011-12-06 10:09:00', 'Gaisano Gen San', '2011-12-01', '2011-12-01', 'Others|Gaisano Davao Half day Monitoring. \r\nFinal Checking of Upgraded Server. \r\nFinal checking of sales and POS Password Credentials. \r\nPayment Collection |', 'Approved', '', '540 ', '555', '720', '2.165', '1135', '10.475');
INSERT INTO `ems_ob` VALUES ('ofb-0067', 20100602, '2011-12-06 10:11:00', 'DD''s Apalit', '2011-12-06', '2011-12-06', 'Others|SQL Server Upgrade from SQL2000 to SQL2008r2|', 'Approved', '', '440 ', '--Select--', '--Select--', '0.0', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0068', 20070801, '2011-12-06 15:52:00', 'Super 8 Molino', '2011-12-07', '2011-12-08', 'Others|Dry run|', 'Approved', 'Dec 7 sched moved to Dec 9', '--Select-- ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0069', 20070801, '2011-12-06 15:52:00', 'Super 8 Molino', '2011-12-11', '2011-12-13', 'Others|Pre-setup and live monitoring|', 'Confirmed', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0070', 20100401, '2011-12-07 17:04:00', 'Super8 Molino', '2011-12-05', '2011-12-05', 'Others|Setup and configuration|', 'Approved', '', '510 ', '660', '1170', '8.30', '1290', '13.0');
INSERT INTO `ems_ob` VALUES ('ofb-0071', 20100401, '2011-12-07 17:08:00', 'Super8 Head Office', '2011-12-06', '2011-12-06', 'Others|Installation of POS:\r\nS8MAL-POS07, S8NOV-POS02, S8NOV-POS07, S8GUA-POS06, S8ORT-POS03, S8ORT-POS14, S8TAR-POS07, S8SAN-POS02.|', 'Approved', '', '570 ', '660', '1020', '6.0', '1140', '9.30');
INSERT INTO `ems_ob` VALUES ('ofb-0072', 20070701, '2011-12-08 11:38:00', 'COH', '2011-12-08', '2011-12-08', 'Meeting|', 'Confirmed', 'Status Update meeting withe Client PM and SAP PM at Ortigas Home Depot', '795 ', '840', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0073', 20080604, '2011-12-09 10:36:00', 'Primer', '2011-12-08', '2011-12-08', 'Others|Submit STA for the TSSP and check on the collection status|', 'Approved', '', '735 ', '--Select--', '--Select--', '', '1050', '');
INSERT INTO `ems_ob` VALUES ('ofb-0074', 20080604, '2011-12-09 10:38:00', 'HP', '2011-12-16', '2011-12-16', 'Meeting|', 'Confirmed', 'Meeting with Sir Maurice and Ms. Mitch re the hardware warranty concern of Primer @ UCC Cafe, Rockwell', '--Select-- ', '510', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0075', 20080701, '2011-12-12 12:51:00', 'BIR RDO 43a', '2011-12-12', '2011-12-12', 'Meeting|', 'Approved', 'Follow up of pending applications, BIR Representation-gift giving, discussion of other BIR Concerns', '810 ', '860', '900', '0.40', '940', '');
INSERT INTO `ems_ob` VALUES ('ofb-0076', 20060901, '2011-12-12 14:12:00', 'iRipple', '2011-12-13', '2011-12-13', 'Meeting|', 'Confirmed', 'HR related-breakfast coffee w/ Ms Liza @ Starbucks Silver City', '420 ', '480', '600', '2.0', '660', '4.0');
INSERT INTO `ems_ob` VALUES ('ofb-0077', 20080603, '2011-12-12 14:32:00', 'Classic Character', '2011-12-12', '2011-12-12', 'Others|Checking of Data Collector communication error|', 'Approved', '', '420 ', '540', '720', '3.0', '840', '7.0');
INSERT INTO `ems_ob` VALUES ('ofb-0078', 20080701, '2011-12-12 15:40:00', 'HP and Iontech', '2011-12-13', '2011-12-13', 'Meeting|', 'Confirmed', 'Iontech:  Christmas Party for Dealers-7th High, Bonifacio High Street', '1070 ', '--Select--', '--Select--', '', '1260', '');
INSERT INTO `ems_ob` VALUES ('ofb-0079', 20080604, '2011-12-12 17:02:00', 'Primer', '2011-12-12', '2011-12-12', 'Meeting|', 'Approved', 'Discuss the pickup process and cost for the Permit to use sales machine.  Met with Sir Richard and Ms. Ging', '765 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0080', 20100301, '2011-12-12 19:06:00', 'Super 8 HO', '2011-12-08', '2011-12-08', 'Others|installation|', 'Approved', '', '480 ', '660', '1080', '7.0', '1260', '13.0');
INSERT INTO `ems_ob` VALUES ('ofb-0081', 20100401, '2011-12-13 10:47:00', 'Super8 Santo Rosario', '2011-12-08', '2011-12-08', 'Others|Installation of POS, Workstation and Server|', 'Approved', '', '480 ', '660', '1080', '7.0', '1200', '12.0');
INSERT INTO `ems_ob` VALUES ('ofb-0082', 20100401, '2011-12-13 10:58:00', 'Super8 Molino', '2011-12-12', '2011-12-12', 'Others|Go Live Monitoring|', 'Approved', '', '450 ', '600', '1200', '10.0', '1380', '15.30');
INSERT INTO `ems_ob` VALUES ('ofb-0083', 20100602, '2011-12-13 11:26:00', 'LAC Marquee', '2011-12-14', '2011-12-14', 'Network|Others|Setup Cash Drawer and network settings to send sales in mall admin. |', 'Approved', 'HP RP5700 com ports are not working... I use rs232 to USB temporarily for the cash drawer to work. Already sent support request with Hardware Department. ', '540 ', '630', '850', '3.40', '960', '7.0');
INSERT INTO `ems_ob` VALUES ('ofb-0084', 20100603, '2011-12-14 11:17:00', 'Prince NRA', '2011-12-13', '2011-12-14', 'Others|', 'Approved', '', '1230 ', '1260', '1500', '4.0', '1530', '5.0');
INSERT INTO `ems_ob` VALUES ('ofb-0085', 20070801, '2011-12-14 18:08:00', 'Super 8 Sto. Rosario', '2011-12-15', '2011-12-20', 'Others|Setup, dry run, live and monitoring|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0086', 20070705, '2011-12-14 18:22:00', 'Powerhouse Binondo', '2011-12-15', '2011-12-15', 'Meeting|', 'Confirmed', 'Meeting with JS', '510 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0087', 20100602, '2011-12-20 08:58:00', 'KLGFS', '2011-12-19', '2011-12-19', 'Others|Onsite visit to fix Issue 4544 and minor issue in 4502.|', 'Approved', '', '970 ', '1005', '1205', '3.20', '1265', '4.55');
INSERT INTO `ems_ob` VALUES ('ofb-0088', 20100401, '2011-12-20 09:39:00', 'Super8 Santo Rosario', '2011-12-19', '2011-12-20', 'Others|Go Live Monitoring|', 'Approved', '', '780 ', '810', '1440', '10.30', '1470', '11');
INSERT INTO `ems_ob` VALUES ('ofb-0089', 20070705, '2011-12-20 17:26:00', 'Nesabel Pateros', '2011-12-21', '2011-12-21', 'Meeting|', 'Confirmed', 'with FN for new branch', '570', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0090', 20070701, '2011-12-20 17:28:00', 'Nesabel/Pateros', '2011-12-21', '2011-12-21', 'Meeting|', 'Confirmed', 'Planning Meeting with Sir Nestor and Ms. Belle for Bustos branch', '540 ', '600', '1435', '13.55', '840', '');
INSERT INTO `ems_ob` VALUES ('ofb-0091', 20100401, '2011-12-20 17:51:00', 'Ever Recto', '2011-12-16', '2011-12-16', 'Others|Installation of 1 POS|', 'Approved', '', '900 ', '1050', '1080', '0.30', '1200', '5.0');
INSERT INTO `ems_ob` VALUES ('ofb-0092', 20100401, '2011-12-20 17:53:00', 'Super8 Santo Rosario', '2011-12-20', '2011-12-20', 'Others|Monitor and fix slow importation of branch agent|', 'Approved', '', '810 ', '870', '990', '2.0', '1050', '4.0');
INSERT INTO `ems_ob` VALUES ('ofb-0093', 20110402, '2011-12-21 15:22:00', 'New Creation', '2011-12-20', '2011-12-20', 'Others|Onsite development|', 'Approved', 'my actual arrival from new creation to our house is 12:45 am.', '450 ', '600', '1320', '12.0', '1435', '16.25');
INSERT INTO `ems_ob` VALUES ('ofb-0094', 20080603, '2011-12-22 14:09:00', 'Pentstar HO', '2011-12-22', '2011-12-22', 'Others|on site support|', 'Approved', '', '600 ', '615', '685', '1.10', '695', '1.35');
INSERT INTO `ems_ob` VALUES ('ofb-0095', 20090501, '2011-12-27 19:11:00', 'OCLP/GSC', '2011-12-27', '2011-12-27', 'Others|Fixed problem in Payment-Adjustment module|', 'Approved', '', '780 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0096', 20100602, '2011-12-28 09:21:00', 'Century Chemicals Toctocan', '2011-12-27', '2011-12-27', 'Others|Pcount Re training, and Monitoring|', 'Approved', '', '570 ', '630', '930', '5.0', '995', '7.05');
INSERT INTO `ems_ob` VALUES ('ofb-0097', 20100602, '2011-12-28 09:22:00', 'Century Chemicals', '2011-12-28', '2011-12-28', 'Others|Pcount Posting and Monitoring|', 'Approved', '', '510 ', '555', '855', '5.0', '920', '6.05');
INSERT INTO `ems_ob` VALUES ('ofb-0098', 20080603, '2011-12-28 12:09:00', 'Heathway', '2011-12-28', '2011-12-28', 'Others|APE|', 'Approved', '', '390 ', '500', '615', '1.55', '630', '');
INSERT INTO `ems_ob` VALUES ('ofb-0099', 20100401, '2011-12-28 16:51:00', 'Ever Recto', '2011-12-27', '2011-12-27', 'Others|Installation of POS for Navotas|', 'Approved', '', '840 ', '915', '930', '0.15', '1050', '3.30');
INSERT INTO `ems_ob` VALUES ('ofb-0100', 20080603, '2012-01-03 09:39:00', 'FDI', '2012-01-02', '2012-01-02', 'Others|support on their PCount activity|', 'Approved', '', '840 ', '930', '1245', '5.15', '1270', '7.10');
INSERT INTO `ems_ob` VALUES ('ofb-0101', 20091201, '2012-01-03 18:46:00', 'Citychain, Binondo Manila', '2012-01-04', '2012-01-04', 'Meeting|', 'Confirmed', 'Prospect client who called today.  Will open a small department goods store and need pos system.  Saw our system in ever. \r\n\r\nThey are currently engaged in wholesale and this new store will be their retail arm.', '540 ', '570', '660', '1.30', '780', '4.0');
INSERT INTO `ems_ob` VALUES ('ofb-0102', 20080603, '2012-01-04 17:35:00', 'New Creation', '2012-01-04', '2012-01-04', 'Others|', 'Approved', 'uninstall temporary license', '525 ', '540', '570', '0.30', '690', '2.45');
INSERT INTO `ems_ob` VALUES ('ofb-0103', 20080603, '2012-01-04 17:37:00', 'Mario D Boro', '2012-01-04', '2012-01-04', 'Others|', 'Approved', 'Back up database and copy.', '570 ', '680', '810', '2.10', '840', '4.30');
INSERT INTO `ems_ob` VALUES ('ofb-0104', 20100602, '2012-01-05 07:59:00', 'Contract Packaging', '2012-01-05', '2012-01-05', 'Others|Need to fix reports on Bullion.|', 'Approved', '', '510 ', '600', '960', '6.0', '1055', '9.5');
INSERT INTO `ems_ob` VALUES ('ofb-0105', 20100601, '2012-01-05 11:35:00', 'Gamot Publiko - Caniogan', '2012-01-05', '2012-01-05', 'Others|-PCount Procedure\r\n-Getting Database|', 'Approved', '', '910', '925', '960', '0.35', '990', '1.20');
INSERT INTO `ems_ob` VALUES ('ofb-0106', 20100602, '2012-01-05 19:09:00', 'KLGFS', '2012-01-06', '2012-01-06', 'Others|KLGFS Configure Boracay Server|', 'Confirmed', '', '540 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0107', 20080701, '2012-01-10 10:45:00', 'IBM', '2012-01-12', '2012-01-12', 'Others|IBM BP Kick Off 2012|', 'Confirmed', '', '1020 ', '1080', '1380', '5.0', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0108', 20070801, '2012-01-11 15:13:00', 'EZ', '2012-01-15', '2012-01-20', 'Others|Re-training|', 'Approved', 'With Trinah Sadaya', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0109', 20080604, '2012-01-11 18:12:00', 'Primer', '2012-01-12', '2012-01-12', 'Meeting|', 'Confirmed', '', '480 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0110', 20080604, '2012-01-11 18:13:00', '360 and COH', '2012-01-24', '2012-01-25', 'Meeting|', 'Confirmed', 'Client meeting for hardware - 360 Pharmacy and COH', '--Select-- ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0111', 20080701, '2012-01-16 13:25:00', 'Epson ', '2012-01-17', '2012-01-17', 'Meeting|Others|Epson POS SI’s Tech update|', 'Confirmed', '', '600 ', '720', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0112', 20080701, '2012-01-16 16:50:00', 'Iontech', '2012-01-17', '2012-01-17', 'Others|HP RPOS Business Planning- Iontech - Servimax Office - Conference 1|', 'Approved', '', '810 ', '840', '960', '2.0', '1050', '4.0');
INSERT INTO `ems_ob` VALUES ('ofb-0113', 20080701, '2012-01-18 15:09:00', 'Microsoft Philippines', '2012-01-26', '2012-01-26', 'Others|Microsoft Partner Network Sales Briefing|', 'Approved', '', '480 ', '--Select--', '960', '', '1110', '');
INSERT INTO `ems_ob` VALUES ('ofb-0114', 20100401, '2012-01-19 17:54:00', 'Super8 Head Office', '2012-01-18', '2012-01-18', 'Others|Installation of POS,Server and Workstation for Visayas Ave.\r\nInstallation of POS for Laspinas and Caloocan|', 'Approved', '', '600 ', '780', '1140', '6.0', '1200', '10.0');
INSERT INTO `ems_ob` VALUES ('ofb-0115', 20100602, '2012-01-19 18:47:00', 'Pentstar LAC Trinoma', '2012-01-19', '2012-01-19', 'Others|Fix Cash Drawer. Re solder power socket to its circuit board.|', 'Approved', 'Done', '645 ', '675', '705', '0.30', '725', '1.20');
INSERT INTO `ems_ob` VALUES ('ofb-0116', 20100602, '2012-01-19 18:48:00', 'Care Products', '2012-01-20', '2012-01-20', 'Meeting|Others|Meeting |', 'Approved', '', '540 ', '600', '960', '6.0', '1020', '8.0');
INSERT INTO `ems_ob` VALUES ('ofb-0117', 20080801, '2012-01-20 15:08:00', 'EZ Supermarket - Tarlac', '2012-01-15', '2012-01-18', 'Others|Barter Software client training to substitute for Arian.|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0118', 20080801, '2012-01-20 15:12:00', 'S-CV Tandang Sora', '2012-01-18', '2012-01-18', 'Others|Barter Software client training backup and support for Raj.|', 'Approved', '', '750 ', '780', '1020', '4.0', '1290', '9.0');
INSERT INTO `ems_ob` VALUES ('ofb-0119', 20080801, '2012-01-20 15:16:00', 'S-CV Tandang Sora', '2012-01-19', '2012-01-19', 'Others|Barter Software training backup and support to Raj.|', 'Approved', '', '600 ', '720', '1020', '5.0', '1230', '10.30');
INSERT INTO `ems_ob` VALUES ('ofb-0120', 20100301, '2012-01-24 09:58:00', 'EZ', '2012-01-15', '2012-01-15', 'Others|travel to tarlac|', 'Approved', '', '960 ', '990', '1320', '5.30', '1325', '5.05');
INSERT INTO `ems_ob` VALUES ('ofb-0121', 20100301, '2012-01-24 09:59:00', 'EZ/tibag', '2012-01-16', '2012-01-16', 'Others|training day 1|', 'Approved', '', '480 ', '510', '1110', '10.0', '1140', '11.0');
INSERT INTO `ems_ob` VALUES ('ofb-0122', 20100301, '2012-01-24 10:00:00', 'EZ/tibag', '2012-01-17', '2012-01-17', 'Others|training day 2|', 'Approved', '', '495 ', '510', '1110', '10.0', '1140', '10.45');
INSERT INTO `ems_ob` VALUES ('ofb-0123', 20100301, '2012-01-24 10:03:00', 'EZ/tibag', '2012-01-18', '2012-01-18', 'Others|training day3|', 'Approved', '', '510 ', '540', '1080', '9.0', '1110', '10.0');
INSERT INTO `ems_ob` VALUES ('ofb-0124', 20100301, '2012-01-24 10:04:00', 'EZ/tibag', '2012-01-19', '2012-01-19', 'Others|training day 4|', 'Approved', '', '510 ', '535', '1050', '8.35', '1080', '9.30');
INSERT INTO `ems_ob` VALUES ('ofb-0125', 20100301, '2012-01-24 10:05:00', 'EZ/tibag', '2012-01-20', '2012-01-20', 'Others|training day 5|', 'Approved', '', '540 ', '555', '900', '5.45', '1260', '12.0');
INSERT INTO `ems_ob` VALUES ('ofb-0126', 20080603, '2012-01-24 10:22:00', 'Care', '2012-01-20', '2012-01-20', 'Meeting|', 'Approved', 'presentation of Barter Distribution', '450 ', '585', '1005', '7.0', '1065', '10.15');
INSERT INTO `ems_ob` VALUES ('ofb-0127', 20070705, '2012-01-24 15:52:00', 'Nesabel Pateros', '2012-01-24', '2012-01-24', 'Meeting|', 'Approved', 'Meeting regarding the final Nesabel Bustos implementation schedule', '510 ', '570', '750', '3.0', '780', '4.30');
INSERT INTO `ems_ob` VALUES ('ofb-0128', 20080801, '2012-01-24 15:58:00', 'N/A', '2012-01-24', '2012-01-24', 'Others|ITSS Seminar - invitation from PSIA with Ms. Liza Clarete in Makati, City.|', 'Approved', '', '420 ', '540', '780', '4.0', '840', '7.0');
INSERT INTO `ems_ob` VALUES ('ofb-0129', 20100603, '2012-01-25 10:06:00', 'SCV', '2012-01-16', '2012-01-20', 'Others|SCV - Set up, POS and Backend Training for Taguig Branch|', 'Denied', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0130', 20070801, '2012-01-25 14:25:00', 'Parmasyutika', '2012-01-25', '2012-01-25', 'Others|Get updated database for checking of encoded items for upcoming training and teach Ms. Emy for test scanning of items.|', 'Approved', '', '--Select-- ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0131', 20080801, '2012-01-25 15:47:00', 'N/A', '2012-01-25', '2012-01-25', 'Others|ITSS Seminar|', 'Approved', '', '510 ', '600', '720', '2.0', '885', '6.15');
INSERT INTO `ems_ob` VALUES ('ofb-0132', 20090501, '2012-01-26 08:51:00', 'OCLP/GSC', '2012-01-26', '2012-01-26', 'Meeting|', 'Approved', 'Will turnover the documents(acknowledgement forms and completion forms) for signing.', '570 ', '600', '640', '0.40', '680', '1.50');
INSERT INTO `ems_ob` VALUES ('ofb-0133', 20100603, '2012-01-26 09:53:00', 'SCV', '2012-01-16', '2012-01-16', 'Others|POS and Backend  Set-Up|', 'Approved', '', '510 ', '570', '1140', '9.30', '1350', '14.0');
INSERT INTO `ems_ob` VALUES ('ofb-0134', 20100603, '2012-01-26 09:55:00', 'SCV', '2012-01-17', '2012-01-17', 'Others|POS Training|', 'Approved', '', '510 ', '600', '1080', '8.0', '1200', '11.30');
INSERT INTO `ems_ob` VALUES ('ofb-0135', 20100603, '2012-01-26 09:57:00', 'SCV', '2012-01-18', '2012-01-18', 'Others|Backend Day 1 Training|', 'Approved', '', '510 ', '600', '1080', '8.0', '1140', '10.30');
INSERT INTO `ems_ob` VALUES ('ofb-0136', 20100603, '2012-01-26 09:58:00', 'SCV', '2012-01-19', '2012-01-19', 'Others|Backend Day 2 Training|', 'Approved', '', '510 ', '600', '1080', '8.0', '1140', '10.30');
INSERT INTO `ems_ob` VALUES ('ofb-0137', 20100603, '2012-01-26 09:59:00', 'SCV', '2012-01-20', '2012-01-20', 'Others|Final Set-up of POS, Backend, and Branch Agent and Settings Configuration|', 'Approved', '', '510 ', '600', '1140', '9.0', '1260', '12.30');
INSERT INTO `ems_ob` VALUES ('ofb-0138', 20080604, '2012-01-27 09:31:00', 'Primer', '2012-01-26', '2012-01-26', 'Meeting|', 'Approved', '', '480 ', '--Select--', '--Select--', '', '935', '');
INSERT INTO `ems_ob` VALUES ('ofb-0139', 20100602, '2012-01-30 10:31:00', 'Regan', '2012-01-31', '2012-01-31', 'Others|Client is Requesting to Transfer one Barter Lisense to new Workstation due to hardware failure of one of their workstation|', 'Confirmed', '', '510 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0140', 20070801, '2012-01-30 13:14:00', 'Parmasyutika', '2012-01-30', '2012-02-03', 'Others|Barter training|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0141', 20090802, '2012-01-31 09:14:00', 'Primer', '2012-02-01', '2012-02-01', 'Others|Demo of CLP for Primer. Will be responsible for answering technical questions of the client.|', 'Approved', 'Ms. Jen See asked me to go with them during the demo of CLP to Primer.', '750 ', '780', '870', '1.30', '930', '3.0');
INSERT INTO `ems_ob` VALUES ('ofb-0142', 20070705, '2012-01-31 19:33:00', 'Parmasyutika', '2012-02-01', '2012-02-01', 'Others|Assist AC training of lookup|', 'Confirmed', '', '480 ', '600', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0143', 20070705, '2012-02-09 01:25:00', 'Magic CWO', '2012-02-07', '2012-02-09', 'Others|Setup Server for new version and test connection|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0144', 20080603, '2012-02-09 12:36:00', 'HO', '2012-02-09', '2012-02-09', 'Others|fix unisilver processing sales.|', 'Approved', '', '450 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0145', 20080604, '2012-02-10 01:17:00', 'Primer', '2012-02-08', '2012-02-08', 'Meeting|', 'Approved', '', '450 ', '--Select--', '--Select--', '', '1235', '');
INSERT INTO `ems_ob` VALUES ('ofb-0146', 20080604, '2012-02-10 01:18:00', 'Primer - HW', '2012-02-10', '2012-02-10', 'Meeting|', 'Confirmed', 'Discuss the extent of HP hardware diagnosis for Primer''s units.  Meeting place is Rockwell, UCC.', '420 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0147', 20100603, '2012-02-10 06:02:00', 'SCV - TGG', '2012-01-30', '2012-01-30', 'Others|Set-up and Dry Run|', 'Approved', '', '495 ', '570', '1230', '11.0', '1320', '13.45');
INSERT INTO `ems_ob` VALUES ('ofb-0148', 20100603, '2012-02-10 06:03:00', 'SCV - TGG', '2012-01-31', '2012-01-31', 'Others|Live and Monitoring|', 'Approved', '', '450 ', '510', '1230', '12.0', '1320', '14.30');
INSERT INTO `ems_ob` VALUES ('ofb-0149', 20100603, '2012-02-10 06:05:00', 'SCV - TGG', '2012-02-01', '2012-02-01', 'Others|1st Day of Live Monitoring|', 'Approved', '', '495 ', '570', '1230', '11.0', '1320', '13.45');
INSERT INTO `ems_ob` VALUES ('ofb-0150', 20100603, '2012-02-10 06:06:00', 'SCV - TGG', '2012-02-02', '2012-02-02', 'Others|2nd Day of Live Monitoring|', 'Approved', '', '495 ', '570', '1215', '10.45', '1305', '13.30');
INSERT INTO `ems_ob` VALUES ('ofb-0151', 20100603, '2012-02-10 06:07:00', 'SCV - TGG', '2012-02-03', '2012-02-03', 'Others|3rd and Last Day of Monitoring|', 'Approved', '', '495 ', '570', '1200', '10.30', '1275', '13.0');
INSERT INTO `ems_ob` VALUES ('ofb-0152', 20070701, '2012-02-10 06:44:00', 'COH', '2012-02-13', '2012-03-09', 'Others|Training and Pre Live Preparations|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0153', 20100603, '2012-02-11 09:51:00', 'Nesabel/Pateros', '2012-02-10', '2012-02-10', 'Others|Incomplete synchronization of Profiles from Server to POS|', 'Approved', '', '510 ', '540', '960', '7.0', '1020', '8.30');
INSERT INTO `ems_ob` VALUES ('ofb-0154', 20070801, '2012-02-16 10:28:00', 'Parmasyutika', '2012-02-16', '2012-02-16', 'Others|Lookup & POS Training for last user|', 'Approved', '', '--Select-- ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0155', 20080604, '2012-02-17 08:10:00', 'Primer', '2012-02-16', '2012-02-16', 'Meeting|', 'Approved', '', '480 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0156', 20100603, '2012-02-18 01:09:00', 'CTHW - Davao', '2012-02-13', '2012-02-13', 'Others|1st Day Barter Report Customized Training|', 'Approved', '', '525 ', '540', '1020', '8.0', '1200', '11.15');
INSERT INTO `ems_ob` VALUES ('ofb-0157', 20100603, '2012-02-18 01:10:00', 'CTHW - Davao', '2012-02-14', '2012-02-14', 'Others|2nd Day Barter Report Customized Training|', 'Approved', '', '525 ', '540', '1020', '8.0', '1200', '11.15');
INSERT INTO `ems_ob` VALUES ('ofb-0158', 20100603, '2012-02-18 01:11:00', 'CTHW - Davao', '2012-02-15', '2012-02-15', 'Others|3rd Day Barter Report Customized Training|', 'Approved', '', '525 ', '540', '1020', '8.0', '1435', '15.10');
INSERT INTO `ems_ob` VALUES ('ofb-0159', 20100602, '2012-02-21 01:33:00', 'Pentstar LAC MOA', '2012-02-21', '2012-02-21', 'Others|Need to install COIN System...|', 'Approved', '', '570 ', '625', '710', '1.25', '825', '4.15');
INSERT INTO `ems_ob` VALUES ('ofb-0160', 20100602, '2012-02-21 01:37:00', 'Pentstar LAC Rockwell', '2012-02-23', '2012-02-23', 'Meeting|', 'Confirmed', 'Client requested for Rockwell meeting for their new mall sending procedure... i will be attending this meeting with Sir Arwin.', '510 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0161', 20070801, '2012-02-21 11:20:00', 'Parmasyutika', '2012-02-20', '2012-02-23', 'Others|Dry run, live and monitoring|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0162', 20110201, '2012-02-21 17:53:00', 'Healthway', '2012-02-22', '2012-02-22', 'Others|Medical / Physical Exam|', 'Confirmed', '', '510 ', '--Select--', '--Select--', '3.30', '720', '');
INSERT INTO `ems_ob` VALUES ('ofb-0163', 20110301, '2012-02-21 17:53:00', 'Healthway-Shang', '2012-02-22', '0000-00-00', 'Others|Medical and Annual Physical Exam|', 'Confirmed', '', '510 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0164', 20100301, '2012-02-21 21:04:00', 'EZ Concepcion', '2012-02-20', '2012-02-20', 'Others|Barter Upgrade|', 'Approved', '', '660 ', '900', '180', '12', '360', '15');
INSERT INTO `ems_ob` VALUES ('ofb-0165', 20100301, '2012-02-22 12:41:00', 'EZ Concepcion', '2012-02-21', '2012-02-21', 'Others|Fixed overlapping transaction in Concepcion\r\nUpgrade other branches|', 'Approved', '', '600 ', '630', '300', '18.50', '315', '18.75');
INSERT INTO `ems_ob` VALUES ('ofb-0166', 20070801, '2012-02-23 11:12:00', 'S8 Visayas Ave', '2012-02-24', '2012-02-24', 'Others|On-site setup|', 'Confirmed', '', '--Select-- ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0167', 20100301, '2012-02-24 10:02:00', 'EZ', '2012-02-22', '2012-02-22', 'Others|monitoring|', 'Approved', '', '520 ', '545', '1110', '9.25', '1200', '11.20');
INSERT INTO `ems_ob` VALUES ('ofb-0168', 20100301, '2012-02-24 10:07:00', 'EZ', '2012-02-23', '2012-02-23', 'Others|monitoring|', 'Approved', '', '515 ', '535', '1200', '11.05', '1380', '14.25');
INSERT INTO `ems_ob` VALUES ('ofb-0169', 20110402, '2012-02-24 12:12:00', 'pentstar-lacoste (rockwell', '2012-02-23', '2012-02-23', 'Meeting|', 'Approved', 'Meeting abou the new enhancement of Pentsar Rockwell', '540 ', '600', '720', '2.0', '750', '3.30');
INSERT INTO `ems_ob` VALUES ('ofb-0170', 20100401, '2012-02-24 14:44:00', 'Ever Concepcion', '2012-02-17', '2012-02-17', 'Others|Go live monitoring|', 'Approved', '', '510 ', '630', '960', '5.30', '1080', '9.30');
INSERT INTO `ems_ob` VALUES ('ofb-0171', 20070705, '2012-02-25 12:00:00', 'Kevin Enterprises Cagayan De Oro', '2012-02-24', '2012-02-25', 'Meeting|', 'Approved', 'with FN and CC', '240 ', '600', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0172', 20070705, '2012-02-28 15:58:00', 'Nesabel Pateros', '2012-02-28', '2012-02-28', 'Others|Get database and exe|', 'Approved', 'Got back in the afternoon', '540 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0173', 20100602, '2012-03-01 20:03:00', 'Lacoste SM Davao', '2012-02-28', '2012-02-28', 'Others|Upgrade Old POS to NEW POS|', 'Approved', '', '300 ', '600', '--Select--', '10.0', '--Select--', '15.30');
INSERT INTO `ems_ob` VALUES ('ofb-0174', 20100602, '2012-03-01 20:04:00', 'Lacoste SM Davao', '2012-02-29', '2012-02-29', 'Others|Monitoring After POS Upgrade|', 'Approved', '', '600 ', '625', '--Select--', '9.35', '--Select--', '13.30');
INSERT INTO `ems_ob` VALUES ('ofb-0175', 20100602, '2012-03-01 20:05:00', 'Regan', '2012-03-02', '2012-03-02', 'Meeting|', 'Confirmed', 'REGAN meeting with ms Fracy', '540 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0176', 20100603, '2012-03-02 16:00:00', 'S8 / Visayas Ave. QC', '2012-03-02', '2012-03-02', 'Others|S8 - Live Monitoring|', 'Approved', '', '975 ', '1050', '1410', '6.0', '1435', '7.40');
INSERT INTO `ems_ob` VALUES ('ofb-0177', 20070705, '2012-03-05 17:31:00', 'Nesabel Pateros', '2012-03-05', '2012-03-05', 'Others|Put database to new server|', 'Confirmed', '', '1050 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0178', 20080801, '2012-03-05 17:36:00', 'COH', '2012-03-12', '2012-03-23', 'Others|Barter Software Training|', 'Cancelled', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0179', 20080801, '2012-03-05 17:36:00', 'COH-Cebu', '2012-02-13', '2012-02-24', 'Others|Barter Software Training|', 'Cancelled', '', '', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0180', 20080801, '2012-03-05 17:37:00', 'Super Lifestyle-Caloocan', '2012-02-29', '2012-03-02', 'Others|Barter Software Training|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0181', 20100603, '2012-03-05 19:00:00', 'SLS/CAL', '2012-03-05', '2012-03-05', 'Others|Installation and Set-up|', 'Approved', '', '540 ', '630', '1020', '6.30', '1080', '9.0');
INSERT INTO `ems_ob` VALUES ('ofb-0182', 20070705, '2012-03-06 15:07:00', 'Nesabel Pateros', '2012-03-06', '2012-03-06', 'Others|support Loury and Raj POS offline (AM)|', 'Approved', '', '480 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0183', 20110402, '2012-03-07 09:56:00', 'SportsHouse', '2012-03-06', '2012-03-06', 'Others|Onsite fixing bugs|', 'Approved', '', '510 ', '585', '1140', '9.15', '1200', '11.30');
INSERT INTO `ems_ob` VALUES ('ofb-0184', 20100603, '2012-03-07 11:43:00', 'Nesabel/Pateros', '2012-03-06', '2012-03-06', 'Others|Onsite Support for pos offline and reservation problem|', 'Approved', '', '450 ', '510', '1080', '9.30', '1140', '11.30');
INSERT INTO `ems_ob` VALUES ('ofb-0185', 20070705, '2012-03-07 19:15:00', 'Nesabel Pateros', '2012-03-07', '2012-03-07', 'Meeting|', 'Approved', 'Meeting at Nesabel Pateros at 8AM.', '360 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0186', 20080801, '2012-03-08 11:58:00', 'COH-Cebu', '2012-02-13', '2012-02-16', 'Others|Barter Software Training for POS|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0187', 20080801, '2012-03-08 11:59:00', 'COH-Cebu', '2012-02-20', '2012-02-24', 'Others|Barter Software Training - Back-office and IT|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0188', 20110402, '2012-03-08 13:15:00', 'SportsHouse', '2012-03-07', '2012-03-07', 'Others|Onsite debugging|', 'Approved', '', '540 ', '600', '1140', '9.0', '1230', '11.30');
INSERT INTO `ems_ob` VALUES ('ofb-0189', 20110402, '2012-03-08 13:16:00', 'SportsHouse', '2012-03-07', '2012-03-07', 'Others|Onsite debugging|', 'Cancelled', '', '540 ', '600', '1140', '9.0', '1230', '11.30');
INSERT INTO `ems_ob` VALUES ('ofb-0190', 20070705, '2012-03-08 13:46:00', 'Super 8 Sta. Rosa', '2012-03-08', '2012-03-08', 'Others|DAtabse to new server. help support|', 'Confirmed', '', '830 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0191', 20120301, '2012-03-08 13:48:00', 'Welcome Supermarket', '2012-03-08', '2012-03-08', 'Meeting|Others|', 'Confirmed', 'w/ Ms. JS', '840 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0192', 20070701, '2012-03-08 13:53:00', 'COH', '2012-03-08', '2012-03-08', 'Others|Flight Back from Cebu|', 'Approved', '', '510 ', '720', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0193', 20100401, '2012-03-09 14:21:00', 'Super8 Head Office', '2012-03-08', '2012-03-08', 'Others|Installation of CAL POS, LAS POS, branch and HO test servers.|', 'Approved', '', '780 ', '870', '1160', '4.50', '1305', '8.45');
INSERT INTO `ems_ob` VALUES ('ofb-0194', 20120301, '2012-03-09 14:49:00', 'Nesabel/Pateros', '2012-03-12', '2012-03-14', 'Others|- Observe & familiarize actual POS transactions activity.|', 'Confirmed', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0195', 20070705, '2012-03-09 14:51:00', 'Nesabel Pateros', '2012-03-09', '2012-03-09', 'Others|(AM) Got database of Nesabel San Rafael|', 'Approved', '', '480 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0196', 20120301, '2012-03-09 14:51:00', 'Nesabel/Bustos, Bulacan', '2012-03-15', '2012-03-18', 'Others|Observe actual POS transaction activities on newly open store.|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0197', 20100301, '2012-03-09 15:37:00', 'Super 8 Visayas', '2012-02-28', '2012-02-28', 'Others|dry run|', 'Approved', '', '780 ', '870', '--Select--', '4.30', '--Select--', '7.0');
INSERT INTO `ems_ob` VALUES ('ofb-0198', 20100301, '2012-03-09 15:40:00', 'Super 8 Visayas', '2012-02-29', '2012-02-29', 'Consultation|Others|dry run|', 'Approved', '', '480 ', '540', '1200', '11.0', '1290', '13.30');
INSERT INTO `ems_ob` VALUES ('ofb-0199', 20100301, '2012-03-09 15:42:00', 'Super 8 Visayas', '2012-03-01', '2012-03-01', 'Consultation|Others|dry run - reset |', 'Approved', '', '480 ', '600', '1320', '12.0', '1380', '15.0');
INSERT INTO `ems_ob` VALUES ('ofb-0200', 20100301, '2012-03-09 15:44:00', 'Super 8 Visayas', '2012-03-02', '2012-03-02', 'Consultation|Others|Live and Monitoring|', 'Approved', '', '420 ', '510', '1435', '15.25', '60', '');
INSERT INTO `ems_ob` VALUES ('ofb-0201', 20070701, '2012-03-10 18:52:00', 'nesabel /Bustos', '2012-03-12', '2012-03-17', 'Others|Go Live pReparation|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0202', 20091203, '2012-03-14 10:06:00', 'Healthway', '2012-03-14', '2012-03-14', 'Others|Take Drug Test @ Healthway Shangrila|', 'Cancelled', '', '300 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0203', 20091203, '2012-03-14 10:07:00', 'Healthway', '2012-03-14', '2012-03-14', 'Others|Take Drug test @ Healthway Shangrila|', 'Cancelled', '', '1020 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0204', 0, '2012-03-14 14:09:00', 'Ripple', '2012-03-14', '2012-03-14', 'Others|Annual Physical Exam in Healthway|', 'Pending for Approval', '', '480 ', '490', '590', '1.40', '610', '2.10');
INSERT INTO `ems_ob` VALUES ('ofb-0205', 20090702, '2012-03-14 14:27:00', 'Ripple', '2012-03-14', '2012-03-14', 'Others|Annual Physical Exam in Healthway|', 'Approved', '', '480 ', '490', '595', '1.45', '610', '2.10');
INSERT INTO `ems_ob` VALUES ('ofb-0206', 20091203, '2012-03-14 18:18:00', 'Healthway', '2012-03-15', '2012-03-15', 'Others|Scheduled Drug Test @ Healthway Shangrila|', 'Confirmed', '', '510 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0207', 20100903, '2012-03-15 17:50:00', 'APE', '2012-03-14', '2012-03-14', 'Others|Annual Physical Exam|', 'Approved', 'Required by HR Dept', '480 ', '485', '--Select--', '1.50', '--Select--', '.20');
INSERT INTO `ems_ob` VALUES ('ofb-0208', 0, '2012-03-15 18:35:00', 'EVER/ HO', '2012-03-15', '2012-03-15', 'Others|Barter MMS and POS Installation for Hermosa Branch|', 'Pending for Approval', '', '480 ', '540', '960', '7.0', '1005', '8.45');
INSERT INTO `ems_ob` VALUES ('ofb-0209', 20100603, '2012-03-15 18:37:00', 'EVER/ HO', '2012-03-15', '2012-03-15', 'Others|Barter MMS and POS Installation for Hermosa Branch|', 'Approved', '', '480 ', '540', '900', '6.0', '1005', '8.45');
INSERT INTO `ems_ob` VALUES ('ofb-0210', 20100301, '2012-03-18 11:39:00', 'Nesabel-Bustos', '2012-03-12', '2012-03-12', 'Consultation|Others|set up and installation|', 'Approved', '', '540 ', '660', '1200', '9.0', '1260', '12.0');
INSERT INTO `ems_ob` VALUES ('ofb-0211', 20100301, '2012-03-18 11:41:00', 'Nesabel-Bustos', '2012-03-13', '2012-03-13', 'Consultation|Others|Set up, installation and configuration|', 'Approved', '', '540 ', '570', '1140', '9.30', '1260', '12.0');
INSERT INTO `ems_ob` VALUES ('ofb-0212', 20100301, '2012-03-18 11:48:00', 'Nesabel-Bustos', '2012-03-14', '2012-03-14', 'Consultation|Others|configuration-set up|', 'Approved', '', '510 ', '540', '1140', '10.0', '1200', '11.30');
INSERT INTO `ems_ob` VALUES ('ofb-0213', 20100301, '2012-03-19 12:07:00', 'Nesabel-Bustos', '2012-03-15', '2012-03-15', 'Consultation|Others|set-up and configuration|', 'Approved', '', '540 ', '570', '1200', '10.30', '1260', '12.0');
INSERT INTO `ems_ob` VALUES ('ofb-0214', 20100301, '2012-03-19 12:09:00', 'Nesabel-Bustos', '2012-03-16', '2012-03-16', 'Consultation|Others|final set-up and reset|', 'Approved', '', '570 ', '585', '1320', '12.15', '1350', '13.0');
INSERT INTO `ems_ob` VALUES ('ofb-0215', 20100301, '2012-03-19 12:11:00', 'Nesabel-Bustos', '2012-03-17', '2012-03-17', 'Consultation|Others|Live|', 'Approved', '', '540 ', '555', '1320', '12.45', '1335', '13.15');
INSERT INTO `ems_ob` VALUES ('ofb-0216', 20100301, '2012-03-19 12:13:00', 'Nesabel-Bustos', '2012-03-18', '2012-03-18', 'Consultation|Others|monitoring|', 'Approved', '', '540 ', '570', '1200', '10.30', '1215', '11.15');
INSERT INTO `ems_ob` VALUES ('ofb-0217', 20120301, '2012-03-21 16:06:00', 'Cavite', '2012-03-22', '2012-03-24', 'Others|', 'Confirmed', 'Prospecting (new clients in Cavite Area)', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0218', 20070801, '2012-03-22 16:53:00', 'Ever-Hermosa', '2012-03-23', '2012-03-23', 'Others|Live and monitoring|', 'Confirmed', '', '--Select-- ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0219', 20070801, '2012-03-22 16:54:00', 'Super Lifestyle-Caloocan', '2012-03-25', '2012-03-25', 'Others|Monitoring with RB|', 'Confirmed', '', '--Select-- ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0220', 20070705, '2012-03-22 18:04:00', 'Magic CWO', '2012-03-26', '2012-03-30', 'Others|GC Manager implementation with TS|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0221', 20100602, '2012-03-23 13:21:00', 'Crazy Crepes', '2012-03-21', '2012-03-21', 'Others|Preventive Maintenance|', 'Approved', 'Preventive Maintenance of Crazy Crepes Vmall and Trinoma', '870 ', '905', '1115', '3.210', '1160', '6.170');
INSERT INTO `ems_ob` VALUES ('ofb-0222', 20100602, '2012-03-23 13:22:00', 'DD''s ', '2012-03-22', '2012-03-22', 'Others|Check Assesment for Offline POS|', 'Approved', '', '510 ', '605', '1055', '7.450', '1165', '11.535');
INSERT INTO `ems_ob` VALUES ('ofb-0223', 20080603, '2012-03-23 13:24:00', 'Classic Character', '2012-03-28', '2012-03-28', 'Delivery|Others|deployment of update on their Denso data collector and deliver the cable.|', 'Confirmed', '', '480 ', '570', '760', '3.10', '825', '5.05');
INSERT INTO `ems_ob` VALUES ('ofb-0224', 20100602, '2012-03-23 13:33:00', 'Contract Packaging', '2012-03-29', '2012-03-29', 'Others|Need to Transfer Bulleon Payroll System from OLD CPU to NEW CPU|', 'Confirmed', '', '480 ', '--Select--', '--Select--', '0.0', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0225', 20100602, '2012-03-23 16:18:00', 'Simplicity', '2012-03-24', '2012-03-24', 'Others|Simplicity Upgrade...|', 'Approved', '', '540 ', '600', '1350', '12.30', '1395', '14.15');
INSERT INTO `ems_ob` VALUES ('ofb-0226', 20120302, '2012-03-25 13:54:00', 'marketing department', '2012-03-23', '2012-03-23', 'Others|bought marketing materials and bday cake for Ms. Cathy Co (ortigas home depot)|', 'Approved', 'Done', '815 ', '835', '910', '1.75', '925', '2.50');
INSERT INTO `ems_ob` VALUES ('ofb-0227', 20120301, '2012-03-25 23:47:00', 'Cavite (Imus/Bacoor)', '2012-03-26', '2012-03-27', 'Others|', 'Confirmed', 'Client prospecting ', '480 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0228', 20120301, '2012-03-25 23:47:00', 'Cavite (Imus/Bacoor)', '2012-03-26', '2012-03-27', 'Others|', 'Cancelled', 'Client prospecting ', '480 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0229', 20100602, '2012-03-26 09:35:00', 'Simplicity', '2012-03-25', '2012-03-25', 'Others|Monitoring|', 'Approved', 'Monitoring After Upgrade', '505 ', '540', '1160', '10.620', '1210', '12.585');
INSERT INTO `ems_ob` VALUES ('ofb-0230', 20100603, '2012-03-26 13:15:00', 'SLS/CAL', '2012-03-20', '2012-03-25', 'Others|Super Life Style - Training, Dry run, live and monitoring|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0231', 20070701, '2012-03-26 14:18:00', 'COH', '2012-03-27', '2012-04-04', 'Others|Pre Live preparations for COH|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0232', 20120302, '2012-03-26 15:46:00', 'Marketing Department', '2012-03-26', '2012-03-26', 'Others|purchased marketing materials|', 'Approved', '', '815 ', '830', '925', '1.35', '940', '2.5');
INSERT INTO `ems_ob` VALUES ('ofb-0233', 20100301, '2012-03-26 22:51:00', 'Nesabel-Bustos', '2012-03-19', '2012-03-19', 'Others|monitoring|', 'Approved', '', '600 ', '615', '1140', '8.45', '1290', '11.30');
INSERT INTO `ems_ob` VALUES ('ofb-0234', 20120301, '2012-03-28 18:35:00', 'Las Pinas, Muntinlupa', '2012-03-29', '2012-03-30', 'Others|', 'Confirmed', 'Client prospecting on area of Las Pinas & Muntinlupa', '480 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0235', 20120302, '2012-03-29 18:14:00', 'IBM ', '2012-03-29', '2012-03-29', 'Others|IBM Ctc Thanksgiving night|', 'Approved', '', '1110 ', '1150', '1335', '3.05', '1340', '3.05');
INSERT INTO `ems_ob` VALUES ('ofb-0236', 20080701, '2012-03-29 18:15:00', 'IBM/CTC', '2012-03-29', '2012-03-29', 'Others|IBM CTC SI Thanksgiving Night|', 'Approved', '', '1110 ', '1150', '1335', '3.05', '1340', '3.05');
INSERT INTO `ems_ob` VALUES ('ofb-0237', 20080101, '2012-03-29 18:19:00', 'Sportshouse/Warehouse', '2012-03-29', '2012-03-29', 'Meeting|', 'Pending for Approval', 'Checkpoint Meeting with Sir Neil (VP Marketing)', '510 ', '570', '705', '2.15', '765', '4.15');
INSERT INTO `ems_ob` VALUES ('ofb-0238', 20070801, '2012-03-29 18:23:00', 'Cardams', '2012-03-30', '2012-03-30', 'Meeting|', 'Confirmed', '', '720 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0239', 20110402, '2012-03-30 08:56:00', 'KLGFS', '2012-03-29', '2012-03-29', 'Others|Onsite Development|', 'Approved', 'Done shooting of preprinted forms in barter print out', '1020 ', '1080', '1260', '3.0', '1350', '5.30');
INSERT INTO `ems_ob` VALUES ('ofb-0240', 20080603, '2012-04-03 09:10:00', 'Atlantic Coatings', '2012-04-02', '2012-04-02', 'Consultation|', 'Approved', 'repair database, and data correct for their pos.mdb', '450 ', '570', '1095', '8.45', '1200', '12.30');
INSERT INTO `ems_ob` VALUES ('ofb-0241', 20070705, '2012-04-03 15:01:00', 'Powerhouse Binondo (HO)', '2012-04-03', '2012-04-03', 'Meeting|', 'Approved', '(AM) Meeting with new operatioins manager, Sir John and Ms Grace with Ms. Beth', '480 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0242', 20100602, '2012-04-03 15:25:00', 'DDS Apalit', '2012-04-04', '2012-04-04', 'Others|Network Virus Removal|', 'Approved', 'Try to remove virus Network virus....', '540 ', '630', '1170', '9.0', '1290', '');
INSERT INTO `ems_ob` VALUES ('ofb-0243', 20100301, '2012-04-03 18:09:00', 'Magic', '2012-03-26', '2012-03-26', 'Others|GC implementation|', 'Approved', '', '660 ', '1080', '1140', '1.0', '1155', '8.15');
INSERT INTO `ems_ob` VALUES ('ofb-0244', 20100301, '2012-04-03 18:10:00', 'Magic', '2012-03-27', '2012-03-27', 'Others|GC Implementation|', 'Approved', '', '540 ', '570', '1080', '8.30', '1200', '11.0');
INSERT INTO `ems_ob` VALUES ('ofb-0245', 20100301, '2012-04-03 18:12:00', 'Magic', '2012-03-28', '2012-03-28', 'Others|GC Implementation|', 'Approved', '', '780 ', '810', '1140', '5.30', '1230', '7.30');
INSERT INTO `ems_ob` VALUES ('ofb-0246', 20100301, '2012-04-03 18:14:00', 'Magic', '2012-03-29', '2012-03-29', 'Others|GC implementation|', 'Approved', '', '540 ', '570', '1410', '14.0', '60', '');
INSERT INTO `ems_ob` VALUES ('ofb-0247', 20080701, '2012-04-03 18:14:00', 'BIR', '2012-04-03', '2012-04-03', 'Others|FFup pending POS Permit Applications|', 'Approved', '', '810 ', '840', '960', '2.0', '980', '2.50');
INSERT INTO `ems_ob` VALUES ('ofb-0248', 20100301, '2012-04-03 18:16:00', 'Magic', '2012-03-29', '2012-03-29', 'Others|GC implementation|', 'Cancelled', '', '540 ', '570', '1410', '14.0', '60', '');
INSERT INTO `ems_ob` VALUES ('ofb-0249', 20070705, '2012-04-03 18:21:00', 'Magic CWO', '2012-03-26', '2012-03-30', 'Others|Implementation of GC Manager with TS|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0250', 20100301, '2012-04-03 18:27:00', 'Magic', '2012-03-30', '2012-03-30', 'Others|GC Implementation and Monitoring|', 'Approved', '', '600 ', '630', '1110', '8.0', '1380', '13.0');
INSERT INTO `ems_ob` VALUES ('ofb-0251', 20100603, '2012-04-10 18:18:00', 'COH - CEBU', '2012-03-27', '2012-04-04', 'Others|COH - Installation, set-up and assisted in dry run.|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0252', 20070801, '2012-04-11 08:46:00', 'Cardams', '2012-04-10', '2012-04-11', 'Others|BPM|', 'Approved', '', '--Select-- ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0253', 20080101, '2012-04-11 11:58:00', 'Ripple', '2012-04-10', '2012-04-10', 'Meeting|', 'Pending for Approval', 'R&D Dinner Meeting', '1095 ', '1125', '1255', '2.10', '1260', '2.05');
INSERT INTO `ems_ob` VALUES ('ofb-0254', 20080603, '2012-04-11 19:30:00', 'Lee Plaza', '2012-04-12', '2012-04-14', 'Others|transfer the data into temporary server|', 'Confirmed', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0255', 20070801, '2012-04-16 08:02:00', 'Cardams', '2012-04-16', '2012-04-16', 'Others|BPM|', 'Approved', '', '--Select-- ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0256', 20100603, '2012-04-16 08:16:00', 'Cardams / Megamall', '2012-04-16', '2012-04-16', 'Others|Interview barter user for current busines process - BPA|', 'Approved', '', '555 ', '600', '955', '5.55', '960', '6.45');
INSERT INTO `ems_ob` VALUES ('ofb-0257', 20100301, '2012-04-16 09:04:00', 'Kevin', '2012-04-11', '2012-04-13', 'Meeting|Others|BPA presentation, installation and revise schedule|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0258', 20070705, '2012-04-16 18:06:00', 'Kevin Enterprises', '2012-04-11', '2012-04-13', 'Meeting|', 'Approved', '1. BPA (Business Process sign-off) this is to formally recognize our proposed business process, (I emailed this earlier for your review)\r\n2. Server Setup (this was not done during our last visit)\r\n3. Monitor the encoding of items (if there are any further questions)\r\n4. Site-visit\r\n5. Plotting of final schedule (as per you advise earlier, our target live will be on the month of May)', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0259', 20120301, '2012-04-16 23:45:00', 'Batangas/Laguna', '2012-04-17', '2012-04-20', 'Others|Potential client''s mapping|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0260', 20070701, '2012-04-17 09:22:00', 'PC Works', '2012-04-17', '2012-04-17', 'Meeting|', 'Confirmed', 'meeting with  Client for the planned implementation', '780 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0261', 20080604, '2012-04-17 16:00:00', 'Super 8 and Primer', '2012-04-18', '2012-04-18', 'Meeting|', 'Confirmed', '10:30am meeting with Super 8\r\n12:00nn  Lunch meeting with Primer', '450 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0262', 20080701, '2012-04-19 18:17:00', 'iRipple', '2012-04-19', '2012-04-19', 'Others|Follow up on Pending PTUSM & Inquiry on Server Accreditation|', 'Approved', '', '940 ', '965', '--Select--', '0.05', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0263', 20080604, '2012-04-19 19:08:00', 'Epson', '2012-04-20', '2012-04-20', 'Meeting|', 'Confirmed', 'Discuss the new rules in the registration of accounts for special pricing', '810 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0264', 20080701, '2012-04-20 10:09:00', 'iRipple', '2012-05-10', '2012-05-10', 'Others|IBM Technology Conference & Expo 2012 at Makati Shangrila Hotel|', 'Confirmed', '', '--Select-- ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0265', 20100603, '2012-04-20 18:05:00', 'CARDAMS/HO', '2012-04-20', '2012-04-20', 'Others|BPA Presentation|', 'Approved', '', '540 ', '600', '930', '5.30', '1020', '8.0');
INSERT INTO `ems_ob` VALUES ('ofb-0266', 20070701, '2012-04-22 12:45:00', 'iRipple', '2012-04-19', '2012-04-19', 'Meeting|', 'Approved', 'meeting with sir VJ in Wack Wack', '420 ', '510', '630', '2.0', '690', '4.30');
INSERT INTO `ems_ob` VALUES ('ofb-0267', 20070701, '2012-04-22 12:47:00', 'iRipple', '2012-04-20', '2012-04-20', 'Meeting|', 'Approved', 'Meeting with sir VJ for project pipeline', '420 ', '510', '630', '2.0', '690', '4.30');
INSERT INTO `ems_ob` VALUES ('ofb-0268', 20070701, '2012-04-22 12:49:00', 'Magic', '2012-04-23', '2012-04-23', 'Meeting|', 'Confirmed', '', '420 ', '780', '900', '2.0', '1260', '14.0');
INSERT INTO `ems_ob` VALUES ('ofb-0269', 20070701, '2012-04-22 12:49:00', 'lee plaza', '2012-04-24', '2012-04-27', 'Meeting|', 'Approved', 'Kick Off an Gap analysis', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0270', 20080701, '2012-04-23 09:29:00', 'Epson', '2012-04-20', '2012-04-20', 'Others|Epson Open Discussion|', 'Approved', '', '840 ', '850', '1035', '3.05', '1050', '3.05');
INSERT INTO `ems_ob` VALUES ('ofb-0271', 20100603, '2012-04-23 13:26:00', 'EVER/RECTO', '2012-04-23', '2012-04-23', 'Others|Panghulo - Server and POS installation|', 'Approved', '', '810 ', '840', '1050', '3.30', '1140', '5.30');
INSERT INTO `ems_ob` VALUES ('ofb-0272', 20070804, '2012-04-23 14:53:00', 'Bluefields, Iloilo', '2012-04-02', '2012-04-02', 'Meeting|', 'Approved', 'Demo Meeting', '780 ', '870', '1050', '3.0', '1110', '5.30');
INSERT INTO `ems_ob` VALUES ('ofb-0273', 20070804, '2012-04-23 14:57:00', 'Foodman Supermarket Silay', '2012-04-04', '2012-04-04', 'Meeting|', 'Approved', 'Demo Meeting and site visit, Introduced Fracy to Munsterific Gen. Manager.\r\n', '360 ', '600', '840', '4.0', '1170', '13.30');
INSERT INTO `ems_ob` VALUES ('ofb-0274', 20070801, '2012-04-24 09:33:00', 'Cardams', '2012-04-20', '2012-04-20', 'Meeting|Others|BPA presentation, issue logs|', 'Approved', '', '--Select-- ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0275', 20110402, '2012-04-24 10:07:00', 'Maldive', '2012-04-23', '2012-04-23', 'Others|Onsite fixing of pre printed report (dev)|', 'Approved', '', '450 ', '660', '1050', '6.30', '1260', '13.30');
INSERT INTO `ems_ob` VALUES ('ofb-0276', 20100602, '2012-04-24 13:53:00', 'SCV Angono', '2012-04-25', '2012-04-25', 'Others|Need to reinstall POS1 due to corrupted OS files|', 'Approved', '', '540 ', '630', '745', '1.55', '850', '5.10');
INSERT INTO `ems_ob` VALUES ('ofb-0277', 0, '2012-04-24 15:42:00', 'Ortigas/GSC', '2012-04-20', '2012-04-20', 'Meeting|', 'Pending for Approval', 'Meeting with IT (Sir Sherwin) to discuss RLS-SAP Integration and other RLS/TLS issue concerns.', '510 ', '540', '960', '7.0', '990', '8.0');
INSERT INTO `ems_ob` VALUES ('ofb-0278', 20080101, '2012-04-24 15:44:00', 'Ortigas/GSC', '2012-04-20', '2012-04-20', 'Meeting|', 'Pending for Approval', 'Meeting with IT (Sir Sherwin) to discuss RLS SAP Data Integration and RLS/TLS issue concerns.', '510 ', '540', '960', '7.0', '990', '8.0');
INSERT INTO `ems_ob` VALUES ('ofb-0279', 20071002, '2012-04-25 13:46:00', 'Sir Willy Tieng', '2012-04-26', '2012-04-26', 'Others|Pick up documents from house of Sir Willy Tieng at Magallanes Vill., Makati|', 'Confirmed', '', '480 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0280', 20120302, '2012-04-26 14:24:00', 'EPSON', '2012-04-25', '2012-04-25', 'Others|ECP Business Review and Awards Night|', 'Cancelled', '', '1050 ', '1110', '1350', '4.0', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0281', 20120302, '2012-04-26 14:24:00', 'EPSON', '2012-04-25', '2012-04-25', 'Others|ECP Business Review and Awards Night|', 'Cancelled', '', '1050 ', '1110', '1350', '4.0', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0282', 20120302, '2012-04-26 14:43:00', 'EPSON', '2012-04-25', '2012-04-25', 'Others|EPSON Business Review and Awards Night|', 'Approved', '', '1050 ', '1110', '1350', '4.0', '1380', '5.35');
INSERT INTO `ems_ob` VALUES ('ofb-0283', 20080701, '2012-04-27 09:15:00', 'Epson', '2012-04-25', '2012-04-25', 'Others|Epson Business Review and Awards Night|', 'Approved', '', '1020 ', '1035', '1340', '5.05', '1405', '6.05');
INSERT INTO `ems_ob` VALUES ('ofb-0284', 20080701, '2012-04-27 16:15:00', 'Epson', '2012-04-26', '2012-04-26', 'Others|Epson Label POS Printer Launching|', 'Approved', '', '795 ', '840', '1110', '4.30', '1140', '5.45');
INSERT INTO `ems_ob` VALUES ('ofb-0285', 20080701, '2012-04-27 16:17:00', 'GABC/ BIR', '2012-04-27', '2012-04-27', 'Others|Delivery of 2 units to GABC, Billing Statement and Contract Acquisition and Follow up of BIR Pending POS Permit (43A)|', 'Approved', '', '795 ', '840', '955', '1.55', '990', '3.15');
INSERT INTO `ems_ob` VALUES ('ofb-0286', 20100602, '2012-04-30 13:22:00', 'Unisilver HO', '2012-04-26', '2012-04-26', 'Consultation|', 'Approved', 'Need to check Server that cannot login', '1020 ', '1125', '1290', '2.45', '1350', '5.30');
INSERT INTO `ems_ob` VALUES ('ofb-0287', 20100602, '2012-04-30 13:22:00', 'Unisilver HO', '2012-04-26', '2012-04-26', 'Consultation|', 'Denied', 'Need to check Server that cannot login', '1020 ', '1125', '1290', '2.45', '1350', '5.30');
INSERT INTO `ems_ob` VALUES ('ofb-0288', 20120301, '2012-04-30 14:03:00', 'MS Masuwerte/Batangas', '2012-05-02', '2012-05-02', 'Others|Network building w/ client.|', 'Approved', 'Schedule cancelled due to Deparmental Orientation by Ms. Eiz.', '480 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0289', 20100602, '2012-04-30 14:29:00', 'unisilver HO', '2012-04-27', '2012-04-27', 'Others|Need to resolved issue with windows server logon. 1. Repair window using windows server 2003 CD. 2. user computer management while installing OS to access and set new User and password to logon to Windows Server 2003|', 'Approved', '', '1055 ', '1155', '1365', '3.30', '1430', '5.05');
INSERT INTO `ems_ob` VALUES ('ofb-0290', 20100602, '2012-05-02 09:29:00', 'Simplicity Muzon', '2012-05-01', '2012-05-01', 'Others|Need to fix Price Verifier. |', 'Approved', '', '915 ', '960', '1215', '4.15', '1350', '7.15');
INSERT INTO `ems_ob` VALUES ('ofb-0291', 0, '2012-05-02 13:48:00', 'Powerhouse Makati', '2012-05-02', '2012-05-02', 'Others|Training for Back End users|', 'Pending for Confirmation', '', '870 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0292', 20070701, '2012-05-02 13:49:00', 'Powerhouse Makati', '2012-05-02', '2012-05-02', 'Others|Training|', 'Denied', '', '870 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0293', 20100602, '2012-05-03 10:48:00', 'Unisilver', '2012-05-02', '2012-05-02', 'Others|Fix userlogin of Server|', 'Approved', '', '1020 ', '1125', '1315', '3.10', '1380', '5.05');
INSERT INTO `ems_ob` VALUES ('ofb-0294', 20100602, '2012-05-03 20:16:00', 'New Creation', '2012-05-03', '2012-05-03', 'Others|Need to install barter on 2 new workstion and 1 old workstation|', 'Approved', '', '785 ', '850', '995', '2.25', '1045', '4.20');
INSERT INTO `ems_ob` VALUES ('ofb-0295', 20080801, '2012-05-06 10:58:00', 'Cardams - Ermita Manila', '2012-05-07', '2012-05-09', 'Others|Barter training for client|', 'Pending for Confirmation', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0296', 20080801, '2012-05-06 11:01:00', 'Ocular - Batangas', '2012-04-27', '2012-04-27', 'Others|Ocular for company summer outing|', 'Pending for Approval', '', '360 ', '420', '1080', '11.0', '1260', '15.0');
INSERT INTO `ems_ob` VALUES ('ofb-0297', 20100603, '2012-05-06 19:26:00', 'LEE/Dumaguete', '2012-04-24', '2012-04-26', 'Others|GAP analysis|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0298', 20100603, '2012-05-06 19:28:00', 'EVER/RECTO', '2012-04-27', '2012-04-27', 'Others|G.T. Installation|', 'Approved', '', '840 ', '900', '960', '1.0', '1020', '3.0');
INSERT INTO `ems_ob` VALUES ('ofb-0299', 20100603, '2012-05-06 19:30:00', 'POWERHOUSE/BINONDO', '2012-04-30', '2012-04-30', 'Others|Makati - branch set-up and ever G.T installation|', 'Approved', '', '510 ', '540', '1020', '8.0', '1140', '10.30');
INSERT INTO `ems_ob` VALUES ('ofb-0300', 20100603, '2012-05-06 19:31:00', 'POWERHOUSE/BINONDO', '2012-05-02', '2012-05-05', 'Others|Backend and POS training and exams|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0301', 20090802, '2012-05-07 13:27:00', 'iRipple', '2012-05-16', '2012-05-16', 'Others|Will go to DFA with sir Ben and Ms. Liza for the passport application.|', 'Confirmed', 'Passport application.', '330 ', '450', '600', '2.30', '720', '6.30');
INSERT INTO `ems_ob` VALUES ('ofb-0302', 20120301, '2012-05-07 15:37:00', 'Cyber POS, Cainta', '2012-05-03', '2012-05-03', 'Others|Checking & assessment of competitor''s location.|', 'Approved', '', '240 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0303', 20120301, '2012-05-07 15:41:00', 'Nissan U.N.', '2012-05-07', '2012-05-07', 'Others|Installation of back-up sensor.|', 'Approved', 'To resched installation due to unavailability of gadget.', '570 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0304', 20120301, '2012-05-07 15:45:00', 'Batangas/Q.C./Pasig', '2012-05-08', '2012-05-11', 'Others|Others|', 'Approved', 'Courtesy visits to potential clients:\r\n1. MS Masuwerte\r\n2. Mightee Mart\r\n3. Chef Tony', '', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0305', 20070801, '2012-05-07 17:13:00', 'Cardams', '2012-05-03', '2012-05-09', 'Others|May 3-4: Installation for training units\r\nMay 7-9: Barter training|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0306', 20080701, '2012-05-08 19:05:00', 'iRipple', '2012-05-08', '2012-05-08', 'Others|Pick up of System Generated PTUSM of clients|', 'Approved', '', '820 ', '840', '875', '0.35', '900', '1.20');
INSERT INTO `ems_ob` VALUES ('ofb-0307', 20100602, '2012-05-08 19:16:00', 'SCV Angono', '2012-05-03', '2012-05-03', 'Others|Need to fix Server/pos OS problem|', 'Cancelled', '', '540 ', '630', '740', '1.50', '825', '4.45');
INSERT INTO `ems_ob` VALUES ('ofb-0308', 20100602, '2012-05-08 19:17:00', 'SCV Tandang Sora', '2012-05-07', '2012-05-07', 'Others|Need to fix Server/Pos OS PRoblem|', 'Approved', '', '840 ', '910', '1005', '1.35', '1065', '3.45');
INSERT INTO `ems_ob` VALUES ('ofb-0309', 20070701, '2012-05-09 09:49:00', 'COH', '2012-05-08', '2012-05-08', 'Others|XML Revision internal Testing with SAP Team|', 'Approved', '', '300 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0310', 20070701, '2012-05-09 09:53:00', 'Prince Blake HO', '2012-05-09', '2012-05-10', 'Others|Planning for CLP and  CLP Configuration and Training|', 'Approved', '', '420 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0311', 20071002, '2012-05-09 16:05:00', 'BDO Unibank Makati', '2012-05-11', '2012-05-11', 'Others|Pick up check of cash dividends for Directors|', 'Confirmed', '', '930 ', '975', '990', '0.15', '1035', '1.45');
INSERT INTO `ems_ob` VALUES ('ofb-0312', 20080701, '2012-05-10 14:36:00', 'iRipple/IBM', '2012-05-10', '2012-05-10', 'Others|IBM Technology Update|', 'Approved', '', '430 ', '520', '770', '4.10', '820', '6.30');
INSERT INTO `ems_ob` VALUES ('ofb-0313', 20120301, '2012-05-14 11:18:00', 'Nissan - U.N. Ave.', '2012-05-14', '2012-05-14', 'Others|Vehicle Maintenance|', 'Approved', 'Installation of Back-up sensor', '540 ', '--Select--', '--Select--', '', '600', '');
INSERT INTO `ems_ob` VALUES ('ofb-0314', 20120301, '2012-05-14 11:20:00', 'Robinson''s Warehouse', '2012-05-14', '2012-05-14', 'Others|Courtesy visit.|', 'Confirmed', 'Courtesy visit to warehouse manager for possible leads, info & referrals.', '780 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0315', 20070705, '2012-05-15 10:45:00', 'Magic CWO and Mangaldan', '2012-04-23', '2012-05-03', 'Network|Consultation|Meeting|', 'Approved', 'Meeting, CWO and Mangaldan upgrade', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0316', 20070705, '2012-05-15 10:47:00', 'Kevin Enterprises', '2012-05-06', '2012-05-11', 'Consultation|', 'Approved', 'Setup training. Training of backend and POS with TS', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0317', 20081101, '2012-05-15 11:35:00', 'COH', '2012-05-17', '2012-05-18', 'Meeting|Others|Client UAT with SAP|', 'Confirmed', '', '420 ', '540', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0318', 20100602, '2012-05-15 14:13:00', 'Contract Packaging', '2012-05-15', '2012-05-15', 'Others|Need to install Bullion on new Computer|', 'Approved', '', '510 ', '600', '690', '1.30', '840', '5.30');
INSERT INTO `ems_ob` VALUES ('ofb-0319', 20100301, '2012-05-16 10:32:00', 'Magic', '2012-04-23', '2012-04-27', 'Others|Systems Upgrade|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0320', 20100301, '2012-05-16 10:33:00', 'Magic', '2012-04-30', '2012-05-04', 'Others|Systems Upgrade and Monitoring|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0321', 20100301, '2012-05-16 10:34:00', 'Kevin', '2012-05-06', '2012-05-11', 'Others|training|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0322', 20080801, '2012-05-16 12:06:00', 'DFA', '2012-05-16', '2012-05-16', 'Others|Passport processing as required by Ms. Julie for official business trip outside of the country.|', 'Approved', '', '330 ', '450', '600', '2.30', '690', '6.0');
INSERT INTO `ems_ob` VALUES ('ofb-0323', 20100603, '2012-05-21 09:47:00', 'POWERHOUSE/MAKATI', '2012-05-10', '2012-05-10', 'Others|POS/Server Set-up|', 'Approved', '', '585 ', '600', '1050', '7.30', '1080', '8.15');
INSERT INTO `ems_ob` VALUES ('ofb-0324', 20100603, '2012-05-21 09:51:00', 'EVER/GT De Leon', '2012-05-11', '2012-05-11', 'Others|Live Monitoring|', 'Approved', '', '360 ', '510', '1020', '8.30', '1140', '13.0');
INSERT INTO `ems_ob` VALUES ('ofb-0325', 20100603, '2012-05-21 09:55:00', 'Prince Blake/Cebu', '2012-05-14', '2012-05-15', 'Others|CLP Set-up and live monitoring|', 'Approved', '', '570 ', '600', '2700', '35.0', '2730', '36.0');
INSERT INTO `ems_ob` VALUES ('ofb-0326', 20100603, '2012-05-21 09:57:00', 'POWERHOUSE/MAKATI', '2012-05-16', '2012-05-16', 'Others|POS/Server data and license transfer|', 'Approved', '', '860 ', '880', '1080', '3.20', '1110', '4.10');
INSERT INTO `ems_ob` VALUES ('ofb-0327', 20100603, '2012-05-21 09:58:00', 'POWERHOUSE/MAKATI', '2012-05-17', '2012-05-19', 'Others|Final Set-up, dry run and live monitoring|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0328', 20100401, '2012-05-21 11:16:00', 'Cheers', '2012-05-18', '2012-05-21', 'Others|Upgrade to Barter 8.5.4D|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0329', 20080603, '2012-05-21 11:28:00', 'Lee Plaza', '2012-05-15', '2012-05-17', 'Others|transferring of data from temporary server into new server|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0330', 20060801, '2012-05-21 11:43:00', 'Cheers Mart ', '2012-05-18', '2012-05-21', 'Others|Barter Upgrade|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0331', 20090702, '2012-05-21 11:46:00', 'Cheers Mart - Isabela', '2012-05-18', '2012-05-21', 'Others|Observation of Client Barter MMS Upgrade\r\n- Monitored the Barter MMS Upgrade\r\n- Observed the activities prior to upgrade, during the upgrade and after the upgrade|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0332', 20100401, '2012-05-21 15:47:00', 'Shoppers', '2012-05-18', '2012-05-18', 'Others|Onsite deployment of script provided by DEV|', 'Approved', '', '420 ', '570', '630', '1.0', '780', '6.0');
INSERT INTO `ems_ob` VALUES ('ofb-0333', 20100602, '2012-05-22 08:52:00', 'Zolberg/Contract', '2012-05-17', '2012-05-17', 'Others|Need to Transfer Bullion from old PC to new PC|', 'Approved', '', '510 ', '580', '660', '1.20', '780', '4.30');
INSERT INTO `ems_ob` VALUES ('ofb-0334', 20100602, '2012-05-22 09:44:00', 'Unisilver', '2012-05-22', '2012-05-22', 'Others|Need to install and setup Unisilver New Server |', 'Approved', '', '795', '885', '1430', '9.05', '1435', '');
INSERT INTO `ems_ob` VALUES ('ofb-0335', 20070701, '2012-05-23 22:50:00', 'shoppers zamboanga', '2012-05-24', '2012-05-25', 'Others|Bpa for back end|', 'Confirmed', '', '185 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0336', 20070701, '2012-05-23 22:52:00', 'blue fields', '2012-05-15', '2012-05-15', 'Meeting|', 'Approved', '', '390 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0337', 20070701, '2012-05-23 22:53:00', 'sari sari', '2012-05-16', '2012-05-16', 'Meeting|', 'Approved', '', '420 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0338', 20070701, '2012-05-23 22:55:00', 'coh', '2012-05-17', '2012-05-18', 'Others|Sap integration uat|', 'Approved', '', '390 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0339', 20070701, '2012-05-23 22:55:00', 'coh makati', '2012-05-21', '2012-05-21', 'Meeting|', 'Approved', '', '420 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0340', 20070701, '2012-05-23 22:58:00', 'coh', '2012-05-08', '2012-05-09', 'Meeting|', 'Approved', '', '360 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0341', 20070701, '2012-05-23 23:00:00', 'prince blake', '2012-05-10', '2012-05-11', 'Others|Clp uat and live prep|', 'Approved', '', '420 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0342', 20070701, '2012-05-23 23:03:00', 'blue fields', '2012-05-29', '2012-05-29', 'Others|Bpa presentation and sow discusion|', 'Confirmed', '', '540 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0343', 20070701, '2012-05-23 23:04:00', 'sari sari', '2012-05-30', '2012-05-31', 'Others|Training|', 'Confirmed', '', '00 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0344', 20070701, '2012-05-23 23:05:00', 'sari sari', '2012-05-30', '2012-05-31', 'Others|Training|', 'Confirmed', '', '00 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0345', 20100301, '2012-05-25 09:55:00', 'Magic', '2012-05-21', '2012-05-23', 'Others|Supposed to be upgrade. Onsite issues checking.|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0346', 20120301, '2012-05-25 18:28:00', 'Jolliza''s/Henzon', '2012-05-26', '2012-05-26', 'Meeting|', 'Confirmed', 'with FN:\r\n- Product Presentation to Jolliza''s Mart & Rice Dealer (Calamba, Laguna)\r\n- Store Visit to Henzon Comm''l Center (Batangas City)', '570 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0347', 20091203, '2012-05-28 09:01:00', 'Healthway Shangrila', '2012-05-28', '2012-05-28', 'Others|Pick Up @healthway shang rila the Drug test result of Aldrin Dela cruz|', 'Pending for Approval', '', '420 ', '495', '530', '0.35', '545', '2.5');
INSERT INTO `ems_ob` VALUES ('ofb-0348', 20070705, '2012-05-28 13:25:00', 'Magic CWO', '2012-05-28', '2012-05-31', 'Network|Meeting|', 'Approved', 'Upgrade of Magic St. Cruz and Magic Binmaley', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0349', 20060801, '2012-05-29 11:31:00', 'ThreeSixty Pharmacy', '2012-05-24', '2012-05-28', 'Others|May 24, 2012 - CLP Meeting with ThreeSixty Pharmacy\r\nMay 25, 2012 to May 28, 2012 - ThreeSixty Pharmacy Event|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0350', 20120301, '2012-05-30 10:25:00', 'Rob/CDI/Ministop', '2012-05-30', '2012-05-30', 'Others|Secure accreditation forms & contact persons|', 'Approved', '', '540 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0351', 20120301, '2012-05-30 10:26:00', 'Nissan - U.N. Ave.', '2012-05-31', '2012-05-31', 'Others|PMS (Preventive Maintenance Service) of TQU-476, 5,000 KMS.|', 'Confirmed', '', '420 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0352', 20120301, '2012-05-30 20:55:00', 'Zuellig Pharma', '2012-05-29', '2012-05-29', 'Meeting|', 'Approved', 'with Ms. JK & Mr. Raymund Lukban (Zuellig)', '960 ', '1020', '1140', '2.0', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0353', 20100301, '2012-05-31 14:26:00', 'Parmasiyutika', '2012-05-29', '2012-05-31', 'Others|PCount Training / Physical Count|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0354', 20100301, '2012-06-01 16:43:00', 'Kevin', '2012-06-04', '2012-06-10', 'Consultation|Others|Set-up, Dry Run, Pre-live and Opening|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0355', 20100602, '2012-06-04 08:46:00', 'Magic', '2012-05-31', '2012-05-31', 'Meeting|', 'Approved', 'Attend meeting on Magic', '345 ', '660', '1020', '6.0', '1350', '16.45');
INSERT INTO `ems_ob` VALUES ('ofb-0356', 20100602, '2012-06-04 08:48:00', 'Atlantic Coatings', '2012-06-01', '2012-06-01', 'Others|Need to reinstall Stand alone Server / POS|', 'Approved', '', '540 ', '870', '1230', '6.0', '1350', '13.30');
INSERT INTO `ems_ob` VALUES ('ofb-0357', 20120301, '2012-06-04 12:49:00', 'Jolliza''s/Calamba, Laguna', '2012-06-06', '2012-06-06', 'Meeting|', 'Confirmed', 'Submit & discuss quotation to Mrs. De leon w/ FN', '600', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0358', 20120301, '2012-06-04 12:51:00', 'Angono Area', '2012-06-06', '2012-06-06', 'Others|Potential client mapping to Angono, Rizal area|', 'Confirmed', '', '750 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0359', 20120301, '2012-06-04 18:25:00', 'Healthway', '2012-06-05', '2012-06-05', 'Others|', 'Confirmed', 'Pre-employment examination', '420 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0360', 20120301, '2012-06-04 18:27:00', 'Cainta ', '2012-06-05', '2012-06-05', 'Others|Potential Client mapping in Cainta, Rizal area|', 'Confirmed', '', '720 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0361', 20120301, '2012-06-04 18:30:00', 'Taytay, Rizal', '2012-06-07', '2012-06-07', 'Others|All day potential client mapping in Taytay, Rizal|', 'Confirmed', '', '480 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0362', 20070701, '2012-06-05 09:35:00', 'COH', '2012-06-07', '2012-06-14', 'Others|Final UAT(2) and pre live preparations|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0363', 20081101, '2012-06-05 19:26:00', 'COH', '2012-06-06', '2012-06-08', 'Meeting|Others|UAT|', 'Confirmed', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0364', 20070701, '2012-06-10 20:32:00', 'kevin ent.', '2012-06-12', '2012-06-12', 'Others|Go live visit and monitoring|', 'Confirmed', '', '00 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0365', 20070701, '2012-06-10 20:35:00', 'coh', '2012-06-13', '2012-06-15', 'Others|Set up of production server and master data upload in preparation for go live|', 'Confirmed', 'A', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0366', 20080603, '2012-06-13 13:24:00', 'KLGFS', '2012-06-13', '2012-06-13', 'Meeting|', 'Approved', 'meeting regarding negative available qty.', '450 ', '540', '690', '2.30', '790', '5.40');
INSERT INTO `ems_ob` VALUES ('ofb-0367', 20070801, '2012-06-13 20:09:00', 'Cardams', '2012-06-07', '2012-06-08', 'Others|1. Setup and configuration of server and 5 POS\r\n2. Data importation and checking\r\n3. Barter installation for server, POS and workstations\r\n--with Ralphy|', 'Approved', '', '--Select-- ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0368', 20070801, '2012-06-13 20:10:00', 'Shoppers-Zamboanga', '2012-06-09', '2012-06-09', 'Meeting|', 'Approved', 'with Jenilyn See at Shoppers'' Binondo', '--Select-- ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0369', 20070801, '2012-06-13 20:11:00', 'Cardams', '2012-06-11', '2012-06-13', 'Others|On-site setup and configuration (Megamall and North Edsa branch)|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0370', 20091203, '2012-06-14 08:36:00', 'Philhealth Shaw Blvd', '2012-06-14', '2012-06-14', 'Others|We will attend seminar with Jona Pancho|', 'Cancelled', '', '505 ', '540', '720', '3.0', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0371', 20091203, '2012-06-14 08:36:00', 'Philhealth Shaw Blvd', '2012-06-14', '2012-06-14', 'Others|We will attend seminar with Jona Pancho|', 'Pending for Approval', '', '505 ', '540', '720', '3.0', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0372', 20100301, '2012-06-14 09:07:00', 'Ever', '2012-06-13', '2012-06-13', 'Others|installation and configuration|', 'Approved', '', '480 ', '720', '1230', '8.30', '1380', '15.0');
INSERT INTO `ems_ob` VALUES ('ofb-0373', 20100401, '2012-06-14 16:57:00', 'DDS', '2012-06-13', '2012-06-13', 'Others|Update 6 POS from old cpu to new cpu|', 'Approved', 'till 1:00 am, June 14. total duration should be 18:30', '390 ', '430', '1350', '15.20', '1435', '17.25');
INSERT INTO `ems_ob` VALUES ('ofb-0374', 20120601, '2012-06-14 16:59:00', 'DD''s Supermarket', '2012-06-13', '2012-06-14', 'Others|Update 6 POS at DD''s Supermarket|', 'Approved', 'June 14. - till 1:00 am, total duration should be 18:30', '420 ', '780', '2760', '33.0', '2875', '40.55');
INSERT INTO `ems_ob` VALUES ('ofb-0375', 20110402, '2012-06-15 15:29:00', 'KLGFS', '2012-06-13', '2012-06-13', 'Meeting|Others|Meeting with KLGFS to cater their concerns about negative running item quantity and investigate onsite on how to fix the problem|', 'Cancelled', '', '450 ', '570', '1350', '13.0', '1435', '16.25');
INSERT INTO `ems_ob` VALUES ('ofb-0376', 20070801, '2012-06-18 10:06:00', 'Cardams', '2012-06-15', '2012-06-15', 'Others|Setup data connection to HO and other configuration|', 'Approved', '', '--Select-- ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0377', 20100301, '2012-06-19 09:30:00', 'Super 8', '2012-06-18', '2012-06-18', 'Others|installation and configuration of server and workstation|', 'Approved', '', '540 ', '600', '900', '5.0', '1140', '10.0');
INSERT INTO `ems_ob` VALUES ('ofb-0378', 20080603, '2012-06-19 10:03:00', 'Zolberg', '2012-06-18', '2012-06-18', 'Consultation|', 'Approved', 'check their BULLION Program.', '420 ', '600', '900', '5.0', '1050', '10.30');
INSERT INTO `ems_ob` VALUES ('ofb-0379', 20100603, '2012-06-19 10:48:00', 'Sari2 Breadstore/Iloilo', '2012-05-23', '2012-06-17', 'Consultation|Delivery|Meeting|', 'Approved', 'Installation, Training, Dry Run and Live monitoring', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0380', 20070705, '2012-06-19 15:51:00', 'Kevin Enterprises Cagayan De Oro', '2012-06-07', '2012-06-14', 'Consultation|Others|Dry-Run, Pre-live, Live, Monitoring of Super Kei Quirino|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0381', 20120301, '2012-06-20 08:25:00', 'Uniqlo/Pasay', '2012-06-20', '2012-06-20', 'Others|check store set-up, operation & system.|', 'Confirmed', '', '570 ', '600', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0382', 20120301, '2012-06-21 13:42:00', 'DTI-Makati', '2012-06-21', '2012-06-21', 'Others|Secure client''s database.|', 'Approved', '', '600 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0383', 20120301, '2012-06-21 14:35:00', 'Unimart-Greenhills', '2012-06-21', '2012-06-21', 'Others|Store Visit|', 'Confirmed', '', '900 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0384', 20100603, '2012-06-21 18:34:00', 'POWERHOUSE/FAIRVIEW', '2012-06-20', '2012-06-20', 'Others|', 'Approved', 'Checking and fixing of sales problem', '510 ', '780', '1080', '5.0', '1170', '11.0');
INSERT INTO `ems_ob` VALUES ('ofb-0385', 20100603, '2012-06-21 18:35:00', 'EVER/PATEROS', '2012-06-22', '2012-06-22', 'Others|ONSITE MONITORING|', 'Approved', 'ONSITE LIVE MONITORING', '--Select-- ', '540', '840', '5.0', '900', '');
INSERT INTO `ems_ob` VALUES ('ofb-0386', 20120601, '2012-06-22 19:26:00', 'DD''s Supermarket', '2012-06-21', '2012-06-21', 'Others|Set up POS|', 'Approved', '', '420 ', '630', '1260', '10.30', '1435', '16.55');
INSERT INTO `ems_ob` VALUES ('ofb-0387', 20120301, '2012-06-23 16:29:00', 'Client Mappint/Nueva Ecija', '2012-06-25', '2012-06-27', 'Others|Potential client mapping in Nueva Ecija|', 'Confirmed', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0388', 20120301, '2012-06-23 16:30:00', 'PRA/Quezon City', '2012-06-28', '2012-06-28', 'Others|PRA|', 'Confirmed', '', '690', '780', '1050', '4.30', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0389', 20120301, '2012-06-23 16:30:00', 'PRA/Quezon City', '2012-06-28', '2012-06-28', 'Others|PRA|', 'Cancelled', 'Double entry only.  (cancelled)', '540 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0390', 20081101, '2012-06-25 13:40:00', 'Mydin', '2012-06-10', '2012-06-13', 'Meeting|Others|FSD/Data Gathering|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0391', 20100301, '2012-06-27 09:46:00', 'Lee Plaza', '2012-06-20', '2012-06-22', 'Others|Product and Profile Management training|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0392', 20100301, '2012-06-27 09:47:00', 'Super 8', '2012-06-25', '2012-06-26', 'Others|installation, set up and configuration|', 'Approved', '', '--Select-- ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0393', 20070801, '2012-06-27 10:19:00', 'Cardams', '2012-06-20', '2012-06-22', 'Others|20 - Setup and install Barter for second batch of training \r\n21 - Back-end training c/o Ralphy\r\n22 - Barter exam and data correction|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0394', 20070801, '2012-06-27 10:20:00', 'Cardams', '2012-06-28', '2012-06-28', 'Others|SM North Edsa setup and configuration of HO-branch data connection|', 'Confirmed', '', '--Select-- ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0395', 20070801, '2012-06-27 10:21:00', 'Super 8 Novaliches', '2012-06-29', '2012-06-29', 'Others|Live and monitoring with Trinah|', 'Confirmed', '', '--Select-- ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0396', 20110301, '2012-06-27 15:46:00', 'BIR RDO43A', '2012-06-27', '2012-06-27', 'Others|BIR esales seminar|', 'Approved', '', '450 ', '480', '900', '7.0', '930', '8.0');
INSERT INTO `ems_ob` VALUES ('ofb-0397', 20120301, '2012-06-28 10:26:00', 'Unimart-Greenhills', '2012-06-28', '2012-06-28', 'Others|Submit quotation|', 'Approved', '', '510 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0398', 20070701, '2012-06-29 10:35:00', 'regan', '2012-06-29', '2012-06-29', 'Others|Barter distribution training|', 'Confirmed', '', '660 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0399', 20100603, '2012-06-29 11:08:00', 'Regan/QC', '2012-06-29', '2012-06-29', 'Meeting|Others|', 'Approved', 'SO-SI Training', '660 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0400', 20070801, '2012-07-03 11:54:00', 'Cardams', '2012-06-30', '2012-07-02', 'Others|June 30: Pre-live preparation, reset POS\r\nJuly 1-2:  Live and monitoring|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0401', 20120301, '2012-07-04 12:35:00', 'Majaraja/SM South Mall', '2012-07-05', '2012-07-05', 'Meeting|', 'Confirmed', 'Client discussion on business requirement', '720 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0402', 20100603, '2012-07-05 16:24:00', 'EVER/CALOOCAN', '2012-07-04', '2012-07-04', 'Others|Ever - Caybiga Caloocan Live monitoring|', 'Approved', '', '420 ', '540', '870', '5.30', '1020', '10.0');
INSERT INTO `ems_ob` VALUES ('ofb-0403', 20070801, '2012-07-06 16:53:00', 'Cardams', '2012-07-05', '2012-07-05', 'Others|HO connection setup, data transfer|', 'Approved', '', '--Select-- ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0404', 20100603, '2012-07-07 01:10:00', 'Powerhouse', '2012-07-06', '2012-07-06', 'Others|Installed updated barter version in HO, Makati and Fairview|', 'Approved', '', '420 ', '540', '1140', '10.0', '1260', '14.0');
INSERT INTO `ems_ob` VALUES ('ofb-0405', 20120601, '2012-07-09 10:33:00', 'Shoppers', '2012-07-06', '2012-07-06', 'Others|Update barter TX version 8.4.74 mode 6/19/2012|', 'Approved', '', '540 ', '660', '790', '2.10', '900', '6.0');
INSERT INTO `ems_ob` VALUES ('ofb-0406', 20070705, '2012-07-09 11:08:00', 'Kevin Enterprises', '2012-07-02', '2012-07-07', 'Consultation|Others|Resolve Issues, CLP and Advanced Promo Training, CLP implementation and monnitoring|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0407', 20120301, '2012-07-09 13:21:00', 'Unimart-Greenhills', '2012-07-09', '2012-07-09', 'Others|Submit Proposal|', 'Approved', '', '570 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0408', 20120301, '2012-07-09 13:33:00', 'SMX/Pasay', '2012-07-05', '2012-07-05', 'Others|Check potentials on exhibitors - Corporate Giveaways 2012 by Worldexco|', 'Approved', '', '540 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0409', 20070804, '2012-07-09 13:47:00', 'Nesabel', '2012-07-04', '2012-07-04', 'Meeting|', 'Approved', 'Discuss San Rafael additional POS, but meeting cancelled', '570 ', '600', '615', '0.15', '680', '1.05');
INSERT INTO `ems_ob` VALUES ('ofb-0410', 20070804, '2012-07-09 13:49:00', 'Nesabel', '2012-07-05', '2012-07-05', 'Meeting|', 'Approved', 'Discuss San Rafael Additional POS, pending issues and accounting automation', '540 ', '600', '780', '3.0', '840', '5.0');
INSERT INTO `ems_ob` VALUES ('ofb-0411', 20100301, '2012-07-09 14:20:00', 'Super 8', '2012-06-28', '2012-06-29', 'Consultation|Others|Reset and Opening of Super 8 Novaliches Bayan|', 'Approved', '', '--Select-- ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0412', 20070801, '2012-07-09 15:01:00', 'cardams', '2012-07-09', '2012-07-09', 'Others|Cardams HO - Live and monitoring|', 'Approved', '', '--Select-- ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0413', 20100401, '2012-07-09 15:02:00', 'Shoppers', '2012-07-06', '2012-07-06', 'Delivery|Others|Update BarterTX for the STO to STI issue.|', 'Approved', '', '540 ', '660', '790', '2.10', '900', '6.0');
INSERT INTO `ems_ob` VALUES ('ofb-0414', 20100401, '2012-07-09 15:20:00', 'Ortigas', '2012-07-09', '2012-07-09', 'Others|Onsite checking and patch update for voided adjustment.|', 'Approved', '', '480 ', '540', '780', '4.0', '840', '6.0');
INSERT INTO `ems_ob` VALUES ('ofb-0415', 20070804, '2012-07-09 16:24:00', 'Elite Fruit Marketing', '2012-07-06', '2012-07-06', 'Meeting|', 'Approved', 'Client Meeting', '720 ', '870', '1050', '3.0', '1170', '7.30');
INSERT INTO `ems_ob` VALUES ('ofb-0416', 20080801, '2012-07-10 11:33:00', 'Blue Fields', '2012-07-14', '2012-07-27', 'Others|Barter Training for Client|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0417', 20070701, '2012-07-10 16:09:00', 'COH', '2012-07-11', '2012-07-20', 'Others|Go Live Preparations|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0418', 20080604, '2012-07-10 16:14:00', 'Suy Sing', '2012-07-04', '0000-00-00', 'Meeting|', 'Approved', 'Suy Sing Suki Day meeting', '510 ', '--Select--', '--Select--', '', '930', '');
INSERT INTO `ems_ob` VALUES ('ofb-0419', 20080604, '2012-07-10 16:15:00', 'Epson', '2012-07-03', '2012-07-03', 'Meeting|', 'Approved', 'Epson Tender Management Meeting at Makati', '900 ', '--Select--', '1170', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0420', 20120301, '2012-07-10 16:29:00', 'PC Supermarket/Mofar Gen. Mdse.', '2012-07-11', '2012-07-11', 'Others|Courtesy Call|', 'Confirmed', '', '540 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0421', 20080101, '2012-07-10 17:16:00', 'Ortigas/GSC', '2012-07-09', '2012-07-09', 'Consultation|', 'Pending for Approval', 'Fix the problem on TLS Adjustment error', '480 ', '510', '780', '4.30', '825', '5.45');
INSERT INTO `ems_ob` VALUES ('ofb-0422', 20070705, '2012-07-11 13:35:00', 'Super 8 Recto', '2012-07-10', '2012-07-10', 'Others|Setup of POS in store|', 'Approved', '', '360 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0423', 20070705, '2012-07-11 13:36:00', 'Super 8 Recto', '2012-07-10', '2012-07-10', 'Others|(PM) Install Server and workstation in Binondo|', 'Approved', '', '780 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0424', 20100603, '2012-07-11 17:09:00', 'Powerhouse/Fairview', '2012-07-09', '2012-07-09', 'Others|1. Slave and back up databases\r\n2.OS and barter software installation\r\n|', 'Approved', 'Done', '720 ', '840', '1185', '5.45', '1260', '9.0');
INSERT INTO `ems_ob` VALUES ('ofb-0425', 20100301, '2012-07-13 09:28:00', 'Ever', '2012-07-12', '2012-07-12', 'Others|Server and POS installation for Bangkal and Pandacan Branch|', 'Approved', '', '480 ', '570', '1080', '8.30', '1230', '12.30');
INSERT INTO `ems_ob` VALUES ('ofb-0426', 20080603, '2012-07-13 15:14:00', 'Metroindex', '2012-07-13', '2012-07-13', 'Meeting|', 'Approved', 'Meeting and walk through of Barter 7 at Metroindex', '450 ', '540', '705', '2.45', '825', '6.15');
INSERT INTO `ems_ob` VALUES ('ofb-0427', 20120301, '2012-07-16 13:02:00', 'Unimart-Greenhills', '2012-07-16', '2012-07-16', 'Others|Follow-up submitted proposal|', 'Approved', '', '540 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0428', 20120301, '2012-07-16 13:04:00', 'DD''s/Pampanga', '2012-07-18', '2012-07-18', 'Others|Join w/ Support Team.  To observe system upgrading.|', 'Confirmed', '', '1080 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0429', 20120302, '2012-07-16 17:40:00', 'Marketing', '2012-07-14', '2012-07-14', 'Others|Finished database for telemarketing, Meeting for target action plan for marketing & Continue pending docs. & Start researching for Top Businesses.|', 'Cancelled', 'Need to finalize the schedules &  plans for the department so that we can start with the project and to  reach the deadline in target date & time.', '515 ', '520', '1050', '8.50', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0430', 20070705, '2012-07-17 14:18:00', 'Super 8 Recto', '2012-07-12', '2012-07-12', 'Others|Dry Run, setup POS in store|', 'Approved', '', '360 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0431', 20070705, '2012-07-17 14:19:00', 'Super 8 Recto', '2012-07-13', '2012-07-13', 'Others|Final setup of POS, Pre-live preparations|', 'Approved', '', '360 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0432', 20070705, '2012-07-17 14:19:00', 'Super 8 Recto', '2012-07-16', '2012-07-16', 'Others|Super 8 Recto Live and Monitoring|', 'Approved', '', '360 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0433', 20100401, '2012-07-18 09:21:00', 'Ortigas', '2012-07-13', '2012-07-13', 'Others|Data correction for zero-out credit memo.|', 'Approved', '', '780 ', '810', '1080', '4.30', '1140', '6.0');
INSERT INTO `ems_ob` VALUES ('ofb-0434', 20100401, '2012-07-18 09:24:00', 'Ortigas', '2012-07-16', '2012-07-16', 'Others|Checking and deployment to live database|', 'Approved', '', '480 ', '570', '1080', '8.30', '1140', '11.0');
INSERT INTO `ems_ob` VALUES ('ofb-0435', 20120601, '2012-07-18 22:32:00', 'Blue Fields', '2012-07-14', '2012-07-27', 'Others|Barter and POS training at Iloilo City|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0436', 20120301, '2012-07-19 12:53:00', 'SM Mega Mall', '2012-07-19', '2012-07-19', 'Others|Defense & Sporting Arms Show|', 'Confirmed', '', '780 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0437', 20080603, '2012-07-19 19:34:00', 'DD''s', '2012-07-18', '2012-07-19', 'Others|update the version of server, w.station and POS|', 'Approved', '', '1140 ', '1230', '1500', '4.30', '1620', '8.0');
INSERT INTO `ems_ob` VALUES ('ofb-0438', 20120302, '2012-07-20 18:33:00', 'Marketing', '2012-07-20', '2012-07-20', 'Others|Business Coach Seminar at Greenhills Manila\r\n"Events Management Training"|', 'Approved', '', '480 ', '540', '975', '7.15', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0439', 20080604, '2012-07-21 09:05:00', 'Altonda for Onesimus Client Demo', '2012-07-18', '2012-07-18', 'Meeting|', 'Approved', 'Presentation of Barter to Onesimus Management', '480 ', '--Select--', '--Select--', '', '640', '');
INSERT INTO `ems_ob` VALUES ('ofb-0440', 20080604, '2012-07-21 09:06:00', 'Primer', '2012-07-19', '2012-07-19', 'Meeting|', 'Approved', 'Meet with Richard Cheng for the pending payables.  Reviewed the conflicting documents.  Send billing statements.  Deliver hardware units (2 sets)', '--Select-- ', '--Select--', '--Select--', '', '940', '');
INSERT INTO `ems_ob` VALUES ('ofb-0441', 20070701, '2012-07-23 18:12:00', 'COH', '2012-07-25', '2012-07-31', 'Others|Go Live Preparations and Issues Resolutions|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0442', 20070801, '2012-07-24 18:12:00', 'Cardams', '2012-07-10', '2012-07-11', 'Others|July 10-SM Fairview COIN setup\r\nJuly 11-Cardams HO Back-end monitoring|', 'Approved', '', '--Select-- ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0443', 20070801, '2012-07-24 18:14:00', 'Super 8 Recto/Shoppers Binondo', '2012-07-16', '2012-07-16', 'Others|Super 8 Recto-Live\r\nShoppers Binondo-Checked pending issue (POS Agent Not Processing, STO-STI link document, cannot preview Item Analysis Report)|', 'Approved', '', '--Select-- ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0444', 20070801, '2012-07-24 18:17:00', 'Cardams', '2012-07-19', '2012-07-23', 'Others|July 19-SM Fairview final setup, reset POS\r\nJuly 20-Cardams HO check POS of Megamall for corrupted Barter and database issue because of virus infection\r\nJuly 22-SM Fairview POS Live\r\nJuly 23-SM Fairview Monitoring|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0445', 20120301, '2012-07-25 19:19:00', 'SMX/Pasay', '2012-07-25', '2012-07-25', 'Others|Check event|', 'Approved', '', '600 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0446', 20120301, '2012-07-25 19:21:00', 'Simplicity/Bulacan', '2012-07-26', '2012-07-26', 'Others|W/ Support Team, Ian Enrique.  Observe on how do we address clients concerns.|', 'Confirmed', '', '540 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0447', 20120301, '2012-07-25 19:23:00', 'SMX/Pasay', '2012-07-27', '2012-07-27', 'Others|Exhibit - Sales Networking on Potential clients|', 'Confirmed', '', '600', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0448', 20080701, '2012-07-26 10:33:00', 'MSI ECS', '2012-07-24', '2012-07-24', 'Others|MICROSOFT SOLUTIONS for SMBs|', 'Approved', '', '785 ', '800', '1065', '4.25', '1185', '6.40');
INSERT INTO `ems_ob` VALUES ('ofb-0449', 20070705, '2012-07-26 12:37:00', 'Cardams Sta RosaC', '2012-07-26', '2012-07-26', 'Others|Configuration of POS and importation of products and product profiles|', 'Approved', '', '600 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0450', 20060801, '2012-07-26 17:29:00', 'DD''s Supermarket', '2012-07-18', '2012-07-19', 'Others|Barter MMS Upgrade on DD''s Supermarket|', 'Approved', '', '1170 ', '1230', '1490', '4.20', '1560', '6.30');
INSERT INTO `ems_ob` VALUES ('ofb-0451', 20081101, '2012-07-29 14:28:00', 'POWERHOUSE', '2012-07-27', '2012-07-27', 'Meeting|Others|Check issues of client - POWERHOUSE|', 'Approved', '', '540 ', '540', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0452', 20081101, '2012-07-29 14:29:00', 'COH', '2012-07-29', '2012-07-31', 'Meeting|Others|Check remaining issues of client before live|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0453', 20070701, '2012-07-30 19:43:00', 'COH', '2012-07-30', '2012-08-11', 'Others|Pre Live Preparations|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0454', 20100603, '2012-07-30 19:48:00', 'COH/CEBU', '2012-07-10', '2012-08-05', 'Others|', 'Approved', 'Dry Run and Parallel testing', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0455', 20070801, '2012-07-31 10:55:00', 'Cardams', '2012-07-25', '2012-07-29', 'Others|July 25-Setup and configuration AC on Bacoor, IL on Sta. Rosa\r\nJuly 26-Cardams HO, reinstall Barter and recover database for Megamall POS\r\nJuly 27-EVER Pandacan Live and monitoring\r\nJuly 28-Sta. Rosa Pre-live setup\r\nJuly 29-Sta. Rosa Live and monitoring|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0456', 20120301, '2012-07-31 19:07:00', 'DD''s/Pampanga', '2012-08-01', '2012-08-01', 'Others|P-Count Orientation by Support/Dev Team|', 'Cancelled', 'Observe', '420 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0457', 20090702, '2012-08-01 15:48:00', 'DDs Apalit', '2012-08-01', '2012-08-01', 'Meeting|Others|PCount Meeting with CE|', 'Approved', 'Discussed the Cycle Counting process with the owners and other employees of DDs', '600 ', '690', '840', '2.30', '930', '5.30');
INSERT INTO `ems_ob` VALUES ('ofb-0458', 20120301, '2012-08-02 14:02:00', 'San Juan/Pasay', '2012-08-01', '2012-08-01', 'Others|WTC - WOFEX Exhibit\r\nUnimart - Courtesy Call|', 'Approved', '', '600 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0459', 20120301, '2012-08-02 14:08:00', 'QC/Pasay/San Juan', '2012-08-02', '2012-08-02', 'Others|Mightee Mart - Courtesy Visit\r\nUnimart - Re-visit \r\nWOFEX Exhibit - SMX|', 'Approved', '', '540 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0460', 20100301, '2012-08-02 14:55:00', 'Parmasiyutika', '2012-07-31', '2012-08-01', 'Others|PCount|', 'Approved', '', '--Select-- ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0461', 20120301, '2012-08-06 10:40:00', 'Zuellig', '2012-08-08', '2012-08-08', 'Meeting|', 'Confirmed', 'Discuss Proposal', '360 ', '540', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0462', 20120301, '2012-08-06 10:41:00', 'WOFEX/Pasay', '2012-08-03', '2012-08-03', 'Others|Networking|', 'Approved', '', '600 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0463', 20120301, '2012-08-06 10:42:00', 'PRA Exhibit', '2012-08-09', '2012-08-10', 'Others|Exhibit|', 'Confirmed', '', '480 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0464', 20120301, '2012-08-06 11:28:00', 'PASI Exhibit-Bacolod', '2012-08-15', '2012-08-17', 'Others|Exhibit @ L'' Fisher Hotel|', 'Confirmed', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0465', 20120301, '2012-08-06 11:29:00', 'Negros Area', '2012-08-20', '2012-08-27', 'Others|Potential Client Mapping|', 'Approved', '', '', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0466', 20080603, '2012-08-06 12:53:00', 'Century Chemicals', '2012-08-06', '2012-08-06', 'Consultation|', 'Approved', 'Get a copy of their database and version of Barter 7', '435 ', '615', '640', '0.25', '750', '5.15');
INSERT INTO `ems_ob` VALUES ('ofb-0467', 20120601, '2012-08-08 11:36:00', 'Super8', '2012-08-03', '2012-08-03', 'Others|Installation of Barter Tx and configuration of printer|', 'Approved', '', '690 ', '785', '1095', '5.10', '1140', '7.30');
INSERT INTO `ems_ob` VALUES ('ofb-0468', 20080701, '2012-08-08 16:41:00', 'Paramount', '2012-08-02', '2012-08-02', 'Meeting|', 'Approved', 'Meeting with Paramount together with Meridian IT', '565 ', '635', '770', '2.15', '790', '3.45');
INSERT INTO `ems_ob` VALUES ('ofb-0469', 20100301, '2012-08-09 21:33:00', 'Lee Plaza', '2012-08-02', '2012-08-10', 'Others|UAT|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0470', 20070804, '2012-08-10 12:24:00', 'Thai Prospects', '2012-07-23', '2012-07-27', 'Meeting|', 'Approved', 'Demo Meeting with Thai Prospects\r\nMakro, Samsonite\r\nMeeting with SAP Partners', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0471', 20070804, '2012-08-10 12:26:00', 'MYDIN', '2012-07-29', '2012-08-25', 'Others|UAT to Implementation|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0472', 20100603, '2012-08-11 10:18:00', 'COH/CEBU', '2012-08-06', '2012-08-06', 'Others|', 'Approved', 'COH SAP-BARTER Integration', '645 ', '660', '1200', '9.0', '1290', '10.45');
INSERT INTO `ems_ob` VALUES ('ofb-0473', 20100603, '2012-08-11 10:22:00', 'BLUEFIELDS/ILOILO', '2012-08-07', '2012-08-17', 'Others|POS and WS Set-Up, Dry Run, IBM Server RAID set-up and OS Installation, Live and Monitoring|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0474', 20080604, '2012-08-13 10:10:00', 'PRA', '2012-08-09', '2012-08-10', 'Others|PRA Event - Marketing|', 'Approved', '', '465 ', '--Select--', '2875', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0475', 20100401, '2012-08-13 15:58:00', 'Super8 Baclaran', '2012-08-10', '2012-08-10', 'Others|Installation and configuration of POS, Workstation, Server|', 'Approved', '', '600 ', '690', '1035', '5.45', '1140', '9.0');
INSERT INTO `ems_ob` VALUES ('ofb-0476', 20120601, '2012-08-13 16:05:00', 'Super8 - baclaran', '2012-08-10', '2012-08-10', 'Others|Installation and configuration of 17 POS, 1 workstation and 1 server|', 'Approved', '', '600 ', '690', '1035', '5.45', '1140', '9.0');
INSERT INTO `ems_ob` VALUES ('ofb-0477', 20120302, '2012-08-13 18:55:00', 'Marketing', '2012-08-09', '2012-08-10', 'Others|Assist PRA Event held at SMX Convention Center|', 'Approved', '', '480 ', '540', '2640', '35.0', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0478', 20120301, '2012-08-14 13:26:00', 'AGS/Makati', '2012-08-13', '2012-08-13', 'Meeting|', 'Approved', '', '960 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0479', 20120301, '2012-08-14 13:27:00', 'AGS/Makati', '2012-08-14', '2012-08-14', 'Meeting|', 'Approved', 'follow-up meeting re: GUESS', '120 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0480', 20100301, '2012-08-15 09:12:00', 'Lee Plaza', '2012-08-05', '2012-08-05', 'Others|re-migrated head office database|', 'Cancelled', '', '--Select-- ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0481', 20100301, '2012-08-15 09:14:00', 'Lee Plaza', '2012-08-11', '2012-08-11', 'Others|Testing of Enhancements|', 'Approved', '', '540 ', '570', '1170', '10.0', '1200', '11.0');
INSERT INTO `ems_ob` VALUES ('ofb-0482', 20070801, '2012-08-15 18:28:00', 'Lee Plaza Dumaguete', '2012-08-02', '2012-08-08', 'Others|UAT for Lee end users with TS|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0483', 20070801, '2012-08-15 18:37:00', 'Super 8 Baclaran', '2012-08-13', '2012-08-14', 'Others|Dry run and POS reset|', 'Approved', '', '--Select-- ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0484', 20070801, '2012-08-15 18:38:00', 'Cardams-North', '2012-08-15', '2012-08-15', 'Others|COIN setup with Gerald (SM IT)|', 'Approved', '', '--Select-- ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0485', 20070701, '2012-08-17 11:26:00', 'Blue Fields', '2012-08-09', '2012-08-13', 'Others|Go Live and Monitoring|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0486', 20070701, '2012-08-17 11:28:00', 'Mydin-Malaysia', '2012-08-14', '2012-08-25', 'Others|Testing of POS and Documentation of Manuals and Training Materials|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0487', 20100601, '2012-08-22 17:49:00', 'Regan', '2012-08-17', '2012-08-17', 'Others|Barter Installation|', 'Approved', '', '840 ', '960', '1290', '5.30', '1410', '9.30');
INSERT INTO `ems_ob` VALUES ('ofb-0488', 20120302, '2012-08-23 11:59:00', 'Marketing', '2012-08-18', '2012-08-18', 'Delivery|', 'Approved', 'Assist Delivery of WorknPlay for the remaining units of PRA Event (Aug.9-10) to General Luna St. Warehouse c/o JK. All the materials are complete and well-arranged. ', '420', '525', '845', '5.20', '755', '5.35');
INSERT INTO `ems_ob` VALUES ('ofb-0489', 20080603, '2012-08-23 18:47:00', 'Pentstar (Marquee)', '2012-08-23', '2012-08-23', 'Others|set up the new POS for their new branch at MarqueeMall|', 'Approved', '', '360 ', '600', '930', '5.30', '1050', '11.30');
INSERT INTO `ems_ob` VALUES ('ofb-0490', 20080604, '2012-08-24 11:47:00', 'iRipple', '2012-08-23', '2012-08-23', 'Meeting|', 'Approved', 'Site visit with Sir VJ - Arch. AJ\r\nDinner meeting with Arch. Gado', '900 ', '--Select--', '1305', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0491', 20080604, '2012-08-24 11:47:00', 'iRipple', '2012-08-15', '2012-08-18', 'Others|PASI Conference in Bacolod City|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0492', 20120601, '2012-08-24 13:32:00', 'Pentstar Paris Hilton Pampanga', '2012-08-23', '2012-08-23', 'Others|Standby support|', 'Approved', '', '540 ', '630', '1260', '10.30', '1435', '15.55');
INSERT INTO `ems_ob` VALUES ('ofb-0493', 20080603, '2012-08-28 11:19:00', 'RD Hardware', '2012-08-13', '2012-08-16', 'Others|Upgrade the database and the version of their Barter MMS.|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0494', 20120301, '2012-08-28 16:04:00', 'AGS/Makati', '2012-08-28', '2012-08-28', 'Meeting|', 'Approved', 'Lunch meeting with AGS for additional info on Guess account', '660 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0495', 20120301, '2012-08-28 16:06:00', 'Zuellig Pharma', '2012-08-29', '2012-08-29', 'Meeting|', 'Confirmed', 'With Mr. Ray Lukban.  Discuss submitted proposal', '360 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0496', 20120301, '2012-08-28 16:08:00', 'AGS/Makati', '2012-08-31', '2012-08-31', 'Meeting|', 'Confirmed', 'Barter Demo to AGS in preparation to Guess presentation', '540 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0497', 20120301, '2012-08-28 16:44:00', 'Guess/San Pedro, Laguna', '2012-09-07', '2012-09-07', 'Meeting|', 'Confirmed', 'Final Demo & Presentation to Guess team', '720 ', '840', '1020', '3.0', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0498', 20070701, '2012-08-29 23:56:00', 'COH', '2012-08-27', '2012-09-04', 'Others|Go Live and Monitoring for Pardo and Mactan|', 'Approved', '', '', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0499', 20100301, '2012-09-03 18:17:00', 'Cardams HO', '2012-09-03', '2012-09-03', 'Meeting|', 'Approved', '', '480 ', '600', '900', '5.0', '1020', '9.0');
INSERT INTO `ems_ob` VALUES ('ofb-0500', 20100603, '2012-09-04 15:52:00', 'COH/CEBU', '2012-08-25', '2012-09-07', 'Delivery|Others|', 'Approved', 'Pardo and Mactan Pre Live Setup and Monitoring', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0501', 20120601, '2012-09-04 17:52:00', 'Super8', '2012-09-04', '2012-09-04', 'Others|Installation of 17 POS, 1 server and 1 workstation|', 'Approved', '', '510 ', '570', '--Select--', '6.15', '--Select--', '8.45');
INSERT INTO `ems_ob` VALUES ('ofb-0502', 20100301, '2012-09-05 09:41:00', 'Nesabel / San Rafael', '2012-09-05', '2012-09-05', 'Others|installation|', 'Approved', '', '510 ', '690', '1140', '7.30', '1260', '12.30');
INSERT INTO `ems_ob` VALUES ('ofb-0503', 20080604, '2012-09-05 18:31:00', 'Barefoot Unlimited - Client Prospect', '2012-09-03', '2012-09-03', 'Meeting|', 'Approved', '', '720 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0504', 20080604, '2012-09-05 18:32:00', 'Primer', '2012-09-05', '2012-09-05', 'Meeting|', 'Approved', 'Primer meeting re the 3 year CAP Plan proposal', '795 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0505', 20070801, '2012-09-06 15:14:00', 'Super 8 Baclaran', '2012-08-16', '2012-08-16', 'Others|Live and monitoring|', 'Approved', '', '--Select-- ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0506', 20070801, '2012-09-06 15:15:00', 'Cardams-North', '2012-08-31', '2012-08-31', 'Others|COIN Setup|', 'Approved', '', '--Select-- ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0507', 20070801, '2012-09-06 15:16:00', 'Cardams-Bacoor', '2012-09-02', '2012-09-02', 'Others|Pre-live preparation and COIN Setup|', 'Approved', '', '--Select-- ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0508', 20070801, '2012-09-06 15:17:00', 'Cardams-HO', '2012-09-03', '2012-09-03', 'Meeting|', 'Approved', 'with TS', '--Select-- ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0509', 20070801, '2012-09-06 15:17:00', 'Cardams-Bacoor', '2012-09-04', '2012-09-04', 'Others|Live and monitoring|', 'Approved', '', '--Select-- ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0510', 20070701, '2012-09-06 15:46:00', 'Ripple', '2012-09-06', '2012-09-06', 'Meeting|Others|Meeting with Arian and Ms. Loi.|', 'Approved', '', '510 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0511', 20070701, '2012-09-06 15:47:00', 'Nesabel', '2012-09-06', '2012-09-06', 'Others|Meeting with nesabel for MA|', 'Approved', '', '660 ', '--Select--', '210', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0512', 20070801, '2012-09-06 19:01:00', 'Cardams-North', '2012-09-07', '2012-09-07', 'Others|Live and monitoring|', 'Confirmed', '', '--Select-- ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0513', 20070801, '2012-09-10 14:48:00', 'iRipple/Starbucks Tektite', '2012-09-06', '2012-09-06', 'Others|Meeting with Fracy and Ms. Loi for Project Turn Over|', 'Approved', '', '--Select-- ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0514', 20070801, '2012-09-10 14:49:00', 'Elite Fruit', '2012-09-12', '2012-09-12', 'Others|Kick-off meeting with Trinah and Ms. Jen, Sir Kingson and Ms. Janice|', 'Cancelled', '', '--Select-- ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0515', 20120301, '2012-09-11 12:08:00', 'Starmall/Alabang', '2012-09-10', '2012-09-10', 'Others|Courtesy Visit|', 'Approved', 'Secure Accreditation Requirements', '600 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0516', 20120301, '2012-09-11 12:11:00', 'Shell/Pasig', '2012-09-10', '2012-09-10', 'Others|Networking|', 'Approved', 'Contact person of Select.', '870 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0517', 20100301, '2012-09-11 17:03:00', 'Nesabel / Bustos', '2012-09-11', '2012-09-11', 'Others|data correction|', 'Approved', '', '480 ', '600', '--Select--', '4.30', '--Select--', '9.0');
INSERT INTO `ems_ob` VALUES ('ofb-0518', 20120301, '2012-09-12 09:22:00', 'Chicken & Co./Pasay-MOA', '2012-09-12', '2012-09-12', 'Others|Store visit|', 'Cancelled', 'Observe store activity', '600 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0519', 20120301, '2012-09-12 09:27:00', 'Max''s/Makati', '2012-09-11', '2012-09-12', 'Others|Update|', 'Approved', 'Prototype system software updating w/ TL', '930 ', '--Select--', '150', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0520', 20090802, '2012-09-12 13:24:00', 'Max''s', '2012-09-11', '2012-09-12', 'Others|Set up demo unit with prototype program for Barter F&B.|', 'Approved', '', '900 ', '960', '1590', '10.30', '1680', '13.0');
INSERT INTO `ems_ob` VALUES ('ofb-0521', 20100301, '2012-09-12 17:32:00', 'Elite Fruit', '2012-09-12', '2012-09-12', 'Meeting|', 'Approved', '', '480 ', '600', '705', '1.45', '810', '5.30');
INSERT INTO `ems_ob` VALUES ('ofb-0522', 20080701, '2012-09-12 18:32:00', 'Microsoft', '2012-09-07', '2012-09-07', 'Others|Microsoft Partner Network Summit 2012|', 'Approved', '', '465 ', '510', '1130', '10.20', '1260', '13.15');
INSERT INTO `ems_ob` VALUES ('ofb-0523', 20080701, '2012-09-12 18:34:00', 'Super 8 /BIR 43A', '2012-09-13', '2012-09-13', 'Meeting|', 'Approved', 'Follow up of all pending pos permit applications, buy something for bir people', '480 ', '525', '695', '2.50', '730', '4.10');
INSERT INTO `ems_ob` VALUES ('ofb-0524', 20110402, '2012-09-12 18:54:00', 'Maldive', '2012-09-11', '2012-09-11', 'Others|Onsite development of pre-printed forms of Maldive|', 'Cancelled', '', '390 ', '570', '1110', '9.0', '1290', '15.0');
INSERT INTO `ems_ob` VALUES ('ofb-0525', 20120301, '2012-09-13 15:56:00', 'Max''s/Makati', '2012-09-12', '2012-09-12', 'Others|Discuss concerns on the software update|', 'Approved', '', '600 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0526', 20120301, '2012-09-13 15:59:00', 'Zuellig Pharma', '2012-09-12', '2012-09-12', 'Meeting|', 'Approved', '', '840 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0527', 20120301, '2012-09-13 15:59:00', 'Max''s/Makati', '2012-09-13', '2012-09-13', 'Meeting|', 'Approved', '', '480 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0528', 20120301, '2012-09-13 16:00:00', 'Max''s/Makati', '2012-09-14', '2012-09-14', 'Others|Pick-up Demo hardware units (F & B)|', 'Confirmed', '', '480 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0529', 20120301, '2012-09-13 16:17:00', 'Internal Meeting', '2012-09-14', '2012-09-14', 'Meeting|', 'Cancelled', '', '660 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0530', 20120301, '2012-09-13 16:18:00', 'Chicken & Co./Pasay-MOA', '2012-09-13', '2012-09-13', 'Others|Store Visit|', 'Cancelled', '', '1020', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0531', 20100603, '2012-09-13 18:33:00', 'Super8/Muntinlupa', '2012-09-12', '2012-09-12', 'Others|', 'Approved', 'Dongle License validation and POS configuration', '540 ', '630', '1140', '8.30', '1230', '11.30');
INSERT INTO `ems_ob` VALUES ('ofb-0532', 20070701, '2012-09-13 22:36:00', 'COH/Banilad', '2012-09-14', '2012-09-19', 'Others|Pre Live and Monitoring of Banilad Branch|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0533', 20070701, '2012-09-13 22:39:00', 'Mydin/Malayis', '2012-09-22', '2012-10-20', 'Others|TRaining, Pre LIve and Monitoring|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0534', 20100601, '2012-09-14 12:59:00', 'Super8 Recto', '2012-09-14', '2012-09-14', 'Others|Error encounter upon login in POS7a.|', 'Approved', '', '470 ', '555', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0535', 20100601, '2012-09-14 17:57:00', 'Shopper''s Mart', '2012-09-17', '2012-09-17', 'Others|POS error |', 'Approved', '', '690', '810', '1050', '4.0', '1230', '9.0');
INSERT INTO `ems_ob` VALUES ('ofb-0536', 20120301, '2012-09-17 11:39:00', 'Nissan/U.N. Ave.', '2012-09-17', '2012-09-17', 'Others|PMS - Nissan Sentra|', 'Approved', '10K PMS Schedule', '540 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0537', 20120301, '2012-09-17 11:41:00', 'AppTech/Pasig', '2012-09-14', '2012-09-14', 'Meeting|', 'Approved', 'discuss re: Agmark account', '930 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0538', 20080604, '2012-09-18 08:50:00', 'Super 8 Muntinlupa', '2012-09-17', '2012-09-17', 'Others|Attend client''s branch opening - SUper 8 Muntinulupa|', 'Approved', '', '480 ', '--Select--', '--Select--', '', '810', '');
INSERT INTO `ems_ob` VALUES ('ofb-0539', 20100301, '2012-09-18 09:00:00', 'Elite Fruit', '2012-09-17', '2012-09-17', 'Others|Interview of Business Process|', 'Approved', '', '390 ', '570', '840', '4.30', '1020', '10.30');
INSERT INTO `ems_ob` VALUES ('ofb-0540', 20120901, '2012-09-18 09:23:00', 'Elite Fruit, Binondo', '2012-09-17', '2012-09-17', 'Others|Interview of existing business process.|', 'Approved', '', '390 ', '540', '750', '3.30', '930', '9.0');
INSERT INTO `ems_ob` VALUES ('ofb-0541', 20080701, '2012-09-18 09:54:00', 'IBM', '2012-09-18', '2012-09-18', 'Meeting|', 'Approved', 'IBM Business Partner Revitalization Day', '435 ', '540', '1080', '9.0', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0542', 20120301, '2012-09-18 16:49:00', 'Max''s/Makati', '2012-09-18', '2012-09-18', 'Others|Courtesy Visit|', 'Approved', '', '540 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0543', 20120301, '2012-09-18 16:51:00', 'Guess/San Pedro, Laguna', '2012-09-19', '2012-09-19', 'Others|Courtesy Visit|', 'Confirmed', '', '540 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0544', 20120901, '2012-09-19 11:21:00', 'Super 8, Muntinlupa', '2012-09-12', '2012-09-12', 'Others|Installation of Barter 8.|', 'Approved', '', '540 ', '660', '1170', '8.30', '1230', '11.30');
INSERT INTO `ems_ob` VALUES ('ofb-0545', 20070701, '2012-09-20 09:29:00', 'Ripple', '2012-09-19', '2012-09-19', 'Others|One one One discussion and Coaching with Ms. Loi|', 'Approved', '', '540 ', '--Select--', '660', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0546', 20120601, '2012-09-20 11:53:00', 'Ez Supermarket tarlac', '2012-09-13', '2012-09-14', 'Others|Purging of database|', 'Approved', '', '660 ', '1020', '1800', '13.0', '2475', '30.15');
INSERT INTO `ems_ob` VALUES ('ofb-0547', 20110301, '2012-09-20 18:23:00', 'PICPA', '2012-09-17', '2012-09-18', 'Others|2 day seminar on PICPA|', 'Approved', '', '450 ', '480', '2490', '33.30', '2550', '35.0');
INSERT INTO `ems_ob` VALUES ('ofb-0548', 20120301, '2012-09-22 11:18:00', 'Max''s/Makati', '2012-09-20', '2012-09-20', 'Meeting|', 'Approved', 'Ocular visit to iRipple office & nesabel pateros branch', '540 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0549', 20120301, '2012-09-22 11:19:00', 'Black Canyon Coffee/Las Pinas', '2012-09-20', '2012-09-20', 'Others|courtesy call|', 'Approved', '', '840 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0550', 20120301, '2012-09-22 11:20:00', 'AppTech/Pasig', '2012-09-21', '2012-09-21', 'Others|', 'Approved', 'discuss agmark schedules', '600 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0551', 20120301, '2012-09-22 11:25:00', 'Agmark-PNG', '2012-09-24', '2012-09-24', 'Meeting|', 'Confirmed', '', '420 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0552', 20120301, '2012-09-22 11:26:00', 'Simplicity/Bulacan', '2012-09-25', '2012-09-25', 'Meeting|', 'Cancelled', '', '840 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0553', 20120301, '2012-09-22 11:26:00', 'Agmark-PNG', '2012-09-26', '2012-09-27', 'Meeting|', 'Confirmed', '', '480 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0554', 20120301, '2012-09-22 11:27:00', 'Max''s/Makati', '2012-09-28', '2012-09-28', 'Meeting|', 'Confirmed', '', '480 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0555', 20120301, '2012-09-22 11:32:00', 'Conference', '2012-09-28', '2012-09-28', 'Others|Customer Loyalty Conference|', 'Confirmed', '', '780 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0556', 20071002, '2012-09-24 09:43:00', 'metrobank wackwack', '2012-09-12', '2012-09-12', 'Others|withdraw dollars|', 'Approved', '', '465 ', '560', '630', '1.10', '640', '2.55');
INSERT INTO `ems_ob` VALUES ('ofb-0557', 20071002, '2012-09-24 09:43:00', 'metrobank wackwack', '2012-09-12', '2012-09-12', 'Others|withdraw dollars|', 'Approved', '', '465 ', '560', '630', '1.10', '640', '2.55');
INSERT INTO `ems_ob` VALUES ('ofb-0558', 20100301, '2012-09-24 10:19:00', 'Elite Fruit', '2012-09-21', '2012-09-21', 'Meeting|Others|BPA presentation, Product Training and Initial Installation|', 'Approved', '', '390 ', '540', '1080', '9.0', '1260', '14.30');
INSERT INTO `ems_ob` VALUES ('ofb-0559', 20120901, '2012-09-24 10:36:00', 'Elite Fruit, Binondo', '2012-09-21', '2012-09-21', 'Others|Client Training and installation|', 'Approved', '', '420 ', '570', '1170', '10.0', '1230', '13.30');
INSERT INTO `ems_ob` VALUES ('ofb-0560', 20080801, '2012-09-24 14:46:00', 'Mydin - Malaysia', '2012-09-22', '2012-09-30', 'Others|Barter Training|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0561', 20100401, '2012-09-24 18:50:00', 'COH', '2012-09-14', '2012-09-18', 'Others|Onsite Visit and Live Monitoring|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0562', 20090802, '2012-09-25 10:51:00', 'LME - Thailand', '2012-09-26', '2012-10-20', 'Meeting|Others|1. SAP - Barter Integration internal Testing and UAT.\r\n2. CLP setup (in Ubuntu).\r\n3. Help RG and Ms. JC for fixes in POS and Web Portal.|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0563', 20120901, '2012-09-26 09:00:00', 'Elite Fruit, Binondo', '2012-09-25', '2012-09-25', 'Others|UAT|', 'Approved', '', '450 ', '630', '990', '6.0', '1110', '11.0');
INSERT INTO `ems_ob` VALUES ('ofb-0564', 20100301, '2012-09-26 14:08:00', 'Elite Fruit', '2012-09-25', '2012-09-25', 'Others|UAT|', 'Approved', '', '420 ', '600', '1005', '6.45', '1080', '11.0');
INSERT INTO `ems_ob` VALUES ('ofb-0565', 20120301, '2012-09-26 15:09:00', 'Simplicity/Bulacan', '2012-10-01', '2012-10-01', 'Meeting|', 'Confirmed', 'CLP/Advance Promo Presentation', '480 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0566', 20070801, '2012-09-26 15:12:00', 'Super 8/Muntinlupa', '2012-09-13', '2012-09-18', 'Others|POS printer configuration, dry run, POS reset, live and monitoring|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0567', 20070801, '2012-09-26 15:12:00', 'Cardams HO', '2012-09-21', '2012-09-21', 'Meeting|', 'Approved', 'with Ms. Loi', '--Select-- ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0568', 20070801, '2012-09-26 15:13:00', 'Elite Fruit', '2012-09-10', '2012-09-10', 'Meeting|', 'Approved', 'Kick off meeting with TS and JS', '--Select-- ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0569', 20100603, '2012-09-26 20:40:00', 'COH/CEBU', '2012-09-13', '2012-09-21', 'Others|', 'Approved', 'COH - Banilad Set Up and Live monitoring', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0570', 20080604, '2012-09-28 10:21:00', 'iRipple', '2012-09-28', '2012-09-28', 'Others|Customer Loyalty Conference Event|', 'Approved', '', '300 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0571', 20120302, '2012-09-28 10:35:00', 'Marketing', '2012-09-28', '2012-09-28', 'Others|Customer Loyalty Event Expo 2012, held at Crowne Plaza Galleria|', 'Approved', '', '300 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0572', 20080603, '2012-10-01 08:59:00', 'Budget Home Depot', '2012-09-23', '2012-09-28', 'Others|Set up and monitor during live on of their newly open branch.|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0573', 20120901, '2012-10-01 10:19:00', 'Elite Fruit, Binondo', '2012-09-27', '2012-09-27', 'Others|UAT|', 'Approved', '', '480 ', '660', '900', '4.0', '1020', '9.0');
INSERT INTO `ems_ob` VALUES ('ofb-0574', 20100301, '2012-10-01 10:19:00', 'Elite Fruit', '2012-09-27', '2012-09-27', 'Others|UAT|', 'Approved', '', '480 ', '660', '900', '4.0', '1020', '9.0');
INSERT INTO `ems_ob` VALUES ('ofb-0575', 20080701, '2012-10-01 10:35:00', 'BIR', '2012-09-28', '2012-09-28', 'Others|Follow up of client''s  pending pos permits|', 'Approved', '', '420 ', '505', '530', '0.25', '545', '2.5');
INSERT INTO `ems_ob` VALUES ('ofb-0576', 20120601, '2012-10-01 11:49:00', 'Super 8', '2012-09-28', '2012-09-28', 'Others|Installation of OS and Barter POS|', 'Approved', '', '570 ', '680', '1045', '6.05', '1080', '8.30');
INSERT INTO `ems_ob` VALUES ('ofb-0577', 20100603, '2012-10-02 09:18:00', 'COH/MANILA', '2012-10-01', '2012-10-01', 'Meeting|', 'Approved', 'COH Client Dinner Meeting with Sir VJ, BV and Ms Loi', '1050 ', '1140', '1320', '3.0', '1350', '5.0');
INSERT INTO `ems_ob` VALUES ('ofb-0578', 20120301, '2012-10-02 10:40:00', 'Nissan/U.N. Ave.', '2012-10-02', '2012-10-02', 'Others|Antenna Installation|', 'Approved', '', '570 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0579', 20120301, '2012-10-02 15:07:00', 'Zuellig Pharma', '2012-10-02', '2012-10-02', 'Meeting|', 'Confirmed', '', '960 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0580', 20120301, '2012-10-03 09:24:00', 'Home Office', '2012-10-03', '2012-10-03', 'Others|Home Office|', 'Approved', 'Due to heavy rains that causes floods in the area', '540 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0581', 20120301, '2012-10-03 09:24:00', 'Nesabel/Pateros', '2012-10-03', '2012-10-03', 'Others|Courtesy Visit|', 'Cancelled', '', '780 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0582', 20120301, '2012-10-03 09:26:00', 'RRJ/Quezon City', '2012-10-09', '2012-10-09', 'Meeting|', 'Confirmed', '', '720', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0583', 20120301, '2012-10-04 09:07:00', 'Nesabel/Pateros', '2012-10-04', '2012-10-04', 'Others|Courtesy visit|', 'Approved', '', '540 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0584', 20071002, '2012-10-04 10:28:00', 'metrobank wackwack', '2012-10-03', '2012-10-03', 'Others|to pick up checkbook of rmdc and send atvi docs|', 'Approved', '', '480 ', '570', '675', '1.45', '695', '3.35');
INSERT INTO `ems_ob` VALUES ('ofb-0585', 20080701, '2012-10-04 11:53:00', 'RADC', '2012-10-04', '2012-10-04', 'Others|Datamax Demo to prospect client|', 'Confirmed', '', '735 ', '810', '960', '2.30', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0586', 20120301, '2012-10-08 13:40:00', 'Nesabel/Pateros', '2012-10-08', '2012-10-08', 'Others|Store Visit w/ Zuellig|', 'Approved', '', '540 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0587', 20100601, '2012-10-08 15:58:00', 'Sportshouse', '2012-10-08', '2012-10-08', 'Meeting|', 'Approved', '', '540 ', '615', '780', '2.45', '855', '5.15');
INSERT INTO `ems_ob` VALUES ('ofb-0588', 20100301, '2012-10-09 20:43:00', 'Elite Fruit', '2012-10-02', '2012-10-03', 'Others|Barter Installation on Server and Workstation|', 'Approved', '', '480 ', '600', '2490', '31.30', '2580', '35.0');
INSERT INTO `ems_ob` VALUES ('ofb-0589', 20100301, '2012-10-09 20:44:00', 'Shoppers', '2012-10-08', '2012-10-08', 'Others|Installation and Set Up for CLP|', 'Approved', '', '480 ', '585', '1140', '9.15', '1260', '13.0');
INSERT INTO `ems_ob` VALUES ('ofb-0590', 20100603, '2012-10-10 17:39:00', 'COH/CEBU', '2012-10-08', '2012-10-12', 'Consultation|Meeting|', 'Approved', 'COH - BIR checking assessment and daily issues gathering, checking and fixing.', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0591', 20100603, '2012-10-11 01:27:00', 'BLUEFIELDS/ILOILO', '2012-10-13', '2012-10-21', 'Network|Consultation|Others|', 'Approved', 'Maasin Branch, Set-Up and Live Monitoring', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0592', 20120901, '2012-10-11 08:57:00', 'Super 8 Blumentritt', '2012-10-05', '2012-10-05', 'Others|Installation|', 'Approved', '', '460 ', '550', '870', '5.20', '1050', '9.50');
INSERT INTO `ems_ob` VALUES ('ofb-0593', 20120901, '2012-10-11 09:00:00', 'Super 8, Blumentritt', '2012-10-08', '2012-10-08', 'Others|POS Testing and Licensing|', 'Approved', '', '510 ', '600', '990', '6.30', '1080', '9.30');
INSERT INTO `ems_ob` VALUES ('ofb-0594', 20120901, '2012-10-11 09:03:00', 'Super 8, Blumentritt', '2012-10-09', '2012-10-09', 'Others|Dry Run Monitoring, Reset POS, and Z-Reading|', 'Approved', '', '510 ', '600', '1080', '8.0', '1170', '11.0');
INSERT INTO `ems_ob` VALUES ('ofb-0595', 20100301, '2012-10-11 17:16:00', 'Elite Fruit', '2012-10-09', '2012-10-11', 'Network|Others|User Training and set up of server and workstations|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0596', 20120301, '2012-10-12 10:16:00', 'Max''s/Makati', '2012-10-11', '2012-10-11', 'Meeting|', 'Approved', '', '540 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0597', 20120301, '2012-10-12 10:18:00', 'Manuela Corp./Alabang', '2012-10-11', '2012-10-11', 'Others|Submit accreditation|', 'Approved', '', '840 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0598', 20120301, '2012-10-12 10:20:00', 'Manuela Corp./Alabang', '2012-10-12', '2012-10-12', 'Others|Submit accrediation requirements. |', 'Approved', 'Contact person was not available yesterday (Oct.11).', '540 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0599', 20080603, '2012-10-12 13:36:00', 'classic character', '2012-10-12', '2012-10-12', 'Others|check automation error on synch manager on the server|', 'Approved', '', '390 ', '510', '675', '2.45', '780', '6.30');
INSERT INTO `ems_ob` VALUES ('ofb-0600', 20070801, '2012-10-13 11:21:00', 'Super 8/Blumentritt', '2012-10-08', '2012-10-08', 'Others|Assist Arvin on configuring all POS units, server and workstation|', 'Approved', '', '--Select-- ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0601', 20070801, '2012-10-13 11:22:00', 'Super 8/Blumentritt', '2012-10-12', '2012-10-12', 'Others|Store opening, live and monitoring|', 'Approved', '', '--Select-- ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0602', 20070801, '2012-10-13 11:29:00', '360', '2012-10-16', '2012-10-19', 'Others|CLP setup, demo and UAT|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0603', 20070801, '2012-10-13 16:55:00', 'Cardams HO', '2012-10-05', '2012-10-05', 'Others|Re-installation of Barter Primer version on server|', 'Approved', '', '--Select-- ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0604', 20120901, '2012-10-15 09:24:00', 'Super 8, Blumentritt', '2012-10-12', '2012-10-12', 'Others|On live monitoring|', 'Approved', '', '420 ', '720', '1320', '10.0', '1395', '16.15');
INSERT INTO `ems_ob` VALUES ('ofb-0605', 20120901, '2012-10-15 09:36:00', 'Elite Fruit, Binondo', '2012-10-02', '2012-10-03', 'Others|Barter Software Installation on server and workstation|', 'Approved', '', '480 ', '600', '2460', '31.0', '2580', '');
INSERT INTO `ems_ob` VALUES ('ofb-0606', 20120301, '2012-10-15 11:06:00', 'Brand For Less/ATC', '2012-10-15', '2012-10-15', 'Others|Store visit|', 'Confirmed', 'Prospect boutique client', '840 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0607', 20120302, '2012-10-16 11:10:00', 'Marketing', '2012-10-12', '2012-10-14', 'Others|Attended event of 11th Filipino Franchise Show last Oct. 12-14\r\n|', 'Cancelled', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0608', 20120301, '2012-10-16 11:38:00', 'MS Masuwerte/Lipa, Batangas', '2012-10-16', '2012-10-16', 'Others|Courtesy Call|', 'Confirmed', 'W/ AppTech (C. Sibayan)', '810 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0609', 20120601, '2012-10-18 11:24:00', 'DDS supermarket', '2012-10-16', '2012-10-16', 'Others|Physical count training|', 'Approved', '', '485 ', '640', '1075', '7.15', '1200', '11.05');
INSERT INTO `ems_ob` VALUES ('ofb-0610', 20120301, '2012-10-18 11:34:00', 'Negros', '2012-10-29', '2012-10-31', 'Others|Client mapping|', 'Confirmed', ' Janel''s, Munsterific, Others', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0611', 20120301, '2012-10-18 11:34:00', 'Max''s/Makati', '2012-10-19', '2012-10-19', 'Others|Courtesy Visit|', 'Approved', '', '540', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0612', 20120301, '2012-10-19 13:09:00', 'Zuellig Pharma', '2012-10-19', '2012-10-19', 'Meeting|', 'Confirmed', 'Status update', '1005', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0613', 20071002, '2012-10-22 10:40:00', 'mbtc wackwack', '2012-10-22', '2012-10-22', 'Others|withdraw dollars, deposit checks|', 'Approved', '', '--Select-- ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0614', 20070701, '2012-10-22 12:05:00', 'Mydin', '2012-10-22', '2012-11-05', 'Others|UAT Testing and Implementation|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0615', 20100301, '2012-10-22 13:29:00', 'Elite Fruit', '2012-10-16', '2012-10-16', 'Network|Others|Go Live!|', 'Approved', '', '480 ', '570', '1080', '8.30', '1200', '12.0');
INSERT INTO `ems_ob` VALUES ('ofb-0616', 20100301, '2012-10-22 13:31:00', 'Elite Fruit', '2012-10-18', '2012-10-18', 'Consultation|Others|monitoring!|', 'Approved', '', '480 ', '570', '1020', '7.30', '1140', '11.0');
INSERT INTO `ems_ob` VALUES ('ofb-0617', 20120301, '2012-10-22 14:50:00', 'Max''s/Makati', '2012-10-23', '2012-10-23', 'Meeting|', 'Confirmed', '', '540 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0618', 20100301, '2012-10-22 15:53:00', 'Elite Fruit', '2012-10-19', '2012-10-19', 'Others|Last day of monitoring and Turn-over to Support|', 'Approved', '', '510 ', '570', '750', '3.0', '780', '4.30');
INSERT INTO `ems_ob` VALUES ('ofb-0619', 20100301, '2012-10-22 16:00:00', 'HighMart', '2012-10-19', '2012-10-19', 'Others|installation|', 'Approved', '', '780 ', '900', '1080', '3.0', '1200', '7.0');
INSERT INTO `ems_ob` VALUES ('ofb-0620', 20070804, '2012-10-23 10:52:00', 'MYDIN', '2012-07-29', '2012-09-07', 'Others|UAT|', 'Cancelled', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0621', 20070804, '2012-10-23 10:52:00', 'MYDIN', '2012-07-29', '2012-09-07', 'Others|UAT\r\n1st trip|', 'Approved', '', '', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0622', 20070804, '2012-10-23 10:55:00', 'MYDIN', '2012-09-11', '2012-10-15', 'Others|UAT 2nd Trip|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0623', 20070804, '2012-10-23 11:04:00', 'MYDIN', '2012-10-19', '2012-11-17', 'Others|Implementation (3rd Trip)|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0624', 20120901, '2012-10-25 14:20:00', 'SUPER 8, DASMARINAS', '2012-10-23', '2012-10-23', 'Others|Software Installation|', 'Approved', '', '510 ', '600', '1050', '7.30', '1230', '12.0');
INSERT INTO `ems_ob` VALUES ('ofb-0625', 20120901, '2012-10-25 14:22:00', 'SUPER 8, DASMARINAS', '2012-10-24', '2012-10-24', 'Others|Software Installation|', 'Approved', '', '450 ', '540', '1125', '9.45', '1245', '13.15');
INSERT INTO `ems_ob` VALUES ('ofb-0626', 20100603, '2012-10-25 14:28:00', 'COH/CEBU', '2012-10-22', '2012-10-27', 'Meeting|Others|', 'Approved', 'COH- Consolacion Set Up and Live Monitoring and Issues Meeting and Updating', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0627', 20100301, '2012-10-25 18:30:00', 'Shoppers', '2012-10-25', '2012-10-25', 'Others|demo Barter WebModules|', 'Approved', '', '480 ', '570', '810', '4.0', '870', '6.30');
INSERT INTO `ems_ob` VALUES ('ofb-0628', 20120601, '2012-10-29 09:26:00', 'Elite', '2012-10-19', '2012-10-19', 'Others|Support turn over|', 'Approved', '', '480 ', '540', '720', '3.0', '785', '5.05');
INSERT INTO `ems_ob` VALUES ('ofb-0629', 20120601, '2012-10-29 09:32:00', 'High Mart', '2012-10-19', '2012-10-19', 'Others|Installation of Barter|', 'Approved', '', '790 ', '870', '1080', '3.30', '1200', '6.50');
INSERT INTO `ems_ob` VALUES ('ofb-0630', 20080604, '2012-10-31 10:50:00', 'iRipple', '2012-10-12', '2012-10-14', 'Others|Marketing Event:  11th AFFI at World Trade Center|', 'Denied', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0631', 20100301, '2012-10-31 18:09:00', 'High Mart', '2012-10-31', '2012-10-31', 'Others|Installation and Set Up of FTP for HQ and Branch. Orientation for UAT|', 'Approved', '', '480 ', '570', '960', '6.30', '1050', '9.30');
INSERT INTO `ems_ob` VALUES ('ofb-0632', 20100603, '2012-11-06 09:13:00', 'Super8/Dasma', '2012-10-30', '2012-10-31', 'Delivery|Others|', 'Cancelled', 'Super8 - Dasma Set-Up and Live Monitoring', '660 ', '960', '1830', '14.30', '2130', '24.30');
INSERT INTO `ems_ob` VALUES ('ofb-0633', 20100603, '2012-11-06 09:14:00', 'Super8/Dasma', '2012-10-30', '2012-11-01', 'Delivery|', 'Approved', 'Super8 - Dasma Set-Up and Live Monitoring', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0634', 20070801, '2012-11-07 18:02:00', 'Cardams HO', '2012-11-05', '2012-11-06', 'Others|Oct 5 - Installation of training units\r\nOct 6 - Assist on TS & AS first day of training (PO,RR,PR)|', 'Approved', '', '--Select-- ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0635', 20120601, '2012-11-08 11:47:00', 'DDS supermarket', '2012-11-05', '2012-11-05', 'Others|Installation and Configuration of 5POS|', 'Approved', '', '630 ', '710', '1145', '7.15', '1295', '11.5');
INSERT INTO `ems_ob` VALUES ('ofb-0636', 20070701, '2012-11-08 15:45:00', 'Mydin', '2012-11-12', '2012-12-08', 'Others|Project Implementation(UAT, Training and Go Live Monitoring)|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0637', 20120601, '2012-11-08 17:06:00', 'DDS supermarket', '2012-11-07', '2012-11-07', 'Others|Stand by support|', 'Approved', '', '455 ', '525', '1080', '9.15', '1215', '12.40');
INSERT INTO `ems_ob` VALUES ('ofb-0638', 20120601, '2012-11-09 09:01:00', 'Simplicity Mart', '2012-10-27', '2012-10-27', 'Others|Stand by Support|', 'Approved', '', '540 ', '660', '1320', '11.0', '1435', '14.55');
INSERT INTO `ems_ob` VALUES ('ofb-0639', 20080603, '2012-11-09 10:50:00', 'DD''s', '2012-11-07', '2012-11-07', 'Others|assist on their PCount inventory on their warehouse.|', 'Approved', '', '420 ', '510', '1100', '9.50', '1185', '12.45');
INSERT INTO `ems_ob` VALUES ('ofb-0640', 20100301, '2012-11-09 17:03:00', 'Cardams', '2012-11-06', '2012-11-16', 'Others|Barter Back End and POS training|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0641', 20120901, '2012-11-09 17:09:00', 'Super 8, Dasmarinas', '2012-10-30', '2012-11-01', 'Others|POS Setup and On live monitoring|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0642', 20120901, '2012-11-09 17:11:00', 'Cardams ', '2012-11-06', '2012-11-09', 'Others|Training and Examination|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0643', 20080101, '2012-11-09 18:07:00', 'LME/Bangkok', '2012-10-20', '2012-11-17', 'Others|Software Testing and Rollout|', 'Approved', '', '535 ', '540', '1320', '13.0', '1325', '13.05');
INSERT INTO `ems_ob` VALUES ('ofb-0644', 20070801, '2012-11-12 16:00:00', 'Cardams HO', '2012-11-08', '2012-11-09', 'Others|Data fix for unsent POS sales and products that were not transferred to branch|', 'Approved', '', '--Select-- ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0645', 20100601, '2012-11-13 18:10:00', 'Shoppers'' Mart', '2012-11-14', '2012-11-14', 'Others|Checking and fixing 3 POS problem|', 'Confirmed', '', '600 ', '660', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0646', 20100601, '2012-11-13 18:27:00', 'High Mart', '2012-11-14', '2012-11-14', 'Others|Dongle configuration|', 'Confirmed', '', '480 ', '585', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0647', 20120301, '2012-11-14 13:58:00', 'Guess-San Pedro, Laguna', '2012-11-15', '2012-11-15', 'Meeting|', 'Confirmed', '', '480 ', '--Select--', '--Select--', '', '--Select--', '');
INSERT INTO `ems_ob` VALUES ('ofb-0648', 20120301, '2012-11-14 14:01:00', 'Seminar/Makati City', '2012-11-13', '2012-11-15', 'Others|Creative selling seminar|', 'Approved', '', ' ', '', '', '', '', '');
INSERT INTO `ems_ob` VALUES ('ofb-0649', 20120601, '2012-11-14 18:35:00', 'DDS supermarket', '2012-11-09', '2012-11-09', 'Others|Stand by support (Pcount)|', 'Approved', '', '595 ', '720', '1175', '7.35', '1310', '11.55');
INSERT INTO `ems_ob` VALUES ('ofb-0650', 20120601, '2012-11-14 18:41:00', 'Super 8', '2012-11-13', '2012-11-13', 'Others|Stand by support|', 'Approved', '', '440 ', '615', '720', '1.45', '900', '7.40');
INSERT INTO `ems_ob` VALUES ('ofb-0651', 20120601, '2012-11-14 18:48:00', 'Super 8', '2012-11-14', '2012-11-14', 'Others|Installation and configuration of 1pos|', 'Denied', '', '480 ', '580', '750', '2.50', '900', '7.0');
INSERT INTO `ems_ob` VALUES ('ofb-0652', 20080603, '2012-11-16 11:23:00', 'classic character', '2012-11-15', '2012-11-15', 'Others|installation and set-up their newly purchased POS|', 'Approved', '', '420 ', '540', '690', '2.30', '780', '6.0');
INSERT INTO `ems_ob` VALUES ('ofb-0653', 20110402, '2013-01-07 13:38:00', 'test client', '2013-01-10', '2013-01-11', 'Network|', 'Approved', 'test', '25 ', '55', '--Select--', '28.10', '--Select--', '30.40');
INSERT INTO `ems_ob` VALUES ('ofb-0654', 20110402, '2013-01-11 09:24:00', 'test client 1', '2013-01-16', '2013-01-17', 'Network|', 'Pending for Confirmation', '', '540 ', '570', '--Select--', '32.30', '--Select--', '34.0');
INSERT INTO `ems_ob` VALUES ('ofb-0655', 20110402, '2013-01-11 09:24:00', 'test client 2', '2013-01-21', '2013-01-22', 'Consultation|', 'Denied', 'test', '00 ', '15', '1490', '24.35', '1500', '25.0');
INSERT INTO `ems_ob` VALUES ('ofb-0656', 20110402, '2013-01-11 10:16:00', 'test client 4', '2013-01-24', '2013-01-24', 'Delivery|', 'Pending for Confirmation', 'test', '265 ', '300', '425', '2.05', '--Select--', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_offset`
-- 

CREATE TABLE `ems_offset` (
  `offset_id` varchar(15) NOT NULL,
  `emp_num` int(15) NOT NULL,
  `date_filed` date NOT NULL,
  `date_ot` date NOT NULL COMMENT 'change data type to text or varchar',
  `date_ot2` varchar(1000) default NULL COMMENT 'data type was changed from date to varchar to store array of strings',
  `ot_hours` int(4) NOT NULL,
  `ot_hours2` varchar(1000) NOT NULL COMMENT 'data type was changed from int to varchar to store array of strings',
  `accomplishment` varchar(900) NOT NULL,
  `date_offset` date NOT NULL COMMENT 'Modified as FROM',
  `date_offset2` date default NULL COMMENT 'Modified as TO',
  `remarks` varchar(900) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY  (`offset_id`),
  KEY `emp_num` (`emp_num`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `ems_offset`
-- 

INSERT INTO `ems_offset` VALUES ('off-0001', 20100601, '2011-10-24', '2011-10-22', '0000-00-00', 1, '0', 'Suysing Event - Ingress', '2011-11-02', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0002', 20100603, '2011-10-24', '2011-10-22', '0000-00-00', 1, '0', 'Suy Sings 65 Anniversary', '2011-11-02', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0003', 20110402, '2011-10-24', '2011-10-22', '0000-00-00', 1, '0', 'Technical Support at Suysing suki Day', '2011-10-28', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0004', 20100602, '2011-10-24', '2011-10-22', '0000-00-00', 9, '0', 'Support/Setup for Suy Sing Preparation Day\r\n', '2011-10-28', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0005', 20100602, '2011-10-24', '2011-10-23', '0000-00-00', 9, '0', 'Support for Suy Sing Day', '2011-11-08', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0006', 20100601, '2011-10-24', '2011-10-23', '0000-00-00', 1, '0', 'Suysing Event - Egress', '2011-11-29', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0007', 20100401, '2011-10-25', '2011-10-22', '0000-00-00', 13, '0', 'Ingress for Suy Sing Suki Day', '2011-10-24', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0008', 20070801, '2011-10-28', '2011-09-04', '0000-00-00', 1, '0', 'Super Lifestyle Taguig live & monitoring', '2011-11-14', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0009', 20100401, '2011-11-02', '2011-10-23', '0000-00-00', 9, '0', 'Suy Sing Suki day', '2011-11-10', '0000-00-00', '', 'Cancelled');
INSERT INTO `ems_offset` VALUES ('off-0010', 20060901, '2011-11-02', '2011-10-22', '2011-10-23', 1, '1', 'Suy Sing Suki Day (Ingress > Egress)', '2011-11-17', '2011-11-18', '', 'Cancelled');
INSERT INTO `ems_offset` VALUES ('off-0011', 20100301, '2011-11-02', '2011-10-22', '0000-00-00', 12, '0', 'suy sing suki day Ingress', '2011-12-28', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0012', 20100301, '2011-11-02', '2011-10-23', '0000-00-00', 15, '0', 'Day of event and Egress', '2011-12-29', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0013', 20070804, '2011-11-02', '2011-10-22', '2011-10-23', 1, '1', 'SUY SING SUKI DAY', '2011-10-24', '2011-10-28', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0014', 20090702, '2011-11-03', '2011-10-22', '2011-10-23', 1, '1', 'Suy Sing Event (Ingress, Actual Event and Egress)', '2011-11-02', '2011-11-02', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0015', 20060901, '2011-11-03', '2011-10-26', '2011-10-28', 15, '15', 'Cheers Mart upgrade, monitoring & printer setup w/ TSadaya', '2011-11-28', '2011-11-29', '', 'Dennied');
INSERT INTO `ems_offset` VALUES ('off-0016', 20100401, '2011-11-08', '2011-11-23', '0000-00-00', 12, '0', 'Suy Sing Suki Day and Egress', '2011-11-10', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0017', 20060801, '2011-11-08', '2011-10-22', '0000-00-00', 12, '0', 'Suy Sing Suki Day Event Ingress', '2011-11-22', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0018', 20100201, '2011-11-09', '2011-10-22', '0000-00-00', 8, '0', 'Attended Suy Sing Suki Day', '2011-11-18', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0019', 20060901, '2011-11-10', '2011-10-22', '2011-10-23', 1, '1', 'Suy Sing Suki Day', '2011-11-28', '2011-11-29', '', 'Cancelled');
INSERT INTO `ems_offset` VALUES ('off-0020', 20080603, '2011-11-14', '2011-10-22', '0000-00-00', 1, '0', 'ingress for suki day.', '2011-11-17', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0021', 20080603, '2011-11-14', '2011-10-23', '0000-00-00', 1, '0', 'egress for suysing suki day.', '2011-12-06', '0000-00-00', '', 'Cancelled');
INSERT INTO `ems_offset` VALUES ('off-0022', 20070801, '2011-11-16', '2011-11-05', '0000-00-00', 1, '0', 'Prince Pardo Live', '2011-11-22', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0023', 20100401, '2011-11-17', '2011-11-13', '0000-00-00', 10, '0', 'Go Live Monitoring of Ever Roces', '2011-11-24', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0024', 20080801, '2011-11-17', '2011-10-23', '0000-00-00', 8, '0', 'Whole day Suysing Event. Helped as part of the team who assisted visitors and Susysing staff on the e-registration and helpdesk.', '2011-11-17', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0025', 20090501, '2011-11-21', '2011-10-23', '0000-00-00', 9, '0', 'Suki day (Actual event/egress)', '2011-11-28', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0026', 20060901, '2011-11-21', '2011-10-23', '0000-00-00', 1, '0', 'Suy Sing Suki Day', '2011-11-22', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0027', 20070804, '2011-11-22', '2011-11-20', '0000-00-00', 1, '0', '@ DVO, support Paris Hilton Abreeza and visited Gaisano Mall', '2011-11-24', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0028', 20070801, '2011-11-23', '2011-11-06', '0000-00-00', 1, '0', 'Prince Pardo monitoring', '2011-12-09', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0029', 20060901, '2011-11-28', '2011-10-22', '0000-00-00', 1, '0', 'Suy Sing Suki Day - Ingress', '2011-12-08', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0030', 20080603, '2011-12-02', '2011-11-26', '0000-00-00', 4, '0', 'check the accumulator of the POS.MDB of Lacoste ermita. edit the Z-reading due to discrepancy.', '2011-12-02', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0031', 20080603, '2011-12-02', '2011-11-26', '0000-00-00', 4, '0', 'check the accumulator of the POS.MDB of Lacoste ermita. edit the Z-reading due to discrepancy.', '2011-12-02', '0000-00-00', '', 'Cancelled');
INSERT INTO `ems_offset` VALUES ('off-0032', 20080603, '2011-12-02', '2011-11-26', '0000-00-00', 4, '0', 'check the accumulator of the POS.MDB of Lacoste ermita. edit the Z-reading due to discrepancy.', '2011-12-02', '0000-00-00', '', 'Cancelled');
INSERT INTO `ems_offset` VALUES ('off-0033', 20080603, '2011-12-02', '2011-11-26', '0000-00-00', 4, '0', 'check the accumulator of the POS.MDB of Lacoste ermita. edit the Z-reading due to discrepancy.', '2011-12-02', '0000-00-00', '', 'Cancelled');
INSERT INTO `ems_offset` VALUES ('off-0034', 20070801, '2011-12-06', '2011-11-06', '2011-11-07', 1, '1', 'Prince Pardo Monitoring', '2011-12-29', '2012-01-02', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0035', 20100603, '2011-12-07', '2011-10-23', '0000-00-00', 8, '0', 'Suy Sing 65 years anniversary.', '2011-12-28', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0036', 20080603, '2011-12-12', '2011-10-23', '0000-00-00', 1, '0', 'Egress of Suysing Suki Day', '2011-12-20', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0037', 20100201, '2011-12-14', '2011-12-22', '0000-00-00', 8, '0', 'Attended Suy Sing Suki Day.', '2011-12-16', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0038', 20090802, '2011-12-15', '2011-10-23', '0000-00-00', 8, '0', 'Suy Sing Suki Day.', '2011-12-27', '0000-00-00', '', 'Cancelled');
INSERT INTO `ems_offset` VALUES ('off-0039', 20090802, '2011-12-19', '2011-10-23', '0000-00-00', 8, '0', 'Suy Sing Suki Day.', '2011-12-28', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0040', 20070801, '2012-01-10', '2011-11-12', '0000-00-00', 1, '0', 'Prince Bogo Monitoring', '2012-01-09', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0041', 20070801, '2012-01-25', '2011-12-11', '0000-00-00', 1, '0', 'Super 8 Molino - Dry run', '2012-01-16', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0042', 20100903, '2012-02-06', '2012-01-21', '0000-00-00', 1, '0', 'Test onsite issues at COH HO for 2nd UAT.', '2012-02-13', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0043', 20070801, '2012-02-08', '2011-12-17', '0000-00-00', 1, '0', 'Super 8 Sto. Rosario - Setup', '2012-02-06', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0044', 20070801, '2012-02-08', '2011-12-18', '0000-00-00', 1, '0', 'Super 8 Sto. Rosario - Setup & Dry Run', '2012-02-27', '0000-00-00', '', 'Cancelled');
INSERT INTO `ems_offset` VALUES ('off-0045', 20100903, '2012-02-24', '2012-01-28', '0000-00-00', 1, '0', 'Test On Site issues and updates of COH for 2nd UAT', '2012-03-29', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0046', 20080801, '2012-03-05', '2012-02-26', '0000-00-00', 1, '0', 'Created tarpaulin design of company vision mission values and produced printout on the same day.', '2012-02-28', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0047', 20110402, '2012-03-16', '2012-03-15', '0000-00-00', 13, '0', 'Fix urgent Issue for Pentstar', '2012-03-16', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0048', 20110402, '2012-03-16', '2012-03-15', '0000-00-00', 13, '0', 'Fix urgent Issue for Pentstar', '2012-03-16', '0000-00-00', '', 'Cancelled');
INSERT INTO `ems_offset` VALUES ('off-0049', 20070804, '2012-03-17', '2012-02-25', '0000-00-00', 1, '0', 'Kevin enterprises kickoff meeting, bpa & encoding', '2012-03-21', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0050', 20100301, '2012-03-21', '2012-03-17', '0000-00-00', 14, '0', 'Nesabel-Bustos Opening Day', '2012-03-21', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0051', 20070705, '2012-03-23', '2012-02-25', '0000-00-00', 24, '0', '[Kevin Enterprises] BPA interview and encoder training', '2012-03-23', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0052', 20100603, '2012-03-26', '2012-03-26', '0000-00-00', 8, '0', '1st Day SuperLife Style - Caloocan Live monitoring', '2012-03-24', '0000-00-00', '', 'Cancelled');
INSERT INTO `ems_offset` VALUES ('off-0053', 20100603, '2012-03-26', '2012-03-24', '0000-00-00', 8, '0', 'Super Life Style - Caloocan 1st day live monitoring', '2012-03-26', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0054', 20070801, '2012-03-26', '2011-12-18', '0000-00-00', 1, '0', 'Super 8 Sto. Rosario - Setup & Dry Run', '2012-03-27', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0055', 20100602, '2012-03-27', '2012-03-25', '0000-00-00', 12, '0', 'Simplicity Upgrade Monitoring and Onsite Support', '2012-04-02', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0056', 20100401, '2012-04-03', '2012-04-01', '0000-00-00', 9, '0', 'Bootcamp day 3', '2012-04-02', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0057', 20070705, '2012-04-03', '2012-04-25', '0000-00-00', 24, '0', '[Kevin Enterprises] Meeting and Intial training for encoders.\r\n\r\nOffset for: Going home to Ilocos on April 4', '2012-04-04', '0000-00-00', '', 'Dennied');
INSERT INTO `ems_offset` VALUES ('off-0058', 20080801, '2012-04-03', '2012-04-01', '0000-00-00', 1, '0', 'Barter Support Boot Camp at Las Brisas Antipolo City', '2012-04-02', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0059', 20070701, '2012-04-03', '2012-02-25', '0000-00-00', 1, '0', 'Encoding Training for Kevin Enterprises', '2012-04-10', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0060', 20070701, '2012-04-03', '2012-03-17', '0000-00-00', 1, '0', 'Live of Nesabel Monitoring and set up', '2012-04-11', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0061', 20070705, '2012-04-03', '2012-03-18', '0000-00-00', 24, '0', 'Re-applied, wrong OT date changed to [Nesabel Bustos] went to Bustos to accompany TS in monitoring\r\n\r\noffset for: Going home to ilocos on April 4, wed', '2012-04-04', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0062', 20100603, '2012-04-10', '2012-03-25', '0000-00-00', 1, '0', 'SLS - CALOOCAN 1st day of live monitoring', '2012-04-10', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0063', 20100601, '2012-04-11', '2012-03-31', '0000-00-00', 1, '0', 'Day 3 Barter Support Bootcamp Training', '2012-04-30', '0000-00-00', '', 'Dennied');
INSERT INTO `ems_offset` VALUES ('off-0064', 20100601, '2012-04-16', '2012-04-01', '0000-00-00', 1, '0', 'Day 3 - Barter Support Bootcamp Training', '2012-04-20', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0065', 20080603, '2012-04-18', '2012-04-01', '0000-00-00', 11, '0', 'Barter Boot Camp (3rd Day)', '2012-04-30', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0066', 20090802, '2012-04-25', '2012-03-30', '0000-00-00', 8, '0', 'Attended as Trainer for Barter-Support Training/Bootcamp', '2012-05-02', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0067', 20100603, '2012-05-06', '2012-05-05', '0000-00-00', 1, '0', 'Powerhouse backend and pos exams', '2012-05-07', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0068', 20090702, '2012-05-08', '2012-04-01', '0000-00-00', 1, '0', 'Bootcamp training for Support', '2012-05-11', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0069', 20060801, '2012-05-10', '2012-04-01', '0000-00-00', 1, '0', 'Barter Boot Camp', '2012-05-11', '0000-00-00', '', 'Cancelled');
INSERT INTO `ems_offset` VALUES ('off-0070', 20100301, '2012-05-16', '2012-03-18', '0000-00-00', 1, '0', 'monitoring for nesabel bustos', '2012-05-15', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0071', 20100603, '2012-05-22', '2012-05-19', '0000-00-00', 1, '0', 'powerhouse live monitoring and super8 molino server transfer', '2012-05-22', '0000-00-00', '', 'Dennied');
INSERT INTO `ems_offset` VALUES ('off-0072', 20100603, '2012-05-22', '2012-05-19', '0000-00-00', 1, '0', 'powerhouse live monitoring and super8 molino server transfer', '2012-05-22', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0073', 20100301, '2012-05-24', '2012-05-01', '0000-00-00', 1, '0', 'Magic Mangaldan Upgrade and Monitoring', '2012-05-24', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0074', 20090702, '2012-05-24', '2012-05-19', '2012-05-20', 1, '1', 'Observed the current process in upgrading Barter - 05/19/2012\r\nUpgraded Barter MMS version of Cheers - 05/19/2012\r\nMonitored the Barter MMS upgrade - 05/20/2012', '2012-06-01', '2012-06-01', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0075', 20090802, '2012-05-25', '2012-05-06', '0000-00-00', 8, '0', 'Talked with Ms. Liza in the morning to discuss work and personal matters. Went to office in 25th in the afternoon to finish Starsol Agent importation.', '2012-06-06', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0076', 20070705, '2012-05-25', '2012-05-01', '0000-00-00', 1, '0', 'Magic CWO and Mangaldan upgrade', '2012-05-25', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0077', 20070804, '2012-05-28', '2012-05-26', '0000-00-00', 1, '0', '360 anniversary\r\n', '2012-05-30', '0000-00-00', '', 'Cancelled');
INSERT INTO `ems_offset` VALUES ('off-0078', 20070804, '2012-05-28', '2012-05-26', '0000-00-00', 1, '0', '360 Anniversary', '2012-05-29', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0079', 20100401, '2012-05-28', '2012-05-20', '0000-00-00', 1, '0', 'cheers upgrade', '2012-05-29', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0080', 20060801, '2012-05-29', '2012-05-27', '0000-00-00', 8, '0', 'ThreeSixty Pharmacy Anniversary Event', '2012-06-01', '0000-00-00', '', 'Denied');
INSERT INTO `ems_offset` VALUES ('off-0081', 20080604, '2012-05-30', '2012-05-26', '0000-00-00', 2, '0', 'Marketing Event - 1 day offset only', '2012-05-29', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0082', 20070705, '2012-06-06', '2012-05-06', '0000-00-00', 1, '0', '[Kevin Enterprises] Preparation for training', '2012-06-05', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0083', 20070804, '2012-06-08', '2012-05-27', '0000-00-00', 1, '0', '360 2nd Year Anniv', '2012-06-11', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0084', 20070701, '2012-06-10', '2012-06-09', '0000-00-00', 8, '0', 'Set up coh mactan and pardo for dry run', '2012-06-11', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0085', 20100301, '2012-06-11', '2012-05-06', '0000-00-00', 1, '0', 'Barter Users Training', '2012-06-11', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0086', 20070801, '2012-06-18', '2012-06-09', '0000-00-00', 1, '0', 'Meeting with Sir Alex at Shoppers Binondo (w/ JS)', '2012-06-14', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0087', 20090802, '2012-06-22', '2012-05-26', '0000-00-00', 8, '0', 'Finished revisions for POS and TX requirements for Super 8 RCBC-CLP migration Phase 1. I was able to create an initial version of RCBC Export report in Web.', '2012-07-04', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0088', 20110402, '2012-06-25', '2012-06-23', '0000-00-00', 1, '0', 'Finished RCBC-plugin enhancement for Super 8', '2012-07-06', '0000-00-00', '', 'Cancelled');
INSERT INTO `ems_offset` VALUES ('off-0089', 20090802, '2012-06-25', '2012-06-09', '0000-00-00', 8, '0', 'Was able to finish the remaining reports (Points Redeemed Report and Item Claims Report) for CLP, just have to add the configuration for the Customer Analytic tab.', '2012-08-01', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0090', 20100603, '2012-06-26', '2012-05-26', '0000-00-00', 8, '0', 'Installation and set-up for Sari-sari training', '2012-06-27', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0091', 20110402, '2012-06-27', '2012-06-21', '0000-00-00', 1, '0', 'Finished RCBC-plugin enhancement for Super 8', '2012-07-05', '0000-00-00', '', 'Pending');
INSERT INTO `ems_offset` VALUES ('off-0092', 20070701, '2012-07-03', '2012-06-12', '0000-00-00', 1, '0', 'Meeting with kevin entprises and after live monitoring.discuss next step and clp plans.', '2012-07-03', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0093', 20070701, '2012-07-03', '2012-06-12', '0000-00-00', 1, '0', 'Meeting with kevin entprises and after live monitoring.discuss next step and clp plans.', '2012-07-03', '0000-00-00', '', 'Cancelled');
INSERT INTO `ems_offset` VALUES ('off-0094', 20100301, '2012-07-03', '2012-06-09', '0000-00-00', 1, '0', 'Kevin opening day!', '2012-07-03', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0095', 20070801, '2012-07-03', '2012-06-30', '0000-00-00', 1, '0', 'Cardams Pre-live preparations, reset POS', '2012-07-03', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0096', 20090802, '2012-07-06', '2012-06-23', '0000-00-00', 8, '0', 'Finished the development for RCBC-CLP migration Phase 1 but was not able to be released by QA since they (AA and LE) had some difficulty with the RCBC plugin.', '2012-09-05', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0097', 20100301, '2012-07-08', '2012-06-10', '0000-00-00', 1, '0', 'Kevin 1st Day Monitoring', '2012-07-09', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0098', 20070705, '2012-07-09', '2012-06-09', '0000-00-00', 1, '0', 'Kevin Enterprises Live Implementation', '2012-06-28', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0099', 20070801, '2012-07-13', '2012-07-01', '0000-00-00', 1, '0', 'Cardams Live', '2012-07-12', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0100', 20070705, '2012-07-19', '2012-06-10', '0000-00-00', 1, '0', 'Kevin Enterprises live monitoring', '2012-07-18', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0101', 20070801, '2012-07-24', '2012-07-02', '0000-00-00', 1, '0', 'Cardams SM Megamall-Monitoring', '2012-07-18', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0102', 20070705, '2012-07-26', '2012-06-12', '0000-00-00', 1, '0', 'Kevin Enterprises Live and Monitoring', '2012-07-20', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0103', 20080603, '2012-07-26', '2012-07-18', '0000-00-00', 6, '0', 'upgrading W.Station, POS and server was already done', '2012-07-27', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0104', 20070801, '2012-07-31', '2012-07-22', '0000-00-00', 1, '0', 'Cardams SM Fairview - Live and monitoring', '2012-07-30', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0105', 20120602, '2012-08-10', '2012-08-11', '0000-00-00', 9, '0', 'I was absent on August 8, 2012 due to bad weather. Ways to the office are not passable.', '2012-08-08', '0000-00-00', '', 'Pending');
INSERT INTO `ems_offset` VALUES ('off-0106', 20100301, '2012-08-13', '2012-08-04', '0000-00-00', 1, '0', 'UAT day 3', '2012-08-13', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0107', 20100301, '2012-08-15', '2012-08-05', '0000-00-00', 1, '0', 're-migrated Head office database', '2012-08-14', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0108', 20070801, '2012-08-15', '2012-07-28', '2012-07-29', 1, '1', 'Cardams SM Sta. Rosa - Pre-live setup, live and monitoring', '2012-08-09', '2012-08-10', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0109', 20100603, '2012-08-17', '2012-06-02', '2012-06-09', 8, '8', 'June 2, 2012 - Sari-sari Breadstore\r\n - Installation and printer troubleshooting\r\n\r\nJune 9, 2012 - Sari-sari Breadstore\r\n - Last day of training and POS/Backend Examination\r\n\r\n\r\n', '2012-08-22', '2012-08-23', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0110', 20100301, '2012-08-29', '2012-08-29', '0000-00-00', 1, '0', 'Testing of Enhancements', '2012-08-28', '0000-00-00', '', 'Cancelled');
INSERT INTO `ems_offset` VALUES ('off-0111', 20070801, '2012-08-30', '2012-08-04', '2012-08-05', 1, '1', 'UAT for Lee Plaza Dumaguete', '2012-08-17', '2012-08-23', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0112', 20100301, '2012-08-30', '2012-08-11', '0000-00-00', 1, '0', 'Testing of Enhancements', '2012-08-28', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0113', 20070701, '2012-09-04', '2012-07-14', '0000-00-00', 8, '0', 'Training and Network  Set Up for Blue Fields', '2012-09-06', '0000-00-00', '', 'Cancelled');
INSERT INTO `ems_offset` VALUES ('off-0114', 20070701, '2012-09-04', '2012-07-28', '0000-00-00', 8, '0', 'COH POS and SAP Integration Testing', '2012-09-07', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0115', 20070801, '2012-09-06', '2012-09-02', '0000-00-00', 1, '0', 'Pre-live preparation and coin setup for Cardams Bacoor', '2012-09-05', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0116', 20070701, '2012-09-13', '2012-07-14', '0000-00-00', 8, '0', 'Network Set up and Training for Blue Fields', '2012-09-11', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0117', 20070701, '2012-09-13', '2012-07-28', '0000-00-00', 8, '0', 'COH Testing and Prelive ', '2012-09-10', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0118', 20100401, '2012-09-20', '2012-09-15', '0000-00-00', 1, '0', 'COH onsite visit and live monitoring.', '2012-09-19', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0119', 20100401, '2012-09-25', '2012-09-16', '0000-00-00', 1, '0', ' Onsite Visit and Live Monitoring ', '2012-09-27', '0000-00-00', '', 'Cancelled');
INSERT INTO `ems_offset` VALUES ('off-0120', 20090802, '2012-09-25', '2012-09-04', '2012-09-06', 7, '5', '09/04: Assisted Ms. JC for preparation for HD''s birthday. Helped Ms. Jen in setting up Barter F&B on HP Touchscreen unit (Windows POS Ready), including fixing of errors found.\r\n09/06: Finish formal receipt printing for LME Project. (OPOS-VB6)', '2012-09-26', '2012-09-26', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0121', 20100301, '2012-09-26', '2012-09-25', '0000-00-00', 9, '0', 'Set up machines for Agmark''s demo', '2012-09-26', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0122', 20100401, '2012-10-01', '2012-09-16', '0000-00-00', 1, '0', 'COH onsite visit and live monitoring.', '2012-10-04', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0123', 20080603, '2012-10-02', '2012-09-23', '0000-00-00', 8, '0', 'Set up POS Terminal and configuration of new terminal on Server for Budget new Branch ', '2012-10-19', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0124', 20080603, '2012-10-02', '2012-09-23', '0000-00-00', 1, '0', 'Set up POS Terminal and configuration of new terminal on Server for Budget new Branch ', '2012-10-19', '0000-00-00', '', 'Cancelled');
INSERT INTO `ems_offset` VALUES ('off-0125', 20100603, '2012-10-02', '2012-06-12', '0000-00-00', 8, '0', 'Bluefields Meeting w/ Ms Charry and product encoders checking', '2012-10-03', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0126', 20070804, '2012-10-09', '2012-08-04', '2012-08-11', 2, '2', 'MYDIN Uat\r\nOT dates: 4-5, 11-12 Aug 2012\r\n\r\nOffset dates: 16-19 Oct 2012', '2012-10-16', '2012-10-18', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0127', 20081101, '2012-10-12', '2012-10-06', '0000-00-00', 8, '0', 'Development and Testing of 360 CLP enhancement', '2012-10-15', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0128', 20080801, '2012-10-12', '2012-09-30', '0000-00-00', 8, '0', 'Training - MYDIN BATCH 2', '2012-10-15', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0129', 5012012, '2012-11-05', '2012-11-01', '0000-00-00', 1, '0', 'Nov. 1 support for Thailand LME Implementation', '2012-11-06', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0130', 20090802, '2012-11-06', '2012-09-10', '2012-09-11', 5, '8', 'For 09/10:\r\nHelped Ms. Jen for the revisions of the F&B Barter version for Max''s.\r\nFor 09/11:\r\nWent to Max''s office in Pasong Tamo with Ms. Yanni to update the Barter F&B prototype, setup the receipt printer and cash drawer and test the updated prototype with the order flow/bill-out/payment.', '2012-11-07', '2012-11-07', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0131', 20100603, '2012-11-06', '2012-06-16', '0000-00-00', 8, '0', 'Sari-Sari Breadstore Antique Branch Live Monitoring', '2012-11-07', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0132', 20070701, '2012-11-06', '2012-08-11', '0000-00-00', 1, '0', 'GO Live monitoring for Blue Fields Sta. Barbara', '2012-11-07', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0133', 20070701, '2012-11-07', '2012-08-26', '0000-00-00', 1, '0', 'COH Pardo Go Live set Up', '2012-11-07', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0134', 20070701, '2012-11-08', '2012-08-27', '0000-00-00', 1, '0', 'COH Pardo Go Live Monitoring ', '2012-12-21', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0135', 20070701, '2012-11-08', '2012-09-01', '2012-09-02', 1, '1', 'COH Mactan Pre Live and Go Live', '2012-12-26', '2012-12-27', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0136', 20070701, '2012-11-08', '2012-09-15', '2012-09-16', 1, '1', 'COH-Banilad Pre Live and Go Live Preparations ans Monitoring', '2012-12-28', '2013-01-02', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0137', 20070701, '2012-11-08', '2012-08-18', '2012-08-19', 1, '1', 'Mydin-Software Testing and Training Manual Documenttaion', '2013-01-03', '2013-01-04', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0138', 20070701, '2012-11-08', '2012-08-20', '2012-08-21', 1, '1', 'Mydin-Software Testing and  Training Material Documentation', '2013-01-07', '2013-01-08', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0139', 0, '2012-11-08', '2012-10-27', '0000-00-00', 9, '0', 'Stand by support at Simplicity Mart', '2012-11-06', '0000-00-00', '', 'Pending');
INSERT INTO `ems_offset` VALUES ('off-0140', 20120601, '2012-11-08', '2012-10-27', '0000-00-00', 8, '0', 'Stand by support at Simplicity Mart', '2012-11-06', '0000-00-00', '', 'Denied');
INSERT INTO `ems_offset` VALUES ('off-0141', 20100603, '2012-11-14', '2012-07-14', '0000-00-00', 8, '0', 'Bluefields - Training preparations and Network tower testing', '2012-11-15', '0000-00-00', '', 'Pending');
INSERT INTO `ems_offset` VALUES ('off-0142', 20080101, '2012-11-14', '2012-11-01', '0000-00-00', 9, '0', 'LME PROJECT', '2012-11-21', '0000-00-00', '', 'Pending');
INSERT INTO `ems_offset` VALUES ('off-0143', 20080101, '2012-11-14', '2012-10-26', '0000-00-00', 4, '0', 'LME PROJECT', '2012-11-19', '0000-00-00', '', 'Pending');
INSERT INTO `ems_offset` VALUES ('off-0144', 20080101, '2012-11-14', '2012-10-26', '0000-00-00', 4, '0', 'LME PROJECT', '2012-11-20', '0000-00-00', '', 'Pending');
INSERT INTO `ems_offset` VALUES ('off-0145', 20080101, '2012-11-14', '2012-11-02', '0000-00-00', 9, '0', 'LME PROJECT', '2012-11-22', '0000-00-00', '', 'Pending');
INSERT INTO `ems_offset` VALUES ('off-0146', 20080101, '2012-11-14', '2012-10-14', '0000-00-00', 9, '0', 'LME PROJECT', '2012-11-23', '0000-00-00', '', 'Pending');
INSERT INTO `ems_offset` VALUES ('off-0147', 20080101, '2012-11-14', '2012-10-20', '0000-00-00', 9, '0', 'LME PROJECT', '2012-11-26', '0000-00-00', '', 'Pending');
INSERT INTO `ems_offset` VALUES ('off-0148', 20080101, '2012-11-14', '2012-10-27', '0000-00-00', 9, '0', 'LME PROJECT', '2012-11-27', '0000-00-00', '', 'Pending');
INSERT INTO `ems_offset` VALUES ('off-0149', 20080101, '2012-11-14', '2012-10-28', '0000-00-00', 9, '0', 'LME PROJECT', '2012-11-28', '0000-00-00', '', 'Pending');
INSERT INTO `ems_offset` VALUES ('off-0150', 20080101, '2012-11-14', '2012-11-03', '0000-00-00', 9, '0', 'LME PROJECT', '2012-11-29', '0000-00-00', '', 'Denied');
INSERT INTO `ems_offset` VALUES ('off-0151', 20080101, '2012-11-14', '2012-11-10', '0000-00-00', 9, '0', 'LME PROJECT', '2013-01-02', '0000-00-00', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0152', 20080101, '2012-11-14', '2012-11-11', '0000-00-00', 9, '0', 'LME PROJECT', '2012-12-26', '0000-00-00', '', 'Denied');
INSERT INTO `ems_offset` VALUES ('off-0153', 5012012, '2012-11-15', '2012-11-02', '0000-00-00', 1, '0', 'Support for LME Implementation on pilot stores', '2013-01-03', '0000-00-00', '', 'Denied');
INSERT INTO `ems_offset` VALUES ('off-0154', 20090802, '2012-11-16', '2012-09-13', '2012-09-24', 6, '5', 'For Sept. 13: Fixed COH urgent problem regarding duplicate items in their HO and Branches due to the consignment items imported from SAP.\r\n\r\nFor Sept. 24: Be able to finish and send the update for LME''s formal receipt printing using C#.NET.', '2012-11-22', '2012-11-22', '', 'Approved');
INSERT INTO `ems_offset` VALUES ('off-0161', 20110402, '2013-04-19', '0000-00-00', '2013-04-17, 2013-04-19', 0, '1,2', 'test', '2013-04-17', '2013-04-19', '', 'Pending');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_ot`
-- 

CREATE TABLE `ems_ot` (
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `ems_ot`
-- 

INSERT INTO `ems_ot` VALUES ('ovt-0001', 20100603, '2011-10-10', '2011-10-10', 2, 1, 'Assigned Clients Consolidating Issues', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0002', 20100301, '2011-10-10', '2011-10-10', 2, 1, 'list of all issues pending with BC and dev', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0003', 20100602, '2011-10-13', '2011-10-12', 3, 1, 'To Complete Paris Hilton Harware upgrade', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0004', 20100401, '2011-10-14', '2011-10-14', 2, 1, 'data correct for Super 8, Tarlac POS 6 and Ortigas POS 22', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0005', 20100401, '2011-10-18', '2011-10-18', 2, 1, 'check problem why corrected zreading has double space. wait for HD''s tool to fix the double spacing because of repair.exe', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0006', 20090802, '2011-10-28', '2011-10-27', 6, 1, 'Fixed urgent bugs in EMS for launching: OB Confirmation and Approval when OB and date filed is on the same day. Upload latest EMS source version and database.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0007', 20110301, '2011-10-28', '2011-10-28', 5, 2, 'Preparation for Audit - preparation of schedules of accounts\r\n                                     Bank reconciliations\r\n                                     updating creditable withholding tax', 'Denied', '');
INSERT INTO `ems_ot` VALUES ('ovt-0008', 20100301, '2011-11-02', '2011-10-27', 7, 1, 'software upgrade from 8.4 to 8.5.3', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0009', 20100301, '2011-11-02', '2011-10-28', 5, 1, 'set up and configuration of ibm 1NR printer', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0010', 20110301, '2011-11-02', '2011-11-02', 2, 1, '1. Expanded withholding tax\r\n2. Petty cash schedule\r\n3. vat ', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0011', 20071002, '2011-11-02', '2011-11-02', 2, 1, '1. SEC Report - Sept 2011\r\n2. Accounts Receivable Schedule as of Oct 31, 2011 (including report for VAT computation purposes)', 'Cancelled', '');
INSERT INTO `ems_ot` VALUES ('ovt-0012', 20100201, '2011-11-02', '2011-11-02', 3, 1, 'sample', 'Cancelled', '');
INSERT INTO `ems_ot` VALUES ('ovt-0013', 20100201, '2011-11-02', '2011-11-01', 3, 1, 'sample lng po', 'Cancelled', '');
INSERT INTO `ems_ot` VALUES ('ovt-0014', 20100301, '2011-11-03', '2011-10-28', 3, 1, 'printer configuration and set up of ibm 1nr', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0015', 20110301, '2011-11-03', '2011-11-03', 2, 1, 'Bank Recon -1. Regular Account\r\n                     2. Third Party Account\r\n                     3. Special Party Account', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0016', 20090802, '2011-11-04', '2011-11-05', 8, 2, 'Be able to process general article IDOC files in SAP Agent and establish the functions needed for the other IDOCs as well. I need to finish this in order to be prepared for testing of SAP Agent in Cebu on Nov 14.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0017', 20110301, '2011-11-04', '2011-11-05', 5, 2, 'vat\r\nBank Reconciliation -regular account\r\nPreparation of schedules', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0018', 20090802, '2011-11-08', '2011-11-08', 2, 1, 'Be able to finish the parsing and importing of general article profile including validations in file and when importing the product(s) to Barter database. Need to finish SAP Agent as soon as possible in order to be prepared before testing in Cebu.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0019', 20090702, '2011-11-08', '2011-11-08', 2, 1, 'Test the update for LH#69/434 (Prince Blake)\r\nRelease the update for Issue#4367 (Gamot Publiko)', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0020', 20090802, '2011-11-09', '2011-11-09', 3, 1, 'Finish the parsing of General Article IDOC and be able to import it in the Barter database.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0021', 20091203, '2011-11-10', '2011-11-10', 2, 1, 'Prepare Training Material and Manuals.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0022', 20060901, '2011-11-10', '2011-10-26', 15, 1, 'Cheers Mart Upgrade', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0023', 20060901, '2011-11-10', '2011-10-27', 5, 1, 'Cheers Mart Upgrade/Monitoring', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0024', 20060901, '2011-11-10', '2011-10-28', 15, 1, 'Cheers Mart Upgrade/Printer setup/Monitoring', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0025', 20100603, '2011-11-14', '2011-11-03', 5, 1, 'Installation of Barter Software Upgrade Version 8.5.3a', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0026', 20100401, '2011-11-16', '2011-11-15', 3, 1, 'install 19 POS of Super 8 Molino', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0027', 20110301, '2011-11-16', '2011-11-16', 2, 1, 'Printing of Audit Confirmation letters\r\n               -Accounts Receivable Confirmation letters\r\n               -Accounts Payable Confirmation Letters', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0028', 20100401, '2011-11-17', '2011-11-16', 2, 1, 'installation and configuration of 19 printers for Super8 Molino', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0029', 20090702, '2011-11-24', '2011-11-26', 8, 1, 'Test 360 Updates as per CE''s request.\r\nAccording to CE, charge the OT to RX.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0030', 20110301, '2011-11-25', '2011-11-26', 6, 2, 'Housekeeping - Arrange all files for audit purposes\r\n                        CV''s,Billings,Contracts', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0031', 20100903, '2011-11-25', '2011-11-25', 2, 1, 'Test Issue #4430 of iMart', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0032', 20110402, '2011-11-26', '2011-11-26', 6, 1, 'Done fixing issue in pentstar POS (dev)', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0033', 20100301, '2011-11-28', '2011-11-24', 4, 1, 'hardware and barter onsite maintenance', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0034', 20100301, '2011-11-28', '2011-11-25', 6, 1, 'barter and hardware maintenance. re-arrange pos', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0035', 20100903, '2011-11-28', '2011-11-28', 2, 1, 'Test Issue #4430 of iMart for 2nd Cycle Test', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0036', 20090702, '2011-12-01', '2011-12-01', 2, 1, 'Finish the creation of IDOCS for Article, Set Article, EAN, Price and Promotions, Customer and Salesman', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0037', 20110301, '2011-12-01', '2011-12-01', 2, 1, 'Bank recon-regular account\r\n                 -third party account\r\n                 -SP account\r\n                 -BIR online', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0038', 20090702, '2011-12-02', '2011-12-03', 4, 2, 'Test COH Updates', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0039', 20090802, '2011-12-02', '2011-12-02', 3, 1, 'Initial Testing and Revision of Barter-SAP Agent for COH.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0040', 20090802, '2011-12-05', '2011-12-05', 6, 1, 'Revise and fix findings of QA to ready SAP Agent for demo on Tuesday. Optimize importation of profiles.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0041', 20100903, '2011-12-06', '2011-12-05', 6, 1, 'Test Issue LH#355: Printing of Invoice to regular dot-matrix printer of COH (2nd Cycle Test)', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0042', 20090702, '2011-12-06', '2011-12-05', 6, 1, 'Test SAP Agent Outbound - Profiles and Promotions of COH', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0043', 20100602, '2011-12-12', '2011-11-30', 10, 4, 'Whole day monitoring of Gaisano Gensan after Server Upgrade on bonifacio day', 'Denied', '');
INSERT INTO `ems_ot` VALUES ('ovt-0044', 20100602, '2011-12-12', '2011-11-30', 10, 4, 'Whole day monitoring of Gaisano Gensan after Server Upgrade', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0045', 20091203, '2011-12-14', '2011-12-17', 8, 2, 'General cleaning of reception area and pantry', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0046', 20100603, '2011-12-15', '2011-12-13', 4, 1, 'Prince NRA Backend Upgrade. Assisted for installation, settings configuration and final testing', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0047', 20100301, '2011-12-15', '2011-12-15', 2, 1, 'configuration and reset of 4 additional POS of cheers', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0048', 20100401, '2011-12-20', '2011-12-19', 5, 1, 'Go Live Monitoring - closing', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0049', 20100301, '2011-12-21', '2011-12-20', 2, 1, 'Support Magic Sta. Cruz unrecognized supplier', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0050', 20100603, '2011-12-22', '2011-12-21', 3, 1, 'Support Prince NRA pos issue and consolidate assigned client issues.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0051', 20100301, '2011-12-22', '2011-12-22', 2, 1, 'consolidated issues of all clients for check point meeting', 'Cancelled', '');
INSERT INTO `ems_ot` VALUES ('ovt-0052', 20090802, '2011-12-22', '2011-12-22', 6, 1, 'Finish changes for trimmed down version of Barter TX for Barter-SAP edition.\r\n- Limit menus\r\n- Limit User rights\r\n- Limit Terminal settings\r\n- No Administrator Group in User Groups', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0053', 20100903, '2011-12-22', '2011-12-22', 7, 1, 'TEST COH ISSUES', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0054', 20100301, '2011-12-23', '2011-12-21', 2, 1, 'consolidated issues of all clients for check point meeting', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0055', 20100903, '2011-12-23', '2011-12-23', 2, 1, 'TEST COH UPDATES', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0056', 20100903, '2011-12-27', '2011-12-27', 3, 1, 'Test remaining issues in Delivery Module of COH.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0057', 20090501, '2011-12-27', '2011-12-27', 5, 1, 'Release COH Delivery Report Preprinted With Composition format ', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0058', 20100201, '2011-12-27', '2011-12-27', 5, 1, 'Able to release Credit Memo Report and Delivery/Pickup Report for COH.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0059', 20100903, '2011-12-28', '2011-12-27', 5, 1, 'Test COH Form Printing and Delivery Module remaining issues.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0060', 20100903, '2011-12-29', '2011-12-29', 2, 1, 'Test COH updates for form printing and delivery reports.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0061', 20090501, '2011-12-29', '2011-12-29', 2, 1, 'COH: Finish Form Printing issues (8 formats).', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0062', 20090802, '2011-12-29', '2011-12-29', 3, 1, 'Finish revisions in journal copy printing of POS for COH.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0063', 20090702, '2011-12-29', '2011-12-29', 2, 1, 'Test pending COH Updates', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0064', 20090501, '2012-01-02', '2012-01-02', 3, 1, 'Combo Promo Feature in Advance Promotion', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0065', 20110301, '2012-01-03', '2012-01-03', 2, 1, '1. Adeo report - Manual Journal Dec 2011\r\n2. Expanded Withholding Tax - Dec 2011\r\n', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0066', 20090702, '2012-01-04', '2012-01-03', 6, 1, 'Finish the documentation of COH test scripts and prepare the hard copy to be given to the client for their UAT.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0067', 20110301, '2012-01-04', '2012-01-04', 2, 1, 'Update 2307 Form - Google Docs', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0068', 20100201, '2012-01-05', '2012-01-04', 2, 1, 'Set up promo, branch and HQ agent of Super 8 to have valid data. Able to start development for CLP Export plugin of Super 8.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0069', 20090501, '2012-01-06', '2012-01-05', 2, 1, 'Enhancement in POS for Combo Promo.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0070', 20100201, '2012-01-06', '2012-01-05', 2, 1, 'Continue the development of CLP Export plugin.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0071', 20100201, '2012-01-07', '2012-01-06', 2, 1, 'Continue the development of CLP Export plugin.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0072', 20090501, '2012-01-09', '2012-01-07', 6, 2, 'Printing of combo promo transaction.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0073', 20100201, '2012-01-09', '2012-01-07', 6, 2, 'Continue development for CLP Export Plugin. Auto Export and Terminator.txt.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0074', 20091203, '2012-01-09', '2012-01-06', 2, 1, '5''s in OMD office ', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0075', 20090702, '2012-01-09', '2012-01-07', 6, 2, 'Finish the test script for COH Promotions', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0076', 20110301, '2012-01-11', '2012-01-11', 2, 1, '1. Reclassification of expense account (HMO-OPEX ,Travel national)\r\n2. Third party cost account matching\r\n', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0077', 20090802, '2012-01-11', '2012-01-11', 2.5, 1, 'Run script to fix data of Super 8 regarding their GET 5 points promo: promocode - GPTS*1211B', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0078', 20110301, '2012-01-12', '2012-01-12', 2, 1, '1.reclassification of expense account\r\n2. accrual of revenue', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0079', 20110301, '2012-01-13', '2012-01-13', 3, 1, '1.Expanded witholding tax dec 2011\r\n2. Petty cash report as of jan 13,2011\r\n3. Check processing', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0080', 20091203, '2012-01-16', '2012-01-13', 2, 1, 'Prepare Training materials and manuals', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0081', 20091203, '2012-01-17', '2012-01-17', 5, 2, 'Assist Super Max for the Carpet Cleaning, General Cleaning in reception and other Admin  facilities.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0082', 20100401, '2012-01-17', '2012-01-17', 2, 1, 'Test dongle for Visayas Ave. installation', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0083', 20110301, '2012-01-20', '2012-01-19', 3, 1, 'Quarterly VAT payable', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0084', 20090702, '2012-01-30', '2012-01-30', 2, 1, 'Test Citihardware Updates to be included in Barter MMS 8.5.4 Release', 'Cancelled', '');
INSERT INTO `ems_ot` VALUES ('ovt-0085', 20090702, '2012-01-31', '2012-01-31', 2, 1, 'Test Citihardware Updates', 'Cancelled', '');
INSERT INTO `ems_ot` VALUES ('ovt-0086', 20110301, '2012-02-07', '2012-02-07', 2, 1, 'Bank recon - Regular\r\n                     Third Party\r\n                     Special Project', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0087', 20090702, '2012-02-09', '2012-02-08', 3, 1, 'Test Citihardware Updates.\r\n-  Setup of Citihardware Database for testing of HQ and Branch Database\r\n   -  Reset Transactions to avoid encountering PK error\r\n', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0088', 20090702, '2012-02-09', '2012-02-09', 3, 1, '1. Finish the testing of Citihardware Updates\r\n2. Document the Release Notes for Barter MMS 8.5.4\r\n3. Compile the Barter MMS 8.5.4 Installer', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0089', 20100903, '2012-02-09', '2012-02-09', 2, 1, 'Finish Barter POS Sales Management User Manual (Reports) for COH\r\nand other Profile Manuals.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0090', 20090702, '2012-02-10', '2012-02-10', 3, 1, 'Finish the testing of Barter MMS 8.5.4 Updates\r\nCompile the installer\r\nRelease the updates to Citihardware', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0091', 20090702, '2012-02-13', '2012-02-11', 10, 2, 'Finish the testing of updates for Barter MMS 8.5.4\r\nCreate test scripts for 8.5.4 Updates', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0092', 20090702, '2012-02-13', '2012-02-13', 2, 1, 'Release Barter MMS 8.5.4 updates to Citihardware', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0093', 20100903, '2012-02-14', '2012-02-10', 5, 1, 'Test Prince Blake and Prince Rhea updates for Barter 8.4 installer.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0094', 20100903, '2012-02-14', '2012-02-11', 7, 2, 'Test Citihardware, Prince Blake and Price Rhea issues for Barter 8.4 Installer deadline.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0095', 20090802, '2012-02-20', '2012-02-21', 2, 1, 'Finish merging of S8 and latest version of Barter 8 including TX, PX and Agents.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0096', 20110301, '2012-02-21', '2012-02-21', 2, 1, 'January -FS', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0097', 20100301, '2012-02-21', '2012-02-20', 4, 1, 'working upgraded version (Barter 8.5.4)\r\nissue: all documents before upgrade was blank upon opening the document', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0098', 20100301, '2012-02-22', '2012-02-21', 10, 1, 'Upgraded to Barter 8.5.4', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0099', 20110301, '2012-02-23', '2012-02-23', 2, 1, 'Finalizing January 2012 Balance Sheet', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0100', 20100301, '2012-02-24', '2012-02-23', 5, 1, 'upgraded version of Barter 8.4. Fixed issues arises after upgrade', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0101', 20110301, '2012-02-29', '2012-02-29', 2, 1, 'BIR Alphalist 1604E', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0102', 20100903, '2012-03-01', '2012-02-29', 2, 1, 'Test Issue #4706 Super 8 Enhancement for 3rd Cycle Test', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0103', 20110301, '2012-03-02', '2012-03-02', 3, 1, 'Expanded withholding tax Feb 2012\r\nVAT 2012\r\nCheck processing', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0104', 20090802, '2012-03-09', '2012-03-09', 3, 1, 'Finish revisions for Super 8''s enhancement regarding CLP Migration from Union Bank to RCBC bank.  Meeting regarding Shoppers Zamboanga for Starsol Agent.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0105', 20090802, '2012-03-12', '2012-03-12', 2, 1, 'Be able to submit the update regarding Super 8''s new process for CLP from Union bank to RCBC.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0106', 20100903, '2012-03-15', '2012-03-13', 2, 1, 'Test Issue#04704 CLP migration UNION BANK to RCBC of Super 8', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0107', 20090802, '2012-03-19', '2012-03-19', 3, 1, 'Finish CLP training material and be able to transact for Magic''s database for their HQ/ GC update.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0108', 20100903, '2012-03-22', '2012-03-19', 2.5, 1, 'Test Issue #4758 of Magic', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0109', 20090802, '2012-03-23', '2012-03-23', 3, 1, 'Be able to import basic profiles for Starsol Agent.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0110', 20100903, '2012-03-26', '2012-03-23', 6.5, 1, '1. Test Issue #4758 with revision using the set up of Magic.\r\n2. Release User Manuals for COH.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0111', 20100603, '2012-03-26', '2012-03-14', 2, 1, 'Support Power House for promotion error', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0112', 20110301, '2012-03-26', '2012-03-26', 3, 1, 'Printing,Binding of Reports for BOD meeting', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0113', 20100903, '2012-03-27', '2012-03-26', 3, 1, '1. Revised COH User Manuals as requested by Project Team\r\n2. Release COH update. (Report)', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0114', 20100201, '2012-03-28', '2012-03-27', 2.5, 1, 'Able to fixed QA findings in POS regarding reservation.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0115', 20090702, '2012-03-28', '2012-03-26', 3.5, 1, 'Compile COH installer and create training material for PCount', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0116', 20090702, '2012-03-28', '2012-03-27', 2, 1, 'Create the training material for PCount', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0117', 20090802, '2012-03-28', '2012-03-28', 3, 1, 'To be able to create a script to correct the points balance of customers of Nesabel and a script to correct the points earned of Super 8 historical transactions from Visayas Ave. branch', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0118', 20090702, '2012-03-29', '2012-03-29', 4.5, 1, 'Finish the training material for PCount/Bootcamp and send to EL, BV and CE', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0119', 20090802, '2012-04-03', '2012-04-02', 4.5, 1, 'Restored files (Backup/ RIRS/ IEMS/ SVN/ FTP) in Iripple server with sir HD, sir BV and Ms. JC.\r\nChecked the Price Checker module of COH (remote).', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0120', 20100903, '2012-04-03', '2012-04-03', 2, 1, 'Create Release Note for Barter Release 8.4.5c', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0121', 20091203, '2012-04-04', '2012-03-29', 2, 1, 'Printing and prepare Training Materials for Support Boot Camp', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0122', 20090802, '2012-04-04', '2012-04-03', 3, 1, 'Find bug in POS (S8 version) regarding Group Discount Promos wherein the P50 discount did not take effect in a small number of qualified transactions (offline customer).', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0123', 20100602, '2012-04-09', '2012-03-24', 14, 2, 'Need to upgrade Simplicity Barter Version.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0124', 20110402, '2012-04-10', '2012-03-26', 4.5, 1, 'Fixing of KLGFS urgent new preprinted form\r\n', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0125', 20100401, '2012-04-10', '2012-03-31', 10, 1, 'Boot camp day 2', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0126', 20100601, '2012-04-11', '2012-03-31', 11, 1, 'To finish day 2 Barter Support Training Bootcamp and RIRS demo', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0127', 20090802, '2012-04-12', '2012-04-12', 3, 1, 'Work on Starsol Agent. Fix OIC assignment feature of IEMS.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0128', 20080701, '2012-04-13', '2012-03-29', 3.5, 1, 'Attended IBM CTC SI Thanksgiving Night at Eastwood', 'Denied', '');
INSERT INTO `ems_ot` VALUES ('ovt-0129', 20120302, '2012-04-13', '2012-03-29', 3.5, 1, 'IBM Ctc Thanksgiving Night at Richmonde Hotel', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0130', 20110301, '2012-04-18', '2012-04-17', 4, 1, 'Printing of SEC reports', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0131', 20090802, '2012-04-20', '2012-04-20', 2.5, 1, 'Work on Starsol Agent product importation.', 'Cancelled', '');
INSERT INTO `ems_ot` VALUES ('ovt-0132', 20080701, '2012-04-23', '2012-04-20', 2, 1, 'Preparation of Quotations for Lee Plaza and Super 8, Answered Emails of Clients', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0133', 20090802, '2012-04-23', '2012-04-19', 2.5, 1, 'Worked on Starsol Agent Product Importation.', 'Cancelled', '');
INSERT INTO `ems_ot` VALUES ('ovt-0134', 20100201, '2012-04-26', '2012-04-25', 2, 1, 'Finish New, Open and Delete Order feature of Barter Queue Buster.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0135', 20120302, '2012-04-26', '2012-04-25', 4, 1, 'Epson Business Review & Awards Night', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0136', 20090702, '2012-04-30', '2012-04-30', 2, 1, 'Release Barter MMS 8.5.4D\r\nRelease Barter MMS Updater', 'Cancelled', '');
INSERT INTO `ems_ot` VALUES ('ovt-0137', 20100903, '2012-05-02', '2012-04-30', 3, 1, 'Release Updates for Susana and Create Release Notes for Barter 8.4.5d installer.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0138', 20100602, '2012-05-03', '2012-05-03', 3, 4, 'Fix Simplicity Price Verifier', 'Cancelled', '');
INSERT INTO `ems_ot` VALUES ('ovt-0139', 20100602, '2012-05-03', '2012-04-27', 3, 1, 'Fix Unisilver Server cannot Login ', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0140', 20100602, '2012-05-03', '2012-05-02', 4, 1, 'Fix Unisilver cannot login to server... upgrade Windows server to sp2 ', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0141', 20090802, '2012-05-06', '2012-05-06', 8, 2, 'Talked with Ms. Liza in the morning regarding personal concerns.\r\nWent to office with HD to setup and test Starsol in VMware.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0142', 20110301, '2012-05-07', '2012-05-04', 2, 1, 'Month-end closing - Bank Recon,Booking of Interest for Placement 1,2,3', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0143', 20100903, '2012-05-07', '2012-05-04', 3, 1, 'Test and Release Issue # 4889 of Magic.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0144', 20090702, '2012-05-08', '2012-05-04', 4.5, 1, 'Test and release the update for Issue#4834 and Issue#4838 of Citihardware', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0145', 20100903, '2012-05-10', '2012-05-09', 3, 1, 'Test Issue #486 for Second Cycle test and Release the update to CB', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0146', 20090702, '2012-05-10', '2012-05-09', 2.5, 1, 'Release the update for LH#486', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0147', 20100602, '2012-05-10', '2012-05-01', 3, 4, 'Need to fix price verifier', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0148', 0, '2012-05-15', '2012-05-14', 3, 1, 'Helped Rajiv regarding his problem with CLP BarterWebModules (latest version). Need to debug problem in order to find out the problem', 'Pending', '');
INSERT INTO `ems_ot` VALUES ('ovt-0149', 20090802, '2012-05-15', '2012-05-14', 3, 1, 'Helped Rajiv regarding his problem with CLP implementation wherein they were not able to add customers.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0150', 20110301, '2012-05-17', '2012-05-16', 3, 1, '17Q - Finalizing PSE Report', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0151', 20100602, '2012-05-25', '2012-05-23', 5, 1, 'Installation of Unisilver new server.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0152', 20100401, '2012-05-25', '2012-05-19', 15, 2, 'Cheers Upgrade.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0153', 20110301, '2012-05-25', '2012-05-25', 2, 1, 'CHECK PROCESSING', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0154', 20090802, '2012-05-26', '2012-05-26', 8, 2, 'Finish POS revisions and web export of new customers for RCBC for Super 8''s Phase 1 requirements for CLP RCBC migration.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0155', 20110301, '2012-05-29', '2012-05-29', 2, 1, 'revenue report monitoring', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0156', 20100903, '2012-05-30', '2012-05-30', 4, 1, 'Test Issue LH#496 CLP-RCBC Process Migration[PH1] and replicate reported issue of Super 8 with TL.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0157', 20090802, '2012-05-31', '2012-05-30', 4, 1, 'On Standby with LH for the testing of Super 8''s enhancement for RCBC CLP migration. Checked on Super 8''s issue regarding P50 group discount that did not take effect on some transactions.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0158', 20090802, '2012-05-31', '2012-05-31', 3, 1, 'Be able to release patch for bug for promos with specific card type and update for RCBC Phase 1.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0159', 20100903, '2012-06-01', '2012-06-01', 5, 1, 'Test and release Issue LH#496 of CLP-RCBC of Super 8 Phase 1', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0160', 20110301, '2012-06-02', '2012-06-02', 3, 2, 'Month-end Closing - Bank Recon -SP\r\n                                 Bank Recon -3P\r\n                                 Bank Recon -Regular', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0161', 20090702, '2012-06-04', '2012-05-31', 5, 1, 'Test and release the following issues of Citihardware:\r\n- 4154\r\n- 4309 \r\n- 4532\r\n- 4549\r\n- 4556\r\n- 4442\r\n- 3587\r\n- 4888', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0162', 20090802, '2012-06-05', '2012-06-04', 4, 1, 'Prepare CLP reports for checkpoints meeting for LME project.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0163', 20110301, '2012-06-05', '2012-06-05', 2, 1, 'VAT-May 2012', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0164', 20110301, '2012-06-08', '2012-06-08', 2, 1, 'Check processing', 'Cancelled', '');
INSERT INTO `ems_ot` VALUES ('ovt-0165', 20090802, '2012-06-09', '2012-06-09', 8, 2, 'To finish the CLP standard reports for LME checkpoint meeting on Monday.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0166', 20120302, '2012-06-11', '2012-06-11', 2.28, 1, 'Finalized the research &  summary of marketing database to be presented to Sales & Sir VJ last Friday morning.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0167', 20100903, '2012-06-13', '2012-06-08', 3.5, 1, 'Test Issue #510 Terminal Sales Report filter by Supplier\r\n(Urgent from Magic)', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0168', 20100903, '2012-06-13', '2012-06-09', 5.5, 1, 'Test Issue #510 Terminal Sales Report filtered by Supplier Second Cycle Test', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0169', 20100903, '2012-06-14', '2012-06-13', 2, 1, '1. Evaluates error encountered in the report with TS who is on field (Ever)\r\n2. Discuss Failed update of Super8 with TL\r\n3. Send a feedback to Starsol Team about the progress of the Starsol update.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0170', 20100401, '2012-06-14', '2012-06-13', 10, 1, 'Update old POS to new POS. Install POS for the formatted terminals.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0171', 20120601, '2012-06-14', '2012-06-13', 40, 1, 'Update 6 POS at DD''s Supermarket', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0172', 20090802, '2012-06-14', '2012-06-13', 2, 1, 'Helped CB regarding SCV''s Z-reading problem. Discussed the failed RCBC update with LE and helped her to send the Starsol logs for Shoppers to review the items that failed during the import testing.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0173', 20090802, '2012-06-22', '2012-06-23', 8, 2, 'Finish and release Super 8''s CLP-RCBC migration enhancements Phase 2 part1 with LE.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0174', 20120601, '2012-06-22', '2012-06-21', 5, 1, 'Set up pos at DDs supermarket', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0175', 20100903, '2012-06-25', '2012-06-22', 3, 1, 'Test Issue #496 Phase 1- Part 1 of Super 8 CLP Migration\r\n(RCBC Plugin)', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0176', 20100903, '2012-06-25', '2012-06-23', 11, 2, 'Test Issue #496 For 2nd Cycle Test\r\n- RCBC Plugin\r\n\r\nFirst Cycle\r\n- POS update\r\n- Web Module\r\n', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0177', 20090802, '2012-06-27', '2012-06-27', 2.5, 1, 'Finish POS revisions for RCBC Phase 2 and additional request for swiping of card in POS when Points payment is used.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0178', 20110301, '2012-07-03', '2012-07-03', 3, 1, 'Month end closing - Bank reconciliation,entries', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0179', 20110301, '2012-07-05', '2012-06-08', 2, 1, 'Check processing', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0180', 20080701, '2012-07-11', '2012-07-09', 2, 1, 'Quotation Preparation, GABC and Primer BIR POS application,Cheers HW Support ', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0181', 20120302, '2012-07-16', '2012-07-14', 7, 2, ' Finished database for telemarketing, Meeting for target action plan for marketing & Continue pending docs. & Start researching for Top Businesses.\r\n', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0182', 20120302, '2012-07-20', '2012-07-19', 3, 1, 'Made Summary & Pivot Table of Marketing Mapping', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0183', 20090802, '2012-07-21', '2012-07-21', 8, 2, 'Work on fingerprint sensor device integration in Barter for RG to be able to include the feature in the time-in/ time-out for Barter 9.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0184', 20080603, '2012-07-26', '2012-07-18', 5, 1, 'update Barter MMS Version of work station, POS, Server', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0185', 20110301, '2012-08-02', '2012-08-02', 2, 1, 'Month-end closing\r\nEntries for adeo\r\nclosing entries', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0186', 20110301, '2012-08-06', '2012-08-06', 2, 1, 'Month-end closing\r\nBank recon.closing entries', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0187', 20090802, '2012-08-10', '2012-08-11', 8, 2, 'Sir VJ assigned me to help Ms. JC to finish her reports for LME.\r\nMs. JC assigned me to work on the Salesman Attendance report by Business Type/Grade.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0188', 20090702, '2012-08-11', '2012-08-10', 2, 1, 'Test the update for LH#557 and LH#559 of Lee Plaza', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0189', 20120302, '2012-08-13', '2012-08-09', 2.5, 1, 'Assist PRA Exhibit ', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0190', 20120302, '2012-08-13', '2012-08-10', 7, 1, '2nd Day of PRA Event: Help to egress : deliver the units/materials to office ', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0191', 20090802, '2012-08-13', '2012-08-13', 2.5, 1, 'Finish the Salesman Attendance Report for LME project.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0192', 20120302, '2012-08-15', '2012-08-15', 2, 1, 'Finalized the units/materials that MU & MP will be bringing for the PASI Event at LFisher hotel Bacolod City', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0193', 20110301, '2012-08-20', '2012-08-20', 4, 4, 'VAT- july 2012\r\ncheck processing', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0194', 20080603, '2012-08-22', '2012-08-17', 5, 1, 'passed the test update and release to the client.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0195', 20100601, '2012-08-22', '2012-08-17', 3.5, 1, 'Barter Installation', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0196', 20120302, '2012-08-24', '2012-08-18', 4, 2, 'Assist Work n Play Delivery of remaining big units of Booth to Warehouse of JK at Gen. Luna. ', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0197', 20090702, '2012-08-27', '2012-08-23', 3, 1, 'Test and release the update for LH#576 and LH#579 of Regan\r\nEmail Reference: [Regan] Updates for LH#576 and LH#579 - Sales Reports not tally', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0198', 20120601, '2012-08-28', '2012-08-28', 2, 1, 'Standby support at Paris Hilton (Pentstar)', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0199', 20090702, '2012-08-28', '2012-08-27', 8, 4, 'Tested the updates for Super 8 and other client updates', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0200', 20090802, '2012-08-31', '2012-08-30', 2, 1, 'Conference call with SAP team for LME Project.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0201', 20110301, '2012-09-01', '2012-08-31', 2, 1, 'OT for Mydin Project - Expenses to be billed', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0202', 20110301, '2012-09-01', '2012-09-01', 5, 2, 'OT for Mydin Project - Expenses to be billed\r\nCash advances journal entry - local and foriegn transactions', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0203', 20080701, '2012-09-04', '2012-09-04', 2, 1, 'Answered emails of clients, bir pos applications and hardware quotes', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0204', 20090802, '2012-09-04', '2012-09-04', 6.5, 1, 'Assisted Ms. JC for preparation for HD''s birthday. Helped Ms. Jen in setting up Barter F&B on HP Touchscreen unit (Windows POS Ready), including fixing of errors found.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0205', 20090802, '2012-09-07', '2012-09-06', 5, 1, 'Finish formal receipt printing for LME Project.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0206', 20090802, '2012-09-11', '2012-09-10', 5, 1, 'Helped Ms. Jen for the revisions of the F&B Barter version for Max''s.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0207', 20090802, '2012-09-13', '2012-09-11', 7.5, 1, 'Went to Max''s office in Pasong Tamo with Ms. Yanni to update the Barter F&B prototype, setup the receipt printer and cash drawer and test the updated prototype with the order flow/bill-out/payment.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0208', 20080701, '2012-09-13', '2012-09-12', 2, 1, 'Scanning and Collating  of Epson and Grandtech Documents for submission, assisted Paramount in Hardware Concerns', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0209', 20090802, '2012-09-13', '2012-09-13', 6, 1, 'Fixed COH urgent problem regarding duplicate items in their HO and Branches due to the consignment items imported from SAP.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0210', 20110301, '2012-09-14', '2012-09-14', 2, 1, 'check processing for iRipple and RMDC', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0211', 20110301, '2012-09-20', '2012-09-19', 2, 1, 'update of revenue report', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0212', 20110301, '2012-09-20', '2012-09-20', 3, 1, 'vat -august 2012', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0213', 20120901, '2012-09-24', '2012-09-24', 2, 1, 'to finish installation of barter POS on 13 machines.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0214', 20090802, '2012-09-25', '2012-09-22', 8, 2, 'Worked on LME formal receipt printing. Started to create the program using C# in .NET since there are difficulties in terms of handling unicode characters in POS printing using VB6.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0215', 20090802, '2012-09-25', '2012-09-24', 5, 1, 'Be able to finish and send the update for LME''s formal receipt printing using C#.NET.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0216', 20100401, '2012-09-26', '2012-09-25', 3, 1, 'guide Olive to install and configure POS, Backend, Webservice and CLP.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0217', 20100603, '2012-09-26', '2012-09-25', 9, 1, 'Set-up for COH and Standard barter version in demo unit for PNG prospect client presentation', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0218', 20100603, '2012-09-27', '2012-09-26', 2, 1, 'COH Issues Replication', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0219', 20100301, '2012-09-28', '2012-09-28', 8, 1, 'Set Up Machines for Agmark''s demo', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0220', 20120601, '2012-10-01', '2012-09-25', 4, 1, 'Installation and Configuration of Barter, CLP', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0221', 20100603, '2012-10-02', '2012-09-27', 2, 1, 'POS Set-up for Marketing and Hardware events', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0222', 20100603, '2012-10-02', '2012-09-28', 2, 1, 'COH Issue fixing and meeting with Sir BV', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0223', 20120302, '2012-10-03', '2012-09-28', 6, 1, 'Egress: Delivered units/marketing materials to the iRipple office last Customer Loyalty Event, held at Crowne Plaza.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0224', 20080701, '2012-10-04', '2012-10-03', 3, 1, 'BIR Applications for GABC,collate primer orders and preparation of demo to radc ', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0225', 20110301, '2012-10-04', '2012-10-04', 2, 1, 'update revenue monitoring', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0226', 20100301, '2012-10-06', '2012-10-06', 5, 2, 'Demo and Set up AP Link for Lee Plaza testing', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0227', 20110201, '2012-10-08', '2012-09-24', 2.5, 1, 'Daily Time Record transactions (c/o Admin)', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0228', 20070801, '2012-10-09', '2012-10-06', 5, 2, 'Test CLP issues for 360 client', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0229', 20110301, '2012-10-09', '2012-10-09', 2, 1, 'bank recon - regular account', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0230', 20100301, '2012-10-10', '2012-10-09', 4, 1, 'Printed UAT for sign off and Daily Stock Activity Report for Elite', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0231', 20080701, '2012-10-10', '2012-10-09', 2, 1, 'BIR Applications, P.O. preparation, sending of bir processed applications to clients', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0232', 20120302, '2012-10-11', '2012-10-10', 2, 1, 'Prepared all the marketing materials for the ingress, documents and send eblast invite to our client. ', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0233', 20070801, '2012-10-13', '2012-10-12', 2, 1, 'Resolve issue on Cardams Fairview wherein Card details are not sent to branch level (for back dated sales)', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0234', 20070801, '2012-10-13', '2012-10-13', 5, 2, 'Test remaining issues for 360 CLP deployment', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0235', 20120302, '2012-10-16', '2012-10-13', 5, 2, '2nd Day of the Event: 11th Filipino Franchise Show at World Trade Center\r\n', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0236', 20120302, '2012-10-16', '2012-10-14', 13, 2, 'Event Egress: Delivered Marketing Materials to iRipple Office.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0237', 20080701, '2012-10-17', '2012-10-15', 2, 1, 'BIR POS Applications, bir sticker preparation and printing', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0238', 20110301, '2012-10-23', '2012-10-23', 2, 1, 'entries for check processing - iripple,imaghine,rmdc', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0239', 20090802, '2012-10-25', '2012-10-24', 4, 1, 'Be able to submit changes in Promo Manager and POS (Simplicity''s version) to cater clients promo regarding Coupon promo to be implemented the following day.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0240', 20110301, '2012-10-25', '2012-10-27', 4, 2, 'Preparation for Interim audit,month end closing', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0241', 20090802, '2012-10-26', '2012-10-26', 6, 4, 'Need to test/fix new formal receipt printing for LME as committed to Ms. Rachel.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0242', 0, '2012-10-29', '2012-10-23', 3, 1, 'bir pos applications,logging of po''s, si and dr''s to xero, si and dr preparation for deliveries, endorsement of tasks ', 'Pending', '');
INSERT INTO `ems_ot` VALUES ('ovt-0243', 20080701, '2012-10-29', '2012-10-23', 3, 1, 'bir pos applications,logging of po''s, si and dr''s to xero, si and dr preparation for deliveries, endorsement of tasks ', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0244', 20090802, '2012-10-31', '2012-11-01', 8, 4, 'Need to standby for LME Go live for immediate support necessary.', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0245', 20110501, '2012-10-31', '2012-10-20', 8, 2, 'Support LME Team in Thailand', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0246', 20110501, '2012-10-31', '2012-10-21', 4, 2, 'Support LME Team in Thailand', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0247', 20110501, '2012-10-31', '2012-10-26', 8, 4, 'Support LME Team in Thailand', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0248', 20110301, '2012-11-05', '2012-11-05', 2, 1, 'Bank recon - MBTC dollar wack2', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0249', 20110501, '2012-11-06', '2012-11-01', 10, 4, 'Standby:  LIVE - LME', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0250', 20080701, '2012-11-06', '2012-11-06', 2, 1, 'bir pos applications and quotation preparation', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0251', 20110301, '2012-11-07', '2012-11-07', 2, 1, 'entries for reimbursable from employee', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0252', 20110301, '2012-11-08', '2012-11-08', 2, 1, 'Trial Balance schedule', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0253', 20110301, '2012-11-09', '2012-11-09', 3, 1, 'trial balance schedule', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0254', 20110301, '2012-11-13', '2012-11-12', 2, 1, 'VAT - OCtober 2012', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0255', 20110301, '2012-11-13', '2012-11-13', 2, 1, 'finalizing  report for SEC-17Q', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0256', 20110301, '2012-11-17', '2012-11-17', 4, 2, 'Preparation for audit ', 'Pending', '');
INSERT INTO `ems_ot` VALUES ('ovt-0257', 20110402, '2013-01-07', '2013-01-02', 12, 1, 'test', 'Approved', '');
INSERT INTO `ems_ot` VALUES ('ovt-0258', 20110402, '2013-01-11', '2013-01-10', 2, 3, 'test', 'Denied', '');
INSERT INTO `ems_ot` VALUES ('ovt-0259', 20110402, '2013-01-11', '2013-01-09', 3, 1, 'test', 'Pending', '');
INSERT INTO `ems_ot` VALUES ('ovt-0260', 20110402, '2013-01-11', '2013-01-10', 5, 2, 'test', 'Pending', '');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

-- 
-- Dumping data for table `ems_photos`
-- 

INSERT INTO `ems_photos` VALUES (1, 20110402, 'photos/382722_1636119998270_1694837533_828913_19046596_n.jpg');
INSERT INTO `ems_photos` VALUES (5, 20060801, 'photos/Portrait.jpg');
INSERT INTO `ems_photos` VALUES (7, 20071002, 'photos/ven.JPG');
INSERT INTO `ems_photos` VALUES (9, 20110301, 'photos/IMG_0750.JPG');
INSERT INTO `ems_photos` VALUES (11, 20091203, 'photos/216801_1800713269554_1591485349_31718040_7486437_n.jpg');
INSERT INTO `ems_photos` VALUES (12, 20110201, 'photos/DSC00113.jpg');
INSERT INTO `ems_photos` VALUES (15, 20060901, 'photos/f (286).jpg');
INSERT INTO `ems_photos` VALUES (16, 20070701, 'photos/IMG20110227_001.jpg');
INSERT INTO `ems_photos` VALUES (17, 20100201, 'photos/kuha(030).jpg');
INSERT INTO `ems_photos` VALUES (18, 20100303, 'photos/me.jpg');
INSERT INTO `ems_photos` VALUES (19, 20100903, 'photos/221872_120530081360280_119592004787421_167793_4720910_a.jpg');
INSERT INTO `ems_photos` VALUES (20, 20090802, 'photos/Me2.jpg');
INSERT INTO `ems_photos` VALUES (21, 5012012, 'photos/polgasWithLaptopgif.gif');
INSERT INTO `ems_photos` VALUES (22, 20120302, 'photos/314338_273799449319371_100000679530071_899434_1964030725_n.jpg');

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
  PRIMARY KEY  (`remarks_id`),
  KEY `emp_num` (`emp_num`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=96 ;

-- 
-- Dumping data for table `ems_remarks`
-- 

INSERT INTO `ems_remarks` VALUES (1, 'ER2011001', 20100603, 'created: Oct 10, 2011 06:20:06 pm', 'This should be in reserve equipment.');
INSERT INTO `ems_remarks` VALUES (2, 'ofb-0003', 20100602, 'created: Oct 13, 2011 09:38:57 am', 'Task Complete and successfull');
INSERT INTO `ems_remarks` VALUES (3, 'ER2011002', 1, 'created: Oct 25, 2011 04:59:51 pm', 'Please process immediately or check if there are other available mouse.<br />\r\n<br />\r\n- Ice');
INSERT INTO `ems_remarks` VALUES (4, 'ER2011002', 1, 'created: Oct 28, 2011 03:28:45 pm', 'No available mouse. This is for CA.<br />\r\n<br />\r\nJane');
INSERT INTO `ems_remarks` VALUES (5, 'ovt-0007', 20071002, 'created: Oct 28, 2011 04:00:46 pm', 'Jona, let''s start OT by 9am so we can finish by 3pm');
INSERT INTO `ems_remarks` VALUES (6, 'ER2011003', 1, 'created: Nov 02, 2011 12:59:05 pm', 'Already being processed while waiting for Ms. Julie''s approval since this is as per CEO request.');
INSERT INTO `ems_remarks` VALUES (7, 'off-0010', 20060901, 'created: Nov 02, 2011 03:42:17 pm', 're-scheduled');
INSERT INTO `ems_remarks` VALUES (8, 'lve-0012', 20071002, 'created: Nov 02, 2011 04:53:08 pm', 'Reunion');
INSERT INTO `ems_remarks` VALUES (9, 'lve-0019', 20080604, 'created: Nov 02, 2011 06:58:10 pm', 'HR please check if CM still has SL days left.');
INSERT INTO `ems_remarks` VALUES (10, 'lve-0020', 20080604, 'created: Nov 02, 2011 06:58:58 pm', 'CM to follow is the formal letter regarding this event.');
INSERT INTO `ems_remarks` VALUES (11, 'lve-0019', 1, 'created: Nov 03, 2011 10:42:39 am', 'Ms. Meanne, CM is no SL credit this will be deducted to her salary.');
INSERT INTO `ems_remarks` VALUES (12, 'ER2011002', 1, 'created: Nov 03, 2011 11:52:12 am', 'This is already CA by Ms. Barbie November 2, 2011.');
INSERT INTO `ems_remarks` VALUES (13, 'ER2011002', 20110402, 'created: Nov 03, 2011 02:51:14 pm', 'Thanks iEMS Admin :)');
INSERT INTO `ems_remarks` VALUES (14, 'ovt-0010', 20110301, 'created: Nov 03, 2011 05:52:43 pm', 'ms ven,<br />\r\n<br />\r\nI was not able to make the expanded withholding tax payable last night because there was a problem on my xero account..an internet connection problem but i was able to make it today for check processing purposes.<br />\r\n<br />\r\nThanks...');
INSERT INTO `ems_remarks` VALUES (15, 'ER2011004', 1, 'created: Nov 08, 2011 09:35:55 am', 'kindly do the CA for purchasing the mouse.');
INSERT INTO `ems_remarks` VALUES (16, 'ER2011005', 20080604, 'created: Nov 10, 2011 11:19:37 am', 'Con, let Sir Hubert counter sign in the document.  And please, don''t charge this in our Department ha.  Thanks!');
INSERT INTO `ems_remarks` VALUES (17, 'off-0015', 20091201, 'created: Nov 10, 2011 03:00:59 pm', 'Offset request is denied.  <br />\r\nAs per HR, offset should come from work rendered over the weekend. <br />\r\nFor this purpose, please file overtime and an allowance of 800, in total, will be added to your next salary.');
INSERT INTO `ems_remarks` VALUES (18, 'ER2011005', 20080701, 'created: Nov 10, 2011 05:16:36 pm', 'I already asked Sir Hubs and Sir Ben to sign po before I forwarded the doc to Ms. Jane for her action.thanks');
INSERT INTO `ems_remarks` VALUES (19, 'ovt-0022', 20060901, 'created: Nov 11, 2011 11:23:51 am', '630am-330pm: cubao-santiago,isabela<br />\r\n700pm-700am: day 1');
INSERT INTO `ems_remarks` VALUES (20, 'ovt-0023', 20060901, 'created: Nov 11, 2011 11:24:07 am', '12pm-2am: day 2');
INSERT INTO `ems_remarks` VALUES (21, 'ovt-0024', 20060901, 'created: Nov 11, 2011 11:24:21 am', '830am-800pm: day 3<br />\r\n830pm-600am: santiago,isabela-taytay,rizal');
INSERT INTO `ems_remarks` VALUES (22, 'air-0002', 20110201, 'updated last: Nov 11, 2011 02:37:58 pm', 'Please be advised that the ticket should be paid on or before 2:30pm on November 13, 2011 at the following ticketing offices: NAIA, Cubao, Pasay, Domestic Airport. reservation number is: HFGPLT');
INSERT INTO `ems_remarks` VALUES (23, 'ER2011008', 20091203, 'created: Nov 14, 2011 11:15:09 am', 'the USB should be 4GB.');
INSERT INTO `ems_remarks` VALUES (24, 'ER2011007', 1, 'created: Nov 14, 2011 02:04:15 pm', 'Hi Ms. Juvi, this request is for Equipment Reservation. Thanks!');
INSERT INTO `ems_remarks` VALUES (25, 'off-0019', 20060901, 'created: Nov 21, 2011 04:51:56 pm', 'nov29 moved to nov22');
INSERT INTO `ems_remarks` VALUES (26, 'ofb-0028', 20060901, 'created: Nov 21, 2011 04:55:16 pm', 'nov14-18');
INSERT INTO `ems_remarks` VALUES (27, 'ER2011012', 1, 'created: Nov 24, 2011 09:31:05 am', 'Already process waiting for Ms. Liza Signature to be forwarded to our COO for signing.');
INSERT INTO `ems_remarks` VALUES (28, 'ovt-0029', 20081101, 'created: Nov 24, 2011 09:38:58 am', 'This OT is under RX Opex as per request of CE');
INSERT INTO `ems_remarks` VALUES (29, 'lve-0052', 20080604, 'created: Dec 02, 2011 11:43:08 am', 'As per checking, the event this afternoon is not okay as an emergency leave.  This should have been a scheduled leave.  But for utmost consideration, I will consider this.  This is the first and last time.');
INSERT INTO `ems_remarks` VALUES (30, 'off-0028', 20070701, 'created: Dec 02, 2011 05:36:20 pm', 'this is cancelled');
INSERT INTO `ems_remarks` VALUES (31, 'lve-0054', 20070701, 'created: Dec 07, 2011 11:01:22 am', 'this is cancelled');
INSERT INTO `ems_remarks` VALUES (32, 'lve-0068', 20070701, 'created: Dec 12, 2011 12:22:17 pm', 'Deducted ton Salary for Zero leave');
INSERT INTO `ems_remarks` VALUES (33, 'ofb-0076', 20060901, 'created: Dec 12, 2011 05:30:22 pm', 'HR related-breakfast coffee w/ Ms Liza @ Starbucks Silver City');
INSERT INTO `ems_remarks` VALUES (34, 'ofb-0080', 20060801, 'created: Dec 13, 2011 12:39:46 am', 'How come the duration is 13 hours?');
INSERT INTO `ems_remarks` VALUES (35, 'ofb-0084', 20100603, 'created: Dec 14, 2011 11:18:45 am', 'Assisted through remote and phonecall Ms Kim of Prince NRA for Barter MMS upgrade');
INSERT INTO `ems_remarks` VALUES (36, 'off-0038', 20090802, 'created: Dec 15, 2011 01:11:59 pm', 'Family Outing/ Gathering.');
INSERT INTO `ems_remarks` VALUES (37, 'ofb-0084', 20060801, 'created: Dec 15, 2011 01:42:16 pm', 'Please edit the time to 9pm not 830pm');
INSERT INTO `ems_remarks` VALUES (38, 'off-0038', 20090802, 'created: Dec 19, 2011 03:47:06 pm', 'Cancelled. Outing was moved to Dec. 28, 2011.');
INSERT INTO `ems_remarks` VALUES (39, 'ovt-0054', 20100301, 'created: Dec 26, 2011 11:32:51 am', 'this OT is already approved by sir ian but due to incorrect OT date, it was re-applied. :)');
INSERT INTO `ems_remarks` VALUES (40, 'ovt-0054', 1, 'created: Dec 29, 2011 11:34:58 am', 'Noted on this and this is already credited to your December 30 payroll.');
INSERT INTO `ems_remarks` VALUES (41, 'ofb-0080', 20100301, 'created: Jan 04, 2012 03:18:34 pm', 'sir ian,system po ngcocompute. we have no idea.');
INSERT INTO `ems_remarks` VALUES (42, 'rsv-0012', 20110201, 'updated last: Jan 05, 2012 01:45:44 pm', 'the Epson (white) projector will be used from 10:00am-11:00am c/o Ms. J. Habacon');
INSERT INTO `ems_remarks` VALUES (43, 'ovt-0074', 20111101, 'created: Jan 09, 2012 10:56:14 am', 'This is a late advise but OT is attested by OMD Head to be true and valid.');
INSERT INTO `ems_remarks` VALUES (44, 'ofb-0107', 20080701, 'created: Jan 12, 2012 02:36:17 pm', 'Pick up of Disposal Documents from Anson Pasong Tamo Branch');
INSERT INTO `ems_remarks` VALUES (45, 'lve-0132', 20110402, 'created: Jan 12, 2012 03:52:24 pm', '');
INSERT INTO `ems_remarks` VALUES (46, 'ofb-0107', 20080604, 'created: Jan 16, 2012 01:50:30 pm', '');
INSERT INTO `ems_remarks` VALUES (47, 'ofb-0115', 20060801, 'created: Jan 24, 2012 11:26:05 am', 'Ruel please give me the client business form for this on site');
INSERT INTO `ems_remarks` VALUES (48, 'ovt-0081', 20111101, 'created: Jan 25, 2012 10:04:11 am', 'OT  tendered last Jan 21 and not Jan 17.  Time is correct. Liza');
INSERT INTO `ems_remarks` VALUES (49, 'ofb-0129', 20060801, 'created: Jan 25, 2012 10:22:26 am', 'Please enumerate per day and give me the list of activities per day');
INSERT INTO `ems_remarks` VALUES (50, 'ofb-0141', 20090802, 'created: Feb 02, 2012 11:10:17 am', 'CLP Demo did not pursue since some of the attendees in Primer''s side is not available.');
INSERT INTO `ems_remarks` VALUES (51, 'ovt-0091', 20090702, 'created: Feb 16, 2012 09:08:17 am', '[CB] For Offset?');
INSERT INTO `ems_remarks` VALUES (52, 'lve-0164', 20080701, 'created: Feb 17, 2012 05:48:42 am', 'Hi Miss Jane, half day leave lang po ito.');
INSERT INTO `ems_remarks` VALUES (53, 'ofb-0185', 20070705, 'created: Mar 07, 2012 07:15:55 pm', 'Nesabel Pateros');
INSERT INTO `ems_remarks` VALUES (54, 'ofb-0232', 20080604, 'created: Mar 26, 2012 04:25:05 pm', 'Please check the departure time.  i think we left around past 2pm already and not 1:35pm as indicated.');
INSERT INTO `ems_remarks` VALUES (55, 'air-0012', 20070705, 'created: Apr 03, 2012 04:45:28 pm', 'with TS');
INSERT INTO `ems_remarks` VALUES (56, 'lve-0208', 20070701, 'created: Apr 03, 2012 11:03:05 pm', 'team please do not use SL if its a vacation leave');
INSERT INTO `ems_remarks` VALUES (57, 'ovt-0121', 20111101, 'created: Apr 04, 2012 10:59:51 am', 'Late filing due to unscheduled OT as required by Ice Legaspi');
INSERT INTO `ems_remarks` VALUES (58, 'ovt-0123', 20060801, 'created: Apr 11, 2012 09:05:02 am', 'Please provide OB form signed by client');
INSERT INTO `ems_remarks` VALUES (59, 'ofb-0256', 20100603, 'created: Apr 16, 2012 06:01:48 pm', 'DONE BPA in cardams megamall');
INSERT INTO `ems_remarks` VALUES (60, 'ovt-0131', 20090802, 'created: Apr 23, 2012 09:33:11 am', 'Incorrect OT date. It should be 04/19/2012');
INSERT INTO `ems_remarks` VALUES (61, 'ovt-0132', 20080604, 'created: Apr 24, 2012 11:02:39 am', 'These are all for hardware quotes');
INSERT INTO `ems_remarks` VALUES (62, 'lve-0228', 20111101, 'created: Apr 30, 2012 01:46:41 pm', 'VL schedule was changed to April 26, 2012');
INSERT INTO `ems_remarks` VALUES (63, 'air-0013', 20070705, 'created: May 02, 2012 10:00:11 am', 'change to May 11 arrival Manila 3PM or 4PM');
INSERT INTO `ems_remarks` VALUES (64, 'lve-0244', 20080701, 'created: May 09, 2012 05:30:08 pm', 'half day leave only :)');
INSERT INTO `ems_remarks` VALUES (65, 'ofb-0315', 20070705, 'created: May 15, 2012 10:48:02 am', 'with TS');
INSERT INTO `ems_remarks` VALUES (66, 'ofb-0328', 20100401, 'created: May 21, 2012 03:45:52 pm', 'May 18, 11:15pm to May 21, 7:30am');
INSERT INTO `ems_remarks` VALUES (67, 'air-0021', 20070701, 'created: May 23, 2012 10:47:40 pm', 'Please book flight at 11 am...thanks..');
INSERT INTO `ems_remarks` VALUES (68, 'air-0022', 20070701, 'created: May 28, 2012 08:56:52 am', 'Ms. Barbz please  tyr 3 or 4 pm flight');
INSERT INTO `ems_remarks` VALUES (69, 'ER2012022', 20081101, 'created: Jun 19, 2012 02:55:58 pm', 'Laser mouse with scroll button.');
INSERT INTO `ems_remarks` VALUES (70, 'air-0027', 20070804, 'created: Jul 04, 2012 01:12:39 pm', 'Ms.Barbs, Pls change MNL-KL to July 9 8:55 PM');
INSERT INTO `ems_remarks` VALUES (71, 'ovt-0166', 20120302, 'created: Jul 10, 2012 02:07:06 pm', 'Hi Mam, have you check my OT?? is this approved already?? di po kase ngreflect sa summary. Please check po. Thank you.');
INSERT INTO `ems_remarks` VALUES (72, 'air-0031', 20070701, 'created: Jul 11, 2012 02:17:03 pm', 'Ms. babz time will be same as rajiv''s flight from cebu to iloilo');
INSERT INTO `ems_remarks` VALUES (73, 'air-0032', 20070701, 'created: Jul 11, 2012 02:18:28 pm', 'This is for Rajiv. Same Flight as mine please');
INSERT INTO `ems_remarks` VALUES (74, 'lve-0333', 20080801, 'created: Jul 13, 2012 02:56:02 pm', 'Iloilo Trip is extended for 1 day. Will be back in Manila by July 28, 2012 instead.');
INSERT INTO `ems_remarks` VALUES (75, 'ofb-0423', 20070705, 'created: Jul 17, 2012 02:16:48 pm', 'change date to July 9');
INSERT INTO `ems_remarks` VALUES (76, 'air-0033', 20070804, 'created: Jul 19, 2012 10:38:01 am', 'CORRECTION: Return Flight July 27, Friday 1:35am Departure (BKK-MNL)');
INSERT INTO `ems_remarks` VALUES (77, 'ovt-0192', 20080604, 'created: Aug 16, 2012 03:58:25 pm', 'The number of hours worked should be from 6:30pm - 9:00pm only... equivalent to 2 hours only');
INSERT INTO `ems_remarks` VALUES (78, 'ovt-0192', 20120302, 'created: Aug 16, 2012 04:39:48 pm', 'Hi Mam,sorry my mistake. i got confused. I counted 6:30 as one 1hour.');
INSERT INTO `ems_remarks` VALUES (79, 'ofb-0453', 20070701, 'created: Aug 17, 2012 11:26:16 am', 'Until August 8 only');
INSERT INTO `ems_remarks` VALUES (80, 'off-0110', 20070701, 'created: Aug 29, 2012 11:50:34 pm', 'trin..what is this...your OT date is August 29 and you are applying an offset for August 28?');
INSERT INTO `ems_remarks` VALUES (81, 'off-0110', 20100301, 'created: Aug 30, 2012 05:42:21 pm', 'ay..sorry... OT date is August 11 instead of August 29..');
INSERT INTO `ems_remarks` VALUES (82, 'off-0113', 20070701, 'created: Sep 06, 2012 03:45:50 pm', 'cancelled leave since i have meeting the whole day and i reported to office');
INSERT INTO `ems_remarks` VALUES (83, 'ovt-0204', 20090802, 'created: Sep 11, 2012 09:26:51 am', 'Was able to set up F&B in HP touchscreen at around 1:30am. Sir Ben took over around that time then I already left at around 2am.');
INSERT INTO `ems_remarks` VALUES (84, 'ovt-0205', 20090802, 'created: Sep 11, 2012 09:27:36 am', 'Was able to do a part of the formal receipt, especially the template. Left the office at 12:30am.');
INSERT INTO `ems_remarks` VALUES (85, 'ovt-0214', 20090802, 'created: Sep 25, 2012 09:44:57 am', 'Started working in 25th at 8:30am and left at around 4:45pm.<br />\r\nI was able to start revising sir Oxy''s program in C#.NET.');
INSERT INTO `ems_remarks` VALUES (86, 'ovt-0223', 20120302, 'created: Oct 05, 2012 05:39:52 pm', 'Hi Mam, I just want to ask. We came early to the office last Event. I checked already my time in, it was 4:30am. Is this countable OT? or not? Thanks po for a sooner response.');
INSERT INTO `ems_remarks` VALUES (87, 'ovt-0224', 20080701, 'created: Oct 08, 2012 09:57:31 am', 'done deal for all BIR Applications for GABC,collate primer orders and preparation of demo to radc');
INSERT INTO `ems_remarks` VALUES (88, 'air-0038', 20080101, 'created: Oct 11, 2012 11:00:55 am', 'Baggage Allowance 30 Kilos');
INSERT INTO `ems_remarks` VALUES (89, 'ovt-0236', 20120302, 'created: Oct 16, 2012 11:25:57 am', 'Hi Mam, we arrived last Sunday to the Ripple office at 10:22pm, our time out was already 11:00 pm. For your info. Thank you.');
INSERT INTO `ems_remarks` VALUES (90, 'ovt-0235', 20120302, 'created: Oct 16, 2012 01:28:36 pm', 'Hi Mam, we arrived at the WTC at 9:00 am and the event was ended at 7:00 pm');
INSERT INTO `ems_remarks` VALUES (91, 'ovt-0237', 20080701, 'created: Oct 18, 2012 07:46:57 pm', 'done deal for BIR POS Applications, bir sticker preparation and printing');
INSERT INTO `ems_remarks` VALUES (92, 'ovt-0231', 20080701, 'created: Oct 18, 2012 07:47:22 pm', 'BIR Applications, P.O. preparation, sending of bir processed applications to clients');
INSERT INTO `ems_remarks` VALUES (93, 'ovt-0241', 20090802, 'created: Oct 26, 2012 04:04:39 pm', 'Finished testing/revision of new Full Tax Invoice (Formal Receipt) Printing. 4PM. Also sent a revision update for Simplicity''s POS for Coupon promo (selected items).');
INSERT INTO `ems_remarks` VALUES (94, 'lve-0449', 20100301, 'created: Oct 27, 2012 09:58:46 pm', 'ticket has been booked :))');
INSERT INTO `ems_remarks` VALUES (95, 'ofb-0633', 20100603, 'created: Nov 12, 2012 10:58:46 am', 'Set-Up and Monitoring.');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_settings`
-- 

CREATE TABLE `ems_settings` (
  `settingId` int(11) NOT NULL auto_increment,
  `settingName` varchar(50) NOT NULL,
  `value` varchar(50) NOT NULL,
  `createDate` datetime NOT NULL,
  `createBy` varchar(50) NOT NULL,
  `updateDate` datetime NOT NULL,
  `updateBy` varchar(50) NOT NULL,
  PRIMARY KEY  (`settingId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `ems_settings`
-- 

INSERT INTO `ems_settings` VALUES (1, 'leaveCutOffStart', '2012-04-01', '2012-04-03 09:24:20', 'admin', '2012-04-03 09:31:18', 'admin');
INSERT INTO `ems_settings` VALUES (2, 'leaveCutOffEnd', '2013-03-31', '2012-04-03 09:24:20', 'admin', '2012-04-03 09:31:18', 'admin');

-- --------------------------------------------------------

-- 
-- Table structure for table `ems_undertime`
-- 

CREATE TABLE `ems_undertime` (
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `ems_undertime`
-- 

INSERT INTO `ems_undertime` VALUES ('und-0001', 20070801, '2011-11-16', '2011-11-16', 'Anticipated', '5:30 pm', 'Early schedule of flight for Davao (VL)', '', 'Denied');
INSERT INTO `ems_undertime` VALUES ('und-0002', 20070801, '2011-11-16', '2011-11-16', 'Anticipated', '5:30 pm', 'Early schedule of flight for Davao (VL)', '', 'Approved');
INSERT INTO `ems_undertime` VALUES ('und-0003', 20090702, '2011-11-24', '2011-11-24', 'Emergency', '5:00 pm', 'Accompany my brother in law in the airport', '', 'Approved');
INSERT INTO `ems_undertime` VALUES ('und-0004', 20091002, '2011-11-28', '2011-11-28', 'Anticipated', '5:30 pm', 'Personal matter', '', 'Approved');
INSERT INTO `ems_undertime` VALUES ('und-0005', 20080701, '2011-12-02', '2011-12-20', 'Anticipated', '4:30 pm', 'will attend church christmas concert ', '', 'Cancelled');
INSERT INTO `ems_undertime` VALUES ('und-0006', 20060901, '2011-12-11', '2011-12-14', 'Anticipated', '4:30 pm', 'family event', '', 'Cancelled');
INSERT INTO `ems_undertime` VALUES ('und-0007', 20091002, '2011-12-22', '2011-12-22', 'Anticipated', '5:30 pm', 'Personal matter', '', 'Approved');
INSERT INTO `ems_undertime` VALUES ('und-0008', 20091002, '2011-12-22', '2011-12-23', 'Anticipated', '4:30 pm', 'Doctor''s appointment at 7pm in MyHealth Alabang', '', 'Approved');
INSERT INTO `ems_undertime` VALUES ('und-0009', 20090501, '2011-12-23', '2011-12-23', 'Anticipated', '4:00 pm', 'Personal', '', 'Approved');
INSERT INTO `ems_undertime` VALUES ('und-0010', 20080603, '2011-12-23', '2011-12-23', 'Anticipated', '4:00 pm', 'need to attend chiroling of our youth organization', '', 'Denied');
INSERT INTO `ems_undertime` VALUES ('und-0011', 20071002, '2011-12-27', '2011-12-27', 'Emergency', '4:30 pm', 'Need to go to Bulacan to prepare for the Dec 28''s wedding of a friend.', '', 'Approved');
INSERT INTO `ems_undertime` VALUES ('und-0012', 20110301, '2012-01-17', '2012-01-17', 'Emergency', '4:30 pm', 'I''m not feeling well today due to my cough.I need to visit a doctor for medical prescription.', '', 'Cancelled');
INSERT INTO `ems_undertime` VALUES ('und-0013', 20090702, '2012-01-24', '2012-01-24', 'Emergency', '5:15 pm', 'family emergency', '', 'Approved');
INSERT INTO `ems_undertime` VALUES ('und-0014', 20110402, '2012-01-30', '2012-01-30', 'Emergency', '5:00 pm', 'I will have to meet with my college friend, urgently', '', 'Approved');
INSERT INTO `ems_undertime` VALUES ('und-0015', 20100401, '2012-02-03', '2012-01-25', 'Emergency', '5:00 pm', 'lola''s wake.', '', 'Approved');
INSERT INTO `ems_undertime` VALUES ('und-0016', 20090802, '2012-02-13', '2012-02-16', 'Anticipated', '4:55 pm', 'Set an appointment with dermatologist.', '', 'Approved');
INSERT INTO `ems_undertime` VALUES ('und-0017', 20100201, '2012-03-13', '2012-03-13', 'Anticipated', '5:30 pm', 'Personal', '', 'Approved');
INSERT INTO `ems_undertime` VALUES ('und-0018', 20100401, '2012-04-30', '2012-04-30', 'Emergency', '5:30 pm', 'family problem', '', 'Cancelled');
INSERT INTO `ems_undertime` VALUES ('und-0019', 20090802, '2012-05-15', '2012-05-17', 'Anticipated', '5:00 pm', 'Need to help mom to fetch purified water.', '', 'Approved');
INSERT INTO `ems_undertime` VALUES ('und-0020', 20070804, '2012-05-21', '2012-05-21', 'Emergency', '4:00 pm', 'Rest', '', 'Approved');
INSERT INTO `ems_undertime` VALUES ('und-0021', 20091203, '2012-05-31', '2012-06-01', 'Anticipated', '3:30 pm', 'We have a suprise birthday celebration for my mother. ', '', 'Approved');
INSERT INTO `ems_undertime` VALUES ('und-0022', 20110402, '2012-07-09', '2012-07-09', 'Anticipated', '4:00 pm', 'Appointed check up at Health Way', '', 'Approved');
INSERT INTO `ems_undertime` VALUES ('und-0023', 20110301, '2012-07-16', '2012-07-16', 'Emergency', '4:30 pm', 'Important matter to settle', '', 'Approved');
INSERT INTO `ems_undertime` VALUES ('und-0024', 20110402, '2012-07-16', '2012-07-16', 'Anticipated', '4:00 pm', 'Appointed ingrown surgery in healt way', '', 'Approved');
INSERT INTO `ems_undertime` VALUES ('und-0025', 20110301, '2012-07-23', '2012-07-23', 'Anticipated', '5:00 pm', 'I have important matter to settle', '', 'Cancelled');
INSERT INTO `ems_undertime` VALUES ('und-0026', 20090802, '2012-08-14', '2012-08-14', 'Anticipated', '5:15 pm', 'Family matters.', '', 'Approved');
INSERT INTO `ems_undertime` VALUES ('und-0027', 20110201, '2012-10-29', '2012-10-29', 'Anticipated', '3:30 pm', 'attend to personal matter', '', 'Approved');
INSERT INTO `ems_undertime` VALUES ('und-0028', 20100601, '2012-10-31', '2012-10-30', 'Anticipated', '3:35 pm', 'Going to the dentist ', '', 'Approved');
INSERT INTO `ems_undertime` VALUES ('und-0029', 5012012, '2012-11-08', '2012-11-08', 'Emergency', '4:00 pm', 'I have to fetch my wife in her office since she is suffering to a sprained ankle and unable to walk properly', '', 'Denied');
INSERT INTO `ems_undertime` VALUES ('und-0030', 20110402, '2013-01-07', '2013-01-18', 'Anticipated', '3:55 pm', 'test', '', 'Approved');
INSERT INTO `ems_undertime` VALUES ('und-0031', 20110402, '2013-01-11', '2013-01-19', 'Emergency', '3:45 pm', 'test', '', 'Denied');
INSERT INTO `ems_undertime` VALUES ('und-0032', 20110402, '2013-01-11', '2013-01-17', 'Anticipated', '4:00 pm', 'test', '', 'Cancelled');
INSERT INTO `ems_undertime` VALUES ('und-0033', 20110402, '2013-01-11', '2013-01-17', 'Anticipated', '4:30 pm', 'test', '', 'Pending');
INSERT INTO `ems_undertime` VALUES ('und-0034', 20110402, '2013-01-11', '2013-01-18', 'Emergency', '3:30 pm', 'test', '', 'Pending');

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
  `is_admin` smallint(1) NOT NULL,
  PRIMARY KEY  (`user_id`),
  KEY `emp_num` (`emp_num`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=67 ;

-- 
-- Dumping data for table `ems_users`
-- 

INSERT INTO `ems_users` VALUES (1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '', 1, 1, 'Enabled', 1);
INSERT INTO `ems_users` VALUES (16, 'cenrique', '202cb962ac59075b964b07152d234b70', '', 20060801, 2, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (17, 'ksuarez', '0e61f67dcd4a437b06e60a9c49fd8885', '', 20100401, 3, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (18, 'svelasquez', '2fca3c4b5cda1fb21f2d1f9401f2b115', '', 20100601, 3, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (19, 'rdelica', 'a2e0f9e135a912724390235d54e6592d', '', 20100602, 3, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (20, 'pjulio', '9c38a3647f419b45bd8f96c8a9ed5fb4', '', 20080603, 3, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (22, 'rbuenafe', '30b63e7d1f4f1ae6560cf76a178450b9', '', 20100603, 3, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (23, 'tsadaya', '683552115bcef3547e0d5c1d4ad35e55', '', 20100301, 3, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (24, 'aarceo', '202cb962ac59075b964b07152d234b70', '', 20110402, 3, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (26, 'jkeng', '202cb962ac59075b964b07152d234b70', '', 20091204, 5, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (27, 'vjavier', '90ca64a3cdcd68a09c30cc200ca81591', '', 20000101, 2, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (29, 'elegaspi', '9f1538a2f5d2614f4cb7dba3c41ed3ea', '', 20080801, 3, 'Enabled', 1);
INSERT INTO `ems_users` VALUES (31, 'valluso', '25d961aa7283c618c54413d5399c1613', '', 20071002, 2, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (32, 'munson', '202cb962ac59075b964b07152d234b70', '', 20080604, 2, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (33, 'bviloria', '202cb962ac59075b964b07152d234b70', '', 20081101, 2, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (34, 'hdy', '829bdbcd0578df4aca89017b79ccf3f6', '', 20000102, 5, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (35, 'jhabacon', '856da4d035f6534fbc1807232f634b74', '', 20060901, 3, 'Disabled', 0);
INSERT INTO `ems_users` VALUES (36, 'fnagnal', '202cb962ac59075b964b07152d234b70', '', 20070701, 2, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (37, 'ilanante', 'ec0c02c2884ec60d59cb38ec711e34f4', '', 20070705, 3, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (38, 'achie', 'ea3412ec22d52d91f5a95556a1038dc9', '', 20070801, 2, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (39, 'ccataluna', 'b663e4ddd76f937e4662118e8ce3bd6f', '', 20070804, 3, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (40, 'jcruz', 'eb3aa07bd5f1b436a0050ed628f42225', '', 20080101, 3, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (41, 'mandalis', '56e914ae2bc579308d88bffc418e7bbc', '', 20080701, 3, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (42, 'njaraba', 'fc85c05d3e89fc0bd85a17024f54b851', '', 20090501, 3, 'Disabled', 0);
INSERT INTO `ems_users` VALUES (43, 'zbriones', '1233c0f69d681756c2b07a257324ed27', '', 20090702, 3, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (44, 'tlaude', '1ccd8e4ff7c290e025b00c3ea67b8d5b', '', 20090802, 3, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (45, 'mhaban', '9067ff6535417a0ebd40fd21f0e77327', '', 20091002, 3, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (46, 'jsee', 'ee606c696198c4232ddbf17cc5b41d5b', '', 20091201, 2, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (47, 'jgerosanib', '5f69fddae310fd08028e2f65e133e921', '', 20100201, 3, 'Disabled', 0);
INSERT INTO `ems_users` VALUES (48, 'jpancho', '5c1e8c578edc259720cd2653d306551b', '', 20110301, 3, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (49, 'abusio', 'ee3e9f6f000bb378d92eff2faea88ae4', '', 20111001, 3, 'Disabled', 0);
INSERT INTO `ems_users` VALUES (50, 'cmateo', '202cb962ac59075b964b07152d234b70', '', 20100303, 3, 'Disabled', 0);
INSERT INTO `ems_users` VALUES (51, 'lestrelles', '2ecf5947e9edab0ccb8ce309bf54bb3d', '', 20100903, 3, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (52, 'mocampo', '7c2fb72f9bf2d12ae192e2fc69550c45', '', 20091203, 3, 'Enabled', 1);
INSERT INTO `ems_users` VALUES (53, 'bbalingit', '202cb962ac59075b964b07152d234b70', '', 20110201, 4, 'Enabled', 1);
INSERT INTO `ems_users` VALUES (54, 'fclarete', 'ef949dff1dcc385fd6d9fa473c5b5072', '', 20111101, 2, 'Enabled', 1);
INSERT INTO `ems_users` VALUES (55, 'adelacruz', '1b40e521254a9c4f6f21f23a9f8e87a5', '', 20110501, 3, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (56, 'abonita', '2dd23b524dc50acc8e3a417ac5a7e762', '', 20111201, 3, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (57, 'mpastera', 'efeb8d20b9754ae1d8e8885168eda9e0', '', 20120301, 3, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (58, 'alepalem', 'deb3cbd68231d4518396e199fd241f27', '', 20120302, 3, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (59, 'rgabriel', '4dc11c637f5af3f5d5d271f95fc94726', '', 5012012, 3, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (61, 'ogonzales', '19e442f94db6c8d21d917dd286fb431a', '', 20120601, 3, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (62, 'clozada', '07bf168f5ad2e4f612d517016080a169', '', 20120701, 3, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (63, 'amacaraig', '5c3bd68b9dafa043ad121a53bf67c02c', '', 20120602, 3, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (64, 'asantos', 'd1ba9ad37eed3105d464db85ca699363', '', 20120901, 3, 'Enabled', 0);
INSERT INTO `ems_users` VALUES (65, 'lrialubin', 'd48dfcd33c0332cfbdce3f0878ba6e98', '', 20120801, 2, 'Enabled', 0);
