-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 27, 2013 at 08:15 PM
-- Server version: 5.5.20
-- PHP Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `FDCorgn_peandb`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrators`
--

CREATE TABLE IF NOT EXISTS `administrators` (
  `admin_id` int(3) NOT NULL AUTO_INCREMENT,
  `admin_code` char(15) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `date_registered` varchar(25) NOT NULL,
  `admin_type` int(1) NOT NULL,
  `admin_status` int(1) NOT NULL,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `admin_code` (`admin_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `administrators`
--

INSERT INTO `administrators` (`admin_id`, `admin_code`, `full_name`, `username`, `password`, `email`, `date_registered`, `admin_type`, `admin_status`) VALUES
(1, 'APL098IOPLKSGTH', 'Site Admin', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'tegaphilip@yahoo.co.uk', '', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `affiliations`
--

CREATE TABLE IF NOT EXISTS `affiliations` (
  `affiliation_id` int(4) NOT NULL AUTO_INCREMENT,
  `affiliation_code` char(15) NOT NULL,
  `affiliation_name` varchar(200) DEFAULT NULL,
  `contact_address` text,
  `url` varchar(200) DEFAULT NULL,
  `state_id` int(2) DEFAULT NULL,
  `date_added` varchar(20) DEFAULT NULL,
  `date_updated` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`affiliation_id`),
  UNIQUE KEY `affilition_code` (`affiliation_code`),
  UNIQUE KEY `affiliation_name` (`affiliation_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `affiliations`
--

INSERT INTO `affiliations` (`affiliation_id`, `affiliation_code`, `affiliation_name`, `contact_address`, `url`, `state_id`, `date_added`, `date_updated`) VALUES
(1, 'QWO8SU7HJA54060', 'University of Ibadan', NULL, NULL, NULL, NULL, NULL),
(3, 'F3WGUZC6I519024', 'University of Benin', NULL, NULL, NULL, NULL, NULL),
(4, 'BO6GX02RJ534946', 'Abia State University', NULL, NULL, NULL, NULL, NULL),
(5, '8134GBIEZH90308', 'Abubakar Tafawa Balewa University', NULL, NULL, NULL, NULL, NULL),
(6, 'TJZY4C3GWN76585', 'Ahmadu Bello University', NULL, NULL, NULL, NULL, NULL),
(7, '93R6L7A0UO80969', 'Ambrose Alli University', NULL, NULL, NULL, NULL, NULL),
(8, '648FJVGXA955645', 'Bayero University', NULL, NULL, NULL, NULL, NULL),
(9, 'J3OGUAFSRW87803', 'Benue State University', NULL, NULL, NULL, NULL, NULL),
(10, '7VM0LJEC6939627', 'Delta State University', NULL, NULL, NULL, NULL, NULL),
(11, 'EY9X5BN6W388308', 'Ebonyi State University', NULL, NULL, NULL, NULL, NULL),
(12, 'XCHFANE2PK96032', 'Ekiti State University', NULL, NULL, NULL, NULL, NULL),
(13, 'BOFAE6MHY459985', 'Enugu State University of Science and Technology', NULL, NULL, NULL, NULL, NULL),
(14, 'WRNHZ4KB9I22356', 'Federal University of Technology, Akure', NULL, NULL, NULL, NULL, NULL),
(15, 'ZG2JBQ957R70334', 'Federal University of Technology, Minna', NULL, NULL, NULL, NULL, NULL),
(16, '9I6XKC5VMH66104', 'Federal University of Technology, Owerri', NULL, NULL, NULL, NULL, NULL),
(17, 'V0EK1YS4NI96856', 'Federal University of Technology, Yola', NULL, NULL, NULL, NULL, NULL),
(18, 'FY1S3OR2TE24773', 'Imo State University', NULL, NULL, NULL, NULL, NULL),
(19, 'UQMFX6O7DJ27047', 'Kano University of Technology, Wudil', NULL, NULL, NULL, NULL, NULL),
(20, 'KL0F2Y1JNG55865', 'Ladoke Akintola University of Technology', NULL, NULL, NULL, NULL, NULL),
(21, 'M014XCSJRZ18411', 'Lagos State University', NULL, NULL, NULL, NULL, NULL),
(22, 'L7MPY80AZ246878', 'Michael Okpara University of Agriculture, Umudike', NULL, NULL, NULL, NULL, NULL),
(23, 'OP2Q7NFH1A48449', 'Nigerian Defence Academy', NULL, NULL, NULL, NULL, NULL),
(24, 'DUVS0AXY1665313', 'Nnamdi Azikiwe University', NULL, NULL, NULL, NULL, NULL),
(25, '8ZHM5GUI3Y94658', 'Obafemi Awolowo University', NULL, NULL, NULL, NULL, NULL),
(26, 'KLY069ZA3T88671', 'Olabisi Onabanjo University', NULL, NULL, NULL, NULL, NULL),
(27, '1YISUB2FD044538', 'Rivers State University of Science and Technology', NULL, NULL, NULL, NULL, NULL),
(28, 'KSUI2DTHZF94450', 'University of Abuja', NULL, NULL, NULL, NULL, NULL),
(29, 'Z8C6BEX10F55590', 'University of Agriculture, Abeokuta', NULL, NULL, NULL, NULL, NULL),
(30, 'CIK7USNGRD60149', 'University of Agriculture, Makurdi', NULL, NULL, NULL, NULL, NULL),
(32, 'ECZO6TA7RS49091', 'University of Calabar', NULL, NULL, NULL, NULL, NULL),
(33, 'GKWHS68JA210847', 'University of Ilorin', NULL, NULL, NULL, NULL, NULL),
(34, 'MOEN9UGQ3A37116', 'University of Jos', NULL, NULL, NULL, NULL, NULL),
(35, '129ZTFPCDS12583', 'University of Lagos', NULL, NULL, NULL, NULL, NULL),
(36, 'H5GCINLMFU46938', 'University of Maiduguri', NULL, NULL, NULL, NULL, NULL),
(37, 'VPEFC2MBU024866', 'University of Nigeria', NULL, NULL, NULL, NULL, NULL),
(38, '5S9WZRT4EB56057', 'University of Port Harcourt', NULL, NULL, NULL, NULL, NULL),
(39, '7J2MGB50XQ25196', 'University of Uyo', NULL, NULL, NULL, NULL, NULL),
(40, '4VWYJ1LIM541972', 'Usmanu Danfodiyo University', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `conferences`
--

CREATE TABLE IF NOT EXISTS `conferences` (
  `conference_id` int(4) NOT NULL AUTO_INCREMENT,
  `conference_code` char(15) DEFAULT NULL,
  `conference_title` varchar(200) DEFAULT NULL,
  `start_date` varchar(20) DEFAULT NULL COMMENT 'day, month and year',
  `end_date` varchar(20) DEFAULT NULL COMMENT 'day, month and year',
  `time` varchar(20) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `conference_chairman` varchar(100) NOT NULL,
  `chairman_position` varchar(100) NOT NULL,
  `venue` text,
  `amount_charged` decimal(10,0) DEFAULT NULL,
  `date_added` varchar(20) DEFAULT NULL,
  `date_updated` varchar(20) DEFAULT NULL,
  `added_by` int(3) NOT NULL,
  `current` int(1) NOT NULL,
  PRIMARY KEY (`conference_id`),
  UNIQUE KEY `conference_code` (`conference_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `conferences`
--

INSERT INTO `conferences` (`conference_id`, `conference_code`, `conference_title`, `start_date`, `end_date`, `time`, `logo`, `conference_chairman`, `chairman_position`, `venue`, `amount_charged`, `date_added`, `date_updated`, `added_by`, `current`) VALUES
(1, 'WIMPGZK0EO34952', 'Philosophy of Education for Social Ethics', '1382313600', '1382659200', '10 am', '24913agkwqdroetdef_logo.JPG', 'x', 'x', 'University of Ibadan International Conference Centre, Ibadan, Oyo State', '15000', '1366247075', '1366917180', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `conference_attendance`
--

CREATE TABLE IF NOT EXISTS `conference_attendance` (
  `attendee_id` int(4) NOT NULL AUTO_INCREMENT,
  `conference_id` int(4) DEFAULT NULL,
  `full_name` varchar(200) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telephone` varchar(20) NOT NULL,
  `is_member` int(1) DEFAULT NULL,
  `affiliation_id` int(3) NOT NULL,
  `conference_registration_type_id` int(3) NOT NULL,
  `amount_paid` decimal(10,0) DEFAULT NULL,
  `payment_confirmed` int(1) NOT NULL,
  `date_registered` varchar(200) DEFAULT NULL,
  `date_payment_was_confirmed` varchar(200) DEFAULT NULL,
  `date_payment_was_made` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`attendee_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `conference_attendance`
--

INSERT INTO `conference_attendance` (`attendee_id`, `conference_id`, `full_name`, `email`, `telephone`, `is_member`, `affiliation_id`, `conference_registration_type_id`, `amount_paid`, `payment_confirmed`, `date_registered`, `date_payment_was_confirmed`, `date_payment_was_made`) VALUES
(1, 1, 'Dr. Tega Oghenekhwo', 'tega.philip@gmail.com', '08026624347', 0, 21, 2, '7000', 1, '1367028787', '', '1355270400');

-- --------------------------------------------------------

--
-- Table structure for table `conference_details`
--

CREATE TABLE IF NOT EXISTS `conference_details` (
  `conference_detail_id` int(5) NOT NULL AUTO_INCREMENT,
  `conference_id` int(4) DEFAULT NULL,
  `day_title` varchar(200) DEFAULT NULL,
  `start_time` varchar(200) DEFAULT NULL,
  `end_time` varchar(200) DEFAULT NULL COMMENT 'timestamp',
  PRIMARY KEY (`conference_detail_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `conference_details`
--

INSERT INTO `conference_details` (`conference_detail_id`, `conference_id`, `day_title`, `start_time`, `end_time`) VALUES
(1, 1, 'Arrival', '1382349600', '1382392800'),
(2, 1, 'Pre-conference Workshop', '1382356800', '1382371200'),
(3, 1, 'Opening Ceremony and Paper presentations', '1382436000', '1382464800'),
(4, 1, 'Paper presentations', '1382522400', '1382551200'),
(5, 1, 'Visits', '1382598000', '1382619600'),
(6, 1, 'Dinner & Awards', '1382590800', '1382641200'),
(7, 1, 'AGM', '1382641200', '1382644800'),
(9, 1, 'Departure', '1382695200', '1382745300');

-- --------------------------------------------------------

--
-- Table structure for table `conference_docs`
--

CREATE TABLE IF NOT EXISTS `conference_docs` (
  `conference_doc_id` int(6) NOT NULL AUTO_INCREMENT,
  `attendee_id` int(4) DEFAULT NULL,
  `doc_title` varchar(200) DEFAULT NULL,
  `doc_type_id` int(4) DEFAULT NULL COMMENT 'abstracts, full paper, etc',
  `date_uploaded` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`conference_doc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `conference_registration_types`
--

CREATE TABLE IF NOT EXISTS `conference_registration_types` (
  `conference_registration_type_id` int(3) NOT NULL AUTO_INCREMENT,
  `conference_registration_type_code` char(15) NOT NULL,
  `conference_registration_type_name` varchar(200) NOT NULL,
  PRIMARY KEY (`conference_registration_type_id`),
  UNIQUE KEY `conference_registration_type_code` (`conference_registration_type_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `conference_registration_types`
--

INSERT INTO `conference_registration_types` (`conference_registration_type_id`, `conference_registration_type_code`, `conference_registration_type_name`) VALUES
(1, 'POLI4567ASQ768P', 'Default'),
(2, '54TREASD3467UYI', 'Student'),
(3, 'LOKSAWQYUIT5674', 'Institution');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `country_id` int(4) NOT NULL AUTO_INCREMENT,
  `country_code` char(15) NOT NULL,
  `country_name` varchar(100) NOT NULL,
  `country_flag_url` varchar(100) NOT NULL,
  PRIMARY KEY (`country_id`),
  UNIQUE KEY `country_code` (`country_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=247 ;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`country_id`, `country_code`, `country_name`, `country_flag_url`) VALUES
(2, 'BQFTHPLO9247699', 'South Africa', ''),
(3, '5XR6PC1MNH38855', 'Afghanistan', ''),
(4, '3XCZE58KN186789', 'land Islands', ''),
(5, 'VI59FN7QD442436', 'Albania', ''),
(6, 'JFCO4R96V571738', 'Algeria', ''),
(7, '31TMPZUVQK25627', 'American Samoa', ''),
(8, 'P452I3TDHK70046', 'Andorra', ''),
(9, 'AVM4TCNQJK55928', 'Angola', ''),
(10, 'UIJ3XOBNRH59213', 'Anguilla', ''),
(11, 'IJSVGMOC2X20837', 'Antarctica', ''),
(12, '2G69FKB1DI16739', 'Antigua and Barbuda', ''),
(13, 'F6J3XN8KIE77857', 'Argentina', ''),
(14, 'U4HG3XWCTE10125', 'Armenia', ''),
(15, 'H1V329WJQE24484', 'Aruba', ''),
(16, 'VG08P2X6MA16871', 'Australia', ''),
(17, '9O1MVJT6HZ18222', 'Austria', ''),
(18, 'DQFGH9NE8X14476', 'Azerbaijan', ''),
(19, 'YODQUE29P836570', 'Bahamas', ''),
(20, 'M27BKGPH5T70441', 'Bahrain', ''),
(21, 'MTFIDUR0O957027', 'Bangladesh', ''),
(22, 'FJCZ950NWQ72265', 'Barbados', ''),
(23, 'XD82G7J6TY57092', 'Belarus', ''),
(24, '9H4QZ1OJ5I87448', 'Belgium', ''),
(25, '3UVSFK64PG14267', 'Belize', ''),
(26, 'X6RUJ81QWZ93491', 'Benin', ''),
(27, 'WXBD6FLTVC86053', 'Bermuda', ''),
(28, 'ONLYVGM12567892', 'Bhutan', ''),
(29, '1HBYZA95UC69947', 'Bolivia', ''),
(30, 'MDVBFLQY5378154', 'Bosnia and Herzegovina', ''),
(31, 'TRLBA4I6PO33449', 'Botswana', ''),
(32, 'CYGWLA05KN11773', 'Bouvet Island', ''),
(33, 'DX16BHRLT444062', 'Brazil', ''),
(34, 'X61MROFJAE26253', 'British Indian Ocean Territory', ''),
(35, 'GEYKH6ZLUS79285', 'Brunei Darussalam', ''),
(36, '9Q63PJWFGN99094', 'Bulgaria', ''),
(37, 'GJ0HTVPB3O26616', 'Burkina Faso', ''),
(38, 'WLUHJ5TOQC27791', 'Burundi', ''),
(39, 'XLUH8SJOVY43557', 'Cambodia', ''),
(40, '3B9CN1ELQT59850', 'Cameroon', ''),
(41, 'VXQ1D6S4GM17607', 'Canada', ''),
(42, 'PTDQFHN0MR82768', 'Cape Verde', ''),
(43, '0GU4K9VLIJ16266', 'Cayman Islands', ''),
(44, 'DFLA3OCQN474045', 'Central African Republic', ''),
(45, 'AK8P2QSWMV17035', 'Chad', ''),
(46, 'OQTNKI7LEU11180', 'Chile', ''),
(47, 'G78ECHIYF487415', 'China', ''),
(48, 'DJIMTH680Y51676', 'Christmas Island', ''),
(49, 'CNM3WDQ7S924902', 'Cocos (Keeling) Islands', ''),
(50, 'G29V74MZUF83032', 'Colombia', ''),
(51, '87JW2IRBMY77000', 'Comoros', ''),
(52, '1BCIXZ523V82746', 'Congo', ''),
(53, 'QUKB4AENCM41206', 'Congo, The Democratic Republic of the', ''),
(54, '5DTGZSKFJ928319', 'Cook Islands', ''),
(55, 'M9ZATVSU1G75023', 'Costa Rica', ''),
(56, '9X46PKO8WB77253', 'Cote D''Ivoire (Ivory Coast)', ''),
(57, 'S3LONHGF2065948', 'Croatia', ''),
(58, 'BHDJC5SMKU27044', 'Cuba', ''),
(59, '50FZC1U6LE81483', 'Cyprus', ''),
(60, 'MEHLSQIRAV35196', 'Czech Republic', ''),
(61, 'I459TNFEHR99127', 'Denmark', ''),
(62, 'V0O7T4SPA679208', 'Djibouti', ''),
(63, 'A4TCYPJL5H96380', 'Dominica', ''),
(64, 'Y1HS6ZGJTL46578', 'Dominican Republic', ''),
(65, '56PVTWJG2X50742', 'Ecuador', ''),
(66, 'E0QJFXVRHP94809', 'Egypt', ''),
(67, 'JRUNKX6A0329714', 'El Salvador', ''),
(68, 'UV2FK4IPL021397', 'Equatorial Guinea', ''),
(69, 'UHKDZJRY7210795', 'Eritrea', ''),
(70, 'V0O8HKMXTB73847', 'Estonia', ''),
(71, 'W5ZJX78YPS61487', 'Ethiopia', ''),
(72, '0RDUV75CYL49655', 'Falkland Islands (Malvinas)', ''),
(73, '31MSLQXZVC69288', 'Faroe Islands', ''),
(74, 'ZKYBWVGM5Q16321', 'Fiji', ''),
(75, 'PKG0XLU2NR11696', 'Finland', ''),
(76, 'P4CAFDWR8941349', 'France', ''),
(77, 'YKE5624BF946216', 'French Guiana', ''),
(78, 'V9CPWNIQ7S12234', 'French Polynesia', ''),
(79, 'ODVETW6FPR60344', 'French Southern Territories', ''),
(80, 'U5J82NYF1386482', 'Gabon', ''),
(81, '08QB6Y9RMO31582', 'Gambia', ''),
(82, 'R83UCGK7XO61586', 'Georgia', ''),
(83, 'XAQC4JROMY27429', 'Germany', ''),
(84, 'D4GOEP5SC795051', 'Ghana', ''),
(85, 'GVUJFRTIOL25385', 'Gibraltar', ''),
(86, 'UMLZKJE31F74374', 'Greece', ''),
(87, 'OY1STIA4G892953', 'Greenland', ''),
(88, '64VS82NF5T67057', 'Grenada', ''),
(89, 'YARK9WOB4C27626', 'Guadeloupe', ''),
(90, '06W5ZXVPSN50599', 'Guam', ''),
(91, 'HQVAOS4ZJP76912', 'Guatemala', ''),
(92, 'BP7AS9EZ6I92502', 'Guernsey', ''),
(93, 'C387QNB9W138305', 'Guinea', ''),
(94, 'A0WYMRUJEI80263', 'Guinea-Bissau', ''),
(95, '4WFAJQSDRY69310', 'Guyana', ''),
(96, 'R3B8LHITG681384', 'Haiti', ''),
(97, '75P9UJCFS657422', 'Heard Island and Mcdonald Islands', ''),
(98, 'LKO7VXDYJ473364', 'Holy See (Vatican City State)', ''),
(99, 'PYAXI0DFTL70144', 'Honduras', ''),
(100, '50JP4XV8AK33702', 'Hong Kong', ''),
(101, '6DA89VEWLQ84976', 'Hungary', ''),
(102, 'LUGP8ERVS929901', 'Iceland', ''),
(103, '3WQOL4SKZB79417', 'India', ''),
(104, 'CP9WKFMZ5E39459', 'Indonesia', ''),
(105, 'SRJUQ13OH930966', 'Iran, Islamic Republic of', ''),
(106, 'F1BX8YMPUC39876', 'Iraq', ''),
(107, '4E6VHOXRK197128', 'Ireland', ''),
(108, 'JF26DBNMPQ98655', 'Isle of Man', ''),
(109, 'APMIL7B4H875396', 'Israel', ''),
(110, 'A60DEOGWT813289', 'Italy', ''),
(111, '3BXVM186UP33274', 'Jamaica', ''),
(112, '64TBV8U0FZ31285', 'Japan', ''),
(113, '1ECRYK6QID38261', 'Jersey', ''),
(114, 'S5XP7L0VH240140', 'Jordan', ''),
(115, 'G1UBW9I8ED67859', 'Kazakhstan', ''),
(116, 'YUSP3HR2EX17354', 'Kenya', ''),
(117, 'XIF1W6NUBG99567', 'Kiribati', ''),
(118, 'AUTRMSYO3N30428', 'Korea, Democratic People''s Republic of', ''),
(119, 'XA2Z6O837L20881', 'Korea, Republic of', ''),
(120, '9L2U4NYS1I56862', 'Kuwait', ''),
(121, 'N3KHXEYUQW79307', 'Kyrgyzstan', ''),
(122, 'NQIR0X3SCM74155', 'Lao People''s Democratic Republic', ''),
(123, '0PC2NYM7RK72342', 'Latvia', ''),
(124, '3XLNQP4BTY59806', 'Lebanon', ''),
(125, 'LXB1NRFCDT67486', 'Lesotho', ''),
(126, '03CVUPDRG281318', 'Liberia', ''),
(127, 'EL3G94JXKU42239', 'Libyan Arab Jamahiriya', ''),
(128, 'ODZJ2STM4N26187', 'Liechtenstein', ''),
(129, 'ZADKS4W65E64102', 'Lithuania', ''),
(130, 'AK4QG96BY551918', 'Luxembourg', ''),
(131, 'SQLOWNJ65V20573', 'Macao', ''),
(132, '1L3MIHDXG846007', 'Macedonia, The Former Yugoslav Republic of', ''),
(133, 'ZVY3BXF5MH69156', 'Madagascar', ''),
(134, 'ATNK6093RM75956', 'Malawi', ''),
(135, '7ZLI4FW80997347', 'Malaysia', ''),
(136, '3B5EOFWNVQ29263', 'Maldives', ''),
(137, 'K8IUSDL69E82647', 'Mali', ''),
(138, 'O8EXAM5G3V63432', 'Malta', ''),
(139, 'TEP0GM2WO192557', 'Marshall Islands', ''),
(140, 'RE0B5ASXD765959', 'Martinique', ''),
(141, 'HA9M4EZQBI14574', 'Mauritania', ''),
(142, 'X2GAZPB7NO14344', 'Mauritius', ''),
(143, '6DUHB5LQG796205', 'Mayotte', ''),
(144, 'I9XY4BDWHZ66090', 'Mexico', ''),
(145, 'H1537N2CQP44941', 'Micronesia, Federated States of', ''),
(146, 'D7W3TBZNIL18694', 'Moldova, Republic of', ''),
(147, '9JL2Q1IMFX18288', 'Monaco', ''),
(148, 'L1R4S9VJYZ29659', 'Mongolia', ''),
(149, 'KXV7UL802Q83746', 'Montenegro', ''),
(150, 'N2V7PZG1KO76484', 'Montserrat', ''),
(151, '8CRU0LZ16A38811', 'Morocco', ''),
(152, '5G8XSDHUTK46666', 'Mozambique', ''),
(153, '9CUWR60JY440986', 'Myanmar', ''),
(154, 'SM81H2XCRE97710', 'Namibia', ''),
(155, 'C7TR2MVYEK67771', 'Nauru', ''),
(156, '36WBEYRP0M27110', 'Nepal', ''),
(157, 'BHRF07JDC996666', 'Netherlands', ''),
(158, 'MUZ4WEDVXR82373', 'Netherlands Antilles', ''),
(159, 'YPID9FQABR15168', 'New Caledonia', ''),
(160, 'X7FJRB2E4T60993', 'New Zealand', ''),
(161, 'L90RX127KO70782', 'Nicaragua', ''),
(162, 'HPJ7MOTNLF30472', 'Niger', ''),
(163, 'OZ3XHQC0M761004', 'Nigeria', ''),
(164, 'NTUV4GEXQK58312', 'Niue', ''),
(165, 'RCP1K86XYA53335', 'Norfolk Island', ''),
(166, '9REBT0UOQW32010', 'Northern Mariana Islands', ''),
(167, 'CDEAB689Z225275', 'Norway', ''),
(168, 'YT320KEUNQ19068', 'Oman', ''),
(169, 'FNQ4DEP3O244326', 'Pakistan', ''),
(170, 'BHFK1CM7Y586987', 'Palau', ''),
(171, 'JROB6TWDG187987', 'Palestinian Territory, Occupied', ''),
(172, 'NE3CK41Q6R33263', 'Panama', ''),
(173, '5LIPTC84M643755', 'Papua New Guinea', ''),
(174, '19AP0FQNV415398', 'Paraguay', ''),
(175, 'JZ16V379XA69134', 'Peru', ''),
(176, 'GZB4DA51T810894', 'Philippines', ''),
(177, 'UA38N1PWMS51621', 'Pitcairn', ''),
(178, 'UALQZRT2JP87251', 'Poland', ''),
(179, 'G7JAWVPBXU58718', 'Portugal', ''),
(180, 'G9N6FPJWM541964', 'Puerto Rico', ''),
(181, 'NAD1C4OI6G67925', 'Qatar', ''),
(182, 'ZO710XWYS232537', 'Reunion', ''),
(183, 'MP96KYGDIN56741', 'Romania', ''),
(184, 'X2C56RNS0136471', 'Russian Federation', ''),
(185, 'MXS7ENG8WK92667', 'Rwanda', ''),
(186, 'XCRIWHD4LN31263', 'Saint Helena', ''),
(187, 'ULYGQ6Z9IP63201', 'Saint Kitts and Nevis', ''),
(188, 'OWF1DG405N84416', 'Saint Lucia', ''),
(189, '35TPQCUOD735844', 'Saint Pierre and Miquelon', ''),
(190, '0YLG24HB7X83427', 'Saint Vincent and The Grenadines', ''),
(191, 'G9PRWSHAYO78099', 'Samoa', ''),
(192, 'GX1S7YMWE295798', 'San Marino', ''),
(193, 'A8UJO7VYLS77462', 'Sao Tome and Principe', ''),
(194, '4OQYGLBXFZ99028', 'Saudi Arabia', ''),
(195, 'W3X40J8ZTL11432', 'Senegal', ''),
(196, 'Q3IPB06M9W70617', 'Serbia', ''),
(197, '3S1TBF7EV637514', 'Seychelles', ''),
(198, 'I8KDG4N2X378066', 'Sierra Leone', ''),
(199, 'Q6JSI13OKW43205', 'Singapore', ''),
(200, 'P59UTC4IHK98874', 'Slovakia', ''),
(201, 'FXYS6E8UH396007', 'Slovenia', ''),
(202, 'TD4YV8BGNP20540', 'Solomon Islands', ''),
(203, 'YWGV40O56F83416', 'Somalia', ''),
(204, '5TZQBJMX8U90569', 'South Africa', ''),
(205, 'V7X15RIKOZ72935', 'South Georgia and The South Sandwich Islands', ''),
(206, '8HNIQ92MBC16453', 'Spain', ''),
(207, 'X6PRWCJZQY42063', 'Sri Lanka', ''),
(208, 'FSPW6AEVLD45699', 'Sudan', ''),
(209, 'YTUMRW98PS58301', 'Suriname', ''),
(210, 'DHIGP4FLWB65805', 'Svalbard and Jan Mayen', ''),
(211, 'UNMHP6L2JE99149', 'Swaziland', ''),
(212, 'GJESCRDAMH54269', 'Sweden', ''),
(213, '4EVF7N6UP152105', 'Switzerland', ''),
(214, 'IB3TWLFUO078593', 'Syrian Arab Republic', ''),
(215, 'S91OWM0LET74671', 'Taiwan', ''),
(216, '9TDHM7GVSI26275', 'Tajikistan', ''),
(217, 'NKC7ZBEH2V54346', 'Tanzania, United Republic of', ''),
(218, 'KNE9CZGPI654818', 'Thailand', ''),
(219, '10UPLE8OQR58631', 'Timor-Leste', ''),
(220, 'NAMB8GSEY151720', 'Togo', ''),
(221, 'MKJS2FNDX665025', 'Tokelau', ''),
(222, 'TYSHFQPDW184482', 'Tonga', ''),
(223, 'XSW0J4UFLD51028', 'Trinidad and Tobago', ''),
(224, 'YERH5UG30O40602', 'Tunisia', ''),
(225, 'F8LSHG73PN84141', 'Turkey', ''),
(226, '23QR1FCL0V77582', 'Turkmenistan', ''),
(227, '149NPWY8L751863', 'Turks and Caicos Islands', ''),
(228, '4AMN3FEUDJ82922', 'Tuvalu', ''),
(229, 'U6AT5H9QEX21694', 'Uganda', ''),
(230, 'K4YW7FAJUX34120', 'Ukraine', ''),
(231, 'WF1VJBH9IX61136', 'United Arab Emirates', ''),
(232, 'S3ZOJQMP6988679', 'United Kingdom', ''),
(233, 'HZKUXJB7VL57686', 'United States', ''),
(234, '3TZPCEQ2D644095', 'United States Minor Outlying Islands', ''),
(235, '54NVSAYXT178846', 'Uruguay', ''),
(236, '43WVG2HLBT57872', 'Uzbekistan', ''),
(237, 'QG74A260OT12113', 'Vanuatu', ''),
(238, '5Q3WMC1KXR17508', 'Venezuela', ''),
(239, 'QCG76OFWBR14992', 'Vietnam', ''),
(240, 'NQ358JC6S280505', 'Virgin Islands, British', ''),
(241, 'S0YTOE42D664981', 'Virgin Islands, U.S.', ''),
(242, '31HJOQTDV444359', 'Wallis and Futuna', ''),
(243, 'HMO4NIDTXE49578', 'Western Sahara', ''),
(244, 'HI95FAWC8P66574', 'Yemen', ''),
(245, 'YFG43XMUN536284', 'Zambia', ''),
(246, 'JCR0T6Y97K34647', 'Zimbabwe', '');

-- --------------------------------------------------------

--
-- Table structure for table `doc_types`
--

CREATE TABLE IF NOT EXISTS `doc_types` (
  `doc_type_id` int(3) NOT NULL AUTO_INCREMENT,
  `doc_type_code` char(15) DEFAULT NULL,
  `doc_type_name` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`doc_type_id`),
  UNIQUE KEY `doc_type_code` (`doc_type_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `linkages`
--

CREATE TABLE IF NOT EXISTS `linkages` (
  `linkage_id` int(3) NOT NULL AUTO_INCREMENT,
  `linkage_code` char(15) DEFAULT NULL,
  `linkage_name` varchar(200) DEFAULT NULL,
  `linkage_url` varchar(200) DEFAULT NULL,
  `contact_address` text,
  `linkage_logo` varchar(200) DEFAULT NULL,
  `activation_status` int(1) DEFAULT NULL,
  `fax` varchar(200) DEFAULT NULL,
  `telephone` varchar(15) DEFAULT NULL,
  `pobox` varchar(100) DEFAULT NULL,
  `date_added` varchar(200) DEFAULT NULL,
  `date_updated` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`linkage_id`),
  UNIQUE KEY `linkage_code` (`linkage_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `member_id` int(7) NOT NULL AUTO_INCREMENT,
  `member_code` char(15) DEFAULT NULL,
  `title` varchar(20) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `other_names` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `gender` char(1) NOT NULL,
  `profession` varchar(200) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `contact_address` text,
  `country_id` int(3) NOT NULL,
  `state_id` int(3) NOT NULL,
  `date_registered` varchar(20) DEFAULT NULL,
  `num_logins` int(6) NOT NULL,
  `activation_code` varchar(50) DEFAULT NULL,
  `activation_code_used` int(1) NOT NULL,
  `activation_link_expiry` varchar(20) NOT NULL,
  `password_retrieval_code` varchar(100) NOT NULL,
  `password_retrieval_code_used` int(1) NOT NULL,
  `member_status` int(1) NOT NULL COMMENT '1 means account activated while 0 means otherwise',
  `affiliation_id` int(3) DEFAULT NULL,
  `picture` varchar(100) DEFAULT NULL,
  `fax` varchar(100) DEFAULT NULL,
  `telephone` text,
  `pobox` varchar(100) DEFAULT NULL,
  `date_updated` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`member_id`),
  UNIQUE KEY `member_code` (`member_code`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`member_id`, `member_code`, `title`, `first_name`, `other_names`, `last_name`, `gender`, `profession`, `username`, `email`, `password`, `contact_address`, `country_id`, `state_id`, `date_registered`, `num_logins`, `activation_code`, `activation_code_used`, `activation_link_expiry`, `password_retrieval_code`, `password_retrieval_code_used`, `member_status`, `affiliation_id`, `picture`, `fax`, `telephone`, `pobox`, `date_updated`) VALUES
(2, '5CQLUGH6KJ62748', 'Prof.', 'Tega', 'Philip', 'Oghenekohwo', 'M', 'Lecturer', 'tegaphilip', 'tega.philip@gmail.com', 'e72e735d7197b37a95ef206542866abcb2a8d49b', 'None', 163, 10, '1365551236', 26, 'oDzxv5KF6Ijw3tRmfbEcYdP42QTseX', 1, '', '', 0, 1, 1, NULL, 'ppp', '08026624347', 'pppp', '1365637152'),
(3, '5UQ3FK6YOT47026', 'Dr.', 'Tosin', 'Matthew', 'Adesanya', 'M', 'STudent', 'tosine', 'joinme.tosin@gmail.com', 'c96657a1854d74e368a7d3abecdc3f1e7830b3f4', 'Osegbere', 163, 28, '1365636433', 2, 'Bb8IXaykdmi5HrW37hDs6AuMoF2KOG', 1, '', '', 0, 1, 1, NULL, '', '08038142771', '', '1365636817');

-- --------------------------------------------------------

--
-- Table structure for table `officers`
--

CREATE TABLE IF NOT EXISTS `officers` (
  `officer_id` int(4) NOT NULL AUTO_INCREMENT,
  `member_id` int(7) DEFAULT NULL,
  `office_id` int(4) DEFAULT NULL COMMENT 'position',
  `date_sworn_in` varchar(20) DEFAULT NULL,
  `date_left_office` varchar(20) DEFAULT NULL,
  `status` int(1) DEFAULT NULL COMMENT '1 means still occupying posiiton while 0 means out of office',
  PRIMARY KEY (`officer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `offices`
--

CREATE TABLE IF NOT EXISTS `offices` (
  `office_id` int(3) NOT NULL AUTO_INCREMENT,
  `office_code` char(15) NOT NULL,
  `office_name` varchar(200) DEFAULT NULL,
  `tenure_period` int(3) DEFAULT NULL COMMENT 'number of months this person would stay',
  `date_added` varchar(20) DEFAULT NULL,
  `date_updated` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`office_id`),
  UNIQUE KEY `office_name` (`office_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `offices`
--

INSERT INTO `offices` (`office_id`, `office_code`, `office_name`, `tenure_period`, `date_added`, `date_updated`) VALUES
(1, 'G4HFRX9ADO55420', 'President', NULL, '1367019059', NULL),
(2, 'YT6ZEK2ID728426', 'Vice president I', NULL, '1367019059', NULL),
(3, 'ADCRI9QLG365945', 'Vice president II', NULL, '1367019059', NULL),
(4, 'DGEM65T91352662', 'Secretary', NULL, '1367019059', NULL),
(5, 'AEK3HBXTIN98267', 'Assistant Secretary', NULL, '1367019059', NULL),
(6, 'N1VIW9LAKH87446', 'Financial Secretary', NULL, '1367019059', NULL),
(7, 'SWNG60MRH439885', 'Treasurer', NULL, '1367019059', NULL),
(8, 'JBDGZHW2CR20274', 'Editor', NULL, '1367019059', NULL),
(9, 'CM8SYDOPF448300', 'Public Relations Officer', NULL, '1367019059', NULL),
(10, '91I0SWKNQP98652', 'Social Secretary', NULL, '1367019059', NULL),
(11, 'TPAMERDL1X11012', 'Business Manager', NULL, '1367019059', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `salutations`
--

CREATE TABLE IF NOT EXISTS `salutations` (
  `salutation_id` int(2) NOT NULL AUTO_INCREMENT,
  `salutation` varchar(20) NOT NULL,
  PRIMARY KEY (`salutation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `salutations`
--

INSERT INTO `salutations` (`salutation_id`, `salutation`) VALUES
(1, 'Dr.'),
(2, 'Mr.'),
(3, 'Prof.'),
(4, 'Mrs.'),
(5, 'Miss'),
(6, 'Engr.');

-- --------------------------------------------------------

--
-- Table structure for table `sponsors`
--

CREATE TABLE IF NOT EXISTS `sponsors` (
  `sponsor_id` int(3) NOT NULL AUTO_INCREMENT,
  `sponsor_code` char(15) NOT NULL,
  `sponsor_name` varchar(200) DEFAULT NULL,
  `sponsor_url` varchar(200) DEFAULT NULL,
  `sponsor_logo` varchar(200) DEFAULT NULL,
  `activation_status` int(1) DEFAULT NULL,
  `contact_address` text,
  `fax` varchar(200) DEFAULT NULL,
  `telephone` varchar(15) DEFAULT NULL,
  `pobox` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`sponsor_id`),
  UNIQUE KEY `sponsor_code` (`sponsor_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE IF NOT EXISTS `states` (
  `state_id` int(2) NOT NULL AUTO_INCREMENT,
  `state_code` char(15) DEFAULT NULL,
  `state_name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`state_id`),
  UNIQUE KEY `state_code` (`state_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`state_id`, `state_code`, `state_name`) VALUES
(1, 'D5VYZJOX8390283', 'Abia'),
(2, '8WFQJKHPR437141', 'Adamawa'),
(3, 'KOFXEZAVB952028', 'Akwa'),
(4, 'O4ALP0JIB575879', 'Anambra'),
(5, 'YNXFH2DJBC94634', 'Bauchi'),
(6, 'N7WV0H84YB49226', 'Bayelsa'),
(7, 'V31IDAFXMB15596', 'Benue'),
(8, 'A279UF4JIV24682', 'Borno'),
(9, 'GF0TZ3C1N662421', 'Cross River'),
(10, 'B3GKL8UCX069749', 'Delta'),
(11, '51FLB2VJQU32603', 'Ebonyi'),
(12, '8ENXMUP6YC71924', 'Edo'),
(13, 'M245Y6UVLA83647', 'Ekiti'),
(14, '6UTH7Q29Z098710', 'Enugu'),
(15, 'AUGRVYIF1413047', 'FCT'),
(16, 'C1QT7WU9E637602', 'Gombe'),
(17, 'LJ0A5NIEWF68310', 'Imo'),
(18, 'MT1U93R4LP46106', 'Jigawa'),
(19, 'U0HDS8FWPC46930', 'Kaduna'),
(20, '89BYPVK3N611718', 'Kano'),
(21, 'GI5VWY9KCP16409', 'Katsina'),
(22, 'L3E1IXT28R91942', 'Kebbi'),
(23, '9CJ756WFT044249', 'Kogi'),
(24, 'IYZFUB6PGV84273', 'Kwara'),
(25, '8TMGODHRNX17947', 'Lagos'),
(26, '5SYUO0Z21K56214', 'Nasarawa'),
(27, 'IVQ9XLWJY795007', 'Niger'),
(28, '851ILPKQ4C75264', 'Ogun'),
(29, 'WREU2O30I772924', 'Ondo'),
(30, 'OIBZFGP94L28923', 'Osun'),
(31, '813SPH5ICB19200', 'Oyo'),
(32, '7IBKN6OTMQ74693', 'Plateau'),
(33, 'MB34FTRDVG91338', 'Rivers'),
(34, '59IPSTAZXB10070', 'Sokoto'),
(35, 'K5FHSQPCXM86833', 'Taraba'),
(36, 'GJUSNTDHW182559', 'Yobe'),
(37, 'UEPZACLN6D73188', 'Zamfara'),
(38, 'PLI123KJUK90821', 'Non-Nigerian');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
