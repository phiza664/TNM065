-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Värd: localhost
-- Skapad: 05 mars 2014 kl 18:34
-- Serverversion: 5.5.24-log
-- PHP-version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databas: `sebra729`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `card`
--

CREATE TABLE IF NOT EXISTS `card` (
  `Card_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Date_Created` date NOT NULL,
  `Content` varchar(500) NOT NULL,
  `Signature` varchar(100) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Image_URL` varchar(500) NOT NULL,
  PRIMARY KEY (`Card_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumpning av Data i tabell `card`
--

INSERT INTO `card` (`Card_ID`, `Date_Created`, `Content`, `Signature`, `Title`, `Image_URL`) VALUES
(17, '2013-01-15', 'qwe', 'qwe', 'qwe', 'qwe'),
(37, '2013-01-16', 'QWE', 'WE', 'QWE', 'QWE');

-- --------------------------------------------------------

--
-- Tabellstruktur `makes`
--

CREATE TABLE IF NOT EXISTS `makes` (
  `Card_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  PRIMARY KEY (`Card_ID`,`User_ID`),
  UNIQUE KEY `Card_ID` (`Card_ID`),
  KEY `User_ID` (`User_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `makes`
--

INSERT INTO `makes` (`Card_ID`, `User_ID`) VALUES
(17, 5),
(37, 25);

-- --------------------------------------------------------

--
-- Tabellstruktur `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `User_Name` varchar(150) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `User_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Date_Created` date NOT NULL,
  PRIMARY KEY (`User_ID`),
  UNIQUE KEY `User_Name` (`User_Name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumpning av Data i tabell `user`
--

INSERT INTO `user` (`User_Name`, `Name`, `Password`, `User_ID`, `Date_Created`) VALUES
('hamax109@student.liu.se', 'Pissluffaren', 'pissluffar', 1, '2012-12-05'),
('sebbe@mail.se', 'sebbe', 'sebbe', 5, '0000-00-00'),
('QWE', 'qwe', 'QWE', 25, '2013-01-16');

-- --------------------------------------------------------

--
-- Tabellstruktur `userclass`
--

CREATE TABLE IF NOT EXISTS `userclass` (
  `User_Class` varchar(100) NOT NULL,
  `User_ID` int(11) NOT NULL,
  KEY `User_Class` (`User_Class`),
  KEY `User_ID` (`User_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `userclass`
--

INSERT INTO `userclass` (`User_Class`, `User_ID`) VALUES
('user', 1),
('admin', 5),
('user', 25);

--
-- Restriktioner för dumpade tabeller
--

--
-- Restriktioner för tabell `makes`
--
ALTER TABLE `makes`
  ADD CONSTRAINT `MAKES_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `user` (`User_ID`);

--
-- Restriktioner för tabell `userclass`
--
ALTER TABLE `userclass`
  ADD CONSTRAINT `USERCLASS_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `user` (`User_ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
