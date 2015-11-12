-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 12 Novembre 2015 à 11:32
-- Version du serveur :  5.6.20-log
-- Version de PHP :  5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `pointeuse`
--
CREATE DATABASE IF NOT EXISTS `pointeuse` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `pointeuse`;

GRANT USAGE ON *.* TO 'Pointeuse'@'localhost' IDENTIFIED BY PASSWORD '*66B3CD3D69665C3749B86585FD5D1C48E2FC78BF';

GRANT ALL PRIVILEGES ON `pointeuse`.* TO 'Pointeuse'@'localhost';

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
`idClient` int(4) NOT NULL,
  `pseudo` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Contenu de la table `client`
--

INSERT INTO `client` (`idClient`, `pseudo`, `password`, `admin`) VALUES
(1, 'test', 'azer', 1),
(2, 'toto', 'toto', 0),
(3, 'azaz', 'az', 0),
(4, 'abcd', 'abcd', 0),
(5, 'ab', 'ab', 0),
(6, 'z', 'z', 0),
(7, 'e', 'e', 0),
(8, 'q', 'q', 0),
(9, 'azer', 'azer', 0),
(10, 'marc', 'gomez', 0),
(11, 'p', 'p', 0),
(12, 'kevin', 'aa', 0),
(13, 'mathieu', 'b', 0);

-- --------------------------------------------------------

--
-- Structure de la table `pointeuse`
--

CREATE TABLE IF NOT EXISTS `pointeuse` (
`idPointage` int(5) NOT NULL,
  `idClient` int(4) NOT NULL,
  `jourPointage` varchar(10) NOT NULL,
  `heureDébut` varchar(8) NOT NULL,
  `heureFin` varchar(8) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Contenu de la table `pointeuse`
--

INSERT INTO `pointeuse` (`idPointage`, `idClient`, `jourPointage`, `heureDébut`, `heureFin`) VALUES
(5, 2, '24:9:2015', '11:40:21', '11:57:47'),
(6, 2, '24:9:2015', '11:58:08', '11:58:08'),
(7, 2, '24:9:2015', '11:58:21', '11:58:21'),
(8, 2, '24:9:2015', '11:58:46', '20:00:00'),
(9, 1, '24:9:2015', '12:45:22', '20:45:22'),
(10, 1, '29:9:2015', '11:12:58', '20:00:00'),
(11, 1, '29:9:2015', '11:26:52', '18:54:20'),
(12, 8, '29:9:2015', '11:52:24', '20:00:00'),
(13, 7, '29:9:2015', '11:53:09', '20:00:00'),
(14, 10, '29:9:2015', '15:06:44', '20:00:00'),
(15, 1, '29:9:2015', '19:27:06', '20:57:57'),
(16, 9, '29:9:2015', '20:46:38', '21:00:00'),
(17, 1, '29:9:2015', '8:00:00', '20:57:57'),
(18, 1, '28:9:2015', '9:00:00', '21:00:00'),
(19, 1, '29:9:2015', '20:57:57', '20:59:01'),
(20, 1, '29:9:2015', '8:00:00', '20:59:01'),
(21, 1, '29:9:2015', '20:59:01', '21:00:00'),
(22, 1, '29:9:2015', '21:00:25', '21:00:25'),
(23, 1, '29:9:2015', '8:00:00', '21:00:25'),
(24, 1, '29:9:2015', '21:00:25', '21:02:29'),
(25, 1, '29:9:2015', '8:00:00', '21:02:29'),
(26, 1, '28:9:2015', '9:00:00', '21:00:00'),
(27, 1, '29:9:2015', '21:02:29', '22:00:00'),
(28, 1, '29:9:2015', '21:06:01', '21:06:01'),
(29, 1, '29:9:2015', '8:00:00', '16:00:00'),
(30, 1, '28:9:2015', '9:00:00', '14:00:00'),
(31, 1, '29:9:2015', '21:06:01', '22:00:00'),
(32, 1, '30:9:2015', '8:29:22', '20:00:00'),
(33, 11, '30:9:2015', '8:40:27', '20:00:00'),
(34, 2, '18:10:2015', '14:53:29', '14:53:49'),
(35, 2, '18:10:2015', '14:54:45', '14:54:46');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `client`
--
ALTER TABLE `client`
 ADD PRIMARY KEY (`idClient`);

--
-- Index pour la table `pointeuse`
--
ALTER TABLE `pointeuse`
 ADD PRIMARY KEY (`idPointage`), ADD KEY `idClient` (`idClient`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
MODIFY `idClient` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `pointeuse`
--
ALTER TABLE `pointeuse`
MODIFY `idPointage` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `pointeuse`
--
ALTER TABLE `pointeuse`
ADD CONSTRAINT `pointeuse_ibfk_1` FOREIGN KEY (`idClient`) REFERENCES `client` (`idClient`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
