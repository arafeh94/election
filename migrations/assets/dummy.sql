-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 16, 2018 at 11:43 AM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET FOREIGN_KEY_CHECKS = 0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: election
--

--
-- Truncate table before insert `area`
--

TRUNCATE TABLE `area`;
--
-- Dumping data for table `area`
--

INSERT INTO `area` (AreaId, DaairaId, `Name`) VALUES
  (1, 1, 'tripoli'),
  (2, 1, 'minye'),
  (3, 1, 'denniye');

--
-- Truncate table before insert candidate
--

TRUNCATE TABLE candidate;
--
-- Dumping data for table candidate
--

INSERT INTO candidate (CandidateId, ElectorListId, KalamId, `Number`, `Name`) VALUES
  (1, 1, 1, 1231, 'candidate1'),
  (2, 1, 1, 1232, 'candidate2'),
  (3, 2, 2, 1233, 'candidate3'),
  (4, 2, 3, 1234, 'candidate4'),
  (5, 3, 2, 1235, 'candidate5'),
  (6, 3, 2, 1236, 'candidate6'),
  (7, 3, 3, 1237, 'candidate7'),
  (8, 3, 1, 1238, 'candidate8'),
  (9, 3, 3, 1239, 'candidate9');

--
-- Truncate table before insert daaira
--

TRUNCATE TABLE daaira;
--
-- Dumping data for table daaira
--

INSERT INTO daaira (DaairaId, `Name`) VALUES
  (1, 'alshamal');

--
-- Truncate table before insert electorlist
--

TRUNCATE TABLE electorlist;
--
-- Dumping data for table electorlist
--

INSERT INTO electorlist (ElectorListId, `Name`, Color) VALUES
  (1, 'rifi', '#fff'),
  (2, 'hariri', '#bbb'),
  (3, 'mikati', '#ccc');

--
-- Truncate table before insert kalam
--

TRUNCATE TABLE kalam;
--
-- Dumping data for table kalam
--

INSERT INTO kalam (KalamId, AreaId, `Number`) VALUES
  (1, 1, 121),
  (2, 1, 122),
  (3, 2, 123),
  (4, 2, 124),
  (5, 3, 125),
  (6, 3, 126),
  (7, 3, 127);

--
-- Truncate table before insert `user`
--

TRUNCATE TABLE `user`;
--
-- Dumping data for table `user`
--

INSERT INTO `user` (UserId, Username, `Password`, KalamId) VALUES
  (0, 'admin', 'admin', 1);

--
-- Truncate table before insert vote
--

TRUNCATE TABLE vote;
SET FOREIGN_KEY_CHECKS = 1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
