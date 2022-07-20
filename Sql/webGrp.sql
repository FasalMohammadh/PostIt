-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 19, 2021 at 03:30 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webGrp`
--
CREATE DATABASE IF NOT EXISTS `webGrp` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `webGrp`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `password`) VALUES
('admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `user_email` varchar(255) NOT NULL,
  `user_email2` varchar(255) NOT NULL,
  `msgId` int(11) NOT NULL,
  `msg` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`user_email`, `user_email2`, `msgId`, `msg`, `time`) VALUES
('musfiquegg@gmail.com', 'indika@gmail.com', 1, 'HI', '2021-10-19 08:12:51'),
('musfiquegg@gmail.com', 'indika@gmail.com', 2, 'hello', '2021-10-19 08:13:00'),
('musfiquegg@gmail.com', 'indika@gmail.com', 3, 'hello', '2021-10-19 08:13:15'),
('musfiquegg@gmail.com', 'indika@gmail.com', 4, 'Hello', '2021-10-19 08:14:41'),
('musfiquegg@gmail.com', 'indika@gmail.com', 5, 'How Are You', '2021-10-19 08:21:58'),
('indika@gmail.com', 'musfiquegg@gmail.com', 6, 'HI', '2021-10-19 08:53:39'),
('indika@gmail.com', 'musfiquegg@gmail.com', 7, 'How Are You', '2021-10-19 08:54:04'),
('musfiquegg@gmail.com', 'indika@gmail.com', 8, 'IM Fine', '2021-10-19 08:54:20'),
('musfiquegg@gmail.com', 'chanaka@gmail.com', 9, 'Hi', '2021-10-21 09:27:13'),
('chanaka@gmail.com', 'musfiquegg@gmail.com', 10, 'HI', '2021-10-21 09:27:21');

-- --------------------------------------------------------

--
-- Table structure for table `Posts`
--

CREATE TABLE `Posts` (
  `user_email` varchar(255) NOT NULL,
  `post_id` int(11) NOT NULL,
  `post_text` varchar(255) NOT NULL,
  `post_img_path` varchar(255) NOT NULL,
  `posted_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Posts`
--

INSERT INTO `Posts` (`user_email`, `post_id`, `post_text`, `post_img_path`, `posted_time`) VALUES
('fazalmohamed.@gmail.com', 7, 'Post 01', 'otherRes/PostImages/fazalpost01.jpeg', '2021-10-14 08:36:02'),
('fazalmohamed.@gmail.com', 8, 'Post 02', 'otherRes/PostImages/fazalpost02.jpeg', '2021-10-14 08:36:02'),
('fazalmohamed.@gmail.com', 9, 'Post 03', 'otherRes/PostImages/fazalpost03.jpeg', '2021-10-14 08:36:02'),
('sadeek12@gmail.com', 10, 'Post 01', 'otherRes/PostImages/sadeekpost03.jpeg', '2021-10-14 08:36:02'),
('sadeek12@gmail.com', 11, 'Post 02', 'otherRes/PostImages/sadeekpost02.jpeg', '2021-10-14 08:36:02'),
('sadeek12@gmail.com', 12, 'Post 03', 'otherRes/PostImages/sadeekpost01.jpeg', '2021-10-14 08:36:02'),
('chanaka@gmail.com', 32, 'Flash', 'otherRes/PostImages/indika.jpeg', '2021-10-21 11:25:07');

-- --------------------------------------------------------

--
-- Table structure for table `Posts_users_like`
--

CREATE TABLE `Posts_users_like` (
  `user_email` varchar(255) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Posts_users_like`
--

INSERT INTO `Posts_users_like` (`user_email`, `post_id`) VALUES
('fazalmohamed.@gmail.com', 7),
('musfiquegg@gmail.com', 10),
('musfiquegg@gmail.com', 11),
('sadeek12@gmail.com', 7),
('sadeek12@gmail.com', 8),
('sadeek12@gmail.com', 9),
('sadeek12@gmail.com', 10),
('sadeek12@gmail.com', 12);

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `DOB` date NOT NULL,
  `profile_pic_path` varchar(255) NOT NULL,
  `joinedDate` date NOT NULL,
  `bio` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`fullname`, `email`, `password`, `DOB`, `profile_pic_path`, `joinedDate`, `bio`) VALUES
('chanaka', 'chanaka@gmail.com', 'chanaka1', '1998-10-27', 'otherRes/ProfilePics/chanaka.jpeg', '2021-10-21', 'Im chanaka Guys'),
('Fazal Mohamed', 'fazalmohamed.@gmail.com', '12341234', '2000-02-02', 'otherRes/ProfilePics/fazal.jpeg', '2015-02-02', 'Hi\r\nIm Fazal Mohamed\r\n21 years Old'),
('Indika Sandakelum', 'indika@gmail.com', 'indika12', '1998-10-08', 'otherRes/ProfilePics/indika.jpeg', '2018-10-15', 'Hi\r\nIm Indika\r\nIm 22 Years Old'),
('mohamed musfique', 'musfiquegg@gmail.com', 'mushfique', '1999-06-15', 'otherRes/ProfilePics/mushfique.jpg', '2021-10-18', 'IM Musfique '),
('Sadeek Shafee', 'sadeek12@gmail.com', 'sadeek12', '1998-07-10', 'otherRes/ProfilePics/uthpala.jpeg', '2020-10-22', 'Im Sadeek\r\nNow at 23'),
('uthpala', 'uthpala@gmail.com', 'uthpala1', '2000-10-13', 'otherRes/ProfilePics/uthpala.jpeg', '2021-10-21', 'Hi\r\nIm uthpala');

-- --------------------------------------------------------

--
-- Table structure for table `Users_friends`
--

CREATE TABLE `Users_friends` (
  `user_email` varchar(255) NOT NULL,
  `user_email2` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Users_friends`
--

INSERT INTO `Users_friends` (`user_email`, `user_email2`) VALUES
('chanaka@gmail.com', 'musfiquegg@gmail.com'),
('fazalmohamed.@gmail.com', 'indika@gmail.com'),
('indika@gmail.com', 'fazalmohamed.@gmail.com'),
('indika@gmail.com', 'musfiquegg@gmail.com'),
('indika@gmail.com', 'sadeek12@gmail.com'),
('musfiquegg@gmail.com', 'chanaka@gmail.com'),
('musfiquegg@gmail.com', 'indika@gmail.com'),
('sadeek12@gmail.com', 'indika@gmail.com'),
('sadeek12@gmail.com', 'uthpala@gmail.com'),
('uthpala@gmail.com', 'sadeek12@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`msgId`),
  ADD KEY `user_email` (`user_email`),
  ADD KEY `user_email2` (`user_email2`);

--
-- Indexes for table `Posts`
--
ALTER TABLE `Posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_email` (`user_email`);

--
-- Indexes for table `Posts_users_like`
--
ALTER TABLE `Posts_users_like`
  ADD PRIMARY KEY (`user_email`,`post_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `Users_friends`
--
ALTER TABLE `Users_friends`
  ADD PRIMARY KEY (`user_email`,`user_email2`),
  ADD KEY `user_email2` (`user_email2`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `msgId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `Posts`
--
ALTER TABLE `Posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`user_email`) REFERENCES `Users` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chat_ibfk_2` FOREIGN KEY (`user_email2`) REFERENCES `Users` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Posts`
--
ALTER TABLE `Posts`
  ADD CONSTRAINT `Posts_ibfk_1` FOREIGN KEY (`user_email`) REFERENCES `Users` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Posts_users_like`
--
ALTER TABLE `Posts_users_like`
  ADD CONSTRAINT `Posts_users_like_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `Posts` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Posts_users_like_ibfk_2` FOREIGN KEY (`user_email`) REFERENCES `Users` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Users_friends`
--
ALTER TABLE `Users_friends`
  ADD CONSTRAINT `Users_friends_ibfk_1` FOREIGN KEY (`user_email`) REFERENCES `Users` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Users_friends_ibfk_2` FOREIGN KEY (`user_email2`) REFERENCES `Users` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
