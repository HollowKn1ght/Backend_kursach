-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2020 at 10:17 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33
CREATE DATABASE IF NOT EXISTS appDB;
CREATE USER IF NOT EXISTS 'user'@'%' IDENTIFIED BY 'password';
GRANT SELECT,UPDATE,INSERT ON appDB.* TO 'user'@'%';
FLUSH PRIVILEGES;
use appDB;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vss_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `middlename` varchar(200) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `avatar` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),

  PRIMARY KEY(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `middlename`, `contact`, `address`, `email`, `password`, `avatar`, `date_created`) VALUES
(1, 'John', 'Smith', 'C', '+14526-5455-44', 'Sample Address', 'jsmith@sample.com', '1254737c076cf867dc53d60a0364f38e', '1604716320_no-image-available.png', '2020-11-07 10:32:29'),
(2, 'Claire', 'Blake', '', '8747808787', 'Sample Address', 'cblake@sample.com', '4744ddea876b11dcb1d169fadf494418', '', '2020-11-07 14:48:09'),
(3, 'George', 'Wilson', '', '+1234562623', 'Sample Address', 'gwilson@sample.com', 'gwilson123', '1604740200_avatar2.png', '2020-11-07 17:10:06');

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `code` varchar(200) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `thumbnail_path` text NOT NULL DEFAULT '',
  `video_path` text NOT NULL,
  `user_id` int(30) NOT NULL,
  `total_views` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),

  PRIMARY KEY(`id`),

  FOREIGN KEY(`user_id`)
    REFERENCES `users` (`id`)
    ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`id`, `code`, `title`, `description`, `thumbnail_path`, `video_path`, `user_id`, `total_views`, `date_created`) VALUES
(8, 'LUwzRtMgZDEG0YcN', 'Sample', 'Sample', '', 'LUwzRtMgZDEG0YcN.mp4', 1, 0, '2020-11-07 17:16:17');

-- --------------------------------------------------------

--
-- Table structure for table `views`
--

CREATE TABLE `views` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `upload_id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `ip_address` varchar(200) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),

  PRIMARY KEY(`id`),

  FOREIGN KEY (`user_id`) 
    REFERENCES `users` (`id`) 
    ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `upload_id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `ip_address` varchar(200) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),

  PRIMARY KEY(`id`),

  FOREIGN KEY (`user_id`) 
    REFERENCES `users` (`id`) 
    ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `upload_id` int(30) NOT NULL,
  `comment_id` int(30) NOT NULL AUTO_INCREMENT,
  `user_id` int(30) NOT NULL,
  `comment` text NOT NULL,
  `comment_sender_name` varchar(200) NOT NULL,
  `comment_at` datetime NOT NULL DEFAULT current_timestamp(),

  PRIMARY KEY(`comment_id`),

  FOREIGN KEY (`user_id`) 
    REFERENCES `users` (`id`) 
    ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads` AUTO_INCREMENT = 9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users` AUTO_INCREMENT = 4;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
