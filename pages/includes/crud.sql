-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Apr 09, 2022 at 04:34 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crud`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `content` text NOT NULL,
  `author` varchar(256) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `title`, `content`, `author`, `created_at`) VALUES
(1, ' Make Your Life Better by Saying Thank You in These 7 Situations', 'This post explains the power of a simple phrase: thank you. It also discusses a variety of situations when we should say thank you, but usually say something else instead.', 'James Anderson', '2021-08-13 14:48:50'),
(2, ' The Evolution of Anxiety: Why We Worry and What to Do About It', 'This article discusses how our evolutionary instincts clash with the modern world and what this means for anxiety, stress, and worry. I\'m proud of this one because of how I was able to blend science, practical application, and fun hand-drawn images. My best articles tend to be ones that are educational, entertaining, and useful.', 'Robin Pelinka', '2021-08-09 16:37:40'),
(3, ' The Akrasia Effect: Why We Don’t Follow Through on What We Set Out to Do and What to Do About It', 'This article shares the story of the famous author, Victor Hugo, and the totally-strange-but-somehow-effective strategy he used to overcome his chronic procrastination. Throughout the post, I weave in some interesting scientific insights about why we procrastinate and what we can do about it.', 'Cyrus Paul', '2021-08-09 16:48:22'),
(4, ' The Downside of Work-Life Balance', 'A few years ago, I came across this interesting concept about work-life balance called The Four Burners Theory. In this article, I finally got around to writing about it, and I lay out three different approaches I have used for dealing with the fundamental tradeoffs of life and work.', 'Paul McArhur', '2021-08-09 16:48:22'),
(5, 'Motivation is Overvalued. Environment Often Matters More.', 'The power of the environment is one of my favorite themes when it comes to discussing our habits and behavior. This article examines how environment has shaped the course of humanity over the centuries and then dives into the practical application of these ideas for our modern world.', 'James Cameron', '2021-08-09 16:48:22'),
(6, ' The 3 Stages of Failure in Life and Work (And How to Fix Them)', 'For one of my longest and most comprehensive articles of the year, I decided to discuss the 3 stages of failure. The examples I use primarily draw from the business world, but many of the lessons hold true for life as well. In addition to describing the symptoms, I try to offer practical strategies for fixing each of the 3 stages of failure.', 'Lily Page', '2021-08-09 16:48:22'),
(7, ' Motivation: The Scientific Guide on How to Get and Stay Motivated', 'Throughout the second half of the year, I focused on creating a variety of comprehensive guides on various topics related to habits and human performance. One of the best ones was this guide on motivation. In fact, if you search “motivation” in Google, this article will likely come up #1 or #2.', 'Sebastian Frits', '2021-08-09 16:48:22'),
(8, ' The Science of Sleep: A Brief Guide on How to Sleep Better Every Night', 'Another one of my comprehensive guides dived into the science of sleep. In this 4,600-word beast, you will not only find out how much sleep you actually need and how sleep works, but also proven ideas for how to get better sleep each night.', 'Margarette Palmer', '2021-08-09 16:48:22'),
(9, 'Healthy Eating: The Beginner’s Guide on How to Eat Healthy and Stick to It', 'This guide takes a different stance on healthy eating. Rather than focusing on telling you what to eat or how much to eat, this guide explains why we eat the way we do and what to do about it. It focuses on behaviors like why we tend to eat so much junk food and why we overeat so frequently, and then lays out simple strategies for overcoming these unhealthy habits.', 'John Senner', '2021-08-09 16:48:22'),
(10, 'The Proven Path to Doing Unique and Meaningful Work', 'Finally, we have an article that shares some brilliant advice that comes from a Finnish photographer named Arno Rafael Minkkinen. In this article, I explain the philosophy Minkkinen used to make it through the difficult portions of his career and ultimately produce unique and meaningful work. No matter what profession you are in, his advice is valuable.', 'Sofia Anderson', '2021-08-09 16:48:22');

-- --------------------------------------------------------

--
-- Table structure for table `profileimage`
--

CREATE TABLE `profileimage` (
  `id` int(11) NOT NULL,
  `usersid` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profileimage`
--

INSERT INTO `profileimage` (`id`, `usersid`, `status`) VALUES
(44, 113, 1),
(103, 160, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `verify_token` varchar(255) NOT NULL,
  `verify_status` tinyint(2) NOT NULL DEFAULT 0 COMMENT '0=no, 1=yes',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `username`, `password`, `verify_token`, `verify_status`, `created_at`) VALUES
(2, 'UPDATEFIRSTNAME', 'UPDATEDLASTNAME', 'UPDATEEMAIL@gmail.com', 'UPDATEDUSERNAME', 'dasaha', '', 1, '2021-11-04 06:21:29'),
(99, 'Dasha', 'Dasha', 'Dashataran@gmail.com', 'Dasha123', '$2y$10$gDyxmXn2CJjgceB85Uc6LeHW1P9ROUkKDpqPZFIBvD1ZP4jnww9SK', '', 0, '2021-06-30 08:02:28'),
(112, 'James', 'Anderson', 'JamesAnderson@gmail.com', 'James7', '$2y$10$WKOeHOfj8TO97R1cd3gap.M/Xi.HvQPPP88m7L8Mdms/I197E11Ri', '', 0, '2021-06-30 08:02:28'),
(113, 'Annie', 'Leonhart', 'AnnieLeonhart@gmail.com', 'Annie', '$2y$10$vRzTpMWsvktI.7lxzxEoIOQ7jGfBetUCkyd34GV1oT/LO.BuDMnIa', '', 1, '2021-07-21 11:23:14'),
(115, 'John', 'Doe', 'JohnDoe@gmail.com', 'John', '$2y$10$Z.D5ERuFY35Va2rUTleLr.XJ8vghQk00jSXpKSXzZd4eZXZABnXbS', '', 0, '2021-06-30 08:02:28'),
(121, 'a', 'a', 'asd@gmail.com', 'a', '$2y$10$o67E3pRrDkAqObHh/Jq3nef.ckgH/cnazEEjaccFWlmb9b0VvCn8y', '', 1, '2021-07-02 10:26:37'),
(160, 'Erys', 'Mozo', 'mozoerys@gmail.com', 'Erys07', '$2y$10$8HPfPHK2O52TL2Y1zqs5f.9x9KtDjTgvZRbd7dYnH5R7y7.f3lBNS', 'eb61092919a6c0691738770512dd95f3', 1, '2021-07-30 04:16:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profileimage`
--
ALTER TABLE `profileimage`
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
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `profileimage`
--
ALTER TABLE `profileimage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
