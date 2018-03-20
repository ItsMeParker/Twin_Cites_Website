-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u8
-- http://www.phpmyadmin.net
--
-- Host: mysql5
-- Generation Time: Mar 06, 2018 at 06:19 PM
-- Server version: 5.5.59
-- PHP Version: 5.4.45-0+deb7u12

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fet15021296`
--

-- --------------------------------------------------------

--
-- Table structure for table `attraction_categories`
--

CREATE TABLE IF NOT EXISTS `attraction_categories` (
  `venue_category` int(11) NOT NULL,
  `local_attraction` int(11) NOT NULL,
  PRIMARY KEY (`venue_category`,`local_attraction`),
  KEY `fk_attraction_categories_Venue_category1_idx` (`venue_category`),
  KEY `fk_attraction_categories_local_attractions1_idx` (`local_attraction`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attraction_categories`
--

INSERT INTO `attraction_categories` (`venue_category`, `local_attraction`) VALUES
(1, 101),
(1, 102),
(1, 103),
(1, 104),
(1, 105),
(1, 106),
(1, 107),
(1, 108),
(1, 109),
(1, 110),
(1, 111),
(1, 112),
(1, 113),
(1, 114),
(1, 115),
(1, 116),
(1, 117),
(1, 118),
(1, 119),
(1, 120),
(1, 121),
(1, 122),
(1, 123),
(1, 124),
(1, 125),
(1, 126),
(1, 127),
(1, 128),
(1, 129),
(1, 130),
(1, 131),
(1, 132),
(1, 133),
(1, 134),
(1, 135),
(1, 136),
(1, 137),
(1, 138),
(1, 139),
(1, 140),
(2, 101),
(2, 102),
(2, 110),
(2, 121),
(2, 128),
(2, 140),
(3, 102),
(3, 105),
(3, 107),
(3, 132),
(3, 137),
(4, 102),
(4, 105),
(4, 107),
(4, 122),
(4, 129),
(4, 132),
(4, 135),
(4, 137),
(5, 101),
(5, 102),
(5, 103),
(5, 104),
(5, 105),
(5, 106),
(5, 107),
(5, 108),
(5, 109),
(5, 110),
(5, 111),
(5, 112),
(5, 113),
(5, 114),
(5, 115),
(5, 116),
(5, 117),
(5, 118),
(5, 119),
(5, 120),
(5, 121),
(5, 122),
(5, 123),
(5, 124),
(5, 125),
(5, 126),
(5, 127),
(5, 128),
(5, 129),
(5, 130),
(5, 131),
(5, 132),
(5, 133),
(5, 134),
(5, 135),
(5, 136),
(5, 137),
(5, 138),
(5, 139),
(5, 140),
(8, 117),
(9, 117),
(10, 104),
(10, 106),
(10, 109),
(10, 112),
(10, 114),
(10, 116),
(10, 117),
(10, 119),
(10, 120),
(10, 122),
(10, 125),
(10, 127),
(10, 129),
(10, 131),
(10, 133),
(10, 134),
(10, 135),
(11, 136),
(14, 109),
(14, 112),
(14, 114),
(14, 116),
(14, 133),
(15, 104),
(15, 106),
(15, 109),
(15, 134),
(17, 109),
(20, 103),
(20, 126),
(20, 130),
(21, 103),
(21, 115),
(21, 126),
(21, 130),
(22, 103),
(22, 115),
(22, 118),
(22, 126),
(22, 130),
(23, 105),
(24, 113),
(25, 113),
(25, 119),
(25, 123),
(25, 124),
(25, 127),
(25, 131),
(26, 118),
(27, 120),
(28, 121),
(29, 122),
(29, 129),
(29, 135),
(30, 122),
(30, 129),
(30, 135),
(31, 123),
(32, 124),
(33, 125),
(34, 131),
(35, 138);

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `city_id` int(11) NOT NULL AUTO_INCREMENT,
  `city_name` varchar(120) NOT NULL,
  `geocode_latitude` decimal(9,6) NOT NULL,
  `geocode_longitude` decimal(9,6) NOT NULL,
  `country` int(11) NOT NULL,
  `woeid` int(11) NOT NULL,
  `county_state` varchar(20) NOT NULL,
  `population` int(11) NOT NULL,
  `area` int(11) NOT NULL,
  `currency` varchar(10) NOT NULL,
  `primary_language` varchar(15) NOT NULL,
  `wiki_link` varchar(120) NOT NULL,
  PRIMARY KEY (`city_id`),
  KEY `fk_City_Country_idx` (`country`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `city_name`, `geocode_latitude`, `geocode_longitude`, `country`, `woeid`, `county_state`, `population`, `area`, `currency`, `primary_language`, `wiki_link`) VALUES
(1, 'Leicester', 52.636959, -1.129040, 1, 26062, 'Leicestershire', 329839, 28, 'Pounds', 'English', 'https://en.wikipedia.org/wiki/Leicester'),
(2, 'Strasbourg', 48.570930, 7.757880, 2, 627791, 'Bas-Rhin', 276170, 78, 'Euro', 'French', 'https://en.wikipedia.org/wiki/Strasbourg');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_name` varchar(45) NOT NULL,
  `population` int(11) NOT NULL,
  `national_language` varchar(20) NOT NULL,
  `gdp` int(11) NOT NULL,
  `wiki_link` varchar(120) NOT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `country_name`, `population`, `national_language`, `gdp`, `wiki_link`) VALUES
(1, 'United Kingdom', 65640000, 'English', 2147483647, 'www.wikipedia.com/UnitedKingdom'),
(2, 'Franch', 67201000, 'French', 2147483647, 'https://en.wikipedia.org/wiki/France');

-- --------------------------------------------------------

--
-- Table structure for table `forecast`
--

CREATE TABLE IF NOT EXISTS `forecast` (
  `date_offset` int(11) NOT NULL,
  `weather_code` int(11) NOT NULL,
  `temp_high` int(11) NOT NULL,
  `temp_low` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  PRIMARY KEY (`date_offset`,`city_id`),
  KEY `fk_forecast_weather_codes1_idx` (`weather_code`),
  KEY `fk_forecast_City1_idx` (`city_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forecast`
--

INSERT INTO `forecast` (`date_offset`, `weather_code`, `temp_high`, `temp_low`, `city_id`) VALUES
(0, 12, 46, 37, 1),
(0, 39, 51, 34, 2),
(1, 28, 47, 34, 1),
(1, 39, 49, 41, 2),
(2, 30, 45, 35, 1),
(2, 28, 51, 38, 2),
(3, 39, 46, 33, 1),
(3, 12, 54, 44, 2),
(4, 12, 47, 40, 1),
(4, 39, 56, 49, 2),
(5, 26, 49, 41, 1),
(5, 39, 56, 45, 2),
(6, 39, 46, 40, 1),
(6, 39, 54, 46, 2),
(7, 23, 46, 38, 1),
(7, 12, 50, 42, 2),
(8, 28, 45, 37, 1),
(8, 12, 54, 43, 2),
(9, 23, 44, 39, 1),
(9, 23, 55, 45, 2);

-- --------------------------------------------------------

--
-- Table structure for table `local_attractions`
--

CREATE TABLE IF NOT EXISTS `local_attractions` (
  `local_attractions_id` int(11) NOT NULL AUTO_INCREMENT,
  `city` int(11) NOT NULL,
  `attraction_name` varchar(45) NOT NULL,
  `geocode_latitude` decimal(9,6) NOT NULL,
  `geocode_longitude` decimal(9,6) NOT NULL,
  `website` varchar(100) NOT NULL,
  `rating` decimal(2,1) NOT NULL,
  PRIMARY KEY (`local_attractions_id`),
  KEY `fk_local_attractions_City1_idx` (`city`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=141 ;

--
-- Dumping data for table `local_attractions`
--

INSERT INTO `local_attractions` (`local_attractions_id`, `city`, `attraction_name`, `geocode_latitude`, `geocode_longitude`, `website`, `rating`) VALUES
(101, 1, 'Ramada Encore Leicester City Centre', 52.634667, -1.129265, 'https://www.google.co.uk/search?q=Ramada+Encore+Leicester+City+Centre', 4.0),
(102, 1, 'Mercure Leicester The Grand Hotel', 52.633197, -1.129889, 'https://www.google.co.uk/search?q=Mercure+Leicester+The+Grand+Hotel', 3.9),
(103, 1, 'Nationwide', 52.634217, -1.132492, 'https://www.google.co.uk/search?q=Nationwide', 2.4),
(104, 1, 'Clarks', 52.636213, -1.132669, 'https://www.google.co.uk/search?q=Clarks', 4.0),
(105, 1, 'Cafe Roma', 52.634561, -1.130582, 'https://www.google.co.uk/search?q=Cafe+Roma', 4.6),
(106, 1, 'Shoe Zone', 52.634842, -1.133879, 'https://www.google.co.uk/search?q=Shoe+Zone', 3.5),
(107, 1, 'Subway', 52.636273, -1.129227, 'https://www.google.co.uk/search?q=Subway', 3.3),
(108, 1, 'The City Rooms', 52.633750, -1.134150, 'https://www.google.co.uk/search?q=The+City+Rooms', 4.4),
(109, 1, 'Sports Direct', 52.636211, -1.132487, 'https://www.google.co.uk/search?q=Sports+Direct', 4.0),
(110, 1, 'The Hyde Apartments', 52.635125, -1.126161, 'https://www.google.co.uk/search?q=The+Hyde+Apartments', 5.0),
(111, 1, 'Pearson Professional Centres - UK Leicester', 52.635459, -1.128278, 'https://www.google.co.uk/search?q=Pearson+Professional+Centres+-+UK+Leicester', 3.1),
(112, 1, 'Primark', 52.636642, -1.130773, 'https://www.google.co.uk/search?q=Primark', 3.9),
(113, 1, 'The Dental Suite', 52.633603, -1.129743, 'https://www.google.co.uk/search?q=The+Dental+Suite', 4.2),
(114, 1, 'Ann Summers', 52.636400, -1.131804, 'https://www.google.co.uk/search?q=Ann+Summers', 3.3),
(115, 1, 'Coventry Building Society Leicester', 52.635979, -1.132296, 'https://www.google.co.uk/search?q=Coventry+Building+Society+Leicester', -1.0),
(116, 1, 'Dorothy Perkins', 52.635654, -1.132394, 'https://www.google.co.uk/search?q=Dorothy+Perkins', 4.2),
(117, 1, 'Music Junkie', 52.637906, -1.128230, 'https://www.google.co.uk/search?q=Music+Junkie', 4.7),
(118, 1, 'William H Brown Estate Agents in Leicester', 52.634688, -1.130629, 'https://www.google.co.uk/search?q=William+H+Brown+Estate+Agents+in+Leicester', 2.0),
(119, 1, 'Boots Opticians', 52.635103, -1.131820, 'https://www.google.co.uk/search?q=Boots+Opticians', 4.0),
(120, 1, 'The Works', 52.634790, -1.131712, 'https://www.google.co.uk/search?q=The+Works', 4.1),
(121, 2, 'Le Gîte de la Presqu''île Appart''Hôtel by Amit', 48.574261, 7.761884, 'https://www.google.co.uk/search?q=Le+G%C3%AEte+de+la+Presqu%27%C3%AEle+Appart%27H%C3%B4tel+by+Amitel', 4.7),
(122, 2, 'MONOPRIX', 48.568062, 7.758423, 'https://www.google.co.uk/search?q=MONOPRIX', 3.7),
(123, 2, 'MAIF Strasbourg Etoile', 48.570592, 7.756224, 'https://www.google.co.uk/search?q=MAIF+Strasbourg+Etoile', 4.3),
(124, 2, 'Panza Gymnothèque', 48.570108, 7.758611, 'https://www.google.co.uk/search?q=Panza+Gymnoth%C3%A8que', 3.9),
(125, 2, 'Institut de beauté Body''Minute', 48.573817, 7.756800, 'https://www.google.co.uk/search?q=Institut+de+beaut%C3%A9+Body%27Minute', 1.0),
(126, 2, 'Société Générale', 48.568443, 7.757163, 'https://www.google.co.uk/search?q=Soci%C3%A9t%C3%A9+G%C3%A9n%C3%A9rale', -1.0),
(127, 2, 'Opticien GrandOptical Strasbourg Rivetoile', 48.573826, 7.756703, 'https://www.google.co.uk/search?q=Opticien+GrandOptical+Strasbourg+Rivetoile', 2.1),
(128, 2, 'Studio Avec Terrace Au Doc', 48.573688, 7.759152, 'https://www.google.co.uk/search?q=Studio+Avec+Terrace+Au+Doc', -1.0),
(129, 2, 'E.Leclerc Strasbourg', 48.572643, 7.760410, 'https://www.google.co.uk/search?q=E.Leclerc+Strasbourg', 3.5),
(130, 2, 'Crédit Mutuel', 48.568556, 7.752986, 'https://www.google.co.uk/search?q=Cr%C3%A9dit+Mutuel', 2.0),
(131, 2, 'Pharmacie Rivetoile', 48.573594, 7.757364, 'https://www.google.co.uk/search?q=Pharmacie+Rivetoile', 3.4),
(132, 2, 'Beirut Restaurant', 48.569516, 7.756920, 'https://www.google.co.uk/search?q=Beirut+Restaurant', 4.4),
(133, 2, 'Mango', 48.573445, 7.757810, 'https://www.google.co.uk/search?q=Mango', 3.7),
(134, 2, 'Sagone', 48.567077, 7.758031, 'https://www.google.co.uk/search?q=Sagone', 3.2),
(135, 2, 'Carrefour City', 48.568734, 7.752684, 'https://www.google.co.uk/search?q=Carrefour+City', 3.8),
(136, 2, 'Rivetoile Shopping Mall', 48.573721, 7.756916, 'https://www.google.co.uk/search?q=Rivetoile+Shopping+Mall', 4.1),
(137, 2, 'Le Resto Du Coin', 48.568396, 7.754807, 'https://www.google.co.uk/search?q=Le+Resto+Du+Coin', 4.2),
(138, 2, 'Municipal Cemetery Saint-Urbain', 48.572035, 7.758043, 'https://www.google.co.uk/search?q=Municipal+Cemetery+Saint-Urbain', 3.5),
(139, 2, 'La Plage', 48.573123, 7.760227, 'https://www.google.co.uk/search?q=La+Plage', 4.5),
(140, 2, 'Très grande chambre vue Cathédrale - Place de', 48.571119, 7.756428, 'https://www.google.co.uk/search?q=Tr%C3%A8s+grande+chambre+vue+Cath%C3%A9drale+-+Place+de+l%27Etoile', -1.0);

-- --------------------------------------------------------

--
-- Table structure for table `venue_category`
--

CREATE TABLE IF NOT EXISTS `venue_category` (
  `venue_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(45) NOT NULL,
  PRIMARY KEY (`venue_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `venue_category`
--

INSERT INTO `venue_category` (`venue_category_id`, `category_name`) VALUES
(1, 'point_of_interest'),
(2, 'lodging'),
(3, 'restaurant'),
(4, 'food'),
(5, 'establishment'),
(6, 'travel_agency'),
(7, 'movie_theater'),
(8, 'electronics_store'),
(9, 'home_goods_store'),
(10, 'store'),
(11, 'shopping_mall'),
(12, 'department_store'),
(13, 'furniture_store'),
(14, 'clothing_store'),
(15, 'shoe_store'),
(16, 'meal_takeaway'),
(17, 'bicycle_store'),
(18, 'cafe'),
(19, 'hardware_store'),
(20, 'atm'),
(21, 'bank'),
(22, 'finance'),
(23, 'bar'),
(24, 'dentist'),
(25, 'health'),
(26, 'real_estate_agency'),
(27, 'book_store'),
(28, 'spa'),
(29, 'supermarket'),
(30, 'grocery_or_supermarket'),
(31, 'insurance_agency'),
(32, 'gym'),
(33, 'beauty_salon'),
(34, 'pharmacy'),
(35, 'cemetery');

-- --------------------------------------------------------

--
-- Table structure for table `weather`
--

CREATE TABLE IF NOT EXISTS `weather` (
  `city_id` int(11) NOT NULL,
  `last_checked` datetime NOT NULL,
  `published_at` datetime NOT NULL,
  `current_temp` int(11) NOT NULL,
  `weather_code` int(11) NOT NULL,
  PRIMARY KEY (`city_id`),
  KEY `fk_Weather_City1_idx` (`city_id`),
  KEY `fk_Weather_weather_codes1_idx` (`weather_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `weather`
--

INSERT INTO `weather` (`city_id`, `last_checked`, `published_at`, `current_temp`, `weather_code`) VALUES
(1, '2018-03-06 14:18:53', '2018-03-06 13:00:00', 44, 26),
(2, '2018-03-06 14:08:20', '2018-03-06 13:00:00', 50, 26);

-- --------------------------------------------------------

--
-- Table structure for table `weather_codes`
--

CREATE TABLE IF NOT EXISTS `weather_codes` (
  `weather_code_id` int(11) NOT NULL,
  `description` varchar(25) NOT NULL,
  PRIMARY KEY (`weather_code_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `weather_codes`
--

INSERT INTO `weather_codes` (`weather_code_id`, `description`) VALUES
(0, 'tornado'),
(1, 'tropical storm'),
(2, 'hurricane'),
(3, 'severe thunderstorms'),
(4, 'thunderstorms'),
(5, 'mixed rain and snow'),
(6, 'mixed rain and sleet'),
(7, 'mixed snow and sleet'),
(8, 'freezing drizzle'),
(9, 'drizzle'),
(10, 'freezing rain'),
(11, 'showers'),
(12, 'showers'),
(13, 'snow flurries'),
(14, 'light snow showers'),
(15, 'blowing snow'),
(16, 'snow'),
(17, 'hail'),
(18, 'sleet'),
(19, 'dust'),
(20, 'foggy'),
(21, 'haze'),
(22, 'smoky'),
(23, 'blustery'),
(24, 'windy'),
(25, 'cold'),
(26, 'cloudy'),
(27, 'mostly cloudy (night)'),
(28, 'mostly cloudy (day)'),
(29, 'partly cloudy (night)'),
(30, 'partly cloudy (day)'),
(31, 'clear (night)'),
(32, 'sunny'),
(33, 'fair (night)'),
(34, 'fair (day)'),
(35, 'mixed rain and hail'),
(36, 'hot'),
(37, 'isolated thunderstorms'),
(38, 'scattered thunderstorms'),
(39, 'scattered thunderstorms'),
(40, 'scattered showers'),
(41, 'heavy snow'),
(42, 'scattered snow showers'),
(43, 'heavy snow'),
(44, 'partly cloudy'),
(45, 'thundershowers'),
(46, 'snow showers'),
(47, 'isolated thundershowers'),
(3200, 'not available');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attraction_categories`
--
ALTER TABLE `attraction_categories`
  ADD CONSTRAINT `fk_attraction_categories_Venue_category1` FOREIGN KEY (`venue_category`) REFERENCES `venue_category` (`venue_category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_attraction_categories_local_attractions1` FOREIGN KEY (`local_attraction`) REFERENCES `local_attractions` (`local_attractions_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `fk_City_Country` FOREIGN KEY (`country`) REFERENCES `country` (`country_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `forecast`
--
ALTER TABLE `forecast`
  ADD CONSTRAINT `fk_forecast_weather_codes1` FOREIGN KEY (`weather_code`) REFERENCES `weather_codes` (`weather_code_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_forecast_City1` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `local_attractions`
--
ALTER TABLE `local_attractions`
  ADD CONSTRAINT `fk_local_attractions_City1` FOREIGN KEY (`city`) REFERENCES `city` (`city_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `weather`
--
ALTER TABLE `weather`
  ADD CONSTRAINT `fk_Weather_City1` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Weather_weather_codes1` FOREIGN KEY (`weather_code`) REFERENCES `weather_codes` (`weather_code_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
