-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2017 at 02:17 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `game`
--

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE `scores` (
  `user` int(11) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scores`
--

INSERT INTO `scores` (`user`, `score`) VALUES
(1, 100),
(2, 200),
(3, 400),
(1, 500),
(1, 700);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`) VALUES
(1, 'admin', '$2y$10$0hrjeNRXS01tzsTzPJi2Yu1G7Ggo6RoJ3/88M27Gg.AX8jDVjRMje', 'admin@test.pl'),
(2, 'test', '$2y$10$eAQ0B1UD1ps6729sFMr6CewqFbNrFKsRyDKdImp/iQEfkHD0TpL2S', 'test@test.pl'),
(3, 'Admin Nowak', '$2y$10$PHgIT5j/kFHmfoPDTlUyIeH2QWT320mCeLyMJpQz3IG9BXJTxZiE6', 'admin@wp.pl'),
(10, 'root', '$2y$10$OxoduJE360gmyfBn9eKxe.xZaGho4pd01XnbuXCwTZ0VF8u4OIgyq', 'root@wp.pl');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `scores`
--
ALTER TABLE `scores`
  ADD KEY `user` (`user`),
  ADD KEY `score` (`score`,`user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
