-- phpMyAdmin SQL Dump
-- version 4.4.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2016 at 02:36 PM
-- Server version: 5.6.25-log
-- PHP Version: 5.6.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agenda`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `eid` int(11) NOT NULL,
  `ename` tinytext NOT NULL,
  `edesc` tinytext,
  `eldesc` text,
  `edate` date NOT NULL,
  `etime` time NOT NULL,
  `eloc` int(11) NOT NULL,
  `eact` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`eid`, `ename`, `edesc`, `eldesc`, `edate`, `etime`, `eloc`, `eact`) VALUES
(1, 'Collecting documentation', NULL, NULL, '2016-11-01', '08:30:00', 1, 1),
(2, 'Main Session - Official Welcome', 'Short decs', '<p>				Long desc here</p>', '2016-11-02', '15:00:00', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `lid` int(11) NOT NULL,
  `lname` tinytext NOT NULL,
  `ldesc` text NOT NULL,
  `lcoordx` decimal(8,6) DEFAULT '44.802472',
  `lcoordy` decimal(8,6) DEFAULT '20.466341',
  `lcolor` tinytext NOT NULL,
  `ladres` tinytext NOT NULL,
  `lcity` tinytext NOT NULL,
  `lstate` tinytext
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`lid`, `lname`, `ldesc`, `lcoordx`, `lcoordy`, `lcolor`, `ladres`, `lcity`, `lstate`) VALUES
(1, 'Lobi22', 'Lobi na glavnom ulazu22', '44.802472', '20.466342', 'FF0000', 'Trg Nikole Pašića 1332', 'Beograd32', 'Srbija'),
(2, 'Skupstinska sala br 1', '', '44.802472', '20.466341', '00FF00', 'Trg Nikole Pašića 13', 'Beograd', ''),
(3, 'name', '<h1><b>				desc&nbsp;</b></h1><p>here</p>', '44.802472', '20.466341', '1024FF', 'adresa', 'grad', 'drzava'),
(4, 'test lok naziv', '<p>				test opis						</p>', '44.802472', '20.466341', 'FF0000', 'adesa', 'BGD', 'SRB');

-- --------------------------------------------------------

--
-- Table structure for table `s2es`
--

CREATE TABLE IF NOT EXISTS `s2es` (
  `s2esid` int(11) NOT NULL,
  `evtid` int(11) NOT NULL,
  `spkid` int(11) NOT NULL,
  `s2esord` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `s2es`
--

INSERT INTO `s2es` (`s2esid`, `evtid`, `spkid`, `s2esord`) VALUES
(1, 2, 1, 1),
(2, 2, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `speakers`
--

CREATE TABLE IF NOT EXISTS `speakers` (
  `sid` int(11) NOT NULL,
  `sname` tinytext NOT NULL,
  `sdesc` text,
  `simg` tinytext
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `speakers`
--

INSERT INTO `speakers` (`sid`, `sname`, `sdesc`, `simg`) VALUES
(1, 'Aleksandar Vučić', '<p>				Aleksandar Vučić (Beograd, SFRJ, 5. mart 1970) srpski je pravnik i političar, predsednik Vlade Republike Srbije i predsednik Srpske napredne stranke. Bivši je ministar odbrane i ministar za informisanje.&nbsp;\r\n</p><div>Četrnaest godina bio je generalni sekretar Srpske radikalne stranke, a bio je i ministar informisanja u Vladi narodnog jedinstva[1] u Vladi Srbije čiji je premijer bio Mirko Marjanović.						</div>', 'x.png'),
(2, 'Raša Nedeljkov', '<p>aaa rfgdfg fdhgdfh</p>', '2.png'),
(3, 'dfgd', '<p>gdg</p>', NULL),
(4, 'test', '<p>testting</p>', '4.png'),
(5, 'qq', '<p>wwww</p>', '5.png'),
(6, 'MDK', '<ul><li><b><i>MDEk DESC</i></b></li></ul>', '6.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`eid`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`lid`);

--
-- Indexes for table `s2es`
--
ALTER TABLE `s2es`
  ADD PRIMARY KEY (`s2esid`);

--
-- Indexes for table `speakers`
--
ALTER TABLE `speakers`
  ADD PRIMARY KEY (`sid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `eid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `s2es`
--
ALTER TABLE `s2es`
  MODIFY `s2esid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `speakers`
--
ALTER TABLE `speakers`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
