-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 21, 2019 at 01:35 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `UseItUp`
--

-- --------------------------------------------------------

--
-- Table structure for table `allergens`
--

CREATE TABLE `allergens` (
  `ID` int(11) NOT NULL,
  `Allergen` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `allergens_listings`
--

CREATE TABLE `allergens_listings` (
  `Allergen_ID` int(11) NOT NULL,
  `Listing_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `charities`
--

CREATE TABLE `charities` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Charity number` int(11) NOT NULL,
  `Street name` varchar(100) NOT NULL,
  `Building name/number` varchar(50) NOT NULL,
  `City` varchar(50) NOT NULL,
  `Postcode` varchar(50) NOT NULL,
  `Phone number` int(11) NOT NULL,
  `Email address` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `ID` int(11) NOT NULL,
  `Restaurant_ID` int(11) NOT NULL,
  `Charity_ID` int(11) NOT NULL,
  `Complaint` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `listings`
--

CREATE TABLE `listings` (
  `ID` int(11) NOT NULL,
  `Title` varchar(50) NOT NULL,
  `Description` varchar(300) NOT NULL,
  `Picture` blob NOT NULL,
  `Restaurant_ID` int(11) NOT NULL,
  `Expiry date` date NOT NULL,
  `Portions` int(11) NOT NULL,
  `Available times` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ID` int(11) NOT NULL,
  `Charity_ID` int(11) NOT NULL,
  `Order time` date NOT NULL,
  `Pickup time` date NOT NULL,
  `Comments` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders_listings`
--

CREATE TABLE `orders_listings` (
  `Order_ID` int(11) NOT NULL,
  `Listing_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Street name` varchar(100) NOT NULL,
  `Building name/number` int(11) NOT NULL,
  `Postcode` varchar(50) NOT NULL,
  `City` varchar(50) NOT NULL,
  `Phone number` int(11) NOT NULL,
  `Email address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allergens`
--
ALTER TABLE `allergens`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `allergens_listings`
--
ALTER TABLE `allergens_listings`
  ADD KEY `Allergen_ID` (`Allergen_ID`),
  ADD KEY `Listing_ID` (`Listing_ID`);

--
-- Indexes for table `charities`
--
ALTER TABLE `charities`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Charity_ID` (`Charity_ID`),
  ADD KEY `Restaurant_ID` (`Restaurant_ID`);

--
-- Indexes for table `listings`
--
ALTER TABLE `listings`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Restaurant_ID` (`Restaurant_ID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Charity_ID` (`Charity_ID`);

--
-- Indexes for table `orders_listings`
--
ALTER TABLE `orders_listings`
  ADD KEY `Listing_ID` (`Listing_ID`),
  ADD KEY `Order_ID` (`Order_ID`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `allergens_listings`
--
ALTER TABLE `allergens_listings`
  ADD CONSTRAINT `allergens_listings_ibfk_1` FOREIGN KEY (`Allergen_ID`) REFERENCES `allergens` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `allergens_listings_ibfk_2` FOREIGN KEY (`Listing_ID`) REFERENCES `listings` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `complaints`
--
ALTER TABLE `complaints`
  ADD CONSTRAINT `complaints_ibfk_1` FOREIGN KEY (`Charity_ID`) REFERENCES `charities` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `complaints_ibfk_2` FOREIGN KEY (`Restaurant_ID`) REFERENCES `restaurants` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `listings`
--
ALTER TABLE `listings`
  ADD CONSTRAINT `listings_ibfk_1` FOREIGN KEY (`Restaurant_ID`) REFERENCES `restaurants` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`Charity_ID`) REFERENCES `charities` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders_listings`
--
ALTER TABLE `orders_listings`
  ADD CONSTRAINT `orders_listings_ibfk_1` FOREIGN KEY (`Listing_ID`) REFERENCES `listings` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_listings_ibfk_2` FOREIGN KEY (`Order_ID`) REFERENCES `orders` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;