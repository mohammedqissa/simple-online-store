-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 30, 2017 at 07:39 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";



--
-- Database: `simple_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `fname` varchar(15) NOT NULL,
  `lname` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `question` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `products_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` int(25) NOT NULL,
  `category` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `photo_dir` varchar(100) NOT NULL,
  `stock` int(11) NOT NULL,
  `visible` tinyint(1) DEFAULT '1',
  `size` varchar(25) NOT NULL,
  `target_age` int(11) NOT NULL,
  `remarks` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `category`, `description`, `photo_dir`, `stock`, `visible`, `size`, `target_age`, `remarks`) VALUES
(100000, 'Toy', 200, 'Puzzle', 'this toy is for children', 'images/products/toy', 20, 1, '', 0, ''),
(100001, 'Toy2', 80, 'Doll', 'ahsgd lakshdkjha jksda dashdkjhaskjdh', 'images/products/toy', 5, 1, '', 0, ''),
(100002, 'Toy3', 150, 'Doll', 'akjsdjkahsdkjhasd asd ashd alsdh kjahsdjk ahsd', 'images/products/toy', 0, 1, '', 0, ''),
(100003, 'Toy4', 30, 'Board Game', 'akjshdjas asjd jahdh basd ahsdjkh ajshd jhasjd ', 'images/products/toy', 15, 1, '', 0, ''),
(100004, 'Toy5', 80, 'Board Game', 'sdf sdfka jkasd ', 'images/products/toy', 20, 1, '', 0, ''),
(100005, 'TOy6', 30, 'Educational Game', 'akjshd alksdj khsdh jkashd kjasd', 'images/products/toy', 5, 1, '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `name` varchar(40) NOT NULL,
  `address` varchar(40) NOT NULL,
  `date` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `exDate` varchar(20) NOT NULL,
  `cName` varchar(40) NOT NULL,
  `BanckName` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `userName` varchar(40) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `rule` int(2) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `address`, `date`, `email`, `phone`, `number`, `exDate`, `cName`, `BanckName`, `password`, `userName`, `is_active`, `rule`) VALUES
(1000000000, 'moe', 'ramallah', '29/12/1994', 'lasd@gmail.com', 5975685, 98547245, '2/1/2015', 'iyhkjfdikj', 'jordan', '25f9e794323b453885f5181f1b624d0b', 'moe', 1, 2),
(1000000001, 'admin', 'ramallah', '29/12/1995', 'asd@asd.com', 54, 655845, '232598865', 'admin', 'jordan', '25f9e794323b453885f5181f1b624d0b', 'mohammed', 1, 1),
(1000000007, 'Mohammed Issa', 'ramallah', '123123', 'm5@gmail.com', 597859022, 123123, '123123', '123123', '123123', '25d55ad283aa400af464c76d713c07ad', 'mohammed1', 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `products_id` (`products_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000000008;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`products_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `userid` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

