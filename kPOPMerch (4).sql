-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 17, 2023 at 06:49 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kPOPMerch`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `confirm_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `phone`, `image`, `password`, `confirm_password`) VALUES
(2, 'Than Soe Aung', 'david@gmail.com', NULL, NULL, '$2y$10$CXkdddvzd3g94EgUofQaM.s4gP2ORjkcoSO0ha6cc7llrHxA2nUSS', '$2y$10$Aknrqhj9kcvifSJ08BRhn.TNK8CqndSmvxXGAaQ9LAiebUMio6DB.'),
(3, 'Than Soe Aung', 'thansoeaung@gmail.com', NULL, NULL, '$2y$10$8ypfizlloETn5iG2AHUsSODtUO5ZTosULONd8b5iZoNEGUSwIzRYS', '$2y$10$cs8l5UyREHwFLEFfy7LAaue.E7VyQuY44bUKnw9BFY.sS0lcdJ7pu'),
(7, 'David', 'thansoeaung5989@gmail.com', NULL, NULL, '$2y$10$k6TNhzmL/IDt4A8MozklXObfaM7fG3hCL0IZy7QmODGOwYm5YOCBq', '$2y$10$HO.uJuHkQ/X9xeXuL46yKu2wVyPF9CPTEzZKtgXL9Dm6TlzHZBdL2'),
(9, 'test', 'thansoeaung1213@gmail.com', NULL, NULL, '$2y$10$rUCkbGweORmabKflPViEnegPB9DCL.pgO0/P2r2rwCFyzwIl2fl3W', '$2y$10$wZmN8iN.5SVzDaZmqoUK1.nF/BjnoblUn6PEotLw2Vrd121MyNWYi'),
(15, 'test', 'maymyopwint825@gmail.com', NULL, NULL, '$2y$10$VI5.vmsCaGTCzb8zO6xE1O7PagaXnLLO0VZnwtoulvBw0Hc.c6Nje', '$2y$10$I75Rwa0G808GZ4R.RaMHCuA0arApiH.NHb.K70nnOvd3TdvSX0Jiy');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(5, 'aaa'),
(15, 'ssss');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `name`) VALUES
(1, 'Mandalay'),
(2, 'Yangon'),
(3, 'Magway');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `id` int(11) NOT NULL,
  `township_id` int(11) NOT NULL,
  `fee` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`id`, `township_id`, `fee`) VALUES
(3, 4, '1000'),
(4, 3, '2000'),
(5, 5, '1500'),
(6, 6, '2000'),
(7, 7, '2500'),
(8, 8, '2500'),
(9, 9, '2500'),
(10, 10, '3500'),
(21, 10, '3000'),
(23, 12, '3000'),
(24, 11, '3500'),
(25, 12, '3500');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `order_code` int(11) NOT NULL,
  `order_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `product_id`, `quantity`, `total_price`, `order_code`, `order_date`) VALUES
(39, 1, 11, 2, 200000, 43978, '2023-08-14'),
(40, 1, 12, 2, 40000, 43978, '2023-08-14'),
(41, 1, 11, 5, 500000, 43979, '2023-08-14'),
(42, 1, 11, 5, 500000, 43980, '2023-08-16'),
(43, 4, 12, 5, 100000, 80104, '2023-08-16'),
(44, 1, 11, 1, 100000, 98413, '2023-08-16'),
(45, 1, 11, 1, 100000, 81047, '2023-08-16'),
(46, 1, 11, 1, 100000, 49590, '2023-08-16'),
(47, 1, 11, 1, 100000, 27110, '2023-08-16'),
(48, 1, 11, 1, 100000, 7483, '2023-08-16'),
(49, 1, 12, 5, 100000, 18888, '2023-08-17'),
(50, 1, 12, 5, 100000, 7850, '2023-08-17'),
(51, 1, 12, 10, 200000, 39477, '2023-08-17'),
(52, 1, 11, 7, 700000, 66900, '2023-08-17');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_code` int(11) NOT NULL,
  `order_date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `user_id`, `order_code`, `order_date`, `status`) VALUES
(13, 1, 43978, '2023-08-14', 'pending'),
(14, 1, 43979, '2023-08-14', 'pending'),
(15, 1, 43980, '2023-08-16', 'pending'),
(16, 4, 80104, '2023-08-16', 'decline'),
(17, 1, 98413, '2023-08-16', 'pending'),
(18, 1, 81047, '2023-08-16', 'pending'),
(19, 1, 49590, '2023-08-16', 'pending'),
(20, 1, 27110, '2023-08-16', 'pending'),
(21, 1, 7483, '2023-08-16', 'pending'),
(22, 1, 18888, '2023-08-17', 'pending'),
(23, 1, 7850, '2023-08-17', 'pending'),
(24, 1, 39477, '2023-08-17', 'pending'),
(25, 1, 66900, '2023-08-17', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `version` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_date` date NOT NULL,
  `cat_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `version`, `description`, `created_date`, `cat_id`, `team_id`, `image`, `price`) VALUES
(11, 'Python', '', 'this is testing for product python', '2023-08-06', 5, 6, '1690970660Cheese.jpeg', 100000),
(12, 'David', '', 'sss', '2023-08-16', 15, 6, '1690970761Margherita Pizza.jpeg', 20000);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty_in` int(11) NOT NULL,
  `qty_out` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `product_id`, `qty_in`, `qty_out`) VALUES
(25, 15, 40, 0),
(26, 11, 30, 0);

-- --------------------------------------------------------

--
-- Table structure for table `stock_details`
--

CREATE TABLE `stock_details` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `buy_priceEach` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `stock_details`
--

INSERT INTO `stock_details` (`id`, `product_id`, `qty`, `buy_priceEach`, `date`) VALUES
(2, 1, '20', '100', '2023-08-08'),
(3, 4, '10', '100', '2023-08-07'),
(4, 51, '20', '150', '2023-08-07');

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `name`, `image`, `description`) VALUES
(6, 'test', '1691046237error.png', 'ggggg'),
(7, 'exo', '1691499223laravel.png', 'testing'),
(8, 'python', '1691499242iv6yws921.svg', 'testing'),
(9, 'David', '1691499280project-phases.png', 'aaaa'),
(10, 'than ', '1691499297Screenshot 2023-05-20 at 11.49.59.png', 'ssss');

-- --------------------------------------------------------

--
-- Table structure for table `team_product`
--

CREATE TABLE `team_product` (
  `id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `township`
--

CREATE TABLE `township` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `city_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `township`
--

INSERT INTO `township` (`id`, `name`, `city_id`) VALUES
(2, 'Chan Mya Thar Zi', 1),
(3, 'Chan Aye Thar Zan', 1),
(4, 'PyiGyiTaKon', 1),
(5, 'AungMyaeTharZan', 1),
(6, 'Kamaryut', 2),
(7, 'Sangyoung', 2),
(8, 'Mayangonn', 2),
(9, 'Alone', 2),
(10, 'Hlegu', 2),
(11, 'Hline', 2),
(12, 'Tarmwe', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `confirm_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `confirm_password`) VALUES
(1, 'Than Soe Aung', 'user@gmail.com', '$2y$10$Qsl9LHzqEmgjOo8CeKJKm..9N7xieF0nZyezEW3LgXXf2MQ4zhCPi', '$2y$10$Qsl9LHzqEmgjOo8CeKJKm..9N7xieF0nZyezEW3LgXXf2MQ4zhCPi'),
(4, 'test', 'thansoeaung1213@gmail.com', '$2y$10$Qsl9LHzqEmgjOo8CeKJKm..9N7xieF0nZyezEW3LgXXf2MQ4zhCPi', '$2y$10$ViknjCtPKhuCJe.vu6mIgu3VOAHZpPJ2XS2v/0XaMUqrPz6IwB/aC');

-- --------------------------------------------------------

--
-- Table structure for table `user_detail`
--

CREATE TABLE `user_detail` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `township_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `voucher_code`
--

CREATE TABLE `voucher_code` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `used_by_user` int(11) DEFAULT NULL,
  `created_at` date DEFAULT current_timestamp(),
  `used_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voucher_code`
--

INSERT INTO `voucher_code` (`id`, `code`, `used_by_user`, `created_at`, `used_at`) VALUES
(2, '2020213', 1, '2023-08-16', '2023-08-17'),
(3, '3201585', 1, '2023-08-16', '2023-08-17'),
(9, '666254', 1, '2023-08-16', '2023-08-17'),
(11, '656565', 1, '2023-08-17', '2023-08-17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `delivery_ibfk_1` (`township_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat_id` (`cat_id`),
  ADD KEY `team_id` (`team_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `stock_details`
--
ALTER TABLE `stock_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team_product`
--
ALTER TABLE `team_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `team_id` (`team_id`);

--
-- Indexes for table `township`
--
ALTER TABLE `township`
  ADD PRIMARY KEY (`id`),
  ADD KEY `township_ibfk_1` (`city_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_detail`
--
ALTER TABLE `user_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voucher_code`
--
ALTER TABLE `voucher_code`
  ADD PRIMARY KEY (`id`),
  ADD KEY `used_by_user` (`used_by_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `stock_details`
--
ALTER TABLE `stock_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `team_product`
--
ALTER TABLE `team_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `township`
--
ALTER TABLE `township`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_detail`
--
ALTER TABLE `user_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `voucher_code`
--
ALTER TABLE `voucher_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `delivery`
--
ALTER TABLE `delivery`
  ADD CONSTRAINT `delivery_ibfk_1` FOREIGN KEY (`township_id`) REFERENCES `township` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`);

--
-- Constraints for table `team_product`
--
ALTER TABLE `team_product`
  ADD CONSTRAINT `team_product_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `team_product_ibfk_2` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`);

--
-- Constraints for table `township`
--
ALTER TABLE `township`
  ADD CONSTRAINT `township_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`);

--
-- Constraints for table `voucher_code`
--
ALTER TABLE `voucher_code`
  ADD CONSTRAINT `voucher_code_ibfk_1` FOREIGN KEY (`used_by_user`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
