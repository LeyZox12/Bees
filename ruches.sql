-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 14, 2025 at 10:52 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ruches`
--

-- --------------------------------------------------------

--
-- Table structure for table `alertes`
--

DROP TABLE IF EXISTS `alertes`;
CREATE TABLE IF NOT EXISTS `alertes` (
  `alias` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `identifier` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `seen` tinyint(1) NOT NULL COMMENT 'Est-ce que l''alerte à été vu ?',
  `id_record` int NOT NULL COMMENT 'id qui vient de la ruche directement',
  `nom_ruche` varchar(255) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'de quelle ruche vient l''alerte'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alertes`
--

INSERT INTO `alertes` (`alias`, `identifier`, `seen`, `id_record`, `nom_ruche`) VALUES
('Masse', 'masse', 0, 6, 'ruche1'),
('Masse', 'masse', 0, 8, 'ruche1'),
('Température externe', 'temp_ext', 1, 7, 'ruche2'),
('Température externe', 'temp_ext', 1, 6, 'ruche2'),
('Masse', 'masse', 1, 10, 'ruche2');

-- --------------------------------------------------------

--
-- Table structure for table `limites`
--

DROP TABLE IF EXISTS `limites`;
CREATE TABLE IF NOT EXISTS `limites` (
  `minLim` float NOT NULL,
  `maxLim` float NOT NULL,
  `alias` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `nom_ruche` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `limites`
--

INSERT INTO `limites` (`minLim`, `maxLim`, `alias`, `nom_ruche`, `id`) VALUES
(40, 55, 'Masse', 'ruche2', 1),
(70, 90, 'Humidité', 'ruche2', 2),
(18, 25, 'Température interne', 'ruche2', 3),
(17, 22, 'Température externe', 'ruche2', 4),
(40, 45, 'Masse', 'ruche1', 5),
(70, 90, 'Humidité', 'ruche1', 6),
(18, 25, 'Température interne', 'ruche1', 7),
(17, 22, 'Température externe', 'ruche1', 8);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `date` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `message` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `force` int DEFAULT NULL,
  `masse` float DEFAULT NULL,
  `reine` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `nourit` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `traitement` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nom_ruche` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `msg_id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`msg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`date`, `message`, `force`, `masse`, `reine`, `nourit`, `traitement`, `nom_ruche`, `msg_id`) VALUES
('10/7/2025', 'aedae', 4, 3, '3', 'e', 'e', '0', 29);

-- --------------------------------------------------------

--
-- Table structure for table `ruche1`
--

DROP TABLE IF EXISTS `ruche1`;
CREATE TABLE IF NOT EXISTS `ruche1` (
  `id_record` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` tinytext COLLATE utf8mb3_bin NOT NULL,
  `date` datetime NOT NULL,
  `temp_int` float DEFAULT NULL,
  `temp_ext` float DEFAULT NULL,
  `humidite` tinyint UNSIGNED DEFAULT NULL,
  `masse` float UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id_record`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Dumping data for table `ruche1`
--

INSERT INTO `ruche1` (`id_record`, `nom`, `date`, `temp_int`, `temp_ext`, `humidite`, `masse`) VALUES
(4, 'ruche1', '2025-05-25 00:00:00', 22, 19, 80, 44),
(5, 'ruche1', '2025-05-25 00:00:00', 22, 19, 80, 45),
(6, 'ruche1', '2025-05-25 00:00:00', 22, 19, 80, 46),
(7, 'ruche1', '2025-05-25 00:00:00', 22, 19, 80, 44),
(8, 'ruche1', '2025-05-25 00:00:00', 22, 19, 80, 48);

-- --------------------------------------------------------

--
-- Table structure for table `ruche2`
--

DROP TABLE IF EXISTS `ruche2`;
CREATE TABLE IF NOT EXISTS `ruche2` (
  `id_record` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` tinytext CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `date` datetime NOT NULL,
  `temp_int` float DEFAULT NULL,
  `temp_ext` float DEFAULT NULL,
  `humidite` tinyint UNSIGNED DEFAULT NULL,
  `masse` float UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id_record`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Dumping data for table `ruche2`
--

INSERT INTO `ruche2` (`id_record`, `nom`, `date`, `temp_int`, `temp_ext`, `humidite`, `masse`) VALUES
(4, 'ruche2', '2005-05-25 10:19:25', 22, 19, 80, 44),
(5, 'ruche2', '2005-05-25 10:20:19', 22, 19, 80, 45),
(6, 'ruche2', '2005-05-25 10:21:31', 22, 10, 80, 46),
(7, 'ruche2', '2005-05-25 10:23:40', 22, 26, 80, 44),
(8, 'ruche2', '2005-05-25 10:25:14', 22, 19, 80, 53),
(9, 'ruche2', '2005-05-25 10:25:14', 22, 19, 80, 53),
(10, 'ruche2', '2005-05-25 10:25:14', 22, 19, 80, 35);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
