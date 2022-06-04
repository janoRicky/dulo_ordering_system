-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 13, 2022 at 01:59 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dulo_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_accounts`
--

CREATE TABLE `admin_accounts` (
  `admin_id` int(11) NOT NULL,
  `name` varchar(64) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_accounts`
--

INSERT INTO `admin_accounts` (`admin_id`, `name`, `email`, `password`, `status`) VALUES
(1, 'Joseph Joestar', 'test@email.com', '$2y$10$o3RJwNPSIGw7bvew7albS.WJW2z.86cpuJtFWGuijX2Gmtk8d/MKq', '1'),
(2, 'Jano', 'jano@email.com', '$2y$10$g9d2JywrH4SssKWWg4oVE.4c8viSWafcyZinOQQwgWT.M8.xSni7m', '1');

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `config_id` int(11) NOT NULL,
  `c_key` varchar(63) DEFAULT NULL,
  `c_val` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`config_id`, `c_key`, `c_val`, `status`) VALUES
(1, 'smtp_user', 'angeliclay.ordering@gmail.com', NULL),
(2, 'smtp_pass', 'qmozloihhnugmaqd', NULL),
(3, 'mail_sender', 'angeliclay.ordering@gmail.com', NULL),
(4, 'alerts_email_send_to', 'pogbobo@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `log_id` int(11) NOT NULL,
  `actor_id` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `link` varchar(127) DEFAULT NULL,
  `type` int(31) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `seen` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` varchar(16) DEFAULT NULL,
  `description` varchar(128) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `zip_code` varchar(11) DEFAULT NULL,
  `country` varchar(64) DEFAULT NULL,
  `province` varchar(64) DEFAULT NULL,
  `city` varchar(64) DEFAULT NULL,
  `street` varchar(64) DEFAULT NULL,
  `address` varchar(64) DEFAULT NULL,
  `state` varchar(16) DEFAULT NULL,
  `status` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `description`, `date_time`, `zip_code`, `country`, `province`, `city`, `street`, `address`, `state`, `status`) VALUES
(1, '1', 'Test', '2021-07-22 02:01:00', '1870', 'Philippines', 'Rizal', 'Antipolo', 'Rd', '828', '0', '1'),
(2, '1', 'Test', '2021-07-27 21:28:35', '1870', 'Philippines', 'Rizal', 'Antipolo', 'Rd', '828', '5', '1'),
(3, '2', 'Try', '2021-07-27 21:32:00', '1234', 'Yes', 'No', 'Maybe', 'Idunno', 'Try', '3', '1'),
(4, '1', NULL, '2021-07-28 14:17:23', '1870', 'Philippines', 'Rizal', 'Antipolo', 'Rd', '828', '1', '1'),
(5, '1', 'test', '2021-07-30 00:36:00', '1870', 'Philippines', 'Rizal', 'Antipolo', 'Rd', '828', '0', '1'),
(6, '2', 'tst', '2021-07-30 00:37:00', '1234', 'Yes', 'No', 'Maybe', 'Idunno', '', '0', '1'),
(7, '3', 'test', '2021-07-30 01:10:00', '1234', 'Ctr', 'Prv', 'Ct', 'StRd', '', '0', '1'),
(8, '3', 'try', '2021-07-30 01:21:00', '1234', 'Ctr', 'Prv', 'Ct', 'StRd', '', '0', '1'),
(9, '1', 'test', '2021-07-30 01:41:00', '1870', 'Philippines', 'Rizal', 'Antipolo', 'Rd', '828', '1', '1'),
(10, '3', 'test', '2021-07-30 01:42:00', '1234', 'Ctr', 'Prv', 'Ct', 'StRd', '', '0', '1'),
(11, '1', 'Test', '2021-07-30 01:42:00', '1234', 'Ctr', 'Pro', 'Cty', 'Strd', '', '1', '1'),
(12, '1', NULL, '2021-08-25 22:42:47', '1870', 'Philippines', 'Rizal', 'Antipolo', 'Rd', '828', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `orders_items`
--

CREATE TABLE `orders_items` (
  `item_id` int(11) NOT NULL,
  `order_id` varchar(16) DEFAULT NULL,
  `product_id` varchar(16) DEFAULT NULL,
  `qty` varchar(16) DEFAULT NULL,
  `price` varchar(32) DEFAULT NULL,
  `type` varchar(32) DEFAULT NULL,
  `status` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders_items`
--

INSERT INTO `orders_items` (`item_id`, `order_id`, `product_id`, `qty`, `price`, `type`, `status`) VALUES
(1, '1', '2', '1', '200', 'NORMAL', NULL),
(2, '1', '1', '1', '200', 'NORMAL', NULL),
(3, '2', '1', '1', '250', 'CUSTOM', NULL),
(4, '3', '2', '1', '250', 'CUSTOM', NULL),
(5, '4', '2', '1', '200', 'NORMAL', NULL),
(6, '5', '1', '2', '200', 'NORMAL', NULL),
(7, '6', '4', '2', '250', 'NORMAL', NULL),
(8, '6', '2', '2', '200', 'NORMAL', NULL),
(9, '7', '2', '3', '200', 'NORMAL', NULL),
(10, '8', '4', '3', '250', 'NORMAL', NULL),
(11, '9', '3', '10', '30', 'CUSTOM', NULL),
(12, '10', '4', NULL, NULL, 'CUSTOM', NULL),
(13, '11', '5', '1', '1216', 'CUSTOM', NULL),
(14, '12', '1', '1', '200', 'NORMAL', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders_payments`
--

CREATE TABLE `orders_payments` (
  `payment_id` int(11) NOT NULL,
  `order_id` varchar(11) DEFAULT NULL,
  `description` varchar(128) DEFAULT NULL,
  `img` varchar(64) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `amount` varchar(32) DEFAULT NULL,
  `type` int(11) DEFAULT NULL COMMENT '0=order;1=additional;',
  `status` varchar(16) DEFAULT NULL COMMENT '0=unpaid;1=paid;'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders_payments`
--

INSERT INTO `orders_payments` (`payment_id`, `order_id`, `description`, `img`, `date_time`, `amount`, `type`, `status`) VALUES
(2, '12', 'tester', '27f9d815a3b034a82dee91fedad43a53.jpg', '2021-07-28 14:17:00', '1020.00', 0, '0'),
(3, '1', 'Test', '75300b04b84309b9c0f7a8d8106ae0d5.png', '2021-07-28 14:49:00', '199.999995', 0, '1'),
(4, '3', 'TEST', '6d6be821961b7233eaeac6a791dc119d.png', '2021-07-28 15:36:00', '1000.00', 0, '1'),
(5, '12', 'Shipping Fee', 'aaa57a271b4fe7415e6f8452d0cbe500.png', '2021-09-30 22:10:42', '120', 1, '1'),
(6, '12', 'test', 'dc02ec5be306f0b5ae372ec4f5793f2c.jpg', '2021-08-25 22:42:00', '00000303023', 0, '1'),
(7, '9', NULL, 'f3d99a6a1587a20d2d897bc13da58648.jpg', '2021-08-25 23:19:37', NULL, 0, '1'),
(8, '4', NULL, '7fc149ed8fe738f108858d1f495bfa3e.jpg', '2021-08-25 23:22:42', NULL, 0, '1'),
(9, '12', 'Misc', 'a3c4d5baf5c5fdc839cf23c58b8adcbb.png', '2021-09-30 22:28:10', '100', 1, '1'),
(10, '11', 'test', NULL, '2021-09-30 22:48:00', '2423', 0, '1'),
(12, '11', '546', 'cd1702c2a05f836f1bb1b733811582c4.png', '2021-09-30 22:58:58', '64565', 1, '1'),
(14, '11', 'Test', 'ea4d143899c1d9be0ef20a245c2448cd.png', '2021-09-30 23:03:52', '20', 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `img` varchar(510) DEFAULT NULL,
  `name` varchar(64) DEFAULT NULL,
  `type_id` varchar(16) DEFAULT NULL,
  `description` varchar(128) DEFAULT NULL,
  `price` varchar(32) DEFAULT NULL,
  `qty` varchar(16) DEFAULT NULL,
  `type` varchar(16) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `visibility` varchar(11) DEFAULT NULL,
  `featured` int(2) DEFAULT NULL,
  `status` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `img`, `name`, `type_id`, `description`, `price`, `qty`, `type`, `date_added`, `visibility`, `featured`, `status`) VALUES
(1, '3808feda972c31891c1c9ab60fe0e6f8.jpg', 'Angel Figure (Female)', '1', 'A female angel in casual clothing.', '200', '9', 'NORMAL', '2021-07-22 00:42:08', '1', 2, '1'),
(2, '4ca225f151b79e909e574157fd58c318.jpg', 'Angel Figure (Male)', '1', 'A male angel in casual clothing. ', '200', '10', 'NORMAL', '2021-07-22 01:16:47', '1', NULL, '1'),
(3, 'c599b6db33a13adcdd1e5c0e0c48031d.jpg', 'Test', '1', 'Test', '250', '0', 'NORMAL', '2021-07-27 22:15:23', '0', 1, '1'),
(4, '27df0ec9579647df58cb58ae463d6c28.jpg', 'Test', '1', 'Test', '250', '15', 'NORMAL', '2021-07-27 22:34:43', '1', 3, '1'),
(5, NULL, 'test', '1', 'test', '3.6446', '21', 'NORMAL', '2021-08-28 20:19:11', '0', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `products_custom`
--

CREATE TABLE `products_custom` (
  `custom_id` int(11) NOT NULL,
  `description` varchar(2040) DEFAULT NULL,
  `type_id` varchar(11) DEFAULT NULL,
  `size` varchar(32) DEFAULT NULL,
  `img` varchar(510) DEFAULT NULL,
  `product_id` varchar(11) DEFAULT NULL,
  `status` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products_custom`
--

INSERT INTO `products_custom` (`custom_id`, `description`, `type_id`, `size`, `img`, `product_id`, `status`) VALUES
(1, 'Try', '1', '12cm', '41b6181ccbcc62466fc84377244795fe.jpg', '4', '1'),
(2, 'Tries', '1', '12cm', '5d03eedaca767f7bf76c079aabb02369.jpg/', '3', '1'),
(3, 'try', '1', '12', 'ce1f2ecea2f24c1d2ab5336b9db4643a.png/', NULL, '1'),
(4, 'try', '1', '12', 'a9c4cceac8b0c46d5aaecc6b31ce55d4.png/', NULL, '1'),
(5, 'tres', '1', '12', 'd3760832d75033f8583969791d78ed4d.png/', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `type_id` int(11) NOT NULL,
  `name` varchar(32) DEFAULT NULL,
  `img` varchar(64) DEFAULT NULL,
  `description` varchar(128) DEFAULT NULL,
  `price_range` varchar(32) DEFAULT NULL,
  `featured` varchar(11) DEFAULT NULL,
  `status` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`type_id`, `name`, `img`, `description`, `price_range`, `featured`, `status`) VALUES
(1, 'Figurine', 'c8b045fb04a5397356615cb5fe2488cf.jpg', 'Desc Figurine', '175.00 - 300.00', '1', '1'),
(2, 'Keychain', 'b2a41d69ed2733202a42fc2201374924.png', 'Desc Keychain', '80.00 - 150.00', '1', '1'),
(3, 'test', '3f097acaf2264b8479724b3c2aecc84d.jpg', 'try', '1235464', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

CREATE TABLE `user_accounts` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `name_last` varchar(32) DEFAULT NULL,
  `name_first` varchar(64) DEFAULT NULL,
  `name_middle` varchar(32) DEFAULT NULL,
  `name_extension` varchar(32) DEFAULT NULL,
  `zip_code` varchar(11) DEFAULT NULL,
  `country` varchar(64) DEFAULT NULL,
  `province` varchar(64) DEFAULT NULL,
  `city` varchar(64) DEFAULT NULL,
  `street` varchar(64) DEFAULT NULL,
  `address` varchar(64) DEFAULT NULL,
  `gender` varchar(32) DEFAULT NULL,
  `contact_num` varchar(32) DEFAULT NULL,
  `status` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_accounts`
--

INSERT INTO `user_accounts` (`user_id`, `email`, `password`, `name_last`, `name_first`, `name_middle`, `name_extension`, `zip_code`, `country`, `province`, `city`, `street`, `address`, `gender`, `contact_num`, `status`) VALUES
(1, 'jano@email.com', '$2y$10$asSRBESRalqhSJFBVFJxdevg6wxruzGGfpcQvVx9En8khpcs9HBTe', 'Jano', 'Ricky John', '', '', '1870', 'Philippines', 'Rizal', 'Antipolo', 'Rd', '828', 'female', '09123456789', '1'),
(2, 'tester@email.com', '$2y$10$b/uh6qZi.Td1QGR52aNCVuaLdTqPZN6OeqfNvcKfDj8AC.AGB2UPO', 'Test', 'Ter', '', '', '1234', 'Yes', 'No', 'Maybe', 'Idunno', '', 'male', '123456789', '1'),
(3, NULL, NULL, 'Jano', 'Ricky', '', '', '1234', 'Ctr', 'Prv', 'Ct', 'StRd', '', 'male', '123456789', '1'),
(4, NULL, NULL, 'Test', 'Try', '', '', '1234', 'Ctr', 'Pro', 'Cty', 'Strd', '', 'female', '123456789', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_accounts`
--
ALTER TABLE `admin_accounts`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`config_id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `orders_items`
--
ALTER TABLE `orders_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `orders_payments`
--
ALTER TABLE `orders_payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `products_custom`
--
ALTER TABLE `products_custom`
  ADD PRIMARY KEY (`custom_id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `user_accounts`
--
ALTER TABLE `user_accounts`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_accounts`
--
ALTER TABLE `admin_accounts`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `config_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders_items`
--
ALTER TABLE `orders_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders_payments`
--
ALTER TABLE `orders_payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products_custom`
--
ALTER TABLE `products_custom`
  MODIFY `custom_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_accounts`
--
ALTER TABLE `user_accounts`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
