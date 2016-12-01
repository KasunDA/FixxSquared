-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2016 at 01:49 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fixx__squared`
--

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `ticket_id` int(11) NOT NULL,
  `user_requesting_id` int(11) NOT NULL,
  `user_completing_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0 = not acknowledged, 1 = acknowledged, 2 = being resolved, 3 = closed',
  `summary` varchar(500) NOT NULL,
  `request_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `completion_time_estimated` time NOT NULL DEFAULT '48:00:00',
  `completion_time_actual` time NOT NULL,
  `feedback_rating` int(11) NOT NULL DEFAULT '5',
  `feedback_comment` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`ticket_id`, `user_requesting_id`, `user_completing_id`, `status`, `summary`, `request_date`, `completion_time_estimated`, `completion_time_actual`, `feedback_rating`, `feedback_comment`) VALUES
(1, 1, 3, 3, 'Men''s Bathroom Sink Leaking', '2016-11-29 17:33:26', '48:00:00', '08:30:00', 8, 'Sink fixed very quickly'),
(2, 1, 3, 1, 'Common Area Couch Leg Broken', '2016-11-29 17:33:26', '48:00:00', '00:00:00', 5, NULL),
(3, 1, 4, 1, 'Hole in Wall', '2016-11-29 17:33:26', '48:00:00', '00:00:00', 5, NULL),
(4, 1, 4, 2, 'Heat in my room too high', '2016-11-29 17:33:26', '48:00:00', '00:00:00', 5, NULL),
(5, 1, NULL, 0, 'Window won''t close', '2016-11-29 17:33:26', '48:00:00', '00:00:00', 5, NULL),
(6, 1, NULL, 0, 'Room Key broke off in door', '2016-11-29 17:33:26', '48:00:00', '00:00:00', 5, NULL),
(7, 2, 3, 1, 'Toilet clogged in women''s bathroom', '2016-11-29 17:33:26', '48:00:00', '00:00:00', 5, NULL),
(8, 2, 3, 2, 'Too cold in my room', '2016-11-29 17:33:26', '48:00:00', '00:00:00', 5, NULL),
(9, 2, 4, 1, 'Window won''t open', '2016-11-29 17:33:26', '48:00:00', '00:00:00', 5, NULL),
(10, 2, 4, 3, 'Vending machine eating money', '2016-11-29 17:33:26', '48:00:00', '23:00:00', 2, 'Waited very long for this fix'),
(11, 2, NULL, 0, 'Ceiling tile missing', '2016-11-29 17:33:26', '48:00:00', '00:00:00', 5, NULL),
(12, 2, NULL, 0, 'Urinal flooding bathroom', '2016-11-29 17:33:26', '48:00:00', '00:00:00', 5, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_type` int(11) NOT NULL DEFAULT '0' COMMENT '0 = student, 1 = Fixx, 2 = admin',
  `email_address` varchar(30) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_salt` varchar(255) NOT NULL,
  `residence_hall` varchar(20) DEFAULT NULL,
  `room` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_type`, `email_address`, `password_hash`, `password_salt`, `residence_hall`, `room`) VALUES
(1, 0, 'student1@rpi.edu', '8af0aa2189db20757ba75cc6e8fcb38aff5e80db', 'morton', 'Barton', '225'),
(2, 0, 'student2@rpi.edu', 'f740beb143c8d23a3ee1640b2f09326fa8c948a6', 'morton', 'Hall', '104'),
(3, 1, 'fixx1@rpi.edu', '0c25c664a1342c193ddf7302c28e12ad9550c36a', 'kosher', NULL, NULL),
(4, 1, 'fixx2@rpi.edu', '7556246a880d901b5de0909b08c5d35db3372712', 'kosher', NULL, NULL),
(5, 2, 'admin1@rpi.edu', '1541fe22c1aab08910015f2c5c55d67e933e3c94', 'sea', NULL, NULL),
(6, 2, 'admin2@rpi.edu', '31eb34563c686ad36ae5cf2e930967bb8b8217aa', 'sea', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `user_requesting_id` (`user_requesting_id`),
  ADD KEY `user_completing_id` (`user_completing_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `user_completing_ticket` FOREIGN KEY (`user_completing_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `user_requesting_ticket` FOREIGN KEY (`user_requesting_id`) REFERENCES `users` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
