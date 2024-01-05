-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2024 at 04:35 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `user` varchar(256) NOT NULL,
  `event_name` varchar(256) NOT NULL,
  `number` int(100) NOT NULL,
  `event_location` varchar(256) NOT NULL,
  `event_detail` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `user`, `event_name`, `number`, `event_location`, `event_detail`) VALUES
(1, 'Kiara', 'Basketball Day', 3, 'School Court', 'Hooping'),
(2, 'monika', 'Spa day', 3, 'Bliss', 'Time to relax'),
(4, 'lily', 'Beach Day', 4, 'Deep Water Bay', 'Lets get lunch and swim'),
(10, 'adam', 'graduation', 3, 'my house', 'celebrate end of high school'),
(11, 'adam', 'party', 10, 'The beach house', 'relaxing after exams');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `event_name` varchar(256) NOT NULL,
  `date` date NOT NULL,
  `time` time(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `username`, `event_name`, `date`, `time`) VALUES
(1, 'Kiara', 'Basketball Day', '2023-03-01', '20:40:00.000000'),
(2, 'Kiara', 'Basketball Day', '2023-02-13', '22:51:00.000000'),
(3, 'Kiara', 'Basketball Day', '2023-01-24', '13:41:00.000000'),
(4, 'monika', 'Basketball Day', '2023-02-16', '00:00:00.000000'),
(5, 'monika', 'Basketball Day', '2023-03-01', '20:40:00.000000'),
(6, 'monika', 'Basketball Day', '2023-01-30', '14:42:00.000000'),
(17, 'tracy', 'Spa Day', '2023-02-17', '10:43:00.000000'),
(18, 'tracy', 'Spa Day', '2023-03-01', '20:40:00.000000'),
(20, 'adam', 'Basketball Day', '2023-02-24', '12:36:00.000000'),
(21, 'adam', 'Basketball Day', '2023-02-14', '22:36:00.000000'),
(22, 'adam', 'Basketball Day', '2023-03-01', '20:40:00.000000'),
(23, 'adam', 'Beach  Day', '2023-02-15', '20:53:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `polls`
--

CREATE TABLE `polls` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `starts` date NOT NULL,
  `ends` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `polls`
--

INSERT INTO `polls` (`id`, `question`, `starts`, `ends`) VALUES
(1, 'Which movie should we watch?', '2023-02-01', '2023-03-15'),
(5, 'Favourite Sport in summer?', '2023-02-02', '2023-02-23'),
(6, 'What should the dress code be?', '2023-02-09', '2023-02-25');

-- --------------------------------------------------------

--
-- Table structure for table `polls_answers`
--

CREATE TABLE `polls_answers` (
  `id` int(10) NOT NULL,
  `user` int(11) NOT NULL,
  `poll` int(11) NOT NULL,
  `choice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `polls_answers`
--

INSERT INTO `polls_answers` (`id`, `user`, `poll`, `choice`) VALUES
(6, 17, 1, 2),
(7, 17, 2, 9),
(8, 17, 5, 12),
(9, 12, 5, 10),
(10, 12, 2, 4),
(12, 18, 1, 3),
(13, 20, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `polls_choices`
--

CREATE TABLE `polls_choices` (
  `id` int(11) NOT NULL,
  `poll` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `polls_choices`
--

INSERT INTO `polls_choices` (`id`, `poll`, `name`) VALUES
(1, 1, 'Spiderman'),
(2, 1, 'Mamma Mia'),
(3, 1, 'Everything Everywhere All at Once'),
(4, 2, 'Brunch '),
(7, 4, 'Formal but no black'),
(8, 2, 'lunch'),
(10, 5, 'Football'),
(11, 5, 'Basketball'),
(12, 5, 'Volleyball'),
(13, 6, 'Formal');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `access` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `access`, `username`, `password`) VALUES
(1, 2, 'admin', '$2y$10$FNUahrNXd9axggaspYSNWexlsOYMJ/Fc65Y6WmN5BE0e3wu5YHrk2'),
(16, 1, 'singhk2@wis.edu.hk', '$argon2i$v=19$m=65536,t=4,p=1$MG9sY0V2dmFxTmtnRU5tNQ$Jiqz2BP/A3m9lqTLK5vNZzYNa+tkN+1Xo/JwYmBpmxA'),
(17, 1, 'crystal', '$2y$10$UZOcxmTyWlApAfpKwK3ZWuFOWw6IulbGau.gFOWy4grX3RDuSBu52'),
(18, 1, 'adam', '$2y$10$YFfPujo2NIbOm17l77pE4OxHiz8f65GYpgwrQ9hGeGDPHoiVuDpcO'),
(19, 1, 'monika41800@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$YTRaYURhaGdHOUV6dnhySg$RuLX7Gz36pkOryBvDJzHa0DaK0JBWP4IYl9WcMVRo/M'),
(20, 1, 'jade', '$2y$10$lSvgt409aeWWVCiF/mEdTuPw9bpMAiSyknPDHoThcAymNIsxzXoDy'),
(22, 1, 'singhkiara317@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$M1p1UUR5cG90VGFoS1FmUA$BdN/F2uqD1+KgXlJeS8Yo/iPMpgUp32/5poKeFJz1Cg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `polls`
--
ALTER TABLE `polls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `polls_answers`
--
ALTER TABLE `polls_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `polls_choices`
--
ALTER TABLE `polls_choices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `polls`
--
ALTER TABLE `polls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `polls_answers`
--
ALTER TABLE `polls_answers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `polls_choices`
--
ALTER TABLE `polls_choices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
