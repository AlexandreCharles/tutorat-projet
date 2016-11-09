SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


CREATE TABLE IF NOT EXISTS `ens` (
`ens_mat` int(11) NOT NULL,
  `ens_nom` varchar(30) DEFAULT NULL,
  `ens_prenom` varchar(30) DEFAULT NULL,
  `ens_login` varchar(20) DEFAULT NULL,
  `ens_mdp` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

TRUNCATE TABLE `ens`;
INSERT INTO `ens` (`ens_mat`, `ens_nom`, `ens_prenom`, `ens_login`, `ens_mdp`) VALUES
(0, NULL, NULL, NULL, NULL),
(1, 'GACHER', 'Aurelien', 'gachea', 'gachea'),
(2, 'GOMBEAUD', 'Maxime', 'gombem', 'gombem'),
(3, 'yop', 'lay', 'yoplay', 'yoplay');

CREATE TABLE IF NOT EXISTS `etu` (
`etu_mat` int(11) NOT NULL,
  `etu_nom` varchar(30) DEFAULT NULL,
  `etu_prenom` varchar(30) DEFAULT NULL,
  `ens_mat` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;

TRUNCATE TABLE `etu`;
INSERT INTO `etu` (`etu_mat`, `etu_nom`, `etu_prenom`, `ens_mat`) VALUES
(1, 'LITAIZE', 'Xavier', 1),
(2, 'LEFORT', 'Lilian', 1),
(3, 'KRATZ', 'Florian', 1),
(4, 'YOP', 'Lay', 2),
(5, '﻿Nom', 'Prénom', NULL),
(6, ' ANDRE', 'Jonnhy', NULL),
(7, ' CARTIER', ' Joévin', NULL),
(8, ' CHARLES', ' Alexandre', NULL),
(9, ' CHÂTEAU', ' Mathieu', NULL),
(10, ' CHIE BONNE SAN', ' Bryan', NULL),
(11, ' DAHMANI', 'Mouna', NULL),
(12, ' DAUPHIN', 'Florian', NULL),
(13, ' DESSIRIEX', 'Brian', NULL),
(14, ' FOUCAULT', 'Antoine', NULL),
(15, ' GACHER', 'Aurélien', NULL),
(16, ' GOMBEAUD', 'Maxime', NULL),
(17, ' KRATZ', 'Florian', NULL),
(18, ' LESTIDEAU', 'Joffrey', NULL),
(19, ' LITAIZE', 'Xavier', NULL),
(20, ' LUSSAN', 'Mélanie', NULL),
(21, ' MARSAUD', 'Amaël', NULL),
(22, ' MOUCHARD', 'Hugo', NULL),
(23, ' PASSEBON', 'Quentin', NULL),
(24, ' PERROT', 'Axel', NULL),
(25, ' PHILIPPE', 'Timothy', NULL),
(26, ' PICORON', 'Chloé', NULL),
(27, ' PRIVAT', 'Benjamin', NULL),
(28, ' PROUILLET', 'Alexandre', NULL),
(29, ' ROUILLERE', 'Julien', NULL),
(30, ' ROUSSEAU', 'Mathias', NULL),
(31, ' SUEUR', 'Antoine', NULL),
(32, ' THUEL', 'Jonathan', NULL),
(33, ' TORTORICI', 'Anaïs', NULL),
(34, 'BARET', 'Alexandre', NULL),
(35, 'BOURON', 'Clémentine', NULL),
(36, 'CAILLAUD', 'Tom', NULL),
(37, 'CAPLIEZ', 'Christophe', NULL),
(38, 'CHEVALLIER-PICHON', 'Maxime', NULL),
(39, 'CHOLLET', 'Steven', NULL),
(40, 'COLIN', 'Guillaume', NULL),
(41, 'DE MARCHI', 'Mathis', NULL),
(42, 'DRUART', 'Damien', NULL),
(43, 'DUROUX', 'Jordan', NULL),
(44, 'FRAIGNEAU', 'Martial', NULL),
(45, 'FRUHAUF', 'Gabriel', NULL),
(46, 'GILLOTOT', 'Gaël', NULL),
(47, 'GUERIN', 'Maxime', NULL),
(48, 'LAGLEYRE', 'Timothée', NULL),
(49, 'LEFORT', 'Lilian', NULL),
(50, 'LEMIERE', 'Ken', NULL),
(51, 'MALLET', 'Jordan', NULL),
(52, 'MAUZE', 'Louis-Clément', NULL),
(53, 'MOREAU', 'Kévin', NULL),
(54, 'PINAUD', 'Aymerick', NULL),
(55, 'SALVAT', 'Maxime', NULL),
(56, 'THIBAUT', 'Loïc', NULL);

CREATE TABLE IF NOT EXISTS `rdv` (
`rdv_id` int(11) NOT NULL,
  `rdv_date` date DEFAULT NULL,
  `rdv_descri` text,
  `rdv_type` tinyint(1) NOT NULL,
  `ens_mat` int(11) DEFAULT NULL,
  `etu_mat` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

TRUNCATE TABLE `rdv`;
INSERT INTO `rdv` (`rdv_id`, `rdv_date`, `rdv_descri`, `rdv_type`, `ens_mat`, `etu_mat`) VALUES
(1, '2016-11-04', 'Monsieur litaize a ete pris a part a cause de son manque d''attention yolo XD', 0, 3, 1);


ALTER TABLE `ens`
 ADD PRIMARY KEY (`ens_mat`);

ALTER TABLE `etu`
 ADD PRIMARY KEY (`etu_mat`), ADD KEY `ens_mat` (`ens_mat`);

ALTER TABLE `rdv`
 ADD PRIMARY KEY (`rdv_id`), ADD KEY `ens_mat` (`ens_mat`), ADD KEY `etu_mat` (`etu_mat`);


ALTER TABLE `ens`
MODIFY `ens_mat` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
ALTER TABLE `etu`
MODIFY `etu_mat` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=57;
ALTER TABLE `rdv`
MODIFY `rdv_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;

ALTER TABLE `etu`
ADD CONSTRAINT `etu_ibfk_1` FOREIGN KEY (`ens_mat`) REFERENCES `ens` (`ens_mat`);

ALTER TABLE `rdv`
ADD CONSTRAINT `rdv_ibfk_1` FOREIGN KEY (`ens_mat`) REFERENCES `ens` (`ens_mat`),
ADD CONSTRAINT `rdv_ibfk_2` FOREIGN KEY (`etu_mat`) REFERENCES `etu` (`etu_mat`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
