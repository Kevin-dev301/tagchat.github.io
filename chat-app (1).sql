-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2022 at 12:57 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chat-app`
--

-- --------------------------------------------------------

--
-- Table structure for table `dms`
--

CREATE TABLE `dms` (
  `id` int(11) NOT NULL,
  `user1` varchar(11) NOT NULL,
  `user2` varchar(11) NOT NULL,
  `latest` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dms`
--

INSERT INTO `dms` (`id`, `user1`, `user2`, `latest`) VALUES
(3, '5', '1', 19),
(4, '5', '2', 12),
(5, '5', '3', 11),
(6, '1', '2', 20);

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` int(11) NOT NULL,
  `user1` varchar(200) NOT NULL,
  `user2` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id`, `user1`, `user2`) VALUES
(11, '5', '2'),
(13, '1', '5'),
(14, '3', '5'),
(15, '2', '1');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `from_user` int(250) NOT NULL,
  `to_user` int(250) NOT NULL,
  `message` longtext NOT NULL,
  `type` int(250) NOT NULL,
  `date` varchar(2000) NOT NULL,
  `seen` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `from_user`, `to_user`, `message`, `type`, `date`, `seen`) VALUES
(4, 5, 3, 'Hey, (*_*)!!', 1, 'Wed, 20/04/2022 15:56', 1),
(5, 3, 5, 'Hey, Otag!!', 1, 'Wed, 20/04/2022 15:56', 1),
(6, 3, 5, 'How Is It goin?', 1, 'Wed, 20/04/2022 16:36', 1),
(7, 3, 5, 'XXXTENTACION - Hope _ Lyrics.mp3', 2, 'Wed, 20/04/2022 16:37', 1),
(8, 3, 5, 'mov_bbb.mp4', 3, 'Wed, 20/04/2022 16:41', 1),
(9, 3, 5, 'otag.jpg', 4, 'Wed, 20/04/2022 16:43', 1),
(10, 3, 5, 'https://yifysubtitles.org/subtitles/captain-america-the-first-avenger-2011-english-yify-83966', 5, 'Wed, 20/04/2022 16:48', 1),
(11, 3, 5, 'Sorry, Wrong Person😂😂', 1, 'Wed, 20/04/2022 17:01', 1),
(12, 5, 3, 'Ntaribi man😜', 1, 'Wed, 20/04/2022 17:18', 1),
(13, 2, 5, 'Hey, Otag!!', 1, 'Wed, 20/04/2022 17:28', 1),
(14, 5, 2, 'Hey, Sherrie.....', 1, 'Wed, 20/04/2022 17:33', 1),
(15, 5, 2, 'Kiri gute?', 1, 'Wed, 20/04/2022 17:33', 1),
(16, 5, 2, 'I wanted to talk to you, but couldnt reach you tho🙄', 1, 'Wed, 20/04/2022 17:34', 1),
(17, 2, 5, 'sha, ni fresh ntaribi', 1, 'Wed, 20/04/2022 17:34', 1),
(18, 2, 5, 'wait, you called me x?', 1, 'Wed, 20/04/2022 17:34', 1),
(19, 5, 2, 'yea, i sure did', 1, 'Wed, 20/04/2022 17:34', 1),
(20, 2, 5, 'damnnnnnnnnn', 1, 'Wed, 20/04/2022 17:35', 1),
(21, 2, 5, 'sorry, didnt see it, imma call you', 1, 'Wed, 20/04/2022 17:35', 1),
(22, 5, 2, 'its cool ntrb', 1, 'Wed, 20/04/2022 17:35', 1),
(23, 5, 2, 'yea, waiting on that', 1, 'Wed, 20/04/2022 17:35', 1),
(24, 2, 5, 'so what you think about think app', 1, 'Wed, 20/04/2022 17:36', 1),
(25, 5, 2, 'i mean, everything is so damn good🙌, didnt even know that you can do such thing, but you made it happen yoooo', 1, 'Wed, 20/04/2022 17:37', 1),
(26, 5, 2, 'we should celebrate on this😂😂', 1, 'Wed, 20/04/2022 17:37', 1),
(27, 2, 5, '😂😂shut up', 1, 'Wed, 20/04/2022 17:37', 1),
(28, 2, 5, 'imma send you the link, to that my IG username, hit the follow', 1, 'Wed, 20/04/2022 17:38', 1),
(29, 5, 2, 'yea, sure', 1, 'Wed, 20/04/2022 17:38', 1),
(30, 2, 5, 'https://www.instagram.com/oxwxz', 1, 'Wed, 20/04/2022 17:39', 1),
(31, 5, 2, 'https://www.instagram.com/oxwxz', 5, 'Wed, 20/04/2022 17:40', 1),
(42, 5, 1, 'Hey, XXL🤪!!', 1, 'Wed, 20/04/2022 22:06', 1),
(43, 5, 1, 'How Are You', 1, 'Wed, 20/04/2022 22:06', 1),
(44, 5, 1, 'You Busy?', 1, 'Wed, 20/04/2022 22:11', 1),
(45, 5, 2, 'Yo, girl', 1, 'Wed, 20/04/2022 22:12', 1),
(46, 5, 1, 'Okay, hit me when y available...', 1, 'Wed, 20/04/2022 22:13', 1),
(47, 5, 3, 'Hey, big man', 1, 'Wed, 20/04/2022 22:20', 1),
(48, 5, 2, 'localhost_coffee-king_ (1).png', 4, 'Wed, 20/04/2022 22:35', 1),
(49, 5, 2, 'mov_bbb.mp4', 3, 'Wed, 20/04/2022 22:40', 1),
(50, 5, 2, 'http://localhost/chat-app/ui/app/chat/dashboard/?c=2', 5, 'Wed, 20/04/2022 22:40', 1),
(51, 2, 5, 'Hey, Otag!!', 1, 'Thu, 21/04/2022 03:39', 1),
(52, 2, 5, 'You Home?', 1, 'Thu, 21/04/2022 03:39', 1),
(53, 2, 5, 'We Can Link Up', 1, 'Thu, 21/04/2022 03:40', 1),
(54, 5, 2, 'Yoo', 1, 'Thu, 21/04/2022 03:42', 1),
(55, 5, 2, 'Im Out but i can tell yah nimpagera', 1, 'Thu, 21/04/2022 03:43', 1),
(56, 3, 5, 'Yo, NEW DAY!!!', 1, 'Thu, 21/04/2022 03:45', 1),
(57, 2, 5, 'Like When?', 1, 'Thu, 21/04/2022 03:46', 1),
(58, 1, 5, 'Hey', 1, 'Thu, 21/04/2022 03:52', 1),
(59, 2, 5, 'Hey, XXL🤪!!', 1, 'Thu, 21/04/2022 04:05', 1),
(60, 2, 5, 'Hey, XXL🤪!!', 1, 'Thu, 21/04/2022 04:06', 1),
(61, 2, 5, 'Hey, XXL🤪!!', 1, 'Thu, 21/04/2022 04:06', 1),
(62, 2, 1, 'Hey, XXL🤪!!', 1, 'Thu, 21/04/2022 04:08', 1),
(63, 5, 1, 'Yoooooooooo', 1, 'Thu, 21/04/2022 12:20', 1),
(64, 1, 5, 'Iikiiix', 1, 'Thu, 21/04/2022 12:20', 1),
(65, 2, 1, 'Hey, ooo', 1, 'Thu, 21/04/2022 12:23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `from_user` varchar(100) NOT NULL,
  `to_user` varchar(100) NOT NULL,
  `type` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `from_user`, `to_user`, `type`) VALUES
(24, '1', '5', 2),
(26, '5', '3', 2),
(28, '5', '3', 2),
(38, '5', '1', 2),
(40, '1', '5', 2),
(41, '5', '2', 2),
(43, '2', '1', 2),
(44, '1', '5', 2),
(46, '3', '5', 2),
(48, '2', '1', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `names` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `birthdate` varchar(200) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `password` mediumtext NOT NULL,
  `profileimg` mediumtext NOT NULL,
  `coverimg` mediumtext NOT NULL,
  `description` longtext NOT NULL,
  `fb` longtext NOT NULL,
  `ig` longtext NOT NULL,
  `tl` longtext NOT NULL,
  `yt` longtext NOT NULL,
  `linkedin` longtext NOT NULL,
  `web` longtext NOT NULL,
  `active` int(250) NOT NULL,
  `active_availability` int(250) NOT NULL,
  `location` varchar(5000) NOT NULL,
  `last_seen_time` longtext NOT NULL,
  `joined` mediumtext NOT NULL,
  `verified` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `names`, `username`, `email`, `birthdate`, `gender`, `password`, `profileimg`, `coverimg`, `description`, `fb`, `ig`, `tl`, `yt`, `linkedin`, `web`, `active`, `active_availability`, `location`, `last_seen_time`, `joined`, `verified`) VALUES
(1, 'XXL🤪', 'oxwxz', 'doe@gmail.com', '2004-12-09', 'Male', '12345', 'Weekly Wallpaper_ Reduce Desktop Clutter With These Simple Designs.png', 'My minimalist Hakuna Matata Wallpaper I made to share with all of you _).png', 'Hello Stranger😜😜 !!', '#', 'https://www.instagram.com/oxwxz', '#', '#', '#', '#', 1, 1, 'Africa🌍', '1650547259', 'Apr, 2022', 1),
(2, 'Sherrie Silver', 'sherrie_', 'silver@email.org', '2003-12-10', 'Female', '123', 'Minimalistic Mountains Black and White Version [2560x1440].png', '#', '#', '#', '#', '#', '#', '#', '#', 1, 1, '#', '1650536536', 'Apr, 2022', 0),
(3, '(*_*)', 'xyz', 'terrence@ig.com', '2000-06-02', 'Male', '1234', '#', '#', '#', '#', 'xyz_rw', '#', '#', '#', '#', 1, 1, '#', '1650505474', 'Apr, 2022', 0),
(4, 'SheD', 'shed', 'shemadaniel10@gmail.com', '2004-12-02', 'Male', '12345', '#', '#', '#', '#', '#', '#', '#', '#', '#', 1, 1, '#', '1650208939', 'Apr, 2022', 0),
(5, 'Otag', 'olvis401', 'otag1@hotmail.com', '2001-04-04', 'Male', '12345', 'otag.jpg', 'navi-honMN5SyAnM-unsplash.jpg', '#', 'https://www.facebook.com/semali.olivis', 'https://instagram.com/olvis401', 'https://twitter.com/Olvis401', 'https://www.youtube.com/c/OtagLyrics', 'https://www.linkedin.com/in/semali-olvis-656529213/', 'codity.rw', 1, 1, '#', '1650536395', 'Apr, 2022', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dms`
--
ALTER TABLE `dms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dms`
--
ALTER TABLE `dms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
