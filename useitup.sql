-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 18, 2019 at 01:46 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.10
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE USER 'useitup'@'localhost';GRANT USAGE ON *.* TO 'useitup'@'localhost'
REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;

--
-- Database: `useitup`
--

CREATE DATABASE useitup;

GRANT ALL PRIVILEGES ON `useitup`.* TO 'useitup'@'localhost' WITH GRANT OPTION;

USE useitup;

--
-- Table structure for table `allergens`
--

CREATE TABLE `allergens` (
  `id` int(11) NOT NULL,
  `allergen` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `allergens`
--

INSERT INTO `allergens` (`id`, `allergen`) VALUES
(1, 'gluten'),
(2, 'peanut'),
(3, 'egg'),
(4, 'soybean'),
(5, 'celery'),
(6, 'mustard'),
(7, 'sesame'),
(8, 'shellfish'),
(9, 'milk');

-- --------------------------------------------------------

--
-- Table structure for table `allergen_listings`
--

CREATE TABLE `allergen_listings` (
  `listing_id` int(11) NOT NULL,
  `allergen_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `allergen_listings`
--

INSERT INTO `allergen_listings` (`listing_id`, `allergen_id`) VALUES
(18, 1),
(17, 1),
(19, 1),
(19, 6),
(19, 9),
(5, 1),
(5, 6),
(7, 1),
(6, 1),
(14, 3),
(14, 1),
(14, 9),
(14, 6),
(9, 9),
(12, 3),
(12, 1),
(10, 9),
(10, 6),
(13, 3),
(13, 1),
(13, 9),
(15, 3),
(15, 1),
(16, 1),
(16, 9),
(11, 5),
(11, 3),
(11, 1),
(11, 9),
(4, 4),
(4, 5),
(4, 7),
(4, 2),
(22, 3),
(24, 1),
(24, 3),
(24, 9);

-- --------------------------------------------------------

--
-- Table structure for table `charities`
--

CREATE TABLE `charities` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `postcode` varchar(10) NOT NULL,
  `charity_number` int(11) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `charities`
--

INSERT INTO `charities` (`id`, `name`, `email`, `phone`, `address`, `postcode`, `charity_number`, `password`) VALUES
(1, 'Food For Good', 'info@foodforgood.com', '07666555656', '12 Food Square, London', 'S98JK0', 8383882, '4d77f2c522df82094133e8a8a98edc04'),
(2, 'Hungry Hippos', 'hungry@hippos.com', '07988765432', '67 Hippopotamus Street, London', 'WC198JM', 923847, '4d77f2c522df82094133e8a8a98edc04'),
(3, 'Mother Teresa', 'teresa@vatican.org', '07111110922', '1 Vatican Place, London', 'WCI98JM', 2384734, '4d77f2c522df82094133e8a8a98edc04'),
(4, 'The Jeremy Bentham Foundation', 'jeremy@bentham.com', '07234762348', '99 Bentham Street, London', 'OE993N2', 478321, '4d77f2c522df82094133e8a8a98edc04'),
(5, 'Zero Food Waste', '0foodwaste@gmail.com', '07888888763', '0 Food Street, London', 'CD27DJ0', 329847, '4d77f2c522df82094133e8a8a98edc04'),
(6, 'Your Local Food Bank', 'your-local@foodbank.org', '02054663783', '36 Bank Road, London', 'EC92M9H', 745839, '4d77f2c522df82094133e8a8a98edc04'),
(7, 'The Soup For Life Foundation', 'soup4life@soup.com', '07111212323', '20 Soup Lane, London', 'EC19NUK', 8392983, '4d77f2c522df82094133e8a8a98edc04');

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `complaint` text NOT NULL,
  `user_type` enum('restaurant','charity') NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`id`, `subject`, `complaint`, `user_type`, `user_id`) VALUES
(2, 'Order #18', 'There was a mistake in the banana', 'restaurant', 0);

-- --------------------------------------------------------

--
-- Table structure for table `diets`
--

CREATE TABLE `diets` (
  `id` int(11) NOT NULL,
  `diet` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `diets`
--

INSERT INTO `diets` (`id`, `diet`) VALUES
(1, 'halal'),
(2, 'kosher'),
(3, 'vegetarian'),
(4, 'vegan');

-- --------------------------------------------------------

--
-- Table structure for table `diet_listings`
--

CREATE TABLE `diet_listings` (
  `listing_id` int(11) NOT NULL,
  `diet_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `diet_listings`
--

INSERT INTO `diet_listings` (`listing_id`, `diet_id`) VALUES
(8, 1),
(8, 2),
(8, 4),
(8, 3),
(20, 1),
(20, 2),
(20, 4),
(20, 3),
(1, 1),
(1, 2),
(1, 4),
(1, 3),
(2, 1),
(2, 2),
(2, 4),
(2, 3),
(18, 1),
(18, 2),
(17, 1),
(17, 2),
(7, 1),
(7, 4),
(7, 3),
(6, 1),
(6, 4),
(6, 3),
(9, 3),
(12, 1),
(12, 2),
(12, 3),
(10, 3),
(13, 3),
(16, 3),
(16, 1),
(16, 2),
(11, 1),
(11, 2),
(11, 4),
(11, 3),
(4, 1),
(4, 2),
(4, 4),
(4, 3),
(22, 3),
(24, 1),
(24, 2),
(24, 3);

-- --------------------------------------------------------

--
-- Table structure for table `listings`
--

CREATE TABLE `listings` (
  `id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `portions` int(11) NOT NULL,
  `time_from` time NOT NULL,
  `time_until` time NOT NULL,
  `day_posted` date NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL DEFAULT 'uploads/dish.png',
  `saved` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `listings`
--

INSERT INTO `listings` (`id`, `title`, `description`, `portions`, `time_from`, `time_until`, `day_posted`, `restaurant_id`, `image`, `saved`) VALUES
(1, 'Banana sandwich', 'Two slices of bread and one whole unpeeled banana.', 50, '09:00:00', '23:59:00', '2019-03-31', 1, 'uploads/1', 1),
(2, 'Banana soup', 'It\'s warm water with pieces of banana floating.', 30, '09:00:00', '23:59:00', CURDATE(), 1, 'uploads/2', 1),
(3, 'Banana stew', 'Beef and banana in our special banana sauce.', 55, '09:00:00', '23:59:00', CURDATE(), 1, 'uploads/3', 1),
(4, 'Vegan burger', 'One raw mushroom between two slices of bread.', 67, '09:30:00', '23:30:00', CURDATE(), 7, 'uploads/4', 1),
(5, 'Double burger with extra bacon', 'An entire cow and an entire pig in a burger.', 80, '09:30:00', '23:30:00', CURDATE(), 7, 'uploads/5', 1),
(6, 'Falafel Sandwich (small)', '3 falafels.', 66, '09:00:00', '20:30:00', CURDATE(), 4, 'uploads/6', 1),
(7, 'Falafel sandwich (large)', '23 falafels.', 90, '09:00:00', '20:30:00', CURDATE(), 4, 'uploads/7', 1),
(8, 'A glass of ketchup', 'Our homemade ketchup in a disposable plastic cup.', 30, '11:00:00', '23:00:00', CURDATE(), 6, 'uploads/8', 1),
(9, 'Ketchup ice cream', 'Our signature ketchup ice cream.', 45, '11:00:00', '23:00:00', CURDATE(), 6, 'uploads/9', 1),
(10, 'Mustard ice cream', 'Our signature ketchup ice cream with a twist.', 56, '11:00:00', '23:00:00', CURDATE(), 6, 'uploads/10', 1),
(11, 'Spinach pancake', 'Delicious and vegan.', 87, '10:00:00', '23:00:00', CURDATE(), 2, 'uploads/11', 1),
(12, 'Lentils pancake', 'Delicious and vegan.', 89, '10:00:00', '23:00:00', CURDATE(), 2, 'uploads/12', 1),
(13, 'Pancake milkshake', 'Pancakes blended with vanilla ice cream.', 65, '10:00:00', '23:00:00', CURDATE(), 2, 'uploads/13', 1),
(14, 'Hot dog pancake', 'A traditional hot dog with pancake instead of the bun.', 45, '10:00:00', '23:00:00', CURDATE(), 2, 'uploads/14', 1),
(15, 'Pepperoni pizza', '', 76, '11:00:00', '23:00:00', CURDATE(), 5, 'uploads/dish.png', 1),
(16, 'Pizza Margherita', '', 30, '11:00:00', '23:00:00', CURDATE(), 5, 'uploads/dish.png', 1),
(17, 'Caesar salad (small)', '', 30, '08:00:00', '22:00:00', CURDATE(), 3, 'uploads/17', 1),
(18, 'Caesar salad (large)', '', 40, '08:00:00', '22:00:00', CURDATE(), 3, 'uploads/18', 1),
(19, 'Cheeseburger salad', 'A salad with a side of cheeseburger.', 20, '08:00:00', '22:00:00', CURDATE(), 3, 'uploads/19', 1),
(20, 'Banana salad', 'Chopped bananas tossed in our signature vinaigrette.', 21, '08:00:00', '22:00:00', CURDATE(), 3, 'uploads/20', 1),
(22, 'Banana omelet', 'Eggs and bananas', 344, '09:00:00', '23:59:00', CURDATE(), 1, 'uploads/22', 1),
(24, 'Vegetarian lasagna', 'Tomato and roast pepper lasagna.', 55, '12:00:00', '23:00:00', CURDATE(), 9, 'uploads/24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `charity_id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `pickup_time` time NOT NULL,
  `comments` text NOT NULL,
  `picked_up` tinyint(1) NOT NULL DEFAULT '1',
  `pickup_day` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_listings`
--

CREATE TABLE `order_listings` (
  `order_id` int(11) NOT NULL,
  `listing_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `postcode` varchar(10) NOT NULL,
  `password` varchar(100) NOT NULL,
  `monday_from` time DEFAULT NULL,
  `monday_until` time DEFAULT NULL,
  `tuesday_from` time DEFAULT NULL,
  `tuesday_until` time DEFAULT NULL,
  `wednesday_from` time DEFAULT NULL,
  `wednesday_until` time DEFAULT NULL,
  `thursday_from` time DEFAULT NULL,
  `thursday_until` time DEFAULT NULL,
  `friday_from` time DEFAULT NULL,
  `friday_until` time DEFAULT NULL,
  `saturday_from` time DEFAULT NULL,
  `saturday_until` time DEFAULT NULL,
  `sunday_from` time DEFAULT NULL,
  `sunday_until` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`id`, `name`, `phone`, `email`, `address`, `postcode`, `password`, `monday_from`, `monday_until`, `tuesday_from`, `tuesday_until`, `wednesday_from`, `wednesday_until`, `thursday_from`, `thursday_until`, `friday_from`, `friday_until`, `saturday_from`, `saturday_until`, `sunday_from`, `sunday_until`) VALUES
(1, 'Banana Land', '07123234488', 'banana@land.com', '67 Banana Street, London', 'WT8PJJX', '4d77f2c522df82094133e8a8a98edc04', '09:00:00', '23:59:00', '09:00:00', '23:59:00', '09:00:00', '23:59:00', '09:00:00', '23:59:00', '09:00:00', '23:59:00', '09:00:00', '23:59:00', '09:00:00', '23:59:00'),
(2, 'Pancake Palace', '07348765098', 'pancake@palace.com', '89 Pancake Street, London', 'NU9HC33', '4d77f2c522df82094133e8a8a98edc04', '10:00:00', '23:00:00', '10:00:00', '23:00:00', '10:00:00', '23:00:00', '10:00:00', '23:00:00', '10:00:00', '23:00:00', '10:00:00', '23:00:00', '10:00:00', '23:00:00'),
(3, 'Salad Mania', '07444459008', 'salad@mania.com', '22 Salad Street, London', 'J98EH28', '4d77f2c522df82094133e8a8a98edc04', '08:00:00', '22:00:00', '08:00:00', '22:00:00', '08:00:00', '22:00:00', '08:00:00', '22:00:00', '08:00:00', '22:00:00', '08:00:00', '22:00:00', '08:00:00', '22:00:00'),
(4, 'Falafel Fiesta', '07645537281', 'falafel@fiesta.com', '66 Falafel Street, London', 'HDS2J99', '4d77f2c522df82094133e8a8a98edc04', '09:00:00', '20:30:00', '09:00:00', '20:30:00', '09:00:00', '20:30:00', '09:00:00', '20:30:00', '09:00:00', '20:30:00', '09:00:00', '20:30:00', '09:00:00', '20:30:00'),
(5, 'Pizza Emporium', '07555536287', 'pizza@emporium.com', '21 Pizza Street, London', 'JD02JD8S', '4d77f2c522df82094133e8a8a98edc04', '11:00:00', '23:00:00', '11:00:00', '23:00:00', '11:00:00', '23:00:00', '11:00:00', '23:00:00', '11:00:00', '23:00:00', '11:00:00', '23:00:00', '11:00:00', '23:00:00'),
(6, 'Ketchup Pool', '02056778976', 'ketchup@pool.com', '722 Ketchup Lane, London', 'HE29IJ9', '4d77f2c522df82094133e8a8a98edc04', '11:00:00', '23:00:00', '11:00:00', '23:00:00', '11:00:00', '23:00:00', '11:00:00', '23:00:00', '11:00:00', '23:00:00', '11:00:00', '23:00:00', '11:00:00', '23:00:00'),
(7, 'Burger Bistro', '02073324563', 'burger@bistro.com', '90 Burger Avenue, London', 'PO329CN', '4d77f2c522df82094133e8a8a98edc04', '09:30:00', '23:30:00', '09:30:00', '23:30:00', '09:30:00', '23:30:00', '09:30:00', '23:30:00', '09:30:00', '23:30:00', '09:30:00', '23:30:00', '09:30:00', '23:30:00'),
(9, 'Print Room Café', '02076792147', 'printroom@ucl.ac.uk', '136 Gower Street, London', 'WC1E 6BT', '4d77f2c522df82094133e8a8a98edc04', '12:00:00', '23:00:00', '12:00:00', '23:00:00', '12:00:00', '23:00:00', '12:00:00', '23:00:00', '12:00:00', '23:00:00', '12:00:00', '23:00:00', '12:00:00', '23:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allergens`
--
ALTER TABLE `allergens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `allergen_listings`
--
ALTER TABLE `allergen_listings`
  ADD KEY `allergen_id` (`allergen_id`),
  ADD KEY `listing_id` (`listing_id`);

--
-- Indexes for table `charities`
--
ALTER TABLE `charities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diets`
--
ALTER TABLE `diets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diet_listings`
--
ALTER TABLE `diet_listings`
  ADD KEY `diet_id` (`diet_id`),
  ADD KEY `listing_id` (`listing_id`);

--
-- Indexes for table `listings`
--
ALTER TABLE `listings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant_id` (`restaurant_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant_id` (`restaurant_id`),
  ADD KEY `charity_id` (`charity_id`);

--
-- Indexes for table `order_listings`
--
ALTER TABLE `order_listings`
  ADD KEY `listing_id` (`listing_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allergens`
--
ALTER TABLE `allergens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `charities`
--
ALTER TABLE `charities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `diets`
--
ALTER TABLE `diets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `listings`
--
ALTER TABLE `listings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `allergen_listings`
--
ALTER TABLE `allergen_listings`
  ADD CONSTRAINT `allergen_listings_ibfk_2` FOREIGN KEY (`listing_id`) REFERENCES `listings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `allergen_listings_ibfk_3` FOREIGN KEY (`allergen_id`) REFERENCES `allergens` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `diet_listings`
--
ALTER TABLE `diet_listings`
  ADD CONSTRAINT `diet_listings_ibfk_1` FOREIGN KEY (`diet_id`) REFERENCES `diets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `diet_listings_ibfk_2` FOREIGN KEY (`listing_id`) REFERENCES `listings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `listings`
--
ALTER TABLE `listings`
  ADD CONSTRAINT `listings_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`charity_id`) REFERENCES `charities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_listings`
--
ALTER TABLE `order_listings`
  ADD CONSTRAINT `order_listings_ibfk_1` FOREIGN KEY (`listing_id`) REFERENCES `listings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_listings_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

