-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2022 at 05:42 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `malkab_db`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_available_facilities` (IN `o_facility_type` VARCHAR(50), IN `o_checkin_date` VARCHAR(50), IN `o_checkout_date` VARCHAR(50))   BEGIN
SELECT * FROM `facility` WHERE facility_type=o_facility_type AND NOT EXISTS (
SELECT facility_id FROM reservation WHERE reservation.facility_id=facility.facility_id AND checkout_date >= o_checkin_date AND checkin_date <= o_checkout_date
UNION ALL
SELECT facility_id FROM facility_sales WHERE facility_sales.facility_id=facility.facility_id AND checkout_date >= o_checkin_date AND checkin_date <= o_checkout_date
);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_customers` (IN `today_date` VARCHAR(50))   BEGIN
SELECT * FROM `facility_sales` NATURAL JOIN `customer` WHERE checkout_date >= today_date AND checkin_date <= today_date;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `todays_service_count` (IN `today_date` VARCHAR(50))   BEGIN
SELECT count(*) as amount, "Stadion Kanjuruhan Dalam" as type FROM reservation WHERE reservation_date=today_date AND facility_id=1 UNION ALL
SELECT count(*) as amount, "Stadion Kanjuruhan Luar" as type FROM reservation WHERE reservation_date=today_date AND facility_id=2 UNION ALL
SELECT count(*) as amount, "Stadion Kahuripan Dalam" as type FROM reservation WHERE reservation_date=today_date AND facility_id=3 UNION ALL
SELECT count(*) as amount, "Stadion Kahuripan Luar" as type FROM reservation WHERE reservation_date=today_date AND facility_id=4;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_firstname` varchar(50) NOT NULL,
  `customer_lastname` varchar(50) NOT NULL,
  `customer_telephone` varchar(50) NOT NULL,
  `customer_email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_firstname`, `customer_lastname`, `customer_telephone`, `customer_email`) VALUES
(1, 'Samantha', 'Miller', '09123564789', 'sam23@mail.com'),
(2, 'George', 'Wilson', '09654789123', 'gwilson@mail.com'),
(3, 'Test', 'Test', '09123564789', 'test@mail.com');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL,
  `employee_username` varchar(50) NOT NULL,
  `employee_password` varchar(50) CHARACTER SET utf32 NOT NULL,
  `employee_firstname` varchar(50) NOT NULL,
  `employee_lastname` varchar(50) NOT NULL,
  `employee_telephone` varchar(50) DEFAULT NULL,
  `employee_email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `employee_username`, `employee_password`, `employee_firstname`, `employee_lastname`, `employee_telephone`, `employee_email`) VALUES
(1, 'admin', 'admin123', 'John', 'Smith', '09123654789', 'jsmith@mail.com'),
(2, 'gforeman', 'gforeman123', 'Gregory', 'Foreman', '09321485987', 'gforeman@mail.com');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `customer_id` int(11) NOT NULL,
  `facility_id` int(11) NOT NULL,
  `checkin_date` varchar(50) NOT NULL,
  `checkout_date` varchar(50) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `reservation_date` varchar(50) DEFAULT NULL,
  `reservation_price` float DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`customer_id`, `facility_id`, `checkin_date`, `checkout_date`, `employee_id`, `reservation_date`, `reservation_price`, `status`) VALUES
(1, 1, '2022-06-29', '2022-07-04', 1, NULL, NULL, NULL),
(2, 3, '2022-07-04', '2022-07-08', 1, NULL, NULL, NULL),
(3, 2, '2022-06-26', '2022-07-09', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `facility`
--

CREATE TABLE `facility` (
  `facility_id` int(11) NOT NULL,
  `facility_type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `facility`
--

INSERT INTO `facility` (`facility_id`, `facility_type`) VALUES
(1, 'Stadion Kanjuruhan Dalam'),
(2, 'Stadion Kanjuruhan Luar'),
(3, 'Stadion Kahuripan Dalam'),
(4, 'Stadion Kahuripan Luar');

--
-- Triggers `facility`
--
DELIMITER $$
CREATE TRIGGER `after_insert_facility` AFTER INSERT ON `facility` FOR EACH ROW BEGIN
    UPDATE facility_type SET facility_type.facility_quantity =facility_type.facility_quantity + 1 WHERE facility_type.facility_type = NEW.facility_type;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_delete_facility` BEFORE DELETE ON `facility` FOR EACH ROW BEGIN
    UPDATE facility_type SET facility_type.facility_quantity =facility_type.facility_quantity - 1 WHERE facility_type.facility_type = OLD.facility_type;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `facility_sales`
--

CREATE TABLE `facility_sales` (
  `customer_id` int(11) NOT NULL,
  `facility_id` int(11) NOT NULL,
  `checkin_date` varchar(50) NOT NULL,
  `checkout_date` varchar(50) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `facility_sales_price` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `facility_sales`
--

INSERT INTO `facility_sales` (`customer_id`, `facility_id`, `checkin_date`, `checkout_date`, `employee_id`, `facility_sales_price`) VALUES
(1, 1, '2022-06-29', '2022-07-04', 1, 1000000),
(2, 3, '2022-07-04', '2022-07-08', 1, 1000000),
(3, 2, '2022-06-29', '2022-07-09', 1, 1000000);

-- --------------------------------------------------------

--
-- Table structure for table `facility_type`
--

CREATE TABLE `facility_type` (
  `facility_type` varchar(50) NOT NULL,
  `facility_price` int(11) DEFAULT NULL,
  `facility_details` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `facility_type`
--

INSERT INTO `facility_type` (`facility_type`, `facility_price`, `facility_details`) VALUES
('Stadion Kanjuruhan Dalam', 1000000, 'Lapangan Dalam Stadion Kanjuruhan'),
('Stadion Kanjuruhan Luar', 1000000, 'Lapangan Luar Stadion Kanjuruhan'),
('Stadion Kahuripan Dalam', 1000000, 'Lapangan Dalam Stadion Kahuripan'),
('Stadion Kahuripan Luar', 1000000, 'Lapangan Luar Stadion Kahuripan');

-- --------------------------------------------------------

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`),
  ADD UNIQUE KEY `username` (`employee_username`),
  ADD UNIQUE KEY `email` (`employee_email`)
  ADD KEY `login` (`employee_username`,`employee_password`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`customer_id`,`facility_id`,`checkin_date`),
  ADD KEY `customer` (`customer_id`),
  ADD KEY `employee` (`employee_id`),
  ADD KEY `facility` (`facility_id`),
  ADD KEY `availability` (`facility_id`,`checkin_date`,`checkout_date`);

--
-- Indexes for table `facility`
--
ALTER TABLE `facility`
  ADD PRIMARY KEY (`facility_id`),
  ADD KEY `facility_type` (`facility_type`);

--
-- Indexes for table `facility_sales`
--
ALTER TABLE `facility_sales`
  ADD PRIMARY KEY (`customer_id`,`facility_id`,`checkin_date`),
  ADD KEY `customer` (`customer_id`),
  ADD KEY `employee` (`employee_id`),
  ADD KEY `facility` (`facility_id`),
  ADD KEY `availability` (`facility_id`,`checkin_date`,`checkout_date`);

--
-- Indexes for table `facility_type`
--
ALTER TABLE `facility_type`
  ADD PRIMARY KEY (`facility_type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `facility`
--
ALTER TABLE `facility`
  MODIFY `facility_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`facility_id`) REFERENCES `facility` (`facility_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservation_ibfk_3` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- Constraints for table `facility`
--
ALTER TABLE `facility`
  ADD CONSTRAINT `facility_ibfk_1` FOREIGN KEY (`facility_type`) REFERENCES `facility_type` (`facility_type`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `facility_sales`
--
ALTER TABLE `facility_sales`
  ADD CONSTRAINT `facility_sales_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `facility_sales_ibfk_2` FOREIGN KEY (`facility_id`) REFERENCES `facility` (`facility_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `facility_sales_ibfk_3` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
