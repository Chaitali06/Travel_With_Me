-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 17, 2026 at 11:16 AM
-- Server version: 8.4.7
-- PHP Version: 8.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `traveldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

DROP TABLE IF EXISTS `about`;
CREATE TABLE IF NOT EXISTS `about` (
  `id` int NOT NULL AUTO_INCREMENT,
  `h5` varchar(255) DEFAULT NULL,
  `h2` varchar(255) DEFAULT NULL,
  `para` text,
  `img` varchar(255) DEFAULT NULL,
  `head1` varchar(255) DEFAULT NULL,
  `paragraph` text,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `h5`, `h2`, `para`, `img`, `head1`, `paragraph`, `date`) VALUES
(1, 'OUR STORY', 'We provide the best guidance', 'We started with a simple passion: to make travel accessible, enjoyable, and meaningful. Our team works hard to create itineraries that let you connect with local cultures and nature.', 'img/team-member1.jpg', 'John Doe', 'CEO & Founder', '2026-08-03'),
(2, '', '', '', 'img/team-member2.jpg', 'Jane Smith', 'Travel Agent Specialist', '2026-08-03'),
(3, '', '', '', 'img/team-member3.jpg', 'Mike Johnson', 'Tour Guide Manager', '2026-08-03');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int NOT NULL AUTO_INCREMENT,
  `h3` varchar(255) DEFAULT NULL,
  `info` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `h3`, `info`, `date`) VALUES
(1, 'Mobile Number', '+1 234 567 890', '2026-08-03'),
(2, 'Email Address', 'info@travelwithme.com', '2026-08-03'),
(3, 'Office Address', '123 Adventure Way, Jakarta, Indonesia', '2026-08-03');

-- --------------------------------------------------------

--
-- Table structure for table `culture`
--

DROP TABLE IF EXISTS `culture`;
CREATE TABLE IF NOT EXISTS `culture` (
  `id` int NOT NULL AUTO_INCREMENT,
  `h5` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `h2` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `para` text COLLATE utf8mb4_general_ci,
  `btn` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `img` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `culture`
--

INSERT INTO `culture` (`id`, `h5`, `h2`, `para`, `btn`, `img`, `date`) VALUES
(1, 'INDONESIAN CULTURE', 'Our culture here is very friendly to people', 'Indonesian culture is a colorful tapestry of diverse traditions, beliefs, arts, and cuisines. Across thousands of islands, you will find warm hospitality, smiling faces, and rich community celebrations that welcome visitors like family.', 'Read More', 'img/pic10.jpg', '2026-08-03');

-- --------------------------------------------------------

--
-- Table structure for table `feature`
--

DROP TABLE IF EXISTS `feature`;
CREATE TABLE IF NOT EXISTS `feature` (
  `id` int NOT NULL AUTO_INCREMENT,
  `img` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `h4` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feature`
--

INSERT INTO `feature` (`id`, `img`, `h4`, `date`) VALUES
(1, 'img/pic2.jpg', 'Ski Tours', '2026-08-03'),
(2, 'img/pic3.jpg', 'Desert Tours', '2026-08-03'),
(3, 'img/pic4.jpg', 'Beach Tours', '2026-08-03'),
(4, 'img/pic5.jpg', 'Mountain Tours', '2026-08-03'),
(5, 'img/WhatsApp Image 2026-02-19 at 22.49.11.jpeg', 'Mangrov', '2026-08-03');

-- --------------------------------------------------------

--
-- Table structure for table `holiday`
--

DROP TABLE IF EXISTS `holiday`;
CREATE TABLE IF NOT EXISTS `holiday` (
  `id` int NOT NULL AUTO_INCREMENT,
  `img` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `h5` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `h2` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `para` text COLLATE utf8mb4_general_ci,
  `btn` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `holiday`
--

INSERT INTO `holiday` (`id`, `img`, `h5`, `h2`, `para`, `btn`, `date`) VALUES
(1, 'img/pic6.jpg', 'EAST NUSA TENGGARA', 'Have You Enjoyed your Holidays?', 'Discover breathtaking landscapes, clean beaches, and unique wildlife in East Nusa Tenggara. Experience world-class hospitality, custom tour paths, and guided cultural tours designed for travelers seeking a deep adventure.', 'Read More', '2026-08-03');

-- --------------------------------------------------------

--
-- Table structure for table `home`
--

DROP TABLE IF EXISTS `home`;
CREATE TABLE IF NOT EXISTS `home` (
  `id` int NOT NULL AUTO_INCREMENT,
  `h5` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `h1` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `para` text COLLATE utf8mb4_general_ci,
  `btn` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `home`
--

INSERT INTO `home` (`id`, `h5`, `h1`, `para`, `btn`, `date`) VALUES
(1, 'LET\'S GO', 'Planning Your<br>Own Travel', 'Explore the world with us. We offer customized tour packages, guided trips, and exceptional services to make your holidays memorable and stress-free.', 'Book a Trip', '2026-08-03');

-- --------------------------------------------------------

--
-- Table structure for table `inquiries`
--

DROP TABLE IF EXISTS `inquiries`;
CREATE TABLE IF NOT EXISTS `inquiries` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL DEFAULT 'Inquiry',
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `tour_name` varchar(255) DEFAULT NULL,
  `travelers` int DEFAULT '1',
  `travel_date` varchar(50) DEFAULT NULL,
  `message` text,
  `status` varchar(50) NOT NULL DEFAULT 'New',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `inquiries`
--

INSERT INTO `inquiries` (`id`, `type`, `name`, `email`, `phone`, `tour_name`, `travelers`, `travel_date`, `message`, `status`, `created_at`) VALUES
(1, 'Tour Booking', 'Automated Tester 1792223266', 'tester_1792223266@example.com', '+1 555 987 6543', 'Alpine Discovery Tour', 2, '2026-12-25', 'Need luxury cabin', 'Confirmed', '2026-10-17 13:17:46'),
(2, 'Contact Message', 'Elena Rostova', 'elena@travelworld.com', '+1 555 777 8899', 'Corporate / Group Travel', 1, '', 'Looking for a private guided tour in the mountains for our honeymoon.', 'Confirmed', '2026-10-17 15:34:19'),
(3, 'Tour Booking', 'Marcus Vance', 'marcus@vance.org', '+15553334444', 'Mount Bromo', 2, '2026-11-20', 'Window seats and vegetarian breakfast please.', 'New', '2026-10-17 15:50:02');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `menu_parent` int DEFAULT '0',
  `menu_type` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `menu_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `menu_order` int DEFAULT '0',
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `menu_name`, `menu_parent`, `menu_type`, `menu_url`, `menu_order`, `date`) VALUES
(1, 'Home', 0, 'header', 'index.php', 1, '2026-08-03'),
(2, 'Services', 0, 'header', 'service.php', 2, '2026-08-03'),
(3, 'About Us', 0, 'header', 'about.php', 3, '2026-08-03'),
(4, 'Contact Us', 0, 'header', 'contact.php', 4, '2026-08-03');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

DROP TABLE IF EXISTS `service`;
CREATE TABLE IF NOT EXISTS `service` (
  `id` int NOT NULL AUTO_INCREMENT,
  `service_heading` varchar(255) DEFAULT NULL,
  `service_info` text,
  `img` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `service_desc` text,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `service_heading`, `service_info`, `img`, `title`, `service_desc`, `date`) VALUES
(1, 'What We Offer', 'Our services are designed to give you the ultimate travel experience from start to finish.', 'img/service1.jpg', 'Flight Booking', 'Compare and book flights to destinations around the world at the best rates.', '2026-08-03'),
(2, '', '', 'img/service2.jpg', 'Hotel Booking', 'Find luxury hotels, resorts, and budget-friendly stays curated for your comfort.', '2026-08-03'),
(3, '', '', 'img/service3.jpg', 'Travel Guides', 'Experience cultures with local certified guides showing you the sights.', '2026-08-03');

-- --------------------------------------------------------

--
-- Table structure for table `tour`
--

DROP TABLE IF EXISTS `tour`;
CREATE TABLE IF NOT EXISTS `tour` (
  `id` int NOT NULL AUTO_INCREMENT,
  `img` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `h6` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `h4` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `h2` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `btn` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tour`
--

INSERT INTO `tour` (`id`, `img`, `h6`, `h4`, `h2`, `btn`, `date`) VALUES
(1, 'img/pic7.jpg', 'East Java', 'Mount Bromo', 'Popular Tours', 'See Tours', '2026-08-03'),
(2, 'img/pic8.jpg', 'Bali', 'Ubud Temple', 'Popular Tours', 'See Tours', '2026-08-03'),
(3, 'img/pic9.jpg', 'Komodo Island', 'Pink Beach', 'Popular Tours', 'See Tours', '2026-08-03');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `pass` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user`, `pass`) VALUES
(1, 'admin', 'admin');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
