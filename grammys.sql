-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 19, 2014 at 10:34 AM
-- Server version: 5.5.38
-- PHP Version: 5.5.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `grammys`
--

-- --------------------------------------------------------

--
-- Table structure for table `artist`
--

CREATE TABLE IF NOT EXISTS `artist` (
`artist_id` int(4) NOT NULL,
  `artist_name` varchar(128) NOT NULL,
  `artist_label` varchar(128) NOT NULL,
  `artist_details` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `artist`
--

INSERT INTO `artist` (`artist_id`, `artist_name`, `artist_label`, `artist_details`) VALUES
(1, 'Taylor Swift', 'Big Machine Record', ''),
(2, 'Lorde', 'Universal Music', ''),
(4, 'Ed Sheeran', 'Atlantic Records', ''),
(5, 'Emily King', 'J Records', ''),
(6, 'Plain white t''s', 'Atlantic Records', ''),
(7, 'Tom Odell', 'Columbia', '');

-- --------------------------------------------------------

--
-- Table structure for table `award`
--

CREATE TABLE IF NOT EXISTS `award` (
`award_id` int(4) NOT NULL,
  `award_name` varchar(128) NOT NULL,
  `genre_id` int(4) NOT NULL,
  `grammys_id` int(4) NOT NULL,
  `presenter_id` int(4) NOT NULL,
  `award_year` int(4) NOT NULL,
  `winner` int(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `award`
--

INSERT INTO `award` (`award_id`, `award_name`, `genre_id`, `grammys_id`, `presenter_id`, `award_year`, `winner`) VALUES
(18, 'Record of the year', 4, 54, 11, 2014, 21),
(19, 'Song of the year', 4, 54, 11, 2014, 1),
(32, 'Album of the Year', 10, 54, 1, 2014, 12),
(33, 'dfdf', 1, 53, 7, 2014, 25),
(34, 'dfdf', 1, 53, 7, 2014, 25),
(35, 'dfdf', 6, 54, 10, 2014, 25);

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE IF NOT EXISTS `genre` (
`genre_id` int(4) NOT NULL,
  `genre_name` varchar(128) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`genre_id`, `genre_name`) VALUES
(1, 'Alternative'),
(2, 'American Roots'),
(3, 'Classical'),
(4, 'Country'),
(5, 'Dance'),
(6, 'Gospel'),
(7, 'Historical'),
(8, 'Jazz'),
(9, 'Latin'),
(10, 'Pop'),
(11, 'R&B'),
(12, 'Rap'),
(13, 'Reggae'),
(14, 'Remixer'),
(15, 'Rock'),
(16, 'Trad Pop');

-- --------------------------------------------------------

--
-- Table structure for table `nominee`
--

CREATE TABLE IF NOT EXISTS `nominee` (
`nominee_id` int(4) NOT NULL,
  `award_id` int(4) NOT NULL,
  `song_id` int(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nominee`
--

INSERT INTO `nominee` (`nominee_id`, `award_id`, `song_id`) VALUES
(18, 16, 1),
(19, 17, 25),
(22, 18, 25),
(32, 19, 1),
(33, 19, 4),
(39, 30, 1),
(41, 30, 6),
(44, 30, 4),
(46, 30, 25),
(54, 31, 1),
(55, 31, 6),
(56, 31, 4),
(57, 31, 25),
(61, 32, 25),
(62, 32, 12),
(63, 33, 21),
(64, 33, 25),
(65, 33, 1),
(66, 34, 21),
(67, 34, 25),
(68, 34, 1),
(70, 19, 13);

-- --------------------------------------------------------

--
-- Table structure for table `presenter`
--

CREATE TABLE IF NOT EXISTS `presenter` (
`presenter_id` int(4) NOT NULL,
  `presenter_name` varchar(128) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `presenter`
--

INSERT INTO `presenter` (`presenter_id`, `presenter_name`) VALUES
(1, 'Marc Anthony'),
(2, 'Black Sabbath'),
(3, 'Zac Brown'),
(4, 'Gloria Estefan'),
(5, 'Anna Faris'),
(6, 'Jamie Foxx'),
(7, 'Ariana Grande'),
(8, 'Neil Patrick Harris'),
(9, 'Olivia Harrison'),
(10, 'Anna Kendrick'),
(11, 'Alicia Keys'),
(12, 'Juanes'),
(13, 'Cyndi Lauper'),
(14, 'Jared Leto'),
(15, 'Bruno Mars'),
(16, 'Martina McBride'),
(17, 'Miguel'),
(18, 'Yoko Ono'),
(19, 'Smokey Robinson'),
(20, 'Ryan Seacrest'),
(21, 'Steven Tyler');

-- --------------------------------------------------------

--
-- Table structure for table `song`
--

CREATE TABLE IF NOT EXISTS `song` (
`song_id` int(4) NOT NULL,
  `song_title` varchar(128) NOT NULL,
  `artist_id` int(4) NOT NULL,
  `album` varchar(128) NOT NULL,
  `genre_id` int(11) NOT NULL,
  `winner` int(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `song`
--

INSERT INTO `song` (`song_id`, `song_title`, `artist_id`, `album`, `genre_id`, `winner`) VALUES
(1, 'All too well', 1, 'Red', 4, 0),
(2, 'State of Grace', 1, 'Red', 4, 0),
(3, 'Begin Again', 1, 'Red', 4, 0),
(4, 'Everything has changed', 1, 'Red', 4, 0),
(5, 'The last time', 1, 'Red', 4, 0),
(6, 'Holy Ground', 1, 'Red', 4, 0),
(7, 'Out of the woods', 1, '1989', 10, 0),
(8, 'Style', 1, '1989', 10, 0),
(9, 'Blank Space', 1, '1989', 10, 0),
(10, 'Welcome to Newyork', 1, '1989', 10, 0),
(11, 'Enchanted', 1, 'Red', 4, 0),
(12, 'Sweeter than fiction', 1, 'Ost. One Chance', 10, 0),
(13, 'I Know', 7, 'Long Way Down', 1, 0),
(14, 'Another Love', 7, 'Long Way Down', 1, 0),
(15, 'Hold Me', 7, 'Long Way Down', 1, 0),
(16, 'Love Club', 2, 'Pure Heroine ', 10, 0),
(17, 'Royal', 2, 'Pure Heroine', 10, 0),
(18, 'Team', 2, 'Pure Heroine', 10, 0),
(19, 'Yellow Flicker Beat', 2, 'Ost. Hunger Games, the mocking Jay Pat I', 10, 0),
(20, 'Sing', 4, 'X', 10, 0),
(21, 'Afire Love', 4, 'X', 10, 0),
(22, 'Distance', 4, 'East Side Story', 11, 0),
(23, 'Hey There Delilah', 6, 'Bid Bad World', 10, 0),
(24, 'Rhythm of Love', 6, 'Bid Bad World', 10, 0),
(25, '1,2,3,4', 6, 'Bid Bad World', 10, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artist`
--
ALTER TABLE `artist`
 ADD PRIMARY KEY (`artist_id`);

--
-- Indexes for table `award`
--
ALTER TABLE `award`
 ADD PRIMARY KEY (`award_id`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
 ADD PRIMARY KEY (`genre_id`);

--
-- Indexes for table `nominee`
--
ALTER TABLE `nominee`
 ADD PRIMARY KEY (`nominee_id`);

--
-- Indexes for table `presenter`
--
ALTER TABLE `presenter`
 ADD PRIMARY KEY (`presenter_id`);

--
-- Indexes for table `song`
--
ALTER TABLE `song`
 ADD PRIMARY KEY (`song_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artist`
--
ALTER TABLE `artist`
MODIFY `artist_id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `award`
--
ALTER TABLE `award`
MODIFY `award_id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
MODIFY `genre_id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `nominee`
--
ALTER TABLE `nominee`
MODIFY `nominee_id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT for table `presenter`
--
ALTER TABLE `presenter`
MODIFY `presenter_id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `song`
--
ALTER TABLE `song`
MODIFY `song_id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
