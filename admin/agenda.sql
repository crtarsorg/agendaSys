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
  `ename` tinytext,
  `edesc` tinytext,
  `eldesc` text,
  `edate` date NOT NULL,
  `etime` time NOT NULL,
  `eloc` int(11) NOT NULL,
  `eact` tinyint(1) NOT NULL DEFAULT '0',
  `elink` tinytext,
  `epartneri` text,
  `etip` varchar(300) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s2es`
--

CREATE TABLE IF NOT EXISTS `s2es` (
  `s2esid` int(11) NOT NULL,
  `evtid` int(11) NOT NULL,
  `spkid` int(11) NOT NULL,
  `s2esord` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `speakers`
--

CREATE TABLE IF NOT EXISTS `speakers` (
  `sid` int(11) NOT NULL,
  `sname` tinytext NOT NULL,
  `sdesc` text,
  `simg` tinytext,
  `sorg` tinytext,
  `stitula` tinytext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
  MODIFY `eid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `s2es`
--
ALTER TABLE `s2es`
  MODIFY `s2esid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `speakers`
--
ALTER TABLE `speakers`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
