-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mer 16 Novembre 2016 à 11:02
-- Version du serveur :  5.5.46-0+deb8u1
-- Version de PHP :  5.6.17-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `tutorat`
--

-- --------------------------------------------------------

--
-- Structure de la table `ens`
--

CREATE TABLE IF NOT EXISTS `ens` (
`ens_mat` int(11) NOT NULL,
  `ens_nom` varchar(30) DEFAULT NULL,
  `ens_prenom` varchar(30) DEFAULT NULL,
  `ens_login` varchar(20) DEFAULT NULL,
  `ens_mdp` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ens`
--

INSERT INTO `ens` (`ens_mat`, `ens_nom`, `ens_prenom`, `ens_login`, `ens_mdp`) VALUES
(0, NULL, NULL, NULL, NULL),
(1, 'GACHER', 'Aurelien', 'gachea', 'gachea'),
(2, 'GOMBEAUD', 'Maxime', 'gombem', 'gombem'),
(3, 'yop', 'lay', 'yoplay', 'yoplay');

-- --------------------------------------------------------

--
-- Structure de la table `etu`
--

CREATE TABLE IF NOT EXISTS `etu` (
`etu_mat` int(11) NOT NULL,
  `etu_nom` varchar(30) DEFAULT NULL,
  `etu_prenom` varchar(30) DEFAULT NULL,
  `ens_mat` int(11) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `etu`
--

INSERT INTO `etu` (`etu_mat`, `etu_nom`, `etu_prenom`, `ens_mat`) VALUES
(1, 'LITAIZE', 'Xavier', 1),
(2, 'LEFORT', 'Lilian', 1),
(3, 'KRATZ', 'Florian', 1),
(4, 'YOP', 'Lay', 2),
-- --------------------------------------------------------

--
-- Structure de la table `rdv`
--

CREATE TABLE IF NOT EXISTS `rdv` (
  `rdv_id` varchar(10) NOT NULL,
  `rdv_date` date DEFAULT NULL,
  `rdv_descri` text,
  `rdv_type` tinyint(1) NOT NULL,
  `ens_mat` int(11) DEFAULT NULL,
  `etu_mat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `rdv`
--

INSERT INTO `rdv` (`rdv_id`, `rdv_date`, `rdv_descri`, `rdv_type`, `ens_mat`, `etu_mat`) VALUES
('1-3-F-1', '2016-11-10', 'bon la ca devrait marcher ! parce que sinon je boude 1edit', 1, 3, 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `ens`
--
ALTER TABLE `ens`
 ADD PRIMARY KEY (`ens_mat`);

--
-- Index pour la table `etu`
--
ALTER TABLE `etu`
 ADD PRIMARY KEY (`etu_mat`), ADD KEY `ens_mat` (`ens_mat`);

--
-- Index pour la table `rdv`
--
ALTER TABLE `rdv`
 ADD PRIMARY KEY (`rdv_id`), ADD KEY `ens_mat` (`ens_mat`), ADD KEY `etu_mat` (`etu_mat`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `ens`
--
ALTER TABLE `ens`
MODIFY `ens_mat` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `etu`
--
ALTER TABLE `etu`
MODIFY `etu_mat` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `etu`
--
ALTER TABLE `etu`
ADD CONSTRAINT `etu_ibfk_1` FOREIGN KEY (`ens_mat`) REFERENCES `ens` (`ens_mat`);

--
-- Contraintes pour la table `rdv`
--
ALTER TABLE `rdv`
ADD CONSTRAINT `rdv_ibfk_1` FOREIGN KEY (`ens_mat`) REFERENCES `ens` (`ens_mat`),
ADD CONSTRAINT `rdv_ibfk_2` FOREIGN KEY (`etu_mat`) REFERENCES `etu` (`etu_mat`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
